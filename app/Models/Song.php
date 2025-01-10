<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    protected $fillable = [
        'title',
        'author',
        'duration',
        'path_song',
        'user_id',
    ];


    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }

}
