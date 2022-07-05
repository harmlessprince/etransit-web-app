<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class EticketPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.dashboard']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-buses']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-buses']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-terminal']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.view-tenant-bus']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.edit-tenant-bus']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.import.vehicle']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-drivers']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-locations']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.add-eticket-schedule']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-scheduled-trip']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.view-bus-schedules']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-bus-manifest']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-staffs']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.all-cars']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.create-car']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.store-car']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.view-all-cars']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.edit-car']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.update-car']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.edit-car-plan']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.update-car-plan']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.view-car']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.view-all-car-history']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.view-history']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.confirm-drop-off']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.confirm-pick-up']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.mark-as-paid']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.all-tours']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-all-tours']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.add-tours']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.store-tours']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.view-tour']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.all-roles']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-roles']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.view-role']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.add-permission-to-role']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.add-passengers']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.select-seat']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.deselect-seat']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.assign-role']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.add-role']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.add-new-role']);
        Permission::create(['guard_name' => 'e-ticket','name' => 'e-ticket.store-new-role']);


    }
}
