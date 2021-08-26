-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2021 at 04:25 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fkorom`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `active` int(2) NOT NULL DEFAULT 1,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `date`, `time`, `code`, `active`, `userid`) VALUES
(17, '2021-07-11', '16:26:00', 'DokWkvLxnX', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `dentist_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`dentist_id`, `appointment_id`) VALUES
(8, 17);

-- --------------------------------------------------------

--
-- Table structure for table `dentists`
--

CREATE TABLE `dentists` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `specialization` text NOT NULL,
  `picture` varchar(300) DEFAULT 'images/team-1.jpg',
  `working_end` time DEFAULT NULL,
  `working_start` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dentists`
--

INSERT INTO `dentists` (`id`, `name`, `specialization`, `picture`, `working_end`, `working_start`) VALUES
(8, 'Dr Nagy Viktor', 'Szia', NULL, '22:40:00', '16:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `dentist_service`
--

CREATE TABLE `dentist_service` (
  `dentist_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dentist_service`
--

INSERT INTO `dentist_service` (`dentist_id`, `service_id`) VALUES
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `length`, `price`, `name`) VALUES
(1, 60, 60, 'Kuplungcsere'),
(2, 30, 150, 'Váltócsere');

-- --------------------------------------------------------

--
-- Table structure for table `threament`
--

CREATE TABLE `threament` (
  `id` int(11) NOT NULL,
  `threatment` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `picture` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `threament`
--

INSERT INTO `threament` (`id`, `threatment`, `price`, `picture`) VALUES
(1, 'Kuplungcsere', 20, NULL),
(3, 'Váltócsere', 90, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `code` varchar(40) CHARACTER SET utf8 NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` int(2) NOT NULL DEFAULT 0,
  `new_password` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `new_password_expires` datetime DEFAULT NULL,
  `user_type` int(11) NOT NULL,
  `allow_picture` int(11) DEFAULT 0,
  `negative_points` int(11) DEFAULT NULL,
  `phone` varchar(40) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `firstname`, `lastname`, `password`, `email`, `code`, `registration_expires`, `active`, `new_password`, `new_password_expires`, `user_type`, `allow_picture`, `negative_points`, `phone`) VALUES
(8, 'Nagy', 'Viktorqwe', '$2y$10$EW1uI5IeNgeo4r.wpm1zuOdHv8MSN.ZGhVv1KE24DO2ppakTrhaaC', 'vktrnagy63@gmail.com', 'NwruyrudSwmnyprxRuzuktitSytqybhrZixkhrnp', '2021-07-08 15:51:00', 1, NULL, NULL, 1, 0, NULL, 'asd'),
(9, 'Heni', 'Baba', 'asd', 'heni@ad.com', 'asd', '2021-07-09 16:08:49', 1, NULL, '2021-07-09 16:08:49', 2, 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_threatment`
--

CREATE TABLE `user_threatment` (
  `user_id` int(11) NOT NULL,
  `threatment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_threatment`
--

INSERT INTO `user_threatment` (`user_id`, `threatment_id`) VALUES
(9, 1),
(9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `ID` int(11) NOT NULL,
  `user_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`ID`, `user_type`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'dentist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD KEY `Appointment` (`appointment_id`),
  ADD KEY `DentistApp` (`dentist_id`);

--
-- Indexes for table `dentists`
--
ALTER TABLE `dentists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dentist_service`
--
ALTER TABLE `dentist_service`
  ADD KEY `Dentist` (`dentist_id`),
  ADD KEY `Service` (`service_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `threament`
--
ALTER TABLE `threament`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `threatment` (`threatment`),
  ADD UNIQUE KEY `threatment_2` (`threatment`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `User_type` (`user_type`);

--
-- Indexes for table `user_threatment`
--
ALTER TABLE `user_threatment`
  ADD KEY `User` (`user_id`),
  ADD KEY `Threatment` (`threatment_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `threament`
--
ALTER TABLE `threament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `Appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`),
  ADD CONSTRAINT `DentistApp` FOREIGN KEY (`dentist_id`) REFERENCES `dentists` (`id`);

--
-- Constraints for table `dentist_service`
--
ALTER TABLE `dentist_service`
  ADD CONSTRAINT `Dentist` FOREIGN KEY (`dentist_id`) REFERENCES `dentists` (`id`),
  ADD CONSTRAINT `Service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `User_type` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`ID`);

--
-- Constraints for table `user_threatment`
--
ALTER TABLE `user_threatment`
  ADD CONSTRAINT `Threatment` FOREIGN KEY (`threatment_id`) REFERENCES `threament` (`id`),
  ADD CONSTRAINT `User` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
