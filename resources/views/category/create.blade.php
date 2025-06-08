@extends('layouts.app')

@section('title', 'Ñeddit - Crear Post')
    
@section('content')
<div class="max-w-2xl mx-auto bg-gray-800 p-8 mt-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-white mb-6">Crear nuevo Post</h1>

    {{--verifica y muestra los errores de validacion si es q hay--}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('category/store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-white font-semibold mb-1">Título</label>
            <input type="text" id="title" name="title" required
                class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="poster" class="block text-white font-semibold mb-1">URL de imagen</label>
            <input type="url" id="poster" name="poster" required
                class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="content" class="block text-white font-semibold mb-1">Contenido</label>
            <textarea id="content" name="content" rows="5" required
                class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" id="habilitated" name="habilitated"
                class="rounded text-blue-600 focus:ring-blue-500">
            <label for="habilitated" class="text-white">¿Habilitado?</label>
        </div>

        <div class="text-right">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection