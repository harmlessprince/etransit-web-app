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



class LiveOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operators = [
            [
                'company_name' => 'GUO Transport',
                'display_name' => 'GUO',
                'full_name' => 'Frank Edwards'
            ],
            [
                'company_name' => 'ABC Transport',
                'display_name' => 'ABC Transport',
                'full_name' => 'Frank Edwards'
            ],
            [
                'company_name' => 'CHISCO Transport Limited',
                'display_name' => 'CHISCO',
                'full_name' => 'Frank Edwards'
            ],
            [
                'company_name' => 'Etransit West Africa',
                'display_name' => 'Etransit West Africa',
                'full_name' => 'Frank Edwards'
            ]

        ];

        $password  =   'EPa$$word2022';
        $address = '55 Ogunlana Drive, Surulere, Lagos';
        $phone = '09064304717';


        foreach ($operators as $operator => $data) {
            $tenant = new Tenant();
            $tenant->company_name = $data['company_name'];
            $tenant->address = $address;
            $tenant->phone_number = $phone;
            $tenant->display_name  = $data['display_name'];
            $tenant->save();

            if ($tenant) {
                $eticket = new Eticket;
                $eticket->full_name = $data['full_name'];
                $eticket->email = strtolower(str_replace(" ","",$data['display_name']."@etransitafrica.com"));
                $eticket->password = Hash::make($password);
                $eticket->tenant_id = $tenant->id;
                $eticket->save();
            }


            $role =  Role::create(['guard_name' => 'e-ticket', 'name' => 'Super Admin ' . $tenant->display_name, 'tenant_id' => $tenant->id]);

            $eticket->assignRole($role);

            $permissions = Permission::where('guard_name', 'e-ticket')->get();

            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }
    }
}
