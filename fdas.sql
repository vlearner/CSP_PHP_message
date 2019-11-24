CREATE DATABASE IF NOT EXISTS OLGSTORE;

USE OLGSTORE;

CREATE TABLE `StateLookup` (
  `StateLookupId` int NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) NOT NULL,
  `StateCode` varchar(2) NOT NULL,
   CONSTRAINT PK_STATE_LOOKUP PRIMARY KEY (StateLookupId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Category` (
  `CategoryId` int NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) NOT NULL,
   CONSTRAINT PK_CATEGORY PRIMARY KEY (CategoryId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `ShippingStatus` (
  `ShippingStatusId` int NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) NOT NULL,
   CONSTRAINT PK_SHIP_STATUS PRIMARY KEY (ShippingStatusId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `PaymentType` (
  `PaymentTypeId` int NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) NOT NULL,
   CONSTRAINT PK_PAYMENT_TYPE PRIMARY KEY (PaymentTypeId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `EntityType` (
  `EntityTypeId` int NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) NOT NULL,
   CONSTRAINT PK_ENTITY_TYPE PRIMARY KEY (EntityTypeId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `SiteConfig` (
  `SiteConfigId` int NOT NULL AUTO_INCREMENT,
  `ConfigCode` varchar(100),
  `DefaultSetting` varchar(4000),
  `UserOverride` varchar(4000),
   CONSTRAINT PK_SITE_CONFIG PRIMARY KEY (SiteConfigId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Address` (
  `AddressId` int NOT NULL AUTO_INCREMENT,
  `AddressLine1` varchar(250) NOT NULL,
  `AddressLine2` varchar(250) NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(2) NOT NULL,
  `ZipCodePt1` varchar(5) NOT NULL,
   CONSTRAINT PK_ADDRESS PRIMARY KEY (AddressId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `ContactInfo` (
  `ContactInfoId` int NOT NULL AUTO_INCREMENT,
  `PhoneNumber` varchar(10) NOT NULL,
  `EmailAddress` varchar(250) NOT NULL,
  `AddressId` int NOT NULL,
   CONSTRAINT PK_CONTACT_INFO PRIMARY KEY (ContactInfoId),
   CONSTRAINT FK_CONTACT_INFO_ADDRESS FOREIGN KEY (AddressId) REFERENCES Address(AddressId),
   UNIQUE INDEX UI_EMAIL_ADDRESS (EmailAddress)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Person` (
  `PersonId` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `JobTitle` varchar(100) NULL,
  `Password` char(250) NOT NULL,
  `ContactInfoId` int NOT NULL,
   CONSTRAINT PK_PERSON PRIMARY KEY (PersonId),
   CONSTRAINT FK_PERSON_CONTACT_INFO FOREIGN KEY (ContactInfoId) REFERENCES ContactInfo(ContactInfoId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Customer` (
  `CustomerId` int NOT NULL AUTO_INCREMENT,
  `PersonId` int NULL,
  `AliasId` varchar(250) NULL,
   CONSTRAINT PK_CUSTOMER PRIMARY KEY (CustomerId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Employee` (
  `EmployeeID` int NOT NULL AUTO_INCREMENT,
  `PersonId` int NOT NULL,
  `AdminFlag` boolean NULL,
   CONSTRAINT PK_EMPLOYEE PRIMARY KEY (EmployeeID),
   CONSTRAINT FK_EMPLOYEE_PERSON FOREIGN KEY (PersonId) REFERENCES Person(PersonId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Vendor` (
  `VendorID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
   CONSTRAINT PK_VENDOR PRIMARY KEY (VendorID)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Product` (
  `ProductId` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `Description` varchar(4000) NOT NULL,
  `StockQuantity` int NOT NULL,
  `SKU` int NOT NULL,
  `ActiveFlag` boolean NOT NULL,
  `Weight` varchar(100) NULL,
  `Dimensions` varchar(100) NULL,
  `Material` varchar(250) NULL,
  `Color` varchar(250) NULL,
  `CategoryId` int NOT NULL,
  `VendorId` int NOT NULL,
   CONSTRAINT PK_PRODUCT PRIMARY KEY (ProductId),
   CONSTRAINT FK_PRODUCT_CATEGORY FOREIGN KEY (CategoryId) REFERENCES Category(CategoryId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Price` (
  `PriceId` int NOT NULL AUTO_INCREMENT,
  `Amount` decimal(11,2) NOT NULL ,
  `EffectiveDate` datetime NOT NULL,
  `ExpirationDate` datetime NULL,
  `ProductId` int NOT NULL,
   CONSTRAINT PK_PRICE PRIMARY KEY (PriceId),
   CONSTRAINT FK_PRICE_PRODUCT FOREIGN KEY (ProductId) references Product(ProductId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `ProductOrder` (
  `ProductOrderId` int NOT NULL AUTO_INCREMENT,
  `TransactionDatetime` datetime NOT NULL,
  `CustomerId` int NOT NULL,
  `ShippingStatusId` int NOT NULL,
  `ShippingAddressId` int NOT NULL,
   CONSTRAINT PK_PRODUCT_ORDER PRIMARY KEY (ProductOrderId),
   CONSTRAINT FK_PRODUCT_ORDER_CUSTOMER FOREIGN KEY (CustomerId) REFERENCES Customer(CustomerId),
   CONSTRAINT FK_PRODUCT_ORDER_SHIPPING_STATUS FOREIGN KEY (ShippingStatusId) REFERENCES ShippingStatus(ShippingStatusId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `OrderItem` (
  `OrderItemId` int NOT NULL AUTO_INCREMENT,
  `TransactionPricePerItem` decimal(11, 2) NOT NULL,
  `Quantity` int NOT NULL,
  `ProductId` int NOT NULL,
  `ProductOrderId` int NOT NULL,
   CONSTRAINT PK_ORDER_ITEM PRIMARY KEY (OrderItemId),
   CONSTRAINT FK_ORDER_ITEM_PRODUCT FOREIGN KEY (ProductId) REFERENCES Product(ProductId),
   CONSTRAINT FK_ORDER_ITEM_PRODUCT_ORDER FOREIGN KEY (ProductOrderId) REFERENCES ProductOrder(ProductOrderId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Payment` (
  `PaymentId` int NOT NULL AUTO_INCREMENT,
  `Amount` decimal(11,2) NOT NULL,
  `TransactionDatetime` datetime NULL,
  `OrderId` int NOT NULL,
  `PaymentTypeId` int NULL,
  `BillingAddressId` int NOT NULL,
   CONSTRAINT PK_PAYMENT PRIMARY KEY (PaymentID),
   CONSTRAINT FK_PAYMENT_PRODUCT_ORDER FOREIGN KEY (OrderId) REFERENCES ProductOrder(ProductOrderId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `CartItem` (
  `CartItemId` int NOT NULL AUTO_INCREMENT,
  `CartId` int NOT NULL,
  `ProductId` int NOT NULL,
  `Quantity` int NOT NULL,
   CustomerId int not null,
   CONSTRAINT PK_CART_ITEM PRIMARY KEY (CartItemId),
   CONSTRAINT FK_CART_ITEM_CUSTOMER FOREIGN KEY (CustomerId) REFERENCES Customer(CustomerId),
   CONSTRAINT FK_CART_ITEM_PRODUCT FOREIGN KEY (ProductId) REFERENCES Product(ProductId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `WishlistItem` (
  `WishlistItemId` int NOT NULL AUTO_INCREMENT,
  `WishlistId` int NOT NULL,
  `ProductId` int NOT NULL,
  `Quantity` int NOT NULL,
  CustomerId int not null,
   CONSTRAINT PK_WISHLIST_ITEM PRIMARY KEY (WishlistItemId),
   CONSTRAINT FK_WISHLIST_ITEM_CUSTOMER FOREIGN KEY (CustomerId) REFERENCES Customer(CustomerId),
   CONSTRAINT FK_WISHLIST_ITEM_PRODUCT FOREIGN KEY (ProductId) REFERENCES Product(ProductId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `ImageMapping` (
  `ImageMappingId` int NOT NULL AUTO_INCREMENT,
  `ImageFilePath` varchar(250) NOT NULL,
  `ImageName` varchar(250) NOT NULL,
  `PrimaryImageFlag` boolean NOT NULL,
  `EntityTypeId` int NOT NULL,
  `EntityId` int NOT NULL,
   CONSTRAINT PK_IMAGE_MAPPING PRIMARY KEY (ImageMappingId),
   CONSTRAINT FK_IMAGE_MAPPING_ENTITY_TYPE  FOREIGN KEY (EntityTypeId) REFERENCES EntityType(EntityTypeId)
)ENGINE=INNODB AUTO_INCREMENT = 1;

CREATE TABLE `Message` (
  `MessageId` int NOT NULL AUTO_INCREMENT,
  `MessageToken` int NOT NULL,
  `CustomerID` int NOT NULL,
  `EmployeeId` int NOT NULL,
  `MessageText` varchar(255) NULL,
   CONSTRAINT PK_MESSAGE PRIMARY KEY (MessageId),
   CONSTRAINT FK_MESSAGE_CUSTOMER FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerId),
   CONSTRAINT FK_MESSAGE_EMPLOYEE FOREIGN KEY (EmployeeId) REFERENCES Employee(EmployeeID)
)ENGINE=INNODB AUTO_INCREMENT = 1;

