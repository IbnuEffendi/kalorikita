<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketCategory;
use App\Models\PaketOption;

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
        // 1. Ambil semua data inputan user (Nama, Alamat, WA, Catatan)
        $data = $request->all();

        // 2. Validasi ID Paket
        if (!$request->has('paket_option_id')) {
            return redirect()->route('paket.index');
        }

        // 3. Ambil ulang data paket dari database (untuk ditampilkan di Ringkasan)
        $paketOption = PaketOption::with('category')->findOrFail($request->paket_option_id);
        $totalBox = $paketOption->durasi_hari * 2;

        // 4. Kirim data user ($data) dan data paket ke halaman Payment
        // Pastikan file view ada di: resources/views/paket/payment.blade.php
        return view('paket.payment', compact('data', 'paketOption', 'totalBox'));
    }
}