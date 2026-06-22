<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'identity_number' => 'admin123',
            'email' => 'admin@smartclass.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Mahasiswa Test',
            'identity_number' => '123456789',
            'email' => 'mhs@ulm.ac.id',
            'password' => 'password',
            'faculty' => 'Teknik',
            'study_program' => 'Teknologi Informasi',
            'role' => 'mahasiswa',
        ]);

        $this->call([
            RoomSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
