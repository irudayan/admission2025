-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 07:05 AM
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
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `product_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`product_ids`)),
  `status` enum('New','Demo','Quotation','Pending','Done','Cancel') NOT NULL DEFAULT 'New',
  `source` varchar(255) DEFAULT NULL,
  `assigned_name` varchar(255) DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `mail_status` tinyint(1) NOT NULL DEFAULT 0,
  `demo_date` date DEFAULT NULL,
  `demo_time` time DEFAULT NULL,
  `demo_mail_status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `user_id`, `name`, `email`, `mobile`, `address`, `purpose`, `product_ids`, `status`, `source`, `assigned_name`, `remarks`, `mail_status`, `demo_date`, `demo_time`, `demo_mail_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'test1', 'irudayan111@gmail.com', '08069451003', '#16, 4th Main Rd, 2nd Block, Dwaraka Nagar, Nagarabhavi,', NULL, '[\"1\",\"2\"]', 'Done', 'Instagram', '4', 'admin', 1, NULL, NULL, NULL, '2025-03-22 04:41:46', '2025-04-07 14:41:42', NULL),
(2, 5, 'test2', 'irudayan111@gmail.com', '08069451003', '#16, 4th Main Rd, 2nd Block, Dwaraka Nagar, Nagarabhavi,', NULL, '[\"1\"]', 'Demo', 'Twitter', '5', 'test', 1, '2025-03-25', '20:09:00', 1, '2025-03-22 04:43:13', '2025-03-31 05:22:23', NULL),
(4, 1, 'test3', 'test@gmail.com', '8760870314', '16 4th Main Road Byraveshwaranagar Naagarabhaavi', 'test@gmail.com', '[\"1\"]', 'Quotation', 'Facebook', '1', 'test@gmail.com', 0, NULL, NULL, 0, '2025-03-27 04:43:37', '2025-03-31 05:13:43', NULL),
(5, 1, 'rajraj', 'irudayan111@gmail.com', '08760870314', 'Visuvasampatti (vill)', 'raj', '[\"2\"]', 'Quotation', 'Twitter', '1', 'raj', 1, NULL, NULL, 0, '2025-03-27 05:50:16', '2025-03-31 05:09:21', NULL),
(6, 5, '12345', 'admin@admin.com', '08069451003', '#16, 4th Main Rd, 2nd Block, Dwaraka Nagar, Nagarabhavi,', '12345', '[\"1\"]', 'Quotation', 'Twitter', '5', '12345', 0, NULL, NULL, 0, '2025-03-27 06:11:24', '2025-03-31 05:19:29', NULL),
(7, 2, 'savaridfsghjk', 'irudayan111@gmail.com', '08760870314', 'Visuvasampatti (vill)', 's', '[\"2\"]', 'Quotation', 'Instagram', '2', 'szvxbcvnm,.', 0, NULL, NULL, 0, '2025-03-27 06:17:41', '2025-03-27 06:53:10', NULL),
(8, 2, 'Savari Irudaya Raj X', 'irudayan111@gmail.com', '8760870314', 'Visuvasampatti (vill)', 'sd', '[\"1\"]', 'Quotation', 'Facebook', '2', 'test', 1, NULL, NULL, 0, '2025-03-27 06:53:52', '2025-04-07 07:26:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lead_product`
--

CREATE TABLE `lead_product` (
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lead_product`
--

INSERT INTO `lead_product` (`lead_id`, `product_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(4, 1),
(5, 2),
(6, 1),
(7, 2),
(8, 1);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_12_092930_create_sessions_table', 1),
(6, '2025_03_12_125610_create_contacts_table', 1),
(7, '2025_03_13_113532_create_leads_table', 1),
(8, '2025_03_22_050915_create_product_categories_table', 2),
(9, '2025_03_21_121836_create_lead_product_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL),
(10, 'role_delete', NULL, NULL, NULL),
(11, 'role_access', NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL),
(17, 'product_management_access', NULL, NULL, NULL),
(18, 'product_category_create', NULL, NULL, NULL),
(19, 'product_category_edit', NULL, NULL, NULL),
(20, 'product_category_show', NULL, NULL, NULL),
(21, 'product_category_delete', NULL, NULL, NULL),
(22, 'product_category_access', NULL, NULL, NULL),
(28, 'product_create', NULL, NULL, NULL),
(29, 'product_edit', NULL, NULL, NULL),
(30, 'product_show', NULL, NULL, NULL),
(31, 'product_delete', NULL, NULL, NULL),
(33, 'catalogue_management_access', NULL, '2025-03-26 11:03:32', NULL),
(38, 'quotation_management_access', NULL, '2025-03-26 11:06:36', NULL),
(39, 'quotation_create', NULL, '2025-03-26 11:17:49', NULL),
(40, 'quotation_edit', NULL, '2025-03-26 11:18:18', NULL),
(41, 'quotation_show', NULL, '2025-03-26 11:20:07', NULL),
(42, 'quotation_delete', NULL, '2025-03-26 11:20:18', NULL),
(43, 'appointment_management_access', NULL, '2025-03-26 11:05:00', NULL),
(44, 'appointment_create', NULL, '2025-03-26 11:21:11', NULL),
(45, 'appointment_edit', NULL, '2025-03-26 11:22:22', NULL),
(46, 'appointment_show', NULL, '2025-03-26 11:22:33', NULL),
(47, 'appointment_delete', NULL, '2025-03-26 11:22:47', NULL),
(48, 'lead_management_access', NULL, '2025-03-26 11:07:08', NULL),
(49, 'lead_create', NULL, '2025-03-26 11:23:14', NULL),
(50, 'lead_edit', NULL, '2025-03-26 11:23:25', NULL),
(51, 'lead_show', NULL, '2025-03-26 11:23:35', NULL),
(52, 'lead_delete', NULL, '2025-03-26 11:23:47', NULL),
(69, 'contact_create', NULL, NULL, NULL),
(70, 'contact_edit', NULL, NULL, NULL),
(71, 'contact_show', NULL, NULL, NULL),
(72, 'contact_delete', NULL, NULL, NULL),
(73, 'contact_management_access', NULL, '2025-03-26 11:01:52', NULL),
(97, 'dashboard_access', NULL, '2025-03-26 11:07:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 33),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 97),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 33),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 97),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22),
(5, 28),
(5, 29),
(5, 30),
(5, 31),
(5, 38),
(5, 39),
(5, 40),
(5, 41),
(5, 42),
(5, 43),
(5, 44),
(5, 45),
(5, 46),
(5, 47),
(5, 48),
(5, 49),
(5, 50),
(5, 51),
(5, 52),
(5, 69),
(5, 70),
(5, 71),
(5, 72),
(5, 73),
(5, 97);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(5,2) NOT NULL,
  `assigned_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `tax`, `assigned_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tally Clould', 'test', 1, 12000.00, 18.00, 'raj', '2025-03-22 02:53:37', '2025-03-22 03:57:42', NULL),
(2, 'busy tally', 'e', 1, 120.00, 4.00, 'savari', '2025-03-22 03:30:01', '2025-03-22 03:57:52', NULL),
(3, 'rahhh', 'aaa', 1, 659.00, 5.00, NULL, '2025-03-22 05:10:16', '2025-03-22 05:10:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'tally', 'tally list', '2025-03-22 02:46:42', '2025-03-22 02:46:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SuperAdmin', NULL, NULL, NULL),
(2, 'Admin', NULL, NULL, NULL),
(5, 'User', '2025-03-26 11:38:25', '2025-03-26 11:38:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(5, 5),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `verified` tinyint(1) DEFAULT 0,
  `verified_at` datetime DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_image`, `email_verified_at`, `approved`, `verified`, `verified_at`, `verification_token`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'superadmin@admin.com', 'profile_images/dVsvhaYsq38G8PJHABqc.png', NULL, 1, 1, '2024-04-02 07:27:41', '', '$2y$10$RCqs6JVBgjzvUz1BsTlT4elREy5PzBqDD0Dg72/p2vLaylET6j/VC', '3H6IeSARa5Ctntq6CpXl3dK3wBJdzICTadjSz4dTyNzVbsSL2PD4AugjpSAA', NULL, '2025-03-27 09:30:54', NULL),
(2, 'Admin', 'admin@admin.com', NULL, NULL, 1, 1, '2024-04-02 07:27:41', '', '$2y$10$RN51r7/CpPFCaS/ZNKvWNO.i16Vn21kZFIvivsBvbvM7cQhSyno1S', NULL, NULL, NULL, NULL),
(4, 'Raj', 'test@gmail.com', NULL, NULL, 1, 1, NULL, NULL, '$2y$10$YWlKa3PZrCOL3LE6D2UpCO36pWhxVIP//U6Vfc17XRyphPloqrwZu', NULL, '2025-03-26 10:18:05', '2025-03-26 10:18:05', NULL),
(5, 'test', 'adminq@admin.com', 'profile_images/ZwOOLmpCb9vEy0SKcKEt.png', NULL, 1, 1, NULL, NULL, '$2y$10$9vCSdUI7qHXC1QbxeLR3reTlrZHvxCR/njbQywIi4Ra3Yd0OZGd66', NULL, '2025-03-26 10:35:44', '2025-03-26 10:36:42', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_product`
--
ALTER TABLE `lead_product`
  ADD PRIMARY KEY (`lead_id`,`product_id`),
  ADD KEY `lead_product_product_id_foreign` (`product_id`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_9655172` (`role_id`),
  ADD KEY `permission_id_fk_9655172` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_9655181` (`user_id`),
  ADD KEY `role_id_fk_9655181` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lead_product`
--
ALTER TABLE `lead_product`
  ADD CONSTRAINT `lead_product_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lead_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_9655172` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_9655172` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
