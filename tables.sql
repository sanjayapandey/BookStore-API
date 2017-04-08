CREATE TABLE `books` (
  `title` char(128) DEFAULT NULL,
  `ISBN` char(20) NOT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`ISBN`)
) 

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` char(128) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
)

CREATE TABLE `purchase` (
  `purchase_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(20) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `ISBN` (`ISBN`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`),
  CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`)
)
CREATE TABLE `cart` (
  `cart_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(20) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `ISBN_CUSTOMER` (`ISBN`,`customer_id`),
  KEY `ISBN` (`ISBN`),
  KEY `customer_id` (`customer_id`)
)
