@extends('layouts.app')

@section('content')
    <h1>Welcome to the Home Page!</h1>
    <div>
        <a href="{{ route('tasks.index') }}" class="button">View My Tasks</a>
        <a href="{{ route('tasks.create') }}" class="button">Create a New Task</a>
    </div>
@endsection
