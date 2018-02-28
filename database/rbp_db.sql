-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2018 at 01:48 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(10) UNSIGNED NOT NULL,
  `contractid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customerid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `subtotal` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL,
  `paymentitem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contractfrequency` int(11) NOT NULL,
  `retryprocessing` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customerid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customercode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchantid` int(11) DEFAULT NULL,
  `merchant` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customerid`, `customercode`, `merchantid`, `merchant`, `fname`, `lname`, `email`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, '000001', '12282274', 3, 'Jeancen Sayoc', 'Test update', 'Test', 'Test@gmail.com', 1, '2018-02-11 22:03:17', '2018-02-13 02:22:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_companies`
--

CREATE TABLE `customer_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `customerid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_companies`
--

INSERT INTO `customer_companies` (`id`, `customerid`, `name`, `title`, `department`, `created_at`, `updated_at`) VALUES
(4, '000001', 'Test company', NULL, NULL, '2018-02-11 22:03:17', '2018-02-13 02:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `customer_contacts`
--

CREATE TABLE `customer_contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `customerid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_contacts`
--

INSERT INTO `customer_contacts` (`id`, `customerid`, `d_phone`, `e_phone`, `m_phone`, `fax`, `created_at`, `updated_at`) VALUES
(8, '000001', '1234567890', '1234567', '123456', '1234', '2018-02-11 22:03:17', '2018-02-13 02:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `userid`, `created_at`, `updated_at`) VALUES
(1, 26, '2018-02-12 01:12:34', '2018-02-12 01:12:34'),
(2, 26, '2018-02-12 02:05:45', '2018-02-12 02:05:45'),
(3, 26, '2018-02-12 02:31:43', '2018-02-12 02:31:43'),
(4, 1, '2018-02-12 02:33:00', '2018-02-12 02:33:00'),
(5, 2, '2018-02-12 02:34:06', '2018-02-12 02:34:06'),
(6, 1, '2018-02-12 02:34:54', '2018-02-12 02:34:54'),
(7, 26, '2018-02-12 19:13:45', '2018-02-12 19:13:45'),
(8, 26, '2018-02-12 19:19:24', '2018-02-12 19:19:24'),
(9, 26, '2018-02-12 19:30:33', '2018-02-12 19:30:33'),
(10, 26, '2018-02-12 21:30:34', '2018-02-12 21:30:34'),
(11, 26, '2018-02-13 04:08:48', '2018-02-13 04:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `userid`, `name`, `dob`, `contact`, `email`, `password`, `role`, `permission`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, 'Jeancen Sayoc', '2018-08-27', '09263589958', 'jeancen@gmail.com', '$2y$10$5JDdZI3Vb3h.aYbqkA2/n.VW.SPFfiSIRzV5Wv6aoc7qiv1FBXI8C', 2, 1, 1, '2018-02-10 23:37:12', '2018-02-11 01:27:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merchant_users`
--

CREATE TABLE `merchant_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `locationid` int(11) DEFAULT NULL,
  `location_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branchid` int(11) DEFAULT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_users`
--

INSERT INTO `merchant_users` (`id`, `userid`, `locationid`, `location_name`, `branchid`, `branch_name`, `created_at`, `updated_at`) VALUES
(1, 26, NULL, NULL, NULL, NULL, '2018-02-11 08:16:02', '2018-02-11 08:16:02'),
(4, 29, NULL, NULL, NULL, NULL, '2018-02-11 16:03:09', '2018-02-11 16:03:09'),
(5, 30, NULL, NULL, NULL, NULL, '2018-02-11 16:05:44', '2018-02-11 16:05:44');

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
(2, '2018_02_10_035852_create_roles_table', 2),
(3, '2018_02_10_065201_create_merchants_table', 3),
(4, '2018_02_10_065737_create_permissions_table', 4),
(5, '2018_02_10_154513_create_security_questions_table', 5),
(6, '2018_02_11_013406_create_customers_table', 6),
(7, '2018_02_11_013944_create_customer_contacts_table', 7),
(8, '2018_02_11_014257_create_customer_contracts_table', 7),
(11, '2018_02_11_144642_create_merchant_users_table', 8),
(12, '2018_02_12_072903_create_contracts_table', 9),
(13, '2018_02_12_082300_create_logs_table', 10),
(14, '2018_02_12_091357_create_settings_table', 11),
(15, '2018_02_13_082515_create_user_logs_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permissionid` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `permissionid`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 3, 1, 'Admin', '2018-02-10 00:06:30', '2018-02-10 00:06:30', NULL),
(12, 4, 2, 'Read Only', '2018-02-10 00:45:26', '2018-02-10 00:45:26', NULL),
(13, 4, 3, 'Report Only', '2018-02-10 00:45:26', '2018-02-10 00:45:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `roleid` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roleid`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 3, 'Admin', '2018-02-10 00:06:30', '2018-02-10 00:06:30', NULL),
(28, 4, 'User', '2018-02-10 00:45:26', '2018-02-10 00:45:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `security_questions`
--

CREATE TABLE `security_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `security_questions`
--

INSERT INTO `security_questions` (`id`, `userid`, `question`, `answer`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'What is my favorite color', 'Banana', 1, '2018-02-10 08:27:33', '2018-02-10 17:18:45', NULL),
(4, 2, 'What is my favorite color', 'Apple', 1, '2018-02-11 01:27:37', '2018-02-11 01:27:37', NULL),
(5, 26, 'Who is who', 'Me', 1, '2018-02-11 15:39:36', '2018-02-11 15:39:36', NULL),
(6, 30, 'Batman', 'Robin', 1, '2018-02-11 16:09:57', '2018-02-11 16:09:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `merchantid` int(11) NOT NULL,
  `defaultnoofmaxfailures` int(11) NOT NULL,
  `defaultnoofmaxintervals` int(11) NOT NULL,
  `defaultcoderesult` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `merchantid` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `permission` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `merchantid`, `name`, `dob`, `contact`, `email`, `password`, `role`, `permission`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Juan Dela Cruz', '1994-01-06', '09177791994', 'juan@gmail.com', '$2y$10$OL1h4oBRp9aNS/jFAok4Ues1A0yQhdZCAeZoulDlnGW6gM36R43hy', 1, 1, 1, 'hnaaiCYv1BzwCrwMRWFyMLclu9YhaUWINb8UDNCsPQ3oaZzc3EB4qRUzez6E', '2018-02-10 00:46:00', '2018-02-11 07:42:57', NULL),
(2, 3, 'Jeancen Sayoc', '2018-08-27', NULL, 'jeancen@gmail.com', '$2y$10$Z/dWxseAkgHe9sgh8KzhX.0yUEt9Fhg9ofaQcDlm/LaSk8US2xJCa', 2, 1, 1, 'gNnz0YoYX20eRYx3kuXMtwIDjp43PV9hLAyGp5Y87y7YRukvbvjg9r7zyJHl', '2018-02-10 23:37:18', '2018-02-11 06:32:02', NULL),
(26, 3, 'John Sheet', '2018-01-29', '09177791994', 'sheet@gmail.com', '$2y$10$gbz4Z7uZ1nxWhOLlKNsvl.N62dBUQwRSyJVr7i3C5pJuyypQd.JK6', 3, 1, 1, '8c6pvVI9n1FAEj9GBM6bRZs79LDG4rxyyvOAN6WgEvmGRWPU1ZuRRN9Lw1yv', '2018-02-11 08:16:02', '2018-02-12 02:32:07', NULL),
(29, 3, 'sample', '2018-02-03', '09177791994', 'sample@gmail.com', '$2y$10$vOaBX49cJqzBg/yUv/wZDuwyh7z7/DSlfIomikJY88v4DnkPh0hEa', 3, 1, 2, NULL, '2018-02-11 16:03:09', '2018-02-12 21:21:32', NULL),
(30, 3, 'User', '2018-02-10', '09177791994', 'user@gmail.com', '$2y$10$9J9GHyIs8cRg2C1zEKOBYutfD1vhz8ZJXAMXSC.1.SvnK19e6mQFK', 4, 2, 1, 'vsRABXfyuuX57jbs95bkStI9HCP6Ytj2DILboUCbxxD9FaW4IsziBf5dimu9', '2018-02-11 16:05:44', '2018-02-11 19:34:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `others` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `userid`, `user_name`, `action`, `details`, `others`, `created_at`, `updated_at`) VALUES
(4, 26, 'John Sheet', 'update', 'UpdateTest update Test', '{\"regexp\":false,\"languages\":[\"en-us\",\"en\"],\"browser\":\"Chrome\",\"browser_version\":\"64.0.3282.140\",\"platform\":\"Windows\",\"platform_version\":\"10.0\",\"device\":\"WebKit\",\"device_type\":\"Desktop\",\"my_ip\":\"127.0.0.1\"}', '2018-02-13 02:22:17', '2018-02-13 02:22:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customerid_unique` (`customerid`),
  ADD UNIQUE KEY `customers_customercode_unique` (`customercode`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `customer_companies`
--
ALTER TABLE `customer_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_contacts`
--
ALTER TABLE `customer_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchants_email_unique` (`email`);

--
-- Indexes for table `merchant_users`
--
ALTER TABLE `merchant_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_questions`
--
ALTER TABLE `security_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer_companies`
--
ALTER TABLE `customer_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_contacts`
--
ALTER TABLE `customer_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `merchant_users`
--
ALTER TABLE `merchant_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `security_questions`
--
ALTER TABLE `security_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
