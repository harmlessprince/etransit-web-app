<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destination::create([
            'location' => 'Lagos',
        ]);
        Destination::create([
            'location' => 'Abuja',
        ]);
        Destination::create([
            'location' => 'PortHarcourt',
        ]);
        Destination::create([
            'location' => 'Ibadan',
        ]);
        Destination::create([
            'location' => 'Owerri',
        ]);
        Destination::create([
            'location' => 'Anambra',
        ]);
    }
}
