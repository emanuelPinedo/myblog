{{--<x-app-layout>--}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-white">Tus Posts</h2>

        @forelse ($posts as $post)
            <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md mb-6">
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

                <form method="POST" action="{{ url('category/update-habilitated/' . $post->id) }}" class="mt-4">
                    @csrf
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="habilitated" value="1" {{ $post->habilitated ? 'checked' : '' }}>
                        <span>Habilitado</span>
                    </label>
                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded">
                        Guardar
                    </button>
                </form>
            </div>
        @empty
            <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md mb-6 text-center">
                Aún no has posteado nada.
            </div>
        @endforelse
    </div>
@endsection
{{--</x-app-layout>--}}