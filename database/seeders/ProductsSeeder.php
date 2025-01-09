<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['game_id' => 1, 'name' => '100 Diamonds', 'price' => 15000, 'description' => 'Product description.', 'status' => 'available'],
            ['game_id' => 1, 'name' => '500+100 Diamonds', 'price' => 45000, 'description' => 'Product description.', 'status' => 'available'],
            ['game_id' => 2, 'name' => '60 Genesis Crystals', 'price' => 35000, 'description' => 'Product description.', 'status' => 'available'],
            ['game_id' => 2, 'name' => '300+30 Genesis Crystals', 'price' => 65000, 'description' => 'Product description.', 'status' => 'available'],
            ['game_id' => 3, 'name' => '75 UC', 'price' => 75000, 'description' => 'Product description.', 'status' => 'available'],
            ['game_id' => 3, 'name' => '260+25 UC', 'price' => 125000, 'description' => 'Product description.', 'status' => 'available'],
        ]);
    }
}
