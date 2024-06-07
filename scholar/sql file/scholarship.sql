-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 01:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarship`
--

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `officer_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`officer_id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'sudha@gmail.com', '$2y$10$R1oSdZrY8sBz8ZwgYKKE3OtB/apBGQBGAJ7FcS1HPS8zEl9PtIh/u', '2024-03-13 17:58:38', '2024-03-13 17:58:38'),
(4, 'muruga@gmail.com', '$2y$10$kIv2y4b2juRokTwV6nKfQ.c3hzMFzj9s1RHJciLXmiXyYXmEaDf.K', '2024-03-13 18:09:45', '2024-03-13 18:09:45'),
(9, 'jeeva@gmail.com', '$2y$10$h5DtTbEeryGQpE/SQ0iYmuvMaegHZWRafbYQSpKF.l.6Fw606KGaC', '2024-03-13 18:38:46', '2024-03-13 18:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_national`
--

CREATE TABLE `scholarship_national` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `course` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `community` varchar(255) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `aadhar` varchar(255) NOT NULL,
  `community_doc` varchar(255) NOT NULL,
  `marksheet` varchar(255) NOT NULL,
  `income_certificate` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_private`
--

CREATE TABLE `scholarship_private` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `course` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `community` varchar(255) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `aadhar` varchar(255) NOT NULL,
  `community_doc` varchar(255) NOT NULL,
  `marksheet` varchar(255) NOT NULL,
  `income_certificate` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scholarship_private`
--

INSERT INTO `scholarship_private` (`id`, `student_name`, `date_of_birth`, `gender`, `reg_no`, `course`, `department`, `college`, `community`, `college_name`, `account_number`, `ifsc_code`, `bank_name`, `branch`, `aadhar`, `community_doc`, `marksheet`, `income_certificate`, `status`) VALUES
(1, 'Sudhagar C', '2024-03-14', 'male', '43822', 'MCA', 'Computer Applications', 'BHARATHIAR UNIVERSITY ', 'MBC', 'Bharathiar University ', '78687689837937', 'MICD13000PS', 'INDIAN BANK', 'MALLAPURAM', 'maxresdefault.jpg', 'background 2.png', 'WhatsApp Image 2024-03-13 at 3.13.25 PM (1).jpeg', 'WhatsApp Image 2024-03-13 at 3.13.25 PM.jpeg', 'Rejected'),
(2, 'Sudha', '2024-03-21', 'male', '22CSEA69', 'MCA', 'Computer Applications', 'BHARATHIAR UNIVERSITY ', 'MB', 'Bharathiar University ', '7868768983', 'MSNK8786', 'INDIAN BANK', 'MALLAPURAM', 'database.png', 'p1_labdetails.png', 'form.png', 'p1_sign details.png', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_state`
--

CREATE TABLE `scholarship_state` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `course` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `community` varchar(255) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `aadhar` varchar(255) NOT NULL,
  `community_doc` varchar(255) NOT NULL,
  `marksheet` varchar(255) NOT NULL,
  `income_certificate` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scholarship_state`
--

INSERT INTO `scholarship_state` (`id`, `student_name`, `date_of_birth`, `gender`, `reg_no`, `course`, `department`, `college`, `community`, `college_name`, `account_number`, `ifsc_code`, `bank_name`, `branch`, `aadhar`, `community_doc`, `marksheet`, `income_certificate`, `status`) VALUES
(1, 'Sudha', '2024-02-29', 'male', '22CSEA71', 'MCA', 'Computer Applications', 'BHARATHIAR UNIVERSITY ', 'a', 'Bharathiar University ', '7868768983', 'MICD13000PS', 'INDIAN BANK', 'MALLAPURAM', 'Screenshot (303).png', '2.png', '3.png', 'Screenshot (302).png', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`) VALUES
(1, 'Sudhagar C', 'sudhagarlives123@gmail.com', '$2y$10$HqB5joi70h7ylWrBN7Xn1OFJYUSL99DmMkSHEeT9zBpngZx/eK1Iq'),
(3, 'muruga', 'murukaanand791@gmail.com', '$2y$10$qYpK6.sdNzgyg7cKhmuM8OnWDtUVJu8UPx73bGGqqs.RNtFpK/o5K'),
(4, 'janani', 'jana@gmail.com', '$2y$10$uA8MTYh3.sYEkBMgO2tOfub8jmxm0ISBV5tv/MPxXlxmeDlUb7Vvy'),
(5, 'janani', 'janani@gmail.com', '$2y$10$IaHL5CcWEO2SFpFxeebE2OsUUw.yvRPM0BBaY2msc9Q8GYj78/nTG'),
(6, 'muruga', 'su@gmail.com', '$2y$10$4f/UpYo1EGZEOVFIkww0.e/XTWvayvh0hp0rbIclB7tGn1QvKjNZ.'),
(7, 'Sudhagar C', 'karthi25a@gmail.com', '$2y$10$bYr4v4EavVQLS7tZmIzvTO4GGGHLaoRkh1GILSK.lhjD5Cwy1Axpy'),
(8, 'Sudhagar C', 'anuj.lpu1@gmail.com', '$2y$10$DewV0UqKl9uHWtdR3/2iHO2iuSOMxzb4Rly4ByiYvNAVAQzgob3YC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`officer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `scholarship_national`
--
ALTER TABLE `scholarship_national`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship_private`
--
ALTER TABLE `scholarship_private`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship_state`
--
ALTER TABLE `scholarship_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `officer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `scholarship_national`
--
ALTER TABLE `scholarship_national`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scholarship_private`
--
ALTER TABLE `scholarship_private`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scholarship_state`
--
ALTER TABLE `scholarship_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
