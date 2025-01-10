<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use App\Models\Playlist;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('/playlist', PlaylistController::class);

Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist.index');
Route::get('/playlist/create', [PlaylistController::class, 'create'])->name('playlist.create');
Route::post('/playlist', [PlaylistController::class, 'store'])->name('playlist.store');
Route::get('/playlist/{playlist}', [PlaylistController::class, 'show'])->name('playlist.show');
Route::get('/playlist/{playlist}/edit', [PlaylistController::class, 'edit'])->name('playlist.edit');
Route::put('/playlist/{playlist}', [PlaylistController::class, 'update'])->name('playlist.update');
Route::delete('/playlist/{playlist}', [PlaylistController::class, 'destroy'])->name('playlist.destroy');



Route::resource('/song', SongController::class);
Route::post('/playlist/{song}/addToPlaylist', [PlaylistController::class, 'addToPlaylist'])->name('song.addToPlaylist');
Route::get('/allPlaylists', [PlaylistController::class, 'allPlaylists'])->name('playlist.allPlaylists');

Route::post('/addFavorite', [PlaylistController::class, 'addFavorite'])->name('playlist.addFavorite');


// REVISAR EL PROYECTO Y POSIBLE ERROR EN LAS VALIDACIONES REPASAR


require __DIR__.'/auth.php';
