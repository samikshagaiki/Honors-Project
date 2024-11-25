@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Task</h1>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
@error('title')
             <div class="error">{{ $message }}</div>
@enderror
</div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <button type="submit" class="button primary">Create Task</button>
        </form>
    </div>
@endsection
