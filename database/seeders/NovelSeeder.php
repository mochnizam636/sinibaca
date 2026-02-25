<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Novel;
use App\Models\NovelChapter;
use Illuminate\Database\Seeder;

class NovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $novels = [
            [
                'title' => 'Sang Pemimpi: Petualangan di Negeri Fantasi',
                'description' => "Di sebuah desa kecil di pinggiran hutan mistis, hiduplah seorang pemuda bernama Ardan. Ia memiliki kemampuan unik yang tidak dimiliki orang lain: dapat berkomunikasi dengan makhluk gaib.\n\nSuatu hari, sebuah portal terbuka dan membawanya ke dunia yang penuh keajaiban. Di sana, ia harus menghadapi berbagai tantangan dan menemukan jati dirinya yang sebenarnya.",
                'genre' => 'Fantasy',
                'category' => 'Web Novel',
                'author' => 'Tere Liye',
                'chapters' => [
                    ['title' => 'Chapter 1: Awal Mula', 'content' => "Pagi itu, langit tampak lebih cerah dari biasanya. Ardan terbangun dengan perasaan aneh yang tidak bisa ia jelaskan.\n\nEntah mengapa, ia merasa hari ini akan menjadi hari yang berbeda. Sebuah perjalanan besar akan segera dimulai.\n\n\"Nak, sarapanmu sudah siap!\" teriak ibunya dari dapur.\n\nArdan beranjak dari tempat tidurnya yang sederhana. Rumah mereka memang tidak mewah, hanya sebuah gubuk kayu di pinggir hutan. Tapi bagi Ardan, ini adalah rumah yang penuh kehangatan."],
                    ['title' => 'Chapter 2: Portal Misterius', 'content' => "Setelah sarapan, Ardan pergi ke hutan seperti biasa untuk mengumpulkan kayu bakar.\n\nNetapi hari ini berbeda. Di tengah hutan, ia menemukan sesuatu yang tidak pernah ia lihat sebelumnya: sebuah lingkaran cahaya yang berputar perlahan.\n\n\"Apa ini?\" gumamnya takjub.\n\nCahaya itu berdenyut seperti jantung yang berdetak. Warna-warni yang indah berkilauan, seakan memanggil Ardan untuk mendekat.\n\nTanpa ia sadari, kakinya telah melangkah masuk ke dalam lingkaran cahaya tersebut."],
                    ['title' => 'Chapter 3: Dunia Baru', 'content' => "Ketika Ardan membuka matanya, ia sudah berada di tempat yang sama sekali berbeda.\n\nPepohonan raksasa menjulang tinggi hingga awan. Bunga-bunga yang belum pernah ia lihat bermekaran di mana-mana. Makhluk-makhluk aneh berterbangan di udara.\n\n\"Selamat datang di Aetheria,\" sebuah suara menyapanya.\n\nArdan menoleh dan melihat seorang gadis dengan sayap transparan berdiri di hadapannya. Senyumnya ramah, tapi matanya menyimpan kesedihan yang dalam."],
                ],
            ],
            [
                'title' => 'Cinta di Ujung Waktu',
                'description' => "Sebuah kisah cinta yang melampaui batas waktu. Ketika Raina, seorang mahasiswi biasa, menemukan sebuah jam tangan antik misterius, hidupnya berubah selamanya.\n\nJam tangan itu membawanya ke masa lalu, di mana ia bertemu dengan Alexi, seorang pangeran dari kerajaan yang sudah lama hilang. Di antara dua zaman yang berbeda, dapatkah cinta mereka bertahan?",
                'genre' => 'Romance',
                'category' => 'Original',
                'author' => 'Dee Lestari',
                'chapters' => [
                    ['title' => 'Chapter 1: Penemuan Tak Terduga', 'content' => "Toko barang antik itu seharusnya sudah tutup. Tapi entah mengapa, Raina tertarik untuk masuk.\n\nDi antara tumpukan barang-barang tua berdebu, sebuah jam tangan emas menarik perhatiannya. Jam itu bersinar samar, seakan memanggilnya.\n\n\"Berapa harganya, Pak?\" tanyanya pada si pemilik toko.\n\nPria tua itu tersenyum misterius. \"Untuk kamu, gratis. Jam itu sudah menunggumu sejak lama.\""],
                    ['title' => 'Chapter 2: Kilatan Cahaya', 'content' => "Malam itu, ketika Raina sedang belajar untuk ujian, jam tangan itu tiba-tiba bersinar terang.\n\nSebelum ia sempat bereaksi, seluruh ruangan berputar. Ketika cahaya mereda, ia tidak lagi berada di kamarnya.\n\nIstana megah berdiri di hadapannya. Pelayan-pelayan berpakaian kuno berlalu-lalang.\n\n\"Siapa kau?\" sebuah suara tegas membuatnya menoleh.\n\nSeorang pemuda tampan dengan mahkota emas menatapnya tajam."],
                ],
            ],
            [
                'title' => 'Misteri Rumah Tua di Bukit',
                'description' => "Desa Sukamaju selalu tenang dan damai. Sampai sebuah rumah tua di bukit mulai menunjukkan tanda-tanda kehidupan setelah ditinggalkan selama 50 tahun.\n\nTiga sahabat - Budi, Ani, dan Doni - memutuskan untuk mengungkap rahasia di balik rumah misterius itu. Tapi apa yang mereka temukan jauh lebih mengerikan dari yang mereka bayangkan.",
                'genre' => 'Mystery',
                'category' => 'Novel Indonesia',
                'author' => 'Andrea Hirata',
                'chapters' => [
                    ['title' => 'Chapter 1: Rumor yang Tersebar', 'content' => "\"Kalian dengar tidak? Katanya ada suara-suara aneh dari rumah tua itu.\"\n\nBudi menelan ludahnya. Rumah tua di bukit memang selalu menjadi bahan pembicaraan penduduk desa.\n\n\"Ah, itu kan cuma cerita bohong,\" kata Doni, berusaha terlihat berani.\n\nAni menggeleng. \"Tapi nenek bilang, dulu ada kejadian mengerikan di sana. Satu keluarga menghilang tanpa jejak.\""],
                ],
            ],
            [
                'title' => 'Petualangan Si Kucing Ajaib',
                'description' => "Mochi adalah kucing biasa yang dipelihara oleh seorang anak bernama Lily. Tapi suatu hari, Mochi terbangun dengan kemampuan berbicara dan kekuatan ajaib!\n\nBersama Lily, mereka berkelana ke berbagai tempat, membantu siapa saja yang membutuhkan. Sebuah cerita petualangan yang hangat dan penuh kebaikan hati.",
                'genre' => 'Adventure',
                'category' => 'Light Novel',
                'author' => 'Raditya Dika',
                'chapters' => [
                    ['title' => 'Chapter 1: Bangun yang Berbeda', 'content' => "Mochi selalu tidur di tempat yang sama: kaki tempat tidur Lily.\n\nTapi pagi ini, ia terbangun dengan perasaan aneh. Seolah-olah sesuatu dalam dirinya telah berubah.\n\n\"Meow...\" ia menguap. Wait, itu bukan meow. Itu... suara?\n\n\"Aku bisa bicara?!\" teriaknya.\n\nLily langsung terbangun dan jatuh dari tempat tidur."],
                ],
            ],
            [
                'title' => 'Legenda Pedang Naga',
                'description' => "Di era kerajaan kuno, sebuah pedang legendaris tersembunyi di puncak gunung tertinggi. Pedang ini konon bisa memberikan kekuatan luar biasa kepada pemiliknya.\n\nWei Long, seorang pemuda yatim piatu, memulai perjalanannya untuk menemukan pedang itu. Tapi jalan yang harus ia tempuh penuh dengan bahaya dan pengkhianatan.",
                'genre' => 'Action',
                'category' => 'Xianxia',
                'author' => 'Leila S. Chudori',
                'chapters' => [
                    ['title' => 'Chapter 1: Pemuda dari Desa Miskin', 'content' => "Wei Long tidak memiliki apa-apa. Orang tuanya meninggal saat ia masih kecil, dan ia dibesarkan oleh tetangga yang baik hati.\n\nTapi ia memiliki satu hal yang tidak dimiliki orang lain: tekad yang membara.\n\n\"Suatu hari, aku akan menjadi yang terkuat,\" janjinya pada diri sendiri.\n\nDan hari itu, perjalanannya dimulai."],
                ],
            ],
        ];

        foreach ($novels as $novelData) {
            $author = Author::where('name', $novelData['author'])->first();
            $genre = Genre::where('name', $novelData['genre'])->first();
            $category = Category::where('name', $novelData['category'])->first();

            $novel = Novel::create([
                'title' => $novelData['title'],
                'description' => $novelData['description'],
                'author_id' => $author?->id ?? 1,
                'genre_id' => $genre?->id ?? 1,
                'category_id' => $category?->id ?? 1,
                'status' => 'published',
                'total_views' => rand(100, 10000),
            ]);

            foreach ($novelData['chapters'] as $index => $chapterData) {
                NovelChapter::create([
                    'novel_id' => $novel->id,
                    'title' => $chapterData['title'],
                    'content' => $chapterData['content'],
                    'chapter_number' => $index + 1,
                    'views' => rand(50, 2000),
                ]);
            }
        }
    }
}
