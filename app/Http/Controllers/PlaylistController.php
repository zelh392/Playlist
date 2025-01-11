<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaylistRequest;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            $playlists = Playlist::where('user_id', $user->id)->get();
            $favoritePlaylists = $user->favoritePlaylists;
            return view('playlist.index', compact('playlists', 'favoritePlaylists'));
        }else{
            return view('playlist.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('playlist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlaylistRequest $request)
    {
        Playlist::create([
            "title" => $request->title,
            "user_id" => Auth::user()->id,
        ]);
        return redirect()->route('playlist.index')->with("success", "PlayList Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        $playlist->load('songs');
        $totalSongs = $playlist->songs()->count();
        $totalDuration = $playlist->songs()->sum('duration');
        $user = Auth::user();
        return view('playlist.show', compact('playlist', 'totalSongs', 'totalDuration', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        return view('playlist.edit', compact('playlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        $playlist->update($request->all());
        return redirect()->route('playlist.index')->with("success", "PlayList Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        $playlist->delete($playlist->id);
        return redirect()->route('playlist.index')->with("danger", "PlayList Deleted");
    }

    public function addToPlaylist(Request $request)
    {
        $playlist = Playlist::findOrFail($request->playlists);
        $exists = $playlist->songs()->where('song_id', $request->song)->exists();
        
        if($exists){
            return redirect()->route('song.index')->with("danger", "Song Exists");
        }
        $playlist->songs()->attach($request->song);
        return redirect()->route('song.index')->with("success", "Song Added Correctly");
    }

    public function allPlaylists()
    {
        $allPlaylists = Playlist::where('user_id', '!=', Auth::user()->id)->get();
        return view('playlist.allPlaylists', compact('allPlaylists'));
    }

    public function addFavorite(Request $request)
    {
        $playlist = Playlist::findOrFail($request->playlist_id);
        $exists = $playlist->favoritedByUser()->where('user_id', Auth::user()->id)->exists();

        if ($exists) {
            return redirect()->route('playlist.index')->with('danger', 'Esta playlist ya está en tus favoritos.');
        }

        $playlist->favoritedByUser()->attach(Auth::user()->id);
        return redirect()->route('playlist.index')->with('success', 'Playlist añadida a tus favoritos.');
    }

    public function deleteFavorite(Request $request, $playlist_id)
    {
        $playlist = Playlist::findOrFail($playlist_id);
        $playlist->favoritedByUser()->detach(Auth::user()->id);
        return redirect()->route('playlist.index')->with('success', 'Playlist borrada de tus favoritos.');
    }

    public function searchPlaylist(Request $request)
    {
        $allPlaylists = Playlist::where('title', 'like', "%{$request->title}%")
        ->where('user_id', '!=', Auth::user()->id)->get();
        return view('playlist.allPlaylists', compact('allPlaylists'));
    }
      
}
