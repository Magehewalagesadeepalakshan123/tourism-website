-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2026 at 07:16 AM
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
-- Database: `travel_lanka`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_phone` varchar(30) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `travel_date` date NOT NULL,
  `travellers` int(11) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `destination`, `travel_date`, `travellers`, `special_requests`, `status`, `created_at`) VALUES
(1, 18, 'lakshan', 'lakshansadeepa2003@gmail.com', '+94705626302', 'Sigiriya', '2026-09-19', 1, '', 'Cancelled', '2026-09-17 23:30:40'),
(2, 18, 'lakshan', 'lakshansadeepa2003@gmail.com', '+94705626302', 'Ella', '2026-09-22', 6, 'we wanto  go to   visit  the haputale station as well.', 'Completed', '2026-09-17 23:44:18'),
(3, 19, 'admin', 'admin@gmal.com', '+94705626302', 'Ella', '2026-09-22', 1, '', 'Pending', '2026-09-18 00:46:05'),
(4, 18, 'lakshan', 'lakshansadeepa2003@gmail.com', '+94705626302', 'Galle', '2026-09-30', 4, '', 'Pending', '2026-09-18 02:25:58'),
(5, 21, 'admin', 'admin@gmail.com', '+94705626302', 'Sigiriya', '2026-09-30', 1, '', 'Pending', '2026-09-18 05:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(30) DEFAULT 'Paid',
  `paid_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `user_id`, `amount`, `payment_method`, `payment_status`, `paid_at`) VALUES
(1, 2, 18, 150000.00, 'Bank Transfer', 'Paid', '2026-09-18 04:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`, `role`) VALUES
(17, 'isuru', 'isuru@gmail.com', '$2y$10$n7Zuuqxd/WFkM5VDhdIwgujmarKt2ckYHXz9lhm8f4jGiK7.ID8qe', '2026-09-17 12:23:56', 'user'),
(18, 'lakshan', 'lakshansadeepa2003@gmail.com', '$2y$10$eGHz.E55uPTE2ZjU6RbVCel/7a/K6j1THZ/4IRUzf1Vj6A9q2P3Wq', '2026-09-17 12:26:46', 'user'),
(21, 'admin', 'admin@gmail.com', '$2y$10$VU4q9K91jAdhDEAin7Tq4eo9kBGdwyDWves93/ZgQjt6uSmw7R5BS', '2026-09-18 00:52:18', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
