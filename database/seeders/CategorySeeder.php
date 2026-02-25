<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Novel', 'description' => 'Novel yang dipublikasikan secara online dengan update berkala.'],
            ['name' => 'Light Novel', 'description' => 'Novel ringan dengan ilustrasi, populer di Jepang.'],
            ['name' => 'Wuxia', 'description' => 'Novel seni bela diri dari China dengan unsur mistis.'],
            ['name' => 'Xianxia', 'description' => 'Novel fantasi China tentang kultivasi dan keabadian.'],
            ['name' => 'Novel Indonesia', 'description' => 'Novel karya penulis Indonesia.'],
            ['name' => 'Terjemahan', 'description' => 'Novel yang diterjemahkan dari bahasa asing.'],
            ['name' => 'Fan Fiction', 'description' => 'Cerita yang dibuat penggemar berdasarkan karya lain.'],
            ['name' => 'Original', 'description' => 'Novel asli dengan cerita dan karakter orisinal.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
