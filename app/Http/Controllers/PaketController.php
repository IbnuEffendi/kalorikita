<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketCategory;
use App\Models\PaketOption;
use Midtrans\Config;
use Midtrans\Snap;


class PaketController extends Controller
{
    /**
     * Menampilkan halaman daftar paket
     */
    public function index()
    {
        $categories = PaketCategory::with('options')->get();
        // Pastikan file view ada di: resources/views/paket/list.blade.php
        return view('paket.list', compact('categories'));
    }

    /**
     * Menampilkan halaman detail paket
     */
    public function show($slug)
    {
        $category = PaketCategory::where('slug', $slug)->with('options')->firstOrFail();
        // Pastikan file view ada di: resources/views/paket/detail.blade.php
        return view('paket.detail', compact('category'));
    }

    /**
     * STEP 1: Halaman Form Checkout (Isi Data Diri)
     */
    public function checkout(Request $request)
    {
        // Validasi: Harus ada ID paket yang dipilih
        if (!$request->has('paket_option_id')) {
            return redirect()->route('paket.index');
        }

        // Ambil Data Paket
        $paketOption = PaketOption::with('category')->findOrFail($request->paket_option_id);
        $totalBox = $paketOption->durasi_hari * 2;

        // Tampilkan View Checkout
        // Pastikan file view ada di: resources/views/paket/checkout.blade.php
        return view('paket.checkout', compact('paketOption', 'totalBox'));
    }

    /**
     * STEP 2: Halaman Pembayaran (Pilih Metode Bayar)
     * Method ini menerima data Nama/Alamat dari form Checkout sebelumnya
     */
    public function payment(Request $request)
    {
        // Validasi basic
        $request->validate([
            'paket_option_id' => 'required|exists:paket_options,id',
            'nama'            => 'required|string',
            'whatsapp'        => 'required|string',
            'alamat'          => 'required|string',
            'catatan'         => 'nullable|string',
        ]);

        $data = $request->all();

        // Ambil data paket
        $paketOption = PaketOption::with('category')->findOrFail($request->paket_option_id);
        $totalBox = $paketOption->durasi_hari * 2;

        // --- MIDTRANS CONFIG ---
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        // Bikin order_id unik
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

        // Ambil Snap Token untuk popup
        $snapToken = Snap::getSnapToken($params);

        // kirim juga snapToken ke view
        return view('paket.payment', compact('data', 'paketOption', 'totalBox', 'snapToken'));
    }
}
