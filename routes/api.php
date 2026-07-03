<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupplyChainApiController;

// Route untuk mengambil data negara
Route::get('/countries', [SupplyChainApiController::class, 'getCountries']);

// Route untuk mengambil data skor risiko
Route::get('/risk', [SupplyChainApiController::class, 'getRiskScores']);

// Route untuk mengambil berita hasil analisis sentimen
Route::get('/news', [SupplyChainApiController::class, 'getNews']);

// Route untuk mengambil data integrasi kurs mata uang real-time
Route::get('/currency', [SupplyChainApiController::class, 'getCurrency']);