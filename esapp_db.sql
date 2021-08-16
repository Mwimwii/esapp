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
  `district` int DEFAULT NULL,
  `province` int DEFAULT NULL,
  `approved_at` date DEFAULT NULL,
  `approved_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activity_time_sheets_district_staff_1_idx` (`rate_id`),
  CONSTRAINT `fk_activity_time_sheets_district_staff_1` FOREIGN KEY (`rate_id`) REFERENCES `conf_hourly_rates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_activity`
--

DROP TABLE IF EXISTS `awpb_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_code` varchar(10) NOT NULL,
  `parent_activity_id` int DEFAULT NULL,
  `component_id` int NOT NULL,
  `outcome_id` int DEFAULT NULL,
  `output_id` int DEFAULT NULL,
  `commodity_type_id` int unsigned DEFAULT NULL,
  `type` int NOT NULL COMMENT '0 Main activity, 1 Subactivity',
  `activity_type` varchar(255) DEFAULT NULL,
  `awpb_template_id` int DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit_of_measure_id` int DEFAULT NULL,
  `programme_target` double DEFAULT NULL,
  `cumulative_planned` double NOT NULL,
  `cumulative_actual` double NOT NULL,
  `indicator_id` int DEFAULT NULL,
  `funder_id` int DEFAULT NULL,
  `gl_account_code` varchar(4) DEFAULT NULL,
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
  UNIQUE KEY `description` (`description`),
  UNIQUE KEY `name` (`name`),
  KEY `component_id` (`component_id`),
  KEY `expense_category_id` (`expense_category_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `unit_of_measure_id` (`unit_of_measure_id`),
  KEY `activity_code` (`activity_code`) USING BTREE,
  KEY `funder_id` (`funder_id`),
  KEY `indicator_id` (`indicator_id`),
  KEY `outcome_id` (`outcome_id`),
  KEY `output_id` (`output_id`),
  KEY `commodity_id` (`commodity_type_id`),
  CONSTRAINT `awpb_activity_ibfk_1` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`),
  CONSTRAINT `awpb_activity_ibfk_2` FOREIGN KEY (`expense_category_id`) REFERENCES `awpb_expense_category` (`id`),
  CONSTRAINT `awpb_activity_ibfk_3` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_activity_ibfk_4` FOREIGN KEY (`unit_of_measure_id`) REFERENCES `awpb_unit_of_measure` (`id`),
  CONSTRAINT `awpb_activity_ibfk_5` FOREIGN KEY (`funder_id`) REFERENCES `awpb_funder` (`id`),
  CONSTRAINT `awpb_activity_ibfk_6` FOREIGN KEY (`indicator_id`) REFERENCES `awpb_indicator` (`id`),
  CONSTRAINT `awpb_activity_ibfk_7` FOREIGN KEY (`outcome_id`) REFERENCES `awpb_outcome` (`id`),
  CONSTRAINT `awpb_activity_ibfk_8` FOREIGN KEY (`output_id`) REFERENCES `awpb_output` (`id`),
  CONSTRAINT `awpb_activity_ibfk_9` FOREIGN KEY (`commodity_type_id`) REFERENCES `awpb_commodity_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  KEY `activity_id` (`activity_id`),
  KEY `funder_id` (`funder_id`),
  CONSTRAINT `awpb_activity_funder_ibfk_1` FOREIGN KEY (`funder_id`) REFERENCES `awpb_funder` (`id`),
  CONSTRAINT `awpb_activity_funder_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_activity_line`
--

DROP TABLE IF EXISTS `awpb_activity_line`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_activity_line` (
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
  `status` int NOT NULL,
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
  CONSTRAINT `awpb_activity_line_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`),
  CONSTRAINT `awpb_activity_line_ibfk_4` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_activity_line_ibfk_5` FOREIGN KEY (`indicator_id`) REFERENCES `awpb_indicator` (`id`),
  CONSTRAINT `awpb_activity_line_ibfk_6` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`),
  CONSTRAINT `awpb_activity_line_ibfk_7` FOREIGN KEY (`output_id`) REFERENCES `awpb_output` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_actual_input`
--

DROP TABLE IF EXISTS `awpb_actual_input`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_actual_input` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component_id` int NOT NULL,
  `output_id` int DEFAULT NULL,
  `activity_id` int NOT NULL,
  `awpb_template_id` int NOT NULL,
  `indicator_id` int DEFAULT NULL,
  `budget_id` int NOT NULL,
  `input_id` int DEFAULT NULL,
  `quarter_number` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_of_measure_id` int DEFAULT NULL,
  `unit_cost` double NOT NULL,
  `mo_1` double DEFAULT NULL,
  `mo_2` double DEFAULT NULL,
  `mo_3` double DEFAULT NULL,
  `quarter_quantity` double DEFAULT NULL,
  `quarter_amount` double DEFAULT NULL,
  `mo_1_amount` double DEFAULT NULL,
  `mo_2_amount` double DEFAULT NULL,
  `mo_3_amount` double DEFAULT NULL,
  `mo_1_actual` double DEFAULT NULL,
  `mo_2_actual` double DEFAULT NULL,
  `mo_3_actual` double DEFAULT NULL,
  `status` int NOT NULL,
  `cost_centre_id` int unsigned DEFAULT NULL,
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
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `awpb_actual_input_ibfk_1` (`budget_id`),
  KEY `camp_id` (`camp_id`),
  KEY `cost_centre_id` (`cost_centre_id`),
  KEY `component_id` (`component_id`),
  KEY `output_id` (`output_id`),
  CONSTRAINT `awpb_actual_input_ibfk_1` FOREIGN KEY (`budget_id`) REFERENCES `awpb_budget` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_10` FOREIGN KEY (`cost_centre_id`) REFERENCES `awpb_cost_centre` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_11` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_12` FOREIGN KEY (`output_id`) REFERENCES `awpb_output` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_2` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_4` FOREIGN KEY (`indicator_id`) REFERENCES `awpb_indicator` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_5` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_6` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_7` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_8` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `awpb_actual_input_ibfk_9` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_budget`
--

DROP TABLE IF EXISTS `awpb_budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_budget` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component_id` int NOT NULL,
  `output_id` int DEFAULT NULL,
  `activity_id` int NOT NULL,
  `awpb_template_id` int NOT NULL,
  `indicator_id` int DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` int NOT NULL,
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
  `mo_1_actual_amount` double DEFAULT NULL,
  `mo_2_actual_amount` double DEFAULT NULL,
  `mo_3_actual_amount` double DEFAULT NULL,
  `mo_4_actual_amount` double DEFAULT NULL,
  `mo_5_actual_amount` double DEFAULT NULL,
  `mo_6_actual_amount` double DEFAULT NULL,
  `mo_7_actual_amount` double DEFAULT NULL,
  `mo_8_actual_amount` double DEFAULT NULL,
  `mo_9_actual_amount` double DEFAULT NULL,
  `mo_10_actual_amount` double DEFAULT NULL,
  `mo_11_actual_amount` double DEFAULT NULL,
  `mo_12_actual_amount` double DEFAULT NULL,
  `quarter_one_actual_amount` double DEFAULT NULL,
  `quarter_two_actual_amount` double DEFAULT NULL,
  `quarter_three_actual_amount` double DEFAULT NULL,
  `quarter_four_actual_amount` double DEFAULT NULL,
  `total_actual_amount` double DEFAULT NULL,
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
  `cost_centre_id` int unsigned DEFAULT NULL,
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
  KEY `cost_centre_id` (`cost_centre_id`),
  CONSTRAINT `awpb_budget_ibfk_1` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_budget_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`),
  CONSTRAINT `awpb_budget_ibfk_3` FOREIGN KEY (`output_id`) REFERENCES `awpb_output` (`id`),
  CONSTRAINT `awpb_budget_ibfk_4` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`),
  CONSTRAINT `awpb_budget_ibfk_5` FOREIGN KEY (`indicator_id`) REFERENCES `awpb_indicator` (`id`),
  CONSTRAINT `awpb_budget_ibfk_6` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `awpb_budget_ibfk_7` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `awpb_budget_ibfk_8` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`),
  CONSTRAINT `awpb_budget_ibfk_9` FOREIGN KEY (`cost_centre_id`) REFERENCES `awpb_cost_centre` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `description` text NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=323 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_commodity_type`
--

DROP TABLE IF EXISTS `awpb_commodity_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_commodity_type` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commodity_type_1_idx` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_component`
--

DROP TABLE IF EXISTS `awpb_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_component` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `parent_component_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `outcome` text,
  `output` text,
  `type` int NOT NULL DEFAULT '0' COMMENT '0 Main component, 1 Subcomponent,',
  `access_level` int DEFAULT '0' COMMENT '0 All.1 District, 2 Programme,',
  `subcomponent` varchar(255) DEFAULT NULL,
  `funder_id` int DEFAULT NULL,
  `expense_category_id` int DEFAULT NULL,
  `gl_account_code` varchar(4) DEFAULT NULL,
  `access_level_district` int DEFAULT NULL,
  `access_level_province` int DEFAULT NULL,
  `access_level_programme` int DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `component_code` (`code`),
  UNIQUE KEY `component_description` (`name`),
  UNIQUE KEY `description` (`description`),
  KEY `parent_component_id` (`parent_component_id`),
  KEY `expense_category_id` (`expense_category_id`),
  KEY `funder_id` (`funder_id`),
  CONSTRAINT `awpb_component_ibfk_1` FOREIGN KEY (`expense_category_id`) REFERENCES `awpb_expense_category` (`id`),
  CONSTRAINT `awpb_component_ibfk_2` FOREIGN KEY (`funder_id`) REFERENCES `awpb_funder` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_cost_centre`
--

DROP TABLE IF EXISTS `awpb_cost_centre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_cost_centre` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_district`
--

DROP TABLE IF EXISTS `awpb_district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_district` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `awpb_template_id` int NOT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `cost_centre_id` int unsigned DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` int NOT NULL,
  `funds_request` int DEFAULT '0',
  `status_q_1` int DEFAULT '0',
  `status_q_2` int DEFAULT '0',
  `status_q_3` int DEFAULT '0',
  `status_q_4` int DEFAULT '0',
  `quarter_one_amount` double DEFAULT NULL,
  `quarter_two_amount` double DEFAULT NULL,
  `quarter_three_amount` double DEFAULT NULL,
  `quarter_four_amount` double DEFAULT NULL,
  `quarter_one_actual` double DEFAULT NULL,
  `quarter_two_actual` double DEFAULT NULL,
  `quarter_three_actual` double DEFAULT NULL,
  `quarter_four_actual` double DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `cost_centre_id` (`cost_centre_id`),
  KEY `province_id` (`province_id`),
  KEY `district_id` (`district_id`),
  CONSTRAINT `awpb_district_ibfk_1` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_district_ibfk_2` FOREIGN KEY (`cost_centre_id`) REFERENCES `awpb_cost_centre` (`id`),
  CONSTRAINT `awpb_district_ibfk_3` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `awpb_district_ibfk_4` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_expense_category`
--

DROP TABLE IF EXISTS `awpb_expense_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_expense_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `status` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_funder`
--

DROP TABLE IF EXISTS `awpb_funder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_funder` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_funding_type`
--

DROP TABLE IF EXISTS `awpb_funding_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_funding_type` (
  `id` int NOT NULL,
  `funding_type_code` varchar(6) NOT NULL,
  `funding_type_name` varchar(255) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `funding_type_code` (`funding_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_funds_requisition`
--

DROP TABLE IF EXISTS `awpb_funds_requisition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_funds_requisition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component_id` int DEFAULT NULL,
  `output_id` int DEFAULT NULL,
  `activity_id` int DEFAULT NULL,
  `awpb_template_id` int NOT NULL,
  `indicator_id` int DEFAULT NULL,
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
  `cost_centre_id` int unsigned DEFAULT NULL,
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
  KEY `cost_centre_id` (`cost_centre_id`),
  CONSTRAINT `awpb_funds_requisition_ibfk_1` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_funds_requisition_ibfk_2` FOREIGN KEY (`cost_centre_id`) REFERENCES `awpb_cost_centre` (`id`),
  CONSTRAINT `awpb_funds_requisition_ibfk_3` FOREIGN KEY (`district_id`) REFERENCES `awpb_district` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_general_ledger`
--

DROP TABLE IF EXISTS `awpb_general_ledger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_general_ledger` (
  `id` int NOT NULL AUTO_INCREMENT,
  `general_ledger_account` varchar(20) NOT NULL,
  `activity_id` int NOT NULL,
  `component_id` int NOT NULL,
  `awpb_template_id` int NOT NULL,
  `funder_id` int NOT NULL,
  `expense_category_id` int NOT NULL,
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
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `component_id` (`component_id`),
  KEY `expense_category_id` (`expense_category_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `activity_code` (`activity_id`) USING BTREE,
  KEY `funder_id` (`funder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unit_of_measure_id` int NOT NULL,
  `programme_target` double NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awpb_indicator_ibfk_2` (`unit_of_measure_id`),
  KEY `activity_id` (`activity_id`),
  KEY `component_id` (`component_id`),
  KEY `output_id` (`output_id`),
  CONSTRAINT `awpb_indicator_ibfk_2` FOREIGN KEY (`unit_of_measure_id`) REFERENCES `awpb_unit_of_measure` (`id`),
  CONSTRAINT `awpb_indicator_ibfk_4` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_input`
--

DROP TABLE IF EXISTS `awpb_input`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_input` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component_id` int NOT NULL,
  `output_id` int DEFAULT NULL,
  `activity_id` int NOT NULL,
  `awpb_template_id` int NOT NULL,
  `indicator_id` int DEFAULT NULL,
  `budget_id` int NOT NULL,
  `input_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `unit_of_measure_id` int DEFAULT NULL,
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
  `cost_centre_id` int unsigned DEFAULT NULL,
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
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `awpb_input_ibfk_1` (`budget_id`),
  KEY `camp_id` (`camp_id`),
  KEY `cost_centre_id` (`cost_centre_id`),
  KEY `component_id` (`component_id`),
  KEY `output_id` (`output_id`),
  CONSTRAINT `awpb_input_ibfk_1` FOREIGN KEY (`budget_id`) REFERENCES `awpb_budget` (`id`),
  CONSTRAINT `awpb_input_ibfk_10` FOREIGN KEY (`cost_centre_id`) REFERENCES `awpb_cost_centre` (`id`),
  CONSTRAINT `awpb_input_ibfk_11` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`),
  CONSTRAINT `awpb_input_ibfk_12` FOREIGN KEY (`output_id`) REFERENCES `awpb_output` (`id`),
  CONSTRAINT `awpb_input_ibfk_2` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_input_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`),
  CONSTRAINT `awpb_input_ibfk_4` FOREIGN KEY (`indicator_id`) REFERENCES `awpb_indicator` (`id`),
  CONSTRAINT `awpb_input_ibfk_5` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `awpb_input_ibfk_6` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `awpb_input_ibfk_7` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `awpb_input_ibfk_8` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `awpb_input_ibfk_9` FOREIGN KEY (`camp_id`) REFERENCES `camp` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_outcome`
--

DROP TABLE IF EXISTS `awpb_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_outcome` (
  `id` int NOT NULL AUTO_INCREMENT,
  `outcome_code` varchar(10) NOT NULL,
  `component_id` int DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  `outcome_description` varchar(255) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `outcome_code` (`outcome_code`),
  KEY `component_id` (`component_id`),
  CONSTRAINT `awpb_outcome_ibfk_1` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_output`
--

DROP TABLE IF EXISTS `awpb_output`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_output` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `component_id` int NOT NULL,
  `outcome_id` int DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `outcome_id` (`outcome_id`),
  KEY `component_id` (`component_id`),
  CONSTRAINT `awpb_output_ibfk_1` FOREIGN KEY (`outcome_id`) REFERENCES `awpb_outcome` (`id`),
  CONSTRAINT `awpb_output_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_province`
--

DROP TABLE IF EXISTS `awpb_province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_province` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `awpb_template_id` int NOT NULL,
  `cost_centre_id` int unsigned DEFAULT NULL,
  `province_id` int unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `cost_centre_id` (`cost_centre_id`),
  KEY `province_id` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_status`
--

DROP TABLE IF EXISTS `awpb_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `awpb_template_id` int NOT NULL,
  `status` int NOT NULL,
  `cost_centre_id` int unsigned DEFAULT NULL,
  `camp_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `district_id` (`district_id`),
  KEY `province_id` (`province_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `camp_id` (`camp_id`),
  KEY `cost_centre_id` (`cost_centre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_template`
--

DROP TABLE IF EXISTS `awpb_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_template` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fiscal_year` int NOT NULL,
  `budget_theme` text NOT NULL,
  `comment` text NOT NULL,
  `guideline_file` varchar(255) DEFAULT NULL,
  `status` int NOT NULL COMMENT '0 Closed, 1 open, 2 Blocked, 4 current',
  `quarter` int DEFAULT NULL,
  `status_activities` int DEFAULT NULL,
  `status_users` int DEFAULT NULL,
  `status_district` int DEFAULT NULL,
  `preparation_deadline_first_draft` date NOT NULL,
  `submission_deadline` date NOT NULL,
  `consolidation_deadline` date NOT NULL,
  `review_deadline` date NOT NULL,
  `preparation_deadline_second_draft` date NOT NULL,
  `review_deadline_pco` date NOT NULL,
  `finalisation_deadline_pco` date NOT NULL,
  `submission_deadline_moa_mfl` date NOT NULL,
  `approval_deadline_jpsc` date NOT NULL,
  `incorpation_deadline_pco_moa_mfl` date NOT NULL,
  `submission_deadline_ifad` date NOT NULL,
  `comment_deadline_ifad` date NOT NULL,
  `distribution_deadline` date NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fiscal_year` (`fiscal_year`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_template_activity`
--

DROP TABLE IF EXISTS `awpb_template_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_template_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_id` int NOT NULL,
  `activity_code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `component_id` int DEFAULT NULL,
  `outcome_id` int DEFAULT NULL,
  `output_id` int DEFAULT NULL,
  `awpb_template_id` int NOT NULL,
  `funder_id` int DEFAULT NULL,
  `expense_category_id` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `ifad` double DEFAULT NULL,
  `ifad_grant` double DEFAULT NULL,
  `grz` double DEFAULT NULL,
  `beneficiaries` double DEFAULT NULL,
  `private_sector` double DEFAULT NULL,
  `iapri` double DEFAULT NULL,
  `parm` double DEFAULT NULL,
  `ifad_amount` double DEFAULT NULL,
  `ifad_grant_amount` double DEFAULT NULL,
  `grz_amount` double DEFAULT NULL,
  `beneficiaries_amount` double DEFAULT NULL,
  `private_sector_amount` double DEFAULT NULL,
  `iapri_amount` double DEFAULT NULL,
  `parm_amount` double DEFAULT NULL,
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
  `budget_amount` double DEFAULT NULL,
  `access_level_district` int DEFAULT NULL,
  `access_level_province` int DEFAULT NULL,
  `access_level_programme` int DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `component_id` (`component_id`),
  KEY `expense_category_id` (`expense_category_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  KEY `activity_code` (`activity_id`) USING BTREE,
  KEY `funder_id` (`funder_id`),
  KEY `outcome_id` (`outcome_id`),
  KEY `output_id` (`output_id`),
  CONSTRAINT `awpb_template_activity_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `awpb_activity` (`id`),
  CONSTRAINT `awpb_template_activity_ibfk_2` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`),
  CONSTRAINT `awpb_template_activity_ibfk_3` FOREIGN KEY (`component_id`) REFERENCES `awpb_component` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_template_component`
--

DROP TABLE IF EXISTS `awpb_template_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_template_component` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `awpb_template_id` int NOT NULL,
  `component_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awpb_template_id` (`awpb_template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_template_users`
--

DROP TABLE IF EXISTS `awpb_template_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_template_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `awpb_template_id` int NOT NULL,
  `status_budget` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `other_name` varchar(255) DEFAULT '',
  `title` varchar(10) DEFAULT '',
  `updated_by` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `awpb_template_id` (`awpb_template_id`),
  CONSTRAINT `awpb_template_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `awpb_template_users_ibfk_2` FOREIGN KEY (`awpb_template_id`) REFERENCES `awpb_template` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awpb_unit_of_measure`
--

DROP TABLE IF EXISTS `awpb_unit_of_measure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awpb_unit_of_measure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `status` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_by` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `mgf_activity`
--

DROP TABLE IF EXISTS `mgf_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_no` int NOT NULL,
  `activity_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `componet_id` int NOT NULL,
  `inputs` int NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  KEY `componet_id` (`componet_id`),
  CONSTRAINT `mgf_activity_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `mgf_activity_ibfk_2` FOREIGN KEY (`componet_id`) REFERENCES `mgf_component` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_applicant`
--

DROP TABLE IF EXISTS `mgf_applicant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_applicant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` enum('Mr.','Mrs.','Ms.','Miss.','Dr.','Prof.','Rev.') DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `nationalid` varchar(15) DEFAULT NULL,
  `address` text,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `applicant_type` enum('Category-A','Category-B') DEFAULT NULL,
  `user_id` int NOT NULL,
  `organisation_id` int DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `fk_applicant_province` (`province_id`),
  KEY `fk_applicant_district` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `application_status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Initialized',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_submitted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applicant_id` (`applicant_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_application_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `mgf_applicant` (`id`),
  CONSTRAINT `mgf_application_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `scores` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `review_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `review_submission` timestamp NULL DEFAULT NULL,
  `reviewed_by` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certify_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `certify_submission` timestamp NULL DEFAULT NULL,
  `certified_by` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review2_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `review2_submission` timestamp NULL DEFAULT NULL,
  `reviewed2_by` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `approved_by` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conceptnote_id` (`conceptnote_id`),
  KEY `application_id` (`application_id`),
  CONSTRAINT `mgf_approval_ibfk_1` FOREIGN KEY (`conceptnote_id`) REFERENCES `mgf_concept_note` (`id`),
  CONSTRAINT `mgf_approval_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_approval_status`
--

DROP TABLE IF EXISTS `mgf_approval_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_approval_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `approval_status` enum('Accepted','On-Hold','Rejected','Not Recommended','Recommended','Strongly Recommended','Deferred') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lowerlimit` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upperlimit` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `mgf_approval_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_attachements`
--

DROP TABLE IF EXISTS `mgf_attachements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_attachements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_certificate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `articles_of_assoc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `audit_reports` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mou_contract` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `board_resolution` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_attachement` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `organisation_id` int NOT NULL,
  `application_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `application_id` (`application_id`),
  CONSTRAINT `mgf_attachements_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`),
  CONSTRAINT `mgf_attachements_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_bpi_categories`
--

DROP TABLE IF EXISTS `mgf_bpi_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_bpi_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `category_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_bpi_categories_indicators`
--

DROP TABLE IF EXISTS `mgf_bpi_categories_indicators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_bpi_categories_indicators` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `indicator_id` int DEFAULT NULL,
  `indicator_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_branch`
--

DROP TABLE IF EXISTS `mgf_branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_branch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address` varchar(100) NOT NULL,
  `employess` int NOT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `fk_branch_province` (`province_id`),
  KEY `fk_branch_district` (`district_id`),
  CONSTRAINT `fk_branch_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `fk_branch_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `mgf_branch_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_business_perfomance_indicator`
--

DROP TABLE IF EXISTS `mgf_business_perfomance_indicator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_business_perfomance_indicator` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `indicator_id` int DEFAULT NULL,
  `agribusiness_indicators` varchar(50) NOT NULL,
  `status_at_application` varchar(100) DEFAULT NULL,
  `status_after_1yr` varchar(100) DEFAULT NULL,
  `status_after_2yr` varchar(100) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_checklist`
--

DROP TABLE IF EXISTS `mgf_checklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_checklist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `applicant_id` int NOT NULL,
  `application_id` int NOT NULL DEFAULT '0',
  `proposal_id` int NOT NULL DEFAULT '0',
  `organisation_created` int NOT NULL DEFAULT '0',
  `contacts_added` int NOT NULL DEFAULT '0',
  `management_updated` int NOT NULL DEFAULT '0',
  `experience_updated` int NOT NULL DEFAULT '0',
  `attachements_uploaded` int NOT NULL DEFAULT '0',
  `profile_confirmed` int NOT NULL DEFAULT '0',
  `concept_created` int NOT NULL DEFAULT '0',
  `concept_submitted` int NOT NULL DEFAULT '0',
  `proposal_created` int NOT NULL DEFAULT '0',
  `components_created` int NOT NULL DEFAULT '0',
  `activities_created` int NOT NULL DEFAULT '0',
  `items_created` int NOT NULL DEFAULT '0',
  `project_submitted` int NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_component`
--

DROP TABLE IF EXISTS `mgf_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_component` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component_no` int NOT NULL,
  `component_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `proposal_id` int NOT NULL,
  `activities` int NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  KEY `proposal_id` (`proposal_id`),
  CONSTRAINT `mgf_component_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `mgf_component_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_concept_note`
--

DROP TABLE IF EXISTS `mgf_concept_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_concept_note` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estimated_cost` decimal(12,2) NOT NULL,
  `starting_date` date NOT NULL,
  `operation_id` int NOT NULL,
  `implimentation_period` enum('1','2','3','4','5','6','7','8') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_operation_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `application_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_submitted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `operation_id` (`operation_id`),
  CONSTRAINT `mgf_concept_note_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`),
  CONSTRAINT `mgf_concept_note_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`),
  CONSTRAINT `mgf_concept_note_ibfk_3` FOREIGN KEY (`operation_id`) REFERENCES `mgf_operation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_contact`
--

DROP TABLE IF EXISTS `mgf_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_no` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int NOT NULL,
  `position_id` int NOT NULL,
  `applicant_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `position_id` (`position_id`),
  KEY `applicant_id` (`applicant_id`),
  CONSTRAINT `mgf_contact_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`),
  CONSTRAINT `mgf_contact_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `mgf_position` (`id`),
  CONSTRAINT `mgf_contact_ibfk_3` FOREIGN KEY (`applicant_id`) REFERENCES `mgf_applicant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_costs_financing_plan`
--

DROP TABLE IF EXISTS `mgf_costs_financing_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_costs_financing_plan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `componentid` int DEFAULT NULL,
  `activityid` int NOT NULL,
  `item_no` int NOT NULL,
  `input_name` varchar(50) NOT NULL,
  `total_Project_cost` decimal(9,2) NOT NULL,
  `Applicant_in_kind` decimal(9,2) DEFAULT '0.00',
  `Applicant_in_cash` decimal(9,2) NOT NULL DEFAULT '0.00',
  `total_contribution` decimal(9,2) NOT NULL DEFAULT '0.00',
  `mgf_grant` decimal(9,2) NOT NULL DEFAULT '0.00',
  `other_sources` decimal(9,2) DEFAULT '0.00',
  `total` decimal(9,2) DEFAULT '0.00',
  `mgf_as_percent` decimal(9,2) DEFAULT '0.00',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `componentid` (`componentid`),
  KEY `activityid` (`activityid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_costs_financing_plan_other_sources`
--

DROP TABLE IF EXISTS `mgf_costs_financing_plan_other_sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_costs_financing_plan_other_sources` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `other_sources_name` varchar(40) NOT NULL,
  `other_sources_amount` decimal(9,2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_cumulative_profit`
--

DROP TABLE IF EXISTS `mgf_cumulative_profit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_cumulative_profit` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `cumulative_profit_yr1_value` double(9,2) DEFAULT '0.00',
  `cumulative_profit_yr2_value` double(9,2) DEFAULT '0.00',
  `cumulative_profit_yr3_value` double(9,2) DEFAULT '0.00',
  `cumulative_profit_yr4_value` double(9,2) DEFAULT '0.00',
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_district_eligibility`
--

DROP TABLE IF EXISTS `mgf_district_eligibility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_district_eligibility` (
  `id` int NOT NULL AUTO_INCREMENT,
  `year_id` int NOT NULL,
  `total_submitted` int DEFAULT '0',
  `compliant` int DEFAULT '0',
  `non_compliant` int DEFAULT '0',
  `minutes` text NOT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `is_active` int DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_de_province` (`province_id`),
  KEY `fk_de_district` (`district_id`),
  KEY `fk_de_y` (`year_id`),
  CONSTRAINT `fk_de_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `fk_de_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `fk_de_y` FOREIGN KEY (`year_id`) REFERENCES `mgf_year` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_eligibility`
--

DROP TABLE IF EXISTS `mgf_eligibility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_eligibility` (
  `id` int NOT NULL AUTO_INCREMENT,
  `application_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `criterion` text,
  `satisfactory` varchar(4) DEFAULT NULL,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `verified_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_eligibility_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`),
  CONSTRAINT `mgf_eligibility_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_eligibility_approval`
--

DROP TABLE IF EXISTS `mgf_eligibility_approval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_eligibility_approval` (
  `id` int NOT NULL AUTO_INCREMENT,
  `application_id` int NOT NULL,
  `is_active` int DEFAULT '0',
  `scores` varchar(5) DEFAULT '0',
  `review_remark` text,
  `review_submission` timestamp NULL DEFAULT NULL,
  `reviewed_by` varchar(20) DEFAULT NULL,
  `certify_remark` text,
  `certify_submission` timestamp NULL DEFAULT NULL,
  `certified_by` varchar(20) DEFAULT NULL,
  `review2_remark` text,
  `review2_submission` timestamp NULL DEFAULT NULL,
  `reviewed2_by` varchar(20) DEFAULT NULL,
  `approval_remark` text,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `approved_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`),
  CONSTRAINT `mgf_eligibility_approval_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_environmental_consideration`
--

DROP TABLE IF EXISTS `mgf_environmental_consideration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_environmental_consideration` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `description` mediumtext,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_existing_facilities`
--

DROP TABLE IF EXISTS `mgf_existing_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_existing_facilities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `facility_name` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `use_to_be_made` varchar(100) DEFAULT NULL,
  `estimate_cost` decimal(9,2) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `proposal_id` (`proposal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_expected_beneficiaries`
--

DROP TABLE IF EXISTS `mgf_expected_beneficiaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_expected_beneficiaries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type_of_beneficialy` varchar(200) NOT NULL,
  `total_no` int DEFAULT NULL,
  `no_of_women` int DEFAULT NULL,
  `no_of_youth` int DEFAULT NULL,
  `benefits` varchar(100) DEFAULT NULL,
  `sources` varchar(100) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `proposal_id` (`proposal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_expected_outputs_and_gross_revenue`
--

DROP TABLE IF EXISTS `mgf_expected_outputs_and_gross_revenue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_expected_outputs_and_gross_revenue` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `output_name` varchar(100) NOT NULL,
  `unit_of_measure` varchar(20) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `expected_price` decimal(9,2) DEFAULT NULL,
  `expected_gross_revenue` decimal(9,2) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `proposal_id` (`proposal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_experience`
--

DROP TABLE IF EXISTS `mgf_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `financed_before` enum('YES','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `any_collaboration` enum('YES','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collaboration_will` enum('YES','NO','N/A') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collaboration_ready` enum('YES','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_experience_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `finalscore` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT '0',
  `finalcomment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proposal_id` (`proposal_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_final_evaluation_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`),
  CONSTRAINT `mgf_final_evaluation_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_implementation_arrangements_cooperating_partners`
--

DROP TABLE IF EXISTS `mgf_implementation_arrangements_cooperating_partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_implementation_arrangements_cooperating_partners` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `main_activities` varchar(100) NOT NULL,
  `respobility` varchar(20) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `typee` enum('Staff','Technical Assistance','Collaborating Partners') NOT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `proposal_id` (`proposal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_implementation_arrangements_staff`
--

DROP TABLE IF EXISTS `mgf_implementation_arrangements_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_implementation_arrangements_staff` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `main_activities` varchar(100) NOT NULL,
  `respobility` varchar(20) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `proposal_id` (`proposal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_implementation_arrangements_technical_assistance`
--

DROP TABLE IF EXISTS `mgf_implementation_arrangements_technical_assistance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_implementation_arrangements_technical_assistance` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `main_activities` varchar(100) NOT NULL,
  `respobility` varchar(20) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `proposal_id` (`proposal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_implementation_schedule`
--

DROP TABLE IF EXISTS `mgf_implementation_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_implementation_schedule` (
  `id` int unsigned NOT NULL,
  `activity_id` int DEFAULT NULL,
  `yr1qtr1` tinyint(1) DEFAULT '0',
  `yr1qtr2` tinyint(1) DEFAULT '0',
  `yr1qtr3` tinyint(1) DEFAULT '0',
  `yr1qtr4` tinyint(1) DEFAULT '0',
  `yr2qtr1` tinyint(1) DEFAULT '0',
  `yr2qtr2` tinyint(1) DEFAULT '0',
  `yr2qtr3` tinyint(1) DEFAULT '0',
  `yr2qtr4` tinyint(1) DEFAULT '0',
  `yr3qtr1` tinyint(1) DEFAULT '0',
  `yr3qtr2` tinyint(1) DEFAULT '0',
  `yr3qtr3` tinyint(1) DEFAULT '0',
  `yr3qtr4` tinyint(1) DEFAULT '0',
  `yr4qtr1` tinyint(1) DEFAULT '0',
  `yr4qtr2` tinyint(1) DEFAULT '0',
  `yr4qtr3` tinyint(1) DEFAULT '0',
  `yr4qtr4` tinyint(1) DEFAULT '0',
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_input_cost`
--

DROP TABLE IF EXISTS `mgf_input_cost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_input_cost` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_no` int NOT NULL,
  `input_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `mgf_input_cost_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `mgf_input_cost_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `mgf_activity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_input_item`
--

DROP TABLE IF EXISTS `mgf_input_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_input_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_no` int NOT NULL,
  `input_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measure` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `mgf_input_item_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `mgf_input_item_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `mgf_activity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_interests_taxes`
--

DROP TABLE IF EXISTS `mgf_interests_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_interests_taxes` (
  `id` int unsigned NOT NULL,
  `interest_tax_type` enum('Interest','Tax') DEFAULT NULL,
  `interest_tax_percent` double(9,2) DEFAULT '0.00',
  `interest_tax_name` varchar(50) DEFAULT NULL,
  `interest_yr1_value` double(9,2) DEFAULT '0.00',
  `interest_yr2_value` double(9,2) DEFAULT '0.00',
  `interest_yr3_value` double(9,2) DEFAULT '0.00',
  `interest_yr4_value` double(9,2) DEFAULT '0.00',
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_netprofit`
--

DROP TABLE IF EXISTS `mgf_netprofit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_netprofit` (
  `id` int unsigned NOT NULL,
  `netprofit_yr1_value` double(9,2) DEFAULT NULL,
  `netprofit_yr2_value` double(9,2) DEFAULT NULL,
  `netprofit_yr3_value` double(9,2) DEFAULT NULL,
  `netprofit_yr4_value` double(9,2) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `status` enum('Offer Accepted','Offer Rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amountoffered` decimal(12,2) NOT NULL,
  `contribution` decimal(12,2) NOT NULL,
  `responded` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_responde` timestamp NULL DEFAULT NULL,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  KEY `proposal_id` (`proposal_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_offer_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `mgf_offer_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`),
  CONSTRAINT `mgf_offer_ibfk_3` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_operation`
--

DROP TABLE IF EXISTS `mgf_operation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_operation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `operation_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `operation_type` (`operation_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_organisation`
--

DROP TABLE IF EXISTS `mgf_organisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_organisation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cooperative` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `acronym` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_no` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_license_no` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` date NOT NULL,
  `business_objective` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_address` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `physical_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisational_branches` int DEFAULT NULL,
  `tel_no` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_no` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `applicant_id` int NOT NULL,
  `is_active` int DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_no` (`registration_no`),
  UNIQUE KEY `trade_license_no` (`trade_license_no`),
  UNIQUE KEY `email_address` (`email_address`),
  KEY `applicant_id` (`applicant_id`),
  KEY `fk_org_province` (`province_id`),
  KEY `fk_org_district` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `has_finance` enum('YES','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_resources` enum('YES','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_partnership`
--

DROP TABLE IF EXISTS `mgf_partnership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_partnership` (
  `id` int NOT NULL AUTO_INCREMENT,
  `partner_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `partnership_aim` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `partnership_status` enum('On-Going','Completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_partnership_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_pastproject`
--

DROP TABLE IF EXISTS `mgf_pastproject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_pastproject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `years_assisted` int NOT NULL,
  `amount_assisted` decimal(10,0) NOT NULL,
  `obligations_met` enum('YES','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `outcome_response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisation_id` int NOT NULL,
  `experience_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `experience_id` (`experience_id`),
  CONSTRAINT `mgf_pastproject_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`),
  CONSTRAINT `mgf_pastproject_ibfk_2` FOREIGN KEY (`experience_id`) REFERENCES `mgf_experience` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_position`
--

DROP TABLE IF EXISTS `mgf_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `position` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_product_market_marketing`
--

DROP TABLE IF EXISTS `mgf_product_market_marketing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_product_market_marketing` (
  `id` int unsigned NOT NULL,
  `marketing` varchar(200) NOT NULL,
  `market_outlets` varchar(100) DEFAULT NULL,
  `sales_contract` varchar(100) DEFAULT NULL,
  `person_responsible` varchar(50) DEFAULT NULL,
  `competition_penetration` varchar(100) DEFAULT NULL,
  `future_prospects` varchar(100) DEFAULT NULL,
  `branding_market_penetration` varchar(100) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `proposal_id` (`proposal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_profit_before_interest_taxes`
--

DROP TABLE IF EXISTS `mgf_profit_before_interest_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_profit_before_interest_taxes` (
  `id` int unsigned NOT NULL,
  `profit_yr1_value` double(9,2) DEFAULT '0.00',
  `profit_yr2_value` double(9,2) DEFAULT '0.00',
  `profit_yr3_value` double(9,2) DEFAULT '0.00',
  `profit_yr4_value` double(9,2) DEFAULT '0.00',
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `window` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `observation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `declaration` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `totalscore` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `decision` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_submitted` timestamp NULL DEFAULT NULL,
  `date_reviewed` timestamp NULL DEFAULT NULL,
  `reviewedby` int NOT NULL,
  `signature` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `reviewedby` (`reviewedby`),
  KEY `proposal_id` (`proposal_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_project_evaluation_ibfk_1` FOREIGN KEY (`reviewedby`) REFERENCES `users` (`id`),
  CONSTRAINT `mgf_project_evaluation_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`),
  CONSTRAINT `mgf_project_evaluation_ibfk_3` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_project_facilities`
--

DROP TABLE IF EXISTS `mgf_project_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_project_facilities` (
  `id` int unsigned NOT NULL,
  `facilityname` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `quantity` int NOT NULL,
  `facility_use` varchar(150) DEFAULT NULL,
  `estimated_cost` decimal(9,2) NOT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `organisation_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `created_at` int unsigned NOT NULL,
  `updated_at` int unsigned NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `organisation_id` (`organisation_id`),
  KEY `proposal_id` (`proposal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_project_risks_and_mitigation_measures`
--

DROP TABLE IF EXISTS `mgf_project_risks_and_mitigation_measures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_project_risks_and_mitigation_measures` (
  `id` int unsigned NOT NULL,
  `expected_risks` varchar(200) DEFAULT NULL,
  `consequences_of_risk` varchar(200) DEFAULT NULL,
  `mitigation_measures_planned` varchar(200) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_proposal`
--

DROP TABLE IF EXISTS `mgf_proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_proposal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mgf_no` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisation_id` int NOT NULL,
  `applicant_type` enum('Category-A','Category-B') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date DEFAULT NULL,
  `project_length` int NOT NULL DEFAULT '0',
  `number_reviewers` int NOT NULL DEFAULT '0',
  `project_operations` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `any_experience` enum('YES','NO','N/A') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `indicate_partnerships` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `proposal_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Created',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_submitted` timestamp NULL DEFAULT NULL,
  `problem_statement` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `overall_objective` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_active` int DEFAULT '0',
  `totalcost` decimal(15,2) DEFAULT '0.00',
  `province_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organisation_id` (`organisation_id`),
  KEY `fk_prop_province` (`province_id`),
  KEY `fk_prop_district` (`district_id`),
  CONSTRAINT `fk_prop_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `fk_prop_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `mgf_proposal_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `grade` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  KEY `proposal_id` (`proposal_id`),
  KEY `criterion_id` (`criterion_id`),
  CONSTRAINT `mgf_proposal_evaluation_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `mgf_proposal_evaluation_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`),
  CONSTRAINT `mgf_proposal_evaluation_ibfk_3` FOREIGN KEY (`criterion_id`) REFERENCES `mgf_selection_criteria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_reviewer`
--

DROP TABLE IF EXISTS `mgf_reviewer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_reviewer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` enum('Mr.','Mrs.','Ms.','Miss.','Dr.','Prof.','Rev.') DEFAULT NULL,
  `login_code` varchar(50) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `reviewer_type` enum('Internal','External') DEFAULT NULL,
  `area_of_expertise` text NOT NULL,
  `user_id` int NOT NULL,
  `confirmed` int DEFAULT '0',
  `createdBy` int unsigned DEFAULT NULL,
  `total_assigned_1` int DEFAULT '0',
  `total_assigned_2` int DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_code` (`login_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `criterion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `satisfactory` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `verified_by` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conceptnote_id` (`conceptnote_id`),
  KEY `organisation_id` (`organisation_id`),
  CONSTRAINT `mgf_screening_ibfk_1` FOREIGN KEY (`conceptnote_id`) REFERENCES `mgf_concept_note` (`id`),
  CONSTRAINT `mgf_screening_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_selection_category`
--

DROP TABLE IF EXISTS `mgf_selection_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_selection_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_selection_criteria`
--

DROP TABLE IF EXISTS `mgf_selection_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_selection_criteria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `criterion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `mgf_selection_criteria_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `mgf_selection_criteria_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `mgf_selection_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_selection_grade`
--

DROP TABLE IF EXISTS `mgf_selection_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_selection_grade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grade` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `criterion_id` int NOT NULL,
  `awardedscore` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  KEY `criterion_id` (`criterion_id`),
  CONSTRAINT `mgf_selection_grade_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  CONSTRAINT `mgf_selection_grade_ibfk_2` FOREIGN KEY (`criterion_id`) REFERENCES `mgf_selection_criteria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_settings`
--

DROP TABLE IF EXISTS `mgf_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `window` int NOT NULL,
  `max_reviewers` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_sustainability_scalability`
--

DROP TABLE IF EXISTS `mgf_sustainability_scalability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_sustainability_scalability` (
  `id` int unsigned NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_unit`
--

DROP TABLE IF EXISTS `mgf_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_unit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unit` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `synonym` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unit` (`unit`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `mgf_unit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_value_of_product`
--

DROP TABLE IF EXISTS `mgf_value_of_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_value_of_product` (
  `id` int unsigned NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_unit` varchar(11) DEFAULT NULL,
  `product_yr1_qty` decimal(9,2) DEFAULT '0.00',
  `product_yr1_price` double(9,2) DEFAULT '0.00',
  `product_yr1_value` double(9,2) DEFAULT '0.00',
  `product_yr2_qty` decimal(9,2) DEFAULT '0.00',
  `product_yr2_price` double(9,2) DEFAULT '0.00',
  `product_yr2_value` double(9,2) DEFAULT '0.00',
  `product_yr3_qty` decimal(9,2) DEFAULT '0.00',
  `product_yr3_price` double(9,2) DEFAULT '0.00',
  `product_yr3_value` double(9,2) DEFAULT '0.00',
  `product_yr4_qty` decimal(9,2) DEFAULT '0.00',
  `product_yr4_price` double(9,2) DEFAULT '0.00',
  `product_yr4_value` double(9,2) DEFAULT '0.00',
  `comment` varchar(100) DEFAULT NULL,
  `project_id` int NOT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_value_of_product_totals`
--

DROP TABLE IF EXISTS `mgf_value_of_product_totals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_value_of_product_totals` (
  `id` int unsigned NOT NULL,
  `total_yr1_value` double(9,2) DEFAULT NULL,
  `total_yr2_value` double(9,2) DEFAULT NULL,
  `total_yr3_value` double(9,2) DEFAULT NULL,
  `total_yr4_value` double(9,2) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_variable_fixed_cost`
--

DROP TABLE IF EXISTS `mgf_variable_fixed_cost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_variable_fixed_cost` (
  `id` int unsigned NOT NULL,
  `cost_name` varchar(200) NOT NULL,
  `cost_type` enum('Variable','Fixed') DEFAULT NULL,
  `cost_yr1_value` double(9,2) DEFAULT NULL,
  `cost_yr2_value` double(9,2) DEFAULT NULL,
  `cost_yr3_value` double(9,2) DEFAULT NULL,
  `cost_yr4_value` double(9,2) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_variable_fixed_cost_totals`
--

DROP TABLE IF EXISTS `mgf_variable_fixed_cost_totals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_variable_fixed_cost_totals` (
  `id` int unsigned NOT NULL,
  `total_yr1_value` double(9,2) DEFAULT '0.00',
  `total_yr2_value` double(9,2) DEFAULT '0.00',
  `total_yr3_value` double(9,2) DEFAULT '0.00',
  `total_yr4_value` double(9,2) DEFAULT '0.00',
  `proposal_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_window`
--

DROP TABLE IF EXISTS `mgf_window`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_window` (
  `id` int NOT NULL AUTO_INCREMENT,
  `year_id` int NOT NULL,
  `window` int NOT NULL,
  `open_from` date NOT NULL,
  `closing_date` date NOT NULL,
  `total_submitted` int DEFAULT '0',
  `compliant` int DEFAULT '0',
  `non_compliant` int DEFAULT '0',
  `is_active` int DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_wnd_y` (`year_id`),
  CONSTRAINT `fk_wnd_y` FOREIGN KEY (`year_id`) REFERENCES `mgf_year` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mgf_year`
--

DROP TABLE IF EXISTS `mgf_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mgf_year` (
  `id` int NOT NULL AUTO_INCREMENT,
  `year` varchar(30) NOT NULL,
  `total_submitted` int DEFAULT '0',
  `compliant` int DEFAULT '0',
  `non_compliant` int DEFAULT '0',
  `is_active` int DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-16 17:29:39
