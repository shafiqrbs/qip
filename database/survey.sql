-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 08, 2022 at 06:06 AM
-- Server version: 8.0.30-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_10_28_114250_create_configurations_table', 1),
(24, '2022_01_13_152014_create_organizations_table', 2),
(25, '2022_01_15_145826_create_surveys_table', 2),
(27, '2022_01_15_145826_create_survey_organization_table', 3),
(28, '2022_01_13_152014_create_item_table', 4),
(33, '2014_10_12_000000_create_users_table', 6),
(34, '2022_01_16_112311_create_survey_results_table', 7),
(35, '2022_01_15_145826_create_survey_organization_person_table', 8),
(36, '2021_10_31_161137_create_permission_tables', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(13, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 2),
(12, 'App\\Models\\User', 3),
(14, 'App\\Models\\User', 9),
(12, 'App\\Models\\User', 10),
(13, 'App\\Models\\User', 11),
(12, 'App\\Models\\User', 12),
(12, 'App\\Models\\User', 13),
(14, 'App\\Models\\User', 14),
(12, 'App\\Models\\User', 15),
(12, 'App\\Models\\User', 16),
(13, 'App\\Models\\User', 17),
(14, 'App\\Models\\User', 18),
(12, 'App\\Models\\User', 19),
(12, 'App\\Models\\User', 20),
(15, 'App\\Models\\User', 21),
(12, 'App\\Models\\User', 22),
(15, 'App\\Models\\User', 23),
(12, 'App\\Models\\User', 24),
(15, 'App\\Models\\User', 24),
(17, 'App\\Models\\User', 26);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard-graph', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(2, 'organization-list', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(3, 'organization-create', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(4, 'organization-edit', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(5, 'organization-delete', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(6, 'survey-list', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(7, 'survey-create', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(8, 'survey-edit', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(9, 'survey-calendar', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(10, 'survey-delete', 'web', '2022-01-26 08:53:58', '2022-01-26 08:53:58'),
(11, 'item-list', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(12, 'item-create', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(13, 'item-edit', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(14, 'item-delete', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(15, 'result-list', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(16, 'result-create', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(17, 'result-edit', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(18, 'result-download', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(19, 'result-delete', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(20, 'user-list', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(21, 'user-create', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(22, 'user-edit', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(23, 'user-delete', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(24, 'configuration-edit', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(25, 'role-list', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(26, 'role-create', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(27, 'role-edit', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59'),
(28, 'role-delete', 'web', '2022-01-26 08:53:59', '2022-01-26 08:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_configuration`
--

CREATE TABLE `pos_configuration` (
  `id` bigint UNSIGNED NOT NULL,
  `language` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT 'active = 1, inactive = 0',
  `created_by` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_configuration`
--

INSERT INTO `pos_configuration` (`id`, `language`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'en', 1, '1', '21', '2022-01-20 10:28:34', '2022-06-15 06:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(12, 'ORGANIZATION_ADMIN', 'web', '2022-01-26 10:31:13', '2022-03-03 05:49:02'),
(13, 'ORGANIZATION_OPERATOR', 'web', '2022-01-26 10:32:13', '2022-03-03 05:48:49'),
(14, 'ORGANIZATION_REPORTER', 'web', '2022-01-26 10:32:56', '2022-03-03 05:48:24'),
(15, 'ADMINISTRATOR', 'web', '2022-03-02 06:13:49', '2022-03-03 05:37:32'),
(16, 'ADMIN_REPORTER', 'web', '2022-03-03 05:35:36', '2022-03-03 05:35:36'),
(17, 'ADMIN_OPERATOR', 'web', '2022-03-03 05:36:36', '2022-03-03 05:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 12),
(6, 12),
(9, 12),
(15, 12),
(18, 12),
(20, 12),
(22, 12),
(24, 12),
(2, 13),
(3, 13),
(4, 13),
(5, 13),
(6, 13),
(7, 13),
(8, 13),
(9, 13),
(10, 13),
(11, 13),
(12, 13),
(13, 13),
(14, 13),
(24, 13),
(1, 14),
(15, 14),
(18, 14),
(24, 14),
(1, 15),
(2, 15),
(3, 15),
(4, 15),
(5, 15),
(6, 15),
(7, 15),
(8, 15),
(9, 15),
(10, 15),
(11, 15),
(12, 15),
(13, 15),
(14, 15),
(15, 15),
(16, 15),
(17, 15),
(18, 15),
(19, 15),
(20, 15),
(21, 15),
(22, 15),
(23, 15),
(24, 15),
(25, 15),
(26, 15),
(27, 15),
(28, 15),
(1, 16),
(15, 16),
(18, 16),
(2, 17),
(3, 17),
(4, 17),
(6, 17),
(7, 17),
(8, 17),
(9, 17),
(11, 17),
(12, 17),
(13, 17);

-- --------------------------------------------------------

--
-- Table structure for table `sur_item`
--

CREATE TABLE `sur_item` (
  `id` bigint UNSIGNED NOT NULL,
  `survey_id` bigint UNSIGNED DEFAULT NULL,
  `itemtexten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itemtextbn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itemvalueen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itemvaluebn` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oredring` int DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT 'active = 1, inactive = 0',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sur_item`
--

INSERT INTO `sur_item` (`id`, `survey_id`, `itemtexten`, `itemtextbn`, `itemvalueen`, `itemvaluebn`, `color_code`, `oredring`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 2, 'Very Good', 'খুব ভালো', 'Very Good', 'খুব ভালো', 'ff0000', NULL, 1, 1, 21, '2022-01-17 11:20:13', '2022-03-03 11:08:49'),
(3, 2, 'Good', 'ভালো', 'Good', 'ভালো', '92d14f', NULL, 1, 1, 2, '2022-01-17 11:44:41', '2022-02-02 16:37:51'),
(4, 2, 'Satisfactory', 'সন্তোষজনক', 'Bad , Very Bad', 'সন্তোষজনক ,  খারাপ ,খুব খারাপ', '99ff32', NULL, 1, 1, 2, '2022-01-18 06:47:06', '2022-01-18 06:50:12'),
(6, 2, 'Bad', 'খারাপ', 'Satisfactory , Bad , Bad', 'সন্তোষজনক , খারাপ ,খারাপ', 'ffc404', NULL, 1, 1, 2, '2022-01-18 06:49:20', '2022-01-31 16:55:15'),
(12, 2, 'Very Bad', 'খুব খারাপ', 'Very Bad', 'খুব খারাপ', 'ec4235', NULL, 1, 2, 21, '2022-01-31 16:51:53', '2022-03-02 12:02:18'),
(13, 5, 'Very Good', 'Very Good', NULL, NULL, '287e3f', 1, 1, 2, 21, '2022-02-10 11:32:46', '2022-03-03 10:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `sur_organization`
--

CREATE TABLE `sur_organization` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT 'active = 1, inactive = 0',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sur_organization`
--

INSERT INTO `sur_organization` (`id`, `name`, `address`, `mobile`, `email`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'RBS Ltd.', 'Uttara', '01236549875', 'rbs@gmail.com', 1, 1, 21, '2022-01-17 10:17:28', '2022-02-08 16:55:40'),
(3, 'Square', 'Level 4 House 20,\r\nRoad 99 Gul', '+880 298402', 'gain.bangladesh@gainhealth.org', 1, 2, 21, '2022-02-06 16:35:34', '2022-03-02 06:21:30'),
(4, 'Shihab Org', 'Uttara sector 12', '849562310', 'a@gmail.com', 0, 2, 21, '2022-02-27 18:04:02', '2022-02-27 18:04:02'),
(5, 'SNOWTEX', 'Dhamrai', '01711111111', 'snowtex@gmail.com', 1, 2, NULL, '2022-02-28 12:22:11', '2022-02-28 12:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `sur_survey`
--

CREATE TABLE `sur_survey` (
  `id` bigint UNSIGNED NOT NULL,
  `nameen` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `namebn` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discriptionen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discriptionbn` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT 'active = 1, inactive = 0',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sur_survey`
--

INSERT INTO `sur_survey` (`id`, `nameen`, `namebn`, `discriptionen`, `discriptionbn`, `mode`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'How Was Today\'s Meal?', 'আজকের খাবার কেমন ছিল?', 'Please give us your opinion regarding today\'s meal.', 'অনুগ্রহপূর্বক আজকের খাবার সম্পর্কে আপনার মতামত দিন।', 'radio', 1, 1, 20, '2022-01-17 10:22:15', '2022-02-02 11:05:16'),
(5, 'Test Survey', NULL, 'This is a test', NULL, 'input', 1, 2, 21, '2022-02-10 11:31:38', '2022-02-10 11:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `sur_survey_organization`
--

CREATE TABLE `sur_survey_organization` (
  `id` bigint UNSIGNED NOT NULL,
  `survey_id` bigint UNSIGNED DEFAULT NULL,
  `organization_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sur_survey_organization`
--

INSERT INTO `sur_survey_organization` (`id`, `survey_id`, `organization_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(29, 2, 3, 21, NULL, '2022-03-02 06:53:11', '2022-03-02 06:53:11'),
(30, 2, 5, 21, NULL, '2022-03-02 06:53:11', '2022-03-02 06:53:11'),
(32, 5, 1, 21, NULL, '2022-03-03 10:06:39', '2022-03-03 10:06:39'),
(33, 5, 5, 21, NULL, '2022-03-03 10:06:39', '2022-03-03 10:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `sur_survey_organization_person`
--

CREATE TABLE `sur_survey_organization_person` (
  `id` bigint UNSIGNED NOT NULL,
  `survey_id` bigint UNSIGNED DEFAULT NULL,
  `organization_id` bigint UNSIGNED DEFAULT NULL,
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person` int DEFAULT NULL,
  `ordering` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sur_survey_organization_person`
--

INSERT INTO `sur_survey_organization_person` (`id`, `survey_id`, `organization_id`, `month`, `year`, `date`, `person`, `ordering`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(89, 2, 1, 'January', '2022', '1-01-2022', 11, 1, 2, NULL, '2022-02-09 11:53:23', '2022-02-09 11:53:23'),
(90, 2, 1, 'January', '2022', '2-01-2022', 33, 2, 2, NULL, '2022-02-09 11:53:24', '2022-02-09 11:53:31'),
(91, 2, 3, 'January', '2022', '2-01-2022', 0, 2, 2, NULL, '2022-02-09 11:53:26', '2022-02-09 11:55:09'),
(92, 2, 1, 'January', '2022', '3-01-2022', 44, 3, 2, NULL, '2022-02-09 11:53:26', '2022-02-09 11:53:34'),
(93, 2, 3, 'January', '2022', '1-01-2022', 0, 1, 2, NULL, '2022-02-09 11:53:29', '2022-02-09 11:55:10'),
(94, 2, 3, 'January', '2022', '3-01-2022', 0, 3, 2, NULL, '2022-02-09 11:53:35', '2022-02-09 11:55:07'),
(95, 2, 1, 'January', '2022', '4-01-2022', 343, 4, 2, NULL, '2022-02-09 11:53:35', '2022-02-09 11:53:39'),
(96, 2, 3, 'January', '2022', '4-01-2022', 0, 4, 2, NULL, '2022-02-09 11:53:40', '2022-02-09 11:55:06'),
(97, 2, 1, 'January', '2022', '5-01-2022', 0, 5, 2, NULL, '2022-02-09 11:53:40', '2022-02-09 11:53:40'),
(98, 2, 3, 'January', '2022', '5-01-2022', 0, 5, 2, NULL, '2022-02-09 11:53:40', '2022-02-09 11:55:05'),
(99, 2, 1, 'January', '2022', '6-01-2022', 44, 6, 2, NULL, '2022-02-09 11:53:51', '2022-02-09 11:53:53'),
(100, 2, 3, 'January', '2022', '7-01-2022', 0, 7, 2, NULL, '2022-02-09 11:53:55', '2022-02-09 11:55:05'),
(101, 2, 3, 'January', '2022', '8-01-2022', 0, 8, 2, NULL, '2022-02-09 11:53:56', '2022-02-09 11:55:04'),
(102, 2, 1, 'January', '2022', '14-01-2022', 3443, 14, 2, NULL, '2022-02-09 11:53:58', '2022-02-09 11:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `sur_survey_result`
--

CREATE TABLE `sur_survey_result` (
  `id` bigint UNSIGNED NOT NULL,
  `survey_id` bigint UNSIGNED DEFAULT NULL,
  `item_id` bigint UNSIGNED DEFAULT NULL,
  `organization_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `device_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT 'active = 1, inactive = 0',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sur_survey_result`
--

INSERT INTO `sur_survey_result` (`id`, `survey_id`, `item_id`, `organization_id`, `user_id`, `device_id`, `survey_value`, `latitude`, `longitude`, `date`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(466, 2, 2, 1, 2, '3f29d14bea68c0b7', 'Very Good', '23.8691994', '90.3892388', '08-02-2022', 1, 2, NULL, '2022-02-08 16:58:18', '2022-02-08 16:58:18'),
(467, 2, 3, 1, 2, '3f29d14bea68c0b7', 'Good', '23.8691994', '90.3892388', '08-02-2022', 1, 2, NULL, '2022-02-08 16:58:19', '2022-02-08 16:58:19'),
(474, 2, 2, 3, 14, '9f1a92cb1d47a101', 'Very Good', '23.8692429', '90.3893521', '08-02-2022', 1, 14, NULL, '2022-02-08 18:38:48', '2022-02-08 18:38:48'),
(475, 2, 3, 3, 14, '9f1a92cb1d47a101', 'Good', '23.8692429', '90.3893521', '08-02-2022', 1, 14, NULL, '2022-02-08 18:38:50', '2022-02-08 18:38:50'),
(476, 2, 4, 3, 14, '9f1a92cb1d47a101', 'Satisfactory', '23.8692429', '90.3893521', '08-02-2022', 1, 14, NULL, '2022-02-08 18:39:07', '2022-02-08 18:39:07'),
(477, 2, 4, 3, 14, '9f1a92cb1d47a101', 'Satisfactory', '23.8692429', '90.3893521', '08-02-2022', 1, 14, NULL, '2022-02-08 18:39:32', '2022-02-08 18:39:32'),
(478, 2, 4, 3, 14, '9f1a92cb1d47a101', 'Satisfactory', '23.8692429', '90.3893521', '08-02-2022', 1, 14, NULL, '2022-02-08 18:39:35', '2022-02-08 18:39:35'),
(479, 2, 12, 3, 14, '9f1a92cb1d47a101', 'Very Bad', '23.8692429', '90.3893521', '08-02-2022', 1, 14, NULL, '2022-02-08 18:39:42', '2022-02-08 18:39:42'),
(480, 2, 12, 3, 14, '9f1a92cb1d47a101', 'Very Bad', '23.8692429', '90.3893521', '08-02-2022', 1, 14, NULL, '2022-02-08 18:39:45', '2022-02-08 18:39:45'),
(482, 2, 2, 3, 14, '1105c0ba5dce3020', 'Very Good', '24.2944711', '90.3884357', '09-02-2022', 1, 14, NULL, '2022-02-09 10:56:39', '2022-02-09 10:56:39'),
(483, 2, 2, 3, 14, '1105c0ba5dce3020', 'Very Good', '24.2944711', '90.3884357', '09-02-2022', 1, 14, NULL, '2022-02-09 10:57:09', '2022-02-09 10:57:09'),
(484, 2, 2, 3, 14, '1105c0ba5dce3020', 'Very Good', '24.2944711', '90.3884357', '09-02-2022', 1, 14, NULL, '2022-02-09 10:57:29', '2022-02-09 10:57:29'),
(485, 2, 2, 3, 14, '1105c0ba5dce3020', 'Very Good', '24.2944711', '90.3884357', '09-02-2022', 1, 14, NULL, '2022-02-09 10:57:52', '2022-02-09 10:57:52'),
(486, 2, 2, 3, 14, '1105c0ba5dce3020', 'Very Good', '24.2943075', '90.3884783', '09-02-2022', 1, 14, NULL, '2022-02-09 10:58:57', '2022-02-09 10:58:57'),
(488, 2, 2, 1, 2, '3f29d14bea68c0b7', 'Very Good', '23.8692003', '90.3892442', '09-02-2022', 1, 2, NULL, '2022-02-09 11:46:11', '2022-02-09 11:46:11'),
(489, 2, 2, 1, 2, '3f29d14bea68c0b7', 'Very Good', '23.8692003', '90.3892442', '09-02-2022', 1, 2, NULL, '2022-02-09 11:46:11', '2022-02-09 11:46:11'),
(490, 2, 3, 1, 2, '3f29d14bea68c0b7', 'Good', '23.8692003', '90.3892442', '09-02-2022', 1, 2, NULL, '2022-02-09 11:46:13', '2022-02-09 11:46:13'),
(491, 2, 4, 1, 2, '3f29d14bea68c0b7', 'Satisfactory', '23.8692003', '90.3892442', '09-02-2022', 1, 2, NULL, '2022-02-09 11:46:32', '2022-02-09 11:46:32'),
(492, 2, 6, 1, 2, '3f29d14bea68c0b7', 'Bad', '23.8692003', '90.3892442', '09-02-2022', 1, 2, NULL, '2022-02-09 11:46:33', '2022-02-09 11:46:33'),
(493, 2, 12, 1, 2, '3f29d14bea68c0b7', 'Very Bad', '23.8692003', '90.3892442', '09-02-2022', 1, 2, NULL, '2022-02-09 11:46:37', '2022-02-09 11:46:37'),
(494, 2, 12, 1, 2, '3f29d14bea68c0b7', 'Very Bad', '23.8692003', '90.3892442', '09-02-2022', 1, 2, NULL, '2022-02-09 11:46:37', '2022-02-09 11:46:37'),
(495, 2, 3, 1, 2, '1cd2acfe7b0b0264', 'Good', '23.872198', '90.4038569', '19-02-2022', 1, 2, NULL, '2022-02-19 10:49:57', '2022-02-19 10:49:57'),
(496, 2, 2, 1, 2, '1cd2acfe7b0b0264', 'Very Good', '23.872198', '90.4038569', '19-02-2022', 1, 2, NULL, '2022-02-19 10:50:34', '2022-02-19 10:50:34'),
(497, 2, 2, 1, 2, '1cd2acfe7b0b0264', 'Very Good', '23.872198', '90.4038569', '19-02-2022', 1, 2, NULL, '2022-02-19 10:50:34', '2022-02-19 10:50:34'),
(498, 2, 2, 1, 2, '21a4142116136c46', 'Very Good', '23.8692494', '90.3892477', '27-02-2022', 1, 2, NULL, '2022-02-27 17:55:07', '2022-02-27 17:55:07'),
(499, 2, 3, 1, 2, '21a4142116136c46', 'Good', '23.8692494', '90.3892477', '27-02-2022', 1, 2, NULL, '2022-02-27 17:55:08', '2022-02-27 17:55:08'),
(500, 2, 3, 1, 2, '21a4142116136c46', 'Good', '23.8692494', '90.3892477', '27-02-2022', 1, 2, NULL, '2022-02-27 17:55:09', '2022-02-27 17:55:09'),
(501, 2, 2, 5, 19, '21a4142116136c46', 'Very Good', '23.9103071', '90.2068652', '28-02-2022', 1, 19, NULL, '2022-02-28 12:33:02', '2022-02-28 12:33:02'),
(502, 2, 2, 5, 19, '21a4142116136c46', 'Very Good', '23.9103071', '90.2068652', '28-02-2022', 1, 19, NULL, '2022-02-28 12:33:05', '2022-02-28 12:33:05'),
(503, 2, 3, 5, 19, '21a4142116136c46', 'Good', '23.9103087', '90.2068647', '28-02-2022', 1, 19, NULL, '2022-02-28 12:33:12', '2022-02-28 12:33:12'),
(504, 2, 4, 5, 19, '21a4142116136c46', 'Satisfactory', '23.9103087', '90.2068647', '28-02-2022', 1, 19, NULL, '2022-02-28 12:33:15', '2022-02-28 12:33:15'),
(505, 2, 6, 5, 19, '21a4142116136c46', 'Bad', '23.9103087', '90.2068647', '28-02-2022', 1, 19, NULL, '2022-02-28 12:33:17', '2022-02-28 12:33:17'),
(506, 2, 6, 5, 19, '21a4142116136c46', 'Bad', '23.9103087', '90.2068647', '28-02-2022', 1, 19, NULL, '2022-02-28 12:33:17', '2022-02-28 12:33:17'),
(507, 2, 3, 5, 19, '21a4142116136c46', 'Good', '23.9103087', '90.2068647', '28-02-2022', 1, 19, NULL, '2022-02-28 12:33:28', '2022-02-28 12:33:28'),
(508, 2, 2, 1, 2, '21a4142116136c46', 'Very Good', '23.9103088', '90.2068647', '28-02-2022', 1, 2, NULL, '2022-02-28 13:21:18', '2022-02-28 13:21:18'),
(509, 2, 3, 1, 2, '21a4142116136c46', 'Good', '23.9103088', '90.2068647', '28-02-2022', 1, 2, NULL, '2022-02-28 13:21:19', '2022-02-28 13:21:19'),
(510, 2, 3, 1, 2, '21a4142116136c46', 'Good', '23.9103088', '90.2068647', '28-02-2022', 1, 2, NULL, '2022-02-28 13:21:20', '2022-02-28 13:21:20'),
(511, 2, 2, 5, 20, 'c05ba4921c48f8ce', 'Very Good', '23.9103094', '90.2068643', '28-02-2022', 1, 20, NULL, '2022-02-28 13:43:04', '2022-02-28 13:43:04'),
(512, 2, 2, 5, 20, 'c05ba4921c48f8ce', 'Very Good', '23.9103094', '90.2068643', '28-02-2022', 1, 20, NULL, '2022-02-28 13:43:04', '2022-02-28 13:43:04'),
(513, 2, 2, 5, 20, 'c05ba4921c48f8ce', 'Very Good', '23.9103094', '90.2068643', '28-02-2022', 1, 20, NULL, '2022-02-28 13:43:15', '2022-02-28 13:43:15'),
(514, 2, 4, 5, 20, 'c05ba4921c48f8ce', 'Satisfactory', '23.9103121', '90.2068647', '28-02-2022', 1, 20, NULL, '2022-02-28 13:45:03', '2022-02-28 13:45:03'),
(515, 2, 2, 5, 20, 'c05ba4921c48f8ce', 'Very Good', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:45:13', '2022-02-28 13:45:13'),
(516, 2, 2, 5, 20, 'c05ba4921c48f8ce', 'Very Good', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:45:17', '2022-02-28 13:45:17'),
(517, 2, 4, 5, 20, 'c05ba4921c48f8ce', 'Satisfactory', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:45:42', '2022-02-28 13:45:42'),
(518, 2, 3, 5, 20, 'c05ba4921c48f8ce', 'Good', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:45:47', '2022-02-28 13:45:47'),
(519, 2, 2, 5, 20, 'c05ba4921c48f8ce', 'Very Good', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:46:09', '2022-02-28 13:46:09'),
(520, 2, 2, 5, 20, 'c05ba4921c48f8ce', 'Very Good', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:46:10', '2022-02-28 13:46:10'),
(521, 2, 2, 5, 20, 'c05ba4921c48f8ce', 'Very Good', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:46:12', '2022-02-28 13:46:12'),
(522, 2, 4, 5, 20, 'c05ba4921c48f8ce', 'Satisfactory', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:46:23', '2022-02-28 13:46:23'),
(523, 2, 2, 5, 20, 'c05ba4921c48f8ce', 'Very Good', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:46:34', '2022-02-28 13:46:34'),
(524, 2, 12, 5, 20, 'c05ba4921c48f8ce', 'Very Bad', '23.9103121', '90.2068631', '28-02-2022', 1, 20, NULL, '2022-02-28 13:59:58', '2022-02-28 13:59:58'),
(525, 5, 13, 1, 2, '21a4142116136c46', 'Very Good', '23.9103088', '90.2068647', '28-02-2022', 1, 2, NULL, '2022-02-28 13:21:18', '2022-02-28 13:21:18'),
(526, 5, 13, 1, 2, '21a4142116136c46', 'Very Good', '23.9103088', '90.2068647', '28-02-2022', 1, 2, NULL, '2022-02-28 13:21:18', '2022-02-28 13:21:18'),
(529, 2, 2, 5, 20, '12345555', 'ok', '3.761Raju', '4.241Raju', '13-03-2022', 1, 20, NULL, '2022-03-13 07:51:31', '2022-03-13 07:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `organization_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('Admin','Vendor','Customer','User') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'active = 1, inactive = 0',
  `created_by` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `organization_id`, `name`, `email`, `mobile`, `address`, `password`, `type`, `user_image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 1, 'Admin (RBS)', 'admin@gmail.com', '01236549875', 'uttara', '$2y$10$4PgI9AZ6btiHhL4.Xy6wjOUlaudDv2krAaKaFgkMEUJtnsAlu7Usy', 'Admin', 'admin1642576675.png', '1', '1', '21', '2022-01-19 07:17:55', '2022-02-08 16:57:12'),
(14, 3, 'Md. Aminul Islam', 'aminul.spark2205@gmail.com', '01684387026', NULL, '$2y$10$WzObWhgXAOvNYyMoXcsmqeOBmGgikot3jfEaATIv3ayisVJdUpwMm', 'Admin', NULL, '1', '2', '21', '2022-02-06 14:53:27', '2022-02-09 16:33:27'),
(16, 3, 'Admin', 'gsumon@gainhealth.org', '01234567890', NULL, '$2y$10$eh9VgzjcoZEfdSCUiWaAgeMxCrJl1nvJdvI0TpwDSrCpe8P13V2nC', 'Admin', NULL, '1', '2', '21', '2022-02-06 17:41:24', '2022-02-09 16:31:11'),
(17, 3, 'Operator', 'operator.gain@gmail.com', '12345678900', NULL, '$2y$10$VZcfESF1YUeyCdJIEh6fyuo2fa9Xzt4lMpYfhFiQG2VsI9RjGbCMS', 'Admin', NULL, '1', '16', '21', '2022-02-07 16:16:39', '2022-02-08 16:56:00'),
(18, 3, 'Saifur Rahman', 'saifursohel@gmail.com', '01704118118', NULL, '$2y$10$CSE8L83ZZsCdX06tcxHUxO9.TZrraVNHbzXftLZXwMgTCODnEq2b.', 'Admin', NULL, '1', '2', '21', '2022-02-08 17:02:18', '2022-02-09 11:51:19'),
(19, 5, 'snowtex', 'snowtex@gmail.com', '01711111111', NULL, '$2y$10$WAFA514OpupawwJBJR5mnOokc1P87NWhqnpt4mEV85PcW1Dun9dzu', 'Admin', NULL, '1', '2', '21', '2022-02-28 12:23:07', '2022-02-28 12:23:07'),
(20, 5, 'Snowtex Outerwear Ltd.', 'compliance.sol@snowtex.org', '01716412845', NULL, '$2y$10$MWDDSX2c2GGUcr9l7fXwo.DnAtpDl3e/hsR54Op0coU1WmUSTrBIC', 'Admin', NULL, '1', '2', NULL, '2022-02-28 13:40:21', '2022-02-28 13:40:21'),
(21, NULL, 'Gain Bangladesh', 'gainbangladesh@gmail.com', '01700000000', 'Gain Bangladesh', '$2y$10$d1RDgZ7YQSsqSyj2hkLjJeyEF57Url2ejDBIx2o6Egx8ZCwsNmole', 'Admin', NULL, '1', '2', NULL, '2022-03-02 06:17:08', '2022-03-02 06:17:08'),
(26, NULL, 'test', 'test@gmail.com', '01712326532', 'yyy', '$2y$10$AHgMVdeWihmS8ObVzZmA4OBpk/s6/mxo4YoIKQifZYUs8Gg0r6QSq', 'Admin', NULL, '1', '21', NULL, '2022-03-03 12:21:22', '2022-03-03 12:21:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pos_configuration`
--
ALTER TABLE `pos_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sur_item`
--
ALTER TABLE `sur_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sur_item_survey_id_foreign` (`survey_id`);

--
-- Indexes for table `sur_organization`
--
ALTER TABLE `sur_organization`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sur_organization_email_unique` (`email`);

--
-- Indexes for table `sur_survey`
--
ALTER TABLE `sur_survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sur_survey_organization`
--
ALTER TABLE `sur_survey_organization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sur_survey_organization_survey_id_foreign` (`survey_id`),
  ADD KEY `sur_survey_organization_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `sur_survey_organization_person`
--
ALTER TABLE `sur_survey_organization_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sur_survey_organization_person_survey_id_foreign` (`survey_id`),
  ADD KEY `sur_survey_organization_person_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `sur_survey_result`
--
ALTER TABLE `sur_survey_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sur_survey_result_item_id_foreign` (`item_id`),
  ADD KEY `sur_survey_result_organization_id_foreign` (`organization_id`),
  ADD KEY `sur_survey_result_user_id_foreign` (`user_id`),
  ADD KEY `sur_survey_result_survey_id_foreign` (`survey_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_organization_id_foreign` (`organization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_configuration`
--
ALTER TABLE `pos_configuration`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sur_item`
--
ALTER TABLE `sur_item`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sur_organization`
--
ALTER TABLE `sur_organization`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sur_survey`
--
ALTER TABLE `sur_survey`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sur_survey_organization`
--
ALTER TABLE `sur_survey_organization`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sur_survey_organization_person`
--
ALTER TABLE `sur_survey_organization_person`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `sur_survey_result`
--
ALTER TABLE `sur_survey_result`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sur_item`
--
ALTER TABLE `sur_item`
  ADD CONSTRAINT `sur_item_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `sur_survey` (`id`);

--
-- Constraints for table `sur_survey_organization`
--
ALTER TABLE `sur_survey_organization`
  ADD CONSTRAINT `sur_survey_organization_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `sur_organization` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sur_survey_organization_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `sur_survey` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sur_survey_organization_person`
--
ALTER TABLE `sur_survey_organization_person`
  ADD CONSTRAINT `sur_survey_organization_person_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `sur_organization` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sur_survey_organization_person_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `sur_survey` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sur_survey_result`
--
ALTER TABLE `sur_survey_result`
  ADD CONSTRAINT `sur_survey_result_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `sur_item` (`id`),
  ADD CONSTRAINT `sur_survey_result_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `sur_organization` (`id`),
  ADD CONSTRAINT `sur_survey_result_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `sur_survey` (`id`),
  ADD CONSTRAINT `sur_survey_result_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `sur_organization` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
