<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VouchersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vouchers')->insert([
            ['code' => 'DISCOUNT10', 'discount' => 10000, 'expiry_date' => now()->addDays(30), 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
