<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jukebox')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

</head>
<body>
    <header>
        <h1>MPA Jukebox</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/about">Over ons</a>
            <a href="/contact">Contact</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        &copy; {{ date('Y') }} MPA Jukebox. Gemaakt met Laravel.
    </footer>
</body>
</html>
