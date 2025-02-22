<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamlah Task Manager</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    @livewireStyles
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Hamlah Task Manager</a>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white">Logout</button>
                    </form>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        @if(auth()->check())
            <h1>Welcome, {{ auth()->user()->name }}</h1>
        @else
            @livewire('auth-component')
        @endif
    </div>

    @livewireScripts
</body>
</html>
