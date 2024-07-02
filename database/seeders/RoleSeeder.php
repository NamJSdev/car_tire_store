<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'desc' => 'Quản trị viên',
        ]);
        Role::create([
            'name' => 'personnel',
            'desc' => 'Nhân Viên',
        ]);
    }
}