<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //Fetching tasks
    public function index(){
        $tasks = Task::where('user_id',Auth::id())
               ->where('is_completed', false)
               ->get();

        return view('tasks.index',compact('tasks'));
}
 // Show form to create a new task
 public function create()
 {
     return view('tasks.create');
 }

 // Store a new task
 public function store(Request $request)
 {
     $request->validate([
         'description' => 'required|string|max:255',
         'due_date' => 'required|date',
         'priority' => 'required|string',
     ]);

     Task::create([
         'user_id' => Auth::id(),
         'description' => $request->description,
         'due_date' => $request->due_date,
         'priority' => $request->priority,
         'is_completed' => false,
     ]);

     return redirect()->route('tasks.index');
 }
}
