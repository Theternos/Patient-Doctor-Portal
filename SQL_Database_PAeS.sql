-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 11, 2023 at 06:31 PM
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
  `aemail` varchar(220) NOT NULL,
  `apassword` varchar(220) DEFAULT NULL,
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
(1, 1, 1, 1, '2023-09-02', 0, NULL, 0, 'pay_MXQEwuf4Vd1Gz7', '2023-09-02 15:15:57'),
(3, 1, 1, 2, '2023-09-08', 0, NULL, 0, 'pay_MZoC1EH49TqFIy', '2023-09-08 15:59:42'),
(4, 1, 1, 5, '2023-09-09', 0, NULL, 0, 'pay_Ma6JVwEq9sB7OP', '2023-09-09 09:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `blood_group_request`
--

DROP TABLE IF EXISTS `blood_group_request`;
CREATE TABLE IF NOT EXISTS `blood_group_request` (
  `bgrid` int NOT NULL AUTO_INCREMENT,
  `blood_group` varchar(45) DEFAULT NULL,
  `unit` int DEFAULT NULL,
  `flag` int DEFAULT '0',
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bgrid`),
  UNIQUE KEY `bgrid_UNIQUE` (`bgrid`)
) ;

--
-- Dumping data for table `blood_group_request`
--

INSERT INTO `blood_group_request` (`bgrid`, `blood_group`, `unit`, `flag`, `timestamp`) VALUES
(1, 'B+ ve', 2, 1, '2023-09-11 01:27:15'),
(2, 'O+ ve', 1, 0, '2023-09-11 01:29:57'),
(3, 'A+ ve', 1, 0, '2023-09-11 01:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `docid` int NOT NULL AUTO_INCREMENT,
  `docemail` varchar(220) DEFAULT NULL,
  `docname` varchar(220) DEFAULT NULL,
  `docpassword` varchar(220) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `qualification` varchar(220) DEFAULT NULL,
  `specialties` int DEFAULT NULL,
  PRIMARY KEY (`docid`),
  KEY `specialties` (`specialties`)
) ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `qualification`, `specialties`) VALUES
(1, 'doctor@bitsathy.ac.in', 'Test Doctor', '123', '23456789653', '0110000000', 'MBBS', 18),
(2, 'sanjay.ad21@bitsathy.ac.in', 'Sanjay A R', 'vinu', '641879279568', '9826879642', 'MBBS, Orthopaedics', 35),
(26, 'ananyasingh.26@bitsathy.ac.in', 'Dr. Ananya Singh', '123', '760623456792', '5432109874', 'MBBS, MD Clinical Chemistry', 8),
(27, 'rahuliyer.27@bitsathy.ac.in', 'Dr. Rahul Iyer', '123', '820327894565', '3210987650', 'MBBS, MD Clinical Neurophysiology', 9),
(28, 'priyareddy.28@bitsathy.ac.in', 'Dr. Priya Reddy', '123', '890712345682', '9876543214', 'MBBS, MD Clinical Neurophysiology', 9),
(29, 'vikramsharma.29@bitsathy.ac.in', 'Dr. Vikram Sharma', '123', '750623456787', '8765432105', 'MBBS, MD Clinical Neurophysiology', 9),
(30, 'nehadesai.30@bitsathy.ac.in', 'Dr. Neha Desai', '123', '912345678016', '6543210986', 'MBBS, MD Clinical Radiology', 10),
(31, 'anjali.gupta.31@bitsathy.ac.in', 'Dr. Anjali Gupta', '123', '750623456786', '8765432114', 'BDS, MDS Dental, Oral and Maxillo-facial Surgery', 11),
(32, 'vishal.singh.32@bitsathy.ac.in', 'Dr. Vishal Singh', '123', '820527894564', '7654321095', 'BDS, MDS Dental, Oral and Maxillo-facial Surgery', 11),
(33, 'karthik.patel.33@bitsathy.ac.in', 'Dr. Karthik Patel', '123', '912345678017', '6543210985', 'BDS, MDS Dental, Oral and Maxillo-facial Surgery', 11),
(34, 'smita.deshmukh.34@bitsathy.ac.in', 'Dr. Smita Deshmukh', '123', '820327894566', '5432109873', 'MBBS, MD Dermato-Venerology', 12),
(35, 'aditi.sharma.35@bitsathy.ac.in', 'Dr. Aditi Sharma', '123', '650423456793', '4321098762', 'MBBS, MD Dermato-Venerology', 12),
(36, 'pradeep.reddy.36@bitsathy.ac.in', 'Dr. Pradeep Reddy', '123', '760623456793', '3210987649', 'MBBS, MD Dermato-Venerology', 12),
(37, 'sameer.rao.37@bitsathy.ac.in', 'Dr. Sameer Rao', '123', '820327894567', '8765432115', 'MBBS, MD Dermatology', 13),
(38, 'nandiniverma.38@bitsathy.ac.in', 'Dr. Nandini Verma', '123', '890712345683', '7654321094', 'MBBS, MD Dermatology', 13),
(39, 'sangeetakapoor.39@bitsathy.ac.in', 'Dr. Sangeeta Kapoor', '123', '750523456787', '5432109872', 'MBBS, MD Dermatology', 13),
(40, 'ashok.sharma.40@bitsathy.ac.in', 'Dr. Ashok Sharma', '123', '912345678018', '4321098761', 'MBBS, MD Endocrinology', 14),
(41, 'vikramkumar.41@bitsathy.ac.in', 'Dr. Vikram Kumar', '123', '750523456786', '8765432116', 'MBBS, MD Gastro-enterologic Surgery', 15),
(42, 'snehaiyer.42@bitsathy.ac.in', 'Dr. Sneha Iyer', '123', '820423456791', '7654321093', 'MBBS, MD Gastro-enterologic Surgery', 15),
(43, 'rajeshchoudhury.43@bitsathy.ac.in', 'Dr. Rajesh Choudhury', '123', '912345678019', '5432109871', 'MBBS, MD Gastro-enterologic Surgery', 15),
(44, 'priyankadesai.44@bitsathy.ac.in', 'Dr. Priyanka Desai', '123', '890712345684', '4321098760', 'MBBS, MD Gastroenterology', 16),
(45, 'arvindsingh.45@bitsathy.ac.in', 'Dr. Arvind Singh', '123', '760623456794', '3210987648', 'MBBS, MD Gastroenterology', 16),
(46, 'nehakapoor.46@bitsathy.ac.in', 'Dr. Neha Kapoor', '123', '650423456794', '9876543215', 'MBBS, MD Gastroenterology', 16),
(47, 'ananyaiyer.47@bitsathy.ac.in', 'Dr. Ananya Iyer', '123', '820327894568', '8765432117', 'MBBS, MD General Hematology', 17),
(48, 'ravipatel.48@bitsathy.ac.in', 'Dr. Ravi Patel', '123', '750623456785', '5432109870', 'MBBS, MD General Hematology', 17),
(49, 'sunilreddy.49@bitsathy.ac.in', 'Dr. Sunil Reddy', '123', '890712345685', '4321098759', 'MBBS, MD General Hematology', 17),
(50, 'karthiksharma.50@bitsathy.ac.in', 'Dr. Karthik Sharma', '123', '760623456795', '3210987647', 'MBBS, MD General Practice', 18),
(51, 'arjunkumar.51@bitsathy.ac.in', 'Dr. Arjun Kumar', '123', '820327894569', '8765432118', 'MBBS, MS General Surgery', 19),
(52, 'meenadeshmukh.52@bitsathy.ac.in', 'Dr. Meena Deshmukh', '123', '650423456795', '5432109869', 'MBBS, MS General Surgery', 19),
(53, 'prakashsingh.53@bitsathy.ac.in', 'Dr. Prakash Singh', '123', '760623456796', '4321098758', 'MBBS, MS General Surgery', 19),
(54, 'sureshiyer.54@bitsathy.ac.in', 'Dr. Suresh Iyer', '123', '890712345686', '3210987646', 'MBBS, MD Geriatrics', 20),
(55, 'snehasharma.55@bitsathy.ac.in', 'Dr. Sneha Sharma', '123', '750523456785', '8765432119', 'MBBS, MD Geriatrics', 20),
(56, 'kavitapatel.56@bitsathy.ac.in', 'Dr. Kavita Patel', '123', '820423456792', '5432109868', 'MBBS, MD Geriatrics', 20),
(57, 'rameshsharma.57@bitsathy.ac.in', 'Dr. Ramesh Sharma', '123', '912345678020', '4321098757', 'MBBS, MD Immunology', 21),
(58, 'vidyareddy.58@bitsathy.ac.in', 'Dr. Vidya Reddy', '123', '760623456797', '3210987645', 'MBBS, MD Immunology', 21),
(59, 'pradeepkapoor.59@bitsathy.ac.in', 'Dr. Pradeep Kapoor', '123', '750623456784', '8765432120', 'MBBS, MD Immunology', 21),
(60, 'anandkhanna.60@bitsathy.ac.in', 'Dr. Anand Khanna', '123', '820327894570', '5432109867', 'MBBS, MD Infectious Diseases', 22),
(61, 'nehaverma.61@bitsathy.ac.in', 'Dr. Neha Verma', '123', '890712345687', '8765432121', 'MBBS, MD Internal Medicine', 23),
(62, 'sunilkumar.62@bitsathy.ac.in', 'Dr. Sunil Kumar', '123', '750523456784', '3210987644', 'MBBS, MD Internal Medicine', 23),
(63, 'anjalikhanna.63@bitsathy.ac.in', 'Dr. Anjali Khanna', '123', '820423456793', '5432109866', 'MBBS, MD Internal Medicine', 23),
(64, 'rahuldesai.64@bitsathy.ac.in', 'Dr. Rahul Desai', '123', '912345678021', '4321098756', 'MBBS, MD Laboratory Medicine', 24),
(65, 'meenaiyer.65@bitsathy.ac.in', 'Dr. Meena Iyer', '123', '760623456798', '8765432122', 'MBBS, MD Laboratory Medicine', 24),
(66, 'ajaypatel.66@bitsathy.ac.in', 'Dr. Ajay Patel', '123', '750623456783', '3210987643', 'MBBS, MD Laboratory Medicine', 24),
(67, 'vikramsharma.67@bitsathy.ac.in', 'Dr. Vikram Sharma', '123', '820327894571', '5432109865', 'MDS Maxillo-facial Surgery', 25),
(68, 'priyankadeshmukh.68@bitsathy.ac.in', 'Dr. Priyanka Deshmukh', '123', '890712345688', '4321098755', 'MDS Maxillo-facial Surgery', 25),
(69, 'snehaverma.69@bitsathy.ac.in', 'Dr. Sneha Verma', '123', '750523456783', '8765432123', 'MDS Maxillo-facial Surgery', 25),
(70, 'ananyareddy.70@bitsathy.ac.in', 'Dr. Ananya Reddy', '123', '912345678022', '3210987642', 'MBBS, MD Microbiology', 26),
(71, 'arvindi.71@bitsathy.ac.in', 'Dr. Arvind Iyer', '123', '820327894572', '5432109864', 'MBBS, DM Nephrology', 27),
(72, 'snehaldesai.72@bitsathy.ac.in', 'Dr. Snehal Desai', '123', '890712345689', '4321098754', 'MBBS, DM Nephrology', 27),
(73, 'priyasharma.73@bitsathy.ac.in', 'Dr. Priya Sharma', '123', '760623456799', '8765432124', 'MBBS, DM Nephrology', 27),
(74, 'pradeepsingh.74@bitsathy.ac.in', 'Dr. Pradeep Singh', '123', '912345678023', '3210987641', 'MBBS, MD Neuro-Psychiatry', 28),
(75, 'smitakhanna.75@bitsathy.ac.in', 'Dr. Smita Khanna', '123', '750523456782', '5432109863', 'MBBS, MD Neuro-Psychiatry', 28),
(76, 'rahulverma.76@bitsathy.ac.in', 'Dr. Rahul Verma', '123', '820423456794', '4321098753', 'MBBS, MD Neuro-Psychiatry', 28),
(77, 'sanjaykumar.77@bitsathy.ac.in', 'Dr. Sanjay Kumar', '123', '760623456800', '8765432125', 'MBBS, DM Neurology', 29),
(78, 'anjaliverma.78@bitsathy.ac.in', 'Dr. Anjali Verma', '123', '890712345690', '3210987640', 'MBBS, DM Neurology', 29),
(79, 'ravisharma.79@bitsathy.ac.in', 'Dr. Ravi Sharma', '123', '912345678024', '5432109862', 'MBBS, DM Neurology', 29),
(80, 'deepaiyer.80@bitsathy.ac.in', 'Dr. Deepa Iyer', '123', '750623456781', '4321098752', 'MBBS, MCh Neurosurgery', 30),
(81, 'aditikapoor.81@bitsathy.ac.in', 'Dr. Aditi Kapoor', '123', '820327894573', '8765432126', 'MBBS, MD Nuclear Medicine', 31),
(82, 'sunilreddy.82@bitsathy.ac.in', 'Dr. Sunil Reddy', '123', '890712345691', '3210987639', 'MBBS, MD Nuclear Medicine', 31),
(83, 'karthikdeshmukh.83@bitsathy.ac.in', 'Dr. Karthik Deshmukh', '123', '760623456801', '5432109861', 'MBBS, MD Nuclear Medicine', 31),
(84, 'nehasharma.84@bitsathy.ac.in', 'Dr. Neha Sharma', '123', '912345678025', '4321098751', 'MBBS, MD Obstetrics and Gynecology', 32),
(85, 'priyankaiyer.85@bitsathy.ac.in', 'Dr. Priyanka Iyer', '123', '750523456780', '8765432127', 'MBBS, MD Obstetrics and Gynecology', 32),
(86, 'sureshpatel.86@bitsathy.ac.in', 'Dr. Suresh Patel', '123', '820423456795', '3210987638', 'MBBS, MD Obstetrics and Gynecology', 32),
(87, 'rajeshkhanna.87@bitsathy.ac.in', 'Dr. Rajesh Khanna', '123', '760623456802', '5432109860', 'MBBS, MD Occupational Medicine', 33),
(88, 'snehalsharma.88@bitsathy.ac.in', 'Dr. Snehal Sharma', '123', '890712345692', '4321098750', 'MBBS, MD Occupational Medicine', 33),
(89, 'anjalidesai.89@bitsathy.ac.in', 'Dr. Anjali Desai', '123', '912345678026', '8765432128', 'MBBS, MD Occupational Medicine', 33),
(90, 'karthikkumar.90@bitsathy.ac.in', 'Dr. Karthik Kumar', '123', '750623456779', '3210987637', 'MBBS, MS Ophthalmology', 34),
(91, 'prakashsingh.91@bitsathy.ac.in', 'Dr. Prakash Singh', '123', '820327894574', '8765432129', 'MBBS, MS Orthopaedics', 35),
(92, 'priyakapoor.92@bitsathy.ac.in', 'Dr. Priya Kapoor', '123', '890712345693', '4321098749', 'MBBS, MS Orthopaedics', 35),
(93, 'anjalikhanna.93@bitsathy.ac.in', 'Dr. Anjali Khanna', '123', '760623456803', '3210987636', 'MBBS, MS Orthopaedics', 35),
(94, 'snehaiyer.94@bitsathy.ac.in', 'Dr. Sneha Iyer', '123', '912345678027', '5432109859', 'MBBS, MS Otorhinolaryngology (ENT)', 36),
(95, 'arvindsharma.95@bitsathy.ac.in', 'Dr. Arvind Sharma', '123', '750523456778', '8765432130', 'MBBS, MS Otorhinolaryngology (ENT)', 36),
(96, 'rahulpatel.96@bitsathy.ac.in', 'Dr. Rahul Patel', '123', '820423456796', '4321098748', 'MBBS, MS Otorhinolaryngology (ENT)', 36),
(97, 'vikramkhanna.97@bitsathy.ac.in', 'Dr. Vikram Khanna', '123', '760623456804', '3210987635', 'MBBS, MCh Paediatric Surgery', 37),
(98, 'priyankareddy.98@bitsathy.ac.in', 'Dr. Priyanka Reddy', '123', '890712345694', '5432109858', 'MBBS, MCh Paediatric Surgery', 37),
(99, 'meenakapoor.99@bitsathy.ac.in', 'Dr. Meena Kapoor', '123', '912345678028', '8765432131', 'MBBS, MCh Paediatric Surgery', 37),
(100, 'sunilkumar.100@bitsathy.ac.in', 'Dr. Sunil Kumar', '123', '750623456777', '4321098747', 'MBBS, MD Paediatrics', 38),
(101, 'pradeepsharma.101@bitsathy.ac.in', 'Dr. Pradeep Sharma', '123', '820327894575', '8765432132', 'MBBS, MD Pathology', 39),
(102, 'priyakapoor.102@bitsathy.ac.in', 'Dr. Priya Kapoor', '123', '890712345695', '3210987634', 'MBBS, MD Pathology', 39),
(103, 'smitapatel.103@bitsathy.ac.in', 'Dr. Smita Patel', '123', '760623456805', '5432109857', 'MBBS, MD Pathology', 39),
(104, 'ananyakhanna.104@bitsathy.ac.in', 'Dr. Ananya Khanna', '123', '912345678029', '4321098746', 'MBBS, MD Pharmacology', 40),
(105, 'ravikumar.105@bitsathy.ac.in', 'Dr. Ravi Kumar', '123', '750523456776', '8765432133', 'MBBS, MD Pharmacology', 40),
(106, 'karthikreddy.106@bitsathy.ac.in', 'Dr. Karthik Reddy', '123', '820423456797', '3210987633', 'MBBS, MD Pharmacology', 40),
(107, 'sureshsharma.107@bitsathy.ac.in', 'Dr. Suresh Sharma', '123', '760623456806', '5432109856', 'MBBS, MD Physical Medicine and Rehabilitation', 41),
(108, 'meenaiyer.108@bitsathy.ac.in', 'Dr. Meena Iyer', '123', '890712345696', '4321098745', 'MBBS, MD Physical Medicine and Rehabilitation', 41),
(109, 'prakashverma.109@bitsathy.ac.in', 'Dr. Prakash Verma', '123', '912345678030', '8765432134', 'MBBS, MD Physical Medicine and Rehabilitation', 41),
(110, 'nehakhurana.110@bitsathy.ac.in', 'Dr. Neha Khurana', '123', '820327894576', '3210987632', 'MBBS, MCh Plastic Surgery', 42),
(111, 'snehaldesai.111@bitsathy.ac.in', 'Dr. Snehal Desai', '123', '760623456807', '5432109855', 'MBBS, MD Podiatric Medicine', 43),
(112, 'priyaiyer.112@bitsathy.ac.in', 'Dr. Priya Iyer', '123', '890712345697', '4321098744', 'MBBS, MD Podiatric Medicine', 43),
(113, 'vikramkhanna.113@bitsathy.ac.in', 'Dr. Vikram Khanna', '123', '912345678031', '8765432135', 'MBBS, MD Podiatric Medicine', 43),
(114, 'arvindpatel.114@bitsathy.ac.in', 'Dr. Arvind Patel', '123', '820423456798', '3210987631', 'MBBS, MS Podiatric Surgery', 44),
(115, 'priyankareddy.115@bitsathy.ac.in', 'Dr. Priyanka Reddy', '123', '750523456775', '5432109854', 'MBBS, MS Podiatric Surgery', 44),
(116, 'sunilkumar.116@bitsathy.ac.in', 'Dr. Sunil Kumar', '123', '760623456808', '4321098743', 'MBBS, MS Podiatric Surgery', 44),
(117, 'snehasharma.117@bitsathy.ac.in', 'Dr. Sneha Sharma', '123', '890712345698', '8765432136', 'MBBS, MD Psychiatry', 45),
(118, 'karthikverma.118@bitsathy.ac.in', 'Dr. Karthik Verma', '123', '912345678032', '3210987630', 'MBBS, MD Psychiatry', 45),
(119, 'anjalisingh.119@bitsathy.ac.in', 'Dr. Anjali Singh', '123', '820327894577', '5432109853', 'MBBS, MD Psychiatry', 45),
(120, 'priyasharma.120@bitsathy.ac.in', 'Dr. Priya Sharma', '123', '760623456809', '4321098742', 'MBBS, MD Public Health and Preventive Medicine', 46),
(121, 'sunilverma.121@bitsathy.ac.in', 'Dr. Sunil Verma', '123', '890712345699', '8765432137', 'MBBS, MD Radiology', 47),
(122, 'snehaldeshmukh.122@bitsathy.ac.in', 'Dr. Snehal Deshmukh', '123', '912345678033', '3210987629', 'MBBS, MD Radiology', 47),
(123, 'arvindkhanna.123@bitsathy.ac.in', 'Dr. Arvind Khanna', '123', '820423456799', '5432109852', 'MBBS, MD Radiology', 47),
(124, 'vidyakhurana.124@bitsathy.ac.in', 'Dr. Vidya Khurana', '123', '760623456810', '4321098741', 'MBBS, MD Radiotherapy', 48),
(125, 'karthikiyer.125@bitsathy.ac.in', 'Dr. Karthik Iyer', '123', '890712345700', '8765432138', 'MBBS, MD Radiotherapy', 48),
(126, 'priyankapatel.126@bitsathy.ac.in', 'Dr. Priyanka Patel', '123', '912345678034', '3210987628', 'MBBS, MD Radiotherapy', 48),
(127, 'arvindreddy.127@bitsathy.ac.in', 'Dr. Arvind Reddy', '123', '820327894578', '5432109851', 'MBBS, MD Respiratory Medicine', 49),
(128, 'nehasharma.128@bitsathy.ac.in', 'Dr. Neha Sharma', '123', '760623456811', '4321098740', 'MBBS, MD Respiratory Medicine', 49),
(129, 'sureshverma.129@bitsathy.ac.in', 'Dr. Suresh Verma', '123', '890712345701', '8765432139', 'MBBS, MD Respiratory Medicine', 49),
(130, 'pradeepsingh.130@bitsathy.ac.in', 'Dr. Pradeep Singh', '123', '912345678035', '3210987627', 'MBBS, MD Rheumatology', 50),
(131, 'priyakhurana.131@bitsathy.ac.in', 'Dr. Priya Khurana', '123', '820327894579', '5432109850', 'MBBS, MDS Stomatology', 51),
(132, 'rahuliyer.132@bitsathy.ac.in', 'Dr. Rahul Iyer', '123', '760623456812', '4321098739', 'MBBS, MDS Stomatology', 51),
(133, 'anjali_patel.133@bitsathy.ac.in', 'Dr. Anjali Patel', '123', '890712345702', '8765432140', 'MBBS, MDS Stomatology', 51),
(134, 'snehalsharma.134@bitsathy.ac.in', 'Dr. Snehal Sharma', '123', '912345678036', '3210987626', 'MBBS, MCh Thoracic Surgery', 52),
(135, 'arvindkhanna.135@bitsathy.ac.in', 'Dr. Arvind Khanna', '123', '820423456800', '5432109849', 'MBBS, MCh Thoracic Surgery', 52),
(136, 'pradeepverma.136@bitsathy.ac.in', 'Dr. Pradeep Verma', '123', '760623456813', '4321098738', 'MBBS, MCh Thoracic Surgery', 52),
(137, 'sunilpatel.137@bitsathy.ac.in', 'Dr. Sunil Patel', '123', '890712345703', '8765432141', 'MBBS, MD Tropical Medicine', 53),
(138, 'nehaiyer.138@bitsathy.ac.in', 'Dr. Neha Iyer', '123', '912345678037', '3210987625', 'MBBS, MD Tropical Medicine', 53),
(139, 'karthiksharma.139@bitsathy.ac.in', 'Dr. Karthik Sharma', '123', '820327894580', '5432109848', 'MBBS, MD Tropical Medicine', 53),
(140, 'anjali_khurana.140@bitsathy.ac.in', 'Dr. Anjali Khurana', '123', '760623456814', '4321098737', 'MBBS, MS Urology', 54),
(141, 'vikram_patel.141@bitsathy.ac.in', 'Dr. Vikram Patel', '123', '890712345704', '8765432142', 'MBBS, MS Vascular Surgery', 55),
(142, 'priyanka_verma.142@bitsathy.ac.in', 'Dr. Priyanka Verma', '123', '912345678038', '3210987624', 'MBBS, MS Vascular Surgery', 55),
(143, 'sunil_iyer.143@bitsathy.ac.in', 'Dr. Sunil Iyer', '123', '820423456801', '5432109847', 'MBBS, MS Vascular Surgery', 55),
(144, 'snehal_khanna.144@bitsathy.ac.in', 'Dr. Snehal Khanna', '123', '760623456815', '4321098736', 'MBBS, MD Venereology', 56),
(145, 'prakash_reddy.145@bitsathy.ac.in', 'Dr. Prakash Reddy', '123', '890712345705', '8765432143', 'MBBS, MD Venereology', 56),
(146, 'neha_kapoor.146@bitsathy.ac.in', 'Dr. Neha Kapoor', '123', '912345678039', '3210987623', 'MBBS, MD Venereology', 56),
(147, 'arvind_sharma.147@bitsathy.ac.in', 'Dr. Arvind Sharma', '123', '820327894581', '5432109846', 'MBBS, General Practitioner', 57),
(148, 'sneha_patel.148@bitsathy.ac.in', 'Dr. Sneha Patel', '123', '760623456816', '4321098735', 'MBBS, General Practitioner', 57),
(149, 'karthik_khurana.149@bitsathy.ac.in', 'Dr. Karthik Khurana', '123', '890712345706', '8765432144', 'MBBS, General Practitioner', 57),
(150, 'manoj_agrawal.150@bitsathy.ac.in', 'Dr. Manoj Agrawal', '123', '912345678040', '3210987622', 'MBBS, General Practitioner', 57),
(25, 'ajaykapoor.25@bitsathy.ac.in', 'Dr. Ajay Kapoor', '123', '650423456792', '8765432113', 'MBBS, MD Clinical Chemistry', 8),
(24, 'kavitaverma.24@bitsathy.ac.in', 'Dr. Kavita Verma', '123', '912345678015', '3210987651', 'MBBS, MD Clinical Chemistry', 8),
(23, 'ravikhanna.23@bitsathy.ac.in', 'Dr. Ravi Khanna', '123', '820423456789', '5432109875', 'MBBS, MD Clinical Biology', 7),
(22, 'vidyao.22@bitsathy.ac.in', 'Dr. Vidya Rao', '123', '750523456789', '8765432106', 'MBBS, MD Clinical Biology', 7),
(21, 'sanjaypatel.21@bitsathy.ac.in', 'Dr. Sanjay Patel', '123', '890712345681', '9876543213', 'MBBS, MD Clinical Biology', 7),
(20, 'shreyasharma.20@bitsathy.ac.in', 'Dr. Shreya Sharma', '123', '820327894564', '9876543212', 'MBBS, MD Child Psychiatry', 6),
(19, 'arjunreddy.19@bitsathy.ac.in', 'Dr. Arjun Reddy', '123', '760623456791', '3210987652', 'MBBS, MD Child Psychiatry', 6),
(18, 'priyamenon.18@bitsathy.ac.in', 'Dr. Priya Menon', '123', '650423456791', '4321098763', 'MBBS, MD Child Psychiatry', 6),
(17, 'aditiverma.17@bitsathy.ac.in', 'Dr. Aditi Verma', '123', '820423456788', '5432109876', 'MBBS, MD Cardiology', 5),
(16, 'rajeshkumar.16@bitsathy.ac.in', 'Dr. Rajesh Kumar', '123', '750523456788', '8765432107', 'MBBS, MD Cardiology', 5),
(15, 'aishwaryagupta.15@bitsathy.ac.in', 'Dr. Aishwarya Gupta', '123', '890712345680', '9876543211', 'MBBS, MD Cardiology', 5),
(14, 'sunilsharma.14@bitsathy.ac.in', 'Dr. Sunil Sharma', '123', '760623456790', '3210987653', 'MBBS, MD Biological Hematology', 4),
(13, 'meenasingh.13@bitsathy.ac.in', 'Dr. Meena Singh', '123', '650423456790', '4321098764', 'MBBS, MD Biological Hematology', 4),
(12, 'rameshrao.12@bitsathy.ac.in', 'Dr. Ramesh Rao', '123', '820327894563', '5432109877', 'MBBS, MD Biological Hematology', 4),
(11, 'karthikchoudhury.11@bitsathy.ac.in', 'Dr. Karthik Choudhury', '123', '912345678014', '6543210985', 'MBBS, MD Anaesthetics', 3),
(10, 'snehalpatel.10@bitsathy.ac.in', 'Dr. Snehal Patel', '123', '820527894560', '7654321096', 'MBBS, MD Anaesthetics', 3),
(9, 'prakashiyer.9@bitsathy.ac.in', 'Dr. Prakash Iyer', '123', '750623456788', '8765432108', 'MBBS, MD Anaesthetics', 3),
(8, 'snehakapoor.8@bitsathy.ac.in', 'Dr. Sneha Kapoor', '123', '912345678013', '6543210986', 'MBBS, MD Allergology', 2),
(7, 'sureshvenkat.7@bitsathy.ac.in', 'Dr. Suresh Venkat', '123', '820527894562', '7654321097', 'MBBS, MD Allergology', 2),
(6, 'anjalidesai.6@bitsathy.ac.in', 'Dr. Anjali Desai', '123', '750623456789', '8765432109', 'MBBS, MD Allergology', 2),
(5, 'deepasharma.5@bitsathy.ac.in', 'Dr. Deepa Sharma', '123', '912345678012', '6543210987', 'MBBS, MD Accident and Emergency Medicine', 1),
(4, 'arvindreddy.4@bitsathy.ac.in', 'Dr. Arvind Reddy', '123', '820527894561', '7654321098', 'MBBS, MD Accident and Emergency Medicine', 1),
(3, 'rajeshkumar.3@bitsathy.ac.in', 'Dr. Rajesh Kumar', '123', '890712345678', '9876543210', 'MBBS, MD Accident and Emergency Medicine', 1);

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
  `lemail` varchar(220) DEFAULT NULL,
  `lname` varchar(220) DEFAULT NULL,
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
(1, 'medical-test', 1000, '../img/tions/1.png'),
(2, 'endoscopy', 3500, '../img/tions/2.png'),
(3, 'blood-test', 650, '../img/tions/3.png'),
(4, 'pathology', 1000, '../img/tions/4.png'),
(5, 'physical-examination', 750, '../img/tions/5.png'),
(6, 'c-reactive-protein-test', 550, '../img/tions/6.png'),
(7, 'nuclear-medicine', 5500, '../img/tions/7.png'),
(8, 'platelet-count', 350, '../img/tions/8.png'),
(9, 'capsule-endoscopy', 6500, '../img/tions/9.png'),
(10, 'white-blod-cell-count', 350, '../img/tions/10.png'),
(11, 'electrolytes-test', 550, '../img/tions/11.jpg'),
(12, 'mri', 5500, '../img/tions/12.png'),
(13, 'pap-test', 1000, '../img/tions/13.png'),
(14, 'lipase-test', 550, '../img/tions/14.jpg'),
(15, 'vitamin-b12-folate-test', 1000, '../img/tions/15.png'),
(16, 'lpa-test', 550, '../img/tions/16.png'),
(17, 'lithium-test', 550, '../img/tions/17.png'),
(18, 'biopsy', 2000, '../img/tions/18.png'),
(19, 'creatinine-clearance-test', 550, '../img/tions/19.jpeg'),
(20, 'kidney-function-test', 550, '../img/tions/20.png'),
(21, 'd-dimer-test', 550, '../img/tions/21.jpeg'),
(22, 'radiology', 400, '../img/tions/22.png'),
(23, 'ast-test', 550, '../img/tions/23.png'),
(24, 'coronary-catheterixation', 7500, '../img/tions/24.jpg'),
(25, 'liver-function-test', 550, '../img/tions/25.png'),
(26, 'ferritin-test', 550, '../img/tions/26.jpeg'),
(27, 'albimin-test', 550, '../img/tions/27.jpeg'),
(28, 'aso-test', 550, '../img/tions/28.jpeg'),
(29, 'hla-b27-test', 550, '../img/tions/29.jpeg'),
(30, 'adenosine-deaminase', 1000, '../img/tions/30.png'),
(31, 'g6pd-test', 550, '../img/tions/31.png'),
(32, 'quantative-immunoglobulins-test', 550, '../img/tions/32.jpeg'),
(33, 'bilirubin-test', 550, '../img/tions/33.png'),
(34, 'soduim-test', 350, '../img/tions/34.png'),
(35, 'c-peptide-test', 550, '../img/tions/35.png'),
(36, 'cd4-and-cd8-test', 550, '../img/tions/36.jpeg'),
(37, 'skin-allergy-test', 2000, '../img/tions/37.png'),
(38, 'hearing-test', 1000, '../img/tions/38.png'),
(39, 'semen-analysis', 1000, '../img/tions/49.png'),
(40, 'complete-blood-count', 350, '../img/tions/40.png'),
(41, 'calcium-test', 550, '../img/tions/41.png'),
(42, 'aldolase-test', 550, '../img/tions/42.png'),
(43, 'thyroid-antibodies-test', 550, '../img/tions/43.png'),
(44, 'thyroglobulin-test', 550, '../img/tions/44.jpeg'),
(45, 'sex-hormone-test', 1000, '../img/tions/45.png'),
(46, 'ultrasonography', 2000, '../img/tions/46.png'),
(47, 'alt-test', 550, '../img/tions/47.png'),
(48, 'uric-acid-test', 550, '../img/tions/48.png'),
(49, 'amylase-test', 550, '../img/tions/50.jpeg'),
(50, 'videonystagmography', 3500, '../img/tions/39.png');

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
  `pemail` varchar(220) DEFAULT NULL,
  `pname` varchar(220) DEFAULT NULL,
  `ppassword` varchar(220) DEFAULT NULL,
  `paddress` varchar(220) DEFAULT NULL,
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
(1, 1, 1, NULL, '75.00', '25.00', 'general-practice', 'pay_MXQEwuf4Vd1Gz7', '75.00', '2023-09-02 15:15:57', 1),
(2, 1, NULL, 1, '592.50', '12.50', 'alt-test', 'pay_MYWSqdSrLpuiix', '2646.35', '2023-09-02 15:23:16', 3),
(34, 1, NULL, 428, '605.00', '0.00', 'albimin-test', 'pay_MYh7ijnTgWCsvY', '1310.00', '2023-09-05 20:25:45', 3),
(35, 1, NULL, 429, '705.00', '0.00', 'blood-test', 'pay_MYh7ijnTgWCsvY', '1310.00', '2023-09-05 20:25:45', 3),
(37, 1, 3, NULL, '97.50', '2.50', 'general-practice', 'pay_MZoC1EH49TqFIy', NULL, '2023-09-08 15:59:42', 1),
(38, 1, 4, NULL, '97.50', '2.50', 'general-practice', 'pay_Ma6JVwEq9sB7OP', NULL, '2023-09-09 09:43:20', 1);

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
  `prescription` varbinary(220) DEFAULT '0',
  `report` varbinary(220) DEFAULT '0',
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
  `docid` varchar(220) DEFAULT NULL,
  `title` varchar(220) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int DEFAULT NULL,
  `mode` varchar(45) DEFAULT NULL,
  `mail_flag` int NOT NULL DEFAULT '0',
  `leave_status` int DEFAULT '0',
  `leave_reason` varchar(220) DEFAULT NULL,
  PRIMARY KEY (`scheduleid`),
  KEY `docid` (`docid`)
) ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`, `mode`, `mail_flag`, `leave_status`, `leave_reason`) VALUES
(1, '1', 'general-practice', '2023-09-09', '17:10:00', 8, 'Hospital Visit', 0, 0, NULL),
(2, '1', 'general-practice', '2023-09-13', '10:30:00', 12, 'Hospital Visit', 0, 0, NULL),
(3, '1', 'general-practice', '2023-09-11', '09:15:00', 7, 'Hospital Visit', 0, 0, NULL),
(4, '1', 'general-practice', '2023-09-10', '19:15:00', 5, 'Video Consultancy', 0, 0, NULL),
(5, '2', 'general-practice', '2023-09-12', '17:30:00', 14, 'Hospital Visit', 0, 0, NULL);

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
(1, 'accident-and-emergency-medicine', '../img/sicon/1.png'),
(2, 'allergology', '../img/sicon/2.png'),
(3, 'anaesthetics', '../img/sicon/3.png'),
(4, 'biological-hematology', '../img/sicon/4.png'),
(5, 'cardiology', '../img/sicon/5.png'),
(6, 'child-psychiatry', '../img/sicon/6.png'),
(7, 'clinical-biology', '../img/sicon/7.png'),
(8, 'clinical-chemistry', '../img/sicon/8.png'),
(9, 'clinical-neurophysiology', '../img/sicon/9.png'),
(10, 'clinical-radiology', '../img/sicon/10.png'),
(11, 'dental-oral-and-maxillo-facial-surgery', '../img/sicon/11.png'),
(12, 'dermato-venerology', '../img/sicon/12.png'),
(13, 'dermatology', '../img/sicon/13.png'),
(14, 'endocrinology', '../img/sicon/14.png'),
(15, 'gastro-enterologic-surgery', '../img/sicon/15.png'),
(16, 'gastroenterology', '../img/sicon/16.png'),
(17, 'general-hematology', '../img/sicon/17.png'),
(18, 'general-practice', '../img/sicon/18.png'),
(19, 'general-surgery', '../img/sicon/19.png'),
(20, 'geriatrics', '../img/sicon/20.png'),
(21, 'immunology', '../img/sicon/21.png'),
(22, 'infectious-diseases', '../img/sicon/22.png'),
(23, 'internal-medicine', '../img/sicon/23.png'),
(24, 'laboratory-medicine', '../img/sicon/24.png'),
(25, 'maxillo-facial-surgery', '../img/sicon/25.png'),
(26, 'microbiology', '../img/sicon/26.png'),
(27, 'nephrology', '../img/sicon/27.png'),
(28, 'neuro-psychiatry', '../img/sicon/28.png'),
(29, 'neurology', '../img/sicon/29.png'),
(30, 'neurosurgery', '../img/sicon/30.png'),
(31, 'nuclear-medicine', '../img/sicon/31.png'),
(32, 'obstetrics-and-gynecology', '../img/sicon/32.png'),
(33, 'occupational-medicine', '../img/sicon/33.png'),
(34, 'ophthalmology', '../img/sicon/34.png'),
(35, 'orthopaedics', '../img/sicon/35.png'),
(36, 'otorhinolaryngology', '../img/sicon/36.png'),
(37, 'paediatric-surgery', '../img/sicon/37.png'),
(38, 'paediatrics', '../img/sicon/38.png'),
(39, 'pathology', '../img/sicon/39.png'),
(40, 'pharmacology', '../img/sicon/40.png'),
(41, 'physical-medicine-and-rehabilitation', '../img/sicon/41.png'),
(42, 'plastic-surgery', '../img/sicon/42.png'),
(43, 'podiatric-medicine', '../img/sicon/43.png'),
(44, 'podiatric-surgery', '../img/sicon/44.png'),
(45, 'psychiatry', '../img/sicon/45.png'),
(46, 'public-health-and-preventive-medicine', '../img/sicon/46.png'),
(47, 'radiology', '../img/sicon/47.png'),
(48, 'radiotherapy', '../img/sicon/48.png'),
(49, 'respiratory-medicine', '../img/sicon/49.png'),
(50, 'rheumatology', '../img/sicon/50.png'),
(51, 'stomatology', '../img/sicon/51.png'),
(52, 'thoracic-surgery', '../img/sicon/52.png'),
(53, 'tropical-medicine', '../img/sicon/53.png'),
(54, 'urology', '../img/sicon/54.png'),
(55, 'vascular-surgery', '../img/sicon/55.png'),
(56, 'venereology', '../img/sicon/56.png'),
(57, 'general-op', '../img/sicon/57.png');

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
);

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
  `file_name` varbinary(220) DEFAULT NULL,
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
(1, '2.50', '226.55'),
(3, '0.00', '0.00'),
(4, '0.00', '0.00'),
(9, '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(220) NOT NULL,
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
('saaivignesh.cs21@bitsathy.ac.in', 'p'),
('rajeshkumar.3@bitsathy.ac.in', 'd'),
('arvindreddy.4@bitsathy.ac.in', 'd'),
('deepasharma.5@bitsathy.ac.in', 'd'),
('anjalidesai.6@bitsathy.ac.in', 'd'),
('sureshvenkat.7@bitsathy.ac.in', 'd'),
('snehakapoor.8@bitsathy.ac.in', 'd'),
('prakashiyer.9@bitsathy.ac.in', 'd'),
('snehalpatel.10@bitsathy.ac.in', 'd'),
('karthikchoudhury.11@bitsathy.ac.in', 'd'),
('rameshrao.12@bitsathy.ac.in', 'd'),
('meenasingh.13@bitsathy.ac.in', 'd'),
('sunilsharma.14@bitsathy.ac.in', 'd'),
('aishwaryagupta.15@bitsathy.ac.in', 'd'),
('rajeshkumar.16@bitsathy.ac.in', 'd'),
('aditiverma.17@bitsathy.ac.in', 'd'),
('priyamenon.18@bitsathy.ac.in', 'd'),
('arjunreddy.19@bitsathy.ac.in', 'd'),
('shreyasharma.20@bitsathy.ac.in', 'd'),
('sanjaypatel.21@bitsathy.ac.in', 'd'),
('vidyao.22@bitsathy.ac.in', 'd'),
('ravikhanna.23@bitsathy.ac.in', 'd'),
('kavitaverma.24@bitsathy.ac.in', 'd'),
('ajaykapoor.25@bitsathy.ac.in', 'd'),
('ananyasingh.26@bitsathy.ac.in', 'd'),
('rahuliyer.27@bitsathy.ac.in', 'd'),
('priyareddy.28@bitsathy.ac.in', 'd'),
('vikramsharma.29@bitsathy.ac.in', 'd'),
('nehadesai.30@bitsathy.ac.in', 'd'),
('anjali.gupta.31@bitsathy.ac.in', 'd'),
('vishal.singh.32@bitsathy.ac.in', 'd'),
('karthik.patel.33@bitsathy.ac.in', 'd'),
('smita.deshmukh.34@bitsathy.ac.in', 'd'),
('aditi.sharma.35@bitsathy.ac.in', 'd'),
('pradeep.reddy.36@bitsathy.ac.in', 'd'),
('sameer.rao.37@bitsathy.ac.in', 'd'),
('nandiniverma.38@bitsathy.ac.in', 'd'),
('sangeetakapoor.39@bitsathy.ac.in', 'd'),
('ashok.sharma.40@bitsathy.ac.in', 'd'),
('vikramkumar.41@bitsathy.ac.in', 'd'),
('snehaiyer.42@bitsathy.ac.in', 'd'),
('rajeshchoudhury.43@bitsathy.ac.in', 'd'),
('priyankadesai.44@bitsathy.ac.in', 'd'),
('arvindsingh.45@bitsathy.ac.in', 'd'),
('nehakapoor.46@bitsathy.ac.in', 'd'),
('ananyaiyer.47@bitsathy.ac.in', 'd'),
('ravipatel.48@bitsathy.ac.in', 'd'),
('sunilreddy.49@bitsathy.ac.in', 'd'),
('karthiksharma.50@bitsathy.ac.in', 'd'),
('arjunkumar.51@bitsathy.ac.in', 'd'),
('meenadeshmukh.52@bitsathy.ac.in', 'd'),
('prakashsingh.53@bitsathy.ac.in', 'd'),
('sureshiyer.54@bitsathy.ac.in', 'd'),
('snehasharma.55@bitsathy.ac.in', 'd'),
('kavitapatel.56@bitsathy.ac.in', 'd'),
('rameshsharma.57@bitsathy.ac.in', 'd'),
('vidyareddy.58@bitsathy.ac.in', 'd'),
('pradeepkapoor.59@bitsathy.ac.in', 'd'),
('anandkhanna.60@bitsathy.ac.in', 'd'),
('nehaverma.61@bitsathy.ac.in', 'd'),
('sunilkumar.62@bitsathy.ac.in', 'd'),
('anjalikhanna.63@bitsathy.ac.in', 'd'),
('rahuldesai.64@bitsathy.ac.in', 'd'),
('meenaiyer.65@bitsathy.ac.in', 'd'),
('ajaypatel.66@bitsathy.ac.in', 'd'),
('vikramsharma.67@bitsathy.ac.in', 'd'),
('priyankadeshmukh.68@bitsathy.ac.in', 'd'),
('snehaverma.69@bitsathy.ac.in', 'd'),
('ananyareddy.70@bitsathy.ac.in', 'd'),
('arvindi.71@bitsathy.ac.in', 'd'),
('snehaldesai.72@bitsathy.ac.in', 'd'),
('priyasharma.73@bitsathy.ac.in', 'd'),
('pradeepsingh.74@bitsathy.ac.in', 'd'),
('smitakhanna.75@bitsathy.ac.in', 'd'),
('rahulverma.76@bitsathy.ac.in', 'd'),
('sanjaykumar.77@bitsathy.ac.in', 'd'),
('anjaliverma.78@bitsathy.ac.in', 'd'),
('ravisharma.79@bitsathy.ac.in', 'd'),
('deepaiyer.80@bitsathy.ac.in', 'd'),
('aditikapoor.81@bitsathy.ac.in', 'd'),
('sunilreddy.82@bitsathy.ac.in', 'd'),
('karthikdeshmukh.83@bitsathy.ac.in', 'd'),
('nehasharma.84@bitsathy.ac.in', 'd'),
('priyankaiyer.85@bitsathy.ac.in', 'd'),
('sureshpatel.86@bitsathy.ac.in', 'd'),
('rajeshkhanna.87@bitsathy.ac.in', 'd'),
('snehalsharma.88@bitsathy.ac.in', 'd'),
('anjalidesai.89@bitsathy.ac.in', 'd'),
('karthikkumar.90@bitsathy.ac.in', 'd'),
('prakashsingh.91@bitsathy.ac.in', 'd'),
('priyakapoor.92@bitsathy.ac.in', 'd'),
('anjalikhanna.93@bitsathy.ac.in', 'd'),
('snehaiyer.94@bitsathy.ac.in', 'd'),
('arvindsharma.95@bitsathy.ac.in', 'd'),
('rahulpatel.96@bitsathy.ac.in', 'd'),
('vikramkhanna.97@bitsathy.ac.in', 'd'),
('priyankareddy.98@bitsathy.ac.in', 'd'),
('meenakapoor.99@bitsathy.ac.in', 'd'),
('sunilkumar.100@bitsathy.ac.in', 'd'),
('pradeepsharma.101@bitsathy.ac.in', 'd'),
('priyakapoor.102@bitsathy.ac.in', 'd'),
('smitapatel.103@bitsathy.ac.in', 'd'),
('ananyakhanna.104@bitsathy.ac.in', 'd'),
('ravikumar.105@bitsathy.ac.in', 'd'),
('karthikreddy.106@bitsathy.ac.in', 'd'),
('sureshsharma.107@bitsathy.ac.in', 'd'),
('meenaiyer.108@bitsathy.ac.in', 'd'),
('prakashverma.109@bitsathy.ac.in', 'd'),
('nehakhurana.110@bitsathy.ac.in', 'd'),
('snehaldesai.111@bitsathy.ac.in', 'd'),
('priyaiyer.112@bitsathy.ac.in', 'd'),
('vikramkhanna.113@bitsathy.ac.in', 'd'),
('arvindpatel.114@bitsathy.ac.in', 'd'),
('priyankareddy.115@bitsathy.ac.in', 'd'),
('sunilkumar.116@bitsathy.ac.in', 'd'),
('snehasharma.117@bitsathy.ac.in', 'd'),
('karthikverma.118@bitsathy.ac.in', 'd'),
('anjalisingh.119@bitsathy.ac.in', 'd'),
('priyasharma.120@bitsathy.ac.in', 'd'),
('sunilverma.121@bitsathy.ac.in', 'd'),
('snehaldeshmukh.122@bitsathy.ac.in', 'd'),
('arvindkhanna.123@bitsathy.ac.in', 'd'),
('vidyakhurana.124@bitsathy.ac.in', 'd'),
('karthikiyer.125@bitsathy.ac.in', 'd'),
('priyankapatel.126@bitsathy.ac.in', 'd'),
('arvindreddy.127@bitsathy.ac.in', 'd'),
('nehasharma.128@bitsathy.ac.in', 'd'),
('sureshverma.129@bitsathy.ac.in', 'd'),
('pradeepsingh.130@bitsathy.ac.in', 'd'),
('priyakhurana.131@bitsathy.ac.in', 'd'),
('rahuliyer.132@bitsathy.ac.in', 'd'),
('anjali_patel.133@bitsathy.ac.in', 'd'),
('snehalsharma.134@bitsathy.ac.in', 'd'),
('arvindkhanna.135@bitsathy.ac.in', 'd'),
('pradeepverma.136@bitsathy.ac.in', 'd'),
('sunilpatel.137@bitsathy.ac.in', 'd'),
('nehaiyer.138@bitsathy.ac.in', 'd'),
('karthiksharma.139@bitsathy.ac.in', 'd'),
('anjali_khurana.140@bitsathy.ac.in', 'd'),
('vikram_patel.141@bitsathy.ac.in', 'd'),
('priyanka_verma.142@bitsathy.ac.in', 'd'),
('sunil_iyer.143@bitsathy.ac.in', 'd'),
('snehal_khanna.144@bitsathy.ac.in', 'd'),
('prakash_reddy.145@bitsathy.ac.in', 'd'),
('neha_kapoor.146@bitsathy.ac.in', 'd'),
('arvind_sharma.147@bitsathy.ac.in', 'd'),
('sneha_patel.148@bitsathy.ac.in', 'd'),
('karthik_khurana.149@bitsathy.ac.in', 'd'),
('manoj_agrawal.150@bitsathy.ac.in', 'd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
