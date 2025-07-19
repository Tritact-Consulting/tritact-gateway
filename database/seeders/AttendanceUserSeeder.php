<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AttendanceUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'all attendance']);
        Permission::create(['name' => 'view attendance']);
        
        $attendanceRole = Role::create(['name' => 'attendance']);
        $attendanceRole->givePermissionTo(['view attendance']);
    }
}
