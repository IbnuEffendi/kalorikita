<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class ProfilController extends Controller
{
    public function dashboard()
    {
         $user = Auth::user();

        return view('profil.dashboard', [
            'user' => $user,
            'activePlan' => [
                'name' => 'Paket Maintain',
                'slug' => 'maintain',
                'ends_at' => '2025-12-01',
                'boxes_left' => 6,
            ],
            'todayCalories' => 1450,
            'todayTarget' => 2200,
            'lastAiInsight' => null, // atau isi dari tabel kalori_lab
            'recentOrders' => [
                [
                    'plan_name' => 'Paket Pencoba',
                    'date' => '21 Nov 2025',
                    'status' => 'Selesai',
                    'total' => 300000,
                ],
            ],
            'notifications' => [
                [
                    'title' => 'Paketmu akan berakhir',
                    'message' => 'Paket Maintain akan berakhir dalam 3 hari. Yuk perpanjang sekarang!',
                    'time' => '21 Nov 2025, 10:32',
                ],
            ],
        ]);
    }
}
