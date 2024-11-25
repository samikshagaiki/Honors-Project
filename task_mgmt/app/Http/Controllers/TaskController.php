<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // List all tasks
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->where('is_completed', false)
            ->orderBy('priority', 'desc')
            ->orderBy('due_date', 'asc')
            ->get();

        return view('components.tasks.index', compact('tasks'));
    }

    // Show form to create a new task
    public function create()
    {
        return view('components.tasks.create');
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Added title validation
            'description' => 'nullable|string|max:255',
            'due_date' => 'required|date|after_or_equal:today',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        Task::create([
            'title' => $request->title, // Added title to the create array
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'user_id' => Auth::id(),
            'is_completed' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // Mark a task as completed
    public function markComplete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->update(['is_completed' => true]);

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
    }

    // View completed tasks
    public function viewCompleted()
    {
        $completedTasks = Task::where('user_id', Auth::id())
            ->where('is_completed', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('components.tasks.completed', compact('completedTasks'));
    }

    // Delete a task
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
