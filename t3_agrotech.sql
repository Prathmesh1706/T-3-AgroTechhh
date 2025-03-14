-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 11:35 AM
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
-- Database: `t3_agrotech`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Pratham', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `doorsteppurchase_booking`
--

CREATE TABLE `doorsteppurchase_booking` (
  `book_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `grain_type` varchar(255) NOT NULL,
  `totalgrain_quintal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mobile_no` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Booked',
  `service_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doorsteppurchase_booking`
--

INSERT INTO `doorsteppurchase_booking` (`book_id`, `user_id`, `grain_type`, `totalgrain_quintal`, `created_at`, `mobile_no`, `status`, `service_type`) VALUES
(5, 'Pratham', '2', 10, '2024-04-25 13:11:11', '0000000000', 'Booked', 'डोअरस्टेप विक्री');

-- --------------------------------------------------------

--
-- Table structure for table `tractor_booking`
--

CREATE TABLE `tractor_booking` (
  `book_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `number_of_acres` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mobile_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Booked',
  `service_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tractor_booking`
--

INSERT INTO `tractor_booking` (`book_id`, `user_id`, `date`, `number_of_acres`, `total_price`, `created_at`, `mobile_no`, `status`, `service_type`) VALUES
(29, 'Pratham', '2024-04-26', '10', 10000.00, '2024-04-25 14:03:38', '0000000000', 'Booked', 'ट्रॅक्टर सर्विस');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `acre` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `taluka` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pin_code` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `mobile_no`, `acre`, `village`, `taluka`, `district`, `state`, `pin_code`, `user_id`, `password`) VALUES
(0, 'Prathmesh P', '8421113771', '5', 'Udgir', 'Udgir', 'Latur', 'Maharashtra', '413512', 'Pratham', '1111'),
(22, 'Prathmesh Pandarge', '8421113771', '000', '0000', 'Gangakhed', 'Parbhani', 'Maharashtra', '413512', '8421113771', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_booking`
--

CREATE TABLE `warehouse_booking` (
  `book_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `grain_type` varchar(255) NOT NULL,
  `no_of_katta_50kg` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mobile_no` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Booked',
  `service_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse_booking`
--

INSERT INTO `warehouse_booking` (`book_id`, `user_id`, `location`, `grain_type`, `no_of_katta_50kg`, `total_price`, `created_at`, `mobile_no`, `status`, `service_type`) VALUES
(3, 'Pratham', '1', '2', '10', 50.00, '2024-04-25 12:22:28', '0000000000', 'Success', 'वेअरहाउस'),
(4, 'Pratham', '2', '3', '10', 50.00, '2024-04-25 13:09:21', '1111111111', 'Booked', 'वेअरहाउस'),
(5, 'Pratham', '1', '2', '10', 50.00, '2024-05-14 09:14:31', '0000000000', 'Booked', 'वेअरहाउस');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doorsteppurchase_booking`
--
ALTER TABLE `doorsteppurchase_booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tractor_booking`
--
ALTER TABLE `tractor_booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `warehouse_booking`
--
ALTER TABLE `warehouse_booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doorsteppurchase_booking`
--
ALTER TABLE `doorsteppurchase_booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tractor_booking`
--
ALTER TABLE `tractor_booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `warehouse_booking`
--
ALTER TABLE `warehouse_booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doorsteppurchase_booking`
--
ALTER TABLE `doorsteppurchase_booking`
  ADD CONSTRAINT `doorsteppurchase_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tractor_booking`
--
ALTER TABLE `tractor_booking`
  ADD CONSTRAINT `tractor_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `warehouse_booking`
--
ALTER TABLE `warehouse_booking`
  ADD CONSTRAINT `warehouse_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
