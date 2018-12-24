-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2018 at 03:01 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nforms`
--

-- --------------------------------------------------------

--
-- Table structure for table `fm_forms`
--

DROP TABLE IF EXISTS `fm_forms`;
CREATE TABLE IF NOT EXISTS `fm_forms` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` text COLLATE utf8_unicode_ci NOT NULL,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fm_forms`
--

INSERT INTO `fm_forms` (`Id`, `Title`, `Created`) VALUES
(90, '\n                        \n                        Rammohana rao', '2018-12-20 08:26:40'),
(89, 'New Form title', '2018-12-20 07:24:05'),
(87, '\n                        \n                        \n                        \n                        \n                        Emmployment form&nbsp;                                                                                                    ', '2018-12-20 06:59:40'),
(86, 'Biodata form', '2018-12-19 08:27:07'),
(88, 'personal details', '2018-12-20 07:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `fm_options`
--

DROP TABLE IF EXISTS `fm_options`;
CREATE TABLE IF NOT EXISTS `fm_options` (
  `OptionId` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionId` int(11) NOT NULL,
  `QOption` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`OptionId`),
  KEY `fm_options_fk` (`QuestionId`)
) ENGINE=MyISAM AUTO_INCREMENT=254 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fm_options`
--

INSERT INTO `fm_options` (`OptionId`, `QuestionId`, `QOption`) VALUES
(253, 203, 'ce4gtv'),
(252, 203, 'acxrew'),
(251, 203, 'adsax'),
(250, 202, 'erfc'),
(185, 175, 'Chemistry'),
(184, 175, 'Physics'),
(183, 175, 'Maths'),
(182, 174, 'PHD'),
(181, 174, 'PG'),
(180, 174, 'UG'),
(235, 196, 'PG'),
(234, 196, 'UG'),
(179, 174, '10+2'),
(233, 196, '10+2'),
(232, 195, '5'),
(231, 195, '4'),
(230, 195, '2'),
(229, 195, '3'),
(178, 173, '>70'),
(177, 173, '<70'),
(176, 173, '<50'),
(175, 173, '<20'),
(249, 202, 'asdew'),
(248, 202, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `fm_questions`
--

DROP TABLE IF EXISTS `fm_questions`;
CREATE TABLE IF NOT EXISTS `fm_questions` (
  `QuestionId` int(11) NOT NULL AUTO_INCREMENT,
  `FormId` int(11) NOT NULL,
  `Question` text COLLATE utf8_unicode_ci NOT NULL,
  `QType` int(11) NOT NULL,
  `IsRequired` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`QuestionId`)
) ENGINE=MyISAM AUTO_INCREMENT=204 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fm_questions`
--

INSERT INTO `fm_questions` (`QuestionId`, `FormId`, `Question`, `QType`, `IsRequired`) VALUES
(203, 90, 'f3kmr', 1, 0),
(202, 90, 'My Quesion', 1, 0),
(176, 88, 'Howmany yrs of experience you have', 0, 1),
(175, 88, 'What is your interested subject', 1, 1),
(174, 88, 'What is your qualification', 1, 1),
(197, 87, 'What is your college name', 0, 1),
(196, 87, 'What is your highest qualification', 1, 1),
(195, 87, 'Howmany years of experience you have', 1, 1),
(173, 86, 'What is your age', 1, 1),
(172, 86, 'What is your name', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fm_responseentry`
--

DROP TABLE IF EXISTS `fm_responseentry`;
CREATE TABLE IF NOT EXISTS `fm_responseentry` (
  `ResponseId` int(11) NOT NULL AUTO_INCREMENT,
  `User` varchar(50) NOT NULL,
  `RespondedTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FormId` int(11) NOT NULL,
  PRIMARY KEY (`ResponseId`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fm_responseentry`
--

INSERT INTO `fm_responseentry` (`ResponseId`, `User`, `RespondedTime`, `FormId`) VALUES
(31, 'Rammohan', '2018-12-20 07:59:44', 87),
(30, 'Rammohan', '2018-12-20 07:59:02', 87),
(29, 'Rammohan', '2018-12-20 07:58:16', 87),
(28, 'Rammohan', '2018-12-20 07:56:10', 87),
(27, 'Rammohan', '2018-12-20 07:50:27', 87),
(26, 'Rammohan', '2018-12-20 07:41:29', 87),
(25, 'Rammohan', '2018-12-20 07:38:23', 87),
(24, 'Rammohan', '2018-12-20 07:37:58', 87),
(23, 'Rammohan', '2018-12-20 07:20:41', 88),
(22, 'Rammohan', '2018-12-20 07:12:41', 88),
(21, 'Rammohan', '2018-12-20 07:09:04', 88),
(20, 'Rammohan', '2018-12-19 23:20:00', 86),
(19, 'Rammohan', '2018-12-18 23:10:17', 84),
(18, 'Rammohan', '2018-12-18 23:08:14', 84),
(17, 'Rammohan', '2018-12-18 22:57:09', 83),
(32, 'Rammohan', '2018-12-20 07:59:48', 87),
(33, 'Rammohan', '2018-12-20 08:00:21', 87),
(34, 'Rammohan', '2018-12-20 08:01:14', 87),
(35, 'Rammohan', '2018-12-20 08:06:57', 87),
(36, 'Rammohan', '2018-12-20 08:07:32', 87),
(37, 'Rammohan', '2018-12-20 08:07:51', 87),
(38, 'Rammohan', '2018-12-20 08:08:07', 87),
(39, 'Rammohan', '2018-12-20 08:08:14', 87),
(40, 'Rammohan', '2018-12-20 08:08:59', 87),
(41, 'Rammohan', '2018-12-20 08:11:13', 87),
(42, 'Rammohan', '2018-12-20 08:11:34', 87),
(43, 'Rammohan', '2018-12-20 08:12:58', 87),
(44, 'Rammohan', '2018-12-20 08:19:26', 87),
(45, 'Rammohan', '2018-12-20 08:27:52', 90),
(46, 'Rammohan', '2018-12-20 08:28:04', 90),
(47, 'Rammohan', '2018-12-20 08:28:46', 90);

-- --------------------------------------------------------

--
-- Table structure for table `fm_responses`
--

DROP TABLE IF EXISTS `fm_responses`;
CREATE TABLE IF NOT EXISTS `fm_responses` (
  `ResponseId` int(11) NOT NULL,
  `QuestionId` int(11) NOT NULL,
  `Response` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fm_responses`
--

INSERT INTO `fm_responses` (`ResponseId`, `QuestionId`, `Response`) VALUES
(17, 139, 'Maths'),
(17, 140, 'PVPSIR'),
(17, 141, '10'),
(18, 142, '25'),
(18, 143, 'Yes'),
(18, 144, '5'),
(19, 148, 'kadjskas'),
(19, 149, 'Yes'),
(19, 150, '>6'),
(19, 151, 'Simhachalam'),
(20, 164, 'Rammohana rao balaga'),
(20, 165, ''),
(21, 174, 'PG'),
(21, 175, 'Physics'),
(21, 176, '3'),
(22, 174, 'PG'),
(22, 175, 'Physics'),
(22, 176, '3'),
(23, 174, ''),
(23, 175, ''),
(23, 176, ''),
(24, 186, '4'),
(24, 187, 'UG'),
(24, 188, ''),
(25, 186, '4'),
(25, 187, 'UG'),
(25, 188, ''),
(26, 186, ''),
(26, 187, ''),
(26, 188, ''),
(27, 186, ''),
(27, 187, ''),
(27, 188, ''),
(28, 186, ''),
(28, 187, ''),
(28, 188, ''),
(29, 186, '2'),
(29, 187, ''),
(29, 188, ''),
(30, 189, '2'),
(30, 190, 'UG'),
(30, 191, ''),
(31, 192, '2'),
(31, 193, 'UG'),
(31, 194, ''),
(32, 192, '2'),
(32, 193, 'UG'),
(32, 194, ''),
(33, 195, '4'),
(33, 196, 'UG'),
(33, 197, ''),
(34, 195, '5'),
(34, 196, 'UG'),
(34, 197, ''),
(35, 195, '2'),
(35, 196, 'UG'),
(35, 197, ''),
(36, 195, '2'),
(36, 196, 'UG'),
(36, 197, ''),
(37, 195, '4'),
(37, 196, 'UG'),
(37, 197, ''),
(38, 195, '4'),
(38, 196, 'UG'),
(38, 197, ''),
(39, 195, '4'),
(39, 196, 'UG'),
(39, 197, 'resre'),
(40, 195, ''),
(40, 196, ''),
(40, 197, ''),
(41, 195, '4'),
(41, 196, ''),
(41, 197, ''),
(42, 195, '4'),
(42, 196, ''),
(42, 197, ''),
(43, 195, '4'),
(43, 196, ''),
(43, 197, ''),
(44, 195, '2'),
(44, 196, 'UG'),
(44, 197, 'ers'),
(45, 198, ''),
(45, 199, ''),
(46, 198, ''),
(46, 199, ''),
(47, 200, 'asdew'),
(47, 201, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
