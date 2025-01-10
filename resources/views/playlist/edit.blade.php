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

    <h1>Editar Playlist: {{ $playlist->title }}</h1>

    <p>Modifica el título de tu Playlist y guarda los cambios.</p>

    <form action="{{ route('playlist.update', $playlist->id) }}" method="post">
        @csrf
        @method('put')
        <label for="title">Nuevo título:</label><br>
        <input type="text" name="title" id="title" value="{{ $playlist->title }}" required><br><br>
        @error('title')
            <p style="color: red">{{ $message }}</p>
        @enderror

        <input type="submit" value="Guardar cambios">
    </form>

@endsection
