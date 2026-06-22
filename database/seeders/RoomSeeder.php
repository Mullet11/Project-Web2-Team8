<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::insert([
            [
                'name' => 'Ruang A13',
                'campus' => 'Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            [
                'name' => 'Ruang A14',
                'campus' => 'Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 70,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            [
                'name' => 'Ruang A15',
                'campus' => 'Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            [
                'name' => 'Ruang A16',
                'campus' => 'Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            /* Ruang Laboratorium */
            [
                'name' => 'Ruang Laboratorium Komputer Dasar',
                'campus' => 'Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'lab',
                'capacity' => 33,
                'facilities' => 'AC, Proyektor, Papan Tulis, Komputer, Internet',
                'status' => 'available',
            ],

            [
                'name' => 'Laboratorium MTI',
                'campus' => 'Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'lab',
                'capacity' => 33,
                'facilities' => 'AC, Proyektor, Papan Tulis, Komputer, Internet',
                'status' => 'available',
            ],

            [
                'name' => 'Laboratorium Big Data',
                'campus' => 'Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'lab',
                'capacity' => 50,
                'facilities' => 'AC, Proyektor, Papan Tulis, Komputer, Internet',
                'status' => 'available',
            ],

            /* Ruang Aula */
            [
                'name' => 'Aula Pasca Sarjana',
                'campus' => 'Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'aula',
                'capacity' => 100,
                'facilities' => 'AC, Proyektor, Sound System',
                'status' => 'available',
            ],

            /* Ruang Theater */
            [
                'name' => 'Lecture Theater ULM',
                'campus' => 'Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'theater',
                'capacity' => 150,
                'facilities' => 'AC, Proyektor, Sound System, Panggung',
                'status' => 'available',
            ],


            /* Banjarbaru - Ruang Kelas */
            [
                'name' => 'Ruang 1',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            [
                'name' => 'Ruang 2',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            [
                'name' => 'Ruang 3',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            [
                'name' => 'Ruang 4',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            [
                'name' => 'Ruang 5',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            [
                'name' => 'Ruang 6',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'kelas',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            /* Ruang Laboratorium */
            [
                'name' => 'Laboratorium Komputasi',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'lab',
                'capacity' => 30,
                'facilities' => 'AC, Proyektor, Papan Tulis, Komputer, Internet',
                'status' => 'available',
            ],

            [
                'name' => 'Laboratorium Transportasi dan Jalan Raya',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'lab',
                'capacity' => 30,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            [
                'name' => 'Laboratorium Struktur dan Material',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'lab',
                'capacity' => 30,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available',
            ],

            /* Ruang Aula */
            [
                'name' => 'Aula 1 Fakultas Teknik',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'aula',
                'capacity' => 100,
                'facilities' => 'AC, Proyektor, Sound System, Panggung',
                'status' => 'available',
            ],

            [
                'name' => 'Aula 2 Fakultas Teknik',
                'campus' => 'Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'aula',
                'capacity' => 100,
                'facilities' => 'AC, Proyektor, Sound System, Panggung',
                'status' => 'available',
            ],
        ]);
    }
}
