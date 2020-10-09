-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2020 at 11:45 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE `header` (
  `id` int(11) NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_banner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id`, `logo`, `title_logo`, `banner`, `title_banner`, `created_at`, `updated_at`) VALUES
(1, 'http://localhost/blogci4/public/home/assets/images/icons/1602165944_d9849e5b471bc4c9b06d.png', 'logo', 'http://localhost/blogci4/public/home/assets/images/icons/1602165944_a7c917b1f4e0f62f3f87.jpg', 'banner', '2020-10-08 20:43:56', '2020-10-08 21:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `facebook` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gmail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `appid_fb` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `appsecret_fb` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `appid_gg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `appsecret_gg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `facebook`, `twitter`, `gmail`, `youtube`, `appid_fb`, `appsecret_fb`, `appid_gg`, `appsecret_gg`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/bao.nguyenquang.9803', '', 'jinnkeyxx@gmail.com', 'https:/youtube.com', '2694749200773324', '8a7c03b03881a5f4bfa4867748f00553', '305807645594-rajse06sd3it4673bqkuilqffvvs9dsf.apps.googleusercontent.com', '3i6EdbiIjM2aDi1TcagHCxPp', '2020-10-08 20:43:22', '2020-10-08 20:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ICBM` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `description`, `region`, `copyright`, `author`, `position`, `ICBM`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Quang Bảo', 'Nguyễn Quang Bảo', 'Nguyễn Quang Bảo', 'Nguyễn Quang Bảo', 'Nguyễn Quang Bảo', 'Nguyễn Quang Bảo', '2020-10-08 20:44:15', '2020-10-08 21:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Nguyễn Quang Bảo', 'admin123', 'jinnkeyxx@gmail.com', '$2y$10$LPxsj67PcoIGMYMtDFPJ/ukQ9OhDnDbQeq1pv9Y8kqpfv81xtZCgO', 0, '2020-10-08 20:55:20', '2020-10-08 20:55:20'),
(3, 'Nguyễn Quang Bảo', 'jinnkeyxx@gmail.com', 'jinnkeyxx@gmail.com', '$2y$10$zax.2./iEk7bkWmHarOi2eLJC5gkKB7.YwFvm/42W6I5SNDAH49ce', 1, '2020-10-08 21:21:37', '2020-10-08 21:21:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `header`
--
ALTER TABLE `header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
