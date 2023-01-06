-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2023 at 01:38 PM
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
  `device_name` varchar(55) NOT NULL,
  `user_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `device_name`, `user_fk`) VALUES
(1, 'Toaster', 22),
(2, 'Refrigerator', 22),
(3, 'Television', 22),
(4, 'Computer', 22),
(5, 'Microwave', 22);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `type` enum('SMS','EMAIL','WEB','') NOT NULL,
  `notification_message` varchar(150) NOT NULL,
  `power_fk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`type`, `notification_message`, `power_fk`) VALUES
('WEB', 'Warning Power exceeded beyond the threshold value.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `power`
--

CREATE TABLE `power` (
  `power_id` int(5) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `current` float NOT NULL,
  `temperature` int(2) NOT NULL,
  `device_fk` int(4) NOT NULL,
  `zone_fk` int(4) NOT NULL,
  `user_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `power`
--

INSERT INTO `power` (`power_id`, `date_time`, `current`, `temperature`, `device_fk`, `zone_fk`, `user_fk`) VALUES
(1, '2023-01-05 02:42:55', 0.7, 28, 2, 3, 22),
(2, '2023-01-06 03:52:27', 0.2, 32, 4, 2, 22),
(3, '2023-01-06 03:52:39', 0.8, 30, 5, 3, 22),
(4, '2023-01-06 03:52:51', 0.4, 32, 1, 3, 22),
(5, '2023-01-06 03:53:02', 0.2, 34, 3, 2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `threshold`
--

CREATE TABLE `threshold` (
  `threshold_id` int(4) NOT NULL,
  `threshold_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(22, 'Lahiru', 'Lahiru', 'lahiru@abc.lk', '4be30d9814c6d4e9800e0d2ea9ec9fb00efa887b', '0768319182', 0, '2022-12-21 04:56:48', '2022-12-21 04:56:48'),
(23, 'Mark Perera', 'mark', 'mark@crystal.info', '50360551b49f1181e06c8244402634838c1e1a99', '071111100', 0, '2022-12-22 04:45:14', '2022-12-22 04:45:14');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `zone_id` int(4) NOT NULL,
  `zone_name` varchar(50) NOT NULL,
  `user_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`zone_id`, `zone_name`, `user_fk`) VALUES
(1, 'Bedroom', 22),
(2, 'Living Room', 22),
(3, 'Kitchen', 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `user_fk` (`user_fk`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`type`),
  ADD KEY `power_fk` (`power_fk`);

--
-- Indexes for table `power`
--
ALTER TABLE `power`
  ADD PRIMARY KEY (`power_id`),
  ADD KEY `device_fk` (`device_fk`),
  ADD KEY `zone_fk` (`zone_fk`),
  ADD KEY `user_fk` (`user_fk`);

--
-- Indexes for table `threshold`
--
ALTER TABLE `threshold`
  ADD PRIMARY KEY (`threshold_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`zone_id`),
  ADD KEY `user_fk` (`user_fk`);

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
  MODIFY `power_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `threshold`
--
ALTER TABLE `threshold`
  MODIFY `threshold_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `zone_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `device_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`power_fk`) REFERENCES `power` (`power_id`) ON UPDATE CASCADE;

--
-- Constraints for table `power`
--
ALTER TABLE `power`
  ADD CONSTRAINT `power_ibfk_1` FOREIGN KEY (`device_fk`) REFERENCES `device` (`device_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `power_ibfk_2` FOREIGN KEY (`zone_fk`) REFERENCES `zone` (`zone_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `power_ibfk_3` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `zone`
--
ALTER TABLE `zone`
  ADD CONSTRAINT `zone_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
