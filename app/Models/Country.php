<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // Menentukan field yang boleh diisi secara massal
    protected $fillable = [
        'name',
        'iso_code',
        'currency',
        'currency_code',
        'region',
        'language',
        'gdp',
        'inflation',
        'population',
    ];

    /**
     * Relasi ke model RiskScore (Satu negara memiliki satu catatan skor risiko)
     */
    public function riskScore()
    {
        return $this->hasOne(RiskScore::class);
    }
}