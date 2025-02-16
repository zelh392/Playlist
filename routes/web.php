<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('playlist.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function() {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::group([
        'prefix' => 'playlist',
        'controller' => PlaylistController::class,
        ], 
        function (){
            Route::get('/', 'index')->withoutMiddleware('auth')->name('playlist.index');
            
            Route::get('/create', 'create')->name('playlist.create');
            Route::post('/', 'store')->name('playlist.store');
            Route::post('/search', 'searchPlaylist')->name('playlist.search');
            Route::delete('/deleteFavorite/{playlist}', 'deleteFavorite')->name("playlist.deleteFavorite");
            Route::get('/all/playlists', 'allPlaylists')->name('playlist.allPlaylists');
            Route::post('/addFavorite', 'addFavoritePlaylist')->name('playlist.addFavorite');
            
            Route::get('/{playlist}', 'show')->name('playlist.show');
            Route::get('/{playlist}/edit', 'edit')->name('playlist.edit');
            Route::put('/{playlist}', 'update')->name('playlist.update');
            Route::delete('/{playlist}', 'destroy')->name('playlist.destroy');
            Route::post('/{song}/addToPlaylist', 'addToPlaylist')->name('playlist.addToPlaylist');
    });
    
    
    Route::group([
        'prefix'     => 'song', 
        'controller' => SongController::class], 
        function (){
            Route::get('/', 'index')->name('song.index');
    
            Route::get('/create', 'create')->name('song.create');
            Route::post('/', 'store')->name('song.store');
            Route::post('/search', 'searchSong')->name('song.search');
    
            Route::get('/{song}', 'show')->name('song.show');
            Route::get('/{song}/edit', 'edit')->name('song.edit');
            Route::put('/{song}', 'update')->name('song.update');
            Route::delete('/{song}', 'destroy')->name('song.destroy');
    });
});


require __DIR__.'/auth.php';
