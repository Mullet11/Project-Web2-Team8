<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/history', function () {
    return view('history.index');
});

Route::get('/profile', function () {
    return view('profile.index');
});

Route::get('/rooms/{id}', function ($id) {
    // Simulasi data ruangan berdasarkan ID untuk kebutuhan UI
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

    // Jika status ruangan terpakai, tampilkan jadwal pemakaian
    if ($room['status'] === 'terpakai') {
        // Simulasi jadwal penggunaan hari ini
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

    // Simulasi data slot waktu (placeholder) untuk status tersedia
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

Route::post('/register', function () {
    return redirect('/?registered=1');
});

Route::post('/login', function () {
    return redirect('/dashboard?login=1');
});
