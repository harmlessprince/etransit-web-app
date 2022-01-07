<?php

namespace Database\Seeders;

use App\Models\Pickup;
use Illuminate\Database\Seeder;

class PickUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pickup::create([
            'location' => 'Lagos',
        ]);
        Pickup::create([
            'location' => 'Abuja',
        ]);
        Pickup::create([
            'location' => 'PortHarcourt',
        ]);
        Pickup::create([
            'location' => 'Ibadan',
        ]);
        Pickup::create([
            'location' => 'Owerri',
        ]);
        Pickup::create([
            'location' => 'Anambra',
        ]);
    }
}
