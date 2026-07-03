<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\RiskScore;
use App\Models\PositiveWord;
use App\Models\NegativeWord;
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

    public function getNews()
    {
        try {
            // 1. Ambil data kamus kata dari database dalam bentuk array
            $positiveWords = PositiveWord::pluck('word')->toArray();
            $negativeWords = NegativeWord::pluck('word')->toArray();

            // 2. Berita dummy contoh yang mensimulasikan data dari GNews API [cite: 373, 428, 429]
            $articles = [
                [
                    'title' => 'Global Shipping Routes Improve and Ensure Stable Supply Chain Profit',
                    'source' => 'Logistics Intelligence',
                ],
                [
                    'title' => 'Inflation increases while exports decrease due to war and port crisis',
                    'source' => 'Global Economy Report',
                ],
                [
                    'title' => 'Port of Shanghai Experiencing Minor Delay But Shows Growth Trend',
                    'source' => 'Maritime News',
                ]
            ];

            $analyzedNews = [];

            // 3. Proses Algoritma Lexicon-Based Sentiment Analysis [cite: 444]
            foreach ($articles as $article) {
                // Bersihkan teks kalimat menjadi huruf kecil dan pecah menjadi kata per kata
                $cleanTitle = strtolower(preg_replace('/[^a-z\s]/', '', $article['title']));
                $words = explode(' ', $cleanTitle);

                $positiveScore = 0; // [cite: 442]
                $negativeScore = 0; // [cite: 443]

                foreach ($words as $word) {
                    if (in_array($word, $positiveWords)) {
                        $positiveScore++; // [cite: 445, 446]
                    }
                    if (in_array($word, $negativeWords)) {
                        $negativeScore++; // [cite: 448, 449]
                    }
                }

                // Menentukan label akhir sentimen [cite: 452, 453, 454]
                if ($positiveScore > $negativeScore) {
                    $sentiment = 'Positive';
                } elseif ($negativeScore > $positiveScore) {
                    $sentiment = 'Negative';
                } else {
                    $sentiment = 'Neutral';
                }

                // Gabungkan data asli dengan hasil analisis analitik
                $analyzedNews[] = [
                    'title' => $article['title'],
                    'source' => $article['source'],
                    'metrics' => [
                        'positive_matches' => $positiveScore,
                        'negative_matches' => $negativeScore,
                        'sentiment_result' => $sentiment // [cite: 452]
                    ]
                ];
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Berita intelijen logistik berhasil dianalisis',
                'data' => $analyzedNews
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menganalisis berita: ' . $e->getMessage()
            ], 500);
        }
    }
}