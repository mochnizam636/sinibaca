-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2026 at 01:03 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novel_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Tere Liye', 'Penulis novel Indonesia yang terkenal dengan gaya bahasa sederhana dan cerita yang menyentuh.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(2, 'Andrea Hirata', 'Penulis terkenal dengan novel Laskar Pelangi yang menceritakan perjuangan anak-anak Belitung.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(3, 'Dee Lestari', 'Penyanyi sekaligus penulis fiksi yang dikenal dengan serial Supernova dan novel Aroma Karsa.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(4, 'Raditya Dika', 'Komedian dan penulis yang dikenal dengan cerita-cerita humoris tentang kehidupan sehari-hari.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(5, 'Fiersa Besari', 'Musisi dan penulis yang terkenal dengan novel-novel romantis dan puisi.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(6, 'Ika Natassa', 'Penulis novel populer yang banyak diadaptasi menjadi film layar lebar.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(7, 'Leila S. Chudori', 'Jurnalis dan penulis novel sejarah yang telah memenangkan banyak penghargaan sastra.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(8, 'Pidi Baiq', 'Seniman multitalenta yang terkenal dengan novel Dilan yang menjadi fenomena.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(9, 'Unknown', NULL, '2026-02-03 17:54:16', '2026-02-03 17:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `genre_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `page_count` int UNSIGNED DEFAULT NULL,
  `total_views` int UNSIGNED NOT NULL DEFAULT '0',
  `content_long` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_chapters`
--

CREATE TABLE `book_chapters` (
  `id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapter_number` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-penjual@toko.com|127.0.0.1', 'i:2;', 1770380708),
('laravel-cache-penjual@toko.com|127.0.0.1:timer', 'i:1770380708;', 1770380708);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Web Novel', 'Novel yang dipublikasikan secara online dengan update berkala.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(2, 'Light Novel', 'Novel ringan dengan ilustrasi, populer di Jepang.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(3, 'Wuxia', 'Novel seni bela diri dari China dengan unsur mistis.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(4, 'Xianxia', 'Novel fantasi China tentang kultivasi dan keabadian.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(5, 'Novel Indonesia', 'Novel karya penulis Indonesia.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(6, 'Terjemahan', 'Novel yang diterjemahkan dari bahasa asing.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(7, 'Fan Fiction', 'Cerita yang dibuat penggemar berdasarkan karya lain.', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(8, 'Original', 'Novel asli dengan cerita dan karakter orisinal.', '2026-02-01 20:51:58', '2026-02-01 20:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bantuan',
  `status` enum('open','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `user_id`, `subject`, `status`, `created_at`, `updated_at`) VALUES
(4, 6, 'Bantuan', 'closed', '2026-02-10 10:53:37', '2026-02-12 06:33:49'),
(5, 7, 'Bantuan', 'open', '2026-02-10 10:55:53', '2026-02-10 10:56:43'),
(6, 5, 'Bantuan', 'open', '2026-02-11 01:17:23', '2026-02-11 01:17:23'),
(7, 8, 'Bantuan', 'open', '2026-02-12 05:57:44', '2026-02-12 05:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `chat_id` bigint UNSIGNED NOT NULL,
  `sender_type` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `chat_id`, `sender_type`, `sender_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(8, 4, 'admin', 0, 'Halo! 👋 Selamat datang di BacaNovel. Ada yang bisa kami bantu? Silakan tanyakan tentang novel, langganan premium, atau apapun!', 1, '2026-02-10 10:53:37', '2026-02-10 10:53:40'),
(9, 4, 'user', 6, 'haloo', 1, '2026-02-10 10:53:51', '2026-02-12 06:33:44'),
(10, 5, 'admin', 0, 'Halo! 👋 Selamat datang di BacaNovel. Ada yang bisa kami bantu? Silakan tanyakan tentang novel, langganan premium, atau apapun!', 1, '2026-02-10 10:55:53', '2026-02-10 10:55:55'),
(11, 5, 'user', 7, 'haloo', 1, '2026-02-10 10:56:00', '2026-02-10 10:56:35'),
(12, 5, 'admin', 1, 'halo jugaa', 1, '2026-02-10 10:56:43', '2026-02-10 10:57:22'),
(13, 6, 'admin', 0, 'Halo! 👋 Selamat datang di BacaNovel. Ada yang bisa kami bantu? Silakan tanyakan tentang novel, langganan premium, atau apapun!', 1, '2026-02-11 01:17:23', '2026-02-11 01:17:24'),
(14, 7, 'admin', 0, 'Halo! 👋 Selamat datang di BacaNovel. Ada yang bisa kami bantu? Silakan tanyakan tentang novel, langganan premium, atau apapun!', 1, '2026-02-12 05:57:44', '2026-02-12 05:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Romance', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(2, 'Fantasy', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(3, 'Action', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(4, 'Adventure', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(5, 'Horror', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(6, 'Mystery', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(7, 'Thriller', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(8, 'Comedy', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(9, 'Drama', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(10, 'Sci-Fi', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(11, 'Historical', '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(12, 'Slice of Life', '2026-02-01 20:51:58', '2026-02-01 20:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `library_items`
--

CREATE TABLE `library_items` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `status` enum('bookmark','readlist','history') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bookmark',
  `progress` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `library_items`
--

INSERT INTO `library_items` (`id`, `user_id`, `item_type`, `item_id`, `status`, `progress`, `created_at`, `updated_at`) VALUES
(1, 1, 'novel', 5, 'history', 8, '2026-02-02 07:36:06', '2026-02-02 07:36:06'),
(2, 1, 'novel', 4, 'history', 7, '2026-02-02 17:51:41', '2026-02-02 17:51:41'),
(3, 2, 'novel', 6, 'history', 11, '2026-02-04 17:28:56', '2026-02-04 17:31:51'),
(4, 2, 'novel', 1, 'readlist', NULL, '2026-02-04 17:30:41', '2026-02-04 17:30:41'),
(5, 2, 'novel', 2, 'readlist', NULL, '2026-02-04 17:31:00', '2026-02-04 17:31:00'),
(6, 5, 'novel', 6, 'history', 9, '2026-02-06 05:29:09', '2026-02-06 05:29:09'),
(7, 8, 'novel', 6, 'history', 9, '2026-02-12 06:08:27', '2026-02-12 06:08:27'),
(8, 9, 'novel', 6, 'history', 9, '2026-02-12 06:37:35', '2026-02-12 06:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_02_000001_create_authors_table', 1),
(5, '2026_02_02_000002_create_genres_table', 1),
(6, '2026_02_02_000003_create_categories_table', 1),
(7, '2026_02_02_000004_create_novels_table', 1),
(8, '2026_02_02_000005_create_novel_chapters_table', 1),
(9, '2026_02_02_000006_create_books_table', 1),
(10, '2026_02_02_000007_create_book_chapters_table', 1),
(11, '2026_02_02_000008_create_library_items_table', 1),
(12, '2026_02_02_000009_create_reviews_table', 1),
(13, '2026_02_02_225127_add_is_featured_to_novels_table', 2),
(14, '2026_02_06_120818_add_is_premium_to_novels_table', 3),
(15, '2026_02_06_120818_create_subscriptions_table', 3),
(16, '2026_02_06_120908_create_transactions_table', 3),
(17, '2026_02_10_100000_create_chats_table', 4),
(18, '2026_02_10_100001_create_chat_messages_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `novels`
--

CREATE TABLE `novels` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `genre_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_premium` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `total_views` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `novels`
--

INSERT INTO `novels` (`id`, `title`, `description`, `cover_image`, `author_id`, `genre_id`, `category_id`, `status`, `is_premium`, `is_featured`, `total_views`, `created_at`, `updated_at`) VALUES
(1, 'Sang Pemimpi: Petualangan di Negeri Fantasi', 'Di sebuah desa kecil di pinggiran hutan mistis, hiduplah seorang pemuda bernama Ardan. Ia memiliki kemampuan unik yang tidak dimiliki orang lain: dapat berkomunikasi dengan makhluk gaib.\r\n\r\nSuatu hari, sebuah portal terbuka dan membawanya ke dunia yang penuh keajaiban. Di sana, ia harus menghadapi berbagai tantangan dan menemukan jati dirinya yang sebenarnya.', 'covers/JQKDFcMlfj2S9VOpJhnSe0T9UtVbtTsKNaMc0PCl.jpg', 1, 2, 1, 'published', 0, 0, 9388, '2026-02-01 20:51:58', '2026-02-05 01:35:00'),
(2, 'Cinta di Ujung Waktu', 'Sebuah kisah cinta yang melampaui batas waktu. Ketika Raina, seorang mahasiswi biasa, menemukan sebuah jam tangan antik misterius, hidupnya berubah selamanya.\r\n\r\nJam tangan itu membawanya ke masa lalu, di mana ia bertemu dengan Alexi, seorang pangeran dari kerajaan yang sudah lama hilang. Di antara dua zaman yang berbeda, dapatkah cinta mereka bertahan?', 'covers/wqg8fPfCYlJcC29oOsjiG4XQcDrFN1zEoG6fRm3C.jpg', 3, 1, 8, 'published', 0, 0, 4224, '2026-02-01 20:51:58', '2026-02-04 17:31:01'),
(3, 'Misteri Rumah Tua di Bukit', 'Desa Sukamaju selalu tenang dan damai. Sampai sebuah rumah tua di bukit mulai menunjukkan tanda-tanda kehidupan setelah ditinggalkan selama 50 tahun.\r\n\r\nTiga sahabat - Budi, Ani, dan Doni - memutuskan untuk mengungkap rahasia di balik rumah misterius itu. Tapi apa yang mereka temukan jauh lebih mengerikan dari yang mereka bayangkan.', 'covers/7BMZvCww0aATgQHdT8txciCYAMLACbEdKNiGjlYJ.jpg', 2, 6, 5, 'published', 0, 0, 887, '2026-02-01 20:51:58', '2026-02-03 17:41:00'),
(4, 'Petualangan Si Kucing Ajaib', 'Mochi adalah kucing biasa yang dipelihara oleh seorang anak bernama Lily. Tapi suatu hari, Mochi terbangun dengan kemampuan berbicara dan kekuatan ajaib!\r\n\r\nBersama Lily, mereka berkelana ke berbagai tempat, membantu siapa saja yang membutuhkan. Sebuah cerita petualangan yang hangat dan penuh kebaikan hati.', 'covers/mUHcZOczqw7SDtHekeSpx8MFPYg0xCOccXjfSFb1.jpg', 4, 4, 2, 'published', 0, 0, 5017, '2026-02-01 20:51:58', '2026-02-03 17:46:48'),
(5, 'Legenda Pedang Naga', 'Di era kerajaan kuno, sebuah pedang legendaris tersembunyi di puncak gunung tertinggi. Pedang ini konon bisa memberikan kekuatan luar biasa kepada pemiliknya.\r\n\r\nWei Long, seorang pemuda yatim piatu, memulai perjalanannya untuk menemukan pedang itu. Tapi jalan yang harus ia tempuh penuh dengan bahaya dan pengkhianatan.', 'covers/xjokL8BeO2GoioXpa821HVdMjviMP3aMhNDqcBja.jpg', 7, 3, 4, 'published', 0, 0, 4795, '2026-02-01 20:51:59', '2026-02-04 17:44:30'),
(6, 'Magic Emperor', 'magic emperor', 'covers/ZsS3uVFakiH66tX8BtzUxYu2Cr7mtvTlrQzcv8C5.jpg', 1, 4, 2, 'published', 1, 0, 26, '2026-02-02 18:19:26', '2026-02-12 06:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `novel_chapters`
--

CREATE TABLE `novel_chapters` (
  `id` bigint UNSIGNED NOT NULL,
  `novel_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapter_number` int UNSIGNED NOT NULL,
  `is_premium` tinyint(1) NOT NULL DEFAULT '0',
  `views` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `novel_chapters`
--

INSERT INTO `novel_chapters` (`id`, `novel_id`, `title`, `content`, `chapter_number`, `is_premium`, `views`, `created_at`) VALUES
(1, 1, 'Chapter 1: Awal Mula', 'Pagi itu, langit tampak lebih cerah dari biasanya. Ardan terbangun dengan perasaan aneh yang tidak bisa ia jelaskan.\n\nEntah mengapa, ia merasa hari ini akan menjadi hari yang berbeda. Sebuah perjalanan besar akan segera dimulai.\n\n\"Nak, sarapanmu sudah siap!\" teriak ibunya dari dapur.\n\nArdan beranjak dari tempat tidurnya yang sederhana. Rumah mereka memang tidak mewah, hanya sebuah gubuk kayu di pinggir hutan. Tapi bagi Ardan, ini adalah rumah yang penuh kehangatan.', 1, 0, 635, '2026-02-02 03:51:58'),
(2, 1, 'Chapter 2: Portal Misterius', 'Setelah sarapan, Ardan pergi ke hutan seperti biasa untuk mengumpulkan kayu bakar.\n\nNetapi hari ini berbeda. Di tengah hutan, ia menemukan sesuatu yang tidak pernah ia lihat sebelumnya: sebuah lingkaran cahaya yang berputar perlahan.\n\n\"Apa ini?\" gumamnya takjub.\n\nCahaya itu berdenyut seperti jantung yang berdetak. Warna-warni yang indah berkilauan, seakan memanggil Ardan untuk mendekat.\n\nTanpa ia sadari, kakinya telah melangkah masuk ke dalam lingkaran cahaya tersebut.', 2, 0, 608, '2026-02-02 03:51:58'),
(3, 1, 'Chapter 3: Dunia Baru', 'Ketika Ardan membuka matanya, ia sudah berada di tempat yang sama sekali berbeda.\n\nPepohonan raksasa menjulang tinggi hingga awan. Bunga-bunga yang belum pernah ia lihat bermekaran di mana-mana. Makhluk-makhluk aneh berterbangan di udara.\n\n\"Selamat datang di Aetheria,\" sebuah suara menyapanya.\n\nArdan menoleh dan melihat seorang gadis dengan sayap transparan berdiri di hadapannya. Senyumnya ramah, tapi matanya menyimpan kesedihan yang dalam.', 3, 0, 1265, '2026-02-02 03:51:58'),
(4, 2, 'Chapter 1: Penemuan Tak Terduga', 'Toko barang antik itu seharusnya sudah tutup. Tapi entah mengapa, Raina tertarik untuk masuk.\n\nDi antara tumpukan barang-barang tua berdebu, sebuah jam tangan emas menarik perhatiannya. Jam itu bersinar samar, seakan memanggilnya.\n\n\"Berapa harganya, Pak?\" tanyanya pada si pemilik toko.\n\nPria tua itu tersenyum misterius. \"Untuk kamu, gratis. Jam itu sudah menunggumu sejak lama.\"', 1, 0, 826, '2026-02-02 03:51:58'),
(5, 2, 'Chapter 2: Kilatan Cahaya', 'Malam itu, ketika Raina sedang belajar untuk ujian, jam tangan itu tiba-tiba bersinar terang.\n\nSebelum ia sempat bereaksi, seluruh ruangan berputar. Ketika cahaya mereda, ia tidak lagi berada di kamarnya.\n\nIstana megah berdiri di hadapannya. Pelayan-pelayan berpakaian kuno berlalu-lalang.\n\n\"Siapa kau?\" sebuah suara tegas membuatnya menoleh.\n\nSeorang pemuda tampan dengan mahkota emas menatapnya tajam.', 2, 0, 523, '2026-02-02 03:51:58'),
(6, 3, 'Chapter 1: Rumor yang Tersebar', '\"Kalian dengar tidak? Katanya ada suara-suara aneh dari rumah tua itu.\"\n\nBudi menelan ludahnya. Rumah tua di bukit memang selalu menjadi bahan pembicaraan penduduk desa.\n\n\"Ah, itu kan cuma cerita bohong,\" kata Doni, berusaha terlihat berani.\n\nAni menggeleng. \"Tapi nenek bilang, dulu ada kejadian mengerikan di sana. Satu keluarga menghilang tanpa jejak.\"', 1, 0, 1652, '2026-02-02 03:51:58'),
(7, 4, 'Chapter 1: Bangun yang Berbeda', 'Mochi selalu tidur di tempat yang sama: kaki tempat tidur Lily.\n\nTapi pagi ini, ia terbangun dengan perasaan aneh. Seolah-olah sesuatu dalam dirinya telah berubah.\n\n\"Meow...\" ia menguap. Wait, itu bukan meow. Itu... suara?\n\n\"Aku bisa bicara?!\" teriaknya.\n\nLily langsung terbangun dan jatuh dari tempat tidur.', 1, 0, 1814, '2026-02-02 03:51:58'),
(8, 5, 'Chapter 1: Pemuda dari Desa Miskin', 'Wei Long tidak memiliki apa-apa. Orang tuanya meninggal saat ia masih kecil, dan ia dibesarkan oleh tetangga yang baik hati.\n\nTapi ia memiliki satu hal yang tidak dimiliki orang lain: tekad yang membara.\n\n\"Suatu hari, aku akan menjadi yang terkuat,\" janjinya pada diri sendiri.\n\nDan hari itu, perjalanannya dimulai.', 1, 0, 1325, '2026-02-02 03:51:59'),
(9, 6, 'Chapter 1', 'Kebangkitan Kaisar Iblis\r\n\r\nLangit malam terbelah oleh kilat hitam. Di tengah altar kuno yang dipenuhi simbol iblis, seorang pria membuka matanya perlahan. Tatapan itu dingin, penuh kehinaan terhadap dunia.\r\n\r\nNamanya Zhao Mo.\r\n\r\nDi kehidupan sebelumnya, ia dikenal sebagai Kaisar Iblis Agung, penguasa tertinggi jalur sesat. Namun pengkhianatan dari murid kepercayaannya sendiri membuatnya jatuh di puncak kejayaan.\r\n\r\nKini, ia terbangun di tubuh seorang pemuda lemah dari klan kecil yang hampir runtuh.\r\n\r\nIngatan tubuh baru itu mengalir deras—dihina, dipukul, diremehkan. Zhao Mo tersenyum tipis.\r\n\r\n“Menarik… dunia ini masih sama kejamnya.”\r\n\r\nIa mengepalkan tangan. Qi di tubuhnya nyaris tidak ada. Namun pengalaman ribuan tahun tidak hilang.\r\n\r\n“Jika aku bisa naik sekali, aku bisa naik dua kali.”\r\n\r\nDi luar kamar reyot itu, terdengar suara ejekan dari anggota klan.\r\n\r\nZhao Mo berdiri, matanya berkilat tajam.\r\n\r\n“Kalian akan menjadi pijakan pertamaku.”', 1, 0, 5, '2026-02-04 06:39:30'),
(10, 6, 'Chapter 2', 'Klan Zhao adalah klan tingkat bawah, nyaris tidak diperhitungkan di Kota Qingyun. Zhao Mo—pemuda yang kini ia huni—adalah sampah klan, gagal berkultivasi hingga usia enam belas tahun.\r\n\r\nMalam itu, Zhao Mo duduk bersila.\r\n\r\nIa tidak menggunakan teknik lurus dunia ini. Ia memilih Metode Penyerapan Iblis, teknik terlarang yang dulu membuat seluruh dunia gemetar.\r\n\r\nUdara di sekitarnya bergetar. Qi tipis di lingkungan ditarik paksa masuk ke tubuhnya, bercampur dengan energi gelap yang hanya bisa dikendalikan oleh mereka yang pernah berjalan di jalur iblis.\r\n\r\nRasa sakit luar biasa menghantam tubuh rapuh itu.\r\n\r\nTulang retak. Otot robek.\r\n\r\nNamun Zhao Mo tertawa pelan.\r\n\r\n“Rasa sakit seperti ini… nostalgia.”\r\n\r\nSaat fajar tiba, ia membuka mata. Aura di sekitarnya berubah.\r\n\r\nTahap Pemurnian Qi – Tingkat 1.\r\n\r\nSederhana, namun bagi tubuh ini, itu adalah keajaiban.\r\n\r\nTak lama, pintu kamarnya didobrak.\r\n\r\nSeorang sepupunya menunjuk sambil mencibir.\r\n“Besok ujian klan. Sampah sepertimu lebih baik tidak datang!”\r\n\r\nZhao Mo menatapnya tanpa emosi.\r\n\r\n“Besok,” katanya pelan,\r\n“aku akan mengubah urutan klan ini.”', 2, 0, 2, '2026-02-04 06:39:30'),
(11, 6, 'Chapter 3', 'Sampah yang Mengguncang Klan\r\n\r\nLapangan ujian klan dipenuhi tawa mengejek. Para tetua duduk di atas panggung, wajah mereka penuh ketidakpedulian.\r\n\r\nKetika nama Zhao Mo dipanggil, ejekan semakin keras.\r\n\r\n“Dia bahkan belum mencapai Pemurnian Qi!”\r\n“Malu-maluin klan saja!”\r\n\r\nZhao Mo melangkah maju dengan tenang.\r\n\r\nLawan ujiannya adalah Zhao Feng, murid inti tahap Pemurnian Qi tingkat 3.\r\n\r\nPertarungan dimulai.\r\n\r\nDalam satu langkah, Zhao Mo menghilang dari pandangan.\r\n\r\nPukulan sederhana—tanpa teknik indah—menghantam perut Zhao Feng.\r\n\r\nBUM!\r\n\r\nTubuh Zhao Feng terpental dan menghantam tanah.\r\n\r\nLapangan sunyi.\r\n\r\nTetua-tetua berdiri dengan wajah terkejut.\r\n\r\n“Bagaimana mungkin?”\r\n“Teknik apa itu?!”\r\n\r\nZhao Mo berdiri tegak, aura gelapnya tertahan rapat.\r\n\r\nIa menatap seluruh klan.\r\n\r\n“Mulai hari ini,” ucapnya dingin,\r\n“aku bukan lagi sampah.”\r\n\r\nDi kejauhan, langit berawan.\r\n\r\nRoda takdir mulai berputar kembali.', 3, 0, 1, '2026-02-04 06:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `item_type`, `item_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 'novel', 4, 5, 'bagus', '2026-02-04 00:45:32'),
(2, 2, 'novel', 1, 5, 'novelnya bagus', '2026-02-05 00:33:06'),
(3, 8, 'novel', 6, 1, 'welek', '2026-02-12 06:09:44'),
(4, 1, 'novel', 6, 5, 'bagus sekali', '2026-02-12 06:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1LJCsSNI53mWlY77olTlngIMKM1Pnh6yR5L24X21', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWVVha25Ja1BaMkZlZ3k1dWI0TWVkV1JSMWtNNmxUeVh0cjZzQUF3diI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXBvcnRzP3BhZ2U9MSI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4ucmVwb3J0cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1770875305),
('frnSvHrr47ynP5Yh0JlOlZ6e3QVBV6r4ID1PJjCE', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWVE3RUVVZnJzSEhqaGRCY3ZvVjZTUWN4RUxiSUYzS25zV3ZSSVhKUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770878234),
('Jsw6LfEoAqATYBaK7LdroqlPsZTw71PWIWwXBLD1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZE90TnhReFJoNHp4YmN6RWphZzNjV05NbEVmZmR0b2xjM0NYeE44MiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770906821),
('k7e72z9ihUhxCBUTlXJzCMCM3aETCAs2mZrug68q', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidWxrcFRkZ256U2kwRnZpUHY0ak1uQW9GUXRnQUxWUFU3Wnp4YThnQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770876472),
('NkGyX0kbqBHRPz6LWeS5yHPIAY03SIwh0RqZyNMU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVhVcmd4OXhBZ01seWwzRUpCWDRvNnRNV3lma1JLZGR3WGk5cmlpSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1770878971),
('NkxbIAcFnGv9pUFhVF7m0AuGzew6QFeeQ5tilAyU', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUTNhZEZ3c3kxUFZhNjdtYVJjOEY3cTRJTWgxTm01eGpNWHZsbEFwRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770878222),
('pbEpwn9OfQVabL8ImTrLr7vHprfWvTtPJCe9i8Xr', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiOWxmVkxGdkhHdE9ucTFQbk5HMTU4b05uampiRUpSMFAzc2tCZFR6NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770876480),
('TTDcaO9C1UHtPTFJeOZxfkUJC7F7DAvsb2xjKydw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidktkSU90UWI5M00zNkhZbUc3bGdoNXBFV29UTFppWjQ4VHp5U2RFSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771981174);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `status`, `starts_at`, `expires_at`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 5, 'active', '2026-01-08 11:43:00', '2026-02-08 11:43:00', 'gopay', '2026-01-08 11:43:00', '2026-01-08 11:43:00'),
(2, 7, 'active', '2025-12-05 19:17:00', '2026-01-05 19:17:00', 'gopay', '2025-12-05 19:17:00', '2025-12-05 19:17:00'),
(3, 7, 'active', '2025-10-24 12:14:00', '2025-11-24 12:14:00', 'credit_card', '2025-10-24 12:14:00', '2025-10-24 12:14:00'),
(4, 7, 'active', '2025-12-24 02:53:00', '2026-01-24 02:53:00', 'shopeepay', '2025-12-24 02:53:00', '2025-12-24 02:53:00'),
(5, 6, 'active', '2025-12-12 15:17:00', '2026-01-12 15:17:00', 'shopeepay', '2025-12-12 15:17:00', '2025-12-12 15:17:00'),
(6, 3, 'active', '2025-11-03 19:43:00', '2025-12-03 19:43:00', 'credit_card', '2025-11-03 19:43:00', '2025-11-03 19:43:00'),
(7, 3, 'active', '2025-12-28 22:30:00', '2026-01-28 22:30:00', 'bca_va', '2025-12-28 22:30:00', '2025-12-28 22:30:00'),
(8, 2, 'active', '2025-12-15 10:29:00', '2026-01-15 10:29:00', 'bca_va', '2025-12-15 10:29:00', '2025-12-15 10:29:00'),
(9, 8, 'active', '2025-12-28 07:24:00', '2026-01-28 07:24:00', 'bca_va', '2025-12-28 07:24:00', '2025-12-28 07:24:00'),
(10, 6, 'active', '2025-10-18 02:27:00', '2025-11-18 02:27:00', 'shopeepay', '2025-10-18 02:27:00', '2025-10-18 02:27:00'),
(11, 6, 'active', '2025-10-27 21:41:00', '2025-11-27 21:41:00', 'credit_card', '2025-10-27 21:41:00', '2025-10-27 21:41:00'),
(12, 2, 'active', '2025-12-18 10:49:00', '2026-01-18 10:49:00', 'bca_va', '2025-12-18 10:49:00', '2025-12-18 10:49:00'),
(13, 4, 'active', '2025-11-03 04:23:00', '2025-12-03 04:23:00', 'shopeepay', '2025-11-03 04:23:00', '2025-11-03 04:23:00'),
(14, 2, 'active', '2025-11-13 01:39:00', '2025-12-13 01:39:00', 'shopeepay', '2025-11-13 01:39:00', '2025-11-13 01:39:00'),
(15, 2, 'active', '2025-11-22 03:17:00', '2025-12-22 03:17:00', 'gopay', '2025-11-22 03:17:00', '2025-11-22 03:17:00'),
(16, 8, 'active', '2025-10-21 19:31:00', '2025-11-21 19:31:00', 'gopay', '2025-10-21 19:31:00', '2025-10-21 19:31:00'),
(17, 2, 'active', '2025-12-16 12:28:00', '2026-01-16 12:28:00', 'credit_card', '2025-12-16 12:28:00', '2025-12-16 12:28:00'),
(18, 1, 'active', '2025-11-03 06:19:00', '2025-12-03 06:19:00', 'bca_va', '2025-11-03 06:19:00', '2025-11-03 06:19:00'),
(19, 5, 'active', '2025-10-28 07:29:00', '2025-11-28 07:29:00', 'gopay', '2025-10-28 07:29:00', '2025-10-28 07:29:00'),
(20, 3, 'active', '2025-12-19 23:59:00', '2026-01-19 23:59:00', 'shopeepay', '2025-12-19 23:59:00', '2025-12-19 23:59:00'),
(21, 6, 'active', '2025-12-24 06:13:00', '2026-01-24 06:13:00', 'gopay', '2025-12-24 06:13:00', '2025-12-24 06:13:00'),
(22, 6, 'active', '2025-10-20 06:56:00', '2025-11-20 06:56:00', 'gopay', '2025-10-20 06:56:00', '2025-10-20 06:56:00'),
(23, 5, 'active', '2025-11-07 02:22:00', '2025-12-07 02:22:00', 'gopay', '2025-11-07 02:22:00', '2025-11-07 02:22:00'),
(24, 3, 'active', '2025-10-20 10:11:00', '2025-11-20 10:11:00', 'bca_va', '2025-10-20 10:11:00', '2025-10-20 10:11:00'),
(25, 6, 'active', '2025-11-16 15:29:00', '2025-12-16 15:29:00', 'credit_card', '2025-11-16 15:29:00', '2025-11-16 15:29:00'),
(26, 7, 'active', '2025-12-19 06:14:00', '2026-01-19 06:14:00', 'gopay', '2025-12-19 06:14:00', '2025-12-19 06:14:00'),
(27, 3, 'active', '2026-01-06 02:11:00', '2026-02-06 02:11:00', 'credit_card', '2026-01-06 02:11:00', '2026-01-06 02:11:00'),
(28, 5, 'active', '2025-12-09 12:57:00', '2026-01-09 12:57:00', 'shopeepay', '2025-12-09 12:57:00', '2025-12-09 12:57:00'),
(29, 1, 'active', '2025-11-16 07:20:00', '2025-12-16 07:20:00', 'bca_va', '2025-11-16 07:20:00', '2025-11-16 07:20:00'),
(30, 2, 'active', '2025-11-26 08:34:00', '2025-12-26 08:34:00', 'credit_card', '2025-11-26 08:34:00', '2025-11-26 08:34:00'),
(31, 2, 'active', '2025-11-17 16:18:00', '2025-12-17 16:18:00', 'gopay', '2025-11-17 16:18:00', '2025-11-17 16:18:00'),
(32, 9, 'active', '2026-02-12 06:37:14', '2026-03-12 06:37:14', 'midtrans', '2026-02-12 06:37:14', '2026-02-12 06:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gross_amount` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `order_id`, `gross_amount`, `status`, `payment_type`, `transaction_time`, `created_at`, `updated_at`) VALUES
(1, 5, 'SUB-cc64cacc-8dc0-4f76-81e7-3a5932acf45f', '30000.00', 'success', 'gopay', '2026-01-08 11:43:00', '2026-01-08 11:43:00', '2026-01-08 11:43:00'),
(2, 1, 'SUB-7483a046-c872-492c-8c40-fed392f69417', '30000.00', 'failed', 'gopay', NULL, '2025-12-08 01:18:00', '2025-12-08 01:18:00'),
(3, 4, 'SUB-e0d2b015-8a95-4b7b-b10d-b3a547c4949a', '30000.00', 'failed', 'gopay', NULL, '2025-12-01 17:26:00', '2025-12-01 17:26:00'),
(4, 7, 'SUB-e28afe80-f53d-4ad4-9073-dcbd680b87ec', '30000.00', 'success', 'gopay', '2025-12-05 19:17:00', '2025-12-05 19:17:00', '2025-12-05 19:17:00'),
(5, 2, 'SUB-cb9a7435-d657-4ea6-8870-3458ab21672a', '30000.00', 'pending', 'credit_card', NULL, '2025-11-04 17:22:00', '2025-11-04 17:22:00'),
(6, 7, 'SUB-c0a72c5f-abb0-465e-bfd8-3015e95a5f66', '30000.00', 'success', 'credit_card', '2025-10-24 12:14:00', '2025-10-24 12:14:00', '2025-10-24 12:14:00'),
(7, 3, 'SUB-a75c0ab4-adcd-499d-b622-17cdf229dfc5', '30000.00', 'expire', 'shopeepay', NULL, '2025-11-16 00:30:00', '2025-11-16 00:30:00'),
(8, 7, 'SUB-08972f3d-ac9f-40bf-ba46-ee31b663a24b', '30000.00', 'success', 'shopeepay', '2025-12-24 02:53:00', '2025-12-24 02:53:00', '2025-12-24 02:53:00'),
(9, 4, 'SUB-bf849d05-1bb3-494e-9c39-aa58eb707a85', '30000.00', 'failed', 'shopeepay', NULL, '2026-01-07 22:58:00', '2026-01-07 22:58:00'),
(10, 6, 'SUB-c5dda0f0-4177-4fbe-a6f6-19d30b18adf2', '30000.00', 'pending', 'bca_va', NULL, '2025-11-09 06:22:00', '2025-11-09 06:22:00'),
(11, 6, 'SUB-954d4117-4c51-4f02-a543-c053df823a6c', '30000.00', 'success', 'shopeepay', '2025-12-12 15:17:00', '2025-12-12 15:17:00', '2025-12-12 15:17:00'),
(12, 5, 'SUB-7904f55b-06e3-4163-ad95-dca9ef013c20', '30000.00', 'pending', 'shopeepay', NULL, '2025-12-19 23:31:00', '2025-12-19 23:31:00'),
(13, 8, 'SUB-1a66b206-36a1-4f00-8d2b-af1ce8794f7e', '30000.00', 'expire', 'bca_va', NULL, '2025-12-08 04:12:00', '2025-12-08 04:12:00'),
(14, 3, 'SUB-9da84665-be24-435f-8c92-4ccb0e3a6878', '30000.00', 'success', 'credit_card', '2025-11-03 19:43:00', '2025-11-03 19:43:00', '2025-11-03 19:43:00'),
(15, 3, 'SUB-e1586e47-6531-4ec5-92c4-c7a883784a4d', '30000.00', 'success', 'bca_va', '2025-12-28 22:30:00', '2025-12-28 22:30:00', '2025-12-28 22:30:00'),
(16, 7, 'SUB-b7f036f2-63a9-40a5-b3b0-865dfdb53486', '30000.00', 'failed', 'gopay', NULL, '2025-11-08 16:09:00', '2025-11-08 16:09:00'),
(17, 4, 'SUB-351e5258-d00f-429f-84ff-bcf2013694cb', '30000.00', 'failed', 'bca_va', NULL, '2025-11-06 18:56:00', '2025-11-06 18:56:00'),
(18, 1, 'SUB-51e03c24-0fad-4c08-ad3f-c811e9f70884', '30000.00', 'failed', 'bca_va', NULL, '2025-12-10 18:38:00', '2025-12-10 18:38:00'),
(19, 4, 'SUB-bd76256f-6e0b-4b46-bb4e-68a5f300daca', '30000.00', 'pending', 'credit_card', NULL, '2025-12-01 00:22:00', '2025-12-01 00:22:00'),
(20, 6, 'SUB-df558e04-a403-4d7c-98f0-91c7b959afaf', '30000.00', 'pending', 'gopay', NULL, '2025-11-04 11:09:00', '2025-11-04 11:09:00'),
(21, 2, 'SUB-e07a189f-fc7d-4296-8f9a-469514cfe02a', '30000.00', 'success', 'bca_va', '2025-12-15 10:29:00', '2025-12-15 10:29:00', '2025-12-15 10:29:00'),
(22, 4, 'SUB-92d6122d-b059-4877-833f-97e4b2c662cb', '30000.00', 'failed', 'bca_va', NULL, '2026-01-04 18:25:00', '2026-01-04 18:25:00'),
(23, 7, 'SUB-b2ff32b2-bf3f-4496-baeb-cdaaaadd9f17', '30000.00', 'expire', 'shopeepay', NULL, '2026-01-05 18:08:00', '2026-01-05 18:08:00'),
(24, 1, 'SUB-d2ec7260-6fc1-485a-90ec-9a69761cfa62', '30000.00', 'expire', 'bca_va', NULL, '2025-12-02 12:23:00', '2025-12-02 12:23:00'),
(25, 8, 'SUB-7033a736-0ff4-437a-a264-076ab7f68ff6', '30000.00', 'success', 'bca_va', '2025-12-28 07:24:00', '2025-12-28 07:24:00', '2025-12-28 07:24:00'),
(26, 6, 'SUB-2a7ff4c3-093f-4e97-abe0-b2da5cc2aa0e', '30000.00', 'success', 'shopeepay', '2025-10-18 02:27:00', '2025-10-18 02:27:00', '2025-10-18 02:27:00'),
(27, 6, 'SUB-a6b01dfc-e538-45d0-83ba-19c13a61e618', '30000.00', 'success', 'credit_card', '2025-10-27 21:41:00', '2025-10-27 21:41:00', '2025-10-27 21:41:00'),
(28, 4, 'SUB-5a939b3a-706d-40f9-84fe-32485a59b089', '30000.00', 'failed', 'shopeepay', NULL, '2025-10-25 11:15:00', '2025-10-25 11:15:00'),
(29, 5, 'SUB-70098b26-efae-4986-bb22-045b311f6ce3', '30000.00', 'pending', 'bca_va', NULL, '2025-12-24 13:46:00', '2025-12-24 13:46:00'),
(30, 3, 'SUB-28c88cf7-9d13-4db7-87fe-84a08478de1b', '30000.00', 'expire', 'shopeepay', NULL, '2026-01-05 03:25:00', '2026-01-05 03:25:00'),
(31, 5, 'SUB-48e7f671-205f-45ae-a3f9-3f9b2b737525', '30000.00', 'expire', 'credit_card', NULL, '2025-11-17 10:28:00', '2025-11-17 10:28:00'),
(32, 2, 'SUB-b840c288-17fd-4079-a7ce-4b953159a0d5', '30000.00', 'pending', 'shopeepay', NULL, '2025-12-06 02:24:00', '2025-12-06 02:24:00'),
(33, 2, 'SUB-267d2765-3564-46d9-aa1b-adcab1d1c601', '30000.00', 'success', 'bca_va', '2025-12-18 10:49:00', '2025-12-18 10:49:00', '2025-12-18 10:49:00'),
(34, 5, 'SUB-c8ab68a5-f414-4f5c-80cb-5a783c730018', '30000.00', 'expire', 'credit_card', NULL, '2025-10-25 10:51:00', '2025-10-25 10:51:00'),
(35, 5, 'SUB-93ccdda1-8403-452f-8f01-49f409571986', '30000.00', 'failed', 'gopay', NULL, '2025-11-03 03:13:00', '2025-11-03 03:13:00'),
(36, 4, 'SUB-69d3060c-2425-4f37-b6cc-27cadc21ec8b', '30000.00', 'success', 'shopeepay', '2025-11-03 04:23:00', '2025-11-03 04:23:00', '2025-11-03 04:23:00'),
(37, 7, 'SUB-7996863e-ad97-4a8e-8f1e-b5e0e30cfbca', '30000.00', 'expire', 'shopeepay', NULL, '2025-11-02 02:12:00', '2025-11-02 02:12:00'),
(38, 3, 'SUB-e0da852e-61c4-44c2-b4cb-17148ed72530', '30000.00', 'expire', 'bca_va', NULL, '2025-10-24 15:37:00', '2025-10-24 15:37:00'),
(39, 2, 'SUB-64727a17-eb84-433f-a8b7-26ff34921bdf', '30000.00', 'success', 'shopeepay', '2025-11-13 01:39:00', '2025-11-13 01:39:00', '2025-11-13 01:39:00'),
(40, 8, 'SUB-3f84ebe8-019b-4091-a221-d43e930ba12a', '30000.00', 'failed', 'bca_va', NULL, '2025-11-30 00:17:00', '2025-11-30 00:17:00'),
(41, 1, 'SUB-4313ecc9-4d0a-4a57-8f0d-662e21541fb9', '30000.00', 'pending', 'shopeepay', NULL, '2025-11-19 20:04:00', '2025-11-19 20:04:00'),
(42, 7, 'SUB-5f376ecf-ec14-45ad-87ad-9d17f062992c', '30000.00', 'expire', 'bca_va', NULL, '2025-12-03 10:37:00', '2025-12-03 10:37:00'),
(43, 4, 'SUB-28516710-327b-4b55-a42e-8f06bcbb7194', '30000.00', 'pending', 'shopeepay', NULL, '2025-11-15 21:05:00', '2025-11-15 21:05:00'),
(44, 2, 'SUB-676e72bb-2708-459f-8f8c-3ded24b6c3e9', '30000.00', 'success', 'gopay', '2025-11-22 03:17:00', '2025-11-22 03:17:00', '2025-11-22 03:17:00'),
(45, 8, 'SUB-ca36b48f-97ab-4cd6-8cd2-c94ab41b1658', '30000.00', 'success', 'gopay', '2025-10-21 19:31:00', '2025-10-21 19:31:00', '2025-10-21 19:31:00'),
(46, 1, 'SUB-8f4fb385-df14-4f04-8582-94de397b6db7', '30000.00', 'pending', 'credit_card', NULL, '2025-11-28 09:05:00', '2025-11-28 09:05:00'),
(47, 6, 'SUB-d9ef299b-9f76-47d0-96aa-bd8465b5d4ad', '30000.00', 'expire', 'credit_card', NULL, '2025-10-28 02:19:00', '2025-10-28 02:19:00'),
(48, 1, 'SUB-cda3401a-6f1b-48d3-854a-a52dfcaccea2', '30000.00', 'expire', 'shopeepay', NULL, '2025-11-25 14:12:00', '2025-11-25 14:12:00'),
(49, 2, 'SUB-5a4e6bd6-5a2f-4496-b15f-6a1bea2ba39c', '30000.00', 'failed', 'gopay', NULL, '2025-10-27 01:14:00', '2025-10-27 01:14:00'),
(50, 6, 'SUB-ffff66d3-683c-417f-b685-e5b135cc91e7', '30000.00', 'failed', 'gopay', NULL, '2025-12-09 10:47:00', '2025-12-09 10:47:00'),
(51, 2, 'SUB-797455c9-0fb8-42bb-bda3-1bfc0e8728d3', '30000.00', 'pending', 'gopay', NULL, '2025-12-21 22:05:00', '2025-12-21 22:05:00'),
(52, 7, 'SUB-54a81b07-b02c-4df9-aa81-031d4a50d610', '30000.00', 'pending', 'bca_va', NULL, '2025-10-24 18:06:00', '2025-10-24 18:06:00'),
(53, 7, 'SUB-d44c3061-714c-4125-a072-290c6ab8c3b5', '30000.00', 'expire', 'shopeepay', NULL, '2025-12-17 06:06:00', '2025-12-17 06:06:00'),
(54, 7, 'SUB-c83fb9ef-318c-4b11-a1d3-1e9e5abac75f', '30000.00', 'pending', 'credit_card', NULL, '2025-12-02 14:27:00', '2025-12-02 14:27:00'),
(55, 5, 'SUB-6c457496-7802-4a39-9e99-4e76957de9c5', '30000.00', 'failed', 'shopeepay', NULL, '2025-10-20 02:53:00', '2025-10-20 02:53:00'),
(56, 1, 'SUB-5e2c35d8-93db-4a8b-a63d-c18733f11299', '30000.00', 'expire', 'shopeepay', NULL, '2025-11-23 20:14:00', '2025-11-23 20:14:00'),
(57, 6, 'SUB-9368fa17-de7f-49b1-a3d1-0431701034c2', '30000.00', 'expire', 'credit_card', NULL, '2025-11-19 17:11:00', '2025-11-19 17:11:00'),
(58, 6, 'SUB-65f0558f-f75b-42a5-bf8a-7b6dc94375f7', '30000.00', 'pending', 'shopeepay', NULL, '2025-11-03 04:19:00', '2025-11-03 04:19:00'),
(59, 1, 'SUB-72b247a2-8604-4fc7-b193-df7a5d8be7e0', '30000.00', 'pending', 'bca_va', NULL, '2025-12-11 20:25:00', '2025-12-11 20:25:00'),
(60, 1, 'SUB-e228512f-078f-4585-9d14-620ece5234f6', '30000.00', 'failed', 'gopay', NULL, '2025-12-15 19:36:00', '2025-12-15 19:36:00'),
(61, 2, 'SUB-72f2ef44-bb07-4d5e-bf21-957e463480eb', '30000.00', 'success', 'credit_card', '2025-12-16 12:28:00', '2025-12-16 12:28:00', '2025-12-16 12:28:00'),
(62, 8, 'SUB-2e331f6a-31e3-457b-90ef-de5096d314a7', '30000.00', 'failed', 'credit_card', NULL, '2025-12-30 00:40:00', '2025-12-30 00:40:00'),
(63, 7, 'SUB-78eb7ebf-4aae-4836-af34-b7ff7aaf573d', '30000.00', 'pending', 'bca_va', NULL, '2025-10-29 16:35:00', '2025-10-29 16:35:00'),
(64, 1, 'SUB-83294e0b-2a8c-4360-8c6d-96073eec9be4', '30000.00', 'failed', 'bca_va', NULL, '2025-12-03 23:38:00', '2025-12-03 23:38:00'),
(65, 1, 'SUB-e30ff35b-1e57-4530-a0f6-fb712bf387c6', '30000.00', 'success', 'bca_va', '2025-11-03 06:19:00', '2025-11-03 06:19:00', '2025-11-03 06:19:00'),
(66, 5, 'SUB-901640ce-8488-451e-acdc-945752d5772e', '30000.00', 'success', 'gopay', '2025-10-28 07:29:00', '2025-10-28 07:29:00', '2025-10-28 07:29:00'),
(67, 3, 'SUB-9dcee827-29cd-49a2-9ad8-d3d1e397ddac', '30000.00', 'expire', 'credit_card', NULL, '2026-01-05 22:17:00', '2026-01-05 22:17:00'),
(68, 7, 'SUB-969ce6e3-d526-47e2-8518-19f3db109c5e', '30000.00', 'expire', 'credit_card', NULL, '2025-10-24 01:39:00', '2025-10-24 01:39:00'),
(69, 3, 'SUB-8cd2d310-38ac-458f-bf65-60047c7f1f1c', '30000.00', 'pending', 'shopeepay', NULL, '2025-12-31 10:39:00', '2025-12-31 10:39:00'),
(70, 3, 'SUB-bd7df23f-a07e-452f-a85e-41f24ace2f58', '30000.00', 'success', 'shopeepay', '2025-12-19 23:59:00', '2025-12-19 23:59:00', '2025-12-19 23:59:00'),
(71, 2, 'SUB-18a379f3-9605-4ecb-ba6d-440489b0fc3a', '30000.00', 'pending', 'credit_card', NULL, '2025-10-29 15:26:00', '2025-10-29 15:26:00'),
(72, 5, 'SUB-4c7c90a4-f4ed-4c7b-940c-2900d00fcb30', '30000.00', 'expire', 'bca_va', NULL, '2025-10-21 09:00:00', '2025-10-21 09:00:00'),
(73, 6, 'SUB-f4a9c0ab-510d-4b36-841b-61fff4b91768', '30000.00', 'success', 'gopay', '2025-12-24 06:13:00', '2025-12-24 06:13:00', '2025-12-24 06:13:00'),
(74, 6, 'SUB-fcd701e3-d551-4a67-ade5-bfe6fc2df428', '30000.00', 'success', 'gopay', '2025-10-20 06:56:00', '2025-10-20 06:56:00', '2025-10-20 06:56:00'),
(75, 5, 'SUB-b8be6f08-5f9f-4a2e-9869-fbb7cb37f170', '30000.00', 'success', 'gopay', '2025-11-07 02:22:00', '2025-11-07 02:22:00', '2025-11-07 02:22:00'),
(76, 5, 'SUB-afc7e43b-186f-47d2-810a-a2a3e2d976fd', '30000.00', 'pending', 'gopay', NULL, '2025-12-11 23:01:00', '2025-12-11 23:01:00'),
(77, 7, 'SUB-93a9cefd-f746-4a21-bde5-43f909b008e1', '30000.00', 'expire', 'shopeepay', NULL, '2025-12-16 04:12:00', '2025-12-16 04:12:00'),
(78, 8, 'SUB-fb6e2192-f292-477c-9627-af88452bf099', '30000.00', 'pending', 'gopay', NULL, '2025-11-01 16:48:00', '2025-11-01 16:48:00'),
(79, 3, 'SUB-01b24f6a-9b25-4e45-a79b-a81390d0ed9c', '30000.00', 'success', 'bca_va', '2025-10-20 10:11:00', '2025-10-20 10:11:00', '2025-10-20 10:11:00'),
(80, 6, 'SUB-05c227da-c578-484a-81ca-0e803e8d8b64', '30000.00', 'success', 'credit_card', '2025-11-16 15:29:00', '2025-11-16 15:29:00', '2025-11-16 15:29:00'),
(81, 2, 'SUB-1293dbbc-0bc1-4509-b833-e2421ce573cf', '30000.00', 'expire', 'bca_va', NULL, '2025-10-21 07:56:00', '2025-10-21 07:56:00'),
(82, 7, 'SUB-fb2b8d4f-7706-4b98-b49f-607786dfee83', '30000.00', 'success', 'gopay', '2025-12-19 06:14:00', '2025-12-19 06:14:00', '2025-12-19 06:14:00'),
(83, 4, 'SUB-3606e30b-a34f-4e5d-a4d0-cec18fea94ea', '30000.00', 'failed', 'gopay', NULL, '2025-11-30 15:21:00', '2025-11-30 15:21:00'),
(84, 8, 'SUB-1a1aea50-c264-4bbf-a53b-7d04338e560e', '30000.00', 'failed', 'credit_card', NULL, '2025-12-08 21:58:00', '2025-12-08 21:58:00'),
(85, 3, 'SUB-8a266820-faf3-4bbd-90ee-94bf3faaaaf3', '30000.00', 'success', 'credit_card', '2026-01-06 02:11:00', '2026-01-06 02:11:00', '2026-01-06 02:11:00'),
(86, 2, 'SUB-83ee0133-7d76-4738-8a3a-cd75e9af602a', '30000.00', 'pending', 'credit_card', NULL, '2026-01-08 03:20:00', '2026-01-08 03:20:00'),
(87, 6, 'SUB-50d8ebe7-608f-4edc-afd7-974924bc5c25', '30000.00', 'expire', 'bca_va', NULL, '2025-12-10 02:44:00', '2025-12-10 02:44:00'),
(88, 1, 'SUB-b4f1b2b0-8ae7-429a-8866-8bbf9b10ec0e', '30000.00', 'pending', 'gopay', NULL, '2025-12-27 12:28:00', '2025-12-27 12:28:00'),
(89, 3, 'SUB-5354a87d-9f92-41c8-8561-25fa5afef167', '30000.00', 'pending', 'bca_va', NULL, '2025-12-13 13:07:00', '2025-12-13 13:07:00'),
(90, 5, 'SUB-123bc936-b4a2-4964-9f38-9634d5bc2df7', '30000.00', 'success', 'shopeepay', '2025-12-09 12:57:00', '2025-12-09 12:57:00', '2025-12-09 12:57:00'),
(91, 8, 'SUB-dc8f9dde-e538-48f7-9c74-13850c530dec', '30000.00', 'failed', 'shopeepay', NULL, '2026-01-01 22:17:00', '2026-01-01 22:17:00'),
(92, 7, 'SUB-314c3b3b-31af-441a-8688-6842c2a7b971', '30000.00', 'failed', 'credit_card', NULL, '2025-12-28 03:27:00', '2025-12-28 03:27:00'),
(93, 3, 'SUB-05923743-073f-4456-b942-a4d47e8a95b0', '30000.00', 'failed', 'bca_va', NULL, '2025-10-19 04:31:00', '2025-10-19 04:31:00'),
(94, 1, 'SUB-2ff39947-b3f0-4cee-b6d4-7c74a072d701', '30000.00', 'success', 'bca_va', '2025-11-16 07:20:00', '2025-11-16 07:20:00', '2025-11-16 07:20:00'),
(95, 5, 'SUB-64f949bc-b7d6-46ad-8e31-64bbe578e737', '30000.00', 'pending', 'shopeepay', NULL, '2025-12-20 08:11:00', '2025-12-20 08:11:00'),
(96, 6, 'SUB-aa8341a1-4aa8-4b93-b2d5-1d166ceb8d1e', '30000.00', 'failed', 'credit_card', NULL, '2025-12-14 00:32:00', '2025-12-14 00:32:00'),
(97, 2, 'SUB-6adb5693-a33a-4fe1-9c12-400333fcfa27', '30000.00', 'expire', 'gopay', NULL, '2025-11-12 16:31:00', '2025-11-12 16:31:00'),
(98, 8, 'SUB-01ff0591-33d6-4fdb-bdfc-c2d011d40c14', '30000.00', 'failed', 'gopay', NULL, '2025-12-19 17:31:00', '2025-12-19 17:31:00'),
(99, 2, 'SUB-75d5fddc-ade4-498e-b363-7bce7dde4571', '30000.00', 'success', 'credit_card', '2025-11-26 08:34:00', '2025-11-26 08:34:00', '2025-11-26 08:34:00'),
(100, 2, 'SUB-7cb3d83d-87ef-43d0-849e-d201d5f06dc0', '30000.00', 'success', 'gopay', '2025-11-17 16:18:00', '2025-11-17 16:18:00', '2025-11-17 16:18:00'),
(101, 9, 'SUB-547111cc-2baf-4b14-a05c-09dc670ee67c', '30000.00', 'success', 'midtrans', '2026-02-12 06:37:14', '2026-02-12 06:36:52', '2026-02-12 06:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@novelku.com', '2026-02-01 20:51:55', '$2y$12$RNclwdBI9qidYwoAVfHIV.DC.VVUaomBhMq3bOre3dST.p93JI7su', 'admin', NULL, NULL, '2026-02-01 20:51:55', '2026-02-01 20:51:55'),
(2, 'Test User', 'user@novelku.com', '2026-02-01 20:51:56', '$2y$12$eQ.23mT9kRDSSS.7F.FkkOxrM7auJhOWg4DzlMO9RyYL5GDhP11/y', 'user', NULL, NULL, '2026-02-01 20:51:56', '2026-02-01 20:51:56'),
(3, 'John Doe', 'john@example.com', '2026-02-01 20:51:57', '$2y$12$WAS/C/RYKZKMPdppUArj2ONd8025Cywdips68aeqHH2hJZJO3v4WC', 'user', NULL, NULL, '2026-02-01 20:51:57', '2026-02-01 20:51:57'),
(4, 'Jane Smith', 'jane@example.com', '2026-02-01 20:51:58', '$2y$12$hGfuXu7ZruhgtOORGeNQYe88dV9egFXPd18IincXDHvouxWsQc3MK', 'user', NULL, NULL, '2026-02-01 20:51:58', '2026-02-01 20:51:58'),
(5, 'nizam abidin', 'niedjama09@gmail.com', NULL, '$2y$12$XV634cv./7ti5kCcpnPZyeS8ozdpWEb.S3HXpLBR4XsbkGgGE0DyO', 'user', NULL, NULL, '2026-02-06 05:23:15', '2026-02-06 05:23:15'),
(6, 'Nizam Abidin', 'tuanmuda@gmail.com', NULL, '$2y$12$CciZLXr57aFFXmLxOA4viOsXHEsKz/C9IGVYvza0gOXemhpqlhWGC', 'user', NULL, NULL, '2026-02-10 10:52:58', '2026-02-10 10:52:58'),
(7, 'Tuan Muda', 'tuanmuda1@gmail.com', NULL, '$2y$12$Evx4geslly0sL/iB80DsteZwixRmA/xYn4quQ02HgY9W8lWLyf6lO', 'user', NULL, NULL, '2026-02-10 10:55:36', '2026-02-10 10:55:36'),
(8, 'nizam', 'nizamzam@gmail.com', NULL, '$2y$12$eTni0mTpztbEDaz32j8MiubtVvjIQovXiRIfdUDIxZh/JMs7jnC.q', 'user', NULL, NULL, '2026-02-12 05:52:04', '2026-02-12 05:52:04'),
(9, 'nizammm', 'zamzamzam@gmail.com', NULL, '$2y$12$9UKoutSHWsubairNDuMNfOZ1PviZmM0Njf/r4zzLm6seL0rCpnWT2', 'user', NULL, NULL, '2026-02-12 06:34:50', '2026-02-12 06:34:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_author_id_foreign` (`author_id`),
  ADD KEY `books_genre_id_foreign` (`genre_id`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- Indexes for table `book_chapters`
--
ALTER TABLE `book_chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_chapters_book_id_foreign` (`book_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_user_id_foreign` (`user_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_messages_chat_id_foreign` (`chat_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_items`
--
ALTER TABLE `library_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `library_unique` (`user_id`,`item_type`,`item_id`,`status`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `novels`
--
ALTER TABLE `novels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `novels_author_id_foreign` (`author_id`),
  ADD KEY `novels_genre_id_foreign` (`genre_id`),
  ADD KEY `novels_category_id_foreign` (`category_id`);

--
-- Indexes for table `novel_chapters`
--
ALTER TABLE `novel_chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `novel_chapters_novel_id_foreign` (`novel_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `review_unique` (`user_id`,`item_type`,`item_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_foreign` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_order_id_unique` (`order_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_chapters`
--
ALTER TABLE `book_chapters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library_items`
--
ALTER TABLE `library_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `novels`
--
ALTER TABLE `novels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `novel_chapters`
--
ALTER TABLE `novel_chapters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_chapters`
--
ALTER TABLE `book_chapters`
  ADD CONSTRAINT `book_chapters_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_chat_id_foreign` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `library_items`
--
ALTER TABLE `library_items`
  ADD CONSTRAINT `library_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `novels`
--
ALTER TABLE `novels`
  ADD CONSTRAINT `novels_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `novels_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `novels_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `novel_chapters`
--
ALTER TABLE `novel_chapters`
  ADD CONSTRAINT `novel_chapters_novel_id_foreign` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
