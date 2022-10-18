<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'full_name'    => 'Test User',
            'email'        => 'testuser@user.com',
            'address'      => 'User addres',
            'username'     => 'testuser',
            'phone_number' => '09000000',
            'password'     => Hash::make('pa$$word'),
            "email_verified_at" => now(),
        ]);
    }
}
