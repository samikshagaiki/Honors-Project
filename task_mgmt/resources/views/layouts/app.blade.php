<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Task Manager</title>

    <!-- Pico.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picocss@1.7.7/dist/pico.min.css">
</head>
    <main class="container">
       <!--Navbar -->
       <nav>
            <ul>
                <li>
                    <strong>
                        <a href="{{ url('/') }}" style="font-size: 2.5rem;">Task Manager</a>
                    </strong>
                </li>
            </ul>
            <ul>
                @auth
                    <li><a href="{{ route('tasks.index') }}">My Tasks</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="secondary">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </nav>


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
