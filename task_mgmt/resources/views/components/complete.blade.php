@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Completed Tasks</h1>

        @foreach ($tasks as $task)
            <div class="task">
                <p>{{ $task->description }}</p>
                <p>Completed on: {{ $task->updated_at }}</p>
            </div>
        @endforeach
    </div>
@endsection