<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\RiskScore;
use App\Models\PositiveWord;
use App\Models\NegativeWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    /**
 * GET /api/currency
 * Mengambil data kurs mata uang real-time terhadap USD & menyediakan data tren grafik.
 */
    public function getCurrency(Request $request)
    {
        try {
            // 1. Ambil data kurs real-time menggunakan HTTP Client Laravel (Tanpa API Key)
            $response = Http::get('https://open.er-api.com/v6/latest/USD');

            if ($response->successful()) {
                $allRates = $response->json()['rates'];

                // 2. Filter mata uang khusus untuk negara yang ada di studi kasus kita
                // USD (Base), IDR (Indonesia), EUR (Jerman), CNY (China), AUD (Australia)
                $supportedCurrencies = ['USD', 'IDR', 'EUR', 'CNY', 'AUD'];
                $filteredRates = array_intersect_key($allRates, array_flip($supportedCurrencies));

                // 3. Menyediakan simulasi array data tren historis perubahan kurs 7 hari terakhir
                // Ini sangat krusial untuk mempermudah visualisasi komponen Chart.js nanti
                $trends = [
                    'IDR' => [16200, 16250, 16310, 16280, 16350, 16410, round($filteredRates['IDR'], 2)],
                    'EUR' => [0.91, 0.92, 0.91, 0.93, 0.92, 0.92, round($filteredRates['EUR'], 4)],
                    'CNY' => [7.21, 7.23, 7.22, 7.25, 7.24, 7.26, round($filteredRates['CNY'], 4)],
                    'AUD' => [1.48, 1.49, 1.51, 1.50, 1.52, 1.51, round($filteredRates['AUD'], 4)],
                ];

                return response()->json([
                    'status' => 'success',
                    'message' => 'Data kurs mata uang real-time berhasil diperbarui',
                    'base_currency' => 'USD',
                    'exchange_rates' => $filteredRates,
                    'chart_trends' => $trends
                ], 200);
            }

            throw new \Exception("Gagal terhubung dengan layanan ExchangeRate API.");

        } catch (\Exception $e) {
            // Fallback aman: Jika laptop tidak tersambung internet, API tidak akan crash
            $fallbackRates = ['USD' => 1, 'IDR' => 16450, 'EUR' => 0.93, 'CNY' => 7.27, 'AUD' => 1.53];
            
            return response()->json([
                'status' => 'warning',
                'message' => 'Menggunakan cadangan data lokal (API Offline): ' . $e->getMessage(),
                'base_currency' => 'USD',
                'exchange_rates' => $fallbackRates
            ], 200);
        }
    }
}