<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\CalorieEntry;
use App\Models\UserTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KaloriTrackerController extends Controller
{


    public function index(Request $request)
    {
        $user = Auth::user();

        // =========================
        // 1. RANGE & TANGGAL
        // =========================
        $range     = $request->query('range', 'today');  // today, yesterday, 7d, 30d, date
        $dateParam = $request->query('date');

        $today = now()->startOfDay();

        switch ($range) {
            case 'yesterday':
                $start = (clone $today)->subDay()->startOfDay();
                $end   = (clone $today)->subDay()->endOfDay();
                $periodLabel = 'Kemarin - ' . $start->translatedFormat('l, d F Y');
                break;

            case '7d':
                $start = (clone $today)->subDays(6)->startOfDay();   // termasuk hari ini
                $end   = (clone $today)->endOfDay();
                $periodLabel = '7 hari terakhir';
                break;

            case '30d':
                $start = (clone $today)->subDays(29)->startOfDay();  // termasuk hari ini
                $end   = (clone $today)->endOfDay();
                $periodLabel = '30 hari terakhir';
                break;

            case 'date':
                $selected = $dateParam
                    ? \Carbon\Carbon::parse($dateParam)->startOfDay()
                    : $today;
                $start = (clone $selected)->startOfDay();
                $end   = (clone $selected)->endOfDay();
                $periodLabel = 'Tanggal - ' . $start->translatedFormat('l, d F Y');
                break;

            case 'today':
            default:
                $start = (clone $today)->startOfDay();
                $end   = (clone $today)->endOfDay();
                $periodLabel = 'Hari ini - ' . $start->translatedFormat('l, d F Y');
                $range = 'today';
                break;
        }

        // =========================
        // 2. TARGET HARIAN & RANGE
        // =========================

        // target harian (diset dari KaloriLab, di tabel user_targets)
        $target = UserTarget::where('user_id', $user->id)->first();

        $targetCaloriesDaily = $target ? (int) round($target->kalori_target ?? 0) : 0;
        $targetCarbsDaily    = $target ? (int) round($target->karbo_target ?? 0)    : 0;
        $targetProteinDaily  = $target ? (int) round($target->protein_target ?? 0)  : 0;
        $targetFatDaily      = $target ? (int) round($target->lemak_target ?? 0)    : 0;

        // berapa hari yang dihitung untuk target total
        $daysForTarget = match ($range) {
            '7d'    => 7,
            '30d'   => 30,
            default => 1,       // today, yesterday, date
        };

        // target TOTAL untuk periode (int, sudah dibulatkan)
        $targetCalories = (int) round($targetCaloriesDaily * $daysForTarget);
        $targetCarbs    = (int) round($targetCarbsDaily    * $daysForTarget);
        $targetProtein  = (int) round($targetProteinDaily  * $daysForTarget);
        $targetFat      = (int) round($targetFatDaily      * $daysForTarget);

        // =========================
        // 3. DATA ENTRY DI RANGE
        // =========================
        $entries = CalorieEntry::where('user_id', $user->id)
            ->whereBetween('eaten_at', [$start, $end])
            ->orderBy('eaten_at')
            ->get();

        // sum mentah (float)
        $sumCalories = (float) $entries->sum('calories');
        $sumCarbs    = (float) $entries->sum('carbs');
        $sumProtein  = (float) $entries->sum('protein');
        $sumFat      = (float) $entries->sum('fat');

        // versi integer untuk tampilan
        $todayCalories = (int) round($sumCalories);
        $todayCarbs    = (int) round($sumCarbs);
        $todayProtein  = (int) round($sumProtein);
        $todayFat      = (int) round($sumFat);

        // mapping buat table (pakai array biar gampang di Blade)
        $entriesForView = $entries->map(function ($entry) {
            return [
                'date'     => optional($entry->eaten_at)->format('d/m'),
                'time'     => optional($entry->eaten_at)->format('H:i'),
                'meal'     => $entry->meal,
                'category' => $entry->category,
                'calories' => $entry->calories,
            ];
        });

        // =========================
        // 4. PROGRESS & SISA
        // =========================
        $remainingCalories = max(0, $targetCalories - $todayCalories);

        $progressPct = $targetCalories > 0
            ? (int) round(min(100, ($todayCalories / $targetCalories) * 100))
            : 0;

        $carbProgressPct = $targetCarbs > 0
            ? (int) round(min(100, ($todayCarbs / $targetCarbs) * 100))
            : 0;

        $proteinProgressPct = $targetProtein > 0
            ? (int) round(min(100, ($todayProtein / $targetProtein) * 100))
            : 0;

        $fatProgressPct = $targetFat > 0
            ? (int) round(min(100, ($todayFat / $targetFat) * 100))
            : 0;

        // =========================
        // 5. LAIN-LAIN: GOOGLE & AI
        // =========================
        $googleConnected = !empty($user?->google_id);
        $aiSuggestion = session('ai_entry_suggestion');

        // =========================
        // 5. DATA PERFORMA 7 & 30 HARI
        // =========================
        $now = now();

        // Range 7 hari terakhir (termasuk hari ini)
        $start7  = $now->copy()->subDays(6)->startOfDay();
        $end7    = $now->copy()->endOfDay();

        // Range 30 hari terakhir (termasuk hari ini)
        $start30 = $now->copy()->subDays(29)->startOfDay();
        $end30   = $now->copy()->endOfDay();

        // Ambil entries dalam range
        $entries7 = CalorieEntry::where('user_id', $user->id)
            ->whereBetween('eaten_at', [$start7, $end7])
            ->get();

        $entries30 = CalorieEntry::where('user_id', $user->id)
            ->whereBetween('eaten_at', [$start30, $end30])
            ->get();

        // Group by tanggal (Y-m-d), lalu isi ke series per hari
        $group7 = $entries7->groupBy(function ($e) {
            return optional($e->eaten_at)->toDateString();
        });

        $group30 = $entries30->groupBy(function ($e) {
            return optional($e->eaten_at)->toDateString();
        });

        $chart7Labels    = [];
        $chart7Calories  = [];
        $chart30Labels   = [];
        $chart30Calories = [];

        // 7 hari terakhir
        $period7 = new \Carbon\CarbonPeriod($start7, '1 day', $end7);
        foreach ($period7 as $date) {
            $key = $date->toDateString();
            $chart7Labels[] = $date->format('d/m');
            $total = isset($group7[$key]) ? (float) $group7[$key]->sum('calories') : 0;
            $chart7Calories[] = (int) round($total);
        }

        // 30 hari terakhir
        $period30 = new \Carbon\CarbonPeriod($start30, '1 day', $end30);
        foreach ($period30 as $date) {
            $key = $date->toDateString();
            $chart30Labels[] = $date->format('d/m');
            $total = isset($group30[$key]) ? (float) $group30[$key]->sum('calories') : 0;
            $chart30Calories[] = (int) round($total);
        }


        // =========================
        // 6. KIRIM KE VIEW
        // =========================
        return view('profil.kalori-tracker', [
            'user'            => $user,
            'googleConnected' => $googleConnected,

            'periodLabel'     => $periodLabel,
            'range'           => $range,
            'dateParam'       => $dateParam,
            'daysForTarget'   => $daysForTarget,

            // target harian (dipakai untuk "Target Kalori Harian")
            'targetCaloriesDaily' => $targetCaloriesDaily,
            'targetCarbsDaily'    => $targetCarbsDaily,
            'targetProteinDaily'  => $targetProteinDaily,
            'targetFatDaily'      => $targetFatDaily,

            // target total periode (dipakai untuk progress bar)
            'targetCalories'  => $targetCalories,
            'targetCarbs'     => $targetCarbs,
            'targetProtein'   => $targetProtein,
            'targetFat'       => $targetFat,

            // realisasi di periode ini (sudah dibulatkan)
            'todayCalories'   => $todayCalories,
            'todayCarbs'      => $todayCarbs,
            'todayProtein'    => $todayProtein,
            'todayFat'        => $todayFat,

            'entries'         => $entriesForView,

            'remainingCalories' => $remainingCalories,
            'progressPct'       => $progressPct,
            'carbProgressPct'   => $carbProgressPct,
            'proteinProgressPct' => $proteinProgressPct,
            'fatProgressPct'    => $fatProgressPct,

            'aiSuggestion'   => $aiSuggestion,
            // data grafik performa
            'chart7Labels'      => $chart7Labels,
            'chart7Calories'    => $chart7Calories,
            'chart30Labels'     => $chart30Labels,
            'chart30Calories'   => $chart30Calories,
        ]);
    }



    public function storeEntryAi(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'eaten_at'  => ['required', 'date'],
            'ai_prompt' => ['required', 'string'],
        ]);

        $promptUser = $validated['ai_prompt'];
        $eatenAt    = $validated['eaten_at'];

        $apiKey = config('services.gemini.key');

        if (!$apiKey) {
            return back()->with('error', 'API key Gemini belum dikonfigurasi.');
        }

        // --- Hitung progress saat ini ---
        $today = now()->toDateString();

        $target = UserTarget::where('user_id', $user->id)->first();
        $targetCalories = $target->kalori_target ?? 0;

        $todayCalories = CalorieEntry::where('user_id', $user->id)
            ->whereDate('eaten_at', $today)
            ->sum('calories');

        // --- Prompt ke Gemini: JSON + insight 1 kalimat ---
        $systemPrompt = <<<EOT
Kamu adalah asisten gizi.

Analisis deskripsi makanan berikut dan berikan perkiraan:
- total kalori (kilokalori),
- karbohidrat (gram),
- protein (gram),
- lemak (gram),
- nama_makanan singkat,
- kategori makan (misalnya: Sarapan, Makan Siang, Makan Malam, Snack),
- insight: 1 kalimat pendek dalam bahasa Indonesia yang mengomentari apakah makanan ini cenderung ringan/sedang/berat dan bagaimana pengaruhnya terhadap progres kalori harian pengguna.

Kondisi pengguna saat ini:
- Target kalori harian: {$targetCalories} kkal
- Total kalori yang sudah dikonsumsi sebelum makanan ini: {$todayCalories} kkal

Jawab HANYA dalam format JSON seperti ini (tanpa teks lain, tanpa penjelasan):

{
  "meal": "Nasi putih + telur dadar",
  "category": "Sarapan",
  "calories": 550,
  "carbs": 70,
  "protein": 22,
  "fat": 15,
  "insight": "Kalimat singkat insight di sini."
}

Jika ragu, tetap lakukan perkiraan yang wajar.
EOT;

        $fullPrompt = $systemPrompt . "\n\nDeskripsi pengguna:\n" . $promptUser;

        $response = Http::withHeaders([
            'Content-Type'   => 'application/json',
            'x-goog-api-key' => $apiKey,
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent',
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $fullPrompt]
                        ]
                    ]
                ]
            ]
        );

        if (!$response->successful()) {
            Log::error('Gemini AI nutrition error', [
                'status' => $response->status(),
                'body'   => $response->json(),
            ]);

            return back()->with('error', 'Gagal menganalisis makanan dengan AI.');
        }

        $data = $response->json();
        $rawText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';

        // Bersihkan kemungkinan ```json ... ``` dari model
        $clean = trim($rawText);
        $clean = preg_replace('/^```json/i', '', $clean);
        $clean = preg_replace('/^```/i', '', $clean);
        $clean = preg_replace('/```$/i', '', $clean);
        $clean = trim($clean);

        $parsed = json_decode($clean, true);

        if (!is_array($parsed)) {
            Log::warning('Failed to parse AI nutrition JSON', ['raw' => $rawText]);

            return back()->with('error', 'Format jawaban AI tidak dikenali. Coba jelaskan ulang makanannya.');
        }

        // Simpan hasil ANALISIS ke session, belum ke database
        $suggestion = [
            'eaten_at' => $eatenAt,
            'meal'     => $parsed['meal']      ?? 'Makanan dari AI',
            'category' => $parsed['category']  ?? null,
            'calories' => $parsed['calories']  ?? null,
            'carbs'    => $parsed['carbs']     ?? null,
            'protein'  => $parsed['protein']   ?? null,
            'fat'      => $parsed['fat']       ?? null,
            'insight'  => $parsed['insight']   ?? 'AI menilai menu ini masih dalam batas wajar untuk progres harianmu.',
            'ai_prompt' => $promptUser,
            'ai_raw'   => $rawText,
        ];

        return redirect()
            ->route('profil.kalori.tracker')
            ->with('ai_entry_suggestion', $suggestion);
    }

    public function generatePerformanceInsight(Request $request)
    {
        $user = Auth::user();
        $apiKey = config('services.gemini.key');

        if (!$apiKey) {
            return response()->json(['error' => 'API key tidak ditemukan.'], 422);
        }

        // Ambil data grafik dari request
        $chart7 = $request->chart7 ?? [];
        $chart30 = $request->chart30 ?? [];
        $target = UserTarget::where('user_id', $user->id)->first();
        $targetCalories = $target->kalori_target ?? 0;

        // Format ringkas untuk prompt
        $summary7 = [];
        foreach ($chart7 as $item) {
            $summary7[] = $item['label'] . ':' . $item['value'] . 'kkal';
        }

        $summary30 = [];
        foreach ($chart30 as $item) {
            $summary30[] = $item['label'] . ':' . $item['value'] . 'kkal';
        }

        $text7 = implode(', ', $summary7);
        $text30 = implode(', ', $summary30);

        $prompt = <<<EOT
Kamu adalah asisten gizi dan motivasi.

Target kalori: {$targetCalories} kkal.
Data 7 hari terakhir: {$text7}
Data 30 hari terakhir: {$text30}

Buat insight:
1. 1-2 kalimat tentang pola 7 hari terakhir.
2. 1-2 kalimat tentang pola 30 hari terakhir.
3. 2-3 tips singkat (bullet point).
4. 1 kalimat motivasi positif.

Jawab dalam bahasa Indonesia, tanpa format JSON.
EOT;

        // Request ke Gemini
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $apiKey,
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent',
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]
        );

        if (!$response->successful()) {
            return response()->json(['error' => 'Gagal memanggil AI.'], 500);
        }

        $data = $response->json();
        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Tidak ada insight.';

        return response()->json(['insight' => $text]);
    }
}
