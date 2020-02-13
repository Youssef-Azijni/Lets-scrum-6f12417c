	create database if not exists thewalldb;
	use thewalldb;
	create table if not exists posts (postID int primary key not null auto_increment, title varchar(50) not null, content varchar(1500), imgsrc varchar(100), bits int default 0);
	create table if not exists comments (commentID int primary key not null auto_increment, postID int, content varchar(1500), bits int default 0, username varchar(20) not null default "anonymous");
	create table if not exists users (userID int primary key not null auto_increment, username varchar(20) not null, password char(255) null, IQ int not null);