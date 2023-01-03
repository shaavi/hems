-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 05:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `energy`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `device_id` int(4) NOT NULL,
  `device_name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `device_name`) VALUES
(1, 'Toaster'),
(2, 'Refrigerator'),
(3, 'Television'),
(4, 'Computer'),
(5, 'Microwave Oven');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `type` enum('SMS','EMAIL','WEB','') NOT NULL,
  `notification_message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`type`, `notification_message`) VALUES
('SMS', 'Power consumption exceeded threshold value at 2022/12/12 11:30 AM'),
('EMAIL', 'Power consumption exceeded threshold value at 2022/12/01 12:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `power`
--

CREATE TABLE `power` (
  `power_id` int(5) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `threshold_value` int(3) NOT NULL,
  `units` varchar(3) NOT NULL,
  `device_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `power`
--

INSERT INTO `power` (`power_id`, `date_time`, `threshold_value`, `units`, `device_id`) VALUES
(1, '2022-12-01 03:53:35', 30, 'kWh', 1),
(2, '2022-12-01 03:53:35', 30, 'kWh', 2),
(3, '2022-12-01 03:55:03', 30, 'kWh', 3),
(4, '2022-12-01 03:55:03', 30, 'kWh', 4),
(5, '2022-12-01 03:55:39', 30, 'kWh', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `mobile`, `isActive`, `created_at`, `updated_at`) VALUES
(22, 'Lahiru', 'admin', 'styleweelers@gmail.com', '4be30d9814c6d4e9800e0d2ea9ec9fb00efa887b', '0768319182', 0, '2022-12-21 04:56:48', '2022-12-21 04:56:48'),
(23, 'Mark Perera', 'mark', 'mark@crystal.info', '50360551b49f1181e06c8244402634838c1e1a99', '071111100', 0, '2022-12-22 04:45:14', '2022-12-22 04:45:14'),
(24, 'Lahiru Janaka Karunaratne', 'lahiru', 'lahiru92@zohomail.com', '7c3607b8e61bcf1944e9e8503a660f21f4b6f3f1', '0768319182', 0, '2022-12-31 05:58:21', '2022-12-31 05:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `zone_id` int(4) NOT NULL,
  `zone_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`zone_id`, `zone_name`) VALUES
(1, 'Bedroom'),
(2, 'Living Room'),
(3, 'Kitchen'),
(4, 'Dining');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `power`
--
ALTER TABLE `power`
  ADD PRIMARY KEY (`power_id`),
  ADD UNIQUE KEY `device_id` (`device_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `device_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `power`
--
ALTER TABLE `power`
  MODIFY `power_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `zone_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
