CREATE DATABASE IF NOT EXISTS test;
USE test;

CREATE TABLE User(
firstname varchar(255) NOT NULL,
lastname varchar(255) NOT NULL,
password varchar(255) NOT NULL,
username varchar(255) NOT NULL,
id int AUTO_INCREMENT,
UNIQUE(username),
PRIMARY KEY(id)
);

CREATE TABLE Message(
recipient_ids varchar(255) NOT NULL,
user_id varchar(255) NOT NULL,
subject varchar(255) NOT NULL,
body varchar(255) NOT NULL,
date_sent datetime NOT NULL,
id int AUTO_INCREMENT,
PRIMARY KEY(id)
);

CREATE TABLE Message_read(
id varchar(255) NOT NULL,
message_id varchar(255) NOT NULL,
reader_id varchar(255) NOT NULL,
date datetime NOT NULL
);
