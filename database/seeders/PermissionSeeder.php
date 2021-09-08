<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'viewDashboard']);
        Permission::create(['name' => 'viewContact']);
        Permission::create(['name' => 'controlEngine']);

        Permission::create(['name' => 'viewUsers']);
        Permission::create(['name' => 'createUsers']);
        Permission::create(['name' => 'createUserClient']);
        Permission::create(['name' => 'editUsers']);
        Permission::create(['name' => 'editUserClient']);
        Permission::create(['name' => 'deleteUsers']);

        Permission::create(['name' => 'viewDevices']);
        Permission::create(['name' => 'createDevices']);
        Permission::create(['name' => 'editDevices']);
        Permission::create(['name' => 'deleteDevices']);

        Permission::create(['name' => 'viewCompanies']);
        Permission::create(['name' => 'createCompanies']);
        Permission::create(['name' => 'editCompanies']);
        Permission::create(['name' => 'deleteCompanies']);

        Permission::create(['name' => 'viewContracts']);
        Permission::create(['name' => 'createContracts']);
        Permission::create(['name' => 'editContracts']);
        Permission::create(['name' => 'deleteContracts']);

        Permission::create(['name' => 'viewRFID']);
        Permission::create(['name' => 'createRFID']);
        Permission::create(['name' => 'editRFID']);
        Permission::create(['name' => 'deleteRFID']);




        //===== Give Permission =====

        // super admin
        $role = Role::findByName('superadmin');
        $role->givePermissionTo(Permission::all());

        // admin / perusahaan
        $role = Role::findByName('admin');
        $role->givePermissionTo(
            'viewDashboard', 'viewContact',
            'viewUsers', 'createUserClient', 'editUserClient', 'deleteUsers',
            'viewContracts',
            'viewDevices', 'controlEngine',
            'viewRFID', 'editRFID'
        );

        // user / client
        $role = Role::findByName('user');
        $role->givePermissionTo('viewDashboard', 'viewContact');

        
    }
}
