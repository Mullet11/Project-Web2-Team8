<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Admin Utama',
            'identity_number' => 'admin123',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        // Akun User/Mahasiswa
        User::create([
            'name' => 'Rakha Mahasiswa',
            'identity_number' => '123456789',
            'role' => 'user',
            'password' => Hash::make('password123'),
        ]);
    }
}
