/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mtgcrm_staging
-- ------------------------------------------------------
-- Server version	10.6.23-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary table structure for view `desh_comp_1`
--

DROP TABLE IF EXISTS `desh_comp_1`;
/*!50001 DROP VIEW IF EXISTS `desh_comp_1`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `desh_comp_1` AS SELECT
 1 AS `is_deleted`,
  1 AS `compliance`,
  1 AS `id` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `desh_comp_2`
--

DROP TABLE IF EXISTS `desh_comp_2`;
/*!50001 DROP VIEW IF EXISTS `desh_comp_2`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `desh_comp_2` AS SELECT
 1 AS `compliance`,
  1 AS `id`,
  1 AS `project_id` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tbl_achive_files`
--

DROP TABLE IF EXISTS `tbl_achive_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_achive_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hyper_link` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_achive_files`
--

LOCK TABLES `tbl_achive_files` WRITE;
/*!40000 ALTER TABLE `tbl_achive_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_achive_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblactivity_log`
--

DROP TABLE IF EXISTS `tblactivity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblactivity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` mediumtext NOT NULL,
  `date` datetime NOT NULL,
  `staffid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staffid` (`staffid`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblactivity_log`
--

LOCK TABLES `tblactivity_log` WRITE;
/*!40000 ALTER TABLE `tblactivity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblactivity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblactivity_log_individual`
--

DROP TABLE IF EXISTS `tblactivity_log_individual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblactivity_log_individual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` mediumtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `staffid` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblactivity_log_individual`
--

LOCK TABLES `tblactivity_log_individual` WRITE;
/*!40000 ALTER TABLE `tblactivity_log_individual` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblactivity_log_individual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblactivity_log_policy`
--

DROP TABLE IF EXISTS `tblactivity_log_policy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblactivity_log_policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` mediumtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `staffid` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblactivity_log_policy`
--

LOCK TABLES `tblactivity_log_policy` WRITE;
/*!40000 ALTER TABLE `tblactivity_log_policy` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblactivity_log_policy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblannouncements`
--

DROP TABLE IF EXISTS `tblannouncements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblannouncements` (
  `announcementid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `message` text DEFAULT NULL,
  `showtousers` int(11) NOT NULL,
  `showtostaff` int(11) NOT NULL,
  `showname` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `userid` varchar(100) NOT NULL,
  PRIMARY KEY (`announcementid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblannouncements`
--

LOCK TABLES `tblannouncements` WRITE;
/*!40000 ALTER TABLE `tblannouncements` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblannouncements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblbenefit_category`
--

DROP TABLE IF EXISTS `tblbenefit_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblbenefit_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblbenefit_category`
--

LOCK TABLES `tblbenefit_category` WRITE;
/*!40000 ALTER TABLE `tblbenefit_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbenefit_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblbonus_discipline`
--

DROP TABLE IF EXISTS `tblbonus_discipline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblbonus_discipline` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `id_criteria` varchar(200) DEFAULT NULL,
  `type` int(3) NOT NULL,
  `apply_for` varchar(50) DEFAULT NULL,
  `from_time` datetime DEFAULT NULL,
  `lever_bonus` int(11) DEFAULT NULL,
  `approver` int(11) DEFAULT NULL,
  `url_file` longtext DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `id_admin` int(3) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblbonus_discipline`
--

LOCK TABLES `tblbonus_discipline` WRITE;
/*!40000 ALTER TABLE `tblbonus_discipline` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbonus_discipline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblbonus_discipline_detail`
--

DROP TABLE IF EXISTS `tblbonus_discipline_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblbonus_discipline_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_bonus_discipline` int(11) NOT NULL,
  `from_time` datetime DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `department_id` longtext DEFAULT NULL,
  `lever_bonus` int(11) DEFAULT NULL,
  `formality` varchar(50) DEFAULT NULL,
  `formality_value` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblbonus_discipline_detail`
--

LOCK TABLES `tblbonus_discipline_detail` WRITE;
/*!40000 ALTER TABLE `tblbonus_discipline_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbonus_discipline_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblbusiness_type`
--

DROP TABLE IF EXISTS `tblbusiness_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblbusiness_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_type` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblbusiness_type`
--

LOCK TABLES `tblbusiness_type` WRITE;
/*!40000 ALTER TABLE `tblbusiness_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbusiness_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblchecklist`
--

DROP TABLE IF EXISTS `tblchecklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblchecklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblchecklist`
--

LOCK TABLES `tblchecklist` WRITE;
/*!40000 ALTER TABLE `tblchecklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblchecklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblchecklist_allocation`
--

DROP TABLE IF EXISTS `tblchecklist_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblchecklist_allocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `staffid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblchecklist_allocation`
--

LOCK TABLES `tblchecklist_allocation` WRITE;
/*!40000 ALTER TABLE `tblchecklist_allocation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblchecklist_allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblclient_deactive_client_reason`
--

DROP TABLE IF EXISTS `tblclient_deactive_client_reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblclient_deactive_client_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `check_is_admin` int(11) NOT NULL DEFAULT 0 COMMENT 'admin=1;',
  `reason_of_disable` text NOT NULL,
  `deactivate_client_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1208 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblclient_deactive_client_reason`
--

LOCK TABLES `tblclient_deactive_client_reason` WRITE;
/*!40000 ALTER TABLE `tblclient_deactive_client_reason` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblclient_deactive_client_reason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblclient_review_month`
--

DROP TABLE IF EXISTS `tblclient_review_month`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblclient_review_month` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblclient_review_month`
--

LOCK TABLES `tblclient_review_month` WRITE;
/*!40000 ALTER TABLE `tblclient_review_month` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblclient_review_month` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblclients`
--

DROP TABLE IF EXISTS `tblclients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblclients` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(191) DEFAULT NULL,
  `vat` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT 0,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `leadid` int(11) DEFAULT NULL,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT 0,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT 0,
  `longitude` varchar(191) DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `default_language` varchar(40) DEFAULT NULL,
  `default_currency` int(11) NOT NULL DEFAULT 0,
  `show_primary_contact` int(11) NOT NULL DEFAULT 0,
  `stripe_id` varchar(40) DEFAULT NULL,
  `registration_confirmed` int(11) NOT NULL DEFAULT 1,
  `addedfrom` int(11) NOT NULL DEFAULT 0,
  `key_contact_name` varchar(100) DEFAULT NULL,
  `key_contact_phone` varchar(50) DEFAULT NULL,
  `key_contact_email` varchar(100) DEFAULT NULL,
  `client_review_date` date DEFAULT NULL,
  `client_type` int(11) DEFAULT NULL,
  `client_postal_address` varchar(100) DEFAULT NULL,
  `client_postal_city` varchar(100) DEFAULT NULL,
  `client_postal_state` varchar(100) DEFAULT NULL,
  `client_postal_zip_code` varchar(100) DEFAULT NULL,
  `client_postal_country` int(11) DEFAULT NULL,
  `addNote` text DEFAULT NULL,
  `adviser_data_contact` varchar(100) DEFAULT NULL,
  `contact_name` int(11) DEFAULT NULL,
  `individual_name` varchar(100) DEFAULT NULL,
  `individual_phonenumber` varchar(100) DEFAULT NULL,
  `individual_email` varchar(100) DEFAULT NULL,
  `individual_residential_address` varchar(150) DEFAULT NULL,
  `individual_postal_address` varchar(150) DEFAULT NULL,
  `client_review_month` int(11) DEFAULT NULL,
  `review_month_name` text DEFAULT NULL,
  `business` text DEFAULT NULL,
  `mtg_owned` text DEFAULT NULL,
  `import_id` text DEFAULT NULL,
  `file_archive` text DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `country` (`country`),
  KEY `leadid` (`leadid`),
  KEY `company` (`company`),
  KEY `active` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblclients`
--

LOCK TABLES `tblclients` WRITE;
/*!40000 ALTER TABLE `tblclients` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblclients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcomplaint_category`
--

DROP TABLE IF EXISTS `tblcomplaint_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcomplaint_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaints_category` varchar(150) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcomplaint_category`
--

LOCK TABLES `tblcomplaint_category` WRITE;
/*!40000 ALTER TABLE `tblcomplaint_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcomplaint_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblconsent_purposes`
--

DROP TABLE IF EXISTS `tblconsent_purposes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblconsent_purposes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblconsent_purposes`
--

LOCK TABLES `tblconsent_purposes` WRITE;
/*!40000 ALTER TABLE `tblconsent_purposes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblconsent_purposes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblconsents`
--

DROP TABLE IF EXISTS `tblconsents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblconsents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(40) NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `lead_id` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `opt_in_purpose_description` text DEFAULT NULL,
  `purpose_id` int(11) NOT NULL,
  `staff_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purpose_id` (`purpose_id`),
  KEY `contact_id` (`contact_id`),
  KEY `lead_id` (`lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblconsents`
--

LOCK TABLES `tblconsents` WRITE;
/*!40000 ALTER TABLE `tblconsents` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblconsents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontact_company_link`
--

DROP TABLE IF EXISTS `tblcontact_company_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontact_company_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontact_company_link`
--

LOCK TABLES `tblcontact_company_link` WRITE;
/*!40000 ALTER TABLE `tblcontact_company_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontact_company_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontact_permissions`
--

DROP TABLE IF EXISTS `tblcontact_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontact_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontact_permissions`
--

LOCK TABLES `tblcontact_permissions` WRITE;
/*!40000 ALTER TABLE `tblcontact_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontact_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontacts`
--

DROP TABLE IF EXISTS `tblcontacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `is_primary` int(11) NOT NULL DEFAULT 1,
  `firstname` varchar(191) NOT NULL,
  `lastname` varchar(191) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `homephone` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `new_pass_key` varchar(32) DEFAULT NULL,
  `new_pass_key_requested` datetime DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `email_verification_key` varchar(32) DEFAULT NULL,
  `email_verification_sent_at` datetime DEFAULT NULL,
  `last_ip` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_password_change` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `profile_image` varchar(191) DEFAULT NULL,
  `direction` varchar(3) DEFAULT NULL,
  `gender` varchar(3) DEFAULT NULL,
  `vulnerable_client` text DEFAULT NULL COMMENT '1="Yes",2="No"',
  `client_type` varchar(3) DEFAULT NULL COMMENT '1="Business",2="Personal"',
  `invoice_emails` tinyint(1) NOT NULL DEFAULT 1,
  `estimate_emails` tinyint(1) NOT NULL DEFAULT 1,
  `credit_note_emails` tinyint(1) NOT NULL DEFAULT 1,
  `contract_emails` tinyint(1) NOT NULL DEFAULT 1,
  `task_emails` tinyint(1) NOT NULL DEFAULT 1,
  `project_emails` tinyint(1) NOT NULL DEFAULT 1,
  `ticket_emails` tinyint(1) NOT NULL DEFAULT 1,
  `occupation` int(11) NOT NULL,
  `custom_occupation` varchar(255) DEFAULT NULL,
  `smoker` int(11) NOT NULL,
  `otp` int(11) NOT NULL,
  `residential_address` text DEFAULT NULL,
  `residential_city` text DEFAULT NULL,
  `residential_state` text DEFAULT NULL,
  `residential_zipcode` text DEFAULT NULL,
  `residential_country` text DEFAULT NULL,
  `postal_address` text DEFAULT NULL,
  `postal_city` text DEFAULT NULL,
  `postal_state` text DEFAULT NULL,
  `postal_zipcode` text DEFAULT NULL,
  `postal_country` text DEFAULT NULL,
  `additional_note` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `occupation_name` varchar(100) DEFAULT NULL,
  `imported_date` datetime DEFAULT NULL,
  `vulnerable_note` text DEFAULT NULL,
  `checkBox_vulnerable` int(11) DEFAULT 0,
  `import_id` text DEFAULT NULL,
  `preferredname` varchar(191) DEFAULT NULL,
  `dependent` int(11) DEFAULT NULL,
  `deceased` int(11) DEFAULT NULL,
  `business` int(11) DEFAULT NULL,
  `contact_key` int(11) DEFAULT NULL,
  `contactkey_address` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `firstname` (`firstname`),
  KEY `lastname` (`lastname`),
  KEY `email` (`email`),
  KEY `is_primary` (`is_primary`)
) ENGINE=InnoDB AUTO_INCREMENT=29120 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontacts`
--

LOCK TABLES `tblcontacts` WRITE;
/*!40000 ALTER TABLE `tblcontacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontract_comments`
--

DROP TABLE IF EXISTS `tblcontract_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontract_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext DEFAULT NULL,
  `contract_id` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontract_comments`
--

LOCK TABLES `tblcontract_comments` WRITE;
/*!40000 ALTER TABLE `tblcontract_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontract_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontract_renewals`
--

DROP TABLE IF EXISTS `tblcontract_renewals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontract_renewals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contractid` int(11) NOT NULL,
  `old_start_date` date NOT NULL,
  `new_start_date` date NOT NULL,
  `old_end_date` date DEFAULT NULL,
  `new_end_date` date DEFAULT NULL,
  `old_value` decimal(15,2) DEFAULT NULL,
  `new_value` decimal(15,2) DEFAULT NULL,
  `date_renewed` datetime NOT NULL,
  `renewed_by` varchar(100) NOT NULL,
  `renewed_by_staff_id` int(11) NOT NULL DEFAULT 0,
  `is_on_old_expiry_notified` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontract_renewals`
--

LOCK TABLES `tblcontract_renewals` WRITE;
/*!40000 ALTER TABLE `tblcontract_renewals` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontract_renewals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontracts`
--

DROP TABLE IF EXISTS `tblcontracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext DEFAULT NULL,
  `description` text DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `client` int(11) NOT NULL,
  `datestart` date DEFAULT NULL,
  `dateend` date DEFAULT NULL,
  `contract_type` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `isexpirynotified` int(11) NOT NULL DEFAULT 0,
  `contract_value` decimal(15,2) DEFAULT NULL,
  `trash` tinyint(1) DEFAULT 0,
  `not_visible_to_client` tinyint(1) NOT NULL DEFAULT 0,
  `hash` varchar(32) DEFAULT NULL,
  `signed` tinyint(1) NOT NULL DEFAULT 0,
  `signature` varchar(40) DEFAULT NULL,
  `marked_as_signed` tinyint(1) NOT NULL DEFAULT 0,
  `acceptance_firstname` varchar(50) DEFAULT NULL,
  `acceptance_lastname` varchar(50) DEFAULT NULL,
  `acceptance_email` varchar(100) DEFAULT NULL,
  `acceptance_date` datetime DEFAULT NULL,
  `acceptance_ip` varchar(40) DEFAULT NULL,
  `short_link` varchar(100) DEFAULT NULL,
  `recurring` int(11) NOT NULL DEFAULT 0,
  `recurring_type` varchar(100) DEFAULT NULL,
  `custom_recurring` tinyint(1) NOT NULL DEFAULT 0,
  `contact` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client` (`client`),
  KEY `contract_type` (`contract_type`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontracts`
--

LOCK TABLES `tblcontracts` WRITE;
/*!40000 ALTER TABLE `tblcontracts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontracts_types`
--

DROP TABLE IF EXISTS `tblcontracts_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontracts_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontracts_types`
--

LOCK TABLES `tblcontracts_types` WRITE;
/*!40000 ALTER TABLE `tblcontracts_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontracts_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcountries`
--

DROP TABLE IF EXISTS `tblcountries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcountries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `iso2` char(2) DEFAULT NULL,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` varchar(6) DEFAULT NULL,
  `un_member` varchar(12) DEFAULT NULL,
  `calling_code` varchar(8) DEFAULT NULL,
  `cctld` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcountries`
--

LOCK TABLES `tblcountries` WRITE;
/*!40000 ALTER TABLE `tblcountries` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcountries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcovertype`
--

DROP TABLE IF EXISTS `tblcovertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcovertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover_type` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcovertype`
--

LOCK TABLES `tblcovertype` WRITE;
/*!40000 ALTER TABLE `tblcovertype` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcovertype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcreditnote_refunds`
--

DROP TABLE IF EXISTS `tblcreditnote_refunds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcreditnote_refunds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `credit_note_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `refunded_on` date NOT NULL,
  `payment_mode` varchar(40) NOT NULL,
  `note` text DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcreditnote_refunds`
--

LOCK TABLES `tblcreditnote_refunds` WRITE;
/*!40000 ALTER TABLE `tblcreditnote_refunds` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcreditnote_refunds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcreditnotes`
--

DROP TABLE IF EXISTS `tblcreditnotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcreditnotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientid` int(11) NOT NULL,
  `deleted_customer_name` varchar(100) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `number_format` int(11) NOT NULL DEFAULT 1,
  `datecreated` datetime NOT NULL,
  `date` date NOT NULL,
  `adminnote` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `clientnote` text DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `total_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total` decimal(15,2) NOT NULL,
  `adjustment` decimal(15,2) DEFAULT NULL,
  `addedfrom` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `discount_percent` decimal(15,2) DEFAULT 0.00,
  `discount_total` decimal(15,2) DEFAULT 0.00,
  `discount_type` varchar(30) NOT NULL,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `show_shipping_on_credit_note` tinyint(1) NOT NULL DEFAULT 1,
  `show_quantity_as` int(11) NOT NULL DEFAULT 1,
  `reference_no` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currency` (`currency`),
  KEY `clientid` (`clientid`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcreditnotes`
--

LOCK TABLES `tblcreditnotes` WRITE;
/*!40000 ALTER TABLE `tblcreditnotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcreditnotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcredits`
--

DROP TABLE IF EXISTS `tblcredits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcredits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `credit_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_applied` datetime NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcredits`
--

LOCK TABLES `tblcredits` WRITE;
/*!40000 ALTER TABLE `tblcredits` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcredits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcurrencies`
--

DROP TABLE IF EXISTS `tblcurrencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcurrencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `decimal_separator` varchar(5) DEFAULT NULL,
  `thousand_separator` varchar(5) DEFAULT NULL,
  `placement` varchar(10) DEFAULT NULL,
  `isdefault` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcurrencies`
--

LOCK TABLES `tblcurrencies` WRITE;
/*!40000 ALTER TABLE `tblcurrencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcurrencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustomer_admins`
--

DROP TABLE IF EXISTS `tblcustomer_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcustomer_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_assigned` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26940 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomer_admins`
--

LOCK TABLES `tblcustomer_admins` WRITE;
/*!40000 ALTER TABLE `tblcustomer_admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomer_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustomer_adviser`
--

DROP TABLE IF EXISTS `tblcustomer_adviser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcustomer_adviser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_assigned` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19188 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomer_adviser`
--

LOCK TABLES `tblcustomer_adviser` WRITE;
/*!40000 ALTER TABLE `tblcustomer_adviser` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomer_adviser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustomer_groups`
--

DROP TABLE IF EXISTS `tblcustomer_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcustomer_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4549 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomer_groups`
--

LOCK TABLES `tblcustomer_groups` WRITE;
/*!40000 ALTER TABLE `tblcustomer_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomer_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustomer_occupation`
--

DROP TABLE IF EXISTS `tblcustomer_occupation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcustomer_occupation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occupation` varchar(150) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomer_occupation`
--

LOCK TABLES `tblcustomer_occupation` WRITE;
/*!40000 ALTER TABLE `tblcustomer_occupation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomer_occupation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustomer_smoker`
--

DROP TABLE IF EXISTS `tblcustomer_smoker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcustomer_smoker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smoker` varchar(150) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomer_smoker`
--

LOCK TABLES `tblcustomer_smoker` WRITE;
/*!40000 ALTER TABLE `tblcustomer_smoker` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomer_smoker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustomer_type`
--

DROP TABLE IF EXISTS `tblcustomer_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcustomer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_type` text NOT NULL,
  `view_type_sorting` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomer_type`
--

LOCK TABLES `tblcustomer_type` WRITE;
/*!40000 ALTER TABLE `tblcustomer_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomer_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustomers_groups`
--

DROP TABLE IF EXISTS `tblcustomers_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcustomers_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomers_groups`
--

LOCK TABLES `tblcustomers_groups` WRITE;
/*!40000 ALTER TABLE `tblcustomers_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomers_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustomfields`
--

DROP TABLE IF EXISTS `tblcustomfields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcustomfields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldto` varchar(30) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `type` varchar(20) NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `display_inline` tinyint(1) NOT NULL DEFAULT 0,
  `field_order` int(11) DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `show_on_pdf` int(11) NOT NULL DEFAULT 0,
  `show_on_ticket_form` tinyint(1) NOT NULL DEFAULT 0,
  `only_admin` tinyint(1) NOT NULL DEFAULT 0,
  `show_on_table` tinyint(1) NOT NULL DEFAULT 0,
  `show_on_client_portal` int(11) NOT NULL DEFAULT 0,
  `disalow_client_to_edit` int(11) NOT NULL DEFAULT 0,
  `bs_column` int(11) NOT NULL DEFAULT 12,
  `default_value` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomfields`
--

LOCK TABLES `tblcustomfields` WRITE;
/*!40000 ALTER TABLE `tblcustomfields` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomfields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustomfieldsvalues`
--

DROP TABLE IF EXISTS `tblcustomfieldsvalues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcustomfieldsvalues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relid` int(11) NOT NULL,
  `fieldid` int(11) NOT NULL,
  `fieldto` varchar(15) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relid` (`relid`),
  KEY `fieldto` (`fieldto`),
  KEY `fieldid` (`fieldid`)
) ENGINE=InnoDB AUTO_INCREMENT=396 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustomfieldsvalues`
--

LOCK TABLES `tblcustomfieldsvalues` WRITE;
/*!40000 ALTER TABLE `tblcustomfieldsvalues` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomfieldsvalues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldepartments`
--

DROP TABLE IF EXISTS `tbldepartments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbldepartments` (
  `departmentid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `imap_username` varchar(191) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_from_header` tinyint(1) NOT NULL DEFAULT 0,
  `host` varchar(150) DEFAULT NULL,
  `password` mediumtext DEFAULT NULL,
  `encryption` varchar(3) DEFAULT NULL,
  `folder` varchar(191) NOT NULL DEFAULT 'INBOX',
  `delete_after_import` int(11) NOT NULL DEFAULT 0,
  `calendar_id` mediumtext DEFAULT NULL,
  `hidefromclient` tinyint(1) NOT NULL DEFAULT 0,
  `manager_id` int(11) DEFAULT 0,
  `parent_id` int(11) DEFAULT 0,
  PRIMARY KEY (`departmentid`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldepartments`
--

LOCK TABLES `tbldepartments` WRITE;
/*!40000 ALTER TABLE `tbldepartments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldepartments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldiagramy`
--

DROP TABLE IF EXISTS `tbldiagramy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbldiagramy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `related_to` varchar(255) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `staffid` int(11) DEFAULT 0,
  `diagramy_group_id` int(11) DEFAULT 0,
  `diagramy_content` text DEFAULT NULL,
  `diagramy_slug` varchar(255) DEFAULT NULL,
  `dateadded` datetime DEFAULT NULL,
  `dateaupdated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staffid` (`staffid`),
  KEY `diagramy_group_id` (`diagramy_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldiagramy`
--

LOCK TABLES `tbldiagramy` WRITE;
/*!40000 ALTER TABLE `tbldiagramy` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldiagramy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldiagramy_groups`
--

DROP TABLE IF EXISTS `tbldiagramy_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbldiagramy_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldiagramy_groups`
--

LOCK TABLES `tbldiagramy_groups` WRITE;
/*!40000 ALTER TABLE `tbldiagramy_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldiagramy_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldismissed_announcements`
--

DROP TABLE IF EXISTS `tbldismissed_announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbldismissed_announcements` (
  `dismissedannouncementid` int(11) NOT NULL AUTO_INCREMENT,
  `announcementid` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`dismissedannouncementid`),
  KEY `announcementid` (`announcementid`),
  KEY `staff` (`staff`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldismissed_announcements`
--

LOCK TABLES `tbldismissed_announcements` WRITE;
/*!40000 ALTER TABLE `tbldismissed_announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldismissed_announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemail_template_manage_mail_attachments`
--

DROP TABLE IF EXISTS `tblemail_template_manage_mail_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemail_template_manage_mail_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_path` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mail_id` (`mail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemail_template_manage_mail_attachments`
--

LOCK TABLES `tblemail_template_manage_mail_attachments` WRITE;
/*!40000 ALTER TABLE `tblemail_template_manage_mail_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemail_template_manage_mail_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemail_template_manage_mail_logs`
--

DROP TABLE IF EXISTS `tblemail_template_manage_mail_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemail_template_manage_mail_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_type` varchar(50) DEFAULT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `company_email` varchar(250) DEFAULT NULL,
  `company_cc` varchar(250) DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `mail_subject` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `added_staff_id` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `opened` tinyint(4) DEFAULT 0,
  `date_opened` datetime DEFAULT NULL,
  `system_template_id` varchar(100) DEFAULT NULL,
  `system_template_slug` varchar(100) DEFAULT NULL,
  `trigger_id` int(11) DEFAULT 0,
  `send_rel_type` varchar(50) DEFAULT NULL,
  `send_rel_id` int(11) DEFAULT NULL,
  `smtp_setting_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `rel_type` (`rel_type`),
  KEY `rel_id` (`rel_id`),
  KEY `template_id` (`template_id`),
  KEY `trigger_id` (`trigger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemail_template_manage_mail_logs`
--

LOCK TABLES `tblemail_template_manage_mail_logs` WRITE;
/*!40000 ALTER TABLE `tblemail_template_manage_mail_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemail_template_manage_mail_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemail_template_manage_sending_logs`
--

DROP TABLE IF EXISTS `tblemail_template_manage_sending_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemail_template_manage_sending_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `error_message` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `mail_address` varchar(255) DEFAULT NULL,
  `mail_company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mail_id` (`mail_id`),
  KEY `client_id` (`client_id`),
  KEY `lead_id` (`lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemail_template_manage_sending_logs`
--

LOCK TABLES `tblemail_template_manage_sending_logs` WRITE;
/*!40000 ALTER TABLE `tblemail_template_manage_sending_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemail_template_manage_sending_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemail_template_manage_system_templates`
--

DROP TABLE IF EXISTS `tblemail_template_manage_system_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemail_template_manage_system_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_slug` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemail_template_manage_system_templates`
--

LOCK TABLES `tblemail_template_manage_system_templates` WRITE;
/*!40000 ALTER TABLE `tblemail_template_manage_system_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemail_template_manage_system_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemail_template_manage_templates`
--

DROP TABLE IF EXISTS `tblemail_template_manage_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemail_template_manage_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(150) DEFAULT NULL,
  `template_content` text DEFAULT NULL,
  `template_subject` varchar(255) DEFAULT NULL,
  `related_type` varchar(10) DEFAULT 'all',
  `status` tinyint(4) DEFAULT 1,
  `date` datetime DEFAULT NULL,
  `added_staff_id` int(11) DEFAULT 0,
  `is_public` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemail_template_manage_templates`
--

LOCK TABLES `tblemail_template_manage_templates` WRITE;
/*!40000 ALTER TABLE `tblemail_template_manage_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemail_template_manage_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemail_template_manage_timer`
--

DROP TABLE IF EXISTS `tblemail_template_manage_timer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemail_template_manage_timer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `client_groups` varchar(150) DEFAULT NULL,
  `lead_statuses` varchar(150) DEFAULT NULL,
  `lead_sources` varchar(150) DEFAULT NULL,
  `leads` varchar(255) DEFAULT NULL,
  `clients` varchar(255) DEFAULT NULL,
  `sending_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `send_status` tinyint(4) DEFAULT 0,
  `sending_hour` tinyint(4) DEFAULT 0,
  `not_clients` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemail_template_manage_timer`
--

LOCK TABLES `tblemail_template_manage_timer` WRITE;
/*!40000 ALTER TABLE `tblemail_template_manage_timer` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemail_template_manage_timer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemail_template_manage_trigger_logs`
--

DROP TABLE IF EXISTS `tblemail_template_manage_trigger_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemail_template_manage_trigger_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trigger_id` int(11) DEFAULT NULL,
  `trigger_rel_id` int(11) DEFAULT NULL,
  `send_rel_type` varchar(25) DEFAULT NULL,
  `send_rel_id` int(11) DEFAULT 0,
  `mail_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trigger_id` (`trigger_id`),
  KEY `send_rel_type` (`send_rel_type`),
  KEY `send_rel_id` (`send_rel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemail_template_manage_trigger_logs`
--

LOCK TABLES `tblemail_template_manage_trigger_logs` WRITE;
/*!40000 ALTER TABLE `tblemail_template_manage_trigger_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemail_template_manage_trigger_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemail_template_manage_triggers`
--

DROP TABLE IF EXISTS `tblemail_template_manage_triggers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemail_template_manage_triggers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trigger_name` varchar(255) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `rel_type` varchar(20) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `staff_active` tinyint(4) DEFAULT 0,
  `client_active` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `sending_hour` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  KEY `rel_type` (`rel_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemail_template_manage_triggers`
--

LOCK TABLES `tblemail_template_manage_triggers` WRITE;
/*!40000 ALTER TABLE `tblemail_template_manage_triggers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemail_template_manage_triggers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemail_template_smtp_settings`
--

DROP TABLE IF EXISTS `tblemail_template_smtp_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemail_template_smtp_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(200) DEFAULT NULL,
  `mail_engine` varchar(30) DEFAULT NULL,
  `email_protocol` varchar(10) DEFAULT NULL,
  `smtp_encryption` varchar(10) DEFAULT NULL,
  `smtp_host` varchar(150) DEFAULT NULL,
  `smtp_port` varchar(20) DEFAULT NULL,
  `smtp_email` varchar(150) DEFAULT NULL,
  `smtp_username` varchar(150) DEFAULT NULL,
  `smtp_password` varchar(100) DEFAULT NULL,
  `smtp_email_charset` varchar(20) DEFAULT NULL,
  `is_public` tinyint(4) DEFAULT 1,
  `status` tinyint(4) DEFAULT 1,
  `active_staff` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemail_template_smtp_settings`
--

LOCK TABLES `tblemail_template_smtp_settings` WRITE;
/*!40000 ALTER TABLE `tblemail_template_smtp_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemail_template_smtp_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemaillists`
--

DROP TABLE IF EXISTS `tblemaillists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemaillists` (
  `listid` int(11) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `creator` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL,
  PRIMARY KEY (`listid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemaillists`
--

LOCK TABLES `tblemaillists` WRITE;
/*!40000 ALTER TABLE `tblemaillists` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemaillists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemailtemplates`
--

DROP TABLE IF EXISTS `tblemailtemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemailtemplates` (
  `emailtemplateid` int(11) NOT NULL AUTO_INCREMENT,
  `type` mediumtext NOT NULL,
  `slug` varchar(100) NOT NULL,
  `language` varchar(40) DEFAULT NULL,
  `name` mediumtext NOT NULL,
  `subject` mediumtext NOT NULL,
  `message` mediumtext NOT NULL,
  `fromname` mediumtext NOT NULL,
  `fromemail` varchar(100) DEFAULT NULL,
  `plaintext` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`emailtemplateid`)
) ENGINE=InnoDB AUTO_INCREMENT=2065 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemailtemplates`
--

LOCK TABLES `tblemailtemplates` WRITE;
/*!40000 ALTER TABLE `tblemailtemplates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemailtemplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblestimate_request_forms`
--

DROP TABLE IF EXISTS `tblestimate_request_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblestimate_request_forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_key` varchar(32) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(191) NOT NULL,
  `form_data` mediumtext DEFAULT NULL,
  `recaptcha` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `submit_btn_name` varchar(100) DEFAULT NULL,
  `submit_btn_bg_color` varchar(10) DEFAULT '#84c529',
  `submit_btn_text_color` varchar(10) DEFAULT '#ffffff',
  `success_submit_msg` text DEFAULT NULL,
  `submit_action` int(11) DEFAULT 0,
  `submit_redirect_url` mediumtext DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `dateadded` datetime DEFAULT NULL,
  `notify_type` varchar(100) DEFAULT NULL,
  `notify_ids` mediumtext DEFAULT NULL,
  `responsible` int(11) DEFAULT NULL,
  `notify_request_submitted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblestimate_request_forms`
--

LOCK TABLES `tblestimate_request_forms` WRITE;
/*!40000 ALTER TABLE `tblestimate_request_forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblestimate_request_forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblestimate_request_status`
--

DROP TABLE IF EXISTS `tblestimate_request_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblestimate_request_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `statusorder` int(11) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `flag` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblestimate_request_status`
--

LOCK TABLES `tblestimate_request_status` WRITE;
/*!40000 ALTER TABLE `tblestimate_request_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblestimate_request_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblestimate_requests`
--

DROP TABLE IF EXISTS `tblestimate_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblestimate_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `submission` longtext NOT NULL,
  `last_status_change` datetime DEFAULT NULL,
  `date_estimated` datetime DEFAULT NULL,
  `from_form_id` int(11) DEFAULT NULL,
  `assigned` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `default_language` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblestimate_requests`
--

LOCK TABLES `tblestimate_requests` WRITE;
/*!40000 ALTER TABLE `tblestimate_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblestimate_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblestimates`
--

DROP TABLE IF EXISTS `tblestimates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblestimates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sent` tinyint(1) NOT NULL DEFAULT 0,
  `datesend` datetime DEFAULT NULL,
  `clientid` int(11) NOT NULL,
  `deleted_customer_name` varchar(100) DEFAULT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `number` int(11) NOT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `number_format` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(32) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `date` date NOT NULL,
  `expirydate` date DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `total_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total` decimal(15,2) NOT NULL,
  `adjustment` decimal(15,2) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `clientnote` text DEFAULT NULL,
  `adminnote` text DEFAULT NULL,
  `discount_percent` decimal(15,2) DEFAULT 0.00,
  `discount_total` decimal(15,2) DEFAULT 0.00,
  `discount_type` varchar(30) DEFAULT NULL,
  `invoiceid` int(11) DEFAULT NULL,
  `invoiced_date` datetime DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `reference_no` varchar(100) DEFAULT NULL,
  `sale_agent` int(11) NOT NULL DEFAULT 0,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `show_shipping_on_estimate` tinyint(1) NOT NULL DEFAULT 1,
  `show_quantity_as` int(11) NOT NULL DEFAULT 1,
  `pipeline_order` int(11) DEFAULT 1,
  `is_expiry_notified` int(11) NOT NULL DEFAULT 0,
  `acceptance_firstname` varchar(50) DEFAULT NULL,
  `acceptance_lastname` varchar(50) DEFAULT NULL,
  `acceptance_email` varchar(100) DEFAULT NULL,
  `acceptance_date` datetime DEFAULT NULL,
  `acceptance_ip` varchar(40) DEFAULT NULL,
  `signature` varchar(40) DEFAULT NULL,
  `short_link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientid` (`clientid`),
  KEY `currency` (`currency`),
  KEY `project_id` (`project_id`),
  KEY `sale_agent` (`sale_agent`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblestimates`
--

LOCK TABLES `tblestimates` WRITE;
/*!40000 ALTER TABLE `tblestimates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblestimates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblevents`
--

DROP TABLE IF EXISTS `tblevents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblevents` (
  `eventid` int(11) NOT NULL AUTO_INCREMENT,
  `title` mediumtext NOT NULL,
  `description` text DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `public` int(11) NOT NULL DEFAULT 0,
  `color` varchar(10) DEFAULT NULL,
  `isstartnotified` tinyint(1) NOT NULL DEFAULT 0,
  `reminder_before` int(11) NOT NULL DEFAULT 0,
  `reminder_before_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`eventid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblevents`
--

LOCK TABLES `tblevents` WRITE;
/*!40000 ALTER TABLE `tblevents` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblevents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblexpenses`
--

DROP TABLE IF EXISTS `tblexpenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblexpenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `currency` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `tax` int(11) DEFAULT NULL,
  `tax2` int(11) NOT NULL DEFAULT 0,
  `reference_no` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `expense_name` varchar(191) DEFAULT NULL,
  `clientid` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `billable` int(11) DEFAULT 0,
  `invoiceid` int(11) DEFAULT NULL,
  `paymentmode` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `recurring_type` varchar(10) DEFAULT NULL,
  `repeat_every` int(11) DEFAULT NULL,
  `recurring` int(11) NOT NULL DEFAULT 0,
  `cycles` int(11) NOT NULL DEFAULT 0,
  `total_cycles` int(11) NOT NULL DEFAULT 0,
  `custom_recurring` int(11) NOT NULL DEFAULT 0,
  `last_recurring_date` date DEFAULT NULL,
  `create_invoice_billable` tinyint(1) DEFAULT NULL,
  `send_invoice_to_customer` tinyint(1) NOT NULL,
  `recurring_from` int(11) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `addedfrom` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clientid` (`clientid`),
  KEY `project_id` (`project_id`),
  KEY `category` (`category`),
  KEY `currency` (`currency`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblexpenses`
--

LOCK TABLES `tblexpenses` WRITE;
/*!40000 ALTER TABLE `tblexpenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblexpenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblexpenses_categories`
--

DROP TABLE IF EXISTS `tblexpenses_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblexpenses_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblexpenses_categories`
--

LOCK TABLES `tblexpenses_categories` WRITE;
/*!40000 ALTER TABLE `tblexpenses_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblexpenses_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_approval_details`
--

DROP TABLE IF EXISTS `tblfe_approval_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_approval_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(45) NOT NULL,
  `staffid` varchar(45) DEFAULT NULL,
  `approve` varchar(45) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `approve_action` varchar(255) DEFAULT NULL,
  `reject_action` varchar(255) DEFAULT NULL,
  `approve_value` varchar(255) DEFAULT NULL,
  `reject_value` varchar(255) DEFAULT NULL,
  `staff_approve` int(11) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `date_send` datetime DEFAULT NULL,
  `notification_recipient` longtext DEFAULT NULL,
  `approval_deadline` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_approval_details`
--

LOCK TABLES `tblfe_approval_details` WRITE;
/*!40000 ALTER TABLE `tblfe_approval_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_approval_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_approval_setting`
--

DROP TABLE IF EXISTS `tblfe_approval_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_approval_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `related` varchar(255) NOT NULL,
  `setting` longtext NOT NULL,
  `choose_when_approving` int(11) NOT NULL DEFAULT 0,
  `notification_recipient` longtext DEFAULT NULL,
  `number_day_approval` int(11) DEFAULT NULL,
  `departments` text DEFAULT NULL,
  `job_positions` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_approval_setting`
--

LOCK TABLES `tblfe_approval_setting` WRITE;
/*!40000 ALTER TABLE `tblfe_approval_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_approval_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_asset_maintenances`
--

DROP TABLE IF EXISTS `tblfe_asset_maintenances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_asset_maintenances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `maintenance_type` varchar(30) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `completion_date` date DEFAULT NULL,
  `cost` decimal(15,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  `warranty_improvement` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_asset_maintenances`
--

LOCK TABLES `tblfe_asset_maintenances` WRITE;
/*!40000 ALTER TABLE `tblfe_asset_maintenances` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_asset_maintenances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_asset_manufacturers`
--

DROP TABLE IF EXISTS `tblfe_asset_manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_asset_manufacturers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `url` text DEFAULT NULL,
  `support_url` text DEFAULT NULL,
  `support_phone` varchar(50) DEFAULT NULL,
  `support_email` varchar(100) DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_asset_manufacturers`
--

LOCK TABLES `tblfe_asset_manufacturers` WRITE;
/*!40000 ALTER TABLE `tblfe_asset_manufacturers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_asset_manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_assets`
--

DROP TABLE IF EXISTS `tblfe_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assets_code` varchar(20) DEFAULT NULL,
  `assets_name` varchar(255) DEFAULT NULL,
  `series` varchar(200) DEFAULT NULL,
  `asset_group` int(11) DEFAULT NULL,
  `asset_location` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `date_buy` date DEFAULT NULL,
  `warranty_period` int(11) DEFAULT NULL,
  `unit_price` decimal(15,2) DEFAULT NULL,
  `depreciation` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `order_number` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `requestable` int(11) DEFAULT 0,
  `qr_code` varchar(300) DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'asset',
  `status` int(11) NOT NULL DEFAULT 1,
  `checkin_out` int(11) NOT NULL DEFAULT 1,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) DEFAULT NULL,
  `min_quantity` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_key` text DEFAULT NULL,
  `seats` varchar(50) DEFAULT NULL,
  `model_no` varchar(80) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `licensed_to_name` text DEFAULT NULL,
  `licensed_to_email` text DEFAULT NULL,
  `reassignable` int(11) NOT NULL DEFAULT 0,
  `termination_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `purchase_order_number` varchar(150) DEFAULT NULL,
  `maintained` int(11) NOT NULL DEFAULT 0,
  `item_no` varchar(80) DEFAULT NULL,
  `checkin_out_id` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_assets`
--

LOCK TABLES `tblfe_assets` WRITE;
/*!40000 ALTER TABLE `tblfe_assets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_audit_detail_requests`
--

DROP TABLE IF EXISTS `tblfe_audit_detail_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_audit_detail_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) DEFAULT NULL,
  `asset_name` varchar(300) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `adjusted` int(11) DEFAULT NULL,
  `accept` int(11) NOT NULL DEFAULT 0,
  `audit_id` int(11) DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  `maintenance` int(11) NOT NULL DEFAULT 0,
  `maintenance_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_audit_detail_requests`
--

LOCK TABLES `tblfe_audit_detail_requests` WRITE;
/*!40000 ALTER TABLE `tblfe_audit_detail_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_audit_detail_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_audit_requests`
--

DROP TABLE IF EXISTS `tblfe_audit_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_audit_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `audit_date` datetime NOT NULL DEFAULT current_timestamp(),
  `auditor` int(11) DEFAULT NULL,
  `asset_location` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `asset_id` text DEFAULT NULL,
  `checkin_checkout_status` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `closed` int(11) NOT NULL DEFAULT 0,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_audit_requests`
--

LOCK TABLES `tblfe_audit_requests` WRITE;
/*!40000 ALTER TABLE `tblfe_audit_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_audit_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_categories`
--

DROP TABLE IF EXISTS `tblfe_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `category_eula` text DEFAULT NULL,
  `primary_default_eula` bit(1) NOT NULL DEFAULT b'0',
  `confirm_acceptance` bit(1) NOT NULL DEFAULT b'0',
  `send_mail_to_user` bit(1) NOT NULL DEFAULT b'0',
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_categories`
--

LOCK TABLES `tblfe_categories` WRITE;
/*!40000 ALTER TABLE `tblfe_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_checkin_assets`
--

DROP TABLE IF EXISTS `tblfe_checkin_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_checkin_assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(200) DEFAULT NULL,
  `asset_name` varchar(200) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `checkout_to` varchar(20) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `expected_checkin_date` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  `check_status` int(11) NOT NULL DEFAULT 2,
  `requestable` int(11) NOT NULL DEFAULT 0,
  `request_status` int(11) NOT NULL DEFAULT 0,
  `request_title` varchar(300) DEFAULT NULL,
  `predefined_kit_id` int(11) DEFAULT NULL,
  `item_type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_checkin_assets`
--

LOCK TABLES `tblfe_checkin_assets` WRITE;
/*!40000 ALTER TABLE `tblfe_checkin_assets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_checkin_assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_custom_field_values`
--

DROP TABLE IF EXISTS `tblfe_custom_field_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_custom_field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `option` text DEFAULT NULL,
  `required` int(11) NOT NULL DEFAULT 1,
  `value` text DEFAULT NULL,
  `fieldset_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_custom_field_values`
--

LOCK TABLES `tblfe_custom_field_values` WRITE;
/*!40000 ALTER TABLE `tblfe_custom_field_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_custom_field_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_custom_fields`
--

DROP TABLE IF EXISTS `tblfe_custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `option` text DEFAULT NULL,
  `required` int(11) NOT NULL DEFAULT 1,
  `default_value` text DEFAULT NULL,
  `fieldset_id` int(11) NOT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_custom_fields`
--

LOCK TABLES `tblfe_custom_fields` WRITE;
/*!40000 ALTER TABLE `tblfe_custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_depreciations`
--

DROP TABLE IF EXISTS `tblfe_depreciations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_depreciations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `term` double DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_depreciations`
--

LOCK TABLES `tblfe_depreciations` WRITE;
/*!40000 ALTER TABLE `tblfe_depreciations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_depreciations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_fieldsets`
--

DROP TABLE IF EXISTS `tblfe_fieldsets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_fieldsets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_fieldsets`
--

LOCK TABLES `tblfe_fieldsets` WRITE;
/*!40000 ALTER TABLE `tblfe_fieldsets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_fieldsets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_locations`
--

DROP TABLE IF EXISTS `tblfe_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_locations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `location_name` varchar(200) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `manager` int(11) DEFAULT NULL,
  `location_currency` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_locations`
--

LOCK TABLES `tblfe_locations` WRITE;
/*!40000 ALTER TABLE `tblfe_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_log_assets`
--

DROP TABLE IF EXISTS `tblfe_log_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_log_assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `target` varchar(200) DEFAULT NULL,
  `changed` varchar(200) DEFAULT NULL,
  `to` varchar(20) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_log_assets`
--

LOCK TABLES `tblfe_log_assets` WRITE;
/*!40000 ALTER TABLE `tblfe_log_assets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_log_assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_model_predefined_kits`
--

DROP TABLE IF EXISTS `tblfe_model_predefined_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_model_predefined_kits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_model_predefined_kits`
--

LOCK TABLES `tblfe_model_predefined_kits` WRITE;
/*!40000 ALTER TABLE `tblfe_model_predefined_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_model_predefined_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_models`
--

DROP TABLE IF EXISTS `tblfe_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_models` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `model_name` varchar(200) NOT NULL,
  `manufacturer` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `model_no` varchar(200) DEFAULT NULL,
  `depreciation` int(11) DEFAULT NULL,
  `eol` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `custom_field` text DEFAULT NULL,
  `may_request` bit(1) NOT NULL DEFAULT b'0',
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  `fieldset_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_models`
--

LOCK TABLES `tblfe_models` WRITE;
/*!40000 ALTER TABLE `tblfe_models` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_seats`
--

DROP TABLE IF EXISTS `tblfe_seats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seat_name` varchar(200) DEFAULT NULL,
  `to` varchar(20) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `license_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_seats`
--

LOCK TABLES `tblfe_seats` WRITE;
/*!40000 ALTER TABLE `tblfe_seats` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_seats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_sign_documents`
--

DROP TABLE IF EXISTS `tblfe_sign_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_sign_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkin_out_id` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `check_to_staff` int(11) DEFAULT NULL,
  `reference` varchar(30) DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_sign_documents`
--

LOCK TABLES `tblfe_sign_documents` WRITE;
/*!40000 ALTER TABLE `tblfe_sign_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_sign_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_signers`
--

DROP TABLE IF EXISTS `tblfe_signers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_signers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sign_document_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `date_of_signing` datetime DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_signers`
--

LOCK TABLES `tblfe_signers` WRITE;
/*!40000 ALTER TABLE `tblfe_signers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_signers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_status_labels`
--

DROP TABLE IF EXISTS `tblfe_status_labels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_status_labels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status_type` varchar(30) NOT NULL,
  `chart_color` varchar(30) NOT NULL,
  `note` text DEFAULT NULL,
  `show_in_side_nav` bit(1) NOT NULL DEFAULT b'0',
  `default_label` bit(1) NOT NULL DEFAULT b'0',
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_status_labels`
--

LOCK TABLES `tblfe_status_labels` WRITE;
/*!40000 ALTER TABLE `tblfe_status_labels` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_status_labels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfe_suppliers`
--

DROP TABLE IF EXISTS `tblfe_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfe_suppliers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(200) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `contact_name` varchar(200) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `date_creator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfe_suppliers`
--

LOCK TABLES `tblfe_suppliers` WRITE;
/*!40000 ALTER TABLE `tblfe_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfe_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfiles`
--

DROP TABLE IF EXISTS `tblfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `filename_Notencript` varchar(191) DEFAULT NULL,
  `client_file_discription` text DEFAULT NULL,
  `filetype` varchar(40) DEFAULT NULL,
  `visible_to_customer` int(11) NOT NULL DEFAULT 0,
  `attachment_key` varchar(32) DEFAULT NULL,
  `external` varchar(40) DEFAULT NULL,
  `external_link` text DEFAULT NULL,
  `thumbnail_link` text DEFAULT NULL COMMENT 'For external usage',
  `staffid` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT 0,
  `task_comment_id` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `compliance_id` int(11) DEFAULT NULL,
  `category_name` text DEFAULT NULL,
  `compliance_name` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_id` (`rel_id`),
  KEY `rel_type` (`rel_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfiles`
--

LOCK TABLES `tblfiles` WRITE;
/*!40000 ALTER TABLE `tblfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfilter_detail`
--

DROP TABLE IF EXISTS `tblfilter_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfilter_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_filter` int(11) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  `xday` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfilter_detail`
--

LOCK TABLES `tblfilter_detail` WRITE;
/*!40000 ALTER TABLE `tblfilter_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfilter_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblform_question_box`
--

DROP TABLE IF EXISTS `tblform_question_box`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblform_question_box` (
  `boxid` int(11) NOT NULL AUTO_INCREMENT,
  `boxtype` varchar(10) NOT NULL,
  `questionid` int(11) NOT NULL,
  PRIMARY KEY (`boxid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblform_question_box`
--

LOCK TABLES `tblform_question_box` WRITE;
/*!40000 ALTER TABLE `tblform_question_box` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblform_question_box` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblform_question_box_description`
--

DROP TABLE IF EXISTS `tblform_question_box_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblform_question_box_description` (
  `questionboxdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` mediumtext NOT NULL,
  `boxid` mediumtext NOT NULL,
  `questionid` int(11) NOT NULL,
  PRIMARY KEY (`questionboxdescriptionid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblform_question_box_description`
--

LOCK TABLES `tblform_question_box_description` WRITE;
/*!40000 ALTER TABLE `tblform_question_box_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblform_question_box_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblform_questions`
--

DROP TABLE IF EXISTS `tblform_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblform_questions` (
  `questionid` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) DEFAULT NULL,
  `question` mediumtext NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `question_order` int(11) NOT NULL,
  PRIMARY KEY (`questionid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblform_questions`
--

LOCK TABLES `tblform_questions` WRITE;
/*!40000 ALTER TABLE `tblform_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblform_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblform_results`
--

DROP TABLE IF EXISTS `tblform_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblform_results` (
  `resultid` int(11) NOT NULL AUTO_INCREMENT,
  `boxid` int(11) NOT NULL,
  `boxdescriptionid` int(11) DEFAULT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) DEFAULT NULL,
  `questionid` int(11) NOT NULL,
  `answer` text DEFAULT NULL,
  `resultsetid` int(11) NOT NULL,
  PRIMARY KEY (`resultid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblform_results`
--

LOCK TABLES `tblform_results` WRITE;
/*!40000 ALTER TABLE `tblform_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblform_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfs_downloads`
--

DROP TABLE IF EXISTS `tblfs_downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfs_downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_share` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `browser_name` varchar(45) DEFAULT NULL,
  `http_user_agent` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfs_downloads`
--

LOCK TABLES `tblfs_downloads` WRITE;
/*!40000 ALTER TABLE `tblfs_downloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfs_downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfs_file_overview`
--

DROP TABLE IF EXISTS `tblfs_file_overview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfs_file_overview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fileid` varchar(255) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `path` text DEFAULT NULL,
  `number` int(255) NOT NULL DEFAULT 0,
  `created_at` varchar(11) DEFAULT NULL,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `hash` varchar(250) NOT NULL DEFAULT '',
  `dir` int(1) NOT NULL DEFAULT 0,
  `hash_share` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfs_file_overview`
--

LOCK TABLES `tblfs_file_overview` WRITE;
/*!40000 ALTER TABLE `tblfs_file_overview` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfs_file_overview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfs_genenal_ip_share`
--

DROP TABLE IF EXISTS `tblfs_genenal_ip_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfs_genenal_ip_share` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parrent_id` varchar(11) NOT NULL,
  `ip_share` varchar(20) DEFAULT NULL,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfs_genenal_ip_share`
--

LOCK TABLES `tblfs_genenal_ip_share` WRITE;
/*!40000 ALTER TABLE `tblfs_genenal_ip_share` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfs_genenal_ip_share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfs_setting_configuration`
--

DROP TABLE IF EXISTS `tblfs_setting_configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfs_setting_configuration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `is_upload` int(1) NOT NULL DEFAULT 0,
  `is_download` int(1) NOT NULL DEFAULT 0,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `is_write` int(1) NOT NULL DEFAULT 0,
  `password` varchar(255) DEFAULT NULL,
  `max_size` int(255) NOT NULL DEFAULT 2,
  `min_size` int(255) NOT NULL DEFAULT 1,
  `created_at` varchar(11) DEFAULT NULL,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_share` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfs_setting_configuration`
--

LOCK TABLES `tblfs_setting_configuration` WRITE;
/*!40000 ALTER TABLE `tblfs_setting_configuration` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfs_setting_configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfs_setting_configuration_relationship`
--

DROP TABLE IF EXISTS `tblfs_setting_configuration_relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfs_setting_configuration_relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_id` int(11) NOT NULL,
  `rel_type` varchar(45) NOT NULL,
  `rel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfs_setting_configuration_relationship`
--

LOCK TABLES `tblfs_setting_configuration_relationship` WRITE;
/*!40000 ALTER TABLE `tblfs_setting_configuration_relationship` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfs_setting_configuration_relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfs_sharing_relationship`
--

DROP TABLE IF EXISTS `tblfs_sharing_relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfs_sharing_relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `share_id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfs_sharing_relationship`
--

LOCK TABLES `tblfs_sharing_relationship` WRITE;
/*!40000 ALTER TABLE `tblfs_sharing_relationship` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfs_sharing_relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfs_sharings`
--

DROP TABLE IF EXISTS `tblfs_sharings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfs_sharings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `is_upload` int(1) NOT NULL DEFAULT 0,
  `is_download` int(1) NOT NULL DEFAULT 0,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `is_write` int(1) NOT NULL DEFAULT 0,
  `password` varchar(255) DEFAULT NULL,
  `expiration_date_apply` int(1) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `expiration_date_delete` int(1) DEFAULT NULL,
  `download_limits_apply` int(1) DEFAULT NULL,
  `download_limits` int(11) DEFAULT NULL,
  `download_limits_delete` int(1) DEFAULT NULL,
  `hash_share` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `inserted_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `isowner` tinyint(4) DEFAULT NULL,
  `phash` text DEFAULT NULL,
  `locked` tinyint(4) DEFAULT NULL,
  `mime` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `read` tinyint(4) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `ts` varchar(255) DEFAULT NULL,
  `write` tinyint(4) DEFAULT NULL,
  `hash` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `has_been_deleted` int(1) NOT NULL DEFAULT 0,
  `downloads` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfs_sharings`
--

LOCK TABLES `tblfs_sharings` WRITE;
/*!40000 ALTER TABLE `tblfs_sharings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfs_sharings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblgdpr_requests`
--

DROP TABLE IF EXISTS `tblgdpr_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblgdpr_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientid` int(11) NOT NULL DEFAULT 0,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `lead_id` int(11) NOT NULL DEFAULT 0,
  `request_type` varchar(191) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `request_date` datetime NOT NULL,
  `request_from` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblgdpr_requests`
--

LOCK TABLES `tblgdpr_requests` WRITE;
/*!40000 ALTER TABLE `tblgdpr_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblgdpr_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblgoals`
--

DROP TABLE IF EXISTS `tblgoals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblgoals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `goal_type` int(11) NOT NULL,
  `contract_type` int(11) NOT NULL DEFAULT 0,
  `achievement` int(11) NOT NULL,
  `notify_when_fail` tinyint(1) NOT NULL DEFAULT 1,
  `notify_when_achieve` tinyint(1) NOT NULL DEFAULT 1,
  `notified` int(11) NOT NULL DEFAULT 0,
  `staff_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblgoals`
--

LOCK TABLES `tblgoals` WRITE;
/*!40000 ALTER TABLE `tblgoals` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblgoals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblgroup_checklist`
--

DROP TABLE IF EXISTS `tblgroup_checklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblgroup_checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `meta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblgroup_checklist`
--

LOCK TABLES `tblgroup_checklist` WRITE;
/*!40000 ALTER TABLE `tblgroup_checklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblgroup_checklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblgroup_checklist_allocation`
--

DROP TABLE IF EXISTS `tblgroup_checklist_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblgroup_checklist_allocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `meta` varchar(100) DEFAULT NULL,
  `staffid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblgroup_checklist_allocation`
--

LOCK TABLES `tblgroup_checklist_allocation` WRITE;
/*!40000 ALTER TABLE `tblgroup_checklist_allocation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblgroup_checklist_allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_allocation_asset`
--

DROP TABLE IF EXISTS `tblhr_allocation_asset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_allocation_asset` (
  `allocation_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) unsigned NOT NULL,
  `asset_name` varchar(100) DEFAULT NULL,
  `assets_amount` int(11) unsigned NOT NULL,
  `status_allocation` int(11) unsigned DEFAULT 0 COMMENT '1: Allocated 0: Unallocated',
  PRIMARY KEY (`allocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_allocation_asset`
--

LOCK TABLES `tblhr_allocation_asset` WRITE;
/*!40000 ALTER TABLE `tblhr_allocation_asset` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_allocation_asset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_allowance_type`
--

DROP TABLE IF EXISTS `tblhr_allowance_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_allowance_type` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(200) NOT NULL,
  `allowance_val` decimal(15,2) NOT NULL,
  `taxable` tinyint(1) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_allowance_type`
--

LOCK TABLES `tblhr_allowance_type` WRITE;
/*!40000 ALTER TABLE `tblhr_allowance_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_allowance_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_checklist_allocation`
--

DROP TABLE IF EXISTS `tblhr_checklist_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_checklist_allocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_checklist_allocation`
--

LOCK TABLES `tblhr_checklist_allocation` WRITE;
/*!40000 ALTER TABLE `tblhr_checklist_allocation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_checklist_allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_contract_template`
--

DROP TABLE IF EXISTS `tblhr_contract_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_contract_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `job_position` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_contract_template`
--

LOCK TABLES `tblhr_contract_template` WRITE;
/*!40000 ALTER TABLE `tblhr_contract_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_contract_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_dependent_person`
--

DROP TABLE IF EXISTS `tblhr_dependent_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_dependent_person` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staffid` int(11) unsigned DEFAULT NULL,
  `dependent_name` varchar(100) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `dependent_bir` date DEFAULT NULL,
  `start_month` date DEFAULT NULL,
  `end_month` date DEFAULT NULL,
  `dependent_iden` varchar(20) NOT NULL,
  `reason` longtext DEFAULT NULL,
  `status` int(11) unsigned DEFAULT 0,
  `status_comment` longtext DEFAULT NULL,
  PRIMARY KEY (`id`,`dependent_iden`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_dependent_person`
--

LOCK TABLES `tblhr_dependent_person` WRITE;
/*!40000 ALTER TABLE `tblhr_dependent_person` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_dependent_person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_education`
--

DROP TABLE IF EXISTS `tblhr_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `programe_id` int(11) DEFAULT NULL,
  `training_programs_name` text NOT NULL,
  `training_places` text DEFAULT NULL,
  `training_time_from` datetime DEFAULT NULL,
  `training_time_to` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `training_result` varchar(150) DEFAULT NULL,
  `degree` varchar(150) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_education`
--

LOCK TABLES `tblhr_education` WRITE;
/*!40000 ALTER TABLE `tblhr_education` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_group_checklist_allocation`
--

DROP TABLE IF EXISTS `tblhr_group_checklist_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_group_checklist_allocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `meta` varchar(100) DEFAULT NULL,
  `staffid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_group_checklist_allocation`
--

LOCK TABLES `tblhr_group_checklist_allocation` WRITE;
/*!40000 ALTER TABLE `tblhr_group_checklist_allocation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_group_checklist_allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_job_p`
--

DROP TABLE IF EXISTS `tblhr_job_p`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_job_p` (
  `job_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_job_p`
--

LOCK TABLES `tblhr_job_p` WRITE;
/*!40000 ALTER TABLE `tblhr_job_p` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_job_p` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_job_position`
--

DROP TABLE IF EXISTS `tblhr_job_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_job_position` (
  `position_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(200) NOT NULL,
  `job_position_description` text DEFAULT NULL,
  `job_p_id` int(11) unsigned NOT NULL,
  `position_code` varchar(50) DEFAULT NULL,
  `department_id` text DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_job_position`
--

LOCK TABLES `tblhr_job_position` WRITE;
/*!40000 ALTER TABLE `tblhr_job_position` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_job_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_jp_interview_training`
--

DROP TABLE IF EXISTS `tblhr_jp_interview_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_jp_interview_training` (
  `training_process_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_position_id` longtext DEFAULT NULL,
  `training_name` varchar(100) DEFAULT NULL,
  `training_type` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `position_training_id` text DEFAULT NULL,
  `mint_point` int(11) DEFAULT NULL,
  `additional_training` varchar(100) DEFAULT '',
  `staff_id` text DEFAULT NULL,
  `time_to_start` date DEFAULT NULL,
  `time_to_end` date DEFAULT NULL,
  PRIMARY KEY (`training_process_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_jp_interview_training`
--

LOCK TABLES `tblhr_jp_interview_training` WRITE;
/*!40000 ALTER TABLE `tblhr_jp_interview_training` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_jp_interview_training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_jp_salary_scale`
--

DROP TABLE IF EXISTS `tblhr_jp_salary_scale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_jp_salary_scale` (
  `salary_scale_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_position_id` int(11) unsigned NOT NULL,
  `rel_type` varchar(100) DEFAULT NULL COMMENT 'salary:allowance:insurance',
  `rel_id` int(11) DEFAULT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`salary_scale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_jp_salary_scale`
--

LOCK TABLES `tblhr_jp_salary_scale` WRITE;
/*!40000 ALTER TABLE `tblhr_jp_salary_scale` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_jp_salary_scale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_knowedge_base_article_feedback`
--

DROP TABLE IF EXISTS `tblhr_knowedge_base_article_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_knowedge_base_article_feedback` (
  `articleanswerid` int(11) NOT NULL AUTO_INCREMENT,
  `articleid` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`articleanswerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_knowedge_base_article_feedback`
--

LOCK TABLES `tblhr_knowedge_base_article_feedback` WRITE;
/*!40000 ALTER TABLE `tblhr_knowedge_base_article_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_knowedge_base_article_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_knowledge_base`
--

DROP TABLE IF EXISTS `tblhr_knowledge_base`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_knowledge_base` (
  `articleid` int(11) NOT NULL AUTO_INCREMENT,
  `articlegroup` int(11) NOT NULL,
  `subject` mediumtext NOT NULL,
  `description` text NOT NULL,
  `slug` mediumtext NOT NULL,
  `active` tinyint(4) NOT NULL,
  `datecreated` datetime NOT NULL,
  `article_order` int(11) NOT NULL DEFAULT 0,
  `staff_article` int(11) NOT NULL DEFAULT 0,
  `question_answers` int(11) DEFAULT 0,
  `file_name` varchar(255) DEFAULT '',
  `curator` varchar(11) DEFAULT '',
  `benchmark` int(11) DEFAULT 0,
  `score` int(11) DEFAULT 0,
  PRIMARY KEY (`articleid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_knowledge_base`
--

LOCK TABLES `tblhr_knowledge_base` WRITE;
/*!40000 ALTER TABLE `tblhr_knowledge_base` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_knowledge_base` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_knowledge_base_groups`
--

DROP TABLE IF EXISTS `tblhr_knowledge_base_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_knowledge_base_groups` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `group_slug` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `color` varchar(10) DEFAULT '#28B8DA',
  `group_order` int(11) DEFAULT 0,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_knowledge_base_groups`
--

LOCK TABLES `tblhr_knowledge_base_groups` WRITE;
/*!40000 ALTER TABLE `tblhr_knowledge_base_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_knowledge_base_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_list_staff_quitting_work`
--

DROP TABLE IF EXISTS `tblhr_list_staff_quitting_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_list_staff_quitting_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11) DEFAULT NULL,
  `staff_name` text DEFAULT NULL,
  `department_name` text DEFAULT NULL,
  `role_name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `dateoff` datetime NOT NULL DEFAULT current_timestamp(),
  `approval` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_list_staff_quitting_work`
--

LOCK TABLES `tblhr_list_staff_quitting_work` WRITE;
/*!40000 ALTER TABLE `tblhr_list_staff_quitting_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_list_staff_quitting_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_p_t_form_question_box`
--

DROP TABLE IF EXISTS `tblhr_p_t_form_question_box`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_p_t_form_question_box` (
  `boxid` int(11) NOT NULL AUTO_INCREMENT,
  `boxtype` varchar(10) NOT NULL,
  `questionid` int(11) NOT NULL,
  PRIMARY KEY (`boxid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_p_t_form_question_box`
--

LOCK TABLES `tblhr_p_t_form_question_box` WRITE;
/*!40000 ALTER TABLE `tblhr_p_t_form_question_box` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_p_t_form_question_box` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_p_t_form_question_box_description`
--

DROP TABLE IF EXISTS `tblhr_p_t_form_question_box_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_p_t_form_question_box_description` (
  `questionboxdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` mediumtext NOT NULL,
  `boxid` mediumtext NOT NULL,
  `questionid` int(11) NOT NULL,
  `correct` int(11) DEFAULT 1 COMMENT '0: correct 1: incorrect',
  PRIMARY KEY (`questionboxdescriptionid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_p_t_form_question_box_description`
--

LOCK TABLES `tblhr_p_t_form_question_box_description` WRITE;
/*!40000 ALTER TABLE `tblhr_p_t_form_question_box_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_p_t_form_question_box_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_p_t_form_results`
--

DROP TABLE IF EXISTS `tblhr_p_t_form_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_p_t_form_results` (
  `resultid` int(11) NOT NULL AUTO_INCREMENT,
  `boxid` int(11) NOT NULL,
  `boxdescriptionid` int(11) DEFAULT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) DEFAULT NULL,
  `questionid` int(11) NOT NULL,
  `answer` text DEFAULT NULL,
  `resultsetid` int(11) NOT NULL,
  PRIMARY KEY (`resultid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_p_t_form_results`
--

LOCK TABLES `tblhr_p_t_form_results` WRITE;
/*!40000 ALTER TABLE `tblhr_p_t_form_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_p_t_form_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_p_t_surveyresultsets`
--

DROP TABLE IF EXISTS `tblhr_p_t_surveyresultsets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_p_t_surveyresultsets` (
  `resultsetid` int(11) NOT NULL AUTO_INCREMENT,
  `trainingid` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `useragent` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  `staff_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`resultsetid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_p_t_surveyresultsets`
--

LOCK TABLES `tblhr_p_t_surveyresultsets` WRITE;
/*!40000 ALTER TABLE `tblhr_p_t_surveyresultsets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_p_t_surveyresultsets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_position_training`
--

DROP TABLE IF EXISTS `tblhr_position_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_position_training` (
  `training_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` mediumtext NOT NULL,
  `training_type` int(11) unsigned NOT NULL,
  `slug` mediumtext NOT NULL,
  `description` text DEFAULT NULL,
  `viewdescription` text DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `redirect_url` varchar(100) DEFAULT NULL,
  `send` tinyint(1) NOT NULL DEFAULT 0,
  `onlyforloggedin` int(11) DEFAULT 0,
  `fromname` varchar(100) DEFAULT NULL,
  `iprestrict` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `hash` varchar(32) NOT NULL,
  `mint_point` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`training_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_position_training`
--

LOCK TABLES `tblhr_position_training` WRITE;
/*!40000 ALTER TABLE `tblhr_position_training` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_position_training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_position_training_question_form`
--

DROP TABLE IF EXISTS `tblhr_position_training_question_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_position_training_question_form` (
  `questionid` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) DEFAULT NULL,
  `question` mediumtext NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `question_order` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`questionid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_position_training_question_form`
--

LOCK TABLES `tblhr_position_training_question_form` WRITE;
/*!40000 ALTER TABLE `tblhr_position_training_question_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_position_training_question_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_procedure_retire`
--

DROP TABLE IF EXISTS `tblhr_procedure_retire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_procedure_retire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_name` text DEFAULT NULL,
  `option_name` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `people_handle_id` int(11) NOT NULL,
  `procedure_retire_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_procedure_retire`
--

LOCK TABLES `tblhr_procedure_retire` WRITE;
/*!40000 ALTER TABLE `tblhr_procedure_retire` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_procedure_retire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_procedure_retire_manage`
--

DROP TABLE IF EXISTS `tblhr_procedure_retire_manage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_procedure_retire_manage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_procedure_retire` text NOT NULL,
  `department` varchar(250) NOT NULL,
  `datecreator` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_procedure_retire_manage`
--

LOCK TABLES `tblhr_procedure_retire_manage` WRITE;
/*!40000 ALTER TABLE `tblhr_procedure_retire_manage` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_procedure_retire_manage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_procedure_retire_of_staff`
--

DROP TABLE IF EXISTS `tblhr_procedure_retire_of_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_procedure_retire_of_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) DEFAULT NULL,
  `option_name` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `staffid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_procedure_retire_of_staff`
--

LOCK TABLES `tblhr_procedure_retire_of_staff` WRITE;
/*!40000 ALTER TABLE `tblhr_procedure_retire_of_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_procedure_retire_of_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_procedure_retire_of_staff_by_id`
--

DROP TABLE IF EXISTS `tblhr_procedure_retire_of_staff_by_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_procedure_retire_of_staff_by_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_name` text DEFAULT NULL,
  `people_handle_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_procedure_retire_of_staff_by_id`
--

LOCK TABLES `tblhr_procedure_retire_of_staff_by_id` WRITE;
/*!40000 ALTER TABLE `tblhr_procedure_retire_of_staff_by_id` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_procedure_retire_of_staff_by_id` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_profile_option`
--

DROP TABLE IF EXISTS `tblhr_profile_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_profile_option` (
  `option_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) NOT NULL,
  `option_val` longtext DEFAULT NULL,
  `auto` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_profile_option`
--

LOCK TABLES `tblhr_profile_option` WRITE;
/*!40000 ALTER TABLE `tblhr_profile_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_profile_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_rec_transfer_records`
--

DROP TABLE IF EXISTS `tblhr_rec_transfer_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_rec_transfer_records` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staffid` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `staff_identifi` varchar(20) DEFAULT NULL,
  `creator` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_rec_transfer_records`
--

LOCK TABLES `tblhr_rec_transfer_records` WRITE;
/*!40000 ALTER TABLE `tblhr_rec_transfer_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_rec_transfer_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_salary_form`
--

DROP TABLE IF EXISTS `tblhr_salary_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_salary_form` (
  `form_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_name` varchar(200) NOT NULL,
  `salary_val` decimal(15,2) NOT NULL,
  `tax` tinyint(1) NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_salary_form`
--

LOCK TABLES `tblhr_salary_form` WRITE;
/*!40000 ALTER TABLE `tblhr_salary_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_salary_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_staff_contract`
--

DROP TABLE IF EXISTS `tblhr_staff_contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_staff_contract` (
  `id_contract` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contract_code` varchar(200) NOT NULL,
  `name_contract` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `start_valid` date DEFAULT NULL,
  `end_valid` date DEFAULT NULL,
  `contract_status` varchar(100) DEFAULT NULL,
  `sign_day` date DEFAULT NULL,
  `staff_delegate` int(11) DEFAULT NULL,
  `hourly_or_month` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `signature` varchar(40) DEFAULT NULL,
  `signer` int(11) DEFAULT NULL,
  `staff_signature` varchar(40) DEFAULT NULL,
  `staff_sign_day` date DEFAULT NULL,
  `contract_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_contract`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_staff_contract`
--

LOCK TABLES `tblhr_staff_contract` WRITE;
/*!40000 ALTER TABLE `tblhr_staff_contract` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_staff_contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_staff_contract_detail`
--

DROP TABLE IF EXISTS `tblhr_staff_contract_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_staff_contract_detail` (
  `contract_detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff_contract_id` int(11) unsigned NOT NULL,
  `type` text DEFAULT NULL,
  `rel_type` text DEFAULT NULL,
  `rel_value` decimal(15,2) DEFAULT 0.00,
  `since_date` date DEFAULT NULL,
  `contract_note` text DEFAULT NULL,
  PRIMARY KEY (`contract_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_staff_contract_detail`
--

LOCK TABLES `tblhr_staff_contract_detail` WRITE;
/*!40000 ALTER TABLE `tblhr_staff_contract_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_staff_contract_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_staff_contract_type`
--

DROP TABLE IF EXISTS `tblhr_staff_contract_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_staff_contract_type` (
  `id_contracttype` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_contracttype` varchar(200) NOT NULL,
  `description` longtext DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `insurance` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_contracttype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_staff_contract_type`
--

LOCK TABLES `tblhr_staff_contract_type` WRITE;
/*!40000 ALTER TABLE `tblhr_staff_contract_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_staff_contract_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_training_allocation`
--

DROP TABLE IF EXISTS `tblhr_training_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_training_allocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_process_id` varchar(100) NOT NULL,
  `staffid` int(11) DEFAULT NULL,
  `training_type` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `training_name` varchar(150) DEFAULT NULL,
  `jp_interview_training_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_training_allocation`
--

LOCK TABLES `tblhr_training_allocation` WRITE;
/*!40000 ALTER TABLE `tblhr_training_allocation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_training_allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_type_of_trainings`
--

DROP TABLE IF EXISTS `tblhr_type_of_trainings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_type_of_trainings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_type_of_trainings`
--

LOCK TABLES `tblhr_type_of_trainings` WRITE;
/*!40000 ALTER TABLE `tblhr_type_of_trainings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_type_of_trainings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_views_tracking`
--

DROP TABLE IF EXISTS `tblhr_views_tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_views_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `view_ip` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_views_tracking`
--

LOCK TABLES `tblhr_views_tracking` WRITE;
/*!40000 ALTER TABLE `tblhr_views_tracking` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_views_tracking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhr_workplace`
--

DROP TABLE IF EXISTS `tblhr_workplace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblhr_workplace` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `workplace_address` varchar(400) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `default` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhr_workplace`
--

LOCK TABLES `tblhr_workplace` WRITE;
/*!40000 ALTER TABLE `tblhr_workplace` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhr_workplace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblinvoicepaymentrecords`
--

DROP TABLE IF EXISTS `tblinvoicepaymentrecords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblinvoicepaymentrecords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceid` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `paymentmode` varchar(40) DEFAULT NULL,
  `paymentmethod` varchar(191) DEFAULT NULL,
  `date` date NOT NULL,
  `daterecorded` datetime NOT NULL,
  `note` text NOT NULL,
  `transactionid` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoiceid` (`invoiceid`),
  KEY `paymentmethod` (`paymentmethod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblinvoicepaymentrecords`
--

LOCK TABLES `tblinvoicepaymentrecords` WRITE;
/*!40000 ALTER TABLE `tblinvoicepaymentrecords` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblinvoicepaymentrecords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblinvoices`
--

DROP TABLE IF EXISTS `tblinvoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblinvoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sent` tinyint(1) NOT NULL DEFAULT 0,
  `datesend` datetime DEFAULT NULL,
  `clientid` int(11) NOT NULL,
  `deleted_customer_name` varchar(100) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `number_format` int(11) NOT NULL DEFAULT 0,
  `datecreated` datetime NOT NULL,
  `date` date NOT NULL,
  `duedate` date DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `total_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total` decimal(15,2) NOT NULL,
  `adjustment` decimal(15,2) DEFAULT NULL,
  `addedfrom` int(11) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `status` int(11) DEFAULT 1,
  `clientnote` text DEFAULT NULL,
  `adminnote` text DEFAULT NULL,
  `last_overdue_reminder` date DEFAULT NULL,
  `last_due_reminder` date DEFAULT NULL,
  `cancel_overdue_reminders` int(11) NOT NULL DEFAULT 0,
  `allowed_payment_modes` mediumtext DEFAULT NULL,
  `token` mediumtext DEFAULT NULL,
  `discount_percent` decimal(15,2) DEFAULT 0.00,
  `discount_total` decimal(15,2) DEFAULT 0.00,
  `discount_type` varchar(30) NOT NULL,
  `recurring` int(11) NOT NULL DEFAULT 0,
  `recurring_type` varchar(10) DEFAULT NULL,
  `custom_recurring` tinyint(1) NOT NULL DEFAULT 0,
  `cycles` int(11) NOT NULL DEFAULT 0,
  `total_cycles` int(11) NOT NULL DEFAULT 0,
  `is_recurring_from` int(11) DEFAULT NULL,
  `last_recurring_date` date DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `sale_agent` int(11) NOT NULL DEFAULT 0,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `show_shipping_on_invoice` tinyint(1) NOT NULL DEFAULT 1,
  `show_quantity_as` int(11) NOT NULL DEFAULT 1,
  `project_id` int(11) DEFAULT 0,
  `subscription_id` int(11) NOT NULL DEFAULT 0,
  `short_link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currency` (`currency`),
  KEY `clientid` (`clientid`),
  KEY `project_id` (`project_id`),
  KEY `sale_agent` (`sale_agent`),
  KEY `total` (`total`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblinvoices`
--

LOCK TABLES `tblinvoices` WRITE;
/*!40000 ALTER TABLE `tblinvoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblinvoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblitem_tax`
--

DROP TABLE IF EXISTS `tblitem_tax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblitem_tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) NOT NULL,
  `taxrate` decimal(15,2) NOT NULL,
  `taxname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `itemid` (`itemid`),
  KEY `rel_id` (`rel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblitem_tax`
--

LOCK TABLES `tblitem_tax` WRITE;
/*!40000 ALTER TABLE `tblitem_tax` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblitem_tax` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblitemable`
--

DROP TABLE IF EXISTS `tblitemable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblitemable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(15) NOT NULL,
  `description` mediumtext NOT NULL,
  `long_description` mediumtext DEFAULT NULL,
  `qty` decimal(15,2) NOT NULL,
  `rate` decimal(15,2) NOT NULL,
  `unit` varchar(40) DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_id` (`rel_id`),
  KEY `rel_type` (`rel_type`),
  KEY `qty` (`qty`),
  KEY `rate` (`rate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblitemable`
--

LOCK TABLES `tblitemable` WRITE;
/*!40000 ALTER TABLE `tblitemable` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblitemable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblitems`
--

DROP TABLE IF EXISTS `tblitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` mediumtext NOT NULL,
  `long_description` text DEFAULT NULL,
  `rate` decimal(15,2) NOT NULL,
  `tax` int(11) DEFAULT NULL,
  `tax2` int(11) DEFAULT NULL,
  `unit` varchar(40) DEFAULT NULL,
  `group_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `tax` (`tax`),
  KEY `tax2` (`tax2`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblitems`
--

LOCK TABLES `tblitems` WRITE;
/*!40000 ALTER TABLE `tblitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblitems_groups`
--

DROP TABLE IF EXISTS `tblitems_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblitems_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblitems_groups`
--

LOCK TABLES `tblitems_groups` WRITE;
/*!40000 ALTER TABLE `tblitems_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblitems_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblknowedge_base_article_feedback`
--

DROP TABLE IF EXISTS `tblknowedge_base_article_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblknowedge_base_article_feedback` (
  `articleanswerid` int(11) NOT NULL AUTO_INCREMENT,
  `articleid` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`articleanswerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblknowedge_base_article_feedback`
--

LOCK TABLES `tblknowedge_base_article_feedback` WRITE;
/*!40000 ALTER TABLE `tblknowedge_base_article_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblknowedge_base_article_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblknowledge_base`
--

DROP TABLE IF EXISTS `tblknowledge_base`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblknowledge_base` (
  `articleid` int(11) NOT NULL AUTO_INCREMENT,
  `articlegroup` int(11) NOT NULL,
  `subject` mediumtext NOT NULL,
  `description` text NOT NULL,
  `slug` mediumtext NOT NULL,
  `active` tinyint(4) NOT NULL,
  `datecreated` datetime NOT NULL,
  `article_order` int(11) NOT NULL DEFAULT 0,
  `staff_article` int(11) NOT NULL DEFAULT 0,
  `question_answers` int(11) DEFAULT 0,
  `file_name` varchar(255) DEFAULT '',
  `curator` varchar(11) DEFAULT '',
  `benchmark` int(11) DEFAULT 0,
  `score` int(11) DEFAULT 0,
  PRIMARY KEY (`articleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblknowledge_base`
--

LOCK TABLES `tblknowledge_base` WRITE;
/*!40000 ALTER TABLE `tblknowledge_base` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblknowledge_base` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblknowledge_base_groups`
--

DROP TABLE IF EXISTS `tblknowledge_base_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblknowledge_base_groups` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `group_slug` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `color` varchar(10) DEFAULT '#28B8DA',
  `group_order` int(11) DEFAULT 0,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblknowledge_base_groups`
--

LOCK TABLES `tblknowledge_base_groups` WRITE;
/*!40000 ALTER TABLE `tblknowledge_base_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblknowledge_base_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbllead_activity_log`
--

DROP TABLE IF EXISTS `tbllead_activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbllead_activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leadid` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `additional_data` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `staffid` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `custom_activity` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbllead_activity_log`
--

LOCK TABLES `tbllead_activity_log` WRITE;
/*!40000 ALTER TABLE `tbllead_activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbllead_activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbllead_integration_emails`
--

DROP TABLE IF EXISTS `tbllead_integration_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbllead_integration_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` mediumtext DEFAULT NULL,
  `body` mediumtext DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `leadid` int(11) NOT NULL,
  `emailid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbllead_integration_emails`
--

LOCK TABLES `tbllead_integration_emails` WRITE;
/*!40000 ALTER TABLE `tbllead_integration_emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbllead_integration_emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblleads`
--

DROP TABLE IF EXISTS `tblleads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblleads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(65) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `company` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT 0,
  `zip` varchar(15) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `assigned` int(11) NOT NULL DEFAULT 0,
  `referrer` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `from_form_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `lastcontact` datetime DEFAULT NULL,
  `dateassigned` date DEFAULT NULL,
  `last_status_change` datetime DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `leadorder` int(11) DEFAULT 1,
  `phonenumber` varchar(50) DEFAULT NULL,
  `date_converted` datetime DEFAULT NULL,
  `lost` tinyint(1) NOT NULL DEFAULT 0,
  `junk` int(11) NOT NULL DEFAULT 0,
  `last_lead_status` int(11) NOT NULL DEFAULT 0,
  `is_imported_from_email_integration` tinyint(1) NOT NULL DEFAULT 0,
  `email_integration_uid` varchar(30) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `default_language` varchar(40) DEFAULT NULL,
  `client_id` int(11) NOT NULL DEFAULT 0,
  `lead_value` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `company` (`company`),
  KEY `email` (`email`),
  KEY `assigned` (`assigned`),
  KEY `status` (`status`),
  KEY `source` (`source`),
  KEY `lastcontact` (`lastcontact`),
  KEY `dateadded` (`dateadded`),
  KEY `leadorder` (`leadorder`),
  KEY `from_form_id` (`from_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblleads`
--

LOCK TABLES `tblleads` WRITE;
/*!40000 ALTER TABLE `tblleads` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblleads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblleads_email_integration`
--

DROP TABLE IF EXISTS `tblleads_email_integration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblleads_email_integration` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'the ID always must be 1',
  `active` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `imap_server` varchar(100) NOT NULL,
  `password` mediumtext NOT NULL,
  `check_every` int(11) NOT NULL DEFAULT 5,
  `responsible` int(11) NOT NULL,
  `lead_source` int(11) NOT NULL,
  `lead_status` int(11) NOT NULL,
  `encryption` varchar(3) DEFAULT NULL,
  `folder` varchar(100) NOT NULL,
  `last_run` varchar(50) DEFAULT NULL,
  `notify_lead_imported` tinyint(1) NOT NULL DEFAULT 1,
  `notify_lead_contact_more_times` tinyint(1) NOT NULL DEFAULT 1,
  `notify_type` varchar(20) DEFAULT NULL,
  `notify_ids` mediumtext DEFAULT NULL,
  `mark_public` int(11) NOT NULL DEFAULT 0,
  `only_loop_on_unseen_emails` tinyint(1) NOT NULL DEFAULT 1,
  `delete_after_import` int(11) NOT NULL DEFAULT 0,
  `create_task_if_customer` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblleads_email_integration`
--

LOCK TABLES `tblleads_email_integration` WRITE;
/*!40000 ALTER TABLE `tblleads_email_integration` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblleads_email_integration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblleads_sources`
--

DROP TABLE IF EXISTS `tblleads_sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblleads_sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblleads_sources`
--

LOCK TABLES `tblleads_sources` WRITE;
/*!40000 ALTER TABLE `tblleads_sources` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblleads_sources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblleads_status`
--

DROP TABLE IF EXISTS `tblleads_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblleads_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `statusorder` int(11) DEFAULT NULL,
  `color` varchar(10) DEFAULT '#28B8DA',
  `isdefault` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblleads_status`
--

LOCK TABLES `tblleads_status` WRITE;
/*!40000 ALTER TABLE `tblleads_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblleads_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbllist_widget`
--

DROP TABLE IF EXISTS `tbllist_widget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbllist_widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `add_from` int(11) NOT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `rel_type` varchar(45) DEFAULT NULL,
  `layout` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbllist_widget`
--

LOCK TABLES `tbllist_widget` WRITE;
/*!40000 ALTER TABLE `tbllist_widget` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbllist_widget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbllistemails`
--

DROP TABLE IF EXISTS `tbllistemails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbllistemails` (
  `emailid` int(11) NOT NULL AUTO_INCREMENT,
  `listid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`emailid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbllistemails`
--

LOCK TABLES `tbllistemails` WRITE;
/*!40000 ALTER TABLE `tbllistemails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbllistemails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmail_queue`
--

DROP TABLE IF EXISTS `tblmail_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmail_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `engine` varchar(40) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `cc` text DEFAULT NULL,
  `bcc` text DEFAULT NULL,
  `message` mediumtext NOT NULL,
  `alt_message` mediumtext DEFAULT NULL,
  `status` enum('pending','sending','sent','failed') DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `headers` text DEFAULT NULL,
  `attachments` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmail_queue`
--

LOCK TABLES `tblmail_queue` WRITE;
/*!40000 ALTER TABLE `tblmail_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmail_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmaillistscustomfields`
--

DROP TABLE IF EXISTS `tblmaillistscustomfields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmaillistscustomfields` (
  `customfieldid` int(11) NOT NULL AUTO_INCREMENT,
  `listid` int(11) NOT NULL,
  `fieldname` varchar(150) NOT NULL,
  `fieldslug` varchar(100) NOT NULL,
  PRIMARY KEY (`customfieldid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmaillistscustomfields`
--

LOCK TABLES `tblmaillistscustomfields` WRITE;
/*!40000 ALTER TABLE `tblmaillistscustomfields` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmaillistscustomfields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmaillistscustomfieldvalues`
--

DROP TABLE IF EXISTS `tblmaillistscustomfieldvalues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmaillistscustomfieldvalues` (
  `customfieldvalueid` int(11) NOT NULL AUTO_INCREMENT,
  `listid` int(11) NOT NULL,
  `customfieldid` int(11) NOT NULL,
  `emailid` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`customfieldvalueid`),
  KEY `listid` (`listid`),
  KEY `customfieldid` (`customfieldid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmaillistscustomfieldvalues`
--

LOCK TABLES `tblmaillistscustomfieldvalues` WRITE;
/*!40000 ALTER TABLE `tblmaillistscustomfieldvalues` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmaillistscustomfieldvalues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmention_post_comments`
--

DROP TABLE IF EXISTS `tblmention_post_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmention_post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `is_contact` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmention_post_comments`
--

LOCK TABLES `tblmention_post_comments` WRITE;
/*!40000 ALTER TABLE `tblmention_post_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmention_post_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmention_posts`
--

DROP TABLE IF EXISTS `tblmention_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmention_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `pinned` int(11) NOT NULL,
  `datepinned` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmention_posts`
--

LOCK TABLES `tblmention_posts` WRITE;
/*!40000 ALTER TABLE `tblmention_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmention_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmigrations`
--

DROP TABLE IF EXISTS `tblmigrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmigrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmigrations`
--

LOCK TABLES `tblmigrations` WRITE;
/*!40000 ALTER TABLE `tblmigrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmigrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmilestones`
--

DROP TABLE IF EXISTS `tblmilestones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmilestones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `description_visible_to_customer` tinyint(1) DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `due_date` date NOT NULL,
  `project_id` int(11) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `milestone_order` int(11) NOT NULL DEFAULT 0,
  `datecreated` date NOT NULL,
  `hide_from_customer` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmilestones`
--

LOCK TABLES `tblmilestones` WRITE;
/*!40000 ALTER TABLE `tblmilestones` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmilestones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmodules`
--

DROP TABLE IF EXISTS `tblmodules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmodules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(55) NOT NULL,
  `installed_version` varchar(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmodules`
--

LOCK TABLES `tblmodules` WRITE;
/*!40000 ALTER TABLE `tblmodules` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmodules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnewsfeed_comment_likes`
--

DROP TABLE IF EXISTS `tblnewsfeed_comment_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblnewsfeed_comment_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateliked` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnewsfeed_comment_likes`
--

LOCK TABLES `tblnewsfeed_comment_likes` WRITE;
/*!40000 ALTER TABLE `tblnewsfeed_comment_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblnewsfeed_comment_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnewsfeed_post_comments`
--

DROP TABLE IF EXISTS `tblnewsfeed_post_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblnewsfeed_post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnewsfeed_post_comments`
--

LOCK TABLES `tblnewsfeed_post_comments` WRITE;
/*!40000 ALTER TABLE `tblnewsfeed_post_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblnewsfeed_post_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnewsfeed_post_likes`
--

DROP TABLE IF EXISTS `tblnewsfeed_post_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblnewsfeed_post_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateliked` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnewsfeed_post_likes`
--

LOCK TABLES `tblnewsfeed_post_likes` WRITE;
/*!40000 ALTER TABLE `tblnewsfeed_post_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblnewsfeed_post_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnewsfeed_posts`
--

DROP TABLE IF EXISTS `tblnewsfeed_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblnewsfeed_posts` (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `creator` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `visibility` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `pinned` int(11) NOT NULL,
  `datepinned` datetime DEFAULT NULL,
  PRIMARY KEY (`postid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnewsfeed_posts`
--

LOCK TABLES `tblnewsfeed_posts` WRITE;
/*!40000 ALTER TABLE `tblnewsfeed_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblnewsfeed_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnotes`
--

DROP TABLE IF EXISTS `tblnotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblnotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `date_contacted` datetime DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `checkVisible` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_id` (`rel_id`),
  KEY `rel_type` (`rel_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnotes`
--

LOCK TABLES `tblnotes` WRITE;
/*!40000 ALTER TABLE `tblnotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblnotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnotifications`
--

DROP TABLE IF EXISTS `tblnotifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblnotifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isread` int(11) NOT NULL DEFAULT 0,
  `isread_inline` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `description` text NOT NULL,
  `fromuserid` int(11) NOT NULL,
  `fromclientid` int(11) NOT NULL DEFAULT 0,
  `from_fullname` varchar(100) NOT NULL,
  `touserid` int(11) NOT NULL,
  `fromcompany` int(11) DEFAULT NULL,
  `link` mediumtext DEFAULT NULL,
  `additional_data` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnotifications`
--

LOCK TABLES `tblnotifications` WRITE;
/*!40000 ALTER TABLE `tblnotifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblnotifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbloptions`
--

DROP TABLE IF EXISTS `tbloptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbloptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `value` longtext NOT NULL,
  `autoload` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=514 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbloptions`
--

LOCK TABLES `tbloptions` WRITE;
/*!40000 ALTER TABLE `tbloptions` DISABLE KEYS */;
INSERT INTO `tbloptions` VALUES (499,'clients_default_theme','perfex',1),(500,'sms_clickatell_api_key','',1),(501,'sms_clickatell_active','0',1),(502,'sms_clickatell_initialized','1',1),(503,'sms_msg91_sender_id','',1),(504,'sms_msg91_api_type','api',1),(505,'sms_msg91_auth_key','',1),(506,'sms_msg91_active','0',1),(507,'sms_msg91_initialized','1',1),(508,'sms_twilio_account_sid','',1),(509,'sms_twilio_auth_token','',1),(510,'sms_twilio_phone_number','',1),(511,'sms_twilio_sender_id','',1),(512,'sms_twilio_active','0',1),(513,'sms_twilio_initialized','1',1);
/*!40000 ALTER TABLE `tbloptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbloutcome_category`
--

DROP TABLE IF EXISTS `tbloutcome_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbloutcome_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outcome_category` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbloutcome_category`
--

LOCK TABLES `tbloutcome_category` WRITE;
/*!40000 ALTER TABLE `tbloutcome_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbloutcome_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblp_t_form_question_box_description`
--

DROP TABLE IF EXISTS `tblp_t_form_question_box_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblp_t_form_question_box_description` (
  `questionboxdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` mediumtext NOT NULL,
  `boxid` mediumtext NOT NULL,
  `questionid` int(11) NOT NULL,
  `correct` int(11) DEFAULT 1 COMMENT '0: correct 1: incorrect',
  PRIMARY KEY (`questionboxdescriptionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblp_t_form_question_box_description`
--

LOCK TABLES `tblp_t_form_question_box_description` WRITE;
/*!40000 ALTER TABLE `tblp_t_form_question_box_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblp_t_form_question_box_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpayment_modes`
--

DROP TABLE IF EXISTS `tblpayment_modes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpayment_modes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `show_on_pdf` int(11) NOT NULL DEFAULT 0,
  `invoices_only` int(11) NOT NULL DEFAULT 0,
  `expenses_only` int(11) NOT NULL DEFAULT 0,
  `selected_by_default` int(11) NOT NULL DEFAULT 1,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpayment_modes`
--

LOCK TABLES `tblpayment_modes` WRITE;
/*!40000 ALTER TABLE `tblpayment_modes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpayment_modes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblperformancetarget`
--

DROP TABLE IF EXISTS `tblperformancetarget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblperformancetarget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11) NOT NULL,
  `Month` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `API` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Commission` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblperformancetarget`
--

LOCK TABLES `tblperformancetarget` WRITE;
/*!40000 ALTER TABLE `tblperformancetarget` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblperformancetarget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpermission`
--

DROP TABLE IF EXISTS `tblpermission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpermission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff` int(11) DEFAULT NULL,
  `r` varchar(5) DEFAULT 'off',
  `w` varchar(5) DEFAULT 'off',
  `type` varchar(25) NOT NULL,
  `mgt_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpermission`
--

LOCK TABLES `tblpermission` WRITE;
/*!40000 ALTER TABLE `tblpermission` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpermission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpinned_projects`
--

DROP TABLE IF EXISTS `tblpinned_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpinned_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpinned_projects`
--

LOCK TABLES `tblpinned_projects` WRITE;
/*!40000 ALTER TABLE `tblpinned_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpinned_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpolicy`
--

DROP TABLE IF EXISTS `tblpolicy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpolicy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` text NOT NULL,
  `policy_number` varchar(100) NOT NULL,
  `provider` text NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `start_date` text NOT NULL,
  `policy_fee` text NOT NULL,
  `total_premium` text NOT NULL,
  `premium_frequency` text NOT NULL,
  `cover_type` text NOT NULL,
  `life_assured` text DEFAULT NULL,
  `policy_owner` text DEFAULT NULL,
  `renewal_date` text DEFAULT NULL,
  `policy_status` text NOT NULL,
  `policy_status_id` int(11) DEFAULT NULL,
  `key_contact` text DEFAULT NULL,
  `contact_email` text DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=active,1=inactive',
  `created_staff_id` int(11) DEFAULT NULL,
  `lastpolicy_update` date DEFAULT NULL,
  `total_frequency_premium` varchar(50) DEFAULT NULL,
  `ird_number` bigint(20) DEFAULT NULL,
  `pir` varchar(50) DEFAULT NULL,
  `data_import_date` date DEFAULT NULL,
  `tagg` text DEFAULT NULL,
  `import_id` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpolicy`
--

LOCK TABLES `tblpolicy` WRITE;
/*!40000 ALTER TABLE `tblpolicy` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpolicy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpolicy_benefitgrouping`
--

DROP TABLE IF EXISTS `tblpolicy_benefitgrouping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpolicy_benefitgrouping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benefit_grouping` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpolicy_benefitgrouping`
--

LOCK TABLES `tblpolicy_benefitgrouping` WRITE;
/*!40000 ALTER TABLE `tblpolicy_benefitgrouping` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpolicy_benefitgrouping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpolicy_benefits_field`
--

DROP TABLE IF EXISTS `tblpolicy_benefits_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpolicy_benefits_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beneifits_field` text NOT NULL,
  `form_title` text NOT NULL,
  `count` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=active,1=inactive',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `benefit_group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpolicy_benefits_field`
--

LOCK TABLES `tblpolicy_benefits_field` WRITE;
/*!40000 ALTER TABLE `tblpolicy_benefits_field` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpolicy_benefits_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpolicy_contact_benefits`
--

DROP TABLE IF EXISTS `tblpolicy_contact_benefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpolicy_contact_benefits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `policy_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `benefit_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `policy_benefits` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpolicy_contact_benefits`
--

LOCK TABLES `tblpolicy_contact_benefits` WRITE;
/*!40000 ALTER TABLE `tblpolicy_contact_benefits` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpolicy_contact_benefits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpolicystatus`
--

DROP TABLE IF EXISTS `tblpolicystatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpolicystatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_type` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpolicystatus`
--

LOCK TABLES `tblpolicystatus` WRITE;
/*!40000 ALTER TABLE `tblpolicystatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpolicystatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblposition_training_question_form`
--

DROP TABLE IF EXISTS `tblposition_training_question_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblposition_training_question_form` (
  `questionid` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) DEFAULT NULL,
  `question` mediumtext NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `question_order` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`questionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblposition_training_question_form`
--

LOCK TABLES `tblposition_training_question_form` WRITE;
/*!40000 ALTER TABLE `tblposition_training_question_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblposition_training_question_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpremium_frequency`
--

DROP TABLE IF EXISTS `tblpremium_frequency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpremium_frequency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `premium_frequency` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=active,1=inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpremium_frequency`
--

LOCK TABLES `tblpremium_frequency` WRITE;
/*!40000 ALTER TABLE `tblpremium_frequency` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpremium_frequency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_activity`
--

DROP TABLE IF EXISTS `tblproject_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL DEFAULT 0,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `fullname` varchar(100) DEFAULT NULL,
  `visible_to_customer` int(11) NOT NULL DEFAULT 0,
  `description_key` varchar(191) NOT NULL COMMENT 'Language file key',
  `additional_data` text DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_activity`
--

LOCK TABLES `tblproject_activity` WRITE;
/*!40000 ALTER TABLE `tblproject_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_arrears`
--

DROP TABLE IF EXISTS `tblproject_arrears`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_arrears` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `recieve_date` date DEFAULT NULL,
  `reason_arrears` int(11) DEFAULT NULL,
  `apibeinglapsed` varchar(150) DEFAULT NULL,
  `arrears_status` int(11) DEFAULT NULL,
  `advisercontacted` int(11) DEFAULT NULL,
  `clawback` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_arrears`
--

LOCK TABLES `tblproject_arrears` WRITE;
/*!40000 ALTER TABLE `tblproject_arrears` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_arrears` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_arrears_status`
--

DROP TABLE IF EXISTS `tblproject_arrears_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_arrears_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arrears_status` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_arrears_status`
--

LOCK TABLES `tblproject_arrears_status` WRITE;
/*!40000 ALTER TABLE `tblproject_arrears_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_arrears_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_benefit_being_change`
--

DROP TABLE IF EXISTS `tblproject_benefit_being_change`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_benefit_being_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benefit_being_change` varchar(150) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_benefit_being_change`
--

LOCK TABLES `tblproject_benefit_being_change` WRITE;
/*!40000 ALTER TABLE `tblproject_benefit_being_change` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_benefit_being_change` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_cancel_status`
--

DROP TABLE IF EXISTS `tblproject_cancel_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_cancel_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cancel_status` varchar(150) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_cancel_status`
--

LOCK TABLES `tblproject_cancel_status` WRITE;
/*!40000 ALTER TABLE `tblproject_cancel_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_cancel_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_cancellation_outcome`
--

DROP TABLE IF EXISTS `tblproject_cancellation_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_cancellation_outcome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outcome_cancellation` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_cancellation_outcome`
--

LOCK TABLES `tblproject_cancellation_outcome` WRITE;
/*!40000 ALTER TABLE `tblproject_cancellation_outcome` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_cancellation_outcome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_category`
--

DROP TABLE IF EXISTS `tblproject_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_category`
--

LOCK TABLES `tblproject_category` WRITE;
/*!40000 ALTER TABLE `tblproject_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_claims`
--

DROP TABLE IF EXISTS `tblproject_claims`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_claims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `contact` text DEFAULT NULL,
  `benefit` int(11) DEFAULT NULL,
  `condition` text DEFAULT NULL,
  `condition_groups` int(11) DEFAULT NULL,
  `specialist` text DEFAULT NULL,
  `outcome` int(11) DEFAULT NULL,
  `reason_noclaim` int(11) DEFAULT NULL,
  `additional_Info` text DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_claims`
--

LOCK TABLES `tblproject_claims` WRITE;
/*!40000 ALTER TABLE `tblproject_claims` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_claims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_commission_split`
--

DROP TABLE IF EXISTS `tblproject_commission_split`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_commission_split` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commission_split` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_commission_split`
--

LOCK TABLES `tblproject_commission_split` WRITE;
/*!40000 ALTER TABLE `tblproject_commission_split` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_commission_split` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_compliance`
--

DROP TABLE IF EXISTS `tblproject_compliance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_compliance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compliance` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `stage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_compliance`
--

LOCK TABLES `tblproject_compliance` WRITE;
/*!40000 ALTER TABLE `tblproject_compliance` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_compliance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_condition_qroups`
--

DROP TABLE IF EXISTS `tblproject_condition_qroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_condition_qroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `condition_qroups` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_condition_qroups`
--

LOCK TABLES `tblproject_condition_qroups` WRITE;
/*!40000 ALTER TABLE `tblproject_condition_qroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_condition_qroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_date_request_issue`
--

DROP TABLE IF EXISTS `tblproject_date_request_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_date_request_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_request_Issue` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_date_request_issue`
--

LOCK TABLES `tblproject_date_request_issue` WRITE;
/*!40000 ALTER TABLE `tblproject_date_request_issue` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_date_request_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_files`
--

DROP TABLE IF EXISTS `tblproject_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(191) NOT NULL,
  `original_file_name` mediumtext DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `visible_to_customer` tinyint(1) DEFAULT 0,
  `staffid` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `external` varchar(40) DEFAULT NULL,
  `external_link` text DEFAULT NULL,
  `thumbnail_link` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `compliance_id` int(11) DEFAULT NULL,
  `stage_id` int(11) DEFAULT NULL,
  `category_name` text DEFAULT NULL,
  `compliance_name` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_files`
--

LOCK TABLES `tblproject_files` WRITE;
/*!40000 ALTER TABLE `tblproject_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_final_status`
--

DROP TABLE IF EXISTS `tblproject_final_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_final_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `final_status` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_final_status`
--

LOCK TABLES `tblproject_final_status` WRITE;
/*!40000 ALTER TABLE `tblproject_final_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_final_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_members`
--

DROP TABLE IF EXISTS `tblproject_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_members`
--

LOCK TABLES `tblproject_members` WRITE;
/*!40000 ALTER TABLE `tblproject_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_new_claim_payment`
--

DROP TABLE IF EXISTS `tblproject_new_claim_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_new_claim_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `claim_id` int(11) NOT NULL,
  `Invoice` text DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_new_claim_payment`
--

LOCK TABLES `tblproject_new_claim_payment` WRITE;
/*!40000 ALTER TABLE `tblproject_new_claim_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_new_claim_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_new_policy_commission`
--

DROP TABLE IF EXISTS `tblproject_new_policy_commission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_new_policy_commission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_policy_commission` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_new_policy_commission`
--

LOCK TABLES `tblproject_new_policy_commission` WRITE;
/*!40000 ALTER TABLE `tblproject_new_policy_commission` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_new_policy_commission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_notes`
--

DROP TABLE IF EXISTS `tblproject_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_notes`
--

LOCK TABLES `tblproject_notes` WRITE;
/*!40000 ALTER TABLE `tblproject_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_outcome`
--

DROP TABLE IF EXISTS `tblproject_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_outcome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outcome` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_outcome`
--

LOCK TABLES `tblproject_outcome` WRITE;
/*!40000 ALTER TABLE `tblproject_outcome` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_outcome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_policycancellations`
--

DROP TABLE IF EXISTS `tblproject_policycancellations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_policycancellations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `source` int(11) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `reason_for_cancellation` int(11) DEFAULT NULL,
  `claim_identified` varchar(50) DEFAULT NULL,
  `outcome_of_cancellation` int(11) DEFAULT NULL,
  `api_being_cancelled` varchar(255) DEFAULT NULL,
  `clawback_period` date DEFAULT NULL,
  `clawback_amount` varchar(255) DEFAULT NULL,
  `replacement_business` int(11) DEFAULT NULL,
  `policy_commission` int(11) DEFAULT NULL,
  `replacement_reason` int(11) DEFAULT NULL,
  `life_cover` int(11) DEFAULT NULL,
  `truma_cover` int(11) DEFAULT NULL,
  `total_and_permanent_disablement_cover` int(11) DEFAULT NULL,
  `monthly_disability_cover` int(11) DEFAULT NULL,
  `medical_cover` int(11) DEFAULT NULL,
  `whole_life_endowment_cover` int(11) DEFAULT NULL,
  `accidental_death_cover` int(11) DEFAULT NULL,
  `funeral_cover` int(11) DEFAULT NULL,
  `other` int(11) DEFAULT NULL,
  `cancel_status` int(11) DEFAULT NULL,
  `number_of_days_calculation_c_p` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_policycancellations`
--

LOCK TABLES `tblproject_policycancellations` WRITE;
/*!40000 ALTER TABLE `tblproject_policycancellations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_policycancellations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_reason_for_arreas`
--

DROP TABLE IF EXISTS `tblproject_reason_for_arreas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_reason_for_arreas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_arrears` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_reason_for_arreas`
--

LOCK TABLES `tblproject_reason_for_arreas` WRITE;
/*!40000 ALTER TABLE `tblproject_reason_for_arreas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_reason_for_arreas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_reason_for_cancelletion`
--

DROP TABLE IF EXISTS `tblproject_reason_for_cancelletion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_reason_for_cancelletion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_for_cancelletion` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_reason_for_cancelletion`
--

LOCK TABLES `tblproject_reason_for_cancelletion` WRITE;
/*!40000 ALTER TABLE `tblproject_reason_for_cancelletion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_reason_for_cancelletion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_reason_noclaim`
--

DROP TABLE IF EXISTS `tblproject_reason_noclaim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_reason_noclaim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_noclaim` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_reason_noclaim`
--

LOCK TABLES `tblproject_reason_noclaim` WRITE;
/*!40000 ALTER TABLE `tblproject_reason_noclaim` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_reason_noclaim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_reason_not_issue_policy`
--

DROP TABLE IF EXISTS `tblproject_reason_not_issue_policy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_reason_not_issue_policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_policy` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_reason_not_issue_policy`
--

LOCK TABLES `tblproject_reason_not_issue_policy` WRITE;
/*!40000 ALTER TABLE `tblproject_reason_not_issue_policy` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_reason_not_issue_policy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_replacement_business`
--

DROP TABLE IF EXISTS `tblproject_replacement_business`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_replacement_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `replacement_business` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_replacement_business`
--

LOCK TABLES `tblproject_replacement_business` WRITE;
/*!40000 ALTER TABLE `tblproject_replacement_business` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_replacement_business` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_replacement_reason`
--

DROP TABLE IF EXISTS `tblproject_replacement_reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_replacement_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `replacement_reason` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_replacement_reason`
--

LOCK TABLES `tblproject_replacement_reason` WRITE;
/*!40000 ALTER TABLE `tblproject_replacement_reason` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_replacement_reason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_settings`
--

DROP TABLE IF EXISTS `tblproject_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=686713 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_settings`
--

LOCK TABLES `tblproject_settings` WRITE;
/*!40000 ALTER TABLE `tblproject_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_source`
--

DROP TABLE IF EXISTS `tblproject_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_source`
--

LOCK TABLES `tblproject_source` WRITE;
/*!40000 ALTER TABLE `tblproject_source` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_stage`
--

DROP TABLE IF EXISTS `tblproject_stage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stage` varchar(150) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_stage`
--

LOCK TABLES `tblproject_stage` WRITE;
/*!40000 ALTER TABLE `tblproject_stage` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_stage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_template`
--

DROP TABLE IF EXISTS `tblproject_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` varchar(150) NOT NULL,
  `template_name` varchar(200) NOT NULL,
  `is_deleted` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_template`
--

LOCK TABLES `tblproject_template` WRITE;
/*!40000 ALTER TABLE `tblproject_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_underwriting`
--

DROP TABLE IF EXISTS `tblproject_underwriting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_underwriting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `related_project_id` text DEFAULT NULL,
  `submitted_date` date DEFAULT NULL,
  `submitted_api` varchar(255) DEFAULT NULL,
  `commission_split` int(11) DEFAULT NULL,
  `final_status` int(11) DEFAULT NULL,
  `under_status` int(11) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `requested_api` varchar(255) DEFAULT NULL,
  `reason_policynotissued` int(11) DEFAULT NULL,
  `benefit_cancelled` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_underwriting`
--

LOCK TABLES `tblproject_underwriting` WRITE;
/*!40000 ALTER TABLE `tblproject_underwriting` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_underwriting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproject_underwriting_status`
--

DROP TABLE IF EXISTS `tblproject_underwriting_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproject_underwriting_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `under_status` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproject_underwriting_status`
--

LOCK TABLES `tblproject_underwriting_status` WRITE;
/*!40000 ALTER TABLE `tblproject_underwriting_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproject_underwriting_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblprojectdiscussioncomments`
--

DROP TABLE IF EXISTS `tblprojectdiscussioncomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblprojectdiscussioncomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discussion_id` int(11) NOT NULL,
  `discussion_type` varchar(10) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `content` text NOT NULL,
  `staff_id` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT 0,
  `fullname` varchar(191) DEFAULT NULL,
  `file_name` varchar(191) DEFAULT NULL,
  `file_mime_type` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblprojectdiscussioncomments`
--

LOCK TABLES `tblprojectdiscussioncomments` WRITE;
/*!40000 ALTER TABLE `tblprojectdiscussioncomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblprojectdiscussioncomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblprojectdiscussions`
--

DROP TABLE IF EXISTS `tblprojectdiscussions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblprojectdiscussions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `show_to_customer` tinyint(1) NOT NULL DEFAULT 0,
  `datecreated` datetime NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  `staff_id` int(11) NOT NULL DEFAULT 0,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblprojectdiscussions`
--

LOCK TABLES `tblprojectdiscussions` WRITE;
/*!40000 ALTER TABLE `tblprojectdiscussions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblprojectdiscussions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblprojects`
--

DROP TABLE IF EXISTS `tblprojects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblprojects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `clientid` int(11) NOT NULL,
  `billing_type` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `deadline` date DEFAULT NULL,
  `project_created` date NOT NULL,
  `date_finished` datetime DEFAULT NULL,
  `progress` int(11) DEFAULT 0,
  `progress_from_tasks` int(11) NOT NULL DEFAULT 1,
  `project_cost` decimal(15,2) DEFAULT NULL,
  `project_rate_per_hour` decimal(15,2) DEFAULT NULL,
  `estimated_hours` decimal(15,2) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `contact_notification` int(11) DEFAULT 1,
  `notify_contacts` text DEFAULT NULL,
  `provider` int(11) DEFAULT NULL,
  `policy_number` int(11) DEFAULT NULL,
  `projecttype` int(11) DEFAULT NULL,
  `created_staff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientid` (`clientid`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblprojects`
--

LOCK TABLES `tblprojects` WRITE;
/*!40000 ALTER TABLE `tblprojects` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblprojects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblprojecttype`
--

DROP TABLE IF EXISTS `tblprojecttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblprojecttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_type` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblprojecttype`
--

LOCK TABLES `tblprojecttype` WRITE;
/*!40000 ALTER TABLE `tblprojecttype` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblprojecttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproposal_comments`
--

DROP TABLE IF EXISTS `tblproposal_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproposal_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext DEFAULT NULL,
  `proposalid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproposal_comments`
--

LOCK TABLES `tblproposal_comments` WRITE;
/*!40000 ALTER TABLE `tblproposal_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproposal_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproposals`
--

DROP TABLE IF EXISTS `tblproposals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproposals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `total_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `adjustment` decimal(15,2) DEFAULT NULL,
  `discount_percent` decimal(15,2) NOT NULL,
  `discount_total` decimal(15,2) NOT NULL,
  `show_quantity_as` int(11) NOT NULL DEFAULT 1,
  `currency` int(11) NOT NULL,
  `open_till` date DEFAULT NULL,
  `date` date NOT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `rel_type` varchar(40) DEFAULT NULL,
  `assigned` int(11) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `proposal_to` text DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT 0,
  `zip` varchar(50) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `allow_comments` tinyint(1) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL,
  `estimate_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `date_converted` datetime DEFAULT NULL,
  `pipeline_order` int(11) DEFAULT 1,
  `is_expiry_notified` int(11) NOT NULL DEFAULT 0,
  `acceptance_firstname` varchar(50) DEFAULT NULL,
  `acceptance_lastname` varchar(50) DEFAULT NULL,
  `acceptance_email` varchar(100) DEFAULT NULL,
  `acceptance_date` datetime DEFAULT NULL,
  `acceptance_ip` varchar(40) DEFAULT NULL,
  `signature` varchar(40) DEFAULT NULL,
  `short_link` varchar(100) DEFAULT NULL,
  `compensation` text DEFAULT NULL,
  `discount_type` int(11) DEFAULT NULL,
  `medium` int(11) DEFAULT NULL,
  `complainant` int(11) DEFAULT NULL,
  `complainant_name` varchar(100) DEFAULT NULL,
  `referred_to_fscl` int(11) DEFAULT 0,
  `further_action` text DEFAULT NULL,
  `complaints_category` varchar(100) DEFAULT NULL,
  `complaints_against` text DEFAULT NULL,
  `complaint_taken_by` text DEFAULT NULL,
  `medium_name` text DEFAULT NULL,
  `product_type_name` text DEFAULT NULL,
  `complaints_category_name` text DEFAULT NULL,
  `client_group_name` text DEFAULT NULL,
  `status_name` text DEFAULT NULL,
  `outcome_category` text DEFAULT NULL,
  `business_type` int(11) DEFAULT NULL,
  `outcome_sought` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproposals`
--

LOCK TABLES `tblproposals` WRITE;
/*!40000 ALTER TABLE `tblproposals` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproposals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproposals_complaint`
--

DROP TABLE IF EXISTS `tblproposals_complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproposals_complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproposals_complaint`
--

LOCK TABLES `tblproposals_complaint` WRITE;
/*!40000 ALTER TABLE `tblproposals_complaint` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproposals_complaint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproposals_medium`
--

DROP TABLE IF EXISTS `tblproposals_medium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproposals_medium` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medium` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproposals_medium`
--

LOCK TABLES `tblproposals_medium` WRITE;
/*!40000 ALTER TABLE `tblproposals_medium` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproposals_medium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproposals_product_type`
--

DROP TABLE IF EXISTS `tblproposals_product_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproposals_product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproposals_product_type`
--

LOCK TABLES `tblproposals_product_type` WRITE;
/*!40000 ALTER TABLE `tblproposals_product_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproposals_product_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproposals_status`
--

DROP TABLE IF EXISTS `tblproposals_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproposals_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproposals_status`
--

LOCK TABLES `tblproposals_status` WRITE;
/*!40000 ALTER TABLE `tblproposals_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproposals_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproviders_details`
--

DROP TABLE IF EXISTS `tblproviders_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproviders_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `providername` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobilenumber` varchar(50) NOT NULL,
  `bdm_name` varchar(50) NOT NULL,
  `bdm_email` varchar(50) NOT NULL,
  `accounts_name` varchar(50) NOT NULL,
  `accounts_phone` varchar(50) NOT NULL,
  `accounts_email` varchar(50) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproviders_details`
--

LOCK TABLES `tblproviders_details` WRITE;
/*!40000 ALTER TABLE `tblproviders_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproviders_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblrec_criteria`
--

DROP TABLE IF EXISTS `tblrec_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblrec_criteria` (
  `criteria_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `criteria_type` varchar(45) NOT NULL,
  `criteria_title` varchar(200) NOT NULL,
  `group_criteria` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `add_from` int(11) NOT NULL,
  `add_date` date DEFAULT NULL,
  `score_des1` text DEFAULT NULL,
  `score_des2` text DEFAULT NULL,
  `score_des3` text DEFAULT NULL,
  `score_des4` text DEFAULT NULL,
  `score_des5` text DEFAULT NULL,
  PRIMARY KEY (`criteria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblrec_criteria`
--

LOCK TABLES `tblrec_criteria` WRITE;
/*!40000 ALTER TABLE `tblrec_criteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblrec_criteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblrec_job_position`
--

DROP TABLE IF EXISTS `tblrec_job_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblrec_job_position` (
  `position_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(200) NOT NULL,
  `position_description` text DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblrec_job_position`
--

LOCK TABLES `tblrec_job_position` WRITE;
/*!40000 ALTER TABLE `tblrec_job_position` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblrec_job_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblrec_set_transfer_record`
--

DROP TABLE IF EXISTS `tblrec_set_transfer_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblrec_set_transfer_record` (
  `set_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `send_to` varchar(45) NOT NULL,
  `email_to` text DEFAULT NULL,
  `add_from` int(11) NOT NULL,
  `add_date` date NOT NULL,
  `subject` text NOT NULL,
  `content` text DEFAULT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblrec_set_transfer_record`
--

LOCK TABLES `tblrec_set_transfer_record` WRITE;
/*!40000 ALTER TABLE `tblrec_set_transfer_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblrec_set_transfer_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblrec_transfer_records`
--

DROP TABLE IF EXISTS `tblrec_transfer_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblrec_transfer_records` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staffid` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `staff_identifi` varchar(20) DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `datecreator` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblrec_transfer_records`
--

LOCK TABLES `tblrec_transfer_records` WRITE;
/*!40000 ALTER TABLE `tblrec_transfer_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblrec_transfer_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblrecords_meta`
--

DROP TABLE IF EXISTS `tblrecords_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblrecords_meta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `meta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblrecords_meta`
--

LOCK TABLES `tblrecords_meta` WRITE;
/*!40000 ALTER TABLE `tblrecords_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblrecords_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblrelated_items`
--

DROP TABLE IF EXISTS `tblrelated_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblrelated_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblrelated_items`
--

LOCK TABLES `tblrelated_items` WRITE;
/*!40000 ALTER TABLE `tblrelated_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblrelated_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblreminders`
--

DROP TABLE IF EXISTS `tblreminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblreminders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `isnotified` int(11) NOT NULL DEFAULT 0,
  `rel_id` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `rel_type` varchar(40) NOT NULL,
  `notify_by_email` int(11) NOT NULL DEFAULT 1,
  `creator` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_id` (`rel_id`),
  KEY `rel_type` (`rel_type`),
  KEY `staff` (`staff`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblreminders`
--

LOCK TABLES `tblreminders` WRITE;
/*!40000 ALTER TABLE `tblreminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblreminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblreplacementbusiness`
--

DROP TABLE IF EXISTS `tblreplacementbusiness`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblreplacementbusiness` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `replacement_type` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `provider_name` varchar(255) DEFAULT NULL,
  `policy_number` varchar(255) DEFAULT NULL,
  `benefit_id` varchar(255) DEFAULT NULL,
  `benefit_name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `requested_to_issue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblreplacementbusiness`
--

LOCK TABLES `tblreplacementbusiness` WRITE;
/*!40000 ALTER TABLE `tblreplacementbusiness` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblreplacementbusiness` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblroles`
--

DROP TABLE IF EXISTS `tblroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblroles` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `permissions` longtext DEFAULT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblroles`
--

LOCK TABLES `tblroles` WRITE;
/*!40000 ALTER TABLE `tblroles` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblroles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsales_activity`
--

DROP TABLE IF EXISTS `tblsales_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsales_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_type` varchar(20) DEFAULT NULL,
  `rel_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `additional_data` text DEFAULT NULL,
  `staffid` varchar(11) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsales_activity`
--

LOCK TABLES `tblsales_activity` WRITE;
/*!40000 ALTER TABLE `tblsales_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsales_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblscheduled_emails`
--

DROP TABLE IF EXISTS `tblscheduled_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblscheduled_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(15) NOT NULL,
  `scheduled_at` datetime NOT NULL,
  `contacts` varchar(197) NOT NULL,
  `cc` text DEFAULT NULL,
  `attach_pdf` tinyint(1) NOT NULL DEFAULT 1,
  `template` varchar(197) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblscheduled_emails`
--

LOCK TABLES `tblscheduled_emails` WRITE;
/*!40000 ALTER TABLE `tblscheduled_emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblscheduled_emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblservices`
--

DROP TABLE IF EXISTS `tblservices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblservices` (
  `serviceid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`serviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblservices`
--

LOCK TABLES `tblservices` WRITE;
/*!40000 ALTER TABLE `tblservices` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblservices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsessions`
--

DROP TABLE IF EXISTS `tblsessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsessions`
--

LOCK TABLES `tblsessions` WRITE;
/*!40000 ALTER TABLE `tblsessions` DISABLE KEYS */;
INSERT INTO `tblsessions` VALUES ('16h9qn613t0bll81ecsvlk8086sj5e5c','192.168.100.96',1789035440,'__ci_last_regenerate|i:1789035438;'),('5mj5a7mrkt9fnd9hovq3f0pji55f7g3m','192.168.100.96',1789034875,'__ci_last_regenerate|i:1789034854;'),('8acmp6poqlck1kt9suc90lqaisi5skp8','192.168.100.96',1789035438,'__ci_last_regenerate|i:1789035438;');
/*!40000 ALTER TABLE `tblsessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsetting_asset_allocation`
--

DROP TABLE IF EXISTS `tblsetting_asset_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsetting_asset_allocation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `meta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsetting_asset_allocation`
--

LOCK TABLES `tblsetting_asset_allocation` WRITE;
/*!40000 ALTER TABLE `tblsetting_asset_allocation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsetting_asset_allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsetting_training`
--

DROP TABLE IF EXISTS `tblsetting_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsetting_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_type` int(11) NOT NULL,
  `position_training` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsetting_training`
--

LOCK TABLES `tblsetting_training` WRITE;
/*!40000 ALTER TABLE `tblsetting_training` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsetting_training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsetting_transfer_records`
--

DROP TABLE IF EXISTS `tblsetting_transfer_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsetting_transfer_records` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `meta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsetting_transfer_records`
--

LOCK TABLES `tblsetting_transfer_records` WRITE;
/*!40000 ALTER TABLE `tblsetting_transfer_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsetting_transfer_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblshared_customer_files`
--

DROP TABLE IF EXISTS `tblshared_customer_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblshared_customer_files` (
  `file_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblshared_customer_files`
--

LOCK TABLES `tblshared_customer_files` WRITE;
/*!40000 ALTER TABLE `tblshared_customer_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblshared_customer_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblspam_filters`
--

DROP TABLE IF EXISTS `tblspam_filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblspam_filters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(40) NOT NULL,
  `rel_type` varchar(10) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblspam_filters`
--

LOCK TABLES `tblspam_filters` WRITE;
/*!40000 ALTER TABLE `tblspam_filters` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblspam_filters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblstaff`
--

DROP TABLE IF EXISTS `tblstaff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblstaff` (
  `staffid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `facebook` mediumtext DEFAULT NULL,
  `linkedin` mediumtext DEFAULT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `skype` varchar(50) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `datecreated` datetime NOT NULL,
  `profile_image` varchar(191) DEFAULT NULL,
  `last_ip` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_password_change` datetime DEFAULT NULL,
  `new_pass_key` varchar(32) DEFAULT NULL,
  `new_pass_key_requested` datetime DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `role` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `default_language` varchar(40) DEFAULT NULL,
  `direction` varchar(3) DEFAULT NULL,
  `media_path_slug` varchar(191) DEFAULT NULL,
  `is_not_staff` int(11) NOT NULL DEFAULT 0,
  `hourly_rate` decimal(15,2) NOT NULL DEFAULT 0.00,
  `two_factor_auth_enabled` tinyint(1) DEFAULT 0,
  `two_factor_auth_code` varchar(100) DEFAULT NULL,
  `two_factor_auth_code_requested` datetime DEFAULT NULL,
  `email_signature` text DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `birthplace` varchar(200) DEFAULT NULL,
  `sex` varchar(15) DEFAULT NULL,
  `marital_status` varchar(25) DEFAULT NULL,
  `nation` varchar(25) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `identification` varchar(100) DEFAULT NULL,
  `days_for_identity` date DEFAULT NULL,
  `home_town` varchar(200) DEFAULT NULL,
  `resident` varchar(200) DEFAULT NULL,
  `current_address` varchar(200) DEFAULT NULL,
  `literacy` varchar(50) DEFAULT NULL,
  `orther_infor` text DEFAULT NULL,
  `job_position` int(11) DEFAULT NULL,
  `workplace` int(11) DEFAULT NULL,
  `place_of_issue` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `name_account` varchar(50) DEFAULT NULL,
  `issue_bank` varchar(200) DEFAULT NULL,
  `records_received` longtext DEFAULT NULL,
  `Personal_tax_code` varchar(50) DEFAULT NULL,
  `google_auth_secret` text DEFAULT NULL,
  `team_manage` int(11) DEFAULT 0,
  `staff_identifi` varchar(200) DEFAULT NULL,
  `status_work` varchar(100) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `otp` int(11) NOT NULL,
  PRIMARY KEY (`staffid`),
  KEY `firstname` (`firstname`),
  KEY `lastname` (`lastname`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblstaff`
--

LOCK TABLES `tblstaff` WRITE;
/*!40000 ALTER TABLE `tblstaff` DISABLE KEYS */;
INSERT INTO `tblstaff` VALUES (1,'desh@intouchconsultants.co.nz','Desh Super Admin','Hanif','','','123456789','','$2a$08$2tF9Lg9eKhNCxfVIFY/yme48EOYu8VD/PiKWW8MKDZMln5xrdX6h6','2022-08-08 11:34:38',NULL,'192.168.100.96','2026-06-13 22:18:33','2026-06-14 01:13:04','2026-05-05 07:31:29',NULL,NULL,1,0,1,NULL,'','admin-admin',0,0.00,0,NULL,NULL,'Deshneil Hanif<br />\r\nChief Financial & Information Officer<br />\r\nTEST - Maurice Trapp Group<br />\r\n<br />\r\nEmail: desh@mauricetrapp.com<br />\r\nwww.mauricetrapp.com','2023-06-13','','','','','','',NULL,'','','','','',2,0,'','','','',NULL,'',NULL,0,'123456','working','2023-06-12',493974);
/*!40000 ALTER TABLE `tblstaff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblstaff_departments`
--

DROP TABLE IF EXISTS `tblstaff_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblstaff_departments` (
  `staffdepartmentid` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL,
  PRIMARY KEY (`staffdepartmentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblstaff_departments`
--

LOCK TABLES `tblstaff_departments` WRITE;
/*!40000 ALTER TABLE `tblstaff_departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstaff_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblstaff_permissions`
--

DROP TABLE IF EXISTS `tblstaff_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblstaff_permissions` (
  `staff_id` int(11) NOT NULL,
  `feature` varchar(40) NOT NULL,
  `capability` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblstaff_permissions`
--

LOCK TABLES `tblstaff_permissions` WRITE;
/*!40000 ALTER TABLE `tblstaff_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstaff_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsubscriptions`
--

DROP TABLE IF EXISTS `tblsubscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsubscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `description_in_item` tinyint(1) NOT NULL DEFAULT 0,
  `clientid` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL DEFAULT 0,
  `stripe_tax_id` varchar(50) DEFAULT NULL,
  `tax_id_2` int(11) NOT NULL DEFAULT 0,
  `stripe_tax_id_2` varchar(50) DEFAULT NULL,
  `stripe_plan_id` text DEFAULT NULL,
  `stripe_subscription_id` text NOT NULL,
  `next_billing_cycle` bigint(20) DEFAULT NULL,
  `ends_at` bigint(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `created_from` int(11) NOT NULL,
  `date_subscribed` datetime DEFAULT NULL,
  `in_test_environment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientid` (`clientid`),
  KEY `currency` (`currency`),
  KEY `tax_id` (`tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsubscriptions`
--

LOCK TABLES `tblsubscriptions` WRITE;
/*!40000 ALTER TABLE `tblsubscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsubscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsurveyresultsets`
--

DROP TABLE IF EXISTS `tblsurveyresultsets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsurveyresultsets` (
  `resultsetid` int(11) NOT NULL AUTO_INCREMENT,
  `surveyid` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `useragent` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`resultsetid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsurveyresultsets`
--

LOCK TABLES `tblsurveyresultsets` WRITE;
/*!40000 ALTER TABLE `tblsurveyresultsets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsurveyresultsets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsurveys`
--

DROP TABLE IF EXISTS `tblsurveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsurveys` (
  `surveyid` int(11) NOT NULL AUTO_INCREMENT,
  `subject` mediumtext NOT NULL,
  `slug` mediumtext NOT NULL,
  `description` text NOT NULL,
  `viewdescription` text DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `redirect_url` varchar(100) DEFAULT NULL,
  `send` tinyint(1) NOT NULL DEFAULT 0,
  `onlyforloggedin` int(11) DEFAULT 0,
  `fromname` varchar(100) DEFAULT NULL,
  `iprestrict` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `hash` varchar(32) NOT NULL,
  PRIMARY KEY (`surveyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsurveys`
--

LOCK TABLES `tblsurveys` WRITE;
/*!40000 ALTER TABLE `tblsurveys` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsurveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsurveysemailsendcron`
--

DROP TABLE IF EXISTS `tblsurveysemailsendcron`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsurveysemailsendcron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surveyid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emailid` int(11) DEFAULT NULL,
  `listid` varchar(11) DEFAULT NULL,
  `log_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsurveysemailsendcron`
--

LOCK TABLES `tblsurveysemailsendcron` WRITE;
/*!40000 ALTER TABLE `tblsurveysemailsendcron` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsurveysemailsendcron` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsurveysendlog`
--

DROP TABLE IF EXISTS `tblsurveysendlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsurveysendlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surveyid` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `iscronfinished` int(11) NOT NULL DEFAULT 0,
  `send_to_mail_lists` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsurveysendlog`
--

LOCK TABLES `tblsurveysendlog` WRITE;
/*!40000 ALTER TABLE `tblsurveysendlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsurveysendlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltaggables`
--

DROP TABLE IF EXISTS `tbltaggables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltaggables` (
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `tag_order` int(11) NOT NULL DEFAULT 0,
  KEY `rel_id` (`rel_id`),
  KEY `rel_type` (`rel_type`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltaggables`
--

LOCK TABLES `tbltaggables` WRITE;
/*!40000 ALTER TABLE `tbltaggables` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltaggables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltags`
--

DROP TABLE IF EXISTS `tbltags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltags`
--

LOCK TABLES `tbltags` WRITE;
/*!40000 ALTER TABLE `tbltags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltask_assigned`
--

DROP TABLE IF EXISTS `tbltask_assigned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltask_assigned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `assigned_from` int(11) NOT NULL DEFAULT 0,
  `is_assigned_from_contact` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `taskid` (`taskid`),
  KEY `staffid` (`staffid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltask_assigned`
--

LOCK TABLES `tbltask_assigned` WRITE;
/*!40000 ALTER TABLE `tbltask_assigned` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltask_assigned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltask_checklist_items`
--

DROP TABLE IF EXISTS `tbltask_checklist_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltask_checklist_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taskid` int(11) NOT NULL,
  `description` text NOT NULL,
  `finished` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL,
  `addedfrom` int(11) NOT NULL,
  `finished_from` int(11) DEFAULT 0,
  `list_order` int(11) NOT NULL DEFAULT 0,
  `assigned` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `taskid` (`taskid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltask_checklist_items`
--

LOCK TABLES `tbltask_checklist_items` WRITE;
/*!40000 ALTER TABLE `tbltask_checklist_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltask_checklist_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltask_comments`
--

DROP TABLE IF EXISTS `tbltask_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltask_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `taskid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `file_id` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  KEY `taskid` (`taskid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltask_comments`
--

LOCK TABLES `tbltask_comments` WRITE;
/*!40000 ALTER TABLE `tbltask_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltask_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltask_filter`
--

DROP TABLE IF EXISTS `tbltask_filter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltask_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_name` varchar(100) NOT NULL,
  `creator` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltask_filter`
--

LOCK TABLES `tbltask_filter` WRITE;
/*!40000 ALTER TABLE `tbltask_filter` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltask_filter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltask_followers`
--

DROP TABLE IF EXISTS `tbltask_followers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltask_followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltask_followers`
--

LOCK TABLES `tbltask_followers` WRITE;
/*!40000 ALTER TABLE `tbltask_followers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltask_followers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltasks`
--

DROP TABLE IF EXISTS `tbltasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` mediumtext DEFAULT NULL,
  `description` text DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `startdate` date NOT NULL,
  `duedate` date DEFAULT NULL,
  `datefinished` datetime DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `is_added_from_contact` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `recurring_type` varchar(10) DEFAULT NULL,
  `repeat_every` int(11) DEFAULT NULL,
  `recurring` int(11) NOT NULL DEFAULT 0,
  `is_recurring_from` int(11) DEFAULT NULL,
  `cycles` int(11) NOT NULL DEFAULT 0,
  `total_cycles` int(11) NOT NULL DEFAULT 0,
  `custom_recurring` tinyint(1) NOT NULL DEFAULT 0,
  `last_recurring_date` date DEFAULT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `rel_type` varchar(30) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `billable` tinyint(1) NOT NULL DEFAULT 0,
  `billed` tinyint(1) NOT NULL DEFAULT 0,
  `invoice_id` int(11) NOT NULL DEFAULT 0,
  `hourly_rate` decimal(15,2) NOT NULL DEFAULT 0.00,
  `milestone` int(11) DEFAULT 0,
  `kanban_order` int(11) DEFAULT 1,
  `milestone_order` int(11) NOT NULL DEFAULT 0,
  `visible_to_client` tinyint(1) NOT NULL DEFAULT 0,
  `deadline_notified` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `rel_id` (`rel_id`),
  KEY `rel_type` (`rel_type`),
  KEY `milestone` (`milestone`),
  KEY `kanban_order` (`kanban_order`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltasks`
--

LOCK TABLES `tbltasks` WRITE;
/*!40000 ALTER TABLE `tbltasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltasks_checklist_templates`
--

DROP TABLE IF EXISTS `tbltasks_checklist_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltasks_checklist_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltasks_checklist_templates`
--

LOCK TABLES `tbltasks_checklist_templates` WRITE;
/*!40000 ALTER TABLE `tbltasks_checklist_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltasks_checklist_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltaskstimers`
--

DROP TABLE IF EXISTS `tbltaskstimers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltaskstimers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `start_time` varchar(64) NOT NULL,
  `end_time` varchar(64) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `hourly_rate` decimal(15,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltaskstimers`
--

LOCK TABLES `tbltaskstimers` WRITE;
/*!40000 ALTER TABLE `tbltaskstimers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltaskstimers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltaxes`
--

DROP TABLE IF EXISTS `tbltaxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltaxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `taxrate` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltaxes`
--

LOCK TABLES `tbltaxes` WRITE;
/*!40000 ALTER TABLE `tbltaxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltaxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblteam_password_category`
--

DROP TABLE IF EXISTS `tblteam_password_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblteam_password_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `color` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `parent` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblteam_password_category`
--

LOCK TABLES `tblteam_password_category` WRITE;
/*!40000 ALTER TABLE `tblteam_password_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblteam_password_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltemplates`
--

DROP TABLE IF EXISTS `tbltemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltemplates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `addedfrom` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltemplates`
--

LOCK TABLES `tbltemplates` WRITE;
/*!40000 ALTER TABLE `tbltemplates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltemplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblticket_attachments`
--

DROP TABLE IF EXISTS `tblticket_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblticket_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticketid` int(11) NOT NULL,
  `replyid` int(11) DEFAULT NULL,
  `file_name` varchar(191) NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblticket_attachments`
--

LOCK TABLES `tblticket_attachments` WRITE;
/*!40000 ALTER TABLE `tblticket_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticket_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblticket_replies`
--

DROP TABLE IF EXISTS `tblticket_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblticket_replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticketid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `contactid` int(11) NOT NULL DEFAULT 0,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `message` text DEFAULT NULL,
  `attachment` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblticket_replies`
--

LOCK TABLES `tblticket_replies` WRITE;
/*!40000 ALTER TABLE `tblticket_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticket_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltickets`
--

DROP TABLE IF EXISTS `tbltickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltickets` (
  `ticketid` int(11) NOT NULL AUTO_INCREMENT,
  `adminreplying` int(11) NOT NULL DEFAULT 0,
  `userid` int(11) NOT NULL,
  `contactid` int(11) NOT NULL DEFAULT 0,
  `merged_ticket_id` int(11) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `department` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `service` int(11) DEFAULT NULL,
  `ticketkey` varchar(32) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `message` text DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `lastreply` datetime DEFAULT NULL,
  `clientread` int(11) NOT NULL DEFAULT 0,
  `adminread` int(11) NOT NULL DEFAULT 0,
  `assigned` int(11) NOT NULL DEFAULT 0,
  `staff_id_replying` int(11) DEFAULT NULL,
  `cc` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`ticketid`),
  KEY `service` (`service`),
  KEY `department` (`department`),
  KEY `status` (`status`),
  KEY `userid` (`userid`),
  KEY `priority` (`priority`),
  KEY `project_id` (`project_id`),
  KEY `contactid` (`contactid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltickets`
--

LOCK TABLES `tbltickets` WRITE;
/*!40000 ALTER TABLE `tbltickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltickets_pipe_log`
--

DROP TABLE IF EXISTS `tbltickets_pipe_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltickets_pipe_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `email_to` varchar(100) NOT NULL,
  `name` varchar(191) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `message` mediumtext NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltickets_pipe_log`
--

LOCK TABLES `tbltickets_pipe_log` WRITE;
/*!40000 ALTER TABLE `tbltickets_pipe_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltickets_pipe_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltickets_predefined_replies`
--

DROP TABLE IF EXISTS `tbltickets_predefined_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltickets_predefined_replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltickets_predefined_replies`
--

LOCK TABLES `tbltickets_predefined_replies` WRITE;
/*!40000 ALTER TABLE `tbltickets_predefined_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltickets_predefined_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltickets_priorities`
--

DROP TABLE IF EXISTS `tbltickets_priorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltickets_priorities` (
  `priorityid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`priorityid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltickets_priorities`
--

LOCK TABLES `tbltickets_priorities` WRITE;
/*!40000 ALTER TABLE `tbltickets_priorities` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltickets_priorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltickets_status`
--

DROP TABLE IF EXISTS `tbltickets_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltickets_status` (
  `ticketstatusid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `isdefault` int(11) NOT NULL DEFAULT 0,
  `statuscolor` varchar(7) DEFAULT NULL,
  `statusorder` int(11) DEFAULT NULL,
  PRIMARY KEY (`ticketstatusid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltickets_status`
--

LOCK TABLES `tbltickets_status` WRITE;
/*!40000 ALTER TABLE `tbltickets_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltickets_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltodos`
--

DROP TABLE IF EXISTS `tbltodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltodos` (
  `todoid` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `staffid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `datefinished` datetime DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`todoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltodos`
--

LOCK TABLES `tbltodos` WRITE;
/*!40000 ALTER TABLE `tbltodos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltp_bank_account`
--

DROP TABLE IF EXISTS `tbltp_bank_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltp_bank_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `user_name` varchar(80) DEFAULT NULL,
  `pin` varchar(100) DEFAULT NULL,
  `bank_name` varchar(200) DEFAULT NULL,
  `bank_code` varchar(200) DEFAULT NULL,
  `account_holder` varchar(200) DEFAULT NULL,
  `account_number` varchar(200) DEFAULT NULL,
  `iban` varchar(200) DEFAULT NULL,
  `notice` text DEFAULT NULL,
  `password` varchar(1500) DEFAULT NULL,
  `enable_log` varchar(5) NOT NULL,
  `mgt_id` int(11) NOT NULL,
  `custom_field` text DEFAULT NULL,
  `datecreator` datetime DEFAULT NULL,
  `relate_to` varchar(50) NOT NULL,
  `relate_id` text DEFAULT NULL,
  `add_from` int(11) NOT NULL,
  `add_by` varchar(20) NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltp_bank_account`
--

LOCK TABLES `tbltp_bank_account` WRITE;
/*!40000 ALTER TABLE `tbltp_bank_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltp_bank_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltp_credit_card`
--

DROP TABLE IF EXISTS `tbltp_credit_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltp_credit_card` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `pin` varchar(100) DEFAULT NULL,
  `credit_card_type` varchar(150) DEFAULT NULL,
  `card_number` varchar(150) DEFAULT NULL,
  `card_cvc` varchar(150) DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_to` date DEFAULT NULL,
  `notice` text DEFAULT NULL,
  `password` varchar(1500) DEFAULT NULL,
  `enable_log` varchar(5) NOT NULL,
  `mgt_id` int(11) NOT NULL,
  `custom_field` text DEFAULT NULL,
  `datecreator` datetime DEFAULT NULL,
  `relate_to` varchar(50) NOT NULL,
  `relate_id` text DEFAULT NULL,
  `add_from` int(11) NOT NULL,
  `add_by` varchar(20) NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltp_credit_card`
--

LOCK TABLES `tbltp_credit_card` WRITE;
/*!40000 ALTER TABLE `tbltp_credit_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltp_credit_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltp_email`
--

DROP TABLE IF EXISTS `tbltp_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltp_email` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `pin` varchar(100) DEFAULT NULL,
  `credit_card_type` varchar(150) DEFAULT NULL,
  `card_number` varchar(150) DEFAULT NULL,
  `card_cvc` varchar(150) DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_to` date DEFAULT NULL,
  `notice` text DEFAULT NULL,
  `email_type` varchar(150) DEFAULT NULL,
  `auth_method` varchar(150) DEFAULT NULL,
  `host` varchar(150) DEFAULT NULL,
  `port` varchar(10) DEFAULT NULL,
  `smtp_auth_method` varchar(150) DEFAULT NULL,
  `smtp_host` varchar(150) DEFAULT NULL,
  `smtp_port` varchar(150) DEFAULT NULL,
  `smtp_user_name` varchar(150) DEFAULT NULL,
  `smtp_password` varchar(1500) DEFAULT NULL,
  `password` varchar(1500) DEFAULT NULL,
  `enable_log` varchar(5) NOT NULL,
  `mgt_id` int(11) NOT NULL,
  `custom_field` text DEFAULT NULL,
  `datecreator` datetime DEFAULT NULL,
  `user_name` varchar(150) DEFAULT NULL,
  `relate_to` varchar(50) NOT NULL,
  `relate_id` text DEFAULT NULL,
  `add_from` int(11) NOT NULL,
  `add_by` varchar(20) NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltp_email`
--

LOCK TABLES `tbltp_email` WRITE;
/*!40000 ALTER TABLE `tbltp_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltp_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltp_logs`
--

DROP TABLE IF EXISTS `tbltp_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltp_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff` int(11) DEFAULT NULL,
  `type` varchar(150) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `rel_type` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltp_logs`
--

LOCK TABLES `tbltp_logs` WRITE;
/*!40000 ALTER TABLE `tbltp_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltp_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltp_normal`
--

DROP TABLE IF EXISTS `tbltp_normal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltp_normal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `user_name` varchar(80) DEFAULT NULL,
  `notice` text DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `custom_field` text DEFAULT NULL,
  `enable_log` varchar(5) NOT NULL,
  `mgt_id` int(11) NOT NULL,
  `relate_to` varchar(50) NOT NULL,
  `relate_id` text DEFAULT NULL,
  `add_from` int(11) NOT NULL,
  `add_by` varchar(20) NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltp_normal`
--

LOCK TABLES `tbltp_normal` WRITE;
/*!40000 ALTER TABLE `tbltp_normal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltp_normal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltp_server`
--

DROP TABLE IF EXISTS `tbltp_server`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltp_server` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `user_name` varchar(150) DEFAULT NULL,
  `notice` text DEFAULT NULL,
  `host` varchar(150) DEFAULT NULL,
  `port` varchar(10) DEFAULT NULL,
  `password` varchar(1500) DEFAULT NULL,
  `enable_log` varchar(5) NOT NULL,
  `mgt_id` int(11) NOT NULL,
  `custom_field` text DEFAULT NULL,
  `datecreator` datetime DEFAULT NULL,
  `relate_to` varchar(50) NOT NULL,
  `relate_id` text DEFAULT NULL,
  `add_from` int(11) NOT NULL,
  `add_by` varchar(20) NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltp_server`
--

LOCK TABLES `tbltp_server` WRITE;
/*!40000 ALTER TABLE `tbltp_server` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltp_server` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltp_share`
--

DROP TABLE IF EXISTS `tbltp_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltp_share` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `not_in_the_system` varchar(5) DEFAULT NULL,
  `mgt_id` int(11) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `client` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `effective_time` datetime DEFAULT NULL,
  `r` varchar(5) DEFAULT 'off',
  `w` varchar(5) DEFAULT 'off',
  `creator` int(11) DEFAULT NULL,
  `datecreator` datetime DEFAULT NULL,
  `hash` varchar(300) DEFAULT NULL,
  `share_id` int(11) DEFAULT NULL,
  `unlimited` int(1) DEFAULT NULL,
  `customer_group` int(11) DEFAULT NULL,
  `send_notify` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltp_share`
--

LOCK TABLES `tbltp_share` WRITE;
/*!40000 ALTER TABLE `tbltp_share` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltp_share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltp_software_license`
--

DROP TABLE IF EXISTS `tbltp_software_license`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltp_software_license` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `version` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `license_key` varchar(150) DEFAULT NULL,
  `notice` text DEFAULT NULL,
  `host` varchar(150) DEFAULT NULL,
  `port` varchar(10) DEFAULT NULL,
  `password` varchar(1500) DEFAULT NULL,
  `enable_log` varchar(5) NOT NULL,
  `mgt_id` int(11) NOT NULL,
  `custom_field` text DEFAULT NULL,
  `datecreator` datetime DEFAULT NULL,
  `relate_to` varchar(50) NOT NULL,
  `relate_id` text DEFAULT NULL,
  `add_from` int(11) NOT NULL,
  `add_by` varchar(20) NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltp_software_license`
--

LOCK TABLES `tbltp_software_license` WRITE;
/*!40000 ALTER TABLE `tbltp_software_license` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltp_software_license` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltracked_mails`
--

DROP TABLE IF EXISTS `tbltracked_mails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltracked_mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(32) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `email` varchar(100) NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `date_opened` datetime DEFAULT NULL,
  `subject` mediumtext DEFAULT NULL,
  `message` varchar(2000) DEFAULT NULL,
  `cc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltracked_mails`
--

LOCK TABLES `tbltracked_mails` WRITE;
/*!40000 ALTER TABLE `tbltracked_mails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltracked_mails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltraining_allocation`
--

DROP TABLE IF EXISTS `tbltraining_allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltraining_allocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_process_id` varchar(100) NOT NULL,
  `staffid` int(11) DEFAULT NULL,
  `training_type` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `training_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltraining_allocation`
--

LOCK TABLES `tbltraining_allocation` WRITE;
/*!40000 ALTER TABLE `tbltraining_allocation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltraining_allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltransfer_records_reception`
--

DROP TABLE IF EXISTS `tbltransfer_records_reception`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltransfer_records_reception` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `meta` varchar(50) DEFAULT NULL,
  `staffid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltransfer_records_reception`
--

LOCK TABLES `tbltransfer_records_reception` WRITE;
/*!40000 ALTER TABLE `tbltransfer_records_reception` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltransfer_records_reception` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltwocheckout_log`
--

DROP TABLE IF EXISTS `tbltwocheckout_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltwocheckout_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference` varchar(64) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`),
  CONSTRAINT `tbltwocheckout_log_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `tblinvoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltwocheckout_log`
--

LOCK TABLES `tbltwocheckout_log` WRITE;
/*!40000 ALTER TABLE `tbltwocheckout_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltwocheckout_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbluser_auto_login`
--

DROP TABLE IF EXISTS `tbluser_auto_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbluser_auto_login` (
  `key_id` char(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_agent` varchar(150) NOT NULL,
  `last_ip` varchar(40) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `staff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbluser_auto_login`
--

LOCK TABLES `tbluser_auto_login` WRITE;
/*!40000 ALTER TABLE `tbluser_auto_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbluser_auto_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbluser_meta`
--

DROP TABLE IF EXISTS `tbluser_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbluser_meta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `client_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `contact_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(191) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`umeta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbluser_meta`
--

LOCK TABLES `tbluser_meta` WRITE;
/*!40000 ALTER TABLE `tbluser_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbluser_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblvault`
--

DROP TABLE IF EXISTS `tblvault`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblvault` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `server_address` varchar(191) NOT NULL,
  `port` int(11) DEFAULT NULL,
  `username` varchar(191) NOT NULL,
  `password` text NOT NULL,
  `description` text DEFAULT NULL,
  `creator` int(11) NOT NULL,
  `creator_name` varchar(100) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `share_in_projects` tinyint(1) NOT NULL DEFAULT 0,
  `last_updated` datetime DEFAULT NULL,
  `last_updated_from` varchar(100) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblvault`
--

LOCK TABLES `tblvault` WRITE;
/*!40000 ALTER TABLE `tblvault` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblvault` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblviews_tracking`
--

DROP TABLE IF EXISTS `tblviews_tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblviews_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `view_ip` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblviews_tracking`
--

LOCK TABLES `tblviews_tracking` WRITE;
/*!40000 ALTER TABLE `tblviews_tracking` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblviews_tracking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblvulnerabledrivers`
--

DROP TABLE IF EXISTS `tblvulnerabledrivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblvulnerabledrivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vulnerabledrivers` text NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblvulnerabledrivers`
--

LOCK TABLES `tblvulnerabledrivers` WRITE;
/*!40000 ALTER TABLE `tblvulnerabledrivers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblvulnerabledrivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblweb_to_lead`
--

DROP TABLE IF EXISTS `tblweb_to_lead`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblweb_to_lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_key` varchar(32) NOT NULL,
  `lead_source` int(11) NOT NULL,
  `lead_status` int(11) NOT NULL,
  `notify_lead_imported` int(11) NOT NULL DEFAULT 1,
  `notify_type` varchar(20) DEFAULT NULL,
  `notify_ids` mediumtext DEFAULT NULL,
  `responsible` int(11) NOT NULL DEFAULT 0,
  `name` varchar(191) NOT NULL,
  `form_data` mediumtext DEFAULT NULL,
  `recaptcha` int(11) NOT NULL DEFAULT 0,
  `submit_btn_name` varchar(40) DEFAULT NULL,
  `submit_btn_text_color` varchar(10) DEFAULT '#ffffff',
  `submit_btn_bg_color` varchar(10) DEFAULT '#84c529',
  `success_submit_msg` text DEFAULT NULL,
  `submit_action` int(11) DEFAULT 0,
  `lead_name_prefix` varchar(255) DEFAULT NULL,
  `submit_redirect_url` mediumtext DEFAULT NULL,
  `language` varchar(40) DEFAULT NULL,
  `allow_duplicate` int(11) NOT NULL DEFAULT 1,
  `mark_public` int(11) NOT NULL DEFAULT 0,
  `track_duplicate_field` varchar(20) DEFAULT NULL,
  `track_duplicate_field_and` varchar(20) DEFAULT NULL,
  `create_task_on_duplicate` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblweb_to_lead`
--

LOCK TABLES `tblweb_to_lead` WRITE;
/*!40000 ALTER TABLE `tblweb_to_lead` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblweb_to_lead` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblwiki_articles`
--

DROP TABLE IF EXISTS `tblwiki_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblwiki_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `is_bookmark` tinyint(3) DEFAULT 0,
  `view_counter` int(11) NOT NULL DEFAULT 0,
  `author_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_publish` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `mindmap_content` text DEFAULT NULL,
  `mindmap_thumb` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblwiki_articles`
--

LOCK TABLES `tblwiki_articles` WRITE;
/*!40000 ALTER TABLE `tblwiki_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblwiki_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblwiki_books`
--

DROP TABLE IF EXISTS `tblwiki_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblwiki_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `assign_type` varchar(20) DEFAULT 'specific_staff',
  `assign_ids` mediumtext DEFAULT NULL,
  `author_id` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblwiki_books`
--

LOCK TABLES `tblwiki_books` WRITE;
/*!40000 ALTER TABLE `tblwiki_books` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblwiki_books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblwiki_staff_article`
--

DROP TABLE IF EXISTS `tblwiki_staff_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblwiki_staff_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL DEFAULT 0,
  `article_id` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblwiki_staff_article`
--

LOCK TABLES `tblwiki_staff_article` WRITE;
/*!40000 ALTER TABLE `tblwiki_staff_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblwiki_staff_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `desh_comp_1`
--

/*!50001 DROP VIEW IF EXISTS `desh_comp_1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `desh_comp_1` AS select `x`.`is_deleted` AS `is_deleted`,`x`.`compliance` AS `compliance`,`y`.`id` AS `id` from (`tblprojects` `y` left join `tblproject_compliance` `x` on(`x`.`is_deleted` = `y`.`progress`)) union all select `y`.`progress` AS `progress`,`y`.`id` AS `id`,`x`.`compliance` AS `compliance` from (`tblproject_compliance` `x` left join `tblprojects` `y` on(`x`.`is_deleted` = `y`.`progress`)) where `x`.`compliance` <> 0 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `desh_comp_2`
--

/*!50001 DROP VIEW IF EXISTS `desh_comp_2`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `desh_comp_2` AS select `x`.`compliance` AS `compliance`,`x`.`id` AS `id`,`y`.`project_id` AS `project_id` from (`desh_comp_1` `x` left join `tblproject_files` `y` on(`x`.`id` = `y`.`project_id`)) where `y`.`project_id` is null union select `x`.`compliance` AS `compliance`,`y`.`id` AS `id`,`y`.`project_id` AS `project_id` from (`tblproject_files` `y` left join `desh_comp_1` `x` on(`x`.`id` = `y`.`project_id` and `y`.`project_id` is null)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-10 22:23:35
