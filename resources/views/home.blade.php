@extends('layouts.app')

@section('title', 'Laravel 12')
    
@section('content')

@push('css')
    <style>
        body {
            background-color: beige
        }        
    </style>
    
@endpush
    
    <div class="maw-w-4xl mx-auto px-4">
        <h1>Bienvenido a la página principal</h1>
    
        <x-alert2 type="danger" class="mb-4">
            <x-slot name="title">
                <strong>Título de la alerta</strong>
            </x-slot>

            Contenido de la alerta
        </x-alert2>

        <p>Hola mundo</p>

    </div>

@endsection