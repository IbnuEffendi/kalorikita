<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGE ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/kalori-lab', function () {
    return view('labkalori');
});

Route::get('/menu', function () {
    return view('components.food-menu');
});

/*
|--------------------------------------------------------------------------
| PROFIL ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/profil', function () {
    return view('profil.dashboard');
})->name('profil.dashboard');

Route::get('/myorder', function () {
    return view('profil.myorder');
})->name('profil.myorder');

Route::get('/kalori-tracker', function () {
    return view('profil.kalori-tracker');
})->name('profil.kalori.tracker');

Route::get('/logout', function () {
    return view('profil.logout-modal');
})->name('profil.logout.modal');

/*
|--------------------------------------------------------------------------
| PAKET ROUTES
|--------------------------------------------------------------------------
*/

Route::view('/paket', 'paket.list')->name('paket.list');

Route::get('/paket/checkout/{plan?}', function ($plan = null) {
    return view('paket.checkout', ['plan' => $plan]);
})->name('paket.checkout');

Route::get('/proses-beli', [OrderController::class, 'showForm'])->name('proses.beli');
Route::post('/proses-beli', [OrderController::class, 'store'])->name('proses.beli.store');

Route::get('/pesanan/success', function () {
    return view('paket.success');
})->name('pesanan.success');

/*
|--------------------------------------------------------------------------
| DETAIL PAKET DINAMIS
|--------------------------------------------------------------------------
*/

Route::get('/paket/{slug}', function ($slug) {

    $pakets = [
        'pencoba' => [
            'nama' => 'Paket Pencoba',
            'tag' => 'Starter Pack',
            'deskripsi' => 'Cocok untuk kamu yang baru mau cobain katering sehat...',
            'kalori' => '1200-1400',
            'protein' => 'Medium',
            'box' => '10',
            'harga' => '300000',
            'harga_coret' => '350000',
            'gambar' => 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&w=800',
        ],
        'maintain' => [
            'nama' => 'Paket Maintain',
            'tag' => 'Best Value',
            'deskripsi' => 'Buat kamu yang ingin menjaga berat badan ideal...',
            'kalori' => '1600-1800',
            'protein' => 'Balanced',
            'box' => '12',
            'harga' => '350000',
            'harga_coret' => '450000',
            'gambar' => 'https://images.pexels.com/photos/1099680/pexels-photo-1099680.jpeg?auto=compress&cs=tinysrgb&w=800',
        ],
        'weightloss' => [
            'nama' => 'Paket Weight Loss',
            'tag' => 'Popular',
            'deskripsi' => 'Program diet defisit kalori untuk turunkan berat badan...',
            'kalori' => '1100-1300',
            'protein' => 'High',
            'box' => '10',
            'harga' => '400000',
            'harga_coret' => '500000',
            'gambar' => 'https://images.pexels.com/photos/1640772/pexels-photo-1640772.jpeg?auto=compress&cs=tinysrgb&w=800',
        ],
    ];

    if (!array_key_exists($slug, $pakets)) {
        abort(404);
    }

    return view('paket.detail', [
        'paket' => $pakets[$slug]
    ]);

})->name('paket.detail');


/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD – OTP (3 STEP DALAM 1 FILE)
|--------------------------------------------------------------------------
*/

// Halaman forgot password (1 file: input email → OTP → new password)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.forgot');

// Kirim OTP ke email
Route::post('/forgot-password/send-otp', [AuthController::class, 'sendOtp'])
    ->name('password.sendOtp');

// Verifikasi OTP
Route::post('/forgot-password/verify-otp', [AuthController::class, 'verifyOtp'])
    ->name('password.verifyOtp');

// Reset Password
Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword'])
    ->name('password.reset');