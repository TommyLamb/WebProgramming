drop table Customer;
drop table Address;
drop table Transaction;
drop table TransactionProductList;
drop table Favourites;

create table Customer(
UID int primary key AUTO_INCREMENT,
Username varchar(128) UNIQUE not null,
Password varchar(255),
FName varchar(64) not null,
SName varchar(64) not null,
TNumber varchar(24)
)ENGINE=INNODB;

create table Address(
AddressID int primary key AUTO_INCREMENT,
UID int not null,
Line1 varchar(64) not null,
Line2 varchar(64),
Line3 varchar(64),
Line4 varchar(64),
City varchar(64) not null,
Postcode varchar(24) not null,
County varchar(64) not null,
Country varchar(64) not null,
foreign key (UID) references Customer(UID)
)ENGINE=INNODB;

create table Transaction(
TransactionTimestamp DATETIME(6) primary key,
UID int,
AddressID int not null,
DeliveryStatus int not null,
NoProducts int,
Cost DECIMAL(6,2),
foreign key (UID) references Customer(UID),
foreign key (AddressID) references Address(AddressID)
)ENGINE=INNODB;

create table TransactionProductList(
TransactionTimestamp DATETIME(6) not null,
ProductName varchar(64) not null,
Amount int(3) not null,
foreign key (TransactionTimestamp) references Transaction(TransactionTimestamp),
foreign key (ProductName) references ProductList(ProductName),
primary key (TransactionTimestamp, ProductName)
)ENGINE=INNODB;

create table Favourites(
ProductName varchar(64) not null,
UID int not null,
foreign key (ProductName) references ProductList(ProductName),
foreign key (UID) references Customer(UID),
primary key (ProductName, UID)
)ENGINE=INNODB;