<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected Routes (Butuh Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard menggunakan Controller Backend
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update']);
    
    // Booking Routes
    Route::get('/rooms/{id}', [BookingController::class, 'showRoom']);
    Route::post('/booking/{id}', [BookingController::class, 'store']);

    // History Routes
    Route::get('/history', [HistoryController::class, 'index']);
    Route::get('/history/detail/{id}', [HistoryController::class, 'show']);
    Route::get('/history/edit/{id}', [HistoryController::class, 'edit']);
    Route::post('/history/edit/{id}', [HistoryController::class, 'update']);

    // Admin Routes
    Route::middleware('is_admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/approve/{id}', [AdminController::class, 'approve']);
        Route::post('/reject/{id}', [AdminController::class, 'reject']);
    });
});
