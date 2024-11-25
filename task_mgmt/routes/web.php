<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('home');
})->name('home');

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Task Management Routes
Route::middleware('auth')->group(function () {
    // Show all tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    
    // Create a task
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    
    // Mark task as complete
    Route::put('/tasks/{task}/complete', [TaskController::class, 'markComplete'])->name('tasks.markComplete');
    
    // View completed tasks
    Route::get('/tasks/completed', [TaskController::class, 'viewCompleted'])->name('tasks.viewCompleted');
    
    // Delete a task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

require __DIR__ . '/auth.php';
