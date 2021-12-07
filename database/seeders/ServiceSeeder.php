<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => "Bus Booking"
        ]);

        Service::create([
            'name' => "Train Booking"
        ]);

        Service::create([
            'name' => "Ferry Booking"
        ]);

        Service::create([
            'name' => "Flight Booking"
        ]);

        Service::create([
            'name' => "Hotel Booking"
        ]);
        Service::create([
            'name' => "Car Hire"
        ]);

        Service::create([
            'name' => "Boat Cruise"
        ]);
        Service::create([
            'name' => "Tour Packages"
        ]);
        Service::create([
            'name' => "Parcel"
        ]);
    }
}
