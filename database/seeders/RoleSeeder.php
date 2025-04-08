<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'super admin']);
        $admin = Role::create(['name' => 'admin']);

        $superAdmin->syncPermissions(['admin access']);
        $admin->syncPermissions([
            'admin access',
            'standards create', 'standards read', 'standards update', 'standards delete',
            'certificates create', 'certificates read', 'certificates update', 'certificates delete',
            'clients create', 'clients read', 'clients update', 'clients delete',
            'blogs create', 'blogs read', 'blogs update', 'blogs delete',
            'services create', 'services read', 'services update', 'services delete',
            'feedback create', 'feedback read', 'feedback update', 'feedback delete',
            'about read', 'about update',
            'application form access'
        ]);
    }
}
