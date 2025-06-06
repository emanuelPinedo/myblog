<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    @stack('css')
    <style>
        body {
            background-color: #18181b;
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