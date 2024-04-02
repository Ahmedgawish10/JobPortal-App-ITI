-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2024 at 02:20 AM
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
-- Database: `php1`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('applicant','company') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `username`, `email`, `password`, `type`) VALUES
(1, 'Emily Meyer', 'cinedosiw@mailinator.com', 'Pa$$w0rd!', 'applicant'),
(2, 'ahmed', 'fujy@mailinator.com', 'Pa$$w0rd!', 'applicant'),
(3, 'applicant', 'vuxogesebe@mailinator.com', 'Pa$$w0rd!', 'applicant'),
(4, 'Forrest Vang', 'cipunury@mailinator.com', '2222', 'applicant'),
(5, 'Fulton Stanton', 'fuwuf@mailinator.com', 'Pa$$w0rd!', 'applicant');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `password`, `post_id`) VALUES
(1, 'net', '123', NULL),
(2, 'Benjamin Vincent', 'Pa$$w0rd!', NULL),
(3, 'company', 'Pa$$w0rd!', NULL),
(4, 'Nyssa Armstrong', '777', NULL),
(4, 'Nyssa Armstrong', '777', NULL),
(5, 'Bryar Brooks', '999', NULL),
(6, 'Nyssa', '777', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `status` enum('active','closed') NOT NULL,
  `salary` int(11) NOT NULL,
  `type` enum('full time','part time') NOT NULL,
  `subject` varchar(255) NOT NULL,
  `comp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `location`, `start_date`, `expire_date`, `status`, `salary`, `type`, `subject`, `comp_id`) VALUES
(1, 'front end', 'cairo', '2024-03-25', '2024-04-27', 'active', 2500, 'full time', 'my subject', NULL),
(2, 'Burton Hubbard', 'Laborum illum in ad', '2017-11-04', '1997-01-12', 'active', 27, 'part time', 'Ut culpa enim dolore', NULL),
(3, 'Alexa Porter', 'Elit eum omnis et v', '1974-07-26', '2025-01-24', 'active', 80, 'part time', 'Quis debitis sit ist', NULL),
(4, 'Clarke Wilson', 'Dolor quia aliquip l', '2019-10-03', '2016-01-31', 'active', 54, 'part time', 'Ipsa autem quae off', NULL),
(5, 'Clarke Wilson', 'Dolor quia aliquip l', '2019-10-03', '2016-01-31', 'active', 54, 'part time', 'Ipsa autem quae off', NULL),
(21, 'Imani Butler', 'Pariatur Pariatur ', '1973-12-01', '2003-10-31', 'active', 66, 'part time', 'Commodo nisi molesti', 3),
(22, 'Ruth Mcknight', 'Elit qui dolor magn', '1999-11-28', '2024-02-20', 'active', 97, 'part time', 'Esse inventore volup', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comp_id` (`comp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `companies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
