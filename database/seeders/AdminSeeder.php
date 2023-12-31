<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
       app()[PermissionRegistrar::class]->forgetCachedPermissions();

       $user =  Admin::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('pa$$word')
        ]);
        $role = Role::create(['guard_name' => 'admin','name' => 'Super Admin']);

        $user->assignRole($role);

        $permissions = Permission::where('guard_name' ,'=','admin')->get();

        foreach($permissions as $permission)
        {
            $role->givePermissionTo($permission);
        }


    }
}
