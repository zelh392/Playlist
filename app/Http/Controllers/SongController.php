<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongRequest;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playlists = Playlist::where('user_id', Auth::user()->id)->get();
        $songs = Song::all();
        return view('song.index', compact('songs', 'playlists'));
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
        
        // dd("si estoy aqui ha validado correctamente");
        return redirect()->route('song.index')->with("succes", "Song Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        return view('song.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SongRequest $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        //
    }

    
}
