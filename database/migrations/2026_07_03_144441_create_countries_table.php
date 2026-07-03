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
    Schema::create('countries', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Germany, Indonesia [cite: 94, 96]
        $table->string('iso_code', 3)->unique(); // Contoh: DE, ID, CN, AU
        $table->string('currency'); // Mata uang [cite: 66, 102]
        $table->string('currency_code', 5); // Kode kurs [cite: 66]
        $table->string('region'); // Wilayah/Benua [cite: 67]
        $table->string('language'); // Bahasa resmi [cite: 68]
        $table->bigInteger('gdp')->nullable(); // GDP Tren [cite: 57, 140]
        $table->decimal('inflation', 5, 2)->nullable(); // Inflasi [cite: 58, 100]
        $table->bigInteger('population')->nullable(); // Populasi [cite: 59, 101]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
