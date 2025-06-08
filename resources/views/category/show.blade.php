@extends('layouts.app')

@section('title', "Ñeddit - Post $post->title")
    
@section('content')
<div class="max-w-3xl mx-auto bg-gray-800 shadow-md rounded-xl p-6 mt-6 space-y-6">

    <h1 class="text-3xl font-bold text-white">{{ $post->title }}</h1>

    <p class="text-sm text-gray-300 mb-2">{{ $post->created_at->diffForHumans() }}</p>

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

    <div class="text-white whitespace-pre-line">
        <p class="font-semibold"></p>
        {{ $post->content }}
    </div>

    @if ($post->user_id === auth()->id())
        <div class="flex items-center justify-between mt-6">
            <p class="text-white">
                <span class="font-semibold">¿Habilitado?:</span> 
                <span class="{{ $post->habilitated ? 'text-green-600' : 'text-red-600' }}">
                    {{ $post->habilitated ? 'Sí' : 'No' }}
                </span>
            </p>

            <div class="flex gap-2">
                <a href="{{ url('category/edit/' . $post->id) }}" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Editar
                </a>

                <form action="{{ url('category/delete/' . $post->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que querés eliminar este post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    @endif

    {{--formulario para comentar si estan logeados)--}}
    @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="content" rows="3" class="w-full p-2 rounded" placeholder="Escribí tu comentario aquí..." required></textarea>
            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Comentar
            </button>
        </form>
        @else
        <p class="mt-4 text-gray-400">Para comentar, <a href="{{ route('login') }}" class="underline">Iniciá Sesión</a>.</p>
    @endauth

    <div class="mt-8 bg-gray-700 p-4 rounded-lg">
        <h2 class="text-xl font-bold text-white mb-4">Comentarios</h2>

        @foreach($post->comments as $comment)
            <div class="mb-4 border-b border-gray-600 pb-2">
                <p class="text-white"><strong>{{ $comment->user->name ?? 'Anónimo' }}:</strong></p>
                <p class="text-gray-300">{{ $comment->content }}</p>
                {{--craeted_at es una instancia de carbon para manejar horas y fechas --}}
                <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        @endforeach
    </div>


</div>
@endsection