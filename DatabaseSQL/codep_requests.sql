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
-- Table structure for table `codep_requests`
--

CREATE TABLE IF NOT EXISTS `codep_requests` (
  `request_id` int(11) NOT NULL,
  `requested_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `teacher_name` varchar(80) NOT NULL,
  `school` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `address` text NOT NULL,
  `number_students` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `codep_requests`
--

INSERT INTO `codep_requests` (`request_id`, `requested_date`, `created`, `teacher_name`, `school`, `email`, `address`, `number_students`, `message`, `status`, `user_id`) VALUES
(5, '2017-04-14 09:00:00', '2017-04-06 13:19:18', 'Brendan Beakey', 'Scoil Christie', 'dbeakey@tcd.ie', 'Dublin 9', 123, 'Would love to get a meeting with a mentor', 0, 5),
(6, '2017-04-05 09:00:00', '2017-04-06 13:20:04', 'David beakey', 'guyfu', 'yfou', 'fouff', 123, 'yfuoy', 0, 8),
(7, '2017-04-07 13:00:00', '2017-04-06 13:23:44', 'ig', 'iu', 'gi', 'ugugi', 123, 'iug', 0, 8),
(8, '2017-04-07 13:00:00', '2017-04-06 13:23:57', 'ig', 'iug', 'iug', 'ig', 0, 'iug', 0, 8),
(9, '2017-04-04 13:00:00', '2017-04-06 13:25:07', '8yuf', 'fluof', 'fo', 'foo', 0, 'g', 0, 8),
(10, '2017-04-04 13:00:00', '2017-04-06 13:25:31', 'lyug', 'ulguyguog', 'ogu', 'oguo', 1234, 'ljgy', 0, 8),
(11, '2017-04-04 13:00:00', '2017-04-06 13:35:15', 'puyg', 'ug', 'uo', 'ggogu', 12, '', 0, 8),
(12, '2017-04-04 13:00:00', '2017-04-06 13:36:24', 'yifiyt', 'tfi', 'f', 'fi', 12, 'fiy', 0, 8),
(13, '2017-04-04 13:00:00', '2017-04-06 13:38:03', 'uygo', 'ugo', 'gugou', 'guogouy', 12, 'ugo', 0, 8),
(14, '2017-04-04 13:00:00', '2017-04-06 13:39:09', 'ktfytftyfyi', 'yf', 'iyf', 'tiy', 0, 'fiytf', 0, 8),
(15, '2017-04-04 13:00:00', '2017-04-06 13:39:29', 'iu', 'yu', 'gyu', 'gouyg', 0, 'oug', 0, 8),
(16, '2017-04-04 13:00:00', '2017-04-06 13:40:34', 'ugg', 'guy', 'guyguygu', 'gugyguyyuuy', 0, 'uy', 0, 8),
(17, '2017-04-07 13:00:00', '2017-04-06 13:41:07', 'yg', 'ugygyu', 'gu', 'guy', 0, 'ug', 0, 8),
(18, '2017-04-04 13:00:00', '2017-04-06 13:46:23', 'David beakey', 'dbeakey', 'dbeakey@tcd.ie', '83 Charlemont', 123, 'igououy', 0, 8),
(19, '2017-04-04 13:00:00', '2017-04-06 13:46:36', 'ugiug', 'iugigiu', 'gufuy', 'yuyg', 123, 'ig', 0, 8),
(20, '2017-04-04 13:00:00', '2017-04-06 13:47:49', 'David Beakey', 'gyg', 'uigguigui', 'ugiug', 123, 'ihog', 0, 8),
(21, '2017-04-04 13:00:00', '2017-04-06 15:02:57', 'iughiuh', 'uiiuhiu', 'davidbeakey@gmail.com', 'giuh', 123, 'uhihiuh', 0, 8),
(22, '2017-04-04 13:00:00', '2017-04-06 15:04:23', 'ouhiuh', 'uuhih', 'davidbeakey@gmail.com', 'yuguy', 12, 'uihuihi', 0, 8),
(23, '2017-04-04 13:00:00', '2017-04-06 15:06:08', 'iohu', 'hiu', 'davidbeakey@gmail.com', 'uuih', 1234, 'hiu', 0, 8),
(24, '2017-04-04 13:00:00', '2017-04-06 15:07:18', 'iuhiu', 'uih', 'davidbeakey@gmail.com', 'yhi', 123, 'huihiuh', 0, 8),
(25, '2017-04-04 13:00:00', '2017-04-06 15:08:06', 'iuhiu', 'uih', 'davidbeakey@gmail.com', 'yhi', 123, 'huihiuh', 0, 8),
(26, '2017-04-04 13:00:00', '2017-04-06 15:08:23', 'uhiuih', 'uihhiuh', 'davidbeakey@gmail.com', 'ygug', 123, 'iuhiuh', 0, 8),
(27, '2017-04-04 13:00:00', '2017-04-06 15:10:47', 'iu', 'ihuui', 'davidbeakey@gmail.com', 'yguyguy', 1234, 'iuhu', 0, 8),
(28, '2017-04-04 13:00:00', '2017-04-06 15:20:15', 'iuiu', 'giu', 'davidbeakey@gmail.com', 'ygyuguy', 1234, 'gigi', 0, 8),
(29, '2017-04-04 13:00:00', '2017-04-06 15:21:11', 'ihoih', 'uhiuhui', 'davidbeakey@gmail.com', 'uigiu', 123, 'uihi', 0, 8),
(30, '2017-04-04 13:00:00', '2017-04-06 15:21:59', 'iuhiu', 'igiuuig', 'davidbeakey@gmail.com', 'iugiug', 123, 'hiug', 0, 8),
(31, '2017-04-07 13:00:00', '2017-04-06 15:31:41', 'jhj', 'gj', 'davidbeakey@gmail.com', 'ku', 23456, 'jgj', 0, 8),
(32, '2017-04-14 09:00:00', '2017-04-06 20:21:55', 'uihiu', 'hiuhuih', 'davidbeakey@gmail.com', 'huih', 123, 'hhiuiu', 0, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codep_requests`
--
ALTER TABLE `codep_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codep_requests`
--
ALTER TABLE `codep_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `codep_requests`
--
ALTER TABLE `codep_requests`
  ADD CONSTRAINT `codep_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `codep_mentors` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
