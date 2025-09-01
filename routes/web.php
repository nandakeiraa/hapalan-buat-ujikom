<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SaranaController;
use App\Http\Controllers\DivisiController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::resource('/sarana', SaranaController::class);
});

Route::middleware(['auth', 'role:divisi'])->group(function () {
    Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.dashboard');
});

// Jika butuh multi-role di satu grup:
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    // route yang boleh admin & petugas
});

require __DIR__.'/auth.php';
