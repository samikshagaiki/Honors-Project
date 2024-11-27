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

    <ul class="list-group">
        @foreach($tasks as $task)
            @php
                // Highlight if task is high priority, not completed, and due today
                $isHighlighted = ($task->priority === 'High' && !$task->is_completed && $task->due_date === now()->toDateString());
            @endphp
            <li class="list-group-item" style="{{ $isHighlighted ? 'background-color: #fff910' : '' }}">
                <strong>{{ $task->title }}</strong>
                @if ($isHighlighted)
                    <span class="text-danger">*</span>
                @endif
                <p>{{ $task->description }}</p>
                <small>Due: {{ $task->due_date }} | Priority: {{ $task->priority }}</small>

<!-- Edit Button -->
<a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>

<!-- Form to mark as completed -->
<form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <select name="is_completed" onchange="this.form.submit()" class="form-select form-select-sm d-inline w-auto">
                        <option value="0" {{ !$task->is_completed ? 'selected' : '' }}>Incomplete</option>
                        <option value="1" {{ $task->is_completed ? 'selected' : '' }}>Completed</option>
                    </select>
                </form>

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
@endsection
