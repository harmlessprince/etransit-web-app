<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ServiceSeeder::class);
//        $this->call(TerminalSeeder::class);
        $this->call(AdminPermissionsSeeder::class);
        $this->call(TripTypeSeeder::class);
        $this->call(BusTypeSeeder::class);
        $this->call(DestinationSeeder::class);
//       $this->call(PickUpSeeder::class);
//        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
//        $this->call(EticketRoleSeeder::class);
        $this->call(EticketPermissionSeeder::class);
        $this->call(OperatorSeeder::class);
//        $this->call(ScheduleSeeder::class);

    }
}
