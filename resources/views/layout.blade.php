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
            // Teller favorieten uit de sessie
            $favCount = is_array(session('favorites')) ? count(session('favorites')) : 0;
        @endphp

        <nav class="nav">
            {{-- Publieke links --}}
            <a href="{{ route('home') }}"    class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('about') }}"   class="{{ request()->routeIs('about') ? 'is-active' : '' }}">Over ons</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">Contact</a>
            <a href="{{ route('books.index') }}"  class="{{ request()->routeIs('books.*') ? 'is-active' : '' }}">Boeken</a>
            <a href="{{ route('genres.index') }}" class="{{ request()->routeIs('genres.*') ? 'is-active' : '' }}">Genres</a>

            @auth
                {{-- Alleen ingelogd: favorieten --}}
                <a href="{{ route('favorites.index') }}" class="{{ request()->routeIs('favorites.*') ? 'is-active' : '' }}">
                    Favorieten @if($favCount) ({{ $favCount }}) @endif
                </a>

                {{-- Alleen admin: snelkoppeling nieuw boek --}}
                @if(auth()->user()->is_admin)
                    <a href="{{ route('books.create') }}" class="{{ request()->routeIs('books.create') ? 'is-active' : '' }}">+ Nieuw boek</a>
                @endif

                {{-- Uitloggen --}}
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-ghost">Uitloggen ({{ auth()->user()->name }})</button>
                </form>
            @else
                {{-- Niet ingelogd: login/registreren --}}
                <a href="{{ route('login') }}"    class="{{ request()->routeIs('login') ? 'is-active' : '' }}">Inloggen</a>
                <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'is-active' : '' }}">Registreren</a>
            @endauth
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
