<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Administrador",
            "email" => "admin@admin.es",
            "password" => Hash::make("659735061"),
        ]);
        
        User::create([
            "name" => "Juan",
            "email" => "juan@juan.es",
            "password" => Hash::make("659735061"),
        ]);

        User::create([
            "name" => "Pepe",
            "email" => "pepe@pepe.es",
            "password" => Hash::make("659735061"),
        ]);
    }
}
