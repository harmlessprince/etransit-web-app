<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bus::create([
            'bus_type' => 'Toyota Sienna',
            'bus_model' => 'Saloon Car',
            'bus_registration' => 'LND 141 QR',
            'air_conditioning' => 1,
            'wheels' => 12,
            'seater' => 5,
            'tenant_id' => 1,
            'service_id' => 1,
        ]);

        Bus::create([
            'bus_type' => 'Toyota Liat',
            'bus_model' => 'Bus',
            'bus_registration' => 'LND 141 QP',
            'air_conditioning' => 1,
            'wheels' => 12,
            'seater' => 20,
            'tenant_id' => 1,
            'service_id' => 1,
        ]);

        Bus::create([
            'bus_type' => 'Toyota Bus2',
            'bus_model' => 'Saloon Car',
            'bus_registration' => 'LND 121 XL',
            'air_conditioning' => 1,
            'wheels' => 12,
            'seater' => 21,
            'tenant_id' => 1,
            'service_id' => 1,
        ]);

        Bus::create([
            'bus_type' => 'Toyota Bus3',
            'bus_model' => 'Saloon Car',
            'bus_registration' => 'LND 112 JL',
            'air_conditioning' => 0,
            'wheels' => 4,
            'seater' => 22,
            'tenant_id' => 1,
            'service_id' => 1,
        ]);
    }
}
