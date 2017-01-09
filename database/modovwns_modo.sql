-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2017 at 10:53 AM
-- Server version: 5.5.52-cll-lve
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `modovwns_modo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bot`
--

CREATE TABLE IF NOT EXISTS `bot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `base` decimal(14,2) DEFAULT '0.00',
  `usd` decimal(6,2) DEFAULT '0.00',
  `btc` decimal(10,8) DEFAULT '0.00000000',
  `exchange_fee` decimal(4,4) DEFAULT '0.0050',
  `increase` decimal(8,6) DEFAULT '0.000000',
  `decrease` decimal(8,6) DEFAULT '0.000000',
  `is_active` tinyint(1) DEFAULT '0',
  `can_buy` tinyint(1) DEFAULT '0',
  `buy_limit_btc` decimal(20,8) DEFAULT '0.00000000',
  `can_sell` tinyint(1) DEFAULT '0',
  `sell_limit_btc` decimal(20,8) DEFAULT '0.00000000',
  `testing_mode` tinyint(1) DEFAULT '1',
  `bot_name` varchar(20) DEFAULT '',
  `exchange` int(11) NOT NULL DEFAULT '1',
  `live` tinyint(4) DEFAULT '0',
  `level` tinyint(4) DEFAULT '0',
  `go_live` date DEFAULT NULL,
  `fixed_sell` tinyint(4) NOT NULL DEFAULT '0',
  `fixed_buy` tinyint(4) NOT NULL DEFAULT '0',
  `fixed_buy_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `fixed_sell_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `balance` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `currency` varchar(6) NOT NULL DEFAULT 'usd',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

--
-- Dumping data for table `bot`
--

INSERT INTO `bot` (`id`, `owner_id`, `base`, `usd`, `btc`, `exchange_fee`, `increase`, `decrease`, `is_active`, `can_buy`, `buy_limit_btc`, `can_sell`, `sell_limit_btc`, `testing_mode`, `bot_name`, `exchange`, `live`, `level`, `go_live`, `fixed_sell`, `fixed_buy`, `fixed_buy_amount`, `fixed_sell_amount`, `balance`, `currency`) VALUES
(63, 98, '1135.00', '0.18', '0.06632031', '0.0050', '0.020000', '0.009000', 1, 0, '1.00000000', 0, '2.00000000', 0, '', 1, 1, 0, NULL, 0, 0, '381.0000', '380.0000', '0.0010', 'usd'),
(91, 143, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(92, 145, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(93, 146, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(94, 147, '415.00', '0.00', '0.00000000', '0.0050', '0.004800', '0.000000', 1, 0, '1.00000000', 0, '1.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(96, 149, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(97, 150, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(98, 151, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(99, 152, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(100, 154, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(101, 155, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(102, 157, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(103, 158, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(104, 159, '8.00', '0.00', '0.00000000', '0.0050', '0.003000', '0.003000', 1, 1, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.1000', '0.2000', '0.0000', 'usd'),
(105, 160, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(106, 162, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(107, 163, '100.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 1, 1, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(108, 164, '650.00', '0.00', '0.00000000', '0.0050', '0.010000', '0.010000', 1, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(109, 165, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(110, 166, '0.00', '0.00', '0.00000000', '0.0050', '0.050000', '0.030000', 1, 1, '0.00000000', 1, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(111, 167, '100.00', '0.00', '0.00000000', '0.0050', '0.100000', '0.000000', 0, 1, '0.00000000', 1, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(112, 168, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(113, 169, '575.00', '0.00', '0.00000000', '0.0050', '0.012500', '0.012500', 1, 0, '0.50000000', 0, '0.50000000', 0, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(114, 170, '50.00', '0.00', '0.00000000', '0.0050', '0.100000', '0.050000', 1, 1, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 1, '576.0000', '584.8800', '0.0000', 'usd'),
(115, 171, '573.61', '0.00', '0.00000000', '0.0050', '0.000500', '0.000500', 1, 1, '0.00000000', 0, '0.00000000', 0, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(116, 172, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(117, 173, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 1, 1, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 1, '0.0000', '0.0000', '0.0000', 'usd'),
(118, 174, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(119, 176, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 0, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(120, 177, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(121, 178, '100.00', '0.00', '0.00000000', '0.0050', '0.020000', '0.030000', 1, 1, '0.00000000', 1, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(122, 179, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(123, 180, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(124, 182, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(125, 183, '500.00', '0.00', '0.00000000', '0.0050', '0.000300', '0.000000', 0, 1, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(126, 184, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd'),
(127, 185, '0.00', '0.00', '0.00000000', '0.0050', '0.000000', '0.000000', 0, 0, '0.00000000', 0, '0.00000000', 1, '', 1, 1, 0, NULL, 0, 0, '0.0000', '0.0000', '0.0000', 'usd');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `key` varchar(16) NOT NULL,
  `param` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`key`, `param`) VALUES
('runDaemon', '1');

-- --------------------------------------------------------

--
-- Table structure for table `exchange`
--

CREATE TABLE IF NOT EXISTS `exchange` (
  `id` int(11) NOT NULL DEFAULT '0',
  `description` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`id`, `description`, `is_active`) VALUES
(1, 'Bitstamp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `historic`
--

CREATE TABLE IF NOT EXISTS `historic` (
  `owner_id` int(11) NOT NULL DEFAULT '0',
  `high` decimal(8,4) DEFAULT '0.0000',
  `low` decimal(8,4) DEFAULT '0.0000',
  `date_low` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_high` timestamp NULL DEFAULT NULL,
  `start_usd` decimal(8,4) DEFAULT '0.0000',
  `start_btc` decimal(10,8) DEFAULT '0.00000000',
  `currency` varchar(10) DEFAULT 'btc',
  PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `historic`
--

INSERT INTO `historic` (`owner_id`, `high`, `low`, `date_low`, `date_high`, `start_usd`, `start_btc`, `currency`) VALUES
(98, '75.5676', '0.1800', '2017-01-04 05:00:00', '2017-01-05 05:00:00', '74.0200', '0.00000000', 'btc'),
(143, '2572.2000', '0.0000', '2016-03-06 23:43:19', '2016-03-07 05:00:00', '0.0000', '0.00000000', 'btc'),
(145, '0.0000', '0.0000', '2016-03-20 06:13:47', NULL, '0.0000', '0.00000000', 'btc'),
(146, '0.0000', '0.0000', '2016-03-22 15:30:29', NULL, '0.0000', '0.00000000', 'btc'),
(147, '2652.8200', '0.0000', '2016-03-22 15:34:16', '2016-04-16 04:00:00', '0.0000', '0.00000000', 'btc'),
(148, '0.0000', '0.0000', '2016-03-24 04:00:00', '2016-03-24 04:00:00', '0.0000', '0.00000000', 'btc'),
(149, '0.0000', '0.0000', '2016-03-31 17:09:04', NULL, '0.0000', '0.00000000', 'btc'),
(150, '0.0000', '0.0000', '2016-04-07 14:43:16', NULL, '0.0000', '0.00000000', 'btc'),
(151, '0.0000', '0.0000', '2016-04-15 00:54:21', NULL, '0.0000', '0.00000000', 'btc'),
(152, '0.0000', '0.0000', '2016-04-19 15:25:44', NULL, '0.0000', '0.00000000', 'btc'),
(154, '0.0000', '0.0000', '2016-04-21 18:56:44', NULL, '0.0000', '0.00000000', 'btc'),
(155, '0.0000', '0.0000', '2016-04-22 12:00:11', NULL, '0.0000', '0.00000000', 'btc'),
(157, '0.0000', '0.0000', '2016-04-23 17:32:45', NULL, '0.0000', '0.00000000', 'btc'),
(158, '0.0000', '0.0000', '2016-06-04 14:16:35', NULL, '0.0000', '0.00000000', 'btc'),
(159, '0.0000', '0.0000', '2016-06-04 04:00:00', '2016-06-04 04:00:00', '0.0000', '0.00000000', 'btc'),
(160, '0.0000', '0.0000', '2016-06-17 09:08:24', NULL, '0.0000', '0.00000000', 'btc'),
(162, '0.0000', '0.0000', '2016-06-25 00:11:51', NULL, '0.0000', '0.00000000', 'btc'),
(163, '0.0000', '0.0000', '2016-07-09 17:57:20', NULL, '0.0000', '0.00000000', 'btc'),
(164, '0.0000', '0.0000', '2016-07-10 04:00:00', '2016-07-10 04:00:00', '0.0000', '0.00000000', 'btc'),
(165, '0.0000', '0.0000', '2016-07-29 12:45:12', NULL, '0.0000', '0.00000000', 'btc'),
(166, '0.0000', '0.0000', '2016-07-31 04:00:00', '2016-07-31 04:00:00', '0.0000', '0.00000000', 'btc'),
(167, '0.0000', '0.0000', '2016-08-01 18:30:18', NULL, '0.0000', '0.00000000', 'btc'),
(168, '0.0000', '0.0000', '2016-08-12 05:34:51', NULL, '0.0000', '0.00000000', 'btc'),
(169, '869.6400', '0.0000', '2016-08-16 04:00:00', '2016-08-16 04:00:00', '0.0000', '0.00000000', 'btc'),
(170, '0.0000', '0.0000', '2016-08-24 04:00:00', '2016-08-24 04:00:00', '0.0000', '0.00000000', 'btc'),
(171, '0.0000', '0.0000', '2016-08-29 18:28:11', NULL, '0.0000', '0.00000000', 'btc'),
(172, '0.0000', '0.0000', '2016-09-05 10:22:29', NULL, '0.0000', '0.00000000', 'btc'),
(173, '0.0000', '0.0000', '2016-09-05 04:00:00', '2016-09-05 04:00:00', '0.0000', '0.00000000', 'btc'),
(174, '0.0000', '0.0000', '2016-09-29 06:21:15', NULL, '0.0000', '0.00000000', 'btc'),
(176, '0.0000', '0.0000', '2016-10-09 06:23:41', NULL, '0.0000', '0.00000000', 'btc'),
(177, '0.0000', '0.0000', '2016-11-09 15:38:36', NULL, '0.0000', '0.00000000', 'btc'),
(178, '0.0000', '0.0000', '2016-12-09 05:00:00', '2016-12-09 05:00:00', '0.0000', '0.00000000', 'btc'),
(179, '0.0000', '0.0000', '2016-12-13 17:29:06', NULL, '0.0000', '0.00000000', 'btc'),
(180, '0.0000', '0.0000', '2017-01-04 21:14:56', NULL, '0.0000', '0.00000000', 'btc'),
(182, '0.0000', '0.0000', '2017-01-04 21:47:57', NULL, '0.0000', '0.00000000', 'btc'),
(183, '0.0000', '0.0000', '2017-01-05 00:36:29', NULL, '0.0000', '0.00000000', 'btc'),
(184, '0.0000', '0.0000', '2017-01-05 01:47:00', NULL, '0.0000', '0.00000000', 'btc'),
(185, '0.0000', '0.0000', '2017-01-05 07:26:04', NULL, '0.0000', '0.00000000', 'btc');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `email` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`email`, `date`) VALUES
('cclites@sweeps-soft.', '0000-00-00'),
('ertet', '0000-00-00'),
('sdsf', '0000-00-00'),
('erter', '0000-00-00'),
('mimox75@hotmail.com', '0000-00-00'),
('jdebunt@gmail.com', '0000-00-00'),
('brendanjerwin@gmail.', '0000-00-00'),
('manzerroberto@gmail.', '0000-00-00'),
('rogerwils_1@hotmail.', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE IF NOT EXISTS `market` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` char(20) DEFAULT NULL,
  `exchange_id` int(11) DEFAULT NULL,
  `high` decimal(15,2) DEFAULT NULL,
  `last_price` decimal(15,2) DEFAULT NULL,
  `bid` decimal(15,2) DEFAULT NULL,
  `volume` decimal(10,4) DEFAULT NULL,
  `low` decimal(15,2) DEFAULT NULL,
  `ask` double DEFAULT NULL,
  `direction` int(11) DEFAULT NULL,
  `trend` int(11) DEFAULT NULL,
  `previous_last` decimal(14,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`id`, `currency`, `exchange_id`, `high`, `last_price`, `bid`, `volume`, `low`, `ask`, `direction`, `trend`, `previous_last`) VALUES
(1, 'btc', 1, '1000.00', '1000.00', '999.96', '36147.1757', '902.53', 1000, 1, 1, '999.96');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) DEFAULT NULL,
  `display_name` varchar(20) DEFAULT NULL,
  `token` varchar(128) DEFAULT NULL,
  `session` varchar(80) NOT NULL,
  `activated` tinyint(4) DEFAULT '0',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_viewed` timestamp NULL DEFAULT NULL,
  `updated` int(11) NOT NULL DEFAULT '0',
  `balance` int(6) NOT NULL,
  `lifetime_balance` int(11) NOT NULL,
  `ring` int(11) DEFAULT NULL,
  `stripe_id` varchar(32) NOT NULL,
  `subscription` varchar(64) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `display_name` (`display_name`),
  UNIQUE KEY `display_name_2` (`display_name`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `email`, `display_name`, `token`, `session`, `activated`, `date_added`, `last_viewed`, `updated`, `balance`, `lifetime_balance`, `ring`, `stripe_id`, `subscription`, `paid`) VALUES
(98, 'modobot@modobot.com', 'ModoBoss', '3385a30b7853e8779bd88f7221973eb2266f401b45cee1f4bdcfc7c6133abc00', 'WADC/+4ii6ZbCG6CBPL+tfPkn0kAQJh8w4xct9+n/Am2Q5PJruF0L4E0z5CHW9jSqqjTxtNdsEr4eY5Q', 1, '2016-01-23 00:27:45', '2017-01-09 14:53:58', 0, 3, 0, 0, 'tok_18ZOSHAfcccQ22ovnP6jNVyn', 'sub_8r6fyONftIvBMi', 1),
(143, 'initis_gaming@aol.com', 'initis bot ', 'b82b5c5d7966d81a85608005ad6e65b54c6aa4ed5e2fcbf69bc5fc5d7e67326a', '', 0, NULL, NULL, 0, 0, 0, NULL, '', '', 0),
(145, 'XavierFrost7@gmail.com', 'Xav@ModoBot', '21f184bc720894a820b72a3b81ac02ec7564811cea3e9de908e153af98190527', '', 1, '2016-03-20 06:13:47', NULL, 0, 36, 0, NULL, '', '', 0),
(147, 'kovaldavid@hotmail.com', 'dave', '350d68b57a32d329191e8862e89cf624aa8d0ae18c7bfcfe95b70cdf1e02b8bc', '', 1, '2016-03-22 15:34:16', '2016-08-25 01:43:14', 0, 5, 0, 0, '', '', 0),
(150, 'david.koval@coyotes.usd.edu', 'dav', '704ad66f52f5f6afa9d2292568597da5cc08773075fd35c76394d94410a6aca7', '', 1, '2016-04-07 14:43:16', NULL, 0, 0, 0, NULL, '', '', 0),
(151, 'xscxsc@bk.ru', 'xscxsc', '58fd635b85f9b3cbb94c1e154def64bd80837e7b878b29f8cb85820cc806431b', '', 0, '2016-04-15 00:54:21', NULL, 0, 0, 0, NULL, '', '', 0),
(152, 'sizeandcolors@gmail.com', 'hurryfun2', '88025c97255f2773aba704d05a2fc0e333e7e2604a94e54fdc7c979e75f9daa4', '', 0, '2016-04-19 15:25:44', NULL, 0, 0, 0, NULL, '', '', 0),
(154, 'daveeedkoval@gaymail.com', 'asseater69', '565481aa2efa39b0831e003aa59b921f9951c68ec4f77a9549dabd5934d3d0be', '', 0, '2016-04-21 18:56:44', NULL, 0, 0, 0, NULL, '', '', 0),
(155, 'gwebb4487@gmail.com', 'Capbot', '77002e244f52ce5f6b90c3a6717932bd0d98e0f822301d3b07e145aa2aab499f', '', 1, '2016-04-22 12:00:11', NULL, 0, 0, 0, NULL, '', '', 0),
(157, 'jtori84@gmail.com', 'jtori84', '2bbcc43f76d5976e424809b28987fb3cfed953373bfccc8624275e02a4f14f1a', '', 0, '2016-04-23 17:32:45', NULL, 0, 0, 0, NULL, '', '', 0),
(158, 'kimalretali73@gmail.com', 'zieta', '449bc3ddd8bb19c290da10df22581f8ba1ea0df97d1251eef5abc2c9e39b944d', '', 0, '2016-06-04 14:16:35', NULL, 0, 0, 0, NULL, '', '', 0),
(159, 'kimalretali@gmail.com', 'zietas', 'cf6c747897eba0519e21283a5be9de46ebce46e8f62e80fc18e8da2723c69d8a', '', 1, '2016-06-04 14:18:03', NULL, 0, 0, 0, NULL, '', '', 0),
(160, 'tjia.willy.chandra@gmail.com', 'xwillyx', '4af664636aced2d90f412362d01dbda756cab736024e21b75162e831ad43c4ae', '', 1, '2016-06-17 09:08:24', NULL, 0, 0, 0, NULL, '', '', 0),
(162, 'creme10@hotmail.com', 'creme', 'b84d06915d4645464e95036bfb237e54e9d778930f79673fed14c5489306db27', '', 0, '2016-06-25 00:11:51', NULL, 0, 0, 0, NULL, '', '', 0),
(163, 'ekremarman09@hotmail.com', 'EArmani', 'b1e3e909d6182659acf3e6354b2b2ee1556f49ab9e1a4465a26e21f8bf21c413', '', 1, '2016-07-09 17:57:20', NULL, 0, 0, 0, NULL, '', '', 0),
(164, 'modobot@radforth.com', 'mexicana', '16194a9c1511784fa17ab2dd614660ae950ac5e6dc44bdbf90d28a48882240f9', '', 1, '2016-07-10 21:16:46', '2016-07-12 13:37:54', 0, 0, 0, NULL, '', '', 0),
(165, 'said.nursi2015@yandex.com', 'saidnursi', '3275989843b11aec17c4f81e0b6af9e61dddd83f776ba62ee850109d920cdbfb', '', 0, '2016-07-29 12:45:12', NULL, 0, 0, 0, NULL, '', '', 0),
(166, 'robbins2@gmail.com', 'Un0', 'b95b4f396a96699732017941ac943dffa8dfdb93b8783f3d92d3799c5a421b72', '', 1, '2016-07-31 18:36:39', '2016-07-31 18:37:45', 0, 0, 0, NULL, '', '', 0),
(167, 'udit.wal@gmail.com', 'damnyoubot', '1c30600d98c5a1ac55a95bbef2349928d9994690ad07fe303391ce8fcbc0308e', '', 0, '2016-08-01 18:30:18', '2016-08-01 18:30:31', 0, 0, 0, NULL, '', '', 0),
(168, 'Whytebot@mailcrypt.xyz', 'WhyteBot', 'af58778ff484e96be3a7903bc40f5c3aafb92c20fac0891f3b0a228f5ae4cd3e', '', 1, '2016-08-12 05:34:51', '2016-08-12 05:38:48', 0, 0, 0, NULL, 'tok_18hYO2AfcccQ22ovYTJIfGtc', 'sub_8zXSxLc1nPj3am', 1),
(169, 'cliff@may.be', 'CliffBot', '2997067b3befcd9f7bab1086aece35ad56a980f804edbd8475ef05d2dafccde8', '', 1, '2016-08-16 12:01:14', '2016-08-22 20:41:11', 0, 0, 0, NULL, 'tok_madeuptoken1', 'gold_member', 1),
(170, 'vvigode@mail.ru', 'vvigode', '90837ffd2675a0ed18599826079aa6bf6835588fd7be3e3c4de514aa9544b006', '', 1, '2016-08-24 13:08:07', '2016-08-24 13:10:03', 0, 0, 0, NULL, '', '', 0),
(171, 'morantis2010@gmail.com', 'morantis', '1dfeded739071b374539a60a0cbfd72c4dcedc3444440ca40b1ed396388ad11b', '', 1, '2016-08-29 18:28:11', '2016-08-29 18:29:22', 0, 0, 0, NULL, 'tok_18nv1lAfcccQ22ovoxvwZNgW', 'sub_967GgqwqpG3grs', 1),
(172, 'oluseyibamidele01@gmail.com', 'olushakes', '940854e4aae87c0083d358ff49add7cfc9870bae949892fc0e3a3e7d9bd00116', '', 0, '2016-09-05 10:22:29', NULL, 0, 0, 0, NULL, '', '', 0),
(173, 'olg2ber@mail.ru', 'olg2ber', 'a9fd46e47382f9578b850b0691cfdd6f53958d7e07951fdbc7a22c50db4dbda5', '', 0, '2016-09-05 11:31:50', '2016-09-05 11:38:12', 0, 0, 0, NULL, '', '', 0),
(174, 'ronnymusafir@yahoo.co.id', 'vipkuburaya', '568f45012b8b94f2828c6fabc4e77ce856bdda3d47469ee8d31b24ae6ea600af', '', 0, '2016-09-29 06:21:15', NULL, 0, 0, 0, NULL, '', '', 0),
(176, 'djisse@gmail.com', 'djisse', 'e7abaff796c8137e990ed48bdf70b04ec61dd53fb63ae0877a9230414504c4ce', '', 0, '2016-10-09 06:23:41', NULL, 0, 0, 0, NULL, '', '', 0),
(177, 'modo@sweeps-soft.com', 'ModoTest', 'a49641533447b937d0a92198a2536ebeef35b220d709e172a5ca894e647fdcc4', '', 1, '2016-11-09 15:38:36', '2016-11-09 15:52:00', 0, 0, 0, NULL, '', '', 0),
(178, 'candymanpicco@gmail.com', 'candyman', '2dfb04a04a3dcefe9dd5fb153b599ba832e38477941a2cb51fb9144490a15ba3', '', 1, '2016-11-25 08:45:40', '2016-12-28 19:08:26', 0, 0, 0, NULL, '', '', 0),
(179, 'tonywilson016@gmail.com', 'jaideep30', '344e5252ddf479a735aa5d30284f1e280868f58a4804f02bf61e25296417f552', '', 1, '2016-12-13 17:29:05', NULL, 0, 0, 0, NULL, '', '', 0),
(180, 'brendan@brendanbrandt.com', 'Brendan Bot', '23b8689bbe025088b8d6b6e328019592d580e6243671ce2b994c0f8e6f6b7812', '', 1, '2017-01-04 21:14:56', NULL, 0, 0, 0, NULL, '', '', 0),
(182, 'modobot@ditspace.com', 'doff', 'c5f48bd9f104d9edcb21de2f91e7ccfec15464c99d9be7f1963b4ff17d6484c1', '', 1, '2017-01-04 21:47:57', '2017-01-04 21:48:35', 0, 0, 0, NULL, '', '', 0),
(183, 'bbrandt4073@gmail.com', 'brendan', 'f573c173e3b51ca1332315074db6e3d656c7bff7a1948616d5d443cfa335eee9', '', 1, '2017-01-05 00:36:28', '2017-01-05 00:37:38', 0, 0, 0, NULL, '', '', 0),
(184, 'rayfusion@hotmail.com', 'ricktheprick', '159f65ef1c5db0bc7f85ed3a9f5a5dbe6c52fabdaae6ae37d2d67dbd7833ab03', '', 1, '2017-01-05 01:47:00', '2017-01-05 01:47:35', 0, 0, 0, NULL, '', '', 0),
(185, 'abdulsamadpatel@gmail.com', 'Samy', '2b79d9da2fd5c80f7b653b911e2748cab0b592298a66efa9067ed639c47b0d02', '', 1, '2017-01-05 07:26:04', NULL, 0, 0, 0, NULL, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `message` varchar(128) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `priceNotify` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `owner_id`, `priceNotify`) VALUES
(14, 98, 500),
(10, 98, 240),
(15, 98, 490);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `owner_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `description` tinyint(4) DEFAULT NULL,
  `price` decimal(6,4) DEFAULT NULL,
  `amount` decimal(8,8) DEFAULT NULL,
  `timestamp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sentinel`
--

CREATE TABLE IF NOT EXISTS `sentinel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) DEFAULT NULL,
  `connect_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `request_type` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test_ledger`
--

CREATE TABLE IF NOT EXISTS `test_ledger` (
  `owner_id` int(11) NOT NULL DEFAULT '0',
  `btc` decimal(10,2) DEFAULT '5.00',
  `usd` decimal(10,2) DEFAULT '500.00',
  PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_ledger`
--

INSERT INTO `test_ledger` (`owner_id`, `btc`, `usd`) VALUES
(98, '3.00', '1386.40'),
(143, '5.00', '500.00'),
(145, '5.00', '500.00'),
(146, '5.00', '500.00'),
(147, '4.00', '921.34'),
(149, '5.00', '500.00'),
(150, '5.00', '500.00'),
(151, '5.00', '500.00'),
(152, '5.00', '500.00'),
(154, '5.00', '500.00'),
(155, '5.00', '500.00'),
(157, '5.00', '500.00'),
(158, '5.00', '500.00'),
(159, '0.00', '3375.00'),
(160, '5.00', '500.00'),
(162, '5.00', '500.00'),
(163, '0.00', '3702.95'),
(164, '0.00', '19.02'),
(165, '5.00', '500.00'),
(166, '0.00', '3662.60'),
(167, '5.00', '500.00'),
(168, '5.00', '500.00'),
(169, '5.00', '500.00'),
(170, '0.00', '3399.65'),
(171, '0.00', '3373.00'),
(172, '5.00', '500.00'),
(173, '0.00', '3494.45'),
(174, '5.00', '500.00'),
(176, '5.00', '500.00'),
(177, '5.00', '500.00'),
(178, '0.00', '4356.90'),
(179, '5.00', '500.00'),
(180, '5.00', '500.00'),
(182, '5.00', '500.00'),
(183, '5.00', '500.00'),
(184, '5.00', '500.00'),
(185, '5.00', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `ticker`
--

CREATE TABLE IF NOT EXISTS `ticker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` char(20) DEFAULT NULL,
  `exchange_id` int(11) DEFAULT NULL,
  `high` decimal(15,2) DEFAULT NULL,
  `last` decimal(14,2) DEFAULT NULL,
  `bid` decimal(15,2) DEFAULT NULL,
  `volume` decimal(10,4) DEFAULT NULL,
  `low` decimal(15,2) DEFAULT NULL,
  `ask` double DEFAULT NULL,
  `direction` int(11) DEFAULT NULL,
  `trend` int(11) DEFAULT NULL,
  `previous` decimal(14,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ticker`
--

INSERT INTO `ticker` (`id`, `currency`, `exchange_id`, `high`, `last`, `bid`, `volume`, `low`, `ask`, `direction`, `trend`, `previous`) VALUES
(1, 'btc', 1, '914.30', '899.89', '899.88', '8150.5687', '875.00', 901.59, -1, 1, '901.74'),
(2, 'eur', 1, '871.95', '864.00', '864.00', '595.6772', '836.91', 864.99, 0, 1, '864.00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(10) DEFAULT NULL,
  `price` decimal(10,6) DEFAULT NULL,
  `amount` decimal(16,8) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `fee` decimal(10,8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `owner_id`, `datetime`, `category`, `price`, `amount`, `currency`, `order_id`, `fee`) VALUES
(17, 63, '2016-03-12 16:11:02', 'buy', '408.000000', '0.10945000', 'BTC', 63, '0.00500000'),
(18, 63, '2016-03-12 16:11:02', 'buy', '408.000000', '0.10945000', 'BTC', 63, '0.00500000'),
(19, 63, '2016-03-18 15:20:04', 'buy', '407.810000', '0.10945000', 'BTC', 63, '0.00500000'),
(20, 63, '2016-03-29 12:05:03', 'buy', '410.820000', '47.46150000', 'BTC', 63, '0.00500000'),
(21, 63, '2016-04-26 17:07:04', 'buy', '467.000000', '48.82465000', 'BTC', 63, '0.00500000'),
(22, 63, '2016-05-27 15:51:05', 'sell', '472.770000', '58.88330021', 'BTC', 63, '0.00500000'),
(23, 63, '2016-06-25 17:24:05', 'buy', '644.010000', '58.55575000', 'BTC', 63, '0.00500000'),
(24, 63, '2016-07-02 09:33:05', 'sell', '688.330000', '62.58548977', 'BTC', 63, '0.00500000'),
(25, 63, '2016-07-07 04:31:03', 'buy', '642.280000', '62.25715000', 'BTC', 63, '0.00500000'),
(26, 63, '2016-11-02 00:40:05', 'sell', '724.370000', '70.21425617', 'BTC', 63, '0.00500000'),
(27, 63, '2016-11-04 02:46:03', 'buy', '698.350000', '69.96840000', 'BTC', 63, '0.00500000'),
(28, 63, '2016-11-04 03:01:04', 'buy', '698.220000', '0.16915000', 'BTC', 63, '0.00500000'),
(29, 63, '2016-11-16 12:56:14', 'sell', '738.980000', '74.03915996', 'BTC', 63, '0.00500000'),
(30, 63, '2016-11-26 10:07:08', 'buy', '727.980000', '73.64990000', 'BTC', 63, '0.00500000'),
(31, 63, '2016-11-27 01:30:04', 'buy', '724.000000', '0.17910000', 'BTC', 63, '0.00500000'),
(32, 63, '2016-11-30 09:30:06', 'sell', '738.500000', '74.71420747', 'BTC', 63, '0.00500000'),
(33, 63, '2017-01-04 19:15:05', 'buy', '1120.720000', '74.32650000', 'BTC', 63, '0.00500000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `exchange_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `owner_id` (`owner_id`),
  UNIQUE KEY `id` (`id`,`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `owner_id`, `api_key`, `exchange_id`) VALUES
(68, 63, 'bZ5IxHGM4LPAIjc+ypII0WE8GEYm0MhU6dC0PGXwjSYAnQ17Op4JuONhOKPPrQY7FwGbrPY2KBxai48OMYkQCtx8EVO7gX23NvmFalAc8Gd+xv8ZT/2/9/UwfJn4VsmKsPt5Oq9T9NGzqwnHnEXJ4rLeuy/nPvFa+jHXhE/92frACcOYjlur4QgynRbCMnf0X+tSwznKLxX7VcUC0e7Y/A==', 1),
(96, 143, NULL, 1),
(97, 145, NULL, 1),
(98, 146, NULL, 1),
(99, 147, NULL, 1),
(101, 149, NULL, 1),
(102, 150, NULL, 1),
(103, 151, NULL, 1),
(104, 152, NULL, 1),
(105, 154, NULL, 1),
(106, 155, NULL, 1),
(107, 157, NULL, 1),
(108, 158, NULL, 1),
(109, 159, NULL, 1),
(110, 160, NULL, 1),
(111, 162, NULL, 1),
(112, 163, NULL, 1),
(113, 164, NULL, 1),
(114, 165, NULL, 1),
(115, 166, NULL, 1),
(116, 167, NULL, 1),
(117, 168, NULL, 1),
(118, 169, NULL, 1),
(119, 113, 'HurP4fBCSje7i2yCXOnLI5PkKPHeCYo8AeiL8LdMbKY/6/GlRLGAdAQUMcfP8j/lzQanzrbWSGYgLnjpsy3E7/yLlov1ZaFZdXC3sADhd7LS2y9/UD9OFZllGtE42fTM/UhVuYbFIM7PJfJhzuDx1R4VWWAGoNQV2mt9+qrGs79eNHF3lGM3nhiqD+a5u2N3vzEzkIPXyDS4HDhwtzuAwg==', 1),
(120, 170, NULL, 1),
(121, 171, NULL, 1),
(122, 172, NULL, 1),
(123, 173, NULL, 1),
(124, 174, NULL, 1),
(125, 176, NULL, 1),
(126, 177, NULL, 1),
(127, 178, NULL, 1),
(128, 179, NULL, 1),
(129, 180, NULL, 1),
(130, 182, NULL, 1),
(131, 183, NULL, 1),
(132, 184, NULL, 1),
(133, 185, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userconfigs`
--

CREATE TABLE IF NOT EXISTS `userconfigs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `param` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `userconfigs`
--

INSERT INTO `userconfigs` (`id`, `owner_id`, `name`, `param`) VALUES
(1, 147, 'transNotify', 't'),
(2, 98, 'transNotify', 't');

-- --------------------------------------------------------

--
-- Table structure for table `validation`
--

CREATE TABLE IF NOT EXISTS `validation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `hash` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `validation`
--

INSERT INTO `validation` (`id`, `owner_id`, `hash`) VALUES
(38, 143, '5HONNa7NXeXIfit+ePQ/1bb1YjzFrgdOPiplFRqdtx81NifW3OnfNnz3ZUzo7aJXwHryyFcnedxBJWzIzCeQRRQSkRjKPx/zdy4fc/pEk7N9xZOz+VKTmXCJlmWuwYsWaXxRPdeUQM8OGhmue9+dMED6z2TzsF09etocezIR/cM='),
(39, 145, '7IWN5bZKCRaV86Him4u2a2C9oDoHgiDb3Juo4G/RdwiRQZWWrwSzbD/oC5RKZCSV4z7sxusf0R9N+uE178KOpQaYelx01cajuIQw01YQC2rxqtVObBKmiQw8XuFgI/QwH1T+sAcgOxDIJ6x4fgGJOZ+3cdNl/3XfLWGsaCvj+IU='),
(43, 149, 'y143i3M/+MeLoRVL9DwDT/KaTkFvzQSIf6zUozujL2b4eYzGyIGOQHU18Hk8tkI0SNfK+uBbevETGKwmGt272LayBpX4XB68e7lnRzOtfyPv9J/8YpHf/6BeQC6R4sEJAk70uR1rNbuAYwHc9Ay6Mk0RckztV8JO3SmcNfRhnfw='),
(47, 154, 'RO67fp0M5DCBNJZxwwDiyvVWXTclWZO5qOR86ZJF6Q80wlFCZS+11mhc/igafOhP+cQVnKLgdUar5RreMLxAZCclU4+Py9lJVjuGTbOVYU2QC5+dr5f7sZCltr19amJ904WL7ou+SOVccIvQrUqrF1lbWLZnXLrtgu3PXwthJDU='),
(49, 157, 'JNWili42AWGLI+/pA8e0j4zigior8PnyeTO/Arfovew7yJ/t+RVw8r660zQTHkUz/3ohgvhop2SPMjw6W8SwpFQpsjuNJ0pKxNn/13SzvAjOosa8qdjjOljSmVu6XjQqDUhGsQOKBkc/XNRyQkWOanHvwOKchLaR8l5OuH52fo4='),
(50, 158, 'VXgNHqdoyL5P7PjVv/J9hJHj7WWVtNZKUVoWBbTcDSAJRdUh4DlVfvdnqFjZWodqaoX6mMSp+mzoFx8YRcgrV96YH7V2gujIgFkKWsKBPGt6s7WYqSAi+QTyY2BxLzwgqHUe184pK8WWKeR3Lis1Qtap2XjuMFnnQS0ekD8O7Tg='),
(53, 162, 'V6PAdyi96/BYHXBDF3/AZfKISniZcCtbwsR6jK80Yn7tS3+VVGHhEc17NYJ1VOnLViV0NA8Y7j9fdTKPs6huJAegha6oDkAIApt4k7Bls10JE6R8k9voGcdka7gI+YxIdluCRGyKQtY3woaKLB/g+XfcAO7+vKMv+hJ4JuV7MMk='),
(56, 165, 'eWYnxsBYLgfU9gnaAtDqwZ2NmYVn+n8ur/tvCO/RdD25oKJdrjTJvKfVmP9/EK3uu1Ea6cOLkY1WcOeb47Y42jchHb/H4i9lgvBNXzyt3Za/L82Xgq+VzAWBEFdLhEX7t8AqdgiMe941znD5T9P5Ee0MB92O1NbUf8tSzydT8jQ='),
(58, 167, 'dNcyT56lUK8ofPfHCKLQqSVsboJQOFmAW2SYWNixf6r0J5o8Xz6nQKbc9deWmIB4+/7vghPKMXn8NbPOL4yTbfc53nERk1SPpeaYlAkc6feOuRik01pd4HVa6Itbh5khVIQfPs0i3D09asBer5YL7BNyvqaVcI7Q9mDAOIOJgJY='),
(63, 172, '2jbhT8Hkx5yUcR/yVPBqq5gw4ozxpn3wmk3jWI7NFaHHVpn/7aeiTyK4Pu6pojt6cSyHvRLDjCEqzE3+98ov/QjOno6Q2vGHxguZ9C1HlvCwMFolFAexM9CbTf0ZAX2PxMkUAuITtZ4Y2KqqeTuj8GowjXN8OZSg/yrqn1OH/UU='),
(64, 173, 'GnyKhiWqCIMCCKfb/1tOLgSFXqcw5S1oIMAsSvfKb+10j5ll3KDaht3/XBB+UZO/XerDlLQkTr7A8StO8HU3evswfS1KOxjcY4oNv3DCTCgKhS0DmGzMPmsofA480E+xVx6uElpDIHGlFOwL67vFJ1Zom9yWTxElW3wQU81ZGhU='),
(65, 174, 'pKfYuUjLxEhCFtj2YBCNtw8/sl2Nogh/q6H7WJcBEHONoFqlW7Ow1trasLrhpW7+vL+MOn1uRxsJKXnSyWW4ArtYQxV9y4p5BD/AtyRIgvxsgYiJJ/xO/3QGVtMERp8abCbNj9UwNflKeKAzhbniwTxQkoUjxhy50FbXVQ9CTIY='),
(66, 176, 'xV6Nf+lHMqQo9UuV1F3b2ZZ9DYsD+FaW+HBsVu3wRCBkFfsLspN9toQqGE/xts1yyL5Cs2fxaxsJWs/OYHmetUovaqKQsddQ7FOF8VnPFGR+FIIzRz2iYaQpvu7GQqcjSMdmDziXhv3c3jgXvNShsKGPgtiBHDsY1qHk+XG1e1c=');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE IF NOT EXISTS `wallet` (
  `owner_id` int(11) NOT NULL DEFAULT '0',
  `addr` varchar(40) NOT NULL,
  `sweep` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `address` (`addr`),
  UNIQUE KEY `address_2` (`addr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`owner_id`, `addr`, `sweep`) VALUES
(98, '13Tq6nHVyPygdGzRLms3qtgn2Yfgxdhnj1', 0),
(143, '12vEPwqJsjxLzWRK55DshpVb2DRcqBopas', 0),
(145, '1XVjGcfg2gL1L93BBFX8m1Yfk4Xj3Qggr', 0),
(146, '16G6uj4khoDamYtwbNtTwuHycHUdhFVD2o', 0),
(147, '16fyMN8iYnocwFA3x38fkN7t9MiPHqQ2qu', 0),
(151, '1JtAS5qjRe5HoQ5jiTnJFz24Zirgy7F63J', 0),
(149, '187QaBd9PRA9Web3FrhqjKBxhAeoyrcoa6', 0),
(150, '1DhDrN5s23xYMNfLHEEaneP66H8En41ckf', 0),
(152, '1CRFtsSqhAuUioakBdktyK9Gmca86EjRzt', 0),
(154, '1MiUWpe3b1FaQAdiuYLUGFNjk5nfeLrx8y', 0),
(155, '1LU7SydAX9q4LJonMSjm47ox1DGp3Fn1sr', 0),
(157, '1FBxvuJ8ZcE7cGhFVX2U7nWTF84MLmFCDA', 0),
(158, '1CkhbkFWxX5b78GQVyxASEaE9NboWtkT4p', 0),
(159, '18GRc5nshndYK42Fo8oyMuGaWtX5f7pX5X', 0),
(160, '1PrM6VU4SVXdDUF15QXWETt3yKQdxmdtXq', 0),
(162, '114T9XHnimHvTU3hWwQ2vLGZRAqrcJFf2E', 0),
(163, '1KXxxZPJLWwgKdUxgKvmygqq8nVbTiU5Dr', 0),
(164, '1PXbPY7aa93pUiz5Vyms7SrYFjQ7tNpAvy', 0),
(165, '168NP4RWzh5KEk8qKHhZN7HkPfJHTPneUd', 0),
(166, '179Qm4EFoF5hDYhRxo73QQ48NqAGQvAf7G', 0),
(167, '1544UJXEfLrS2D3dCutoLQMQH7ZXDGx9Ja', 0),
(168, '14Fc24BZEZEc3yhviXwjVkAS5HEtv2Yrgz', 0),
(169, '18aMit941Z2q6jW66SHgEJy7LQsD1qtiRj', 0),
(0, '1jTGADiwquZZiWLwiiHnLVupsiGN2yG7G', 0),
(0, '1BjFQsSeBkWE8kcc6K4z6WdT1h3HD7MHTr', 0),
(0, '16oYskEqmEJAEyjnhKBfijEiu5U2WZnNJW', 0),
(0, '1KvBWWLVAWrWMkCDqyh9vV9bmdEPGjpffJ', 0),
(0, '15ThgD9AosyRHxuhjDGjA34gBvXvBQRiWe', 0),
(0, '1yyHkJmgttUBMkmkky5gSDyFRi7ynRM2q', 0),
(0, '1LiNcgt1LnWGA1XHJ4mvnWpTKQApRCm9sP', 0),
(0, '1DfkUFfntJoo8MvES1KAnLyugGnNY2K6im', 0),
(0, '18TY8CrneLndw6RyA636iEjVxswwr63ShR', 0),
(0, '1Ddh71Aos267A5Wir2wymeybd7Q2nJSPYG', 0),
(0, '16wn56cTCNZyXy116fV8Uv7fxhTDu512Hc', 0),
(0, '13mi3WJkZhA4dyYWSfcQAc881TyumbPcTk', 0),
(0, '16JcGAwRH4KdCWk7NaFhr8EgobqAvMqx4o', 0),
(0, '1PeYrgMUpVzEAfeWukeQcaYKSKhvWz4vUt', 0),
(0, '18VWkKRvBoXYcLgNP82uAVei5LMsCyMd8W', 0),
(0, '149oauWJ2V8UwJCr6TgZjuAj2i7bmXxLW6', 0),
(0, '1AysLzaiBSGXjSGRf8bUH2etYVD6WKgXvk', 0),
(0, '19rVJrrygsxTS9QjcixeDLbH7EBMGFnKvB', 0),
(0, '1EWw9zTPWR5LNMNhLyp5Gc6JZiJz6wq1Qw', 0),
(0, '15V4Uj9tenTZo6MA4W8Xj79Emvjhv1ohEW', 0),
(0, '18VZgz5zXU3R16JhqGZq6uxyik4c3GR6ug', 0),
(0, '17bPRES23PgaJt59BVHjw6bX6hvHttwCiK', 0),
(0, '1FKfmz2fRGEPVbBb2sywzoQazQhWrDKLX2', 0),
(0, '13xDswgfm85TKXhwEmked6kUkHiNfdtbg1', 0),
(0, '17eV3Qf6hqeAxVV4FffJGiw3GwLZdXgn4P', 0),
(0, '1J9GtMNnfjA6RNEErMrcKtatU8HCuB8Hj4', 0),
(0, '124henz2b3JpFXiyhvnVzoXxw342zddFxv', 0),
(0, '1HJSg47ZTf7nu1vggmwDgPzgSaWFiHvFBE', 0),
(0, '1MLJ3QsMXUXtHDi1JJz91dpVJLekv5h3bE', 0),
(0, '16gBMfBFd53xrJANS2PXojSbEjGGYxPjLz', 0),
(0, '1PRjqj28TAtma4EFQ21uJmTCaTdci73AKP', 0),
(0, '1EG69fa6eaGTMmUC7BxNr7TJ1kGzNZE78E', 0),
(0, '166fQg2hwNdfCbbVkxfG92tUmwD4X2nHPK', 0),
(0, '1GV8K3wZajh1h4xycnZ3FvSPXdBotAhaJm', 0),
(0, '1ALGJ1JsusigonmetCJTALJa14dHjyFfwQ', 0),
(0, '12DN137YqZg1iW6yDocgzNxngXgyydft8H', 0),
(0, '13X4jyPT1LBjj7q2Qy6r3d21K81RFJMyPz', 0),
(0, '193t2j4ykPfvZ75z3LFKKzSRQpjytxvaRT', 0),
(0, '1KJTDf2hH3fUvVfJ544PysYNdpSeeMGUgF', 0),
(0, '1Eucj3EB7rqD6YowKmZtGd5zCfsnUzk9Ac', 0),
(0, '16ezBQGYkXa8pJNnMiqqyWKiqKppynLvyu', 0),
(0, '1N2JRjPiyuYcQNKPvSnenaWiyJB7RLJHk1', 0),
(0, '1HMrUheSarthx1ocnom3BY1Le1zui1u2Rs', 0),
(0, '1KPTmJqB4zpfAdwBBBxMmXpKgAkZxSHM1P', 0),
(0, '1D6NtzmRMc7yR5Nee2n1ZtyEZDbi4SfReN', 0),
(0, '1DmUZSCHGcDcZ85QAzB6QTqhbp8CGp2rnB', 0),
(0, '1AigUtVKjswcqpJ9uDp2greUzLUwaoL6jK', 0),
(0, '1H9CJPy7PNogAez3EHXPfvw3h9a4MDrkGG', 0),
(0, '1Nf2PkVXzs5BcxUHCPDidVW1omNjsmd4qz', 0),
(0, '18s5C9Wybqn7E7QEn3dfL3G1bPX6Eecfok', 0),
(0, '16mQSrX95GeJbsB4g448t43bUKtakFgLr9', 0),
(0, '1Hf1kHJnuUhgmBodL5hHT1FXihDRcFavrT', 0),
(0, '1HC4YBd88wM3pKkhnr99sKaSrHcczjpDYh', 0),
(0, '18cNECHU5uBja5E7569G4epTZZmQgLQG3P', 0),
(0, '14vFweTVemZTczKdpRs2Qs99KZKuLY25PD', 0),
(0, '1F9yQUPkwo3m9VnQGFLUQ4Ggt9dcdEEhGD', 0),
(0, '1F3gYEeF4qSFbtdJH1hG5p1X9MwcM5zCh1', 0),
(0, '1M6dCz86XMmaJ7JQg3sHov9oPKusFTGmBS', 0),
(0, '1AdUiC6K12V2KrCbbWefmTqiSX4EiQPn4Y', 0),
(0, '14AykznMuQa4fQNKPjCDKgJA3EpDZS2h5r', 0),
(0, '1AJ3Ur3haHYLHzATe4Le3DUetwQtCq25EQ', 0),
(0, '13xqQqjpFSjhMWDiDKsc3cEP5AiHuSShTm', 0),
(0, '1Cdg4Uu3eEV6HimqB5MbnkAMwmbVHjGfMF', 0),
(0, '1MtnGKzq6SgrZA5BQEKBJWaAXVxrjiceTi', 0),
(0, '13zQcCHzyxS5U5ZuSTtMTj4p7wgGNkrzu9', 0),
(0, '1Br62oNnvVr4j5cX2KBZrsTv2511CQvQ7X', 0),
(0, '1Lw8Q6J2UeLTV3A6D3bgESmXkfpSeAEM12', 0),
(0, '1B79Qg6wgUeK4JgyCSqpFmXsUAT8pEybut', 0),
(0, '1KuGJqBoP4DcgLzoXHNWiCafn34aChzPxW', 0),
(0, '12AcMoTYERR8t3J9rvRYVGvLJQUWyJkvqk', 0),
(0, '1GjxBH1yub5kbKKALTZZbeHyRwt2C2J8AM', 0),
(0, '19SsbSw1zmqEvzchg8iRrP6YCbctz3PGqN', 0),
(0, '1F6UfZeT61ZVVmKrwXMQE31DRrSTRaHFK1', 0),
(0, '18bsKT8YvA979sXj9971egDK36bCTSS8ig', 0),
(0, '166GXBMFqQifwvYDPvtNw4DJncHhR86r1k', 0),
(0, '1Hg98yJ7i8abBfSDeHLfABFHSBVZAzSH39', 0),
(0, '1HWPhPiX6c6Lod3J7DPx6NhqcgvECmNrhs', 0),
(0, '1PT7n9BNf3De8r9jNmxyZEbtDcyF4viZ9q', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
