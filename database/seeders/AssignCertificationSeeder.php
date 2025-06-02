<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AssignCertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view assign certification']);
        Permission::create(['name' => 'create assign certification']);
        Permission::create(['name' => 'edit assign certification']);
        Permission::create(['name' => 'delete assign certification']);
    }
}
