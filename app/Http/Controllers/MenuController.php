<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Menu::orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_menu', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // REKOMENDASI TERBAIK: Pakai 1
        // Hasil: 1 ... 4 5 6 ... 20
        $menus = $query->paginate(6)->onEachSide(0);

        return view('components.food-menu', compact('menus', 'search'));
    }
}