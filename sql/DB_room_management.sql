create table qualities
(
    id int(8),
    `type` varchar(30)
);

create table permissions
(
    id int(8),
    name varchar(127)
);

create table `user-groups`
(
    id int(8),
    name varchar(50)
);

create table users
(
    id int(8),
    name varchar(50),
    dateOfBirth int(8),
    email varchar(127),
    PRIMARY KEY (id)
);
create table categories
(
id int(8),
name varchar(50),
`prefix` varchar(50),
description varchar(255)
);

create table resources
(
id int(8),
idCategory int(8)Not Null REFERENCES categories(id) ,
idQuality int(8)Not Null REFERENCES qualities(id),
numbers int(8),
description varchar(255)
);


create table `book-resource`
(
idUser int(8)REFERENCES users(id),
idResource int(8)REFERENCES resources(id),
startTime int(8),
endTime int(8),
report varchar(255),
PRIMARY KEY (idUser,idResource)
);

create table buildings 
(
id int(8),
name varchar(50),
description varchar(255)
);

create table rooms
(
id int(8),
idBuilding int(8)REFERENCES buildings(id),
idQuality int(2)REFERENCES qualities(id),
`number` int(8),
description varchar(255),
PRIMARY KEY (id)
);

create table `book-room`
(
idUser int(8)REFERENCES users(id),
idRoom int(8)REFERENCES rooms(id),
startTime int(8),
endTime int(8),
report varchar(255),
PRIMARY KEY (idUser,idRoom)
);