DROP DATABASE resource_ms;
CREATE DATABASE resource_ms
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE resource_ms;

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned AUTO_INCREMENT,
  `disabled` tinyint(1) unsigned DEFAULT '0',
  `deleted` tinyint(1) unsigned DEFAULT '0',
  `created_time` int(11) unsigned DEFAULT '0',
  `last_modified_time` int(11) unsigned DEFAULT '0',
  `valid_time_start` int(11) unsigned DEFAULT '0',
  `valid_time_end` int(11) unsigned DEFAULT '0',

  `username` varchar(64) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `display_name` VARCHAR(50) DEFAULT '',
  `gender` CHAR(1) DEFAULT NULL,
  `email` varchar(64) DEFAULT '',
  `last_login_time` int(11) unsigned DEFAULT '0',
  `state` SMALLINT,

  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` varchar(255)  ,
  `default` tinyint(1)  ,
  `parent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `user_role` (`role_id`, `default`, `parent`) VALUES
('guest', 1, NULL),
('student', 0, NULL),
('teacher', 0, 'student');

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(11) unsigned  ,
  `role_id` varchar(255)  ,
  PRIMARY KEY (`user_id`,`role_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `personal_detail` (
  `uid` int(11) unsigned AUTO_INCREMENT,
  `disabled` tinyint(1) unsigned DEFAULT '0',
  `deleted` tinyint(1) unsigned DEFAULT '0',
  `created_time` int(11) unsigned DEFAULT '0',
  `created_user` int(11) unsigned DEFAULT '0',
  `last_modified_time` int(11) unsigned DEFAULT '0',
  `last_modified_user` int(11) unsigned DEFAULT '0',
  `valid_time_start` int(11) unsigned DEFAULT '0',
  `valid_time_end` int(11) unsigned DEFAULT '0',
  FOREIGN KEY (`created_user`) REFERENCES `user` (`user_id`) ,
  FOREIGN KEY (`last_modified_user`) REFERENCES `user` (`user_id`) ,

  `firstname` varchar(255) DEFAULT '',
  `lastname` varchar(255) DEFAULT '',
  `gender` char(1) DEFAULT '',
  `age` tinyint(2) unsigned DEFAULT '0',
  `email` varchar(50) DEFAULT '',
  `phone_number_1` varchar(50) DEFAULT '',
  `phone_number_2` varchar(50) DEFAULT '',
  `others` text,

  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `image` (
  `uid` int(11) unsigned AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT '0',
  `disabled` tinyint(1) unsigned DEFAULT '0',
  `deleted` tinyint(1) unsigned DEFAULT '0',
  `created_time` int(11) unsigned DEFAULT '0',
  `created_user` int(11) unsigned DEFAULT '0',
  `last_modified_time` int(11) unsigned DEFAULT '0',
  `last_modified_user` int(11) unsigned DEFAULT '0',
  `valid_time_start` int(11) unsigned DEFAULT '0',
  `valid_time_end` int(11) unsigned DEFAULT '0',
  FOREIGN KEY (`created_user`) REFERENCES `user` (`user_id`) ,
  FOREIGN KEY (`last_modified_user`) REFERENCES `user` (`user_id`) ,

  `original_file_name` varchar(255) DEFAULT '',
  `path` varchar(255) DEFAULT '',

  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `type` (
  `uid` int(11) unsigned AUTO_INCREMENT,
  `parent` int(11) unsigned DEFAULT '0',
  `disabled` tinyint(1) unsigned DEFAULT '0',
  `deleted` tinyint(1) unsigned DEFAULT '0',
  `created_time` int(11) unsigned DEFAULT '0',
  `created_user` int(11) unsigned DEFAULT '0',
  `last_modified_time` int(11) unsigned DEFAULT '0',
  `last_modified_user` int(11) unsigned DEFAULT '0',
  `valid_time_start` int(11) unsigned DEFAULT '0',
  `valid_time_end` int(11) unsigned DEFAULT '0',
  FOREIGN KEY (`parent`) REFERENCES `type` (`uid`) ,
  FOREIGN KEY (`created_user`) REFERENCES `user` (`user_id`) ,
  FOREIGN KEY (`last_modified_user`) REFERENCES `user` (`user_id`) ,

  `title` varchar(255) DEFAULT '',
  `icon`  int(11) unsigned DEFAULT '0',
  `description` text,

  FOREIGN KEY (`icon`) REFERENCES `image` (`uid`) ,

  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `item` (
  `uid` int(11) unsigned AUTO_INCREMENT,
  `parent` int(11) unsigned DEFAULT '0',
  `disabled` tinyint(1) unsigned DEFAULT '0',
  `deleted` tinyint(1) unsigned DEFAULT '0',
  `created_time` int(11) unsigned DEFAULT '0',
  `created_user` int(11) unsigned DEFAULT '0',
  `last_modified_time` int(11) unsigned DEFAULT '0',
  `last_modified_user` int(11) unsigned DEFAULT '0',
  `valid_time_start` int(11) unsigned DEFAULT '0',
  `valid_time_end` int(11) unsigned DEFAULT '0',
  FOREIGN KEY (`parent`) REFERENCES `item` (`uid`) ,
  FOREIGN KEY (`created_user`) REFERENCES `user` (`user_id`) ,
  FOREIGN KEY (`last_modified_user`) REFERENCES `user` (`user_id`) ,

  `title` varchar(255) DEFAULT '',
  `type` int(11) unsigned DEFAULT '0',
  `quality` tinyint(3) unsigned DEFAULT '0',
  `icon`  int(11) unsigned DEFAULT '0',
  `description` text,

  FOREIGN KEY (`type`) REFERENCES `type` (`uid`) ,
  FOREIGN KEY (`icon`) REFERENCES `image` (`uid`) ,

  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `reservation` (
  `uid` int(11) unsigned AUTO_INCREMENT,
  `disabled` tinyint(1) unsigned DEFAULT '0',
  `deleted` tinyint(1) unsigned DEFAULT '0',
  `created_time` int(11) unsigned DEFAULT '0',
  `created_user` int(11) unsigned DEFAULT '0',
  `last_modified_time` int(11) unsigned DEFAULT '0',
  `last_modified_user` int(11) unsigned DEFAULT '0',
  `valid_time_start` int(11) unsigned DEFAULT '0',
  `valid_time_end` int(11) unsigned DEFAULT '0',
  FOREIGN KEY (`created_user`) REFERENCES `user` (`user_id`) ,
  FOREIGN KEY (`last_modified_user`) REFERENCES `user` (`user_id`) ,

  `start_time` int(11) unsigned DEFAULT '0',
  `end_time` int(11) unsigned DEFAULT '0',
  `user`  int(11) unsigned DEFAULT '0',
  `item`  int(11) unsigned DEFAULT '0',
  `returned` tinyint(1) unsigned DEFAULT '0',
  `feedback` text,

  FOREIGN KEY (`user`) REFERENCES `user` (`user_id`) ,
  FOREIGN KEY (`item`) REFERENCES `item` (`uid`) ,

  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

