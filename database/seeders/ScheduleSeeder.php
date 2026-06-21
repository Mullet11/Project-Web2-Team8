<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::insert([
            [
                'room_id' => 1,
                'title' => 'Pemrograman Web II',
                'lecturer_name' => 'M. Rizki, M.Kom.',
                'day' => 'Senin',
                'start_time' => '08:00:00',
                'end_time' => '09:40:00',
                'type' => 'fixed_class',
            ],
            [
                'room_id' => 1,
                'title' => 'Rekayasa Perangkat Lunak',
                'lecturer_name' => 'Naufal K., M.T.',
                'day' => 'Senin',
                'start_time' => '10:30:00',
                'end_time' => '12:10:00',
                'type' => 'fixed_class',
            ],
            [
                'room_id' => 2,
                'title' => 'Basis Data',
                'lecturer_name' => 'Dr. Rakha A.',
                'day' => 'Selasa',
                'start_time' => '08:50:00',
                'end_time' => '11:20:00',
                'type' => 'fixed_class',
            ],
            [
                'room_id' => 7,
                'title' => 'Praktikum Jaringan Komputer',
                'lecturer_name' => 'Rizki A. M., M.Cs.',
                'day' => 'Rabu',
                'start_time' => '13:00:00',
                'end_time' => '15:30:00',
                'type' => 'fixed_class',
            ],
            [
                'room_id' => 9,
                'title' => 'Kecerdasan Buatan',
                'lecturer_name' => 'Prof. Dr. Ir. H. Naufal',
                'day' => 'Kamis',
                'start_time' => '09:40:00',
                'end_time' => '12:10:00',
                'type' => 'fixed_class',
            ],
        ]);
    }
}
