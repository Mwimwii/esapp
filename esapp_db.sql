-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: e_sapp
-- ------------------------------------------------------
-- Server version	5.7.33

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
) ENGINE=InnoDB AUTO_INCREMENT=1035 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_trail`
--

LOCK TABLES `audit_trail` WRITE;
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
INSERT INTO `audit_trail` VALUES (58,1,'Viewed audit trail logs',1607168395,'155.0.76.2','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(59,1,'Viewed audit trail logs',1607168415,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(60,1,'Viewed audit trail logs',1607168543,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(61,1,'Viewed audit trail logs',1607168553,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(62,1,'Viewed audit trail logs',1607168580,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(63,1,'Viewed audit trail logs',1607168719,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(64,1,'Viewed audit trail logs',1607168791,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(65,1,'Viewed audit trail logs',1607168812,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(66,1,'Viewed audit trail logs',1607168819,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(67,1,'Viewed audit trail logs',1607168825,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(68,1,'Viewed audit trail logs',1607168834,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(69,1,'Viewed audit trail logs',1607168843,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(70,1,'Viewed audit trail logs',1607168852,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(71,1,'Viewed audit trail logs',1607168885,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(72,1,'Viewed audit trail logs',1607168898,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(73,1,'Viewed audit trail logs',1607168908,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(74,1,'Viewed audit trail logs',1607168957,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(75,1,'Viewed audit trail logs',1607169080,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(76,1,'Viewed audit trail logs',1607169095,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(77,1,'Viewed audit trail logs',1607169261,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(78,1,'Viewed audit trail logs',1607169277,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(79,1,'Viewed audit trail logs',1607169297,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(80,1,'Viewed audit trail logs',1607169312,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(81,1,'Viewed audit trail logs',1607169431,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(82,1,'Viewed audit trail logs',1607169443,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(83,1,'Viewed audit trail logs',1607169458,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(84,1,'Viewed audit trail logs',1607169473,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(85,1,'Viewed audit trail logs',1607169486,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(86,1,'Viewed audit trail logs',1607169500,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(87,1,'Viewed audit trail logs',1607169510,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(88,1,'Viewed audit trail logs',1607169576,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(89,1,'Viewed audit trail logs',1607169586,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(90,1,'Viewed audit trail logs',1607169640,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(91,1,'Viewed audit trail logs',1607169794,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(92,1,'Viewed audit trail logs',1607169819,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(93,1,'Viewed audit trail logs',1607169833,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(94,1,'Viewed audit trail logs',1607170072,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(95,1,'Viewed audit trail logs',1607170082,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(96,1,'Viewed audit trail logs',1607170134,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(97,1,'Viewed audit trail logs',1607170138,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(98,1,'Viewed audit trail logs',1607170193,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(99,1,'Viewed audit trail logs',1607170201,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(100,1,'Viewed audit trail logs',1607170207,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(101,1,'Viewed audit trail logs',1607170219,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(102,1,'Viewed audit trail logs',1607170226,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(103,1,'Viewed audit trail logs',1607170235,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(104,1,'Viewed audit trail logs',1607170267,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(105,1,'Viewed audit trail logs',1607170296,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(106,1,'Viewed audit trail logs',1607170312,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(107,1,'Blocked user account with email:test@unza.zm',1607186598,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(108,1,'Viewed audit trail logs',1607186600,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(109,1,'Blocked user account with email:test@unza.zm',1607186622,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(110,1,'Viewed audit trail logs',1607186624,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(111,1,'Viewed audit trail logs',1607186682,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(112,1,'Blocked user account with email:test@unza.zm',1607186690,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(113,1,'Viewed audit trail logs',1607186692,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(114,1,'Blocked user account with email:test@unza.zm',1607186703,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(115,1,'Viewed audit trail logs',1607186704,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(116,1,'Blocked user account with email:test@unza.zm',1607186731,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(117,1,'Viewed audit trail logs',1607186733,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(118,1,'Activate user account with email:test@unza.zm',1607186786,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(119,1,'Viewed audit trail logs',1607186787,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(120,1,'Update role Administrator',1607186989,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(121,1,'Viewed audit trail logs',1607186991,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(122,1,'Update role Administrator',1607187108,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(123,1,'Update profile details ',1607187362,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(124,1,'Viewed audit trail logs',1607187365,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(125,1,'Updated user details with email: test1@unza.zm',1607242404,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(126,1,'Viewed audit trail logs',1607242508,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(127,1,'Update role Administrator',1607245883,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(128,1,'Viewed audit trail logs',1607247209,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(129,1,'updated province name from Central to Central',1607247603,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(130,1,'Viewed audit trail logs',1607247606,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(131,1,'Viewed audit trail logs',1607247641,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(132,1,'Viewed audit trail logs',1607247648,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(133,1,'Viewed audit trail logs',1607247676,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(134,1,'updated province name from Central to Central1',1607247693,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(135,1,'Viewed audit trail logs',1607247695,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(136,1,'updated province name from Central1 to Central',1607247704,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(137,1,'Removed province Test from the system.',1607249537,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(138,1,'Update role Administrator',1607251235,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(139,1,'Udated district name from Chisamba to Chisamba1',1607251926,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(140,1,'Udated district name from Chisamba1 to Chisamba',1607251931,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(141,1,'Removed district test from the system.',1607252512,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(142,1,'Removed district test from the system.',1607252524,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(143,1,'Updated district name from test to Masaiti',1607252777,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(144,1,'Removed district test from the system.',1607252791,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(145,1,'Updated camp name from Camp 1 to Camp tes',1607253365,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(146,1,'Updated camp name from Camp tes to Camp test',1607253369,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(147,1,'Viewed audit trail logs',1607253762,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(148,1,'Viewed audit trail logs',1607253822,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(149,1,'Viewed audit trail logs',1607253858,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(150,1,'Viewed audit trail logs',1607253880,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(151,1,'Viewed audit trail logs',1607259589,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(152,1,'Viewed audit trail logs',1607259595,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(153,1,'Viewed audit trail logs',1607259607,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(154,1,'Viewed audit trail logs',1607259612,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(155,1,'Viewed audit trail logs',1607259625,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(156,1,'Viewed audit trail logs',1607259632,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(157,1,'Viewed audit trail logs',1607259699,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(158,1,'Viewed audit trail logs',1607259706,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(159,1,'Viewed audit trail logs',1607259932,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(160,1,'Viewed audit trail logs',1607260015,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(161,1,'Viewed audit trail logs',1607260051,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(162,1,'Viewed audit trail logs',1607260061,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(163,1,'Viewed audit trail logs',1607260109,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(164,1,'Viewed audit trail logs',1607260118,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(165,1,'Viewed audit trail logs',1607260130,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(166,1,'Viewed audit trail logs',1607260137,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(167,1,'Viewed audit trail logs',1607260408,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(168,1,'Viewed audit trail logs',1607260413,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(169,1,'Viewed audit trail logs',1607260423,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(170,1,'Viewed audit trail logs',1607260432,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(171,1,'Viewed audit trail logs',1607260449,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(172,1,'Viewed audit trail logs',1607260452,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(173,1,'Viewed audit trail logs',1607260458,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(174,1,'Viewed audit trail logs',1607260466,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(175,1,'Viewed audit trail logs',1607260473,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(176,1,'Viewed audit trail logs',1607260539,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(177,1,'Viewed audit trail logs',1607260544,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(178,1,'Viewed audit trail logs',1607260660,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(179,1,'Viewed audit trail logs',1607260663,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(180,1,'Removed district Camp test from the system.',1607262303,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(181,1,'Update role Administrator',1607262806,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(182,1,'Added camp Camp 1',1607263313,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(183,1,'Update role Administrator',1607264609,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(184,1,'Added market Chisokone',1607267413,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(185,1,'Added market Soweto',1607267496,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(186,1,'Updated market name from Soweto to Chisokone',1607267547,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(187,1,'Updated market name from Chisokone to Chisokone1',1607267577,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(188,1,'Updated market name from Chisokone1 to Chisokone',1607267581,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(189,1,'updated province name from Central to Central1',1607362050,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(190,1,'updated province name from Central1 to Central',1607362055,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(191,1,'Added province Test',1607362059,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(192,1,'Removed province Test from the system.',1607362063,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(193,1,'Updated district name from Masaiti to Masaiti1',1607362083,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(194,1,'Updated district name from Masaiti1 to Masaiti',1607362090,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(195,1,'Added district Test',1607362100,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(196,1,'Removed district Test from the system.',1607362111,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(197,1,'Updated camp name from Camp 1 to Camp one',1607362120,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(198,1,'Added camp Camp 1',1607362135,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(199,1,'Removed camp Camp 1 from the system.',1607362141,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(200,1,'Updated market name from Soweto to Soweto 1',1607362167,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(201,1,'Updated market name from Soweto 1 to Soweto',1607362171,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(202,1,'Added market Tuesday',1607362187,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(203,1,'Removed market Tuesday from the system.',1607362191,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(204,1,'Updated profile details ',1607362247,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(205,1,'Changed account password',1607362298,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(206,1,'Update role Administrator',1607362421,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(207,1,'Update role Administrator',1607362425,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(208,1,'Created role Test',1607362485,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(209,1,'Created role Test',1607362532,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(210,1,'Removed role Test from the system',1607362535,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(211,1,'Created role Test',1607362548,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(212,1,'Removed role Test from the system',1607362552,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(213,1,'Updated user details with email: chulu1francis@gmail.com',1607362692,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(214,1,'Blocked user account with email chulu1francis@gmail.com',1607362700,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(215,1,'Activated user account with email:test2@unza.zm',1607362711,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(216,1,'Activated user account with email:chulu1francis@gmail.com',1607362716,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(217,1,'Deleted user account with email testtest@unza.zm',1607362906,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(218,1,'Created user with email: testtest1@unza.zm',1607362942,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(219,1,'Deleted user account with email testtest1@unza.zm',1607362955,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(220,1,'Update role Administrator',1607365503,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(221,1,'Update role Administrator',1607417426,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(222,1,'Added commodity category Test',1607417546,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(223,1,'Removed commodity category Test from the system.',1607417550,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(224,1,'Added commodity category Test',1607417556,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(225,1,'Updated commodity category name from Test to Farming inputs',1607417593,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(226,1,'Updated commodity category description to::Description',1607417619,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(227,1,'Updated commodity category name from Farming inputs to Farming input',1607417624,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(228,1,'Added commodity category Farm produce',1607417638,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(229,1,'Updated commodity category description to::Description',1607417646,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(230,1,'Updated commodity category name from Farming input to Farming inputs',1607417654,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(231,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy',1607417765,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(232,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',1607417788,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(233,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ',1607417811,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(234,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',1607418245,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(235,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',1607418984,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(236,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ',1607419166,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(237,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',1607419282,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(238,1,'Updated commodity category description to::The resources that are used in farm production, such as chemicals, equipment, feed, seed, and energy ',1607419333,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(239,1,'Updated commodity category description to::Farm outputs such as maize, groundnuts\r\n',1607423557,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(240,1,'Added commodity type Maize',1607446739,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(241,1,'Added commodity type Soya beans',1607447814,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(242,1,'Added commodity type Groundnuts',1607447827,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(243,1,'Updated commodity type name from Groundnuts to Maize',1607447843,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(244,1,'Added commodity type Rice',1607447871,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(245,1,'Added commodity type Mealie meal',1607447890,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(246,1,'Added commodity type Roller meal',1607447902,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(247,1,'Added commodity category Farm output by products',1607447921,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(248,1,'Updated commodity category name from Farm produce to Farm outs',1607447929,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(249,1,'Updated commodity category name from Farm outs to Farm outputs',1607447942,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(250,1,'Updated commodity type category to::4',1607447952,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(251,1,'Updated commodity type category to::4',1607447956,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(252,1,'Added commodity type Maize Seed',1607447971,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(253,1,'Added commodity type Groundnut seed',1607447992,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(254,1,'Added commodity type Rice seed',1607448004,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(255,1,'Added commodity type D-Compound',1607448021,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(256,1,'Added commodity type Urea',1607448041,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(257,1,'Added commodity type Test',1607448169,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(258,1,'Removed commodity type Test from the system.',1607448184,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(259,1,'Updated commodity category name from Farm output by products to Farm output by-products',1607585616,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(260,1,'Updated commodity price level description to::Farm gate',1607588412,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(261,1,'Added commodity price level Test level',1607588513,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(262,1,'Removed Commodity price level Test level from the system.',1607588618,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(263,1,'Update role Administrator',1607589736,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(264,1,'Updated commodity price details',1607598826,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(265,1,'Updated commodity price details',1607598831,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(266,1,'Updated commodity price details',1607600021,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(267,1,'Updated commodity price details',1607600044,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(268,1,'Update role Administrator',1607600190,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(269,1,'Updated commodity price details',1607600728,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(270,1,'Updated commodity price details',1607600734,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(271,1,'Updated commodity price details',1607601306,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(272,1,'Updated commodity price details',1607601320,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(273,1,'Updated commodity price details',1607601338,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(274,1,'Updated commodity price details',1607601363,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(275,1,'Updated commodity price details',1607601519,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(276,1,'Updated commodity price details',1607601536,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(277,1,'Updated commodity price details',1607601552,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(278,1,'Updated commodity price details',1607601558,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(279,1,'Updated commodity price details',1607601566,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(280,1,'Updated commodity price details',1607601575,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(281,1,'Updated commodity price details',1607601580,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(282,1,'Updated commodity price details',1607601586,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(283,1,'Updated commodity price details',1607601594,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(284,1,'Updated commodity price details',1607601599,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(285,1,'Updated commodity price details',1607601601,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(286,1,'Updated commodity price details',1607601607,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(287,1,'Updated commodity price details',1607601611,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(288,1,'Updated commodity price details',1607601627,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(289,1,'Updated commodity price details',1607601630,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(290,1,'Updated commodity price details',1607601662,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(291,1,'Updated commodity price details',1607601744,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(292,1,'Updated commodity price details',1607601759,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(293,1,'Updated commodity price details',1607601764,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(294,1,'Updated commodity price details',1607601769,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(295,1,'Updated commodity price details',1607601859,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(296,1,'Updated commodity price details',1607601861,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(297,1,'Added market Chisamba test',1607623358,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(298,1,'Removed commodity price from the system.',1607627535,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0'),(299,1,'Updated user details with email: chulu1francis@gmail.com',1609866047,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(300,1,'Updated user details with email: chulu1francis@gmail.com',1609866079,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(301,1,'Updated user details with email: chulu1francis@gmail.com',1609866721,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(302,1,'Updated user details with email: chulu1francis@gmail.com',1609866781,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(303,1,'Update role Administrator',1609951977,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(304,1,'Added interview guide question Please introduce yourself and tell me a bit about yourself?',1609956950,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(305,1,'Added interview guide question What Challenges were you experiencing before the E-SAPP and why?',1609958624,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(306,1,'Added interview guide question Did you do anything to solve the problem before E-SAPP? If yes, what did you do?',1609958658,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(307,1,'Added interview guide question What interventions did E-SAPP put in place to resolve the problem?  Probe: Detail them according to the different steps taken.',1609958714,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(308,1,'Added interview guide question Did the interventions by E-SAPP resolve the problem? Give a reason for your answer.',1609958980,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(309,1,'Added interview guide question In your opinion, do you think this problem was going to be addressed if it was not for the intervention from E-SAPP? Give a reason?',1609958996,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(310,1,'Added interview guide question What are the key areas of change that you noticed as a result of the intervention? Give examples. ',1609959016,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(311,1,'Added interview guide question What are some of the lessons that you have learnt from the intervention?',1609959038,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(312,1,'Added interview guide question  In terms of how the E-SAPP could improve its intervention delivery, do you have any recommendations/ suggestions? What do you think needs to be done?',1609959055,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(313,1,'Update role Administrator',1610036540,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(314,1,'Added interview guide question::\'Test\'',1610038847,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(315,1,'Removed interview guide question: \'Test\' from the system.',1610038851,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(316,1,'Downloaded interview question guide template',1610041729,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(317,1,'Downloaded interview question guide template',1610349761,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(318,1,'Downloaded interview question guide template',1610351246,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(319,1,'Downloaded interview question guide template',1610351289,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(320,1,'Downloaded interview question guide template',1610351300,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(321,1,'Downloaded interview question guide template',1610351391,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(322,1,'Downloaded interview question guide template',1610351424,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(323,1,'Downloaded interview question guide template',1610351439,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(324,1,'Downloaded interview question guide template',1610351454,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(325,1,'Downloaded interview question guide template',1610351466,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(326,1,'Downloaded interview question guide template',1610351493,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(327,1,'Downloaded interview question guide template',1610351524,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(328,1,'Downloaded interview question guide template',1610351550,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(329,1,'Downloaded interview question guide template',1610351571,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(330,1,'Downloaded interview question guide template',1610351602,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(331,1,'Downloaded interview question guide template',1610351635,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(332,1,'Downloaded interview question guide template',1610351667,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(333,1,'Downloaded interview question guide template',1610351677,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(334,1,'Downloaded interview question guide template',1610351686,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(335,1,'Downloaded interview question guide template',1610352092,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(336,1,'Downloaded interview question guide template',1610352144,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(337,1,'Downloaded interview question guide template',1610352161,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(338,1,'Downloaded interview question guide template',1610352209,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(339,1,'Downloaded interview question guide template',1610352328,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(340,1,'Downloaded interview question guide template',1610352358,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(341,1,'Downloaded interview question guide template',1610352513,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(342,1,'Downloaded interview question guide template',1610352619,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(343,1,'Downloaded interview question guide template',1610352636,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(344,1,'Downloaded interview question guide template',1610352660,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(345,1,'Downloaded interview question guide template',1610352688,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(346,1,'Downloaded interview question guide template',1610352761,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(347,1,'Downloaded interview question guide template',1610352792,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(348,1,'Downloaded interview question guide template',1610352802,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(349,1,'Downloaded interview question guide template',1610352830,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(350,1,'Downloaded interview question guide template',1610352856,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(351,1,'Downloaded interview question guide template',1610352951,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(352,1,'Downloaded interview question guide template',1610352968,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(353,1,'Downloaded interview question guide template',1610353036,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(354,1,'Downloaded interview question guide template',1610353049,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(355,1,'Downloaded interview question guide template',1610353063,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(356,1,'Downloaded interview question guide template',1610353074,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(357,1,'Downloaded interview question guide template',1610353089,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(358,1,'Downloaded interview question guide template',1610353159,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(359,1,'Downloaded interview question guide template',1610353181,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(360,1,'Downloaded interview question guide template',1610353190,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(361,1,'Downloaded interview question guide template',1610353200,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(362,1,'Downloaded interview question guide template',1610353249,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(363,1,'Downloaded interview question guide template',1610353265,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(364,1,'Downloaded interview question guide template',1610353289,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(365,1,'Downloaded interview question guide template',1610353311,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(366,1,'Downloaded interview question guide template',1610353325,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(367,1,'Downloaded interview question guide template',1610353357,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(368,1,'Downloaded interview question guide template',1610353373,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(369,1,'Downloaded interview question guide template',1610353405,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(370,1,'Downloaded interview question guide template',1610353508,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(371,1,'Downloaded interview question guide template',1610353519,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(372,1,'Downloaded interview question guide template',1610353562,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(373,1,'Downloaded interview question guide template',1610353582,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(374,1,'Downloaded interview question guide template',1610353624,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(375,1,'Downloaded interview question guide template',1610353654,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(376,1,'Downloaded interview question guide template',1610353667,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(377,1,'Downloaded interview question guide template',1610353677,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(378,1,'Downloaded interview question guide template',1610353690,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(379,1,'Downloaded interview question guide template',1610353759,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(380,1,'Downloaded interview question guide template',1610353783,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(381,1,'Downloaded interview question guide template',1610353889,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(382,1,'Downloaded interview question guide template',1610353905,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(383,1,'Downloaded interview question guide template',1610353981,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(384,1,'Downloaded interview question guide template',1610354052,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(385,1,'Downloaded interview question guide template',1610354152,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(386,1,'Downloaded interview question guide template',1610354174,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(387,1,'Downloaded interview question guide template',1610354278,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(388,1,'Downloaded interview question guide template',1610354293,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(389,1,'Downloaded interview question guide template',1610354331,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(390,1,'Downloaded interview question guide template',1610354370,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(391,1,'Downloaded interview question guide template',1610354464,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(392,1,'Downloaded interview question guide template',1610354478,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(393,1,'Downloaded interview question guide template',1610354515,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(394,1,'Downloaded interview question guide template',1610354578,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(395,1,'Downloaded interview question guide template',1610354588,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(396,1,'Downloaded interview question guide template',1610354602,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(397,1,'Downloaded interview question guide template',1610354651,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(398,1,'Downloaded interview question guide template',1610354806,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(399,1,'Downloaded interview question guide template',1610354992,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(400,1,'Downloaded interview question guide template',1610355053,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(401,1,'Downloaded interview question guide template',1610355073,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(402,1,'Downloaded interview question guide template',1610355099,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(403,1,'Downloaded interview question guide template',1610355112,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(404,1,'Downloaded interview question guide template',1610355158,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(405,1,'Downloaded interview question guide template',1610355177,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(406,1,'Downloaded interview question guide template',1610355186,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(407,1,'Downloaded interview question guide template',1610355255,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(408,1,'Downloaded interview question guide template',1610355281,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(409,1,'Downloaded interview question guide template',1610355346,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(410,1,'Downloaded interview question guide template',1610355461,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(411,1,'Downloaded interview question guide template',1610355478,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(412,1,'Downloaded interview question guide template',1610355532,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(413,1,'Downloaded interview question guide template',1610355544,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(414,1,'Downloaded interview question guide template',1610355564,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(415,1,'Downloaded interview question guide template',1610355656,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(416,1,'Downloaded interview question guide template',1610355676,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(417,1,'Downloaded interview question guide template',1610355693,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(418,1,'Downloaded interview question guide template',1610355771,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(419,1,'Downloaded interview question guide template',1610355819,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(420,1,'Downloaded interview question guide template',1610355864,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(421,1,'Downloaded interview question guide template',1610355885,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(422,1,'Downloaded interview question guide template',1610355925,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(423,1,'Downloaded interview question guide template',1610355936,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(424,1,'Downloaded interview question guide template',1610355961,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(425,1,'Downloaded interview question guide template',1610355976,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(426,1,'Downloaded interview question guide template',1610356024,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(427,1,'Downloaded interview question guide template',1610356038,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(428,1,'Downloaded interview question guide template',1610356065,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(429,1,'Downloaded interview question guide template',1610356085,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(430,1,'Downloaded interview question guide template',1610356095,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(431,1,'Downloaded interview question guide template',1610356104,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(432,1,'Downloaded interview question guide template',1610356136,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(433,1,'Downloaded interview question guide template',1610356284,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(434,1,'Downloaded interview question guide template',1610356325,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(435,1,'Downloaded interview question guide template',1610356356,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(436,1,'Downloaded interview question guide template',1610356388,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(437,1,'Downloaded interview question guide template',1610356405,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(438,1,'Downloaded interview question guide template',1610356420,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(439,1,'Downloaded interview question guide template',1610356434,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(440,1,'Downloaded interview question guide template',1610356442,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(441,1,'Downloaded interview question guide template',1610356468,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(442,1,'Downloaded interview question guide template',1610356477,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(443,1,'Downloaded interview question guide template',1610356509,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(444,1,'Downloaded interview question guide template',1610356546,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(445,1,'Downloaded interview question guide template',1610356560,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(446,1,'Downloaded interview question guide template',1610356617,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(447,1,'Downloaded interview question guide template',1610356664,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(448,1,'Downloaded interview question guide template',1610356673,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(449,1,'Downloaded interview question guide template',1610356682,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(450,1,'Downloaded interview question guide template',1610356692,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(451,1,'Downloaded interview question guide template',1610356717,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(452,1,'Downloaded interview question guide template',1610356734,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(453,1,'Downloaded interview question guide template',1610356745,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(454,1,'Downloaded interview question guide template',1610356778,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(455,1,'Downloaded interview question guide template',1610356848,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(456,1,'Downloaded interview question guide template',1610356921,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(457,1,'Downloaded interview question guide template',1610356939,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(458,1,'Downloaded interview question guide template',1610357001,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(459,1,'Downloaded interview question guide template',1610357013,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(460,1,'Downloaded interview question guide template',1610357058,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(461,1,'Downloaded interview question guide template',1610357107,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(462,1,'Downloaded interview question guide template',1610357240,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(463,1,'Downloaded interview question guide template',1610357277,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(464,1,'Downloaded interview question guide template',1610357293,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(465,1,'Downloaded interview question guide template',1610357316,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(466,1,'Downloaded interview question guide template',1610357325,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(467,1,'Downloaded interview question guide template',1610357339,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(468,1,'Downloaded interview question guide template',1610357352,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(469,1,'Downloaded Story of change interview guide template',1610357432,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(470,1,'Downloaded Story of change interview guide template',1610357961,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(471,1,'Downloaded Story of change interview guide template',1610358023,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(472,1,'Downloaded Story of change interview guide template',1610358035,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(473,1,'Downloaded Story of change interview guide template',1610358069,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(474,1,'Downloaded Story of change interview guide template',1610358187,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(475,1,'Downloaded Story of change interview guide template',1610358228,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(476,1,'Downloaded Story of change interview guide template',1610358245,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(477,1,'Updated interview guide question from:\' What interventions did E-SAPP put in place to resolve the problem?  Probe: Detail them according to the different steps taken. \' to \'What interventions did E-SAPP put in place to resolve the problem?  <b>Probe: Detail them according to the different steps taken</b>.\'',1610358307,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(478,1,'Downloaded Story of change interview guide template',1610358424,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(479,1,'Downloaded Story of change interview guide template',1610358440,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(480,1,'Downloaded Story of change interview guide template',1610358513,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(481,1,'Downloaded Story of change interview guide template',1610358543,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(482,1,'Downloaded Story of change interview guide template',1610358579,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(483,1,'Downloaded Story of change interview guide template',1610358665,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(484,1,'Downloaded Story of change interview guide template',1610358722,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(485,1,'Downloaded Story of change interview guide template',1610358770,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(486,1,'Update role Administrator',1610358885,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(487,1,'Update role Administrator',1610359557,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(488,1,'Downloaded Story of change interview guide template',1610359924,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(489,1,'Update role Administrator',1610360300,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(490,1,'Added story of change category: Test',1610361294,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(491,1,'Removed story of change category: Test from the system.',1610361447,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(492,1,'Added story of change category: Test',1610361454,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(493,1,'Updated story of change category description to::Description',1610361478,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(494,1,'Added story of change category: Livestock ',1610361550,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(495,1,'Added story of change category: Subsistence farming',1610361568,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(496,1,'Updated story of change category description to::Subsistence farming',1610361592,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(497,1,'Updated story of change category name from Livestock  to Livestock farming',1610378652,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(498,1,'Removed story of change category: Test from the system.',1610378656,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(499,1,'Update role Administrator',1610381215,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(500,1,'Added story of change: Test',1610388688,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(501,1,'Removed story of change: Test from the system.',1610388904,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(502,1,'Added story of change: Test',1610388925,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(503,1,'Updated story of change: Test',1610392208,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(504,1,'Updated story of change: Test',1610436102,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(505,1,'Updated story of change: Test',1610436361,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(506,1,'Updated introduction for story of change: Test',1610441039,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(507,1,'Updated introduction for story of change: Test',1610441047,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(508,1,'Updated introduction for story of change: Test',1610441334,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(509,1,'Updated challenges for story of change: Test',1610441436,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(510,1,'Updated challenges for story of change: Test',1610441593,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(511,1,'Updated actions for story of change: Test',1610441858,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(512,1,'Updated actions for story of change: Test',1610441864,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(513,1,'Updated results for story of change: Test',1610445931,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(514,1,'Updated results for story of change: Test',1610445938,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(515,1,'Updated results for story of change: Test',1610445983,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(516,1,'Updated introduction for story of change: Test',1610446060,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(517,1,'Updated actions for story of change: Test',1610446106,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(518,1,'Updated results for story of change: Test',1610446183,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(519,1,'Updated conclusions for story of change: Test',1610446680,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(520,1,'Updated sequel for story of change: Test',1610446813,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(521,1,'Updated sequel for story of change: Test',1610446871,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(522,1,'Updated conclusions for story of change: Test',1610446875,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(523,1,'Updated results for story of change: Test',1610446878,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(524,1,'Updated actions for story of change: Test',1610446883,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(525,1,'Updated challenges for story of change: Test',1610446888,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(526,1,'Updated introduction for story of change: Test',1610446892,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(527,1,'Updated story of change: Test',1610446894,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(528,1,'Updated introduction for story of change: Test',1610447031,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(529,1,'Updated sequel for story of change: Test',1610450365,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(530,1,'Updated introduction for story of change: Test',1610450403,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(531,1,'Submitted story of change: \'Test\' for review',1610451229,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(532,1,'Submitted story of change: \'Test\' for review',1610451428,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(533,1,'Updated challenges for story of change: Test',1610451498,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(534,1,'Submitted story of change: \'Test\' for review',1610451731,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(535,1,'Updated sequel for story of change: Test',1610451779,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(536,1,'Submitted story of change: \'Test\' for review',1610451849,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(537,1,'Update role User',1610458402,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(538,1,'Updated user details with email: test2@unza.zm',1610458485,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(539,1,'Updated user details with email: test1@unza.zm',1610458500,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(540,1,'Update role Administrator',1610458939,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(541,1,'Updated story of change: \'Test\'s status to \'Accepted\'',1610467984,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(542,1,'Updated story of change: \'Test\'s status to \'Send back for more information\'',1610468175,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(543,1,'Submitted story of change: \'Test\' for review',1610468472,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(544,1,'Updated story of change: \'Test\'s status to \'Send back for more information\'',1610468617,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(545,1,'Updated introduction for story of change: Test',1610468675,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(546,1,'Submitted story of change: \'Test\' for review',1610468679,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(547,1,'Updated story of change: \'Test\'s status to \'Accepted\'',1610468706,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(548,10,'Added story of change: From subsistence to commercial farming-Case of Mr. Chulu',1610472852,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(549,10,'Updated introduction for story of change: From subsistence to commercial farming-Case of Mr. Chulu',1610472885,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(550,10,'Updated challenges for story of change: From subsistence to commercial farming-Case of Mr. Chulu',1610472891,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(551,10,'Updated actions for story of change: From subsistence to commercial farming-Case of Mr. Chulu',1610472895,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(552,10,'Updated results for story of change: From subsistence to commercial farming-Case of Mr. Chulu',1610472902,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(553,10,'Updated conclusions for story of change: From subsistence to commercial farming-Case of Mr. Chulu',1610472907,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(554,10,'Updated sequel for story of change: From subsistence to commercial farming-Case of Mr. Chulu',1610472914,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(555,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\' for review',1610472925,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(556,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\' for review',1610472976,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(557,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\' for review',1610473231,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(558,1,'Updated story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\'s status to \'Send back for more information\'',1610473802,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(559,1,'Updated story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\'s status to \'Send back for more information\'',1610473849,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(560,1,'Updated story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\'s status to \'Send back for more information\'',1610473942,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(561,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\' for review',1610474020,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(562,1,'Updated story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\'s status to \'Send back for more information\'',1610474100,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(563,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\' for review',1610474213,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(564,1,'Update role Administrator',1610474421,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(565,1,'Updated story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\'s status to \'Accepted\'',1610475802,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(566,1,'Update role Administrator',1610531749,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(567,1,'Update role Administrator',1610537883,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(568,1,'Update role Administrator',1610724716,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(569,1,'Downloaded Story of change interview guide template',1610726381,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(570,10,'Updated profile details ',1610727288,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(571,10,'Updated profile details ',1610727294,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(572,10,'Added story of change media: Picture',1610732475,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(573,10,'Added story of change media: Audio',1610732522,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(574,10,'Added story of change media: Audio',1610734319,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(575,10,'Added story of change media: Completed Interview guide',1610734439,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(576,10,'Added story of change media: Completed Interview guide',1610734588,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(577,10,'Added story of change media: Audio',1610734633,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(578,10,'Added story of change media: Video',1610734785,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(579,10,'Added story of change media: Audio',1610734886,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(580,10,'Added story of change media: Audio',1610735709,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(581,10,'Added story of change media: Audio',1610735730,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(582,10,'Added story of change media: Audio',1610735788,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(583,10,'Added story of change media: Audio',1610735890,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(584,10,'Added story of change media: Audio',1610736927,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(585,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\' for review',1610736962,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(586,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\' for review',1610737488,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(587,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\' for review',1610737569,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(588,10,'Added story of change media: Picture',1610769231,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(589,10,'Added story of change media: Picture',1610771569,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(590,10,'Added story of change media: Video',1610970100,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(591,10,'Added story of change media: Audio',1610970117,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(592,10,'Added story of change media: Completed Interview guide',1610970131,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(593,10,'Added story of change media: Picture',1610975093,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(594,10,'Removed Case study media type: Completed Interview guide - my sample.pdf',1610980438,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(595,10,'Removed Case study media type: Picture - bg1.jpg',1610980456,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(596,10,'Added story of change media: Audio',1610981018,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(597,10,'Removed Case study media type: Picture - ',1610981039,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(598,10,'Removed Case study media type: Audio - sample audio.mp3',1610981242,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(599,10,'Removed Case study media type: Picture - ',1610981265,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(600,10,'Removed Case study media type: Video - sample video.mp4',1610981287,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(601,10,'Removed Case study media type: Completed Interview guide - ',1610981304,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(602,10,'Removed Case study media type: Audio - ',1610981431,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(603,10,'Added story of change media: Completed Interview guide',1610981490,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(604,10,'Completed interview guide template was downloaded',1610981894,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(605,10,'Completed interview guide template was downloaded',1610981947,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(606,10,'Completed interview guide template was downloaded',1610981969,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(607,10,'Removed Case study media type: Audio - sample audio.mp3',1610982034,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(608,10,'Removed Case study media type: Video - ',1610982099,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(609,10,'Removed Case study media type: Picture - FIFA.jpg',1610982111,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(610,10,'Removed Case study media type: Completed Interview guide - my sample.pdf',1610982144,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(611,10,'Added story of change media: Completed Interview guide',1610982179,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(612,10,'Added story of change media: Completed Interview guide',1610983644,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(613,10,'Updated story of change media: Completed Interview guide',1610983659,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(614,10,'Added story of change media: Completed Interview guide',1610983827,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(615,10,'Updated story of change media: Completed Interview guide',1610984163,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(616,10,'Added story of change media: Completed Interview guide',1610984200,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(617,10,'Updated story of change media: Completed Interview guide',1610984220,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(618,10,'Added story of change media: Picture',1610984242,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(619,10,'Updated story of change media: Picture',1610984357,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(620,10,'Added story of change media: Audio',1610984390,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(621,10,'Updated story of change media: Audio',1610984427,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(622,10,'Added story of change media: Video',1610984457,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(623,1,'Completed interview guide template was downloaded',1610985340,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(624,10,'Added story of change media: Completed Interview guide',1610985873,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(625,10,'Removed Case study media type: Completed Interview guide - my sample.pdf',1610985901,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(626,10,'Added story of change media: Completed Interview guide',1610985922,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(627,1,'Completed interview guide template was downloaded',1610986280,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(628,1,'Exported Story of change:Test to pdf',1610987494,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(629,1,'Exported Story of change:Test to pdf',1610987507,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(630,1,'Updated story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\'s status to \'Accepted\'',1610987526,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(631,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987556,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(632,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987678,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(633,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987698,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(634,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987751,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(635,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987772,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(636,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987781,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(637,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987793,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(638,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987830,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(639,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987840,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(640,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987858,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(641,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987896,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(642,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987928,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(643,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610987964,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(644,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610988009,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(645,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610988028,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(646,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610988062,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(647,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610988076,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(648,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610988107,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(649,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610988173,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(650,1,'Update role Administrator',1610989408,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(651,1,'Added story of change article',1610990606,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(652,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610991632,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(653,1,'Added story of change article',1610991992,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(654,1,'Added story of change article',1610992095,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(655,1,'Downloaded Case study article',1610992375,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(656,1,'Removed Case study article',1610992764,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(657,1,'Updated story of change article',1610992849,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(658,1,'Updated story of change article',1610992923,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(659,1,'Removed Case study article',1610992952,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(660,1,'Added story of change article',1610992981,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(661,1,'Updated story of change article',1610993047,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(662,1,'Removed Case study article',1610993078,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(663,1,'Updated story of change article',1610993090,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(664,1,'Updated story of change article',1610993157,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(665,1,'Removed Case study article',1610993179,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(666,1,'Added story of change article',1610993207,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(667,1,'Updated story of change article',1610993345,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(668,1,'Updated story of change article',1610993364,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(669,1,'Downloaded Case study article',1610993423,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(670,1,'Updated story of change article',1610993471,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(671,1,'Downloaded Case study article',1610993477,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(672,1,'Updated story of change article',1610993525,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(673,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610993777,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(674,10,'Downloaded Case study article',1610994027,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(675,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994121,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(676,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994227,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(677,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994242,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(678,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994263,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(679,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994281,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(680,1,'Downloaded Story of change interview guide template',1610994286,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(681,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994320,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(682,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994333,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(683,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994502,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(684,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994537,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(685,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994658,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(686,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994674,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(687,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610994687,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(688,10,'Downloaded Case study article',1610994947,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(689,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610995061,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(690,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610995207,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(691,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610995236,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(692,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610995252,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(693,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610995299,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(694,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610995365,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(695,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610995389,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(696,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1610995498,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(697,10,'Added story of change media: Completed Interview guide',1611056596,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(698,10,'Removed Case study media type: Completed Interview guide - coa.png',1611056644,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(699,10,'Added story of change media: Picture',1611056653,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(700,1,'Update role Administrator',1611075247,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(701,1,'Update role Administrator',1611075256,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(702,1,'Update role Administrator',1611075290,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(703,1,'Update role Administrator',1611075363,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(704,1,'Update role User',1611075628,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(705,1,'Update role User',1611075695,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(706,1,'Added market Test market',1611076081,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(707,10,'Added 1 commodity prices',1611076848,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0'),(708,10,'Added story of change: From subsistence to commercial farming-Case of Mr. Francis',1613999393,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(709,10,'Added 1 commodity prices',1614013880,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(710,10,'Added 1 commodity prices',1614013941,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(711,1,'Downloaded Story of change interview guide template',1614015676,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(712,1,'Blocked user account with email:francis.chulu@unza.zm',1614016783,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(713,1,'Updated user details with email: test@unza.zm',1614016818,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(714,1,'Added interview guide question::\'Test question\'',1614019009,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(715,1,'Downloaded Story of change interview guide template',1614019027,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(716,10,'Added story of change: From subsistence to commercial farming-Case of Chulu',1614019196,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(717,10,'Updated introduction for story of change: From subsistence to commercial farming-Case of Chulu',1614019228,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(718,10,'Updated challenges for story of change: From subsistence to commercial farming-Case of Chulu',1614019245,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(719,10,'Updated actions for story of change: From subsistence to commercial farming-Case of Chulu',1614019253,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(720,10,'Updated results for story of change: From subsistence to commercial farming-Case of Chulu',1614019260,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(721,10,'Updated conclusions for story of change: From subsistence to commercial farming-Case of Chulu',1614019268,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(722,10,'Updated sequel for story of change: From subsistence to commercial farming-Case of Chulu',1614019275,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(723,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Chulu\' for review',1614019397,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(724,1,'Updated story of change: \'Test\'s status to \'Accepted\'',1614019554,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(725,1,'Added story of change article',1614019624,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(726,1,'Update role Administrator',1614020005,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(727,1,'Exported Story of change:Test to pdf',1614020055,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(728,1,'Updated story of change: \'From subsistence to commercial farming-Case of Mr. Chulu\'s status to \'Accepted\'',1614020092,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(729,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1614020103,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(730,10,'Removed story of change: From subsistence to commercial farming-Case of Mr. Francis and associated media from the system.',1614064978,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(731,1,'Created role test',1614068089,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(732,1,'Updated user details with email: chulu1francis@gmail.com',1614068336,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(733,1,'Blocked user account with email:test1@unza.zm',1614068363,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(734,1,'Activated user account with email:test1@unza.zm',1614068371,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(735,10,'Downloaded Story of change interview guide template',1614070007,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(736,1,'Added interview guide question::\'Another recommendation\'',1614070268,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(737,1,'Updated interview guide question from:\' Test question \' to \'Test question another\'',1614070301,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(738,1,'Downloaded Story of change interview guide template',1614070308,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(739,10,'Added story of change: From subsistence to commercial farming-Case of Mr Chulu Francis',1614070456,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(740,10,'Updated introduction for story of change: From subsistence to commercial farming-Case of Mr Chulu Francis',1614070519,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(741,10,'Updated challenges for story of change: From subsistence to commercial farming-Case of Mr Chulu Francis',1614070527,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(742,10,'Updated actions for story of change: From subsistence to commercial farming-Case of Mr Chulu Francis',1614070534,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(743,10,'Updated results for story of change: From subsistence to commercial farming-Case of Mr Chulu Francis',1614070541,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(744,10,'Updated conclusions for story of change: From subsistence to commercial farming-Case of Mr Chulu Francis',1614070547,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(745,10,'Updated sequel for story of change: From subsistence to commercial farming-Case of Mr Chulu Francis',1614070553,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(746,10,'Added story of change media: Completed Interview guide',1614070638,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(747,10,'Added story of change media: Completed Interview guide',1614070673,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(748,10,'Added story of change media: Completed Interview guide',1614070702,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(749,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr Chulu Francis\' for review',1614070813,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(750,1,'Updated story of change: \'From subsistence to commercial farming-Case of Mr Chulu Francis\'s status to \'Accepted\'',1614070934,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(751,1,'Added story of change article',1614070974,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(752,10,'Added 2 commodity prices',1614071294,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0'),(753,1,'Exported Story of change:From subsistence to commercial farming-Case of Mr. Chulu to pdf',1614790677,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(754,10,'Removed Case study media type: Completed Interview guide - index.png',1614932102,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(755,10,'Added story of change media: Video',1614936357,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(756,10,'Added story of change media: Audio',1614936417,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(757,10,'Added story of change media: Picture',1614936460,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(758,10,'Added story of change media: Completed Interview guide',1614936492,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(759,10,'Updated story of change media: Picture',1614936957,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(760,10,'Updated story of change media: Completed Interview guide',1614937144,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(761,10,'Removed Case study media type: Picture - coa.png',1614937541,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(762,10,'Added story of change media: Completed Interview guide',1614937559,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(763,10,'Removed Case study media type: Completed Interview guide - profile.png',1614937669,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(764,10,'Added story of change media: Picture',1614937920,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(765,10,'Removed Case study media type: Picture - index.png',1614937935,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(766,10,'Added story of change media: Picture',1614937947,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(767,10,'Updated story of change media: Picture',1614937968,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(768,10,'Removed Case study media type: Picture - index.png',1614938043,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(769,10,'Added story of change media: Picture',1614938053,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(770,1,'Downloaded Story of change interview guide template',1615102321,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(771,1,'Downloaded Story of change interview guide template',1615103001,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(772,1,'Downloaded Story of change interview guide template',1615103006,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(773,1,'Downloaded Story of change interview guide template',1615104010,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(774,1,'Downloaded Story of change interview guide template',1615104710,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(775,1,'Downloaded category A Farmer registration form',1615105241,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(776,1,'Downloaded category A Farmer registration form',1615105270,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(777,1,'Downloaded category A Farmer registration form',1615105514,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(778,1,'Downloaded category A Farmer registration form',1615105581,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(779,1,'Downloaded category A Farmer registration form',1615105613,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(780,1,'Downloaded category A Farmer registration form',1615105658,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(781,1,'Downloaded category A Farmer registration form',1615105700,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(782,1,'Downloaded category A Farmer registration form',1615105779,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(783,1,'Downloaded category A Farmer registration form',1615105795,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(784,1,'Downloaded category A Farmer registration form',1615105946,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(785,1,'Downloaded category A Farmer registration form',1615106022,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(786,1,'Downloaded category A Farmer registration form',1615106081,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(787,1,'Downloaded category A Farmer registration form',1615106245,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(788,1,'Downloaded category A Farmer registration form',1615106261,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(789,1,'Downloaded category A Farmer registration form',1615106273,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(790,1,'Downloaded category A Farmer registration form',1615106351,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(791,1,'Downloaded category A Farmer registration form',1615106542,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(792,1,'Downloaded category A Farmer registration form',1615106558,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(793,1,'Downloaded category A Farmer registration form',1615106589,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(794,1,'Downloaded category A Farmer registration form',1615106600,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(795,1,'Downloaded category A Farmer registration form',1615106715,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(796,1,'Downloaded category A Farmer registration form',1615106735,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(797,1,'Downloaded category A Farmer registration form',1615106759,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(798,1,'Downloaded category A Farmer registration form',1615106792,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(799,1,'Downloaded category A Farmer registration form',1615106868,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(800,1,'Downloaded category A Farmer registration form',1615106889,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(801,1,'Downloaded category A Farmer registration form',1615106918,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(802,1,'Downloaded category A Farmer registration form',1615106949,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(803,1,'Downloaded category A Farmer registration form',1615106981,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(804,1,'Downloaded category A Farmer registration form',1615106994,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(805,1,'Downloaded category A Farmer registration form',1615107019,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(806,1,'Downloaded category A Farmer registration form',1615107111,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(807,1,'Downloaded category A Farmer registration form',1615107125,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(808,1,'Downloaded category A Farmer registration form',1615107177,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(809,1,'Downloaded category A Farmer registration form',1615107329,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(810,1,'Downloaded category A Farmer registration form',1615107347,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(811,1,'Downloaded category A Farmer registration form',1615107530,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(812,1,'Downloaded category A Farmer registration form',1615107560,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(813,1,'Downloaded category A Farmer registration form',1615107571,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(814,1,'Downloaded category A Farmer registration form',1615107594,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(815,1,'Downloaded category A Farmer registration form',1615107826,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(816,1,'Downloaded category A Farmer registration form',1615107951,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(817,1,'Downloaded category A Farmer registration form',1615107973,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(818,1,'Downloaded category A Farmer registration form',1615108010,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(819,1,'Downloaded category A Farmer registration form',1615108025,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(820,1,'Downloaded category A Farmer registration form',1615108105,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(821,1,'Downloaded category A Farmer registration form',1615108122,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(822,1,'Downloaded category A Farmer registration form',1615108228,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(823,1,'Downloaded category A Farmer registration form',1615108251,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(824,1,'Downloaded category A Farmer registration form',1615108291,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(825,1,'Downloaded category A Farmer registration form',1615108319,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(826,1,'Downloaded category A Farmer registration form',1615108340,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(827,1,'Downloaded category A Farmer registration form',1615108372,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(828,1,'Downloaded category A Farmer registration form',1615108404,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(829,1,'Downloaded category A Farmer registration form',1615108429,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(830,1,'Downloaded category A Farmer registration form',1615108449,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(831,1,'Downloaded category A Farmer registration form',1615108535,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(832,1,'Downloaded category A Farmer registration form',1615108561,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(833,1,'Downloaded category A Farmer registration form',1615108612,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(834,1,'Downloaded category A Farmer registration form',1615108659,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(835,1,'Downloaded category A Farmer registration form',1615108687,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(836,1,'Downloaded category A Farmer registration form',1615108703,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(837,1,'Downloaded category A Farmer registration form',1615108744,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(838,1,'Downloaded category A Farmer registration form',1615108777,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(839,1,'Downloaded category A Farmer registration form',1615108803,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(840,1,'Downloaded category A Farmer registration form',1615108829,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(841,1,'Downloaded category A Farmer registration form',1615108854,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(842,1,'Downloaded category A Farmer registration form',1615108870,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(843,1,'Downloaded category A Farmer registration form',1615108882,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(844,1,'Downloaded category A Farmer registration form',1615108899,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(845,1,'Downloaded category A Farmer registration form',1615108955,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(846,1,'Downloaded category A Farmer registration form',1615108965,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(847,1,'Downloaded FaaBS training attendance sheet',1615110493,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(848,1,'Downloaded FaaBS training attendance sheet',1615110570,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(849,1,'Downloaded FaaBS training attendance sheet',1615110600,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(850,1,'Downloaded FaaBS training attendance sheet',1615110620,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(851,1,'Downloaded FaaBS training attendance sheet',1615110647,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(852,1,'Downloaded FaaBS training attendance sheet',1615110697,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(853,1,'Downloaded FaaBS training attendance sheet',1615110706,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(854,1,'Downloaded FaaBS training attendance sheet',1615110715,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(855,1,'Downloaded FaaBS training attendance sheet',1615110725,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(856,1,'Downloaded FaaBS training attendance sheet',1615110776,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(857,1,'Downloaded FaaBS training attendance sheet',1615110787,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(858,1,'Downloaded FaaBS training attendance sheet',1615110846,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(859,1,'Downloaded FaaBS training attendance sheet',1615110857,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(860,1,'Downloaded FaaBS training attendance sheet',1615110866,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(861,1,'Downloaded FaaBS training attendance sheet',1615110885,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(862,1,'Downloaded FaaBS training attendance sheet',1615110963,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(863,1,'Downloaded FaaBS training attendance sheet',1615111003,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(864,1,'Downloaded FaaBS training attendance sheet',1615111133,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(865,1,'Downloaded FaaBS training attendance sheet',1615111155,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(866,1,'Downloaded FaaBS training attendance sheet',1615111182,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(867,1,'Downloaded FaaBS training attendance sheet',1615111273,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(868,1,'Downloaded FaaBS training attendance sheet',1615111314,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(869,1,'Downloaded FaaBS training attendance sheet',1615111324,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(870,1,'Downloaded FaaBS training attendance sheet',1615111338,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(871,1,'Downloaded FaaBS training attendance sheet',1615111443,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(872,1,'Downloaded FaaBS training attendance sheet',1615111505,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(873,1,'Downloaded FaaBS training attendance sheet',1615111540,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(874,1,'Downloaded FaaBS training attendance sheet',1615111561,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(875,1,'Downloaded FaaBS training attendance sheet',1615111579,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(876,1,'Downloaded FaaBS training attendance sheet',1615111590,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(877,1,'Downloaded FaaBS training attendance sheet',1615111601,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(878,1,'Downloaded FaaBS training attendance sheet',1615111609,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(879,1,'Downloaded FaaBS training attendance sheet',1615111691,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(880,1,'Downloaded FaaBS training attendance sheet',1615111706,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(881,1,'Downloaded FaaBS training attendance sheet',1615111726,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(882,1,'Downloaded FaaBS training attendance sheet',1615111739,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(883,1,'Downloaded FaaBS training attendance sheet',1615111754,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(884,1,'Downloaded FaaBS training attendance sheet',1615111951,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(885,1,'Downloaded FaaBS training attendance sheet',1615111963,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(886,1,'Downloaded FaaBS training attendance sheet',1615111980,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(887,1,'Downloaded FaaBS training attendance sheet',1615112004,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(888,1,'Downloaded FaaBS training attendance sheet',1615112013,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(889,1,'Downloaded FaaBS training attendance sheet',1615112228,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(890,1,'Downloaded FaaBS training attendance sheet',1615112252,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(891,1,'Downloaded FaaBS training attendance sheet',1615112286,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(892,1,'Downloaded FaaBS training attendance sheet',1615112314,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(893,1,'Downloaded FaaBS training attendance sheet',1615112339,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(894,1,'Downloaded FaaBS training attendance sheet',1615112366,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(895,1,'Downloaded FaaBS training attendance sheet',1615112382,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(896,1,'Downloaded FaaBS training attendance sheet',1615112403,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(897,1,'Downloaded FaaBS training attendance sheet',1615112445,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(898,1,'Downloaded FaaBS training attendance sheet',1615112459,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(899,1,'Downloaded FaaBS training attendance sheet',1615112468,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(900,1,'Downloaded FaaBS training attendance sheet',1615112479,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(901,1,'Downloaded FaaBS training attendance sheet',1615112488,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(902,1,'Downloaded FaaBS training attendance sheet',1615112582,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(903,1,'Downloaded FaaBS training attendance sheet',1615112615,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(904,1,'Downloaded FaaBS training attendance sheet',1615112627,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(905,1,'Downloaded FaaBS training attendance sheet',1615114061,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(906,1,'Downloaded FaaBS training attendance sheet',1615114096,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(907,1,'Downloaded FaaBS training attendance sheet',1615114108,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(908,1,'Downloaded FaaBS training attendance sheet',1615114118,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(909,10,'Downloaded FaaBS training attendance sheet',1615114139,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(910,1,'Downloaded FaaBS training attendance sheet',1615117305,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(911,10,'Downloaded FaaBS training attendance sheet',1615117990,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(912,10,'Downloaded FaaBS training attendance sheet',1615118072,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(913,10,'Downloaded FaaBS training attendance sheet',1615118089,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(914,10,'Downloaded FaaBS training attendance sheet',1615118099,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(915,10,'Downloaded FaaBS training attendance sheet',1615118120,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(916,10,'Downloaded FaaBS training attendance sheet',1615118187,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(917,10,'Downloaded FaaBS training attendance sheet',1615118276,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(918,10,'Downloaded FaaBS training attendance sheet',1615118414,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(919,10,'Downloaded FaaBS training attendance sheet',1615118455,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(920,10,'Downloaded FaaBS training attendance sheet',1615118772,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(921,10,'Downloaded FaaBS training attendance sheet',1615118836,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(922,10,'Downloaded FaaBS training attendance sheet',1615118916,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(923,10,'Downloaded FaaBS training attendance sheet',1615119040,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(924,10,'Downloaded FaaBS training attendance sheet',1615119167,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(925,10,'Downloaded FaaBS training attendance sheet',1615119232,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(926,10,'Downloaded FaaBS training attendance sheet',1615119264,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(927,10,'Downloaded FaaBS training attendance sheet',1615119317,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(928,10,'Downloaded FaaBS training attendance sheet',1615119542,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(929,1,'Update role User',1615121370,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(930,10,'Added FaaBS group Come together Group',1615123711,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(931,10,'Updated FaaBS group details',1615124310,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(932,10,'Updated FaaBS group details',1615124322,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(933,10,'Updated FaaBS group details',1615124327,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(934,10,'Removed FaaBS group FaaBS 2 from the system.',1615124400,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(935,1,'Update role User',1615125975,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(936,1,'Update role Administrator',1615127426,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(937,10,'Added farmer: Francis  Chulu',1615132100,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(938,10,'Updated farmer records for farmer: Francis  Chulu',1615134154,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(939,10,'Updated farmer records for farmer: Francis  Chulu',1615143436,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(940,10,'Updated farmer records for farmer: Francis  Chulu',1615143937,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(941,10,'Updated Category A Farmer details',1615144397,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(942,10,'Updated Category A Farmer details',1615144406,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(943,10,'Updated FaaBS group details',1615144502,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(944,10,'Updated FaaBS group details',1615144510,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(945,1,'Update role Administrator',1615144985,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(946,1,'Update role User',1615146800,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(947,10,'Added FaaBS training attendance record for farmer:Mr.Francis  Chulu. The training took place on:2021-03-08',1615156562,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(948,1,'Downloaded FaaBS training attendance sheet',1615228332,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(949,1,'Update role User',1615228349,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(950,10,'Updated FaaBS training attendance record for farmer:Mr.Francis  Chulu. The training took place on:2021-03-08',1615230109,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(951,10,'Added FaaBS training attendance record for farmer:Mr.Francis  Chulu. The training took place on:2021-03-08',1615230171,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(952,10,'Added FaaBS training attendance record for farmer:Mr.Francis  Chulu. The training took place on:2021-03-03',1615230200,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(953,10,'Removed FaaBS training attendance record for farmer:Mr.Francis  Chulu. The training took place on:2021-03-08',1615230208,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(954,10,'Removed FaaBS training attendance record for farmer:Mr.Francis  Chulu. The training took place on:2021-03-08',1615230253,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(955,1,'Update role Administrator',1615230276,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(956,10,'Downloaded category A Farmer registration form',1615235009,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(957,10,'Downloaded Story of change interview guide template',1615235022,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(958,10,'Submitted story of change: \'From subsistence to commercial farming-Case of Mr Chulu Francis\' for review',1615306106,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(959,10,'Added story of change media: Completed Interview guide',1615306685,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(960,10,'Added story of change media: Completed Interview guide',1615308524,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(961,10,'Added story of change media: Completed Interview guide',1615308670,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(962,10,'Added story of change media: Completed Interview guide',1615309195,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(963,10,'Added story of change media: Picture',1615309307,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(964,10,'Updated introduction for story of change: From subsistence to commercial farming-Case of Chulu',1615309669,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(965,10,'Updated results for story of change: From subsistence to commercial farming-Case of Chulu',1615309673,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(966,1,'Update role Administrator',1615310036,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(967,1,'Update role User',1615310043,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(968,10,'Submitted a back to office report',1615321516,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(969,10,'Saved back to office report as draft',1615322460,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(970,10,'Saved back to office report as draft',1615322765,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(971,10,'Saved back to office report as draft',1615323054,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(972,10,'Submitted a back to office report',1615323477,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(973,10,'Submitted a back to office report',1615323518,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(974,10,'Submitted a back to office report',1615323534,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(975,10,'Updated and Saved back to office report as draft',1615375883,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(976,10,'Updated and Saved back to office report as draft',1615376188,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(977,10,'Updated and Saved back to office report as draft',1615376492,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(978,10,'Submitted a back to office report for review',1615377117,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(979,10,'Submitted a back to office report for review',1615377302,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(980,10,'Submitted a back to office report for review',1615377475,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(981,1,'Updated BtOR report\'s status to \'Send back for more information\'',1615386422,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(982,10,'Updated and Submitted a back to office report for review',1615386494,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(983,10,'Updated and Submitted a back to office report for review',1615386497,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(984,10,'Updated and Submitted a back to office report for review',1615386498,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(985,10,'Updated and Submitted a back to office report for review',1615386499,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(986,10,'Updated and Submitted a back to office report for review',1615386499,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(987,10,'Updated and Submitted a back to office report for review',1615386499,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(988,10,'Updated and Submitted a back to office report for review',1615386499,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(989,10,'Updated and Saved back to office report as draft',1615386505,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(990,10,'Updated and Submitted a back to office report for review',1615386511,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(991,10,'Updated and Submitted a back to office report for review',1615386512,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(992,10,'Updated and Submitted a back to office report for review',1615386512,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(993,10,'Updated and Submitted a back to office report for review',1615386512,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(994,10,'Updated and Submitted a back to office report for review',1615386512,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(995,10,'Updated and Submitted a back to office report for review',1615386512,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(996,1,'Updated BtOR report\'s status to \'Send back for more information\'',1615386629,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(997,10,'Updated and Submitted a back to office report for review',1615386878,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(998,10,'Updated and Submitted a back to office report for review',1615386880,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(999,10,'Updated and Saved back to office report as draft',1615386932,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1000,10,'Updated and Submitted a back to office report for review',1615386938,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1001,10,'Updated and Submitted a back to office report for review',1615387336,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1002,10,'Updated and Submitted a back to office report for review',1615387446,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1003,10,'Updated and Submitted a back to office report for review',1615387451,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1004,10,'Updated and Submitted a back to office report for review',1615387473,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1005,10,'Updated and Saved back to office report as draft',1615387693,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1006,10,'Updated and Submitted a back to office report for review',1615387731,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1007,1,'Updated BtOR report\'s status to \'Accepted\'',1615388511,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1008,1,'Update role User',1615397135,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1009,1,'Downloaded category A Farmer registration form',1616330150,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1010,1,'Downloaded FaaBS training attendance sheet',1616330168,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1011,1,'Update role User',1616335275,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1012,10,'Added Camp four camp work effort for month March',1616418759,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1013,10,'Added Camp four camp work effort for month March',1616424785,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1014,10,'Added Camp four camp work effort for month March',1616424938,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1015,10,'Added Camp four camp work effort for month March',1616424985,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1016,10,'Added Camp four camp work effort for month March',1616425129,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1017,10,'Added Camp four camp work effort for month March',1616425169,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1018,10,'Added Camp four camp work effort for month March',1616425302,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1019,10,'Added Camp four camp work effort for month March',1616425683,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1020,10,'Added Camp four camp work effort for month March',1616426242,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1021,10,'Added Camp four camp work effort for month March',1616426712,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1022,10,'Added Camp four camp work effort for month March',1616426776,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1023,10,'Updated Camp four camp work effort for month March',1616428048,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1024,10,'Removed monthly work effort and all planned activities for camp: Camp four from the system.',1616428859,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1025,10,'Added Camp four camp work effort for month March',1616444054,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1026,10,'Updated Camp four camp work effort for month March',1616445813,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1027,10,'Added Camp four camp planned activity for month March',1616488269,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1028,10,'Added Camp four camp planned activity for month March',1616502509,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1029,10,'Removed planned activities and all submitted actuals/achieved for camp: Camp four for activity:Test 2 from the system for the month of March',1616508380,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1030,10,'Updated Camp four camp planned activity for month March',1616509259,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1031,10,'Removed submitted achieved planned activity targets for camp: Camp four for activity:Test from the system for the month of March',1616511407,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1032,10,'Updated Camp four camp work effort for month March',1616511510,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1033,10,'Added Camp four camp planned activity for month March',1616512189,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0'),(1034,10,'Added Camp four camp planned activity for month March',1616596930,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0');
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_activity`
--

DROP TABLE IF EXISTS `awpb_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_code` varchar(10) NOT NULL,
  `parent_activity_id` int(11) DEFAULT NULL,
  `component_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 Main activity, 1 Subactivity',
  `activity_type` varchar(255) DEFAULT NULL,
  `awpb_template_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `name` varchar(40) NOT NULL,
  `unit_of_measure_id` int(11) DEFAULT NULL,
  `programme_target` double NOT NULL,
  `indicator` text NOT NULL,
  `quarter_one_budget` double DEFAULT NULL,
  `quarter_two_budget` double DEFAULT NULL,
  `quarter_three_budget` double DEFAULT NULL,
  `quarter_four_budget` double DEFAULT NULL,
  `total_budget` double DEFAULT NULL,
  `expense_category_id` int(11) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description` (`description`),
  UNIQUE KEY `name` (`name`),
  KEY `component_id` (`component_id`),
  KEY `expense_category_id` (`expense_category_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `unit_of_measure_id` (`unit_of_measure_id`),
  KEY `activity_code` (`activity_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_activity`
--

LOCK TABLES `awpb_activity` WRITE;
/*!40000 ALTER TABLE `awpb_activity` DISABLE KEYS */;
INSERT INTO `awpb_activity` VALUES (69,'1.1.C',NULL,27,0,'Main Activity',32,'Malambo','Malambo',NULL,0,'',NULL,NULL,NULL,NULL,NULL,2,1613833869,1613833869,14,14),(70,'1.1.C1',69,27,1,'Subactivity',32,'Testing Malambo sub activity','Testing Malambo sub activity',1,0,'',NULL,NULL,NULL,NULL,NULL,2,1613833968,1613833968,14,14),(71,'1.1.C2',69,27,1,'Subactivity',32,'Testing Malambo number two','Testing Malambo number two',1,0,'',NULL,NULL,NULL,NULL,NULL,2,1613834518,1613834518,14,14),(72,'1.2.C',NULL,28,0,'Main Activity',32,'Test activity on','Test activity on',NULL,0,'',NULL,NULL,NULL,NULL,NULL,2,1614017122,1614017122,14,14),(73,'1.2.C1',72,28,1,'Subactivity',32,'Sub activity test one','Sub activity test one',NULL,0,'',NULL,NULL,NULL,NULL,NULL,2,1614017247,1614017247,14,14),(74,'1.1.C',NULL,27,0,'Main Activity',32,'Tuesday test','Tuesday test',NULL,0,'',NULL,NULL,NULL,NULL,NULL,2,1614069748,1614069748,14,14),(75,'1.1.C1',74,27,1,'Subactivity',32,'Child activity for tuesday','Child activity for tuesday',NULL,0,'',NULL,NULL,NULL,NULL,NULL,2,1614069835,1614069835,14,14),(76,'1.1.E',NULL,27,0,'Main Activity',32,'Policy 3 related activities','Policy 3 related activities',NULL,0,'',NULL,NULL,NULL,NULL,NULL,1,1614943725,1614943887,14,14),(77,'1.1.E1',76,27,1,'Subactivity',32,'Workshop to consider recommendations from Provincial Policy Dialogue Meetings','Workshop to consider recommendations fro',1,0,'',NULL,NULL,NULL,NULL,NULL,1,1614944097,1614944097,14,14);
/*!40000 ALTER TABLE `awpb_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_activity_funder`
--

DROP TABLE IF EXISTS `awpb_activity_funder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_activity_funder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `funder_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `percentage` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `funder_id` (`funder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_activity_funder`
--

LOCK TABLES `awpb_activity_funder` WRITE;
/*!40000 ALTER TABLE `awpb_activity_funder` DISABLE KEYS */;
/*!40000 ALTER TABLE `awpb_activity_funder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_activity_line`
--

DROP TABLE IF EXISTS `awpb_activity_line`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_activity_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_cost` double NOT NULL,
  `mo_1` double DEFAULT NULL,
  `mo_2` double DEFAULT NULL,
  `mo_3` double DEFAULT NULL,
  `mo_4` double DEFAULT NULL,
  `mo_5` double DEFAULT NULL,
  `mo_6` double DEFAULT NULL,
  `mo_7` double DEFAULT NULL,
  `mo_8` double DEFAULT NULL,
  `mo_9` double DEFAULT NULL,
  `mo_10` double DEFAULT NULL,
  `mo_11` double DEFAULT NULL,
  `mo_12` double DEFAULT NULL,
  `quarter_one_quantity` double DEFAULT NULL,
  `quarter_two_quantity` double DEFAULT NULL,
  `quarter_three_quantity` double DEFAULT NULL,
  `quarter_four_quantity` double DEFAULT NULL,
  `total_quantity` double NOT NULL,
  `total_amount` double NOT NULL,
  `mo_1_actual` double DEFAULT NULL,
  `mo_2_actual` double DEFAULT NULL,
  `mo_3_actual` double DEFAULT NULL,
  `mo_4_actual` double DEFAULT NULL,
  `mo_5_actual` double DEFAULT NULL,
  `mo_6_actual` double DEFAULT NULL,
  `mo_7_actual` double DEFAULT NULL,
  `mo_8_actual` double DEFAULT NULL,
  `mo_9_actual` double DEFAULT NULL,
  `mo_10_actual` double DEFAULT NULL,
  `mo_11_actual` double DEFAULT NULL,
  `mo_12_actual` double DEFAULT NULL,
  `status` int(11) NOT NULL,
  `district_id` int(11) unsigned DEFAULT NULL,
  `province_id` int(11) unsigned DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `district_id` (`district_id`),
  KEY `province_id` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_activity_line`
--

LOCK TABLES `awpb_activity_line` WRITE;
/*!40000 ALTER TABLE `awpb_activity_line` DISABLE KEYS */;
INSERT INTO `awpb_activity_line` VALUES (24,70,'Maize Seed',58.88,0,0,0,0,0,0,0,0,0,0,0,0,5,5,5,5,20,1177.6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,42,5,1614008295,1614023831,10,10),(25,71,'Groundnuts',1000,0,0,0,0,0,0,0,0,0,0,0,0,56,6,6,6,74,74000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,42,5,1614009746,1614023831,10,10),(27,70,'Urea',500.66,0,0,0,0,0,0,0,0,0,0,0,0,66,688,96886,9666,107306,53723821.96,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,42,5,1614009894,1614023831,10,10),(28,71,'Weed Killer',250,0,0,0,0,0,0,0,0,0,0,0,0,63,621,289,466,1439,359750,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,42,5,1614010000,1614023831,10,10),(29,70,'MRI 744 Seed',500.66,0,0,0,0,0,0,0,0,0,0,0,0,88,88,0,9669,9845,4928997.7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,42,5,1614010000,1614023832,10,10),(30,71,'Maize Seed',50,0,0,0,0,0,0,0,0,0,0,0,0,0,100,500,300,900,45000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,42,5,1614017595,1614023832,10,10),(31,71,'Urea',75,0,0,0,0,0,0,0,0,0,0,0,0,500,600,1000,50,2150,161250,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,42,5,1614017595,1614023832,10,10),(34,75,'Maize Seed',55.55,0,0,0,0,0,0,0,0,0,0,0,0,50,100,300,400,850,47217.5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,42,5,1614070037,1614070037,10,10),(35,71,'Urea',75,0,0,0,0,0,0,0,0,0,0,0,0,300,550,6,6,862,64650,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,42,5,1614070037,1614070037,10,10),(36,70,'Test',233.66,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,1,233.66,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,2,5,1614804976,1614806184,14,14),(37,71,'Test 2',0.56,1,1,1,1,11,1,1,1,1,1,1,1,3,13,3,3,19,10.64,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,2,5,1614808050,1614808502,14,14),(38,70,'Test 3',5.88,NULL,NULL,NULL,1,1,1,1,1,1,1,1,1,0,3,3,3,6,35.28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,2,5,1614808528,1614808528,14,14),(39,70,'Test 4',5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,2,5,1614810124,1614810124,14,14),(40,75,'Test 5',5.66,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,2,5,1614810785,1614810785,14,14),(41,75,'Test 5',5.66,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,5,1614811232,1614811232,14,14),(42,75,'Test 5',50.08,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,5,1614811259,1614811259,14,14),(43,70,'nn',9.99,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,2,19.98,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,5,1614812243,1614812243,14,14);
/*!40000 ALTER TABLE `awpb_activity_line` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_component`
--

DROP TABLE IF EXISTS `awpb_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `parent_component_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `outcome` text,
  `output` text,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0 Main component, 1 Subcomponent,',
  `access_level` int(11) NOT NULL DEFAULT '0' COMMENT '0 Programme, 1 District',
  `subcomponent` varchar(255) DEFAULT NULL,
  `funder_id` int(11) DEFAULT NULL,
  `expense_category_id` int(11) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `component_code` (`code`),
  UNIQUE KEY `component_description` (`name`),
  KEY `parent_component_id` (`parent_component_id`),
  KEY `expense_category_id` (`expense_category_id`),
  KEY `funder_id` (`funder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_component`
--

LOCK TABLES `awpb_component` WRITE;
/*!40000 ALTER TABLE `awpb_component` DISABLE KEYS */;
INSERT INTO `awpb_component` VALUES (22,'1',NULL,' Enabling Environment for Agribusiness Development Growth','Policy and institutional environment enhanced for agribusiness development','','',0,1,'Component',NULL,NULL,0,0,14,14),(25,'2',NULL,'Sustainable Agribusiness Partnerships','',NULL,NULL,0,0,'Component',NULL,NULL,0,0,14,14),(26,'3',NULL,'Programme Implementation','',NULL,NULL,0,0,'Component',NULL,NULL,0,0,14,14),(27,'1.1',22,' Agribusiness Policy Development','','Policy and institutional environment enhanced for agribusiness development',' Strategic framework that supports agribusiness develo',1,1,'Subcomponent',NULL,NULL,0,0,14,14),(28,'1.2',22,'Test','','test','test',1,0,'Subcomponent',NULL,NULL,0,0,14,14),(29,'4',NULL,'Test Component','',NULL,NULL,0,0,'Component',NULL,NULL,0,0,14,14);
/*!40000 ALTER TABLE `awpb_component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_consolidated`
--

DROP TABLE IF EXISTS `awpb_consolidated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_consolidated` (
  `id` int(11) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_consolidated`
--

LOCK TABLES `awpb_consolidated` WRITE;
/*!40000 ALTER TABLE `awpb_consolidated` DISABLE KEYS */;
/*!40000 ALTER TABLE `awpb_consolidated` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_expense_category`
--

DROP TABLE IF EXISTS `awpb_expense_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_expense_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_expense_category`
--

LOCK TABLES `awpb_expense_category` WRITE;
/*!40000 ALTER TABLE `awpb_expense_category` DISABLE KEYS */;
INSERT INTO `awpb_expense_category` VALUES (1,'I',1,'Consultancy',0,0,14,14),(2,'II',1,'Equipment and Material',0,0,14,14),(8,'IV',1,'Labour',0,0,NULL,11);
/*!40000 ALTER TABLE `awpb_expense_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_funder`
--

DROP TABLE IF EXISTS `awpb_funder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_funder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_funder`
--

LOCK TABLES `awpb_funder` WRITE;
/*!40000 ALTER TABLE `awpb_funder` DISABLE KEYS */;
INSERT INTO `awpb_funder` VALUES (1,'1','IFAD','IFAD',1,1612809613,1612809613,14,14),(2,'2','GRZ','GRZ',1,1612810868,1612810868,14,14);
/*!40000 ALTER TABLE `awpb_funder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_funding_type`
--

DROP TABLE IF EXISTS `awpb_funding_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_funding_type` (
  `id` int(11) NOT NULL,
  `funding_type_code` varchar(6) NOT NULL,
  `funding_type_name` varchar(255) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `funding_type_code` (`funding_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_funding_type`
--

LOCK TABLES `awpb_funding_type` WRITE;
/*!40000 ALTER TABLE `awpb_funding_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `awpb_funding_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_outcome`
--

DROP TABLE IF EXISTS `awpb_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_outcome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outcome_code` varchar(10) NOT NULL,
  `component_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `outcome_description` varchar(255) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `outcome_code` (`outcome_code`),
  KEY `template_id` (`template_id`),
  KEY `component_id` (`component_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_outcome`
--

LOCK TABLES `awpb_outcome` WRITE;
/*!40000 ALTER TABLE `awpb_outcome` DISABLE KEYS */;
/*!40000 ALTER TABLE `awpb_outcome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_output`
--

DROP TABLE IF EXISTS `awpb_output`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_output` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `output_code` varchar(10) NOT NULL,
  `outcome_id` int(11) NOT NULL,
  `output_description` varchar(255) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `output_code` (`output_code`),
  KEY `outcome_id` (`outcome_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_output`
--

LOCK TABLES `awpb_output` WRITE;
/*!40000 ALTER TABLE `awpb_output` DISABLE KEYS */;
/*!40000 ALTER TABLE `awpb_output` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_template`
--

DROP TABLE IF EXISTS `awpb_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fiscal_year` int(4) NOT NULL,
  `budget_theme` text NOT NULL,
  `comment` text NOT NULL,
  `guideline_file` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0 Closed, 1 open, 2 Blockedsed',
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fiscal_year` (`fiscal_year`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_template`
--

LOCK TABLES `awpb_template` WRITE;
/*!40000 ALTER TABLE `awpb_template` DISABLE KEYS */;
INSERT INTO `awpb_template` VALUES (1,2001,'nnnn 56666','Hi Hi Googogo',NULL,5,1609964565,1611786372,14,14),(2,2000,'Tetstst','Testst7778',NULL,5,1609964703,1611786372,14,14),(3,2004,'2002','2002','',5,1609965221,1611786372,14,14),(4,2003,'bb','bb',NULL,5,1609968491,1611786372,14,14),(5,2005,'bb','bb',NULL,5,1609968527,1611786372,14,14),(6,2006,'ffff','fff',NULL,5,1609968637,1611786372,14,14),(7,1980,'ttt','gg',NULL,5,1610000838,1611786372,14,14),(8,1981,'ttt','gg',NULL,5,1610000993,1611786372,14,14),(9,1983,'ttt','gg',NULL,5,1610001015,1611786372,14,14),(10,1982,'ttt','gg',NULL,5,1610001129,1611786372,14,14),(11,1984,'ttt','gg',NULL,5,1610001215,1611786372,14,14),(12,1985,'ttt','gg',NULL,5,1610001405,1611786372,14,14),(13,1986,'ttt','gg',NULL,5,1610001587,1611786372,14,14),(14,1987,'ttt','gg',NULL,5,1610001883,1611786372,14,14),(15,1988,'ttt','gg',NULL,5,1610001985,1611786372,14,14),(16,1989,'ttt','gg',NULL,5,1610002209,1611786373,14,14),(17,1910,'ttt','gg',NULL,5,1610002266,1611786373,14,14),(18,1911,'ttt','gg',NULL,5,1610002642,1611786373,14,14),(19,1912,'2','2',NULL,5,1610007825,1611786373,14,14),(21,1915,'2','2',NULL,5,1610008326,1611786373,14,14),(22,1916,'2','2',NULL,5,1610008412,1611786373,14,14),(23,1917,'2','2',NULL,5,1610008552,1611786373,14,14),(24,1918,'2','2',NULL,5,1610008748,1611786373,14,14),(25,1803,'1803666','180366','1803-AWPB-Guidelines.pdf',5,1610039971,1611786373,14,14),(26,1804,'25666','2566','',5,1610040425,1611786373,14,14),(27,1805,'lllll','llllll','1805-AWPB-Guidelines.pdf',5,1610040775,1611786373,14,14),(28,1856,'nsnsn','nnnnn','1856-AWPB-Guidelines.pdf',5,1610968426,1611786373,14,14),(29,2020,'Farming as a Business','Business is the way to go','2020-AWPB-Guidelines.pdf',5,1610986059,1611786373,14,14),(31,2021,'2021','2021','2021-AWPB-Guidelines.pdf',5,1611785873,1611786373,10,10),(32,2022,'2022','2022','2022-AWPB-Guidelines.pdf',1,1611786373,1611786373,10,10);
/*!40000 ALTER TABLE `awpb_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_unit_of_measure`
--

DROP TABLE IF EXISTS `awpb_unit_of_measure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awpb_unit_of_measure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_unit_of_measure`
--

LOCK TABLES `awpb_unit_of_measure` WRITE;
/*!40000 ALTER TABLE `awpb_unit_of_measure` DISABLE KEYS */;
INSERT INTO `awpb_unit_of_measure` VALUES (1,'Number',1,0,0,0,0),(2,'Kilograms',1,0,0,0,0);
/*!40000 ALTER TABLE `awpb_unit_of_measure` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `camp`
--

LOCK TABLES `camp` WRITE;
/*!40000 ALTER TABLE `camp` DISABLE KEYS */;
INSERT INTO `camp` VALUES (5,2,'Camp two',NULL,NULL,NULL,1607263313,1607263313,1,1),(6,2,'Camp three',NULL,NULL,NULL,1607263313,1607263313,1,1),(7,2,'Camp four',NULL,NULL,NULL,1607263313,1607263313,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodity_price_collection`
--

LOCK TABLES `commodity_price_collection` WRITE;
/*!40000 ALTER TABLE `commodity_price_collection` DISABLE KEYS */;
INSERT INTO `commodity_price_collection` VALUES (2,1,3,4,3,'2Kg',15.00,NULL,'12','2020',1607626330,1607626330,1,1),(3,1,3,6,3,'10Kg',69.00,NULL,'12','2020',1607627366,1607627366,1,1),(4,1,3,5,3,'25Kg',120.00,NULL,'12','2020',1607627366,1607627366,1,1),(5,1,3,1,3,'2kg',20.00,NULL,'12','2020',1607627366,1607627366,1,1),(6,1,3,2,3,'5kg',25.00,NULL,'12','2020',1607627366,1607627366,1,1),(7,1,3,6,3,'2KG',15.00,NULL,'1','2021',1607627366,1607627366,1,1),(8,1,3,1,3,'2KG',15.00,NULL,'1','2021',1607627366,1607627366,1,1),(9,1,3,3,3,'2KG',15.00,NULL,'1','2021',1607627366,1607627366,1,1),(10,1,3,4,3,'5KG',25.00,NULL,'1','2021',1607627366,1607627366,1,1),(11,1,3,5,3,'10KG',50.00,NULL,'1','2021',1607627366,1607627366,1,1),(12,1,3,3,3,'10KG',30.00,NULL,'1','2021',1607627366,1607627366,1,1),(13,2,4,2,3,'2Kg',2.00,NULL,'1','2021',1611076848,1611076848,10,10),(14,2,4,2,3,'15KG',20.00,NULL,'2','2021',1614013880,1614013880,10,10),(15,2,4,11,3,'10kg',20.00,NULL,'10','2021',1614013941,1614013941,10,10),(16,2,4,11,3,'10KG',20.00,NULL,'2','2021',1614071294,1614071294,10,10),(17,2,4,5,3,'25Kg',100.00,NULL,'2','2021',1614071294,1614071294,10,10);
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
  `camp_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lkm_storyofchange_1_idx` (`category_id`),
  CONSTRAINT `fk_lkm_storyofchange_1` FOREIGN KEY (`category_id`) REFERENCES `lkm_storyofchange_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange`
--

LOCK TABLES `lkm_storyofchange` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange` DISABLE KEYS */;
INSERT INTO `lkm_storyofchange` VALUES (2,3,'Test','Upendo Chulu','Francis Chulu','2021-01-11','<p><strong>My story introduction<br></strong></p><p>Yes this is my introduction of this story</p>','<p>The challenges</p>','<p>Story Actions</p>','<p><strong>The results</strong></p>','<p>The conclusions</p>','<p><strong>The sequel</strong></p>',0,0,NULL,1,'Story accepted',1610388925,1614019554,1,1,NULL,NULL,NULL),(3,4,'From subsistence to commercial farming-Case of Mr. Chulu','Francis Chulu','Edson Chulu','2021-01-12','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.<span class=\"redactor-invisible-space\"></span></p>',0,0,NULL,1,'',1610472852,1614020092,10,1,NULL,2,1),(5,3,'From subsistence to commercial farming-Case of Chulu','Francis Chulu','Test names','2021-02-16','<p>Introduction</p>','<p>Challenges<br></p>','<p>The actions<br></p>','The results','Conclusion','Sequel',0,0,NULL,0,NULL,1614019196,1614019397,10,10,NULL,2,1),(6,4,'From subsistence to commercial farming-Case of Mr Chulu Francis','Francis Chulu','Edson Chulu','2021-02-09','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',2,0,NULL,1,'',1614070456,1615306106,10,10,NULL,2,1);
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
  `file` varchar(255) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `file_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange_article`
--

LOCK TABLES `lkm_storyofchange_article` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange_article` DISABLE KEYS */;
INSERT INTO `lkm_storyofchange_article` VALUES (5,3,NULL,'Article description','DWpPgMuaYfz35QYbjzXdl86Rz03k2Avk.pdf',1610993207,1610993525,1,1,'my sample.pdf'),(6,2,NULL,'Description','JXqdPvl27LGf0T51dn54_yOxRqF4deXk.pdf',1614019624,1614019624,1,1,'my sample.pdf'),(7,6,NULL,'','_KDjaAkOc32clJN1sKBeKHCnTRUhjzIi.pdf',1614070974,1614070974,1,1,'my sample.pdf');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange_interview_guide_template_questions`
--

LOCK TABLES `lkm_storyofchange_interview_guide_template_questions` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange_interview_guide_template_questions` DISABLE KEYS */;
INSERT INTO `lkm_storyofchange_interview_guide_template_questions` VALUES (1,'Introduction','1','Please introduce yourself and tell me a bit about yourself?',1609956950,1609956950,1,1),(2,'The Problem','2','What Challenges were you experiencing before the E-SAPP and why?',1609958624,1609958624,1,1),(3,'The Problem','3','Did you do anything to solve the problem before E-SAPP? If yes, what did you do?',1609958658,1609958658,1,1),(4,'The Action','4','What interventions did E-SAPP put in place to resolve the problem?  <b>Probe: Detail them according to the different steps taken</b>.',1609958714,1610358307,1,1),(5,'The Action','5','Did the interventions by E-SAPP resolve the problem? Give a reason for your answer.',1609958980,1609958980,1,1),(6,'The Action','6','In your opinion, do you think this problem was going to be addressed if it was not for the intervention from E-SAPP? Give a reason?',1609958996,1609958996,1,1),(7,'The Action','7','What are the key areas of change that you noticed as a result of the intervention? Give examples. ',1609959016,1609959016,1,1),(8,'The Action','8','What are some of the lessons that you have learnt from the intervention?',1609959038,1609959038,1,1),(9,'Recommendations','9',' In terms of how the E-SAPP could improve its intervention delivery, do you have any recommendations/ suggestions? What do you think needs to be done?',1609959055,1609959055,1,1),(10,'Introduction','10','Test question another',1614019009,1614070301,1,1),(11,'Recommendations','11','Another recommendation',1614070268,1614070268,1,1);
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
  `file_name` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lkm_storyofchange_media_1_idx` (`story_id`),
  CONSTRAINT `fk_lkm_storyofchange_media_1` FOREIGN KEY (`story_id`) REFERENCES `lkm_storyofchange` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange_media`
--

LOCK TABLES `lkm_storyofchange_media` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange_media` DISABLE KEYS */;
INSERT INTO `lkm_storyofchange_media` VALUES (26,3,'Picture','index.png','dmG_gpT6kkkEblh3ReA_Ar4jHtSAjWzM.png',1610984242,1610984357,10,10),(27,3,'Audio','sample audio.mp3','zLCUZmBHpAx05bs5eV6ktmSDNq-XPZnG.mp3',1610984390,1610984427,10,10),(28,3,'Video','sample video.mp4','gMBISWTb_mKuJStmt2MKqT8BPblM_qpl.mp4',1610984457,1610984457,10,10),(30,3,'Picture','coa.png','Joxf6pf6YuhmsiTakdyzQBkBXrmXq8tw.png',1611056653,1611056653,10,10),(32,6,'Video','sample video.mp4','MwlYJ1CCJxJWq6CSK8aGnA0us31uKacY.mp4',1614936357,1614936357,10,10),(33,6,'Audio','sample audio.mp3','L9ZJK9i-cH2l85NfrOs4CtuF-FUvhzAz.mp3',1614936417,1614936417,10,10),(38,6,'Picture','profile.png','JsN6az9MI360kbJ_jr-clyVt1rycpzU3wuicQrqwga9Aq.png',1614938053,1614938053,10,10),(41,6,'Picture','coa.png','zMajjrs0uQzjIkVj08C3Yd9ZMADZfXsJYB7Lte1dMa-bu.png',1615309307,1615309307,10,10);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `market`
--

LOCK TABLES `market` WRITE;
/*!40000 ALTER TABLE `market` DISABLE KEYS */;
INSERT INTO `market` VALUES (1,14,'Chisokone',NULL,1607267413,1607362158,1,1),(2,49,'Soweto',NULL,1607267496,1607362171,1,1),(3,1,'Chisamba test',NULL,1607623358,1607623358,1,1),(4,2,'Test market',NULL,1611076081,1611076081,1,1);
/*!40000 ALTER TABLE `market` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_back_to_office_report`
--

DROP TABLE IF EXISTS `me_back_to_office_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_back_to_office_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `name_of_officer` varchar(45) NOT NULL,
  `team_members` text,
  `key_partners` text COMMENT 'Key partners in each location/site visited',
  `purpose_of_assignment` text NOT NULL,
  `summary_of_assignment_outcomes` text NOT NULL,
  `key_findings` text NOT NULL,
  `key_recommendations` text NOT NULL COMMENT 'Key Recommendations/Actions to be taken, by whom',
  `copy_sent_to` text,
  `annexes` text,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'Pending submission for review=0, Reviewed and accepted=1,Submitted for review=2,Reviewed and sent back for more information=3',
  `reviewer_comments` varchar(45) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_back_to_office_report`
--

LOCK TABLES `me_back_to_office_report` WRITE;
/*!40000 ALTER TABLE `me_back_to_office_report` DISABLE KEYS */;
INSERT INTO `me_back_to_office_report` VALUES (1,'2021-03-10','2021-03-12','test  Test','Francis  Chulu','<p>Partners</p>','<p>Purpose</p>','<p>Summary</p>','<p>Findings</p>','<p>Recommedations</p>',NULL,'',1,'BtOR is well done hence it has been accepted',1615321516,1615388511,10,1);
/*!40000 ALTER TABLE `me_back_to_office_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_awpb_objectives`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_awpb_objectives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_camp_subproject_records_awpb_objectives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `camp_id` int(11) unsigned NOT NULL,
  `quarter` int(11) NOT NULL,
  `key_indicators` text NOT NULL,
  `period_unit` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `year` varchar(5) NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_records_awpb_objectives_1_idx` (`camp_id`),
  CONSTRAINT `fk_me_camp_subproject_records_awpb_objectives_1` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_awpb_objectives`
--

LOCK TABLES `me_camp_subproject_records_awpb_objectives` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_awpb_objectives` DISABLE KEYS */;
INSERT INTO `me_camp_subproject_records_awpb_objectives` VALUES (1,5,1,'Not set','Not set','0','2021',1615474709,1615489186,10,10),(2,5,2,'Not set','Not set','0','2021',1615474709,1615489186,10,10),(3,5,3,'Not set','Not set','0','2021',1615474709,1615489186,10,10),(4,5,4,'Not set','Not set','0','2021',1615474709,1615489186,10,10),(5,6,1,'Not set','Not set','0','2021',1615474709,1615487999,10,10),(6,6,2,'Not set','Not set','0','2021',1615474709,1615487999,10,10),(7,6,3,'Not set','Not set','0','2021',1615474709,1615487999,10,10),(8,6,4,'Not set','Not set','0','2021',1615474709,1615487999,10,10),(9,7,1,'- Train 10 farmers\r\n- Indicator two\r\n','12','10','2021',1615474709,1615486522,10,10),(10,7,2,'- Issue out 5 commodity sacks','20','5','2021',1615474709,1615486522,10,10),(11,7,3,'- Indicator one\r\n- Indicator two','1','1','2021',1615474709,1615486629,10,10),(12,7,4,'- Indicator one\r\n- Indicator two','3','2','2021',1615474709,1615486522,10,10);
/*!40000 ALTER TABLE `me_camp_subproject_records_awpb_objectives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_improved_tech_facilitation`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_improved_tech_facilitation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_camp_subproject_records_improved_tech_facilitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `camp_id` int(11) unsigned NOT NULL,
  `output_level_indicator_id` int(11) NOT NULL,
  `year` varchar(5) NOT NULL,
  `quarter` varchar(4) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_improved_tech_facilitation_1_idx` (`output_level_indicator_id`),
  CONSTRAINT `fk_me_camp_subproject_improved_tech_facilitation_1` FOREIGN KEY (`output_level_indicator_id`) REFERENCES `me_camp_subproject_records_output_level_indicators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_improved_tech_facilitation`
--

LOCK TABLES `me_camp_subproject_records_improved_tech_facilitation` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_improved_tech_facilitation` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_camp_subproject_records_improved_tech_facilitation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_monthly_planned_activities`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_monthly_planned_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_camp_subproject_records_monthly_planned_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_effort_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `faabs_id` int(11) NOT NULL,
  `zone` varchar(45) DEFAULT NULL,
  `activity_target` varchar(255) DEFAULT NULL,
  `beneficiary_target_total` int(11) DEFAULT '0',
  `beneficiary_target_women` varchar(45) NOT NULL DEFAULT '0',
  `beneficiary_target_youth` varchar(45) NOT NULL DEFAULT '0',
  `beneficiary_target_women_headed` varchar(45) NOT NULL DEFAULT '0',
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_records_monthly_planned_activities_1_idx` (`faabs_id`),
  KEY `fk_me_camp_subproject_records_monthly_planned_activities_2_idx` (`work_effort_id`),
  CONSTRAINT `fk_me_camp_subproject_records_monthly_planned_activities_1` FOREIGN KEY (`faabs_id`) REFERENCES `me_faabs_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_me_camp_subproject_records_monthly_planned_activities_2` FOREIGN KEY (`work_effort_id`) REFERENCES `me_camp_subproject_records_planned_work_effort` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_monthly_planned_activities`
--

LOCK TABLES `me_camp_subproject_records_monthly_planned_activities` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_monthly_planned_activities` DISABLE KEYS */;
INSERT INTO `me_camp_subproject_records_monthly_planned_activities` VALUES (4,12,36,3,'Zone','1',9,'1','2','6',1616502508,1616509259,10,10),(5,12,37,1,'Zone','10',9,'3','3','3',1616512189,1616512189,10,10),(6,12,39,3,'Zone','10',7,'1','1','5',1616596929,1616596929,10,10);
/*!40000 ALTER TABLE `me_camp_subproject_records_monthly_planned_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_monthly_planned_activities_actual`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_monthly_planned_activities_actual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_camp_subproject_records_monthly_planned_activities_actual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `planned_activity_id` int(11) NOT NULL,
  `hours_worked_field` varchar(2) NOT NULL DEFAULT '0',
  `hours_worked_office` varchar(2) NOT NULL DEFAULT '0',
  `hours_worked_total` varchar(4) DEFAULT '0',
  `achieved_activity_target` varchar(45) NOT NULL,
  `beneficiary_target_achieved_total` varchar(45) NOT NULL DEFAULT '0',
  `beneficiary_target_achieved_women` varchar(45) NOT NULL DEFAULT '0',
  `beneficiary_target_achieved_youth` varchar(45) NOT NULL DEFAULT '0',
  `beneficiary_target_achieved_women_headed` varchar(45) NOT NULL DEFAULT '0',
  `remarks` text,
  `year` varchar(5) DEFAULT NULL,
  `month` varchar(3) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_new_table_2_idx` (`planned_activity_id`),
  CONSTRAINT `fk_new_table_2` FOREIGN KEY (`planned_activity_id`) REFERENCES `me_camp_subproject_records_monthly_planned_activities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_monthly_planned_activities_actual`
--

LOCK TABLES `me_camp_subproject_records_monthly_planned_activities_actual` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_monthly_planned_activities_actual` DISABLE KEYS */;
INSERT INTO `me_camp_subproject_records_monthly_planned_activities_actual` VALUES (3,4,'2','3','5','1','6','1','1','4','',NULL,NULL,1616511530,1616511907,10,10),(4,5,'4','6','10','9','7','2','2','3','',NULL,NULL,1616512224,1616512224,10,10),(5,6,'2','2','4','2','3','1','1','1','',NULL,NULL,1616597001,1616597001,10,10);
/*!40000 ALTER TABLE `me_camp_subproject_records_monthly_planned_activities_actual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_output_level_indicators`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_output_level_indicators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_camp_subproject_records_output_level_indicators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indicator` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_output_level_indicators`
--

LOCK TABLES `me_camp_subproject_records_output_level_indicators` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_output_level_indicators` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_camp_subproject_records_output_level_indicators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_planned_work_effort`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_planned_work_effort`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_camp_subproject_records_planned_work_effort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `camp_id` int(11) unsigned NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(15) NOT NULL,
  `days_in_month` int(11) NOT NULL,
  `days_field` int(11) NOT NULL DEFAULT '0',
  `days_office` int(11) NOT NULL DEFAULT '0',
  `days_total` int(11) DEFAULT '0' COMMENT 'Field days + Office days',
  `days_other_non_esapp_activities` int(11) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_records_planned_work_effort_1_idx` (`camp_id`),
  CONSTRAINT `fk_me_camp_subproject_records_planned_work_effort_1` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_planned_work_effort`
--

LOCK TABLES `me_camp_subproject_records_planned_work_effort` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_planned_work_effort` DISABLE KEYS */;
INSERT INTO `me_camp_subproject_records_planned_work_effort` VALUES (12,7,2021,'3',31,1,15,16,1,1616444054,1616511510,10,10);
/*!40000 ALTER TABLE `me_camp_subproject_records_planned_work_effort` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_subcomponents`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_subcomponents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_camp_subproject_records_subcomponents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facilitation_id` int(11) NOT NULL,
  `sub_component` varchar(255) NOT NULL,
  `females` varchar(45) NOT NULL DEFAULT '0',
  `males` varchar(45) NOT NULL DEFAULT '0',
  `women_headed` varchar(45) NOT NULL DEFAULT '0',
  `youth` varchar(45) NOT NULL DEFAULT '0',
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_records_subcomponents_1_idx` (`facilitation_id`),
  CONSTRAINT `fk_me_camp_subproject_records_subcomponents_1` FOREIGN KEY (`facilitation_id`) REFERENCES `me_camp_subproject_records_improved_tech_facilitation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_subcomponents`
--

LOCK TABLES `me_camp_subproject_records_subcomponents` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_subcomponents` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_camp_subproject_records_subcomponents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_faabs_category_a_farmers`
--

DROP TABLE IF EXISTS `me_faabs_category_a_farmers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_faabs_category_a_farmers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faabs_group_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `other_names` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `nrc` varchar(20) DEFAULT NULL,
  `marital_status` varchar(15) NOT NULL,
  `contact_number` varchar(16) DEFAULT NULL,
  `relationship_to_household_head` varchar(50) DEFAULT NULL,
  `registration_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `household_size` int(11) DEFAULT '0',
  `village` varchar(255) DEFAULT NULL,
  `chiefdom` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `commodity` varchar(255) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `title` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_faabs_farmer_register_1_idx` (`faabs_group_id`),
  CONSTRAINT `fk_me_faabs_category_a_farmers` FOREIGN KEY (`faabs_group_id`) REFERENCES `me_faabs_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faabs_category_a_farmers`
--

LOCK TABLES `me_faabs_category_a_farmers` WRITE;
/*!40000 ALTER TABLE `me_faabs_category_a_farmers` DISABLE KEYS */;
INSERT INTO `me_faabs_category_a_farmers` VALUES (1,3,'Francis','','Chulu','Male','1990-06-05','1828672/12/34','Married','+260978981455','','2021-03-03',1,10,'Village one','Chiefdom','Block','Zone','Commodity',1615132100,1615144406,10,10,'Mr.');
/*!40000 ALTER TABLE `me_faabs_category_a_farmers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_faabs_groups`
--

DROP TABLE IF EXISTS `me_faabs_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_faabs_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `camp_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_faabs_groups_1_idx` (`camp_id`),
  CONSTRAINT `fk_me_faabs_groups_1` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faabs_groups`
--

LOCK TABLES `me_faabs_groups` WRITE;
/*!40000 ALTER TABLE `me_faabs_groups` DISABLE KEYS */;
INSERT INTO `me_faabs_groups` VALUES (1,5,'FaaBS One','FO',1,1607263313,1615144510,1,10),(3,5,'Come together Group',NULL,1,1615123711,1615123711,10,10);
/*!40000 ALTER TABLE `me_faabs_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_faabs_register`
--

DROP TABLE IF EXISTS `me_faabs_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_faabs_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faabs_group_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `present` enum('Yes','No') DEFAULT 'Yes',
  `date` date NOT NULL,
  `topic` mediumtext NOT NULL COMMENT 'Topic or session covered i.e. Village Chicken housing',
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_faabs_register_1_idx` (`farmer_id`),
  KEY `fk_me_faabs_register_2_idx` (`faabs_group_id`),
  CONSTRAINT `fk_me_faabs_register_1` FOREIGN KEY (`farmer_id`) REFERENCES `me_faabs_category_a_farmers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_me_faabs_register_2` FOREIGN KEY (`faabs_group_id`) REFERENCES `me_faabs_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faabs_register`
--

LOCK TABLES `me_faabs_register` WRITE;
/*!40000 ALTER TABLE `me_faabs_register` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_faabs_register` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_faabs_training_attendance_sheet`
--

DROP TABLE IF EXISTS `me_faabs_training_attendance_sheet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_faabs_training_attendance_sheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faabs_group_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `household_head_type` varchar(45) NOT NULL DEFAULT 'Male headed' COMMENT 'Female headed or Male headed',
  `topic` text NOT NULL COMMENT 'Training course',
  `facilitators` text NOT NULL COMMENT 'Facilitators/Organisation',
  `partner_organisations` text,
  `training_date` date NOT NULL,
  `duration` varchar(10) NOT NULL COMMENT 'Duration hours and minutes',
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `full_names` varchar(255) DEFAULT NULL,
  `youth_non_youth` enum('Youth','Non Youth') DEFAULT NULL,
  `marital_status` varchar(45) DEFAULT NULL,
  `sex` varchar(45) DEFAULT NULL,
  `year_of_birth` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_faabs_training_attendance_sheet_1_idx` (`farmer_id`),
  KEY `fk_me_faabs_training_attendance_sheet_2_idx` (`faabs_group_id`),
  CONSTRAINT `fk_me_faabs_training_attendance_sheet_1` FOREIGN KEY (`farmer_id`) REFERENCES `me_faabs_category_a_farmers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_me_faabs_training_attendance_sheet_2` FOREIGN KEY (`faabs_group_id`) REFERENCES `me_faabs_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faabs_training_attendance_sheet`
--

LOCK TABLES `me_faabs_training_attendance_sheet` WRITE;
/*!40000 ALTER TABLE `me_faabs_training_attendance_sheet` DISABLE KEYS */;
INSERT INTO `me_faabs_training_attendance_sheet` VALUES (3,1,1,'Female headed','Goat keeping','Facilitator names','','2021-03-03','00:50',1615230200,1615230200,10,10,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `me_faabs_training_attendance_sheet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_field_monitoring_checklist_issues`
--

DROP TABLE IF EXISTS `me_field_monitoring_checklist_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_field_monitoring_checklist_issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(45) NOT NULL,
  `issue_category` varchar(255) NOT NULL,
  `issue` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_field_monitoring_checklist_issues`
--

LOCK TABLES `me_field_monitoring_checklist_issues` WRITE;
/*!40000 ALTER TABLE `me_field_monitoring_checklist_issues` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_field_monitoring_checklist_issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_field_monitoring_checklists`
--

DROP TABLE IF EXISTS `me_field_monitoring_checklists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_field_monitoring_checklists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `issue_id` int(11) NOT NULL,
  `addressed` enum('Yes','No') NOT NULL DEFAULT 'No',
  `comments` varchar(45) DEFAULT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_field_monitoring_checklists_1_idx` (`issue_id`),
  CONSTRAINT `fk_me_field_monitoring_checklists_1` FOREIGN KEY (`issue_id`) REFERENCES `me_field_monitoring_checklist_issues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_field_monitoring_checklists`
--

LOCK TABLES `me_field_monitoring_checklists` WRITE;
/*!40000 ALTER TABLE `me_field_monitoring_checklists` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_field_monitoring_checklists` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Manage Users',NULL,1),(2,'View Users',NULL,1),(3,'Manage Roles',NULL,1),(4,'View Roles',NULL,1),(6,'View profile',NULL,1),(7,'View audit trail logs',NULL,1),(8,'Manage provinces',NULL,1),(9,'Manage districts',NULL,1),(10,'Manage camps',NULL,1),(11,'Remove provinces',NULL,1),(12,'Remove districts',NULL,1),(13,'Remove camps',NULL,1),(14,'Manage markets',NULL,1),(15,'Remove markets',NULL,1),(16,'Manage commodity configs',NULL,1),(17,'Remove commodity config',NULL,1),(18,'Collect commodity prices',NULL,1),(19,'View commodity prices',NULL,1),(20,'Remove commodity price',NULL,1),(21,'Manage interview guide template questions',NULL,1),(22,'View interview guide template',NULL,1),(23,'Remove interview guide template question',NULL,1),(24,'Manage story of change categories',NULL,1),(25,'Submit story of change',NULL,1),(26,'Review Story of change',NULL,1),(27,'View Story of change',NULL,1),(28,'Attach case study articles',NULL,1),(29,'Manage faabs groups',NULL,1),(30,'View faabs groups',NULL,1),(31,'Remove faabs groups',NULL,1),(32,'Manage category A farmers',NULL,1),(33,'View category A farmers',NULL,1),(34,'Remove category A farmers',NULL,1),(35,'Submit FaaBS training records',NULL,1),(36,'View FaaBS training records',NULL,1),(37,'Remove FaaBS training records',NULL,1),(38,'Submit back to office report',NULL,1),(39,'Review back to office report',NULL,1),(40,'View back to office report',NULL,1),(41,'Set camp/project site objectives for awpb',NULL,1),(42,'View camp/project site objectives for awpb',NULL,1),(43,'Plan camp monthly activities',NULL,1),(44,'Remove planned camp monthly activities',NULL,1),(45,'View planned camp monthly activities',NULL,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=803 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `right_to_role`
--

LOCK TABLES `right_to_role` WRITE;
/*!40000 ALTER TABLE `right_to_role` DISABLE KEYS */;
INSERT INTO `right_to_role` VALUES (608,4,'View Users',1),(729,1,'Manage Users',1),(730,1,'View Users',1),(731,1,'Manage Roles',1),(732,1,'View Roles',1),(733,1,'View profile',1),(734,1,'View audit trail logs',1),(735,1,'Manage provinces',1),(736,1,'Manage districts',1),(737,1,'Manage camps',1),(738,1,'Remove provinces',1),(739,1,'Remove districts',1),(740,1,'Remove camps',1),(741,1,'Manage markets',1),(742,1,'Remove markets',1),(743,1,'Manage commodity configs',1),(744,1,'Remove commodity config',1),(745,1,'View commodity prices',1),(746,1,'Remove commodity price',1),(747,1,'Manage interview guide template questions',1),(748,1,'View interview guide template',1),(749,1,'Remove interview guide template question',1),(750,1,'Manage story of change categories',1),(751,1,'Review Story of change',1),(752,1,'Attach case study articles',1),(753,1,'View faabs groups',1),(754,1,'View category A farmers',1),(755,1,'View FaaBS training records',1),(756,1,'Review back to office report',1),(786,3,'View profile',1),(787,3,'Collect commodity prices',1),(788,3,'View commodity prices',1),(789,3,'Submit story of change',1),(790,3,'Manage faabs groups',1),(791,3,'View faabs groups',1),(792,3,'Remove faabs groups',1),(793,3,'Manage category A farmers',1),(794,3,'View category A farmers',1),(795,3,'Remove category A farmers',1),(796,3,'Submit FaaBS training records',1),(797,3,'View FaaBS training records',1),(798,3,'Remove FaaBS training records',1),(799,3,'Submit back to office report',1),(800,3,'Set camp/project site objectives for awpb',1),(801,3,'Plan camp monthly activities',1),(802,3,'Remove planned camp monthly activities',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator',1,1222,1603902498,1,1),(3,'User',1,1603902583,1603902583,1,1),(4,'test',1,1614068089,1614068089,1,1);
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
INSERT INTO `users` VALUES (1,1,'Francis','Chulu','','Mr.','Male','+260978981234','123454/21/23','chulu1francis@gmail.com','chulu1francis@gmail.com',1,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','Rqt3yudYSLJUk85kj3bj89ANgpWb4uWK_1607442830',NULL,0,0,0,1,NULL,11,1614068336,'Other user'),(5,3,'Chulu','Francis','','Mr.','Male','+260978981345','123454/21/23','francis.chulu@unza.zm','francis.chulu@unza.zm',1,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO',NULL,NULL,NULL,NULL,NULL,1,1,1604659275,1604660233,'Other user'),(6,1,'test','Test','','','Male','','','francis.chulu1@unza.zm','francis.chulu@unza.zm',2,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','LZ-pePN17FJB7Mg1CtyYyRsNH5tohaz6_1607174006',NULL,NULL,NULL,NULL,1,1,1607174006,1607174024,'Other user'),(9,3,'Test','Test','','Mr.','Female','','','test@unza.zm','chulu1francis@gmail.com',1,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','PF4j04-lRuOClA4gXY-oTX_95V6Ap-2-_1607181915',NULL,0,0,0,1,1,1607181915,1607186786,'Other user'),(10,3,'test','Test','','Mr.','Female','','','test1@unza.zm','francis.chulu@unza.zm',1,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','VlfAXnPz_XY_5s6E7x2Qi_SpPhIEl9I0_1607181970',NULL,NULL,2,1,1,1,1607181970,1614068371,'District user'),(11,3,'test','Test 3','','Mr.','Male','','','test2@unza.zm','francis.chulu@unza.zm',0,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','pFOgJWyUKdULYoTNxXctPhB4CEv8LpzB_1607182013',NULL,NULL,NULL,1,1,1,1607182013,1614016783,'Provincial user');
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

-- Dump completed on 2021-03-24 17:05:20
