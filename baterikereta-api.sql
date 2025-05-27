-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 10:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baterikereta-api`
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
(5, '2025_05_08_074820_create_password_resets_table', 1),
(6, '2025_05_13_090446_create_user_profiles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'dina@gmail.com', 'jVF2JlVbAqs9czC3PGVjKPH0B72UaRg3DH6ef4Efq8zRu4vZELrvVGfLqupS', '2025-05-13 22:48:02'),
(2, 'farhana@gmail.com', '2XtbymChcnI3Xx3bfqbvYnxej20677R56zjyuKrNzDaPsvvQm0vCKkL6mJTQ', '2025-05-13 23:40:16'),
(3, 'mazarina@gmail.com', 'Zcfof2MbBBUXtCV1vWM4Q6LrLmUMkN3GIdyrQEeq2gb9CbL4HksW0Wc0vmRK', '2025-05-14 00:17:56');

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', 1, 'API Token of: dina', '1976930026ac7336273e20eb194ce3550253cc17981a61c357ffdb453a7acf4e', '[\"*\"]', NULL, NULL, '2025-05-13 22:41:08', '2025-05-13 22:41:08'),
(4, 'App\\Models\\User', 1, 'API Token of: dina', '2bc24b9153d913be7f00fdc86304a861d903688f4d26c33fcc25a3c22b18898d', '[\"*\"]', NULL, NULL, '2025-05-13 22:41:09', '2025-05-13 22:41:09'),
(5, 'App\\Models\\User', 1, 'API Token of: dina', '965207b0d55d21f3dbbd0e30dfd4ab3391680d1f97904e2c3ee9cd4c5057c5e5', '[\"*\"]', NULL, NULL, '2025-05-13 22:41:36', '2025-05-13 22:41:36'),
(6, 'App\\Models\\User', 1, 'API Token of: dina', '9df2e4e75dd9592642b652726f3695b00f4d87cd2a0d9cc925f7a82285893524', '[\"*\"]', NULL, NULL, '2025-05-13 22:41:38', '2025-05-13 22:41:38'),
(7, 'App\\Models\\User', 1, 'API Token of: dina', '8d029a11e9a5194870c1d7a0e25e06833f6ad9e0f38147393665ab6d46659c55', '[\"*\"]', NULL, NULL, '2025-05-13 22:42:41', '2025-05-13 22:42:41'),
(8, 'App\\Models\\User', 1, 'API Token of: dina', '455946d5622f5955338ace611870299da756fc08cf679aefdb07866083d37794', '[\"*\"]', NULL, NULL, '2025-05-13 22:42:44', '2025-05-13 22:42:44'),
(9, 'App\\Models\\User', 1, 'API Token of: dina', '7f388a4620147ee839dc92777da72ba5c7931cbb14e772fb4124f8ccc964fc88', '[\"*\"]', NULL, NULL, '2025-05-13 22:45:48', '2025-05-13 22:45:48'),
(10, 'App\\Models\\User', 1, 'API Token of: dina', '80a3543f3b519dc38ca0399812827f3429852daa51dc2f1bf62782e84e979c6b', '[\"*\"]', NULL, NULL, '2025-05-13 22:45:51', '2025-05-13 22:45:51'),
(11, 'App\\Models\\User', 1, 'API Token of: dina', '5b606bd4af90b5f57534a64275adf2530305db2a2223cfd958867d74328e91dd', '[\"*\"]', NULL, NULL, '2025-05-13 22:45:53', '2025-05-13 22:45:53'),
(12, 'App\\Models\\User', 1, 'API Token of: dina', 'ab03991f87b74cb002fd4e8504dfc77165c1490d680b9a82cb99b1d05242e163', '[\"*\"]', NULL, NULL, '2025-05-13 22:45:54', '2025-05-13 22:45:54'),
(13, 'App\\Models\\User', 1, 'API Token of: dina', '202e72bce8851a945d8a26bdefada01673cd3dbc009b9f9ce09e4bb3df56d04a', '[\"*\"]', NULL, NULL, '2025-05-13 22:45:56', '2025-05-13 22:45:56'),
(19, 'App\\Models\\User', 1, 'API Token of: dina', 'b26f97c06dfe29f26c9907419d2e3d3e72f62bba6626c887fbfba796e10d42bd', '[\"*\"]', '2025-05-13 23:09:34', NULL, '2025-05-13 23:09:31', '2025-05-13 23:09:34'),
(21, 'App\\Models\\User', 1, 'API Token of: dina', '218fe6dfdf1c05395b370d46d736ad6fce7004073b26bb4f78332078c1a07428', '[\"*\"]', '2025-05-13 23:23:11', NULL, '2025-05-13 23:23:07', '2025-05-13 23:23:11'),
(22, 'App\\Models\\User', 1, 'API Token of: dina', '40736c312c2cec10e6bf840105414d3c7434bfcd94dd46971eaef323260826ae', '[\"*\"]', '2025-05-13 23:56:57', NULL, '2025-05-13 23:50:42', '2025-05-13 23:56:57'),
(23, 'App\\Models\\User', 1, 'API Token of: dina', 'ce27b0e3fff10eb14c32b93c6126155e0814237bee037df48658f0e582206df9', '[\"*\"]', '2025-05-13 23:56:55', NULL, '2025-05-13 23:55:24', '2025-05-13 23:56:55'),
(26, 'App\\Models\\User', 1, 'API Token of: dina', '255353e1809cde19e725dfd6b639e9f37242e9570d25eb73f6855c3e1903797a', '[\"*\"]', NULL, NULL, '2025-05-14 17:05:15', '2025-05-14 17:05:15'),
(27, 'App\\Models\\User', 1, 'API Token of: dina', '85d1a3b3c87bdb428f7d8d3966518d18ec69cc8353691eb8e52d205ed9bae765', '[\"*\"]', NULL, NULL, '2025-05-14 17:05:19', '2025-05-14 17:05:19'),
(28, 'App\\Models\\User', 1, 'API Token of: dina', '9a23919a4ed07fbeb3c5e26ee155b4c597414f2405fbb51923c59459cdaa1255', '[\"*\"]', NULL, NULL, '2025-05-14 17:05:20', '2025-05-14 17:05:20'),
(33, 'App\\Models\\User', 5, 'API Token of: ali', '46a7ecd39a948c38cae5896fb59a3b58a938e3ad7ae1a19eb7067aff0fead16b', '[\"*\"]', '2025-05-14 22:48:18', NULL, '2025-05-14 19:22:16', '2025-05-14 22:48:18'),
(34, 'App\\Models\\User', 1, 'API Token of: dina', 'df12c037b9f24aa8b909a439ba19cabc5df9e807d46254c5df31bcc8f871531a', '[\"*\"]', '2025-05-14 22:44:42', NULL, '2025-05-14 22:44:27', '2025-05-14 22:44:42'),
(35, 'App\\Models\\User', 5, 'API Token of: ali', '4e2f78bb7827366249496acb9413e9c61ebbda9def4af617e79c6cf42c8d54e1', '[\"*\"]', '2025-05-15 00:18:41', NULL, '2025-05-14 22:46:23', '2025-05-15 00:18:41'),
(36, 'App\\Models\\User', 1, 'API Token of: dina', '7c507cf33828bad3aa755b60fd98f4a82ecf0dbca138ead9bd0da7cc97f0faa5', '[\"*\"]', '2025-05-14 23:40:37', NULL, '2025-05-14 22:48:33', '2025-05-14 23:40:37'),
(37, 'App\\Models\\User', 5, 'API Token of: ali', 'c0b22f56a4164b5eae121ed3cce26a0d2825f00b45de26659f5055e534d8c2cd', '[\"*\"]', '2025-05-15 00:13:13', NULL, '2025-05-14 23:40:52', '2025-05-15 00:13:13'),
(38, 'App\\Models\\User', 5, 'API Token of: ali', '5c9359fb064bb65db711e084080953b960bb458278bd3fc52aa3b440264e13a6', '[\"*\"]', '2025-05-15 00:22:10', NULL, '2025-05-15 00:13:27', '2025-05-15 00:22:10'),
(39, 'App\\Models\\User', 5, 'API Token of: ali', 'c3096f8e92d3394146ae9b712b88912327a9ec923224d67c056453d646ff2e3a', '[\"*\"]', '2025-05-15 00:23:36', NULL, '2025-05-15 00:22:41', '2025-05-15 00:23:36'),
(40, 'App\\Models\\User', 5, 'API Token of: ali', '42b62fcb8c09718228fbab2c9a840808456ac841a9fd39c003ef27002d05c153', '[\"*\"]', '2025-05-15 00:24:47', NULL, '2025-05-15 00:24:42', '2025-05-15 00:24:47'),
(41, 'App\\Models\\User', 6, 'API Token', '675edac9df4bffc432ab2bf1292e895d37f51d92c5622094e213ef1d686d87b7', '[\"*\"]', '2025-05-15 00:26:15', NULL, '2025-05-15 00:25:42', '2025-05-15 00:26:15'),
(42, 'App\\Models\\User', 5, 'API Token of: ali', '00cb461ac0a1648aa464df1cc7584a6f12f0b0f636ba3f9bf38696acb2e90a4c', '[\"*\"]', '2025-05-15 00:44:00', NULL, '2025-05-15 00:26:18', '2025-05-15 00:44:00'),
(43, 'App\\Models\\User', 5, 'API Token of: ali', 'fba81d28a1be42c31038f0e8f7034a8feebfcab1b069445b324683bac823bc7c', '[\"*\"]', '2025-05-15 00:50:25', NULL, '2025-05-15 00:44:21', '2025-05-15 00:50:25'),
(44, 'App\\Models\\User', 1, 'API Token of: dina', '35e80b5df482434f6179bc27ef552ef4810c96728814f9ceebebf40060c653ea', '[\"*\"]', '2025-05-15 01:27:08', NULL, '2025-05-15 00:50:50', '2025-05-15 01:27:08'),
(45, 'App\\Models\\User', 1, 'API Token of: dina', 'eeb4c0e1fc715b92de3193675538c5aa9203ab7f15a0be0458dbebd27c84330e', '[\"*\"]', NULL, NULL, '2025-05-15 17:05:02', '2025-05-15 17:05:02'),
(46, 'App\\Models\\User', 1, 'API Token of: dina', '9ba220e221b43c721a35d6ef45d69b19ae8e1bb7acf35922f938862a4e6129d1', '[\"*\"]', '2025-05-15 18:27:29', NULL, '2025-05-15 17:37:21', '2025-05-15 18:27:30'),
(47, 'App\\Models\\User', 1, 'API Token of: dina', 'e5fe03b3bcc81b726b44997e211f93e4d2a1e842ec908c04afcf3653ea54211c', '[\"*\"]', '2025-05-15 20:38:53', NULL, '2025-05-15 18:28:04', '2025-05-15 20:38:53'),
(48, 'App\\Models\\User', 5, 'API Token of: ali', '4d7f3bd82df5d833979813301168a8a9d1fef93705bee7bd21b806f1082fd670', '[\"*\"]', '2025-05-15 20:40:18', NULL, '2025-05-15 20:39:26', '2025-05-15 20:40:18'),
(49, 'App\\Models\\User', 1, 'API Token of: dina', '43702128a439bdd15744047a52c93111f45c8832c3cf8279cc85d410aac8140a', '[\"*\"]', '2025-05-15 21:56:12', NULL, '2025-05-15 20:40:36', '2025-05-15 21:56:12'),
(50, 'App\\Models\\User', 1, 'API Token of: dina', '303592777758942b970c3650c492b642d88014ad58bcbe478934747066f34a9d', '[\"*\"]', '2025-05-15 22:38:03', NULL, '2025-05-15 21:56:24', '2025-05-15 22:38:03'),
(51, 'App\\Models\\User', 1, 'API Token of: dina', '4044b62259404c4d39962ba544e4393242564c7f25757e4133311ca274204e3a', '[\"*\"]', '2025-05-15 22:39:47', NULL, '2025-05-15 22:38:18', '2025-05-15 22:39:47'),
(52, 'App\\Models\\User', 1, 'API Token of: dina', '1a9a0acbb150951e6c5f4177f11dadf2a4042ea61d0dafca5e253af4b4b1184d', '[\"*\"]', '2025-05-15 23:21:30', NULL, '2025-05-15 22:40:17', '2025-05-15 23:21:30'),
(53, 'App\\Models\\User', 5, 'API Token of: ali', 'a73926bbfa676e36ec957ce6dab788b9afaf638dc84bd652217c44dda0330ca1', '[\"*\"]', '2025-05-15 23:29:04', NULL, '2025-05-15 23:21:48', '2025-05-15 23:29:04'),
(54, 'App\\Models\\User', 1, 'API Token of: dina', '547906cfcb37d1b09faefc82cd15aa41ecebe43d73ff31f5c677cf25c54c5b3d', '[\"*\"]', '2025-05-15 23:43:17', NULL, '2025-05-15 23:35:15', '2025-05-15 23:43:17'),
(55, 'App\\Models\\User', 1, 'API Token of: dina', 'db425c42ae2eae48fff843e2d102b4eb72c3e2f0a0d81902d757e700a18c4623', '[\"*\"]', '2025-05-15 23:54:42', NULL, '2025-05-15 23:46:07', '2025-05-15 23:54:42'),
(56, 'App\\Models\\User', 1, 'API Token of: dina', '8d67bb98b263d457c8253b22c779ccb47cec3f56bc0024c31ff85d2f5e3a8161', '[\"*\"]', '2025-05-16 00:38:52', NULL, '2025-05-15 23:56:33', '2025-05-16 00:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ic` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `two_fa_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `ic`, `otp`, `otp_expires_at`, `two_fa_enabled`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dina', 'dina@gmail.com', NULL, '$2y$10$DyAE8hloYDAVQTLJNEG3ROFz96.6rn.aI6Z4EO.3Gu1LRrlQUgvuC', '01117220198', '050129060676', NULL, NULL, 1, NULL, '2025-05-13 20:18:43', '2025-05-14 17:37:27'),
(2, 'Maza', 'maza@gmal.com', NULL, '$2y$10$g7irLE33RNnkj3MlGd0UPOaZmLfdlOiAkUPWRVyz9N0NQIi3iK1HS', '01117220198', NULL, NULL, NULL, 1, NULL, '2025-05-13 22:49:34', '2025-05-13 22:50:04'),
(3, 'farhana', 'farhana@gmail.com', NULL, '$2y$10$ZOzYkC0PVG1LM.RCPXOGKuCTafBPlcyTrwHVKIZA4KHeOS/RvKzAq', '01117220198', NULL, NULL, NULL, 1, NULL, '2025-05-13 22:52:08', '2025-05-13 22:52:25'),
(4, 'mazarina', 'mazarina@gmail.com', NULL, '$2y$10$0d9zMHA/YKWhAQ6vH0pDi.AAGIE7L1KSVnAPz7hWMxQ/NR6gO8qIS', '01117220198', NULL, NULL, NULL, 1, NULL, '2025-05-14 00:16:09', '2025-05-14 00:16:49'),
(5, 'ali', 'ali@gmail.com', NULL, '$2y$10$CLCWxo0l3vw.I7ewkGaMqueXZooikxdO5A0qTgYhrrJ7fl/39e5Lu', '01117220198', '050129060676', NULL, NULL, 1, NULL, '2025-05-14 18:57:04', '2025-05-14 19:23:53'),
(6, 'faizal', 'faizal@gmail.com', NULL, '$2y$10$eFuJUdZvlveodcKWOLqWNeGv5jN20k08aioOAoTrLgwQW5KTh9Oam', '01117220198', NULL, NULL, NULL, 1, NULL, '2025-05-15 00:25:26', '2025-05-15 00:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `address`, `city`, `postcode`, `state`, `profile_image`, `gender`, `dob`, `created_at`, `updated_at`) VALUES
(1, 1, 'no 400 blok 17 felda keratong 3', 'bandar tun abdul razak', '26900', 'pahang', 'profile_images/1747381599.jpg', 'female', '2024-05-24', '2025-05-13 20:18:43', '2025-05-15 23:46:39'),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-13 22:49:34', '2025-05-13 22:49:34'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-13 22:52:08', '2025-05-13 22:52:08'),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-14 00:16:09', '2025-05-14 00:16:09'),
(5, 5, 'No 401 Blok 17', 'Bandar Tun Abdul Razak', '26900', 'Pahang', 'profile_images/1747282181.jpg', 'male', '2005-01-29', '2025-05-14 18:57:04', '2025-05-14 20:09:41'),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-15 00:25:27', '2025-05-15 00:25:27');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
