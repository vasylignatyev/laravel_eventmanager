-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 30, 2020 at 05:07 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventmanager`
--
CREATE DATABASE IF NOT EXISTS `eventmanager` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `eventmanager`;

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `binary_2_binstr`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `binary_2_binstr` (`in_binary` VARBINARY(1023)) RETURNS VARCHAR(255) CHARSET utf8 NO SQL
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
END$$

DROP FUNCTION IF EXISTS `binstr_2_binary`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `binstr_2_binary` (`bin_str` VARCHAR(180) CHARSET utf8) RETURNS VARBINARY(45) NO SQL
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
END$$

DROP FUNCTION IF EXISTS `getOptionValue`$$
CREATE DEFINER=`u_eventman`@`localhost` FUNCTION `getOptionValue` (`optionStr` VARCHAR(4096), `optionName` VARCHAR(255)) RETURNS VARCHAR(255) CHARSET utf8 BEGIN
  DECLARE xpathStr varchar(255);

  SET xpathStr = CONCAT('/', optionName, '[1]');

  RETURN IFNULL(EXTRACTVALUE(optionStr, xpathStr), '');

END$$

DROP FUNCTION IF EXISTS `updateOptionValue`$$
CREATE DEFINER=`u_eventman`@`localhost` FUNCTION `updateOptionValue` (`optionStr` VARCHAR(4096), `optionName` VARCHAR(255), `optionVal` VARCHAR(255)) RETURNS VARBINARY(4096) BEGIN
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
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `i_address` int(11) NOT NULL,
  `zip` varchar(30) DEFAULT NULL COMMENT 'Идекс',
  `country` varchar(255) DEFAULT NULL COMMENT 'Страна',
  `region` varchar(255) DEFAULT NULL COMMENT 'Область',
  `locality` varchar(255) DEFAULT NULL COMMENT 'Населенный пункт',
  `street` varchar(255) DEFAULT NULL COMMENT 'Улица',
  `office` varchar(255) DEFAULT NULL COMMENT 'Квартира',
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`i_address`, `zip`, `country`, `region`, `locality`, `street`, `office`, `email`) VALUES
(26, '03056', 'Украина', NULL, 'Киев', 'Борщаговская 143-Б', '45', 'vignatyev@list.ru'),
(27, 'zip', 'Украина', 'Киевская', 'Киев', 'Борщаговская 143-Б', '45', 'vignatyev@list.ru');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `i_company` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `i_address` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`i_company`, `title`, `options`, `description`, `issue_date`, `i_address`) VALUES
(18, 'Новая компания', '', 'описание', '2018-10-18 17:52:02', 27);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `i_customer` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` binary(16) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `sex` enum('M','F') DEFAULT 'M',
  `token` binary(16) DEFAULT NULL,
  `options` varchar(1024) DEFAULT NULL,
  `i_company` int(11) DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`i_customer`, `email`, `password`, `first_name`, `second_name`, `last_name`, `sex`, `token`, `options`, `i_company`, `issue_date`) VALUES
(16, 'vasyl.ignatyev@mail.ru', NULL, 'Василий', 'Юрьевич', 'Игнатьев', 'M', NULL, NULL, 18, '2018-10-18 17:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

DROP TABLE IF EXISTS `donor`;
CREATE TABLE `donor` (
  `i_donor` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `options` varchar(4097) DEFAULT NULL,
  `short_desc` varchar(255) DEFAULT NULL,
  `full_desc` varchar(2048) DEFAULT NULL,
  `log_url` varchar(256) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `tagline` varchar(256) DEFAULT NULL COMMENT 'Слоган',
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`i_donor`, `title`, `options`, `short_desc`, `full_desc`, `log_url`, `country`, `tagline`, `issue_date`) VALUES
(1, 'Utel', NULL, 'The Best Donor', 'Украинский международный оператор телефонной связи', NULL, 'Ukraine', 'You Tell By Utel', '0000-00-00 00:00:00'),
(13, 'Ля\'бурже', NULL, 'Короткое описание', 'полное описание', NULL, 'Франция', 'Пролетарии всех стран', '0000-00-00 00:00:00'),
(14, 'test_donor_2', NULL, 'короче', 'все по порядку', NULL, 'Украина', 'Пролетарии всех стран', '0000-00-00 00:00:00'),
(15, 'Новый донор', NULL, 'коротко', 'полно', NULL, 'Украина', 'Пусть всегда будет солнце', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `i_event` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `short_desc` varchar(2047) DEFAULT NULL,
  `full_desc` varchar(16385) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `duration` varbinary(360) DEFAULT NULL COMMENT '30 days',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `i_group` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`i_event`, `title`, `short_desc`, `full_desc`, `options`, `duration`, `created_at`, `updated_at`, `i_group`) VALUES
(1, 'Ведення випадку й оцінка потреб дитини та її сім\'ї', '<p><span style=\"color: rgb(0, 0, 0); font-family: Arial;\">Ведення випадку та оцінка потреб - інноваційні технології соціальної роботи, розуміння та вміння застосовувати які покликана розвивати ця навчальна програма. Заняття будуть цікаві для спеціалістів соціальної сфери та студентів ВНЗ. Партнерством “Кожній дитині” також здійснюєтсья підготовка тренерів за цією програмою.</span></p>', '<p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\"><strong style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent;\">Знання:</strong></p><ul style=\"color: rgb(0, 0, 0); font-family: Arial;\"><li>алгоритму ведення випадку, його процедурам, принципам та механізмам;</li><li>теоретичних та концептуальних засад оцінки потреб дитини та її сім’ї;</li><li>особливостей планування та документування випадку відповідно до рівня складності;</li><li>форм та методів соціальної роботи, які можуть бути використані в процесі здійснення оцінки, доцільності цих форм та методів у різних ситуаціях.</li></ul><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\"><strong style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent;\">Навички:</strong></p><ul style=\"color: rgb(0, 0, 0); font-family: Arial;\"><li>контактної взаємодії та подолання опору, налагодження співпраці та мотивування отримувача послуги до активної участі у подоланні СЖО;</li><li>виявлення та активізації сильних сторін отримувача послуг і потенціалу його середовища для подолання СЖО;</li><li>застосування діагностичного інструментарію в процесі здійснення оцінки та планування послуг;</li><li>командної роботи в процесі ведення випадку та прийняття рішень в найкращих інтересах дитини.</li></ul><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent; color: rgb(40, 151, 163);\"><strong style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent;\">КОМУ БУДЕ ЦІКАВО ПОВЧИТИСЯ?</strong></span></p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\">Програма буде цікавою <strong style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent;\">для широкого кола фахівців соціальної сфери</strong>, а саме:</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\">-       фахівців та спеціалістів центрів соціальних служб для сім’ї, дітей та молоді;</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\">-       соціальних педагогів шкіл;</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\">-       спеціалістів служб у справах дітей;</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\">-       спеціалістів закладів соціального обслуговування та соціального захисту;</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\">-       методистів;</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\">-       медиків;</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\">-       представників громадських організацій, які здійснюють соціальну роботу з вразливими сім’ями, дітьми та молоддю.</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\">Вона також буде цікавою та корисною <strong style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent;\">для студентів вищих навчальних закладів</strong>, які проходять підготовку за спеціальностями “соціальний педагог”, “соціальний працівник”, “соціальне управління”, “психолог” та ін.</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\"><strong style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent;\">Партнерство “Кожній дитині” також здійснює підготовку тренерів за цією програмою.</strong></p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\"><strong style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent;\"><br style=\"margin: 0px; padding: 0px; min-height: 14px;\"></strong></p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\"><strong style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent;\"><br style=\"margin: 0px; padding: 0px; min-height: 14px;\"></strong></p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; min-height: 14px; color: rgb(0, 0, 0); font-family: Arial;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent; color: rgb(40, 151, 163);\"><strong style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; background: transparent;\">ЗМІСТ ПРОГРАМИ</strong></span></p>', NULL, 0x007fe0007fe0, '2017-01-26 16:15:50', NULL, NULL),
(6, 'Соціальні послуги та молодіжна політика', '<p>1</p>', '<p>1</p>', NULL, 0x007bc0007bc0, '2018-08-22 10:59:29', NULL, NULL),
(11, 'Новое событие 11', '<p>12345</p>', '<p>1234567890</p>', NULL, 0x007fe0007fe0, NULL, NULL, NULL),
(12, 'Новое событие 12', '<p>1234</p>', '<p>4321</p>', NULL, 0x007fe0007fe0, '2019-05-10 13:37:28', NULL, NULL);

--
-- Triggers `event`
--
DROP TRIGGER IF EXISTS `insert_event`;
DELIMITER $$
CREATE TRIGGER `insert_event` BEFORE INSERT ON `event` FOR EACH ROW SET NEW.duration = binstr_2_binary(NEW.duration)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_event`;
DELIMITER $$
CREATE TRIGGER `update_event` BEFORE UPDATE ON `event` FOR EACH ROW SET NEW.duration = binstr_2_binary(NEW.duration)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `i_project` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_desc` varchar(255) DEFAULT NULL,
  `full_desc` varchar(4096) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`i_project`, `title`, `short_desc`, `full_desc`, `options`, `logo_url`, `start_date`, `end_date`, `issue_date`) VALUES
(1, 'Тестовый поект #2', 'short one', 'full one', NULL, NULL, '2018-08-01', '2019-08-01', '2018-09-11 03:48:41'),
(2, 'test1 project', 'фф', 'ффффф', NULL, NULL, '2018-09-03', '2018-09-20', '2018-09-11 05:17:48'),
(14, 'Тест_3', 'jhgjkhbk', 'assd', NULL, NULL, '2018-09-13', '2019-09-13', '2018-09-13 14:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `project_donor`
--

DROP TABLE IF EXISTS `project_donor`;
CREATE TABLE `project_donor` (
  `i_project_donor` int(11) NOT NULL,
  `i_project` int(11) NOT NULL,
  `i_donor` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_donor`
--

INSERT INTO `project_donor` (`i_project_donor`, `i_project`, `i_donor`, `description`, `issue_date`) VALUES
(5, 2, 14, NULL, '2018-09-12 11:58:19'),
(6, 2, 1, NULL, '2018-09-12 11:58:44'),
(14, 1, 14, NULL, '2018-09-13 08:58:56'),
(15, 1, 1, NULL, '2018-09-13 08:58:59'),
(16, 14, 14, NULL, '2018-09-13 14:13:06'),
(17, 14, 1, NULL, '2018-09-13 14:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `i_schedule` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `options` varchar(4095) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updatet_at` datetime DEFAULT NULL,
  `i_event` int(11) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `i_trainer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`i_schedule`, `start_date`, `options`, `created_at`, `updatet_at`, `i_event`, `address`, `latitude`, `longitude`, `i_trainer`) VALUES
(3, '2018-08-18 09:00:37', NULL, '2018-08-16 12:00:51', NULL, 1, NULL, NULL, NULL, NULL),
(6, '2018-10-03 10:56:57', NULL, '2018-08-22 13:57:41', NULL, 1, NULL, NULL, NULL, NULL),
(7, '2018-08-24 10:59:43', NULL, '2018-08-22 13:59:50', NULL, 6, NULL, NULL, NULL, NULL),
(8, '2018-08-30 11:06:37', NULL, '2018-08-22 14:07:38', NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE `subscription` (
  `i_subscription` int(11) NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `uuid` binary(16) NOT NULL,
  `active` enum('FALSE','TRUE)') NOT NULL DEFAULT 'FALSE',
  `bolcked` enum('FALSE','TRUE') NOT NULL DEFAULT 'FALSE',
  `options` varchar(255) DEFAULT NULL,
  `i_customer` int(11) NOT NULL,
  `i_ticket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `i_ticket` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `options` varchar(255) DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `i_schedule` int(11) NOT NULL,
  `i_project` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`i_ticket`, `title`, `description`, `price`, `quantity`, `options`, `issue_date`, `i_schedule`, `i_project`) VALUES
(1, 'ранній', '1', '100.00', 10, NULL, '2018-08-22 11:03:18', 6, NULL),
(2, 'пізній', '2', '200.00', 20, NULL, '2018-08-22 11:03:33', 6, NULL),
(3, 'для министерства', 'Приглашение на участие в событии для министерства социальной политики', '1.00', 3, NULL, '2018-10-20 05:52:05', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

DROP TABLE IF EXISTS `trainer`;
CREATE TABLE `trainer` (
  `i_trainer` int(11) NOT NULL,
  `name` varchar(63) CHARACTER SET utf8 DEFAULT NULL,
  `second_name` varchar(63) DEFAULT NULL,
  `last_name` varchar(63) DEFAULT NULL,
  `email` varchar(127) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `short_desc` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `full_desc` mediumtext DEFAULT NULL,
  `photo_url` varchar(127) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`i_trainer`, `name`, `second_name`, `last_name`, `email`, `role`, `short_desc`, `full_desc`, `photo_url`, `created_at`, `updated_at`) VALUES
(18, 'Иван', 'Иванов', 'Иванович', 'iivanov@gmail.com', '', 'короткое описание', 'описание', NULL, '2018-10-19 06:28:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainer_schedule`
--

DROP TABLE IF EXISTS `trainer_schedule`;
CREATE TABLE `trainer_schedule` (
  `i_trainer_schedule` int(11) NOT NULL,
  `role` varchar(128) NOT NULL,
  `i_trainer` int(11) NOT NULL,
  `i_schedule` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`i_address`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`i_company`),
  ADD UNIQUE KEY `IDX_company_title` (`title`),
  ADD KEY `FK_company_address_i_address` (`i_address`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`i_customer`),
  ADD UNIQUE KEY `UK_customer_email` (`email`),
  ADD UNIQUE KEY `UK_uuid` (`token`),
  ADD KEY `FK_customer_company_i_company` (`i_company`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`i_donor`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`i_event`),
  ADD KEY `FK_event_group_i_group` (`i_group`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`i_project`),
  ADD UNIQUE KEY `UK_project` (`i_project`);

--
-- Indexes for table `project_donor`
--
ALTER TABLE `project_donor`
  ADD PRIMARY KEY (`i_project_donor`),
  ADD KEY `FK_progect_donor_donor_i_donor` (`i_donor`),
  ADD KEY `FK_progect_donar_project_i_project` (`i_project`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`i_schedule`),
  ADD KEY `FK_schedule_event_i_event` (`i_event`),
  ADD KEY `FK_schedule_trainer_i_trainer` (`i_trainer`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`i_subscription`),
  ADD UNIQUE KEY `UK_subscription` (`i_ticket`,`i_customer`),
  ADD UNIQUE KEY `UK_token` (`uuid`),
  ADD KEY `FK_subscription_customer_i_customer` (`i_customer`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`i_ticket`),
  ADD KEY `FK_ticket_schedule_i_schedule` (`i_schedule`),
  ADD KEY `FK_ticket_project_i_project` (`i_project`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`i_trainer`);

--
-- Indexes for table `trainer_schedule`
--
ALTER TABLE `trainer_schedule`
  ADD PRIMARY KEY (`i_trainer_schedule`),
  ADD KEY `FK_trainer_schedule_schedule_i_schedule` (`i_schedule`),
  ADD KEY `FK_trainer_schedule_trainer_i_trainer` (`i_trainer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `i_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `i_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `i_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `i_donor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `i_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `i_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `project_donor`
--
ALTER TABLE `project_donor`
  MODIFY `i_project_donor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `i_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `i_subscription` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `i_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `i_trainer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `trainer_schedule`
--
ALTER TABLE `trainer_schedule`
  MODIFY `i_trainer_schedule` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `FK_company_address_i_address` FOREIGN KEY (`i_address`) REFERENCES `address` (`i_address`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_customer_company_i_company` FOREIGN KEY (`i_company`) REFERENCES `company` (`i_company`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `project_donor`
--
ALTER TABLE `project_donor`
  ADD CONSTRAINT `FK_progect_donar_project_i_project` FOREIGN KEY (`i_project`) REFERENCES `project` (`i_project`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_progect_donor_donor_i_donor` FOREIGN KEY (`i_donor`) REFERENCES `donor` (`i_donor`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `FK_schedule_event_i_event` FOREIGN KEY (`i_event`) REFERENCES `event` (`i_event`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `FK_subscription_customer_i_customer` FOREIGN KEY (`i_customer`) REFERENCES `customer` (`i_customer`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_subscription_ticket_i_ticket` FOREIGN KEY (`i_ticket`) REFERENCES `ticket` (`i_ticket`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_ticket_project_i_project` FOREIGN KEY (`i_project`) REFERENCES `project` (`i_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ticket_schedule_i_schedule` FOREIGN KEY (`i_schedule`) REFERENCES `schedule` (`i_schedule`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `trainer_schedule`
--
ALTER TABLE `trainer_schedule`
  ADD CONSTRAINT `FK_trainer_schedule_schedule_i_schedule` FOREIGN KEY (`i_schedule`) REFERENCES `schedule` (`i_schedule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_trainer_schedule_trainer_i_trainer` FOREIGN KEY (`i_trainer`) REFERENCES `trainer` (`i_trainer`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
