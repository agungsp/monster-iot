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
        $superadmin = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('12345678'),
            'avatar' => null,
        ]);

        $superadmin->assignRole('superadmin');

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
            'avatar' => null,
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('12345678'),
            'avatar' => null,
        ]);

        $user->assignRole('user');
    }
}
