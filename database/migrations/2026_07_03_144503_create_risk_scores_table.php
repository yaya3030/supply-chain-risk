<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('risk_scores', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel countries (jika negara dihapus, skor ikut terhapus)
        $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
        $table->integer('weather_risk')->default(0); // Risiko Cuaca [cite: 107, 218]
        $table->integer('inflation_risk')->default(0); // Risiko Inflasi [cite: 108, 219]
        $table->integer('currency_risk')->default(0); // Risiko Nilai Tukar [cite: 109, 221]
        $table->integer('news_risk')->default(0); // Risiko Sentimen Berita Geopolitik [cite: 109, 220]
        $table->integer('total_risk_score')->default(0); // Hasil Akhir Algoritma Scoring [cite: 106, 110, 222]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_scores');
    }
};
