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
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.dashboard']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-buses']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-buses']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-terminal']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.view-tenant-bus']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.edit-tenant-bus']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.import.vehicle']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-drivers']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-locations']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.add-eticket-schedule']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-scheduled-trip']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.view-bus-schedules']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-bus-manifest']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-tenant-staffs']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.all-cars']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.create-car']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.store-car']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.view-all-cars']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.edit-car']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.update-car']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.edit-car-plan']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.update-car-plan']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.view-car']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.view-all-car-history']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.view-history']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.confirm-drop-off']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.confirm-pick-up']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.mark-as-paid']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.all-tours']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-all-tours']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.add-tours']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.store-tours']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.view-tour']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.all-roles']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.fetch-roles']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.view-role']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.add-permission-to-role']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.add-passengers']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.select-seat']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.deselect-seat']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.partner-driver-view-profile']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.set-drivers-rate']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.assign-role']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.add-role']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.add-new-role']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.store-new-role']);
        Permission::updateOrCreate(['guard_name' => 'e-ticket','name' => 'e-ticket.delete-tenant-bus']);


    }
}
