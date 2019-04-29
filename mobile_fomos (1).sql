-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2019 at 05:56 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_fomos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive','Delete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Party Ideas', 'category/1546430573-15079.png', 'Active', '2019-01-02 01:16:55', '2019-01-02 20:02:53'),
(2, 'Date Ideas', 'category/1546428545-89693.png', 'Active', '2019-01-02 01:17:49', '2019-01-02 19:29:15'),
(3, 'Party 21+', 'category/1546430593-68820.png', 'Active', '2019-01-02 01:26:40', '2019-01-02 20:03:13'),
(4, 'Family Night', 'category/1546428519-94836.png', 'Active', '2019-01-02 18:41:22', '2019-01-02 19:28:39'),
(5, 'Popular', 'category/1546430609-34739.png', 'Active', '2019-01-02 19:34:25', '2019-01-02 20:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike_post`
--

CREATE TABLE `like_dislike_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `type` enum('like','dislike') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_01_02_042056_create_categories_table', 2),
(6, '2019_01_02_110156_create_posts_table', 3),
(7, '2019_01_02_111545_create_posts_table', 4),
(8, '2019_01_02_112640_create_post_images_table', 5),
(9, '2019_01_03_114529_create_reports_table', 6),
(10, '2019_01_04_064112_create_post_reports_table', 7),
(11, '2019_01_07_090758_create_user_devices_table', 8),
(13, '2019_01_09_101814_create_like_dislike_post_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `address_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive','Delete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `address_title`, `address`, `description`, `lng`, `lat`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Zion National Park', 'Zion National Park, Utah, Us', 'Ful day adventure with friends..', '113.0263', '37.2982', 'Active', '2019-01-02 20:31:30', '2019-01-08 21:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'post/1546432290-19232.jpg', '2019-01-02 20:31:30', '2019-01-02 20:31:30'),
(2, 1, 'post/1546432290-29310.jpg', '2019-01-02 20:31:30', '2019-01-02 20:31:30'),
(3, 2, 'post/1546602161-74313.jpg', '2019-01-04 19:42:41', '2019-01-04 19:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `post_reports`
--

CREATE TABLE `post_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED DEFAULT NULL,
  `report_id` int(10) UNSIGNED DEFAULT NULL,
  `report_to_user_id` int(10) UNSIGNED DEFAULT NULL,
  `report_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('report','hide','share') COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_type` enum('user','post') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Delete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_reports`
--

INSERT INTO `post_reports` (`id`, `user_id`, `post_id`, `report_id`, `report_to_user_id`, `report_reason`, `type`, `report_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 2, 4, NULL, 'report', 'user', 'Inactive', '2019-01-07 20:27:54', '2019-01-08 21:54:52'),
(2, 4, 1, NULL, NULL, 'so bad...', 'report', 'post', 'Inactive', '2019-01-07 20:29:22', '2019-01-08 21:55:23'),
(3, 3, 1, NULL, NULL, NULL, 'report', 'post', 'Active', '2019-01-09 13:44:23', '2019-01-09 13:44:23'),
(4, 3, 1, NULL, NULL, NULL, 'report', 'post', 'Active', '2019-01-09 13:46:02', '2019-01-09 13:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('user','post') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Delete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `title`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fake account', 'user', 'Active', '2019-01-03 21:19:57', '2019-01-03 21:19:57'),
(2, 'Fake name', 'user', 'Active', '2019-01-03 21:20:08', '2019-01-09 21:30:22'),
(3, 'Inappropriate image', 'post', 'Active', '2019-01-03 21:20:27', '2019-01-03 21:20:27'),
(4, 'I want to help', 'post', 'Inactive', '2019-01-03 21:20:37', '2019-01-03 21:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fbid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `status` enum('Active','Inactive','Delete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `display_name`, `email`, `role`, `password`, `image`, `fbid`, `gid`, `code`, `phone`, `age`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'admin@admin.com', 'admin', '$2y$10$H.PYrHHIIHr0N.DiYQvej.OIkoT9eF0YeRF7LbxEYdmU0tG5rxZn.', 'users/1546431173-11169.png', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'Enrj5iARVaqdtGZlXMPbjq7oyId9DGSwk6wBz9ythm6haDVVyHv6ykAeJvS1', '2018-12-27 21:38:32', '2019-01-02 20:12:53'),
(2, 'sonal', 'Sonal', 'sonal@mailinator.com', 'user', '$2y$10$tgJjb17jj0A47r3KXkJuBebhWn9i5wPmGBoEVv8fZSyLBJi845cxi', 'users/1546607012-65502.jpg', NULL, NULL, '91', '8945784578', 22, 'Active', NULL, '2019-01-02 17:39:54', '2019-01-04 21:03:32'),
(3, '123456789456', '123456789456', 'test123@email.com', 'user', '$2y$10$XlDZohNNgB/X/0cN6W.yVemI.x76FwfUcWaWYkokABtpL.4eV9Jmy', NULL, NULL, NULL, '+1', '123456789456', 21, 'Active', NULL, '2019-01-03 17:16:21', '2019-01-03 17:16:21'),
(4, '1234567897', '1234567897', 'test555@gmail.com', 'user', '$2y$10$zhQ6cFfTmfXQSWsgXGUx2u6S8Tz/YQJuj7FQsry1GCtjdhD3tofny', NULL, NULL, NULL, '+1', '1234567897', 21, 'Inactive', NULL, '2019-01-03 17:22:49', '2019-01-08 21:54:52'),
(5, 'f1', 'f1', 'f1@mailinator.com', 'user', '$2y$10$O/L8jXJ5gM1YMN.rPJnetedXozsS9DxFItAbHPQHWeWZdP2zx5QZC', NULL, NULL, NULL, '91', '1234 567 890', 12, 'Active', NULL, '2019-01-04 15:19:09', '2019-01-04 15:19:09'),
(6, 'Navadip Mangroliya', 'Navadip Mangroliya', 'navadippatel007@gmail.com', 'user', '$2y$10$au2YQGyJXnvyc9XPqWBELef32HLBnggGDsiW85RPeloqQVJW.Ei.K', 'https:graph.facebook.com/2136193113131120/picture?large', '2154681491282282', NULL, NULL, NULL, NULL, 'Active', NULL, '2019-01-04 19:21:00', '2019-01-09 21:13:43'),
(7, 'deep', 'deep', 'deep@mailinator.com', 'user', '$2y$10$/K7oTWb6PFc.Gf4WE0Vlku/TBCCZiihwFFFAG9WYwZnCe0A6ho5LK', NULL, NULL, NULL, '91', '8945784512', 21, 'Active', NULL, '2019-01-04 19:42:11', '2019-01-04 19:42:11'),
(8, 'Bela Parker', NULL, 'peterparkerios00@gmail.com', 'user', '', 'https:graph.facebook.com/591566937950210/picture?large', '591566937950210', NULL, NULL, NULL, NULL, 'Active', NULL, '2019-01-07 18:37:03', '2019-01-07 18:37:03'),
(9, 'nav', 'nav', 'nav@mailinator.com', 'user', '$2y$10$8wMdFyiTI793sj/n8WtKYuVtvFdRG7/Qv7igLKnXvDhwJ2e22gEFu', NULL, NULL, NULL, '91', '99776 61139', 0, 'Active', NULL, '2019-01-07 18:57:31', '2019-01-07 19:05:28'),
(10, 'tt', 'tt', 'tt@mailinator.com', 'user', '$2y$10$vP9Pe6YesYX58FVuSAOw6.6d96hswXZMNYZizz2N.p5M2QVUwyecu', NULL, NULL, NULL, '1', '989-898-9898', 1, 'Active', NULL, '2019-01-07 23:01:26', '2019-01-07 23:01:26'),
(11, '98098098099', '98098098099', 'gki@mailinator.com', 'user', '$2y$10$H9JpkGz/d6C./MEk5X3N/eHA7yFbqiSeRFxmSgXs9wJj.Sl66xsr.', NULL, NULL, NULL, '+91', '98098098099', 0, 'Active', NULL, '2019-01-08 21:38:11', '2019-01-08 21:54:40'),
(12, '23 254 2588', '23 254 2588', 'test666@gmail.com', 'user', '$2y$10$k8e3SsTJVeR6kKhCILt6Gu/Lerf2gdEaZ4cnLbrwlV1C0rjunYQj2', NULL, NULL, NULL, '+93', '23 254 2588', 21, 'Active', NULL, '2019-01-08 22:15:51', '2019-01-08 22:15:51'),
(13, '21 154 12 55', '21 154 12 55', 'vvvv@ggg.com', 'user', '$2y$10$N8phJ3YC5b3mYw2xILYpO.E.iZWq2bINYHYiWZhfnw93.2dLqIHji', NULL, NULL, NULL, '+41', '21 154 12 55', 2, 'Active', NULL, '2019-01-08 22:27:30', '2019-01-08 22:27:30'),
(14, 'Test User 3', 'Test User 3', 'test9@mailinator.com', 'user', '$2y$10$PRQDguP3bvKn7bmf8mZOjOdGCT0oeabESDS.ddYLzg2L/3fTZQ5yW', NULL, '222222', '1111111', '91', '12345679', 21, 'Active', NULL, '2019-01-08 23:28:10', '2019-01-08 23:28:10'),
(15, 'Test User 3', 'Test User 3', 'test123@mailinator.com', 'user', '$2y$10$GxCxVl80tL26RZ8tp7xp7.9Yu/K4bXoKXw.np86EWV48/9vqrmezC', NULL, '222222', '1111111', '91', '12345679', 21, 'Active', NULL, '2019-01-08 23:29:47', '2019-01-08 23:29:47'),
(16, '2135 464 545', '2135 464 545', 'test111@gmail.com', 'user', '$2y$10$E.9xFLRcrvjXMzRrkKpH0OxS7eD98RGN3Q3NxFgaBxyCE3lSp/hki', NULL, NULL, NULL, '+1', '2135 464 545', 21, 'Active', NULL, '2019-01-08 23:49:44', '2019-01-08 23:49:44'),
(17, 'Test User 3', 'Test User 3', 'test124@mailinator.com', 'user', '$2y$10$DCrfvK/cGr4jmI0KMsDoyOBS7ZjjGtECS2ShgThflnDmvjfiMPKPi', NULL, '222222', '1111111', '91', '12345679', 21, 'Active', NULL, '2019-01-09 17:28:03', '2019-01-09 17:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_devices`
--

CREATE TABLE `user_devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `unique_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` enum('Android','iOS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `firebase_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_devices`
--

INSERT INTO `user_devices` (`id`, `user_id`, `unique_id`, `device_type`, `firebase_token`, `created_at`, `updated_at`) VALUES
(2, 5, 'bd3f7fe91d5e9021', 'Android', 'ABCD token login', '2019-01-08 22:01:14', '2019-01-08 22:02:11'),
(3, 5, 'e5527c507d1e2ca', 'Android', 'ABCD token login', '2019-01-09 14:09:33', '2019-01-09 14:26:41'),
(4, 6, 'd533b307f21f029b', 'Android', 'ABCD token login', '2019-01-09 18:49:44', '2019-01-09 21:13:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_dislike_post`
--
ALTER TABLE `like_dislike_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_dislike_post_user_id_foreign` (`user_id`),
  ADD KEY `like_dislike_post_post_id_foreign` (`post_id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_images_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_reports_user_id_foreign` (`user_id`),
  ADD KEY `post_reports_post_id_foreign` (`post_id`),
  ADD KEY `post_reports_report_id_foreign` (`report_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `like_dislike_post`
--
ALTER TABLE `like_dislike_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
