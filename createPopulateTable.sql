-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2011 at 02:49 AM
-- Server version: 5.1.44
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `tdl_todo`
--

CREATE TABLE `tdl_todo` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(8) unsigned NOT NULL DEFAULT '0',
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dt_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tdl_todo`
--

INSERT INTO `tdl_todo` VALUES(15, 2, '2', '2011-05-22 21:51:15', 0);
INSERT INTO `tdl_todo` VALUES(25, 1, '1', '2011-05-22 22:50:09', 0);
INSERT INTO `tdl_todo` VALUES(12, 8, '8', '2011-05-22 12:54:25', 0);
INSERT INTO `tdl_todo` VALUES(16, 7, '7', '2011-05-22 22:07:35', 0);
INSERT INTO `tdl_todo` VALUES(24, 9, '9', '2011-05-22 22:49:49', 0);
INSERT INTO `tdl_todo` VALUES(11, 6, '6', '2011-05-22 10:36:01', 0);
INSERT INTO `tdl_todo` VALUES(22, 4, '4', '2011-05-22 22:20:27', 0);
INSERT INTO `tdl_todo` VALUES(30, 10, '10', '2011-05-23 20:44:56', 0);
INSERT INTO `tdl_todo` VALUES(23, 5, '5', '2011-05-22 22:32:04', 0);
INSERT INTO `tdl_todo` VALUES(26, 3, '3', '2011-05-22 22:50:21', 0);
