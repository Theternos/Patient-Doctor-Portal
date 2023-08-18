-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2023 at 09:53 AM
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
CREATE DATABASE IF NOT EXISTS `peas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`appoid`),
  KEY `pid` (`pid`),
  KEY `scheduleid` (`scheduleid`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`, `status`) VALUES
(17, 1, 2, 16, '2023-07-13', 1),
(16, 1, 1, 15, '2023-07-12', 0),
(18, 1, 1, 17, '2023-07-26', 1),
(31, 1, 2, 20, '0000-00-00', 0),
(30, 1, 1, 20, '0000-00-00', 0),
(45, 1, 1, 22, '0000-00-00', 0),
(44, 3, 2, 21, '0000-00-00', 0),
(43, 5, 3, 21, '0000-00-00', 0);

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
  `specialties` int DEFAULT NULL,
  PRIMARY KEY (`docid`),
  KEY `specialties` (`specialties`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(1, 'doctor@bitsathy.ac.in', 'Test Doctor', '123', '000000000', '0110000000', 1),
(2, 'sanjay.ad21@bitsathy.ac.in', 'Sanjay A R', 'vinu', '641879279568', '9826879642', 35);

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
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(1, 'patient@bitsathy.ac.in', 'Test Patient', '123', 'Sathy', '0000000000', '2000-01-01', '8072677947'),
(3, 'kavinkumar.cs21@bitsathy.ac.in', 'Kavinkumar B', 'vinu', 'Anaippalayam', '934194569785', '2003-11-29', '8072677947'),
(4, 'anusuya1342004@gmail.com', 'Anusuya J', 'vinu', 'Pallathottam, Onnipalayam, Bilichi, Coimbatore, 641019', '234587675639', '2003-03-13', '9677927470'),
(5, 'allwin.cs21@bitsathy.ac.in', 'Allwin G B', '123', 'Gopi', '62033456820', '2004-06-25', '9360639389');

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
  `mail_flag` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`scheduleid`),
  KEY `docid` (`docid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`, `mail_flag`) VALUES
(21, '2', 'General', '2023-08-17', '21:00:00', 10, 1),
(22, '1', 'Ortho', '2023-08-18', '08:45:00', 20, 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(56, 'Venereology', '../img/sicon/56.png');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
('allwin.cs21@bitsathy.ac.in', 'p');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
