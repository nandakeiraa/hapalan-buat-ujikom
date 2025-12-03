<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
Route::post('/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/selesai/{id}', [TaskController::class, 'selesai'])->name('tasks.selesai');
Route::delete('/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
