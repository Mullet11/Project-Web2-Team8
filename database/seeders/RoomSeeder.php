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
            // Kampus Banjarmasin (BJM)
            [
                'name' => 'Ruang Kuliah FT BJM 1',
                'campus' => 'Kampus Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'Gedung Utama FT BJM',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis, Speaker',
                'status' => 'available'
            ],
            [
                'name' => 'Ruang Kuliah FT BJM 2',
                'campus' => 'Kampus Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'Gedung Utama FT BJM',
                'capacity' => 45,
                'facilities' => 'AC, Proyektor, Papan Tulis, Speaker',
                'status' => 'available'
            ],
            [
                'name' => 'Lab Menggambar FT BJM',
                'campus' => 'Kampus Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'Gedung D FT BJM',
                'capacity' => 30,
                'facilities' => 'AC, Proyektor, Meja Gambar',
                'status' => 'available'
            ],
            [
                'name' => 'Lab Komputer FT BJM',
                'campus' => 'Kampus Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'Gedung D FT BJM',
                'capacity' => 25,
                'facilities' => 'AC, Proyektor, PC Komputer, Internet',
                'status' => 'occupied'
            ],
            [
                'name' => 'Aula FT BJM',
                'campus' => 'Kampus Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'Gedung A FT BJM',
                'capacity' => 150,
                'facilities' => 'AC, Proyektor, Sound System, Panggung',
                'status' => 'available'
            ],
            [
                'name' => 'Gedung Theater FT BJM',
                'campus' => 'Kampus Banjarmasin',
                'faculty' => 'Teknik',
                'building' => 'Gedung Dekanat FT BJM',
                'capacity' => 100,
                'facilities' => 'AC, Proyektor, Sound System, Kursi Theater',
                'status' => 'available'
            ],
            
            // Kampus Banjarbaru (BJB)
            [
                'name' => 'Lab Komputer IT 1',
                'campus' => 'Kampus Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'Gedung IT FT',
                'capacity' => 35,
                'facilities' => 'AC, Proyektor, PC Praktikum, Internet',
                'status' => 'available'
            ],
            [
                'name' => 'Lab Kimia Dasar FT BJB',
                'campus' => 'Kampus Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'Gedung Lab Terpadu FT',
                'capacity' => 30,
                'facilities' => 'Peralatan Lab, AC, Papan Tulis, Exhaust Fan',
                'status' => 'available'
            ],
            [
                'name' => 'Ruang Kuliah FT BJB A1',
                'campus' => 'Kampus Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'Gedung Dekanat Baru FT',
                'capacity' => 40,
                'facilities' => 'AC, Proyektor, Papan Tulis',
                'status' => 'available'
            ],
            [
                'name' => 'Ruang Kuliah FT BJB B2',
                'campus' => 'Kampus Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'Gedung Dekanat Baru FT',
                'capacity' => 50,
                'facilities' => 'AC, Proyektor, Papan Tulis, Sound System',
                'status' => 'available'
            ],
            [
                'name' => 'Aula Dekanat FT BJB',
                'campus' => 'Kampus Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'Gedung Dekanat Baru FT',
                'capacity' => 200,
                'facilities' => 'AC, Proyektor, Sound System, Kursi Lipat',
                'status' => 'available'
            ],
            [
                'name' => 'Gedung Theater FT BJB',
                'campus' => 'Kampus Banjarbaru',
                'faculty' => 'Teknik',
                'building' => 'Gedung Dekanat Baru FT',
                'capacity' => 120,
                'facilities' => 'AC, Proyektor, Sound System, Kursi Teater',
                'status' => 'available'
            ]
        ]);
    }
}
