<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskScore extends Model
{
    use HasFactory;

    // Menentukan field yang boleh diisi secara massal
    protected $fillable = [
        'country_id',
        'weather_risk',
        'inflation_risk',
        'currency_risk',
        'news_risk',
        'total_risk_score',
    ];

    /**
     * Relasi ke model Country (Satu skor risiko dimiliki oleh satu negara)
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}