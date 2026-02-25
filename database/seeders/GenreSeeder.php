<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Romance',
            'Fantasy',
            'Action',
            'Adventure',
            'Horror',
            'Mystery',
            'Thriller',
            'Comedy',
            'Drama',
            'Sci-Fi',
            'Historical',
            'Slice of Life',
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
