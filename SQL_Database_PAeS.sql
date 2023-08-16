-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2023 at 03:57 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`, `status`) VALUES
(17, 1, 2, 16, '2023-07-13', 1),
(16, 1, 1, 15, '2023-07-12', 0),
(18, 1, 1, 17, '2023-07-26', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(1, 'patient@bitsathy.ac.in', 'Test Patient', '123', 'Sathy', '0000000000', '2000-01-01', '0120000000'),
(3, 'kavinkumar.cs21@bitsathy.ac.in', 'Kavinkumar B', 'vinu', 'Anaippalayam', '934194569785', '2003-11-29', '8072677947');

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
  PRIMARY KEY (`scheduleid`),
  KEY `docid` (`docid`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`) VALUES
(18, '2', 'General [OP]', '2023-07-26', '18:00:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

DROP TABLE IF EXISTS `specialties`;
CREATE TABLE IF NOT EXISTS `specialties` (
  `id` int NOT NULL,
  `sname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Accident and emergency medicine'),
(2, 'Allergology'),
(3, 'Anaesthetics'),
(4, 'Biological hematology'),
(5, 'Cardiology'),
(6, 'Child psychiatry'),
(7, 'Clinical biology'),
(8, 'Clinical chemistry'),
(9, 'Clinical neurophysiology'),
(10, 'Clinical radiology'),
(11, 'Dental, oral and maxillo-facial surgery'),
(12, 'Dermato-venerology'),
(13, 'Dermatology'),
(14, 'Endocrinology'),
(15, 'Gastro-enterologic surgery'),
(16, 'Gastroenterology'),
(17, 'General hematology'),
(18, 'General Practice'),
(19, 'General surgery'),
(20, 'Geriatrics'),
(21, 'Immunology'),
(22, 'Infectious diseases'),
(23, 'Internal medicine'),
(24, 'Laboratory medicine'),
(25, 'Maxillo-facial surgery'),
(26, 'Microbiology'),
(27, 'Nephrology'),
(28, 'Neuro-psychiatry'),
(29, 'Neurology'),
(30, 'Neurosurgery'),
(31, 'Nuclear medicine'),
(32, 'Obstetrics and gynecology'),
(33, 'Occupational medicine'),
(34, 'Ophthalmology'),
(35, 'Orthopaedics'),
(36, 'Otorhinolaryngology'),
(37, 'Paediatric surgery'),
(38, 'Paediatrics'),
(39, 'Pathology'),
(40, 'Pharmacology'),
(41, 'Physical medicine and rehabilitation'),
(42, 'Plastic surgery'),
(43, 'Podiatric Medicine'),
(44, 'Podiatric Surgery'),
(45, 'Psychiatry'),
(46, 'Public health and Preventive Medicine'),
(47, 'Radiology'),
(48, 'Radiotherapy'),
(49, 'Respiratory medicine'),
(50, 'Rheumatology'),
(51, 'Stomatology'),
(52, 'Thoracic surgery'),
(53, 'Tropical medicine'),
(54, 'Urology'),
(55, 'Vascular surgery'),
(56, 'Venereology');

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
('pharmacy@bitsathy.ac.in', 'm');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
