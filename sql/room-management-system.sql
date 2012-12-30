-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2012 at 09:35 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

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
-- Table structure for table `book-resource`
--

CREATE TABLE IF NOT EXISTS `book-resource` (
  `idUser` int(8) NOT NULL DEFAULT '0' auto increment,
  `idResource` int(8) NOT NULL DEFAULT '0',
  `startTime` int(8) DEFAULT NULL,
  `endTime` int(8) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUser`,`idResource`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book-room`
--

CREATE TABLE IF NOT EXISTS `book-room` (
  `idUser` int(8) NOT NULL DEFAULT '0' auto increment,
  `idRoom` int(8) NOT NULL DEFAULT '0',
  `startTime` int(8) DEFAULT NULL,
  `endTime` int(8) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUser`,`idRoom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `id` int(8) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(8) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(8) DEFAULT NULL,
  `name` varchar(127) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qualities`
--

CREATE TABLE IF NOT EXISTS `qualities` (
  `id` int(8) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(8) DEFAULT NULL,
  `idCategory` int(8) NOT NULL,
  `idQuality` int(8) NOT NULL,
  `numbers` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(8) NOT NULL DEFAULT '0',
  `idBuilding` int(8) DEFAULT NULL,
  `idQuality` int(2) DEFAULT NULL,
  `number` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user-groups`
--

CREATE TABLE IF NOT EXISTS `user-groups` (
  `id` int(8) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `dateOfBirth` int(8) DEFAULT NULL,
  `email` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `dateOfBirth`, `email`) VALUES
(2, 'speeder', NULL, NULL),
(3, 'speeder', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
