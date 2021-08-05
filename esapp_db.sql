-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: localhost    Database: e_sapp
-- ------------------------------------------------------
-- Server version	8.0.26-0ubuntu0.21.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_time_sheets_district_staff`
--

DROP TABLE IF EXISTS `activity_time_sheets_district_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_time_sheets_district_staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rate_id` int NOT NULL,
  `month` varchar(45) NOT NULL,
  `designation` varchar(45) NOT NULL,
  `activity_description` text NOT NULL,
  `hours_field_esapp_activities` int NOT NULL DEFAULT '0',
  `hours_office_esapp_activities` int NOT NULL DEFAULT '0',
  `total_hours_worked` int NOT NULL DEFAULT '0',
  `contribution` double(10,2) NOT NULL DEFAULT '0.00',
  `status` int NOT NULL DEFAULT '0',
  `reviewer_comments` text,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `year` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activity_time_sheets_district_staff_1_idx` (`rate_id`),
  CONSTRAINT `fk_activity_time_sheets_district_staff_1` FOREIGN KEY (`rate_id`) REFERENCES `conf_hourly_rates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_time_sheets_district_staff`
--

LOCK TABLES `activity_time_sheets_district_staff` WRITE;
/*!40000 ALTER TABLE `activity_time_sheets_district_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_time_sheets_district_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_trail`
--

DROP TABLE IF EXISTS `audit_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_trail` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `action` text NOT NULL,
  `date` int unsigned NOT NULL,
  `ip_address` varchar(255) NOT NULL DEFAULT '',
  `user_agent` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_audit_trail_1_idx` (`user`),
  CONSTRAINT `fk_audit_trail_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_trail`
--

LOCK TABLES `audit_trail` WRITE;
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
INSERT INTO `audit_trail` VALUES (1,10,'Added Camp four camp work effort for month July',1625561338,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(2,10,'Added Camp four camp planned activity for month July',1625566562,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(3,10,'Updated Camp four camp planned activity for month July',1625566578,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(4,10,'Removed submitted achieved planned activity targets for camp: Camp four for activity:Dissemination of the Strategy     from the system for the month of July',1625570498,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(5,10,'Added Back to Office media: ',1625575525,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(6,10,'Added Back to Office media: ',1625575592,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(7,10,'Added Back to Office media: ',1625575637,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(8,10,'Added Back to Office media: ',1625575818,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(9,10,'Added Back to Office media: Image',1625575897,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(10,10,'Updated Back to Office media: Image',1625575916,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(11,10,'Removed Back to office media type: Image - user2.jpg',1625575924,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(12,10,'Added Back to Office media: Video',1625575963,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(13,10,'Added Back to Office media: Video',1625576050,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(14,10,'Added Back to Office media: Video',1625576177,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(15,10,'Removed Back to office media type: Video - sample video.mp4',1625576185,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(16,10,'Added Back to Office media: Image',1625576208,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(17,10,'Added Back to Office media: Image',1625576221,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(18,10,'Updated Back to Office media: Video',1625576288,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(19,10,'Removed Back to office media type: Video - sample video.mp4',1625576294,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(20,10,'Submitted a back to office report for review',1625576397,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(21,1,'Updated BtOR report\'s status to \'Accepted\'',1625578272,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(22,10,'Removed submitted achieved planned activity targets for camp: Camp four for activity:Dissemination of the Strategy     from the system for the month of July',1625591306,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(23,10,'Removed planned activities and all submitted actuals/achieved for camp: Camp four for activity from the system for the month of July',1625591410,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(24,10,'Added Camp four camp planned activity for month July',1625591437,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(25,1,'Update role User',1625649982,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(26,10,'Created project outreach record for year:2021 and quarter:1',1625653680,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(27,10,'updated project outreach record for year:2021 and quarter:1',1625653762,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(28,10,'updated project outreach record for year:2021 and quarter:1',1625654113,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(29,1,'Update role User',1625654143,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(30,10,'Created project outreach record for year:2021 and quarter:1',1625654258,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(31,10,'Removed project outreach record',1625654273,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(32,10,'Created project outreach record for year:2021 and quarter:1',1625654301,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(33,10,'updated project outreach record for year:2021 and quarter:1',1625655308,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(34,10,'Created project outreach record for year:2021 and quarter:2',1625655366,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(35,10,'Created project outreach record for year:2021 and quarter:3',1625655406,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(36,10,'Created project outreach record for year:2021 and quarter:4',1625655454,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(37,1,'Update role User',1625657190,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(38,10,'Created project outreach record for year:2017 and quarter:1',1625679617,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(39,10,'Created project outreach record for year:2017 and quarter:2',1625679648,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(40,10,'Created project outreach record for year:2017 and quarter:4',1625679675,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(41,10,'Created project outreach record for year:2017 and quarter:3',1625679718,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(42,10,'Added FaaBS group Come together group 3',1626339487,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(43,1,'Added camp Camp 5',1626339665,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0'),(44,1,'Update role Administrator',1627561738,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(45,1,'Updated hourly rate details ',1627564668,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(46,1,'Updated hourly rate details ',1627564673,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(47,1,'Updated hourly rate details ',1627564708,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(48,1,'Added hourly rate ZMW500',1627565207,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(49,1,'Removed hourly rate:ZMW 500 for designation:DACO from the system.',1627565260,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(50,1,'Update role Administrator',1627565543,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(51,1,'Update role Administrator',1627565562,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(52,1,'Update role User',1627567618,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(53,1,'Update role Administrator',1627567629,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(54,10,'Added Camp four camp work effort for month August',1628104985,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0'),(55,10,'Updated commodity price details',1628157144,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0');
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_activity`
--

DROP TABLE IF EXISTS `awpb_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_activity_id` int DEFAULT NULL,
  `component_id` int NOT NULL,
  `outcome_id` int DEFAULT NULL,
  `output_id` int DEFAULT NULL,
  `commodity_type_id` int unsigned DEFAULT NULL,
  `type` int NOT NULL COMMENT '0 Main activity, 1 Subactivity',
  `activity_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `awpb_template_id` int DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measure_id` int DEFAULT NULL,
  `programme_target` double DEFAULT NULL,
  `cumulative_planned` double NOT NULL,
  `cumulative_actual` double NOT NULL,
  `indicator_id` int DEFAULT NULL,
  `funder_id` int DEFAULT NULL,
  `gl_account_code` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quarter_one_budget` double DEFAULT NULL,
  `quarter_two_budget` double DEFAULT NULL,
  `quarter_three_budget` double DEFAULT NULL,
  `quarter_four_budget` double DEFAULT NULL,
  `total_budget` double DEFAULT NULL,
  `expense_category_id` int DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `description` (`description`),
  KEY `component_id` (`component_id`),
  KEY `commodity_id` (`commodity_type_id`),
  KEY `output_id` (`output_id`),
  KEY `outcome_id` (`outcome_id`),
  KEY `indicator_id` (`indicator_id`),
  KEY `funder_id` (`funder_id`),
  KEY `activity_code` (`activity_code`),
  KEY `unit_of_measure_id` (`unit_of_measure_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `expense_category_id` (`expense_category_id`),
  CONSTRAINT `awpb_activity_ibfk_1` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_ibfk_2` FOREIGN KEY (`expense_category_id`) REFERENCES `awpb_expense_category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_ibfk_3` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_ibfk_4` FOREIGN KEY (`unit_of_measure_id`) REFERENCES `awpb_unit_of_measure` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_ibfk_5` FOREIGN KEY (`funder_id`) REFERENCES `awpb_funder` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_ibfk_6` FOREIGN KEY (`indicator_id`) REFERENCES `awpb_indicator` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_ibfk_7` FOREIGN KEY (`outcome_id`) REFERENCES `awpb_outcome` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_ibfk_8` FOREIGN KEY (`output_id`) REFERENCES `awpb_output` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_ibfk_9` FOREIGN KEY (`commodity_type_id`) REFERENCES `awpb_commodity_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_activity`
--

LOCK TABLES `awpb_activity` WRITE;
/*!40000 ALTER TABLE `awpb_activity` DISABLE KEYS */;
INSERT INTO `awpb_activity` VALUES (90,'1.1.A',NULL,42,1,1,1,0,'Main',32,'Policy related activities','Policy related activities',1,500,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,14,14,14),(95,'1.1.A2',90,42,NULL,1,12,1,'Subactivity',NULL,'Provincial Validation of the ZNAD','Provincial Validation of the ZNAD',1,500,0,1965,NULL,2,'2000',NULL,NULL,NULL,NULL,NULL,1,1621278447,1621278447,14,14),(96,'1.1.A2',90,42,NULL,1,12,1,'Subactivity',NULL,'Drafting of the ZNADS','Drafting of the ZNADS',NULL,500,0,0,NULL,1,'2000',NULL,NULL,NULL,NULL,NULL,1,1621281291,1621281291,14,14),(98,'1.1.B',NULL,42,NULL,NULL,NULL,0,'Main Activity',NULL,' ZNADS implementation activities ',' ZNADS implementation activities ',NULL,NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1621282942,1621282942,14,14),(99,'1.1.B1',98,43,NULL,1,12,1,'Subactivity',NULL,'Dissemination of the Strategy    ','Dissemination of the Strategy    ',1,300,0,50,NULL,2,'2000',NULL,NULL,NULL,NULL,NULL,1,1621283049,1625594530,14,14),(100,'2.1.A',NULL,44,NULL,2,NULL,0,'Main Activity',NULL,'Activities related to strengthening of organizations/cooperatives/marketing groups  and creation of formal partnerships/agreements','Activity 2.1.A',NULL,NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1622381978,1622381978,14,14),(101,'2.1.A1',100,44,NULL,2,12,1,'Subactivity',NULL,'Stakeholder Engagement for Phase 2 and 3 Cat. A farmers\r\n','Activity 2.1.A1',NULL,500,0,0,NULL,2,'0760',NULL,NULL,NULL,NULL,NULL,1,1622386805,1622386805,14,14);
/*!40000 ALTER TABLE `awpb_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_activity_funder`
--

DROP TABLE IF EXISTS `awpb_activity_funder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_activity_funder` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_id` int NOT NULL,
  `funder_id` int NOT NULL,
  `amount` double NOT NULL,
  `percentage` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `funder_id` (`funder_id`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `awpb_activity_funder_ibfk_1` FOREIGN KEY (`funder_id`) REFERENCES `awpb_funder` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_funder_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_activity_line` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_id` int NOT NULL,
  `awpb_template_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `mo_1_amount` double DEFAULT NULL,
  `mo_2_amount` double DEFAULT NULL,
  `mo_3_amount` double DEFAULT NULL,
  `mo_4_amount` double DEFAULT NULL,
  `mo_5_amount` double DEFAULT NULL,
  `mo_6_amount` double DEFAULT NULL,
  `mo_7_amount` double DEFAULT NULL,
  `mo_8_amount` double DEFAULT NULL,
  `mo_9_amount` double DEFAULT NULL,
  `mo_10_amount` double DEFAULT NULL,
  `mo_11_amount` double DEFAULT NULL,
  `mo_12_amount` double DEFAULT NULL,
  `quarter_one_amount` double DEFAULT NULL,
  `quarter_two_amount` double DEFAULT NULL,
  `quarter_three_amount` double DEFAULT NULL,
  `quarter_four_amount` double DEFAULT NULL,
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
  `status` int NOT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `province_id` (`province_id`),
  KEY `district_id` (`district_id`),
  KEY `activity_id` (`activity_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  CONSTRAINT `awpb_activity_line_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_activity_line_ibfk_4` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_activity_line`
--

LOCK TABLES `awpb_activity_line` WRITE;
/*!40000 ALTER TABLE `awpb_activity_line` DISABLE KEYS */;
/*!40000 ALTER TABLE `awpb_activity_line` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_budget`
--

DROP TABLE IF EXISTS `awpb_budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_budget` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component_id` int NOT NULL,
  `output_id` int NOT NULL,
  `activity_id` int NOT NULL,
  `awpb_template_id` int NOT NULL,
  `indicator_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit_cost` double DEFAULT NULL,
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
  `mo_1_amount` double DEFAULT NULL,
  `mo_2_amount` double DEFAULT NULL,
  `mo_3_amount` double DEFAULT NULL,
  `mo_4_amount` double DEFAULT NULL,
  `mo_5_amount` double DEFAULT NULL,
  `mo_6_amount` double DEFAULT NULL,
  `mo_7_amount` double DEFAULT NULL,
  `mo_8_amount` double DEFAULT NULL,
  `mo_9_amount` double DEFAULT NULL,
  `mo_10_amount` double DEFAULT NULL,
  `mo_11_amount` double DEFAULT NULL,
  `mo_12_amount` double DEFAULT NULL,
  `quarter_one_amount` double DEFAULT NULL,
  `quarter_two_amount` double DEFAULT NULL,
  `quarter_three_amount` double DEFAULT NULL,
  `quarter_four_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
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
  `quarter_one_actual` double DEFAULT NULL,
  `quarter_two_actual` double DEFAULT NULL,
  `quarter_three_actual` double DEFAULT NULL,
  `quarter_four_actual` double DEFAULT NULL,
  `status` int NOT NULL,
  `number_of_females` int DEFAULT NULL,
  `number_of_males` int DEFAULT NULL,
  `number_of_young_people` int DEFAULT NULL,
  `number_of_not_young_people` int DEFAULT NULL,
  `number_of_women_headed_households` int DEFAULT NULL,
  `number_of_non_women_headed_households` int DEFAULT NULL,
  `number_of_household_members` int DEFAULT NULL,
  `number_of_females_actual` double DEFAULT NULL,
  `number_of_males_actual` double DEFAULT NULL,
  `number_of_young_people_actual` double DEFAULT NULL,
  `number_of_not_young_people_actual` double DEFAULT NULL,
  `number_of_women_headed_households_actual` double DEFAULT NULL,
  `number_of_non_women_headed_households_actual` double DEFAULT NULL,
  `number_of_household_members_actual` double DEFAULT NULL,
  `camp_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `district_id` (`district_id`),
  KEY `province_id` (`province_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `indicator_id` (`indicator_id`),
  KEY `component_id` (`component_id`),
  KEY `output_id` (`output_id`),
  KEY `camp_id` (`camp_id`),
  CONSTRAINT `awpb_budget_ibfk_1` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_budget_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`),
  CONSTRAINT `awpb_budget_ibfk_3` FOREIGN KEY (`output_id`) REFERENCES `awpb_output` (`id`),
  CONSTRAINT `awpb_budget_ibfk_4` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`),
  CONSTRAINT `awpb_budget_ibfk_5` FOREIGN KEY (`indicator_id`) REFERENCES `awpb_indicator` (`id`),
  CONSTRAINT `awpb_budget_ibfk_6` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `awpb_budget_ibfk_7` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `awpb_budget_ibfk_8` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_budget`
--

LOCK TABLES `awpb_budget` WRITE;
/*!40000 ALTER TABLE `awpb_budget` DISABLE KEYS */;
INSERT INTO `awpb_budget` VALUES (59,42,2,98,31,14,'Number of Category A farmers mobilised',NULL,1,0,0,2,0,0,0,0,0,0,0,0,1,2,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,4,5,3,6,5,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,1,0,1624269646,14,14),(60,43,2,99,31,15,'Number of Category A female farmers Mobi',NULL,5,4,58,89,96,96,99,98,77,22,11,23,67,281,274,56,678,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,50,NULL,1,10,2,9,3,6,0,0,18,NULL,2,NULL,7,NULL,NULL,NULL,2,1,1623538161,1624269646,14,14),(61,44,2,100,31,17,'Number of Category A Female Headed House',NULL,5,5,8,8,8,8,7,8,8,8,8,48,18,24,23,64,129,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,5,5,5,5,5,5,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,6,42,5,1623546812,1625003653,18,18),(62,44,2,101,31,14,'Number of Category A farmers mobilised',NULL,15,5,5,5,5,5,5,5,5,5,5,5,25,15,15,15,70,0,0,0,0,0,0,0,0,0,0,0,0,3833.25,3833.25,3833.25,3833.25,15333,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,6,6,5,5,5,5,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7,42,5,1624609480,1625004156,18,18),(63,44,2,101,29,14,'Number of Category A farmers mobilised',NULL,2,2,2,2,2,2,2,2,2,2,2,2,6,6,6,6,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15000,15000,10000,45000,85000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,2,2,2,2,2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7,42,5,1624633310,1625004157,18,18);
/*!40000 ALTER TABLE `awpb_budget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_comment`
--

DROP TABLE IF EXISTS `awpb_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `awpb_template_id` int NOT NULL,
  `district_id` int DEFAULT NULL,
  `province_id` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_comment`
--

LOCK TABLES `awpb_comment` WRITE;
/*!40000 ALTER TABLE `awpb_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `awpb_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_commodity_type`
--

DROP TABLE IF EXISTS `awpb_commodity_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_commodity_type` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commodity_type_1_idx` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_commodity_type`
--

LOCK TABLES `awpb_commodity_type` WRITE;
/*!40000 ALTER TABLE `awpb_commodity_type` DISABLE KEYS */;
INSERT INTO `awpb_commodity_type` VALUES (1,1,'comodity 1',1,1,NULL,NULL),(2,3,'Soya beans',1607447814,1607447814,1,1),(3,3,'Groundnuts',1607447827,1607447827,1,1),(4,3,'Rice',1607447871,1607447871,1,1),(5,4,'Mealie meal',1607447890,1607447952,1,1),(6,4,'Roller meal',1607447902,1607447956,1,1),(7,2,'Maize Seed',1607447971,1607447971,1,1),(8,2,'Groundnut seed',1607447992,1607447992,1,1),(9,2,'Rice seed',1607448004,1607448004,1,1),(10,2,'D-Compound',1607448021,1607448021,1,1),(11,2,'Urea',1607448041,1607448041,1,1),(12,NULL,'Multiple',1607182013,1607362711,14,14),(20,3,'Maize',1607446739,1607447798,1,1);
/*!40000 ALTER TABLE `awpb_commodity_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_component`
--

DROP TABLE IF EXISTS `awpb_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_component` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_component_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outcome` text COLLATE utf8mb4_unicode_ci,
  `output` text COLLATE utf8mb4_unicode_ci,
  `type` int NOT NULL DEFAULT '0' COMMENT '0 Main component, 1 Subcomponent,',
  `access_level` int DEFAULT '0' COMMENT '0 All.1 District, 2 Programme,',
  `subcomponent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funder_id` int DEFAULT NULL,
  `expense_category_id` int DEFAULT NULL,
  `gl_account_code` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_level_district` int DEFAULT NULL,
  `access_level_programme` int DEFAULT NULL,
  `access_level_province` int DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description` (`description`),
  UNIQUE KEY `component_description` (`name`),
  UNIQUE KEY `component_code` (`code`),
  KEY `funder_id` (`funder_id`),
  KEY `expense_category_id` (`expense_category_id`),
  KEY `parent_component_id` (`parent_component_id`),
  CONSTRAINT `awpb_component_ibfk_1` FOREIGN KEY (`expense_category_id`) REFERENCES `awpb_expense_category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_component_ibfk_2` FOREIGN KEY (`funder_id`) REFERENCES `awpb_funder` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_component`
--

LOCK TABLES `awpb_component` WRITE;
/*!40000 ALTER TABLE `awpb_component` DISABLE KEYS */;
INSERT INTO `awpb_component` VALUES (41,'2.3',43,'Facilitating Pro-Smallholder Market-Pull Agribusiness Partnerships','Facilitating Pro-Smallholder Market-Pull Agribusiness Partnerships','','',1,2,'Subcomponent',NULL,NULL,NULL,1,NULL,1,0,0,14,14),(42,'2.2',43,'Enhancing Agro-Micro, Small & Medium Enterprises','Enhancing Agro-Micro, Small & Medium Enterprises','dd','dd',1,2,'Subcomponent',NULL,NULL,'0700',1,0,1,0,0,14,14),(43,'2',NULL,'Sustainable Agribusiness Partnerships	','COMPONENT 2: Sustainable Agribusiness Partnerships	\r\n',NULL,NULL,0,0,'Component',NULL,NULL,NULL,1,0,0,0,0,14,14),(44,'2.1',43,'Strategic Linkages of Graduating Subsistence Farmers to Markets','Sub-Component 2.1 Strategic Linkages of Graduating Subsistence Farmers to Markets',NULL,NULL,1,0,'Subcomponent',NULL,NULL,'0900',1,0,0,0,0,14,14);
/*!40000 ALTER TABLE `awpb_component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_consolidated`
--

DROP TABLE IF EXISTS `awpb_consolidated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_consolidated` (
  `id` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_expense_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_expense_category`
--

LOCK TABLES `awpb_expense_category` WRITE;
/*!40000 ALTER TABLE `awpb_expense_category` DISABLE KEYS */;
INSERT INTO `awpb_expense_category` VALUES (1,'e1',1,'exp one',1,1,1,1),(2,'II',1,'Equipment and Material',0,0,14,14),(3,'I',1,'Consultancy',0,0,14,14),(8,'IV',1,'Labour',0,0,NULL,11);
/*!40000 ALTER TABLE `awpb_expense_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_funder`
--

DROP TABLE IF EXISTS `awpb_funder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_funder` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_funder`
--

LOCK TABLES `awpb_funder` WRITE;
/*!40000 ALTER TABLE `awpb_funder` DISABLE KEYS */;
INSERT INTO `awpb_funder` VALUES (1,'F1','funder one','desc',1,1,1,1,1),(2,'2','GRZ','GRZ',1,1612810868,1612810868,14,14),(3,'1','IFAD','IFAD',1,1612809613,1612809613,14,14);
/*!40000 ALTER TABLE `awpb_funder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_funding_type`
--

DROP TABLE IF EXISTS `awpb_funding_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_funding_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `funding_type_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `funding_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `funding_type_code` (`funding_type_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_funding_type`
--

LOCK TABLES `awpb_funding_type` WRITE;
/*!40000 ALTER TABLE `awpb_funding_type` DISABLE KEYS */;
INSERT INTO `awpb_funding_type` VALUES (1,'f1','Funder one',1,1,1,1);
/*!40000 ALTER TABLE `awpb_funding_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_indicator`
--

DROP TABLE IF EXISTS `awpb_indicator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_indicator` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_id` int DEFAULT NULL,
  `component_id` int NOT NULL,
  `outcome_id` int NOT NULL,
  `output_id` int DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measure_id` int DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_indicator`
--

LOCK TABLES `awpb_indicator` WRITE;
/*!40000 ALTER TABLE `awpb_indicator` DISABLE KEYS */;
INSERT INTO `awpb_indicator` VALUES (14,101,44,0,2,'Number of Category A farmers mobilised','Number of Category A farmers mobilised\r\n',1,0,0,NULL,NULL),(15,101,44,0,2,'Number of Category A female farmers Mobi','Number of Category A female farmers Mobilised\r\n',1,0,0,NULL,NULL),(16,101,44,0,2,'Number of Category A Youth Farmers Mobil','Number of Category A Youth Farmers Mobilised\r\n',1,0,0,NULL,NULL),(17,101,44,0,2,'Number of Category A Female Headed House','Number of Category A Female Headed Households Mobilised\r\n',1,0,0,NULL,NULL);
/*!40000 ALTER TABLE `awpb_indicator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_input`
--

DROP TABLE IF EXISTS `awpb_input`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_input` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_id` int NOT NULL,
  `awpb_template_id` int NOT NULL,
  `indicator_id` int NOT NULL,
  `budget_id` int NOT NULL,
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
  `total_quantity` double DEFAULT NULL,
  `mo_1_amount` double DEFAULT NULL,
  `mo_2_amount` double DEFAULT NULL,
  `mo_3_amount` double DEFAULT NULL,
  `mo_4_amount` double DEFAULT NULL,
  `mo_5_amount` double DEFAULT NULL,
  `mo_6_amount` double DEFAULT NULL,
  `mo_7_amount` double DEFAULT NULL,
  `mo_8_amount` double DEFAULT NULL,
  `mo_9_amount` double DEFAULT NULL,
  `mo_10_amount` double DEFAULT NULL,
  `mo_11_amount` double DEFAULT NULL,
  `mo_12_amount` double DEFAULT NULL,
  `quarter_one_amount` double DEFAULT NULL,
  `quarter_two_amount` double DEFAULT NULL,
  `quarter_three_amount` double DEFAULT NULL,
  `quarter_four_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
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
  `status` int NOT NULL,
  `camp_id` int DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `district_id` (`district_id`),
  KEY `province_id` (`province_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `indicator_id` (`indicator_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `awpb_input_ibfk_1` (`budget_id`),
  CONSTRAINT `awpb_input_ibfk_1` FOREIGN KEY (`budget_id`) REFERENCES `awpb_budget` (`id`),
  CONSTRAINT `awpb_input_ibfk_2` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_input_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`),
  CONSTRAINT `awpb_input_ibfk_4` FOREIGN KEY (`indicator_id`) REFERENCES `awpb_indicator` (`id`),
  CONSTRAINT `awpb_input_ibfk_5` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `awpb_input_ibfk_6` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `awpb_input_ibfk_7` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `awpb_input_ibfk_8` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_input`
--

LOCK TABLES `awpb_input` WRITE;
/*!40000 ALTER TABLE `awpb_input` DISABLE KEYS */;
/*!40000 ALTER TABLE `awpb_input` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_outcome`
--

DROP TABLE IF EXISTS `awpb_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_outcome` (
  `id` int NOT NULL AUTO_INCREMENT,
  `outcome_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `component_id` int DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outcome_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `outcome_code` (`outcome_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_outcome`
--

LOCK TABLES `awpb_outcome` WRITE;
/*!40000 ALTER TABLE `awpb_outcome` DISABLE KEYS */;
INSERT INTO `awpb_outcome` VALUES (1,'',42,'Policy and institutional environment enh','Policy and institutional environment enhanced for agribusiness development',14,14,14,14);
/*!40000 ALTER TABLE `awpb_outcome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_output`
--

DROP TABLE IF EXISTS `awpb_output`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_output` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_id` int NOT NULL,
  `outcome_id` int DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_output`
--

LOCK TABLES `awpb_output` WRITE;
/*!40000 ALTER TABLE `awpb_output` DISABLE KEYS */;
INSERT INTO `awpb_output` VALUES (1,'',42,1,'Strategic framework that supports agribu','Strategic framework that supports agribusiness developed and implementated',14,14,14,14),(2,'2.1',44,NULL,'Output 2.1','Output 2.1 Capacity of  smallholder farmers to produce a surplus for the market increased',0,0,NULL,NULL);
/*!40000 ALTER TABLE `awpb_output` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_template`
--

DROP TABLE IF EXISTS `awpb_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_template` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fiscal_year` int NOT NULL,
  `budget_theme` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `guideline_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL COMMENT '0 Closed, 1 open, 2 Blockedsed',
  `status_activities` int DEFAULT NULL,
  `status_users` int DEFAULT NULL,
  `preparation_deadline_first_draft` date DEFAULT NULL,
  `submission_deadline` date DEFAULT NULL,
  `consolidation_deadline` date DEFAULT NULL,
  `review_deadline` date DEFAULT NULL,
  `preparation_deadline_second_draft` date DEFAULT NULL,
  `review_deadline_pco` date DEFAULT NULL,
  `finalisation_deadline_pco` date DEFAULT NULL,
  `submission_deadline_moa_mfl` date DEFAULT NULL,
  `approval_deadline_jpsc` date DEFAULT NULL,
  `incorpation_deadline_pco_moa_mfl` date DEFAULT NULL,
  `submission_deadline_ifad` date DEFAULT NULL,
  `comment_deadline_ifad` date DEFAULT NULL,
  `distribution_deadline` date DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fiscal_year` (`fiscal_year`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_template`
--

LOCK TABLES `awpb_template` WRITE;
/*!40000 ALTER TABLE `awpb_template` DISABLE KEYS */;
INSERT INTO `awpb_template` VALUES (1,2001,'nnnn 56666','Hi Hi Googogo',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1609964565,1621939468,14,14),(2,2000,'Tetstst','Testst7778',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1609964703,1621939469,14,14),(3,2004,'2002','2002','',3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1609965221,1621939469,14,14),(4,2003,'bb','bb',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1609968491,1621939469,14,14),(5,2005,'bb','bb',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1609968527,1621939469,14,14),(6,2006,'ffff','fff',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1609968637,1621939469,14,14),(7,1980,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610000838,1621939469,14,14),(8,1981,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610000993,1621939469,14,14),(9,1983,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610001015,1621939469,14,14),(10,1982,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610001129,1621939469,14,14),(11,1984,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610001215,1621939469,14,14),(12,1985,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610001405,1621939469,14,14),(13,1986,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610001587,1621939469,14,14),(14,1987,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610001883,1621939469,14,14),(15,1988,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610001985,1621939469,14,14),(16,1989,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610002209,1621939469,14,14),(17,1910,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610002266,1621939469,14,14),(18,1911,'ttt','gg',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610002642,1621939469,14,14),(19,1912,'2','2',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610007825,1621939469,14,14),(21,1915,'2','2',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610008326,1621939469,14,14),(22,1916,'2','2',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610008412,1621939469,14,14),(23,1917,'2','2',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610008552,1621939469,14,14),(24,1918,'2','2',NULL,3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610008748,1621939469,14,14),(25,1803,'1803666','180366','1803-AWPB-Guidelines.pdf',3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610039971,1621939469,14,14),(26,1804,'25666','2566','',3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610040425,1621939470,14,14),(27,1805,'lllll','llllll','1805-AWPB-Guidelines.pdf',3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610040775,1621939470,14,14),(28,1856,'nsnsn','nnnnn','1856-AWPB-Guidelines.pdf',3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610968426,1621939470,14,14),(29,2020,'Farming as a Business','Business is the way to go','2020-AWPB-Guidelines.pdf',3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1610986059,1621939470,14,14),(31,2021,'2021','2021','2021-AWPB-Guidelines.pdf',2,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1611785873,1611786373,10,10),(32,2022,'2022','2022','2022-AWPB-Guidelines.pdf',3,NULL,NULL,'2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20','2021-07-20',1611786373,1621939470,10,14),(33,2019,'Test','Test','2019-AWPB-Guidelines.pdf',1,1,1,'2021-05-25','2021-06-30','2021-07-30','2021-08-30','2021-09-15','2021-09-30','2021-10-14','2021-11-01','2021-11-08','2021-11-15','2021-11-29','2021-10-21','2021-10-28',1621939470,1622573307,14,14);
/*!40000 ALTER TABLE `awpb_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_template_activity`
--

DROP TABLE IF EXISTS `awpb_template_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_template_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_id` int NOT NULL,
  `component_id` int DEFAULT NULL,
  `outcome_id` int DEFAULT NULL,
  `output_id` int DEFAULT NULL,
  `awpb_template_id` int NOT NULL,
  `funder_id` int DEFAULT NULL,
  `expense_category_id` int DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `expense_category_id` (`expense_category_id`),
  KEY `component_id` (`component_id`),
  KEY `output_id` (`output_id`),
  KEY `outcome_id` (`outcome_id`),
  KEY `funder_id` (`funder_id`),
  KEY `activity_code` (`activity_id`),
  CONSTRAINT `awpb_template_activity_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_template_activity_ibfk_2` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `awpb_template_activity_ibfk_3` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_template_activity`
--

LOCK TABLES `awpb_template_activity` WRITE;
/*!40000 ALTER TABLE `awpb_template_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `awpb_template_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awpb_unit_of_measure`
--

DROP TABLE IF EXISTS `awpb_unit_of_measure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_unit_of_measure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_by` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awpb_unit_of_measure`
--

LOCK TABLES `awpb_unit_of_measure` WRITE;
/*!40000 ALTER TABLE `awpb_unit_of_measure` DISABLE KEYS */;
INSERT INTO `awpb_unit_of_measure` VALUES (1,'KG',1,1,1,1,1);
/*!40000 ALTER TABLE `awpb_unit_of_measure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `camp`
--

DROP TABLE IF EXISTS `camp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `camp` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_camp_1_idx` (`district_id`),
  CONSTRAINT `fk_camp_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `camp`
--

LOCK TABLES `camp` WRITE;
/*!40000 ALTER TABLE `camp` DISABLE KEYS */;
INSERT INTO `camp` VALUES (5,2,'Camp two','','-14.624586674161693','28.13769210937501',1607263313,1625074357,1,1),(6,2,'Camp three','','-14.663616632630394','28.091343537597666',1607263313,1625075081,1,1),(7,2,'Camp four','','-14.47571105850427','28.41235031250001',1607263313,1625090266,1,1),(8,42,'Chila one group','','-15.569439292403246','28.28154434326173',1625092685,1625092685,1,1),(9,44,'Camp 5','','-15.330186863675754','28.680657044677744',1626339665,1626339665,1,1);
/*!40000 ALTER TABLE `camp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodity_category`
--

DROP TABLE IF EXISTS `commodity_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commodity_category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commodity_price_collection` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `district` int unsigned NOT NULL,
  `market_id` int unsigned NOT NULL,
  `commodity_type_id` int unsigned NOT NULL,
  `price_level_id` int unsigned NOT NULL,
  `unit_of_measure` varchar(45) DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `description` text,
  `month` varchar(3) NOT NULL,
  `year` varchar(11) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commodity_price_collection_2_idx` (`price_level_id`),
  KEY `fk_commodity_price_collection_4_idx` (`commodity_type_id`),
  KEY `fk_commodity_price_collection_3_idx` (`market_id`),
  KEY `fk_commodity_price_collection_1_idx` (`district`),
  CONSTRAINT `fk_commodity_price_collection_1` FOREIGN KEY (`district`) REFERENCES `district` (`id`),
  CONSTRAINT `fk_commodity_price_collection_2` FOREIGN KEY (`price_level_id`) REFERENCES `commodity_price_level` (`id`),
  CONSTRAINT `fk_commodity_price_collection_3` FOREIGN KEY (`market_id`) REFERENCES `market` (`id`),
  CONSTRAINT `fk_commodity_price_collection_4` FOREIGN KEY (`commodity_type_id`) REFERENCES `commodity_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodity_price_collection`
--

LOCK TABLES `commodity_price_collection` WRITE;
/*!40000 ALTER TABLE `commodity_price_collection` DISABLE KEYS */;
INSERT INTO `commodity_price_collection` VALUES (2,1,3,4,3,'2Kg',15.00,NULL,'12','2020',1607626330,1607626330,1,1),(3,1,3,6,3,'10Kg',69.00,NULL,'12','2020',1607627366,1607627366,1,1),(4,1,3,5,3,'25Kg',120.00,NULL,'12','2020',1607627366,1607627366,1,1),(5,1,3,1,3,'2kg',20.00,NULL,'12','2020',1607627366,1607627366,1,1),(6,1,3,2,3,'5kg',25.00,NULL,'12','2020',1607627366,1607627366,1,1),(7,1,3,6,3,'2KG',15.00,NULL,'1','2021',1607627366,1607627366,1,1),(8,1,3,1,3,'2KG',15.00,NULL,'1','2021',1607627366,1607627366,1,1),(9,1,3,3,3,'2KG',15.00,NULL,'1','2021',1607627366,1607627366,1,1),(10,1,3,4,3,'5KG',25.00,NULL,'1','2021',1607627366,1607627366,1,1),(11,1,3,5,3,'10KG',50.00,NULL,'1','2021',1607627366,1607627366,1,1),(12,1,3,3,3,'10KG',30.00,NULL,'1','2021',1607627366,1607627366,1,1),(13,2,4,2,3,'2Kg',2.00,NULL,'1','2021',1611076848,1611076848,10,10),(14,2,4,2,3,'15KG',20.00,NULL,'2','2021',1614013880,1614013880,10,10),(15,2,4,11,3,'10kg',20.00,NULL,'10','2021',1614013941,1614013941,10,10),(16,2,4,11,3,'Rolls',20.00,NULL,'2','2021',1614071294,1628157144,10,10),(17,2,4,5,3,'25Kg',100.00,NULL,'2','2021',1614071294,1614071294,10,10);
/*!40000 ALTER TABLE `commodity_price_collection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodity_price_level`
--

DROP TABLE IF EXISTS `commodity_price_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commodity_price_level` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(45) NOT NULL,
  `description` text,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commodity_type` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commodity_type_1_idx` (`category_id`),
  CONSTRAINT `fk_commodity_type_1` FOREIGN KEY (`category_id`) REFERENCES `commodity_category` (`id`)
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
-- Table structure for table `conf_hourly_rates`
--

DROP TABLE IF EXISTS `conf_hourly_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conf_hourly_rates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(45) NOT NULL,
  `salary_scale` varchar(50) NOT NULL,
  `rate` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Recommended Government daily rate per hour based on salary scale of job holder',
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_hourly_rates`
--

LOCK TABLES `conf_hourly_rates` WRITE;
/*!40000 ALTER TABLE `conf_hourly_rates` DISABLE KEYS */;
INSERT INTO `conf_hourly_rates` VALUES (1,'PCO','06',500.00,1607446739,1627564708,1,1);
/*!40000 ALTER TABLE `conf_hourly_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `district` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `province_id` int unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `long` varchar(20) DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province_idx` (`province_id`),
  CONSTRAINT `fk_district_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb3;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lkm_storyofchange` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
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
  `status` int NOT NULL DEFAULT '0',
  `paio_review_status` int DEFAULT '0',
  `paio_comments` text,
  `ikmo_review_status` int DEFAULT '0',
  `ikmo_comments` text,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `camp_id` int DEFAULT NULL,
  `district_id` int DEFAULT NULL,
  `province_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lkm_storyofchange_1_idx` (`category_id`),
  CONSTRAINT `fk_lkm_storyofchange_1` FOREIGN KEY (`category_id`) REFERENCES `lkm_storyofchange_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange`
--

LOCK TABLES `lkm_storyofchange` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange` DISABLE KEYS */;
INSERT INTO `lkm_storyofchange` VALUES (2,3,'Test','Upendo Chulu','Francis Chulu','2021-01-11','<p><strong>My story introduction<br></strong></p><p>Yes this is my introduction of this story</p>','<p>The challenges</p>','<p>Story Actions</p>','<p><strong>The results</strong></p>','<p>The conclusions</p>','<p><strong>The sequel</strong></p>',0,0,NULL,1,'Story accepted',1610388925,1614019554,1,1,NULL,NULL,NULL),(3,4,'From subsistence to commercial farming-Case of Mr. Chulu','Francis Chulu','Edson Chulu','2021-01-12','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.<span class=\"redactor-invisible-space\"></span></p>',0,0,NULL,1,'',1610472852,1614020092,10,1,NULL,2,1),(5,3,'From subsistence to commercial farming-Case of Chulu','Francis Chulu','Test names','2021-02-16','<p>Introduction</p>','<p>Challenges<br></p>','<p>The actions<br></p>','The results','Conclusion','Sequel',0,0,NULL,0,NULL,1614019196,1614019397,10,10,NULL,2,1),(6,4,'From subsistence to commercial farming-Case of Mr Chulu Francis','Francis Chulu','Edson Chulu','2021-02-09','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',1,0,NULL,1,'',1614070456,1624898204,10,1,NULL,2,1),(7,3,'From subsistence to commercial farming test','Upendo Chulu','Francis Chulu','2021-03-10','<p>test</p>','<p>test</p>','<p>action</p>','<p>results</p>','<p>test<br></p>','<p>sequel</p>',1,0,NULL,1,'',1618996486,1618996726,10,1,NULL,2,1),(8,3,'Farming story','Farmer names','My names','2021-05-29','<p>Test introduction</p>','<p>Challenge one</p>','<p>Actions</p>','<p>Result</p>','<p>Conclusions</p>','<p>Next steps</p><p><br></p>',1,0,NULL,1,'',1622279337,1622279541,10,1,NULL,2,1);
/*!40000 ALTER TABLE `lkm_storyofchange` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lkm_storyofchange_article`
--

DROP TABLE IF EXISTS `lkm_storyofchange_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lkm_storyofchange_article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `story_id` int DEFAULT NULL,
  `article_type` varchar(255) DEFAULT NULL,
  `description` text,
  `file` varchar(255) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `file_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lkm_storyofchange_article`
--

LOCK TABLES `lkm_storyofchange_article` WRITE;
/*!40000 ALTER TABLE `lkm_storyofchange_article` DISABLE KEYS */;
INSERT INTO `lkm_storyofchange_article` VALUES (5,3,NULL,'Article description','DWpPgMuaYfz35QYbjzXdl86Rz03k2Avk.pdf',1610993207,1610993525,1,1,'my sample.pdf'),(6,2,NULL,'Description','JXqdPvl27LGf0T51dn54_yOxRqF4deXk.pdf',1614019624,1614019624,1,1,'my sample.pdf'),(7,6,NULL,'','_KDjaAkOc32clJN1sKBeKHCnTRUhjzIi.pdf',1614070974,1614070974,1,1,'my sample.pdf'),(8,7,NULL,'','mvxMFs5PxGYVPLu9AVAlY6xU9qBXzqMW.pdf',1618996769,1618996769,1,1,'my sample.pdf'),(9,8,NULL,'','DJxF6Pzd8BHAT3R3RsIpmTjanHKow9jj.pdf',1622279606,1622279606,1,1,'my sample.pdf');
/*!40000 ALTER TABLE `lkm_storyofchange_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lkm_storyofchange_category`
--

DROP TABLE IF EXISTS `lkm_storyofchange_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lkm_storyofchange_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT 'Story category name',
  `description` text COMMENT 'Story category description',
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lkm_storyofchange_interview_guide_template_questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section` varchar(45) NOT NULL,
  `number` varchar(4) NOT NULL,
  `question` text NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lkm_storyofchange_media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `story_id` int NOT NULL,
  `media_type` text NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lkm_storyofchange_media_1_idx` (`story_id`),
  CONSTRAINT `fk_lkm_storyofchange_media_1` FOREIGN KEY (`story_id`) REFERENCES `lkm_storyofchange` (`id`)
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `market` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_market_1_idx` (`district_id`),
  CONSTRAINT `fk_market_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
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
-- Table structure for table `me_back_to_office_annexes`
--

DROP TABLE IF EXISTS `me_back_to_office_annexes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_back_to_office_annexes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `btor_id` int NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_back_to_office_annexes_1_idx` (`btor_id`),
  CONSTRAINT `fk_me_back_to_office_annexes_1` FOREIGN KEY (`btor_id`) REFERENCES `me_back_to_office_report` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_back_to_office_annexes`
--

LOCK TABLES `me_back_to_office_annexes` WRITE;
/*!40000 ALTER TABLE `me_back_to_office_annexes` DISABLE KEYS */;
INSERT INTO `me_back_to_office_annexes` VALUES (6,1,'V9XfYkKs46FLVtZ2hHdRmobydYhTtjp2oYKO2FbJiptux.mp4','sample video.mp4','Video'),(9,1,'ry2Vh1FfV5sEHq7-0ik4kmHRztYzTUk_0ETkvNKxmXX_L.jpg','user1.jpg','Image'),(10,1,'NJYELhVsvMtZpbfQ6vYp1oduYHbjgyl-r1SmjUKeIi2cW.jpg','user1.jpg','Image');
/*!40000 ALTER TABLE `me_back_to_office_annexes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_back_to_office_report`
--

DROP TABLE IF EXISTS `me_back_to_office_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_back_to_office_report` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `status` int NOT NULL DEFAULT '0' COMMENT 'Pending submission for review=0, Reviewed and accepted=1,Submitted for review=2,Reviewed and sent back for more information=3',
  `reviewer_comments` varchar(45) DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_back_to_office_report`
--

LOCK TABLES `me_back_to_office_report` WRITE;
/*!40000 ALTER TABLE `me_back_to_office_report` DISABLE KEYS */;
INSERT INTO `me_back_to_office_report` VALUES (1,'2021-03-10','2021-03-12','test  Test','Francis  Chulu','<p>Partners</p>','<p>Purpose</p>','<p>Summary</p>','<p>Findings</p>','<p>Recommedations</p>',NULL,'',1,'',1615321516,1625578272,10,1),(2,'2021-03-09','2021-03-12','test  Test','Chulu  Francis, Test  Test','<p>Partners</p>','<p>Lorem ipsum</p>','<p>Lorem ipsum</p>','<p>Lorem ipsum</p>','<p>Lorem ipsum</p>',NULL,'',0,'',1617129037,1617129133,10,1),(3,'2021-03-24','2021-03-27','test  Test','Francis  Chulu, test test','<p>lorem ipsum</p>','<p>lorem ipsum</p>','<p>lorem ipsum</p>','<p>lorem ipsum</p>','<p>lorem ipsum</p>',NULL,'',0,'',1617178995,1617179107,10,1);
/*!40000 ALTER TABLE `me_back_to_office_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_awpb_objectives`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_awpb_objectives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_camp_subproject_records_awpb_objectives` (
  `id` int NOT NULL AUTO_INCREMENT,
  `camp_id` int unsigned NOT NULL,
  `quarter` int NOT NULL,
  `key_indicators` text NOT NULL,
  `period_unit` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `year` varchar(5) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_records_awpb_objectives_1_idx` (`camp_id`),
  CONSTRAINT `fk_me_camp_subproject_records_awpb_objectives_1` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`)
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_camp_subproject_records_improved_tech_facilitation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `camp_id` int unsigned NOT NULL,
  `output_level_indicator_id` int NOT NULL,
  `year` varchar(5) NOT NULL,
  `quarter` varchar(4) DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_improved_tech_facilitation_1_idx` (`output_level_indicator_id`),
  CONSTRAINT `fk_me_camp_subproject_improved_tech_facilitation_1` FOREIGN KEY (`output_level_indicator_id`) REFERENCES `me_camp_subproject_records_output_level_indicators` (`id`)
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_camp_subproject_records_monthly_planned_activities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `work_effort_id` int NOT NULL,
  `activity_id` int NOT NULL,
  `faabs_id` int NOT NULL,
  `zone` varchar(45) DEFAULT NULL,
  `activity_target` varchar(255) DEFAULT NULL,
  `beneficiary_target_total` int DEFAULT '0',
  `beneficiary_target_women` varchar(45) NOT NULL DEFAULT '0',
  `beneficiary_target_youth` varchar(45) NOT NULL DEFAULT '0',
  `beneficiary_target_women_headed` varchar(45) NOT NULL DEFAULT '0',
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_records_monthly_planned_activities_1_idx` (`faabs_id`),
  KEY `fk_me_camp_subproject_records_monthly_planned_activities_2_idx` (`work_effort_id`),
  CONSTRAINT `fk_me_camp_subproject_records_monthly_planned_activities_1` FOREIGN KEY (`faabs_id`) REFERENCES `me_faabs_groups` (`id`),
  CONSTRAINT `fk_me_camp_subproject_records_monthly_planned_activities_2` FOREIGN KEY (`work_effort_id`) REFERENCES `me_camp_subproject_records_planned_work_effort` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_monthly_planned_activities`
--

LOCK TABLES `me_camp_subproject_records_monthly_planned_activities` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_monthly_planned_activities` DISABLE KEYS */;
INSERT INTO `me_camp_subproject_records_monthly_planned_activities` VALUES (14,14,37,3,'Zone','1',7,'1','3','3',1616679511,1616679511,10,10),(15,14,39,3,'Zone','1',7,'2','2','3',1617179520,1617179520,10,10),(16,13,37,3,'Zone','1',3,'1','1','1',1618423737,1618423737,10,10),(17,15,1,3,'Zone','2',10,'2','2','6',1621772200,1621772200,10,10),(19,17,99,1,'Zone','99',25,'10','9','6',1625591437,1625591437,10,10);
/*!40000 ALTER TABLE `me_camp_subproject_records_monthly_planned_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_monthly_planned_activities_actual`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_monthly_planned_activities_actual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_camp_subproject_records_monthly_planned_activities_actual` (
  `id` int NOT NULL AUTO_INCREMENT,
  `planned_activity_id` int NOT NULL,
  `hours_worked_field` varchar(2) NOT NULL DEFAULT '0',
  `hours_worked_office` varchar(2) NOT NULL DEFAULT '0',
  `hours_worked_total` varchar(4) DEFAULT '0',
  `achieved_activity_target` varchar(45) NOT NULL,
  `beneficiary_target_achieved_total` varchar(45) DEFAULT '0',
  `beneficiary_target_achieved_women` varchar(45) DEFAULT '0',
  `beneficiary_target_achieved_youth` varchar(45) DEFAULT '0',
  `beneficiary_target_achieved_women_headed` varchar(45) DEFAULT '0',
  `remarks` text,
  `year` varchar(5) DEFAULT NULL,
  `month` varchar(3) DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_new_table_2_idx` (`planned_activity_id`),
  CONSTRAINT `fk_new_table_2` FOREIGN KEY (`planned_activity_id`) REFERENCES `me_camp_subproject_records_monthly_planned_activities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_monthly_planned_activities_actual`
--

LOCK TABLES `me_camp_subproject_records_monthly_planned_activities_actual` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_monthly_planned_activities_actual` DISABLE KEYS */;
INSERT INTO `me_camp_subproject_records_monthly_planned_activities_actual` VALUES (1,14,'1','1','2','1','31','18','5','8','',NULL,NULL,1617129988,1617129988,10,10),(2,15,'1','10','11','1','12','4','4','4','',NULL,NULL,1617179689,1617179689,10,10),(3,16,'1','1','2','1','3','1','1','1','',NULL,NULL,1618423751,1618423751,10,10),(7,19,'6','5','11','50','27','18','2','7','',NULL,NULL,1625594530,1625594530,10,10);
/*!40000 ALTER TABLE `me_camp_subproject_records_monthly_planned_activities_actual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_output_level_indicators`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_output_level_indicators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_camp_subproject_records_output_level_indicators` (
  `id` int NOT NULL AUTO_INCREMENT,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_camp_subproject_records_planned_work_effort` (
  `id` int NOT NULL AUTO_INCREMENT,
  `camp_id` int unsigned NOT NULL,
  `year` int NOT NULL,
  `month` varchar(15) NOT NULL,
  `days_in_month` int NOT NULL,
  `days_field` int NOT NULL DEFAULT '0',
  `days_office` int NOT NULL DEFAULT '0',
  `days_total` int DEFAULT '0' COMMENT 'Field days + Office days',
  `days_other_non_esapp_activities` int DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_records_planned_work_effort_1_idx` (`camp_id`),
  CONSTRAINT `fk_me_camp_subproject_records_planned_work_effort_1` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_camp_subproject_records_planned_work_effort`
--

LOCK TABLES `me_camp_subproject_records_planned_work_effort` WRITE;
/*!40000 ALTER TABLE `me_camp_subproject_records_planned_work_effort` DISABLE KEYS */;
INSERT INTO `me_camp_subproject_records_planned_work_effort` VALUES (13,6,2021,'3',31,12,12,24,2,1616678720,1616678720,10,10),(14,5,2021,'3',31,6,4,10,7,1616678740,1616751023,10,10),(15,5,2021,'5',31,2,2,4,3,1621770811,1621770811,10,10),(16,7,2021,'5',31,3,2,5,12,1622286786,1622286786,10,10),(17,7,2021,'7',31,15,10,25,6,1625561338,1625561338,10,10),(18,7,2021,'8',31,1,20,21,1,1628104985,1628104985,10,10);
/*!40000 ALTER TABLE `me_camp_subproject_records_planned_work_effort` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_camp_subproject_records_subcomponents`
--

DROP TABLE IF EXISTS `me_camp_subproject_records_subcomponents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_camp_subproject_records_subcomponents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `facilitation_id` int NOT NULL,
  `sub_component` varchar(255) NOT NULL,
  `females` varchar(45) NOT NULL DEFAULT '0',
  `males` varchar(45) NOT NULL DEFAULT '0',
  `women_headed` varchar(45) NOT NULL DEFAULT '0',
  `youth` varchar(45) NOT NULL DEFAULT '0',
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_camp_subproject_records_subcomponents_1_idx` (`facilitation_id`),
  CONSTRAINT `fk_me_camp_subproject_records_subcomponents_1` FOREIGN KEY (`facilitation_id`) REFERENCES `me_camp_subproject_records_improved_tech_facilitation` (`id`)
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_faabs_category_a_farmers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faabs_group_id` int NOT NULL,
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
  `status` int NOT NULL DEFAULT '1',
  `household_size` int DEFAULT '0',
  `village` varchar(255) DEFAULT NULL,
  `chiefdom` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `commodity` varchar(255) DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `title` varchar(10) NOT NULL,
  `age` int DEFAULT NULL,
  `household_head_type` enum('Female headed','Male headed') DEFAULT 'Male headed' COMMENT 'Female headed or Male headed',
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_faabs_farmer_register_1_idx` (`faabs_group_id`),
  CONSTRAINT `fk_me_faabs_category_a_farmers` FOREIGN KEY (`faabs_group_id`) REFERENCES `me_faabs_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faabs_category_a_farmers`
--

LOCK TABLES `me_faabs_category_a_farmers` WRITE;
/*!40000 ALTER TABLE `me_faabs_category_a_farmers` DISABLE KEYS */;
INSERT INTO `me_faabs_category_a_farmers` VALUES (1,3,'Francis','','Chulu','Male','1990-06-05','1828672/12/34','Married','+260978981455','','2021-03-03',1,10,'Village one','Chiefdom','Block','Zone','Commodity',1615132100,1616709828,10,10,'Mr.',30,'Male headed',NULL,NULL),(2,3,'Francis','','test','Male','1989-07-19','1828672/12/00','Single','','','2021-03-25',1,NULL,'','','','','',1616709481,1616709903,10,10,'Mr.',31,'Male headed',NULL,NULL),(3,1,'First ','','Last name','Female','1980-07-23','1828672/12/09','Married','','','2021-03-26',1,6,'Village one','Chiefdom','Block','Zone','Commodity',1616764476,1616764476,10,10,'Mrs.',40,'Male headed',NULL,NULL),(4,3,'Francis','','Other name','Male','1981-07-30','1828672/12/1','Married','','','2020-03-11',1,NULL,'','','','','',1621769681,1621769895,10,10,'Mr.',39,'Male headed',NULL,NULL);
/*!40000 ALTER TABLE `me_faabs_category_a_farmers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_faabs_groups`
--

DROP TABLE IF EXISTS `me_faabs_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_faabs_groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `camp_id` int unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` int DEFAULT '1',
  `created_at` int unsigned NOT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `max_farmer_graduation_training_topics` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_me_faabs_groups_1_idx` (`camp_id`),
  CONSTRAINT `fk_me_faabs_groups_1` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faabs_groups`
--

LOCK TABLES `me_faabs_groups` WRITE;
/*!40000 ALTER TABLE `me_faabs_groups` DISABLE KEYS */;
INSERT INTO `me_faabs_groups` VALUES (1,5,'FaaBS One','FO',1,1607263313,'-14.72048826007502','28.090678349761973',1625092460,1,10,1),(3,5,'Come together Group',NULL,1,1615123711,'-13.889884','28.368405',1625084332,10,10,2),(4,7,'Come together group 3',NULL,1,1626339487,'-13.978395513644172','28.68148316505433',1626339487,10,10,5);
/*!40000 ALTER TABLE `me_faabs_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_faabs_register`
--

DROP TABLE IF EXISTS `me_faabs_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_faabs_register` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faabs_group_id` int NOT NULL,
  `farmer_id` int NOT NULL,
  `present` enum('Yes','No') DEFAULT 'Yes',
  `date` date NOT NULL,
  `topic` mediumtext NOT NULL COMMENT 'Topic or session covered i.e. Village Chicken housing',
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_faabs_register_1_idx` (`farmer_id`),
  KEY `fk_me_faabs_register_2_idx` (`faabs_group_id`),
  CONSTRAINT `fk_me_faabs_register_1` FOREIGN KEY (`farmer_id`) REFERENCES `me_faabs_category_a_farmers` (`id`),
  CONSTRAINT `fk_me_faabs_register_2` FOREIGN KEY (`faabs_group_id`) REFERENCES `me_faabs_groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_faabs_training_attendance_sheet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faabs_group_id` int NOT NULL,
  `farmer_id` int NOT NULL,
  `household_head_type` varchar(45) DEFAULT 'Male headed' COMMENT 'Female headed or Male headed',
  `topic` text NOT NULL COMMENT 'Training course',
  `facilitators` text NOT NULL COMMENT 'Facilitators/Organisation',
  `partner_organisations` text,
  `training_date` date NOT NULL,
  `duration` varchar(10) NOT NULL COMMENT 'Duration hours and minutes',
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `full_names` varchar(255) DEFAULT NULL,
  `youth_non_youth` enum('Youth','Non Youth') DEFAULT NULL,
  `marital_status` varchar(45) DEFAULT NULL,
  `sex` varchar(45) DEFAULT NULL,
  `year_of_birth` varchar(6) DEFAULT NULL,
  `quarter` varchar(2) DEFAULT NULL,
  `topic_indicator` text,
  `topic_subcomponent` varchar(45) DEFAULT NULL,
  `training_type` text,
  PRIMARY KEY (`id`),
  KEY `fk_me_faabs_training_attendance_sheet_1_idx` (`farmer_id`),
  KEY `fk_me_faabs_training_attendance_sheet_2_idx` (`faabs_group_id`),
  CONSTRAINT `fk_me_faabs_training_attendance_sheet_1` FOREIGN KEY (`farmer_id`) REFERENCES `me_faabs_category_a_farmers` (`id`),
  CONSTRAINT `fk_me_faabs_training_attendance_sheet_2` FOREIGN KEY (`faabs_group_id`) REFERENCES `me_faabs_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faabs_training_attendance_sheet`
--

LOCK TABLES `me_faabs_training_attendance_sheet` WRITE;
/*!40000 ALTER TABLE `me_faabs_training_attendance_sheet` DISABLE KEYS */;
INSERT INTO `me_faabs_training_attendance_sheet` VALUES (9,3,1,'','3','Facilitator names','','2021-04-06','12:30',1618397385,1618398329,10,10,NULL,'Non Youth',NULL,'Male',NULL,'2','Number of smallholders trained in the use of improved production technologies & best practices to enhance productivity that allow production to comply with market requirements (at least 3 improved production technologies facilitated)','Sub-component 2.2','Participants under non-Direct/Other Training [Stream 2]'),(10,3,1,'Male headed','5','Facilitator names','','2021-04-12','13:00',1618917211,1621769908,10,10,NULL,'Non Youth',NULL,'Male',NULL,'2','Number of local service providers (farm & non-farm) strengthened and/or trained to provide services that allow production to meet market requirements [Strengthening of coordination & business models] ','Sub-component 2.1','Participants under Direct/Intensive Training [Stream 1]');
/*!40000 ALTER TABLE `me_faabs_training_attendance_sheet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_faabs_training_topic_enrolment`
--

DROP TABLE IF EXISTS `me_faabs_training_topic_enrolment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_faabs_training_topic_enrolment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faabs_id` int NOT NULL,
  `training_type` varchar(255) NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_faabs_training_topic_enrolment_1_idx` (`faabs_id`),
  KEY `fk_me_faabs_training_topic_enrolment_2_idx` (`topic_id`),
  CONSTRAINT `fk_me_faabs_training_topic_enrolment_1` FOREIGN KEY (`faabs_id`) REFERENCES `me_faabs_groups` (`id`),
  CONSTRAINT `fk_me_faabs_training_topic_enrolment_2` FOREIGN KEY (`topic_id`) REFERENCES `me_faabs_training_topics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faabs_training_topic_enrolment`
--

LOCK TABLES `me_faabs_training_topic_enrolment` WRITE;
/*!40000 ALTER TABLE `me_faabs_training_topic_enrolment` DISABLE KEYS */;
INSERT INTO `me_faabs_training_topic_enrolment` VALUES (14,1,'Participants under non-Direct/Other Training [Stream 2]',2),(15,1,'Participants under non-Direct/Other Training [Stream 2]',3),(16,1,'Participants under non-Direct/Other Training [Stream 2]',4),(28,3,'Participants under Direct/Intensive Training [Stream 1]',2),(29,3,'Participants under Direct/Intensive Training [Stream 1]',3),(30,3,'Participants under Direct/Intensive Training [Stream 1]',4),(31,3,'Participants under Direct/Intensive Training [Stream 1]',5),(32,3,'Participants under Direct/Intensive Training [Stream 1]',6);
/*!40000 ALTER TABLE `me_faabs_training_topic_enrolment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_faabs_training_topics`
--

DROP TABLE IF EXISTS `me_faabs_training_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_faabs_training_topics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `topic` text NOT NULL,
  `output_level_indicator` text NOT NULL,
  `category` text NOT NULL,
  `subcomponent` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_faabs_training_topics`
--

LOCK TABLES `me_faabs_training_topics` WRITE;
/*!40000 ALTER TABLE `me_faabs_training_topics` DISABLE KEYS */;
INSERT INTO `me_faabs_training_topics` VALUES (2,'Production enhancing technologies: early planting','Number of smallholders trained in the use of improved production technologies & best practices to enhance productivity that allow production to comply with market requirements (at least 3 improved production technologies facilitated)','Crops','Sub-component 2.1'),(3,'Production enhancing technologies: row planting,','Number of smallholders trained in the use of improved production technologies & best practices to enhance productivity that allow production to comply with market requirements (at least 3 improved production technologies facilitated)','Crops','Sub-component 2.2'),(4,'Production enhancing technologies: construct and use improved livestock housing','Number of smallholders trained in improved Post-harvest technologies (at least 2 improved post-harvest technologies)','Livestock','Sub-component 2.2'),(5,'Test topic 1','Number of local service providers (farm & non-farm) strengthened and/or trained to provide services that allow production to meet market requirements [Strengthening of coordination & business models] ','Aquaculture','Sub-component 2.1'),(6,'Test topic 2','Number of smallholder producers (desegregated by gender) in organizations/cooperatives/marketing groups trained in crucial aspects for inclusion in VC i.e. identification of partnership opportunities, negotiation, market linkages, business management, governance etc [Strengthening of coordination & business models] ','Livestock','Sub-component 2.2'),(7,'Test topic 3','Number of smallholders trained in improved Post-harvest technologies (at least 2 improved post-harvest technologies)','Crops','Sub-component 2.1'),(8,'test topic','Number of smallholders trained in the use of improved production technologies & best practices to enhance productivity that allow production to comply with market requirements (at least 3 improved production technologies facilitated)','Crops','Sub-component 2.1');
/*!40000 ALTER TABLE `me_faabs_training_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_field_monitoring_checklist_issues`
--

DROP TABLE IF EXISTS `me_field_monitoring_checklist_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_field_monitoring_checklist_issues` (
  `id` int NOT NULL AUTO_INCREMENT,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_field_monitoring_checklists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_id` int DEFAULT NULL,
  `province_id` int DEFAULT NULL,
  `issue_id` int NOT NULL,
  `addressed` enum('Yes','No') NOT NULL DEFAULT 'No',
  `comments` varchar(45) DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_field_monitoring_checklists_1_idx` (`issue_id`),
  CONSTRAINT `fk_me_field_monitoring_checklists_1` FOREIGN KEY (`issue_id`) REFERENCES `me_field_monitoring_checklist_issues` (`id`)
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
-- Table structure for table `me_quarterly_operations_funds_requisition`
--

DROP TABLE IF EXISTS `me_quarterly_operations_funds_requisition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_quarterly_operations_funds_requisition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quarter_workplan_id` int NOT NULL,
  `budget_estimate_month_1` varchar(50) DEFAULT '0',
  `budget_estimate_month_2` varchar(50) DEFAULT '0',
  `budget_estimate_month_3` varchar(50) DEFAULT '0',
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_me_quarterly_operations_funds_requisition_1_idx` (`quarter_workplan_id`),
  CONSTRAINT `fk_me_quarterly_operations_funds_requisition_1` FOREIGN KEY (`quarter_workplan_id`) REFERENCES `me_quarterly_work_plan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_quarterly_operations_funds_requisition`
--

LOCK TABLES `me_quarterly_operations_funds_requisition` WRITE;
/*!40000 ALTER TABLE `me_quarterly_operations_funds_requisition` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_quarterly_operations_funds_requisition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_quarterly_outreach_records`
--

DROP TABLE IF EXISTS `me_quarterly_outreach_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_quarterly_outreach_records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component` text NOT NULL,
  `sub_component` text NOT NULL,
  `province_id` int DEFAULT NULL,
  `district_id` int DEFAULT NULL,
  `year` varchar(5) NOT NULL,
  `quarter` tinyint NOT NULL,
  `number_females` int NOT NULL DEFAULT '0',
  `number_males` int NOT NULL DEFAULT '0',
  `number_young` int NOT NULL DEFAULT '0',
  `number_not_young` int NOT NULL DEFAULT '0',
  `number_women_headed_households` int NOT NULL DEFAULT '0',
  `number_non_women_headed_households` int DEFAULT '0',
  `number_households` int NOT NULL DEFAULT '0',
  `number_household_members` int NOT NULL DEFAULT '0',
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_quarterly_outreach_records`
--

LOCK TABLES `me_quarterly_outreach_records` WRITE;
/*!40000 ALTER TABLE `me_quarterly_outreach_records` DISABLE KEYS */;
INSERT INTO `me_quarterly_outreach_records` VALUES (3,'Component 2: Sustainable Agribusiness Partnerships','2.1: Strategic Linkages of Graduating Subsistence Farmers',1,2,'2021',1,10,20,15,15,10,0,20,50,1625654301,1625655308,10,10),(4,'Component 2: Sustainable Agribusiness Partnerships','2.2: Enhancing Agro-Micro, Small & Medium Enterprises',1,2,'2021',2,10,12,9,13,10,0,30,40,1625655366,1625655366,10,10),(5,'Component 2: Sustainable Agribusiness Partnerships','2.3: Facilitating Pro-Smallholder Market-Pull Agribusiness',1,2,'2021',3,5,5,3,7,5,0,10,20,1625655406,1625655406,10,10),(6,'Component 2: Sustainable Agribusiness Partnerships','2.1: Strategic Linkages of Graduating Subsistence Farmers',1,2,'2021',4,20,10,10,20,20,0,40,90,1625655454,1625655454,10,10),(7,'Component 2: Sustainable Agribusiness Partnerships','2.1: Strategic Linkages of Graduating Subsistence Farmers',1,2,'2017',1,10,20,10,10,5,6,0,20,1625679617,1625679617,10,10),(8,'Component 2: Sustainable Agribusiness Partnerships','2.2: Enhancing Agro-Micro, Small & Medium Enterprises',1,2,'2017',2,12,10,10,12,10,10,0,30,1625679648,1625679648,10,10),(9,'Component 2: Sustainable Agribusiness Partnerships','2.3: Facilitating Pro-Smallholder Market-Pull Agribusiness',1,2,'2017',4,10,10,10,10,10,10,0,20,1625679675,1625679675,10,10),(10,'Component 2: Sustainable Agribusiness Partnerships','2.3: Facilitating Pro-Smallholder Market-Pull Agribusiness',1,2,'2017',3,5,5,5,5,5,5,0,15,1625679718,1625679718,10,10);
/*!40000 ALTER TABLE `me_quarterly_outreach_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_quarterly_work_plan`
--

DROP TABLE IF EXISTS `me_quarterly_work_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `me_quarterly_work_plan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_id` int NOT NULL,
  `province_id` int NOT NULL,
  `district_id` int NOT NULL,
  `month` int NOT NULL,
  `quarter` varchar(15) NOT NULL,
  `year` varchar(5) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `district_approval_status` int NOT NULL DEFAULT '0',
  `provincial_approval_status` int NOT NULL,
  `Remarks` text NOT NULL,
  `esapp_comments` text,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_quarterly_work_plan`
--

LOCK TABLES `me_quarterly_work_plan` WRITE;
/*!40000 ALTER TABLE `me_quarterly_work_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_quarterly_work_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_activity`
--

DROP TABLE IF EXISTS `mgf_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_no` int NOT NULL,
  `activity_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `componet_id` int NOT NULL,
  `inputs` int NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `componet_id` (`componet_id`),
  KEY `createdby` (`createdby`),
  CONSTRAINT `mgf_activity_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_activity_ibfk_2` FOREIGN KEY (`componet_id`) REFERENCES `mgf_component` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_activity`
--

LOCK TABLES `mgf_activity` WRITE;
/*!40000 ALTER TABLE `mgf_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_applicant`
--

DROP TABLE IF EXISTS `mgf_applicant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_applicant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationalid` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `applicant_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `organisation_id` int DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `fk_applicant_district` (`district_id`),
  KEY `fk_mgf_applicant_1_idx` (`province_id`),
  CONSTRAINT `fk_applicant_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_mgf_applicant_1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `mgf_applicant_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_applicant`
--

LOCK TABLES `mgf_applicant` WRITE;
/*!40000 ALTER TABLE `mgf_applicant` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_applicant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_application`
--

DROP TABLE IF EXISTS `mgf_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_application` (
  `id` int NOT NULL AUTO_INCREMENT,
  `attachements` int DEFAULT NULL,
  `applicant_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `application_status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Initialized',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_submitted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `applicant_id` (`applicant_id`),
  CONSTRAINT `mgf_application_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `mgf_applicant` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_application_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_application`
--

LOCK TABLES `mgf_application` WRITE;
/*!40000 ALTER TABLE `mgf_application` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_approval`
--

DROP TABLE IF EXISTS `mgf_approval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_approval` (
  `id` int NOT NULL AUTO_INCREMENT,
  `application_id` int NOT NULL,
  `conceptnote_id` int NOT NULL,
  `scores` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `review_remark` text COLLATE utf8mb4_unicode_ci,
  `review_submission` timestamp NULL DEFAULT NULL,
  `reviewed_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certify_remark` text COLLATE utf8mb4_unicode_ci,
  `certify_submission` timestamp NULL DEFAULT NULL,
  `certified_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review2_remark` text COLLATE utf8mb4_unicode_ci,
  `review2_submission` timestamp NULL DEFAULT NULL,
  `reviewed2_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_remark` text COLLATE utf8mb4_unicode_ci,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `approved_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`),
  KEY `conceptnote_id` (`conceptnote_id`),
  CONSTRAINT `mgf_approval_ibfk_1` FOREIGN KEY (`conceptnote_id`) REFERENCES `mgf_concept_note` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_approval_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_approval`
--

LOCK TABLES `mgf_approval` WRITE;
/*!40000 ALTER TABLE `mgf_approval` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_approval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_approval_status`
--

DROP TABLE IF EXISTS `mgf_approval_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_approval_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `approval_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lowerlimit` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upperlimit` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `mgf_approval_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_approval_status`
--

LOCK TABLES `mgf_approval_status` WRITE;
/*!40000 ALTER TABLE `mgf_approval_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_approval_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_attachements`
--

DROP TABLE IF EXISTS `mgf_attachements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_attachements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_certificate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `articles_of_assoc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `audit_reports` text COLLATE utf8mb4_unicode_ci,
  `mou_contract` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `board_resolution` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_attachement` text COLLATE utf8mb4_unicode_ci,
  `organisation_id` int NOT NULL,
  `application_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_attachements_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_attachements_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_attachements`
--

LOCK TABLES `mgf_attachements` WRITE;
/*!40000 ALTER TABLE `mgf_attachements` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_attachements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_component`
--

DROP TABLE IF EXISTS `mgf_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_component` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component_no` int NOT NULL,
  `component_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `proposal_id` int NOT NULL,
  `activities` int NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proposal_id` (`proposal_id`),
  KEY `createdby` (`createdby`),
  CONSTRAINT `mgf_component_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_component_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_component`
--

LOCK TABLES `mgf_component` WRITE;
/*!40000 ALTER TABLE `mgf_component` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_concept_note`
--

DROP TABLE IF EXISTS `mgf_concept_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_concept_note` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estimated_cost` decimal(12,2) NOT NULL,
  `starting_date` date NOT NULL,
  `operation_id` int NOT NULL,
  `implimentation_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_operation_type` text COLLATE utf8mb4_unicode_ci,
  `application_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_submitted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operation_id` (`operation_id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `application_id` (`application_id`),
  CONSTRAINT `mgf_concept_note_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_concept_note_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_concept_note_ibfk_3` FOREIGN KEY (`operation_id`) REFERENCES `mgf_operation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_concept_note`
--

LOCK TABLES `mgf_concept_note` WRITE;
/*!40000 ALTER TABLE `mgf_concept_note` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_concept_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_contact`
--

DROP TABLE IF EXISTS `mgf_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int NOT NULL,
  `position_id` int NOT NULL,
  `applicant_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `applicant_id` (`applicant_id`),
  KEY `position_id` (`position_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_contact_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_contact_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `mgf_position` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_contact_ibfk_3` FOREIGN KEY (`applicant_id`) REFERENCES `mgf_applicant` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_contact`
--

LOCK TABLES `mgf_contact` WRITE;
/*!40000 ALTER TABLE `mgf_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_experience`
--

DROP TABLE IF EXISTS `mgf_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `financed_before` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `any_collaboration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collaboration_will` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collaboration_ready` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_experience_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_experience`
--

LOCK TABLES `mgf_experience` WRITE;
/*!40000 ALTER TABLE `mgf_experience` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_final_evaluation`
--

DROP TABLE IF EXISTS `mgf_final_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_final_evaluation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proposal_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `finalscore` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT '0',
  `finalcomment` text COLLATE utf8mb4_unicode_ci,
  `response` text COLLATE utf8mb4_unicode_ci,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proposal_id` (`proposal_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_final_evaluation_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_final_evaluation_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_final_evaluation`
--

LOCK TABLES `mgf_final_evaluation` WRITE;
/*!40000 ALTER TABLE `mgf_final_evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_final_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_input_cost`
--

DROP TABLE IF EXISTS `mgf_input_cost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_input_cost` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_no` int NOT NULL,
  `input_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_cost` decimal(9,2) NOT NULL,
  `project_year_1` decimal(9,2) unsigned DEFAULT NULL,
  `project_year_2` decimal(9,2) unsigned DEFAULT NULL,
  `project_year_3` decimal(9,2) unsigned DEFAULT NULL,
  `project_year_4` decimal(9,2) unsigned DEFAULT NULL,
  `project_year_5` decimal(9,2) unsigned NOT NULL,
  `project_year_6` decimal(9,2) unsigned NOT NULL,
  `project_year_7` decimal(9,2) unsigned NOT NULL,
  `project_year_8` decimal(9,2) unsigned NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `createdby` (`createdby`),
  CONSTRAINT `mgf_input_cost_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_input_cost_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `mgf_activity` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_input_cost`
--

LOCK TABLES `mgf_input_cost` WRITE;
/*!40000 ALTER TABLE `mgf_input_cost` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_input_cost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_input_item`
--

DROP TABLE IF EXISTS `mgf_input_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_input_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_no` int NOT NULL,
  `input_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measure` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_year_1` decimal(9,2) NOT NULL DEFAULT '0.00',
  `project_year_2` decimal(9,2) DEFAULT '0.00',
  `project_year_3` decimal(9,2) NOT NULL DEFAULT '0.00',
  `project_year_4` decimal(9,2) NOT NULL DEFAULT '0.00',
  `project_year_5` decimal(9,2) unsigned NOT NULL,
  `project_year_6` decimal(9,2) unsigned NOT NULL,
  `project_year_7` decimal(9,2) unsigned NOT NULL,
  `project_year_8` decimal(9,2) unsigned NOT NULL,
  `unit_cost` decimal(9,2) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `createdby` (`createdby`),
  CONSTRAINT `mgf_input_item_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_input_item_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `mgf_activity` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_input_item`
--

LOCK TABLES `mgf_input_item` WRITE;
/*!40000 ALTER TABLE `mgf_input_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_input_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_offer`
--

DROP TABLE IF EXISTS `mgf_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_offer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proposal_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amountoffered` decimal(12,2) NOT NULL,
  `contribution` decimal(12,2) NOT NULL,
  `responded` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_responde` timestamp NULL DEFAULT NULL,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `proposal_id` (`proposal_id`),
  KEY `createdby` (`createdby`),
  CONSTRAINT `mgf_offer_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_offer_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_offer_ibfk_3` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_offer`
--

LOCK TABLES `mgf_offer` WRITE;
/*!40000 ALTER TABLE `mgf_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_operation`
--

DROP TABLE IF EXISTS `mgf_operation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_operation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `operation_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `operation_type` (`operation_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_operation`
--

LOCK TABLES `mgf_operation` WRITE;
/*!40000 ALTER TABLE `mgf_operation` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_operation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_organisation`
--

DROP TABLE IF EXISTS `mgf_organisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_organisation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cooperative` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acronym` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_license_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` date NOT NULL,
  `business_objective` text COLLATE utf8mb4_unicode_ci,
  `email_address` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `physical_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `applicant_id` int NOT NULL,
  `is_active` int DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_address` (`email_address`),
  UNIQUE KEY `trade_license_no` (`trade_license_no`),
  UNIQUE KEY `registration_no` (`registration_no`),
  KEY `applicant_id` (`applicant_id`),
  KEY `fk_org_district` (`district_id`),
  KEY `fk_org_province_idx` (`province_id`),
  CONSTRAINT `fk_org_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_org_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_organisation_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `mgf_applicant` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_organisation`
--

LOCK TABLES `mgf_organisation` WRITE;
/*!40000 ALTER TABLE `mgf_organisation` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_organisation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_organisational_details`
--

DROP TABLE IF EXISTS `mgf_organisational_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_organisational_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mgt_Staff` int NOT NULL,
  `senior_Staff` int NOT NULL,
  `junior_Staff` int NOT NULL,
  `others` int NOT NULL,
  `last_board` date NOT NULL,
  `last_agm` date NOT NULL,
  `last_audit` date NOT NULL,
  `has_finance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_resources` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_organisational_details_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_organisational_details`
--

LOCK TABLES `mgf_organisational_details` WRITE;
/*!40000 ALTER TABLE `mgf_organisational_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_organisational_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_partnership`
--

DROP TABLE IF EXISTS `mgf_partnership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_partnership` (
  `id` int NOT NULL AUTO_INCREMENT,
  `partner_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partnership_aim` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `partnership_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_partnership_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_partnership`
--

LOCK TABLES `mgf_partnership` WRITE;
/*!40000 ALTER TABLE `mgf_partnership` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_partnership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_pastproject`
--

DROP TABLE IF EXISTS `mgf_pastproject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_pastproject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `years_assisted` int NOT NULL,
  `amount_assisted` decimal(10,0) NOT NULL,
  `obligations_met` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outcome_response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisation_id` int NOT NULL,
  `experience_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `experience_id` (`experience_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_pastproject_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_pastproject_ibfk_2` FOREIGN KEY (`experience_id`) REFERENCES `mgf_experience` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_pastproject`
--

LOCK TABLES `mgf_pastproject` WRITE;
/*!40000 ALTER TABLE `mgf_pastproject` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_pastproject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_position`
--

DROP TABLE IF EXISTS `mgf_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_position`
--

LOCK TABLES `mgf_position` WRITE;
/*!40000 ALTER TABLE `mgf_position` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_project_evaluation`
--

DROP TABLE IF EXISTS `mgf_project_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_project_evaluation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proposal_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `window` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `observation` text COLLATE utf8mb4_unicode_ci,
  `declaration` text COLLATE utf8mb4_unicode_ci,
  `totalscore` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `decision` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_submitted` timestamp NULL DEFAULT NULL,
  `date_reviewed` timestamp NULL DEFAULT NULL,
  `reviewedby` int NOT NULL,
  `signature` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `proposal_id` (`proposal_id`),
  KEY `reviewedby` (`reviewedby`),
  CONSTRAINT `mgf_project_evaluation_ibfk_1` FOREIGN KEY (`reviewedby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_project_evaluation_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_project_evaluation_ibfk_3` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_project_evaluation`
--

LOCK TABLES `mgf_project_evaluation` WRITE;
/*!40000 ALTER TABLE `mgf_project_evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_project_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_proposal`
--

DROP TABLE IF EXISTS `mgf_proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_proposal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_title` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mgf_no` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisation_id` int NOT NULL,
  `applicant_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date DEFAULT NULL,
  `project_length` int NOT NULL DEFAULT '0',
  `number_reviewers` int NOT NULL DEFAULT '0',
  `project_operations` text COLLATE utf8mb4_unicode_ci,
  `any_experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_response` text COLLATE utf8mb4_unicode_ci,
  `indicate_partnerships` text COLLATE utf8mb4_unicode_ci,
  `proposal_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Created',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_submitted` timestamp NULL DEFAULT NULL,
  `problem_statement` text COLLATE utf8mb4_unicode_ci,
  `overall_objective` text COLLATE utf8mb4_unicode_ci,
  `is_active` int DEFAULT '0',
  `totalcost` decimal(15,2) DEFAULT '0.00',
  `province_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `fk_prop_district` (`district_id`),
  KEY `fk_prop_province_idx` (`province_id`),
  CONSTRAINT `fk_prop_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_prop_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_proposal_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_proposal`
--

LOCK TABLES `mgf_proposal` WRITE;
/*!40000 ALTER TABLE `mgf_proposal` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_proposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_proposal_evaluation`
--

DROP TABLE IF EXISTS `mgf_proposal_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_proposal_evaluation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proposal_id` int NOT NULL,
  `criterion_id` int NOT NULL,
  `awardedscore` int DEFAULT NULL,
  `grade` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `criterion_id` (`criterion_id`),
  KEY `proposal_id` (`proposal_id`),
  KEY `createdby` (`createdby`),
  CONSTRAINT `mgf_proposal_evaluation_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_proposal_evaluation_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_proposal_evaluation_ibfk_3` FOREIGN KEY (`criterion_id`) REFERENCES `mgf_selection_criteria` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_proposal_evaluation`
--

LOCK TABLES `mgf_proposal_evaluation` WRITE;
/*!40000 ALTER TABLE `mgf_proposal_evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_proposal_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_reviewer`
--

DROP TABLE IF EXISTS `mgf_reviewer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_reviewer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_of_expertise` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `confirmed` int DEFAULT '0',
  `createdBy` int unsigned DEFAULT NULL,
  `total_assigned_1` int DEFAULT '0',
  `total_assigned_2` int DEFAULT '0',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_code` (`login_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_reviewer`
--

LOCK TABLES `mgf_reviewer` WRITE;
/*!40000 ALTER TABLE `mgf_reviewer` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_reviewer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_screening`
--

DROP TABLE IF EXISTS `mgf_screening`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_screening` (
  `id` int NOT NULL AUTO_INCREMENT,
  `conceptnote_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `criterion` text COLLATE utf8mb4_unicode_ci,
  `satisfactory` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `verified_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `conceptnote_id` (`conceptnote_id`),
  CONSTRAINT `mgf_screening_ibfk_1` FOREIGN KEY (`conceptnote_id`) REFERENCES `mgf_concept_note` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_screening_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_screening`
--

LOCK TABLES `mgf_screening` WRITE;
/*!40000 ALTER TABLE `mgf_screening` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_screening` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_selection_category`
--

DROP TABLE IF EXISTS `mgf_selection_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_selection_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  CONSTRAINT `mgf_selection_category_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_selection_category`
--

LOCK TABLES `mgf_selection_category` WRITE;
/*!40000 ALTER TABLE `mgf_selection_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_selection_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_selection_criteria`
--

DROP TABLE IF EXISTS `mgf_selection_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_selection_criteria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `criterion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `createdby` (`createdby`),
  CONSTRAINT `mgf_selection_criteria_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_selection_criteria_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `mgf_selection_category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_selection_criteria`
--

LOCK TABLES `mgf_selection_criteria` WRITE;
/*!40000 ALTER TABLE `mgf_selection_criteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_selection_criteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_selection_grade`
--

DROP TABLE IF EXISTS `mgf_selection_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_selection_grade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grade` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criterion_id` int NOT NULL,
  `awardedscore` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `criterion_id` (`criterion_id`),
  KEY `createdby` (`createdby`),
  CONSTRAINT `mgf_selection_grade_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mgf_selection_grade_ibfk_2` FOREIGN KEY (`criterion_id`) REFERENCES `mgf_selection_criteria` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_selection_grade`
--

LOCK TABLES `mgf_selection_grade` WRITE;
/*!40000 ALTER TABLE `mgf_selection_grade` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_selection_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mgf_unit`
--

DROP TABLE IF EXISTS `mgf_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_unit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unit` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `synonym` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unit` (`unit`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `mgf_unit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mgf_unit`
--

LOCK TABLES `mgf_unit` WRITE;
/*!40000 ALTER TABLE `mgf_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `mgf_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1621726502),('m130524_201442_init',1621726752),('m190124_110200_add_verification_token_column_to_user_table',1621726752),('m210521_150431_001_create_table_awpb_comment',1621726752),('m210521_150431_002_create_table_awpb_commodity_type',1621726752),('m210521_150431_003_create_table_awpb_consolidated',1621726752),('m210521_150431_004_create_table_awpb_expense_category',1621726753),('m210521_150431_005_create_table_awpb_funder',1621726753),('m210521_150431_006_create_table_awpb_funding_type',1621726753),('m210521_150432_007_create_table_awpb_template',1621726791),('m210521_150432_008_create_table_awpb_unit_of_measure',1621726804),('m210521_150433_025_create_table_awpb_component',1621726806),('m210521_150433_026_create_table_awpb_indicator',1621726806),('m210521_150433_027_create_table_awpb_outcome',1621726807),('m210521_150433_028_create_table_awpb_output',1621726807),('m210521_150434_036_create_table_awpb_activity',1621726811),('m210521_150434_037_create_table_awpb_activity_funder',1621726812),('m210521_150434_038_create_table_awpb_activity_line',1621726812),('m210521_150434_039_create_table_awpb_template_activity',1621726814),('m210523_092652_024_create_table_mgf_operation',1621797277),('m210523_092653_025_create_table_mgf_position',1621797277),('m210523_092653_026_create_table_mgf_reviewer',1621797277),('m210523_092654_039_create_table_mgf_applicant',1621797278),('m210523_092654_040_create_table_mgf_approval_status',1621797279),('m210523_092654_041_create_table_mgf_organisation',1621797280),('m210523_092655_042_create_table_mgf_organisational_details',1621797280),('m210523_092655_043_create_table_mgf_partnership',1621797280),('m210523_092655_044_create_table_mgf_proposal',1621797281),('m210523_092655_045_create_table_mgf_selection_category',1621797281),('m210523_092655_046_create_table_mgf_selection_criteria',1621797281),('m210523_092655_047_create_table_mgf_selection_grade',1621797282),('m210523_092655_048_create_table_mgf_unit',1621797282),('m210523_092656_055_create_table_mgf_application',1621797283),('m210523_092656_056_create_table_mgf_attachements',1621797283),('m210523_092656_057_create_table_mgf_component',1621797284),('m210523_092656_058_create_table_mgf_concept_note',1621797284),('m210523_092656_059_create_table_mgf_contact',1621797285),('m210523_092656_060_create_table_mgf_experience',1621797285),('m210523_092656_061_create_table_mgf_final_evaluation',1621797286),('m210523_092656_062_create_table_mgf_offer',1621797286),('m210523_092656_063_create_table_mgf_pastproject',1621797287),('m210523_092657_064_create_table_mgf_project_evaluation',1621797287),('m210523_092657_065_create_table_mgf_proposal_evaluation',1621797288),('m210523_092657_066_create_table_mgf_screening',1621797289),('m210523_092658_072_create_table_mgf_activity',1621797289),('m210523_092658_073_create_table_mgf_approval',1621797290),('m210523_092658_074_create_table_mgf_input_cost',1621797290),('m210523_092658_075_create_table_mgf_input_item',1621797291);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `right` text,
  `definition` text,
  `active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Manage Users',NULL,1),(2,'View Users',NULL,1),(3,'Manage Roles',NULL,1),(4,'View Roles',NULL,1),(6,'View profile',NULL,1),(7,'View audit trail logs',NULL,1),(8,'Manage provinces',NULL,1),(9,'Manage districts',NULL,1),(10,'Manage camps',NULL,1),(11,'Remove provinces',NULL,1),(12,'Remove districts',NULL,1),(13,'Remove camps',NULL,1),(14,'Manage markets',NULL,1),(15,'Remove markets',NULL,1),(16,'Manage commodity configs',NULL,1),(17,'Remove commodity config',NULL,1),(18,'Collect commodity prices',NULL,1),(19,'View commodity prices',NULL,1),(20,'Remove commodity price',NULL,1),(21,'Manage interview guide template questions',NULL,1),(22,'View interview guide template',NULL,1),(23,'Remove interview guide template question',NULL,1),(24,'Manage story of change categories',NULL,1),(25,'Submit story of change',NULL,1),(26,'Review Story of change',NULL,1),(27,'View Story of change',NULL,1),(28,'Attach case study articles',NULL,1),(29,'Manage faabs groups',NULL,1),(30,'View faabs groups',NULL,1),(31,'Remove faabs groups',NULL,1),(32,'Manage category A farmers',NULL,1),(33,'View category A farmers',NULL,1),(34,'Remove category A farmers',NULL,1),(35,'Submit FaaBS training records',NULL,1),(36,'View FaaBS training records',NULL,1),(37,'Remove FaaBS training records',NULL,1),(38,'Submit back to office report',NULL,1),(39,'Review back to office report',NULL,1),(40,'View back to office report',NULL,1),(43,'Plan camp monthly activities',NULL,1),(44,'Remove planned camp monthly activities',NULL,1),(45,'View planned camp monthly activities',NULL,1),(46,'Manage FaaBS training topics',NULL,1),(47,'View FaaBS training topics',NULL,1),(48,'Remove FaaBS training topics',NULL,1),(49,'View facilitation of improved technologies/best practices report',NULL,1),(50,'View training attendance cumulative report',NULL,1),(55,'View physical tracking table report',NULL,1),(56,'Commodity-Specific AWPB','Commodity-Specific AWPB',1),(57,'View programmes','View programmes',1),(58,'Manage AWPB activities','',1),(59,'View AWPB activities','',1),(60,'Manage components','',1),(61,'View components','',1),(62,'Manage AWPB templates','',1),(63,'View AWPB templates','',1),(64,'View AWPB activity lines','',1),(65,'Manage AWPB activity lines','View AWPB activity lines',1),(66,'Submit District AWPB','',1),(67,'Approve AWPB - Provincial','Approve AWPB - Provincial',1),(68,'Submit programme-wide AWPB','Submit programme-wide AWPB',1),(69,'Manage province consolidated AWPB','Manage province consolidated AWPB',1),(70,'Manage programme-wide AWPB activity lines','Manage programme-wide AWPB activity lines',1),(71,'Approve AWPB - PCO','Approve AWPB - PCO',1),(72,'Manage AWPB funders','Manage AWPB funders',1),(73,'View AWPB funders','View AWPB funders',1),(74,'Setup AWPB','Setup AWPB',1),(75,'Approve AWPB - Ministry','Approve AWPB - Ministry',1),(76,'Manage programme-wide AWPB','Manage programme-wide AWPB',1),(77,'View PW AWPB','View PW AWPB',1),(78,'View MGF module','',1),(79,'View MGF Applicants','',1),(80,'View MGF Organisations','',1),(81,'View MGF Concept Note','',1),(82,'View MGF Application','',1),(83,'View MGF Approvals','',1),(84,'View MGF Proposals','',1),(85,'View MGF Evaluations','',1),(86,'Commodity-Specific AWPB','Commodity-Specific AWPB',1),(87,'View programmes','View programmes',1),(88,'Manage AWPB activities','',1),(89,'View AWPB activities','',1),(90,'Manage components','',1),(91,'View components','',1),(92,'Manage AWPB templates','',1),(93,'View AWPB templates','',1),(94,'View AWPB activity lines','',1),(95,'Manage AWPB activity lines','View AWPB activity lines',1),(96,'Submit District AWPB','',1),(97,'Approve AWPB - Provincial','Approve AWPB - Provincial',1),(98,'Submit programme-wide AWPB','Submit programme-wide AWPB',1),(99,'Manage province consolidated AWPB','Manage province consolidated AWPB',1),(100,'Manage programme-wide AWPB activity lines','Manage programme-wide AWPB activity lines',1),(101,'Approve AWPB - PCO','Approve AWPB - PCO',1),(102,'Manage AWPB funders','Manage AWPB funders',1),(103,'View AWPB funders','View AWPB funders',1),(104,'Setup AWPB','Setup AWPB',1),(105,'Approve AWPB - Ministry','Approve AWPB - Ministry',1),(106,'Manage programme-wide AWPB','Manage programme-wide AWPB',1),(107,'View PW AWPB','View PW AWPB',1),(108,'Manage Users','',1),(109,'View Users','',1),(110,'Manage Roles','',1),(111,'View Roles','',1),(112,'View profile','',1),(113,'View audit trail logs','',1),(114,'Manage provinces','',1),(115,'Manage districts','',1),(116,'Manage camps','',1),(117,'Remove provinces','',1),(118,'Remove districts','',1),(119,'Remove camps','',1),(120,'Manage markets','',1),(121,'Remove markets','',1),(122,'Manage commodity configs','',1),(123,'Remove commodity config','',1),(124,'Collect commodity prices','',1),(125,'View commodity prices','',1),(126,'Remove commodity price','',1),(127,'Manage interview guide template questions','',1),(128,'View interview guide template','',1),(129,'Remove interview guide template question','',1),(130,'Manage story of change categories','',1),(131,'Submit story of change','',1),(132,'Review Story of change','',1),(133,'View Story of change','',1),(134,'Attach case study articles','',1),(135,'Manage faabs groups','',1),(136,'View faabs groups','',1),(137,'Remove faabs groups','',1),(138,'Manage category A farmers','',1),(139,'View category A farmers','',1),(140,'Remove category A farmers','',1),(141,'Submit FaaBS training records','',1),(142,'View FaaBS training records','',1),(143,'Remove FaaBS training records','',1),(144,'Submit back to office report','',1),(145,'Review back to office report','',1),(146,'View back to office report','',1),(147,'Plan camp monthly activities','',1),(148,'Remove planned camp monthly activities','',1),(149,'View planned camp monthly activities','',1),(150,'Manage FaaBS training topics','',1),(151,'View FaaBS training topics','',1),(152,'Remove FaaBS training topics','',1),(153,'View facilitation of improved technologies/best practices report','',1),(154,'View training attendance cumulative report','',1),(155,'View physical tracking table report','View physical tracking table report',1),(156,'View MGF module','',1),(157,'View MGF Applicants','',1),(158,'View MGF Organisations','',1),(159,'View MGF Concept Note','',1),(160,'View MGF Application','',1),(161,'View MGF Approvals','',1),(162,'View MGF Proposals','',1),(163,'View MGF Evaluations','',1),(164,'Submit project outreach records','Can submit project outreach quarterly records',1),(165,'Remove project outreach records','Remove project outreach records',1),(166,'View project outreach reports','View project outreach reports',1),(167,'Manage staff hourly rates','Manage staff hourly rates',1),(168,'View staff hourly rates','View staff hourly rates',1),(169,'Submit timesheets','Submit timesheets',1),(170,'Review timesheets','Review timesheets',1);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `province` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `polygon` geometry DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'Central',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\0\›\0\0ì9ñw\’\«;@*T7õ.¿¡s\Ô\·í\«;@	\∆¡•cû.¿B^&\≈\«;@—±ÉJ\\ü.¿F\ne\·\Î\«;@˛C˙\Ì\Î†.¿á\‹7\‡\«;@/¯4\'/¢.¿Ö\Õ\0d\«;@|¥8cò£.¿\’#\rnk\«;@ {Ω˚\„•.¿Yk(µ\«;@BÕê*äß.¿î0\”ˆ\«;@aâîM©.¿…è¯k\»;@\‡ù|zl´.¿=∑–ï\»;@H6W\Õs¨.¿vn⁄å\”\»;@ˆEB[Œ≠.¿raär\…;@\…væü\ZØ.¿4ª\Ó\…;@%\ \ﬁRŒØ.¿v\ﬂ1<\ ;@\0™∏qã±.¿û`ˇun\ ;@¡8∏t¥.¿\Ámlv§\ ;@\ \‡(yu∂.¿“èÜS\Ê\ ;@\n1óTm∑.¿\‹h\0oÅ\Ã;@§\„jdW∫.¿_b,\”/\Õ;@\“˛Xª.¿6oú\Œ;@x\—Wêfº.¿\⁄XâyV\Œ;@@Ω5_Ω.¿aåHZ\Œ;@\‚\\\√çø.¿wj.7\Œ;@\√\Ô¶[v¿.¿¨˛√Ä\Õ;@i¢≤¡.¿\‡ÿ≥\Á2\Õ;@™úˆîú\√.¿\¬\÷l\Â\Õ;@˙¥ä˛\–\ƒ.¿á‡∏åõ\Œ;@˘ÑÏºç\≈.¿Éâ?ä:\œ;@#ø~à\r\∆.¿≤,ò¯\œ;@+n\‹b~\∆.¿Ú\Ì]Éæ\–;@!è\‡F\ \∆.¿\Óñ\‰Ä]\—;@Rb\◊ˆ\∆.¿∫Ù/Ie\“;@]åÅu\«.¿ywd¨6\”;@!Z+\⁄\«.¿\÷TÖ]\‘;@Øx\Íë\«.¿¥9\Œm\¬\’;@\›xwd¨\∆.¿¥é™&à\÷;@<ö$\∆.¿É¶%VF\◊;@n¸â Ü\≈.¿òhêÇß\ÿ;@ßwÒ~\ƒ.¿¬ø\Z3\Ÿ;@\›\ÔP\Ë\√.¿û≤öÆ\'\⁄;@˚\\m\≈˛\¬.¿˛ûXß\ \€;@;\»\Î¡§¿.¿C¨˛\√\‹;@¯¸0B¿.¿\ÊÆÚ\ﬁ;@˝i£:¿.¿v˘÷áı\ﬁ;@ùÄ&¬Üø.¿\ƒ\Ïe\€i\ﬂ;@\nö]˜æ.¿\“9?\≈q\‡;@ ò£\«\ÔΩ.¿K>v(\·;@:tzﬁçΩ.¿Yni5$\‚;@Túà~Ω.¿Òùòı\‚;@CXç%¨Ω.¿Ul\Ã\Îà\„;@Û\Ã\Àa˜Ω.¿ÜUºëy\‰;@uv28Jæ.¿Ç˛Bè\Â;@´%\Â`æ.¿=\’!7\√\Â;@\·	Ω˛$æ.¿|Vú\Ê;@õí¨\√—Ω.¿≥ıµ.\È;@µ§£\Ã\Œ.¿;6Ò∫\Ó;@K\Èô^b\ƒ.¿“ã\⁄˝*;@u\ÀÒ\À.¿DnÜÒ;@°-\ÁR\\\’.¿\\t≤\‘zÛ;@9πﬂ°(\‡.¿ÄJïÙ;@\—yç]¢\Í.¿y¢\'eˆ;@’îdé˛.¿\¬(õˆ;@ˆCl∞p/¿\…\ÁO=ˆ;@\◊mP˚≠\r/¿º∞5[yı;@WÌöê\÷(/¿MÖx$^\ ;@ØZôK%/¿9D‹úJ\ ;@ÆıEB[&/¿C9—ÆB\ ;@\\1–µ\'/¿kÅ=&R\ ;@\\ív5)/¿ˆòHi\ ;@ö≤\”\Í*/¿7P\‡ù|\ ;@°1ì®,/¿;\ﬂOçó\ ;@õ;˙_Æ-/¿1^Û™\ ;@ñzÑÚ./¿z˝I|\ ;@ä\Ã\\\‡Ú0/¿\ËÖ;\ ;@Ù\≈ﬁã/2/¿ß•h\…;@≠€†ˆ[3/¿iå\÷Q\’\»;@≤.n£4/¿ˆ≥Xä\‰\«;@¢≤aM5/¿π8*7Q\«;@\"r˙zæ6/¿\≈\ h\‰Û\∆;@xG\∆jÛ7/¿4.\…\∆;@|eﬁ™\Î8/¿èäˇ;¢\∆;@\⁄Ω\·>:/¿Ω\nÉ\∆;@\–\“l;/¿≠N\ŒP\‹\≈;@Y¿n\›=/¿b0Ö\Ã\≈;@Ω¸Nì?/¿	\∆¡•c\∆;@k◊Ñ¥\∆@/¿pCå◊º\∆;@\’ºÃ∞A/¿^¸o%\«;@\nK<†lB/¿X9\“\»;@;9Cq\«C/¿é\»;@£\”0|D/¿R)v4\…;@°°ÇãE/¿\Áå(\Ì\r\ ;@1y\Ã|G/¿!\\Öz\ ;@©\Ÿ≠¿H/¿P¸s\◊\ ;@\Ã&¿∞¸I/¿> à@\À;@t~ä\„¿K/¿CFó7\À;@=\Ó\Œ\⁄M/¿\√ÛR±1\À;@4Úy\≈SO/¿\’[[\…;@\‚>rk\“M/¿/R(_\«;@Y|EO/¿˜ôù\∆;@Jòi˚O/¿™ö \Í>\ƒ;@°J\ÕhM/¿{ÜpÃ≤\√;@i\‚\‡IK/¿BCˇ\√;@\¬˘‘±JI/¿ÅØ\Ë\÷k\¬;@urÜ\‚éG/¿àL˘T¡;@Ö≤ıµF/¿zÛW¿;@¿#*T7G/¿Tsπ¡Pø;@•	¶öI/¿¸R?o*æ;@\Ÿ^zoL/¿[]N	àΩ;@É}iN/¿\“\‚åaNº;@¢Ø \ÕP/¿!XU/øª;@I\Ÿ\"i7R/¿rã\ﬂ∫;@Mg\'É£T/¿\Â\Ïù\—Vπ;@L7âA`U/¿e\ƒ†Q∂;@\“5ìo∂Q/¿uö∂;@Cè=∑P/¿\€¶∂‘µ;@¯˘\Ô¡kO/¿°-\ÁR\\µ;@F^\÷\ƒO/¿Ö\"\›\œ)¥;@§ƒÆ\Ì\ÌN/¿≠mé≥;@! _BO/¿\ÔXlìä≤;@îg^ªO/¿¶}s±;@\Ô˛xØZQ/¿¯\¬d™`∞;@wfÇ\·\\S/¿4˜êΩØ;@6sHj°T/¿[$\ÌFØ;@á≈®k\ÌU/¿Ÿ≤|]Æ;@œ¢w*\‡V/¿¥Ë°∂≠;@∫ÉÿôBW/¿Qˆñræ¨;@N*\ZkW/¿_%ª¨;@\Í∞\¬-W/¿§ã¶´;@_\‘\ÓWV/¿ì®|ö´;@îˆ_òT/¿\…t\ËÙº´;@\Â∂}èR/¿^,ë”´;@AÙ§LjP/¿Û\„/-\Í´;@\Ÿ_vON/¿Ä`éø´;@\‰GàL/¿∫†æeN´;@\Ó[≠óK/¿\‚<ú¿t™;@£h[\ÕJ/¿\Zn¿Áá©;@5&\ƒ\\J/¿ál ]®;@ˇy\Z0HJ/¿è6éXãß;@/Ü\»I/¿\\ìnK\‰¶;@˘£®3˜H/¿*\‚tí≠¶;@\ﬂ5\ËKoG/¿J&ßv¶;@.ˇ!˝ˆE/¿j\⁄\≈4”•;@Ù©cï\“C/¿Ç\·\\\√•;@ñZ\Ô7\⁄A/¿\∆˘õPà§;@q\ÊWsÄ@/¿;\√‘ñ:§;@˚\Ê˛\Íq?/¿TW>\ÀÛ§;@˘˜</¿\Ÿ\Ì≥\ L•;@¬ÜßW\ :/¿é[\Ïˆ•;@ÊØêπ28/¿ÇV`\»\Í¶;@H˝ı\n6/¿ºz®;@r6\‹4/¿ÄF\È“ø®;@ta§µ3/¿O\Í\À\“N©;@tœ∫F\À1/¿-”æ©;@\ÂÚ\“o//¿k$	¬©;@\„n≠-/¿¡tZ∑A©;@ºêa,/¿*:í\À®;@\–\ÓêbÄ,/¿¯P¢%èß;@ÆÄB=-/¿≠˙\\m≈¶;@€¢\Ãô,/¿\ZM.\∆¿¶;@,gÔå∂*/¿”ΩN\ÍÀ¶;@LnYk(/¿¥ì¡QÚ¶;@ªa€¢\Ã&/¿®ç\Ít ß;@c`\«%/¿t\\ç\ÏJß;@òMÄa˘#/¿\r˙\“€üß;@süà\"/¿&VF#üß;@\’[[% /¿É/L¶\n¶;@\⁄8b->/¿é≤~31•;@¨\Â\ŒL0/¿\ÎT˘ûë§;@ı+ù\œ\Z/¿\–dˇ<\r§;@≠jIG/¿)[$\ÌF£;@\“\·!å/¿\»	F≥¢;@°ù\”,\–/¿PäV\Ó¢;@±®à\”I/¿\Ó–∞u°;@g\nù\◊\ÿ/¿â|óRó†;@6ê.6≠/¿±mQfÉ†;@àÄC®R/¿\0\ƒ]Ωä†;@tœ∫F\À/¿Ø?âœù†;@9\÷\≈m4/¿1\”ˆØ¨†;@p#eã§\r/¿fü\«(œ†;@ÉN/¿\‰£\≈√†;@º\…o\—\…\n/¿ÖD\⁄∆ü†;@4\€˙`	/¿üZ}uU†;@±j\Êv/¿c\—tv2†;@˙{)<h/¿y‹ùµü;@oùª/¿m˝Ùü5ü;@•\ﬂP¯/¿m±üû;@Õ±º´/¿a5ñ∞6û;@EÅ>ë\'	/¿4¯˚\≈lù;@\‰g#\◊M	/¿ÖñuˇXú;@Aúá/¿wfÇ\·\\õ;@Z∏¨\¬f/¿Ø¥å\‘{ö;@/àHMª/¿”§t{ô;@’ï\œÚ</¿4-±2\Zô;@‘ûísb/¿<º\Á¿rò;@dï\“3Ω/¿î¯\‹	ˆó;@ÉlYæ./¿\ƒ&2sÅó;@y\À’èM/¿˘∫ˇ\Èñ;@I\ÿ\’\‰/¿äV\Ófï;@¯¡˘‘±/¿¨q6î;@˜\0›ó3/¿i\⁄V≥í;@3‹Ä\œ/¿1\÷q¸ê;@•\Ÿ<É/¿k\“mâ\\ê;@Fò¢\\\Zˇ.¿\Á™yé»è;@j˚WVö¸.¿3˛}∆Öè;@WØ\"£˙.¿™úˆîúè;@•Ljh¯.¿éø∑\Èè;@U/ø\”dˆ.¿\ƒv¸ê;@•Ñ`Uı.¿\ﬁQcBê;@H¸ä5\\Ù.¿jºtìê;@\ÕtØì˙Ú.¿8\€‹òûê;@C ó8Ú.¿mo∑$ê;@Öyè3M.¿e\ﬂ¡ˇé;@@/‹π0Ú.¿&èß\Âé;@P√∑∞nÙ.¿\ \›\Á¯hç;@\"˝ˆu\‡Ù.¿G™\Ô¸¢å;@	ãä8ùÙ.¿´\œ\’V\Ïã;@≤,ò¯Û.¿@˙&MÉä;@OjMÛ.¿»óP¡â;@` ê°Û.¿ë9∂ûâ;@\Ã@e¸˚Ù.¿m\«\‘]Ÿâ;@U4\÷˛\Œˆ.¿p>u¨Rä;@T\›ã˙.¿\Z\€kA\Ôâ;@øb\rπˇ.¿\Áé˛ókâ;@äØv\Á\0/¿\›\na5ñà;@á\¬g\Î\‡\0/¿X\0Sà;@;˝†.R\0/¿Û¨§á;@˚±I~\ƒˇ.¿5F\Î®jÜ;@_a¡˝Äˇ.¿T\ƒ\È$[Ö;@Ω«ô&lˇ.¿∑]hÆ”Ñ;@\÷:q9^/¿:≠€†ˆÉ;@\Ê<c_≤/¿¢F!…¨Ç;@ªˇ\È/¿L˚\Ê˛\ÍÅ;@Å\—\Â\Õ\·/¿ª\“2R\ÔÅ;@K\Èô^b/¿^Mû≤öÇ;@™*4\À/¿ á†jÙÇ;@§ˇ\ÂZ¥/¿áåG©ÑÉ;@z\ﬂ¯\⁄3/¿?»≤`\‚É;@Ä\Ô6oú/¿å\ \¬◊É;@ˇïï&•/¿6\‹,Ç;@ákµáΩ/¿\'3\ﬁVzÅ;@\≈8\n/¿ëC\ƒÕ©Ä;@\Ÿ\ÍrJ@/¿u\«bõTÄ;@äV\Óf/¿46<Ω~;@H≈´¨/¿8K\…r~;@˝O˛\Ó/¿ù*\ﬂ3};@ë`™ôµ/¿\œ/J\–_|;@Ö_\Í\ÁM/¿<jLàπ|;@ò€Ω\‹\'/¿«Ω˘\r};@@˘ªw\‘/¿Å≥î,\'};@B≤Ä	\‹\Z/¿\Ê\ËÒ{õz;@˚Øs\”f/¿\\\Â	Ñy;@ù,µ\ﬁo/¿\Óïy´Æw;@MÑ\rOØ/¿\ÃA\–—™v;@ˆz˜\«{/¿ÙQF\\\0v;@;ç¥T\ﬁ/¿\ÍAA)Zu;@\Ì)9\'ˆ /¿˜\«{\’\ t;@;Uæg$\"/¿r1\÷qt;@\"•\Ÿ<#/¿%Ã¥˝s;@®qo~\√$/¿πà\Ôƒ¨s;@^emS<&/¿~£<Ûr;@ùª]/M)/¿N~ãNñr;@:=\Ô∆Ç*/¿\œ0µ•r;@∞´\…SV+/¿jP4`q;@6 B\\9+/¿j§•Úvp;@]¶&¡*/¿l\Í<*˛o;@æl;mç(/¿x_ïïo;@§30Ú≤&/¿\"ã4Òn;@5_%ª#/¿3¡pÆan;@,Ä)$/¿gÄ≤em;@äs\‘\—q%/¿∫/g∂+l;@∞êπ2®&/¿˚¨2SZk;@\‚\‡I\'/¿¢{\÷5Zj;@4`ë_\'/¿ñ=	l\Œi;@\‘*˙C3\'/¿\‡ÿ≥\Á2i;@ÉL2r&/¿(Äbd\…h;@ìã1∞é#/¿j˚WVöh;@f.py¨!/¿+\‹Úëh;@\∆¯0{\Ÿ/¿#¯\ﬂJvh;@\√Œßé/¿§6qrøg;@$\—\À(ñ/¿étF^f;@ZÙN\‹/¿≤\ÿ&çe;@≥_w∫Û/¿Z¢Ø e;@\\!¨\∆/¿Rµ\›\ﬂd;@\rç\'Ç8/¿\Ã&¿∞d;@>{.Sì /¿2•ûd;@\–~§à#/¿\‚\‰~á¢d;@¿x\r%/¿¯çØ=≥d;@U\¬z˝)/¿zod;@$óˇê~+/¿¿z‹∑Zc;@π9ï\0-/¿\ﬂOçónb;@$ô\’;\‹./¿29µ3La;@˙\ÏÄ\Îä1/¿≥Bë\Ó\Á`;@†\ﬂ˜o^4/¿\ƒ†Q∫`;@º;2Võ7/¿c(\'\⁄U`;@!yv9/¿\Œp>?`;@ˆaΩQ+</¿=HOëC`;@!Æú=/¿™-uê\◊_;@´\Ïª\"¯?/¿êà)ëD_;@ùL\‹*àA/¿g_yêû^;@ß∞RAEE/¿¢≤a];@\€\¬ÛR±I/¿AùÚ\ËF\\;@7ñ~L/¿\…∆É-v[;@hÒÅO/¿\œ.\ﬂ˙∞Z;@Ç;Pß<R/¿∂\€.4\◊Q;@(Fñ\Ãq/¿œºv\ﬂQ;@æ£∆Ñòs/¿\Z£uT5Q;@∫\Ÿ(∑u/¿ª∂∑[íO;@\ \ﬁ\Â\"v/¿èmpñN;@\—Éw/¿m\≈˛≤{N;@\Œ9x&4y/¿q<üıN;@\"˝ˆu\‡|/¿äçC˝N;@§m¸â\ ~/¿¶∏™\ÏªN;@{ºêÅ/¿8˘-:YN;@AG´ZÇ/¿G\Ã\ÏÛM;@˙}ˇ\Ê≈Å/¿åÉK\«L;@\—x\"àÛÄ/¿o\ÎL;@W&¸R?/¿;n¯\›tK;@€£7\‹G~/¿\npUJ;@IZ\÷˝{/¿\Ÿ>\‰-WG;@*\‚tí≠v/¿+2: 	G;@\Ó\Ìñ\‰Äu/¿Ù7°G;@x¥q\ƒZt/¿QL\ﬁ\0G;@\œ,	PSs/¿\∆2˝ÒF;@á¯á-=r/¿\Ï1ë\“lF;@\Ï‹¥ßq/¿∫áÑ\Ô˝E;@\›\'G¢p/¿õ.»ñE;@Mû≤öÆo/¿éW zR2;@\ÎÛê)\Ô.¿/PR`\0;@çñ=\‘\Ó.¿$a\ﬂN˙:@%\Íü\Ê\Ï.¿%\Á\ƒ\⁄ˇ:@Ç8\'0\≈.¿ø÷•F\Ëˇ:@Å?¸¸˜¿.¿º@IÅ\0;@ôùE\ÔT∏.¿_òL\0;@*™~•≥.¿oeâ\Œ2Û:@\ÕX\‰◊∑.¿6\‹,\“:@AÉMùG≠.¿˚≠ù(	\…:@\Ï\’[´.¿\¬¯i‹õø:@¨0ô™.¿û^)Àò:@Äõ≈ãÖ©.¿mYæ.\√:@\ƒABî/®.¿\¬¯i\‹[:@ëD/£X¶.¿+1\œJ\":@£h[Õö.¿ì\‚\„≤:@\—w∑≤Dó.¿Ô©úˆî¸9@ÇéVµ§ì.¿\‹)¨ˇ\œ9@˙\ÃYüí.¿ò\ﬁ˛\\4Ä9@è\‡F\ ë.¿l\\ˇÆ9@P\Ëë.¿®R≥ZQ9@ä\"§ngè.¿µ4∑BT9@Ú#~\≈\ZÜ.¿\◊h9\–CU9@ízO\Â¥.¿ºß>êT9@7ç\Ìµ†w.¿\ŒSr3T9@‘õQÛUr.¿ﬁìáÖZS9@9ºZ\Ól.¿Ñd∏Q9@hÒÅ_.¿z\‰ûW9@nQfÉLR.¿x%\…s}[9@ôcyW=P.¿h\Œ˙îc^9@@x\Ó=L.¿\“\√\–\Í\‰`9@}xñ #H.¿˛Ò^µ2e9@¿ñWÆ∑E.¿\Ÿyõi9@l|&˚\ÁI.¿∂/†\Ól9@Úñ´õD.¿\À\ÿ\–\Õ˛l9@f0F$\n=.¿›îÚZ	m9@±√òÙ˜2.¿QÜ™òJk9@≤/\Ÿx∞-.¿có®\ﬁ\Zl9@D¢–≤\Ó\'.¿líÒo9@,G\»@&.¿-?pï\'t9@∏u7O.¿D\€1uWv9@öîÇn/.¿èo\Ôv9@\Ó$\"¸ã\0.¿Æ\”HK\Âu9@yué\Ÿ˚-¿/2øFv9@MK¨åFˆ-¿û?mTßw9@∑(≥A&Ò-¿\«\‘]\Ÿw9@\Á\ƒ\⁄\«\Í-¿fàc]\‹r9@Y∑\—\0\ﬁ-¿NDø∂n9@ZÉ˜Uπ\–-¿Õ´:´n9@Kë|%ê\ -¿Tè4∏≠m9@ˇ@πm\ﬂ\√-¿à\n\’\Õm9@˝¯Kã˙º-¿\Ÿ^zop9@ªõß:\‰∂-¿l\—¥≠r9@\÷pë{∫™-¿˛∂\'Hls9@sÒ∑=A¢-¿\0˛)U¢t9@\…uS\ kù-¿Äπ-@w9@å1∞é\„ó-¿ùg\ÏK6z9@]P\ﬂ2ó-¿õ\”ñ|9@>˘í-¿8ˆ\ÏπL}9@/ÖÕÆã-¿Q.ç_x}9@M°Û\ZªÑ-¿àd»±ı|9@\Ó\Ó∫/-¿òi˚WV~9@)yuéy-¿µ4∑BX}9@úi\¬ˆìq-¿ å∑ï^{9@(-\\Vak-¿\Ê}ì¶y9@$\“6˛De-¿\nfL¡\Z{9@ôg%≠¯^-¿J\Ï\⁄\ﬁn}9@W#ª\“2Z-¿°\⁄\‡DÙ9@p\ÓØ˜U-¿µ£8GÅ9@§ng_yP-¿Gqé::Ç9@¸\„ΩjeJ-¿ip[[Ñ9@h\\8íE-¿U/ø\”dÜ9@fJ\Îo	@-¿0Ú≤&à9@\⁄\Â[\÷;-¿ÛX32»â9@\⁄\ZåÉ3-¿\»`≈©÷ä9@¡pÆaÜ.-¿4-±2\Zç9@E/£Xn)-¿*ú\ﬁ≈è9@\Ã_!se(-¿\Ó±Ù°í9@K∫†æ%-¿>x\Ì“Üì9@1\Ìúf!-¿%¿î9@\"˝ˆu\‡-¿\Ó\Î¿9#ñ9@j°drj-¿RÚ\Íñ9@ﬂº8Ò-¿T˜<\¬9@≥	0,-¿S\À\÷˙\"1:@\r9∂û!<-¿£êdV\Ô0:@≥ïó¸O>-¿\’Y-∞\«0:@˝/◊¢@-¿IÑ+†0:@o\rlï`A-¿Sv˙A]0:@^¸o%C-¿,ù\œ0:@i∆¢\ÈD-¿˚îc≤∏/:@F\Í=ï\”F-¿,H3M/:@\Îˇ\ÊK-¿ë(¥¨/:@\Â`6ÜM-¿∫Û\ƒs∂0:@5a˚\…O-¿0πQd≠1:@˛\”\rP-¿}zlÀÄ3:@nƒì\›\ÃP-¿R\◊\⁄˚T5:@ˇ!˝ˆuP-¿&9{6:@ƒòÙ˜RP-¿`\…U,~7:@˜èÖ\ËP-¿EÉ<Ö8:@´	¢\ÓP-¿eo)\Áã9:@@KW∞çP-¿ß…å∑ï::@ìr˜9>R-¿ºX\"ß;:@\ﬂ,\’T-¿T∆øœ∏<:@(õrU-¿äê∫ù}=:@\–^}<ÙU-¿C9—ÆB>:@\Z¶∂\‘AV-¿a3¿\Ÿ>:@T^-W-¿L¬Ö<Ç?:@\…\…ƒ≠ÇX-¿Å^∏sa@:@°ˆ[;QZ-¿£\ 0\ÓA:@\œ˜S\„•[-¿T˛µºrA:@u\«bõT\\-¿Oyt#,B:@Jó˛%©\\-¿\Ë\‰g#C:@JóU\ÿ\\-¿ˆ\–>VC:@l\ndv]-¿xπà\Ô\ƒD:@(N>]-¿@˜\Â\ÃvE:@W\Œ\ﬁm]-¿[^π\ﬁ6G:@í\Ã\Í^-¿ÄÇã5H:@˚Zó\Z°_-¿àÅÆ}I:@‘∑\Ã\È≤`-¿e\ZMJ:@h∞b-¿‚±ü\≈RL:@v5y\ b-¿/£XniM:@£h[\Õb-¿\Zâ\–6N:@M1AGc-¿\ﬁ	äO:@Fó7ác-¿;\√‘ñ:P:@\Ë§˜çØe-¿\—z¯2QP:@˙cZõ\∆f-¿ÒÄ≤)WP:@\–Ò\—\‚åi-¿\¬5wÙøP:@]©gA(o-¿ÒbaàúR:@h\œejt-¿\Ë/Ùà\—S:@lÀÄ≥ît-¿∑µÖ\ÁU:@¿œ∏p t-¿∑\Ó\Ê©V:@,\÷pë{r-¿2Àû6W:@õ\…7\€\‹p-¿w†NytW:@\"4Çç\Îo-¿rßt∞˛[:@±l\Êêl-¿¥≠fù]:@∑\—\0\ﬁj-¿õ\‚qQ-^:@-zß\Ói-¿˚\"°-\Á^:@˛Ò^µ2i-¿í@ÉMù_:@Â¥ß\‰úh-¿ñ{ÅY°`:@\∆˝G¶Cg-¿Zûwga:@\÷8õé\0f-¿i¢≤a:@\¬QÚ\Íc-¿@ø\Ô\ﬂ`:@´ï	ø\‘_-¿Æ™\rN`:@\È\Ì\œEC^-¿Ü:¨p\À_:@ôa£¨\ﬂ\\-¿\ÍÕ®˘^:@i˝-¯W-¿ˇ±_:@*sÛç\ËV-¿IK\Â\Ì_:@ì\·x>R-¿∑ñ\…p<_:@…è¯kP-¿±¡\¬Iö_:@\“\·!åüN-¿_\ŒlW\Ë_:@ZÅ!´[M-¿g\‘|ï|`:@\0™∏qK-¿çúÖ=\Ì`:@\Ìô%jJ-¿\‚X∑a:@Úî\’t=I-¿{¯2QÑd:@\‰ˆ\À\'+F-¿ÿÄqe:@∞\Ê\0¡E-¿MK¨åFf:@\…:]•C-¿k\ÿ\Ôâuf:@\Ÿ\Ó@ùB-¿x\'ü\€f:@\Ìcø\rA-¿¡®§N@g:@öµêˆ?-¿±RAE\’g:@\€e6\»<-¿¶\—\‰bh:@fıÇO;-¿\ƒ^(`;h:@dT8:-¿åL¿Øëh:@*¨ˇs8-¿ÛW\»\\i:@˜u\‡ú5-¿ﬁ≠,\—Yj:@voEbÇ2-¿)x\nπRk:@ÉR¥r/0-¿jæJ>vk:@5|\Î.-¿ÿö≠º\‰k:@`r£\»Z+-¿áS\Ê\Êm:@ìqådè(-¿¥9\Œm\¬m:@º#cµ˘\'-¿\Ïk]jÑn:@ê˜™ï	\'-¿a\·$\Õo:@∑}è˙\Î%-¿ÅC®R≥o:@D•3˚$-¿™πnp:@é\Ê\»\ /#-¿ß<∫q:@≤I~ƒØ -¿\€\ﬂ\ŸΩq:@e\«F ^-¿@¿Zµkr:@z˝I|-¿ôöoHs:@\Œqn\Ó-¿\Ë\⁄\–s:@\›|#∫g-¿F\Î®jÇt:@«õ¸ù-¿ê§§á°u:@\÷ˆB-¿n4Ä∑@v:@©ÉºL\Z-¿.T˛µºv:@0ôÚ-¿fg\—;x:@ÑÉΩâ!-¿W\nÅ\\\‚x:@ıç\Ó-¿A*≈é\∆y:@¶`ç≥\È-¿K\ÊX\ﬁU{:@\‹Ò&øE-¿û]æıa}:@\—`\"-¿≥öÆ\'∫~:@\‘-¨-¿/àHM:@≥\Ôä\‡-¿x‘òsÅ:@2ì®|-¿Q0c\nÇ:@}ñ\Á¡\›-¿ªDı\÷¿Ç:@°ıe¢-¿2\"QhYÉ:@åHZ\÷\r-¿sÖwπàÉ:@Kí\Á˙>-¿bg\nùÉ:@\‰Ùı|\Õ\n-¿jâï\—»É:@QMI\÷\·-¿\ ˘b\Ô≈É:@7ﬂà\ÓY-¿\»\Ôm˙≥É:@GØ(\r-¿<ÑÒ”∏É:@˙~jºt-¿”æπÉ:@ú\ﬁ\≈˚-¿C∆£T¬É:@	Qæ\0-¿≤à\◊ıÉ:@0e\‡Ä˛,¿7ñ~Ñ:@ã®â>˝,¿êj\ÿÔâÖ:@|¥8cò˚,¿8Öï\n*Ü:@EGr˘˘,¿ﬁ´V&¸Ü:@êΩ\ﬁ˝Òˆ,¿5%Yá£á:@D6ê.6ı,¿eT\∆›à:@\„\ƒW;äÛ,¿\ÊtYLlä:@îôÄ_Û,¿=bÙ‹ä:@\›(≤\÷PÚ,¿ÖñuˇXå:@\…\Ê™yé,¿.=ö\Í…å:@\‚©i\Ô,¿™\’WWé:@T»ïz\Ï,¿í=BÕêé:@Ö$≥zá\Î,¿/ÖÕÆè:@-ò¯£®\Î,¿\¬z˝Iê:@∂ù∂F\Î,¿ß$\Îptë:@≠1\ËÑ\–\È,¿\Óî\÷ˇë:@iä\0ßw\È,¿ÜKÆí:@í<\◊˜\·\Ë,¿êO\»\Œ€î:@(`;±\Á,¿ˇ\Ëõ4\rñ:@É§O´\Ë\Á,¿\Ê \ËhUó:@\Œ›Æó¶\Ë,¿[”º\„ô:@#†\¬§\Í,¿\‚\ \Ÿ;£ô:@≥)Wxó\Î,¿\0\≈»í9ö:@	\›%qV\Ï,¿bfü\«(õ:@\ÁS\«*\Ì,¿¿x\r˝õ:@\Á\∆ÙÑ%\Ó,¿Øµ˜©*ú:@Ø&OYM\Ô,¿ÖîüT˚ú:@ﬂåöØí\Ô,¿\œ\ŸB\Îù:@F;åI\Ô,¿≥\œcîgû:@\Ï´a\Ó,¿RG\«\’»û:@\Î\„°\Ôn\Ì,¿Å>ë\'Iü:@=‘∂a\Ï,¿q„äãü:@Ë°∂\r\Î,¿Öµ1v¬ü:@O\‹Û¸\È,¿\⁄(∑\Ìü:@á\ZO\È,¿î\Ÿ ìå§:@´¥\≈5>\„,¿yt#,*¶:@˜Ù¬ù\„,¿\√c\“ﬂß:@ò¿≠ªy\‚,¿Ø\"£í®:@NA~6\‚,¿˘gÒÅ©:@\'Ωo|\Ì\·,¿3OÆ)ê≠:@\ 6p\Í\‰,¿G´Z\“Q≤:@\»?3à\Ï,¿˛ú0a¥:@\“o_\Œ\È,¿E*å-µ:@sıcì¸\Ë,¿\Ï1ë\“l∂:@\Î;ø(A\Á,¿}w+ª:@≠L¯•~\Ê,¿T8ÇTäΩ:@æ**\Á,¿÷≠ûìﬁø:@>?å\Ê,¿Ll>Æ\r¡:@%z\≈r\„,¿/àH¡:@L\∆1í=\‚,¿÷ßì\≈¡:@ﬁÆó¶\‡,¿{ø—é\¬:@¯änΩ\ﬁ,¿öï\ÌC\ﬁ\¬:@4iSuè\‹,¿⁄´èáæ\√:@∑∂ºT\‹,¿D4∫É\ÿ\≈:@c*˝Ñ≥\€,¿¡\«`≈©\∆:@x∏\Z\€,¿ÉN\»:@\ÁUù\’\€,¿%ë}êe\…:@%]3˘f\€,¿\Ã:ì\ :@ë\”\◊Û5\€,¿<2Võˇ\À:@(Fñ\Ã\Ÿ,¿ˆ_\Á¶\Õ\Ã:@ñvj.7\ÿ,¿k’Æ	i\Õ:@i¿\"ø\÷,¿s€æG˝\Õ:@D•3˚\‘,¿MN\ÌS\œ:@I\Ô\0O\“,¿Eøï\Ï\–:@’Øt><\”,¿∂◊Ç\ﬁ\”:@Ø±KTo\’,¿{g¥UI\‘:@¿\Ì	\€\’,¿.\≈Ue\ﬂ\’:@4ıª∞\’,¿∂Ov3\◊:@a¸4\÷,¿\Œ¬ûv¯\◊:@ÿûY†\÷,¿ÖÃïA\Ÿ:@ïa\‹\r¢\’,¿Ù˙ì¯\‹\Ÿ:@\‹K\Z£u\‘,¿°jÙjÄ\⁄:@±\ZKX\”,¿0Ω˝πh\‹:@4Jó˛%\—,¿«ª#cµ\›:@m˙≥\—,¿+j0\r\ﬂ:@\"oπ˙±\—,¿ç\Ó v\‚:@<FzQ\”,¿˛då≥\„:@!âóß\”,¿^i©˜\‰:@\Â_\À+\◊\”,¿ÇZ∫Ç\Â:@#-ï∑#\‘,¿‘∑\Ã\È\Ê:@`sû	\’,¿DäM\Ë:@E|\÷,¿˘£®3˜\Ë:@B#ÿ∏˛\’,¿\r˛~1[\Í:@¶µilØ\’,¿u><Kê\Ì:@;\‚ê\r§\”,¿\"S>U\Ô:@,cC7\”,¿F\Ì~\‡\Ô:@G\Ëg\Íu\”,¿\⁄ ìåúÒ:@\ÀÙK\ƒ\”,¿6í\·\nÙ:@˛E–òI\‘,¿q„äã˜:@>¿x\’,¿mêIF\Œ˙:@5Ò§\’,¿sﬂâY˚:@{ˆ\\¶~,¿!u;˚\ ˚:@l?\„\√|,¿ì\‡\riT¸:@nä\«Eµx,¿òÖvN≥¸:@x^*6\Êu,¿l\\ˇÆ\œ¸:@)v4ıs,¿ˇ	.V\‘¸:@ïû\È%\∆r,¿L¶\nF%˝:@\÷{L§l,¿∂\÷	m˝:@{§¡mmi,¿\Â\‘\Œ0µ˝:@ã®â>e,¿\ÿI}Y\⁄˝:@P\„\ﬁ¸Üa,¿\Êv/˜˝:@m±^,¿øõn\Ÿ˝:@∞8ú˘\’\\,¿\Â`6Ü˝:@\…\ÁO=Z,¿¢\—\ƒ\Œ¸:@\Z˝h8eV,¿nâ\\p˚:@\€¡à}P,¿\Ê\À∞è˙:@<•ÉıN,¿ka\⁄9˘:@N\'\Ÿ\ÍrJ,¿\◊ˆvKr¯:@ÊØêπ2H,¿¨9@0G˜:@FaED,¿.q\‰Å\»ˆ:@¨JCçB,¿§\ﬁS9\Ìı:@\‡V*®@,¿DmFAÙ:@c\n\÷8õ>,¿¢F!…¨Ú:@8Ωã˜;,¿Öô∂eÒ:@ôd\‰,\Ï9,¿æ\ÿ{ÒE\Ô:@\Œ\ƒt!V7,¿ªó˚\‰(\Ï:@\Ô\…\√B≠1,¿\’w~QÇ\Í:@æ0ô*-,¿dï\“3Ω\Ë:@éXãO(,¿âõS\…\0\Ë:@∂e¿YJ&,¿Ω âv\Â:@\Ã*l∏ ,¿j\€0\nÇ\„:@`!seP,¿\Z\‡ÇlY\‚:@\0™∏q,¿8º \"5\·:@C±l\Ê,¿µ4∑B\‡:@TãàbÚ,¿\Î\Ÿ\\5\ﬂ:@9\‘\Ô\¬\÷,¿˝ÜK\ﬁ:@©ÉºL,¿<\‹\rã\›:@˙ôz\›\",¿1@¢	\›:@ÒGT®,¿\Ì\Ôlè\ﬁ\‹:@eå≥ó\r,¿J¥\‰Ò¥\‹:@ zR&5,¿®¶$\Îp\‹:@Ü1zn	,¿n⁄å\”\›:@4⁄™$≤,¿-]¡6\‚\›:@∂0\Ìú,¿¢µ¢\Õq\ﬁ:@m\«\‘]\Ÿ,¿\‡⁄âíê\‡:@§ã¶,¿\⁄\…\‡(y\·:@)@Ãò,¿Én/iå\‚:@®oô\”e,¿;®\ƒuå\„:@¸4\Ó\Õo\0,¿‘ö\Êß\‰:@uX\·ñˇ+¿\Ô5&\ƒ\‰:@ﬂº8Ò˝+¿ò\⁄Ry\Â:@=\n◊£p˝+¿.s∫,&\Ê:@[ôK˝¸+¿O©e\Á:@èUJ\œÙ˙+¿DR%ì\Á:@}–≥Yı˘+¿•û°º\Á:@Å\œ#Ñ˜+¿+¡\‚p\Ê\Á:@˝/◊¢ı+¿ˆD◊Ö\Ë:@!£ÀõÛ+¿óo}Xo\Ë:@Ö\…T¡+¿\¬Kp\Í\È:@eo)\Á\Î+¿ˇÕã_\È:@«∫∏ç\Ë+¿BôFìã\È:@Û!®\ZΩ\‚+¿\Õ√πÜ\È:@â\n\’\Õ\≈\ﬂ+¿]˚z\È:@í\·\n(\‹+¿®5\Õ;N\È:@l{ª%9\ÿ+¿0\⁄r.\È:@\Ëº\∆.Q\’+¿\0;7m\∆\È:@∆æd\„¡\Œ+¿˘0{\Ÿv\Í:@DN_\œ\◊\Ã+¿Œä®â>\Î:@b˘Ûm¡\ +¿bıG\Ï:@\Ì\Ôlè\ﬁ\»+¿fæÉü\Ï:@\‡º8Ò\’\∆+¿≤\ÿ&ç\Ì:@Çî0\√+¿˚$w\ÿD\Ó:@´\œ\’V\Ïø+¿!…¨\ﬁ\·\Ó:@${Ñö!Ω+¿ %vmo\Ô:@|,}ËÇ∫+¿®\‚\∆-\Ê\Ô:@6#É\‹E∏+¿(\ 4ö:@3\‚\–(µ+¿\÷\0•°FÒ:@VE∏…®≤+¿µ2\·ó˙Ò:@\\t≤\‘zØ+¿@QŸ∞¶Ú:@\Óïy´Æ´+¿Ò\∆O\„Ú:@Ùm¡R]®+¿-	PS\ÀÚ:@bôπ¿•+¿∆ãÖ!rÚ:@7\€§+¿¨\…SV\”Ò:@wˆï\È°+¿\›BW\"PÒ:@ˇÇ\0°+¿£\”0|:@8J^ùc†+¿¨êÚìj\Ô:@J∂∫ú†+¿R*\·	Ω\Ó:@z\Ô\«\Ìü+¿Éái\ﬂ\Ï:@#/kbÅü+¿îÄF\È:@öó\√\Ó;û+¿†¡¶Œ£\Ê:@¯Ñú+¿üàÇ\Â:@™úˆîúõ+¿§6qrø\„:@å¯N\Ãzô+¿ò˘~\‚:@\«fG™\Ôî+¿Fx{\‚:@\Ë\‹\Ìzií+¿N^d~\·:@\ÍX•ÙLè+¿§\Ã&¿\‡:@Fy\ÊÂ∞ã+¿äZö[!\‡:@£[Ø\ÈAâ+¿à¬£ç\ﬂ:@\–D\ÿÑ+¿ˇ\"h\Ã$\ﬁ:@qN`:}+¿\‘Ûn,(\0;@\07ãs+¿î\€ˆ=\ÍW;@\ﬁ\‰∑\Ëdq+¿˝i£:X;@Œ•∏™\Ïs+¿˘*8ºX;@æ**w+¿∞\Áå(Y;@¸ã†1ìx+¿Äõ≈ãÖY;@˜ ºU\◊y+¿Çç\Î\ﬂıY;@\ƒ	Lßu{+¿\'N\Ów(Z;@¡:é*}+¿<†l\ Z;@ıæÒµg~+¿±S¨\ZÑY;@™Ò\“MbÄ+¿\‡/fKVY;@l_@/‹Å+¿t—êÒ(Y;@Ù˚˛ÕÉ+¿0Å[wÛX;@L\√1Ö+¿Ë°∂\r£X;@∏\Z£Ü+¿ñ\ÕíZX;@ì7¿\Ãwà+¿-\nª(zX;@Å\ÍDä+¿ﬂ•\‘%\„X;@*U¢\Ï-ç+¿¬á-Y;@Ø\ÏÇ¡5è+¿%=≠NZ;@\Ô˛xØZë+¿¯o^ú¯Z;@B>\ËŸ¨í+¿\Ã\Ô4ôÒZ;@a4+€áî+¿¶|™F[;@\»\“≈¶ï+¿D0.[;@\0©Mú‹ó+¿ø—é~[;@ﬁØ|∑ô+¿rP\¬L[;@\nü≠Éõ+¿Û\ ı∂ô^;@pµN\\éü+¿\Ï4\“Ry_;@`\‰eM,†+¿bº\ÊUùa;@ ’∞\ﬂ£+¿\◊j{a;@±\‹\“jH§+¿\Ï1ë\“`;@\◊/\ÿ\r€¶+¿Õ∞Q\÷ob;@T¸\ﬂ™+¿GétFb;@Ω4EÄ”´+¿¯TN{Jb;@c`\«≠+¿õ\«a0a;@E)!XUØ+¿\ÍuëBa;@∞X\√E\Ó±+¿1óTm7a;@*T7≥+¿7TåÛ7a;@Ä)¥¥+¿<\ƒy8a;@≥x±0D∂+¿xe®äa;@RDÜUºπ+¿∞çx≤õa;@o≠mæ+¿\·].\‚;a;@\»{\’ Ñø+¿;\√‘ñ:`;@Ñ\÷√ó¡+¿1\Î\≈PN`;@XéêÅ<\√+¿A∏\nı`;@ıúÙæÒ\≈+¿i˛ò÷¶a;@~êe¡\ƒ\«+¿^-wb;@2\…\»Y\»+¿\Ì(\ŒQGc;@4\÷˛\Œˆ\»+¿˛ûXß\ c;@JCçB\ +¿˙Gﬂ§id;@ô\’;\‹\Õ+¿\‚∂Ùd;@\€LÖx$\Œ+¿∑úKqUe;@y=ò\œ+¿-Ø\\oõe;@6Ò∫~\—+¿m\‰∫)\Âe;@\ÂFëµÜ\“+¿πß´;g;@àûîI\r\’+¿≠még;@ç~4ú2\◊+¿y;\¬i¡g;@Æ\’ˆB\Ÿ+¿ zR&5h;@Ùz\ƒ\Ë\Ÿ+¿\‡ıô≥>i;@Ω\»¸\Z\Ÿ+¿N)Øï\–i;@\œL0úk\ÿ+¿àW\Œj;@y\Ã|\◊+¿]ø`7lk;@\Ô;Ü\«~\÷+¿éØ=≥$l;@Ÿ±à\◊\’+¿Ùà\—sm;@\0U‹∏\≈\‘+¿]•ª\Îl;@5F\Î®j\“+¿\Õ\‰õmnl;@qç\œdˇ\Ã+¿\—tv28n;@~£<Û\ +¿ö[!¨\∆n;@Ü\»\È\Î˘\ +¿\œ¯æ∏Tq;@\‰÷§\€\…+¿∑µÖ\Áq;@≠àö\ËÛ\…+¿\’=≤πjr;@.»ñ\Â\Î\ +¿áR{ms;@˜:©/K\À+¿¸V\Î\ƒ\Ât;@\¬Pán\…+¿A∂,_óu;@\÷6\≈\„¢\ +¿AJ\Ï\⁄\ﬁv;@l!\»A	\À+¿î/h!w;@Y\›\Í\…+¿MK¨åv;@¨êÚìj\«+¿\Ó\È\Íé\≈v;@X·ñè§\ƒ+¿\ ƒ≠Çx;@3QÑ\‘\Ì\ƒ+¿ΩqRò˜x;@Ø\“\›u6\ƒ+¿m°ıy;@\÷\„æ\’:¡+¿\“nÙ1|;@˜X˙¿+¿c\“\ﬂK\·};@y=òø+¿Hâ]\€\€};@º\ÊUù’∫+¿å¯N\Ãz};@\'áO:ë∏+¿ù*\ﬂ3};@`¯nÛ∂+¿4ª\Ó≠H|;@æ›í∞≥+¿6Ü\Â\œ{;@î\√\’∞+¿\'OYM\◊{;@ôg%≠¯Æ+¿îær\ﬁ{;@:\ËΩ≠+¿M/1ñ\È{;@(\Ô\„hé¨+¿eã§\›\Ë{;@õ9$µP™+¿µ\·∞4{;@ C\«*©+¿\"4Çç\Î{;@á¡¸2ß+¿øE\'K≠{;@∆àD°e•+¿zpw\÷n{;@\Ô\‰\”c£+¿∑ñ\…p<{;@∏YºX¢+¿\€¯ï\r{;@¡nÿ∂†+¿u\Êz;@∏Kuü+¿*≠ø%\0{;@ãßipõ+¿üW<ıH{;@∫h\»xîö+¿Ã∏©Å\Ê{;@*ˇZ^ô+¿µ6ç\Ìµ|;@±u≠Ωó+¿F#üW<};@ßŒ£\‚ˇñ+¿≥~31]Ä;@±ã¢>ñ+¿¡ß9yëÅ;@˜é\Zbñ+¿pµN\\éÉ;@{ÜpÃ≤ó+¿^ª¥\·Ñ;@\ÎT˘ûëò+¿\ﬂ\≈˚q˚Ö;@ˇñ\0¸Sö+¿ôE(∂ÇÜ;@\◊3\¬€õ+¿UK:\ ¡à;@*sÛç\Ëû+¿¢zk`´à;@Î´´µ†+¿S$_	§à;@\ÃC¶|¢+¿˝Ç›∞mâ;@_Cp\\∆•+¿1[≤*ä;@π˚-¶+¿\œh´í»ä;@9D‹úJ¶+¿R\Ó>\«Gã;@]˚z\·¶+¿¨\‰.é;@û(	â¥•+¿=)ì\Zé;@QΩ¬¢+¿∏! _é;@°/Ω˝π†+¿\ÌúfÅé;@\Àh\‰Ûäü+¿KÆbÒõé;@®(Nû+¿6\\‰ûÆé;@\’Í´´ù+¿	ß/˙é;@+áô+¿\—6Æè;@w°πN#ï+¿KØ\Õ\∆Jê;@±2\Z˘ºí+¿$\Ÿ@∫ê;@\œg@Ωë+¿â#Dë;@Ω¶•ê+¿%\Ë/Ùàë;@E\Á\·é+¿QÖ?√õë;@∂ı\”÷å+¿OWw,∂ë;@Ù¡26tã+¿Éˆ\Í\„ë;@tCSv˙â+¿<ÉÜ˛	í;@á¸3É¯à+¿]7•ºVí;@Ö˜à+¿Ñü8Ä~ì;@Æ\”HK\ÂÖ+¿w†Nytó;@uÄ\‘&~+¿e\ZM.∆ò;@˛De√öz+¿D\¬˜˛ô;@_ó\·?\›x+¿t\ÓvΩ4ô;@gE\‘Düw+¿\ÃbbÛqô;@Æªy™Cv+¿¸é·±üô;@A,õ9$u+¿V-≤ô;@•t{Is+¿cAaP¶ô;@æ˘\r\rr+¿(õrÖwô;@ˇ!˝ˆup+¿\n+TTô;@¸èLáNo+¿òßsE)ô;@:\À,B±m+¿ê¸6ƒò;@V\Ï1ëj+¿Œ®˘*˘ò;@ˇ>\„¬Åh+¿BôFìãô;@¯UπP˘g+¿Òbaàúö;@;MÑ\rg+¿gdêªõ;@9(a¶\Ìg+¿$π¸áÙõ;@]lZ)j+¿u/3lú;@ïG7¬¢j+¿£êdV\Ôú;@ÉßZk+¿Q\‹Ò&øù;@≥^\ÂDk+¿\Ï´aû;@\€l¨\ƒ<k+¿\€O\∆¯0ü;@	˛∑ík+¿[\Ìa/†;@ø∂~˙\œj+¿,∏¿†;@üêù∑i+¿}∞å\r°;@zn°+h+¿§ä\‚U÷û;@\Ámlv§Z+¿H©Ñ\'Ùû;@9(a¶\ÌW+¿X´vMHü;@\∆G\ÂV+¿\’&N\Ów†;@ø∑\È\œ~T+¿\›ŒæÚ °;@t\Ì\ËÖS+¿X9¥\»v¢;@v√∂EQ+¿cÚò˘¢;@§ng_yP+¿ˇ+j§;@á˙]ÿöM+¿VÒF¶;@ø**ˇJ+¿\ j∫û\Ë¶;@KÆbÒõJ+¿‘Å¨ßV´;@@¯P¢%O+¿≤J\Èô^Æ;@\Í\ÁME*T+¿\÷wıÆ;@/¿>:uU+¿t_\ŒlØ;@©P\›\\¸U+¿é∞;@-≤ù\ÔßV+¿¥íV|C±;@\È\Ó:ÚW+¿{\⁄·Ø±;@Úî\’t=Y+¿•øó¬É≤;@}\ËÇ˙ñY+¿oK\‰Ç3¥;@EÒ*kõZ+¿2≠Mc{µ;@k+ˆó\›[+¿EÇ©f÷∂;@ô~âx\Î\\+¿U¯3ºY∑;@=\Ó\Œ\⁄]+¿\«ÚÆz¿∏;@H\‹c\ÈC_+¿y\Íë∑π;@x%\…s}_+¿/OÁä∫;@©›Ø|_+¿±ä72èº;@•û°º_+¿x}\Ê¨OΩ;@#Ü∆§_+¿gõ\”æ;@\nfL¡\Z_+¿\Ÿ\—8\‘\Ôæ;@øÛãÙ_+¿\ÿe¯O7¿;@\‚;1\Î\≈`+¿Ã∂\”÷à\ƒ;@v\›[ëò`+¿∑&›ñ\»\≈;@òÖvN≥`+¿5\–|\Œ\›\∆;@pŒà\“\ﬁ`+¿é\È	K<\»;@2t\Ï`+¿v7Ou\»\…;@;MÑ\r_+¿\Œoòhê\ ;@a\ﬁ\„L^+¿íó5±¿\À;@ƒØX\√E^+¿ZÄ∂’¨\œ;@\œ,	PS[+¿∞\Áå(\—;@r7à÷äV+¿ÆbÒõ\¬\“;@C=}˛P+¿¡\‚p\ÊW\”;@G\»@û]N+¿ºØ Ö\ \”;@_\rP\ZjL+¿gùÒ}q\’;@ôπ¿\ÂI+¿—ë\\˛C\Ó;@\◊1Æ∏8í+¿Æ∏8*7\Ì;@∫û\Ë∫ì+¿\Ô5&\ƒ\Ï;@öœπ€ï+¿\’?àd\Ï;@ùùéíó+¿ ä\·\Í\0\Ï;@Û¨§ﬂò+¿Ö$≥z\Î;@kÅ=&Rö+¿\√ÛR±1\Î;@\„Pø[õ+¿\'/2ø\Í;@¢≤aMù+¿Xˇ\Á0_\Í;@-\Ïiáøû+¿Ú\È±-\Í;@ù\◊\ÿ%™ü+¿a\√\”+\È;@\Ÿyõ°+¿çzàFw\Ë;@FC∆£T¢+¿.»ñ\Â\Á;@\Î®jÇ®£+¿≥ò\ÿ|\\\Á;@æ€ºqR®+¿\‚\ÀDR\Á;@ ∏\ ´+¿¥t\Á;@\ÿF<\ŸÕ¨+¿^-w\Ê;@\⁄9\Õ≠+¿5C™(^\Â;@tE)!X≠+¿¯k≤F=\‰;@¸6\ƒx≠+¿úi\¬ˆì\·;@8fŸì¿Æ+¿ä)x\n\·;@≠•Ä¥ˇ±+¿sı∏o\·;@∏sa§µ+¿\Ÿ|\\*\‚;@öîÇn/π+¿40Ú≤&\‚;@h\«,{∫+¿ˇÀµh\‚;@z\ƒËπΩ+¿\·\ÁS\«\‚;@ˇ>\„\¬¡+¿\\\∆M\r4\„;@≤KTo\r\ƒ+¿&ßvÜ©\Â;@!≠1\ËÑ\»+¿;pŒà\“\Ê;@∞™^~ß\…+¿\‡0\— \Á;@\„\√\Ïe\À+¿~\«\ÿ\œ\Ê;@IúQ\Õ+¿úMG\07\Á;@L\‡\÷\›<\’+¿\⁄\»uS\ \Á;@6\È∂D.\ÿ+¿IΩßr\⁄\Á;@ñîª\œÒ\Ÿ+¿ÜÆD†˙\Á;@BØ?â\œ\›+¿d> –ô\Ï;@yv˘\÷\ﬂ+¿gùÒ}q\Ì;@â\n\’\Õ\≈\ﬂ+¿x\Ó=\\\Ó;@NôõoD\ﬂ+¿™Å\Ês\Ó\Ó;@w¢$$\“\ﬁ+¿≥\Ó\—Ò;@)YNB\È\€+¿z\ƒËπÖÚ;@π˛]ü9\€+¿2\√FYÛ;@\'à∫@\⁄+¿\Î9\È}\„Û;@\‚|~\Ÿ+¿ô\”e1±ı;@£\Œ\‹C\¬\◊+¿Tsπ¡P˜;@y¨\‰\÷+¿KÃ≥íV¯;@xè˝,\÷+¿î˘Gﬂ§˘;@\¬j,am\‘+¿G´Z\“Q˙;@é\Ê\»\ /\”+¿\·\“1\Á˚;@¥é™&à\“+¿\»“á.®˚;@ß≥ì¡Q\“+¿§R\Ïh¸;@án˘H\“+¿j˘Å´<˝;@7P\‡ù|\“+¿ni5$\Ó˝;@\”k≥±\”+¿O \Ï´˛;@ÄJï({\”+¿2U0*©ˇ;@}@†3i\”+¿™\‘\ÏÅV\0<@Ãñ¨äp\”+¿¢+\‹Ú<@∑_>Y1\‘+¿\√\’<@\Íx\Ã@e\‘+¿\Êï\Îm3<@\›|#∫g\’+¿\Áß8º<@\ ä;\ﬁ\‘+¿\÷\≈m4Ä<@Ìöê\÷\‘+¿%∞9\œ<@6î⁄ãh\”+¿Ú%Tpx	<@\0´#G:\”+¿õ\‚qQ-\n<@èUJ\œÙ\“+¿\»`≈©\÷\n<@ø\r1^Û\“+¿?\‡ÅÑ<@Û!®\ZΩ\“+¿hv\›[ë<@\œˆ\Ë\r˜\—+¿ë9∂û\r<@Eøï\Ï\–+¿\Â\“¯ÖW<@˚\Ái¿ \—+¿\‚\…nfÙ<@\Ê¨O9&\”+¿ë∫ù}\Â<@5\Îå\Ôã\”+¿‹Ç•∫Ä<@ıı|\Õr\—+¿f6\\<@cE\r¶a\–+¿\Ï˚pê<@y=ò\œ+¿®REÒ<@.\Z2\Õ+¿üÆ\ÓXl<@≥±Û¨\Ã+¿ÇUıÚ<@£Ø \ÕX\Ã+¿\œg@Ω<@µ\ƒ\ h\‰\À+¿åÙ¢vø\Z<@µ}\Ã\Ã+¿m\«\‘]<@\"OíÆô\Ã+¿ıeiß\Ê<@\Èö\…7\€\Ã+¿∑\”÷à` <@vq\r\‡\Õ+¿˘á-=ö\"<@˜u\‡ú\Õ+¿ô~âx\Î$<@\‡ÿ≥\Á2\Õ+¿Çê,`\'<@F–òI\‘\À+¿‰ûÆ\ÓX(<@X\ÂB\Â_\À+¿µ£8G)<@[A\”\À+¿:ñw\’*<@•0\Ôq¶\…+¿,æ-X*<@ª,Dá\»+¿=Å∞S¨*<@∏\\˝\ÿ$\«+¿¸¥W+<@)=\”Kå\≈+¿f¿YJñ+<@˛\—7i\Z\ƒ+¿jºtì,<@¯ßTâ\¬+¿d≤∏ˇ\»,<@IddY¿+¿\Œ7¢{\÷5<@G;n¯›º+¿O¨S\Â{6<@MÑ\rOØº+¿Dá¿ë@7<@U.T˛µº+¿\rnk\œ7<@©i”º+¿A°Gå:<@#K\ÊXﬁΩ+¿¡˝Ä<<@ıg?RDæ+¿º—ì2=<@™gx≥æ+¿D‘∑\Ã=<@°◊ü\ƒ\Áæ+¿˜ôù><@+ˆó›ìø+¿É\√\"R?<@Ü\Ë8¿+¿ˆ≥Xä\‰?<@\–(]˙ø+¿\¬5wÙø@<@-§˝¿+¿≥E\“nÙA<@{Ç\ƒv˜¿+¿ZH¿\ËÚB<@z\·ŒÖ¡+¿ÒÒ	\ŸyC<@\ \≈X\«¡+¿éïòg%E<@nLOX\‚¡+¿MáNœªE<@>%\Á\ƒ\¬+¿@QŸ∞¶F<@i\¬+¿0ù\÷mPG<@€æG˝ı\¬+¿œÅ\ÂH<@eÆπ\√+¿!\"5\ÌbJ<@B\Î\·\À\ƒ+¿u\ËÙºK<@Éä™_\È\ƒ+¿\Â\r0ÛL<@¢E∂Û˝\ƒ+¿4¯˚\≈lM<@SAE’Ø\ƒ+¿\ÌI`sN<@KXc\'\ƒ+¿∂%!ëN<@\0™∏q\√+¿\nÑùb\’P<@\–(]˙ø+¿ıcô~Q<@ïï-ø+¿ª_¯nS<@a§µ˚Ω+¿a2U0*U<@[C©Ωàæ+¿¨™ó\ﬂU<@\Z\‹\÷ûø+¿úlw†V<@\ÿÒ_¿+¿B?SØ[X<@˛HV¡+¿\«ïF\Ã\\<@e∏u\¬+¿MÙ˘(#^<@÷çwG\∆\¬+¿2í=B\Õ`<@0ù\÷mP\√+¿¿±g\œeb<@5\rä\Ê\ƒ+¿\„\‡\“1c<@!\È\”*˙\√+¿t\Î5=(d<@\›$Åï\√+¿á\ﬂM∑\Ïd<@¸ﬁ¨¡\√+¿&\ƒ\\Rµe<@\‹,^\ƒ+¿`\«ïf<@\…uS\ k\≈+¿\‡\◊HÑg<@\ﬁVzm6\∆+¿IÜ[\œh<@}ZEh\∆+¿W\Î\ƒ\Âxi<@É›∞mQ\∆+¿ò4F\Î®j<@&ßvÜ©\≈+¿\n±àak<@°-\ÁR\\\≈+¿‰†Ñôn<@|~!\ƒ+¿¿@ Co<@\ÕÇ9z\ƒ+¿\‚\…nfÙo<@Ò~\‹~˘\ƒ+¿\Ëyíp<@ÒHº<\≈+¿†ãÜåGq<@n¬Ω2o\≈+¿{¢\Î\¬r<@tE)!X\≈+¿Dâñ<ûr<@\ÓfÖ\"\≈+¿\ PS\Ès<@ó\‚∂\ƒ+¿6\ ˙\Õ\ƒt<@a4+€á\ƒ+¿\ƒ	Lßuw<@u\ÀÒ\√+¿)H4y<@N\’=≤π\¬+¿ö\È^\'ıy<@i®QH2\√+¿∑\Ì{\‘_{<@\»~Kë\ƒ+¿æ€ºqR|<@ü\«(œº\ƒ+¿â\ÎW\\Ä<@˚Øs\”f\ƒ+¿\‚ÃØ\Ê\0Å<@o+Ω6\√+¿D˙\Ì\Î¿Å<@\«/ºí\‰¡+¿\‹\„5ØÇ<@ív£è˘¿+¿4Û\‰öÖ<@∞9œÑæ+¿Ü©-uêá<@;±O\0Ω+¿C=}˛à<@?åmº+¿ë\'I\◊Lä<@¡\„€ª+¿IhÀπã<@≠méª+¿,*\‚tíç<@]pø∏+¿Ò°DKè<@\—6Æ∑+¿\ÈE\Ì~ë<@ø\ÓtÁâ∑+¿B`\Â\–\"ì<@±§\‹}é∑+¿)\Ëˆí∆î<@˚Zó\Z°∑+¿ŸØ;\›yñ<@uX·ñ∑+¿\Z£Æµó<@oF\ÕW…∑+¿\Ã\—\„˜6ô<@l\ÕV^Ú∑+¿P)îù<@\«.QΩ5∏+¿có®\ﬁ\Z†<@1\nÇ«∑∑+¿\Í{\r¡q°<@^,ë”∑+¿y\À’èM¢<@úº\Ë+∏+¿\⁄(∑\Ì£<@ñ{ÅY°∏+¿:∞!•<@N&nƒ∏+¿\Îßˇ¨˘•<@\‚X∑—∏+¿êim\Z€ß<@\“S\‰π+¿uëBY®<@\◊4\Ô8E∑+¿P≈ç[®<@ı9D‹¥+¿7®˝\÷N®<@®¸ky\Â≤+¿˙,AF®<@ \‘E\ne±+¿\ÈÛQF\\®<@®\‚\∆-\ÊØ+¿\Õ\‰õmn®<@?\„\√\Ï≠+¿{¯2QÑ®<@¿>:u\Â´+¿çónÉ®<@à÷ä6«©+¿æ€ºqR®<@hñ®©•+¿©2åªA®<@\⁄T\›#õ£+¿ zR&5®<@™\’WW¢+¿\„¬Åê,®<@mésõ†+¿\‚\…nfÙß<@i©º\·ú+¿,cC7˚ß<@M!u;õ+¿ù,µﬁß<@8\€‹òûò+¿ûy9Ïæß<@Ç\Á\ﬁ\√%ó+¿]3˘fõß<@pó˝∫”ï+¿¢|Aß<@˜≠÷âì+¿§U-\È(ß<@\–CmFë+¿uÆ(%ß<@\\ïõ®ç+¿zrMÅÃ¶<@1^Û™Œä+¿`\«ï¶<@|C\·≥uà+¿˛c!:¶<@π4~·ïÑ+¿£ì•\÷˚•<@c%\ÊYIÉ+¿\Èù\n∏\Á•<@\Ã	\⁄\‰Å+¿®W\ 2ƒ•<@üwcAaÄ+¿W|C·≥•<@\‡\ŸΩ\·~+¿%≥zá€•<@°jÙjÄz+¿Y∑\—\0¶<@\Î\‡`obx+¿\Ÿ\Èuë¶<@4+€áºu+¿ª@jß<@Té\…\‚˛s+¿E∏…®2®<@q:q+¿6\Á\‡ô®<@™CnÜp+¿0Û¸ƒ©<@;\Zá˙m+¿©à\”I∂™<@v\¬Kp\Ík+¿&qVDM¨<@º\Õ\'Öi+¿K™≠<@\\\ËJ™g+¿^Ñ) •≠<@B@æÑ\nf+¿;Ú\œÆ<@óåc${d+¿\›Eò¢\\Æ<@á˝ûXßb+¿~SX©†Æ<@\Œ›Æó¶`+¿à†jÙj∞<@ZπòZ+¿≥ıµ.±<@\ÏMY+¿líÒ+≤<@S\ k%tW+¿L\ƒ[\Áﬂ≤<@áQ<æU+¿M1AG≥<@\0!ÆT+¿$0‹≥<@˜?¿ZµS+¿Â¥ß‰ú¥<@º<i\·R+¿w°πN#µ<@°ºè£9R+¿\Í]º∑∑<@˚`≠\⁄M+¿L\∆1í=∂<@2Æ∏8*G+¿2\0«ûµ<@‹Å:\Â\—E+¿«É-v˚¥<@∞»ØbC+¿éwG\∆jø<@òi˚WV:+¿ÆfùÒ}\’<@8¯\¬d™0+¿\Õ\Õ7¢{\÷<@?˙\ÓV.+¿Ûqm®\◊<@U¢\Ï-\Â,+¿\‰I\“5ì\◊<@h[\Õ:\„++¿pñí\Â$\ÿ<@m±ü*+¿an˜rü\ÿ<@ãO0û)+¿íìâ[\Ÿ<@f2\œg(+¿qê\Â\⁄<@\ﬂjù∏\'+¿iè\“\·\›<@qrøCQ +¿qN`\ﬁ<@N∂Å;P+¿æHâ]\ﬂ<@~ß…å∑+¿p≥x±0\‡<@E†˙ë+¿Eøï\Ï\‡<@˙õPàÄ+¿{˘ù&3\‚<@\…ˇ\‰\Ô\ﬁ+¿Æg\«,\„<@Ø\'∫.¸+¿n¿\Áá\Ê<@óo}Xo+¿\Õ\Àa˜\Á<@≈´¨m+¿(Hlw\Ë<@çbπ•\’+¿˛e˜\‰a\È<@\Õ\Êq\Ã+¿z˛¥Qù\Í<@°¢\ÍW:+¿\Ëı\'Òπ\Î<@AE’Øt+¿w°πN#\Ì<@W\Î\ƒ\Âx\r+¿\√9}=\Ô<@∏îÛ\≈\ﬁ+¿j3NCTı<@8/N|µ+¿¿ñWÆ∑ı<@\Ìô%j+¿nã2dˆ<@òP¡\·+¿\»}´u\‚ˆ<@Y¡oCåˇ*¿q\„Ûs˜<@H4Å\"˛*¿òáL˘¯<@w-!Ù¸*¿^/M\‡¯<@\›\ÕSr˚*¿\ﬁu6\‰ü˘<@kæ*˙*¿ò˘~˙<@zãá˜¯*¿ùŸÆ\–˚<@Lk\”\ÿˆ*¿¢\’\…ä˚<@!Æúı*¿Qæ†Ö¸<@sÇ69Ù*¿\ÁˇUGé¸<@¬£ç#\÷Ú*¿!\»A	3˝<@É<Ö\\Ò*¿\Â^`V(˛<@¶”∫\rj\Ô*¿ÒÒ	\Ÿyˇ<@\„n≠\Ì*¿™FØ\0=@¨\«}´u\Í*¿Iª\—\«|\0=@≥\'Å\Õ9\Ë*¿\»zjı=@U˙	g∑\Ê*¿\¬4=@´\ÃC¶\‰*¿%\œı}8=@\÷6\≈\„¢\‚*¿´\ÎPMI=@-\Œ\ﬁ*¿Q€ÜQ=@n0\‘aÖ\€*¿\⁄W§ß=@©k\Ì}™\⁄*¿Q†O\‰I\n=@ÜÆD†˙\◊*¿§ˇ\ÂZ¥=@%≠¯Ü\¬\œ*¿ÙÜ˚»≠	=@ÿ∂(≥A\Œ*¿\ÏL°Û\Z=@-%\ÀI(\Õ*¿\◊\€f*\ƒ=@˚]ÿö≠\Ã*¿P\»\Œ\€\ÿ=@;\‚ê\r§\À*¿ÆfùÒ}\r=@±O\0\≈\»\ *¿£\ÍW:=@¸ﬁ¶?˚\…*¿Ii6è\√=@d;\ﬂOç\«*¿L¸Q\‘=@	oB@\∆*¿|ÅY°H=@m\„OT6\ƒ*¿eˇ<\r=@<¿ì.\√*¿Àüo=@jhwH¡*¿˚\Ë‘ï\œ=@\r\‡-ê†¿*¿\ \‹|#∫=@zo¿*¿E\÷\ZJ=@ˆ—©+ø*¿!\"5\Ìb\Z=@m±æ*¿d#Ø\Î=@†T˚t<æ*¿Yk(µ=@N^d~Ω*¿,J	¡™=@\„\ƒW;äª*¿lxz•,=@†\ƒvº*¿∑aè=@]›±\ÿ&Ω*¿ys∏V{ =@ˆ—©+ø*¿\»zjı!=@!\‰K®¿*¿á§J&#=@â(&oÄ¡*¿díë≥$=@\\qqTn\¬*¿]n0\‘a%=@ûy9\Ïæ\√*¿ù∫ÚY&=@\’˝LΩ\∆*¿ÚöWuV\'=@Mıd˛\…*¿˝\r⁄´\'=@ÄÛ\‚\ƒW\À*¿˙\ÓVñ\Ë(=@ˆ&Ü\‰\Ã*¿\r8K\…r*=@äWY\€\œ*¿ê-\À\◊e,=@Ñ†£U-\Ÿ*¿/\·\–[<,=@¸\0§6q\⁄*¿\"\‚\ÊT2,=@l≥±Û\‹*¿ïeàc],=@\Á\∆ÙÑ%\ﬁ*¿î\Ÿ ìå,=@Ú\Õ67¶\ﬂ*¿∆ä\ZL\√,=@:\Õ\Ì\·*¿∂ilØ-=@õsLh\‚*¿e\„¡ª-=@0ù\÷mP\„*¿6ëô\\.=@\‘\n\”˜\Z\‚*¿IVÒ.=@\nπRœÇ\‡*¿>x\Ì“Ü/=@v\·\ÁS\ﬂ*¿&\»®p0=@˘Ûm¡R\›*¿Û\Êp≠ˆ0=@m\06 B\‹*¿]ã†m1=@üëç`\€*¿Ω\·¥\‡1=@~¸•E}\⁄*¿]1#º=4=@B\Î\·\À\‘*¿p±¢\”4=@\«Aúá\”*¿$F\œ-t5=@)íØR\“*¿E7ß6=@8æˆÃí\–*¿~9≥]°7=@Ü\Ë8\–*¿™∑∂J8=@¢|A	\–*¿üuçñ9=@G¨≈ß\0\–*¿-\Œ:=@l\Í<*˛\œ*¿ïû\È%\∆:=@π•’ê∏\œ*¿≠€†ˆ[;=@7¬¢\"N\œ*¿i´í\»><=@-@\€j\Œ*¿\"3∏<>=@u™)\…\ *¿bèo?=@vQÙ¿\«\»*¿Ï¶î\◊J@=@\‡?ˇ=\»*¿∞\‚\ A=@É›∞mQ\∆*¿É¿ °EB=@h?RDÜ\≈*¿B[Œ•∏B=@o∏è‹ö\ƒ*¿epîº:C=@f/\€N\√*¿l#ˆ	D=@‹Å:\Â¡*¿ úO´D=@\»%é<¡*¿ZÅ!´[E=@\„¬Åê,¿*¿ÇsFîˆF=@u\»\Õpæ*¿\⁄\»uS\ G=@\ﬂ˙∞ﬁ®Ω*¿Ω˝πh\»H=@¸é·±üΩ*¿˙òtJ=@)B\ÍvˆΩ*¿ª%9`WK=@\ÁoB!æ*¿π\«“á.L=@tb\ÌcΩ*¿~´u\‚rL=@\ÿóqª*¿;˛M=@Ä^ª¥π*¿ŒéT\ﬂ˘M=@k\ÔSUh∏*¿ü;¡N=@\◊Læ\Ÿ\Ê∂*¿\¬QÚ\ÍO=@˘k∏»µ*¿≠lÚñO=@\…6ëô≥*¿•û°ºO=@]˝\ÿ$?≤*¿5ôÒ∂\“O=@≤ÉJ\\«∞*¿4Å\"1P=@¿\Àe≠*¿=‘∂aP=@\Ï\’[´*¿h\\W\ÃP=@‹Éê/©*¿ë\'I\◊LZ=@Æπ£ˇ\Â≤*¿{Nz\ﬂ¯Z=@#K\Ê∞*¿˙≥)\"[=@Ec\Ì\ÔlØ*¿Û\Â\ÿG[=@\¬\÷l\Â≠*¿\⁄T\›#õ[=@0Ùà\—s´*¿\›{∏\‰∏[=@\"5\Ìbö©*¿ ó8Ú@\\=@\ËŸ¨˙\\•*¿¯nÛ\∆I]=@ç\”U¯£*¿1{\Ÿv\⁄^=@≤à\◊ı£*¿µ\ƒ\ h\‰_=@ı∏oµN§*¿\ÂFëµÜb=@M2rˆ§*¿__\ÎRc=@•2\≈•*¿r¸Pi\ƒd=@Gç	1ó§*¿ó™¥\≈e=@´—´J£*¿\€¿®Sf=@¨\«}´u¢*¿¢`\∆h=@Ä+Ÿ±†*¿òLåJj=@µå\‘{*ü*¿\Õ\ËG\√)k=@≠nıúÙû*¿)\Õ\Êql=@NDø∂û*¿4Jó˛%m=@\Î\¬1Àû*¿U£Wîn=@AJ\Ï\⁄ﬁû*¿aärip=@œΩáKû*¿TW>\ÀÛp=@\\9{g¥ù*¿kÉ—Øq=@\ŒR≤úú*¿¢Ìò∫+s=@CV∑zNö*¿B^&\≈s=@©˚\0§6ô*¿¿ì.´t=@èç@ºÆó*¿B\Î\·\ÀDu=@\›xwd¨ñ*¿≤πjû#v=@B\È!\Áï*¿\ﬁ…ßw=@Vù\’{î*¿^=1x=@˜≠÷âì*¿¶`ç≥\Èx=@é∞®à”ë*¿3\Z˘º\‚y=@ó˝∫”ùè*¿Ù2ä\Âñz=@Æ,gé*¿9—ÆB\ {=@A~6r›å*¿RÒGT|=@¶\Ó\ .å*¿\›]gC˛}=@˛e˜\‰aâ*¿u~=@æ°\Ÿ:à*¿zè3M\ÿ~=@ˇ\Œˆ\Ë\rá*¿\¬€Éê=@jøµÖ*¿∂J∞8Ä=@¨\‡∑!∆É*¿èVµ§£Ä=@µ˝++MÇ*¿…™7Å=@\◊4\Ô8E*¿*¥tÅ=@]®¸ky}*¿Lo.\ZÇ=@§\Zˆ{b}*¿aäri¸Ç=@•û\–{*¿Xè˚V\ÎÑ=@5\Ó\Õoòx*¿æ›≥ÆÖ=@Cé≠gw*¿Ç;Pß<Ü=@4ˆ%v*¿ï\rk*á=@pñí\Â$t*¿®ˇ¨˘Òá=@\ ¡ls*¿vˇXàâ=@K\0˛)Ur*¿\ŒTàG\‚â=@k$	r*¿J_9ã=@°+®˛q*¿øb\rç=@£h[\Õr*¿ä>eƒç=@1{\Ÿv\⁄r*¿)x\nπí=@2Ø#\Ÿh*¿\À2êì=@˙¸\·\Ág*¿\È}\„kœî=@ê1w-!g*¿.ê†¯1ñ=@\≈7>[g*¿nâ\\pó=@ñìP˙Bh*¿BÕê*äó=@É¬†L£i*¿ıh™\'Ûó=@\Ï\ÏÜmk*¿˜w∂Goò=@tó\ƒYm*¿0du´\Áò=@l∏ [n*¿N\ÌS[ö=@∂J∞8úq*¿¶∂\‘A^õ=@£y\0ã¸r*¿\nJ\— Ωú=@\–D\ÿt*¿dÆ™\rû=@\≈X¶_\"v*¿îÇUıû=@Hm\‚\‰v*¿z9\Ïæc†=@ ä\·\Í\0x*¿\·zÆG°=@\'i˛x*¿;\ﬂOçó¢=@¨S\Â{Fz*¿\◊	m9£=@û}\ÂAzz*¿\∆R$_	§=@\nh\"lxz*¿mésõ§=@£Æµ˜y*¿¶HæH•=@Ñ,&˛x*¿\nÙâ<I¶=@EùπáÑw*¿\Ó\—\Ó#ß=@+Ü´ v*¿º!ç\n®=@t¥™%u*¿¶Cß\Á›®=@9}=_≥t*¿.sû©=@	Únt*¿Œå~4ú™=@\„\ƒW;äs*¿˝ky\Âz´=@\Ë∫År*¿m:∏Y¨=@	q\Â\Ïùq*¿\÷5ZÙ¨=@*çò\Ÿ\Áq*¿\’<G‰ª¨=@lMK¨t*¿ó©IÜ¨=@ÄÅ @Üv*¿s\⁄SrN¨=@$Cé≠gx*¿ºz¨=@˜9>Zúy*¿˝\r⁄´´=@F¥Sw}*¿@0Gèﬂ´=@ãàbÚÄ*¿Ña¿í´¨=@(ö∞\»*¿Zª\ÌBs≠=@P6\Â\n*¿∫ˆÙÆ=@˜é\Zb~*¿∏ë≤E“Æ=@x\”-;\ƒ*¿ıÇOsÆ=@]â@ıÇ*¿	§ƒÆ\Ì≠=@8i\ZÕÉ*¿h?RDÜ≠=@\«Ia\ﬁ\„Ñ*¿;˛≠=@7\0!Ü*¿\Ãün†¨=@\…væü\Zá*¿∑_>Y1¨=@\«,{à*¿\"àÛp´=@\Â{F\"4ä*¿.9(a™=@ºŒÜ¸3ã*¿\”¿\Õ\‚©=@\Í\ gyå*¿ç&c`©=@Aµmç*¿Ü¨nıú®=@*≈é∆°é*¿K\‰Ç3¯ß=@Ü\Ë8ê*¿ìp!ß=@S\–\Ì%çë*¿ßÆ|ñ\Á•=@?tA}Àî*¿Vû@\ÿ)¶=@\È\'ú\›Zñ*¿\—yç]¢¶=@„àµ¯ò*¿ıª∞5ß=@\Ô\Ê©πô*¿çBíYΩß=@+l∏ õ*¿àÚ-$®=@=Y§âü*¿m´Yg|ß=@T\›ã¢*¿fı∑Cß=@¶(ó\∆/§*¿4øöß=@\'˙|îß*¿Ü´ \Ó¶=@∑\—\0\ﬁ©*¿Rd≠°‘¶=@t\nÚ≥ë´*¿IùÄ&¬¶=@*\ƒ#ÒÚ¨*¿~p>u¨¶=@\◊i§•ÚÆ*¿\rraä¶=@\ÏO\‚s\'∞*¿\¬\Â\“¯•=@˛HV±*¿@Ω5_•=@}–≥Yı±*¿∞VÌö§=@\Îè0X≤*¿åJ\Í§=@W#ª≤*¿\r\‰\Ÿ\Â[£=@X\»\\T≥*¿Aúáò¢=@\ 4ö\\¥*¿~U.T˛°=@X\…\«\Óµ*¿]˙ó§2°=@yìﬂ¢ìµ*¿íxy:W†=@\‰eM,µ*¿˜?¿Zµü=@¿\Ì	€µ*¿ã\∆\⁄\ﬂŸû=@~ß…å∑µ*¿t&m™\Óù=@∆àD°eµ*¿¸¶∞RAù=@!\»A	3µ*¿ÅòÑyú=@5&\ƒ\\Rµ*¿N%@õ=@oÖ\…Tπ*¿[Dì7ú=@z™CnÜª*¿>\Ì\◊dù=@ßìlu9Ω*¿\«/ºí\‰ù=@h\È\næ*¿F\Í=ï”û=@\ ˝EÅæ*¿á1\ÈÔ•ú=@~\ÂAzä\Ã*¿>\ÈDÇù=@\—\Í\‰\≈\Õ*¿\Ôp;4,û=@G∞q˝ª\Œ*¿îÇUıû=@•ı∑\‡\œ*¿\‡Ù.ﬁèü=@óé9\œ\–*¿^gE‘†=@=_≥\\6\“*¿≥≤}\»[¢=@º≥v€Ö\÷*¿T;\√‘ñ¢=@ä\‰+Åî\ÿ*¿÷ã°úh£=@t\nÚ≥ë\€*¿¡oCå◊§=@fM,\›*¿“©+ü\Â•=@†¶ñ≠ı\›*¿E.8Éøß=@∞´\…S\ﬁ*¿ö%jj©=@*rà∏9\›*¿YL¸©=@\≈\0â&P\‹*¿\\´=ÏÖ™=@.7\Í∞\⁄*¿I\◊LæŸ™=@1\— O\Ÿ*¿Ç´<Å∞´=@\"˙µı\”\◊*¿iE,b¨=@Ç\„2nj\ÿ*¿oÉ\⁄o\Ì¨=@óU\ÿp\Ÿ*¿ó™¥\≈5Æ=@Xq™µ0\€*¿<ÑÒ”∏Ø=@\Á\∆ÙÑ%\ﬁ*¿I/j˜´∞=@\Â\Ìß\ﬂ*¿±\‡Çl±=@5D˛\ﬂ*¿π´Wë—±=@ãpìQe\‡*¿UÜq7à≤=@\“¸1≠M\„*¿y ≤H≥=@e\≈pu\0\‰*¿ˇzÖ˜≥=@uØì˙≤\‰*¿fÇ\·\\√¥=@XîÜ\Z\Â*¿°æeNóµ=@Ø\Œ1 {\Â*¿\Ô;Ü\«~∂=@g~5\Ê*¿\ÏˆYe¶∏=@äÆ?8\Á*¿L˚\Ê˛\Íπ=@\Z£uT5\È*¿\r34ûæ=@¢{\÷5Z\Ê*¿ÒJí\Á˙æ=@S\È\'ú\Â*¿2ZGU¿=@Í≤ò\ÿ|\‰*¿ª+ª`p¡=@\⁄Ω\·>\‚*¿9a\¬hV\¬=@\Ã\rÜ:¨\‡*¿ª∏ç\¬=@KîΩ•ú\ﬂ*¿=ö\Í\…¸\√=@Ä\ràW\ﬁ*¿ux\„ß\≈=@\Ëj+ˆó\›*¿oú\Ê=\∆=@¡Wt\Î5\›*¿$ö@\«=@´ì3w\‹*¿°J\Õ\»=@3\ﬂ¡O\‹*¿\ÂDª\n\…=@¶Ä¥ˇ\ﬁ*¿≤æÅ…ç\ =@\Z˙\'∏X\·*¿\Ì\ËÖ;\À=@µ˚\À\Ó\·*¿∑\”÷à`\Ã=@y\À’èM\‚*¿:\Ë\Õ=@y\\Tãà\‚*¿$Di\Œ=@\ƒxÕ´:\„*¿oõ©è\–=@\Óß/\‚*¿a\‡π˜p\—=@çúÖ=\Ì\0*¿Ω´0\—=@§R\ÏhJ(¿«†B\Ÿ=@äë%s<(¿()∞\0\⁄=@ı¯\√\œ\'(¿˚¨2SZ\Á=@\\=\'Ωo(¿≠äpìQÒ=@U£Wî(¿˙\—p\ \‹¸=@\»_Z\‘\'(¿¡çî-\n>@fı∑C(¿\‘`\ZÜè>@\"ã4Ò0(¿\È*\›]g>@\€j\÷\ﬂ?(¿*\„\ﬂg\\>@î.˝KRQ(¿£Àõ\√!>@ÑÅ\Á\ﬁ\√](¿$~\≈\Z.*>@ó\…p<üi(¿Ä\‘&N\Ó3>@\’=≤πjn(¿\Àgy\‹=>@˘¢=^Hw(¿Å	‹∫õG>@\„¸M(DÄ(¿*≈é∆°R>@2¨\‚çÃÉ(¿¸¥W[>@πƒëè(¿Äd:tzf>@¸ å(¿fˆyåÚl>@Ã¥˝++ù(¿9\'0ùv>@¥W}ó(¿µo\ÓØ>@’Øt><£(¿\ﬁ;jLàÅ>@N*\Zk∑(¿ï}Wˇ>@\”2R\Ô©\Ã(¿Qi{>@Ü:¨p\„(¿Ym˛_u|>@G8-x\—˜(¿ªîÑ>@˙}ˇ\Ê)¿Åí`é>@Ø\–\À\ÿ\0)¿Ÿïñëí>@∂ilØ)¿†7©0é>@»ô&l?))¿\\[%Xî>@u £a9)¿w\⁄\Zåõ>@k∫û\Ë∫H)¿\∆1í=B•>@M†àEC)¿1≥\œcî´>@oeâ\Œ23)¿:z¸ﬁ¶≥>@≤ü\≈R$?)¿ñ\Í^f∏>@vn⁄å\”P)¿?q\0˝\¬>@ \“o_V)¿çBíYΩ\√>@©2åªAl)¿∑_>Y1º>@\…>»≤`z)¿Ω©HÖ±Ω>@ÆÚ¬é)¿´≤\Ôä\‡\√>@p∂π1=°)¿W\nÅ\\\‚\ƒ>@@†3iSµ)¿-$`tyø>@wd¨6ˇ\«)¿\ƒ\"Ü\∆\»>@ux\„ß\—)¿ \Ï´\—>@Ä4f\›)¿œ†°Ç\€>@ˇ?Nò0\‚)¿T\ƒ\È$[\Â>@é\Î\ﬂıô\€)¿tó\ƒY\Ì>@\◊j{\È)¿6\‰ü\ƒ˜>@\'3\ﬁVz\Â)¿;©/K;?@2∆á\Ÿ\Î)¿\…Y\ÿ\”?@éø∑\È\Ô)¿MK¨åF?@\\\0qWˇ)¿Æ∑\ÕTà?@	â¥ç?*¿\Á¶\Õ8\r%?@Ωm¶B<*¿¨Ôéå-?@e\‚X*¿.;\ƒ?l5?@Ù\Ô9)¿x\'ü??@ﬂâY/Ü\Í)¿%ë}êeI?@ÜØØu©\È)¿\Î˛±R?@\›\Í9\È}Û)¿fNó\≈\ƒZ?@\…\Â?§ˇ)¿!<\⁄8Z?@∆®k\Ì}\n*¿\ÿ.m8,Y?@ÜWí<\◊*¿§ä\‚U\÷V?@KW∞çx\"*¿Òùòıb\\?@\“6˛De3*¿\Ë25	\ﬁ\\?@†pvkô4*¿õZ∂\÷]?@\Â}Õë5*¿oG8-x]?@±RAE\’7*¿\Ï¢ËÅè]?@sJ_9*¿∂\÷	m]?@m©Éº<*¿S\\Uˆ]]?@d\Ë\ÿA%>*¿ñ?\ﬂ,]?@J”†h@*¿r75\–\\?@›ó3\€B*¿°\ÿ\nöñ\\?@≤Ä	‹∫C*¿‰ªî∫d\\?@ò¸O˛\ÓE*¿\Ã_!se\\?@\Ê!S>M*¿ÆFv•e\\?@Én/iåN*¿\ƒ†Q∫\\?@\‰I\“5ìO*¿\„\‚®\‹D]?@¡T3k)P*¿ï\'vä]?@∫ˆÙR*¿Ä,Dá¿]?@¡ë@ÉMU*¿∑&›ñ\»]?@Qº\ ⁄¶X*¿.\‚;1\Î]?@>îh\…\„Y*¿l\È\—TO^?@˙\–ı-[*¿Ø\Œ1 {a?@8†•+`*¿¨ \Ó\Ía?@\Ó\Î¿9#b*¿)_\–Bb?@:x&4Id*¿L5≥ñb?@\\\ËJ™g*¿YLl>Æa?@\»–±Éj*¿∏\ ;a?@\‘b0m*¿Ü!Y¿`?@X9\“p*¿:ï\0U`?@o∑$\Ïr*¿∞\∆\Ÿt`?@[ÎãÑ∂t*¿T9\Ì)9_?@Òd73˙y*¿è˛ók\—^?@©\€\ŸW|*¿÷çwG^?@/0+\È~*¿\…VóS^?@\ﬂ¸ÜâÅ*¿vq\r\‡]?@\—\Èy7Ñ*¿KUø^?@çÒaˆ≤Ö*¿o¿±_?@\‘-¨á*¿§®3˜ê`?@ß≤(Ï¢à*¿±¸˘∂`a?@\“\„˜6˝â*¿†\Z/\›$b?@\Õ˝/◊ä*¿â\\pc?@u\Ãy∆æå*¿‚±ü\≈Rd?@ÑıÛç*¿0Û¸d?@Bìƒírè*¿(~åπke?@\·ó˙ySë*¿Ωåbπ•e?@Z)râì*¿œºv\ﬂe?@ñy´ÆCï*¿`<ÉÜ˛e?@i™\'Ûèñ*¿Pß<∫f?@¯\Ì∏\·ó*¿\·&£\ 0f?@øõnŸô*¿˜\Â\ÃvÖf?@\‰\‹HŸö*¿\Ì∏\·wg?@Û:\‚ê\rú*¿r1\÷qh?@\Ó?2:ù*¿”§t{i?@\’ZòÖvû*¿0EH\›j?@˜@†*¿1a4+\€k?@∂°búø°*¿\’A^&m?@¸\ƒÙ£*¿¶F\Ëg\Ím?@∂ÜR{•*¿\Ê\ËÒ{õn?@œ∫FÀÅ¶*¿JV\’\Ào?@æˆÃí\0≠*¿~sı∏o?@\Èπ-∞*¿\Z˘º\‚©o?@\’@Û9w≥*¿\Ô;Ü\«~n?@*\Âµ∫ª*¿Åq\Â\Ïm?@75\–|ŒΩ*¿\Ô_{fm?@\Œ˛@πmø*¿\»^\Ô˛l?@\"5\Ìbö¡*¿É˘+dÆl?@\“Iÿ∑\√*¿}\Ï.PRl?@\·Ò\Ì]É\∆*¿\∆o\n+l?@\ ¿-]\…*¿><Kêl?@˙\’ ò\À*¿∂˜©*4l?@QhY˜è\Õ*¿+\‹Úëîl?@\n±àa\œ*¿I\÷\·\Ë*m?@Rêh\“*¿W\ÓfÖn?@ƒóâ\"§\÷*¿(\”hr1n?@oõ©è\‹*¿Øô|≥\Õm?@åM+Ö@\ﬁ*¿¨Ôéåm?@\ﬂ\‡ì©\‚*¿¥V¥9\Œm?@${Ñö!\Â*¿1–µ/l?@f/\€N[\Î*¿\⁄\Á6\·j?@qtï\ÓÆ\Î*¿npñíi?@\⁄q\√\Ô¶\Î*¿∑C\√bh?@\"S>U\Î*¿3o\’u®f?@†Y2\«\Í*¿û#Ú]Je?@*ˇZ^\È*¿ØΩ7Üd?@eâ\Œ2ã\Ë*¿}zlÀÄc?@Ç\∆L¢^\Ë*¿m\‰∫)\Âa?@ã™_\È|\Ë*¿]\·].\‚_?@hwH1@\Í*¿d\Œ3ˆ%_?@\¬5wÙø\Ï*¿EÑ4^?@\”L˜:©\Ô*¿ÑÿôB\Á]?@RewÉ*¿ø`7l[\\?@t}Ú*¿EbÇ\ZæY?@K≠˜\Ì*¿\ÁˇUGéX?@˚ê∑\\˝*¿O\È`˝üW?@\ZÜèà)Ò*¿\Ìû<,\‘V?@\ZQ\⁄|Ò*¿í\ÀHøU?@\‚vhXåÚ*¿M-[\ÎãT?@¯àòIÙ*¿` ê°S?@≤ûZ}ı*¿pï\'vR?@…êc\Î˙*¿U\⁄\‚\ZüQ?@=\'Ωo|˝*¿)yuéQ?@\ﬂR\Œ{ˇ*¿ôùE\ÔTP?@y\À’èM+¿∑)\’N?@+kõ\‚q	+¿B\Ã%U\€M?@ÄF\È\n+¿¿%\0ˇîJ?@5sªó+¿˙úª]/I?@ÜKÆ\n+¿l{ª%9H?@\Ì\”ÒòÅ\n+¿d \œ.\ﬂF?@*7QKs+¿ò1kúE?@≠hsú\€+¿ó\0¸S™D?@´\ŒjÅ=+¿\'ºß>D?@^ÇS+¿¬¶Œ£\‚C?@Jö?¶µ+¿∑\nb†kC?@ùŸÆ\–+¿_&äêB?@vOj+¿≤ÉJ\\\«@?@3SZK+¿ÜV\'g@?@˚>$D+¿{ÜpÃ≤??@8Ωã˜+¿D0.??@(b\√+¿\ﬁs`9B>?@\0ç“•!+¿Øîeàc=?@ˇØ:r§#+¿G=D£;<?@≠\›v°π&+¿∞\‚:?@\ﬁ\Â\"æ++¿ç\‘{*ß9?@Öï\n*™.+¿»ô&l?9?@øÛãÙ/+¿4.\…6?@7n1?74+¿<á2T\≈4?@{ø—é.+¿x|{◊†3?@ˆ&Ü,+¿î\Ÿ ìå0?@ª&§5-+¿üF/?@•h\Â^`.+¿!<\⁄8.?@¥\0m´Y/+¿≤ˆw∂G+?@\’@Û9w3+¿∂dUÑõ(?@|∂ˆ6+¿õ\Â≤\—9\'?@_@/‹π8+¿\Êó«ö%?@á‡∏åõ:+¿J]2éë$?@õëA\Ó\"<+¿Ωˇè&$?@oΩ¶=+¿˙∏6Tå#?@ôÑy?+¿2v\¬Kp\"?@å.o\◊B+¿∂üåÒ!?@©¯ø#*D+¿L\‡\÷\›<!?@Ü\Âœ∑E+¿´^~ß\… ?@bfü\«(G+¿+ï\‘	 ?@ByGK+¿\Ô\Â>9\n ?@≠˙\\m\≈N+¿è˙\Î ?@Éˆ\Í\„Q+¿,Ä) ?@ÿÄqU+¿ôFìã1 ?@ı∫E`¨W+¿ˇ≤{Ú∞ ?@üëç`[+¿u!VÑ!?@≤Û¨§]+¿ô(B\Ív\"?@\È\—TO\Ê_+¿m\»?3à#?@∂\€.4\◊a+¿(+Ü´$?@›ô	Üse+¿<k∑]h\"?@y\Î¸\€eg+¿\«\røõn!?@ÑIÒÒ	i+¿&åfe˚ ?@¶a¯àòj+¿gÒbaà ?@Y¿n\›m+¿D?ç{?@aO;¸5q+¿˚\Í™@-?@\÷ˆBs+¿˚≠ù(	?@\÷\‡}U.t+¿Q¿v0b?@)Zπòu+¿PR`L?@˚±I~\ƒw+¿å\⁄˝*¿?@\Ô8EGry+¿-x\—Wê?@?ã•Hæz+¿\‰J=B?@)^emS|+¿ëdV\Ôp?@3˚<Fy~+¿ú˙@Ú?@Iÿ∑ìàÄ+¿IIC´?@xz•,CÑ+¿&TpxA?@.åÙ¢vá+¿\—]gE?@K!êKâ+¿W$&®\·?@r¡¸˝ä+¿\Î\0àªz?@ü\È%\∆2ç+¿πˇ\»t\Ë?@ºêaå+¿Ù¶\"\∆?@9^Å\ËIâ+¿&\0ˇî*\r?@Ø}Ωpá+¿!Êí™\Ì\n?@´≥Z`èâ+¿1%í\Ë	?@•Éıã+¿C=}˛?@r¬Ñ—¨å+¿˛ûXß\ ?@_\\™\“è+¿Ωè£9≤?@P\„\ﬁ¸Üë+¿∑òü?@\ŸzÜpÃí+¿˝,ú?@\Áå(\Ì\rñ+¿jâï\—\»?@≈é∆°~ó+¿\Ÿ\Èuë?@KVE∏…ò+¿eã§\›\Ëˇ>@8°áò+¿Û«¥6ç˝>@¿<d áò+¿∑–ïT˚>@#Mº<ô+¿\⁄XâyV˙>@4\◊i§•ö+¿\ÁoB!˙>@\Ïá\ÿ`\·ú+¿öœπ\€˘>@ß…å∑ïû+¿0Û¸\ƒ˘>@+˜≥B°+¿vq\r\‡˘>@h[\Õ:£+¿çA\'Ñ˙>@Çr€æG•+¿\Ô∫/g˙>@\Àd8ûœ®+¿ˇwDÖ\Í˙>@\‹/ü¨Æ+¿ê˜™ï	˚>@∂gñ®±+¿\ \¬\◊\◊˙>@Üì4L≥+¿˘¿éˇ˘>@¡¸˝b∂+¿∑\Ì{\‘_˜>@-C\Î\‚∂+¿ÛtÆ(%Ù>@\‹ı\“∂+¿\ÿıv\√Ú>@+Ü´ ∂+¿ï\’t=\—Ò>@4ú27∑+¿ƒ¨CÒ>@=\“‡∂∂∏+¿àªzÒ>@7m\∆ià∫+¿qê\ÂÚ>@x`\0\·C¡+¿$\’w~QÚ>@EΩ\‡”ú\ƒ+¿c)íØÚ>@á®¬ü\·\≈+¿?\Âò,\Ó\Ô>@âœù`ˇ\≈+¿::Z\’\Ó>@û]æıa\≈+¿S$_	§\Ï>@ZGUD\≈+¿Tq\„Û\Î>@Û;Mfº\≈+¿\rU1ï~\Í>@\Â(@\Ã\»+¿âbÚò\È>@®\‰ú\ÿC\À+¿|∑y\„\Ë>@´\ÎPMI\Œ+¿˛\”\r\Ë>@$Cé≠g\–+¿∏ìà/\Ê>@ù:\Ë\“+¿sıcì¸\‰>@YiR\n∫\’+¿⁄Æ\–\À\‰>@ıI\Ó∞\Ÿ+¿–π\€ı\“\‰>@c}ì\€+¿%\Õ\”\⁄\‰>@H¯\ﬁﬂ†\›+¿\"\«\÷3Ñ>@X®5\Õ;\ﬁ+¿)ò1k>@=òü\‡+¿}^Ò\‘#>@\∆QπâZ\‚+¿Ä\ÓÀô\Ì>@H¬æù\‰+¿Û&\Z§ >@%±§\‹}\Ê+¿∑&›ñ\»!>@_∏sa§\Á+¿¶DΩå\">@\Ÿ?O\È+¿37ﬂà\Ó%>@(d\Áml\Ó+¿$áüˇ&>@\⁄\ K˛\'\Ô+¿\Â_\À+\◊\'>@fOõs+¿“âS\Õ(>@ëBY¯˙Ú+¿µpYÖ\Õ(>@W\Î\ƒ\Âxı+¿Eøï\Ï(>@ã5\\\‰ûˆ+¿ãnΩ¶)>@ª\Ó≠HL¯+¿*rà∏9)>@\€èãj˘+¿\ËL\⁄T)>@B\œf\’\Á˙+¿ó8Ú@d)>@_9\Ôˇ˚+¿iä\0ßw)>@¡\„€ª˝+¿:[@h=(>@∞\∆\Ÿt\0,¿åÜåG©(>@	Qæ\0,¿t_\ŒlW(>@dT8,¿Ç™—´)>@y?nø|,¿|)<hv)>@ö	Üs\r,¿rÜ\‚é7)>@E\÷\ZJ\Ì\r,¿zm6Vb*>@`=\Ó[≠,¿¸Q‘ô{,>@πﬂ°(\–,¿∂Ñ|–≥->@≈ë\"ã,¿LäèO\».>@`x%\…s,¿Y\"ßØ/>@2\0«û,¿\réíW\Á0>@$}ZE ,¿\ÿc\"•1>@;¨p\ÀG\",¿U2\√2>@f°\ÿ\n\",¿\·Çà\‘4>@t	á\ﬁ\‚!,¿3jæJ>6>@£t\È_í\",¿lw\–}9>@g∏ü&,¿\œMõq\Z:>@°h¿\"\',¿∑&›ñ\»A>@\÷\‰)´\È*,¿\œ\ŸB\ÎA>@¸â Ü5-,¿¬•c\Œ3F>@6Y£¢1,¿Éh≠hsH>@\”¿\Õ\‚5,¿©/K;5O>@û\'û≥L,¿gE\‘DO>@÷çwGN,¿Ä\ràWN>@¥W}O,¿cAN>@øÄ^∏sQ,¿T\Â{F\"P>@$d \œ._,¿<¿ì.O>@ó´õ\‰_,¿\Í?k~¸M>@(Ç8\'`,¿\“S\‰M>@nh\ N?`,¿`î†ø\–K>@\«,{`,¿+°ª$\ŒJ>@\Ï¯/`,¿4+€áºI>@Õèø¥®_,¿6#É\‹EH>@]â@ıb,¿˘†g≥\ÍG>@zpw\÷nc,¿\"\∆k^\’E>@í?x\Óe,¿\"\ﬁ:ˇvE>@jMÛf,¿9\“E>@\ÃoBh,¿\\…éç@D>@Z_&j,¿-µ\ﬁo¥C>@VÑa¿j,¿Û\»<C>@˙\–ı-k,¿KUøB>@T\Z1≥\œk,¿y7RB>@Á®£\„jl,¿\◊3\¬?>@\◊1Æ∏p,¿õê\÷t>>@qxµ\‹q,¿K\‘‘≤=>@N\“¸q,¿~!<\⁄<>@ç“•Ir,¿©˙ïŒá;>@L6l±s,¿ã˝e˜\‰9>@g)YNBy,¿£\»ZC©9>@û&3\ﬁVz,¿\06 B\\9>@w†Ny|,¿77¶\',9>@¿\ËÚ\Êp},¿\nJ\— Ω8>@ÖÏºç\Õ~,¿è™&à∫7>@\ ¿-]Å,¿∑–ïT7>@iÇ,¿1µ•Ú6>@\'JB\"mÉ,¿†‹∂\Ô5>@$F\œ-tÖ,¿\È\Ô•†5>@r\√\Ô¶[Ü,¿\‹,^,5>@†3iSuá,¿g`\‰eM4>@¿\"ø~à,¿\Ê\ËÒ3>@∏\nıÙâ,¿øÛ\‚\ƒ3>@}> àã,¿[¶}3>@\»a0Öå,¿\∆G\Â2>@\råº¨âç,¿Pèmp2>@É›∞mQé,¿ó6ñ2>@ñ#d è,¿î2©°\r0>@îi4πì,¿\È\”*˙C/>@q„äãì,¿:\Ê<c_.>@˘˜î,¿∑≤Dgô->@\ÿ“£©ûî,¿~R\Ì\”Ò,>@\Án\◊KSú,¿\÷\≈m4Ä+>@j˜´\0ﬂù,¿m\‚\‰~á*>@ÒÛﬂÉ◊û,¿µâì˚*>@\Á6\·^ôü,¿yx\“\¬)>@Û\Êp≠ˆ†,¿\Ô¨\›v°)>@k\ÿ\Ôâu¢,¿Éà‘¥ã)>@˘IµO«£,¿˜\"⁄é©\'>@B“ßUÙß,¿RÅìm\‡&>@\0ë~˚:®,¿\\!¨\∆&>@kÙjÄ“®,¿∏Ku\'>@n0\‘aÖ´,¿Z)râ\'>@\√DÉ<≠,¿l\œ,	P\'>@\Ë\⁄\–Ø,¿åâB\À&>@ÄÒ\Z˙Ø,¿éÆ\“\›%>@m˙≥±,¿≠3æ/.%>@Òú˙@≤,¿\Ô∆Ç¬†$>@Wìß¨¶≥,¿sÇ69$>@êÑµ,¿ˆ≥Xä\‰#>@g≠á∑,¿ˇíT¶ò#>@èlÆö\Á∏,¿\Ê\Ê\—=#>@v§˙\Œ/∫,¿\Ê\ÿGß\">@P√∑∞nº,¿\\>íí\">@\⁄8b->Ω,¿©lXSY >@*¨ˇs¿,¿\¬¯i\‹>@ıG,¡,¿^K\»=>@\“o_\Œ¡,¿\ O™}:>@3\√FYø¡,¿ux\„ß>@Ú∂\“k≥¡,¿∂É˚>@\¬\‹\Ó\Â>¡,¿f\ÿÒ>@*¨ˇs¿,¿§ä\‚U\÷\Z>@ä\Ë\◊\÷Oø,¿ó«öëA\Z>@(N>=æ,¿[]N	à>@ç*√∏º,¿\Ìù\—V%>@î£\0Q0ª,¿\Ë\ÿA%Æ>@\Ã\–x\"àª,¿˚ñ9]>@èQûy9º,¿\\\Á\ﬂ.˚>@0ª\'Ω,¿á£´tw>@O\Õ\ÂCΩ,¿¿YJñì>@,∂IEcΩ,¿\∆M\r4ü>@\ﬂ\≈˚q˚Ω,¿Rd≠°\‘>@&W±¯M¡,¿\‹Û¸i£>@MÉ¢y\0\√,¿7©h¨˝>@¢búø	\≈,¿\n\Ÿyõ>@a¸4\∆,¿Y1\\\0>@\Œ{/æ\»,¿/6≠>@ˆ\n\Ó\Ã,¿=1X>@YLl>Æ\Õ,¿åm>@F\”\Ÿ\…\‡\–,¿∂ilØ>@∑\nb†k\◊,¿±˘∏6T>@}Àú.ã\Ÿ,¿v\ƒ!H>@\‚vhXå\⁄,¿¨X¸¶∞>@<Ü\«~\€,¿jN^d>@ëGp#e\€,¿≠\‹\Ã\n\r>@é\Î\ﬂıô\€,¿]˘,œÉ>@\Án\◊KS\‹,¿m\‚\‰~á\n>@ú•d9	\›,¿ûóäç	>@æ˜7hØ\ﬁ,¿G	>@å\÷Q\’\·,¿ß\ÏÙÉ∫>@êgs\‚,¿P˝ÉHÜ>@˝à_±Ü\„,¿mt\ŒOq>@\‹ÚëîÙ\Ë,¿\ZPoF\Õ>@\≈\0â&P\Ï,¿\ÈIô\‘\–>@˙π°);\Ì,¿\“Ry;\¬>@Å	‹∫õ\Ô,¿|c\0é>@∆ß\0\œ,¿ª∑\"1A>@¶∏™\ÏªÚ,¿K\ \›\Á¯>@\\[%XÙ,¿Zfä≠>@N{JŒâı,¿\Z•Kˇí>@S\ÁQÒ˜,¿™Ù\Œn>@¢ÒD\Á˘,¿\\ê-\À\◊>@äri¸\¬˚,¿[(ôú\⁄>@z\ƒËπÖ˛,¿áS\Ê\Ê>@®\„1ï-¿tLhí>@JñìP˙-¿\–Gq>@\…;á2-¿\‹eø\Ót>@;R}\Á-¿±˝då>@1[≤*\¬-¿:wª^ö>@XVöîÇ-¿\„˝∏˝Ú>@m\Z\€kA-¿Û\Êp≠ˆ\0>@˝/◊¢-¿˘ıC\0>@ˇ\œaæº-¿Ov3£ˇ=@r˙zæf	-¿+¡\‚p\Êˇ=@¿îÅ-¿\«kÒ)\0>@!Æú\r-¿:Ø±K\0>@*1	-¿:Ø±K\0>@ñ\ÀF\Á¸-¿+¡\‚p\Êˇ=@i™\'Ûè-¿LKˇ=@\‚\0˙}ˇ-¿h\Œ˙îc˛=@˘ø#*T-¿ÀÜ5ïE˝=@ß\ÏÙÉ∫-¿UÖb\Ÿ¸=@kÒ)\0\∆-¿≥\Îﬁä\ƒ¸=@\ﬂR\Œ{-¿$\‘©¢¸=@ˆ%∂ -¿\Ì)H¸=@ÚxZ~\‡\"-¿\’]\ŸÉ˚=@Eπ4~\·%-¿˘Ùÿñ˚=@˝\\¨®)-¿óVC\‚˚=@p\"˙µı+-¿î4Lk˚=@xADj\⁄--¿Ñ\‰\Ÿ\Â˚=@˜rü0-¿\’?àd¸=@ç$A∏2-¿Äùõ6\„¸=@$\÷\‚S\04-¿v?T\Z˝=@;\·%85-¿\≈Sè4∏˝=@∫Û\ƒs∂8-¿xF[ïD˛=@\ÿI}Y\⁄9-¿≤H\Ô\0ˇ=@Rêh:-¿–ô¥©∫ˇ=@ï∂∏\∆g:-¿:Ø±K\0>@\’#\rnk;-¿.¨\Ôé\0>@⁄•\rá=-¿|\‘_Ø∞\0>@˜∞\n\ÿ>-¿|\‘_Ø∞\0>@\⁄∆ü®l@-¿:Ø±K\0>@m\‚\‰~áB-¿+¡\‚p\Êˇ=@\"rlE-¿ïú{hˇ=@\“\‚åaNH-¿CsùFZ˛=@°ª$ŒäH-¿3á§J˛=@K:\ ¡lJ-¿\Ó\'c|ò˝=@ˆ\\¶&¡K-¿d á†j¸=@¸¸˜\‡µK-¿ΩLäè˚=@\ﬁ\»<ÚK-¿d\…Àª˙=@ï*QˆñJ-¿]QJV˘=@•jª	æI-¿˚\Î\‹˜=@˚\Ái¿ I-¿~;âˇˆ=@˛EÅ>I-¿|\’ Ñ_ˆ=@6Y£¢I-¿\"\„Q*\·ı=@ù‘ó•ùJ-¿ñZ\Ô7\⁄ı=@\Ó≥\ LiM-¿˝\\¨®ı=@æ°\Ÿ:P-¿\“\√\–\Í\‰Ù=@d~ç$Q-¿â)ëD/Û=@\À0\Ó\—R-¿Ò/Ç\∆LÚ=@\Ã\Ì^\ÓìS-¿D¿!T©Ò=@\…g˜S-¿µ•Úz=@\ÂI\'T-¿ç≥\È\‡\Ó=@\‚[X7\ﬁU-¿p\ÓØ˜\Ì=@m<\ÿb∑W-¿ˆõâ\ÈB\Ï=@7Ou\»\ÕX-¿™úˆîú\Î=@óé9\œX-¿FA¯ˆ\Í=@é@ºÆ_X-¿dø\r1\Í=@/á\›wW-¿§ng_y\Ë=@˜≥BëN-¿ûéíW\Á=@.=ö\Í\…L-¿g~5\Ê=@¨êÚìjO-¿()∞\0\Ê=@\Îsµ˚S-¿M0úkò\Â=@°J\ÕhU-¿2uWv¡\‰=@9—ÆB\ W-¿0É1\"Q\‰=@â\—s]Y-¿>]›±\ÿ\‚=@GÆõR^[-¿Y4ùù\‚=@Ü8\÷\≈m\\-¿@˜\Â\Ãv\·=@êáæªï]-¿kQL\ﬁ\‡=@®ßè¿^-¿Ü\»\È\Î\›=@S8Ωã_-¿-îLN\Ì\‹=@e\ZM.\∆`-¿Ãñ¨äp\€=@Eı\÷¿Va-¿¿\Õ\‚\≈\⁄=@\«\røõna-¿&VF#ü\◊=@5%Yá£c-¿\Õ<π¶@\÷=@SÕ¨•Äd-¿2\Á˚í\’=@@x\Ó=d-¿&˝Ω\‘=@¢\nÜ7c-¿Ú\ÏÚ≠\”=@Ä≤e˘b-¿\ƒ\'i\“=@\€\€-\…c-¿ı\’UÅZ\–=@ªa€¢d-¿\÷ˇ9Ãó\œ=@i:;e-¿≈êúL\‹\Œ=@q\»\“e-¿\‡Jvl\Œ=@\…<˜f-¿3nj†˘\Ã=@™πnh-¿˛\Ó5&\Ã=@gÄ≤ei-¿ç\ÔãKU\ =@åø\Ì	k-¿ß∞RAE\…=@\'Öyèk-¿£<Ûr\»=@ç\r\›\Ïl-¿z\Ô\«\Ì\«=@®Tâ≤∑l-¿n\‡\‘)\«=@∑\Ïˇ∞m-¿¶\nF%u\∆=@ò\‹(≤n-¿ÀÑ_\Í\Á\≈=@8gDio-¿\Î©\’WW\≈=@î\√\’p-¿¨\∆\÷\∆\ƒ=@!≠1\ËÑp-¿=Òú- \ƒ=@ä\‰+Åîp-¿°ø\–#F\√=@+ˆó›ìo-¿6\Àe£s\¬=@ãvìn-¿≤LøDº¡=@ç∑ï^õm-¿—≠\◊Ù†¿=@\À⁄¶x\\l-¿æ-X™¿=@˜\"⁄é©k-¿\n‹∫õßæ=@˙’ë#m-¿’∞\ﬂ\Î∏=@ê¿~˛s-¿\ŒQ⁄∑=@\€‹òû∞t-¿o+Ω6∑=@◊ÖúOu-¿\Ÿ\Èuë∂=@X®5\Õ;v-¿±¿Wt\Îµ=@gE\‘Düw-¿eqˇë\È¥=@\’\Ì\Ï+z-¿Ú\"k∞=@;\·%8}-¿âóßs≠=@£<Ûr\ÿ}-¿`\"ƒï´=@ü`<É~-¿≤\r‹Å:©=@ºÃ∞Q\÷-¿1óTm7©=@gµ¿Å-¿c‘µˆ>©=@{†≤Ç-¿\ ¸£o“®=@Ñ.\·\–[Ñ-¿~\Z˜\Ê7®=@í\ÀHøÖ-¿Ù\ﬁÄß=@˜ë[ìÜ-¿ePmp\"¶=@ñ\—\»\Áá-¿˙∏6Tå£=@ZÉ˜Uπà-¿OZ∏¨¢=@t\Ï†◊â-¿≠jIG°=@µ\·∞4ã-¿®´;€†=@8˜Wè˚é-¿\ﬁ8)\Ã{†=@i\ƒ\Ã>èë-¿∂¢\Õqnü=@Háá0~í-¿˛aKè¶û=@ßÆ|ñ\Áë-¿\⁄r.≈ù=@p≥x±ê-¿™cï\“3ù=@\”˙[è-¿øÛãÙõ=@ï-Ø\\è-¿+Ÿ±àõ=@/àHMªê-¿L5≥ñö=@</O\Áí-¿\∆k^\’Yô=@˛(\Í\Ã=î-¿¢|A	ò=@bôπ¿ï-¿0c\n\÷8ó=@\Ãe˝ñ-¿w¶(óñ=@M¿Øë$ò-¿EgôE(ñ=@ß\∆K7ô-¿?\∆‹ï=@IÚ\\ﬂáõ-¿¯O7P\‡ï=@°Û\ZªDù-¿\‰Ç3¯˚ï=@z\·ŒÖëû-¿#K\ÊXñ=@˜¨k¥†-¿#K\ÊXñ=@É¸l‰∫°-¿bôπ¿ï=@à,\“ƒ£-¿©iì=@¨6ˇØ:¢-¿\'˜;í=@W\ËÉel†-¿[ôK˝ê=@¸®Ü˝û†-¿Äüq\·@ê=@ëFN∂°-¿©\‹D-Õç=@∂¯\0\„°-¿ºZ\ÓÃå=@§å∏\04¢-¿Æü˛≥\Êã=@((E+˜¢-¿ a∞\‰ä=@¨TPQı£-¿.sûâ=@Ü˘a§-¿0\’\ÃZ\nà=@5\Ê\Ë°-¿å†1ì®á=@\—Á£å∏†-¿@7n1á=@\∆¯0{Ÿû-¿\ƒ\'iÜ=@<k∑]hû-¿a\√\”+eÖ=@R\r˚=±û-¿€ø≤“§Ñ=@\Á™yé»ü-¿ê/°ÇÉ=@∑b\Ÿ=°-¿;\ﬂOçóÇ=@§\0Q0c¢-¿)\Õ\ÊÅ=@6wÙø\\£-¿&\„\…Å=@”æπøz§-¿ãˇ;¢BÅ=@å.o˜-¿_&äê^=@7«πM∏˜-¿78˝\⁄>=@@ﬁ´V&º-¿Kiˇ =@µâì˚Ú-¿≥Bë\Ó=@hî.˝K˙-¿|\'fΩ˛<@£:\»z˙-¿ôK™∂õ¯<@\È\◊\÷Oˇ˘-¿ïA\’\Ëı<@h>\Ánˇ-¿|\—/§\ﬂ<@e®ä©ÙS.¿[≤*\¬M\⁄<@Öz˙T.¿2t\Ï\ÿ<@Nó\≈\ƒ\ÊS.¿0†\Ó\\\ÿ<@¢`\∆T.¿\–{c\0\÷<@\ÔÀô\Ì\nU.¿Åy»î\’<@nàÒöWU.¿}!\‰ºˇ\”<@\Ã(ñ[ZU.¿Qª_¯\Œ<@õq\Z¢\nW.¿Ú#~\≈\Z\Œ<@.rOWW.¿!u;˚\ <@#ÖñuW.¿^J]2é\…<@)x\nπRW.¿\Îptï\Ó\∆<@äë%s,W.¿d\ÀÚu\≈<@ﬂáÉÑ(W.¿êÑ};â\ƒ<@=\Ó[≠W.¿Æ+fÑ∑\√<@°l\\ˇV.¿\Zàe3\√<@¨ã\€h\0W.¿s°ÚØ\Â¡<@\Ë†K8ÙV.¿ìsb\Ìø<@¸\·\ÁøW.¿2\"QhYø<@\›&\‹+ÛV.¿U/ø\”dæ<@f1±˘∏V.¿\—$±§‹Ω<@{˘ù&3V.¿À†\⁄\‡D∏<@7¬¢\"NW.¿πT•-Æµ<@˚>$DY.¿ôÄ_#I¥<@¢≤aMeY.¿t)Æ*˚≤<@”º\„Y.¿T˝J\Á√Ø<@≤fdêªX.¿¥ì¡QÚÆ<@õèkC\≈X.¿\ \≈X«≠<@b->¿X.¿≤æÅ…ç™<@1$\'∑Z.¿bX9¥®<@≈≠Ç\ËZ.¿\‚\\\√çß<@/\√∫ÅZ.¿éW zR¶<@ZJñìPZ.¿Œã_\Ì§<@%ZÚxZ.¿R~R\Ì£<@\◊\¬,¥sZ.¿åâB£<@»ïzÑZ.¿7ãC†<@åL¿Øë\\.¿&\»®på<@\„\√\Ïe[.¿\¬/ıÛ¶Ç<@P\ƒ\"ÜF.¿ªG6W\Õ<@M.\∆¿:F.¿\0\Ê\ÀÄ<@QOÅ?D.¿©˙ïŒá{<@På,ôC.¿a¸4\Ó\Õw<@2kúM?.¿}yˆ\—u<@≤ÇﬂÜ?.¿“åE\”\Ÿi<@MJA∑ó<.¿.9(ab<@AJòA.¿\nh\"lx^<@ÑHÜ[?.¿>îh]<@sÙ¯ΩE.¿yít\ÕX<@MåJ\ÍD.¿`w∫Û\ƒW<@Ñcñ=	L.¿ 	˚v]<@í#ùÅëO.¿Ø(\r5Z<@\∆¡•c\ŒS.¿T8ÇTäU<@	4\ÿ\‘Q.¿\'i˛T<@7¬¢\"NW.¿œª±†0X<@7âA`\ÂX.¿t≥?PnW<@Õî\÷\ﬂ`.¿¢\”Ûn,T<@\“U∫ª\Œ^.¿Q£êdVS<@-[ÎãÑf.¿\“8\‘\Ô\¬V<@(ö∞\»g.¿Å%W±¯U<@ãá˜Xn.¿çüq\·P<@◊ÖúOm.¿\"ˇ\Ã >P<@__\ÎR#t.¿ß•hU<@5y\ j∫v.¿\’\ÏÅV`T<@\Ÿ@∫\ÿ|.¿Ø˛∑íQ<@•\»%é|.¿\\\ÊtYLP<@\‚\ ŸÉ.¿´!qè•K<@\Ê=\Œ4aÉ.¿{°Ä\ÌH<@\ÍB¨˛õ.¿\–~§àO<@–õäTõ.¿º=˘N<@m™\ÓëÕù.¿	¶öYG<@Å\ËIô‘†.¿˙\Ô¡kóF<@\Z1≥\œc§.¿\ﬂ\≈˚q˚A<@\—Yfä≠.¿(FñÃ±@<@\”P£êdÆ.¿\√e6@<@•Ö\À*lÆ.¿D?ç{?<@†7©0Æ.¿\„\„≤Û><@˛\Ôà\n’≠.¿u\»\Õp><@3®68≠.¿iä\0ßw=<@#J{É/¨.¿\Í<*˛\Ô<<@\ÿùõ6´.¿M†àE<<@ÅØ\Ë\÷k™.¿\÷nª\–\\;<@π\√&2s©.¿sHj°d:<@ä\«Eµà®.¿Lé;•É9<@\ƒABî/®.¿°h¿\"7<@˜ì1>Ã¶.¿sePmp6<@\"R\”.¶.¿˙`∫5<@T˛µºr•.¿\ÊÁÜ¶\Ï4<@≠hsú€§.¿\⁄T\›#õ3<@∑|$%=§.¿G\„Pø3<@“ç∞®à£.¿iSuèl2<@∞|∑y£.¿\n\€\›0<@;ãﬁ©Ä£.¿£\\\Zø.<@ƒòÙ˜R†.¿\"\08ˆ\Ï-<@Úò˘û.¿/j˜´\0+<@=}˛õ.¿_\Ì(\Œ)<@`\"ƒïõ.¿E|V(<@çraö.¿‹Ç•∫Ä\'<@\„OT6¨ô.¿ö[!¨\∆&<@@Pn\€˜ò.¿c)íØ&<@t	4ò.¿gÄ≤e%<@∫ÉÿôBó.¿=)ì\Z\⁄$<@l]jÑ~ñ.¿¨TPQı#<@PäV\Óñ.¿:=\Ô\∆\"<@w€Ö\Ê:ï.¿\–)\»\œF\"<@RÔ©úˆî.¿¨Ôéå!<@AaP¶—î.¿G¨≈ß <@?\0©Múî.¿_~ß…å<@\·F\ Iì.¿QN¥´ê<@ˇwDÖí.¿ñ\"˘J <@eä9:í.¿–∏p $<@T\0åg–ê.¿6oú\Z<@8-x\—Wê.¿v28J^<@Aãvê.¿cπ•’ê<@f¯O7Pê.¿z4’ì˘<@-\ËΩ1ê.¿G\„\‡\“<@p¥\„Üﬂç.¿≠jIG<@\ﬂ4}v¿ç.¿¿œ∏p <@\≈X¶_\"é.¿∫\Ÿ(<@ë’≠ûìé.¿E.8Éø<@Úaˆ≤\Ìå.¿∂\ÿ\Ì≥<@ËÜ¶\ÏÙã.¿=\Ó\Œ\⁄\r<@\È∂D.8ã.¿∆ß\0\œ<@[A\”ã.¿ò§2\≈<@˙≥)\"ã.¿‘ûísb<@lï`q8ã.¿O!W\Í	<@	á3øä.¿¶∏™\Ïª<@¥up∞7â.¿ıÅ\‰ùC<@Åx]øà.¿jˆ@+0<@\'¡“®à.¿äc\ÓZ<@0EH›Ü.¿ÛÅŒ§<@\Î8~®Ñ.¿äíêH\€\0<@QJV’É.¿\›\Í9\È}ˇ;@#\∆ÇÑ.¿Mg\'É£¯;@S=ôÙï.¿iè\“\·ı;@EÇ©f÷í.¿a≈©\÷\¬Ù;@ã2díë.¿\rπß´Û;@ÏâÆ?ê.¿îΩ•ú/Ú;@D˝.lÕé.¿àd»±ı\Ï;@ˇ\–Ãìkä.¿\rnk\œ\Î;@åæÇ4câ.¿ò¿≠ªy\Í;@É\Ë\⁄à.¿òk\—¥\È;@hzâ±Lá.¿-B±4\È;@\Â\–\"\€˘Ü.¿„àµ¯\Ë;@e\ZM.Ü.¿Y˝Ü\Á;@\‡ÅÑÖ.¿≤◊ª?\Ê;@Eõ\„\‹&Ñ.¿ÛèæI\”\‰;@Bx¥qƒÇ.¿|\”Ù\Ÿ\„;@ﬂøyqÇ.¿raär\·;@´\Ïª\"¯.¿Û\ ı∂ô\ﬁ;@¶∏™\Ïªz.¿@˜\Â\Ãv\›;@ ®2åªy.¿0\’\ÃZ\n\‹;@«∫∏çx.¿`\À+\◊\€\⁄;@0ˆ^|\—v.¿\—\Ëbg\⁄;@VõˇWy.¿ò¸O˛\Ó\Ÿ;@\”N\Õ\Â{.¿tB\Ë†K\ÿ;@Fè6éÄ.¿–ù`ˇu\÷;@¨µ<Ñ.¿|DLâ$\÷;@œÑ&â%Ö.¿aq8Û´\’;@\Œ\·Z\Ìaá.¿O\Í\À\“N\’;@SÕ¨•à.¿é≠g\«\‘;@˙	g∑ñâ.¿1–µ/\‘;@⁄®Nä.¿–õäT\”;@Ûë\ÔRä.¿VÒF\“;@}uU†ã.¿oıúÙæ\—;@µ§£Ãé.¿ •ÒØ\–;@Òh„àµê.¿9—ÆB\ \œ;@øb\rë.¿epîº:\œ;@}\ËÇ˙ñë.¿\¬j,a\Õ;@z\‡c∞\‚î.¿‹Ä\œ#\Ã;@\⁄\…\‡(yï.¿\ﬁ:ˇv\Ÿ\À;@OIüñ.¿•N@a\À;@¿v0büò.¿W>\ÀÛ\‡\ ;@VòáLô.¿ç“•I\ ;@*p≤\r‹ô.¿ë)Ç™\…;@ê‹öt[ö.¿.\ÊÁÜ¶\»;@w,∂IEõ.¿ì9ñw\’\«;@*T7õ.¿',1607362055,1607362055,NULL,NULL),(2,'Copperbelt',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0~©ü7Ö;@?q\0˝ñ(¿ª+ª`pÖ;@¸¢˝ï(¿¥sö⁄Ö;@ú\Ê=Œî(¿\∆2˝ÒÜ;@ç_x%…ì(¿5óuà;@\Ë¢!\„Qí(¿¶ÒØ$â;@ë{∫∫cë(¿≠L¯•~ä;@\Zß!™è(¿#Ü∆§ã;@™d\0®\‚é(¿˙π°);ç;@%\…s}é(¿Rr•é;@*ß=%\Áå(¿5sªóè;@\‡ù|zlã(¿6Vbûïê;@\œˆ\Ë\r˜â(¿àæªï%í;@?é\Ê\» á(¿;]•ªì;@\∆3hËüà(¿B\Î\·\ÀDï;@	2*â(¿[\Ìa/ò;@%\\\»#∏â(¿˘£®3˜ò;@_(`;â(¿H4Å\"ö;@Ó∞â\Ã\\à(¿Æg\«,õ;@\Ï\€ID¯á(¿\'Öyè3ù;@\ÓvΩ4Eà(¿ÉQIùÄû;@J\rm\06à(¿áP•fü;@†8Ä~ﬂá(¿€áº\Â\Íü;@g\÷R@⁄á(¿ ç\"k\r°;@î\‹aôâ(¿\ÿÚ\ ı∂°;@i˛ò÷¶â(¿J~ƒØX£;@ç\r\›\Ïå(¿†m5\Î§;@ÑHÜ[è(¿¸\ZIÇp•;@z4’ì˘è(¿ôπ¿Â±¶;@5óuê(¿I,)wüß;@l{ª%9ê(¿MuÄ®;@\»\Ôm˙≥è(¿Ú±ª@I©;@Ö};âè(¿4Ö\Œk\Ï™;@¯\‡µKé(¿›òû∞ƒ´;@i¸\¬+Ié(¿ÄÄµj◊¨;@_~ß…åè(¿MhíXRÆ;@MÜ\„˘ê(¿m\Z\€kAØ;@X:û%ê(¿ñ\"˘J ±;@˚w}Ê¨è(¿\—\À(ñ[≤;@Ûu˛”ç(¿@¯P¢%≥;@qu\0\ƒ]ç(¿!Øì\‚≥;@LqU\Ÿwç(¿X·ñè§¥;@éÆ\“›ç(¿.t%’∑;@\ŒQG\«’ê(¿¯6˝Ÿè∏;@Aãvê(¿W_]®π;@\Èahuré(¿\–(]˙óº;@2\0Tq\„é(¿˛\Ôà\n’Ω;@\ﬁJ\n,ê(¿:í\ÀHø;@D£;àùë(¿ó\»gø;@L©K\∆1í(¿aã\›>´¿;@£Àõ√µí(¿ˇvŸØ;¡;@	8Ñ*5ì(¿ä>e\ƒ¡;@2rˆ¥ì(¿É›∞mQ\¬;@:Ø±Kî(¿ò€Ω\‹\'\√;@â)ëD/ì(¿`¨o`r\√;@{\⁄·Øë(¿ZÄ∂’¨\√;@\‰N\È`˝è(¿\”B\Œ˚\√;@\ T¡®§é(¿KÃ≥íV\ƒ;@\“\Â\Õ\·Zç(¿,Ú\Îá\ƒ;@\Ãy∆ædã(¿˜.9\Ó\ƒ;@F≤G®ä(¿e∏u\∆;@ñ\\\≈\‚á(¿\r\√Gƒî\»;@/\\sGá(¿\◊\ﬂÄ\ ;@ñ?ﬂÜ(¿±u≠Ω\À;@>\Ã^∂ùÜ(¿KÃ≥íV\Ã;@ü´≠\ÿ_Ü(¿B\Œ˚ˇ8\Õ;@¿Æ&OYÖ(¿9≥]°\Œ;@æıaΩQÉ(¿=HOëC\–;@2\ËÑ\–A(¿ˇ+j\–;@õ™{ds}(¿ôÙ˜Rx\–;@\”0|D|(¿\’	h\"l\–;@6\\ê-{(¿y]ø`7\–;@ØyUgµx(¿Ú\"k\–;@õv1\Õtw(¿¢(\–\'Ú\–;@\ƒ#ÒÚtv(¿Yk(µ\—;@!°Ju(¿@3à\Ï\–;@\Œ¸jt(¿M¿Øë$\–;@\ ˙\Õ\ƒtq(¿¡ë@ÉM\—;@çôDΩp(¿g\'É£\‰\—;@wˆï\Èq(¿ä<I∫f\“;@∑µÖ\Á•r(¿\07ã\”;@\Ô≠HLPs(¿\«ÙÑ%\‘;@\—;p\œs(¿}?q\0\’;@\À-≠Üt(¿∑\Ïˇ∞\’;@\Î©\’WWu(¿\Ôs|¥8\◊;@\n,Ä)w(¿\ÌÇ¡5w\ÿ;@(}!\‰ºw(¿|_\\™\“\⁄;@Ã∂\”÷àx(¿wd¨6ˇ\€;@¸\≈l…™x(¿Ü¨nı\‹;@kÄ\“P£x(¿t&m™\Ó\›;@\ﬂ4}vx(¿>]›±\ÿ\ﬁ;@cAJx(¿ç|^Ò\‘\ﬂ;@Ôéå\’\Êw(¿\ﬁÆ\’\‚;@Ö?√õ5x(¿ì6U˜\»\‚;@XÀùô`x(¿E.8Éø\„;@\ﬂ4}vx(¿8©0∂\‰;@9ó‚™≤w(¿fÙ£\·î\Â;@B\Ívˆïw(¿ Fè6\Ê;@+ˆó›ìw(¿∫I+\Á;@\ﬁ\À}rx(¿ïüT˚t\Ë;@\ﬂké\Àx(¿¨\ƒ<+i\È;@¯Q\r˚=y(¿M.\∆¿:\Í;@X\‰\◊±y(¿ôÑy\Î;@ú®•πz(¿5B?SØ\Î;@\‘\’ãmz(¿ö?¶µi\Ï;@\»}´u\‚z(¿\„^IÚ\Ï;@X\»\\T{(¿¥êÄ\—\Ì;@0∫º9\\{(¿ôªñê\Ó;@ºêa|(¿l%tó\ƒ\Ì;@˘k∏\»}(¿\Ìcø\Ì;@¨Zd;(¿jà*¸\Ó;@Cè=∑Ä(¿\€\›t_\Ó;@œΩáÉ(¿P˛\Ó5\Ó;@-ôcyWÖ(¿¶ùö\À\r\Ó;@\”\›u6\‰á(¿\Êv/˜\Ì;@ÆbÒõ¬ä(¿\⁄\‰I\'\Ó;@,\◊\€f*å(¿Ù2ä\Âñ\Ó;@}$%=ç(¿Ö\Ô˝\r\⁄\Ô;@åü∆Ω˘ç(¿?\∆‹µÑ;@ºÃ∞Qé(¿ôùE\Ô;@¶	\€O∆ê(¿•jª	æÒ;@ zR&5î(¿\ÌGä»∞Ú;@x$(ñ(¿\€\‡DÙkÛ;@ı∫E`¨ó(¿NE*å-Ù;@kQLﬁò(¿\»\Œ\€\ÿ\ÏÙ;@ív5yö(¿É\⁄o\ÌDı;@NbX9ú(¿∞\«DJ≥ı;@=\’!7√ù(¿\…Àª\Íı;@/á\›wü(¿Ü\Âœ∑ı;@û%\»®†(¿S\"â^Fı;@U\ﬂ˘E	¢(¿@Ö#H•Ù;@\…g˜£(¿ã˛\–ÃìÛ;@Ö\Ì\'c|®(¿\⁄ˇ\0k\’Ú;@ïû\È%∆™(¿Nõq\Z¢Ú;@40Ú≤&Æ(¿\ÁrÉ°Û;@ªó˚\‰(∞(¿FA¯Ú;@~t\Í\ g±(¿©˜TNÛ;@\»\ÌóOV¥(¿v•e§\ﬁÛ;@\ﬁt_Œ¥(¿.rOWwÙ;@]®¸kyµ(¿∫æ	ı;@}ìE∂(¿•\Ÿ<Éı;@àòN\Î∂(¿ö@ãˆ;@<g≠∑(¿÷ã°úh˜;@ŸôB\Á5∂(¿\"ú¡\ﬂ˜;@\„\‚®\‹Dµ(¿0\‹{¯;@∏Œø]ˆ≥(¿\‹ID¯˘;@QàÄC®≤(¿\Ìî\€ˆ˘;@Z†\›!≈∞(¿\Ê\"æ≥˙;@\Z3âz¡Ø(¿{ª%9`˚;@êÉf⁄Æ(¿«ù\“¡˙˚;@Å|	Æ(¿Äcœû\À¸;@¸6\ƒx≠(¿eﬁ™\ÎP˝;@1\Ï0&≠(¿\»\È˛;@%A∏\n≠(¿\‡º8Ò\’˛;@0/¿>:≠(¿í\Ã\Ínˇ;@mç\∆¡≠(¿+hZbe\0<@y\…ˇ\‰\ÔÆ(¿h∞©Û\0<@øúŸÆ–Ø(¿\0k’Æ<@\„p\ÊWs∞(¿Ò/Ç\∆L<@\’&N\Ów∞(¿.II<@J∂∫ú∞(¿\Ÿ`\·$\Õ<@~T\√~Ø(¿Iª\—\«|<@©eo)Ø(¿6<ΩRñ<@p$\–`SØ(¿\·Ò\Ì]É<@i\‡G5\ÏØ(¿ëΩøA<@\Ÿ=yX∞(¿É§O´<@‹†ˆ[;±(¿\‰J=B	<@\Z4ÙOp±(¿i\…\„i˘	<@£y\0ã¸≤(¿jÜTQº\n<@õV\nÅ¥(¿b†k_@<@\nª(z\‡≥(¿CÄ\rà<@Òıµ.5≤(¿)H4\r<@s/0+±(¿É4c\—t<@¡ò2p∞(¿ÜUºëy<@ïõ®•±(¿_}<Ù\›<@∂Ùh™\'≥(¿ç\Ó v<@øôò.ƒ≤(¿\‰hé¨¸<@s0õ\0√≤(¿+Ö@.q<@é ï≤(¿ív£è˘<@πmﬂ£˛≤(¿N\“¸1≠<@É¢y\0ã¥(¿wı*2<@©P\›\\¸µ(¿ˆ^|\—<@\›7\‡Ûª(¿\…\0P≈ç<@TrNÏ°Ω(¿8-x\—W<@®ˇ¨˘Òø(¿-%\ÀI(<@º<i\·\¬(¿ñ≥wF[<@\\8í\ƒ(¿ £aQ<@¿Æ&OY\≈(¿\Œ9x&4<@K∫†\∆(¿º∑_><@Ú\Z˙\'\»(¿o/iå\÷<@ª}Vô\…(¿ßYO≠\Z<@ï|\Ï.P\ (¿j°drj<@Um7¡7\Õ(¿π6TåÛ<@£î¨™\œ(¿∏Ö\ÎQ<@&©L1\—(¿5\Ó\Õoò<@hwH1@\“(¿ª}Vô)<@Iª\—\«\‘(¿cò¥\…<@µå\‘{*\◊(¿\—tv28<@∆ä\ZL\√\ÿ(¿P™}:<@K\0˛)\›(¿ò5±¿W <@%Œä®â\ﬁ(¿´ÆC5%!<@gaO;¸\›(¿]\ﬁÆ!<@B\nûBÆ\‹(¿à°\’\…\"<@õ©æ\€(¿∑µÖ\Á•\"<@l≤F=D\€(¿Dà+g#<@\—?¡≈ä\⁄(¿\ÊX\ﬁU$<@Å\ÍD\⁄(¿ˇ	.V\‘$<@_^Ä}t\⁄(¿ßy\«):&<@Éà‘¥ã\Ÿ(¿\nÑùb\’$<@üF\◊(¿ \Ó\ÍUd$<@í\Ëe\À\’(¿wı*2:$<@\Œ¬ûv¯\”(¿:[@h=$<@Ω\»¸\Z\—(¿!sePm$<@B$Cé≠\œ(¿}¢$<@Uiãk|\Œ(¿\‡ÿ≥\Á2%<@\“S\‰q\À(¿¥Z`èâ(<@i\√ai\‡\«(¿∞èN])<@8>[\«(¿\Ów(\nÙ)<@J^ùc@\∆(¿IÄöZ∂*<@Té\…\‚˛\√(¿uÄ\‘*<@¯Rx\–\Ï\¬(¿lxz•,+<@\Ê\Õ\·Z\Ì¡(¿-µ\ﬁo¥+<@2\√F¡(¿{æfπl,<@Pîi4¡(¿:\Ë-<@\ÍÕ®˘*¡(¿≤/\Ÿx∞-<@u≠ΩOU¡(¿Y\√E\Ó\È.<@cò¥\…¡(¿.t%\’/<@nLOX\‚¡(¿^=10<@H©Ñ\'Ù\¬(¿U0*©0<@@j\'˜\√(¿Q-\"ä\…/<@$Äõ≈ã\≈(¿KîΩ•ú/<@;pŒà\“\∆(¿n\‡\‘)/<@lìä\∆\⁄\«(¿\–\Ì%ç\—.<@\·&£\ \»(¿Dj\⁄\≈4/<@\ÀHΩßr\ (¿¨åF>Ø0<@<0Ä°\Ã(¿KÆbÒõ2<@°\€K\Z£\Õ(¿c∂dUÑ3<@†¶ñ≠ı\Õ(¿=∑–ï4<@â\ÏÉ,\Œ(¿û(	â¥5<@íë≥∞ß\Õ(¿¢òºf6<@1[≤*\¬\Õ(¿/j˜´\07<@+/˘ü¸\Õ(¿\'Ñ∫Ñ7<@≤◊ª?\Œ(¿!∫ˆ8<@`ÆE\–\Œ(¿™HÖ±Ö8<@ıK\ƒ[\Á\œ(¿:$µP29<@\‚vhXå\“(¿\"rl9<@Ul\Ã\Îà\”(¿\·\œf\r:<@ñy´ÆC\’(¿lzPPä:<@°¯1\ÊÆ\’(¿æ€ºqR<<@#ÑG\◊(¿ñ\"˘J =<@Rr•\÷(¿Òû\À><@,\r¸®Ü\’(¿qqTn¢><@ù∏Ø@\‘(¿\ÁrÉ°?<@;n¯\›t\”(¿C\·≥up@<@\Êó«ö\—(¿3ãPlA<@\≈ ¶\\\—(¿ÿ∏˛]üA<@1\Ó\—Z\—(¿√ª\\\ƒwB<@é*çò\—(¿	ÚnD<@xõ7N\n\”(¿m˙≥E<@◊¶±Ω\‘(¿p(|∂F<@Pß<∫\÷(¿í±\⁄¸øF<@?¯˘\◊(¿ å∑ï^G<@¯\›t\À\Ÿ(¿\–dˇ<\rH<@\÷t=\—u\Ÿ(¿\·(yuéI<@\Ãün†\ÿ(¿\Ïg±\…K<@\·&£\ 0\÷(¿wæü\Z/M<@|\Ôo\–^\’(¿Æ\r\„¸M<@\Á˚©Ò\“\’(¿∫K‚¨àN<@’îd\÷(¿≠á/O<@[&\√Ò|\÷(¿äUÉ0∑O<@»≥À∑\÷(¿∂-\ lP<@!…¨\ﬁ\·\÷(¿\»|@†3Q<@^ëö\÷(¿\Ã\ÏÛ\ÂQ<@àüˇº\÷(¿*sÛç\ËR<@PVW\ÿ(¿µ˚UÄS<@?UÖb\Ÿ(¿ú\ﬂ0\— U<@{°Ä\Ì`\‹(¿¶{ù‘óU<@Rùd=\›(¿\√1%V<@x{Ú\›(¿Ä\ÿ“£©V<@«úg\ÏK\ﬁ(¿¥t€àW<@n£º\‚(¿\Œ¬ûv¯W<@øJí\Á\‚(¿L‚¨àöX<@5£\Zˆ\„(¿{Ç\ƒv˜X<@\Á5vâ\Í\Â(¿®\„1ïY<@|_\\™\“\Ê(¿\Ï£SWZ<@xÄ\'-\\\Ê(¿.»ñ\Â\ÎZ<@ïI\rm\0\Ê(¿®\≈\‡a\⁄[<@†\√|y\Ê(¿2\…\»Y\\<@\∆l…™\Á(¿	Qæ\\<@πp $\Ë(¿ï∏éq]<@\€N[#Ç\È(¿m±^<@bhurÜ\Í(¿©L1A_<@eQ\ÿE\—\Î(¿’¥ãi¶_<@ù\÷mP˚\Ì(¿¿œ∏p `<@ÿûY†\Ó(¿\Ë¯hq\∆`<@Å&¬Üß\Ô(¿≤\ÿ&ça<@ZπòÚ(¿>\"¶Db<@>œü6™Û(¿((E+˜b<@∂LÜ\„˘Ù(¿p$\–`Sc<@\\ê-\À\◊ı(¿-ò¯£®c<@kbÅØ\Ëˆ(¿˜èÖ\Ëd<@\Ô´r°Ú˜(¿\0\ƒ]Ωäd<@G≤Åt˘(¿2\È\Ô•d<@\Ãa˜\√˚(¿åÑ∂úKe<@WZF\Í=˝(¿Ω5∞UÇe<@˝KRôb˛(¿1^Û™f<@H3Mgˇ(¿\”\ÿ^zg<@˘ÖWí<ˇ(¿:≤Ú\À`h<@h@Ω5ˇ(¿]¿\Ài<@E◊Öúˇ(¿.9\Óîj<@W–¥\ƒ\ \0)¿Çã5òj<@¬äS≠Ö)¿ª\Ôk<@≤Û66;)¿r\ﬂjù∏l<@õ\∆ˆZ\–)¿¥V¥9\Œm<@\∆O\„\ﬁ)¿v˚¨2Sn<@5C™(^)¿}‘õQo<@˝h8en)¿\◊M)Øïp<@E∫üSê)¿Ωåbπ•q<@\œÿól<)¿g\nù\◊\ÿq<@\Ë¢!\„Q\n)¿&7ä¨q<@tDæK©)¿Rõ8π\ﬂq<@&˛(\Í\Ã\r)¿\ÿ\”Mr<@Va3¿)¿\œ\œ\Ÿr<@∂¢\Õqn)¿X zR&q<@)\ﬂ\ﬁ)¿\'∑\nbp<@K±£q®)¿9\Óî\÷o<@V∏\Â#)¿∑aèo<@mˇ\ Jì\Z)¿µ\ƒ\ h\‰o<@úoD˜¨)¿~t\Í\ gq<@ò°ÒD)¿\◊\⁄˚Tr<@^Ωäå )¿ê†¯1\Êr<@\–CmF!)¿çBíYΩs<@˙`\")¿©\Ÿ≠¿t<@∑A\Ì∑v\")¿∫0“ã\⁄u<@YO≠æ\")¿¡S»ïzv<@7n1?7$)¿.\Â|±˜v<@h\\8í%)¿˜X˙\–y<@YNB\È))¿\◊KS8y<@;˛*)¿K´!qèy<@\‡™õ+)¿ZÑb+hz<@?tA}\À,)¿¢–≤\Ó{<@[î\Ÿ ì,)¿\Zß!™{<@Z5\—\Á+)¿…¨\ﬁ\·v|<@°É.\·\–+)¿ÛWy}<@~\√DÉ,)¿˜s\nÚ≥}<@Aµm-)¿ƒô_\Õ~<@\ﬁs`9B.)¿yt#,*~<@Å	‹∫õ/)¿JµO\«c~<@ \—ä0)¿òà∑ŒøÅ<@3díë3)¿J$\—\À(Ç<@x\“\¬e5)¿°ÙÖêÛÇ<@8fŸì¿6)¿\Í@\÷S´É<@1≥\œcî7)¿i„àµ¯Ñ<@Di\‚8)¿:ë`™ôÖ<@\'ºß>8)¿\ËÖ;FÜ<@)yué9)¿e\ZMÜ<@\npU:)¿\\!¨\∆Ü<@\—#F\œ-<)¿n/Ü<@\◊3Ñcñ=)¿+\›]gCÜ<@‘ô{H¯>)¿°◊ü\ƒ\ÁÜ<@¨©,\nª@)¿Ç\∆L¢^à<@oH£\'C)¿¿YJñìà<@\ÎòD)¿∆¢\È\Ïdà<@zm6VbF)¿q\ÀGR“á<@˝¿Uû@H)¿NB\È!á<@\È∫ÉÛI)¿T\›ãÜ<@îX\0K)¿¯˝õ\'Ü<@n\ﬁ8)\ÃK)¿\Ï3g} Ö<@}∞å\rM)¿Ö∂úKqÖ<@äÆ?8O)¿∫æ	Ö<@v®¶$\ÎP)¿\·%8ıÅÑ<@\0Tq\„S)¿é\Ã#0Ñ<@}∞å\rU)¿zQª_Ñ<@\Ë\⁄\–W)¿Ω7Ü\0Ñ<@˝\\¨®Y)¿µ\·∞4É<@\Óïy´Æ[)¿º;2VõÉ<@O<g])¿ÑdÉ<@ùÑ\“B^)¿£:\»zÇ<@ì6U˜\»^)¿™∫G6WÅ<@û)t^c_)¿Fó7á<@¡\‡ö;˙_)¿∫˘Ft\œ~<@\ÿHÑ+`)¿\„é7˘-~<@\Ÿ!˛aK_)¿π5\È∂|<@OîÑD\⁄^)¿\Œ¸j|<@\Ïæcx\Ï_)¿∞ˇ:7mz<@≠\ﬁ\·vh`)¿˜≠÷â\Ày<@LnYk`)¿sªó˚x<@\ÃB;ßY`)¿	SîK\„w<@q\ÊWsÄ`)¿=\Ó[≠w<@óU\ÿpa)¿QN¥´êv<@]\ZøJb)¿wŸØ;\›u<@#¯\ﬂJvd)¿fKVE∏u<@K∫†æe)¿Ω\∆.QΩu<@¯˛\Ì\’g)¿¯\‚ãˆxu<@\…Àª\Íi)¿\\™\“\◊t<@ \nfL¡j)¿ïÒ\Ô3.t<@àÖZ”ºk)¿åI/Ös<@\ﬁ>´Ãîn)¿t\Ì\ËÖs<@7™”Å¨o)¿jlØΩs<@\Ë25	\ﬁp)¿\Z˜\Ê7Lt<@øJí\Ár)¿çbπ•\’t<@x$(~t)¿&\Â`6u<@µ®Oráu)¿J`sûu<@PráMdv)¿\Õ\» wv<@òOVWw)¿ÒJí\Á˙v<@ú\›Z&\√y)¿s0õ\0\√z<@^IÚ\\\ﬂ)¿\»\Ï,z{<@?8ü:VÅ)¿ıh™\'Û{<@&ç\—:™Ç)¿“âS\Õ|<@	˚vÜ)¿Ä≤e˘~<@H¶Cß\Áç)¿∂ø≥=z<@^º∑_é)¿µ\ﬂ⁄âíÄ<@\"ä\…`é)¿>Zú1ÃÅ<@3SZKê)¿C9—ÆÇ<@∫1=aâè)¿>>!;oÉ<@\"P˝ÉHé)¿FzQªÉ<@¬â\Ë\◊÷è)¿©\€\ŸWÑ<@\ﬁÑÄ|ë)¿≤≤,òÑ<@\ƒ\œ^ì)¿6!≠1\ËÑ<@Úñ´õî)¿\“\Â\Õ\·ZÖ<@\ﬂnIÿï)¿\ﬁ\ﬂ4}Ü<@ßZ≥ò)¿F{ºêá<@ˇ>\„¬ô)¿\ ˘b\Ô≈á<@x∏\Zõ)¿\Î˝F;nà<@\Ì+\“Sú)¿«É-v˚à<@›ó3€ù)¿-\ÃB;ßâ<@a¸4\ÓÕü)¿Ä\ràWä<@0bü\0ä°)¿$∂ª\Ëä<@\ÁUù\’£)¿ﬂ§iP4ã<@J]2éë§)¿ß±ΩÙä<@Sóåc$´)¿\·µKã<@\Ôt\Áâ\Á¨)¿+j0\rã<@Å≈è1Ø)¿t	áﬁä<@hv\›[ë∞)¿3RÔ©úä<@Ö@.q\‰±)¿6<ΩRä<@\÷q¸Pi¥)¿\ZjíÃä<@∞≠ü˛≥∂)¿\‘G\‡?ã<@¢\r¿D∏)¿|Éˆ\Íã<@ó\…p<üπ)¿\Z\¬1Àûå<@‹°a1\Í∫)¿\Ã|?ç<@®´;€º)¿\Ôrﬂç<@\0«û=ø)¿*X\„l:é<@”ü˝H¡)¿˝ø\Í»ëé<@\¬/ıÛ¶\¬)¿_)\À«é<@,ú§˘\√)¿ΩS˜<è<@\ËÖ;\∆)¿®n.˛∂è<@¢BusÒ\«)¿LbıGê<@≠N\ŒP\‹\…)¿<¡˛\Î‹ê<@ıº\n\À)¿∏Kuì<@?≠¢?4\À)¿Wñ\Ë,≥î<@\ÁäRB∞\ )¿;±O\0ï<@\€¸ø\Í\»\…)¿&\Â`6ï<@ì\»>»≤\»)¿\Z4ÙOpï<@KîΩ•ú\«)¿Dãl\Á˚ï<@\ÕÇ9z\ƒ)¿\Zâ\–6ñ<@^Ù§\√)¿\ZM.\∆¿ñ<@32\»]Ñ¡)¿9*7QKó<@\‹x`¿)¿§¸§⁄ßó<@µo\ÓØø)¿\Z\·\ÌAò<@‘õQÛΩ)¿4Lm©Éò<@º≠Ù\⁄lº)¿¡\0¬áô<@\—Wêf,∫)¿2sÅ\Àcô<@¨8\’Z∏)¿ÖÃïAµô<@¡S»ïz∂)¿\ÌI`sö<@r \nf¥)¿\rU1ï~ö<@4-±2≤)¿F$\n-\Îö<@\Á¸«ÅØ)¿zSë\ncõ<@ãQ\◊\⁄˚¨)¿í\·\n(ú<@ºA¥V¥©)¿‡†Ω˙xú<@/\¬\Â“®)¿h\Ê\…5ù<@&4I,)ß)¿\ŸwEøù<@¨®¡4ß)¿Ω8Ò’éû<@í∑µÖß)¿új-\ÃBü<@ó\»gß)¿\"nN%†<@¡)Õ¶)¿2\«ÚÆz†<@\Â\Ïù\—V•)¿Ö|–≥Y°<@æ_¥«£)¿WØ\"£¢<@(~åπk°)¿`Wìß¨¢<@T∆øœ∏†)¿fÑ∑!§<@\ PS\Èü)¿Ø\Ì\Ìñ\‰§<@™`TR\'†)¿Q\‹Ò&ø•<@0†\Ó\\†)¿zãá˜®<@{ºê°)¿0\⁄\„Öt®<@˘ü¸\›;¢)¿líÒ+™<@\Ã$\Íü¶)¿JñìP˙™<@\ÈÛQF\\®)¿\"˙µı”´<@£\Zˆ{™)¿˛ú0a¨<@√ü\·\Õ\Z¨)¿\rT∆øœ¨<@/ãâ\Õ«≠)¿\ËŸ¨˙\\≠<@õv1\ÕtØ)¿Òd73Æ<@v¿u≈å∞)¿\⁄\Á1\ 3Ø<@a\‡π˜p±)¿îâ[1∞<@q\‚´≈±)¿Ö\Œk\Ï±<@t&m≤)¿±nº;2≤<@n0\‘aÖ≥)¿˚ë\"2¨≤<@i:;µ)¿w.åÙ≤<@;¸5Y£∂)¿\ÿ\‘yT¸≥<@§ˇ\ÂZ¥∏)¿\nºìOèµ<@§µ˚U∏)¿˝ÜK∂<@¿YJñì∏)¿u™)…∂<@\Ô_{fπ)¿\⁄ñ?∑<@ù+J	¡∫)¿9\n∏<@t±3Öæ)¿w/˜\…Q∏<@(õrÖø)¿û\”,\–\Ó∏<@\ \·ìN$¿)¿!±\›=@ª<@H§m¸â\¬)¿Ze¶¥˛∫<@˜?¿Zµ\√)¿t	á∫<@˘Ûm¡R\≈)¿ïF\Ã\ÏÛº<@Ñ\Ÿñ\œ)¿M†àΩ<@}Æ∂b\—)¿\…s}æ<@t\\ç\ÏJ\”)¿¥é™&àæ<@±ä72è\‘)¿\Á8∑	˜æ<@sÛç\Ëû\’)¿£î¨™ø<@äæ¢[\◊)¿\'∑\nb¿<@sJ_\Ÿ)¿\◊˚çv\‹¿<@Òû\À\⁄)¿ö\ŒNG¡<@iˇ¨U\€)¿P´îû¡<@ÙPoF\›)¿*6\Êu\ƒ¡<@˙)éØ\ﬁ)¿ú\'æ\⁄¡<@ÜÆD†˙\ﬂ)¿áO:ë`\¬<@,\“S\‰\‡)¿\ﬁ\„L∂\√<@~o”ü˝\‡)¿%vmo∑\»<@>ñ#d\‡)¿\ÏjÚî\’\»<@ßëñ\ \€\·)¿èâîfÛ\»<@N`:≠\„)¿Q\ﬁ\«\—\…<@\'øE\'K\Â)¿\‚s\'\ÿ\…<@©ı~£\Á)¿ŒéT\ﬂ˘\…<@\r7\‡Û\√\Ë)¿øI”†h\ <@\ƒ_ì5\Í\È)¿≠lÚñ\À<@\¬¯i\‹\Î)¿öò.\ƒ\Í\À<@0Gè\ﬂ\€\Ï)¿,®˛A\Ã<@\r\‰\Ÿ\Â[\Ô)¿◊ø\Î3g\Õ<@¬á-yÙ)¿ü!≥\Ï\Õ<@Æd\«F ˆ)¿û\–\ÎO\Œ<@,}\ËÇ˙ˆ)¿ \Î©\’W\œ<@Ü™òJ?˘)¿`<ÉÜ˛\—<@Å±æÅ˘)¿\Ã}r \“<@≠lÚñ˚)¿v\∆˜≈•\“<@\’{*ß=˝)¿gG™\Ô¸\“<@gsÇ6*¿c\0é=\”<@çµø≥=*¿|ds\’<\”<@\‡.˚uß*¿M1AG\”<@êe¡\ƒ*¿6Œ¶#Ä\”<@\ƒz£Vò*¿8ÿõí\”<@ú\ƒ ∞r*¿\'\€¿®\”<@\Î\·\ÀD\n*¿8¿\Ãw\”<@’íér0*¿R∑≥Ø<\‘<@¥î,\'°*¿èR	O\‘<@g\”¿\r*¿á˛	.V\‘<@ÖÏºç\Õ*¿∑∂ºT\‘<@çbπ•\’*¿ zR&5\‘<@\‡°(\–\'*¿\Ì)\‘<@Ku/*¿\'OYM\◊\”<@\ÌÒB:<*¿m<\ÿb∑\”<@©3˜ê*¿ôHi6è\”<@>^Háá*¿äXƒ∞\”<@™IÜ4\Z*¿\Ó{\‘_Ø\‘<@\›zM*¿)%´\Í\’<@S>U£*¿å\‹\”\’\◊<@˘Lˆ\œ\” *¿n\Óïy\◊<@wj.7\"*¿c∂dUÑ\◊<@c\0é=#*¿.v˚¨2\◊<@d!:é$*¿¸\0§6q\÷<@Ûíˇ\…\ﬂ%*¿+\¬MFï\’<@D¶|™&*¿è\≈6©h\‘<@&Q/¯4\'*¿Ifı∑\”<@a™ôµ(*¿Ec\Ì\Ôl\”<@^Ù§)*¿±§\‹}é\”<@´ó\ﬂi2+*¿∆¢\È\Ïd\‘<@<\ﬁ\‰∑\Ë,*¿øµ%!\’<@≥ómß-*¿oª\–\\ß\’<@3jæJ>.*¿º \"5\Ì\÷<@Ö\\©gA0*¿\”/où\◊<@\’\"¢òº1*¿7\€\ÿ<@∂∫ú3*¿VÄ\Ô6o\ÿ<@9`Wìß4*¿Öñuˇ\ÿ<@¥Æ\—r†7*¿èlÆö\Á\ÿ<@ΩTl\Ã\Î8*¿ˇxØZô\ÿ<@,gÔå∂:*¿VW@\ÿ<@\rãQ\◊\⁄;*¿1a4+\€\◊<@0ûACˇ<*¿\Õr\Ÿ\Ëú\◊<@∫áÑ\Ô˝=*¿Å\œ#Ñ\◊<@™\…@*¿ª”ù\'û\◊<@=|ô(BB*¿h\Á4¥\◊<@W{\ÿD*¿C©Ωà∂\◊<@ù:\ËF*¿HƒîH¢\◊<@\Í\nºìG*¿4π\Î\ÿ<@\€2\‡,%K*¿c∑\œ*3\Ÿ<@º\ ⁄¶xL*¿f¢©\€\Ÿ<@ò6\ ˙M*¿∫,&6\€<@Ø|ñ\Á¡M*¿ì\≈˝G¶\€<@A,õ9$M*¿øös\‹<@Ct	L*¿C\‰Ùı|\›<@≠O9&ãK*¿\Ÿ\Ã!©Ö\ﬁ<@^i©˜L*¿ÆE–∂\ﬁ<@% &\·BN*¿\”N\Ô\ﬁ<@®V_]P*¿£î¨™\ﬂ<@\∆¿:éR*¿\¬\ﬁƒêú\‡<@6¨©,\nS*¿¿Æ&OY\·<@\ \¬\◊\◊R*¿R\—\Ë\‚<@\ƒ%«ù\“Q*¿¯§	¶\‚<@ø)¨TP*¿,ÒÄ≤)\„<@\›`®\√\nO*¿c\Ÿ=y\‰<@˛ù\Ì\—N*¿På,ôc\Â<@]jÑ~¶N*¿5^∫I\Ê<@^f\ÿ(\ÎO*¿ZÒ\rÖ\œ\Ê<@BôFìãQ*¿∏ [ñ\Á<@µ‹ô	ÜS*¿#¯\ﬂJv\Ë<@∆øœ∏pX*¿«É-v˚\Ë<@˛aKè¶Z*¿0\‘aÖ[\Í<@íL\‡\÷]*¿üp]1\Î<@é@ºÆ_`*¿Ò\‘#\rn\Î<@øõn\Ÿa*¿Å\Ïı\Óè\Î<@ë_?\ƒc*¿\œ:Ø±\Î<@\0\„4d*¿5ôÒ∂\“\Î<@3Pˇf*¿_9\Ôˇ\Î<@\Ê\È\\QJh*¿\Ô\—!\Ï<@^J]2éi*¿dêªS\Ï<@\Ÿ@∫ÿ¥j*¿B\Ì∑v¢\Ï<@¡å)X\„l*¿ßwÒ~\Ï<@Üs\r34n*¿¢|A	\Ï<@i¢≤q*¿ÙR±1Ø\Î<@∫ªŒÜ¸s*¿0Û¸\ƒ\Ì<@≠¶ÎâÆ{*¿÷èMÚ#\Ó<@	Qæ†}*¿±S¨\ZÑÒ<@≠\ﬂLLí*¿TrN\Ï°Ò<@LS8Ωì*¿eéÆ\“Ò<@Ω\∆.QΩï*¿ë\Ì|?5Ú<@\r;®ƒù*¿ip[[xÚ<@ò3\€˙†*¿\\W\ÃÛ<@|Éˆ\Í£*¿FzQªÛ<@ΩfæÉß*¿Ù\‹BW\"Ù<@ˇ\ÏGä»®*¿—êÒ(ïÙ<@^\€\€-…©*¿=1Xı<@h\Á4¥´*¿G\ Iªı<@F]k\ÔS≠*¿\Ó=\\r\‹ı<@\÷\≈m4ÄØ*¿ª{Ä\Ó\Àı<@c\“\ﬂK±*¿-\È(≥ı<@8¿\Ãw≥*¿Lé;•Éı<@H¶Cß\Áµ*¿/£Xniı<@Háá0~∫*¿\–cîg^ˆ<@Æ.ßƒº*¿qé::Æˆ<@xè˝,æ*¿f\À-≠ˆ<@3à\Ï¯ø*¿⁄≠e2˜<@\rq¨ã\€¿*¿.W?6\…˜<@gF?\ZN¡*¿\∆m4Ä∑¯<@°ºè£¡*¿ AÒc\Ã˘<@O\"¬ø\¬*¿à+g\Ôå˙<@*™~•Û¡*¿)!XU/˚<@,ÉjÉ¡*¿¨Uª&¸<@˘ÖWí<ø*¿	Tˇ í˝<@\ƒ\\Rµ›º*¿[`èâî˛<@‹∫õß:º*¿óVC\‚ˇ<@JzZùº*¿`\…U,~ˇ<@?6…è¯Ω*¿˙∏6Tåˇ<@\€MM”ø*¿o\◊jˇ<@\‘~k\'J\¬*¿	m9ó˛<@…ë\Œ¿\»\√*¿?6…è¯˝<@ßY†\›!\≈*¿\“q5≤+˝<@	\∆¡•c\∆*¿˘ûëç¸<@ò\√\Ó;Ü\«*¿Ãô\Ì\n}¸<@Ω¶•\»*¿B\'Ñ∫¸<@ûóäç\…*¿ÑIÒÒ	˝<@+¯màÒ\ *¿Æ∏8*7˝<@åû[\ËJ\Ã*¿¡tZ∑A˝<@=\’!7\√\Õ*¿^Û™\Œj˝<@HßÆ|ñ\œ*¿Q€ÜQ=@n0\‘aÖ\€*¿´\ÎPMI=@-\Œ\ﬁ*¿%\œı}8=@\÷6\≈\„¢\‚*¿\¬4=@´\ÃC¶\‰*¿\»zjı=@U˙	g∑\Ê*¿Iª\—\«|\0=@≥\'Å\Õ9\Ë*¿™FØ\0=@¨\«}´u\Í*¿ÒÒ	\Ÿyˇ<@\„n≠\Ì*¿\Â^`V(˛<@¶”∫\rj\Ô*¿!\»A	3˝<@É<Ö\\Ò*¿\ÁˇUGé¸<@¬£ç#\÷Ú*¿Qæ†Ö¸<@sÇ69Ù*¿¢\’\…ä˚<@!Æúı*¿ùŸÆ\–˚<@Lk\”\ÿˆ*¿ò˘~˙<@zãá˜¯*¿\ﬁu6\‰ü˘<@kæ*˙*¿^/M\‡¯<@\›\ÕSr˚*¿òáL˘¯<@w-!Ù¸*¿q\„Ûs˜<@H4Å\"˛*¿\»}´u\‚ˆ<@Y¡oCåˇ*¿nã2dˆ<@òP¡\·+¿¿ñWÆ∑ı<@\Ìô%j+¿j3NCTı<@8/N|µ+¿\√9}=\Ô<@∏îÛ\≈\ﬁ+¿w°πN#\Ì<@W\Î\ƒ\Âx\r+¿\Ëı\'Òπ\Î<@AE’Øt+¿z˛¥Qù\Í<@°¢\ÍW:+¿˛e˜\‰a\È<@\Õ\Êq\Ã+¿(Hlw\Ë<@çbπ•\’+¿\Õ\Àa˜\Á<@≈´¨m+¿n¿\Áá\Ê<@óo}Xo+¿Æg\«,\„<@Ø\'∫.¸+¿{˘ù&3\‚<@\…ˇ\‰\Ô\ﬁ+¿Eøï\Ï\‡<@˙õPàÄ+¿p≥x±0\‡<@E†˙ë+¿æHâ]\ﬂ<@~ß…å∑+¿qN`\ﬁ<@N∂Å;P+¿iè\“\·\›<@qrøCQ +¿qê\Â\⁄<@\ﬂjù∏\'+¿íìâ[\Ÿ<@f2\œg(+¿an˜rü\ÿ<@ãO0û)+¿pñí\Â$\ÿ<@m±ü*+¿\‰I\“5ì\◊<@h[\Õ:\„++¿Ûqm®\◊<@U¢\Ï-\Â,+¿\Õ\Õ7¢{\÷<@?˙\ÓV.+¿ÆfùÒ}\’<@8¯\¬d™0+¿éwG\∆jø<@òi˚WV:+¿«É-v˚¥<@∞»ØbC+¿2\0«ûµ<@‹Å:\Â\—E+¿L\∆1í=∂<@2Æ∏8*G+¿\Í]º∑∑<@˚`≠\⁄M+¿w°πN#µ<@°ºè£9R+¿Â¥ß‰ú¥<@º<i\·R+¿$0‹≥<@˜?¿ZµS+¿M1AG≥<@\0!ÆT+¿L\ƒ[\Áﬂ≤<@áQ<æU+¿líÒ+≤<@S\ k%tW+¿≥ıµ.±<@\ÏMY+¿à†jÙj∞<@ZπòZ+¿~SX©†Æ<@\Œ›Æó¶`+¿\›Eò¢\\Æ<@á˝ûXßb+¿;Ú\œÆ<@óåc${d+¿^Ñ) •≠<@B@æÑ\nf+¿K™≠<@\\\ËJ™g+¿&qVDM¨<@º\Õ\'Öi+¿©à\”I∂™<@v\¬Kp\Ík+¿0Û¸ƒ©<@;\Zá˙m+¿6\Á\‡ô®<@™CnÜp+¿E∏…®2®<@q:q+¿ª@jß<@Té\…\‚˛s+¿\Ÿ\Èuë¶<@4+€áºu+¿Y∑\—\0¶<@\Î\‡`obx+¿%≥zá€•<@°jÙjÄz+¿W|C·≥•<@\‡\ŸΩ\·~+¿®W\ 2ƒ•<@üwcAaÄ+¿\Èù\n∏\Á•<@\Ã	\⁄\‰Å+¿£ì•\÷˚•<@c%\ÊYIÉ+¿˛c!:¶<@π4~·ïÑ+¿`\«ï¶<@|C\·≥uà+¿zrMÅÃ¶<@1^Û™Œä+¿uÆ(%ß<@\\ïõ®ç+¿§U-\È(ß<@\–CmFë+¿¢|Aß<@˜≠÷âì+¿]3˘fõß<@pó˝∫”ï+¿ûy9Ïæß<@Ç\Á\ﬁ\√%ó+¿ù,µﬁß<@8\€‹òûò+¿,cC7˚ß<@M!u;õ+¿\‚\…nfÙß<@i©º\·ú+¿\„¬Åê,®<@mésõ†+¿ zR&5®<@™\’WW¢+¿©2åªA®<@\⁄T\›#õ£+¿æ€ºqR®<@hñ®©•+¿çónÉ®<@à÷ä6«©+¿{¯2QÑ®<@¿>:u\Â´+¿\Õ\‰õmn®<@?\„\√\Ï≠+¿\ÈÛQF\\®<@®\‚\∆-\ÊØ+¿˙,AF®<@ \‘E\ne±+¿7®˝\÷N®<@®¸ky\Â≤+¿P≈ç[®<@ı9D‹¥+¿uëBY®<@\◊4\Ô8E∑+¿êim\Z€ß<@\“S\‰π+¿\Îßˇ¨˘•<@\‚X∑—∏+¿:∞!•<@N&nƒ∏+¿\⁄(∑\Ì£<@ñ{ÅY°∏+¿y\À’èM¢<@úº\Ë+∏+¿\Í{\r¡q°<@^,ë”∑+¿có®\ﬁ\Z†<@1\nÇ«∑∑+¿P)îù<@\«.QΩ5∏+¿\Ã\—\„˜6ô<@l\ÕV^Ú∑+¿\Z£Æµó<@oF\ÕW…∑+¿ŸØ;\›yñ<@uX·ñ∑+¿)\Ëˆí∆î<@˚Zó\Z°∑+¿B`\Â\–\"ì<@±§\‹}é∑+¿\ÈE\Ì~ë<@ø\ÓtÁâ∑+¿Ò°DKè<@\—6Æ∑+¿,*\‚tíç<@]pø∏+¿IhÀπã<@≠méª+¿ë\'I\◊Lä<@¡\„€ª+¿C=}˛à<@?åmº+¿Ü©-uêá<@;±O\0Ω+¿4Û\‰öÖ<@∞9œÑæ+¿\‹\„5ØÇ<@ív£è˘¿+¿D˙\Ì\Î¿Å<@\«/ºí\‰¡+¿\‚ÃØ\Ê\0Å<@o+Ω6\√+¿â\ÎW\\Ä<@˚Øs\”f\ƒ+¿æ€ºqR|<@ü\«(œº\ƒ+¿∑\Ì{\‘_{<@\»~Kë\ƒ+¿ö\È^\'ıy<@i®QH2\√+¿)H4y<@N\’=≤π\¬+¿\ƒ	Lßuw<@u\ÀÒ\√+¿6\ ˙\Õ\ƒt<@a4+€á\ƒ+¿\ PS\Ès<@ó\‚∂\ƒ+¿Dâñ<ûr<@\ÓfÖ\"\≈+¿{¢\Î\¬r<@tE)!X\≈+¿†ãÜåGq<@n¬Ω2o\≈+¿\Ëyíp<@ÒHº<\≈+¿\‚\…nfÙo<@Ò~\‹~˘\ƒ+¿¿@ Co<@\ÕÇ9z\ƒ+¿‰†Ñôn<@|~!\ƒ+¿\n±àak<@°-\ÁR\\\≈+¿ò4F\Î®j<@&ßvÜ©\≈+¿W\Î\ƒ\Âxi<@É›∞mQ\∆+¿IÜ[\œh<@}ZEh\∆+¿\‡\◊HÑg<@\ﬁVzm6\∆+¿`\«ïf<@\…uS\ k\≈+¿&\ƒ\\Rµe<@\‹,^\ƒ+¿á\ﬂM∑\Ïd<@¸ﬁ¨¡\√+¿t\Î5=(d<@\›$Åï\√+¿\„\‡\“1c<@!\È\”*˙\√+¿¿±g\œeb<@5\rä\Ê\ƒ+¿2í=B\Õ`<@0ù\÷mP\√+¿MÙ˘(#^<@÷çwG\∆\¬+¿\«ïF\Ã\\<@e∏u\¬+¿B?SØ[X<@˛HV¡+¿úlw†V<@\ÿÒ_¿+¿¨™ó\ﬂU<@\Z\‹\÷ûø+¿a2U0*U<@[C©Ωàæ+¿ª_¯nS<@a§µ˚Ω+¿ıcô~Q<@ïï-ø+¿\nÑùb\’P<@\–(]˙ø+¿∂%!ëN<@\0™∏q\√+¿\ÌI`sN<@KXc\'\ƒ+¿4¯˚\≈lM<@SAE’Ø\ƒ+¿\Â\r0ÛL<@¢E∂Û˝\ƒ+¿u\ËÙºK<@Éä™_\È\ƒ+¿!\"5\ÌbJ<@B\Î\·\À\ƒ+¿œÅ\ÂH<@eÆπ\√+¿0ù\÷mPG<@€æG˝ı\¬+¿@QŸ∞¶F<@i\¬+¿MáNœªE<@>%\Á\ƒ\¬+¿éïòg%E<@nLOX\‚¡+¿ÒÒ	\ŸyC<@\ \≈X\«¡+¿ZH¿\ËÚB<@z\·ŒÖ¡+¿≥E\“nÙA<@{Ç\ƒv˜¿+¿\¬5wÙø@<@-§˝¿+¿ˆ≥Xä\‰?<@\–(]˙ø+¿É\√\"R?<@Ü\Ë8¿+¿˜ôù><@+ˆó›ìø+¿D‘∑\Ã=<@°◊ü\ƒ\Áæ+¿º—ì2=<@™gx≥æ+¿¡˝Ä<<@ıg?RDæ+¿A°Gå:<@#K\ÊXﬁΩ+¿\rnk\œ7<@©i”º+¿Dá¿ë@7<@U.T˛µº+¿O¨S\Â{6<@MÑ\rOØº+¿\Œ7¢{\÷5<@G;n¯›º+¿d≤∏ˇ\»,<@IddY¿+¿jºtì,<@¯ßTâ\¬+¿f¿YJñ+<@˛\—7i\Z\ƒ+¿¸¥W+<@)=\”Kå\≈+¿=Å∞S¨*<@∏\\˝\ÿ$\«+¿,æ-X*<@ª,Dá\»+¿:ñw\’*<@•0\Ôq¶\…+¿µ£8G)<@[A\”\À+¿‰ûÆ\ÓX(<@X\ÂB\Â_\À+¿Çê,`\'<@F–òI\‘\À+¿ô~âx\Î$<@\‡ÿ≥\Á2\Õ+¿˘á-=ö\"<@˜u\‡ú\Õ+¿∑\”÷à` <@vq\r\‡\Õ+¿ıeiß\Ê<@\Èö\…7\€\Ã+¿m\«\‘]<@\"OíÆô\Ã+¿åÙ¢vø\Z<@µ}\Ã\Ã+¿\œg@Ω<@µ\ƒ\ h\‰\À+¿ÇUıÚ<@£Ø \ÕX\Ã+¿üÆ\ÓXl<@≥±Û¨\Ã+¿®REÒ<@.\Z2\Õ+¿\Ï˚pê<@y=ò\œ+¿f6\\<@cE\r¶a\–+¿‹Ç•∫Ä<@ıı|\Õr\—+¿ë∫ù}\Â<@5\Îå\Ôã\”+¿\‚\…nfÙ<@\Ê¨O9&\”+¿\Â\“¯ÖW<@˚\Ái¿ \—+¿ë9∂û\r<@Eøï\Ï\–+¿hv\›[ë<@\œˆ\Ë\r˜\—+¿?\‡ÅÑ<@Û!®\ZΩ\“+¿\»`≈©\÷\n<@ø\r1^Û\“+¿õ\‚qQ-\n<@èUJ\œÙ\“+¿Ú%Tpx	<@\0´#G:\”+¿%∞9\œ<@6î⁄ãh\”+¿\÷\≈m4Ä<@Ìöê\÷\‘+¿\Áß8º<@\ ä;\ﬁ\‘+¿\Êï\Îm3<@\›|#∫g\’+¿\√\’<@\Íx\Ã@e\‘+¿¢+\‹Ú<@∑_>Y1\‘+¿™\‘\ÏÅV\0<@Ãñ¨äp\”+¿2U0*©ˇ;@}@†3i\”+¿O \Ï´˛;@ÄJï({\”+¿ni5$\Ó˝;@\”k≥±\”+¿j˘Å´<˝;@7P\‡ù|\“+¿§R\Ïh¸;@án˘H\“+¿\»“á.®˚;@ß≥ì¡Q\“+¿\·\“1\Á˚;@¥é™&à\“+¿G´Z\“Q˙;@é\Ê\»\ /\”+¿î˘Gﬂ§˘;@\¬j,am\‘+¿KÃ≥íV¯;@xè˝,\÷+¿Tsπ¡P˜;@y¨\‰\÷+¿ô\”e1±ı;@£\Œ\‹C\¬\◊+¿\Î9\È}\„Û;@\‚|~\Ÿ+¿2\√FYÛ;@\'à∫@\⁄+¿z\ƒËπÖÚ;@π˛]ü9\€+¿≥\Ó\—Ò;@)YNB\È\€+¿™Å\Ês\Ó\Ó;@w¢$$\“\ﬁ+¿x\Ó=\\\Ó;@NôõoD\ﬂ+¿gùÒ}q\Ì;@â\n\’\Õ\≈\ﬂ+¿d> –ô\Ï;@yv˘\÷\ﬂ+¿ÜÆD†˙\Á;@BØ?â\œ\›+¿IΩßr\⁄\Á;@ñîª\œÒ\Ÿ+¿\⁄\»uS\ \Á;@6\È∂D.\ÿ+¿úMG\07\Á;@L\‡\÷\›<\’+¿~\«\ÿ\œ\Ê;@IúQ\Õ+¿\‡0\— \Á;@\„\√\Ïe\À+¿;pŒà\“\Ê;@∞™^~ß\…+¿&ßvÜ©\Â;@!≠1\ËÑ\»+¿\\\∆M\r4\„;@≤KTo\r\ƒ+¿\·\ÁS\«\‚;@ˇ>\„\¬¡+¿ˇÀµh\‚;@z\ƒËπΩ+¿40Ú≤&\‚;@h\«,{∫+¿\Ÿ|\\*\‚;@öîÇn/π+¿sı∏o\·;@∏sa§µ+¿ä)x\n\·;@≠•Ä¥ˇ±+¿úi\¬ˆì\·;@8fŸì¿Æ+¿¯k≤F=\‰;@¸6\ƒx≠+¿5C™(^\Â;@tE)!X≠+¿^-w\Ê;@\⁄9\Õ≠+¿¥t\Á;@\ÿF<\ŸÕ¨+¿\‚\ÀDR\Á;@ ∏\ ´+¿≥ò\ÿ|\\\Á;@æ€ºqR®+¿.»ñ\Â\Á;@\Î®jÇ®£+¿çzàFw\Ë;@FC∆£T¢+¿a\√\”+\È;@\Ÿyõ°+¿Ú\È±-\Í;@ù\◊\ÿ%™ü+¿Xˇ\Á0_\Í;@-\Ïiáøû+¿\'/2ø\Í;@¢≤aMù+¿\√ÛR±1\Î;@\„Pø[õ+¿Ö$≥z\Î;@kÅ=&Rö+¿ ä\·\Í\0\Ï;@Û¨§ﬂò+¿\’?àd\Ï;@ùùéíó+¿\Ô5&\ƒ\Ï;@öœπ€ï+¿Æ∏8*7\Ì;@∫û\Ë∫ì+¿—ë\\˛C\Ó;@\◊1Æ∏8í+¿gùÒ}q\’;@ôπ¿\ÂI+¿ºØ Ö\ \”;@_\rP\ZjL+¿¡\‚p\ÊW\”;@G\»@û]N+¿ÆbÒõ\¬\“;@C=}˛P+¿∞\Áå(\—;@r7à÷äV+¿ZÄ∂’¨\œ;@\œ,	PS[+¿íó5±¿\À;@ƒØX\√E^+¿\Œoòhê\ ;@a\ﬁ\„L^+¿v7Ou\»\…;@;MÑ\r_+¿é\È	K<\»;@2t\Ï`+¿5\–|\Œ\›\∆;@pŒà\“\ﬁ`+¿∑&›ñ\»\≈;@òÖvN≥`+¿Ã∂\”÷à\ƒ;@v\›[ëò`+¿\ÿe¯O7¿;@\‚;1\Î\≈`+¿\Ÿ\—8\‘\Ôæ;@øÛãÙ_+¿gõ\”æ;@\nfL¡\Z_+¿x}\Ê¨OΩ;@#Ü∆§_+¿±ä72èº;@•û°º_+¿/OÁä∫;@©›Ø|_+¿y\Íë∑π;@x%\…s}_+¿\«ÚÆz¿∏;@H\‹c\ÈC_+¿U¯3ºY∑;@=\Ó\Œ\⁄]+¿EÇ©f÷∂;@ô~âx\Î\\+¿2≠Mc{µ;@k+ˆó\›[+¿oK\‰Ç3¥;@EÒ*kõZ+¿•øó¬É≤;@}\ËÇ˙ñY+¿{\⁄·Ø±;@Úî\’t=Y+¿¥íV|C±;@\È\Ó:ÚW+¿é∞;@-≤ù\ÔßV+¿t_\ŒlØ;@©P\›\\¸U+¿\÷wıÆ;@/¿>:uU+¿≤J\Èô^Æ;@\Í\ÁME*T+¿‘Å¨ßV´;@@¯P¢%O+¿\ j∫û\Ë¶;@KÆbÒõJ+¿VÒF¶;@ø**ˇJ+¿ˇ+j§;@á˙]ÿöM+¿cÚò˘¢;@§ng_yP+¿X9¥\»v¢;@v√∂EQ+¿\›ŒæÚ °;@t\Ì\ËÖS+¿\’&N\Ów†;@ø∑\È\œ~T+¿X´vMHü;@\∆G\ÂV+¿H©Ñ\'Ùû;@9(a¶\ÌW+¿§ä\‚U÷û;@\Ámlv§Z+¿}∞å\r°;@zn°+h+¿,∏¿†;@üêù∑i+¿[\Ìa/†;@ø∂~˙\œj+¿\€O\∆¯0ü;@	˛∑ík+¿\Ï´aû;@\€l¨\ƒ<k+¿Q\‹Ò&øù;@≥^\ÂDk+¿£êdV\Ôú;@ÉßZk+¿u/3lú;@ïG7¬¢j+¿$π¸áÙõ;@]lZ)j+¿gdêªõ;@9(a¶\Ìg+¿Òbaàúö;@;MÑ\rg+¿BôFìãô;@¯UπP˘g+¿Œ®˘*˘ò;@ˇ>\„¬Åh+¿ê¸6ƒò;@V\Ï1ëj+¿òßsE)ô;@:\À,B±m+¿\n+TTô;@¸èLáNo+¿(õrÖwô;@ˇ!˝ˆup+¿cAaP¶ô;@æ˘\r\rr+¿V-≤ô;@•t{Is+¿¸é·±üô;@A,õ9$u+¿\ÃbbÛqô;@Æªy™Cv+¿t\ÓvΩ4ô;@gE\‘Düw+¿D\¬˜˛ô;@_ó\·?\›x+¿e\ZM.∆ò;@˛De√öz+¿w†Nytó;@uÄ\‘&~+¿Ñü8Ä~ì;@Æ\”HK\ÂÖ+¿]7•ºVí;@Ö˜à+¿<ÉÜ˛	í;@á¸3É¯à+¿Éˆ\Í\„ë;@tCSv˙â+¿OWw,∂ë;@Ù¡26tã+¿QÖ?√õë;@∂ı\”÷å+¿%\Ë/Ùàë;@E\Á\·é+¿â#Dë;@Ω¶•ê+¿$\Ÿ@∫ê;@\œg@Ωë+¿KØ\Õ\∆Jê;@±2\Z˘ºí+¿\—6Æè;@w°πN#ï+¿	ß/˙é;@+áô+¿6\\‰ûÆé;@\’Í´´ù+¿KÆbÒõé;@®(Nû+¿\ÌúfÅé;@\Àh\‰Ûäü+¿∏! _é;@°/Ω˝π†+¿=)ì\Zé;@QΩ¬¢+¿¨\‰.é;@û(	â¥•+¿R\Ó>\«Gã;@]˚z\·¶+¿\œh´í»ä;@9D‹úJ¶+¿1[≤*ä;@π˚-¶+¿˝Ç›∞mâ;@_Cp\\∆•+¿S$_	§à;@\ÃC¶|¢+¿¢zk`´à;@Î´´µ†+¿UK:\ ¡à;@*sÛç\Ëû+¿ôE(∂ÇÜ;@\◊3\¬€õ+¿\ﬂ\≈˚q˚Ö;@ˇñ\0¸Sö+¿^ª¥\·Ñ;@\ÎT˘ûëò+¿pµN\\éÉ;@{ÜpÃ≤ó+¿¡ß9yëÅ;@˜é\Zbñ+¿≥~31]Ä;@±ã¢>ñ+¿F#üW<};@ßŒ£\‚ˇñ+¿µ6ç\Ìµ|;@±u≠Ωó+¿Ã∏©Å\Ê{;@*ˇZ^ô+¿üW<ıH{;@∫h\»xîö+¿*≠ø%\0{;@ãßipõ+¿u\Êz;@∏Kuü+¿\€¯ï\r{;@¡nÿ∂†+¿∑ñ\…p<{;@∏YºX¢+¿zpw\÷n{;@\Ô\‰\”c£+¿øE\'K≠{;@∆àD°e•+¿\"4Çç\Î{;@á¡¸2ß+¿µ\·∞4{;@ C\«*©+¿eã§\›\Ë{;@õ9$µP™+¿M/1ñ\È{;@(\Ô\„hé¨+¿îær\ﬁ{;@:\ËΩ≠+¿\'OYM\◊{;@ôg%≠¯Æ+¿6Ü\Â\œ{;@î\√\’∞+¿4ª\Ó≠H|;@æ›í∞≥+¿ù*\ﬂ3};@`¯nÛ∂+¿å¯N\Ãz};@\'áO:ë∏+¿Hâ]\€\€};@º\ÊUù’∫+¿c\“\ﬂK\·};@y=òø+¿\“nÙ1|;@˜X˙¿+¿m°ıy;@\÷\„æ\’:¡+¿ΩqRò˜x;@Ø\“\›u6\ƒ+¿\ ƒ≠Çx;@3QÑ\‘\Ì\ƒ+¿\Ó\È\Íé\≈v;@X·ñè§\ƒ+¿MK¨åv;@¨êÚìj\«+¿î/h!w;@Y\›\Í\…+¿AJ\Ï\⁄\ﬁv;@l!\»A	\À+¿A∂,_óu;@\÷6\≈\„¢\ +¿¸V\Î\ƒ\Ât;@\¬Pán\…+¿áR{ms;@˜:©/K\À+¿\’=≤πjr;@.»ñ\Â\Î\ +¿∑µÖ\Áq;@≠àö\ËÛ\…+¿\œ¯æ∏Tq;@\‰÷§\€\…+¿ö[!¨\∆n;@Ü\»\È\Î˘\ +¿\—tv28n;@~£<Û\ +¿\Õ\‰õmnl;@qç\œdˇ\Ã+¿]•ª\Îl;@5F\Î®j\“+¿Ùà\—sm;@\0U‹∏\≈\‘+¿éØ=≥$l;@Ÿ±à\◊\’+¿]ø`7lk;@\Ô;Ü\«~\÷+¿àW\Œj;@y\Ã|\◊+¿N)Øï\–i;@\œL0úk\ÿ+¿\‡ıô≥>i;@Ω\»¸\Z\Ÿ+¿ zR&5h;@Ùz\ƒ\Ë\Ÿ+¿y;\¬i¡g;@Æ\’ˆB\Ÿ+¿≠még;@ç~4ú2\◊+¿πß´;g;@àûîI\r\’+¿m\‰∫)\Âe;@\ÂFëµÜ\“+¿-Ø\\oõe;@6Ò∫~\—+¿∑úKqUe;@y=ò\œ+¿\‚∂Ùd;@\€LÖx$\Œ+¿˙Gﬂ§id;@ô\’;\‹\Õ+¿˛ûXß\ c;@JCçB\ +¿\Ì(\ŒQGc;@4\÷˛\Œˆ\»+¿^-wb;@2\…\»Y\»+¿i˛ò÷¶a;@~êe¡\ƒ\«+¿A∏\nı`;@ıúÙæÒ\≈+¿1\Î\≈PN`;@XéêÅ<\√+¿;\√‘ñ:`;@Ñ\÷√ó¡+¿\·].\‚;a;@\»{\’ Ñø+¿∞çx≤õa;@o≠mæ+¿xe®äa;@RDÜUºπ+¿<\ƒy8a;@≥x±0D∂+¿7TåÛ7a;@Ä)¥¥+¿1óTm7a;@*T7≥+¿\ÍuëBa;@∞X\√E\Ó±+¿õ\«a0a;@E)!XUØ+¿¯TN{Jb;@c`\«≠+¿GétFb;@Ω4EÄ”´+¿Õ∞Q\÷ob;@T¸\ﬂ™+¿\Ï1ë\“`;@\◊/\ÿ\r€¶+¿\◊j{a;@±\‹\“jH§+¿bº\ÊUùa;@ ’∞\ﬂ£+¿\Ï4\“Ry_;@`\‰eM,†+¿Û\ ı∂ô^;@pµN\\éü+¿rP\¬L[;@\nü≠Éõ+¿ø—é~[;@ﬁØ|∑ô+¿D0.[;@\0©Mú‹ó+¿¶|™F[;@\»\“≈¶ï+¿\Ã\Ô4ôÒZ;@a4+€áî+¿¯o^ú¯Z;@B>\ËŸ¨í+¿%=≠NZ;@\Ô˛xØZë+¿¬á-Y;@Ø\ÏÇ¡5è+¿ﬂ•\‘%\„X;@*U¢\Ï-ç+¿-\nª(zX;@Å\ÍDä+¿ñ\ÕíZX;@ì7¿\Ãwà+¿Ë°∂\r£X;@∏\Z£Ü+¿0Å[wÛX;@L\√1Ö+¿t—êÒ(Y;@Ù˚˛ÕÉ+¿\‡/fKVY;@l_@/‹Å+¿±S¨\ZÑY;@™Ò\“MbÄ+¿<†l\ Z;@ıæÒµg~+¿\'N\Ów(Z;@¡:é*}+¿Çç\Î\ﬂıY;@\ƒ	Lßu{+¿Äõ≈ãÖY;@˜ ºU\◊y+¿∞\Áå(Y;@¸ã†1ìx+¿˘*8ºX;@æ**w+¿˝i£:X;@Œ•∏™\Ïs+¿î\€ˆ=\ÍW;@\ﬁ\‰∑\Ëdq+¿\‘Ûn,(\0;@\07ãs+¿ˇ\"h\Ã$\ﬁ:@qN`:}+¿X\«ÒC\›:@\‚\…nfÙ{+¿Ê≠∫\’\‹:@€¶x\\T{+¿†ä∑ò\€:@ÉNty+¿Bóp\Ë-\⁄:@ØC5%Yw+¿\Ê>9\n\Ÿ:@\„5Ø\Ít+¿¶∂\‘A^\”:@\rç\'Ç8o+¿\Ô∫/g\“:@Û\Ã\Àa˜m+¿l∞pí\Ê\œ:@\◊kzPPj+¿«°~∂\Œ:@Å?¸¸˜h+¿©º\·¥\Ã:@\–cîg^f+¿2êgó\À:@˙’ë#e+¿-\Œ\ :@i˛ò÷¶a+¿(\r5\n\…:@Jòi˚W^+¿\·|\ÍX•\»:@èQûy9\\+¿%\Ï\€ID\»:@⁄®NZ+¿eo)\Á\«:@ ôùûW+¿G\Ëg\Íu\«:@πä\≈o\nS+¿WÌöê\÷\»:@ZH¿\ËÚ6+¿c`\«\…:@e˚ê∑\\5+¿\È\Ô•†\…:@ü\ÁO\’1+¿>BÕê*\ :@êf,ö\Œ.+¿êgs\ :@€¢\Ãô,+¿d\Ë\ÿ:@DæK©K˛*¿46<\Ÿ:@Ö^ü˚*¿5	ﬁêF\Ÿ:@Mi˝-¯*¿bˆ≤\Ì¥\Ÿ:@ï+º\ÀEÙ*¿\‘~k\'\⁄:@£\Á∫Ò*¿£t\È_í\⁄:@¬à}(\Ó*¿^có®\ﬁ\⁄:@§6qrø\Î*¿MÜ\„˘\‹:@jà*¸\Ê*¿.\…ªö\‹:@?ç{Û\„*¿∏>¨7j\›:@\r8K\…r\‚*¿1Xr\ﬂ:@/\›$\·*¿\‡ÚX32\‡:@ié¨¸2\‡*¿+1\œJZ\·:@mqç\œd\ﬂ*¿\Ã\œ\rM\Ÿ\·:@≤ÇﬂÜ\ﬂ*¿\"ä\…`\‚:@\Ó#∑&\›\ﬁ*¿†3iSu\„:@\ﬁ\Á¯hq\ﬁ*¿^=1\‰:@\€LÖx$\ﬁ*¿îÇUı\Í:@\ŸÉk\Ó\ÿ*¿P0ûA\Î:@•˘cZõ\÷*¿\Âõ\»\Ã\Ì:@É\ﬁC\0¿*¿\ ˝EÅ\Ó:@3¡pÆaæ*¿.</\Ô:@\ÌDIH§Ω*¿y7Rˆ:@K≠˜\Ì∏*¿∂f+/˘˜:@U¿=œü∂*¿ZÉ˜Uπ¯:@iUMµ*¿c{-\ËΩ˘:@ºvi\√a±*¿xµ‹ô	˙:@IæHâ≠*¿Y∑\—\0˙:@voEbÇ™*¿zq\»˙:@ö\Ì\n}∞§*¿KîΩ•ú˚:@ˆÛ\Âù*¿ÄJï(˚:@ò0öï\Ìõ*¿µ˙\Í™@˘:@j¡ãæÇî*¿T\Â{F\"¯:@∞\0¶ê*¿˙\n“åE˜:@B\nûBÆå*¿\ÿ\r\€eˆ:@?8ü:Vâ*¿¸é·±üı:@à+gÔåÜ*¿<Ü\«~Û:@ê-\À\◊eÄ*¿û\Ôß\∆KÛ:@…´s\»~*¿\Ëi¿ \ÈÛ:@\‰¿´\Â\Œ|*¿bÜ\∆AÙ:@ó9]{*¿\ÊmrÙ:@¨\0\ﬂm\ﬁx*¿ñ\ÕíZÙ:@j\¬ˆì1v*¿™ö \Í>Ù:@\≈\0â&Pt*¿8Ñ*5{Ù:@µ\¬ÙΩÜp*¿+mqç\œÙ:@\nö]˜n*¿ƒîH¢óı:@<º\Á¿rl*¿_µ2\·óˆ:@\ÀiO\…9i*¿òäçy˘:@X˛|[∞d*¿æ¢[Ø˘:@\ÈG\√)sc*¿í\Œ¿\»\À˙:@Xæ€ºa*¿LQ.ç_¸:@â\\p_*¿\Êx¢\'˝:@2\„m•\◊^*¿\Ó<\0;@üt\"¡T[*¿âx\Î¸ˇ:@\ﬂ¬∫Ò\ÓX*¿E\⁄∆ü®\0;@2Àû6W*¿≥\Ô´r;@≥^\ÂT*¿\"\∆k^\’;@àÄC®RS*¿l\Ã\ÎàC;@UΩ¸NìQ*¿ﬂáÉÑ(;@\\\0qWO*¿\ﬂ3°;@Z\ÿ\”M*¿\À\ÿ\–\Õ˛;@\◊OˇYÛK*¿*\‰J=;@<\ÿb∑\œJ*¿>u¨Rz;@]\√ç\'J*¿D\ﬁrıc;@ò\‹(≤\÷H*¿o.˛∂\';@\‡\’rg&H*¿z7	;@∫⁄ä˝eG*¿ó=‘∂	;@\\W\ÃG*¿u\Ê\n;@>\ÈDÇ©F*¿MÅ\ÃŒ¢;@CV∑zF*¿K#fˆy;@±®à\”IF*¿ÆaÜ\∆\r;@±4£\ZF*¿*8º ;@&7ä¨E*¿V-\È(;@|µ£8GE*¿)v4ı;@BñD*¿\∆O\„\ﬁ;@0∫º9\\C*¿øùDÑ;@\Ë¢!\„QB*¿JCçB;@vn⁄å\”@*¿\È\’\0•°;@í∑µÖ?*¿ §Ü6\0;@/Òùò=*¿)[$\ÌF;@Å]Mû≤:*¿ÈÅè¡ä;@NöEÛ8*¿\€$∂ª;@j2\„m•7*¿˚\À\Ó\…;@EJ≥y6*¿çBíYΩ;@	]\ﬁ4*¿n§lë¥;@3díë3*¿)<hv\›;@øõn\Ÿ1*¿b/∞;@>∞\„ø@0*¿â\ÎW\\;@ß<∫-*¿Fîˆ_;@k\‘C4∫+*¿5z5@i;@ë∫ù}\Â)*¿\ŸA%Æc;@\»\Ôm˙≥\'*¿÷´\»\ËÄ;@s°ÚØ\Â%*¿Ω\Z†4\‘;@±3Ö\Œk$*¿\Èb\”J;@0Å[w#*¿Ú\Îá\ÿ`;@ôIÙ2\"*¿{ºê;@äØv\Á *¿	\≈V–¥;@a5ñ∞*¿û±/\Ÿx;@\r\–\“*¿*\0\∆3h;@b.©\⁄n\Z*¿˝gÕèø;@\ÌÄ\Îä*¿î˘Gﬂ§;@Å>ë\'I*¿Ûë\ÔR;@yué\Ÿ*¿kGqé:;@⁄ç>\Ê*¿ùπáÑ\Ô;@\Ô\ZÙ•∑*¿˚ïŒág;@±S¨\ZÑ	*¿\Áß\ËH;@ø—é~*¿ìQew;@d\Ë\ÿA*¿èãjQ;@Z∫Çm\ƒ*¿?ë\'I\◊;@Ë°∂\r*¿_òLå\Z;@òıI\Ó\0*¿åfe˚ê;@(Ç8\'\0*¿\‡\‘)èÚ:@òßsE)\·)¿Q3§ä\‚Ò:@É0∑{π\ﬂ)¿A\’\Ë\’:@ãRB∞™\ﬁ)¿èP3§ä\Ó:@´\ÃC¶\‹)¿?\…6ë\Ì:@;≈™Aò\€)¿\0U‹∏\≈\Ï:@b.©\⁄)¿Ú∞Pkö\Î:@.\‰\‹H\Ÿ)¿´îû\È%\Í:@á5ïEa\◊)¿h$B#\ÿ\Ë:@†â∞\·\È\’)¿Mi˝-\Ë:@π\‚\‚®\‹\‘)¿\⁄\‰I\'\ﬁ:@∞t><K\»)¿Õ∞Q\÷o\ﬁ:@u∞˛\œa\∆)¿\Ó<0\‡:@¿[ AÒ\√)¿\ÕsDæK\·:@Ø\—r†á\¬)¿ù:\Ë\‚:@	l\Œ¡3¡)¿=Å∞S¨\‚:@+§¸§⁄ø)¿=\Ó[≠\„:@§ß\»!\‚æ)¿˝ky\Âz\„:@ÑÅ\Á\ﬁ√Ω)¿øÒµgñ\‰:@ùŸÆ\–ª)¿\ZQ\⁄|\Â:@\ËO\’\È∏)¿˘Ç0\Ê:@\€\„5∑)¿∏\Z£\Ê:@÷ßì≈µ)¿ˇ\Î‹¥\Á:@~\‡*O ¥)¿w˜\0›ó\Á:@ûx\Œ≤)¿äwÄ\'-\Ë:@u \Î©’Ø)¿òhêÇß\Ë:@75\–|Œ≠)¿˛`\‡π˜\Ë:@¿	Ö8¨)¿2\œg@\È:@m\≈˛≤{™)¿?èQûy\È:@\∆\·ÃØ\Ê®)¿sJ@L\¬\È:@+ˆó›ìß)¿\ﬁ>´Ãî\Í:@<\ŸÕå~§)¿ùπáÑ\Ô\È:@æ3⁄™$¢)¿<O<g\Ë:@L\‡\÷›ú)¿;S\Ëº\Ê:@Øñ;3ô)¿\÷UÅZ\Ê:@\n±àaó)¿Xç%¨ç\Â:@t\Í\ gyñ)¿ãä8ùd\„:@7P\‡ù|í)¿Ùz\ƒ\Ë\·:@/\›$ë)¿}\Ï.PR\‡:@ÛZ	\›%ë)¿ _Bá\ﬂ:@±6\∆Nxë)¿ìE\÷\ﬁ:@\\1–µè)¿\ \Zıç\ﬁ:@∂ÜR{ç)¿Xc\'º\‹:@,amåùà)¿)<hv\›\€:@´\ŒjÅ=Ü)¿ˇXàÅ\€:@øeNó≈Ñ)¿ıü5?˛\⁄:@m\≈˛≤{Ç)¿\·∑!\∆k\⁄:@ÒÛﬂÉ\◊~)¿yë	¯5\⁄:@™Ù\Œn})¿¯¶\È≥\⁄:@OZ∏¨z)¿∏ë≤E\“\⁄:@\ÊX\ﬁUx)¿ò\√\Ó;Ü\€:@\‚>rk\“u)¿\—z¯2Q\‹:@}zlÀÄs)¿Ò~\‹~˘\‹:@1	Úp)¿3¶`\›:@q\»\“\≈n)¿TUh ñ\›:@ëöv1\Õl)¿D£;àù\›:@Ù¬ùk)¿ñ\n*™~\›:@â@£ti)¿™D\Ÿ[\ \›:@êªSîc)¿\"\„Q*\·\›:@2v\¬Kpb)¿u\»\Õp\ﬁ:@≈è1w-a)¿•ÙL/1\ﬁ:@\ËΩ1\0_)¿~è˙\Î\ﬁ:@eˇ<\r\\)¿#\‹dT\ﬁ:@ªµLÜ\„Y)¿%ZÚx\ﬁ:@Y\"ßØW)¿¨V&¸R\ﬂ:@üuçñU)¿\”˙[\ﬂ:@[{S)¿\…°f\‡:@:$µP2Q)¿Y˜èÖ\Ë\‡:@Ò∫~¡N)¿ØZôK\·:@\„n≠M)¿7\Í∞\¬\·:@uëBY¯J)¿Ùz\ƒ\Ë\·:@øùDÑI)¿û\–\ÎO\‚:@\Ì\’\«CG)¿>¥è¸\Ê:@˜ë[ìnC)¿˜±ÇﬂÜ\Ë:@Mfº≠ÙB)¿í \\Ö\Í:@Y¶_\"\ﬁB)¿˝æÛ\‚\Ï:@ıHÉ\€\⁄B)¿SB∞™^\Ó:@∂KKC)¿(˜é\Z\Ô:@Ë°∂\rC)¿H6W\Õs:@$\n-\Î˛A)¿Òõ\¬JÒ:@Y˜èÖ\Ë@)¿P´îûÒ:@∂Úíˇ\…?)¿%ZÚxÚ:@~QÇ˛B?)¿û\Ôß\∆KÛ:@⁄®N≤>)¿GXT\ƒ\ÈÙ:@\Ôo\–^}<)¿*¨TPQı:@\„8jπ;)¿∞X\√E\Óı:@°ıe:)¿\‚\–(]ˆ:@&:\À,B9)¿^ëöˆ:@*å-98)¿\√(\ﬂˆ:@#ø~à\r6)¿\Õ˝/\◊ˆ:@&\»®p4)¿æk–ó\ﬁˆ:@b¢A\nû2)¿\œ\⁄mö˜:@Ω7Ü\00)¿†àE;¯:@B\—<ÄE.)¿\Á√≥˘:@\√Ò|\‘+)¿∑`©.\‡˘:@8¢{\÷5*)¿º\…o\—\…˙:@¸®Ü˝û()¿Û\Ï£S˚:@˙^Cp\\&)¿W\ÍY\ ˚:@~\‡*O $)¿ªÒ\Ó\»X˝:@\»\Ï,zß\")¿x{Ú˝:@\‰2nj†!)¿∞\≈nüU˛:@\◊0C\„â )¿\»A	3mˇ:@åŸíU)¿\…8F≤G\0;@\—Aóp\Ë)¿\Õ#0\0;@£Y\Ÿ>\‰)¿0bü\0ä;@§¶]L3)¿µ7¯\¬d;@í≤E\“n)¿\Ó#∑&\›;@Û\0˘ı)¿\ÿ-c};@Æ÷â\ÀÒ\Z)¿<p\œÛ;@A\ÿ)V\r\Z)¿\›Î§æ,;@U0*©)¿\ƒB≠i\ﬁ;@\≈»í9ñ)¿¥é™&à;@ˆ\ m˚)¿ö`8\◊0;@£>+)¿îÑD\⁄\∆;@(õr)¿\◊\‹\—ˇr	;@\'Öyè)¿•\‹}éè\n;@Ö—¨l)¿-\Íì\‹a;@øò-)¿\ﬂƒêúL;@Fè6é)¿&\Â`6\r;@Ç:\Â—ç)¿û`ˇun;@6Ø\Í¨)¿∂Ov3;@ï¨™ó)¿bÅØ\Ë\÷;@=⁄®N)¿ƒµ\⁄\√^;@ú˝År\€)¿xòˆ\Õ˝;@\ÃbbÛq\r)¿≥µæHh;@∑|$%\r)¿êÇßê+;@öû)¿\ƒ%«ù\“;@_yêû\")¿dZõ\∆ˆ;@7ﬂà\ÓY)¿\„ßqo~;@-&6\◊)¿˙\”Fu:;@ÆG\·z)¿ö{H¯\ﬁ;@”æπøz)¿ˇØ:r§;@˝Nìo)¿\ R\Î˝F;@!ÀÇâ?\n)¿ÙlV}Æ;@sd\Âó¡)¿ªù}\ÂA;@Éˆ\Í\„°)¿#Ù3ı∫;@\«JÃ≥í)¿˘.•.;@Um7¡7)¿\À2êg;@\Ê=\Œ4)¿Ÿ¥R\‰;@X:û%\0)¿[\ÏˆYe;@5∏≠-<ˇ(¿∫jû#Ú;@∞´\…S˛(¿¡\ƒEù;@√õ5x_˝(¿⁄¨˙\\m;@\‘÷à`¸(¿\ﬁÑÄ;@µ©∫G6˜(¿.rOWw;@r¯§	ˆ(¿\÷TÖ];@è9\œÿóÙ(¿`;±O;@\\:\Ê<Û(¿\‹Ùg?R;@±\¬-IÒ(¿\œdT;@´	¢\Ó(¿7®˝\÷N;@¡X\ﬂ¿\‰\Ó(¿\÷\‡}U.;@G¢`\∆\Ï(¿º}\È\Ì;@≈´¨m\Í(¿=ö\Í\…¸;@bÛqm®\Ë(¿qs*;@&®\·[X\Á(¿>\Õ…ã;@|Ä\ÓÀô\Â(¿\Õ\Ã\Ã\Ã\Ã;@´$≤≤\‰(¿é ;@>	l\Œ¡\„(¿ºËæú;@ál ]l\‚(¿\Z2•;@\ﬁ\‰∑\Ëd\·(¿∞ Ö ø;@®\‚\∆-\Ê\ﬂ(¿ä\ÀÒ\nD;@\œ˘.•\ﬁ(¿îÑD\⁄\∆;@\“7i\Z\›(¿\„4ÙO;@≥$@M-\€(¿â\”I∂∫;@GˇÀµh\Ÿ(¿W\nÅ\\\‚;@+ï\‘	\ÿ(¿(\r5\n;@)\ﬂ\ﬁ\’(¿;˚ ÉÙ;@~p>u\‘(¿Ω¶•;@E\Ÿ[\ ˘\“(¿\nÜs\r3;@‘∑\Ã\È≤\–(¿@á˘Ú;@DO §Ü\Œ(¿âõS\…\0;@mW\ËÉe\Ã(¿:vPâ;@^ë\ (¿K¨åF>;@êÑ};\…(¿∂Ä\–z¯;@KXc\«(¿”ÉÇR¥;@#K\ÊX\ﬁ\≈(¿RôbÇ;@\"6X8I\√(¿\‡°(\–\';@Æ~lí¡(¿ÄÚw\Ô®;@\'¢_[ø(¿)H4;@ì©ÇQIΩ(¿\¬˚™\\®;@33333ª(¿\'æ\⁄Q;@Ù˙ì¯‹π(¿\–\Ô˚;@IüV—∑(¿ï\÷\ﬂÄ;@î˚äµ(¿x\’\Ê!;@ß>êº≥(¿$ô\’;\‹;@ÊØêπ≤(¿œÖë^\‘;@x\’\Ê!´(¿\‚ëxy;@ø∆àD±(¿oÿ∂(≥1;@¢|A	∞(¿J\rm\068;@†˚rf≥(¿\‰Ωje\¬?;@ß\È≥Æ≥(¿o∑$\ÏB;@\ﬂ\›\ ùµ(¿\ÊCVD;@\‡\ŸΩ\·∂(¿ÉæÙˆ\ÁF;@˝\›;jL∏(¿@0Gè\ﬂG;@kÙjÄ“∏(¿=Fy\Ê\ÂH;@{Cr2π(¿S±1Ø#J;@	\ƒ\Î˙ª(¿\Ÿ\Ã!©ÖJ;@˘\Ÿ\»uS∫(¿DkEõK;@≠¡˚™\\∏(¿J\Îo	¿K;@]P\ﬂ2∑(¿oùª\ÏK;@∏Æò∂(¿¿œ∏p L;@Mæ\Ÿ\Ê∆¥(¿\„4ÙOL;@0Å[w≥(¿ 	˚vM;@ Fè6Æ(¿\¬ª}VM;@:ï\0U¨(¿9)\Ã{úM;@&P6\Â™(¿dø\r1N;@ä\ÈB¨˛®(¿W\ÓfÖN;@˝£o\“4®(¿ö≤\”V;@\Î\Z-z†(¿0+\È~Z;@a\\:\Ê§(¿rådèP[;@Mg\'É£§(¿5Lk\”\\;@+ï\‘	ò(¿h≤ûd;@kGqé:í(¿$ò¿≠k;@\‰.\¬Ö(¿ì7¿\Ãwl;@©°\r¿Ñ(¿@3à\Ïl;@ú˚´\«}É(¿ì\05µlm;@•†\€K\ZÉ(¿“®¿\…n;@◊â\ÀÒ\nÑ(¿<p\œÛo;@2\ 3/áÖ(¿+Pã¡\√p;@\À-≠ÜƒÖ(¿êO\»\Œ\€p;@Nú\‹\ÔPÑ(¿Æ†iâïq;@QfÉL2Ç(¿8hØ>r;@qTn¢ñ~(¿l$	\¬t;@ö@ã~(¿W≥\Œ¯æt;@\r5\nIf}(¿ÉﬂÜØu;@\–^}<Ù}(¿\€ikD0v;@¨s\»^(¿MÙ˘(#v;@\"óéÅ(¿{Ö˜v;@[A\”É(¿h\Ê\…5v;@ï\÷ˇ9Ñ(¿Tn¢ñ\Êv;@\€P1\ŒﬂÑ(¿Émƒì\›x;@J∑%r¡Å(¿˘ÑÏºçy;@0Û¸ƒÅ(¿˜>UÖz;@zâ±LøÑ(¿Ö|–≥Yy;@É¬†L£â(¿~\Z˜\Ê7x;@ |(â(¿,e\‚Xw;@i¢ä(¿5Sv;@\“\¬e6ã(¿¢≤aMeu;@\ﬁ	äã(¿Ù\ƒs∂Ät;@†§¿òä(¿\Ê»≥s;@`∞∂-ä(¿ïÓÆ≥!s;@F≤G®ä(¿v\„›ë±r;@¨X¸¶∞ä(¿B\ÏL°Ûr;@æ˙xËªã(¿¢C\‡Ht;@H¬æùå(¿E\ÿÙJu;@ôùE\Ôå(¿@âœù`w;@^\’Y-∞è(¿.W?6\…w;@-Ø\\oõë(¿ìˇ\…ﬂΩw;@é={.Sì(¿Aü»ì§w;@\‰ı`R|î(¿hzâ±Lw;@¿\Ãwó(¿QL\ﬁ\03w;@\’[[%ò(¿–∏p $w;@\⁄SrN\Ïô(¿¢\Î\¬\Œw;@q©;ö(¿Ùßç\Ítx;@\ÌFÛô(¿’Æ	içy;@}?q\0ï(¿¡Uû@\ÿy;@R<æΩì(¿\Œ¡3°Iz;@€à\'ªë(¿Qª_¯z;@≤\‘zø—é(¿ﬂà\ÓY\◊|;@Pß<∫é(¿y<-?p};@F\Í=ï”é(¿É›∞mQ~;@¥:9Cqè(¿`±Üã\‹;@\√ABîè(¿Ú≥ëÎ¶Ä;@\ﬂ6S!ë(¿\Õ >∞\„;@§ã¶ì(¿GW#;@§âwÄ\'ï(¿áâ)x~;@\◊¿V	ó(¿\·Câñ<~;@m¨\ƒ<+ô(¿∞\Ê\0¡};@£\Á∫ö(¿{°Ä\Ì`|;@≥q¨ãõ(¿!Øì\‚{;@õèkCù(¿¯Ñ|;@/á\›wü(¿|\Ôo\–^};@î0\”ˆü(¿¶F\Ëg\Í};@\›\\¸mO†(¿ú¶\œ∏~;@Å0e\‡†(¿Xrã;@∂Ω›í†(¿D3OÆ)Ä;@3\≈ù(¿£í:Å;@.q\‰Å»ö(¿MÙ˘(#Ç;@¢`\∆¨ô(¿öœπ\€ıÇ;@ZΩ\√\Ì–ò(¿A.q‰ÅÑ;@\ÍØWXpó(¿~©ü7Ö;@?q\0˝ñ(¿',1607362055,1607362055,NULL,NULL),(3,'Eastern',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\0c\0\0h[\Õ:w@@v\‡ú•ï*¿N\’=≤πv@@\Ëyítï*¿á≈®k\Ìu@@\Œ\ZºØ ï*¿bMeQ\ÿu@@∂êˆ?ò*¿¸s\◊v@@¶öYKô*¿62;ãv@@c\Ô\≈\Ìô*¿∑)\’v@@7m\∆iàö*¿|+\‘v@@*\»\œFÆõ*¿\Ã\—\„˜v@@iUMù*¿\Ã∞èNw@@(FñÃ±ú*¿\Ÿ\\5\œw@@‘úº\»ú*¿ıª∞5[w@@´\\®¸k©*¿\Ívˆïw@@Æ÷â\ÀÒ™*¿à\rN\“v@@\›\ÔP\Ë´*¿S#Ù3ıv@@B\Ó\"LQÆ*¿\\«∏\‚\‚v@@Nd\ÊóØ*¿\÷a∞v@@x\Ïg±±*¿ˆõâ\ÈBv@@Ú?˘ªw¥*¿êKy v@@W[±ø\Ï∂*¿MÙ˘(#v@@˝/◊¢∏*¿\≈\„¢ZDv@@~p>u¨∫*¿\r\·òeOv@@_\rP\Zjº*¿\‹ı\“v@@UàG\‚\Â¡*¿_%ªv@@d±M*\Z\√*¿wj.7v@@ï\‘	h\"\ƒ*¿∂J∞8v@@®ä©Ù\∆*¿\ÊtYLlv@@<æΩk\–\«*¿F`¨o`v@@év\‹ª\…*¿¯k≤F=v@@\‡\◊HÑ\À*¿@l\È\—Tu@@´Aò€Ω\Ã*¿T9\Ì)9u@@\·`obH\Œ*¿∞71$\'u@@Xo\‘\n\”\œ*¿R\Ó>\«Gu@@G>Øx\Í\—*¿ˇ$>wÇu@@ùe°\ÿ\“*¿ü\À\‘$xu@@mt\ŒOq\‘*¿p|\Ìô%u@@∞∂-\ \‘*¿\”€üãÜt@@ˇ@πm\ﬂ\”*¿\ lêIFt@@sú€Ñ{\’*¿â&P\ƒ\"t@@\√b‘µˆ\÷*¿u\»\Õpt@@êÑ};â\ÿ*¿Z5\—\Ás@@\∆\› Z+\⁄*¿tïÓÆ≥s@@ùIõ™{\‹*¿õv1\Õts@@\Ã(ñ[Z\›*¿[”º\„s@@S±1Ø#\ﬁ*¿4\◊i§•r@@2\„m•\◊\ﬁ*¿~\Z˜\Ê7r@@∏u7\ﬂ*¿´ñtîÉq@@$Cé≠g\‡*¿vOjq@@*;˝†.\‚*¿`>Y1\\q@@#Û\»\‰*¿>\Án\◊Kq@@ñy´ÆC\Â*¿Å>ë\'Iq@@…éç@º\Ê*¿b\⁄7˜Wq@@ú3¢¥7\Ë*¿+Ω6+q@@Ù›≠,\—\È*¿!\"5\Ìbp@@ÛW\»\Ï*¿\≈;¿ìp@@\Œ˝\’\„æ\Ì*¿tDæK©o@@k\œK\≈\Ó*¿MÑ\rOo@@≥	0,\Ô*¿ãRB∞™n@@˚På\Ï*¿	Únn@@˜\À\'+Ü\Î*¿Ñ*5{†m@@\'•†\€K\Í*¿í\ÕUÛm@@\\¨®¡4\Ï*¿lìä\∆\⁄k@@*\‚tí≠˛*¿mV}Æ∂l@@;:ÆFv+¿\Í∞\¬-i@@\‡ÄñÆ`+¿,Ú\Îá\ÿh@@åÖ!r˙+¿V\ÿpAh@@î\€ˆ=+¿\€j\÷\ﬂg@@¿îÅZ+¿Äa˘Ûmg@@u\"¡T3+¿\‰K®\‡f@@≠˘Òó+¿∫h\»xîf@@&¨ç±+¿\‚x>\Íe@@‰†Ñô∂+¿õpØ\Ã[e@@Z’íér+¿ñ]0∏\Êd@@,†PO+¿àg	2d@@: 	˚v\Z+¿ª{Ä\Ó\Àc@@É¢y\0ã+¿h\"lxzc@@\Ê\ËÒ+¿M†àEc@@eÆπ+¿d\\qqTb@@1Xr+¿i\Z\Õb@@DR%ì+¿AG´Z\“a@@˛πh\»x+¿\ﬁXPîa@@ïfÛ8+¿\∆M\r4üa@@(\‘\”G\‡+¿âu™|a@@ˆ&Ü\‰d\"+¿\ÂDª\n)a@@Û¸\ƒ$+¿\’B\…\‰\‘`@@πˇ\»t\Ë$+¿\nπRœÇ`@@¶)ú\ﬁ%+¿\r\·òeO`@@˝ù,µ&+¿J¥\‰_@@àÇS(+¿\‘)ènÑ_@@¨o`r£(+¿ˇ<\r$_@@v()∞(+¿5EÄ”ª^@@LˇíT¶(+¿°0(\”h^@@¨o`r£(+¿\Z\ƒv¸]@@ã6«πM(+¿j2\„m•]@@6Ø\Í¨(+¿2\√F]@@]â@ı\'+¿d\Ë\\@@}ï|\Ï.(+¿P®ßè\\@@™}:3(+¿LbıG\\@@,πä\≈\'+¿0g∂+Ù[@@°ù\”,\–&+¿≠2SZ[@@M†à%+¿\n\€O\∆¯Z@@\‹)¨ˇ#+¿9`WìßZ@@∞v\Á®#+¿∫Å\ÍZ@@\Œ\‡\Ô#+¿⁄•\ráY@@¶a¯àò\"+¿wJ\ÎˇX@@%ZÚx\"+¿9Cq«õX@@?nø|≤\"+¿+i\≈7X@@#°-\ÁR$+¿°ºè£9X@@\‚9[@h%+¿Iÿ∑ìX@@5\–|\Œ\›&+¿%vmo∑X@@D˘Ç(+¿\√*\ﬁ\»<X@@HõV\n)+¿fä≠†W@@\'æ\⁄Qú++¿Ä}t\Í\ W@@\r\„n≠-+¿ç$A∏X@@\”/où/+¿\'â%\Â\ÓW@@Mˆ\œ”Ä1+¿|Gç	1W@@\'.\«+5+¿Ö≤ıµV@@ÚA\œf\’7+¿~éègV@@\ \·ìN$8+¿-≥\≈VV@@˘IµO\«;+¿\Ã*l∏V@@«õ¸ù<+¿SîK\„X@@ˇX´v=+¿ˆöîX@@\ÕYürL>+¿\ﬂ7æˆ\ÃX@@\√-II?+¿h\Ã$\ÍY@@]ﬂáÉÑ@+¿\Ëkñ\ÀFY@@\"\08ˆ\ÏA+¿Ä∏´WëY@@3ß\ÀbbC+¿ÑıÛY@@0du´\ÁD+¿bi\‡G5Z@@\‚\ÁøØE+¿G\ Iª[@@ÈπÖÆDH+¿7©h¨˝[@@&\0ˇî*I+¿G…´s\\@@G\Â&jI+¿Û>é\Ê\»\\@@\ÏPMI\÷I+¿\÷o&¶]@@N∑\ÏˇH+¿8”ÖX]@@äM†H+¿]\·].\‚]@@KxBØ?I+¿I*S\ÃA^@@vå+.éJ+¿.T˛µº^@@vp∞71L+¿˙œö_@@òi˚WVJ+¿Ø`Òd_@@\ÎrJ@LJ+¿˜â\Ì\Ó_@@àÙ\€◊ÅK+¿\"3∏<`@@Q29µ3L+¿ã¡√¥o`@@SØ[\∆J+¿¿YJñì`@@æhè\“I+¿Ks+Ñ\’`@@¢|A	H+¿qvkôa@@≤+-#ıF+¿\Ê=\Œ4aa@@\Ê\À∞èF+¿†\·\Õ\Zºa@@\‡º8Ò\’F+¿pñí\Â$b@@\Ìˇ∞•G+¿\0VGétb@@ú3¢¥7H+¿§∆ÑòKd@@VÑa¿J+¿≥±Û¨d@@n\ﬁ8)\ÃK+¿ˆ∂ô\nÒd@@<\ŸÕå~L+¿Ÿïñëze@@8ÇTäM+¿Ù©cï\“e@@o≠mN+¿gaO;¸e@@J\Îo	¿O+¿ëD/£Xf@@%≥zá\€Q+¿¢$$\“6f@@m\ \ﬁ\ÂR+¿ñŒág	f@@,∫ıöT+¿ôd\‰,\Ïe@@\‰Ç3¯˚U+¿ñCãl\Áe@@$Åõ:W+¿èå\’\Êˇe@@sd\Âó¡X+¿çA\'Ñf@@ÇÑ%Z+¿0fKVEf@@4øö[+¿qé::Æf@@§SW>\À[+¿\\\„3\Ÿ?g@@]•ª\Î\\+¿‰ÉûÕ™g@@ùª\Ï\◊]+¿îOèmh@@Äª\Ï◊ù^+¿ïÇn/ih@@pA∂,__+¿\Ìª\"¯\ﬂh@@\›\na5ñ`+¿\ÿ.m8,i@@\Ÿ\\5\œa+¿\∆0\'hìi@@\÷ˆBc+¿˛Äj@@åªA¥Vd+¿∫Ü\ZOj@@\‹dT\∆e+¿â|óRój@@*sÛç\Ëf+¿S\Ëº\∆.k@@¢|A	h+¿ å∑ï^k@@¡˛\Î‹¥i+¿C;ßY†k@@\‹,^,l+¿}\Á%\Ëk@@\ﬂjù∏o+¿N\“¸1≠k@@\nıÙp+¿vâÍ≠Åk@@gò\⁄Rq+¿ÄJï(k@@P6\Â\n\Ôr+¿ä;\ﬁ\‰∑j@@∑\”÷à`t+¿RH2´wj@@,\Ô™\Ãs+¿í!\«\÷3j@@ÚöWuVs+¿qπ5\Èh@@á¶\ÏÙÉr+¿ææ÷•h@@£h[\Õr+¿U\ŸYh@@.v˚¨2s+¿|πOéh@@\ÃDR∑s+¿\ÿÛ5\Àeg@@Ûç\Ëûuu+¿q\‰Å\»\"g@@•Ω¡v+¿ÆúΩ3\⁄f@@O=\“\‡v+¿kcÏÑóf@@P9&ã˚w+¿∏Ö\ÎQf@@ˇÇ\0z+¿±nº;2f@@˝«ÅW{+¿\ﬁ\À}rf@@ó\„àû|+¿€áº\Â\Íe@@∫\Ïø\Œ}+¿O#-ï∑e@@∂j◊Ñ¥~+¿íìâ[e@@bèo+¿\»^\Ô˛d@@ÑÇR¥r+¿çôDΩd@@NM\”g+¿a\›xwdd@@eçzàF+¿\œ1 {Ωc@@LQ.ç_Ä+¿!âóßc@@\Ã\œ\rMŸÅ+¿±i•\»c@@\ndvΩÉ+¿\‘)ènÑc@@ùπáÑ\ÔÖ+¿1?74ec@@.t%’á+¿s\◊ÚAc@@å5òÜâ+¿~åπk	c@@r\Ã_!ã+¿Ù˝\‘x\Èb@@Wµ§£å+¿\«ÚÆz¿b@@\Ë\ﬁ\√%«ç+¿ç(\Ì\ræb@@\Í\nºìè+¿e6\»$c@@DP5z5ê+¿_ïïc@@æ˜7ê+¿ {Ω˚\„c@@q8Û´9ê+¿çG©Ñ\'d@@\„¸Mê+¿\‰ı`R|d@@ë\÷tBê+¿p∞71$e@@q8Û´9ê+¿Ù¡26te@@\‰-W?6ë+¿?\ZNôõe@@yë	¯5í+¿ ®2åªe@@U2\0Tqì+¿}\Ãf@@ã˙$wÿî+¿ë\ncAf@@´±Ñµ1ñ+¿BáDf@@ùFZ*oó+¿àªzg@@íZ(ôúö+¿ˆz˜\«{g@@3Mg\'õ+¿i8enæg@@ü[\ËJö+¿h[\Õ:\„g@@ÆHLP√ó+¿4ºYÉ˜g@@≥öÆ\'∫ñ+¿¡˝Äh@@\À\÷˙\"°ï+¿h\œejh@@\Œ«µ°bî+¿¨\Â\ŒL0h@@\È_í\ ì+¿\r8K\…rh@@0ôÚë+¿Uø\“˘h@@cµ˘’ë+¿+Nµfi@@µl≠/í+¿=∑–ïj@@Y\€èãí+¿Ù\ƒs∂Äj@@l>Æ\rì+¿óëzO\Âj@@ú\ﬁ\≈˚qì+¿\–CmFk@@°IbIπì+¿[\'.\«+l@@\"R\”.ñ+¿1öï\ÌCl@@¬Ñ—¨ló+¿CT\·\œl@@Qˆñræò+¿é ïbm@@°ıe¢ò+¿±ã¢>n@@\„k\œ,	ò+¿8˘-:Yn@@nã2dö+¿a˙^Cpn@@+3•ı∑ú+¿ìS;\√\‘n@@\·\riT\‡ú+¿sL˜o@@∞˛\œaæú+¿â@£to@@\‰/-Íìú+¿T\Z1≥\œo@@ú1\Ã	⁄ú+¿\Ã\ÎàC6p@@ä\"nNù+¿\Ó<0Äp@@ \“o_û+¿N} y\Áp@@,ÒÄ≤)ü+¿G:#/q@@?˝gÕèü+¿\∆M\r4üq@@\Ê\À∞ü+¿œºv\ﬂq@@\…U,~S†+¿\ÊÆÚr@@Æ\ÎçZ°+¿†àE;r@@-µ\ﬁo¥£+¿\«,{\ÿr@@.¨Ôé§+¿	äc\Ór@@˚Y,EÚ•+¿[∞Tr@@€áº\Â\Íß+¿nâ\\ps@@©˚\0§6©+¿∑ñ\…p<s@@t\–%z´+¿¢~∂fs@@ˇ^\nö≠+¿â\\ps@@\Ë†K8ÙÆ+¿PQı+ùs@@k:!t∞+¿6\Õ;N\—s@@l@Ñ∏≤+¿rßt∞˛s@@ïF\Ã\Ï≥+¿¬•c\Œ3t@@G\r6µ+¿\€¿®St@@œΩáK∂+¿\ﬁ\ﬂ4}t@@Å≤)Wx∑+¿ÜéT\‚t@@\Ã_!se∏+¿Ω âvu@@≥≥\Ëù\n∏+¿\Èûuçñu@@øÄ^∏sπ+¿¢|A	v@@§R\Ïhº+¿®m\√(v@@\‚\ÁøØΩ+¿\Âµ∫Kv@@î\€ˆ=\Íø+¿á\¬g\Î\‡v@@w\◊Ÿêæ+¿¯¨8w@@EùπáÑø+¿\ËL\⁄Tw@@íÒ+\÷¿+¿\‹\r¢µ¢w@@ÙÜ˚»≠¡+¿á3øöx@@F\Ï@1\¬+¿P®ßèx@@\Ê\ŒL0ú\√+¿díë≥x@@3QÑ\‘\Ì\ƒ+¿e73˙\—x@@ƒóâ\"§\∆+¿9Ò’é\‚x@@î2©°\r\»+¿¬¢\"N\'y@@9µ3Lm\…+¿%\ÀI(}y@@\‰∫)\Âµ\ +¿Ot]¯¡y@@Ω\≈\√{\Ã+¿\Ïm3\‚y@@µ®Orá\Õ+¿z©ÿò\◊y@@~\0Rõ8\—+¿Ø%‰Éûy@@\n◊£p=\“+¿‘Å¨ßVy@@çôDΩ\‡\”+¿h@Ω5y@@O\Í\À\“N\’+¿ñ\"˘J y@@ı\◊+,\ÿ+¿õé\0ny@@\Ã}r \⁄+¿û	My@@ ]lZ)\‹+¿\‚\\\√çy@@C\≈8\‚+¿ò\ÀÙKz@@b.\‰\·+¿º>s÷ßz@@ 	˚v\·+¿¿í´X¸z@@k) \Ì\‡+¿ùª]/M{@@OqN\‡+¿(}!\‰º{@@O≠æ∫*\‡+¿•¿ò2|@@t\ŒOq\‡+¿\ÈC‘∑|@@\'\€¿\‡+¿:vP}@@Ø]\⁄p\‡+¿$a\ﬂN\"~@@≤πjû#\‚+¿K#fˆy~@@\Ôˇ\„Ñ	\„+¿sÅ\Àc\Õ~@@OG…´\„+¿®\‰ú\ÿC@@÷´\»\ËÄ\‰+¿´\Ì&¯¶@@!ÙlV\Â+¿&¶±˙@@j\ﬂ\‹_=\Ê+¿û	MKÄ@@âBÀ∫\Á+¿ c\ÓZBÄ@@\≈9\Í\Ë\Ë+¿¬¶Œ£\‚@@*çò\Ÿ\Á\È+¿jm\Z\€k@@\÷pë{∫\Í+¿Æg\«,@@náÜ≈®\Î+¿\“7i\Z@@G´Z\“Q\Ó+¿\ƒxÕ´:@@è~7\›Ú+¿\·@H0@@ˆ\'ÒπÙ+¿\‹ID¯@@ú6\„4Dı+¿˚@ÚŒ°~@@©˚\0§6˘+¿µ\¬ÙΩ~@@\€P1\Œ\ﬂ¸+¿ıHÉ\€\⁄~@@\r6uˇ+¿4π\Î~@@\Ô%\0,¿ä\"nN@@{fIÄö,¿¿z‹∑Z@@Ø∞\‡~¿,¿\≈q\‡\’r@@\r˚=±N,¿\√Œßé@@)[$\Ì,¿î.´∞@@Óµ†˜\∆,¿Gx$Ä@@x\'ü,¿RH2´wÄ@@x`\0\·,¿D•3˚Ä@@\œk\Ï\’,¿+˜≥BÅ@@Ãõ√µ\⁄,¿¥V¥9ŒÅ@@Pâ\ÎW,¿¶^∑Ç@@€ß\„1\r,¿\"˛aKèÇ@@\Ÿ!˛aK,¿\ËO\’\ÈÇ@@)?©ˆ,¿2´w∏Ñ@@E|,¿\ÎUdt@Ñ@@˙œö,¿\0≠˘ÒóÑ@@Çj\€0\Z,¿8ˆ\ÏπLÖ@@n\‹b~n,¿Ou\»\ÕpÖ@@p\ÍîG,¿à\ÿ“£Ö@@0Å[wÛ,¿äSÕ¨Ö@@e4Úy\≈,¿gÛ8\ÊÖ@@=∂e¿Y,¿~¨\‡∑!Ü@@)\Õ\Ê,¿$Ú]J]Ü@@˛HV,¿~SX©†Ü@@ì´X¸¶,¿Ö\Õ\0dá@@ü\Ã?˙&\r,¿\’ºÃ∞á@@\0\„4,¿\⁄YÙNà@@{k`´,¿r¶	\€Oà@@EΩåb	,¿p\n+Tà@@¡™z˘ù,¿≥aMeQà@@\◊h9\–C,¿i\»xîJà@@≠2SZ,¿µ˝++Mà@@\‰J=B,¿Gqé::à@@#K\ÊX˛+¿Iˆ5Cà@@-\Â}˝+¿0\‘aÖ[à@@+£ë\œ˚+¿E\Ÿ[\ ˘à@@gb∫´˜+¿jı\’UÅä@@$\n-\Î˛Ò+¿¨ë]iã@@%\Ë/Ù+¿ |(—íã@@\–dˇ<\r+¿íñ\ \€å@@L\·A≥\Î\Ó+¿W\ÓfÖå@@Ü9Aõ\Ó+¿p}Xo‘å@@hñ®©\Ì+¿ìp!ç@@®´;\€\Ï+¿@7nç@@∏u\ \Î+¿£\'\€¿ç@@7+1\œ\Í+¿Ûê)é@@°ü©\◊-\Í+¿v5y\ jé@@Ü4*p\Í+¿\‚X∑—é@@\€O\∆¯0\Î+¿\€O\∆¯0è@@!\È\”*˙\Î+¿∞píÊèè@@âˇ\"h\Ï+¿z©ÿò◊è@@÷é\‚u\Ï+¿\Ì\‘\\n0ê@@¯•~\ﬁT\Ï+¿±mQfÉê@@\\r\‹)\Ï+¿Ù\ZªDıê@@˜\Ë\r˜ë\Î+¿\Ïø\ŒMë@@ïdéÆ\Í+¿µãi¶{ë@@JÒÒ	\Ÿ\È+¿Y˚;€£ë@@C=}˛\Ë+¿ß]L3›ë@@dX\≈ô\Á+¿r¯§	í@@æΩk–ó\Ê+¿Ç;Pß<í@@˘d\≈p\Â+¿u/3lí@@¸\‰(@\‰+¿\'ıeißí@@bø\'÷©\‚+¿≠Q\—\Ëí@@\r34û\‚+¿ˇ∞•Gì@@§å∏\04\‚+¿QJV’ì@@PS\À\÷˙\‚+¿F\œ-t%î@@\Í\œ~§à\‰+¿1Bx¥qî@@èR	O\Ë\Â+¿G\Ã\ÏÛï@@\ŒUÛë\Á+¿ª*Pã¡ï@@]N	àI\Ë+¿Ox	N}ñ@@\rlï`q\Ë+¿U3k) ó@@ıd˛\—7\È+¿»∂8Kó@@Fx{\Í+¿sÙ¯Ωó@@ëô\\\Î+¿\ﬁs`9Bò@@?åm\Ï+¿◊•F\Ëgò@@\ƒ\È$[]\Ó+¿d\Ámlvò@@0ôÚ!+¿Ñ4fò@@\‡ÑBÚ+¿\Z˝h8eò@@ˇ@πm\ﬂÛ+¿˛\nô+Éò@@Œ¶#Äõı+¿›ï]0∏ò@@Z+\⁄\Áˆ+¿t\“˚\∆◊ò@@ñvj.7¯+¿}Xo\‘\nô@@öôôôô˘+¿\‘\“\‹\naô@@R\÷o&¶˚+¿ÜØØu©ô@@\rR¸+¿∏#úºö@@O[#Çq\0,¿g{ÙÜ˚ö@@.ë\Œ\‡ˇ+¿8h∞õ@@	R)v4˛+¿^ª¥\·ú@@5∑BXç˝+¿\√~O¨Sù@@¸˝b∂d˝+¿$∂ªû@@]\≈\‚7Ö˝+¿Ø¥å\‘{û@@e\∆\€JØ˝+¿Ú≤&¯û@@i\⁄V≥˛+¿\"\‡™î@@r\ﬂjù∏,¿;˝†.RÇ@@\—öyr%,¿	¶öY}@@åÙz,,¿/˜\…QÄr@@˚Æ˛∑:,¿\0VGétb@@\'ü\€2P,¿C\«*q[@@˜≠÷â\ÀY,¿m˝ÙüW@@˛ûXß\ _,¿⁄´èáJ@@é\Î\ﬂıôs,¿\\ê-\À\◊9@@\◊ﬁß™–ê,¿ºìOèm9@@Yk(µë,¿˙\ÃYü6@@®\‰ú\ÿCì,¿\Ó\Ã√π,@@ò`ùö,¿ë9∂*@@N^Ùú,¿ïù~P\'@@ú¶\œ∏û,¿;¨p\ÀG @@¡kó6§,¿n4Ä∑@@@\÷o&¶±,¿=∑–ï@@≤LøDº\≈,¿8©0∂Ù?@£WîÜ\“,¿¯\ZÇ\„2\“?@\Ó\Ëπı,¿&S£Æ?@ë∑\\˝\ÿ-¿ájJ≤è?@®\‚\∆-\Ê\'-¿\”/où?@\›aôπ8-¿˝j\Ãm?@˝«ÅWC-¿˝à_±ÜW?@ó\∆/ºíL-¿UäçCE?@j\›µ\ﬂR-¿ñ^õçï$?@&Q/¯4g-¿Q€ÜQ?@\Êv/˜q-¿ÖD\⁄∆ü?@C\…\‰\‘\Œx-¿3OÆ)êı>@ãçyqÄ-¿W\nÅ\\\‚\Ã>@	8Ñ*5ì-¿°ÚØÂïØ>@Ç\0:v®-¿5^∫Ií>@ät?ß ø-¿ùÖ=\Ì{>@°û>\–-¿•á°\’\…a>@\Ó%ç\—:\Í-¿Ò\‘#\rn7>@#æ≥^¸-¿^¢zk`7>@cÄD(˙-¿2\√FY7>@\⁄∆ü®l¯-¿_\nö]7>@u\Õ\‰õmˆ-¿\0<¢Bu7>@\·”úº\»Ù-¿ıcì¸à7>@\Î∆ª#Û-¿\Õr\Ÿ\Ëú7>@BBî/hÒ-¿%z\≈r7>@\ﬁ:ˇv\Ÿ\Ô-¿T9\Ì)97>@™*4\À\Ó-¿2W\’6>@\—vL›ï\Ì-¿¸\„Ωje6>@1¨Z\Ï-¿7©h¨˝5>@\ﬂ˝Ò^µ\Í-¿Ä,Dá¿5>@Uø\“˘\Ë-¿ıi˝°5>@:Ø±KT\Á-¿oG8-x5>@Rêh\Â-¿˛HV5>@y¢\'e\‚-¿AIÅ05>@\ÃC¶|\‡-¿%A∏\n5>@;ç¥T\ﬁ\ﬁ-¿áNœª±4>@®\»!\‚\Ê\‹-¿}ï|\Ï.4>@\≈s∂Ä\–\⁄-¿‡¢ì•\÷3>@r•û\Ÿ-¿ÆÄ∏3>@}%êª\÷-¿J_9\Ô3>@m©Éº\‘-¿\À-≠Ü4>@ä\Ã\\\‡Ú\–-¿\"\√*\ﬁ\»4>@*ê\ŸYÙ\Œ-¿˛}∆Ö5>@Z∫Çm\Ã-¿÷år5>@8øa¢A\ -¿êÇßê+5>@r\‹)¨\«-¿Ü™òJ?5>@\‘\◊Û5\À\≈-¿)\–\'Ú$5>@ ©ùaj\√-¿\\sGˇ\À5>@S\ k%tø-¿´=\ÏÖ6>@F–∂öΩ-¿\—\À\ÿ\–5>@Nó\≈\ƒ\Êª-¿i˛ò÷¶5>@Ñπ\›\À}∫-¿k{°Ä5>@?\·\Ï\÷2π-¿ä9:Z5>@î2©°\r∏-¿õèkC5>@i\⁄V≥∂-¿\√DÉ<5>@|òΩl;µ-¿¯¨85>@∫û\Ë∫≥-¿ç\œdˇ<5>@∫q≤-¿ùÅëó55>@\ÿ*¡\‚∞-¿7âA`\Â4>@\·}U.TÆ-¿zlÀÄ≥4>@•æ,\Ì‘¨-¿J@L¬Ö4>@Ü∂É´-¿LQ.ç_4>@	Tˇ í©-¿Ö\\©gA4>@MøDºu¶-¿sI\’v4>@ëH\€¯•-¿|\—/§3>@∂◊Ç\ﬁ£-¿~Ωp\Á2>@\Èc> –°-¿Àüo2>@E/£Xn°-¿lMK¨0>@\œ¿\»Àö†-¿\Õ=$|\Ô/>@Q£êdVü-¿¸¸˜\‡µ/>@	§ƒÆ\Ìù-¿gE\‘Dü/>@åJ\Íú-¿àÄC®R/>@\rP\Zjö-¿\€\–w.>@*\∆˘õò-¿oÅ≈è->@œ¢w*\‡ñ-¿\∆\·ÃØ\Ê,>@∫/g∂+î-¿Ø$yÆ+>@\Â\≈oí-¿˘¯Ñ\Ïº)>@\…=]›±ê-¿»±ı\·(>@_D\€1uè-¿\'OYM\◊\'>@jøµç-¿\‚\‡I\'>@Lk\”\ÿ^ã-¿I\Ÿ\"i7&>@)\Õ\Êâ-¿FzQª_%>@\€j\÷ﬂá-¿q\ÊWsÄ$>@ª∑\"1AÖ-¿◊°öí¨#>@¡ˇV≤É-¿˚ñ9]#>@\‹Û¸i£Ç-¿-]¡6\">@Õê*äWÅ-¿ÆfùÒ}!>@uîÉ\ŸÄ-¿ã\›>´\Ã >@\Íy7~-¿gö∞˝d >@Äµj◊Ñ|-¿û≥Ñ\÷>@9∂û!{-¿2: 	˚>@ˆ\rLny-¿\⁄\≈4”Ω>@K\…rJw-¿é::ÆF>@0ûACˇt-¿Õ≠Vc>@-∞\«DJs-¿\ÿ“£©û>@bù*\ﬂ3r-¿aS\ÁQÒ>@ﬁí∞´q-¿|⁄•\r>@‘∑\Ã\È≤p-¿ü!≥\Ï>@`\Ë£\Án-¿\'¢_[?>@ôõoD˜l-¿Tb.>@\\´=\ÏÖj-¿öœπ\€ı>@Ù\Ô9h-¿•ÙL/1>@-≤ù\Ôg-¿¡ë@ÉM>@˛_u\‰Hg-¿ÿº™≥Z>@YiR\n∫e-¿ùæûØY>@@¡≈ä\Zd-¿pUjˆ>@Kí\Á˙>d-¿S8Ωã>@G:#/c-¿∞»Øb>@U¡®§N`-¿p\ÍîG>@\0VGét^-¿∑ñ\…p<>@]¿\À]-¿\›`®\√\n>@9|“â[-¿&jj\Ÿ>@\ÃoBX-¿]7•ºV>@\»(œºV-¿2sÅ\Àc\r>@X·ñè§T-¿9	•/Ñ>@b¿í´XT-¿\Ãa˜\√>@p]1#T-¿ë\'I\◊L\n>@`èâîfS-¿\“TO\Ê	>@åÙ¢vøR-¿L˙{)<>@QΩ5∞UR-¿\Ô\Á\‰g>@`ù∫ÚQ-¿\‡°(\–\'>@\Âb¨\„P-¿(\nÙâ<>@Æº\‰ÚO-¿$π¸áÙ>@êΩ\ﬁ˝ÒN-¿å≥óm>@G\Â&jiN-¿Jy≠Ñ\Ó>@Q.ç_xM-¿0.s>@¡R]¿\ÀL-¿\⁄SrN\Ï>@\Ó&¯¶\ÈK-¿¯ãŸíU>@&˝ΩL-¿\ËO=\“\0>@Ø@Ù§L-¿0Ieä9\0>@GM-¿ïú{hˇ=@\“\‚åaNH-¿+¡\‚p\Êˇ=@\"rlE-¿:Ø±K\0>@m\‚\‰~áB-¿|\‘_Ø∞\0>@\⁄∆ü®l@-¿|\‘_Ø∞\0>@˜∞\n\ÿ>-¿.¨\Ôé\0>@⁄•\rá=-¿:Ø±K\0>@\’#\rnk;-¿–ô¥©∫ˇ=@ï∂∏\∆g:-¿≤H\Ô\0ˇ=@Rêh:-¿xF[ïD˛=@\ÿI}Y\⁄9-¿\≈Sè4∏˝=@∫Û\ƒs∂8-¿v?T\Z˝=@;\·%85-¿Äùõ6\„¸=@$\÷\‚S\04-¿\’?àd¸=@ç$A∏2-¿Ñ\‰\Ÿ\Â˚=@˜rü0-¿î4Lk˚=@xADj\⁄--¿óVC\‚˚=@p\"˙µı+-¿˘Ùÿñ˚=@˝\\¨®)-¿\’]\ŸÉ˚=@Eπ4~\·%-¿\Ì)H¸=@ÚxZ~\‡\"-¿$\‘©¢¸=@ˆ%∂ -¿≥\Îﬁä\ƒ¸=@\ﬂR\Œ{-¿UÖb\Ÿ¸=@kÒ)\0\∆-¿ÀÜ5ïE˝=@ß\ÏÙÉ∫-¿h\Œ˙îc˛=@˘ø#*T-¿LKˇ=@\‚\0˙}ˇ-¿+¡\‚p\Êˇ=@i™\'Ûè-¿:Ø±K\0>@ñ\ÀF\Á¸-¿:Ø±K\0>@*1	-¿\«kÒ)\0>@!Æú\r-¿+¡\‚p\Êˇ=@¿îÅ-¿Ov3£ˇ=@r˙zæf	-¿˘ıC\0>@ˇ\œaæº-¿Û\Êp≠ˆ\0>@˝/◊¢-¿\„˝∏˝Ú>@m\Z\€kA-¿:wª^ö>@XVöîÇ-¿±˝då>@1[≤*\¬-¿\‹eø\Ót>@;R}\Á-¿\–Gq>@\…;á2-¿tLhí>@JñìP˙-¿áS\Ê\Ê>@®\„1ï-¿[(ôú\⁄>@z\ƒËπÖ˛,¿\\ê-\À\◊>@äri¸\¬˚,¿™Ù\Œn>@¢ÒD\Á˘,¿\Z•Kˇí>@S\ÁQÒ˜,¿Zfä≠>@N{JŒâı,¿K\ \›\Á¯>@\\[%XÙ,¿ª∑\"1A>@¶∏™\ÏªÚ,¿|c\0é>@∆ß\0\œ,¿\“Ry;\¬>@Å	‹∫õ\Ô,¿\ÈIô\‘\–>@˙π°);\Ì,¿\ZPoF\Õ>@\≈\0â&P\Ï,¿mt\ŒOq>@\‹ÚëîÙ\Ë,¿P˝ÉHÜ>@˝à_±Ü\„,¿ß\ÏÙÉ∫>@êgs\‚,¿G	>@å\÷Q\’\·,¿ûóäç	>@æ˜7hØ\ﬁ,¿m\‚\‰~á\n>@ú•d9	\›,¿]˘,œÉ>@\Án\◊KS\‹,¿≠\‹\Ã\n\r>@é\Î\ﬂıô\€,¿jN^d>@ëGp#e\€,¿¨X¸¶∞>@<Ü\«~\€,¿v\ƒ!H>@\‚vhXå\⁄,¿±˘∏6T>@}Àú.ã\Ÿ,¿∂ilØ>@∑\nb†k\◊,¿åm>@F\”\Ÿ\…\‡\–,¿=1X>@YLl>Æ\Õ,¿/6≠>@ˆ\n\Ó\Ã,¿Y1\\\0>@\Œ{/æ\»,¿\n\Ÿyõ>@a¸4\∆,¿7©h¨˝>@¢búø	\≈,¿\‹Û¸i£>@MÉ¢y\0\√,¿Rd≠°\‘>@&W±¯M¡,¿\∆M\r4ü>@\ﬂ\≈˚q˚Ω,¿¿YJñì>@,∂IEcΩ,¿á£´tw>@O\Õ\ÂCΩ,¿\\\Á\ﬂ.˚>@0ª\'Ω,¿˚ñ9]>@èQûy9º,¿\Ë\ÿA%Æ>@\Ã\–x\"àª,¿\Ìù\—V%>@î£\0Q0ª,¿[]N	à>@ç*√∏º,¿ó«öëA\Z>@(N>=æ,¿§ä\‚U\÷\Z>@ä\Ë\◊\÷Oø,¿f\ÿÒ>@*¨ˇs¿,¿∂É˚>@\¬\‹\Ó\Â>¡,¿ux\„ß>@Ú∂\“k≥¡,¿\ O™}:>@3\√FYø¡,¿^K\»=>@\“o_\Œ¡,¿\¬¯i\‹>@ıG,¡,¿©lXSY >@*¨ˇs¿,¿\\>íí\">@\⁄8b->Ω,¿\Ê\ÿGß\">@P√∑∞nº,¿\Ê\Ê\—=#>@v§˙\Œ/∫,¿ˇíT¶ò#>@èlÆö\Á∏,¿ˆ≥Xä\‰#>@g≠á∑,¿sÇ69$>@êÑµ,¿\Ô∆Ç¬†$>@Wìß¨¶≥,¿≠3æ/.%>@Òú˙@≤,¿éÆ\“\›%>@m˙≥±,¿åâB\À&>@ÄÒ\Z˙Ø,¿l\œ,	P\'>@\Ë\⁄\–Ø,¿Z)râ\'>@\√DÉ<≠,¿∏Ku\'>@n0\‘aÖ´,¿\\!¨\∆&>@kÙjÄ“®,¿RÅìm\‡&>@\0ë~˚:®,¿˜\"⁄é©\'>@B“ßUÙß,¿Éà‘¥ã)>@˘IµO«£,¿\Ô¨\›v°)>@k\ÿ\Ôâu¢,¿yx\“\¬)>@Û\Êp≠ˆ†,¿µâì˚*>@\Á6\·^ôü,¿m\‚\‰~á*>@ÒÛﬂÉ◊û,¿\÷\≈m4Ä+>@j˜´\0ﬂù,¿~R\Ì\”Ò,>@\Án\◊KSú,¿∑≤Dgô->@\ÿ“£©ûî,¿:\Ê<c_.>@˘˜î,¿\È\”*˙C/>@q„äãì,¿î2©°\r0>@îi4πì,¿ó6ñ2>@ñ#d è,¿Pèmp2>@É›∞mQé,¿\∆G\Â2>@\råº¨âç,¿[¶}3>@\»a0Öå,¿øÛ\‚\ƒ3>@}> àã,¿\Ê\ËÒ3>@∏\nıÙâ,¿g`\‰eM4>@¿\"ø~à,¿\‹,^,5>@†3iSuá,¿\È\Ô•†5>@r\√\Ô¶[Ü,¿†‹∂\Ô5>@$F\œ-tÖ,¿1µ•Ú6>@\'JB\"mÉ,¿∑–ïT7>@iÇ,¿è™&à∫7>@\ ¿-]Å,¿\nJ\— Ω8>@ÖÏºç\Õ~,¿77¶\',9>@¿\ËÚ\Êp},¿\06 B\\9>@w†Ny|,¿£\»ZC©9>@û&3\ﬁVz,¿ã˝e˜\‰9>@g)YNBy,¿©˙ïŒá;>@L6l±s,¿~!<\⁄<>@ç“•Ir,¿K\‘‘≤=>@N\“¸q,¿õê\÷t>>@qxµ\‹q,¿\◊3\¬?>@\◊1Æ∏p,¿y7RB>@Á®£\„jl,¿KUøB>@T\Z1≥\œk,¿Û\»<C>@˙\–ı-k,¿-µ\ﬁo¥C>@VÑa¿j,¿\\…éç@D>@Z_&j,¿9\“E>@\ÃoBh,¿\"\ﬁ:ˇvE>@jMÛf,¿\"\∆k^\’E>@í?x\Óe,¿˘†g≥\ÍG>@zpw\÷nc,¿6#É\‹EH>@]â@ıb,¿4+€áºI>@Õèø¥®_,¿+°ª$\ŒJ>@\Ï¯/`,¿`î†ø\–K>@\«,{`,¿\“S\‰M>@nh\ N?`,¿\Í?k~¸M>@(Ç8\'`,¿<¿ì.O>@ó´õ\‰_,¿T\Â{F\"P>@$d \œ._,¿cAN>@øÄ^∏sQ,¿Ä\ràWN>@¥W}O,¿gE\‘DO>@÷çwGN,¿©/K;5O>@û\'û≥L,¿Éh≠hsH>@\”¿\Õ\‚5,¿¬•c\Œ3F>@6Y£¢1,¿\œ\ŸB\ÎA>@¸â Ü5-,¿∑&›ñ\»A>@\÷\‰)´\È*,¿\œMõq\Z:>@°h¿\"\',¿lw\–}9>@g∏ü&,¿3jæJ>6>@£t\È_í\",¿\·Çà\‘4>@t	á\ﬁ\‚!,¿U2\√2>@f°\ÿ\n\",¿\ÿc\"•1>@;¨p\ÀG\",¿\réíW\Á0>@$}ZE ,¿Y\"ßØ/>@2\0«û,¿LäèO\».>@`x%\…s,¿∂Ñ|–≥->@≈ë\"ã,¿¸Q‘ô{,>@πﬂ°(\–,¿zm6Vb*>@`=\Ó[≠,¿rÜ\‚é7)>@E\÷\ZJ\Ì\r,¿|)<hv)>@ö	Üs\r,¿Ç™—´)>@y?nø|,¿åÜåG©(>@	Qæ\0,¿iä\0ßw)>@¡\„€ª˝+¿ó8Ú@d)>@_9\Ôˇ˚+¿\ËL\⁄T)>@B\œf\’\Á˙+¿*rà∏9)>@\€èãj˘+¿ãnΩ¶)>@ª\Ó≠HL¯+¿Eøï\Ï(>@ã5\\\‰ûˆ+¿µpYÖ\Õ(>@W\Î\ƒ\Âxı+¿“âS\Õ(>@ëBY¯˙Ú+¿\Â_\À+\◊\'>@fOõs+¿$áüˇ&>@\⁄\ K˛\'\Ô+¿37ﬂà\Ó%>@(d\Áml\Ó+¿¶DΩå\">@\Ÿ?O\È+¿∑&›ñ\»!>@_∏sa§\Á+¿Û&\Z§ >@%±§\‹}\Ê+¿Ä\ÓÀô\Ì>@H¬æù\‰+¿}^Ò\‘#>@\∆QπâZ\‚+¿)ò1k>@=òü\‡+¿\"\«\÷3Ñ>@X®5\Õ;\ﬁ+¿%\Õ\”\⁄\‰>@H¯\ﬁﬂ†\›+¿–π\€ı\“\‰>@c}ì\€+¿⁄Æ\–\À\‰>@ıI\Ó∞\Ÿ+¿sıcì¸\‰>@YiR\n∫\’+¿∏ìà/\Ê>@ù:\Ë\“+¿˛\”\r\Ë>@$Cé≠g\–+¿|∑y\„\Ë>@´\ÎPMI\Œ+¿âbÚò\È>@®\‰ú\ÿC\À+¿\rU1ï~\Í>@\Â(@\Ã\»+¿Tq\„Û\Î>@Û;Mfº\≈+¿S$_	§\Ï>@ZGUD\≈+¿::Z\’\Ó>@û]æıa\≈+¿?\Âò,\Ó\Ô>@âœù`ˇ\≈+¿c)íØÚ>@á®¬ü\·\≈+¿$\’w~QÚ>@EΩ\‡”ú\ƒ+¿qê\ÂÚ>@x`\0\·C¡+¿àªzÒ>@7m\∆ià∫+¿ƒ¨CÒ>@=\“‡∂∂∏+¿ï\’t=\—Ò>@4ú27∑+¿\ÿıv\√Ú>@+Ü´ ∂+¿ÛtÆ(%Ù>@\‹ı\“∂+¿∑\Ì{\‘_˜>@-C\Î\‚∂+¿˘¿éˇ˘>@¡¸˝b∂+¿\ \¬\◊\◊˙>@Üì4L≥+¿ê˜™ï	˚>@∂gñ®±+¿ˇwDÖ\Í˙>@\‹/ü¨Æ+¿\Ô∫/g˙>@\Àd8ûœ®+¿çA\'Ñ˙>@Çr€æG•+¿vq\r\‡˘>@h[\Õ:£+¿0Û¸\ƒ˘>@+˜≥B°+¿öœπ\€˘>@ß…å∑ïû+¿\ÁoB!˙>@\Ïá\ÿ`\·ú+¿\⁄XâyV˙>@4\◊i§•ö+¿∑–ïT˚>@#Mº<ô+¿Û«¥6ç˝>@¿<d áò+¿eã§\›\Ëˇ>@8°áò+¿\Ÿ\Èuë?@KVE∏…ò+¿jâï\—\»?@≈é∆°~ó+¿˝,ú?@\Áå(\Ì\rñ+¿∑òü?@\ŸzÜpÃí+¿Ωè£9≤?@P\„\ﬁ¸Üë+¿˛ûXß\ ?@_\\™\“è+¿C=}˛?@r¬Ñ—¨å+¿1%í\Ë	?@•Éıã+¿!Êí™\Ì\n?@´≥Z`èâ+¿&\0ˇî*\r?@Ø}Ωpá+¿Ù¶\"\∆?@9^Å\ËIâ+¿πˇ\»t\Ë?@ºêaå+¿\Î\0àªz?@ü\È%\∆2ç+¿W$&®\·?@r¡¸˝ä+¿\—]gE?@K!êKâ+¿&TpxA?@.åÙ¢vá+¿IIC´?@xz•,CÑ+¿ú˙@Ú?@Iÿ∑ìàÄ+¿ëdV\Ôp?@3˚<Fy~+¿\‰J=B?@)^emS|+¿-x\—Wê?@?ã•Hæz+¿å\⁄˝*¿?@\Ô8EGry+¿PR`L?@˚±I~\ƒw+¿Q¿v0b?@)Zπòu+¿˚≠ù(	?@\÷\‡}U.t+¿˚\Í™@-?@\÷ˆBs+¿D?ç{?@aO;¸5q+¿gÒbaà ?@Y¿n\›m+¿&åfe˚ ?@¶a¯àòj+¿\«\røõn!?@ÑIÒÒ	i+¿<k∑]h\"?@y\Î¸\€eg+¿(+Ü´$?@›ô	Üse+¿m\»?3à#?@∂\€.4\◊a+¿ô(B\Ív\"?@\È\—TO\Ê_+¿u!VÑ!?@≤Û¨§]+¿ˇ≤{Ú∞ ?@üëç`[+¿ôFìã1 ?@ı∫E`¨W+¿,Ä) ?@ÿÄqU+¿è˙\Î ?@Éˆ\Í\„Q+¿\Ô\Â>9\n ?@≠˙\\m\≈N+¿+ï\‘	 ?@ByGK+¿´^~ß\… ?@bfü\«(G+¿L\‡\÷\›<!?@Ü\Âœ∑E+¿∂üåÒ!?@©¯ø#*D+¿2v\¬Kp\"?@å.o\◊B+¿˙∏6Tå#?@ôÑy?+¿Ωˇè&$?@oΩ¶=+¿J]2éë$?@õëA\Ó\"<+¿\Êó«ö%?@á‡∏åõ:+¿õ\Â≤\—9\'?@_@/‹π8+¿∂dUÑõ(?@|∂ˆ6+¿≤ˆw∂G+?@\’@Û9w3+¿!<\⁄8.?@¥\0m´Y/+¿üF/?@•h\Â^`.+¿î\Ÿ ìå0?@ª&§5-+¿x|{◊†3?@ˆ&Ü,+¿<á2T\≈4?@{ø—é.+¿4.\…6?@7n1?74+¿»ô&l?9?@øÛãÙ/+¿ç\‘{*ß9?@Öï\n*™.+¿∞\‚:?@\ﬁ\Â\"æ++¿G=D£;<?@≠\›v°π&+¿Øîeàc=?@ˇØ:r§#+¿\ﬁs`9B>?@\0ç“•!+¿D0.??@(b\√+¿{ÜpÃ≤??@8Ωã˜+¿ÜV\'g@?@˚>$D+¿≤ÉJ\\\«@?@3SZK+¿_&äêB?@vOj+¿∑\nb†kC?@ùŸÆ\–+¿¬¶Œ£\‚C?@Jö?¶µ+¿\'ºß>D?@^ÇS+¿ó\0¸S™D?@´\ŒjÅ=+¿ò1kúE?@≠hsú\€+¿d \œ.\ﬂF?@*7QKs+¿l{ª%9H?@\Ì\”ÒòÅ\n+¿˙úª]/I?@ÜKÆ\n+¿¿%\0ˇîJ?@5sªó+¿B\Ã%U\€M?@ÄF\È\n+¿∑)\’N?@+kõ\‚q	+¿ôùE\ÔTP?@y\À’èM+¿)yuéQ?@\ﬂR\Œ{ˇ*¿U\⁄\‚\ZüQ?@=\'Ωo|˝*¿pï\'vR?@…êc\Î˙*¿` ê°S?@≤ûZ}ı*¿M-[\ÎãT?@¯àòIÙ*¿í\ÀHøU?@\‚vhXåÚ*¿\Ìû<,\‘V?@\ZQ\⁄|Ò*¿O\È`˝üW?@\ZÜèà)Ò*¿\ÁˇUGéX?@˚ê∑\\˝*¿EbÇ\ZæY?@K≠˜\Ì*¿ø`7l[\\?@t}Ú*¿ÑÿôB\Á]?@RewÉ*¿EÑ4^?@\”L˜:©\Ô*¿d\Œ3ˆ%_?@\¬5wÙø\Ï*¿]\·].\‚_?@hwH1@\Í*¿m\‰∫)\Âa?@ã™_\È|\Ë*¿}zlÀÄc?@Ç\∆L¢^\Ë*¿ØΩ7Üd?@eâ\Œ2ã\Ë*¿û#Ú]Je?@*ˇZ^\È*¿3o\’u®f?@†Y2\«\Í*¿∑C\√bh?@\"S>U\Î*¿npñíi?@\⁄q\√\Ô¶\Î*¿\⁄\Á6\·j?@qtï\ÓÆ\Î*¿1–µ/l?@f/\€N[\Î*¿¥V¥9\Œm?@${Ñö!\Â*¿¨Ôéåm?@\ﬂ\‡ì©\‚*¿Øô|≥\Õm?@åM+Ö@\ﬁ*¿(\”hr1n?@oõ©è\‹*¿\“¸1≠Mo?@Eºu˛\Ì\⁄*¿Lç\–\œ\‘o?@\‘ÚWy\⁄*¿}\ÍX•Ùp?@∏\ÕTàG\⁄*¿ÒGQg\Óq?@¶Cß\Á\›\ÿ*¿+mqç\œt?@DO §\÷*¿Û;Mfºu?@©˙ïŒá\◊*¿≤æÅ…çv?@ç¥Tﬁé\ÿ*¿\„\‡\“1w?@:vP\Ÿ*¿MI\÷\·\Ëz?@–∏p $\€*¿\'2sÅ\À{?@J∏êGp\€*¿!\Á˝|?@¡ˇV≤\€*¿ñ?\ﬂ,}?@±¢\”0\‹*¿˘\Ÿ\»uS~?@´^~ß\…\‹*¿èr0õ\0?@®éUJ\œ\‹*¿ΩfæÉ?@π®\≈\‹*¿\—]gEÄ?@¥\Ê\«_Z\‹*¿d\Âó¡Å?@l≥±Û\‹*¿H\ﬁ9î°Ç?@ÉÖì4\‹*¿TT˝JÉ?@˛(\Í\Ã=\‹*¿D\ƒÕ©dÑ?@∫LMÇ7\‹*¿#Mº<Ö?@kFπ\€*¿]2éë\ÏÖ?@l>Æ\r\€*¿åÖ!r˙Ü?@[∞T\⁄*¿Ä`éøá?@ø\”d\∆\€\⁄*¿u;˚ Éà?@Y¶_\"\ﬁ\⁄*¿\Õ√πÜâ?@l\‚u˝\⁄*¿l\È\—TOä?@´an˜\⁄*¿ÄF\È“ã?@\·+Ÿ±\Ÿ*¿§à´xã?@¡S»ïz\÷*¿ø\ÓtÁâã?@Rùd=\’*¿QlMKå?@\ÔêbÄD\”*¿&5¥ÿå?@ôd\‰,\Ï\—*¿ )\"\√*é?@\∆\√{,\œ*¿˝ky\Âzè?@Lâ$z\Õ*¿9{\⁄\·è?@\»\n~b\Ã*¿¿\Í»ëŒê?@º<i\·\ *¿Xç%¨çë?@\Ô\…\√B≠\…*¿\nÉ2çí?@ÄF\È\“\«*¿/m8,\rî?@\'k\‘C4\¬*¿F\—Éï?@{iä\0ßø*¿´ÆC5%ô?@¯P¢%èø*¿\Ïiáø&õ?@Sï∂∏∆ø*¿t@ˆ\Ìú?@mÚñ´ø*¿jà*¸û?@W\œI\Ôø*¿~åâû?@RôbÇæ*¿>@˜\ÂÃû?@˘ÑÏºçΩ*¿‘∑\Ã\Èû?@\‰ı`R|º*¿…éç@ºû?@õsL∏*¿Û!®\ZΩû?@J+á∂*¿{Nz\ﬂ¯û?@;\∆Gµ*¿ˇØ:r§ü?@\Ë¿rÑ¥*¿4ı∫E`†?@\œ,	PS≥*¿\»_Z\‘\'°?@˙\ÃYü≤*¿^Háá0¢?@´\Ì&¯¶±*¿ut\\ç\Ï¢?@.py¨±*¿^\’Y-∞£?@(\‘\”G∞*¿ÄÛ\Â§?@O\…9±áÆ*¿\≈_—≠£?@\¬¡\ﬁƒê¨*¿∞\‰*£?@weÆ©*¿¡S»ïz¢?@∞VÌöê¶*¿¿u≈å¶?@`∑\Ó\Ê°*¿\≈q\‡\’rß?@PR`L°*¿ƒ∞√òÙß?@cbÛqm†*¿≠5î⁄ã®?@à+gÔåû*¿\‘M÷®?@OÂ¥ß\‰ú*¿j\ﬁqäé®?@\“\«|@†õ*¿Ìöê\÷®?@\∆nüUfö*¿\∆jÛˇ™ß?@óuXô*¿>[ß?@ì¶A\—<ò*¿ÄGT®n¶?@\ÎÛê)ó*¿I\ÿ\’\‰•?@/¿>:uï*¿\\!¨\∆¶?@¯©*4ì*¿RπâZöß?@0\÷70πë*¿\Ï\‹®?@≤\’ÂîÄê*¿∑C\√b®?@Y0ÒGQè*¿^Å\ËIô®?@°Û\ZªDç*¿¸d®?@\ÿóqã*¿ß>êºß?@Òc\Ã]Kà*¿≠jIß?@\”\◊¯LÜ*¿\‹gïô“¶?@É¢y\0ãÑ*¿≠i\ﬁqä¶?@\≈\ h\‰ÛÇ*¿\ lêIF¶?@\ÏK6lÅ*¿¥\ Li˝•?@∑–ïT*¿B\Ã%U€•?@qÃ≤\'Å}*¿˝/◊¢•?@P:ë`™y*¿Àú.ãâ•?@§QÅìmx*¿≥%´\"®?@ì¨\√\—Ur*¿\'\‹+ÛV©?@ú≈ãÖ!r*¿xG\∆jÛ´?@9\÷\≈m4p*¿]¬°∑x¨?@K¨åF>o*¿\"HõÆ?@\‚\ \Ÿk*¿(väUØ?@I0\’\ÃZj*¿8æˆÃí∞?@*\∆˘õh*¿%W@°≤?@8kæ*g*¿Ùáfû\\≥?@ı-s∫,f*¿yGsdµ?@oeâ\Œ2c*¿º\ÀE|\'∂?@›ó3\€b*¿ZÙP€∂?@Å≥î,\'a*¿jlØΩ∑?@\€¡à}`*¿1–µ/∏?@:í\ÀH_*¿ù\œd∏?@+˙C3O^*¿F\Î®jÇ∏?@îMπ\¬[*¿ª,Dá∏?@]lZ)Z*¿@7nπ?@ë+ı,U*¿ñB ó8∫?@ß#Äõ\≈S*¿,∑¥\Zª?@\npUR*¿¯ßTâ≤ª?@Eı\÷¿VQ*¿36t≥?º?@cAJP*¿2øFíº?@`?\ƒO*¿$π¸áÙª?@~SX©†J*¿øE\'K≠ª?@\·E_AöI*¿5”ΩN\Íª?@$∂ª\ËF*¿	\¬P®ª?@\ﬂ\·vhXD*¿¡\‚p\ÊWª?@\’>è@*¿3˘fõª?@ˇ\Ê≈âØ>*¿ﬂà\ÓY◊º?@\Ë£\Á:*¿ï|\Ï.Pæ?@H\≈ˇQ9*¿l>Æ\rø?@7qrøC9*¿*\»\œFÆø?@5(ö∞8*¿\Ó&¯¶\Èø?@\∆˙&7*¿πﬂ°(–ø?@‹Å:\Â\—5*¿W	á3ø?@	4\ÿ\‘y4*¿D˝.lÕæ?@™(^em3*¿<\⁄8b-æ?@i\Z\Õ0*¿\Ì\ræ0ôæ?@˝/◊¢-*¿‹∑Z\'.ø?@ó\„àû,*¿ˆ%∂¿?@ß\Ã\Õ7¢+*¿}\"OíÆ¡?@ó©IÜ,*¿r2q´ \¬?@˛“¢>\…-*¿u∞˛\œa\¬?@\◊\‹\—/*¿\Í Øì\¬?@Æ†iâï1*¿øôò.\ƒ\¬?@Dj\⁄\≈43*¿¿í´X¸\¬?@â|óRó4*¿£è˘Ä@\√?@´Z\“Q6*¿\Í\È#á\√?@ç∏\04J7*¿#æ≥^\ƒ?@pîº:\«8*¿£[Ø\ÈA\≈?@∏u7Ou8*¿]2éë\Ï\≈?@\ﬁ>´Ãî6*¿y¢\'e\∆?@%\Õ\”\⁄4*¿®REÒ\∆?@\Ê \ËhU3*¿%]3˘f\«?@Òd732*¿úlw\»?@v≈åˆ0*¿\‚\ \Ÿ;£\…?@\“V%ë}0*¿èß\ÂÆ\ ?@ï\Ôâ\–0*¿v\‡ú•\Õ?@2Y\‹d2*¿û?mTß\œ?@P6\Â\n\Ô2*¿¯\„ˆ\À\'\œ?@n⁄å\”%*¿\«Hˆ5\œ?@\Ó\Ï+\“#*¿\√ÛR±1\”?@äì˚ä\"*¿\≈Y5\—\”?@a8\◊0C#*¿â\”I∂∫\‘?@ı\"r$*¿∂\÷	m\’?@0du´\Á$*¿B\Ó\"LQ\÷?@hÆ\”HK%*¿îôÄ_\◊?@\Í%\∆2˝\"*¿\œ:Ø±\◊?@lZ)r!*¿≥\Ì¥5\"\ÿ?@¥W}*¿+\⁄\Á6\Ÿ?@mt\ŒOq*¿â/Ç\∆\‹?@∏;k∑]*¿µ˙\Í™@\›?@\‰,\Ïiá*¿ÿõíì\›?@\ƒ\È$[]*¿|F\"4Ç\›?@+j0*¿í∞o\'\›?@¿=œü6*¿∂É˚\‹?@Iÿ∑ìà*¿ßvÜ©-\›?@oJy≠Ñ*¿K´!qè\›?@Ç\ƒv˜\0\r*¿-œÉª≥\ﬁ?@a˙^Cp*¿˙{)<h\ﬁ?@Ú\Í≤*¿ã§\›\Ëc\ﬁ?@9ùd´\À*¿y\\Tãà\ﬁ?@˚ªa\€*¿Ü\»\È\Î˘\ﬁ?@IIC´*¿à.®oô\ﬂ?@º≠Ù\⁄l*¿øFí \‡?@a4+€á*¿î.˝KR\·?@Síu8∫*¿J\ÌE¥\·?@†\‚8j*¿±˙#\‚?@¢_[?˝*¿¸åB\‚?@t\Í\ gy*¿QN¥´ê\‚?@`V(\“˝*¿j\”L˜\‚?@¨´µ*¿@ˆz˜\«\„?@œü6™\”	*¿π\ZŸïñ\Â?@\Ïø\ŒMõ	*¿ìE\÷\Z\Ê?@cÄD(\n*¿\\W\Ã\Á?@\‘\—q5≤*¿^\’Y-∞\Á?@mÆö\Áà*¿®\√\n∑|\Ë?@è\Èå*¿Ä∏´W\È?@˙}ˇ\Ê\≈	*¿?\ƒ\'\È?@ã6«πM*¿HõV\n\È?@\›zM*¿ú1\Ã	\⁄\Ë?@{‹∑Z\'*¿\”l#û\Ë?@DkEõ\„*¿íó5±¿\Á?@ê¿~˛*¿6\\ê-\Á?@Ifı∑*¿ıÇOs\Ê?@Äbd\…*¿´\ÎPMI\Ê?@Å\–z¯2*¿Q1\ŒﬂÑ\Ê?@Æü˛≥\Êˇ)¿˛∏˝Ú\…\Ê?@fffff˛)¿&™∑∂\Ê?@<¡˛\Î\‹¸)¿m\≈˛≤{\Ê?@]P\ﬂ2ß˚)¿40Ú≤&\Ê?@øôò.\ƒ˙)¿æ.\√∫\Â?@Fïa\‹\r˙)¿ˇ<\r$\Â?@p|\Ìô%˘)¿\»a0Ö\‰?@h]£\Â@˜)¿÷é\‚u\‰?@T8ÇTäı)¿\œéYˆ\‰?@SX©†¢Ú)¿l\Ã\ÎàC\Ê?@\ÃoB)¿\Z\·\ÌA\Ë?@\”˘,A\Ó)¿Éh≠hs\Ë?@2\Á˚í\Ì)¿J¥\‰Ò\Ë?@4iSuè\Ï)¿ £aQ\È?@GÆõR^\Î)¿ôÚ!®\Z\È?@™õãø\Ì\È)¿]à\’a\Ë?@6l±\€\Á)¿•/Ñú˜\Á?@´$≤≤\‰)¿*Ral!\Ë?@T\‡d∏\„)¿_∂ù∂F\Ë?@π´Wë\—\·)¿\nLßu\Ë?@\Ïæcx\Ï\ﬂ)¿Î≠Å≠\Ë?@˛{⁄•\›)¿¢\Ÿ:8\Ë?@#Û\»\‹)¿ﬁè\€/ü\Ë?@7ßí†\⁄)¿s€æG˝\È?@Å#Å\€)¿∫.¸\‡|\Í?@~7›≤C\‹)¿)$ô\’;\Ï?@+\‘\›)¿ (∑\Ì{\Ï?@)±k{\€)¿\”¯ÖWí\Ï?@¨™ó\ﬂi\⁄)¿€ø≤“§\Ï?@m¨\ƒ<+\Ÿ)¿\‰Ü\ﬂM∑\Ï?@\Ê\À∞\◊)¿e\ZM.\∆\Ï?@óuˇXà\÷)¿ü\€2\‡\Ï?@Rµ\›\ﬂ\‘)¿tzﬁç\Ì?@Sz¶ó\”)¿IÛ«¥6\Ì?@ëò†Üo\—)¿¥[\Àd8\Ó?@\ÏÖ∂É\—)¿x\nπR\œ\Ó?@ÿúÉgB\”)¿f/\€N\Ô?@\À-≠Ü\‘)¿/¸\‡|\Í?@cC7˚\’)¿¸˝b∂dÒ?@z\‰û\”)¿N\“¸1≠Ò?@vR_ñv\“)¿_∑åıÒ?@_(`;\—)¿8\‹GnMÚ?@DP5z5\–)¿g(\ÓxìÛ?@n\€˜®ø\Œ)¿æl;mçÙ?@˜ì1>\Ã\Œ)¿π¡Páˆ?@…´s\»\Œ)¿IùÄ&\¬ˆ?@¶{ù‘ó\Õ)¿2: 	˚ˆ?@_ô∑\Í:\Ã)¿33333˜?@M1AG\À)¿\∆0\'hì˜?@\Ï‹¥ß\…)¿üUfJ\Î˜?@ûBÆ‘≥\»)¿\‡G5\Ï˜¯?@\≈<+i\≈\«)¿\›%qVD˘?@}ZEh\∆)¿˜u\‡ú˘?@n¬Ω2o\≈)¿â\ÎW\\¯?@\∆5>ì˝\√)¿±˚é\·±˜?@\"\∆k^\’¡)¿Éˆ\Í\„°˜?@ªπ¯€û¿)¿J\Îo	¿˜?@ø[≥ïø)¿\‚eSÆ¯?@,º\ÀE|ø)¿\ﬂó™¥˘?@íìâ[¡)¿\¬\ﬂ/fK˙?@\‘I∂∫ú\¬)¿d\Êó\«˙?@.rOWw\ƒ)¿z¸ﬁ¶?˚?@®r\⁄Sr\∆)¿Y5sª˚?@£ x|{\«)¿\ÿ\Ôâu™¸?@\ﬂN\"¬ø\»)¿\'fΩ\ ˝?@B∞™^~\«)¿h\È\n∂˝?@˛)U¢\Ï\≈)¿¸˝b∂d˝?@˙\—p\ \‹\ƒ)¿\≈9\Í\Ë¸?@-$`ty\√)¿\Ÿ=yX¸?@ï-Ø\\ø)¿a\√\”+˝?@ä\ÀÒ\nDø)¿m®\Áo˛?@¯Ac&¡)¿(Hlw\0@@\‡π˜p\…¡)¿óRóåc\0@@+ï\‘	¿)¿\ÿÙJY\0@@\÷TÖΩ)¿~7›≤C\0@@∆á\ŸÀ∂ª)¿\n∫Ω§1\0@@Ü\«~Kπ)¿Åx]ø`ˇ?@∑\Ì{\‘_∑)¿¬•c\Œ3˛?@¿yq‚´µ)¿\ÊÆÚ˛?@í>≠¢?¥)¿Àüo˛?@ñZ\Ô7⁄±)¿¡¸˝b˛?@éH∞)¿w\‹ª\È˛?@ßx\\Tã∞)¿yít\Õ\‰ˇ?@x\nπRœ≤)¿Éh≠hs\0@@¸\ﬂ™≥)¿˜w∂Go\0@@Øz¿<d≤)¿8íL\0@@a™ôµ∞)¿Z_\0@@ÒÑ^Ø)¿G<\ŸÕå\0@@\»\“≈¶≠)¿ãåH\¬\0@@(µ\—v¨)¿&©L1@@M˜:©/´)¿-ôcyW@@∞çx≤õ©)¿\œ˜S\„•@@0†\Ó\\®)¿∫û\Ë∫@@N*\Zkß)¿$~\≈\Z.@@ìp!è\‡¶)¿¶∏™\Ïª@@Ùp\”i•)¿\ﬁ Z+\⁄@@∞\Âï\Îm£)¿á\ZÖ$≥@@%\Ë/Ùà°)¿h∞©Û@@6ëô\\û)¿ıª∞5[@@¢Çãù)¿©Öí…©@@#æ≥^ú)¿gaO;¸@@XT\ƒ\È$õ)¿ôFìã1@@—ì2©ô)¿QΩ5∞U@@º]/Mò)¿[ïDˆA@@åˆx!ñ)¿πß´;@@õ©æÛì)¿è\Èå@@#fˆyåí)¿IÜ[\œ@@ |(—í)¿Øœúı)@@qWØ\"£ì)¿{§¡mm@@xEøïî)¿©i\”L@@2\0Tq\„ñ)¿N∂Å;P@@\‘\“\‹\naï)¿¨\‚ç\Ã#@@\·B¡çî)¿tA}Àú@@¢|Aì)¿ò\ÀÙK@@QΩ¬í)¿\’[[%@@D˙\Ì\Î¿ë)¿à\◊ı@@\'¡“®ê)¿°J\Õ@@ˇwDÖ\Íé)¿\Ì\Ôlè\ﬁ@@ÅŒ§Mç)¿ª’îd@@≥A&9ã)¿ó˝∫”ù@@+1\œJZâ)¿ZEh\Ê@@é\Ÿ\Î›á)¿æ°\Ÿ:@@|û?mTá)¿X\ÁêΩ@@\ÍØWXpá)¿©˙ïŒá	@@\√\Ô¶[và)¿\“o_\Œ	@@@˜\Â\ÃvÖ)¿xe®ä	@@\’íwÖ)¿_ñvj.	@@}A	Ö)¿\–b)íØ@@-ôcyWÖ)¿SYvQ@@˘ÑÏºçÖ)¿ñZ\Ô7\⁄@@˘d\≈pÖ)¿\‰¯°“à@@\Àˆ!oπÇ)¿\◊˘∑\À~@@0úkò°Å)¿=Y§â@@Ò-¨\Ô~)¿C´ì3@@d\Ë\ÿA%~)¿FA¯@@9Cq«õ|)¿1\Ó\—Z@@çG©Ñ\'|)¿ú£éé´@@Åìm\‡|)¿Ò/Ç\∆L@@&åfe{)¿ë\ÔR\Í@@\·$\Õ\”z)¿y±0DN	@@ö>;\‡∫z)¿\‰1ïÒ	@@:=\Ô∆Çz)¿7\≈\„¢Z\n@@óU\ÿx)¿\¬Ÿ≠e\n@@obHN&v)¿&\Â\Ós|\n@@lÀÄ≥ît)¿3RÔ©ú\n@@\·òeOs)¿ÃòÇ5\Œ\n@@\Z4ÙOpq)¿öœπ\€ı\n@@\Ï\¬Œßn)¿z®m\√\n@@`\ ¿-m)¿/˙\n\“\n@@ì¨\√\—Uj)¿\‡/fKV@@\Œ5\Ã\–h)¿\“V%ë}@@#\◊M)Øe)¿Çã5ò@@M÷®áhd)¿\·_çô@@&S£b)¿ùæûØY@@Ø\'∫.¸`)¿DioÖ@@gÛ8\Ê_)¿™ÇQIù\n@@9EGr˘_)¿Å∞S¨\Z\n@@¡\Zg\”`)¿n§lë¥	@@x%\…s}_)¿Ò§Ö	@@¢\Óê\⁄\\)¿{◊†/Ω	@@që{∫∫[)¿1`\…U,\n@@\ÀHΩßrZ)¿N	àI∏\n@@∏@Ç\‚\«X)¿bHN&n@@xcAaPV)¿û\'û≥@@∏<÷åT)¿\›aôπ@@-\È(≥Q)¿ˇ\Ê≈âØ@@\›\\¸mOP)¿ñØ\Àü@@kJ≤GO)¿+\‹Úë@@∞ \ÕX4M)¿\"Hõ@@i9\–CmK)¿\ŸzÜp\Ã@@\¬˘‘±JI)¿ﬂ§iP4\r@@\Ïm3\‚A)¿d∞\‚Tk\r@@çõ\Zh>?)¿∏ï^õç\r@@‹ª}\È=)¿\«\ÿ	/¡\r@@\'\·_=)¿uÄ\‘&@@\Ë\ÿA%Æ;)¿,ÒÄ≤)@@\ﬁ;jLà9)¿;®\ƒuå@@>¿x5)¿\Œ{/æ@@\0\Z•Kˇ2)¿\“\»\ÁO@@∞\≈nüU.)¿\»T∆ø@@3ƒ±.n+)¿æ¢[Ø\È@@Zbe4Ú))¿øõn\Ÿ!@@ådèP3$)¿[A\”+@@i5$\Ó±)¿åJ\Í4@@SuèlÆ\Z)¿˚[O@@Ä\rà)¿\»–±@@l]jÑ~)¿\«-\Ê\ÁÜ@@C\€¡à)¿æ†Öå@@4ÙOp±)¿~\√DÉ@@Ò\rÖ\œ\÷)¿∞Y.ù@@ìT¶òÉ)¿õ<e5]@@Ø[\∆˙)¿àûîI@@ê0Xr\r)¿Ü\«~K@@Ò\Ÿ:8\ÿ)¿}\È\Ì\œE@@cD¢–≤)¿°l\\@@R\“\√\–\Í)¿\‘)ènÑ@@¯˘\Ô¡)¿Pâ\ÎW@@ªîX\0)¿®\ZΩ\Z†@@6í\·\n\0)¿\È|xñ @@@¯P¢%ˇ(¿AÒc\Ã]@@ºÆ_∞˛(¿z\‰û@@éì¬º\«˘(¿p^ú¯j@@ˆ¥\√_ìı(¿ywd¨6@@CÆ‘≥ Ù(¿6¨©,\n@@ö&l?Û(¿Î´´µ@@mè\ﬁpÒ(¿`∞∂-@@ã¡√¥o\Ó(¿ºÆ_∞@@\„U\÷6\≈\Î(¿q $ò@@Äa˘Ûm\È(¿&©L1@@Ú^µ2\·\Á(¿˝°ô\'@@n\ƒ@\◊\Ê(¿\Ãc\Õ\» @@¯\∆\0\„(¿:ì6U˜@@-	PS\À\ﬁ(¿\€P1\Œ\ﬂ@@F¥Sw\›(¿LäèO\»@@◊æÄ^∏\€(¿X8IÛ\«@@T™D\Ÿ[\⁄(¿M\nJ\—@@ÆõR^+\Ÿ(¿á6\0@@!yv˘\÷(¿|“âS@@è=∑\–\’(¿©K\∆1í@@rk\“mâ\‘(¿∑}è˙\Î@@\—\Ëbg\“(¿\¬N±j@@ÿ∏˛]ü\—(¿Ç\‚«òª@@ö≤\”\“(¿\Ï£SW>@@¿\0¬á\“(¿Z/Ür¢@@g∂+Ù¡\“(¿Yøôò.@@\'\"\‡\“(¿JÜ4*@@+5{†\–(¿\ŒSr3@@\Î6®˝\÷\Œ(¿Ò\÷˘∑@@«É-v˚\Ã(¿b0Ö\Ã@@x∏\Z\À(¿Œç\È	K@@àúæûØ\…(¿\“\·!åü@@¯\‚ãˆx\…(¿\Õ.è5@@H\≈ˇQ\…(¿≠Mc{-@@<˜.\…(¿™”Å¨ß@@gÚ\Õ67\∆(¿<l\"3@@|∑y\„\ƒ(¿\Ã\rÜ:¨@@p|\Ìô%¡(¿nlv§˙@@f¯O7P¿(¿∂KK@@`ë_?ƒæ(¿]n0\‘a@@¸\‡|\ÍXΩ(¿J∏êGp@@\œ0µ•∫(¿Ö\Õ\0d@@BA)Zπ∑(¿~8gD@@\\=\'Ωo¥(¿µ∆†B@@\‚vhXå≤(¿uV\Ï1@@¥À∑>¨Ø(¿DoÒû@@áQ<æ≠(¿qè•]\Z@@dx\Ïg±¨(¿Ωé8d@@¢≤aMe©(¿\‡/fKV@@\√\r¯¸0™(¿≤F=D£@@∫ˆÙ™(¿\Ï†\◊1@@¿îÅ´(¿)]˙ó§@@óræ\ÿ{©(¿H5\Ï˜\ƒ@@(Ç8\'®(¿U¢\Ï-\Â@@tA}Àú¶(¿ç(\Ì\ræ@@\„¸M(§(¿ãàbÚ@@∏YºX¢(¿W#ª\“2@@òøB\Ê †(¿e73˙\—@@@2:=ü(¿ç\‘{*ß@@ñ]0∏\Êû(¿2\…\»Y@@?6…è¯ù(¿™\rNDø@@ºx?nøú(¿˚På,@@\‡ÄñÆ`õ(¿\0\∆3h\Ë@@	¶öYKô(¿ñ_cD @@Ù\·YÇåò(¿ìnK\‰Ç!@@ {Ω˚\„ï(¿¥Ñ\÷\√!@@\¬MFïaî(¿1\'hì\√!@@≥{Ú∞Pì(¿\ ˚8ö!@@.\∆¿:éè(¿\›A\ÏL°!@@\√,¥söç(¿\ÌÇ¡5w\"@@	pz\Ôá(¿äV\Óf#@@\‡Jvlä(¿\Ó≤_w∫#@@_(`;â(¿¥\Ëù\n∏#@@¯P¢%èá(¿>œü6™#@@\¬\÷l\ÂÖ(¿\„\·=ñ#@@\ÂÄ]MûÇ(¿Éà‘¥ã#@@7ç\Ìµ†(¿˙\ÏÄ\Îä#@@\Õu\Zi©|(¿rP\¬L\€#@@\Ê±fdê{(¿C8fŸì$@@∫Å\Ít(¿πòä$@@¥\…\·ìNl(¿ò\‹(≤\÷$@@’Øt><k(¿!\Œ\√	L%@@\'æ\⁄Qúk(¿G ^\◊/&@@V+~©g(¿ÉP\ﬁ\«\—&@@\⁄;£≠Jb(¿C±l\Ê&@@˘ıCl`(¿@KW∞ç&@@Àùô`8_(¿MK¨åF&@@∑≥Ø<H_(¿PQı+ù%@@\ÕvÖ>X^(¿õ.»ñ%@@¨\Â\ŒL0\\(¿0πQd≠%@@Å\ÃŒ¢wZ(¿PQı+ù%@@Têüç\\W(¿\Õu\Zi%@@|E∑V(¿¢U1ï$@@iå\÷Q\’T(¿\Ï\€ID¯#@@ZÚxZ~P(¿\ﬁ\Â\"æ#@@Ö&â%\ÂN(¿ä\ÈB¨˛\"@@©;\ZáJ(¿£\Œ\‹C\¬#@@~åπk	I(¿>\Î\Z-$@@êÑ};â@(¿\…Àª\Í#@@µ\Z˜X:(¿`ì5\Í!$@@\⁄∆ü®l8(¿sÉ°+$@@\ÿıv\√6(¿é[\Ïˆ#@@íÆô|≥5(¿ìE\÷\Z$@@L¬Ö<Ç3(¿\Ÿ\—8\‘\Ô$@@°Ç\√\"2(¿\»\œFÆõ&@@\Ó\Ã√π.(¿JEc\Ì\Ô&@@√∏Dk-(¿¬¢\"N\'\'@@/m8,\r,(¿\ ˘b\Ô\≈\'@@O≤\’\Âî((¿sÇ69|(@@\n±àa\'(¿Ú\œ\‚)@@\›ãä((¿éyq\»*@@\›	ˆ_\Á&(¿m´Yg|+@@:x&4I$(¿Ñ*5{†+@@í=BÕê\"(¿\Ìˇ∞•+@@Wñ\Ë,≥ (¿6\‰ü\ƒ+@@¶|™F(¿Ø@Ù§,@@T®n.˛(¿\Õ\Àa˜-@@±ã¢>(¿ô†Üoa-@@`\0\·Câ(¿æøA{ı-@@-y<-(¿$Ú]J].@@´\Á§˜ç(¿\—ı-s.@@q!è\‡F\"(¿µ\Z˜X.@@ºï%:\À$(¿\Œ˚ˇ8a.@@\Î¸\€eø&(¿©æÛã.@@JÜ4*((¿\Ô\0OZ∏.@@˚ê∑\\˝((¿ª\’s\“˚.@@r\≈\≈Qπ)(¿(CUL•/@@S]¿\À+(¿Õ´:´0@@/3lîı+(¿∂ˆ&0@@JA∑ó4.(¿1|DLâ0@@y\ŒZ/(¿nâ\\p1@@>Y1\\0(¿GN∂Å1@@T\0åg\–0(¿¯2QÑ\‘1@@dì¸à_1(¿\ŒQ\⁄2@@z©ÿò\◊1(¿æl;mç2@@@4Û\‰ö2(¿\ÈIô\‘\–2@@º \"5\Ì2(¿ÆI∑%r3@@pCå◊º2(¿°\ŸuoE4@@-”æ1(¿Rr•4@@r›îÚZ1(¿¿#*T75@@êæI”†0(¿¸ﬁ¨¡5@@ºW≠L0(¿v5y\ j6@@*\∆˘õP0(¿z®m\√6@@\œ¿\»Àö0(¿\…<Ú7@@KxBØ?1(¿±M*\Zk7@@∏\nıÙ1(¿qxµ\‹7@@±\‡~¿3(¿µ4∑B8@@Ja\ﬁ\„L3(¿n/Ü8@@wg\Ì∂3(¿ÆÚ\¬8@@ß\‘E\n5(¿\„5Ø\Í8@@(ôú\⁄6(¿\‡c∞\‚T9@@î¯\‹	ˆ7(¿\∆\ﬂˆâ9@@ï\Ôâ\–8(¿\ƒ\Íè0:@@$õ´\Ê9:(¿Ú\Ô3.:@@ÜUºëy<(¿˘*:@@\ŸBêÉ>(¿\…¸\ZI:@@2Æ∏8*?(¿-x\—Wê:@@shë\Ì|?(¿º\œÒ\—\‚:@@\'˙|î?(¿\«e\‹\‘@;@@Ä∂’¨3>(¿{°Ä\Ì`<@@8ákµá=(¿4Û\‰ö=@@,ûz§¡=(¿+0du´=@@U.T˛µ<(¿py¨>@@ª`p\Õ=(¿Ü8\÷\≈m>@@_ïï=(¿\‚:\∆?@@ö\È^\'ı=(¿ï\'vä?@@y\Íë∑=(¿àÚ-$@@@†O\‰I\“=(¿ö?¶µi@@@¢U1ï>(¿\Îé\≈6©@@@∏\"1A\r?(¿\Áq\Ã_A@@°.R(?(¿év\‹ªA@@Ü\Á•bc>(¿ß/˙\nB@@\∆2˝Ò>(¿&p\ÎnB@@5~\·ï$?(¿Ø\–\À\ÿB@@\Õ…ãL¿?(¿L8ÙC@@∫\€ı\“A(¿\ÀiO\…9C@@â\Ôƒ¨C(¿¸\‡|\ÍXC@@\Z•KˇíD(¿d;\ﬂOçC@@+/˘ü¸E(¿]\√ç\'D@@f-§˝G(¿N\'\Ÿ\ÍrD@@Pîi4I(¿¿\Õ\‚\≈D@@áO:ë`J(¿îi4πE@@o\‘\n\”˜J(¿&m™\ÓëE@@c0\ÌõK(¿>\Õ…ãLF@@©Ñ\'Ù˙K(¿=µ˙\Í™F@@R∑≥ØL(¿\À\ÿ\–\ÕF@@\≈Sè4∏M(¿Éái\ﬂF@@\Îptï\ÓN(¿RêhG@@ôÙ˜RxP(¿˛∂\'HlG@@\◊ﬁß™\–P(¿	ÚnH@@EÅ>ë\'Q(¿VõˇWI@@Ñb+hZR(¿oeâ\Œ2I@@û?mTßS(¿?˛“¢>I@@a\\:\ÊT(¿\Ã\Ó\…\√BI@@{˘ù&3V(¿Rùd=I@@\÷ˇ9ÃóW(¿\ƒ\'ùH0I@@\»\Œ\€\ÿ\ÏX(¿Û¨§I@@-¥söZ(¿éègI@@à∫@j[(¿†‹∂\ÔQI@@.ùÛS\\(¿rˆ¥\√I@@ˆ—©+ü](¿û%\»J@@:\Ë](¿\ƒ\Ã>èQJ@@ò¡ë(\\(¿†ä∑J@@Ñ-v˚¨Z(¿\Èe\À-K@@\ﬂﬂ†Ω˙X(¿ò˚\‰(@L@@µ\ﬁo¥\„V(¿\€¡à}L@@•h\Â^`V(¿~åπk	M@@Üèà)ëT(¿™xôaM@@è6éXS(¿∞˜≠\÷M@@û	MS(¿E∏…®2N@@9ùd´\ÀQ(¿dØwN@@à\ÿ“£Q(¿÷årO@@∞Øu©R(¿9µ3LmO@@±j\ÊvO(¿8h∞O@@ˇ\Î‹¥O(¿]˛C˙\ÌO@@ão(|∂N(¿∏\‰∏S:P@@Ä∫Å\ÔL(¿5\—\Á£P@@%<°◊üL(¿\–D\ÿÙP@@\⁄r.\≈UM(¿\ÃE|\'fQ@@\rRL(¿I\ÿ\’\‰Q@@Òe¢©K(¿\ŒSr3R@@x\'üK(¿ê‹öt[R@@ÆfùÒ}I(¿˜\Õ˝\’\„R@@âóßsEI(¿¶+\ÿF<S@@j3NCTI(¿é[\ÏˆS@@≠1\ËÑ\–I(¿Émƒì\›T@@\–∏ÆòI(¿ˆ#EdXU@@N} y\ÁH(¿\\8íV@@‹Ω\‹\'GI(¿\„4ÙOV@@ÒGT®N(¿\nIfıW@@{\Ÿv\⁄\ZQ(¿$\—\À(ñW@@fÜç≤~S(¿d\ÈC\‘W@@fM,U(¿π\ﬁ6S!X@@?#KV(¿ñ\È)rX@@c∏:\0\‚V(¿IÙ2ä\ÂX@@ÿÅsFîV(¿\'\‹+ÛVY@@\ÍwakV(¿XrãY@@t_\ŒlW(¿•0\Ôq¶Y@@\”L˜:Y(¿á¯á-=Z@@±ø\Ïû<\\(¿è3M\ÿ~Z@@óÆ`Ò\\(¿fá¯á-[@@ds\’<G\\(¿˙aÑh[@@˜tu\«b[(¿\»“á.®[@@ÀüoñZ(¿{Ö˜\\@@¿{Gç	Y(¿ˆ&Ü\\@@∫I+W(¿¢(\–\'Ú\\@@∏Ø\ÁåX(¿\nÉ2ç&]@@¸˚åZ(¿ãmR\—X]@@\ﬁT§\¬\ÿZ(¿\Ÿ\Œ˜S\„]@@`X˛|[(¿/l\ÕV^^@@-Õ≠V[(¿ZÙP\€^@@6\\ê-[(¿\„\‡\“1_@@πrˆ\Œh[(¿⁄é©ª≤_@@eÆπ[(¿•\‹}éè`@@òQ,∑¥Z(¿õZ∂\÷a@@˜é\ZZ(¿\«\Ÿtpa@@îh\…\„iY(¿yx\“\¬a@@}Æ∂bY(¿\ 4ö\\b@@6\»$#gY(¿¨:´ˆb@@|&˚\ÁiX(¿ë9∂ûc@@ù- ¥V(¿<æΩk\–c@@§\‡)\‰JU(¿\Ô\»Xm˛c@@¯ÑT(¿Ä”ªx?d@@+√∏DS(¿+n\‹b~d@@\0™∏qãQ(¿®Tâ≤∑d@@\0:ÃóP(¿~Ωp\Ád@@*9\'ˆ\–N(¿áåG©Ñg@@∫k	˘†O(¿O!W\ÍYh@@Ω\‰ÚwO(¿±¶≤(\Ïh@@ÚµgñP(¿gc%\ÊYi@@≠5î⁄ãP(¿\–BFói@@\nıÙP(¿&˛(\Í\Ãi@@\»$#gaO(¿\\è\¬ı(j@@\¬\÷l\ÂM(¿ij@@\"lxz•L(¿\∆\ƒ\Ê\„\⁄j@@X´vMHK(¿/\√∫Ål@@ˇ\–ÃìkJ(¿)\–\'Ú$m@@JÒÒ	\ŸI(¿Û\Â\ÿGm@@˛Ú…ä\·J(¿íy\‰n@@\Ÿ#\‘©J(¿àÅ#Ån@@Sz¶óK(¿¯Rx\–\Ïn@@Ee√ö\ J(¿\À«∫∏o@@\Ô®1!\ÊJ(¿y@Ÿî+p@@†4\‘($I(¿£\È\Ïdpp@@(\‘\”GH(¿7\ƒxÕ´p@@sÄ`éG(¿Ùà\—sq@@;\∆GE(¿\ﬂP¯lq@@\Õ\\\‡ÚXC(¿µm¡q@@Ã≤\'Å\ÕA(¿∞©Û®¯q@@7¶\',Ò@(¿\0ê&år@@˙œö?(¿2Ø#\Ÿr@@\r\ﬂ¬∫Ò>(¿\\ív5s@@vß;O<?(¿\»\“≈¶s@@È∑Ø?(¿/Ü\»\Ès@@\·≤\nõ>(¿›ó3\€t@@§¶]L3=(¿j\'˜;t@@B\"m\„O<(¿T\‰qst@@üt\"¡T;(¿Ê≠∫\’t@@z\·ŒÖ9(¿˝°ô\'u@@#eã§\›8(¿;:ÆFvu@@\ÓA»ó8(¿ {Ω˚\„u@@§ˇ\ÂZ¥8(¿ã˚èLáv@@L‚¨àö8(¿\ŒQG\«\’v@@\Z\‹\÷û7(¿|\”Ù\Ÿw@@Ö	£Y\Ÿ6(¿Úw\Ô®1w@@\÷\·\Ë*\›5(¿X™xôw@@˛\Ôà\n\’5(¿ZJñìPx@@\ﬁ\„L∂7(¿ø|≤b∏x@@\ PS\È7(¿^-wfÇw@@÷™](¿ \rß\Ã\Õy@@\ﬂ\ﬁ5\0(¿äîfÛ8Ä@@\“U∫ª\Œ\Œ\'¿%=≠Nú@@\ÿc\"•\Ÿ,\'¿∂Go∏èú@@_”ÉÇR,\'¿v√∂Eôù@@Ae¸˚å+\'¿2\…\»Yÿù@@9∂û!+\'¿\"ä\…`û@@P0ûA+\'¿\Ô\„hé¨û@@Ÿól<\ÿ*\'¿i∆¢\Èû@@ê˘Ä@g*\'¿óuXü@@´\–@,õ)\'¿\€¶∂‘ü@@¿\Í»ë\Œ(\'¿e\ZM†@@\›\"0\÷7(\'¿&oÄô\Ô†@@g\Ó!\·{\'\'¿VÒFÊë°@@\'/2ø&\'¿îærﬁ°@@\·∑!\∆k&\'¿\È8h¢@@\Zâ\–6&\'¿#K\Ê¢@@p^ú¯j\'\'¿\ÿ-c}£@@©ˆ\Èx\Ã(\'¿ÿÉIÒÒ£@@1\\\0q\'\'¿e\¬/ıÛ§@@nâ\\p\'\'¿≥$@M-•@@u=\—u\·\'\'¿¿¥®Or•@@ëù∑±\Ÿ)\'¿P\’\È@¶@@\\sGˇ\À-\'¿\'¯¶È≥ß@@Øx\Íë/\'¿e\≈pu\0®@@è\‰Ú\“/\'¿e\ZM.®@@‹†ˆ[;1\'¿≤-\ŒR®@@Ä-Ø\\o3\'¿\ZNôõo®@@f\⁄˛ï5\'¿\À-≠Ü®@@¯\Ì∏\·7\'¿\‰L∂ü®@@Z_&:\'¿ß\ÏÙÉ∫®@@ü\«(œº<\'¿ö\'\◊»®@@tµ˚\À>\'¿\Á\·¶”®@@SÕ¨•@\'¿}%êª®@@JÓ∞â\ÃD\'¿7\ƒxÕ´®@@|Bv\ﬁ\∆F\'¿ó\„àû®@@Z’íérH\'¿Äd:tz®@@v6\‰üL\'¿kû#Ú]®@@ƒ¥o\ÓØN\'¿¡´\Â\ŒL®@@˝Üâ)P\'¿{JŒâ=®@@[≥\–\ŒQ\'¿«∫∏ç®@@¢C\‡HX\'¿úø	Ö®@@VπP˘\◊Z\'¿AF@Ö#®@@z˝I|\Ó\\\'¿;\√‘ñ:®@@ âvR^\'¿\Ê\ÃvÖ>®@@[#Çqpa\'¿Kí\Á˙>®@@\∆\ƒ\Ê\„\⁄h\'¿\0Æd\«F®@@ÑÙ9Dl\'¿Vª&§5®@@<˙Dn\'¿¸R?o*®@@ˇÀµhr\'¿)$ô\’;®@@\‚ !\ t\'¿Nú\‹\ÔP®@@2>\Ã^∂u\'¿òÜ\·#b®@@kJ≤Gw\'¿Én/iå®@@Ω\nÉz\'¿\«\’»Æ¥®@@&\‡\◊H|\'¿vΩS©@@\ƒ\È$[]~\'¿¬ø\Z3©@@	ç`\„˙\'¿\ﬁ\‰∑\Ëd©@@\∆¡•cŒÉ\'¿HnM∫-©@@\÷µ\¬ÙÖ\'¿B\Œ˚ˇ®@@†Q∫Ùá\'¿\Êmr¯®@@\ÏM…â\'¿vPâ\Î©@@\‘>\Õ…ã\'¿y\ŒZ©@@∑Ò\'*é\'¿\È\Ô•†©@@Kè¶z2è\'¿õsLh™@@õsLhö\'¿ã6«πM™@@GXT\ƒ\Èú\'¿™)\…:™@@\‰,\Ïiáü\'¿˝1≠Mc©@@ˆ#Ed®\'¿\„4D˛®@@ìß¨¶\Î©\'¿ØyUgµ®@@0)>>!´\'¿\ÀHΩßr®@@Ÿ∞¶≤(¨\'¿obHN&®@@\√,¥sö≠\'¿\nj¯÷ß@@\Ó\Œ\⁄mØ\'¿¸èLáNß@@¡≠ªy™≥\'¿^\◊/\ÿ\rß@@Gqé::∂\'¿?ˇ=x\Ì¶@@™}:3∏\'¿rS\Õ\Á¶@@hZbe4∫\'¿Yk(µß@@\ 1Y\‹º\'¿&\≈\«\'dß@@Àæ+ÇˇΩ\'¿ß\ËH.ˇß@@rl=C¿\'¿4Ö\Œk\Ï®@@jÜTQ\ƒ\'¿â@ı\"©@@€ÜQ<\∆\'¿c‘µˆ>©@@>^Háá\»\'¿∞é\„áJ©@@\—\\ßëñ\ \'¿e™`TR©@@¡R]¿\À\Ã\'¿\Ã∞èN©@@qπ5\È\Œ\'¿r£\»ZC©@@A¯ˆÆ\—\'¿7TåÛ7©@@Ôå∂*â\‘\'¿ÜúO©@@§aQ\◊\'¿p±¢”®@@¶ó\ÀÙ\€\'¿üì\ﬁ7æ®@@™Ä{û?\›\'¿\‰L∂ü®@@äçC˝\ﬁ\'¿|C\·≥u®@@Úw\Ô®1\·\'¿*oG8-®@@a\ƒ>\„\'¿ªd#Ÿß@@\—\À\ÿ\–\Â\'¿d\Ã]K»ß@@&¸R?o\Í\'¿l%tóƒß@@\ÕX4ùù\Ï\'¿h≥\Ísµß@@π\∆g≤\Ó\'¿¥Æ\—r†ß@@\›?¢C\'¿\råº¨âß@@!\¬¯Ò\'¿¿\ËÚ\Êpß@@OØîeàÛ\'¿&åfeß@@XU/ø\”Ù\'¿up≥xß@@˚`≠\⁄ı\'¿áD§¶ß@@Ω7Ü\0¯\'¿\Ëı\'Òπß@@ß\ÀbbÛ˘\'¿\Ôè˜™ïß@@?ç{Û˚\'¿¨˛√Äß@@v√∂Eô˝\'¿d\Êó«¶@@!ïbG\„\0(¿î¢ï{ß@@Ñ%Z(¿=÷årß@@(\Ô\„hé(¿>\Án\◊Kß@@PäV\Ó(¿Lk\”ÿ¶@@\Œ˙îc≤(¿Bïö=¶@@†R%\ \ﬁ\n(¿LS8Ω•@@πØ@Ù(¿\ \›\Á¯h•@@3§ä\‚U(¿õé\0n•@@J\rm\06(¿àº\Â\Í«§@@ùH0\’\Ã(¿©˜TN{§@@Di\‚(¿eß\‘E§@@]à\’a(¿\Ï¯/§@@ûö\À\rÜ\Z(¿{m\«‘£@@¥Æ+f(¿\0qWØ\"£@@^ë\"(¿Åy»î£@@5ö\\åÅ%(¿f`X˛¢@@ùÖ=\Ì\'(¿=)ì\Z⁄¢@@t\\ç\ÏJ+(¿\Œ\∆JÃ≥¢@@1%í\Ë-(¿¡6\‚\…n¢@@<Ö\\©g1(¿∏v¢$$¢@@ıIÓ∞â4(¿6Ü\Âœ°@@ÑºLä7(¿óqS°@@ç\r\›\Ï<(¿RÅìm\‡†@@ø÷•F\Ë?(¿Síu8∫†@@&¸R?oB(¿\÷ˆB°@@{Ö˜F(¿\”\ÿ^z°@@~∆Ö!I(¿W$&®\·°@@¯\„ˆ\À\'K(¿á2T\≈T¢@@É3¯˚\≈L(¿kEõ\„‹¢@@É˘+dN(¿.uê◊É£@@Ù\ﬁP(¿\Ó\Œ\⁄m§@@\rq¨ã\€P(¿:∏Yº§@@≥\Ô´rQ(¿Äûí¶@@â\Ôƒ¨S(¿®\ÁoBß@@J¥\‰ÒT(¿z6´>ß@@vmo∑$W(¿˛++MJß@@w+KtñY(¿ëGp#eß@@º[Y¢≥\\(¿\Ÿ=yX®ß@@gÛ8\Ê_(¿ô*ï‘ß@@ˆöîb(¿\◊OˇYÛß@@yY|e(¿\—Ãìk\n®@@±O\0\≈h(¿?pï\'®@@Øò\ﬁl(¿nR\—X˚ß@@\·&£\ p(¿t\Ï†◊ß@@\¬1Àûv(¿wº\…o—ß@@ı+ù\œz(¿ÉL2r®@@π\‚\‚®\‹|(¿°ıe¢®@@\Ó\È\Íé\≈~(¿çaN\–&©@@]¬°∑xÄ(¿<g≠©@@tö\⁄Ç(¿\◊]~™@@\÷\…ä;Ü(¿\Í=ï”û™@@˛&\"\‡à(¿ \nfL¡™@@(\Óxìﬂä(¿”§t{´@@ir1÷ë(¿pó˝∫”´@@\∆¡•cŒì(¿éèg≠@@\ÌjÜTô(¿yt#,*Æ@@Æªy™Cû(¿KtñYÑÆ@@¢\”Ûn,†(¿\Ÿ\—8\‘\ÔÆ@@D0.£(¿1]à\’Ø@@˜ë[ì¶(¿˛`\‡π˜Æ@@]lZ)™(¿†R%\ ﬁÆ@@ç∂*â\Ï´(¿è˛ók—Æ@@ {Ω˚\„≠(¿\Ê †\⁄\‡Æ@@¬¶Œ£\‚Ø(¿˝°ô\'◊Æ@@oÅ≈è±(¿(-\\VaØ@@H®RE±(¿˛ûXß Ø@@\‚;1\Î≈∞(¿\…\…ƒ≠Ç∞@@¶\rá•ÅØ(¿\Ãe˝∞@@\„\„≤ÛÆ(¿Z†¶ñ±@@\ÔXlìäÆ(¿L6l±≥@@m\‰∫)\Â≠(¿\√)sÛç¥@@¯l\Ï≠(¿ã\≈o\n+µ@@†¶ñ≠ı≠(¿¥<\ÓŒ∂@@ô,\Ó?2≠(¿*Wxóã∏@@‹†ˆ[;©(¿Têüç\\π@@å˜\„ˆÀß(¿e\·\Îk]∫@@n2™\„¶(¿≠\√\—U∫ª@@c∏:\0\‚¶(¿oõ©èº@@˜_òL•(¿Ñ,&˛º@@\‡ÜØy•(¿\¬N±jæ@@åÛ7°©(¿û`ˇunæ@@\›\—ˇr-™(¿Åy»îø@@\ÿl´(¿M°Û\Zª¿@@_Bá¨(¿ﬂ®¶\Ô¡@@•Ñ`UΩ¨(¿R_ñvj\¬@@õV\nÅ¨(¿\ﬁÊçì\¬\¬@@Å>¨(¿ùÅëó5\√@@ãv´(¿[ïDˆA\ƒ@@2éë\Ï™(¿bod\≈@@–ó\ﬁ˛\\¨(¿ç\'Ç8\≈@@fÉL2rÆ(¿ıG,\≈@@É\⁄o\ÌD±(¿ÿõíì\≈@@.\Z2•≤(¿(\‘\”G\‡\≈@@\«Hˆ5≥(¿?;\‡∫b\∆@@\—#F\œ-¥(¿\Àst\∆@@Pèmp∂(¿(d\Áml\∆@@´≤\Ôä\‡∑(¿ïH¢óQ\∆@@QfÉL2∫(¿ØA_z˚\≈@@≥\Œ¯æ∏º(¿\"©Öí\…\≈@@@Nò0öΩ(¿\’@Û9w\≈@@\„Rï∂∏æ(¿O<g\≈@@Íóà∑Œø(¿3RÔ©ú\ƒ@@|+\‘¿(¿¡çî-\ƒ@@*p≤\r\‹¡(¿Eh\Ê\…\√@@ø\”d\∆\€\¬(¿/àHM\√@@¸\«Bt\ƒ(¿∑¥\Z˜\¬@@ºï%:\À\ƒ(¿\ N?®ã\¬@@hy‹ù\≈(¿≤ª@IÅ¡@@Wya\«(¿u £¡@@òÖvN≥\»(¿˚s—êÒ¿@@Ot]¯¡\…(¿Ho∏è\‹¿@@Bïö=\–\ (¿sº—ì¿@@jà*¸\Œ(¿\Ê#)\Èa¿@@¸Q‘ô{\–(¿kæ*¿@@\≈8\n\—(¿4†ﬁåöø@@J	¡™z\—(¿h@Ω5ø@@ó«öë\—(¿Ñ-v˚¨æ@@\ÈÄ$\Ï\€\—(¿®(Næ@@ıÇOs\“(¿.uê◊ÉΩ@@Ul\Ã\Îà\”(¿øôò.ƒº@@c&Q/¯\‘(¿V∫ªŒÜº@@3á§J\÷(¿âˇ\"hº@@M¿Øë$\ÿ(¿-\–\Óêbº@@Ö]=\Ÿ(¿¨\«}´uº@@\nÅ\\\‚\»\€(¿Åó6 º@@¶c\Œ3ˆ\›(¿≥ôCRΩ@@\Z˘º\‚©\ﬂ(¿∂ilØΩ@@´\À)1\·(¿>¥è¸º@@é\Zl\‚(¿ÛéSt$Ω@@Ωs(CU\‰(¿ç\ÏJ\ÀHΩ@@êüç\\7\Â(¿´\Á§˜çΩ@@êΩ\ﬁ˝Ò\Ê(¿2sÅ\ÀcΩ@@vn⁄å\”\Ë(¿\€¯ï\rΩ@@z∆æd\„\È(¿VÙáfûº@@?\‚W¨\·\Í(¿§ß\»!º@@Fó7á\Î(¿¶[vàª@@\ﬂ\ﬁ5\Ë\Î(¿\œ¿\»Àö∫@@\ƒ†Q∫\Ï(¿®\ƒuå+∫@@ò1kú\Ì(¿î3wºπ@@8†•+\ÿ\Ó(¿±\ﬂ\ÎTπ@@˝ı\n\Ó\Ô(¿OîÑD⁄∏@@_—≠\◊Ù(¿m´Yg∏@@≠˜\Ì∏Ò(¿≈ç[\Ãœ∑@@¯Rx\–\ÏÚ(¿mTßY∑@@Æ\◊Ù††Ù(¿ìS;\√‘∂@@˜ \‰K¯(¿U¡®§N∂@@åâB\À˙(¿2ZGU∂@@∑åı\r¸(¿∑&›ñ»µ@@\„ˇé®P˝(¿ú˚´\«}µ@@ÄÅ @Ü˛(¿¨\‚ç\Ã#µ@@\”¿èj\ÿˇ(¿2Ø#Ÿ¥@@£Vòæ\◊\0)¿ı-s∫¥@@†Y2\«)¿gÅváµ@@E|V)¿k\Êv/µ@@ˆz˜\«{)¿IhÀπµ@@Bò€Ω\‹)¿\\O©¥@@¥\Ã\"[	)¿\ﬁ\Ã\ËG√≥@@´ØÆ\n\‘\n)¿e™`TR≥@@Å\Õ9x&)¿\≈˛≤{Ú≤@@\…\Ã.è\r)¿ò¿≠ªy≤@@åÚ\Ã\Àa)¿\À\÷˙\"°±@@∑\“k≥±)¿Zˆ$∞9±@@\‹,^)¿Ú\'*÷∞@@åÇ\‡Ò\Ì)¿°0(\”h∞@@\‹ˆ=\ÍØ)¿∑öu\∆˜Ø@@v√∂E)¿\Ëj+ˆóØ@@_µ2\·ó\Z)¿\√GƒîHÆ@@G\r6)¿\¬√¥o\Ó≠@@\ÎR#Ù3)¿µ3Lm©≠@@\\\ÊtYL)¿o\rlï`≠@@¶\',ÒÄ\Z)¿ÆaÜ\∆≠@@Å\ËIô\‘)¿3o\’u®¨@@<l\"3)¿Ü©-uê´@@\Ÿ`\·$\Õ)¿™*4À™@@an˜r)¿\ÿe¯O7™@@\ﬁqäé\‰)¿«ÅWÀù©@@\∆O\„\ﬁ¸)¿åÙ¢vø®@@dø\r1)¿W\ÍY ß@@p\Õ˝/)¿üëç`ß@@´ã√ô)¿ä;\ﬁ‰∑¶@@`\«Å )¿F[ïDˆ•@@=\“‡∂∂)¿|\Ôo\–^•@@ó8Ú@d)¿¨\0\ﬂmﬁ§@@∞u©˙)¿\”˘,A§@@N∏W\Ê≠)¿˜ãŸí£@@é={.S)¿8ü:V)£@@\’zø—é)¿W\\ïõ¢@@\0\·Câñ)¿\›(≤\÷P¢@@%\Îptï)¿øDºu˛°@@\√GƒîH\Z)¿O#-ï∑°@@Å∞S¨\Z)¿`\…U,~°@@æ§1ZG)¿ &\·B°@@˘ù&3\ﬁ)¿∑òüö†@@ILP√∑ )¿]\·].\‚ü@@\n/¡©$)¿t\“˚\∆◊û@@ıL/1ñ))¿˝-¯ßû@@¢~∂f+)¿€Ö\Ê:çû@@∑Ò\'*.)¿¿ZµkBû@@C</O/)¿Hm\‚\‰~ù@@\‹eø\Ót/)¿£y\0ã¸ú@@#Ω®\›/)¿\≈;¿ìú@@2t\Ï0)¿wº\…oõ@@&\ﬂlsc2)¿≥\Ísµõ@@}\È\Ì\œE3)¿(û≥Ñö@@∂Go∏è4)¿úº\Ë+ö@@\ﬂQcB\Ã5)¿qVDMÙô@@;pŒà\“6)¿ºí‰πæô@@t\”fúÜ8)¿]\≈\‚7Öô@@ö>;\‡∫:)¿7éXãOô@@Ö8Ñ*=)¿ïÓÆ≥!ô@@ˇ%©L1?)¿‹°a1\Íò@@Ún§lA)¿D˜¨k¥ò@@^Ù§C)¿ñCãl\Áó@@e\ZMF)¿˘gÒÅó@@‘ûísbG)¿e»±ıó@@\€MM\”G)¿$%=≠ñ@@Q˙B\»yG)¿ªE`¨oñ@@\ÊñVC\‚F)¿[x^*6ñ@@≠mä\«EE)¿\Ì\‘\\n0ñ@@∫ÿ¥RD)¿ywd¨6ó@@\Ôp;4,6)¿‹Ñ{eﬁñ@@Ω\·¥\‡5)¿Ñ%Zñ@@F¥Sw5)¿\Ó\\\Èï@@6!≠1\Ë4)¿ôf∫\◊Iï@@ä¨5î\⁄3)¿Ü¨nıî@@¯5í\·2)¿{Ö˜î@@∑(≥A&1)¿#Öñì@@°£U-\È0)¿{àFwì@@ìqådè0)¿≠C9—í@@\n°É.\·0)¿~\»[Æ~í@@.X™x1)¿\rß\Ã\Õ7í@@\'k\‘C42)¿∂,_ó\·ë@@≥\ÏI`3)¿B|`\«ë@@Å\ÍD24)¿l\ndvë@@.\ŒR≤4)¿¨o`r£ê@@¡:é*5)¿¿	Ö8ê@@:!t\–5)¿z\„§0\Ôè@@ª\n)?©6)¿\Ê»≥è@@”Ü\√\“¿7)¿¨:´ˆé@@t}:)¿¢µ¢\Õqé@@œ§M\’=:)¿æ-X™ç@@>v()8)¿ZÅ!´[ç@@Û´9@07)¿\÷;\‹\rç@@9a\¬hV6)¿”ΩN\ÍÀå@@\ŸwEø5)¿|C\·≥uå@@S{m\«4)¿\Ã\ÎàC6å@@\ZyY3)¿éYˆ$å@@©\–D\ÿ0)¿\Ã\—\„ã@@‹üãÜå/)¿Nd\Êóã@@P)îÖ/)¿\‰÷§\€ã@@‡Ω£∆Ñ0)¿∏WÊ≠∫ä@@6\»$#g1)¿\∆nüUfä@@e\·\Îk]2)¿K;5óä@@q„äã3)¿IΩßr⁄â@@•-ÆÒô4)¿\È\Ô•†â@@$F\œ-t5)¿˘÷áıFâ@@Pß<∫6)¿\0{ˆà@@ãﬁ©Ä{6)¿o~\√DÉà@@\√E\Ó\È\Í6)¿!W\ÍYà@@Ø$yÆ7)¿QhY˜èá@@\rq¨ã\€8)¿\0qWØ\"á@@¨p\ÀGR:)¿€§¢±Ü@@W$&®\·;)¿ C\«Ü@@bá1\È\Ô=)¿ñ\Ï\ÿƒÖ@@d;\ﬂOç?)¿:ÆFv•Ö@@^\÷\ƒ_A)¿é\Î\ﬂıôÖ@@x\nπR\œB)¿Fπã0Ö@@\È}\„k\œD)¿M€ø≤“Ñ@@â∑Œø]F)¿Ö\Ì\'c|Ñ@@Ac&Q/H)¿∑|$%=Ñ@@`ù∫ÚI)¿˚v˛É@@o\Ÿ!˛aK)¿\‹\rãQÉ@@:ÆFv•M)¿	PS\À÷Ç@@\√DÉ<M)¿è\ÈåÇ@@éW zRN)¿≤\’ÂîÄÇ@@NM\”gO)¿wÜ©-uÇ@@∫\€ı\“Q)¿f2\œgÇ@@F&\‡\◊HR)¿†\¬§RÇ@@9}=_S)¿m\∆ià*Ç@@ıf\‘|U)¿ßÆ|ñ\ÁÅ@@¿\Í»ë\ŒX)¿\‚>rk“Å@@ÆVc	[)¿vkô«Å@@6\«e\‹\\)¿˛µºrΩÅ@@¯änΩ^)¿ ∂Ùh™Å@@7¶\',Ò`)¿çöØíèÅ@@\Èô^b,c)¿\“S\‰qÅ@@:?\≈q\‡e)¿π\‡˛Ä@@cúø	Öh)¿Ω˝πh»Ä@@a˝ü\√|i)¿:Z’íÄ@@H,πj)¿©lXSYÄ@@¸™\\®¸k)¿\œMõq\ZÄ@@AJ\Ï\⁄\ﬁn)¿≥Bë\Ó@@>Y1\\p)¿Ø\Õ\∆J\Ã@@Ä∏´Wëq)¿\“q5≤+@@Æ¡8∏t)¿(\Ô\„hé~@@\‚x>\Íu)¿≤,ò¯}@@(û≥Ñv)¿ô+ÉjÉ}@@°K8Ùw)¿µ<L˚|@@ëbÄDx)¿*ëD/£|@@ä≠†iy)¿_iN^|@@”†h¿z)¿VGét|@@ı\⁄l¨\ƒ|)¿IJzZ{@@CY¯˙Z)¿w.åÙz@@,Ú\ÎáÿÄ)¿5¥;§z@@úQÛUÚÅ)¿w/˜\…Qz@@w.åÙÇ)¿|Û&\Zz@@;]•ªÉ)¿bÛqm®x@@\„\ﬂg\\8à)¿¥¨˚\«Bx@@úÜ®¬üâ)¿}=_≥\\x@@aã\›>´å)¿(c|òΩx@@røCQ†è)¿\»}´u\‚x@@%\Ë/Ùê)¿qπ5\Èx@@(c|òΩî)¿/á\›wy@@û{óó)¿CY¯˙Zy@@•°F!…ú)¿pA∂,_y@@π\04Jóû)¿\—u\·\Áy@@D˚X¡o£)¿ÚòÅ\ ¯y@@29µ3L•)¿d]\‹Fz@@*\∆˘õP®)¿õí¨\√\—y@@ò//¿>™)¿;ˇvŸØy@@#°-\ÁR¨)¿,g~y@@*ˇZ^πÆ)¿\∆˝G¶Cy@@ç$A∏≤)¿®\„1ïy@@\Z\ÕX¥)¿Ù¶\"\∆z@@B\Œ˚ˇ∏)¿¯4\'/2{@@F^\÷ƒ∫)¿G\Ëg\Íu{@@‰ªî∫dº)¿\\1–µ{@@ıπ⁄ä˝Ω)¿t\Ì\Ë{@@á˚»≠Iø)¿õ.\»|@@ÒÒ	\Ÿy\√)¿ï\rk*}@@7˙ò\ƒ)¿ß!™g~@@6x_ï\≈)¿Ôéå\’~@@Ov3£\≈)¿ìW\Áê@@“´JC\≈)¿∏;k∑]Ä@@mp\"˙µ\≈)¿è7˘-:Å@@1xòˆ\Õ\≈)¿>{.SìÇ@@Æº\‰Ú\«)¿ßZ≥–Ç@@jh∞\…)¿®REÒÇ@@\Ê\Í\«&˘\…)¿ß\Í\Ÿ\\É@@ûµ\€.4\œ)¿;åIÉ@@Ø?âœù\–)¿´>W[±É@@l\‚u˝\“)¿LqU\ŸwÉ@@OYM\◊\’)¿h∞©Û®Ç@@náÜ≈®\€)¿æΩk–óÇ@@ÒÉÛ©c\›)¿y\\TãàÇ@@Òª\Èñ\‚)¿ã¡√¥oÇ@@\rR\‰)¿_{fIÇ@@+0du´\Á)¿˘*8Ç@@\‰J=B\È)¿^Háá0Ç@@<\ÿb∑\œ\Í)¿q≠ˆ∞Ç@@\ﬁrıcì\Ï)¿KÆbÒÅ@@\Ôç!\08\Ó)¿º;2VõÅ@@\ﬁ\»<ÚÛ)¿OWw,∂Å@@n\›\ÕSı)¿ÉjÉ—Å@@g\—;p˜)¿2;ãﬁÅ@@p|\Ìô%˘)¿.\∆¿:éÅ@@¥¨˚\«B¸)¿ª@jÅ@@:ñw\’˛)¿^ª¥\·Ä@@)[$\Ì˛)¿∞êπ2®Ä@@∏;k∑]\0*¿\‘Düè2Ä@@`´ã\√*¿¿ï\Ï\ÿÄ@@ˆ∑\‡ü*¿¸pê\Â@@⁄é©ª≤*¿JV\’\À@@\n0,æ*¿∏îÛ\≈\ﬁ@@\›]gC˛	*¿í\ÀHø@@ì\≈˝G¶*¿©áht@@L˝º©H\r*¿M€ø≤\“~@@A\÷S´Ø*¿	Qæ~@@r3‹Ä\œ*¿¯p\…qß~@@Ñ%Z*¿åÉK\«~@@\Èûuçñ*¿Ä∏´W@@Fó7ák*¿oF\ÕW\…@@©¿\…6p*¿\Ã	\⁄\‰@@\Í\"Ö≤*¿s€æG˝@@§ç#\÷\‚*¿7R∂H\⁄@@H\‡?ˇ*¿˛ò÷¶±@@\ﬁ\Ëc>  *¿\»{\’ Ñ@@B]\¬!*¿\”0|DL@@ñ®©e#*¿bIπ˚@@˛πh\»x$*¿\◊˚çv\‹~@@ÛX32\»%*¿h%≠¯Ü~@@\Œ\ƒt!V\'*¿ê.6≠~@@\…W))*¿1≤dé\Â}@@#IÆÄ**¿=\’!7\√}@@qN`:-*¿˚îc≤∏}@@⁄´èá.*¿ø[≥ï}@@I˜s\nÚ;*¿#Öñ}@@z\Z0H˙<*¿°ÚØ\Âï}@@qhî>*¿•	¶ö}@@?T\Z1≥?*¿VH˘Iµ}@@ıcô~A*¿ö^b,\”}@@\ÍZ{ü™B*¿áø&k\‘}@@ˆ\n\ÓD*¿\¬¯i\‹}@@™”Å¨ßF*¿P9&ã˚}@@x{ÚM*¿\Ï2¸ß~@@\≈7>[O*¿Ô©úˆî~@@\Ë\ÿA%ÆS*¿\"\‡™~@@N>=∂U*¿Éß~@@\‡ÇlYæV*¿®\ZΩ\Z†~@@†‹∂\ÔY*¿ãRB∞™~@@ød\„¡[*¿\Í≥Æ+Ä@@˙\Ì\Î¿9c*¿à˜XéÄ@@\»@û]æe*¿èo\ÔÄ@@.9\Óîf*¿\‡LLbÅ@@\Œ\·Z\Ìag*¿£vø\nÅ@@\Ã*l∏h*¿k\Ã—Å@@x\Ô®1!n*¿Q˙B\»yÅ@@\Ë˜˝õo*¿1@¢	Å@@V-≤ùo*¿a≈©\÷¬Ä@@_D\€1uo*¿Ö^ü@@hØ>˙n*¿v28J^@@ö\Ô\‡\'p*¿õé\0n@@^°ñ±q*¿\næi˙\Ï~@@è·±ü\≈r*¿£ËÅè¡~@@hî.˝s*¿‡†Ω˙x~@@ãC\‰t*¿\„\‡\“1\Á}@@£Y\Ÿ>\‰u*¿∑~˙œö}@@\"ã4Òv*¿`>Y1\\}@@\‡ÚX32x*¿§ãM+}@@•jª	æy*¿9BÚ\Ï|@@øªï%:{*¿\Z\¬1Àû|@@2t|*¿\”\◊¯L|@@\Ë§˜çØ}*¿\œd|@@§m¸â\ ~*¿i™\'Ûèz@@∑¥\Z˜Ä*¿}> àz@@cò¥…Å*¿_	§ƒÆy@@+*ˇZÜ*¿∞pí\Êèy@@∞VÌöà*¿«ÑòK™x@@˚\Ê˛\Íqè*¿ã™_\È|x@@‡Ω£∆Ñê*¿˙B\»yˇw@@Åó6 í*¿h[\Õ:w@@v\‡ú•ï*¿',1607362055,1607362055,NULL,NULL),(4,'Luapula',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\0-\0\0\Ê\È\\QJò=@AÇ\‚«ò\À ¿ü`<Éä=@eQ\ÿE\—\Î ¿#ø~à\rä=@µnÉ\⁄o\Ì ¿F@Ö#Hâ=@˘d\≈pu ¿π˛]ü9É=@\≈V–¥\ƒ˙ ¿¯q4GVÇ=@-µ\ﬁo¥˚ ¿°-\ÁR\\Å=@ı˜Rx\–¸ ¿ó\»g=@›ï]0∏˛ ¿>>!;o=@ïÄòÑ!¿˚Øs\”~=@~T\√~O!¿\—Wêf,~=@àº\Â\Í\«!¿}\"OíÆ}=@|E∑^!¿\»\”ÚW}=@±£q®\ﬂ\r!¿0ûACˇ|=@Û=#\Z!¿ØB\ O™}=@2\ÂCP5\"!¿UΩ¸Nì}=@é={.S#!¿sπ¡Pá}=@Ø!8.\„&!¿\Îò|=@∆Ünˆ*!¿∞v\Á®{=@*U¢\Ï--!¿˘ˆÆA_z=@µ∆†B/!¿ä\ÈB¨˛x=@ú•d91!¿“åE\”u=@üZ}uU8!¿\¬˘‘±Ju=@oÖ\…T9!¿ÜV\'gt=@K\ÀHΩß:!¿É\‡Ò\Ì]s=@ß>êº;!¿¥\Á25	r=@8HàÚ=!¿xEøïp=@É4c\—t>!¿\Ëı\'Òπo=@í]i©?!¿≤^ÇSo=@íÒ+\÷@!¿\∆G\Ân=@,=)ìB!¿jLàπ§n=@F~˝D!¿(*\÷Tn=@òà∑ŒøE!¿\Ï¢ËÅèm=@\r\Z˙\'∏H!¿\Í46l=@çH¬æM!¿˙aÑhk=@ˆ%∂P!¿9Ä~ﬂøi=@fÉL2rV!¿G\Ã\ÏÛi=@`#IÆX!¿\ŒQ\⁄g=@\…&p[!¿\‡ÿ≥\Áf=@\÷µ\¬\\!¿#Öñe=@\·ï$\œı]!¿\‚ !\ d=@é\Ÿ\Î\›_!¿˚t<f†b=@7ßí†b!¿m6Vbûa=@M\‡Ù.f!¿nø|≤b`=@Ov3£m!¿y=ò_=@\ÀÒ[r!¿m±ü^=@`r£\»Zs!¿û#Ω®U=@?9\ns!¿?»≤`\‚S=@≠á/s!¿\’w~QÇR=@3‹Ä\œs!¿X∆ÜnˆO=@\»(œºv!¿JB\"m\„O=@£\…\≈Xw!¿ÄD(bQ=@\≈t!Vú!¿ÇUıÚ;Q=@xôa£¨ü!¿cÏÑó\‡P=@ã\ZL\√°!¿có®\ﬁ\ZP=@˙{)<h¶!¿ùc@ˆzO=@Ù\ﬁÄ´!¿E\Ÿ[\ ˘N=@…í9ñw≠!¿#\‹dTN=@;Qi≥!¿\Ÿ\Î\›\ÔM=@\¬\⁄;\·µ!¿ûz§¡mM=@.X™xπ!¿\rRL=@d[ú•º!¿|}≠KçL=@ˆ$∞9ø!¿\Ï\‹L=@[\Èµ\ŸX¡!¿c|òΩlK=@ÇTäç\√!¿a\⁄9\ÕJ=@¨Uª&§\≈!¿ê‹öt[J=@\—\Œih\«!¿™~•Û\·I=@¥Xä\‰+\…!¿Æ∏8*7I=@\“˛X\À!¿¿Dà+G=@3\¬€É\–!¿Ç\„2nF=@ç$A∏\“!¿ü>¯E=@\Ï\’[\”!¿\÷\„æ\’:E=@ºZ\Ó\Ã\‘!¿>x\Ì“ÜC=@SÕ¨•\ÿ!¿á‡∏åõB=@v\∆˜≈•\⁄!¿kÒ)\0B=@˙aÑh\€!¿òmß≠A=@\"ßØ\Á\€!¿\"nN%?=@d> –ô\‹!¿O?®ã>=@\Îo	¿?\›!¿\⁄\…\‡(y==@s-ZÄ∂\›!¿ıÉ∫H°<=@ıúÙæÒ\›!¿mÀü;=@áP•\ﬁ!¿\ÂÄ]Mû:=@Ògx≥\ﬂ!¿n¬Ω2o9=@í>≠¢\ﬂ!¿\⁄9\Õ5=@,(\ 4\‚!¿†ö≤\”3=@¢Ìò∫+\„!¿á2T\≈T2=@\ÀJìR\–\Â!¿\Á\‡ô\–$1=@\⁄T\›#õ\Î!¿\◊˚çv\‹0=@bôπ¿\Ì!¿\ﬂ¬∫Ò\Ó0=@t\ŒOq!¿\Ó\"LQ.1=@¯â\Ë˜ı!¿T\ƒ\È$[1=@H4Å\"˘!¿\ PS1=@”àô}˚!¿d<J%<1=@ïÇn/i¸!¿Y˜èÖ\Ë0=@qTn¢ñ˛!¿Ä\Ô6oú0=@P≈ç[\Ãˇ!¿\ ƒ≠Ç0=@Æe2\œˇ!¿	•/Ñú/=@\Í{\r¡q\"¿l%tó\ƒ-=@\ÈC‘∑\"¿\‚Èï≤-=@;˝†.R\"¿™\„n-=@∫¢î¨\n\"¿}^Ò\‘#-=@o,(\ \"¿#0\÷70-=@\„˚\‚Rï\"¿˝O˛\Ó-=@,amåù\"¿]¿\À-=@◊•F\Ëg\"¿ú•d9-=@w;S\Ë\"¿\€P1\Œ\ﬂ,=@^ÇSH\"¿|\—/§+=@˜vKr¿\"¿\»Eµà(*=@µ\ﬁo¥\„\"¿k) \Ì(=@ãRB∞™\"¿\Èd©ı~\'=@âï\—\»\Á\"¿\◊Pj/¢%=@]›±\ÿ&\"¿ˆyåÚ\Ã#=@›ï]0∏\"¿\Â)´\Èz\"=@ﬁ™\ÎPM\"¿;¨p\ÀG\"=@e8ûœÄ\Z\"¿¥≠fùÒ!=@¶±˙#\"¿-%\ÀI(!=@l\—¥≠\"¿ö\nÒHº =@\ÕX\‰\◊\"¿^=1 =@VDMÙ˘ \"¿\‡\◊HÑ=@{1î\Ì\"\"¿W\ÍY\ =@EÚï@J$\"¿\Èπ- =@[	\›%q&\"¿ü:V)==@ä:s	\'\"¿∫Ù/Ie=@a5ñ∞&\"¿$cµ˘=@(ö∞\»\'\"¿!Æú=@i\‚\‡I+\"¿yïµMÒ=@\ËÖ;.\"¿9+¢&˙=@\\1–µ/\"¿±l\Êê\‘=@\…\Â?§/\"¿î4Lk=@æ˜70\"¿\'ºß> =@†\›!\≈\01\"¿5$\Ó±Ù!=@\Z\‰.\¬4\"¿\"ƒï≥w\"=@()∞\06\"¿\›\—ˇr-&=@ìE\÷\Z:\"¿µ\ﬂ⁄â&=@◊°öí¨;\"¿]åÅu\'=@˝-¯ß<\"¿·ñè§§\'=@i©º\·<\"¿…ë\Œ¿\»\'=@k}ë–ñ;\"¿Vc	kc(=@R\'†â∞9\"¿ΩTl\Ã\Î(=@q9^Å\Ë9\"¿\r\„n≠)=@ûï¥\‚:\"¿ê\›J\n,=@U¯3ºY;\"¿x`\0\·+=@≤ûZ}u=\"¿ï\÷ˇ9,=@Z\‘\'π\√>\"¿Q¢%èß-=@\\\Á\ﬂ.˚=\"¿Ç\„2n.=@ù∫ÚYû?\"¿y\À’èM.=@\ﬂ¸ÜâA\"¿êø¥®O.=@æ3⁄™$B\"¿Vc	k/=@›≥Æ\—B\"¿Å\\\‚\»1=@\rƒ≤ôC\"¿î§k&\ﬂ0=@æ0ô*E\"¿{OÂ¥ß0=@ló6ñF\"¿úkò°Ò0=@wJ\ÎG\"¿Pmp\"˙1=@\r\‡-êH\"¿†˚rfª2=@$H•\ÿ\—H\"¿?\‡ÅÑ3=@ 	˚vI\"¿\Z\‰.\¬4=@DioÖI\"¿\Ô\…\√B≠5=@˙&MÉ¢I\"¿Ø]\⁄pX6=@ÜKÆbI\"¿>¥è¸6=@v≈åˆH\"¿+MJA∑7=@\Ê\ÃvÖ>H\"¿5\—\Á£8=@\ÂõmnLG\"¿HnM∫-9=@ÿÅsFîF\"¿}ñ\Á¡\›9=@‘ÄA“ßE\"¿v5y\ j:=@Ù¸i£:E\"¿Ògx≥;=@\„Q*\·	E\"¿FñÃ±º;=@.\Z2E\"¿∏\ÃÈ≤ò<=@>ñ>tAE\"¿:ÆFv•==@\ÏjÚîE\"¿pUj>=@\—$±§\‹E\"¿™û\Ã?˙>=@åˆx!F\"¿µ˙\Í™@A=@\Ô\…\√B≠I\"¿$F\œ-tA=@\À;\≈J\"¿†¶ñ≠A=@¡\∆ı\Ô˙L\"¿4\Á\ZB=@˛då≥O\"¿~ç$A∏B=@Q¡\·Q\"¿\ÔVñ\Ë,C=@\“≠£™Q\"¿\·@H0E=@\œK\≈\∆T\"¿˜ ºU\◊E=@cÚò˘V\"¿}\Ê¨O9F=@\ÿ,óç\ŒY\"¿£:\»zF=@;®\ƒuå[\"¿∞Rb\◊F=@$^û\Œ]\"¿z¸ﬁ¶?G=@A	]^\"¿ì9ñw\’G=@∫N#-ï_\"¿¢≤aI=@¿{Gç	a\"¿áâ)xJ=@\ﬁ\Ëc> `\"¿&\‚≠ÛoK=@ÑHÜ[_\"¿.ë\Œ\‡K=@\–\Ô˚_\"¿ú\ƒ ∞rL=@?UÖba\"¿\Î»ë\Œ¿L=@nã2db\"¿*˛\Ôà\nM=@`Z\‘\'πc\"¿ç\ÏJ\ÀHM=@\'K≠˜e\"¿\Â}ÕëM=@≤H\Ô\0g\"¿ã72è¸M=@\Ÿ\\5\œi\"¿{˘ù&3N=@∫.¸\‡|j\"¿%ZÚxN=@\∆o\n+l\"¿ˇ∞•GO=@`\Á¶\Õ8m\"¿[\\\„3\ŸO=@îº:«Äl\"¿\'jinÖP=@sI\’vk\"¿0\⁄r.Q=@RIùÄ&j\"¿\€\ﬂ\ŸΩQ=@)\À«∫h\"¿¥[\Àd8R=@gE\‘Düg\"¿¸ß(R=@ã˚èLáf\"¿˘*8ºT=@+/˘ü¸e\"¿I\ÿ\’\‰U=@˘ˆÆA_j\"¿\–)\»\œFV=@ü\È%\∆2m\"¿Ö\Óí8+V=@ÖñuˇXp\"¿U˜\»\Ê™U=@à\rNr\"¿§´twùU=@-ò¯£®s\"¿µ2\·ó˙U=@˙zæfπt\"¿\‘,\–\ÓêV=@m6Vbûu\"¿8†•+X=@Ec\Ì\Ôlw\"¿g\‘|ï|X=@ÆõR^+y\"¿pîº:\«X=@\Œ«µ°b|\"¿\È)ràX=@sJ@L\¬}\"¿ys∏V{X=@>]›±\ÿ~\"¿¬á-yX=@{h+Ä\"¿T5A\‘}X=@k∂ÚíˇÅ\"¿…¨\ﬁ\·vX=@küé\«Ñ\"¿)∞\0¶X=@\ﬁ\ ùeÜ\"¿q\0˝æW=@j˘Å´<â\"¿:3PW=@IC´ìã\"¿è8d\ÈV=@\‡/fKVç\"¿\œh´í\»V=@-≤ùÔßé\"¿à°\’\…V=@á3øöì\"¿ŒßéUV=@5y\ j∫ñ\"¿πä\≈o\nW=@\÷\‚S\0åó\"¿RπâZöW=@(CUL•ó\"¿¡\Zg\”X=@¢\r¿Dò\"¿>^HááX=@˛&\"\‡ò\"¿π®\≈X=@#[A”ö\"¿≤fdêªX=@≤,ò¯õ\"¿àd»±ıX=@\Ë§˜çØù\"¿˚z\·\ŒY=@´\Á§˜çü\"¿v\ﬁ\∆fGZ=@„•õ\ƒ †\"¿EÒ*kõZ=@\ﬁs`9¢\"¿ıæÒµgZ=@L6l±£\"¿\'k\‘C4Z=@¢búø	•\"¿–òI\‘Z=@og_yê¶\"¿H\√)sÛY=@•û°ºß\"¿\ÿfc%\ÊY=@h\\WÃ®\"¿Rõ8π\ﬂY=@\n¢\Óê™\"¿õ<e5][=@ú¡\ﬂ/Æ\"¿2ZGU\\=@\ËJ™∞\"¿w/˜\…Q\\=@Y\›\Í±\"¿•-ÆÒô\\=@j0\r\√G¥\"¿\»\n~b\\=@\Z¯Q\r˚µ\"¿Tb.\\=@\0oÅ≈∑\"¿\‚w\”-;\\=@Uø\“˘∏\"¿Yä\‰+Å\\=@,ú§˘c∫\"¿nP˚≠ù\\=@` ê°ª\"¿\∆Ç\\=@\≈;¿ìæ\"¿\…W)±[=@˝3É¯¿æ\"¿ï\rk*[=@%!ë∂Òø\"¿U\ŸYZ=@::Z\’\¬\"¿ô*ï\‘Y=@Ö±Ö \≈\"¿yít\Õ\‰W=@S\"â\∆\"¿Ùn,(V=@¸7/N|\≈\"¿-ôcyWU=@¥wF[ï\ƒ\"¿\·ô\–$±T=@¥è¸6\ƒ\"¿W@\‹\’S=@£\Õqn\∆\"¿$\Ó±Ù°S=@˛År€æ\«\"¿w1\ÕtØS=@m˛_u\‰\»\"¿&\Œ5\ÃT=@ÆJ\"˚ \À\"¿iW!\Â\'U=@Oìo+\Õ\"¿ˆ\ÎNwûT=@_&äê\“\"¿µ˘’ëS=@¥ î˜q\‘\"¿ú0a4+S=@`\"\ﬁ:ˇ\÷\"¿Ù5\Àe£S=@≤\÷Pj/\⁄\"¿∞\Âï\ÎmS=@\Èö\…7\€\‹\"¿Y¡oCåS=@\◊4\Ô8E\ﬂ\"¿;]•ªS=@õ˛\ÏGä\‡\"¿ˇ]ü9\ÎS=@üV\—ö\·\"¿£;àù)T=@¥∞ß˛\‚\"¿3∏<\÷T=@ñØ\Àü\Ê\"¿\⁄ ìåúU=@\›y\‚9[\Ë\"¿\n.V\‘`V=@K!êK\È\"¿Rb\◊ˆV=@≤\÷Pj/\Í\"¿\„\√\ÏeW=@e\‚VA\Ï\"¿˘d\≈puX=@ßY†\›!\Ì\"¿4ı∫E`X=@AE’Øt\Ó\"¿\¬j,amX=@ı¯\√\œ\Ô\"¿ôa£¨\ﬂX=@Ùz\ƒ\ËÒ\"¿p_\ŒY=@:vPâÛ\"¿L\Z£uTY=@˙=bÙÙ\"¿7TåÛ7Y=@Ü[\œˆ\"¿Ê≠∫\’X=@Â¥ß\‰ú¯\"¿ıı|\ÕrY=@∂°búø˘\"¿#Ö≤ıY=@åâB\À˙\"¿±2\Z˘ºZ=@‹Ä\œ#¸\"¿ä\„¿´\ÂZ=@\\\∆M\r4ˇ\"¿süàZ=@)\"\√*\ﬁ\0#¿,G\»@Z=@±2\Z˘º#¿ôIÙ2Z=@jMÛéS#¿‹†ˆ[;Y=@|∑y\„#¿Üí…©ùY=@4†ﬁåö#¿µ˚\À\ÓY=@ù\r˘g	#¿5$\Ó±ÙY=@àÑ\Ô˝\r\n#¿^Mû≤öZ=@AIÅ0\r#¿n˚ı\◊[=@\Ÿ|\\*#¿˚@ÚŒ°\\=@¨8\’Zò\r#¿Æ\’ˆB]=@V∫ªŒÜ#¿\Ï1ë\“l^=@àÄC®R#¿inÖ∞\Z_=@T\‡d∏#¿¢ô\'\◊`=@´B±l#¿Ú≥ë\Î¶`=@´!qè•#¿Y•ÙL/a=@öA|`\«#¿,\ÿF<\Ÿa=@\»%é<#¿Ç\≈\·ÃØb=@H\≈ˇQ#¿\Ó\—\Ó#c=@eß\‘E#¿º\Èñ\‚c=@íL\‡#¿YPîid=@B]¬°#¿\∆˜≈•*e=@dY0Ò#¿≥ómß≠e=@\È\’\0•°#¿UÜq7àf=@YO≠æ#¿n\√(g=@ƒ±.n£#¿røCQ†g=@û∂F\„#¿Iıù_îh=@∂†˜\∆#¿\…\«\Ó%i=@#\›\œ)\»#¿ÙãÙj=@K±£q®#¿:3Pk=@æ˜7#¿gúÜ®\¬k=@ΩqRò˜#¿\◊M)Øïl=@\Ã`åH#¿⁄¨˙\\mm=@$Ú]J]#¿Ù\≈ﬁã/n=@\r34û#¿c\'ºo=@π\‡˛~#¿\0\∆3h\Ëo=@\÷t=\—u#¿\ZS∞\∆\Ÿp=@\—\Ëbg#¿∞èN]q=@˝˜\‡µK#¿]lZ)r=@ä[1\–#¿c\Ì\Ôlèr=@}\Œ›Æó#¿rRò˜8s=@&®\·[X#¿|bù*\ﬂs=@4˜êΩ#¿§®3˜êt=@\ƒ^(`;#¿4\€˙`u=@>{.Sì#¿≥ïó¸Ov=@\›\'G¢#¿üÆ\ÓXlw=@vQÙ¿\«#¿0ôÚ!x=@EÅ>ë\'#¿Ü\Ê:ç¥x=@∫¿\Â±f#¿\Ïæcx\Ïw=@å0Eπ4#¿ÅïCãlw=@oùª\Ï#¿\’\'¢_w=@ïF\Ã\ÏÛ #¿c|òΩlw=@n4Ä∑@\"#¿\”\ÿ^zw=@G\Ëg\Íu##¿\Z\‹\÷ûw=@\Ï@1≤$#¿∑’¨3æw=@V\r\¬\‹\Ó%#¿}> àx=@µ˚UÄ\'#¿\ƒC?çw=@©1!\Êí*#¿t)Æ*˚v=@\Ë\ÿA%Æ+#¿\”jH\‹cy=@\√JU/#¿_\ŒQz=@±\n\ÿ.#¿0ù\÷mP{=@ô†Üoa-#¿µ\‡E_A~=@\„åaN\–.#¿\ÍÕ®˘~=@–∂öu\∆/#¿Kë|%Ä=@\∆˙&72#¿~\»[Æ~Ä=@îôÄ_3#¿äV\ÓfÅ=@ï,\'°Ù5#¿n4Ä∑@Ç=@õ7N\nÛ6#¿åÖ!r˙Ç=@Ze¶¥˛6#¿∏ [ñÉ=@I∫fÚ\Õ6#¿UΩ¸NìÖ=@ˆD◊Ö4#¿_≥\\6:á=@Òf\r\ﬁW5#¿\‡ù|zlá=@w\◊Ÿê>#¿éZa˙^á=@ºØ Ö\ ?#¿\”/oùá=@u9% &A#¿@j\'˜á=@]˚B#¿ä\«Eµàà=@`\"ƒïC#¿∞∂- à=@\√~O¨SE#¿-wfÇ\·à=@N\r4üsG#¿ü\È%\∆2â=@2\Ã	\⁄\‰H#¿\€\ﬂ\ŸΩâ=@õ\‚qQ-J#¿2ì®|ä=@\Ô_{fI#¿Ze¶¥˛ä=@ip[[H#¿\Óxìﬂ¢ã=@±˚é\·±G#¿ÌüßÉå=@Ú∞PköG#¿NA~6rç=@	àI∏êG#¿ïÑ^é=@+~©üG#¿≤Ö %ê=@wÇ˝◊πI#¿]S ≥≥ê=@.é\ M\‘J#¿Ww,∂Ië=@TT˝J\ÁK#¿`ù∫Úë=@¡\∆ı\Ô˙L#¿∂ˆ>UÖí=@&U\€MM#¿,H3Mì=@EH\›\ŒN#¿ds\’<Gî=@W[±ø\ÏN#¿^gE‘î=@(ªô—èN#¿∞»Øñ=@\⁄r.\≈M#¿H©Ñ\'Ùñ=@\ŸZ_$¥M#¿÷®áhtó=@ù°∏\„MN#¿ÀÉÙ9ò=@$%=≠N#¿Ù1\Ëò=@\Ô∫/gN#¿πqã˘πô=@|Ä\ÓÀôM#¿A°Gåö=@˙DûL#¿z\¬(õ=@(µ\—vL#¿2ïÒ\Ôõ=@\Ã∞èNM#¿l\Ëf†ú=@G\Â&jiN#¿í∞o\'ù=@¬Ñ—¨lO#¿âx\Î¸€ù=@ˇ>\„¬ÅP#¿W\ÓfÖû=@(a¶\Ì_Q#¿6Ü\Âœü=@¯\›t\ÀQ#¿%\ \ﬁRŒ£=@2ì®|R#¿u\Ãy∆æ§=@:\ ¡lT#¿ÜV\'g(¶=@R(__S#¿¸8ö#+ß=@†R%\ \ﬁR#¿7ãC®=@ú¡\ﬂ/fS#¿F	˙=™=@zT¸\ﬂU#¿¶†\Ÿu´=@\ÊtYLlV#¿\Ì◊ù\Ó<≠=@Åy»îY#¿Û>é\Ê»Æ=@ﬂ¶?˚ëZ#¿;ˇvŸØØ=@*q\„Z#¿\Î»ë\Œ¿∞=@\‰Ötx[#¿A\r\ﬂ¬∫±=@ú\ﬁ\≈˚q[#¿∑{πOé≤=@\À,B±\\#¿ByG≥=@\€e6\»\\#¿ãàbÚ¥=@\Ÿ\Œ˜S\„]#¿s\ÿ}\«¥=@k*ã\¬^#¿¯\ZÇ\„2∂=@\‘\”G\‡_#¿\∆2˝Ò∂=@zè3M\ÿ^#¿åfe˚ê∑=@(d\Áml^#¿r\·@H∏=@K\Õh^#¿\réíW\Á∏=@\Œ7¢{\÷]#¿e\0®\‚∆π=@1C\„â ^#¿˛\'˜é∫=@à\ŸÀ∂\”^#¿%îær∫=@\Ó<`#¿£>+∫=@`∑\Ó\Êa#¿©›Ø|ª=@\·\riT\‡d#¿d\Ã]K»ª=@W≤c#g#¿k∫ûË∫º=@ä\ÀÒ\nDg#¿ÿÄqΩ=@¸8ö#+g#¿ñ_cDæ=@˙%\‚≠Ûg#¿^f\ÿ(ø=@§6qrg#¿Ú\ÏÚ≠ø=@s\◊ÚAg#¿=≠N\Œ¿=@£\…\≈Xg#¿M÷®\√=@˛∫”ù\'f#¿\nÑùb\’\ƒ=@)Zπòe#¿€à\'ªô\≈=@˚\Í™@-f#¿¿\Õ\‚\≈\¬\»=@\„¬Åê,h#¿ÒI\'L\…=@†\ƒ\ÁN∞g#¿¢µ¢\Õ\…=@\Íuã¿Xg#¿Ûë\ÔR\ =@\—\Ê8∑	g#¿t\\ç\ÏJ\À=@uYLl>f#¿¥\…\·ìN\Ã=@D¸√ñe#¿:$µP2\Õ=@æMˆ#e#¿W@\‹\Õ=@&ßvÜ©e#¿˚Y,E\Œ=@\€\–wf#¿aäri¸\Œ=@éHh#¿!í!\«\÷\œ=@J\œÙci#¿Ö\–Aóp\–=@Û≠\Îçj#¿\'K≠˜\—=@Ù\‡\Ó¨\›n#¿\¬\‹\Ó\Â>\—=@°Üoa\›p#¿\¬3°Ib\—=@ò£\«\Ômr#¿ıJYÜ8\“=@äM†x#¿M†àE\”=@æi˙\ÏÄ{#¿Úµgñ\‘=@=ú¿tZ#¿!\ÕX4ù\’=@&S£íÇ#¿\‘\’ãm\÷=@Bx¥qƒÇ#¿≤GW\È\÷=@` ê°É#¿%z\≈r\◊=@#ÖñÖ#¿R~R\Ì\◊=@\À\◊e¯Oá#¿ç¥Tﬁé\ÿ=@Òc\Ã]Kà#¿ñ%:\À,\⁄=@6\Ã\–x\"à#¿3‹Ä\œ\€=@L®\‡Çà#¿ïÒ\Ô3.\‹=@Ù¿\«`≈â#¿`sû	\›=@Òıµ.5ä#¿)?©ˆ\›=@Ö$≥záã#¿\œ.\ﬂ˙∞\ﬁ=@\≈Sè4∏ç#¿¸\„Ωje\ﬁ=@fÖ\"›è#¿\—Á£å∏\‹=@h\Î\‡`oí#¿˚]ÿö≠\‹=@ı,\Â}î#¿Ww,∂I\›=@∞êπ2®ñ#¿N\Ô\‚\›=@%xC\Zò#¿Æªy™C\ﬁ=@¥\Ã\"[ô#¿\∆nüUf\ﬁ=@3\·ó˙yõ#¿\‚Æ^EF\ﬂ=@/®oô”ù#¿a\ZÜèà\·=@y\ŒZü#¿~r \n\‚=@	√Ä%W°#¿n\ﬁ8)\Ã\„=@?¯˘ü#¿¸d\‰=@-≤ù\Ôü#¿ˇvŸØ;\Â=@U¡®§N†#¿\“\ﬂK\·A\Á=@ \‘E\ne°#¿è\«T\∆\Á=@zZùú°#¿1\Î\≈PN\Ë=@Zú1\Ã	¢#¿KêP\·\Ë=@≥%´¢#¿∫ÖÆD†\Í=@5\‘($ô•#¿4ú27\Î=@÷èMÚ#¶#¿\◊\‹\—\Î=@-\Ïiáø¶#¿∏<÷å\Ï=@ÆúΩ3⁄™#¿s\ÿ}\«\Ï=@\Ô\·í\„N±#¿\‡ÄJ\Ì=@4-±2≤#¿o\◊j\Ô=@\Ã_!sΩ#¿ü\"áàõ\Ô=@¢ô\'\◊¿#¿\¬€Éê\Ô=@p\œÛßç\¬#¿\›zM\Ô=@bÅØ\Ë\÷\√#¿\≈5|\Ô=@•æ,\Ì\‘\ƒ#¿¶&¡\“\Ï=@zSë\nc\”#¿\ÊÁÜ¶\Ï\Ï=@?\∆\‹\’#¿Ï§æ,\Ì\Ï=@\ÕX\‰\◊#¿Xrã\ﬂ\Ï=@•e§\ﬁS\Ÿ#¿\‚;1\Î\≈\Ï=@∞71$\'\€#¿^ª¥\·∞\Ï=@\‹h\0oÅ\‹#¿˙\ÓVñ\Ï=@*≠ø%\0\ﬂ#¿<üıf\Ï=@t\ŒOq\‡#¿!#†\¬\Ï=@P5z5@\·#¿¥ëÎ¶î\Î=@n\Óïy\„#¿Û\‰öô\È=@j¶{ù\‘\Á#¿\»|@†3\È=@ZKiˇ\Î#¿\–CmF\È=@~bº\Ó#¿ÒI\'L\È=@Ü:¨p\À\Ô#¿\r6u\È=@ùΩ3⁄™Ù#¿≥∑îÛ\≈\Í=@©£\„jdˇ#¿\ÀÙK\ƒ[\Î=@µSsπ¡\0$¿uU†É\Î=@°ˆ[;Q$¿|bù*\ﬂ\Î=@N—ë\\˛$¿+Ö@.q\Ï=@ ¿\0\¬$¿B\'Ñ∫\Ï=@q:	$¿Û=#\Z\Ì=@D˚X¡o$¿Y6sHj\Ì=@6\Á\‡ô\–$¿4\Ÿ?O\Ó=@æ•ú/ˆ$¿7\ƒxÕ´\Ó=@\0\‰Ñ	£$¿aßX5\Ô=@åı\rLn$¿t\“˚\∆\◊\Ó=@$|\Ôo\–$¿Õëï_\Ó=@\‚∂Ùh\Z$¿Ö∂úKq\Ì=@\Â}Õë$¿à\rN\“\Ï=@EùπáÑ$¿~˝,\Ï=@¨;€§\"$¿zpw\÷n\Î=@â∂c\ÍÆ$$¿\‰áJ#f\Í=@¸ã†1ì($¿+/˘ü¸\È=@EˆAñ+$¿´\Ë\Õ<\È=@\“9?\≈q0$¿M2rˆ\Ë=@ìsb\Ì3$¿\Œ5\Ã\–\Ë=@±4£\Z6$¿Ä;®\Ë=@/\ﬂ˙∞\ﬁ8$¿\np\Ë=@¥∞ß˛:$¿Íóà∑\Œ\Á=@]1#º=@$¿\‡∫bFx\Á=@\Ì\ÿ\ƒ\ÎB$¿>¥è¸\Ê=@l#û\ÏfF$¿\Ôí8+¢\Ê=@%?\‚W¨I$¿±àaá\Â=@\·≥up∞O$¿˙\ÓVñ\Ë\‰=@ï|\Ï.PR$¿!∫ˆ\‰=@\r\„n≠U$¿,+MJA\„=@5\Ó\ÕoòX$¿g_yêû\‚=@=\”KåeZ$¿^ëöv\·=@£Ø \ÕX\\$¿}\Ï.PR\‡=@≤ı\·ò]$¿\«e\‹\‘@\ﬂ=@ZÒ\rÖ\œ^$¿9\'ˆ\–>\ﬁ=@\’!7\√\r`$¿K\Â\Ìß\›=@eqˇë\È`$¿pñí\Â\‹=@8\‹GnMb$¿€áº\Â\Í\€=@d\Î\¬1c$¿\€˙\È?k\⁄=@&˝Ωd$¿xC\Z8\Ÿ=@%\…s}f$¿\\ AÒc\ÿ=@õrÖwπh$¿y;\¬i¡\◊=@\–\Ì%ç\—j$¿kúMG\0\◊=@>≥$@Mm$¿\'N\Ów(\÷=@≈´¨mäo$¿lw\–}\’=@é@ºÆ_p$¿\”€üãÜ\‘=@\Ê\È\\QJp$¿¶^∑\‘=@¢BusÒo$¿ÖÕÆ{\”=@Ò\∆O\„n$¿¥t\”=@e\ZM.n$¿\Î˛±\“=@≥_w∫Ûl$¿äV\Óf\—=@7›≤C¸k$¿àÉÑ(_\–=@\«\‘]\Ÿk$¿	\¬P®\œ=@çF>Øxj$¿m\Á˚©Ò\Œ=@\Ê\Í\«&˘i$¿Ω©HÖ±\Õ=@\Â—ç∞®h$¿\ Iª\—\À=@õT4\÷˛f$¿”æπø\ =@ÉQIùÄf$¿L\√\…=@g,ö\ŒNf$¿ë\r§ãM\«=@>ó©If$¿¸´\«}´\≈=@^\’Y-∞g$¿F\Ì~\‡\√=@J\n,Äi$¿R%ìS\√=@∆Ünˆj$¿è\ƒ\À\”¡=@†R%\ \ﬁj$¿[\Ó\Ã√•=@E|V|$¿\Ó<0Ä§=@FA¯Ü$¿6Ø\Í¨§=@í∞o\'â$¿Mg\'É£=@æL!uã$¿u:êı‘¢=@\Ôt\Áâ\Áå$¿zR&5¥°=@g∏üé$¿º\Á¿rÑ†=@\Ë†K8Ùé$¿\Ô≠HLPü=@Ωp\Á\¬Hè$¿®˝\÷Nîú=@MÖx$^é$¿3díëõ=@a\„˙w}é$¿o≠mö=@˙Ä@g“é$¿\‰¯°“àô=@$d \œ.è$¿	ãä8ùò=@áR{mè$¿„äã£ñ=@\‰1ïÒè$¿w|\”Ùï=@ôcyW=ê$¿Å\–z¯2ï=@ä;\ﬁ‰∑ê$¿≠N\ŒP‹ë=@\…\„i˘Åì$¿$(~åπè=@\Ã(ñ[Zï$¿\Ë€Ç•∫å=@2Ø#Ÿò$¿m\‰∫)\Ââ=@\ÿ-c}õ$¿ã¿X\ﬂ¿à=@\0\·Câñú$¿L«úg\Ïá=@M\‡Ù.û$¿eSÆ.á=@C</Oü$¿q9^Å\ËÖ=@ıÅ\‰ùC°$¿\’v|”Ñ=@£h[Õ¢$¿œû\À\‘$Ñ=@\rƒ≤ô£$¿ã8ùd´É=@√ü\·\Õ\Z§$¿â\“\ﬁ\‡É=@lÀÄ≥î§$¿+¯màÅ=@\‘Fu:ê•$¿?5^∫IÄ=@\“\·!åß$¿ y\ÁPÜ~=@eß\‘E™$¿\ÃbbÛq}=@\—\Õ˛@π≠$¿õ=\–\n}=@´\Á§˜çØ$¿W\"P˝É|=@%?\‚W¨±$¿{ª%9`{=@~\ÂAzä¥$¿¸\0§6qz=@\‚\ \Ÿ;£µ$¿:\\´=\Ïy=@.\ lêI∂$¿ˆ#EdXy=@á5ïEa∑$¿r75\–x=@\»%é<π$¿Z∫Çmx=@A*≈é∆π$¿ô\Ÿ\Á1\ w=@á¶\ÏÙÉ∫$¿+TT˝v=@≥{Ú∞Pª$¿m˝Ùüu=@Pqxµº$¿ˇX´vu=@^\ŸÉkæ$¿\'Ωo|\Ìu=@|a2U¿$¿ˇ=x\Ì\“v=@¡ê’≠û\√$¿[A\”+w=@\‡ÅÑ\≈$¿®ç\Ít w=@F\ÔT¿=\«$¿D˝.l\Õv=@,Dá¿ë\»$¿ìr˜9>v=@©æÛã\Ã$¿≥\—9?\≈u=@1ï~\¬\Ÿ\Õ$¿å°úhWu=@\›xwd¨\Œ$¿yêû\"át=@7\‡Û\√\—$¿=+i\≈7t=@ò4F\Î®\“$¿.»ñ\Âs=@dø\r1\÷$¿øb\rπs=@W\\ïõ\ÿ$¿0+\È~r=@\€3K\‘\‹$¿\"\≈\0â&p=@,\ÿF<\Ÿ\›$¿\¬QÚ\Ío=@\ÂõmnL\ﬂ$¿≠\ﬂLLn=@r¿Æ&O\·$¿ãO0ûm=@ÊØêπ\‚$¿±Nï\Ôm=@ºï%:\À\‰$¿+\‹Úël=@çaN\–&\Á$¿Ωã˜\„ˆk=@®5\Õ;N\È$¿ö$ñîk=@@˙&MÉ\Í$¿Å!´[=k=@`X˛|\Î$¿ºk=@ü\€2\‡\Ï$¿åâBk=@8\⁄q\√\Ô\Ó$¿∑~˙œök=@mésõ$¿eV\Ôp;l=@`ù∫Ú$¿ákµáΩl=@ÛW\»Ù$¿\Œ9x&4m=@[&\√Ò|ˆ$¿_\œ\◊,óm=@¨s\»^˜$¿êKy n=@≠ˆ∞\n¯$¿˚\Ë‘ï\œn=@§®3˜ê¯$¿\€$∂ªo=@ØD†˙˘$¿\≈\0â&Pp=@Ü\«~K˘$¿ÖîüT˚p=@g∫\◊I}˘$¿˝áÙ\€\◊q=@ı/Ieä˘$¿ü`<Ér=@≠àö\ËÛ˘$¿Aö±h:s=@Lç\–\œ\‘˚$¿:#J{És=@\råº¨â˝$¿±ﬁ®¶s=@*ã\¬.ä˛$¿≤c#Øs=@A*≈é\∆%¿	˚vr=@oüUfJ%¿\÷WWjq=@ä¨5î\⁄%¿\◊0C\„âp=@t{Ic%¿bûï¥\‚o=@r\ﬂjù∏%¿Ÿ¥R\‰n=@R∫Ù/I%¿–òI\‘n=@c∏:\0\‚%¿=\Ó\Œ\⁄m=@\–\rM\Ÿ\È%¿od˘Ém=@DLâ$z	%¿D\ﬂ\›\ m=@X)±k%¿$}ZEl=@ÑûÕ™\œ\r%¿>&Rö\Õk=@O!W\ÍY%¿Ÿïñëzk=@6vâ\Í≠%¿+2: 	k=@nM∫-ë%¿ºy™Cnj=@\Z2•%¿\ÁêΩ\ﬁi=@Ö\'Ù˙ì%¿,Iû\Î˚h=@û\–\ÎO\‚%¿∑ºTlh=@\‰≤Û6%¿\Ô\Â>9\nh=@ÒF\Êë? %¿ó\Â\Î2¸g=@fL¡\Zg#%¿}xñ #h=@¨\·\"˜t%%¿©lXSYh=@‘ªx?n\'%¿$∑&›ñh=@â¥ç?Q)%¿p%;6i=@që{∫∫+%¿±¸˘∂`e=@µ˝++M:%¿\œ¿\»Àöd=@\‡\€Ùg?:%¿˘˜d=@≠\¬fÄ:%¿ õ\‰G¸b=@™$\Ô:%¿®W\ 2\ƒa=@A∂,_ó9%¿ê2\‚\–`=@π¸áÙ\€7%¿˜¨k¥`=@\Íwak6%¿RÛUÚ±_=@\nü≠ÉÉ5%¿òät?_=@Dì7¿4%¿4.\…^=@|bù*\ﬂ3%¿B@æÑ\n^=@vå+.é2%¿\—6Æ[=@rÜ\‚é71%¿uÄ\‘Z=@VÚ±ª@1%¿\Œ˝\’\„æY=@P\„\ﬁ¸Ü1%¿6\\ê-W=@\–#ÑG3%¿#˜tu\«V=@óo}Xo4%¿\–)\»\œFV=@•\◊fc%6%¿B@æÑ\nV=@ëEöx7%¿e\0®\‚\∆U=@•üpvk9%¿ó\·?\›@U=@õrÖwπ@%¿â±LøDT=@CY¯˙ZG%¿Ø∞\‡~¿S=@\≈ ¶\\I%¿$∏ë≤ER=@ª+ª`pM%¿qØ\Ã[uQ=@©i\”LO%¿?:u\Â≥P=@@˘ªw\‘P%¿\–dˇ<\rP=@R,∑¥\ZR%¿Ò\‘#\rnO=@c_≤Ò`S%¿êKy N=@^\ŸÉkV%¿∏[ívM=@.ÆÒô\ÏW%¿\’&N\ÓwL=@ê.6≠Z%¿ö$ñîK=@ü°ºè[%¿∏u7OI=@Ö8Ñ*]%¿1XrG=@p\Õ˝/_%¿D¯AcF=@(\‘\”G`%¿?πnJE=@\’\Ì\Ï+b%¿){K9_D=@≠mésc%¿\\ê-\ÀC=@Œ™\œ\’Vd%¿\"UØ≤B=@%\ÊYI+f%¿n˜rüA=@Wyaßh%¿©\€\ŸW@=@Ö¥∆†j%¿í;l\"3?=@ÿúÉgBk%¿H˝ı\n>=@E†˙ël%¿I\÷\·\Ë*==@õ\‰G¸äm%¿æ˜7<=@º≥v€Ön%¿‘õQÛU:=@»îA\’p%¿3ƒ±.n7=@ú\ﬂ0\— u%¿ïõ®•π5=@òæ\◊w%¿T\‰qs2=@\ÿc\"•\Ÿ|%¿±¿Wt\Î1=@Z\Ÿ>\‰-%¿àûîI1=@Gtœ∫FÉ%¿\Ã|?1=@c‘µˆ>Ö%¿á˙]ÿö1=@F\ÕW\…«Ü%¿ù∫ÚY2=@í∞o\'â%¿h\Ã$\Í3=@»∑w\r˙ä%¿\Ó[≠ó3=@\Í\œ~§àå%¿œû\À\‘$4=@Cé≠gè%¿é\È	K<4=@8©0∂ê%¿\"®\ZΩ\Z4=@\Î¨\ÿcí%¿\‰,\Ïiá3=@*8º \"ï%¿ë_?\ƒ3=@\ﬁ\ﬂ4}ñ%¿\0ˇî*Q2=@ûBÆ‘≥ò%¿q\Á\¬H/2=@iè\“\·ô%¿(|∂2=@QlMKú%¿¿îÅ2=@øÚ =Eû%¿∏\nıÙ1=@\ƒABî/†%¿¥\ Li˝1=@R∏Ö\Î°%¿cc^G2=@j4π£%¿∂e¿YJ2=@&´\"\‹d§%¿w¶(ó2=@‹û ±›•%¿4GV~4=@\“\«|@†´%¿Ω\Z†44=@î¡QÚ\Í¨%¿4ª\Ó≠H4=@\›zMØ%¿sÉ°+4=@iß\ÊrÉ±%¿8†•+4=@\·\ÁS«≤%¿¶E}í;4=@X8IÛ«¥%¿∂π1=a%=@ãâ\Õ«µ\…%¿9\Ôˇ\„$=@∫∫c±M\ %¿\„4ÙO$=@\Ô®1!\Ê\ %¿*T7#=@≠\√\—U∫\À%¿\ËO\’\È =@\÷a∞\Ã%¿$(~åπ=@¡oCå\◊\Ã%¿ájJ≤=@\¬j,a\Õ%¿T\«*•g=@ <˜\Œ%¿ªö<e=@5\–|\Œ\›\Œ%¿ZF\Í=ï=@]¡6\‚\…\Œ%¿t	á\ﬁ\Z=@⁄´èá\Œ%¿\‚≠Ûoó=@\ÊtYLl\Œ%¿\Ï1ë\“=@äu™|\œ\–%¿U§\¬\ÿB=@–≥Yıπ\“%¿5B?SØ=@õV\nÅ\‘%¿¿\Ãw=@Äô\Ô\‡\'\÷%¿í\Êèim=@Ù\‹BW\"\ÿ%¿≥(\Ï¢\Ë=@y\ÁPÜ™\ÿ%¿kÒ)\0=@sˆ\Œh´\⁄%¿ ^\◊/\ÿ-=@<¡˛\Î\‹\Ï%¿¯Xéê5=@[{Û%¿\ﬂmU==@Qı+ùˇ%¿èãjQ<=@vß;O<ˇ%¿˝æÛ\‚<=@N∑\Ïˇ\0&¿\ƒ@◊æÄ>=@æ_¥\«&¿\"nN%?=@\Ô∆Ç¬†&¿Ú^µ2\·?=@¥≠fùÒ&¿;\»\Î¡§@=@¡7Mü&¿úà~m˝@=@\„\Zü\…˛	&¿è˚V\Î\ƒA=@[Œ•∏™&¿n\‡\‘)C=@\œL0úk&¿}\È\Ì\œE=@Ù¸i£:&¿˘ÉÅ\ÁF=@J)\Ëˆí&¿≥|]ÜˇH=@˛ö¨Q&¿R\Ì\”ÒòI=@:Z’íé\Z&¿™~•Û\·I=@!;oc≥&¿JF\Œ¬ûJ=@°ª$Œä &¿’íér0K=@•\Ÿ<É!&¿\ﬂ\ﬁ5\ËK=@L5≥ñ\"&¿≠€†ˆ[O=@)\Í\Ã=$$&¿Z\ÿ\”Q=@dœû\À\‘$&¿¬Ñ—¨lS=@´îû\È%&¿»ô&l?U=@∂ˆ>UÖ&&¿]\ZøJV=@1∑{πO&&¿\“\·!åW=@ùJÄ*&&¿í\"ã4Y=@±¿Wt\Î%&¿—ë\\˛CZ=@9≥]°&&¿ï\‘	h\"\\=@\Â∏S:X\'&¿@KW∞ç\\=@™πn(&¿Úaˆ≤\Ì\\=@\Zã¶≥ì)&¿9a\¬hV^=@L8†-&¿R%ìS_=@i˝-¯/&¿¶(ó\∆_=@\Z˙\'∏X1&¿\ﬁJ\n,d=@ˆb(\'\⁄5&¿Ñ,&˛d=@≥|]Üˇ4&¿\ÁR\\Uˆe=@Ö\Ô˝\r\⁄3&¿)x\nπf=@\0\Z•Kˇ2&¿\‰,\Ïiág=@§R\Ïh2&¿\ﬁ8)\Ã{h=@E/£Xn1&¿Ω©HÖ±i=@ﬂà\ÓY\◊0&¿fNó\≈\ƒj=@sÅ\Àc\Õ0&¿%\’?àl=@\·bE\r¶1&¿G\Â&jm=@íîÙ0¥2&¿79|“âl=@∆•*mq&¿XéêÅl=@k∑]hÆ&¿/N|µ£l=@êP\·\Z&¿\\¨®¡l=@ËæúŸÆ&¿ˇ	.V\‘l=@/Ö\Õ&¿Zfä≠l=@\¬5wÙø&¿u\‰Hg`l=@¸ä}&¿<l\"3l=@]ﬂáÉÑ&¿êû\"áàk=@Ò’é\‚\r&¿Ø[\∆˙j=@H¬æùD&¿ïÙ0¥:i=@;8ÿõ\n&¿8Öï\n*f=@n\√(&¿fjº!e=@\Ì∏\·w\”&¿¸\‚Rï∂d=@6\«e\‹&¿1~\Z˜\Êc=@\"5\Ìbö&¿\‚tí≠.c=@\À2êgˇ%¿?\ZNôõc=@æ1\0\«˛%¿\œ:Ø±c=@`sû	˝%¿n⁄å\”e=@π\Î8ˆ%¿L\Z£uTe=@sÇ69Ù%¿¢	±àe=@ß/˙\nÚ%¿\Ìõ˚´\«e=@EbÇ\Zæ\Ì%¿Ù4`êÙe=@\n/¡©\Ï%¿7\0!f=@gc%\ÊY\È%¿h\œej\\=@MK¨å\÷%¿dx\Ïg±\\=@\‚\Â\È\\Q\¬%¿®\0œ†]=@M\Ÿ\Èu¡%¿\0ã¸˙!^=@∫¯€û ¡%¿´Ãî\÷\ﬂ^=@3ç&c¿%¿YM\◊]_=@Áçì¬ºø%¿§à´`=@Vô)≠øΩ%¿¥Xä\‰+a=@úN≤\’\Âº%¿\≈Sè4∏a=@¨\‡∑!∆ª%¿Éi>\"b=@78˝⁄∫%¿\√b‘µˆb=@	l\Œ¡3π%¿\Ô7\⁄q\√c=@\0Rõ8π∑%¿÷´\»\ËÄd=@\Èahur∂%¿ª	æi˙d=@Œâ=¥èµ%¿\–{c\0f=@˚\À\Ó…≥%¿B≤Ä	\‹f=@˘á-=ö≤%¿\…:]•g=@¡8∏tÃ±%¿≠jIGi=@q=\n◊£∞%¿ä[1\–i=@≠§\ﬂP∞%¿\·∑!\∆kj=@ﬁë±\⁄¸Ø%¿£±ˆw∂k=@∫fÚ\Õ6Ø%¿oõ©èl=@PèmpÆ%¿|öìm=@K<†l ≠%¿¶µilØm=@\ÔÀô\Ì\n≠%¿æP¿v0n=@óåc${¨%¿Ä\rào=@-\Íì\‹a´%¿≤∫\’o=@ˇ\\4d<™%¿¥\Ê\«_Zp=@\‰qs*©%¿\Èö\…7\€p=@≥\Ì¥5\"®%¿\‚!åü\∆q=@]\ﬁÆ’¶%¿5¥ÿÄt=@ö`8\◊0£%¿\„¡ª}v=@¥Xä\‰+°%¿S\ÁQÒw=@†Q∫Ùü%¿”°\”Ûnx=@-≤ùÔßû%¿gÄ≤ey=@¸T\Zàù%¿s+Ñ\’Xz=@Ù1\Ëú%¿/o\◊j{=@w-!Ùú%¿ˆ5C™|=@RcB\Ã%ù%¿\0Sh}=@\0\·Câñú%¿n\›\ÕS~=@\Z¿[ Aô%¿l¥\Ë°~=@˝ª>s÷ó%¿Kr¿Æ&=@\rèR	ó%¿‚è¢\Œ\‹=@\Á\∆ÙÑ%ñ%¿\Ëg\ÍuãÄ=@t¥™%ï%¿i∆¢\ÈÄ=@\‰¢ZDì%¿\»\Œ\€\ÿ\ÏÄ=@∂‰†Ñë%¿—ïTˇÄ=@{\›\"0÷è%¿I-îLNÅ=@^ª\Ôé%¿é\Á3†Ç=@ı††≠å%¿2¨\‚çÃÉ=@\»\\Tå%¿\‡,%\ÀIÑ=@ñ\œÚ<∏ã%¿(Ù˙ì¯Ñ=@1\Ôq¶	ã%¿$\ÌFÛÖ=@\Ë£\Áä%¿P\ﬂ2ßÀÜ=@\Õ\ ˆ!oâ%¿˘ıCà=@ò¢\\\Zøà%¿å∫\÷ﬁßä=@f-§˝á%¿rm®\Áã=@b1\ÍZ{á%¿\…°fHç=@ôú\⁄¶Ü%¿73˙\—pé=@ùª\Ï◊Ö%¿v\‘~kè=@ÜZ”º\„Ñ%¿¿YJñìê=@6Œ¶#ÄÉ%¿F¥Swë=@=|ô(BÇ%¿N\–&áOí=@†¿;˘ÙÄ%¿cB\Ã%Uì=@Ñ∑! %¿Zõ\∆ˆZî=@*¨TPQ}%¿#ˆ	†ï=@,\◊\€f*|%¿¨èáæªï=@X7\ﬁ{%¿\n¢\Óêñ=@%Æc\\qy%¿kÛˇ™#ó=@\Ÿ\ÏHıùw%¿«ü®lXó=@uv28Jv%¿¿¥®Oró=@3¿Ÿ≤t%¿_a¡˝Äó=@`èâîfs%¿\√‘ñ:»ó=@,Iû\Î˚p%¿rÜ\‚é7ô=@≠˘Òóm%¿Çp\Íô=@í\Á˙>l%¿ç\Ìµ†˜ö=@\‰˘®7k%¿ñYÑb+ú=@7m\∆iàj%¿Õê*äWù=@T¸\ﬂj%¿†‹∂\Ôù=@\Èc> \–i%¿|∂ˆû=@\Á\»\ /Éi%¿#ˆ	††=@\·(yuéi%¿{◊†/Ω°=@\‰€ª}i%¿¡çî-í¢=@aâîMi%¿N∂Å;P£=@Å≥î,\'i%¿CÄ\rà§=@:ì6U˜h%¿\Ô¨\›v°•=@±˜\‚ãˆh%¿\»	F≥¶=@2\√Fi%¿\“ˇr-Z®=@jLàπ§j%¿C\‚K™=@èo\Ô\Zl%¿˚\Â∂}´=@ÙPoFm%¿\Î^fÿ¨=@ßYO≠n%¿úQÛUÚ≠=@.W?6\…o%¿||BvﬁÆ=@√Ä%W±p%¿§•ÚvÑª=@\r©¢xï}%¿|úi\¬ˆª=@\«ÛPo~%¿O[#Çqº=@\Œ5\Ã–Ä%¿uí≠.ßº=@R\’Q˜Å%¿y7Ræ=@∞8ú˘’Ñ%¿i7˙ò¿=@\ŸZ_$¥Ö%¿%\Ë/Ù¿=@T®n.˛Ü%¿lw\–}¡=@U§\¬\ÿBà%¿$\'∑\n\¬=@*Wxóãà%¿ë*äWY\√=@ÖD\⁄∆üà%¿%!ë∂Ò\√=@¯Ac&â%¿¸4\Ó\Õo\ƒ=@^Ä}t\Íä%¿\—äX\ƒ\ƒ=@A\’\Ë\’\0ç%¿_b,\”/\≈=@2ë\“lè%¿od˘É\≈=@CÄ\ràê%¿±£q®\ﬂ\≈=@ÖÃïAµë%¿]˝\ÿ$?\∆=@b¢A\nûí%¿ê˜™ï	\«=@(µ\—vî%¿(\Ô\„hé\»=@?q\0˝ñ%¿?\Êù\…=@•\›\Ëc>ò%¿S\"â\ =@:œÑ&ô%¿\„«òªñ\Ã=@ï\rk*õ%¿\”Ù\Ÿ\◊\Õ=@\œg@Ωù%¿ã¡√¥o\Œ=@\»Eµà(û%¿\≈9\Í\Ë∏\Œ=@Ù˛?Nò†%¿\›A\ÏL°\œ=@cAaP¶°%¿sû±/\Ÿ\–=@,ú§°%¿™π\‹`®\”=@7m\∆ià¢%¿†\·\Õ\Zº\”=@pD˜¨k§%¿\œ:Ø±\”=@◊£p=\nß%¿eâ\Œ2ã\‘=@:<ÑÒ”®%¿?˛“¢>\’=@TpxAD™%¿ØB\ O™\’=@1\Ï0&≠%¿ëFN∂\’=@¯änΩÆ%¿¢µ¢\Õ\’=@\ÿÒ_ ∞%¿K<†l\ \’=@\Z®åü±%¿\Ïm3\‚\’=@*˝Ñ≥[≥%¿!Êí™\Ì\÷=@ä\0ßwÒ∂%¿(Hlw\ÿ=@F\Œ¬ûv∏%¿\√§R\Ï\ÿ=@éD¡åπ%¿i¢\⁄=@«ºé8dª%¿\ÂÚ\“o\€=@\≈_—≠ø%¿\À2êg\Á=@\Áp≠ˆ∞ˇ%¿∞v\Á®\Á=@çúÖ=\Ì\0&¿p?\‡Å\Ë=@÷çwG\∆&¿G ^\◊/\Ë=@\rˇ\È\n&¿9πﬂ°(\Ë=@2>\Ã^∂&¿äwÄ\'-\Ë=@rP\¬L\€&¿\Â*ø)\Ë=@\÷ãmR	&¿f2\œg\Ë=@\Ô\„hé¨&¿!í!\«\÷\œ=@\ÈÛQF\\\–&¿ì®|ö\œ=@ ©ùaj\”&¿™õã\œ=@\ﬁZ&\√Ò\‘&¿§\¬\ÿBê\œ=@#ıû\ i\◊&¿ã8ùd´\œ=@øï\Ï\ÿ\ÿ&¿=}˛\œ=@\ﬁ\ÔU+\€&¿u\‰Hg`\–=@ìo∂π1\›&¿>wÇ˝\◊\—=@åL¿Øë\‹&¿ﬁìáÖZ\ﬂ=@Qi\ƒ\Ã>ø&¿õV\nÅ\‰=@Wòæ\◊¥&¿PVW\Ï=@ˇ\È\nº£&¿]•ª\Îl¯=@˚Zó\Z°á&¿”Ñ\Ì\'c\0>@´\Á§˜çw&¿jj\ŸZ_>@\Ëyítu&¿∞u©˙]>@Cr2q´\‡&¿Ÿ∞¶≤(x>@\\\÷µ\'¿% &\·Br>@p#eã§\'¿∞™^~ßq>@9Ú@dë\'¿ÚD\Á\·p>@\ÀK˛\'\'¿\ﬁ	äo>@\rraä\"\'¿Æ\◊g\Œn>@||Bv\ﬁ&\'¿§30Ú≤n>@\ﬂN\"¬ø(\'¿(—í\«\”n>@\ﬂ˛\\4d,\'¿)x\nπn>@5ñ∞6\∆.\'¿ÉlYæ.o>@hì\√\'ù0\'¿Sx\–\Ï∫o>@Ö¥∆†2\'¿IÅ0ep>@\ƒxÕ´:3\'¿0\ÿ\r\€q>@˜≥Bë6\'¿G≤Åtq>@⁄®N:\'¿Éˆ\Í\„q>@\Ã&¿∞<\'¿\—\Ê8∑	S>@¢DKOÉ\'¿Éâ?ä:?>@+¯mà°\'¿=`2\Âˇ=@ˇ>\„¬π\'¿üs∑\Î•\›=@\€6åÇ\‡\…\'¿MÜ\„˘\‹=@âÍ≠Å≠\ \'¿O\Î6®˝\⁄=@}\È\Ì\œE\À\'¿ä\‡+\Ÿ=@˚uß;O\Ã\'¿Ku/3\ÿ=@üt\"¡\Ã\'¿`\Â\–\"\€\’=@\—\À\ÿ\–\Õ\'¿Å\–z¯2\’=@\Í≥Æ+\Œ\'¿bûï¥\‚\”=@Ç\‚«òª\Œ\'¿òQ,∑¥\“=@ΩS˜<\œ\'¿´∞\‡Ç\–=@¢\Ÿ:8\–\'¿!í!\«\÷\œ=@]•ª\Îl\–\'¿yÆ\Ô\√A\Œ=@\ﬂm\ﬁ8\—\'¿kQL\ﬁ\Ã=@\Ó%ç\—:\“\'¿eˇ<\r\Ã=@ä=¥è\‘\'¿\ÌÄ\Îä\Õ=@˛\”\r\ÿ\'¿\"rl\Õ=@(a¶\Ì_\Ÿ\'¿Ûgö∞\Õ=@\€¡à}\⁄\'¿Åq\Â\Ï\Õ=@-$`ty\€\'¿æ¢[Ø\È\Õ=@¶Ä¥ˇ\ﬁ\'¿π\ZŸïñ\Õ=@\◊¡¡\ﬁ\ƒ\‡\'¿\Œˇ´é\Õ=@*1	\‚\'¿¡~˛{\Ã=@%ZÚx\‚\'¿Yk(µ\À=@\‘,\–\Óê\‚\'¿ÇV`\»\Í\ =@º±†0(\„\'¿àòN\Î\ =@†m5\Î\‰\'¿ÚØ$y\ =@|\”Ù\Ÿ\Á\'¿@\ﬂ,\’\…=@F|\'fΩ\Ë\'¿ÆfùÒ}\…=@äY/Ür\Í\'¿ÚŒ°U\…=@ôbÇé\Ó\'¿Q.ç_x\…=@&\Z§\‡Ò\'¿ê\ŸYÙN\…=@\«\ŸtpÛ\'¿\€˜®ø^\…=@p\ÈòÛåı\'¿\Ów(\nÙ\…=@%w\ÿDfˆ\'¿{1î\Ì\ =@fÖ\"\›˜\'¿\«):í\À\À=@\r34û˙\'¿2rˆ¥\À=@\“S\‰q˚\'¿äY/Ür\ =@;\‡∫bF\0(¿\\>íí\ =@\Ìù\—V%(¿\r\ﬁW\ÂB\…=@=\r$}(¿Xc\'º\»=@\"¬ø\Z(¿ò\‹(≤\÷\»=@Hk:!(¿ïa\‹\r¢\…=@3QÑ\‘\Ì(¿!ÆúΩ3\ =@Ç\Ês\Óv(¿÷èMÚ#\ =@9\’ZòÖ(¿QfÉL2\ =@=µ˙\Í™(¿î•\÷˚ç\ =@\Õ√πÜ	(¿\Í\‡fÒ\ =@x≥\Ô´\n(¿8N\nÛ\À=@æ˙x\Ëª(¿ut\\ç\Ï\ =@˝2W\r(¿Øx\Íë\À=@2:=\Ô(¿%ÅïC\À=@ö\Ô\‡\'(¿ù•Ω¡\À=@Y\¬\⁄;(¿Ÿ∞¶≤(\Ã=@K\\«∏\‚(¿\0tò//\Ã=@Z\ÿ\”(¿\Œ¬ûv¯\À=@7p\Íî(¿oc≥#\’\À=@+Ω6+(¿R`L\Ã=@\ ˚8ö#(¿\⁄\0l@Ñ\Ã=@lÀÄ≥î(¿é≤~31\Õ=@Õí\05µ(¿\Êì\√\’\Õ=@£\rß\Ã(¿\œ0µ•\Œ=@F\ÔT¿=(¿b\◊ˆvK\Œ=@\‚ÃØ\Ê\0!(¿º\…o\—\…\Œ=@9F≤G®!(¿`\…U,~\œ=@CêÉf\"(¿S<.™E\–=@´í\»>\»\"(¿¡oCå\◊\–=@a8\◊0C#(¿/£Xni\—=@;V)=\”#(¿}Àú.ã\—=@ZGUD%(¿âóßs\—=@u∞˛\œa&(¿^-wfÇ\—=@u=\—u\·\'(¿\ O™}:\“=@5\Ó\Õoò((¿\Ï\ÏÜm\”=@j¢\œG)(¿ˇók\—\‘=@&ç\—:™*(¿Ñ\Ÿñ\”=@%vmo∑,(¿\› µâ\”=@ñÈóà∑.(¿\÷\ZJ\ÌE\‘=@ø∑\È\œ.(¿	2*\’=@\Ó^Óì£0(¿K\Á√≥\’=@¢ÒD\Á1(¿1\÷q¸\‘=@B&93(¿w;S\Ë\‘=@\Ê≤\—9?5(¿Sv˙A]\‘=@\0≠˘Òó6(¿¯˛\Ì\’\”=@ÄHø}8(¿isú€Ñ\”=@ùÅëó59(¿˚\Ë‘ï\œ\“=@\”\⁄4∂\◊:(¿0\‘aÖ[\“=@M-[\Îã<(¿4Jó˛\—=@^ª\Ô>(¿Üí…©ù\—=@Å\Ïı\Óè?(¿~Wˇ[\—=@]¬°∑x@(¿\n\ÿF\–=@G\Ëg\ÍuC(¿ˆ\n\Ó\–=@º≠Ù\⁄lD(¿\ƒxÕ´:\œ=@\“nÙ1H(¿Ω´0\—=@§R\ÏhJ(¿öµêˆ\œ=@G…´sL(¿_\Ì(\ŒQ\œ=@mÆö\ÁàL(¿\„5Ø\Í¨\Œ=@´\ÃC¶L(¿tïÓÆ≥\Õ=@9∑	˜\ L(¿Âπæ\Õ=@\€˘~jºL(¿iE,b\Ã=@âBÀ∫L(¿jÜTQº\ =@æ\ﬁ˝Ò^M(¿£\Õqn\ =@˜Ø¨4)M(¿˜\Èx\Ã@\…=@\0˛)U¢L(¿N\Ów(\n\»=@±3Ö\ŒK(¿QÉi>\∆=@b\ÿaL˙K(¿?\…6ë¡=@Q\ÿE\—O(¿9D‹úæ=@?\∆‹µÑT(¿B]§Pæ=@\‡º8Ò\’V(¿}\"OíÆΩ=@_]®\≈X(¿\Áâ\ÁlΩ=@\Ó\Ï+\“[(¿\Ô\0OZ∏º=@àd»±ı\\(¿\–\Ô˚ª=@è6éXã_(¿S>U£ª=@\È\r˜ë[c(¿>v()º=@è4∏≠-d(¿\‡⁄âíêº=@m;mçf(¿.W?6…ª=@º\"¯\ﬂJf(¿6r›îÚ∫=@LqU\Ÿwe(¿±ã¢>∫=@µ˚UÄ\Ôf(¿Ú”∏7øπ=@%´\Í\Âg(¿>î∏=@Ω«ô&lg(¿õ\„\‹&‹∑=@õsLh(¿π¸áÙ€∑=@∂¯\0\„i(¿U¡®§N∏=@öÏüßk(¿∫,&6∑=@\«ÛPon(¿e©ı~£µ=@ßÎâÆo(¿¨ã\€h\0≥=@!=Eo(¿%îærÆ=@í\·\n(t(¿\‰°\Ône≠=@\œÛßç\Ít(¿Ú≤&¯™=@\—Aóp\Ëu(¿w¯k≤F©=@ıπ⁄ä˝u(¿ôJ?\·\Ï¶=@nﬂ£˛zu(¿ù\÷mP˚•=@k~¸•Eu(¿…™7•=@\ƒËπÖÆt(¿~Vô)≠£=@(ú\›Z&s(¿3˘fõ£=@l%tó\ƒq(¿ﬂ¶?˚ë¢=@ê˜™ï	o(¿µ˙\Í™@°=@X\‚eSn(¿¬§¯¯Ñ†=@kD0.m(¿>œü6™ü=@f\À-≠n(¿Y\‡+∫ıû=@∞å\ÿo(¿eéÆ“ù=@.9\Óîn(¿ìo∂π1ù=@zlÀÄ≥l(¿\¬N±jú=@\·$\Õ\”j(¿õ:èäˇõ=@â#Di(¿åI/Öõ=@Ütx\„g(¿ÕÆ{+õ=@\‡\ÎT˘f(¿\⁄XâyVö=@ùÛSf(¿@•JîΩô=@§\¬\ÿBêc(¿2!Êí™ô=@>\"¶Db(¿±mQfÉò=@-]¡6\‚a(¿â	j¯ñ=@\‡üR%b(¿F\œ-t%ñ=@ûö\À\rÜb(¿çöØíèï=@-AF@Öc(¿ \—!pî=@ú¡\ﬂ/fc(¿û%\»î=@r\ﬁˇ\«a(¿µ4∑Bî=@\»$#ga_(¿ÉlYæ.ì=@Ö\œ\÷¡¡^(¿#Ω®›Øí=@/∞å`(¿V-í=@ö&l?c(¿òP¡\·ë=@[\Ô7\⁄qc(¿¨TPQıè=@\”i\›e(¿\ƒz£Vòé=@eo)\Áãe(¿od˘Éç=@≠i\ﬁqäf(¿,amåùå=@\ÓA»óh(¿m©Éºå=@/O\ÁäRj(¿!âóßã=@\◊l\Â%ˇk(¿ê1w-!ã=@z\ƒ\Ëπm(¿∑\“k≥±ä=@\ÿ\ÿ%™∑n(¿\'˜;ä=@)îÖØo(¿\–EC∆£à=@\»C\ﬂ\›\ r(¿ˇzÖ˜á=@°Ω˙x\Ës(¿ó\‰Ä]MÜ=@;s	\ﬂs(¿\·\—\∆kÖ=@ìsb\Ìs(¿¸ˇ8a¬Ñ=@\ÂI\'t(¿\‘\—q5≤É=@¯6˝Ÿèt(¿Ü\»\È\Î˘Ç=@π9ï\0u(¿Ûê)Ç=@õ.»ñu(¿üXß\ ˜Ä=@`<ÉÜv(¿CÀ∫,Ä=@õ´\Ê9\"w(¿¯P¢%è=@¶Å’∞w(¿P\¬L€ø~=@\—x\"àÛx(¿èå\’\Êˇ}=@˜\Á¢!\„y(¿vl\‚u}=@\‰∫)\Âµz(¿\’Í´´}=@àKé;•{(¿˘ÉÅ\Á\ﬁ{=@_∑åı}(¿:Ãó`{=@\›`®\√\n(¿w.åÙz=@\∆3hËüÄ(¿\‘\Í\"Öz=@¿=œü6Ç(¿!\ËhUKz=@8Ωã˜É(¿r2q´ z=@ü´≠\ÿ_Ü(¿N\Ô\‚y=@Çëó5±à(¿rn\Óïy=@\”fúÜ®ä(¿Úî\’t=y=@\“\ZÉNç(¿Mg\'É£x=@˙¸\·\Áè(¿5\«ex=@º—ì2ë(¿\Î≤\◊w=@\–D\ÿÙí(¿ôÑyw=@LTo\rlï(¿üq\·@Hv=@\÷\≈m4Äó(¿\»\“≈¶u=@\Î˛±ö(¿W±¯Mau=@≥ôCRù(¿2\ 3/áu=@LKü(¿î3wºu=@ÙÜ˚»≠°(¿/ãâ\Õ\«u=@èr0õ\0£(¿{ø—év=@/0+\È¶(¿FC∆£Tv=@g∫\◊I}©(¿\œÙcôv=@∂h\⁄V´(¿c\0é=w=@T\≈T˙	Ø(¿Ü∆§øw=@\‚|~±(¿\Œ¸jx=@\ÀHΩßr≤(¿\€o\ÌDIx=@àÖZ”º≥(¿Ü\…T¡®x=@3¡pÆa∂(¿è\Zb.y=@+\¬MFïπ(¿®©eky=@´ó\ﬂi2ª(¿O\‹Û¸y=@\ﬁwè˝º(¿\≈ˇQ°z=@2t\Ï†ø(¿\‘-¨{=@í\Í;ø(¡(¿˘ÉÅ\Á\ﬁ{=@Û¸\ƒ\ƒ(¿@ø\Ôﬂº|=@[C©Ωà\∆(¿Q1\ŒﬂÑ~=@æâ!9ô\»(¿≠æ∫*P=@—≠\◊Ù†\»(¿VDMÙ˘Ä=@S	O\Ëı\«(¿1}Ø!8Ç=@^ÉæÙˆ\«(¿¡X\ﬂ¿\‰Ç=@JŒâ=¥\«(¿¥À∑>¨É=@ç\'Ç8\«(¿\Ã\‘$xCÜ=@\ 3/á\›\«(¿Y\·&£Ü=@¯Q\r˚=\…(¿ô÷¶±ΩÜ=@m\‚\‰~á\ (¿ì6U˜»Ü=@\0\„4\Ã(¿§aQá=@,ö\ŒN\œ(¿#û\ÏfFá=@õ9$µP\“(¿\‚Æ^EFá=@Òün†¿\”(¿˝I|\Óá=@3\‚\–(\’(¿~p>u¨Ü=@\«\÷3Ñc\÷(¿˚ë9Ü=@Ç\„2nj\ÿ(¿\ﬁ;jLàÖ=@\√1%\⁄(¿\rq¨ã€Ñ=@˜\"⁄é©\€(¿CV∏\ÂÉ=@M\‹*àÅ\ﬁ(¿\"UØ≤Ç=@\— Ω¿¨\‡(¿S£í:Å=@\≈\Ê\„\⁄P\·(¿é∞®à\”}=@·∂∂º\‰(¿1#º=}=@Ω\·¥\‡\Â(¿r˚\Âì{=@}≠Kç\–\Á(¿P9&ã˚w=@É\ﬁC\0\Ë(¿Ùâ<I∫r=@á\‹7\‡\„(¿S\\Uˆ]m=@]˚\‚(¿¸˛Õãk=@6X8IÛ\ﬂ(¿/3lîi=@Úz0)>\ﬁ(¿Ø\Õ\∆J\Ãg=@±ø\Ïû<\‹(¿\ÔXlìäf=@\‚ëxy\⁄(¿Úw\Ô®1e=@çôDΩ\ÿ(¿,amåù`=@0πQd≠\—(¿j\€0\nÇ_=@q¨ã\€h\–(¿Ù\Ô9\\=@i\·≤\nõ\—(¿\ŒR≤úÑZ=@\› µâ\”(¿L˚\Ê˛\ÍY=@r1\÷q\‘(¿ˇ[…éY=@\ÌI`s\÷(¿º—ì2Y=@¿Dà+\◊(¿]¬°∑X=@\‚\‰~á¢\ÿ(¿\ﬂ\ﬁ5\ËW=@¶õ\ƒ ∞\⁄(¿∑µÖ\Á•V=@≠á/\€(¿3∏<\÷T=@¯\‚ãˆx\Ÿ(¿\'§5ùT=@ÜÆD†˙\◊(¿Øò\ﬁT=@yGsd\’(¿|a2U0R=@µ®Orá\’(¿\ÂZH¿P=@QlMK\‘(¿V\‘`\ZÜO=@+æ°\Ÿ\“(¿N>=∂M=@A\r\ﬂ¬∫\—(¿\È‘ï\œÚL=@µm\—(¿∑*â\ÏÉL=@í@ÉMù\œ(¿ákµáΩL=@(N>=\Œ(¿«É-v˚L=@\ÍB¨˛\À(¿\"7\√\r¯L=@‹Éê/\…(¿Ña¿í´L=@£ZDì\«(¿\«◊ûYL=@¸¢˝\≈(¿†3iSuK=@\’Y-∞\«\ƒ(¿ˆ`R||J=@\Õ˝/\◊\¬(¿\À-≠Ü\ƒI=@uV\Ï1¡(¿=c_≤ÒH=@´ˆòH¡(¿PçónG=@Õ≠Vc¡(¿~\ÂAzäD=@@ø\Ôﬂº¿(¿\Zﬁ¨¡˚B=@\„ç\Ã#¿(¿˝¡¿s\ÔA=@[\Ìa/¿(¿∞\…\ZıA=@À¢∞ã¢ø(¿Xrã\ﬂ<=@\‡M∑\Ïø(¿ºñêz:=@tFîˆø(¿?\Âò,\Ó7=@\Ó\—Z—æ(¿:\Ë5=@[≤*\¬Mæ(¿H\Z\‹\÷2=@åe˙%\‚Ω(¿}\Ï.PR0=@!ÆúΩ(¿ÆFv•e,=@2sÅ\ÀcΩ(¿VE∏…®*=@d\"•\Ÿ<æ(¿≠ø%\0ˇ(=@@æÑ\nø(¿≤KTo\r(=@˘\‹	ˆ_ø(¿\ÿıv\√&=@\«,{¿(¿\ﬁu6\‰ü%=@Åx]ø¿(¿\ÂÚw\Ô$=@\‰-W?6¡(¿\–\“l#=@e˝fb\¬(¿ñ?\ﬂ,!=@5õ\«a0\«(¿5ñ∞6\∆=@{Ç\ƒv˜\»(¿ó6ñ=@˚w}\Ê¨\«(¿\‹\⁄\¬ÛR=@MJA∑ó\ƒ(¿@¢C\‡=@yë	¯5\¬(¿aQßì=@\Ÿ\"i7˙¿(¿-Õ≠V=@G\»@û]æ(¿∆£T\¬\Z=@\Âa°\÷4ø(¿A◊æÄ^=@_\Ì(\ŒQø(¿i\Íwa=@h\Ã$\Íø(¿P\ﬂ2ß\À=@Ù\·YÇå¿(¿\Z\‹\÷û=@á\·#bJ\ƒ(¿]Ot]¯=@){K9_\ƒ(¿”Ü\√\“¿=@ˆ\Ì$\"¸\√(¿˙`=@¸6\ƒx\Õ\√(¿∂Å;Pß=@¿îÅ\√(¿/¡©$=@1{\Ÿv\⁄\¬(¿2 {Ω˚=@¿≥=z√Ω(¿\"ƒï≥=@~åâ∫(¿Ä}t\Í\ =@r\ƒZ|\n∏(¿\ÓC\ﬁrı=@\ÁR\\Uˆµ(¿G\Êë?=@ú5x_ï≥(¿;s	\ﬂ=@û	MK≤(¿$d \œ.=@Öñuˇ∞(¿Ù4`êÙ=@Û\»<Ø(¿\Œ4a˚\…=@•\ﬂP¯¨(¿!î˜q4=@n2™\„¶(¿æP¿v0=@iˇ¨U£(¿wÇ˝◊π=@ßx\\Tã†(¿{¡ß9y=@\‘c[úù(¿]®¸ky=@ôùûwõ(¿\€èãj=@Û:\‚ò(¿ \nfL=@ú27ﬂàñ(¿üísb=@Ω\‚©G\Zî(¿~éèg\0=@∫2®68ë(¿âBÀ∫ˇ<@áá0~\Zè(¿\"UØ≤˛<@^ıÄy»å(¿\¬˘‘±J˝<@˜9>Zúâ(¿>Øx\Íë˙<@åâBÉ(¿ü\…˛y\Z¯<@c\rπß{(¿ˇ?Nò0ˆ<@IÙ2äu(¿jøµ%ı<@(\'\⁄UHq(¿\»$#gaÛ<@y\r˝l(¿†\›!\≈\0Ò<@\Ï1ë\“d(¿î1>\Ã^\Ó<@tµ˚\À^(¿+j0\Ì<@\0U‹∏\≈\\(¿@a\√\”\Î<@ê‹öt[Z(¿^ˆ\ÎNw\Í<@Ù\ﬁX(¿RÄ(ò1\È<@±¿Wt\ÎU(¿ü\"áàõ\Á<@Ç\Ô\‰\”S(¿W–¥\ƒ\ \‰<@\◊\ﬂÄR(¿z\≈rK\„<@\Ï.PR`Q(¿˚v˛\·<@Xë\—IP(¿+\‹Úë\‡<@ê\⁄\ƒ\…˝N(¿{˜\«{\’\ﬁ<@\“7i\ZM(¿®oô\”e\›<@\Õ\Á\‹\ÌJ(¿jºtì\‹<@æ0ô*H(¿õiQ\€<@˙®7£F(¿N\“¸\Ÿ<@	\ƒ\Î˙C(¿ªîX\ÿ<@\ƒËπÖÆ<(¿˙≥)\"\◊<@h<\ƒy8(¿+Ñ\’X\¬\÷<@Bìƒír7(¿~¨\‡∑!\÷<@L\‡\÷\›4(¿ó=‘∂\’<@\–\’V\Ï/3(¿Ù1\Ë\‘<@˘/\»0(¿KÃ≥íV\‘<@\ﬂ5\ËKo/(¿m;mç\“<@≤à\◊ı+(¿™µ0\Ì\–<@kû#Ú]*(¿õ©æ\œ<@-ï∑#ú&(¿\n,Ä)\œ<@ıf\‘|ï$(¿Ù¿\«`\≈\Õ<@ûœÄz3\"(¿k’Æ	\Õ<@\ËO=\“ (¿Å[wÛT\À<@S\Î˝F;(¿ZJñìP\ <@&é<Y(¿ïF\Ã\ÏÛ\»<@áO:ë`\Z(¿j\'˜;\»<@\‰K®\‡(¿±u≠Ω\«<@ãàbÚ(¿•¢±ˆw\∆<@\€LÖx$(¿†¶ñ≠\≈<@îm\‡\‘(¿˚∞ﬁ®\∆<@6\Àe£s(¿t\Ì\Ë\≈<@\—`\"(¿\'¢_[?\≈<@	äc\Ó\n(¿ç\—:™ö\ƒ<@\ËÙº\n(¿Ö\Í\Ê\‚o\√<@∂-\ l(¿\·A≥\Î\ﬁ\¬<@C\0p\Ï\Ÿ(¿©˜TN\√<@zåÚ\Ã\À(¿\Á\Zf\ƒ<@c\”J!ê˚\'¿ñó¸O˛\¬<@K?˙\'¿ëõ\·|\¬<@H\‚\Â\È\\˘\'¿|\Ìô%\¬<@¥W}˜\'¿î˘Gﬂ§¡<@õ\»\Ãˆ\'¿\Êmr¯¿<@6VbûïÙ\'¿Zh\Á4¿<@ÒÇà‘¥Û\'¿~åâæ<@©OráMÙ\'¿ß\ ˜åDº<@Xêf,öˆ\'¿inÖ∞\Zª<@9\Óî\÷˜\'¿k\”\ÿ^∫<@Àû6\Á¯\'¿\…∆É-v∑<@ö∂e•˘\'¿N\–&áO∂<@B±4-˘\'¿}v¿u≈¥<@≤I~ƒØ¯\'¿ëEöx≥<@1DN_\œ˜\'¿2v\¬Kp≤<@<1\Î\≈Pˆ\'¿^Ù§Ø<@”Ü\√\“¿\Ô\'¿a˙^Cp¨<@\Ëˆí\∆h\Ì\'¿o.\Z2™<@ñï&•†\Î\'¿∫´?¬®<@‘Ç}\È\'¿AªCä¶<@tó\ƒY\Â\'¿™b*˝§<@¿	Ö8\‰\'¿Aúá§<@.è5#\„\'¿\ﬂÄc£<@°+®˛\·\'¿EH\›Œæ¢<@ˆ∂ô\nÒ\‡\'¿£Y\Ÿ>\‰°<@Ø\ÏÇ¡5\ﬂ\'¿øò-Y°<@g\'É£\‰\›\'¿©lXSY†<@ªÉÛ©\€\'¿‡¢ì•÷ü<@Ral!\»\Ÿ\'¿\–\Ì%ç—û<@ïA\’\Ë\’\'¿S%\ \ﬁRû<@À†\⁄\‡D\‘\'¿\…VóSû<@ãv\”\'¿7˝Ÿèù<@ä;\ﬁ\‰∑\–\'¿˝\⁄˙\Èõ<@?e\ƒ\–\'¿öï\ÌCﬁö<@oF\ÕW\…\œ\'¿#.\0ç“ô<@:@0Gè\œ\'¿2™\„nò<@gE\‘Dü\œ\'¿2ë\“ló<@u±i•\–\'¿\Ã\nE∫üì<@^=1\–\'¿ò6\ ˙ë<@2∆á\Ÿ\À\Œ\'¿*:í\Àê<@;\∆G\Õ\'¿\œ\ŸBè<@á3øö\Ã\'¿,ÒÄ≤)ã<@™∏qã˘\…\'¿ÒÅˇâ<@\06 B\\\…\'¿¡\∆ı\Ô˙à<@Ω\√\Ì–∞\»\'¿jâï\—»á<@E◊Öú\«\'¿u\"¡T3á<@áP•\∆\'¿Ùn,(Ü<@{JŒâ=\ƒ\'¿Ö\Œk\ÏÖ<@\npU\¬\'¿P¶\—\‰bÑ<@VÉ0∑{¡\'¿O \Ï´Ç<@:YjΩ\ﬂ¿\'¿cÏÑó\‡Ä<@m®\Áo\¬\'¿\Í%\∆2˝~<@ìUn2\¬\'¿\„\√\Ïe\€}<@ \‘E\ne¡\'¿õèkC}<@6l±€ø\'¿Ä∏´W}<@\Í\À\“NÕΩ\'¿d\ÍÆ\ÏÇ}<@\r4üs∑ª\'¿/˙\n“å}<@P9&ã˚∑\'¿l%tó\ƒ}<@¥Æ+f¥\'¿Ø_∞∂}<@7\·^ô∑≤\'¿2≠Mc{}<@Çˇ≠d«Æ\'¿V~å}<@JbIπ˚¨\'¿\œı}8H|<@ñ\\≈™\'¿§6qrø{<@Ä’ë#ù©\'¿ç~4ú2{<@≤fdêª®\'¿Lm©Éºz<@àÚ-$®\'¿*\ƒ#ÒÚx<@fNó\≈ƒ¶\'¿\∆o\n+x<@*sÛç\Ë¶\'¿Å≤)Wxw<@@OIß\'¿6\ËKov<@]k\ÔSU®\'¿lîıõâu<@\Âµ∫K™\'¿e˝fb∫t<@\‚rº—´\'¿2\ÊÆ%\‰s<@\ÁQÒG¨\'¿ü\0äë%s<@zSë\nc´\'¿∏ë≤E\“r<@t\‘\—q5™\'¿“äo(|r<@Q¿v0bß\'¿\÷TÖq<@¿Æ&OY•\'¿+£ë\œo<@!ë∂Ò\'¢\'¿2êgóo<@	SîK\„ü\'¿¢∏\„M~o<@“é~7ù\'¿$\—\À(ño<@∞<HOëõ\'¿\ÌJ\ÀHΩo<@ŒßéUö\'¿\«◊ûYp<@kFπãò\'¿çG©Ñ\'p<@üØY.ï\'¿ö?¶µip<@»öëA\Óí\'¿¸S™Dq<@)\›^“ê\'¿\Z¶∂\‘Ar<@=E7è\'¿u\Êæs<@n5\Îå\Ôã\'¿∫ªŒÜ¸s<@.X™xâ\'¿ªÉÛ©s<@epîº:á\'¿$D˘Çr<@\rP\ZjÇ\'¿\€¶∂\‘q<@=Y§â\'¿àd»±ıp<@ôÇ5Œ¶{\'¿µ\ƒ\ h\‰o<@0Ω˝πhx\'¿óé9o<@…´s\»v\'¿Úz0)>n<@\Ê≤\—9?u\'¿x	N} m<@ò¥\…\·s\'¿Ho∏è\‹j<@H§m¸âr\'¿çò\Ÿ\Á1j<@ñ\È)rp\'¿gÅvák<@\«Å @n\'¿`w∫Û\ƒk<@\'K≠˜m\'¿j˘Å´<m<@<¿ì.k\'¿MMÇ7§m<@FC∆£Tj\'¿ç“•In<@ïµMÒ∏h\'¿{É/L¶n<@ˇî*Qˆf\'¿ûéíWo<@&é<Yd\'¿∏\"1A\ro<@k∫û\Ë∫`\'¿Ø\ÓXlìn<@MÜ\„˘`\'¿Y6sHjm<@zõ©^\'¿}[∞Tl<@?tA}\À\\\'¿tDæK©k<@c_≤Ò`[\'¿UMuk<@\Ÿ\nöñXY\'¿#i7˙òk<@9\'0ùV\'¿\€MM\”k<@0ûACˇT\'¿UÜq7l<@¿DàS\'¿G‰ªî∫l<@\–∏ÆòQ\'¿ÑûÕ™\œm<@3á§JN\'¿*8º n<@≤e˘∫L\'¿\'•†\€Kn<@±√òÙ˜J\'¿≥≤}\»[n<@§¡mm\·I\'¿Öy7n<@:dØwG\'¿\«ı\Ô˙\Ãm<@yx\“\¬E\'¿u≠ΩOm<@<üıfD\'¿Å>l<@I\ÿ\’\‰A\'¿¶ô\ÓuRk<@€áº\Â\Í?\'¿\0ã¸˙!j<@âï\—\»\Á=\'¿*U¢\Ï-i<@≠¢?4Û<\'¿k\“mâ\\h<@≤.n£<\'¿ízO\Â¥g<@\ﬁ	ä;\'¿új-\ÃBg<@\rä\Ê,:\'¿\0≠˘Òóf<@≥\'Å\Õ98\'¿–òI\‘f<@\’ \Ã\Ì^6\'¿î.´∞e<@ªö<e5\'¿\¬\‹\Ó\Â>e<@§6qrø3\'¿Mg\'É£d<@ìß¨¶\Î1\'¿\‚\ÊT2\0d<@zˇ\'L0\'¿ßu\‘~c<@W	á3/\'¿]oõ©c<@\ O™}:.\'¿,gÔå∂b<@që{∫∫+\'¿\Èõ4\räb<@(\'\⁄UH)\'¿Å\È¥nÉb<@#Öñu\'\'¿\Ë∫Åb<@Ç\·\\\√%\'¿dyW=`b<@/¶ô\Óu\"\'¿éW zRb<@•ª\Îl\»\'¿⁄íUnb<@D˛o\'¿ß…å∑ïb<@¶E}í;\'¿ô-Y\·b<@N*\Zk\'¿gG™\Ô¸b<@yv˘÷á\'¿\÷;\‹\rc<@{Ú%\'¿AÄc<@Ä≤e˘\'¿\›}éèc<@¯\›t\À\'¿¥\0m´Yc<@T˛µºr\r\'¿\\W\Ãoc<@\–CmF	\'¿Mg\'Éc<@<p\œÛ\'¿\≈Y5\—c<@\'¢_[?\'¿~ç$Ad<@d\Î\¬1\'¿\Îé\≈6©d<@\ÏM\…\'¿H¿\ËÚ\Êd<@úlw\0\'¿ÑIÒÒ	e<@Ø}Ωpˇ&¿B\Î\·\ÀDe<@\ 6p\Í¸&¿ˆ@+0de<@\›\ÕSr˚&¿k’Æ	ie<@æ›≥Æ˘&¿œæÚ =e<@Çã5òˆ&¿ñ\Ë,≥e<@ü\«(œºÙ&¿\’íwe<@(µ¶Ò&¿\·\—\∆ke<@\–(]˙\Ô&¿ì\‚\„f<@F\ÕW\…\«\Ó&¿öÏüßg<@!\»A	3\Ì&¿•û\–\Îg<@\Ï4\“Ry\Î&¿%Yá£´h<@-&˛(\Í&¿≠á/i<@¥Ø<HO\È&¿d\Õ\» wi<@˜=\ÍØW\Ë&¿¥\Á25	j<@Ç≠,\Á&¿{ˆ\\¶j<@jí\Ã\Í\Â&¿XT\ƒ\È$k<@\Ëü\‡bE\Â&¿\nLßul<@}\Ã\‚&¿\œk\Ï\’k<@ïfÛ8\ﬁ&¿ä\Ê,Úk<@n4Ä∑@\⁄&¿˚;€£7l<@\ÏM\Ÿ&¿æ¢[Ø\Èm<@0Å[wÛ\‘&¿\ÓØ˜≠n<@\ \¬\◊\◊\“&¿∆æd\„¡n<@~:3P\—&¿ªòf∫\◊m<@Æ¡8∏\Ã&¿\√fÄ≤m<@∆á\ŸÀ∂\À&¿jÖ\È{\rm<@W@\‹\≈&¿Pîi4m<@∞˛\œaæ\ƒ&¿Æ÷â\ÀÒn<@˛`\‡π˜¿&¿\‰û{o<@k) \Ì¿&¿L‚¨àöp<@<Ö\\©ø&¿n\√(s<@ı9D‹º&¿ö$ñîªs<@◊æÄ^∏ª&¿\nÜs\r3t<@ni5$\Óπ&¿\‰Gàt<@RCÄ\r∏&¿MåJ\Ít<@Ù\ﬁÄ≥&¿Ò’é\‚u<@8hØ>≤&¿îÖØØuu<@\Õ<π¶∞&¿	q\Â\Ïùu<@|{◊†/≠&¿Z\râ{,u<@ãv´&¿hwH1t<@π\‡˛~©&¿Q˜Hmr<@\"\‡™‘§&¿†Y2\«r<@\È\Ô•†°&¿\r¸®Ü˝r<@É˚†&¿\œ,	PSs<@ç\ÏJ\ÀHù&¿B∞™^~s<@\’@Û9wõ&¿L¸Q‘ôs<@Q†O\‰Iö&¿\·\n(\‘s<@˘\ÿ]†§ò&¿∞èN]˘t<@enæ›ì&¿Ö(_\–Bv<@]\‡ÚX3í&¿å≥ómw<@p\Înû\Íê&¿,ù\œx<@.\„¶öè&¿\\ AÒcx<@¯¶\È≥é&¿j˚WVöx<@˚@ÚŒ°å&¿°iâï\—x<@´?\¬0`â&¿Œã_\Ìx<@	•/Ñúá&¿y∞\≈nüy<@Q°∫π¯É&¿ç^\rP\Zz<@í=BÕêÇ&¿ÑÛ©cïz<@\Í$[]NÅ&¿\Ê \ËhU{<@¶†\Ÿu&¿$(~åπ{<@&p\În~&¿∂1v\¬K|<@îMπ¬ª|&¿Ø@Ù§|<@ív5yz&¿°L£\…\≈|<@ºñêzv&¿Æ∫’î|<@≤ª@IÅu&¿\‡?ˇ=|<@\‡Ù.ﬁès&¿GëµÜR{<@_F±\‹\“j&¿V}Æ∂b{<@\«Gã3Üi&¿\”ıD◊Ö{<@[ñØ\Àg&¿,\◊\€f*|<@ß\∆K7a&¿ªE`¨o|<@\“\ZÉN`&¿\Ô8EGr}<@*Ç™\—[&¿\Ê\Õ\·Z\Ì}<@\nh\"lxZ&¿<•Éı~<@∂f+/˘W&¿≠C9\—~<@d\\qqTV&¿ï\rk*<@äZö[!T&¿\‡ù|zl<@òi˚WVR&¿\Ã\Ì^\Óì<@S	O\ËıO&¿	•/Ñú<@9\’ZòÖN&¿°fH\≈<@\ÌÅV`\»J&¿ÚA\œf\’<@Øñ;3¡H&¿\'çµø<@b\ÌcG&¿Ù¶\"\∆~<@)Øï\–]B&¿÷´\»\ËÄ|<@D˜¨k¥<&¿oeâ\Œ2{<@KxBØ?9&¿Ñ4fz<@\ﬁVzm66&¿Ûê)z<@GN∂Å3&¿g)YNz<@\ÌjÜT1&¿\Ë˘\”Fuz<@ú˘\’ 0&¿\‚∞4£z<@µ<L˚.&¿P≈ç[\Ã{<@1Xr+&¿åªA¥V|<@úQÛUÚ)&¿29µ3L}<@\Ã%U\€M(&¿q≠ˆ∞~<@∞ˇ:7m&&¿G´Z\“Q~<@§ãM+%&¿#IÆÄ~<@˝Nìo#&¿ˇwDÖ\Í~<@\∆2˝Ò&¿.´∞\‡~<@ê°c&¿ìE\÷~<@Ñ%Z\Z&¿¥Yıπ\⁄~<@â]\€\€-&¿ˇ\Œˆ\Ë\r<@ñ@J\Ï\⁄&¿H˘IµO<@sú€Ñ{&¿-^,ë<@(\“˝úÇ&¿0Ieä9Ä<@Ö\Í\Ê\‚o&¿ê°cÅ<@[¥\0m´&¿©˘*˘ÿÅ<@pA∂,_&¿4ú27É<@Mıd˛	&¿ì‰πæÉ<@,G\»@û&¿G\∆jÛˇÇ<@s˜9>Z&¿ß±ΩÙÇ<@∂∫ú&¿,∑¥\ZÉ<@∫-ë\Œ\0&¿Ze¶¥˛Ç<@ì¸à_±˛%¿~\«\ÿœÇ<@T\Z1≥\œ˚%¿ÒπÏøÇ<@ñw\’\Ê˘%¿úlw†Ç<@{\ÿl˜%¿Çã5òÇ<@4ıª∞ı%¿Öï\n*™Ç<@åø\Ì	Û%¿&s,Ô™É<@5≥ñ\“\Ó%¿]\≈\‚7ÖÖ<@¨\Â\ŒL0\Ï%¿ôºfæá<@ˇ\ÏGä\»\Ë%¿∑{πOéä<@Ö¥∆†\‚%¿Œ©d\0®ä<@Éˆ\Í\„°\ﬂ%¿ão(|∂ä<@jà*¸\ﬁ%¿éyq»ä<@t\nÚ≥ë\€%¿¿í´X¸ä<@0,æ-\ÿ%¿e\ﬂ¡ˇä<@å.o\◊%¿˝Ω4ã<@]£\Â@\’%¿\\t≤\‘zã<@V∏\Â#\—%¿\'°ÙÖêã<@\0\≈»í9\Œ%¿:@0Gèã<@É¶%VF\À%¿T≠ÖYhã<@V~å\…%¿\»\Õp>ã<@\ﬁ´\Õ\«%¿ á†jÙä<@•-ÆÒô\ƒ%¿\–\–?¡≈ä<@OëC\ƒ\Õ¡%¿íîÙ0¥ä<@\ŸYº%¿¡;˘Ùÿä<@.ç_x%π%¿∫fÚ\Õ6ã<@Å±æÅ…µ%¿\È&1¨å<@”¢>\…Æ%¿¨\ƒ<+iç<@∂◊Ç\ﬁ´%¿6W\ÕsDé<@Z~\‡*O®%¿K\…rJè<@˛µºrΩ•%¿5$\Ó±Ùë<@9\“°%¿c_≤Ò`ì<@Ac&Qü%¿\”lá¡î<@Æ™\rNú%¿\∆\·ÃØ\Êî<@Ç;Pß<ö%¿_—≠\◊Ùî<@V-≤ùó%¿µ¿)ï<@zãá˜î%¿mV}Æ∂ñ<@\ŒQG\«’ê%¿ ò£«ó<@}îÄé%¿îÜ\ZÖò<@¡©$\Ôå%¿\Z0H˙¥ö<@\ŸZ_$¥Ö%¿”àô}õ<@ÆÛoó˝Ç%¿\’\Áj+ˆõ<@\◊/\ÿ\r\€v%¿è¶z2ˇú<@\√‘ñ:\»s%¿Ôéå’û<@W\nÅ\\\‚p%¿L\∆1í=™<@Oìo+e%¿nö\Î4™<@®68˝b%¿?\‰-W?™<@§µ˚U`%¿ù°∏\„M™<@\∆\€JØ\Õ^%¿Xç%¨ç±<@-\Î˛±U%¿ˆv√∂±<@1{\Ÿv\⁄R%¿K´!qè±<@\\\Àd8ûO%¿}?q\0±<@\'1¨J%¿\÷µ¬∞<@ë\÷tBH%¿Ür¢]Ö∞<@ª∏çF%¿\rπß´Ø<@\·B¡çD%¿R∂H⁄çÆ<@Úñ´C%¿Û;Mfº≠<@ï”ûísB%¿˛E–¨<@$\–`S\ÁA%¿*\‡û\ÁO´<@\Ô˛xØZA%¿\Â)´\Èz™<@~åπk	A%¿Ωåbπ•©<@cô~â@%¿ı*2: ©<@í]i©?%¿¡ò2p®<@˜\‰a°\÷<%¿\Î8~®<@ú≈ãÖ!:%¿∏ØÁå®<@äM†8%¿ÄÄµj◊®<@\«ïF\Ã4%¿iQü\‰™<@\n£Y\Ÿ>,%¿©ÿò\◊´<@ıÇOsÚ*%¿ö\Ô\‡\'¨<@\„4D˛$%¿?RDÜU¨<@Ú	\Ÿy#%¿\’\ÏÅV`¨<@\”\Ÿ\…\‡(!%¿\Í\ÁME*¨<@÷®áht%¿âaá1\È´<@•ÙL/1%¿\…\Â?§´<@Ç8\'0%¿Wxóã¯™<@yˆ—©%¿X9¥\»v™<@\≈s∂Ä\–\Z%¿\Ÿ\\5œ©<@ëù∑±\Ÿ%¿gsÇ6©<@,amåù%¿aˇun⁄®<@\ÿıv\√%¿˜\«{\’ ®<@*\Ê \Ëh%¿\Ã”π¢î®<@ﬁìáÖZ%¿W\\ïß<@%yÆ\Ô\√%¿\„5ØÍ¨¶<@èâîfÛ%¿\‚ê\r§ã•<@Ö\Ì\'c|%¿$\Ÿ@∫§<@+˚Æ˛%¿≥\–\Œi§<@,e\‚X%¿T9\Ì)9£<@1\œJZÒ\r%¿\«ÛPo¢<@MÑ\rOØ%¿ÚôÏüß°<@>\Õ…ãL%¿\"¸ã†1£<@3\ﬂ¡O%¿º#cµ˘£<@qZ¢Ø\0%¿q\Í\È£<@Å[wÛTˇ$¿ø\ÓtÁâ£<@\È‘ï\œÚ¸$¿kg{Ù¢<@√ûv¯k˙$¿zß\Óy¢<@><Kê¯$¿qxµ‹°<@u\Ãy∆æÙ$¿(µ¶°<@^∫IÛ$¿zo¿°<@Dø∂~˙\Ô$¿\‡™\‘\Ï°<@\À¯˜\Ó$¿{àFw£<@1“ã\⁄˝\Í$¿≠ó\„§<@\›\Ìziä\Ë$¿T∆øœ∏§<@¸¥W\Á$¿àL˘T•<@\"7\√\r¯\‰$¿®oô\”e•<@ßÆ|ñ\Á\·$¿ıG,•<@`u\‰Hg\‡$¿òıI\Ó§<@î†ø\–#\ﬁ$¿p±¢”§<@\”lá¡\‹$¿n3‚ë§<@ï\rk*\€$¿bi\‡G5§<@\ \·ìN$\ÿ$¿Ò°DK£<@ÉÖì4\‘$¿\›\\¸mO†<@\Õ.è5\À$¿/ÖÕÆü<@¿{Gç	\…$¿aUΩ¸Nü<@\·¥\‡E\«$¿epîº:ü<@&7ä¨5\ƒ$¿õ\Â≤\—9ü<@ü≠ÉÉΩ¡$¿\ÿlü<@áoa\›xø$¿}\Î\√z£û<@˝æÛ\‚º$¿¡®§N@ü<@∫M∏W\Êµ$¿\÷ˇ9Ãü<@)<hv›≥$¿`u\‰Hg†<@ùûwc±$¿d\Âó¡°<@\Ï´aÆ$¿\…Xm˛_°<@û\Ì\—\Ó´$¿C¡çî°<@t∑\Î•)™$¿Xˇ\Á0_¢<@\Ê¨O9&£$¿´7U¢<@*\Ê \Ëhù$¿\‘\n\”˜\Z¢<@ÊØêπö$¿1xòˆÕ°<@¸4\Ó\Õoò$¿\ÕsDæK°<@<ö$ñ$¿ó:\»\Î¡†<@Ω\≈\√{î$¿\⁄\«\n~ü<@°ü©\◊-í$¿\'i˛ò÷û<@æÙ\ﬁí$¿≥¥Ssπù<@\‘\’ãmí$¿¨ë]iù<@\·\Ó¨\›vë$¿U¡®§Nú<@tA}Àúé$¿9b->ú<@\‘>\Õ…ã$¿\Î\≈PN¥õ<@[\Èµ\ŸXâ$¿A C«ö<@\Ÿ\Î\›\ÔÖ$¿Ò\rÖ\œ÷ô<@\ndvΩÉ$¿\„ut\\ô<@!W\ÍYÇ$¿Aõ>\Èò<@É—Ø≠$¿{JŒâ=ò<@¶Ä¥ˇ~$¿.v˚¨2ó<@\Íx\Ã@e|$¿@1≤dñ<@\·˛~1{$¿óè§§áï<@ZK\0˛y$¿2Xq™µî<@\ `\Ê;x$¿\ÀÚu˛ì<@H≈´¨u$¿GêJ±ì<@ìQews$¿ZÄ∂’¨ì<@\'k\‘C4r$¿\Ëi¿ \Èì<@\Î8~p$¿\ËÇ˙ñ9ï<@REÒ*kk$¿òüêï<@\Í=ï”ûj$¿dÆ™\rñ<@å5òÜi$¿˝\‹–îùñ<@\‰Ωje\¬g$¿\Âa°\÷4ó<@˛)U¢\Ïe$¿ΩQ+Lﬂó<@¯•~\ﬁTd$¿!\‰K®ò<@¨™ó\ﬂib$¿O\Í\À\“Nô<@¶&¡\“`$¿2\ËLö<@ç\núl_$¿\–\Ô˚7õ<@Ov3£]$¿(`;±õ<@Ω\≈\√[$¿ëbÄDú<@ëc\Î\¬Y$¿ã•Hæú<@\…°fX$¿?ç{Ûõ<@oÑEEúV$¿˛Ûﬂõ<@˝\€eø\ÓT$¿6#É\‹Eú<@;4,F]S$¿_¥\«ù<@\ƒ`˛\nôS$¿;¨p\ÀGû<@K\Èô^bT$¿\—\Ê8∑	ü<@?5^∫IT$¿<g≠ü<@\ﬂ,\’T$¿\≈\0â&P†<@4øöS$¿\»%é<†<@(∏XQÉQ$¿8£\Ê´\‰ü<@≥\Ì¥5\"P$¿\·\n(‘ü<@•¯¯Ñ\ÏL$¿;V)=”ü<@xõ7N\nK$¿\–f\rﬁü<@?\ƒ\'I$¿/‹π0“ü<@\ƒv¸H$¿â\n\’\Õ≈ü<@:ÆFv•E$¿eo)\Áü<@IÉ\€\⁄\¬C$¿)ì\Z\⁄\0†<@«ÅWÀùA$¿J”†h†<@áP•f?$¿t%\’?†<@\⁄\·Ø\…\Z=$¿*\0\∆3h†<@ÉS∞\∆9$¿lÀÄ≥î†<@`?\ƒ7$¿T„•õƒ†<@Dj\⁄\≈43$¿û|zlÀ†<@¥\Ã\"[1$¿m8,\r¸†<@¸ß(.$¿|µ£8G°<@	4\ÿ,$¿+\⁄\Á6°<@»ïzÑ*$¿B%Æc\\°<@kQL\ﬁ($¿ø∆àD°<@¥[\Àd8&$¿˘£®3˜†<@\–\nY\›\"$¿{Cr2°<@;™ö \Í$¿¢µ¢Õ°<@§\Zˆ{b$¿⁄´èá¢<@m\∆ià*$¿V∑zNz£<@H\ﬁ9î°\Z$¿∂\⁄\√^(§<@>ñ#d$¿\Á\‚o{Ç§<@©¢xïµ$¿Üèà)ë§<@\¬z˝I$¿R\Ííq§<@>îh$¿&\»®p§<@ßî\◊J\Ë$¿j§•Úv§<@\√‘ñ:\»$¿f¯O7P§<@X§ß\»	$¿´\Õˇ£<@ïµMÒ∏$¿2ë\“l£<@úO´î$¿z\ƒËπÖ¢<@ëÒ(ï$¿©¡4°<@\‡-ê†¯$¿‘úº\»†<@%ï)\Ê \0$¿ÎãÑ∂úü<@√ú†Mˇ#¿+Ÿ±àü<@Qø[≥˝#¿àÖZ”ºü<@Z)râ˚#¿\€\ﬁnI†<@y\À’èM˙#¿Oœª±††<@\ﬂ¸Üâ˘#¿¢\Í[\Ê†<@¥;§¯#¿æ\ﬁ˝Ò^°<@(\r5\nIˆ#¿\Ê\Â∞˚é°<@Ü¨nıúÙ#¿iUM°<@\Ã*l∏#¿	\≈V–¥†<@6\"ó\Ó#¿8Ñ*5{†<@\·B¡ç\Ï#¿=‘∂a†<@ıcô~\È#¿?è®†<@bˆ≤\Ì¥\Â#¿©jÇ®˚†<@æ\ÿ{ÒE\„#¿MK¨åF¢<@ÈÅè¡ä\€#¿\Ó@ùÚ\Ë¢<@:u\Â≥<\◊#¿\ƒ	Lßu£<@∏<÷å\‘#¿Íï≤q§<@”§t{\—#¿&m™Óë•<@∏Æò\ﬁ\Œ#¿|DLâ$¶<@hÆ\”HK\Õ#¿)râ#ß<@µTﬁép\ #¿:>Zú1®<@j¯÷ç\«#¿\„^IÚ®<@bg\nù\◊¿#¿Ä*n\‹b™<@Å^∏sa¥#¿µ\ﬁo¥\„™<@v§˙\Œ/≤#¿“™ñtî´<@∞´\…SÆ#¿≥\Ì¥5\"¨<@ ’∞\ﬂ´#¿™Ò\“Mb¨<@èlÆö\Á®#¿Ω\Z†4‘¨<@v\¬Kp\Í£#¿\»^\Ô˛¨<@®S›†#¿Œã_\Ì¨<@\⁄≠¿êù#¿\‹GnM∫≠<@˘æ∏T•ù#¿\÷;\‹\rØ<@û)t^cü#¿(õrÖØ<@Õî\÷\ﬂ†#¿p\\\∆M\r∞<@ìp!è†#¿π4~·ï∞<@*Wxóã†#¿)\Î7”±<@8kæ*ü#¿Zú1\Ã	≤<@´Z\“Qû#¿k\r•ˆ\"≤<@í\ÏjÜú#¿ñTˇ ≤<@ú§˘cZõ#¿()∞\0≤<@JCçBö#¿\Í\È#∞<@ı\"rî#¿QL\ﬁ\0Ø<@¥\Ã\"[ë#¿zß\ÓyÆ<@$	\¬Pê#¿Ñª≥v€≠<@jlØΩè#¿t\ÓvΩ4≠<@âu™|è#¿™π\‹`®´<@\ 2ƒ±.é#¿ˆ\\¶&¡´<@\Õôd\‰å#¿DmFA¨<@∂◊Ç\ﬁã#¿8\€‹òû¨<@ö∂e•â#¿%∞9œ¨<@\\1–µá#¿\◊]~¨<@\‘>\Õ…É#¿Å∞S¨\Z¨<@∞˜≠÷Å#¿OG…´´<@}\ 1Y\‹#¿\À0\Ó—™<@Ç9z¸~#¿±Q\÷o&™<@™ª≤#¿}^Ò\‘#©<@2\"QhY#¿\ﬁJ\n,®<@<2Võˇ#¿ÄÇã5§<@EH\›\Œ~#¿\‰,\Ïiá£<@^+°ª$~#¿\ŒZ£<@WîÇU}#¿0ü¨Æ¢<@íï_c|#¿ÕÆ{+¢<@\¬&S{#¿ö%jj°<@AÄ;x#¿\Ô9∞°<@\⁄sôöw#¿/•.«†<@\Z¯Q\r˚u#¿&\Â\Ós|†<@.\Z2u#¿5%Yá£ü<@ö&l?s#¿\≈\ÁN∞ˇû<@Y\¬\⁄;q#¿…´s»û<@z\‚9[@p#¿C\Á5vâû<@ät?ß o#¿<˙_ÆEü<@\Õ.è5k#¿ı∏oµN†<@ÛZ	\›%i#¿\ÏM\……†<@`\«Å h#¿¯Ac&°<@Å≈è1g#¿>\Ì\◊d°<@∑\‘A^f#¿í^\‘\ÓW°<@aã\›>´d#¿^ÿö≠º†<@RÚ\Íb#¿c¥é™&†<@πåõ\Zh^#¿mÚñ´ü<@í\ÀHøU#¿\›\Ïîü<@[z4\’S#¿àÇü<@1\'hì\√O#¿\·\ÁS«û<@\–w.åL#¿u\Õ\‰õmû<@˘.•.I#¿\”¿èjÿõ<@\Ô%@#¿\”¿èjÿõ<@~!<\⁄8#¿¶ú/ˆ^ú<@•Ñ`U5#¿\Ê\Ê\—=ó<@\ÍuëB)#¿\Ë\ﬁ\√%«ï<@ˆ\Œh´í(#¿D6ê.6ï<@≠¿ê’≠&#¿\À\÷˙\"°ï<@CV∏\Â##¿5{†ñ<@^\◊/\ÿ\r##¿yïµMÒò<@1–µ/ #¿-&˛(ö<@\È\—TO\Ê#¿Æ∫’îú<@¨\‚ç\Ã##¿8ÇTäù<@ÇV`\»\Í#¿Pß<∫û<@è∆°~#¿PráMdû<@7n1?7#¿nã2dû<@≥E\“nÙ#¿≠jIG9ú<@\À\÷˙\"°#¿‘òsIô<@?®ã\ \Z#¿\Ÿ\Œ˜S\„ï<@ıπ⁄ä˝#¿5C™(^ï<@9\Ì)9\'#¿bÛqm®î<@\'0ù\÷#¿ç∂*â\Ïì<@Ä)¥#¿Ag“¶\Íí<@\Ã\‘$xC\Z#¿ú≈ãÖ!í<@ˆ@+0d#¿\·&£\ 0í<@\‰.\¬\Â#¿/¯4\'/í<@}Àú.ã#¿Bóp\Ë-í<@6X8IÛ#¿\»Eµà(í<@%Œä®â#¿!t\–%í<@ge˚ê∑#¿”ø$ï)í<@\0÷™]#¿|ówí<@k,amå#¿µ˚UÄ\Ôí<@\'Ü\‰d\‚˛\"¿á¡¸2ì<@\‰ø@ ˚\"¿\rpA∂,ì<@ir1\÷˘\"¿^có®ﬁí<@N\Ï°}¨¯\"¿Zg|_\\í<@scz\¬˜\"¿S8Ωãè<@k∂ÚíˇÒ\"¿\ PSç<@\Õ>èQûÒ\"¿ı\"rå<@\Œ\ﬁmUÚ\"¿âaá1\Èã<@\“≈¶ïÚ\"¿l	˘†gã<@±¶≤(\ÏÚ\"¿\ÔXlìää<@ÈÅè¡äÛ\"¿¸7/N|â<@küé\«Ù\"¿ˇxØZôà<@#k$Ò\"¿\Âó¡ëà<@Ñ\‘\Ì\Ï+\Ô\"¿`\ ¿â<@ßA\—<Ä\Ì\"¿é\Â]ıÄâ<@H•\ÿ\—8\Ï\"¿í\ËeÀâ<@Õëï_\Î\"¿4üs∑\Îâ<@\ﬁ;jLà\È\"¿ˇ[…éâ<@Äüq\·@\Ë\"¿IúQâ<@\Ÿ\Î\›\Á\"¿≤\’ÂîÄà<@Z_\Ê\"¿ìã1∞éá<@‹Å:\Â\—\Â\"¿W>\ÀÛ\‡Ü<@ª\‘˝L\Â\"¿™\’WWÜ<@}\ÍX•Ù\‰\"¿\”ˆØ¨4Ö<@@ø\Ô\ﬂ\‰\"¿ö≥>ÂòÑ<@;±O\0\Â\"¿hïô\“˙É<@ˆaΩQ+\‰\"¿∏ [ñÉ<@.»ñ\Â\Î\‚\"¿J\–_\ËÉ<@\'ü\€2\‡\"¿\÷q¸PiÑ<@8¢{\÷5\⁄\"¿çÒaˆ≤Ö<@y\Íë∑\’\"¿mS<.™Ö<@\Z®åü\—\"¿EbÇ\ZæÖ<@}\Œ›Æó\Œ\"¿}=_≥\\Ü<@û¥pY\≈\"¿%\ÎptïÜ<@Ugµ¿\√\"¿\„^IÚÑ<@PsÚ\"∏\"¿\Í	K<†Ñ<@)!XU/∑\"¿-y<-?Ñ<@å0Eπ4∂\"¿î\›\Ã\ËGÉ<@\‹c\ÈC¥\"¿ıÑ%PÇ<@Hj°dr≤\"¿rk\“mâÄ<@Ú∞PköØ\"¿l\Í<*˛<@\◊/\ÿ\r€Æ\"¿{\⁄\·Ø\…~<@$òjf-≠\"¿Ñ\rOØî}<@\rQÖ?√´\"¿#¯\ﬂJv|<@áâ)x™\"¿\‹\‘@Û9{<@∑¥\Z˜®\"¿~\‚\0˙y<@¶_\"\ﬁ:ß\"¿É\Ë\⁄x<@i„àµ¯§\"¿Ö^üw<@ÅïCã§\"¿zPPäVv<@≥“§t£\"¿2t\Ït<@emS<.¢\"¿Û:\‚ê\rt<@\Õ!©Öí°\"¿Ò\∆O\„r<@™+ü\Ây†\"¿/Ü\»q<@sÙ¯ΩMü\"¿≠Kç\–\œp<@uYLl>û\"¿Oê\ÿ\Óp<@kõ\‚qQù\"¿Ujˆ@o<@ˆ\n\Óú\"¿:YjΩ\ﬂl<@8°áò\"¿\Ê\ŒL0úk<@Wˇ[…ñ\"¿ÆÚ\¬j<@õ.»ñï\"¿•á°\’\…i<@vS\ k%î\"¿%A∏\ni<@	\·\—\∆ì\"¿ù,µ\ﬁoh<@ú®•πí\"¿\„\·=ñg<@4ªÓ≠ê\"¿ñ\Í^f<@Z\‘\'π√é\"¿º\Á¿rÑd<@\‡ªÕã\"¿û\n∏\Á˘c<@#†\¬§ä\"¿Ω™≥Z`c<@m\«\‘]â\"¿¨\„¯°b<@ä\"§ngá\"¿ß\\\·].b<@bıGÜ\"¿\r$}Za<@\’\ÃZ\nHÉ\"¿CçBíYa<@/M\‡Ù~\"¿ú\ﬁ\≈˚a<@L\‡\÷\›<}\"¿q<üıb<@*éØñ{\"¿\ﬂ\‹_=\Óc<@DnÜy\"¿	l\Œ¡3e<@cz\¬x\"¿{É/L¶f<@ºñêzv\"¿”£©û\Ãg<@öñXu\"¿\ÍîG7j<@\Ô´r°r\"¿áoa\›xÉ<@§µ˚UX\"¿¡8∏tÃ•<@ù:\Ë&\"¿N\nÛg¶<@ß\Óy˛$\"¿ﬂåöØí´<@*ú\ﬁ\≈\"¿R\Ó>\«Gª<@óTm7¡ˇ!¿ˆ\ÎNwû\–<@¡éˇA\–!¿àe3á§ˆ<@|ds\’<!¿Cë\Ó\Á¯<@W\nÅ\\\‚\0!¿¸9˘\Ÿ¯<@øÛ\‚\ƒˇ ¿[z4’ì˘<@q\»\“\≈˛ ¿8\‹GnM˙<@Ω:«Ä\Ï˝ ¿\Ï\’[˚<@a\\:\Ê¸ ¿î\Ì*§¸<@\–~§à˚ ¿r£\»ZC˝<@\“\ƒ\Œ˙ ¿wı*2˛<@3é\Á3¯ ¿\'L5≥˛<@Ògx≥˜ ¿ñ\—\»\Áˇ<@K<†l\ ı ¿$(~åπˇ<@¬á-Ò ¿TT˝J\Áˇ<@ˆ$∞9\Ô ¿AÄ;\0=@{\€LÖx\Ï ¿§à´xì=@B“ßUÙ\« ¿Q€ÜQî=@D˘Ç\» ¿ıG,ï=@\réíW\Á\» ¿\ÿ,óçŒï=@J&ßvÜ\… ¿b\◊ˆvKñ=@;\ƒ?l\È\… ¿\Ê\È\\QJò=@AÇ\‚«ò\À ¿',1607362055,1607362055,NULL,NULL),(5,'Lusaka',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\0¿\0\0i¿\"ø6>@ó\0¸S™¸-¿Ñö!U7>@W?6…è\0.¿óêz67>@ôıb(\'.¿’ó•ùö7>@=+i\≈7.¿<ˆ≥Xä8>@¢A\nûB.¿`êÙi9>@≠Mc{-.¿œÑ&â9>@AªCä\n.¿ö\È^\'ı9>@q\„Ûs.¿Ä\‘&N:>@=e5]O.¿Å]Mû≤:>@Û«¥6ç\r.¿\Ê\…52;>@≤Ÿë\Í;.¿r\Ã_!;>@˝j\Ã.¿3åªA¥:>@uëBY¯.¿_&äê:>@≥∂).¿\ËÖ;:>@NôõoD.¿]\ﬁÆ9>@ì¶A\—<.¿ß\‘E\n9>@*\«dqˇ.¿™Ò\“Mb8>@\"7\√\r¯.¿¨Uª&8>@°J\Õ .¿Åìm\‡8>@U\⁄\‚\Zü!.¿#\∆Ç8>@r•û°$.¿Óµ†˜\∆8>@c\’ \Ã\Ì&.¿¬Ö<Ç9>@+Ω6+).¿a2U0*9>@(-\\Va+.¿∑|$%9>@ë\Ì|?5..¿eqˇë\È8>@xö\Ãx[1.¿\ÌÙÉ∫H9>@å_\Ì(6.¿˝j\Ã9>@\◊¯Lˆ7.¿˘º\‚©G:>@±6\∆Nx9.¿%uö;>@Ø\“\›u6<.¿&\‚≠Ûo;>@P®ßè¿?.¿À∫,D;>@†¡¶Œ£B.¿ˆF≠0};>@sÑ\‰\ŸE.¿enæ\›;>@¨Rz¶óH.¿˛\—7i\Z<>@Zú1\Ã	J.¿•°F!=>@àûîI\rM.¿1^Û™\Œ>>@çónÉP.¿∞´\…SV?>@\ 4ö\\åQ.¿\n\ÿF@>@\«AúáS.¿€ß\„1A>@\‹/ü¨V.¿ä≠†iâA>@Ùn,(Z.¿®ä©ÙB>@LqU\Ÿw].¿◊•F\ËgB>@/6≠a.¿¨ç±^B>@)\ŒQG\«e.¿,ÛV]áB>@¬äS≠Öi.¿ˇØ:r§C>@∏u7o.¿≤∏ˇ\»tD>@\‚\Â\È\\Qr.¿H®REE>@ë+ı,u.¿=,‘ö\ÊE>@Ø\'∫.¸x.¿Ä\‘&NF>@@0Gè\ﬂ{.¿∆§øóF>@ù˜ˇq\¬|.¿l#û\ÏF>@a¡˝Ä~.¿ ]lZ)H>@2;ãﬁÅ.¿\'\‹+ÛVI>@!\Á˝Ñ.¿~¸•E}J>@\·Ò\Ì]ÉÜ.¿\'JB\"mK>@\’\ÏÅV`à.¿≥aMeQL>@\„é7˘-ä.¿<˜.M>@ÖÕÆ{ã.¿*\‚tí≠N>@\Z8\Ÿé.¿˝LΩnP>@\‘M÷ê.¿†4\‘($Q>@\”N\Õ\Âì.¿$DiR>@!\Í>\0©ï.¿}\È\Ì\œES>@\À2êgó.¿	\Z3âzU>@èQûy9ú.¿C\Á5vâV>@l\Ã\ÎàCû.¿\‚w\”-;X>@≤ΩÙﬁ†.¿≤\r‹Å:Y>@\Ÿ@∫ÿ¥¢.¿:Z’íZ>@ç}\…∆É•.¿≠mé[>@\ËN∞ˇ:ß.¿zÛW\\>@∞Æ\n\‘b®.¿raär]>@,EÚï@™.¿)#.\0ç^>@è\≈6©h¨.¿éèg_>@N\Ô\‚≠.¿ç_x%\…_>@\Í[\Êt±.¿F±\‹\“j`>@D\¬˜˛µ.¿™+ü\Ây`>@öó\√\Ó;∂.¿5óu`>@\Ê]ıÄy∏.¿ÛWya>@\‰Ç3¯˚Ω.¿DLâ$za>@•ı∑\‡ø.¿)±k{ªa>@S?o*R¡.¿U1ï~\¬a>@±˝då\√.¿©\≈\‰a>@\Èö\…7\€\ƒ.¿H¶Cß\Áa>@ΩçÕéT\«.¿/n£ºa>@àúæûØ\….¿¯ˇq¬Ña>@≈åˆ \Ã.¿*\Ê \Ëha>@Æ\”HK\Â\Õ.¿R∫Ù/Ia>@scz\¬\œ.¿Ÿñg)a>@mr¯§\—.¿ú\ﬂ0\— a>@\“˛X\”.¿\n\€O\∆¯`>@j1xòˆ\’.¿Öñuˇ`>@\”ˆØ¨4\Ÿ.¿\Á\Zfh<a>@8/N|µ\€.¿g◊Ωâa>@0H˙¥ä\ﬁ.¿sJ@L\¬a>@IÜ[\œ\‡.¿5c\—tvb>@\œK\≈∆º\Ê.¿úlw†b>@\ ƒ≠Ç\Ë.¿ô\◊áld>@ótîÉ\Ÿ\Ï.¿4-±2\Ze>@¶B</\Ô.¿îΩ•ú/f>@\Á\ZfhÙ.¿ó˛%©Le>@∏Ø\Áå¯.¿r\ﬂjù∏d>@§R\Ïh˙.¿±¶≤(\Ïb>@\’x\È&1\0/¿@L¬Ö<b>@Y\€èã/¿*\…:]a>@%´\Í\Â/¿Ω\Z†4\‘`>@îÇUı\n/¿§\‚ˇé®`>@\∆O\„\ﬁ/¿\–\rM\Ÿ\È_>@1}Ø!8/¿D˝.l\Õ^>@)Æ*˚Æ/¿õ9$µP^>@Çu?T/¿ãˇ;¢B]>@røCQ†/¿P:ë`™]>@¨ç±^\Z/¿\nù\◊\ÿ%^>@{g¥UI/¿\'˙|î_>@ñ@J\Ï\⁄/¿\Ê\ËÒ_>@7âA`\Â /¿\»]Ñ)\ a>@ä\Ê,Ú#/¿\Ë†K8Ùb>@à\◊ı&/¿Túà~e>@hBìƒí*/¿Ñ\‘\Ì\Ï+g>@EÛ\0˘-/¿9\Óî\÷g>@#Ω®\›//¿\ÃoBh>@™õãø\Ì1/¿fOõsh>@n5\Îå\Ô3/¿~´u\‚rh>@äSÕ¨5/¿∞\…\Zıi>@\œdT8/¿B@æÑj>@Ñπ\›\À}:/¿¸UÄ\Ô6k>@Ú}q©J;/¿†Nyt#l>@Û\ËFXT</¿\ \‹|#∫k>@®©ek=/¿‹∑Z\'.k>@\ŒTàG\‚=/¿¯¡˘‘±j>@Ú\—\‚åa>/¿z\0ã¸˙i>@/¡©$?/¿:ë`™ôi>@d*\„\ﬂ?/¿º≤\◊h>@~:3PA/¿AùÚ\ËFh>@òi˚WVB/¿âu™|g>@\„\ƒW;äC/¿≥öÆ\'∫f>@\‰L∂üD/¿À°E∂Ûe>@HOëC\ƒE/¿L\‡\÷\›<e>@>ó©IF/¿Ü!Y¿d>@åÉK«úG/¿+O \Ïc>@@3à\ÏH/¿S\‰Gb>@´\"\‹dTI/¿\–}9≥a>@˝j\ÃI/¿[%X\Œ`>@\Î˛±J/¿\«\’»Æ¥\\>@5Ò§M/¿\rnk\œ[>@§˛zÖO/¿5\'/2[>@W`\»\ÍVO/¿˘HJzZ>@üì\ﬁ7æN/¿h<\ƒyX>@\—<ÄE~M/¿∂ˆ>UÖV>@É˘+dÆL/¿êı\‘\Í´S>@Ù˚˛\ÕK/¿\‚[X7\ﬁQ>@Sóåc$K/¿û\Î˚pêP>@ á†jÙJ/¿\"ã4ÒN>@\ﬂ\√%«ùJ/¿]~p>M>@ònÉ¿J/¿§Ö\À*L>@?V\€K/¿ßŒ£\‚ˇJ>@{L§4K/¿iß\ÊrÉI>@(˜é\ZK/¿ÅïCãH>@≤°õ˝ÅJ/¿,J	¡™F>@ª\÷ﬁß™H/¿⁄™$≤F>@7«πM∏G/¿8Û´9@D>@qê\ÂB/¿\ﬂÄcC>@‹∏\≈¸\‹@/¿ì\≈˝GB>@¶+\ÿF<A/¿∆¢\È\Ïd@>@ß\Õ8\rQE/¿¸\¬+Iû?>@Ù\ZªDıF/¿B[Œ•∏>>@Å\\\‚\»I/¿ŒéT\ﬂ˘=>@°B]J/¿gùÒ}q=>@≠€†ˆ[K/¿ˆ\”\÷¸<>@õÆ\'∫.L/¿À¢∞ã¢;>@6\‹,N/¿ló6ñ:>@9ó‚™≤O/¿éì¬º\«9>@HQg\Ó!Q/¿DkEõ7>@\Õ\Ã\Ã\Ã\ÃT/¿ùÇ¸l\‰6>@[\ÏˆYU/¿B\Ó\"LQ6>@#2¨\‚çT/¿\‰ºˇè6>@O\Ãz1îS/¿\‡LLb5>@øÄ^∏sQ/¿∞¨4)5>@Ù˛?NòP/¿øFí 4>@1\\\0qO/¿¿îÅ3>@<L˚\ÊN/¿\«bõT42>@¨8\’ZòM/¿ñ\–]g1>@4iSuèL/¿\Ÿ{ÒE{0>@wı*J/¿wûx\Œ0>@C\…\‰\‘\ŒH/¿k\‘C4∫/>@.©\⁄nÇG/¿\Á\»\ /É->@«°~∂>/¿Hp#eã,>@$^û\Œ=/¿SuèlÆ*>@\ﬂ3°</¿óqS)>@†àE;</¿Z5\—\Á\'>@	\›%qV</¿ô(B\Ív&>@dœû\À\‘</¿N	àI∏$>@bÇ\ZæÖ=/¿\ƒ	Lßu#>@^Háá0>/¿\Í≥Æ+\">@-C\Î\‚>/¿9	•/Ñ >@\ÌúfÅv?/¿Ù\ﬁÄ>@Gsd\Â?/¿PráMd>@‘ö\Êß@/¿˚∞ﬁ®\Z>@∂Û˝\‘xA/¿∞X\√E\Ó>@Ωp\Á\¬@/¿\„¸M(>@*¨ˇs@/¿º\Ë+H3>@sû±/\Ÿ@/¿ıf\‘|>@†ˇºvA/¿g}\ 1Y>@\√\ÿBêÉB/¿ö\ŒNG	>@T\·\œfE/¿ﬁë±\⁄¸>@YãO0F/¿\“S\‰q>@\ﬁ!\≈\0âF/¿üØY.>@X\ 2ƒ±F/¿ï\÷ˇ9>@™\rNDøF/¿´@->@Ù7°G/¿l\ndv>@m±F/¿£Xni5\0>@\Ã^∂ù∂F/¿\Áèim\Zˇ=@≤GW\ÈF/¿\Ô v¶\–˝=@\nºìOG/¿V\’\À\Ô¸=@+j0\r\√G/¿\‘\“\‹\naı=@\"®\ZΩ\ZH/¿l\Í<*˛Û=@ç\–\œ\‘\ÎF/¿RDÜUºÒ=@\ﬂ\·vhXD/¿i\Z\Õ=@u™)\…B/¿©OráM\Ï=@\›aôπ@/¿£è˘Ä@\Î=@\Õ >∞\„?/¿®5\Õ;N\È=@\Ã)1	?/¿>	l\Œ¡\Á=@b.©\⁄>/¿%≥zá\€\Â=@ú¯jGq>/¿më¥}\‰=@z\ƒ\Ëπ=/¿0K;5ó\„=@\«Hˆ=/¿\„â \Œ\√\·=@Òˆ \‰;/¿|Ú∞Pk\ﬁ=@y\"àÛp:/¿\Ëi¿ \È\€=@ÛW\»\\9/¿\›\ÔP\Ë\”=@6#É\‹E8/¿TãàbÚ\Œ=@Ω\»¸\Z9/¿˚På,\Õ=@XuV\Ï9/¿5EÄ”ª\»=@F?\ZNô;/¿;\‚ê\r§\«=@ˇØ:r§;/¿∫.¸\‡|\∆=@µ\ƒ\ h\‰;/¿\Ê!S>\≈=@Vúj-</¿˛∞V\Ì\¬=@*\Ê \Ëh=/¿]4d<JΩ=@c*˝Ñ≥C/¿\⁄B\Î\·ª=@\’Y-∞\«D/¿ûœÄz3∫=@\Œ\√	LßE/¿gH≈´∏=@U\ŸYF/¿Q\›\\¸m∑=@¿#*T7G/¿\Ê[\÷µ=@ˆ\·òeG/¿N∏WÊ≠≤=@˘¢=^HG/¿	5C™(Æ=@RCÄ\rH/¿`;±O¨=@v?T\ZI/¿4M\ÿ~2™=@h[\Õ:\„K/¿\ PS©=@CV∏M/¿≥yÛß=@_\'ıeiO/¿RÔ©úˆ§=@˜îú{P/¿˘†g≥\Í£=@òÖvN≥P/¿P\ƒ\"Ü¢=@˙ÒóıQ/¿\ÁˇUGé†=@j¿ \È\”R/¿êÖ\Ë8û=@	ß/˙R/¿Ë°∂\r£ú=@>\"¶DR/¿Ä∂’¨3ö=@väUÉP/¿\∆˜≈•*ô=@B$Cé≠O/¿;s	ﬂó=@i6è\√`N/¿w¶(óñ=@\Ãz1îM/¿û_î†øî=@`Z\‘\'πK/¿è·±ü≈í=@Bïö=\–J/¿B\Î\·\ÀDç=@ÜUºëyL/¿\«ÙÑ%å=@>\\r\‹)M/¿µå\‘{*ã=@\Ï´aN/¿#j¢\œGâ=@Eı\÷¿VQ/¿có®\ﬁ\Zà=@≠¯Ü\¬gS/¿\÷wıÜ=@õpØ\Ã[U/¿ \nfLÖ=@Ü\∆AúW/¿}!\‰ºˇÉ=@m˙≥Y/¿˙cZõ∆Ç=@ònÉ¿Z/¿\‘)ènÄ=@a\\:\Ê\\/¿\Á\‡ô\–$}=@øI”†h^/¿|_\\™\“z=@›≤C¸\√^/¿è®åw=@\ﬁ>´Ãî^/¿lZ)ru=@@\¬0`\…]/¿\—6Æs=@0du´\Á\\/¿)x\nπr=@	4\ÿ\‘y\\/¿n•\◊fcq=@Ü¨nıú\\/¿\…ëEöp=@31]à]/¿ΩU◊°ön=@\⁄\Á6\·^/¿Ù˙ì¯\‹m=@Ü©-uê_/¿íØRbk=@\r34ûb/¿)\Õ\Êi=@\⁄\«\n~c/¿$Cé≠gh=@é>\Êe/¿ì\‚\„≤g=@\Z2•f/¿â\–f=@\«ÙÑ%h/¿^d~çd=@˙&MÉ¢i/¿Dj\⁄\≈4c=@∑\ÔQΩj/¿Jô\‘\–`=@\Ã&¿∞l/¿∞\Áå(]=@ôõoD˜l/¿fJ\Îo	\\=@yGsdm/¿\ƒ\Ó;Ü\«Z=@VGétn/¿)%´\ÍY=@\„\ﬁ¸Üân/¿\›\ÕSrW=@Å[wÛTo/¿˜Ye¶¥V=@¯˛\Ì\’o/¿\◊M)ØïT=@^ú¯jGq/¿Z\Ÿ>\‰-S=@ãKU\⁄r/¿ô\ÿ|\\R=@í\·\n(t/¿ö]˜VP=@π\∆g≤v/¿ì6U˜\»N=@y≠Ñ\Óíx/¿Éà‘¥ãM=@>\Î\Z-z/¿G\Êë?L=@;n¯\›t{/¿∫2®68I=@\ÀJìR\–}/¿\ÎÛê)G=@\\Æ~lí/¿¡rÑ\‰E=@≠\ﬁ\·vhÄ/¿π6TåÛC=@\Ï.PR`Å/¿\Œ\ZºØ\ A=@∂\ÿ\ÌÉ/¿\›ãä@=@.9(aÜ/¿\’ZòÖv>=@w¢$$“Ü/¿v√∂Eô==@§aQá/¿˝ÜK:=@.W?6…á/¿‘π¢î8=@\√\Ô¶[và/¿u\"¡T37=@W\nÅ\\\‚à/¿ëC\ƒÕ©4=@/Ü\»\Èã/¿gG™\Ô¸2=@®UÙáfé/¿`\Â\–\"\€1=@Ùø\\ãê/¿Ùäßi0=@\·òeOì/¿\·\—\∆k-=@ú¡\ﬂ/ñ/¿\ÈÛQF\\,=@\ﬂ5\ËKoó/¿,Çˇ≠d+=@\Œ›Æó¶ò/¿¶\',ÒÄ*=@Z\÷˝c!ö/¿üXß\ ˜(=@∏\ ;ù/¿+√∏D\'=@\‡V*®†/¿Ö|–≥Y%=@œΩáKé£/¿\÷{L§$=@é\Zl\Í§/¿ _Bá#=@P6\Â\nß/¿ùæûØY\"=@_z˚s—®/¿3QÑ\‘\Ì =@f°\ÿ\n™/¿du´\Á§=@∞Y.ù´/¿i¨˝ù\Ì=@˝°ô\'Ø/¿9\‘\Ô\¬\÷=@óU\ÿ∞/¿O]˘,\œ=@∑]hÆ”∞/¿r¡¸˝\Z=@a\√\”+e±/¿j\¬ˆì1\Z=@\‰\◊±¡≤/¿m\«\‘]=@3˙\—p ¥/¿\Í<*˛\Ô=@<-?pï∑/¿3p@KW=@¸åB∫/¿ó\Z°ü©=@iV∂yª/¿jMÛ=@\‡ªÕª/¿\ÕYürL=@ä\…`\Êª/¿f0F$\n=@áäq˛&º/¿<L˚\Ê˛=@\‘©¢xΩ/¿ºëy\‰=@Têüç\\ø/¿\”ñx@=@∂°búø¡/¿;˝†.R=@ﬂß™\–@\ƒ/¿\≈7>[=@ö]˜V$\∆/¿>BÕê*=@0fKVE\»/¿î0\”ˆØ=@ÛsCSv\ /¿ÇUıÚ=@ûñ∏\ \À/¿¯ˆÆA=@29µ3L\Õ/¿∫K‚¨à\n=@\›&\‹+Û\Œ/¿†¶ñ≠	=@\…W)\—/¿=Fy\Ê\Â=@q„äã\”/¿\Ô\0OZ=@\ZøJí\◊/¿Jô\‘\–=@\‚X∑\Ÿ/¿\‚\ \Ÿ=@¢–≤\Ó\€/¿j\€0\nÇ=@˙\—p\ \‹\‹/¿4Ö\Œk\Ï=@R\”.¶ô\ﬁ/¿ì¨\√\—U=@áåG©Ñ\ﬂ/¿9\‘\Ô\¬\÷=@¯Ac&\·/¿-AF@Ö=@fÖ\"\›\œ\·/¿qÃ≤\'Å=@∫.¸\‡|\‚/¿“®¿\…6\0=@Çu?T\‚/¿ù‘ó•ù˛<@¸S™D\·/¿zﬁçÖ˝<@ÜV\'g\‡/¿?5^∫I¸<@Vºëy\‰\ﬂ/¿\…Y\ÿ\”˚<@≤◊ª\ﬂ/¿ü9\ÎSé˘<@l∞pí\Ê\ﬂ/¿®ê+ı,¯<@éíW\Á\‡/¿\rãQ\◊ˆ<@üwcAa\‡/¿;\0\‚Æ^ı<@ûô`8\◊\‡/¿˘,œÉªÛ<@èT\ﬂ˘E\·/¿\“\„˜6˝Ò<@O!W\Í\·/¿Uø\“˘<@\€\¬ÛR±\·/¿æJ>v<@≠\⁄5!≠\·/¿\n±àa\Ô<@ÅØ\Ë\÷k\‚/¿\“\·!åü\Ó<@\"nN%\„/¿§o\“4(\Ó<@˙\’ ò\„/¿øÙˆ\Á¢\Ì<@\‡ù|zl\„/¿\◊\€f*\ƒ\Î<@ö\Î4\“\‚/¿jh∞\È<@#[A\”\‚/¿∏\"1A\r\Á<@sˆ\Œh´\‚/¿\’ºÃ∞\Â<@ß\ËH.ˇ\·/¿{g¥UI\‰<@Ñ\’X\¬\⁄\‡/¿©i\„<@DäM\‡/¿|ÒE{º\‡<@S\\Uˆ]\·/¿)îÖØ\ﬂ<@ˆ\œ”ÄA\‚/¿:=\Ô∆Ç\ﬁ<@ú˚´\«}\„/¿%?\‚W¨\›<@\Án\◊KS\‰/¿(Hlw\‹<@\Â`6Ü\Â/¿pŒà\“\ﬁ\ÿ<@Ù§ã\Ê/¿ì6U˜\»\÷<@$\“6˛D\Â/¿õZ∂\÷\’<@∫ÿ¥R\‰/¿\ÓC\ﬁrı\”<@ßí†ä\„/¿Å@g“¶\“<@~\Z˜\Ê7\‰/¿â\ÓY\◊h\—<@t\Ô\·í\„\Ê/¿w˛E\–<@¢	±à\È/¿\0ˇî*Q\Œ<@6sHj°\Ï/¿\≈\…˝E\Õ<@ÕØ\Ê\0¡\Ï/¿¯˛\Ì\’\À<@≠mé\Î/¿|Gç	1\À<@Ö¥∆†\Í/¿!%Ã¥\…<@æøA{ı\È/¿ÙP€Ü\…<@P¶\—\‰b\Ï/¿ZÚxZ~\»<@dØwº\Ô/¿p>u¨R\∆<@t%\’?/¿äØv\Á\ƒ<@\nºìO\Ô/¿£ZDì\√<@Ü9Aõ\Ó/¿<\‹\rã¡<@}w+\Î/¿â\“\ﬁ\‡ø<@2\ËL\Í/¿G\Á¸«Ω<@ÛÆz¿<\Ï/¿\Z•Kˇíº<@ˇ∞•GS\Ì/¿µ‹ô	Üª<@\ÏΩ¯¢=\Ó/¿\rU1ï~∫<@}\È\Ì\œ\Ì/¿\Õ\» w∫<@*\‡û\ÁO\Î/¿A\”+£π<@éÀ∏©\È/¿Ü¨nı∏<@àFw;\„/¿*oG8-∏<@ë∫ù}\Â\·/¿2∆á\ŸÀ∂<@*\‰J=\‚/¿VF#üW¥<@∂Ñ|–≥\·/¿{\ÿl≥<@\«e\‹\‘\‡/¿!ë∂Ò\'≤<@pA∂,_\ﬂ/¿†4\‘($±<@–ó\ﬁ˛\\\‹/¿%ªî∞<@\‡ú•Ω\Ÿ/¿1\\\0qØ<@œ¢w*\‡\÷/¿D™b*≠<@.˛∂\'H\‘/¿aç≥\È¨<@˙,AF\–/¿¯nÛ∆©<@€§¢±ˆ\œ/¿Æc\\qq®<@\0\∆3h\Ë\œ/¿\Ì\÷2éß<@%W@°\Œ/¿yy:Wî¶<@fÇ\·\\\√\Ã/¿ív£è˘†<@§m¸â\ \Œ/¿≠\‹Ãû<@y\ j∫û\–/¿|∫∫c±ù<@πp $\–/¿æ€ºqRú<@\ﬁ\ﬂ4}\Œ/¿¥CV∑ö<@ùJÄ*\Œ/¿!\»A	3ô<@S\"â^\Œ/¿<J%<°ó<@±RAE\’\œ/¿YâyV“ñ<@T∆øœ∏\–/¿ùL\‹*àï<@òıI\Ó\–/¿Ä+Ÿ±î<@@âœù`\œ/¿}w+ì<@v28J^\Õ/¿\‰eM,ë<@\ 52;\À/¿\‚\ Ÿè<@Tç^\rP\ /¿\ÀÒ[é<@÷©Ú=#\…/¿\ ¿-]ç<@¨ æ+Ç\«/¿j§•Úvå<@\nÇ«∑w\≈/¿è™&à∫ã<@±¢\”0\ƒ/¿Tç^\rPä<@\—\Ëbg\¬/¿,G\»@ûâ<@@Ñ∏rˆæ/¿r•û°à<@óWÆ∑Õº/¿\∆\‡a\⁄7á<@z\Z0H˙º/¿m\«\‘]ŸÖ<@g\Ì∂ÕΩ/¿\ÿ\Ôâu™Ñ<@,ı,\ÂΩ/¿\ﬂ˚¥WÉ<@ˇ@πmﬂª/¿caàúæÇ<@\◊1Æ∏8∫/¿^\€\€-…Å<@º#cµ˘∑/¿Úaˆ≤\ÌÄ<@ª~¡nÿ∂/¿dêªSÄ<@Ú¥¸¿U∂/¿?rk\“mu<@\À+\◊\€f™/¿¨\0\ﬂm\ﬁt<@Ü\Âœ∑´/¿bª{Ä\Ós<@\Âöôù≠/¿û\Ôß\∆Ks<@/j˜´\0Ø/¿ñ_cDr<@™ö \Í>∞/¿ıı|\Õrq<@ı¢vø\n∞/¿N\Ï°}¨p<@ôÑyØ/¿è®åo<@[Œ•∏™¨/¿\ÿÙJYn<@√∂Eô\r™/¿?\∆\‹m<@\np®/¿ïa\‹\r¢m<@t{Ic¥¶/¿ïõ®•m<@õ\«a0•/¿ò\ﬂi2\„m<@HN&n§/¿\·\Ï\÷2n<@Háá0~¢/¿-óç\Œ˘m<@F\”\Ÿ\…\‡†/¿Ñ”Ç}m<@5≥ñ“û/¿-ZÄ∂\’l<@O\Õ\ÂCù/¿´\Õˇk<@Vúj-ú/¿Ù¡26tk<@ÒºTlÃõ/¿≥C¸√ñj<@¯\„ˆ\À\'õ/¿†‹∂\Ôi<@#Ω®›Øö/¿`>Y1\\i<@HõVö/¿jinÖ∞f<@\Ô%ò/¿Æ\ÎçZe<@(ªô—èñ/¿\÷»Æ¥åd<@¥Ë°∂ï/¿\‚\ \Ÿc<@ge˚ê∑î/¿Qic<@Ã≥íV|ì/¿m±üb<@d\Êó«í/¿¡\…6pb<@W\È\Ó:í/¿yaßXa<@i¢≤ë/¿pa\›xw`<@(õrÖwë/¿ë\'I\◊L^<@¥CV∑í/¿Öb\Ÿ\Ã]<@HP¸ì/¿˝Nìo[<@ó\ÊV´ë/¿é\"k\r•Z<@I/j˜´ê/¿#¢òºZ<@Ék\Ó\Ëè/¿nYk(Y<@\»^\Ô˛xè/¿ÄöZ∂\÷W<@¶}sè/¿à¬£çS<@\\*\∆˘ì/¿Æg\«,S<@ó\‚∂î/¿xö\Ãx[Q<@uñ/¿\"OíÆôP<@-`∑\Óñ/¿:\ ¡lP<@_∏sa§ó/¿.©\⁄nÇO<@≠\ﬁ\·vhò/¿âîMπN<@Låe˙%ö/¿@ø\Ô\ﬂL<@^f\ÿ(õ/¿\—\Èy7L<@4fıö/¿P6\Â\n\ÔJ<@E+˜≥ö/¿2q´ J<@\È\◊\÷Oˇô/¿Pîi4I<@ÜKÆbô/¿\“s]âH<@õèkC≈ò/¿1\Ìõ˚´G<@Bò€Ω‹ó/¿≤H\Ô\0G<@wÖ>X∆ñ/¿u\Õ\‰õmF<@m´Yg|ó/¿U\¬z˝E<@;˛ô/¿\–+ûz§E<@∏<÷åö/¿ddY0E<@®p©õ/¿†SêüçD<@\◊l\Â%ˇõ/¿f/\€N[C<@\0\ÊZ¥\0ù/¿é?QŸ∞B<@\Ê\ÿGßû/¿Ø(\r5B<@•û\–\Îü/¿¥WA<@t≥?Pn£/¿0Û¸@<@t@ˆ\Ì§/¿èVµ§£@<@âBÀ∫ß/¿ådèP3@<@Z,EÚï®/¿c\rπß?<@∫\¬j,©/¿Ñh\„à=<@†©\◊-´/¿c\Ÿ=y<<@\„\√\Ïe´/¿¨TPQı;<@l\œ,	P´/¿\Ê\"æ≥:<@|Vú™/¿\Z\‰.\¬8<@ê‹öt[™/¿c\—tv28<@ƒô_\Õ™/¿πDkE7<@2t\Ï®/¿X;äs\‘5<@Q\›\\¸mß/¿òßsE)5<@0ÒGQg¶/¿){K9_4<@\Óy˛¥Q•/¿Äbd\…3<@4iSuè§/¿ÇSH\ﬁ1<@\ƒ&2sÅ£/¿\Ï¡§¯¯0<@ŒßéU¢/¿∏Ö\ÎQ0<@\Á˝ú0°/¿[y\…ˇ\‰/<@Z~\‡*O†/¿q\„Ûs/<@5\nIfıû/¿Ø≤∂)/<@Òf\r\ﬁWù/¿L\ƒ[\Á\ﬂ.<@d≠°\‘^ú/¿¢cï∏.<@˛~1[≤ö/¿fΩ â.<@\ 4ö\\åô/¿\÷\…ä;.<@πﬂ°(–ó/¿\rP\Zj.<@≥öÆ\'∫ñ/¿-”æ-<@S\È\'úï/¿∂Û˝\‘x-<@S$_	§î/¿á\ﬂM∑\Ï,<@µ‹ô	Üì/¿S<.™E,<@º<i\·í/¿óˇê~˚*<@q\‚´≈ë/¿ÃòÇ5*<@(~åπkë/¿t¥™%)<@Ÿñg)ë/¿±\‹\“jH(<@:\Í\Ë∏\Zë/¿…´s\»&<@\Ã\rÜ:¨ê/¿z\·ŒÖ%<@o∫eá¯è/¿ƒòÙ˜R$<@∫\Ÿ(è/¿#É\‹Eò\"<@Ø≤∂)é/¿ïÙ0¥:!<@ª∑\"1Aç/¿$π¸áÙ<@∑BXç%å/¿˛µºrΩ<@\‘aÖ[>ä/¿vˇXà<@>\ÍÕ®â/¿õ˛\ÏGä<@¿\Í»ëŒà/¿`\…U,~<@u\…8F≤á/¿!\ËhUK\Z<@ü\ÂypwÜ/¿Äa˘Ûm<@_ïïÖ/¿\·&£\ <@B\Î\·ÀÑ/¿ìêH\€¯<@qtïÓÆÉ/¿¸˛Õã<@ŸïñëÇ/¿6?˛“¢<@]˚Ç/¿ß?˚ë\"<@YvQÙÄ/¿NöEÛ<@t\“˚\∆\◊~/¿Vc	kc<@õ\»\Ã~/¿ΩQ+L\ﬂ<@`[?˝g}/¿íîÙ0¥<@J¥\‰Ò¥|/¿\„OT6¨<@˛(\Í\Ã=|/¿\‰.\¬<@˘\⁄3K|/¿vkô\«<@Å∞S¨\Z|/¿W	á3<@WAt\Ì{/¿∂üåÒa<@\œNG\…{/¿\Ã\—\„˜6\r<@™\÷\¬,¥{/¿Ujˆ@+<@!\‰ºˇè{/¿=\Ó[≠<@˙\n“åE{/¿ <˜\n<@Na•Çäz/¿uV\Ï1	<@üêù∑±y/¿ù\œd<@\réíW\Áx/¿\Ìˇ∞•<@ürL˜w/¿ˇ\Œˆ\Ë\r<@≤\‘zø\—v/¿Û9wª^<@4d<J%t/¿ÆG\·z<@∑µÖ\Á•r/¿™D\Ÿ[\ <@bodq/¿ Ò+\÷p<@:@0Gèo/¿≥∂)<@UÜq7àn/¿˘ıCl<@>?ån/¿\≈<+i\≈<@.\ÁR\\Un/¿˛\'˜é<@\‡+∫ıön/¿Z†¶ñ<@\ \Zıçn/¿\ÁV´±\0<@ù∫ÚYn/¿J\ÌE¥ˇ;@\“\ZÉNm/¿CusÒ∑˝;@d=µ˙j/¿]\·].\‚˚;@t\Ï†\◊i/¿=⁄®N˚;@¿ \È\”*j/¿¿B\Ê †˙;@Gà,\“l/¿kô\«Û˘;@pCå◊ºr/¿≥∂)˘;@®\ÂÆÚt/¿∆øœ∏p¯;@r7à÷äv/¿a6Ü\Â˜;@-≥\≈Vx/¿πß´;ˆ;@˛ú0a|/¿`\»\ÍV\œı;@\◊h9\–C}/¿|\Ôo\–^ı;@\ËÖ;~/¿H¿\ËÚ\ÊÙ;@\√E\Ó\È\Í~/¿)^emSÙ;@\ﬁ	ä/¿ë(¥¨Û;@≥≥\Ëù\nÄ/¿-`∑\ÓÚ;@q\…qßtÄ/¿x\“\¬eÚ;@É§O´Ä/¿h◊ø\Ô;@F|\'fΩÄ/¿dWZF\Í\Ì;@≠jIGÅ/¿™Ä{û?\Ì;@¢\Ï-\Â|Å/¿\‘÷à`\Ï;@s/0+Å/¿∫†æeN\Î;@ãS≠ÖYÄ/¿aR||B\Í;@jgò\⁄R/¿wg\Ì∂\È;@√Éf◊Ω}/¿\‰G\Ë;@ˆ~£7|/¿jlØΩ\Á;@\Ï\›\ÔU{/¿ı\Ÿ\◊\Á;@IüVy/¿C\Á5vâ\Ê;@\»A	3mw/¿ä\ÂñVC\Ê;@1∑{πOv/¿ánˆ\ \Â;@\—yç]¢r/¿UΩ¸Nì\Â;@ïµMÒ∏p/¿\Ï.PR`\Â;@jÑ~¶^o/¿	\‚<ú¿\‰;@5≤+-#m/¿fæÉü8\‰;@?\0©Múl/¿\ÌπLMÇ\„;@n1?74m/¿û	M\„;@\Õ\Ínán/¿X≠L¯•\‚;@*©\–Dp/¿\√\’w\·;@û^)\Ào/¿Äùõ6\„\‡;@¨r°ÚØm/¿I˜s\nÚ\ﬂ;@r \nfl/¿ê\⁄\ƒ\…˝\ﬁ;@≥\≈V\–l/¿~˛{\⁄\›;@\ÌI`sn/¿å°úhW\›;@]˚z\·n/¿í≤E\“n\‹;@U[rp/¿<g≠\€;@ ãL¿Øq/¿t∑\Î•)\⁄;@DkEõs/¿&ßvÜ©\Ÿ;@\⁄YÙNt/¿:ì6U˜\ÿ;@M°Û\Zªt/¿∑ô\nÒH\ÿ;@õ.»ñu/¿&\≈\«\'d\◊;@˜ì1>\Ãv/¿£ËÅè¡\÷;@≥yÛw/¿ <˜\÷;@KxBØ?y/¿EbÇ\Zæ\’;@Öz˙¸y/¿\‡û\ÁO\’;@±O\0\≈\»z/¿\‡IóU\‘;@h[\Õ:{/¿Å≤)Wx\”;@Ü:¨p{/¿O\…9±á\“;@wΩ4EÄ{/¿Ùk\Îßˇ\–;@RΩ¬Ç{/¿\«\Ÿtp\œ;@£ x|{/¿\0\≈»í9\Œ;@≥\ÏI`{/¿xe®ä\Õ;@£\\\Zøz/¿L¶\nF%\Õ;@Ii6è\√x/¿í∞o\'\Õ;@I\◊Læ\Ÿv/¿7˝Ÿè\Õ;@\‰£\≈\√t/¿;åI/\Õ;@æ¿¨P§s/¿g)YNB\Õ;@\”L˜:q/¿â\—s]\Õ;@+0du´o/¿(\’>è\Õ;@PU°ÅXn/¿≠N\ŒP\‹\Õ;@≥\≈V\–l/¿\"m\„OT\Œ;@-\“\ƒ;¿k/¿ü\0äë%\œ;@\ÀM\‘\“\‹j/¿\·\n(\‘\œ;@¨0ôj/¿h$B#\ÿ\–;@\œjÅ=&j/¿ì˛^\n\”;@T5A\‘}h/¿>ì˝Û4\‘;@Ù•∑?g/¿lñ\ÀF\Á\‘;@˝ø\Í»ëf/¿™Ù\Œn\’;@*ènÑEe/¿“åE\”\’;@òMÄa˘c/¿K\Í4\÷;@∫\‹`®\√b/¿Û\‚\ƒW;\÷;@\ﬁû¥pa/¿Öy7\÷;@ò2p@K_/¿?\„\√\Ï\’;@N\“¸1≠]/¿\Ívˆï\’;@#\€˘~j\\/¿{JŒâ=\‘;@\≈oÚ[\\/¿°Gåû\”;@)≥	0\\/¿•†\€K\Z\”;@ßí†ä[/¿`ÆE\–\“;@\∆ià*¸Y/¿Àª\Í\”;@u \Î©\’W/¿Û\»<\”;@\“\Ó#∑V/¿3ä\ÂñV\”;@ˆ&Ü\‰T/¿FA¯\“;@úMG\07S/¿ì¨\√\—U\“;@ı+ù\œR/¿ô†Üoa\—;@˝I|\ÓS/¿¥r/0+\–;@0◊¢hS/¿2\"QhY\œ;@3mˇ\ JS/¿≠\ﬂLL\Œ;@Y˝ÜS/¿H\‚\Â\È\\\Õ;@|Ú∞PkR/¿¢Ø \Õ\Ã;@ir1\÷Q/¿Nˆ#E\Ã;@\Á˝ú0Q/¿\…t\ËÙº\À;@\Ã_!seP/¿\√ÛR±1\À;@4Úy\≈SO/¿CFó7\À;@=\Ó\Œ\⁄M/¿> à@\À;@t~ä\„¿K/¿P¸s\◊\ ;@\Ã&¿∞¸I/¿!\\Öz\ ;@©\Ÿ≠¿H/¿\Áå(\Ì\r\ ;@1y\Ã|G/¿R)v4\…;@°°ÇãE/¿é\»;@£\”0|D/¿X9\“\»;@;9Cq\«C/¿^¸o%\«;@\nK<†lB/¿pCå◊º\∆;@\’ºÃ∞A/¿	\∆¡•c\∆;@k◊Ñ¥\∆@/¿b0Ö\Ã\≈;@Ω¸Nì?/¿≠N\ŒP\‹\≈;@Y¿n\›=/¿Ω\nÉ\∆;@\–\“l;/¿èäˇ;¢\∆;@\⁄Ω\·>:/¿4.\…\∆;@|eﬁ™\Î8/¿\≈\ h\‰Û\∆;@xG\∆jÛ7/¿π8*7Q\«;@\"r˙zæ6/¿ˆ≥Xä\‰\«;@¢≤aM5/¿iå\÷Q\’\»;@≤.n£4/¿ß•h\…;@≠€†ˆ[3/¿\ËÖ;\ ;@Ù\≈ﬁã/2/¿z˝I|\ ;@ä\Ã\\\‡Ú0/¿1^Û™\ ;@ñzÑÚ./¿;\ﬂOçó\ ;@õ;˙_Æ-/¿7P\‡ù|\ ;@°1ì®,/¿ˆòHi\ ;@ö≤\”\Í*/¿kÅ=&R\ ;@\\ív5)/¿C9—ÆB\ ;@\\1–µ\'/¿9D‹úJ\ ;@ÆıEB[&/¿MÖx$^\ ;@ØZôK%/¿º∞5[yı;@WÌöê\÷(/¿\…\ÁO=ˆ;@\◊mP˚≠\r/¿\¬(õˆ;@ˆCl∞p/¿y¢\'eˆ;@’îdé˛.¿ÄJïÙ;@\—yç]¢\Í.¿\\t≤\‘zÛ;@9πﬂ°(\‡.¿DnÜÒ;@°-\ÁR\\\’.¿“ã\⁄˝*;@u\ÀÒ\À.¿;6Ò∫\Ó;@K\Èô^b\ƒ.¿≥ıµ.\È;@µ§£\Ã\Œ.¿|Vú\Ê;@õí¨\√—Ω.¿=\’!7\√\Â;@\·	Ω˛$æ.¿Ç˛Bè\Â;@´%\Â`æ.¿ÜUºëy\‰;@uv28Jæ.¿Ul\Ã\Îà\„;@Û\Ã\Àa˜Ω.¿Òùòı\‚;@CXç%¨Ω.¿Yni5$\‚;@Túà~Ω.¿K>v(\·;@:tzﬁçΩ.¿\“9?\≈q\‡;@ ò£\«\ÔΩ.¿\ƒ\Ïe\€i\ﬂ;@\nö]˜æ.¿v˘÷áı\ﬁ;@ùÄ&¬Üø.¿\ÊÆÚ\ﬁ;@˝i£:¿.¿C¨˛\√\‹;@¯¸0B¿.¿˛ûXß\ \€;@;\»\Î¡§¿.¿û≤öÆ\'\⁄;@˚\\m\≈˛\¬.¿¬ø\Z3\Ÿ;@\›\ÔP\Ë\√.¿òhêÇß\ÿ;@ßwÒ~\ƒ.¿É¶%VF\◊;@n¸â Ü\≈.¿¥é™&à\÷;@<ö$\∆.¿¥9\Œm\¬\’;@\›xwd¨\∆.¿\÷TÖ]\‘;@Øx\Íë\«.¿ywd¨6\”;@!Z+\⁄\«.¿∫Ù/Ie\“;@]åÅu\«.¿\Óñ\‰Ä]\—;@Rb\◊ˆ\∆.¿Ú\Ì]Éæ\–;@!è\‡F\ \∆.¿≤,ò¯\œ;@+n\‹b~\∆.¿Éâ?ä:\œ;@#ø~à\r\∆.¿á‡∏åõ\Œ;@˘ÑÏºç\≈.¿\¬\÷l\Â\Õ;@˙¥ä˛\–\ƒ.¿\‡ÿ≥\Á2\Õ;@™úˆîú\√.¿¨˛√Ä\Õ;@i¢≤¡.¿wj.7\Œ;@\√\Ô¶[v¿.¿aåHZ\Œ;@\‚\\\√çø.¿\⁄XâyV\Œ;@@Ω5_Ω.¿6oú\Œ;@x\—Wêfº.¿_b,\”/\Õ;@\“˛Xª.¿\‹h\0oÅ\Ã;@§\„jdW∫.¿“èÜS\Ê\ ;@\n1óTm∑.¿\Ámlv§\ ;@\ \‡(yu∂.¿û`ˇun\ ;@¡8∏t¥.¿v\ﬂ1<\ ;@\0™∏qã±.¿4ª\Ó\…;@%\ \ﬁRŒØ.¿raär\…;@\…væü\ZØ.¿vn⁄å\”\»;@ˆEB[Œ≠.¿=∑–ï\»;@H6W\Õs¨.¿…è¯k\»;@\‡ù|zl´.¿î0\”ˆ\«;@aâîM©.¿Yk(µ\«;@BÕê*äß.¿\’#\rnk\«;@ {Ω˚\„•.¿Ö\Õ\0d\«;@|¥8cò£.¿á\‹7\‡\«;@/¯4\'/¢.¿F\ne\·\Î\«;@˛C˙\Ì\Î†.¿B^&\≈\«;@—±ÉJ\\ü.¿¡s\Ô\·í\«;@	\∆¡•cû.¿ì9ñw\’\«;@*T7õ.¿.\ÊÁÜ¶\»;@w,∂IEõ.¿ë)Ç™\…;@ê‹öt[ö.¿ç“•I\ ;@*p≤\r‹ô.¿W>\ÀÛ\‡\ ;@VòáLô.¿•N@a\À;@¿v0büò.¿\ﬁ:ˇv\Ÿ\À;@OIüñ.¿‹Ä\œ#\Ã;@\⁄\…\‡(yï.¿\¬j,a\Õ;@z\‡c∞\‚î.¿epîº:\œ;@}\ËÇ˙ñë.¿9—ÆB\ \œ;@øb\rë.¿ •ÒØ\–;@Òh„àµê.¿oıúÙæ\—;@µ§£Ãé.¿VÒF\“;@}uU†ã.¿–õäT\”;@Ûë\ÔRä.¿1–µ/\‘;@⁄®Nä.¿é≠g\«\‘;@˙	g∑ñâ.¿O\Í\À\“N\’;@SÕ¨•à.¿aq8Û´\’;@\Œ\·Z\Ìaá.¿|DLâ$\÷;@œÑ&â%Ö.¿–ù`ˇu\÷;@¨µ<Ñ.¿tB\Ë†K\ÿ;@Fè6éÄ.¿ò¸O˛\Ó\Ÿ;@\”N\Õ\Â{.¿\—\Ëbg\⁄;@VõˇWy.¿`\À+\◊\€\⁄;@0ˆ^|\—v.¿0\’\ÃZ\n\‹;@«∫∏çx.¿@˜\Â\Ãv\›;@ ®2åªy.¿Û\ ı∂ô\ﬁ;@¶∏™\Ïªz.¿raär\·;@´\Ïª\"¯.¿|\”Ù\Ÿ\„;@ﬂøyqÇ.¿ÛèæI\”\‰;@Bx¥qƒÇ.¿≤◊ª?\Ê;@Eõ\„\‹&Ñ.¿Y˝Ü\Á;@\‡ÅÑÖ.¿„àµ¯\Ë;@e\ZM.Ü.¿-B±4\È;@\Â\–\"\€˘Ü.¿òk\—¥\È;@hzâ±Lá.¿ò¿≠ªy\Í;@É\Ë\⁄à.¿\rnk\œ\Î;@åæÇ4câ.¿àd»±ı\Ï;@ˇ\–Ãìkä.¿îΩ•ú/Ú;@D˝.lÕé.¿\rπß´Û;@ÏâÆ?ê.¿a≈©\÷\¬Ù;@ã2díë.¿iè\“\·ı;@EÇ©f÷í.¿Mg\'É£¯;@S=ôÙï.¿\›\Í9\È}ˇ;@#\∆ÇÑ.¿äíêH\€\0<@QJV’É.¿ÛÅŒ§<@\Î8~®Ñ.¿äc\ÓZ<@0EH›Ü.¿jˆ@+0<@\'¡“®à.¿ıÅ\‰ùC<@Åx]øà.¿¶∏™\Ïª<@¥up∞7â.¿O!W\Í	<@	á3øä.¿‘ûísb<@lï`q8ã.¿ò§2\≈<@˙≥)\"ã.¿∆ß\0\œ<@[A\”ã.¿=\Ó\Œ\⁄\r<@\È∂D.8ã.¿∂\ÿ\Ì≥<@ËÜ¶\ÏÙã.¿E.8Éø<@Úaˆ≤\Ìå.¿∫\Ÿ(<@ë’≠ûìé.¿¿œ∏p <@\≈X¶_\"é.¿≠jIG<@\ﬂ4}v¿ç.¿G\„\‡\“<@p¥\„Üﬂç.¿z4’ì˘<@-\ËΩ1ê.¿cπ•’ê<@f¯O7Pê.¿v28J^<@Aãvê.¿6oú\Z<@8-x\—Wê.¿–∏p $<@T\0åg–ê.¿ñ\"˘J <@eä9:í.¿QN¥´ê<@ˇwDÖí.¿_~ß…å<@\·F\ Iì.¿G¨≈ß <@?\0©Múî.¿¨Ôéå!<@AaP¶—î.¿\–)\»\œF\"<@RÔ©úˆî.¿:=\Ô\∆\"<@w€Ö\Ê:ï.¿¨TPQı#<@PäV\Óñ.¿=)ì\Z\⁄$<@l]jÑ~ñ.¿gÄ≤e%<@∫ÉÿôBó.¿c)íØ&<@t	4ò.¿ö[!¨\∆&<@@Pn\€˜ò.¿‹Ç•∫Ä\'<@\„OT6¨ô.¿E|V(<@çraö.¿_\Ì(\Œ)<@`\"ƒïõ.¿/j˜´\0+<@=}˛õ.¿\"\08ˆ\Ï-<@Úò˘û.¿£\\\Zø.<@ƒòÙ˜R†.¿\n\€\›0<@;ãﬁ©Ä£.¿iSuèl2<@∞|∑y£.¿G\„Pø3<@“ç∞®à£.¿\⁄T\›#õ3<@∑|$%=§.¿\ÊÁÜ¶\Ï4<@≠hsú€§.¿˙`∫5<@T˛µºr•.¿sePmp6<@\"R\”.¶.¿°h¿\"7<@˜ì1>Ã¶.¿Lé;•É9<@\ƒABî/®.¿sHj°d:<@ä\«Eµà®.¿\÷nª\–\\;<@π\√&2s©.¿M†àE<<@ÅØ\Ë\÷k™.¿\Í<*˛\Ô<<@\ÿùõ6´.¿iä\0ßw=<@#J{É/¨.¿u\»\Õp><@3®68≠.¿\„\„≤Û><@˛\Ôà\n’≠.¿D?ç{?<@†7©0Æ.¿\√e6@<@•Ö\À*lÆ.¿(FñÃ±@<@\”P£êdÆ.¿\ﬂ\≈˚q˚A<@\—Yfä≠.¿˙\Ô¡kóF<@\Z1≥\œc§.¿	¶öYG<@Å\ËIô‘†.¿º=˘N<@m™\ÓëÕù.¿\–~§àO<@–õäTõ.¿{°Ä\ÌH<@\ÍB¨˛õ.¿´!qè•K<@\Ê=\Œ4aÉ.¿\\\ÊtYLP<@\‚\ ŸÉ.¿Ø˛∑íQ<@•\»%é|.¿\’\ÏÅV`T<@\Ÿ@∫\ÿ|.¿ß•hU<@5y\ j∫v.¿\"ˇ\Ã >P<@__\ÎR#t.¿çüq\·P<@◊ÖúOm.¿Å%W±¯U<@ãá˜Xn.¿\“8\‘\Ô\¬V<@(ö∞\»g.¿Q£êdVS<@-[ÎãÑf.¿¢\”Ûn,T<@\“U∫ª\Œ^.¿t≥?PnW<@Õî\÷\ﬂ`.¿œª±†0X<@7âA`\ÂX.¿\'i˛T<@7¬¢\"NW.¿T8ÇTäU<@	4\ÿ\‘Q.¿Ø(\r5Z<@\∆¡•c\ŒS.¿ 	˚v]<@í#ùÅëO.¿`w∫Û\ƒW<@Ñcñ=	L.¿yít\ÕX<@MåJ\ÍD.¿>îh]<@sÙ¯ΩE.¿\nh\"lx^<@ÑHÜ[?.¿.9(ab<@AJòA.¿“åE\”\Ÿi<@MJA∑ó<.¿}yˆ\—u<@≤ÇﬂÜ?.¿a¸4\Ó\Õw<@2kúM?.¿©˙ïŒá{<@På,ôC.¿\0\Ê\ÀÄ<@QOÅ?D.¿ªG6W\Õ<@M.\∆¿:F.¿\¬/ıÛ¶Ç<@P\ƒ\"ÜF.¿&\»®på<@\„\√\Ïe[.¿7ãC†<@åL¿Øë\\.¿åâB£<@»ïzÑZ.¿R~R\Ì£<@\◊\¬,¥sZ.¿Œã_\Ì§<@%ZÚxZ.¿éW zR¶<@ZJñìPZ.¿\‚\\\√çß<@/\√∫ÅZ.¿bX9¥®<@≈≠Ç\ËZ.¿≤æÅ…ç™<@1$\'∑Z.¿\ \≈X«≠<@b->¿X.¿¥ì¡QÚÆ<@õèkC\≈X.¿T˝J\Á√Ø<@≤fdêªX.¿t)Æ*˚≤<@”º\„Y.¿ôÄ_#I¥<@¢≤aMeY.¿πT•-Æµ<@˚>$DY.¿À†\⁄\‡D∏<@7¬¢\"NW.¿\—$±§‹Ω<@{˘ù&3V.¿U/ø\”dæ<@f1±˘∏V.¿2\"QhYø<@\›&\‹+ÛV.¿ìsb\Ìø<@¸\·\ÁøW.¿s°ÚØ\Â¡<@\Ë†K8ÙV.¿\Zàe3\√<@¨ã\€h\0W.¿Æ+fÑ∑\√<@°l\\ˇV.¿êÑ};â\ƒ<@=\Ó[≠W.¿d\ÀÚu\≈<@ﬂáÉÑ(W.¿\Îptï\Ó\∆<@äë%s,W.¿^J]2é\…<@)x\nπRW.¿!u;˚\ <@#ÖñuW.¿Ú#~\≈\Z\Œ<@.rOWW.¿Qª_¯\Œ<@õq\Z¢\nW.¿}!\‰ºˇ\”<@\Ã(ñ[ZU.¿Åy»î\’<@nàÒöWU.¿\–{c\0\÷<@\ÔÀô\Ì\nU.¿0†\Ó\\\ÿ<@¢`\∆T.¿2t\Ï\ÿ<@Nó\≈\ƒ\ÊS.¿[≤*\¬M\⁄<@Öz˙T.¿|\—/§\ﬂ<@e®ä©ÙS.¿ïA\’\Ëı<@h>\Ánˇ-¿ôK™∂õ¯<@\È\◊\÷Oˇ˘-¿|\'fΩ˛<@£:\»z˙-¿≥Bë\Ó=@hî.˝K˙-¿Kiˇ =@µâì˚Ú-¿78˝\⁄>=@@ﬁ´V&º-¿_&äê^=@7«πM∏˜-¿ãˇ;¢BÅ=@å.o˜-¿&\„\…Å=@”æπøz§-¿)\Õ\ÊÅ=@6wÙø\\£-¿;\ﬂOçóÇ=@§\0Q0c¢-¿ê/°ÇÉ=@∑b\Ÿ=°-¿€ø≤“§Ñ=@\Á™yé»ü-¿a\√\”+eÖ=@R\r˚=±û-¿\ƒ\'iÜ=@<k∑]hû-¿@7n1á=@\∆¯0{Ÿû-¿å†1ì®á=@\—Á£å∏†-¿0\’\ÃZ\nà=@5\Ê\Ë°-¿.sûâ=@Ü˘a§-¿ a∞\‰ä=@¨TPQı£-¿Æü˛≥\Êã=@((E+˜¢-¿ºZ\ÓÃå=@§å∏\04¢-¿©\‹D-Õç=@∂¯\0\„°-¿Äüq\·@ê=@ëFN∂°-¿[ôK˝ê=@¸®Ü˝û†-¿\'˜;í=@W\ËÉel†-¿©iì=@¨6ˇØ:¢-¿bôπ¿ï=@à,\“ƒ£-¿#K\ÊXñ=@É¸l‰∫°-¿#K\ÊXñ=@˜¨k¥†-¿\‰Ç3¯˚ï=@z\·ŒÖëû-¿¯O7P\‡ï=@°Û\ZªDù-¿?\∆‹ï=@IÚ\\ﬂáõ-¿EgôE(ñ=@ß\∆K7ô-¿w¶(óñ=@M¿Øë$ò-¿0c\n\÷8ó=@\Ãe˝ñ-¿¢|A	ò=@bôπ¿ï-¿\∆k^\’Yô=@˛(\Í\Ã=î-¿L5≥ñö=@</O\Áí-¿+Ÿ±àõ=@/àHMªê-¿øÛãÙõ=@ï-Ø\\è-¿™cï\“3ù=@\”˙[è-¿\⁄r.≈ù=@p≥x±ê-¿˛aKè¶û=@ßÆ|ñ\Áë-¿∂¢\Õqnü=@Háá0~í-¿\ﬁ8)\Ã{†=@i\ƒ\Ã>èë-¿®´;€†=@8˜Wè˚é-¿≠jIG°=@µ\·∞4ã-¿OZ∏¨¢=@t\Ï†◊â-¿˙∏6Tå£=@ZÉ˜Uπà-¿ePmp\"¶=@ñ\—\»\Áá-¿Ù\ﬁÄß=@˜ë[ìÜ-¿~\Z˜\Ê7®=@í\ÀHøÖ-¿\ ¸£o“®=@Ñ.\·\–[Ñ-¿c‘µˆ>©=@{†≤Ç-¿1óTm7©=@gµ¿Å-¿≤\r‹Å:©=@ºÃ∞Q\÷-¿`\"ƒï´=@ü`<É~-¿âóßs≠=@£<Ûr\ÿ}-¿Ú\"k∞=@;\·%8}-¿eqˇë\È¥=@\’\Ì\Ï+z-¿±¿Wt\Îµ=@gE\‘Düw-¿\Ÿ\Èuë∂=@X®5\Õ;v-¿o+Ω6∑=@◊ÖúOu-¿\ŒQ⁄∑=@\€‹òû∞t-¿’∞\ﬂ\Î∏=@ê¿~˛s-¿\n‹∫õßæ=@˙’ë#m-¿æ-X™¿=@˜\"⁄é©k-¿—≠\◊Ù†¿=@\À⁄¶x\\l-¿≤LøDº¡=@ç∑ï^õm-¿6\Àe£s\¬=@ãvìn-¿°ø\–#F\√=@+ˆó›ìo-¿=Òú- \ƒ=@ä\‰+Åîp-¿¨\∆\÷\∆\ƒ=@!≠1\ËÑp-¿\Î©\’WW\≈=@î\√\’p-¿ÀÑ_\Í\Á\≈=@8gDio-¿¶\nF%u\∆=@ò\‹(≤n-¿n\‡\‘)\«=@∑\Ïˇ∞m-¿z\Ô\«\Ì\«=@®Tâ≤∑l-¿£<Ûr\»=@ç\r\›\Ïl-¿ß∞RAE\…=@\'Öyèk-¿ç\ÔãKU\ =@åø\Ì	k-¿˛\Ó5&\Ã=@gÄ≤ei-¿3nj†˘\Ã=@™πnh-¿\‡Jvl\Œ=@\…<˜f-¿≈êúL\‹\Œ=@q\»\“e-¿\÷ˇ9Ãó\œ=@i:;e-¿ı\’UÅZ\–=@ªa€¢d-¿\ƒ\'i\“=@\€\€-\…c-¿Ú\ÏÚ≠\”=@Ä≤e˘b-¿&˝Ω\‘=@¢\nÜ7c-¿2\Á˚í\’=@@x\Ó=d-¿\Õ<π¶@\÷=@SÕ¨•Äd-¿&VF#ü\◊=@5%Yá£c-¿¿\Õ\‚\≈\⁄=@\«\røõna-¿Ãñ¨äp\€=@Eı\÷¿Va-¿-îLN\Ì\‹=@e\ZM.\∆`-¿Ü\»\È\Î\›=@S8Ωã_-¿kQL\ﬁ\‡=@®ßè¿^-¿@˜\Â\Ãv\·=@êáæªï]-¿Y4ùù\‚=@Ü8\÷\≈m\\-¿>]›±\ÿ\‚=@GÆõR^[-¿0É1\"Q\‰=@â\—s]Y-¿2uWv¡\‰=@9—ÆB\ W-¿M0úkò\Â=@°J\ÕhU-¿()∞\0\Ê=@\Îsµ˚S-¿g~5\Ê=@¨êÚìjO-¿ûéíW\Á=@.=ö\Í\…L-¿§ng_y\Ë=@˜≥BëN-¿dø\r1\Í=@/á\›wW-¿FA¯ˆ\Í=@é@ºÆ_X-¿™úˆîú\Î=@óé9\œX-¿ˆõâ\ÈB\Ï=@7Ou\»\ÕX-¿p\ÓØ˜\Ì=@m<\ÿb∑W-¿ç≥\È\‡\Ó=@\‚[X7\ﬁU-¿µ•Úz=@\ÂI\'T-¿D¿!T©Ò=@\…g˜S-¿Ò/Ç\∆LÚ=@\Ã\Ì^\ÓìS-¿â)ëD/Û=@\À0\Ó\—R-¿\“\√\–\Í\‰Ù=@d~ç$Q-¿˝\\¨®ı=@æ°\Ÿ:P-¿ñZ\Ô7\⁄ı=@\Ó≥\ LiM-¿\"\„Q*\·ı=@ù‘ó•ùJ-¿|\’ Ñ_ˆ=@6Y£¢I-¿~;âˇˆ=@˛EÅ>I-¿˚\Î\‹˜=@˚\Ái¿ I-¿]QJV˘=@•jª	æI-¿d\…Àª˙=@ï*QˆñJ-¿ΩLäè˚=@\ﬁ\»<ÚK-¿d á†j¸=@¸¸˜\‡µK-¿\Ó\'c|ò˝=@ˆ\\¶&¡K-¿3á§J˛=@K:\ ¡lJ-¿CsùFZ˛=@°ª$ŒäH-¿ïú{hˇ=@\“\‚åaNH-¿0Ieä9\0>@GM-¿\ËO=\“\0>@Ø@Ù§L-¿¯ãŸíU>@&˝ΩL-¿\⁄SrN\Ï>@\Ó&¯¶\ÈK-¿0.s>@¡R]¿\ÀL-¿Jy≠Ñ\Ó>@Q.ç_xM-¿å≥óm>@G\Â&jiN-¿$π¸áÙ>@êΩ\ﬁ˝ÒN-¿(\nÙâ<>@Æº\‰ÚO-¿\‡°(\–\'>@\Âb¨\„P-¿\Ô\Á\‰g>@`ù∫ÚQ-¿L˙{)<>@QΩ5∞UR-¿\“TO\Ê	>@åÙ¢vøR-¿ë\'I\◊L\n>@`èâîfS-¿\Ãa˜\√>@p]1#T-¿9	•/Ñ>@b¿í´XT-¿2sÅ\Àc\r>@X·ñè§T-¿]7•ºV>@\»(œºV-¿&jj\Ÿ>@\ÃoBX-¿\›`®\√\n>@9|“â[-¿∑ñ\…p<>@]¿\À]-¿p\ÍîG>@\0VGét^-¿∞»Øb>@U¡®§N`-¿S8Ωã>@G:#/c-¿pUjˆ>@Kí\Á˙>d-¿ùæûØY>@@¡≈ä\Zd-¿ÿº™≥Z>@YiR\n∫e-¿¡ë@ÉM>@˛_u\‰Hg-¿•ÙL/1>@-≤ù\Ôg-¿öœπ\€ı>@Ù\Ô9h-¿Tb.>@\\´=\ÏÖj-¿\'¢_[?>@ôõoD˜l-¿ü!≥\Ï>@`\Ë£\Án-¿|⁄•\r>@‘∑\Ã\È≤p-¿aS\ÁQÒ>@ﬁí∞´q-¿\ÿ“£©û>@bù*\ﬂ3r-¿Õ≠Vc>@-∞\«DJs-¿é::ÆF>@0ûACˇt-¿\⁄\≈4”Ω>@K\…rJw-¿2: 	˚>@ˆ\rLny-¿û≥Ñ\÷>@9∂û!{-¿gö∞˝d >@Äµj◊Ñ|-¿ã\›>´\Ã >@\Íy7~-¿ÆfùÒ}!>@uîÉ\ŸÄ-¿-]¡6\">@Õê*äWÅ-¿˚ñ9]#>@\‹Û¸i£Ç-¿◊°öí¨#>@¡ˇV≤É-¿q\ÊWsÄ$>@ª∑\"1AÖ-¿FzQª_%>@\€j\÷ﬂá-¿I\Ÿ\"i7&>@)\Õ\Êâ-¿\‚\‡I\'>@Lk\”\ÿ^ã-¿\'OYM\◊\'>@jøµç-¿»±ı\·(>@_D\€1uè-¿˘¯Ñ\Ïº)>@\…=]›±ê-¿Ø$yÆ+>@\Â\≈oí-¿\∆\·ÃØ\Ê,>@∫/g∂+î-¿oÅ≈è->@œ¢w*\‡ñ-¿\€\–w.>@*\∆˘õò-¿àÄC®R/>@\rP\Zjö-¿gE\‘Dü/>@åJ\Íú-¿¸¸˜\‡µ/>@	§ƒÆ\Ìù-¿\Õ=$|\Ô/>@Q£êdVü-¿lMK¨0>@\œ¿\»Àö†-¿Àüo2>@E/£Xn°-¿~Ωp\Á2>@\Èc> –°-¿|\—/§3>@∂◊Ç\ﬁ£-¿sI\’v4>@ëH\€¯•-¿Ö\\©gA4>@MøDºu¶-¿LQ.ç_4>@	Tˇ í©-¿J@L¬Ö4>@Ü∂É´-¿zlÀÄ≥4>@•æ,\Ì‘¨-¿7âA`\Â4>@\·}U.TÆ-¿ùÅëó55>@\ÿ*¡\‚∞-¿ç\œdˇ<5>@∫q≤-¿¯¨85>@∫û\Ë∫≥-¿\√DÉ<5>@|òΩl;µ-¿õèkC5>@i\⁄V≥∂-¿ä9:Z5>@î2©°\r∏-¿k{°Ä5>@?\·\Ï\÷2π-¿i˛ò÷¶5>@Ñπ\›\À}∫-¿\—\À\ÿ\–5>@Nó\≈\ƒ\Êª-¿´=\ÏÖ6>@F–∂öΩ-¿\\sGˇ\À5>@S\ k%tø-¿)\–\'Ú$5>@ ©ùaj\√-¿Ü™òJ?5>@\‘\◊Û5\À\≈-¿êÇßê+5>@r\‹)¨\«-¿÷år5>@8øa¢A\ -¿˛}∆Ö5>@Z∫Çm\Ã-¿\"\√*\ﬁ\»4>@*ê\ŸYÙ\Œ-¿\À-≠Ü4>@ä\Ã\\\‡Ú\–-¿J_9\Ô3>@m©Éº\‘-¿ÆÄ∏3>@}%êª\÷-¿‡¢ì•\÷3>@r•û\Ÿ-¿}ï|\Ï.4>@\≈s∂Ä\–\⁄-¿áNœª±4>@®\»!\‚\Ê\‹-¿%A∏\n5>@;ç¥T\ﬁ\ﬁ-¿AIÅ05>@\ÃC¶|\‡-¿˛HV5>@y¢\'e\‚-¿oG8-x5>@Rêh\Â-¿ıi˝°5>@:Ø±KT\Á-¿Ä,Dá¿5>@Uø\“˘\Ë-¿7©h¨˝5>@\ﬂ˝Ò^µ\Í-¿¸\„Ωje6>@1¨Z\Ï-¿2W\’6>@\—vL›ï\Ì-¿T9\Ì)97>@™*4\À\Ó-¿%z\≈r7>@\ﬁ:ˇv\Ÿ\Ô-¿\Õr\Ÿ\Ëú7>@BBî/hÒ-¿ıcì¸à7>@\Î∆ª#Û-¿\0<¢Bu7>@\·”úº\»Ù-¿_\nö]7>@u\Õ\‰õmˆ-¿2\√FY7>@\⁄∆ü®l¯-¿^¢zk`7>@cÄD(˙-¿Ò\‘#\rn7>@#æ≥^¸-¿i¿\"ø6>@ó\0¸S™¸-¿',1607362055,1607362055,NULL,NULL),(6,'Muchinga',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\0\Â	\0\0£ë\œ+ûû>@=Úœ•&¿¥À∑>¨ü>@í\Ã\Ínß&¿j\ﬁqäé†>@%\Á\ƒ⁄ß&¿˜â\Ì\Ó°>@\"ã4Ò®&¿é\Ê\»\ /£>@HßÆ|ñß&¿rl=C§>@†ä∑òß&¿5\Ô8EG¶>@Å≈è1ß&¿á\ﬂM∑\Ï®>@è•]Pß&¿yë	¯5™>@˚\Â∂}ß&¿:dØw´>@_∏sa§ß&¿~¸•E}Æ>@e5]Ot•&¿\«e\‹\‘@Ø>@\Î∆ª#£&¿Å>∞>@KêP\·†&¿:vPâ\Î∞>@@\€j\÷ü&¿\Âò,\Ó?≤>@oıúÙæô&¿=\Ô∆Ç¬¥>@˚uß;Oî&¿µnÉ\⁄oµ>@ií&¿ó6ñ∂>@\ﬂN\"¬øê&¿ˆyåÚÃ∑>@∞\‚ä&¿®ê+ı,∏>@tôöoà&¿é#\÷\‚S∏>@\Õ<π¶@Ü&¿ù,µ\ﬁo∏>@ö\\åÅuÑ&¿ä!9ô∏π>@xµ‹ôÅ&¿bù*\ﬂ3∫>@\”\ÿ^z&¿Ü7kæ∫>@2!Êí™}&¿z•,Cª>@û~P)|&¿∂¢\Õqnª>@\≈V–¥\ƒz&¿§SW>Àª>@\ËO=\“x&¿&\≈\«\'º>@qqTn¢v&¿ê\ÂZº>@‰ªî∫dt&¿∞Æ\n\‘bº>@iN^dr&¿Xë\—Iº>@5óup&¿Uá\‹7º>@:Z’ín&¿ææ÷•Fº>@6Y£¢i&¿(~åπkΩ>@.\≈Ue\ﬂe&¿\\\„3\Ÿ?ø>@\Í\ gyd&¿É˚¿>@¿\Î3g}b&¿Ø\\oõ©¿>@aßX5`&¿ä≠†i¡>@Q0c\n^&¿E7ß\¬>@-z®m[&¿e¶¥˛ñ\ƒ>@\Z\‹\÷ûW&¿T8ÇTä\≈>@+QˆñrV&¿\”N\Õ\Â\«>@*U¢\Ï-U&¿\‹N^\»>@Vúj-T&¿\…<Ú\À>@9òMÄaQ&¿@§ﬂæ\Ã>@c\'ºßN&¿∏;k∑]\Ã>@v\Zi©ºM&¿0ª\'\Õ>@Ù˚˛\ÕK&¿î.´∞\Õ>@0J\–_\ËI&¿\»–±É\Œ>@ÆÒô\ÏüG&¿\ﬂ¡O@\œ>@\»#∏ë≤E&¿S	O\Ëı\œ>@å\ÿ\'ÄbD&¿@3à\Ï\–>@Y\€èãB&¿\ƒ\·\—\∆\—>@tôöo@&¿ì¨\√\—U\“>@«°~∂>&¿G\r6u\“>@ﬁè\€/ü<&¿⁄íUn\“>@Ωßr\⁄S:&¿_&äê\“>@∑õ\‡õ¶7&¿ÚöWuV\”>@xóã¯N4&¿\ƒxÕ´:\◊>@\Ï¯/0&¿Ù\‹BW\"\ÿ>@/m8,\r,&¿n¢ñ\ÊV\ÿ>@Ûr\ÿ}\«(&¿±mQfÉ\ÿ>@3\‚\–(%&¿\ŸwEø\Ÿ>@!w¶(&¿û{ó\€>@O\\éW \Z&¿\√e6\‹>@˙ôz\›\"&¿DN_\œ\◊\‹>@√ú†M&¿g)YN\ﬁ>@G∞q˝ª&¿f\€ikD\‡>@;ßY†\›&¿\’íw\·>@ò§2\≈&¿ﬁêFN\‚>@D‹úJ &¿¥\Â\\ä´\‚>@gÔå∂*!&¿3Pˇ>\„>@Å@g“¶\"&¿O¨S\Â\„>@Ø\Í¨\ÿ#&¿1\”ˆØ¨\‰>@©¶\Ô5$&¿$)\Èah\Â>@‚îπ˘F$&¿Ü øñW\Ê>@P6\Â\n\Ô\"&¿/O\Áä\Ê>@\Õ\ ˆ!o!&¿≥\œcîg\Ê>@®\ƒuå+&¿â\–\Ê>@Øò\ﬁ&¿êÇßê+\Â>@`∑\Ó\Ê&¿\Ê@µm\‰>@w˛E&¿ÑÇR¥r\„>@\œK\≈∆º&¿\œh´í\»\‚>@\›\”\’ã&¿b.©\⁄n\‚>@Ö\È{\r¡&¿∂†˜\∆\‰>@¶Å’∞&¿Tç^\rP\Ê>@ ^\◊/\ÿ\r&¿‹Ç•∫Ä\Á>@È∑Ø\Á&¿ﬂ•\‘%\„\Ë>@§\‰\’9&¿âC6ê.\Í>@\ÕW\…\«\Ó\n&¿\¬hV∂\Ì>@¸ﬁ¶?˚	&¿êÙi˝\Ì>@R\’Q˜	&¿zV“äo>@\¬˘‘±J	&¿>\ÈDÇÒ>@sGˇÀµ&¿Háá0~Ú>@\‡IóU&¿πçÙ>@rP\¬L\€&¿\≈9\Í\ËÙ>@g\Ó!\·{&¿\€nÇoöˆ>@ìW\Áê&¿Û\“o_˜>@åªA¥V&¿CÆ‘≥ ¯>@B	3mˇ&¿!>∞\„ø¯>@i¨˝ù\Ì&¿®\∆K7â˘>@˘aÑ\0&¿S%\ \ﬁR˙>@9\n\0&¿.é\ M\‘˙>@˚=±Nïˇ%¿;åI˚>@Òπ\Ïø˛%¿Y2\«ÚÆ˙>@˙π°);˝%¿™Å\Ês\Ó˙>@\Ã\'+Ü´˚%¿}Xo\‘\n˚>@{M\nJ˘%¿äWY\€˚>@´\Á§˜ç˜%¿sÄ`é˚>@Û«¥6çı%¿\€2\‡,%˚>@h\ÏK6Ù%¿i®QH2˚>@\·(yuéÒ%¿aUΩ¸N˚>@EÄ”ªx\Ô%¿œ†°Ç˚>@˘Ûm¡R\Ì%¿D¢–≤\Ó˚>@¶∏™\Ïª\Í%¿\râ{,}¸>@∏\‰∏S:\Ë%¿	\≈V–¥¸>@•˘cZõ\Ê%¿pw\÷nª¸>@\Êï\Îm3\Â%¿l?\„\√¸>@G\ Iª\·%¿©Mú\‹\Ô¸>@\»\Ôm˙≥\ﬂ%¿µ\—vL˝>@lMK¨\‹%¿`∑\Ó\Ê˝>@#˜tu\«\⁄%¿mésõpˇ>@ƒòÙ˜R\ÿ%¿Aãv\0?@ì†ä\◊%¿ÄÚw\Ô®?@6\\ê\’%¿\Ï£SW?@\0!Æ\‘%¿\ƒxÕ´:?@¯˘\Ô¡\”%¿˙|î?@’íér0\”%¿§à´?@ıÇOsÚ\“%¿b0Ö\Ã?@Uæg$B\”%¿N∏W\Ê≠?@˛b∂dU\‘%¿;%Ø?@&8ıÅ\‰\’%¿\’w~QÇ?@*V\r\¬\‹\÷%¿†\‡bE\r?@}˛Û\◊%¿\ﬁ…ß?@\Înû\Íê\€%¿ø\”d\∆\€?@˘÷áıF\›%¿3o\’u®?@_D\€1u\ﬂ%¿¨êÚìj?@ö∞»Ø\ﬂ%¿™FØ?@JV\’\À\ﬂ%¿Y•ÙL/?@í>≠¢\ﬂ%¿n\€˜®ø?@ˇïï&•\‡%¿ö$ñîª?@î.´∞\·%¿˛{⁄•	?@pz\Ô\«\Â%¿!\Œ\√	L?@ÑGG¨\Â%¿õ\„\‹&\‹?@˙π°);\Â%¿=ª|\Î\√?@\Ê\Â∞˚é\Ÿ%¿]3˘fõ?@Ú}q©J\”%¿(\ 4ö?@,cC7\”%¿ªÒ\Ó\»X?@§ã¶\”%¿sæ\ÿ{Ò?@~7›≤C\‘%¿É˘+d?@V\’\À\Ô\‘%¿]5\œ˘?@ˇ^\nö\’%¿\ÀK˛\'?@og_yê\÷%¿S	O\Ëı?@\‰,\Ïiá\◊%¿7n1?7?@C\·≥up\ÿ%¿iå\÷Q\’?@Æπ£ˇ\Â\⁄%¿@ä:s?@Ÿ∞¶≤(\‹%¿?\·\Ï\÷2?@7¡7Mü\›%¿ö±h:;?@§˝∞\ﬁ%¿\⁄V≥\Œ?@¸\‚Rï∂\‡%¿ZKiˇ?@´]\“\Z\„%¿ì\Z\⁄\0l?@◊à`\\\Í%¿cò¥\…?@÷™]\Í%¿ù\’{L?@≥\Ó\—\È%¿ä Ü5ï?@ã∑òü\Î%¿›ó3\€\Z?@\÷\‰)´\È\Í%¿v\∆˜≈•\Z?@!ÆúΩ3\Í%¿Ø$yÆ?@J∂∫ú\Ë%¿É5Œ¶#?@F\ÔT¿=\Á%¿3\›Î§æ?@K∞8ú˘\Â%¿#k$?@\rR\‰%¿!\ÕX4ù?@!£Àõ\„%¿ µâì˚?@ÊØêπ\‚%¿9GW?@S[\Í Ø\ﬂ%¿f-§˝?@π\04Jó\ﬁ%¿|òΩl;!?@ÁãΩ_\‹%¿¥≠fù!?@\ƒ	Lßu\€%¿oEbÇ\Z\"?@M,\›\⁄%¿wIúQ#?@\Œ9x&4\Ÿ%¿\ÔU+~%?@%îær\÷%¿=_≥\\6&?@\‘E\ne\·\”%¿%ZÚx&?@ÆfùÒ}\—%¿>\Ã^∂ù&?@ö\Ô\‡\'\–%¿\Î™@-\'?@¶^∑å\Õ%¿¨ æ+Ç\'?@æ-X™\À%¿ˆ&Ü(?@!\‰K®\»%¿L\√)?@\Ÿ[\ ˘b\«%¿…ØbÉ)?@ˆòHi\∆%¿ÆÛoó˝*?@\—;p\œ\√%¿(Òπ\Ï+?@\—\À(ñ[\¬%¿ún\Ÿ!˛-?@81$\'ø%¿;˛.?@˛c!:æ%¿á®¬ü\·-?@9ºZ\Óº%¿M0úkò-?@t~ä\„¿ª%¿F#üW<-?@Ee√ö ∫%¿øeNó\≈,?@πT•-Æπ%¿U2\0Tq+?@´>W[±∑%¿õ7N\nÛ*?@`\"\ﬁ:ˇ∂%¿\¬\¬Iö?*?@\ËÖ;∂%¿8§QÅì)?@üuçñµ%¿à\’a(?@™∏qã˘±%¿N\r4üs\'?@Ò1%í∞%¿éÖAô&?@\ƒ\—U∫ªÆ%¿˜;˙$?@•Çä™_©%¿±1Ø#%?@1&˝Ω¶%¿rn\Óï%?@\Z•Kˇí§%¿˚\Í™@-&?@Zc\–	°£%¿\nΩ˛$>\'?@$Di¢%¿Ùø\\ã(?@<Pß<∫°%¿[ú•d)?@\—x\"àÛ†%¿FñÃ±º+?@P4`ëü%¿óëzO\Â,?@Ÿ≤|]Üü%¿j\€0\n.?@ÛvÑ”Çü%¿ù+J	¡.?@•û°ºü%¿Ú}q©J/?@Çt±i•†%¿`±Üã\‹/?@IÇp¢%¿\›y\‚9[0?@¡s\Ô·í£%¿%vmo∑0?@f°ù”§%¿]¿\À1?@\∆6©h¨•%¿¢ñ\ÊV3?@\rˇ\È\n§%¿@M-[\Î3?@h%≠¯Ü¢%¿ìér0õ4?@Lk\”ÿû%¿•\›\Ëc>4?@æˆÃí\0ù%¿∞\∆\Ÿt4?@p?\‡Åú%¿®ã\ \¬3?@˛õ\'æö%¿[\Ô7\⁄q3?@ù/ˆ^|ô%¿\…&p\Î2?@ó∏\ ò%¿ë∏\«“á2?@N_\œ\◊,ó%¿)%´\Í1?@y∞\≈nüï%¿æ0ô*1?@Î≠Å≠î%¿o\Î0?@ä∞\·Èïí%¿iT\‡d/?@\Óß/í%¿DioÖ-?@∑µÖÁ•í%¿ƒµ\⁄\√^,?@\Ëyíî%¿f¿YJñ+?@V\r\¬\‹\Óï%¿æ˜7hØ*?@¯\√\œó%¿7l[î\Ÿ(?@≠1\ËÑ–ô%¿¡=~o\'?@∑ó4F\Îò%¿Ú\ÏÚ≠\'?@\«,{ò%¿\‡eÜç≤&?@\\ê-\À◊ï%¿Àüoñ&?@3˛}∆Öì%¿\‡eÜç≤&?@S£í:ë%¿≠\‹\Ã&?@ø÷•F\Ëè%¿±\€gïô&?@6\ËKoé%¿yt#,*&?@˜Ãí\05ç%¿\'3\ﬁVz%?@±3Ö\Œkå%¿§\‚ˇé®$?@Cå◊º™ã%¿PQı+ù#?@FC∆£Tä%¿Cq«õ¸\"?@ÉNtâ%¿I-îL\"?@î2©°\rà%¿£ì•\÷˚!?@ZürLá%¿πéq\≈\≈!?@obHN&Ü%¿ë9∂û!?@\œÛßç\ÍÑ%¿¢öí¨\√!?@æi˙ÏÄÉ%¿/l\ÕV^\"?@AG´Z“Å%¿à\◊ıv#?@Gsd\Â%¿2øFí$?@CV∑z~%¿Gsd\Âó%?@qX\Z¯Q}%¿S\È\'ú\›&?@ßí†ä{%¿\Õ\Êq\Ã\'?@*1	z%¿…è¯k(?@77¶\',y%¿óræ\ÿ{)?@\‰\⁄P1\Œw%¿ò¿≠ªy*?@;\ﬂOçóv%¿àKé;•+?@≠P§˚9u%¿6\Ã\–x\",?@î§k&\ﬂt%¿\…ˇ\‰\Ô\ﬁ-?@ˆ\–>Vs%¿j1xò.?@{k`´s%¿’íér0/?@\‚\Õ\ZºØr%¿;s	\ﬂ/?@ôıb(\'r%¿-\'°ÙÖ0?@¬äS≠Öq%¿µ¿)1?@;˛q%¿˙^Cp\\2?@•\›\Ëc>p%¿\…væü\Z3?@≠ó\„p%¿IüV\—3?@\ƒ$\\\»#p%¿\Ó\Œ\⁄m6?@\—!p$p%¿_\ÂDª6?@Ò1%íp%¿t≥?Pn7?@=c_≤Òp%¿\“9?\≈q8?@ã¶≥ì¡q%¿Sy;\¬i9?@Na•Çär%¿&p\Înû:?@oeâ\Œ2s%¿\Ë1\ 3/;?@\ÊZ¥\0ms%¿ó\“˛<?@t\–%zs%¿:ì6U˜<?@\0\Z•Kˇr%¿ä!9ô∏=?@Cˇ+r%¿Ω«ô&l??@Ú\ÏÚ≠o%¿ôK˝ºA?@ñzÑÚn%¿Iˆ5CB?@≠ó\„p%¿´@-C?@†Y2\«r%¿∑\Ì{\‘_C?@ç|^Ò\‘s%¿©0∂D?@π˚-v%¿\ﬁÑÄD?@˛\”\rx%¿£\ 0\ÓE?@\«dqˇëy%¿g\Ì∂\ÕE?@îm\‡\‘y%¿˘jGqéF?@±k{ª%y%¿fıÇOG?@à∏9ïx%¿\„8jπG?@ííÜVw%¿ü ±\›=H?@JµO\«cv%¿ï)\Ê \ËH?@\n+TTu%¿#K\ÊX\ﬁI?@ˇzÖ˜s%¿\ﬂ7æˆ\ÃJ?@2t\Ï†r%¿RΩ¬ÇK?@\Z®åüq%¿R\ÍíqL?@\›–îù~p%¿wÙø\\ãN?@û(	â¥m%¿\“\«|@†O?@3¿Ÿ≤l%¿c\—tv2P?@ü[\ËJj%¿∏Z\'.\«O?@†˙ëi%¿µo\ÓØO?@j¶{ù\‘g%¿¿u≈åN?@ò4F\Î®b%¿™û\Ã?˙N?@ú\ƒ ∞r`%¿;™ö \ÍN?@¥\„Ü\ﬂM_%¿ÜTQº\ N?@øõn\Ÿ!^%¿™∂õ\‡õN?@\”2R\Ô©\\%¿QΩ5∞UN?@\‹Û¸i£Z%¿\√fÄ≤M?@í\\˛C˙U%¿\‚[X7\ﬁM?@\\Uˆ]T%¿y:WîN?@Ú\ÏÚ≠S%¿\"\·{ÉN?@<ø(AQ%¿[\Õ:\„˚N?@´≤\Ôä\‡O%¿\0÷™]O?@üv¯k≤N%¿Tt$óˇP?@mp\"˙µM%¿;Uæg$R?@\√fÄ≤M%¿è\ﬂ\€ÙgS?@ÑıÛM%¿V\’\À\Ô4U?@3o\’u®N%¿t\Ì\ËU?@¿O%¿ò°ÒDW?@\ÕvÖ>XN%¿5õ\«a0W?@˛Û\ﬂK%¿t\“˚\∆\◊V?@_Aö±hJ%¿sePmpV?@6vâ\Í≠I%¿[ú•dU?@·∏åõ\ZH%¿\∆\·ÃØ\ÊT?@d;\ﬂOçG%¿¨´µT?@Öx$^ûF%¿ô+ÉjÉS?@û#Ω®E%¿Úñ´S?@EÉ<ÖD%¿GW\È\Ó:S?@\ÂZH¿@%¿cG\„PøS?@´>W[±?%¿dêªST?@õ7N\nÛ>%¿âyV“äW?@>Æ\r\„<%¿UK:\ ¡X?@§p=\n\◊;%¿T™D\Ÿ[Z?@âÍ≠Å≠:%¿r\Ã_![?@\Œ¡3°I:%¿ãnΩ¶]?@˙	g∑ñ9%¿\Íuã¿X_?@á6\09%¿^\⁄pX\Z`?@ÒÙJYÜ8%¿Ò∏®a?@\ﬁ\∆fG™7%¿\…6ëôc?@2\œg@5%¿ÜØØu©e?@Y\‹d:4%¿F{ºêg?@û?mTß3%¿\·\n(\‘g?@àFw;3%¿v4ıªh?@\”\⁄4∂\◊2%¿˝Ùü5?j?@i\…\„i˘1%¿ï\rk*k?@	√Ä%W1%¿_”ÉÇRl?@ip[[0%¿L5≥ñn?@z˝I|.%¿öï\ÌC\ﬁn?@\Î5=((-%¿Æ+fÑo?@ñ\Ï\ÿ\ƒ+%¿ºW≠Lp?@Zπò*%¿/O\ÁäRr?@¥≠fùÒ%%¿\Õ\ ˆ!s?@Ç\»\"Mº#%¿\⁄\ZåÉs?@bù*\ﬂ3\"%¿I\÷\·\Ë*u?@U˙	g∑%¿Dãl\Á˚u?@É}i%¿.\Â|±˜v?@@OI%¿	kc\ÏÑw?@9\Óî\÷%¿P\·Ry?@¶Cß\Á\› %¿î†ø\–#z?@ıª∞5[!%¿±¯Ma•z?@´±Ñµ!%¿á\ﬁ\‚\·={?@Òd73\"%¿Qæ†Ö|?@Gtœ∫F#%¿H6W\Õs|?@\Ê!S>$%¿ê2\‚\–|?@;\„˚\‚R%%¿AIÅ0}?@z\ƒËπÖ&%¿\‚\ \Ÿ;£}?@Æü˛≥\Ê\'%¿p(|∂~?@)\"\√*\ﬁ(%¿eèP3§~?@\ÎrJ@L*%¿˙\'∏XQ?@.\ŒR≤,%¿Ä∑@Ç\‚?@\√e6,%¿˝gÕèøÄ?@7®˝\÷N,%¿	˝LΩnÅ?@ïF\Ã\Ï+%¿.9\ÓîÇ?@VÑa¿*%¿ú¯jGqÇ?@H\‚\Â\È\\)%¿`ÆE–Ç?@u \Î©\’\'%¿˚Zó\Z°É?@G\Ã\ÏÛ%%¿ß\‘E\nÖ?@\ËKo.\"%¿\«-\ÊÁÜÜ?@v()∞ %¿6ZÙPá?@ıh™\'Û%¿\Ô\0OZà?@`\"\ﬁ:ˇ%¿æP¿v0ä?@∏Ø\Áå %¿˘ÉÅ\Áä?@∑Eô\r2!%¿&\≈\«\'å?@ä∞\·\Èï\"%¿\Ï˚pêç?@¡≈ä\ZL#%¿Sweé?@w1\ÕtØ#%¿\ﬂ˚¥Wè?@ôºfæ#%¿Fô\r2…ê?@G\Ëg\Íu#%¿ZEh\Êï?@L˝º©H%¿™õãø\Ìï?@R~R\Ì%¿V\Ï1ëñ?@™aø\'\÷%¿\Á%\Ë/ò?@\È\∆%¿m;mçö?@ˆB\€¡%¿∫i3NCú?@]¿\À%¿ıΩÜ‡∏ú?@\—?¡≈ä%¿J	¡™zù?@°Üoa\›%¿	2*°?@¯ˆÆA%¿?SØ[¢?@t±3Ö%¿+i\≈7¶?@D1y\Ã%¿©i\”Lß?@U3k) \r%¿OÂ¥ß\‰®?@\råº¨â\r%¿B#ÿ∏˛©?@à+g\Ôå%¿\Ïk]jÑ™?@Ä\‘&N\Ó%¿<ö$ñ¨?@cz\¬%¿r4GV~≠?@IK\Â\Ì%¿π¸áÙ€Ø?@g∏ü%¿L‚¨àö∞?@ü\Ê\‰E%¿\n∫Ω§1≤?@R<æΩ%¿/ÖÕ≤?@ƒì\›\Ã\Ë%¿˝ÉHÜ≥?@jkD0%¿⁄≠e2≥?@#-ï∑#%¿≠jI≥?@&S£%¿àªzµ?@÷çwG˛$¿s∫,&6ª?@\ÍuëB˘$¿Aãvº?@)\›^\“¯$¿Û =EΩ?@9{\⁄\·˜$¿\ÍAA)ZΩ?@\”˘,Aˆ$¿\"5\ÌböΩ?@Ç’∞\ﬂÛ$¿`\»\ÍVœΩ?@\»`≈©\÷Ú$¿ÆÒôÏüø?@{°Ä\Ì$¿oG8-x¡?@F\”\Ÿ\…\‡$¿\Í%\∆2˝\¬?@¥íV|CÒ$¿sÇ69\ƒ?@4Jó˛%Ò$¿öû^\≈?@£s~ä\„$¿X9¥\»\∆?@S\"â^FÒ$¿\’zø—é\«?@2t\Ï$¿˜\«{\’\ \»?@\—\ÎO\‚s\Ô$¿\≈rK´\…?@~¨\‡∑!\Ó$¿°∫π¯\€\ ?@Æ\”HK\Â\Ì$¿	»≥\À\À?@˜\‰a°\÷\Ï$¿Ö8Ñ*\Õ?@≤\r‹Å:\Ì$¿\œMõq\Z\Œ?@\'K≠˜\Ì$¿C,cC\œ?@≤Ä	‹∫\Î$¿ó«öë\—?@û	MK\Í$¿Zd;\ﬂ\”?@éW zR\Ê$¿˚&7ä\‘?@∞bÉÖ\„$¿w-!Ù\‘?@\Î»ë\Œ¿\‡$¿\“\»\ÁO\’?@ß\ÊrÉ°\ﬁ$¿µ˚\À\Ó\’?@Z*oG8\›$¿rjgò\⁄\÷?@vkô\«\€$¿\Ÿx∞\≈n\◊?@˘HJz\⁄$¿óqS\Õ\◊?@á\›wè\’$¿vQÙ¿\◊?@a˛\nô+\”$¿ïú{h\◊?@shë\Ì|\œ$¿Kw\◊Ÿê\◊?@ÛZ	\›%\…$¿\0©Mú\‹\◊?@\√g\Î\‡`\«$¿≤†0(\”\ÿ?@Ø\ÓXlì\¬$¿\Ô\„hé¨\ÿ?@≤∏ˇ\»t¿$¿“´JC\Ÿ?@\Óî\÷ˇπ$¿=,‘ö\Ê\Ÿ?@HßÆ|ñ∑$¿\€\–w\⁄?@Õ´:´∂$¿\‡º8Ò\’\⁄?@{2ˇËõ¥$¿x\’\Ê!\€?@oeâ\Œ2≥$¿aTR\'†\›?@\›A\ÏL°´$¿ëa¸\‡?@s.\≈Ueß$¿°¯1\ÊÆ\·?@ûí>•$¿óXç|\‚?@\›^\“•$¿3\ﬂ¡O\‰?@∏\"1A\rß$¿Z\÷˝c\Â?@dyW=`¶$¿†ö≤\”\Á?@´ˆòH°$¿r˙zæf\È?@®ä©Ùû$¿Òª\Èñ\Í?@\Îo	¿?ù$¿gû\\S \Î?@Å\ÍD2ú$¿õÆ\'∫.\Ï?@Ù5\Àe£õ$¿¯Ac&\Ì?@“™ñtîõ$¿\›\—ˇr-\Ó?@æ˙xËªõ$¿ç\–\œ\‘\Î\Ó?@h!£Àõ$¿xÄ\'-\\Ú?@ˇ\Ã >∞õ$¿ñ[Z\râÛ?@\‘($ô’õ$¿]QJVı?@àù)t^õ$¿uYLl>ˆ?@∑A\Ì∑vö$¿√Åê,`ˆ?@¯4\'/2ô$¿A\÷S´Øˆ?@W[±ø\Ïñ$¿!î˜q4˜?@7n1?7î$¿\—\Ëb˜?@\Ê\Ê\—=ì$¿jlØΩ˜?@#áàõSë$¿\‚ !\ ¯?@Qª_¯é$¿\‡G5\Ï˜¯?@à¬£çã$¿)=\”Kå˘?@ò˘~ä$¿\Í\–\Èy7˙?@\0Q°∫â$¿\ÍÕ®˘˙?@Ñõå*√à$¿5_%ª˚?@Q˜HÖ$¿è™&à∫˚?@ã˘π°)É$¿Æ‘≥ î˚?@≠àö\ËÛÅ$¿EùπáÑ˚?@°L£\…≈Ä$¿!ÆúΩ˚?@(∑\Ì{\‘$¿väUÉ¸?@¯\√\œ~$¿y\Âz\€L˝?@ùfÅvá|$¿oıúÙæ˝?@•N@a{$¿ùÛS˛?@\»xîJxz$¿\’%\„\…˛?@ØD†˙y$¿˜:©/Kˇ?@ô∑\Í:T{$¿ÇUıÚˇ?@\Õ?˙&M{$¿QàÄC®\0@@õsLx$¿5¥;§\0@@å+.é\ u$¿\„¡ª}\0@@Åí`r$¿Äª\Ï◊ù\0@@8-x\—Wp$¿\Œ˙îc≤\0@@\—vL\›m$¿üıf\‘\0@@•˜çØ=k$¿\0{ˆ\0@@M÷®áh$¿8>[@@oÑEEúf$¿#\Ÿ#\‘@@@ø\Ô\ﬂd$¿C´ì3@@©æÛãb$¿Øx\Íë@@¡\‡ö;˙_$¿ÉæÙˆ\Á\0@@ñØ\Àü^$¿åi¶{ù\0@@;±O\0]$¿µ•Úz\0@@∞é\„áJ[$¿µ\ﬂ⁄â\0@@ä\‰+ÅîX$¿\‡G5\Ï˜\0@@ÿ∫\‘˝T$¿\‘\rx\'@@˘\⁄3KT$¿ºìOèm@@≤\⁄¸ø\ÍP$¿@˜\Â\Ãv@@¢µ¢\ÕqN$¿\‘\Ô\¬\÷l@@z™CnÜK$¿n\›\ÕS@@å\÷Q\’I$¿MÇ7§Q@@ê†¯1\ÊF$¿4-±2\Z@@Ä\◊g\Œ˙D$¿\ÿF<\Ÿ\Õ\0@@¨q6D$¿=)ì\Z\0@@wı*B$¿±0DN_ˇ?@e√ö ¢@$¿vß;O<ˇ?@â\ÏÉ,>$¿Ve\ﬂ¡ˇ?@ûy9\Ïæ;$¿\Z1≥\œc\0@@b.\‰9$¿Gv•e§\0@@ì\‡\riT8$¿\"¶DΩ\0@@¨ã\€h\07$¿†ﬁåöØ\0@@µ®Orá5$¿\’=≤πj\0@@ßöœπ3$¿úäT[\0@@>v()0$¿IÄöZ∂\0@@&4I,)/$¿\÷\·\Ë*\›@@\'JB\"m+$¿Gw;S@@ñ=	l\Œ)$¿\…qßt∞@@çúÖ=\Ì($¿\”MbX@@y≠Ñ\Óí($¿U£W@@\ﬁ\∆fG™\'$¿I0\’\ÃZ@@úQ}&$¿.rOWw@@+j0%$¿ y\ÁPÜ@@X7\ﬁ#$¿õ ¢∞ã@@@ø\Ôﬂº $¿ßx\\Tã@@&7ä¨$¿Yß\ ˜å@@h[\Õ:$¿∫ˆÙ\¬@@S\"â^$¿t_\ŒlW@@†¶ñ≠ı$¿MΩn@@êÉf\⁄$¿Ñ”Ç}@@{/æhè$¿ä¨5î\⁄@@ï\0U\‹$¿ØΩ7Ü@@O\À\\\Â$¿9BÚ\Ï@@m8,\r¸$¿¸˝b∂d	@@’±J\Èô$¿¬â\Ë\◊\÷	@@\›ŒæÚ $¿e\ZM.\n@@\r4üs∑$¿M÷®á\n@@\…!\‚\ÊT$¿≥|]Üˇ\n@@ä\Ã\\\‡Ú$¿x\„ßq@@3¸ß($¿\\9{g¥@@´\œ\’V\Ï$¿ˆòHi@@àW\Œ$¿.\…ªö@@°g≥\Ís\r$¿mscz\¬@@ÇUıÚ$¿ã4Ò@@Ku/$¿F\Ï@\r@@4Ö\Œk\Ï\n$¿§´twù\r@@VE∏…®\n$¿Tq\„Û\r@@}\\*\∆	$¿\0VGét@@a\√\”+e	$¿íìâ[@@Q0c\n\÷$¿r›îÚZ@@\…rJ_$¿\”/où@@P6\Â\n$¿ˆb(\'\⁄@@ö\'\◊\»$¿∂Ω›í@@˛õ\'æ$¿-¥sö@@\≈\…˝E$¿K´!qè@@Âπæ$¿\Â|±˜\‚@@∫1=aâˇ#¿Øô|≥\Õ@@~˛{\⁄˝#¿c{-\ËΩ@@L8†•˚#¿\√c\“\ﬂ@@ˇy\Z0H˙#¿û≤öÆ\'@@Ø≥!ˇ\Ã¯#¿πåõ\Zh@@¥Ñ\÷\√˜#¿óã¯N\Ã@@p\ÓØ˜ı#¿)x\nπR@@õ\„\‹&\‹Û#¿`\‰eM,@@0\’\ÃZ\n#¿ºêa@@H\Z\‹\÷\Ó#¿⁄íUn@@π4~\·ï\Ï#¿\–\“l#@@sÒ∑=A\Í#¿\…ˇ\‰\Ô\ﬁ@@\‰àûî\È#¿ÖòK™∂@@\ÃC¶|\Ë#¿∫/g∂@@ûòıb(\Á#¿[≥\–\Œ@@öœπ\€\Â#¿\Á\«_Z\‘@@lMK¨\‰#¿\»–±@@t\\ç\ÏJ\„#¿AÇ\‚«ò@@\◊\⁄˚T\‚#¿npñí@@ò\‡\‘í\ﬂ#¿p]1#º@@\“\Ó#∑\ﬁ#¿˘\⁄3K@@âC6ê.\ﬁ#¿\’=≤πj@@&äê∫ù\›#¿Ω\√\Ì–∞@@]˙ó§2\›#¿7n1?@@Ωs(CU\‹#¿πéq\≈\≈@@œΩáKé\€#¿E|V@@ó®\ﬁ\Z\ÿ\⁄#¿\…&p\Î@@	SîK\„\◊#¿Àû6\Á@@4ºYÉ˜\’#¿A~6r\›@@S\Ííqå\‘#¿Ògx≥@@\Ì\ræ0ô\“#¿ß$\Îpt@@Ø?âœù\–#¿ê¡äS≠@@x\–\œ#¿%´\Í\Â@@ãﬁ©Ä{\Œ#¿˝LΩn@@*ènÑE\Õ#¿pxADj@@\⁄\«\n~\À#¿ákµáΩ@@©æÛã\ #¿≥ôCR@@Ö@.q\‰\…#¿c+hZb@@πS:Xˇ\«#¿±6\∆Nx@@\»\ÌóOV\ƒ#¿Å\–z¯2@@\Í¥nÉ⁄ø#¿+mqç\œ@@¨\ƒ<+iΩ#¿\ËO\’\È@@_%ªº#¿\–\’V\Ï/@@oº;2Vª#¿4ú27@@é*çòπ#¿	2*@@z4’ì˘∑#¿øG˝ı\n@@ª∏ç∂#¿ù{h@@AÚŒ°µ#¿â@£t@@©OráM¥#¿\‘>\Õ\…@@Ñú˜ˇq≤#¿EKO\À@@˛&\"\‡∞#¿\ﬂnI\ÿ@@62;ãÆ#¿\r\≈oÚ@@®©ek≠#¿†\ﬂ˜o^@@E,b\ÿa¨#¿\ÊÁÜ¶\Ï@@3˛}∆Ö´#¿µ∆†B@@ë|%ê´#¿Ù£·îπ@@\'\⁄UH˘©#¿ÛtÆ(%\Z@@óé9ß#¿Çëó5±\Z@@MåJ\Í§#¿P\‰I\“5@@Dá¿ë@£#¿å\⁄˝*¿@@i˛ò÷¶°#¿#ÑGG@@v¸¢#¿E∑^”É@@\ÿc\"•°#¿\'.\«+@@NCT\·œ†#¿kÚî\’t@@ªbFx{†#¿U\¬z˝@@\«.QΩ5†#¿\Z\¬1Àû@@ùFZ*oü#¿íÎ¶î\◊@@ÒπÏøû#¿\◊¿V	@@∫\Ÿ(∑ù#¿Yá£´t@@\◊l\Â%ˇõ#¿\–}9≥@@X}wõ#¿\È\◊\÷Oˇ@@\nª(z\‡õ#¿g,ö\ŒN @@\—?¡≈äö#¿*:í\À @@ûú˙ò#¿ä\Õ«µ° @@S≤úÑ“ó#¿-	PS\À @@k*ã¬ñ#¿ C\«*!@@\nj¯÷ï#¿\Á\ﬂ.˚u!@@\⁄8b->ï#¿§à´\"@@ÉßZì#¿dZõ\∆ˆ\"@@$\ÌFÛë#¿xôa£¨#@@\≈\‰\rê#¿˘*$@@Aúáê#¿\Zàe3á$@@éíW\Áê#¿öñX%@@\÷\≈m4Äè#¿Kw\◊Ÿê%@@\ \Zıçé#¿\'â%\Â\Ó%@@≤Û66ã#¿á3øö&@@˜s\nÚ≥â#¿nnLOX&@@\’\ÎÅ±Ü#¿\‰M~ãN&@@(õrÖ#¿:\œÿól&@@\œ˜S„•É#¿∆ß\0\œ&@@§ß\»!Ç#¿=∫\'@@ \‘E\neÅ#¿\÷t=\—u\'@@ú\ƒ ∞rÄ#¿à\Ï¯/(@@\Ïl\»?3Ä#¿\»`≈©\÷(@@é\Á3†~#¿Ü1zn)@@j†˘úª}#¿∂üåÒ)@@,\ÿF<\Ÿ}#¿º≥v€Ö*@@\Ï†\◊1~#¿.ç_x%+@@hXå∫\÷~#¿Æ†iâï+@@©ÿò\◊#¿w£è˘Ä,@@,ûz§¡}#¿ù\œd,@@x\—Wêf|#¿ë\'I\◊L,@@ﬂ¶?˚ëz#¿&7ä¨5,@@¶\‘%\„y#¿9ú˘\’,@@∂†˜\∆x#¿.\À\◊e¯+@@∞VÌöêv#¿2∆á\Ÿ+@@•\€π\‡t#¿*6\Êu\ƒ+@@¿\Áá\¬s#¿\”i\›µ+@@\ÂùC™r#¿Æπ£+@@}Àú.ãq#¿\Âöôù+@@1ñÈóào#¿SÕ¨•,@@æ•ú/ˆ^#¿Síu8∫,@@\œg@Ω]#¿8†•+\ÿ,@@Äcœû[#¿*\÷T-@@=1XY#¿\∆˝G¶C-@@¡éˇAX#¿O\À\\-@@ôJ?\·\ÏV#¿†‹∂\ÔQ-@@_9\ÔˇS#¿∫\€ı\“-@@bhurÜR#¿\È&1¨,@@¥Xä\‰+Q#¿\⁄;£≠J,@@Ö\œ\÷¡¡N#¿˚7/N,@@\›\”\’ãM#¿Iÿ∑ìà,@@Làπ§jK#¿Æc\\qq,@@/æhèJ#¿\ÿ+,∏,@@†®lXSI#¿àÖZ”º+@@\‘+e\‚H#¿˝1≠Mc+@@ü ±\›=H#¿4\÷˛\Œˆ*@@\nΩ˛$>G#¿e\‡ÄñÆ*@@qé::ÆF#¿∑\”÷à`*@@<ÉÜ˛	F#¿\¬N±j*@@∂LÜ\„˘D#¿IüV\—)@@ö≤\”\ÍB#¿˛G¶Cß)@@\ÿI}Y\⁄A#¿\ZÑd)@@k\ÔSUh@#¿r5≤+-)@@YjΩ\ﬂh?#¿¶ÚvÑ\”(@@èR	O\Ë=#¿%<°◊ü(@@∏Œø]ˆ;#¿Ú(ïÑ(@@W¥9\Œm:#¿h+¯m(@@øÄ^∏s9#¿ƒØX\√E(@@\„p\ÊWs8#¿s\◊Ú\'@@æ-X™8#¿S≥ZÅ%@@\Ó<00#¿¨Zd%@@M\‡Ù..#¿Ùp\”i%@@\ÿc\"•\Ÿ,#¿3mˇ\ J%@@û\–\ÎO*#¿]¿\À%@@F\Ï@)#¿ßZ≥\–$@@ó∏\ (#¿kcÏÑó$@@\À\◊e¯O\'#¿\"R\”.$@@d:tz\ﬁ%#¿\œ\œ\Ÿ$@@ºx?nø$#¿2;ã\ﬁ#@@ÖòK™∂##¿pòhêÇ#@@ã\¬.ä #¿n¬Ω2o#@@˜ôù#¿7ﬂà\ÓY#@@\nÉ2#¿¸S™D#@@yˆ—©#¿˝l\‰∫)#@@æÖu\„\›#¿F{ºê#@@=÷år#¿\Âú\ÿC˚\"@@P\ƒ\"Ü#¿@¢C\‡\"@@Hqh#¿ \nfL¡\"@@[≥\–\Œ#¿qqTn¢\"@@$}ZE#¿¯ßTâ\"@@8ákµá\r#¿¡ò2p\"@@û\\S ≥#¿&é<Y\"@@ÿúÉg\n#¿?5^∫I\"@@(\'\⁄UH	#¿Pß<∫\"@@IÑF∞q#¿\⁄r.\≈!@@\‚\Í\0àª#¿+\¬MFï!@@öwú¢##¿è®å!@@É˘+dÆ¸\"¿Mˆ\œ”Ä!@@Q•f¥˙\"¿HP¸s!@@Øñ;3¡¯\"¿Zˆ$∞9!@@\’\ÎÅ±ˆ\"¿\"T©\Ÿ!@@ü°ºèÛ\"¿ù\ÿC˚X!@@¸˚åÚ\"¿üàÇ!@@\–Ï∫∑\"Ò\"¿3•ı∑\"@@˝2W\Ì\"¿?SØ[\"@@z6´>W\Î\"¿˛F;n¯!@@od˘É\È\"¿\Êv/˜\…!@@õ.»ñ\Â\"¿Å	‹∫õ!@@ZJñìP\‚\"¿~T\√~!@@8æˆÃí\‡\"¿tb\Ìc!@@&\≈\«\'d\ﬂ\"¿\Î™@-!@@\¬¡\ﬁƒê\‹\"¿†Y2\« @@\Œ\0d\À\⁄\"¿ÒGT® @@µSsπ¡\ÿ\"¿∑µÖ\Á• @@wÙø\\ã\÷\"¿Jó˛%© @@\ﬂƒêúL\‘\"¿\Ô9∞ @@ﬁí∞´\—\"¿\"¶DΩ @@Æö\Áà|\œ\"¿ˆ_\Á¶\Õ @@òüê\Õ\"¿\·\riT\‡ @@ñ?\ﬂ\Ã\"¿l≥±Û @@`ù∫\ \"¿\nIfı!@@0ôÚ!\»\"¿9ô∏U!@@Ø_∞∂\≈\"¿]5\œ˘ @@\‹)¨ˇ\√\"¿\‘+e\‚ @@((E+˜\¬\"¿§ˇ\ÂZ¥ @@Òd73\¬\"¿Ó∞â\Ã\\ @@o\rlï`¡\"¿ˆ(\\è\¬@@πS:Xˇø\"¿yY|@@\Ã\—\„˜æ\"¿?πnJ@@1[≤*¬Ω\"¿\"S>U@@Ñê/°∫\"¿K?™a@@ÆÄ∏´∑\"¿ñ$\œı}@@ì7¿ÃØ\"¿\Ë¢!\„Q@@3˚<FyÆ\"¿\€\›t@@\·\ÌA»ß\"¿©/K;5@@\ƒ]Ωäå¶\"¿\‡V*®@@î0\”ˆØ§\"¿mW\ËÉe@@˛úÇ¸l§\"¿X\0S@@ µâì£\"¿êkC\≈8@@dY0ÒG°\"¿•¯¯Ñ\Ï\Z@@\"\‚\ÊT2†\"¿sµ4∑\Z@@\\\„3\Ÿ?ü\"¿9\’ZòÖ\Z@@ö¥©∫Gû\"¿º?\Z@@Ò,AF@ù\"¿\‹\r¢µ¢@@EÇ©f÷ö\"¿gÄ≤e@@*™~•Ûô\"¿\Î\«&˘@@\‹{∏\‰ò\"¿¡)\Õ@@±áˆ±Çó\"¿ªE`¨o@@:WîÇï\"¿v\ﬂ1<@@4û\‚<î\"¿\Íy7@@\0ºviì\"¿ï-ív£@@êÑ};ë\"¿Lk\”\ÿ^@@˝\r⁄´è\"¿\‡ª\Õ@@û¥pYÖç\"¿cÏÑó\‡@@∂J∞8å\"¿Mg\'É£@@´]\“\Zã\"¿ïH¢óQ@@´ñtîÉâ\"¿|Û&\Z@@\⁄\0l@Ñà\"¿8ákµá@@$\rnká\"¿Ö|–≥Y@@ˇ$>wÇÖ\"¿•Ω¡&@@\Î9\È}\„É\"¿d\Èb\”@@4wº\…\"¿¸\‚Rï∂@@u\»\Õp~\"¿çÄ\nGê@@∂ı\”\÷|\"¿œΩáK@@≥Õç\È	{\"¿ìUn2@@˚≤¥Ssy\"¿g\Ì∂\Õ@@VGétv\"¿\Zã¶≥ì@@ΩVBwIt\"¿àÄC®R@@\Ë3†ﬁår\"¿¥Xä\‰+@@ú˙@Ún\"¿µ∆†B@@m\06 Bl\"¿ì©ÇQI@@\\<º\Á¿j\"¿¸èLáN@@µkBZch\"¿\ÍØWXp@@\ÿ*¡\‚pf\"¿üêù@@Ll>Æ\re\"¿æÖu\„@@` ê°c\"¿˘1\ÊÆ%@@ŸØ;\›yb\"¿75\–|@@ \Ï´a\"¿ë`™ôµ@@uîÉ\Ÿ`\"¿\√§R\Ï@@•h\Â^\"¿\Ê>9\n@@(Ù˙ì¯\\\"¿ÑIÒÒ	@@àFw;[\"¿ ç\"k\r@@üêù∑±Y\"¿ª}Vô)@@\Î\√z£VX\"¿\"S>U@@hzâ±LW\"¿Å\œ#Ñ@@N\“¸1≠U\"¿µP29µ@@&\Z§\‡)T\"¿˘\⁄3K@@:<ÑÒ\”P\"¿$a\ﬂN\"@@\n\⁄\‰IO\"¿\ËÖ;F@@!\Í>\0©M\"¿@4Û\‰ö@@rjgò\⁄J\"¿i\‰Ûäß@@˝˙!6XH\"¿Ÿò\◊á@@\‡ˆâ\ÌF\"¿\⁄Rê@@(N>E\"¿f\⁄˛ïï@@5\rä\ÊD\"¿ÇˇÇ@@w0bü\0B\"¿5c\—tv@@©\–D\ÿ@\"¿Ú≥ë\Î¶@@*\ƒ#ÒÚ<\"¿\Î\Âwö\Ã@@\0\Â\Ô\ﬁQ;\"¿\ŸÉk\Ó@@ûï¥\‚:\"¿u £@@kFπã8\"¿9\rQÖ?@@á\ﬁ\‚\·=7\"¿(-\\Va@@k{°Ä5\"¿\Ÿ[\ ˘b@@∑ô\nÒH4\"¿∞\Âï\Îm@@\ŒR≤úÑ2\"¿\€kA\Ôç@@L\√1\"¿’Æ	iç@@\◊/\ÿ\r\€.\"¿IæHâ@@ˇA$Cé-\"¿\'¯än@@ëao,\"¿2\√FY@@ å∑ï^+\"¿L8Ù@@—ÆB\ O*\"¿ó\0¸S™@@\Èc> \–)\"¿(Ç8\'@@†4\‘($)\"¿(\r5\nI@@8ªµLÜ\"¿\›[ëò†@@eÆπ\"¿º}\È\Ì@@ü=ó©I \"¿4ª\Ó≠@@\–^}<Ù-\"¿]ájJ≤ @@y\"àÛpB\"¿ßñ≠ıE.@@*\„\ﬂg\\@\"¿\ŒQ\⁄8@@©gA(\Ô;\"¿\— O!9@@\“˚\∆◊ûA\"¿åÙ¢vø:@@r\≈\≈QπA\"¿\∆k^\’Y?@@\Ó#∑&M\"¿Oê\ÿ\Ó>@@Xo\‘\n\”W\"¿\ŒQ\⁄E@@8Öï\n*Ç\"¿\Í\ÏdpîH@@åˆx!~\"¿\\\ÊtYLJ@@d\…Àªz\"¿tb\ÌcM@@ò¢\\\ZøÄ\"¿•f¥O@@U2\0TqÉ\"¿øb\rS@@bÖ[>íä\"¿Ò†\ŸuoU@@<i\·≤\nã\"¿j/¢\ÌòX@@Ñùb\’ å\"¿`YiR\n\\@@ñ?\ﬂå\"¿ß≤(\Ï¢`@@\ \‹|#∫è\"¿;˛b@@ã8ùd´£\"¿s,\Ô™d@@˝à_±Ü£\"¿cbÛqmf@@B\nûBÆ§\"¿˝2Wg@@Ó∞â\Ã\\®\"¿U\Zàeg@@[≥\–Œ©\"¿ß\È≥Æg@@6\Êu\ƒ!´\"¿\Ô\»Xm˛g@@Hlw–≠\"¿	5C™(h@@+j0\r√Ø\"¿∏u7Ouh@@E\Ÿ[\ ˘≤\"¿\Ê¨O9&o@@˙&MÉ¢¡\"¿QΩ5∞Ur@@µ˘’ëª\"¿F^\÷\ƒs@@ˇ$>wÇ\≈\"¿úQÛUÚs@@\÷rg&\∆\"¿\ÏÜmã2u@@b\◊ˆvK\¬\"¿\’u®¶$w@@\€P1\Œ\ﬂ\Ã\"¿\'i˛z@@\‹.4\◊i\Ã\"¿:\Í\Ë∏\Zy@@˚ ÀÇâ\◊\"¿˚\Ë‘ïy@@óuˇXà\ﬁ\"¿œ°U1y@@Õî\÷\ﬂ\Ë\"¿sùFZ*y@@∑F\„\‡\Í\"¿≤KTo\rz@@\ÍX•ÙL\Ô\"¿ÙÜ˚»≠y@@Éä™_\ÈÙ\"¿àûîIy@@>z\√}\‰ˆ\"¿_∑åıy@@ZF\Í=ï˚\"¿\€e6\»z@@Çu?T˙\"¿ÅŒ§M\’{@@(+Ü´¯\"¿äZö[!|@@ó´õ\‰˜\"¿—í\«\”Ú}@@;≈™A¯\"¿\n∫Ω§1~@@‹†ˆ[;˘\"¿Á®£\„j~@@ßy\«):˙\"¿u\Ãy∆æ~@@mr¯§˚\"¿>?å@@´òJ?\·¸\"¿1\'hì\√@@©˘*˘\ÿ˝\"¿+ï\‘	Ä@@â&P\ƒ\"˛\"¿ç\ÔãKUÄ@@\ÃbbÛq˝\"¿î˚äÅ@@∑*â\ÏÉ¸\"¿\Ÿ&çµÅ@@§\‰\’9¸\"¿+Ñ\’X¬Ç@@E°e\›?˛\"¿£±ˆw∂É@@\÷TÖ]#¿øûØY.É@@®ßè¿#¿C\Á5vâÇ@@…≠I∑%#¿‚¨àö\ËÅ@@¢U1ï#¿Ú\Îá\ÿ`Å@@é\Â]ıÄ#¿≤,ò¯£Ä@@\‰Gà#¿\‹,^Ä@@ö|≥Õç!#¿\‹FxÄ@@IÇp$#¿+1\œJÄ@@b,\”/\'#¿©à\”I∂Ä@@c0\Ìõ+#¿ñy´ÆCÅ@@\nª(z\‡3#¿2≠Mc{Å@@·∏åõ\Z8#¿\n\ÿF\ÏÅ@@K?\·\Ï\÷:#¿75\–|Ç@@§\√C?=#¿C\Á5vâÇ@@—≤\ÓA#¿&Rö\Õ\„Ç@@g∑ñ\…pD#¿˘J %vÉ@@µ¡â\Ë\◊F#¿á\ƒ=ñ>Ñ@@J\“5ìoF#¿Tˇ í!Ö@@|öìô@#¿bi\‡G5Ü@@\Ë\‰g#?#¿\0ºviá@@âaá1\È?#¿é\È	K<à@@{OÂ¥ßD#¿fl\Ëfà@@Gr˘\ÈG#¿ á†jÙà@@+√∏DK#¿\Áq\Ã_â@@EbÇ\ZæM#¿G\r6uä@@|+\‘X#¿sπ¡Páã@@l>Æ\r[#¿jπ3å@@íÒ+\÷X#¿#ˆ	†å@@Z5\—\ÁS#¿P©eoç@@†ˇºvQ#¿1–µ/†ç@@z\‡c∞\‚L#¿\r4üs∑ç@@\‰g#\◊E#¿P≈ç[é@@lMK¨D#¿\‚rº—ç@@.ç_x%A#¿CFó7ç@@-≤ù\Ôß>#¿óé9ç@@Ú%Tpx9#¿vS\ k%é@@ µâì3#¿#˜tu«é@@\‡,%\ÀI0#¿µ‹ô	Üè@@gö∞˝d4#¿«πM∏Wê@@P\·R)6#¿	§ƒÆ\Ìë@@Rb\◊ˆ6#¿rp\ÈòÛí@@iß\ÊrÉ9#¿˛µºrΩì@@ôÑy7#¿l^\’Y-î@@\Ï\›\ÔU3#¿∞\‰*ï@@\"R\”.¶1#¿õ\ËÛQFñ@@ìß¨¶\Î1#¿óé9ó@@\œf\’\Áj3#¿Ë£å∏\0ò@@\\\„3\Ÿ?7#¿≤I~ƒØò@@\“\0\ﬁ	:#¿\nü≠Éô@@{JŒâ=<#¿:[@h=ö@@Q}>\ @#¿\Â^`V(ö@@\»~KëD#¿F@Ö#Hõ@@™è\ƒ\ÀK#¿ˆ#EdXõ@@B≤ÄQ#¿®\ZΩ\Z†ö@@Z†¶ñU#¿ç\”U¯ô@@∞\ÀünX#¿\ÀJìR–ô@@®ç\Ít [#¿2ZGUö@@\‰0òøB^#¿˚WVöîö@@6\»$#ga#¿óqSõ@@≤∫\’s\“c#¿+â\ÏÉ,õ@@∞çx≤õi#¿-ôcyWõ@@O$òjfm#¿\ÿJ\Ë.âõ@@©jÇ®˚p#¿/m8,\rú@@-%\ÀI(u#¿ü\ÁO’õ@@\Ô7\⁄q\√w#¿æK©K∆õ@@a©.\‡e~#¿w\◊Ÿêú@@\‘_Ø∞\‡~#¿äæ¢[ù@@ß!™gÄ#¿˙`û@@\’]\ŸÉÉ#¿\"T©\Ÿü@@k~¸•EÖ#¿G\Â&†@@ü;¡Ü#¿h[\Õ:°@@jh∞â#¿\Â_\À+◊°@@Håû[\Ëä#¿tLhí¢@@Cp\\\∆Mç#¿_)\À«¢@@\›?¢Cê#¿á\¬g\Î\‡¢@@Äbd\…ì#¿\·ó˙yS£@@í\È\–\Èyó#¿îø{Gç£@@án˘Hö#¿ âv§@@@Ñ∏rˆû#¿‹Ç•∫Ä•@@ÄÛ\‚\ƒW£#¿\Èõ4\rä¶@@ä \Œ\√	§#¿$cµ˘ß@@t\Í\ gy¶#¿ePmp\"®@@v˛\Ì≤_ß#¿xõ7N\n©@@Ö\\©gA®#¿b.\‰™@@á˝ûXß™#¿\‹d:t™@@OÅ?¸¨#¿Û\¬N±™@@?˝gÕèØ#¿êÉf⁄™@@ëdV\Ôp≥#¿\‰¢ZD´@@˚ë9∂#¿]˘,œÉ´@@•Çä™_π#¿Ø{+¨@@P\·R)æ#¿\’>è¨@@´Ãî\÷\ﬂ\¬#¿@QŸ∞¶¨@@\‚ëxy:\«#¿é\ M\‘“¨@@,=)ì\ #¿\÷;\‹\r≠@@\»“á.®\œ#¿Óµ†˜∆¨@@\»yˇ\'\‘#¿;\·%8ı´@@ò\ﬂi2\„\’#¿|ds\’<´@@^˜V$&\ÿ#¿æ4ª™@@µ\ƒ\ h\‰\€#¿_\“≠£™@@IhÀπ\ﬂ#¿Qü\‰õ™@@\¬¿s\Ô\·\‚#¿|öìô™@@B\—<ÄE\Ê#¿Æù(	â™@@éÕéT\ﬂ\È#¿@1≤d™@@<Mfº≠\Ï#¿]2éë\Ï©@@ÛWyÒ#¿oº;2V©@@\◊h9\–Cı#¿\Ì*§¸®@@E∫üS¯#¿\–(]˙ó®@@∫\›\À}r¸#¿ó<ûñ®@@ˆ$∞9ˇ#¿±nº;2®@@\ﬁ;jLà$¿ò¡ë(®@@_&äê$¿~8HàÚß@@≠\√\—U∫$¿\ﬁ\Â\"æß@@“âS\Õ$¿I,)wüß@@ \ÔU+$¿π\ZŸïñß@@Ä}t\Í\ $¿ |(—íß@@º∞5[y	$¿)Zπòß@@[$\ÌF$¿k,amåß@@-z®\r$¿Ú%Tpxß@@π\‡˛$¿\‹+ÛV]ß@@\…U,~S$¿\— O!ß@@u\‰Hg`$¿\Œ{/æ¶@@áP•$¿£\Zˆ{¶@@}> à$¿‚±ü\≈R¶@@\·bE\r¶$¿\„¸M(D¶@@»∑w\r˙\Z$¿•ª\Îl»•@@ªG6W\Õ$¿\‘)ènÑ•@@\›%qVD$¿ë(¥¨•@@\Z\‡ÇlY$¿€ÜQ<¶@@õ\Â≤\—9$¿0+\È~¶@@Ö]= $¿\Ï\ﬂıô≥¶@@ïÙ0¥:!$¿ô-Y\·¶@@˘º\‚©G\"$¿Sh\È¶@@ëÅ<ª|#$¿AaP¶—¶@@EΩ\‡”ú$$¿Vbûï¥¶@@,Åîÿµ%$¿û$]3˘¶@@⁄®N≤&$¿à.®oôß@@\À\ÿ\–\Õ&$¿†l\ ﬁß@@\"ƒï≥\'$¿ïeàc]®@@òÖvN≥($¿[Œ•∏™®@@Õ≠Vc)$¿à\◊ıv©@@◊ø\Î3g-$¿ùIõ™©@@ã•Hæ0$¿\ﬂ\›\ ù©@@Å\ÃŒ¢w2$¿Ø\ÎÏÜ©@@ã\·\Í\0à3$¿\Á\¬H/j©@@]Üˇt5$¿f\ÿÒ©@@=\Ó[≠7$¿{g¥UI™@@\√fÄ≤5$¿\Œ\„0òø™@@ùÇ¸l\‰2$¿?8ü:V´@@¸\«Bt4$¿\Ÿ_vO¨@@0\‹{∏4$¿{æfπl¨@@S^+°ª4$¿ˆ|\ÕrŸ¨@@wJ\Îˇ4$¿Ö\Õ\0d≠@@É0∫4$¿à∏9ïÆ@@y]ø`74$¿®˝\÷NîÆ@@\Z\¬1Àû4$¿d=µ˙\ÍÆ@@Vô)≠ø5$¿x|{◊†Ø@@öò.\ƒ\Í7$¿&p\În∞@@\ÌÙÉ∫H9$¿\n\÷8õé∞@@ ñ\Õí:$¿%vmo∑∞@@.ùÛS<$¿sL˜±@@\—Yfä=$¿gc%\ÊY±@@∂0\Ìú>$¿f¿YJñ±@@¡T3k)@$¿\¬lÀ±@@ó˛%©LA$¿aE|≤@@và\ÿ\“C$¿^có®ﬁ≤@@Gç	1óD$¿g\Ì∂Õ≥@@üUfJ\ÎG$¿Zú1\Ã	¥@@}≥Õç\ÈI$¿ìUn2¥@@ô\‘\–`K$¿.¨Ôé¥@@\'áO:ëP$¿Œ®˘*˘¥@@¢∑xx\œQ$¿Ñ+†POµ@@£WîÜR$¿Ωˇè&∂@@c\”J!êS$¿Å\ÃŒ¢w∂@@>\\r\‹)U$¿?W[±ø∂@@‹ª}\ÈU$¿˛\r⁄´è∑@@\ÍíqådW$¿M¢^i∏@@Ö\Ì\'c|X$¿&m™Óëπ@@ív£è˘X$¿∫q∫@@\0k’ÆY$¿è\‡F\ ª@@\‡Û\√\·Y$¿e4Úy≈ª@@]\ƒwb\÷[$¿û	MKº@@Ûgö∞]$¿0\r\√Gƒº@@\”Ù\Ÿ\◊]$¿U˘ûëΩ@@%îær^$¿˚Y,Ω@@\È8h`$¿´ˆòHΩ@@Ç\»\"Mºc$¿±\ﬂ\ÎTΩ@@\‡LLbe$¿!Y¿nΩ@@\»\ÍV\œIg$¿∑~˙œöΩ@@(\'\⁄UHi$¿˙|îæ@@4.\…j$¿zm6Vbæ@@\Õ.è5k$¿∫Jw\◊Ÿæ@@GÀÅjk$¿e\∆\€JØø@@\“¸1≠Mk$¿\‘U¯3¿@@Q0c\nn$¿§µ˚U¿@@˙%\‚≠Ûo$¿éÀ∏©Å¿@@\≈≠r$¿<ö$ñ¿@@n\›\ÕSu$¿üFè¿@@¶B</w$¿°◊ü\ƒ\Á¿@@µß!™x$¿áÜ≈®k¡@@2t\Ï†w$¿\«):í\À¡@@ø∑\È\œv$¿¨µ<\¬@@æ**w$¿Ò\∆O\„\¬@@=Byw$¿\'›ñ\»\√@@%\Ë/Ùày$¿MΩn\√@@vâÍ≠Å}$¿\ SV\”ı\¬@@D\‡H†¡~$¿\ÿıv\√\¬@@oÙ1Ä$¿˝\›;jL\¬@@L5≥ñÇ$¿M¿Øë$\¬@@éègÉ$¿öµêˆ¡@@é Ö$¿≥\Ó\—¡@@\Ó\Ã√πÜ$¿∫/g∂¡@@QÇ˛Bèà$¿\„ßqo~¡@@J~ƒØXã$¿ê\ŸYÙN¡@@-z®ç$¿#\Ÿ#\‘¡@@:vPâ\Îê$¿\¬¿s\Ô\·¿@@E∏…®2î$¿∞\‰*¡@@ôÙMöñ$¿?$D˘¿@@ë\Œ\‡\Ôó$¿\·%8ıÅ¿@@w+Ktñô$¿Ac&Q/¿@@~p>u¨ö$¿\Ï2¸ß¿@@ı\’UÅZú$¿éH¿@@ﬂ®¶\Ôù$¿)Æ*˚Æ¿@@í∞o\'°$¿\Z¡\∆ı\Ô¿@@\◊3¬£$¿å.o¡@@¥9\Œm¬•$¿∂\ÿ\Ì≥¿@@\“\ZÉN≠$¿Oìo+¡@@õpØ\Ã[≠$¿•ˆ\"⁄é¡@@›îÚZ	≠$¿≥~31]\¬@@∏\Z£Æ$¿\ﬁrıcì\¬@@\Zﬁ¨¡˚≤$¿±3Ö\Œk\¬@@£\ÍW:∂$¿\Í>\0©M\¬@@\Ïæcx\Ï∑$¿\»\\T\¬@@4Jó˛%π$¿\Ó\\\È¡@@\√\ÿBêÉ∫$¿∂êˆ?\¬@@~\≈\Z.rø$¿3˚<Fy\¬@@Ç™—´¡$¿t]â@\√@@∞q˝ª>\√$¿èq\≈\≈Q\√@@#\∆Ç\ƒ$¿\◊KS8\√@@W´±Ñ\≈$¿5\'/2\√@@\»^\Ô˛x\«$¿\√b‘µˆ\¬@@G≤Åt\…$¿K\Á√≥\√@@.c}\À$¿\Ó\—\Ó#\√@@,ú§˘\À$¿‹∑Z\'.\√@@]~p>\Õ$¿±•GS=\√@@.ÆÒô\Ï\œ$¿\›\Í9\È}\√@@5\“Ry;\“$¿`´ã\√\√@@v6\‰ü\‘$¿,F]k\Ô\√@@L\Z£uT\’$¿Ç«∑w\r\ƒ@@A-\”\÷$¿F≤G®\ƒ@@\Ô\0OZ\ÿ$¿£\ÍW:\ƒ@@=_≥\\6\⁄$¿ Fè6\ƒ@@\”J!êK\‹$¿Iˆ5C\ƒ@@Ú@dë&\ﬁ$¿Vù\’{\ƒ@@=∑–ï\‡$¿˝O˛\Ó\≈@@gπlt\Œ\ﬂ$¿j2\„m•\≈@@<p\œÛ\ﬂ$¿éXãO\∆@@Ñ+†PO\ﬂ$¿\ÿÒ_\∆@@o\rlï`\·$¿.é\ M\‘\∆@@ªˇ\È\‚$¿èãj\«@@T\›ã\‚$¿\–#ÑG\«@@MN\ÌS\„$¿aP¶\—\‰\ @@◊†/Ω˝\È$¿\÷\≈m4Ä\À@@\√\ÿBêÉ\Í$¿\–∏Æò\À@@`±Üã\‹\Î$¿ı\◊+,∏\À@@\ƒ\Ì–∞\Ì$¿“åE\”\Ÿ\À@@8IÛ«¥\Ó$¿)B\Ívˆ\À@@Ò.Òù$¿4Çç\Î\ﬂ\À@@^ª¥\·∞Ù$¿\‡Ö≠\Ÿ\ \À@@\È\Õ<πˆ$¿∆§øó\¬\À@@4\Àf˘$¿¬äS≠Ö\À@@¿\Î3g}˙$¿ó9]\À@@ú˚´\«}˚$¿\'jinÖ\ @@\'æ\⁄Q¸$¿ıÇOs\ @@h≥\Ísµ˝$¿\‹~˘d\≈\ @@˛c!:˛$¿∞\Áå(\À@@≤ûZ}u˝$¿OÆ)ê\Ÿ\À@@ë\Ì|?5˛$¿ó∏\ \Ã@@¡=~ˇ$¿…è¯k\Ã@@\\\Ã\œ\rM%¿∂\ÿ\Ì≥\Ã@@r¡¸˝%¿Ÿ¥R\‰\Ã@@ú\Ê=\Œ%¿!yv˘\Ã@@\"\·{É%¿3Mg\'\Õ@@9EGr˘%¿ìã1∞é\Õ@@˜êΩø	%¿±¿Wt\Î\Õ@@\∆jÛˇ™%¿1±˘∏6\Œ@@,Ù¡26%¿\Zàe3á\Œ@@e®ä©%¿ì6U˜\»\Œ@@\Õ\”\⁄4%¿îÖØØu\œ@@\–dˇ<\r%¿\0u\ﬁ\œ@@ùFZ*o%¿&qVDM\–@@Dß\Á\›X%¿R∑≥Ø<\–@@∂-\ lê%¿\ZOq\–@@≥A&9%¿\Ë£\Á\–@@ùΩ3⁄™%¿µâì˚\–@@´\ÎPMI%¿¬¢\"N\'\—@@™\÷\¬,¥%¿5≤+-#\—@@9+¢&˙%¿B\Œ˚ˇ\–@@Q\ÿE\—%¿t@ˆ\Ì\–@@To\rlï %¿\0r¬Ñ\—\–@@Q\Ëy\"%¿•¯¯Ñ\Ï\–@@ë\'I\◊L&%¿¸»≠I∑\—@@â\ÏÉ,&%¿Jòi˚W\“@@≥\Îﬁä\ƒ$%¿˝Ñ≥[\À\“@@†¸\›;j$%¿ñ?\ﬂ,\”@@gö∞˝$%¿2\Á˚í\”@@\‰.\¬\Â\"%¿\Ëı\'Òπ\”@@Òû\À\"%¿…êc\Î\‘@@∂gñ®!%¿ü™B±\‘@@(Fñ\Ã!%¿á$ö\‘@@n\Óïy#%¿ñ$\œı}\‘@@Ú\Ì]Éæ$%¿\Œ\ﬁmU\‘@@o¿±\'%¿Åq\Â\Ï\”@@!ÆúΩ3*%¿;mç\∆\”@@ñ\Á¡\›Y+%¿\Áé˛ók\”@@.\ÊÁÜ¶,%¿¶∏™\Ïª\“@@í>≠¢/%¿∫¿\Â±f\“@@›ñ\»g0%¿ë(¥¨\—@@£í:5%¿Ü©-uê\—@@Ú¥¸¿U6%¿ˇBè=\—@@t_\Œl7%¿≥∑îÛ\≈\–@@\‰N\È`˝7%¿6Æ\◊g\–@@N∑\Ïˇ8%¿¸o%;6\–@@]Ot]¯9%¿Ä\÷¸¯K\œ@@Vù\’{<%¿Ògx≥\œ@@\Ëyít=%¿¨\‰cwÅ\Œ@@\»\Ó%>%¿0úkò°\Õ@@\nÉ2ç&?%¿;\∆G\Õ@@;q9^Å@%¿≥±Û¨\Ã@@PéD¡D%¿oπ˙±I\Ã@@\“8\‘\Ô\¬F%¿y∞\≈nü\À@@A¯ˆÆI%¿§˝∞\ @@ıÛ¶\"N%¿Ù3ı∫E\ @@\"\≈\0â&P%¿$0\‹\…@@¯XéêQ%¿¿{Gç	\…@@v\ﬁ\∆fGR%¿t#,*\‚\»@@h\Íuã¿P%¿8˝\⁄˙\«@@\÷\‚S\0åO%¿°Gåû\«@@ØD†˙Q%¿c+hZb\«@@û}\ÂAzR%¿\nÉ2\«@@Øì\‚\„S%¿∆âØv\«@@ˇYÛ\„/U%¿u\Ê\∆@@ì¸à_±V%¿ó\0¸S™\∆@@é@ºÆ_X%¿y¢\'e\∆@@2q´ Z%¿F\œ-t%\∆@@àÖZ”º[%¿;9Cq\«\≈@@≤ı\·ò]%¿d\ÀÚu\≈@@§U-\È(_%¿^Ù§\≈@@pUjˆ`%¿ªˇ\È\ƒ@@úlw†f%¿jâï\—\»\√@@N\r4üsg%¿\Õu\Zi\√@@Ω˝πh\»h%¿˜Ø¨4)\√@@[\Ó\Ã\√i%¿Ü7k\¬@@ı∑C\√j%¿ËæúŸÆ\¬@@\–w.l%¿¿\Î3g}\¬@@°J\Õn%¿U/ø\”d\¬@@>Abª{p%¿Û\À`åH\¬@@K?™q%¿\÷UÅZ\¬@@oeâ\Œ2s%¿\’\"¢òº¡@@\"7\√\r¯t%¿e∏u¡@@åjQLv%¿\Èö\…7\€¿@@æ˜7x%¿ÄGT®n¿@@âD°e\›w%¿-?pï\'¿@@shë\Ì|w%¿\÷8õé\0¿@@˝˙!6Xx%¿æ¢[Ø\Èø@@\‘~k\'Jz%¿(`;±ø@@5ôÒ∂\“{%¿isú€Ñø@@ë+ı,}%¿\–∏Æòø@@<€£7\‹%¿ú¿tZ∑ø@@OëC\ƒÕÅ%¿\◊j{ø@@æL!uÉ%¿ô∑\Í:Tø@@I°,|}Ö%¿âz¡ß9ø@@\Ô;Ü\«~Ü%¿Ç\ƒv˜\0ø@@°K8Ùá%¿û%\»®æ@@8gDiá%¿nø|≤bæ@@˛\r⁄´èá%¿VGétæ@@X´vMà%¿ˇ>\„¬Ω@@ı/Ieäâ%¿¡ß9yëΩ@@ByGã%¿£¨\ﬂLLΩ@@ÑK«úgå%¿Î´´µº@@\Ó≤_w∫ã%¿v\Zi©ºª@@¸UÄ\Ô6è%¿˘\Ÿ\»uª@@ÆaÜ\∆ë%¿g)YNBª@@∞íè\›í%¿ÅïCã∫@@)ó\∆/ºí%¿b\◊ˆvK∫@@\Ê\Ê\—=ì%¿f˘∫ˇπ@@2\ÊÆ%\‰ì%¿\‡h\«\røπ@@jMÛéSî%¿\”MbXπ@@G;n¯›î%¿oJy≠Ñ∏@@3Pˇñ%¿Ù\≈ﬁã/∏@@\◊M)Øïò%¿\’\'¢∑@@Ûgö∞ù%¿5sªó∑@@›öt[\"ü%¿\≈\Ê\„\⁄P∑@@òÖvN≥†%¿\◊i§•Ú∂@@≥]°ñ°%¿\Ë∫Å∂@@y\"àÛp¢%¿¡éˇA∂@@pCå◊º¢%¿˝\⁄˙\Èµ@@J\n,Ä)£%¿ak∂Úíµ@@ü\Ë∫É£%¿Ö\Œk\Ïµ@@f\›?¢£%¿v©˙ô¥@@¯\∆\0£%¿Vúj-¥@@\·µK£%¿KYÜ8÷≥@@Föxx¢%¿díë≥∞≥@@Eû$]3°%¿\‡û\ÁO≥@@çüq\·†%¿ıæÒµg≤@@£s~ä\„†%¿´	¢\Ó≤@@®n.˛∂ü%¿´!qè•±@@\Ã)1	ü%¿ï-Ø\\±@@P6\Â\nü%¿\Ê\ÿGß∞@@Å≈è1ü%¿aobHN∞@@\È\Õ<πû%¿\ZyYØ@@Afg\—;ù%¿x$(~Æ@@M\‹*àÅû%¿%Ø\Œ1Æ@@Y|Eü%¿é;•Éı≠@@d]\‹F†%¿p@KW∞≠@@W\'g(\Ó†%¿F]k\ÔS≠@@2q´ ¢%¿ãnΩ¶≠@@Ë°∂\r£%¿mscz¬¨@@õ©èƒ£%¿á¯á-=¨@@˙\—p\ ‹§%¿™aø\'÷´@@á¿ë@É•%¿ôf∫\◊I´@@9\–Cm¶%¿IÄöZ∂™@@6\ËKo¶%¿@ﬁ´V&™@@OîÑD⁄¶%¿\‹\r¢µ¢©@@b.©⁄¶%¿æáKé;©@@\'i˛ò¶%¿˘ûëç®@@ãC\‰§%¿<†l\ ®@@=+i\≈7§%¿U\⁄\‚\Züß@@t±3Ö¶%¿[]N	àß@@É§O´\Ëß%¿\Ô\ .\\ß@@Ø\—r†á™%¿77¶\',ß@@œΩá´%¿;\‰f∏ß@@•æ,\Ì‘¨%¿ùü\‚8¶@@¯q4GVÆ%¿5|\Î¶@@GUD›Ø%¿øôò.ƒ¶@@#j¢\œG±%¿\nÉ2ç¶@@Qköwú≤%¿˝Ùü5?¶@@/‹π0“≥%¿ê.6≠¶@@\"qè•µ%¿éXãO¶@@ã§\›\Ëc∂%¿7ßí¶@@˙*˘\ÿ]∏%¿Ä\‘&N\Ó•@@z5@i®π%¿Ot]¯¡•@@VÑa¿∫%¿™ED1y•@@ΩQ+Lﬂª%¿;˛•@@\ZS∞\∆Ÿº%¿\⁄uoEb§@@Çè¡äSΩ%¿\ÔSUh §@@\Î∆ª#cΩ%¿6\‰üƒ£@@ó™¥≈Ω%¿\ﬁ\»<Ú£@@\\\ËJ™ø%¿JzZù¢@@Ú%Tp¿%¿j0\r\√G¢@@QÜ™òJø%¿åû[\ËJ¢@@?\∆‹µÑº%¿Ü9Aõ¢@@ü\"áàõª%¿\Ó=\\r‹°@@Ú	\Ÿyª%¿vâÍ≠Å°@@?nø|≤∫%¿\≈rK´!°@@µTﬁép∫%¿rOWw,†@@Üì4Lª%¿é∞®à”ü@@\⁄\Â[÷ª%¿\‡\ÎT˘û@@y=òø%¿\Ÿ]†§¿û@@⁄Æ\–\À¿%¿\…rJ_û@@Ku/\√%¿\Ë\›XPû@@©Ñ\'Ù˙\√%¿»óP¡ù@@\“˝úÇ¸\ƒ%¿\'3\ﬁVzù@@Ç\0:\∆%¿L¶\nF%ù@@\"≥\ÏI\»%¿ûí>ù@@F^\÷\ƒ\ %¿\’ºÃ∞ù@@Y∑\—\0\Œ%¿o)ÁãΩù@@\ﬁ\„L∂\œ%¿ó<ûñû@@§®3˜ê\–%¿πòäû@@\ÌE¥S\œ%¿\÷µ¬û@@èR	O\Ë\Õ%¿+l∏ ü@@\ N?®ã\Ã%¿æi˙ÏÄü@@O$òjf\Õ%¿öœπ€ü@@dø\r1\Œ%¿Bïö=†@@æ1\0\«\Œ%¿-Õ≠V°@@n5\Îå\Ô\À%¿úR^+°°@@üF\œ%¿Ò\rÖ\œ÷°@@w£è˘Ä\–%¿e\ZM.¢@@ù{h\”%¿\œihw¢@@â±LøD\‘%¿\÷;\‹\r£@@r¯§	\÷%¿ˇXàÅ£@@õZ∂\÷\Ÿ%¿\Ë§˜çØ£@@\\éW z\⁄%¿\√c\“ﬂ£@@Swe\‹%¿_òL§@@Ç…ç\"k\›%¿©eo)•@@\Î\Âwö\Ã\‡%¿.v˚¨2•@@ö[!¨\∆\‚%¿L\√1•@@…Æ¥å\‘\„%¿\∆\√{,•@@ø\’:q9\Ê%¿I¢óQ,•@@6Ü\Â\œ\Á%¿µ¿)•@@’Æ	iç\È%¿\À/É1\"•@@J\ÌE¥\Î%¿¸rfªB•@@c\Ì\Ôlè\Ó%¿¡ë@ÉM•@@Zõ\∆ˆZ%¿<FzQ•@@ò//¿>Ú%¿\œ\€\ÿ\ÏH•@@óåc${Ù%¿&4I,)•@@G\r6uˆ%¿Qán˘§@@6ù:¯%¿Å\ÍD2§@@XÀùô`¯%¿;]•ª£@@¡ °E∂˚%¿jkD0§@@ê¸6\ƒ\0&¿=∏;k∑ß@@\Îò\‹\0&¿\œ:Ø±ß@@Dãl\Á˚&¿ûñ∏ ß@@Ω®›Ø&¿Ûíˇ\…ﬂß@@≠\‹\Ã\n&¿¿®@@+á\Ÿ\Œ&¿\‚´\≈9®@@{\Ÿv\⁄\Z	&¿\¬¯i®@@qhî&¿\œihw®@@Ù\Ô9&¿Ü!Y¿®@@W∞çx≤&¿h@Ω5©@@Xˇ\Á0_&¿D5%Yá©@@H˛`\‡π&¿πƒë™@@ÕïAµ¡&¿Xt\Î5=™@@d\Ámlv&¿AùÚ\ËF™@@\ \Zıç&¿®¨¶Îâ™@@Ù£·îπ!&¿\"éuq´@@_\ŒlW\Ë#&¿\ÕX\‰´@@¨\‚ç\Ã#\'&¿Ωm¶B<¨@@ú\·|~(&¿G‰ªî∫¨@@J∑%r¡)&¿˛{⁄•≠@@/m8,\r,&¿\ÁV´±Æ@@£Vòæ\◊0&¿\ﬂ¬∫Ò\ÓÆ@@¸åB2&¿\«\⁄\ﬂ\ŸØ@@ä\…`\Ê3&¿Cr2qØ@@u6&¿DkEõØ@@\‹\rãQ7&¿lv§˙ŒØ@@Q§˚99&¿öEÛ\0∞@@ôùE\Ô<&¿4ºYÉ˜Ø@@˚=±Nï?&¿Ù˙ì¯‹Ø@@4ùùéB&¿S	O\ËıØ@@-B±4E&¿D3OÆ)∞@@¢\—\ƒF&¿;é*ç∞@@W–¥\ƒ\ H&¿y[\ÈµŸ∞@@o\rlï`I&¿©†¢\ÍW≤@@MHk:I&¿ó˛%©L≥@@h\Î\‡`oJ&¿í\ËeÀ≥@@)wü\„£M&¿\rnkœ≥@@\”ıD◊ÖO&¿+¶\“O8≥@@ˆó›ìáU&¿ò°ÒD≥@@aS\ÁQÒW&¿\Œ\≈\ﬂˆ≥@@(µ¶Y&¿AJ\Ï\⁄ﬁ≤@@f˙%\‚≠[&¿\Ì)H≤@@t\Ô\·í\„^&¿Ø≤∂)≤@@:\ ¡ld&¿ûœÄz3≤@@,πäe&¿\Í\ gy≤@@\'/2øf&¿öœπ€±@@¢|Ai&¿\nºìOè±@@\ZM.\∆¿j&¿%ìS;±@@VF#üWl&¿\–D\ÿ∞@@Aπmﬂ£n&¿1^Û™Œ∞@@o\‘\n\”˜r&¿5\«e∞@@Mıd˛\—w&¿\Ï\ÏÜmØ@@\Ô\‰\”c{&¿L\·A≥\ÎÆ@@®\ÂÆÚ|&¿6Ò∫~≠@@n3‚ëÄ&¿\Ï.PR`≠@@®˝\÷NîÑ&¿˜Wè˚V≠@@\Ê\"æ≥Ü&¿nN%@≠@@\ŸC˚X¡á&¿ìÜV\'≠@@ıç\Óà&¿ΩqRò˜¨@@qN`ä&¿ÿÅsFî¨@@EÚï@Jå&¿c≥#\’w¨@@âõS\…\0ê&¿\nù\◊\ÿ%¨@@•Û\·Yí&¿31]à’´@@=HOëCî&¿sπ¡Pá´@@3˚<Fyñ&¿†4\‘($´@@Ylìä∆ö&¿\0{ˆ™@@7n1?7ú&¿¸o%;™@@O±j\Êû&¿ç\”U¯©@@†Q∫Ùü&¿à,\“ƒ©@@b\Ÿ\Ã!°&¿#k\r•ˆ®@@S±1Ø#¶&¿4\Á\Z®@@oÄô\Ô\‡ß&¿\“S\‰qß@@≠¶ÎâÆ´&¿˛\r⁄´èß@@\’A^&≠&¿Úz0)>®@@ˆ^|\—∑&¿\ƒ_ì5\Íß@@Y⁄©π‹∏&¿\›^\“≠ß@@H\‚\Â\È\\π&¿≥µæHhß@@(I\◊Læπ&¿Çp\Í•@@®É§Oª&¿£í∞o•@@ò0öï\Ìª&¿?$D˘§@@ã√ô_Ω&¿@Ö#H•§@@\Â\“¯Öø&¿]¸mOê§@@Û =E¡&¿º!ç\nú§@@Ù©cï\“\√&¿¶∑?\r•@@≠\ﬁ\·vh\»&¿\"¡T3k•@@q\r\‡-\–&¿HP¸s•@@zSë\nc\”&¿Ø±KTo•@@E†˙ë\‘&¿û]æıa•@@Aúáò\÷&¿‹Ç•∫Ä•@@-?pï\'\ÿ&¿eå≥ó•@@\n◊£p=\⁄&¿˙%\‚≠Û•@@∂ÜR{\›&¿\«fG™\Ô§@@\‰Ç3¯˚\›&¿≈´¨m§@@\\\Á\ﬂ.˚\›&¿\–\rM\Ÿ\È£@@ÙS^\›&¿PS\À\÷˙¢@@á¢@ü\»\€&¿ÄJï¢@@¸\„Ωje\⁄&¿¢óQ,∑†@@V\ÿpA\÷&¿5ö\\åÅü@@3RÔ©ú\÷&¿ùÛSü@@åÉK«ú\◊&¿\”2RÔ©û@@\‰ı`R\‹&¿:î°*¶û@@X\‚eS\ﬁ&¿•Ñ`UΩû@@K9_\ÏΩ\‡&¿sıcì¸û@@ú•d9	\Â&¿Ö8Ñ*ü@@cÚò˘\Ê&¿˜:©/Kü@@á¢@ü\Ë&¿\Ëº\∆.Qü@@dñ=	l\Ó&¿\∆\·ÃØ\Êû@@kπ3˜&¿\‰áJ#f†@@33333\'¿\·ï$\œıü@@AÅwÚ\È\'¿/¢Ìò∫ü@@Ä≤e˘\'¿b\Ÿ\Ã!ü@@ìåúÖ=\'¿^*6\Êuû@@;\‡∫bF\'¿\nÜs\r3û@@\"˚ ÀÇ\'¿k∂Úíˇù@@ï\rk*ã\Z\'¿—∞u≠ù@@+hZbe\'¿Kw\◊Ÿêù@@:\À,B±\'¿,ü\Âypù@@\‹eø\Ót\'¿\È\r˜ë[ù@@mr¯§!\'¿P\·Rù@@öï\ÌC\ﬁ\"\'¿ıı|\Õrù@@v3£\r\'\'¿≤Û¨§ù@@ôIÙ2*\'¿2\…\»Yÿù@@9∂û!+\'¿v√∂Eôù@@Ae¸˚å+\'¿∂Go∏èú@@_”ÉÇR,\'¿%=≠Nú@@\ÿc\"•\Ÿ,\'¿äîfÛ8Ä@@\“U∫ª\Œ\Œ\'¿ \rß\Ã\Õy@@\ﬂ\ﬁ5\0(¿^-wfÇw@@÷™](¿ø|≤b∏x@@\ PS\È7(¿ZJñìPx@@\ﬁ\„L∂7(¿X™xôw@@˛\Ôà\n\’5(¿Úw\Ô®1w@@\÷\·\Ë*\›5(¿|\”Ù\Ÿw@@Ö	£Y\Ÿ6(¿\ŒQG\«\’v@@\Z\‹\÷û7(¿ã˚èLáv@@L‚¨àö8(¿ {Ω˚\„u@@§ˇ\ÂZ¥8(¿;:ÆFvu@@\ÓA»ó8(¿˝°ô\'u@@#eã§\›8(¿Ê≠∫\’t@@z\·ŒÖ9(¿T\‰qst@@üt\"¡T;(¿j\'˜;t@@B\"m\„O<(¿›ó3\€t@@§¶]L3=(¿/Ü\»\Ès@@\·≤\nõ>(¿\»\“≈¶s@@È∑Ø?(¿\\ív5s@@vß;O<?(¿2Ø#\Ÿr@@\r\ﬂ¬∫Ò>(¿\0ê&år@@˙œö?(¿∞©Û®¯q@@7¶\',Ò@(¿µm¡q@@Ã≤\'Å\ÕA(¿\ﬂP¯lq@@\Õ\\\‡ÚXC(¿Ùà\—sq@@;\∆GE(¿7\ƒxÕ´p@@sÄ`éG(¿£\È\Ïdpp@@(\‘\”GH(¿y@Ÿî+p@@†4\‘($I(¿\À«∫∏o@@\Ô®1!\ÊJ(¿¯Rx\–\Ïn@@Ee√ö\ J(¿àÅ#Ån@@Sz¶óK(¿íy\‰n@@\Ÿ#\‘©J(¿Û\Â\ÿGm@@˛Ú…ä\·J(¿)\–\'Ú$m@@JÒÒ	\ŸI(¿/\√∫Ål@@ˇ\–ÃìkJ(¿\∆\ƒ\Ê\„\⁄j@@X´vMHK(¿ij@@\"lxz•L(¿\\è\¬ı(j@@\¬\÷l\ÂM(¿&˛(\Í\Ãi@@\»$#gaO(¿\–BFói@@\nıÙP(¿gc%\ÊYi@@≠5î⁄ãP(¿±¶≤(\Ïh@@ÚµgñP(¿O!W\ÍYh@@Ω\‰ÚwO(¿áåG©Ñg@@∫k	˘†O(¿~Ωp\Ád@@*9\'ˆ\–N(¿®Tâ≤∑d@@\0:ÃóP(¿+n\‹b~d@@\0™∏qãQ(¿Ä”ªx?d@@+√∏DS(¿\Ô\»Xm˛c@@¯ÑT(¿<æΩk\–c@@§\‡)\‰JU(¿ë9∂ûc@@ù- ¥V(¿¨:´ˆb@@|&˚\ÁiX(¿\ 4ö\\b@@6\»$#gY(¿yx\“\¬a@@}Æ∂bY(¿\«\Ÿtpa@@îh\…\„iY(¿õZ∂\÷a@@˜é\ZZ(¿•\‹}éè`@@òQ,∑¥Z(¿⁄é©ª≤_@@eÆπ[(¿\„\‡\“1_@@πrˆ\Œh[(¿ZÙP\€^@@6\\ê-[(¿/l\ÕV^^@@-Õ≠V[(¿\Ÿ\Œ˜S\„]@@`X˛|[(¿ãmR\—X]@@\ﬁT§\¬\ÿZ(¿\nÉ2ç&]@@¸˚åZ(¿¢(\–\'Ú\\@@∏Ø\ÁåX(¿ˆ&Ü\\@@∫I+W(¿{Ö˜\\@@¿{Gç	Y(¿\»“á.®[@@ÀüoñZ(¿˙aÑh[@@˜tu\«b[(¿fá¯á-[@@ds\’<G\\(¿è3M\ÿ~Z@@óÆ`Ò\\(¿á¯á-=Z@@±ø\Ïû<\\(¿•0\Ôq¶Y@@\”L˜:Y(¿XrãY@@t_\ŒlW(¿\'\‹+ÛVY@@\ÍwakV(¿IÙ2ä\ÂX@@ÿÅsFîV(¿ñ\È)rX@@c∏:\0\‚V(¿π\ﬁ6S!X@@?#KV(¿d\ÈC\‘W@@fM,U(¿$\—\À(ñW@@fÜç≤~S(¿\nIfıW@@{\Ÿv\⁄\ZQ(¿\„4ÙOV@@ÒGT®N(¿\\8íV@@‹Ω\‹\'GI(¿ˆ#EdXU@@N} y\ÁH(¿Émƒì\›T@@\–∏ÆòI(¿é[\ÏˆS@@≠1\ËÑ\–I(¿¶+\ÿF<S@@j3NCTI(¿˜\Õ˝\’\„R@@âóßsEI(¿ê‹öt[R@@ÆfùÒ}I(¿\ŒSr3R@@x\'üK(¿I\ÿ\’\‰Q@@Òe¢©K(¿\ÃE|\'fQ@@\rRL(¿\–D\ÿÙP@@\⁄r.\≈UM(¿5\—\Á£P@@%<°◊üL(¿∏\‰∏S:P@@Ä∫Å\ÔL(¿]˛C˙\ÌO@@ão(|∂N(¿8h∞O@@ˇ\Î‹¥O(¿9µ3LmO@@±j\ÊvO(¿÷årO@@∞Øu©R(¿dØwN@@à\ÿ“£Q(¿E∏…®2N@@9ùd´\ÀQ(¿∞˜≠\÷M@@û	MS(¿™xôaM@@è6éXS(¿~åπk	M@@Üèà)ëT(¿\€¡à}L@@•h\Â^`V(¿ò˚\‰(@L@@µ\ﬁo¥\„V(¿\Èe\À-K@@\ﬂﬂ†Ω˙X(¿†ä∑J@@Ñ-v˚¨Z(¿\ƒ\Ã>èQJ@@ò¡ë(\\(¿û%\»J@@:\Ë](¿rˆ¥\√I@@ˆ—©+ü](¿†‹∂\ÔQI@@.ùÛS\\(¿éègI@@à∫@j[(¿Û¨§I@@-¥söZ(¿\ƒ\'ùH0I@@\»\Œ\€\ÿ\ÏX(¿Rùd=I@@\÷ˇ9ÃóW(¿\Ã\Ó\…\√BI@@{˘ù&3V(¿?˛“¢>I@@a\\:\ÊT(¿oeâ\Œ2I@@û?mTßS(¿VõˇWI@@Ñb+hZR(¿	ÚnH@@EÅ>ë\'Q(¿˛∂\'HlG@@\◊ﬁß™\–P(¿RêhG@@ôÙ˜RxP(¿Éái\ﬂF@@\Îptï\ÓN(¿\À\ÿ\–\ÕF@@\≈Sè4∏M(¿=µ˙\Í™F@@R∑≥ØL(¿>\Õ…ãLF@@©Ñ\'Ù˙K(¿&m™\ÓëE@@c0\ÌõK(¿îi4πE@@o\‘\n\”˜J(¿¿\Õ\‚\≈D@@áO:ë`J(¿N\'\Ÿ\ÍrD@@Pîi4I(¿]\√ç\'D@@f-§˝G(¿d;\ﬂOçC@@+/˘ü¸E(¿¸\‡|\ÍXC@@\Z•KˇíD(¿\ÀiO\…9C@@â\Ôƒ¨C(¿L8ÙC@@∫\€ı\“A(¿Ø\–\À\ÿB@@\Õ…ãL¿?(¿&p\ÎnB@@5~\·ï$?(¿ß/˙\nB@@\∆2˝Ò>(¿év\‹ªA@@Ü\Á•bc>(¿\Áq\Ã_A@@°.R(?(¿\Îé\≈6©@@@∏\"1A\r?(¿ö?¶µi@@@¢U1ï>(¿àÚ-$@@@†O\‰I\“=(¿ï\'vä?@@y\Íë∑=(¿\‚:\∆?@@ö\È^\'ı=(¿Ü8\÷\≈m>@@_ïï=(¿py¨>@@ª`p\Õ=(¿+0du´=@@U.T˛µ<(¿4Û\‰ö=@@,ûz§¡=(¿{°Ä\Ì`<@@8ákµá=(¿\«e\‹\‘@;@@Ä∂’¨3>(¿º\œÒ\—\‚:@@\'˙|î?(¿-x\—Wê:@@shë\Ì|?(¿\…¸\ZI:@@2Æ∏8*?(¿˘*:@@\ŸBêÉ>(¿Ú\Ô3.:@@ÜUºëy<(¿\ƒ\Íè0:@@$õ´\Ê9:(¿\∆\ﬂˆâ9@@ï\Ôâ\–8(¿\‡c∞\‚T9@@î¯\‹	ˆ7(¿\„5Ø\Í8@@(ôú\⁄6(¿ÆÚ\¬8@@ß\‘E\n5(¿n/Ü8@@wg\Ì∂3(¿µ4∑B8@@Ja\ﬁ\„L3(¿qxµ\‹7@@±\‡~¿3(¿±M*\Zk7@@∏\nıÙ1(¿\…<Ú7@@KxBØ?1(¿z®m\√6@@\œ¿\»Àö0(¿v5y\ j6@@*\∆˘õP0(¿¸ﬁ¨¡5@@ºW≠L0(¿¿#*T75@@êæI”†0(¿Rr•4@@r›îÚZ1(¿°\ŸuoE4@@-”æ1(¿ÆI∑%r3@@pCå◊º2(¿\ÈIô\‘\–2@@º \"5\Ì2(¿æl;mç2@@@4Û\‰ö2(¿\ŒQ\⁄2@@z©ÿò\◊1(¿¯2QÑ\‘1@@dì¸à_1(¿GN∂Å1@@T\0åg\–0(¿nâ\\p1@@>Y1\\0(¿1|DLâ0@@y\ŒZ/(¿∂ˆ&0@@JA∑ó4.(¿Õ´:´0@@/3lîı+(¿(CUL•/@@S]¿\À+(¿ª\’s\“˚.@@r\≈\≈Qπ)(¿\Ô\0OZ∏.@@˚ê∑\\˝((¿©æÛã.@@JÜ4*((¿\Œ˚ˇ8a.@@\Î¸\€eø&(¿µ\Z˜X.@@ºï%:\À$(¿\—ı-s.@@q!è\‡F\"(¿$Ú]J].@@´\Á§˜ç(¿æøA{ı-@@-y<-(¿ô†Üoa-@@`\0\·Câ(¿\Õ\Àa˜-@@±ã¢>(¿Ø@Ù§,@@T®n.˛(¿6\‰ü\ƒ+@@¶|™F(¿\Ìˇ∞•+@@Wñ\Ë,≥ (¿Ñ*5{†+@@í=BÕê\"(¿m´Yg|+@@:x&4I$(¿éyq\»*@@\›	ˆ_\Á&(¿Ú\œ\‚)@@\›ãä((¿sÇ69|(@@\n±àa\'(¿\ ˘b\Ô\≈\'@@O≤\’\Âî((¿¬¢\"N\'\'@@/m8,\r,(¿JEc\Ì\Ô&@@√∏Dk-(¿\»\œFÆõ&@@\Ó\Ã√π.(¿\Ÿ\—8\‘\Ô$@@°Ç\√\"2(¿ìE\÷\Z$@@L¬Ö<Ç3(¿é[\Ïˆ#@@íÆô|≥5(¿sÉ°+$@@\ÿıv\√6(¿`ì5\Í!$@@\⁄∆ü®l8(¿\…Àª\Í#@@µ\Z˜X:(¿>\Î\Z-$@@êÑ};â@(¿£\Œ\‹C\¬#@@~åπk	I(¿ä\ÈB¨˛\"@@©;\ZáJ(¿\ﬁ\Â\"æ#@@Ö&â%\ÂN(¿\Ï\€ID¯#@@ZÚxZ~P(¿¢U1ï$@@iå\÷Q\’T(¿\Õu\Zi%@@|E∑V(¿PQı+ù%@@Têüç\\W(¿0πQd≠%@@Å\ÃŒ¢wZ(¿õ.»ñ%@@¨\Â\ŒL0\\(¿PQı+ù%@@\ÕvÖ>X^(¿MK¨åF&@@∑≥Ø<H_(¿@KW∞ç&@@Àùô`8_(¿C±l\Ê&@@˘ıCl`(¿ÉP\ﬁ\«\—&@@\⁄;£≠Jb(¿G ^\◊/&@@V+~©g(¿!\Œ\√	L%@@\'æ\⁄Qúk(¿ò\‹(≤\÷$@@’Øt><k(¿πòä$@@¥\…\·ìNl(¿C8fŸì$@@∫Å\Ít(¿rP\¬L\€#@@\Ê±fdê{(¿˙\ÏÄ\Îä#@@\Õu\Zi©|(¿Éà‘¥ã#@@7ç\Ìµ†(¿\„\·=ñ#@@\ÂÄ]MûÇ(¿>œü6™#@@\¬\÷l\ÂÖ(¿¥\Ëù\n∏#@@¯P¢%èá(¿\Ó≤_w∫#@@_(`;â(¿äV\Óf#@@\‡Jvlä(¿\ÌÇ¡5w\"@@	pz\Ôá(¿\›A\ÏL°!@@\√,¥söç(¿\ ˚8ö!@@.\∆¿:éè(¿1\'hì\√!@@≥{Ú∞Pì(¿¥Ñ\÷\√!@@\¬MFïaî(¿ìnK\‰Ç!@@ {Ω˚\„ï(¿ñ_cD @@Ù\·YÇåò(¿\0\∆3h\Ë@@	¶öYKô(¿˚På,@@\‡ÄñÆ`õ(¿™\rNDø@@ºx?nøú(¿2\…\»Y@@?6…è¯ù(¿ç\‘{*ß@@ñ]0∏\Êû(¿e73˙\—@@@2:=ü(¿W#ª\“2@@òøB\Ê †(¿ãàbÚ@@∏YºX¢(¿ç(\Ì\ræ@@\„¸M(§(¿U¢\Ï-\Â@@tA}Àú¶(¿H5\Ï˜\ƒ@@(Ç8\'®(¿)]˙ó§@@óræ\ÿ{©(¿\Ï†\◊1@@¿îÅ´(¿≤F=D£@@∫ˆÙ™(¿\‡/fKV@@\√\r¯¸0™(¿Ωé8d@@¢≤aMe©(¿qè•]\Z@@dx\Ïg±¨(¿DoÒû@@áQ<æ≠(¿uV\Ï1@@¥À∑>¨Ø(¿µ∆†B@@\‚vhXå≤(¿~8gD@@\\=\'Ωo¥(¿Ö\Õ\0d@@BA)Zπ∑(¿J∏êGp@@\œ0µ•∫(¿]n0\‘a@@¸\‡|\ÍXΩ(¿∂KK@@`ë_?ƒæ(¿nlv§˙@@f¯O7P¿(¿\Ã\rÜ:¨@@p|\Ìô%¡(¿<l\"3@@|∑y\„\ƒ(¿™”Å¨ß@@gÚ\Õ67\∆(¿≠Mc{-@@<˜.\…(¿\Õ.è5@@H\≈ˇQ\…(¿\“\·!åü@@¯\‚ãˆx\…(¿Œç\È	K@@àúæûØ\…(¿b0Ö\Ã@@x∏\Z\À(¿Ò\÷˘∑@@«É-v˚\Ã(¿\ŒSr3@@\Î6®˝\÷\Œ(¿JÜ4*@@+5{†\–(¿Yøôò.@@\'\"\‡\“(¿Z/Ür¢@@g∂+Ù¡\“(¿\Ï£SW>@@¿\0¬á\“(¿Ç\‚«òª@@ö≤\”\“(¿\¬N±j@@ÿ∏˛]ü\—(¿∑}è˙\Î@@\—\Ëbg\“(¿©K\∆1í@@rk\“mâ\‘(¿|“âS@@è=∑\–\’(¿á6\0@@!yv˘\÷(¿M\nJ\—@@ÆõR^+\Ÿ(¿X8IÛ\«@@T™D\Ÿ[\⁄(¿LäèO\»@@◊æÄ^∏\€(¿\€P1\Œ\ﬂ@@F¥Sw\›(¿:ì6U˜@@-	PS\À\ﬁ(¿\Ãc\Õ\» @@¯\∆\0\„(¿˝°ô\'@@n\ƒ@\◊\Ê(¿&©L1@@Ú^µ2\·\Á(¿q $ò@@Äa˘Ûm\È(¿ºÆ_∞@@\„U\÷6\≈\Î(¿`∞∂-@@ã¡√¥o\Ó(¿Î´´µ@@mè\ﬁpÒ(¿6¨©,\n@@ö&l?Û(¿ywd¨6@@CÆ‘≥ Ù(¿p^ú¯j@@ˆ¥\√_ìı(¿z\‰û@@éì¬º\«˘(¿AÒc\Ã]@@ºÆ_∞˛(¿\È|xñ @@@¯P¢%ˇ(¿®\ZΩ\Z†@@6í\·\n\0)¿Pâ\ÎW@@ªîX\0)¿\‘)ènÑ@@¯˘\Ô¡)¿°l\\@@R\“\√\–\Í)¿}\È\Ì\œE@@cD¢–≤)¿Ü\«~K@@Ò\Ÿ:8\ÿ)¿àûîI@@ê0Xr\r)¿õ<e5]@@Ø[\∆˙)¿∞Y.ù@@ìT¶òÉ)¿~\√DÉ@@Ò\rÖ\œ\÷)¿æ†Öå@@4ÙOp±)¿\«-\Ê\ÁÜ@@C\€¡à)¿\»–±@@l]jÑ~)¿˚[O@@Ä\rà)¿åJ\Í4@@SuèlÆ\Z)¿[A\”+@@i5$\Ó±)¿øõn\Ÿ!@@ådèP3$)¿æ¢[Ø\È@@Zbe4Ú))¿\»T∆ø@@3ƒ±.n+)¿\“\»\ÁO@@∞\≈nüU.)¿\Œ{/æ@@\0\Z•Kˇ2)¿;®\ƒuå@@>¿x5)¿,ÒÄ≤)@@\ﬁ;jLà9)¿uÄ\‘&@@\Ë\ÿA%Æ;)¿\«\ÿ	/¡\r@@\'\·_=)¿∏ï^õç\r@@‹ª}\È=)¿d∞\‚Tk\r@@çõ\Zh>?)¿ﬂ§iP4\r@@\Ïm3\‚A)¿\ŸzÜp\Ã@@\¬˘‘±JI)¿\"Hõ@@i9\–CmK)¿+\‹Úë@@∞ \ÕX4M)¿ñØ\Àü@@kJ≤GO)¿ˇ\Ê≈âØ@@\›\\¸mOP)¿\›aôπ@@-\È(≥Q)¿û\'û≥@@∏<÷åT)¿bHN&n@@xcAaPV)¿N	àI∏\n@@∏@Ç\‚\«X)¿1`\…U,\n@@\ÀHΩßrZ)¿{◊†/Ω	@@që{∫∫[)¿Ò§Ö	@@¢\Óê\⁄\\)¿n§lë¥	@@x%\…s}_)¿Å∞S¨\Z\n@@¡\Zg\”`)¿™ÇQIù\n@@9EGr˘_)¿DioÖ@@gÛ8\Ê_)¿ùæûØY@@Ø\'∫.¸`)¿\·_çô@@&S£b)¿Çã5ò@@M÷®áhd)¿\“V%ë}@@#\◊M)Øe)¿\‡/fKV@@\Œ5\Ã\–h)¿/˙\n\“\n@@ì¨\√\—Uj)¿z®m\√\n@@`\ ¿-m)¿öœπ\€ı\n@@\Ï\¬Œßn)¿ÃòÇ5\Œ\n@@\Z4ÙOpq)¿3RÔ©ú\n@@\·òeOs)¿&\Â\Ós|\n@@lÀÄ≥ît)¿\¬Ÿ≠e\n@@obHN&v)¿7\≈\„¢Z\n@@óU\ÿx)¿\‰1ïÒ	@@:=\Ô∆Çz)¿y±0DN	@@ö>;\‡∫z)¿ë\ÔR\Í@@\·$\Õ\”z)¿Ò/Ç\∆L@@&åfe{)¿ú£éé´@@Åìm\‡|)¿1\Ó\—Z@@çG©Ñ\'|)¿FA¯@@9Cq«õ|)¿C´ì3@@d\Ë\ÿA%~)¿=Y§â@@Ò-¨\Ô~)¿\◊˘∑\À~@@0úkò°Å)¿\‰¯°“à@@\Àˆ!oπÇ)¿ñZ\Ô7\⁄@@˘d\≈pÖ)¿SYvQ@@˘ÑÏºçÖ)¿\–b)íØ@@-ôcyWÖ)¿_ñvj.	@@}A	Ö)¿xe®ä	@@\’íwÖ)¿\“o_\Œ	@@@˜\Â\ÃvÖ)¿©˙ïŒá	@@\√\Ô¶[và)¿X\ÁêΩ@@\ÍØWXpá)¿æ°\Ÿ:@@|û?mTá)¿ZEh\Ê@@é\Ÿ\Î›á)¿ó˝∫”ù@@+1\œJZâ)¿ª’îd@@≥A&9ã)¿\Ì\Ôlè\ﬁ@@ÅŒ§Mç)¿°J\Õ@@ˇwDÖ\Íé)¿à\◊ı@@\'¡“®ê)¿\’[[%@@D˙\Ì\Î¿ë)¿ò\ÀÙK@@QΩ¬í)¿tA}Àú@@¢|Aì)¿¨\‚ç\Ã#@@\·B¡çî)¿N∂Å;P@@\‘\“\‹\naï)¿©i\”L@@2\0Tq\„ñ)¿{§¡mm@@xEøïî)¿Øœúı)@@qWØ\"£ì)¿IÜ[\œ@@ |(—í)¿è\Èå@@#fˆyåí)¿πß´;@@õ©æÛì)¿[ïDˆA@@åˆx!ñ)¿QΩ5∞U@@º]/Mò)¿ôFìã1@@—ì2©ô)¿gaO;¸@@XT\ƒ\È$õ)¿©Öí…©@@#æ≥^ú)¿ıª∞5[@@¢Çãù)¿h∞©Û@@6ëô\\û)¿á\ZÖ$≥@@%\Ë/Ùà°)¿\ﬁ Z+\⁄@@∞\Âï\Îm£)¿¶∏™\Ïª@@Ùp\”i•)¿$~\≈\Z.@@ìp!è\‡¶)¿∫û\Ë∫@@N*\Zkß)¿\œ˜S\„•@@0†\Ó\\®)¿-ôcyW@@∞çx≤õ©)¿&©L1@@M˜:©/´)¿ãåH\¬\0@@(µ\—v¨)¿G<\ŸÕå\0@@\»\“≈¶≠)¿Z_\0@@ÒÑ^Ø)¿8íL\0@@a™ôµ∞)¿˜w∂Go\0@@Øz¿<d≤)¿Éh≠hs\0@@¸\ﬂ™≥)¿yít\Õ\‰ˇ?@x\nπRœ≤)¿w\‹ª\È˛?@ßx\\Tã∞)¿¡¸˝b˛?@éH∞)¿Àüo˛?@ñZ\Ô7⁄±)¿\ÊÆÚ˛?@í>≠¢?¥)¿¬•c\Œ3˛?@¿yq‚´µ)¿Åx]ø`ˇ?@∑\Ì{\‘_∑)¿\n∫Ω§1\0@@Ü\«~Kπ)¿~7›≤C\0@@∆á\ŸÀ∂ª)¿\ÿÙJY\0@@\÷TÖΩ)¿óRóåc\0@@+ï\‘	¿)¿(Hlw\0@@\‡π˜p\…¡)¿m®\Áo˛?@¯Ac&¡)¿a\√\”+˝?@ä\ÀÒ\nDø)¿\Ÿ=yX¸?@ï-Ø\\ø)¿\≈9\Í\Ë¸?@-$`ty\√)¿¸˝b∂d˝?@˙\—p\ \‹\ƒ)¿h\È\n∂˝?@˛)U¢\Ï\≈)¿\'fΩ\ ˝?@B∞™^~\«)¿\ÿ\Ôâu™¸?@\ﬂN\"¬ø\»)¿Y5sª˚?@£ x|{\«)¿z¸ﬁ¶?˚?@®r\⁄Sr\∆)¿d\Êó\«˙?@.rOWw\ƒ)¿\¬\ﬂ/fK˙?@\‘I∂∫ú\¬)¿\ﬂó™¥˘?@íìâ[¡)¿\‚eSÆ¯?@,º\ÀE|ø)¿J\Îo	¿˜?@ø[≥ïø)¿Éˆ\Í\„°˜?@ªπ¯€û¿)¿±˚é\·±˜?@\"\∆k^\’¡)¿â\ÎW\\¯?@\∆5>ì˝\√)¿˜u\‡ú˘?@n¬Ω2o\≈)¿\›%qVD˘?@}ZEh\∆)¿\‡G5\Ï˜¯?@\≈<+i\≈\«)¿üUfJ\Î˜?@ûBÆ‘≥\»)¿\∆0\'hì˜?@\Ï‹¥ß\…)¿33333˜?@M1AG\À)¿2: 	˚ˆ?@_ô∑\Í:\Ã)¿IùÄ&\¬ˆ?@¶{ù‘ó\Õ)¿π¡Páˆ?@…´s\»\Œ)¿æl;mçÙ?@˜ì1>\Ã\Œ)¿g(\ÓxìÛ?@n\€˜®ø\Œ)¿8\‹GnMÚ?@DP5z5\–)¿_∑åıÒ?@_(`;\—)¿N\“¸1≠Ò?@vR_ñv\“)¿¸˝b∂dÒ?@z\‰û\”)¿/¸\‡|\Í?@cC7˚\’)¿f/\€N\Ô?@\À-≠Ü\‘)¿x\nπR\œ\Ó?@ÿúÉgB\”)¿¥[\Àd8\Ó?@\ÏÖ∂É\—)¿IÛ«¥6\Ì?@ëò†Üo\—)¿tzﬁç\Ì?@Sz¶ó\”)¿ü\€2\‡\Ï?@Rµ\›\ﬂ\‘)¿e\ZM.\∆\Ï?@óuˇXà\÷)¿\‰Ü\ﬂM∑\Ï?@\Ê\À∞\◊)¿€ø≤“§\Ï?@m¨\ƒ<+\Ÿ)¿\”¯ÖWí\Ï?@¨™ó\ﬂi\⁄)¿ (∑\Ì{\Ï?@)±k{\€)¿)$ô\’;\Ï?@+\‘\›)¿∫.¸\‡|\Í?@~7›≤C\‹)¿s€æG˝\È?@Å#Å\€)¿ﬁè\€/ü\Ë?@7ßí†\⁄)¿¢\Ÿ:8\Ë?@#Û\»\‹)¿Î≠Å≠\Ë?@˛{⁄•\›)¿\nLßu\Ë?@\Ïæcx\Ï\ﬂ)¿_∂ù∂F\Ë?@π´Wë\—\·)¿*Ral!\Ë?@T\‡d∏\„)¿•/Ñú˜\Á?@´$≤≤\‰)¿]à\’a\Ë?@6l±\€\Á)¿ôÚ!®\Z\È?@™õãø\Ì\È)¿ £aQ\È?@GÆõR^\Î)¿J¥\‰Ò\Ë?@4iSuè\Ï)¿Éh≠hs\Ë?@2\Á˚í\Ì)¿\Z\·\ÌA\Ë?@\”˘,A\Ó)¿l\Ã\ÎàC\Ê?@\ÃoB)¿\œéYˆ\‰?@SX©†¢Ú)¿÷é\‚u\‰?@T8ÇTäı)¿\»a0Ö\‰?@h]£\Â@˜)¿ˇ<\r$\Â?@p|\Ìô%˘)¿æ.\√∫\Â?@Fïa\‹\r˙)¿40Ú≤&\Ê?@øôò.\ƒ˙)¿m\≈˛≤{\Ê?@]P\ﬂ2ß˚)¿&™∑∂\Ê?@<¡˛\Î\‹¸)¿˛∏˝Ú\…\Ê?@fffff˛)¿Q1\ŒﬂÑ\Ê?@Æü˛≥\Êˇ)¿´\ÎPMI\Ê?@Å\–z¯2*¿ıÇOs\Ê?@Äbd\…*¿6\\ê-\Á?@Ifı∑*¿íó5±¿\Á?@ê¿~˛*¿\”l#û\Ë?@DkEõ\„*¿ú1\Ã	\⁄\Ë?@{‹∑Z\'*¿HõV\n\È?@\›zM*¿?\ƒ\'\È?@ã6«πM*¿Ä∏´W\È?@˙}ˇ\Ê\≈	*¿®\√\n∑|\Ë?@è\Èå*¿^\’Y-∞\Á?@mÆö\Áà*¿\\W\Ã\Á?@\‘\—q5≤*¿ìE\÷\Z\Ê?@cÄD(\n*¿π\ZŸïñ\Â?@\Ïø\ŒMõ	*¿@ˆz˜\«\„?@œü6™\”	*¿j\”L˜\‚?@¨´µ*¿QN¥´ê\‚?@`V(\“˝*¿¸åB\‚?@t\Í\ gy*¿±˙#\‚?@¢_[?˝*¿J\ÌE¥\·?@†\‚8j*¿î.˝KR\·?@Síu8∫*¿øFí \‡?@a4+€á*¿à.®oô\ﬂ?@º≠Ù\⁄l*¿Ü\»\È\Î˘\ﬁ?@IIC´*¿y\\Tãà\ﬁ?@˚ªa\€*¿ã§\›\Ëc\ﬁ?@9ùd´\À*¿˙{)<h\ﬁ?@Ú\Í≤*¿-œÉª≥\ﬁ?@a˙^Cp*¿K´!qè\›?@Ç\ƒv˜\0\r*¿ßvÜ©-\›?@oJy≠Ñ*¿∂É˚\‹?@Iÿ∑ìà*¿í∞o\'\›?@¿=œü6*¿|F\"4Ç\›?@+j0*¿ÿõíì\›?@\ƒ\È$[]*¿µ˙\Í™@\›?@\‰,\Ïiá*¿â/Ç\∆\‹?@∏;k∑]*¿+\⁄\Á6\Ÿ?@mt\ŒOq*¿≥\Ì¥5\"\ÿ?@¥W}*¿\œ:Ø±\◊?@lZ)r!*¿îôÄ_\◊?@\Í%\∆2˝\"*¿B\Ó\"LQ\÷?@hÆ\”HK%*¿∂\÷	m\’?@0du´\Á$*¿â\”I∂∫\‘?@ı\"r$*¿\≈Y5\—\”?@a8\◊0C#*¿\√ÛR±1\”?@äì˚ä\"*¿\«Hˆ5\œ?@\Ó\Ï+\“#*¿¯\„ˆ\À\'\œ?@n⁄å\”%*¿û?mTß\œ?@P6\Â\n\Ô2*¿v\‡ú•\Õ?@2Y\‹d2*¿èß\ÂÆ\ ?@ï\Ôâ\–0*¿\‚\ \Ÿ;£\…?@\“V%ë}0*¿úlw\»?@v≈åˆ0*¿%]3˘f\«?@Òd732*¿®REÒ\∆?@\Ê \ËhU3*¿y¢\'e\∆?@%\Õ\”\⁄4*¿]2éë\Ï\≈?@\ﬁ>´Ãî6*¿£[Ø\ÈA\≈?@∏u7Ou8*¿#æ≥^\ƒ?@pîº:\«8*¿\Í\È#á\√?@ç∏\04J7*¿£è˘Ä@\√?@´Z\“Q6*¿¿í´X¸\¬?@â|óRó4*¿øôò.\ƒ\¬?@Dj\⁄\≈43*¿\Í Øì\¬?@Æ†iâï1*¿u∞˛\œa\¬?@\◊\‹\—/*¿r2q´ \¬?@˛“¢>\…-*¿}\"OíÆ¡?@ó©IÜ,*¿ˆ%∂¿?@ß\Ã\Õ7¢+*¿‹∑Z\'.ø?@ó\„àû,*¿\Ì\ræ0ôæ?@˝/◊¢-*¿<\⁄8b-æ?@i\Z\Õ0*¿D˝.lÕæ?@™(^em3*¿W	á3ø?@	4\ÿ\‘y4*¿πﬂ°(–ø?@‹Å:\Â\—5*¿\Ó&¯¶\Èø?@\∆˙&7*¿*\»\œFÆø?@5(ö∞8*¿l>Æ\rø?@7qrøC9*¿ï|\Ï.Pæ?@H\≈ˇQ9*¿ﬂà\ÓY◊º?@\Ë£\Á:*¿3˘fõª?@ˇ\Ê≈âØ>*¿¡\‚p\ÊWª?@\’>è@*¿	\¬P®ª?@\ﬂ\·vhXD*¿5”ΩN\Íª?@$∂ª\ËF*¿øE\'K≠ª?@\·E_AöI*¿$π¸áÙª?@~SX©†J*¿2øFíº?@`?\ƒO*¿36t≥?º?@cAJP*¿¯ßTâ≤ª?@Eı\÷¿VQ*¿,∑¥\Zª?@\npUR*¿ñB ó8∫?@ß#Äõ\≈S*¿@7nπ?@ë+ı,U*¿ª,Dá∏?@]lZ)Z*¿F\Î®jÇ∏?@îMπ\¬[*¿ù\œd∏?@+˙C3O^*¿1–µ/∏?@:í\ÀH_*¿jlØΩ∑?@\€¡à}`*¿ZÙP€∂?@Å≥î,\'a*¿º\ÀE|\'∂?@›ó3\€b*¿yGsdµ?@oeâ\Œ2c*¿Ùáfû\\≥?@ı-s∫,f*¿%W@°≤?@8kæ*g*¿8æˆÃí∞?@*\∆˘õh*¿(väUØ?@I0\’\ÃZj*¿\"HõÆ?@\‚\ \Ÿk*¿]¬°∑x¨?@K¨åF>o*¿xG\∆jÛ´?@9\÷\≈m4p*¿\'\‹+ÛV©?@ú≈ãÖ!r*¿≥%´\"®?@ì¨\√\—Ur*¿Àú.ãâ•?@§QÅìmx*¿˝/◊¢•?@P:ë`™y*¿B\Ã%U€•?@qÃ≤\'Å}*¿¥\ Li˝•?@∑–ïT*¿\ lêIF¶?@\ÏK6lÅ*¿≠i\ﬁqä¶?@\≈\ h\‰ÛÇ*¿\‹gïô“¶?@É¢y\0ãÑ*¿≠jIß?@\”\◊¯LÜ*¿ß>êºß?@Òc\Ã]Kà*¿¸d®?@\ÿóqã*¿^Å\ËIô®?@°Û\ZªDç*¿∑C\√b®?@Y0ÒGQè*¿\Ï\‹®?@≤\’ÂîÄê*¿RπâZöß?@0\÷70πë*¿\\!¨\∆¶?@¯©*4ì*¿I\ÿ\’\‰•?@/¿>:uï*¿ÄGT®n¶?@\ÎÛê)ó*¿>[ß?@ì¶A\—<ò*¿\∆jÛˇ™ß?@óuXô*¿Ìöê\÷®?@\∆nüUfö*¿j\ﬁqäé®?@\“\«|@†õ*¿\‘M÷®?@OÂ¥ß\‰ú*¿≠5î⁄ã®?@à+gÔåû*¿ƒ∞√òÙß?@cbÛqm†*¿\≈q\‡\’rß?@PR`L°*¿¿u≈å¶?@`∑\Ó\Ê°*¿¡S»ïz¢?@∞VÌöê¶*¿∞\‰*£?@weÆ©*¿\≈_—≠£?@\¬¡\ﬁƒê¨*¿ÄÛ\Â§?@O\…9±áÆ*¿^\’Y-∞£?@(\‘\”G∞*¿ut\\ç\Ï¢?@.py¨±*¿^Háá0¢?@´\Ì&¯¶±*¿\»_Z\‘\'°?@˙\ÃYü≤*¿4ı∫E`†?@\œ,	PS≥*¿ˇØ:r§ü?@\Ë¿rÑ¥*¿{Nz\ﬂ¯û?@;\∆Gµ*¿Û!®\ZΩû?@J+á∂*¿…éç@ºû?@õsL∏*¿‘∑\Ã\Èû?@\‰ı`R|º*¿>@˜\ÂÃû?@˘ÑÏºçΩ*¿~åâû?@RôbÇæ*¿jà*¸û?@W\œI\Ôø*¿t@ˆ\Ìú?@mÚñ´ø*¿\Ïiáø&õ?@Sï∂∏∆ø*¿´ÆC5%ô?@¯P¢%èø*¿F\—Éï?@{iä\0ßø*¿/m8,\rî?@\'k\‘C4\¬*¿\nÉ2çí?@ÄF\È\“\«*¿Xç%¨çë?@\Ô\…\√B≠\…*¿¿\Í»ëŒê?@º<i\·\ *¿9{\⁄\·è?@\»\n~b\Ã*¿˝ky\Âzè?@Lâ$z\Õ*¿ )\"\√*é?@\∆\√{,\œ*¿&5¥ÿå?@ôd\‰,\Ï\—*¿QlMKå?@\ÔêbÄD\”*¿ø\ÓtÁâã?@Rùd=\’*¿§à´xã?@¡S»ïz\÷*¿ÄF\È“ã?@\·+Ÿ±\Ÿ*¿l\È\—TOä?@´an˜\⁄*¿\Õ√πÜâ?@l\‚u˝\⁄*¿u;˚ Éà?@Y¶_\"\ﬁ\⁄*¿Ä`éøá?@ø\”d\∆\€\⁄*¿åÖ!r˙Ü?@[∞T\⁄*¿]2éë\ÏÖ?@l>Æ\r\€*¿#Mº<Ö?@kFπ\€*¿D\ƒÕ©dÑ?@∫LMÇ7\‹*¿TT˝JÉ?@˛(\Í\Ã=\‹*¿H\ﬁ9î°Ç?@ÉÖì4\‹*¿d\Âó¡Å?@l≥±Û\‹*¿\—]gEÄ?@¥\Ê\«_Z\‹*¿ΩfæÉ?@π®\≈\‹*¿èr0õ\0?@®éUJ\œ\‹*¿˘\Ÿ\»uS~?@´^~ß\…\‹*¿ñ?\ﬂ,}?@±¢\”0\‹*¿!\Á˝|?@¡ˇV≤\€*¿\'2sÅ\À{?@J∏êGp\€*¿MI\÷\·\Ëz?@–∏p $\€*¿\„\‡\“1w?@:vP\Ÿ*¿≤æÅ…çv?@ç¥Tﬁé\ÿ*¿Û;Mfºu?@©˙ïŒá\◊*¿+mqç\œt?@DO §\÷*¿ÒGQg\Óq?@¶Cß\Á\›\ÿ*¿}\ÍX•Ùp?@∏\ÕTàG\⁄*¿Lç\–\œ\‘o?@\‘ÚWy\⁄*¿£=^Háo?@a2U0*\Ÿ*¿Qio?@„àµ¯\ÿ*¿W\ÓfÖn?@ƒóâ\"§\÷*¿I\÷\·\Ë*m?@Rêh\“*¿+\‹Úëîl?@\n±àa\œ*¿∂˜©*4l?@QhY˜è\Õ*¿><Kêl?@˙\’ ò\À*¿\∆o\n+l?@\ ¿-]\…*¿}\Ï.PRl?@\·Ò\Ì]É\∆*¿É˘+dÆl?@\“Iÿ∑\√*¿\»^\Ô˛l?@\"5\Ìbö¡*¿\Ô_{fm?@\Œ˛@πmø*¿Åq\Â\Ïm?@75\–|ŒΩ*¿\Ô;Ü\«~n?@*\Âµ∫ª*¿\Z˘º\‚©o?@\’@Û9w≥*¿~sı∏o?@\Èπ-∞*¿JV\’\Ào?@æˆÃí\0≠*¿\Ê\ËÒ{õn?@œ∫FÀÅ¶*¿¶F\Ëg\Ím?@∂ÜR{•*¿\’A^&m?@¸\ƒÙ£*¿1a4+\€k?@∂°búø°*¿0EH\›j?@˜@†*¿”§t{i?@\’ZòÖvû*¿r1\÷qh?@\Ó?2:ù*¿\Ì∏\·wg?@Û:\‚ê\rú*¿˜\Â\ÃvÖf?@\‰\‹HŸö*¿\·&£\ 0f?@øõnŸô*¿Pß<∫f?@¯\Ì∏\·ó*¿`<ÉÜ˛e?@i™\'Ûèñ*¿œºv\ﬂe?@ñy´ÆCï*¿Ωåbπ•e?@Z)râì*¿(~åπke?@\·ó˙ySë*¿0Û¸d?@Bìƒírè*¿‚±ü\≈Rd?@ÑıÛç*¿â\\pc?@u\Ãy∆æå*¿†\Z/\›$b?@\Õ˝/◊ä*¿±¸˘∂`a?@\“\„˜6˝â*¿§®3˜ê`?@ß≤(Ï¢à*¿o¿±_?@\‘-¨á*¿KUø^?@çÒaˆ≤Ö*¿vq\r\‡]?@\—\Èy7Ñ*¿\…VóS^?@\ﬂ¸ÜâÅ*¿÷çwG^?@/0+\È~*¿è˛ók\—^?@©\€\ŸW|*¿T9\Ì)9_?@Òd73˙y*¿∞\∆\Ÿt`?@[ÎãÑ∂t*¿:ï\0U`?@o∑$\Ïr*¿Ü!Y¿`?@X9\“p*¿∏\ ;a?@\‘b0m*¿YLl>Æa?@\»–±Éj*¿L5≥ñb?@\\\ËJ™g*¿)_\–Bb?@:x&4Id*¿¨ \Ó\Ía?@\Ó\Î¿9#b*¿Ø\Œ1 {a?@8†•+`*¿l\È\—TO^?@˙\–ı-[*¿.\‚;1\Î]?@>îh\…\„Y*¿∑&›ñ\»]?@Qº\ ⁄¶X*¿Ä,Dá¿]?@¡ë@ÉMU*¿ï\'vä]?@∫ˆÙR*¿\„\‚®\‹D]?@¡T3k)P*¿\ƒ†Q∫\\?@\‰I\“5ìO*¿ÆFv•e\\?@Én/iåN*¿\Ã_!se\\?@\Ê!S>M*¿‰ªî∫d\\?@ò¸O˛\ÓE*¿°\ÿ\nöñ\\?@≤Ä	‹∫C*¿r75\–\\?@›ó3\€B*¿ñ?\ﬂ,]?@J”†h@*¿S\\Uˆ]]?@d\Ë\ÿA%>*¿∂\÷	m]?@m©Éº<*¿\Ï¢ËÅè]?@sJ_9*¿oG8-x]?@±RAE\’7*¿õZ∂\÷]?@\Â}Õë5*¿\Ë25	\ﬁ\\?@†pvkô4*¿Òùòıb\\?@\“6˛De3*¿§ä\‚U\÷V?@KW∞çx\"*¿\ÿ.m8,Y?@ÜWí<\◊*¿!<\⁄8Z?@∆®k\Ì}\n*¿fNó\≈\ƒZ?@\…\Â?§ˇ)¿\Î˛±R?@\›\Í9\È}Û)¿%ë}êeI?@ÜØØu©\È)¿x\'ü??@ﬂâY/Ü\Í)¿.;\ƒ?l5?@Ù\Ô9)¿¨Ôéå-?@e\‚X*¿\Á¶\Õ8\r%?@Ωm¶B<*¿Æ∑\ÕTà?@	â¥ç?*¿MK¨åF?@\\\0qWˇ)¿\…Y\ÿ\”?@éø∑\È\Ô)¿;©/K;?@2∆á\Ÿ\Î)¿6\‰ü\ƒ˜>@\'3\ﬁVz\Â)¿tó\ƒY\Ì>@\◊j{\È)¿T\ƒ\È$[\Â>@é\Î\ﬂıô\€)¿œ†°Ç\€>@ˇ?Nò0\‚)¿ \Ï´\—>@Ä4f\›)¿\ƒ\"Ü\∆\»>@ux\„ß\—)¿-$`tyø>@wd¨6ˇ\«)¿W\nÅ\\\‚\ƒ>@@†3iSµ)¿´≤\Ôä\‡\√>@p∂π1=°)¿Ω©HÖ±Ω>@ÆÚ¬é)¿∑_>Y1º>@\…>»≤`z)¿çBíYΩ\√>@©2åªAl)¿?q\0˝\¬>@ \“o_V)¿ñ\Í^f∏>@vn⁄å\”P)¿:z¸ﬁ¶≥>@≤ü\≈R$?)¿1≥\œcî´>@oeâ\Œ23)¿\∆1í=B•>@M†àEC)¿w\⁄\Zåõ>@k∫û\Ë∫H)¿\\[%Xî>@u £a9)¿†7©0é>@»ô&l?))¿Ÿïñëí>@∂ilØ)¿Åí`é>@Ø\–\À\ÿ\0)¿ªîÑ>@˙}ˇ\Ê)¿Ym˛_u|>@G8-x\—˜(¿Qi{>@Ü:¨p\„(¿ï}Wˇ>@\”2R\Ô©\Ã(¿\ﬁ;jLàÅ>@N*\Zk∑(¿µo\ÓØ>@’Øt><£(¿9\'0ùv>@¥W}ó(¿fˆyåÚl>@Ã¥˝++ù(¿Äd:tzf>@¸ å(¿¸¥W[>@πƒëè(¿*≈é∆°R>@2¨\‚çÃÉ(¿Å	‹∫õG>@\„¸M(DÄ(¿\Àgy\‹=>@˘¢=^Hw(¿Ä\‘&N\Ó3>@\’=≤πjn(¿$~\≈\Z.*>@ó\…p<üi(¿£Àõ\√!>@ÑÅ\Á\ﬁ\√](¿*\„\ﬂg\\>@î.˝KRQ(¿\È*\›]g>@\€j\÷\ﬂ?(¿\‘`\ZÜè>@\"ã4Ò0(¿¡çî-\n>@fı∑C(¿˙\—p\ \‹¸=@\»_Z\‘\'(¿≠äpìQÒ=@U£Wî(¿˚¨2SZ\Á=@\\=\'Ωo(¿()∞\0\⁄=@ı¯\√\œ\'(¿«†B\Ÿ=@äë%s<(¿Ω´0\—=@§R\ÏhJ(¿\ƒxÕ´:\œ=@\“nÙ1H(¿ˆ\n\Ó\–=@º≠Ù\⁄lD(¿\n\ÿF\–=@G\Ëg\ÍuC(¿~Wˇ[\—=@]¬°∑x@(¿Üí…©ù\—=@Å\Ïı\Óè?(¿4Jó˛\—=@^ª\Ô>(¿0\‘aÖ[\“=@M-[\Îã<(¿˚\Ë‘ï\œ\“=@\”\⁄4∂\◊:(¿isú€Ñ\”=@ùÅëó59(¿¯˛\Ì\’\”=@ÄHø}8(¿Sv˙A]\‘=@\0≠˘Òó6(¿w;S\Ë\‘=@\Ê≤\—9?5(¿1\÷q¸\‘=@B&93(¿K\Á√≥\’=@¢ÒD\Á1(¿	2*\’=@\Ó^Óì£0(¿\÷\ZJ\ÌE\‘=@ø∑\È\œ.(¿\› µâ\”=@ñÈóà∑.(¿Ñ\Ÿñ\”=@%vmo∑,(¿ˇók\—\‘=@&ç\—:™*(¿\Ï\ÏÜm\”=@j¢\œG)(¿\ O™}:\“=@5\Ó\Õoò((¿^-wfÇ\—=@u=\—u\·\'(¿âóßs\—=@u∞˛\œa&(¿}Àú.ã\—=@ZGUD%(¿/£Xni\—=@;V)=\”#(¿¡oCå\◊\–=@a8\◊0C#(¿S<.™E\–=@´í\»>\»\"(¿`\…U,~\œ=@CêÉf\"(¿º\…o\—\…\Œ=@9F≤G®!(¿b\◊ˆvK\Œ=@\‚ÃØ\Ê\0!(¿\œ0µ•\Œ=@F\ÔT¿=(¿\Êì\√\’\Õ=@£\rß\Ã(¿é≤~31\Õ=@Õí\05µ(¿\⁄\0l@Ñ\Ã=@lÀÄ≥î(¿R`L\Ã=@\ ˚8ö#(¿oc≥#\’\À=@+Ω6+(¿\Œ¬ûv¯\À=@7p\Íî(¿\0tò//\Ã=@Z\ÿ\”(¿Ÿ∞¶≤(\Ã=@K\\«∏\‚(¿ù•Ω¡\À=@Y\¬\⁄;(¿%ÅïC\À=@ö\Ô\‡\'(¿Øx\Íë\À=@2:=\Ô(¿ut\\ç\Ï\ =@˝2W\r(¿8N\nÛ\À=@æ˙x\Ëª(¿\Í\‡fÒ\ =@x≥\Ô´\n(¿î•\÷˚ç\ =@\Õ√πÜ	(¿QfÉL2\ =@=µ˙\Í™(¿÷èMÚ#\ =@9\’ZòÖ(¿!ÆúΩ3\ =@Ç\Ês\Óv(¿ïa\‹\r¢\…=@3QÑ\‘\Ì(¿ò\‹(≤\÷\»=@Hk:!(¿Xc\'º\»=@\"¬ø\Z(¿\r\ﬁW\ÂB\…=@=\r$}(¿\\>íí\ =@\Ìù\—V%(¿äY/Ür\ =@;\‡∫bF\0(¿2rˆ¥\À=@\“S\‰q˚\'¿\«):í\À\À=@\r34û˙\'¿{1î\Ì\ =@fÖ\"\›˜\'¿\Ów(\nÙ\…=@%w\ÿDfˆ\'¿\€˜®ø^\…=@p\ÈòÛåı\'¿ê\ŸYÙN\…=@\«\ŸtpÛ\'¿Q.ç_x\…=@&\Z§\‡Ò\'¿ÚŒ°U\…=@ôbÇé\Ó\'¿ÆfùÒ}\…=@äY/Ür\Í\'¿@\ﬂ,\’\…=@F|\'fΩ\Ë\'¿ÚØ$y\ =@|\”Ù\Ÿ\Á\'¿àòN\Î\ =@†m5\Î\‰\'¿ÇV`\»\Í\ =@º±†0(\„\'¿Yk(µ\À=@\‘,\–\Óê\‚\'¿¡~˛{\Ã=@%ZÚx\‚\'¿\Œˇ´é\Õ=@*1	\‚\'¿π\ZŸïñ\Õ=@\◊¡¡\ﬁ\ƒ\‡\'¿æ¢[Ø\È\Õ=@¶Ä¥ˇ\ﬁ\'¿Åq\Â\Ï\Õ=@-$`ty\€\'¿Ûgö∞\Õ=@\€¡à}\⁄\'¿\"rl\Õ=@(a¶\Ì_\Ÿ\'¿\ÌÄ\Îä\Õ=@˛\”\r\ÿ\'¿eˇ<\r\Ã=@ä=¥è\‘\'¿kQL\ﬁ\Ã=@\Ó%ç\—:\“\'¿yÆ\Ô\√A\Œ=@\ﬂm\ﬁ8\—\'¿!í!\«\÷\œ=@]•ª\Îl\–\'¿´∞\‡Ç\–=@¢\Ÿ:8\–\'¿òQ,∑¥\“=@ΩS˜<\œ\'¿bûï¥\‚\”=@Ç\‚«òª\Œ\'¿Å\–z¯2\’=@\Í≥Æ+\Œ\'¿`\Â\–\"\€\’=@\—\À\ÿ\–\Õ\'¿Ku/3\ÿ=@üt\"¡\Ã\'¿ä\‡+\Ÿ=@˚uß;O\Ã\'¿O\Î6®˝\⁄=@}\È\Ì\œE\À\'¿MÜ\„˘\‹=@âÍ≠Å≠\ \'¿üs∑\Î•\›=@\€6åÇ\‡\…\'¿=`2\Âˇ=@ˇ>\„¬π\'¿Éâ?ä:?>@+¯mà°\'¿\—\Ê8∑	S>@¢DKOÉ\'¿Éˆ\Í\„q>@\Ã&¿∞<\'¿G≤Åtq>@⁄®N:\'¿0\ÿ\r\€q>@˜≥Bë6\'¿IÅ0ep>@\ƒxÕ´:3\'¿Sx\–\Ï∫o>@Ö¥∆†2\'¿ÉlYæ.o>@hì\√\'ù0\'¿)x\nπn>@5ñ∞6\∆.\'¿(—í\«\”n>@\ﬂ˛\\4d,\'¿§30Ú≤n>@\ﬂN\"¬ø(\'¿Æ\◊g\Œn>@||Bv\ﬁ&\'¿\ﬁ	äo>@\rraä\"\'¿ÚD\Á\·p>@\ÀK˛\'\'¿∞™^~ßq>@9Ú@dë\'¿% &\·Br>@p#eã§\'¿Ÿ∞¶≤(x>@\\\÷µ\'¿ø∑\È\œ~x>@ÜpÃ≤\'\'¿Y˜èÖ\Ëx>@9\÷\≈m4\0\'¿Ék\Ó\Ëy>@e¸˚åˇ&¿F	˙=z>@\ÏjÚî˝&¿\ÏO\‚s\'|>@\“6˛De˚&¿&\0ˇî*}>@y?nø|˙&¿\»zjı\’}>@W\Ão˙&¿MÜ\„˘Ä>@GUD\›˜&¿\Í∞\¬-Å>@5\nIfıˆ&¿gaO;¸Å>@\‰jdWZˆ&¿&‰ÉûÕÇ>@y∞\≈nüı&¿\›{∏‰∏É>@˛2Ù&¿\…w)u…Ñ>@k\r•ˆ\"Ú&¿wº\…oÖ>@ˇ	.V\‘&¿\‚∞4£Ü>@†m5\Î\Ï&¿«ü®lXá>@1AG´\Í&¿Ù˘(#.à>@Õ¨•Ä¥\Á&¿i„àµ¯à>@ÿÄq\Â\‰&¿\r\„n≠â>@¶~\ﬁT§\‚&¿\¬Ÿ≠eä>@\ÎT˘ûë\‡&¿\”k≥±ã>@îk\ndv\ﬁ&¿æ£∆Ñòã>@qÆaÜ\∆\€&¿íZ(ôå>@§ä\‚U\÷\Œ&¿Gç>@\œ¯æ∏T\Õ&¿1`\…U,é>@ï”ûís\ &¿¸\≈l…™ê>@\“:™ö \ &¿‘∂aì>@\Ë˘\”Fu\ &¿¢zk`´î>@(~åπk\…&¿\⁄9\Õ\Ìñ>@˜<⁄®\∆&¿p\"˙µıó>@ëao\ƒ&¿\√c?ã•ò>@\œg@Ω¡&¿\r¡q7ô>@¨\‚ç\Ã#ø&¿¯\‡µKö>@¿îÅª&¿\ÏNwûxö>@≠k¥\Ëπ&¿\"ƒï≥wö>@hÜ¨∂&¿w°πN#ô>@∫ÑCo±&¿QΩ¬ö>@\”k≥±´&¿Bìƒírõ>@4¢¥7¯™&¿¡T3k)ú>@N\–&áO™&¿\ﬁ8)\Ã{ú>@\¬hV∂©&¿˘ûëçú>@<°◊üƒß&¿ﬂ•\‘%\„ú>@`<ÉÜ¶&¿CV∏ù>@,Åîÿµ•&¿£ë\œ+ûû>@=Úœ•&¿',1607362055,1607362055,NULL,NULL),(7,'Northern',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\0ã\0\0JB\"m\„\√>@\"ú¡\ﬂg ¿5\Ó\Õoò\ƒ>@Ò\‘#\rnk ¿πˇ\»t\Ë\ƒ>@má¡¸m ¿qØ\Ã[u\≈>@c\Ô\≈\Ìq ¿y7R\∆>@\◊	m9w ¿¥ î˜q\»>@\ÏPMI÷Å ¿[\ÏˆY\…>@\÷\ÊˇUGÜ ¿L8Ù\À>@L\√1ç ¿\·ô\–$±\Ã>@¸™\\®¸ì ¿Lo.\Z\Œ>@—ì2©ô ¿(CUL•\œ>@≤º´0ü ¿+1\œJZ\—>@\Ô9∞§ ¿r1\÷q\ÿ>@±¶≤(\Ï∫ ¿ô+ÉjÉ\€>@Ù˙ì¯\‹¡ ¿0õ\0\√Ú\ﬂ>@àÅÆ}\Õ ¿W\"P˝É\‰>@\¬P®ß\◊ ¿I0\’\ÃZ\Ê>@ûí>\› ¿\◊ˆvKr\Ë>@mV}Æ∂\‚ ¿ÚöWuV\Î>@\ÀLi˝-\È ¿í$W@\Ì>@åjQL\Ó ¿\Õ˝/\◊˛>@6\\ê-!¿\Ï˚pê?@\·\–[<º!¿ı,\Â}?@/n£º-!¿¸ß(\n?@¨6ˇØ:2!¿≤Ò`ã\›?@\◊M)Øï8!¿{Ñö!U?@”ÉÇR¥:!¿\€¸ø\Í\»?@\ÁˇUGé<!¿z©ÿò\◊?@\ÂÚw\Ô@!¿\Ê\ËÒ?@\÷t=\—uA!¿Û;Mfº?@qˇë\È\–A!¿u?ß ??@\'˜;B!¿ú˙@Ú\Œ!?@r\ﬁˇ\«A!¿5óu$?@\râ{,}@!¿6\Â\n\Ôr%?@\Ï¯/@!¿ıª∞5\'?@\Î6®˝\÷>!¿∑ºTl(?@&ßvÜ©=!¿[z4’ì)?@0*©\–<!¿mêIF\Œ*?@|Û&\Z<!¿5”ΩN\Í+?@4ÙOp±:!¿åHZ\÷-?@Ù\ZªDı6!¿\ﬂ¡ˇV.?@\\Va3¿5!¿fNó\≈\ƒ.?@6sHj°4!¿.»ñ\Â\Î.?@\“S\‰q3!¿Ú¥¸¿U.?@VÒF.!¿\r•ˆ\"\⁄.?@A~6r\›,!¿\›\Ìziä0?@S\Õ\Á\‹-!¿ùL\‹*à1?@\"OíÆô,!¿x\Ó=\\2?@∏ [ñØ+!¿˚îc≤∏3?@@/‹π0*!¿\’\Õ\≈\ﬂˆ4?@\‰°\Ône)!¿\"3∏<6?@\—x\"àÛ(!¿AºÆ_∞7?@\ËÖ;F*!¿’∞\ﬂ\Î8?@˙Dû$]+!¿•˘cZõ:?@ûDÑ,!¿\”0|D<?@,πä\≈/!¿Xè˚V\Î<?@¨ˇsò//!¿í∞o\'=?@S<.™E,!¿¢`\∆¨=?@y]ø`7,!¿≠0}Ø!@?@ÉMùG\≈/!¿Xrã\ﬂ@?@ƒô_\Õ2!¿ˇ<\r$A?@>[{3!¿e5]OtA?@º\ÀE|\'6!¿¢∑xx\œA?@?¯˘7!¿^ëB?@;mç\∆9!¿\Z1≥\œcD?@æ0ô*=!¿Æ\ÎçZE?@t\Ô\·í\„>!¿ˆ\ÏπLMF?@*\„\ﬂg\\@!¿Àùô`8G?@\Œ›Æó¶@!¿ª(z\‡cH?@û\Î˚pê@!¿ Ò+\÷pI?@ö\“˙[@!¿äY/ÜrJ?@∑–ïT?!¿Ü∂ÉK?@\ÿdçzà>!¿\Œ¬ûv¯K?@\np=!¿|+\‘L?@rP\¬L;!¿˘gÒÅM?@,fÑ∑9!¿% &\·BN?@õé\0n7!¿J\'L5O?@Ω\∆.QΩ5!¿ÉR¥r/P?@;\»zj5!¿@¯P?@\Â`66!¿YQÉiR?@±Q\÷o&6!¿©;\ZS?@™d\0®\‚6!¿ı\Œn-S?@\‹x8!¿ë\—I\ÿS?@J`sû9!¿&©L1U?@hÕèø¥8!¿\Zã¶≥ìU?@\€\ﬂ\ŸΩ9!¿>?åV?@˚s—êÒ8!¿i\⁄V≥V?@,ü\Âyp7!¿*éØñW?@B$Cé≠7!¿˙∂`©.X?@¯\›t\À9!¿ÉP\ﬁ\«\—X?@\Zn¿\Áá9!¿∂\€.4\◊Y?@†n†¿;9!¿I-îLZ?@0Ω˝πh8!¿\»\œFÆõZ?@ ò£\«\Ô5!¿\Ëi¿ \È[?@Ö|–≥Y5!¿ò˚\‰(@\\?@7ãC4!¿}	^\\?@ö>;\‡∫2!¿%ï)\Ê \\?@ *çò\Ÿ/!¿\'\ﬁû¥\\?@ˆòHi.!¿\⁄\Ê\∆ÙÑ]?@5&\ƒ\\R-!¿∫∫c±M^?@∞∂-\ ,!¿˝Ò\÷˘_?@˛ú0a,!¿#2¨\‚ç`?@Û;Mfº-!¿L®\‡Ç`?@PQı+ù/!¿•-ÆÒô`?@ £aQ1!¿p∂π1=a?@Ë°∂\r3!¿ âvRb?@7ãC4!¿\nÉ2ç&c?@ïÒ\Ô36!¿âD°e\›c?@ÜúO;!¿∂1v\¬Kd?@ˇ[…é=!¿y7R∂d?@#Ü∆§?!¿¢öí¨\√e?@ £aQA!¿Òe¢©g?@\Ìª\"¯\ﬂB!¿^/M\‡h?@LnYC!¿\›zMj?@y;\¬i¡C!¿t\Ô\·í\„j?@ê¿~˛C!¿u=\—u\·k?@ådèP3D!¿:ì6m?@\‚w\”-;D!¿D¶|™n?@\–EC∆£D!¿P9&ã˚o?@d≤∏ˇ\»D!¿Àú.ãâq?@0du´\ÁD!¿™,\nª(r?@%$\“6˛D!¿˘∫ˇ\Èr?@Ç\·\\\√E!¿\‡.˚ußs?@î\ﬁ7æˆD!¿™\“\◊¯t?@)=\”KåE!¿\ﬁu6\‰üu?@\€\–wF!¿-!Ùlv?@tôöoH!¿¡ˇV≤cw?@,J	¡™J!¿ØyUgµx?@H7¬¢\"N!¿§ãM+y?@—îù~PO!¿™aø\'\÷y?@P\ËQ!¿ıg?RDz?@´ó\ﬂi2S!¿|⁄•\r{?@Ú]J]2V!¿|E∑^\”{?@,∏¿X!¿\Á≈âØv|?@ÊØêπZ!¿\‡Ió}?@\Â\Ïù\—V]!¿\⁄\‰I\'~?@}\Ê¨O9^!¿\∆¯0{\Ÿ~?@l\Ó\Ëπ^!¿˛\”\rÄ?@\Œn-ì\·`!¿\–EC∆£Ä?@\‹\ŸW§_!¿\'0ù÷Å?@õçïòg]!¿Àª\ÍÉ?@ÑÄ|	\\!¿\‹~˘d≈Ñ?@©¯ø#*\\!¿ö	Üs\rá?@+hZbe\\!¿;®\ƒuà?@∑\Î•)\\!¿l#ä?@Ø&OYM_!¿Ù\Ô9å?@ô)≠ø%`!¿Ω\∆.QΩç?@¿ZµkBb!¿|,}ËÇé?@^û\Œ•d!¿P\‰I\“5è?@∏ë≤E\“f!¿!sePmê?@∑e•Ii!¿∫ˆÙ¬ë?@(ÛèæIk!¿¸5Y£í?@\÷µ\¬Ùm!¿õq\Z¢\nì?@ΩU◊°ör!¿r3‹Äì?@\Â&jinu!¿Ò)\0\∆3î?@Œã_\Ìx!¿\"6X8Iì?@&åfe{!¿e8ûœÄí?@\¬1Àû~!¿k’Æ	ië?@EÒ*kõÇ!¿46<ë?@˘k∏»Ö!¿;˛ë?@ãq˛&ä!¿5\‘($ôë?@n\‡\‘)è!¿Æ.Òë?@2*Aí!¿êÙi˝ë?@¸´\«}´ï!¿S±1Ø#í?@é@ºÆ_ò!¿◊¢h[ë?@\‡ÿ≥\Á2ù!¿\„ˇé®Pë?@\’\Áj+ˆü!¿0Ñú˜ˇë?@(\Óxìﬂ¢!¿\0≠˘Òóí?@]ã†m•!¿&åfeì?@<O<g®!¿h[\Õ:\„ì?@\–#ÑG´!¿óÆ`Òî?@é::ÆFÆ!¿T\∆\› ñ?@\–|\Œ›ÆØ!¿ªó˚\‰(ò?@B\Î\·\ÀD±!¿\Ì)9\'ˆò?@ß>êº≥!¿Aúáòö?@ÖCoÒ∂!¿/Ü\»\Èõ?@Ò.Òù∏!¿Å\"1\Ïú?@¿îÅZ∫!¿\”k≥±ü?@ã\≈o\n+Ω!¿≤\÷Pj/¢?@zPPäVæ!¿-AF@Ö£?@*\„\ﬂg\\¿!¿\ﬂ\≈˚q˚•?@u\0\ƒ]Ω\¬!¿\Ê\Î2¸ßß?@ú§˘cZ\√!¿4Ü9Aõ®?@8Müp\≈!¿\÷8õé\0™?@\ﬂ¬∫Ò\Ó\»!¿°fH≈´?@\”3Ω\ƒX\Œ!¿≥±Û¨¨?@Û\Êp≠ˆ\–!¿]\‚\»ë≠?@ç_x%\…\”!¿D¶|™Æ?@\„\≈\¬9\’!¿p≥x±∞?@+˘\ÿ]†\‘!¿ù+J	¡≤?@¡\‰Fëµ\÷!¿M\”g¥?@d\ÈC\‘\◊!¿-z®µ?@üFè\÷!¿\Ó¥5\"∑?@|ù‘ó•\’!¿ˆ5C™∏?@¯\‡µK\÷!¿Ñ4f∫?@\’%\„\…\÷!¿1\'hì√ª?@tLhí\ÿ!¿\ne\·\ÎkΩ?@tò//¿\÷!¿\◊/\ÿ\r€æ?@RΩ¬Ç\”!¿ìT¶òÉ¿?@U•-ÆÒ\—!¿≠N\ŒP\‹¡?@º\Èñ\‚\œ!¿MÑ\rO\√?@\È\”*˙C\À!¿ΩqRò˜\ƒ?@!ÆúΩ3\ !¿YO≠æ\∆?@}?5^∫\…!¿≥_w∫Û\»?@P5z5@\…!¿xõ7N\n\À?@[?˝g\Õ\«!¿)\–\'Ú$\Õ?@c\ÓZB>\»!¿z\ƒËπÖ\Œ?@Ω\‡”úº\»!¿cFx{\“?@I+æ°\…!¿ \—äX\‘?@∆®k\Ì}\ !¿amåù\÷?@z6´>W\À!¿7¶\',Ò\‹?@xADj\⁄\Õ!¿n¯\›t\À\ﬁ?@5~\·ï$\œ!¿q9^Å\Ë\·?@˛Ò^µ2\—!¿:é\Z\‰?@ï|\Ï.P\“!¿T®n.˛\Ê?@±3Ö\Œk\‘!¿b°\÷4\Ô\Ë?@N\Ô\‚\’!¿Ec\Ì\Ôl\Î?@0Ú≤&\ÿ!¿ê\ŸYÙN\Ì?@´yé\»w\Ÿ!¿EΩåbÒ?@Éßê+ı\‹!¿îX\0Û?@ª\n)?©\ﬁ!¿ˆòHiÚ?@ﬁØ|∑\·!¿Æ†iâïÒ?@º\Á¿rÑ\‰!¿ôcyW=?@\Z¿[ A\È!¿\∆0\'hì\Ô?@üt\"¡\Ï!¿‘∂a\Ô?@ñ$\œı}!¿*™~•Û\Ì?@hx≥\ÔÛ!¿\È\Ô•†\Ì?@Ω\‰Úw˜!¿W\ÓfÖ\Ó?@ˆ\\¶&¡˚!¿\nıÙ?@©£\„jdˇ!¿\Â\r0Û?@#üW<ı\0\"¿T\Â{F\"?@IÇp\"¿∑\Î•)?@\Î¸\€eø\"¿‡Ω£∆Ñ?@[rP\n\"¿t—êÒ(Ò?@⁄é©ª≤\"¿7\∆Nx	Ú?@ à@£\"¿\ÂcwÅíÚ?@@Ω5_\r\"¿\Õ?˙&MÛ?@\ \Zıç\"¿\€$∂ªÛ?@\ﬂ5\ËKo\"¿√º«ô&Ù?@\„S\0åg\"¿`í\ sÙ?@ƒ¨C\"¿\n¯5íı?@FñÃ±º\"¿MHk:ı?@%\ÏjÚ\"¿VfJ\Îoı?@1C\„â \"¿\Ó%ç\—:ˆ?@Adë&\ﬁ\"¿üFèˆ?@^có®\ﬁ\Z\"¿Éâ?ä:˜?@\ﬂ\·vhX\"¿\È&1¨¯?@} y\ÁP\"¿=aâî˘?@u\Ê\"¿\Ôp;4,˙?@Ec\Ì\Ôl\"¿>+Nµ˙?@¢\Ÿ:8 \"¿Ω«ô&l˚?@¢\Ï-\Â|!\"¿\ƒ\Íè0¸?@Ñπ\›\À}\"\"¿S\"˝?@\Âd\‚VA$\"¿˛|[∞Tˇ?@bi\‡G5$\"¿\≈Sè4∏@@x\'ü#\"¿\√e6@@´B±l\"¿â\\p@@¶\–yç]\Z\"¿,\“S\‰@@Y0ÒGQ\"¿[ïDˆA\n@@¥Æ\—r†\"¿=+i\≈7@@¡\‰Fëµ\"¿v˘÷áı@@8§QÅì\"¿\’\'¢@@~´u\‚r\"¿<p\œÛ@@©\€\ŸW\"¿(\r5\nI@@8ªµLÜ\"¿(Ç8\'@@†4\‘($)\"¿ó\0¸S™@@\Èc> \–)\"¿L8Ù@@—ÆB\ O*\"¿2\√FY@@ å∑ï^+\"¿\'¯än@@ëao,\"¿IæHâ@@ˇA$Cé-\"¿’Æ	iç@@\◊/\ÿ\r\€.\"¿\€kA\Ôç@@L\√1\"¿∞\Âï\Îm@@\ŒR≤úÑ2\"¿\Ÿ[\ ˘b@@∑ô\nÒH4\"¿(-\\Va@@k{°Ä5\"¿9\rQÖ?@@á\ﬁ\‚\·=7\"¿u £@@kFπã8\"¿\ŸÉk\Ó@@ûï¥\‚:\"¿\Î\Âwö\Ã@@\0\Â\Ô\ﬁQ;\"¿Ú≥ë\Î¶@@*\ƒ#ÒÚ<\"¿5c\—tv@@©\–D\ÿ@\"¿ÇˇÇ@@w0bü\0B\"¿f\⁄˛ïï@@5\rä\ÊD\"¿\⁄Rê@@(N>E\"¿Ÿò\◊á@@\‡ˆâ\ÌF\"¿i\‰Ûäß@@˝˙!6XH\"¿@4Û\‰ö@@rjgò\⁄J\"¿\ËÖ;F@@!\Í>\0©M\"¿$a\ﬂN\"@@\n\⁄\‰IO\"¿˘\⁄3K@@:<ÑÒ\”P\"¿µP29µ@@&\Z§\‡)T\"¿Å\œ#Ñ@@N\“¸1≠U\"¿\"S>U@@hzâ±LW\"¿ª}Vô)@@\Î\√z£VX\"¿ ç\"k\r@@üêù∑±Y\"¿ÑIÒÒ	@@àFw;[\"¿\Ê>9\n@@(Ù˙ì¯\\\"¿\√§R\Ï@@•h\Â^\"¿ë`™ôµ@@uîÉ\Ÿ`\"¿75\–|@@ \Ï´a\"¿˘1\ÊÆ%@@ŸØ;\›yb\"¿æÖu\„@@` ê°c\"¿üêù@@Ll>Æ\re\"¿\ÍØWXp@@\ÿ*¡\‚pf\"¿¸èLáN@@µkBZch\"¿ì©ÇQI@@\\<º\Á¿j\"¿µ∆†B@@m\06 Bl\"¿¥Xä\‰+@@ú˙@Ún\"¿àÄC®R@@\Ë3†ﬁår\"¿\Zã¶≥ì@@ΩVBwIt\"¿g\Ì∂\Õ@@VGétv\"¿ìUn2@@˚≤¥Ssy\"¿œΩáK@@≥Õç\È	{\"¿çÄ\nGê@@∂ı\”\÷|\"¿¸\‚Rï∂@@u\»\Õp~\"¿d\Èb\”@@4wº\…\"¿•Ω¡&@@\Î9\È}\„É\"¿Ö|–≥Y@@ˇ$>wÇÖ\"¿8ákµá@@$\rnká\"¿|Û&\Z@@\⁄\0l@Ñà\"¿ïH¢óQ@@´ñtîÉâ\"¿Mg\'É£@@´]\“\Zã\"¿cÏÑó\‡@@∂J∞8å\"¿\‡ª\Õ@@û¥pYÖç\"¿Lk\”\ÿ^@@˝\r⁄´è\"¿ï-ív£@@êÑ};ë\"¿\Íy7@@\0ºviì\"¿v\ﬂ1<@@4û\‚<î\"¿ªE`¨o@@:WîÇï\"¿¡)\Õ@@±áˆ±Çó\"¿\Î\«&˘@@\‹{∏\‰ò\"¿gÄ≤e@@*™~•Ûô\"¿\‹\r¢µ¢@@EÇ©f÷ö\"¿º?\Z@@Ò,AF@ù\"¿9\’ZòÖ\Z@@ö¥©∫Gû\"¿sµ4∑\Z@@\\\„3\Ÿ?ü\"¿•¯¯Ñ\Ï\Z@@\"\‚\ÊT2†\"¿êkC\≈8@@dY0ÒG°\"¿X\0S@@ µâì£\"¿mW\ËÉe@@˛úÇ¸l§\"¿\‡V*®@@î0\”ˆØ§\"¿©/K;5@@\ƒ]Ωäå¶\"¿\€\›t@@\·\ÌA»ß\"¿\Ë¢!\„Q@@3˚<FyÆ\"¿ñ$\œı}@@ì7¿ÃØ\"¿K?™a@@ÆÄ∏´∑\"¿\"S>U@@Ñê/°∫\"¿?πnJ@@1[≤*¬Ω\"¿yY|@@\Ã\—\„˜æ\"¿ˆ(\\è\¬@@πS:Xˇø\"¿Ó∞â\Ã\\ @@o\rlï`¡\"¿§ˇ\ÂZ¥ @@Òd73\¬\"¿\‘+e\‚ @@((E+˜\¬\"¿]5\œ˘ @@\‹)¨ˇ\√\"¿9ô∏U!@@Ø_∞∂\≈\"¿\nIfı!@@0ôÚ!\»\"¿l≥±Û @@`ù∫\ \"¿\·\riT\‡ @@ñ?\ﬂ\Ã\"¿ˆ_\Á¶\Õ @@òüê\Õ\"¿\"¶DΩ @@Æö\Áà|\œ\"¿\Ô9∞ @@ﬁí∞´\—\"¿Jó˛%© @@\ﬂƒêúL\‘\"¿∑µÖ\Á• @@wÙø\\ã\÷\"¿ÒGT® @@µSsπ¡\ÿ\"¿†Y2\« @@\Œ\0d\À\⁄\"¿\Î™@-!@@\¬¡\ﬁƒê\‹\"¿tb\Ìc!@@&\≈\«\'d\ﬂ\"¿~T\√~!@@8æˆÃí\‡\"¿Å	‹∫õ!@@ZJñìP\‚\"¿\Êv/˜\…!@@õ.»ñ\Â\"¿˛F;n¯!@@od˘É\È\"¿?SØ[\"@@z6´>W\Î\"¿3•ı∑\"@@˝2W\Ì\"¿üàÇ!@@\–Ï∫∑\"Ò\"¿ù\ÿC˚X!@@¸˚åÚ\"¿\"T©\Ÿ!@@ü°ºèÛ\"¿Zˆ$∞9!@@\’\ÎÅ±ˆ\"¿HP¸s!@@Øñ;3¡¯\"¿Mˆ\œ”Ä!@@Q•f¥˙\"¿è®å!@@É˘+dÆ¸\"¿+\¬MFï!@@öwú¢##¿\⁄r.\≈!@@\‚\Í\0àª#¿Pß<∫\"@@IÑF∞q#¿?5^∫I\"@@(\'\⁄UH	#¿&é<Y\"@@ÿúÉg\n#¿¡ò2p\"@@û\\S ≥#¿¯ßTâ\"@@8ákµá\r#¿qqTn¢\"@@$}ZE#¿ \nfL¡\"@@[≥\–\Œ#¿@¢C\‡\"@@Hqh#¿\Âú\ÿC˚\"@@P\ƒ\"Ü#¿F{ºê#@@=÷år#¿˝l\‰∫)#@@æÖu\„\›#¿¸S™D#@@yˆ—©#¿7ﬂà\ÓY#@@\nÉ2#¿n¬Ω2o#@@˜ôù#¿pòhêÇ#@@ã\¬.ä #¿2;ã\ﬁ#@@ÖòK™∂##¿\œ\œ\Ÿ$@@ºx?nø$#¿\"R\”.$@@d:tz\ﬁ%#¿kcÏÑó$@@\À\◊e¯O\'#¿ßZ≥\–$@@ó∏\ (#¿]¿\À%@@F\Ï@)#¿3mˇ\ J%@@û\–\ÎO*#¿Ùp\”i%@@\ÿc\"•\Ÿ,#¿¨Zd%@@M\‡Ù..#¿S≥ZÅ%@@\Ó<00#¿s\◊Ú\'@@æ-X™8#¿ƒØX\√E(@@\„p\ÊWs8#¿h+¯m(@@øÄ^∏s9#¿Ú(ïÑ(@@W¥9\Œm:#¿%<°◊ü(@@∏Œø]ˆ;#¿¶ÚvÑ\”(@@èR	O\Ë=#¿r5≤+-)@@YjΩ\ﬂh?#¿\ZÑd)@@k\ÔSUh@#¿˛G¶Cß)@@\ÿI}Y\⁄A#¿IüV\—)@@ö≤\”\ÍB#¿\¬N±j*@@∂LÜ\„˘D#¿∑\”÷à`*@@<ÉÜ˛	F#¿e\‡ÄñÆ*@@qé::ÆF#¿4\÷˛\Œˆ*@@\nΩ˛$>G#¿˝1≠Mc+@@ü ±\›=H#¿àÖZ”º+@@\‘+e\‚H#¿\ÿ+,∏,@@†®lXSI#¿Æc\\qq,@@/æhèJ#¿Iÿ∑ìà,@@Làπ§jK#¿˚7/N,@@\›\”\’ãM#¿\⁄;£≠J,@@Ö\œ\÷¡¡N#¿\È&1¨,@@¥Xä\‰+Q#¿∫\€ı\“-@@bhurÜR#¿†‹∂\ÔQ-@@_9\ÔˇS#¿O\À\\-@@ôJ?\·\ÏV#¿\∆˝G¶C-@@¡éˇAX#¿*\÷T-@@=1XY#¿8†•+\ÿ,@@Äcœû[#¿Síu8∫,@@\œg@Ω]#¿SÕ¨•,@@æ•ú/ˆ^#¿\Âöôù+@@1ñÈóào#¿Æπ£+@@}Àú.ãq#¿\”i\›µ+@@\ÂùC™r#¿*6\Êu\ƒ+@@¿\Áá\¬s#¿2∆á\Ÿ+@@•\€π\‡t#¿.\À\◊e¯+@@∞VÌöêv#¿9ú˘\’,@@∂†˜\∆x#¿&7ä¨5,@@¶\‘%\„y#¿ë\'I\◊L,@@ﬂ¶?˚ëz#¿ù\œd,@@x\—Wêf|#¿w£è˘Ä,@@,ûz§¡}#¿Æ†iâï+@@©ÿò\◊#¿.ç_x%+@@hXå∫\÷~#¿º≥v€Ö*@@\Ï†\◊1~#¿∂üåÒ)@@,\ÿF<\Ÿ}#¿Ü1zn)@@j†˘úª}#¿\»`≈©\÷(@@é\Á3†~#¿à\Ï¯/(@@\Ïl\»?3Ä#¿\÷t=\—u\'@@ú\ƒ ∞rÄ#¿=∫\'@@ \‘E\neÅ#¿∆ß\0\œ&@@§ß\»!Ç#¿:\œÿól&@@\œ˜S„•É#¿\‰M~ãN&@@(õrÖ#¿nnLOX&@@\’\ÎÅ±Ü#¿á3øö&@@˜s\nÚ≥â#¿\'â%\Â\Ó%@@≤Û66ã#¿Kw\◊Ÿê%@@\ \Zıçé#¿öñX%@@\÷\≈m4Äè#¿\Zàe3á$@@éíW\Áê#¿˘*$@@Aúáê#¿xôa£¨#@@\≈\‰\rê#¿dZõ\∆ˆ\"@@$\ÌFÛë#¿§à´\"@@ÉßZì#¿\Á\ﬂ.˚u!@@\⁄8b->ï#¿ C\«*!@@\nj¯÷ï#¿-	PS\À @@k*ã¬ñ#¿ä\Õ«µ° @@S≤úÑ“ó#¿*:í\À @@ûú˙ò#¿g,ö\ŒN @@\—?¡≈äö#¿\È\◊\÷Oˇ@@\nª(z\‡õ#¿\–}9≥@@X}wõ#¿Yá£´t@@\◊l\Â%ˇõ#¿\◊¿V	@@∫\Ÿ(∑ù#¿íÎ¶î\◊@@ÒπÏøû#¿\Z\¬1Àû@@ùFZ*oü#¿U\¬z˝@@\«.QΩ5†#¿kÚî\’t@@ªbFx{†#¿\'.\«+@@NCT\·œ†#¿E∑^”É@@\ÿc\"•°#¿#ÑGG@@v¸¢#¿å\⁄˝*¿@@i˛ò÷¶°#¿P\‰I\“5@@Dá¿ë@£#¿Çëó5±\Z@@MåJ\Í§#¿ÛtÆ(%\Z@@óé9ß#¿Ù£·îπ@@\'\⁄UH˘©#¿µ∆†B@@ë|%ê´#¿\ÊÁÜ¶\Ï@@3˛}∆Ö´#¿†\ﬂ˜o^@@E,b\ÿa¨#¿\r\≈oÚ@@®©ek≠#¿\ﬂnI\ÿ@@62;ãÆ#¿EKO\À@@˛&\"\‡∞#¿\‘>\Õ\…@@Ñú˜ˇq≤#¿â@£t@@©OráM¥#¿ù{h@@AÚŒ°µ#¿øG˝ı\n@@ª∏ç∂#¿	2*@@z4’ì˘∑#¿4ú27@@é*çòπ#¿\–\’V\Ï/@@oº;2Vª#¿\ËO\’\È@@_%ªº#¿+mqç\œ@@¨\ƒ<+iΩ#¿Å\–z¯2@@\Í¥nÉ⁄ø#¿±6\∆Nx@@\»\ÌóOV\ƒ#¿c+hZb@@πS:Xˇ\«#¿≥ôCR@@Ö@.q\‰\…#¿ákµáΩ@@©æÛã\ #¿pxADj@@\⁄\«\n~\À#¿˝LΩn@@*ènÑE\Õ#¿%´\Í\Â@@ãﬁ©Ä{\Œ#¿ê¡äS≠@@x\–\œ#¿ß$\Îpt@@Ø?âœù\–#¿Ògx≥@@\Ì\ræ0ô\“#¿A~6r\›@@S\Ííqå\‘#¿Àû6\Á@@4ºYÉ˜\’#¿\…&p\Î@@	SîK\„\◊#¿E|V@@ó®\ﬁ\Z\ÿ\⁄#¿πéq\≈\≈@@œΩáKé\€#¿7n1?@@Ωs(CU\‹#¿Ω\√\Ì–∞@@]˙ó§2\›#¿\’=≤πj@@&äê∫ù\›#¿˘\⁄3K@@âC6ê.\ﬁ#¿p]1#º@@\“\Ó#∑\ﬁ#¿npñí@@ò\‡\‘í\ﬂ#¿AÇ\‚«ò@@\◊\⁄˚T\‚#¿\»–±@@t\\ç\ÏJ\„#¿\Á\«_Z\‘@@lMK¨\‰#¿[≥\–\Œ@@öœπ\€\Â#¿∫/g∂@@ûòıb(\Á#¿ÖòK™∂@@\ÃC¶|\Ë#¿\…ˇ\‰\Ô\ﬁ@@\‰àûî\È#¿\–\“l#@@sÒ∑=A\Í#¿⁄íUn@@π4~\·ï\Ï#¿ºêa@@H\Z\‹\÷\Ó#¿`\‰eM,@@0\’\ÃZ\n#¿)x\nπR@@õ\„\‹&\‹Û#¿óã¯N\Ã@@p\ÓØ˜ı#¿πåõ\Zh@@¥Ñ\÷\√˜#¿û≤öÆ\'@@Ø≥!ˇ\Ã¯#¿\√c\“\ﬂ@@ˇy\Z0H˙#¿c{-\ËΩ@@L8†•˚#¿Øô|≥\Õ@@~˛{\⁄˝#¿\Â|±˜\‚@@∫1=aâˇ#¿K´!qè@@Âπæ$¿-¥sö@@\≈\…˝E$¿∂Ω›í@@˛õ\'æ$¿ˆb(\'\⁄@@ö\'\◊\»$¿\”/où@@P6\Â\n$¿r›îÚZ@@\…rJ_$¿íìâ[@@Q0c\n\÷$¿\0VGét@@a\√\”+e	$¿Tq\„Û\r@@}\\*\∆	$¿§´twù\r@@VE∏…®\n$¿F\Ï@\r@@4Ö\Œk\Ï\n$¿ã4Ò@@Ku/$¿mscz\¬@@ÇUıÚ$¿.\…ªö@@°g≥\Ís\r$¿ˆòHi@@àW\Œ$¿\\9{g¥@@´\œ\’V\Ï$¿x\„ßq@@3¸ß($¿≥|]Üˇ\n@@ä\Ã\\\‡Ú$¿M÷®á\n@@\…!\‚\ÊT$¿e\ZM.\n@@\r4üs∑$¿¬â\Ë\◊\÷	@@\›ŒæÚ $¿¸˝b∂d	@@’±J\Èô$¿9BÚ\Ï@@m8,\r¸$¿ØΩ7Ü@@O\À\\\Â$¿ä¨5î\⁄@@ï\0U\‹$¿Ñ”Ç}@@{/æhè$¿MΩn@@êÉf\⁄$¿t_\ŒlW@@†¶ñ≠ı$¿∫ˆÙ\¬@@S\"â^$¿Yß\ ˜å@@h[\Õ:$¿ßx\\Tã@@&7ä¨$¿õ ¢∞ã@@@ø\Ôﬂº $¿ y\ÁPÜ@@X7\ﬁ#$¿.rOWw@@+j0%$¿I0\’\ÃZ@@úQ}&$¿U£W@@\ﬁ\∆fG™\'$¿\”MbX@@y≠Ñ\Óí($¿\…qßt∞@@çúÖ=\Ì($¿Gw;S@@ñ=	l\Œ)$¿\÷\·\Ë*\›@@\'JB\"m+$¿IÄöZ∂\0@@&4I,)/$¿úäT[\0@@>v()0$¿\’=≤πj\0@@ßöœπ3$¿†ﬁåöØ\0@@µ®Orá5$¿\"¶DΩ\0@@¨ã\€h\07$¿Gv•e§\0@@ì\‡\riT8$¿\Z1≥\œc\0@@b.\‰9$¿Ve\ﬂ¡ˇ?@ûy9\Ïæ;$¿vß;O<ˇ?@â\ÏÉ,>$¿±0DN_ˇ?@e√ö ¢@$¿=)ì\Z\0@@wı*B$¿\ÿF<\Ÿ\Õ\0@@¨q6D$¿4-±2\Z@@Ä\◊g\Œ˙D$¿MÇ7§Q@@ê†¯1\ÊF$¿n\›\ÕS@@å\÷Q\’I$¿\‘\Ô\¬\÷l@@z™CnÜK$¿@˜\Â\Ãv@@¢µ¢\ÕqN$¿ºìOèm@@≤\⁄¸ø\ÍP$¿\‘\rx\'@@˘\⁄3KT$¿\‡G5\Ï˜\0@@ÿ∫\‘˝T$¿µ\ﬂ⁄â\0@@ä\‰+ÅîX$¿µ•Úz\0@@∞é\„áJ[$¿åi¶{ù\0@@;±O\0]$¿ÉæÙˆ\Á\0@@ñØ\Àü^$¿Øx\Íë@@¡\‡ö;˙_$¿C´ì3@@©æÛãb$¿#\Ÿ#\‘@@@ø\Ô\ﬂd$¿8>[@@oÑEEúf$¿\0{ˆ\0@@M÷®áh$¿üıf\‘\0@@•˜çØ=k$¿\Œ˙îc≤\0@@\—vL\›m$¿Äª\Ï◊ù\0@@8-x\—Wp$¿\„¡ª}\0@@Åí`r$¿5¥;§\0@@å+.é\ u$¿QàÄC®\0@@õsLx$¿ÇUıÚˇ?@\Õ?˙&M{$¿˜:©/Kˇ?@ô∑\Í:T{$¿\’%\„\…˛?@ØD†˙y$¿ùÛS˛?@\»xîJxz$¿oıúÙæ˝?@•N@a{$¿y\Âz\€L˝?@ùfÅvá|$¿väUÉ¸?@¯\√\œ~$¿!ÆúΩ˚?@(∑\Ì{\‘$¿EùπáÑ˚?@°L£\…≈Ä$¿Æ‘≥ î˚?@≠àö\ËÛÅ$¿è™&à∫˚?@ã˘π°)É$¿5_%ª˚?@Q˜HÖ$¿\ÍÕ®˘˙?@Ñõå*√à$¿\Í\–\Èy7˙?@\0Q°∫â$¿)=\”Kå˘?@ò˘~ä$¿\‡G5\Ï˜¯?@à¬£çã$¿\‚ !\ ¯?@Qª_¯é$¿jlØΩ˜?@#áàõSë$¿\—\Ëb˜?@\Ê\Ê\—=ì$¿!î˜q4˜?@7n1?7î$¿A\÷S´Øˆ?@W[±ø\Ïñ$¿√Åê,`ˆ?@¯4\'/2ô$¿uYLl>ˆ?@∑A\Ì∑vö$¿]QJVı?@àù)t^õ$¿ñ[Z\râÛ?@\‘($ô’õ$¿xÄ\'-\\Ú?@ˇ\Ã >∞õ$¿ç\–\œ\‘\Î\Ó?@h!£Àõ$¿\›\—ˇr-\Ó?@æ˙xËªõ$¿¯Ac&\Ì?@“™ñtîõ$¿õÆ\'∫.\Ï?@Ù5\Àe£õ$¿gû\\S \Î?@Å\ÍD2ú$¿Òª\Èñ\Í?@\Îo	¿?ù$¿r˙zæf\È?@®ä©Ùû$¿†ö≤\”\Á?@´ˆòH°$¿Z\÷˝c\Â?@dyW=`¶$¿3\ﬂ¡O\‰?@∏\"1A\rß$¿óXç|\‚?@\›^\“•$¿°¯1\ÊÆ\·?@ûí>•$¿ëa¸\‡?@s.\≈Ueß$¿aTR\'†\›?@\›A\ÏL°´$¿x\’\Ê!\€?@oeâ\Œ2≥$¿\‡º8Ò\’\⁄?@{2ˇËõ¥$¿\€\–w\⁄?@Õ´:´∂$¿=,‘ö\Ê\Ÿ?@HßÆ|ñ∑$¿“´JC\Ÿ?@\Óî\÷ˇπ$¿\Ô\„hé¨\ÿ?@≤∏ˇ\»t¿$¿≤†0(\”\ÿ?@Ø\ÓXlì\¬$¿\0©Mú\‹\◊?@\√g\Î\‡`\«$¿Kw\◊Ÿê\◊?@ÛZ	\›%\…$¿ïú{h\◊?@shë\Ì|\œ$¿vQÙ¿\◊?@a˛\nô+\”$¿óqS\Õ\◊?@á\›wè\’$¿\Ÿx∞\≈n\◊?@˘HJz\⁄$¿rjgò\⁄\÷?@vkô\«\€$¿µ˚\À\Ó\’?@Z*oG8\›$¿\“\»\ÁO\’?@ß\ÊrÉ°\ﬁ$¿w-!Ù\‘?@\Î»ë\Œ¿\‡$¿˚&7ä\‘?@∞bÉÖ\„$¿Zd;\ﬂ\”?@éW zR\Ê$¿ó«öë\—?@û	MK\Í$¿C,cC\œ?@≤Ä	‹∫\Î$¿\œMõq\Z\Œ?@\'K≠˜\Ì$¿Ö8Ñ*\Õ?@≤\r‹Å:\Ì$¿	»≥\À\À?@˜\‰a°\÷\Ï$¿°∫π¯\€\ ?@Æ\”HK\Â\Ì$¿\≈rK´\…?@~¨\‡∑!\Ó$¿˜\«{\’\ \»?@\—\ÎO\‚s\Ô$¿\’zø—é\«?@2t\Ï$¿X9¥\»\∆?@S\"â^FÒ$¿öû^\≈?@£s~ä\„$¿sÇ69\ƒ?@4Jó˛%Ò$¿\Í%\∆2˝\¬?@¥íV|CÒ$¿oG8-x¡?@F\”\Ÿ\…\‡$¿ÆÒôÏüø?@{°Ä\Ì$¿`\»\ÍVœΩ?@\»`≈©\÷Ú$¿\"5\ÌböΩ?@Ç’∞\ﬂÛ$¿\ÍAA)ZΩ?@\”˘,Aˆ$¿Û =EΩ?@9{\⁄\·˜$¿Aãvº?@)\›^\“¯$¿s∫,&6ª?@\ÍuëB˘$¿àªzµ?@÷çwG˛$¿≠jI≥?@&S£%¿⁄≠e2≥?@#-ï∑#%¿˝ÉHÜ≥?@jkD0%¿/ÖÕ≤?@ƒì\›\Ã\Ë%¿\n∫Ω§1≤?@R<æΩ%¿L‚¨àö∞?@ü\Ê\‰E%¿π¸áÙ€Ø?@g∏ü%¿r4GV~≠?@IK\Â\Ì%¿<ö$ñ¨?@cz\¬%¿\Ïk]jÑ™?@Ä\‘&N\Ó%¿B#ÿ∏˛©?@à+g\Ôå%¿OÂ¥ß\‰®?@\råº¨â\r%¿©i\”Lß?@U3k) \r%¿+i\≈7¶?@D1y\Ã%¿?SØ[¢?@t±3Ö%¿	2*°?@¯ˆÆA%¿J	¡™zù?@°Üoa\›%¿ıΩÜ‡∏ú?@\—?¡≈ä%¿∫i3NCú?@]¿\À%¿m;mçö?@ˆB\€¡%¿\Á%\Ë/ò?@\È\∆%¿V\Ï1ëñ?@™aø\'\÷%¿™õãø\Ìï?@R~R\Ì%¿ZEh\Êï?@L˝º©H%¿Fô\r2…ê?@G\Ëg\Íu#%¿\ﬂ˚¥Wè?@ôºfæ#%¿Sweé?@w1\ÕtØ#%¿\Ï˚pêç?@¡≈ä\ZL#%¿&\≈\«\'å?@ä∞\·\Èï\"%¿˘ÉÅ\Áä?@∑Eô\r2!%¿æP¿v0ä?@∏Ø\Áå %¿\Ô\0OZà?@`\"\ﬁ:ˇ%¿6ZÙPá?@ıh™\'Û%¿\«-\ÊÁÜÜ?@v()∞ %¿ß\‘E\nÖ?@\ËKo.\"%¿˚Zó\Z°É?@G\Ã\ÏÛ%%¿`ÆE–Ç?@u \Î©\’\'%¿ú¯jGqÇ?@H\‚\Â\È\\)%¿.9\ÓîÇ?@VÑa¿*%¿	˝LΩnÅ?@ïF\Ã\Ï+%¿˝gÕèøÄ?@7®˝\÷N,%¿Ä∑@Ç\‚?@\√e6,%¿˙\'∏XQ?@.\ŒR≤,%¿eèP3§~?@\ÎrJ@L*%¿p(|∂~?@)\"\√*\ﬁ(%¿\‚\ \Ÿ;£}?@Æü˛≥\Ê\'%¿AIÅ0}?@z\ƒËπÖ&%¿ê2\‚\–|?@;\„˚\‚R%%¿H6W\Õs|?@\Ê!S>$%¿Qæ†Ö|?@Gtœ∫F#%¿á\ﬁ\‚\·={?@Òd73\"%¿±¯Ma•z?@´±Ñµ!%¿î†ø\–#z?@ıª∞5[!%¿P\·Ry?@¶Cß\Á\› %¿	kc\ÏÑw?@9\Óî\÷%¿.\Â|±˜v?@@OI%¿Dãl\Á˚u?@É}i%¿I\÷\·\Ë*u?@U˙	g∑%¿\⁄\ZåÉs?@bù*\ﬂ3\"%¿\Õ\ ˆ!s?@Ç\»\"Mº#%¿/O\ÁäRr?@¥≠fùÒ%%¿ºW≠Lp?@Zπò*%¿Æ+fÑo?@ñ\Ï\ÿ\ƒ+%¿öï\ÌC\ﬁn?@\Î5=((-%¿L5≥ñn?@z˝I|.%¿_”ÉÇRl?@ip[[0%¿ï\rk*k?@	√Ä%W1%¿˝Ùü5?j?@i\…\„i˘1%¿v4ıªh?@\”\⁄4∂\◊2%¿\·\n(\‘g?@àFw;3%¿F{ºêg?@û?mTß3%¿ÜØØu©e?@Y\‹d:4%¿\…6ëôc?@2\œg@5%¿Ò∏®a?@\ﬁ\∆fG™7%¿^\⁄pX\Z`?@ÒÙJYÜ8%¿\Íuã¿X_?@á6\09%¿ãnΩ¶]?@˙	g∑ñ9%¿r\Ã_![?@\Œ¡3°I:%¿T™D\Ÿ[Z?@âÍ≠Å≠:%¿UK:\ ¡X?@§p=\n\◊;%¿âyV“äW?@>Æ\r\„<%¿dêªST?@õ7N\nÛ>%¿cG\„PøS?@´>W[±?%¿GW\È\Ó:S?@\ÂZH¿@%¿Úñ´S?@EÉ<ÖD%¿ô+ÉjÉS?@û#Ω®E%¿¨´µT?@Öx$^ûF%¿\∆\·ÃØ\ÊT?@d;\ﬂOçG%¿[ú•dU?@·∏åõ\ZH%¿sePmpV?@6vâ\Í≠I%¿t\“˚\∆\◊V?@_Aö±hJ%¿5õ\«a0W?@˛Û\ﬂK%¿ò°ÒDW?@\ÕvÖ>XN%¿t\Ì\ËU?@¿O%¿V\’\À\Ô4U?@3o\’u®N%¿è\ﬂ\€ÙgS?@ÑıÛM%¿;Uæg$R?@\√fÄ≤M%¿Tt$óˇP?@mp\"˙µM%¿\0÷™]O?@üv¯k≤N%¿[\Õ:\„˚N?@´≤\Ôä\‡O%¿\"\·{ÉN?@<ø(AQ%¿y:WîN?@Ú\ÏÚ≠S%¿\‚[X7\ﬁM?@\\Uˆ]T%¿\√fÄ≤M?@í\\˛C˙U%¿QΩ5∞UN?@\‹Û¸i£Z%¿™∂õ\‡õN?@\”2R\Ô©\\%¿ÜTQº\ N?@øõn\Ÿ!^%¿;™ö \ÍN?@¥\„Ü\ﬂM_%¿™û\Ã?˙N?@ú\ƒ ∞r`%¿¿u≈åN?@ò4F\Î®b%¿µo\ÓØO?@j¶{ù\‘g%¿∏Z\'.\«O?@†˙ëi%¿c\—tv2P?@ü[\ËJj%¿\“\«|@†O?@3¿Ÿ≤l%¿wÙø\\ãN?@û(	â¥m%¿R\ÍíqL?@\›–îù~p%¿RΩ¬ÇK?@\Z®åüq%¿\ﬂ7æˆ\ÃJ?@2t\Ï†r%¿#K\ÊX\ﬁI?@ˇzÖ˜s%¿ï)\Ê \ËH?@\n+TTu%¿ü ±\›=H?@JµO\«cv%¿\„8jπG?@ííÜVw%¿fıÇOG?@à∏9ïx%¿˘jGqéF?@±k{ª%y%¿g\Ì∂\ÕE?@îm\‡\‘y%¿£\ 0\ÓE?@\«dqˇëy%¿\ﬁÑÄD?@˛\”\rx%¿©0∂D?@π˚-v%¿∑\Ì{\‘_C?@ç|^Ò\‘s%¿´@-C?@†Y2\«r%¿Iˆ5CB?@≠ó\„p%¿ôK˝ºA?@ñzÑÚn%¿Ω«ô&l??@Ú\ÏÚ≠o%¿ä!9ô∏=?@Cˇ+r%¿:ì6U˜<?@\0\Z•Kˇr%¿ó\“˛<?@t\–%zs%¿\Ë1\ 3/;?@\ÊZ¥\0ms%¿&p\Înû:?@oeâ\Œ2s%¿Sy;\¬i9?@Na•Çär%¿\“9?\≈q8?@ã¶≥ì¡q%¿t≥?Pn7?@=c_≤Òp%¿_\ÂDª6?@Ò1%íp%¿\Ó\Œ\⁄m6?@\—!p$p%¿IüV\—3?@\ƒ$\\\»#p%¿\…væü\Z3?@≠ó\„p%¿˙^Cp\\2?@•\›\Ëc>p%¿µ¿)1?@;˛q%¿-\'°ÙÖ0?@¬äS≠Öq%¿;s	\ﬂ/?@ôıb(\'r%¿’íér0/?@\‚\Õ\ZºØr%¿j1xò.?@{k`´s%¿\…ˇ\‰\Ô\ﬁ-?@ˆ\–>Vs%¿6\Ã\–x\",?@î§k&\ﬂt%¿àKé;•+?@≠P§˚9u%¿ò¿≠ªy*?@;\ﬂOçóv%¿óræ\ÿ{)?@\‰\⁄P1\Œw%¿…è¯k(?@77¶\',y%¿\Õ\Êq\Ã\'?@*1	z%¿S\È\'ú\›&?@ßí†ä{%¿Gsd\Âó%?@qX\Z¯Q}%¿2øFí$?@CV∑z~%¿à\◊ıv#?@Gsd\Â%¿/l\ÕV^\"?@AG´Z“Å%¿¢öí¨\√!?@æi˙ÏÄÉ%¿ë9∂û!?@\œÛßç\ÍÑ%¿πéq\≈\≈!?@obHN&Ü%¿£ì•\÷˚!?@ZürLá%¿I-îL\"?@î2©°\rà%¿Cq«õ¸\"?@ÉNtâ%¿PQı+ù#?@FC∆£Tä%¿§\‚ˇé®$?@Cå◊º™ã%¿\'3\ﬁVz%?@±3Ö\Œkå%¿yt#,*&?@˜Ãí\05ç%¿±\€gïô&?@6\ËKoé%¿≠\‹\Ã&?@ø÷•F\Ëè%¿\‡eÜç≤&?@S£í:ë%¿Àüoñ&?@3˛}∆Öì%¿\‡eÜç≤&?@\\ê-\À◊ï%¿Ú\ÏÚ≠\'?@\«,{ò%¿¡=~o\'?@∑ó4F\Îò%¿7l[î\Ÿ(?@≠1\ËÑ–ô%¿æ˜7hØ*?@¯\√\œó%¿f¿YJñ+?@V\r\¬\‹\Óï%¿ƒµ\⁄\√^,?@\Ëyíî%¿DioÖ-?@∑µÖÁ•í%¿iT\‡d/?@\Óß/í%¿o\Î0?@ä∞\·Èïí%¿æ0ô*1?@Î≠Å≠î%¿)%´\Í1?@y∞\≈nüï%¿ë∏\«“á2?@N_\œ\◊,ó%¿\…&p\Î2?@ó∏\ ò%¿[\Ô7\⁄q3?@ù/ˆ^|ô%¿®ã\ \¬3?@˛õ\'æö%¿∞\∆\Ÿt4?@p?\‡Åú%¿•\›\Ëc>4?@æˆÃí\0ù%¿ìér0õ4?@Lk\”ÿû%¿@M-[\Î3?@h%≠¯Ü¢%¿¢ñ\ÊV3?@\rˇ\È\n§%¿]¿\À1?@\∆6©h¨•%¿%vmo∑0?@f°ù”§%¿\›y\‚9[0?@¡s\Ô·í£%¿`±Üã\‹/?@IÇp¢%¿Ú}q©J/?@Çt±i•†%¿ù+J	¡.?@•û°ºü%¿j\€0\n.?@ÛvÑ”Çü%¿óëzO\Â,?@Ÿ≤|]Üü%¿FñÃ±º+?@P4`ëü%¿[ú•d)?@\—x\"àÛ†%¿Ùø\\ã(?@<Pß<∫°%¿\nΩ˛$>\'?@$Di¢%¿˚\Í™@-&?@Zc\–	°£%¿rn\Óï%?@\Z•Kˇí§%¿±1Ø#%?@1&˝Ω¶%¿˜;˙$?@•Çä™_©%¿éÖAô&?@\ƒ\—U∫ªÆ%¿N\r4üs\'?@Ò1%í∞%¿à\’a(?@™∏qã˘±%¿8§QÅì)?@üuçñµ%¿\¬\¬Iö?*?@\ËÖ;∂%¿õ7N\nÛ*?@`\"\ﬁ:ˇ∂%¿U2\0Tq+?@´>W[±∑%¿øeNó\≈,?@πT•-Æπ%¿F#üW<-?@Ee√ö ∫%¿M0úkò-?@t~ä\„¿ª%¿á®¬ü\·-?@9ºZ\Óº%¿;˛.?@˛c!:æ%¿ún\Ÿ!˛-?@81$\'ø%¿(Òπ\Ï+?@\—\À(ñ[\¬%¿ÆÛoó˝*?@\—;p\œ\√%¿…ØbÉ)?@ˆòHi\∆%¿L\√)?@\Ÿ[\ ˘b\«%¿ˆ&Ü(?@!\‰K®\»%¿¨ æ+Ç\'?@æ-X™\À%¿\Î™@-\'?@¶^∑å\Õ%¿>\Ã^∂ù&?@ö\Ô\‡\'\–%¿%ZÚx&?@ÆfùÒ}\—%¿=_≥\\6&?@\‘E\ne\·\”%¿\ÔU+~%?@%îær\÷%¿wIúQ#?@\Œ9x&4\Ÿ%¿oEbÇ\Z\"?@M,\›\⁄%¿¥≠fù!?@\ƒ	Lßu\€%¿|òΩl;!?@ÁãΩ_\‹%¿f-§˝?@π\04Jó\ﬁ%¿9GW?@S[\Í Ø\ﬂ%¿ µâì˚?@ÊØêπ\‚%¿!\ÕX4ù?@!£Àõ\„%¿#k$?@\rR\‰%¿3\›Î§æ?@K∞8ú˘\Â%¿É5Œ¶#?@F\ÔT¿=\Á%¿Ø$yÆ?@J∂∫ú\Ë%¿v\∆˜≈•\Z?@!ÆúΩ3\Í%¿›ó3\€\Z?@\÷\‰)´\È\Í%¿ä Ü5ï?@ã∑òü\Î%¿ù\’{L?@≥\Ó\—\È%¿cò¥\…?@÷™]\Í%¿ì\Z\⁄\0l?@◊à`\\\Í%¿ZKiˇ?@´]\“\Z\„%¿\⁄V≥\Œ?@¸\‚Rï∂\‡%¿ö±h:;?@§˝∞\ﬁ%¿?\·\Ï\÷2?@7¡7Mü\›%¿@ä:s?@Ÿ∞¶≤(\‹%¿iå\÷Q\’?@Æπ£ˇ\Â\⁄%¿7n1?7?@C\·≥up\ÿ%¿S	O\Ëı?@\‰,\Ïiá\◊%¿\ÀK˛\'?@og_yê\÷%¿]5\œ˘?@ˇ^\nö\’%¿É˘+d?@V\’\À\Ô\‘%¿sæ\ÿ{Ò?@~7›≤C\‘%¿ªÒ\Ó\»X?@§ã¶\”%¿(\ 4ö?@,cC7\”%¿]3˘fõ?@Ú}q©J\”%¿=ª|\Î\√?@\Ê\Â∞˚é\Ÿ%¿õ\„\‹&\‹?@˙π°);\Â%¿!\Œ\√	L?@ÑGG¨\Â%¿˛{⁄•	?@pz\Ô\«\Â%¿ö$ñîª?@î.´∞\·%¿n\€˜®ø?@ˇïï&•\‡%¿Y•ÙL/?@í>≠¢\ﬂ%¿™FØ?@JV\’\À\ﬂ%¿¨êÚìj?@ö∞»Ø\ﬂ%¿3o\’u®?@_D\€1u\ﬂ%¿ø\”d\∆\€?@˘÷áıF\›%¿\ﬁ…ß?@\Înû\Íê\€%¿†\‡bE\r?@}˛Û\◊%¿\’w~QÇ?@*V\r\¬\‹\÷%¿;%Ø?@&8ıÅ\‰\’%¿N∏W\Ê≠?@˛b∂dU\‘%¿b0Ö\Ã?@Uæg$B\”%¿§à´?@ıÇOsÚ\“%¿˙|î?@’íér0\”%¿\ƒxÕ´:?@¯˘\Ô¡\”%¿\Ï£SW?@\0!Æ\‘%¿ÄÚw\Ô®?@6\\ê\’%¿Aãv\0?@ì†ä\◊%¿mésõpˇ>@ƒòÙ˜R\ÿ%¿`∑\Ó\Ê˝>@#˜tu\«\⁄%¿µ\—vL˝>@lMK¨\‹%¿©Mú\‹\Ô¸>@\»\Ôm˙≥\ﬂ%¿l?\„\√¸>@G\ Iª\·%¿pw\÷nª¸>@\Êï\Îm3\Â%¿	\≈V–¥¸>@•˘cZõ\Ê%¿\râ{,}¸>@∏\‰∏S:\Ë%¿D¢–≤\Ó˚>@¶∏™\Ïª\Í%¿œ†°Ç˚>@˘Ûm¡R\Ì%¿aUΩ¸N˚>@EÄ”ªx\Ô%¿i®QH2˚>@\·(yuéÒ%¿\€2\‡,%˚>@h\ÏK6Ù%¿sÄ`é˚>@Û«¥6çı%¿äWY\€˚>@´\Á§˜ç˜%¿}Xo\‘\n˚>@{M\nJ˘%¿™Å\Ês\Ó˙>@\Ã\'+Ü´˚%¿Y2\«ÚÆ˙>@˙π°);˝%¿;åI˚>@Òπ\Ïø˛%¿.é\ M\‘˙>@˚=±Nïˇ%¿S%\ \ﬁR˙>@9\n\0&¿®\∆K7â˘>@˘aÑ\0&¿!>∞\„ø¯>@i¨˝ù\Ì&¿CÆ‘≥ ¯>@B	3mˇ&¿Û\“o_˜>@åªA¥V&¿\€nÇoöˆ>@ìW\Áê&¿\≈9\Í\ËÙ>@g\Ó!\·{&¿πçÙ>@rP\¬L\€&¿Háá0~Ú>@\‡IóU&¿>\ÈDÇÒ>@sGˇÀµ&¿zV“äo>@\¬˘‘±J	&¿êÙi˝\Ì>@R\’Q˜	&¿\¬hV∂\Ì>@¸ﬁ¶?˚	&¿âC6ê.\Í>@\ÕW\…\«\Ó\n&¿ﬂ•\‘%\„\Ë>@§\‰\’9&¿‹Ç•∫Ä\Á>@È∑Ø\Á&¿Tç^\rP\Ê>@ ^\◊/\ÿ\r&¿∂†˜\∆\‰>@¶Å’∞&¿b.©\⁄n\‚>@Ö\È{\r¡&¿\œh´í\»\‚>@\›\”\’ã&¿ÑÇR¥r\„>@\œK\≈∆º&¿\Ê@µm\‰>@w˛E&¿êÇßê+\Â>@`∑\Ó\Ê&¿â\–\Ê>@Øò\ﬁ&¿≥\œcîg\Ê>@®\ƒuå+&¿/O\Áä\Ê>@\Õ\ ˆ!o!&¿Ü øñW\Ê>@P6\Â\n\Ô\"&¿$)\Èah\Â>@‚îπ˘F$&¿1\”ˆØ¨\‰>@©¶\Ô5$&¿O¨S\Â\„>@Ø\Í¨\ÿ#&¿3Pˇ>\„>@Å@g“¶\"&¿¥\Â\\ä´\‚>@gÔå∂*!&¿ﬁêFN\‚>@D‹úJ &¿\’íw\·>@ò§2\≈&¿f\€ikD\‡>@;ßY†\›&¿g)YN\ﬁ>@G∞q˝ª&¿DN_\œ\◊\‹>@√ú†M&¿\√e6\‹>@˙ôz\›\"&¿û{ó\€>@O\\éW \Z&¿\ŸwEø\Ÿ>@!w¶(&¿±mQfÉ\ÿ>@3\‚\–(%&¿n¢ñ\ÊV\ÿ>@Ûr\ÿ}\«(&¿Ù\‹BW\"\ÿ>@/m8,\r,&¿\ƒxÕ´:\◊>@\Ï¯/0&¿ÚöWuV\”>@xóã¯N4&¿_&äê\“>@∑õ\‡õ¶7&¿⁄íUn\“>@Ωßr\⁄S:&¿G\r6u\“>@ﬁè\€/ü<&¿ì¨\√\—U\“>@«°~∂>&¿\ƒ\·\—\∆\—>@tôöo@&¿@3à\Ï\–>@Y\€èãB&¿S	O\Ëı\œ>@å\ÿ\'ÄbD&¿\ﬂ¡O@\œ>@\»#∏ë≤E&¿\»–±É\Œ>@ÆÒô\ÏüG&¿î.´∞\Õ>@0J\–_\ËI&¿0ª\'\Õ>@Ù˚˛\ÕK&¿∏;k∑]\Ã>@v\Zi©ºM&¿@§ﬂæ\Ã>@c\'ºßN&¿\…<Ú\À>@9òMÄaQ&¿\‹N^\»>@Vúj-T&¿\”N\Õ\Â\«>@*U¢\Ï-U&¿T8ÇTä\≈>@+QˆñrV&¿e¶¥˛ñ\ƒ>@\Z\‹\÷ûW&¿E7ß\¬>@-z®m[&¿ä≠†i¡>@Q0c\n^&¿Ø\\oõ©¿>@aßX5`&¿É˚¿>@¿\Î3g}b&¿\\\„3\Ÿ?ø>@\Í\ gyd&¿(~åπkΩ>@.\≈Ue\ﬂe&¿ææ÷•Fº>@6Y£¢i&¿Uá\‹7º>@:Z’ín&¿Xë\—Iº>@5óup&¿∞Æ\n\‘bº>@iN^dr&¿ê\ÂZº>@‰ªî∫dt&¿&\≈\«\'º>@qqTn¢v&¿§SW>Àª>@\ËO=\“x&¿∂¢\Õqnª>@\≈V–¥\ƒz&¿z•,Cª>@û~P)|&¿Ü7kæ∫>@2!Êí™}&¿bù*\ﬂ3∫>@\”\ÿ^z&¿ä!9ô∏π>@xµ‹ôÅ&¿ù,µ\ﬁo∏>@ö\\åÅuÑ&¿é#\÷\‚S∏>@\Õ<π¶@Ü&¿®ê+ı,∏>@tôöoà&¿ˆyåÚÃ∑>@∞\‚ä&¿ó6ñ∂>@\ﬂN\"¬øê&¿µnÉ\⁄oµ>@ií&¿=\Ô∆Ç¬¥>@˚uß;Oî&¿\Âò,\Ó?≤>@oıúÙæô&¿:vPâ\Î∞>@@\€j\÷ü&¿Å>∞>@KêP\·†&¿\«e\‹\‘@Ø>@\Î∆ª#£&¿~¸•E}Æ>@e5]Ot•&¿:dØw´>@_∏sa§ß&¿yë	¯5™>@˚\Â∂}ß&¿á\ﬂM∑\Ï®>@è•]Pß&¿5\Ô8EG¶>@Å≈è1ß&¿rl=C§>@†ä∑òß&¿é\Ê\»\ /£>@HßÆ|ñß&¿˜â\Ì\Ó°>@\"ã4Ò®&¿j\ﬁqäé†>@%\Á\ƒ⁄ß&¿¥À∑>¨ü>@í\Ã\Ínß&¿£ë\œ+ûû>@=Úœ•&¿CV∏ù>@,Åîÿµ•&¿ﬂ•\‘%\„ú>@`<ÉÜ¶&¿˘ûëçú>@<°◊üƒß&¿\ﬁ8)\Ã{ú>@\¬hV∂©&¿¡T3k)ú>@N\–&áO™&¿Bìƒírõ>@4¢¥7¯™&¿QΩ¬ö>@\”k≥±´&¿w°πN#ô>@∫ÑCo±&¿\"ƒï≥wö>@hÜ¨∂&¿\ÏNwûxö>@≠k¥\Ëπ&¿¯\‡µKö>@¿îÅª&¿\r¡q7ô>@¨\‚ç\Ã#ø&¿\√c?ã•ò>@\œg@Ω¡&¿p\"˙µıó>@ëao\ƒ&¿\⁄9\Õ\Ìñ>@˜<⁄®\∆&¿¢zk`´î>@(~åπk\…&¿‘∂aì>@\Ë˘\”Fu\ &¿¸\≈l…™ê>@\“:™ö \ &¿1`\…U,é>@ï”ûís\ &¿Gç>@\œ¯æ∏T\Õ&¿íZ(ôå>@§ä\‚U\÷\Œ&¿æ£∆Ñòã>@qÆaÜ\∆\€&¿\”k≥±ã>@îk\ndv\ﬁ&¿\¬Ÿ≠eä>@\ÎT˘ûë\‡&¿\r\„n≠â>@¶~\ﬁT§\‚&¿i„àµ¯à>@ÿÄq\Â\‰&¿Ù˘(#.à>@Õ¨•Ä¥\Á&¿«ü®lXá>@1AG´\Í&¿\‚∞4£Ü>@†m5\Î\Ï&¿wº\…oÖ>@ˇ	.V\‘&¿\…w)u…Ñ>@k\r•ˆ\"Ú&¿\›{∏‰∏É>@˛2Ù&¿&‰ÉûÕÇ>@y∞\≈nüı&¿gaO;¸Å>@\‰jdWZˆ&¿\Í∞\¬-Å>@5\nIfıˆ&¿MÜ\„˘Ä>@GUD\›˜&¿\»zjı\’}>@W\Ão˙&¿&\0ˇî*}>@y?nø|˙&¿\ÏO\‚s\'|>@\“6˛De˚&¿F	˙=z>@\ÏjÚî˝&¿Ék\Ó\Ëy>@e¸˚åˇ&¿Y˜èÖ\Ëx>@9\÷\≈m4\0\'¿ø∑\È\œ~x>@ÜpÃ≤\'\'¿Ÿ∞¶≤(x>@\\\÷µ\'¿∞u©˙]>@Cr2q´\‡&¿jj\ŸZ_>@\Ëyítu&¿”Ñ\Ì\'c\0>@´\Á§˜çw&¿]•ª\Îl¯=@˚Zó\Z°á&¿PVW\Ï=@ˇ\È\nº£&¿õV\nÅ\‰=@Wòæ\◊¥&¿ﬁìáÖZ\ﬂ=@Qi\ƒ\Ã>ø&¿>wÇ˝\◊\—=@åL¿Øë\‹&¿u\‰Hg`\–=@ìo∂π1\›&¿=}˛\œ=@\ﬁ\ÔU+\€&¿ã8ùd´\œ=@øï\Ï\ÿ\ÿ&¿§\¬\ÿBê\œ=@#ıû\ i\◊&¿™õã\œ=@\ﬁZ&\√Ò\‘&¿ì®|ö\œ=@ ©ùaj\”&¿!í!\«\÷\œ=@\ÈÛQF\\\–&¿f2\œg\Ë=@\Ô\„hé¨&¿\Â*ø)\Ë=@\÷ãmR	&¿äwÄ\'-\Ë=@rP\¬L\€&¿9πﬂ°(\Ë=@2>\Ã^∂&¿G ^\◊/\Ë=@\rˇ\È\n&¿p?\‡Å\Ë=@÷çwG\∆&¿∞v\Á®\Á=@çúÖ=\Ì\0&¿\À2êg\Á=@\Áp≠ˆ∞ˇ%¿\ÂÚ\“o\€=@\≈_—≠ø%¿i¢\⁄=@«ºé8dª%¿\√§R\Ï\ÿ=@éD¡åπ%¿(Hlw\ÿ=@F\Œ¬ûv∏%¿!Êí™\Ì\÷=@ä\0ßwÒ∂%¿\Ïm3\‚\’=@*˝Ñ≥[≥%¿K<†l\ \’=@\Z®åü±%¿¢µ¢\Õ\’=@\ÿÒ_ ∞%¿ëFN∂\’=@¯änΩÆ%¿ØB\ O™\’=@1\Ï0&≠%¿?˛“¢>\’=@TpxAD™%¿eâ\Œ2ã\‘=@:<ÑÒ”®%¿\œ:Ø±\”=@◊£p=\nß%¿†\·\Õ\Zº\”=@pD˜¨k§%¿™π\‹`®\”=@7m\∆ià¢%¿sû±/\Ÿ\–=@,ú§°%¿\›A\ÏL°\œ=@cAaP¶°%¿\≈9\Í\Ë∏\Œ=@Ù˛?Nò†%¿ã¡√¥o\Œ=@\»Eµà(û%¿\”Ù\Ÿ\◊\Õ=@\œg@Ωù%¿\„«òªñ\Ã=@ï\rk*õ%¿S\"â\ =@:œÑ&ô%¿?\Êù\…=@•\›\Ëc>ò%¿(\Ô\„hé\»=@?q\0˝ñ%¿ê˜™ï	\«=@(µ\—vî%¿]˝\ÿ$?\∆=@b¢A\nûí%¿±£q®\ﬂ\≈=@ÖÃïAµë%¿od˘É\≈=@CÄ\ràê%¿_b,\”/\≈=@2ë\“lè%¿\—äX\ƒ\ƒ=@A\’\Ë\’\0ç%¿¸4\Ó\Õo\ƒ=@^Ä}t\Íä%¿%!ë∂Ò\√=@¯Ac&â%¿ë*äWY\√=@ÖD\⁄∆üà%¿$\'∑\n\¬=@*Wxóãà%¿lw\–}¡=@U§\¬\ÿBà%¿%\Ë/Ù¿=@T®n.˛Ü%¿i7˙ò¿=@\ŸZ_$¥Ö%¿y7Ræ=@∞8ú˘’Ñ%¿uí≠.ßº=@R\’Q˜Å%¿O[#Çqº=@\Œ5\Ã–Ä%¿|úi\¬ˆª=@\«ÛPo~%¿§•ÚvÑª=@\r©¢xï}%¿||BvﬁÆ=@√Ä%W±p%¿úQÛUÚ≠=@.W?6\…o%¿\Î^fÿ¨=@ßYO≠n%¿˚\Â∂}´=@ÙPoFm%¿C\‚K™=@èo\Ô\Zl%¿\“ˇr-Z®=@jLàπ§j%¿\»	F≥¶=@2\√Fi%¿\Ô¨\›v°•=@±˜\‚ãˆh%¿CÄ\rà§=@:ì6U˜h%¿N∂Å;P£=@Å≥î,\'i%¿¡çî-í¢=@aâîMi%¿{◊†/Ω°=@\‰€ª}i%¿#ˆ	††=@\·(yuéi%¿|∂ˆû=@\Á\»\ /Éi%¿†‹∂\Ôù=@\Èc> \–i%¿Õê*äWù=@T¸\ﬂj%¿ñYÑb+ú=@7m\∆iàj%¿ç\Ìµ†˜ö=@\‰˘®7k%¿Çp\Íô=@í\Á˙>l%¿rÜ\‚é7ô=@≠˘Òóm%¿\√‘ñ:»ó=@,Iû\Î˚p%¿_a¡˝Äó=@`èâîfs%¿¿¥®Oró=@3¿Ÿ≤t%¿«ü®lXó=@uv28Jv%¿kÛˇ™#ó=@\Ÿ\ÏHıùw%¿\n¢\Óêñ=@%Æc\\qy%¿¨èáæªï=@X7\ﬁ{%¿#ˆ	†ï=@,\◊\€f*|%¿Zõ\∆ˆZî=@*¨TPQ}%¿cB\Ã%Uì=@Ñ∑! %¿N\–&áOí=@†¿;˘ÙÄ%¿F¥Swë=@=|ô(BÇ%¿¿YJñìê=@6Œ¶#ÄÉ%¿v\‘~kè=@ÜZ”º\„Ñ%¿73˙\—pé=@ùª\Ï◊Ö%¿\…°fHç=@ôú\⁄¶Ü%¿rm®\Áã=@b1\ÍZ{á%¿å∫\÷ﬁßä=@f-§˝á%¿˘ıCà=@ò¢\\\Zøà%¿P\ﬂ2ßÀÜ=@\Õ\ ˆ!oâ%¿$\ÌFÛÖ=@\Ë£\Áä%¿(Ù˙ì¯Ñ=@1\Ôq¶	ã%¿\‡,%\ÀIÑ=@ñ\œÚ<∏ã%¿2¨\‚çÃÉ=@\»\\Tå%¿é\Á3†Ç=@ı††≠å%¿I-îLNÅ=@^ª\Ôé%¿—ïTˇÄ=@{\›\"0÷è%¿\»\Œ\€\ÿ\ÏÄ=@∂‰†Ñë%¿i∆¢\ÈÄ=@\‰¢ZDì%¿\Ëg\ÍuãÄ=@t¥™%ï%¿‚è¢\Œ\‹=@\Á\∆ÙÑ%ñ%¿Kr¿Æ&=@\rèR	ó%¿l¥\Ë°~=@˝ª>s÷ó%¿n\›\ÕS~=@\Z¿[ Aô%¿\0Sh}=@\0\·Câñú%¿ˆ5C™|=@RcB\Ã%ù%¿/o\◊j{=@w-!Ùú%¿s+Ñ\’Xz=@Ù1\Ëú%¿gÄ≤ey=@¸T\Zàù%¿”°\”Ûnx=@-≤ùÔßû%¿S\ÁQÒw=@†Q∫Ùü%¿\„¡ª}v=@¥Xä\‰+°%¿5¥ÿÄt=@ö`8\◊0£%¿\‚!åü\∆q=@]\ﬁÆ’¶%¿\Èö\…7\€p=@≥\Ì¥5\"®%¿¥\Ê\«_Zp=@\‰qs*©%¿≤∫\’o=@ˇ\\4d<™%¿Ä\rào=@-\Íì\‹a´%¿æP¿v0n=@óåc${¨%¿¶µilØm=@\ÔÀô\Ì\n≠%¿|öìm=@K<†l ≠%¿oõ©èl=@PèmpÆ%¿£±ˆw∂k=@∫fÚ\Õ6Ø%¿\·∑!\∆kj=@ﬁë±\⁄¸Ø%¿ä[1\–i=@≠§\ﬂP∞%¿≠jIGi=@q=\n◊£∞%¿\…:]•g=@¡8∏tÃ±%¿B≤Ä	\‹f=@˘á-=ö≤%¿\–{c\0f=@˚\À\Ó…≥%¿ª	æi˙d=@Œâ=¥èµ%¿÷´\»\ËÄd=@\Èahur∂%¿\Ô7\⁄q\√c=@\0Rõ8π∑%¿\√b‘µˆb=@	l\Œ¡3π%¿Éi>\"b=@78˝⁄∫%¿\≈Sè4∏a=@¨\‡∑!∆ª%¿¥Xä\‰+a=@úN≤\’\Âº%¿§à´`=@Vô)≠øΩ%¿YM\◊]_=@Áçì¬ºø%¿´Ãî\÷\ﬂ^=@3ç&c¿%¿\0ã¸˙!^=@∫¯€û ¡%¿®\0œ†]=@M\Ÿ\Èu¡%¿dx\Ïg±\\=@\‚\Â\È\\Q\¬%¿h\œej\\=@MK¨å\÷%¿7\0!f=@gc%\ÊY\È%¿Ù4`êÙe=@\n/¡©\Ï%¿\Ìõ˚´\«e=@EbÇ\Zæ\Ì%¿¢	±àe=@ß/˙\nÚ%¿L\Z£uTe=@sÇ69Ù%¿n⁄å\”e=@π\Î8ˆ%¿\œ:Ø±c=@`sû	˝%¿?\ZNôõc=@æ1\0\«˛%¿\‚tí≠.c=@\À2êgˇ%¿1~\Z˜\Êc=@\"5\Ìbö&¿¸\‚Rï∂d=@6\«e\‹&¿fjº!e=@\Ì∏\·w\”&¿8Öï\n*f=@n\√(&¿ïÙ0¥:i=@;8ÿõ\n&¿Ø[\∆˙j=@H¬æùD&¿êû\"áàk=@Ò’é\‚\r&¿<l\"3l=@]ﬂáÉÑ&¿u\‰Hg`l=@¸ä}&¿Zfä≠l=@\¬5wÙø&¿ˇ	.V\‘l=@/Ö\Õ&¿\\¨®¡l=@ËæúŸÆ&¿/N|µ£l=@êP\·\Z&¿XéêÅl=@k∑]hÆ&¿79|“âl=@∆•*mq&¿G\Â&jm=@íîÙ0¥2&¿%\’?àl=@\·bE\r¶1&¿fNó\≈\ƒj=@sÅ\Àc\Õ0&¿Ω©HÖ±i=@ﬂà\ÓY\◊0&¿\ﬁ8)\Ã{h=@E/£Xn1&¿\‰,\Ïiág=@§R\Ïh2&¿)x\nπf=@\0\Z•Kˇ2&¿\ÁR\\Uˆe=@Ö\Ô˝\r\⁄3&¿Ñ,&˛d=@≥|]Üˇ4&¿\ﬁJ\n,d=@ˆb(\'\⁄5&¿¶(ó\∆_=@\Z˙\'∏X1&¿R%ìS_=@i˝-¯/&¿9a\¬hV^=@L8†-&¿Úaˆ≤\Ì\\=@\Zã¶≥ì)&¿@KW∞ç\\=@™πn(&¿ï\‘	h\"\\=@\Â∏S:X\'&¿—ë\\˛CZ=@9≥]°&&¿í\"ã4Y=@±¿Wt\Î%&¿\“\·!åW=@ùJÄ*&&¿]\ZøJV=@1∑{πO&&¿»ô&l?U=@∂ˆ>UÖ&&¿¬Ñ—¨lS=@´îû\È%&¿Z\ÿ\”Q=@dœû\À\‘$&¿≠€†ˆ[O=@)\Í\Ã=$$&¿\ﬂ\ﬁ5\ËK=@L5≥ñ\"&¿’íér0K=@•\Ÿ<É!&¿JF\Œ¬ûJ=@°ª$Œä &¿™~•Û\·I=@!;oc≥&¿R\Ì\”ÒòI=@:Z’íé\Z&¿≥|]ÜˇH=@˛ö¨Q&¿˘ÉÅ\ÁF=@J)\Ëˆí&¿}\È\Ì\œE=@Ù¸i£:&¿n\‡\‘)C=@\œL0úk&¿è˚V\Î\ƒA=@[Œ•∏™&¿úà~m˝@=@\„\Zü\…˛	&¿;\»\Î¡§@=@¡7Mü&¿Ú^µ2\·?=@¥≠fùÒ&¿\"nN%?=@\Ô∆Ç¬†&¿\ƒ@◊æÄ>=@æ_¥\«&¿˝æÛ\‚<=@N∑\Ïˇ\0&¿èãjQ<=@vß;O<ˇ%¿\ﬂmU==@Qı+ùˇ%¿¯Xéê5=@[{Û%¿ ^\◊/\ÿ-=@<¡˛\Î\‹\Ï%¿kÒ)\0=@sˆ\Œh´\⁄%¿≥(\Ï¢\Ë=@y\ÁPÜ™\ÿ%¿í\Êèim=@Ù\‹BW\"\ÿ%¿¿\Ãw=@Äô\Ô\‡\'\÷%¿5B?SØ=@õV\nÅ\‘%¿U§\¬\ÿB=@–≥Yıπ\“%¿\Ï1ë\“=@äu™|\œ\–%¿\‚≠Ûoó=@\ÊtYLl\Œ%¿t	á\ﬁ\Z=@⁄´èá\Œ%¿ZF\Í=ï=@]¡6\‚\…\Œ%¿ªö<e=@5\–|\Œ\›\Œ%¿T\«*•g=@ <˜\Œ%¿ájJ≤=@\¬j,a\Õ%¿$(~åπ=@¡oCå\◊\Ã%¿\ËO\’\È =@\÷a∞\Ã%¿*T7#=@≠\√\—U∫\À%¿\„4ÙO$=@\Ô®1!\Ê\ %¿9\Ôˇ\„$=@∫∫c±M\ %¿∂π1=a%=@ãâ\Õ«µ\…%¿¶E}í;4=@X8IÛ«¥%¿8†•+4=@\·\ÁS«≤%¿sÉ°+4=@iß\ÊrÉ±%¿4ª\Ó≠H4=@\›zMØ%¿Ω\Z†44=@î¡QÚ\Í¨%¿4GV~4=@\“\«|@†´%¿w¶(ó2=@‹û ±›•%¿∂e¿YJ2=@&´\"\‹d§%¿cc^G2=@j4π£%¿¥\ Li˝1=@R∏Ö\Î°%¿∏\nıÙ1=@\ƒABî/†%¿¿îÅ2=@øÚ =Eû%¿(|∂2=@QlMKú%¿q\Á\¬H/2=@iè\“\·ô%¿\0ˇî*Q2=@ûBÆ‘≥ò%¿ë_?\ƒ3=@\ﬁ\ﬂ4}ñ%¿\‰,\Ïiá3=@*8º \"ï%¿\"®\ZΩ\Z4=@\Î¨\ÿcí%¿é\È	K<4=@8©0∂ê%¿œû\À\‘$4=@Cé≠gè%¿\Ó[≠ó3=@\Í\œ~§àå%¿h\Ã$\Í3=@»∑w\r˙ä%¿ù∫ÚY2=@í∞o\'â%¿á˙]ÿö1=@F\ÕW\…«Ü%¿\Ã|?1=@c‘µˆ>Ö%¿àûîI1=@Gtœ∫FÉ%¿±¿Wt\Î1=@Z\Ÿ>\‰-%¿T\‰qs2=@\ÿc\"•\Ÿ|%¿ïõ®•π5=@òæ\◊w%¿3ƒ±.n7=@ú\ﬂ0\— u%¿‘õQÛU:=@»îA\’p%¿æ˜7<=@º≥v€Ön%¿I\÷\·\Ë*==@õ\‰G¸äm%¿H˝ı\n>=@E†˙ël%¿í;l\"3?=@ÿúÉgBk%¿©\€\ŸW@=@Ö¥∆†j%¿n˜rüA=@Wyaßh%¿\"UØ≤B=@%\ÊYI+f%¿\\ê-\ÀC=@Œ™\œ\’Vd%¿){K9_D=@≠mésc%¿?πnJE=@\’\Ì\Ï+b%¿D¯AcF=@(\‘\”G`%¿1XrG=@p\Õ˝/_%¿∏u7OI=@Ö8Ñ*]%¿ö$ñîK=@ü°ºè[%¿\’&N\ÓwL=@ê.6≠Z%¿∏[ívM=@.ÆÒô\ÏW%¿êKy N=@^\ŸÉkV%¿Ò\‘#\rnO=@c_≤Ò`S%¿\–dˇ<\rP=@R,∑¥\ZR%¿?:u\Â≥P=@@˘ªw\‘P%¿qØ\Ã[uQ=@©i\”LO%¿$∏ë≤ER=@ª+ª`pM%¿Ø∞\‡~¿S=@\≈ ¶\\I%¿â±LøDT=@CY¯˙ZG%¿ó\·?\›@U=@õrÖwπ@%¿e\0®\‚\∆U=@•üpvk9%¿B@æÑ\nV=@ëEöx7%¿\–)\»\œFV=@•\◊fc%6%¿#˜tu\«V=@óo}Xo4%¿6\\ê-W=@\–#ÑG3%¿\Œ˝\’\„æY=@P\„\ﬁ¸Ü1%¿uÄ\‘Z=@VÚ±ª@1%¿\—6Æ[=@rÜ\‚é71%¿B@æÑ\n^=@vå+.é2%¿4.\…^=@|bù*\ﬂ3%¿òät?_=@Dì7¿4%¿RÛUÚ±_=@\nü≠ÉÉ5%¿˜¨k¥`=@\Íwak6%¿ê2\‚\–`=@π¸áÙ\€7%¿®W\ 2\ƒa=@A∂,_ó9%¿ õ\‰G¸b=@™$\Ô:%¿˘˜d=@≠\¬fÄ:%¿\œ¿\»Àöd=@\‡\€Ùg?:%¿±¸˘∂`e=@µ˝++M:%¿p%;6i=@që{∫∫+%¿$∑&›ñh=@â¥ç?Q)%¿©lXSYh=@‘ªx?n\'%¿}xñ #h=@¨\·\"˜t%%¿ó\Â\Î2¸g=@fL¡\Zg#%¿\Ô\Â>9\nh=@ÒF\Êë? %¿∑ºTlh=@\‰≤Û6%¿,Iû\Î˚h=@û\–\ÎO\‚%¿\ÁêΩ\ﬁi=@Ö\'Ù˙ì%¿ºy™Cnj=@\Z2•%¿+2: 	k=@nM∫-ë%¿Ÿïñëzk=@6vâ\Í≠%¿>&Rö\Õk=@O!W\ÍY%¿$}ZEl=@ÑûÕ™\œ\r%¿D\ﬂ\›\ m=@X)±k%¿od˘Ém=@DLâ$z	%¿=\Ó\Œ\⁄m=@\–\rM\Ÿ\È%¿–òI\‘n=@c∏:\0\‚%¿Ÿ¥R\‰n=@R∫Ù/I%¿bûï¥\‚o=@r\ﬂjù∏%¿\◊0C\„âp=@t{Ic%¿\÷WWjq=@ä¨5î\⁄%¿	˚vr=@oüUfJ%¿≤c#Øs=@A*≈é\∆%¿±ﬁ®¶s=@*ã\¬.ä˛$¿:#J{És=@\råº¨â˝$¿Aö±h:s=@Lç\–\œ\‘˚$¿ü`<Ér=@≠àö\ËÛ˘$¿˝áÙ\€\◊q=@ı/Ieä˘$¿ÖîüT˚p=@g∫\◊I}˘$¿\≈\0â&Pp=@Ü\«~K˘$¿\€$∂ªo=@ØD†˙˘$¿˚\Ë‘ï\œn=@§®3˜ê¯$¿êKy n=@≠ˆ∞\n¯$¿_\œ\◊,óm=@¨s\»^˜$¿\Œ9x&4m=@[&\√Ò|ˆ$¿ákµáΩl=@ÛW\»Ù$¿eV\Ôp;l=@`ù∫Ú$¿∑~˙œök=@mésõ$¿åâBk=@8\⁄q\√\Ô\Ó$¿ºk=@ü\€2\‡\Ï$¿Å!´[=k=@`X˛|\Î$¿ö$ñîk=@@˙&MÉ\Í$¿Ωã˜\„ˆk=@®5\Õ;N\È$¿+\‹Úël=@çaN\–&\Á$¿±Nï\Ôm=@ºï%:\À\‰$¿ãO0ûm=@ÊØêπ\‚$¿≠\ﬂLLn=@r¿Æ&O\·$¿\¬QÚ\Ío=@\ÂõmnL\ﬂ$¿\"\≈\0â&p=@,\ÿF<\Ÿ\›$¿0+\È~r=@\€3K\‘\‹$¿øb\rπs=@W\\ïõ\ÿ$¿.»ñ\Âs=@dø\r1\÷$¿=+i\≈7t=@ò4F\Î®\“$¿yêû\"át=@7\‡Û\√\—$¿å°úhWu=@\›xwd¨\Œ$¿≥\—9?\≈u=@1ï~\¬\Ÿ\Õ$¿ìr˜9>v=@©æÛã\Ã$¿D˝.l\Õv=@,Dá¿ë\»$¿®ç\Ít w=@F\ÔT¿=\«$¿[A\”+w=@\‡ÅÑ\≈$¿ˇ=x\Ì\“v=@¡ê’≠û\√$¿\'Ωo|\Ìu=@|a2U¿$¿ˇX´vu=@^\ŸÉkæ$¿m˝Ùüu=@Pqxµº$¿+TT˝v=@≥{Ú∞Pª$¿ô\Ÿ\Á1\ w=@á¶\ÏÙÉ∫$¿Z∫Çmx=@A*≈é∆π$¿r75\–x=@\»%é<π$¿ˆ#EdXy=@á5ïEa∑$¿:\\´=\Ïy=@.\ lêI∂$¿¸\0§6qz=@\‚\ \Ÿ;£µ$¿{ª%9`{=@~\ÂAzä¥$¿W\"P˝É|=@%?\‚W¨±$¿õ=\–\n}=@´\Á§˜çØ$¿\ÃbbÛq}=@\—\Õ˛@π≠$¿ y\ÁPÜ~=@eß\‘E™$¿?5^∫IÄ=@\“\·!åß$¿+¯màÅ=@\‘Fu:ê•$¿â\“\ﬁ\‡É=@lÀÄ≥î§$¿ã8ùd´É=@√ü\·\Õ\Z§$¿œû\À\‘$Ñ=@\rƒ≤ô£$¿\’v|”Ñ=@£h[Õ¢$¿q9^Å\ËÖ=@ıÅ\‰ùC°$¿eSÆ.á=@C</Oü$¿L«úg\Ïá=@M\‡Ù.û$¿ã¿X\ﬂ¿à=@\0\·Câñú$¿m\‰∫)\Ââ=@\ÿ-c}õ$¿\Ë€Ç•∫å=@2Ø#Ÿò$¿$(~åπè=@\Ã(ñ[Zï$¿≠N\ŒP‹ë=@\…\„i˘Åì$¿Å\–z¯2ï=@ä;\ﬁ‰∑ê$¿w|\”Ùï=@ôcyW=ê$¿„äã£ñ=@\‰1ïÒè$¿	ãä8ùò=@áR{mè$¿\‰¯°“àô=@$d \œ.è$¿o≠mö=@˙Ä@g“é$¿3díëõ=@a\„˙w}é$¿®˝\÷Nîú=@MÖx$^é$¿\Ô≠HLPü=@Ωp\Á\¬Hè$¿º\Á¿rÑ†=@\Ë†K8Ùé$¿zR&5¥°=@g∏üé$¿u:êı‘¢=@\Ôt\Áâ\Áå$¿Mg\'É£=@æL!uã$¿6Ø\Í¨§=@í∞o\'â$¿\Ó<0Ä§=@FA¯Ü$¿[\Ó\Ã√•=@E|V|$¿è\ƒ\À\”¡=@†R%\ \ﬁj$¿R%ìS\√=@∆Ünˆj$¿F\Ì~\‡\√=@J\n,Äi$¿¸´\«}´\≈=@^\’Y-∞g$¿ë\r§ãM\«=@>ó©If$¿L\√\…=@g,ö\ŒNf$¿”æπø\ =@ÉQIùÄf$¿\ Iª\—\À=@õT4\÷˛f$¿Ω©HÖ±\Õ=@\Â—ç∞®h$¿m\Á˚©Ò\Œ=@\Ê\Í\«&˘i$¿	\¬P®\œ=@çF>Øxj$¿àÉÑ(_\–=@\«\‘]\Ÿk$¿äV\Óf\—=@7›≤C¸k$¿\Î˛±\“=@≥_w∫Ûl$¿¥t\”=@e\ZM.n$¿ÖÕÆ{\”=@Ò\∆O\„n$¿¶^∑\‘=@¢BusÒo$¿\”€üãÜ\‘=@\Ê\È\\QJp$¿lw\–}\’=@é@ºÆ_p$¿\'N\Ów(\÷=@≈´¨mäo$¿kúMG\0\◊=@>≥$@Mm$¿y;\¬i¡\◊=@\–\Ì%ç\—j$¿\\ AÒc\ÿ=@õrÖwπh$¿xC\Z8\Ÿ=@%\…s}f$¿\€˙\È?k\⁄=@&˝Ωd$¿€áº\Â\Í\€=@d\Î\¬1c$¿pñí\Â\‹=@8\‹GnMb$¿K\Â\Ìß\›=@eqˇë\È`$¿9\'ˆ\–>\ﬁ=@\’!7\√\r`$¿\«e\‹\‘@\ﬂ=@ZÒ\rÖ\œ^$¿}\Ï.PR\‡=@≤ı\·ò]$¿^ëöv\·=@£Ø \ÕX\\$¿g_yêû\‚=@=\”KåeZ$¿,+MJA\„=@5\Ó\ÕoòX$¿!∫ˆ\‰=@\r\„n≠U$¿˙\ÓVñ\Ë\‰=@ï|\Ï.PR$¿±àaá\Â=@\·≥up∞O$¿\Ôí8+¢\Ê=@%?\‚W¨I$¿>¥è¸\Ê=@l#û\ÏfF$¿\‡∫bFx\Á=@\Ì\ÿ\ƒ\ÎB$¿Íóà∑\Œ\Á=@]1#º=@$¿\np\Ë=@¥∞ß˛:$¿Ä;®\Ë=@/\ﬂ˙∞\ﬁ8$¿\Œ5\Ã\–\Ë=@±4£\Z6$¿M2rˆ\Ë=@ìsb\Ì3$¿´\Ë\Õ<\È=@\“9?\≈q0$¿+/˘ü¸\È=@EˆAñ+$¿\‰áJ#f\Í=@¸ã†1ì($¿zpw\÷n\Î=@â∂c\ÍÆ$$¿~˝,\Ï=@¨;€§\"$¿à\rN\“\Ï=@EùπáÑ$¿Ö∂úKq\Ì=@\Â}Õë$¿Õëï_\Ó=@\‚∂Ùh\Z$¿t\“˚\∆\◊\Ó=@$|\Ôo\–$¿aßX5\Ô=@åı\rLn$¿7\ƒxÕ´\Ó=@\0\‰Ñ	£$¿4\Ÿ?O\Ó=@æ•ú/ˆ$¿Y6sHj\Ì=@6\Á\‡ô\–$¿Û=#\Z\Ì=@D˚X¡o$¿B\'Ñ∫\Ï=@q:	$¿+Ö@.q\Ï=@ ¿\0\¬$¿|bù*\ﬂ\Î=@N—ë\\˛$¿uU†É\Î=@°ˆ[;Q$¿\ÀÙK\ƒ[\Î=@µSsπ¡\0$¿≥∑îÛ\≈\Í=@©£\„jdˇ#¿\r6u\È=@ùΩ3⁄™Ù#¿ÒI\'L\È=@Ü:¨p\À\Ô#¿\–CmF\È=@~bº\Ó#¿\»|@†3\È=@ZKiˇ\Î#¿Û\‰öô\È=@j¶{ù\‘\Á#¿¥ëÎ¶î\Î=@n\Óïy\„#¿!#†\¬\Ï=@P5z5@\·#¿<üıf\Ï=@t\ŒOq\‡#¿˙\ÓVñ\Ï=@*≠ø%\0\ﬂ#¿^ª¥\·∞\Ï=@\‹h\0oÅ\‹#¿\‚;1\Î\≈\Ï=@∞71$\'\€#¿Xrã\ﬂ\Ï=@•e§\ﬁS\Ÿ#¿Ï§æ,\Ì\Ï=@\ÕX\‰\◊#¿\ÊÁÜ¶\Ï\Ï=@?\∆\‹\’#¿¶&¡\“\Ï=@zSë\nc\”#¿\≈5|\Ô=@•æ,\Ì\‘\ƒ#¿\›zM\Ô=@bÅØ\Ë\÷\√#¿\¬€Éê\Ô=@p\œÛßç\¬#¿ü\"áàõ\Ô=@¢ô\'\◊¿#¿o\◊j\Ô=@\Ã_!sΩ#¿\‡ÄJ\Ì=@4-±2≤#¿s\ÿ}\«\Ï=@\Ô\·í\„N±#¿∏<÷å\Ï=@ÆúΩ3⁄™#¿\◊\‹\—\Î=@-\Ïiáø¶#¿4ú27\Î=@÷èMÚ#¶#¿∫ÖÆD†\Í=@5\‘($ô•#¿KêP\·\Ë=@≥%´¢#¿1\Î\≈PN\Ë=@Zú1\Ã	¢#¿è\«T\∆\Á=@zZùú°#¿\“\ﬂK\·A\Á=@ \‘E\ne°#¿ˇvŸØ;\Â=@U¡®§N†#¿¸d\‰=@-≤ù\Ôü#¿n\ﬁ8)\Ã\„=@?¯˘ü#¿~r \n\‚=@	√Ä%W°#¿a\ZÜèà\·=@y\ŒZü#¿\‚Æ^EF\ﬂ=@/®oô”ù#¿\∆nüUf\ﬁ=@3\·ó˙yõ#¿Æªy™C\ﬁ=@¥\Ã\"[ô#¿N\Ô\‚\›=@%xC\Zò#¿Ww,∂I\›=@∞êπ2®ñ#¿˚]ÿö≠\‹=@ı,\Â}î#¿\—Á£å∏\‹=@h\Î\‡`oí#¿¸\„Ωje\ﬁ=@fÖ\"›è#¿\œ.\ﬂ˙∞\ﬁ=@\≈Sè4∏ç#¿)?©ˆ\›=@Ö$≥záã#¿`sû	\›=@Òıµ.5ä#¿ïÒ\Ô3.\‹=@Ù¿\«`≈â#¿3‹Ä\œ\€=@L®\‡Çà#¿ñ%:\À,\⁄=@6\Ã\–x\"à#¿ç¥Tﬁé\ÿ=@Òc\Ã]Kà#¿R~R\Ì\◊=@\À\◊e¯Oá#¿%z\≈r\◊=@#ÖñÖ#¿≤GW\È\÷=@` ê°É#¿\‘\’ãm\÷=@Bx¥qƒÇ#¿!\ÕX4ù\’=@&S£íÇ#¿Úµgñ\‘=@=ú¿tZ#¿M†àE\”=@æi˙\ÏÄ{#¿ıJYÜ8\“=@äM†x#¿\¬3°Ib\—=@ò£\«\Ômr#¿\¬\‹\Ó\Â>\—=@°Üoa\›p#¿\'K≠˜\—=@Ù\‡\Ó¨\›n#¿Ö\–Aóp\–=@Û≠\Îçj#¿!í!\«\÷\œ=@J\œÙci#¿aäri¸\Œ=@éHh#¿˚Y,E\Œ=@\€\–wf#¿W@\‹\Õ=@&ßvÜ©e#¿:$µP2\Õ=@æMˆ#e#¿¥\…\·ìN\Ã=@D¸√ñe#¿t\\ç\ÏJ\À=@uYLl>f#¿Ûë\ÔR\ =@\—\Ê8∑	g#¿¢µ¢\Õ\…=@\Íuã¿Xg#¿ÒI\'L\…=@†\ƒ\ÁN∞g#¿¿\Õ\‚\≈\¬\»=@\„¬Åê,h#¿€à\'ªô\≈=@˚\Í™@-f#¿\nÑùb\’\ƒ=@)Zπòe#¿M÷®\√=@˛∫”ù\'f#¿=≠N\Œ¿=@£\…\≈Xg#¿Ú\ÏÚ≠ø=@s\◊ÚAg#¿^f\ÿ(ø=@§6qrg#¿ñ_cDæ=@˙%\‚≠Ûg#¿ÿÄqΩ=@¸8ö#+g#¿k∫ûË∫º=@ä\ÀÒ\nDg#¿d\Ã]K»ª=@W≤c#g#¿©›Ø|ª=@\·\riT\‡d#¿£>+∫=@`∑\Ó\Êa#¿%îær∫=@\Ó<`#¿˛\'˜é∫=@à\ŸÀ∂\”^#¿e\0®\‚∆π=@1C\„â ^#¿\réíW\Á∏=@\Œ7¢{\÷]#¿r\·@H∏=@K\Õh^#¿åfe˚ê∑=@(d\Áml^#¿\∆2˝Ò∂=@zè3M\ÿ^#¿¯\ZÇ\„2∂=@\‘\”G\‡_#¿s\ÿ}\«¥=@k*ã\¬^#¿ãàbÚ¥=@\Ÿ\Œ˜S\„]#¿ByG≥=@\€e6\»\\#¿∑{πOé≤=@\À,B±\\#¿A\r\ﬂ¬∫±=@ú\ﬁ\≈˚q[#¿\Î»ë\Œ¿∞=@\‰Ötx[#¿;ˇvŸØØ=@*q\„Z#¿Û>é\Ê»Æ=@ﬂ¶?˚ëZ#¿\Ì◊ù\Ó<≠=@Åy»îY#¿¶†\Ÿu´=@\ÊtYLlV#¿F	˙=™=@zT¸\ﬂU#¿7ãC®=@ú¡\ﬂ/fS#¿¸8ö#+ß=@†R%\ \ﬁR#¿ÜV\'g(¶=@R(__S#¿u\Ãy∆æ§=@:\ ¡lT#¿%\ \ﬁRŒ£=@2ì®|R#¿6Ü\Âœü=@¯\›t\ÀQ#¿W\ÓfÖû=@(a¶\Ì_Q#¿âx\Î¸€ù=@ˇ>\„¬ÅP#¿í∞o\'ù=@¬Ñ—¨lO#¿l\Ëf†ú=@G\Â&jiN#¿2ïÒ\Ôõ=@\Ã∞èNM#¿z\¬(õ=@(µ\—vL#¿A°Gåö=@˙DûL#¿πqã˘πô=@|Ä\ÓÀôM#¿Ù1\Ëò=@\Ô∫/gN#¿ÀÉÙ9ò=@$%=≠N#¿÷®áhtó=@ù°∏\„MN#¿H©Ñ\'Ùñ=@\ŸZ_$¥M#¿∞»Øñ=@\⁄r.\≈M#¿^gE‘î=@(ªô—èN#¿ds\’<Gî=@W[±ø\ÏN#¿,H3Mì=@EH\›\ŒN#¿∂ˆ>UÖí=@&U\€MM#¿`ù∫Úë=@¡\∆ı\Ô˙L#¿Ww,∂Ië=@TT˝J\ÁK#¿]S ≥≥ê=@.é\ M\‘J#¿≤Ö %ê=@wÇ˝◊πI#¿ïÑ^é=@+~©üG#¿NA~6rç=@	àI∏êG#¿ÌüßÉå=@Ú∞PköG#¿\Óxìﬂ¢ã=@±˚é\·±G#¿Ze¶¥˛ä=@ip[[H#¿2ì®|ä=@\Ô_{fI#¿\€\ﬂ\ŸΩâ=@õ\‚qQ-J#¿ü\È%\∆2â=@2\Ã	\⁄\‰H#¿-wfÇ\·à=@N\r4üsG#¿∞∂- à=@\√~O¨SE#¿ä\«Eµàà=@`\"ƒïC#¿@j\'˜á=@]˚B#¿\”/oùá=@u9% &A#¿éZa˙^á=@ºØ Ö\ ?#¿\‡ù|zlá=@w\◊Ÿê>#¿_≥\\6:á=@Òf\r\ﬁW5#¿UΩ¸NìÖ=@ˆD◊Ö4#¿∏ [ñÉ=@I∫fÚ\Õ6#¿åÖ!r˙Ç=@Ze¶¥˛6#¿n4Ä∑@Ç=@õ7N\nÛ6#¿äV\ÓfÅ=@ï,\'°Ù5#¿~\»[Æ~Ä=@îôÄ_3#¿Kë|%Ä=@\∆˙&72#¿\ÍÕ®˘~=@–∂öu\∆/#¿µ\‡E_A~=@\„åaN\–.#¿0ù\÷mP{=@ô†Üoa-#¿_\ŒQz=@±\n\ÿ.#¿\”jH\‹cy=@\√JU/#¿t)Æ*˚v=@\Ë\ÿA%Æ+#¿\ƒC?çw=@©1!\Êí*#¿}> àx=@µ˚UÄ\'#¿∑’¨3æw=@V\r\¬\‹\Ó%#¿\Z\‹\÷ûw=@\Ï@1≤$#¿\”\ÿ^zw=@G\Ëg\Íu##¿c|òΩlw=@n4Ä∑@\"#¿\’\'¢_w=@ïF\Ã\ÏÛ #¿ÅïCãlw=@oùª\Ï#¿\Ïæcx\Ïw=@å0Eπ4#¿Ü\Ê:ç¥x=@∫¿\Â±f#¿0ôÚ!x=@EÅ>ë\'#¿üÆ\ÓXlw=@vQÙ¿\«#¿≥ïó¸Ov=@\›\'G¢#¿4\€˙`u=@>{.Sì#¿§®3˜êt=@\ƒ^(`;#¿|bù*\ﬂs=@4˜êΩ#¿rRò˜8s=@&®\·[X#¿c\Ì\Ôlèr=@}\Œ›Æó#¿]lZ)r=@ä[1\–#¿∞èN]q=@˝˜\‡µK#¿\ZS∞\∆\Ÿp=@\—\Ëbg#¿\0\∆3h\Ëo=@\÷t=\—u#¿c\'ºo=@π\‡˛~#¿Ù\≈ﬁã/n=@\r34û#¿⁄¨˙\\mm=@$Ú]J]#¿\◊M)Øïl=@\Ã`åH#¿gúÜ®\¬k=@ΩqRò˜#¿:3Pk=@æ˜7#¿ÙãÙj=@K±£q®#¿\…\«\Ó%i=@#\›\œ)\»#¿Iıù_îh=@∂†˜\∆#¿røCQ†g=@û∂F\„#¿n\√(g=@ƒ±.n£#¿UÜq7àf=@YO≠æ#¿≥ómß≠e=@\È\’\0•°#¿\∆˜≈•*e=@dY0Ò#¿YPîid=@B]¬°#¿º\Èñ\‚c=@íL\‡#¿\Ó\—\Ó#c=@eß\‘E#¿Ç\≈\·ÃØb=@H\≈ˇQ#¿,\ÿF<\Ÿa=@\»%é<#¿Y•ÙL/a=@öA|`\«#¿Ú≥ë\Î¶`=@´!qè•#¿¢ô\'\◊`=@´B±l#¿inÖ∞\Z_=@T\‡d∏#¿\Ï1ë\“l^=@àÄC®R#¿Æ\’ˆB]=@V∫ªŒÜ#¿˚@ÚŒ°\\=@¨8\’Zò\r#¿n˚ı\◊[=@\Ÿ|\\*#¿^Mû≤öZ=@AIÅ0\r#¿5$\Ó±ÙY=@àÑ\Ô˝\r\n#¿µ˚\À\ÓY=@ù\r˘g	#¿Üí…©ùY=@4†ﬁåö#¿‹†ˆ[;Y=@|∑y\„#¿ôIÙ2Z=@jMÛéS#¿,G\»@Z=@±2\Z˘º#¿süàZ=@)\"\√*\ﬁ\0#¿ä\„¿´\ÂZ=@\\\∆M\r4ˇ\"¿±2\Z˘ºZ=@‹Ä\œ#¸\"¿#Ö≤ıY=@åâB\À˙\"¿ıı|\ÕrY=@∂°búø˘\"¿Ê≠∫\’X=@Â¥ß\‰ú¯\"¿7TåÛ7Y=@Ü[\œˆ\"¿L\Z£uTY=@˙=bÙÙ\"¿p_\ŒY=@:vPâÛ\"¿ôa£¨\ﬂX=@Ùz\ƒ\ËÒ\"¿\¬j,amX=@ı¯\√\œ\Ô\"¿4ı∫E`X=@AE’Øt\Ó\"¿˘d\≈puX=@ßY†\›!\Ì\"¿\„\√\ÏeW=@e\‚VA\Ï\"¿Rb\◊ˆV=@≤\÷Pj/\Í\"¿\n.V\‘`V=@K!êK\È\"¿\⁄ ìåúU=@\›y\‚9[\Ë\"¿3∏<\÷T=@ñØ\Àü\Ê\"¿£;àù)T=@¥∞ß˛\‚\"¿ˇ]ü9\ÎS=@üV\—ö\·\"¿;]•ªS=@õ˛\ÏGä\‡\"¿Y¡oCåS=@\◊4\Ô8E\ﬂ\"¿∞\Âï\ÎmS=@\Èö\…7\€\‹\"¿Ù5\Àe£S=@≤\÷Pj/\⁄\"¿ú0a4+S=@`\"\ﬁ:ˇ\÷\"¿µ˘’ëS=@¥ î˜q\‘\"¿ˆ\ÎNwûT=@_&äê\“\"¿iW!\Â\'U=@Oìo+\Õ\"¿&\Œ5\ÃT=@ÆJ\"˚ \À\"¿w1\ÕtØS=@m˛_u\‰\»\"¿$\Ó±Ù°S=@˛År€æ\«\"¿W@\‹\’S=@£\Õqn\∆\"¿\·ô\–$±T=@¥è¸6\ƒ\"¿-ôcyWU=@¥wF[ï\ƒ\"¿Ùn,(V=@¸7/N|\≈\"¿yít\Õ\‰W=@S\"â\∆\"¿ô*ï\‘Y=@Ö±Ö \≈\"¿U\ŸYZ=@::Z\’\¬\"¿ï\rk*[=@%!ë∂Òø\"¿\…W)±[=@˝3É¯¿æ\"¿\∆Ç\\=@\≈;¿ìæ\"¿nP˚≠ù\\=@` ê°ª\"¿Yä\‰+Å\\=@,ú§˘c∫\"¿\‚w\”-;\\=@Uø\“˘∏\"¿Tb.\\=@\0oÅ≈∑\"¿\»\n~b\\=@\Z¯Q\r˚µ\"¿•-ÆÒô\\=@j0\r\√G¥\"¿w/˜\…Q\\=@Y\›\Í±\"¿2ZGU\\=@\ËJ™∞\"¿õ<e5][=@ú¡\ﬂ/Æ\"¿Rõ8π\ﬂY=@\n¢\Óê™\"¿\ÿfc%\ÊY=@h\\WÃ®\"¿H\√)sÛY=@•û°ºß\"¿–òI\‘Z=@og_yê¶\"¿\'k\‘C4Z=@¢búø	•\"¿ıæÒµgZ=@L6l±£\"¿EÒ*kõZ=@\ﬁs`9¢\"¿v\ﬁ\∆fGZ=@„•õ\ƒ †\"¿˚z\·\ŒY=@´\Á§˜çü\"¿àd»±ıX=@\Ë§˜çØù\"¿≤fdêªX=@≤,ò¯õ\"¿π®\≈X=@#[A”ö\"¿>^HááX=@˛&\"\‡ò\"¿¡\Zg\”X=@¢\r¿Dò\"¿RπâZöW=@(CUL•ó\"¿πä\≈o\nW=@\÷\‚S\0åó\"¿ŒßéUV=@5y\ j∫ñ\"¿à°\’\…V=@á3øöì\"¿\œh´í\»V=@-≤ùÔßé\"¿è8d\ÈV=@\‡/fKVç\"¿:3PW=@IC´ìã\"¿q\0˝æW=@j˘Å´<â\"¿)∞\0¶X=@\ﬁ\ ùeÜ\"¿…¨\ﬁ\·vX=@küé\«Ñ\"¿T5A\‘}X=@k∂ÚíˇÅ\"¿¬á-yX=@{h+Ä\"¿ys∏V{X=@>]›±\ÿ~\"¿\È)ràX=@sJ@L\¬}\"¿pîº:\«X=@\Œ«µ°b|\"¿g\‘|ï|X=@ÆõR^+y\"¿8†•+X=@Ec\Ì\Ôlw\"¿\‘,\–\ÓêV=@m6Vbûu\"¿µ2\·ó˙U=@˙zæfπt\"¿§´twùU=@-ò¯£®s\"¿U˜\»\Ê™U=@à\rNr\"¿Ö\Óí8+V=@ÖñuˇXp\"¿\–)\»\œFV=@ü\È%\∆2m\"¿I\ÿ\’\‰U=@˘ˆÆA_j\"¿˘*8ºT=@+/˘ü¸e\"¿¸ß(R=@ã˚èLáf\"¿¥[\Àd8R=@gE\‘Düg\"¿\€\ﬂ\ŸΩQ=@)\À«∫h\"¿0\⁄r.Q=@RIùÄ&j\"¿\'jinÖP=@sI\’vk\"¿[\\\„3\ŸO=@îº:«Äl\"¿ˇ∞•GO=@`\Á¶\Õ8m\"¿%ZÚxN=@\∆o\n+l\"¿{˘ù&3N=@∫.¸\‡|j\"¿ã72è¸M=@\Ÿ\\5\œi\"¿\Â}ÕëM=@≤H\Ô\0g\"¿ç\ÏJ\ÀHM=@\'K≠˜e\"¿*˛\Ôà\nM=@`Z\‘\'πc\"¿\Î»ë\Œ¿L=@nã2db\"¿ú\ƒ ∞rL=@?UÖba\"¿.ë\Œ\‡K=@\–\Ô˚_\"¿&\‚≠ÛoK=@ÑHÜ[_\"¿áâ)xJ=@\ﬁ\Ëc> `\"¿¢≤aI=@¿{Gç	a\"¿ì9ñw\’G=@∫N#-ï_\"¿z¸ﬁ¶?G=@A	]^\"¿∞Rb\◊F=@$^û\Œ]\"¿£:\»zF=@;®\ƒuå[\"¿}\Ê¨O9F=@\ÿ,óç\ŒY\"¿˜ ºU\◊E=@cÚò˘V\"¿\·@H0E=@\œK\≈\∆T\"¿\ÔVñ\Ë,C=@\“≠£™Q\"¿~ç$A∏B=@Q¡\·Q\"¿4\Á\ZB=@˛då≥O\"¿†¶ñ≠A=@¡\∆ı\Ô˙L\"¿$F\œ-tA=@\À;\≈J\"¿µ˙\Í™@A=@\Ô\…\√B≠I\"¿™û\Ã?˙>=@åˆx!F\"¿pUj>=@\—$±§\‹E\"¿:ÆFv•==@\ÏjÚîE\"¿∏\ÃÈ≤ò<=@>ñ>tAE\"¿FñÃ±º;=@.\Z2E\"¿Ògx≥;=@\„Q*\·	E\"¿v5y\ j:=@Ù¸i£:E\"¿}ñ\Á¡\›9=@‘ÄA“ßE\"¿HnM∫-9=@ÿÅsFîF\"¿5\—\Á£8=@\ÂõmnLG\"¿+MJA∑7=@\Ê\ÃvÖ>H\"¿>¥è¸6=@v≈åˆH\"¿Ø]\⁄pX6=@ÜKÆbI\"¿\Ô\…\√B≠5=@˙&MÉ¢I\"¿\Z\‰.\¬4=@DioÖI\"¿?\‡ÅÑ3=@ 	˚vI\"¿†˚rfª2=@$H•\ÿ\—H\"¿Pmp\"˙1=@\r\‡-êH\"¿úkò°Ò0=@wJ\ÎG\"¿{OÂ¥ß0=@ló6ñF\"¿î§k&\ﬂ0=@æ0ô*E\"¿Å\\\‚\»1=@\rƒ≤ôC\"¿Vc	k/=@›≥Æ\—B\"¿êø¥®O.=@æ3⁄™$B\"¿y\À’èM.=@\ﬂ¸ÜâA\"¿Ç\„2n.=@ù∫ÚYû?\"¿Q¢%èß-=@\\\Á\ﬂ.˚=\"¿ï\÷ˇ9,=@Z\‘\'π\√>\"¿x`\0\·+=@≤ûZ}u=\"¿ê\›J\n,=@U¯3ºY;\"¿\r\„n≠)=@ûï¥\‚:\"¿ΩTl\Ã\Î(=@q9^Å\Ë9\"¿Vc	kc(=@R\'†â∞9\"¿…ë\Œ¿\»\'=@k}ë–ñ;\"¿·ñè§§\'=@i©º\·<\"¿]åÅu\'=@˝-¯ß<\"¿µ\ﬂ⁄â&=@◊°öí¨;\"¿\›\—ˇr-&=@ìE\÷\Z:\"¿\"ƒï≥w\"=@()∞\06\"¿5$\Ó±Ù!=@\Z\‰.\¬4\"¿\'ºß> =@†\›!\≈\01\"¿î4Lk=@æ˜70\"¿±l\Êê\‘=@\…\Â?§/\"¿9+¢&˙=@\\1–µ/\"¿yïµMÒ=@\ËÖ;.\"¿!Æú=@i\‚\‡I+\"¿$cµ˘=@(ö∞\»\'\"¿∫Ù/Ie=@a5ñ∞&\"¿ü:V)==@ä:s	\'\"¿\Èπ- =@[	\›%q&\"¿W\ÍY\ =@EÚï@J$\"¿\‡\◊HÑ=@{1î\Ì\"\"¿^=1 =@VDMÙ˘ \"¿ö\nÒHº =@\ÕX\‰\◊\"¿-%\ÀI(!=@l\—¥≠\"¿¥≠fùÒ!=@¶±˙#\"¿;¨p\ÀG\"=@e8ûœÄ\Z\"¿\Â)´\Èz\"=@ﬁ™\ÎPM\"¿ˆyåÚ\Ã#=@›ï]0∏\"¿\◊Pj/¢%=@]›±\ÿ&\"¿\Èd©ı~\'=@âï\—\»\Á\"¿k) \Ì(=@ãRB∞™\"¿\»Eµà(*=@µ\ﬁo¥\„\"¿|\—/§+=@˜vKr¿\"¿\€P1\Œ\ﬂ,=@^ÇSH\"¿ú•d9-=@w;S\Ë\"¿]¿\À-=@◊•F\Ëg\"¿˝O˛\Ó-=@,amåù\"¿#0\÷70-=@\„˚\‚Rï\"¿}^Ò\‘#-=@o,(\ \"¿™\„n-=@∫¢î¨\n\"¿\‚Èï≤-=@;˝†.R\"¿l%tó\ƒ-=@\ÈC‘∑\"¿	•/Ñú/=@\Í{\r¡q\"¿\ ƒ≠Ç0=@Æe2\œˇ!¿Ä\Ô6oú0=@P≈ç[\Ãˇ!¿Y˜èÖ\Ë0=@qTn¢ñ˛!¿d<J%<1=@ïÇn/i¸!¿\ PS1=@”àô}˚!¿T\ƒ\È$[1=@H4Å\"˘!¿\Ó\"LQ.1=@¯â\Ë˜ı!¿\ﬂ¬∫Ò\Ó0=@t\ŒOq!¿\◊˚çv\‹0=@bôπ¿\Ì!¿\Á\‡ô\–$1=@\⁄T\›#õ\Î!¿á2T\≈T2=@\ÀJìR\–\Â!¿†ö≤\”3=@¢Ìò∫+\„!¿\⁄9\Õ5=@,(\ 4\‚!¿n¬Ω2o9=@í>≠¢\ﬂ!¿\ÂÄ]Mû:=@Ògx≥\ﬂ!¿mÀü;=@áP•\ﬁ!¿ıÉ∫H°<=@ıúÙæÒ\›!¿\⁄\…\‡(y==@s-ZÄ∂\›!¿O?®ã>=@\Îo	¿?\›!¿\"nN%?=@d> –ô\‹!¿òmß≠A=@\"ßØ\Á\€!¿kÒ)\0B=@˙aÑh\€!¿á‡∏åõB=@v\∆˜≈•\⁄!¿>x\Ì“ÜC=@SÕ¨•\ÿ!¿\÷\„æ\’:E=@ºZ\Ó\Ã\‘!¿ü>¯E=@\Ï\’[\”!¿Ç\„2nF=@ç$A∏\“!¿¿Dà+G=@3\¬€É\–!¿Æ∏8*7I=@\“˛X\À!¿™~•Û\·I=@¥Xä\‰+\…!¿ê‹öt[J=@\—\Œih\«!¿a\⁄9\ÕJ=@¨Uª&§\≈!¿c|òΩlK=@ÇTäç\√!¿\Ï\‹L=@[\Èµ\ŸX¡!¿|}≠KçL=@ˆ$∞9ø!¿\rRL=@d[ú•º!¿ûz§¡mM=@.X™xπ!¿\Ÿ\Î\›\ÔM=@\¬\⁄;\·µ!¿#\‹dTN=@;Qi≥!¿E\Ÿ[\ ˘N=@…í9ñw≠!¿ùc@ˆzO=@Ù\ﬁÄ´!¿có®\ﬁ\ZP=@˙{)<h¶!¿cÏÑó\‡P=@ã\ZL\√°!¿ÇUıÚ;Q=@xôa£¨ü!¿ÄD(bQ=@\≈t!Vú!¿JB\"m\„O=@£\…\≈Xw!¿X∆ÜnˆO=@\»(œºv!¿\’w~QÇR=@3‹Ä\œs!¿?»≤`\‚S=@≠á/s!¿û#Ω®U=@?9\ns!¿m±ü^=@`r£\»Zs!¿y=ò_=@\ÀÒ[r!¿nø|≤b`=@Ov3£m!¿m6Vbûa=@M\‡Ù.f!¿˚t<f†b=@7ßí†b!¿\‚ !\ d=@é\Ÿ\Î\›_!¿#Öñe=@\·ï$\œı]!¿\‡ÿ≥\Áf=@\÷µ\¬\\!¿\ŒQ\⁄g=@\…&p[!¿G\Ã\ÏÛi=@`#IÆX!¿9Ä~ﬂøi=@fÉL2rV!¿˙aÑhk=@ˆ%∂P!¿\Í46l=@çH¬æM!¿\Ï¢ËÅèm=@\r\Z˙\'∏H!¿(*\÷Tn=@òà∑ŒøE!¿jLàπ§n=@F~˝D!¿\∆G\Ân=@,=)ìB!¿≤^ÇSo=@íÒ+\÷@!¿\Ëı\'Òπo=@í]i©?!¿xEøïp=@É4c\—t>!¿¥\Á25	r=@8HàÚ=!¿É\‡Ò\Ì]s=@ß>êº;!¿ÜV\'gt=@K\ÀHΩß:!¿\¬˘‘±Ju=@oÖ\…T9!¿“åE\”u=@üZ}uU8!¿ä\ÈB¨˛x=@ú•d91!¿˘ˆÆA_z=@µ∆†B/!¿∞v\Á®{=@*U¢\Ï--!¿\Îò|=@∆Ünˆ*!¿sπ¡Pá}=@Ø!8.\„&!¿UΩ¸Nì}=@é={.S#!¿ØB\ O™}=@2\ÂCP5\"!¿0ûACˇ|=@Û=#\Z!¿\»\”ÚW}=@±£q®\ﬂ\r!¿}\"OíÆ}=@|E∑^!¿\—Wêf,~=@àº\Â\Í\«!¿˚Øs\”~=@~T\√~O!¿>>!;o=@ïÄòÑ!¿ó\»g=@›ï]0∏˛ ¿°-\ÁR\\Å=@ı˜Rx\–¸ ¿¯q4GVÇ=@-µ\ﬁo¥˚ ¿π˛]ü9É=@\≈V–¥\ƒ˙ ¿F@Ö#Hâ=@˘d\≈pu ¿#ø~à\rä=@µnÉ\⁄o\Ì ¿ü`<Éä=@eQ\ÿE\—\Î ¿\Ê\È\\QJò=@AÇ\‚«ò\À ¿£>+ö=@ú4\rä\Ê\… ¿ñ¥\‚\nõ=@\ﬂ3°\Ã ¿¯\ﬂJvlú=@\–\÷¡¡\ﬁ\Ã ¿ññëzOù=@∫fÚ\Õ6\œ ¿CV∑zNû=@e˛\—7i\“ ¿\Á\ﬂ.˚uü=@<jLàπ\‘ ¿\ZNôõo†=@°J\Õ\÷ ¿g\'É£\‰°=@Û<∏;k\◊ ¿(\‘\”G\‡£=@}îÄ\÷ ¿0Gè\ﬂ€§=@E,b\ÿa\‘ ¿|\”ÙŸ•=@^π\ﬁ6S\— ¿\∆¯0{Ÿ¶=@4Úy\≈S\œ ¿˙¥ä˛–®=@9\–Cm\Œ ¿Ä…êc´=@=‘∂a\Ã ¿|∑y„§¨=@ÉßZ\À ¿3•ı∑∞=@ÒGQg\Ó\… ¿9{g¥U±=@\–Ï∫∑\"\… ¿\› µâ≥=@M2rˆ\ƒ ¿KØ\Õ\∆J¥=@X\«ÒC•¡ ¿M\Ÿ\Èµ=@ÛsCSæ ¿≤Ù°\Íˇ=@\–Ú<∏;£ ¿\ÿál ï>@CçBíYu ¿JB\"m\„\√>@\"ú¡\ﬂg ¿',1607362055,1607362055,NULL,NULL),(8,'North-Western',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\0ô\0\0\‡ÚX32\‡:@ié¨¸2\‡*¿1Xr\ﬂ:@/\›$\·*¿∏>¨7j\›:@\r8K\…r\‚*¿.\…ªö\‹:@?ç{Û\„*¿MÜ\„˘\‹:@jà*¸\Ê*¿^có®\ﬁ\⁄:@§6qrø\Î*¿£t\È_í\⁄:@¬à}(\Ó*¿\‘~k\'\⁄:@£\Á∫Ò*¿bˆ≤\Ì¥\Ÿ:@ï+º\ÀEÙ*¿5	ﬁêF\Ÿ:@Mi˝-¯*¿46<\Ÿ:@Ö^ü˚*¿d\Ë\ÿ:@DæK©K˛*¿êgs\ :@€¢\Ãô,+¿>BÕê*\ :@êf,ö\Œ.+¿\È\Ô•†\…:@ü\ÁO\’1+¿c`\«\…:@e˚ê∑\\5+¿WÌöê\÷\»:@ZH¿\ËÚ6+¿G\Ëg\Íu\«:@πä\≈o\nS+¿eo)\Á\«:@ ôùûW+¿%\Ï\€ID\»:@⁄®NZ+¿\·|\ÍX•\»:@èQûy9\\+¿(\r5\n\…:@Jòi˚W^+¿-\Œ\ :@i˛ò÷¶a+¿2êgó\À:@˙’ë#e+¿©º\·¥\Ã:@\–cîg^f+¿«°~∂\Œ:@Å?¸¸˜h+¿l∞pí\Ê\œ:@\◊kzPPj+¿\Ô∫/g\“:@Û\Ã\Àa˜m+¿¶∂\‘A^\”:@\rç\'Ç8o+¿\Ê>9\n\Ÿ:@\„5Ø\Ít+¿Bóp\Ë-\⁄:@ØC5%Yw+¿†ä∑ò\€:@ÉNty+¿Ê≠∫\’\‹:@€¶x\\T{+¿X\«ÒC\›:@\‚\…nfÙ{+¿ˇ\"h\Ã$\ﬁ:@qN`:}+¿à¬£ç\ﬂ:@\–D\ÿÑ+¿äZö[!\‡:@£[Ø\ÈAâ+¿§\Ã&¿\‡:@Fy\ÊÂ∞ã+¿N^d~\·:@\ÍX•ÙLè+¿Fx{\‚:@\Ë\‹\Ìzií+¿ò˘~\‚:@\«fG™\Ôî+¿§6qrø\„:@å¯N\Ãzô+¿üàÇ\Â:@™úˆîúõ+¿†¡¶Œ£\Ê:@¯Ñú+¿îÄF\È:@öó\√\Ó;û+¿Éái\ﬂ\Ï:@#/kbÅü+¿R*\·	Ω\Ó:@z\Ô\«\Ìü+¿¨êÚìj\Ô:@J∂∫ú†+¿£\”0|:@8J^ùc†+¿\›BW\"PÒ:@ˇÇ\0°+¿¨\…SV\”Ò:@wˆï\È°+¿∆ãÖ!rÚ:@7\€§+¿-	PS\ÀÚ:@bôπ¿•+¿Ò\∆O\„Ú:@Ùm¡R]®+¿@QŸ∞¶Ú:@\Óïy´Æ´+¿µ2\·ó˙Ò:@\\t≤\‘zØ+¿\÷\0•°FÒ:@VE∏…®≤+¿(\ 4ö:@3\‚\–(µ+¿®\‚\∆-\Ê\Ô:@6#É\‹E∏+¿ %vmo\Ô:@|,}ËÇ∫+¿!…¨\ﬁ\·\Ó:@${Ñö!Ω+¿˚$w\ÿD\Ó:@´\œ\’V\Ïø+¿≤\ÿ&ç\Ì:@Çî0\√+¿fæÉü\Ï:@\‡º8Ò\’\∆+¿bıG\Ï:@\Ì\Ôlè\ﬁ\»+¿Œä®â>\Î:@b˘Ûm¡\ +¿˘0{\Ÿv\Í:@DN_\œ\◊\Ã+¿\0;7m\∆\È:@∆æd\„¡\Œ+¿0\⁄r.\È:@\Ëº\∆.Q\’+¿®5\Õ;N\È:@l{ª%9\ÿ+¿]˚z\È:@í\·\n(\‹+¿\Õ√πÜ\È:@â\n\’\Õ\≈\ﬂ+¿BôFìã\È:@Û!®\ZΩ\‚+¿ˇÕã_\È:@«∫∏ç\Ë+¿\¬Kp\Í\È:@eo)\Á\Î+¿óo}Xo\Ë:@Ö\…T¡+¿ˆD◊Ö\Ë:@!£ÀõÛ+¿+¡\‚p\Ê\Á:@˝/◊¢ı+¿•û°º\Á:@Å\œ#Ñ˜+¿DR%ì\Á:@}–≥Yı˘+¿O©e\Á:@èUJ\œÙ˙+¿.s∫,&\Ê:@[ôK˝¸+¿ò\⁄Ry\Â:@=\n◊£p˝+¿\Ô5&\ƒ\‰:@ﬂº8Ò˝+¿‘ö\Êß\‰:@uX\·ñˇ+¿;®\ƒuå\„:@¸4\Ó\Õo\0,¿Én/iå\‚:@®oô\”e,¿\⁄\…\‡(y\·:@)@Ãò,¿\‡⁄âíê\‡:@§ã¶,¿¢µ¢\Õq\ﬁ:@m\«\‘]\Ÿ,¿-]¡6\‚\›:@∂0\Ìú,¿n⁄å\”\›:@4⁄™$≤,¿®¶$\Îp\‹:@Ü1zn	,¿J¥\‰Ò¥\‹:@ zR&5,¿\Ì\Ôlè\ﬁ\‹:@eå≥ó\r,¿1@¢	\›:@ÒGT®,¿<\‹\rã\›:@˙ôz\›\",¿˝ÜK\ﬁ:@©ÉºL,¿\Î\Ÿ\\5\ﬂ:@9\‘\Ô\¬\÷,¿µ4∑B\‡:@TãàbÚ,¿8º \"5\·:@C±l\Ê,¿\Z\‡ÇlY\‚:@\0™∏q,¿j\€0\nÇ\„:@`!seP,¿Ω âv\Â:@\Ã*l∏ ,¿âõS\…\0\Ë:@∂e¿YJ&,¿dï\“3Ω\Ë:@éXãO(,¿\’w~QÇ\Í:@æ0ô*-,¿ªó˚\‰(\Ï:@\Ô\…\√B≠1,¿æ\ÿ{ÒE\Ô:@\Œ\ƒt!V7,¿Öô∂eÒ:@ôd\‰,\Ï9,¿¢F!…¨Ú:@8Ωã˜;,¿DmFAÙ:@c\n\÷8õ>,¿§\ﬁS9\Ìı:@\‡V*®@,¿.q\‰Å\»ˆ:@¨JCçB,¿¨9@0G˜:@FaED,¿\◊ˆvKr¯:@ÊØêπ2H,¿ka\⁄9˘:@N\'\Ÿ\ÍrJ,¿\Ê\À∞è˙:@<•ÉıN,¿nâ\\p˚:@\€¡à}P,¿¢\—\ƒ\Œ¸:@\Z˝h8eV,¿\Â`6Ü˝:@\…\ÁO=Z,¿øõn\Ÿ˝:@∞8ú˘\’\\,¿\Êv/˜˝:@m±^,¿\ÿI}Y\⁄˝:@P\„\ﬁ¸Üa,¿\Â\‘\Œ0µ˝:@ã®â>e,¿∂\÷	m˝:@{§¡mmi,¿L¶\nF%˝:@\÷{L§l,¿ˇ	.V\‘¸:@ïû\È%\∆r,¿l\\ˇÆ\œ¸:@)v4ıs,¿òÖvN≥¸:@x^*6\Êu,¿ì\‡\riT¸:@nä\«Eµx,¿!u;˚\ ˚:@l?\„\√|,¿sﬂâY˚:@{ˆ\\¶~,¿mêIF\Œ˙:@5Ò§\’,¿q„äã˜:@>¿x\’,¿6í\·\nÙ:@˛E–òI\‘,¿\⁄ ìåúÒ:@\ÀÙK\ƒ\”,¿F\Ì~\‡\Ô:@G\Ëg\Íu\”,¿\"S>U\Ô:@,cC7\”,¿u><Kê\Ì:@;\‚ê\r§\”,¿\r˛~1[\Í:@¶µilØ\’,¿˘£®3˜\Ë:@B#ÿ∏˛\’,¿DäM\Ë:@E|\÷,¿‘∑\Ã\È\Ê:@`sû	\’,¿ÇZ∫Ç\Â:@#-ï∑#\‘,¿^i©˜\‰:@\Â_\À+\◊\”,¿˛då≥\„:@!âóß\”,¿ç\Ó v\‚:@<FzQ\”,¿+j0\r\ﬂ:@\"oπ˙±\—,¿«ª#cµ\›:@m˙≥\—,¿0Ω˝πh\‹:@4Jó˛%\—,¿°jÙjÄ\⁄:@±\ZKX\”,¿Ù˙ì¯\‹\Ÿ:@\‹K\Z£u\‘,¿ÖÃïA\Ÿ:@ïa\‹\r¢\’,¿\Œ¬ûv¯\◊:@ÿûY†\÷,¿∂Ov3\◊:@a¸4\÷,¿.\≈Ue\ﬂ\’:@4ıª∞\’,¿{g¥UI\‘:@¿\Ì	\€\’,¿∂◊Ç\ﬁ\”:@Ø±KTo\’,¿Eøï\Ï\–:@’Øt><\”,¿MN\ÌS\œ:@I\Ô\0O\“,¿s€æG˝\Õ:@D•3˚\‘,¿k’Æ	i\Õ:@i¿\"ø\÷,¿ˆ_\Á¶\Õ\Ã:@ñvj.7\ÿ,¿<2Võˇ\À:@(Fñ\Ã\Ÿ,¿\Ã:ì\ :@ë\”\◊Û5\€,¿%ë}êe\…:@%]3˘f\€,¿ÉN\»:@\ÁUù\’\€,¿¡\«`≈©\∆:@x∏\Z\€,¿D4∫É\ÿ\≈:@c*˝Ñ≥\€,¿⁄´èáæ\√:@∑∂ºT\‹,¿öï\ÌC\ﬁ\¬:@4iSuè\‹,¿{ø—é\¬:@¯änΩ\ﬁ,¿÷ßì\≈¡:@ﬁÆó¶\‡,¿/àH¡:@L\∆1í=\‚,¿Ll>Æ\r¡:@%z\≈r\„,¿÷≠ûìﬁø:@>?å\Ê,¿T8ÇTäΩ:@æ**\Á,¿}w+ª:@≠L¯•~\Ê,¿\Ï1ë\“l∂:@\Î;ø(A\Á,¿E*å-µ:@sıcì¸\Ë,¿˛ú0a¥:@\“o_\Œ\È,¿G´Z\“Q≤:@\»?3à\Ï,¿3OÆ)ê≠:@\ 6p\Í\‰,¿˘gÒÅ©:@\'Ωo|\Ì\·,¿Ø\"£í®:@NA~6\‚,¿\√c\“ﬂß:@ò¿≠ªy\‚,¿yt#,*¶:@˜Ù¬ù\„,¿î\Ÿ ìå§:@´¥\≈5>\„,¿\⁄(∑\Ìü:@á\ZO\È,¿Öµ1v¬ü:@O\‹Û¸\È,¿q„äãü:@Ë°∂\r\Î,¿Å>ë\'Iü:@=‘∂a\Ï,¿RG\«\’»û:@\Î\„°\Ôn\Ì,¿≥\œcîgû:@\Ï´a\Ó,¿\œ\ŸB\Îù:@F;åI\Ô,¿ÖîüT˚ú:@ﬂåöØí\Ô,¿Øµ˜©*ú:@Ø&OYM\Ô,¿¿x\r˝õ:@\Á\∆ÙÑ%\Ó,¿bfü\«(õ:@\ÁS\«*\Ì,¿\0\≈»í9ö:@	\›%qV\Ï,¿\‚\ \Ÿ;£ô:@≥)Wxó\Î,¿[”º\„ô:@#†\¬§\Í,¿\Ê \ËhUó:@\Œ›Æó¶\Ë,¿ˇ\Ëõ4\rñ:@É§O´\Ë\Á,¿êO\»\Œ€î:@(`;±\Á,¿ÜKÆí:@í<\◊˜\·\Ë,¿\Óî\÷ˇë:@iä\0ßw\È,¿ß$\Îptë:@≠1\ËÑ\–\È,¿\¬z˝Iê:@∂ù∂F\Î,¿/ÖÕÆè:@-ò¯£®\Î,¿í=BÕêé:@Ö$≥zá\Î,¿™\’WWé:@T»ïz\Ï,¿.=ö\Í…å:@\‚©i\Ô,¿ÖñuˇXå:@\…\Ê™yé,¿=bÙ‹ä:@\›(≤\÷PÚ,¿\ÊtYLlä:@îôÄ_Û,¿eT\∆›à:@\„\ƒW;äÛ,¿5%Yá£á:@D6ê.6ı,¿ﬁ´V&¸Ü:@êΩ\ﬁ˝Òˆ,¿8Öï\n*Ü:@EGr˘˘,¿êj\ÿÔâÖ:@|¥8cò˚,¿7ñ~Ñ:@ã®â>˝,¿≤à\◊ıÉ:@0e\‡Ä˛,¿C∆£T¬É:@	Qæ\0-¿”æπÉ:@ú\ﬁ\≈˚-¿<ÑÒ”∏É:@˙~jºt-¿\»\Ôm˙≥É:@GØ(\r-¿\ ˘b\Ô≈É:@7ﬂà\ÓY-¿jâï\—»É:@QMI\÷\·-¿bg\nùÉ:@\‰Ùı|\Õ\n-¿sÖwπàÉ:@Kí\Á˙>-¿2\"QhYÉ:@åHZ\÷\r-¿ªDı\÷¿Ç:@°ıe¢-¿Q0c\nÇ:@}ñ\Á¡\›-¿x‘òsÅ:@2ì®|-¿/àHM:@≥\Ôä\‡-¿≥öÆ\'∫~:@\‘-¨-¿û]æıa}:@\—`\"-¿K\ÊX\ﬁU{:@\‹Ò&øE-¿A*≈é\∆y:@¶`ç≥\È-¿W\nÅ\\\‚x:@ıç\Ó-¿fg\—;x:@ÑÉΩâ!-¿.T˛µºv:@0ôÚ-¿n4Ä∑@v:@©ÉºL\Z-¿ê§§á°u:@\÷ˆB-¿F\Î®jÇt:@«õ¸ù-¿\Ë\⁄\–s:@\›|#∫g-¿ôöoHs:@\Œqn\Ó-¿@¿Zµkr:@z˝I|-¿\€\ﬂ\ŸΩq:@e\«F ^-¿ß<∫q:@≤I~ƒØ -¿™πnp:@é\Ê\»\ /#-¿ÅC®R≥o:@D•3˚$-¿a\·$\Õo:@∑}è˙\Î%-¿\Ïk]jÑn:@ê˜™ï	\'-¿¥9\Œm\¬m:@º#cµ˘\'-¿áS\Ê\Êm:@ìqådè(-¿ÿö≠º\‰k:@`r£\»Z+-¿jæJ>vk:@5|\Î.-¿)x\nπRk:@ÉR¥r/0-¿ﬁ≠,\—Yj:@voEbÇ2-¿ÛW\»\\i:@˜u\‡ú5-¿åL¿Øëh:@*¨ˇs8-¿\ƒ^(`;h:@dT8:-¿¶\—\‰bh:@fıÇO;-¿±RAE\’g:@\€e6\»<-¿¡®§N@g:@öµêˆ?-¿x\'ü\€f:@\Ìcø\rA-¿k\ÿ\Ôâuf:@\Ÿ\Ó@ùB-¿MK¨åFf:@\…:]•C-¿ÿÄqe:@∞\Ê\0¡E-¿{¯2QÑd:@\‰ˆ\À\'+F-¿\‚X∑a:@Úî\’t=I-¿çúÖ=\Ì`:@\Ìô%jJ-¿g\‘|ï|`:@\0™∏qK-¿_\ŒlW\Ë_:@ZÅ!´[M-¿±¡\¬Iö_:@\“\·!åüN-¿∑ñ\…p<_:@…è¯kP-¿IK\Â\Ì_:@ì\·x>R-¿ˇ±_:@*sÛç\ËV-¿\ÍÕ®˘^:@i˝-¯W-¿Ü:¨p\À_:@ôa£¨\ﬂ\\-¿Æ™\rN`:@\È\Ì\œEC^-¿@ø\Ô\ﬂ`:@´ï	ø\‘_-¿i¢≤a:@\¬QÚ\Íc-¿Zûwga:@\÷8õé\0f-¿ñ{ÅY°`:@\∆˝G¶Cg-¿í@ÉMù_:@Â¥ß\‰úh-¿˚\"°-\Á^:@˛Ò^µ2i-¿õ\‚qQ-^:@-zß\Ói-¿¥≠fù]:@∑\—\0\ﬁj-¿rßt∞˛[:@±l\Êêl-¿w†NytW:@\"4Çç\Îo-¿2Àû6W:@õ\…7\€\‹p-¿∑\Ó\Ê©V:@,\÷pë{r-¿∑µÖ\ÁU:@¿œ∏p t-¿\Ë/Ùà\—S:@lÀÄ≥ît-¿ÒbaàúR:@h\œejt-¿\¬5wÙøP:@]©gA(o-¿ÒÄ≤)WP:@\–Ò\—\‚åi-¿\—z¯2QP:@˙cZõ\∆f-¿;\√‘ñ:P:@\Ë§˜çØe-¿\ﬁ	äO:@Fó7ác-¿\Zâ\–6N:@M1AGc-¿/£XniM:@£h[\Õb-¿‚±ü\≈RL:@v5y\ b-¿e\ZMJ:@h∞b-¿àÅÆ}I:@‘∑\Ã\È≤`-¿ÄÇã5H:@˚Zó\Z°_-¿[^π\ﬁ6G:@í\Ã\Í^-¿@˜\Â\ÃvE:@W\Œ\ﬁm]-¿xπà\Ô\ƒD:@(N>]-¿ˆ\–>VC:@l\ndv]-¿\Ë\‰g#C:@JóU\ÿ\\-¿Oyt#,B:@Jó˛%©\\-¿T˛µºrA:@u\«bõT\\-¿£\ 0\ÓA:@\œ˜S\„•[-¿Å^∏sa@:@°ˆ[;QZ-¿L¬Ö<Ç?:@\…\…ƒ≠ÇX-¿a3¿\Ÿ>:@T^-W-¿C9—ÆB>:@\Z¶∂\‘AV-¿äê∫ù}=:@\–^}<ÙU-¿T∆øœ∏<:@(õrU-¿ºX\"ß;:@\ﬂ,\’T-¿ß…å∑ï::@ìr˜9>R-¿eo)\Áã9:@@KW∞çP-¿EÉ<Ö8:@´	¢\ÓP-¿`\…U,~7:@˜èÖ\ËP-¿&9{6:@ƒòÙ˜RP-¿R\◊\⁄˚T5:@ˇ!˝ˆuP-¿}zlÀÄ3:@nƒì\›\ÃP-¿0πQd≠1:@˛\”\rP-¿∫Û\ƒs∂0:@5a˚\…O-¿ë(¥¨/:@\Â`6ÜM-¿,H3M/:@\Îˇ\ÊK-¿˚îc≤∏/:@F\Í=ï\”F-¿,ù\œ0:@i∆¢\ÈD-¿Sv˙A]0:@^¸o%C-¿IÑ+†0:@o\rlï`A-¿\’Y-∞\«0:@˝/◊¢@-¿£êdV\Ô0:@≥ïó¸O>-¿S\À\÷˙\"1:@\r9∂û!<-¿T˜<\¬9@≥	0,-¿RÚ\Íñ9@ﬂº8Ò-¿P´îûï9@.¯ßT-¿º\Õ\'Öç9@F\Œ¬ûv-¿T\‚:∆â9@y≠Ñ\Óí-¿mˇ\ JìÜ9@óè§§á-¿\Ïæcx\ÏÉ9@ˇíT¶ò-¿QßìlÅ9@&r¡¸-¿ß\ÏÙÉ∫|9@´í\»>\»\Z-¿\Ì\’\«C\ﬂy9@\…\«\Ó%-¿ƒ¨Cu9@\rP\Zj\"-¿$_	§\ƒr9@r1\÷q$-¿\«bõT4n9@˙Gﬂ§i(-¿[{k9@o/iå\÷)-¿ó‚™≤\Ôf9@Ò\‘#\rn+-¿gC˛ôA\\9@øôò.\ƒ*-¿0ôÚ!X9@g\r\ﬁW\Â*-¿ív£è˘T9@\ÁrÉ°+-¿«∫∏çN9@2!Êí™--¿Ûë\ÔRJ9@6<ΩR.-¿ßŒ£\‚ˇF9@p\Õ˝//-¿⁄é©ª≤;9@Sz¶ó3-¿/Ö\Õ69@3SZK8-¿É5Œ¶#49@rk\“mâ<-¿$}ZE09@Fò¢\\\Z?-¿¸¸˜\‡µ+9@,\’º<-¿\«/ºí\‰%9@a\ﬂN\"\¬?-¿\»{\’ Ñ#9@\◊\€f*\ƒC-¿û\—V%ë9@ø\”d\∆\€B-¿\ËÖ;9@≥\—9?\≈A-¿DO §Ü9@\0\‰Ñ	£A-¿Ωm¶B<9@“åE\”\ŸA-¿ØyUgµ9@Ú\È±->-¿dvΩS9@@¿Zµk:-¿YO≠æ9@?˝gÕè7-¿·∂∂º\09@\Â|±˜\‚3-¿§q®ﬂÖ˝8@aàúæû/-¿Yá£´t˚8@y\È&1,-¿x\Ô®1!˙8@˝Ùü5?&-¿Ä\÷¸¯K˚8@\‡ÇlYæ-¿\r\‡-ê¯8@\“\ZÉN-¿ıf\‘|˘8@´x#Û\»-¿\"OíÆô¯8@p∂π1=-¿í=BÕê˙8@{ÙÜ˚\»\r-¿`tys∏˙8@Öyè3M-¿NôõoD˚8@\Êv/˜-¿\ŸÉk\Ó¸8@à/EH˝,¿M˜:©/ˇ8@†˘úª]˜,¿qˇë\È\–9@`¨o`rÛ,¿˘˜9@/0+\È\Ó,¿\œJZÒ\r9@L\ﬁ\03\ﬂ\È,¿\∆\√{,9@òN\Î6®\Â,¿•M\’=≤	9@çF>Øx\‚,¿¡7Mü9@∂0\Ìú\ﬁ,¿5\‘($ô\r9@ß\ÀbbÛ\Ÿ,¿\ÃC¶|9@ˆ&Ü\‰\‘,¿I+æ°9@\◊˙\"°-\œ,¿≤\÷Pj/9@ãl\Á˚©\…,¿N\–&áO9@\»_Z\‘\'¡,¿÷©Ú=#9@\‡ª\Õ\'Ω,¿oıúÙæ9@\÷\…ä;∂,¿6\Â\n\Ôr9@±¸˘∂`±,¿åh;¶\Ó\Z9@®éUJœ¨,¿ª_¯n9@?74eßß,¿^¢zk`9@\‘\’ãm¢,¿ôa£¨\ﬂ9@´\ŒjÅ=û,¿˙∂`©. 9@°J\Õhù,¿˙C3OÆ!9@\›ãäò,¿3OÆ)ê!9@SuèlÆí,¿≤Åt±i9@^i©˜å,¿¿ñWÆ∑9@˜V$&®Å,¿.9\Óî\Z9@/Ü\»\È{,¿\Óïy´9@µ3Lm©{,¿zq\»\Z9@M¯•~\ﬁt,¿ÑÄ|	9@\Œ\ZºØ\ m,¿+hZbe9@=∏;k∑m,¿\”lá¡9@Ø|ñ\Á¡m,¿\·zÆG\r9@µ¸¿Uûp,¿\‰.\¬\Â\n9@&7ä¨m,¿	Qæ†Ö9@Sï∂∏\∆o,¿\ÿl9@1^Û™\Œj,¿J@L¬Ö9@\"˚ ÀÇi,¿æ.\√∫9@Q/¯4\'g,¿‹ùµ\€˛8@D¢–≤\Óg,¿\÷\‡}U.¯8@\ÂDª\ni,¿\·\ÁS\«ˆ8@\Z\ﬂó™d,¿‚è¢\Œ\‹Û8@På,ôc,¿¯¨8Ò8@Ã∂\”÷à`,¿\‚ìN$ò\Ó8@\r•ˆ\"\⁄^,¿\‚\‡I\Î8@∏t\Ãy\∆^,¿¨p\ÀGR\Í8@-\È(≥Y,¿\—6Æ\Á8@f1±˘∏V,¿TåÛ7°\‰8@oB@æT,¿!ÙlV\·8@ZF\Í=ïS,¿qTn¢ñ\ﬁ8@í±\⁄¸øR,¿*™~•Û\Ÿ8@ÈπÖÆDP,¿EKO\À\◊8@∞èN]˘L,¿\ƒÕ©d\0\‘8@OÅ?¸L,¿\Ÿyõ\—8@æ\⁄Qú£N,¿ä\„¿´\Â\Œ8@∏u\ K,¿6\Â\n\Ôr\Õ8@bN\–&áG,¿{1î\Ì\∆8@\Œn-ìA,¿\Ô%\ƒ8@[]N	àA,¿}\Î\√z£\¬8@^Å\ËIô<,¿\Ÿ^zo¿8@}> à8,¿w\‹ª\Èæ8@ëÅ<ª|3,¿v™|\œHº8@íç`\„2,¿âaá1\Èª8@ã\≈o\n+-,¿ãâ\Õ«µΩ8@&åfe˚(,¿:Ø±KTø8@ˆ\n\Ó$,¿õôùEø8@±£q®\ﬂ,¿êf,öŒæ8@#/kbÅ,¿\√(ﬂæ8@Çç\Î\ﬂı,¿¡nÿ∂º8@\nÜs\r3,¿π´Wë—π8@F}í;l,¿¸5Y£∂8@¿\Õ\‚\≈\¬\0,¿LnYk¥8@Ùáfû\\˚+¿\Ìa/∞±8@çÒaˆ≤ı+¿É§O´∞8@\Ô%+¿H\·zÆ´8@r¬Ñ—¨\Ï+¿¶(ó∆ß8@?¯˘\Ô+¿=∏;k∑•8@ó©IÜÙ+¿77¶\',•8@VÛë\Ô˙+¿\ÌHıù_§8@;é*ç\0,¿âõS\…\0†8@≠C9\—˛+¿¿u≈åû8@EKO\À˜+¿øªï%:ü8@\ƒ\·\—\∆Ò+¿eçzàFü8@\—`\"\Ï+¿ùÚ\ËFXú8@\¬\¬Iö?\Ó+¿u\0\ƒ]Ωö8@∑e•I\È+¿lìä\∆⁄ó8@:\ÎSé\…\Í+¿º\Õ\'Öô8@GZ*oG+¿¨\·\"˜tô8@\√ç\'Ç¯+¿’±JÈôñ8@\Î9\È}\„˚+¿G\Êë?î8@¿±g\œı+¿\ `\Ê;ê8@¬Ñ—¨l˜+¿•h\Â^ê8@»óP¡Ò+¿’ì˘Gﬂå8@°l\\ˇ\Ó+¿®\ƒuå+ä8@~7›≤C\Ï+¿36t≥?à8@Ó∞â\Ã\\\Ë+¿d\Êó«Ü8@\’\–`\‚+¿Ù©cï“É8@;oc≥#\›+¿Ø\ÎÏÜÅ8@«úg\ÏK\÷+¿\”\ÿ^z8@\÷;\‹\r\”+¿Ø`Òd{8@\"ƒï≥w\ﬁ+¿<Ö\\©{8@\‡i2\„m\Â+¿ê¡äS≠y8@!:é\Í+¿(÷©Ú=w8@\Ï@1≤\Ï+¿GUD\›s8@jK\‰ı\Ë+¿:\Ëq8@\"\„Q*\·\È+¿\ÿJ\Ë.âo8@Ü9Aõ\Ó+¿wL›ï]l8@7\„4D\Ó+¿\ﬁ\»<Úk8@%Æc\\q\È+¿≠jIG9h8@¸6\ƒx\Â+¿}\\*\∆e8@=c_≤Ò\Ë+¿q:\…Vc8@ta§µ\Î+¿∏Ö\ÎQ`8@k$	\Í+¿L\‡\÷\›\\8@¸Q‘ô{\Ë+¿8hØ>Z8@•ÙL/1\Ê+¿|¥8còW8@y\r˝\‰+¿z»îAU8@kbÅØ\Ë\ﬁ+¿`ù∫V8@:œÑ&\Ÿ+¿J\‘>\ÕU8@m´Yg|\œ+¿’íér0S8@~bº\Ê\Õ+¿<KêPQ8@Zπò\ +¿\œf\’\ÁjO8@-`∑\Ó\Œ+¿\“mâ\\pN8@\‡d∏\’+¿ë(¥¨˚O8@j¿ \È\”\⁄+¿\“\ZÉNQ8@\ƒÕ©d\0\‡+¿Ø≤∂)N8@Äcœû\„+¿\‰ºˇèJ8@\'g(\Óx\„+¿¢{\÷5ZF8@;q9^Å\‡+¿\⁄V≥\ŒD8@∞´\…SV\€+¿∫Ω§1ZC8@p¥\„Ü\ﬂ\’+¿dì¸à_=8@\nö]˜\÷+¿kEõ\„\‹>8@ƒ¨C\—+¿\Z˘º\‚©;8@\ÀGR\“\√\–+¿!\‰K®88@Œâ=¥è\’+¿\‚\ \Ÿ;£58@ò•ùö\À\’+¿Æ-</38@\ ¥êÄ\Ÿ+¿h\Íuã¿08@\Z8\Ÿ\ﬁ+¿˘£®3˜,8@ê\ÂZ\‡+¿n£º*8@VÅZ\ﬁ+¿§™	¢\Ó\'8@ïÑ^\‚+¿\Ã^∂ù∂&8@\n\⁄\‰I\Á+¿\÷5ZÙ$8@É0∫\Ï+¿Ä,Dá¿!8@\"\‚\ÊT2+¿\÷\ƒ_\—8@\Œ\‡\Ô≥\Ì+¿Ø[\∆˙\Z8@\◊\‹\—ˇ\Í+¿Dà+g8@˜_òL\Â+¿*ènÑE8@t}\‚+¿1a4+\€8@xœÅ\Â\È+¿ú4\rä\Ê8@>Y1\\+¿âõS\…\08@©\ﬁ\Z\ÿ*˘+¿`\«Å 8@u\ËÙº˚+¿]\‹Fx8@©h¨˝ùı+¿ówJ8@£w*\‡û\Ô+¿Ò∑=Ab8@\Á\·¶\”Ú+¿tó\ƒY	8@é¯+¿\≈oÚ[8@2:=\Ô˛+¿|\Ôo\–^8@\œ\‹C\¬˜˛+¿4.\…8@™ÇQIù\0,¿%Ø\Œ1\08@¡\„\€,¿\ÿál ˝7@≠\¬fÄ,¿OWw,∂˘7@øõn\Ÿ,¿L\ﬁ\03\ﬂı7@`X˛|[\0,¿;åIÛ7@†˚rf˚+¿Ò[z4Ò7@\n°É.\·¯+¿\„\√\Ïe\Ô7@&\ƒ\\Rµ˝+¿û^)\À\Î7@á\Ÿ\Œ˜˚+¿IÖ±Ö \Á7@\"rl=˚+¿?ˇ=x\Ì\‚7@o\◊KS¯+¿°1ì®\‡7@Î´´µ¯+¿ÚxZ~\‡\ﬁ7@r˝ª>s˛+¿1\nÇ«∑\€7@∞\‰*ø,¿q™µ0\Ÿ7@bÅØ\Ë\÷,¿5&\ƒ\\R\’7@!sePm\0,¿`?\ƒ\”7@\¬i¡ãæ˙+¿¿z‹∑Z\”7@s÷ßìı+¿∂æHh\À\—7@\—6Æ\Ô+¿|ds\’<\œ7@\Ã\“N\Õ\Â\Ó+¿EJ≥y\Œ7@ÙÂôóÛ+¿\'¡“®\Ã7@\€˚T\Z¯+¿åjQL\ 7@wı*˙+¿líÒ+\∆7@	O\Ëı\'˘+¿]oõ©\√7@™\…¯+¿`êÙi¡7@fº≠Ù\⁄¸+¿xF[ïDæ7@,\r¸®Ü,¿Úñ´õº7@´≥Z`è	,¿ªE`¨o∏7@=Y§â,¿ÄD(bµ7@	√Ä%W,¿rRò˜8≥7@\ÎR#Ù3\r,¿;±O\0±7@,‘ö\Ê,¿v\Zi©º≠7@4\ÿ\‘yT,¿?\«Gã3™7@\€˜®ø^	,¿6uˇß7@ì©ÇQI\r,¿ÒF\Êë?§7@f/\€,¿¶(ó∆ü7@Éˆ\Í\„°,¿\ﬂm\ﬁ8ù7@2\„m•\◊,¿\‰0òøBö7@V-≤ù,¿\‹xò7@\Ã\–x\"à,¿Ò°DKó7@9∏t\Ãy,¿àÙ\€◊Åì7@HõV\Z,¿_]®≈ê7@J+á,¿QàÄC®é7@±√òÙ˜\",¿&7ä¨5å7@ø\'÷©Ú%,¿Sñ!éuâ7@æ˜7(,¿jMÛéSà7@\Ìõ˚´\«-,¿ÅŒ§M’Ö7@P@ø\Ô/,¿óqSÉ7@U†Éá1,¿\¬\¬Iö?~7@ì®|ö3,¿e¸˚å{7@@£t\È_2,¿5*p≤\rx7@d<J%<1,¿∫ıöt7@/6≠1,¿ìÜV\'o7@µß\‰ú\ÿ3,¿}í;l\"k7@\Ó≥\ Li5,¿nh\ N?h7@¥™%\Â8,¿˚?á˘Úf7@ò¬Éf\◊=,¿ëπ2®6d7@L7âA`E,¿Ä*n\‹bb7@H≈´¨M,¿\”2R\Ô©`7@\“\¬e6S,¿cc^G^7@G\Ã\ÏÛU,¿bº\ÊUY7@˚ı\◊+T,¿\Ô´r°V7@™ùajKU,¿>\Õ…ãT7@\Z£uT5Q,¿¯ßTâR7@_	§ƒÆU,¿i®QH2O7@˘\Ÿ\»uS,¿v¸L7@j\”L˜R,¿ß>êºK7@Øó¶pZ,¿òjf-H7@¸UÄ\Ô6_,¿@3à\ÏD7@\÷µ\¬Ù],¿(µ\—v@7@\ ¸£o\“\\,¿ÖÏºç\Õ>7@4Jó˛%a,¿\„›ë±\⁄<7@\Ëj+ˆóe,¿$a\ﬂN\":7@˜u\‡úe,¿\–\ÓêbÄ87@óé9\œ`,¿†Nyt#87@ü\"áàõ[,¿oÚ[t≤87@\ËyíT,¿M\‹*àÅ67@#§ng_Q,¿˙B\»yˇ37@ˆ\–>VS,¿\Í\Ã=$|37@®W\ 2\ƒY,¿Òün†¿/7@$¥\Â\\ä[,¿2rˆ¥/7@ÑÄ|	U,¿ö\–$±§07@6\È∂D.P,¿9\n327@Kë|%H,¿’ó•ùö37@o\‘\n\”˜B,¿\„§0\Ôq67@\Œ˛@πm?,¿y@Ÿî+<7@ï∑#ú,,¿•M\’=≤=7@0ˆ^|\—&,¿πoµN\\>7@\‰J=B!,¿Ω˛$>w>7@x~QÇ˛\Z,¿˝ù,µ>7@!ìåúÖ,¿\·+Ÿ±=7@í;l\"3,¿ãS≠ÖY<7@ }ì¶A	,¿∂ˆ>UÖ:7@úoD˜¨,¿(\r5\n97@ˆ\Ô˙\ÃYˇ+¿ˆ`R||67@Fx{,¿\⁄À∂\”\÷47@MLbı,¿â\ÓY\◊h17@˜>UÖ\n,¿Jy≠Ñ\Ó.7@Ù\ﬁÄ,¿˜êΩø)7@d]\‹F,¿ a∞\‰&7@Ú|‘õ,¿Lé;•É!7@H5\Ï˜\ƒ,¿t^có®7@LnYk,¿j˚WVö7@\n∫Ω§1\n,¿¯7hØ>\Z7@4Ü9Aõ,¿\·¥\‡E_7@≤e˘∫ˇ+¿X:û%7@,\÷pë{˙+¿Çè¡äS7@\Ó≤_w∫˚+¿¡6\‚\…n7@É\√\"R˚+¿\€kA\Ôç\r7@x\—Wêf¸+¿EˆAñ7@%\…s}˛+¿µ\√_ì57@#Ω®›Ø,¿x\Ô®1!7@∑åı\r,¿∫ˆÙ\¬˝6@ºˇ+¿°ÅX6s¸6@˛++MJ˘+¿Ñ) •Ò˚6@\ﬁ\Â\"æÛ+¿\È|xñ ˚6@)_\–B\Ó+¿$Äõ≈ã˘6@É5Œ¶#\Ë+¿z\¬(˜6@…≠I∑%\‚+¿n\‡\‘)Û6@\'3\ﬁVz\›+¿_~ß…å\Ô6@MáNœª\Ÿ+¿øò-Y\Ì6@O\Î6®˝\÷+¿Zûwg\È6@1µ•Ú\“+¿?6…è¯\Â6@c`\«\œ+¿¶a¯àò\‚6@4d<J%\Ã+¿x\–\ﬂ6@ÖñuˇX\»+¿õî¢\Ÿ6@{ıÒ\–wø+¿Ùäßi\Ã6@p∞71$\◊+¿ˆaΩQ+\»6@¯P¢%è\◊+¿\√§R\Ï\ƒ6@f2\œg\ÿ+¿qxµ\‹¡6@\Í∞\¬-\Ÿ+¿\ﬂm\ﬁ8)∏6@~ç$A\0,¿#k$µ6@N`:≠\€\0,¿^ü9\ÎS≤6@(†\ﬂ˜ˇ+¿æ-X™´6@°L£\…\≈¯+¿,πä≈ß6@\Àh\‰Ûäˇ+¿IÚ\\ﬂáß6@&U\€Mı+¿è\√`˛\n•6@ß;O<gÛ+¿Ze¶¥˛¢6@c\ÓZB>+¿\‚∂Ù†6@¿%\0ˇî\Í+¿\Ë\‰g#ü6@ø∏T•-\Ê+¿èç@ºÆõ6@2\ÂCP5\Í+¿$|\Ôo–ö6@	\≈V–¥\‰+¿\ÃDR∑ó6@P\Zjí\‰+¿êe¡\ƒï6@9{\⁄\·\ﬂ+¿KW∞çxí6@G¨≈ß\0\‡+¿¡nÿ∂(è6@!≠1\ËÑ\‡+¿\ﬁt\ÀÒã6@YiR\n∫\›+¿ëöv1Õà6@j¿ \È\”\⁄+¿\Œ7¢{÷Ö6@?˝gÕè\◊+¿†‹∂\ÔQÉ6@ÆG\·z\÷+¿$D˘ÇÇ6@\Îé\≈6©\–+¿A\Ôç!\0Ä6@ù‘ó•ù\ +¿A,õ9$}6@ú\ƒ ∞r\»+¿\€\√^(`{6@!\‰ºˇè\√+¿\Á™yé\»w6@tB\Ë†K¿+¿Àùô`8s6@C ó8Ú¿+¿Çoö>;p6@∏t\Ãy∆æ+¿!\Â\'\’>m6@\Ô≠HLPª+¿∏¨\¬fÄk6@\⁄sôö∑+¿u\»\Õpj6@˙\ÃYü≤+¿ke\¬/ıg6@êj\ÿÔâ≠+¿\÷ˇ9Ãóc6@≤úÑ\“™+¿tDæK©_6@*S\ÃA–©+¿\'\ﬁû¥\\6@¥¶+¿¢|A[6@Óµ†˜∆†+¿ZûwgY6@æü\Z/›ú+¿\«\‘]\ŸW6@&6◊Üö+¿\Ì\ÿ\ƒ\ÎR6@ıd˛\—7ô+¿m˝Ùü5O6@;TSíuò+¿|c\0éM6@\"9ô∏Uê+¿n˚ı\◊K6@=∑–ïå+¿7l[î\ŸH6@?ˇ=x\Ìä+¿fÙ£\·îE6@\ÏàC6êÜ+¿ûéíWC6@Wzm6VÇ+¿ˇë\È\–\È=6@ﬁêFN~+¿UÑõå*;6@\Ìõ˚´\«}+¿^0∏\Êé66@¨™óﬂÅ+¿êÑ};â46@˝KRôbÜ+¿@àd»±16@_\‘\ÓWÜ+¿…´s\».6@}#∫g]É+¿\Ó˚Øs+6@5\'/2á+¿Úaˆ≤\Ì(6@˙	g∑ñâ+¿\À/É1\"%6@\r¶a¯àà+¿+\›]gC\"6@Ã∑>¨7Ç+¿åi¶{ù6@lµáΩPÄ+¿ì:MÑ6@\r5\nIfÖ+¿\'L\Õ\ 6@\œdÑ+¿\Î∆ª#6@{†≤Ç+¿ä¯¨6@£xïµMÅ+¿\’\Ì\Ï+\n6@u \Î©\’+¿x\–6@Yß\ ˜å|+¿At\Ì6@Jô\‘\–x+¿¯Q\r˚=6@≥\Ôä\‡s+¿QN¥´ê˛5@àΩP¿vp+¿gsÇ˙5@ÒÉÛ©cm+¿q\Ë-\ﬁ˜5@ïÒ\Ô3.l+¿Ñcñ=	¯5@\ÀHΩßrj+¿?é\Ê\»\ ˜5@ñw\’\Ê\·*¿æ_¥\«˜5@YãO0\ﬁ*¿ıÙ¯\√˜5@Ò)\0\∆3\0*¿\Ã\Ì^\Óì6@)îÖØˇ)¿|\r¡qõ6@ã•Hæ\0*¿ä\"§ng∑6@∑’¨3æˇ)¿\rU1ï~\Z7@≥?Pn\€ˇ)¿\"\„Q*\·Ö7@¯UπP˘ˇ)¿ˇwDÖ\ÍÜ7@uwù\r˘ˇ)¿i\‡G5\Ïˇ7@zãá˜\0*¿\…ZC©Ω8@\È!\Á˝ˇ)¿&U\€M\r8@\Î\√z£V\0*¿ˇ]ü9\Î8@˙Gﬂ§i\0*¿Ot	8@˝\‹–îù˛)¿#†\¬§8@∫\Ÿ(∑˝)¿S\Î˝F;8@gö∞˝¸)¿ ∑_>Y\r8@øG˝ı\n˚)¿1òøB\Ê\n8@@¸¸˜\‡ı)¿%\ÊYI+\n8@\‹,^Ù)¿32\»]Ñ	8@/àHMÛ)¿6#É\‹E8@p_\ŒÒ)¿æ˙x\Ëª8@tFîˆ\Ô)¿uèlÆö8@õ.»ñ\Ì)¿g†‹∂8@\\¨®¡4\Ï)¿F–òI\‘8@S?o*R\È)¿FD1y8@ˇ[…é\Â)¿√ü\·\Õ\Z8@f¿YJñ\„)¿˘†g≥\Í8@\r˛~1[\‚)¿âBÀ∫8@VIdd\·)¿CV∑z8@]•ª\Îl\‡)¿\‰eM,8@G=D£;\‡)¿ ä\·\Í\08@\·\œf\r\ﬁ)¿-\Ïiáø8@+KtñY\‹)¿h?RDÜ8@%;6Ò\⁄)¿ôcyW=\08@åæÇ4c\Ÿ)¿5%Yá£ˇ7@ñ\—\»\Á\◊)¿F^\÷\ƒˇ7@t—êÒ(\’)¿MhíXR˛7@∂∫ú\”)¿Üí…©ù˝7@C¨˛\√\–)¿õsÙ¸7@\–cîg^\Œ)¿\Z•Kˇí¸7@\ÈE\Ì~\Õ)¿Ø^EF¸7@J]2éë\Ã)¿®REÒ˙7@ˇ\Ã >∞\À)¿ø\'÷©Ú˘7@(__\Î\ )¿MHk:˘7@9D‹ú\ )¿∏\ÃÈ≤ò¯7@Û\ ı∂ô\ )¿ˇzÖ˜˜7@¸\∆◊ûY\ )¿A-\”ˆ7@ˇ\"h\Ã$\ )¿:?\≈q\‡ı7@[¥\0m´\…)¿c‘µˆ>ı7@Ún§l\…)¿Ñ.\·\–[Ù7@jh∞\…)¿Æπ£Û7@\\X7\ﬁ\…)¿\0\‰Ñ	£Ò7@d\Ã]K\»\«)¿\√ÙΩÜ\‡7@S\‰G\∆)¿`r£\»Z\Ô7@•I)\Ëˆ\¬)¿¸5Y£\Ó7@ùÖ=\Ìø)¿Ò\rÖ\œ\÷\Ì7@¡kó6º)¿\Ô\Ê©π\Ì7@ΩU◊°ö∫)¿öîÇn/\Ì7@ˇïï&•∏)¿\‚\‰~á¢\Ï7@ˇ%©L1∑)¿¢\nÜ7\Î7@¯O7P\‡µ)¿Æ,g\Í7@œ°U1µ)¿äSÕ¨\È7@Z.ùÛ≥)¿\‡/fKV\È7@¶–≤)¿\ËL\⁄\Ë7@É\ﬁC\0∞)¿1~\Z˜\Ê\Á7@*≠ø%\0Ø)¿ ê°c\Á7@\œÙcôÆ)¿Ø]\⁄pX\Ê7@-_ó\·?≠)¿°e\›?\Ê7@Ñπ\›\À}™)¿Y|E\Á7@î⁄ãh;¶)¿r\‹)¨\Á7@œÉª≥v£)¿&åfe\Á7@5z5@i†)¿y ≤H\Á7@\Ëà|óRü)¿\‚tí≠.\Á7@íë≥∞ßù)¿fı∑C\Á7@Æù(	âú)¿J~ƒØX\Á7@Ùáfû\\õ)¿æHâ]\Á7@\ÿÚ\ ı∂ô)¿¢\'eRC\Á7@´\œ\’V\Ïó)¿å\‹\”\’\Á7@•ÙL/1ñ)¿$*T7\Á7@B\'Ñ∫î)¿K¨åF>\Á7@í%s,\Ôí)¿≠lÚñ\Á7@%\Ë/Ùê)¿ëπ2®6\Ë7@{h+¯ç)¿\›$Åï\Á7@´\–@,õâ)¿\ÍØWXp\Á7@\Í\"Ö≤Ö)¿jj\ŸZ_\Ë7@\ŸA%ÆcÑ)¿fá¯á-\È7@H3Mg)¿Å\Ì`\ƒ>\È7@˙A]§P~)¿r›îÚZ\È7@z\√}\‰\÷|)¿≥#\’w~\È7@*\‡û\ÁO{)¿\Í\–\Èy7\Í7@∫˜p\…qw)¿Ùâ<I∫\Í7@I°,|}u)¿E\Ÿ[\ ˘\Í7@†\ﬂ˜o^t)¿˘ÖWí<\Î7@∂Ùh™\'s)¿!XU/ø\Î7@∑\Ó\Ê©q)¿\ﬁQcB\Ï7@Ù•∑?o)¿üXß\ ˜\Ï7@áD§¶m)¿#¢òº\Ó7@\niçA\'l)¿YO≠æ\Ó7@é@ºÆ_h)¿î¿\Ê<\Ô7@yY|e)¿> à@\Ô7@iˇ¨Uc)¿!Êí™\Ì\Ó7@Ω\ƒX¶_b)¿›¥ß!\Ó7@gπlt\Œ_)¿îK\„^\Ì7@Ü\‰d\‚VY)¿!yv\Ì7@B“ßUÙW)¿tïÓÆ≥\Ì7@¸é·±üU)¿L5≥ñ\Ó7@Xc\'ºT)¿\Î¸\€eø\Ó7@ á†jÙR)¿*q\„\Ó7@π\√&2sQ)¿Ñ\‰\Ÿ\Â\Ô7@ÜˇtN)¿E\ÿÙJÒ7@Ö\È{\r¡I)¿G\Á¸\«Ò7@ˇ+jH)¿T™D\Ÿ[Ú7@st¥™E)¿Ò\‘#\rnÛ7@ä\ÂñVCB)¿±o\'\·Û7@•Ü6\0@)¿<O<gÙ7@E|>)¿∂É˚Ù7@Äµj◊Ñ<)¿ãàbÚÙ7@≥\ÏI`;)¿\⁄RÙ7@\‘Düè2:)¿vS\ k%Ù7@m¨\ƒ<+9)¿°Üoa\›Ù7@°J\Õ6)¿\Á\‡ô\–$ı7@ïA\’\Ë5)¿Túà~ı7@Ä\Ô6oú4)¿ÒÅˇˆ7@àº\Â\Í\«.)¿,ûz§¡ı7@¢E∂Û˝,)¿R∫Ù/Iı7@nÜ˘))¿êÑ};âÙ7@rˆ¥\√\')¿\r\–\“Ù7@rRò˜8#)¿≥yÛÛ7@H˙¥ä˛ )¿\∆0\'hìÛ7@àòN\Î)¿\Î\Ÿ\\5Û7@~\·ï$\œ)¿Ä≤e˘Ú7@˚\È?k~)¿ôg%≠¯Ú7@ª\“2R\Ô)¿˙≥)\"Û7@\Íuã¿X)¿€âíêHÛ7@\“7i\Z)¿Å\œ#ÑÛ7@∫ıö)¿â_±ÜãÙ7@Üç≤~3)¿wÑ”Çı7@d]\‹F)¿≤Åt±iı7@Ö≤ıµ)¿Å\–z¯2ı7@s	\ﬂ˚)¿æK©K\∆ı7@b¢A\nû\n)¿^emS<ˆ7@8Öï\n*\n)¿™(^em˜7@{\Ÿv\⁄\Z	)¿\Â\r0Û¯7@Ω´0	)¿$\Ÿ@∫¯7@\Ê@µm)¿v28J^˘7@ *çò\Ÿ)¿\ÏàC6ê˙7@\Î\Ÿ\\5)¿,cC7˚7@9\'ˆ\–>)¿<l\"3¸7@≠ÖYh\Á)¿;V)=\”˚7@é={.S)¿™õã˚7@\"\∆k^\’)¿J|\Ó˚˚7@Pã¡√¥ˇ(¿\‘Fu:ê˝7@\‰i˘Å´¸(¿\‡°(\–\'˛7@\› µâ˚(¿V*®®˛7@ˆ{bù˙(¿\Ë\ÿA%Æˇ7@C¨˛\√¯(¿K\Á√≥8@˘Kã˙$˜(¿d\Âó¡8@á£´twı(¿LqU\Ÿw8@j\›µ\ﬂÚ(¿\Ï‹¥ß8@\Á6\·^Ò(¿∂üåÒ8@º]/M(¿´Ãî\÷\ﬂ8@†\‡bE\r\Ó(¿ã†m58@\0\ƒ]Ωä\Ï(¿\À\\\Â	8@P0ûA\Î(¿nß≠¡8@Y¯˙Zó\Í(¿\0k’Æ8@OqN\Ë(¿ˆ\ÏπLM8@|_\\™\“\Ê(¿ùˆîú8@É/L¶\n\Ê(¿ñ≤q¨8@∫º9\\´\Â(¿™ÇQIù8@\Èe\À-\Â(¿yGsd	8@\nÛgö\‡(¿»ïzÑ\n8@ö¥©∫G\ﬁ(¿\Â\Ìß8@√Éf◊Ω\›(¿DÖ\Í\Ê\‚8@Ä4f\›(¿õUü´≠8@[Œ•∏™\‹(¿	ﬁêF8@\œ:Ø±\€(¿æ\ÿ{ÒE8@B[Œ•∏\⁄(¿÷år8@±k{ª%\Ÿ(¿˘æ∏T•8@;«Ä\Ïı\÷(¿wˆï\È8@ËÜ¶\ÏÙ\”(¿≤G8@\Z§\‡)\‰\“(¿sµ4∑8@)\–\'Ú$\—(¿Y\€èã8@GT®n.\Œ(¿¸©Ò\“M8@\‘($ô\’\À(¿\Èahur8@W≥\Œ¯æ\»(¿ùd=µ8@£\Ê´\‰c\«(¿£?4Û\‰8@ÉÜ˛	.\∆(¿†˘úª]8@\0AÄ\≈(¿vkô\«8@—ì2©¡(¿N\r4üs8@\Õw¿(¿\\:\Ê<c8@ñy´ÆCΩ(¿m´Yg|8@t\‘\—q5∫(¿^¢zk`8@hzâ±L∑(¿…´s\»8@1[≤*¬µ(¿Üí…©ù8@≤Ö %¥(¿¶(ó\∆8@\€o\ÌDI∞(¿\ÓØ˜≠8@ÑÿôB\Á≠(¿u™)\…\n8@äé\‰Ú™(¿b¯àò8@jí\Ã\Íù(¿HP¸8@†4\‘(ú(¿L‚¨àö8@Ø\n\‘bò(¿\Ï2¸ß8@t^có®ñ(¿T˝J\Á\√8@PéD¡î(¿Ü\∆Aú8@3\‡,%Àë(¿Ü:¨p\À8@0É1\"Qê(¿p\\\∆M\r8@&p\Îné(¿L˙{)<8@J\— Ω¿å(¿è˙\Î8@`ù∫ä(¿9\Óî\÷8@V\’\À\Ô4â(¿~ˇ\Ê≈â8@¯˘\Ô¡ká(¿aßX58@p]1#ºÖ(¿(ªô—è8@*\ƒ#ÒÚÑ(¿è\„áJ#8@†àE;Ñ(¿ \‘E\ne\r8@[A\”É(¿‹õ\ﬂ0\—8@è\ƒ\À”Å(¿åÅu?8@.\„¶ö(¿\◊2é\Á8@˚\Âì\√}(¿\Ô\ZÙ•∑8@ó\‚∂|(¿cB\Ã%U8@R\Ó>\«G{(¿Ò\÷˘∑\À\n8@±àaáy(¿ä\ÂñVC\n8@$	\¬Px(¿up≥x	8@K∫†v(¿F|\'fΩ8@Uø\“˘t(¿˛\”\rx8@\0é={.s(¿\ÕW\…\«\Ó8@ÿõíìq(¿V\ÿpA8@Y•ÙL/q(¿Û =E8@¿{Gç	q(¿\0tò//8@![ñØ\Àp(¿Ú[t≤\‘8@îOèmp(¿	äc8@L\ƒ[\Á\ﬂn(¿#K\ÊX\ﬁ8@§éé´ëm(¿/iå\÷Q8@õ\À\rÜ:l(¿ï)\Ê \Ë\08@öÏüßk(¿\»~Kë\08@6ìo∂πi(¿\–\Ôˇ7@7¬¢\"Ng(¿\Óïy´Æˇ7@/àHe(¿ñ!éuqˇ7@Öñuˇ`(¿0ù\÷mPˇ7@.\0ç“•_(¿q\”i\›˛7@á¿ë@É](¿ävR~˛7@ßz2ˇ\Ë[(¿\ƒZ|\nÄ˝7@jøµ%Y(¿˛(\Í\Ã=¸7@\‘\”G\‡W(¿õ\„\‹&\‹˚7@d\ÀÚuV(¿fÜç≤~˚7@¡tZ∑AU(¿év\‹ª˘7@íï_c$(¿˚=±Nï˚7@∞:r§3\0(¿ê/°Ç\√ˇ7@fˆyåÚ¥\'¿A.q\‰Å\08@–∏p $≥\'¿‹Éê/8@y:Wî≤\'¿Z\ ˚88@K≠˜\Ì∞\'¿¶d9	•8@∂Ω›í∞\'¿q\…qßt8@W`\»\ÍVØ\'¿x\Ïg±8@;\»zj≠\'¿L§4õ\«8@Ö$≥zá´\'¿˘J %v8@Ujˆ@+®\'¿\¬ë(¥8@˛µºrΩ•\'¿`r£\»Z8@AE’Øtû\'¿!Z+\⁄8@P´\ËÕú\'¿Y\‡+∫ı8@c\0é=õ\'¿øJí\Á8@]6:Áßò\'¿Ç™—´8@¸ˇ8a¬ê\'¿∂Ñ|–≥8@	kcÏÑè\'¿\“\√\–\Í\‰\08@Hâ]€ã\'¿±\…W8@ª∂∑[ä\'¿rS\Õ\Á\08@;¶\Ó\ .à\'¿IÅ0e\08@\ÌºçÕéÑ\'¿|Éˆ\Íˇ7@Q1\ŒﬂÑÇ\'¿aåHZ˛7@LhíXz\'¿`´ã\√˝7@t	á\ﬁr\'¿\»@û]æ˝7@(Ú$\Èöq\'¿Ù›≠,\—˝7@∑∏\∆g≤o\'¿ÒÅˇ˝7@¨˛√Äm\'¿±•GS=˝7@}Xo\‘\nk\'¿T5A\‘}¸7@\ﬁ\«\—Yi\'¿ñìP˙B¸7@Tç^\rh\'¿¯˛\Ì\’˚7@t—êÒ(e\'¿\‡ª\Õ˚7@\ﬂ\√%«ùb\'¿\–)\»\œF˙7@|\'fΩb\'¿ùª\Ï\◊˘7@X:û%`\'¿u!VÑ˘7@˚\À\Ó\…[\'¿≥ıµ.˘7@v¿u≈åX\'¿Çoö>;¯7@ÉL2rV\'¿¸S™D\Ÿ˜7@ê&åfU\'¿\–~§à˜7@6ê.6≠T\'¿DO §ˆ7@\·{ÉˆR\'¿™G\Z\‹\÷ˆ7@\√c?ã•P\'¿g}\ 1Y¯7@íñ\ \€N\'¿àL˘T˘7@xb÷ã°L\'¿Ùn,(˙7@õt[\"L\'¿ãåH\¬˙7@\Ì\◊dçJ\'¿\ f/˚7@≥\Ô´rI\'¿__\ÎR˚7@ªDı\÷¿F\'¿\›\ÕSr˚7@Æ\Ô\√ABD\'¿ \rß\Ã\Õ˚7@u\ÊB\'¿Æ\Ÿ\ K˛˚7@=\“‡∂∂@\'¿\∆R$_	¸7@üÕ™\œ\’>\'¿ü\Ê\‰E&¸7@ñ±°õ=\'¿	˙=b¸7@=É˘+<\'¿ÆG\·z˛7@∏u7Ou8\'¿O©eˇ7@´Z\“Q6\'¿\Â*ø)\08@	]\ﬁ4\'¿W\"P˝É\08@ôHi6è3\'¿\È&1¨\08@µ•Úz0\'¿Ü¨nıú\08@Ú¥¸¿U.\'¿zé\»w)8@xEøï,\'¿\Œ\‡\Ô≥8@óåc${,\'¿F\ÕW\…\«8@	√Ä%W)\'¿\Ÿ\Ó†˚8@Gx$(\'¿üÆ\ÓXl8@rp\ÈòÛ$\'¿\ÃoB8@Å\ËIô\‘ \'¿?W[±ø8@ñó¸O˛\'¿ôt&8@o†¿;˘\'¿âö\ËÛQ8@d#Ø\Î\'¿óqS8@Ï§æ,\Ì\'¿aßX58@F}í;l\'¿±i•\»	8@¿@ C\'¿`∑\Ó\Ê	8@ƒ≥\r\'¿\¬\Â\“¯	8@\„\ƒW;ä\'¿¬äS≠Ö	8@5\Ê\Ë	\'¿Ö\…T¡8@$+ø\∆\'¿™∑∂J8@\‡\ŸΩ\·\'¿Ö\\©gA8@\√Œßé\'¿ÒÒ	\Ÿy8@*\‰J=\'¿zrMÅ\Ã8@F\Í=ï\”˛&¿wø\n\›8@9(a¶˝&¿I\ÿ\’\‰8@\nÄÒ\Z˙&¿Bïö8@sªó˚\‰¯&¿\¬Pán8@è\0n/ˆ&¿∂\€.4\◊8@\'˜;ı&¿\»zjı\’8@;\‚ê\r§Û&¿õ.»ñ8@&ç\—:™Ú&¿ü\ÁO\’8@ó\»g\Ô&¿ö@ã8@˝Ö1z\Ó&¿ò6\ ˙8@Fx{\Í&¿™õãø8@sJ_\È&¿Œ¶#Äõ8@\Á\«_Z\‘\Á&¿\œHÑF∞8@\Õôd\‰\‰&¿≥ïó¸O8@”àô}\„&¿\rãQ\◊8@ˇ?Nò0\‚&¿\'æ\⁄Qú8@/¸\‡|\Í\‡&¿πã0Eπ8@\Á¸«Å\ﬂ&¿Nd\Êó8@û|zl\À\ÿ&¿ó:\»\Î¡8@\ƒv¸\ÿ&¿§T\¬z\r8@åÉK«ú\◊&¿©Ωà∂c8@\‚W¨\·\"\◊&¿\‚\ \Ÿ8@,‘ö\Ê\◊&¿hÕèø¥8@6t≥?P\÷&¿â&P\ƒ\"8@+Ö@.q\‘&¿<˙D8@Ø_∞∂\Õ&¿\Á\Zfh<8@HN&n¥&¿®\·[X78@\Í>\0©Mú&¿\0Æd\«F8@T˜<ä&¿\'K≠˜	8@:\Õ\ÌY&¿\Z¿[ A	8@BÕê*äW&¿	\Z3âz	8@ØwºWU&¿ó¨äpì	8@{g¥UIT&¿H\‚\Â\È\\	8@&P6\ÂR&¿\‡ÿ≥\Á2	8@!>∞\„øP&¿&:\À,B	8@}\Î\√z£N&¿πlt\ŒO	8@\ÎnáÜM&¿Z\râ{,	8@ˇzÖ˜K&¿=ù+J		8@¯¸0BH&¿ôG˛`8@JµO\«cF&¿5B?SØ8@h?RDÜE&¿‘ô{H¯8@◊¢h[E&¿&¨ç±8@D6ê.6E&¿\”J!êK8@ò§2\≈D&¿\ﬁ	ä8@l	˘†gC&¿e5]Ot8@?˛“¢>A&¿\ﬁ=@˜\Â\08@†¶ñ≠=&¿\‘}\0Rõ\08@Vbûï¥:&¿™b*˝\08@Ä\'-\\V9&¿!:é8@¿#*T77&¿¢DKO8@í?x\Ó5&¿\ÂE&\‡\◊8@∑BXç%4&¿\Œn-ì\·8@|Bv\ﬁ\∆.&¿NG\07ã8@:ñw\’&&¿_~ß…å8@\ﬁwè˝$&¿\'Ñ∫Ñ8@0c\n\÷8#&¿X<ıHÉ8@¡èj\ÿ\Ô!&¿-∞\«DJ8@â\Ì\Ó∫&¿ßî\◊J\Ë8@âòIÙ\Z&¿9∂û!8@É¸l\‰∫&¿±3Ö\Œ8@9\–Cm&¿5~\·ï$8@?V\€&¿dZõ\∆ˆ8@åπk	˘&¿S#Ù3ı8@4˜êΩ&¿•h\Â8@¶Ä¥ˇ&¿â$z\≈8@Rò˜8\”&¿Q•f¥8@˜?¿Zµ&¿DO §8@≥ómß≠	&¿Aπmﬂ£8@zn°+&¿*\‚tí≠8@\nÚ≥ë\Î&¿ˇ%©L18@j1xòˆ&¿ ∂Ùh™8@\Z1≥\œc&¿S∞\∆\Ÿt8@2\ÂCP5&¿Nµf°8@[}uU†˛%¿{.Sì\‡8@\⁄\Ê\∆ÙÑ˝%¿g\’\Áj+8@\ŒSr3¸%¿\Ï£SW8@\Ê¨O9&˚%¿fIÄöZ8@6´>W[˘%¿~8HàÚ8@ò•ùö\Àı%¿\‡Jvl8@P≈ç[Ù%¿\…s}8@≤Û66Û%¿?ç{Û8@µ2\·ó˙Ò%¿\ﬁÆ\’8@Ò\◊dçz%¿ø\“˘,8@\‡ª\Õ\Ô%¿≤≤,ò8@fˆyåÚ\Ï%¿\’<G\‰ª8@F\Ï@1\Í%¿òmß≠8@Ω5_%\Á%¿~åπk	8@]n0\‘a\Â%¿œÜ¸3É8@ü\"áàõ\„%¿jπ38@K\0˛)U\‚%¿>≤πjû8@ Ò+\÷p\·%¿B>\ËŸ¨8@z4’ì˘\ﬂ%¿0J\–_\Ë8@ûwg\Ì\ﬁ%¿x	N} 8@\–}9≥\›%¿Ct	\08@\Œ¬ûv¯\€%¿¿ó¬Éfˇ7@:\Í\Ë∏\Z\Ÿ%¿¥tˇ7@\ÕX\‰\◊%¿ë,`∑˛7@ßŒ£\‚ˇ\÷%¿éÕéT\ﬂ˝7@ò6\ ˙\’%¿E\ÿÙJ˝7@≤Û¨§\’%¿Û\„/-\Í˚7@ı,\Â}\‘%¿Ùoó˝∫˚7@•⁄ß\„1\”%¿\⁄Rê\08@\›\Ìziä\»%¿#ˆ	†8@ˆ\rLn\…%¿t\Í\ gy8@™IÜ4\ %¿v˛\”\r8@ˆ\ÏπLM\ %¿˝/◊¢8@\'1¨\ %¿\ÿGßÆ|8@-@\€j\÷\…%¿\«*q8@A∂,_ó\…%¿Fè6é8@Ö≥[\Àd\»%¿weÆ	8@ |(—í\«%¿¡\«`≈©\n8@ÑºLä\«%¿\ŒQ\⁄8@ãk|&˚\«%¿òøB\Ê\ 8@\Õ >∞\„\«%¿3¡pÆa8@i\⁄V≥\∆%¿¢%èß\Â8@p$\–`S\«%¿\Ë€Ç•∫8@FzQª\«%¿ôÚ!®8@ÚŒ°U\…%¿\Ê\ËÒ8@\‘\’ãm\ %¿p_\Œ8@ã\ƒ5|\À%¿%ìS;8@\⁄r.\≈\Õ%¿u/3l8@UMu\–%¿wH1@¢8@∂-\ lê\—%¿É¶%VF8@Äa˘Ûm\—%¿1|DLâ8@™CnÜ\–%¿πã0E8@<Ö\\©\œ%¿d?ã•H8@OëC\ƒ\Õ\—%¿ÿü\ƒ\ÁN 8@\·ö;˙_\÷%¿XîÜ\Z!8@p\“4(ö\◊%¿åÇ\‡Ò\Ì!8@ówJ\€%¿\·¥\‡E_!8@∏Z\'.\«\€%¿˜.9\Ó 8@:;%\ﬂ%¿∫Ü\ZO 8@\r\‡-ê†\‡%¿˜≠÷â8@O\‹Û¸\·%¿Xq™µ08@≈êúL\‹\‚%¿\ÔVñ\Ë,8@!…¨\ﬁ\·\Ê%¿\Â\’9d8@\‡\’rg&\Ë%¿5ôÒ∂\“8@˜é\Z\Í%¿IÛ«¥6!8@DkEõ\Î%¿L8†!8@†\¬§R\Ï%¿F}í;l\"8@≤ûZ}u\Ì%¿«ü®lX#8@}\ 1Y\‹\Ô%¿Æg\«,#8@ùd=µÚ%¿|û?mT#8@Ë£å∏\0Ù%¿™Û®¯ø#8@=∏;k∑ı%¿&\√Ò|$8@õ.\»ˆ%¿à,\“\ƒ;$8@ÆaÜ\∆˘%¿¢BusÒ#8@Ç™—´˙%¿\0ºvi#8@h[\Õ:˚%¿˘Ùÿñ#8@©\≈\‰˝%¿ëGp#e#8@∑∏\∆g≤ˇ%¿rˆ¥\√#8@¿ZµkB&¿6\Ã\–x\"$8@J¥\‰Ò¥&¿eˇ<\r$8@ªîX&¿Òc\Ã]K$8@éî-ív&¿®´;\€$8@\Ó_YiR&¿oÅ≈è%8@O]˘,\œ&¿≤∫\’s&8@\n\ÿF&¿^K\»=\'8@\ﬁ Z+\⁄&¿>v()(8@˙’ë#&¿\”ˆØ¨4)8@RÔ©úˆ&¿p@KW∞)8@\»yˇ\'&¿ôIÙ2*8@\«Gã3Ü&¿\Zjí\Ã*8@ç\núl&¿≈´¨mä+8@Ùp\”i\r&¿i\»xîJ,8@gH≈´&¿®\0œ†-8@\0ºvi&¿i©˜T.8@Òùòı\n&¿?ˇ=x\Ì.8@E\Ÿ[\ ˘\n&¿ı∫E`¨/8@\Á8∑	˜\n&¿å\ÿ\'Äb08@D?ç{&¿\œÛßç\Í08@ò\ﬁ˛\\4&¿k$	\¬18@W\Œ\ﬁm\r&¿\„5Ø\Í¨28@A	]&¿ã˘π°)38@5D˛&¿ñ&•†\€38@\‰\⁄P1\Œ&¿Ø\'∫.¸48@\ÎT˘ûë&¿$ô\’;\‹68@\≈Ue\ﬂ&¿∏\nıÙ98@øÙˆ\Á¢&¿\÷\∆\ÿ	;8@‹π0“ã&¿)	â¥ç;8@\«Aúá&¿ãNñZ\Ô;8@g`\‰eM&¿\›aôπ<8@r\Z¢\n&¿\Á7L4H=8@\ ˘b\Ô\≈&¿wj.7>8@#Çqp\È&¿EH\›\Œ>8@_zo&¿üêù?8@sÅ\Àc\Õ&¿†O\‰I\“A8@™\rNDø&¿ß\ÊrÉ°B8@´\ŒjÅ=&¿j¯÷çC8@MhíXR&¿\Á7L4HE8@z\·ŒÖë&¿cD¢\–F8@Rb\◊ˆ&¿uèlÆöG8@µR\‰&¿•\»%éH8@Û<∏;k&¿R\◊\⁄˚TI8@¸rfªB&¿\⁄\‰I\'J8@\∆O\„\ﬁ¸&¿Ÿól<\ÿJ8@Ä\‘&N&¿5%Yá£K8@∑	˜ º&¿\ÔÀô\Ì\nM8@yGsd&¿Ék\Ó\ËM8@\»\Ó%&¿û\–\ÎON8@Ç\ ¯˜&¿dZõ\∆ˆN8@^Ú?˘ª&¿´!qè•O8@D¡å)&¿ú˝h8Q8@Û =E&¿™\’WWR8@\€\¬ÛR±&¿‰†ÑôR8@ªFÀÅ\Z&¿¡≈ä\ZLS8@¶DΩå\Z&¿n5\Îå\ÔS8@πP˘\◊Ú\Z&¿\Îq\ﬂjùT8@ª*Pã¡&¿í\Ëe\ÀU8@:?\≈q\‡&¿´7UV8@£=^Há&¿&«ù\“¡V8@á$ö &¿P)îÖW8@\Ë£\Á\"&¿w;S\ËX8@ùõ6\„4$&¿¶}sY8@\‡û\ÁO%&¿AE’ØtZ8@’±J\Èô&&¿Cé≠g[8@\‚ëxy:\'&¿\‘>\Õ\…[8@+¡\‚p\Ê\'&¿\‹N^\\8@AÄ;(&¿cö\È^\']8@Q°∫π(&¿\0u\ﬁ]8@~åπk	)&¿\¬i¡ãæ^8@^π\ﬁ6S)&¿\›\Ïî_8@îø{Gç)&¿\Œ4a˚\…`8@\ﬁ\ÔU++&¿qX\Z¯Qa8@öEÛ\0.&¿∏[íva8@õ\»\Ã./&¿=\’!7\√a8@/•.\«0&¿\⁄;£≠Jb8@Ú∂\“k≥1&¿ò¶pzc8@x≥\Ô´2&¿\ 3/á\›c8@é\ M\‘\“4&¿ÄF\È\“c8@wù\r˘g6&¿ˆ\Ô˙\ÃYc8@[y\…ˇ\‰7&¿±¶≤(\Ïb8@a\‡π˜p9&¿6uˇc8@/3lî=&¿M\ÿ~2\∆c8@mqç\œd?&¿XY\€èc8@ì\‡\riT@&¿P™}:c8@êªSîC&¿%Ø\Œ1 c8@o∏è‹öD&¿s\◊ÚAc8@\√(\ﬂF&¿f/\€Nc8@Äüq\·@H&¿r\ﬁˇ\«	c8@\ŒoòhêJ&¿_\“≠£b8@Ú]J]2N&¿2∆á\Ÿ\Àb8@ú•d9Q&¿±1Ø#a8@Aõ>\ÈT&¿;®\ƒu`8@Ks+Ñ\’X&¿AÅwÚ\Èa8@\ÔSUh ^&¿:\ÎSé\…b8@à\ŸÀ∂\”^&¿EÅ>ëc8@Ö\\©gA`&¿9ú˘\’d8@õZ∂\÷a&¿ôÉ†£Ue8@ﬁìáÖZc&¿$õ´\Ê9f8@Y£¢\—e&¿`Ãñ¨äd8@1[≤*r&¿\Z\ﬂó™d8@ü\"áàõs&¿CçBíYe8@.\‚;1\Îu&¿gõ\”f8@wù\r˘gv&¿\Ã\'+Ü´g8@ô÷¶±Ωv&¿aßX5h8@jºtìx&¿üè2\‚h8@û	M{&¿Ü∆§øg8@#°-\ÁR|&¿R%ìSg8@z˝I|\Ó|&¿w¶(óf8@¶\“O8ª}&¿\›@ÅwÚe8@^Háá0~&¿80πQde8@z˛¥Qù~&¿¬á-e8@ |(—í&¿I°,|}e8@ã˛\–ÃìÉ&¿IÇpf8@^ÿö≠ºÑ&¿\·\Ï\÷2f8@1	ÚÜ&¿k∏\»=e8@mè\ﬁpâ&¿≠hsú\€d8@_\“≠£ä&¿\’Y-∞\«d8@Fπã0ç&¿\Á\Zfhd8@\Ÿ\Î\›è&¿gb∫´c8@F\Î®jÇê&¿Uæg$Bc8@3\‚ëxë&¿\\´=\ÏÖb8@Ø\“\›u6î&¿QN¥´êb8@\"8.„¶ñ&¿v5y\ jb8@=∑–ïò&¿oÛ\∆Iab8@€•\rá•ô&¿˘Ma•Çb8@ÛtÆ(%ú&¿,(\ 4b8@cC7˚ù&¿2êgóoa8@f†2˛}û&¿}w+_8@\›Êçì¢&¿∫K‚¨à^8@¸çv\‹£&¿}≥Õç\È]8@°-\ÁR\\•&¿óU\ÿp]8@Ç≠,ß&¿\Â—ç∞®\\8@\Á\·¶´&¿Äe•I)\\8@˝ø\Í»ëÆ&¿\ÿF\Ï\\8@óqSÕØ&¿ˆñræ\ÿ[8@≈≠Ç\Ë≤&¿Rb\◊ˆZ8@¨\ƒ<+iµ&¿\“\„˜6˝Y8@^ü9\ÎS∂&¿d∞\‚TkY8@`tys∏∂&¿u\…8F≤W8@z\„§0\Ôπ&¿!¨\∆\÷V8@ëdV\Ôpª&¿.uê◊ÉU8@Ø@Ù§º&¿Ú?˘ªwT8@§¶]L3Ω&¿ã˘π°)S8@üq\·@Hæ&¿ä\Ál°Q8@<ÉÜ˛	æ&¿íxy:WP8@®Tâ≤∑º&¿÷çwGN8@µãi¶{Ω&¿¸é·±üM8@qN`:Ω&¿an˜rüL8@˘æ∏T•Ω&¿\„o{Ç\ƒJ8@Ù\ƒs∂Ä¿&¿ˆB\€I8@\\Öz˙¿&¿7âA`\ÂH8@{\⁄\·Ø¡&¿Æc\\qqH8@:Z’íé\¬&¿3¶`çG8@.s∫,&\∆&¿£>\…6I8@AJò\…&¿F≤G®J8@!\"5\Ìb\ &¿¢≥\Ã\"K8@¡ãæÇ4\À&¿=‘∂aL8@Íï≤q\Ã&¿™\Ô¸¢M8@∏V{\ÿ\Õ&¿X\0SN8@\Õ\» w\Œ&¿\ÀK˛\'O8@∏@Ç\‚\«\–&¿©lXSYX8@\’\È@\÷S\”&¿k’Æ	Y8@W#ª\“&¿˙Ä@g\“Z8@ûéíW\œ&¿\ÍÕ®˘Z8@^û\Œ•\Ã&¿\'OYM\◊[8@\÷»Æ¥å\Ã&¿®©ek]8@¢\Óê\⁄\Ã&¿∑\Ó\Ê©^8@Å%W±¯\Õ&¿_—≠\◊Ù`8@C\·≥up\–&¿vl\‚ua8@)\"\√*\ﬁ\–&¿\œˆ\Ë\r˜a8@®\ÁoB\—&¿∂j◊Ñ¥b8@YL¸\—&¿bΩQ+Lc8@m\‚\‰~á\“&¿å\ \¬\◊c8@πU]\”&¿fˆyåÚd8@qhî.\’&¿0.sf8@\»T∆ø\◊&¿ÆJ\"˚ g8@õUü´≠\ÿ&¿†ö≤\”g8@:\Í\Ë∏\Z\Ÿ&¿@Ö#H•h8@\÷\0•°F\Ÿ&¿ˇ^\nöi8@∫æ	\Ÿ&¿¨ã\€h\0k8@≈¨C9\Ÿ&¿ÛYûwk8@\ﬁ\ÔU+\€&¿j˝°ôk8@`êÙi\›&¿Ç\»\"Mºk8@≠Q\—\Ë\ﬁ&¿?\∆‹µÑl8@ı¢vø\n\‡&¿Ö|–≥Ym8@t|¥8c\‡&¿ÉL2rn8@∫ÑCo\·&¿sÇ69|n8@\›\—ˇr-\‚&¿ö[!¨\∆n8@G:#/\„&¿¯8”Ñ\Ìo8@j\”L˜\Í&¿Ù\·YÇåp8@jΩ\ﬂh\«\Ì&¿˙’ë#q8@næ›≥\Ó&¿±\n\ÿr8@0/¿>:\Ì&¿Å¥ˇ\÷r8@≥_w∫Û\Ï&¿EKO\Às8@è®P\›\\\Ï&¿–ó\ﬁ˛\\t8@òjf-\Ï&¿\‚Èï≤u8@\n\ÿF\Ï\Î&¿!%Ã¥u8@ﬂøyq\‚\Î&¿é;•Éıw8@>≤πjû\Î&¿1\Ó\—Zy8@°B]\Í&¿ü>¯y8@\Èåº¨\È&¿ÆÛoó˝z8@í%s,\Ô\Í&¿º;2Võ{8@\ﬂƒêúL\Ï&¿ôÚ!®\Z}8@\Ëyít\Ì&¿å0Eπ4~8@\Ÿ=yX®\Ì&¿ö\ŒNGÅ8@y\À’è\Ì&¿¸\0§6qÇ8@àL˘T\Ì&¿µ5\"É8@J\— Ω¿\Ï&¿Ü\„˘®É8@\Ìe\€ik\Ï&¿’ï\œÚ<Ñ8@åû[\ËJ\Ï&¿˙=bÙÑ8@QOÅ?\Ï&¿ó\ÊV´Ö8@\‹h\0oÅ\Ï&¿\÷\ÊˇUGÜ8@ úO´\Ï&¿\…6ëôá8@LnY\Î&¿T\Â{F\"à8@xµ‹ô\È&¿Ö\Œk\Ïâ8@ªö<e\Â&¿§´twùâ8@\‰£\≈\√\‰&¿%\Îptïä8@\–^ª\‰&¿\‡.˚ußã8@%Ã¥˝+\„&¿\\Z\râ{å8@Ùn,(\‚&¿ø∆àDç8@&™∑∂\‚&¿\Ê$îæé8@|\Î∆ª\„&¿]5\œ˘é8@\⁄YÙN\‰&¿OG…´è8@ál ]\‰&¿\÷q¸Piê8@0ûACˇ\‰&¿Yk(µë8@ûE\ÔT¿\Â&¿¯˘\Ôë8@	äc\Ê&¿-C\Î\‚í8@8>[\Á&¿V-≤ùì8@yZ~\‡*\Á&¿≥~31]î8@8Ωã˜\„\Ê&¿RÔ©úˆî8@ë~˚:p\Ê&¿ß\"\∆ñ8@¢≤a\Â&¿\È∏\ZŸïñ8@[%X\Œ\‰&¿{\⁄\·Ø…ñ8@“™ñtî\„&¿\ \¬\◊◊ñ8@h ñ\Õ\‚&¿ôg%≠¯ñ8@¨\≈9\Í\‡&¿TãàbÚñ8@p(|∂\ﬁ&¿	m9ó\‚ñ8@∫£ˇ\ÂZ\‹&¿M,›ñ8@\Ïiáø&\€&¿û$]3˘ñ8@}	^\ÿ&¿Tˇ í!ó8@°.R(\◊&¿2\"QhYó8@¶\“O8ª\’&¿c\Ÿ=yò8@6!≠1\Ë\‘&¿fjº!ô8@\0˛)U¢\‘&¿\ﬁˇ\«	ö8@¸ \‘&¿t	áﬁö8@\Ì∏\·w\”&¿Sx\–Ï∫õ8@ß\ËH.ˇ\—&¿ºx?nøú8@˚ïŒág\—&¿ˆ@+0dù8@ÑÉΩâ!\—&¿Ü[\œû8@QÇ˛Bè\–&¿e•I)\Ëû8@%≠¯Ü\¬\œ&¿˝ª>s÷ü8@æk–ó\ﬁ\Œ&¿´∞\‡Ç†8@¢µ¢\Õq\Œ&¿\⁄8b->°8@+\›]gC\Œ&¿\\ê-\À◊°8@y$^û\Œ\Õ&¿\'çµø£8@∫ÿ¥R\Ã&¿=HOëC§8@í%s,\Ô\ &¿åi¶{ù§8@«ª#cµ\…&¿\nü≠ÉÉ•8@2ë\“l\«&¿\¬˜˛\Ì•8@sg&\Œ\≈&¿òLåJ¶8@\ \¬\◊◊∫\ƒ&¿U\›#õ´¶8@ôºfæ\√&¿\¬&Sß8@˚Æ˛∑\¬&¿Ö\Í\Ê\‚oß8@^ª¥\·¿&¿®ã\ ¬ß8@t_\Œlø&¿&7ä¨5®8@¢ÇãΩ&¿àıF≠0©8@]\‹Fxª&¿W|C·≥©8@7\·^ô∑∫&¿k∂Úíˇ©8@/\«Hˆ∏&¿éW zR™8@_a¡˝Ä∑&¿LP√∑∞™8@\»\È∂&¿,ö\ŒN´8@Oìo+µ&¿#£í∞´8@s\’<G\‰≥&¿i∆¢\È\Ï¨8@0°Ç\√≤&¿J`sû≠8@+\⁄\Á6±&¿∫†æeÆ8@M÷®á∞&¿≥$@M-Ø8@≥Bë\ÓØ&¿5ôÒ∂“Ø8@Å[wÛTØ&¿Å$\Ï\€I∞8@k(µ—Æ&¿?∆∞8@)Zπò≠&¿`!seP±8@ö	Üs\r´&¿˚:pŒà≤8@†®lXS©&¿-$`ty≥8@®\ÁoB©&¿\‚K∫¥8@\Ìù\—V%©&¿Vdt@∂8@äíêH€®&¿ª(z\‡c∏8@£±ˆw∂ß&¿≠mä\«Eπ8@0ûACß&¿c\’ \Ã\Ì∫8@\‚\‡Iß&¿MLbıª8@≠nıúÙ¶&¿h\Íuã¿º8@àÅ#Å¶&¿\‚X∑—º8@Ç…ç\"k•&¿\÷˝c!:º8@@ø\Ôﬂ§&¿Z°H˜s∫8@ä;\ﬁ‰∑†&¿ùŸÆ\–ª8@p\Í\…;ü&¿1–µ/º8@9\Ì)9\'û&¿<á2T≈º8@v˝Ç›∞ù&¿‘ÄA“ßΩ8@%A∏\nù&¿2\ËÑ\–Aø8@pñí\Â$ú&¿\◊l\Â%ˇø8@x\nπRœö&¿1|DLâ¿8@/â≥\"jö&¿©\‹D-\Õ¡8@{É/L¶ö&¿≠¿ê’≠\¬8@•Éıõ&¿“™ñtî\√8@\rP\Zjö&¿L4H¡S\ƒ8@˙∑\À~›ô&¿e\Z\≈8@¡8∏tÃô&¿{m\«\‘\≈8@!t\–%ö&¿Ù¯ΩM\∆8@a\⁄9Õö&¿Kr¿Æ&\«8@>[õ&¿∏w\r˙\“\«8@ÑJ\\«∏ö&¿\Á\Zfh\»8@/â≥\"jö&¿[|\nÄÒ\»8@ä\Õ«µ°ö&¿\Â&jin\…8@öCR%õ&¿íy\‰\ 8@\Ó\œEC∆õ&¿z˛¥Qù\ 8@˚\È?k~ú&¿GêJ±\À8@ùπáÑ\Ôù&¿|&˚\Ái\Ã8@éx≤õù&¿dvΩS\Õ8@\’\"¢òú&¿\Õ\ÂC\Œ8@J/Öù&¿™\‘\ÏÅ\Œ8@/\ƒ\Íè0ú&¿ô+ÉjÉ\œ8@é\Ê\»\ /õ&¿á\·#bJ\–8@o\‘\n\”˜ö&¿fjº!\—8@\rP\Zjö&¿Adë&\ﬁ\—8@Y\ﬂ¿\‰Fô&¿Ä\ÿ“£©\“8@v\›[ëòò&¿d> –ô\‘8@/àHMªò&¿\‰qs*\’8@h∞©Ûò&¿øõn\Ÿ!\÷8@º∑_>ô&¿\ÀM\‘\“\‹\÷8@q:ô&¿5\—\Á£\ÿ8@\‘M÷ò&¿¸S™D\Ÿ8@kcÏÑóò&¿	á\ﬁ\‚\·\Ÿ8@D3OÆ)ò&¿3ä\ÂñV\€8@°Ä\Ì`ƒñ&¿\ƒv¸\‹8@\—¥≠fï&¿ìE\÷\Z\ﬁ8@≥q¨ãì&¿ùIõ\ﬁ8@`∞∂-í&¿Vbûï¥\ﬁ8@N`:≠€ê&¿F`¨o`\ﬁ8@I\◊LæŸé&¿\Zl\Í<\ﬁ8@qí\Êèiç&¿òLåJ\ﬁ8@g&\Œ5å&¿©\⁄nÇo\ﬁ8@(—í\«”ä&¿êˆ?¿\ﬁ8@Aãvà&¿\’\Áj+ˆ\ﬂ8@óU\ÿà&¿ÄJï\‡8@|öìôà&¿ù*\ﬂ3\·8@\‰J=Bâ&¿$F\œ-t\·8@\“\∆kÒâ&¿\re˝f\‚8@∂\ÿ\Ì≥ä&¿(b\√\„8@\‰Ùı|Õä&¿£î¨™\„8@˝ÉHÜã&¿ßwÒ~\‰8@$π¸áÙã&¿øÙˆ\Á¢\Â8@\–\÷¡¡ﬁå&¿\Ó_YiR\Ê8@R\“\√\–\Íå&¿∏?\r\Á8@\Ôt\Áâ\Áå&¿§\«\Ôm˙\Á8@^ıÄy»å&¿Ùz\ƒ\Ë8@<¡˛\Î‹å&¿Sñ!éu\È8@Ÿì¿\Êå&¿\»\È\Í8@çc${Ñä&¿“èÜS\Ê\Í8@©ü7©à&¿\»\Ôm˙≥\Î8@∏\Á˘”Ü&¿§µ˚U\Ï8@bá1\È\ÔÖ&¿m˛_u\‰\Ï8@\Ã\—\„˜6Ö&¿sg&\Œ\Ì8@6\ ˙\ÕƒÑ&¿HP¸\Ô8@\Ã_!sÖ&¿µ3Lm©\Ô8@©ø^a¡Ö&¿\"OíÆô8@∫M∏W\ÊÖ&¿U2\0TqÛ8@Yä\‰+ÅÑ&¿∫i3NCÙ8@\≈t!VÑ&¿XU/ø\”Ù8@øeNó≈Ñ&¿\Ÿ\–\Õ˛@ı8@]\≈\‚7ÖÖ&¿<3¡pÆı8@+\›]gCÜ&¿_$¥\Â\\ˆ8@tò//¿Ü&¿\¬˙?á˘ˆ8@]§PæÜ&¿ÑÄ|	¯8@ö@ãÜ&¿/N|µ£¯8@\Î\„°\ÔnÖ&¿*\Ê \Ëh˘8@.»ñ\ÂÉ&¿ˆb(\'\⁄˘8@é ïÇ&¿3˚<Fy˙8@\Á˝ú0Å&¿0)>>!˚8@£˝ÖÅ&¿⁄©π\‹`¸8@\Z®åüÅ&¿∫0“ã\⁄˝8@˜êΩøÅ&¿ùÒ}q©˛8@xö\Ãx[Å&¿ä\…`\Êˇ8@©˚\0§6Å&¿Ö\Ì\'c|\09@!\Á˝úÄ&¿\ÌÙÉ∫H9@Ec\Ì\Ôl&¿{¢\Î\¬9@]©gA(&¿1^Û™\Œ9@L8Ù&¿BÕê*ä9@õ.\»~&¿\’\"¢9@\≈X¶_\"~&¿ßA\—<Ä9@Ûgö∞}&¿äÆ?89@$^û\Œ}&¿\…W)±9@÷ßì\≈}&¿ˆ\–>V9@n\€˜®ø~&¿\Z\ﬂó™9@≈è1w-Å&¿På,ôc	9@=|ô(BÇ&¿,æ-X\n9@µ¶y\«)Ç&¿õ7N\nÛ\n9@7¶\',ÒÄ&¿t≥?Pn9@>∞\„ø@Ä&¿ë\‘B\…\‰9@D‹úJÄ&¿}\\*\∆\r9@Uˆ]¸&¿ál ]l9@û∂F\„Ä&¿\nÚ≥ë\Î9@/2øFÇ&¿ΩçÕéT9@\Ï¿9#JÉ&¿!\È\”*˙9@Üèà)ëÑ&¿RewÉ9@\÷{L§Ñ&¿c‘µˆ>9@˚7/NÑ&¿bá1\È\Ô9@∏\Êé˛óÉ&¿\ËÉel\Ë9@3mˇ\ JÉ&¿é±^Ç9@èäˇ;¢Ç&¿Ù\Ô99@b\√cÇ&¿\ZÑd9@nÜ˘Å&¿¶F\Ëg\Í9@≥¥SsπÅ&¿?V\€9@îÖØØuÅ&¿Ve\ﬂ¡9@ |(Å&¿ß\Óy˛9@¿\Í»ëŒÄ&¿ŒéT\ﬂ˘9@k’Æ	Å&¿h#\◊M)9@Aı\"Ç&¿õ©æÛ9@w0bü\0Ç&¿MJA∑ó9@\Ó±Ù°Ç&¿oJy≠Ñ9@ëÄ\—\ÂÕÅ&¿]\ÈE\Ì9@4ú27ﬂÄ&¿§à´x9@9¥\»væ&¿__\ÎR# 9@∞\‚Tka~&¿8\€‹òû 9@¿ñWÆ∑}&¿m\«\‘]\Ÿ!9@%¿|&¿ºy™Cn\"9@å£rµ|&¿6\Êu\ƒ!#9@ùΩ3⁄™|&¿Jòi˚#9@P\Zjí|&¿î\Ÿ ìå$9@Ÿò\◊á|&¿X\‰\◊±%9@î¿\Ê<{&¿˜[;Q&9@ˇ?Nò0z&¿\Î\…¸£o&9@ﬁçÖAy&¿\'â%\Â\Ó\'9@‹úJÄz&¿´\Í\Âwö(9@\nÖ8Ñz&¿t\ÓvΩ4)9@}\"OíÆy&¿,ûz§¡)9@$\–`S\Áy&¿W#ª\“2*9@N~ãNñz&¿˜vKr¿*9@\'¬ÜßWz&¿êÜS\Ê\Ê+9@ü[\ËJz&¿•\»%é,9@\Ìô%jz&¿év\‹ª-9@yë	¯5z&¿^\“\ZÉ.9@c\“\ﬂK\·y&¿QL\ﬁ\03/9@º$Œä®y&¿,\Ô™\Ã/9@\Õu\Ziy&¿z719@\ÌS[\Íx&¿´\–@,õ19@F_Aö±x&¿7U˜\»\Ê29@&oÄô\Ôx&¿Ñ\Ÿñ39@•°F!y&¿çC˝.49@Âπæy&¿z\Z0H˙49@\ﬂ4}vx&¿\·ó˙yS59@7™”Å¨w&¿ùH0\’\Ã69@&8ıÅ\‰u&¿[µkBZ79@yx\“\¬u&¿¡\Zg\”89@ˇ^\nöu&¿ddY099@W\Œ\ﬁmu&¿$\n-\Î˛99@kD0.u&¿ ∏\ ;9@vçñ=t&¿ÚA\œf\’;9@¥wF[ït&¿ÜUºëy<9@É¢y\0ãt&¿q\‰Å\»\"=9@û\–\ÎO\‚s&¿Ék\Ó\Ë=9@âòIÙr&¿5\Ê\Ë=9@l|&˚\Áq&¿\‚\–(]>9@7\‡Û\√q&¿rl=C@9@∞t><Kp&¿\Ô:Ú\œ@9@75\–|n&¿\–}9≥]A9@\‚ !\ l&¿≥\–\ŒiB9@\'°ÙÖêk&¿\‰\ÿzÜpD9@\Ãa˜\√k&¿BZc\–	E9@\€\‡DÙkk&¿[ó\Z°üE9@ÄF\Èj&¿W\ÃoF9@$Ú]J]j&¿N\’=≤πF9@{ºêi&¿^K\»=G9@Ù\‹BW\"h&¿=µ˙\Í™H9@*\0\∆3hh&¿\Îå\ÔãKI9@üZ}uUh&¿gDioI9@éø∑\Èg&¿\Î\¬1\ÀJ9@\‘*˙C3g&¿YM\◊]K9@˙)éØf&¿ı¢vø\nL9@iˇ¨e&¿Éh≠hsL9@yít\Õd&¿8ü:V)M9@ˇXàÅc&¿’±J\ÈôN9@kdWZFb&¿QS\È\'P9@zZùúa&¿ıJYÜ8R9@/˝KRôb&¿=Ûr\ÿ}S9@∂J∞8d&¿K#fˆyT9@|Û&\Zd&¿CusÒ∑U9@ì:MÑe&¿^Háá0V9@}ZEhf&¿¶]P\ﬂV9@5\–|\Œ\›f&¿*ú\ﬁ\≈W9@BÚ\ÏÚe&¿\\[%XX9@ôf∫\◊Ie&¿´yé\»wY9@\·B¡çd&¿µ\Z˜XZ9@EÉ<Öd&¿+á\ŸZ9@ç`\„˙we&¿ÆE–∂Z9@≈é∆°~g&¿\"\08ˆ\ÏY9@¸S™Di&¿r£\»ZCY9@\÷\ZJ\ÌEl&¿^û\Œ•X9@>ñ>tAm&¿Ç’∞\ﬂW9@Òú- ¥n&¿RÛUÚ±W9@øï\Ï\ÿp&¿\Înû\ÍêW9@ePmp\"r&¿àòN\ÎV9@	\ƒ\Î˙s&¿L©K\∆1V9@M†àEt&¿-@\€j\÷U9@	]\ﬁv&¿&˛(\Í\ÃU9@kÛˇ™#w&¿\nj¯\÷U9@\“V%ë}x&¿=,‘ö\ÊU9@\’?àd\»y&¿\Õ\» wV9@≥\ÏI`{&¿L©K\∆1V9@´ì3w|&¿ó«öëAV9@\ƒ\Ã>èQ~&¿æ3⁄™$V9@\“\·!å&¿¶{ù‘óU9@˛e˜\‰aÅ&¿ë}êe¡T9@i8enæÅ&¿\È\r˜ë[S9@oüUfJÉ&¿iSuèlR9@Úy\≈SèÑ&¿¿ñWÆ∑Q9@›ô	ÜsÖ&¿¨0ôR9@iä\0ßwâ&¿ô+ÉjÉS9@–≥Yıπä&¿è4∏≠-T9@œ†°Çã&¿èãjU9@\‘-å&¿F\Ï@1V9@ewÉhç&¿d\Êó\«V9@zõ©é&¿¯§	¶V9@*©\–Dê&¿i¨˝ù\ÌU9@/\«Hˆê&¿.\ŒR≤T9@F\Ï@1í&¿\Ô\‰\”cS9@_\œ\◊,óï&¿9\Ôˇ\„ÑQ9@ÒGT®ñ&¿ §Ü6\0O9@kcÏÑóò&¿h\È\nN9@õZ∂\÷ô&¿∂f+/˘K9@Åz3jæö&¿7UÜqK9@\◊2é\Áõ&¿¶|™FK9@∂ºrΩmû&¿®ã\ \¬K9@sﬂâYü&¿Óµ†˜\∆L9@\Œˇ´é°&¿\»%é<M9@+Ñ\’X¬¢&¿bˆ≤\Ì¥M9@(\ 4ö§&¿\≈\≈QπâN9@\€\ƒ\…˝•&¿rm®\ÁO9@V*®®˙•&¿^Å\ËIôP9@3åªA¥¶&¿†\Ó\\Q9@[\nH˚®&¿\Án\◊KSP9@u\Áâ\Ál©&¿\Z\‹\÷ûO9@\‹b~nh™&¿]3˘fõO9@+£ëœ´&¿∞å\r\›\ÏO9@æáKé;≠&¿¥è¸6P9@ö\\kÆ&¿Ox	N}P9@)îÖØØ&¿ys∏V{P9@\nJ\— Ω∞&¿hî.˝O9@\ÕW\…\«\Ó≤&¿µ¶yO9@õ\„\‹&‹≥&¿vì˛N9@∑\”÷à`¥&¿2\ËLN9@]®¸kyµ&¿\‡i2\„mM9@\€˙\È?k∂&¿EΩ\‡”úL9@†¶ñ≠ıµ&¿^ÖîüTK9@Ω:«Ä\Ïµ&¿ù∫ÚYJ9@\œ\€\ÿ\ÏHµ&¿∞pí\ÊèI9@¥Wµ&¿Gç	1óH9@\‚s\'\ÿµ&¿á\ƒ=ñ>H9@\ƒ\Íè0∏&¿dêªSH9@*ˇZ^π&¿äë%sH9@\Ë3†ﬁå∫&¿Vn2™H9@›µÑ|–ª&¿ı9D\‹H9@|c\0éΩ&¿U‹∏\≈¸H9@∂0Ìúæ&¿≠mä\«EI9@$&®\·[¿&¿>îhI9@yë	¯5\¬&¿\Í{\r¡qI9@∞|∑y\√&¿B%Æc\\I9@πnJy≠\ƒ&¿¥íV|CI9@7\Í∞\¬\≈&¿N∑\ÏˇH9@Pn\€˜®\«&¿õ\Êß\ËH9@\Ôrﬂâ\…&¿©¡4I9@\Ï\’[\À&¿õ\»\ÃJ9@\Ô™\ÃC\Œ&¿Y¯˙ZóJ9@í?x\Ó\Õ&¿\‚\ \Ÿ;K9@h≥\Ísµ\Õ&¿!Øì\‚K9@ã¡√¥o\Œ&¿Ø\Ì\Ìñ\‰L9@πlt\ŒO\—&¿‘òsIM9@5c\—tv\“&¿Ûgö∞M9@îº:«Ä\‘&¿-Ø\\oõM9@Ø%‰Éû\’&¿HP¸L9@\Ãc\Õ\» \◊&¿1%í\ËeL9@\Ï°}¨\‡\◊&¿∏ [ñØK9@º∞5[y\Ÿ&¿0†\Ó\\L9@B[Œ•∏\⁄&¿˛\Ôà\n\’M9@î¢ï\€&¿Iˆ5CN9@&èß\Â\ﬁ&¿ö]˜V$N9@Çoö>;\‡&¿\Ë£\ÁN9@º<ù+J\·&¿\ÊÆÚN9@\rãQ\◊\‚&¿.\…N9@]˛C˙\Ì\„&¿]˚N9@E\÷\ZJ\Ì\Â&¿9D‹úJN9@ã™_\È|\Ë&¿&Q/¯4O9@\ËΩ\≈\Î&¿˘ÙÿñO9@\ ¸£o\“\Ï&¿;6Ò∫N9@\÷\ƒ_\—\Ì&¿ âvN9@$∑&›ñ&¿Éi>\"N9@\Ê\Í\«&˘Ò&¿¨S\Â{FN9@QL\ﬁ\0Û&¿h@Ω5O9@´\ÕˇÛ&¿4fıN9@ØB\ O™ı&¿«°~∂N9@NDø∂ˆ&¿µ\¬ÙΩN9@,Dá¿ë¯&¿\Ã\nE∫O9@sePmp˙&¿¡ò2pP9@^.\‚;1˚&¿Åy»îQ9@*\»\œFÆ˚&¿<Pß<∫Q9@0∫º9¸&¿_^Ä}tR9@\Î8~®¸&¿\"p$\–`S9@0Gè\ﬂ\€¸&¿CUL•üT9@¨r°ÚØ˝&¿8ªµLÜS9@‹∑Z\'.ˇ&¿ìUn2R9@â\ÓY\◊h\'¿ñ≥wF[Q9@\Z˜\Ê7L\'¿iUMQ9@ˆ\Óè˜™\'¿è9\œÿóP9@\Â(@\Ã\'¿êû\"áàO9@\Ó@ùÚ\'¿u\"¡T3O9@\ÁS\«*•\'¿#⁄é©ªN9@\Ô\«\ÌóO\'¿5Ò§M9@D\€1uW\'¿{2ˇ\ËõL9@\‘*˙C3\'¿Ñùb\’ L9@\0oÅ\≈\'¿\Ÿ[\ ˘bK9@Õê*äW	\'¿πƒë\"K9@[\Ô7\⁄q\'¿\Ó`\ƒ>L9@ø∑\È\œ~\'¿\ ¥êÄM9@©¢xïµ\r\'¿9\Ì)9\'N9@\€\›t_\'¿ÆbÒõ\¬N9@àòN\Î\'¿≠á/O9@ºÃ∞Q\÷\'¿¿îÅO9@\–~§à\'¿&\‚≠ÛoO9@Pâ\ÎW\'¿vß;O<O9@ÒÉÛ©c\'¿\Ã\“N\Õ\ÂN9@U2\√\'¿∞\Ákñ\ÀN9@¨o`r£\'¿ìS;\√\‘N9@JÒÒ	\Ÿ\'¿s0õ\0\√N9@ós)Æ*\'¿N~ãNñN9@xb÷ã°\'¿±ã¢>N9@e\ﬂ¡ˇ\'¿9∏t\ÃyN9@≥\—9?\≈!\'¿Qi\ƒ\Ã>O9@¥´êÚì\"\'¿º\Èñ\‚O9@öÏüß#\'¿hY˜èÖP9@\€\√^(`#\'¿(b\√R9@Éái\ﬂ$\'¿û\“¡˙?S9@\ÃbbÛq%\'¿\Ìˇ∞•S9@îΩ•ú/&\'¿Ü\À*lT9@ø—é~\'\'¿£Xni5T9@\'i˛(\'¿`u\‰HgT9@4h\Ëü\‡*\'¿8Ñ*5{T9@a˙^Cp,\'¿{\€LÖxT9@@¸¸˜\‡-\'¿x\—WêfT9@†3iSu/\'¿<üıfT9@KxBØ?1\'¿a\›xwdT9@mˇ\ Jì2\'¿]¬°∑xT9@yY4\'¿_@/‹πT9@ö\È^\'ı5\'¿\√.ä¯T9@T≠ÖYh7\'¿d∞\‚TkU9@&\„\…9\'¿†‹∂\ÔU9@¨\‡∑!\∆;\'¿_\Ì(\ŒU9@vOj=\'¿\…\Ã.èU9@\“mâ\\p>\'¿òßsE)U9@Å?¸¸?\'¿%$\“6˛T9@~SX©†B\'¿â\ÏÉ,V9@LS8ΩC\'¿pCå◊ºV9@´$≤≤D\'¿qtï\ÓÆW9@BØ?â\œE\'¿YNB\ÈY9@<L˚\ÊF\'¿[¥\0m´Y9@=÷årG\'¿ÆÒô\Ïü[9@\÷\„æ\’:I\'¿&\∆2˝]9@â&P\ƒJ\'¿\Áß8º^9@\‹FxL\'¿fL¡\Zg_9@£\È\ÏdpL\'¿•iP4`9@_iN^L\'¿°Üoa\›`9@{Ñö!UL\'¿\ﬁu6\‰üa9@§R\ÏhL\'¿\÷;\‹\rc9@\Ï˚pêM\'¿é\È	K<d9@uYLl>N\'¿]®¸kye9@à\’aP\'¿a∞\‰*f9@÷©Ú=#Q\'¿ºî∫dg9@4∫ÉÿôR\'¿;\„˚\‚Ri9@.\‚;1\ÎU\'¿Çã5òj9@@¶µilW\'¿Ñdl9@Ø\'∫.¸X\'¿\ﬁwè˝l9@h=|ô(Z\'¿\“o_\Œm9@£\\\ZøZ\'¿[A\”+o9@©0∂\\\'¿lò°ÒDp9@¶I*S\\\'¿F≤G®r9@\nø\‘œõZ\'¿õ\Â≤\—9s9@zR&5¥Y\'¿bÜ\∆At9@B]\¬Y\'¿\ÿI}Y\⁄u9@ü:V)=[\'¿U2\0Tqw9@∏Æò^\'¿4Ñcñ=y9@àªza\'¿0∫º9\\{9@é≠g\«d\'¿\ÓC\ﬁrı{9@˙µı\”f\'¿:ì6U˜|9@éD¡åi\'¿Ç\Ês\Óv}9@@QŸ∞¶j\'¿8.\„¶~9@òΩl;mm\'¿\'à∫@~9@âu™|o\'¿\›\Ó\Â>9~9@L\√q\'¿A\÷S´Ø~9@¯\∆\0s\'¿éyq\»~9@=É˘+t\'¿÷çwG\∆~9@‘òsIu\'¿ëz6´~9@¯màÒöw\'¿Rr•~9@\'¡“®x\'¿¥\…\·ì~9@\⁄SrN\Ïy\'¿1\ÕtØì~9@\Ï¯/|\'¿`ù∫~9@∫\Ÿ(∑}\'¿iQü\‰~9@a¸4\Ó\Õ\'¿ò˙ySë~9@\€kAÔçÅ\'¿\‹ı\“~9@\ﬁ<\’!7É\'¿òΩl;m}9@S$_	§Ñ\'¿\¬Kp\Í}9@N^ÙÖ\'¿¨8\’Z|9@>îà\'¿\\\ÊtYL|9@\ﬁs`9ä\'¿.=ö\Í\…|9@∑\r£ xå\'¿Å\nGêJ}9@iW!\Â\'ç\'¿t∑\Î•)~9@+\›]gCé\'¿öxx\“~9@SœÇPﬁè\'¿‹Ç•∫Ä9@q $òê\'¿ˇók\—Ä9@õ \Í>\0ë\'¿ÅòÑyÄ9@\Îè0Xí\'¿oûÍêõÅ9@\»–±ì\'¿6?˛“¢Ç9@\\qqTní\'¿¸èLáNÉ9@¥\‰Ò¥¸ê\'¿\—!p$Ñ9@˝3É¯¿é\'¿m\Êê\‘BÖ9@û\“¡˙?è\'¿h∞Ü9@\«hUMê\'¿l\\ˇÆœà9@.\0ç“•è\'¿3˝Ò÷â9@\÷8õé\0é\'¿˛\Ì≤_wä9@\ƒËπÖÆå\'¿	PS\À÷ä9@à,\“ƒã\'¿ÚòÅ\ ¯ã9@.X™xâ\'¿Uø\“˘å9@Ü\À*là\'¿¡6\‚\…né9@ùÑ\“BÜ\'¿FD1yê9@ÄGT®nÜ\'¿ê&åfë9@ùJÄ*Ü\'¿\Œoòhêí9@¿\–#FœÖ\'¿S>U£ì9@w¯k≤FÖ\'¿ü\€2\‡î9@h=|ô(Ç\'¿\Õx[Èµï9@väUÉ0\'¿ñ\Îm3ñ9@ÛÅ\Œ|\'¿sÇ69|ñ9@Ö¥∆†z\'¿+j0\ró9@\Í^\'ıey\'¿N\“¸1≠ô9@\Èb\”J!x\'¿Æ÷â\ÀÒö9@ñÈóà∑v\'¿S<.™Eú9@\ﬂQcB\Ãu\'¿7R∂H⁄ù9@TUh ñu\'¿3díëü9@\·\œf\rv\'¿ÇˇÇ†9@! _Bw\'¿Ç…ç\"k°9@πn¿w\'¿|\’ Ñ_¢9@GZ*oGx\'¿\⁄\»uS £9@N\r4üsw\'¿ê\⁄\ƒ…•9@ˆv√∂u\'¿®\‰ú\ÿCß9@ï~\¬Ÿ≠u\'¿Ñ\◊.m8®9@\“≈¶ïBx\'¿\ƒ†Q∫®9@&ç\—:™z\'¿\„ãˆx!©9@}\ÍX•Ù|\'¿K\‘‘≤©9@d]\‹FÄ\'¿±˙#™9@îi4πÉ\'¿+*ˇZ™9@í\"2¨\‚Ö\'¿	û^)´9@{M\nJâ\'¿h+¯m¨9@F~˝å\'¿/\›$Å≠9@≥ómßç\'¿\nö]˜Æ9@¸n∫eáê\'¿\‘\ÓWæØ9@\n.V\‘`í\'¿Ym˛_u∞9@>	l\Œ¡ì\'¿8ÇTä±9@˚Påî\'¿\Â\'\’>≥9@\›zMó\'¿]3˘fõ≥9@\ÀÙKƒõ\'¿QlMK¥9@\€2\‡,ù\'¿yìﬂ¢ìµ9@v3£\rü\'¿Ë°∂\r∑9@™õãü\'¿8\€‹òû∏9@Xêf,öû\'¿?ˇ=xπ9@U/ø\”dû\'¿\¬√¥o\Óª9@-y<-ü\'¿\Õu\Zi©º9@§rµ4ü\'¿®W\ 2ƒΩ9@D¢–≤\Óü\'¿ßñ≠ıEæ9@Q§˚9°\'¿` ê°ø9@IüV°\'¿\‹,^,¡9@≠àö\ËÛ°\'¿£:\»z\¬9@¶^∑§\'¿\‰\…\Â\√9@XsÄ`é¶\'¿\Ì*§¸\ƒ9@\0åg\––ß\'¿•.\«H\∆9@W\"P˝É®\'¿≠jIG9\»9@é\Ÿ\Î›ß\'¿29µ3L\…9@>ØxÍë¶\'¿é ïb\À9@ˇ∞•GS•\'¿˝Üâ)\Ã9@\◊h9\–C•\'¿ı-s∫,\Œ9@:yë	¯•\'¿âu™|\œ9@êkC\≈8ß\'¿CÀ∫,\–9@∂IEc\Ìß\'¿êhE,\“9@\nÑùb’®\'¿g≠á\”9@Òh„àµ®\'¿Zbe4Ú\’9@$%=≠¶\'¿cÚò˘\÷9@\ŸZ_$¥•\'¿\∆X\«Ò\◊9@Ku/3§\'¿)?©ˆ\È\ÿ9@sePmp¢\'¿QfÉL2\⁄9@v˙A]§†\'¿rådèP\€9@p\Í\…;ü\'¿îø{Gç\›9@\Ó–∞uù\'¿;6Ò∫\ﬁ9@BØ?âœù\'¿øÛãÙ\ﬂ9@~ß…å∑ù\'¿-\ÃB;ß\·9@QhY˜èù\'¿∞9œÑ\‚9@a˚\…û\'¿ÆÚ\¬\‚9@\Ó\Õoòh†\'¿ç\Ìµ†˜\‚9@¥∞ß˛¢\'¿ü`<\„9@™∫G6W•\'¿.rOW\„9@â≥\"j¢ß\'¿.rOW\„9@¢|©\'¿\≈7>[\„9@L¸Q‘ô´\'¿\ÌÄµj\„9@\Õôd\‰¨\'¿î˙≤¥S\„9@vΩSØ\'¿ßŒ£\‚ˇ\‚9@Qán˘∞\'¿\÷ÂîÄò\‰9@§ã¶≥≥\'¿¿\\ã†\Â9@5£\Zˆ≥\'¿åM+Ö@\Ê9@\·R)v¥\'¿Œå~4ú\Ê9@=\'Ωo|µ\'¿\›}éè\Á9@GUD›∑\'¿⁄´èáæ\Á9@9ô∏Uª\'¿v?T\Z\È9@NùG\≈ˇΩ\'¿\\\∆˙\Í9@[\\\„3Ÿø\'¿\–\Ì%ç\—\Í9@í^\‘\ÓW¡\'¿4wº\…\Î9@(E+˜\√\'¿2Ø#\Ÿ\Ï9@ß∞RAE\≈\'¿l\È\—TO\Ó9@hÆ\”HK\≈\'¿óqS\Õ\Ô9@è4∏≠-\ƒ\'¿ä»∞ä7Ú9@®˛A$\√\'¿ÀÖ øñÛ9@éÕéT\ﬂ¡\'¿≠Kç\–\œÙ9@\ﬂ4}v¿\'¿\0{ˆ\\ˆ9@˙%\‚≠Ûø\'¿Ü´ \Óˆ9@˘ıCl¿\'¿˙\”Fu:¯9@)H4Å\¬\'¿ÙﬂÉ\◊.˘9@\È`˝ü\√\ƒ\'¿\ﬂó™¥˘9@\¬\⁄;\·\≈\'¿vå+.é˙9@\Ó\—\Ó#\«\'¿\€\‡DÙk˚9@ÒK˝º©\»\'¿îær\ﬁ˚9@\ \≈X\«\…\'¿ƒñMı¸9@,∂IEc\Õ\'¿H≈´¨˝9@Ü:¨p\À\œ\'¿&9{˛9@yy:Wî\“\'¿ÑÚ>é˛9@ˆ\Óè˜™\’\'¿q\ \‹|#˛9@:í\ÀH\◊\'¿´yé\»w˝9@™\…\ÿ\'¿$ö@ã¸9@ªòf∫\◊\Ÿ\'¿9”Ñ\Ì\'˚9@\Ë/Ùà\—\€\'¿§˛zÖ˚9@\—\Õ˛@π\›\'¿1\Ôq¶	˚9@:í\ÀH\ﬂ\'¿\∆\√{,˚9@%\Ë/Ù\‡\'¿πP˘\◊Ú˙9@\Ê\ËÒ{\„\'¿˘ΩMˆ˚9@ByGs\‰\'¿\‰Ñ	£Y˝9@,Ù¡26\‰\'¿\Z\‹\÷ûˇ9@\Í\Œ\œ\Ÿ\‚\'¿\Íy7:@J\Ï\⁄\ﬁn\·\'¿_F±\‹\“:@ÅñÆ`\·\'¿¨7jÖ\È:@\ÀiO\…9\·\'¿M\Ÿ\È:@±Nï\Ô\·\'¿≤e˘∫:@\È)rà\‡\'¿oÿ∂(≥	:@+1\œJZ\·\'¿y\Ê\Â∞˚\n:@Ω7Ü\0\‡\‡\'¿ú\ﬁ\≈˚q:@–ô¥©∫\ﬂ\'¿\›\\¸mO:@ü∞\ƒ\ \ﬁ\'¿è5#É\‹\r:@\'›ñ\»\ﬂ\'¿Û¨§:@±£q®\ﬂ\›\'¿§4õ\«a:@.\ÁR\\U\ﬁ\'¿\Ê}ì¶:@ÉMùG\≈\ﬂ\'¿\Ã:ì:@†ä∑ò\ﬂ\'¿,ë\”\◊:@\Î\‰\≈\ﬂ\'¿\”L˜::@õiQ\ﬂ\'¿î\€ˆ=\Í:@¿\Ãw\ﬂ\'¿(\Ô\„hé:@/\\sG\ﬂ\'¿∂ˆ&\Z:@w˛E\‡\'¿ü\À2:@\«.QΩ5\‡\'¿\Ÿ=yX®:@éø∑\È\ﬂ\'¿\∆G\Â:@˚w}\Ê¨\ﬂ\'¿™+ü\Ây :@\nºìO\ﬂ\'¿;%Ø\":@U4\÷˛\Œ\ﬁ\'¿QŸ∞¶≤$:@ﬁêFN\ﬁ\'¿[&\√Ò|&:@∫jû#Ú\›\'¿4⁄™$≤\':@kÒ)\0\ﬁ\'¿lñ\ÀF\Á(:@íÆô|≥\›\'¿ùæûØY*:@:\Áß8\‹\'¿µP29µ+:@\œ\ŸB\€\'¿ÄÄµj\◊,:@˜\"⁄é©\€\'¿Ú\Îá\ÿ`-:@˛2\‹\'¿Z°H˜s.:@\ﬂ¿\‰Fë\›\'¿‘úº\»0:@	¡™z˘\›\'¿\'0ù\÷1:@¿\Z3â\⁄\'¿rMÅ\Ã\Œ2:@¥\«\È\ÿ\'¿ÙMöE3:@πç\ÿ\'¿±3Ö\Œ3:@\≈7>[\◊\'¿±˘∏6T4:@5≥ñ\“\÷\'¿raär5:@é\Ëûuç\÷\'¿\Á\„\⁄P16:@epîº:\◊\'¿\”k≥±7:@“ã\⁄˝*\ÿ\'¿hwH18:@\ƒ\·\—\∆\Ÿ\'¿\«\ÿ\œb9:@W@°û>\⁄\'¿^-wf::@›òû∞\ƒ\€\'¿å,ôcy;:@\≈t!V\‹\'¿\Í\"Ö≤<:@\"™gx\€\'¿\‘)ènÑ=:@o\‘\n\”˜\⁄\'¿êÖ\Ë8>:@∫Çmƒì\›\'¿\\và\ÿ>:@¥Swe\ﬂ\'¿ÛW\»\\@:@Ω¬Ç˚\·\'¿˘æ∏T•I:@\ÿÚ\ ı∂\·\'¿hXå∫\÷J:@ÆE–∂\‚\'¿xôa£¨K:@ÒÇà‘¥\„\'¿ì˝Û4`L:@RcB\Ã%\Â\'¿\Ï.PR`M:@l=C8f\È\'¿\\\»#∏ëN:@Ylìä\∆\Í\'¿ÚòÅ\ ¯O:@oH£\'\Î\'¿¸9˘\ŸP:@\„Pø[\Î\'¿9}=_S:@Rêh\Í\'¿J≤GWU:@n\‹b~n\Ë\'¿∏:\0\‚ÆV:@Å>ë\'I\Á\'¿Lç\–\œ\‘W:@z˝I|\Ê\'¿G™\Ô¸¢X:@\√fÄ≤\Â\'¿5C™(^Y:@\“˝úÇ¸\‰\'¿t&mZ:@¸™\\®¸\„\'¿ê£9≤Ú[:@Ÿ¥R\‰\‚\'¿â\ÓY\◊h]:@0bü\0ä\·\'¿K\‰ı`^:@\r\‡-ê\‡\'¿g\—;p_:@.\0ç“•\ﬂ\'¿z4’ì˘_:@_ñvj.\ﬂ\'¿ñ{ÅY°`:@S%\ \ﬁR\ﬁ\'¿˜êΩøa:@\«\’»Æ¥\‹\'¿á¡¸2c:@h\ÏK6\‹\'¿Ö\Ô˝\r\⁄c:@Ωã˜\„ˆ\€\'¿J\Ï\⁄\ﬁne:@”•I*\€\'¿m±g:@êˆ?¿\⁄\'¿\–EC∆£h:@‹Ω\‹\'G\Ÿ\'¿œÑ&â%i:@_yêû\"\◊\'¿\÷S´ØÆj:@§\√C?\’\'¿‘Å¨ßVk:@é≠g\«\‘\'¿7®˝\÷Nl:@ÆJ\"˚ \”\'¿-%\ÀI(m:@FC∆£T\“\'¿^ª\Ôn:@ˆ\ÏπLM\“\'¿\Ó\ÍUdtp:@jMÛé\”\'¿±4-±r:@l	˘†g\”\'¿H¬æùt:@[{\”\'¿w\‹ª\Èv:@l!\»A	\”\'¿lMK¨x:@é={.S\”\'¿§˝∞z:@ª\Ï◊ù\Ó\‘\'¿hzâ±L{:@PU°ÅX\÷\'¿ªîX|:@F\Ï@\Ÿ\'¿a2U0*}:@g&\Œ5\‹\'¿M∫-ë~:@p\Í\…;\ﬂ\'¿ã†m5:@2<ˆ≥X\‚\'¿´Yg|_Ä:@Æ¡8∏\‰\'¿\Èµ\ŸXâÅ:@)îÖØØ\Â\'¿ü\…˛yÇ:@\Â`6\Ê\'¿Ö˜Ñ:@`Wìß¨\Ê\'¿\»@û]æÖ:@Rf`\Ë\'¿∫/g∂á:@_¥\«\È\'¿\⁄Rêà:@\◊j{\È\'¿\Z£Æâ:@©J[\\\„\Î\'¿≥\Ó—â:@kúMG\0\Ô\'¿ˆ}8Hàä:@Ñ\Ÿñ\Ô\'¿Æ∑\ÕTàã:@LQ.ç_\'¿36t≥?å:@\√GƒîHÚ\'¿mésõå:@ÖAôFìÛ\'¿ÿõíìç:@/\ƒ\Íè0Ù\'¿\Á\—=\Îé:@∑ºTlÙ\'¿\‡\◊HÑè:@•æ,\Ì\‘Ù\'¿C˛ôA|ê:@‹ª}\Èı\'¿#k$ë:@◊Üäqˆ\'¿\€$í:@Rb\◊ˆˆ\'¿ıÇOsÚí:@kÛˇ™#˜\'¿ﬂåöØíì:@ø	Qˆ\'¿\0tò//î:@≠P§˚9ı\'¿ív£è˘î:@isú€ÑÛ\'¿ÛW\»\\ï:@\‡ÑBÚ\'¿ûx\Œñ:@ªî\'¿w\‹ª\Èñ:@°ù\”,\–\Ó\'¿fÜç≤~ó:@î1>\Ã^\Ó\'¿˙ôz\›\"ò:@I.ˇ!˝\Ó\'¿∏u õ:@û∂F\„\'¿í≤E\“nú:@⁄™$≤Ú\'¿ÆfùÒ}ù:@\'â%\Â\ÓÛ\'¿Vû@\ÿ)û:@Zd;\ﬂOı\'¿ÃòÇ5Œû:@\0ê&åˆ\'¿¶\rá•Åü:@¯˘\Ô¡k˜\'¿,ù\œ†:@¢∂\r£ ¯\'¿çÒaˆ≤°:@†®lXS˘\'¿SØ[∆¢:@	q\Â\Ïù˘\'¿Æ\ÎçZ•:@êø¥®O˙\'¿ª~¡nÿ¶:@¡\Ê<˙\'¿q:\…Vóß:@0\÷70π˘\'¿=+i\≈7®:@X\‰\◊±˘\'¿/¯4\'/Æ:@ö	Üs\r˚\'¿;ç¥Tﬁ≤:@cÚò˘˛\'¿è6éX≥:@(CUL•ˇ\'¿ke\¬/ı≥:@4wº\…ˇ\'¿¨\„¯°“¥:@-\\Va3\0(¿p#eã§µ:@û\Œ•Ñ\0(¿\Áß\ËH∂:@∞ë$W\0(¿]ßëñ ∑:@âu™|ˇ\'¿\r\√Gƒî∏:@\Ëyít˝\'¿ìR\–\Ì%π:@-\“\ƒ;¿˚\'¿\∆\ﬂˆâπ:@∫.¸\‡|˙\'¿¨\«}´u∫:@\Ï¯/¯\'¿\ÔVñ\Ë,ª:@æ**˜\'¿\Îsµ˚ª:@Ω\‚©G\ZÙ\'¿\∆˘õPàº:@.q\‰Å\»Ú\'¿h\–\–?¡Ω:@–∑KuÒ\'¿ñó¸O˛æ:@\¬\‹\Ó\Â>Ò\'¿I\’v|ø:@ÏâÆ?\'¿Aµm¡:@,.é\ M\Ï\'¿¥\ Li˝¡:@QÑ\‘\Ì\Ï\Î\'¿ò\‡\‘í\√:@-]¡6\Í\'¿¥î,\'°\ƒ:@ÜKÆb\È\'¿[\œé\≈:@$ÒÚtÆ\Ë\'¿H§m¸â\∆:@\\X7\ﬁ\È\'¿D¡å)X\«:@/Û:\Í\'¿í\ÀHø\…:@Ü!r˙z\Ó\'¿\–\'Ú$\È\ :@Ü7k\'¿\·y©ÿò\À:@c\“\ﬂKÒ\'¿A.q\‰Å\Ã:@\‘I∂∫úÚ\'¿PoF\ÕW\Õ:@ú5x_ïÛ\'¿éÀ∏©Å\Œ:@W=`2ı\'¿f/\€N[\œ:@º?ﬁ´Vˆ\'¿9õé\0n\“:@\Ôq¶	\€˜\'¿\€\ﬁnI\‘:@Û&\Z§¯\'¿2í=B\Õ\‘:@ãmR\—¯\'¿-Ø\\oõ\’:@òıI\Ó¯\'¿\¬\¬Iö?\÷:@\œı}8H¯\'¿fk}ë\–\÷:@Bv\ﬁ\∆f˜\'¿\\ê-\À\◊\Ÿ:@≥ôCRı\'¿\"\·{É\⁄:@\œg@Ωı\'¿uëBY\‹:@Iπ˚ı\'¿Cˇ+\ﬁ:@Û\Ã\Àa˜ı\'¿.v˚¨2\ﬂ:@∏WÊ≠∫ˆ\'¿GXT\ƒ\È\‡:@%w\ÿDfˆ\'¿∫\Ïø\Œ\·:@≥ôCRı\'¿Œ•∏™\Ï\„:@\Ãe˝\Ó\'¿¥\Ã\"[\Â:@öB\Á5v\È\'¿ão(|∂\Ê:@Nüt\"\È\'¿?\ZNôõ\Á:@\ÃC¶|\Ë\'¿H˙¥ä˛\Ë:@π\„M~ã\Ê\'¿ÚB:<Ñ\È:@ö\\åÅu\‰\'¿ö\ŒNG\È:@˜9>Zú\·\'¿ñ#d \Î:@f†2˛}\ﬁ\'¿Ø\Õ\∆J\Ã\Î:@A C\«\ﬁ\'¿òıI\Ó\Ï:@\Ó]ÉæÙ\ﬁ\'¿7ßí\Ì:@LK\ﬂ\'¿\ÂcwÅí\Ó:@5a˚\…\ﬂ\'¿´∞\‡Ç:@∏\À~\›\È\ﬁ\'¿˚s—êÒ:@Ç…ç\"k\›\'¿˙`Ú:@Ÿ≥\Á25\Ÿ\'¿º \"5\ÌÚ:@ß\ƒ$\\\ÿ\'¿]6:\ÁßÙ:@sπ¡Pá\’\'¿üuçñı:@{JŒâ=\‘\'¿WBwIúı:@‘∏7øa\“\'¿∏\Í:TSˆ:@\—w∑≤D\œ\'¿\“\·!åüˆ:@ {Ω˚\„\Õ\'¿8\⁄q\√\Ôˆ:@ıº\n\À\'¿\Óxìﬂ¢˜:@∑*â\ÏÉ\ƒ\'¿v˛\”\r¯:@˛De√ö\¬\'¿/˜\…QÄ¯:@\·zÆG¡\'¿/Ü\»˘:@Û\Â\ÿGø\'¿¨S\Â{F˙:@zõ©æ\'¿Ag“¶\Í˙:@eo)ÁãΩ\'¿\Z\‹\÷û˚:@¡®§N@ª\'¿\‰N\È`˝˚:@A\”+£π\'¿V∫ªŒÜ¸:@/R(_∑\'¿W\nÅ\\\‚¸:@PPäV\Óµ\'¿ﬁ™\ÎPM˝:@™\Ô¸¢µ\'¿¯\‡µK˛:@@¡≈ä\Z¥\'¿§QÅìm\0;@GW\È\Ó¢\'¿gÔå∂*;@ΩäåH¢\'¿÷ßì\≈;@ó¨äpì°\'¿Gqé::;@\—>V€†\'¿®©ek};@\«\’»Æ¥ú\'¿uV\Ï1;@âz¡ß9ô\'¿ \‘E\ne;@Ç≠,ó\'¿°æeNó;@û]æıaï\'¿çöØíè;@\—X˚;€ì\'¿â#D;@≥DgôEê\'¿V\’\À\Ô4;@ª\n)?©é\'¿E/£Xn;@Ç)[$ç\'¿\nˆ_\Á¶;@Ñ) •Òã\'¿ÛØ\Âï\Î;@h\«,{ä\'¿p\ÓØ˜;@2\Ã	\⁄\‰à\'¿ÿ∏˛]ü;@vS\ k%Ñ\'¿b,\”/;@J+á~\'¿ÜÆD†˙;@6\"ó~\'¿@mTß;@\·&£\ 0~\'¿\Áå(\Ì\r;@q\ÀGR\“{\'¿∞VÌöê;@\∆0\'hì{\'¿CY¯˙Z;@∏\È\œ~§x\'¿\0\„4;@:@0Gèw\'¿º>s÷ß;@ΩU◊°ör\'¿ÿÅsFî\n;@◊Üäqn\'¿=⁄®N;@\ËL\⁄Tm\'¿i\‡G5\Ï;@t\'\ÿùk\'¿\› µâ;@c|òΩlc\'¿!?πn\n;@ÿª?ﬁ´^\'¿Qköwú\n;@˜Ù¬ù[\'¿˙\ÃYü\n;@œ†°Z\'¿˚z\·\Œ	;@\—!p$X\'¿\ﬂ¬∫Ò\Ó;@jÑ~¶^W\'¿˝£o\“4;@àº\Â\Í\«V\'¿!\È\”*˙;@¨\Â\ŒL0T\'¿êim\Z\€;@\·$\Õ\”R\'¿Ÿ¥R\‰;@5}v¿uM\'¿j\›µ\ﬂ;@µmI\'¿õYKi;@†\ƒ\ÁN∞G\'¿\€$∂ª;@∆æd\„¡F\'¿\Â\n\Ôr;@ù,µ\ﬁoD\'¿£ì•\÷˚;@Ç\‰ùCB\'¿_\œ\◊,ó;@r•ûA\'¿VDMÙ˘;@iä\0ßw9\'¿;äs\‘\—;@∑ñ\…p<7\'¿¸\0§6q;@èT\‚:6\'¿Ú	\Ÿy;@\—<ÄE~5\'¿{L§4õ;@A∏\nı4\'¿\ nfÙ£	;@q©J[\\3\'¿!\"5\Ìb\n;@\„˝∏˝Ú1\'¿†‹∂\ÔQ;@π•’ê∏/\'¿8Ωã˜;@¸èLáN/\'¿§®3˜ê;@ò€Ω\‹\'/\'¿p∂π1=\r;@2Àû6/\'¿o\◊KS;@\—\œ\‘\Î1\'¿îi4π;@àæªï%2\'¿ß\Õ8\rQ;@á\ZÖ$≥2\'¿a¡˝Ä;@M!u;3\'¿ |(—í;@†\¬§R4\'¿j¡ãæÇ;@dœû\À\‘4\'¿z\ƒ\Ëπ;@\»\n~b4\'¿íu8∫J;@XéêÅ<3\'¿oÙ1;@òÜ\·#b2\'¿Ks+Ñ\’;@B≤Ä1\'¿ÅîÿµΩ;@väUÉ0\'¿÷ã°úh;@\–_\Ë£/\'¿çüq\·;@à0~\Z˜.\'¿\√c\“;@g\nù\◊\ÿ-\'¿°/Ω˝π ;@c\Ì\Ôlè.\'¿:#/k\";@9\Óî\÷/\'¿^¸o%#;@\"9ô∏U0\'¿O §Ü6$;@%tó\ƒY1\'¿AÚŒ°%;@¯\‚ãˆx1\'¿è\ƒ\À\”%;@ö%jj1\'¿\0X9\“);@\–&áO:1\'¿òÜ\·#b*;@U¡®§N0\'¿\ﬁ<\’!7+;@jΩ\ﬂh\«-\'¿\…W)±+;@Vc	kc,\'¿\ÃB;ßY,;@¥Yıπ\⁄*\'¿˜Hm\‚,;@3¶`ç≥)\'¿Ù4`êÙ-;@8©0∂(\'¿NM\”g/;@\‹~˘d\≈(\'¿ä\‡+1;@nß≠¡(\'¿ŒßéU2;@Û<∏;k\'\'¿W#ª2;@’îdé&\'¿:3P3;@Nµf°%\'¿Å\Ïı\Óè3;@áP•f$\'¿\√+Iû\Î3;@ÀºU◊°\"\'¿ì\‡\riT4;@°û> \'¿%\Õ\”\⁄4;@≠\›v°π\'¿B{ıÒ\–7;@¶\–\“5\'¿S	O\Ëı7;@≥yÛ7\'¿π˙±I~8;@ß\"\∆:\'¿w;S\Ë8;@\‹Fx<\'¿Ü %\Ã8;@\€ikD0>\'¿¥\È\‡f9;@û≤öÆ\'B\'¿˘€û ±9;@X\Z¯Q\rC\'¿\‡g\\8:;@Ê≠∫\’D\'¿ñ%:\À,:;@\Ì(\ŒQGG\'¿n\›\ÕS:;@¸-\ŒH\'¿\Ÿ|\\*:;@\"ç\núlK\'¿0Ç\∆L¢:;@¨ \Ó\ÍM\'¿˝3É¯¿:;@v\‘~kO\'¿wù\r˘g:;@H\≈ˇQQ\'¿†R%\ \ﬁ:;@P¸s\◊R\'¿É¶%VF;;@À†\⁄\‡DT\'¿d*\„\ﬂ;;@vß;O<W\'¿fÑ∑!<;@kù∏ØX\'¿\Z1≥\œc<;@\È_í\ [\'¿J]2éë<;@Ü\Ê:ç¥\\\'¿©\€\ŸW<;@iSuèl^\'¿\ƒ\Œ:;;@\Á\¬H/j_\'¿\Îptï\Ó:;@û\‚<ú`\'¿\÷S´ØÆ:;@xµ‹ôa\'¿W\ÓfÖ:;@ùH0\’\Ãb\'¿6\Àe£s:;@T7\€c\'¿Å\È¥nÉ:;@≥ıµ.e\'¿˜\Í\„°\Ô:;@i\√ai\‡g\'¿Åx];;@™(^emk\'¿\Ê\…52;;@êj\ÿ\Ôâm\'¿ë’≠ûì:;@\»“á.®o\'¿˘ü¸\›;:;@àªzq\'¿(Fñ\Ã9;@”æπør\'¿\Œn-ì9;@#°-\ÁRt\'¿ \‘E\ne9;@&U\€Mu\'¿|òΩl;9;@N∂Å;Pw\'¿¬¢\"N\'9;@j‹õ\ﬂ0y\'¿7\√\r¯¸8;@{˜\«{\’z\'¿\›\'G¢8;@ä Ü5ï}\'¿*\ƒ#ÒÚ8;@Rûy9\Ï~\'¿@Nò0ö9;@\r´x#ÛÄ\'¿Õ´:´:;@\›(≤\÷PÇ\'¿ú√µ\⁄\√:;@:≤Ú\À`Ñ\'¿âu™|;;@A-”é\'¿bÉÖì4;;@øÙˆÁ¢ë\'¿\nLßu<;@\»	F≥í\'¿82è¸¡<;@l	˘†gì\'¿q≠ˆ∞>;@£@ü»ìî\'¿¿\Õ\‚\≈>;@§˝∞Vï\'¿,Çˇ≠d?;@åŸíUñ\'¿“´JCA;@ø\“˘,ô\'¿≤ˆw∂GC;@˛++MJô\'¿ö∞˝dåC;@´\ŒjÅ=ñ\'¿)íØRJ;@%X\Œ¸ö\'¿}]ÜˇtS;@çõ\Zh>ß\'¿Ö\–AópT;@\ﬁ\∆fG™ß\'¿⁄®N≤V;@Bµ¡â\Ëß\'¿ÕÆ{+W;@MeQ\ÿE©\'¿Q\ÿE\—W;@\Î¨\ÿc™\'¿êÉf\⁄V;@\„\nü≠´\'¿(÷©Ú=W;@f§\ﬁS9≠\'¿,F]k\ÔW;@å_\Ì(Æ\'¿éX;@Çê,`Ø\'¿<Ù›≠,Y;@(Òπ\ÏØ\'¿˙‘±J\ÈY;@\≈8\n±\'¿bèo[;@∫ÖÆD†≤\'¿\—#F\œ-\\;@(˜é\Z≥\'¿Fπã0];@\Ó≤_w∫≥\'¿ŒéT\ﬂ˘];@\‰ı`R¥\'¿Ç\≈\·ÃØ^;@≠˘Òóµ\'¿∑y\„§0_;@WBwIúµ\'¿°˜\∆\0`;@\’%\„…∂\'¿V\’\À\Ô`;@¥é™&à∫\'¿∂°búøa;@AÇ\‚«òª\'¿§30Ú≤b;@ù∏Ø@º\'¿0∏\Êé˛c;@ºZ\ÓÃº\'¿/\›$Åe;@uìVæ\'¿KìR\–\Ìe;@\ÌE¥Sø\'¿\–)\»\œFf;@\∆‹µÑ|¿\'¿ü\Âypwf;@˛\Ì≤_w\¬\'¿ëÚìjüf;@\ZS∞\∆\Ÿ\ƒ\'¿πß´;g;@} y\ÁP\∆\'¿≤Ú\À`åh;@l\Ó\Ëπ\∆\'¿®\∆K7âi;@f\À-≠\∆\'¿t\‘\—q5j;@f\À-≠\∆\'¿πã0Eπl;@u\Áâ\Ál\…\'¿πOéDm;@_µ2\·ó\ \'¿\ﬂ\‚\·=n;@≤h:;\Ã\'¿L3\›\Î§n;@\Â	Ñùb\Õ\'¿q©J[\\o;@üF\œ\'¿e4Úy\≈o;@†8Ä~\ﬂ\œ\'¿Ú%Tp;@Qj/¢\Ì\–\'¿¸â Ü5q;@x≥\Ô´\“\'¿+i\≈7r;@K\‰Ç3¯\”\'¿óé9\œ\ÿw;@FaE\‹\'¿õëA\Ó\"x;@\ÔÀô\Ì\n\›\'¿Ùßç\Ítx;@ﬂ®¶\Ô\›\'¿cÏÑó\‡x;@¿]ˆ\ÎN\ﬂ\'¿iUK:\ y;@û\–\ÎO\‚\'¿|a2U0z;@:\œÿól\‰\'¿ú\'æ\⁄y;@\"ƒï≥w\Ê\'¿\ÿDf.py;@±\ﬂ\ÎT\È\'¿F\'K≠˜w;@é*çòÒ\'¿5ôÒ∂\“w;@1\ÍZ{üÚ\'¿h\Á4¥w;@\ŸÕå~4Ù\'¿_õçïòw;@Àæ+Çˇı\'¿ü\Ë∫Éw;@àÚ-$¯\'¿c∂dUÑw;@9)\Ã{ú˘\'¿–ô¥©∫w;@P\ﬂ2ß\À˙\'¿˘\Ÿ\»uw;@˛E–òI¸\'¿Ugµ¿w;@Ω5∞UÇ˝\'¿-]¡6v;@<g≠ˇ\'¿ƒô_\Õv;@\‚\Â\È\\Q(¿]â@ıv;@4iSuè(¿\»Eµà(v;@\rπß´(¿\’ \Ã\Ì^v;@;:ÆFv\r(¿Û!®\ZΩv;@|_\\™\“(¿oeâ\Œ2w;@\"ˇ\Ã >(¿\ÌE¥Sw;@\Ô8EGr(¿^\◊/\ÿ\rw;@iQü\‰(¿mscz\¬v;@y@Ÿî+(¿\≈Eùπw;@n¬Ω2o(¿\„¸M(x;@*≠ø%\0(¿àÚ-$x;@äM†(¿Tb.x;@≥E\“nÙ(¿ë	¯5íx;@7U˜\»\Ê\Z(¿áÜ≈®ky;@Ωè£9≤\Z(¿P8ªµLz;@+\ﬂ3°(¿ÚC•3{;@û∂F\„(¿õ\ËÛQF|;@º}\È\Ì(¿\ÁS\«*};@B»óP(¿˙+dÆ~;@ﬁépZ\Z(¿≤Ñµ1v~;@&7ä¨5(¿ïÑ^~;@µQùd(¿∂üåÒa~;@\ÿHÑ+ (¿g_yêû~;@\"p$\–`#(¿\Î;ø(A;@4Ü9Aõ$(¿aE|Ä;@f\⁄˛ï%(¿øHhÀπÄ;@≠i\ﬁqä&(¿7˝ŸèÅ;@^ÉæÙˆ\'(¿O$òjfÅ;@¶\‘%\„)(¿à\rNÇ;@/3lîı+(¿∞≠ü˛≥Ç;@≤G®R-(¿≤g\œejÇ;@*9\'ˆ\–.(¿x\“\¬eÇ;@∆Ö!Y0(¿2q´ Ç;@∆Ünˆ2(¿ˆCl∞pÇ;@r \nf4(¿\Ï\¬ŒßÇ;@ä≠†iâ5(¿4\◊i§•Ç;@Òπ\Ïø6(¿•\‹}éèÇ;@â\'ªô\—7(¿¿wõ7NÇ;@±¡\¬I:(¿Tç^\rPÇ;@wæü\Z/=(¿©æÛãÇ;@KXc?(¿B[Œ•∏Ç;@ãmR\—@(¿LKÉ;@&P6\ÂB(¿˜tu\«bÉ;@IJzZE(¿¨õ\‰GÑ;@Ä\'-\\VI(¿óÆ`ÒÑ;@:\ ¡lL(¿¨8\’ZòÖ;@\'˙|îO(¿|E∑Ü;@µˇ÷™U(¿\Á\¬H/já;@∞å\r\›\ÏW(¿)YNB\Èá;@`\ ¿Y(¿3ç&cà;@[{ü™B[(¿Bïöâ;@∏≠-</](¿∫∫c±Mä;@v7Ou\»](¿OZ∏¨¬ä;@P\’\È@^(¿óqSã;@¡X\ﬂ¿\‰^(¿$0‹ã;@<J%<°_(¿aäriå;@Ö?√õ5`(¿∞èN]ç;@ƒîH¢óa(¿\\\Á\ﬂ.˚ç;@V(\“˝úb(¿NDø∂~é;@Ÿò\◊ád(¿\√}\‰÷§è;@||Bv\ﬁf(¿µN\\éWê;@\"ˇ\Ã >h(¿GêJ±£ë;@J}Y⁄©i(¿&ç\—:™í;@Ö—¨lj(¿Iÿ∑ìàî;@\œˆ\Ë\r˜i(¿ª{Ä\ÓÀï;@+àÅÆ}i(¿qè•]ò;@WZF\Í=m(¿Ω\Z†4‘ò;@	5C™(n(¿)îÖØØô;@ú€Ñ{en(¿\»A	3mõ;@ß\ÊrÉ°n(¿\ƒ\“¿èjú;@_õçïòo(¿π\ZŸïñù;@∏\È\œ~§p(¿Y£¢—ù;@)z\‡c∞r(¿Ö\œ\÷¡ù;@m\06 Bt(¿%!ë∂ù;@ÃòÇ5\Œv(¿ö|≥Õçù;@¨\„¯°\“x(¿<3¡pÆù;@\„Tkaz(¿\ÔSUh û;@“ç∞®à{(¿CBïû;@[%X\Œ|(¿˛ÛﬂÉü;@»≥À∑~(¿AÙ§Lj†;@§ãM+ÖÄ(¿\¬hV∂°;@¿wõ7NÇ(¿ÛWy°;@˙ÚÏ£É(¿¶	\€O∆†;@^ª¥·∞Ñ(¿Ö\Ì\'c|†;@r2q´ Ü(¿€áº\Â\Íü;@g\÷R@⁄á(¿áP•fü;@†8Ä~ﬂá(¿ÉQIùÄû;@J\rm\06à(¿\'Öyè3ù;@\ÓvΩ4Eà(¿Æg\«,õ;@\Ï\€ID¯á(¿H4Å\"ö;@Ó∞â\Ã\\à(¿˘£®3˜ò;@_(`;â(¿[\Ìa/ò;@%\\\»#∏â(¿B\Î\·\ÀDï;@	2*â(¿;]•ªì;@\∆3hËüà(¿àæªï%í;@?é\Ê\» á(¿6Vbûïê;@\œˆ\Ë\r˜â(¿5sªóè;@\‡ù|zlã(¿Rr•é;@*ß=%\Áå(¿˙π°);ç;@%\…s}é(¿#Ü∆§ã;@™d\0®\‚é(¿≠L¯•~ä;@\Zß!™è(¿¶ÒØ$â;@ë{∫∫cë(¿5óuà;@\Ë¢!\„Qí(¿\∆2˝ÒÜ;@ç_x%…ì(¿¥sö⁄Ö;@ú\Ê=Œî(¿ª+ª`pÖ;@¸¢˝ï(¿~©ü7Ö;@?q\0˝ñ(¿A.q‰ÅÑ;@\ÍØWXpó(¿öœπ\€ıÇ;@ZΩ\√\Ì–ò(¿MÙ˘(#Ç;@¢`\∆¨ô(¿£í:Å;@.q\‰Å»ö(¿D3OÆ)Ä;@3\≈ù(¿Xrã;@∂Ω›í†(¿ú¶\œ∏~;@Å0e\‡†(¿¶F\Ëg\Í};@\›\\¸mO†(¿|\Ôo\–^};@î0\”ˆü(¿¯Ñ|;@/á\›wü(¿!Øì\‚{;@õèkCù(¿{°Ä\Ì`|;@≥q¨ãõ(¿∞\Ê\0¡};@£\Á∫ö(¿\·Câñ<~;@m¨\ƒ<+ô(¿áâ)x~;@\◊¿V	ó(¿GW#;@§âwÄ\'ï(¿\Õ >∞\„;@§ã¶ì(¿Ú≥ëÎ¶Ä;@\ﬂ6S!ë(¿`±Üã\‹;@\√ABîè(¿É›∞mQ~;@¥:9Cqè(¿y<-?p};@F\Í=ï”é(¿ﬂà\ÓY\◊|;@Pß<∫é(¿Qª_¯z;@≤\‘zø—é(¿\Œ¡3°Iz;@€à\'ªë(¿¡Uû@\ÿy;@R<æΩì(¿’Æ	içy;@}?q\0ï(¿Ùßç\Ítx;@\ÌFÛô(¿¢\Î\¬\Œw;@q©;ö(¿–∏p $w;@\⁄SrN\Ïô(¿QL\ﬁ\03w;@\’[[%ò(¿hzâ±Lw;@¿\Ãwó(¿Aü»ì§w;@\‰ı`R|î(¿ìˇ\…ﬂΩw;@é={.Sì(¿.W?6\…w;@-Ø\\oõë(¿@âœù`w;@^\’Y-∞è(¿E\ÿÙJu;@ôùE\Ôå(¿¢C\‡Ht;@H¬æùå(¿B\ÏL°Ûr;@æ˙xËªã(¿v\„›ë±r;@¨X¸¶∞ä(¿ïÓÆ≥!s;@F≤G®ä(¿\Ê»≥s;@`∞∂-ä(¿Ù\ƒs∂Ät;@†§¿òä(¿¢≤aMeu;@\ﬁ	äã(¿5Sv;@\“\¬e6ã(¿,e\‚Xw;@i¢ä(¿~\Z˜\Ê7x;@ |(â(¿Ö|–≥Yy;@É¬†L£â(¿˜>UÖz;@zâ±LøÑ(¿˘ÑÏºçy;@0Û¸ƒÅ(¿Émƒì\›x;@J∑%r¡Å(¿Tn¢ñ\Êv;@\€P1\ŒﬂÑ(¿h\Ê\…5v;@ï\÷ˇ9Ñ(¿{Ö˜v;@[A\”É(¿MÙ˘(#v;@\"óéÅ(¿\€ikD0v;@¨s\»^(¿ÉﬂÜØu;@\–^}<Ù}(¿W≥\Œ¯æt;@\r5\nIf}(¿l$	\¬t;@ö@ã~(¿8hØ>r;@qTn¢ñ~(¿Æ†iâïq;@QfÉL2Ç(¿êO\»\Œ\€p;@Nú\‹\ÔPÑ(¿+Pã¡\√p;@\À-≠ÜƒÖ(¿<p\œÛo;@2\ 3/áÖ(¿“®¿\…n;@◊â\ÀÒ\nÑ(¿ì\05µlm;@•†\€K\ZÉ(¿@3à\Ïl;@ú˚´\«}É(¿ì7¿\Ãwl;@©°\r¿Ñ(¿$ò¿≠k;@\‰.\¬Ö(¿h≤ûd;@kGqé:í(¿5Lk\”\\;@+ï\‘	ò(¿rådèP[;@Mg\'É£§(¿0+\È~Z;@a\\:\Ê§(¿ö≤\”V;@\Î\Z-z†(¿W\ÓfÖN;@˝£o\“4®(¿dø\r1N;@ä\ÈB¨˛®(¿9)\Ã{úM;@&P6\Â™(¿\¬ª}VM;@:ï\0U¨(¿ 	˚vM;@ Fè6Æ(¿\„4ÙOL;@0Å[w≥(¿¿œ∏p L;@Mæ\Ÿ\Ê∆¥(¿oùª\ÏK;@∏Æò∂(¿J\Îo	¿K;@]P\ﬂ2∑(¿DkEõK;@≠¡˚™\\∏(¿\Ÿ\Ã!©ÖJ;@˘\Ÿ\»uS∫(¿S±1Ø#J;@	\ƒ\Î˙ª(¿=Fy\Ê\ÂH;@{Cr2π(¿@0Gè\ﬂG;@kÙjÄ“∏(¿ÉæÙˆ\ÁF;@˝\›;jL∏(¿\ÊCVD;@\‡\ŸΩ\·∂(¿o∑$\ÏB;@\ﬂ\›\ ùµ(¿\‰Ωje\¬?;@ß\È≥Æ≥(¿J\rm\068;@†˚rf≥(¿oÿ∂(≥1;@¢|A	∞(¿\‚ëxy;@ø∆àD±(¿œÖë^\‘;@x\’\Ê!´(¿$ô\’;\‹;@ÊØêπ≤(¿x\’\Ê!;@ß>êº≥(¿ï\÷\ﬂÄ;@î˚äµ(¿\–\Ô˚;@IüV—∑(¿\'æ\⁄Q;@Ù˙ì¯‹π(¿\¬˚™\\®;@33333ª(¿)H4;@ì©ÇQIΩ(¿ÄÚw\Ô®;@\'¢_[ø(¿\‡°(\–\';@Æ~lí¡(¿RôbÇ;@\"6X8I\√(¿”ÉÇR¥;@#K\ÊX\ﬁ\≈(¿∂Ä\–z¯;@KXc\«(¿K¨åF>;@êÑ};\…(¿:vPâ;@^ë\ (¿âõS\…\0;@mW\ËÉe\Ã(¿@á˘Ú;@DO §Ü\Œ(¿\nÜs\r3;@‘∑\Ã\È≤\–(¿Ω¶•;@E\Ÿ[\ ˘\“(¿;˚ ÉÙ;@~p>u\‘(¿(\r5\n;@)\ﬂ\ﬁ\’(¿W\nÅ\\\‚;@+ï\‘	\ÿ(¿â\”I∂∫;@GˇÀµh\Ÿ(¿\„4ÙO;@≥$@M-\€(¿îÑD\⁄\∆;@\“7i\Z\›(¿ä\ÀÒ\nD;@\œ˘.•\ﬁ(¿∞ Ö ø;@®\‚\∆-\Ê\ﬂ(¿\Z2•;@\ﬁ\‰∑\Ëd\·(¿ºËæú;@ál ]l\‚(¿é ;@>	l\Œ¡\„(¿\Õ\Ã\Ã\Ã\Ã;@´$≤≤\‰(¿>\Õ…ã;@|Ä\ÓÀô\Â(¿qs*;@&®\·[X\Á(¿=ö\Í\…¸;@bÛqm®\Ë(¿º}\È\Ì;@≈´¨m\Í(¿\÷\‡}U.;@G¢`\∆\Ï(¿7®˝\÷N;@¡X\ﬂ¿\‰\Ó(¿\œdT;@´	¢\Ó(¿\‹Ùg?R;@±\¬-IÒ(¿`;±O;@\\:\Ê<Û(¿\÷TÖ];@è9\œÿóÙ(¿.rOWw;@r¯§	ˆ(¿\ﬁÑÄ;@µ©∫G6˜(¿⁄¨˙\\m;@\‘÷à`¸(¿¡\ƒEù;@√õ5x_˝(¿∫jû#Ú;@∞´\…S˛(¿[\ÏˆYe;@5∏≠-<ˇ(¿Ÿ¥R\‰;@X:û%\0)¿\À2êg;@\Ê=\Œ4)¿˘.•.;@Um7¡7)¿#Ù3ı∫;@\«JÃ≥í)¿ªù}\ÂA;@Éˆ\Í\„°)¿ÙlV}Æ;@sd\Âó¡)¿\ R\Î˝F;@!ÀÇâ?\n)¿ˇØ:r§;@˝Nìo)¿ö{H¯\ﬁ;@”æπøz)¿˙\”Fu:;@ÆG\·z)¿\„ßqo~;@-&6\◊)¿dZõ\∆ˆ;@7ﬂà\ÓY)¿\ƒ%«ù\“;@_yêû\")¿êÇßê+;@öû)¿≥µæHh;@∑|$%\r)¿xòˆ\Õ˝;@\ÃbbÛq\r)¿ƒµ\⁄\√^;@ú˝År\€)¿bÅØ\Ë\÷;@=⁄®N)¿∂Ov3;@ï¨™ó)¿û`ˇun;@6Ø\Í¨)¿&\Â`6\r;@Ç:\Â—ç)¿\ﬂƒêúL;@Fè6é)¿-\Íì\‹a;@øò-)¿•\‹}éè\n;@Ö—¨l)¿\◊\‹\—ˇr	;@\'Öyè)¿îÑD\⁄\∆;@(õr)¿ö`8\◊0;@£>+)¿¥é™&à;@ˆ\ m˚)¿\ƒB≠i\ﬁ;@\≈»í9ñ)¿\›Î§æ,;@U0*©)¿<p\œÛ;@A\ÿ)V\r\Z)¿\ÿ-c};@Æ÷â\ÀÒ\Z)¿\Ó#∑&\›;@Û\0˘ı)¿µ7¯\¬d;@í≤E\“n)¿0bü\0ä;@§¶]L3)¿\Õ#0\0;@£Y\Ÿ>\‰)¿\…8F≤G\0;@\—Aóp\Ë)¿\»A	3mˇ:@åŸíU)¿∞\≈nüU˛:@\◊0C\„â )¿x{Ú˝:@\‰2nj†!)¿ªÒ\Ó\»X˝:@\»\Ï,zß\")¿W\ÍY\ ˚:@~\‡*O $)¿Û\Ï£S˚:@˙^Cp\\&)¿º\…o\—\…˙:@¸®Ü˝û()¿∑`©.\‡˘:@8¢{\÷5*)¿\Á√≥˘:@\√Ò|\‘+)¿†àE;¯:@B\—<ÄE.)¿\œ\⁄mö˜:@Ω7Ü\00)¿æk–ó\ﬁˆ:@b¢A\nû2)¿\Õ˝/\◊ˆ:@&\»®p4)¿\√(\ﬂˆ:@#ø~à\r6)¿^ëöˆ:@*å-98)¿\‚\–(]ˆ:@&:\À,B9)¿∞X\√E\Óı:@°ıe:)¿*¨TPQı:@\„8jπ;)¿GXT\ƒ\ÈÙ:@\Ôo\–^}<)¿û\Ôß\∆KÛ:@⁄®N≤>)¿%ZÚxÚ:@~QÇ˛B?)¿P´îûÒ:@∂Úíˇ\…?)¿Òõ\¬JÒ:@Y˜èÖ\Ë@)¿H6W\Õs:@$\n-\Î˛A)¿(˜é\Z\Ô:@Ë°∂\rC)¿SB∞™^\Ó:@∂KKC)¿˝æÛ\‚\Ï:@ıHÉ\€\⁄B)¿í \\Ö\Í:@Y¶_\"\ﬁB)¿˜±ÇﬂÜ\Ë:@Mfº≠ÙB)¿>¥è¸\Ê:@˜ë[ìnC)¿û\–\ÎO\‚:@\Ì\’\«CG)¿Ùz\ƒ\Ë\·:@øùDÑI)¿7\Í∞\¬\·:@uëBY¯J)¿ØZôK\·:@\„n≠M)¿Y˜èÖ\Ë\‡:@Ò∫~¡N)¿\…°f\‡:@:$µP2Q)¿\”˙[\ﬂ:@[{S)¿¨V&¸R\ﬂ:@üuçñU)¿%ZÚx\ﬁ:@Y\"ßØW)¿#\‹dT\ﬁ:@ªµLÜ\„Y)¿~è˙\Î\ﬁ:@eˇ<\r\\)¿•ÙL/1\ﬁ:@\ËΩ1\0_)¿u\»\Õp\ﬁ:@≈è1w-a)¿\"\„Q*\·\›:@2v\¬Kpb)¿™D\Ÿ[\ \›:@êªSîc)¿ñ\n*™~\›:@â@£ti)¿D£;àù\›:@Ù¬ùk)¿TUh ñ\›:@ëöv1\Õl)¿3¶`\›:@q\»\“\≈n)¿Ò~\‹~˘\‹:@1	Úp)¿\—z¯2Q\‹:@}zlÀÄs)¿ò\√\Ó;Ü\€:@\‚>rk\“u)¿∏ë≤E\“\⁄:@\ÊX\ﬁUx)¿¯¶\È≥\⁄:@OZ∏¨z)¿yë	¯5\⁄:@™Ù\Œn})¿\·∑!\∆k\⁄:@ÒÛﬂÉ\◊~)¿ıü5?˛\⁄:@m\≈˛≤{Ç)¿ˇXàÅ\€:@øeNó≈Ñ)¿)<hv\›\€:@´\ŒjÅ=Ü)¿Xc\'º\‹:@,amåùà)¿\ \Zıç\ﬁ:@∂ÜR{ç)¿ìE\÷\ﬁ:@\\1–µè)¿ _Bá\ﬂ:@±6\∆Nxë)¿}\Ï.PR\‡:@ÛZ	\›%ë)¿Ùz\ƒ\Ë\·:@/\›$ë)¿ãä8ùd\„:@7P\‡ù|í)¿Xç%¨ç\Â:@t\Í\ gyñ)¿\÷UÅZ\Ê:@\n±àaó)¿;S\Ëº\Ê:@Øñ;3ô)¿<O<g\Ë:@L\‡\÷›ú)¿ùπáÑ\Ô\È:@æ3⁄™$¢)¿\ﬁ>´Ãî\Í:@<\ŸÕå~§)¿sJ@L\¬\È:@+ˆó›ìß)¿?èQûy\È:@\∆\·ÃØ\Ê®)¿2\œg@\È:@m\≈˛≤{™)¿˛`\‡π˜\Ë:@¿	Ö8¨)¿òhêÇß\Ë:@75\–|Œ≠)¿äwÄ\'-\Ë:@u \Î©’Ø)¿w˜\0›ó\Á:@ûx\Œ≤)¿ˇ\Î‹¥\Á:@~\‡*O ¥)¿∏\Z£\Ê:@÷ßì≈µ)¿˘Ç0\Ê:@\€\„5∑)¿\ZQ\⁄|\Â:@\ËO\’\È∏)¿øÒµgñ\‰:@ùŸÆ\–ª)¿˝ky\Âz\„:@ÑÅ\Á\ﬁ√Ω)¿=\Ó[≠\„:@§ß\»!\‚æ)¿=Å∞S¨\‚:@+§¸§⁄ø)¿ù:\Ë\‚:@	l\Œ¡3¡)¿\ÕsDæK\·:@Ø\—r†á\¬)¿\Ó<0\‡:@¿[ AÒ\√)¿Õ∞Q\÷o\ﬁ:@u∞˛\œa\∆)¿\⁄\‰I\'\ﬁ:@∞t><K\»)¿Mi˝-\Ë:@π\‚\‚®\‹\‘)¿h$B#\ÿ\Ë:@†â∞\·\È\’)¿´îû\È%\Í:@á5ïEa\◊)¿Ú∞Pkö\Î:@.\‰\‹H\Ÿ)¿\0U‹∏\≈\Ï:@b.©\⁄)¿?\…6ë\Ì:@;≈™Aò\€)¿èP3§ä\Ó:@´\ÃC¶\‹)¿A\’\Ë\’:@ãRB∞™\ﬁ)¿Q3§ä\‚Ò:@É0∑{π\ﬂ)¿\‡\‘)èÚ:@òßsE)\·)¿åfe˚ê;@(Ç8\'\0*¿_òLå\Z;@òıI\Ó\0*¿?ë\'I\◊;@Ë°∂\r*¿èãjQ;@Z∫Çm\ƒ*¿ìQew;@d\Ë\ÿA*¿\Áß\ËH;@ø—é~*¿˚ïŒág;@±S¨\ZÑ	*¿ùπáÑ\Ô;@\Ô\ZÙ•∑*¿kGqé:;@⁄ç>\Ê*¿Ûë\ÔR;@yué\Ÿ*¿î˘Gﬂ§;@Å>ë\'I*¿˝gÕèø;@\ÌÄ\Îä*¿*\0\∆3h;@b.©\⁄n\Z*¿û±/\Ÿx;@\r\–\“*¿	\≈V–¥;@a5ñ∞*¿{ºê;@äØv\Á *¿Ú\Îá\ÿ`;@ôIÙ2\"*¿\Èb\”J;@0Å[w#*¿Ω\Z†4\‘;@±3Ö\Œk$*¿÷´\»\ËÄ;@s°ÚØ\Â%*¿\ŸA%Æc;@\»\Ôm˙≥\'*¿5z5@i;@ë∫ù}\Â)*¿Fîˆ_;@k\‘C4∫+*¿â\ÎW\\;@ß<∫-*¿b/∞;@>∞\„ø@0*¿)<hv\›;@øõn\Ÿ1*¿n§lë¥;@3díë3*¿çBíYΩ;@	]\ﬁ4*¿˚\À\Ó\…;@EJ≥y6*¿\€$∂ª;@j2\„m•7*¿ÈÅè¡ä;@NöEÛ8*¿)[$\ÌF;@Å]Mû≤:*¿ §Ü6\0;@/Òùò=*¿\È\’\0•°;@í∑µÖ?*¿JCçB;@vn⁄å\”@*¿øùDÑ;@\Ë¢!\„QB*¿\∆O\„\ﬁ;@0∫º9\\C*¿)v4ı;@BñD*¿V-\È(;@|µ£8GE*¿*8º ;@&7ä¨E*¿ÆaÜ\∆\r;@±4£\ZF*¿K#fˆy;@±®à\”IF*¿MÅ\ÃŒ¢;@CV∑zF*¿u\Ê\n;@>\ÈDÇ©F*¿ó=‘∂	;@\\W\ÃG*¿z7	;@∫⁄ä˝eG*¿o.˛∂\';@\‡\’rg&H*¿D\ﬁrıc;@ò\‹(≤\÷H*¿>u¨Rz;@]\√ç\'J*¿*\‰J=;@<\ÿb∑\œJ*¿\À\ÿ\–\Õ˛;@\◊OˇYÛK*¿\ﬂ3°;@Z\ÿ\”M*¿ﬂáÉÑ(;@\\\0qWO*¿l\Ã\ÎàC;@UΩ¸NìQ*¿\"\∆k^\’;@àÄC®RS*¿≥\Ô´r;@≥^\ÂT*¿E\⁄∆ü®\0;@2Àû6W*¿âx\Î¸ˇ:@\ﬂ¬∫Ò\ÓX*¿\Ó<\0;@üt\"¡T[*¿\Êx¢\'˝:@2\„m•\◊^*¿LQ.ç_¸:@â\\p_*¿í\Œ¿\»\À˙:@Xæ€ºa*¿æ¢[Ø˘:@\ÈG\√)sc*¿òäçy˘:@X˛|[∞d*¿_µ2\·óˆ:@\ÀiO\…9i*¿ƒîH¢óı:@<º\Á¿rl*¿+mqç\œÙ:@\nö]˜n*¿8Ñ*5{Ù:@µ\¬ÙΩÜp*¿™ö \Í>Ù:@\≈\0â&Pt*¿ñ\ÕíZÙ:@j\¬ˆì1v*¿\ÊmrÙ:@¨\0\ﬂm\ﬁx*¿bÜ\∆AÙ:@ó9]{*¿\Ëi¿ \ÈÛ:@\‰¿´\Â\Œ|*¿û\Ôß\∆KÛ:@…´s\»~*¿<Ü\«~Û:@ê-\À\◊eÄ*¿¸é·±üı:@à+gÔåÜ*¿\ÿ\r\€eˆ:@?8ü:Vâ*¿˙\n“åE˜:@B\nûBÆå*¿T\Â{F\"¯:@∞\0¶ê*¿µ˙\Í™@˘:@j¡ãæÇî*¿ÄJï(˚:@ò0öï\Ìõ*¿KîΩ•ú˚:@ˆÛ\Âù*¿zq\»˙:@ö\Ì\n}∞§*¿Y∑\—\0˙:@voEbÇ™*¿xµ‹ô	˙:@IæHâ≠*¿c{-\ËΩ˘:@ºvi\√a±*¿ZÉ˜Uπ¯:@iUMµ*¿∂f+/˘˜:@U¿=œü∂*¿y7Rˆ:@K≠˜\Ì∏*¿.</\Ô:@\ÌDIH§Ω*¿\ ˝EÅ\Ó:@3¡pÆaæ*¿\Âõ\»\Ã\Ì:@É\ﬁC\0¿*¿P0ûA\Î:@•˘cZõ\÷*¿îÇUı\Í:@\ŸÉk\Ó\ÿ*¿^=1\‰:@\€LÖx$\ﬁ*¿†3iSu\„:@\ﬁ\Á¯hq\ﬁ*¿\"ä\…`\‚:@\Ó#∑&\›\ﬁ*¿\Ã\œ\rM\Ÿ\·:@≤ÇﬂÜ\ﬂ*¿+1\œJZ\·:@mqç\œd\ﬂ*¿\‡ÚX32\‡:@ié¨¸2\‡*¿',1607362055,1607362055,NULL,NULL),(9,'Southern',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\09\0\0©K\∆1íi<@\œf\’\Ájß0¿≠\‹\Ã\nA<@\∆‹µÑ|∏0¿¿±g#<@ª{Ä\Ó\À\—0¿û?mTß<@RÛUÚ±\”0¿8†•+\ÿ;@>\Án\◊KÛ0¿=\Ô∆Ç\¬\‘;@`Ãñ¨äÙ0¿ó\ƒY5\Õ;@˚ ÀÇâˇ0¿Çp\Í°;@2\ËL>1¿\rç\'Ç8ü;@Ö\Œk\ÏU1¿`>Y1\\ç;@ñ\n*™~i1¿3SZKX;@s∏V{ÿì1¿ï+º\ÀE$;@\ƒ\·\—\∆\Õ1¿ç∂*â\Ï\';@OÆ)ê\Ÿ\’1¿\–\“l#;@\Ó\Ã√π\Ê1¿\—u\·\Á;@-&˛(ˆ1¿\0\‰Ñ	£;@\‡\’rg&Ù1¿ç\Ó v¶\0;@ºvi\√aı1¿^¢zk`ˇ:@\ÌÙÉ∫Hı1¿\·ö;˙_˛:@UN{J\Œı1¿cAaP¶˝:@òi˚WVˆ1¿$\Ô\ ¸:@æ1\0\«ˆ1¿ÇUıÚ˚:@^Ù§˜1¿ΩU◊°ö˙:@πmﬂ£˛ˆ1¿˙C3OÆ˘:@Æ(%´ˆ1¿ÆaÜ\∆˘:@\‘\’ãmˆ1¿˚\Î\‹˜:@L©K\∆1ˆ1¿´Ãî\÷\ﬂˆ:@+1\œJˆ1¿Ü9Aõˆ:@\ÔuR_ñˆ1¿JóU\ÿÙ:@/˚uß;˜1¿\⁄q\√\Ô¶Û:@:@0Gè˜1¿S\‰GÚ:@\ Iª\—˜1¿<§ \—:@º}\È\Ì˜1¿{k`´\Ô:@^Ωäå¯1¿*p≤\r\‹\Ì:@\Ì)H¯1¿˝-¯ß\Ï:@M¯•~\ﬁ¯1¿S\À\÷˙\"\È:@E+˜≥˙1¿Zh\Á4\Ë:@˝Ω4˚1¿t)Æ*˚\Ê:@$(~åπ˚1¿˝¡¿s\Ô\Â:@¨˝ù\Ì\—˚1¿6X8IÛ\„:@_9\Ôˇ˚1¿èo\Ô\‚:@Ìöê\÷¸1¿}=_≥\\\‚:@h>\Án\◊˚1¿Ç¨ßV_\·:@\Ì\’\«C˚1¿\Á\«_Z\‘\ﬂ:@r3‹Ä˚1¿\‘\”G\‡\ﬂ:@p\n+T¸1¿ë–ñs)\ﬁ:@•2\≈˝1¿\Ì\Ôlè\ﬁ\‹:@U†Éá˝1¿\Œ¸j\‹:@•ˆ\"⁄é˝1¿ü<,‘ö\⁄:@áÜ≈®k˝1¿®\√\n∑|\ÿ:@í∞o\'˝1¿—îù~P\◊:@ótîÉ\Ÿ¸1¿´îû\È%\÷:@)\"\√*\ﬁ¸1¿ÑGG¨\’:@Wj1x¸1¿3\ﬂ¡O\‘:@8§QÅì˝1¿\ÕX\‰\”:@E-Õ≠˛1¿Òün†¿\”:@âóßsE2¿\⁄\«\n~\”:@p(|∂2¿)ÁãΩ\”:@≥A&92¿æ0ô*\—:@ï({K92¿	åı\rL\Œ:@5bfü\«2¿\È\—TO\Ê\À:@*ˇZ^π2¿kFπ\«:@ûx\Œ2¿dT8\∆:@5}v¿u2¿)\Ï¢\ËÅ\√:@úQÛUÚ2¿]åÅuø:@\Â\'\’>2¿ΩfæÉª:@˛ö¨Q	2¿£\…\≈X∑:@\«*•gz\r2¿∂/†\Ó¥:@ëEöx2¿og_yê≤:@p`r£\»2¿<ΩRñ!≤:@˘¢=^H2¿\ﬁ…ß«∂∞:@\Ÿ$?\‚W2¿P\„\ﬁ¸Ü≠:@\ÔVñ\Ë,2¿\»\Ï,zß™:@’ñ:\»\Î2¿F¥Sw©:@\»%é<2¿EÒ*kõ¶:@§ã¶2¿ô÷¶±Ωû:@◊°öí¨2¿\‰1ïÒõ:@óp\Ë-2¿kæ*ö:@˘Ûm¡R\r2¿HOëCƒô:@Ûê)Ç\n2¿9ö#+øò:@\Â\'\’>2¿\Œ\„0òøñ:@¯q4GV2¿ôt&ï:@`ù∫Ú2¿d;\ﬂOçì:@X8IÛ\«2¿ÑEEúNí:@ßí†äˇ1¿x^*6\Êë:@:Z’í˛1¿R∫Ù/Ië:@D•3˚¸1¿˝gÕèøê:@\0tò//¸1¿\Ì-\Â|±è:@ízO\Â¥˚1¿ØD†˙ç:@?êºs(˚1¿*éØñã:@\0é={.˚1¿˘º\‚©Gä:@R%ìS˚1¿1\÷q¸à:@∏¨\¬fÄ˚1¿§30Ú≤Ü:@Ωã˜\„ˆ˚1¿‘Ç}Ö:@¸ ¸1¿\ﬁ…ßÉ:@√º«ô&¸1¿\◊˜\· !Ç:@\"QhY˜˚1¿®7£Ê´Ä:@ôeOõ˚1¿êªSî:@-∞\«DJ˚1¿¨¨mä\«}:@5D˛˚1¿S\Ííqå|:@©•π\¬˙1¿]m\≈˛≤{:@\ÂAzä˙1¿bÖ[>íz:@b\Ÿ\Ã!˘1¿¯Ñt:@\0ç“•ı1¿Wxóã¯r:@\ZPoF\ÕÛ1¿\„˙w}\Êp:@è\ﬂ\€ÙgÛ1¿∑\ÔQΩn:@≠€†ˆ[Û1¿ó8Ú@dm:@\Ô\≈\ÌÒÚ1¿\È*\›]gk:@it±3Ò1¿Ù£·îπi:@\0\„41¿¿ì.´h:@óTm7¡\Ô1¿9ó‚™≤g:@EÄ”ªx\Ô1¿Æªy™Cf:@új-\ÃB\Ô1¿\ﬁrıcìd:@o∑$\Ï\Ó1¿¨Zdc:@Ø`Òd\Ô1¿ÅïCã`:@Æπ£ˇ\Â\Ó1¿\‚¶”∫]:@<1\Î\≈P\Ó1¿°1ì®\\:@˛\Ôà\n\’\Ì1¿ä!9ô∏Y:@\'øE\'K\Ì1¿-C\Î\‚V:@.\«+=\Ì1¿\—vL\›U:@õ\«a0\Ì1¿\Ã|?qT:@Öb\Ÿ\Ã\Ì1¿ªa€¢\ÃR:@°\ŸuoE\Ó1¿lw\–}Q:@IMªòf\Ó1¿=+i\≈7P:@˚Øs\”\Ó1¿≠Ñ\Óí8O:@÷™]\“\Ó1¿<1\Î\≈PN:@`YiR\n\Ó1¿ü\«(œºL:@;7m\∆i\Ï1¿ó\ \€NK:@\»$#ga\Î1¿Z\÷˝cI:@jı\’UÅ\Í1¿∂\ÿ\ÌG:@|~!<\Í1¿˝\‹–îùF:@’îd\Í1¿\Ó\'c|òE:@)%´\Í\È1¿L\≈∆ºéD:@∞\‚\ \È1¿7n1?C:@a§µ˚\È1¿RDÜUºA:@<˜.9\Í1¿ÿö≠º\‰?:@/2øF\Í1¿πRœÇP>:@#K\ÊX\ﬁ\È1¿öñX=:@xπà\Ô\ƒ\Ë1¿rk\“mâ<:@j\'˜;\Ë1¿\0\Ê\À<:@Mıd˛\—\Á1¿	ß/˙::@ò›ìáÖ\Ê1¿nnLOX::@¿\–#F\œ\Â1¿¥êÄ\—\Â9:@˛ö¨Q\Â1¿[z4’ì9:@m\„OT6\‰1¿Y¸¶∞R9:@\⁄ñ?\„1¿ôG˛`8:@ü6\Á\‡\·1¿	\¬P®7:@VÒF\Ê\·1¿üÆ\ÓXl3:@8ÿõí\„1¿º?2:@\ƒ{,G\‰1¿	q\Â\Ïù1:@çB≤\‰1¿K;5ó0:@e\∆\€JØ\Â1¿É\‡Ò\Ì]/:@\Â{F\"4\Ê1¿O\‹Û¸-:@»∑w\r˙\Ê1¿Ò~\‹~˘,:@\'JB\"m\Á1¿J_9\Ô+:@¸ﬁ¨¡\Á1¿óMıd*:@˛b∂dU\Ë1¿∆àD°e):@,∏¿\Ë1¿7\≈\„¢Z(:@ıG,\È1¿°Gåû\':@Zıπ⁄ä\È1¿¿\':@\rP\Zj\Í1¿I\Ô\0O&:@®¨¶\Îâ\Í1¿é\»w)u%:@\Ï˜\ƒ:U\Í1¿6ù:$:@É/L¶\n\Í1¿˝fb∫#:@-\Ïiáø\Í1¿¿\Î3g}\":@</Û\Í1¿k,amå!:@0ºí\‰π\Í1¿<l\"3 :@s0õ\0\√\Í1¿\∆˙&:@µ˚UÄ\Ô\Í1¿OIü:@W≤c#\Î1¿\‡Jvl:@éØñ;\Î1¿B≤Ä:@4I,)w\Î1¿B\Ívˆï:@9{\⁄\·\Î1¿%A∏\n:@ä;\ﬁ\‰∑\Ï1¿ÅòÑy:@ˇ\'L\Ì1¿∂Ov:@VÒF\Ó1¿º\Ë+H:@!yv˘\Ó1¿¨s\»^:@ZÙN\‹\Ô1¿ÙR±1Ø:@g\‘|ï|1¿ÑF∞q˝:@πˇ\»t\Ë1¿q>?å:@u9% &Ò1¿g˜ã:@_(`;Ò1¿¡)\Õ\Z:@\–Ò\—\‚åÒ1¿†‹∂\ÔQ:@úãø\Ì	Ú1¿h\È\n∂:@èmpñÚ1¿¶DΩå\Z:@:ì6UÛ1¿˛o\÷\‡:@Î≠Å≠Ù1¿yaßX:@QˆñræÙ1¿%$\“6˛:@ûóäçı1¿ÛèæI\”:@X\‚eSˆ1¿®˝\÷Nî:@¸8ö#+˜1¿çzàFw:@kFπ˜1¿≠§\ﬂP:@\\=\'Ωo¯1¿\—`\":@ªö<e5˘1¿ºX\"ß:@U¯3º˘1¿\·{Éˆ:@\Ë.â≥\"˙1¿\Êó«ö:@MÖx$^˙1¿àÇS:@\Õ\Ì)˙1¿±4-±:@ê◊ÉIÒ˘1¿µnÉ\⁄o:@b\◊ˆvK˙1¿Á®£\„j:@\rU1ï~˙1¿º\Îl\»?:@6\‹,˙1¿\√c?ã\r:@\÷\·\Ë*\›˘1¿p\Înû\Í:@	˝LΩn˘1¿&\Z§\‡):@@\‹’´¯1¿,g~5:@.8Éø_¯1¿d\Ë\ÿA%\n:@õ\Êß\Ë¯1¿b\Ÿ\Ã!	:@ZÅ!´[˘1¿.ë\Œ\‡:@\Ëü\‡bE˘1¿#k\r•ˆ:@\‹H\Ÿ\"˘1¿N\“¸1≠:@\⁄\·Ø\…\Z˘1¿\ÏO\‚s\':@è7˘-:˘1¿ﬂåöØí:@≈è1w-˘1¿x\“\¬e:@(N>˘1¿d\ÍÆ\ÏÇ:@æ\ﬁ˝Ò^˘1¿\⁄W§ß\0:@&\ƒ\\Rµ˘1¿™CnÜ\0:@¸ﬁ¶?˚˘1¿\≈q\‡\’rˇ9@º\\\ƒwb˙1¿`ë_?\ƒ˛9@»∑w\r˙˙1¿ûC™b˛9@ΩçÕéT˚1¿£ì•\÷˚˝9@\ZPoF\Õ˚1¿\„â \Œ\√˝9@\‰ı`R¸1¿«ÅWÀù˝9@Ñ,&˛¸1¿†\≈R$_˝9@öz\›\"0˛1¿≥\≈V\–¸9@.Y\·&ˇ1¿äZö[!¸9@°l\\ˇ1¿2\√FY˚9@Åx]ˇ1¿zUgµ¿ˆ9@Õèø¥®ˇ1¿∫†æeˆ9@2∞é\„á˛1¿\0\‰Ñ	£ı9@î1>\Ã^˛1¿$ÒÚtÆÙ9@\∆G\Â˛1¿I\◊Læ\ŸÚ9@Œ©d\0®˛1¿≥E\“nÙÒ9@n£º˛1¿l\ndvÒ9@\Õ\ ˆ!o˝1¿1\Ìõ˚´\Ô9@UΩ¸Nì˝1¿\‰áJ#f\Ó9@+/˘ü¸˝1¿\‚≠Ûoó\Ì9@râ#D˛1¿2w-!\Ï9@Qköwú˛1¿9d\Èb\Î9@}\"Oí˛1¿,-#ıû\Í9@Ø\ÈAA)˛1¿t\‘\—q5\Í9@ô\”e1±˝1¿¬Ω2o\’\È9@Yk(µ˝1¿µç?Q\Ÿ\Ë9@\◊˙\"°-˚1¿∏\‰∏S:\Ë9@ëBY¯˙˙1¿\0÷™]\Á9@\'˙|î˚1¿P8ªµL\Ê9@\'Ü\‰d\‚˙1¿Äõ≈ãÖ\Â9@Xˇ\Á0_˙1¿\–—™ñt\‰9@∏ìà/˙1¿\»	F≥\‚9@dyW=`˙1¿\'\"\‡\‚9@¸5Y£˙1¿ï~\¬Ÿ≠\·9@#º=˘1¿ıÅ\‰ùC\·9@¨o`r£¯1¿\≈oÚ[\‡9@\‚\‰~á¢¯1¿ïú{h\ﬂ9@@Ö#H•¯1¿±nº;2\ﬁ9@Ø\\oõ©¯1¿˝Ç›∞m\›9@\…=]›±¯1¿ÄJï\‹9@ü\«(œº¯1¿X\0S\‹9@`Ãñ¨ä¯1¿n/Ü\‹9@®\‚\∆-\Ê˜1¿\Œ¬ûv¯\€9@~ç$A∏ˆ1¿EÙk\Îß\€9@´\"\‹dTı1¿d\ÈC\‘\€9@\⁄∆ü®lÙ1¿p]1#\‹9@t\nÚ≥ëÛ1¿\„S\0åg\‹9@[`èâîÚ1¿\…6ëô\€9@ò6\ ˙Ò1¿˛◊πi3\⁄9@\„\‚®\‹DÒ1¿e©ı~£\Ÿ9@^ÿö≠º1¿\ÁT2\0T\Ÿ9@ï-ív£\Ô1¿ß…å∑ï\⁄9@ª~¡n\ÿ\Ó1¿âD°e\›\€9@n/\Ó1¿¿í´X¸\⁄9@¿?•Jî\Ì1¿ü\"áàõ\€9@Ü¨nı\Ï1¿˘\0\„\‹9@åÙz\Ï1¿è˙\Î\‹9@˛G¶Cß\Î1¿≥^\ÂD\€9@\ƒ\·\—\∆\È1¿t\“˚\∆\◊\⁄9@çüq\·\Ë1¿	äc\⁄9@\…g˜\Á1¿\·\Ï\÷2\⁄9@ˇXàÅ\Á1¿wº\…o\Ÿ9@1A\r\ﬂ\¬\Ê1¿π9ï\0\Ÿ9@h=|ô(\Ê1¿ôK™∂õ\ÿ9@P\0\≈»í\Â1¿\Ÿ[\ ˘b\◊9@wg\Ì∂\Â1¿\Á:ç¥T\÷9@ë{∫∫c\Â1¿iä\0ßw\’9@]\≈\‚7Ö\Â1¿±\·Èï≤\‘9@/Òùò\Â1¿\∆ﬁã/\⁄\”9@à\ÿ“£\Â1¿^có®\ﬁ\“9@\…°fH\Â1¿m;mç\“9@\Œ˙îc≤\‰1¿≤G®R\—9@\∆o\n+\‰1¿\Á%\Ë/\–9@£è˘Ä@\„1¿\«Aúá\œ9@\∆\€JØ\Õ\‚1¿ºy™Cn\Œ9@Adë&\ﬁ\·1¿p#eã§\Õ9@ú•d9\·1¿v¿u≈å\Ã9@\Èb\”J!\‡1¿;¶\Ó\ .\Ã9@aUΩ¸N\ﬂ1¿\ËL\⁄T\›\À9@îN$òj\ﬁ1¿≥	0,\À9@»ô&l?\›1¿ùæûØY\ 9@í[ìnK\‹1¿f0F$\n\…9@˜:©/K\€1¿l$	\¬\»9@R\”.¶ô\⁄1¿¶]P\ﬂ\∆9@-@\€j\÷\Ÿ1¿I-îLN\≈9@\“7i\Z\Ÿ1¿°Gåû\√9@\ƒËπÖÆ\ÿ1¿≤J\Èô^\¬9@ı,\Â}\ÿ1¿∞¨4)¡9@îº:«Ä\ÿ1¿Mıd˛—ø9@Å\ÍD2\ÿ1¿◊ø\Îª9@—ÆB\ O\÷1¿å.o◊∫9@ôE(∂Ç\÷1¿;\Zá˙π9@.9\Óî\÷1¿˛++MJπ9@π\„M~ã\÷1¿â\Œ2ãP∏9@º\…o\—\…\÷1¿\Ô≠HLP∑9@ë\ÔR\Í\÷1¿˛Ûﬂ≥9@\÷WWj\’1¿µ¶y≥9@\0AÄ\’1¿§8G≥9@\Ÿv\⁄\Z\‘1¿ˇXàÅ≥9@ˇ\Ê≈âØ\“1¿æHâ]≥9@\ÃHø}\—1¿|⁄•\r≥9@∂-\ l\–1¿\›xwd¨≤9@NG\07ã\œ1¿º\Ë+H3≤9@˚ñ9]\œ1¿S\–\Ì%ç±9@HR\“\√\–\Œ1¿µß!™∞9@\’˝LΩ\Œ1¿üé\«TÆ9@>z\√}\‰\Œ1¿Ë°∂\r£¨9@q\∆0\'h\œ1¿q:\…Vó´9@®\‚\∆-\Ê\œ1¿≠/\⁄r™9@;q9^Å\–1¿ı††≠®9@ºW≠L¯\—1¿¥W}ß9@ á†jÙ\“1¿h∞¶9@MÜ\„˘\‘1¿s	\ﬂ˚£9@è\Zb.\’1¿îi4π£9@\Zn¿\Áá\’1¿ª}Vô)°9@Ü\Á•bc\÷1¿(CUL•ü9@s0õ\0\√\÷1¿º?ﬁ´Vû9@Ö&â%\Â\÷1¿+\ﬂ3°ù9@‘ô{H¯\÷1¿õ\À\rÜ:ú9@\“\Ó#∑\÷1¿A\‘}\0Rõ9@\ﬂ7æˆ\Ã\÷1¿Æ\’ˆBô9@\ \‹|#∫\◊1¿\Â—ç∞®ò9@Ö\Ô˝\r\⁄\◊1¿ãßipó9@måù\ÿ1¿¶\Ì_Yiñ9@><Kê\ÿ1¿8¢{\÷5í9@©˜TN{\÷1¿°-\ÁR\\ë9@∏∞nº;\÷1¿\0\„4ê9@:ñw\’\÷1¿ïπ˘Ftè9@åü∆Ω˘\’1¿\›(≤\÷Pé9@	˚v\÷1¿&TpxAå9@^∫I\◊1¿B&9ã9@j¶{ù\‘\◊1¿\ \≈X«â9@Ü=\Ì\◊\ÿ1¿§9≤ÚÀà9@y:Wî\⁄1¿\–\rM\Ÿ\Èá9@bIπ˚\€1¿‘∑\Ã\ÈÜ9@\ŒﬂÑB\‹1¿ŒßéUÜ9@w/˜\…Q\‹1¿Ä\“P£êÑ9@^/M\‡\‹1¿è·±ü≈Ç9@®´;\€\‹1¿=\’!7√Å9@¨\∆\÷\∆\‹1¿J/ÖÅ9@hÕèø¥\‹1¿Ù3ı∫EÄ9@^*6\Êu\‹1¿\‡∫bFx9@3\ﬂ¡O\‹1¿\‡LLb}9@W@°û\⁄1¿´ó\ﬂi2{9@êj\ÿ\Ôâ\Ÿ1¿ìR\–\Ì%y9@|`\«Å\ÿ1¿Ä°DKv9@\ÏL°Û\Z\◊1¿µ¸¿Uûp9@	Ún\ÿ1¿ò¯£®3o9@?\∆\ÿ1¿k~¸•Em9@&\Œ5\Ã\ÿ1¿\Â∏S:Xk9@◊áıF≠\ÿ1¿ˆ≤\Ì¥5j9@G¢`\∆\ÿ1¿z˛¥Qùf9@˚x\Ëª[\Ÿ1¿ÖÃïAe9@rl=C\ÿ1¿Fô\r2\…d9@\Ï\⁄\ﬁnI\÷1¿\Ã\Ó\…\√Ba9@¢&˙|î\’1¿∫ˆÙ\¬Y9@˘HJz\÷1¿,∏¿X9@∫jû#Ú\’1¿oÇoö>O9@ßZ≥\–1¿\›\Í9\È}K9@â¥ç?Q\Õ1¿ïú{hG9@ÄHø}\Ã1¿pîº:\«D9@2W\’\À1¿ã©Ù\ŒB9@\”hr1\ 1¿¯Ñ@9@N	àI∏\»1¿¢ñ\ÊV?9@H˛`\‡π\«1¿\ÁR\\Uˆ=9@\ZM.\∆¿\∆1¿fk}ë\–69@∂IEc\Ì\√1¿2\Á˚í59@Ø$yÆ\Ô\√1¿\"QhY˜39@s\’<G\‰\√1¿¿Ÿ≤|19@%\ \ﬁR\Œ\√1¿*Ral!09@/R(_\√1¿\Áèim\Z/9@Nõq\Z¢\¬1¿F\œ-t%.9@ö\Î4\“R¡1¿\…°fH-9@]˛C˙\Ìø1¿lA\Ôç!,9@e˛\—7iæ1¿\œÿól<(9@TUh ñπ1¿34û\‚(9@;pŒà“∂1¿,Ú\Îá\ÿ(9@eRCÄµ1¿Å#Å\'9@\›^\“≠≥1¿\Á9\"ﬂ•$9@\÷ˆB≥1¿R\Ó>\«G#9@¶_\"\ﬁ:≥1¿C9—ÆB\"9@ù•Ω¡≥1¿¥W!9@&˝Ω¥1¿X™xô!9@MÛéSt∞1¿-\Œ\Ê!9@-AF@ÖØ1¿Tn¢ñ\Ê\Z9@\n˜ ºU≥1¿OÆ)ê\Ÿ9@øúŸÆ–≥1¿ˇ>\„¬Å9@ïÄòÑ±1¿/ãâ\Õ\«9@\\\∆M\r4Ø1¿º\Ë+H3\Z9@)B\Ívˆ≠1¿\Œ\ﬁmU\Z9@~\ÂAzä¨1¿<f†2˛9@•Ñ`U©1¿\¬Pán9@_D\€1uß1¿F\Ó\È\Íé9@e\ZM¶1¿¨r°ÚØ9@8enæ•1¿/\¬\Â\“9@~\ÂAzä§1¿\Z0H˙¥9@≥\–\Œi¶1¿¿ì.´9@\ﬂ\›\ ù•1¿O>=∂e9@\rπß´£1¿j¯÷ç9@zq\»¢1¿nnLOX9@í∞o\'°1¿ámã29@›ó3€ù1¿\À’èMÚ9@QÇ˛Bèú1¿wá$9@\–—™ñtú1¿#eã§\›9@|ds\’<ü1¿\Ã:ì\n9@‰ÉûÕ™ü1¿B\—<ÄE\n9@\ﬁwè˝ú1¿¶]P\ﬂ\n9@a\ƒ>õ1¿}‘õQ9@#˘J %ö1¿ak∂Úí9@π¸áÙ€ó1¿{ıÒ\–w9@|∂ˆñ1¿\ \ﬁR\Œ9@6Y£¢ï1¿k\'JB\n9@`\Á¶\Õ8ï1¿ø\Ôﬂº8	9@}\ÍX•Ùî1¿\ÎV\œI\Ô9@\œéYˆî1¿[\œéY9@ÒÉÛ©cï1¿6Ø\Í¨9@\Ã{úi¬ñ1¿¨s\»^9@z™CnÜó1¿æL!9@\rnkœó1¿pCå◊º˛8@4M\ÿ~2ñ1¿;\„˚\‚R˝8@ßz2ˇ\Ëì1¿ö\–$±§¸8@c\n\÷8õí1¿\\r\‹)¸8@∞èN]ë1¿EF$a˚8@f\›?¢è1¿˛\’\„æ\’˙8@nã2dé1¿>\Î\Z-˙8@Eª\n)?ç1¿\–\÷¡¡\ﬁ¯8@π®≈å1¿	O\Ëı\'˘8@è®åã1¿ùı)\«d˘8@\n◊£p=ä1¿.\ﬁs`˘8@ ¿\0¬á1¿L\‡\÷\›¯8@a˝ü\√|Ö1¿Tt$óˇ¯8@o\ÎÑ1¿úi\¬ˆì˘8@≥%´\"‹Ä1¿Oyt#,˙8@\’\È@\÷S1¿^Mû≤ö˙8@ù/ˆ^|}1¿∏\È\œ~§¸8@±˙#z1¿_\ÏΩ¯¢˝8@r \nfx1¿bÅØ\Ë\÷ˇ8@⁄®Nv1¿∞™^~ß9@√ù#Ωt1¿\"™gx9@&\≈\«\'ds1¿MáNœª9@\…Àª\Íq1¿\—\…R\Î˝9@õsÙp1¿˚\À\Ó\…9@ã•Hæp1¿(\“˝úÇ9@\rƒ≤ôCn1¿ÀÅj\€9@\·\riT\‡l1¿õ=\–\n	9@IH§m¸i1¿\…ëEö9@ˇ<\r$i1¿≤◊ª?\ﬁ9@rl=Ch1¿(E+˜9@ëGp#eg1¿ô*ï\‘9@)@Ãòf1¿«É-v˚9@¶ùö\À\rf1¿nÖ∞\ZK9@j‹õ\ﬂ0e1¿=_≥\\69@’Æ	iça1¿p\Ï\Ÿsô9@\ÃC¶|`1¿ÜV\'g(9@¨;€§^1¿e˚ê∑\\9@Û;Mfº]1¿5¥;§9@íYΩ\√\Ì\\1¿Ü:¨p9@Òπ\ÏøZ1¿g{ÙÜ9@◊¢h[Y1¿p?\‡Å9@kúMGX1¿˝,ú9@xõ7N\nW1¿≥∂)9@æÖu\„U1¿lîıõâ9@M¯•~\ﬁT1¿≤g\œej9@ñ]0∏\ÊR1¿¢\”Ûn,9@∏\ÃÈ≤òP1¿|Vúj	9@IC´ìO1¿Ç\‚«òª\n9@:=\Ô\∆N1¿L™∂õ\‡9@ÉÜ˛	.N1¿\Á´\‰cw\r9@¯ˇq¬ÑM1¿QàÄC®9@\Õôd\‰L1¿∂,_ó\·9@Øò\ﬁL1¿°/Ω˝π9@3˘fõK1¿\‚≠Ûoó9@Rõ8π\ﬂI1¿\œMõq\Z9@Zfä≠H1¿t\Ô\·í\„9@\Ó\Ã√πF1¿Û<∏;k9@\ÃC¶|D1¿q:\…Vó9@„äã£rC1¿E∫üS9@7¸n∫A1¿¶}s9@\÷ãmRA1¿˘á-=ö9@ÆÄB=A1¿ï\“3Ω\ƒ9@(∫.¸\‡@1¿ÅZ¶9@\\\Àd8û?1¿t\Ï†\◊9@\Â\Ô\ﬁQc>1¿n\‡\‘)9@Ÿ≥\Á25=1¿<0Ä°9@\Íx\Ã@e<1¿&äê∫ù9@ å∑ï^;1¿\nÄÒ\Z9@≠àö\ËÛ91¿\⁄r.\≈9@\ng∑ñ\…81¿xπà\Ô\ƒ9@ãmR\—X71¿†Nyt#9@àÇS∞61¿IùÄ&\¬\Z9@\÷˝c!:41¿Föxx\Z9@:í\ÀH31¿¨©,\nª9@\‹ı\“21¿-{ÿú9@ÛZ	\›%11¿*9\'ˆ\–9@\œı}8H01¿U¿=œü9@t\‘\—q5.1¿<\ÿb∑\œ9@wæü\Z/-1¿9\rQÖ?9@ÆÇ\Ë\⁄+1¿êim\Z\€9@¥q\ƒZ|*1¿nﬂ£˛z9@Hâ]\€\'1¿˙~\‚\0\Z9@≤GW\È&1¿Å#Åõ\Z9@_\Ì(\Œ%1¿J~ƒØX9@—≠\◊Ù†$1¿\ PS\È9@\›\“jH\‹#1¿–öi9@â¥ç?Q!1¿ÜéT\‚9@™…ê1¿aQßì 9@˝ÉHÜ1¿/Ü\»!9@°Müt1¿ìr˜9>\"9@û\—V%ë1¿\Ï\›\ÔU#9@g∑ñ\…p1¿á6\0%9@;V)=\”1¿H7¬¢\"&9@F–òI\‘1¿•iP4(9@ƒï≥wF1¿\·(yué)9@å∫\÷ﬁß\Z1¿wı**9@æÖu\„1¿ºñêz*9@PVW1¿˚Y,E*9@1A\r\ﬂ\¬1¿\Œm¬Ω2+9@îK\„^1¿\Z¡\∆ı+9@∏#úº1¿Dì7¿,9@íØRb1¿¿ì.´,9@\Ã&¿∞¸1¿z4’ì˘+9@®˝\÷Nî1¿\Ó˚Øs+9@aäri¸1¿C7˚\Â*9@¨8\’Zò\r1¿Uiãk|*9@/˜\…QÄ1¿\"R\”.¶)9@\≈7>[1¿\Î\√z£V(9@\Õ\ÂC\n1¿¸çv\‹\'9@\∆¨q6	1¿É0∫(9@\ƒxÕ´:1¿\◊\‹\—ˇr)9@ç“•I1¿s-ZÄ∂)9@∫2®681¿z\„§0\Ô)9@ÑF∞q˝1¿ç&c`)9@\œ˘.•1¿%\\\»#∏)9@/\›$Å1¿:ñw\’*9@&´\"\‹d\01¿P9&ã˚+9@Mªòf∫ˇ0¿\«ÙÑ%,9@â)ëD/ˇ0¿4ª\Ó≠H,9@Ω\·>rk˛0¿\ŸYL,9@√†L£\…˝0¿\Á%\Ë/,9@é@ºÆ_¸0¿\0tò//,9@hóo}X˚0¿m\∆ià*,9@@¯P˙0¿Z.ùÛ+9@√†L£\…˘0¿˚w}\Ê¨+9@\œ¯æ∏T˘0¿¢DKO+9@£êdV\Ô¯0¿+æ°\Ÿ*9@Û-$`¯0¿C\Z8\Ÿ*9@L¬Ö<Ç˜0¿Nò0öï19@ıI\Ó∞˝0¿1DN_\œ?9@ÜpÃ≤\'ı0¿§ãM+A9@\'jinÖ0¿\Œ\√	LßA9@\Ô≠HLP\Ô0¿?6…è¯A9@Ç\„2n\Ó0¿ãåH\¬B9@\‰Gà\Ï0¿\ZyYC9@\Ÿ>\‰-W\Î0¿π5\È∂D:9@ù,µ\ﬁo\»0¿x\–Ï∫∑:9@tïÓÆ≥\≈0¿˘∫ˇ\È:9@\ﬁÊçì\¬\ƒ0¿éèg;9@$0\‹\√0¿¸™\\®¸;9@bÇ\ZæÖ¡0¿]¿\À=9@i¸\¬+Iæ0¿\0Sh=9@∂dUÑõº0¿\ÀJìR\–=9@\Ô\≈\ÌÒ∫0¿Ø\Ã[u>9@QhY˜èπ0¿\’\Ê!S>9@Oê\ÿ\Ó∏0¿7\·^ô∑>9@f1±˘∏∂0¿˘ù&3\ﬁ>9@Ü\‚é7˘µ0¿âµ¯\0?9@\ﬁrıcì¥0¿fKVE∏=9@ù\’{L¥0¿ïÒ\Ô3.<9@)\Õ\Êq¥0¿;™ö \Í:9@#LQ.ç≥0¿Öb\Ÿ\Ã99@NDø∂≤0¿\·DÙk\Î79@\»–±ÉJ∞0¿†˚rf79@h\Á4¥Ø0¿ïÅZ∫69@\€2\‡,%Ø0¿=C8f\Ÿ39@\ÀÙKƒØ0¿\re˝f29@\Â|±˜\‚Ø0¿Ø\'∫.¸09@,)wü\„Ø0¿*©\–D09@ö\Í\…¸£Ø0¿\ƒxÕ´:/9@\Ï\ﬂıô≥Æ0¿√∂Eô\r.9@\ƒ\Î˙ª≠0¿2\È\Ô•,9@û¥pY≠0¿a•Çä™\'9@ôa£¨ﬂ¨0¿&\„\…%9@\œL0úk¨0¿ÙOp±¢\"9@\ﬁ:ˇvŸ´0¿èT\‚:9@\ ¡l´0¿¸ 9@õ!UØ™0¿ÉÜ˛	.9@ù/ˆ^|©0¿Üí…©ù9@‘∑\ÃÈ≤†0¿\ﬂ\Z\ÿ*¡9@§R\Ïhú0¿/iå\÷Q9@Æg\«,õ0¿<üıf9@}≥Õç\Èô0¿2kúM9@D¸√ñô0¿f2\œg9@Yøôò.ò0¿l\Ó\Ëπ9@&¸R?oñ0¿∆®k\Ì}9@3®68ï0¿¥î,\'°9@–∂öu∆ì0¿Ùå}\…\∆9@F\\\0\Z•ì0¿\rU1ï~\n9@`?\ƒì0¿∏\Í:TS\n9@Yæ.\√í0¿?»≤`\‚9@øò-ë0¿ı∏oµ9@fæÉüê0¿a\√\”+e9@äæ¢[è0¿é\Ã#09@ü´≠\ÿ_é0¿Ec\Ì\Ôl9@Zú1\Ã	é0¿\ﬁ\ﬂ4}9@∫ÉÿôBã0¿¸5Y£9@1xòˆÕâ0¿ç^\rP\Z9@ãˇ;¢Bâ0¿†Nyt#9@ïÅZ∫Ü0¿gÄ≤e9@\Í\œ~§àÑ0¿U\⁄\‚\Zü9@\·A≥\ÎﬁÇ0¿2\0«û9@40Ú≤&Ç0¿ªFÀÅ9@¥t€Ä0¿™}:39@dø\r1~0¿ésõpØ9@G≤Åt}0¿™b*˝9@⁄Æ\–\À|0¿É¬†L£	9@\Î¸\€eøz0¿@\ﬂ,\’	9@ÔÆ≥!ˇx0¿Øó¶p\n9@{ıÒ\–ww0¿ˆ\“N9@.»ñ\Â\Îv0¿\›\"0\÷79@\≈\≈Qπâv0¿\Ê\"æ≥9@Ç¨ßV_u0¿-z®m9@MåJ\Ít0¿≤h:;9@%\’?àt0¿Ü=\Ì\◊9@]\·].\‚s0¿\Ô v¶\–9@í>≠r0¿\≈\⁄\«\n9@\ÌfF?\Zr0¿\›\—ˇr-9@\Zi©ºq0¿\ÎUdt@9@?åmp0¿\Èõ4\rä9@æ˙x\Ëªo0¿≥{Ú∞P9@LKo0¿6\È∂D.9@ÜV\'g(n0¿Yk(µ9@Q\ﬁ\«\—m0¿K<†l\ 9@ÑÄ|	l0¿í\Êèim9@GW\È\Ój0¿\Œ8\rQÖ9@Ç¨ßV_i0¿\√)sÛç9@\«.QΩ5h0¿2éë\Ï\Z9@ª}Vô)e0¿S\ k%t9@}w+Kd0¿ææ÷•F9@¯˛\Ì\’c0¿_∂ù∂F 9@`V(\“˝`0¿-B±4!9@w\ÿDf.`0¿©˙ïŒá#9@°jÙjÄ^0¿74eß$9@≤b∏:\0^0¿\ ä;\ﬁ$9@≤dé\Â]]0¿ææ÷•&9@\Ó<0\\0¿øûØY.\'9@}˛Û[0¿\"Hõ*9@AúáòZ0¿Ü∆§ø/9@náÜ≈®W0¿ô*ï\‘19@É1\"QhU0¿L\∆1í=29@Ù1\ËT0¿ïG7¬¢29@\Î8~T0¿EùπáÑ39@\Î9\È}\„S0¿$Di69@éègS0¿Q˙B\»y79@‹π0“ãR0¿Ö\Œk\Ï99@\ƒ%«ù\“Q0¿\»zjı\’99@e5]OtQ0¿GÛÅ:9@OõsP0¿§ƒÆ\Ì\Ì:9@\0Æd\«FP0¿ﬁ∞mQf;9@◊Ñ¥∆†O0¿∂êˆ?<9@ c\ÓZBN0¿\·¥\‡E_=9@|}≠KçL0¿‘õQÛ=9@rm®\ÁK0¿⁄®N≤>9@\0é={.K0¿•t{I?9@í \\ÖJ0¿∫/g∂?9@Ñª≥v\€I0¿EÚï@J@9@K\0˛)I0¿Q§˚9A9@≤†0(\”H0¿»òªñêC9@Ÿò\◊áH0¿6ê.6≠D9@‰ªî∫dH0¿kÒ)\0F9@!∫ˆH0¿	˘†g≥F9@8i\Z\ÕG0¿≤^ÇSG9@â\n\’\Õ\≈G0¿0Ieä9H9@´x#Û\»G0¿\næi˙\ÏH9@\‘\—q5≤G0¿$%=≠J9@ö≤\”\ÍF0¿ßu\‘~K9@Éà‘¥ãE0¿6uˇK9@l?\„\√D0¿Äe•I)L9@ñ\œÚ<∏C0¿≤KTo\rL9@#˜tu\«B0¿lï`q8K9@åÚ\Ã\Àa?0¿\⁄\Á1\ 3K9@\ \√B≠i>0¿G:#/K9@\À/É1\"=0¿µå\‘{*K9@◊¶±Ω<0¿6 B\\9K9@5\Ìbö\È:0¿Ç’∞\ﬂK9@òøB\Ê\ 80¿ı\⁄l¨\ƒL9@\Ô9∞!70¿ı/IeäM9@ÒΩøA{50¿(\”hr1N9@cAJ40¿q\0˝æO9@M˘Tç20¿ú\Ê=\ŒP9@xœÅ\Â10¿∂ˆ>UÖR9@á\√\“¿è.0¿Ñ∫ÑCS9@\÷o&¶-0¿Ü %\ÃT9@IÙ2ä\Â*0¿ïa\‹\r¢U9@	5C™(*0¿%í\ËeW9@àπ§jª)0¿ÛtÆ(%X9@\‡ıô≥>)0¿ôÚ!®\ZY9@ADj\⁄\≈(0¿1\ÍZ{üZ9@Ä(ò1\'0¿àFw;[9@R_ñvj&0¿\‘U¯3\\9@ú•d9%0¿\≈˛≤{Ú\\9@Ωˇè&$0¿\—<ÄE~]9@∂h\⁄V#0¿Õ∞Q\÷o^9@:Z’í\"0¿Kr¿Æ&_9@Ú\È±-\"0¿Ii6è\√`9@ |(!0¿\Î\„°\Ôna9@m˛_u\‰ 0¿˙µı\”b9@\À⁄¶x\\ 0¿ˆ)\«dqc9@Æº\‰Ú0¿íxy:Wd9@ñ[Z\râ0¿\’íwe9@:Ø±KT0¿¯˝õ\'f9@QL\ﬁ\00¿¿¥®Org9@R\r˚=±0¿ŸµΩ›íh9@MhíXR0¿ïù~Pi9@™IÜ40¿\ﬁu6\‰üi9@f°\ÿ\n0¿ä\ÂñVCj9@öôôôô0¿d\Êó\«j9@±1Ø#0¿3˛}∆Ök9@nj†˘ú0¿T\Z1≥\œk9@ˆ—©+0¿˛C˙\Ì\Îl9@\Œ¡3°I\Z0¿µãi¶{m9@\Ï‹¥ß0¿\–^}<Ùm9@ñ0¿7P\‡ù|n9@oÚ[t≤0¿/¡©$o9@^*6\Êu0¿æ£∆Ñòo9@V}Æ∂b0¿$Din9@ºX\"ß0¿˛\Ó5&l9@\”3Ω\ƒX0¿É}ij9@˜V$&®0¿r\≈\≈Qπi9@\≈ ∞rh0¿⁄Æ\–\Àh9@ä)x\n0¿>ï”ûíg9@®¶$\Îp0¿πã0Ee9@Òün†¿0¿\ƒ!Hc9@\√c\“\ﬂ0¿f¢©\€a9@¯¸0B0¿m:∏Y`9@Óò∫+ª0¿T9\Ì)9_9@æü\Z/\›0¿!W\ÍY^9@™\‘\ÏÅV0¿\Ê\Â∞˚é]9@÷®áht0¿>\ÈDÇ]9@gDio0¿ûóäç]9@µ¿)0¿\»_Z\‘\']9@\…ëEö0¿ôÄ_#I\\9@˜@0¿Ù\ZªDıZ9@]õè0¿°Ç\√\"Z9@OIü0¿4Ü9AõX9@´\Ì&¯¶\r0¿\›^\“≠W9@\€1uWv\r0¿≥E\“nÙU9@\ne\·\Îk\r0¿\„Q*\·	U9@Ø\Ì\Ìñ\‰0¿\ÿ\‘yT¸S9@U§\¬\ÿB0¿*7QKsS9@YjΩ\ﬂh0¿H\‹c\ÈCS9@v5y\ \n0¿qvkôS9@—ì2©	0¿*sÛç\ËR9@\Èb\”J!0¿%\ÎptïR9@aåHZ0¿Abª{ÄR9@36t≥?0¿ë–ñs)R9@}\"Oí0¿ÀºU◊°R9@\≈=ñ>t0¿Ògx≥S9@Ø\n\‘b\00¿4É¯¿éS9@^†§¿\00¿3díëS9@¸»≠I∑˝/¿\€\ﬁnIT9@∏\Êé˛ó˚/¿∑|$%=T9@\"ã4Ò¯/¿\ﬂ\·vhXT9@\ƒ\Ã>èQˆ/¿\–	°É.U9@K;5óÙ/¿ÙãÙV9@p[[x^Ú/¿≤ÇﬂÜW9@Ral!\»Ò/¿X©†¢\ÍW9@|,G\»/¿Û=#\ZY9@-&6\◊\Ó/¿<¢BusY9@\¬\÷l\Â\Ì/¿ïõ®•πY9@\Á\‚o{Ç\Ï/¿õ.»ñY9@E\Ÿ[\ ˘\Í/¿ˇ±W9@\ﬁ>´Ãî\Ê/¿Hj°drV9@3QÑ\‘\Ì\‰/¿Äd:tzV9@_(`;\·/¿dZõ\∆ˆV9@ïI\rm\0\ﬁ/¿¡V	áW9@e6\»$\€/¿bIπ˚_9@\·\“1\Á\√/¿º!ç\n`9@\„k\œ,	¿/¿˘gÒa9@x–∑/¿Ö(_\–Bb9@Æ\r\„¸µ/¿∂ºrΩmb9@L\‡\÷›¥/¿q\ÊWsÄ`9@	Qæ†Ö¨/¿Ü¨nı`9@E)!XUß/¿UÜq7`9@YâyV“¢/¿¥¨˚\«Bd9@ë(¥¨ì/¿\ﬂ\›\ ùe9@;\√‘ñ:ê/¿›ó3\€e9@e6\»$#è/¿¶ÒØ$e9@Ö\Œk\Ïç/¿¥ î˜qd9@Ûê)Çä/¿3é\Á3d9@4ªÓ≠à/¿ÑΩâ!9e9@U˙	g∑~/¿µQùde9@Ö%P6}/¿Dà+g\Ôd9@2w-!|/¿úoD˜¨c9@_F±\‹\“z/¿\ŒTàG\‚a9@\Á¶\Õ8\ry/¿ãS≠ÖY`9@iSuèlv/¿Ö^ü_9@ˆ&Ü\‰t/¿≥\Îﬁä\ƒ\\9@V\”ıD\◊m/¿\Èπ-\\9@&¨ç±n/¿¶GS=ô[9@\‡+∫ıön/¿\·a\⁄7˜W9@t|¥8cx/¿@Ñ∏rˆV9@ÄJï({{/¿πß´;V9@\◊KS8}/¿Å>T9@\‹,^,Å/¿ÄûíR9@Aö±h:É/¿¶ùö\À\rR9@\ﬂ,\’Ñ/¿§ng_yP9@\ﬂ\›\ ùÖ/¿?74eßO9@\”3Ω\ƒXÜ/¿2v\¬KpN9@k*ã¬Ü/¿+O \ÏK9@^ÇSHÜ/¿\“\„˜6˝I9@\¬˜˛\ÌÖ/¿®5\Õ;NI9@5	ﬁêFÖ/¿è\ÈåH9@y\\TãàÇ/¿{\€LÖxH9@:∏YºÄ/¿\ÃB;ßYH9@\Â\'\’>/¿lxz•,C9@âîMπr/¿?˙\ÓVB9@h∞©Ûp/¿é*çòA9@\\W\Ão/¿\Ã\–x\"à?9@ïÅZ∫j/¿&«ù\“¡>9@âE;åi/¿≈ír˜9>9@∏@Ç\‚\«h/¿g\Ì∂\Õ=9@\\Æ~líg/¿ã¶≥ì¡=9@PráMdf/¿kæ*>9@ˇ]ü9\Îc/¿≈è1wA9@8Öï\n*Z/¿ú1\Ã	\⁄D9@28J^ù[/¿a5ñ∞F9@ß\ËH.ˇY/¿\\ëò†ÜG9@”á.®oY/¿ôÄ_#IH9@ïbG\„PW/¿X´vMH9@v§˙\Œ/R/¿Ù3ı∫EH9@≥?Pn\€O/¿áüˇH9@sæ\ÿ{ÒM/¿d≠°\‘^<9@-µ\ﬁo¥;/¿Ω\»¸\Z99@\‚vhXå:/¿÷år99@oH£7/¿q©J[\\79@|E∑^\”3/¿zè3M\ÿ69@\—Wêf,2/¿Ä*n\‹69@\Á\ﬂ.˚u//¿\Z¸˝b∂<9@\œejº!/¿\‹\ÿ\ÏHı=9@è¶z2ˇ /¿x≥\Ô´>9@ãS≠ÖY /¿∂¢\Õqn?9@$∂ª\Ë/¿\—u\·\Á?9@\⁄ ìåú/¿\’x\È&1@9@‹Ä\œ#/¿˝\›;jL@9@~\«\ÿ\œ\Z/¿\„p\ÊWs@9@óræ\ÿ{/¿P´\Ë\Õ@9@Jòi˚/¿¶”∫\rjC9@Ò[z/¿Z_&F9@\—Aóp\Ë\r/¿©à\”I∂F9@á\‹7\‡/¿ìÜV\'G9@+Nµf	/¿\‘-¨G9@díë≥∞/¿»≤`\‚èF9@\»@û]æ/¿Tt$óˇD9@ød\„¡/¿\«bõT4B9@\’yT¸\ﬂ/¿‡Ω£∆Ñ@9@Úw\Ô®1/¿¯\· !\ ?9@*Wxóã\0/¿eSÆ>9@Pqxµ¸.¿Y\·&£>9@\0X9\“˘.¿\ 2ƒ±.>9@Å	‹∫õ˜.¿sÙ¯Ω=9@C™(^eı.¿\Z4ÙOp=9@3díëÛ.¿EúN≤\’=9@¯XéêÒ.¿˘ù&3\ﬁ>9@˝\⁄˙\È\Ô.¿1DN_\œ?9@\ﬁ\Á¯hq\Ó.¿zé\»w)A9@\ﬁUòá\Ï.¿\ÏM\…A9@¿[ AÒ\Î.¿\‘b0\ÌC9@À†\⁄\‡D\Ï.¿»ô&l?E9@ •ÒØ\Ï.¿\√\◊◊∫\‘H9@Z+\⁄\Á\Ó.¿H\‚\Â\È\\I9@_~ß…å\Ô.¿£ì•\÷˚M9@Ç\ƒv˜\0\Â.¿èâîfÛP9@z\·ŒÖ\—.¿\›\ÌziäP9@~®4bf\œ.¿p^ú¯jO9@R<æΩ\À.¿N_\œ\◊,O9@»≤`\‚è\ .¿í\Œ¿\»\ÀN9@bX9¥\».¿\'•†\€KN9@Ωv\ﬂ1\ƒ.¿t)Æ*˚N9@\‡V*®¿.¿¨ æ+ÇS9@éwG\∆jª.¿\ÿÒ_T9@ì8+¢&∫.¿¸\∆◊ûYV9@†≤∫µ.¿˘ù&3\ﬁV9@?9\n≥.¿§ä\‚U\÷V9@ë)Ç™±.¿ív5yV9@)[$\ÌFØ.¿¥sö\⁄U9@xπà\Ôƒ¨.¿û@\ÿ)VU9@Eû$]3©.¿\ÏK6lQ9@˜îú{ò.¿®R≥ZQ9@ä\"§ngè.¿l\\ˇÆ9@P\Ëë.¿ò\ﬁ˛\\4Ä9@è\‡F\ ë.¿\‹)¨ˇ\œ9@˙\ÃYüí.¿Ô©úˆî¸9@ÇéVµ§ì.¿ì\‚\„≤:@\—w∑≤Dó.¿+1\œJ\":@£h[Õö.¿\¬¯i\‹[:@ëD/£X¶.¿mYæ.\√:@\ƒABî/®.¿û^)Àò:@Äõ≈ãÖ©.¿\¬¯i‹õø:@¨0ô™.¿˚≠ù(	\…:@\Ï\’[´.¿6\‹,\“:@AÉMùG≠.¿oeâ\Œ2Û:@\ÕX\‰◊∑.¿_òL\0;@*™~•≥.¿º@IÅ\0;@ôùE\ÔT∏.¿ø÷•F\Ëˇ:@Å?¸¸˜¿.¿%\Á\ƒ\⁄ˇ:@Ç8\'0\≈.¿$a\ﬂN˙:@%\Íü\Ê\Ï.¿/PR`\0;@çñ=\‘\Ó.¿éW zR2;@\ÎÛê)\Ô.¿õ.»ñE;@Mû≤öÆo/¿∫áÑ\Ô˝E;@\›\'G¢p/¿\Ï1ë\“lF;@\Ï‹¥ßq/¿\∆2˝ÒF;@á¯á-=r/¿QL\ﬁ\0G;@\œ,	PSs/¿Ù7°G;@x¥q\ƒZt/¿+2: 	G;@\Ó\Ìñ\‰Äu/¿\Ÿ>\‰-WG;@*\‚tí≠v/¿\npUJ;@IZ\÷˝{/¿;n¯\›tK;@€£7\‹G~/¿o\ÎL;@W&¸R?/¿åÉK\«L;@\—x\"àÛÄ/¿G\Ã\ÏÛM;@˙}ˇ\Ê≈Å/¿8˘-:YN;@AG´ZÇ/¿¶∏™\ÏªN;@{ºêÅ/¿äçC˝N;@§m¸â\ ~/¿q<üıN;@\"˝ˆu\‡|/¿m\≈˛≤{N;@\Œ9x&4y/¿èmpñN;@\—Éw/¿ª∂∑[íO;@\ \ﬁ\Â\"v/¿\Z£uT5Q;@∫\Ÿ(∑u/¿œºv\ﬂQ;@æ£∆Ñòs/¿∂\€.4\◊Q;@(Fñ\Ãq/¿\œ.\ﬂ˙∞Z;@Ç;Pß<R/¿\…∆É-v[;@hÒÅO/¿AùÚ\ËF\\;@7ñ~L/¿¢≤a];@\€\¬ÛR±I/¿g_yêû^;@ß∞RAEE/¿êà)ëD_;@ùL\‹*àA/¿™-uê\◊_;@´\Ïª\"¯?/¿=HOëC`;@!Æú=/¿\Œp>?`;@ˆaΩQ+</¿c(\'\⁄U`;@!yv9/¿\ƒ†Q∫`;@º;2Võ7/¿≥Bë\Ó\Á`;@†\ﬂ˜o^4/¿29µ3La;@˙\ÏÄ\Îä1/¿\ﬂOçónb;@$ô\’;\‹./¿¿z‹∑Zc;@π9ï\0-/¿zod;@$óˇê~+/¿¯çØ=≥d;@U\¬z˝)/¿\‚\‰~á¢d;@¿x\r%/¿2•ûd;@\–~§à#/¿\Ã&¿∞d;@>{.Sì /¿Rµ\›\ﬂd;@\rç\'Ç8/¿Z¢Ø e;@\\!¨\∆/¿≤\ÿ&çe;@≥_w∫Û/¿étF^f;@ZÙN\‹/¿§6qrøg;@$\—\À(ñ/¿#¯\ﬂJvh;@\√Œßé/¿+\‹Úëh;@\∆¯0{\Ÿ/¿j˚WVöh;@f.py¨!/¿(Äbd\…h;@ìã1∞é#/¿\‡ÿ≥\Á2i;@ÉL2r&/¿ñ=	l\Œi;@\‘*˙C3\'/¿¢{\÷5Zj;@4`ë_\'/¿˚¨2SZk;@\‚\‡I\'/¿∫/g∂+l;@∞êπ2®&/¿gÄ≤em;@äs\‘\—q%/¿3¡pÆan;@,Ä)$/¿\"ã4Òn;@5_%ª#/¿x_ïïo;@§30Ú≤&/¿l\Í<*˛o;@æl;mç(/¿j§•Úvp;@]¶&¡*/¿jP4`q;@6 B\\9+/¿\œ0µ•r;@∞´\…SV+/¿N~ãNñr;@:=\Ô∆Ç*/¿~£<Ûr;@ùª]/M)/¿πà\Ôƒ¨s;@^emS<&/¿%Ã¥˝s;@®qo~\√$/¿r1\÷qt;@\"•\Ÿ<#/¿˜\«{\’\ t;@;Uæg$\"/¿\ÍAA)Zu;@\Ì)9\'ˆ /¿ÙQF\\\0v;@;ç¥T\ﬁ/¿\ÃA\–—™v;@ˆz˜\«{/¿\Óïy´Æw;@MÑ\rOØ/¿\\\Â	Ñy;@ù,µ\ﬁo/¿\Ê\ËÒ{õz;@˚Øs\”f/¿Å≥î,\'};@B≤Ä	\‹\Z/¿«Ω˘\r};@@˘ªw\‘/¿<jLàπ|;@ò€Ω\‹\'/¿\œ/J\–_|;@Ö_\Í\ÁM/¿ù*\ﬂ3};@ë`™ôµ/¿8K\…r~;@˝O˛\Ó/¿46<Ω~;@H≈´¨/¿u\«bõTÄ;@äV\Óf/¿ëC\ƒÕ©Ä;@\Ÿ\ÍrJ@/¿\'3\ﬁVzÅ;@\≈8\n/¿6\‹,Ç;@ákµáΩ/¿å\ \¬◊É;@ˇïï&•/¿?»≤`\‚É;@Ä\Ô6oú/¿áåG©ÑÉ;@z\ﬂ¯\⁄3/¿ á†jÙÇ;@§ˇ\ÂZ¥/¿^Mû≤öÇ;@™*4\À/¿ª\“2R\ÔÅ;@K\Èô^b/¿L˚\Ê˛\ÍÅ;@Å\—\Â\Õ\·/¿¢F!…¨Ç;@ªˇ\È/¿:≠€†ˆÉ;@\Ê<c_≤/¿∑]hÆ”Ñ;@\÷:q9^/¿T\ƒ\È$[Ö;@Ω«ô&lˇ.¿5F\Î®jÜ;@_a¡˝Äˇ.¿Û¨§á;@˚±I~\ƒˇ.¿X\0Sà;@;˝†.R\0/¿\›\na5ñà;@á\¬g\Î\‡\0/¿\Áé˛ókâ;@äØv\Á\0/¿\Z\€kA\Ôâ;@øb\rπˇ.¿p>u¨Rä;@T\›ã˙.¿m\«\‘]Ÿâ;@U4\÷˛\Œˆ.¿ë9∂ûâ;@\Ã@e¸˚Ù.¿»óP¡â;@` ê°Û.¿@˙&MÉä;@OjMÛ.¿´\œ\’V\Ïã;@≤,ò¯Û.¿G™\Ô¸¢å;@	ãä8ùÙ.¿\ \›\Á¯hç;@\"˝ˆu\‡Ù.¿&èß\Âé;@P√∑∞nÙ.¿e\ﬂ¡ˇé;@@/‹π0Ú.¿mo∑$ê;@Öyè3M.¿8\€‹òûê;@C ó8Ú.¿jºtìê;@\ÕtØì˙Ú.¿\ﬁQcBê;@H¸ä5\\Ù.¿\ƒv¸ê;@•Ñ`Uı.¿éø∑\Èè;@U/ø\”dˆ.¿™úˆîúè;@•Ljh¯.¿3˛}∆Öè;@WØ\"£˙.¿\Á™yé»è;@j˚WVö¸.¿k\“mâ\\ê;@Fò¢\\\Zˇ.¿1\÷q¸ê;@•\Ÿ<É/¿i\⁄V≥í;@3‹Ä\œ/¿¨q6î;@˜\0›ó3/¿äV\Ófï;@¯¡˘‘±/¿˘∫ˇ\Èñ;@I\ÿ\’\‰/¿\ƒ&2sÅó;@y\À’èM/¿î¯\‹	ˆó;@ÉlYæ./¿<º\Á¿rò;@dï\“3Ω/¿4-±2\Zô;@‘ûísb/¿”§t{ô;@’ï\œÚ</¿Ø¥å\‘{ö;@/àHMª/¿wfÇ\·\\õ;@Z∏¨\¬f/¿ÖñuˇXú;@Aúá/¿4¯˚\≈lù;@\‰g#\◊M	/¿a5ñ∞6û;@EÅ>ë\'	/¿m±üû;@Õ±º´/¿m˝Ùü5ü;@•\ﬂP¯/¿y‹ùµü;@oùª/¿c\—tv2†;@˙{)<h/¿üZ}uU†;@±j\Êv/¿ÖD\⁄∆ü†;@4\€˙`	/¿\‰£\≈√†;@º\…o\—\…\n/¿fü\«(œ†;@ÉN/¿1\”ˆØ¨†;@p#eã§\r/¿Ø?âœù†;@9\÷\≈m4/¿\0\ƒ]Ωä†;@tœ∫F\À/¿±mQfÉ†;@àÄC®R/¿â|óRó†;@6ê.6≠/¿\Ó–∞u°;@g\nù\◊\ÿ/¿PäV\Ó¢;@±®à\”I/¿\»	F≥¢;@°ù\”,\–/¿)[$\ÌF£;@\“\·!å/¿\–dˇ<\r§;@≠jIG/¿\ÎT˘ûë§;@ı+ù\œ\Z/¿é≤~31•;@¨\Â\ŒL0/¿É/L¶\n¶;@\⁄8b->/¿&VF#üß;@\’[[% /¿\r˙\“€üß;@süà\"/¿t\\ç\ÏJß;@òMÄa˘#/¿®ç\Ít ß;@c`\«%/¿¥ì¡QÚ¶;@ªa€¢\Ã&/¿”ΩN\ÍÀ¶;@LnYk(/¿\ZM.\∆¿¶;@,gÔå∂*/¿≠˙\\m≈¶;@€¢\Ãô,/¿¯P¢%èß;@ÆÄB=-/¿*:í\À®;@\–\ÓêbÄ,/¿¡tZ∑A©;@ºêa,/¿k$	¬©;@\„n≠-/¿-”æ©;@\ÂÚ\“o//¿O\Í\À\“N©;@tœ∫F\À1/¿ÄF\È“ø®;@ta§µ3/¿ºz®;@r6\‹4/¿ÇV`\»\Í¶;@H˝ı\n6/¿é[\Ïˆ•;@ÊØêπ28/¿\Ÿ\Ì≥\ L•;@¬ÜßW\ :/¿TW>\ÀÛ§;@˘˜</¿;\√‘ñ:§;@˚\Ê˛\Íq?/¿\∆˘õPà§;@q\ÊWsÄ@/¿Ç\·\\\√•;@ñZ\Ô7\⁄A/¿j\⁄\≈4”•;@Ù©cï\“C/¿J&ßv¶;@.ˇ!˝ˆE/¿*\‚tí≠¶;@\ﬂ5\ËKoG/¿\\ìnK\‰¶;@˘£®3˜H/¿è6éXãß;@/Ü\»I/¿ál ]®;@ˇy\Z0HJ/¿\Zn¿Áá©;@5&\ƒ\\J/¿\‚<ú¿t™;@£h[\ÕJ/¿∫†æeN´;@\Ó[≠óK/¿Ä`éø´;@\‰GàL/¿Û\„/-\Í´;@\Ÿ_vON/¿^,ë”´;@AÙ§LjP/¿\…t\ËÙº´;@\Â∂}èR/¿ì®|ö´;@îˆ_òT/¿§ã¶´;@_\‘\ÓWV/¿_%ª¨;@\Í∞\¬-W/¿Qˆñræ¨;@N*\ZkW/¿¥Ë°∂≠;@∫ÉÿôBW/¿Ÿ≤|]Æ;@œ¢w*\‡V/¿[$\ÌFØ;@á≈®k\ÌU/¿4˜êΩØ;@6sHj°T/¿¯\¬d™`∞;@wfÇ\·\\S/¿¶}s±;@\Ô˛xØZQ/¿\ÔXlìä≤;@îg^ªO/¿≠mé≥;@! _BO/¿Ö\"\›\œ)¥;@§ƒÆ\Ì\ÌN/¿°-\ÁR\\µ;@F^\÷\ƒO/¿\€¶∂‘µ;@¯˘\Ô¡kO/¿uö∂;@Cè=∑P/¿e\ƒ†Q∂;@\“5ìo∂Q/¿\Â\Ïù\—Vπ;@L7âA`U/¿rã\ﬂ∫;@Mg\'É£T/¿!XU/øª;@I\Ÿ\"i7R/¿\“\‚åaNº;@¢Ø \ÕP/¿[]N	àΩ;@É}iN/¿¸R?o*æ;@\Ÿ^zoL/¿Tsπ¡Pø;@•	¶öI/¿zÛW¿;@¿#*T7G/¿àL˘T¡;@Ö≤ıµF/¿ÅØ\Ë\÷k\¬;@urÜ\‚éG/¿BCˇ\√;@\¬˘‘±JI/¿{ÜpÃ≤\√;@i\‚\‡IK/¿™ö \Í>\ƒ;@°J\ÕhM/¿˜ôù\∆;@Jòi˚O/¿/R(_\«;@Y|EO/¿\’[[\…;@\‚>rk\“M/¿\√ÛR±1\À;@4Úy\≈SO/¿\…t\ËÙº\À;@\Ã_!seP/¿Nˆ#E\Ã;@\Á˝ú0Q/¿¢Ø \Õ\Ã;@ir1\÷Q/¿H\‚\Â\È\\\Õ;@|Ú∞PkR/¿≠\ﬂLL\Œ;@Y˝ÜS/¿2\"QhY\œ;@3mˇ\ JS/¿¥r/0+\–;@0◊¢hS/¿ô†Üoa\—;@˝I|\ÓS/¿ì¨\√\—U\“;@ı+ù\œR/¿FA¯\“;@úMG\07S/¿3ä\ÂñV\”;@ˆ&Ü\‰T/¿Û\»<\”;@\“\Ó#∑V/¿Àª\Í\”;@u \Î©\’W/¿`ÆE\–\“;@\∆ià*¸Y/¿•†\€K\Z\”;@ßí†ä[/¿°Gåû\”;@)≥	0\\/¿{JŒâ=\‘;@\≈oÚ[\\/¿\Ívˆï\’;@#\€˘~j\\/¿?\„\√\Ï\’;@N\“¸1≠]/¿Öy7\÷;@ò2p@K_/¿Û\‚\ƒW;\÷;@\ﬁû¥pa/¿K\Í4\÷;@∫\‹`®\√b/¿“åE\”\’;@òMÄa˘c/¿™Ù\Œn\’;@*ènÑEe/¿lñ\ÀF\Á\‘;@˝ø\Í»ëf/¿>ì˝Û4\‘;@Ù•∑?g/¿ì˛^\n\”;@T5A\‘}h/¿h$B#\ÿ\–;@\œjÅ=&j/¿\·\n(\‘\œ;@¨0ôj/¿ü\0äë%\œ;@\ÀM\‘\“\‹j/¿\"m\„OT\Œ;@-\“\ƒ;¿k/¿≠N\ŒP\‹\Õ;@≥\≈V\–l/¿(\’>è\Õ;@PU°ÅXn/¿â\—s]\Õ;@+0du´o/¿g)YNB\Õ;@\”L˜:q/¿;åI/\Õ;@æ¿¨P§s/¿7˝Ÿè\Õ;@\‰£\≈\√t/¿í∞o\'\Õ;@I\◊Læ\Ÿv/¿L¶\nF%\Õ;@Ii6è\√x/¿xe®ä\Õ;@£\\\Zøz/¿\0\≈»í9\Œ;@≥\ÏI`{/¿\«\Ÿtp\œ;@£ x|{/¿Ùk\Îßˇ\–;@RΩ¬Ç{/¿O\…9±á\“;@wΩ4EÄ{/¿Å≤)Wx\”;@Ü:¨p{/¿\‡IóU\‘;@h[\Õ:{/¿\‡û\ÁO\’;@±O\0\≈\»z/¿EbÇ\Zæ\’;@Öz˙¸y/¿ <˜\÷;@KxBØ?y/¿£ËÅè¡\÷;@≥yÛw/¿&\≈\«\'d\◊;@˜ì1>\Ãv/¿∑ô\nÒH\ÿ;@õ.»ñu/¿:ì6U˜\ÿ;@M°Û\Zªt/¿&ßvÜ©\Ÿ;@\⁄YÙNt/¿t∑\Î•)\⁄;@DkEõs/¿<g≠\€;@ ãL¿Øq/¿í≤E\“n\‹;@U[rp/¿å°úhW\›;@]˚z\·n/¿~˛{\⁄\›;@\ÌI`sn/¿ê\⁄\ƒ\…˝\ﬁ;@≥\≈V\–l/¿I˜s\nÚ\ﬂ;@r \nfl/¿Äùõ6\„\‡;@¨r°ÚØm/¿\√\’w\·;@û^)\Ào/¿X≠L¯•\‚;@*©\–Dp/¿û	M\„;@\Õ\Ínán/¿\ÌπLMÇ\„;@n1?74m/¿fæÉü8\‰;@?\0©Múl/¿	\‚<ú¿\‰;@5≤+-#m/¿\Ï.PR`\Â;@jÑ~¶^o/¿UΩ¸Nì\Â;@ïµMÒ∏p/¿ánˆ\ \Â;@\—yç]¢r/¿ä\ÂñVC\Ê;@1∑{πOv/¿C\Á5vâ\Ê;@\»A	3mw/¿ı\Ÿ\◊\Á;@IüVy/¿jlØΩ\Á;@\Ï\›\ÔU{/¿\‰G\Ë;@ˆ~£7|/¿wg\Ì∂\È;@√Éf◊Ω}/¿aR||B\Í;@jgò\⁄R/¿∫†æeN\Î;@ãS≠ÖYÄ/¿\‘÷à`\Ï;@s/0+Å/¿™Ä{û?\Ì;@¢\Ï-\Â|Å/¿dWZF\Í\Ì;@≠jIGÅ/¿h◊ø\Ô;@F|\'fΩÄ/¿x\“\¬eÚ;@É§O´Ä/¿-`∑\ÓÚ;@q\…qßtÄ/¿ë(¥¨Û;@≥≥\Ëù\nÄ/¿)^emSÙ;@\ﬁ	ä/¿H¿\ËÚ\ÊÙ;@\√E\Ó\È\Í~/¿|\Ôo\–^ı;@\ËÖ;~/¿`\»\ÍV\œı;@\◊h9\–C}/¿πß´;ˆ;@˛ú0a|/¿a6Ü\Â˜;@-≥\≈Vx/¿∆øœ∏p¯;@r7à÷äv/¿≥∂)˘;@®\ÂÆÚt/¿kô\«Û˘;@pCå◊ºr/¿¿B\Ê †˙;@Gà,\“l/¿=⁄®N˚;@¿ \È\”*j/¿]\·].\‚˚;@t\Ï†\◊i/¿CusÒ∑˝;@d=µ˙j/¿J\ÌE¥ˇ;@\“\ZÉNm/¿\ÁV´±\0<@ù∫ÚYn/¿Z†¶ñ<@\ \Zıçn/¿˛\'˜é<@\‡+∫ıön/¿\≈<+i\≈<@.\ÁR\\Un/¿˘ıCl<@>?ån/¿≥∂)<@UÜq7àn/¿ Ò+\÷p<@:@0Gèo/¿™D\Ÿ[\ <@bodq/¿ÆG\·z<@∑µÖ\Á•r/¿Û9wª^<@4d<J%t/¿ˇ\Œˆ\Ë\r<@≤\‘zø\—v/¿\Ìˇ∞•<@ürL˜w/¿ù\œd<@\réíW\Áx/¿uV\Ï1	<@üêù∑±y/¿ <˜\n<@Na•Çäz/¿=\Ó[≠<@˙\n“åE{/¿Ujˆ@+<@!\‰ºˇè{/¿\Ã\—\„˜6\r<@™\÷\¬,¥{/¿∂üåÒa<@\œNG\…{/¿W	á3<@WAt\Ì{/¿vkô\«<@Å∞S¨\Z|/¿\‰.\¬<@˘\⁄3K|/¿\„OT6¨<@˛(\Í\Ã=|/¿íîÙ0¥<@J¥\‰Ò¥|/¿ΩQ+L\ﬂ<@`[?˝g}/¿Vc	kc<@õ\»\Ã~/¿NöEÛ<@t\“˚\∆\◊~/¿ß?˚ë\"<@YvQÙÄ/¿6?˛“¢<@]˚Ç/¿¸˛Õã<@ŸïñëÇ/¿ìêH\€¯<@qtïÓÆÉ/¿\·&£\ <@B\Î\·ÀÑ/¿Äa˘Ûm<@_ïïÖ/¿!\ËhUK\Z<@ü\ÂypwÜ/¿`\…U,~<@u\…8F≤á/¿õ˛\ÏGä<@¿\Í»ëŒà/¿vˇXà<@>\ÍÕ®â/¿˛µºrΩ<@\‘aÖ[>ä/¿$π¸áÙ<@∑BXç%å/¿ïÙ0¥:!<@ª∑\"1Aç/¿#É\‹Eò\"<@Ø≤∂)é/¿ƒòÙ˜R$<@∫\Ÿ(è/¿z\·ŒÖ%<@o∫eá¯è/¿…´s\»&<@\Ã\rÜ:¨ê/¿±\‹\“jH(<@:\Í\Ë∏\Zë/¿t¥™%)<@Ÿñg)ë/¿ÃòÇ5*<@(~åπkë/¿óˇê~˚*<@q\‚´≈ë/¿S<.™E,<@º<i\·í/¿á\ﬂM∑\Ï,<@µ‹ô	Üì/¿∂Û˝\‘x-<@S$_	§î/¿-”æ-<@S\È\'úï/¿\rP\Zj.<@≥öÆ\'∫ñ/¿\÷\…ä;.<@πﬂ°(–ó/¿fΩ â.<@\ 4ö\\åô/¿¢cï∏.<@˛~1[≤ö/¿L\ƒ[\Á\ﬂ.<@d≠°\‘^ú/¿Ø≤∂)/<@Òf\r\ﬁWù/¿q\„Ûs/<@5\nIfıû/¿[y\…ˇ\‰/<@Z~\‡*O†/¿∏Ö\ÎQ0<@\Á˝ú0°/¿\Ï¡§¯¯0<@ŒßéU¢/¿ÇSH\ﬁ1<@\ƒ&2sÅ£/¿Äbd\…3<@4iSuè§/¿){K9_4<@\Óy˛¥Q•/¿òßsE)5<@0ÒGQg¶/¿X;äs\‘5<@Q\›\\¸mß/¿πDkE7<@2t\Ï®/¿c\—tv28<@ƒô_\Õ™/¿\Z\‰.\¬8<@ê‹öt[™/¿\Ê\"æ≥:<@|Vú™/¿¨TPQı;<@l\œ,	P´/¿c\Ÿ=y<<@\„\√\Ïe´/¿Ñh\„à=<@†©\◊-´/¿c\rπß?<@∫\¬j,©/¿ådèP3@<@Z,EÚï®/¿èVµ§£@<@âBÀ∫ß/¿0Û¸@<@t@ˆ\Ì§/¿¥WA<@t≥?Pn£/¿Ø(\r5B<@•û\–\Îü/¿é?QŸ∞B<@\Ê\ÿGßû/¿f/\€N[C<@\0\ÊZ¥\0ù/¿†SêüçD<@\◊l\Â%ˇõ/¿ddY0E<@®p©õ/¿\–+ûz§E<@∏<÷åö/¿U\¬z˝E<@;˛ô/¿u\Õ\‰õmF<@m´Yg|ó/¿≤H\Ô\0G<@wÖ>X∆ñ/¿1\Ìõ˚´G<@Bò€Ω‹ó/¿\“s]âH<@õèkC≈ò/¿Pîi4I<@ÜKÆbô/¿2q´ J<@\È\◊\÷Oˇô/¿P6\Â\n\ÔJ<@E+˜≥ö/¿\—\Èy7L<@4fıö/¿@ø\Ô\ﬂL<@^f\ÿ(õ/¿âîMπN<@Låe˙%ö/¿.©\⁄nÇO<@≠\ﬁ\·vhò/¿:\ ¡lP<@_∏sa§ó/¿\"OíÆôP<@-`∑\Óñ/¿xö\Ãx[Q<@uñ/¿Æg\«,S<@ó\‚∂î/¿à¬£çS<@\\*\∆˘ì/¿ÄöZ∂\÷W<@¶}sè/¿nYk(Y<@\»^\Ô˛xè/¿#¢òºZ<@Ék\Ó\Ëè/¿é\"k\r•Z<@I/j˜´ê/¿˝Nìo[<@ó\ÊV´ë/¿Öb\Ÿ\Ã]<@HP¸ì/¿ë\'I\◊L^<@¥CV∑í/¿pa\›xw`<@(õrÖwë/¿yaßXa<@i¢≤ë/¿¡\…6pb<@W\È\Ó:í/¿m±üb<@d\Êó«í/¿Qic<@Ã≥íV|ì/¿\‚\ \Ÿc<@ge˚ê∑î/¿\÷»Æ¥åd<@¥Ë°∂ï/¿Æ\ÎçZe<@(ªô—èñ/¿jinÖ∞f<@\Ô%ò/¿`>Y1\\i<@HõVö/¿†‹∂\Ôi<@#Ω®›Øö/¿≥C¸√ñj<@¯\„ˆ\À\'õ/¿Ù¡26tk<@ÒºTlÃõ/¿´\Õˇk<@Vúj-ú/¿-ZÄ∂\’l<@O\Õ\ÂCù/¿Ñ”Ç}m<@5≥ñ“û/¿-óç\Œ˘m<@F\”\Ÿ\…\‡†/¿\·\Ï\÷2n<@Háá0~¢/¿ò\ﬂi2\„m<@HN&n§/¿ïõ®•m<@õ\«a0•/¿ïa\‹\r¢m<@t{Ic¥¶/¿?\∆\‹m<@\np®/¿\ÿÙJYn<@√∂Eô\r™/¿è®åo<@[Œ•∏™¨/¿N\Ï°}¨p<@ôÑyØ/¿ıı|\Õrq<@ı¢vø\n∞/¿ñ_cDr<@™ö \Í>∞/¿û\Ôß\∆Ks<@/j˜´\0Ø/¿bª{Ä\Ós<@\Âöôù≠/¿¨\0\ﬂm\ﬁt<@Ü\Âœ∑´/¿?rk\“mu<@\À+\◊\€f™/¿dêªSÄ<@Ú¥¸¿U∂/¿Úaˆ≤\ÌÄ<@ª~¡nÿ∂/¿^\€\€-…Å<@º#cµ˘∑/¿caàúæÇ<@\◊1Æ∏8∫/¿\ﬂ˚¥WÉ<@ˇ@πmﬂª/¿\ÿ\Ôâu™Ñ<@,ı,\ÂΩ/¿m\«\‘]ŸÖ<@g\Ì∂ÕΩ/¿\∆\‡a\⁄7á<@z\Z0H˙º/¿r•û°à<@óWÆ∑Õº/¿,G\»@ûâ<@@Ñ∏rˆæ/¿Tç^\rPä<@\—\Ëbg\¬/¿è™&à∫ã<@±¢\”0\ƒ/¿j§•Úvå<@\nÇ«∑w\≈/¿\ ¿-]ç<@¨ æ+Ç\«/¿\ÀÒ[é<@÷©Ú=#\…/¿\‚\ Ÿè<@Tç^\rP\ /¿\‰eM,ë<@\ 52;\À/¿}w+ì<@v28J^\Õ/¿Ä+Ÿ±î<@@âœù`\œ/¿ùL\‹*àï<@òıI\Ó\–/¿YâyV“ñ<@T∆øœ∏\–/¿<J%<°ó<@±RAE\’\œ/¿!\»A	3ô<@S\"â^\Œ/¿¥CV∑ö<@ùJÄ*\Œ/¿æ€ºqRú<@\ﬁ\ﬂ4}\Œ/¿|∫∫c±ù<@πp $\–/¿≠\‹Ãû<@y\ j∫û\–/¿ív£è˘†<@§m¸â\ \Œ/¿yy:Wî¶<@fÇ\·\\\√\Ã/¿\Ì\÷2éß<@%W@°\Œ/¿Æc\\qq®<@\0\∆3h\Ë\œ/¿¯nÛ∆©<@€§¢±ˆ\œ/¿aç≥\È¨<@˙,AF\–/¿D™b*≠<@.˛∂\'H\‘/¿1\\\0qØ<@œ¢w*\‡\÷/¿%ªî∞<@\‡ú•Ω\Ÿ/¿†4\‘($±<@–ó\ﬁ˛\\\‹/¿!ë∂Ò\'≤<@pA∂,_\ﬂ/¿{\ÿl≥<@\«e\‹\‘\‡/¿VF#üW¥<@∂Ñ|–≥\·/¿2∆á\ŸÀ∂<@*\‰J=\‚/¿*oG8-∏<@ë∫ù}\Â\·/¿Ü¨nı∏<@àFw;\„/¿A\”+£π<@éÀ∏©\È/¿\Õ\» w∫<@*\‡û\ÁO\Î/¿\rU1ï~∫<@}\È\Ì\œ\Ì/¿µ‹ô	Üª<@\ÏΩ¯¢=\Ó/¿\Z•Kˇíº<@ˇ∞•GS\Ì/¿G\Á¸«Ω<@ÛÆz¿<\Ï/¿â\“\ﬁ\‡ø<@2\ËL\Í/¿<\‹\rã¡<@}w+\Î/¿£ZDì\√<@Ü9Aõ\Ó/¿äØv\Á\ƒ<@\nºìO\Ô/¿p>u¨R\∆<@t%\’?/¿ZÚxZ~\»<@dØwº\Ô/¿ÙP€Ü\…<@P¶\—\‰b\Ï/¿!%Ã¥\…<@æøA{ı\È/¿|Gç	1\À<@Ö¥∆†\Í/¿¯˛\Ì\’\À<@≠mé\Î/¿\≈\…˝E\Õ<@ÕØ\Ê\0¡\Ï/¿\0ˇî*Q\Œ<@6sHj°\Ï/¿w˛E\–<@¢	±à\È/¿â\ÓY\◊h\—<@t\Ô\·í\„\Ê/¿Å@g“¶\“<@~\Z˜\Ê7\‰/¿\ÓC\ﬁrı\”<@ßí†ä\„/¿õZ∂\÷\’<@∫ÿ¥R\‰/¿ì6U˜\»\÷<@$\“6˛D\Â/¿pŒà\“\ﬁ\ÿ<@Ù§ã\Ê/¿(Hlw\‹<@\Â`6Ü\Â/¿%?\‚W¨\›<@\Án\◊KS\‰/¿:=\Ô∆Ç\ﬁ<@ú˚´\«}\„/¿)îÖØ\ﬂ<@ˆ\œ”ÄA\‚/¿|ÒE{º\‡<@S\\Uˆ]\·/¿©i\„<@DäM\‡/¿{g¥UI\‰<@Ñ\’X\¬\⁄\‡/¿\’ºÃ∞\Â<@ß\ËH.ˇ\·/¿∏\"1A\r\Á<@sˆ\Œh´\‚/¿jh∞\È<@#[A\”\‚/¿\◊\€f*\ƒ\Î<@ö\Î4\“\‚/¿øÙˆ\Á¢\Ì<@\‡ù|zl\„/¿\r\–\“\Ï<@\⁄ ìåú\Â/¿?9\n\Î<@≥\–\Œi\Ê/¿p¥\„Ü\ﬂ\È<@9\÷\≈m4\Ë/¿\‡ÿ≥\Á2\È<@\¬MFïa\Ï/¿æMˆ#\È<@RG\«\’\»\Ó/¿\\‰ûÆ\Ó\Ë<@∑ó4F\Î/¿Mg\'É\Á<@\÷\‰)´\ÈÚ/¿O?®ã\Ê<@Ñ∫H°,Ù/¿ôõoD˜\‰<@\Âöôùı/¿(†\ﬂ˜\„<@ó\»g˜/¿\‹\rãQ\„<@ª∂∑[˙/¿vΩS\„<@4ı∫E`¸/¿§Ö\À\‚<@\“\Ó#∑˛/¿ˆöî\‚<@É—Ø≠ˇ/¿N\Ô\‚˝∏\·<@&s,\Ô™ˇ/¿¥Æ+f\‡<@åπk	˘\00¿Q¿v0b\ﬂ<@\◊\»\Ï,0¿§U-\È(\ﬂ<@\√Ú\Á\€0¿F^\÷\ƒ\ﬁ<@q„äã0¿|DLâ$\ﬁ<@\⁄Rê0¿æÖu\„\›\›<@—ïTˇ0¿\›^\“\›<@	åı\rL0¿LnYk\‹<@∆âØv0¿âyV“ä\€<@ÄöZ∂\÷0¿Mfº≠Ù\⁄<@\Z\¬1Àû0¿\ƒ\Ã>èQ\⁄<@4Ñcñ=	0¿MMÇ7§\Ÿ<@Ç«∑w\r\n0¿fjº!\Ÿ<@°l\\0¿Ò∏®\Ÿ<@»≥À∑>0¿ív£è˘\ÿ<@Eª\n)?\r0¿\Âb¨\„\ÿ<@S=ôÙ\r0¿¶Cß\Á\›\ÿ<@\Áß8º0¿B»óP\Ÿ<@˚s—êÒ0¿ÚôÏüß\Ÿ<@˛E–ò0¿\Ó\Î¿9#\⁄<@\Î\…¸£o0¿Vbûï¥\⁄<@E(b0¿N\”g\\\€<@éXãO0¿º}\È\Ì\€<@oÚ[t≤0¿,Ä)\‹<@˝Ç›∞m0¿1\\\0q\€<@¯änΩ0¿vmo∑$\€<@b1\ÍZ{0¿_~ß…å\€<@\Á˚©Ò\“0¿ÀÉÙ9\‹<@ut\\ç\Ï\Z0¿\ÔY\◊h9\‹<@0Ùà\—s0¿Z~\‡*O\‹<@sΩm¶B0¿!sePm\‹<@\Z®åü0¿¸\«Bt\‹<@£è˘Ä@0¿\Â∏S:X\€<@aO;¸5!0¿=ôÙM\⁄<@•£\Ã&$0¿kÚî\’t\Ÿ<@¸9˘\Ÿ$0¿^/M\‡\ÿ<@;\„˚\‚R%0¿\Î™@-\◊<@{iä\0ß\'0¿√Åê,`\÷<@r˝ª>s*0¿¿\ŒMõq\÷<@è=∑\–50¿Ø¥å\‘{\÷<@&S£60¿≠Ñ\Óí8\◊<@\¬ª}V90¿O>=∂e\ÿ<@\Z¡\∆ı\Ô:0¿pCå◊º\⁄<@k\‘C4∫?0¿–úı)\«\ÿ<@\ÊÆ%\‰ÉB0¿_9\Ôˇ\◊<@\…\„i˘ÅC0¿çDh\◊<@,õ9$µD0¿\Í\Ïdpî\‘<@g{ÙÜ˚H0¿èR	O\‘<@Œ¶#ÄõI0¿N^Ù\‘<@W]ájJJ0¿\Œ¸j\‘<@˛\’\„æ\’J0¿ÑÄ|	\‘<@\"ƒï≥K0¿Ü\Ë8\‘<@∆Ö!YL0¿øÛãÙ\”<@\ZQ\⁄|M0¿\n\ÿF\‘<@#\Ÿ#\‘Q0¿S∞\∆\Ÿt\‘<@}Àú.ãQ0¿\0è®P\›\‘<@ÿÉIÒÒQ0¿º\ÍÛê\’<@\Œ\ÊmR0¿æ1\0\«\÷<@˝†.R(S0¿P)îÖ\◊<@ú\‹\ÔPT0¿Zc\–	°\◊<@ä}\"W0¿œ†°Ç\◊<@\ \‹|#∫W0¿†m5\Îå\◊<@\‹ID¯Y0¿äèO\»\Œ\◊<@¸˚åZ0¿\rˇ\È\n\ÿ<@˙\ÃYüZ0¿çzàFw\ÿ<@\‹\ŸW§[0¿∂\ÿ\Ì≥\ \ÿ<@∫Ü\ZO\\0¿±¿Wt\Î\Ÿ<@˙Ä@g\“^0¿.sû\Ÿ<@\⁄\«\n~_0¿\◊j{°\ÿ<@W\\ïõ`0¿Wòæ\◊\ÿ<@\»\œFÆõb0¿#˘J %\÷<@\›\"0\÷7h0¿ ^\◊/\ÿ\’<@dì¸à_i0¿1\Ìúf\’<@\Â\“¯ÖWj0¿\Ëg\Íuã\‘<@∞é\„áJk0¿CÆ‘≥ \‘<@ê\ÿ\Ó†k0¿OØîeà\”<@\—!p$l0¿\ƒ\"R\”\“<@}\ÍX•Ùl0¿Æ†iâï\—<@µ<Lo0¿u≠ΩOU\—<@+5{†p0¿\‰°\Ône\—<@p\œÛßq0¿¨ \Ó\Í\—<@5ñ∞6\∆r0¿\…\ÁO=\“<@˘fõ\”s0¿ß≥ì¡Q\“<@MÛéStt0¿I-îL\“<@g,ö\ŒNv0¿OWw,∂\—<@v?T\Zy0¿\ÕV^Ú?\—<@ µâì˚y0¿C ó8Ú\–<@¿\Z3âz0¿Û\ËFXT\–<@\"S>U{0¿.:YjΩ\œ<@ö\“˙[|0¿\≈\Z.rO\œ<@´vMHk|0¿\”lá¡\Ã<@\\:\Ê<0¿Ù¶\"\∆\ <@∆ä\ZL√Ä0¿\‰N\È`˝\«<@\"\·{ÉÇ0¿v•e§\ﬁ\√<@í\œ+ûzÑ0¿o+Ω6\√<@æ\Ÿ\Ê\∆ÙÑ0¿@¿Zµk\¬<@\‰€ª}Ö0¿0Û¸\ƒ¡<@9\Ì)9\'Ü0¿U§\¬\ÿB¿<@BA)Zπá0¿óg)Yæ<@Q0c\nä0¿4ºYÉ˜Ω<@\ \Zıçä0¿∑\nb†k£<@˚\Î‹è0¿¿<d áÄ<@™õãøù0¿©K\∆1íi<@\œf\’\Ájß0¿',1607362055,1607362055,NULL,NULL),(10,'Western',_binary '\Ê\0\0\0\0\0\0\0\0\0\0\0\0\0\0U\0\0\ÌHıù_§8@;é*ç\0,¿77¶\',•8@VÛë\Ô˙+¿=∏;k∑•8@ó©IÜÙ+¿¶(ó∆ß8@?¯˘\Ô+¿H\·zÆ´8@r¬Ñ—¨\Ï+¿É§O´∞8@\Ô%+¿\Ìa/∞±8@çÒaˆ≤ı+¿LnYk¥8@Ùáfû\\˚+¿¸5Y£∂8@¿\Õ\‚\≈\¬\0,¿π´Wë—π8@F}í;l,¿¡nÿ∂º8@\nÜs\r3,¿\√(ﬂæ8@Çç\Î\ﬂı,¿êf,öŒæ8@#/kbÅ,¿õôùEø8@±£q®\ﬂ,¿:Ø±KTø8@ˆ\n\Ó$,¿ãâ\Õ«µΩ8@&åfe˚(,¿âaá1\Èª8@ã\≈o\n+-,¿v™|\œHº8@íç`\„2,¿w\‹ª\Èæ8@ëÅ<ª|3,¿\Ÿ^zo¿8@}> à8,¿}\Î\√z£\¬8@^Å\ËIô<,¿\Ô%\ƒ8@[]N	àA,¿{1î\Ì\∆8@\Œn-ìA,¿6\Â\n\Ôr\Õ8@bN\–&áG,¿ä\„¿´\Â\Œ8@∏u\ K,¿\Ÿyõ\—8@æ\⁄Qú£N,¿\ƒÕ©d\0\‘8@OÅ?¸L,¿EKO\À\◊8@∞èN]˘L,¿*™~•Û\Ÿ8@ÈπÖÆDP,¿qTn¢ñ\ﬁ8@í±\⁄¸øR,¿!ÙlV\·8@ZF\Í=ïS,¿TåÛ7°\‰8@oB@æT,¿\—6Æ\Á8@f1±˘∏V,¿¨p\ÀGR\Í8@-\È(≥Y,¿\‚\‡I\Î8@∏t\Ãy\∆^,¿\‚ìN$ò\Ó8@\r•ˆ\"\⁄^,¿¯¨8Ò8@Ã∂\”÷à`,¿‚è¢\Œ\‹Û8@På,ôc,¿\·\ÁS\«ˆ8@\Z\ﬂó™d,¿\÷\‡}U.¯8@\ÂDª\ni,¿‹ùµ\€˛8@D¢–≤\Óg,¿æ.\√∫9@Q/¯4\'g,¿J@L¬Ö9@\"˚ ÀÇi,¿\ÿl9@1^Û™\Œj,¿	Qæ†Ö9@Sï∂∏\∆o,¿\‰.\¬\Â\n9@&7ä¨m,¿\·zÆG\r9@µ¸¿Uûp,¿\”lá¡9@Ø|ñ\Á¡m,¿+hZbe9@=∏;k∑m,¿ÑÄ|	9@\Œ\ZºØ\ m,¿zq\»\Z9@M¯•~\ﬁt,¿\Óïy´9@µ3Lm©{,¿.9\Óî\Z9@/Ü\»\È{,¿¿ñWÆ∑9@˜V$&®Å,¿≤Åt±i9@^i©˜å,¿3OÆ)ê!9@SuèlÆí,¿˙C3OÆ!9@\›ãäò,¿˙∂`©. 9@°J\Õhù,¿ôa£¨\ﬂ9@´\ŒjÅ=û,¿^¢zk`9@\‘\’ãm¢,¿ª_¯n9@?74eßß,¿åh;¶\Ó\Z9@®éUJœ¨,¿6\Â\n\Ôr9@±¸˘∂`±,¿oıúÙæ9@\÷\…ä;∂,¿÷©Ú=#9@\‡ª\Õ\'Ω,¿N\–&áO9@\»_Z\‘\'¡,¿≤\÷Pj/9@ãl\Á˚©\…,¿I+æ°9@\◊˙\"°-\œ,¿\ÃC¶|9@ˆ&Ü\‰\‘,¿5\‘($ô\r9@ß\ÀbbÛ\Ÿ,¿¡7Mü9@∂0\Ìú\ﬁ,¿•M\’=≤	9@çF>Øx\‚,¿\∆\√{,9@òN\Î6®\Â,¿\œJZÒ\r9@L\ﬁ\03\ﬂ\È,¿˘˜9@/0+\È\Ó,¿qˇë\È\–9@`¨o`rÛ,¿M˜:©/ˇ8@†˘úª]˜,¿\ŸÉk\Ó¸8@à/EH˝,¿NôõoD˚8@\Êv/˜-¿`tys∏˙8@Öyè3M-¿í=BÕê˙8@{ÙÜ˚\»\r-¿\"OíÆô¯8@p∂π1=-¿ıf\‘|˘8@´x#Û\»-¿\r\‡-ê¯8@\“\ZÉN-¿Ä\÷¸¯K˚8@\‡ÇlYæ-¿x\Ô®1!˙8@˝Ùü5?&-¿Yá£´t˚8@y\È&1,-¿§q®ﬂÖ˝8@aàúæû/-¿·∂∂º\09@\Â|±˜\‚3-¿YO≠æ9@?˝gÕè7-¿dvΩS9@@¿Zµk:-¿ØyUgµ9@Ú\È±->-¿Ωm¶B<9@“åE\”\ŸA-¿DO §Ü9@\0\‰Ñ	£A-¿\ËÖ;9@≥\—9?\≈A-¿û\—V%ë9@ø\”d\∆\€B-¿\»{\’ Ñ#9@\◊\€f*\ƒC-¿\«/ºí\‰%9@a\ﬂN\"\¬?-¿¸¸˜\‡µ+9@,\’º<-¿$}ZE09@Fò¢\\\Z?-¿É5Œ¶#49@rk\“mâ<-¿/Ö\Õ69@3SZK8-¿⁄é©ª≤;9@Sz¶ó3-¿ßŒ£\‚ˇF9@p\Õ˝//-¿Ûë\ÔRJ9@6<ΩR.-¿«∫∏çN9@2!Êí™--¿ív£è˘T9@\ÁrÉ°+-¿0ôÚ!X9@g\r\ﬁW\Â*-¿gC˛ôA\\9@øôò.\ƒ*-¿ó‚™≤\Ôf9@Ò\‘#\rn+-¿[{k9@o/iå\÷)-¿\«bõT4n9@˙Gﬂ§i(-¿$_	§\ƒr9@r1\÷q$-¿ƒ¨Cu9@\rP\Zj\"-¿\Ì\’\«C\ﬂy9@\…\«\Ó%-¿ß\ÏÙÉ∫|9@´í\»>\»\Z-¿QßìlÅ9@&r¡¸-¿\Ïæcx\ÏÉ9@ˇíT¶ò-¿mˇ\ JìÜ9@óè§§á-¿T\‚:∆â9@y≠Ñ\Óí-¿º\Õ\'Öç9@F\Œ¬ûv-¿P´îûï9@.¯ßT-¿RÚ\Íñ9@ﬂº8Ò-¿\Ó\Î¿9#ñ9@j°drj-¿%¿î9@\"˝ˆu\‡-¿>x\Ì“Üì9@1\Ìúf!-¿\Ó±Ù°í9@K∫†æ%-¿*ú\ﬁ≈è9@\Ã_!se(-¿4-±2\Zç9@E/£Xn)-¿\»`≈©÷ä9@¡pÆaÜ.-¿ÛX32»â9@\⁄\ZåÉ3-¿0Ú≤&à9@\⁄\Â[\÷;-¿U/ø\”dÜ9@fJ\Îo	@-¿ip[[Ñ9@h\\8íE-¿Gqé::Ç9@¸\„ΩjeJ-¿µ£8GÅ9@§ng_yP-¿°\⁄\‡DÙ9@p\ÓØ˜U-¿J\Ï\⁄\ﬁn}9@W#ª\“2Z-¿\nfL¡\Z{9@ôg%≠¯^-¿\Ê}ì¶y9@$\“6˛De-¿ å∑ï^{9@(-\\Vak-¿µ4∑BX}9@úi\¬ˆìq-¿òi˚WV~9@)yuéy-¿àd»±ı|9@\Ó\Ó∫/-¿Q.ç_x}9@M°Û\ZªÑ-¿8ˆ\ÏπL}9@/ÖÕÆã-¿õ\”ñ|9@>˘í-¿ùg\ÏK6z9@]P\ﬂ2ó-¿Äπ-@w9@å1∞é\„ó-¿\0˛)U¢t9@\…uS\ kù-¿˛∂\'Hls9@sÒ∑=A¢-¿l\—¥≠r9@\÷pë{∫™-¿\Ÿ^zop9@ªõß:\‰∂-¿à\n\’\Õm9@˝¯Kã˙º-¿Tè4∏≠m9@ˇ@πm\ﬂ\√-¿Õ´:´n9@Kë|%ê\ -¿NDø∂n9@ZÉ˜Uπ\–-¿fàc]\‹r9@Y∑\—\0\ﬁ-¿\«\‘]\Ÿw9@\Á\ƒ\⁄\«\Í-¿û?mTßw9@∑(≥A&Ò-¿/2øFv9@MK¨åFˆ-¿Æ\”HK\Âu9@yué\Ÿ˚-¿èo\Ôv9@\Ó$\"¸ã\0.¿D\€1uWv9@öîÇn/.¿-?pï\'t9@∏u7O.¿líÒo9@,G\»@&.¿có®\ﬁ\Zl9@D¢–≤\Ó\'.¿QÜ™òJk9@≤/\Ÿx∞-.¿›îÚZ	m9@±√òÙ˜2.¿\À\ÿ\–\Õ˛l9@f0F$\n=.¿∂/†\Ól9@Úñ´õD.¿\Ÿyõi9@l|&˚\ÁI.¿˛Ò^µ2e9@¿ñWÆ∑E.¿\“\√\–\Í\‰`9@}xñ #H.¿h\Œ˙îc^9@@x\Ó=L.¿x%\…s}[9@ôcyW=P.¿z\‰ûW9@nQfÉLR.¿Ñd∏Q9@hÒÅ_.¿ﬁìáÖZS9@9ºZ\Ól.¿\ŒSr3T9@‘õQÛUr.¿ºß>êT9@7ç\Ìµ†w.¿\◊h9\–CU9@ízO\Â¥.¿µ4∑BT9@Ú#~\≈\ZÜ.¿®R≥ZQ9@ä\"§ngè.¿\ÏK6lQ9@˜îú{ò.¿û@\ÿ)VU9@Eû$]3©.¿¥sö\⁄U9@xπà\Ôƒ¨.¿ív5yV9@)[$\ÌFØ.¿§ä\‚U\÷V9@ë)Ç™±.¿˘ù&3\ﬁV9@?9\n≥.¿¸\∆◊ûYV9@†≤∫µ.¿\ÿÒ_T9@ì8+¢&∫.¿¨ æ+ÇS9@éwG\∆jª.¿t)Æ*˚N9@\‡V*®¿.¿\'•†\€KN9@Ωv\ﬂ1\ƒ.¿í\Œ¿\»\ÀN9@bX9¥\».¿N_\œ\◊,O9@»≤`\‚è\ .¿p^ú¯jO9@R<æΩ\À.¿\›\ÌziäP9@~®4bf\œ.¿èâîfÛP9@z\·ŒÖ\—.¿£ì•\÷˚M9@Ç\ƒv˜\0\Â.¿H\‚\Â\È\\I9@_~ß…å\Ô.¿\√\◊◊∫\‘H9@Z+\⁄\Á\Ó.¿»ô&l?E9@ •ÒØ\Ï.¿\‘b0\ÌC9@À†\⁄\‡D\Ï.¿\ÏM\…A9@¿[ AÒ\Î.¿zé\»w)A9@\ﬁUòá\Ï.¿1DN_\œ?9@\ﬁ\Á¯hq\Ó.¿˘ù&3\ﬁ>9@˝\⁄˙\È\Ô.¿EúN≤\’=9@¯XéêÒ.¿\Z4ÙOp=9@3díëÛ.¿sÙ¯Ω=9@C™(^eı.¿\ 2ƒ±.>9@Å	‹∫õ˜.¿Y\·&£>9@\0X9\“˘.¿eSÆ>9@Pqxµ¸.¿¯\· !\ ?9@*Wxóã\0/¿‡Ω£∆Ñ@9@Úw\Ô®1/¿\«bõT4B9@\’yT¸\ﬂ/¿Tt$óˇD9@ød\„¡/¿»≤`\‚èF9@\»@û]æ/¿\‘-¨G9@díë≥∞/¿ìÜV\'G9@+Nµf	/¿©à\”I∂F9@á\‹7\‡/¿Z_&F9@\—Aóp\Ë\r/¿¶”∫\rjC9@Ò[z/¿P´\Ë\Õ@9@Jòi˚/¿\„p\ÊWs@9@óræ\ÿ{/¿˝\›;jL@9@~\«\ÿ\œ\Z/¿\’x\È&1@9@‹Ä\œ#/¿\—u\·\Á?9@\⁄ ìåú/¿∂¢\Õqn?9@$∂ª\Ë/¿x≥\Ô´>9@ãS≠ÖY /¿\‹\ÿ\ÏHı=9@è¶z2ˇ /¿\Z¸˝b∂<9@\œejº!/¿Ä*n\‹69@\Á\ﬂ.˚u//¿zè3M\ÿ69@\—Wêf,2/¿q©J[\\79@|E∑^\”3/¿÷år99@oH£7/¿Ω\»¸\Z99@\‚vhXå:/¿d≠°\‘^<9@-µ\ﬁo¥;/¿áüˇH9@sæ\ÿ{ÒM/¿Ù3ı∫EH9@≥?Pn\€O/¿X´vMH9@v§˙\Œ/R/¿ôÄ_#IH9@ïbG\„PW/¿\\ëò†ÜG9@”á.®oY/¿a5ñ∞F9@ß\ËH.ˇY/¿ú1\Ã	\⁄D9@28J^ù[/¿≈è1wA9@8Öï\n*Z/¿kæ*>9@ˇ]ü9\Îc/¿ã¶≥ì¡=9@PráMdf/¿g\Ì∂\Õ=9@\\Æ~líg/¿≈ír˜9>9@∏@Ç\‚\«h/¿&«ù\“¡>9@âE;åi/¿\Ã\–x\"à?9@ïÅZ∫j/¿é*çòA9@\\W\Ão/¿?˙\ÓVB9@h∞©Ûp/¿lxz•,C9@âîMπr/¿\ÃB;ßYH9@\Â\'\’>/¿{\€LÖxH9@:∏YºÄ/¿è\ÈåH9@y\\TãàÇ/¿®5\Õ;NI9@5	ﬁêFÖ/¿\“\„˜6˝I9@\¬˜˛\ÌÖ/¿+O \ÏK9@^ÇSHÜ/¿2v\¬KpN9@k*ã¬Ü/¿?74eßO9@\”3Ω\ƒXÜ/¿§ng_yP9@\ﬂ\›\ ùÖ/¿¶ùö\À\rR9@\ﬂ,\’Ñ/¿ÄûíR9@Aö±h:É/¿Å>T9@\‹,^,Å/¿πß´;V9@\◊KS8}/¿@Ñ∏rˆV9@ÄJï({{/¿\·a\⁄7˜W9@t|¥8cx/¿¶GS=ô[9@\‡+∫ıön/¿\Èπ-\\9@&¨ç±n/¿≥\Îﬁä\ƒ\\9@V\”ıD\◊m/¿Ö^ü_9@ˆ&Ü\‰t/¿ãS≠ÖY`9@iSuèlv/¿\ŒTàG\‚a9@\Á¶\Õ8\ry/¿úoD˜¨c9@_F±\‹\“z/¿Dà+g\Ôd9@2w-!|/¿µQùde9@Ö%P6}/¿ÑΩâ!9e9@U˙	g∑~/¿3é\Á3d9@4ªÓ≠à/¿¥ î˜qd9@Ûê)Çä/¿¶ÒØ$e9@Ö\Œk\Ïç/¿›ó3\€e9@e6\»$#è/¿\ﬂ\›\ ùe9@;\√‘ñ:ê/¿¥¨˚\«Bd9@ë(¥¨ì/¿UÜq7`9@YâyV“¢/¿Ü¨nı`9@E)!XUß/¿q\ÊWsÄ`9@	Qæ†Ö¨/¿∂ºrΩmb9@L\‡\÷›¥/¿Ö(_\–Bb9@Æ\r\„¸µ/¿˘gÒa9@x–∑/¿º!ç\n`9@\„k\œ,	¿/¿bIπ˚_9@\·\“1\Á\√/¿¡V	áW9@e6\»$\€/¿dZõ\∆ˆV9@ïI\rm\0\ﬁ/¿Äd:tzV9@_(`;\·/¿Hj°drV9@3QÑ\‘\Ì\‰/¿ˇ±W9@\ﬁ>´Ãî\Ê/¿õ.»ñY9@E\Ÿ[\ ˘\Í/¿ïõ®•πY9@\Á\‚o{Ç\Ï/¿<¢BusY9@\¬\÷l\Â\Ì/¿Û=#\ZY9@-&6\◊\Ó/¿X©†¢\ÍW9@|,G\»/¿≤ÇﬂÜW9@Ral!\»Ò/¿ÙãÙV9@p[[x^Ú/¿\–	°É.U9@K;5óÙ/¿\ﬂ\·vhXT9@\ƒ\Ã>èQˆ/¿∑|$%=T9@\"ã4Ò¯/¿\€\ﬁnIT9@∏\Êé˛ó˚/¿3díëS9@¸»≠I∑˝/¿4É¯¿éS9@^†§¿\00¿Ògx≥S9@Ø\n\‘b\00¿ÀºU◊°R9@\≈=ñ>t0¿ë–ñs)R9@}\"Oí0¿Abª{ÄR9@36t≥?0¿%\ÎptïR9@aåHZ0¿*sÛç\ËR9@\Èb\”J!0¿qvkôS9@—ì2©	0¿H\‹c\ÈCS9@v5y\ \n0¿*7QKsS9@YjΩ\ﬂh0¿\ÿ\‘yT¸S9@U§\¬\ÿB0¿\„Q*\·	U9@Ø\Ì\Ìñ\‰0¿≥E\“nÙU9@\ne\·\Îk\r0¿\›^\“≠W9@\€1uWv\r0¿4Ü9AõX9@´\Ì&¯¶\r0¿°Ç\√\"Z9@OIü0¿Ù\ZªDıZ9@]õè0¿ôÄ_#I\\9@˜@0¿\»_Z\‘\']9@\…ëEö0¿ûóäç]9@µ¿)0¿>\ÈDÇ]9@gDio0¿\Ê\Â∞˚é]9@÷®áht0¿!W\ÍY^9@™\‘\ÏÅV0¿T9\Ì)9_9@æü\Z/\›0¿m:∏Y`9@Óò∫+ª0¿f¢©\€a9@¯¸0B0¿\ƒ!Hc9@\√c\“\ﬂ0¿πã0Ee9@Òün†¿0¿>ï”ûíg9@®¶$\Îp0¿⁄Æ\–\Àh9@ä)x\n0¿r\≈\≈Qπi9@\≈ ∞rh0¿É}ij9@˜V$&®0¿˛\Ó5&l9@\”3Ω\ƒX0¿$Din9@ºX\"ß0¿æ£∆Ñòo9@V}Æ∂b0¿/¡©$o9@^*6\Êu0¿7P\‡ù|n9@oÚ[t≤0¿\–^}<Ùm9@ñ0¿µãi¶{m9@\Ï‹¥ß0¿˛C˙\Ì\Îl9@\Œ¡3°I\Z0¿T\Z1≥\œk9@ˆ—©+0¿3˛}∆Ök9@nj†˘ú0¿d\Êó\«j9@±1Ø#0¿ä\ÂñVCj9@öôôôô0¿\ﬁu6\‰üi9@f°\ÿ\n0¿ïù~Pi9@™IÜ40¿ŸµΩ›íh9@MhíXR0¿¿¥®Org9@R\r˚=±0¿¯˝õ\'f9@QL\ﬁ\00¿\’íwe9@:Ø±KT0¿íxy:Wd9@ñ[Z\râ0¿ˆ)\«dqc9@Æº\‰Ú0¿˙µı\”b9@\À⁄¶x\\ 0¿\Î\„°\Ôna9@m˛_u\‰ 0¿Ii6è\√`9@ |(!0¿Kr¿Æ&_9@Ú\È±-\"0¿Õ∞Q\÷o^9@:Z’í\"0¿\—<ÄE~]9@∂h\⁄V#0¿\≈˛≤{Ú\\9@Ωˇè&$0¿\‘U¯3\\9@ú•d9%0¿àFw;[9@R_ñvj&0¿1\ÍZ{üZ9@Ä(ò1\'0¿ôÚ!®\ZY9@ADj\⁄\≈(0¿ÛtÆ(%X9@\‡ıô≥>)0¿%í\ËeW9@àπ§jª)0¿ïa\‹\r¢U9@	5C™(*0¿Ü %\ÃT9@IÙ2ä\Â*0¿Ñ∫ÑCS9@\÷o&¶-0¿∂ˆ>UÖR9@á\√\“¿è.0¿ú\Ê=\ŒP9@xœÅ\Â10¿q\0˝æO9@M˘Tç20¿(\”hr1N9@cAJ40¿ı/IeäM9@ÒΩøA{50¿ı\⁄l¨\ƒL9@\Ô9∞!70¿Ç’∞\ﬂK9@òøB\Ê\ 80¿6 B\\9K9@5\Ìbö\È:0¿µå\‘{*K9@◊¶±Ω<0¿G:#/K9@\À/É1\"=0¿\⁄\Á1\ 3K9@\ \√B≠i>0¿lï`q8K9@åÚ\Ã\Àa?0¿≤KTo\rL9@#˜tu\«B0¿Äe•I)L9@ñ\œÚ<∏C0¿6uˇK9@l?\„\√D0¿ßu\‘~K9@Éà‘¥ãE0¿$%=≠J9@ö≤\”\ÍF0¿\næi˙\ÏH9@\‘\—q5≤G0¿0Ieä9H9@´x#Û\»G0¿≤^ÇSG9@â\n\’\Õ\≈G0¿	˘†g≥F9@8i\Z\ÕG0¿kÒ)\0F9@!∫ˆH0¿6ê.6≠D9@‰ªî∫dH0¿»òªñêC9@Ÿò\◊áH0¿Q§˚9A9@≤†0(\”H0¿EÚï@J@9@K\0˛)I0¿∫/g∂?9@Ñª≥v\€I0¿•t{I?9@í \\ÖJ0¿⁄®N≤>9@\0é={.K0¿‘õQÛ=9@rm®\ÁK0¿\·¥\‡E_=9@|}≠KçL0¿∂êˆ?<9@ c\ÓZBN0¿ﬁ∞mQf;9@◊Ñ¥∆†O0¿§ƒÆ\Ì\Ì:9@\0Æd\«FP0¿GÛÅ:9@OõsP0¿\»zjı\’99@e5]OtQ0¿Ö\Œk\Ï99@\ƒ%«ù\“Q0¿Q˙B\»y79@‹π0“ãR0¿$Di69@éègS0¿EùπáÑ39@\Î9\È}\„S0¿ïG7¬¢29@\Î8~T0¿L\∆1í=29@Ù1\ËT0¿ô*ï\‘19@É1\"QhU0¿Ü∆§ø/9@náÜ≈®W0¿\"Hõ*9@AúáòZ0¿øûØY.\'9@}˛Û[0¿ææ÷•&9@\Ó<0\\0¿\ ä;\ﬁ$9@≤dé\Â]]0¿74eß$9@≤b∏:\0^0¿©˙ïŒá#9@°jÙjÄ^0¿-B±4!9@w\ÿDf.`0¿_∂ù∂F 9@`V(\“˝`0¿ææ÷•F9@¯˛\Ì\’c0¿S\ k%t9@}w+Kd0¿2éë\Ï\Z9@ª}Vô)e0¿\√)sÛç9@\«.QΩ5h0¿\Œ8\rQÖ9@Ç¨ßV_i0¿í\Êèim9@GW\È\Ój0¿K<†l\ 9@ÑÄ|	l0¿Yk(µ9@Q\ﬁ\«\—m0¿6\È∂D.9@ÜV\'g(n0¿≥{Ú∞P9@LKo0¿\Èõ4\rä9@æ˙x\Ëªo0¿\ÎUdt@9@?åmp0¿\›\—ˇr-9@\Zi©ºq0¿\≈\⁄\«\n9@\ÌfF?\Zr0¿\Ô v¶\–9@í>≠r0¿Ü=\Ì\◊9@]\·].\‚s0¿≤h:;9@%\’?àt0¿-z®m9@MåJ\Ít0¿\Ê\"æ≥9@Ç¨ßV_u0¿\›\"0\÷79@\≈\≈Qπâv0¿ˆ\“N9@.»ñ\Â\Îv0¿Øó¶p\n9@{ıÒ\–ww0¿@\ﬂ,\’	9@ÔÆ≥!ˇx0¿É¬†L£	9@\Î¸\€eøz0¿™b*˝9@⁄Æ\–\À|0¿ésõpØ9@G≤Åt}0¿™}:39@dø\r1~0¿ªFÀÅ9@¥t€Ä0¿2\0«û9@40Ú≤&Ç0¿U\⁄\‚\Zü9@\·A≥\ÎﬁÇ0¿gÄ≤e9@\Í\œ~§àÑ0¿†Nyt#9@ïÅZ∫Ü0¿ç^\rP\Z9@ãˇ;¢Bâ0¿¸5Y£9@1xòˆÕâ0¿\ﬁ\ﬂ4}9@∫ÉÿôBã0¿Ec\Ì\Ôl9@Zú1\Ã	é0¿é\Ã#09@ü´≠\ÿ_é0¿a\√\”+e9@äæ¢[è0¿ı∏oµ9@fæÉüê0¿?»≤`\‚9@øò-ë0¿∏\Í:TS\n9@Yæ.\√í0¿\rU1ï~\n9@`?\ƒì0¿Ùå}\…\∆9@F\\\0\Z•ì0¿¥î,\'°9@–∂öu∆ì0¿∆®k\Ì}9@3®68ï0¿l\Ó\Ëπ9@&¸R?oñ0¿f2\œg9@Yøôò.ò0¿2kúM9@D¸√ñô0¿<üıf9@}≥Õç\Èô0¿/iå\÷Q9@Æg\«,õ0¿\ﬂ\Z\ÿ*¡9@§R\Ïhú0¿Üí…©ù9@‘∑\ÃÈ≤†0¿ÉÜ˛	.9@ù/ˆ^|©0¿¸ 9@õ!UØ™0¿èT\‚:9@\ ¡l´0¿ÙOp±¢\"9@\ﬁ:ˇvŸ´0¿&\„\…%9@\œL0úk¨0¿a•Çä™\'9@ôa£¨ﬂ¨0¿2\È\Ô•,9@û¥pY≠0¿√∂Eô\r.9@\ƒ\Î˙ª≠0¿\ƒxÕ´:/9@\Ï\ﬂıô≥Æ0¿*©\–D09@ö\Í\…¸£Ø0¿Ø\'∫.¸09@,)wü\„Ø0¿\re˝f29@\Â|±˜\‚Ø0¿=C8f\Ÿ39@\ÀÙKƒØ0¿ïÅZ∫69@\€2\‡,%Ø0¿†˚rf79@h\Á4¥Ø0¿\·DÙk\Î79@\»–±ÉJ∞0¿Öb\Ÿ\Ã99@NDø∂≤0¿;™ö \Í:9@#LQ.ç≥0¿ïÒ\Ô3.<9@)\Õ\Êq¥0¿fKVE∏=9@ù\’{L¥0¿âµ¯\0?9@\ﬁrıcì¥0¿˘ù&3\ﬁ>9@Ü\‚é7˘µ0¿7\·^ô∑>9@f1±˘∏∂0¿\’\Ê!S>9@Oê\ÿ\Ó∏0¿Ø\Ã[u>9@QhY˜èπ0¿\ÀJìR\–=9@\Ô\≈\ÌÒ∫0¿\0Sh=9@∂dUÑõº0¿]¿\À=9@i¸\¬+Iæ0¿¸™\\®¸;9@bÇ\ZæÖ¡0¿éèg;9@$0\‹\√0¿˘∫ˇ\È:9@\ﬁÊçì\¬\ƒ0¿x\–Ï∫∑:9@tïÓÆ≥\≈0¿π5\È∂D:9@ù,µ\ﬁo\»0¿\ZyYC9@\Ÿ>\‰-W\Î0¿ãåH\¬B9@\‰Gà\Ï0¿?6…è¯A9@Ç\„2n\Ó0¿\Œ\√	LßA9@\Ô≠HLP\Ô0¿§ãM+A9@\'jinÖ0¿1DN_\œ?9@ÜpÃ≤\'ı0¿Nò0öï19@ıI\Ó∞˝0¿C\Z8\Ÿ*9@L¬Ö<Ç˜0¿+æ°\Ÿ*9@Û-$`¯0¿¢DKO+9@£êdV\Ô¯0¿˚w}\Ê¨+9@\œ¯æ∏T˘0¿Z.ùÛ+9@√†L£\…˘0¿m\∆ià*,9@@¯P˙0¿\0tò//,9@hóo}X˚0¿\Á%\Ë/,9@é@ºÆ_¸0¿\ŸYL,9@√†L£\…˝0¿4ª\Ó≠H,9@Ω\·>rk˛0¿\«ÙÑ%,9@â)ëD/ˇ0¿P9&ã˚+9@Mªòf∫ˇ0¿:ñw\’*9@&´\"\‹d\01¿%\\\»#∏)9@/\›$Å1¿ç&c`)9@\œ˘.•1¿z\„§0\Ô)9@ÑF∞q˝1¿s-ZÄ∂)9@∫2®681¿\◊\‹\—ˇr)9@ç“•I1¿É0∫(9@\ƒxÕ´:1¿¸çv\‹\'9@\∆¨q6	1¿\Î\√z£V(9@\Õ\ÂC\n1¿\"R\”.¶)9@\≈7>[1¿Uiãk|*9@/˜\…QÄ1¿C7˚\Â*9@¨8\’Zò\r1¿\Ó˚Øs+9@aäri¸1¿z4’ì˘+9@®˝\÷Nî1¿¿ì.´,9@\Ã&¿∞¸1¿Dì7¿,9@íØRb1¿\Z¡\∆ı+9@∏#úº1¿\Œm¬Ω2+9@îK\„^1¿˚Y,E*9@1A\r\ﬂ\¬1¿ºñêz*9@PVW1¿wı**9@æÖu\„1¿\·(yué)9@å∫\÷ﬁß\Z1¿•iP4(9@ƒï≥wF1¿H7¬¢\"&9@F–òI\‘1¿á6\0%9@;V)=\”1¿\Ï\›\ÔU#9@g∑ñ\…p1¿ìr˜9>\"9@û\—V%ë1¿/Ü\»!9@°Müt1¿aQßì 9@˝ÉHÜ1¿ÜéT\‚9@™…ê1¿–öi9@â¥ç?Q!1¿\ PS\È9@\›\“jH\‹#1¿J~ƒØX9@—≠\◊Ù†$1¿Å#Åõ\Z9@_\Ì(\Œ%1¿˙~\‚\0\Z9@≤GW\È&1¿nﬂ£˛z9@Hâ]\€\'1¿êim\Z\€9@¥q\ƒZ|*1¿9\rQÖ?9@ÆÇ\Ë\⁄+1¿<\ÿb∑\œ9@wæü\Z/-1¿U¿=œü9@t\‘\—q5.1¿*9\'ˆ\–9@\œı}8H01¿-{ÿú9@ÛZ	\›%11¿¨©,\nª9@\‹ı\“21¿Föxx\Z9@:í\ÀH31¿IùÄ&\¬\Z9@\÷˝c!:41¿†Nyt#9@àÇS∞61¿xπà\Ô\ƒ9@ãmR\—X71¿\⁄r.\≈9@\ng∑ñ\…81¿\nÄÒ\Z9@≠àö\ËÛ91¿&äê∫ù9@ å∑ï^;1¿<0Ä°9@\Íx\Ã@e<1¿n\‡\‘)9@Ÿ≥\Á25=1¿t\Ï†\◊9@\Â\Ô\ﬁQc>1¿ÅZ¶9@\\\Àd8û?1¿ï\“3Ω\ƒ9@(∫.¸\‡@1¿˘á-=ö9@ÆÄB=A1¿¶}s9@\÷ãmRA1¿E∫üS9@7¸n∫A1¿q:\…Vó9@„äã£rC1¿Û<∏;k9@\ÃC¶|D1¿t\Ô\·í\„9@\Ó\Ã√πF1¿\œMõq\Z9@Zfä≠H1¿\‚≠Ûoó9@Rõ8π\ﬂI1¿°/Ω˝π9@3˘fõK1¿∂,_ó\·9@Øò\ﬁL1¿QàÄC®9@\Õôd\‰L1¿\Á´\‰cw\r9@¯ˇq¬ÑM1¿L™∂õ\‡9@ÉÜ˛	.N1¿Ç\‚«òª\n9@:=\Ô\∆N1¿|Vúj	9@IC´ìO1¿¢\”Ûn,9@∏\ÃÈ≤òP1¿≤g\œej9@ñ]0∏\ÊR1¿lîıõâ9@M¯•~\ﬁT1¿≥∂)9@æÖu\„U1¿˝,ú9@xõ7N\nW1¿p?\‡Å9@kúMGX1¿g{ÙÜ9@◊¢h[Y1¿Ü:¨p9@Òπ\ÏøZ1¿5¥;§9@íYΩ\√\Ì\\1¿e˚ê∑\\9@Û;Mfº]1¿ÜV\'g(9@¨;€§^1¿p\Ï\Ÿsô9@\ÃC¶|`1¿=_≥\\69@’Æ	iça1¿nÖ∞\ZK9@j‹õ\ﬂ0e1¿«É-v˚9@¶ùö\À\rf1¿ô*ï\‘9@)@Ãòf1¿(E+˜9@ëGp#eg1¿≤◊ª?\ﬁ9@rl=Ch1¿\…ëEö9@ˇ<\r$i1¿õ=\–\n	9@IH§m¸i1¿ÀÅj\€9@\·\riT\‡l1¿(\“˝úÇ9@\rƒ≤ôCn1¿˚\À\Ó\…9@ã•Hæp1¿\—\…R\Î˝9@õsÙp1¿MáNœª9@\…Àª\Íq1¿\"™gx9@&\≈\«\'ds1¿∞™^~ß9@√ù#Ωt1¿bÅØ\Ë\÷ˇ8@⁄®Nv1¿_\ÏΩ¯¢˝8@r \nfx1¿∏\È\œ~§¸8@±˙#z1¿^Mû≤ö˙8@ù/ˆ^|}1¿Oyt#,˙8@\’\È@\÷S1¿úi\¬ˆì˘8@≥%´\"‹Ä1¿Tt$óˇ¯8@o\ÎÑ1¿L\‡\÷\›¯8@a˝ü\√|Ö1¿.\ﬁs`˘8@ ¿\0¬á1¿ùı)\«d˘8@\n◊£p=ä1¿	O\Ëı\'˘8@è®åã1¿\–\÷¡¡\ﬁ¯8@π®≈å1¿≤∫\’sˆ8@Æd\«F é1¿éuq\rÙ8@®\≈\‡a⁄è1¿™\“\◊¯8@.è5#è1¿\Z3âz¡\Ô8@≠¶ÎâÆã1¿Éh≠hs\Ï8@\Èb\”Jç1¿D˘Ç\Ë8@Ù¬ù#ç1¿Äüq\·@\‰8@h\È\n∂ã1¿óg)Y\‚8@F\'K≠˜á1¿J_9\ﬂ8@\Î6®˝÷Ü1¿9∏t\Ãy\÷8@i\·≤\nõÖ1¿!Øì\‚\”8@óRóåcÑ1¿¸¶∞RA\—8@ù‘ó•ùÜ1¿OÂ¥ß\‰\Ã8@\–dˇ<\rà1¿ªÄó6\ 8@.\Â|±˜Ü1¿í≠.ß\»8@\Á˝ú0Ö1¿¸çv\‹\√8@≠€†ˆ[É1¿µß!™¿8@ºØ Ö É1¿\ﬂ\≈˚q˚Ω8@7P\‡ù|Ç1¿ÜvN≥@ª8@ˆ%∂Ä1¿Fè6é∏8@ %vmo1¿Û\Ã\Àa˜µ8@ë|%ê1¿)@Ãò≤8@X9¥\»~1¿\ÿb∑\œ*Ø8@˜\√c?1¿G\Ëg\Íu´8@;™ö \Í~1¿G\„\‡“•8@ë~˚:p~1¿{ÿúÉ£8@3•ı∑Ä1¿µ®Orá°8@\÷\∆\ÿ	É1¿´_\È|xû8@ä>eƒÖ1¿lA\Ôç!ú8@wÁ®£á1¿\\ív5ô8@?8ü:Vâ1¿ˆB€ï8@QÖ?√õâ1¿\€\€-\…ì8@\“o_Œâ1¿\«Hˆ5è8@-±2\Z˘à1¿q\‰Å\»\"ç8@ò\‹(≤Ü1¿\nMK â8@¡S»ïzÇ1¿5ñ∞6∆Ü8@êN]˘,É1¿\Ó	\€›É8@ºW≠LÑ1¿…≠I∑%Ç8@4ª\ÓÅ1¿\ÌE¥S8@.\∆¿:é1¿N	àI∏|8@~™\n\r\ƒ~1¿h±\…Wz8@\ÌS[\Í|1¿33333w8@¯\„ˆ\À\'{1¿f`Xr8@öï\ÌC\ﬁz1¿zåÚ\Ã\Àm8@´\Õˇ´z1¿	\ƒ\Î˙k8@˘ü¸\›;z1¿C:<ÑÒg8@?ß ?y1¿}$%=e8@#2¨\‚çx1¿@†3iSa8@Ç\∆L¢^x1¿8ákµá]8@%\"¸ã†y1¿\÷;\‹\r[8@Yæ.\√z1¿˝Ò\÷˘W8@\Ì}™\n\r|1¿à/EHU8@_ü;}1¿1≤dé\ÂQ8@ÑÚ>é\Ê|1¿kÛˇ™#O8@\‰Å\»\"M|1¿ïª\œÒ\—J8@\‰\…\Â{1¿\ËΩ\≈G8@Ct	|1¿\“\ZÉNE8@\n°É.\·|1¿ù∫ÚYB8@ zR&5|1¿Ìöê\÷@8@¶\',ÒÄz1¿\Ô˛xØZ=8@N{JŒây1¿Tè4∏≠98@F–∂öy1¿∏! _68@÷èMÚ#z1¿0†\Ó\\\08@_\Ì(ŒÖ1¿æP¿v0n7@H˚`≠¢1¿(ùH0\’l7@\Î\‡`ob†1¿g\‘|ï|l7@¸√ñMù1¿-C\Î\‚j7@ﬂâY/Üö1¿_—≠\◊h7@wN≥@ªó1¿6<ΩRñe7@s\◊ÚAó1¿7®˝\÷Nd7@\„¸Mî1¿îk\ndvb7@\È\◊\÷Oˇë1¿¡nÿ∂(_7@uYLl>í1¿\Ë-\ﬁs\\7@pï\'ví1¿;±O\0Y7@•£\Ã&ê1¿M1AGW7@É¬†L£ç1¿¨\∆\÷\∆@7@uX\·ä1¿jΩ\ﬂh\«=7@˚ ÀÇâã1¿sK´!q;7@ø	Qä1¿m¨\ƒ<+97@\ÌπLMÇá1¿≥\Ì¥5\"87@˘¿éˇÖ1¿ª{Ä\Ó\À57@K±£q®É1¿m\∆ià*47@Ø]\⁄pÄ1¿*1	27@b.©~1¿bJ$\—\À07@bûï¥\‚{1¿•I)\Ëˆ.7@\‰ºˇèz1¿∫ÿ¥R,7@\ÃC¶|x1¿®68˝&7@Zc\–	°w1¿ÈπÖÆD$7@HP¸w1¿@\‹’´$7@≤,ò¯s1¿AIÅ0!7@\Ó_YiRr1¿\∆2˝Ò7@â\–n1¿ßpz7@\ÕtØì˙j1¿$Ú]J]7@–öii1¿Ö∂úKq7@èãjQ`1¿GÆõR^7@\Ó\'c|òU1¿\’\È@\÷S7@yØZôW1¿˙+dÆ\n7@SweT1¿zè3M\ÿ7@\–Ï∫∑\"Q1¿íñ\ \€7@|VúN1¿\Ê\ŒL0ú7@\—öyrM1¿T\0åg\–\07@ôcyW=L1¿\Íë∑µ7@Œ•∏™\ÏG1¿º\…o\—\…˛6@\\ AÒcH1¿¥v€Ö\Ê˛6@O\Í\À\“NE1¿J\Îo	¿˜6@\Èõ4\räB1¿ÄJï({˜6@8gDi?1¿Y⁄©π\‹\Ë6@u\«bõT81¿\Ôê\⁄\ƒ\Â6@ò4F\Î®21¿-y<-?\‹6@≤Ú\À`å01¿¯o^ú¯\Œ6@åÙ¢vø*1¿‹Éê/\Õ6@\Œn-ì\·(1¿5^∫I\Œ6@	¡™z˘%1¿\\…éç@\Ã6@\Êï\Îm3!1¿}w+Kt\ 6@\œ\œ\Ÿ1¿¥≠fù\≈6@oÉ¿\ 1¿w¶(ó∫6@´Z\“Q1¿N\Ï°}¨º6@Ë£å∏\01¿{Cr2π6@ª(z\‡c1¿Ä\ràW∂6@ê0Xr	1¿ªô—èÜØ6@81$\'1¿v\ﬂ1<ˆ´6@Ç’∞\ﬂˇ0¿wR~R©6@\—Wêf,˛0¿\Ô´r°¶6@\Ó>\«Gã˚0¿(-\\Vaü6@3˙\—p\ Ù0¿€¶x\\Tõ6@(ôú\⁄\Ó0¿Ü;Fzô6@\‚\…nfÙ\Î0¿†7©0ñ6@πã0E\È0¿¸ î6@•t{I\Á0¿¡8∏tÃë6@⁄ë\Í;ø\‰0¿K=Byè6@æÉü8Ä\‚0¿>yX®5ç6@\¬¯i\‡0¿∞\‰*ã6@åÖ!r˙\ﬁ0¿ˆaΩQ+à6@mw†N\›0¿\Î:TSíÖ6@∂Ö\Á•b\€0¿4\Ÿ?OÇ6@£ï{ÅY\Ÿ0¿±\‹\“jHÄ6@\ÊZ¥\0m\◊0¿)yué}6@˘ÑÏºç\’0¿$\n-\Î˛}6@Nú\‹\ÔP\–0¿∞q˝ª>w6@WBwIú\Õ0¿µ4∑BXi6@\Ê\À∞èæ0¿ô)≠ø%\\6@¢{\÷5Z≤0¿b\◊ˆvKV6@\Ôí8+¢≤0¿\ÌÄµjW6@Ø\Ã[uÆ0¿o\rlï`U6@≥ñ\“˛´0¿W≥\Œ¯æP6@≥	0,™0¿\Ÿ]†§¿N6@\ﬁ\À}r§0¿\≈<+i\≈G6@Q/¯4\'ü0¿∑\nb†kC6@zç]¢zü0¿ò¿≠ªy>6@GêJ±£ô0¿6?˛“¢>6@/æhèñ0¿\»%é<<6@-&6◊í0¿_^Ä}t26@\Íñ\‚í0¿\—\Ëbg26@~\≈\Z.rè0¿≥%´.6@Fîˆ_å0¿sL˜)6@*˝Ñ≥[ã0¿Ú#~\≈\Z&6@U‹∏\≈¸Ñ0¿p≥x±0$6@íL\‡Ç0¿!ÆúΩ6@EÛ\0}0¿5\rä\Ê6@L\≈∆ºé|0¿\À+\◊\€f6@{3jæJz0¿Ä\◊g\Œ˙6@r4GV~u0¿\ng∑ñ\…6@vq\r\‡q0¿q«õ¸6@,Ù¡26p0¿_\ŒQ\Z6@æ\‹\'Gn0¿\÷V\Ï/ª6@GZ*oGh0¿\Ïﬁä\ƒ6@πn¿\Á_0¿ø\r1^6@\'¿∞¸˘Z0¿ª`p\Õ6@%Ã¥˝W0¿ôK™∂õ6@\ÌS[\ÍT0¿Di\‚6@v˘÷áıR0¿õ\Â≤\—96@¡:é*Q0¿Y¿n\›6@≤-\ŒRN0¿+L\ﬂk6@˛e˜\‰aM0¿ùú°∏\„	6@v˝Ç›∞I0¿Û¨§\ﬂ6@oüUfJG0¿|∏\‰∏S\n6@≠àö\ËÛE0¿\›ãä6@∑A\Ì∑vB0¿kπ36@ß≥ì¡QB0¿èQûy96@CV∑z>0¿\‚s\'\ÿ6@ºw‘ò;0¿Û\Á€Ç•˛5@≤ÇﬂÜ;0¿i™\'Ûè˛5@ºX\"ß70¿§Ö\À˙5@∑Eô\r250¿√ü\·\Õ\Z¯5@ü\È%\∆250¿\rnk\œ˜5@?èQûy10¿oˆ\ m˜5@ãpìQe\00¿&\≈\«\'d˜5@àI∏êG\0.¿\Ÿ	/¡©˜5@≠jIˇ+¿q\Ë-\ﬁ˜5@ïÒ\Ô3.l+¿gsÇ˙5@ÒÉÛ©cm+¿QN¥´ê˛5@àΩP¿vp+¿¯Q\r˚=6@≥\Ôä\‡s+¿At\Ì6@Jô\‘\–x+¿x\–6@Yß\ ˜å|+¿\’\Ì\Ï+\n6@u \Î©\’+¿ä¯¨6@£xïµMÅ+¿\Î∆ª#6@{†≤Ç+¿\'L\Õ\ 6@\œdÑ+¿ì:MÑ6@\r5\nIfÖ+¿åi¶{ù6@lµáΩPÄ+¿+\›]gC\"6@Ã∑>¨7Ç+¿\À/É1\"%6@\r¶a¯àà+¿Úaˆ≤\Ì(6@˙	g∑ñâ+¿\Ó˚Øs+6@5\'/2á+¿…´s\».6@}#∫g]É+¿@àd»±16@_\‘\ÓWÜ+¿êÑ};â46@˝KRôbÜ+¿^0∏\Êé66@¨™óﬂÅ+¿UÑõå*;6@\Ìõ˚´\«}+¿ˇë\È\–\È=6@ﬁêFN~+¿ûéíWC6@Wzm6VÇ+¿fÙ£\·îE6@\ÏàC6êÜ+¿7l[î\ŸH6@?ˇ=x\Ìä+¿n˚ı\◊K6@=∑–ïå+¿|c\0éM6@\"9ô∏Uê+¿m˝Ùü5O6@;TSíuò+¿\Ì\ÿ\ƒ\ÎR6@ıd˛\—7ô+¿\«\‘]\ŸW6@&6◊Üö+¿ZûwgY6@æü\Z/›ú+¿¢|A[6@Óµ†˜∆†+¿\'\ﬁû¥\\6@¥¶+¿tDæK©_6@*S\ÃA–©+¿\÷ˇ9Ãóc6@≤úÑ\“™+¿ke\¬/ıg6@êj\ÿÔâ≠+¿u\»\Õpj6@˙\ÃYü≤+¿∏¨\¬fÄk6@\⁄sôö∑+¿!\Â\'\’>m6@\Ô≠HLPª+¿Çoö>;p6@∏t\Ãy∆æ+¿Àùô`8s6@C ó8Ú¿+¿\Á™yé\»w6@tB\Ë†K¿+¿\€\√^(`{6@!\‰ºˇè\√+¿A,õ9$}6@ú\ƒ ∞r\»+¿A\Ôç!\0Ä6@ù‘ó•ù\ +¿$D˘ÇÇ6@\Îé\≈6©\–+¿†‹∂\ÔQÉ6@ÆG\·z\÷+¿\Œ7¢{÷Ö6@?˝gÕè\◊+¿ëöv1Õà6@j¿ \È\”\⁄+¿\ﬁt\ÀÒã6@YiR\n∫\›+¿¡nÿ∂(è6@!≠1\ËÑ\‡+¿KW∞çxí6@G¨≈ß\0\‡+¿êe¡\ƒï6@9{\⁄\·\ﬂ+¿\ÃDR∑ó6@P\Zjí\‰+¿$|\Ôo–ö6@	\≈V–¥\‰+¿èç@ºÆõ6@2\ÂCP5\Í+¿\Ë\‰g#ü6@ø∏T•-\Ê+¿\‚∂Ù†6@¿%\0ˇî\Í+¿Ze¶¥˛¢6@c\ÓZB>+¿è\√`˛\n•6@ß;O<gÛ+¿IÚ\\ﬂáß6@&U\€Mı+¿,πä≈ß6@\Àh\‰Ûäˇ+¿æ-X™´6@°L£\…\≈¯+¿^ü9\ÎS≤6@(†\ﬂ˜ˇ+¿#k$µ6@N`:≠\€\0,¿\ﬂm\ﬁ8)∏6@~ç$A\0,¿qxµ\‹¡6@\Í∞\¬-\Ÿ+¿\√§R\Ï\ƒ6@f2\œg\ÿ+¿ˆaΩQ+\»6@¯P¢%è\◊+¿Ùäßi\Ã6@p∞71$\◊+¿õî¢\Ÿ6@{ıÒ\–wø+¿x\–\ﬂ6@ÖñuˇX\»+¿¶a¯àò\‚6@4d<J%\Ã+¿?6…è¯\Â6@c`\«\œ+¿Zûwg\È6@1µ•Ú\“+¿øò-Y\Ì6@O\Î6®˝\÷+¿_~ß…å\Ô6@MáNœª\Ÿ+¿n\‡\‘)Û6@\'3\ﬁVz\›+¿z\¬(˜6@…≠I∑%\‚+¿$Äõ≈ã˘6@É5Œ¶#\Ë+¿\È|xñ ˚6@)_\–B\Ó+¿Ñ) •Ò˚6@\ﬁ\Â\"æÛ+¿°ÅX6s¸6@˛++MJ˘+¿∫ˆÙ\¬˝6@ºˇ+¿x\Ô®1!7@∑åı\r,¿µ\√_ì57@#Ω®›Ø,¿EˆAñ7@%\…s}˛+¿\€kA\Ôç\r7@x\—Wêf¸+¿¡6\‚\…n7@É\√\"R˚+¿Çè¡äS7@\Ó≤_w∫˚+¿X:û%7@,\÷pë{˙+¿\·¥\‡E_7@≤e˘∫ˇ+¿¯7hØ>\Z7@4Ü9Aõ,¿j˚WVö7@\n∫Ω§1\n,¿t^có®7@LnYk,¿Lé;•É!7@H5\Ï˜\ƒ,¿ a∞\‰&7@Ú|‘õ,¿˜êΩø)7@d]\‹F,¿Jy≠Ñ\Ó.7@Ù\ﬁÄ,¿â\ÓY\◊h17@˜>UÖ\n,¿\⁄À∂\”\÷47@MLbı,¿ˆ`R||67@Fx{,¿(\r5\n97@ˆ\Ô˙\ÃYˇ+¿∂ˆ>UÖ:7@úoD˜¨,¿ãS≠ÖY<7@ }ì¶A	,¿\·+Ÿ±=7@í;l\"3,¿˝ù,µ>7@!ìåúÖ,¿Ω˛$>w>7@x~QÇ˛\Z,¿πoµN\\>7@\‰J=B!,¿•M\’=≤=7@0ˆ^|\—&,¿y@Ÿî+<7@ï∑#ú,,¿\„§0\Ôq67@\Œ˛@πm?,¿’ó•ùö37@o\‘\n\”˜B,¿9\n327@Kë|%H,¿ö\–$±§07@6\È∂D.P,¿2rˆ¥/7@ÑÄ|	U,¿Òün†¿/7@$¥\Â\\ä[,¿\Í\Ã=$|37@®W\ 2\ƒY,¿˙B\»yˇ37@ˆ\–>VS,¿M\‹*àÅ67@#§ng_Q,¿oÚ[t≤87@\ËyíT,¿†Nyt#87@ü\"áàõ[,¿\–\ÓêbÄ87@óé9\œ`,¿$a\ﬂN\":7@˜u\‡úe,¿\„›ë±\⁄<7@\Ëj+ˆóe,¿ÖÏºç\Õ>7@4Jó˛%a,¿(µ\—v@7@\ ¸£o\“\\,¿@3à\ÏD7@\÷µ\¬Ù],¿òjf-H7@¸UÄ\Ô6_,¿ß>êºK7@Øó¶pZ,¿v¸L7@j\”L˜R,¿i®QH2O7@˘\Ÿ\»uS,¿¯ßTâR7@_	§ƒÆU,¿>\Õ…ãT7@\Z£uT5Q,¿\Ô´r°V7@™ùajKU,¿bº\ÊUY7@˚ı\◊+T,¿cc^G^7@G\Ã\ÏÛU,¿\”2R\Ô©`7@\“\¬e6S,¿Ä*n\‹bb7@H≈´¨M,¿ëπ2®6d7@L7âA`E,¿˚?á˘Úf7@ò¬Éf\◊=,¿nh\ N?h7@¥™%\Â8,¿}í;l\"k7@\Ó≥\ Li5,¿ìÜV\'o7@µß\‰ú\ÿ3,¿∫ıöt7@/6≠1,¿5*p≤\rx7@d<J%<1,¿e¸˚å{7@@£t\È_2,¿\¬\¬Iö?~7@ì®|ö3,¿óqSÉ7@U†Éá1,¿ÅŒ§M’Ö7@P@ø\Ô/,¿jMÛéSà7@\Ìõ˚´\«-,¿Sñ!éuâ7@æ˜7(,¿&7ä¨5å7@ø\'÷©Ú%,¿QàÄC®é7@±√òÙ˜\",¿_]®≈ê7@J+á,¿àÙ\€◊Åì7@HõV\Z,¿Ò°DKó7@9∏t\Ãy,¿\‹xò7@\Ã\–x\"à,¿\‰0òøBö7@V-≤ù,¿\ﬂm\ﬁ8ù7@2\„m•\◊,¿¶(ó∆ü7@Éˆ\Í\„°,¿ÒF\Êë?§7@f/\€,¿6uˇß7@ì©ÇQI\r,¿?\«Gã3™7@\€˜®ø^	,¿v\Zi©º≠7@4\ÿ\‘yT,¿;±O\0±7@,‘ö\Ê,¿rRò˜8≥7@\ÎR#Ù3\r,¿ÄD(bµ7@	√Ä%W,¿ªE`¨o∏7@=Y§â,¿Úñ´õº7@´≥Z`è	,¿xF[ïDæ7@,\r¸®Ü,¿`êÙi¡7@fº≠Ù\⁄¸+¿]oõ©\√7@™\…¯+¿líÒ+\∆7@	O\Ëı\'˘+¿åjQL\ 7@wı*˙+¿\'¡“®\Ã7@\€˚T\Z¯+¿EJ≥y\Œ7@ÙÂôóÛ+¿|ds\’<\œ7@\Ã\“N\Õ\Â\Ó+¿∂æHh\À\—7@\—6Æ\Ô+¿¿z‹∑Z\”7@s÷ßìı+¿`?\ƒ\”7@\¬i¡ãæ˙+¿5&\ƒ\\R\’7@!sePm\0,¿q™µ0\Ÿ7@bÅØ\Ë\÷,¿1\nÇ«∑\€7@∞\‰*ø,¿ÚxZ~\‡\ﬁ7@r˝ª>s˛+¿°1ì®\‡7@Î´´µ¯+¿?ˇ=x\Ì\‚7@o\◊KS¯+¿IÖ±Ö \Á7@\"rl=˚+¿û^)\À\Î7@á\Ÿ\Œ˜˚+¿\„\√\Ïe\Ô7@&\ƒ\\Rµ˝+¿Ò[z4Ò7@\n°É.\·¯+¿;åIÛ7@†˚rf˚+¿L\ﬁ\03\ﬂı7@`X˛|[\0,¿OWw,∂˘7@øõn\Ÿ,¿\ÿál ˝7@≠\¬fÄ,¿%Ø\Œ1\08@¡\„\€,¿4.\…8@™ÇQIù\0,¿|\Ôo\–^8@\œ\‹C\¬˜˛+¿\≈oÚ[8@2:=\Ô˛+¿tó\ƒY	8@é¯+¿Ò∑=Ab8@\Á\·¶\”Ú+¿ówJ8@£w*\‡û\Ô+¿]\‹Fx8@©h¨˝ùı+¿`\«Å 8@u\ËÙº˚+¿âõS\…\08@©\ﬁ\Z\ÿ*˘+¿ú4\rä\Ê8@>Y1\\+¿1a4+\€8@xœÅ\Â\È+¿*ènÑE8@t}\‚+¿Dà+g8@˜_òL\Â+¿Ø[\∆˙\Z8@\◊\‹\—ˇ\Í+¿\÷\ƒ_\—8@\Œ\‡\Ô≥\Ì+¿Ä,Dá¿!8@\"\‚\ÊT2+¿\÷5ZÙ$8@É0∫\Ï+¿\Ã^∂ù∂&8@\n\⁄\‰I\Á+¿§™	¢\Ó\'8@ïÑ^\‚+¿n£º*8@VÅZ\ﬁ+¿˘£®3˜,8@ê\ÂZ\‡+¿h\Íuã¿08@\Z8\Ÿ\ﬁ+¿Æ-</38@\ ¥êÄ\Ÿ+¿\‚\ \Ÿ;£58@ò•ùö\À\’+¿!\‰K®88@Œâ=¥è\’+¿\Z˘º\‚©;8@\ÀGR\“\√\–+¿kEõ\„\‹>8@ƒ¨C\—+¿dì¸à_=8@\nö]˜\÷+¿∫Ω§1ZC8@p¥\„Ü\ﬂ\’+¿\⁄V≥\ŒD8@∞´\…SV\€+¿¢{\÷5ZF8@;q9^Å\‡+¿\‰ºˇèJ8@\'g(\Óx\„+¿Ø≤∂)N8@Äcœû\„+¿\“\ZÉNQ8@\ƒÕ©d\0\‡+¿ë(¥¨˚O8@j¿ \È\”\⁄+¿\“mâ\\pN8@\‡d∏\’+¿\œf\’\ÁjO8@-`∑\Ó\Œ+¿<KêPQ8@Zπò\ +¿’íér0S8@~bº\Ê\Õ+¿J\‘>\ÕU8@m´Yg|\œ+¿`ù∫V8@:œÑ&\Ÿ+¿z»îAU8@kbÅØ\Ë\ﬁ+¿|¥8còW8@y\r˝\‰+¿8hØ>Z8@•ÙL/1\Ê+¿L\‡\÷\›\\8@¸Q‘ô{\Ë+¿∏Ö\ÎQ`8@k$	\Í+¿q:\…Vc8@ta§µ\Î+¿}\\*\∆e8@=c_≤Ò\Ë+¿≠jIG9h8@¸6\ƒx\Â+¿\ﬁ\»<Úk8@%Æc\\q\È+¿wL›ï]l8@7\„4D\Ó+¿\ÿJ\Ë.âo8@Ü9Aõ\Ó+¿:\Ëq8@\"\„Q*\·\È+¿GUD\›s8@jK\‰ı\Ë+¿(÷©Ú=w8@\Ï@1≤\Ï+¿ê¡äS≠y8@!:é\Í+¿<Ö\\©{8@\‡i2\„m\Â+¿Ø`Òd{8@\"ƒï≥w\ﬁ+¿\”\ÿ^z8@\÷;\‹\r\”+¿Ø\ÎÏÜÅ8@«úg\ÏK\÷+¿Ù©cï“É8@;oc≥#\›+¿d\Êó«Ü8@\’\–`\‚+¿36t≥?à8@Ó∞â\Ã\\\Ë+¿®\ƒuå+ä8@~7›≤C\Ï+¿’ì˘Gﬂå8@°l\\ˇ\Ó+¿•h\Â^ê8@»óP¡Ò+¿\ `\Ê;ê8@¬Ñ—¨l˜+¿G\Êë?î8@¿±g\œı+¿’±JÈôñ8@\Î9\È}\„˚+¿¨\·\"˜tô8@\√ç\'Ç¯+¿º\Õ\'Öô8@GZ*oG+¿lìä\∆⁄ó8@:\ÎSé\…\Í+¿u\0\ƒ]Ωö8@∑e•I\È+¿ùÚ\ËFXú8@\¬\¬Iö?\Ó+¿eçzàFü8@\—`\"\Ï+¿øªï%:ü8@\ƒ\·\—\∆Ò+¿¿u≈åû8@EKO\À˜+¿âõS\…\0†8@≠C9\—˛+¿\ÌHıù_§8@;é*ç\0,¿',1607362055,1607362055,NULL,NULL);
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `right_to_role`
--

DROP TABLE IF EXISTS `right_to_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `right_to_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` int NOT NULL,
  `right` text,
  `active` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_right_to_role_1_idx` (`role`),
  CONSTRAINT `fk_right_to_role_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1865 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `right_to_role`
--

LOCK TABLES `right_to_role` WRITE;
/*!40000 ALTER TABLE `right_to_role` DISABLE KEYS */;
INSERT INTO `right_to_role` VALUES (608,4,'View Users',1),(1284,5,'View Roles',1),(1293,10,'Manage Users',1),(1294,10,'Manage Roles',1),(1295,10,'View Roles',1),(1296,10,'View Users',1),(1785,3,'View profile',1),(1786,3,'Collect commodity prices',1),(1787,3,'View commodity prices',1),(1788,3,'Submit story of change',1),(1789,3,'Manage faabs groups',1),(1790,3,'View faabs groups',1),(1791,3,'Remove faabs groups',1),(1792,3,'Manage category A farmers',1),(1793,3,'View category A farmers',1),(1794,3,'Remove category A farmers',1),(1795,3,'Submit FaaBS training records',1),(1796,3,'View FaaBS training records',1),(1797,3,'Remove FaaBS training records',1),(1798,3,'Submit back to office report',1),(1799,3,'Plan camp monthly activities',1),(1800,3,'Remove planned camp monthly activities',1),(1801,3,'View facilitation of improved technologies/best practices report',1),(1802,3,'View training attendance cumulative report',1),(1803,3,'Submit project outreach records',1),(1804,3,'Remove project outreach records',1),(1805,3,'View project outreach reports',1),(1806,3,'Submit timesheets',1),(1807,1,'Manage Users',1),(1808,1,'View Users',1),(1809,1,'Manage Roles',1),(1810,1,'View Roles',1),(1811,1,'View profile',1),(1812,1,'View audit trail logs',1),(1813,1,'Manage provinces',1),(1814,1,'Manage districts',1),(1815,1,'Manage camps',1),(1816,1,'Remove provinces',1),(1817,1,'Remove districts',1),(1818,1,'Remove camps',1),(1819,1,'Manage markets',1),(1820,1,'Remove markets',1),(1821,1,'Manage commodity configs',1),(1822,1,'Remove commodity config',1),(1823,1,'View commodity prices',1),(1824,1,'Remove commodity price',1),(1825,1,'Manage interview guide template questions',1),(1826,1,'View interview guide template',1),(1827,1,'Remove interview guide template question',1),(1828,1,'Manage story of change categories',1),(1829,1,'Review Story of change',1),(1830,1,'Attach case study articles',1),(1831,1,'Manage faabs groups',1),(1832,1,'View faabs groups',1),(1833,1,'View category A farmers',1),(1834,1,'View FaaBS training records',1),(1835,1,'Review back to office report',1),(1836,1,'Manage FaaBS training topics',1),(1837,1,'View FaaBS training topics',1),(1838,1,'Remove FaaBS training topics',1),(1839,1,'View facilitation of improved technologies/best practices report',1),(1840,1,'View training attendance cumulative report',1),(1841,1,'View physical tracking table report',1),(1842,1,'View programmes',1),(1843,1,'Manage AWPB activities',1),(1844,1,'View AWPB activities',1),(1845,1,'Manage components',1),(1846,1,'View components',1),(1847,1,'Manage AWPB templates',1),(1848,1,'View AWPB templates',1),(1849,1,'View AWPB activity lines',1),(1850,1,'Manage AWPB activity lines',1),(1851,1,'Submit District AWPB',1),(1852,1,'Approve AWPB - Provincial',1),(1853,1,'Submit programme-wide AWPB',1),(1854,1,'Manage province consolidated AWPB',1),(1855,1,'Approve AWPB - PCO',1),(1856,1,'Manage AWPB funders',1),(1857,1,'Setup AWPB',1),(1858,1,'Approve AWPB - Ministry',1),(1859,1,'Manage programme-wide AWPB',1),(1860,1,'View PW AWPB',1),(1861,1,'View MGF module',1),(1862,1,'View MGF Concept Note',1),(1863,1,'Manage staff hourly rates',1),(1864,1,'Review timesheets',1);
/*!40000 ALTER TABLE `right_to_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` text NOT NULL,
  `active` int DEFAULT '1',
  `created_at` int unsigned DEFAULT NULL,
  `updated_at` int unsigned DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator',1,1222,1603902498,1,1),(3,'User',1,1603902583,1603902583,1,1),(4,'test',1,1614068089,1614068089,1,1),(5,'Test 2',1,1619185146,1619185146,1,1),(10,'Admin',1,1621730405,1621730405,NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `other_name` varchar(255) DEFAULT '',
  `title` varchar(10) DEFAULT '',
  `sex` varchar(7) DEFAULT 'Male',
  `phone` varchar(45) DEFAULT NULL,
  `nrc` varchar(45) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `status` smallint NOT NULL DEFAULT '10',
  `auth_key` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `password_reset_token` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `camp_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `type_of_user` varchar(45) DEFAULT 'Other user' COMMENT 'Type of user different from role. This is there to ammodate users that belong to camps, districts or province\nAvailable types {Camp user, District user, Provincial user, Other user}',
  PRIMARY KEY (`id`),
  KEY `fk_users_1_idx` (`role`),
  KEY `fk_users_2_idx` (`camp_id`),
  KEY `fk_users_3_idx` (`district_id`),
  KEY `fk_users_4_idx` (`province_id`),
  CONSTRAINT `fk_users_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Francis','Chulu','','Mr.','Male','+260978981234','123454/21/23','chulu1francis@gmail.com','chulu1francis@gmail.com',1,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','-GDPDTEgVpbCySh94TqY4hRrma_XkSty_1616662153',NULL,0,0,0,1,NULL,11,1616662153,'Other user'),(5,3,'Chulu','Francis','','Mr.','Male','+260978981345','123454/21/23','francis.chulu@unza.zm','francis.chulu@unza.zm',1,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO',NULL,NULL,NULL,NULL,NULL,1,1,1604659275,1604660233,'Other user'),(6,1,'test','Test','','','Male','','','francis.chulu1@unza.zm','francis.chulu@unza.zm',2,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','LZ-pePN17FJB7Mg1CtyYyRsNH5tohaz6_1607174006',NULL,NULL,NULL,NULL,1,1,1607174006,1607174024,'Other user'),(9,3,'Test','Test','','Mr.','Female','','','test@unza.zm','chulu1francis@gmail.com',1,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','PF4j04-lRuOClA4gXY-oTX_95V6Ap-2-_1607181915',NULL,0,0,0,1,1,1607181915,1607186786,'Other user'),(10,3,'test','Test','','Mr.','Female','','','test1@unza.zm','francis.chulu@unza.zm',1,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','VlfAXnPz_XY_5s6E7x2Qi_SpPhIEl9I0_1607181970',NULL,NULL,2,1,1,1,1607181970,1616772648,'District user'),(11,3,'test','Test 3','','Mr.','Male','','','test2@unza.zm','francis.chulu@unza.zm',0,'gB_PJTElMSxW^IfiNmpYT^7qva3?Hy:a','$2y$13$/igl4SBKySwX9QQc352pKef5YX6gRSI8nx/8vkTvyD0RYNDXIjIvO','pFOgJWyUKdULYoTNxXctPhB4CEv8LpzB_1607182013',NULL,NULL,NULL,1,1,1,1607182013,1614016783,'Provincial user'),(14,10,'Please','me','delete','','Male',NULL,NULL,'admin@emis.com','admin@emis.com',1,'CpmiIyoNtGGkHX0meoIJU7sGcRqQcXm5','$2y$13$AYj8JnzR1i0DDTQ5OYerHek8g5.Ch9ZrKjpg4ZJtAchchVGwVIWhy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1621730406,1621730406,'Other user');
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

-- Dump completed on 2021-08-05 13:31:54
