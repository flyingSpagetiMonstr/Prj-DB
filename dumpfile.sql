-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Employee`
--

DROP TABLE IF EXISTS `Employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Employee` (
  `employeeNo` int NOT NULL,
  `employeeName` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `sex` int DEFAULT NULL,
  `salary` int DEFAULT NULL,
  PRIMARY KEY (`employeeNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employee`
--

LOCK TABLES `Employee` WRITE;
/*!40000 ALTER TABLE `Employee` DISABLE KEYS */;
INSERT INTO `Employee` VALUES (1,'Xiao Ming','East county',NULL,NULL),(2,'Xiao Hong','Westminister',NULL,NULL),(3,'Green','Somewhere on the earth',NULL,NULL),(4,'somebody','East County',NULL,NULL);
/*!40000 ALTER TABLE `Employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Product` (
  `productNo` int NOT NULL,
  `productName` varchar(45) DEFAULT NULL,
  `serialNo` int NOT NULL,
  `unitPrice` int DEFAULT NULL,
  `quantityOnHand` int DEFAULT NULL,
  `reorderLevel` int DEFAULT NULL,
  `reorderQuantity` int DEFAULT NULL,
  `reorderLeadTime` int DEFAULT NULL,
  `catagoryNo` int NOT NULL,
  PRIMARY KEY (`productNo`),
  UNIQUE KEY `serialNo_UNIQUE` (`serialNo`),
  KEY `fk_Product_ProductCatagory1_idx` (`catagoryNo`),
  CONSTRAINT `fk_Product_ProductCatagory1` FOREIGN KEY (`catagoryNo`) REFERENCES `ProductCatagory` (`catagoryNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Product`
--

LOCK TABLES `Product` WRITE;
/*!40000 ALTER TABLE `Product` DISABLE KEYS */;
INSERT INTO `Product` VALUES (1,'Wooden Chair',3,NULL,NULL,NULL,NULL,NULL,1),(2,'Colored Paper',2,NULL,NULL,NULL,NULL,NULL,3),(3,'Steel Desk',5,NULL,NULL,NULL,NULL,NULL,2);
/*!40000 ALTER TABLE `Product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductCatagory`
--

DROP TABLE IF EXISTS `ProductCatagory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ProductCatagory` (
  `catagoryNo` int NOT NULL,
  `catagoryDescription` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`catagoryNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductCatagory`
--

LOCK TABLES `ProductCatagory` WRITE;
/*!40000 ALTER TABLE `ProductCatagory` DISABLE KEYS */;
INSERT INTO `ProductCatagory` VALUES (1,'Wood'),(2,'Steel'),(3,'Paper'),(4,'Glass');
/*!40000 ALTER TABLE `ProductCatagory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PurchaseOrder`
--

DROP TABLE IF EXISTS `PurchaseOrder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PurchaseOrder` (
  `purchaseOrderNo` int NOT NULL,
  `purchaseOrderDescription` varchar(45) DEFAULT NULL,
  `orderDate` int DEFAULT NULL,
  `dateRequired` int DEFAULT NULL,
  `shippedDate` int DEFAULT NULL,
  `freightCharge` int DEFAULT NULL,
  `employeeNo` int NOT NULL,
  `supplierNo` int NOT NULL,
  PRIMARY KEY (`purchaseOrderNo`),
  KEY `fk_PurchaseOrder_Employee1_idx` (`employeeNo`),
  KEY `fk_PurchaseOrder_Supplier1_idx` (`supplierNo`),
  CONSTRAINT `fk_PurchaseOrder_Employee1` FOREIGN KEY (`employeeNo`) REFERENCES `Employee` (`employeeNo`),
  CONSTRAINT `fk_PurchaseOrder_Supplier1` FOREIGN KEY (`supplierNo`) REFERENCES `Supplier` (`supplierNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PurchaseOrder`
--

LOCK TABLES `PurchaseOrder` WRITE;
/*!40000 ALTER TABLE `PurchaseOrder` DISABLE KEYS */;
INSERT INTO `PurchaseOrder` VALUES (1,'Wooden Chair Needed',NULL,NULL,NULL,NULL,1,1),(2,'Short of Colored Paper',NULL,NULL,NULL,NULL,1,3),(3,'Steel Desk',NULL,NULL,NULL,NULL,2,3),(4,'Something New',NULL,NULL,NULL,NULL,1,2);
/*!40000 ALTER TABLE `PurchaseOrder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Supplier`
--

DROP TABLE IF EXISTS `Supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Supplier` (
  `supplierNo` int NOT NULL,
  `supplierName` varchar(45) DEFAULT NULL,
  `supplierStreet` varchar(45) DEFAULT NULL,
  `supplierCity` varchar(45) DEFAULT NULL,
  `supplierState` varchar(45) DEFAULT NULL,
  `supplierZipCode` int DEFAULT NULL,
  `suppTelNo` int DEFAULT NULL,
  `suppFaxNo` int DEFAULT NULL,
  `suppEmailAddress` varchar(45) DEFAULT NULL,
  `suppWebAddress` varchar(45) DEFAULT NULL,
  `contactName` varchar(45) DEFAULT NULL,
  `contactTelNo` int DEFAULT NULL,
  `contactFaxNo` int DEFAULT NULL,
  `contactEmailAddress` varchar(45) DEFAULT NULL,
  `paymentTerms` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`supplierNo`),
  UNIQUE KEY `supplierName_UNIQUE` (`supplierName`),
  UNIQUE KEY `suppTelNo_UNIQUE` (`suppTelNo`),
  UNIQUE KEY `suppFaxNo_UNIQUE` (`suppFaxNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Supplier`
--

LOCK TABLES `Supplier` WRITE;
/*!40000 ALTER TABLE `Supplier` DISABLE KEYS */;
INSERT INTO `Supplier` VALUES (1,'Wood King',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Himmelsdorf',NULL),(2,'Steel King',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Paper King',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Stuzianki',NULL);
/*!40000 ALTER TABLE `Supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Transaction`
--

DROP TABLE IF EXISTS `Transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Transaction` (
  `transactionNo` int NOT NULL,
  `productNo` int NOT NULL,
  `purchaseOrderNo` int NOT NULL,
  `transactionDate` int DEFAULT NULL,
  `transactionDescription` varchar(45) DEFAULT NULL,
  `unitPrice` int DEFAULT NULL,
  `unitsOrdered` int DEFAULT NULL,
  `unitsReceived` int DEFAULT NULL,
  `unitsSold` int DEFAULT NULL,
  `unitsWastage` int DEFAULT NULL,
  PRIMARY KEY (`transactionNo`),
  KEY `fk_Transaction_Product1_idx` (`productNo`),
  KEY `fk_Transaction_PurchaseOrder1_idx` (`purchaseOrderNo`),
  CONSTRAINT `fk_Transaction_Product1` FOREIGN KEY (`productNo`) REFERENCES `Product` (`productNo`),
  CONSTRAINT `fk_Transaction_PurchaseOrder1` FOREIGN KEY (`purchaseOrderNo`) REFERENCES `PurchaseOrder` (`purchaseOrderNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Transaction`
--

LOCK TABLES `Transaction` WRITE;
/*!40000 ALTER TABLE `Transaction` DISABLE KEYS */;
INSERT INTO `Transaction` VALUES (1,2,1,20030726,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Transaction` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-04 14:39:47
