<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PartnerPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view partner']);
        Permission::create(['name' => 'create partner']);
        Permission::create(['name' => 'edit partner']);
        Permission::create(['name' => 'delete partner']);
    }
}
