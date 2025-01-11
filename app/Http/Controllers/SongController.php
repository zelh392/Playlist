<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongRequest;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $playlists = Playlist::where('user_id', Auth::user()->id)->get();
        $songs = Song::all();
        return view('song.index', compact('songs', 'playlists', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('song.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SongRequest $request)
    {
        $fileName = time().'.'.$request->path_song->extension();
        $request->file('path_song')->storeAs('songs', $fileName, 'public');
        
        Song::create([
            'title' => $request->title,
            'author' => $request->author,
            'duration' => $request->duration,
            'path_song' => $fileName,
            'user_id' => Auth::user()->id,
        ]);
        
        return redirect()->route('song.index')->with("success", "Song Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        $user = Auth::user();
        return view('song.show', compact('song', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        return view('song.edit', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SongRequest $request, Song $song)
    {
        $oldPathSong = $song->path_song;
        $fileName = time().'.'.$request->path_song->extension();
        $request->file('path_song')->storeAs('songs', $fileName, 'public');

        $song->update([
            'title' => $request->title,
            'author' => $request->author,
            'duration' => $request->duration,
            'path_song' => $fileName,
            'user_id' => Auth::user()->id,
        ]);

        Storage::disk('public')->delete('songs/'. $oldPathSong);
        return redirect()->route('song.index')->with("success", "Song Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        $oldPathSong = $song->path_song;
        $song->delete($song->id);
        Storage::disk('public')->delete('songs/'. $oldPathSong);
        return redirect()->route('song.index')->with("success", "Song Deleted");
    }

    public function searchSong(Request $request)
    {
        $playlists = Playlist::where('user_id', Auth::user()->id)->get();
        $songs = Song::where('title', 'like', "%{$request->title}%")
        ->where('author', 'like', "%{$request->author}%")->get();
        
        return view('song.index', compact('songs', 'playlists'));        
    }

}
