-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2024 at 01:55 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apptour`
--

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
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `user_id`, `name`, `location`, `image`, `star`, `created_at`, `updated_at`) VALUES
(1, 1, 'hotel kayla', 'Jalan Wahid Hasyim No. 61, Ngampilan, Kota Yogyakarta, Daerah Istimewa Yogyakarta,', 'hotel_1721746278.jpeg', 2, '2024-07-23 01:20:34', '2024-07-23 07:51:18'),
(2, 1, 'hotel  patra', 'Jl. Cendrawasih No. 36, Demangan Baru, Caturtunggal, Depok, Sleman, Daerah Istimewa Yogyakarta 55281', 'hotel_1721746255.jpeg', 3, '2024-07-23 01:29:20', '2024-07-23 07:50:55'),
(3, 1, 'hotel nabila', 'Jl. Raden Ronggo No. 14, Wirobrajan, Kota Yogyakarta', 'hotel_1721746145.jpeg', 2, '2024-07-23 01:30:36', '2024-07-23 07:49:05'),
(4, 1, 'hotel olympic', 'Karangkajen', 'hotel_1721747927.jpeg', 3, '2024-07-23 08:18:47', '2024-07-23 08:18:47'),
(5, 1, 'otel alana', 'jogja', 'hotel_1721827064.jpg', 3, '2024-07-24 02:19:38', '2024-07-24 06:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_rooms`
--

CREATE TABLE `hotel_rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `hotel_id` bigint UNSIGNED NOT NULL,
  `room_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `facility` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_start` decimal(15,2) NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `price_final` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_rooms`
--

INSERT INTO `hotel_rooms` (`id`, `hotel_id`, `room_type`, `status`, `facility`, `price_start`, `discount`, `price_final`, `created_at`, `updated_at`) VALUES
(1, 1, 'mawar', 'active', 'ruang autdhorr', '100.00', 0, '100.00', '2024-07-23 01:21:14', '2024-07-23 01:35:17'),
(2, 3, 'Family Room', 'active', 'Tempat tidur tambahan, area bermain untuk anak-anak', '20.00', 0, '20.00', '2024-07-23 01:32:26', '2024-07-23 01:32:26'),
(3, 2, 'Executive Room', 'active', 'Akses internet cepat', '150.00', 0, '150.00', '2024-07-23 01:33:27', '2024-07-23 01:33:27'),
(4, 1, 'Standard Room', 'active', 'Minimal, sesuai dengan kebutuhan dasar tamu.', '50.00', 0, '50.00', '2024-07-23 01:34:39', '2024-07-23 01:34:39'),
(5, 1, 'Junior Suite', 'active', 'asilitas tambahan seperti area duduk terpisah dan dekorasi yang lebih baik.', '200.00', 0, '200.00', '2024-07-23 01:36:01', '2024-07-23 01:36:01'),
(6, 4, 'Standard Room', 'active', 'seperti tempat tidur, AC, TV, perlengkapan mandi, dan air minum', '100000.00', 0, '100000.00', '2024-07-24 01:17:32', '2024-07-24 01:17:32'),
(7, 4, 'Superior Room', 'active', 'kulkas mini bagi penghuni Deluxe Room.', '200.00', 0, '200.00', '2024-07-24 01:18:39', '2024-07-24 01:18:39'),
(8, 3, 'Twin Room', 'active', 'kulkas mini bagi penghuni Deluxe Room.', '200.00', 0, '200.00', '2024-07-24 01:19:54', '2024-07-24 01:19:54'),
(9, 2, 'Single Room', 'active', 'tempat tidur dan beberapa jenis perlengkapan yang mampu menambah fungsionalitas ruangan seperti meja dan kursi untuk berhias.', '100000.00', 0, '100000.00', '2024-07-24 01:20:48', '2024-07-24 01:20:48'),
(10, 3, 'Twin Room', 'active', 'Kamar ini mirip dengan single room, hanya saja jumlah tempat tidur yang digunakan terdiri dari 2 single bed. Fasilitasnya hampir mirip dengan standard room.', '300000.00', 0, '300000.00', '2024-07-24 01:54:14', '2024-07-24 01:54:14'),
(11, 3, 'Kamar Keluarga', 'active', 'tempat tidur king atau queen ditambah tempat tidur tambahan untuk anak-anak', '250000.00', 0, '250000.00', '2024-07-24 01:55:54', '2024-07-24 01:55:54'),
(12, 4, 'Suite Eksekutif', 'active', 'TV layar datar dengan saluran kabel', '100.00', 0, '100.00', '2024-07-24 01:56:48', '2024-07-24 01:56:48'),
(13, 4, 'mawar', 'active', 'ruang autdorr', '100.00', 0, '100.00', '2024-07-24 02:16:55', '2024-07-24 02:16:55'),
(14, 5, 'melati', 'active', 'televisi', '1000.00', -4, '1040.00', '2024-07-24 02:20:25', '2024-07-24 06:52:03'),
(15, 5, 'bougenvile', 'active', 'kasur', '100.00', 0, '100.00', '2024-07-24 02:21:34', '2024-07-24 02:21:34'),
(16, 5, 'anggrek', 'active', 'ruang meeting', '200.00', 0, '200.00', '2024-07-24 02:22:07', '2024-07-24 06:51:19');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_27_151336_create_tours_table', 1),
(6, '2024_05_27_152229_create_hotels_table', 1),
(7, '2024_05_28_020744_create_tour_packages_table', 1),
(8, '2024_05_28_153602_create_order_packages_table', 1),
(9, '2024_05_28_153614_create_order_hotels_table', 1),
(10, '2024_05_30_062433_create_settings_table', 1),
(11, '2024_07_21_051646_create_hotel_rooms_table', 1),
(12, '2024_07_22_025929_add_room_id_to_order_hotels_table', 1),
(13, '2024_07_22_133241_add_room_id_to_tour_packages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_hotels`
--

CREATE TABLE `order_hotels` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED DEFAULT NULL,
  `code_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_status` enum('unpaid','process','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `special_requests` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_hotels`
--

INSERT INTO `order_hotels` (`id`, `user_id`, `room_id`, `code_order`, `order_date`, `check_in_date`, `check_out_date`, `image`, `account_owner`, `bank_name`, `amount`, `payment_status`, `special_requests`, `created_at`, `updated_at`) VALUES
(2, 10, 6, 'HT/IBVFZ2C0LM', '2024-07-24', '2024-07-25', '2024-07-27', 'Payment_1721810635.png', 'nabila', 'BRI', '200000.00', 'paid', NULL, '2024-07-24 01:42:19', '2024-07-24 01:44:24'),
(3, 10, 15, 'HT/WKNHZJPPIK', '2024-07-24', '2024-07-25', '2024-07-28', 'Payment_1721828940.png', 'winda', 'BRI', '300.00', 'paid', NULL, '2024-07-24 06:46:25', '2024-07-24 06:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_packages`
--

CREATE TABLE `order_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tourPackage_id` bigint UNSIGNED NOT NULL,
  `code_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_package` int NOT NULL,
  `order_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('unpaid','process','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_packages`
--

INSERT INTO `order_packages` (`id`, `user_id`, `tourPackage_id`, `code_order`, `quantity_package`, `order_date`, `departure_date`, `image`, `account_owner`, `bank_name`, `payment_status`, `amount`, `created_at`, `updated_at`) VALUES
(2, 10, 3, 'PW/G8G9STKXR2', 1, '2024-07-24', '2024-07-27', 'Payment_1721810612.png', 'nabila', 'BRI', 'paid', '100050.00', '2024-07-24 01:42:57', '2024-07-24 01:44:14'),
(3, 10, 1, 'PW/A93XNFEBTY', 1, '2024-07-24', '2024-07-27', 'Payment_1721828862.png', 'winda', 'BRI', 'paid', '200100.00', '2024-07-24 06:46:45', '2024-07-24 06:49:14');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name_app` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_hero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_hero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `name_app`, `short_description`, `logo`, `phone`, `email`, `address`, `name_hero`, `image_hero`, `link_youtube`, `link_instagram`, `account_number`, `account_owner`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'app tour', 'Temukan petualangan Anda berikutnya bersama kami. Jelajahi destinasi menakjubkan, nikmati paket perjalanan eksklusif, dan ciptakan kenangan tak terlupakan. Mari wujudkan perjalanan impian Anda bersama Happy Tour!', 'Logo_1721826070.png', '084994839', 'apptour@gmail.com', 'LoJl. Imogiri Barat No.km 6, Glagah Kidul, Tamanan, Kec. Banguntapan, Kab Bantul, Daerah Istimewa Yogyakarta 55191rem ipsum dolor sit amet consectetur adipisicing elit.', 'welcome to app tour', 'Hero_1721745452.jpg', 'https://www.youtube.com/channel', 'https://www.instagram.com/HappyTour', '849849303', 'Mr. R', 'BRI', '2024-07-22 23:01:09', '2024-07-24 06:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `user_id`, `name`, `price`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'candi ijo', '200000', 'candi ijo adalah sebuah kompleks candi hindu yang terletak di bukit ijo, prambanan, sleman, yogyakarta, indonesia. kompleks candi ini terletak di ketinggian sekitar 410 meter di atas permukaan laut, menjadikannya candi dengan lokasi tertinggi di yogyakarta.', 'Tour_1721745852.jpeg', '2024-07-23 01:18:16', '2024-07-23 07:44:12'),
(2, 1, 'bukit bintang', '100000', 'bukit bintang adalah salah satu destinasi wisata populer di yogyakarta yang menawarkan pemandangan malam yang indah dengan gemerlap lampu kota yang mempesona. tempat ini menjadi favorit bagi wisatawan yang ingin menikmati keindahan alam sambil bersantai dengan keluarga atau teman-teman.', 'Tour_1721745919.jpeg', '2024-07-23 01:26:20', '2024-07-23 07:45:19'),
(3, 1, 'wisata taman sari', '50.000', 'taman sari adalah salah satu situs bersejarah dan objek wisata populer di yogyakarta, indonesia. juga dikenal sebagai \"istana air,\" taman sari awalnya merupakan tempat rekreasi dan kebun istana bagi sultan yogyakarta serta keluarganya. tempat ini dibangun pada pertengahan abad ke-18 oleh sultan hamengkubuwono i.', 'Tour_1721745824.jpg', '2024-07-23 01:27:59', '2024-07-23 07:43:44'),
(6, 1, 'candi kalasan', '50.000', 'candi kalasan atau candi kalibening merupakan sebuah bangunan cagar budaya yang dikategorikan sebagai candi umat buddha. candi ini terletak di desa tirtomartani, kecamatan kalasan, kabupaten sleman, daerah istimewa yogyakarta,', 'Tour_1721828402.jpeg', '2024-07-24 06:40:02', '2024-07-24 06:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

CREATE TABLE `tour_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tour_id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED DEFAULT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL DEFAULT '0',
  `duration` int NOT NULL DEFAULT '0',
  `price_hotel` decimal(15,2) NOT NULL,
  `price_tour` decimal(15,2) NOT NULL,
  `price_total` decimal(15,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`id`, `user_id`, `tour_id`, `room_id`, `package_name`, `capacity`, `duration`, `price_hotel`, `price_tour`, `price_total`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'paket wisata candi ijo', 2, 2, '100.00', '200000.00', '200100.00', 'TourPackage_1721745735.jpeg', '2024-07-23 01:22:22', '2024-07-23 07:42:15'),
(2, 1, 3, 3, 'paket wisata taman sari', 2, 2, '150.00', '50.00', '200.00', 'TourPackage_1721745627.jpg', '2024-07-23 01:38:52', '2024-07-23 07:40:27'),
(3, 1, 2, 4, 'paket wisata bukit bintang', 1, 1, '50.00', '100000.00', '100050.00', 'TourPackage_1721746458.jpeg', '2024-07-23 07:54:18', '2024-07-23 07:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profil.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `gender`, `address`, `role`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Pnnh/1vRYSAiMV2n5ytg7uQ4qEHSOoMITYsVZVb3.fi4PtyP3EkRO', NULL, NULL, NULL, 'admin', 'Profil_1721745499.jpg', NULL, '2024-07-22 23:01:09', '2024-07-23 07:38:20'),
(8, 'fajri', 'fajri@gmail.com', '$2y$10$Pnnh/1vRYSAiMV2n5ytg7uQ4qEHSOoMITYsVZVb3.fi4PtyP3EkRO', '096478', 'female', 'jogja', 'member', 'Profil_1721807093.png', NULL, '2024-07-24 00:44:54', '2024-07-24 00:44:54'),
(9, 'nabila', 'nabila@gmail.cm', '$2y$10$Qlx4qaiv21wnIEyLr9uHi.UkMWianvdbcC7XCG6s5Kw.etGvJ8AJS', '09736473', 'female', 'jogja', 'member', 'Profil_1721810276.png', NULL, '2024-07-24 01:37:56', '2024-07-24 01:37:56'),
(10, 'jefri', 'jefri@gmail.com', '$2y$10$tuJhO7UUuqsq.3ZUGPmrk.2bmIvCiLr9jDhm.iNkscW9Z5KTgjd9a', '23343647', 'female', 'jgja', 'member', 'Profil_1721810390.png', NULL, '2024-07-24 01:39:50', '2024-07-24 01:39:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotels_user_id_foreign` (`user_id`);

--
-- Indexes for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_rooms_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_hotels`
--
ALTER TABLE `order_hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_hotels_user_id_foreign` (`user_id`),
  ADD KEY `order_hotels_room_id_foreign` (`room_id`);

--
-- Indexes for table `order_packages`
--
ALTER TABLE `order_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_packages_user_id_foreign` (`user_id`),
  ADD KEY `order_packages_tourpackage_id_foreign` (`tourPackage_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_user_id_foreign` (`user_id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tours_user_id_foreign` (`user_id`);

--
-- Indexes for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_packages_user_id_foreign` (`user_id`),
  ADD KEY `tour_packages_tour_id_foreign` (`tour_id`),
  ADD KEY `tour_packages_room_id_foreign` (`room_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_hotels`
--
ALTER TABLE `order_hotels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_packages`
--
ALTER TABLE `order_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD CONSTRAINT `hotel_rooms_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_hotels`
--
ALTER TABLE `order_hotels`
  ADD CONSTRAINT `order_hotels_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `hotel_rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_hotels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_packages`
--
ALTER TABLE `order_packages`
  ADD CONSTRAINT `order_packages_tourpackage_id_foreign` FOREIGN KEY (`tourPackage_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_packages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD CONSTRAINT `tour_packages_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `hotel_rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tour_packages_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tour_packages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
