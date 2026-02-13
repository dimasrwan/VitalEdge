<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HealthController; // Pastikan ini di-import
use Illuminate\Support\Facades\Route;

// 1. Route Beranda (Sekarang melewati Controller agar $logs terdefinisi)
Route::get('/', [HealthController::class, 'index'])->name('home');

// 2. Route Dashboard (Hanya bisa diakses setelah Login)
Route::get('/dashboard', [HealthController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 3. Route Fitur Kesehatan (Hanya untuk user yang login)
Route::middleware('auth')->group(function () {
    Route::post('/save-health', [HealthController::class, 'store'])->name('health.store');
    Route::delete('/delete-health/{id}', [HealthController::class, 'destroy'])->name('health.destroy');
    
    // Route Profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';