-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- المزود: localhost
-- أنشئ في: 22 أبريل 2020 الساعة 00:39
-- إصدارة المزود: 5.5.16
--  PHP إصدارة: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- قاعدة البيانات: `dental_system_db`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `AID` int(5) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`AID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- إرجاع أو استيراد بيانات الجدول `admin`
--

INSERT INTO `admin` (`AID`, `admin_name`, `e_mail`, `username`, `password`) VALUES
(1, 'rahaf', 'rahaf@gmail.com', 'rahaf', '123'),
(38, 'aseel', 'aseel@gmail.com', 'aseel', '32122'),
(39, 'salma', 'salma@gmail.com', 'salma', 'salma');

-- --------------------------------------------------------

--
-- بنية الجدول `appoinment`
--

CREATE TABLE IF NOT EXISTS `appoinment` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `PID` bigint(20) NOT NULL,
  `SID` int(5) NOT NULL,
  `time` varchar(30) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- إرجاع أو استيراد بيانات الجدول `appoinment`
--

INSERT INTO `appoinment` (`ID`, `PID`, `SID`, `time`, `date`) VALUES
(1, 7441108795, 4, '4 PM', '2020-11-10'),
(3, 2235647891, 1, '07:27:00 PM', '2020-03-12'),
(4, 7441108795, 1, '11 AM', '2010-05-05'),
(5, 16, 1, '8 PM', '2017-07-15');

-- --------------------------------------------------------

--
-- بنية الجدول `available_times`
--

CREATE TABLE IF NOT EXISTS `available_times` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `SID` int(5) NOT NULL,
  `hour` int(2) NOT NULL,
  `AM_or_PM` varchar(5) NOT NULL,
  `date` varchar(15) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- إرجاع أو استيراد بيانات الجدول `available_times`
--

INSERT INTO `available_times` (`ID`, `SID`, `hour`, `AM_or_PM`, `date`, `status`) VALUES
(3, 1, 11, 'AM', '2010-05-05', 1),
(4, 4, 5, 'PM', '2010-11-11', 0),
(6, 4, 4, 'PM', '2020-11-10', 1),
(7, 1, 5, 'AM', '2010-05-02', 1),
(12, 1, 4, 'PM', '2010-05-01', 0),
(17, 1, 8, 'PM', '2017-7-15', 1),
(22, 1, 4, 'AM', '2009-2-13', 0),
(23, 6, 2, 'AM', '2017-2-18', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `chart`
--

CREATE TABLE IF NOT EXISTS `chart` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `PID` bigint(20) NOT NULL,
  `SID` int(5) NOT NULL,
  `tooth_no` int(2) NOT NULL,
  `level` int(2) NOT NULL,
  `date` date NOT NULL,
  `changes` varchar(100) NOT NULL,
  `DID` int(5) NOT NULL,
  `accepted` int(1) NOT NULL,
  `notes` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- إرجاع أو استيراد بيانات الجدول `chart`
--

INSERT INTO `chart` (`ID`, `PID`, `SID`, `tooth_no`, `level`, `date`, `changes`, `DID`, `accepted`, `notes`) VALUES
(1, 7441108795, 1, 40, 5, '2000-10-05', 'clear the black area  aaaa', 16, 0, 'notes'),
(5, 7441108795, 1, 45, 3, '2020-12-10', 'sort  ', 16, 1, 'sort'),
(7, 7441108795, 1, 40, 5, '2020-03-05', 'extraction', 14, 1, 'none notes'),
(16, 7441108795, 2, 43, 2, '2020-03-05', 'clear  the balck holes', 14, 0, 'no notes'),
(18, 2235647891, 2, 42, 2, '2020-03-05', 'exctraction', 0, 0, 'pain'),
(19, 2235647891, 2, 33, 4, '2020-03-05', 'clear black hole', 0, 0, ''),
(20, 2235647891, 2, 44, 1, '2020-03-05', '', 0, 0, ''),
(21, 587458745, 6, 12, 2, '2020-03-12', '', 0, 0, ''),
(22, 587458745, 6, 44, 1, '2020-03-12', '', 0, 0, ''),
(23, 587458745, 6, 25, 4, '2020-03-12', '', 0, 0, ''),
(24, 5454542521, 6, 13, 1, '2020-04-22', '', 0, 0, ''),
(25, 5454542521, 6, 11, 3, '2020-04-22', '', 0, 0, '');

-- --------------------------------------------------------

--
-- بنية الجدول `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `DID` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_connected` int(1) NOT NULL,
  PRIMARY KEY (`DID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- إرجاع أو استيراد بيانات الجدول `doctor`
--

INSERT INTO `doctor` (`DID`, `first_name`, `last_name`, `phone`, `e_mail`, `username`, `password`, `image`, `is_connected`) VALUES
(1, 'rahaf', 'ahmed', '05554215', 'rahaf@gmail.com', 'rahaf', 'rahaf', 'user _black.png', 0),
(2, 'aseel', 'ali', '0542154', 'aseel@gmail.com', 'aseel', 'aseel', 'user _black.png', 0),
(3, 'sarah', 'hassan', '05245121', 'sarah@gmail.com', 'sarah', 'sarah', 'user _black.png', 0),
(4, 'yasmin', 'sarhan', '054215421', 'yasmin@gmail.com', 'yasmin', '321', 'user _black.png', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `MID` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- إرجاع أو استيراد بيانات الجدول `manager`
--

INSERT INTO `manager` (`MID`, `first_name`, `last_name`, `role`, `username`, `password`) VALUES
(1, 'sarah saeed', 'sarah', 'manager', 'manager', 'manager');

-- --------------------------------------------------------

--
-- بنية الجدول `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `MID` int(5) NOT NULL AUTO_INCREMENT,
  `DID` int(5) NOT NULL,
  `RID` int(5) NOT NULL,
  `time` varchar(15) NOT NULL,
  `text` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL,
  `sender` varchar(1) NOT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;



-- --------------------------------------------------------

--
-- بنية الجدول `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `PID` bigint(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `date_of_birth` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `SID` int(5) NOT NULL,
  `problem_description` varchar(500) NOT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `patient`
--

INSERT INTO `patient` (`PID`, `first_name`, `last_name`, `gender`, `phone`, `address`, `e_mail`, `date_of_birth`, `username`, `password`, `image`, `SID`, `problem_description`) VALUES
(112457896, 'hasonh', 'hamid', 'Female', '5214214', 'om darman', 'hasonah@gmail.com', '10/05/2009', 'hasonahn', 'hasonah', '', 0, ' pain in the 14th teeth and black hols'),
(332456987, 'hashim', 'ali', 'Male', '552145478', 'jeddah', 'hashim@gmail.com', '2020-01-02', 'hashim', '123456', '', 0, ' pain in front teeth'),
(2235647891, 'abd allah', 'ali', 'Male', '0552142', 'jeddah', 'abdallah@gmail.com', '20/02/2020', 'abd allah', '111', '', 0, ''),
(7441108795, 'fahd', 'Salim', 'Male', '055624521', 'geddah - main st , in front of the hospital', 'fahd@gmail.com', '2010-02-09', 'fahd', 'fahd', 'user2.png', 1, '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `patients_data`
--
CREATE TABLE IF NOT EXISTS `patients_data` (
`PID` bigint(20)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`SID` int(5)
);
-- --------------------------------------------------------

--
-- بنية الجدول `receptionist`
--

CREATE TABLE IF NOT EXISTS `receptionist` (
  `RID` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `is_connected` int(1) NOT NULL,
  PRIMARY KEY (`RID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- إرجاع أو استيراد بيانات الجدول `receptionist`
--

INSERT INTO `receptionist` (`RID`, `name`, `username`, `password`, `image`, `is_connected`) VALUES
(2, 'samirah ali saeed salim', 'samirah', 'sami', 'user_black.gif', 1),
(3, 'azhar', 'azhar', 'azhar', 'user_black.gif', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `SID` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `level` int(5) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_excellent` int(1) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- إرجاع أو استيراد بيانات الجدول `student`
--

INSERT INTO `student` (`SID`, `first_name`, `last_name`, `level`, `phone`, `e_mail`, `username`, `password`, `is_excellent`) VALUES
(1, 'Hassan', 'Ahmed', 2, '05521547', 'hassan@gmail.com', 'hassan', 'hassan', 0),
(4, 'hanin', 'salman', 4, '0552125', 'hanin@gmail.com', 'hanin', 'hanan', 0),
(6, 'ramiz', 'khalid', 1, '05421541', 'ramiz@gmail.com', 'ramiz', '123', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `website_data`
--

CREATE TABLE IF NOT EXISTS `website_data` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `website_word` varchar(1000) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- إرجاع أو استيراد بيانات الجدول `website_data`
--

INSERT INTO `website_data` (`ID`, `website_word`, `phone`, `e_mail`, `location`) VALUES
(1, 'DMS DMS is web based Application used to help students in dental ï¿½DMS is web based Applicationï¿½ used to help students in dentalused to help students in dental', '055214523', 'dental_System@gmail.com', '237 Alawali Mecca 24318');

-- --------------------------------------------------------

--
-- Structure for view `patients_data`
--
DROP TABLE IF EXISTS `patients_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `patients_data` AS select `patient`.`PID` AS `PID`,`patient`.`first_name` AS `first_name`,`patient`.`last_name` AS `last_name`,`appoinment`.`SID` AS `SID` from (`patient` left join `appoinment` on((`patient`.`PID` = `appoinment`.`PID`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
