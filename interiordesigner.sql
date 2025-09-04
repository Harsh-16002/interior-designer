-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2025 at 06:06 AM
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
-- Database: `interiordesigner`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `main_heading` varchar(255) NOT NULL,
  `para1` text NOT NULL,
  `para2` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `main_heading`, `para1`, `para2`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Who are we', 'We propose and discuss design rules', 'We are a team of passionate interior designers creating spaces that are both stunning and functional. Combining creativity, innovation, and attention to detail, we transform homes, offices, and commercial spaces into inspiring environments. Every project is tailored to your vision, ensuring each space tells a unique story and enhances the way you live and work.', 'We are a team of passionate interior designers creating spaces that are both stunning and functional. Combining creativity, innovation, and attention to detail, we transform homes, offices, and commercial spaces into inspiring environments. Every project is tailored to your vision, ensuring each space tells a unique story and enhances the way you live and work.', 'uploads/nVxf2LAsvUItgEX4DK4HIKzlWVS7aZrhIPUGwF9y.jpg', '2025-08-10 13:58:45', '2025-08-20 07:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `admin_otps`
--

CREATE TABLE `admin_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `otp` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_otps`
--

INSERT INTO `admin_otps` (`id`, `user_id`, `otp`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 1, '451533', 0, '2025-08-15 06:51:25', '2025-08-15 06:51:25'),
(6, 1, '326889', 0, '2025-08-15 06:52:41', '2025-08-15 06:52:41'),
(7, 1, '299731', 1, '2025-08-15 10:04:52', '2025-08-15 10:05:28'),
(8, 1, '642920', 1, '2025-09-03 21:55:48', '2025-09-03 21:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `map` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `phone`, `address`, `email`, `map`, `created_at`, `updated_at`) VALUES
(1, '12345678', 'Shankar Nagar Raipur Chhattisgarh', 'ektaverma@example.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14873.694474909264!2d81.64097814922387!3d21.254692837225182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a28dd78297aa38d%3A0x7bea70bc4d68d085!2sPandri%2C%20Raipur%2C%20Chhattisgarh!5e0!3m2!1sen!2sin!4v1755227650034!5m2!1sen!2sin', '2025-09-04 04:05:19', '2025-09-04 04:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `projects_completed` varchar(255) NOT NULL,
  `happy_clients` varchar(255) NOT NULL,
  `awards_received` varchar(255) NOT NULL,
  `cup_of_coffee` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `projects_completed`, `happy_clients`, `awards_received`, `cup_of_coffee`, `created_at`, `updated_at`) VALUES
(1, '50', '54', '44', '65', '2025-08-13 05:54:23', '2025-08-15 00:16:51');

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
-- Table structure for table `header_contents`
--

CREATE TABLE `header_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `text` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `header_contents`
--

INSERT INTO `header_contents` (`id`, `logo`, `text`, `phone`, `address`, `email`, `created_at`, `updated_at`) VALUES
(1, 'uploads/S4hDkujBBlr0D4GBFd5Tf7doqy1JQRM5z3fPOg7J.png', 'call us for queries', 12345678, 'Shankar Nagar Raipur Chhattisgarhhh', 'ektaverma@example.com', '2025-09-04 04:05:59', '2025-09-04 04:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `herocontents`
--

CREATE TABLE `herocontents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slide_image` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `fblink` varchar(255) NOT NULL,
  `instralink` varchar(255) NOT NULL,
  `twitterlink` varchar(255) NOT NULL,
  `linkdinlink` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `herocontents`
--

INSERT INTO `herocontents` (`id`, `slide_image`, `heading`, `fblink`, `instralink`, `twitterlink`, `linkdinlink`, `created_at`, `updated_at`) VALUES
(3, 'uploads/cBdjCOo2NY5Sq9jQafTzFHjFkFZlXNJXXAA8r17D.jpg', 'Bringing Your Vision to Life with Innovative Interior Design', 'https://via.placeholder.com/150', 'https://via.placeholder.com/150', 'https://via.placeholder.com/150', 'https://via.placeholder.com/150', '2025-08-10 08:19:16', '2025-08-20 07:33:44'),
(6, 'uploads/Q9LyoKCJW2qkDbDVXSbCEcTorInUoAgoSzSotQCT.jpg', 'Crafting Beautiful, Functional Spaces for Modern Living', 'https://via.placeholder.com/150', 'https://via.placeholder.com/150', 'https://via.placeholder.com/150', 'https://via.placeholder.com/150', '2025-08-20 02:37:45', '2025-08-20 07:42:24'),
(8, 'uploads/6yHOCbSWoDmDQdBWAaSKzn8dbkIPYAw543YSAGD4.jpg', 'Creating Timeless Spaces That Tell Your Unique Story', 'https://via.placeholder.com/150', 'https://via.placeholder.com/150', 'https://via.placeholder.com/150', 'https://via.placeholder.com/150', '2025-08-20 07:38:23', '2025-08-20 07:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(4, '2025_08_07_112541_create_hero_contents_table', 1),
(6, '0001_01_01_000000_create_users_table', 2),
(7, '0001_01_01_000001_create_cache_table', 2),
(8, '0001_01_01_000002_create_jobs_table', 2),
(9, '2025_08_07_112641_create_header_contents_table', 2),
(10, '2025_08_08_035046_create_herocontents_table', 3),
(11, '2025_08_10_135433_create_about_table', 4),
(12, '2025_08_10_163517_create_why-us_table', 5),
(13, '2025_08_10_171002_create_projects_table', 6),
(14, '2025_08_11_041646_create_services_table', 7),
(15, '2025_08_13_054354_create_counters_table', 8),
(16, '2025_08_13_055034_create_counters_table', 9),
(17, '2025_08_13_112417_create_team_table', 10),
(18, '2025_08_13_120317_create_testimonials_table', 11),
(19, '2025_08_14_041117_create_subscribers_table', 12),
(20, '2025_08_15_031733_create_contact_table', 13),
(21, '2025_08_15_103713_create_subscribers_table', 14),
(22, '2025_08_15_110658_create_admin_otps_table', 15),
(23, '2025_08_15_114410_create_admin_otps_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `category`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Hall Designn', 'Interior', 'projects/NY2JfeBIiMsQRPcM18dfgvEFc4D8Cvw19aAtM9CP.jpg', '2025-08-10 22:17:47', '2025-08-20 02:51:11'),
(3, 'Restaurant Design', 'Restaurant Design', 'projects/X4dcnHhZPYAGdFBSl6O3TzksWmcTJRJEU92NnqEQ.jpg', '2025-08-10 22:31:41', '2025-08-10 22:38:09'),
(4, 'Study Room', 'Interior', 'projects/Cr8cnjvZZPIdNGhDlGwHSAo5cGd8VLWdOYKbi4uj.jpg', '2025-08-10 22:32:22', '2025-08-20 07:51:03'),
(5, 'Windows', 'Interior', 'projects/92nY0pvJwDtP55ZlKprguzeYzbeCLrSCetcyOrr5.jpg', '2025-08-10 22:32:35', '2025-08-20 07:51:14'),
(6, 'Living Room', 'Interior', 'projects/vvDevx6E0ipjMrsMcVQqK0NRSGOzWOAP4BFHtIC5.jpg', '2025-08-10 22:32:43', '2025-08-20 07:51:29'),
(7, 'Balcony', 'Interior', 'projects/TDTmhErGvAFCaGnD7wCRLg6SRiZ9eIKwYPiklkVF.jpg', '2025-08-10 22:32:50', '2025-08-20 07:51:42'),
(8, 'Windows', 'Interior', 'projects/JwEpSK1UZuuM2WmkkxM2L2poE10uiBwkUeuRi3ah.jpg', '2025-08-10 22:33:00', '2025-08-20 07:51:59'),
(9, 'Table', 'Interior', 'projects/1wAf1MI3shVxhTEK8e79bt6ux30ygirTjLlEslNM.jpg', '2025-08-10 22:33:06', '2025-08-20 07:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Interior Design', 'As you might expect of a company that began as a high-end interiors contractor, we pay strict attention.', 'projects/XY85zl3cwfPg8rfokZ29rypx8qdeGhjglFHAczmZ.png', '2025-08-12 23:56:00', '2025-08-12 23:56:00'),
(3, 'Office Design', 'Our commitment to exceptional quality has never wavered. To day ranks as one of the most highly-regarded construction', 'projects/PXTOUpaIcBw9Sjexm1jy1XY4FnPqjZYbAN5znDKE.png', '2025-08-13 00:50:02', '2025-08-13 00:50:02'),
(4, 'Home Design', 'Interdisciplinary architectural studio with cultural, residential and commercial projects built worldwide.', 'projects/DwxYNiyxe9LKomJbXUYmxNAX2ZdwlP60Y8CcbmY9.png', '2025-08-13 00:50:28', '2025-08-13 00:50:28'),
(5, 'Design drawing', 'Creating architectural and creative solutions to help people realize their vision and make them a reality.', 'projects/MmlX3qJ2mj1oD16ciNwg3HwSLIE7nLTHx9fACfRA.png', '2025-08-13 00:50:56', '2025-08-13 00:50:56');

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
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `seen` varchar(255) NOT NULL DEFAULT 'false',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `seen`, `created_at`, `updated_at`) VALUES
(2, 'admin@gmail.com', 'false', '2025-08-15 05:23:49', '2025-08-15 05:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `image`, `name`, `position`, `bio`, `facebook`, `instagram`, `twitter`, `created_at`, `updated_at`) VALUES
(1, 'team/m0jXKQLrcfNDwrJPxgZLVBe5fxoTFXP6HnSdOZZV.jpg', 'Dolores Webster', 'CEO & Founderrrr', 'Vestibulum dapibus odio quam, sit amet hendrerit dui ultricies consectetur. Ut viverra porta leo, non tincidunt mauris condimentum eget. Vivamus non turpis elit. Aenean ultricies nisl sit amet.', 'https://www.w3schools.com/php/php_mysql_insert.asp', 'https://www.w3schools.com/php/php_mysql_insert.asp', 'https://www.w3schools.com/php/php_mysql_insert.asp', '2025-08-13 06:21:11', '2025-08-13 06:28:10'),
(2, 'team/iCeFApxBIT4Mrq7MpORf3TqH2BLx5TlYG1pTtYmO.jpg', 'Dana Vaughn', 'Architect', 'Vestibulum dapibus odio quam, sit amet hendrerit dui ultricies consectetur. Ut viverra porta leo, non tincidunt mauris condimentum eget. Vivamus non turpis elit. Aenean ultricies nisl sit amet.', 'https://www.w3schools.com/php/php_mysql_insert.asp', 'https://www.w3schools.com/php/php_mysql_insert.asp', 'https://www.w3schools.com/php/php_mysql_insert.asp', '2025-08-13 06:21:54', '2025-08-13 06:21:54'),
(5, 'team/bESNkG2HnZ3ccPpYMSDeuF0e9jtLMWIjaKXhYZBd.jpg', 'Dolores Webster', 'CEO & Founderrrr', 'Assistant', 'https://www.w3schools.com/php/php_mysql_insert.asp', 'https://www.w3schools.com/php/php_mysql_insert.asp', 'https://www.w3schools.com/php/php_mysql_insert.asp', '2025-08-20 03:18:38', '2025-08-20 03:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `position`, `image`, `review`, `created_at`, `updated_at`) VALUES
(1, 'Reenee Calhoun', 'CEO & Founder', 'testimonials/UL76kogsBbUnISBRGa2Gl2A31N1IOZKvI1qEgKKa.png', 'The team understood my vision perfectly and delivered exactly what I had in mind. Their professionalism and creativity made the whole process smooth and enjoyable. I’m very satisfied with the results!', '2025-08-13 06:50:09', '2025-08-13 06:50:09'),
(2, 'Utkarsh', 'CEO', 'testimonials/VybcI1HRvQOyko4CmzParrvZzKTHvEvh7qkfpH5n.png', 'I had high expectations, and they exceeded them. The designers were patient, attentive, and provided valuable suggestions. The final result looked amazing and exactly matched my ideas.', '2025-08-13 09:35:55', '2025-08-13 09:35:55'),
(3, 'Vikram Singh', 'Supervisor', 'testimonials/scOmdCqjY7QiLXQCb2ytUgMsZBrgqJAgkSRZowbm.png', 'Working with them was seamless. Every step was well-coordinated, and they maintained excellent communication. The final output was detailed, polished, and truly impressive.', '2025-08-13 09:36:33', '2025-08-13 09:36:33'),
(4, 'Pooja Mehra', 'HR', 'testimonials/iM252lU3lNLJdDejYjlnDM6nEnOloshXtAkJHhDv.png', '–I loved how they transformed my rough ideas into a clear, elegant final product. They were thorough, communicative, and very skilled at what they do.', '2025-08-13 09:37:15', '2025-08-13 09:37:15'),
(7, 'Simran Kaur', 'Assistant', 'testimonials/ORkJw4Mokyxzre4uhorksYd5VUK1rwR8aAlhWNmw.png', 'yhjtyjtyjtyjtty', '2025-08-20 03:17:33', '2025-08-20 03:17:33');

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
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@example.com', NULL, '$2y$12$6o.H1mt399yHRTDxuQIKQuw6yywQnQOb9eVcJKmEZBwBd4d4osu2W', 'admin', NULL, '2025-09-03 22:22:58', '2025-09-03 22:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `why-us`
--

CREATE TABLE `why-us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `main_heading` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why-us`
--

INSERT INTO `why-us` (`id`, `title`, `main_heading`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Why choose us?', 'We create beautiful, functional spaces tailored to your style, vision, and everyday living needs.', 'uploads/aNEY9NonsL10ONP0qNnqbcDLCmbMhLpGBA6bPgxX.jpg', '2025-08-10 16:40:56', '2025-08-20 08:01:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_otps`
--
ALTER TABLE `admin_otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `header_contents`
--
ALTER TABLE `header_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `herocontents`
--
ALTER TABLE `herocontents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `why-us`
--
ALTER TABLE `why-us`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_otps`
--
ALTER TABLE `admin_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `header_contents`
--
ALTER TABLE `header_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `herocontents`
--
ALTER TABLE `herocontents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `why-us`
--
ALTER TABLE `why-us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
