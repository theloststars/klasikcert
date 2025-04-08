<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'admin access']);
        Permission::create(['name' => 'systems control']);
        Permission::create(['name' => 'contents control']);

        Permission::create(['name' => 'permissions create']);
        Permission::create(['name' => 'permissions read']);
        Permission::create(['name' => 'permissions update']);
        Permission::create(['name' => 'permissions delete']);

        Permission::create(['name' => 'roles create']);
        Permission::create(['name' => 'roles read']);
        Permission::create(['name' => 'roles update']);
        Permission::create(['name' => 'roles delete']);

        Permission::create(['name' => 'users create']);
        Permission::create(['name' => 'users read']);
        Permission::create(['name' => 'users update']);
        Permission::create(['name' => 'users store']);

        Permission::create(['name' => 'blogs create']);
        Permission::create(['name' => 'blogs read']);
        Permission::create(['name' => 'blogs update']);
        Permission::create(['name' => 'blogs delete']);

        Permission::create(['name' => 'certificates create']);
        Permission::create(['name' => 'certificates read']);
        Permission::create(['name' => 'certificates update']);
        Permission::create(['name' => 'certificates delete']);

        Permission::create(['name' => 'standards create']);
        Permission::create(['name' => 'standards read']);
        Permission::create(['name' => 'standards update']);
        Permission::create(['name' => 'standards delete']);

        Permission::create(['name' => 'services create']);
        Permission::create(['name' => 'services read']);
        Permission::create(['name' => 'services update']);
        Permission::create(['name' => 'services delete']);

        Permission::create(['name' => 'clients create']);
        Permission::create(['name' => 'clients read']);
        Permission::create(['name' => 'clients update']);
        Permission::create(['name' => 'clients delete']);

        Permission::create(['name' => 'feedback create']);
        Permission::create(['name' => 'feedback read']);
        Permission::create(['name' => 'feedback update']);
        Permission::create(['name' => 'feedback delete']);

        Permission::create(['name' => 'about read']);
        Permission::create(['name' => 'about update']);

        Permission::create(['name' => 'application form access']);
    }
}
