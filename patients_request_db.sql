-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- المزود: localhost
-- أنشئ في: 22 أبريل 2020 الساعة 22:07
-- إصدارة المزود: 5.5.16
--  PHP إصدارة: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- قاعدة البيانات: `patients_request_db`
--

-- --------------------------------------------------------

--
-- بنية الجدول `patient_request`
--

CREATE TABLE IF NOT EXISTS `patient_request` (
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
  `accepted` int(1) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `patient_request`
--

INSERT INTO `patient_request` (`PID`, `first_name`, `last_name`, `gender`, `phone`, `address`, `e_mail`, `date_of_birth`, `username`, `password`, `image`, `SID`, `problem_description`, `accepted`, `timestamp`) VALUES
(2214548788, 'Arwa', 'mohammed', 'Female', '0521421445', 'Makkah', 'arwa@gmail.com', '2014-04-22', 'arwa', '741852963', '', 0, 'ØªÙˆØ±Ù… ÙÙŠ Ø§Ù„Ù„Ø«Ø©', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
