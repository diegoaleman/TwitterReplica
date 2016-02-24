CREATE DATABASE Twitter();


CREATE TABLE Users (
	fName VARCHAR(30) NOT NULL,
    lName VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(250) NOT NULL PRIMARY KEY,
    passwrd VARCHAR(250) NOT NULL,
    age INT,
    description VARCHAR(500)
);

INSERT INTO Users(fName, lName, username, email, passwrd, age, description)
VALUES  ('Diego', 'Aleman', 'diego', 'diego@me.com', '123456', 21, 'My name is Diego and im new in twitter'),
		('Hector', 'Ochoa', 'hector', 'hector@me.com', '123456', 22, 'I love social media! follow me on ig!'),
		('Carlos', 'Gloria', 'carlos', 'carlos@me.com', '123', 20, 'Just use twitter to see funny posts, most of the time I dont tweet');


CREATE TABLE Tweet (
 	tweetId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 	tweetDate DATETIME NOT NULL DEFAULT NOW(),
 	content VARCHAR(200) NOT NULL,
 	likes INT,
 	email VARCHAR(250) NOT NULL,
 	FOREIGN KEY (email) 
		REFERENCES Users (email)
		ON DELETE CASCADE
);

INSERT INTO Tweet(content, likes, email)
VALUES  ('Hello, world!', 0, 'diego@me.com'),
		('Its you..', 1, 'diego@me.com'),
		('Success!', 0, 'diego@me.com'),
		('Im Hector and this is my first tweet', 0, 'hector@me.com'),
		('Hi, mi name is Carlos and this is my first tweet', 0, 'carlos@me.com');



CREATE TABLE Friends (
	friendsId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	aEmail VARCHAR(250) NOT NULL,
    FOREIGN KEY (aEmail) 
		REFERENCES Users (email)
		ON DELETE CASCADE,
	bEmail VARCHAR(250) NOT NULL,
    FOREIGN KEY (bEmail) 
		REFERENCES Users (email)
		ON DELETE CASCADE
);


INSERT INTO Friends(aEmail, bEmail)
VALUES  ('diego@me.com', 'hector@me.com'),
		('diego@me.com', 'carlos@me.com');




