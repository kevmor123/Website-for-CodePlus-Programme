-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2017 at 08:26 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `codep_calendar`
--

CREATE TABLE IF NOT EXISTS `codep_calendar` (
  `user_id` int(8) NOT NULL,
  `day` datetime NOT NULL,
  `busy_scale` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `codep_calendar`
--

INSERT INTO `codep_calendar` (`user_id`, `day`, `busy_scale`) VALUES
(5, '2017-04-14 09:00:00', 2),
(1, '2017-04-06 13:00:00', 0),
(8, '2017-04-13 13:00:00', 2),
(8, '2017-04-05 09:00:00', 0),
(8, '2017-04-04 13:00:00', 0),
(8, '2017-04-01 09:00:00', 0),
(7, '2017-04-01 09:00:00', 0),
(8, '2017-04-07 13:00:00', 0),
(8, '2017-04-05 13:00:00', 0),
(8, '2017-05-06 09:00:00', 0),
(8, '2017-04-03 09:00:00', 0),
(0, '2017-04-01 09:00:00', 0),
(8, '2017-04-13 09:00:00', 0),
(8, '2017-04-06 09:00:00', 0),
(8, '2017-04-12 09:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
