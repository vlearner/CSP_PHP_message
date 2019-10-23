CREATE DATABASE ChatApp;

CREATE TABLE User (
    UserId int NOT NULL,
    UserName varchar(50) NOT NULL,
    UserEmail VARCHAR(50) NOT NULL
    Password varchar(50) NULL,
    CONSTRAINT USER_PK PRIMARY KEY (userId)
)ENGINE=INNODB;

CREATE TABLE `Message` (
  `MessageId` int NOT NULL,
  `MessageTime` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
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