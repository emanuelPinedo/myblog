{{--<x-app-layout>--}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-white">Tus Posts</h2>

        @forelse ($posts as $post)
        <x-post-card :post="$post" :editable="true" />
        @empty
            <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md mb-6 text-center">
                Aún no has posteado nada.
            </div>
        @endforelse
    </div>
@endsection
{{--</x-app-layout>--}}