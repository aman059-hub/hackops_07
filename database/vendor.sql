-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2026 at 01:10 PM
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
-- Database: `vendorbridge`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Procurement','Vendor','Manager') NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `otp` varchar(10) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role`, `status`, `created_at`, `otp`, `email_verified`, `photo`) VALUES
(1, 'akshraj', 'akshrajsinhsolanki2004@gmail.com', '$2y$10$vO/XlMflEPWHNaYq83FXGe0sQX16nHv0B4oeu/8bfnlJxDgNMP5y2', 'Admin', 'Active', '2026-06-06 05:49:44', NULL, 1, NULL),
(12, 'aman', 'amanmca059@gmail.com', '$2y$10$YoDUJ685leJh2k.M0TQkcuATKEDIg2ozD5C8brFWSAQJOH47A5doS', 'Vendor', 'Active', '2026-06-06 10:13:34', '292901', 1, '1780740814_IMG20250320130446-1.jpg'),
(13, 'dharmik', 'dharmikjpatel0321@gmail.com', '$2y$10$XDfESKRZvYhd8aljqfGbtew3r.Awi3wEgpO2N/zDCaCiTuVlbCDVq', 'Procurement', 'Active', '2026-06-06 10:14:07', NULL, 1, '1780740847_akshu.jpg'),
(14, 'akshraj', 'akshrajsinhsolanki696@gmail.com', '$2y$10$NrjqpKytel1agPtBe/Ux3eW/ciw7YtUa73ColnZAGFbVhaT9B9R6.', 'Manager', 'Active', '2026-06-06 10:14:48', '625232', 1, '1780740888_IMG_20250320_165631.jpg');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
