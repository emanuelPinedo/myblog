@extends('layouts.app')

@section('title', 'Categorías')
    
@section('content')
    <div class="max-w-4xl mx-auto mt-6">
        <h1 class="text-2xl font-bold text-white mb-4">Lista de Posts</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @foreach ($posts as $post)
                <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md flex">
                    {{-- Flechas de votos (decorativo, si no tenés sistema de votos aún) 
                    <div class="flex flex-col items-center justify-center mr-4">
                        <button class="text-green-500 hover:text-green-300 text-xl">&#9650;</button>
                        <span class="text-sm font-bold text-green-400">{{ $post->votes ?? 0 }}</span>
                        <button class="text-red-500 hover:text-red-300 text-xl">&#9660;</button>
                    </div>--}}

                    {{-- Contenido del post --}}
                    <div class="flex-1">
                        <a href="{{ url('category/show/' . $post->id) }}" class="text-lg font-semibold hover:underline">
                            {{ $post->title }}
                        </a>
                        @if ($post->tag)
                            <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full ml-2">
                                {{ strtoupper($post->tag) }}
                            </span>
                        @endif
                        <p class="text-gray-400 text-sm mt-1">Publicado por: {{ $post->poster ?? 'Anónimo' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection