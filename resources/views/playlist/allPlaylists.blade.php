@extends('playlist.app')

@section('content')

    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li style="color: red">{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <a href="{{ route('playlist.index') }}">← Volver al inicio</a><br><br>

    <h1>Explora todas las Playlists</h1>

    <div>
        <form action="{{ route('playlist.search') }}" method="post">
            @csrf
            <input type="text" name="title" placeholder="Buscar por Nombre">
            <input type="submit" value="Buscar">
        </form>
    </div>

    <h2>Lista de Playlists</h2>
    
    <ul>
        @forelse($allPlaylists as $allPlaylist)
            <li>
                <strong>{{ $allPlaylist->title }}</strong>
                
                <form action="{{ route('playlist.addFavorite') }}" method="post" style="display:inline;">
                    @csrf
                    <input type="hidden" name="playlist_id" value="{{ $allPlaylist->id }}">
                    <input type="submit" value="Añadir a Favoritos">
                </form>
            </li><br>
        @empty
            <p>No hay ninguna Playlist añadida. ¡Explora más!</p>
        @endforelse
    </ul>

@endsection
