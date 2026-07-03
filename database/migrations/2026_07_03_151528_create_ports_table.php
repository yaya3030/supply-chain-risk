<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ports', function (Blueprint $table) {
            $table->id();
            // Menghubungkan pelabuhan ke id negara di tabel countries
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->string('name'); // Nama Pelabuhan
            $table->string('port_code', 10)->nullable(); // Kode Pelabuhan (UN/LOCODE)
            $table->decimal('latitude', 10, 7); // Koordinat Lintang untuk Leaflet.js
            $table->decimal('longitude', 11, 7); // Koordinat Bujur untuk Leaflet.js
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ports');
    }
};