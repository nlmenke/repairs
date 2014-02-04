-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2014 at 09:25 PM
-- Server version: 5.1.46
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `repairs`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_config`
--

CREATE TABLE IF NOT EXISTS `app_config` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_config`
--

INSERT INTO `app_config` (`key`, `value`) VALUES
('company', '&lt;company_name&gt;'),
('company_slogan', '&lt;company_slogan&gt;'),
('address', '&lt;company_address&gt;'),
('city_state_zip', '&lt;city&gt;, &lt;state&gt; &lt;zipcode&gt;'),
('email', '&lt;company_email&gt;'),
('phone', '&lt;company_phone&gt;'),
('timezone', 'America/New_York'),
('repair_contract', '&lt;repair_contract&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'employee', 'Employee'),
(3, 'customer', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE IF NOT EXISTS `meta` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `company`) VALUES
(1, 1, 'Admin', 'Istrator', '0000000000', '&lt;company&gt;'),
(2, 2, 'Emp', 'Loyee', '1111111111', '&lt;company&gt;'),
(3, 3, 'John', 'Doe', '9876543210', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE IF NOT EXISTS `repairs` (
  `ticket_id` int(15) NOT NULL AUTO_INCREMENT,
  `warranty_number` int(15) DEFAULT NULL,
  `customer_first` varchar(255) DEFAULT NULL,
  `customer_last` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `system` varchar(255) DEFAULT NULL,
  `repair_type` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `refix` tinyint(1) NOT NULL DEFAULT '0',
  `cnbf` tinyint(1) NOT NULL DEFAULT '0',
  `price` varchar(255) DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '1',
  `drop_off_employee` varchar(255) DEFAULT NULL,
  `drop_off_date` datetime DEFAULT NULL,
  `repair_employee` varchar(255) DEFAULT NULL,
  `repair_date` date DEFAULT NULL,
  `test_1_date` date DEFAULT NULL,
  `test_2_date` date DEFAULT NULL,
  `called_1_date` date DEFAULT NULL,
  `called_2_date` date DEFAULT NULL,
  `called_3_date` date DEFAULT NULL,
  `pick_up_employee` varchar(255) DEFAULT NULL,
  `pick_up_date` date DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`ticket_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=2;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`ticket_id`, `warranty_number`, `customer_first`, `customer_last`, `phone_number`, `email_address`, `system`, `repair_type`, `serial_number`, `problem`, `refix`, `cnbf`, `price`, `confirmed`, `drop_off_employee`, `drop_off_date`, `repair_employee`, `repair_date`, `test_1_date`, `test_2_date`, `called_1_date`, `called_2_date`, `called_3_date`, `pick_up_employee`, `pick_up_date`, `expire`, `notes`) VALUES
(1, NULL, 'John', 'Doe', '9876543210', 'john.doe@some.email', 'PLAYSTATION 3', 'console', 'CE000000000', 'YELLOW LIGHT OF DEATH', 0, 0, '100.00', 1, 'Admin', '2013-10-26 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `ip_address` char(16) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`) VALUES
(1, 1, '', 'Admin', 'fb35ab1a41e62238917efd2a730c31ceb3961125', NULL, 'admin@some.email', NULL, NULL, NULL, 0, NULL, 1),
(2, 2, '', 'Emp', '3c627ccf3502abeaa0c564f82ab77d250761c96d', NULL, 'emp@some.email', NULL, NULL, NULL, 0, NULL, 1),
(3, 3, '', 'john_doe', 'ade1fdb6bae2751c3591f35b4999350d1d91ddb5', NULL, 'john.doe@some.email', NULL, NULL, NULL, 0, NULL, 1);
