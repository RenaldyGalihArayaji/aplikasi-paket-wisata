-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2024 at 12:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.29

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `star` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `user_id`, `name`, `location`, `image`, `star`, `created_at`, `updated_at`) VALUES
(1, 1, 'hotel kayla', 'Jalan Wahid Hasyim No. 61, Ngampilan, Kota Yogyakarta, Daerah Istimewa Yogyakarta,', 'hotel_1721722834.jpg', 2, '2024-07-23 01:20:34', '2024-07-23 01:20:34'),
(2, 1, 'hotel  patra', 'Jl. Cendrawasih No. 36, Demangan Baru, Caturtunggal, Depok, Sleman, Daerah Istimewa Yogyakarta 55281', 'hotel_1721723360.jpg', 3, '2024-07-23 01:29:20', '2024-07-23 01:29:20'),
(3, 1, 'hotel nabila', 'Jl. Raden Ronggo No. 14, Wirobrajan, Kota Yogyakarta', 'hotel_1721723436.jpg', 2, '2024-07-23 01:30:36', '2024-07-23 01:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_rooms`
--

CREATE TABLE `hotel_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `facility` text NOT NULL,
  `price_start` decimal(15,2) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `price_final` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_rooms`
--

INSERT INTO `hotel_rooms` (`id`, `hotel_id`, `room_type`, `status`, `facility`, `price_start`, `discount`, `price_final`, `created_at`, `updated_at`) VALUES
(1, 1, 'mawar', 'active', 'ruang autdhorr', 100.00, 0, 100.00, '2024-07-23 01:21:14', '2024-07-23 01:35:17'),
(2, 3, 'Family Room', 'active', 'Tempat tidur tambahan, area bermain untuk anak-anak', 20.00, 0, 20.00, '2024-07-23 01:32:26', '2024-07-23 01:32:26'),
(3, 2, 'Executive Room', 'active', 'Akses internet cepat', 150.00, 0, 150.00, '2024-07-23 01:33:27', '2024-07-23 01:33:27'),
(4, 1, 'Standard Room', 'active', 'Minimal, sesuai dengan kebutuhan dasar tamu.', 50.00, 0, 50.00, '2024-07-23 01:34:39', '2024-07-23 01:34:39'),
(5, 1, 'Junior Suite', 'active', 'asilitas tambahan seperti area duduk terpisah dan dekorasi yang lebih baik.', 200.00, 0, 200.00, '2024-07-23 01:36:01', '2024-07-23 01:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code_order` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `account_owner` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_status` enum('unpaid','process','paid') NOT NULL DEFAULT 'unpaid',
  `special_requests` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_packages`
--

CREATE TABLE `order_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tourPackage_id` bigint(20) UNSIGNED NOT NULL,
  `code_order` varchar(255) NOT NULL,
  `quantity_package` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `account_owner` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `payment_status` enum('unpaid','process','paid') NOT NULL DEFAULT 'unpaid',
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name_app` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `name_hero` varchar(255) DEFAULT NULL,
  `image_hero` varchar(255) DEFAULT NULL,
  `link_youtube` varchar(255) DEFAULT NULL,
  `link_instagram` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `account_owner` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `name_app`, `short_description`, `logo`, `phone`, `email`, `address`, `name_hero`, `image_hero`, `link_youtube`, `link_instagram`, `account_number`, `account_owner`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'app tour', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia dignissimos alias perspiciatis veritatis? Voluptate voluptatem, deleniti libero rerum sapiente fugiat.', 'logo.png', '084994839', 'apptour@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'welcome to app tour', 'hero.jpg', NULL, NULL, '849849303', 'Mr. R', 'BRI', '2024-07-22 23:01:09', '2024-07-23 01:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `user_id`, `name`, `price`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'candi ijo', '200000', 'candi ijo adalah sebuah kompleks candi hindu yang terletak di bukit ijo, prambanan, sleman, yogyakarta, indonesia. kompleks candi ini terletak di ketinggian sekitar 410 meter di atas permukaan laut, menjadikannya candi dengan lokasi tertinggi di yogyakarta.', 'Tour_1721722696.jpg', '2024-07-23 01:18:16', '2024-07-23 01:18:16'),
(2, 1, 'bukit bintang', '100000', 'bukit bintang adalah salah satu destinasi wisata populer di yogyakarta yang menawarkan pemandangan malam yang indah dengan gemerlap lampu kota yang mempesona. tempat ini menjadi favorit bagi wisatawan yang ingin menikmati keindahan alam sambil bersantai dengan keluarga atau teman-teman.', 'Tour_1721723180.jpg', '2024-07-23 01:26:20', '2024-07-23 01:26:20'),
(3, 1, 'wisata taman sari', '50.000', 'taman sari adalah salah satu situs bersejarah dan objek wisata populer di yogyakarta, indonesia. juga dikenal sebagai \"istana air,\" taman sari awalnya merupakan tempat rekreasi dan kebun istana bagi sultan yogyakarta serta keluarganya. tempat ini dibangun pada pertengahan abad ke-18 oleh sultan hamengkubuwono i.', 'Tour_1721723279.jpg', '2024-07-23 01:27:59', '2024-07-23 01:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

CREATE TABLE `tour_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL DEFAULT 0,
  `price_hotel` decimal(15,2) NOT NULL,
  `price_tour` decimal(15,2) NOT NULL,
  `price_total` decimal(15,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`id`, `user_id`, `tour_id`, `room_id`, `package_name`, `capacity`, `duration`, `price_hotel`, `price_tour`, `price_total`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'paket wisata candi ijo', 2, 2, 100.00, 200000.00, 200100.00, 'TourPackage_1721722942.jpg', '2024-07-23 01:22:22', '2024-07-23 01:51:08'),
(2, 1, 3, 3, 'paket wisata taman sari', 2, 2, 150.00, 50.00, 200.00, 'TourPackage_1721723932.jpg', '2024-07-23 01:38:52', '2024-07-23 01:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` enum('admin','member') NOT NULL DEFAULT 'member',
  `image` varchar(255) NOT NULL DEFAULT 'profil.png',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `gender`, `address`, `role`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$L9OD1uKFzINg5OKd9rqBIuGnqNLnehEroVdJEqOO2LWk8OBga3ke2', NULL, NULL, NULL, 'admin', 'profil.png', NULL, '2024-07-22 23:01:09', '2024-07-22 23:01:09'),
(2, 'winda lisa', 'windalisa849@gmail.com', '$2y$10$sMMZGakSTR6FpQA64fPdeeXUlJ1SPJohaseR2bWVtwTGBSajTbw1G', NULL, NULL, NULL, 'admin', 'Profil_1721722474.jpg', NULL, '2024-07-23 01:14:35', '2024-07-23 01:14:35'),
(3, 'susilawati', 'sayasila2002@gmail.com', '$2y$10$ecp5OwyFIcMh8.EO.8NeROZVCjUa1BKiFdTQt5BZu0o.ZT5F2h/h6', '0882132311', 'female', 'Bantul', 'member', 'Profil_1721722561.jpg', NULL, '2024-07-23 01:16:01', '2024-07-23 01:16:01'),
(4, 'winda lisa', 'windalisa11@gmail.com', '$2y$10$WPFpDzkYDUdO37h.9Det1uECxK3Knek6RhiNnaQMSFTKT9kPyd7Dy', '85271154058', 'female', 'yogyakarta', 'member', 'Profil_1721734570.jpg', NULL, '2024-07-23 04:36:10', '2024-07-23 04:36:10'),
(5, 'winda lisa', 'winda12@gmail.com', '$2y$10$/i0qMmst3ah.QCEkTrXN0.tgivBKcciCrUTWtH/V8Gs7STvdbCMz6', '85271154058', 'female', 'yogyakrta', 'member', 'Profil_1721734628.jpg', NULL, '2024-07-23 04:37:09', '2024-07-23 04:37:09');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_hotels`
--
ALTER TABLE `order_hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_packages`
--
ALTER TABLE `order_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
