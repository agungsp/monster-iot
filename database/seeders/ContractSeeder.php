<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;
use App\Models\Device;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contract = Contract::create([
            'company_id' => 1,
            'started_at' => now(),
            'expired_at' => now()->addDays(7),
            'created_by' => 0,
            'updated_by' => 0
        ]);

        $devices = Device::all();
        $contract->updateDevice($devices);
        foreach ($contract->company->users as $user) {
            $user->updateDevice($devices);
        }
    }
}
