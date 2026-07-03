<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\RiskScore;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Dummy Negara sesuai Studi Kasus 
        $countries = [
            [
                'name' => 'Germany', 'iso_code' => 'DEU', 'currency' => 'Euro', 
                'currency_code' => 'EUR', 'region' => 'Europe', 'language' => 'German',
                'gdp' => 4456000000000, 'inflation' => 2.1, 'population' => 84000000
            ],
            [
                'name' => 'China', 'iso_code' => 'CHN', 'currency' => 'Yuan', 
                'currency_code' => 'CNY', 'region' => 'Asia', 'language' => 'Chinese',
                'gdp' => 17960000000000, 'inflation' => 1.5, 'population' => 1411000000
            ],
            [
                'name' => 'Indonesia', 'iso_code' => 'IDN', 'currency' => 'Rupiah', 
                'currency_code' => 'IDR', 'region' => 'Asia', 'language' => 'Indonesian',
                'gdp' => 1370000000000, 'inflation' => 2.8, 'population' => 277000000
            ],
            [
                'name' => 'Australia', 'iso_code' => 'AUS', 'currency' => 'Australian Dollar', 
                'currency_code' => 'AUD', 'region' => 'Oceania', 'language' => 'English',
                'gdp' => 1670000000000, 'inflation' => 3.6, 'population' => 26000000
            ],
        ];

        foreach ($countries as $data) {
            $country = Country::create($data);

            // 2. Berikan Nilai Risk Score Awal untuk masing-masing negara [cite: 112, 113]
            RiskScore::create([
                'country_id' => $country->id,
                'weather_risk' => rand(10, 40),
                'inflation_risk' => rand(10, 50),
                'currency_risk' => rand(5, 30),
                'news_risk' => rand(10, 60),
                'total_risk_score' => rand(20, 65) // Sesuai range Low - Medium Risk [cite: 112, 113]
            ]);
        }
    }
}