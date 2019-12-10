
# Change MessageToken TO BE NULL
CREATE TABLE IF NOT EXISTS `Message` (
 `MessageId` int(11) NOT NULL,
 `MessageToken` int(11) NULL,
 `CustomerID` int(11) NOT NULL,
 `EmployeeId` int(11) NOT NULL,
 `MessageTime` timestamp  NULL DEFAULT CURRENT_TIMESTAMP,
 `MessageText` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;




# SELECT Person.PersonId, Person.FirstName, ContactInfo.EmailAddress
# FROM Person
# INNER JOIN ContactInfo ON ContactInfo.ContactInfoId = Person.ContactInfoId
# LEFT JOIN Customer ON Customer.PersonId = Person.PersonId
# WHERE ContactInfo.EmailAddress = 'fake_email_1@gmail.com';
#
#
# SELECT Person.PersonId, Person.FirstName, ContactInfo.EmailAddress
# FROM Person
# INNER JOIN ContactInfo ON ContactInfo.ContactInfoId = Person.ContactInfoId
# RIGHT JOIN Employee ON Emoloyee.PersonId = Person.PersonId
# WHERE Person.FirstName = Test2;
#
# # Get all customers info
# SELECT *
# From Person
# INNER JOIN Customer
# ON Customer.PersonId = Person.PersonId;
#
# SELECT *
# From Person
# INNER JOIN Customer
# ON Customer.PersonId = Person.PersonId
# WHERE Customer.CustomerId ;
#
# # get user name, PersonId,
# SELECT Person.PersonId, Person.FirstName, ContactInfo.EmailAddress
# FROM Person
# INNER JOIN ContactInfo ON ContactInfo.ContactInfoId = Person.ContactInfoId
# LEFT JOIN Customer ON Customer.PersonId = Person.PersonId
# WHERE Person.FirstName = 'Adriana';