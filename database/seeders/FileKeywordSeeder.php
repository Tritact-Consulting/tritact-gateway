<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class FileKeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view keyword']);
        Permission::create(['name' => 'create keyword']);
        Permission::create(['name' => 'edit keyword']);
        Permission::create(['name' => 'delete keyword']);
    }
}
