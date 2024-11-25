@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Tasks</h1>

        @foreach ($tasks as $task)
            <div class="task">
                <p>{{ $task->description }}</p>
                <p>Due Date: {{ $task->due_date }}</p>
                <p>Priority: {{ $task->priority }}</p>

                @if($task->isUrgent())
                    <span>* Urgent</span>
                @endif

                <form action="{{ route('tasks.complete', $task) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">Complete Task</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection