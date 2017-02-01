PRAGMA foreign_keys = ON;


drop table if exists Account;
drop table if exists Restaurant;
drop table if exists FunctionTime;
drop table if exists Review;
drop table if exists Reply;
drop table if exists Photo;
drop table if exists Category;
drop table if exists RestaurantFood;


CREATE TABLE Account (
	id_account VARCHAR PRIMARY KEY,					
	name VARCHAR NOT NULL,
	pass VARCHAR NOT NULL,
	gender INTEGER NOT NULL,
	age INTEGER NOT NULL,
	type VARCHAR NOT NULL
);


CREATE TABLE Restaurant (
	id_restaurant INTEGER PRIMARY KEY AUTOINCREMENT,
	id_owner INTEGER REFERENCES Account(id_account),
	--id_functionTime INTEGER REFERENCES FunctionTime(id_functionTime),
	name VARCHAR NOT NULL,
	address VARCHAR NOT NULL,
	avg_price INTEGER NOT NULL,
	description VARCHAR,
	stars REAL,
	open_time VARCHAR NOT NULL,
	close_time VARCHAR NOT NULL,
	monday BOOLEAN NOT NULL,
	tuesday BOOLEAN NOT NULL,
	wednesday BOOLEAN NOT NULL,
	thursday BOOLEAN NOT NULL,
	friday BOOLEAN NOT NULL,
	saturday BOOLEAN NOT NULL,
	sunday BOOLEAN NOT NULL
);

/*CREATE TABLE FunctionTime (
	id_functionTime INTEGER PRIMARY KEY,
	open_time VARCHAR NOT NULL,
	close_time VARCHAR NOT NULL,
	monday BOOLEAN NOT NULL,
	tuesday BOOLEAN NOT NULL,
	wednesday BOOLEAN NOT NULL,
	thursday BOOLEAN NOT NULL,
	friday BOOLEAN NOT NULL,
	saturday BOOLEAN NOT NULL,
	sunday BOOLEAN NOT NULL
);*/


CREATE TABLE Review (
	id_review INTEGER PRIMARY KEY AUTOINCREMENT,
	id_restaurant INTEGER REFERENCES Restaurant(id_restaurant),
	id_reviewer INTEGER REFERENCES Account(id_account),
	comment VARCHAR,
	score INTEGER NOT NULL
);


CREATE TABLE Reply (
	id_reply INTEGER PRIMARY KEY AUTOINCREMENT,
	id_review INTEGER REFERENCES Review(id_review),
	id_replyer INTEGER REFERENCES Account(id_account),
	comment VARCHAR NOT NULL	
);
	
CREATE TABLE Photo (
	id_photo INTEGER PRIMARY KEY AUTOINCREMENT,
	id_restaurant INTEGER REFERENCES Restaurant(id_restaurant),
	path VARCHAR NOT NULL
);

CREATE TABLE Category (
	id_category VARCHAR PRIMARY KEY
);

CREATE TABLE RestaurantFood (
	id_restaurant_food INTEGER PRIMARY KEY,
	id_restaurant INTEGER REFERENCES Restaurant(id_restaurant),
	id_category VARCHAR REFERENCES Category(id_category)
);

INSERT INTO Category VALUES ('Chinese');
INSERT INTO Category VALUES ('Sushi');
INSERT INTO Category VALUES ('Italian');
INSERT INTO Category VALUES ('French');
INSERT INTO Category VALUES ('Mexican');
INSERT INTO Category VALUES ('Indian');
INSERT INTO Category VALUES ('Fast Food');
INSERT INTO Category VALUES ('Snack Bar');
INSERT INTO Category VALUES ('Brazilian');
INSERT INTO Category VALUES ('Coffee Shop');
INSERT INTO Category VALUES ('Pastry Shop');
INSERT INTO Category VALUES ('Sea Food');


