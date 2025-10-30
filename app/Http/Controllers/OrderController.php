<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showForm(Request $request)
    {
        $paket = $request->query('paket');
        $harga = $request->query('harga');

        $hargaList = [
            'pencoba' => 300000,
            'maintain' => 350000,
            'weightloss' => 400000,
            'musclegain' => 450000,
            'vegetarian' => 320000,
            'customdiet' => 500000
        ];

        $hargaFix = $harga ?? ($paket && isset($hargaList[$paket]) ? $hargaList[$paket] : 0);

        return view('proses-beli', compact('paket', 'hargaFix'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'paket' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        return back()->with('success', 'Pesanan berhasil dibuat!')->withInput();
    }
}
