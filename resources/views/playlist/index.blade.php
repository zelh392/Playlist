@extends('playlist.app')

@section('title', 'SoundSpace')

@section('content')

    @auth
        <div>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <input type="submit" value="Cerrar Sesión">
            </form>
        </div>

        <div>
            <h1>SoundSpace</h1>
            <h2>¡Bienvenido, {{ Auth::user()->name }}!</h2>
            <nav>
                <ul>
                    <li><a href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                    <li><a href="{{ route('song.index') }}">Ver todas las canciones</a></li>
                    <li><a href="{{ route('playlist.allPlaylists') }}">Explorar otras Playlists</a></li>
                    <li><a href="{{ route('playlist.create') }}">Crear una nueva Playlist</a></li>
                </ul>
            </nav>
        </div>

        <section>
            <h2>Mis Playlists</h2>

            @forelse($playlists as $playlist)
                <div>
                    <a href="{{ route('playlist.show', $playlist->id) }}">{{ $playlist->title }}</a>
                    <span> || </span>
                    <a href="{{ route('playlist.edit', $playlist->id ) }}">Editar</a>
                    <span> || </span>
                    <form action="{{ route('playlist.destroy', $playlist->id) }}" method="post" style="display:inline;">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta playlist?')">
                    </form>
                </div><br>
            @empty
                <p>Aún no has creado ninguna Playlist. ¡Crea una ahora!</p>
            @endforelse
        </section>

        <section>
            <h2>Mis Playlists Favoritas</h2>

            @forelse($favoritePlaylists as $favoritePlaylist)
                <div>
                    <a href="{{ route('playlist.show', $favoritePlaylist->id) }}">{{ $favoritePlaylist->title }}</a>
                    <span> || </span>
                    <form action="{{ route('playlist.deleteFavorite', $favoritePlaylist->id) }}" method="post" style="display:inline;">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta playlist de tus favoritos?')">
                    </form>
                </div><br>
            @empty
                <p>No tienes playlists favoritas por el momento. Añade algunas a favoritos para que aparezcan aquí.</p>
            @endforelse
        </section>

    @else
        <div>
            <h1>Bienvenido a SoundSpace</h1>
            <p>¡Descubre y crea tus playlists favoritas! Inicia sesión o regístrate para empezar.</p>
            <a href="{{ route('login') }}">Iniciar Sesión</a> | <a href="{{ route('register') }}">Registrarse</a>
        </div>
    @endauth

@endsection
