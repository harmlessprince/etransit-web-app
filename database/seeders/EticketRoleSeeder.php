<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class EticketRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['guard_name' => 'e-ticket','name' => 'Super Admin']);
        Role::create(['guard_name' => 'e-ticket','name' => 'Admin']);
        Role::create(['guard_name' => 'e-ticket','name' => 'Support']);
        Role::create(['guard_name' => 'e-ticket','name' => 'Account']);
    }
}
