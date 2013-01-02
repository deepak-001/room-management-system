CREATE TABLE IF NOT EXISTS `qualities` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(127) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `user-groups` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `dateOfBirth` int(8) DEFAULT NULL,
  `email` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idCategory` int(8) NOT NULL,
  `idQuality` int(8) NOT NULL,
  `numbers` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `book-resource` (
  `idUser` int(8) NOT NULL AUTO_INCREMENT,
  `idResource` int(8) NOT NULL DEFAULT '0',
  `startTime` int(8) DEFAULT NULL,
  `endTime` int(8) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUser`,`idResource`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `buildings` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `idBuilding` int(8) DEFAULT NULL,
  `idQuality` int(2) DEFAULT NULL,
  `number` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `book-room` (
  `idUser` int(8) NOT NULL AUTO_INCREMENT,
  `idRoom` int(8) NOT NULL DEFAULT '0',
  `startTime` int(8) DEFAULT NULL,
  `endTime` int(8) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUser`,`idRoom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;