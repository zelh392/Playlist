@extends('playlist.app')

@section('content')

    <a href="{{ route('song.index') }}">Volver a las canciones</a>

    <h1>{{ $song->title }}</h1>
    <h3>Autor: {{ $song->author }}</h3>
    <h3>Duración: {{ gmdate('i:s', $song->duration) }}</h3>

@endsection
