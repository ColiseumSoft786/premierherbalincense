-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: spiceincense
-- ------------------------------------------------------
-- Server version	5.7.14-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(45) DEFAULT NULL,
  `Lastname` varchar(45) DEFAULT NULL,
  `Company` varchar(45) DEFAULT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `Country` varchar(45) DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `State` varchar(45) DEFAULT NULL,
  `SAddress` text,
  `Zip` varchar(45) DEFAULT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  `User` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_user_customer_idx` (`User`),
  CONSTRAINT `fk_user_customer` FOREIGN KEY (`User`) REFERENCES `user` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'kljagdhfg','gsdkjf','kjjkjdhfkj',NULL,'kjhskjdhf','jhsjkdfh',NULL,NULL,'jhkjhasdf','hkjjhjkdshf',2),(2,'jhasdhfjdh','kasdajfh','jjakhdskjfh',NULL,'jhsjdhf','jhasdjfh',NULL,NULL,'hjakhdf','hadsjfh',3),(3,'ABU','ZAR','Coliseum Soft',NULL,'Pakistan','Faisalabad',NULL,'klajgsdjfh, kjhakjsdfhk, , ahsdf','38000','3126629694',4);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `main`
--

DROP TABLE IF EXISTS `main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `main` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main`
--

LOCK TABLES `main` WRITE;
/*!40000 ALTER TABLE `main` DISABLE KEYS */;
INSERT INTO `main` VALUES (1,'Main Category'),(2,'new Category'),(4,'hello'),(5,'hellooooo'),(6,'sdfgdgf');
/*!40000 ALTER TABLE `main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Orderid` varchar(45) DEFAULT NULL,
  `Customer` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Payment` varchar(45) DEFAULT NULL,
  `Card` varchar(45) DEFAULT NULL,
  `Cvv` varchar(45) DEFAULT NULL,
  `Exp` varchar(45) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Review` text,
  PRIMARY KEY (`Id`),
  KEY `fk_order_customer_idx` (`Customer`),
  CONSTRAINT `fk_order_customer` FOREIGN KEY (`Customer`) REFERENCES `customer` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2,'Order2786',3,1,'mg',NULL,NULL,NULL,NULL,'This is very usefull product'),(3,'Order3786',3,1,'Western Union',NULL,NULL,NULL,5000,NULL),(4,'Order4786',3,0,'Western Union',NULL,NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pio`
--

DROP TABLE IF EXISTS `pio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pio` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Product` int(11) DEFAULT NULL,
  `Orders` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_pio_product_idx` (`Product`),
  KEY `fk_pio_orders_idx` (`Orders`),
  CONSTRAINT `fk_pio_orders` FOREIGN KEY (`Orders`) REFERENCES `orders` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pio_product` FOREIGN KEY (`Product`) REFERENCES `product` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pio`
--

LOCK TABLES `pio` WRITE;
/*!40000 ALTER TABLE `pio` DISABLE KEYS */;
INSERT INTO `pio` VALUES (1,4,2,1),(2,4,3,1);
/*!40000 ALTER TABLE `pio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Bs` int(11) DEFAULT NULL,
  `Ws` int(11) DEFAULT NULL,
  `Kartom` int(11) DEFAULT NULL,
  `Sub` int(11) DEFAULT NULL,
  `Details` text,
  `Price` float DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_sub_product_idx` (`Sub`),
  CONSTRAINT `fk_sub_product` FOREIGN KEY (`Sub`) REFERENCES `sub` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'jasdfgh','bundles/product/052120181123000500.jpg',10,1,0,0,2,'asdfsdfsdf',100),(2,'jhasdf','bundles/product/052120181138590559.jpg',1231,0,1,0,3,'aasdfasdf sadf sdaf sadfsdf',500),(4,'jaghsdjfhjj','bundles/product/052120180212400540.jpg',123,1,1,0,5,'hasjhdfsdfh sfhas dkjfasfasfasj fklas ',5000),(5,'My important product','bundles/product/052220181153430543.jpg',0,1,1,0,4,'af sdfsdfadsfasf ',100),(6,'jasgdfh','bundles/product/052220181153430543.jpg',12,1,1,0,4,'hjdkafh',10.11),(7,'kljhksdjf','bundles/product/052520180516060506.png',4,1,1,NULL,6,'jjadjkfhas dfasfh sf sfhasd fhasdfkjh',34.11);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Product` int(11) DEFAULT NULL,
  `Star` int(11) DEFAULT NULL,
  `Comment` text,
  PRIMARY KEY (`Id`),
  KEY `fk_product_review_idx` (`Product`),
  CONSTRAINT `fk_product_review` FOREIGN KEY (`Product`) REFERENCES `product` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub`
--

DROP TABLE IF EXISTS `sub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  `Main` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_main_sub_idx` (`Main`),
  CONSTRAINT `fk_main_sub` FOREIGN KEY (`Main`) REFERENCES `main` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub`
--

LOCK TABLES `sub` WRITE;
/*!40000 ALTER TABLE `sub` DISABLE KEYS */;
INSERT INTO `sub` VALUES (2,'Sub cat upddated ',1),(3,'Sub cat 3',1),(4,'Sub cat 4',1),(5,'Sub cat 5',1),(6,'hey',1),(9,'undefined',1),(10,'undefined',1),(11,'undefined',1),(12,'jasdfsf',1),(13,'shgufta',1),(14,'helllo',2),(15,'jiyee bhutoo',2),(17,'sdgdsfg',2);
/*!40000 ALTER TABLE `sub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin','1234','Admin'),(2,'abu@adf.com','73461gh164gbj','Customer'),(3,'adming@ooo.com','jjagfasdhfgashdf','Customer'),(4,'abuzar@some.com','123445678','Customer');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-28 14:24:29
