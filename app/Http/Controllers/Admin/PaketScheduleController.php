<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuSchedule;
use App\Models\PaketCategory; // sesuaikan jika nama model paket category beda
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaketScheduleController extends Controller
{
    public function aiGenerate(Request $request)
    {
        $validated = $request->validate([
            'paket_category_id' => 'required|exists:paket_categories,id',
            'goal' => 'required|in:diet,maintain,bulking',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start = \Carbon\Carbon::parse($validated['start_date'])->startOfDay();
        $end   = \Carbon\Carbon::parse($validated['end_date'])->startOfDay();
        $days = $start->diffInDays($end) + 1;

        if ($days > 31) {
            return response()->json(['ok' => false, 'error' => 'Maksimal 31 hari per generate.'], 422);
        }

        $apiKey = config('services.gemini.key');
        if (!$apiKey) {
            return response()->json(['ok' => false, 'error' => 'API key Gemini belum dikonfigurasi.'], 422);
        }

        // Batasi menu agar prompt kecil
        $menus = \App\Models\Menu::query()
            ->select('id', 'nama_menu', 'kalori', 'kategori')
            ->orderByDesc('id')
            ->limit(250)
            ->get()
            ->map(fn($m) => [
                'id' => $m->id,
                'nama' => $m->nama_menu,
                'kalori' => (int) $m->kalori,
                'kategori' => $m->kategori,
            ])
            ->values()
            ->all();

        $menuJson = json_encode($menus, JSON_UNESCAPED_UNICODE);

        $prompt = <<<EOT
Kamu adalah asisten penyusun jadwal katering.

Tugas:
- Buat jadwal dari {$validated['start_date']} sampai {$validated['end_date']} (total {$days} hari).
- Untuk setiap hari, pilih 2 menu: lunch_menu_id dan dinner_menu_id.
- PILIH hanya dari daftar menu (berdasarkan ID). JANGAN membuat menu baru.
- Goal: {$validated['goal']}:
  - diet: pilih menu cenderung lebih rendah kalori
  - bulking: pilih menu cenderung lebih tinggi kalori
  - maintain: pilih menu seimbang
- Variasikan menu, jangan repetitif.

Keluaran HARUS JSON valid TANPA teks lain:
{
  "paket_category_id": {$validated['paket_category_id']},
  "goal": "{$validated['goal']}",
  "items": [
    {"date":"YYYY-MM-DD","lunch_menu_id":1,"dinner_menu_id":2}
  ]
}

Daftar menu (JSON):
{$menuJson}
EOT;

        $payload = [
            'contents' => [[
                'parts' => [['text' => $prompt]]
            ]]
        ];

        try {
            $response = \Http::timeout(90)
                ->retry(2, 800, fn($e) => $e instanceof \Illuminate\Http\Client\ConnectionException)
                ->withHeaders([
                    'Content-Type'   => 'application/json',
                    'x-goog-api-key' => $apiKey,
                ])
                ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent', $payload);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            \Log::error('Gemini timeout', ['err' => $e->getMessage()]);
            return response()->json([
                'ok' => false,
                'error' => 'AI timeout. Coba lagi, kecilkan range tanggal, atau kurangi jumlah menu yang dikirim.'
            ], 504);
        }

        if (!$response->successful()) {
            \Log::error('Gemini error', ['status' => $response->status(), 'body' => $response->body()]);
            return response()->json(['ok' => false, 'error' => 'Gagal memanggil AI.'], 500);
        }

        $data = $response->json();
        $rawText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';

        // bersihkan ```json
        $clean = trim($rawText);
        $clean = preg_replace('/^```json/i', '', $clean);
        $clean = preg_replace('/^```/i', '', $clean);
        $clean = preg_replace('/```$/i', '', $clean);
        $clean = trim($clean);

        $parsed = json_decode($clean, true);
        if (!is_array($parsed) || empty($parsed['items'])) {
            \Log::warning('AI JSON invalid', ['raw' => $rawText]);
            return response()->json(['ok' => false, 'error' => 'Format JSON dari AI tidak valid.'], 422);
        }

        // (opsional tapi bagus) validasi ID menu benar-benar ada
        $menuIds = collect($menus)->pluck('id')->all();
        foreach ($parsed['items'] as $it) {
            if (!in_array($it['lunch_menu_id'] ?? null, $menuIds) || !in_array($it['dinner_menu_id'] ?? null, $menuIds)) {
                return response()->json(['ok' => false, 'error' => 'AI memilih menu_id yang tidak ada. Coba generate ulang.'], 422);
            }
        }

        $menuMap = collect($menus)->mapWithKeys(function ($m) {
            return [$m['id'] => [
                'name' => $m['nama'],       // IMPORTANT: JS pakai .name
                'kalori' => $m['kalori'],
                'kategori' => $m['kategori'],
            ]];
        })->all();

        // tambahkan flag overwrite (opsional) supaya preview bisa kasih badge New/Overwrite
        $existingDates = MenuSchedule::where('paket_category_id', (int)$validated['paket_category_id'])
            ->whereBetween('schedule_date', [$start->toDateString(), $end->toDateString()])
            ->pluck('schedule_date')
            ->flip(); // biar lookup cepat

        $items = collect($parsed['items'])->map(function ($it) use ($existingDates) {
            $date = Carbon::parse($it['date'])->toDateString();
            $it['date'] = $date;
            $it['overwrite'] = $existingDates->has($date);
            return $it;
        })->values()->all();

        return response()->json([
            'ok' => true,
            'result' => $items,
            'menuMap' => $menuMap,
        ]);
    }

    public function aiConfirm(Request $request)
    {
        $validated = $request->validate([
            'paket_category_id' => ['required', 'integer'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.date' => ['required', 'date'],
            'items.*.lunch_menu_id' => ['required', 'integer'],
            'items.*.dinner_menu_id' => ['required', 'integer'],
            'items.*.overwrite' => ['nullable', 'boolean'],
        ]);

        $paketCategoryId = (int) $validated['paket_category_id'];
        $items = $validated['items'];

        DB::transaction(function () use ($paketCategoryId, $items) {
            foreach ($items as $it) {
                // Upsert per tanggal+paket
                MenuSchedule::updateOrCreate(
                    [
                        'paket_category_id' => $paketCategoryId,
                        'schedule_date' => Carbon::parse($it['date'])->toDateString(),
                    ],
                    [
                        'lunch_menu_id' => (int)$it['lunch_menu_id'],
                        'dinner_menu_id' => (int)$it['dinner_menu_id'],
                    ]
                );
            }
        });

        return response()->json(['success' => true]);
    }
}
