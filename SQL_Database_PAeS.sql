-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2023 at 05:34 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peas`
--
CREATE DATABASE `peas`;
USE `peas`;
-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aemail`)
) ;
--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@bitsathy.ac.in', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appoid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `apponum` int DEFAULT NULL,
  `scheduleid` int DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  `status` int DEFAULT '0',
  `roomid` varchar(45) DEFAULT NULL,
  `room_flag` int DEFAULT '0',
  `payment_id` varchar(100) DEFAULT NULL,
  `booking_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`appoid`),
  UNIQUE KEY `payment_id_UNIQUE` (`payment_id`),
  KEY `pid` (`pid`),
  KEY `scheduleid` (`scheduleid`)
) ;
--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`, `status`, `roomid`, `room_flag`, `payment_id`, `booking_date`) VALUES
(1, 1, 1, 1, '2023-09-02', 0, NULL, 0, 'pay_MXQEwuf4Vd1Gz7', '2023-09-02 15:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `docid` int NOT NULL AUTO_INCREMENT,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `qualification` varchar(200) DEFAULT NULL,
  `specialties` int DEFAULT NULL,
  PRIMARY KEY (`docid`),
  KEY `specialties` (`specialties`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `qualification`, `specialties`) VALUES
(1, 'doctor@bitsathy.ac.in', 'Test Doctor', '123', '23456789653', '0110000000', 'MBBS', 18),
(2, 'sanjay.ad21@bitsathy.ac.in', 'Sanjay A R', 'vinu', '641879279568', '9826879642', 'MBBS, Orthopaedics', 35);

-- --------------------------------------------------------

--
-- Table structure for table `doc_language`
--

DROP TABLE IF EXISTS `doc_language`;
CREATE TABLE IF NOT EXISTS `doc_language` (
  `id` int NOT NULL AUTO_INCREMENT,
  `docid` int DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

--
-- Dumping data for table `doc_language`
--

INSERT INTO `doc_language` (`id`, `docid`, `language`) VALUES
(2, 2, 'English'),
(1, 1, 'English'),
(3, 2, 'Tamil');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

DROP TABLE IF EXISTS `laboratory`;
CREATE TABLE IF NOT EXISTS `laboratory` (
  `lid` int NOT NULL AUTO_INCREMENT,
  `lemail` varchar(100) DEFAULT NULL,
  `lname` varchar(60) DEFAULT NULL,
  `lpassword` varchar(45) DEFAULT NULL,
  `llicence` varchar(45) DEFAULT NULL,
  `ltel` varchar(12) DEFAULT NULL,
  `lqualification` varchar(220) DEFAULT NULL,
  `mtid` int DEFAULT NULL,
  PRIMARY KEY (`lid`),
  UNIQUE KEY `lid_UNIQUE` (`lid`)
) ;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`lid`, `lemail`, `lname`, `lpassword`, `llicence`, `ltel`, `lqualification`, `mtid`) VALUES
(1, 'allwin.cs21@bitsathy.ac.in', 'ALLWIN G B', '123', 'LT684SF648513', '9360639389', 'MLT Associate', 47);

-- --------------------------------------------------------

--
-- Table structure for table `medical_test`
--

DROP TABLE IF EXISTS `medical_test`;
CREATE TABLE IF NOT EXISTS `medical_test` (
  `mtid` int NOT NULL AUTO_INCREMENT,
  `tname` varchar(45) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `imagename` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`mtid`),
  UNIQUE KEY `idmedical_test_UNIQUE` (`mtid`)
) ;

--
-- Dumping data for table `medical_test`
--

INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (1,'medical-test',1000,'../img/tions/1.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (2,'endoscopy',3500,'../img/tions/2.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (3,'blood-test',650,'../img/tions/3.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (4,'pathology',1000,'../img/tions/4.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (5,'physical-examination',750,'../img/tions/5.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (6,'c-reactive-protein-test',550,'../img/tions/6.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (7,'nuclear-medicine',5500,'../img/tions/7.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (8,'platelet-count',350,'../img/tions/8.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (9,'capsule-endoscopy',6500,'../img/tions/9.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (10,'white-blod-cell-count',350,'../img/tions/10.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (11,'electrolytes-test',550,'../img/tions/11.jpg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (12,'mri',5500,'../img/tions/12.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (13,'pap-test',1000,'../img/tions/13.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (14,'lipase-test',550,'../img/tions/14.jpg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (15,'vitamin-b12-folate-test',1000,'../img/tions/15.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (16,'lpa-test',550,'../img/tions/16.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (17,'lithium-test',550,'../img/tions/17.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (18,'biopsy',2000,'../img/tions/18.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (19,'creatinine-clearance-test',550,'../img/tions/19.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (20,'kidney-function-test',550,'../img/tions/20.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (21,'d-dimer-test',550,'../img/tions/21.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (22,'radiology',400,'../img/tions/22.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (23,'ast-test',550,'../img/tions/23.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (24,'coronary-catheterixation',7500,'../img/tions/24.jpg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (25,'liver-function-test',550,'../img/tions/25.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (26,'ferritin-test',550,'../img/tions/26.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (27,'albimin-test',550,'../img/tions/27.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (28,'aso-test',550,'../img/tions/28.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (29,'hla-b27-test',550,'../img/tions/29.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (30,'adenosine-deaminase',1000,'../img/tions/30.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (31,'g6pd-test',550,'../img/tions/31.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (32,'quantative-immunoglobulins-test',550,'../img/tions/32.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (33,'bilirubin-test',550,'../img/tions/33.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (34,'soduim-test',350,'../img/tions/34.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (35,'c-peptide-test',550,'../img/tions/35.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (36,'cd4-and-cd8-test',550,'../img/tions/36.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (37,'skin-allergy-test',2000,'../img/tions/37.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (38,'hearing-test',1000,'../img/tions/38.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (39,'semen-analysis',1000,'../img/tions/49.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (40,'complete-blood-count',350,'../img/tions/40.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (41,'calcium-test',550,'../img/tions/41.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (42,'aldolase-test',550,'../img/tions/42.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (43,'thyroid-antibodies-test',550,'../img/tions/43.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (44,'thyroglobulin-test',550,'../img/tions/44.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (45,'sex-hormone-test',1000,'../img/tions/45.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (46,'ultrasonography',2000,'../img/tions/46.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (47,'alt-test',550,'../img/tions/47.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (48,'uric-acid-test',550,'../img/tions/48.png');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (49,'amylase-test',550,'../img/tions/50.jpeg');
INSERT INTO `` (`mtid`,`tname`,`price`,`imagename`) VALUES (50,'videonystagmography',3500,'../img/tions/39.png');

-- --------------------------------------------------------

--
-- Table structure for table `metrices`
--

DROP TABLE IF EXISTS `metrices`;
CREATE TABLE IF NOT EXISTS `metrices` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `docid` int DEFAULT NULL,
  `appoid` int DEFAULT NULL,
  `scheduleid` int DEFAULT NULL,
  `weight` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `sugar` varchar(7) DEFAULT NULL,
  `bp` varchar(7) DEFAULT NULL,
  `temp` varchar(6) DEFAULT NULL,
  `reason` varchar(200) DEFAULT NULL,
  `allergy` varchar(3) DEFAULT 'No',
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ;

--
-- Dumping data for table `metrices`
--

INSERT INTO `metrices` (`uid`, `pid`, `docid`, `appoid`, `scheduleid`, `weight`, `height`, `sugar`, `bp`, `temp`, `reason`, `allergy`, `timestamp`) VALUES
(1, 1, 1, 13, 16, 72, 197, '104', '94', '100.2', 'Fever', 'No', '2023-08-31 21:14:15'),
(2, 1, 1, 30, 32, 72, 180, '104', '72', '100.2', 'Fever', 'No', '2023-09-02 14:46:56'),
(3, 1, 1, 1, 1, 72, 180, '94', '72', '100.2', 'Fever', 'No', '2023-09-02 15:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `organ_donation`
--

DROP TABLE IF EXISTS `organ_donation`;
CREATE TABLE IF NOT EXISTS `organ_donation` (
  `odid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `organ` varchar(45) DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`odid`),
  UNIQUE KEY `odid_UNIQUE` (`odid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

DROP TABLE IF EXISTS `others`;
CREATE TABLE IF NOT EXISTS `others` (
  `oid` int NOT NULL AUTO_INCREMENT,
  `oemail` varchar(100) DEFAULT NULL,
  `oname` varchar(100) DEFAULT NULL,
  `opassword` varchar(100) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`oid`),
  UNIQUE KEY `oid_UNIQUE` (`oid`)
) ;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`oid`, `oemail`, `oname`, `opassword`, `designation`) VALUES
(1, 'reception@bitsathy.ac.in', 'Test Reception', '123', 'Receptionist'),
(2, 'pharmacy@bitsathy.ac.in', 'Test Pharmacy', '123', 'Pharmist');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pnic` varchar(15) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL,
  `blood_group` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`, `blood_group`) VALUES
(1, 'patient@bitsathy.ac.in', 'Kavinkumar B', '123', 'Sathy', '0000000000', '2000-01-01', '8072677947', 'AB+ ve'),
(3, 'kavinkumar.cs21@bitsathy.ac.in', 'Kavinkumar B', 'vinu', 'Anaippalayam', '934194569785', '2003-11-29', '8072677947', 'O+ ve'),
(4, 'anusuya1342004@gmail.com', 'Anusuya J', 'vinu', 'Pallathottam, Onnipalayam, Bilichi, Coimbatore, 641019', '234587675639', '2003-03-13', '9677927470', 'B+ ve'),
(9, 'saaivignesh.cs21@bitsathy.ac.in', 'Saaivignesh S', '123', 'Coimbatore', '62033456820', '2003-05-25', '9444342043', 'A+ ve');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

DROP TABLE IF EXISTS `payment_history`;
CREATE TABLE IF NOT EXISTS `payment_history` (
  `phid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `appoid` int DEFAULT NULL,
  `tid` int DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT '0.00',
  `title` varchar(150) DEFAULT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `total_paid` decimal(10,2) DEFAULT NULL,
  `paid_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `phstatus` int DEFAULT '1',
  PRIMARY KEY (`phid`),
  UNIQUE KEY `phid_UNIQUE` (`phid`)
) ;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`phid`, `pid`, `appoid`, `tid`, `amount`, `discount`, `title`, `payment_id`, `total_paid`, `paid_at`, `phstatus`) VALUES
(1, 1, 1, NULL, '75.00', '25.00', 'General Practice', 'pay_MXQEwuf4Vd1Gz7', '75.00', '2023-09-02 15:15:57', 1),
(2, 1, NULL, 1, '592.50', '12.50', 'ALT Test', 'pay_MYWSqdSrLpuiix', '2646.35', '2023-09-02 15:23:16', 3),
(33, 1, NULL, 427, '110.00', '2000.00', 'Biopsy', 'pay_MYgZVH8e3GRiWX', '110.00', '2023-09-05 19:53:22', 1),
(34, 1, NULL, 428, '605.00', '0.00', 'Albimin Test', 'pay_MYh7ijnTgWCsvY', '1310.00', '2023-09-05 20:25:45', 3),
(35, 1, NULL, 429, '705.00', '0.00', 'Blood Test', 'pay_MYh7ijnTgWCsvY', '1310.00', '2023-09-05 20:25:45', 3);

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

DROP TABLE IF EXISTS `refund`;
CREATE TABLE IF NOT EXISTS `refund` (
  `refid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `appoid` int DEFAULT NULL,
  `tid` int DEFAULT NULL,
  `rps` decimal(10,2) DEFAULT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT '0',
  PRIMARY KEY (`refid`),
  UNIQUE KEY `refid_UNIQUE` (`refid`)
) ;

--
-- Dumping data for table `refund`
--

INSERT INTO `refund` (`refid`, `pid`, `appoid`, `tid`, `rps`, `payment_id`, `status`) VALUES
(1, 1, NULL, 2, '2000.00', 'pay_MXQMpcZ0Wbg9Tv', '0'),
(2, 1, NULL, 3, '550.00', 'pay_MYW45g2GqOrx4d', '0'),
(3, 1, NULL, 6, '1000.00', 'pay_MYWWO0RF9D2tEX', '0'),
(4, 1, NULL, 0, '0.00', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `repid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `docid` int DEFAULT NULL,
  `scheduleid` int DEFAULT NULL,
  `appoid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `prescription` varbinary(255) DEFAULT '0',
  `report` varbinary(255) DEFAULT '0',
  `next_appointment` int DEFAULT NULL,
  PRIMARY KEY (`repid`)
) ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`repid`, `pid`, `docid`, `scheduleid`, `appoid`, `uid`, `prescription`, `report`, `next_appointment`) VALUES
(1, 1, 1, 16, 13, 1, 0x2e2e2f75706c6f6164732f707265736372697074696f6e2f363466306461616266316531322e706e67, 0x2e2e2f75706c6f6164732f7265706f72742f3131333136363466306461616635643530632e504446, 0),
(2, 1, 1, 32, 30, 2, '', 0x2e2e2f75706c6f6164732f7265706f72742f3133303332363466326664656138323365312e504446, 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `scheduleid` int NOT NULL AUTO_INCREMENT,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int DEFAULT NULL,
  `mode` varchar(45) DEFAULT NULL,
  `mail_flag` int NOT NULL DEFAULT '0',
  `leave_status` int DEFAULT '0',
  `leave_reason` varchar(230) DEFAULT NULL,
  PRIMARY KEY (`scheduleid`),
  KEY `docid` (`docid`)
) ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`, `mode`, `mail_flag`, `leave_status`, `leave_reason`) VALUES
(1, '1', 'General Practice', '2023-09-05', '17:10:00', 8, 'Hospital Visit', 0, 0, NULL),
(2, '1', 'General Practice', '2023-09-08', '10:30:00', 12, 'Hospital Visit', 0, 0, NULL),
(3, '1', 'General Practice', '2023-09-07', '09:15:00', 7, 'Hospital Visit', 0, 0, NULL),
(4, '1', 'General Practice', '2023-09-07', '19:15:00', 5, 'Video Consultancy', 0, 0, NULL),
(5, '2', 'General Practice', '2023-09-06', '17:30:00', 14, 'Hospital Visit', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

DROP TABLE IF EXISTS `specialties`;
CREATE TABLE IF NOT EXISTS `specialties` (
  `id` int NOT NULL,
  `sname` varchar(50) DEFAULT NULL,
  `imgname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

--
-- Dumping data for table `specialties`
--

INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (1,'accident-and-emergency-medicine','../img/sicon/1.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (2,'allergology','../img/sicon/2.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (3,'anaesthetics','../img/sicon/3.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (4,'biological-hematology','../img/sicon/4.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (5,'cardiology','../img/sicon/5.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (6,'child-psychiatry','../img/sicon/6.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (7,'clinical-biology','../img/sicon/7.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (8,'clinical-chemistry','../img/sicon/8.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (9,'clinical-neurophysiology','../img/sicon/9.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (10,'clinical-radiology','../img/sicon/10.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (11,'dental-oral-and-maxillo-facial-surgery','../img/sicon/11.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (12,'dermato-venerology','../img/sicon/12.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (13,'dermatology','../img/sicon/13.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (14,'endocrinology','../img/sicon/14.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (15,'gastro-enterologic-surgery','../img/sicon/15.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (16,'gastroenterology','../img/sicon/16.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (17,'general-hematology','../img/sicon/17.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (18,'general-practice','../img/sicon/18.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (19,'general-surgery','../img/sicon/19.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (20,'geriatrics','../img/sicon/20.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (21,'immunology','../img/sicon/21.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (22,'infectious-diseases','../img/sicon/22.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (23,'internal-medicine','../img/sicon/23.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (24,'laboratory-medicine','../img/sicon/24.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (25,'maxillo-facial-surgery','../img/sicon/25.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (26,'microbiology','../img/sicon/26.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (27,'nephrology','../img/sicon/27.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (28,'neuro-psychiatry','../img/sicon/28.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (29,'neurology','../img/sicon/29.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (30,'neurosurgery','../img/sicon/30.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (31,'nuclear-medicine','../img/sicon/31.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (32,'obstetrics-and-gynecology','../img/sicon/32.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (33,'occupational-medicine','../img/sicon/33.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (34,'ophthalmology','../img/sicon/34.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (35,'orthopaedics','../img/sicon/35.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (36,'otorhinolaryngology','../img/sicon/36.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (37,'paediatric-surgery','../img/sicon/37.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (38,'paediatrics','../img/sicon/38.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (39,'pathology','../img/sicon/39.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (40,'pharmacology','../img/sicon/40.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (41,'physical-medicine-and-rehabilitation','../img/sicon/41.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (42,'plastic-surgery','../img/sicon/42.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (43,'podiatric-medicine','../img/sicon/43.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (44,'podiatric-surgery','../img/sicon/44.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (45,'psychiatry','../img/sicon/45.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (46,'public-health-and-preventive-medicine','../img/sicon/46.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (47,'radiology','../img/sicon/47.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (48,'radiotherapy','../img/sicon/48.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (49,'respiratory-medicine','../img/sicon/49.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (50,'rheumatology','../img/sicon/50.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (51,'stomatology','../img/sicon/51.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (52,'thoracic-surgery','../img/sicon/52.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (53,'tropical-medicine','../img/sicon/53.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (54,'urology','../img/sicon/54.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (55,'vascular-surgery','../img/sicon/55.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (56,'venereology','../img/sicon/56.png');
INSERT INTO `` (`id`,`sname`,`imgname`) VALUES (57,'general-op','../img/sicon/57.png');

-- --------------------------------------------------------

--
-- Table structure for table `test_booking`
--

DROP TABLE IF EXISTS `test_booking`;
CREATE TABLE IF NOT EXISTS `test_booking` (
  `tid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `mtid` int DEFAULT NULL,
  `status` int DEFAULT '0',
  `payment_id` varchar(100) DEFAULT NULL,
  `booked_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tid`),
  UNIQUE KEY `tid_UNIQUE` (`tid`)
) ;
--
-- Dumping data for table `test_booking`
--

INSERT INTO `test_booking` (`tid`, `pid`, `mtid`, `status`, `payment_id`, `booked_time`) VALUES
(1, 1, 47, 1, 'pay_MXQMpcZ0Wbg9Tv', '2023-09-02 15:23:16'),
(427, 1, 18, 0, 'pay_MYgZVH8e3GRiWX', '2023-09-05 19:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `test_report`
--

DROP TABLE IF EXISTS `test_report`;
CREATE TABLE IF NOT EXISTS `test_report` (
  `trid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `lid` int DEFAULT NULL,
  `tid` int DEFAULT NULL,
  `mtid` int DEFAULT NULL,
  `file_name` varbinary(255) DEFAULT NULL,
  `seen_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`trid`),
  UNIQUE KEY `trid_UNIQUE` (`trid`)
) ;

--
-- Dumping data for table `test_report`
--

INSERT INTO `test_report` (`trid`, `pid`, `lid`, `tid`, `mtid`, `file_name`, `seen_at`) VALUES
(1, 1, 1, 1, 47, 0x2e2e2f75706c6f6164732f746573742d7265706f72742f31343731363466333133663230356335302e504446, '2023-09-02 16:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

DROP TABLE IF EXISTS `wallet`;
CREATE TABLE IF NOT EXISTS `wallet` (
  `pid` int NOT NULL,
  `balance` decimal(10,2) DEFAULT '0.00',
  `bonus` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pid_UNIQUE` (`pid`)
) ;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`pid`, `balance`, `bonus`) VALUES
(1, '2.50', '221.55'),
(3, '0.00', '0.00'),
(4, '0.00', '0.00'),
(9, '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@bitsathy.ac.in', 'a'),
('doctor@bitsathy.ac.in', 'd'),
('patient@bitsathy.ac.in', 'p'),
('kavinkumar.cs21@bitsathy.ac.in', 'p'),
('sanjay.ad21@bitsathy.ac.in', 'd'),
('reception@bitsathy.ac.in', 'r'),
('pharmacy@bitsathy.ac.in', 'm'),
('anusuya1342004@gmail.com', 'p'),
('allwin.cs21@bitsathy.ac.in', 'l'),
('saaivignesh.cs21@bitsathy.ac.in', 'p');