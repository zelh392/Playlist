@extends('playlist.app')

@section('content')

    <a href="{{ route('playlist.index') }}">Volver al inicio</a><br><br>

    <h1>{{ $playlist->title }}</h1>

    <h3>Número de canciones: {{ $totalSongs }} canción(es)</h3>
    <h3>Duración {{ gmdate("i:s", $totalDuration) }} </h3>

    @if($playlist->user_id === $user->id)
        <a href="{{ route('playlist.edit', $playlist->id ) }}">Editar Playlist</a>
    @endif
    
    @if ($playlist->songs->isEmpty())
        <p>No hay canciones en esta playlist. ¡Añade algunas para disfrutar de tu música!</p>
    @else
        <h4>Lista de canciones:</h4>
        <ul>
            @foreach ($playlist->songs as $song)
                <li>
                    <strong>{{ $song->title }}</strong> - {{ $song->author }} 
                    ({{ gmdate('i:s', $song->duration) }})
                    <audio controls src="{{ asset('storage/songs/'. $song->path_song) }}"></audio>
                </li>
            @endforeach
        </ul>
    @endif

@endsection
