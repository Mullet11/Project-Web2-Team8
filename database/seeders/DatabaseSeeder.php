<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'identity_number' => 'admin123',
            'email' => 'admin@smartclass.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Mahasiswa Test',
            'identity_number' => '123456789',
            'email' => 'mhs@ulm.ac.id',
            'password' => 'password',
            'role' => 'mahasiswa',
        ]);

        $this->call([
            RoomSeeder::class,
        ]);
    }
}
