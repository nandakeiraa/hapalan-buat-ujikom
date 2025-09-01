<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Controller
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DistribusiController;

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

// ✅ Profile routes (default Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
    
// ✅ Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Barang hanya boleh dikelola Admin
    Route::resource('/barang', BarangController::class);
});

    // Distribusi hanya boleh dikelola Petugas
    Route::resource('/distribusi', DistribusiController::class);
});

// ✅ Divisi
Route::middleware(['auth', 'role:divisi'])->group(function () {
    Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.dashboard');
});

// ✅ Multi-role (admin & petugas)
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    // Contoh: laporan gabungan
    Route::get('/laporan', function () {
        return 'Halaman Laporan (Admin & Petugas)';
    })->name('laporan.index');
});

require __DIR__.'/auth.php';
