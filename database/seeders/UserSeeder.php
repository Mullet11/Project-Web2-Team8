<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Administrator',
            'identity_number' => 'admin123',
            'email' => 'admin@smartclass.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        // 2. Akun Mahasiswa
        User::create([
            'name' => 'Mahasiswa Test',
            'identity_number' => '123456789',
            'email' => 'mhs@mhs.ulm.ac.id',
            'whatsapp' => '081234567891',
            'password' => 'password123',
            'role' => 'mahasiswa',
            'faculty' => 'Teknik',
            'study_program' => 'Teknologi Informasi',
        ]);

        // 3. Akun Dosen
        User::create([
            'name' => 'Dosen Test',
            'identity_number' => '987654321',
            'email' => 'dosen@ulm.ac.id',
            'whatsapp' => '081234567892',
            'password' => 'password123',
            'role' => 'dosen',
            'faculty' => 'Teknik',
            'study_program' => 'Teknologi Informasi',
        ]);
    }
}
