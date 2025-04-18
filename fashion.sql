-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 22, 2025 at 05:17 PM
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
-- Database: `fashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`sr_no`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Qudsiya', 'qudsiyas954@gmail.com', 'Testing', 'To test this form'),
(2, 'QUDSIYA MOHAMMED TANVEER SIDDIQUE', 'qudsiyas954@gmail.com', 'Testing', 'This is second message'),
(3, 'QUDSIYA MOHAMMED TANVEER SIDDIQUE', 'qudsiyas954@gmail.com', 'Testing', 'This is second message'),
(4, 'QUDSIYA MOHAMMED TANVEER SIDDIQUE', 'qudsiyas954@gmail.com', 'Testing', 'This is second message'),
(5, 'QUDSIYA MOHAMMED TANVEER SIDDIQUE', 'qudsiyas954@gmail.com', 'Testing', 'This is second message'),
(6, 'QUDSIYa', 'sterlingoverseas2002@gmail.com', 'lkoh', 'mcnsbdjwxiixjwd'),
(7, 'QUDSIYa', 'sterlingoverseas2002@gmail.com', 'lkoh', 'mcnsbdjwxiixjwd'),
(8, 'QUDSIYa', 'sterlingoverseas2002@gmail.com', 'lkoh', 'mcnsbdjwxiixjwd'),
(9, 'QUDSIYA MOHAMMED TANVEER SIDDIQUE', 'qudsiyas954@gmail.com', 'Testing', 'first text'),
(10, 'QUDSIYA MOHAMMED TANVEER SIDDIQUE', 'qudsiyas954@gmail.com', 'Testing', 'first text');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phonenum` varchar(200) NOT NULL,
  `profile` varchar(200) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`sr_no`, `name`, `email`, `phonenum`, `profile`, `gender`, `dob`, `password`) VALUES
(1, 'QUDSIYA MOHAMMED TANVEER SIDDIQUE', 'qudsiyas954@gmail.com', '09892421653', 'IMG29591.jpg', 'female', '2025-03-26', '$2y$10$BnRlKbZC3PnaCXHHrUVCwuDJRHIGTxOccuV7OzslT0mmsMLe/Jw5O'),
(2, 'Kashaf', 'kashafs954@gmail.com', '896547', 'IMG61604.jpg', 'male', '2025-03-07', '$2y$10$d5u6r/ONIbH6TgA.0H7K0eNZF7G2flKKAg8FnZiQsClbrRXmXURdy'),
(3, 'Qudsi', 'qudsi@gmail.com', '986755', 'test.jpg', 'female', '12-03-2025', '56789'),
(4, 'Tasleem', 'tasleem954@gmail.com', '123456', 'IMG39192.jpg', 'female', '2025-03-23', '$2y$10$Eovj3Jp6uxHQa8ADaI7UBePEh102zkR3MhOviY4ml.wG.JvZTlUPm'),
(5, 'Tanveer Siddique', 'tanveers954@gmail.com', '8975623897', 'IMG39070.jpg', 'female', '2025-03-12', '$2y$10$J47Sgmx4zaeeOgm9O3k5Q.77J5Il.dJrq3oHvYXAQqV0lQKWSXjee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
