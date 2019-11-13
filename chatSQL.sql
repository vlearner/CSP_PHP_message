CREATE DATABASE ChatApp;

CREATE TABLE `User`(
    UserId int NOT NULL AUTO_INCREMENT,
    UserName varchar(50) NOT NULL,
    UserEmail VARCHAR(50) NOT NULL,
    CONSTRAINT USER_PK PRIMARY KEY (userId)
)ENGINE=INNODB;

CREATE TABLE `Message` (
  `MessageId` int(10) NOT NULL AUTO_INCREMENT,
  `SenderId` int(10) NOT NULL,
  `RecieverId` int(10) NOT NULL,
  `MessageTime` timestamp  NULL DEFAULT CURRENT_TIMESTAMP,
  `MessageText` varchar(255) NOT NULL,
   CONSTRAINT MESSAGE_PK PRIMARY KEY (MessageId)
)ENGINE=INNODB;

-- MOCK Data

INSERT INTO User (userID, userName, password)
    VALUE 
    (1, 'user1', '1234'),
    (2, 'user2', '1234'),
    (3, 'user3', '1234'),
    (4, 'user4', '1234');