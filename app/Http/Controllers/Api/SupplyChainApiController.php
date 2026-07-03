<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\RiskScore;
use Illuminate\Http\Request;

class SupplyChainApiController extends Controller
{
    /**
     * GET /api/countries
     * Mengambil semua data negara beserta informasi dasarnya.
     */
    public function getCountries()
    {
        try {
            $countries = Country::all();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Data negara berhasil diambil',
                'data' => $countries
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/risk
     * Mengambil data skor risiko yang terhubung dengan negara.
     */
    public function getRiskScores()
    {
        try {
            // Mengambil data skor risiko beserta informasi negaranya
            $risks = RiskScore::with('country')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data skor risiko berhasil diambil',
                'data' => $risks
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data risiko: ' . $e->getMessage()
            ], 500);
        }
    }
}