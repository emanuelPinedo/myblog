@extends('layouts.app')

@section('title', 'Crear Post')
    
@section('content')

    <h1>Crear nuevo Post</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('category/store') }}" method="POST">
        @csrf

        <label for="title">Título:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        {{--campo oculto q da el nombre del user logeado--}}
        <input type="hidden" name="poster" value="{{ Auth::user()->name }}">

        <label for="content">Contenido:</label><br>
        <textarea id="content" name="content" rows="5" required></textarea><br><br>

        <label for="habilitated">¿Habilitado?</label>
        <input type="checkbox" id="habilitated" name="habilitated"><br><br>

        <button type="submit">Guardar</button>
    </form>

@endsection