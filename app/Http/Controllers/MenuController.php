<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // ambil value search dari input
        $search = $request->input('search');

        // query dasar
        $query = Menu::orderBy('created_at', 'desc');

        // jika ada pencarian, filter berdasarkan nama atau deskripsi
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_menu', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // hasil paginasi
        $menus = $query->paginate(6);

        // kirim ke view
        return view('components.food-menu', compact('menus', 'search'));
    }
}
