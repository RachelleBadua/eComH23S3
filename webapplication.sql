-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 06:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender`, `receiver`, `message`, `timestamp`) VALUES
(2, 7, 3, 'haluu', '2023-02-22 14:42:51'),
(3, 7, 5, 'banana', '2023-02-22 14:43:08'),
(4, 7, 6, 'hello sir mubeen', '2023-02-22 15:22:36'),
(5, 6, 7, 'wake up jennifer', '2023-02-22 16:53:06'),
(6, 5, 6, 'hi', '2023-02-22 16:54:38'),
(7, 5, 6, 'wanna play?', '2023-02-22 16:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `profile_information`
--

DROP TABLE IF EXISTS `profile_information`;
CREATE TABLE `profile_information` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_information`
--

INSERT INTO `profile_information` (`user_id`, `first_name`, `last_name`, `middle_name`) VALUES
(5, 'mert', '', 'banana'),
(6, 'mubeen', '', 'bing chilling'),
(7, 'rache', 'xd', 'imposter');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password_hash`) VALUES
(1, 'bana', '$2y$10$n8o252RdegdLKtZLBi0/RemEEYV9fQGruC1pRlQYiD1SRK.D5vx2y'),
(3, 'miso', '$2y$10$3YO3ksmM8zQDbYHCaLNhfu.8FTK.91SnZDKffN3HTOfGEf4vZY9Ia'),
(5, 'mert', '$2y$10$/Rm940OasJjfnFj1HShJne4Beo/TVWaX4y3MES9sOs46aw8KG7C5S'),
(6, 'mubeen', '$2y$10$SBuoT8m79xyEiaYOtC.HPOTc49inS072RViPRVgzqIWgjB2LmoxLm'),
(7, 'rachelle', '$2y$10$8thvR6U1LYg/IveJBOwVPu1f6hprN6VBPwPJ6U/dDZw5Z5/g0WgHq'),
(8, 'todelete', '$2y$10$/Rm940OasJjfnFj1HShJne4Beo/TVWaX4y3MES9sOs46aw8KG7C5S');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
