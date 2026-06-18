<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::post('/register', function () {
        return redirect('/?registered=1');
    });
});

// Protected Routes (Butuh Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard menggunakan Controller Backend
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/history', function () {
        return view('history.index');
    });

    Route::get('/profile', function () {
        return view('profile.index');
    });
    
    // Rute buatan Naufal untuk UI statis Detail Ruangan & Edit History
    Route::get('/rooms/{id}', function ($id) {
        $rooms = [
            1 => ['name' => 'Ruang LK-201', 'building' => 'Gedung B (Lab Komputer)', 'capacity' => 40, 'type' => 'Lab Komputer', 'status' => 'tersedia'],
            2 => ['name' => 'AULA UTAMA', 'building' => 'Gedung A (Dekanat)', 'capacity' => 60, 'type' => 'Aula Utama', 'status' => 'terpakai'],
            3 => ['name' => 'Ruang C-303', 'building' => 'Gedung C (Sains & Tek)', 'capacity' => 30, 'type' => 'Sains & Tek', 'status' => 'tersedia'],
            4 => ['name' => 'Teater Seni D-101', 'building' => 'Gedung D (Sastra & Seni)', 'capacity' => 50, 'type' => 'Sastra & Seni', 'status' => 'tersedia'],
            5 => ['name' => 'Lab Jaringan LK-203', 'building' => 'Gedung B (Lab Komputer)', 'capacity' => 35, 'type' => 'Lab Komputer', 'status' => 'terpakai'],
            6 => ['name' => 'Ruang Seminar A-202', 'building' => 'Gedung A (Dekanat)', 'capacity' => 40, 'type' => 'Dekanat', 'status' => 'tersedia'],
        ];

        $room = $rooms[$id] ?? [
            'name' => 'Ruang ' . $id, 
            'building' => 'Gedung Utama', 
            'capacity' => 30, 
            'type' => 'Ruang Kelas',
            'status' => 'tersedia'
        ];

        if ($room['status'] === 'terpakai') {
            $schedules = [
                [
                    'time' => '08:00 - 09:30', 
                    'type' => 'Perkuliahan', 
                    'subject' => 'Praktikum Jaringan Komputer', 
                    'lecturer' => 'Dr. H. Andi Wijaya, M.T.', 
                    'class' => 'Teknologi Informasi - Kelas B 2024',
                    'whatsapp' => '6281234567890',
                    'status' => 'selesai'
                ],
                [
                    'time' => '10:30 - 12:00', 
                    'type' => 'Perkuliahan', 
                    'subject' => 'Keamanan Sistem Informasi', 
                    'lecturer' => 'Rina Setyawati, M.Kom.', 
                    'class' => 'Teknologi Informasi - Kelas A 2024',
                    'whatsapp' => '6282345678901',
                    'status' => 'selesai'
                ],
                [
                    'time' => '13:30 - 15:30', 
                    'type' => 'Kegiatan Kampus', 
                    'activity' => 'Rapat Koordinasi BEM Fakultas Teknik', 
                    'pic' => 'Muhammad Syahrial (Ketua BEM)', 
                    'whatsapp' => '6289876543210',
                    'status' => 'sedang_berlangsung'
                ],
                [
                    'time' => '16:00 - 18:00', 
                    'type' => 'Kegiatan Kampus', 
                    'activity' => 'Latihan Rutin Debat Unit Mahasiswa', 
                    'pic' => 'Aditya Rahman (Koordinator Unit)', 
                    'whatsapp' => '6287766554433',
                    'status' => 'akan_datang'
                ]
            ];

            return view('viewClass.viewClassUsed', compact('id', 'room', 'schedules'));
        }

        $slots = [
            ['time' => '07:30', 'status' => 'tersedia'],
            ['time' => '09:00', 'status' => 'tersedia'],
            ['time' => '10:30', 'status' => 'terpakai'],
            ['time' => '12:00', 'status' => 'tersedia'],
            ['time' => '13:30', 'status' => 'tersedia'],
            ['time' => '15:00', 'status' => 'tersedia'],
            ['time' => '16:30', 'status' => 'tersedia'],
            ['time' => '18:00', 'status' => 'tersedia'],
        ];

        return view('booking.select-time', compact('id', 'room', 'slots'));
    });

    Route::get('/history/detail/{status}', function ($status) {
        $booking = [
            'status' => $status,
            'room_name' => 'AULA UTAMA',
            'building' => 'Gedung A (Dekanat)',
            'capacity' => 60,
            'type' => 'Aula Utama',
            'nama' => 'Muhammad Naufal',
            'nim' => '2210817210005',
            'prodi_fakultas' => 'Teknologi Informasi / Teknik',
            'whatsapp' => '6281234567890',
            'perihal' => 'Kegiatan Kampus',
            'nama_kegiatan' => 'Seminar Nasional TechTalk 2026',
            'tanggal' => 'Senin, 22 Juni 2026',
            'waktu' => '13:00 - 16:00 WIB',
            'no_booking' => 'SBC-20260622-0042',
            'dosen' => 'Dr. Ir. H. M. Ismail, M.T.',
            'matakuliah' => 'Pemrograman Web II'
        ];

        if ($status === 'selesai') {
            $booking['room_name'] = 'Ruang LK-201';
            $booking['building'] = 'Gedung B (Lab Komputer)';
            $booking['capacity'] = 40;
            $booking['type'] = 'Lab Komputer';
            $booking['perihal'] = 'Perkuliahan';
            $booking['tanggal'] = 'Jumat, 12 Juni 2026';
            $booking['waktu'] = '08:00 - 10:00 WIB';
            $booking['no_booking'] = 'SBC-20260612-0015';
        } elseif ($status === 'dibatalkan') {
            $booking['room_name'] = 'Ruang Seminar A-202';
            $booking['building'] = 'Gedung A (Dekanat)';
            $booking['capacity'] = 40;
            $booking['type'] = 'Dekanat';
            $booking['perihal'] = 'Perkuliahan';
            $booking['tanggal'] = 'Rabu, 10 Juni 2026';
            $booking['waktu'] = '09:00 - 11:00 WIB';
            $booking['no_booking'] = 'SBC-20260610-0009';
            $booking['alasan_batal'] = 'Permintaan peminjaman dibatalkan oleh Admin BAAK karena bentrok dengan jadwal Ujian Tengah Semester (UTS) mata kuliah lain di hari yang sama.';
        } elseif ($status === 'menunggu') {
            $booking['room_name'] = 'Teater Seni D-101';
            $booking['building'] = 'Gedung D (Sastra & Seni)';
            $booking['capacity'] = 50;
            $booking['type'] = 'Sastra & Seni';
            $booking['perihal'] = 'Kegiatan Kampus';
            $booking['nama_kegiatan'] = 'Latihan Teater Mahasiswa Baru';
            $booking['tanggal'] = 'Kamis, 25 Juni 2026';
            $booking['waktu'] = '10:00 - 12:00 WIB';
            $booking['no_booking'] = 'SBC-20260625-0081';
        }

        return view('viewDetailHistory.viewDetailHistoryClass', compact('booking'));
    });

    Route::get('/history/edit/{status}', function ($status) {
        $booking = [
            'status' => $status,
            'room_name' => 'Teater Seni D-101',
            'building' => 'Gedung D (Sastra & Seni)',
            'capacity' => 50,
            'type' => 'Sastra & Seni',
            'nama' => 'Muhammad Naufal',
            'nim' => '2210817210005',
            'prodi_fakultas' => 'Teknologi Informasi / Teknik',
            'whatsapp' => '6281234567890',
            'perihal' => 'Kegiatan Kampus',
            'nama_kegiatan' => 'Latihan Teater Mahasiswa Baru',
            'tanggal' => '2026-06-25', 
            'waktu_mulai' => '10:00',
            'waktu_selesai' => '12:00',
            'no_booking' => 'SBC-20260625-0081',
            'dosen' => 'Dr. Ir. H. M. Ismail, M.T.',
            'matakuliah' => 'Pemrograman Web II'
        ];

        if ($status === 'selesai') {
            $booking['room_name'] = 'Ruang LK-201';
            $booking['building'] = 'Gedung B (Lab Komputer)';
            $booking['capacity'] = 40;
            $booking['type'] = 'Lab Komputer';
            $booking['perihal'] = 'Perkuliahan';
            $booking['tanggal'] = '2026-06-12';
            $booking['waktu_mulai'] = '08:00';
            $booking['waktu_selesai'] = '10:00';
            $booking['no_booking'] = 'SBC-20260612-0015';
        }

        return view('viewDetailHistory.editDetailHistory', compact('booking'));
    });

    Route::post('/history/edit/{status}', function ($status) {
        return redirect('/history/detail/' . $status . '?edited=1');
    });
});
