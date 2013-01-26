INSERT INTO `user_role` (`role_id`, `default`, `parent`) VALUES
('guest', 1, NULL),
('student', 0, NULL),
('teacher', 0, 'student');
