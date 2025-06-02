<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view doc']);
        Permission::create(['name' => 'create doc']);
        Permission::create(['name' => 'edit doc']);
        Permission::create(['name' => 'delete doc']);
    }
}
