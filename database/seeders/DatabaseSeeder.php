<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            GamesSeeder::class,
            ProductsSeeder::class,
            VouchersSeeder::class,
            OrdersSeeder::class,
            PaymentsSeeder::class,
            ReportsSeeder::class,
            LogsSeeder::class,
        ]);
    }
}
