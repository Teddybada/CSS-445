DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  userID INT(11) PRIMARY KEY AUTO_INCREMENT,
  firstName VARCHAR(50),
  lastName VARCHAR(50),
  pwd CHAR(32) NOT NULL,
  email VARCHAR(256),
  phone VARCHAR(25),
  address VARCHAR(500),
  userType ENUM('Employee', 'Customer')
);

-- INSERT THE DEFAULT USERS
INSERT  INTO `User` VALUES 
(1,'Joe','Student','5f4dcc3b5aa765d61d8327deb882cf99',NULL,NULL, NULL, 'Employee'),
(2,'Jane','Teacher','5f4dcc3b5aa765d61d8327deb882cf99',NULL,NULL, NULL,'Customer');

DROP TABLE IF EXISTS `Order`;
CREATE TABLE `Order` (
  orderID INT PRIMARY KEY AUTO_INCREMENT,
  userID INT,
  FOREIGN KEY (userID) REFERENCES USER(userID)
  );
  
-- INSERT THE DEFAULT Orders
INSERT  INTO `Order` VALUES 
(1,1),
(2,2);

DROP TABLE IF EXISTS `Product`;
CREATE TABLE `Product` (
  productID INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50),
  description VARCHAR(512),
  price FLOAT
  );
  
-- INSERT THE DEFAULT Products
INSERT INTO `Product` VALUES
(1,'Magic Bullet','Blender',39.95),
(2,'Ninja','Blender',49.95);

DROP TABLE IF EXISTS `OrderDetail`;
CREATE TABLE `OrderDetail` (
  detailsID INT AUTO_INCREMENT PRIMARY KEY,
  productID INT,
  orderID INT,
  quantity INT,
  FOREIGN KEY (productID) REFERENCES Product(productID),
  FOREIGN KEY (orderID) REFERENCES `Order`(orderID)
  );
  
-- INSERT THE DEFAULT Order Details
INSERT INTO `OrderDetail` VALUES
(1,1,1,20),
(2,2,2,25);

DROP TABLE IF EXISTS `Cart`;
CREATE TABLE `Cart` (
  cartID INT PRIMARY KEY,
  productID INT,
  quantity INT,
  FOREIGN KEY (cartID) REFERENCES `User`(userID),
  FOREIGN KEY (productID) REFERENCES Product(productID)
  );
  
-- INSERT THE DEFAULT Cart
INSERT INTO `Cart` VALUES
(1,1,20),
(2,2,40);

DROP TABLE IF EXISTS `CartDetail`;
CREATE TABLE `CartDetail` (
  cartId INT,
  productId INT,
  quantity INT,
  FOREIGN KEY (cartID) REFERENCES Cart(cartID),
  FOREIGN KEY (productID) REFERENCES Product(productID)
  );
  
-- INSERT THE DEFAULT Cart Details
INSERT INTO `CartDetail` VALUES
(1,1,50),
(2,2,100);
  



  