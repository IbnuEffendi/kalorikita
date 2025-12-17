<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PaketCategory;
use App\Models\PaketOption;
use App\Services\MidtransService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaketController extends Controller
{
    // =========================================================================
    //                            BAGIAN USER / PUBLIC
    // =========================================================================

    /**
     * Menampilkan halaman daftar paket (User)
     */
    public function index()
    {
        $categories = PaketCategory::with('options')->where('is_active', true)->get();
        return view('paket.list', compact('categories'));
    }

    /**
     * Menampilkan halaman detail paket (User)
     */
    public function show($slug)
    {
        $category = PaketCategory::where('slug', $slug)
            ->with(['options' => function ($q) {
                $q->where('is_active', true);
            }])
            ->firstOrFail();

        return view('paket.detail', compact('category'));
    }

    /**
     * STEP 1: Halaman Form Checkout (Data & Pengiriman)
     * Route: GET /checkout?paket_option_id=xx (atau sesuai route kamu)
     */
    public function checkout(Request $request)
    {
        if (!$request->has('paket_option_id')) {
            // sesuaikan kalau route list kamu pakai paket.list
            return redirect()->route('paket.list')->with('error', 'Silakan pilih paket dulu.');
        }

        $paketOption = PaketOption::with('category')->findOrFail($request->paket_option_id);

        // asumsi 2x makan per hari
        $totalBox = (int) ($paketOption->durasi_hari * 2);

        return view('paket.checkout', compact('paketOption', 'totalBox'));
    }

    /**
     * STEP 2: Payment (Buat Order + SnapToken Midtrans)
     * Route: POST /payment
     */
    public function payment(Request $request, MidtransService $midtransService)
    {
        // Validasi sesuai kebutuhan bisnis (ini yang kamu butuh)
        $validated = $request->validate([
            'paket_option_id'  => 'required|exists:paket_options,id',
            'nama'             => 'required|string|max:255',
            'whatsapp'         => 'required|string|max:25',
            'alamat'           => 'required|string',
            'catatan'          => 'nullable|string|max:500',

            // Wajib (biar jadwal order jelas)
            'start_date'       => 'required|date|after_or_equal:today',

            // Wajib (sesuai order model kamu)
            'food_preference'  => 'required|in:non_vegan,vegan',
        ]);

        $data = $request->all();

        $paketOption = PaketOption::with('category')->findOrFail($validated['paket_option_id']);
        $totalBox = (int) ($paketOption->durasi_hari * 2);

        $startDate = Carbon::parse($validated['start_date'])->startOfDay();
        $endDate   = $startDate->copy()->addDays(((int) $paketOption->durasi_hari) - 1)->startOfDay();

        $order = DB::transaction(function () use ($request, $paketOption, $totalBox, $startDate, $endDate, $midtransService) {
            $orderCode = $this->generateOrderCode();

            // 1) Buat Order dan simpan data pengiriman (snapshot)
            $order = Order::create([
                'user_id'           => auth()->id(),
                'paket_category_id' => $paketOption->category->id,
                'paket_option_id'   => $paketOption->id,
                'order_code'        => $orderCode,

                'total_harga'       => (int) $paketOption->harga,
                'total_hari'        => (int) $paketOption->durasi_hari,
                'total_box'         => $totalBox,
                'box_terpakai'      => 0,

                'start_date'        => $startDate,
                'end_date'          => $endDate,

                // ✅ simpan dari form checkout
                'customer_name'     => $request->nama,
                'user_phone'        => $request->whatsapp,
                'address'           => $request->alamat,
                'notes'             => $request->catatan,
                'food_preference'   => $request->food_preference,

                'status'            => 'pending',
            ]);

            // 2) Buat Snap Token Midtrans
            $snapToken = $midtransService->createSnapToken(
                $order,
                [
                    'first_name' => $request->nama,
                    'email'      => optional(auth()->user())->email,
                    'phone'      => $request->whatsapp,
                    'billing_address' => [
                        'address' => $request->alamat,
                    ],
                ],
                [
                    [
                        'id'       => (string) $paketOption->id,
                        'price'    => (int) $paketOption->harga,
                        'quantity' => 1,
                        'name'     => substr('Paket ' . $paketOption->category->nama_kategori, 0, 50),
                    ],
                ]
            );

            $order->update([
                'midtrans_snap_token' => $snapToken,
            ]);

            return $order->fresh();
        });

        $snapToken = $order->midtrans_snap_token;

        return view('paket.payment', compact('data', 'paketOption', 'totalBox', 'snapToken', 'order'));
    }

    protected function generateOrderCode(): string
    {
        do {
            $code = 'KK-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));
        } while (Order::where('order_code', $code)->exists());

        return $code;
    }

    // =========================================================================
    //                            BAGIAN ADMIN (DASHBOARD)
    // =========================================================================

    /**
     * ADMIN: Proses Simpan Paket Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'harga'         => 'required|numeric',
            'durasi_hari'   => 'required|integer',
            'periode'       => 'required|string',
            'keuntungan'    => 'nullable|string',
            'gambar'        => 'nullable|image|max:2048',
            'kalori_range'  => 'nullable|string|max:50',
            'protein_level' => 'nullable|string|max:50',
            'tagline'       => 'nullable|string|max:100',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('paket', 'public');
        }

        $listKeuntungan = $request->keuntungan
            ? array_map('trim', explode(',', $request->keuntungan))
            : [];

        // Pakai is_active seperti migration kamu (bukan "status")
        $paket = PaketCategory::create([
            'nama_kategori'  => $request->nama_kategori,
            'slug'           => Str::slug($request->nama_kategori),
            'deskripsi'      => $request->deskripsi,
            'gambar'         => $path,
            // kalau kolom ini memang ada di tabel kamu
            'tagline'        => $request->tagline,
            'kalori_range'   => $request->kalori_range,
            'protein_level'  => $request->protein_level,
            'is_active'      => true,

            // kalau kolom keuntungan kamu belum ada di paket_categories, hapus baris ini
            'keuntungan'     => $listKeuntungan,
        ]);

        PaketOption::create([
            'paket_category_id' => $paket->id,
            'nama_opsi'         => $request->periode,
            'durasi_hari'       => (int) $request->durasi_hari,
            // kalau kolom periode ada di paket_options kamu, boleh simpan
            'periode'           => $request->periode,
            'harga'             => (int) $request->harga,
            'is_active'         => true,
        ]);

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dibuat!');
    }

    /**
     * ADMIN: Proses Update Paket
     */
    public function update(Request $request, $id)
    {
        $paket = PaketCategory::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'harga'         => 'required|numeric',
            'keuntungan'    => 'nullable|string',
            'gambar'        => 'nullable|image|max:2048',
            'kalori_range'  => 'nullable|string|max:50',
            'protein_level' => 'nullable|string|max:50',
            'tagline'       => 'nullable|string|max:100',
            'is_active'     => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($paket->gambar && !Str::startsWith($paket->gambar, 'http')) {
                Storage::disk('public')->delete($paket->gambar);
            }
            $path = $request->file('gambar')->store('paket', 'public');
            $paket->gambar = $path;
        }

        $listKeuntungan = $request->keuntungan
            ? array_map('trim', explode(',', $request->keuntungan))
            : ($paket->keuntungan ?? []);

        $paket->update([
            'nama_kategori'  => $request->nama_kategori,
            'slug'           => Str::slug($request->nama_kategori),
            'deskripsi'      => $request->deskripsi,
            'tagline'        => $request->tagline,
            'kalori_range'   => $request->kalori_range,
            'protein_level'  => $request->protein_level,
            'is_active'      => $request->has('is_active') ? (bool) $request->is_active : $paket->is_active,

            // kalau kolom keuntungan kamu belum ada, hapus baris ini
            'keuntungan'     => $listKeuntungan,
        ]);

        // Update opsi pertama (simple)
        $opsi = $paket->options()->first();
        if ($opsi) {
            $opsi->update([
                'harga'       => (int) $request->harga,
                'nama_opsi'   => $request->periode ?? $opsi->nama_opsi,
                'durasi_hari' => $request->durasi_hari ?? $opsi->durasi_hari,
                // kalau kolom periode ada
                'periode'     => $request->periode ?? ($opsi->periode ?? null),
            ]);
        }

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * ADMIN: Hapus Paket
     */
    public function destroy($id)
    {
        $paket = PaketCategory::findOrFail($id);

        if ($paket->gambar && !Str::startsWith($paket->gambar, 'http')) {
            Storage::disk('public')->delete($paket->gambar);
        }

        $paket->delete();
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dihapus!');
    }

    // =========================================================================
    //                            OPSI HARGA (ANAK)
    // =========================================================================

    public function storeOption(Request $request)
    {
        $request->validate([
            'paket_category_id' => 'required|exists:paket_categories,id',
            'durasi_hari'       => 'required|integer',
            'periode'           => 'required|string|max:50',
            'harga'             => 'required|numeric',
        ]);

        PaketOption::create([
            'paket_category_id' => $request->paket_category_id,
            'nama_opsi'         => $request->periode,
            'durasi_hari'       => (int) $request->durasi_hari,
            // kalau kolom periode ada
            'periode'           => $request->periode,
            'harga'             => (int) $request->harga,
            'is_active'         => true,
        ]);

        return redirect()->back()->with('success', 'Varian harga berhasil ditambahkan!');
    }

    public function destroyOption($id)
    {
        $option = PaketOption::findOrFail($id);

        $count = PaketOption::where('paket_category_id', $option->paket_category_id)->count();
        if ($count <= 1) {
            return redirect()->back()->with('error', 'Minimal harus menyisakan 1 opsi harga!');
        }

        $option->delete();
        return redirect()->back()->with('success', 'Varian harga berhasil dihapus!');
    }
}
