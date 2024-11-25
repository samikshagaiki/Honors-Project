@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Completed Tasks</h1>

        @if ($completedTasks->isEmpty())
            <p>No completed tasks yet. Start completing some tasks!</p>
        @else
            <ul>
                @foreach ($completedTasks as $task)
                    <li>
                        <div class="task">
                            <p>{{ $task->description }}</p>
                            <p>Completed On: {{ $task->updated_at->format('F j, Y, g:i a') }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
