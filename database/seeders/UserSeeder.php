<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 user admin tetap (agar kamu bisa login)
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Membuat 100 data user acak menggunakan Factory
        User::factory()->count(100)->create();
    }
}