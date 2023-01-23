-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 12:05 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `clc_id` int(11) NOT NULL,
  `class_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Classes' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `clc`
--

CREATE TABLE `clc` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clc_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clc`
--

INSERT INTO `clc` (`id`, `name`, `address`, `clc_status`) VALUES
(1, 'BLC', 'Balilihan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Enrollment' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0000_00_00_000000_create_websockets_statistics_entries_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1);

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
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gl_upon_registration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drop_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attended_als` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `als_program` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `literacy_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_year_attended` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_completed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_inc_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modalities` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Student Profiles';

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`user_id`, `firstname`, `middlename`, `lastname`, `extname`, `gender`, `dob`, `pob`, `address`, `guardian`, `guardian_address`, `gl_upon_registration`, `drop_reason`, `attended_als`, `als_program`, `literacy_level`, `program_year_attended`, `program_completed`, `program_inc_reason`, `modalities`, `verified`, `created_at`, `updated_at`) VALUES
(8, 'Crisia', 'Dummy', 'Test', NULL, 'Female', '1990-06-13', 'Test', 'test', 'test', 'test', 'G-4', 'Hago skwela', 'YES', 'baw unsa ra to hahaha', 'Basic', '2019', 'NO', 'hago as usual', '[null,\"Online\",\"Face to Face\",\"Modular Learning\",\"Radio\",\"Others\"]', 1, '2022-12-16 08:04:41', '2023-01-24 06:54:15'),
(16, 'Christine', 'Christine', 'Christine', NULL, 'Female', '2023-01-18', 'asd', 'asd', 'asd', 'asd', 'G-3', NULL, 'NO', NULL, NULL, NULL, NULL, NULL, '[\"Modular Learning\",\"Online\"]', 1, '2023-01-24 06:53:33', '2023-01-24 06:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `title` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_short` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_long` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Learning programs';

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `title`, `slug`, `description_short`, `description_long`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(6, 'Basic Literacy Program (BLP)', 'basic-literacy-program-blp', 'The Basic Literacy Program (BLP) is a program component of ALS aimed at eradicating illiteracy among OSYA, and in extreme cases, school-aged children, by developing the basic literacy skills of reading, writing, and numeracy.', 'The Basic Literacy Program (BLP) is a program component of ALS aimed at eradicating illiteracy among OSYA, and in extreme cases, school-aged children, by developing the basic literacy skills of reading, writing, and numeracy.', 1, '2023-01-18 04:31:17', '2023-01-18 04:31:17', 3),
(7, 'Accreditation and Equivalency (A&E)', 'accreditation-and-equivalency-ae', 'The Accreditation and Equivalency (A&E) Program is a program component of ALS aimed at providing an alternative pathway of learning for OSYA who have the basic literacy skills but have not completed the K to 12 basic education mandated by the Philippine Constitution.', 'The Accreditation and Equivalency (A&E) Program is a program component of ALS aimed at providing an alternative pathway of learning for OSYA who have the basic literacy skills but have not completed the K to 12 basic education mandated by the Philippine Constitution. Through this program, school dropouts are able to complete elementary and high school education outside the formal school system.', 1, '2023-01-18 04:32:40', '2023-01-18 04:32:40', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sys`
--

CREATE TABLE `sys` (
  `id` int(11) NOT NULL,
  `sy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Learning programs' ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sys`
--

INSERT INTO `sys` (`id`, `sy`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(7, '2022-2023', 1, '2023-01-02 22:46:09', '2023-01-18 05:01:17', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `address`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(10, 'John', 'Smith', 'Doe', 'Male', 'Bohol', 1, '2023-01-03 02:20:43', '2023-01-03 02:20:43', 3),
(11, 'Ada', 'Augusta', 'Lovelace', 'Female', 'Philippines', 1, '2023-01-24 03:35:01', '2023-01-24 03:35:01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `user_type`, `teacher_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', NULL, NULL, '$2y$10$5IaNdp/3SBqzN7x7XBFvR.0nEkVqRDlm06tau4W/tkxA3jRj7zqTy', 'super_admin', NULL, NULL, '2022-10-23 06:07:28', '2022-10-23 06:07:28'),
(3, 'Admin Test', 'admin', NULL, NULL, '$2y$10$WEovje8Q.4j14bY3zv5nleRZG9euxfm9mJMofqjSi64IfduNNfbn2', 'admin', NULL, NULL, '2022-10-23 08:44:55', '2022-10-23 08:44:55'),
(8, 'Crisia B', 'crisia', NULL, NULL, '$2y$10$o9N6nYf8gEE3iW2q1T02JufnpKqTIy/z3Crz.jz6ItFjPHiV35XNC', 'student', NULL, NULL, '2023-01-02 18:15:07', '2023-01-02 18:15:07'),
(10, 'Student One', 'student1', 'student1@test.com', NULL, '$2y$10$CvTlId3R4vRrY02.36554ub0auq9843kI.3qh2igynJlPb4qEH/Ke', 'student', NULL, NULL, '2022-11-13 05:53:03', '2022-11-13 05:53:03'),
(11, 'Student Two', 'student2', NULL, NULL, '$2y$10$VhFV6gt0rqZFYojdqWJeI.CI9ifS4.Secp4YYKLbe0/e74msZnjQ6', 'student', NULL, NULL, '2023-01-02 18:15:08', '2023-01-02 18:15:09'),
(12, 'Carl', 'admin1', 'admin@test.com', NULL, '$2y$10$M.JsISpef0r3DRloueN5weUjrJpv0sAo8PeL6.pNbpRuGae5cA1.a', 'student', NULL, NULL, '2022-11-23 14:46:31', '2022-11-23 14:46:31'),
(13, 'Ceejay C', 'ceejay', NULL, NULL, '$2y$10$xyXfNA7raYltpI1EmKMGquzsHru/ZnfRWN7.btOKmBE7vnowcvGwS', 'student', NULL, NULL, '2023-01-02 18:15:09', '2023-01-02 18:15:10'),
(15, 'John Smith Doe', 'johndoe', NULL, NULL, '$2y$10$dYVbkIGXhadbyD4v2vWv2ObUPyUDH3S8Zpkq6rMX09PRGLylZ7Gam', 'teacher', 10, NULL, '2023-01-02 18:20:43', '2023-01-17 22:23:18'),
(16, 'Christine', 'christine', 'christine@test.com', NULL, '$2y$10$DhLYFWiavFT3LVjgiglz6.p5CRZVuN9huab0smIZztaQAXjag9mCS', 'student', NULL, NULL, '2023-01-18 00:01:31', '2023-01-18 00:01:31'),
(17, 'Jolina', 'jolina', 'jolina@test.com', NULL, '$2y$10$0ZTOPtmE5DJKQB2xaR3/Xuyg3cO9SI8CccJh16z//WGj6EXkEn0i.', 'student', NULL, NULL, '2023-01-18 00:06:15', '2023-01-18 00:06:15'),
(18, 'Ada Augusta Lovelace', 'adalovelace', NULL, NULL, '$2y$10$/tONew2Lx7QhehOyJzuUZuWUbmLblLOpuMTaCexYm7Cr7G9tgA9Sy', 'teacher', 11, NULL, '2023-01-23 19:35:01', '2023-01-23 19:35:01'),
(19, 'xzc zxc zxc', 'xzczxc', NULL, NULL, '$2y$10$LURoMWLU3BX7AFnERASs5OzRd/o1RvqXDnqDnWDWwdYC5I65KLKiO', 'teacher', 12, NULL, '2023-01-23 22:43:48', '2023-01-23 22:43:48'),
(20, 'zxc zxc zxc', 'zxczxc', NULL, NULL, '$2y$10$XsmABjfd28uycYt/CwMzW.cDhzZP5jjMKy6Vfd5rxeDJLjNXQH2i.', 'teacher', 13, NULL, '2023-01-23 22:43:57', '2023-01-23 22:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `clc`
--
ALTER TABLE `clc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `middlename` (`middlename`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `extname` (`extname`),
  ADD KEY `gender` (`gender`),
  ADD KEY `dob` (`dob`),
  ADD KEY `pob` (`pob`),
  ADD KEY `address` (`address`),
  ADD KEY `guardian` (`guardian`),
  ADD KEY `guardian_address` (`guardian_address`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `verified` (`verified`),
  ADD KEY `gl_upon_registration` (`gl_upon_registration`),
  ADD KEY `drop_reason` (`drop_reason`),
  ADD KEY `attended_als` (`attended_als`),
  ADD KEY `als_program` (`als_program`),
  ADD KEY `literacy_level` (`literacy_level`),
  ADD KEY `program_year_attended` (`program_year_attended`),
  ADD KEY `program_completed` (`program_completed`),
  ADD KEY `program_inc_reason` (`program_inc_reason`),
  ADD KEY `modalities` (`modalities`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys`
--
ALTER TABLE `sys`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `middlename` (`middlename`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `gender` (`gender`),
  ADD KEY `address` (`address`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `clc`
--
ALTER TABLE `clc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sys`
--
ALTER TABLE `sys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
