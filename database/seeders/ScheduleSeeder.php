<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan ID Ruangan berdasarkan nama secara dinamis
        $roomA14 = Room::where('name', 'Ruang A14')->first()?->id;
        $roomA15 = Room::where('name', 'Ruang A15')->first()?->id;
        $roomBigData = Room::where('name', 'Laboratorium Big Data')->first()?->id;
        $roomLabKom = Room::where('name', 'Ruang Laboratorium Komputer Dasar')->first()?->id;

        // Fallback ID default jika ruangan tidak ditemukan (opsional)
        $roomA14Id = $roomA14 ?? 2;
        $roomA15Id = $roomA15 ?? 3;
        $roomBigDataId = $roomBigData ?? 7;
        $roomLabKomId = $roomLabKom ?? 5;

        Schedule::insert([
            // 1. KETERAMPILAN BERKOMUNIKASI
            [
                'room_id' => $roomA14Id,
                'title' => 'Keterampilan Berkomunikasi',
                'lecturer_name' => 'Noviana Sari',
                'prodi' => 'Teknologi Informasi',
                'day' => 'Senin',
                'start_time' => '08:00:00',
                'end_time' => '10:30:00',
                'type' => 'fixed_class',
            ],

            // 2. PEMROGRAMAN WEB II
            [
                'room_id' => $roomA15Id,
                'title' => 'Pemrograman Web II',
                'lecturer_name' => 'Eka Setya Wijaya',
                'prodi' => 'Teknologi Informasi',
                'day' => 'Selasa',
                'start_time' => '08:00:00',
                'end_time' => '09:40:00',
                'type' => 'fixed_class',
            ],

            // 3. REKAYASA PERANGKAT LUNAK
            [
                'room_id' => $roomA14Id,
                'title' => 'Rekayasa Perangkat Lunak',
                'lecturer_name' => 'Irham Maulani Abdul Gani',
                'prodi' => 'Teknologi Informasi',
                'day' => 'Selasa',
                'start_time' => '09:40:00',
                'end_time' => '12:10:00',
                'type' => 'fixed_class',
            ],

            // 4. PRAKTIKUM PEMROGRAMAN WEB II
            [
                'room_id' => $roomLabKomId,
                'title' => 'Praktikum Pemrograman Web II',
                'lecturer_name' => 'Eka Setya Wijaya',
                'prodi' => 'Teknologi Informasi',
                'day' => 'Selasa',
                'start_time' => '15:30:00',
                'end_time' => '18:00:00',
                'type' => 'fixed_class',
            ],

            // 5. KEWIRAUSAHAAN
            [
                'room_id' => $roomA15Id,
                'title' => 'Kewirausahaan',
                'lecturer_name' => 'Erika Maulidiya',
                'prodi' => 'Teknologi Informasi',
                'day' => 'Kamis',
                'start_time' => '08:00:00',
                'end_time' => '09:40:00',
                'type' => 'fixed_class',
            ],

            // 6. KEAMANAN SIBER
            [
                'room_id' => $roomBigDataId,
                'title' => 'Keamanan Siber',
                'lecturer_name' => 'Muhammad Alkaff',
                'prodi' => 'Teknologi Informasi',
                'day' => 'Kamis',
                'start_time' => '09:40:00',
                'end_time' => '12:10:00',
                'type' => 'fixed_class',
            ],

            // 7. ADMINISTRASI SISTEM DAN JARINGAN
            [
                'room_id' => $roomBigDataId,
                'title' => 'Administrasi Sistem dan Jaringan',
                'lecturer_name' => 'Achmad Mujaddid Islami',
                'prodi' => 'Teknologi Informasi',
                'day' => 'Kamis',
                'start_time' => '13:00:00',
                'end_time' => '15:30:00',
                'type' => 'fixed_class',
            ],

            // 8. BAHASA INDONESIA
            [
                'room_id' => $roomA14Id,
                'title' => 'Bahasa Indonesia',
                'lecturer_name' => 'Fadliyanur',
                'prodi' => 'Teknologi Informasi',
                'day' => 'Jumat',
                'start_time' => '08:00:00',
                'end_time' => '10:30:00',
                'type' => 'fixed_class',
            ],

            // 9. KEWARGANEGARAAN
            [
                'room_id' => $roomA14Id,
                'title' => 'Kewarganegaraan',
                'lecturer_name' => 'Fadliyanur',
                'prodi' => 'Teknologi Informasi',
                'day' => 'Jumat',
                'start_time' => '10:30:00',
                'end_time' => '12:10:00',
                'type' => 'fixed_class',
            ],
        ]);
    }
}
