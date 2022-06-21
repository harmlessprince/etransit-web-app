<?php

namespace Database\Seeders;

use App\Mail\OperatorCredentials;
use App\Models\Eticket;
use App\Models\Tenant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $password  =   'password';
        $tenant = new Tenant();
        $tenant->company_name = 'GOD IS GOOD MOTORS';
        $tenant->address ='IKEJA LAGOS';
        $tenant->phone_number = '0809873536';
        $tenant->display_name  = 'GIG';
        $tenant->save();

        if($tenant)
        {
            $eticket = new Eticket;
            $eticket->full_name = 'Eticket TestUser';
            $eticket->email = 'eticket1@user.com';
            $eticket->password = Hash::make($password);
            $eticket->tenant_id = $tenant->id;
            $eticket->save();
        }


        $role =  Role::create(['guard_name' => 'e-ticket','name' => 'Super Admin '.$tenant->display_name ,'tenant_id' => $tenant->id]);

        $eticket->assignRole($role);

        $permissions = Permission::where('guard_name' ,'e-ticket')->get();

        foreach($permissions as $permission)
        {
            $role->givePermissionTo($permission);
        }

        $password  =   'password';
        $tenant = new Tenant();
        $tenant->company_name = 'AGUFURE MOTORS';
        $tenant->address ='IKEJA LAGOS';
        $tenant->phone_number = '0809873526';
        $tenant->display_name  = 'AGFL';
        $tenant->save();

        if($tenant)
        {
            $eticket = new Eticket;
            $eticket->full_name = 'Eticket TestUser2';
            $eticket->email = 'eticket2@user.com';
            $eticket->password = Hash::make($password);
            $eticket->tenant_id = $tenant->id;
            $eticket->save();
        }


        $role =  Role::create(['guard_name' => 'e-ticket','name' => 'Super Admin '.$tenant->display_name ,'tenant_id' => $tenant->id]);

        $eticket->assignRole($role);

        $permissions = Permission::where('guard_name' ,'e-ticket')->get();

        foreach($permissions as $permission)
        {
            $role->givePermissionTo($permission);
        }

    }
}
