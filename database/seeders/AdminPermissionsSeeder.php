<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['guard_name' => 'admin','name' => 'admin.']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.dashboard']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.manage.vehicle']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.manage.bus']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.manage-fetch-all-buses']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.view.bus']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.bus.schedules']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.view-bus-schedule']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.add.vehicle']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.fetch-all-tenants-terminal']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.cruise.event']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.customers.list']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.fetch-tenants']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.get-operator-users']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.fetch-roles']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.fetch-permissions']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.add-service-to-tenant']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.fetch-all-cars']);
        Permission::create(['guard_name' => 'admin','name' => 'admin.fetch-all-become-partners']);




    }
}
