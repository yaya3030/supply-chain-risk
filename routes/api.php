<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupplyChainApiController;

// Route untuk mengambil data negara
Route::get('/countries', [SupplyChainApiController::class, 'getCountries']);

// Route untuk mengambil data skor risiko
Route::get('/risk', [SupplyChainApiController::class, 'getRiskScores']);