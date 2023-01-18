-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table alsms.classes
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sy_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Classes';

-- Dumping data for table alsms.classes: ~3 rows (approximately)
INSERT INTO `classes` (`id`, `sy_id`, `program_id`, `teacher_id`, `created_at`, `updated_at`, `created_by`) VALUES
	(6, 7, 2, 10, '2023-01-03 04:12:45', '2023-01-03 04:12:45', 3),
	(7, 7, 1, 10, '2023-01-03 04:30:07', '2023-01-03 04:30:07', 3),
	(8, 7, 5, 10, '2023-01-03 09:46:41', '2023-01-03 09:46:41', 3);

-- Dumping structure for table alsms.enrollment
CREATE TABLE IF NOT EXISTS `enrollment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Enrollment';

-- Dumping data for table alsms.enrollment: ~3 rows (approximately)
INSERT INTO `enrollment` (`id`, `user_id`, `class_id`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
	(15, 8, 6, 'Approved', '2023-01-03 09:06:02', '2023-01-03 09:14:16', 8),
	(17, 8, 7, 'Approved', '2023-01-03 09:36:45', '2023-01-03 09:37:11', 8),
	(18, 16, 6, 'Pending', '2023-01-18 08:03:30', '2023-01-18 08:03:30', 16);

-- Dumping structure for table alsms.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alsms.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table alsms.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alsms.migrations: ~4 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0000_00_00_000000_create_websockets_statistics_entries_table', 1),
	(2, '2014_10_12_000000_create_users_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1);

-- Dumping structure for table alsms.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alsms.password_resets: ~0 rows (approximately)

-- Dumping structure for table alsms.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
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
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `firstname` (`firstname`),
  KEY `middlename` (`middlename`),
  KEY `lastname` (`lastname`),
  KEY `extname` (`extname`),
  KEY `gender` (`gender`),
  KEY `dob` (`dob`),
  KEY `pob` (`pob`),
  KEY `address` (`address`),
  KEY `guardian` (`guardian`),
  KEY `guardian_address` (`guardian_address`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `verified` (`verified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Student Profiles';

-- Dumping data for table alsms.profiles: ~1 rows (approximately)
INSERT INTO `profiles` (`user_id`, `firstname`, `middlename`, `lastname`, `extname`, `gender`, `dob`, `pob`, `address`, `guardian`, `guardian_address`, `verified`, `created_at`, `updated_at`) VALUES
	(8, 'Crisia', 'Dummy', 'Test', NULL, 'Female', '1990-06-13', 'Test', 'test', 'test', 'test', 0, '2022-12-16 08:04:41', '2022-12-16 08:05:49');

-- Dumping structure for table alsms.programs
CREATE TABLE IF NOT EXISTS `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_short` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_long` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Learning programs';

-- Dumping data for table alsms.programs: ~7 rows (approximately)
INSERT INTO `programs` (`id`, `title`, `slug`, `description_short`, `description_long`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
	(1, 'Test Program', 'test_program', 'Short Description for Test Program', 'This is just a test description for Test Program. This is just a test description for Test Program. This is just a test description for Test Program.', 1, '2022-11-13 12:17:30', '2022-11-13 12:49:08', 3),
	(2, 'Test Learning Program 2', 'test_learning_program_2', 'Short Description for Test Program 2', 'This is just a test description for Test Program This is just a test description for Test Program.\r\nThis is just a test description for Test Program. This is just a test description for Test Program', 1, '2022-11-13 12:17:30', '2022-11-13 12:49:29', 3),
	(3, 'Learning Program for Testing Only Learning Program for Testing Only', 'learning_program_for_testing_only_learning_program_for_testing_only', 'Short Description for Test Program 3', 'This is just a test description for Test Program', 1, '2022-11-13 12:17:30', '2022-11-13 12:50:11', 3),
	(4, 'Asdf qweqwe QWqwq', 'test_qwert', 'Short Description for Test Program 4', 'Asdf qweqwe QWqwq Asdf qweqwe QWqwq Asdf qweqwe QWqwq.\r\n\r\nAsdf qweqwe QWqwqAsdf qweqwe QWqwqAsdf qweqwe QWqwqAsdf qweqwe QWqwq Asdf qweqwe QWqwq\r\nAsdf qweqwe QWqwq\r\n\r\nAsdf qweqwe QWqwqAsdf qweqwe QWqwqAsdf qweqwe QWqwqAsdf qweqwe QWqwqAsdf qweqwe QWqwqAsdf qweqwe QWqwqAsdf qweqwe QWqwq.', 1, '2022-11-13 12:17:30', '2022-11-13 13:37:32', 3),
	(5, 'Test', 'test', 'test ra ni', 'test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni test ra ni \n\ntest ra ni test ra ni test ra ni test ra ni test ra ni test ra ni', 1, '2022-12-20 21:08:43', '2022-12-20 21:08:43', 3),
	(6, 'Basic Literacy Program (BLP)', 'basic-literacy-program-blp', 'The Basic Literacy Program (BLP) is a program component of ALS aimed at eradicating illiteracy among OSYA, and in extreme cases, school-aged children, by developing the basic literacy skills of reading, writing, and numeracy.', 'The Basic Literacy Program (BLP) is a program component of ALS aimed at eradicating illiteracy among OSYA, and in extreme cases, school-aged children, by developing the basic literacy skills of reading, writing, and numeracy.', 1, '2023-01-18 04:31:17', '2023-01-18 04:31:17', 3),
	(7, 'Accreditation and Equivalency (A&E)', 'accreditation-and-equivalency-ae', 'The Accreditation and Equivalency (A&E) Program is a program component of ALS aimed at providing an alternative pathway of learning for OSYA who have the basic literacy skills but have not completed the K to 12 basic education mandated by the Philippine Constitution.', 'The Accreditation and Equivalency (A&E) Program is a program component of ALS aimed at providing an alternative pathway of learning for OSYA who have the basic literacy skills but have not completed the K to 12 basic education mandated by the Philippine Constitution. Through this program, school dropouts are able to complete elementary and high school education outside the formal school system.', 1, '2023-01-18 04:32:40', '2023-01-18 04:32:40', 3);

-- Dumping structure for table alsms.sys
CREATE TABLE IF NOT EXISTS `sys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Learning programs';

-- Dumping data for table alsms.sys: ~1 rows (approximately)
INSERT INTO `sys` (`id`, `sy`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
	(7, '2022-2023', 1, '2023-01-02 22:46:09', '2023-01-18 05:01:17', 3);

-- Dumping structure for table alsms.teachers
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `firstname` (`firstname`),
  KEY `middlename` (`middlename`),
  KEY `lastname` (`lastname`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `gender` (`gender`),
  KEY `address` (`address`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alsms.teachers: ~1 rows (approximately)
INSERT INTO `teachers` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `address`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
	(10, 'John', 'Smith', 'Doe', 'Male', 'Bohol', 1, '2023-01-03 02:20:43', '2023-01-03 02:20:43', 3);

-- Dumping structure for table alsms.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alsms.users: ~10 rows (approximately)
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
	(17, 'Jolina', 'jolina', 'jolina@test.com', NULL, '$2y$10$0ZTOPtmE5DJKQB2xaR3/Xuyg3cO9SI8CccJh16z//WGj6EXkEn0i.', 'student', NULL, NULL, '2023-01-18 00:06:15', '2023-01-18 00:06:15');

-- Dumping structure for table alsms.websockets_statistics_entries
CREATE TABLE IF NOT EXISTS `websockets_statistics_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alsms.websockets_statistics_entries: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
