<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view company']);
        Permission::create(['name' => 'create company']);
        Permission::create(['name' => 'edit company']);
        Permission::create(['name' => 'delete company']);
        Permission::create(['name' => 'assign company user']);
        Permission::create(['name' => 'login company']);
    }
}