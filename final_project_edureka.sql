-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2022 at 05:29 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project_edureka`
--

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `booking_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `s_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`booking_id`, `u_id`, `item_quantity`, `cost`, `order_date`, `end_date`, `s_id`) VALUES
(1, 1, 1000, 123000, '2022-01-02 12:44:00', '2022-01-02 12:44:00', 8),
(2, 1, 1000, 12000, '2022-01-05 11:55:00', '2022-01-21 11:56:00', 10),
(3, 1, 200, 2400, '2021-12-30 11:56:00', '2022-01-06 11:56:00', 10),
(4, 1, 20, 240, '2022-01-14 11:59:00', '2022-01-22 11:59:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `Query`
--

CREATE TABLE `Query` (
  `q_id` int(2) NOT NULL,
  `u_id` int(2) NOT NULL,
  `username` varchar(100) NOT NULL,
  `query_msg` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Query`
--

INSERT INTO `Query` (`q_id`, `u_id`, `username`, `query_msg`) VALUES
(3, 1, 'vsp', 'dgfdsfdgfhjhkjl.');

-- --------------------------------------------------------

--
-- Table structure for table `Storage`
--

CREATE TABLE `Storage` (
  `s_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `cost` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `img_path` varchar(1000) DEFAULT NULL,
  `consumed` int(11) NOT NULL DEFAULT 0,
  `remains` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Storage`
--

INSERT INTO `Storage` (`s_id`, `name`, `cost`, `quantity`, `description`, `img_path`, `consumed`, `remains`) VALUES
(8, 'dgfhg trdgf', 123, 13245, 'etrthryjkyhbjnm', 'uploads/gourav.jpeg', 200, 34),
(10, 'qq', 12, 1234, 'gfhgjnm', 'uploads/mpokket - Corporate Training on PHP ( 14th Dec - 27th Dec { 10_00 AM - 1_00 PM IST ) 12_14_2021, 11_25_49 AM.png', 20, 14);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `u_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(1000) DEFAULT NULL,
  `zip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`u_id`, `name`, `username`, `password`, `city`, `state`, `zip`) VALUES
(1, 'vsp', 'vsp', '123', '', 'gwadhj', 0),
(2, 'Vishal', 'vishal.sharma@mpokket.com', '111', 'Saharanpur', 'Jharkhand', 1111),
(3, '11', 'vishal.sharma@mpokket.com', '11', '11', 'Madhya Pradesh', 11),
(4, 'Vishal', 'vishal.sharma@mpokket.com', 'sznbd', 'awvhbd', 'Manipur', 11111),
(5, 'Vishal', 'vishal.sharma@mpokket.com', 'qqq', 'Saharanpur', 'Kerala', 1111),
(6, 'Vishal', 'sharmadipanshu558@gmail.com', '222', 'Saharanpur', 'Maharashtra', 2222);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `Query`
--
ALTER TABLE `Query`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `Storage`
--
ALTER TABLE `Storage`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Query`
--
ALTER TABLE `Query`
  MODIFY `q_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Storage`
--
ALTER TABLE `Storage`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `Storage` (`s_id`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `Users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
