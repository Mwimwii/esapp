-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2021 at 07:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mgf_activity`
--

CREATE TABLE `mgf_activity` (
  `id` int(11) NOT NULL,
  `activity_no` int(11) NOT NULL,
  `activity_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `componet_id` int(11) NOT NULL,
  `inputs` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_activity`
--

INSERT INTO `mgf_activity` (`id`, `activity_no`, `activity_name`, `subtotal`, `componet_id`, `inputs`, `date_created`, `createdby`) VALUES
(55, 1620846741, 'Activity 1', '51900.00', 35, 1, '2021-05-12 17:12:21', 56),
(56, 1620846747, 'Activity 2', '15580.00', 35, 2, '2021-05-12 17:12:27', 56),
(57, 1620846761, 'Activity 1', '20000.00', 36, 2, '2021-05-12 17:12:41', 56),
(58, 1620846766, 'Activity 2', '9450.00', 36, 1, '2021-05-12 17:12:46', 56),
(59, 1621766667, 'Activity 1', '0.00', 41, 0, '2021-05-23 10:44:27', 61),
(60, 1623274069, 'Activity 1', '5200.00', 44, 1, '2021-06-09 21:27:49', 88),
(61, 1623274379, 'Activity 2', '0.00', 44, 0, '2021-06-09 21:32:59', 88);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_applicant`
--

CREATE TABLE `mgf_applicant` (
  `id` int(11) NOT NULL,
  `title` enum('Mr.','Mrs.','Ms.','Miss.','Dr.','Prof.','Rev.') DEFAULT NULL,
  `province_id` int(11) UNSIGNED DEFAULT NULL,
  `district_id` int(11) UNSIGNED DEFAULT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `nationalid` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `applicant_type` enum('Category-A','Category-B') DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `organisation_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mgf_applicant`
--

INSERT INTO `mgf_applicant` (`id`, `title`, `province_id`, `district_id`, `first_name`, `last_name`, `mobile`, `nationalid`, `address`, `confirmed`, `applicant_type`, `user_id`, `organisation_id`, `date_created`) VALUES
(2, NULL, 1, NULL, 'Chikondi', 'Banda', '0977665423', NULL, '', 0, 'Category-B', 17, NULL, '2021-03-01 19:15:34'),
(5, NULL, 2, NULL, 'Danny', 'Leza', '0977384902', NULL, '', 0, '', 20, NULL, '2021-03-11 15:54:48'),
(6, NULL, 4, NULL, 'Jacob', 'Chaya', '0967889021', NULL, '', 0, '', 21, NULL, '2021-03-16 13:51:59'),
(7, NULL, 2, NULL, 'Lloyd', 'Hambai', '0977221178', NULL, '', 0, 'Category-A', 22, NULL, '2021-04-06 14:31:20'),
(8, 'Mr.', 2, NULL, 'David', 'Kangwa', '0977116278', '473890/11/1', 'address1', 0, 'Category-A', 23, NULL, '2021-04-06 14:33:34'),
(9, 'Mr.', 2, NULL, 'Brian', 'Kaoma', '0967889022', '237781/11/1', 'wqw', 0, 'Category-B', 24, NULL, '2021-04-10 19:22:48'),
(10, NULL, NULL, NULL, 'Farai', 'Tofa', '0977847239', '593312/11/1', NULL, 0, 'Category-B', 26, NULL, '2021-04-19 17:28:15'),
(11, 'Rev.', 2, NULL, 'Adrian', 'Kangwa', '0977221178', '983382/11/1', 'address', 0, 'Category-B', 27, NULL, '2021-04-21 06:37:45'),
(12, NULL, NULL, NULL, 'Boyd', 'Banda', '0966327718', '112783/11/1', NULL, 0, 'Category-B', 28, NULL, '2021-04-21 06:50:19'),
(13, NULL, NULL, NULL, 'New', 'User', '0977336627', '991103/11/1', NULL, 0, 'Category-B', 35, NULL, '2021-04-27 11:31:42'),
(14, 'Mr.', 7, NULL, 'Asan', 'Mbale', '0977336627', '593312/10/1', 'My Addresss', 0, 'Category-B', 37, NULL, '2021-04-27 12:14:09'),
(15, 'Mr.', 1, NULL, 'Kalusa', 'Kaamba', '0977847231', '593312/13/1', 'Address 35676242', 0, 'Category-B', 53, NULL, '2021-04-28 17:54:11'),
(16, 'Mr.', 2, NULL, 'Kaluba', 'Kaumba', '0977847232', '593393/10/1', 'My Address', 0, 'Category-A', 54, NULL, '2021-04-28 18:23:19'),
(17, 'Mr.', 1, NULL, 'David', 'Bwalya', '0977227781', '473890/10/1', 'Address1 ', 0, 'Category-B', 55, NULL, '2021-04-28 18:43:39'),
(18, 'Mr.', 6, 54, 'FarmerA', 'FarmerA', '0977338294', '593393/10/1', 'Farmer-A Address', 1, 'Category-A', 56, 34, '2021-04-28 20:14:29'),
(19, 'Mr.', 2, 13, 'FarmerB', 'FarmerB', '0977338214', '593313/12/1', 'Farmer-B Address', 0, 'Category-B', 57, 35, '2021-04-28 20:20:17'),
(20, 'Ms.', 5, NULL, 'FarmerC', 'FarmerC', '0977338829', '993301/11/1', 'Farmer C Address', 0, 'Category-B', 60, NULL, '2021-05-11 19:12:00'),
(21, 'Ms.', 1, 7, 'FarmerD', 'FarmerD', '0977332289', '839920/11/1', 'Farmer D Address', 0, 'Category-B', 61, 37, '2021-05-12 07:40:12'),
(22, 'Mrs.', 2, 12, 'Farmer7', 'Farmer7', '0978221189', '882211/12/1', 'Address\r\n', 0, 'Category-B', 66, 36, '2021-05-17 08:04:00'),
(23, 'Mr.', 1, 9, 'Farmer8', 'Farmer8', '0977661162', '1828672/12/00', 'Address', 0, 'Category-A', 67, NULL, '2021-05-17 15:14:15'),
(24, NULL, NULL, NULL, 'Farmer9', 'Farmer9', '0977227381', '903381/11/1', NULL, 0, NULL, 68, NULL, '2021-05-17 16:23:59'),
(25, NULL, NULL, NULL, 'Farmer10', 'Farmer9', '0977443891', '991182/22/1', NULL, 0, NULL, 69, NULL, '2021-05-17 16:26:06'),
(26, NULL, NULL, NULL, 'Farmer11', 'Farmer11', '0977221394', '968590/11/1', NULL, 0, NULL, 70, NULL, '2021-05-17 16:27:43'),
(27, NULL, NULL, NULL, 'Farmer12', 'Farmer12', '0966447382', '904487/21/1', NULL, 0, NULL, 71, NULL, '2021-05-17 16:29:42'),
(28, NULL, NULL, NULL, 'Farmer13', 'Farmer13', '0976338891', '905592/11/1', NULL, 0, NULL, 72, NULL, '2021-05-17 17:00:47'),
(29, 'Mrs.', 1, 10, 'Farmer14', 'Farmer14', '0977336478', '987765/11/1', 'fhg', 0, NULL, 73, NULL, '2021-05-17 18:37:41'),
(30, NULL, NULL, NULL, 'Farmer15', 'Farmer15', '0977446738', '349901/11/1', NULL, 0, NULL, 74, NULL, '2021-05-17 18:44:49'),
(31, NULL, NULL, NULL, 'Farmer16', 'Farmer16', '0977447581', '894490/11/1', NULL, 0, NULL, 75, NULL, '2021-05-17 18:47:41'),
(32, 'Mrs.', 1, 11, 'Farmer17', 'Farmer17', '0977332283', '1828672/12/1', 'Address', 0, NULL, 76, 38, '2021-05-18 08:18:23'),
(33, NULL, NULL, NULL, 'Farai', 'Tofa', '0977227738', '784799/11/1', NULL, 0, NULL, 77, NULL, '2021-05-18 11:03:14'),
(34, NULL, NULL, NULL, 'F1', 'L1', '0977336617', '647738/11/1', NULL, 0, NULL, 78, NULL, '2021-05-21 14:11:30'),
(35, NULL, NULL, NULL, 'F2', 'L2', '0977221189', '885590/11/1', NULL, 0, NULL, 79, NULL, '2021-05-21 14:20:08'),
(36, 'Mrs.', 1, 9, 'F3', 'L3', '0977119902', '948839/22/1', 'My Address', 0, NULL, 80, 39, '2021-05-21 14:24:48'),
(37, NULL, NULL, NULL, 'Good', 'Farmer', '0977338291', '478823/11/1', NULL, 0, NULL, 86, NULL, '2021-06-08 19:30:23'),
(38, NULL, NULL, NULL, 'Good', 'Farmerr', '0966221181', '943221/11/1', NULL, 0, NULL, 87, NULL, '2021-06-08 19:32:01'),
(39, 'Mr.', 1, 1, 'Harry', 'Gado', '0977278911', '938300/11/1', 'My Address', 1, 'Category-B', 88, 40, '2021-06-08 19:39:16'),
(40, 'Mr.', 2, 17, 'Kafala', 'Kafala', '0977332256', '903377/11/1', 'My Address', 1, 'Category-B', 116, 41, '2021-06-30 11:42:20'),
(41, 'Mrs.', 2, 14, 'Kalanda', 'Kalanda', '0977336178', '166789/11/1', 'My Address', 0, 'Category-B', 117, 42, '2021-06-30 13:10:00'),
(42, 'Mr.', 2, 17, 'Taka', 'Mala', '0977551172', '981109/11/1', 'address', 0, 'Category-B', 120, 43, '2021-07-08 13:10:42'),
(43, NULL, NULL, NULL, 'Harry', 'Tembo', '+260977118829', '782209/11/1', NULL, 0, NULL, 127, NULL, '2021-07-13 12:23:45'),
(44, 'Mr.', 2, 16, 'Farmer', 'Farmer', '+260977661192', '807810/11/1', 'Address', 0, 'Category-A', 128, 44, '2021-07-14 14:45:34'),
(45, 'Ms.', 2, 16, 'New', 'Farmer', '+260977335567', '872281/12/1', 'gjhgjk', 1, 'Category-B', 129, 45, '2021-07-14 21:13:19'),
(46, 'Mrs.', 4, 39, 'Kadu', 'Ka', '0967765397', '337718/11/1', 'Address 356762', 1, 'Category-B', 130, 46, '2021-07-21 20:27:49'),
(47, 'Mrs.', 4, 39, 'New', 'Farmer', '+260966224456', '807810/11/1', 'My Address', 0, 'Category-A', 132, 47, '2021-07-29 18:44:10');

--
-- Triggers `mgf_applicant`
--
DELIMITER $$
CREATE TRIGGER `after_applicant_update` AFTER UPDATE ON `mgf_applicant` FOR EACH ROW BEGIN
	UPDATE users SET first_name=new.first_name, last_name=new.last_name,phone=new.mobile,district_id=new.district_id,province_id=new.province_id,nrc=new.nationalid,type_of_user='Applicant' WHERE id=new.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_application`
--

CREATE TABLE `mgf_application` (
  `id` int(11) NOT NULL,
  `attachements` int(1) DEFAULT NULL,
  `applicant_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `application_status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Initialized',
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_submitted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_application`
--

INSERT INTO `mgf_application` (`id`, `attachements`, `applicant_id`, `organisation_id`, `application_status`, `is_active`, `date_created`, `date_submitted`) VALUES
(62, NULL, 18, 34, 'Initialized', 0, '2021-05-12 17:04:46', NULL),
(63, NULL, 19, 35, 'Approved', 0, '2021-05-12 20:27:03', '2021-05-22 18:05:58'),
(64, NULL, 22, 36, 'Initialized', 0, '2021-05-17 09:23:27', NULL),
(65, NULL, 21, 37, 'Approved', 0, '2021-05-17 23:56:08', '2021-05-18 00:46:57'),
(66, NULL, 32, 38, 'Accepted', 0, '2021-05-18 11:06:45', '2021-05-18 11:10:57'),
(67, NULL, 36, 39, 'Approved', 0, '2021-05-21 14:32:12', '2021-05-21 14:33:17'),
(68, NULL, 18, 34, 'Initialized', 0, '2021-05-23 10:28:46', NULL),
(69, NULL, 21, 37, 'Initialized', 0, '2021-05-23 10:35:30', NULL),
(70, NULL, 39, 40, 'Accepted', 0, '2021-06-08 20:21:11', '2021-07-07 14:26:54'),
(71, NULL, 40, 41, 'Under_Review', 0, '2021-06-30 11:46:29', '2021-07-21 20:08:19'),
(72, NULL, 41, 42, 'Initialized', 0, '2021-06-30 13:13:57', NULL),
(73, NULL, 42, 43, 'Initialized', 0, '2021-07-08 13:16:20', NULL),
(74, NULL, 45, 45, 'Under_Review', 0, '2021-07-14 21:15:26', '2021-07-14 21:19:28'),
(75, NULL, 46, 46, 'Under_Review', 1, '2021-07-21 20:39:49', '2021-07-21 21:29:45'),
(76, NULL, 40, 41, 'Initialized', 1, '2021-07-21 21:44:54', NULL),
(77, NULL, 39, 40, 'Initialized', 1, '2021-07-25 18:13:14', NULL),
(78, NULL, 18, 34, 'Initialized', 1, '2021-07-25 22:41:16', NULL),
(79, NULL, 47, 47, 'Initialized', 1, '2021-07-29 20:10:15', NULL);

--
-- Triggers `mgf_application`
--
DELIMITER $$
CREATE TRIGGER `after_application_insert` AFTER INSERT ON `mgf_application` FOR EACH ROW BEGIN
	INSERT INTO mgf_attachements(registration_certificate,articles_of_assoc,audit_reports,mou_contract,board_resolution,application_attachement,application_id,organisation_id) VALUES ('Nil','Nil','Nil','Nil','Nil','Nil',new.id,new.organisation_id);
INSERT INTO mgf_eligibility(criterion,application_id,organisation_id) 
  VALUES ("Has the applicant fully filled the application form with required attachments?",new.id,new.organisation_id),
        ("Is the applicant an appropriate type of organization for the window applied under?",new.id,new.organisation_id),
         ("Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?",new.id,new.organisation_id),
         ("Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?",new.id,new.organisation_id),
         ("Has the applicant been collaborating or intends to collaborate with smallholders/producers?",new.id,new.organisation_id),
         ("Is the applicant operating as a fully commercial enterprise?",new.id,new.organisation_id),
         ("Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?",new.id,new.organisation_id),
         ("Has the applicant demonstrated capacity to make required contribution in cash or kind or both?",new.id,new.organisation_id),
         ("Does the application demonstrate good financial standing of the applicant?",new.id,new.organisation_id),
         ("Does the applicant have sound governance and proven management capacity?",new.id,new.organisation_id),
         ("Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?",new.id,new.organisation_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_approval`
--

CREATE TABLE `mgf_approval` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `conceptnote_id` int(11) NOT NULL,
  `scores` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `review_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_submission` timestamp NULL DEFAULT NULL,
  `reviewed_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certify_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certify_submission` timestamp NULL DEFAULT NULL,
  `certified_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review2_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review2_submission` timestamp NULL DEFAULT NULL,
  `reviewed2_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `approved_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_approval`
--

INSERT INTO `mgf_approval` (`id`, `application_id`, `conceptnote_id`, `scores`, `review_remark`, `review_submission`, `reviewed_by`, `certify_remark`, `certify_submission`, `certified_by`, `review2_remark`, `review2_submission`, `reviewed2_by`, `approval_remark`, `approve_submittion`, `approved_by`) VALUES
(38, 63, 18, '72.72', 'Certified as meeting eligibility criteria and conditions for participation', '2021-05-22 18:06:24', '1', 'Checked and confirmed', '2021-06-09 20:57:03', '1', NULL, NULL, NULL, 'Approved for participation', '2021-06-09 21:07:24', '1'),
(39, 65, 19, '72.72', 'Certified as meeting eligibility criteria and conditions for participation', '2021-05-22 17:15:09', '1', 'Checked and confirmed', '2021-05-22 17:42:47', '1', NULL, NULL, NULL, 'Approved for participation', '2021-05-22 17:46:13', '1'),
(40, 66, 20, '81.81', 'Certified as meeting eligibility criteria and conditions for participation', '2021-05-22 17:42:29', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 67, 21, '81.81', 'Certified as meeting eligibility criteria and conditions for participation', '2021-05-22 16:34:12', '1', 'Checked and confirmed', '2021-05-22 16:35:17', '1', NULL, NULL, NULL, 'Approved for participation', '2021-05-22 17:51:14', '1'),
(42, 63, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 70, 23, '81.81', 'Certified as meeting eligibility criteria and conditions for participation', '2021-07-07 14:46:12', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 70, 23, '81.81', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 70, 23, '81.81', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 70, 23, '81.81', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 70, 23, '81.81', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 74, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 71, 25, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 75, 26, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 75, 26, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_approval_status`
--

CREATE TABLE `mgf_approval_status` (
  `id` int(11) NOT NULL,
  `approval_status` enum('Accepted','On-Hold','Rejected','Not Recommended','Recommended','Strongly Recommended','Deferred') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lowerlimit` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upperlimit` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_approval_status`
--

INSERT INTO `mgf_approval_status` (`id`, `approval_status`, `lowerlimit`, `upperlimit`, `user_id`, `date_created`) VALUES
(1, 'Accepted', '70', '100', 15, '2021-03-07 16:23:51'),
(2, 'On-Hold', '69.9', '40', 15, '2021-03-07 16:23:51'),
(3, 'Rejected', '0', '39.9', 15, '2021-03-07 16:24:34'),
(4, 'Not Recommended', '0', '49.9', 15, '2021-03-18 07:14:15'),
(5, 'Recommended', '70', '90', 15, '2021-03-18 07:14:15'),
(6, 'Strongly Recommended', '90.01', '100', 15, '2021-03-18 07:15:01'),
(7, 'Deferred', '50', '69.9', 15, '2021-03-31 17:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_attachements`
--

CREATE TABLE `mgf_attachements` (
  `id` int(11) NOT NULL,
  `registration_certificate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `articles_of_assoc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `audit_reports` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mou_contract` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `board_resolution` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_attachement` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_attachements`
--

INSERT INTO `mgf_attachements` (`id`, `registration_certificate`, `articles_of_assoc`, `audit_reports`, `mou_contract`, `board_resolution`, `application_attachement`, `organisation_id`, `application_id`, `date_created`) VALUES
(62, 'uploads/attachements/62_Certificate2559_bgreg.jfif', 'uploads/attachements/62_Article2873_bgreg.jfif', 'Nil', 'uploads/attachements/62_Contract2651_bgreg.jfif', 'uploads/attachements/62_Resolution2700_bgreg.jfif', 'Nil', 34, 62, '2021-05-12 17:04:46'),
(63, 'uploads/attachements/63_Certificate1425_e5.jfif', 'uploads/attachements/63_Article2145_bgreg.jfif', 'uploads/attachements/63_Audit1043_bgreg.jfif', 'uploads/attachements/63_Contract2670_bgreg.jfif', 'uploads/attachements/63_Resolution3489_bgreg.jfif', 'uploads/attachements/63_Application2346_bgreg.jfif', 35, 63, '2021-05-12 20:27:03'),
(64, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 36, 64, '2021-05-17 09:23:27'),
(65, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 37, 65, '2021-05-17 23:56:08'),
(66, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 38, 66, '2021-05-18 11:06:45'),
(67, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 39, 67, '2021-05-21 14:32:12'),
(68, 'uploads/attachements/68_Certificate527_download_1.png', 'uploads/attachements/68_Article3623_download_1.png', 'Nil', 'uploads/attachements/68_Contract209_download_1.png', 'uploads/attachements/68_Resolution3439_download_1.png', 'Nil', 34, 68, '2021-05-23 10:28:46'),
(69, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 37, 69, '2021-05-23 10:35:30'),
(70, 'uploads/attachements/70_Certificate2909_download_1.png', 'uploads/attachements/70_Article1533_download_1.png', 'uploads/attachements/70_Audit1772_download_1.png', 'uploads/attachements/70_Contract2739_download_1.png', 'uploads/attachements/70_Resolution1223_download_1.png', 'uploads/attachements/70_Application955_download_1.png', 40, 70, '2021-06-08 20:21:11'),
(71, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 41, 71, '2021-06-30 11:46:29'),
(72, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 42, 72, '2021-06-30 13:13:57'),
(73, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 43, 73, '2021-07-08 13:16:20'),
(74, 'uploads/attachements/74_Certificate2075_download_1.png', 'uploads/attachements/74_Article1823_download_1.png', 'uploads/attachements/74_Audit2677_download_1.png', 'uploads/attachements/74_Contract3932_download_1.png', 'uploads/attachements/74_Resolution151_download_1.png', 'uploads/attachements/74_Application3016_download_1.png', 45, 74, '2021-07-14 21:15:26'),
(75, 'uploads/attachements/75_Certificate511_e5.jfif', 'uploads/attachements/75_Article577_musele.png', 'uploads/attachements/75_Audit626_e4.jpg', 'uploads/attachements/75_Contract2091_e1.jpg', 'uploads/attachements/75_Resolution1299_e5.jfif', 'uploads/attachements/75_Application3976_e3.jpg', 46, 75, '2021-07-21 20:39:49'),
(76, 'uploads/attachements/76_Certificate523_e5.jfif', 'uploads/attachements/76_Article1852_e5.jfif', 'uploads/attachements/76_Audit968_download_1.png', 'uploads/attachements/76_Contract2330_download_1.png', 'uploads/attachements/76_Resolution575_download_1.png', 'uploads/attachements/76_Application3716_download_1.png', 41, 76, '2021-07-21 21:44:54'),
(77, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 40, 77, '2021-07-25 18:13:14'),
(78, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 34, 78, '2021-07-25 22:41:16'),
(79, 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 'Nil', 47, 79, '2021-07-29 20:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_bpi_categories`
--

CREATE TABLE `mgf_bpi_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_bpi_categories`
--

INSERT INTO `mgf_bpi_categories` (`id`, `category_id`, `category_description`) VALUES
(1, 1, 'Structure of the firm'),
(2, 2, 'Inputs into Processing/Value Addition'),
(3, 3, 'Outputs from Processing/Value Addition'),
(4, 4, 'Business / Financial performance');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_bpi_categories_indicators`
--

CREATE TABLE `mgf_bpi_categories_indicators` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `indicator_id` int(11) DEFAULT NULL,
  `indicator_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_bpi_categories_indicators`
--

INSERT INTO `mgf_bpi_categories_indicators` (`id`, `category_id`, `indicator_id`, `indicator_description`) VALUES
(1, 1, 1, 'Size (number of employees)'),
(2, 1, 2, 'Capital structure (equity vs debt)'),
(3, 1, 3, 'Types of operations (list all relevant)'),
(4, 1, 4, 'Age of business'),
(5, 2, 1, 'List major inputs with annual volumes and sources'),
(6, 3, 1, 'Annual production volumes and markets'),
(7, 4, 1, 'Annual Turnover (last FY)'),
(8, 4, 2, 'Gross/Trading Profit (last FY)'),
(9, 4, 3, 'Profit before Interest and Taxes'),
(10, 4, 4, 'Acid test ratio'),
(11, 4, 5, 'Debt ratio'),
(12, 4, 6, 'Fixed-asset turnover ratio'),
(13, 4, 7, 'Total assets turnover ratio'),
(14, 4, 8, 'Return on assets'),
(15, 4, 9, 'Internal Rate of Return');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_branch`
--

CREATE TABLE `mgf_branch` (
  `id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `employess` int(5) NOT NULL,
  `province_id` int(11) UNSIGNED DEFAULT NULL,
  `district_id` int(11) UNSIGNED DEFAULT NULL,
  `organisation_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_branch`
--

INSERT INTO `mgf_branch` (`id`, `address`, `employess`, `province_id`, `district_id`, `organisation_id`, `date_created`) VALUES
(3, 'Address 356762', 32, 2, 13, 46, '2021-07-21 20:33:40'),
(4, 'Address 35676242', 35, 2, 17, 46, '2021-07-21 20:34:02'),
(5, 'Address 356762', 29, 2, 18, 46, '2021-07-21 20:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_business_perfomance_indicator`
--

CREATE TABLE `mgf_business_perfomance_indicator` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `indicator_id` int(11) DEFAULT NULL,
  `agribusiness_indicators` varchar(50) NOT NULL,
  `status_at_application` varchar(100) DEFAULT NULL,
  `status_after_1yr` varchar(100) DEFAULT NULL,
  `status_after_2yr` varchar(100) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_business_perfomance_indicator`
--

INSERT INTO `mgf_business_perfomance_indicator` (`id`, `category_id`, `indicator_id`, `agribusiness_indicators`, `status_at_application`, `status_after_1yr`, `status_after_2yr`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(2, 1, 1, 'indicator_id', 'ddd', 'dd', 'dd', 13, '2021-08-08 16:01:19', '2021-08-08 16:01:19', 56, NULL),
(3, 2, 5, 'List major inputs with annual volumes and sources', 'status ', 'status yr1', 'status yr 2', 13, '2021-08-08 16:12:51', '2021-08-08 16:12:51', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_checklist`
--

CREATE TABLE `mgf_checklist` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL DEFAULT 0,
  `proposal_id` int(11) NOT NULL DEFAULT 0,
  `organisation_created` int(1) NOT NULL DEFAULT 0,
  `contacts_added` int(1) NOT NULL DEFAULT 0,
  `management_updated` int(1) NOT NULL DEFAULT 0,
  `experience_updated` int(1) NOT NULL DEFAULT 0,
  `attachements_uploaded` int(1) NOT NULL DEFAULT 0,
  `profile_confirmed` int(1) NOT NULL DEFAULT 0,
  `concept_created` int(1) NOT NULL DEFAULT 0,
  `concept_submitted` int(1) NOT NULL DEFAULT 0,
  `proposal_created` int(1) NOT NULL DEFAULT 0,
  `components_created` int(1) NOT NULL DEFAULT 0,
  `activities_created` int(1) NOT NULL DEFAULT 0,
  `items_created` int(1) NOT NULL DEFAULT 0,
  `project_submitted` int(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_checklist`
--

INSERT INTO `mgf_checklist` (`id`, `applicant_id`, `application_id`, `proposal_id`, `organisation_created`, `contacts_added`, `management_updated`, `experience_updated`, `attachements_uploaded`, `profile_confirmed`, `concept_created`, `concept_submitted`, `proposal_created`, `components_created`, `activities_created`, `items_created`, `project_submitted`, `date_created`) VALUES
(1, 39, 70, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, '2021-06-08 20:31:55'),
(2, 18, 68, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, '2021-06-08 21:16:02'),
(3, 40, 71, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2021-06-30 11:44:24'),
(4, 41, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-06-30 13:11:02'),
(5, 42, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-07-08 13:14:23'),
(6, 44, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-07-14 14:47:59'),
(7, 45, 74, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2021-07-14 21:14:08'),
(8, 46, 75, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2021-07-21 20:30:44'),
(9, 47, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-07-29 18:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_component`
--

CREATE TABLE `mgf_component` (
  `id` int(11) NOT NULL,
  `component_no` int(11) NOT NULL,
  `component_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `proposal_id` int(11) NOT NULL,
  `activities` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_component`
--

INSERT INTO `mgf_component` (`id`, `component_no`, `component_name`, `subtotal`, `proposal_id`, `activities`, `date_created`, `createdby`) VALUES
(35, 1, 'Comp 1', '67480.00', 13, 2, '2021-05-12 17:12:08', 56),
(36, 2, 'Comp 2', '29450.00', 13, 2, '2021-05-12 17:12:13', 56),
(37, 1, 'Comp 1', '0.00', 14, 0, '2021-05-14 00:10:58', 57),
(38, 2, 'Comp 2', '0.00', 14, 0, '2021-05-14 00:11:05', 57),
(40, 1, 'Comp 1', '0.00', 15, 0, '2021-05-23 10:37:28', 61),
(41, 2, 'Comp 2', '0.00', 15, 1, '2021-05-23 10:44:11', 61),
(43, 1, 'Comp 1', '0.00', 17, 0, '2021-06-09 21:27:00', 88),
(44, 2, 'Comp 2', '5200.00', 17, 2, '2021-06-09 21:27:14', 88);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_concept_note`
--

CREATE TABLE `mgf_concept_note` (
  `id` int(11) NOT NULL,
  `project_title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estimated_cost` decimal(12,2) NOT NULL,
  `starting_date` date NOT NULL,
  `operation_id` int(11) NOT NULL,
  `implimentation_period` enum('1','2','3','4','5','6','7','8') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_operation_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_submitted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_concept_note`
--

INSERT INTO `mgf_concept_note` (`id`, `project_title`, `estimated_cost`, `starting_date`, `operation_id`, `implimentation_period`, `other_operation_type`, `application_id`, `organisation_id`, `date_created`, `date_submitted`) VALUES
(18, 'Cassava Project', '30000.00', '2021-04-25', 1, '2', '', 63, 35, '2021-05-12 20:32:01', '2021-05-22 18:05:58'),
(19, 'Banana Project', '5000.00', '2021-05-29', 1, '2', NULL, 65, 37, '2021-05-18 00:46:27', '2021-05-18 00:46:57'),
(20, 'Banana Project', '6000.00', '2021-06-05', 1, '2', NULL, 66, 38, '2021-05-18 11:08:25', '2021-05-18 11:10:57'),
(21, 'BHC project 1', '40000.00', '2021-05-29', 4, '3', NULL, 67, 39, '2021-05-21 14:33:08', '2021-05-21 14:33:17'),
(22, 'Goats Project2', '30000.00', '2021-06-05', 1, '2', NULL, 69, 37, '2021-05-25 16:20:39', NULL),
(23, 'Orange Project', '25000.00', '2021-06-26', 2, '2', NULL, 70, 40, '2021-06-09 20:21:47', '2021-07-07 14:26:54'),
(24, 'New Project', '60000.00', '2021-06-29', 2, '2', NULL, 74, 45, '2021-07-14 21:15:55', '2021-07-14 21:19:28'),
(25, 'nrtrt', '35434.00', '2021-06-30', 1, '2', NULL, 71, 41, '2021-07-21 20:06:34', '2021-07-21 20:08:19'),
(26, 'Moringa Project', '20000.00', '2021-04-10', 2, '3', '', 75, 46, '2021-07-21 21:07:00', '2021-07-21 21:29:45'),
(27, 'New Project', '30000.00', '2021-09-04', 2, '3', NULL, 76, 41, '2021-08-05 10:56:09', NULL);

--
-- Triggers `mgf_concept_note`
--
DELIMITER $$
CREATE TRIGGER `after_concept_note_insert` AFTER INSERT ON `mgf_concept_note` FOR EACH ROW BEGIN
  INSERT INTO mgf_screening(criterion,conceptnote_id,organisation_id) 
  VALUES ('Is the Concept Note submitted on the approved E-SAPP template?',new.id,new.organisation_id),    
        ('Have all the sections of the template been completed satisfactorily?',new.id,new.organisation_id),    
        ('Is the proposed project responsive to the E-SAPP MGF objectives i.e. agriculture commercialization, market access, smallholder \r\n        competitiveness, value addition, etc.?',new.id,new.organisation_id),  
        ('Will the proposed project be completed before or by December 2023?',new.id,new.organisation_id), 
        ('Will the project benefit (through contracts or MoUs) a sufficient number of smallholder farmers/producers (at least 200)?',new.id,new.organisation_id),
        ('Does the proposed project fit into the objectives of the MGF window applied under?',new.id,new.organisation_id),
        ('Has the applicant demonstrated enough capacity to implement the proposed project?',new.id,new.organisation_id),  
        ('Does the applicant have necessary experience to implement the proposed project? \r\n        (Not less than 2 years involvement in the type of activities proposed)    \r\n        If No to the above, does the applicant have a suitable technical partner \r\n        with requisite experience; or has provision been made for necessary technical \r\n        assistance under the proposed project?',new.id,new.organisation_id),  
        ('Is the proposed project (potentially) viable technically and financially?',new.id,new.organisation_id),  
        ('Has the applicant submitted application with all required attachments?',new.id,new.organisation_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_contact`
--

CREATE TABLE `mgf_contact` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_contact`
--

INSERT INTO `mgf_contact` (`id`, `first_name`, `last_name`, `mobile`, `tel_no`, `physical_address`, `organisation_id`, `position_id`, `applicant_id`, `date_created`) VALUES
(27, 'Adrian', 'Sinkala', '0977448902', '32467686', 'PA', 35, 1, 19, '2021-05-12 20:26:59'),
(28, 'Farai', 'Sakala', '0977336625', '68567576', 'PA', 35, 2, 19, '2021-05-12 20:27:44'),
(29, 'Daniel', 'Chabala', '0966337289', '667876876', 'A', 37, 1, 21, '2021-05-17 23:55:57'),
(34, 'H', 'M', '0977221190', '2938737', 'Address', 34, 1, 18, '2021-06-09 17:28:14'),
(35, 'J', 'L', '0977338192', '776786781', 'Address', 34, 2, 18, '2021-06-09 17:28:50'),
(37, 'K', 'G', '0977221189', '0398787', 'Address', 40, 2, 39, '2021-06-09 18:33:18'),
(38, 'David', 'Kayula', '0977221920', '38779678934', 'PA', 41, 2, 40, '2021-06-30 11:47:11'),
(39, 'Harry', 'Ndula', '0976112267', '456576576', 'PA', 41, 1, 40, '2021-06-30 11:48:18'),
(40, 'Joseph', 'Kapala', '0977442281', '943884789', 'PA', 42, 1, 41, '2021-06-30 13:13:18'),
(41, 'Kalanda', 'Kapala', '0977112209', '878664990', 'PA', 42, 2, 41, '2021-06-30 13:13:53'),
(42, 'trytr', 'tuty', '568769769', '568658', 'tyhtr', 43, 1, 42, '2021-07-08 13:16:05'),
(43, 'ruyt', 'tru', '5756865', '76575', 'thfg', 43, 2, 42, '2021-07-08 13:16:17'),
(44, 'tuyr', 'uiti', '58657865', '58568', 'gjhj', 45, 1, 45, '2021-07-14 21:15:01'),
(45, '6547rutfj', 'fjfjgfuf', '6785', '687858', 'fyjgd', 45, 2, 45, '2021-07-14 21:15:19'),
(46, 'Harry', 'Tofa', '0977558839', '5436', 'Address 356762', 46, 2, 46, '2021-07-21 20:52:48'),
(47, 'New', 'Boss', '0977112234', '465675', '65656', 46, 1, 46, '2021-07-21 21:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_costs_financing_plan`
--

CREATE TABLE `mgf_costs_financing_plan` (
  `id` int(11) UNSIGNED NOT NULL,
  `componentid` int(11) DEFAULT NULL,
  `activityid` int(11) NOT NULL,
  `item_no` int(11) NOT NULL,
  `input_name` varchar(50) NOT NULL,
  `total_Project_cost` decimal(9,2) NOT NULL,
  `Applicant_in_kind` decimal(9,2) DEFAULT 0.00,
  `Applicant_in_cash` decimal(9,2) NOT NULL DEFAULT 0.00,
  `total_contribution` decimal(9,2) NOT NULL DEFAULT 0.00,
  `mgf_grant` decimal(9,2) NOT NULL DEFAULT 0.00,
  `other_sources` decimal(9,2) DEFAULT 0.00,
  `total` decimal(9,2) DEFAULT 0.00,
  `mgf_as_percent` decimal(9,2) DEFAULT 0.00,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_costs_financing_plan`
--

INSERT INTO `mgf_costs_financing_plan` (`id`, `componentid`, `activityid`, `item_no`, `input_name`, `total_Project_cost`, `Applicant_in_kind`, `Applicant_in_cash`, `total_contribution`, `mgf_grant`, `other_sources`, `total`, `mgf_as_percent`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 36, 57, 1625668301, 'Bricks', '27500.00', '100.00', '100.00', '200.00', '90.00', '70.00', '360.00', '55.56', '2021-07-07 15:59:56', '2021-07-07 15:59:55', 56, 56),
(2, 43, 60, 1626871833, 'Input 1', '280000.00', '4000.00', '5000.00', '9000.00', '10000.00', '2000.00', '21000.00', '42.86', '2021-07-21 12:52:17', '2021-07-21 12:52:17', 56, 56);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_costs_financing_plan_other_sources`
--

CREATE TABLE `mgf_costs_financing_plan_other_sources` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `other_sources_name` varchar(40) NOT NULL,
  `other_sources_amount` decimal(9,2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_cumulative_profit`
--

CREATE TABLE `mgf_cumulative_profit` (
  `id` int(11) UNSIGNED NOT NULL,
  `cumulative_profit_yr1_value` double(9,2) DEFAULT 0.00,
  `cumulative_profit_yr2_value` double(9,2) DEFAULT 0.00,
  `cumulative_profit_yr3_value` double(9,2) DEFAULT 0.00,
  `cumulative_profit_yr4_value` double(9,2) DEFAULT 0.00,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_cumulative_profit`
--

INSERT INTO `mgf_cumulative_profit` (`id`, `cumulative_profit_yr1_value`, `cumulative_profit_yr2_value`, `cumulative_profit_yr3_value`, `cumulative_profit_yr4_value`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 43031.20, 126958.00, 262633.20, 473493.30, 13, '2021-07-27 17:39:32', '2021-07-27 17:39:32', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_district_eligibility`
--

CREATE TABLE `mgf_district_eligibility` (
  `id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `total_submitted` int(11) DEFAULT 0,
  `compliant` int(11) DEFAULT 0,
  `non_compliant` int(11) DEFAULT 0,
  `minutes` text NOT NULL,
  `province_id` int(11) UNSIGNED DEFAULT NULL,
  `district_id` int(11) UNSIGNED DEFAULT NULL,
  `is_active` int(1) DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_district_eligibility`
--

INSERT INTO `mgf_district_eligibility` (`id`, `year_id`, `total_submitted`, `compliant`, `non_compliant`, `minutes`, `province_id`, `district_id`, `is_active`, `date_created`) VALUES
(2, 1, 0, 0, 0, '', 2, 17, 1, '2021-08-05 11:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_eligibility`
--

CREATE TABLE `mgf_eligibility` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `criterion` text DEFAULT NULL,
  `satisfactory` varchar(4) DEFAULT NULL,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `verified_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_eligibility`
--

INSERT INTO `mgf_eligibility` (`id`, `application_id`, `organisation_id`, `criterion`, `satisfactory`, `approve_submittion`, `verified_by`) VALUES
(1, 75, 46, 'Has the applicant fully filled the application form with required attachments?', 'YES', NULL, 'chulu1francis@gmail.'),
(2, 75, 46, 'Is the applicant an appropriate type of organization for the window applied under?', 'YES', NULL, 'chulu1francis@gmail.'),
(3, 75, 46, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', 'YES', NULL, 'chulu1francis@gmail.'),
(4, 75, 46, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', 'YES', NULL, 'chulu1francis@gmail.'),
(5, 75, 46, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', 'YES', NULL, 'chulu1francis@gmail.'),
(6, 75, 46, 'Is the applicant operating as a fully commercial enterprise?', 'YES', NULL, 'chulu1francis@gmail.'),
(7, 75, 46, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', 'YES', NULL, 'chulu1francis@gmail.'),
(8, 75, 46, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', 'YES', NULL, 'chulu1francis@gmail.'),
(9, 75, 46, 'Does the application demonstrate good financial standing of the applicant?', 'YES', NULL, 'chulu1francis@gmail.'),
(10, 75, 46, 'Does the applicant have sound governance and proven management capacity?', 'NO', NULL, 'chulu1francis@gmail.'),
(11, 75, 46, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', 'YES', NULL, 'chulu1francis@gmail.'),
(12, 76, 41, 'Has the applicant fully filled the application form with required attachments?', NULL, NULL, NULL),
(13, 76, 41, 'Is the applicant an appropriate type of organization for the window applied under?', NULL, NULL, NULL),
(14, 76, 41, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', NULL, NULL, NULL),
(15, 76, 41, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', NULL, NULL, NULL),
(16, 76, 41, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', NULL, NULL, NULL),
(17, 76, 41, 'Is the applicant operating as a fully commercial enterprise?', NULL, NULL, NULL),
(18, 76, 41, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', NULL, NULL, NULL),
(19, 76, 41, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', NULL, NULL, NULL),
(20, 76, 41, 'Does the application demonstrate good financial standing of the applicant?', NULL, NULL, NULL),
(21, 76, 41, 'Does the applicant have sound governance and proven management capacity?', NULL, NULL, NULL),
(22, 76, 41, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', NULL, NULL, NULL),
(23, 77, 40, 'Has the applicant fully filled the application form with required attachments?', NULL, NULL, NULL),
(24, 77, 40, 'Is the applicant an appropriate type of organization for the window applied under?', NULL, NULL, NULL),
(25, 77, 40, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', NULL, NULL, NULL),
(26, 77, 40, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', NULL, NULL, NULL),
(27, 77, 40, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', NULL, NULL, NULL),
(28, 77, 40, 'Is the applicant operating as a fully commercial enterprise?', NULL, NULL, NULL),
(29, 77, 40, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', NULL, NULL, NULL),
(30, 77, 40, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', NULL, NULL, NULL),
(31, 77, 40, 'Does the application demonstrate good financial standing of the applicant?', NULL, NULL, NULL),
(32, 77, 40, 'Does the applicant have sound governance and proven management capacity?', NULL, NULL, NULL),
(33, 77, 40, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', NULL, NULL, NULL),
(34, 78, 34, 'Has the applicant fully filled the application form with required attachments?', NULL, NULL, NULL),
(35, 78, 34, 'Is the applicant an appropriate type of organization for the window applied under?', NULL, NULL, NULL),
(36, 78, 34, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', NULL, NULL, NULL),
(37, 78, 34, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', NULL, NULL, NULL),
(38, 78, 34, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', NULL, NULL, NULL),
(39, 78, 34, 'Is the applicant operating as a fully commercial enterprise?', NULL, NULL, NULL),
(40, 78, 34, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', NULL, NULL, NULL),
(41, 78, 34, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', NULL, NULL, NULL),
(42, 78, 34, 'Does the application demonstrate good financial standing of the applicant?', NULL, NULL, NULL),
(43, 78, 34, 'Does the applicant have sound governance and proven management capacity?', NULL, NULL, NULL),
(44, 78, 34, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', NULL, NULL, NULL),
(45, 79, 47, 'Has the applicant fully filled the application form with required attachments?', NULL, NULL, NULL),
(46, 79, 47, 'Is the applicant an appropriate type of organization for the window applied under?', NULL, NULL, NULL),
(47, 79, 47, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', NULL, NULL, NULL),
(48, 79, 47, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', NULL, NULL, NULL),
(49, 79, 47, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', NULL, NULL, NULL),
(50, 79, 47, 'Is the applicant operating as a fully commercial enterprise?', NULL, NULL, NULL),
(51, 79, 47, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', NULL, NULL, NULL),
(52, 79, 47, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', NULL, NULL, NULL),
(53, 79, 47, 'Does the application demonstrate good financial standing of the applicant?', NULL, NULL, NULL),
(54, 79, 47, 'Does the applicant have sound governance and proven management capacity?', NULL, NULL, NULL),
(55, 79, 47, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_eligibility_approval`
--

CREATE TABLE `mgf_eligibility_approval` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `is_active` int(1) DEFAULT 0,
  `scores` varchar(5) DEFAULT '0',
  `review_remark` text DEFAULT NULL,
  `review_submission` timestamp NULL DEFAULT NULL,
  `reviewed_by` varchar(20) DEFAULT NULL,
  `certify_remark` text DEFAULT NULL,
  `certify_submission` timestamp NULL DEFAULT NULL,
  `certified_by` varchar(20) DEFAULT NULL,
  `review2_remark` text DEFAULT NULL,
  `review2_submission` timestamp NULL DEFAULT NULL,
  `reviewed2_by` varchar(20) DEFAULT NULL,
  `approval_remark` text DEFAULT NULL,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `approved_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_eligibility_approval`
--

INSERT INTO `mgf_eligibility_approval` (`id`, `application_id`, `is_active`, `scores`, `review_remark`, `review_submission`, `reviewed_by`, `certify_remark`, `certify_submission`, `certified_by`, `review2_remark`, `review2_submission`, `reviewed2_by`, `approval_remark`, `approve_submittion`, `approved_by`) VALUES
(1, 75, 1, '90.90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_environmental_consideration`
--

CREATE TABLE `mgf_environmental_consideration` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_environmental_consideration`
--

INSERT INTO `mgf_environmental_consideration` (`id`, `description`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 'The cooperative will ensure that environmental concerns are adhered to by employing the following measures: •	Construction: Building permit shall be sought to ensure that all environmental concerns are taken into consideration. •	Pond construction and water rights: The project will work closely with Ministries of Water Development , Fisheries and Livestock  and Zambia Environmental Management Agency  (ZEMA). •	Adherence to EPB/EIA during clearing of land. •	ZABS standards adherence for fish feed production: factory operations (plastic pallets not wooden) •	The cooperative will adhere regulations and procedures regarding management and disposal of by-products the factory will produce.', 13, '2021-07-27 19:29:16', '2021-07-27 19:29:16', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_existing_facilities`
--

CREATE TABLE `mgf_existing_facilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `facility_name` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `use_to_be_made` varchar(100) DEFAULT NULL,
  `estimate_cost` decimal(9,2) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_existing_facilities`
--

INSERT INTO `mgf_existing_facilities` (`id`, `facility_name`, `description`, `quantity`, `use_to_be_made`, `estimate_cost`, `comment`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 'Building', '25 by 30', 1, 'chiken house', '2000.00', 'comment', 13, '2021-07-09 11:49:01', '2021-07-09 11:49:01', 56, NULL),
(2, 'Building', 'For stocking products', 1, 'Used for stocking products', '200000.00', 'comment', 13, '2021-07-20 13:32:52', '2021-07-20 13:32:52', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_expected_beneficiaries`
--

CREATE TABLE `mgf_expected_beneficiaries` (
  `id` int(11) UNSIGNED NOT NULL,
  `type_of_beneficialy` varchar(200) NOT NULL,
  `total_no` int(11) DEFAULT NULL,
  `no_of_women` int(11) DEFAULT NULL,
  `no_of_youth` int(11) DEFAULT NULL,
  `benefits` varchar(100) DEFAULT NULL,
  `sources` varchar(100) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_expected_outputs_and_gross_revenue`
--

CREATE TABLE `mgf_expected_outputs_and_gross_revenue` (
  `id` int(11) UNSIGNED NOT NULL,
  `output_name` varchar(100) NOT NULL,
  `unit_of_measure` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `expected_price` decimal(9,2) DEFAULT NULL,
  `expected_gross_revenue` decimal(9,2) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_expected_outputs_and_gross_revenue`
--

INSERT INTO `mgf_expected_outputs_and_gross_revenue` (`id`, `output_name`, `unit_of_measure`, `quantity`, `expected_price`, `expected_gross_revenue`, `comment`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 'output 1 ', 'count', 3, '6.00', '18.00', 'comment', 13, '2021-07-14 11:15:24', '2021-07-14 11:15:24', 56, NULL),
(2, 'Out Put 2', 'Count', 3, '200.00', '600.00', 'comment 2', 13, '2021-07-20 13:36:51', '2021-07-20 13:36:51', 56, NULL),
(3, 'Dent', 'count', 3, '600.00', '1800.00', 'comment 10', 13, '2021-07-20 18:44:15', '2021-07-20 18:44:15', 56, NULL),
(4, 'OutName', 'Count', 2, '3.00', '6.00', 'comment 10', 13, '2021-07-21 13:08:01', '2021-07-21 13:08:01', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_experience`
--

CREATE TABLE `mgf_experience` (
  `id` int(11) NOT NULL,
  `financed_before` enum('YES','NO') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `any_collaboration` enum('YES','NO') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collaboration_will` enum('YES','NO','N/A') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collaboration_ready` enum('YES','NO') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_experience`
--

INSERT INTO `mgf_experience` (`id`, `financed_before`, `any_collaboration`, `collaboration_will`, `collaboration_ready`, `organisation_id`, `date_created`) VALUES
(13, 'YES', 'YES', 'NO', 'YES', 34, '2021-05-12 17:04:47'),
(14, 'YES', 'YES', 'YES', 'NO', 35, '2021-05-12 20:27:03'),
(15, 'YES', NULL, NULL, NULL, 36, '2021-05-17 09:23:28'),
(16, NULL, NULL, NULL, NULL, 37, '2021-05-17 23:56:08'),
(17, NULL, NULL, NULL, NULL, 38, '2021-05-18 11:06:46'),
(18, NULL, NULL, NULL, NULL, 39, '2021-05-21 14:32:12'),
(19, 'NO', 'NO', 'N/A', 'YES', 40, '2021-06-08 20:21:12'),
(20, 'NO', 'NO', 'NO', 'YES', 41, '2021-06-30 11:46:30'),
(21, 'YES', 'NO', NULL, NULL, 42, '2021-06-30 13:13:58'),
(22, NULL, NULL, NULL, NULL, 43, '2021-07-08 13:16:21'),
(23, 'NO', 'NO', 'NO', 'YES', 45, '2021-07-14 21:15:26'),
(24, 'NO', 'NO', 'NO', 'YES', 46, '2021-07-21 20:39:50'),
(25, NULL, NULL, NULL, NULL, 47, '2021-07-29 20:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_final_evaluation`
--

CREATE TABLE `mgf_final_evaluation` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `finalscore` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT 0,
  `finalcomment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_final_evaluation`
--

INSERT INTO `mgf_final_evaluation` (`id`, `proposal_id`, `organisation_id`, `status`, `finalscore`, `decision`, `notified`, `finalcomment`, `response`, `date_created`) VALUES
(6, 13, 34, 4, '71', 'Deferred', 0, NULL, NULL, '2021-05-12 19:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_implementation_arrangements_cooperating_partners`
--

CREATE TABLE `mgf_implementation_arrangements_cooperating_partners` (
  `id` int(11) UNSIGNED NOT NULL,
  `main_activities` varchar(100) NOT NULL,
  `respobility` varchar(20) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `typee` enum('Staff','Technical Assistance','Collaborating Partners') NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_implementation_arrangements_staff`
--

CREATE TABLE `mgf_implementation_arrangements_staff` (
  `id` int(11) UNSIGNED NOT NULL,
  `main_activities` varchar(100) NOT NULL,
  `respobility` varchar(20) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_implementation_arrangements_technical_assistance`
--

CREATE TABLE `mgf_implementation_arrangements_technical_assistance` (
  `id` int(11) UNSIGNED NOT NULL,
  `main_activities` varchar(100) NOT NULL,
  `respobility` varchar(20) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_implementation_schedule`
--

CREATE TABLE `mgf_implementation_schedule` (
  `id` int(11) UNSIGNED NOT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `yr1qtr1` tinyint(1) DEFAULT 0,
  `yr1qtr2` tinyint(1) DEFAULT 0,
  `yr1qtr3` tinyint(1) DEFAULT 0,
  `yr1qtr4` tinyint(1) DEFAULT 0,
  `yr2qtr1` tinyint(1) DEFAULT 0,
  `yr2qtr2` tinyint(1) DEFAULT 0,
  `yr2qtr3` tinyint(1) DEFAULT 0,
  `yr2qtr4` tinyint(1) DEFAULT 0,
  `yr3qtr1` tinyint(1) DEFAULT 0,
  `yr3qtr2` tinyint(1) DEFAULT 0,
  `yr3qtr3` tinyint(1) DEFAULT 0,
  `yr3qtr4` tinyint(1) DEFAULT 0,
  `yr4qtr1` tinyint(1) DEFAULT 0,
  `yr4qtr2` tinyint(1) DEFAULT 0,
  `yr4qtr3` tinyint(1) DEFAULT 0,
  `yr4qtr4` tinyint(1) DEFAULT 0,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_implementation_schedule`
--

INSERT INTO `mgf_implementation_schedule` (`id`, `activity_id`, `yr1qtr1`, `yr1qtr2`, `yr1qtr3`, `yr1qtr4`, `yr2qtr1`, `yr2qtr2`, `yr2qtr3`, `yr2qtr4`, `yr3qtr1`, `yr3qtr2`, `yr3qtr3`, `yr3qtr4`, `yr4qtr1`, `yr4qtr2`, `yr4qtr3`, `yr4qtr4`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 12, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 13, '2021-07-28 01:03:44', '2021-07-28 01:03:44', 56, NULL),
(2, 13, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 13, '2021-07-28 12:05:42', '2021-07-28 12:05:42', 56, NULL),
(3, 55, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 13, '2021-08-03 18:05:55', '2021-08-03 18:05:55', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_input_cost`
--

CREATE TABLE `mgf_input_cost` (
  `id` int(11) NOT NULL,
  `item_no` int(11) NOT NULL,
  `input_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_cost` decimal(9,2) NOT NULL,
  `project_year_1` decimal(9,2) UNSIGNED DEFAULT NULL,
  `project_year_2` decimal(9,2) UNSIGNED DEFAULT NULL,
  `project_year_3` decimal(9,2) UNSIGNED DEFAULT NULL,
  `project_year_4` decimal(9,2) UNSIGNED DEFAULT NULL,
  `project_year_5` decimal(9,2) UNSIGNED NOT NULL,
  `project_year_6` decimal(9,2) UNSIGNED NOT NULL,
  `project_year_7` decimal(9,2) UNSIGNED NOT NULL,
  `project_year_8` decimal(9,2) UNSIGNED NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_input_cost`
--

INSERT INTO `mgf_input_cost` (`id`, `item_no`, `input_name`, `unit_cost`, `project_year_1`, `project_year_2`, `project_year_3`, `project_year_4`, `project_year_5`, `project_year_6`, `project_year_7`, `project_year_8`, `total_cost`, `comment`, `activity_id`, `date_created`, `createdby`) VALUES
(66, 1620846807, 'item 1', '100.00', '1200.00', '2200.00', '3400.00', '0.00', '0.00', '0.00', '0.00', '0.00', '6800.00', 'c1', 57, '2021-05-12 17:13:27', 56),
(67, 1620846841, 'item 2', '200.00', '4000.00', '6800.00', '2400.00', '0.00', '0.00', '0.00', '0.00', '0.00', '13200.00', 'c2', 57, '2021-05-12 17:14:01', 56),
(68, 1620846895, 'item 1', '150.00', '1500.00', '3450.00', '4500.00', '0.00', '0.00', '0.00', '0.00', '0.00', '9450.00', 'c1', 58, '2021-05-12 17:14:55', 56),
(69, 1620846932, 'item 1', '300.00', '6900.00', '15000.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '51900.00', 'c1', 55, '2021-05-12 17:15:32', 56),
(70, 1620846956, 'item 1', '300.00', '300.00', '600.00', '900.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1800.00', 'c1', 56, '2021-05-12 17:15:56', 56),
(71, 1620846987, 'item 2', '130.00', '4290.00', '4290.00', '5200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '13780.00', 'c2', 56, '2021-05-12 17:16:27', 56),
(72, 1623274562, 'item 1', '200.00', '2400.00', '2800.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5200.00', 'c', 60, '2021-06-09 21:36:02', 88);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_input_item`
--

CREATE TABLE `mgf_input_item` (
  `id` int(11) NOT NULL,
  `item_no` int(11) NOT NULL,
  `input_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_of_measure` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_year_1` decimal(9,2) NOT NULL DEFAULT 0.00,
  `project_year_2` decimal(9,2) DEFAULT 0.00,
  `project_year_3` decimal(9,2) NOT NULL DEFAULT 0.00,
  `project_year_4` decimal(9,2) NOT NULL DEFAULT 0.00,
  `project_year_5` decimal(9,2) UNSIGNED NOT NULL,
  `project_year_6` decimal(9,2) UNSIGNED NOT NULL,
  `project_year_7` decimal(9,2) UNSIGNED NOT NULL,
  `project_year_8` decimal(9,2) UNSIGNED NOT NULL,
  `unit_cost` decimal(9,2) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_input_item`
--

INSERT INTO `mgf_input_item` (`id`, `item_no`, `input_name`, `unit_of_measure`, `project_year_1`, `project_year_2`, `project_year_3`, `project_year_4`, `project_year_5`, `project_year_6`, `project_year_7`, `project_year_8`, `unit_cost`, `total_cost`, `comment`, `activity_id`, `date_created`, `createdby`) VALUES
(66, 1620846807, 'item 1', 'cm', '12.00', '22.00', '34.00', '0.00', '0.00', '0.00', '0.00', '0.00', '100.00', '6800.00', 'c1', 57, '2021-05-12 17:13:27', 56),
(67, 1620846841, 'item 2', 'count', '20.00', '34.00', '12.00', '0.00', '0.00', '0.00', '0.00', '0.00', '200.00', '13200.00', 'c2', 57, '2021-05-12 17:14:01', 56),
(68, 1620846895, 'item 1', 'Kg', '10.00', '23.00', '30.00', '0.00', '0.00', '0.00', '0.00', '0.00', '150.00', '9450.00', 'c1', 58, '2021-05-12 17:14:55', 56),
(69, 1620846932, 'item 1', 'lbs', '23.00', '50.00', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '300.00', '51900.00', 'c1', 55, '2021-05-12 17:15:32', 56),
(70, 1620846956, 'item 1', 'count', '1.00', '2.00', '3.00', '0.00', '0.00', '0.00', '0.00', '0.00', '300.00', '1800.00', 'c1', 56, '2021-05-12 17:15:56', 56),
(71, 1620846987, 'item 2', 'in', '33.00', '33.00', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '130.00', '13780.00', 'c2', 56, '2021-05-12 17:16:27', 56),
(72, 1623274562, 'item 1', 'count', '12.00', '14.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '200.00', '5200.00', 'c', 60, '2021-06-09 21:36:02', 88);

--
-- Triggers `mgf_input_item`
--
DELIMITER $$
CREATE TRIGGER `after_item_input_delete` AFTER DELETE ON `mgf_input_item` FOR EACH ROW BEGIN
	DELETE FROM mgf_input_cost WHERE item_no=old.item_no AND activity_id=old.activity_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_item_input_insert` AFTER INSERT ON `mgf_input_item` FOR EACH ROW BEGIN
INSERT INTO 
mgf_input_cost(item_no,input_name,unit_cost,total_cost,comment,activity_id,createdby) VALUES (new.item_no,new.input_name,new.unit_cost,new.total_cost,new.comment,new.activity_id,new.createdby);

INSERT INTO mgf_costs_financing_plan(item_no,input_name,total_Project_cost,activityid,created_by) VALUES (new.item_no,new.input_name,new.total_cost,new.activity_id,new.createdby);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_item_input_update` AFTER UPDATE ON `mgf_input_item` FOR EACH ROW BEGIN
	UPDATE mgf_input_cost SET input_name=new.input_name, unit_cost=new.unit_cost,total_cost=new.total_cost,comment=new.comment WHERE item_no=new.item_no AND activity_id=new.activity_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_interests_taxes`
--

CREATE TABLE `mgf_interests_taxes` (
  `id` int(11) UNSIGNED NOT NULL,
  `interest_tax_type` enum('Interest','Tax') DEFAULT NULL,
  `interest_tax_percent` double(9,2) DEFAULT 0.00,
  `interest_tax_name` varchar(50) DEFAULT NULL,
  `interest_yr1_value` double(9,2) DEFAULT 0.00,
  `interest_yr2_value` double(9,2) DEFAULT 0.00,
  `interest_yr3_value` double(9,2) DEFAULT 0.00,
  `interest_yr4_value` double(9,2) DEFAULT 0.00,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_interests_taxes`
--

INSERT INTO `mgf_interests_taxes` (`id`, `interest_tax_type`, `interest_tax_percent`, `interest_tax_name`, `interest_yr1_value`, `interest_yr2_value`, `interest_yr3_value`, `interest_yr4_value`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(43, 'Tax', 0.05, 'dog tax', 2264.80, 4417.20, 7140.80, 11097.90, 13, '2021-07-27 17:39:32', '2021-07-27 17:39:32', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_netprofit`
--

CREATE TABLE `mgf_netprofit` (
  `id` int(11) UNSIGNED NOT NULL,
  `netprofit_yr1_value` double(9,2) DEFAULT NULL,
  `netprofit_yr2_value` double(9,2) DEFAULT NULL,
  `netprofit_yr3_value` double(9,2) DEFAULT NULL,
  `netprofit_yr4_value` double(9,2) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_netprofit`
--

INSERT INTO `mgf_netprofit` (`id`, `netprofit_yr1_value`, `netprofit_yr2_value`, `netprofit_yr3_value`, `netprofit_yr4_value`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(13, 43031.20, 83926.80, 135675.20, 210860.10, 13, '2021-07-27 17:39:32', '2021-07-27 17:39:32', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_offer`
--

CREATE TABLE `mgf_offer` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `status` enum('Offer Accepted','Offer Rejected') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amountoffered` decimal(12,2) NOT NULL,
  `contribution` decimal(12,2) NOT NULL,
  `responded` tinyint(1) DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_responde` timestamp NULL DEFAULT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_operation`
--

CREATE TABLE `mgf_operation` (
  `id` int(11) NOT NULL,
  `operation_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_operation`
--

INSERT INTO `mgf_operation` (`id`, `operation_type`, `date_created`) VALUES
(1, 'Agric production', '2021-02-28 15:06:43'),
(2, 'Processing Marketing', '2021-02-28 15:06:43'),
(3, 'Warehousing', '2021-02-28 15:07:18'),
(4, 'Trade Services', '2021-02-28 15:07:18'),
(5, 'Others', '2021-02-28 15:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_organisation`
--

CREATE TABLE `mgf_organisation` (
  `id` int(11) NOT NULL,
  `cooperative` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acronym` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_license_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` date NOT NULL,
  `business_objective` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `physical_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisational_branches` int(1) DEFAULT NULL,
  `tel_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int(11) UNSIGNED DEFAULT NULL,
  `district_id` int(11) UNSIGNED DEFAULT NULL,
  `applicant_id` int(11) NOT NULL,
  `is_active` int(1) DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_organisation`
--

INSERT INTO `mgf_organisation` (`id`, `cooperative`, `acronym`, `registration_type`, `registration_no`, `trade_license_no`, `registration_date`, `business_objective`, `email_address`, `physical_address`, `organisational_branches`, `tel_no`, `fax_no`, `province_id`, `district_id`, `applicant_id`, `is_active`, `date_created`) VALUES
(34, 'Farmer A Cooperative', 'CAFO', 'Type 2', '65768', '45465768', '2000-06-15', 'CBO', 'faco@essap.orgg', 'HPA', 0, '36545768', '', 6, 54, 18, 1, '2021-05-12 17:04:24'),
(35, 'Farmer B Cooperative', 'FBC', 'Type 1', '65767', '46576', '2020-10-05', 'CBO', 'fbc@gmail.com', 'HPA', NULL, '57869534', '', 2, 13, 19, 1, '2021-05-12 20:26:18'),
(36, 'VV Cooperative', 'VVC', 'Type 2', '8758947', '78789', '2020-12-01', 'O', 'vv@email.com', 'A', NULL, '6576', '', 2, 12, 22, 1, '2021-05-17 09:23:21'),
(37, 'Farmer D Cooperative', 'FDC', 'Type 1', '7768756', '58555', '2019-07-31', 'hghk', 'fdc@fdc.com', 'gjhg', NULL, '57658', '', 1, 7, 21, 1, '2021-05-17 23:55:06'),
(38, 'GG Cooperative', 'GGC', 'Type 3', '7987987', '77966', '2020-07-07', 'CBO', 'ggc@gmail.com', 'HPA', NULL, '796856', '', 1, 11, 32, 1, '2021-05-18 11:06:24'),
(39, 'Blessed Hope Cooperative', 'BHC', 'Type 2', '380989', '809990', '2020-04-27', 'CBO', 'bh@email.com', 'HPA', NULL, '0987897989', '', 1, 9, 36, 1, '2021-05-21 14:31:58'),
(40, 'Farmer First', 'FF', '57687', '98987', '46575', '2020-10-28', 'CBO', 'ff@ff.org', 'HPA', 1, '757658', '', 1, 1, 39, 1, '2021-06-08 20:20:35'),
(41, 'Kafala Cooperative', 'KC', '5786876', '8789898', '76589767', '2020-07-26', 'C\r\nB\r\nO', 'kafala@gmail.com', 'H\r\nP\r\nA', NULL, '2876857832', '', 2, 17, 40, 1, '2021-06-30 11:46:21'),
(42, 'Kalanda Cooperative', 'KC', '76557454', '46548765', '57658', '2019-05-08', 'C\r\nB\r\nO', 'kalanda@gmail.com', 'H\r\nP\r\nA', NULL, '78976845', '', 2, 14, 41, 1, '2021-06-30 13:12:47'),
(43, 'Mwango Cooperative', 'MCO', 'Type 2', '768768', '6876', '2021-06-27', 'fgfh', 'mwango@gmail.com', 'fhfg', NULL, '576576', '', 2, 17, 42, 1, '2021-07-08 13:15:44'),
(44, 'My Organisation', 'MO', '6576', '8787', '57686', '2020-10-26', 'CBO', 'mo@esapp.org', 'HPA', NULL, '657687879', '', 2, 16, 44, 1, '2021-07-14 14:51:20'),
(45, 'tyugkhg', 'tuitgiu', 'hkuigkhg', 't87r6u', 'yfuyf', '2021-06-30', 'ghkgkhg', 'ygy@ujj.com', 'jfyyu', NULL, '76567', '', 2, 16, 45, 1, '2021-07-14 21:14:41'),
(46, 'Kaduka Tradings', 'KT', '354657', '76868', '576867', '2021-07-13', 'CBO', 'kaduka@kmail.com', 'HPA', 1, '324327', '46577', 4, 39, 46, 1, '2021-07-21 20:33:20'),
(47, 'Farmer New', 'FN', '3657', '6879', '', '2021-06-28', 'CBO', 'fn@farmer.com', 'HPA', 0, '4768976', '47658769', 1, 6, 47, 1, '2021-07-29 20:10:05');

--
-- Triggers `mgf_organisation`
--
DELIMITER $$
CREATE TRIGGER `after_organisation_insert` AFTER INSERT ON `mgf_organisation` FOR EACH ROW BEGIN
  UPDATE mgf_applicant SET organisation_id=new.id WHERE id=new.applicant_id;  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_organisational_details`
--

CREATE TABLE `mgf_organisational_details` (
  `id` int(11) NOT NULL,
  `mgt_Staff` int(11) NOT NULL,
  `senior_Staff` int(11) NOT NULL,
  `junior_Staff` int(11) NOT NULL,
  `others` int(11) NOT NULL,
  `last_board` date NOT NULL,
  `last_agm` date NOT NULL,
  `last_audit` date NOT NULL,
  `has_finance` enum('YES','NO') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_resources` enum('YES','NO') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisation_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_organisational_details`
--

INSERT INTO `mgf_organisational_details` (`id`, `mgt_Staff`, `senior_Staff`, `junior_Staff`, `others`, `last_board`, `last_agm`, `last_audit`, `has_finance`, `has_resources`, `organisation_id`, `date_created`) VALUES
(10, 4, 10, 30, 4, '2021-05-04', '2021-04-26', '2021-04-26', 'YES', 'YES', 35, '2021-05-12 20:28:42'),
(11, 23, 12, 17, 5, '2021-05-30', '2021-05-30', '2021-05-30', 'YES', 'YES', 34, '2021-06-09 17:29:52'),
(12, 12, 34, 122, 5, '2021-05-30', '2021-05-30', '2021-05-30', 'YES', 'YES', 40, '2021-06-09 18:58:35'),
(13, 6, 4, 2, 10, '2021-05-30', '2021-05-30', '2021-05-30', 'NO', 'NO', 41, '2021-06-30 11:50:20'),
(14, 6, 4, 2, 10, '2021-05-31', '2021-06-07', '2021-05-30', 'YES', 'YES', 42, '2021-06-30 13:15:30'),
(15, 6, 8, 8, 7, '2021-06-29', '2021-06-29', '2021-07-14', 'YES', 'NO', 45, '2021-07-14 21:16:29'),
(16, 8, 3, 12, 4, '2021-04-04', '2021-07-14', '2021-06-30', 'NO', 'YES', 46, '2021-07-21 21:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_partnership`
--

CREATE TABLE `mgf_partnership` (
  `id` int(11) NOT NULL,
  `partner_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partnership_aim` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `partnership_status` enum('On-Going','Completed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_partnership`
--

INSERT INTO `mgf_partnership` (`id`, `partner_name`, `partnership_aim`, `start_date`, `end_date`, `partnership_status`, `experience_id`, `organisation_id`, `date_created`) VALUES
(18, 'partner 1', 'Aim 1', '2019-12-01', '2021-06-05', 'On-Going', 13, 34, '2021-05-12 17:08:27'),
(19, 'partner 2', 'Aim 2', '0000-00-00', '0000-00-00', 'On-Going', 13, 34, '2021-05-17 20:03:39'),
(20, 'Partner 1', 'Good Aim', '2021-05-30', '2021-12-03', 'On-Going', 20, 41, '2021-06-30 11:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_pastproject`
--

CREATE TABLE `mgf_pastproject` (
  `id` int(11) NOT NULL,
  `project_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `years_assisted` int(11) NOT NULL,
  `amount_assisted` decimal(10,0) NOT NULL,
  `obligations_met` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `outcome_response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `experience_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_pastproject`
--

INSERT INTO `mgf_pastproject` (`id`, `project_name`, `years_assisted`, `amount_assisted`, `obligations_met`, `outcome_response`, `organisation_id`, `experience_id`, `date_created`) VALUES
(16, 'Project 1', 2, '30000', 'YES', 'Success', 34, 13, '2021-05-12 17:07:20'),
(17, 'Project 2', 1, '4000', 'NO', 'Fail', 34, 13, '2021-05-12 17:07:46'),
(19, 'First Project', 2, '20000', 'YES', 'Result', 42, 21, '2021-06-30 13:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_position`
--

CREATE TABLE `mgf_position` (
  `id` int(11) NOT NULL,
  `position` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_position`
--

INSERT INTO `mgf_position` (`id`, `position`, `date_created`) VALUES
(1, 'CEO', '2021-03-04 23:49:33'),
(2, 'Board Chairman', '2021-03-05 12:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_product_market_marketing`
--

CREATE TABLE `mgf_product_market_marketing` (
  `id` int(11) UNSIGNED NOT NULL,
  `marketing` varchar(200) NOT NULL,
  `market_outlets` varchar(100) DEFAULT NULL,
  `sales_contract` varchar(100) DEFAULT NULL,
  `person_responsible` varchar(50) DEFAULT NULL,
  `competition_penetration` varchar(100) DEFAULT NULL,
  `future_prospects` varchar(100) DEFAULT NULL,
  `branding_market_penetration` varchar(100) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_product_market_marketing`
--

INSERT INTO `mgf_product_market_marketing` (`id`, `marketing`, `market_outlets`, `sales_contract`, `person_responsible`, `competition_penetration`, `future_prospects`, `branding_market_penetration`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 'ddd', 'ddd', 'dddd', 'ddd', 'ddd', 'ddd', 'dddd', 14, '2021-07-27 20:50:59', '2021-07-19 20:50:59', 66, NULL),
(2, 'Jc', 'JC', 'Cj', 'KK', 'MN', 'Kl', 'MNbb', 13, '2021-07-19 20:56:26', '2021-07-19 20:56:26', 56, NULL),
(3, 'marketing 1', 'Market Outlet 1', 'Sales Contract', 'Manager', 'No competition', 'Future prospects', 'Branding', 13, '2021-07-19 21:06:12', '2021-07-19 21:06:12', 56, NULL),
(4, 'maammm', 'Lusaka', 'with zambia revenuw Authority', 'Director', 'With ZAU', 'Very Bright', 'We brand our products very well', 13, '2021-07-20 10:28:57', '2021-07-20 10:28:57', 56, NULL),
(5, 'Marketing 3', 'Marketing outlet 3', 'Sales Contract', 'Manager', 'Competition and penetration', 'Future prospects 2', 'Market brand', 13, '2021-07-20 13:53:26', '2021-07-20 13:53:26', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_profit_before_interest_taxes`
--

CREATE TABLE `mgf_profit_before_interest_taxes` (
  `id` int(11) UNSIGNED NOT NULL,
  `profit_yr1_value` double(9,2) DEFAULT 0.00,
  `profit_yr2_value` double(9,2) DEFAULT 0.00,
  `profit_yr3_value` double(9,2) DEFAULT 0.00,
  `profit_yr4_value` double(9,2) DEFAULT 0.00,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_profit_before_interest_taxes`
--

INSERT INTO `mgf_profit_before_interest_taxes` (`id`, `profit_yr1_value`, `profit_yr2_value`, `profit_yr3_value`, `profit_yr4_value`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(6, 45296.00, 88344.00, 142816.00, 221958.00, 13, '2021-07-25 22:15:25', '2021-07-25 22:15:25', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_project_evaluation`
--

CREATE TABLE `mgf_project_evaluation` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `window` enum('1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `observation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `declaration` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalscore` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `decision` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_submitted` timestamp NULL DEFAULT NULL,
  `date_reviewed` timestamp NULL DEFAULT NULL,
  `reviewedby` int(11) NOT NULL,
  `signature` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_project_evaluation`
--

INSERT INTO `mgf_project_evaluation` (`id`, `proposal_id`, `organisation_id`, `window`, `status`, `observation`, `declaration`, `totalscore`, `decision`, `date_created`, `date_submitted`, `date_reviewed`, `reviewedby`, `signature`) VALUES
(62, 13, 34, '1', 4, 'O', 'D', '65', 'Differed', '2021-05-12 19:07:08', '2021-05-12 17:43:40', '2021-05-12 19:22:59', 58, 'S'),
(63, 13, 34, '1', 2, 'O', 'D', '72', 'Recommended', '2021-05-12 19:14:34', '2021-05-12 17:43:40', '2021-05-12 20:02:24', 63, 'S'),
(64, 13, 34, '1', 4, 'O', 'D', '65', 'Differed', '2021-05-12 19:14:47', '2021-05-12 17:43:40', '2021-05-12 20:05:01', 64, 'S'),
(114, 17, 40, '2', 0, NULL, NULL, '28', NULL, '2021-08-05 10:33:37', '2021-07-14 21:06:51', NULL, 135, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_project_facilities`
--

CREATE TABLE `mgf_project_facilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `facilityname` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `facility_use` varchar(150) DEFAULT NULL,
  `estimated_cost` decimal(9,2) NOT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_project_risks_and_mitigation_measures`
--

CREATE TABLE `mgf_project_risks_and_mitigation_measures` (
  `id` int(11) UNSIGNED NOT NULL,
  `expected_risks` varchar(200) DEFAULT NULL,
  `consequences_of_risk` varchar(200) DEFAULT NULL,
  `mitigation_measures_planned` varchar(200) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_project_risks_and_mitigation_measures`
--

INSERT INTO `mgf_project_risks_and_mitigation_measures` (`id`, `expected_risks`, `consequences_of_risk`, `mitigation_measures_planned`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 'ththth', 'vbvbvb', 'plllll', 13, '2021-07-27 21:36:43', '2021-07-27 21:36:43', 56, NULL),
(1, 'ththth', 'vbvbvb', 'plllll', 13, '2021-07-27 19:36:43', '2021-07-27 19:36:43', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_proposal`
--

CREATE TABLE `mgf_proposal` (
  `id` int(11) NOT NULL,
  `project_title` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mgf_no` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `applicant_type` enum('Category-A','Category-B') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date DEFAULT NULL,
  `project_length` int(11) NOT NULL DEFAULT 0,
  `number_reviewers` int(11) NOT NULL DEFAULT 0,
  `project_operations` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `any_experience` enum('YES','NO','N/A') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_response` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indicate_partnerships` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposal_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Created',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_submitted` timestamp NULL DEFAULT NULL,
  `problem_statement` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overall_objective` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(1) DEFAULT 0,
  `totalcost` decimal(15,2) DEFAULT 0.00,
  `province_id` int(11) UNSIGNED DEFAULT NULL,
  `district_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_proposal`
--

INSERT INTO `mgf_proposal` (`id`, `project_title`, `mgf_no`, `organisation_id`, `applicant_type`, `starting_date`, `ending_date`, `project_length`, `number_reviewers`, `project_operations`, `any_experience`, `experience_response`, `indicate_partnerships`, `proposal_status`, `date_created`, `date_submitted`, `problem_statement`, `overall_objective`, `is_active`, `totalcost`, `province_id`, `district_id`) VALUES
(13, 'Apple Project', '1620846711', 34, 'Category-A', '2021-06-04', '2024-06-04', 3, 3, 'Agric production', 'YES', 'EE', '', 'Submitted', '2021-05-12 17:11:51', '2021-06-09 18:18:21', 'PS', 'OO', 0, '96930.00', 6, 54),
(14, 'Cassava Project', '1623272844', 35, 'Category-B', '2021-04-25', '2023-04-25', 2, 0, 'Agric production', NULL, NULL, NULL, 'Created', '2021-05-13 05:53:28', NULL, NULL, NULL, 0, '30000.00', 2, 13),
(15, 'Banana Project', '1621705574', 37, 'Category-B', '2021-05-29', '2023-05-29', 2, 0, 'Agric production', NULL, NULL, NULL, 'Created', '2021-05-22 17:46:14', NULL, NULL, NULL, 0, '5000.00', 1, 7),
(16, 'BHC project 1', '1621705874', 39, NULL, '2021-05-29', '2024-05-29', 3, 0, 'Trade Services', NULL, NULL, NULL, 'Created', '2021-05-22 17:51:15', NULL, NULL, NULL, 0, '40000.00', 1, 9),
(17, 'Orange Project', '1623272852', 40, 'Category-B', '2021-06-26', '2023-06-26', 2, 1, 'Processing Marketing', 'YES', 'Elaboration', NULL, 'Under_Review', '2021-06-09 21:07:32', '2021-07-14 21:06:51', 'PS', 'OO', 1, '5200.00', 1, 1),
(18, 'Potato project', 'farmerA', 34, 'Category-A', '2021-08-07', '2023-08-07', 2, 0, 'Processing Marketing', 'YES', 'tyutu', NULL, 'Created', '2021-07-19 16:52:53', NULL, 'uyt', 'utyu', 1, '0.00', 6, 54);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_proposal_evaluation`
--

CREATE TABLE `mgf_proposal_evaluation` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `awardedscore` int(2) DEFAULT NULL,
  `grade` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_proposal_evaluation`
--

INSERT INTO `mgf_proposal_evaluation` (`id`, `proposal_id`, `criterion_id`, `awardedscore`, `grade`, `comment`, `date_created`, `createdby`) VALUES
(450, 13, 3, 3, 'Moderately', 'comment1', '2021-05-12 19:16:39', 58),
(451, 13, 4, 8, 'Highly', 'comment2', '2021-05-12 19:16:39', 58),
(452, 13, 5, 2, 'Little', 'comment4', '2021-05-12 19:16:39', 58),
(453, 13, 6, 5, 'Excellent in all respects', NULL, '2021-05-12 19:16:39', 58),
(454, 13, 7, 4, 'Very well', NULL, '2021-05-12 19:16:39', 58),
(455, 13, 8, 8, 'Appropriate attention and resources allocated', NULL, '2021-05-12 19:16:39', 58),
(456, 13, 9, 2, 'Realistic but fail to accommodate delay', NULL, '2021-05-12 19:16:39', 58),
(457, 13, 10, 8, 'Very satisfactory', NULL, '2021-05-12 19:16:39', 58),
(458, 13, 11, 4, 'Between 1-2 years', NULL, '2021-05-12 19:16:39', 58),
(459, 13, 12, 4, '500 - 799', 'comment5', '2021-05-12 19:16:39', 58),
(460, 13, 13, 4, '30 â€“ 50%', NULL, '2021-05-12 19:16:39', 58),
(461, 13, 14, 1, 'Less than 15%', NULL, '2021-05-12 19:16:39', 58),
(462, 13, 15, 1, 'Less than 10%', NULL, '2021-05-12 19:16:39', 58),
(463, 13, 16, 4, 'Very much', NULL, '2021-05-12 19:16:39', 58),
(464, 13, 17, 2, '10 â€“ 30 new employment', NULL, '2021-05-12 19:16:39', 58),
(465, 13, 18, 1, 'Very little attention', NULL, '2021-05-12 19:16:39', 58),
(466, 13, 19, 4, 'Satisfactorily addressed', NULL, '2021-05-12 19:16:39', 58),
(467, 13, 3, 4, 'Highly', NULL, '2021-05-12 19:47:18', 62),
(468, 13, 4, 10, 'Extremely Well', NULL, '2021-05-12 19:47:19', 62),
(469, 13, 5, 4, 'Clear and highly responsive', NULL, '2021-05-12 19:47:19', 62),
(470, 13, 6, 5, 'Excellent in all respects', NULL, '2021-05-12 19:47:19', 62),
(471, 13, 7, 4, 'Very well', NULL, '2021-05-12 19:47:19', 62),
(472, 13, 8, 8, 'Appropriate attention and resources allocated', NULL, '2021-05-12 19:47:19', 62),
(473, 13, 9, 5, 'Much more realistic/Very much realistic', NULL, '2021-05-12 19:47:19', 62),
(474, 13, 10, 8, 'Very satisfactory', NULL, '2021-05-12 19:47:19', 62),
(475, 13, 11, 5, 'Within 1 year', NULL, '2021-05-12 19:47:19', 62),
(476, 13, 12, 2, '200 - 499', NULL, '2021-05-12 19:47:19', 62),
(477, 13, 13, 5, 'Over 50%', NULL, '2021-05-12 19:47:20', 62),
(478, 13, 14, 5, 'Over 30%', NULL, '2021-05-12 19:47:20', 62),
(479, 13, 15, 4, '20 â€“ 30%', NULL, '2021-05-12 19:47:20', 62),
(480, 13, 16, 4, 'Very much', NULL, '2021-05-12 19:47:20', 62),
(481, 13, 17, 2, '10 â€“ 30 new employment', NULL, '2021-05-12 19:47:20', 62),
(482, 13, 18, 3, 'Appropriate', NULL, '2021-05-12 19:47:20', 62),
(483, 13, 19, 4, 'Satisfactorily addressed', NULL, '2021-05-12 19:47:20', 62),
(484, 13, 3, 4, 'Highly', NULL, '2021-05-12 20:01:36', 63),
(485, 13, 4, 10, 'Extremely Well', NULL, '2021-05-12 20:01:36', 63),
(486, 13, 5, 4, 'Clear and highly responsive', NULL, '2021-05-12 20:01:36', 63),
(487, 13, 6, 0, 'Vague/difficult to relate to technology', NULL, '2021-05-12 20:01:36', 63),
(488, 13, 7, 4, 'Very well', NULL, '2021-05-12 20:01:37', 63),
(489, 13, 8, 8, 'Appropriate attention and resources allocated', NULL, '2021-05-12 20:01:37', 63),
(490, 13, 9, 2, 'Realistic but fail to accommodate delay', NULL, '2021-05-12 20:01:37', 63),
(491, 13, 10, 8, 'Very satisfactory', NULL, '2021-05-12 20:01:37', 63),
(492, 13, 11, 4, 'Between 1-2 years', NULL, '2021-05-12 20:01:37', 63),
(493, 13, 12, 4, '500 - 799', NULL, '2021-05-12 20:01:37', 63),
(494, 13, 13, 4, '30 â€“ 50%', NULL, '2021-05-12 20:01:37', 63),
(495, 13, 14, 4, '20 â€“ 30%', NULL, '2021-05-12 20:01:37', 63),
(496, 13, 15, 4, '20 â€“ 30%', NULL, '2021-05-12 20:01:37', 63),
(497, 13, 16, 5, 'Extremely well', NULL, '2021-05-12 20:01:37', 63),
(498, 13, 17, 2, '10 â€“ 30 new employment', NULL, '2021-05-12 20:01:37', 63),
(499, 13, 18, 1, 'Very little attention', NULL, '2021-05-12 20:01:37', 63),
(500, 13, 19, 4, 'Satisfactorily addressed', NULL, '2021-05-12 20:01:37', 63),
(501, 13, 3, 0, 'Poorly', NULL, '2021-05-12 20:03:37', 64),
(502, 13, 4, 6, 'Moderately', NULL, '2021-05-12 20:03:37', 64),
(503, 13, 5, 2, 'Little', NULL, '2021-05-12 20:03:37', 64),
(504, 13, 6, 2, 'Very little', NULL, '2021-05-12 20:03:37', 64),
(505, 13, 7, 5, 'Highly responsive', NULL, '2021-05-12 20:03:37', 64),
(506, 13, 8, 8, 'Appropriate attention and resources allocated', NULL, '2021-05-12 20:03:37', 64),
(507, 13, 9, 2, 'Realistic but fail to accommodate delay', NULL, '2021-05-12 20:03:38', 64),
(508, 13, 10, 8, 'Very satisfactory', NULL, '2021-05-12 20:03:38', 64),
(509, 13, 11, 3, 'After 2 years', NULL, '2021-05-12 20:03:38', 64),
(510, 13, 12, 5, '800 - 1000', NULL, '2021-05-12 20:03:38', 64),
(511, 13, 13, 4, '30 â€“ 50%', NULL, '2021-05-12 20:03:38', 64),
(512, 13, 14, 5, 'Over 30%', NULL, '2021-05-12 20:03:38', 64),
(513, 13, 15, 2, '15 â€“ 19%', NULL, '2021-05-12 20:03:38', 64),
(514, 13, 16, 1, 'Very little', NULL, '2021-05-12 20:03:38', 64),
(515, 13, 17, 5, 'Over 50 new employment', NULL, '2021-05-12 20:03:38', 64),
(516, 13, 18, 3, 'Appropriate', NULL, '2021-05-12 20:03:38', 64),
(517, 13, 19, 4, 'Satisfactorily addressed', NULL, '2021-05-12 20:03:38', 64),
(518, 17, 3, 0, 'Poorly', NULL, '2021-08-05 10:33:53', 135),
(519, 17, 4, 4, 'Little', NULL, '2021-08-05 10:33:54', 135),
(520, 17, 5, 2, 'Little', NULL, '2021-08-05 10:33:54', 135),
(521, 17, 6, 2, 'Very little', NULL, '2021-08-05 10:33:54', 135),
(522, 17, 7, 2, 'Moderately', NULL, '2021-08-05 10:33:54', 135),
(523, 17, 8, 8, 'Appropriate attention and resources allocated', NULL, '2021-08-05 10:33:54', 135),
(524, 17, 9, 2, 'Realistic but fail to accommodate delay', NULL, '2021-08-05 10:33:54', 135),
(525, 17, 10, 0, 'No evidence', NULL, '2021-08-05 10:33:54', 135),
(526, 17, 11, 1, 'After 3 years', NULL, '2021-08-05 10:33:54', 135),
(527, 17, 12, 1, 'Less than 200', NULL, '2021-08-05 10:33:55', 135),
(528, 17, 13, 1, 'Less than 10%', NULL, '2021-08-05 10:33:55', 135),
(529, 17, 14, 1, 'Less than 15%', NULL, '2021-08-05 10:33:55', 135),
(530, 17, 15, 1, 'Less than 10%', NULL, '2021-08-05 10:33:55', 135),
(531, 17, 16, 1, 'Very little', NULL, '2021-08-05 10:33:55', 135),
(532, 17, 17, 1, 'Less than 10 persons employed', NULL, '2021-08-05 10:33:55', 135),
(533, 17, 18, 0, 'No attention is given', NULL, '2021-08-05 10:33:55', 135),
(534, 17, 19, 1, 'To a limited extent', NULL, '2021-08-05 10:33:55', 135);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_reviewer`
--

CREATE TABLE `mgf_reviewer` (
  `id` int(11) NOT NULL,
  `title` enum('Mr.','Mrs.','Ms.','Miss.','Dr.','Prof.','Rev.') DEFAULT NULL,
  `login_code` varchar(50) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `reviewer_type` enum('Internal','External') DEFAULT NULL,
  `area_of_expertise` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `confirmed` int(11) DEFAULT 0,
  `createdBy` int(11) UNSIGNED DEFAULT NULL,
  `total_assigned_1` int(11) DEFAULT 0,
  `total_assigned_2` int(11) DEFAULT 0,
  `email` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mgf_reviewer`
--

INSERT INTO `mgf_reviewer` (`id`, `title`, `login_code`, `first_name`, `last_name`, `mobile`, `reviewer_type`, `area_of_expertise`, `user_id`, `confirmed`, `createdBy`, `total_assigned_1`, `total_assigned_2`, `email`, `date_created`) VALUES
(38, 'Dr.', 'rev1', 'Garry', 'Kapaya', '0955336672', 'External', 'Agric production', 58, 0, 15, 1, 0, 'garr@test.com', '2021-04-28 20:27:43'),
(39, NULL, 'rev2', 'Susan', 'Kalenga', '0978119920', 'Internal', 'Agric production', 59, 0, 15, 0, 0, 'sue@test.com', '2021-04-28 20:28:37'),
(40, NULL, 'rev3', 'Fatima', 'Josh', '0966227718', 'Internal', 'Agric production', 62, 0, 15, 0, 0, 'josh@essap.org', '2021-05-12 15:02:13'),
(41, 'Mrs.', 'rev4', 'Nandipa', 'Kamfwa', '0977339929', 'External', 'Processing Marketing', 63, 0, 15, 1, 0, 'nk@gmai.com', '2021-05-12 19:08:52'),
(42, 'Mr.', 'rev5', 'Harry', 'Mwanga', '0971662267', 'External', 'Processing Marketing', 64, 0, 15, 1, 0, 'hm@email.com', '2021-05-12 19:12:49'),
(43, 'Mrs.', '26719', 'B', 'M', '0977221891', 'Internal', 'Processing Marketing', 81, 0, 1, 0, 0, 'bm@esapp.org', '2021-06-08 17:56:58'),
(44, 'Mr.', 'rev6', 'Vincent', 'Chama', '0977338829', 'Internal', 'Warehousing', 90, 0, 1, 0, 0, 'rev6@gmail.com', '2021-06-20 18:37:08'),
(45, 'Ms.', 'rev7rev', 'Chanda', 'Chalwe', '0977443378', 'Internal', 'Trade Services', 91, 0, 1, 0, 0, 'rev7rev@gmail.com', '2021-06-20 18:40:03'),
(46, 'Mrs.', 'erwerew', 'ere', 'rewr', 'ewrew', 'Internal', 'Agric production', 92, 0, 1, 0, 0, 'erew@gmail.com', '2021-06-20 18:44:59'),
(47, 'Mr.', 'tretreter', 'tret', 'reter', 'erter', 'Internal', 'Agric production', 93, 0, 1, 0, 0, 'dfdsfg@hmail.com', '2021-06-20 18:46:13'),
(48, 'Ms.', '327687', 'M', 'J', '0977338120', 'Internal', 'Agric production', 94, 0, 1, 0, 0, 'hhghjg@fgh.com', '2021-06-20 18:50:04'),
(49, 'Ms.', '4354354', 'wert', 'rtre', '43543', 'Internal', 'Agric production', 95, 0, 1, 0, 0, 'dfdg@hmail.com', '2021-06-20 18:52:20'),
(50, 'Miss.', '78678', 'Kaale', 'Kuli', '0955229903', 'Internal', 'Processing Marketing', 1624215976, 0, 1, 0, 0, 'dida@gmail.com', '2021-06-20 19:06:16'),
(51, 'Mr.', '6547457', 'wtret', 'retret', '546457657', 'External', 'Processing Marketing', 1624216164, 0, 1, 0, 0, 'ff@jmail.com', '2021-06-20 19:09:24'),
(52, NULL, 'dbhbjhd', 'eret', 'ertret', '0933772281', 'Internal', 'Agric production', 104, 0, 1, 0, 0, 'hhggf@gg.com', '2021-06-20 20:26:01'),
(53, NULL, 'dbhbjhd0', 'ytry', 'tyr', '+260966111029', 'Internal', 'Agric production', 110, 0, 1, 0, 0, 'hggf@gg.com', '2021-06-20 20:38:09'),
(54, NULL, 'dbhbjhd43', 'ryhtf', 'hgfhfg', '+260988221109', 'Internal', 'Agric production', 111, 0, 1, 0, 0, 'tester4@gmail.com', '2021-06-20 20:39:47'),
(55, NULL, '1624222162+260966447783', 'rtre', 'rtery', '+260966447783', 'Internal', 'Agric production', 114, 0, 1, 0, 0, 'tester7@gmail.com', '2021-06-20 20:49:22'),
(56, 'Mr.', '1624222304+260977332289', 'dd', 'fgf', '+260977332289', 'Internal', 'Trade Services', 115, 0, 1, 0, 0, 'tester8@gmail.com', '2021-06-20 20:51:44'),
(57, 'Mr.', '+260977112289', 'hj', 'kjh', '+260977112289', 'Internal', 'Trade Services', 125, 0, 1, 0, 0, 'rev2@mgf.com', '2021-07-13 11:55:02'),
(58, NULL, '+260966221178', 'Kalemba', 'Kalemba', '+260966221178', NULL, '', 126, 0, 1, 0, 0, 'rev3@mgf.com', '2021-07-13 11:58:45'),
(59, NULL, '+260977221156', 'New', 'Reviewer', '+260977221156', NULL, '', 133, 0, 1, 0, 0, 'newrev@hmail.com', '2021-08-05 10:14:13'),
(60, NULL, '+260977119900', 'Reviewer', 'Reviewer', '+260977119900', NULL, '', 134, 0, 1, 0, 0, 'rev4@mgf.com', '2021-08-05 10:23:11'),
(61, NULL, '+260955117782', 'Tayali', 'Kola', '+260955117782', NULL, '', 135, 0, 1, 0, 1, 'kola@hmail.com', '2021-08-05 10:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_screening`
--

CREATE TABLE `mgf_screening` (
  `id` int(11) NOT NULL,
  `conceptnote_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `criterion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satisfactory` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_submittion` timestamp NULL DEFAULT NULL,
  `verified_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_screening`
--

INSERT INTO `mgf_screening` (`id`, `conceptnote_id`, `organisation_id`, `criterion`, `satisfactory`, `approve_submittion`, `verified_by`) VALUES
(188, 18, 35, 'Has the applicant fully filled the application form with required attachments?', 'YES', NULL, 'rev5'),
(189, 18, 35, 'Is the applicant an appropriate type of organization for the window applied under?', 'YES', NULL, 'rev5'),
(190, 18, 35, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', 'YES', NULL, 'rev5'),
(191, 18, 35, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', 'YES', NULL, 'rev5'),
(192, 18, 35, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', 'YES', NULL, 'rev5'),
(193, 18, 35, 'Is the applicant operating as a fully commercial enterprise?', 'NO', NULL, 'rev5'),
(194, 18, 35, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', 'NO', NULL, 'rev5'),
(195, 18, 35, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', 'YES', NULL, 'rev5'),
(196, 18, 35, 'Does the application demonstrate good financial standing of the applicant?', 'YES', NULL, 'rev5'),
(197, 18, 35, 'Does the applicant have sound governance and proven management capacity?', 'YES', NULL, 'rev5'),
(198, 18, 35, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', 'NO', NULL, 'rev5'),
(199, 19, 37, 'Has the applicant fully filled the application form with required attachments?', 'NO', NULL, 'chulu1francis@gmail.'),
(200, 19, 37, 'Is the applicant an appropriate type of organization for the window applied under?', 'YES', NULL, 'chulu1francis@gmail.'),
(201, 19, 37, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', 'NO', NULL, 'chulu1francis@gmail.'),
(202, 19, 37, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', 'YES', NULL, 'chulu1francis@gmail.'),
(203, 19, 37, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', 'YES', NULL, 'chulu1francis@gmail.'),
(204, 19, 37, 'Is the applicant operating as a fully commercial enterprise?', 'YES', NULL, 'chulu1francis@gmail.'),
(205, 19, 37, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', 'YES', NULL, 'chulu1francis@gmail.'),
(206, 19, 37, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', 'YES', NULL, 'chulu1francis@gmail.'),
(207, 19, 37, 'Does the application demonstrate good financial standing of the applicant?', 'YES', NULL, 'chulu1francis@gmail.'),
(208, 19, 37, 'Does the applicant have sound governance and proven management capacity?', 'YES', NULL, 'chulu1francis@gmail.'),
(209, 19, 37, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', 'NO', NULL, 'chulu1francis@gmail.'),
(210, 20, 38, 'Has the applicant fully filled the application form with required attachments?', 'YES', NULL, 'chulu1francis@gmail.'),
(211, 20, 38, 'Is the applicant an appropriate type of organization for the window applied under?', 'NO', NULL, 'chulu1francis@gmail.'),
(212, 20, 38, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', 'YES', NULL, 'chulu1francis@gmail.'),
(213, 20, 38, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', 'YES', NULL, 'chulu1francis@gmail.'),
(214, 20, 38, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', 'YES', NULL, 'chulu1francis@gmail.'),
(215, 20, 38, 'Is the applicant operating as a fully commercial enterprise?', 'YES', NULL, 'chulu1francis@gmail.'),
(216, 20, 38, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', 'NO', NULL, 'chulu1francis@gmail.'),
(217, 20, 38, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', 'YES', NULL, 'chulu1francis@gmail.'),
(218, 20, 38, 'Does the application demonstrate good financial standing of the applicant?', 'YES', NULL, 'chulu1francis@gmail.'),
(219, 20, 38, 'Does the applicant have sound governance and proven management capacity?', 'YES', NULL, 'chulu1francis@gmail.'),
(220, 20, 38, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', 'YES', NULL, 'chulu1francis@gmail.'),
(221, 21, 39, 'Has the applicant fully filled the application form with required attachments?', 'YES', NULL, 'chulu1francis@gmail.'),
(222, 21, 39, 'Is the applicant an appropriate type of organization for the window applied under?', 'YES', NULL, 'chulu1francis@gmail.'),
(223, 21, 39, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', 'YES', NULL, 'chulu1francis@gmail.'),
(224, 21, 39, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', 'NO', NULL, 'chulu1francis@gmail.'),
(225, 21, 39, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', 'YES', NULL, 'chulu1francis@gmail.'),
(226, 21, 39, 'Is the applicant operating as a fully commercial enterprise?', 'YES', NULL, 'chulu1francis@gmail.'),
(227, 21, 39, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', 'YES', NULL, 'chulu1francis@gmail.'),
(228, 21, 39, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', 'YES', NULL, 'chulu1francis@gmail.'),
(229, 21, 39, 'Does the application demonstrate good financial standing of the applicant?', 'YES', NULL, 'chulu1francis@gmail.'),
(230, 21, 39, 'Does the applicant have sound governance and proven management capacity?', 'NO', NULL, 'chulu1francis@gmail.'),
(231, 21, 39, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', 'YES', NULL, 'chulu1francis@gmail.'),
(232, 22, 37, 'Has the applicant fully filled the application form with required attachments?', NULL, NULL, NULL),
(233, 22, 37, 'Is the applicant an appropriate type of organization for the window applied under?', NULL, NULL, NULL),
(234, 22, 37, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', NULL, NULL, NULL),
(235, 22, 37, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', NULL, NULL, NULL),
(236, 22, 37, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', NULL, NULL, NULL),
(237, 22, 37, 'Is the applicant operating as a fully commercial enterprise?', NULL, NULL, NULL),
(238, 22, 37, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', NULL, NULL, NULL),
(239, 22, 37, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', NULL, NULL, NULL),
(240, 22, 37, 'Does the application demonstrate good financial standing of the applicant?', NULL, NULL, NULL),
(241, 22, 37, 'Does the applicant have sound governance and proven management capacity?', NULL, NULL, NULL),
(242, 22, 37, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', NULL, NULL, NULL),
(243, 23, 40, 'Has the applicant fully filled the application form with required attachments?', 'NO', NULL, 'chulu1francis@gmail.'),
(244, 23, 40, 'Is the applicant an appropriate type of organization for the window applied under?', 'YES', NULL, 'chulu1francis@gmail.'),
(245, 23, 40, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', 'YES', NULL, 'chulu1francis@gmail.'),
(246, 23, 40, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', 'YES', NULL, 'chulu1francis@gmail.'),
(247, 23, 40, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', 'YES', NULL, 'chulu1francis@gmail.'),
(248, 23, 40, 'Is the applicant operating as a fully commercial enterprise?', 'YES', NULL, 'chulu1francis@gmail.'),
(249, 23, 40, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', 'YES', NULL, 'chulu1francis@gmail.'),
(250, 23, 40, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', 'YES', NULL, 'chulu1francis@gmail.'),
(251, 23, 40, 'Does the application demonstrate good financial standing of the applicant?', 'YES', NULL, 'chulu1francis@gmail.'),
(252, 23, 40, 'Does the applicant have sound governance and proven management capacity?', 'YES', NULL, 'chulu1francis@gmail.'),
(253, 23, 40, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', 'NO', NULL, 'chulu1francis@gmail.'),
(254, 24, 45, 'Has the applicant fully filled the application form with required attachments?', NULL, NULL, NULL),
(255, 24, 45, 'Is the applicant an appropriate type of organization for the window applied under?', NULL, NULL, NULL),
(256, 24, 45, 'Is the applicant legally registered in Zambia to do business in agriculture/agribusiness?', NULL, NULL, NULL),
(257, 24, 45, 'Has the applicant been operating in the value chains of focus for E-SAPP (minimum two years)?', NULL, NULL, NULL),
(258, 24, 45, 'Has the applicant been collaborating or intends to collaborate with smallholders/producers?', NULL, NULL, NULL),
(259, 24, 45, 'Is the applicant operating as a fully commercial enterprise?', NULL, NULL, NULL),
(260, 24, 45, 'Have the key staff/members provided training in farming as a business to smallholder farmers or is organization ready to provide FaaB training if required?', NULL, NULL, NULL),
(261, 24, 45, 'Has the applicant demonstrated capacity to make required contribution in cash or kind or both?', NULL, NULL, NULL),
(262, 24, 45, 'Does the application demonstrate good financial standing of the applicant?', NULL, NULL, NULL),
(263, 24, 45, 'Does the applicant have sound governance and proven management capacity?', NULL, NULL, NULL),
(264, 24, 45, 'Has an appropriate body within the organization approved the decision to apply for a grant under the E-SAPP?', NULL, NULL, NULL),
(265, 25, 41, 'Is the Concept Note submitted on the approved E-SAPP template?', 'YES', NULL, 'chulu1francis@gmail.'),
(266, 25, 41, 'Have all the sections of the template been completed satisfactorily?', 'NO', NULL, 'chulu1francis@gmail.'),
(267, 25, 41, 'Is the proposed project responsive to the E-SAPP MGF objectives i.e. agriculture commercialization, market access, smallholder \r\n        competitiveness, value addition, etc.?', 'YES', NULL, 'chulu1francis@gmail.'),
(268, 25, 41, 'Will the proposed project be completed before or by December 2023?', 'YES', NULL, 'chulu1francis@gmail.'),
(269, 25, 41, 'Will the project benefit (through contracts or MoUs) a sufficient number of smallholder farmers/producers (at least 200)?', 'YES', NULL, 'chulu1francis@gmail.'),
(270, 25, 41, 'Does the proposed project fit into the objectives of the MGF window applied under?', 'NO', NULL, 'chulu1francis@gmail.'),
(271, 25, 41, 'Has the applicant demonstrated enough capacity to implement the proposed project?', 'YES', NULL, 'chulu1francis@gmail.'),
(272, 25, 41, 'Does the applicant have necessary experience to implement the proposed project? \r\n        (Not less than 2 years involvement in the type of activities proposed)    \r\n        If No to the above, does the applicant have a suitable technical partner \r\n        with requisite experience; or has provision been made for necessary technical \r\n        assistance under the proposed project?', 'YES', NULL, 'chulu1francis@gmail.'),
(273, 25, 41, 'Is the proposed project (potentially) viable technically and financially?', 'YES', NULL, 'chulu1francis@gmail.'),
(274, 25, 41, 'Has the applicant submitted application with all required attachments?', 'YES', NULL, 'chulu1francis@gmail.'),
(275, 26, 46, 'Is the Concept Note submitted on the approved E-SAPP template?', 'YES', NULL, 'dist@gmail.com'),
(276, 26, 46, 'Have all the sections of the template been completed satisfactorily?', 'YES', NULL, 'dist@gmail.com'),
(277, 26, 46, 'Is the proposed project responsive to the E-SAPP MGF objectives i.e. agriculture commercialization, market access, smallholder \r\n        competitiveness, value addition, etc.?', 'YES', NULL, 'dist@gmail.com'),
(278, 26, 46, 'Will the proposed project be completed before or by December 2023?', 'YES', NULL, 'dist@gmail.com'),
(279, 26, 46, 'Will the project benefit (through contracts or MoUs) a sufficient number of smallholder farmers/producers (at least 200)?', 'NO', NULL, 'dist@gmail.com'),
(280, 26, 46, 'Does the proposed project fit into the objectives of the MGF window applied under?', 'YES', NULL, 'dist@gmail.com'),
(281, 26, 46, 'Has the applicant demonstrated enough capacity to implement the proposed project?', 'YES', NULL, 'chulu1francis@gmail.'),
(282, 26, 46, 'Does the applicant have necessary experience to implement the proposed project? \r\n        (Not less than 2 years involvement in the type of activities proposed)    \r\n        If No to the above, does the applicant have a suitable technical partner \r\n        with requisite experience; or has provision been made for necessary technical \r\n        assistance under the proposed project?', 'YES', NULL, 'dist@gmail.com'),
(283, 26, 46, 'Is the proposed project (potentially) viable technically and financially?', 'YES', NULL, 'chulu1francis@gmail.'),
(284, 26, 46, 'Has the applicant submitted application with all required attachments?', 'YES', NULL, 'dist@gmail.com'),
(285, 27, 41, 'Is the Concept Note submitted on the approved E-SAPP template?', NULL, NULL, NULL),
(286, 27, 41, 'Have all the sections of the template been completed satisfactorily?', NULL, NULL, NULL),
(287, 27, 41, 'Is the proposed project responsive to the E-SAPP MGF objectives i.e. agriculture commercialization, market access, smallholder \r\n        competitiveness, value addition, etc.?', NULL, NULL, NULL),
(288, 27, 41, 'Will the proposed project be completed before or by December 2023?', NULL, NULL, NULL),
(289, 27, 41, 'Will the project benefit (through contracts or MoUs) a sufficient number of smallholder farmers/producers (at least 200)?', NULL, NULL, NULL),
(290, 27, 41, 'Does the proposed project fit into the objectives of the MGF window applied under?', NULL, NULL, NULL),
(291, 27, 41, 'Has the applicant demonstrated enough capacity to implement the proposed project?', NULL, NULL, NULL),
(292, 27, 41, 'Does the applicant have necessary experience to implement the proposed project? \r\n        (Not less than 2 years involvement in the type of activities proposed)    \r\n        If No to the above, does the applicant have a suitable technical partner \r\n        with requisite experience; or has provision been made for necessary technical \r\n        assistance under the proposed project?', NULL, NULL, NULL),
(293, 27, 41, 'Is the proposed project (potentially) viable technically and financially?', NULL, NULL, NULL),
(294, 27, 41, 'Has the applicant submitted application with all required attachments?', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_selection_category`
--

CREATE TABLE `mgf_selection_category` (
  `id` int(11) NOT NULL,
  `category` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_selection_category`
--

INSERT INTO `mgf_selection_category` (`id`, `category`, `date_created`, `createdby`) VALUES
(1, 'PROBLEM STATEMENT AND STRATEGIC OBJECTIVE ', '2021-03-17 09:00:55', 1),
(2, 'PROJECT DESCRIPTION AND RELEVANCE TO TECHNOLOGY AND PROBLEM STATEMENT', '2021-03-17 09:00:55', 15),
(3, 'IMPLEMENTATION CAPACITY AND ARRANGEMENTS', '2021-03-18 06:52:23', 15),
(4, 'PROJECT RESULTS AND BENEFICIARIES', '2021-03-18 06:52:23', 15),
(5, 'SUSTAINABILITY/SCALABILITY/REPLICABILITY', '2021-03-18 06:53:14', 15),
(6, 'PROJECT RISKS AND MITIGANTS', '2021-03-18 06:53:14', 15);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_selection_criteria`
--

CREATE TABLE `mgf_selection_criteria` (
  `id` int(11) NOT NULL,
  `criterion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_selection_criteria`
--

INSERT INTO `mgf_selection_criteria` (`id`, `criterion`, `category_id`, `date_created`, `createdby`) VALUES
(3, 'Will addressing the problem identified in the FPP respond to E-SAPP MGF-Objective: Agricultural commercialization, enhancing smallholder participation in the selected value chains, value addition, market access, competitiveness?', 1, '2021-03-17 09:02:21', 15),
(4, 'Is the strategic objective responsive to the problem statement?', 1, '2021-03-17 09:02:21', 15),
(5, 'Are components and activities clearly defined and responsive to strategic objective?', 2, '2021-03-17 13:02:35', 15),
(6, 'Are the input/output coefficients detailed and in-line with the technology and industry experience? ', 2, '2021-03-17 13:02:35', 15),
(7, 'Will the proposed technology/initiative provide practical and economic solutions to address the problem(s) identified?', 2, '2021-03-17 13:04:00', 15),
(8, 'Have Marketing issues been considered and adequate arrangements made (including resources allocated) for marketing?', 2, '2021-03-17 13:04:00', 15),
(9, 'Is the period of implementation realistic for such a project?', 2, '2021-03-17 13:06:53', 15),
(10, 'Has the applicant demonstrated capacity to implement the proposed project (i.e. number of staff, training and experience, track record of project management including financial management, leadership and governance?', 3, '2021-03-18 16:50:21', 15),
(11, 'How soon will the participating smallholders realise expected benefits?', 4, '2021-03-18 16:58:11', 15),
(12, 'How large is the number of smallholder farmers/producers who will benefit from the proposed project?', 4, '2021-03-18 17:06:35', 15),
(13, 'What is the percentage of women among the direct beneficiaries who will benefit from the proposed project? ', 4, '2021-03-18 17:06:35', 15),
(14, 'What is the proportion of youths among the direct beneficiaries who will benefit from the proposed project?', 4, '2021-03-18 17:06:35', 15),
(15, 'How significant will the increase in income of direct smallholder beneficiaries be?', 4, '2021-03-18 17:06:35', 15),
(16, 'Will the proposed project contribute to the development of effective and sustainable linkages with other actors in the value chain?', 5, '2021-03-18 18:10:58', 15),
(17, 'Will the proposed project have a systemic impact in the value chain? (Direct and Indirect/Casual Employment)', 5, '2021-03-18 18:10:58', 15),
(18, 'Has the proposed project adequately identified its social and environmental impact and climate risks? \r\nHave necessary measures for control and mitigation been addressed?', 6, '2021-03-18 18:10:58', 15),
(19, 'Have other risk exposures (Business, Financial, etc) been identified and mitigation measures addressed?', 6, '2021-03-18 18:10:58', 15);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_selection_grade`
--

CREATE TABLE `mgf_selection_grade` (
  `id` int(11) NOT NULL,
  `grade` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criterion_id` int(11) NOT NULL,
  `awardedscore` int(2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_selection_grade`
--

INSERT INTO `mgf_selection_grade` (`id`, `grade`, `criterion_id`, `awardedscore`, `date_created`, `createdby`) VALUES
(1, 'Poorly', 4, 0, '2021-03-17 09:40:37', 15),
(2, 'Little', 4, 4, '2021-03-17 09:42:10', 15),
(3, 'Moderately', 4, 6, '2021-03-17 09:43:08', 15),
(4, 'Highly', 4, 8, '2021-03-17 09:44:12', 15),
(5, 'Extremely Well', 4, 10, '2021-03-17 09:44:56', 15),
(6, 'Poorly', 3, 0, '2021-03-17 11:02:54', 15),
(7, 'Little', 3, 2, '2021-03-17 11:16:15', 15),
(8, 'Moderately', 3, 3, '2021-03-17 11:16:15', 15),
(9, 'Highly', 3, 4, '2021-03-17 11:16:15', 15),
(10, 'Extremely Well', 3, 5, '2021-03-17 11:16:15', 15),
(11, 'Unclear/ unresponsive', 5, 0, '2021-03-17 13:20:44', 15),
(12, 'Little', 5, 2, '2021-03-17 13:20:44', 15),
(13, 'Clear and highly responsive', 5, 4, '2021-03-17 13:20:44', 15),
(14, 'Highly responsive and clear', 5, 5, '2021-03-17 13:20:44', 15),
(15, 'Vague/difficult to relate to technology', 6, 0, '2021-03-17 16:47:54', 15),
(16, 'Very little', 6, 2, '2021-03-17 16:47:54', 15),
(17, 'Detailed and in-line with Technology & Industry norm', 6, 4, '2021-03-17 16:47:54', 15),
(18, 'Excellent in all respects', 6, 5, '2021-03-17 16:47:54', 15),
(19, 'Not at all', 7, 0, '2021-03-17 16:47:54', 15),
(20, 'Moderately', 7, 2, '2021-03-17 16:47:54', 15),
(21, 'Very well', 7, 4, '2021-03-17 16:47:54', 15),
(22, 'Highly responsive', 7, 5, '2021-03-17 16:47:54', 15),
(23, 'Not at all', 8, 0, '2021-03-17 16:47:54', 15),
(24, 'Moderately', 8, 5, '2021-03-17 16:47:54', 15),
(25, 'Appropriate attention and resources allocated', 8, 8, '2021-03-17 16:47:54', 15),
(26, 'Extremely well considered', 8, 10, '2021-03-17 16:47:54', 15),
(27, 'Over optimistic', 9, 0, '2021-03-17 16:47:54', 15),
(28, 'Realistic but fail to accommodate delay', 9, 2, '2021-03-17 16:47:54', 15),
(29, 'Adequate', 9, 4, '2021-03-17 16:47:54', 15),
(30, 'Much more realistic/Very much realistic', 9, 5, '2021-03-17 16:47:54', 15),
(31, 'No evidence', 10, 0, '2021-03-18 18:37:33', 15),
(32, 'Fairly satisfactory', 10, 5, '2021-03-18 18:37:33', 15),
(33, 'Very satisfactory', 10, 8, '2021-03-18 18:37:33', 15),
(34, 'Highly satisfactory with proven experience', 10, 10, '2021-03-18 18:37:33', 15),
(35, 'After 3 years', 11, 1, '2021-03-18 18:37:33', 15),
(36, 'After 2 years', 11, 3, '2021-03-18 18:37:33', 15),
(37, 'Between 1-2 years', 11, 4, '2021-03-18 18:37:33', 15),
(38, 'Within 1 year', 11, 5, '2021-03-18 18:37:33', 15),
(39, 'Less than 200', 12, 1, '2021-03-18 18:37:33', 15),
(40, '200 - 499', 12, 2, '2021-03-18 18:37:33', 15),
(41, '500 - 799', 12, 4, '2021-03-18 18:37:33', 15),
(42, '800 - 1000', 12, 5, '2021-03-18 18:37:33', 15),
(43, 'Less than 10%', 13, 1, '2021-03-18 18:37:33', 15),
(44, '10 â€“ 29%', 13, 2, '2021-03-18 18:37:33', 15),
(45, '30 â€“ 50%', 13, 4, '2021-03-18 18:37:33', 15),
(46, 'Over 50%', 13, 5, '2021-03-18 18:37:33', 15),
(47, 'Less than 15%', 14, 1, '2021-03-18 18:37:33', 15),
(48, '15 â€“ 19%', 14, 2, '2021-03-18 18:37:33', 15),
(49, '20 â€“ 30%', 14, 4, '2021-03-18 18:37:33', 15),
(50, 'Over 30%', 14, 5, '2021-03-18 18:37:33', 15),
(51, 'Less than 10%', 15, 1, '2021-03-18 18:51:32', 15),
(52, '15 â€“ 19%', 15, 2, '2021-03-18 18:51:32', 15),
(53, '20 â€“ 30%', 15, 4, '2021-03-18 18:51:32', 15),
(54, 'Over 30%', 15, 5, '2021-03-18 18:51:32', 15),
(55, 'Very little', 16, 1, '2021-03-18 18:51:32', 15),
(56, 'To a large extent', 16, 2, '2021-03-18 18:51:32', 15),
(57, 'Very much', 16, 4, '2021-03-18 18:51:32', 15),
(58, 'Extremely well', 16, 5, '2021-03-18 18:51:32', 15),
(59, 'Less than 10 persons employed', 17, 1, '2021-03-18 18:51:32', 15),
(60, '10 â€“ 30 new employment', 17, 2, '2021-03-18 18:51:32', 15),
(61, '31 â€“ 50 new employment', 17, 4, '2021-03-18 18:51:32', 15),
(62, 'Over 50 new employment', 17, 5, '2021-03-18 18:51:32', 15),
(63, 'No attention is given', 18, 0, '2021-03-18 18:51:32', 15),
(64, 'Very little attention', 18, 1, '2021-03-18 18:51:32', 15),
(65, 'Appropriate', 18, 3, '2021-03-18 18:51:32', 15),
(66, 'Very satisfactory attention', 18, 5, '2021-03-18 18:51:32', 15),
(67, 'To a limited extent', 19, 1, '2021-03-18 18:51:32', 15),
(68, 'Fairly well addressed', 19, 2, '2021-03-18 18:51:32', 15),
(69, 'Satisfactorily addressed', 19, 4, '2021-03-18 18:51:32', 15),
(70, 'Very well addressed', 19, 5, '2021-03-18 18:51:32', 15);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_settings`
--

CREATE TABLE `mgf_settings` (
  `id` int(11) NOT NULL,
  `window` int(1) NOT NULL,
  `max_reviewers` int(2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_settings`
--

INSERT INTO `mgf_settings` (`id`, `window`, `max_reviewers`, `date_created`) VALUES
(1, 1, 2, '2021-06-20 14:23:43'),
(2, 2, 3, '2021-06-20 14:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_sustainability_scalability`
--

CREATE TABLE `mgf_sustainability_scalability` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgf_unit`
--

CREATE TABLE `mgf_unit` (
  `id` int(11) NOT NULL,
  `unit` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `synonym` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mgf_unit`
--

INSERT INTO `mgf_unit` (`id`, `unit`, `synonym`, `user_id`, `date_created`) VALUES
(3, 'centimeters', 'cm', 28, '2021-04-27 15:23:33'),
(4, 'kilograms', 'Kg', 5, '2021-04-27 15:23:33'),
(5, 'count', 'count', 15, '2021-04-27 15:24:44'),
(6, 'pounds', 'lbs', 15, '2021-04-27 15:24:44'),
(7, 'medas', 'meda', 15, '2021-04-27 15:26:01'),
(8, 'inches', 'in', 15, '2021-04-27 15:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_value_of_product`
--

CREATE TABLE `mgf_value_of_product` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_unit` varchar(11) DEFAULT NULL,
  `product_yr1_qty` decimal(9,2) DEFAULT 0.00,
  `product_yr1_price` double(9,2) DEFAULT 0.00,
  `product_yr1_value` double(9,2) DEFAULT 0.00,
  `product_yr2_qty` decimal(9,2) DEFAULT 0.00,
  `product_yr2_price` double(9,2) DEFAULT 0.00,
  `product_yr2_value` double(9,2) DEFAULT 0.00,
  `product_yr3_qty` decimal(9,2) DEFAULT 0.00,
  `product_yr3_price` double(9,2) DEFAULT 0.00,
  `product_yr3_value` double(9,2) DEFAULT 0.00,
  `product_yr4_qty` decimal(9,2) DEFAULT 0.00,
  `product_yr4_price` double(9,2) DEFAULT 0.00,
  `product_yr4_value` double(9,2) DEFAULT 0.00,
  `comment` varchar(100) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_value_of_product`
--

INSERT INTO `mgf_value_of_product` (`id`, `product_name`, `product_unit`, `product_yr1_qty`, `product_yr1_price`, `product_yr1_value`, `product_yr2_qty`, `product_yr2_price`, `product_yr2_value`, `product_yr3_qty`, `product_yr3_price`, `product_yr3_value`, `product_yr4_qty`, `product_yr4_price`, `product_yr4_value`, `comment`, `project_id`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 'Fish Feed', '25Kg Bags', '20.00', 300.00, 6000.00, '34.00', 560.00, 19040.00, '50.00', 630.00, 31500.00, '60.00', 710.00, 42600.00, 'Comment 1', 0, 13, '2021-07-21 12:31:36', '2021-07-21 12:31:36', 56, NULL),
(2, 'Fish', 'Count', '2.00', 5.00, 10.00, '3.00', 6.00, 18.00, '5.00', 6.00, 30.00, '8.00', 9.00, 72.00, 'comment 5', 0, 13, '2021-07-21 13:09:46', '2021-07-21 13:09:46', 56, NULL),
(3, 'goats', 'Count', '40.00', 500.00, 20000.00, '50.00', 700.00, 35000.00, '70.00', 800.00, 56000.00, '100.00', 900.00, 90000.00, 'Great', 0, 13, '2021-07-21 18:42:58', '2021-07-21 18:42:58', 56, NULL),
(4, 'goats', 'Count', '40.00', 500.00, 20000.00, '50.00', 700.00, 35000.00, '70.00', 800.00, 56000.00, '100.00', 900.00, 90000.00, 'Great', 0, 13, '2021-07-21 18:43:30', '2021-07-21 18:43:30', 56, NULL),
(1, 'Fish Feed', '25Kg Bags', '20.00', 300.00, 6000.00, '34.00', 560.00, 19040.00, '50.00', 630.00, 31500.00, '60.00', 710.00, 42600.00, 'Comment 1', 0, 13, '2021-07-21 10:31:36', '2021-07-21 10:31:36', 56, NULL),
(2, 'Fish', 'Count', '2.00', 5.00, 10.00, '3.00', 6.00, 18.00, '5.00', 6.00, 30.00, '8.00', 9.00, 72.00, 'comment 5', 0, 13, '2021-07-21 11:09:46', '2021-07-21 11:09:46', 56, NULL),
(3, 'goats', 'Count', '40.00', 500.00, 20000.00, '50.00', 700.00, 35000.00, '70.00', 800.00, 56000.00, '100.00', 900.00, 90000.00, 'Great', 0, 13, '2021-07-21 16:42:58', '2021-07-21 16:42:58', 56, NULL),
(4, 'goats', 'Count', '40.00', 500.00, 20000.00, '50.00', 700.00, 35000.00, '70.00', 800.00, 56000.00, '100.00', 900.00, 90000.00, 'Great', 0, 13, '2021-07-21 16:43:30', '2021-07-21 16:43:30', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_value_of_product_totals`
--

CREATE TABLE `mgf_value_of_product_totals` (
  `id` int(11) UNSIGNED NOT NULL,
  `total_yr1_value` double(9,2) DEFAULT NULL,
  `total_yr2_value` double(9,2) DEFAULT NULL,
  `total_yr3_value` double(9,2) DEFAULT NULL,
  `total_yr4_value` double(9,2) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_value_of_product_totals`
--

INSERT INTO `mgf_value_of_product_totals` (`id`, `total_yr1_value`, `total_yr2_value`, `total_yr3_value`, `total_yr4_value`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 46010.00, 89058.00, 143530.00, 222672.00, 13, '2021-07-21 18:43:30', '2021-07-21 18:43:30', 56, NULL),
(1, 46010.00, 89058.00, 143530.00, 222672.00, 13, '2021-07-21 16:43:30', '2021-07-21 16:43:30', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_variable_fixed_cost`
--

CREATE TABLE `mgf_variable_fixed_cost` (
  `id` int(11) UNSIGNED NOT NULL,
  `cost_name` varchar(200) NOT NULL,
  `cost_type` enum('Variable','Fixed') DEFAULT NULL,
  `cost_yr1_value` double(9,2) DEFAULT NULL,
  `cost_yr2_value` double(9,2) DEFAULT NULL,
  `cost_yr3_value` double(9,2) DEFAULT NULL,
  `cost_yr4_value` double(9,2) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_variable_fixed_cost`
--

INSERT INTO `mgf_variable_fixed_cost` (`id`, `cost_name`, `cost_type`, `cost_yr1_value`, `cost_yr2_value`, `cost_yr3_value`, `cost_yr4_value`, `comment`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(1, 'Wages', 'Fixed', 5.00, 6.00, 7.00, 7.00, 'Comment 1', 13, '2021-07-21 20:17:14', '2021-07-21 20:17:14', 56, NULL),
(2, 'Water', 'Variable', 30.00, 40.00, 50.00, 60.00, 'comment 2', 13, '2021-07-21 20:48:34', '2021-07-21 20:48:34', 56, NULL),
(3, 'Water', 'Variable', 30.00, 40.00, 50.00, 60.00, 'comment 2', 13, '2021-07-21 20:52:26', '2021-07-21 20:52:26', 56, NULL),
(4, 'Water', 'Variable', 30.00, 40.00, 50.00, 60.00, 'comment 2', 13, '2021-07-21 20:54:16', '2021-07-21 20:54:16', 56, NULL),
(5, 'Electricity', 'Variable', 34.00, 56.00, 67.00, 78.00, 'power is good', 13, '2021-07-21 20:59:17', '2021-07-21 20:59:17', 56, NULL),
(6, 'Electricity', 'Variable', 34.00, 56.00, 67.00, 78.00, 'power is good', 13, '2021-07-21 21:03:03', '2021-07-21 21:03:03', 56, NULL),
(7, 'Electricity', 'Variable', 34.00, 56.00, 67.00, 78.00, 'power is good', 13, '2021-07-21 21:05:13', '2021-07-21 21:05:13', 56, NULL),
(8, 'Inspection', 'Fixed', 3.00, 5.00, 5.00, 5.00, 'cem', 13, '2021-07-23 11:44:13', '2021-07-23 11:44:13', 56, NULL),
(9, 'Inspection', 'Fixed', 3.00, 5.00, 5.00, 5.00, 'cem', 13, '2021-07-23 11:45:51', '2021-07-23 11:45:51', 56, NULL),
(10, 'Inspection', 'Fixed', 3.00, 5.00, 5.00, 5.00, 'cem', 13, '2021-07-23 11:48:20', '2021-07-23 11:48:20', 56, NULL),
(11, 'Inspection', 'Fixed', 3.00, 5.00, 5.00, 5.00, 'cem', 13, '2021-07-23 11:50:12', '2021-07-23 11:50:12', 56, NULL),
(12, 'cost 1', 'Variable', 3.00, 4.00, 4.00, 5.00, 'dsdds', 13, '2021-07-23 11:51:03', '2021-07-23 11:51:03', 56, NULL),
(13, 'cost 1', 'Variable', 3.00, 4.00, 4.00, 5.00, 'dsdds', 13, '2021-07-23 11:54:49', '2021-07-23 11:54:49', 56, NULL),
(14, 'cost 2', 'Variable', 7.00, 9.00, 9.00, 9.00, 'jdjdj', 13, '2021-07-23 12:14:35', '2021-07-23 12:14:35', 56, NULL),
(15, 'cost 2', 'Variable', 7.00, 9.00, 9.00, 9.00, 'jdjdj', 13, '2021-07-23 12:19:40', '2021-07-23 12:19:40', 56, NULL),
(16, 'cost20', 'Fixed', 4.00, 5.00, 5.00, 6.00, 'fdfd', 13, '2021-07-23 14:54:44', '2021-07-23 14:54:44', 56, NULL),
(17, 'cost20', 'Fixed', 4.00, 5.00, 5.00, 6.00, 'fdfd', 13, '2021-07-23 14:55:19', '2021-07-23 14:55:19', 56, NULL),
(18, 'dgggg', 'Fixed', 8.00, 7.00, 9.00, 6.00, 'tttt', 13, '2021-07-24 10:31:19', '2021-07-24 10:31:19', 56, NULL),
(19, 'kkkk', 'Variable', 7.00, 7.00, 7.00, 7.00, 'hhh', 13, '2021-07-24 10:36:02', '2021-07-24 10:36:02', 56, NULL),
(20, 'jjj', 'Fixed', 9.00, 9.00, 9.00, 9.00, 'hhh', 13, '2021-07-24 10:38:26', '2021-07-24 10:38:26', 56, NULL),
(21, 'cost 50', 'Variable', 6.00, 8.00, 9.00, 10.00, 'dsdds sunday', 13, '2021-07-25 18:06:05', '2021-07-25 18:06:05', 56, NULL),
(22, 'cost 50', 'Variable', 6.00, 8.00, 9.00, 10.00, 'dsdds sunday', 13, '2021-07-25 18:11:03', '2021-07-25 18:11:03', 56, NULL),
(23, 'coooost', 'Variable', 90.00, 899.00, 899.00, 8.00, 'uuuuu', 13, '2021-07-25 18:25:07', '2021-07-25 18:25:07', 56, NULL),
(24, 'Water', 'Variable', 7.00, 9.00, 9.00, 60.00, 'dsdds', 13, '2021-07-25 19:30:57', '2021-07-25 19:30:57', 56, NULL),
(25, 'Electricity', 'Variable', 34.00, 40.00, 67.00, 60.00, 'power is good', 13, '2021-07-25 19:32:08', '2021-07-25 19:32:08', 56, NULL),
(26, 'Inspection', 'Variable', 30.00, 6.00, 4.00, 6.00, 'cem', 13, '2021-07-25 19:33:29', '2021-07-25 19:33:29', 56, NULL),
(27, 'Inspection', 'Variable', 30.00, 6.00, 4.00, 6.00, 'cem', 13, '2021-07-25 19:35:59', '2021-07-25 19:35:59', 56, NULL),
(28, 'Inspection', 'Variable', 4.00, 56.00, 50.00, 78.00, 'comment 2', 13, '2021-07-25 19:38:18', '2021-07-25 19:38:18', 56, NULL),
(29, 'Inspection', 'Variable', 4.00, 56.00, 50.00, 78.00, 'comment 2', 13, '2021-07-25 19:39:32', '2021-07-25 19:39:32', 56, NULL),
(30, 'Inspection', 'Variable', 5.00, 7.00, 67.00, 9.00, 'Comment 1', 13, '2021-07-25 19:43:03', '2021-07-25 19:43:03', 56, NULL),
(31, 'Inspection', 'Variable', 5.00, 7.00, 67.00, 9.00, 'Comment 1', 13, '2021-07-25 19:45:32', '2021-07-25 19:45:32', 56, NULL),
(32, 'Water', 'Fixed', 34.00, 40.00, 67.00, 78.00, 'dsdds', 13, '2021-07-25 19:51:54', '2021-07-25 19:51:54', 56, NULL),
(33, 'Water', 'Fixed', 34.00, 40.00, 67.00, 78.00, 'dsdds', 13, '2021-07-25 19:52:49', '2021-07-25 19:52:49', 56, NULL),
(34, 'Water', 'Fixed', 34.00, 40.00, 67.00, 78.00, 'dsdds', 13, '2021-07-25 19:52:56', '2021-07-25 19:52:56', 56, NULL),
(35, 'Inspection', 'Fixed', 30.00, 5.00, 7.00, 9.00, 'hhh', 13, '2021-07-25 20:01:30', '2021-07-25 20:01:30', 56, NULL),
(36, 'Inspection', 'Variable', 3.00, 1.00, 1.00, 1.00, 'sssnsnsn', 13, '2021-07-25 21:02:24', '2021-07-25 21:02:24', 56, NULL),
(37, 'Inspection', 'Variable', 3.00, 1.00, 1.00, 1.00, 'sssnsnsn', 13, '2021-07-25 21:05:51', '2021-07-25 21:05:51', 56, NULL),
(38, 'Water', 'Variable', 5.00, 6.00, 4.00, 5.00, 'power is good', 13, '2021-07-25 21:38:45', '2021-07-25 21:38:45', 56, NULL),
(39, 'Water', 'Variable', 5.00, 6.00, 4.00, 5.00, 'power is good', 13, '2021-07-25 21:41:14', '2021-07-25 21:41:14', 56, NULL),
(40, 'Water', 'Variable', 78.00, 67.00, 90.00, 100.00, 'gfgfgt', 13, '2021-07-25 21:53:53', '2021-07-25 21:53:53', 56, NULL),
(41, 'cost 100', 'Fixed', 6.00, 6.00, 6.00, 6.00, 'Kenneth', 13, '2021-07-25 22:15:25', '2021-07-25 22:15:25', 56, NULL),
(42, 'cost 1000', 'Variable', 1.00, 2.00, 3.00, 4.00, 'comet', 13, '2021-07-26 00:39:58', '2021-07-26 00:39:58', 56, NULL),
(43, 'plkkk', 'Variable', 4.00, 5.00, 6.00, 7.00, 'hgdft', 13, '2021-07-26 00:41:30', '2021-07-26 00:41:30', 56, NULL),
(1, 'Wages', 'Fixed', 5.00, 6.00, 7.00, 7.00, 'Comment 1', 13, '2021-07-21 18:17:14', '2021-07-21 18:17:14', 56, NULL),
(2, 'Water', 'Variable', 30.00, 40.00, 50.00, 60.00, 'comment 2', 13, '2021-07-21 18:48:34', '2021-07-21 18:48:34', 56, NULL),
(3, 'Water', 'Variable', 30.00, 40.00, 50.00, 60.00, 'comment 2', 13, '2021-07-21 18:52:26', '2021-07-21 18:52:26', 56, NULL),
(4, 'Water', 'Variable', 30.00, 40.00, 50.00, 60.00, 'comment 2', 13, '2021-07-21 18:54:16', '2021-07-21 18:54:16', 56, NULL),
(5, 'Electricity', 'Variable', 34.00, 56.00, 67.00, 78.00, 'power is good', 13, '2021-07-21 18:59:17', '2021-07-21 18:59:17', 56, NULL),
(6, 'Electricity', 'Variable', 34.00, 56.00, 67.00, 78.00, 'power is good', 13, '2021-07-21 19:03:03', '2021-07-21 19:03:03', 56, NULL),
(7, 'Electricity', 'Variable', 34.00, 56.00, 67.00, 78.00, 'power is good', 13, '2021-07-21 19:05:13', '2021-07-21 19:05:13', 56, NULL),
(8, 'Inspection', 'Fixed', 3.00, 5.00, 5.00, 5.00, 'cem', 13, '2021-07-23 09:44:13', '2021-07-23 09:44:13', 56, NULL),
(9, 'Inspection', 'Fixed', 3.00, 5.00, 5.00, 5.00, 'cem', 13, '2021-07-23 09:45:51', '2021-07-23 09:45:51', 56, NULL),
(10, 'Inspection', 'Fixed', 3.00, 5.00, 5.00, 5.00, 'cem', 13, '2021-07-23 09:48:20', '2021-07-23 09:48:20', 56, NULL),
(11, 'Inspection', 'Fixed', 3.00, 5.00, 5.00, 5.00, 'cem', 13, '2021-07-23 09:50:12', '2021-07-23 09:50:12', 56, NULL),
(12, 'cost 1', 'Variable', 3.00, 4.00, 4.00, 5.00, 'dsdds', 13, '2021-07-23 09:51:03', '2021-07-23 09:51:03', 56, NULL),
(13, 'cost 1', 'Variable', 3.00, 4.00, 4.00, 5.00, 'dsdds', 13, '2021-07-23 09:54:49', '2021-07-23 09:54:49', 56, NULL),
(14, 'cost 2', 'Variable', 7.00, 9.00, 9.00, 9.00, 'jdjdj', 13, '2021-07-23 10:14:35', '2021-07-23 10:14:35', 56, NULL),
(15, 'cost 2', 'Variable', 7.00, 9.00, 9.00, 9.00, 'jdjdj', 13, '2021-07-23 10:19:40', '2021-07-23 10:19:40', 56, NULL),
(16, 'cost20', 'Fixed', 4.00, 5.00, 5.00, 6.00, 'fdfd', 13, '2021-07-23 12:54:44', '2021-07-23 12:54:44', 56, NULL),
(17, 'cost20', 'Fixed', 4.00, 5.00, 5.00, 6.00, 'fdfd', 13, '2021-07-23 12:55:19', '2021-07-23 12:55:19', 56, NULL),
(18, 'dgggg', 'Fixed', 8.00, 7.00, 9.00, 6.00, 'tttt', 13, '2021-07-24 08:31:19', '2021-07-24 08:31:19', 56, NULL),
(19, 'kkkk', 'Variable', 7.00, 7.00, 7.00, 7.00, 'hhh', 13, '2021-07-24 08:36:02', '2021-07-24 08:36:02', 56, NULL),
(20, 'jjj', 'Fixed', 9.00, 9.00, 9.00, 9.00, 'hhh', 13, '2021-07-24 08:38:26', '2021-07-24 08:38:26', 56, NULL),
(21, 'cost 50', 'Variable', 6.00, 8.00, 9.00, 10.00, 'dsdds sunday', 13, '2021-07-25 16:06:05', '2021-07-25 16:06:05', 56, NULL),
(22, 'cost 50', 'Variable', 6.00, 8.00, 9.00, 10.00, 'dsdds sunday', 13, '2021-07-25 16:11:03', '2021-07-25 16:11:03', 56, NULL),
(23, 'coooost', 'Variable', 90.00, 899.00, 899.00, 8.00, 'uuuuu', 13, '2021-07-25 16:25:07', '2021-07-25 16:25:07', 56, NULL),
(24, 'Water', 'Variable', 7.00, 9.00, 9.00, 60.00, 'dsdds', 13, '2021-07-25 17:30:57', '2021-07-25 17:30:57', 56, NULL),
(25, 'Electricity', 'Variable', 34.00, 40.00, 67.00, 60.00, 'power is good', 13, '2021-07-25 17:32:08', '2021-07-25 17:32:08', 56, NULL),
(26, 'Inspection', 'Variable', 30.00, 6.00, 4.00, 6.00, 'cem', 13, '2021-07-25 17:33:29', '2021-07-25 17:33:29', 56, NULL),
(27, 'Inspection', 'Variable', 30.00, 6.00, 4.00, 6.00, 'cem', 13, '2021-07-25 17:35:59', '2021-07-25 17:35:59', 56, NULL),
(28, 'Inspection', 'Variable', 4.00, 56.00, 50.00, 78.00, 'comment 2', 13, '2021-07-25 17:38:18', '2021-07-25 17:38:18', 56, NULL),
(29, 'Inspection', 'Variable', 4.00, 56.00, 50.00, 78.00, 'comment 2', 13, '2021-07-25 17:39:32', '2021-07-25 17:39:32', 56, NULL),
(30, 'Inspection', 'Variable', 5.00, 7.00, 67.00, 9.00, 'Comment 1', 13, '2021-07-25 17:43:03', '2021-07-25 17:43:03', 56, NULL),
(31, 'Inspection', 'Variable', 5.00, 7.00, 67.00, 9.00, 'Comment 1', 13, '2021-07-25 17:45:32', '2021-07-25 17:45:32', 56, NULL),
(32, 'Water', 'Fixed', 34.00, 40.00, 67.00, 78.00, 'dsdds', 13, '2021-07-25 17:51:54', '2021-07-25 17:51:54', 56, NULL),
(33, 'Water', 'Fixed', 34.00, 40.00, 67.00, 78.00, 'dsdds', 13, '2021-07-25 17:52:49', '2021-07-25 17:52:49', 56, NULL),
(34, 'Water', 'Fixed', 34.00, 40.00, 67.00, 78.00, 'dsdds', 13, '2021-07-25 17:52:56', '2021-07-25 17:52:56', 56, NULL),
(35, 'Inspection', 'Fixed', 30.00, 5.00, 7.00, 9.00, 'hhh', 13, '2021-07-25 18:01:30', '2021-07-25 18:01:30', 56, NULL),
(36, 'Inspection', 'Variable', 3.00, 1.00, 1.00, 1.00, 'sssnsnsn', 13, '2021-07-25 19:02:24', '2021-07-25 19:02:24', 56, NULL),
(37, 'Inspection', 'Variable', 3.00, 1.00, 1.00, 1.00, 'sssnsnsn', 13, '2021-07-25 19:05:51', '2021-07-25 19:05:51', 56, NULL),
(38, 'Water', 'Variable', 5.00, 6.00, 4.00, 5.00, 'power is good', 13, '2021-07-25 19:38:45', '2021-07-25 19:38:45', 56, NULL),
(39, 'Water', 'Variable', 5.00, 6.00, 4.00, 5.00, 'power is good', 13, '2021-07-25 19:41:14', '2021-07-25 19:41:14', 56, NULL),
(40, 'Water', 'Variable', 78.00, 67.00, 90.00, 100.00, 'gfgfgt', 13, '2021-07-25 19:53:53', '2021-07-25 19:53:53', 56, NULL),
(41, 'cost 100', 'Fixed', 6.00, 6.00, 6.00, 6.00, 'Kenneth', 13, '2021-07-25 20:15:25', '2021-07-25 20:15:25', 56, NULL),
(42, 'cost 1000', 'Variable', 1.00, 2.00, 3.00, 4.00, 'comet', 13, '2021-07-25 22:39:58', '2021-07-25 22:39:58', 56, NULL),
(43, 'plkkk', 'Variable', 4.00, 5.00, 6.00, 7.00, 'hgdft', 13, '2021-07-25 22:41:30', '2021-07-25 22:41:30', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_variable_fixed_cost_totals`
--

CREATE TABLE `mgf_variable_fixed_cost_totals` (
  `id` int(11) UNSIGNED NOT NULL,
  `total_yr1_value` double(9,2) DEFAULT 0.00,
  `total_yr2_value` double(9,2) DEFAULT 0.00,
  `total_yr3_value` double(9,2) DEFAULT 0.00,
  `total_yr4_value` double(9,2) DEFAULT 0.00,
  `proposal_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_variable_fixed_cost_totals`
--

INSERT INTO `mgf_variable_fixed_cost_totals` (`id`, `total_yr1_value`, `total_yr2_value`, `total_yr3_value`, `total_yr4_value`, `proposal_id`, `date_created`, `date_update`, `created_by`, `updated_by`) VALUES
(18, 719.00, 719.00, 719.00, 719.00, 13, '2021-07-25 22:41:30', '2021-07-25 22:41:30', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgf_window`
--

CREATE TABLE `mgf_window` (
  `id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `window` int(1) NOT NULL,
  `open_from` date NOT NULL,
  `closing_date` date NOT NULL,
  `total_submitted` int(11) DEFAULT 0,
  `compliant` int(11) DEFAULT 0,
  `non_compliant` int(11) DEFAULT 0,
  `is_active` int(1) DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_window`
--

INSERT INTO `mgf_window` (`id`, `year_id`, `window`, `open_from`, `closing_date`, `total_submitted`, `compliant`, `non_compliant`, `is_active`, `date_created`) VALUES
(1, 1, 1, '2021-08-01', '2021-09-30', 0, 0, 0, 1, '2021-07-29 17:52:42'),
(2, 1, 2, '2021-07-01', '2021-11-30', 0, 0, 0, 1, '2021-07-29 17:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `mgf_year`
--

CREATE TABLE `mgf_year` (
  `id` int(11) NOT NULL,
  `year` varchar(30) NOT NULL,
  `total_submitted` int(11) DEFAULT 0,
  `compliant` int(11) DEFAULT 0,
  `non_compliant` int(11) DEFAULT 0,
  `is_active` int(1) DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgf_year`
--

INSERT INTO `mgf_year` (`id`, `year`, `total_submitted`, `compliant`, `non_compliant`, `is_active`, `date_created`) VALUES
(1, '2020', 0, 0, 0, 1, '2021-07-29 17:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `right` text DEFAULT NULL,
  `definition` text DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `right`, `definition`, `active`) VALUES
(1, 'Manage Users', NULL, 1),
(2, 'View Users', NULL, 1),
(3, 'Manage Roles', NULL, 1),
(4, 'View Roles', NULL, 1),
(6, 'View profile', NULL, 1),
(7, 'View audit trail logs', NULL, 1),
(8, 'Manage provinces', NULL, 1),
(9, 'Manage districts', NULL, 1),
(10, 'Manage camps', NULL, 1),
(11, 'Remove provinces', NULL, 1),
(12, 'Remove districts', NULL, 1),
(13, 'Remove camps', NULL, 1),
(14, 'Manage markets', NULL, 1),
(15, 'Remove markets', NULL, 1),
(16, 'Manage commodity configs', NULL, 1),
(17, 'Remove commodity config', NULL, 1),
(18, 'Collect commodity prices', NULL, 1),
(19, 'View commodity prices', NULL, 1),
(20, 'Remove commodity price', NULL, 1),
(21, 'Manage interview guide template questions', NULL, 1),
(22, 'View interview guide template', NULL, 1),
(23, 'Remove interview guide template question', NULL, 1),
(24, 'Manage story of change categories', NULL, 1),
(25, 'Submit story of change', NULL, 1),
(26, 'Review Story of change', NULL, 1),
(27, 'View Story of change', NULL, 1),
(28, 'Attach case study articles', NULL, 1),
(29, 'Manage faabs groups', NULL, 1),
(30, 'View faabs groups', NULL, 1),
(31, 'Remove faabs groups', NULL, 1),
(32, 'Manage category A farmers', NULL, 1),
(33, 'View category A farmers', NULL, 1),
(34, 'Remove category A farmers', NULL, 1),
(35, 'Submit FaaBS training records', NULL, 1),
(36, 'View FaaBS training records', NULL, 1),
(37, 'Remove FaaBS training records', NULL, 1),
(38, 'Submit back to office report', NULL, 1),
(39, 'Review back to office report', NULL, 1),
(40, 'View back to office report', NULL, 1),
(43, 'Plan camp monthly activities', NULL, 1),
(44, 'Remove planned camp monthly activities', NULL, 1),
(45, 'View planned camp monthly activities', NULL, 1),
(46, 'Manage FaaBS training topics', NULL, 1),
(47, 'View FaaBS training topics', NULL, 1),
(48, 'Remove FaaBS training topics', NULL, 1),
(49, 'View facilitation of improved technologies/best practices report', NULL, 1),
(50, 'View MGF module', 'Permission to View the MGF module', 1),
(51, 'View MGF Applicants', NULL, 1),
(52, 'View MGF Organisations', NULL, 1),
(53, 'Update MGF Organisation', NULL, 1),
(54, 'View MGF Concept Note', NULL, 1),
(55, 'View MGF Application', NULL, 1),
(56, 'View MGF Evaluations', '', 1),
(57, 'View MGF Proposals', NULL, 1),
(58, 'View MGF Approvals', NULL, 1),
(59, 'View Project Components', NULL, 1),
(60, 'Review Concept Note', NULL, 1),
(61, 'View Concept Note', NULL, 1),
(62, 'View MGF Reviewers', 'Viewing of both Internal and External MGF Reviewers', 1),
(63, 'Create Reviewer', 'Create MGF Reviewer', 1),
(64, 'DACO Screen Eligibility', 'Screen Eligibility at district level', 1),
(65, 'Screen Concept Note', 'Screen Concept Note', 1),
(66, 'Screen Project Proposals', 'Screen Project Proposals', 1),
(67, 'Allocate Projects', 'Allocate Projects for reviewing', 1),
(68, 'PCO Screen Eligibility', 'Screen Eligibility at National level', 1),
(69, 'PACO Screen Eligibility', 'Screen Eligibility at Province level', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mgf_activity`
--
ALTER TABLE `mgf_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `componet_id` (`componet_id`);

--
-- Indexes for table `mgf_applicant`
--
ALTER TABLE `mgf_applicant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_applicant_province` (`province_id`),
  ADD KEY `fk_applicant_district` (`district_id`);

--
-- Indexes for table `mgf_application`
--
ALTER TABLE `mgf_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `mgf_approval`
--
ALTER TABLE `mgf_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conceptnote_id` (`conceptnote_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `mgf_approval_status`
--
ALTER TABLE `mgf_approval_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mgf_attachements`
--
ALTER TABLE `mgf_attachements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `mgf_bpi_categories`
--
ALTER TABLE `mgf_bpi_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_bpi_categories_indicators`
--
ALTER TABLE `mgf_bpi_categories_indicators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_branch`
--
ALTER TABLE `mgf_branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`),
  ADD KEY `fk_branch_province` (`province_id`),
  ADD KEY `fk_branch_district` (`district_id`);

--
-- Indexes for table `mgf_business_perfomance_indicator`
--
ALTER TABLE `mgf_business_perfomance_indicator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_checklist`
--
ALTER TABLE `mgf_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_component`
--
ALTER TABLE `mgf_component`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `mgf_concept_note`
--
ALTER TABLE `mgf_concept_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`),
  ADD KEY `organisation_id` (`organisation_id`),
  ADD KEY `operation_id` (`operation_id`);

--
-- Indexes for table `mgf_contact`
--
ALTER TABLE `mgf_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `mgf_costs_financing_plan`
--
ALTER TABLE `mgf_costs_financing_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `componentid` (`componentid`),
  ADD KEY `activityid` (`activityid`);

--
-- Indexes for table `mgf_costs_financing_plan_other_sources`
--
ALTER TABLE `mgf_costs_financing_plan_other_sources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `mgf_cumulative_profit`
--
ALTER TABLE `mgf_cumulative_profit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_district_eligibility`
--
ALTER TABLE `mgf_district_eligibility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_de_province` (`province_id`),
  ADD KEY `fk_de_district` (`district_id`),
  ADD KEY `fk_de_y` (`year_id`);

--
-- Indexes for table `mgf_eligibility`
--
ALTER TABLE `mgf_eligibility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `mgf_eligibility_approval`
--
ALTER TABLE `mgf_eligibility_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `mgf_environmental_consideration`
--
ALTER TABLE `mgf_environmental_consideration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_existing_facilities`
--
ALTER TABLE `mgf_existing_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `mgf_expected_beneficiaries`
--
ALTER TABLE `mgf_expected_beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `mgf_expected_outputs_and_gross_revenue`
--
ALTER TABLE `mgf_expected_outputs_and_gross_revenue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `mgf_experience`
--
ALTER TABLE `mgf_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `mgf_final_evaluation`
--
ALTER TABLE `mgf_final_evaluation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proposal_id` (`proposal_id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `mgf_implementation_arrangements_cooperating_partners`
--
ALTER TABLE `mgf_implementation_arrangements_cooperating_partners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `mgf_implementation_arrangements_staff`
--
ALTER TABLE `mgf_implementation_arrangements_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `mgf_implementation_arrangements_technical_assistance`
--
ALTER TABLE `mgf_implementation_arrangements_technical_assistance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `mgf_implementation_schedule`
--
ALTER TABLE `mgf_implementation_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_input_cost`
--
ALTER TABLE `mgf_input_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `mgf_input_item`
--
ALTER TABLE `mgf_input_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `mgf_interests_taxes`
--
ALTER TABLE `mgf_interests_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_netprofit`
--
ALTER TABLE `mgf_netprofit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_offer`
--
ALTER TABLE `mgf_offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `mgf_operation`
--
ALTER TABLE `mgf_operation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `operation_type` (`operation_type`);

--
-- Indexes for table `mgf_organisation`
--
ALTER TABLE `mgf_organisation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_no` (`registration_no`),
  ADD UNIQUE KEY `trade_license_no` (`trade_license_no`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `fk_org_province` (`province_id`),
  ADD KEY `fk_org_district` (`district_id`);

--
-- Indexes for table `mgf_organisational_details`
--
ALTER TABLE `mgf_organisational_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `mgf_partnership`
--
ALTER TABLE `mgf_partnership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `mgf_pastproject`
--
ALTER TABLE `mgf_pastproject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`),
  ADD KEY `experience_id` (`experience_id`);

--
-- Indexes for table `mgf_position`
--
ALTER TABLE `mgf_position`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `position` (`position`);

--
-- Indexes for table `mgf_product_market_marketing`
--
ALTER TABLE `mgf_product_market_marketing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `mgf_profit_before_interest_taxes`
--
ALTER TABLE `mgf_profit_before_interest_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_project_evaluation`
--
ALTER TABLE `mgf_project_evaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewedby` (`reviewedby`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `mgf_project_facilities`
--
ALTER TABLE `mgf_project_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `organisation_id` (`organisation_id`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `mgf_proposal`
--
ALTER TABLE `mgf_proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`),
  ADD KEY `fk_prop_province` (`province_id`),
  ADD KEY `fk_prop_district` (`district_id`);

--
-- Indexes for table `mgf_proposal_evaluation`
--
ALTER TABLE `mgf_proposal_evaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `criterion_id` (`criterion_id`);

--
-- Indexes for table `mgf_reviewer`
--
ALTER TABLE `mgf_reviewer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_code` (`login_code`);

--
-- Indexes for table `mgf_screening`
--
ALTER TABLE `mgf_screening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conceptnote_id` (`conceptnote_id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `mgf_selection_category`
--
ALTER TABLE `mgf_selection_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdby` (`createdby`);

--
-- Indexes for table `mgf_selection_criteria`
--
ALTER TABLE `mgf_selection_criteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `mgf_selection_grade`
--
ALTER TABLE `mgf_selection_grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `criterion_id` (`criterion_id`);

--
-- Indexes for table `mgf_settings`
--
ALTER TABLE `mgf_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_sustainability_scalability`
--
ALTER TABLE `mgf_sustainability_scalability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_unit`
--
ALTER TABLE `mgf_unit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unit` (`unit`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mgf_variable_fixed_cost_totals`
--
ALTER TABLE `mgf_variable_fixed_cost_totals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgf_window`
--
ALTER TABLE `mgf_window`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wnd_y` (`year_id`);

--
-- Indexes for table `mgf_year`
--
ALTER TABLE `mgf_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mgf_activity`
--
ALTER TABLE `mgf_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `mgf_applicant`
--
ALTER TABLE `mgf_applicant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `mgf_application`
--
ALTER TABLE `mgf_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `mgf_approval`
--
ALTER TABLE `mgf_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `mgf_approval_status`
--
ALTER TABLE `mgf_approval_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mgf_attachements`
--
ALTER TABLE `mgf_attachements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `mgf_bpi_categories`
--
ALTER TABLE `mgf_bpi_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mgf_bpi_categories_indicators`
--
ALTER TABLE `mgf_bpi_categories_indicators`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mgf_branch`
--
ALTER TABLE `mgf_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mgf_business_perfomance_indicator`
--
ALTER TABLE `mgf_business_perfomance_indicator`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mgf_checklist`
--
ALTER TABLE `mgf_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mgf_component`
--
ALTER TABLE `mgf_component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `mgf_concept_note`
--
ALTER TABLE `mgf_concept_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `mgf_contact`
--
ALTER TABLE `mgf_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `mgf_costs_financing_plan`
--
ALTER TABLE `mgf_costs_financing_plan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mgf_costs_financing_plan_other_sources`
--
ALTER TABLE `mgf_costs_financing_plan_other_sources`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgf_cumulative_profit`
--
ALTER TABLE `mgf_cumulative_profit`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mgf_district_eligibility`
--
ALTER TABLE `mgf_district_eligibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mgf_eligibility`
--
ALTER TABLE `mgf_eligibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `mgf_eligibility_approval`
--
ALTER TABLE `mgf_eligibility_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mgf_environmental_consideration`
--
ALTER TABLE `mgf_environmental_consideration`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mgf_existing_facilities`
--
ALTER TABLE `mgf_existing_facilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mgf_expected_beneficiaries`
--
ALTER TABLE `mgf_expected_beneficiaries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgf_expected_outputs_and_gross_revenue`
--
ALTER TABLE `mgf_expected_outputs_and_gross_revenue`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mgf_experience`
--
ALTER TABLE `mgf_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mgf_final_evaluation`
--
ALTER TABLE `mgf_final_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mgf_implementation_arrangements_cooperating_partners`
--
ALTER TABLE `mgf_implementation_arrangements_cooperating_partners`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgf_implementation_arrangements_staff`
--
ALTER TABLE `mgf_implementation_arrangements_staff`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgf_implementation_arrangements_technical_assistance`
--
ALTER TABLE `mgf_implementation_arrangements_technical_assistance`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgf_input_cost`
--
ALTER TABLE `mgf_input_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `mgf_input_item`
--
ALTER TABLE `mgf_input_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `mgf_offer`
--
ALTER TABLE `mgf_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mgf_operation`
--
ALTER TABLE `mgf_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mgf_organisation`
--
ALTER TABLE `mgf_organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `mgf_organisational_details`
--
ALTER TABLE `mgf_organisational_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mgf_partnership`
--
ALTER TABLE `mgf_partnership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mgf_pastproject`
--
ALTER TABLE `mgf_pastproject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mgf_position`
--
ALTER TABLE `mgf_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mgf_project_evaluation`
--
ALTER TABLE `mgf_project_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `mgf_proposal`
--
ALTER TABLE `mgf_proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mgf_proposal_evaluation`
--
ALTER TABLE `mgf_proposal_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- AUTO_INCREMENT for table `mgf_reviewer`
--
ALTER TABLE `mgf_reviewer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `mgf_screening`
--
ALTER TABLE `mgf_screening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `mgf_selection_category`
--
ALTER TABLE `mgf_selection_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mgf_selection_criteria`
--
ALTER TABLE `mgf_selection_criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mgf_selection_grade`
--
ALTER TABLE `mgf_selection_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `mgf_settings`
--
ALTER TABLE `mgf_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mgf_unit`
--
ALTER TABLE `mgf_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mgf_window`
--
ALTER TABLE `mgf_window`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mgf_year`
--
ALTER TABLE `mgf_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mgf_activity`
--
ALTER TABLE `mgf_activity`
  ADD CONSTRAINT `mgf_activity_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mgf_activity_ibfk_2` FOREIGN KEY (`componet_id`) REFERENCES `mgf_component` (`id`);

--
-- Constraints for table `mgf_applicant`
--
ALTER TABLE `mgf_applicant`
  ADD CONSTRAINT `fk_applicant_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `fk_applicant_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  ADD CONSTRAINT `mgf_applicant_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mgf_application`
--
ALTER TABLE `mgf_application`
  ADD CONSTRAINT `mgf_application_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `mgf_applicant` (`id`),
  ADD CONSTRAINT `mgf_application_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_approval`
--
ALTER TABLE `mgf_approval`
  ADD CONSTRAINT `mgf_approval_ibfk_1` FOREIGN KEY (`conceptnote_id`) REFERENCES `mgf_concept_note` (`id`),
  ADD CONSTRAINT `mgf_approval_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`);

--
-- Constraints for table `mgf_approval_status`
--
ALTER TABLE `mgf_approval_status`
  ADD CONSTRAINT `mgf_approval_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mgf_attachements`
--
ALTER TABLE `mgf_attachements`
  ADD CONSTRAINT `mgf_attachements_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`),
  ADD CONSTRAINT `mgf_attachements_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`);

--
-- Constraints for table `mgf_branch`
--
ALTER TABLE `mgf_branch`
  ADD CONSTRAINT `fk_branch_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `fk_branch_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  ADD CONSTRAINT `mgf_branch_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_component`
--
ALTER TABLE `mgf_component`
  ADD CONSTRAINT `mgf_component_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mgf_component_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`);

--
-- Constraints for table `mgf_concept_note`
--
ALTER TABLE `mgf_concept_note`
  ADD CONSTRAINT `mgf_concept_note_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`),
  ADD CONSTRAINT `mgf_concept_note_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`),
  ADD CONSTRAINT `mgf_concept_note_ibfk_3` FOREIGN KEY (`operation_id`) REFERENCES `mgf_operation` (`id`);

--
-- Constraints for table `mgf_contact`
--
ALTER TABLE `mgf_contact`
  ADD CONSTRAINT `mgf_contact_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`),
  ADD CONSTRAINT `mgf_contact_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `mgf_position` (`id`),
  ADD CONSTRAINT `mgf_contact_ibfk_3` FOREIGN KEY (`applicant_id`) REFERENCES `mgf_applicant` (`id`);

--
-- Constraints for table `mgf_district_eligibility`
--
ALTER TABLE `mgf_district_eligibility`
  ADD CONSTRAINT `fk_de_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `fk_de_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  ADD CONSTRAINT `fk_de_y` FOREIGN KEY (`year_id`) REFERENCES `mgf_year` (`id`);

--
-- Constraints for table `mgf_eligibility`
--
ALTER TABLE `mgf_eligibility`
  ADD CONSTRAINT `mgf_eligibility_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`),
  ADD CONSTRAINT `mgf_eligibility_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_eligibility_approval`
--
ALTER TABLE `mgf_eligibility_approval`
  ADD CONSTRAINT `mgf_eligibility_approval_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `mgf_application` (`id`);

--
-- Constraints for table `mgf_experience`
--
ALTER TABLE `mgf_experience`
  ADD CONSTRAINT `mgf_experience_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_final_evaluation`
--
ALTER TABLE `mgf_final_evaluation`
  ADD CONSTRAINT `mgf_final_evaluation_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`),
  ADD CONSTRAINT `mgf_final_evaluation_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_input_cost`
--
ALTER TABLE `mgf_input_cost`
  ADD CONSTRAINT `mgf_input_cost_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mgf_input_cost_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `mgf_activity` (`id`);

--
-- Constraints for table `mgf_input_item`
--
ALTER TABLE `mgf_input_item`
  ADD CONSTRAINT `mgf_input_item_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mgf_input_item_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `mgf_activity` (`id`);

--
-- Constraints for table `mgf_offer`
--
ALTER TABLE `mgf_offer`
  ADD CONSTRAINT `mgf_offer_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mgf_offer_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`),
  ADD CONSTRAINT `mgf_offer_ibfk_3` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_organisation`
--
ALTER TABLE `mgf_organisation`
  ADD CONSTRAINT `fk_org_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `fk_org_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  ADD CONSTRAINT `mgf_organisation_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `mgf_applicant` (`id`);

--
-- Constraints for table `mgf_organisational_details`
--
ALTER TABLE `mgf_organisational_details`
  ADD CONSTRAINT `mgf_organisational_details_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_partnership`
--
ALTER TABLE `mgf_partnership`
  ADD CONSTRAINT `mgf_partnership_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_pastproject`
--
ALTER TABLE `mgf_pastproject`
  ADD CONSTRAINT `mgf_pastproject_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`),
  ADD CONSTRAINT `mgf_pastproject_ibfk_2` FOREIGN KEY (`experience_id`) REFERENCES `mgf_experience` (`id`);

--
-- Constraints for table `mgf_project_evaluation`
--
ALTER TABLE `mgf_project_evaluation`
  ADD CONSTRAINT `mgf_project_evaluation_ibfk_1` FOREIGN KEY (`reviewedby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mgf_project_evaluation_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`),
  ADD CONSTRAINT `mgf_project_evaluation_ibfk_3` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_proposal`
--
ALTER TABLE `mgf_proposal`
  ADD CONSTRAINT `fk_prop_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `fk_prop_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  ADD CONSTRAINT `mgf_proposal_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_proposal_evaluation`
--
ALTER TABLE `mgf_proposal_evaluation`
  ADD CONSTRAINT `mgf_proposal_evaluation_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mgf_proposal_evaluation_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `mgf_proposal` (`id`),
  ADD CONSTRAINT `mgf_proposal_evaluation_ibfk_3` FOREIGN KEY (`criterion_id`) REFERENCES `mgf_selection_criteria` (`id`);

--
-- Constraints for table `mgf_screening`
--
ALTER TABLE `mgf_screening`
  ADD CONSTRAINT `mgf_screening_ibfk_1` FOREIGN KEY (`conceptnote_id`) REFERENCES `mgf_concept_note` (`id`),
  ADD CONSTRAINT `mgf_screening_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `mgf_organisation` (`id`);

--
-- Constraints for table `mgf_selection_category`
--
ALTER TABLE `mgf_selection_category`
  ADD CONSTRAINT `mgf_selection_category_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`);

--
-- Constraints for table `mgf_selection_criteria`
--
ALTER TABLE `mgf_selection_criteria`
  ADD CONSTRAINT `mgf_selection_criteria_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mgf_selection_criteria_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `mgf_selection_category` (`id`);

--
-- Constraints for table `mgf_selection_grade`
--
ALTER TABLE `mgf_selection_grade`
  ADD CONSTRAINT `mgf_selection_grade_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mgf_selection_grade_ibfk_2` FOREIGN KEY (`criterion_id`) REFERENCES `mgf_selection_criteria` (`id`);

--
-- Constraints for table `mgf_unit`
--
ALTER TABLE `mgf_unit`
  ADD CONSTRAINT `mgf_unit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mgf_window`
--
ALTER TABLE `mgf_window`
  ADD CONSTRAINT `fk_wnd_y` FOREIGN KEY (`year_id`) REFERENCES `mgf_year` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
