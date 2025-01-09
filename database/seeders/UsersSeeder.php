<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('password'), 'phone_number' => '1234567890', 'role' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ikhsan', 'email' => 'user@example.com', 'password' => Hash::make('password'), 'phone_number' => '0987654321', 'role' => 'user', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
