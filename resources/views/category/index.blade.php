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

    <x-search-input action="/category" />

    @forelse ($posts as $post)
        <x-post-card :post="$post" :editable="false" />
    @empty
        <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md mb-6 text-center">
            @if (request('search'))
                No se encontraron resultados para: <strong>"{{ request('search') }}"</strong>
            @else
                No hay posts disponibles.
            @endif
    @endforelse


    {{--paginacion --}}
    @if ($posts->hasPages())
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection