<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Users and assign role
        $vendor = User::create([
            'name' => 'vendor',
            'email' => 'vendor@mail.com',
            'password' => bcrypt('12345678'),
            'is_active' => 1
        ]);
        $vendor->assignRole('superadmin');

        $userCompany = User::create([
            'name' => 'User Company',
            'email' => 'user.company@mail.com',
            'password' => bcrypt('12345678'),
            'company_id' => 1,
            'is_active' => 1
        ]);
        $userCompany->assignRole('admin');

        // for ($i = 0; $i < 1; $i++) {
        //     $user = User::create([
        //         'name' => 'User ' . ($i+1),
        //         'email' => 'user'. ($i+1) .'@mail.com',
        //         'password' => bcrypt('12345678'),
        //         'company_id' => 1
        //     ]);
        //     $user->assignRole('user');
        // }
    }
}
