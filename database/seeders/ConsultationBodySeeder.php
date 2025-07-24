<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ConsultationBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view consultation body']);
        Permission::create(['name' => 'create consultation body']);
        Permission::create(['name' => 'edit consultation body']);
        Permission::create(['name' => 'delete consultation body']);
    }
}
