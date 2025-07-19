-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2023 at 08:30 AM
-- Server version: 10.5.19-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `boosteds_boosted`
CREATE DATABASE IF NOT EXISTS `boosteds_boosted` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `boosteds_boosted`;

-- Table structure for table `admins`
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(225) DEFAULT NULL,
  `password` text NOT NULL,
  `register_date` datetime NOT NULL,
  `login_date` datetime DEFAULT NULL,
  `login_ip` varchar(225) DEFAULT NULL,
  `client_type` enum('1','2') NOT NULL DEFAULT '2' COMMENT '2 -> ON, 1 -> OFF',
  `access` enum('{"admin_access":"1","users":"1","orders":"1","subscriptions":"1","dripfeed":"1","services":"1","payments":"1","tickets":"1","reports":"1","general_settings":"1","pages":"1","payments_settings":"1","bank_accounts":"1","payments_bonus":"1","alert_settings":"1","providers":"1","themes":"1","child-panels":"1","language":"1","meta":"1","twice":"1","proxy":"1","kuponlar":"1","admins":"1"}') DEFAULT '{"admin_access":"1","users":"1","orders":"1","subscriptions":"1","dripfeed":"1","services":"1","payments":"1","tickets":"1","reports":"1","general_settings":"1","pages":"1","payments_settings":"1","bank_accounts":"1","payments_bonus":"1","alert_settings":"1","providers":"1","themes":"1","child-panels":"1","language":"1","meta":"1","twice":"1","proxy":"1","kuponlar":"1","admins":"1"}',
  `dream_id` int(11) NOT NULL,
  `mode` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `admins` (`admin_id`, `username`, `password`, `register_date`, `login_date`, `login_ip`, `client_type`, `access`, `dream_id`, `mode`) VALUES
(1, 'sillycoffin', 'Unic0rn$101123', '0000-00-00 00:00:00', '2023-04-17 13:19:24', '151.210.168.165', '2', '{\"admin_access\":\"1\",\"users\":\"1\",\"orders\":\"1\",\"subscriptions\":\"1\",\"dripfeed\":\"1\",\"services\":\"1\",\"payments\":\"1\",\"tickets\":\"1\",\"reports\":\"1\",\"general_settings\":\"1\",\"pages\":\"1\",\"payments_settings\":\"1\",\"bank_accounts\":\"1\",\"payments_bonus\":\"1\",\"alert_settings\":\"1\",\"providers\":\"1\",\"themes\":\"1\",\"child-panels\":\"1\",\"language\":\"1\",\"meta\":\"1\",\"twice\":\"1\",\"proxy\":\"1\",\"kuponlar\":\"1\",\"admins\":\"1\"}', 0, 'sun');

-- Truncated for brevity --
