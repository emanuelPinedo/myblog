@extends('layouts.app')

@section('title', 'Ñeddit - Categorías')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-white">Todos los Posts!!!</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{--busqueda de psts --}}
    <form method="GET" action="{{ url('category') }}" class="mb-6">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Buscar posts..."
            class="px-4 py-2 rounded w-full text-black"
        />
    </form>

    <div class="space-y-4">
        @forelse ($posts as $post)
            <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md">
                <a href="{{ url('category/show/' . $post->id) }}" class="text-lg font-semibold hover:underline">
                    {{ $post->title }}
                </a>

                <p class="text-sm text-gray-300 mb-2">{{ $post->created_at->diffForHumans() }}</p>

                @if ($post->poster)
                    @php
                        $poster = $post->poster;
                        $isImage = preg_match('/\.(jpg|jpeg|png|gif|webp)(\?.*)?$/i', $poster);
                    @endphp

                    @if ($isImage)
                        <div class="mt-2">
                            <img src="{{ $poster }}" alt="Imagen" class="w-full max-h-64 object-cover rounded mt-2">
                        </div>
                    @endif
                @endif

                <p class="text-gray-400 text-sm mt-2">Publicado por: {{ $post->user->name ?? 'Anónimo' }}</p>
            </div>
        @empty
            <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md mb-6 text-center">
                @if (request('search'))
                    No se encontraron resultados para: <strong>"{{ request('search') }}"</strong>
                @else
                    No hay posts disponibles.
                @endif
            </div>
        @endforelse

        {{-- Paginación --}}
        @if ($posts->hasPages())
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection