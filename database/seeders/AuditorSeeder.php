<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view auditor']);
        Permission::create(['name' => 'create auditor']);
        Permission::create(['name' => 'edit auditor']);
        Permission::create(['name' => 'delete auditor']);
    }
}
