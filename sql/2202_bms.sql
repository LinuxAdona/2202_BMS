-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 12:57 PM
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
-- Database: `2202_bms`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `house_number` varchar(20) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `barangay_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `house_number`, `street`, `barangay_id`) VALUES
(1, '101', 'ABC St.', 1),
(2, '102', 'BCD St.', 1),
(3, '103', 'CDE St.', 1),
(4, '104', 'DEF St.', 1),
(5, '105', 'EFG St.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `barangay_id` int(11) NOT NULL,
  `barangay_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`barangay_id`, `barangay_name`) VALUES
(1, 'Barangay Mabuhay');

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `family_id` int(11) NOT NULL,
  `family_name` varchar(100) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `family_head_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`family_id`, `family_name`, `address_id`, `family_head_id`) VALUES
(1, 'Dela Cruz', 1, 1),
(2, 'Santos', 2, 4),
(3, 'Gonzales', 3, 7),
(4, 'Lopez', 4, 10),
(5, 'Reyes', 5, 13),
(26, 'Torres', 1, 56),
(27, 'Torres', 1, 60),
(28, 'Mendoza', 2, 64),
(29, 'Mendoza', 2, 68),
(30, 'Castro', 3, 72);

-- --------------------------------------------------------

--
-- Table structure for table `family_head`
--

CREATE TABLE `family_head` (
  `family_head_id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `resident_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_head`
--

INSERT INTO `family_head` (`family_head_id`, `family_id`, `resident_id`) VALUES
(1, 1, 1),
(2, 2, 4),
(3, 3, 7),
(4, 4, 10),
(5, 5, 13),
(6, 26, 56),
(7, 27, 60),
(8, 28, 64),
(9, 29, 68),
(10, 30, 72);

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `officials_id` int(11) NOT NULL,
  `resident_id` int(11) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`officials_id`, `resident_id`, `position`) VALUES
(17, 56, 'Barangay Captain/Chairman'),
(18, 57, 'Barangay Councilor'),
(19, 64, 'Barangay Councilor'),
(20, 68, 'Barangay Councilor'),
(21, 72, 'Barangay Councilor'),
(22, 1, 'Sangguniang Kabataan Chairman'),
(23, 8, 'Barangay Secretary'),
(24, 60, 'Barangay Treasurer');

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `relationship_id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `father_id` int(11) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`relationship_id`, `family_id`, `father_id`, `mother_id`, `child_id`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, NULL, 2, NULL),
(3, 1, NULL, NULL, 3),
(4, 2, 4, NULL, NULL),
(5, 2, NULL, 5, NULL),
(6, 2, NULL, NULL, 6),
(7, 3, 7, NULL, NULL),
(8, 3, NULL, 8, NULL),
(9, 3, NULL, NULL, 9),
(10, 4, 10, NULL, NULL),
(11, 4, NULL, 11, NULL),
(12, 4, NULL, NULL, 11),
(13, 5, 13, NULL, NULL),
(14, 5, NULL, 14, NULL),
(15, 5, NULL, NULL, 14),
(16, 26, 56, NULL, NULL),
(17, 26, NULL, 57, NULL),
(18, 26, NULL, NULL, 58),
(19, 26, NULL, NULL, 59),
(20, 27, 60, NULL, NULL),
(21, 27, NULL, 61, NULL),
(22, 27, NULL, NULL, 62),
(23, 27, NULL, NULL, 63),
(24, 28, 64, NULL, NULL),
(25, 28, NULL, 65, NULL),
(26, 28, NULL, NULL, 66),
(27, 28, NULL, NULL, 67),
(28, 29, 68, NULL, NULL),
(29, 29, NULL, 69, NULL),
(30, 29, NULL, NULL, 70),
(31, 29, NULL, NULL, 71),
(32, 30, 72, NULL, NULL),
(33, 30, NULL, 73, NULL),
(34, 30, NULL, NULL, 74),
(35, 30, NULL, NULL, 75);

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `resident_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `family_head` tinyint(1) DEFAULT NULL,
  `family_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`resident_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `address_id`, `family_head`, `family_id`) VALUES
(1, 'Juan', 'Manuel', 'Dela Cruz', 'Male', '1980-06-15', 1, 1, 1),
(2, 'Maria', 'Rosales', 'Dela Cruz', 'Female', '1982-03-20', 1, 0, 1),
(3, 'Carlos', 'Juan', 'Dela Cruz', 'Male', '2005-08-11', 1, 0, 1),
(4, 'Pedro', 'Gabriel', 'Santos', 'Male', '1985-01-22', 2, 1, 2),
(5, 'Ana', 'Maria', 'Santos', 'Female', '1987-11-18', 2, 0, 2),
(6, 'Luis', 'Fernando', 'Santos', 'Male', '2010-05-09', 2, 0, 2),
(7, 'Ricardo', 'Felipe', 'Gonzales', 'Male', '1978-02-03', 3, 1, 3),
(8, 'Elena', 'Sofia', 'Gonzales', 'Female', '1980-07-25', 3, 0, 3),
(9, 'Javier', 'Eduardo', 'Gonzales', 'Male', '2008-09-16', 3, 0, 3),
(10, 'Antonio', 'Carlos', 'Lopez', 'Male', '1990-01-30', 4, 1, 4),
(11, 'Gloria', 'Patricia', 'Lopez', 'Female', '1992-06-12', 4, 0, 4),
(12, 'Adriana', 'Lucia', 'Lopez', 'Female', '2012-11-05', 4, 0, 4),
(13, 'Eduardo', 'Manuel', 'Reyes', 'Male', '1975-10-16', 5, 1, 5),
(14, 'Clara', 'Isabel', 'Reyes', 'Female', '1980-03-10', 5, 0, 5),
(15, 'Sofia', 'Teresa', 'Reyes', 'Female', '2011-02-14', 5, 0, 5),
(56, 'Mario', 'Luis', 'Torres', 'Male', '1970-01-05', 1, 1, 26),
(57, 'Carla', 'Ann', 'Torres', 'Female', '1972-05-14', 1, 0, 26),
(58, 'Diego', 'Martin', 'Torres', 'Male', '2000-07-23', 1, 0, 26),
(59, 'Samantha', 'Marie', 'Torres', 'Female', '2003-09-12', 1, 0, 26),
(60, 'Roberto', 'Felix', 'Torres', 'Male', '1975-03-30', 1, 1, 27),
(61, 'Angela', 'Grace', 'Torres', 'Female', '1978-11-25', 1, 0, 27),
(62, 'Paul', 'James', 'Torres', 'Male', '2005-06-18', 1, 0, 27),
(63, 'Marian', 'Joy', 'Torres', 'Female', '2008-10-09', 1, 0, 27),
(64, 'Daniel', 'Victor', 'Mendoza', 'Male', '1968-08-15', 2, 1, 28),
(65, 'Lucia', 'Veronica', 'Mendoza', 'Female', '1970-12-22', 2, 0, 28),
(66, 'Adrian', 'Samuel', 'Mendoza', 'Male', '1995-04-17', 2, 0, 28),
(67, 'Jasmine', 'Elise', 'Mendoza', 'Female', '1999-07-25', 2, 0, 28),
(68, 'Carlos', 'Enrique', 'Mendoza', 'Male', '1973-09-19', 2, 1, 29),
(69, 'Elena', 'Patricia', 'Mendoza', 'Female', '1975-05-10', 2, 0, 29),
(70, 'Fernando', 'Luis', 'Mendoza', 'Male', '2001-01-29', 2, 0, 29),
(71, 'Maria', 'Sophia', 'Mendoza', 'Female', '2003-08-15', 2, 0, 29),
(72, 'Francisco', 'Leon', 'Castro', 'Male', '1980-02-25', 3, 1, 30),
(73, 'Teresa', 'Camille', 'Castro', 'Female', '1982-06-18', 3, 0, 30),
(74, 'Miguel', 'Joseph', 'Castro', 'Male', '2006-11-03', 3, 0, 30),
(75, 'Sofia', 'Isabel', 'Castro', 'Female', '2009-03-22', 3, 0, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `barangay_id` (`barangay_id`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`barangay_id`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`family_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `family_head_id` (`family_head_id`);

--
-- Indexes for table `family_head`
--
ALTER TABLE `family_head`
  ADD PRIMARY KEY (`family_head_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`officials_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`relationship_id`),
  ADD KEY `family_id` (`family_id`),
  ADD KEY `father_id` (`father_id`),
  ADD KEY `mother_id` (`mother_id`),
  ADD KEY `child_id` (`child_id`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`resident_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `family_id` (`family_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `barangay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `family_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `family_head`
--
ALTER TABLE `family_head`
  MODIFY `family_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `officials_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `relationship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`barangay_id`) REFERENCES `barangay` (`barangay_id`);

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `family_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `family_ibfk_2` FOREIGN KEY (`family_head_id`) REFERENCES `resident` (`resident_id`);

--
-- Constraints for table `family_head`
--
ALTER TABLE `family_head`
  ADD CONSTRAINT `family_head_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `resident` (`resident_id`);

--
-- Constraints for table `officials`
--
ALTER TABLE `officials`
  ADD CONSTRAINT `officials_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `resident` (`resident_id`) ON DELETE CASCADE;

--
-- Constraints for table `relationships`
--
ALTER TABLE `relationships`
  ADD CONSTRAINT `relationships_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`family_id`),
  ADD CONSTRAINT `relationships_ibfk_2` FOREIGN KEY (`father_id`) REFERENCES `resident` (`resident_id`),
  ADD CONSTRAINT `relationships_ibfk_3` FOREIGN KEY (`mother_id`) REFERENCES `resident` (`resident_id`),
  ADD CONSTRAINT `relationships_ibfk_4` FOREIGN KEY (`child_id`) REFERENCES `resident` (`resident_id`);

--
-- Constraints for table `resident`
--
ALTER TABLE `resident`
  ADD CONSTRAINT `resident_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `resident_ibfk_2` FOREIGN KEY (`family_id`) REFERENCES `family` (`family_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
