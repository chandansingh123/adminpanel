-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2018 at 05:32 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saralnilami`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `activity_date` timestamp NULL DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `description`, `activity_date`, `file_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Godeko', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2018-07-12 18:15:00', '403996_1541482459.jpg', 1, '2018-07-12 00:16:43', '2018-11-05 23:49:19'),
(2, 'Water Supply', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2018-07-17 18:15:00', '505506_1541482384.jpg', 1, '2018-07-12 00:17:29', '2018-11-05 23:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `bid_quantity` int(11) NOT NULL,
  `bid_price` double(8,2) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `confirmed_date` timestamp NULL DEFAULT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `product_id`, `customer_id`, `bid_quantity`, `bid_price`, `total_price`, `confirmed_date`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 45, 2000.00, 90000.00, NULL, NULL, 1, '2018-11-05 05:14:03', '2018-11-05 05:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `bid_histories`
--

CREATE TABLE `bid_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `bid_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `bid_quantity` int(11) NOT NULL,
  `bid_price` double(8,2) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `confirmed_date` timestamp NULL DEFAULT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bid_histories`
--

INSERT INTO `bid_histories` (`id`, `bid_id`, `product_id`, `customer_id`, `bid_quantity`, `bid_price`, `total_price`, `confirmed_date`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 45, 2000.00, 90000.00, NULL, NULL, 1, '2018-11-06 04:10:01', '2018-11-06 04:10:01'),
(2, 1, 2, 3, 45, 2000.00, 90000.00, NULL, NULL, 1, '2018-11-06 04:10:31', '2018-11-06 04:10:31'),
(3, 1, 2, 3, 45, 2000.00, 90000.00, NULL, NULL, 1, '2018-11-06 04:13:17', '2018-11-06 04:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `code`, `first_name`, `last_name`, `address`, `phone`, `email`, `password`, `terms`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'VPU584', 'Adrienn', 'Bromage', 'kathmandu', '1234567890', 'admin@admin.com', '$2y$10$CVNE8VALzGpcQTz8MbWWWeUdehWWEEjcJz84HmcADqUQ4tk1r.ZxK', 1, 1, NULL, '2018-07-12 00:20:02', '2018-07-12 00:20:02'),
(3, 'ITY027', 'Anil', 'Baniya', 'Nepal', '9843777152', 'anil@gmail.com', '$2y$10$U3CAF/tj1kx9YPgOKA1ks.BpFcU1lBdL64lG1rhRwHW2FUcqIPEkS', 1, 1, 'GiCaK01vjpWsZBJAxImEsfq4KKSjw8tt3NjC2vfZo3YBzzurzgVOnHUgq1Ry', '2018-11-05 01:23:10', '2018-11-05 01:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `description`, `file_name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Akbare Khursani', 'Dalle Khursani (round chili) is one of the hottest chilies found in the world. It is also commonly called Akbare khursani. There is another variety super hot chili commonly found in Nepal called Jeere Khursani,', '293404_1542017118.jpg', 1, '2018-07-12 00:15:59', '2018-11-12 05:29:18'),
(4, 'Dalle Khursani Plantation', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '851342_1542020947.jpg', 1, '2018-07-12 00:18:11', '2018-11-12 05:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `file_name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'test', 'This is test', '462838_1541408832.jpg', 1, '2018-11-05 03:14:33', '2018-11-05 03:22:12'),
(4, 'test2', 'test2 description', '444902_1541408717.jpg', 1, '2018-11-05 03:20:17', '2018-11-05 03:20:17'),
(5, 'test3', 'test3 description', '809984_1541408868.jpg', 1, '2018-11-05 03:22:48', '2018-11-05 03:22:48'),
(6, 'test4', 'test4 description', '710303_1541408896.jpg', 1, '2018-11-05 03:23:16', '2018-11-05 03:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ram', 'Sharma', '446111_1541488576.', 1, '2018-07-12 00:11:03', '2018-11-06 01:31:16'),
(2, 'Sherief', 'Sharma', '205694_1541489577.png', 1, '2018-07-12 00:11:29', '2018-11-06 01:47:57'),
(3, 'Ram Chandra', 'Praja', '995341_1541489675.jpg', 1, '2018-11-06 01:49:35', '2018-11-06 01:49:35'),
(4, 'Mrs', 'Praja', '780530_1541489695.png', 1, '2018-11-06 01:49:55', '2018-11-06 01:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_21_093102_create_pages_table', 1),
(4, '2018_05_21_093300_create_items_table', 1),
(5, '2018_05_21_093449_create_products_table', 1),
(6, '2018_05_21_093646_create_activities_table', 1),
(7, '2018_05_21_093723_create_members_table', 1),
(8, '2018_05_21_094020_create_galleries_table', 1),
(9, '2018_05_21_094039_create_customers_table', 1),
(10, '2018_05_21_094058_create_bids_table', 1),
(11, '2018_05_24_181440_create_top_bids_table', 1),
(12, '2018_06_22_161628_create_product_clearing_prices_table', 1),
(13, '2018_06_25_161240_create_product_histories_table', 1),
(14, '2018_06_25_161254_create_bid_histories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, '2018-07-02 10:41:06', NULL),
(2, 'Terms and Conditions', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, '2018-07-02 10:41:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `item_id` int(10) UNSIGNED NOT NULL,
  `delivery_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `closed_date` timestamp NULL DEFAULT NULL,
  `delivery_place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_quantity` int(11) NOT NULL,
  `min_reserved_price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `item_id`, `delivery_date`, `closed_date`, `delivery_place`, `offer_quantity`, `min_reserved_price`, `status`, `created_at`, `updated_at`) VALUES
(2, 'test4-item', NULL, 4, '2018-11-12 18:15:00', '2018-11-19 18:15:00', NULL, 45, 1000, 1, '2018-11-05 05:13:16', '2018-11-06 06:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_clearing_prices`
--

CREATE TABLE `product_clearing_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `clearing_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_clearing_prices`
--

INSERT INTO `product_clearing_prices` (`id`, `product_id`, `clearing_price`, `created_at`, `updated_at`) VALUES
(3, 2, 1000.00, '2018-11-05 05:13:16', '2018-11-05 05:13:16'),
(4, 2, 1000.00, '2018-11-06 06:09:23', '2018-11-06 06:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_histories`
--

CREATE TABLE `product_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `item_id` int(10) UNSIGNED NOT NULL,
  `delivery_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `closed_date` timestamp NULL DEFAULT NULL,
  `delivery_place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_quantity` int(11) NOT NULL,
  `min_reserved_price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_histories`
--

INSERT INTO `product_histories` (`id`, `product_id`, `name`, `description`, `item_id`, `delivery_date`, `closed_date`, `delivery_place`, `offer_quantity`, `min_reserved_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Organic Akabare Chilly', NULL, 1, '2018-08-15 18:15:00', '2018-09-28 18:15:00', NULL, 200, 300, 1, '2018-07-12 00:08:48', '2018-07-12 00:08:48'),
(2, 1, 'Organic Akabare Chilly', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 1, '2018-08-15 18:15:00', '2018-09-28 18:15:00', NULL, 200, 300, 1, '2018-07-12 00:20:39', '2018-07-12 00:20:39'),
(3, 2, 'test4-item', NULL, 6, '2018-11-12 18:15:00', '2018-11-19 18:15:00', NULL, 45, 1000, 1, '2018-11-05 05:13:16', '2018-11-05 05:13:16'),
(4, 2, 'test4-item', NULL, 4, '2018-11-12 18:15:00', '2018-11-19 18:15:00', NULL, 45, 1000, 1, '2018-11-06 06:09:23', '2018-11-06 06:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `top_bids`
--

CREATE TABLE `top_bids` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Krishna', 'Timilsina', 'admin@admin.com', 'nChfeuVis0', '$2y$10$418LUf7EeJMJ7I.xGClpq.IQU7U0xkftFvAXVdGQDRn7Y/ETT7Rhi', 1, '6pQzxvkwosZQFZwHSyGvnvlXGlpLC8jWAOJVHO240VD4etObNObCLnDPZnNj', '2018-07-02 10:41:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_bids_products` (`product_id`),
  ADD KEY `FK_bids_customers` (`customer_id`);

--
-- Indexes for table `bid_histories`
--
ALTER TABLE `bid_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_products_items` (`item_id`);

--
-- Indexes for table `product_clearing_prices`
--
ALTER TABLE `product_clearing_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_bids_products` (`product_id`);

--
-- Indexes for table `product_histories`
--
ALTER TABLE `product_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_bids`
--
ALTER TABLE `top_bids`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bid_histories`
--
ALTER TABLE `bid_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_clearing_prices`
--
ALTER TABLE `product_clearing_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_histories`
--
ALTER TABLE `product_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `top_bids`
--
ALTER TABLE `top_bids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bids_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_clearing_prices`
--
ALTER TABLE `product_clearing_prices`
  ADD CONSTRAINT `product_clearing_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
