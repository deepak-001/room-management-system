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
idCategory int(8)Not Null,
idQuality int(8)Not Null,
numbers int(8),
description varchar(255),
FOREIGN KEY (idCategory) REFERENCES categories(id)ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY (idQuality) REFERENCES qualities(id)ON UPDATE CASCADE ON DELETE CASCADE
);


create table `book-resource`
(
idUser int(8),
idResource int(8),
startTime int(8),
endTime int(8),
report varchar(255),
PRIMARY KEY (idUser,idResource),
FOREIGN KEY (idUser) REFERENCES users(id),
FOREIGN KEY (idResource) REFERENCES resources(id)
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
idBuilding int(8),
idQuality int(2),
`number` int(8),
description varchar(255),
PRIMARY KEY (id),
FOREIGN KEY (idBuilding) REFERENCES buildings(id),
FOREIGN KEY (idQuality) REFERENCES qualities(id)
);

create table book-room
(
idUser int(8),
idRoom int(8),
startTime int(8),
endTime int(8),
report varchar(255),
PRIMARY KEY (idUser,idRoom),
FOREIGN KEY (idUser) REFERENCES users(id),
FOREIGN KEY (idRoom) REFERENCES rooms(id)
)




