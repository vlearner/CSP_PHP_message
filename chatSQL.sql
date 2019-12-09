# CREATE DATABASE ChatApp;
#
# CREATE TABLE `User`(
#     UserId int NOT NULL AUTO_INCREMENT,
#     UserName varchar(50) NOT NULL,
#     UserEmail VARCHAR(50) NOT NULL,
#     CONSTRAINT USER_PK PRIMARY KEY (userId)
# )ENGINE=INNODB;
#
# CREATE TABLE `Message` (
#   `MessageId` int(10) NOT NULL,
#   `SenderId` int(10) NOT NULL,
#   `RecieverId` int(10) NOT NULL,
#   `MessageTime` timestamp  NULL DEFAULT CURRENT_TIMESTAMP,
#   `MessageText` varchar(255) NOT NULL,
#    CONSTRAINT MESSAGE_PK PRIMARY KEY (MessageId)
# )ENGINE=INNODB;

-- MOCK Data

# INSERT INTO User (userName, UserEmail)
#     VALUE
#     ('user1', '1@1.com' ),
#     ('user2', '2@2.com'),
#     ('user3', '3@3.com'),
#     ('user4', '4@4.com'),
#     ('admin', 'a@a.com');


CREATE TABLE IF NOT EXISTS `Message` (
 `MessageId` int(11) NOT NULL,
 `MessageToken` int(11) NOT NULL,
 `CustomerID` int(11) NOT NULL,
 `EmployeeId` int(11) NOT NULL,
 `MessageTime` timestamp  NULL DEFAULT CURRENT_TIMESTAMP,
 `MessageText` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


SELECT Person.PersonId, Person.FirstName, ContactInfo.EmailAddress
FROM Person
         INNER JOIN ContactInfo ON ContactInfo.ContactInfoId = Person.ContactInfoId
LEFT JOIN Customer ON Customer.PersonId = Person.PersonId
WHERE ContactInfo.EmailAddress = 'fake_email_1@gmail.com';


SELECT Person.PersonId, Person.FirstName, ContactInfo.EmailAddress
FROM Person
INNER JOIN ContactInfo ON ContactInfo.ContactInfoId = Person.ContactInfoId
RIGHT JOIN Employee ON Emoloyee.PersonId = Person.PersonId
WHERE Person.FirstName = Test2;

# Get all customers info
SELECT * From Person INNER JOIN Customer ON Customer.PersonId = Person.PersonId;

SELECT * From Person INNER JOIN Customer ON Customer.PersonId = Person.PersonId WHERE Customer.CustomerId ;

# get user name, PersonId,
SELECT Person.PersonId, Person.FirstName, ContactInfo.EmailAddress
FROM Person
INNER JOIN ContactInfo ON ContactInfo.ContactInfoId = Person.ContactInfoId
LEFT JOIN Customer ON Customer.PersonId = Person.PersonId
WHERE Person.FirstName = 'Adriana'