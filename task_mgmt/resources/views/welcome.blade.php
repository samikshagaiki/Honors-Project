@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
    <h1>Welcome to Task Manager</h1>
    <p>Effortlessly manage your tasks and stay organized!</p>

    @if (Auth::check())
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Go to My Tasks</a>
    @else
        <a href="{{ route('login')}}" class="btn btn-primary">Login</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        @endif
    @endif
</div>
@endsection