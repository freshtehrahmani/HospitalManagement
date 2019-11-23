-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2019 at 06:49 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `std_prj_4`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `description`) VALUES
(3, 'Orthopedic  ', 'Orthopedic   Descriptions'),
(4, 'Neuro Surgery   ', 'Neuro Surgery   department'),
(5, 'dental', 'description about dental');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `department` int(10) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `birth_date` varchar(20) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `country` varchar(30) NOT NULL,
  `state` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `about` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `meta` text NOT NULL,
  `user_id` int(15) NOT NULL,
  `picture` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `nic`, `department`, `blood_group`, `birth_date`, `sex`, `email`, `phone`, `country`, `state`, `address`, `about`, `name`, `meta`, `user_id`, `picture`) VALUES
(2, '123456789', 4, '0', '10/10/2011', '0', 'Email@email.com', '000008887', 'AF', 'Herat', 'Mirpur, Dhaka, Bangladesh', ':)', 'Doctor 1', '', 0, 'http://localhost/hospital/uploads/doctor-3.jpg'),
(4, '2', 4, '0', '', '0', 'lipsha.com@gmail.com3', '', 'BD', '', '', '', 'Doctor 2', '', 0, 'http://localhost/hospital/uploads/doctor-2.jpg'),
(5, '45548 3', 4, '0', '10/10/2003', '0', 'email@email.com', '0770185057', 'AF', 'Herat', 'Herat-Afghanistan', 'Abouttttt', 'Ahmad DR', '', 0, 'http://localhost/hospital/uploads/doctor-1.jpg'),
(6, '345345', 3, '0', '', '0', '', '0770185057', 'AF', 'Herat', 'Herat-Afghanistan', '', 'Karim', '', 0, 'http://localhost/std_prj_4/uploads/prisesche food.png');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_schedule`
--

CREATE TABLE `doctors_schedule` (
  `id` int(50) NOT NULL,
  `doctor_id` int(50) NOT NULL,
  `day_of_week` varchar(9) NOT NULL,
  `start_time` varchar(15) NOT NULL,
  `end_time` varchar(15) NOT NULL,
  `max_num_of_patients` int(11) NOT NULL,
  `fees` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `comment` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors_schedule`
--

INSERT INTO `doctors_schedule` (`id`, `doctor_id`, `day_of_week`, `start_time`, `end_time`, `max_num_of_patients`, `fees`, `status`, `comment`) VALUES
(7, 5, 'Monday', '10 am', '11 am', 5, '200', '', ''),
(8, 5, 'Tuesday', '10 am', '11 am', 5, '200', '', ''),
(9, 4, 'Friday', '10 am', '12 am', 10, '399', '', '10 % discount'),
(10, 4, 'Wednesday', '10am', '1pm', 25, '250', '', 'dsf'),
(11, 2, 'Sunday', '10am', '1pm', 25, '250', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `department` int(10) NOT NULL,
  `birth_date` varchar(12) NOT NULL,
  `age` int(10) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `email` varchar(50) NOT NULL,
  `county` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `about` text NOT NULL,
  `guardian_name` varchar(150) NOT NULL,
  `guardian_phone` varchar(20) NOT NULL,
  `guardian_details` varchar(50) NOT NULL,
  `bad_no` int(20) NOT NULL,
  `referred_by` int(10) NOT NULL,
  `reg_date` varchar(20) NOT NULL,
  `descriptions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `phone`, `blood_group`, `department`, `birth_date`, `age`, `sex`, `email`, `county`, `city`, `address`, `about`, `guardian_name`, `guardian_phone`, `guardian_details`, `bad_no`, `referred_by`, `reg_date`, `descriptions`) VALUES
(17, 'ali', '0770185057', '0', 3, '', 0, '0', '', 'AF', 'herat', 'Herat-Afghanistan', '', '', '', '', 1, 5, '', ''),
(18, 'hassan', '0770185057', '0', 5, '', 0, '0', '', 'AF', 'herat', 'Herat-Afghanistan', '', '', '', '', 0, 6, '', ''),
(19, 'Karim', '0770185057', '0', 5, '', 0, '0', '', 'AF', 'herat', 'Herat-Afghanistan', '', '', '', '', 0, 6, '', ''),
(20, 'Mahmood', '0770185057', '0', 5, '', 0, '0', '', 'AF', 'herat', 'Herat-Afghanistan', '', '', '', '', 0, 6, '', ''),
(21, 'Reza', '0770185057', '0', 5, '', 0, '0', '', 'AF', 'herat', 'Herat-Afghanistan', '', '', '', '', 0, 6, '', ''),
(22, 'Dawood', '0770185057', '0', 5, '', 0, '0', '', 'AF', 'herat', 'Herat-Afghanistan', '', '', '', '', 0, 6, '', ''),
(23, 'Ebrahim', '0770185057', '0', 5, '', 0, '0', '', 'AF', 'herat', 'Herat-Afghanistan', '', '', '', '', 0, 6, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `role` varchar(15) NOT NULL,
  `picture` varchar(150) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `full_name`, `email`, `last_login`, `role`, `picture`, `profile_id`) VALUES
(23, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Baqir Alizada', 'email@email.com', '2019-11-06 06:00:08', 'admin', 'http://localhost/std_prj_4/uploads/20150901_112058.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors_schedule`
--
ALTER TABLE `doctors_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctors_schedule`
--
ALTER TABLE `doctors_schedule`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
