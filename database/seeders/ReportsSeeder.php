<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reports')->insert([
            ['report_date' => now()->toDateString(), 'total_orders' => 5, 'total_revenue' => 125000, 'total_products_sold' => 2, 'top_product_id' => 1, 'top_game_id' => 1, 'status' => 'draft', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
