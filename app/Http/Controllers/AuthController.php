<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password; // Penting buat Reset Password
use Illuminate\Support\Str;              // Penting buat Token
use Illuminate\Auth\Events\PasswordReset; // Event reset
use App\Models\User;

class AuthController extends Controller
{
    // ========================================================================
    // REGISTER (DAFTAR)
    // ========================================================================
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed', // Pastikan input name="password_confirmation" ada di view
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // Default role
            'no_hp'    => null,   // Set null dulu biar gak error database
            'alamat'   => null,   // Set null dulu
        ]);

        Auth::login($user);

        return redirect()->route('profil.dashboard');
    }

    // ========================================================================
    // LOGIN (MASUK)
    // ========================================================================
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role kalau perlu (opsional), atau langsung ke dashboard
            return redirect()->intended(route('profil.dashboard'));
        }

        // Kalau gagal
        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // ========================================================================
    // FORGOT PASSWORD (LUPA KATA SANDI)
    // ========================================================================

    /**
     * 1. Tampilkan Form Isi Email
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * 2. Proses Kirim Link Reset ke Email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Kirim link reset password (Laravel otomatis menangani token & emailnya)
        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    /**
     * 3. Tampilkan Form Reset Password (Setelah klik link di email)
     */
    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    /**
     * 4. Proses Update Password Baru
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Proses reset password bawaan Laravel
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // Jika berhasil
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        // Jika gagal (token expired atau email salah)
        return back()->withErrors(['email' => [__($status)]]);
    }
}