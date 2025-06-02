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
        $roles = ['role','create role', 'edit role', 'delete role'];
        foreach ($roles as $value) {
            Permission::create([
                'name' => $value
            ]);
        }

        $roles_permission = ['permission','create permission', 'edit permission', 'delete permission'];
        foreach ($roles_permission as $value) {
            Permission::create([
                'name' => $value
            ]);
        }

    }
}
