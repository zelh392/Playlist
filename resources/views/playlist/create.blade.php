@extends('playlist.app')

@section('content')

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <a href="{{ route('playlist.index') }}">Regresar al inicio</a><br><br>
    <h1>Crear una nueva Playlist</h1>

    <p>Ingresa el título de tu nueva Playlist y crea tu propia colección musical.</p>

    <form action="{{ route('playlist.store') }}" method="post">
        @csrf
        <label for="title">Título de la Playlist:</label><br>
        <input type="text" name="title" id="title" placeholder="Escribe el título aquí"><br><br>
        <input type="submit" value="Crear Playlist">
    </form>

@endsection
