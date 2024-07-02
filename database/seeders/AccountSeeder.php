<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12341234'),
            'roleID' => '1',
            'infoID' => '1',
        ]);
        Account::create([
            'email' => 'nv@gmail.com',
            'password' => Hash::make('12341234'),
            'roleID' => '2',
            'infoID' => '2',
        ]);
    }
}