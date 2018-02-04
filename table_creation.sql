
  -- Assignment 3
  -- Bhatia, Hitesh
  -- 821439483
 

use jadrn008;

drop table if exists person;

create table person(
    Runner_id int AUTO_INCREMENT PRIMARY KEY,
    fname varchar(50) NOT NULL,
    mname varchar(50),
    lname varchar(50) NOT NULL,
    address1 varchar(100) NOT NULL,
    address2 varchar(100),
    city varchar(30) NOT NULL,
    state char(2) NOT NULL,
    zip char(5) NOT NULL,
    phone char(12) NOT NULL,
    email varchar(50) NOT NULL,
    gender varchar(6) NOT NULL,
	dob char(10) NOT NULL,
	medical varchar(100),
	experience varchar(12) NOT NULL,
	category varchar(6) NOT NULL,
	runner_image varchar(100) NOT NULL); 
    
INSERT INTO person VALUES(0,'Jim Robeson','3456 30th St','San Diego','CA','92104','jrobeson@yahoo.com');    
INSERT INTO person VALUES(0,'Robert Jones','1512 Abbott St','San Diego','CA','92106','rjones@gmail.com');
INSERT INTO person VALUES(0,'Henry Carter','914 Albion St','San Diego','CA','92106','hcarter@yahoo.com');
INSERT INTO person VALUES(0,'Jason Johnson','225 7th St','San Diego','CA','92103','jjson@gmail.com');
INSERT INTO person VALUES(0,'Sarah Joseph','9339 Via Rapida St','San Diego','CA','92101','sjoseph22@yahoo.com');
INSERT INTO person VALUES(0,'Bill Krump','1445 Camino Del Rio','San Diego','CA','92108','bkrmp@gmail.com');
INSERT INTO person VALUES(0,'Matt Mathison','887 10 St','San Diego','CA','92101','mmathison12@gmail.com');
INSERT INTO person VALUES(0,'Sam Stevens','6782 Ivy St','San Diego','CA','92103','sam.stevens@gmail.com');
INSERT INTO person VALUES(0,'Jerome Jacobs','5354 Maple St','San Diego','CA','92103','jjacobs@mail.sdsu.edu');
INSERT INTO person VALUES(0,'Adam Selig','3634 7th Ave','San Diego','CA','92103','superstar156@yahoo.com');
INSERT INTO person VALUES(0,'Sally Reese','2910 Market St','San Diego','CA','92101','sallyR@cox.net');