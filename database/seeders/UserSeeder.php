<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'MovieGather Admin',
            'email' => 'admin@moviegather.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // User Demo
        User::create([
            'name' => 'Movie Lover',
            'email' => 'user@moviegather.com',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);

        // User random
        User::factory(8)->create();
    }
}