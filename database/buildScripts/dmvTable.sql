DROP TABLE IF EXISTS regUsers;
CREATE TABLE regUsers (
  username	 varchar(20) not null,
  password	 varchar(128) not null,
  gender	 varchar(15) not null,
  fname		 varchar(15) not null,
  lname		 varchar(15) not null,
  minit 	 char(2) not null,
  
  constraint regUsers_pk primary key (username)
);