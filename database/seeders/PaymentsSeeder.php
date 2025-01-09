<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            ['order_id' => 1, 'payment_method' => 'bank_transfer', 'transaction_id' => 'PAY12345', 'amount' => 125000, 'status' => 'success', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
