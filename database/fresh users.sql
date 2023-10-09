-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 04:54 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pams`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'Admin', 'admin@gmail.com', '01234567895', '$2y$10$y/IvGW7XKDFbMFVoIKi0gO3Jaa5PYIDRA6ytXjX6REZkRheZwkBXa', NULL, NULL, '2023-10-09 10:50:12', '2023-10-09 10:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

CREATE TABLE `citations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `citation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `faculty_id` bigint NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`id`, `user_id`, `faculty_id`, `designation`, `created_at`, `updated_at`) VALUES
(1, 16, 2191081040, 'Associate Professor', '2023-10-09 10:50:12', '2023-10-09 10:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Image Processing', '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(2, 'Robotics', '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(3, 'Web Application Development', '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(4, 'Networking', '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(5, 'Artificial Intelligence', '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(6, 'Data Science', '2023-10-09 10:50:12', '2023-10-09 10:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `domain_user`
--

CREATE TABLE `domain_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `domain_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint UNSIGNED NOT NULL,
  `notice_id` bigint UNSIGNED DEFAULT NULL,
  `project_report_id` bigint UNSIGNED DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint UNSIGNED DEFAULT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leader_id` bigint UNSIGNED NOT NULL,
  `can_propose` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_invitations`
--

CREATE TABLE `group_invitations` (
  `id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_07_160010_create_coordinators_table', 1),
(6, '2023_05_07_160010_create_supervisors_table', 1),
(7, '2023_05_07_160011_create_groups_table', 1),
(8, '2023_05_07_160012_create_students_table', 1),
(9, '2023_05_07_160013_create_group_members_table', 1),
(10, '2023_05_07_160014_create_admins_table', 1),
(11, '2023_05_07_160015_create_project_proposals_table', 1),
(12, '2023_05_07_160017_create_domains_table', 1),
(13, '2023_05_07_160018_create_pending_groups_table', 1),
(14, '2023_05_07_160019_create_group_invitations_table', 1),
(15, '2023_08_10_150759_create_request_to_coordinators_table', 1),
(16, '2023_08_16_104327_create_project_types_table', 1),
(17, '2023_08_16_114236_create_domain_user_table', 1),
(18, '2023_08_16_114338_create_project_type_user_table', 1),
(19, '2023_08_17_151708_create_designations_table', 1),
(20, '2023_08_21_122341_create_proposal_feedbacks_table', 1),
(21, '2023_08_22_181159_create_projects_table', 1),
(22, '2023_08_27_150752_create_notices_table', 1),
(23, '2023_08_27_150753_create_project_reports_table', 1),
(24, '2023_08_27_152242_create_files_table', 1),
(25, '2023_08_28_100943_create_citations_table', 1),
(26, '2023_08_28_170329_create_notifications_table', 1),
(27, '2023_09_06_051756_create_phase1_table', 1),
(28, '2023_09_09_142127_create_phase2_table', 1),
(29, '2023_09_09_142136_create_phase3_table', 1),
(30, '2023_09_11_130730_create_old_titles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `notice` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `phase1` tinyint(1) NOT NULL DEFAULT '0',
  `phase2` tinyint(1) NOT NULL DEFAULT '0',
  `phase3` tinyint(1) NOT NULL DEFAULT '0',
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `old_titles`
--

CREATE TABLE `old_titles` (
  `id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED NOT NULL,
  `supervisor_id` bigint UNSIGNED NOT NULL,
  `old_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_groups`
--

CREATE TABLE `pending_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `positive_status` int NOT NULL,
  `member_feedback` int NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phase1`
--

CREATE TABLE `phase1` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `examiner_1_mark` decimal(5,2) DEFAULT NULL,
  `examiner_2_mark` decimal(5,2) DEFAULT NULL,
  `examiner_3_mark` decimal(5,2) DEFAULT NULL,
  `examiner_average` decimal(5,2) DEFAULT NULL,
  `attendance` decimal(5,2) DEFAULT NULL,
  `project_development` decimal(5,2) DEFAULT NULL,
  `report_preparation` decimal(5,2) DEFAULT NULL,
  `total` decimal(5,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phase2`
--

CREATE TABLE `phase2` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `examiner_1_mark` decimal(5,2) DEFAULT NULL,
  `examiner_2_mark` decimal(5,2) DEFAULT NULL,
  `examiner_3_mark` decimal(5,2) DEFAULT NULL,
  `examiner_average` decimal(5,2) DEFAULT NULL,
  `attendance` decimal(5,2) DEFAULT NULL,
  `project_development` decimal(5,2) DEFAULT NULL,
  `report_preparation` decimal(5,2) DEFAULT NULL,
  `total` decimal(5,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phase3`
--

CREATE TABLE `phase3` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `examiner_1_mark` decimal(5,2) DEFAULT NULL,
  `examiner_2_mark` decimal(5,2) DEFAULT NULL,
  `examiner_3_mark` decimal(5,2) DEFAULT NULL,
  `examiner_average` decimal(5,2) DEFAULT NULL,
  `attendance` decimal(5,2) DEFAULT NULL,
  `project_development` decimal(5,2) DEFAULT NULL,
  `report_preparation` decimal(5,2) DEFAULT NULL,
  `total` decimal(5,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_id` bigint UNSIGNED NOT NULL,
  `coordinator_id` bigint UNSIGNED NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phase` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'phase1',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `result_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_proposals`
--

CREATE TABLE `project_proposals` (
  `id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_id` bigint UNSIGNED NOT NULL,
  `supervisor_feedback` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_reports`
--

CREATE TABLE `project_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_types`
--

CREATE TABLE `project_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_types`
--

INSERT INTO `project_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'project', '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(2, 'thesis', '2023-10-09 10:50:12', '2023-10-09 10:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `project_type_user`
--

CREATE TABLE `project_type_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `project_type_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal_feedbacks`
--

CREATE TABLE `proposal_feedbacks` (
  `id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED NOT NULL,
  `suggestion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_denied` tinyint(1) NOT NULL DEFAULT '0',
  `denied_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_to_coordinators`
--

CREATE TABLE `request_to_coordinators` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `group_id` bigint UNSIGNED DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint NOT NULL,
  `batch` int NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phase` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` bigint UNSIGNED DEFAULT NULL,
  `project_type_status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `student_id`, `batch`, `section`, `shift`, `phase`, `group_id`, `project_type_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2193081040, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(2, 2, 2193081041, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(3, 3, 2193081042, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(4, 4, 2193081043, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(5, 5, 2193081044, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(6, 6, 2193081045, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(7, 7, 2193081046, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(8, 8, 2193081047, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(9, 9, 2193081048, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(10, 10, 2193081049, 49, 'B', 'Day', NULL, NULL, 0, '2023-10-09 10:50:11', '2023-10-09 10:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `faculty_id` bigint NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `user_id`, `faculty_id`, `designation`, `availability`, `created_at`, `updated_at`) VALUES
(1, 11, 2192081040, 'Assistant Professor', 0, '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(2, 12, 2192081041, 'Instructor', 0, '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(3, 13, 2192081042, 'Assistant Professor', 0, '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(4, 14, 2192081043, 'Associate Professo', 0, '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(5, 15, 2192081044, 'Instructor', 0, '2023-10-09 10:50:12', '2023-10-09 10:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `role`, `phone_number`, `department`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tofayel Ahmmad', 'Topu', 'student1@gmail.com', 'student', '01234567891', 'CSE', NULL, '$2y$10$Dr/p9ZKBzq53hwUtjl/cpeH6TxPHw3XUpo1CqvF6bA23BSs9thPnu', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(2, 'Rezwana', 'Karim', 'student2@gmail.com', 'student', '01234567892', 'CSE', NULL, '$2y$10$T77TtlDyYcBce0PsXltXHewAPfreXBhnsKDk9EGPtH3OlmBUz.mXy', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(3, 'Tawhidul', 'Islam', 'student3@gmail.com', 'student', '01234567893', 'CSE', NULL, '$2y$10$yKQsd/tu8LnhcgmA6a90Key.hcaCs8f7pf5DZ0ivlkgnw3UE0mWGu', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(4, 'Hasibul', 'Islam', 'student4@gmail.com', 'student', '01234567894', 'CSE', NULL, '$2y$10$iuCCQdlf06DeIvxaloKZ6e/nyb4.F.xY/3W5rBJlFY6Hp4oGB3fYq', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(5, 'Marium', 'Akter', 'student5@gmail.com', 'student', '01234567895', 'CSE', NULL, '$2y$10$RAM70A5jxj80Poicmj/jP.P5tc0NSAnLRQHuMfPoUdHFiS3osgfmC', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(6, 'Imam', 'Hussain', 'student6@gmail.com', 'student', '01234567896', 'CSE', NULL, '$2y$10$zMTSEAaCt2HQJxCWzivT9uAUmtC8AWGFlM/./JigMxbzg9JD9cx3e', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(7, 'Jewel', 'Mahmud', 'student7@gmail.com', 'student', '01234567897', 'CSE', NULL, '$2y$10$3nc7edzeVj82JMQs4NwZ5eoMbJdZ3hZQsPDL2mopjWgErA6Jx6UGe', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(8, 'Synthia', 'Islam', 'student8@gmail.com', 'student', '01234567898', 'CSE', NULL, '$2y$10$TpFC8aITWQJ156QSxNei6.q1fUKBp4TKcRTocOsXWqEzXCRhiY8Ii', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(9, 'Abdur Rahman', 'Talha', 'student9@gmail.com', 'student', '01234567899', 'CSE', NULL, '$2y$10$ME36R.pzjU1hh45CbTxve.FH7OombxelTKPDm9fqkcizGxHzK9Kme', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(10, 'Ashikul Islam', 'Khan Shishir', 'student10@gmail.com', 'student', '01234567890', 'CSE', NULL, '$2y$10$bFXVVFkfG2hM4EbPoeQ.fOc0IgFas.UWT1qfIBXCfZBt4q.H2v8q.', NULL, '2023-10-09 10:50:11', '2023-10-09 10:50:11'),
(11, 'Samia', 'Yasmin', 'supervisor1@gmail.com', 'supervisor', '01234567891', 'CSE', NULL, '$2y$10$hwr5PbcrqYu7A3ChWqmujepXx70RfJShErQhj.EMxPy83MzvHfYdG', NULL, '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(12, 'Nasrin', 'Tumpa', 'supervisor2@gmail.com', 'supervisor', '01234567892', 'CSE', NULL, '$2y$10$2ARZlZMM0ZPej9vn32tkw.MCBYDpkEIyjte8cyqH99U1JBvULPFMm', NULL, '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(13, 'Shahrukh', 'Omar', 'supervisor3@gmail.com', 'supervisor', '01234567893', 'CSE', NULL, '$2y$10$/RiDEAZPGA5o49PQZGR8UuIpUr4mDrD5V.OxJXwERK9KHE.4jo7E6', NULL, '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(14, 'Naznin Hossain', 'Esha', 'supervisor4@gmail.com', 'supervisor', '01234567894', 'CSE', NULL, '$2y$10$d/KxNBEQqIgTt/UV5TtQw.JONCWw22rzF9Lstnd/eiqCTpipHoT56', NULL, '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(15, 'Tanjilla', 'Wahid', 'supervisor5@gmail.com', 'supervisor', '01234567890', 'CSE', NULL, '$2y$10$NPUk5.erZwhnOq04c7/E8.PDrlxMutckd01YtdhzsclCy0njoNJda', NULL, '2023-10-09 10:50:12', '2023-10-09 10:50:12'),
(16, 'Md. Torikur', 'Rahman', 'coordinator@gmail.com', 'coordinator', '01234567895', 'CSE', NULL, '$2y$10$P9Hkt8A8drzR0yIctByb7uek5DoZ5fZZywspWV/qcyfheKJ9k49kG', NULL, '2023-10-09 10:50:12', '2023-10-09 10:50:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `citations`
--
ALTER TABLE `citations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citations_user_id_foreign` (`user_id`);

--
-- Indexes for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coordinators_user_id_foreign` (`user_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain_user`
--
ALTER TABLE `domain_user`
  ADD KEY `domain_user_user_id_foreign` (`user_id`),
  ADD KEY `domain_user_domain_id_foreign` (`domain_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_notice_id_foreign` (`notice_id`),
  ADD KEY `files_project_report_id_foreign` (`project_report_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_invitations`
--
ALTER TABLE `group_invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_invitations_group_id_foreign` (`group_id`),
  ADD KEY `group_invitations_user_id_foreign` (`user_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_members_group_id_foreign` (`group_id`),
  ADD KEY `group_members_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notices_group_id_foreign` (`group_id`),
  ADD KEY `notices_user_id_foreign` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `old_titles`
--
ALTER TABLE `old_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `old_titles_group_id_foreign` (`group_id`),
  ADD KEY `old_titles_supervisor_id_foreign` (`supervisor_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pending_groups`
--
ALTER TABLE `pending_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pending_groups_created_by_foreign` (`created_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phase1`
--
ALTER TABLE `phase1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phase1_project_id_foreign` (`project_id`),
  ADD KEY `phase1_user_id_foreign` (`user_id`);

--
-- Indexes for table `phase2`
--
ALTER TABLE `phase2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phase2_project_id_foreign` (`project_id`),
  ADD KEY `phase2_user_id_foreign` (`user_id`);

--
-- Indexes for table `phase3`
--
ALTER TABLE `phase3`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phase3_project_id_foreign` (`project_id`),
  ADD KEY `phase3_user_id_foreign` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_group_id_foreign` (`group_id`),
  ADD KEY `projects_supervisor_id_foreign` (`supervisor_id`),
  ADD KEY `projects_coordinator_id_foreign` (`coordinator_id`);

--
-- Indexes for table `project_proposals`
--
ALTER TABLE `project_proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_proposals_group_id_foreign` (`group_id`),
  ADD KEY `project_proposals_supervisor_id_foreign` (`supervisor_id`),
  ADD KEY `project_proposals_created_by_foreign` (`created_by`);

--
-- Indexes for table `project_reports`
--
ALTER TABLE `project_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_reports_project_id_foreign` (`project_id`),
  ADD KEY `project_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `project_types`
--
ALTER TABLE `project_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_type_user`
--
ALTER TABLE `project_type_user`
  ADD KEY `project_type_user_user_id_foreign` (`user_id`),
  ADD KEY `project_type_user_project_type_id_foreign` (`project_type_id`);

--
-- Indexes for table `proposal_feedbacks`
--
ALTER TABLE `proposal_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_feedbacks_group_id_foreign` (`group_id`),
  ADD KEY `proposal_feedbacks_denied_by_foreign` (`denied_by`);

--
-- Indexes for table `request_to_coordinators`
--
ALTER TABLE `request_to_coordinators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_to_coordinators_user_id_foreign` (`user_id`),
  ADD KEY `request_to_coordinators_group_id_foreign` (`group_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_user_id_foreign` (`user_id`),
  ADD KEY `students_group_id_foreign` (`group_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supervisors_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `citations`
--
ALTER TABLE `citations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_invitations`
--
ALTER TABLE `group_invitations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `old_titles`
--
ALTER TABLE `old_titles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_groups`
--
ALTER TABLE `pending_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phase1`
--
ALTER TABLE `phase1`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phase2`
--
ALTER TABLE `phase2`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phase3`
--
ALTER TABLE `phase3`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_proposals`
--
ALTER TABLE `project_proposals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_reports`
--
ALTER TABLE `project_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_types`
--
ALTER TABLE `project_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proposal_feedbacks`
--
ALTER TABLE `proposal_feedbacks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_to_coordinators`
--
ALTER TABLE `request_to_coordinators`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citations`
--
ALTER TABLE `citations`
  ADD CONSTRAINT `citations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD CONSTRAINT `coordinators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `domain_user`
--
ALTER TABLE `domain_user`
  ADD CONSTRAINT `domain_user_domain_id_foreign` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `domain_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_notice_id_foreign` FOREIGN KEY (`notice_id`) REFERENCES `notices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_project_report_id_foreign` FOREIGN KEY (`project_report_id`) REFERENCES `project_reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_invitations`
--
ALTER TABLE `group_invitations`
  ADD CONSTRAINT `group_invitations_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `pending_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_invitations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `old_titles`
--
ALTER TABLE `old_titles`
  ADD CONSTRAINT `old_titles_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `old_titles_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pending_groups`
--
ALTER TABLE `pending_groups`
  ADD CONSTRAINT `pending_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `phase1`
--
ALTER TABLE `phase1`
  ADD CONSTRAINT `phase1_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phase1_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `phase2`
--
ALTER TABLE `phase2`
  ADD CONSTRAINT `phase2_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phase2_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `phase3`
--
ALTER TABLE `phase3`
  ADD CONSTRAINT `phase3_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phase3_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_coordinator_id_foreign` FOREIGN KEY (`coordinator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `projects_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `projects_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_proposals`
--
ALTER TABLE `project_proposals`
  ADD CONSTRAINT `project_proposals_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_proposals_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `project_proposals_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_reports`
--
ALTER TABLE `project_reports`
  ADD CONSTRAINT `project_reports_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_type_user`
--
ALTER TABLE `project_type_user`
  ADD CONSTRAINT `project_type_user_project_type_id_foreign` FOREIGN KEY (`project_type_id`) REFERENCES `project_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_type_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_feedbacks`
--
ALTER TABLE `proposal_feedbacks`
  ADD CONSTRAINT `proposal_feedbacks_denied_by_foreign` FOREIGN KEY (`denied_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `proposal_feedbacks_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `request_to_coordinators`
--
ALTER TABLE `request_to_coordinators`
  ADD CONSTRAINT `request_to_coordinators_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_to_coordinators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `supervisors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
