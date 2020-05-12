-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `i_address` int(11) NOT NULL AUTO_INCREMENT,
  `zip` varchar(30) DEFAULT NULL COMMENT 'Идекс',
  `country` varchar(255) DEFAULT NULL COMMENT 'Страна',
  `region` varchar(255) DEFAULT NULL COMMENT 'Область',
  `locality` varchar(255) DEFAULT NULL COMMENT 'Населенный пункт',
  `street` varchar(255) DEFAULT NULL COMMENT 'Улица',
  `office` varchar(255) DEFAULT NULL COMMENT 'Квартира',
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`i_address`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `i_company` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `i_address` int(11) DEFAULT NULL,
  PRIMARY KEY (`i_company`),
  UNIQUE KEY `IDX_company_title` (`title`),
  KEY `FK_company_address_i_address` (`i_address`),
  CONSTRAINT `FK_company_address_i_address` FOREIGN KEY (`i_address`) REFERENCES `address` (`i_address`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `i_customer` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` binary(16) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `sex` enum('M','F') DEFAULT 'M',
  `token` binary(16) DEFAULT NULL,
  `options` varchar(1024) DEFAULT NULL,
  `i_company` int(11) DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`i_customer`),
  UNIQUE KEY `UK_customer_email` (`email`),
  UNIQUE KEY `UK_uuid` (`token`),
  KEY `FK_customer_company_i_company` (`i_company`),
  CONSTRAINT `FK_customer_company_i_company` FOREIGN KEY (`i_company`) REFERENCES `company` (`i_company`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `donor`
--

DROP TABLE IF EXISTS `donor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donor` (
  `i_donor` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `options` varchar(4097) DEFAULT NULL,
  `short_desc` varchar(255) DEFAULT NULL,
  `full_desc` varchar(2048) DEFAULT NULL,
  `log_url` varchar(256) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `tagline` varchar(256) DEFAULT NULL COMMENT 'Слоган',
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`i_donor`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `short_desc` varchar(2047) DEFAULT NULL,
  `full_desc` varchar(16385) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `duration` varbinary(360) DEFAULT NULL COMMENT '30 days',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `i_group` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_title` (`title`,`id`),
  KEY `FK_event_group_i_group` (`i_group`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `insert_event` BEFORE INSERT ON `events` FOR EACH ROW SET NEW.duration = binstr_2_binary(NEW.duration) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `update_event` BEFORE UPDATE ON `events` FOR EACH ROW SET NEW.duration = binstr_2_binary(NEW.duration) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `i_project` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `short_desc` varchar(255) DEFAULT NULL,
  `full_desc` varchar(4096) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`i_project`),
  UNIQUE KEY `UK_project` (`i_project`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_donor`
--

DROP TABLE IF EXISTS `project_donor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_donor` (
  `i_project_donor` int(11) NOT NULL AUTO_INCREMENT,
  `i_project` int(11) NOT NULL,
  `i_donor` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`i_project_donor`),
  KEY `FK_progect_donor_donor_i_donor` (`i_donor`),
  KEY `FK_progect_donar_project_i_project` (`i_project`),
  CONSTRAINT `FK_progect_donar_project_i_project` FOREIGN KEY (`i_project`) REFERENCES `project` (`i_project`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_progect_donor_donor_i_donor` FOREIGN KEY (`i_donor`) REFERENCES `donor` (`i_donor`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `schedule_trainer`
--

DROP TABLE IF EXISTS `schedule_trainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_trainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_trainer_schedule_schedule_i_schedule` (`schedule_id`),
  KEY `FK_trainer_schedule_trainer_i_trainer` (`trainer_id`),
  CONSTRAINT `FK_trainer_schedule_schedule_i_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_trainer_schedule_trainer_i_trainer` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `options` varchar(4095) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_schedule_event_id` (`event_id`) USING BTREE,
  CONSTRAINT `FK_schedule_event_i_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription` (
  `i_subscription` int(11) NOT NULL AUTO_INCREMENT,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `uuid` binary(16) NOT NULL,
  `active` enum('FALSE','TRUE)') NOT NULL DEFAULT 'FALSE',
  `bolcked` enum('FALSE','TRUE') NOT NULL DEFAULT 'FALSE',
  `options` varchar(255) DEFAULT NULL,
  `i_customer` int(11) NOT NULL,
  `i_ticket` int(11) NOT NULL,
  PRIMARY KEY (`i_subscription`),
  UNIQUE KEY `UK_subscription` (`i_ticket`,`i_customer`),
  UNIQUE KEY `UK_token` (`uuid`),
  KEY `FK_subscription_customer_i_customer` (`i_customer`),
  CONSTRAINT `FK_subscription_customer_i_customer` FOREIGN KEY (`i_customer`) REFERENCES `customer` (`i_customer`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_subscription_ticket_i_ticket` FOREIGN KEY (`i_ticket`) REFERENCES `ticket` (`i_ticket`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `i_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `options` varchar(255) DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `i_schedule` int(11) NOT NULL,
  `i_project` int(11) DEFAULT NULL,
  PRIMARY KEY (`i_ticket`),
  KEY `FK_ticket_schedule_i_schedule` (`i_schedule`),
  KEY `FK_ticket_project_i_project` (`i_project`),
  CONSTRAINT `FK_ticket_project_i_project` FOREIGN KEY (`i_project`) REFERENCES `project` (`i_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ticket_schedule_i_schedule` FOREIGN KEY (`i_schedule`) REFERENCES `schedules` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trainers`
--

DROP TABLE IF EXISTS `trainers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(63) CHARACTER SET utf8 DEFAULT NULL,
  `second_name` varchar(63) DEFAULT NULL,
  `last_name` varchar(63) DEFAULT NULL,
  `email` varchar(127) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `description` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `photo_url` varchar(127) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'laravel'
--
/*!50003 DROP FUNCTION IF EXISTS `binary_2_binstr` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `binary_2_binstr`(`in_binary` VARBINARY(1023)) RETURNS varchar(255) CHARSET utf8
    NO SQL
    SQL SECURITY INVOKER
BEGIN
DECLARE hex_str VARCHAR(255);
DECLARE len INT;
DECLARE samp INT DEFAULT 2;
DECLARE step INT DEFAULT 2;
DECLARE bin_str VARCHAR(255) DEFAULT '';

DECLARE i INT DEFAULT 1;
DECLARE hex CHAR(48);

SET hex_str = HEX(in_binary);
SET len = LENGTH(hex_str);

WHILE i <= len DO
   SET bin_str = CONCAT(bin_str,LPAD(CONV(SUBSTRING(hex_str,i,2),16,2),8,'0'));
   SET i = i + 2;
END WHILE;
RETURN bin_str;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `binstr_2_binary` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `binstr_2_binary`(`bin_str` VARCHAR(180) CHARSET utf8) RETURNS varbinary(45)
    NO SQL
    SQL SECURITY INVOKER
BEGIN
DECLARE len INT;
DECLARE i INT DEFAULT 1;
DECLARE hex_str CHAR(45) DEFAULT '';
DECLARE hex CHAR(48);
DECLARE step INT DEFAULT 8;
DECLARE samp INT DEFAULT 2;

set len = LENGTH(bin_str);

WHILE i <= len DO
   SET hex = LPAD(CONV( SUBSTRING(bin_str,i,samp*4),2,16 ),samp,'0');
   SET hex_str = CONCAT( hex_str, hex);
   SET i = i + step;
END WHILE;
-- RETURN hex_str;
RETURN UNHEX(hex_str);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getOptionValue` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u_eventman`@`localhost` FUNCTION `getOptionValue`(`optionStr` VARCHAR(4096), `optionName` VARCHAR(255)) RETURNS varchar(255) CHARSET utf8
BEGIN
  DECLARE xpathStr varchar(255);

  SET xpathStr = CONCAT('/', optionName, '[1]');

  RETURN IFNULL(EXTRACTVALUE(optionStr, xpathStr), '');

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `updateOptionValue` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`u_eventman`@`localhost` FUNCTION `updateOptionValue`(`optionStr` VARCHAR(4096), `optionName` VARCHAR(255), `optionVal` VARCHAR(255)) RETURNS varbinary(4096)
BEGIN
  DECLARE result varchar (4096);
  DECLARE xpathStr, xml varchar (255);

  set xpathStr = CONCAT( '/', optionName, '[1]');

  set optionStr = IF( ExtractValue( optionStr, xpathStr) IS NULL , '',  optionStr);

  set xml = CONCAT('<', optionName, '>', optionVal ,'</', optionName,'>');

  IF(ExtractValue( optionStr, CONCAT('count(', xpathStr, ')')) > 0) THEN
    set result =  UPDATEXML( optionStr ,xpathStr, xml );
  ELSE
    set result = CONCAT(optionStr, xml);
  END IF;

RETURN result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-12 12:17:23
