drop database `room-management-system`;
create database `room-management-system`
	default character set utf8
	default collate utf8_general_ci;
USE `room-management-system`;


--
-- Table structure for table `book_resource`
--

CREATE TABLE IF NOT EXISTS `book_resource` (
  `user_id` int(11) unsigned,
  `resource_id` int(11)unsigned,
  `start_time` int(11)unsigned DEFAULT NULL,
  `end_time` int(11) unsigned DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`resource_id`,start_time)
);

--
-- Table structure for table `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11)unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


--
-- Table structure for table `quality`
--

CREATE TABLE IF NOT EXISTS `quality` (
  `id` int(11)unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Table structure for table `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11)unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned DEFAULT 0,
  `quality_id` int(11) unsigned DEFAULT 0,
  `room_id` int(11) unsigned DEFAULT 0,

  `numbers` int(11) unsigned DEFAULT 0,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `building_id` int(11)unsigned Default 0,
  `quality_id` int(2)unsigned DEFAULT 1,
  `number` int(11)unsigned DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

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
);

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` varchar(255) NOT NULL DEFAULT '',
  `default` tinyint(1) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
);

CREATE TABLE `book_room` (
  `user_id` int(11) unsigned ,
  `room_id` int(11) unsigned,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`room_id`,start_time)
);
--
-- Table structure for table `user_role_linker`
--

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `role_id` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`,`role_id`),
   KEY `role_id` (`role_id`)
);

--
ALTER TABLE `resource`
  ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD FOREIGN KEY (`quality_id`) REFERENCES `quality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
   ADD FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `room`
  ADD FOREIGN KEY (`building_id`) REFERENCES `building` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD FOREIGN KEY (`quality_id`) REFERENCES `quality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
ALTER TABLE `user_role_linker`
  ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

Alter table `book_room`
add Foreign key book_room(`user_id`) REFERENCES `user` (`user_id`)  ON DELETE CASCADE ON UPDATE CASCADE,
add Foreign key book_room(`room_id`) REFERENCES `room`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

alter table `book_resource`
add Foreign key book_resource(`user_id`) REFERENCES `user` (`user_id`)  ON DELETE CASCADE ON UPDATE CASCADE,
add foreign key `book_resource`(resource_id) REFERENCES `resource`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;