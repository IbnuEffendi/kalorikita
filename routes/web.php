<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/kalori-lab', function () {
    return view('');
});

Route::get('/menu', function () {
    return view('');
});