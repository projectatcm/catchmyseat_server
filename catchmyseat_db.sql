-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2017 at 11:28 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catchmyseat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `licence` text NOT NULL,
  `fcm_id` text NOT NULL,
  `device_id` text NOT NULL,
  `rc_book` text NOT NULL,
  `vehicle_no` text NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `vehicle_image` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `mobile`, `password`, `avatar`, `licence`, `fcm_id`, `device_id`, `rc_book`, `vehicle_no`, `vehicle_type`, `vehicle_name`, `vehicle_image`, `status`) VALUES
(5, 'prasanth', '907238880', '123', 'files/driver/prasanth58d2d5969e9c0.jpg', 'files/licence/prasanth58d2d5969e9d9.jpg', 'dF9L37xIMmc:APA91bHFYDc9K7wbd0CKAk_Gqp2MlN4zt9w9-CWnEn-MGASgRfSp58SXG9OHF9-mM_HaoJMKB1Fdt9K6z7b_0rZpObKGcq_KIaQZJNvf4Rc7j5HN-6NdBIuQP8k5W1IBmsoC4ZyUPCcG', 'a6f54fa3a65ad70e', 'files/rc_book/prasanth58d2d5969e9e0.jpg', '1234556', 'Car', 'figo', 'files/vehicle/prasanth58d2d5969e9d1.jpg', 0),
(6, 'Jeybin', '9072388804', 'jeybin', 'files/driver/Jeybin58d2d70220069.jpg', 'files/licence/Jeybin58d2d7022008b.jpg', 'dF9L37xIMmc:APA91bHFYDc9K7wbd0CKAk_Gqp2MlN4zt9w9-CWnEn-MGASgRfSp58SXG9OHF9-mM_HaoJMKB1Fdt9K6z7b_0rZpObKGcq_KIaQZJNvf4Rc7j5HN-6NdBIuQP8k5W1IBmsoC4ZyUPCcG', 'a6f54fa3a65ad70e', 'files/rc_book/Jeybin58d2d70220097.jpg', '7890642', 'Car', 'swift', 'files/vehicle/Jeybin58d2d7022007e.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `geo`
--

CREATE TABLE `geo` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `geo`
--

INSERT INTO `geo` (`id`, `driver_id`, `latitude`, `longitude`) VALUES
(2, 6, '10.24380633585751', '76.26351023730274');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `device_id` text NOT NULL,
  `fcm_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`id`, `name`, `mobile`, `password`, `avatar`, `device_id`, `fcm_id`) VALUES
(1, 'Prasanth', '9496347779', 'a', 'dF9L37xIMmc:APA91bHFYDc9K7wbd0CKAk_Gqp2MlN4zt9w9-CWnEn-MGASgRfSp58SXG9OHF9-mM_HaoJMKB1Fdt9K6z7b_0rZpObKGcq_KIaQZJNvf4Rc7j5HN-6NdBIuQP8k5W1IBmsoC4ZyUPCcG', '', 'a6f54fa3a65ad70e'),
(2, 'Prasanth', '9496347779', 'a', 'dF9L37xIMmc:APA91bHFYDc9K7wbd0CKAk_Gqp2MlN4zt9w9-CWnEn-MGASgRfSp58SXG9OHF9-mM_HaoJMKB1Fdt9K6z7b_0rZpObKGcq_KIaQZJNvf4Rc7j5HN-6NdBIuQP8k5W1IBmsoC4ZyUPCcG', '', 'a6f54fa3a65ad70e'),
(3, 'prasanth', '9072388801', '123', 'dF9L37xIMmc:APA91bHFYDc9K7wbd0CKAk_Gqp2MlN4zt9w9-CWnEn-MGASgRfSp58SXG9OHF9-mM_HaoJMKB1Fdt9K6z7b_0rZpObKGcq_KIaQZJNvf4Rc7j5HN-6NdBIuQP8k5W1IBmsoC4ZyUPCcG', 'files/passenger/prasanth58d07ee819c26.jpg', 'a6f54fa3a65ad70e');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `rc_book` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `geo`
--
ALTER TABLE `geo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `geo`
--
ALTER TABLE `geo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
