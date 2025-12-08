<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\PaketCategory; // <--- 1. Pastikan Model ini dipanggil!

class HomeController extends Controller
{
    public function home()
    {
        // 1. Ambil Menu (Kode lama)
        $menuMingguan = Menu::inRandomOrder()->take(8)->get();

        // 2. Ambil Paket (INI YANG KEMARIN HILANG/BELUM ADA)
        $packets = PaketCategory::all(); 

        // 3. Kirim DUA variabel ke view ('menuMingguan' DAN 'packets')
        return view('home', compact('menuMingguan', 'packets'));
    }
}