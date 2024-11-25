<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Task Manager') }}</title>

    <!-- Pico.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picocss@1.7.7/dist/pico.min.css">
</head>
<body>
    <header class="container">
        <!-- Navigation -->
        @include('layouts.navigation')
    </header>

    <main class="container">
        <!-- Page Heading -->
        @isset($header)
            <header class="mb-4">
                <h1>{{ $header }}</h1>
            </header>
        @endisset

        <!-- Page Content -->
        <section>
            @yield('content')
        </section>
    </main>

    <footer class="container mt-4">
        <p>&copy; {{ date('Y') }} Task Manager. All rights reserved.</p>
    </footer>
</body>
</html>
