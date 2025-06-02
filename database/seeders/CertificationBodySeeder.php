<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CertificationBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view certification body']);
        Permission::create(['name' => 'create certification body']);
        Permission::create(['name' => 'edit certification body']);
        Permission::create(['name' => 'delete certification body']);
    }
}
