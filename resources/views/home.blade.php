<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 12</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="maw-w-4xl mx-auto px-4">
        <h1>Bienvenido a la página principal</h1>
    
        <x-alert2 type="danger" class="mb-4">
            <x-slot name="title">
                <strong>Título de la alerta</strong>
            </x-slot>

            Contenido de la alerta
        </x-alert2>

        <p>Hola mundo</p>

    </div>
</body>
</html>