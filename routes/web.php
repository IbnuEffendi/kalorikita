<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/kalori-lab', function () {
    return view('labkalori');
});

Route::get('/menu', function () {
    return view('components.food-menu');
});