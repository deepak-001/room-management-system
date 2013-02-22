<?php

// config/autoload/global.php:
return array(
	'db' => array(
		'driver' => 'Pdo',
		'dsn' => 'mysql:dbname=resource_ms;host=localhost',
		'username' => 'root',
		'password' => 'root',
		'driver_options' => array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
		),
	),
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host' => 'localhost',
					'port' => '3306',
					'dbname' => 'resource_ms',
					'user' => 'root',
					'password' => 'root',
				)
			)
		)
	),
);
