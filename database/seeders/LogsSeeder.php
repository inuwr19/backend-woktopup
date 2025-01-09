<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('logs')->insert([
            ['user_id' => 1, 'action' => 'login', 'description' => 'Admin logged in.', 'ip_address' => '127.0.0.1', 'created_at' => now()],
            ['user_id' => 2, 'action' => 'purchase', 'description' => 'User purchased Product 1.', 'ip_address' => '127.0.0.1', 'created_at' => now()],
        ]);
    }
}
