<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Halaman daftar paket
Route::view('/paket', 'paket.list')->name('paket.list');


// Proses beli (checkout). Boleh pakai parameter paket biar tahu yang dipilih.
Route::get('/paket/checkout/{plan?}', function ($plan = null) {
    return view('paket.checkout', ['plan' => $plan]); // siapkan view checkout.blade.php
})->name('paket.checkout');

use App\Http\Controllers\OrderController;

Route::get('/proses-beli', [OrderController::class, 'showForm'])->name('proses.beli');

Route::post('/proses-beli', [OrderController::class, 'store'])->name('proses.beli.store');

Route::get('/pesanan/success', function () {
    return view('paket.success');
})->name('pesanan.success');