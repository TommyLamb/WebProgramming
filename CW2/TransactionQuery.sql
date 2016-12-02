SET @time = NOW();
SET @uid = 18;
SET @addressID = 22;
INSERT INTO Transaction VALUES (@time, @uID, @addressID, 1, 0,0);
INSERT INTO TransactionProductList VALUES (@time,'VakarianBlue',5), (@time, 'LaForgeGold',3),(@time, 'SpyroPurple',7);
SET @cost = (Select sum(Amount*Price) FROM ProductList, TransactionProductList WHERE TransactionTimestamp = @time AND TransactionProductList.ProductName = ProductList.ProductName);
SET @noProducts = (Select count(ProductName) FROM TransactionProductList WHERE TransactionTimestamp=@time);
UPDATE Transaction SET NoProducts=@noProducts, Cost=@cost WHERE TransactionTimestamp=@time;

--Query to show all Transactions with a spread of data
Select Transaction.TransactionTimestamp, NoProducts, Cost, Amount, Price, ProductList.ProductName FROM Transaction, TransactionProductList, ProductList WHERE Transaction.TransactionTimestamp=TransactionProductList.TransactionTimestamp AND TransactionProductList.ProductName=ProductList.ProductName;


Create table DeliveryInfo(
Code int primary key,
Info varchar(32) not null
)ENGINE=INNODB;

Insert Into DeliveryInfo VALUES (1,'Delivered Successfully');
Insert Into DeliveryInfo VALUES (2,'Out for Delivery');
Insert Into DeliveryInfo VALUES (3,'Being Processed');

Alter Table Transaction ADD FOREIGN KEY (DeliveryStatus) REFERENCES DeliveryInfo(Code);