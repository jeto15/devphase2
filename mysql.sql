-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 01:10 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `patient_request_table`
--

CREATE TABLE `patient_request_table` (
  `Id` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `patient_Id` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Draft',
  `created_date` datetime DEFAULT NULL,
  `created_by_Id` int(11) DEFAULT NULL,
  `modified_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prq_description_table`
--

CREATE TABLE `prq_description_table` (
  `Id` int(11) NOT NULL,
  `patient_request_Id` int(11) NOT NULL,
  `patient_Id` text NOT NULL,
  `modified_by_Id` int(11) DEFAULT NULL,
  `modified_date` datetime NOT NULL DEFAULT current_timestamp(),
  `Description` text NOT NULL,
  `Type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prq_laboratory_table`
--

CREATE TABLE `prq_laboratory_table` (
  `Id` int(11) NOT NULL,
  `Status` text NOT NULL DEFAULT 'Unpaid',
  `medicine_Id` int(11) DEFAULT NULL,
  `laboratory_Id` int(11) DEFAULT NULL,
  `isOther` tinyint(1) DEFAULT NULL,
  `is_other_request` varchar(255) DEFAULT NULL,
  `OtherType` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `patient_request_Id` int(11) NOT NULL,
  `Qty` int(11) DEFAULT NULL,
  `UnitPrice` double DEFAULT NULL,
  `patient_Id` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by_Id` int(11) DEFAULT NULL,
  `assignedDocotor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `patient_request_table`
--
ALTER TABLE `patient_request_table`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `prq_description_table`
--
ALTER TABLE `prq_description_table`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `prq_laboratory_table`
--
ALTER TABLE `prq_laboratory_table`
  ADD PRIMARY KEY (`Id`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_file_library`
--
ALTER TABLE `patient_file_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_request_table`
--
ALTER TABLE `patient_request_table`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prq_description_table`
--
ALTER TABLE `prq_description_table`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prq_laboratory_table`
--
ALTER TABLE `prq_laboratory_table`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

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
