<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view guide']);
        Permission::create(['name' => 'create guide']);
        Permission::create(['name' => 'edit guide']);
        Permission::create(['name' => 'delete guide']);
    }
}
