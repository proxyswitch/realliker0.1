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

--
-- Database: `boosteds_boosted`
--
CREATE DATABASE IF NOT EXISTS `spot` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `spot`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

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

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `register_date`, `login_date`, `login_ip`, `client_type`, `access`, `dream_id`, `mode`) VALUES
(1, 'sillycoffin', 'Unic0rn$101123', '0000-00-00 00:00:00', '2023-04-17 13:19:24', '151.210.168.165', '2', '{\"admin_access\":\"1\",\"users\":\"1\",\"orders\":\"1\",\"subscriptions\":\"1\",\"dripfeed\":\"1\",\"services\":\"1\",\"payments\":\"1\",\"tickets\":\"1\",\"reports\":\"1\",\"general_settings\":\"1\",\"pages\":\"1\",\"payments_settings\":\"1\",\"bank_accounts\":\"1\",\"payments_bonus\":\"1\",\"alert_settings\":\"1\",\"providers\":\"1\",\"themes\":\"1\",\"child-panels\":\"1\",\"language\":\"1\",\"meta\":\"1\",\"twice\":\"1\",\"proxy\":\"1\",\"kuponlar\":\"1\",\"admins\":\"1\"}', 0, 'sun');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `image_file` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(225) NOT NULL,
  `bank_sube` varchar(225) NOT NULL,
  `bank_hesap` varchar(225) NOT NULL,
  `bank_iban` text NOT NULL,
  `bank_alici` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `published_at` datetime NOT NULL,
  `image_file` varchar(200) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `blog_get` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `published_at`, `image_file`, `status`, `blog_get`, `updated_at`) VALUES
(1, 'The Ultimate Guide to Choosing the Best SMM Panel for Your Social Media Marketing Needs', '<h1><b>The Ultimate Guide to Choosing the Best SMM Panel for Your Social Media Marketing Needs</b></h1><h4>Looking for the best SMM panel to boost your social media marketing game? Our ultimate guide covers everything you need to know to make an informed decision and find the perfect SMM panel for your business.</h4><p><br></p><h2><b>I. Introduction</b></h2><h3>Explanation of what SMM panels are and how they can benefit businesses</h3><p>Incorporating social media into a business\'s marketing strategy has become increasingly important in today\'s digital world. With the competition for attention on social media platforms, it\'s vital to find effective ways to stand out from the crowd. One such way is through the use of social media marketing (SMM) panels, which provide various services to boost engagement and increase brand awareness.</p><h3>A brief overview of what the post will cover</h3><p>In this post, we\'ll discuss the benefits of using an SMM panel and provide an overview of what to expect in this guide to choosing the best SMM panel for your business.</p><p><br></p><h2><b>II. Factors to consider when choosing an SMM panel</b></h2><p>Incorporating an SMM panel into your business\'s marketing strategy can be a great way to boost engagement and increase brand awareness. However, not all SMM panels are created equal, and choosing the right one for your business can be a daunting task. Here are some factors to consider when selecting an SMM panel:</p><h3>A. Pricing</h3><p>One of the most important factors to consider when choosing an SMM panel is pricing. It\'s crucial to choose a panel that offers transparent pricing, with clear and upfront costs for the services provided. Look for a panel that offers different package options to fit your budget, while still balancing quality with affordability.</p><h3>B. Features Offered</h3><p>Another important factor to consider is the range of features offered by the SMM panel. Look for a panel that provides a variety of services, such as likes, followers, comments, and views, across different social media platforms like Instagram, Facebook, Twitter, YouTube, and others.</p><h3>C. Customer Support</h3><p>Responsive and reliable customer support is essential when choosing an SMM panel. Look for a panel that provides multiple methods of contacting their customer support team, such as email, live chat, or phone support. It\'s also important to choose a panel that has a reputation for being prompt and helpful in resolving any issues or concerns.</p><h3>D. Reliability and Safety</h3><p>The marketing techniques used by the SMM panel should also be a consideration. Look for a panel with a proven track record of delivering quality services without violating the terms of service of the social media platforms. It\'s also important to choose a panel that takes measures to ensure the safety of your account and personal information. Do some research and read reviews to ensure that the panel you choose has a good reputation and is trustworthy.</p><p><br></p><h2><b>III. Evaluating and comparing SMM panels</b></h2><h3>A. Researching different SMM panels</h3><p>Once you\'ve identified the factors to consider when choosing an SMM panel, it\'s time to research different options available in the market. One way to start is by reading reviews and feedback from other customers who have used the panels you\'re interested in. This can give you an idea of the quality of services and customer support offered by the panel.</p><p>You should also explore the features and pricing of each panel. Consider the different package options available and assess whether they align with your marketing goals and budget.</p><h3>B. Choosing the best fit for your business</h3><p>After researching and evaluating different SMM panels, it\'s time to choose the one that best fits your business needs. This can be done by balancing the factors discussed in section II, such as pricing, features offered, customer support, and reliability.</p><p>Assess which panel offers the best value for your budget and marketing goals. Keep in mind that the cheapest option may not always be the best choice, as quality and reliability should also be considered. It\'s essential to choose an SMM panel that can deliver the desired results without compromising on safety and authenticity.</p><p><br></p><h2><b>IV. Conclusion</b></h2><p>In today\'s competitive digital landscape, social media marketing (SMM) has become a critical aspect of any business\'s marketing strategy. SMM panels can be incredibly beneficial in helping businesses boost their social media engagement and brand awareness. However, it\'s essential to choose the right <a href=\"https://boostedsmm.com/signup\">SMM panel</a> that suits your budget and marketing goals.</p><p>In this guide, we\'ve discussed the factors to consider when choosing an SMM panel, including pricing, features offered, customer support, reliability, and safety. We\'ve also discussed how to evaluate and compare different SMM panels to find the best fit for your business.</p><p>To recap, when selecting an SMM panel, take the time to research and compare different options thoroughly. Read reviews and feedback from other customers, explore the features and pricing of each panel, and assess which one offers the best value for your budget and marketing goals.</p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p>In conclusion, by choosing the right SMM panel, you can significantly enhance your social media marketing efforts and help your business thrive in today\'s digital world.</p>', '2023-02-24 04:55:20', 'https://imgtr.ee/images/2023/02/23/Rdd5m.png', '1', 'ultimate-guide-to-choosing-the-best-smm-panel', '2023-02-24 07:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `category_line` double NOT NULL,
  `category_type` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '2',
  `category_secret` enum('1','2') NOT NULL DEFAULT '2',
  `category_icon` text NOT NULL,
  `is_refill` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `categories`
--

-- Dumping data for table `categories`
INSERT INTO `categories`
  (`category_id`,`category_name`,`category_line`,`category_type`,`category_secret`,`category_icon`,`is_refill`)
VALUES
  (25, '⭐Instagram High Quality Followers | BEST QUALITY', 3, '2', '2', '', '');  -- semicolon ends the INSERT

-- --------------------------------------------------------
-- Table structure for table `childpanels`
CREATE TABLE `childpanels` (
  `id`              int(11)     NOT NULL,
  `client_id`       int(11)     NOT NULL,
  `domain`          varchar(191) NOT NULL,
  `currency`        varchar(191) NOT NULL,
  `child_username`  varchar(191) NOT NULL,
  `child_password`  varchar(191) NOT NULL,
  `charge`          double      NOT NULL,
  `status`          enum('Pending','Active','Frozen','Suspended') NOT NULL DEFAULT 'Pending',
  `renewal_date`    date        NOT NULL,
  `date_created`    datetime    NOT NULL,
  `dreampanel_id`   int(11)     NOT NULL,
  `keyc`            varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `email` varchar(225) NOT NULL,
  `username` varchar(225) DEFAULT NULL,
  `admin_type` enum('1','2') NOT NULL DEFAULT '2',
  `password` text NOT NULL,
  `telephone` varchar(225) DEFAULT NULL,
  `balance` decimal(21,7) NOT NULL,
  `balance_type` enum('1','2') NOT NULL DEFAULT '2',
  `debit_limit` double DEFAULT NULL,
  `spent` decimal(21,7) NOT NULL,
  `register_date` datetime NOT NULL,
  `login_date` datetime DEFAULT NULL,
  `login_ip` varchar(225) DEFAULT NULL,
  `apikey` text NOT NULL,
  `tel_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '2 -> ON, 1 -> OFF',
  `email_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '2 -> ON, 1 -> OFF',
  `client_type` enum('1','2') NOT NULL DEFAULT '2' COMMENT '2 -> ON, 1 -> OFF',
  `access` text DEFAULT NULL,
  `lang` varchar(255) NOT NULL DEFAULT 'tr',
  `timezone` double NOT NULL DEFAULT 0,
  `currency_type` enum('INR','USD') NOT NULL DEFAULT 'USD',
  `ref_code` text NOT NULL,
  `ref_by` text DEFAULT NULL,
  `change_email` enum('1','2') NOT NULL DEFAULT '2',
  `resend_max` int(11) NOT NULL,
  `currency` varchar(225) NOT NULL DEFAULT '1',
  `passwordreset_token` varchar(225) NOT NULL,
  `verified` enum('Yes','No') NOT NULL DEFAULT 'No',
  `coustm_rate` double NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `name`, `email`, `username`, `admin_type`, `password`, `telephone`, `balance`, `balance_type`, `debit_limit`, `spent`, `register_date`, `login_date`, `login_ip`, `apikey`, `tel_type`, `email_type`, `client_type`, `access`, `lang`, `timezone`, `currency_type`, `ref_code`, `ref_by`, `change_email`, `resend_max`, `currency`, `passwordreset_token`, `verified`, `coustm_rate`) VALUES
(21, '', 'pixie.nz@outlook.com', 'Veranofitness', '2', 'ff6979ad9bca61de6a66e1309601a3e3', '', '0.0000000', '2', NULL, '0.0000000', '2023-02-26 09:41:55', NULL, NULL, 'cba1b93f8f2a2453ec2629f24961ff48', '1', '2', '2', NULL, 'en', 0, 'USD', '2a987d', NULL, '2', 0, '1', '', 'No', 0),
(20, '', 'benjaminshand101@gmail.com', 'sillycoffin', '2', 'a6a4911a410b0944c4ea9cabe66751bd', '', '1.0000000', '2', NULL, '0.0000000', '2023-02-08 08:11:13', '2023-04-17 13:20:28', '151.210.168.165', '4bbb7b38afc2eab9cd74fb7c7f916f51', '1', '2', '2', NULL, 'en', 0, 'USD', '654c42', NULL, '2', 0, '1', '', 'No', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients_category`
--

CREATE TABLE `clients_category` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients_price`
--

CREATE TABLE `clients_price` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients_service`
--

CREATE TABLE `clients_service` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_report`
--

CREATE TABLE `client_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `report_ip` varchar(225) NOT NULL,
  `report_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `client_report`
--

INSERT INTO `client_report` (`id`, `client_id`, `action`, `report_ip`, `report_date`) VALUES
(23, 5, '\r\n    User registered.', '103.100.4.245', '2022-04-16 15:03:57'),
(98, 16, '\r\n    User registered.', '103.167.126.210', '2022-10-21 11:38:21'),
(99, 17, '\r\n    User registered.', '103.167.126.210', '2022-10-21 11:57:32'),
(100, 18, '\r\n    User registered.', '130.195.253.27', '2022-10-24 11:50:37'),
(101, 19, '\r\n    User registered.', '130.195.253.27', '2022-10-31 04:13:17'),
(102, 19, 'New support ticket created#10', '130.195.253.3', '2022-11-02 07:14:53'),
(103, 19, 'API Key changed', '130.195.253.3', '2022-11-02 07:17:02'),
(104, 18, 'Member logged in.', '151.210.173.154', '2023-02-07 06:56:46'),
(105, 20, '\r\n    User registered.', '151.210.173.154', '2023-02-08 08:11:13'),
(106, 20, 'Member logged in.', '151.210.173.154', '2023-02-08 08:11:21'),
(107, 20, 'Member logged in.', '151.210.173.154', '2023-02-11 06:20:40'),
(108, 20, 'Member logged in.', '151.210.173.154', '2023-02-11 11:49:25'),
(109, 20, 'Member logged in.', '151.210.173.154', '2023-02-14 08:40:28'),
(110, 20, 'Member logged in.', '151.210.173.154', '2023-02-15 04:34:57'),
(111, 20, 'Member logged in.', '203.211.104.136', '2023-02-16 09:48:48'),
(112, 20, 'Member logged in.', '203.211.105.102', '2023-02-23 13:12:41'),
(113, 20, 'Member logged in.', '203.211.105.102', '2023-02-24 02:13:10'),
(114, 20, 'Member logged in.', '203.211.105.102', '2023-02-24 06:10:03'),
(115, 21, '\r\n    User registered.', '118.93.254.66', '2023-02-26 09:41:55'),
(116, 20, 'Member logged in.', '203.211.105.102', '2023-02-28 08:15:04'),
(117, 20, 'Member logged in.', '203.211.105.102', '2023-02-28 08:17:09'),
(118, 20, 'Member logged in.', '203.211.105.102', '2023-02-28 09:08:30'),
(119, 20, 'Member logged in.', '203.211.105.102', '2023-03-07 09:34:21'),
(120, 20, 'Member logged in.', '203.211.107.65', '2023-04-01 08:37:09'),
(121, 20, 'Member logged in.', '151.210.168.165', '2023-04-17 13:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `symbol` text DEFAULT NULL,
  `value` double DEFAULT NULL,
  `name` varchar(225) NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `default` enum('2','1') NOT NULL DEFAULT '2',
  `nouse` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `symbol`, `value`, `name`, `status`, `default`, `nouse`) VALUES
(1, '$', 1, 'USD', '1', '1', '1'),
(6, '$', 1.582646, 'NZD', '1', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `earn`
--

CREATE TABLE `earn` (
  `earn_id` int(255) NOT NULL,
  `client_id` int(255) NOT NULL,
  `link` text NOT NULL,
  `earn_note` text NOT NULL,
  `status` enum('Pending','Under Review','Funds Granted','Rejected','Not Eligible') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `earn`
--

INSERT INTO `earn` (`earn_id`, `client_id`, `link`, `earn_note`, `status`) VALUES
(1, 1, '1', '', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `General_options`
--

CREATE TABLE `General_options` (
  `id` int(11) NOT NULL,
  `coupon_status` enum('1','2') NOT NULL DEFAULT '1',
  `updates_show` enum('1','2') NOT NULL DEFAULT '1',
  `panel_status` enum('Pending','Active','Frozen','Suspended') NOT NULL,
  `panel_orders` int(11) NOT NULL,
  `panel_thismonthorders` int(11) NOT NULL,
  `massorder` enum('1','2') NOT NULL DEFAULT '2',
  `balance_format` enum('0.0','0.00','0.000','0.0000') NOT NULL DEFAULT '0.0',
  `currency_format` enum('0','2','3','4') NOT NULL DEFAULT '3',
  `ticket_system` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `General_options`
--

INSERT INTO `General_options` (`id`, `coupon_status`, `updates_show`, `panel_status`, `panel_orders`, `panel_thismonthorders`, `massorder`, `balance_format`, `currency_format`, `ticket_system`) VALUES
(1, '', '2', 'Active', 1024, 20, '2', '', '4', '2');

-- --------------------------------------------------------

--
-- Table structure for table `integrations`
--

CREATE TABLE `integrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `method_get` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `method_type` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '2' COMMENT '2 -> ON, 1 -> OFF	',
  `method_extras` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `method_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `method_line` double NOT NULL,
  `link` text NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kuponlar`
--

CREATE TABLE `kuponlar` (
  `id` int(11) NOT NULL,
  `kuponadi` varchar(255) NOT NULL,
  `adet` int(11) NOT NULL,
  `tutar` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kupon_kullananlar`
--

CREATE TABLE `kupon_kullananlar` (
  `id` int(11) NOT NULL,
  `uye_id` int(11) NOT NULL,
  `kuponadi` varchar(255) NOT NULL,
  `tutar` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language_name` varchar(225) NOT NULL,
  `language_code` varchar(225) NOT NULL,
  `language_type` enum('2','1') NOT NULL DEFAULT '2',
  `default_language` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `language_code`, `language_type`, `default_language`) VALUES
(1, 'Türkçe', 'tr', '1', '0'),
(2, 'English', 'en', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `Mailforms`
--

CREATE TABLE `Mailforms` (
  `id` int(11) NOT NULL,
  `subject` varchar(225) NOT NULL,
  `message` varchar(225) NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `header` varchar(225) NOT NULL,
  `footer` varchar(225) NOT NULL,
  `type` enum('Admins','Users') NOT NULL DEFAULT 'Users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `menu_line` double NOT NULL,
  `type` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '2',
  `slug` varchar(225) NOT NULL DEFAULT '2',
  `icon` varchar(225) DEFAULT NULL,
  `menu_status` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `visible` enum('Internal','External') NOT NULL DEFAULT 'Internal',
  `active` varchar(225) NOT NULL,
  `tiptext` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `menu_line`, `type`, `slug`, `icon`, `menu_status`, `visible`, `active`, `tiptext`) VALUES
(1, 'New Order', 2, '2', '/', 'fas fa-cart-arrow-down', '1', 'Internal', 'neworder', ''),
(2, 'Mass Order', 4, '2', '/massorder', 'fas fa-cart-plus', '1', 'Internal', 'massorder', 'Shown only if Mass Order system enabled for use'),
(3, 'Orders ', 5, '2', '/orders', 'fas fa-server', '1', 'Internal', 'orders', ''),
(4, 'Refill', 6, '2', '/refill', 'fas fa-recycle', '1', 'Internal', 'refill', 'Shown only if user have at least one refill task'),
(5, 'Login', 1, '2', '/', 'fas fa-address-card', '1', 'External', 'login', ''),
(6, 'Services', 7, '2', '/services', 'fas fa-cogs', '1', 'Internal', 'services', ''),
(7, 'Add Funds', 8, '2', '/addfunds', 'fas fa-credit-card', '1', 'Internal', 'addfunds', ''),
(8, 'Api', 10, '2', '/api', 'fas fa-code', '1', 'Internal', 'api', ''),
(9, 'Tickets ', 9, '2', '/tickets', 'fas fa-headset', '1', 'Internal', 'tickets', ''),
(10, 'Child Panels', 11, '2', '/child-panels', 'fas fa-child', '1', 'Internal', 'child-panels', 'Shown only if child panels selling enabled'),
(11, 'Refer & Earn', 12, '2', '/refer', 'fas fa-bezier-curve', '1', 'Internal', 'refer', 'Shown only if affiliate system enabled for use'),
(13, 'Terms', 13, '2', '/terms', 'fas fa-exclamation-triangle', '1', 'Internal', 'terms', ''),
(14, 'Signup ', 2, '2', '/signup', 'fas fa-arrow-right', '1', 'External', 'signup', 'Shown only if Signup system enabled for use'),
(15, 'Api', 4, '2', '/api', 'fas fa-code', '1', 'External', 'api', ''),
(17, 'Updates', 1, '2', '/updates', 'fas fa-bell', '1', 'Internal', '', 'Shown only if Updates System enabled'),
(18, 'Terms', 3, '2', '/terms', 'fas fa-exclamation-triangle', '1', 'External', 'terms', ''),
(21, 'Blogs', 3, '2', '/blog', 'fas fa-grip-vertical', '1', 'Internal', 'blog', ''),
(22, 'Earn', 14, '2', '/earn', 'fas fa-video', '1', 'Internal', '', 'Shown only if Updates System enabled'),
(23, 'Services', 14, '2', '/services', 'fas fa-server', '1', 'External', 'services', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_popup`
--

CREATE TABLE `notifications_popup` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `action_link` text NOT NULL,
  `isAllPage` enum('0','1') NOT NULL DEFAULT '0',
  `isAllUser` enum('1','0') NOT NULL DEFAULT '0',
  `expiry_date` date NOT NULL,
  `status` enum('1','2','0') NOT NULL DEFAULT '1',
  `allPages` varchar(225) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `action_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `api_orderid` int(11) NOT NULL DEFAULT 0,
  `order_error` text NOT NULL,
  `order_detail` text DEFAULT NULL,
  `order_api` int(11) NOT NULL DEFAULT 0,
  `api_serviceid` int(11) NOT NULL DEFAULT 0,
  `api_charge` double NOT NULL DEFAULT 0,
  `api_currencycharge` double DEFAULT 1,
  `order_profit` double NOT NULL,
  `order_quantity` double NOT NULL,
  `order_extras` text NOT NULL,
  `order_charge` double NOT NULL,
  `dripfeed` enum('1','2','3') DEFAULT '1' COMMENT '2 -> ON, 1 -> OFF',
  `dripfeed_id` double NOT NULL DEFAULT 0,
  `subscriptions_id` double NOT NULL DEFAULT 0,
  `subscriptions_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '2 -> ON, 1 -> OFF',
  `dripfeed_totalcharges` double DEFAULT NULL,
  `dripfeed_runs` double DEFAULT NULL,
  `dripfeed_delivery` double NOT NULL DEFAULT 0,
  `dripfeed_interval` double DEFAULT NULL,
  `dripfeed_totalquantity` double DEFAULT NULL,
  `dripfeed_status` enum('active','completed','canceled') NOT NULL DEFAULT 'active',
  `order_url` text NOT NULL,
  `order_start` double NOT NULL DEFAULT 0,
  `order_finish` double NOT NULL DEFAULT 0,
  `order_remains` double NOT NULL DEFAULT 0,
  `order_create` datetime NOT NULL,
  `order_status` enum('pending','inprogress','completed','partial','processing','canceled') NOT NULL DEFAULT 'pending',
  `subscriptions_status` enum('active','paused','completed','canceled','expired','limit') NOT NULL DEFAULT 'active',
  `subscriptions_username` text DEFAULT NULL,
  `subscriptions_posts` double DEFAULT NULL,
  `subscriptions_delivery` double NOT NULL DEFAULT 0,
  `subscriptions_delay` double DEFAULT NULL,
  `subscriptions_min` double DEFAULT NULL,
  `subscriptions_max` double DEFAULT NULL,
  `subscriptions_expiry` date DEFAULT NULL,
  `last_check` datetime NOT NULL,
  `order_where` enum('site','api') NOT NULL DEFAULT 'site',
  `refill_status` enum('Pending','Refilling','Completed','Rejected','Error') NOT NULL DEFAULT 'Pending',
  `is_refill` enum('1','2') NOT NULL DEFAULT '1',
  `refill` varchar(225) NOT NULL DEFAULT '1',
  `cancelbutton` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 -> ON, 2 -> OFF',
  `show_refill` enum('true','false') NOT NULL DEFAULT 'true',
  `api_refillid` double NOT NULL DEFAULT 0,
  `avg_done` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `client_id`, `service_id`, `api_orderid`, `order_error`, `order_detail`, `order_api`, `api_serviceid`, `api_charge`, `api_currencycharge`, `order_profit`, `order_quantity`, `order_extras`, `order_charge`, `dripfeed`, `dripfeed_id`, `subscriptions_id`, `subscriptions_type`, `dripfeed_totalcharges`, `dripfeed_runs`, `dripfeed_delivery`, `dripfeed_interval`, `dripfeed_totalquantity`, `dripfeed_status`, `order_url`, `order_start`, `order_finish`, `order_remains`, `order_create`, `order_status`, `subscriptions_status`, `subscriptions_username`, `subscriptions_posts`, `subscriptions_delivery`, `subscriptions_delay`, `subscriptions_min`, `subscriptions_max`, `subscriptions_expiry`, `last_check`, `order_where`, `refill_status`, `is_refill`, `refill`, `cancelbutton`, `show_refill`, `api_refillid`, `avg_done`) VALUES
(4, 5, 68, 0, '-', NULL, 0, 0, 0, 1, 10, 100, '', 10, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'httpybuiolkh', 0, 0, 0, '2022-05-13 23:50:14', 'canceled', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-05-13 23:50:14', 'site', 'Pending', '1', '1', '1', 'true', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(225) NOT NULL,
  `page_get` varchar(225) NOT NULL,
  `page_content` text NOT NULL,
  `page_status` enum('1','2') NOT NULL DEFAULT '1',
  `active` enum('1','2') NOT NULL DEFAULT '1',
  `seo_title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `seo_keywords` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `seo_description` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `last_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_name`, `page_get`, `page_content`, `page_status`, `active`, `seo_title`, `seo_keywords`, `seo_description`, `last_modified`) VALUES
(1, 'Account', 'account', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(2, 'Add funds', 'addfunds', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(3, 'Affiliates', 'refer', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(4, 'Api', 'api', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(5, 'Blog', 'blog', '', '1', '1', '', '', '', '2023-02-09 08:29:21'),
(6, 'Login', 'auth', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(7, 'Child Panels', 'child-panels', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(8, 'Mass Order', 'massorder', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(9, 'New Order', 'neworder', '<p><br></p>', '2', '1', '', '', '', '2022-04-16 12:05:27'),
(10, 'Orders', 'orders', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(11, 'Refill', 'refill', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(12, 'Services', 'services', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(13, 'Sign Up', 'signup', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(14, 'Terms', 'terms', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(15, 'Tickets', 'tickets', '', '2', '1', '', '', '', '0000-00-00 00:00:00'),
(16, 'Updates', 'updates', '<p><br></p>', '2', '1', '', '', '', '2022-04-14 02:34:02'),
(17, 'Earn', 'earn', '', '2', '1', '', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `panel_info`
--

CREATE TABLE `panel_info` (
  `panel_id` int(11) NOT NULL,
  `panel_domain` text NOT NULL,
  `panel_plan` text NOT NULL,
  `panel_status` enum('Pending','Active','Frozen','Suspended') NOT NULL,
  `panel_orders` int(11) NOT NULL,
  `panel_thismonthorders` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `api_key` varchar(225) NOT NULL,
  `renewal_date` datetime NOT NULL,
  `panel_type` enum('Child','Main') NOT NULL DEFAULT 'Main'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_balance` double NOT NULL DEFAULT 0,
  `payment_amount` double NOT NULL,
  `payment_privatecode` double DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_status` enum('1','2','3') NOT NULL DEFAULT '1',
  `payment_delivery` enum('1','2') NOT NULL DEFAULT '1',
  `payment_note` text NOT NULL,
  `payment_mode` enum('Manuel','Otomatik','Auto') NOT NULL DEFAULT 'Otomatik',
  `payment_create_date` datetime NOT NULL,
  `payment_update_date` datetime NOT NULL,
  `payment_ip` varchar(225) NOT NULL,
  `payment_extra` text NOT NULL,
  `payment_bank` int(11) NOT NULL,
  `t_id` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `client_id`, `client_balance`, `payment_amount`, `payment_privatecode`, `payment_method`, `payment_status`, `payment_delivery`, `payment_note`, `payment_mode`, `payment_create_date`, `payment_update_date`, `payment_ip`, `payment_extra`, `payment_bank`, `t_id`) VALUES
(25, 5, 0, 100, NULL, 12, '1', '1', '', 'Auto', '2022-05-13 19:23:31', '0000-00-00 00:00:00', '185.203.122.69', 'efb9f1ac985da07cfb3969c8eb3d1a01', 0, NULL),
(26, 5, 0, 200, NULL, 1, '3', '2', 'whar', 'Manuel', '2022-05-13 19:28:59', '2022-05-13 19:28:59', '', '', 0, NULL),
(27, 18, 0, 100, NULL, 2, '1', '1', '', 'Auto', '2022-10-24 11:52:22', '0000-00-00 00:00:00', '130.195.253.27', '9629bb215d04ac09a1132a08d97ec31d', 0, NULL),
(28, 18, 0, 10, NULL, 2, '1', '1', '', 'Auto', '2022-10-24 11:56:25', '0000-00-00 00:00:00', '130.195.253.27', '95cb138d9005e6c84db889a983fe067b', 0, NULL),
(29, 19, 0, 10, NULL, 9, '1', '1', '', 'Auto', '2022-10-31 04:13:45', '0000-00-00 00:00:00', '130.195.253.27', '1ee8f14f1e7154840515a3d8cd5c0252', 0, NULL),
(30, 19, 0, 10, NULL, 12, '1', '1', '', 'Auto', '2022-10-31 04:13:55', '0000-00-00 00:00:00', '130.195.253.27', '255866edf16f3dd9e87bfdba5e329905', 0, NULL),
(31, 19, 0, 10, NULL, 23, '1', '1', '', 'Auto', '2022-10-31 04:14:10', '0000-00-00 00:00:00', '130.195.253.27', '1667169850', 0, NULL),
(32, 19, 0, 10, NULL, 2, '1', '1', '', 'Auto', '2022-10-31 04:14:24', '0000-00-00 00:00:00', '130.195.253.27', 'a0abd91853146a79d53946ed3db633d3', 0, NULL),
(33, 19, 0, 90, NULL, 2, '1', '1', '', 'Auto', '2022-10-31 04:55:59', '0000-00-00 00:00:00', '130.195.253.27', 'b55b698cd466855ddee574af64353300', 0, NULL),
(34, 20, 0, 66, NULL, 2, '1', '1', '', 'Auto', '2023-02-08 08:16:41', '0000-00-00 00:00:00', '151.210.173.154', 'bbe96a61103738cc502d21606d61a354', 0, NULL),
(35, 20, 0, 1, NULL, 1, '3', '2', 'Approved', 'Manuel', '2023-02-28 08:16:09', '2023-02-28 08:16:09', '', '', 0, NULL),
(36, 20, 0, 55, NULL, 2, '1', '1', '', 'Auto', '2023-04-17 15:11:37', '0000-00-00 00:00:00', '151.210.168.165', 'bb5af52875d27618582cbf0249a6aae5', 0, NULL),
(37, 20, 0, 55, NULL, 26, '1', '1', '', 'Auto', '2023-04-17 15:12:54', '0000-00-00 00:00:00', '151.210.168.165', '64128eace36ac94db621', 0, NULL),
(38, 20, 0, 55, NULL, 12, '1', '1', '', 'Auto', '2023-04-17 15:21:02', '0000-00-00 00:00:00', '151.210.168.165', '8604ea8ecf71f6f9fb27f5c99625783a', 0, NULL),
(39, 20, 0, 55, NULL, 26, '1', '1', '', 'Auto', '2023-04-17 15:21:50', '0000-00-00 00:00:00', '151.210.168.165', '593c83a7745ec0c41b0d', 0, NULL),
(40, 20, 0, 55, NULL, 23, '1', '1', '', 'Auto', '2023-04-17 15:24:15', '0000-00-00 00:00:00', '151.210.168.165', '1681725255', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments_bonus`
--

CREATE TABLE `payments_bonus` (
  `bonus_id` int(11) NOT NULL,
  `bonus_method` int(11) NOT NULL,
  `bonus_from` double NOT NULL,
  `bonus_amount` double NOT NULL,
  `bonus_type` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `method_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `method_get` varchar(225) NOT NULL,
  `method_min` double NOT NULL,
  `method_max` double NOT NULL,
  `method_type` enum('1','2') NOT NULL DEFAULT '2' COMMENT '2 -> ON, 1 -> OFF	',
  `method_extras` text NOT NULL,
  `method_line` double NOT NULL,
  `nouse` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_name`, `method_get`, `method_min`, `method_max`, `method_type`, `method_extras`, `method_line`, `nouse`) VALUES
(1, 'Paypal', 'paypal', 10, 5000, '2', '{\"method_type\":\"2\",\"name\":\"PayPal | Minimum $10\",\"min\":\"10\",\"max\":\"5000\",\"business_email\":\"sillycoffinmgmt@gmail.com\",\"fee\":\"5\",\"currency\":\"USD\"}', 1, '2'),
(2, 'Stripe', 'stripe', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Stripe\",\"min\":\"10\",\"max\":\"1000\",\"stripe_publishable_key\":\"\",\"stripe_secret_key\":\"\",\"stripe_webhooks_secret\":\"\",\"fee\":\"\",\"currency\":\"\"}', 2, '2'),
(3, 'Shopier', 'shopier', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Kredi \\/ Banka Kart\\u0131 ile \\u00d6de\",\"min\":\"10\",\"max\":\"1000\",\"apiKey\":\"\",\"apiSecret\":\"\",\"website_index\":\"1\",\"processing_fee\":\"1\",\"fee\":\"\",\"currency\":\"\"}', 3, '2'),
(5, 'Paywant', 'paywant', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Paywant\",\"min\":\"10\",\"max\":\"1000\",\"apiKey\":\"\",\"apiSecret\":\"\",\"fee\":\"\",\"currency\":\"\",\"commissionType\":\"2\",\"payment_type\":[\"1\",\"2\",\"3\"]}', 4, '2'),
(7, 'PayTR', 'paytr', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Paytr\",\"min\":\"10\",\"max\":\"1000\",\"merchant_id\":\"\",\"merchant_key\":\"\",\"merchant_salt\":\"\",\"fee\":\"\",\"currency\":\"\"}', 5, '2'),
(8, 'Coinpayments', 'coinpayments', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Coinpayments\",\"min\":\"10\",\"max\":\"1000\",\"coinpayments_public_key\":\"3bb9fda8177581272dda32489bd0b4f57c1678d02c71e77ca5e8b8e214929929\",\"coinpayments_private_key\":\"088a8F63077D40bf1806ff7Eb40e4fc672e20D0f6eB6c04136A2ac168BC93802\",\"coinpayments_currency\":\"BTC\",\"merchant_id\":\"c9c5a59f1b875aad03c44a2117eec681\",\"ipn_secret\":\"a56864A1A94f093d5043aE0ac9E98ac371473390fd8eee639Ab382Ecf5bf4290\",\"fee\":\"5\",\"currency\":\"USD\"}', 6, '2'),
(9, '2checkout', '2checkout', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"2checkout\",\"min\":\"10\",\"max\":\"1000\",\"seller_id\":\"\",\"private_key\":\"\",\"fee\":\"\",\"currency\":\"\"}', 7, '2'),
(10, 'Payoneer', 'payoneer', 0, 0, '2', '{\"method_type\":\"2\",\"name\":\"Payoneer\",\"email\":\"\"}', 8, '2'),
(11, 'Mollie', 'mollie', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Mollie\",\"min\":\"10\",\"max\":\"1000\",\"live_api_key\":\"\",\"fee\":\"\",\"currency\":\"\"}', 9, '2'),
(12, 'PayTM', 'paytm', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"PayTM\",\"min\":\"10\",\"max\":\"1000\",\"merchant_key\":\"\",\"merchant_mid\":\"\",\"merchant_website\":\"\",\"fee\":\"\",\"currency\":\"\"}', 10, '2'),
(13, 'Instamojo', 'instamojo', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Instamojo\",\"min\":\"10\",\"max\":\"1000\",\"api_key\":\"\",\"live_auth_token_key\":\"\",\"fee\":\"\",\"currency\":\"\"}', 12, '2'),
(14, 'Paytm Business', 'paytmqr', 10, 1000, '1', '{\"method_type\":\"2\",\"name\":\"Paytm Business\",\"min\":\"10\",\"max\":\"1000\",\"merchant_key\":\"https:\\/\\/i.imgur.com\\/dl9NA0r.jpg\",\"merchant_mid\":\"\",\"merchant_website\":\"DEFAULT\",\"fee\":\"\"}', 11, '2'),
(15, 'Razorpay', 'razorpay', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Razorpay\",\"min\":\"10\",\"max\":\"1000\",\"api_key\":\"\",\"api_secret_key\":\"\",\"fee\":\"\",\"currency\":\"\"}', 13, '2'),
(16, 'Iyzico', 'iyzico', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Iyzico\",\"min\":\"10\",\"max\":\"1000\",\"api_key\":\"\",\"api_secret_key\":\"\",\"fee\":\"\",\"currency\":\"\"}', 14, '2'),
(17, 'Authorize.net', 'authorize-net', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Authorize.net\",\"min\":\"10\",\"max\":\"1000\",\"api_login_id\":\"\",\"secret_transaction_key\":\"\",\"fee\":\"\",\"currency\":\"\"}', 15, '2'),
(20, 'Ravepay', 'ravepay', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Ravepay\",\"min\":\"10\",\"max\":\"1000\",\"public_api_key\":\"\",\"secret_api_key\":\"\",\"fee\":\"\",\"currency\":\"\"}', 18, '2'),
(21, 'Pagseguro', 'pagseguro', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Pagseguro\",\"min\":\"10\",\"max\":\"1000\",\"email_id\":\"\",\"live_production_token\":\"\",\"fee\":\"\",\"currency\":\"\"}', 19, '2'),
(22, 'Cashmaal', 'Cashmaal', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Cashmaal\",\"min\":\"10\",\"max\":\"1000\",\"web_id\":\"\",\"fee\":\"\",\"currency\":\"USD\"}', 20, '2'),
(23, 'Perfect Money', 'Perfect Money', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Perfect Money USD \",\"min\":\"1\",\"max\":\"10000\",\"passphrase\":\"\",\"usd\":\"\",\"merchant_website\":\"\",\"fee\":\"0\"}', 12, '2'),
(25, 'Refer & earn', 'refer', 0, 0, '1', '{\"method_type\":\"2\",\"name\":\"Do Not Use\",\"min\":\"1\",\"max\":\"10000\",\"merchant_key\":\"P#n%aKfB3&DRAMqH\",\"merchant_mid\":\"DBWvgX98800736620578\",\"merchant_website\":\"DEFAULT\",\"fee\":\"0\",\"currency\":\"\"}', 25, '1'),
(26, 'payumoney', 'payumoney', 10, 1000, '2', '{\"method_type\":\"2\",\"name\":\"Payumoney\",\"min\":\"10\",\"max\":\"1000\",\"merchant_key\":\"\",\"salt\":\"\",\"fee\":\"\",\"currency\":\"\"}', 17, '2'),
(30, 'Freebalance', 'Freebalance', 1, 0, '1', '{\"method_type\":\"1\",\"name\":\"Freebalance\",\"min\":\"1\",\"max\":\"0\",\"merchant_id\":\"\",\"merchant_key\":\"\",\"merchant_salt\":\"\",\"fee\":\"0\"}', 30, '1');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `referral_id` int(11) NOT NULL,
  `referral_client_id` int(11) NOT NULL,
  `referral_clicks` double NOT NULL DEFAULT 0,
  `referral_sign_up` double NOT NULL DEFAULT 0,
  `referral_totalFunds_byReffered` double NOT NULL DEFAULT 0,
  `referral_earned_commision` double DEFAULT 0,
  `referral_requested_commision` varchar(225) DEFAULT '0',
  `referral_total_commision` double DEFAULT 0,
  `referral_status` enum('1','2') NOT NULL DEFAULT '1',
  `referral_code` text NOT NULL,
  `referral_rejected_commision` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `referral`
--

INSERT INTO `referral` (`referral_id`, `referral_client_id`, `referral_clicks`, `referral_sign_up`, `referral_totalFunds_byReffered`, `referral_earned_commision`, `referral_requested_commision`, `referral_total_commision`, `referral_status`, `referral_code`, `referral_rejected_commision`) VALUES
(1, 1, 0, 0, 0, 0, '0', 0, '1', 'b96ede', 0),
(2, 2, 0, 0, 0, 0, '0', 0, '1', '08aa15', 0),
(3, 3, 0, 0, 0, 0, '0', 0, '1', '8a8c4c', 0),
(4, 5, 0, 0, 0, 0, '0', 0, '1', '4b4236', 0),
(5, 6, 0, 0, 0, 0, '0', 0, '1', '2da7df', 0),
(6, 7, 0, 0, 0, 0, '0', 0, '1', '62b3a3', 0),
(7, 8, 0, 0, 0, 0, '0', 0, '1', 'f85a2f', 0),
(8, 9, 0, 0, 0, 0, '0', 0, '1', 'af38b9', 0),
(9, 10, 0, 0, 0, 0, '0', 0, '1', '6738c8', 0),
(10, 11, 0, 0, 0, 0, '0', 0, '1', '850c25', 0),
(11, 12, 0, 0, 0, 0, '0', 0, '1', '8efda7', 0),
(12, 13, 0, 0, 0, 0, '0', 0, '1', '7a0db5', 0),
(13, 14, 0, 0, 0, 0, '0', 0, '1', 'f18e54', 0),
(14, 15, 0, 0, 0, 0, '0', 0, '1', '0f5eed', 0),
(15, 16, 0, 0, 0, 0, '0', 0, '1', '5f1c30', 0),
(16, 17, 0, 0, 0, 0, '0', 0, '1', '69c742', 0),
(17, 18, 0, 0, 0, 0, '0', 0, '1', '8e7a0c', 0),
(18, 19, 0, 0, 0, 0, '0', 0, '1', '2aa524', 0),
(19, 20, 0, 0, 0, 0, '0', 0, '1', '654c42', 0),
(20, 21, 0, 0, 0, 0, '0', 0, '1', '2a987d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `referral_payouts`
--

CREATE TABLE `referral_payouts` (
  `r_p_id` int(11) NOT NULL,
  `r_p_code` text NOT NULL,
  `r_p_status` enum('1','2','3','4','0') NOT NULL DEFAULT '0',
  `r_p_amount_requested` double NOT NULL,
  `r_p_requested_at` datetime NOT NULL,
  `r_p_updated_at` datetime NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `referral_payouts`
--

INSERT INTO `referral_payouts` (`r_p_id`, `r_p_code`, `r_p_status`, `r_p_amount_requested`, `r_p_requested_at`, `r_p_updated_at`, `client_id`) VALUES
(1, 'b96ede', '3', 0, '2022-04-14 21:21:10', '2022-04-16 14:54:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `refill_status`
--

CREATE TABLE `refill_status` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `refill_apiid` int(11) DEFAULT NULL,
  `order_url` text NOT NULL,
  `creation_date` datetime DEFAULT NULL,
  `ending_date` date DEFAULT NULL,
  `service_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `refill_status` enum('Pending','Refilling','Completed','Rejected','Error') DEFAULT 'Pending',
  `order_apiid` int(11) DEFAULT 0,
  `refill_response` text DEFAULT NULL,
  `refill_where` enum('site','api') DEFAULT 'site'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `serviceapi_alert`
--

CREATE TABLE `serviceapi_alert` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `serviceapi_alert` text NOT NULL,
  `servicealert_extra` text NOT NULL,
  `servicealert_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_api` int(11) NOT NULL DEFAULT 0,
  `api_service` int(11) NOT NULL DEFAULT 0,
  `api_servicetype` enum('1','2') NOT NULL DEFAULT '2',
  `api_detail` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_line` double NOT NULL,
  `service_type` enum('1','2') NOT NULL DEFAULT '2',
  `service_package` enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17') NOT NULL,
  `service_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `service_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `service_price` varchar(225) NOT NULL,
  `service_min` double NOT NULL,
  `service_max` double NOT NULL,
  `service_dripfeed` enum('1','2') NOT NULL DEFAULT '1',
  `service_autotime` double NOT NULL DEFAULT 0,
  `service_autopost` double NOT NULL DEFAULT 0,
  `service_speed` enum('1','2','3','4') NOT NULL,
  `want_username` enum('1','2') NOT NULL DEFAULT '1',
  `service_secret` enum('1','2') NOT NULL DEFAULT '2',
  `price_type` enum('normal','percent','amount') NOT NULL DEFAULT 'normal',
  `price_cal` text DEFAULT NULL,
  `instagram_second` enum('1','2') NOT NULL DEFAULT '2',
  `start_count` enum('none','instagram_follower','instagram_photo','') NOT NULL,
  `instagram_private` enum('1','2') NOT NULL,
  `name_lang` varchar(225) DEFAULT 'en',
  `description_lang` text DEFAULT NULL,
  `time_lang` varchar(225) NOT NULL DEFAULT 'Not enough data',
  `time` varchar(225) NOT NULL DEFAULT 'Not enough data',
  `cancelbutton` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1 -> ON, 2 -> OFF',
  `show_refill` enum('true','false') NOT NULL DEFAULT 'false',
  `service_profit` varchar(225) NOT NULL,
  `refill_days` varchar(225) NOT NULL DEFAULT '30',
  `refill_hours` varchar(225) NOT NULL DEFAULT '24',
  `avg_days` int(11) NOT NULL,
  `avg_hours` int(11) NOT NULL,
  `avg_minutes` int(11) NOT NULL,
  `avg_many` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_api`, `api_service`, `api_servicetype`, `api_detail`, `category_id`, `service_line`, `service_type`, `service_package`, `service_name`, `service_description`, `service_price`, `service_min`, `service_max`, `service_dripfeed`, `service_autotime`, `service_autopost`, `service_speed`, `want_username`, `service_secret`, `price_type`, `price_cal`, `instagram_second`, `start_count`, `instagram_private`, `name_lang`, `description_lang`, `time_lang`, `time`, `cancelbutton`, `show_refill`, `service_profit`, `refill_days`, `refill_hours`, `avg_days`, `avg_hours`, `avg_minutes`, `avg_many`) VALUES
(69, 3, 367, '2', '{\"min\":\"1000\",\"max\":\"10000000\",\"rate\":\"0.37\",\"refill\":false,\"currency\":\"USD\"}', 6, 1, '2', '1', '🇺🇸Spotify USA Free Plays [Life Time Guarantee] [Max: 10M] [Speed: 500-3.5K / Day] [Start Time: 1-24 Hours]', '', '1.4800', 1000, 10000000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"\\ud83c\\uddfa\\ud83c\\uddf8Spotify USA Free Plays [Life Time Guarantee] [Max: 10M] [Speed: 500-3.5K \\/ Day] [Start Time: 1-24 Hours]\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'false', '300', '30', '24', 0, 0, 0, 0),
(70, 3, 213, '2', '{\"min\":\"1000\",\"max\":\"10000000\",\"rate\":\"0.55\",\"refill\":false,\"currency\":\"USD\"}', 6, 1, '2', '1', '🇺🇸 Spotify USA Qualified Premium Plays [Life Time Guarantee] [Max: 20K] [Speed: 20K / Day] [Start Time: 1-12 Hours]', '', '2.2000', 1000, 10000000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"\\ud83c\\uddfa\\ud83c\\uddf8 Spotify USA Qualified Premium Plays [Life Time Guarantee] [Max: 20K] [Speed: 20K \\/ Day] [Start Time: 1-12 Hours]\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'false', '300', '30', '24', 0, 0, 0, 0),
(71, 3, 214, '2', '{\"min\":\"1000\",\"max\":\"500000\",\"rate\":\"0.59\",\"refill\":false,\"currency\":\"USD\"}', 6, 1, '2', '1', '🇺🇸 Spotify USA Real Algorithmic Plays [Life Time Guarantee] [Best Usa Plays in the Market] [Speed: 25 - 50k / Day] [Start Time: Instant]', '', '2.3600', 1000, 500000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"\\ud83c\\uddfa\\ud83c\\uddf8 Spotify USA Real Algorithmic Plays [Life Time Guarantee] [Best Usa Plays in the Market] [Speed: 25 - 50k \\/ Day] [Start Time: Instant]\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'false', '300', '30', '24', 0, 0, 0, 0),
(72, 3, 220, '2', '{\"min\":\"1000\",\"max\":\"10000000\",\"rate\":\"0.24\",\"refill\":false,\"currency\":\"USD\"}', 7, 1, '2', '1', 'Spotify Global Plays [Life Time Guarantee] [Max: 10M] [Speed: 500 - 3.5K / Day] [Start Time: Instant]', '', '0.9600', 1000, 10000000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"Spotify Global Plays [Life Time Guarantee] [Max: 10M] [Speed: 500 - 3.5K \\/ Day] [Start Time: Instant]\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'false', '300', '30', '24', 0, 0, 0, 0),
(157, 3, 117, '2', '{\"min\":\"1000\",\"max\":\"500000\",\"rate\":\"0.89\",\"refill\":false,\"currency\":\"USD\"}', 20, 1, '2', '1', '🇨🇴 Spotify Playlist Plays [Colombia] [Lifetime Warranty] [15K-100K/Day] [Non-Drop]', '', '3.5600', 1000, 500000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"\\ud83c\\udde8\\ud83c\\uddf4 Spotify Playlist Plays [Colombia] [Lifetime Warranty] [15K-100K\\/Day] [Non-Drop]\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'false', '300', '30', '24', 0, 0, 0, 0);
INSERT INTO `services` (`service_id`, `service_api`, `api_service`, `api_servicetype`, `api_detail`, `category_id`, `service_line`, `service_type`, `service_package`, `service_name`, `service_description`, `service_price`, `service_min`, `service_max`, `service_dripfeed`, `service_autotime`, `service_autopost`, `service_speed`, `want_username`, `service_secret`, `price_type`, `price_cal`, `instagram_second`, `start_count`, `instagram_private`, `name_lang`, `description_lang`, `time_lang`, `time`, `cancelbutton`, `show_refill`, `service_profit`, `refill_days`, `refill_hours`, `avg_days`, `avg_hours`, `avg_minutes`, `avg_many`) VALUES
(158, 3, 129, '2', '{\"min\":\"20\",\"max\":\"100000000\",\"rate\":\"0.19\",\"refill\":false,\"currency\":\"USD\"}', 21, 1, '2', '1', '🇩🇪 Spotify Followers [Germany] [Artist - Playlist] [1M/Day] [ Max 100M ]', '', '0.7600', 20, 100000000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"\\ud83c\\udde9\\ud83c\\uddea Spotify Followers [Germany] [Artist - Playlist] [1M\\/Day] [ Max 100M ]\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'false', '300', '30', '24', 0, 0, 0, 0),
(159, 3, 126, '2', '{\"min\":\"20\",\"max\":\"100000000\",\"rate\":\"0.19\",\"refill\":false,\"currency\":\"USD\"}', 21, 1, '2', '1', '🇬🇧 Spotify Followers [United Kingdom] [Artist - Playlist] [1M/Day] [ Max 100M ]', '', '0.7600', 20, 100000000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"\\ud83c\\uddec\\ud83c\\udde7 Spotify Followers [United Kingdom] [Artist - Playlist] [1M\\/Day] [ Max 100M ]\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'false', '300', '30', '24', 0, 0, 0, 0),
(262, 2, 6831, '2', '{\"min\":\"10\",\"max\":\"50000\",\"rate\":\"0.59\",\"refill\":true,\"currency\":\"USD\"}', 27, 1, '2', '1', 'YouTube Likes | Max: 50K | 30 Days Refill | Day: 30K/50K', '', '2.3600', 10, 50000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"YouTube Likes | Max: 50K | 30 Days Refill | Day: 30K\\/50K\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'true', '300', '30', '24', 0, 0, 0, 0),
(263, 2, 6832, '2', '{\"min\":\"10\",\"max\":\"50000\",\"rate\":\"0.48\",\"refill\":false,\"currency\":\"USD\"}', 27, 1, '2', '1', 'YouTube Subscribers | No Refill | Max 50K | Day 30K/50K', '', '1.9200', 10, 50000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"YouTube Subscribers | No Refill | Max 50K | Day 30K\\/50K\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'false', '300', '30', '24', 0, 0, 0, 0),
(264, 2, 6833, '2', '{\"min\":\"100\",\"max\":\"100000\",\"rate\":\"1.13\",\"refill\":false,\"currency\":\"USD\"}', 27, 1, '2', '1', 'YouTube Subscribers | No Refill | Max 100K | Day 50K', '', '4.5200', 100, 100000, '1', 0, 0, '1', '1', '2', 'normal', NULL, '2', 'none', '1', '{\"en\":\"YouTube Subscribers | No Refill | Max 100K | Day 50K\"}', '{\"en\":\"\"}', 'Not enough data', 'Not enough data', '2', 'false', '300', '30', '24', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_api`
--

CREATE TABLE `service_api` (
  `id` int(11) NOT NULL,
  `api_name` varchar(225) NOT NULL,
  `api_url` text NOT NULL,
  `api_key` varchar(225) NOT NULL,
  `api_type` int(11) NOT NULL,
  `api_limit` double NOT NULL DEFAULT 0,
  `currency` enum('INR','USD') DEFAULT NULL,
  `api_alert` enum('1','2') NOT NULL DEFAULT '2' COMMENT '2 -> Gönder, 1 -> Gönderildi',
  `status` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `service_api`
--

INSERT INTO `service_api` (`id`, `api_name`, `api_url`, `api_key`, `api_type`, `api_limit`, `currency`, `api_alert`, `status`) VALUES
(2, 'smm.rip', 'https://smm.rip/api/v2', '364d8f68890f2c87b9fbde73368eb717', 1, 0, 'USD', '1', '1'),
(3, 'spotifypanel.com', 'https://spotifypanel.com/api/v2', '5b63f4ca3a672a63ddcaaddd9d0337c2', 1, 0, 'USD', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_seo` text NOT NULL,
  `site_title` text DEFAULT NULL,
  `site_description` text DEFAULT NULL,
  `site_keywords` text DEFAULT NULL,
  `site_logo` text DEFAULT NULL,
  `site_name` text DEFAULT NULL,
  `site_currency` varchar(2555) NOT NULL DEFAULT 'try',
  `favicon` text DEFAULT NULL,
  `site_language` varchar(225) NOT NULL DEFAULT 'tr',
  `site_theme` text NOT NULL,
  `site_theme_alt` text DEFAULT NULL,
  `recaptcha` enum('1','2') NOT NULL DEFAULT '1',
  `recaptcha_key` text DEFAULT NULL,
  `recaptcha_secret` text DEFAULT NULL,
  `custom_header` text DEFAULT NULL,
  `custom_footer` text DEFAULT NULL,
  `ticket_system` enum('1','2') NOT NULL DEFAULT '2',
  `register_page` enum('1','2') NOT NULL DEFAULT '2',
  `service_speed` enum('1','2') NOT NULL,
  `service_list` enum('1','2') NOT NULL,
  `dolar_charge` double NOT NULL,
  `euro_charge` double NOT NULL,
  `smtp_user` text NOT NULL,
  `smtp_pass` text NOT NULL,
  `smtp_server` text NOT NULL,
  `smtp_port` varchar(225) NOT NULL,
  `smtp_protocol` enum('0','ssl','tls') NOT NULL,
  `alert_type` enum('1','2','3') NOT NULL,
  `alert_apimail` enum('1','2') NOT NULL,
  `alert_newmanuelservice` enum('1','2') NOT NULL,
  `alert_newticket` enum('1','2') NOT NULL,
  `alert_apibalance` enum('1','2') NOT NULL,
  `alert_serviceapialert` enum('1','2') NOT NULL,
  `sms_provider` varchar(225) NOT NULL,
  `sms_title` varchar(225) NOT NULL,
  `sms_user` varchar(225) NOT NULL,
  `sms_pass` varchar(225) NOT NULL,
  `sms_validate` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 -> OK, 0 -> NO',
  `admin_mail` varchar(225) NOT NULL,
  `admin_telephone` varchar(225) NOT NULL,
  `resetpass_page` enum('1','2') NOT NULL,
  `resetpass_sms` enum('1','2') NOT NULL,
  `resetpass_email` enum('1','2') NOT NULL,
  `site_maintenance` enum('1','2') NOT NULL DEFAULT '2',
  `servis_siralama` varchar(255) NOT NULL,
  `bronz_statu` int(11) NOT NULL,
  `silver_statu` int(11) NOT NULL,
  `gold_statu` int(11) NOT NULL,
  `bayi_statu` int(11) NOT NULL,
  `ns1` varchar(191) DEFAULT NULL,
  `ns2` varchar(191) DEFAULT NULL,
  `childpanel_price` double DEFAULT NULL,
  `snow_effect` enum('1','2') NOT NULL DEFAULT '2',
  `snow_colour` text NOT NULL,
  `promotion` enum('1','2') DEFAULT '2',
  `referral_commision` double NOT NULL,
  `referral_payout` double NOT NULL,
  `referral_status` enum('1','2') NOT NULL DEFAULT '1',
  `childpanel_selling` enum('1','2') NOT NULL DEFAULT '1',
  `tickets_per_user` double NOT NULL DEFAULT 5,
  `name_fileds` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 -> ON, 2 -> NO',
  `skype_feilds` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 -> ON, 2 -> NO',
  `csymbol` text NOT NULL,
  `inr_symbol` text NOT NULL,
  `inr_value` double NOT NULL DEFAULT 0,
  `usd_symbol` text NOT NULL,
  `inr_convert` double NOT NULL DEFAULT 0,
  `otp_login` enum('1','2','0') NOT NULL DEFAULT '0',
  `auto_deactivate_payment` enum('1','2') NOT NULL DEFAULT '1',
  `service_avg_time` enum('1','0') NOT NULL DEFAULT '0',
  `alert_orderfail` enum('1','2') NOT NULL DEFAULT '2',
  `alert_welcomemail` enum('1','2') NOT NULL DEFAULT '2',
  `freebalance` enum('1','2') NOT NULL DEFAULT '1',
  `freeamount` double DEFAULT 0,
  `alert_newmessage` enum('1','2') NOT NULL DEFAULT '1',
  `email_confirmation` enum('1','2') NOT NULL DEFAULT '2',
  `resend_max` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_seo`, `site_title`, `site_description`, `site_keywords`, `site_logo`, `site_name`, `site_currency`, `favicon`, `site_language`, `site_theme`, `site_theme_alt`, `recaptcha`, `recaptcha_key`, `recaptcha_secret`, `custom_header`, `custom_footer`, `ticket_system`, `register_page`, `service_speed`, `service_list`, `dolar_charge`, `euro_charge`, `smtp_user`, `smtp_pass`, `smtp_server`, `smtp_port`, `smtp_protocol`, `alert_type`, `alert_apimail`, `alert_newmanuelservice`, `alert_newticket`, `alert_apibalance`, `alert_serviceapialert`, `sms_provider`, `sms_title`, `sms_user`, `sms_pass`, `sms_validate`, `admin_mail`, `admin_telephone`, `resetpass_page`, `resetpass_sms`, `resetpass_email`, `site_maintenance`, `servis_siralama`, `bronz_statu`, `silver_statu`, `gold_statu`, `bayi_statu`, `ns1`, `ns2`, `childpanel_price`, `snow_effect`, `snow_colour`, `promotion`, `referral_commision`, `referral_payout`, `referral_status`, `childpanel_selling`, `tickets_per_user`, `name_fileds`, `skype_feilds`, `csymbol`, `inr_symbol`, `inr_value`, `usd_symbol`, `inr_convert`, `otp_login`, `auto_deactivate_payment`, `service_avg_time`, `alert_orderfail`, `alert_welcomemail`, `freebalance`, `freeamount`, `alert_newmessage`, `email_confirmation`, `resend_max`) VALUES
(1, 'Dream', 'Dream', 'Dream', 'Dream', 'public/images/84117275be999ff55a987b9381e01f96.png', 'BoostedSMM', 'USD', 'public/images/81ecfd4383a1b3f7805215da769e4bb7e368451e.png', 'en', 'ccc', 'Blue', '1', '6Lflov8bAAAAAL-ISxPQDDw0jgfo-XhEtoMLU80_', '6Lflov8bAAAAAJaUZSRoYe6YAEYHrlQUAUWPlV9G', '', '', '1', '2', '1', '2', 75, 100, '', '121345', '', '465', 'ssl', '2', '2', '2', '2', '2', '2', 'bizimsms', 'Dream', '', '', '1', '', '', '2', '2', '2', '2', 'asc', 20, 100, 500, 1500, 'ns1.fspofficial.com', 'ns2.fspofficial.com', 0, '1', '#ffffff', '2', 10, 5, '2', '2', 9999999999, '1', '2', '$', '₹', 74.87, '$', 0.013, '0', '1', '1', '2', '2', '1', 0, '2', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sync_logs`
--

CREATE TABLE `sync_logs` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `action` varchar(225) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(225) NOT NULL,
  `api_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `theme_name` text NOT NULL,
  `theme_dirname` text NOT NULL,
  `theme_extras` text NOT NULL,
  `last_modified` datetime NOT NULL,
  `newpage` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `theme_name`, `theme_dirname`, `theme_extras`, `last_modified`, `newpage`) VALUES
(32, 'cloutsy', 'ccc', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `subject` varchar(225) NOT NULL,
  `time` datetime NOT NULL,
  `lastupdate_time` datetime NOT NULL,
  `client_new` enum('1','2') NOT NULL DEFAULT '2',
  `status` enum('pending','answered','closed') NOT NULL DEFAULT 'pending',
  `support_new` enum('1','2') NOT NULL DEFAULT '1',
  `canmessage` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `client_id`, `subject`, `time`, `lastupdate_time`, `client_new`, `status`, `support_new`, `canmessage`) VALUES
(1, 5, 'Order', '2022-05-13 19:45:33', '2022-05-13 19:45:33', '2', 'pending', '1', '2'),
(2, 5, 'Order', '2022-05-13 19:46:16', '2022-05-14 11:54:57', '1', 'pending', '1', '2'),
(3, 7, 'Order', '2022-05-13 21:06:47', '2022-05-13 21:06:47', '2', 'pending', '1', '2'),
(4, 10, 'Order', '2022-05-14 06:28:27', '2022-05-14 06:28:27', '2', 'pending', '1', '2'),
(5, 5, 'Order', '2022-05-14 11:56:11', '2022-05-14 11:56:47', '1', 'answered', '1', '2'),
(6, 6, 'Order', '2022-05-22 17:54:49', '2022-05-22 17:54:49', '2', 'pending', '1', '2'),
(7, 6, 'Order', '2022-05-22 18:21:14', '2022-06-04 11:18:52', '2', 'pending', '1', '2'),
(8, 11, 'Order', '2022-06-04 09:25:56', '2022-06-04 09:26:07', '2', 'pending', '1', '2'),
(9, 11, 'Order', '2022-06-04 11:46:45', '2022-06-04 11:46:51', '2', 'pending', '1', '2'),
(10, 19, 'Order', '2022-11-02 07:14:53', '2022-11-02 07:14:53', '2', 'pending', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_reply`
--

CREATE TABLE `ticket_reply` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `support` enum('1','2') NOT NULL DEFAULT '1',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `readed` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ticket_reply`
--

INSERT INTO `ticket_reply` (`id`, `ticket_id`, `client_id`, `time`, `support`, `message`, `readed`) VALUES
(1, 1, 0, '2022-05-13 19:45:33', '1', 'ticket', '1'),
(26, 10, 0, '2022-11-02 07:14:53', '1', 'hello', '1');

-- --------------------------------------------------------

--
-- Table structure for table `units_per_page`
--

CREATE TABLE `units_per_page` (
  `id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `page` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `units_per_page`
--

INSERT INTO `units_per_page` (`id`, `unit`, `page`) VALUES
(1, 50, 'clients'),
(2, 50, 'orders'),
(3, 1, 'payments'),
(4, 50, 'refill');

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `u_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `action` varchar(225) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`u_id`, `service_id`, `action`, `date`, `description`) VALUES
(186, 68, 'Refill Activated', '2022-05-13 20:05:18', 'Refill Button has been activated'),
(187, 68, 'Cancel Activated', '2022-05-13 20:05:18', 'Cancel Button has been activated'),
(188, 68, 'Price Increased', '2022-05-13 20:05:18', 'Price changed from  to 100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `childpanels`
--
ALTER TABLE `childpanels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `clients_category`
--
ALTER TABLE `clients_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_price`
--
ALTER TABLE `clients_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_service`
--
ALTER TABLE `clients_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_report`
--
ALTER TABLE `client_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earn`
--
ALTER TABLE `earn`
  ADD PRIMARY KEY (`earn_id`);

--
-- Indexes for table `General_options`
--
ALTER TABLE `General_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `integrations`
--
ALTER TABLE `integrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuponlar`
--
ALTER TABLE `kuponlar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kupon_kullananlar`
--
ALTER TABLE `kupon_kullananlar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Mailforms`
--
ALTER TABLE `Mailforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_popup`
--
ALTER TABLE `notifications_popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`) USING BTREE;

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `panel_info`
--
ALTER TABLE `panel_info`
  ADD PRIMARY KEY (`panel_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payments_bonus`
--
ALTER TABLE `payments_bonus`
  ADD PRIMARY KEY (`bonus_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`referral_id`);

--
-- Indexes for table `referral_payouts`
--
ALTER TABLE `referral_payouts`
  ADD PRIMARY KEY (`r_p_id`);

--
-- Indexes for table `refill_status`
--
ALTER TABLE `refill_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceapi_alert`
--
ALTER TABLE `serviceapi_alert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_api`
--
ALTER TABLE `service_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sync_logs`
--
ALTER TABLE `sync_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units_per_page`
--
ALTER TABLE `units_per_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `childpanels`
--
ALTER TABLE `childpanels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `clients_category`
--
ALTER TABLE `clients_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients_price`
--
ALTER TABLE `clients_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients_service`
--
ALTER TABLE `clients_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_report`
--
ALTER TABLE `client_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `earn`
--
ALTER TABLE `earn`
  MODIFY `earn_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `General_options`
--
ALTER TABLE `General_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `integrations`
--
ALTER TABLE `integrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kuponlar`
--
ALTER TABLE `kuponlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kupon_kullananlar`
--
ALTER TABLE `kupon_kullananlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Mailforms`
--
ALTER TABLE `Mailforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notifications_popup`
--
ALTER TABLE `notifications_popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=781;

--
-- AUTO_INCREMENT for table `panel_info`
--
ALTER TABLE `panel_info`
  MODIFY `panel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `payments_bonus`
--
ALTER TABLE `payments_bonus`
  MODIFY `bonus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `referral_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `referral_payouts`
--
ALTER TABLE `referral_payouts`
  MODIFY `r_p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `refill_status`
--
ALTER TABLE `refill_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serviceapi_alert`
--
ALTER TABLE `serviceapi_alert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2519;

--
-- AUTO_INCREMENT for table `service_api`
--
ALTER TABLE `service_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sync_logs`
--
ALTER TABLE `sync_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `units_per_page`
--
ALTER TABLE `units_per_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
