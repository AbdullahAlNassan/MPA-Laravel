<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jukebox')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Roboto', Arial, sans-serif; 
            background: #f3f4f6; 
            color: #222; 
            margin: 0; 
            padding: 0;
        }
        header { 
            background: #22223b; 
            color: #fff; 
            padding: 24px 0 8px 0; 
            margin-bottom: 24px;
            text-align: center;
        }
        nav a {
            color: #c9ada7; 
            text-decoration: none; 
            margin: 0 14px; 
            font-weight: bold; 
            font-size: 18px;
            transition: color 0.2s;
        }
        nav a:hover {
            color: #f2e9e4;
        }
        main { 
            max-width: 700px; 
            margin: 32px auto; 
            background: #fff; 
            border-radius: 18px; 
            box-shadow: 0 2px 18px rgba(0,0,0,0.1);
            padding: 32px 32px 24px 32px;
        }
        footer {
            text-align: center;
            color: #888;
            padding: 12px;
            margin-top: 32px;
            font-size: 14px;
        }
    </style>
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
