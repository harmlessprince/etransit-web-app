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
            'car_type' => 'Toyota Sienna',
            'car_model' => 'Saloon Car',
            'car_registration' => 'LND 141 QR',
            'air_conditioning' => 1,
            'wheels' => 12,
            'seater' => 5,
        ]);

        Bus::create([
            'car_type' => 'Toyota Liat',
            'car_model' => 'Bus',
            'car_registration' => 'LND 141 QR',
            'air_conditioning' => 1,
            'wheels' => 12,
            'seater' => 20,
        ]);

        Bus::create([
            'car_type' => 'Toyota Bus2',
            'car_model' => 'Saloon Car',
            'car_registration' => 'LND 141 QR',
            'air_conditioning' => 1,
            'wheels' => 12,
            'seater' => 21,
        ]);

        Bus::create([
            'car_type' => 'Toyota Bus3',
            'car_model' => 'Saloon Car',
            'car_registration' => 'LND 141 QR',
            'air_conditioning' => 0,
            'wheels' => 4,
            'seater' => 22,
        ]);
    }
}
