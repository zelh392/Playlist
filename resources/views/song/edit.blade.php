@extends('playlist.app')

@section('content')

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif


    <a href="{{ route('song.index') }}">Volver a las canciones</a><br><br>

    <h1>Modifica la canción</h1>

    <form action="{{ route('song.update', $song->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div>
            <label for="title">Título de la canción:</label>
            <input type="text" name="title" id="title"  value="{{ $song->title }}">
        </div><br>
        
        <div>
            <label for="author">Autor de la canción:</label>
            <input type="text" name="author" id="author" value="{{ $song->author }}">
        </div><br>

        <div>
            <label for="duration">Duración de la canción (en segundos):</label>
            <input type="number" name="duration" id="duration" value="{{ $song->duration }}" min="1">
        </div><br>

        <div>
            <label for="path_song">Selecciona el archivo de la canción:</label>
            <input type="file" name="path_song" id="path_song" accept=".mp3">
        </div><br>

        <input type="submit" value="Editar Canción">
    </form>

@endsection