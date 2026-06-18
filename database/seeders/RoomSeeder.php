<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::insert([
            ['name' => 'Ruang Teater 1', 'building' => 'Gedung A', 'capacity' => 100, 'facilities' => 'Proyektor, AC, Sound System', 'status' => 'available'],
            ['name' => 'Kelas A1', 'building' => 'Gedung B', 'capacity' => 40, 'facilities' => 'Proyektor, Papan Tulis', 'status' => 'available'],
            ['name' => 'Kelas A2', 'building' => 'Gedung B', 'capacity' => 30, 'facilities' => 'Papan Tulis', 'status' => 'inactive'],
        ]);
    }
}
