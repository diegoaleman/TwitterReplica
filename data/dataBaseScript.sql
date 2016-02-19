CREATE TABLE Users (
	fName VARCHAR(30) NOT NULL,
    lName VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(250) NOT NULL PRIMARY KEY,
    passwrd VARCHAR(250) NOT NULL,
    age INT
);

INSERT INTO Users(fName, lName, username, email, passwrd)
VALUES  ('Diego', 'Aleman', 'diego', 'diego@me.com', '123456'),
		('Hector', 'Ochoa', 'hector', 'hector@me.com', '123456');


CREATE TABLE Tweet (
 	tweetId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
	a VARCHAR(250) NOT NULL,
	b VARCHAR(250) NOT NULL
);


INSERT INTO Friends(a, b)
VALUES  ('diego@me.com', 'hector@me.com'),
		('diego@me.com', 'carlos@me.com');

