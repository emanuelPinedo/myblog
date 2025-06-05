@extends('layouts.app')

@section('title', 'Editar Post')
    
@section('content')

    <h1>Editar Post</h1>

    <form action="{{ url('category/update/' . $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Título:</label>
        <input type="text" name="title" value="{{ $post->title }}"><br>

        <label>Contenido:</label>
        <textarea name="content">{{ $post->content }}</textarea><br>

        <label>¿Habilitado?</label>
        <input type="checkbox" name="habilitated" {{ $post->habilitated ? 'checked' : '' }}><br>

        <button type="submit">Guardar cambios</button>
    </form>

@endsection