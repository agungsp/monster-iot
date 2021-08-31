<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;
use App\Models\User;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $device = Device::create([
            'uuid' => '858771fe-15bb-4619-a36e-6a8f8094aaa1',
            'created_by' => 0,
            'updated_by' => 0,
        ]);

        $device->addUser(User::where('email', 'vendor@mail.com')->first());
    }
}
