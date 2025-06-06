@extends('layouts.app')

@section('title', "Post $post->title")
    
@section('content')
<div class="max-w-3xl mx-auto bg-gray-800 shadow-md rounded-xl p-6 mt-6 space-y-6">

    <h1 class="text-3xl font-bold text-white">{{ $post->title }}</h1>

    <p class="text-white">
        <span class="font-semibold text-white">Autor:</span> {{ $post->user->name ?? 'Anónimo' }}
    </p>

    @if ($post->poster)
        @php
            $poster = $post->poster;
            $isImage = preg_match('/\.(jpg|jpeg|png|gif|webp)(\?.*)?$/i', $poster);
        @endphp

        @if ($isImage)
            <div class="mt-4">
                <img src="{{ $poster }}" alt="Imagen" class="w-full rounded-lg shadow-md">
            </div>
        @endif
    @endif

    <div>
        <p class="text-white"><span class="font-semibold">Contenido:</span> {{ $post->content }}</p>
    </div>

    @if ($post->user_id === auth()->id())
        <div class="flex items-center justify-between mt-6">
            <p class="text-white">
                <span class="font-semibold">¿Habilitado?:</span> 
                <span class="{{ $post->habilitated ? 'text-green-600' : 'text-red-600' }}">
                    {{ $post->habilitated ? 'Sí' : 'No' }}
                </span>
            </p>
            <a href="{{ url('category/edit/' . $post->id) }}" 
               class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Editar
            </a>
        </div>
    @endif

</div>
@endsection