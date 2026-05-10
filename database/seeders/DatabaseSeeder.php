<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Berita::create([
            'title' => 'Rapat Tahunan',
            'content' => 'Rapat.',
            'category' => 'agenda',
            'date' => '2026-05-15',
        ]);

        \App\Models\Berita::create([
            'title' => 'Ujian Akhir Semester Genap',
            'content' => 'Ujian Akhir Semester Genap',
            'category' => 'agenda',
            'date' => '2026-05-20',
        ]);

        \App\Models\Eskul::create([
            'name' => 'Pramuka',
            'description' => 'Ekstrakurikuler Pramuka',
        ]);

        \App\Models\Agenda::create([
            'title' => 'Rapat Tahunan',
            'description' => 'Rapat .',
            'date' => '2026-05-15',
        ]);
    }
}
