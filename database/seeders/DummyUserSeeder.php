<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DummyUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Petugas User',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);
        User::create([
            'name' => 'Kepala User',
            'email' => 'kepala@example.com',
            'password' => Hash::make('password'),
            'role' => 'kepala',
        ]);
        User::create([
            'name' => 'Pengirim User',
            'email' => 'pengirim@example.com',
            'password' => Hash::make('password'),
            'role' => 'pengirim',
        ]);
    }
}
