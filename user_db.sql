drop database if exists user_db;
create database user_db;

create table user_db.users(
	id          int             not null AUTO_INCREMENT, 
    username    varchar(30)     ,
    password    varchar(30)     ,
	name 		varchar(30) 	,
    roleId      int,
    primary key (id)
);

INSERT INTO `users`(`id`, `username`, `password`, `name`, `roleId`) VALUES ('1','ABCD@home01','123456','Nguyễn Văn A','1');
INSERT INTO `users`(`id`, `username`, `password`, `name`, `roleId`) VALUES ('2','admin@001','000000','Huỳnh Phúc Khánh','0');