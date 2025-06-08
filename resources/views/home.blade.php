@extends('layouts.app')

@section('title', 'Ñeddit - Home')

@push('css')
    <style>
        body {
            background-color: beige;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-white">Bienvenido a Ñeddit, página de posts random!!!</h1>

        {{--<x-alert2 type="success" class="mb-4">
            <x-slot name="title">
                <strong>Alerta</strong>
            </x-slot>
            No se, es una alerta flaco
        </x-alert2>--}}

        {{--ver ultimos 3 posts subidos--}}
        @forelse ($posts as $post)
            <x-post-card :post="$post" :editable="false" />
        @empty
                <div class="bg-gray-700 text-white rounded-lg p-4 shadow-md mb-6 text-center">
                    No hay posts disponibles.
                </div>
        @endforelse
    </div>
@endsection