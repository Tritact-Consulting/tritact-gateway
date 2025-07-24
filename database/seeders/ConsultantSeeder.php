<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ConsultantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view consultant']);
        Permission::create(['name' => 'create consultant']);
        Permission::create(['name' => 'edit consultant']);
        Permission::create(['name' => 'delete consultant']);
    }
}
