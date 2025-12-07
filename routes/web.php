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

// FORM REGISTER (GET)
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// PROSES REGISTER (POST)
Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

// FORM LOGIN (GET)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// PROSES LOGIN (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.process');


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
| FORGOT PASSWORD (DIPERBAIKI)
|--------------------------------------------------------------------------
*/

// 1. Form Isi Email
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');

// 2. Proses Kirim Link Email
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// 3. Form Reset Password (Link dari Email)
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');

// 4. Proses Update Password Baru
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');

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

use App\Http\Controllers\Admin\AdminDashboardController;
// pakai controller nanti, tapi sementara bisa juga pakai closure

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // DASHBOARD ADMIN
        Route::get('/dashboard', function () {
            // view: resources/views/admin/dashboard.blade.php
            return view('admin.dashboard');
        })->name('dashboard');

        // ORDERS (LIST)
        Route::get('/orders', function () {
            $orders = []; // atau isi dummy kalau mau

            return view('admin.orders.index', compact('orders'));
        })->name('orders.index');

        Route::get('/orders/{id}', function ($id) {
            $order = [
                'id'            => $id,
                'code'          => 'ORD-' . str_pad($id, 5, '0', STR_PAD_LEFT),
                'user_name'     => 'Contoh Pengguna',
                'user_email'    => 'user@example.com',
                'user_phone'    => '08xxxxxxxxxx',
                'plan_name'     => 'Paket Maintain 7 Hari',
                'plan_slug'     => 'maintain-7',
                'total'         => 300000,
                'status'        => 'pending',
                'date'          => now()->format('Y-m-d H:i'),
                'notes'         => 'Tanpa cabe, kirim sekitar jam 12 siang.',
                'address'       => 'Jl. Contoh No. 123, Denpasar',
                'payment_method' => 'Transfer Bank',
            ];

            $items = [
                ['name' => 'Menu Hari 1 - Siang', 'qty' => 1, 'price' => 45000],
                ['name' => 'Menu Hari 2 - Siang', 'qty' => 1, 'price' => 45000],
            ];

            return view('admin.orders.show', compact('order', 'items'));
        })->name('orders.show');

        // PAKET KATERING
        Route::get('/paket', fn() => view('admin.paket.index'))->name('paket.index');
        Route::get('/paket/create', fn() => view('admin.paket.create'))->name('paket.create');
        Route::get('/paket/{id}', function ($id) {
            // nanti ganti ke controller yang ambil data dari DB
            $package = []; // query paket
            $menus   = []; // query menu-menu

            return view('admin.paket.show', compact('package', 'menus'));
        })->name('paket.show');

        Route::get('/paket/{id}/edit', fn($id) => view('admin.paket.edit'))->name('paket.edit');;

        // FORM BUAT / EDIT PAKET (CREATE)
        Route::get('/paket/create', function () {
            // nanti bisa diganti controller beneran, sekarang pakai view sederhana dulu
            return view('admin.paket.create');
        })->name('paket.create');


        // DATA PENGGUNA
        Route::get('/users', function () {
            // view: resources/views/admin/users/index.blade.php
            return view('admin.users.index');
        })->name('users.index');

        Route::get('/users/{id}', function ($id) {
            $user = User::findOrFail($id);

            // contoh stats dummy (nanti bisa diisi dari tabel orders)
            $stats = [
                'orders_count' => 0,
                'orders_total' => 0,
                'last_order_at' => null,
            ];

            return view('admin.users.show', [
                'userDetail' => $user,
                'stats'      => $stats,
            ]);
        })->name('users.show');


        // LAPORAN
        Route::get('/reports', function () {
            // view: resources/views/admin/reports/index.blade.php
            return view('admin.reports.index');
        })->name('reports.index');



        Route::get('/reports/{date}', function ($date) {
            // nanti bisa parse date dan query ke orders
            $report = [
                'title'         => 'Laporan ' . \Carbon\Carbon::parse($date)->translatedFormat('d F Y'),
                'period_label'  => \Carbon\Carbon::parse($date)->translatedFormat('d F Y'),
                'date'          => $date,
                'income'        => 1150000,
                'orders'        => 10,
                'best_package'  => 'Paket Defisit 14 Hari',
                'avg_per_order' => 115000,
            ];

            $orders = [
                [
                    'id'         => 1,
                    'code'       => 'ORD-20251205-001',
                    'user_name'  => 'Pengguna Contoh',
                    'plan_name'  => 'Paket Defisit 14 Hari',
                    'status'     => 'success',
                    'total'      => 150000,
                    'created_at' => '2025-12-05 09:30:00',
                ],
            ];

            return view('admin.reports.show', compact('report', 'orders'));
        })->name('reports.show');


        // LOG / STATISTIK AI (KaloriLab)
        Route::get('/ai/ai-logs', function () {
            $logs = []; // nanti isi dari DB (UserTarget / KaloriLog)
            return view('admin.ai.logs', compact('logs'));
        })->name('ai.logs');

        Route::get('/ai/ai-logs/{id}', function ($id) {
            // sementara dummy, nanti pakai model beneran
            $log = [
                'id'             => $id,
                'user_id'        => 1,
                'user_name'      => 'Pengguna Contoh',
                'user_email'     => 'user@example.com',
                'user_phone'     => '08xxxx',
                'gender'         => 'L',
                'age'            => 18,
                'height'         => 160,
                'weight'         => 45,
                'activity_level' => 'Sedang',
                'goal'           => 'defisit',
                'bmi'            => 17.6,
                'bmr'            => 1400,
                'calorie_target' => 2200,
                'protein_target' => 110,
                'carb_target'    => 280,
                'fat_target'     => 60,
                'status'         => 'success',
                'error_message'  => null,
                'model'          => 'gemini-2.0-flash',
                'tokens_input'   => 800,
                'tokens_output'  => 450,
                'insight'        => "Contoh insight dari AI...\n\n- Poin 1\n- Poin 2",
                'created_at'     => now()->subMinutes(10),
                'updated_at'     => now()->subMinutes(9),
                'raw_payload'    => null,
            ];

            return view('admin.ai.show', compact('log'));
        })->name('ai.logs.show');
    });
