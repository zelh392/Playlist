<?php

namespace Database\Seeders;

use App\Models\Playlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;


class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Playlist::create([
            "title" => "POP",
            "user_id" => 1,
        ]);

        Playlist::create([
            "title" => "Trapeo",
            "user_id" => 1,
        ]);

        Playlist::create([
            "title" => "Top 50",
            "user_id" => 2,
        ]);

        Playlist::create([
            "title" => "Flamenco",
            "user_id" => 3,
        ]);
    }
}
