<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Port;

class PortSeeder extends Seeder
{
    public function run(): void
    {
        // Mengambil data negara yang sudah di-seed sebelumnya
        $idn = Country::where('iso_code', 'IDN')->first();
        $chn = Country::where('iso_code', 'CHN')->first();
        $deu = Country::where('iso_code', 'DEU')->first();
        $aus = Country::where('iso_code', 'AUS')->first();

        $ports = [
            [
                'country_id' => $idn->id,
                'name' => 'Port of Tanjung Priok (Jakarta)',
                'port_code' => 'IDTPP',
                'latitude' => -6.1000000,
                'longitude' => 106.8833000,
            ],
            [
                'country_id' => $chn->id,
                'name' => 'Port of Shanghai',
                'port_code' => 'CNSHA',
                'latitude' => 31.2304000,
                'longitude' => 121.4737000,
            ],
            [
                'country_id' => $deu->id,
                'name' => 'Port of Hamburg',
                'port_code' => 'DEHAM',
                'latitude' => 53.5458000,
                'longitude' => 9.9631000,
            ],
            [
                'country_id' => $aus->id,
                'name' => 'Port of Sydney',
                'port_code' => 'AUSYD',
                'latitude' => -33.8617000,
                'longitude' => 151.2108000,
            ],
        ];

        foreach ($ports as $portData) {
            Port::create($portData);
        }
    }
}