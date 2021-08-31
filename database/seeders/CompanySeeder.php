<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Company 1',
            'email' => 'company1@mail.com',
            'phone' => '0888 6759 9453',
            'website' => 'compani1.website.com',
            'address' => 'Jl. Mawar No.123',
            'created_by' => 0,
            'updated_by' => 0
        ]);
    }
}
