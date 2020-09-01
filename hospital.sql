-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2020 at 10:00 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `specialization` varchar(50) DEFAULT NULL,
  `docType` varchar(50) DEFAULT NULL,
  `regDate` datetime DEFAULT NULL,
  `DID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`name`, `address`, `gender`, `phoneNumber`, `specialization`, `docType`, `regDate`, `DID`) VALUES
('Ø¹Ù…Ø±Ùˆ Ø¹Ø¬Ù…ÙŠ', 'Ù„ÙˆØ±Ø§Ù†', 'Ø°ÙƒØ±', '01112223456', 'Ø§Ø¹ØµØ§Ø¨', 'Ø§Ø³ØªØ´Ø§Ø±ÙŠ', '2020-09-01 19:59:46', 18),
('Ù…ØµØ·ÙÙ‰ Ù‚Ø¨Ø§Ø±ÙŠ', 'Ø¬Ù„ÙŠÙ…', 'Ø°ÙƒØ±', '01272587946', 'Ø¹Ø¸Ø§Ù…', 'Ø£Ø®ØµØ§Ø¦ÙŠ', '2020-09-01 20:00:27', 19),
('Ø£Ù…ÙŠÙ…Ø© Ø³Ø§Ù„Ù…', 'Ø§Ù„Ù…Ø¹Ø§Ø¯ÙŠ', 'Ø£Ù†Ø«Ù‰', '01178432131', 'ØªØºØ°ÙŠØ©', 'Ø§Ø³ØªØ´Ø§Ø±ÙŠ', '2020-09-01 20:01:11', 20),
('Ù…ØµØ·ÙÙ‰ Ø§Ø­Ù…Ø¯', '143, Al Ebrahimia, Portsaid st., Alexandria, Egypt', 'Ø°ÙƒØ±', '01113233156', 'Ø¬Ø±Ø§Ø­Ø©', 'Ø§Ø³ØªØ´Ø§Ø±ÙŠ', '2020-09-01 20:01:44', 21);

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `regDate` datetime DEFAULT NULL,
  `lastLoginDate` datetime DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`username`, `email`, `password`, `regDate`, `lastLoginDate`, `name`, `address`, `phoneNumber`, `gender`) VALUES
('newNurse', 'safaa@gmail.com', '14a88b9d2f52c55b5fbcf9c5d9c11875', NULL, '2020-09-01 21:37:57', 'Safaa', 'Smouha', '0124569874', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `regDate` datetime DEFAULT NULL,
  `lastLoginDate` datetime DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`username`, `email`, `password`, `regDate`, `lastLoginDate`, `name`, `address`, `phoneNumber`, `gender`) VALUES
('MohamedMassoud', 'linkman44@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-09-01 19:58:40', '2020-09-01 21:42:05', 'Ù…Ø­Ù…Ø¯ Ù…Ø³Ø¹ÙˆØ¯ Ù…Ø­Ù…Ø¯ Ø´Ù„Ø¨ÙŠ', 'Ø§Ù„Ø§Ø¨Ø±Ø§Ù‡ÙŠÙ…ÙŠØ© Ø´Ø§Ø±Ø¹ Ø¨ÙˆØ±Ø³Ø¹ÙŠØ¯ ', '01113758156', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `patientUsername` varchar(50) NOT NULL,
  `doctorDID` int(11) NOT NULL,
  `confirmed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`patientUsername`, `doctorDID`, `confirmed`) VALUES
('MohamedMassoud', 18, 0),
('MohamedMassoud', 19, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`DID`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`patientUsername`,`doctorDID`),
  ADD KEY `doctorDID` (`doctorDID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`patientUsername`) REFERENCES `patients` (`username`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`doctorDID`) REFERENCES `doctors` (`DID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
