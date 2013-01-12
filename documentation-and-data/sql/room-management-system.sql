drop database `room-management-system`;
create database `room-management-system`
	default character set utf8
	default collate utf8_general_ci;
USE `room-management-system`;

--
-- Table structure for table `book_resource`
--

CREATE TABLE IF NOT EXISTS `book_resource` (
  `user_id` int(8),
  `resource_id` int(8),
  `start_time` int(8) DEFAULT NULL,
  `end_time` int(8) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`resource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quality`
--

CREATE TABLE IF NOT EXISTS `quality` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `category_id` int(8) DEFAULT NULL,
  `quality_id` int(8) DEFAULT NULL,
  `numbers` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `quality_id` (`quality_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `building_id` int(8) DEFAULT NULL,
  `quality_id` int(2) DEFAULT NULL,
  `number` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `building_id` (`building_id`),
  KEY `quality_id` (`quality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned AUTO_INCREMENT,
  `disabled` tinyint(1) unsigned DEFAULT '0',
  `deleted` tinyint(1) unsigned DEFAULT '0',
  `username` varchar(64) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `email` varchar(64) DEFAULT '',
  `last_login_time` int(11) unsigned DEFAULT '0',
  `display_name` varchar(50) DEFAULT NULL,
  `state` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;
-- 
-- ALTER TABLE `book_room`
--   ADD FOREIGN KEY (`room_id`) REFERENCES `room`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
--  ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)ON UPDATE SET NULL;
-- --
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `disabled`, `deleted`, `username`, `password`, `email`, `last_login_time`, `display_name`, `state`) VALUES
(15, 0, 0, NULL, '$2a$14$cFAiEr7yDzDLsuDUCsvxH.hrF8NkmJhJZ76yARrOcL7Wjv9zEUgti', 'odom@gmail.com', 0, NULL, NULL),
(16, 0, 0, NULL, '$2a$14$CcRwUoN3yLxlKCccNZ3OC.9VgTQim4UCqbJgXI2E8EzASY.r2qvBS', 'odom.john@hotmail.com', 0, NULL, NULL),
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, NULL, 'odom', 'pasword', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` varchar(255) NOT NULL DEFAULT '',
  `default` tinyint(1) DEFAULT NULL,
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
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `role_id` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`,`role_id`),
   KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
-- --
-- ALTER TABLE `book_resource`
--   ADD FOREIGN KEY (`resource_id`)
--   ADD FOREIGN KEY (`user_id`) 
--
-- Constraints for table `resource`
--
ALTER TABLE `resource`
  ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD FOREIGN KEY (`quality_id`) REFERENCES `quality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD FOREIGN KEY (`building_id`) REFERENCES `building` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD FOREIGN KEY (`quality_id`) REFERENCES `quality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
ALTER TABLE `user_role_linker`
  ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;



--
-- Table structure for table `book_room`
--

CREATE TABLE `book_room` (
  `user_id` int(8),
  `room_id` int(8),
  `start_time` int(8) DEFAULT NULL,
  `end_time` int(8) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`room_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

Alter table `book_room`
-- add Foreign key book_room(`user_id`) REFERENCES `user` (`user_id`)  ON DELETE CASCADE ON UPDATE CASCADE,
add Foreign key book_room(`room_id`) REFERENCES `room`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

alter table `book_resource`
-- add Foreign key book_room(`user_id`) REFERENCES `user` (`user_id`)  ON DELETE CASCADE ON UPDATE CASCADE,
add foreign key `book_resource`(resource_id) REFERENCES `resource`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;