<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('imgs/neddit iii.png') }}" type="image/x-icon">
    <title>@yield('title', 'Ñeddit')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    @stack('css')
    <style>
        body {
            background-color: #18181b;
        }

        header{
            position: sticky;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>
<body>

    <header>
        @include('layouts.navigation')
    </header>

    <main>
    @yield('content')
    </main>

    <footer></footer>
</body>
</html>