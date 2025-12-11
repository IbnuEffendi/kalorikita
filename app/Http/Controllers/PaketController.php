<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketCategory;
use App\Models\PaketOption;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;             // [PENTING] Untuk buat Slug otomatis
use Illuminate\Support\Facades\Storage; // [PENTING] Untuk hapus foto lama

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
        $categories = PaketCategory::with('options')->get();
        return view('paket.list', compact('categories'));
    }

    /**
     * Menampilkan halaman detail paket (User)
     */
    public function show($slug)
    {
        $category = PaketCategory::where('slug', $slug)->with('options')->firstOrFail();
        return view('paket.detail', compact('category'));
    }

    /**
     * STEP 1: Halaman Form Checkout
     */
    public function checkout(Request $request)
    {
        if (!$request->has('paket_option_id')) {
            return redirect()->route('paket.index');
        }

        $paketOption = PaketOption::with('category')->findOrFail($request->paket_option_id);
        $totalBox = $paketOption->durasi_hari * 2;

        return view('paket.checkout', compact('paketOption', 'totalBox'));
    }

    /**
     * STEP 2: Halaman Pembayaran (Midtrans)
     */
    public function payment(Request $request)
    {
        $request->validate([
            'paket_option_id' => 'required|exists:paket_options,id',
            'nama'            => 'required|string',
            'whatsapp'        => 'required|string',
            'alamat'          => 'required|string',
            'catatan'         => 'nullable|string',
        ]);

        $data = $request->all();
        $paketOption = PaketOption::with('category')->findOrFail($request->paket_option_id);
        $totalBox = $paketOption->durasi_hari * 2;

        // Config Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $orderId = 'KK-' . time() . '-' . $paketOption->id;

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $paketOption->harga,
            ],
            'customer_details' => [
                'first_name' => $request->nama,
                'phone'      => $request->whatsapp,
            ],
            'item_details' => [
                [
                    'id'       => $paketOption->id,
                    'price'    => $paketOption->harga,
                    'quantity' => 1,
                    'name'     => 'Paket ' . $paketOption->category->nama_kategori,
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('paket.payment', compact('data', 'paketOption', 'totalBox', 'snapToken'));
    }


    // =========================================================================
    //                            BAGIAN ADMIN (DASHBOARD)
    // =========================================================================

    /**
     * ADMIN: Proses Simpan Paket Baru
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'harga'         => 'required|numeric',
            'durasi_hari'   => 'required|integer', 
            'periode'       => 'required|string',  
            'keuntungan'    => 'nullable|string',  
            'gambar'        => 'nullable|image|max:2048'
        ]);

        // 2. Upload Gambar
        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('paket', 'public');
        }

        // 3. Convert string keuntungan "A, B, C" jadi Array JSON
        $listKeuntungan = $request->keuntungan ? array_map('trim', explode(',', $request->keuntungan)) : [];

        // 4. Simpan Kategori Paket
        $paket = PaketCategory::create([
            'nama_kategori' => $request->nama_kategori,
            'slug'          => Str::slug($request->nama_kategori),
            'deskripsi'     => $request->deskripsi,
            'gambar'        => $path,
            'keuntungan'    => $listKeuntungan, 
            'status'        => 'active'
        ]);

        // 5. Simpan Opsi Harga (Default)
        PaketOption::create([
            'paket_category_id' => $paket->id,
            'nama_opsi'         => $request->periode,
            'durasi_hari'       => $request->durasi_hari,
            'periode'           => $request->periode,
            'harga'             => $request->harga,
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
            'gambar'        => 'nullable|image|max:2048'
        ]);

        // Update Gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($paket->gambar && !Str::startsWith($paket->gambar, 'http')) {
                Storage::disk('public')->delete($paket->gambar);
            }
            $path = $request->file('gambar')->store('paket', 'public');
            $paket->update(['gambar' => $path]);
        }

        // Update Data Paket
        // Jika input keuntungan kosong, biarkan yang lama. Jika diisi, update.
        $listKeuntungan = $request->keuntungan 
                            ? array_map('trim', explode(',', $request->keuntungan)) 
                            : $paket->keuntungan;
        
        $paket->update([
            'nama_kategori' => $request->nama_kategori,
            'slug'          => Str::slug($request->nama_kategori), // Update slug juga
            'deskripsi'     => $request->deskripsi,
            'keuntungan'    => $listKeuntungan,
            'status'        => $request->status ?? $paket->status
        ]);

        // Update Harga (Opsi Pertama)
        $opsi = $paket->options()->first();
        if($opsi) {
            $opsi->update([
                'harga' => $request->harga,
                'periode' => $request->periode ?? $opsi->periode,
                'durasi_hari' => $request->durasi_hari ?? $opsi->durasi_hari
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
        
        // Hapus gambar jika ada
        if ($paket->gambar && !Str::startsWith($paket->gambar, 'http')) {
            Storage::disk('public')->delete($paket->gambar);
        }

        $paket->delete(); 
        
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dihapus!');
    }

    // =========================================================================
    //                            BAGIAN OPSI HARGA (ANAK)
    // =========================================================================

    /**
     * ADMIN: Tambah Opsi Harga Baru (Misal nambah durasi 14 hari ke paket yg udah ada)
     */
    public function storeOption(Request $request)
    {
        $request->validate([
            'paket_category_id' => 'required|exists:paket_categories,id',
            'durasi_hari'       => 'required|integer',
            'periode'           => 'required|string', // Contoh: "2 Minggu"
            'harga'             => 'required|numeric',
        ]);

        PaketOption::create([
            'paket_category_id' => $request->paket_category_id,
            'nama_opsi'         => $request->periode, // Kita samakan nama opsi dengan periode
            'durasi_hari'       => $request->durasi_hari,
            'periode'           => $request->periode,
            'harga'             => $request->harga,
        ]);

        return redirect()->back()->with('success', 'Varian harga berhasil ditambahkan!');
    }

    /**
     * ADMIN: Hapus Opsi Harga
     */
    public function destroyOption($id)
    {
        $option = PaketOption::findOrFail($id);
        
        // Cek: Jangan biarkan hapus kalau ini satu-satunya opsi (nanti paketnya jadi error)
        $count = PaketOption::where('paket_category_id', $option->paket_category_id)->count();
        if ($count <= 1) {
            return redirect()->back()->with('error', 'Minimal harus menyisakan 1 opsi harga!');
        }

        $option->delete();
        return redirect()->back()->with('success', 'Varian harga berhasil dihapus!');
    }
}