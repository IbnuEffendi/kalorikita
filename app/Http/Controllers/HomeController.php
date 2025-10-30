<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class HomeController extends Controller
{
    public function home()
    {
        // Ambil 4 menu acak untuk "Menu Mingguan"
        $menuMingguan = Menu::inRandomOrder()->take(8)->get();

        // Nanti kalau kamu mau tambahkan data lain (misal promo, artikel, dll), bisa ditambah di sini
        return view('home', compact('menuMingguan'));
    }
}
