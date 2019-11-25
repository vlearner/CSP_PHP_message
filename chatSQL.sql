CREATE DATABASE ChatApp;

CREATE TABLE `User`(
    UserId int NOT NULL AUTO_INCREMENT,
    UserName varchar(50) NOT NULL,
    UserEmail VARCHAR(50) NOT NULL,
    CONSTRAINT USER_PK PRIMARY KEY (userId)
)ENGINE=INNODB;

CREATE TABLE `Message` (
  `MessageId` int(10) NOT NULL,
  `SenderId` int(10) NOT NULL,
  `RecieverId` int(10) NOT NULL,
  `MessageTime` timestamp  NULL DEFAULT CURRENT_TIMESTAMP,
  `MessageText` varchar(255) NOT NULL,
   CONSTRAINT MESSAGE_PK PRIMARY KEY (MessageId)
)ENGINE=INNODB;

-- MOCK Data

# INSERT INTO User (userName, UserEmail)
#     VALUE
#     ('user1', '1@1.com' ),
#     ('user2', '2@2.com'),
#     ('user3', '3@3.com'),
#     ('user4', '4@4.com'),
#     ('admin', 'a@a.com');