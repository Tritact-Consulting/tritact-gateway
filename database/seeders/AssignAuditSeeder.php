<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AssignAuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view assign audit']);
        Permission::create(['name' => 'create assign audit']);
        Permission::create(['name' => 'edit assign audit']);
        Permission::create(['name' => 'delete assign audit']);
    }
}
