@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Tasks</h1>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add New Task</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul class="list-group" id="task-list">
        @foreach($tasks as $task)
            <li class="list-group-item" id="task-{{ $task->id }}">
                <strong>{{ $task->title }}</strong>
                <p>{{ $task->description }}</p>
                <small>Due: {{ $task->due_date }} | Priority: {{ $task->priority }}</small>

                <!-- Checkbox to mark as completed -->
                <label class="form-check-label" for="task-{{ $task->id }}">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="task-checkbox-{{ $task->id }}" 
                           {{ $task->is_completed ? 'checked' : '' }}
                           onclick="toggleCompletion({{ $task->id }})">
                    Mark as completed
                </label>

                <!-- Edit Button -->
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>

                <!-- Form to delete task -->
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>

<script>
    function toggleCompletion(taskId) {
        var checkbox = document.getElementById('task-checkbox-' + taskId);
        var isCompleted = checkbox.checked;

        // Send AJAX request to update task status
        fetch(/tasks/${taskId}/toggle, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: isCompleted ? 1 : 0
            })
        })
        .then(response => response.json())
        .then(data => {
            // Display success message
            alert(data.message);

            // If task is marked as completed, remove it from the list
            if (data.completed) {
                var taskElement = document.getElementById('task-' + data.task_id);
                if (taskElement) {
                    taskElement.remove();  // Remove task from the DOM
                } 
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
@endsection
