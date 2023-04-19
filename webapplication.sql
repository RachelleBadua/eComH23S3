-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 07:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapplication`
--
CREATE DATABASE IF NOT EXISTS `webapplication` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webapplication`;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `name`, `street`, `city`, `province`, `postal`) VALUES
(1, 'Saint-Laurent', '821 Ste-Croix', 'St-Laurent', 'Qc', 'H4L 3X9'),
(3, 'Laval', '123 Laval', 'Laval', 'Qc', 'H2T 4B3');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `first_name`, `last_name`, `middle_name`) VALUES
(3, 'Rachelle', 'Badua', 'hehe');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender`, `receiver`, `message`, `timestamp`) VALUES
(2, 7, 3, 'haluu', '2023-02-22 14:42:51'),
(3, 7, 5, 'banana', '2023-02-22 14:43:08'),
(4, 7, 6, 'hello sir mubeen', '2023-02-22 15:22:36'),
(5, 6, 7, 'wake up jennifer', '2023-02-22 16:53:06'),
(6, 5, 6, 'hi', '2023-02-22 16:54:38'),
(7, 5, 6, 'wanna play?', '2023-02-22 16:54:52'),
(8, 7, 6, 'hehe', '2023-03-28 15:34:50'),
(9, 7, 6, 'twice concert!!', '2023-04-19 16:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `profile_information`
--

DROP TABLE IF EXISTS `profile_information`;
CREATE TABLE `profile_information` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `picture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_information`
--

INSERT INTO `profile_information` (`user_id`, `first_name`, `last_name`, `middle_name`, `picture`) VALUES
(5, 'mert', '', 'banana', ''),
(6, 'mubeen', '', 'bing chilling', ''),
(7, 'rache', 'joyce', 'imposter', '7-640d5587414ba.jpg'),
(9, 'mae', 'badua', 'justine', '9-640d634a88ab1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `datetime` datetime NOT NULL,
  `client_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `description`, `datetime`, `client_id`, `branch_id`) VALUES
(2, 'therapy', '2023-04-27 14:15:00', 3, 1),
(4, 'graduation!!', '2024-05-14 14:51:00', 3, 1),
(5, 'dentist ', '2023-05-09 20:00:00', 3, 3),
(6, 'hehe', '2023-05-16 15:33:00', 3, 1),
(7, 'hihi', '2023-05-05 15:05:00', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(72) NOT NULL,
  `secret_key` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password_hash`, `secret_key`) VALUES
(1, 'bana', '$2y$10$n8o252RdegdLKtZLBi0/RemEEYV9fQGruC1pRlQYiD1SRK.D5vx2y', ''),
(3, 'miso', '$2y$10$3YO3ksmM8zQDbYHCaLNhfu.8FTK.91SnZDKffN3HTOfGEf4vZY9Ia', ''),
(5, 'mert', '$2y$10$/Rm940OasJjfnFj1HShJne4Beo/TVWaX4y3MES9sOs46aw8KG7C5S', ''),
(6, 'mubeen', '$2y$10$SBuoT8m79xyEiaYOtC.HPOTc49inS072RViPRVgzqIWgjB2LmoxLm', ''),
(7, 'rachelle', '$2y$10$Yluee21AnNb15fAhJ45jA.2OOZwxzgBcRz7wOW3AZ31nAzHdO.cku', 'YMDW6BMFKO67HWJ7'),
(8, 'todelete', '$2y$10$/Rm940OasJjfnFj1HShJne4Beo/TVWaX4y3MES9sOs46aw8KG7C5S', ''),
(9, 'Mae', '$2y$10$PGtbdKt4DqlnsNCazk0zbeJbf17Itea2V0tVFUQL.fJZbL0w717hm', ''),
(10, 't1', '$2y$10$z6Fh1z.U4Sxkl3L3C/RbVOsZAivYhhTxk5gpR3JYDibQw41Ut0UTq', 'SXWAY3Z'),
(11, 'hehehe', '$2y$10$Yluee21AnNb15fAhJ45jA.2OOZwxzgBcRz7wOW3AZ31nAzHdO.cku', 'VETKADX');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `message_to_sender` (`sender`),
  ADD KEY `message_to_receiver` (`receiver`);

--
-- Indexes for table `profile_information`
--
ALTER TABLE `profile_information`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `service_to_client` (`client_id`),
  ADD KEY `service_to_branch` (`branch_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_to_receiver` FOREIGN KEY (`receiver`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `message_to_sender` FOREIGN KEY (`sender`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `profile_information`
--
ALTER TABLE `profile_information`
  ADD CONSTRAINT `profile_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_to_branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `service_to_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
