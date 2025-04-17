-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 06:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yalla_plant`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `description`, `city`, `area`, `image_path`, `created_at`) VALUES
(2, 'hffjfjf', 'kdfkvmfkf', 'كربلاء', 'طوريج', 'uploads/campaigns/1744655144_photo_2024-11-10_11-06-57.jpg', '2025-04-14 18:25:44'),
(3, 'شمه', 'شمه', 'كربلاء', 'فريحه', 'uploads/campaigns/1744656934_CS1 INT.png', '2025-04-14 18:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_registrations`
--

CREATE TABLE `campaign_registrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaign_registrations`
--

INSERT INTO `campaign_registrations` (`id`, `user_id`, `campaign_id`, `registered_at`) VALUES
(1, 6, 2, '2025-04-15 03:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `tree_type` varchar(100) DEFAULT NULL,
  `donated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `user_id`, `city`, `tree_type`, `donated_at`) VALUES
(1, 6, 'kerbala', 'Tree1', '2025-04-15 08:46:01'),
(2, 6, 'kerbala', 'Tree1', '2025-04-15 13:01:07'),
(3, 6, 'kerbala', 'Tree1', '2025-04-15 13:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `game_comments`
--

CREATE TABLE `game_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `commented_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_likes`
--

CREATE TABLE `game_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_posts`
--

CREATE TABLE `game_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_posts`
--

INSERT INTO `game_posts` (`id`, `user_id`, `image_path`, `description`, `created_at`) VALUES
(1, 6, 'uploads/game_posts/1744723581_CS1 INT.png', '7تعغغغ', '2025-04-15 13:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar_path` varchar(255) DEFAULT NULL,
  `water_drops` int(11) DEFAULT 25
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `country`, `city`, `created_at`, `avatar_path`, `water_drops`) VALUES
(2, 'ali', 'aliabbas@gmail.com', '$2y$10$Stj/MMXuIosZHdGZxzX8ueMyDTdO1S7lfOBYpY7QZdRsOAiKq6kq2', '55765776', 'العراق', 'البصرة', '2025-04-12 19:23:58', 'uploads/avatars/1744485838_i413761v2n1_cdp_output.png', 25),
(3, 'asd', 'asd@gmail.com', '$2y$10$.C.bT.5rNIBp/t/f8uzprufdW6JxWWwEpUV6eXkkGTRzjFV72Tv72', '4785755854', 'العراق', 'بغداد', '2025-04-13 04:10:24', 'uploads/avatars/1744517424_i413701v3n1_image-nss-3_5_2.png', 25),
(4, 'fgh', 'fgh@gmail.com', '$2y$10$jB53tiCheU9k9Du5CQWo4.oidFYhdXFbNQn7HIrBu8MDYWjvw8EVS', '56777', 'العراق', 'بغداد', '2025-04-13 04:18:56', 'uploads/avatars/1744517936_fb730240-faf9-4b6e-9834-32e311d38b24.png', 25),
(5, 'zxc', 'zxc@gmail.com', '$2y$10$RyzXVxlWkCBjxKfVJ6lbquYT/38RTWsvBq2z9yUw5/eSUHd0ErQZC', '467458', 'العراق', 'بغداد', '2025-04-13 12:14:01', 'uploads/avatars/1744546441_i413701v3n1_image-nss-3_5_2.png', 25),
(6, 'qwe', 'qwe@gmail.com', '$2y$10$/BJrwtpbnljnnWQYLqQTD.gPwbJR.MdHTVe6Gj/sZM11hndAW9UdC', '56766', 'العراق', 'بغداد', '2025-04-13 12:46:19', 'uploads/avatars/1744548379_i413701v3n1_image-nss-3_5_2.png', 25);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `user_id`, `city`, `campaign_id`, `joined_at`) VALUES
(3, 6, NULL, 3, '2025-04-14 19:46:49'),
(4, 6, NULL, 2, '2025-04-14 20:07:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign_registrations`
--
ALTER TABLE `campaign_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `campaign_id` (`campaign_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `game_comments`
--
ALTER TABLE `game_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `game_likes`
--
ALTER TABLE `game_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `game_posts`
--
ALTER TABLE `game_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `campaign_id` (`campaign_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campaign_registrations`
--
ALTER TABLE `campaign_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `game_comments`
--
ALTER TABLE `game_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_likes`
--
ALTER TABLE `game_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_posts`
--
ALTER TABLE `game_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaign_registrations`
--
ALTER TABLE `campaign_registrations`
  ADD CONSTRAINT `campaign_registrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `campaign_registrations_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `game_comments`
--
ALTER TABLE `game_comments`
  ADD CONSTRAINT `game_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `game_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `game_likes`
--
ALTER TABLE `game_likes`
  ADD CONSTRAINT `game_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `game_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `game_posts`
--
ALTER TABLE `game_posts`
  ADD CONSTRAINT `game_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD CONSTRAINT `volunteers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `volunteers_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
