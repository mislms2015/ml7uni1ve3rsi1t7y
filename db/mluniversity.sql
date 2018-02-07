-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2018 at 11:16 AM
-- Server version: 5.5.54
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mluniversity`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '1', 1515387539),
('system admin', '2', 1516585832),
('system admin', '3', 1517888076),
('system user', '29', 1517259335),
('system user', '30', 1517365111),
('system user', '31', 1517365241);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1515387539, 1515387539),
('/admin/*', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/default/*', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/default/index', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/menu/*', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/menu/create', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/menu/index', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/menu/update', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/menu/view', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/permission/*', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/permission/create', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/permission/index', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/permission/update', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/permission/view', 2, NULL, NULL, NULL, 1515389878, 1515389878),
('/admin/role/*', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/role/assign', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/role/create', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/role/delete', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/role/index', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/role/remove', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/role/update', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/role/view', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/route/*', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/route/assign', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/route/create', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/route/index', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/route/remove', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/rule/*', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/rule/create', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/rule/index', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/rule/update', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/rule/view', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/user/*', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/admin/user/activate', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/admin/user/delete', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/user/index', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/user/login', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/admin/user/logout', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/admin/user/signup', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/admin/user/view', 2, NULL, NULL, NULL, 1515389879, 1515389879),
('/gii/*', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/gii/default/*', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/gii/default/action', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/gii/default/diff', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/gii/default/index', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/gii/default/preview', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/gii/default/view', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/*', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/create', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/delete', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/enrollee', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/index', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/sample', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/syncattendedcert', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/synccert', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/synccourse', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/syncenrollee', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/update', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-course/view', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-manual-assessment/*', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/areareport', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/attendedcert', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/create', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/downloadform', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/index', 2, NULL, NULL, NULL, 1515389880, 1515389880),
('/mlu-manual-assessment/individualcert', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/manualenrollee', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/manualenrollee-break-old', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/regionreport', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/trainingreport', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-assessment/view', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-training/*', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-training/create', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-training/delete', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-training/index', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-training/update', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-manual-training/view', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-quiz/*', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-quiz/create', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-quiz/delete', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-quiz/index', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-quiz/update', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-quiz/view', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-region/index', 2, NULL, NULL, NULL, 1516338801, 1516338801),
('/mlu-region/view', 2, NULL, NULL, NULL, 1516338802, 1516338802),
('/mlu-role/create', 2, NULL, NULL, NULL, 1517379031, 1517379031),
('/mlu-role/index', 2, NULL, NULL, NULL, 1516418314, 1516418314),
('/mlu-role/view', 2, NULL, NULL, NULL, 1516418314, 1516418314),
('/mlu-sub-course/*', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/mlu-sub-course/create', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-sub-course/delete', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-sub-course/index', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-sub-course/update', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-sub-course/view', 2, NULL, NULL, NULL, 1515389881, 1515389881),
('/mlu-user-enrollee/*', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/mlu-user-enrollee/create', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/mlu-user-enrollee/delete', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/mlu-user-enrollee/index', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/mlu-user-enrollee/update', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/mlu-user-enrollee/view', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/site/*', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/site/error', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/site/index', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/site/login', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/site/logout', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/user-profile/update', 2, NULL, NULL, NULL, 1517033494, 1517033494),
('/user-profile/view', 2, NULL, NULL, NULL, 1517033494, 1517033494),
('/user/*', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/user/change_password', 2, NULL, NULL, NULL, 1517289964, 1517289964),
('/user/changepassword', 2, NULL, NULL, NULL, 1517280686, 1517280686),
('/user/create', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/user/delete', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/user/index', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/user/signme', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/user/update', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('/user/view', 2, NULL, NULL, NULL, 1515389882, 1515389882),
('administrator', 1, 'can do everything', NULL, NULL, 1515387539, 1515387539),
('system admin', 1, 'administrator of the system', NULL, NULL, 1515389772, 1515389772),
('system user', 1, 'user with limited access', NULL, NULL, 1515390425, 1515390425);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('administrator', '/*'),
('system admin', '/mlu-manual-assessment/*'),
('system user', '/mlu-manual-assessment/*'),
('system admin', '/mlu-region/index'),
('system admin', '/mlu-region/view'),
('system admin', '/mlu-role/create'),
('system admin', '/mlu-role/index'),
('system admin', '/mlu-role/view'),
('system admin', '/site/error'),
('system user', '/site/error'),
('system admin', '/site/index'),
('system user', '/site/index'),
('system admin', '/site/login'),
('system user', '/site/login'),
('system admin', '/site/logout'),
('system user', '/site/logout'),
('system admin', '/user-profile/update'),
('system user', '/user-profile/update'),
('system admin', '/user-profile/view'),
('system user', '/user-profile/view'),
('system admin', '/user/*'),
('system user', '/user/change_password'),
('system user', '/user/changepassword');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1513668518),
('m130524_201442_init', 1513668522),
('m140506_102106_rbac_init', 1515382690),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1515382690);

-- --------------------------------------------------------

--
-- Table structure for table `mlu_course`
--

CREATE TABLE `mlu_course` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `enroll_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `mlu_course_category`
--

CREATE TABLE `mlu_course_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlu_course_category`
--

INSERT INTO `mlu_course_category` (`id`, `category_id`, `name`) VALUES
(1, 27, 'ML University');

-- --------------------------------------------------------

--
-- Table structure for table `mlu_manual_assessment`
--

CREATE TABLE `mlu_manual_assessment` (
  `id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `id_number` int(11) NOT NULL,
  `region` varchar(50) NOT NULL,
  `area` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlu_manual_assessment`
--

INSERT INTO `mlu_manual_assessment` (`id`, `training_id`, `fname`, `lname`, `id_number`, `region`, `area`) VALUES
(38, 4, 'Mark John', 'Libarios', 20150491, 'Makati Head Office', 'N/A'),
(39, 4, 'Rheajoey', 'Cabalan', 20150212, 'Makati Head Office', 'N/A'),
(40, 4, 'ARVIN PERCIVAL', 'ABARINTOS', 20060376, 'Southwestern', 'A'),
(41, 4, 'JUDE WILLIAM', 'AMIGO', 20140103, 'Bazam', 'B'),
(42, 4, 'DESIE', 'BARING', 19980014, 'NCR Batanes', 'B'),
(44, 4, 'JEANNIE APPLE', 'CHUA', 20090076, 'Makati Head Office', 'N/A'),
(45, 4, 'MARK ANTHONY', 'DE MESA', 20070243, 'NCR Central', 'A'),
(46, 4, 'JEAN', 'DESTACAMENTO', 20090074, 'NCR North', 'B'),
(48, 4, 'MINALYN', 'EMETERIO', 20080187, 'Almazor', 'C'),
(49, 4, 'LIESLIE', 'ESPELITA', 20140215, 'Bazam', 'E'),
(50, 4, 'ANNA LEAH', 'GONZAGA', 20050337, 'Camacat', 'B'),
(51, 4, 'BERNARDO', 'GUINTAB', 20040113, 'Northeastern', 'A'),
(52, 4, 'APRIL MAE', 'GUIRAL', 20140227, 'Makati Head Office', 'N/A'),
(53, 4, 'HERLIZA', 'HILARIO', 20070138, 'NCR Central', 'A'),
(54, 4, 'MARC JOHN', 'JUCUTAN', 20140015, 'Northwestern', 'B'),
(55, 4, 'MARY JOY', 'LARANJO', 20110057, 'NCR Batanes', 'E'),
(56, 4, 'EDEN', 'LLENO', 19930022, 'Camacat', 'B'),
(57, 4, 'JANNETTE', 'MANANSALA', 20070112, 'Pampanga', 'C'),
(58, 4, 'ROCHELLE', 'MAUN', 20110206, 'Pampanga', 'D'),
(59, 4, 'TRISTAN JOHN', 'MORADA ', 20070224, 'Southwestern', 'B'),
(60, 4, 'REX', 'ORDO', 20120138, 'Southern Luzon', 'A'),
(61, 4, 'IAN MOSHER', 'PASCO', 20090256, 'NCR North', 'A'),
(62, 4, 'ANDREA', 'PER', 20050271, 'Almazor', 'C'),
(63, 4, 'MARY JANE', 'RACCA', 20000032, 'Nothern Luzon', 'B'),
(64, 4, 'MARSHA', 'REGALA', 19970031, 'Southeastern', 'E'),
(65, 4, 'LANI', 'RIOFLORIDO', 19970040, 'Southeastern', 'A'),
(66, 4, 'ROBERT JAMES', 'SABALBURO JR', 20110284, 'Northwestern', 'D'),
(67, 4, 'LINDSEY', 'SOLEDAD', 20060247, 'Northeastern', 'C'),
(68, 4, 'JOSIEPHINA', 'UMALI', 19940053, 'Laguna', 'B'),
(69, 4, 'ROCHELLE', 'YASON', 20060048, 'Bulacan', 'E'),
(70, 4, 'GARRY', 'DE GUZMAN', 20040149, 'Makati Head Office', 'N/A'),
(71, 5, 'Mark John', 'Libarios', 1001, 'Makati Head Office', 'N/A'),
(72, 5, 'Mark', 'Lee', 1002, 'Camacat', 'A'),
(73, 5, 'Mariel', 'Talana', 1003, 'Laguna', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `mlu_manual_diamond`
--

CREATE TABLE `mlu_manual_diamond` (
  `id` int(11) NOT NULL,
  `examinee_id` int(11) NOT NULL,
  `clarity` varchar(5) NOT NULL,
  `color` varchar(5) NOT NULL,
  `cut` varchar(5) NOT NULL,
  `carat` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlu_manual_diamond`
--

INSERT INTO `mlu_manual_diamond` (`id`, `examinee_id`, `clarity`, `color`, `cut`, `carat`) VALUES
(34, 38, '90%', '89%', '87%', '%'),
(35, 39, '90%', '%', '90%', '90%'),
(36, 40, '90%', '87%', '89%', '89%'),
(37, 41, '90%', '87%', '89%', '89%'),
(38, 42, '90%', '87%', '89%', '89%'),
(40, 44, '90%', '90%', '90%', '90%'),
(41, 45, '90%', '89%', '87%', '90%'),
(42, 46, '90%', '90%', '90%', '90%'),
(44, 48, '90%', '90%', '90%', '90%'),
(45, 49, '90%', '89%', '87%', '90%'),
(46, 50, '90%', '90%', '90%', '90%'),
(47, 51, '90%', '87%', '89%', '89%'),
(48, 52, '90%', '90%', '90%', '90%'),
(49, 53, '90%', '87%', '89%', '89%'),
(50, 54, '90%', '87%', '89%', '89%'),
(51, 55, '90%', '90%', '90%', '90%'),
(52, 56, '90%', '87%', '89%', '89%'),
(53, 57, '90%', '90%', '90%', '90%'),
(54, 58, '90%', '87%', '89%', '89%'),
(55, 59, '90%', '90%', '90%', '90%'),
(56, 60, '90%', '90%', '90%', '90%'),
(57, 61, '90%', '87%', '89%', '89%'),
(58, 62, '90%', '87%', '89%', '89%'),
(59, 63, '90%', '90%', '90%', '90%'),
(60, 64, '90%', '90%', '90%', '90%'),
(61, 65, '90%', '87%', '89%', '89%'),
(62, 66, '90%', '90%', '90%', '90%'),
(63, 67, '90%', '90%', '90%', '90%'),
(64, 68, '90%', '90%', '90%', '90%'),
(65, 69, '90%', '87%', '89%', '89%'),
(66, 70, '90%', '87%', '89%', '89%'),
(67, 71, '78%', '80%', '95%', '90%'),
(68, 72, '85%', '85%', '84%', '90%'),
(69, 73, '98%', '98%', '97%', '98%');

-- --------------------------------------------------------

--
-- Table structure for table `mlu_manual_gold`
--

CREATE TABLE `mlu_manual_gold` (
  `id` int(11) NOT NULL,
  `examinee_id` int(11) NOT NULL,
  `day1` varchar(5) NOT NULL,
  `day2` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlu_manual_training`
--

CREATE TABLE `mlu_manual_training` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_conduct` date NOT NULL,
  `date_conduct_to` date DEFAULT NULL,
  `trainor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `mlu_manual_training`
--

INSERT INTO `mlu_manual_training` (`id`, `name`, `date_conduct`, `date_conduct_to`, `trainor`) VALUES
(4, 'Diamond Appraisal', '2017-01-26', '1970-01-01', 'Leo Mangala'),
(5, 'Diamond', '2018-02-05', '2018-02-07', 'Adam Fidelino');

-- --------------------------------------------------------

--
-- Table structure for table `mlu_quiz`
--

CREATE TABLE `mlu_quiz` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlu_region`
--

CREATE TABLE `mlu_region` (
  `id` int(11) NOT NULL,
  `short_name` varchar(15) NOT NULL,
  `full_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlu_region`
--

INSERT INTO `mlu_region` (`id`, `short_name`, `full_name`) VALUES
(1, 'AMS', 'Almazor'),
(2, 'BZM', 'Bazam'),
(3, 'BLC', 'Bulacan'),
(4, 'CMC', 'Camacat'),
(5, 'LGN', 'Laguna'),
(6, 'MHO', 'Makati Head Office'),
(7, 'NCRB', 'NCR Batanes'),
(8, 'NCRC', 'NCR Central'),
(9, 'NCRN', 'NCR North'),
(10, 'NCRR', 'NCR Rizal'),
(11, 'NE', 'Northeastern'),
(12, 'NW', 'Northwestern'),
(13, 'NL', 'Northern Luzon'),
(14, 'PMG', 'Pampanga'),
(15, 'SE', 'Southeastern'),
(16, 'SL', 'Southern Luzon'),
(17, 'SW', 'Southwestern'),
(18, 'TRP', 'Tarpan');

-- --------------------------------------------------------

--
-- Table structure for table `mlu_role`
--

CREATE TABLE `mlu_role` (
  `id` int(11) NOT NULL,
  `short_name` varchar(15) NOT NULL,
  `full_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlu_role`
--

INSERT INTO `mlu_role` (`id`, `short_name`, `full_name`) VALUES
(1, 'RCT', 'Regional Computer Technician'),
(2, 'TSG', 'Technical Support Group');

-- --------------------------------------------------------

--
-- Table structure for table `mlu_role_assignment`
--

CREATE TABLE `mlu_role_assignment` (
  `id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlu_role_user`
--

CREATE TABLE `mlu_role_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlu_sub_course`
--

CREATE TABLE `mlu_sub_course` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlu_user_enrollee`
--

CREATE TABLE `mlu_user_enrollee` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_number` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'top1', 'jVa4pHrQW0U_0tLEu5EHgQ8msEGhKSpo', '$2y$13$zw.qZa5Z2d1KIJQweVrOKO4X8QCk0SU7rWoY1WXb4H/nC7jq8X.pG', NULL, 'mislms2015@gmail.com', 10, 1513734775, 1517365254),
(2, 'mluadmin', 'o-siMfU5y2gnOzCAn477thCmyBYD6UhF', '$2y$13$zG8aRXuJzG18FOS7zltMIOPfyvjpkmZ60yiFAbHPUemp12Capy99S', NULL, 'mluadmin@mlhuillier.com', 10, 1515377046, 1515377046),
(3, 'user', '5TKw9EDDDvZa9axGbZiRzkdaoyxr_6My', '$2y$13$3XYvNOQImwThXpfTnAESLeRx8jZC9SvyoGtVU67jfZ03N9Qtrqar2', '', 'user@mlhuillier.com', 10, 1515377423, 1517365048);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `avatar_path` varchar(255) NOT NULL,
  `avatar_base_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `firstname`, `middlename`, `lastname`, `avatar_path`, `avatar_base_url`) VALUES
(1, 1, 'Top', '', 'Zine', '1-DP.jpg', '/mluniversity/dashboard/dp/1/'),
(2, 3, 'User', '', 'User', '3-DP.png', '/mluniversity/dashboard/dp/3/'),
(3, 2, 'MLU', '', 'Admin', '2-DP.png', '/mluniversity/dashboard/dp/2/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mlu_course`
--
ALTER TABLE `mlu_course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Indexes for table `mlu_course_category`
--
ALTER TABLE `mlu_course_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlu_manual_assessment`
--
ALTER TABLE `mlu_manual_assessment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_id` (`training_id`);

--
-- Indexes for table `mlu_manual_diamond`
--
ALTER TABLE `mlu_manual_diamond`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examinee_id` (`examinee_id`);

--
-- Indexes for table `mlu_manual_gold`
--
ALTER TABLE `mlu_manual_gold`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examinee_id` (`examinee_id`);

--
-- Indexes for table `mlu_manual_training`
--
ALTER TABLE `mlu_manual_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlu_quiz`
--
ALTER TABLE `mlu_quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlu_region`
--
ALTER TABLE `mlu_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlu_role`
--
ALTER TABLE `mlu_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlu_role_assignment`
--
ALTER TABLE `mlu_role_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_id` (`assign_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `mlu_role_user`
--
ALTER TABLE `mlu_role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `mlu_sub_course`
--
ALTER TABLE `mlu_sub_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlu_user_enrollee`
--
ALTER TABLE `mlu_user_enrollee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mlu_course`
--
ALTER TABLE `mlu_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlu_course_category`
--
ALTER TABLE `mlu_course_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mlu_manual_assessment`
--
ALTER TABLE `mlu_manual_assessment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `mlu_manual_diamond`
--
ALTER TABLE `mlu_manual_diamond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `mlu_manual_gold`
--
ALTER TABLE `mlu_manual_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlu_manual_training`
--
ALTER TABLE `mlu_manual_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mlu_quiz`
--
ALTER TABLE `mlu_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlu_region`
--
ALTER TABLE `mlu_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `mlu_role`
--
ALTER TABLE `mlu_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mlu_role_assignment`
--
ALTER TABLE `mlu_role_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `mlu_role_user`
--
ALTER TABLE `mlu_role_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mlu_sub_course`
--
ALTER TABLE `mlu_sub_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mlu_user_enrollee`
--
ALTER TABLE `mlu_user_enrollee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mlu_manual_assessment`
--
ALTER TABLE `mlu_manual_assessment`
  ADD CONSTRAINT `mlu_manual_assessment_ibfk_1` FOREIGN KEY (`training_id`) REFERENCES `mlu_manual_training` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mlu_manual_diamond`
--
ALTER TABLE `mlu_manual_diamond`
  ADD CONSTRAINT `mlu_manual_diamond_ibfk_1` FOREIGN KEY (`examinee_id`) REFERENCES `mlu_manual_assessment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mlu_manual_gold`
--
ALTER TABLE `mlu_manual_gold`
  ADD CONSTRAINT `mlu_manual_gold_ibfk_1` FOREIGN KEY (`examinee_id`) REFERENCES `mlu_manual_assessment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mlu_role_assignment`
--
ALTER TABLE `mlu_role_assignment`
  ADD CONSTRAINT `mlu_role_assignment_ibfk_1` FOREIGN KEY (`assign_id`) REFERENCES `mlu_role_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mlu_role_assignment_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `mlu_region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mlu_role_user`
--
ALTER TABLE `mlu_role_user`
  ADD CONSTRAINT `mlu_role_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mlu_role_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `mlu_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mlu_user_enrollee`
--
ALTER TABLE `mlu_user_enrollee`
  ADD CONSTRAINT `mlu_user_enrollee_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `mlu_course` (`course_id`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
