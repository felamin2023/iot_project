-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 08:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iot_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensor_data`
--

CREATE TABLE `sensor_data` (
  `id` int(11) NOT NULL,
  `temperature` float DEFAULT NULL,
  `humidity` float DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensor_data`
--

INSERT INTO `sensor_data` (`id`, `temperature`, `humidity`, `timestamp`) VALUES
(833, 31.4, 78, '2025-04-12 07:24:17'),
(834, 31.4, 78, '2025-04-12 07:25:20'),
(835, 31.4, 78, '2025-04-12 07:26:17'),
(836, 31.3, 78, '2025-04-12 07:27:17'),
(837, 33, 73, '2025-04-12 07:28:17'),
(838, 32, 76, '2025-04-12 07:29:17'),
(839, 35.8, 67, '2025-04-12 07:30:19'),
(840, 33.1, 73, '2025-04-12 07:31:17'),
(841, 32, 76, '2025-04-12 07:32:20'),
(842, 31.7, 77, '2025-04-12 07:33:20'),
(843, 31.5, 77, '2025-04-12 07:34:17'),
(844, 31.5, 78, '2025-04-12 07:35:20'),
(845, 31.5, 78, '2025-04-12 07:36:17'),
(846, 31.4, 80, '2025-04-12 18:52:14'),
(847, 31.6, 79, '2025-04-12 18:53:13'),
(848, 31.7, 78, '2025-04-12 18:54:14'),
(849, 31.7, 77, '2025-04-12 18:55:13'),
(850, 31.7, 78, '2025-04-12 18:56:13'),
(851, 31.8, 78, '2025-04-12 18:57:13'),
(852, 31.9, 78, '2025-04-12 18:58:13'),
(853, 32, 78, '2025-04-12 18:59:13'),
(854, 31.9, 78, '2025-04-12 19:00:51'),
(855, 32, 77, '2025-04-12 19:01:51'),
(856, 31.9, 77, '2025-04-12 19:02:51'),
(857, 32, 77, '2025-04-12 19:03:51'),
(858, 32, 77, '2025-04-12 19:04:51'),
(859, 32, 77, '2025-04-12 19:05:51'),
(860, 32, 77, '2025-04-12 19:06:51'),
(861, 32, 76, '2025-04-12 19:07:51'),
(862, 32, 76, '2025-04-12 19:08:51'),
(863, 32.1, 76, '2025-04-12 19:11:09'),
(864, 32.1, 76, '2025-04-12 19:12:09'),
(865, 36.1, 67, '2025-04-12 19:13:09'),
(866, 34.2, 74, '2025-04-12 19:14:09'),
(867, 33.8, 71, '2025-04-12 19:15:09'),
(868, 33, 73, '2025-04-12 19:16:09'),
(869, 32.5, 75, '2025-04-12 19:17:09'),
(870, 32.5, 75, '2025-04-12 20:13:59'),
(871, 38.3, 67, '2025-04-12 20:14:59'),
(872, 39.2, 59, '2025-04-12 20:15:59'),
(873, 35.8, 66, '2025-04-12 20:16:59'),
(874, 34.4, 68, '2025-04-12 20:17:59'),
(875, 33.8, 71, '2025-04-12 20:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 7517, 'jovanie', 'felamin', 'jovanie@gmail.com', '$2y$10$w7tDM2UzHl4YEGf8kKOw7.FILm8HBq9.5Uh1Alk.o5eouhYoy5xN.'),
(2, 65863, 'Gabriel', 'Villahermosa', 'gvillahermisa@gmail.com', '$2y$10$K2BD/QeezFEShgXtSduVNeMX0sCbAwWvF0VQvzLmXKZ7WFhSjPD1O');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensor_data`
--
ALTER TABLE `sensor_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=876;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
