Project to show PHP with OOP.
Photo gallery where admin can post pictures and others can comment on it.

SQL COMMANDS FOR DB:
CREATE DATABASE photo_gallery;
USE photo_gallery;

CREATE TABLE users(
id int(11) NOT NULL UNIQUE auto_increment,
username varchar(50) NOT NULL UNIQUE,
password varchar(40) NOT NULL,
first_name varchar(30) NOT NULL,
last_name varchar(30) NOT NULL,
PRIMARY KEY (id)
);

//giving all priv to some user...gallery
GRANT ALL PRIVILEGES ON photo_gallery.*
TO 'gallery'@'localhost'
IDENTIFIED BY 'photo';
