<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ConsultationSummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view consultation summary']);
        Permission::create(['name' => 'create consultation summary']);
        Permission::create(['name' => 'edit consultation summary']);
        Permission::create(['name' => 'delete consultation summary']);
    }
}
