-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 07, 2026 at 06:42 PM
-- Server version: 11.2.2-MariaDB
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mygymdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `trainer_id` int(11) NOT NULL,
  `class_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `session_type` enum('morning','evening') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender_specific` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `room` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `trainer_id` (`trainer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`Id`, `trainer_id`, `class_name`, `session_type`, `gender_specific`, `start_time`, `end_time`, `max_capacity`, `room`, `is_active`, `created_at`) VALUES
(1, 3, 'Yoga', 'morning', 'female', '08:00:00', '08:50:00', 25, 'room 1', 'Active', '2026-09-04 14:05:57'),
(2, 4, 'Warm-up', 'morning', 'female', '09:00:00', '09:50:00', 30, 'room 1', 'Active', '2026-09-04 14:05:57'),
(3, 8, 'Fitness ', 'morning', 'female', '10:00:00', '10:50:00', 25, 'room 2', 'Active', '2026-09-04 14:05:57'),
(4, 6, 'Swimming', 'morning', 'female', '11:00:00', '11:50:00', 20, 'swimming pool', 'Active', '2026-09-04 14:05:57'),
(5, 2, 'Warm-up', 'evening', 'male', '13:00:00', '13:50:00', 30, 'room 1', 'Active', '2026-09-04 14:05:57'),
(6, 5, 'Fitness', 'evening', 'male', '14:00:00', '14:50:00', 25, 'room 2', 'Active', '2026-09-04 14:05:57'),
(7, 1, 'Bodybuilding', 'evening', 'male', '15:00:00', '15:50:00', 30, 'room 2', 'Active', '2026-09-04 14:05:57'),
(8, 7, 'Swimming', 'evening', 'male', '16:00:00', '16:50:00', 20, 'swimming pool', 'Active', '2026-09-04 14:05:57'),
(9, 9, 'Fitness', 'evening', 'male', '16:00:00', '16:50:00', 23, 'room 1', 'Inactive', '2026-09-04 15:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `class_members`
--

DROP TABLE IF EXISTS `class_members`;
CREATE TABLE IF NOT EXISTS `class_members` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT NULL,
  `attendance_status` enum('Booked','Attended','Absent','Expired') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `class_id` (`class_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `class_members`
--

INSERT INTO `class_members` (`Id`, `class_id`, `member_id`, `enrollment_date`, `attendance_status`) VALUES
(1, 1, 3, '2026-09-02 17:22:30', 'Attended'),
(2, 1, 12, '2026-09-02 17:22:30', 'Expired'),
(3, 1, 13, '2026-09-02 17:22:30', 'Attended'),
(4, 1, 14, '2026-09-02 17:22:30', 'Attended'),
(5, 1, 15, '2026-09-02 17:22:30', 'Attended'),
(6, 1, 16, '2026-09-02 17:22:30', 'Booked'),
(7, 1, 17, '2026-09-02 17:22:30', 'Expired'),
(8, 7, 2, '2026-09-02 17:22:30', 'Attended'),
(9, 7, 4, '2026-09-02 17:22:30', 'Attended'),
(10, 7, 5, '2026-09-02 17:22:30', 'Expired'),
(12, 7, 7, '2026-09-02 17:22:30', 'Attended'),
(13, 7, 8, '2026-09-02 17:22:30', 'Attended'),
(14, 7, 9, '2026-09-02 17:22:30', 'Attended'),
(15, 7, 10, '2026-09-02 17:22:30', 'Attended'),
(16, 6, 2, '2026-09-02 17:22:30', 'Attended'),
(17, 6, 4, '2026-09-02 17:22:30', 'Attended'),
(18, 6, 5, '2026-09-02 17:22:30', 'Expired'),
(20, 9, 7, '2026-09-02 17:22:30', 'Attended'),
(21, 9, 8, '2026-09-02 17:22:30', 'Absent'),
(22, 9, 9, '2026-09-02 17:22:30', 'Attended'),
(23, 9, 10, '2026-09-02 17:22:30', 'Attended'),
(24, 3, 3, '2026-09-02 17:22:30', 'Attended'),
(25, 3, 12, '2026-09-02 17:22:30', 'Expired'),
(26, 3, 13, '2026-09-02 17:22:30', 'Attended'),
(27, 3, 14, '2026-09-02 17:22:30', 'Attended'),
(28, 3, 15, '2026-09-02 17:22:30', 'Attended'),
(29, 3, 16, '2026-09-02 17:22:30', 'Booked'),
(30, 3, 17, '2026-09-02 17:22:30', 'Expired'),
(31, 2, 3, '2026-09-02 17:22:30', 'Attended'),
(32, 2, 12, '2026-09-02 17:22:30', 'Expired'),
(33, 2, 13, '2026-09-02 17:22:30', 'Attended'),
(34, 2, 14, '2026-09-02 17:22:30', 'Attended'),
(35, 2, 15, '2026-09-02 17:22:30', 'Attended'),
(36, 2, 16, '2026-09-02 17:22:30', 'Booked'),
(37, 2, 17, '2026-09-02 17:22:30', 'Expired'),
(38, 5, 2, '2026-09-02 17:22:30', 'Attended'),
(39, 5, 4, '2026-09-02 17:22:30', 'Attended'),
(40, 5, 5, '2026-09-02 17:22:30', 'Expired'),
(42, 5, 7, '2026-09-02 17:22:30', 'Attended'),
(43, 5, 8, '2026-09-02 17:22:30', 'Attended'),
(44, 5, 9, '2026-09-02 17:22:30', 'Attended'),
(45, 5, 10, '2026-09-02 17:22:30', 'Attended'),
(46, 4, 15, '2026-09-02 17:22:30', 'Attended'),
(47, 4, 16, '2026-09-02 17:22:30', 'Booked'),
(48, 4, 17, '2026-09-02 17:22:30', 'Expired'),
(49, 4, 18, '2026-09-02 17:22:30', 'Booked'),
(50, 4, 19, '2026-09-02 17:22:30', 'Attended'),
(51, 4, 20, '2026-09-02 17:22:30', 'Attended'),
(52, 4, 22, '2026-09-02 17:22:30', 'Expired'),
(53, 8, 7, '2026-09-02 17:22:30', 'Attended'),
(54, 8, 8, '2026-09-02 17:22:30', 'Attended'),
(55, 8, 9, '2026-09-02 17:22:30', 'Attended'),
(56, 8, 10, '2026-09-02 17:22:30', 'Attended'),
(57, 8, 11, '2026-09-02 17:22:30', 'Attended'),
(58, 8, 21, '2026-09-02 17:22:30', 'Expired'),
(59, 8, 23, '2026-09-02 17:22:30', 'Attended'),
(61, 6, 10, '2026-09-06 21:00:00', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `First_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Gender` enum('Male','Female') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birth_date` date NOT NULL,
  `join_date` date NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Id`, `First_name`, `Last_name`, `Gender`, `Phone`, `Email`, `birth_date`, `join_date`, `status`, `profile_image`, `created_at`, `updated_at`) VALUES
(2, 'Loay', 'Shatnawi', 'Male', '0779911223', 'loays@email.com', '2000-06-07', '2026-08-03', 'Active', 'boy1.jpg', '2026-08-31 20:19:39', '2026-09-01 13:13:24'),
(3, 'Maria', 'Shatnawi', 'Female', '0779922334', 'marias@email.com', '2002-08-10', '2026-08-03', 'Active', 'girl5.jpg', '2026-08-31 20:19:39', '2026-09-01 13:16:40'),
(4, 'Kamal', 'Ruabdeh', 'Male', '0779933445', 'kamalr@email.com', '1999-01-02', '2026-08-11', 'Active', 'boy2.jpg', '2026-08-31 20:19:39', '2026-09-07 17:30:43'),
(5, 'Karam', 'Osama', 'Male', '0779944556', 'karamo@email.com', '1993-07-21', '2026-08-09', 'Inactive', 'boy3.jpg', '2026-08-31 20:19:39', '2026-09-07 17:05:23'),
(7, 'Rami', 'Radaideh', 'Male', '0779966778', 'ramir@email.com', '2001-02-03', '2026-08-09', 'Active', 'boy5.jpg', '2026-08-31 20:19:39', '2026-09-07 17:31:03'),
(8, 'Osama', 'Shaher', 'Male', '0779977889', 'osamas@email.com', '1998-09-19', '2026-08-05', 'Inactive', 'boy6.jpg', '2026-08-31 20:19:39', '2026-09-07 17:31:59'),
(9, 'Ahmad', 'Alauneh', 'Male', '0779988990', 'ahmada@email.com', '1996-09-06', '2026-08-06', 'Active', 'boy7.jpg', '2026-08-31 20:19:39', '2026-09-01 13:18:15'),
(10, 'Saleem', 'Jawad', 'Male', '0779999001', 'saleemj@email.com', '2000-01-01', '2026-08-16', 'Active', 'boy8.jpg', '2026-08-31 20:19:39', '2026-09-01 13:18:28'),
(11, 'Jamal', 'Bzoor', 'Male', '0779989890', 'jamalb@email.com', '1991-04-18', '2026-08-11', 'Active', 'boy9.jpg', '2026-08-31 20:19:39', '2026-09-07 17:32:17'),
(12, 'Lama', 'Sauafteh', 'Female', '0779979791', 'lamas@email.com', '2002-10-24', '2026-08-17', 'Inactive', 'girl1.jpg', '2026-08-31 20:19:39', '2026-09-07 17:33:10'),
(13, 'Amal', 'Rauabdeh', 'Female', '0779979792', 'amalr@email.com', '1997-05-08', '2026-08-10', 'Active', 'girl2.jpg', '2026-08-31 20:19:39', '2026-09-01 13:20:19'),
(14, 'Manar', 'Alhasan', 'Female', '0779979793', 'manara@email.com', '2000-06-09', '2026-08-11', 'Active', 'girl3.jpg', '2026-08-31 20:19:39', '2026-09-01 13:20:28'),
(15, 'Sama', 'Ziad', 'Female', '0779979794', 'samaz@email.com', '2004-03-01', '2026-08-19', 'Active', 'girl4.jpg', '2026-08-31 20:19:39', '2026-09-07 17:32:35'),
(16, 'Jana', 'Nasir', 'Female', '0779979795', 'janan@email.com', '1998-01-09', '2026-08-04', 'Inactive', 'girl6.jpg', '2026-08-31 20:19:39', '2026-09-07 17:06:45'),
(17, 'Laila', 'Kamal', 'Female', '0123123123', 'lailak@email.com', '1994-07-08', '2026-08-05', 'Active', 'girl7.jpg', '2026-08-31 20:19:39', '2026-09-07 18:15:39'),
(18, 'Reham', 'Khalaileh', 'Female', '0779979797', 'rehamk@email.com', '1997-09-04', '2026-08-06', 'Inactive', 'girl8.jpg', '2026-08-31 20:19:39', '2026-09-07 17:32:54'),
(19, 'Layan', 'Smadi', 'Female', '0779979798', 'layans@email.com', '2004-02-09', '2026-08-24', 'Active', 'girl9.jpg', '2026-08-31 20:19:39', '2026-09-01 13:21:19'),
(20, 'Hajar', 'Khasauneh', 'Female', '0779979799', 'hajark@email.com', '2002-10-23', '2026-08-20', 'Active', 'girl10.jpg', '2026-08-31 20:19:39', '2026-09-07 17:33:54'),
(21, 'Fadi', 'Bataineh', 'Male', '0779900112', 'fadib@email.com', '2003-08-09', '2026-08-12', 'Inactive', 'boy10.jpg', '2026-08-31 20:19:39', '2026-09-07 17:07:43'),
(22, 'Lamyaa', 'Khasauneh', 'Female', '0779981234', 'lamyaak@email.com', '2001-01-30', '2026-09-28', 'Inactive', 'uploads/new2F.jpg', '2026-09-02 20:31:39', '2026-09-07 17:34:09'),
(23, 'Diaa', 'Mrian', 'Male', '0779912312', 'diaam@email.com', '1996-07-11', '2026-09-27', 'Active', 'uploads/new1M.jpg', '2026-09-02 21:10:44', '2026-09-05 19:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

DROP TABLE IF EXISTS `membership_plans`;
CREATE TABLE IF NOT EXISTS `membership_plans` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `plan_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `duration_months` int(11) NOT NULL,
  `Price` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `type_id` (`Id`),
  KEY `type_id_2` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `membership_plans`
--

INSERT INTO `membership_plans` (`Id`, `type_id`, `plan_name`, `duration_months`, `Price`, `is_active`, `created_at`) VALUES
(1, 1, 'Gym - 1 Month', 1, '15JD', 'Active', '2026-09-03 21:51:27'),
(2, 2, 'Pool - 1 Month', 1, '20JD', 'Active', '2026-09-03 21:51:27'),
(3, 3, 'Combined - 1 Month', 1, '25JD', 'Active', '2026-09-03 21:51:27'),
(4, 1, 'Gym - 3 Months', 3, '35JD', 'Active', '2026-09-03 21:51:27'),
(5, 2, 'Pool - 3 Months', 3, '45JD', 'Active', '2026-09-03 21:51:27'),
(6, 3, 'Combined - 3 Months', 3, '60JD', 'Active', '2026-09-03 21:51:27'),
(7, 1, 'Gym - 6 Months', 6, '60JD', 'Active', '2026-09-03 21:51:27'),
(8, 2, 'Pool - 6 Months', 6, '75JD', 'Active', '2026-09-03 21:51:27'),
(9, 3, 'Combined - 6 Months', 6, '100JD', 'Active', '2026-09-03 21:51:27'),
(10, 1, 'Gym - 1 Year', 12, '100JD', 'Active', '2026-09-03 21:51:27'),
(11, 2, 'Pool - 1 Year', 12, '125JD', 'Inactive', '2026-09-03 21:51:27'),
(12, 3, 'Combined - 1 Year', 12, '175JD', 'Active', '2026-09-03 21:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `membership_types`
--

DROP TABLE IF EXISTS `membership_types`;
CREATE TABLE IF NOT EXISTS `membership_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `membership_types`
--

INSERT INTO `membership_types` (`id`, `type_name`, `description`, `created_at`) VALUES
(1, 'Gym', 'All: Warm-up, Fitness. Male: Bodybuilding. Female: Yoga.', '2026-09-03 23:05:46'),
(2, 'Pool', 'All: Swimming.', '2026-09-03 23:05:46'),
(3, 'Combined', 'All: Warm-up, Fitness, Swimming. Male: Bodybuilding. Female: Yoga.', '2026-09-03 23:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `amount` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` enum('Cash','Credit Card','Bank Transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `transaction_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Paid','Pending','Failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `member_id` (`member_id`),
  KEY `subscription_id` (`subscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Id`, `member_id`, `subscription_id`, `amount`, `payment_date`, `payment_method`, `transaction_id`, `status`, `created_at`) VALUES
(1, 2, 1, '100JD', '2026-01-01', 'Bank Transfer', '0001', 'Paid', '2026-09-05 16:13:37'),
(2, 3, 2, '15JD', '2026-08-27', 'Cash', '0002', 'Paid', '2026-09-05 16:13:37'),
(3, 4, 3, '100JD', '2025-12-29', 'Bank Transfer', '0003', 'Paid', '2026-09-05 16:13:37'),
(4, 5, 4, '15JD', '2026-07-30', 'Cash', '0004', 'Paid', '2026-09-05 16:13:37'),
(6, 7, 6, '20JD', '2026-09-01', 'Cash', '0006', 'Paid', '2026-09-05 16:13:37'),
(7, 8, 7, '45JD', '2026-06-01', 'Credit Card', '0007', 'Paid', '2026-09-05 16:13:37'),
(8, 9, 8, '45JD', '2026-07-01', 'Credit Card', '0008', 'Paid', '2026-09-05 16:13:37'),
(9, 10, 9, '75JD', '2026-07-01', 'Credit Card', '0009', 'Paid', '2026-09-05 16:13:37'),
(10, 11, 10, '175JD', '2026-01-04', 'Bank Transfer', '0010', 'Paid', '2026-09-05 16:13:37'),
(11, 12, 11, '35JD', '2026-08-01', 'Credit Card', '0011', 'Failed', '2026-09-05 16:13:37'),
(12, 13, 12, '35JD', '2026-08-01', 'Cash', '0012', 'Paid', '2026-09-05 16:13:37'),
(13, 14, 13, '60JD', '2026-07-01', 'Credit Card', '0013', 'Paid', '2026-09-05 16:13:37'),
(14, 15, 14, '125JD', '2025-12-30', 'Bank Transfer', '0014', 'Paid', '2026-09-05 16:13:37'),
(15, 16, 15, '125JD', '2026-09-01', 'Bank Transfer', '0015', 'Pending', '2026-09-05 16:13:37'),
(16, 17, 16, '20JD', '2026-09-01', 'Cash', '0016', 'Paid', '2026-09-05 16:13:37'),
(17, 18, 17, '175JD', '2026-09-01', 'Bank Transfer', '0017', 'Pending', '2026-09-05 16:13:37'),
(18, 19, 18, '25JD', '2026-09-01', 'Cash', '0018', 'Paid', '2026-09-05 16:13:37'),
(19, 20, 19, '60JD', '2026-08-01', 'Credit Card', '0019', 'Paid', '2026-09-05 16:13:37'),
(20, 21, 20, '25JD', '2026-08-01', 'Cash', '0020', 'Paid', '2026-09-05 16:13:37'),
(21, 22, 21, '100JD', '2026-03-01', 'Bank Transfer', '0021', 'Paid', '2026-09-05 16:13:37'),
(22, 23, 22, '100JD', '2026-07-01', 'Bank Transfer', '0022', 'Paid', '2026-09-05 16:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Active','Expired','Cancelled','Pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `paid_amount` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `member_id` (`member_id`),
  KEY `plan_id` (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`Id`, `member_id`, `plan_id`, `start_date`, `end_date`, `status`, `paid_amount`, `created_at`) VALUES
(1, 2, 10, '2026-01-01', '2026-12-31', 'Active', '100JD', '2026-09-04 22:26:04'),
(2, 3, 1, '2026-09-01', '2026-09-30', 'Active', '15JD', '2026-09-04 22:26:04'),
(3, 4, 10, '2026-01-01', '2026-12-31', 'Active', '100JD', '2026-09-04 22:26:04'),
(4, 5, 1, '2026-08-01', '2026-08-31', 'Expired', '15JD', '2026-09-04 22:26:04'),
(6, 7, 2, '2026-09-01', '2026-09-30', 'Active', '20JD', '2026-09-04 22:26:04'),
(7, 8, 5, '2026-06-01', '2026-08-31', 'Expired', '45JD', '2026-09-04 22:26:04'),
(8, 9, 5, '2026-07-01', '2026-09-30', 'Active', '45JD', '2026-09-04 22:26:04'),
(9, 10, 8, '2026-07-01', '2026-12-31', 'Active', '75JD', '2026-09-04 22:26:04'),
(10, 11, 12, '2026-01-01', '2026-12-31', 'Active', '175JD', '2026-09-04 22:26:04'),
(11, 12, 4, '2026-08-01', '2026-10-31', 'Cancelled', '35JD', '2026-09-04 22:26:04'),
(12, 13, 4, '2026-08-01', '2026-10-31', 'Active', '35JD', '2026-09-04 22:26:04'),
(13, 14, 7, '2026-07-01', '2026-12-31', 'Active', '60JD', '2026-09-04 22:26:04'),
(14, 15, 11, '2026-01-01', '2026-12-31', 'Active', '125JD', '2026-09-04 22:26:04'),
(15, 16, 11, '2026-10-01', '2027-09-30', 'Pending', '125JD', '2026-09-04 22:26:04'),
(16, 17, 2, '2026-09-01', '2026-09-30', 'Cancelled', '20JD', '2026-09-04 22:26:04'),
(17, 18, 12, '2024-09-01', '2026-08-31', 'Pending', '175JD', '2026-09-04 22:26:04'),
(18, 19, 3, '2026-09-01', '2026-09-30', 'Active', '25JD', '2026-09-04 22:26:04'),
(19, 20, 6, '2026-08-01', '2026-10-31', 'Active', '60JD', '2026-09-04 22:26:04'),
(20, 21, 3, '2026-08-01', '2026-09-30', 'Cancelled', '25JD', '2026-09-04 22:26:04'),
(21, 22, 9, '2026-03-01', '2026-08-31', 'Expired', '100JD', '2026-09-04 22:26:04'),
(22, 23, 9, '2026-07-01', '2026-12-31', 'Active', '100JD', '2026-09-04 22:26:04'),
(23, 5, 1, '2026-09-23', '2026-10-23', 'Active', '15JD', '2026-09-07 18:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

DROP TABLE IF EXISTS `trainers`;
CREATE TABLE IF NOT EXISTS `trainers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `specialization` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trains_gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `experience_years` int(11) NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`Id`, `first_name`, `last_name`, `email`, `phone`, `gender`, `specialization`, `trains_gender`, `experience_years`, `profile_image`, `created_at`) VALUES
(1, 'Ahmad', 'Shatnawi', 'ahmad@email.com', '0779988776', 'male', 'Bodybuilding', 'male', 5, 'Bodybuilding.jpg', '2026-08-30 19:15:15'),
(2, 'Basil', 'Bataineh', 'basil@email.com', '0779977665', 'male', 'Warm-up', 'male', 4, 'MWarm-up.jpg', '2026-08-30 19:15:15'),
(3, 'Lama', 'Daoud', 'lama@email.com', '0779966554', 'female', 'Yuga', 'female', 6, 'Yoga.jpg', '2026-08-30 19:15:15'),
(4, 'Jana', 'Khalaileh', 'jana@email.com', '0779955443', 'female', 'Warm-up', 'female', 4, 'FeWarm-up.jpg', '2026-08-30 19:15:15'),
(5, 'Kamal', 'Mhanna', 'kamal@email.com', '0779944332', 'male', 'Fitness', 'male', 6, 'MFitness.jpg', '2026-08-30 19:15:15'),
(6, 'Manar', 'Smadi', 'manar@email.com', '0779933221', 'female', 'Swimming', 'female', 7, 'FeSwimming.jpg', '2026-08-30 19:15:15'),
(7, 'Mohammed', 'Nasir', 'mohammed@email.com', '0779922110', 'male', 'Swimming', 'male', 7, 'MSwimming.jpg', '2026-08-30 19:15:15'),
(8, 'Noor', 'Jalal', 'noor@email.com', '0779911009', 'female', 'Fitness', 'female', 6, 'FeFitness.jpg', '2026-08-30 19:15:15'),
(9, 'Kareem', 'Ziad', 'kareem@email.com', '0779987985', 'male', 'Fitness', 'male', 5, 'uploads/new4M.jpg', '2026-09-02 22:21:51'),
(12, 'Hashem', 'Galal', 'hashem@email.com', '0293485986', 'male', 'Bodybuilding', 'male', 6, 'uploads/new9M.jpg', '2026-09-07 18:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','staff') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `username`, `password`, `email`, `role`, `created_at`, `last_login`) VALUES
(1, 'GymAdmin', '#Admin01', 'abmin@email.com', 'admin', '2026-08-28 19:56:21', '2026-08-28 19:51:56'),
(2, 'GymStaff', '#Staff01', 'staff@email.com', 'staff', '2026-08-28 19:56:21', '2026-08-28 19:51:56');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_members`
--
ALTER TABLE `class_members`
  ADD CONSTRAINT `class_members_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_members_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership_plans`
--
ALTER TABLE `membership_plans`
  ADD CONSTRAINT `membership_plans_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `membership_types` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `membership_plans` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
