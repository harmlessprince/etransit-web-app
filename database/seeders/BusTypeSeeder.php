<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusType;
class BusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusType::create([
            'type' => 'MicroBus',

        ]);

        BusType::create([
            'type' => 'Coaster Bus',

        ]);

        BusType::create([
            'type' => 'Coach Bus(e.g Marco Polo)',

        ]);

        BusType::create([
            'type' => 'Minibus(e.g Hiace)',

        ]);
    }
}
