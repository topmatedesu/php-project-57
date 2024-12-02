<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('task_statuses', [TaskStatusController::class, 'index'])->name('task_statuses.index');
Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('labels', [LabelController::class, 'index'])->name('labels.index');

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('labels', LabelController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource(
        'task_statuses',
        TaskStatusController::class
    )->only(['create', 'store', 'edit', 'update', 'destroy']);
});

Route::get('tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
