@extends('layouts.app')

@section('title', 'Laravel 12')
    
@section('content')

    <h1>{{ $post->title }}</h1>
    <p><strong>Autor:</strong> {{ $post->poster }}</p>
    <p><strong>Contenido:</strong> {{ $post->content }}</p>
    <p><strong>¿Habilitado?:</strong> {{ $post->habilitated ? 'Sí' : 'No' }}</p>
    <a href="{{ url('category/edit/' . $post->id) }}">Editar</a>

@endsection