-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 07, 2013 at 06:58 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `room-management-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT '0',
  `hidden` tinyint(1) unsigned DEFAULT '0',
  `disabled` tinyint(1) unsigned DEFAULT '0',
  `deleted` tinyint(1) unsigned DEFAULT '0',
  `created_time` int(11) unsigned DEFAULT '0',
  `created_user` int(11) unsigned DEFAULT '0',
  `last_modified_time` int(11) unsigned DEFAULT '0',
  `last_modified_user` int(11) unsigned DEFAULT '0',
  `valid_time_start` int(11) unsigned DEFAULT '0',
  `valid_time_end` int(11) unsigned DEFAULT '0',
  `username` varchar(64) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `email` varchar(64) DEFAULT '',
  `last_login_time` int(11) unsigned DEFAULT '0',
  `display_name` varchar(50) DEFAULT NULL,
  `state` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pid`, `hidden`, `disabled`, `deleted`, `created_time`, `created_user`, `last_modified_time`, `last_modified_user`, `valid_time_start`, `valid_time_end`, `username`, `password`, `email`, `last_login_time`, `display_name`, `state`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '$2y$14$RvA2qBmnFONy6RR0XmZTX.dzDOOQnI4sjtDrJ8cEd0zObKzRVDsaG', 'speeder.nfh@gmail.com', 0, NULL, NULL),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '$2y$14$4UF.TYCN6i6LUkWsB8Pvs.M3IBnk/ZTKWdTbn.mQ/IG6Ic5PtdiYO', 'annliratanak@gmail.com', 0, NULL, NULL),
(5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '$2y$14$1/P8tMrE1OsOizUeodyTduV0wuZxMSmrwb6OORw2b20x40V/wQgP2', 'liratanak@speeder.com', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `parent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `default`, `parent`) VALUES
('admin', 0, 'user'),
('guest', 1, NULL),
('user', 0, 'guest');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_linker`
--

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(11) unsigned NOT NULL,
  `role_id` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_role_linker`
--
ALTER TABLE `user_role_linker`
  ADD CONSTRAINT `user_role_linker_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_linker_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
