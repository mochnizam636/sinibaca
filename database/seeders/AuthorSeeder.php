<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['name' => 'Tere Liye', 'bio' => 'Penulis novel Indonesia yang terkenal dengan gaya bahasa sederhana dan cerita yang menyentuh.'],
            ['name' => 'Andrea Hirata', 'bio' => 'Penulis terkenal dengan novel Laskar Pelangi yang menceritakan perjuangan anak-anak Belitung.'],
            ['name' => 'Dee Lestari', 'bio' => 'Penyanyi sekaligus penulis fiksi yang dikenal dengan serial Supernova dan novel Aroma Karsa.'],
            ['name' => 'Raditya Dika', 'bio' => 'Komedian dan penulis yang dikenal dengan cerita-cerita humoris tentang kehidupan sehari-hari.'],
            ['name' => 'Fiersa Besari', 'bio' => 'Musisi dan penulis yang terkenal dengan novel-novel romantis dan puisi.'],
            ['name' => 'Ika Natassa', 'bio' => 'Penulis novel populer yang banyak diadaptasi menjadi film layar lebar.'],
            ['name' => 'Leila S. Chudori', 'bio' => 'Jurnalis dan penulis novel sejarah yang telah memenangkan banyak penghargaan sastra.'],
            ['name' => 'Pidi Baiq', 'bio' => 'Seniman multitalenta yang terkenal dengan novel Dilan yang menjadi fenomena.'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
