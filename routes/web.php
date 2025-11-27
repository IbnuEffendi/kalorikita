<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\GoogleController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\KaloriTrackerController;
use App\Http\Controllers\ProfilDashboardController;


Route::get('/kalori-tracker', [KaloriTrackerController::class, 'index'])
    ->name('profil.kalori.tracker')
    ->middleware('auth');

Route::post('/kalori-tracker/entry', [KaloriTrackerController::class, 'storeEntry'])
    ->name('kalori.tracker.entry.store')
    ->middleware('auth');

Route::post('/kalori-tracker/target', [KaloriTrackerController::class, 'updateTarget'])
    ->name('kalori.tracker.target.update')
    ->middleware('auth');

Route::post('/kalori-tracker/entry/ai', [KaloriTrackerController::class, 'storeEntryAi'])
    ->name('kalori.tracker.entry.ai')
    ->middleware('auth');
Route::post(
    '/kalori-tracker/performance-insight',
    [KaloriTrackerController::class, 'generatePerformanceInsight']
)->name('kalori.tracker.insight');


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
    return view('profil.kalorilab');
})->name('kalori-lab');

Route::post('/kalori-lab/insight', [LabController::class, 'insight'])
    ->name('lab.insight');

Route::get('/menu', function () {
    return view('components.food-menu');
});

Route::get('/lab-kalori', function () {
    return view('labkalori');
})->name('lab.kalori');


/*
|--------------------------------------------------------------------------
| PROFIL ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/profil', [ProfilDashboardController::class, 'index'])
    ->name('profil.dashboard')
    ->middleware('auth');

Route::get('/myorder', function () {
    return view('profil.myorder');
})->name('profil.myorder');

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/'); // kembali ke home
})->name('logout');


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

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.forgot');

Route::post('/forgot-password/send-otp', [AuthController::class, 'sendOtp'])
    ->name('password.sendOtp');

Route::post('/forgot-password/verify-otp', [AuthController::class, 'verifyOtp'])
    ->name('password.verifyOtp');

Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword'])
    ->name('password.reset');


/*
|--------------------------------------------------------------------------
| GOOGLE AUTH ROUTES (CLEAN VERSION)
|--------------------------------------------------------------------------
*/

// Redirect ke Google
Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

// Callback dari Google
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');

// Hubungkan akun Google ke akun manual (harus login)
Route::get('/connect/google', [GoogleController::class, 'connect'])
    ->middleware('auth')
    ->name('google.connect');
