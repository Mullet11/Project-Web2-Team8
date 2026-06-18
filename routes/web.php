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
        1 => ['name' => 'Ruang LK-201', 'building' => 'Gedung B (Lab Komputer)', 'capacity' => 40, 'type' => 'Lab Komputer'],
        3 => ['name' => 'Ruang C-303', 'building' => 'Gedung C (Sains & Tek)', 'capacity' => 30, 'type' => 'Sains & Tek'],
        4 => ['name' => 'Teater Seni D-101', 'building' => 'Gedung D (Sastra & Seni)', 'capacity' => 50, 'type' => 'Sastra & Seni'],
        6 => ['name' => 'Ruang Seminar A-202', 'building' => 'Gedung A (Dekanat)', 'capacity' => 40, 'type' => 'Dekanat'],
    ];

    $room = $rooms[$id] ?? [
        'name' => 'Ruang ' . $id, 
        'building' => 'Gedung Utama', 
        'capacity' => 30, 
        'type' => 'Ruang Kelas'
    ];

    // Simulasi data slot waktu (placeholder)
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
