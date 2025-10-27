<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/kalori-lab', function () {
    return view('labkalori');
});

Route::get('/menu', function () {
    return view('components.food-menu');
});