-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 01:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'demo', 'demo@gmail.com', '3308', '2025-11-15 04:39:01', '2025-11-19 00:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `exam_title` varchar(255) DEFAULT NULL,
  `class_section` text NOT NULL,
  `description` text DEFAULT NULL,
  `duration_minutes` text DEFAULT NULL,
  `questions` text NOT NULL,
  `options` text NOT NULL,
  `correct_answer` text NOT NULL,
  `marks` text NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `subject_name`, `exam_title`, `class_section`, `description`, `duration_minutes`, `questions`, `options`, `correct_answer`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(7, 'English', 'Unit Test', 'First - A', 'qwertyu', '30', '\"[\\\"zxcvbnm\\\"]\"', '\"[{\\\"A\\\":\\\"went\\\",\\\"B\\\":\\\"goes\\\",\\\"C\\\":\\\"gone\\\",\\\"D\\\":\\\"is going\\\"}]\"', '\"[\\\"A\\\"]\"', '\"[\\\"1\\\"]\"', 'active', '2025-11-26 23:48:01', '2025-12-02 05:52:34'),
(9, 'Science', 'Monthly Test', 'Second - B', 'Science Exam...', '30', '\"[\\\"Which gas is most abundant in Earth\'s atmosphere?\\\",\\\"What is the basic unit of life?\\\",\\\"Which part of the plant is responsible for photosynthesis?\\\",\\\"What force pulls objects toward the center of the Earth?\\\",\\\"Which of the following is a renewable source of energy?\\\"]\"', '\"[{\\\"A\\\":\\\"Oxygen\\\",\\\"B\\\":\\\"Nitrogen\\\",\\\"C\\\":\\\"Carbon dioxide\\\",\\\"D\\\":\\\"Argon\\\"},{\\\"A\\\":\\\"Tissue\\\",\\\"B\\\":\\\"Cell\\\",\\\"C\\\":\\\"Organ\\\",\\\"D\\\":\\\"Molecule\\\"},{\\\"A\\\":\\\"Root\\\",\\\"B\\\":\\\"Stem\\\",\\\"C\\\":\\\"Leaf\\\",\\\"D\\\":\\\"Flower\\\"},{\\\"A\\\":\\\"Friction\\\",\\\"B\\\":\\\"Magnetism\\\",\\\"C\\\":\\\"Gravity\\\",\\\"D\\\":\\\"Pressure\\\"},{\\\"A\\\":\\\"Coal\\\",\\\"B\\\":\\\"Natural gas\\\",\\\"C\\\":\\\"Petroleum\\\",\\\"D\\\":\\\"Solar energy\\\"}]\"', '\"[\\\"B\\\",\\\"C\\\",\\\"A\\\",\\\"D\\\",\\\"B\\\"]\"', '\"[\\\"1\\\",\\\"1\\\",\\\"1\\\",\\\"1\\\",\\\"1\\\"]\"', 'active', '2025-11-27 22:54:44', '2025-12-02 05:52:28'),
(10, 'English', 'Unit Test', 'First - A', 'English Exam.', '30', '\"[\\\"Choose the correctly punctuated sentence:\\\",\\\"Identify the figure of speech: \\\\u201cThe stars danced playfully in the sky.\\\\u201d\\\",\\\"Choose the correct synonym for \\\\u201cbenevolent\\\\u201d:\\\",\\\"Select the grammatically correct sentence:\\\",\\\"\\\\u201cShe has been working here ___ five years.\\\\u201d\\\",\\\"Identify the type of sentence: \\\\u201cPlease close the door.\\\\u201d\\\"]\"', '\"[{\\\"A\\\":\\\"My brother who lives in Canada is visiting next week.\\\",\\\"B\\\":\\\"My brother, who lives in Canada, is visiting next week.\\\",\\\"C\\\":\\\"My brother who lives in Canada, is visiting next week.\\\",\\\"D\\\":\\\"My brother, who lives in Canada is visiting next week.\\\"},{\\\"A\\\":\\\"Simile\\\",\\\"B\\\":\\\"Metaphor\\\",\\\"C\\\":\\\"Personification\\\",\\\"D\\\":\\\"Hyperbole\\\"},{\\\"A\\\":\\\"Cruel\\\",\\\"B\\\":\\\"Kind\\\",\\\"C\\\":\\\"Angry\\\",\\\"D\\\":\\\"Rigid\\\"},{\\\"A\\\":\\\"She don\\\\u2019t like to read novels.\\\",\\\"B\\\":\\\"She doesn\\\\u2019t likes to read novels.\\\",\\\"C\\\":\\\"She doesn\\\\u2019t like to read novels.\\\",\\\"D\\\":\\\"She don\\\\u2019t likes to read novels.\\\"},{\\\"A\\\":\\\"since\\\",\\\"B\\\":\\\"for\\\",\\\"C\\\":\\\"from\\\",\\\"D\\\":\\\"during\\\"},{\\\"A\\\":\\\"Declarative\\\",\\\"B\\\":\\\"Interrogative\\\",\\\"C\\\":\\\"Imperative\\\",\\\"D\\\":\\\"Exclamatory\\\"}]\"', '\"[\\\"B\\\",\\\"C\\\",\\\"B\\\",\\\"C\\\",\\\"B\\\",\\\"C\\\"]\"', '\"[\\\"2\\\",\\\"2\\\",\\\"2\\\",\\\"2\\\",\\\"2\\\",\\\"2\\\"]\"', 'active', '2025-11-30 22:31:36', '2025-12-02 05:52:08'),
(12, 'English', 'Unit Test', 'First - A', 'qwertyu', '10', '\"[\\\"zxcvbnmlkjhgfdsa\\\",\\\"Identify the figure of speech: \\\\u201cThe stars danced playfully in the sky.\\\\u201d\\\"]\"', '\"[{\\\"A\\\":\\\"went\\\",\\\"B\\\":\\\"goes\\\",\\\"C\\\":\\\"gone\\\",\\\"D\\\":\\\"is going\\\"},{\\\"A\\\":\\\"Simile\\\",\\\"B\\\":\\\"Metaphor\\\",\\\"C\\\":\\\"Personification\\\",\\\"D\\\":\\\"Hyperbole\\\"}]\"', '\"[\\\"A\\\",\\\"B\\\"]\"', '\"[\\\"2\\\",\\\"2\\\"]\"', 'active', '2025-12-02 00:05:53', '2025-12-02 00:29:01'),
(14, 'Social Science', 'Unit Test', 'First - A', 'Social Science Exam...', '30', '\"[\\\"Which of the following is the primary source of revenue for the government?\\\",\\\"Which river is known as the \\\\u201clifeline of Egypt\\\\u201d?\\\",\\\"Democracy is a form of government in which:\\\",\\\"The study of human society is called:\\\",\\\"Which of the following is a non-renewable resource?\\\"]\"', '\"[{\\\"A\\\":\\\"Donations from citizens\\\",\\\"B\\\":\\\"Taxes\\\",\\\"C\\\":\\\"Foreign aid\\\",\\\"D\\\":\\\"Lottery income\\\"},{\\\"A\\\":\\\"Amazon\\\",\\\"B\\\":\\\"Nile\\\",\\\"C\\\":\\\"Ganges\\\",\\\"D\\\":\\\"Yangtze\\\"},{\\\"A\\\":\\\"A king rules the country\\\",\\\"B\\\":\\\"A military leader controls the government\\\",\\\"C\\\":\\\"People elect their representatives\\\",\\\"D\\\":\\\"Religious leaders make all decisions\\\"},{\\\"A\\\":\\\"Biology\\\",\\\"B\\\":\\\"Sociology\\\",\\\"C\\\":\\\"Geology\\\",\\\"D\\\":\\\"Astronomy\\\"},{\\\"A\\\":\\\"Solar energy\\\",\\\"B\\\":\\\"Wind energy\\\",\\\"C\\\":\\\"Coal\\\",\\\"D\\\":\\\"Hydropower\\\"}]\"', '\"[\\\"B\\\",\\\"B\\\",\\\"C\\\",\\\"B\\\",\\\"C\\\"]\"', '\"[\\\"1\\\",\\\"1\\\",\\\"1\\\",\\\"1\\\",\\\"1\\\"]\"', 'active', '2025-12-02 22:39:30', '2025-12-02 22:39:30'),
(16, 'Maths', 'Unit Test', 'Second - B', 'Maths Exam...', '20', '\"[\\\"qwertyuiop\\\",\\\"zxdftrghtruynj\\\"]\"', '\"[{\\\"A\\\":\\\"went\\\",\\\"B\\\":\\\"goes\\\",\\\"C\\\":\\\"gone\\\",\\\"D\\\":\\\"is going\\\"},{\\\"A\\\":\\\"Tissue\\\",\\\"B\\\":\\\"Metaphor\\\",\\\"C\\\":\\\"Organ\\\",\\\"D\\\":\\\"Molecule\\\"}]\"', '\"[\\\"A\\\",\\\"C\\\"]\"', '\"[\\\"1\\\",\\\"1\\\"]\"', 'active', '2025-12-02 23:05:40', '2025-12-02 23:05:40'),
(20, 'PHP', 'Quarterly Examination', 'Third - C', 'php', '30', '\"[\\\"Which of the following is the correct way to start a PHP block?\\\",\\\"What does PHP stand for?\\\",\\\"Which of the following is used to output data in PHP?\\\"]\"', '\"[{\\\"A\\\":\\\"<php>\\\",\\\"B\\\":\\\"<?php\\\",\\\"C\\\":\\\"<?\\\",\\\"D\\\":\\\"<script>\\\"},{\\\"A\\\":\\\"Personal Home Page\\\",\\\"B\\\":\\\"Private Hypertext Processor\\\",\\\"C\\\":\\\"Preprocessed Hypertext Page\\\",\\\"D\\\":\\\"Programming Hypertext Processor\\\"},{\\\"A\\\":\\\"echo\\\",\\\"B\\\":\\\"printout\\\",\\\"C\\\":\\\"display\\\",\\\"D\\\":\\\"write\\\"}]\"', '\"[\\\"B\\\",\\\"A\\\",\\\"A\\\"]\"', '\"[\\\"2\\\",\\\"2\\\",\\\"2\\\"]\"', 'active', '2025-12-04 10:29:09', '2025-12-04 10:29:09'),
(21, 'Chemistry', 'Quarterly Examination', 'Third - C', 'chemistry', '30', '\"[\\\"Which of the following is a noble gas?\\\",\\\"What is the chemical formula of sulfuric acid?\\\",\\\"Which particle has a negative charge?\\\"]\"', '\"[{\\\"A\\\":\\\"Oxygen\\\",\\\"B\\\":\\\"Nitrogen\\\",\\\"C\\\":\\\"Argon\\\",\\\"D\\\":\\\"Hydrogen\\\"},{\\\"A\\\":\\\"HCl\\\",\\\"B\\\":\\\"H\\\\u2082SO\\\\u2084\\\",\\\"C\\\":\\\"HNO\\\\u2083\\\",\\\"D\\\":\\\"H\\\\u2082CO\\\\u2083\\\"},{\\\"A\\\":\\\"Proton\\\",\\\"B\\\":\\\"Neutron\\\",\\\"C\\\":\\\"Electron\\\",\\\"D\\\":\\\"Positron\\\"}]\"', '\"[\\\"C\\\",\\\"B\\\",\\\"C\\\"]\"', '\"[\\\"2\\\",\\\"2\\\",\\\"2\\\"]\"', 'active', '2025-12-04 10:37:30', '2025-12-04 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `exam_attempts`
--

CREATE TABLE `exam_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `started_at` timestamp NULL DEFAULT current_timestamp(),
  `submitted_at` timestamp NULL DEFAULT current_timestamp(),
  `answers` longtext NOT NULL,
  `total_marks` int(11) NOT NULL DEFAULT 0,
  `obtained_marks` int(11) NOT NULL DEFAULT 0,
  `percentage` float NOT NULL DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_attempts`
--

INSERT INTO `exam_attempts` (`id`, `student_id`, `exam_id`, `started_at`, `submitted_at`, `answers`, `total_marks`, `obtained_marks`, `percentage`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 9, '2025-11-30 08:16:35', '2025-11-30 08:21:03', '', 5, 5, 100, 'completed', '2025-11-30 08:16:35', '2025-11-30 08:21:03'),
(3, 1, 7, '2025-12-02 00:03:52', '2025-12-02 00:03:56', '', 1, 1, 100, 'completed', '2025-12-02 00:03:52', '2025-12-02 00:03:56'),
(5, 1, 12, '2025-12-02 00:08:27', '2025-12-02 00:08:37', '', 4, 2, 50, 'completed', '2025-12-02 00:08:27', '2025-12-02 00:08:37'),
(7, 1, 10, '2025-12-02 07:04:04', '2025-12-02 07:05:03', '', 12, 8, 66.67, 'completed', '2025-12-02 07:04:04', '2025-12-02 07:05:03'),
(9, 3, 16, '2025-12-02 23:05:53', '2025-12-02 23:06:02', '[\"C\",\"C\"]', 2, 1, 50, 'completed', '2025-12-02 23:05:53', '2025-12-02 23:06:02'),
(10, 6, 17, '2025-12-04 08:09:22', '2025-12-04 08:24:55', '[\"B\"]', 2, 2, 100, 'completed', '2025-12-04 08:09:22', '2025-12-04 08:24:55'),
(11, 6, 20, '2025-12-04 10:30:19', '2025-12-04 10:30:36', '[\"B\",\"D\",\"A\"]', 6, 4, 66.6667, 'completed', '2025-12-04 10:30:19', '2025-12-04 10:30:36'),
(12, 6, 21, '2025-12-04 10:37:46', '2025-12-04 10:38:02', '[\"C\",\"C\",\"B\"]', 6, 2, 33.3333, 'completed', '2025-12-04 10:37:46', '2025-12-04 10:38:02');

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
(5, '2025_11_14_041307_create_admins_table', 1),
(6, '2025_11_15_053018_create_stud__classes_table', 2),
(7, '2025_11_15_094850_create_subjects_table', 3),
(8, '2025_11_15_123231_create_students_table', 4),
(9, '2025_11_15_133421_create_results_table', 5),
(10, '2025_11_16_113639_create_notices_table', 6),
(11, '2025_11_17_000000_create_exams_table', 7),
(12, '2025_11_18_000000_create_exam_attempts_table', 8),
(13, '2025_11_27_050802_add_exam_details_to_exams_table', 8),
(14, '2025_11_28_044839_create_exam_attempts_table', 9),
(15, '2025_11_29_045739_create_exam_attempts_table', 10),
(16, '2025_11_29_051203_create_exam_attempts_table', 11),
(17, '2025_11_29_051430_create_exam_attempts_table', 12),
(18, '2025_11_29_054259_create_exam_attempts_table', 13),
(19, '2025_11_30_114801_create_exam_attempts_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `description`, `issue_date`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(11, 'First', 'Holiday', '2025-11-22', '2025-11-22', 'Inactive', '2025-11-21 05:14:48', '2025-11-20 23:57:53'),
(13, 'Second', 'Holiday', '2025-11-22', '2025-11-26', '1', '2025-11-21 05:31:07', '2025-11-21 05:31:07');

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
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roll_no` int(11) NOT NULL,
  `stud_name` text NOT NULL,
  `class_name` text NOT NULL,
  `subject_name` text NOT NULL,
  `mark_obtained` text NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `roll_no`, `stud_name`, `class_name`, `subject_name`, `mark_obtained`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'User', 'First - A', 'English, Social Science', '80, 78', 'declared', '2025-11-19 05:37:59', '2025-11-20 04:59:20'),
(4, 3, 'demo', 'Second - B', 'Chemistry, Maths, Science', '70, 90, 82', 'Declared', '2025-11-20 00:20:14', '2025-11-20 22:42:21'),
(6, 2, 'Test', 'First - A', 'English, Social Science', '30, 40', 'Pending', '2025-11-21 00:07:03', '2025-11-21 00:14:01'),
(7, 1, 'Vidhi', 'Third - C', 'Chemistry, PHP', '40, 20', 'Declared', '2025-12-04 10:52:26', '2025-12-04 10:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roll_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `roll_no`, `name`, `class`, `email`, `phone`, `DOB`, `gender`, `created_at`, `updated_at`) VALUES
(1, '1', 'User', '3', 'user@gmail.com', '7383685044', '2004-01-02', 'Male', '2025-11-15 13:17:13', '2025-11-15 13:17:13'),
(2, '2', 'Test', '3', 'test@gmail.com', '8674567890', '2004-07-12', 'Female', '2025-11-15 14:14:03', '2025-11-15 14:14:03'),
(3, '3', 'demo', '4', 'demo@gmail.com', '8047586955', '2020-02-20', 'Male', '2025-11-20 05:31:07', '2025-12-02 00:24:22'),
(5, '1', 'meera', '4', 'meera@gmail.com', '8458394094', '2008-04-04', 'Female', '2025-12-02 11:26:19', '2025-12-02 05:57:52'),
(6, '1', 'Vidhi', '5', 'v@gmail.com', '8000596244', '2004-07-07', 'Female', '2025-12-04 12:28:51', '2025-12-04 12:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `stud_class`
--

CREATE TABLE `stud_class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `section` text NOT NULL,
  `academic_year` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stud_class`
--

INSERT INTO `stud_class` (`id`, `name`, `section`, `academic_year`, `created_at`, `updated_at`) VALUES
(3, 'First', 'A', '2025 - 2026', '2025-11-15 06:11:00', '2025-11-15 11:25:17'),
(4, 'Second', 'B', '2026 - 2027', '2025-11-15 11:26:16', '2025-11-15 11:26:16'),
(5, 'Third', 'C', '2025 - 2026', '2025-11-20 05:15:35', '2025-11-19 23:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_code` int(11) NOT NULL,
  `name` text NOT NULL,
  `assign_class` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `sub_code`, `name`, `assign_class`, `created_at`, `updated_at`) VALUES
(3, 101, 'English', '3', '2025-11-15 13:12:42', '2025-11-15 13:12:42'),
(4, 102, 'Maths', '4', '2025-11-15 13:13:03', '2025-11-15 13:13:03'),
(5, 104, 'Science', '4', '2025-11-17 04:30:49', '2025-11-17 04:30:49'),
(6, 105, 'Social Science', '3', '2025-11-17 04:31:39', '2025-11-17 04:31:39'),
(7, 106, 'Chemistry', '5', '2025-11-20 05:22:12', '2025-12-04 10:33:58'),
(8, 108, 'PHP', '5', '2025-12-04 12:26:06', '2025-12-04 12:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_attempts`
--
ALTER TABLE `exam_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stud_class`
--
ALTER TABLE `stud_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `exam_attempts`
--
ALTER TABLE `exam_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stud_class`
--
ALTER TABLE `stud_class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
