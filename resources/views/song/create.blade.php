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

    <h1>Sube una canción nueva</h1>

    <p>¡Comparte tu música! Rellena el formulario para subir una nueva canción a la plataforma.</p>

    <form action="{{ route('song.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Título de la canción:</label>
            <input type="text" name="title" id="title" placeholder="Título">
        </div><br>
        
        <div>
            <label for="author">Autor de la canción:</label>
            <input type="text" name="author" id="author" placeholder="Autor">
        </div><br>

        <div>
            <label for="duration">Duración de la canción (en segundos):</label>
            <input type="number" name="duration" id="duration" placeholder="Duración" min="1">
        </div><br>

        <div>
            <label for="path_song">Selecciona el archivo de la canción:</label>
            <input type="file" name="path_song" id="path_song" accept=".mp3">
        </div><br>

        <input type="submit" value="Subir Canción">
    </form>

@endsection
