-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 10:48 PM
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
(5, '105', 'EFG St.', 1),
(10, '106', 'FGH St.', 1);

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
-- Table structure for table `deleted_families`
--

CREATE TABLE `deleted_families` (
  `deleted_family_id` int(11) NOT NULL,
  `family_id` int(11) DEFAULT NULL,
  `family_name` varchar(100) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_family_heads`
--

CREATE TABLE `deleted_family_heads` (
  `deleted_family_heads_id` int(11) NOT NULL,
  `family_head_id` int(11) DEFAULT NULL,
  `family_id` int(11) DEFAULT NULL,
  `resident_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_houses`
--

CREATE TABLE `deleted_houses` (
  `deleted_houses_id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `house_number` varchar(20) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `barangay_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_houses`
--

INSERT INTO `deleted_houses` (`deleted_houses_id`, `address_id`, `house_number`, `street`, `barangay_id`) VALUES
(1, 12, '107', 'GHJ', 1),
(2, 13, '108', 'HJK St.', 1),
(3, 14, '109', 'JKL St.', 1),
(4, 15, '110', 'KLM St.', 1),
(5, 16, '111', 'LMN St.', 1),
(6, 17, '112', 'MNO St.', 1),
(7, 18, '113', 'NOP St.', 1),
(8, 19, '114', 'OPQ St.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_relationships`
--

CREATE TABLE `deleted_relationships` (
  `deleted_relationships_id` int(11) NOT NULL,
  `relationship_id` int(11) DEFAULT NULL,
  `family_id` int(11) DEFAULT NULL,
  `father_id` int(11) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_relationships`
--

INSERT INTO `deleted_relationships` (`deleted_relationships_id`, `relationship_id`, `family_id`, `father_id`, `mother_id`, `child_id`) VALUES
(1, NULL, 4, 10, 0, 99),
(2, NULL, 4, 10, 0, 99),
(3, NULL, 54, 103, 0, 107);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_residents`
--

CREATE TABLE `deleted_residents` (
  `deleted_resident_id` int(11) NOT NULL,
  `resident_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `contact_number` varchar(11) DEFAULT NULL,
  `family_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_residents`
--

INSERT INTO `deleted_residents` (`deleted_resident_id`, `resident_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `contact_number`, `family_id`) VALUES
(1, NULL, 'Juan', 'Mariano', 'Lopez', 'Male', '2025-01-09', '09221789102', 4),
(2, 99, 'Juan', 'Mariano', 'Lopez', 'Male', '2025-01-09', '09221789102', 4),
(3, 99, 'Juan', 'Mariano', 'Lopez', 'Male', '2025-01-09', '09221789102', 4),
(4, 107, 'Claudette', 'Gozano', 'Manalo', 'Female', '2025-01-26', '09238736182', 54),
(5, 103, 'Jose', 'Magsino', 'Manalo', 'Male', '1969-03-05', '09221789102', 54),
(6, 104, 'Julie Ann', 'Gozano', 'Manalo', 'Female', '2002-07-25', '09654025629', 54),
(7, 105, 'Clarissa ', 'Gozano', 'Manalo', 'Female', '1972-04-16', '09987654321', 54),
(8, 106, 'Emmanuel', 'Gozano', 'Manalo', 'Male', '2012-07-13', '09867542310', 54);

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `family_id` int(11) NOT NULL,
  `family_name` varchar(100) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`family_id`, `family_name`, `address_id`) VALUES
(1, 'Dela Cruz', 1),
(2, 'Santos', 2),
(3, 'Gonzales', 3),
(4, 'Lopez', 4),
(5, 'Reyes', 5),
(26, 'Torres', 1),
(27, 'Torres', 1),
(28, 'Mendoza', 2),
(29, 'Mendoza', 2),
(30, 'Castro', 3),
(54, 'Manalo', 10);

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
(10, 30, 72),
(26, 54, 103);

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
(12, 4, NULL, NULL, 12),
(13, 5, 13, NULL, NULL),
(14, 5, NULL, 14, NULL),
(15, 5, NULL, NULL, 15),
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
(35, 30, NULL, NULL, 75),
(43, 4, NULL, NULL, 99),
(44, 54, 103, NULL, NULL),
(45, 54, NULL, NULL, 104),
(46, 54, NULL, 105, NULL),
(47, 54, NULL, NULL, 106),
(48, 54, NULL, NULL, 107);

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
  `contact_number` varchar(11) NOT NULL,
  `family_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`resident_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `contact_number`, `family_id`) VALUES
(1, 'Juan', 'Manuel', 'Dela Cruz', 'Male', '1980-06-15', '09000000001', 1),
(2, 'Maria', 'Rosales', 'Dela Cruz', 'Female', '1982-03-20', '09000000002', 1),
(3, 'Carlos', 'Juan', 'Dela Cruz', 'Male', '2005-08-11', '09000000003', 1),
(4, 'Pedro', 'Gabriel', 'Santos', 'Male', '1985-01-22', '09000000004', 2),
(5, 'Ana', 'Maria', 'Santos', 'Female', '1987-11-18', '09000000005', 2),
(6, 'Luis', 'Fernando', 'Santos', 'Male', '2010-05-09', '09000000006', 2),
(7, 'Ricardo', 'Felipe', 'Gonzales', 'Male', '1978-02-03', '09000000007', 3),
(8, 'Elena', 'Sofia', 'Gonzales', 'Female', '1980-07-25', '09000000008', 3),
(9, 'Javier', 'Eduardo', 'Gonzales', 'Male', '2008-09-16', '09000000009', 3),
(10, 'Antonio', 'Carlos', 'Lopez', 'Male', '1990-01-30', '09000000010', 4),
(11, 'Gloria', 'Patricia', 'Lopez', 'Female', '1992-06-12', '09000000011', 4),
(12, 'Adriana', 'Lucia', 'Lopez', 'Female', '2012-11-05', '09000000012', 4),
(13, 'Eduardo', 'Manuel', 'Reyes', 'Male', '1975-10-16', '09000000013', 5),
(14, 'Clara', 'Isabel', 'Reyes', 'Female', '1980-03-10', '09000000014', 5),
(15, 'Sofia', 'Teresa', 'Reyes', 'Female', '2011-02-14', '09000000015', 5),
(56, 'Mario', 'Luis', 'Torres', 'Male', '1970-01-05', '09000000056', 26),
(57, 'Carla', 'Ann', 'Torres', 'Female', '1972-05-14', '09000000057', 26),
(58, 'Diego', 'Martin', 'Torres', 'Male', '2000-07-23', '09000000058', 26),
(59, 'Samantha', 'Marie', 'Torres', 'Female', '2003-09-12', '09000000059', 26),
(60, 'Roberto', 'Felix', 'Torres', 'Male', '1975-03-30', '09000000060', 27),
(61, 'Angela', 'Grace', 'Torres', 'Female', '1978-11-25', '09000000061', 27),
(62, 'Paul', 'James', 'Torres', 'Male', '2005-06-18', '09000000062', 27),
(63, 'Marian', 'Joy', 'Torres', 'Female', '2008-10-09', '09000000063', 27),
(64, 'Daniel', 'Victor', 'Mendoza', 'Male', '1968-08-15', '09000000064', 28),
(65, 'Lucia', 'Veronica', 'Mendoza', 'Female', '1970-12-22', '09000000065', 28),
(66, 'Adrian', 'Samuel', 'Mendoza', 'Male', '1995-04-17', '09000000066', 28),
(67, 'Jasmine', 'Elise', 'Mendoza', 'Female', '1999-07-25', '09000000067', 28),
(68, 'Carlos', 'Enrique', 'Mendoza', 'Male', '1973-09-19', '09000000068', 29),
(69, 'Elena', 'Patricia', 'Mendoza', 'Female', '1975-05-10', '09000000069', 29),
(70, 'Fernando', 'Luis', 'Mendoza', 'Male', '2001-01-29', '09000000070', 29),
(71, 'Maria', 'Sophia', 'Mendoza', 'Female', '2003-08-15', '09000000071', 29),
(72, 'Francisco', 'Leon', 'Castro', 'Male', '1980-02-25', '09000000072', 30),
(73, 'Teresa', 'Camille', 'Castro', 'Female', '1982-06-18', '09000000073', 30),
(74, 'Miguel', 'Joseph', 'Castro', 'Male', '2006-11-03', '09000000074', 30),
(75, 'Sofia', 'Isabel', 'Castro', 'Female', '2009-03-22', '09000000075', 30),
(103, 'Jose', 'Magsino', 'Manalo', 'Male', '1969-03-05', '09221789102', 54),
(104, 'Julie Ann', 'Gozano', 'Manalo', 'Female', '2002-07-25', '09654025629', 54),
(105, 'Clarissa ', 'Gozano', 'Manalo', 'Female', '1972-04-16', '09987654321', 54),
(106, 'Emmanuel', 'Gozano', 'Manalo', 'Male', '2012-07-13', '09867542310', 54);

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
-- Indexes for table `deleted_families`
--
ALTER TABLE `deleted_families`
  ADD PRIMARY KEY (`deleted_family_id`);

--
-- Indexes for table `deleted_family_heads`
--
ALTER TABLE `deleted_family_heads`
  ADD PRIMARY KEY (`deleted_family_heads_id`);

--
-- Indexes for table `deleted_houses`
--
ALTER TABLE `deleted_houses`
  ADD PRIMARY KEY (`deleted_houses_id`);

--
-- Indexes for table `deleted_relationships`
--
ALTER TABLE `deleted_relationships`
  ADD PRIMARY KEY (`deleted_relationships_id`);

--
-- Indexes for table `deleted_residents`
--
ALTER TABLE `deleted_residents`
  ADD PRIMARY KEY (`deleted_resident_id`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`family_id`),
  ADD KEY `address_id` (`address_id`);

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
  ADD KEY `family_id` (`family_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `barangay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deleted_families`
--
ALTER TABLE `deleted_families`
  MODIFY `deleted_family_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deleted_family_heads`
--
ALTER TABLE `deleted_family_heads`
  MODIFY `deleted_family_heads_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deleted_houses`
--
ALTER TABLE `deleted_houses`
  MODIFY `deleted_houses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `deleted_relationships`
--
ALTER TABLE `deleted_relationships`
  MODIFY `deleted_relationships_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deleted_residents`
--
ALTER TABLE `deleted_residents`
  MODIFY `deleted_resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `family_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `family_head`
--
ALTER TABLE `family_head`
  MODIFY `family_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `officials_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `relationship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

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
  ADD CONSTRAINT `family_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

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
  ADD CONSTRAINT `relationships_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`family_id`);

--
-- Constraints for table `resident`
--
ALTER TABLE `resident`
  ADD CONSTRAINT `resident_ibfk_2` FOREIGN KEY (`family_id`) REFERENCES `family` (`family_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
