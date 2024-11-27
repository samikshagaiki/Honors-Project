<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

Auth::routes();

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', function () {
    $tasks = Task::where('user_id', Auth::id())->get();
    return view('dashboard', compact('tasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Task Management Routes
Route::middleware('auth')->group(function () {
    // Show all tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    
    // Create a task
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    
    //Task edit
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    //task updation
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');


    // Mark task as complete
    Route::post('/tasks/{task}/complete', [TaskController::class, 'markAsCompleted'])->name('tasks.complete');
    
    // Delete a task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    //marking as complete
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleCompletion'])->name('tasks.toggle');
});

require __DIR__ . '/auth.php';
