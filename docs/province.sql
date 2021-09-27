-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 27, 2021 at 07:58 AM
-- Server version: 5.7.28
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `his`
--

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `province_code` int(10) UNSIGNED NOT NULL,
  `province_name_english` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_name_khmer` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`province_code`),
  KEY `provinces_created_by_foreign` (`created_by`),
  KEY `provinces_updated_by_foreign` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`province_code`, `province_name_english`, `province_name_khmer`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Banteay Meanchey', 'បន្ទាយមានជ័យ', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(2, 'Battambang', 'បាត់ដំបង', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(3, 'Kampong Cham', 'កំពង់ចាម', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(4, 'Kampong Chhnang', 'កំពង់ឆ្នាំង', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(5, 'Kampong Speu', 'កំពង់ស្ពឺ', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(6, 'Kampong Thom', 'កំពង់ធំ', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(7, 'Kampot', 'កំពត', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(8, 'Kandal', 'កណ្ដាល', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(9, 'Koh Kong', 'កោះកុង', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(10, 'Kratie', 'ក្រចេះ', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(11, 'Mondul Kiri', 'មណ្ឌលគិរី', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(12, 'Phnom Penh', 'ភ្នំពេញ', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(13, 'Preah Vihear', 'ព្រះវិហារ', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(14, 'Prey Veng', 'ព្រៃវែង', 1, 1, NULL, '2019-10-16 16:48:38', '2019-10-16 16:48:38'),
(15, 'Pursat', 'ពោធិ៍សាត់', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(16, 'Ratanakiri', 'រតនគិរី', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(17, 'Siemreap', 'សៀមរាប', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(18, 'Preah Sihanouk', 'ព្រះសីហនុ', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(19, 'Stung Treng', 'ស្ទឹងត្រែង', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(20, 'Svay Rieng', 'ស្វាយរៀង', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(21, 'Takeo', 'តាកែវ', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(22, 'Oddar Meanchey', 'ឧត្តរមានជ័យ', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(23, 'Kep', 'កែប', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(24, 'Pailin', 'ប៉ៃលិន', 1, 1, NULL, '2019-10-16 16:48:39', '2019-10-16 16:48:39'),
(25, 'Tbong Khmum', 'ត្បូងឃ្មុំ', 1, 1, NULL, '2019-10-16 16:48:40', '2019-10-16 16:48:40');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `provinces`
--
ALTER TABLE `provinces`
  ADD CONSTRAINT `provinces_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provinces_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
