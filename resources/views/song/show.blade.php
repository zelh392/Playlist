@extends('playlist.app')

@section('content')

    <a href="{{ route('song.index') }}">Volver a las canciones</a>

    <h1>{{ $song->title }}</h1>
    @if($song->user_id === $user->id)
        <a href="{{ route('song.edit', $song->id ) }}">Editar</a>
    @endif
    <form action="{{ route('song.destroy', $song->id) }}" method="post" style="display:inline;">
        @csrf
        @method('delete')
        <input type="submit" value="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta playlist?')">
    </form><br><br>
    <h3>Autor: {{ $song->author }}</h3>
    <h3>Duración: {{ gmdate('i:s', $song->duration) }}</h3>
    <audio controls src="{{ asset('storage/songs/'. $song->path_song) }}"></audio>

@endsection
