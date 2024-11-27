@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $task->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description">{{ $task->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" class="form-control" name="due_date" value="{{ $task->due_date }}" required>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <select class="form-control" name="priority" required>
                <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Task</button>
    </form>
</div>
@endsection
