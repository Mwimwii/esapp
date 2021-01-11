-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: e_sapp
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

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
-- Table structure for table `audit_trail`
--

DROP TABLE IF EXISTS `audit_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_trail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `action` text NOT NULL,
  `date` int(11) unsigned NOT NULL,
  `ip_address` varchar(255) NOT NULL DEFAULT '',
  `user_agent` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_audit_trail_1_idx` (`user`),
  CONSTRAINT `fk_audit_trail_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=504 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_trail`
--

LOCK TABLES `audit_trail` WRITE;
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
INSERT INTO `audit_trail` VALUES (58,1,'Viewed audit trail logs',1607168395,'155.0.76.2','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(59,1,'Viewed audit trail logs',1607168415,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(60,1,'Viewed audit trail logs',1607168543,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(61,1,'Viewed audit trail logs',1607168553,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(62,1,'Viewed audit trail logs',1607168580,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(63,1,'Viewed audit trail logs',1607168719,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(64,1,'Viewed audit trail logs',1607168791,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(65,1,'Viewed audit trail logs',1607168812,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(66,1,'Viewed audit trail logs',1607168819,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(67,1,'Viewed audit trail logs',1607168825,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(68,1,'Viewed audit trail logs',1607168834,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(69,1,'Viewed audit trail logs',1607168843,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(70,1,'Viewed audit trail logs',1607168852,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(71,1,'Viewed audit trail logs',1607168885,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(72,1,'Viewed audit trail logs',1607168898,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(73,1,'Viewed audit trail logs',1607168908,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(74,1,'Viewed audit trail logs',1607168957,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(75,1,'Viewed audit trail logs',1607169080,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(76,1,'Viewed audit trail logs',1607169095,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(77,1,'Viewed audit trail logs',1607169261,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(78,1,'Viewed audit trail logs',1607169277,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(79,1,'Viewed audit trail logs',1607169297,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(80,1,'Viewed audit trail logs',1607169312,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(81,1,'Viewed audit trail logs',1607169431,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(82,1,'Viewed audit trail logs',1607169443,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(83,1,'Viewed audit trail logs',1607169458,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(84,1,'Viewed audit trail logs',1607169473,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(85,1,'Viewed audit trail logs',1607169486,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(86,1,'Viewed audit trail logs',1607169500,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(87,1,'Viewed audit trail logs',1607169510,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(88,1,'Viewed audit trail logs',1607169576,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(89,1,'Viewed audit trail logs',1607169586,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(90,1,'Viewed audit trail logs',1607169640,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(91,1,'Viewed audit trail logs',1607169794,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(92,1,'Viewed audit trail logs',1607169819,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(93,1,'Viewed audit trail logs',1607169833,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(94,1,'Viewed audit trail logs',1607170072,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(95,1,'Viewed audit trail logs',1607170082,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(96,1,'Viewed audit trail logs',1607170134,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(97,1,'Viewed audit trail logs',1607170138,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(98,1,'Viewed audit trail logs',1607170193,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(99,1,'Viewed audit trail logs',1607170201,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(100,1,'Viewed audit trail logs',1607170207,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(101,1,'Viewed audit trail logs',1607170219,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(102,1,'Viewed audit trail logs',1607170226,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(103,1,'Viewed audit trail logs',1607170235,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(104,1,'Viewed audit trail logs',1607170267,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(105,1,'Viewed audit trail logs',1607170296,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(106,1,'Viewed audit trail logs',1607170312,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(107,1,'Blocked user account with email:test@unza.zm',1607186598,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(108,1,'Viewed audit trail logs',1607186600,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(109,1,'Blocked user account with email:test@unza.zm',1607186622,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(110,1,'Viewed audit trail logs',1607186624,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(111,1,'Viewed audit trail logs',1607186682,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(112,1,'Blocked user account with email:test@unza.zm',1607186690,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(113,1,'Viewed audit trail logs',1607186692,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(114,1,'Blocked user account with email:test@unza.zm',1607186703,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(115,1,'Viewed audit trail logs',1607186704,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(116,1,'Blocked user account with email:test@unza.zm',1607186731,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(117,1,'Viewed audit trail logs',1607186733,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(118,1,'Activate user account with email:test@unza.zm',1607186786,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(119,1,'Viewed audit trail logs',1607186787,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(120,1,'Update role Administrator',1607186989,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(121,1,'Viewed audit trail logs',1607186991,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(122,1,'Update role Administrator',1607187108,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(123,1,'Update profile details ',1607187362,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(124,1,'Viewed audit trail logs',1607187365,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(125,1,'Updated user details with email: test1@unza.zm',1607242404,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(126,1,'Viewed audit trail logs',1607242508,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(127,1,'Update role Administrator',1607245883,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(128,1,'Viewed audit trail logs',1607247209,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(129,1,'updated province name from Central to Central',1607247603,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(130,1,'Viewed audit trail logs',1607247606,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(131,1,'Viewed audit trail logs',1607247641,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(132,1,'Viewed audit trail logs',1607247648,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(133,1,'Viewed audit trail logs',1607247676,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(134,1,'updated province name from Central to Central1',1607247693,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(135,1,'Viewed audit trail logs',1607247695,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(136,1,'updated province name from Central1 to Central',1607247704,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(137,1,'Removed province Test from the system.',1607249537,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(138,1,'Update role Administrator',1607251235,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(139,1,'Udated district name from Chisamba to Chisamba1',1607251926,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(140,1,'Udated district name from Chisamba1 to Chisamba',1607251931,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(141,1,'Removed district test from the system.',1607252512,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(142,1,'Removed district test from the system.',1607252524,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(143,1,'Updated district name from test to Masaiti',1607252777,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(144,1,'Removed district test from the system.',1607252791,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(145,1,'Updated camp name from Camp 1 to Camp tes',1607253365,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(146,1,'Updated camp name from Camp tes to Camp test',1607253369,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(147,1,'Viewed audit trail logs',1607253762,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(148,1,'Viewed audit trail logs',1607253822,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(149,1,'Viewed audit trail logs',1607253858,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(150,1,'Viewed audit trail logs',1607253880,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(151,1,'Viewed audit trail logs',1607259589,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(152,1,'Viewed audit trail logs',1607259595,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(153,1,'Viewed audit trail logs',1607259607,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(154,1,'Viewed audit trail logs',1607259612,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(155,1,'Viewed audit trail logs',1607259625,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(156,1,'Viewed audit trail logs',1607259632,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(157,1,'Viewed audit trail logs',1607259699,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(158,1,'Viewed audit trail logs',1607259706,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(159,1,'Viewed audit trail logs',1607259932,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(160,1,'Viewed audit trail logs',1607260015,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(161,1,'Viewed audit trail logs',1607260051,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(162,1,'Viewed audit trail logs',1607260061,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(163,1,'Viewed audit trail logs',1607260109,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(164,1,'Viewed audit trail logs',1607260118,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(165,1,'Viewed audit trail logs',1607260130,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(166,1,'Viewed audit trail logs',1607260137,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(167,1,'Viewed audit trail logs',1607260408,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(168,1,'Viewed audit trail logs',1607260413,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(169,1,'Viewed audit trail logs',1607260423,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(170,1,'Viewed audit trail logs',1607260432,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(171,1,'Viewed audit trail logs',1607260449,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(172,1,'Viewed audit trail logs',1607260452,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(173,1,'Viewed audit trail logs',1607260458,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(174,1,'Viewed audit trail logs',1607260466,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(175,1,'Viewed audit trail logs',1607260473,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(176,1,'Viewed audit trail logs',1607260539,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(177,1,'Viewed audit trail logs',1607260544,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(178,1,'Viewed audit trail logs',1607260660,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(179,1,'Viewed audit trail logs',1607260663,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(180,1,'Removed district Camp test from the system.',1607262303,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(181,1,'Update role Administrator',1607262806,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(182,1,'Added camp Camp 1',1607263313,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(183,1,'Update role Administrator',1607264609,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(184,1,'Added market Chisokone',1607267413,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(185,1,'Added market Soweto',1607267496,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(186,1,'Updated market name from Soweto to Chisokone',1607267547,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(187,1,'Updated market name from Chisokone to Chisokone1',1607267577,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(188,1,'Updated market name from Chisokone1 to Chisokone',1607267581,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(189,1,'updated province name from Central to Central1',1607362050,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(190,1,'updated province name from Central1 to Central',1607362055,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(191,1,'Added province Test',1607362059,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(192,1,'Removed province Test from the system.',1607362063,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(193,1,'Updated district name from Masaiti to Masaiti1',1607362083,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(194,1,'Updated district name from Masaiti1 to Masaiti',1607362090,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(195,1,'Added district Test',1607362100,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(196,1,'Removed district Test from the system.',1607362111,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(197,1,'Updated camp name from Camp 1 to Camp one',1607362120,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(198,1,'Added camp Camp 1',1607362135,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(199,1,'Removed camp Camp 1 from the system.',1607362141,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(200,1,'Updated market name from Soweto to Soweto 1',1607362167,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(201,1,'Updated market name from Soweto 1 to Soweto',1607362171,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(202,1,'Added market Tuesday',1607362187,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(203,1,'Removed market Tuesday from the system.',1607362191,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(204,1,'Updated profile details ',1607362247,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(205,1,'Changed account password',1607362298,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(206,1,'Update role Administrator',1607362421,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(207,1,'Update role Administrator',1607362425,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(208,1,'Created role Test',1607362485,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(209,1,'Created role Test',1607362532,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(210,1,'Removed role Test from the system',1607362535,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(211,1,'Created role Test',1607362548,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(212,1,'Removed role Test from the system',1607362552,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(213,1,'Updated user details with email: chulu1francis@gmail.com',1607362692,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(214,1,'Blocked user account with email chulu1francis@gmail.com',1607362700,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(215,1,'Activated user account with email:test2@unza.zm',1607362711,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(216,1,'Activated user account with email:chulu1francis@gmail.com',1607362716,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(217,1,'Deleted user account with email testtest@unza.zm',1607362906,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(218,1,'Created user with email: testtest1@unza.zm',1607362942,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(219,1,'Deleted user account with email testtest1@unza.zm',1607362955,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(220,1,'Update role Administrator',1607365503,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(221,1,'Update role Administrator',1607417426,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(222,1,'Added commodity category Test',1607417546,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(223,1,'Removed commodity category Test from the system.',1607417550,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(224,1,'Added commodity category Test',1607417556,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(225,1,'Updated commodity category name from Test to Farming inputs',1607417593,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(226,1,'Updated commodity category description to::Description',1607417619,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(227,1,'Updated commodity category name from Farming inputs to Farming input',1607417624,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(228,1,'Added commodity category Farm produce',1607417638,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(229,1,'Updated commodity category description to::Description',1607417646,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(230,1,'Updated commodity category name from Farming input to Farming inputs',1607417654,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(231,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy',1607417765,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(232,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',1607417788,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(233,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ',1607417811,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(234,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',1607418245,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(235,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',1607418984,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(236,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ',1607419166,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(237,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',1607419282,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(238,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ',1607419333,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(239,1,'Updated commodity category description to::Farm outputs such as maize, groundnuts\r\n',1607423557,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(240,1,'Added commodity type Maize',1607446739,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(241,1,'Added commodity type Soya beans',1607447814,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(242,1,'Added commodity type Groundnuts',1607447827,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(243,1,'Updated commodity type name from Groundnuts to Maize',1607447843,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(244,1,'Added commodity type Rice',1607447871,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(245,1,'Added commodity type Mealie meal',1607447890,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(246,1,'Added commodity type Roller meal',1607447902,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(247,1,'Added commodity category Farm output by products',1607447921,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(248,1,'Updated commodity category name from Farm produce to Farm outs',1607447929,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(249,1,'Updated commodity category name from Farm outs to Farm outputs',1607447942,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(250,1,'Updated commodity type category to::4',1607447952,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(251,1,'Updated commodity type category to::4',1607447956,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(252,1,'Added commodity type Maize Seed',1607447971,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(253,1,'Added commodity type Groundnut seed',1607447992,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(254,1,'Added commodity type Rice seed',1607448004,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(255,1,'Added commodity type D-Compound',1607448021,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(256,1,'Added commodity type Urea',1607448041,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(257,1,'Added commodity type Test',1607448169,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(258,1,'Removed commodity type Test from the system.',1607448184,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(259,1,'Updated commodity category name from Farm output by products to Farm output by-products',1607585616,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(260,1,'Updated commodity price level description to::Farm gate',1607588412,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(261,1,'Added commodity price level Test level',1607588513,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(262,1,'Removed Commodity price level Test level from the system.',1607588618,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(263,1,'Update role Administrator',1607589736,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(264,1,'Updated commodity price details',1607598826,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(265,1,'Updated commodity price details',1607598831,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(266,1,'Updated commodity price details',1607600021,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(267,1,'Updated commodity price details',1607600044,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(268,1,'Update role Administrator',1607600190,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(269,1,'Updated commodity price details',1607600728,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(270,1,'Updated commodity price details',1607600734,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(271,1,'Updated commodity price details',1607601306,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(272,1,'Updated commodity price details',1607601320,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(273,1,'Updated commodity price details',1607601338,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(274,1,'Updated commodity price details',1607601363,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(275,1,'Updated commodity price details',1607601519,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(276,1,'Updated commodity price details',1607601536,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(277,1,'Updated commodity price details',1607601552,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(278,1,'Updated commodity price details',1607601558,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(279,1,'Updated commodity price details',1607601566,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(280,1,'Updated commodity price details',1607601575,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(281,1,'Updated commodity price details',1607601580,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(282,1,'Updated commodity price details',1607601586,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(283,1,'Updated commodity price details',1607601594,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(284,1,'Updated commodity price details',1607601599,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(285,1,'Updated commodity price details',1607601601,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(286,1,'Updated commodity price details',1607601607,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(287,1,'Updated commodity price details',1607601611,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(288,1,'Updated commodity price details',1607601627,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(289,1,'Updated commodity price details',1607601630,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(290,1,'Updated commodity price details',1607601662,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(291,1,'Updated commodity price details',1607601744,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(292,1,'Updated commodity price details',1607601759,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(293,1,'Updated commodity price details',1607601764,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(294,1,'Updated commodity price details',1607601769,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(295,1,'Updated commodity price details',1607601859,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(296,1,'Updated commodity price details',1607601861,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(297,1,'Added market Chisamba test',1607623358,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(298,1,'Removed commodity price from the system.',1607627535,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(299,1,'Updated user details with email: chulu1francis@gmail.com',1609866047,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(300,1,'Updated user details with email: chulu1francis@gmail.com',1609866079,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(301,1,'Updated user details with email: chulu1francis@gmail.com',1609866721,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(302,1,'Updated user details with email: chulu1francis@gmail.com',1609866781,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(303,1,'Update role Administrator',1609951977,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(304,1,'Added interview guide question Please introduce yourself and tell me a bit about yourself?',1609956950,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(305,1,'Added interview guide question What Challenges were you experiencing before the E-SAPP and why?',1609958624,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(306,1,'Added interview guide question Did you do anything to solve the problem before E-SAPP? If yes, what did you do?',1609958658,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(307,1,'Added interview guide question What interventions did E-SAPP put in place to resolve the problem?  Probe: Detail them according to the different steps taken.',1609958714,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(308,1,'Added interview guide question Did the interventions by E-SAPP resolve the problem? Give a reason for your answer.',1609958980,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(309,1,'Added interview guide question In your opinion, do you think this problem was going to be addressed if it was not for the intervention from E-SAPP? Give a reason?',1609958996,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(310,1,'Added interview guide question What are the key areas of change that you noticed as a result of the intervention? Give examples. ',1609959016,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(311,1,'Added interview guide question What are some of the lessons that you have learnt from the intervention?',1609959038,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(312,1,'Added interview guide question  In terms of how the E-SAPP could improve its intervention delivery, do you have any recommendations/ suggestions? What do you think needs to be done?',1609959055,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(313,1,'Update role Administrator',1610036540,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(314,1,'Added interview guide question::\'Test\'',1610038847,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(315,1,'Removed interview guide question: \'Test\' from the system.',1610038851,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(316,1,'Downloaded interview question guide template',1610041729,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(317,1,'Downloaded interview question guide template',1610349761,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(318,1,'Downloaded interview question guide template',1610351246,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(319,1,'Downloaded interview question guide template',1610351289,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(320,1,'Downloaded interview question guide template',1610351300,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(321,1,'Downloaded interview question guide template',1610351391,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(322,1,'Downloaded interview question guide template',1610351424,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(323,1,'Downloaded interview question guide template',1610351439,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(324,1,'Downloaded interview question guide template',1610351454,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(325,1,'Downloaded interview question guide template',1610351466,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(326,1,'Downloaded interview question guide template',1610351493,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(327,1,'Downloaded interview question guide template',1610351524,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(328,1,'Downloaded interview question guide template',1610351550,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(329,1,'Downloaded interview question guide template',1610351571,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(330,1,'Downloaded interview question guide template',1610351602,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(331,1,'Downloaded interview question guide template',1610351635,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(332,1,'Downloaded interview question guide template',1610351667,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(333,1,'Downloaded interview question guide template',1610351677,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(334,1,'Downloaded interview question guide template',1610351686,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(335,1,'Downloaded interview question guide template',1610352092,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(336,1,'Downloaded interview question guide template',1610352144,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(337,1,'Downloaded interview question guide template',1610352161,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(338,1,'Downloaded interview question guide template',1610352209,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(339,1,'Downloaded interview question guide template',1610352328,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(340,1,'Downloaded interview question guide template',1610352358,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(341,1,'Downloaded interview question guide template',1610352513,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(342,1,'Downloaded interview question guide template',1610352619,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(343,1,'Downloaded interview question guide template',1610352636,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(344,1,'Downloaded interview question guide template',1610352660,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(345,1,'Downloaded interview question guide template',1610352688,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(346,1,'Downloaded interview question guide template',1610352761,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(347,1,'Downloaded interview question guide template',1610352792,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(348,1,'Downloaded interview question guide template',1610352802,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(349,1,'Downloaded interview question guide template',1610352830,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(350,1,'Downloaded interview question guide template',1610352856,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(351,1,'Downloaded interview question guide template',1610352951,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(352,1,'Downloaded interview question guide template',1610352968,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(353,1,'Downloaded interview question guide template',1610353036,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(354,1,'Downloaded interview question guide template',1610353049,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(355,1,'Downloaded interview question guide template',1610353063,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(356,1,'Downloaded interview question guide template',1610353074,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(357,1,'Downloaded interview question guide template',1610353089,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(358,1,'Downloaded interview question guide template',1610353159,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(359,1,'Downloaded interview question guide template',1610353181,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(360,1,'Downloaded interview question guide template',1610353190,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(361,1,'Downloaded interview question guide template',1610353200,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(362,1,'Downloaded interview question guide template',1610353249,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(363,1,'Downloaded interview question guide template',1610353265,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(364,1,'Downloaded interview question guide template',1610353289,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(365,1,'Downloaded interview question guide template',1610353311,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(366,1,'Downloaded interview question guide template',1610353325,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(367,1,'Downloaded interview question guide template',1610353357,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(368,1,'Downloaded interview question guide template',1610353373,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(369,1,'Downloaded interview question guide template',1610353405,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(370,1,'Downloaded interview question guide template',1610353508,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(371,1,'Downloaded interview question guide template',1610353519,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(372,1,'Downloaded interview question guide template',1610353562,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(373,1,'Downloaded interview question guide template',1610353582,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(374,1,'Downloaded interview question guide template',1610353624,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(375,1,'Downloaded interview question guide template',1610353654,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(376,1,'Downloaded interview question guide template',1610353667,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(377,1,'Downloaded interview question guide template',1610353677,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(378,1,'Downloaded interview question guide template',1610353690,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(379,1,'Downloaded interview question guide template',1610353759,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(380,1,'Downloaded interview question guide template',1610353783,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(381,1,'Downloaded interview question guide template',1610353889,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(382,1,'Downloaded interview question guide template',1610353905,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(383,1,'Downloaded interview question guide template',1610353981,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(384,1,'Downloaded interview question guide template',1610354052,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(385,1,'Downloaded interview question guide template',1610354152,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(386,1,'Downloaded interview question guide template',1610354174,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(387,1,'Downloaded interview question guide template',1610354278,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(388,1,'Downloaded interview question guide template',1610354293,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(389,1,'Downloaded interview question guide template',1610354331,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(390,1,'Downloaded interview question guide template',1610354370,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(391,1,'Downloaded interview question guide template',1610354464,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(392,1,'Downloaded interview question guide template',1610354478,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(393,1,'Downloaded interview question guide template',1610354515,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(394,1,'Downloaded interview question guide template',1610354578,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(395,1,'Downloaded interview question guide template',1610354588,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(396,1,'Downloaded interview question guide template',1610354602,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(397,1,'Downloaded interview question guide template',1610354651,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(398,1,'Downloaded interview question guide template',1610354806,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(399,1,'Downloaded interview question guide template',1610354992,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(400,1,'Downloaded interview question guide template',1610355053,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(401,1,'Downloaded interview question guide template',1610355073,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(402,1,'Downloaded interview question guide template',1610355099,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(403,1,'Downloaded interview question guide template',1610355112,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(404,1,'Downloaded interview question guide template',1610355158,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(405,1,'Downloaded interview question guide template',1610355177,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(406,1,'Downloaded interview question guide template',1610355186,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(407,1,'Downloaded interview question guide template',1610355255,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(408,1,'Downloaded interview question guide template',1610355281,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(409,1,'Downloaded interview question guide template',1610355346,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(410,1,'Downloaded interview question guide template',1610355461,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(411,1,'Downloaded interview question guide template',1610355478,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(412,1,'Downloaded interview question guide template',1610355532,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(413,1,'Downloaded interview question guide template',1610355544,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(414,1,'Downloaded interview question guide template',1610355564,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(415,1,'Downloaded interview question guide template',1610355656,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(416,1,'Downloaded interview question guide template',1610355676,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(417,1,'Downloaded interview question guide template',1610355693,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(418,1,'Downloaded interview question guide template',1610355771,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(419,1,'Downloaded interview question guide template',1610355819,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(420,1,'Downloaded interview question guide template',1610355864,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(421,1,'Downloaded interview question guide template',1610355885,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(422,1,'Downloaded interview question guide template',1610355925,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(423,1,'Downloaded interview question guide template',1610355936,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(424,1,'Downloaded interview question guide template',1610355961,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(425,1,'Downloaded interview question guide template',1610355976,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(426,1,'Downloaded interview question guide template',1610356024,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(427,1,'Downloaded interview question guide template',1610356038,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(428,1,'Downloaded interview question guide template',1610356065,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(429,1,'Downloaded interview question guide template',1610356085,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(430,1,'Downloaded interview question guide template',1610356095,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(431,1,'Downloaded interview question guide template',1610356104,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(432,1,'Downloaded interview question guide template',1610356136,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(433,1,'Downloaded interview question guide template',1610356284,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(434,1,'Downloaded interview question guide template',1610356325,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(435,1,'Downloaded interview question guide template',1610356356,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(436,1,'Downloaded interview question guide template',1610356388,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(437,1,'Downloaded interview question guide template',1610356405,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(438,1,'Downloaded interview question guide template',1610356420,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(439,1,'Downloaded interview question guide template',1610356434,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(440,1,'Downloaded interview question guide template',1610356442,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(441,1,'Downloaded interview question guide template',1610356468,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(442,1,'Downloaded interview question guide template',1610356477,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(443,1,'Downloaded interview question guide template',1610356509,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(444,1,'Downloaded interview question guide template',1610356546,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(445,1,'Downloaded interview question guide template',1610356560,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(446,1,'Downloaded interview question guide template',1610356617,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(447,1,'Downloaded interview question guide template',1610356664,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(448,1,'Downloaded interview question guide template',1610356673,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(449,1,'Downloaded interview question guide template',1610356682,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(450,1,'Downloaded interview question guide template',1610356692,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(451,1,'Downloaded interview question guide template',1610356717,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(452,1,'Downloaded interview question guide template',1610356734,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(453,1,'Downloaded interview question guide template',1610356745,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(454,1,'Downloaded interview question guide template',1610356778,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(455,1,'Downloaded interview question guide template',1610356848,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(456,1,'Downloaded interview question guide template',1610356921,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(457,1,'Downloaded interview question guide template',1610356939,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(458,1,'Downloaded interview question guide template',1610357001,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(459,1,'Downloaded interview question guide template',1610357013,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(460,1,'Downloaded interview question guide template',1610357058,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(461,1,'Downloaded interview question guide template',1610357107,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(462,1,'Downloaded interview question guide template',1610357240,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(463,1,'Downloaded interview question guide template',1610357277,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(464,1,'Downloaded interview question guide template',1610357293,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(465,1,'Downloaded interview question guide template',1610357316,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(466,1,'Downloaded interview question guide template',1610357325,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(467,1,'Downloaded interview question guide template',1610357339,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(468,1,'Downloaded interview question guide template',1610357352,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(469,1,'Downloaded Story of change interview guide template',1610357432,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(470,1,'Downloaded Story of change interview guide template',1610357961,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(471,1,'Downloaded Story of change interview guide template',1610358023,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(472,1,'Downloaded Story of change interview guide template',1610358035,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(473,1,'Downloaded Story of change interview guide template',1610358069,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(474,1,'Downloaded Story of change interview guide template',1610358187,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(475,1,'Downloaded Story of change interview guide template',1610358228,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(476,1,'Downloaded Story of change interview guide template',1610358245,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(477,1,'Updated interview guide question from:\' What interventions did E-SAPP put in place to resolve the problem?  Probe: Detail them according to the different steps taken. \' to \'What interventions did E-SAPP put in place to resolve the problem?  <b>Probe: Detail them according to the different steps taken</b>.\'',1610358307,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(478,1,'Downloaded Story of change interview guide template',1610358424,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(479,1,'Downloaded Story of change interview guide template',1610358440,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(480,1,'Downloaded Story of change interview guide template',1610358513,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(481,1,'Downloaded Story of change interview guide template',1610358543,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(482,1,'Downloaded Story of change interview guide template',1610358579,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(483,1,'Downloaded Story of change interview guide template',1610358665,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(484,1,'Downloaded Story of change interview guide template',1610358722,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(485,1,'Downloaded Story of change interview guide template',1610358770,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(486,1,'Update role Administrator',1610358885,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(487,1,'Update role Administrator',1610359557,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(488,1,'Downloaded Story of change interview guide template',1610359924,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(489,1,'Update role Administrator',1610360300,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(490,1,'Added story of change category: Test',1610361294,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(491,1,'Removed story of change category: Test from the system.',1610361447,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(492,1,'Added story of change category: Test',1610361454,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(493,1,'Updated story of change category description to::Description',1610361478,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(494,1,'Added story of change category: Livestock ',1610361550,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(495,1,'Added story of change category: Subsistence farming',1610361568,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(496,1,'Updated story of change category description to::Subsistence farming',1610361592,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(497,1,'Updated story of change category name from Livestock  to Livestock farming',1610378652,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(498,1,'Removed story of change category: Test from the system.',1610378656,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(499,1,'Update role Administrator',1610381215,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(500,1,'Added story of change: Test',1610388688,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(501,1,'Removed story of change: Test from the system.',1610388904,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(502,1,'Added story of change: Test',1610388925,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(503,1,'Updated story of change: Test',1610392208,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0');
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `camp`
--

DROP TABLE IF EXISTS `camp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `camp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_camp_1_idx` (`district_id`),
  CONSTRAINT `fk_camp_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `camp`
--

LOCK TABLES `camp` WRITE;
/*!40000 ALTER TABLE `camp` DISABLE KEYS */;
INSERT INTO `camp` VALUES (4,43,'Camp one',NULL,NULL,NULL,1607263313,1607362125,1,1);
/*!40000 ALTER TABLE `camp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodity_category`
--

DROP TABLE IF EXISTS `commodity_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodity_category`
--

LOCK TABLES `commodity_category` WRITE;
/*!40000 ALTER TABLE `commodity_category` DISABLE KEYS */;
INSERT INTO `commodity_category` VALUES (2,'Farming inputs','The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ',1607417556,1607419333,1,1),(3,'Farm outputs','Farm outputs such as maize, groundnuts\r\n',1607417638,1607447942,1,1),(4,'Farm output by-products',NULL,1607447921,1607585616,1,1);
/*!40000 ALTER TABLE `commodity_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodity_price_collection`
--

DROP TABLE IF EXISTS `commodity_price_collection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_price_collection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district` int(11) unsigned NOT NULL,
  `market_id` int(11) unsigned NOT NULL,
  `commodity_type_id` int(11) unsigned NOT NULL,
  `price_level_id` int(11) unsigned NOT NULL,
  `unit_of_measure` varchar(45) DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `description` text,
  `month` varchar(3) NOT NULL,
  `year` varchar(11) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commodity_price_collection_2_idx` (`price_level_id`),
  KEY `fk_commodity_price_collection_4_idx` (`commodity_type_id`),
  KEY `fk_commodity_price_collection_3_idx` (`market_id`),
  KEY `fk_commodity_price_collection_1_idx` (`district`),
  CONSTRAINT `fk_commodity_price_collection_1` FOREIGN KEY (`district`) REFERENCES `district` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_commodity_price_collection_2` FOREIGN KEY (`price_level_id`) REFERENCES `commodity_price_level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_commodity_price_collection_3` FOREIGN KEY (`market_id`) REFERENCES `market` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_commodity_price_collection_4` FOREIGN KEY (`commodity_type_id`) REFERENCES `commodity_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodity_price_collection`
--

LOCK TABLES `commodity_price_collection` WRITE;
/*!40000 ALTER TABLE `commodity_price_collection` DISABLE KEYS */;
INSERT INTO `commodity_price_collection` VALUES (2,1,3,4,3,'2Kg',15.00,NULL,'12','2020',1607626330,1607626330,1,1),(3,1,3,6,3,'10Kg',69.00,NULL,'12','2020',1607627366,1607627366,1,1),(4,1,3,5,3,'25Kg',120.00,NULL,'12','2020',1607627366,1607627366,1,1),(5,1,3,1,3,'2kg',20.00,NULL,'12','2020',1607627366,1607627366,1,1),(6,1,3,2,3,'5kg',25.00,NULL,'12','2020',1607627366,1607627366,1,1),(7,1,3,6,3,'2KG',15.00,NULL,'1','2021',1607627366,1607627366,1,1),(8,1,3,1,3,'2KG',15.00,NULL,'1','2021',1607627366,1607627366,1,1),(9,1,3,3,3,'2KG',15.00,NULL,'1','2021',1607627366,1607627366,1,1),(10,1,3,4,3,'5KG',25.00,NULL,'1','2021',1607627366,1607627366,1,1),(11,1,3,5,3,'10KG',50.00,NULL,'1','2021',1607627366,1607627366,1,1),(12,1,3,3,3,'10KG',30.00,NULL,'1','2021',1607627366,1607627366,1,1);
/*!40000 ALTER TABLE `commodity_price_collection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodity_price_level`
--

DROP TABLE IF EXISTS `commodity_price_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_price_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(45) NOT NULL,
  `description` text,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodity_price_level`
--

LOCK TABLES `commodity_price_level` WRITE;
/*!40000 ALTER TABLE `commodity_price_level` DISABLE KEYS */;
INSERT INTO `commodity_price_level` VALUES (1,'Farm gate','Farm gate',1568287523,1568287523,NULL,1),(2,'Wholesale',NULL,1568287523,1568287523,NULL,NULL),(3,'Retail',NULL,1568287523,1568287523,NULL,NULL);
/*!40000 ALTER TABLE `commodity_price_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodity_type`
--

DROP TABLE IF EXISTS `commodity_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commodity_type_1_idx` (`category_id`),
  CONSTRAINT `fk_commodity_type_1` FOREIGN KEY (`category_id`) REFERENCES `commodity_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodity_type`
--

LOCK TABLES `commodity_type` WRITE;
/*!40000 ALTER TABLE `commodity_type` DISABLE KEYS */;
INSERT INTO `commodity_type` VALUES (1,3,'Maize',1607446739,1607447798,1,1),(2,3,'Soya beans',1607447814,1607447814,1,1),(3,3,'Groundnuts',1607447827,1607447827,1,1),(4,3,'Rice',1607447871,1607447871,1,1),(5,4,'Mealie meal',1607447890,1607447952,1,1),(6,4,'Roller meal',1607447902,1607447956,1,1),(7,2,'Maize Seed',1607447971,1607447971,1,1),(8,2,'Groundnut seed',1607447992,1607447992,1,1),(9,2,'Rice seed',1607448004,1607448004,1,1),(10,2,'D-Compound',1607448021,1607448021,1,1),(11,2,'Urea',1607448041,1607448041,1,1);
/*!40000 ALTER TABLE `commodity_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `district` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `province_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `long` varchar(20) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province` (`province_id`),
  CONSTRAINT `fk_district_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,1,'Chisamba','-14.982045','28.377941',0,1607257385,NULL,1),(2,1,'Chibombo','-14.659314','28.080540',0,0,NULL,NULL),(3,1,'Chitambo','-12.226766','30.050454',0,0,NULL,NULL),(4,1,'Itezhi-Tezhi','-15.600785','25.903189',0,0,NULL,NULL),(5,1,'Mkushi','-13.618959','29.395959',0,0,NULL,NULL),(6,1,'Mumbwa','-14.983506','27.062202',0,0,NULL,NULL),(7,1,'Kabwe','-14.435119','28.449286',0,0,NULL,NULL),(8,1,'Kapiri Mposhi','-13.965676','28.679295',0,0,NULL,NULL),(9,1,'Luano','-14.115876','30.165637',0,0,NULL,NULL),(10,1,'Serenje','-13.230460','30.232615',0,0,NULL,NULL),(11,1,'Ngabwe','-14.083993','27.254295',0,0,NULL,NULL),(12,2,'Lufwanyama','-12.950965','27.410405',0,1607251969,NULL,NULL),(13,2,'Mufulira','-12.547810','28.239540',0,0,NULL,NULL),(14,2,'Kitwe','-12.829186','28.221206',0,0,NULL,NULL),(15,2,'Chililabombwe','-12.369279','27.837037',0,0,NULL,NULL),(16,2,'Kalulushi','-12.841575','28.093685',0,0,NULL,NULL),(17,2,'Ndola','-12.985475','28.641245',0,0,NULL,NULL),(18,2,'Luanshya','-13.143666','28.407905',0,0,NULL,NULL),(19,2,'Mpongwe','-13.512809','28.156596',0,0,NULL,NULL),(20,2,'Chingola','-12.538506','27.863672',0,0,NULL,NULL),(21,2,'Masaiti','-13.260320','28.405731',0,1607362090,NULL,1),(22,3,'Katete','-14.060067','32.044859',0,0,NULL,NULL),(23,3,'Chipata','-13.641016','32.644361',0,0,NULL,NULL),(24,3,'Petauke','-14.247244','31.328673',0,0,NULL,NULL),(25,3,'Lundazi','-12.289583','33.178067',0,0,NULL,NULL),(26,3,'Chadiza','-14.064839','32.436619',0,0,NULL,NULL),(27,3,'Mambwe','-13.212054','31.816900',0,0,NULL,NULL),(28,3,'Nyimba','-14.560282','30.820266',0,0,NULL,NULL),(29,3,'Vubwi','-14.035375','32.869092',0,0,NULL,NULL),(30,3,'Sinda','-14.214009','31.760187',0,0,NULL,NULL),(31,4,'Chiengi','-8.663500','29.160315',0,0,NULL,NULL),(32,4,'Nchelenge','-9.351089','28.739773',0,0,NULL,NULL),(33,4,'Kawambwa','-9.795545','29.074804',0,0,NULL,NULL),(34,4,'Mwense','-10.388397','28.701568',0,0,NULL,NULL),(35,4,'Mansa','-11.187779','28.883424',0,0,NULL,NULL),(36,4,'Samfya','-11.367624','29.554017',0,0,NULL,NULL),(37,4,'Milenge','-11.912971','29.189114',0,0,NULL,NULL),(38,4,'Chembe','-11.952502','28.744292',0,0,NULL,NULL),(39,4,'Lunga','-11.575272','30.102494',0,0,NULL,NULL),(40,4,'Chipili','-10.737772','29.091339',0,0,NULL,NULL),(41,4,'Mwansabombwe','-9.820162','28.763924',0,0,NULL,NULL),(42,5,'Chilanga','-15.567154','28.273961',0,0,NULL,NULL),(43,5,'Chirundu','-16.028711','28.850641',0,0,NULL,NULL),(44,5,'Chongwe','-15.331246','28.677833',0,0,NULL,NULL),(45,5,'Kafue','-15.761006','28.176701',0,0,NULL,NULL),(46,5,'Luangwa','-15.625206','30.402532',0,0,NULL,NULL),(47,5,'Rufunsa','-15.078131','29.634890',0,0,NULL,NULL),(48,1,'Shibuyunji','-15.424570','27.808064',0,0,NULL,NULL),(49,5,'Lusaka','-15.408867','28.333450',0,0,NULL,NULL),(50,6,'Chama','-11.214196','33.154732',0,0,NULL,NULL),(51,6,'Chinsali','-10.544049','32.064843',0,0,NULL,NULL),(52,6,'Isoka','-10.151943','32.635510',0,0,NULL,NULL),(53,6,'Mafinga','-10.239173','33.315920',0,0,NULL,NULL),(54,6,'Mpika','-11.825579','31.448707',0,0,NULL,NULL),(55,6,'Nakonde','-9.329901','32.753227',0,0,NULL,NULL),(56,6,'Shiwang\'andu','-11.230661','31.742384',0,0,NULL,NULL),(57,7,'Chilubi','-11.1534286','29.8948552',0,0,NULL,NULL),(58,7,'Kaputa','-8.4762768','29.6415851',0,0,NULL,NULL),(59,7,'Kasama','-10.2363082','31.143275',0,0,NULL,NULL),(60,7,'Luwingu','-10.6085541','29.3183597',0,0,NULL,NULL),(61,7,'Mbala','-8.8480727','31.3228791',0,0,NULL,NULL),(62,7,'Mporokoso','-9.371369','30.09005',0,0,NULL,NULL),(63,7,'Mpulungu','-8.7692783','31.0999665',0,0,NULL,NULL),(64,7,'Mungwi','-10.1783646','31.3394879',0,0,NULL,NULL),(65,7,'Nsama','-8.8943783','29.9513269',0,0,NULL,NULL),(66,8,'Chavuma','-13.0836162','22.6792037',0,0,NULL,NULL),(67,8,'Ikelenge','-11.2374247','24.2536066',0,0,NULL,NULL),(68,8,'Kabompo','-13.5951014','24.1840838',0,0,NULL,NULL),(69,8,'Kasempa','-13.8025204','25.1080866',0,0,NULL,NULL),(70,8,'Manyinga','-13.3964558','24.3100834',0,0,NULL,NULL),(71,8,'Mufumbwe','-13.6833117','24.7912452',0,0,NULL,NULL),(72,8,'Mwinilunga','-11.7384907','24.4135768',0,0,NULL,NULL),(73,8,'Zambezi','-13.5486671','23.0780261',0,0,NULL,NULL),(74,8,'Solwezi','-12.1689464','26.3574449',0,0,NULL,NULL),(75,9,'Chikankata','-16.2499789','28.1245782',0,0,NULL,NULL),(76,9,'Gwembe','-16.4968365','27.5772712',0,0,NULL,NULL),(77,9,'Kalomo','-17.0311796','26.4632748',0,0,NULL,NULL),(78,9,'Kazungula','-17.7807326','25.2633509',0,0,NULL,NULL),(79,9,'Monze','-16.2782505','27.438872',0,0,NULL,NULL),(80,9,'Namwala','-15.7537827','26.4339638',0,0,NULL,NULL),(81,9,'Pemba','-16.5224626','27.3495196',0,0,NULL,NULL),(82,9,'Siavonga','-16.5344177','28.6961882',0,0,NULL,NULL),(83,9,'Sinazongwe','-17.2282349','27.4392796',0,0,NULL,NULL),(84,9,'Zimba','-17.3155688','26.1730813',0,0,NULL,NULL),(85,9,'Livingstone','-17.8516495','25.8136647',0,0,NULL,NULL),(86,9,'Choma','-16.8065884','26.9398062',0,0,NULL,NULL),(87,9,'Mazabuka','-15.8598383','27.718548',0,0,NULL,NULL),(88,10,'Kalabo','-14.9929965','22.6765537',0,0,NULL,NULL),(89,10,'Kaoma','-14.8178214','24.7662298',0,0,NULL,NULL),(90,10,'Limulunga','-15.1308547','23.1433868',0,0,NULL,NULL),(91,10,'Luampa','-15.063068','24.4033706',0,0,NULL,NULL),(92,10,'Lukulu','-14.4081161','23.257885',0,0,NULL,NULL),(93,10,'Mitete','-14.1333121','22.8579119',0,0,NULL,NULL),(94,10,'Mulobezi','-16.7806905','25.162382',0,0,NULL,NULL),(95,10,'Mwandi','-17.5177437','24.8150758',0,0,NULL,NULL),(96,10,'Nalolo','-15.5396655','23.1134373',0,0,NULL,NULL),(97,10,'Nkeyema','-14.8509307','25.1825476',0,0,NULL,NULL),(98,10,'Senanga','-16.1161414','23.288226',0,0,NULL,NULL),(99,10,'Sesheke','-17.4747938','24.2784546',0,0,NULL,NULL),(100,10,'Shangombo','-16.3225216','22.0986338',0,0,NULL,NULL),(101,10,'Sikongo','-15.0334481','22.1591901',0,0,NULL,NULL),(102,10,'Sioma','-16.6038901','23.5006356',0,0,NULL,NULL),(103,10,'Mongu','-15.2705632','23.1280444',0,0,NULL,NULL),(104,3,'Kasenengwa','-13.316667','31.916667',0,0,NULL,NULL),(105,3,'Lumezi','-12.525488','33.046017',0,0,NULL,NULL),(106,3,'Msanzala','-14.083333','31.350000',0,0,NULL,NULL),(107,3,'Chipangali','-13.217256','32.764192',0,0,NULL,NULL),(108,3,'Chasefu','-11.921364','33.093417',0,0,NULL,NULL),(109,4,'Chifunabuli','-11.107550','29.667098',0,0,NULL,NULL),(110,6,'Chilinda','-13.0905358','24.1696381',0,0,NULL,NULL),(112,6,'Kanchibiya','-11.3756661','31.0114803',0,0,NULL,NULL),(113,6,'Lavushimanda','-12.3999787','30.8579119',0,0,NULL,NULL),(114,7,'Lunte',NULL,NULL,0,0,NULL,NULL),(115,7,'Lupososhi','-10.5340351','30.0180635',0,0,NULL,NULL),(116,7,'Senga','-9.3730437','31.2241528',0,0,NULL,NULL),(117,8,'Kalumbila','-12.2735897','25.3718008',0,0,NULL,NULL),(118,8,'Mushindamo','-11.8666667','27.1166667',0,0,NULL,NULL);
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lkm_storyofchange`
--

DROP TABLE IF EXISTS `lkm_storyofchange`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lkm_storyofchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` text NOT NULL COMMENT 'Title of the story of change',
  `interviewee_names` text NOT NULL,
  `interviewer_names` text NOT NULL,
  `date_interviewed` date NOT NULL,
  `introduction` text COMMENT 'Introduction of the story: 2-3 sentences summary of the case study or success story',
  `challenge` text COMMENT 'The problem that was being addressed in the story',
  `actions` text COMMENT 'What was done, how, by and with who etc',
  `results` text COMMENT 'what changed and what difference was made',
  `conclusions` text COMMENT 'Factors that seemed to be critical to achieving the outcomes',
  `sequel` text COMMENT 'Summarising what happens next, whether this seems to be the end of the story or whether the programme will continue to track changes',
  `status` int(11) NOT NULL DEFAULT '0',
  `paio_review_status` int(11) DEFAULT '0',
  `paio_comments` text,
  `ikmo_review_status` int(11) DEFAULT '0',
  `ikmo_comments` text,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lkm_storyofchange_1_idx` (`category_id`),
  CONSTRAINT `fk_lkm_storyofchange_1` FOREIGN KEY (`category_id`) REFERENCES `lkm_storyofchange_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange`
--

LOCK TABLES `lkm_storyofchange` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange` DISABLE KEYS */;
INSERT INTO `lkm_storyofchange` VALUES (2,3,'Test','Upendo Chulu','Francis Chulu','2021-01-11',NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,1610388925,1610392208,1,1);
/*!40000 ALTER TABLE `lkm_storyofchange` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lkm_storyofchange_article`
--

DROP TABLE IF EXISTS `lkm_storyofchange_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lkm_storyofchange_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) DEFAULT NULL,
  `article_type` varchar(255) DEFAULT NULL,
  `description` text,
  `file` varchar(255) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange_article`
--

LOCK TABLES `lkm_storyofchange_article` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `lkm_storyofchange_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lkm_storyofchange_category`
--

DROP TABLE IF EXISTS `lkm_storyofchange_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lkm_storyofchange_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT 'Story category name',
  `description` text COMMENT 'Story category description',
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange_category`
--

LOCK TABLES `lkm_storyofchange_category` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange_category` DISABLE KEYS */;
INSERT INTO `lkm_storyofchange_category` VALUES (3,'Livestock farming','',1610361550,1610378652,1,1),(4,'Subsistence farming','Subsistence farming',1610361568,1610361592,1,1);
/*!40000 ALTER TABLE `lkm_storyofchange_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lkm_storyofchange_interview_guide_template_questions`
--

DROP TABLE IF EXISTS `lkm_storyofchange_interview_guide_template_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lkm_storyofchange_interview_guide_template_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(45) NOT NULL,
  `number` varchar(4) NOT NULL,
  `question` text NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange_interview_guide_template_questions`
--

LOCK TABLES `lkm_storyofchange_interview_guide_template_questions` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange_interview_guide_template_questions` DISABLE KEYS */;
INSERT INTO `lkm_storyofchange_interview_guide_template_questions` VALUES (1,'Introduction','1','Please introduce yourself and tell me a bit about yourself?',1609956950,1609956950,1,1),(2,'The Problem','2','What Challenges were you experiencing before the E-SAPP and why?',1609958624,1609958624,1,1),(3,'The Problem','3','Did you do anything to solve the problem before E-SAPP? If yes, what did you do?',1609958658,1609958658,1,1),(4,'The Action','4','What interventions did E-SAPP put in place to resolve the problem?  <b>Probe: Detail them according to the different steps taken</b>.',1609958714,1610358307,1,1),(5,'The Action','5','Did the interventions by E-SAPP resolve the problem? Give a reason for your answer.',1609958980,1609958980,1,1),(6,'The Action','6','In your opinion, do you think this problem was going to be addressed if it was not for the intervention from E-SAPP? Give a reason?',1609958996,1609958996,1,1),(7,'The Action','7','What are the key areas of change that you noticed as a result of the intervention? Give examples. ',1609959016,1609959016,1,1),(8,'The Action','8','What are some of the lessons that you have learnt from the intervention?',1609959038,1609959038,1,1),(9,'Recommendations','9',' In terms of how the E-SAPP could improve its intervention delivery, do you have any recommendations/ suggestions? What do you think needs to be done?',1609959055,1609959055,1,1);
/*!40000 ALTER TABLE `lkm_storyofchange_interview_guide_template_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lkm_storyofchange_media`
--

DROP TABLE IF EXISTS `lkm_storyofchange_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lkm_storyofchange_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) NOT NULL,
  `media_type` text NOT NULL,
  `media_path` varchar(255) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lkm_storyofchange_media_1_idx` (`story_id`),
  CONSTRAINT `fk_lkm_storyofchange_media_1` FOREIGN KEY (`story_id`) REFERENCES `lkm_storyofchange` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange_media`
--

LOCK TABLES `lkm_storyofchange_media` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `lkm_storyofchange_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `market`
--

DROP TABLE IF EXISTS `market`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `market` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_market_1_idx` (`district_id`),
  CONSTRAINT `fk_market_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `market`
--

LOCK TABLES `market` WRITE;
/*!40000 ALTER TABLE `market` DISABLE KEYS */;
INSERT INTO `market` VALUES (1,14,'Chisokone',NULL,1607267413,1607362158,1,1),(2,49,'Soweto',NULL,1607267496,1607362171,1,1),(3,1,'Chisamba test',NULL,1607623358,1607623358,1,1);
/*!40000 ALTER TABLE `market` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `right` text,
  `definition` text,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Manage Users',NULL,1),(2,'View Users',NULL,1),(3,'Manage Roles',NULL,1),(4,'View Roles',NULL,1),(6,'View profile',NULL,1),(7,'View audit trail logs',NULL,1),(8,'Manage provinces',NULL,1),(9,'Manage districts',NULL,1),(10,'Manage camps',NULL,1),(11,'Remove provinces',NULL,1),(12,'Remove districts',NULL,1),(13,'Remove camps',NULL,1),(14,'Manage markets',NULL,1),(15,'Remove markets',NULL,1),(16,'Manage commodity configs',NULL,1),(17,'Remove commodity config',NULL,1),(18,'Collect commodity prices',NULL,1),(19,'View commodity prices',NULL,1),(20,'Remove commodity price',NULL,1),(21,'Manage interview guide template questions',NULL,1),(22,'View interview guide template',NULL,1),(23,'Remove interview guide template question',NULL,1),(24,'Manage story of change categories',NULL,1),(25,'Submit story of change',NULL,1);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `province` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'Central',0,1607362055,NULL,1),(2,'Copperbelt',0,0,NULL,NULL),(3,'Eastern',0,0,NULL,NULL),(4,'Luapula',0,0,NULL,NULL),(5,'Lusaka',0,0,NULL,NULL),(6,'Muchinga',0,0,NULL,NULL),(7,'Northern',0,0,NULL,NULL),(8,'North-Western',0,0,NULL,NULL),(9,'Southern',0,0,NULL,NULL),(10,'Western',0,0,NULL,NULL);
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `right_to_role`
--

DROP TABLE IF EXISTS `right_to_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `right_to_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `right` text,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_right_to_role_1_idx` (`role`),
  CONSTRAINT `fk_right_to_role_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=342 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `right_to_role`
--

LOCK TABLES `right_to_role` WRITE;
/*!40000 ALTER TABLE `right_to_role` DISABLE KEYS */;
INSERT INTO `right_to_role` VALUES (53,3,'View profile',1),(320,1,'Manage Users',1),(321,1,'View Users',1),(322,1,'Manage Roles',1),(323,1,'View Roles',1),(324,1,'View profile',1),(325,1,'View audit trail logs',1),(326,1,'Manage provinces',1),(327,1,'Manage districts',1),(328,1,'Manage camps',1),(329,1,'Remove provinces',1),(330,1,'Remove districts',1),(331,1,'Remove camps',1),(332,1,'Manage markets',1),(333,1,'Remove markets',1),(334,1,'Manage commodity configs',1),(335,1,'Remove commodity config',1),(336,1,'Collect commodity prices',1),(337,1,'View commodity prices',1),(338,1,'Remove commodity price',1),(339,1,'View interview guide template',1),(340,1,'Manage story of change categories',1),(341,1,'Submit story of change',1);
/*!40000 ALTER TABLE `right_to_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` text NOT NULL,
  `active` int(11) DEFAULT '1',
  `created_at` int(11) unsigned DEFAULT NULL,
  `updated_at` int(11) unsigned DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator',1,1222,1603902498,1,1),(3,'User',1,1603902583,1603902583,1,1);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `other_name` varchar(255) DEFAULT '',
  `title` varchar(10) DEFAULT '',
  `sex` varchar(7) DEFAULT 'Male',
  `phone` varchar(45) DEFAULT NULL,
  `nrc` varchar(45) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `auth_key` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `password_reset_token` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `camp_id` int(11) unsigned DEFAULT NULL,
  `district_id` int(11) unsigned DEFAULT NULL,
  `province_id` int(11) unsigned DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `type_of_user` varchar(45) DEFAULT 'Other user' COMMENT 'Type of user different from role. This is there to ammodate users that belong to camps, districts or province\nAvailable types {Camp user, District user, Provincial user, Other user}',
  PRIMARY KEY (`id`),
  KEY `fk_users_1_idx` (`role`),
  KEY `fk_users_2_idx` (`camp_id`),
  KEY `fk_users_3_idx` (`district_id`),
  KEY `fk_users_4_idx` (`province_id`),
  CONSTRAINT `fk_users_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Francis','Chulu','','Mr.','Male','+260978981234','123454/21/23','chulu1francis@gmail.com','chulu1francis@gmail.com',1,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','Rqt3yudYSLJUk85kj3bj89ANgpWb4uWK_1607442830',NULL,0,0,0,1,NULL,11,1609866781,'Other user'),(5,3,'Chulu','Francis','','Mr.','Male','+260978981345','123454/21/23','francis.chulu@unza.zm','francis.chulu@unza.zm',1,'03sbsXnUdVo17nV9oDB2yJcVtXHq-2gV','$2y$13$t7zuXtfdVp..FAlCP9DBmuKECYHA/qCJesRgKJdfozz3bfI2jD7H2',NULL,NULL,NULL,NULL,NULL,1,1,1604659275,1604660233,'Other user'),(6,1,'test','Test','','','Male','','','francis.chulu1@unza.zm','francis.chulu1@unza.zm',2,'TgBVwvS0cj3qhbf8tJM3Jb1pug93DoNp','$2y$13$wM2FG2rPQCM2RspAq.5NXuQtjFPxTYuIohr/vCcAC.BVX7wKsNEtG','LZ-pePN17FJB7Mg1CtyYyRsNH5tohaz6_1607174006',NULL,NULL,NULL,NULL,1,1,1607174006,1607174024,'Other user'),(9,3,'Test','Test','','Mr.','Female','','','test@unza.zm','test@unza.zm',1,'p6eg0fiUkzYOzeYXMNt31jccrvHzTB10','$2y$13$kpFWGgTVnjfoGSMZ54med..suQHtzTzUmXlBYomGyW30basdsPF4W','PF4j04-lRuOClA4gXY-oTX_95V6Ap-2-_1607181915',NULL,0,0,0,1,1,1607181915,1607186786,'Other user'),(10,3,'test','Test','','Mr.','Male','','','test1@unza.zm','test1@unza.zm',1,'wWyR-07GPlg_INEsypTCLl_glTSQs8U_','$2y$13$02w26EmnhfQ6A5lyP4kZLOSR5UjFLawodYLy..flhp93RlzHzgK.G','VlfAXnPz_XY_5s6E7x2Qi_SpPhIEl9I0_1607181970',NULL,NULL,49,5,1,1,1607181970,1607242403,'District user'),(11,3,'test','Test 3','','Mr.','Male','','','test2@unza.zm','test2@unza.zm',1,'WNrXn4WU8ntxHL97Z1P4-ev37ye1CHZt','$2y$13$fc09Zw7fhzXnA/diALSQ8.l5lj0YxZ08A0v8Y63ldbGgKA0tR7Ldu','pFOgJWyUKdULYoTNxXctPhB4CEv8LpzB_1607182013',NULL,NULL,NULL,1,1,1,1607182013,1607362711,'Provincial user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-11 21:12:32
