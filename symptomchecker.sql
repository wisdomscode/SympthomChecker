-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2020 at 08:15 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `symptomchecker`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE IF NOT EXISTS `diagnosis` (
`id` int(3) NOT NULL,
  `patient_id` int(3) NOT NULL,
  `validity` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `patient_id`, `validity`, `date`) VALUES
(1, 1, 'Invalid', '0000-00-00 00:00:00'),
(2, 1, 'Invalid', '0000-00-00 00:00:00'),
(3, 2, 'Valid', '0000-00-00 00:00:00'),
(4, 3, 'Invalid', '0000-00-00 00:00:00'),
(5, 1, 'Valid', '0000-00-00 00:00:00'),
(6, 2, 'Valid', '0000-00-00 00:00:00'),
(7, 2, 'Invalid', '0000-00-00 00:00:00'),
(8, 1, 'Valid', '2020-10-08 23:00:00'),
(9, 1, 'Invalid', '2020-10-08 23:00:00'),
(10, 6, 'Valid', '2020-10-08 23:00:00'),
(11, 2, 'Valid', '2020-10-08 23:00:00'),
(12, 4, 'Valid', '2020-10-10 04:38:13'),
(13, 3, 'Invalid', '2020-10-10 04:46:01'),
(14, 3, 'Valid', '2020-10-10 04:47:41'),
(15, 6, 'Valid', '2020-10-10 05:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
`id` int(11) NOT NULL,
  `patient_no` varchar(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `next_of_kin` text NOT NULL,
  `nok_phone` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_no`, `first_name`, `last_name`, `age`, `gender`, `address`, `phone`, `next_of_kin`, `nok_phone`) VALUES
(1, 'MED1001', 'Mary', 'Samson', 34, 'Female', 'Garki, Abuja', '080489345728', 'Amos Samson', '09034458677'),
(2, 'MED1002', 'Kunle', 'Jacobs', 34, 'Male', 'Garki, Abuja', '08063393067', 'Charles Akin', '080234454542'),
(3, 'MED1003', 'Esther', 'Obi', 28, 'Female', 'Garki, Abuja', '08063393067', 'Emeka Obi', '080234454542'),
(4, 'MED1004', 'Chuks', 'Anthony', 32, 'Male', 'Garki, Abuja', '0804546454656', 'Amos Samson', '080234454542'),
(5, 'MED1005', 'Musa', 'Adamu', 24, 'Male', 'Garki, Abuja', '08063393090', 'Charles Akin', '080234454542'),
(6, 'MED1006', 'Fatima', 'Abdul', 25, 'Female', 'Garki, Abuja', '08049568694', 'Adamu Mohammed', '080564723456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
