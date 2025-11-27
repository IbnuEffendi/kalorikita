<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class GoogleController extends Controller
{
    /**
     * Redirect user ke Google OAuth.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback setelah user login Google.
     */
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        // 1️⃣ Cari akun berdasarkan google_id ATAU email
        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        // 2️⃣ Jika user belum ada → buat akun baru
        if (!$user) {
            $user = User::create([
                'name'                  => $googleUser->getName(),
                'email'                 => $googleUser->getEmail(),
                'google_id'             => $googleUser->getId(),
                'google_connected_at'   => now(),
                'password'              => bcrypt(Str::random(32)), // tidak dipakai
                'role'                  => 'user',
            ]);
        } else {
            // 3️⃣ Jika sudah ada tapi google_id belum terhubung → hubungkan
            if (!$user->google_id) {
                $user->google_id = $googleUser->getId();
                $user->google_connected_at = now();
                $user->save();
            }
        }

        Auth::login($user);

        return redirect()->route('profil.dashboard');
    }

    /**
     * User manual ingin menghubungkan Google ke akunnya.
     */
    public function connect()
    {
        // Ambil URL redirect Socialite ke Google
        $url = Socialite::driver('google')->redirect()->getTargetUrl();

        // Tambahkan parameter Google OAuth: prompt=select_account
        $url .= '&prompt=select_account';

        return redirect($url);
    }
}
