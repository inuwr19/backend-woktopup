<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            ['user_id' => 2, 'product_id' => 1, 'game_account_id' => 'user001', 'quantity' => 2, 'total_price' => 120000, 'payment_method' => 'bank_transfer', 'status' => 'pending', 'transaction_id' => 'TRX12345', 'payment_proof' => null, 'voucher_id' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
