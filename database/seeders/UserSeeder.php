<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Restoran',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 1,
            'nomorTelepon' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Owner
        DB::table('users')->insert([
            'name' => 'Pemilik Restoran',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('owner123'),
            'role' => 2,
            'nomorTelepon' => '081234567891',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pelanggan
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => Hash::make('customer123'),
            'role' => 3,
            'nomorTelepon' => '081234567892',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
