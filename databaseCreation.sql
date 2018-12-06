-- DROP PRE-EXISTING ENTITIES
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS POSTS;

CREATE TABLE USERS (
	ID INT,
	Email VARCHAR(255),
	Password VARCHAR(255),
	PRIMARY KEY(ID)
	);
	
CREATE TABLE POSTS (
	ID INT,
	User_ID INT,
	Content VARCHAR(255),
	TStamp TIME,
	DStamp DATE,
	PRIMARY KEY(ID),
	FOREIGN KEY(User_ID) REFERENCES USERS(ID) ON DELETE CASCADE
	);