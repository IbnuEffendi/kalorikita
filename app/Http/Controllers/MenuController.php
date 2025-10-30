<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        // ambil semua, nanti bisa di-paginate
        $menus = Menu::orderBy('created_at', 'desc')->paginate(9);
        return view('menu.index', compact('menus'));
    }
}
