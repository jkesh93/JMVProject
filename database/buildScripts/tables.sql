DROP TABLE IF EXISTS driver; 
DROP TABLE IF EXISTS license;
DROP TABLE IF EXISTS insurance;
DROP TABLE IF EXISTS vehicleowned;
DROP TABLE IF EXISTS repairshop;
DROP TABLE IF EXISTS vehicle;
DROP TABLE IF EXISTS mechanics;
DROP TABLE IF EXISTS engine;
DROP TABLE if exists employment;
DROP TABLE if exists residence;

CREATE TABLE driver (
  ssn						 char(9) not null,
  fname						 varchar(25) not null,
  minit						 varchar(2),
  lname						 varchar(25) not null,
  constraint driver_pk_ssn  primary key (ssn)
);

CREATE TABLE license (
  driver_ssn	 			 char(9) not null,
  license_number 			 char(8) not null,
  fname						 varchar(25) not null,
  minit						 varchar(2),
  lname						 varchar(25) not null,
  expires					 date,
  
  constraint license_pk_ssn primary key (driver_ssn),
  constraint license_fk_ssn foreign key (driver_ssn) references driver(ssn)
  -- foreign key (license_ssn) references driver(driver_ssn)
);


CREATE TABLE insurance (
	driver_ssn					 char(9) not null,
	insurance_company 			 varchar(50) not null,
	constraint insurance_pk_ssn  primary key (driver_ssn),
	constraint insurance_fk_ssn  foreign key (driver_ssn) references license(driver_ssn)
);


CREATE TABLE vehicleowned (
	driver_ssn			 char(9) not null,
	vin					 char(17) not null,
	start_date			 date not null,
	end_date			 date,
	constraint vehicle_pk  primary key (vin),
	constraint driver_fk_id  foreign key (driver_ssn) references insurance (driver_ssn)
);

CREATE TABLE repairshop (
	name				 varchar(25) not null,
	address_num			 int not null,
	address_street		 varchar(30) not null,
	address_city		 varchar(20) not null,
	address_state		 varchar(20) not null,
	
	constraint repair_pk primary key (name) 
);

CREATE TABLE vehicle (
	vin					  char(17) not null,
	make			 	  varchar(25) not null,
	model			 	  varchar(25) not null,
	color				  varchar(15) not null,
	price				  int not null,
	repaired_at			  varchar(25) not null,

	constraint vehicle_pk_vin primary key (vin),
	constraint vehicle_fk_repair foreign key (repaired_at) references repairshop(name),
	constraint vehicle_fk_owned foreign key (vin) references vehicleowned(vin)
);


CREATE TABLE mechanics (
	fname		 VARCHAR(15) not null,
	lname 		 varchar(15) not null,
	works_at	 varchar(25) not null,
	constraint worker_name_pk primary key (fname, lname),
	constraint worksAt_fk foreign key (works_at) references repairshop(name)
);


CREATE TABLE engine (
	vin					 char(17) not null,
	horsepower			 int not null,
	displacement		 DOUBLE(4,2) not null,
	pistons				 int,
	constraint engine_pk_vin primary key (vin),
	constraint engine_fk_vin foreign key (vin) references vehicle(vin)
);
 
CREATE TABLE employment (
	company				 varchar(50) not null,
	address_num			 int not null,
	address_street		 varchar(30) not null,
	address_city		 varchar(20) not null,
	address_state		 varchar(20) not null,
	patrons_ssn			 char(9) not null,
	
	constraint emp_pk primary key (patrons_ssn),
	constraint emp_fk foreign key (patrons_ssn) references driver(ssn)
);

CREATE TABLE residence(
	address_num			 int not null,
	address_street		 varchar(30) not null,
	address_city		 varchar(20) not null,
	address_state		 varchar(20) not null,
	patrons_ssn			 char(9) not null,
	
	constraint res_pk primary key (patrons_ssn),
	constraint res_fk foreign key (patrons_ssn) references driver(ssn)
); 