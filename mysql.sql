-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 03:20 PM
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
-- Database: `aaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `listprice` double DEFAULT NULL,
  `lastmodifieddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`Id`, `Name`, `Description`, `created_date`, `listprice`, `lastmodifieddate`) VALUES
(1, 'CBC', NULL, '2024-05-01 20:51:29', 5, NULL),
(2, 'UA', 'This for testing ', '2024-05-01 20:51:29', 5, '2024-07-11 13:51:19'),
(3, 'PT UA', NULL, '2024-05-01 20:51:29', 5, NULL),
(4, 'STOOL EXAM', 'asdfasdfas', '2024-05-01 20:51:29', 6, '2024-07-05 16:13:59'),
(5, 'SGPT', NULL, '2024-05-01 20:51:29', 52, NULL),
(6, 'SGOT', 'asdfasdf', '2024-05-01 20:51:29', 122, '2024-07-05 16:10:44'),
(7, 'LIPID PANEL 422', '', '2024-05-01 20:51:29', 23, '2024-07-05 16:14:27'),
(8, 'BUA', NULL, '2024-05-01 20:51:29', 25, NULL),
(9, 'BUN', NULL, '2024-05-01 20:51:29', 10, NULL),
(10, 'CREATININE', NULL, '2024-05-01 20:51:29', 5, NULL),
(21, 'Lab', 'test dfasdf', '2024-07-05 15:21:00', 1000, '2024-07-05 16:10:29'),
(22, 'LIPID PANEL123', 'test', '2024-07-05 15:25:09', 23, '2024-07-05 16:14:23'),
(23, 'LIPID PANEL', 'test123', '2024-07-05 15:25:35', 23, '2024-07-05 15:25:35'),
(24, 'TEST LAB', 'For Testing Only', '2024-07-11 13:49:45', 1000, '2024-07-11 13:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Brand` varchar(255) DEFAULT NULL,
  `DosageForm` varchar(100) DEFAULT NULL,
  `Strength` varchar(100) DEFAULT NULL,
  `Manufacturer` varchar(255) DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `ceated_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastmodified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`Id`, `Name`, `Brand`, `DosageForm`, `Strength`, `Manufacturer`, `ExpiryDate`, `Price`, `Description`, `ceated_date`, `lastmodified_date`) VALUES
(3, 'Name', 'Brank', 'Tablet', '500mg', 'Manacutrere', '2024-07-15', 200.00, 'test ', '2024-07-04 06:12:42', '2024-07-04 06:12:42'),
(4, 'Name1', 'Brank1', 'Tablet', '300mg', 'Manacutrere', '2024-07-15', 200.00, 'test ', '2024-07-04 06:12:49', '2024-07-04 06:55:17'),
(5, 'Name3', 'Brank3', 'Tablet', '500mg', 'Manacutrere', '2024-07-15', 100.00, 'test ', '2024-07-04 06:12:53', '2024-07-11 06:10:20'),
(6, 'Name 4', 'Brank 4', 'Tablet', '50 ml', 'Test Record Manufacturer', NULL, 5.00, 'Test Record Manufacturer Tablet', '2024-07-04 07:10:40', '2024-07-04 07:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `birthday` varchar(100) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `patient_number` varchar(50) DEFAULT NULL,
  `address` text NOT NULL,
  `Created Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Id` int(11) NOT NULL,
  `createdby` int(11) DEFAULT 0,
  `modifiedby` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`first_name`, `last_name`, `middle_name`, `age`, `gender`, `birthday`, `contact_number`, `patient_number`, `address`, `Created Date`, `Id`, `createdby`, `modifiedby`) VALUES
('Jason', 'Test', 'Person', '40', 'Male', '1973-02-15', '09123231231', 'P-1', 'Purok 5, Brgy San Roques Ozamiz City ', '2024-05-17 05:38:00', 5, NULL, 1),
('Mela', 'Test', 'Person', '25', 'Female', '1959-06-17', '123213123123', 'P-2', 'aaaa asaaaaaaa', '2024-05-17 05:38:45', 6, NULL, NULL),
('Asdfasdf', 'Sadf', 'Asdfsadf', '22', 'Male', '2023-02-01', 'Asdfasdf', 'P-3', 'sasdf', '2024-05-17 05:40:40', 7, NULL, NULL),
('Aa', 'Asdf', 'Asdf', '', 'Male', '1994-02-03', '', 'P-test', '', '2024-05-17 05:42:30', 8, NULL, NULL),
('Aa', 'Asdf', 'Asdf', '54', 'Female', '1988-02-05', '312312312', 'Tewtw ', 'adfasdfasdf', '2024-05-17 05:43:10', 9, NULL, NULL),
('Sddd', 'Dddd', 'Dddasdfa', '54', 'Male', '1988-02-05', '02087599036', 'Asdfasdf', 'Test Addresss', '2024-05-17 05:43:38', 10, NULL, NULL),
('Asfa', 'Asdf', 'Asdfasdf', '34', 'Female', '2007-03-17', '911111111111', 'P-24', 'Test address', '2024-05-25 07:16:44', 11, NULL, NULL),
('Test', 'Tttt', 'Ttt', '46', 'Male', '2008-02-18', '123213123', 'P123', 'test', '2024-06-01 21:37:29', 12, 1, 1),
('Test', 'Tttt', 'Ttt', '46', 'Male', '2008-02-18', '123213123', 'P-test', 'asdf', '2024-06-04 21:37:27', 13, 1, 0),
('', '', '', '', 'Male', '', '', 'P-3', '', '2024-06-04 22:03:28', 14, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_file_library`
--

CREATE TABLE `patient_file_library` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `isavatar` varchar(20) NOT NULL DEFAULT 'No',
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_file_library`
--

INSERT INTO `patient_file_library` (`id`, `description`, `isavatar`, `type`, `name`, `created_date`, `patient_id`) VALUES
(5, 'Some description', 'Yes', 'image/jpeg', '6655e162e3ace.jpg', '2024-05-28 21:51:30', 6),
(6, 'Some description', 'Yes', 'image/jpeg', '6655e3cd203e7.jpg', '2024-05-28 22:01:49', 5),
(7, 'Some description', 'Yes', 'image/jpeg', '6655e4e7594fd.jpg', '2024-05-28 22:06:31', 7),
(8, 'Some description', 'Yes', 'image/jpeg', '66587fa0f2b74.jpg', '2024-05-30 21:31:13', 5),
(9, 'Some description', 'Yes', 'image/jpeg', '66588094d2c1b.jpg', '2024-05-30 21:35:16', 5),
(10, 'Some description', 'Yes', 'image/jpeg', '665880ddc12a2.jpg', '2024-05-30 21:36:29', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT 1,
  `Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`, `FirstName`, `LastName`, `DateOfBirth`, `IsActive`, `Role`) VALUES
(1, 'admin', '', 'admin', 'Jet', 'Compayan', '2014-04-30', 1, 1),
(2, 'doc', 'doctor@test.com', 'doc', 'Doc', 'tour', '2024-05-23', 1, 4),
(3, 'staff', 'staff@test.com', 'staff', 'Immay', 'Staff', '2024-05-23', 1, 2),
(4, 'receptionist', 'receptionist@test.com', 'receptionist', 'receptionist', 'receptionist', '2024-05-23', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_permession`
--

CREATE TABLE `user_permession` (
  `make-request-prescription` tinyint(1) DEFAULT 0,
  `make-request-prescription-laboratories` tinyint(1) DEFAULT 0,
  `ProfileName` varchar(255) NOT NULL,
  `Id` int(11) NOT NULL,
  `Dashboard` tinyint(1) DEFAULT NULL,
  `make-request-prescription-paidstatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_permession`
--

INSERT INTO `user_permession` (`make-request-prescription`, `make-request-prescription-laboratories`, `ProfileName`, `Id`, `Dashboard`, `make-request-prescription-paidstatus`) VALUES
(1, 1, 'Admin', 1, 1, 1),
(0, 1, 'Cashier', 2, 1, 1),
(0, 1, 'Receptionist', 3, 1, 0),
(1, 1, 'Doctor', 4, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `patient_file_library`
--
ALTER TABLE `patient_file_library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `user_permession`
--
ALTER TABLE `user_permession`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patient_file_library`
--
ALTER TABLE `patient_file_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_permession`
--
ALTER TABLE `user_permession`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
