create table permissions(
id_per int not null auto_increment,
name_per varchar(50),
controller varchar (50) collate utf8_unicode_ci not null,
action varchar(50)collate utf8_unicode_ci not null,
status boolean collate utf8_unicode_ci not null,
primary key (id_per),
id_gr int references user_groups(id_gr)) ENGINE=INNODB;



create table users(
id_user int not null auto_increment,
name_user varchar(50)collate utf8_unicode_ci not null,
dateOfBirth date not null,
email varchar(50) not null,
occupation varchar(50),
id_gr int references user_groups(id_gr),
primary key (id_user)
 ) ENGINE=INNODB;
 
 create table user_groups(
id_gr int not null ,
name_user varchar(50)collate utf8_unicode_ci not null,
id_user int references users(id_user),
primary key (id_user)
)ENGINE=INNODB;

create table categories (
 id_cate int auto_increment not null,
 name_cate varchar(50) not null,
 status_cate boolean,
 primary key(id_cate)) ENGINE=INNODB;
 

create table items(
 id_item int auto_increment not null,
 parentId int,
 name_item varchar(50),
 DateIn date not null,
 id_cate int references categories(id_cate) ,
 primary key(id_item)
 )ENGINE=INNODB;
 

 create table book(
 id_user int references users(id_user) ,
 id_item int references items(id_item) ,
 date_book date not null,
 dateReturn date not null,
 report varchar(50),
 defautl varchar(50),
 primary key (id_user)
)ENGINE=INNODB;
 
 
 
 
