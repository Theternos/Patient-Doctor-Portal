-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 31, 2023 at 07:04 PM
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
(1, 1, 1, 28, '2023-08-27', 0, NULL, 0, 'pay_MWO0a9fa7zMPpA', '2023-08-31 00:47:58'),
(12, 1, 1, 17, '2023-08-31', 0, NULL, 0, 'pay_MWO0a9fa7zMPpU', '2023-08-31 00:47:58'),
(13, 1, 1, 16, '2023-08-31', 1, NULL, 0, 'pay_MWjFZZNpQksWvp', '2023-08-31 21:12:40');

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
) ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `qualification`, `specialties`) VALUES
(1, 'doctor@bitsathy.ac.in', 'Test Doctor', '123', '23456789o', '0110000000', 'MBBS', 1),
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

INSERT INTO `medical_test` (`mtid`, `tname`, `price`, `imagename`) VALUES
(1, 'Medical Test', 1000, '../img/tions/1.png'),
(2, 'Endoscopy', 3500, '../img/tions/2.png'),
(3, 'Blood Test', 650, '../img/tions/3.png'),
(4, 'Pathology', 1000, '../img/tions/4.png'),
(5, 'Physical Examination', 750, '../img/tions/5.png'),
(6, 'C-Reactive Protein Test', 550, '../img/tions/6.png'),
(7, 'Nuclear Medicine', 5500, '../img/tions/7.png'),
(8, 'Platelet Count', 350, '../img/tions/8.png'),
(9, 'Capsule Endoscopy', 6500, '../img/tions/9.png'),
(10, 'White Blod Cell Count', 350, '../img/tions/10.png'),
(11, 'Electrolytes Test', 550, '../img/tions/11.jpg'),
(12, 'MRI', 5500, '../img/tions/12.png'),
(13, 'Pap Test', 1000, '../img/tions/13.png'),
(14, 'Lipase Test', 550, '../img/tions/14.jpg'),
(15, 'Vitamin B12 & Folate test', 1000, '../img/tions/15.png'),
(16, 'Lp(a) Test', 550, '../img/tions/16.png'),
(17, 'Lithium Test', 550, '../img/tions/17.png'),
(18, 'Biopsy', 2000, '../img/tions/18.png'),
(19, 'Creatinine Clearance Test', 550, '../img/tions/19.jpeg'),
(20, 'Kidney Function Test', 550, '../img/tions/20.png'),
(21, 'D-dimer Test', 550, '../img/tions/21.jpeg'),
(22, 'Radiology', 400, '../img/tions/22.png'),
(23, 'AST Test', 550, '../img/tions/23.png'),
(24, 'Coronary Catheterixation', 7500, '../img/tions/24.jpg'),
(25, 'Liver function Test', 550, '../img/tions/25.png'),
(26, 'Ferritin Test', 550, '../img/tions/26.jpeg'),
(27, 'Albimin Test', 550, '../img/tions/27.jpeg'),
(28, 'ASO Test', 550, '../img/tions/28.jpeg'),
(29, 'HLA-B27 Test', 550, '../img/tions/29.jpeg'),
(30, 'Adenosine Deaminase', 1000, '../img/tions/30.png'),
(31, 'G6PD Test', 550, '../img/tions/31.png'),
(32, 'Quantative immunoglobulins Test', 550, '../img/tions/32.jpeg'),
(33, 'Bilirubin Test', 550, '../img/tions/33.png'),
(34, 'Soduim Test', 350, '../img/tions/34.png'),
(35, 'C-peptide Test', 550, '../img/tions/35.png'),
(36, 'CD4 and CD8 Test', 550, '../img/tions/36.jpeg'),
(37, 'Skin Allergy Test', 2000, '../img/tions/37.png'),
(38, 'Hearing Test', 1000, '../img/tions/38.png'),
(39, 'Semen Analysis', 1000, '../img/tions/49.png'),
(40, 'Complete Blood Count', 350, '../img/tions/40.png'),
(41, 'Calcium Test', 550, '../img/tions/41.png'),
(42, 'Aldolase Test', 550, '../img/tions/42.png'),
(43, 'Thyroid Antibodies Test', 550, '../img/tions/43.png'),
(44, 'Thyroglobulin Test', 550, '../img/tions/44.jpeg'),
(45, 'Sex Hormone Test', 1000, '../img/tions/45.png'),
(46, 'Ultrasonography', 2000, '../img/tions/46.png'),
(47, 'ALT Test', 550, '../img/tions/47.png'),
(48, 'Uric Acid Test', 550, '../img/tions/48.png'),
(49, 'Amylase Test', 550, '../img/tions/50.jpeg'),
(50, 'Videonystagmography', 3500, '../img/tions/39.png');

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
(1, 1, 1, 13, 16, 72, 197, '104', '94', '100.2', 'Fever', 'No', '2023-08-31 21:14:15');

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
  PRIMARY KEY (`pid`)
) ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(1, 'patient@bitsathy.ac.in', 'Kavinkumar B', '123', 'Sathy', '0000000000', '2000-01-01', '8072677947'),
(3, 'kavinkumar.cs21@bitsathy.ac.in', 'Kavinkumar B', 'vinu', 'Anaippalayam', '934194569785', '2003-11-29', '8072677947'),
(4, 'anusuya1342004@gmail.com', 'Anusuya J', 'vinu', 'Pallathottam, Onnipalayam, Bilichi, Coimbatore, 641019', '234587675639', '2003-03-13', '9677927470');

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
  `rps` int DEFAULT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT '0',
  PRIMARY KEY (`refid`),
  UNIQUE KEY `refid_UNIQUE` (`refid`)
) ;

--
-- Dumping data for table `refund`
--

INSERT INTO `refund` (`refid`, `pid`, `appoid`, `tid`, `rps`, `payment_id`, `status`) VALUES
(1, 1, NULL, 3, 1000, 'pay_MWNjiYWIJVmGME', '0'),
(2, 1, NULL, 7, 7500, 'pay_MWNjiYWIJVmGME', '0');

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
(1, 1, 1, 16, 13, 1, 0x2e2e2f75706c6f6164732f707265736372697074696f6e2f363466306461616266316531322e706e67, 0x2e2e2f75706c6f6164732f7265706f72742f3131333136363466306461616635643530632e504446, 0);

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
(15, '1', 'Paediatrics', '2023-09-01', '09:00:00', 2, 'Hospital Visit', 0, 0, NULL),
(16, '1', 'Anaesthetics', '2023-08-31', '18:00:00', 10, 'Hospital Visit', 0, 0, NULL),
(17, '2', 'Paediatrics', '2023-09-02', '17:30:00', 3, 'Video Consultancy', 0, 0, NULL),
(27, '2', 'Paediatrics', '2023-08-31', '19:15:00', 2, 'Video Consultancy', 0, 0, NULL),
(28, '2', 'Paediatrics', '2023-09-03', '15:45:00', 2, 'Hospital Visit', 0, 0, NULL),
(30, '1', 'Allergology', '2023-08-31', '18:00:00', 7, 'Hospital Visit', 0, 0, NULL);

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

INSERT INTO `specialties` (`id`, `sname`, `imgname`) VALUES
(1, 'Accident and emergency medicine', '../img/sicon/1.png'),
(2, 'Allergology', '../img/sicon/2.png'),
(3, 'Anaesthetics', '../img/sicon/3.png'),
(4, 'Biological hematology', '../img/sicon/4.png'),
(5, 'Cardiology', '../img/sicon/5.png'),
(6, 'Child psychiatry', '../img/sicon/6.png'),
(7, 'Clinical biology', '../img/sicon/7.png'),
(8, 'Clinical chemistry', '../img/sicon/8.png'),
(9, 'Clinical neurophysiology', '../img/sicon/9.png'),
(10, 'Clinical radiology', '../img/sicon/10.png'),
(11, 'Dental, oral and maxillo-facial surgery', '../img/sicon/11.png'),
(12, 'Dermato-venerology', '../img/sicon/12.png'),
(13, 'Dermatology', '../img/sicon/13.png'),
(14, 'Endocrinology', '../img/sicon/14.png'),
(15, 'Gastro-enterologic surgery', '../img/sicon/15.png'),
(16, 'Gastroenterology', '../img/sicon/16.png'),
(17, 'General hematology', '../img/sicon/17.png'),
(18, 'General Practice', '../img/sicon/18.png'),
(19, 'General surgery', '../img/sicon/19.png'),
(20, 'Geriatrics', '../img/sicon/20.png'),
(21, 'Immunology', '../img/sicon/21.png'),
(22, 'Infectious diseases', '../img/sicon/22.png'),
(23, 'Internal medicine', '../img/sicon/23.png'),
(24, 'Laboratory medicine', '../img/sicon/24.png'),
(25, 'Maxillo-facial surgery', '../img/sicon/25.png'),
(26, 'Microbiology', '../img/sicon/26.png'),
(27, 'Nephrology', '../img/sicon/27.png'),
(28, 'Neuro-psychiatry', '../img/sicon/28.png'),
(29, 'Neurology', '../img/sicon/29.png'),
(30, 'Neurosurgery', '../img/sicon/30.png'),
(31, 'Nuclear medicine', '../img/sicon/31.png'),
(32, 'Obstetrics and gynecology', '../img/sicon/32.png'),
(33, 'Occupational medicine', '../img/sicon/33.png'),
(34, 'Ophthalmology', '../img/sicon/34.png'),
(35, 'Orthopaedics', '../img/sicon/35.png'),
(36, 'Otorhinolaryngology', '../img/sicon/36.png'),
(37, 'Paediatric surgery', '../img/sicon/37.png'),
(38, 'Paediatrics', '../img/sicon/38.png'),
(39, 'Pathology', '../img/sicon/39.png'),
(40, 'Pharmacology', '../img/sicon/40.png'),
(41, 'Physical medicine and rehabilitation', '../img/sicon/41.png'),
(42, 'Plastic surgery', '../img/sicon/42.png'),
(43, 'Podiatric Medicine', '../img/sicon/43.png'),
(44, 'Podiatric Surgery', '../img/sicon/44.png'),
(45, 'Psychiatry', '../img/sicon/45.png'),
(46, 'Public health and Preventive Medicine', '../img/sicon/46.png'),
(47, 'Radiology', '../img/sicon/47.png'),
(48, 'Radiotherapy', '../img/sicon/48.png'),
(49, 'Respiratory medicine', '../img/sicon/49.png'),
(50, 'Rheumatology', '../img/sicon/50.png'),
(51, 'Stomatology', '../img/sicon/51.png'),
(52, 'Thoracic surgery', '../img/sicon/52.png'),
(53, 'Tropical medicine', '../img/sicon/53.png'),
(54, 'Urology', '../img/sicon/54.png'),
(55, 'Vascular surgery', '../img/sicon/55.png'),
(56, 'Venereology', '../img/sicon/56.png'),
(57, 'General OP', '../img/sicon/57.png');

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
(2, 1, 47, 1, 'pay_MWNjiYWIJVmGME', '2023-08-30 16:39:13'),
(5, 1, 30, 0, 'pay_MWNjiYWIJVmGME', '2023-08-30 20:51:06');

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
(1, 1, 1, 2, 47, 0x2e2e2f75706c6f6164732f746573742d7265706f72742f31343731363466303562303637353861362e504446, '2023-08-31 14:49:02');

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
('allwin.cs21@bitsathy.ac.in', 'l');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
