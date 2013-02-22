USE `room-management-system`;

INSERT INTO `user` (`user_id`, `disabled`, `deleted`, `username`, `password`, `email`, `last_login_time`, `display_name`, `state`) VALUES
(1, 0, 0, NULL, '$2a$14$cFAiEr7yDzDLsuDUCsvxH.hrF8NkmJhJZ76yARrOcL7Wjv9zEUgti', 'odom@gmail.com', 0, NULL, NULL),
(2, 0, 0, NULL, '$2a$14$CcRwUoN3yLxlKCccNZ3OC.9VgTQim4UCqbJgXI2E8EzASY.r2qvBS', 'odom.john@hotmail.com', 0, NULL, NULL);



INSERT INTO `category` ( `id`,`name`,`prefix`,`description`) VALUES
(1,'PC','pc','category');

INSERT INTO `quality` ( `id`,`type`) VALUES
(1,'GOOD'),
(2,'MEDDUIM'),
(3,'BAD');

Insert into `building` (`id`,`name`,`description`) values

(1,'A', 'Batiment A'),
(2,'B', 'Batiment B'),
(3,'C', 'Batiment C'),
(4,'D', 'Batiment D'),
(5,'E', 'Batiment E'),
(6,'F', 'Batiment F');

Insert into `room` (`id`,`building_id`,`quality_id`,`number`,`description`) values
(1,6,1,206,'I5_Classe'),
(2,6,1,306,'I4_Classe'),
(3,6,1,309,'I3_Classe');

INSERT INTO `resource` (`id`, `category_id`, `quality_id`,`room_id`,`numbers`,`description` ) VALUES
(1,1,1,2,2,'category report'),
(2,1,1,2,3,'category report'),
(3,1,1,2,4,'category report'),
(4,1,1,2,5,'category report'),
(5,1,1,2,6,'category report');


INSERT INTO `book_resource` (`user_id`, `resource_id` , `start_time`,`end_time`,`report`) VALUES
(1,1,1358150400, 1358157600 ,'normal'),
(1,2,1358150400, 1358157600 ,'normal'),
(1,3,1358150400, 1358157600,'normal'),
(1,1,1358064000 ,1358071200 ,'normal'),
(1,2,1358064000 ,1358071200 ,'normal'),
(1,3,1358064000 ,1358071200 ,'normal');

INSERT INTO `user_role` (`role_id`, `default`, `parent`) VALUES
('guest', 0, NULL),
('student', 1, NULL),
('teacher', 0, NULL);


INSERT INTO `book_room` (`user_id`, `room_id`, `start_time`,`end_time`,`report`) VALUES
(1,1,1358150400, 1358157600 ,'normal'),
(1,2,1358150400, 1358157600 ,'normal'),
(1,3,1358150400, 1358157600 ,'normal');
