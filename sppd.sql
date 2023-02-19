-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 20, 2023 at 12:18 AM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppd`
--

-- --------------------------------------------------------

--
-- Table structure for table `dinas_travel`
--

CREATE TABLE `dinas_travel` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_transfer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `approved_id` bigint UNSIGNED DEFAULT NULL,
  `total` int DEFAULT NULL,
  `request_user_id` bigint UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dinas_travel`
--

INSERT INTO `dinas_travel` (`id`, `created_at`, `updated_at`, `judul`, `status`, `bukti_transfer`, `approved_id`, `total`, `request_user_id`, `note`) VALUES
(15, '2023-02-19 01:08:50', '2023-02-19 08:35:55', 'Perjalanan 1', 'approved', 'public/A6h7PJiJGYHNAf4ZKOOHC7AAKoJiv6tREydplxai.jpg', NULL, 700001223, NULL, 'Periksa lagi'),
(17, '2023-02-19 09:21:39', '2023-02-19 09:21:39', 'Perjalanan 2', 'need_approval', NULL, NULL, 20000, NULL, NULL),
(18, '2023-02-19 09:23:22', '2023-02-19 09:23:22', 'Perjalanan 3', 'need_approval', NULL, NULL, 2, NULL, NULL);

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
-- Table structure for table `item_dinas_travel`
--

CREATE TABLE `item_dinas_travel` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_dinas_travel`
--

INSERT INTO `item_dinas_travel` (`id`, `created_at`, `updated_at`, `item`) VALUES
(1, NULL, NULL, 'Kebutuhan Makan'),
(2, NULL, NULL, 'Perlatan Kerja'),
(3, NULL, NULL, 'Ongkos Perjalanan');

-- --------------------------------------------------------

--
-- Table structure for table `item_request`
--

CREATE TABLE `item_request` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_dinas_travel_id` bigint UNSIGNED NOT NULL,
  `dinas_travel_id` bigint UNSIGNED NOT NULL,
  `price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_request`
--

INSERT INTO `item_request` (`id`, `created_at`, `updated_at`, `item_dinas_travel_id`, `dinas_travel_id`, `price`) VALUES
(14, '2023-02-19 08:35:55', '2023-02-19 08:35:55', 1, 15, 20000),
(15, '2023-02-19 08:35:55', '2023-02-19 08:35:55', 2, 15, 50000),
(16, '2023-02-19 08:35:55', '2023-02-19 08:35:55', 1, 15, 1223),
(17, '2023-02-19 09:21:39', '2023-02-19 09:21:39', 1, 17, 20000),
(18, '2023-02-19 09:23:22', '2023-02-19 09:23:22', 1, 18, 2);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_15_131009_create_role_table', 1),
(6, '2023_02_15_131025_create_user_role_table', 1),
(7, '2023_02_16_084715_drop_user_role', 2),
(8, '2023_02_16_084848_add_role_id_in_user_table', 3),
(9, '2023_02_16_104908_create_dinas_travel_table', 4),
(10, '2023_02_16_110033_create_item_dinas_travel_table', 4),
(11, '2023_02_16_111308_add_total_in_dinas_travel_table', 5),
(12, '2023_02_16_111703_edit_dinas_travel_table', 6),
(13, '2023_02_16_125849_create_item_request_table', 7),
(14, '2023_02_16_131259_add_price_in_item_request', 8),
(15, '2023_02_16_134007_remove_column_item_dinas_travel_table', 9),
(16, '2023_02_16_134506_add_column_item_request_table', 10),
(17, '2023_02_16_134608_remove_column_item_dinas_travel_table_2', 11),
(18, '2023_02_18_115806_edit_users_table', 12),
(19, '2023_02_19_054552_edit_item_request_table', 13),
(20, '2023_02_19_072357_add_column_users_table', 14),
(21, '2023_02_19_072408_add_column_dinas_travel_table', 14),
(22, '2023_02_19_082010_edit_column_dinas_travel_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `created_at`, `updated_at`, `name`) VALUES
(2, NULL, NULL, 'staff'),
(3, NULL, NULL, 'supervisor'),
(4, NULL, NULL, 'finance');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `no_rek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `no_rek`, `bank`) VALUES
(1, 'staff 4', 'staff@test.com', NULL, '$2y$10$lk5vRBKUl2nC.Ac0jMfpRuOg0cr8V1MbGSXQpZo/hoYzAxyk25PFi', NULL, NULL, '2023-02-18 21:02:18', 2, NULL, NULL),
(2, 'spv', 'spv@test.com', NULL, '$2y$10$RqVrqIfAGl.Mt.jICk4K..i5QRn5I5O1oMnSZq9VpIMRb7e4gwrxi', NULL, NULL, NULL, 3, NULL, NULL),
(3, 'sam', 'sam@test.com', NULL, '$2y$10$WcnFFrHBlcnyrvs/Fmxcu.2JQJ2iznwkEMDyKEPpXt6i.eANXdNlm', NULL, '2023-02-18 04:59:33', '2023-02-18 04:59:33', 2, NULL, NULL),
(6, 'sams', 'sam@test1.com', NULL, '$2y$10$hr09Oxn5eNco/4X0a7xRSuhz49yo4v4NpegvF.AHyEBkT0meBOO3e', NULL, '2023-02-18 05:00:49', '2023-02-18 05:00:49', 2, NULL, NULL),
(11, 'finance', 'finance@test.com', NULL, '$2y$10$zcT.jpu036ebw..GbHDx1esosL.ixIg39UQqhbv1NZwkKk/kryVIq', NULL, '2023-02-19 09:13:43', '2023-02-19 09:13:43', 4, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dinas_travel`
--
ALTER TABLE `dinas_travel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dinas_travel_approved_id_foreign` (`approved_id`),
  ADD KEY `dinas_travel_request_user_id_foreign` (`request_user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `item_dinas_travel`
--
ALTER TABLE `item_dinas_travel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_request`
--
ALTER TABLE `item_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_request_dinas_travel_id_foreign` (`dinas_travel_id`),
  ADD KEY `item_request_item_dinas_travel_id_foreign` (`item_dinas_travel_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dinas_travel`
--
ALTER TABLE `dinas_travel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_dinas_travel`
--
ALTER TABLE `item_dinas_travel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item_request`
--
ALTER TABLE `item_request`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dinas_travel`
--
ALTER TABLE `dinas_travel`
  ADD CONSTRAINT `dinas_travel_approved_id_foreign` FOREIGN KEY (`approved_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dinas_travel_request_user_id_foreign` FOREIGN KEY (`request_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `item_request`
--
ALTER TABLE `item_request`
  ADD CONSTRAINT `item_request_dinas_travel_id_foreign` FOREIGN KEY (`dinas_travel_id`) REFERENCES `dinas_travel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_request_item_dinas_travel_id_foreign` FOREIGN KEY (`item_dinas_travel_id`) REFERENCES `item_dinas_travel` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
