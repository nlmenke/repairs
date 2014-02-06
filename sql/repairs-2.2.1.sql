-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2014 at 12:07 AM
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
('repair_contract', '&lt;repair_contract&gt;'),
('repair_contract_full', '&lt;full_repair_contract&gt;');

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
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `login_attempts`
--


-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE IF NOT EXISTS `repairs` (
  `ticket_id` int(8) NOT NULL AUTO_INCREMENT,
  `warranty_number` varchar(8) DEFAULT NULL,
  `customer_first` varchar(255) DEFAULT NULL,
  `customer_last` varchar(255) DEFAULT NULL,
  `phone_number` varchar(40) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `repair_type` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `error_code` varchar(50) DEFAULT NULL,
  `game_inside` tinyint(1) NOT NULL DEFAULT '0',
  `game_in_system` varchar(255) DEFAULT NULL,
  `refix` tinyint(1) NOT NULL DEFAULT '0',
  `cnbf` tinyint(1) NOT NULL DEFAULT '0',
  `replaced` tinyint(1) NOT NULL DEFAULT '0',
  `new_serial` varchar(255) DEFAULT NULL,
  `price` varchar(10) NOT NULL DEFAULT 'CALL',
  `confirmed` tinyint(1) NOT NULL DEFAULT '1',
  `drop_off_employee` varchar(255) DEFAULT NULL,
  `drop_off_date` datetime DEFAULT '0000-00-00 00:00:00',
  `repair_employee` varchar(255) DEFAULT NULL,
  `repair_date` date DEFAULT NULL,
  `last_test_date` date DEFAULT NULL,
  `times_tested` mediumint(2) NOT NULL DEFAULT '0',
  `fail_date` date DEFAULT NULL,
  `last_called_date` date DEFAULT NULL,
  `times_called` mediumint(2) NOT NULL DEFAULT '0',
  `last_customer_call` date DEFAULT NULL,
  `times_customer_call` mediumint(2) NOT NULL DEFAULT '0',
  `pick_up_date` datetime DEFAULT NULL,
  `warranty_type` varchar(20) DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `tech_notes` text,
  `call_notes` text,
  `additional_notes` text,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`ticket_id`, `warranty_number`, `customer_first`, `customer_last`, `phone_number`, `email_address`, `item`, `repair_type`, `serial_number`, `problem`, `error_code`, `game_inside`, `game_in_system`, `refix`, `cnbf`, `replaced`, `new_serial`, `price`, `confirmed`, `drop_off_employee`, `drop_off_date`, `repair_employee`, `repair_date`, `last_test_date`, `times_tested`, `fail_date`, `last_called_date`, `times_called`, `last_customer_call`, `times_customer_call`, `pick_up_date`, `warranty_type`, `expire`, `tech_notes`, `call_notes`, `additional_notes`, `last_update`) VALUES
(1, NULL, 'John', 'Doe', '9876543210', 'john.doe@some.email', 'PLAYSTATION 3', 'console', 'CE000000000', 'YELLOW LIGHT OF DEATH', NULL, 1, 'GRAND THEFT AUTO V', 0, 0, 0, '', '100', 1, 'Admin', '2013-10-26 00:00:00', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'admin@some.email', NULL, NULL, NULL, NULL, 0, 1391660207, 1, 'Admin', 'Istrator', 'Gamers Orlando', '3216549870'),
(2, '127.0.0.1', 'employee', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'emp@some.email', NULL, NULL, NULL, NULL, 0, 1391570923, 1, 'Emp', 'Loyee', NULL, NULL),
(3, '\0\0', 'john_doe', '$2a$08$ubBYPp6w.RFLMsVGLshSHORFQymB63NTB3a/rxhbu9k9gZyfZz3ae', NULL, 'john.doe@some.email', NULL, NULL, NULL, NULL, 1391571893, 1391660023, 1, 'John', 'Doe', NULL, '9876543210');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);
