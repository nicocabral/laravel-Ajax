-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2018 at 01:10 AM
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
-- Database: `rb_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customerid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customercode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `customers` (`id`, `customerid`, `customercode`, `merchant`, `fname`, `lname`, `email`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, '0001', '0001', 'Jeancen Sayoc', 'Sample', 'sample', 'sample@gmail.com', 1, '2018-02-11 04:45:47', '2018-02-11 04:45:47', NULL);

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
(3, '0001', 'sampleCompany Enterprises', NULL, NULL, '2018-02-11 04:45:48', '2018-02-11 04:45:48');

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
(6, '0001', NULL, NULL, NULL, NULL, '2018-02-11 04:45:47', '2018-02-11 04:45:47');

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
(11, '2018_02_11_144642_create_merchant_users_table', 8);

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
(1, NULL, 'Juan Dela Cruz', '1994-01-06', '09177791994', 'juan@gmail.com', '$2y$10$OL1h4oBRp9aNS/jFAok4Ues1A0yQhdZCAeZoulDlnGW6gM36R43hy', 1, 1, 1, 'y2Vklvd5FPsgvegjnVOQo4n61O6OT1napoG1EcF2d6nykY3gqTEqmw4Ff20Q', '2018-02-10 00:46:00', '2018-02-11 07:42:57', NULL),
(2, 3, 'Jeancen Sayoc', '2018-08-27', NULL, 'jeancen@gmail.com', '$2y$10$Z/dWxseAkgHe9sgh8KzhX.0yUEt9Fhg9ofaQcDlm/LaSk8US2xJCa', 2, 1, 1, 'eZPgY1L5i6DDv8WVMmGcYC97jNsykMz03p3dgmJY2wvlCaQ8RrCcwrfKx9w4', '2018-02-10 23:37:18', '2018-02-11 06:32:02', NULL),
(26, 3, 'John Sheet', '2018-01-29', '09177791994', 'sheet@gmail.com', '$2y$10$dZ2U142EwjrxRliw7pj1vug74B0QsfLm1gnqAj9iIHBH77YTkf1WS', 3, 1, 1, 'kG71FLlurrJN721FPRFeoW850vC4DQQ26uPleQGv0bV5m1bGLZeXno3xi3uZ', '2018-02-11 08:16:02', '2018-02-11 15:37:27', NULL),
(29, 3, 'sample', '2018-02-03', '09177791994', 'sample@gmail.com', '$2y$10$SZej5iA62TjcT9j5ZpQZUOUgEsLpPD95.yFiT16jCvl.a7ukzU3Lu', 3, 1, 2, NULL, '2018-02-11 16:03:09', '2018-02-11 16:03:09', NULL),
(30, 3, 'User', '2018-02-10', '09177791994', 'user@gmail.com', '$2y$10$fGAX/oWP3XEF2ccRdeUOr.LsXW4LbiPmzg70PvSplGREU8U5MnPue', 4, 2, 1, '7XJEY0RL8v5E6GIyiEY0lZ1Qr9rAyLHaHo1kC2MbFMjsvUSpJIGPwFgTWCIi', '2018-02-11 16:05:44', '2018-02-11 16:09:47', NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_companies`
--
ALTER TABLE `customer_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_contacts`
--
ALTER TABLE `customer_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
