<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;

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

    Route::get('/profile', function () {
        return view('profile.index');
    });
    
    // Booking Routes
    Route::get('/rooms/{id}', [BookingController::class, 'showRoom']);
    Route::post('/booking/{id}', [BookingController::class, 'store']);

    // History Routes
    Route::get('/history', [HistoryController::class, 'index']);
    Route::get('/history/detail/{id}', [HistoryController::class, 'show']);
    Route::get('/history/edit/{id}', [HistoryController::class, 'edit']);
    Route::post('/history/edit/{id}', [HistoryController::class, 'update']);
});
