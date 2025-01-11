@extends('playlist.app')

@section('content')

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    

    <a href="{{ route('playlist.index') }}">← Volver al inicio</a>

    <h1>Todas las canciones</h1>

    <div>
        <form action="{{ route('song.search') }}" method="post">
            @csrf
            <input type="text" name="title" placeholder="Buscar por Nombre">
            <input type="text" name="author" placeholder="Buscar por Autor">
            <input type="submit" value="Buscar">
        </form>
    </div><br>

    <div>
        <a href="{{ route('song.create') }}">Añadir una nueva canción</a>
    </div>

    <hr>

    <h2>Mis Canciones</h2>

    @forelse($songs as $song)
        @if($song->user_id === $user->id)
            <div>
                <h3><a href="{{ route('song.show', $song->id) }}">{{ $song->title }}</a></h3>
                <audio controls src="{{ asset('storage/songs/'. $song->path_song) }}"></audio><br>
                @if($song->user_id === $user->id)
                    <a href="{{ route('song.edit', $song->id ) }}">Editar</a>
                @endif
                <form action="{{ route('song.destroy', $song->id) }}" method="post" style="display:inline;">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta playlist?')">
                </form><br><br>
            </div>
            
            <div>
                <form action="{{ route('song.addToPlaylist', $song->id) }}" method="POST">
                    @csrf
                    <label for="playlists">Añadir a la Playlist:</label>
                    <select name="playlists" id="playlists">
                        @foreach($playlists as $playlist)
                            <option value="{{ $playlist->id }}">{{ $playlist->title }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Añadir">
                </form>
            </div><br>
        @endif
    
    @empty
        <p>No hay ninguna canción añadida por ti.</p>
    @endforelse


    <h2>Lista de canciones</h2>

    @forelse($songs as $song)
        @if($song->user_id !== $user->id)
            <div>
                <h3><a href="{{ route('song.show', $song->id) }}">{{ $song->title }}</a></h3>
                <audio controls src="{{ asset('storage/songs/'. $song->path_song) }}"></audio><br>
            </div>
            
            <div>
                <form action="{{ route('song.addToPlaylist', $song->id) }}" method="POST">
                    @csrf
                    <label for="playlists">Añadir a la Playlist:</label>
                    <select name="playlists" id="playlists">
                        @foreach($playlists as $playlist)
                            <option value="{{ $playlist->id }}">{{ $playlist->title }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Añadir">
                </form>
            </div><br>
        @endif
        
    @empty
        <p>No hay ninguna canción añadida.</p>
    @endforelse

@endsection
