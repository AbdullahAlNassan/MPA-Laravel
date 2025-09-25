<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jukebox')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}?v={{ filemtime(public_path('css/layout.css')) }}">


</head>

<body>
    <header>
        <div class="container brand">
            <h1>Abdullah Books</h1>

            @php
            // Tel het aantal favorieten in de sessie
            $favCount = is_array(session('favorites')) ? count(session('favorites')) : 0;
            @endphp
            <nav class="nav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'is-active' : '' }}">Over ons</a>
                <a href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">Contact</a>
                <a href="{{ route('books.index') }}"
                    class="{{ request()->routeIs('books.*') ? 'is-active' : '' }}">Boeken</a>
                <a href="{{ route('genres.index') }}"
                    class="{{ request()->routeIs('genres.*') ? 'is-active' : '' }}">Genres</a>

                <a href="{{ route('favorites.index') }}" class="{{ request()->routeIs('favorites.*') ? 'is-active' : '' }}">
                    Favorieten @if($favCount) ({{ $favCount }}) @endif
                </a>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            @if(session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif

            @yield('content')
        </div>
    </main>
    <footer>
        <div class="container">
            &copy; {{ date('Y') }} Abdullah Books.
        </div>
    </footer>
</body>

</html>