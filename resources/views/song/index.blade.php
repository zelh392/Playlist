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
        <a href="{{ route('song.create') }}">Añadir una nueva canción</a>
    </div>

    <hr>

    <h2>Lista de canciones</h2>

    @forelse($songs as $song)
        <div>
            {{-- @dd($song->path_song) --}}
            <a href="{{ route('song.show', $song->id) }}">{{ $song->title }}</a>
            <audio controls src="{{ asset('storage/songs/'. $song->path_song) }}"></audio>
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
        
    @empty
        <p>No hay ninguna canción añadida.</p>
    @endforelse

@endsection
