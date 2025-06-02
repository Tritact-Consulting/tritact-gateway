<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view tag']);
        Permission::create(['name' => 'create tag']);
        Permission::create(['name' => 'edit tag']);
        Permission::create(['name' => 'delete tag']);
    }
}
