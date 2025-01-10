<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model
{
    protected $fillable = [
        'title',
        'user_id',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'song_playlist');
    }

    public function favoritedByUser(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_playlist_favorites');
    }

}
