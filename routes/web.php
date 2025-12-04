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
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaketController;


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

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

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

Route::get('/paket', [PaketController::class, 'index'])->name('paket.list');

Route::post('/checkout', [PaketController::class, 'checkout'])->name('paket.checkout');

Route::post('/payment', [PaketController::class, 'payment'])->name('paket.payment');

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

Route::get('/paket/{slug}', [PaketController::class, 'show'])->name('paket.detail');

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

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD ROUTES (PREFIX /admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard'); // memanggil sidebar-admin.blade.php di dalamnya
    })->name('admin.dashboard');

    Route::get('/pengguna', function () {
        return view('pengguna');
    })->name('admin.pengguna');

    Route::get('/menu-paket', function () {
        return view('menu-paket');
    })->name('admin.menu-paket');

    Route::get('/transaksi', function () {
        return view('transaksi');
    })->name('admin.transaksi');

    Route::get('/testimoni', function () {
        return view('testimoni');
    })->name('admin.testimoni');

    Route::get('/pengaturan', function () {
        return view('pengaturan');
    })->name('admin.pengaturan');

    Route::get('/log-aktivitas', function () {
        return view('log-aktivitas');
    })->name('admin.log-aktivitas');
});
