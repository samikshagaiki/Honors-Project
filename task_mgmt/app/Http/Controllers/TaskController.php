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
        //Fetch all the tasks excluding completed tasks for the current user
        $tasks = Task::where('user_id', auth->id())
                     ->where('is_completed', 0)
                     ->get();
        
        return view('tasks.index', compact('tasks'));
    }

    // Show form to create a new task
    public function create()
    {
        return view('tasks.create');
    }

    // Store a new task
    public function store(Request $request)
    {
        //Validate input
        $request->validate([
            'title' => 'required|string|max:255', // Added title validation
            'description' => 'nullable|string,
            'due_date' => 'required|date',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        //Create a new task
        Task::create([
            'user_id'=>Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'is_completed' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    //Edit specified task
    public function edit(Task $task)
    {
        if($task->user_id !== Auth::id()){
            return redirect()->route('tasks.index')->with('error','Unauthorized Access!!');
        }

        return view('tasks.edit',compact('task'));
    }

    //Update specified task
    public function update(Request $request, Task $task){
        if($task->user_id !== Auth::id()){
            return redirect()->route('tasks.index')->with('error','Unauthorized Access!');
        }
        //Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        //Check if the task is marked as completed
        $isCompleted = $request->has('is_completed')&& $request->is_completed;

        //update the task
        $task->update([
            'title' => $request->title,
            'description' => $request->description, 
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'is_completed' => $isCompleted ? true : $task->is_completed,

        ]);
    }


    // Mark a task as completed
    public function markAsComplete(Task $task)
    {
        $task->update(['is_completed' => true]);
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
    }
    

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }


    public function toggleCompletion(Task $task , Request $request)
    {
        $request->validate(['status'=>'required|in:0,1,
        ]);

        $task->is_completed = $request->status;
        $task->save();

        $messge = $task->is_completed?'Task marked as completed!':'Task marked as incomplete!';

        return response()->json(['completed'=>$task->is_completed,
                                'message'=>$message,
                                '$task_id'=>$task_id,
                                ]);
    }
}
