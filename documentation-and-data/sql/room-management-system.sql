-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2013 at 03:19 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `room-management-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `book-resource`
--

CREATE TABLE IF NOT EXISTS `book-resource` (
  `idUser` int(8) NOT NULL AUTO_INCREMENT,
  `idResource` int(8) NOT NULL DEFAULT '0',
  `startTime` int(8) DEFAULT NULL,
  `endTime` int(8) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUser`,`idResource`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `book-resource`
--


-- --------------------------------------------------------

--
-- Table structure for table `book-room`
--

CREATE TABLE IF NOT EXISTS `book-room` (
  `idUser` int(8) NOT NULL AUTO_INCREMENT,
  `idRoom` int(8) NOT NULL DEFAULT '0',
  `startTime` int(8) DEFAULT NULL,
  `endTime` int(8) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUser`,`idRoom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `book-room`
--


-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `buildings`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `permissions`
--


-- --------------------------------------------------------

--
-- Table structure for table `qualities`
--

CREATE TABLE IF NOT EXISTS `qualities` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `qualities`
--


-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `idCategory` int(8) NOT NULL,
  `idQuality` int(8) NOT NULL,
  `numbers` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `resources`
--


-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `idBuilding` int(8) DEFAULT NULL,
  `idQuality` int(2) DEFAULT NULL,
  `number` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rooms`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pid`, `hidden`, `disabled`, `deleted`, `created_time`, `created_user`, `last_modified_time`, `last_modified_user`, `valid_time_start`, `valid_time_end`, `username`, `password`, `email`, `last_login_time`, `display_name`, `state`) VALUES
(10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '$2a$14$rtSToetJ/oghi0jfPTzImeqnlOjJsRdhbVX6K1.HyfFZQSJwREpjG', 'student@itc.edu', 0, NULL, NULL),
(11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '$2a$14$NvaMIpYsbCa7bNu0OkwmUuRDZy5XvBD/vFozG.k7rj/zYMB8bs49y', 'teacher@itc.edu', 0, NULL, NULL),
(12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '$2a$14$q4pL1TLXx75XyAyhypvb6Of7Y61AWEZBhLYMi4VCYhFaJzgpoL6km', 'teacher2@itc.edu', 0, NULL, NULL),
(13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '$2a$14$BjB1185Pw.cP3KPeC1PapeAJHGGUWFWLY.dyvJusvWZB3qhX5GATy', 'qwert@a.com', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user-groups`
--

CREATE TABLE IF NOT EXISTS `user-groups` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user-groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `dateOfBirth` int(8) DEFAULT NULL,
  `email` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `dateOfBirth`, `email`) VALUES
(1, 'se som', 5, 'sesomitc41@gmail.com'),
(2, 'rady', 6, 'rady@gmail.com');

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
('guest', 1, NULL),
('student', 0, NULL),
('teacher', 0, NULL);

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
-- Dumping data for table `user_role_linker`
--

INSERT INTO `user_role_linker` (`user_id`, `role_id`) VALUES
(10, 'student'),
(11, 'teacher'),
(12, 'teacher');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_role_linker`
--
ALTER TABLE `user_role_linker`
  ADD CONSTRAINT `user_role_linker_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_linker_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
