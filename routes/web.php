<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/selesai/{id}', [TaskController::class, 'selesai'])->name('tasks.selesai');
Route::delete('/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
