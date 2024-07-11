<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'tenPhuongThuc' => 'Tiền Mặt',
        ]);
        Payment::create([
            'tenPhuongThuc' => 'Chuyển Khoản',
        ]);
    }
}