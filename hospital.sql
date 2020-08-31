-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2020 at 06:38 PM
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
('Mohamed Massoud', 'Ebrahimia', 'male', '01113758156', 'Bone', 'Consultant', '2020-08-29 11:36:30', 1),
('Amr Agamy', 'Loran', 'male', '01005006987', 'Neurons', 'Specialized', '2020-08-29 11:40:22', 3),
('Doaa Khaled', 'Smouha', 'female', '01113758156', 'Immunology', 'Specialized', '2020-08-29 11:41:34', 4),
('Dina Hadad', '143, Al Ebrahimia, Portsaid st., Alexandria, Egypt', 'female', '01113758156', 'Stroke medicine', 'Consultant', '2020-08-29 11:41:57', 5),
('Basel Mehana', '143, Al Ebrahimia, Portsaid st., Alexandria, Egypt', 'male', '01113758156', 'Immunology', 'Specialized', '2020-08-29 19:05:05', 6);

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
('newNurse', 'newEmail@gmail.com', '14a88b9d2f52c55b5fbcf9c5d9c11875', '2020-08-28 00:00:00', '2020-08-31 18:34:37', 'Safaa', 'Smouha', '01223548915', 'Female');

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
('amragamy', 'amragamy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-08-29 18:54:04', '2020-08-31 18:34:20', 'Amr Agamy', 'Gleem', '01113758156', 'male'),
('iamlinkman', 'lin22kman44@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-08-30 10:58:32', '2020-08-30 10:58:32', 'Ahmed Morsy', '143, Al Ebrahimia, Portsaid st., Alexandria, Egypt', '01113758156', 'male'),
('MohamedMassoud', 'linkman44@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-08-27 00:00:00', '2020-08-31 18:34:01', 'Mohamed Massoud', '143, Al Ebrahimia, Portsaid st., Alexandria, Egypt', '01113758156', 'Male');

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
('amragamy', 1, 0),
('MohamedMassoud', 5, 1);

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
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
