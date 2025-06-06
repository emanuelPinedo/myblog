@extends('layouts.app')

@section('title', 'Editar Post')
    
@section('content')
<div class="max-w-2xl mx-auto bg-gray-800 p-8 mt-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-white mb-6">Editar Post</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('category/update/' . $post->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('POST')

        <div>
            <label for="title" class="block text-white font-semibold mb-1">Título</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="poster" class="block text-white font-semibold mb-1">URL de imagen</label>
            <input type="url" name="poster" value="{{ old('poster', $post->poster) }}" required
                class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        @php
            $poster = $post->poster;
            $isImage = preg_match('/\.(jpg|jpeg|png|gif|webp)(\?.*)?$/i', $poster);
        @endphp

        @if ($isImage)
            <div class="mt-4">
                <img src="{{ $poster }}" alt="Imagen del post" class="w-full max-w-md rounded shadow">
            </div>
        @endif

        <div>
            <label for="content" class="block text-white font-semibold mb-1">Contenido</label>
            <textarea name="content" required
                class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" name="habilitated" {{ $post->habilitated ? 'checked' : '' }}
                class="rounded text-blue-600 focus:ring-blue-500">
            <label class="text-white">¿Habilitado?</label>
        </div>

        <div class="text-right">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Guardar cambios
            </button>
        </div>
    </form>
</div>
@endsection