<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CertificationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view certification category']);
        Permission::create(['name' => 'create certification category']);
        Permission::create(['name' => 'edit certification category']);
        Permission::create(['name' => 'delete certification category']);
    }
}
