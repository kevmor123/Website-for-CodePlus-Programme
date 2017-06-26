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
-- Table structure for table `codep_mentors`
--

CREATE TABLE IF NOT EXISTS `codep_mentors` (
  `email` varchar(80) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `password_hash` varchar(80) NOT NULL,
  `user_id` int(8) NOT NULL,
  `image_path` varchar(200) NOT NULL,
  `name` varchar(80) NOT NULL,
  `job_title` varchar(40) NOT NULL,
  `school` varchar(80) DEFAULT NULL COMMENT 'In case mentor has just started',
  `description` text NOT NULL COMMENT 'null needs to be checked for decription if it is optional',
  `home_address` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `codep_mentors`
--

INSERT INTO `codep_mentors` (`email`, `admin`, `password_hash`, `user_id`, `image_path`, `name`, `job_title`, `school`, `description`, `home_address`) VALUES
('dbeakey@tcd.ie', 1, '$2y$10$fNy7oIU8CRcwQ3d7nBqAQuTaIBFASZIZ5fe6L2ZJQt9SuCuD3.mWS', 5, 'uploads/1491355881-451.PNG', 'David Beakey', 'Trinity College Dublin', 'reg', '', 'Dublin 9'),
('georgeHeffman@gmail.com', 0, '$2y$10$UCGmI.IRbekGiFT70lmXx.DGBnZnR4HcY5R9zK5jdMumsykiZlO8e', 6, '', 'George Heffman', 'Developer', 'Loretto', '', 'D9'),
('tombounty@gmail.com', 0, '$2y$10$2iOzq.MdoEvZ8DduC/ympuhDAGhkh0a1FCm0mYAtEkYcYVeGlcgs.', 7, 'uploads/1491409191-woman-profile-silhouette-clipart.jpg', 'Tom Bounty', 'Programmer', 'Maryfield', 'I like aninals', 'D10'),
('marydonnel@gmail.com', 0, '$2y$10$P.gFFXuR/9K7N.o.pswF..hWx6vIchp0Ao2IzoZTOJv4fZxE/XU7m', 8, 'uploads/1491508246-woman-profile-silhouette-clipart.jpg', 'fwefwef', 'Project Manager', 'Scoil Christie', 'ghjh', 'D2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codep_mentors`
--
ALTER TABLE `codep_mentors`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codep_mentors`
--
ALTER TABLE `codep_mentors`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
