<?php

namespace App\Models; // <-- PERIKSA APAKAH BARIS INI ADA DAN SAMA PERSIS

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'iso_code', 'currency', 'currency_code', 'region', 'language', 'gdp', 'inflation', 'population'
    ];

    public function riskScore()
    {
        return $this->hasOne(RiskScore::class);
    }
}