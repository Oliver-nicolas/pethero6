CREATE DATABASE Tpfinalpet;

USE Tpfinalpet;

CREATE TABLE students
(
	id INT NOT NULL PRIMARY KEY,
    username NVARCHAR(100) NOT NULL,
    password NVARCHAR(100) NOT NULL,
    usertype NVARCHAR(100) NOT NULL
   
)Engine=InnoDB;