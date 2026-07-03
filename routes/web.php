<?php

use Illuminate\Support\Facades\Route;

// Mengarahkan halaman utama ke view dashboard
Route::get('/', function () {
    return view('dashboard');
});