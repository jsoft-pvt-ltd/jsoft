-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2013 at 09:17 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_optic`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `fld_id` int(255) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`),
  KEY `fld_id` (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`fld_id`, `session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
(1, '074b38d842a0b1899701d92043797b9f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238709, 'a:2:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;}'),
(4, '2838554cd20cae526e3826c2e136fd77', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238705, ''),
(5, '3174689c7bc4db015e7846595c7ae0b6', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238890, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:3:"118";}'),
(6, '35b2dbe7baa4679c0e64c737b1c6dc55', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238903, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:3:"118";}'),
(7, '391bcf0a94780ef171ce2a7f1f4c8053', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238869, ''),
(20, '3a038469117e07e2210a73a7de6e6b98', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0', 1377240246, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:2:"34";}'),
(3, '5e43920c80b74bbbb24ae81e4791b5d3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0', 1377240209, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:2:"34";}'),
(8, '62c62a92f46b2c37a521a879ea6889f1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0', 1377238667, ''),
(21, '70d305b9ddddb45fa7ad5168bab63c1d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0', 1377240246, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:2:"34";}'),
(9, '7105c451a6e7d03c56dc21af0800c82d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0', 1377238794, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:2:"34";}'),
(10, '7109a953e1128d66162c533079c10dbe', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238896, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:3:"118";}'),
(11, '769d767be571951a1ef4fa67b12b90ba', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238709, 'a:2:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;}'),
(12, 'a4fc36025f29f541c159196fb977158e', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238927, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:3:"118";}'),
(13, 'aabf4322c9c754f46ccce97c2799bed2', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238924, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:3:"118";}'),
(14, 'b3a43dfa86f2b1d7a4e452f744740d3d', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238927, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:3:"118";}'),
(15, 'b5b198a0fd3bfd0b5f5c265df9649548', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238887, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:3:"118";}'),
(16, 'b70ba751935f5df3e2d058563417efba', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0', 1377239940, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:2:"34";}'),
(17, 'd70de336e8240e954e1e269864b02331', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238908, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:3:"118";}'),
(18, 'd9d237ae93caddce234c184f94ac95c0', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238883, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:2:"34";}'),
(2, 'ee26860b47a8fb456ede55d25c88f0ab', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0', 1377240444, 'a:6:{s:15:"admin_logged_in";b:1;s:8:"admin_id";s:1:"1";s:10:"admin_name";s:5:"Anjin";s:14:"admin_username";s:5:"anjin";s:11:"admin_email";s:25:"anjin_pradhan@hotmail.com";s:13:"admin_role_id";s:1:"1";}'),
(19, 'f9a104d9c330b498cc65c2ef74b14bd2', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1377238919, 'a:3:{s:9:"user_data";s:0:"";s:10:"user_panel";b:1;s:15:"fld_category_id";s:3:"118";}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accessories`
--

CREATE TABLE IF NOT EXISTS `tbl_accessories` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(50) NOT NULL,
  `fld_item_code` varchar(50) NOT NULL,
  `fld_cp` decimal(7,2) NOT NULL,
  `fld_discount` int(11) NOT NULL,
  `fld_sp` decimal(7,2) NOT NULL,
  `fld_qty` int(11) NOT NULL,
  `fld_status` tinyint(1) NOT NULL,
  `fld_shelf_location` varchar(25) NOT NULL,
  `fld_description` text NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_accessories`
--

INSERT INTO `tbl_accessories` (`fld_id`, `fld_name`, `fld_item_code`, `fld_cp`, `fld_discount`, `fld_sp`, `fld_qty`, `fld_status`, `fld_shelf_location`, `fld_description`) VALUES
(1, 'Robz', 'Black_box', 120.00, 10, 108.00, 14, 1, '11B', 'sfd asfd asdf'),
(2, 'Robinder', 'robz', 10.00, 99, 0.10, 2, 1, 'jsoft', 'Nautanki sala');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accessories_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_accessories_attributes` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_color` varchar(50) NOT NULL,
  `fld_location` varchar(255) NOT NULL,
  `fld_image` varchar(255) NOT NULL,
  `fld_qty` int(11) NOT NULL,
  `fld_accessory_id` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_accessories_attributes`
--

INSERT INTO `tbl_accessories_attributes` (`fld_id`, `fld_color`, `fld_location`, `fld_image`, `fld_qty`, `fld_accessory_id`) VALUES
(1, 'Hariyo', 'images/2013/08/20', 'xeey_3-dot-1-phillip-lim-doctora_004.jpg', 10, 1),
(2, 'Black', 'images/2013/08/20', 'kndu_3-dot-1-phillip-lim-doctora_002.jpg', 4, 1),
(5, 'gahu goro', 'images/2013/08/22', '1cob_koala.jpg', 1, 2),
(6, 'kodo kalo', 'images/2013/08/22', 'wqdh_penguins.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acc_notice`
--

CREATE TABLE IF NOT EXISTS `tbl_acc_notice` (
  `fld_id` int(255) NOT NULL AUTO_INCREMENT,
  `fld_user` int(255) NOT NULL,
  `fld_date` datetime NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_acc_notice`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `fld_id` int(240) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(2000) NOT NULL,
  `fld_username` varchar(2000) NOT NULL,
  `fld_password` varchar(2000) NOT NULL,
  `fld_email` varchar(2000) NOT NULL,
  `fld_role_id` int(240) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`fld_id`, `fld_name`, `fld_username`, `fld_password`, `fld_email`, `fld_role_id`) VALUES
(1, 'Anjin', 'anjin', 'anjin', 'anjin_pradhan@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_attributes` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  `fld_product_type_id` int(11) NOT NULL,
  `fld_image` varchar(255) DEFAULT NULL,
  `fld_location` varchar(255) DEFAULT NULL,
  `fld_price` decimal(5,2) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_attributes`
--

INSERT INTO `tbl_attributes` (`fld_id`, `fld_name`, `fld_product_type_id`, `fld_image`, `fld_location`, `fld_price`) VALUES
(2, 'shape', 4, NULL, NULL, 0.00),
(3, 'color', 4, NULL, NULL, 0.00),
(4, 'Gender', 4, NULL, NULL, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute_values`
--

CREATE TABLE IF NOT EXISTS `tbl_attribute_values` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_value` varchar(255) NOT NULL,
  `fld_price` decimal(5,2) NOT NULL,
  `fld_attribute_id` int(11) NOT NULL,
  `fld_parent_id` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `tbl_attribute_values`
--

INSERT INTO `tbl_attribute_values` (`fld_id`, `fld_value`, `fld_price`, `fld_attribute_id`, `fld_parent_id`) VALUES
(1, 'aviator', 0.00, 2, 0),
(2, 'butterfly', 0.00, 2, 0),
(3, 'cateye', 0.00, 2, 0),
(4, 'oval', 0.00, 2, 0),
(5, 'rectangle', 0.00, 2, 0),
(6, 'round', 0.00, 2, 0),
(7, 'shield', 0.00, 2, 0),
(8, 'square', 0.00, 2, 0),
(9, 'wayfarer', 0.00, 2, 0),
(10, 'wraparound', 0.00, 2, 0),
(11, '000000', 0.00, 3, 0),
(12, '123abc', 0.00, 3, 0),
(13, '0a8ece', 0.00, 3, 0),
(14, 'cccccc', 0.00, 3, 0),
(15, 'fa342e', 0.00, 3, 0),
(16, '8e4f50', 0.00, 3, 0),
(17, '00ffff', 0.00, 3, 0),
(18, 'ffffff', 0.00, 3, 0),
(19, 'cf0000', 0.00, 3, 0),
(20, '0000cf', 0.00, 3, 0),
(21, 'abc123', 0.00, 3, 0),
(22, '840000', 0.00, 3, 0),
(23, '012345', 0.00, 3, 0),
(24, '534231', 0.00, 3, 0),
(25, 'Male', 0.00, 4, 0),
(26, 'Female', 0.00, 4, 0),
(27, 'Black', 0.00, 3, 11),
(28, 'Navy Blue', 0.00, 3, 12),
(29, 'Light Blue', 0.00, 3, 13),
(30, 'Grey', 0.00, 3, 14),
(31, 'Crimson', 0.00, 3, 15),
(32, 'Light Brown', 0.00, 3, 16),
(33, 'Sky', 0.00, 3, 17),
(34, 'White', 0.00, 3, 18),
(35, 'Dark Red', 0.00, 3, 19),
(36, 'Dark Blue', 0.00, 3, 20),
(37, 'Lime', 0.00, 3, 21),
(38, 'Metal Red', 0.00, 3, 22),
(39, 'Blue Shadow', 0.00, 3, 23),
(40, 'Brown', 0.00, 3, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carrier`
--

CREATE TABLE IF NOT EXISTS `tbl_carrier` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_country` int(11) NOT NULL,
  `fld_carrier` varchar(240) NOT NULL,
  `fld_shipping_cost` decimal(5,2) NOT NULL,
  `fld_additional_cost` decimal(5,2) NOT NULL,
  `fld_insurance_cost` decimal(5,2) NOT NULL,
  `fld_additional_insurance_cost` decimal(5,2) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_carrier`
--

INSERT INTO `tbl_carrier` (`fld_id`, `fld_country`, `fld_carrier`, `fld_shipping_cost`, `fld_additional_cost`, `fld_insurance_cost`, `fld_additional_insurance_cost`) VALUES
(1, 14, 'Self', 800.00, 0.00, 0.00, 0.00),
(2, 40, 'FedEx 3-5 Days Delivery', 800.00, 0.00, 0.00, 0.00),
(3, 235, 'FedEx 3-5 Days Delivery', 800.00, 0.00, 0.00, 0.00),
(4, 109, 'DHL', 900.00, 0.00, 0.00, 0.00),
(5, 236, 'FedEx 3-5 Days Delivery', 800.00, 0.00, 0.00, 0.00),
(6, 236, 'USPS 5-9 days Delivery', 275.54, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  `fld_description` text NOT NULL,
  `fld_rank` int(11) NOT NULL,
  `fld_status` tinyint(4) NOT NULL,
  `fld_location` varchar(255) NOT NULL,
  `fld_image` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`fld_id`, `fld_name`, `fld_description`, `fld_rank`, `fld_status`, `fld_location`, `fld_image`) VALUES
(5, 'Best Seller', 'This category consists of the best products sold.', 0, 1, '', ''),
(32, 'Eyeglasses', 'Phasellus sed nisl erat, sit amet volutpat ipsum. Nullam porttitor, lectus ut condimentum aliquet, diam tellus viverra purus, at venenatis est ante ac ante. Ut ut purus nisi, eu accumsan magna. Nunc laoreet vehicula libero vel ornare. Donec ultricies ligula ac quam vulputate id auctor ligula luctus. Nulla facilisi. Nullam lorem urna, aliquam ac hendrerit a, tempus a libero. Sed aliquam mauris elit, eu fermentum lectus.\r\n', 1, 1, 'images/2013/08/19/', 'mfd8_menu_mens_optical-c3ee34853a12bf16dd8bb4564cb0c99c.png'),
(33, 'Sunglasses', 'Etiam pellentesque eros ac ipsum porttitor dapibus. Aliquam egestas, metus sit amet imperdiet malesuada, velit arcu volutpat justo, at lobortis justo felis sed ante. Duis ut urna massa. Quisque porta nulla hendrerit sapien bibendum ultrices. Praesent euismod lacus nec ante consequat viverra. Mauris eget consectetur erat. In hac habitasse platea dictumst. Donec eget odio nisl, nec pretium urna. Duis sem diam, venenatis ac iaculis sit amet, feugiat eget libero. Morbi neque turpis, imperdiet in placerat a, ornare faucibus quam. Mauris in lacus eget augue eleifend commodo. Praesent non leo urna. Sed at nibh arcu. Suspendisse elit velit, ultrices nec lobortis ut, pellentesque cursus lacus. Nam ornare adipiscing ipsum eu fermentum.\r\n', 2, 1, 'images/2013/08/19/', 'gnpm_menu_mens_sun-e9a4e172093bc9fad284fc0c5709eb04.png'),
(34, 'Robz', 'sadf asdf a', 3, 1, 'images/2013/08/19/', 'ssxr_3-dot-1-phillip-lim-holmes.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_lens`
--

CREATE TABLE IF NOT EXISTS `tbl_contact_lens` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(50) NOT NULL,
  `fld_description` text NOT NULL,
  `fld_brand` int(11) NOT NULL,
  `fld_lpb` int(11) NOT NULL,
  `fld_cp` decimal(7,2) NOT NULL,
  `fld_sp` decimal(7,2) NOT NULL,
  `fld_discount` int(11) NOT NULL,
  `fld_discount_price` decimal(7,2) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_contact_lens`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_lens_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_contact_lens_attributes` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_value` decimal(5,2) NOT NULL,
  `fld_contact_lens_id` int(11) NOT NULL,
  `fld_type` varchar(50) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_contact_lens_attributes`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_lens_brands`
--

CREATE TABLE IF NOT EXISTS `tbl_contact_lens_brands` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(50) NOT NULL,
  `fld_description` text NOT NULL,
  `fld_location` varchar(150) NOT NULL,
  `fld_image` varchar(50) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_contact_lens_brands`
--

INSERT INTO `tbl_contact_lens_brands` (`fld_id`, `fld_name`, `fld_description`, `fld_location`, `fld_image`) VALUES
(1, 'Crizal', 'Pellentesque quis commodo lacus. Curabitur rhoncus vehicula turpis, a commodo leo luctus sit amet. Curabitur rutrum, mauris non egestas sagittis, libero nunc dictum eros, nec molestie augue sem et ipsum. Nulla iaculis scelerisque enim, non luctus elit rutrum posuere. Morbi et faucibus neque. Mauris condimentum lectus non ante dapibus a euismod erat semper. Sed dapibus vehicula lorem non bibendum. Aliquam placerat porttitor mauris, quis pellentesque nisl feugiat sit amet. Vestibulum pellentesque massa vel orci tempus et iaculis elit congue. Donec fringilla, sapien varius porta vestibulum, sapien lorem ullamcorper quam, a rutrum odio urna in nibh. Nullam a urna sem, sed condimentum orci.\r\n', 'images/2013/08/16', 'xawu_crizal_logo.png'),
(2, 'Essilor', 'Etiam pellentesque eros ac ipsum porttitor dapibus. Aliquam egestas, metus sit amet imperdiet malesuada, velit arcu volutpat justo, at lobortis justo felis sed ante. Duis ut urna massa. Quisque porta nulla hendrerit sapien bibendum ultrices. Praesent euismod lacus nec ante consequat viverra. Mauris eget consectetur erat. In hac habitasse platea dictumst. Donec eget odio nisl, nec pretium urna. Duis sem diam, venenatis ac iaculis sit amet, feugiat eget libero. Morbi neque turpis, imperdiet in placerat a, ornare faucibus quam. Mauris in lacus eget augue eleifend commodo. Praesent non leo urna. Sed at nibh arcu. Suspendisse elit velit, ultrices nec lobortis ut, pellentesque cursus lacus. Nam ornare adipiscing ipsum eu fermentum.\r\n', 'images/2013/08/16', '4a8x_essilor_logo.png'),
(3, 'Acuvue', 'Phasellus sed nisl erat, sit amet volutpat ipsum. Nullam porttitor, lectus ut condimentum aliquet, diam tellus viverra purus, at venenatis est ante ac ante. Ut ut purus nisi, eu accumsan magna. Nunc laoreet vehicula libero vel ornare. Donec ultricies ligula ac quam vulputate id auctor ligula luctus. Nulla facilisi. Nullam lorem urna, aliquam ac hendrerit a, tempus a libero. Sed aliquam mauris elit, eu fermentum lectus.\r\n', 'images/2013/08/16', '7vr3_acuvue.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE IF NOT EXISTS `tbl_country` (
  `fld_id` int(5) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`fld_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=251 ;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`fld_id`, `fld_name`) VALUES
(1, 'Afghanistan'),
(2, 'Aland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua and Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bolivia'),
(28, 'Bonaire, Sint Eustatius and Saba'),
(29, 'Bosnia and Herzegovina'),
(30, 'Botswana'),
(31, 'Bouvet Island'),
(32, 'Brazil'),
(33, 'British Indian Ocean Territory'),
(34, 'Brunei'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cambodia'),
(39, 'Cameroon'),
(40, 'Canada'),
(41, 'Cape Verde'),
(42, 'Cayman Islands'),
(43, 'Central African Republic'),
(44, 'Chad'),
(45, 'Chile'),
(46, 'China'),
(47, 'Christmas Island'),
(48, 'Cocos (Keeling) Islands'),
(49, 'Colombia'),
(50, 'Comoros'),
(51, 'Congo'),
(52, 'Cook Islands'),
(53, 'Costa Rica'),
(54, 'Cote d''ivoire (Ivory Coast)'),
(55, 'Croatia'),
(56, 'Cuba'),
(57, 'Curacao'),
(58, 'Cyprus'),
(59, 'Czech Republic'),
(60, 'Democratic Republic of the Congo'),
(61, 'Denmark'),
(62, 'Djibouti'),
(63, 'Dominica'),
(64, 'Dominican Republic'),
(65, 'Ecuador'),
(66, 'Egypt'),
(67, 'El Salvador'),
(68, 'Equatorial Guinea'),
(69, 'Eritrea'),
(70, 'Estonia'),
(71, 'Ethiopia'),
(72, 'Falkland Islands (Malvinas)'),
(73, 'Faroe Islands'),
(74, 'Fiji'),
(75, 'Finland'),
(76, 'France'),
(77, 'French Guiana'),
(78, 'French Polynesia'),
(79, 'French Southern Territories'),
(80, 'Gabon'),
(81, 'Gambia'),
(82, 'Georgia'),
(83, 'Germany'),
(84, 'Ghana'),
(85, 'Gibraltar'),
(86, 'Greece'),
(87, 'Greenland'),
(88, 'Grenada'),
(89, 'Guadaloupe'),
(90, 'Guam'),
(91, 'Guatemala'),
(92, 'Guernsey'),
(93, 'Guinea'),
(94, 'Guinea-Bissau'),
(95, 'Guyana'),
(96, 'Haiti'),
(97, 'Heard Island and McDonald Islands'),
(98, 'Honduras'),
(99, 'Hong Kong'),
(100, 'Hungary'),
(101, 'Iceland'),
(102, 'India'),
(103, 'Indonesia'),
(104, 'Iran'),
(105, 'Iraq'),
(106, 'Ireland'),
(107, 'Isle of Man'),
(108, 'Israel'),
(109, 'Italy'),
(110, 'Jamaica'),
(111, 'Japan'),
(112, 'Jersey'),
(113, 'Jordan'),
(114, 'Kazakhstan'),
(115, 'Kenya'),
(116, 'Kiribati'),
(117, 'Kosovo'),
(118, 'Kuwait'),
(119, 'Kyrgyzstan'),
(120, 'Laos'),
(121, 'Latvia'),
(122, 'Lebanon'),
(123, 'Lesotho'),
(124, 'Liberia'),
(125, 'Libya'),
(126, 'Liechtenstein'),
(127, 'Lithuania'),
(128, 'Luxembourg'),
(129, 'Macao'),
(130, 'Macedonia'),
(131, 'Madagascar'),
(132, 'Malawi'),
(133, 'Malaysia'),
(134, 'Maldives'),
(135, 'Mali'),
(136, 'Malta'),
(137, 'Marshall Islands'),
(138, 'Martinique'),
(139, 'Mauritania'),
(140, 'Mauritius'),
(141, 'Mayotte'),
(142, 'Mexico'),
(143, 'Micronesia'),
(144, 'Moldava'),
(145, 'Monaco'),
(146, 'Mongolia'),
(147, 'Montenegro'),
(148, 'Montserrat'),
(149, 'Morocco'),
(150, 'Mozambique'),
(151, 'Myanmar (Burma)'),
(152, 'Namibia'),
(153, 'Nauru'),
(154, 'Nepal'),
(155, 'Netherlands'),
(156, 'New Caledonia'),
(157, 'New Zealand'),
(158, 'Nicaragua'),
(159, 'Niger'),
(160, 'Nigeria'),
(161, 'Niue'),
(162, 'Norfolk Island'),
(163, 'North Korea'),
(164, 'Northern Mariana Islands'),
(165, 'Norway'),
(166, 'Oman'),
(167, 'Pakistan'),
(168, 'Palau'),
(169, 'Palestine'),
(170, 'Panama'),
(171, 'Papua New Guinea'),
(172, 'Paraguay'),
(173, 'Peru'),
(174, 'Phillipines'),
(175, 'Pitcairn'),
(176, 'Poland'),
(177, 'Portugal'),
(178, 'Puerto Rico'),
(179, 'Qatar'),
(180, 'Reunion'),
(181, 'Romania'),
(182, 'Russia'),
(183, 'Rwanda'),
(184, 'Saint Barthelemy'),
(185, 'Saint Helena'),
(186, 'Saint Kitts and Nevis'),
(187, 'Saint Lucia'),
(188, 'Saint Martin'),
(189, 'Saint Pierre and Miquelon'),
(190, 'Saint Vincent and the Grenadines'),
(191, 'Samoa'),
(192, 'San Marino'),
(193, 'Sao Tome and Principe'),
(194, 'Saudi Arabia'),
(195, 'Senegal'),
(196, 'Serbia'),
(197, 'Seychelles'),
(198, 'Sierra Leone'),
(199, 'Singapore'),
(200, 'Sint Maarten'),
(201, 'Slovakia'),
(202, 'Slovenia'),
(203, 'Solomon Islands'),
(204, 'Somalia'),
(205, 'South Africa'),
(206, 'South Georgia and the South Sandwich Islands'),
(207, 'South Korea'),
(208, 'South Sudan'),
(209, 'Spain'),
(210, 'Sri Lanka'),
(211, 'Sudan'),
(212, 'Suriname'),
(213, 'Svalbard and Jan Mayen'),
(214, 'Swaziland'),
(215, 'Sweden'),
(216, 'Switzerland'),
(217, 'Syria'),
(218, 'Taiwan'),
(219, 'Tajikistan'),
(220, 'Tanzania'),
(221, 'Thailand'),
(222, 'Timor-Leste (East Timor)'),
(223, 'Togo'),
(224, 'Tokelau'),
(225, 'Tonga'),
(226, 'Trinidad and Tobago'),
(227, 'Tunisia'),
(228, 'Turkey'),
(229, 'Turkmenistan'),
(230, 'Turks and Caicos Islands'),
(231, 'Tuvalu'),
(232, 'Uganda'),
(233, 'Ukraine'),
(234, 'United Arab Emirates'),
(235, 'United Kingdom'),
(236, 'United States'),
(237, 'United States Minor Outlying Islands'),
(238, 'Uruguay'),
(239, 'Uzbekistan'),
(240, 'Vanuatu'),
(241, 'Vatican City'),
(242, 'Venezuela'),
(243, 'Vietnam'),
(244, 'Virgin Islands, British'),
(245, 'Virgin Islands, US'),
(246, 'Wallis and Futuna'),
(247, 'Western Sahara'),
(248, 'Yemen'),
(249, 'Zambia'),
(250, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE IF NOT EXISTS `tbl_faq` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_faqtype` int(11) NOT NULL,
  `fld_question` text NOT NULL,
  `fld_description` text NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`fld_id`, `fld_faqtype`, `fld_question`, `fld_description`) VALUES
(1, 1, 'How to select correct glasses?', 'Choosing frames that suite you can be very confusing especially when there are many options.  It is important to try different shapes and colors to see which style suites you. We at opticstoreonline.com will try and define how to select a correct frame that suites your personality.\r\n\r\n \r\n\r\nFirst decide what type of frame material you would prefer Metal, Plastic or Rimless. Once you decide on the material you will need to decide on what type of frame you would prefer Full rim (metal rim that covers the whole lens), Semi-rimless (also referred to as a half rim frame. The rim covers half portion of the lens and the remaining half are supported by a plastic thread) or rimless (it has no rim that covers the lenses).'),
(2, 7, 'What types of frames do you sell? ', 'We offer a variety of plastic, metal, memory or flexlite (bendable frames that retain their shape), and titanium. All of our eyeglasses come complete with complimentary case and cleaning cloth.'),
(3, 7, 'Are the lenses that change colors OK for sunglasses? ', 'Yes the lenses that changes color or photochromatic lenses can be used as sunglasses.'),
(4, 10, 'I want to cancel my order? ', 'To cancel your order please contact us within 24 hrs once you place an order. You may email us at service@opticstoreonline.com or call us at 203-989-0261 (Mon To Fri 9 AM to 5 PM EST)\r\n'),
(5, 8, 'What are the payment methods? ', 'We use paypal to securely accept Amex, Visa, Discover and Master Card payments.\r\n'),
(6, 8, 'Do you accept cash and cheques?', 'Currently, we don''t accept cash, cheques and money orders. We do accept all major credit cards.'),
(7, 8, 'Do you accept Credit Card payment ? ', 'We do accept Credit Cards and Paypal '),
(8, 4, 'What is the typical delivery time? ', 'The glasses are generally delivered within 5-9 days once it has been shipped. It takes 24-48 hrs for us to process the order. If the prescription is complex or high prescription it may take a day or 2 longer to ship the glasses.\r\n'),
(9, 4, 'How to track an order? ', 'You can log in to your account online and you will be able to see the status of your order. You may also contact our Customer Service via email at  service@opticstoreonline.com or call us at   203-989-0261 (9AM to 5PM EST)'),
(10, 4, 'How much is shipping Charges? ', 'Shipping time frame:\r\n\r\nUnited States:\r\n\r\nUSPS First Class or Priority: 5-9 Days ($5.99 For the first pair and additional $2.00 per pair from 2nd pair onwards)\r\n\r\nFedEx:   3-5 Days ($17.39 For the first pair and additional $2.00 per pair from 2nd pair onwards)\r\n\r\nCanada:\r\n\r\nFedex: 3-5 Days ($17.39 For the first pair and additional $2.00 per pair from 2nd pair onwards)\r\n\r\nUnited Kingdom: \r\n\r\nFedex: 3-5 Days ($17.39For the first pair and additional $2.00 per pair from 2nd pair onwards)'),
(11, 1, 'Can I order by phone? ', 'Most of our customers order with their credit card directly through our secure website.  This is better as you can easily ensure you are inputting the right information including your delivery address. We can help you order your desired item over the phone; however you would need to provide us your credit card details on the phone so our customer service operators can enter the information into our secure payment gateway.\r\nYou can contact our customer support at :203-989-0261 (9AM to 5PM EST)'),
(12, 1, 'What do I need before ordering from you? ', 'Ordering is very easy, but you will need a valid prescription that has been issued within the last two years. If you do not have a current prescription, please go for an eye check up and ensure that the optician gives you a copy. Simply then key this information into our online ordering system.\r\n\r\n\r\nPrior to ordering from us, please have your eyeglass prescription available and a credit card or Paypal account. It''s just that easy! '),
(13, 2, 'What are clear lenses? ', 'These are lenses which do not have any color on it.Clear lenses are most commonly used prescription lenses.'),
(14, 2, 'What are polarized lenses? ', 'These lenses have a thin polarizing film attached on the lenses which helps blocking the glare which distorts the true color of objects. These lenses come with standard tint intensity and the tint cannot be removed from the lenses. These lenses are generally preferred by sportsmen but it can be worn by anyone seeking quality sun protection for their eye as it has high benefits. '),
(15, 2, 'What are tinted lenses? ', 'These are colored lens which is generally used on sunglasses. The lenses comes in 3 different intensity Light (5% - 10% darkness), Medium (45% to 55% darkness) and Dark Solid ( 80% to 90% darkness)'),
(16, 2, 'Do tinted lenses offer protection from the sun? ', 'Yes, tinted lenses do protect your eyes form the sun as these lenses include UV protection.\r\n'),
(17, 2, 'What''s the best way to clean my lenses? ', 'It is always a good practice to dampen the lenses with water or any cleaning solution before you wipe the lenses.You may use the cleaning cloth that comes with the glasses or a tissue paper to wipe it.'),
(18, 2, 'Are the lenses glass or plastic? ', 'We only carry plastic (CR-39) and polycarbonate lenses. For safety reasons we do not offer  glass lenses.'),
(19, 2, 'What are Photochromatic lenses?', 'Also known as transition lenses. Theses lenses turn dark when it is exposed to direct sunlight and when inside a room it turns clear. It has a light tint when clear but is not visible on colored background.'),
(20, 3, 'How to interpret prescription? ', 'There are different ways how opticians write the prescription and interpreting prescription correctly is very important. A small error on prescription can lead to wrong lenses. Please refer to the fig. below to interpret different prescription:\r\n\r\n \r\n\r\nPrescription 1:\r\n\r\n \r\n\r\n \r\n	\r\n\r\n \r\n\r\nSPH\r\n	\r\n\r\n \r\n\r\nCYL\r\n	\r\n\r\n \r\n\r\nAXIS\r\n	\r\n\r\n \r\n\r\nADD\r\n\r\n \r\n\r\nOD (RIGHT)\r\n	\r\n\r\n\r\n-025\r\n	\r\n\r\n \r\n\r\n-050\r\n\r\n \r\n	\r\n\r\n \r\n\r\n100\r\n	\r\n\r\n \r\n\r\n \r\n\r\nOS (LEFT)\r\n	\r\n\r\n \r\n\r\n-050\r\n	\r\n\r\n \r\n\r\n-100\r\n	\r\n\r\n \r\n\r\n80\r\n	\r\n\r\n \r\n\r\n \r\n\r\nThe prescription can be interpreted as:\r\n\r\n \r\n\r\n \r\n	\r\n\r\nSPH\r\n	\r\n\r\nCYL\r\n	\r\n\r\nAXIS\r\n	\r\n\r\nADD\r\n\r\n \r\n\r\nOD (RIGHT)\r\n	\r\n\r\n\r\n-0.25\r\n	\r\n\r\n \r\n\r\n-0.50\r\n\r\n \r\n	\r\n\r\n \r\n\r\n100\r\n	\r\n\r\n \r\n\r\n \r\n\r\nOS (LEFT)\r\n	\r\n\r\n \r\n\r\n-0.50\r\n	\r\n\r\n \r\n\r\n-1.00\r\n	\r\n\r\n \r\n\r\n80\r\n	\r\n\r\n \r\n\r\n \r\n\r\nPrescription 2:\r\n\r\n \r\n\r\n \r\n	\r\n\r\nSPH\r\n	\r\n\r\nCYL\r\n	\r\n\r\nAXIS\r\n	\r\n\r\nADD\r\n\r\n \r\n\r\nOD (RIGHT)\r\n	\r\n\r\n\r\n-0.25\r\n	\r\n\r\n \r\n\r\nCYL\r\n\r\n \r\n	\r\n\r\n \r\n\r\n______\r\n	\r\n\r\n \r\n\r\n \r\n\r\nOS (LEFT)\r\n	\r\n\r\n \r\n\r\n-0.50\r\n	\r\n\r\n \r\n\r\n-1.00\r\n	\r\n\r\n \r\n\r\n80\r\n	\r\n\r\n \r\n\r\n \r\n\r\nThe prescription can be interpreted as:\r\n\r\n \r\n\r\n \r\n\r\n \r\n	\r\n\r\nSPH\r\n	\r\n\r\nCYL\r\n	\r\n\r\nAXIS\r\n	\r\n\r\nADD\r\n\r\n \r\n\r\nOD (RIGHT)\r\n	\r\n\r\n\r\n-0.25\r\n	\r\n\r\n \r\n\r\nNONE  OR PLANO\r\n\r\n \r\n	\r\n\r\n \r\n\r\nNONE\r\n	\r\n\r\n \r\n\r\n \r\n\r\nOS (LEFT)\r\n	\r\n\r\n \r\n\r\n-0.50\r\n	\r\n\r\n \r\n\r\n-1.00\r\n	\r\n\r\n \r\n\r\n80\r\n	\r\n\r\n \r\n\r\n \r\n\r\nPlease note: If there is CYL power then Axis value is a must. If there is no value (plano) for CYL then axis will be none.\r\n\r\n \r\n\r\nPrescription 3:\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n \r\n	\r\n\r\nSPH\r\n	\r\n\r\nCYL\r\n	\r\n\r\nAXIS\r\n	\r\n\r\nADD\r\n\r\n \r\n\r\nOD (RIGHT)\r\n	\r\n\r\n       \r\n\r\n           -0.25                                 -1.00     X     30\r\n\r\n \r\n\r\n \r\n\r\nOS (LEFT)\r\n	\r\n\r\n \r\n\r\n           -0.50                               -1.00       X      90                           \r\n\r\n \r\n\r\nThe prescription can be interpreted as:\r\n\r\n \r\n\r\n \r\n	\r\n\r\nSPH\r\n	\r\n\r\nCYL\r\n	\r\n\r\nAXIS\r\n	\r\n\r\nADD\r\n\r\n \r\n\r\nOD (RIGHT)\r\n	\r\n\r\n\r\n-0.25\r\n	\r\n\r\n \r\n\r\n-1.00\r\n	\r\n\r\n \r\n\r\n30\r\n	\r\n\r\n \r\n\r\n \r\n\r\nOS (LEFT)\r\n	\r\n\r\n \r\n\r\n-0.50\r\n	\r\n\r\n \r\n\r\n-1.00\r\n	\r\n\r\n \r\n\r\n30'),
(21, 5, 'Why do I have to register?', 'We encourage our buyers to register for an account so that we can keep a track of your order and keep a history of your prescription (you can save multiple prescription of your family members) for faster checkout when you visit our store next time. By creating an account you can access your previous order and print the invoice hold order for 48 hrs so that you do not miss on your favorite frames that you would like to buy.  '),
(22, 5, 'My Orders? ', 'This feature allows you to view all the orders that you have placed from us and you can also print the invoice. You can track the glasses and view the current status of the order.'),
(23, 5, 'My Profile? ', 'You can update you personal information,view promotion code and your customer ID.\r\n'),
(24, 5, 'My Prescription?', 'With this feature you will be able to view your previous prescription and edit prescription for future purchase.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqtype`
--

CREATE TABLE IF NOT EXISTS `tbl_faqtype` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_faqtype` varchar(50) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_faqtype`
--

INSERT INTO `tbl_faqtype` (`fld_id`, `fld_faqtype`) VALUES
(1, 'How to order'),
(2, 'Lenses'),
(3, 'Prescription Help'),
(4, 'Shipping'),
(5, 'My Account'),
(6, 'Product'),
(7, 'Frames'),
(8, 'Payment'),
(9, 'Return and Refunds'),
(10, 'Cancellation');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_iaf`
--

CREATE TABLE IF NOT EXISTS `tbl_iaf` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_question` text NOT NULL,
  `fld_description` text NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_iaf`
--

INSERT INTO `tbl_iaf` (`fld_id`, `fld_question`, `fld_description`) VALUES
(1, 'This is the question?dsfds', 'This is answer description for your question.'),
(2, 'sdfdf', 'dfdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_package`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_package` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  `fld_temp_name` varchar(40) NOT NULL,
  `fld_price` decimal(5,2) NOT NULL,
  `fld_min` decimal(5,2) NOT NULL,
  `fld_max` decimal(5,2) NOT NULL,
  `fld_cyl_range` decimal(5,2) NOT NULL,
  `fld_title` varchar(50) NOT NULL,
  `fld_description` text,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tbl_lens_package`
--

INSERT INTO `tbl_lens_package` (`fld_id`, `fld_name`, `fld_temp_name`, `fld_price`, `fld_min`, `fld_max`, `fld_cyl_range`, `fld_title`, `fld_description`) VALUES
(13, 'Basic', 'Basic SVR', 0.00, -4.00, 2.00, 2.00, 'SVR', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc congue rhoncus mauris, nec lobortis justo mattis vitae. Sed dolor lectus, volutpat et tincidunt in, pulvinar quis ligula. Mauris orci dui, blandit non ultricies at, dictum a nisl. Mauris facilisis pretium consectetur. Sed sit amet enim sed nibh ullamcorper sollicitudin. In porta volutpat vulputate. Quisque ut bibendum ligula. Proin felis quam, interdum sed placerat at, imperdiet a justo. Sed et turpis ipsum, eu suscipit risus. Aliquam erat volutpat. Quisque neque enim, ullamcorper sit amet vehicula a, mollis eu ligula. In hac habitasse platea dictumst. Maecenas eget lacus vel diam adipiscing pulvinar sit amet et mauris. Sed lorem ipsum, gravida et pellentesque in, adipiscing non nisl. Phasellus suscipit interdum augue vel auctor. Aliquam erat volutpat.\r\n'),
(14, 'Bronze', 'Bronze SVR', 15.00, -8.00, 4.00, 2.00, 'SVR', 'Pellentesque dapibus luctus pulvinar. Suspendisse a lacus felis. Donec convallis hendrerit sem vitae sollicitudin. Suspendisse potenti. Vivamus justo tortor, porttitor id imperdiet ac, blandit eget ante. Aenean id odio sed nisl euismod cursus vel eget velit. Vestibulum eget ipsum et ante dignissim suscipit.\r\n\r\nVivamus volutpat aliquet eros eget condimentum. Ut purus quam, fermentum nec posuere eu, tristique venenatis mauris. Nullam vitae felis id quam tincidunt aliquam sed ac risus. Sed ornare scelerisque orci non feugiat. Nam viverra urna et turpis luctus eget bibendum urna luctus. Suspendisse mollis, justo ut ultricies malesuada, sem sapien dictum libero, ultricies tempus lorem eros in ante. Proin eu lorem sed massa feugiat placerat vel vitae lacus. Maecenas tincidunt pharetra nisl vitae porta. Suspendisse potenti. Nullam dui ligula, porttitor placerat laoreet quis, bibendum a velit. Proin sit amet quam eu dolor congue condimentum vitae ut velit. Pellentesque faucibus interdum luctus. Sed eu volutpat ante. Proin ultrices, neque ac varius rutrum, sem leo sagittis sapien, at vehicula lectus augue vitae enim. Nunc et dictum nisi.'),
(15, 'Silver', 'Silver SVR', 30.00, -12.00, 5.00, 4.00, 'SVR', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc congue rhoncus mauris, nec lobortis justo mattis vitae. Sed dolor lectus, volutpat et tincidunt in, pulvinar quis ligula. Mauris orci dui, blandit non ultricies at, dictum a nisl. Mauris facilisis pretium consectetur. Sed sit amet enim sed nibh ullamcorper sollicitudin. In porta volutpat vulputate. Quisque ut bibendum ligula. Proin felis quam, interdum sed placerat at, imperdiet a justo. Sed et turpis ipsum, eu suscipit risus. Aliquam erat volutpat. Quisque neque enim, ullamcorper sit amet vehicula a, mollis eu ligula. In hac habitasse platea dictumst. Maecenas eget lacus vel diam adipiscing pulvinar sit amet et mauris. Sed lorem ipsum, gravida et pellentesque in, adipiscing non nisl. Phasellus suscipit interdum augue vel auctor. Aliquam erat volutpat.\r\n'),
(16, 'Gold', 'Gold SVR', 50.00, -16.00, 8.00, 4.00, 'SVR', 'Morbi eros metus, viverra eu elementum ut, tempor eu nunc. Aenean eget dui velit. Donec et arcu magna. Quisque pellentesque, sapien a lobortis vulputate, magna lacus volutpat mauris, ut volutpat turpis purus nec turpis. Praesent sollicitudin sollicitudin mattis. Suspendisse vestibulum suscipit erat tincidunt luctus. Pellentesque imperdiet libero vel leo facilisis non malesuada nulla pellentesque. Nulla scelerisque faucibus cursus. Quisque semper ultrices lacus eu dapibus. Praesent tempus varius enim, id pretium metus ultrices quis. Nullam adipiscing, odio ac consequat gravida, mi urna convallis mi, id posuere orci sapien sed nunc. Etiam molestie bibendum nunc, vel faucibus dolor tempus vel. Etiam ullamcorper, dolor a facilisis ultrices, nisi augue ullamcorper orci, at egestas ante nulla id mi.\r\n'),
(17, 'Basic', 'Basic SVD', 0.00, -4.00, 2.00, 2.00, 'SVD', 'Pellentesque dapibus luctus pulvinar. Suspendisse a lacus felis. Donec convallis hendrerit sem vitae sollicitudin. Suspendisse potenti. Vivamus justo tortor, porttitor id imperdiet ac, blandit eget ante. Aenean id odio sed nisl euismod cursus vel eget velit. Vestibulum eget ipsum et ante dignissim suscipit.\r\n\r\nVivamus volutpat aliquet eros eget condimentum. Ut purus quam, fermentum nec posuere eu, tristique venenatis mauris. Nullam vitae felis id quam tincidunt aliquam sed ac risus. Sed ornare scelerisque orci non feugiat. Nam viverra urna et turpis luctus eget bibendum urna luctus. Suspendisse mollis, justo ut ultricies malesuada, sem sapien dictum libero, ultricies tempus lorem eros in ante. Proin eu lorem sed massa feugiat placerat vel vitae lacus. Maecenas tincidunt pharetra nisl vitae porta. Suspendisse potenti. Nullam dui ligula, porttitor placerat laoreet quis, bibendum a velit. Proin sit amet quam eu dolor congue condimentum vitae ut velit. Pellentesque faucibus interdum luctus. Sed eu volutpat ante. Proin ultrices, neque ac varius rutrum, sem leo sagittis sapien, at vehicula lectus augue vitae enim. Nunc et dictum nisi.'),
(19, 'Silver', 'Silver SVD', 15.00, -12.00, 5.00, 4.00, 'SVD', 'In pretium nisi eu lectus dictum facilisis. Donec placerat nunc eget felis feugiat vestibulum. Fusce ultrices, ipsum sit amet ultrices scelerisque, sapien purus pellentesque ante, eget semper nisi ligula ac turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae nibh ipsum. Donec ullamcorper elementum adipiscing. Cras felis dolor, ultrices in accumsan eu, ornare eu felis. Donec convallis feugiat nisl, cursus blandit magna mattis venenatis. Etiam eu tempor lorem. Vivamus lorem dolor, congue quis consectetur nec, pulvinar at justo. In at sem arcu, in accumsan lorem.\r\n'),
(20, 'Gold', 'Gold SVD', 30.00, -16.00, 8.00, 4.00, 'SVD', 'Morbi eros metus, viverra eu elementum ut, tempor eu nunc. Aenean eget dui velit. Donec et arcu magna. Quisque pellentesque, sapien a lobortis vulputate, magna lacus volutpat mauris, ut volutpat turpis purus nec turpis. Praesent sollicitudin sollicitudin mattis. Suspendisse vestibulum suscipit erat tincidunt luctus. Pellentesque imperdiet libero vel leo facilisis non malesuada nulla pellentesque. Nulla scelerisque faucibus cursus. Quisque semper ultrices lacus eu dapibus. Praesent tempus varius enim, id pretium metus ultrices quis. Nullam adipiscing, odio ac consequat gravida, mi urna convallis mi, id posuere orci sapien sed nunc. Etiam molestie bibendum nunc, vel faucibus dolor tempus vel. Etiam ullamcorper, dolor a facilisis ultrices, nisi augue ullamcorper orci, at egestas ante nulla id mi.\r\n'),
(21, 'Basic', 'Basic Progressive', 0.00, -4.00, 2.00, 2.00, 'Progressive', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc congue rhoncus mauris, nec lobortis justo mattis vitae. Sed dolor lectus, volutpat et tincidunt in, pulvinar quis ligula. Mauris orci dui, blandit non ultricies at, dictum a nisl. Mauris facilisis pretium consectetur. Sed sit amet enim sed nibh ullamcorper sollicitudin. In porta volutpat vulputate. Quisque ut bibendum ligula. Proin felis quam, interdum sed placerat at, imperdiet a justo. Sed et turpis ipsum, eu suscipit risus. Aliquam erat volutpat. Quisque neque enim, ullamcorper sit amet vehicula a, mollis eu ligula. In hac habitasse platea dictumst. Maecenas eget lacus vel diam adipiscing pulvinar sit amet et mauris. Sed lorem ipsum, gravida et pellentesque in, adipiscing non nisl. Phasellus suscipit interdum augue vel auctor. Aliquam erat volutpat.\r\n'),
(22, 'Bronze', 'Bronze Progressive', 15.99, -8.00, 4.00, 2.00, 'Progressive', 'Pellentesque dapibus luctus pulvinar. Suspendisse a lacus felis. Donec convallis hendrerit sem vitae sollicitudin. Suspendisse potenti. Vivamus justo tortor, porttitor id imperdiet ac, blandit eget ante. Aenean id odio sed nisl euismod cursus vel eget velit. Vestibulum eget ipsum et ante dignissim suscipit.\r\n\r\nVivamus volutpat aliquet eros eget condimentum. Ut purus quam, fermentum nec posuere eu, tristique venenatis mauris. Nullam vitae felis id quam tincidunt aliquam sed ac risus. Sed ornare scelerisque orci non feugiat. Nam viverra urna et turpis luctus eget bibendum urna luctus. Suspendisse mollis, justo ut ultricies malesuada, sem sapien dictum libero, ultricies tempus lorem eros in ante. Proin eu lorem sed massa feugiat placerat vel vitae lacus. Maecenas tincidunt pharetra nisl vitae porta. Suspendisse potenti. Nullam dui ligula, porttitor placerat laoreet quis, bibendum a velit. Proin sit amet quam eu dolor congue condimentum vitae ut velit. Pellentesque faucibus interdum luctus. Sed eu volutpat ante. Proin ultrices, neque ac varius rutrum, sem leo sagittis sapien, at vehicula lectus augue vitae enim. Nunc et dictum nisi.'),
(23, 'Silver', 'Silver Progressive', 30.00, -12.00, 5.00, 4.00, 'Progressive', 'Morbi eros metus, viverra eu elementum ut, tempor eu nunc. Aenean eget dui velit. Donec et arcu magna. Quisque pellentesque, sapien a lobortis vulputate, magna lacus volutpat mauris, ut volutpat turpis purus nec turpis. Praesent sollicitudin sollicitudin mattis. Suspendisse vestibulum suscipit erat tincidunt luctus. Pellentesque imperdiet libero vel leo facilisis non malesuada nulla pellentesque. Nulla scelerisque faucibus cursus. Quisque semper ultrices lacus eu dapibus. Praesent tempus varius enim, id pretium metus ultrices quis. Nullam adipiscing, odio ac consequat gravida, mi urna convallis mi, id posuere orci sapien sed nunc. Etiam molestie bibendum nunc, vel faucibus dolor tempus vel. Etiam ullamcorper, dolor a facilisis ultrices, nisi augue ullamcorper orci, at egestas ante nulla id mi.\r\n'),
(24, 'Gold', 'Gold Progressive', 50.00, -16.00, 8.00, 4.00, 'Progressive', 'In pretium nisi eu lectus dictum facilisis. Donec placerat nunc eget felis feugiat vestibulum. Fusce ultrices, ipsum sit amet ultrices scelerisque, sapien purus pellentesque ante, eget semper nisi ligula ac turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae nibh ipsum. Donec ullamcorper elementum adipiscing. Cras felis dolor, ultrices in accumsan eu, ornare eu felis. Donec convallis feugiat nisl, cursus blandit magna mattis venenatis. Etiam eu tempor lorem. Vivamus lorem dolor, congue quis consectetur nec, pulvinar at justo. In at sem arcu, in accumsan lorem.\r\n'),
(25, 'Basic', 'Basic Bifocal', 0.00, -4.00, 2.00, 2.00, 'Bifocal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc congue rhoncus mauris, nec lobortis justo mattis vitae. Sed dolor lectus, volutpat et tincidunt in, pulvinar quis ligula. Mauris orci dui, blandit non ultricies at, dictum a nisl. Mauris facilisis pretium consectetur. Sed sit amet enim sed nibh ullamcorper sollicitudin. In porta volutpat vulputate. Quisque ut bibendum ligula. Proin felis quam, interdum sed placerat at, imperdiet a justo. Sed et turpis ipsum, eu suscipit risus. Aliquam erat volutpat. Quisque neque enim, ullamcorper sit amet vehicula a, mollis eu ligula. In hac habitasse platea dictumst. Maecenas eget lacus vel diam adipiscing pulvinar sit amet et mauris. Sed lorem ipsum, gravida et pellentesque in, adipiscing non nisl. Phasellus suscipit interdum augue vel auctor. Aliquam erat volutpat.\r\n'),
(26, 'Bronze', 'Bronze Bifocal', 12.99, -8.00, 4.00, 2.00, 'Bifocal', 'Morbi eros metus, viverra eu elementum ut, tempor eu nunc. Aenean eget dui velit. Donec et arcu magna. Quisque pellentesque, sapien a lobortis vulputate, magna lacus volutpat mauris, ut volutpat turpis purus nec turpis. Praesent sollicitudin sollicitudin mattis. Suspendisse vestibulum suscipit erat tincidunt luctus. Pellentesque imperdiet libero vel leo facilisis non malesuada nulla pellentesque. Nulla scelerisque faucibus cursus. Quisque semper ultrices lacus eu dapibus. Praesent tempus varius enim, id pretium metus ultrices quis. Nullam adipiscing, odio ac consequat gravida, mi urna convallis mi, id posuere orci sapien sed nunc. Etiam molestie bibendum nunc, vel faucibus dolor tempus vel. Etiam ullamcorper, dolor a facilisis ultrices, nisi augue ullamcorper orci, at egestas ante nulla id mi.\r\n'),
(27, 'Silver', 'Silver Bifocal', 35.34, -12.00, 5.00, 4.00, 'Bifocal', 'Pellentesque dapibus luctus pulvinar. Suspendisse a lacus felis. Donec convallis hendrerit sem vitae sollicitudin. Suspendisse potenti. Vivamus justo tortor, porttitor id imperdiet ac, blandit eget ante. Aenean id odio sed nisl euismod cursus vel eget velit. Vestibulum eget ipsum et ante dignissim suscipit.\r\n\r\nVivamus volutpat aliquet eros eget condimentum. Ut purus quam, fermentum nec posuere eu, tristique venenatis mauris. Nullam vitae felis id quam tincidunt aliquam sed ac risus. Sed ornare scelerisque orci non feugiat. Nam viverra urna et turpis luctus eget bibendum urna luctus. Suspendisse mollis, justo ut ultricies malesuada, sem sapien dictum libero, ultricies tempus lorem eros in ante. Proin eu lorem sed massa feugiat placerat vel vitae lacus. Maecenas tincidunt pharetra nisl vitae porta. Suspendisse potenti. Nullam dui ligula, porttitor placerat laoreet quis, bibendum a velit. Proin sit amet quam eu dolor congue condimentum vitae ut velit. Pellentesque faucibus interdum luctus. Sed eu volutpat ante. Proin ultrices, neque ac varius rutrum, sem leo sagittis sapien, at vehicula lectus augue vitae enim. Nunc et dictum nisi.'),
(28, 'Gold', 'Gold Bifocal', 45.55, -16.00, 8.00, 4.00, 'Bifocal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc congue rhoncus mauris, nec lobortis justo mattis vitae. Sed dolor lectus, volutpat et tincidunt in, pulvinar quis ligula. Mauris orci dui, blandit non ultricies at, dictum a nisl. Mauris facilisis pretium consectetur. Sed sit amet enim sed nibh ullamcorper sollicitudin. In porta volutpat vulputate. Quisque ut bibendum ligula. Proin felis quam, interdum sed placerat at, imperdiet a justo. Sed et turpis ipsum, eu suscipit risus. Aliquam erat volutpat. Quisque neque enim, ullamcorper sit amet vehicula a, mollis eu ligula. In hac habitasse platea dictumst. Maecenas eget lacus vel diam adipiscing pulvinar sit amet et mauris. Sed lorem ipsum, gravida et pellentesque in, adipiscing non nisl. Phasellus suscipit interdum augue vel auctor. Aliquam erat volutpat.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_package_attribute`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_package_attribute` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_lens_package_attribute`
--

INSERT INTO `tbl_lens_package_attribute` (`fld_id`, `fld_name`) VALUES
(1, 'Anti Reflective Coating'),
(2, 'UV Protection'),
(3, 'Anti Scratch Coating'),
(4, 'Standard Plastic CR39 Lenses');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_package_attribute_value`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_package_attribute_value` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_lens_package_attribute_id` int(11) NOT NULL,
  `fld_package_id` int(11) NOT NULL,
  `fld_display` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=277 ;

--
-- Dumping data for table `tbl_lens_package_attribute_value`
--

INSERT INTO `tbl_lens_package_attribute_value` (`fld_id`, `fld_lens_package_attribute_id`, `fld_package_id`, `fld_display`) VALUES
(29, 4, 14, NULL),
(30, 3, 14, NULL),
(31, 4, 15, NULL),
(32, 3, 15, NULL),
(33, 2, 15, NULL),
(72, 4, 27, NULL),
(73, 3, 27, NULL),
(74, 2, 27, NULL),
(75, 4, 26, NULL),
(76, 3, 26, NULL),
(93, 4, 16, NULL),
(94, 3, 16, NULL),
(95, 2, 16, NULL),
(96, 1, 16, NULL),
(101, 4, 23, NULL),
(102, 3, 23, NULL),
(103, 2, 23, NULL),
(104, 1, 23, NULL),
(204, 4, 22, 1),
(205, 3, 22, 0),
(212, 4, 25, 0),
(233, 4, 28, 1),
(234, 3, 28, 1),
(235, 2, 28, 0),
(236, 1, 28, 1),
(250, 4, 19, 1),
(251, 3, 19, 1),
(252, 2, 19, 1),
(253, 4, 13, 1),
(262, 4, 24, 1),
(263, 3, 24, 1),
(264, 2, 24, 0),
(265, 1, 24, 1),
(266, 4, 20, 1),
(267, 3, 20, 1),
(268, 2, 20, 1),
(269, 1, 20, 1),
(275, 4, 17, 1),
(276, 4, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_package_upgrade`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_package_upgrade` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_package_id` int(11) NOT NULL,
  `fld_lens_upgrade_id` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `tbl_lens_package_upgrade`
--

INSERT INTO `tbl_lens_package_upgrade` (`fld_id`, `fld_package_id`, `fld_lens_upgrade_id`) VALUES
(27, 27, 4),
(28, 27, 3),
(29, 27, 1),
(30, 26, 4),
(31, 26, 3),
(32, 26, 2),
(33, 25, 4),
(49, 16, 4),
(50, 16, 3),
(53, 28, 2),
(54, 23, 4),
(55, 23, 3),
(56, 23, 2),
(62, 22, 2),
(63, 22, 1),
(71, 25, 1),
(85, 28, 4),
(86, 28, 3),
(101, 19, 4),
(102, 19, 3),
(103, 13, 4),
(108, 24, 4),
(109, 24, 3),
(110, 20, 4),
(111, 20, 3),
(115, 17, 4),
(116, 17, 3),
(117, 21, 4),
(118, 21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_type`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_type` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_lens_type`
--

INSERT INTO `tbl_lens_type` (`fld_id`, `fld_name`) VALUES
(1, 'Progressive'),
(2, 'Bifocal'),
(3, 'Single Vision Distant'),
(4, 'Single Vision Reading');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_type_package_value`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_type_package_value` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_lens_type_id` int(11) NOT NULL,
  `fld_lens_package_id` int(11) NOT NULL,
  `fld_rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `tbl_lens_type_package_value`
--

INSERT INTO `tbl_lens_type_package_value` (`fld_id`, `fld_lens_type_id`, `fld_lens_package_id`, `fld_rank`) VALUES
(63, 5, 4, 0),
(64, 5, 3, 0),
(65, 5, 1, 0),
(111, 4, 16, 0),
(112, 4, 15, 0),
(113, 4, 14, 0),
(114, 4, 13, 0),
(115, 3, 20, 0),
(116, 3, 19, 0),
(117, 3, 18, 0),
(118, 3, 17, 0),
(119, 2, 28, 0),
(120, 2, 27, 0),
(121, 2, 26, 0),
(122, 2, 25, 0),
(123, 1, 24, 0),
(124, 1, 23, 0),
(125, 1, 22, 0),
(126, 1, 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_type_upgrade`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_type_upgrade` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_lens_type_id` int(11) NOT NULL,
  `fld_lens_upgrade_id` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `tbl_lens_type_upgrade`
--

INSERT INTO `tbl_lens_type_upgrade` (`fld_id`, `fld_lens_type_id`, `fld_lens_upgrade_id`) VALUES
(94, 5, 4),
(95, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_upgrade`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_upgrade` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  `fld_price` decimal(5,2) NOT NULL,
  `fld_description` text,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_lens_upgrade`
--

INSERT INTO `tbl_lens_upgrade` (`fld_id`, `fld_name`, `fld_price`, `fld_description`) VALUES
(1, 'Polarized', 15.00, 'In pretium nisi eu lectus dictum facilisis. Donec placerat nunc eget felis feugiat vestibulum. Fusce ultrices, ipsum sit amet ultrices scelerisque, sapien purus pellentesque ante, eget semper nisi ligula ac turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae nibh ipsum. Donec ullamcorper elementum adipiscing. Cras felis dolor, ultrices in accumsan eu, ornare eu felis. Donec convallis feugiat nisl, cursus blandit magna mattis venenatis. Etiam eu tempor lorem. Vivamus lorem dolor, congue quis consectetur nec, pulvinar at justo. In at sem arcu, in accumsan lorem.\r\n'),
(2, 'Tinted', 10.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at nisl arcu, id sagittis lacus. Donec consectetur orci adipiscing orci lacinia iaculis. Nulla facilisi. Donec at consequat metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam luctus erat a lorem malesuada ut suscipit neque pellentesque. Ut ligula tortor, pellentesque in rutrum ac, ultricies vitae tellus. Curabitur eget quam in diam lobortis dignissim. Donec iaculis tincidunt sollicitudin. Sed id rutrum lacus.\r\n'),
(3, 'Transitions', 5.00, 'Morbi bibendum sem sit amet nulla laoreet viverra. Aenean sit amet imperdiet arcu. Quisque tincidunt eros et lorem fermentum interdum. Nullam quis cursus nulla. Proin varius velit vehicula arcu gravida vulputate. Aliquam vel vehicula mauris. Morbi blandit diam non sapien semper id pretium sapien lacinia. Curabitur nec nunc nisl, a tempor orci. Vivamus mollis feugiat laoreet. Quisque posuere facilisis dui, ut hendrerit risus porta id. Aenean ante augue, aliquam at interdum congue, gravida nec dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In hac habitasse platea dictumst. Sed vitae justo turpis. Fusce accumsan, lectus ullamcorper ultricies malesuada, quam metus eleifend libero, blandit congue nisl turpis non nunc.\r\n'),
(4, 'PhotoChromatic', 15.00, 'In pretium nisi eu lectus dictum facilisis. Donec placerat nunc eget felis feugiat vestibulum. Fusce ultrices, ipsum sit amet ultrices scelerisque, sapien purus pellentesque ante, eget semper nisi ligula ac turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae nibh ipsum. Donec ullamcorper elementum adipiscing. Cras felis dolor, ultrices in accumsan eu, ornare eu felis. Donec convallis feugiat nisl, cursus blandit magna mattis venenatis. Etiam eu tempor lorem. Vivamus lorem dolor, congue quis consectetur nec, pulvinar at justo. In at sem arcu, in accumsan lorem.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_upgrade_attribute`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_upgrade_attribute` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  `fld_upgrade_id` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_lens_upgrade_attribute`
--

INSERT INTO `tbl_lens_upgrade_attribute` (`fld_id`, `fld_name`, `fld_upgrade_id`) VALUES
(1, 'Color', 3),
(2, 'Color', 2),
(3, 'Color', 1),
(4, 'Color', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lens_upgrade_attribute_value`
--

CREATE TABLE IF NOT EXISTS `tbl_lens_upgrade_attribute_value` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  `fld_extra` varchar(255) NOT NULL,
  `fld_upgrade_attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `tbl_lens_upgrade_attribute_value`
--

INSERT INTO `tbl_lens_upgrade_attribute_value` (`fld_id`, `fld_name`, `fld_extra`, `fld_upgrade_attribute_id`) VALUES
(1, 'Green', '00ff00', 1),
(2, 'Blue', '0000ff', 1),
(3, 'Red', 'ff0000', 1),
(4, 'Red', 'ff0000', 2),
(5, 'Green', '00ff00', 2),
(6, 'Black', '000000', 2),
(7, 'Blue', '0000ff', 3),
(8, 'Black', '000000', 3),
(9, 'Sky Blue', '02a9d3', 3),
(48, 'Red', 'ff0000', 4),
(49, 'Black', '000000', 4),
(50, 'Grey', 'cccccc', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meta`
--

CREATE TABLE IF NOT EXISTS `tbl_meta` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_title` varchar(225) NOT NULL,
  `fld_keywords` text NOT NULL,
  `fld_meta` text NOT NULL,
  `fld_page` varchar(250) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_meta`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE IF NOT EXISTS `tbl_modules` (
  `fld_id` int(240) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(2000) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`fld_id`, `fld_name`) VALUES
(1, 'Role Setting'),
(2, 'User Setting'),
(3, 'Product_type Manager'),
(4, 'Category Manager'),
(5, 'Product Manager'),
(6, 'Lens_type Manager'),
(7, 'Enduser Manager'),
(8, 'Meta Manager'),
(9, 'Dynamic Page Manager'),
(10, 'Page_Rank Manager'),
(11, 'FAQ Manager'),
(12, 'Carrier'),
(13, 'Vendor'),
(14, 'Order Manager'),
(15, 'Promocode Manager'),
(16, 'Package_Attributes'),
(17, 'Contact_Lens');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_first_name` varchar(240) NOT NULL,
  `fld_last_name` varchar(240) NOT NULL,
  `fld_email` varchar(240) NOT NULL,
  `fld_country` varchar(240) NOT NULL,
  `fld_state` varchar(50) NOT NULL,
  `fld_city` varchar(240) NOT NULL,
  `fld_contact_no` int(11) NOT NULL,
  `fld_date` date NOT NULL,
  `fld_expire_date` date NOT NULL,
  `fld_status` varchar(255) NOT NULL,
  `fld_promocode_discount` decimal(5,2) NOT NULL,
  `fld_user` int(11) NOT NULL,
  `fld_invoice` varchar(255) NOT NULL,
  `fld_payment_type` varchar(255) NOT NULL,
  `fld_payment_status` varchar(240) NOT NULL,
  `fld_carrier_country` varchar(255) NOT NULL,
  `fld_carrier` varchar(255) NOT NULL,
  `fld_shipping_cost` decimal(5,2) NOT NULL,
  `fld_insurance_cost` decimal(5,2) NOT NULL,
  `fld_txn_id` varchar(40) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_order_attributes` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_order` int(11) NOT NULL,
  `fld_order_item` int(11) NOT NULL,
  `fld_attribute` varchar(50) NOT NULL,
  `fld_attribute_value` varchar(50) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_order_attributes`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_item`
--

CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_order` int(11) NOT NULL,
  `fld_product_id` int(11) NOT NULL,
  `fld_product_qty` int(11) NOT NULL,
  `fld_product` varchar(50) NOT NULL,
  `fld_product_price` decimal(5,2) NOT NULL,
  `fld_lens_type` varchar(50) NOT NULL,
  `fld_lens_package` varchar(50) DEFAULT NULL,
  `fld_lens_package_price` decimal(5,2) DEFAULT NULL,
  `fld_lens_upgrade` varchar(50) DEFAULT NULL,
  `fld_lens_upgrade_price` decimal(5,2) DEFAULT NULL,
  `fld_prescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_order_item`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_lens_package_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_order_lens_package_attributes` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_order` int(11) NOT NULL,
  `fld_order_item` int(11) NOT NULL,
  `fld_lens_attribute` varchar(50) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_order_lens_package_attributes`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_lens_upgrade_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_order_lens_upgrade_attributes` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_order` int(11) NOT NULL,
  `fld_order_item` int(11) NOT NULL,
  `fld_upgrade_attribute` varchar(50) NOT NULL,
  `fld_upgrade_attribute_value` varchar(50) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_order_lens_upgrade_attributes`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE IF NOT EXISTS `tbl_page` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_page` varchar(225) NOT NULL,
  `fld_content` text NOT NULL,
  `fld_type` int(11) NOT NULL,
  `fld_url` varchar(255) NOT NULL,
  `fld_alt` varchar(255) NOT NULL,
  `fld_target` varchar(20) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`fld_id`, `fld_page`, `fld_content`, `fld_type`, `fld_url`, `fld_alt`, `fld_target`) VALUES
(23, 'Home', '', 2, 'http://localhost/optic', 'this is home page', '_self'),
(24, 'Contact', '', 2, '#', 'contact page', '_self'),
(25, 'Business', '', 2, '#', 'Business page', '_self'),
(26, 'Feedback', '', 2, '#', 'Feedback to opticstore', '_self'),
(27, 'Help', '', 2, '#', 'Faq help', '_self'),
(28, 'Sitemap', '', 2, '#', 'Site map', '_self');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_presc_entry`
--

CREATE TABLE IF NOT EXISTS `tbl_presc_entry` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_sph_od` varchar(50) DEFAULT NULL,
  `fld_sph_os` varchar(50) DEFAULT NULL,
  `fld_cyl_od` varchar(50) DEFAULT NULL,
  `fld_cyl_os` varchar(50) DEFAULT NULL,
  `fld_axis_od` varchar(50) DEFAULT NULL,
  `fld_axis_os` varchar(50) DEFAULT NULL,
  `fld_add_od` varchar(50) DEFAULT NULL,
  `fld_add_os` varchar(50) DEFAULT NULL,
  `fld_power_od` varchar(50) DEFAULT NULL,
  `fld_power_os` varchar(50) DEFAULT NULL,
  `fld_patient_name` varchar(255) DEFAULT NULL,
  `fld_pd` varchar(50) DEFAULT NULL,
  `fld_pd_right` varchar(50) DEFAULT NULL,
  `fld_pd_left` varchar(50) DEFAULT NULL,
  `fld_remarks` text,
  `fld_order_item` int(11) NOT NULL,
  `fld_prescription_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tbl_presc_entry`
--

INSERT INTO `tbl_presc_entry` (`fld_id`, `fld_sph_od`, `fld_sph_os`, `fld_cyl_od`, `fld_cyl_os`, `fld_axis_od`, `fld_axis_os`, `fld_add_od`, `fld_add_os`, `fld_power_od`, `fld_power_os`, `fld_patient_name`, `fld_pd`, `fld_pd_right`, `fld_pd_left`, `fld_remarks`, `fld_order_item`, `fld_prescription_path`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'prescriptions/2013/06/20/y6cU_3.jpg'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'prescriptions/2013/06/21/t6TM_2.jpg'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'prescriptions/2013/06/20/2UFi_3.jpg'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 'prescriptions/2013/06/21/HJQs_2.jpg'),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL),
(6, '-3.75', '-4.25', '-2.5', '-3.5', '8', '3', '3', '1.75', '-5', '-6', 'hello', '39', '', '', 'just to say hello', 6, '0'),
(7, '-2.75', '0', '-2.5', '-2.5', '5', '9', '', '', '-4', '-1.25', 'gon', '40', '', '', 'fa fasdf asf', 7, '0'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL),
(9, '', '', '', '', '', '', '', '', '', '', 'Umesh Gurung', '', '', '', '', 9, 'prescriptions/2013/06/20/4omN_2.jpg'),
(10, '-4.5', '-4', '-0.25', '', '6', '', '', '', '-4.625', '-4', 'Umesh Gurung', '39', '', '', '', 10, ''),
(11, '-2.75', '-3.25', '-3', '-3.25', '6', '6', '3', '1.75', '-4.25', '-4.875', 'tetset', '45.5', '', '', 'sdfas gasfasfd ', 11, '0'),
(12, '-3.25', '-3.75', '-3.25', '+2.75', '14', '16', '1.75', '2.25', '-4.875', '-2.375', 'Umesh Gurung', '39.5', '', '', '', 12, '0'),
(13, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', 13, ''),
(14, '-1.75', '-1', '-0.75', '+0.25', '70', '90', '1.25', '1.75', '-2.125', '-0.875', 'Bhai kaji Shrestha', '38', '', '', '', 15, '0'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 'prescriptions/2013/07/02/3ahJ_Iron_man_reverse_wrap.jpg'),
(16, '', '', '', '', '', '', '', '', '', '', 'Umesh Gurung', '', '', '', '', 17, 'prescriptions/2013/06/20/4omN_2.jpg'),
(17, '', '', '', '', '', '', '', '', '', '', 'Umesh Gurung', '', '', '', '', 18, 'prescriptions/2013/06/20/2UFi_3.jpg'),
(18, '-2.75', '0', '+2.75', '', '9', '', '', '', '-1.375', '0', 'Mahesh Shrestha', '39.5', '', '', 'What is the extra comment', 19, ''),
(19, '', '', '', '', '', '', '', '', '', '', 'Rabin Shrestha', '', '', '', '', 20, 'prescriptions/2013/06/20/re0S_1.jpg'),
(20, '-2.75', '0', '+2.75', '', '9', '', '', '', '-1.375', '0', 'Mahesh Shrestha', '39.5', '', '', 'What is the extra comment', 21, ''),
(21, '-3.5', '-0.5', '-3.5', '-0.5', '2', '14', '1', '1', '-5.25', '-0.75', 'hello', '46', '', '', 'adsf asd fasdf ', 22, '0'),
(22, '', '', '', '', '', '', '', '', '', '', 'Umesh Gurung', '', '', '', '', 23, 'prescriptions/2013/06/20/2UFi_3.jpg'),
(23, '-4.5', '-4', '-0.25', '', '6', '', '', '', '-4.625', '-4', 'Umesh Gurung', '39', '', '', '', 24, ''),
(24, '-4.5', '-4', '-0.25', '', '6', '', '', '', '-4.625', '-4', 'Umesh Gurung', '39', '', '', '', 25, ''),
(25, '-4.5', '-4', '-0.25', '', '6', '', '', '', '-4.625', '-4', 'Umesh Gurung', '39', '', '', '', 26, ''),
(26, '-4.5', '-4', '-0.25', '', '6', '', '', '', '-4.625', '-4', 'Umesh Gurung', '39', '', '', '', 27, ''),
(27, '-2.75', '0', '+2.75', '', '9', '', '', '', '-1.375', '0', 'Mahesh Shrestha', '39.5', '', '', 'What is the extra comment', 28, ''),
(28, '', '', '', '', '', '', '', '', '', '', 'Rabin Shrestha', '', '', '', '', 29, 'prescriptions/2013/06/20/re0S_1.jpg'),
(29, '', '', '', '', '', '', '', '', '', '', 'Rabin Shrestha', '', '', '', '', 30, 'prescriptions/2013/06/20/re0S_1.jpg'),
(30, '-2.75', '0', '+2.75', '', '9', '', '', '', '-1.375', '0', 'Mahesh Shrestha', '39.5', '', '', 'What is the extra comment', 31, ''),
(31, '-3.25', '0', '-2.25', '', '6', '', '2.25', '', '-4.375', '0', 'Rabin Shrestha', '38.5', '', '', 'this is extra comment and i want it to be here. So i commented here. that''s fine with all the guys. So be cool and go to home...and party on dude....', 32, '0'),
(32, '-2.75', '0', '+2.75', '', '9', '', '', '', '-1.375', '0', 'Mahesh Shrestha', '39.5', '', '', 'What is the extra comment', 33, ''),
(33, '-3', '-3.5', '', '', '', '', '', '', '-3', '-3.5', 'hello', '45.5', '', '', '', 34, '0'),
(34, '-3.75', '0', '', '', '', '', '', '', '-3.75', '0', 'hello', '46', '', '', '', 35, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_privileges`
--

CREATE TABLE IF NOT EXISTS `tbl_privileges` (
  `fld_id` int(240) NOT NULL AUTO_INCREMENT,
  `fld_insert` int(240) NOT NULL,
  `fld_update` int(240) NOT NULL,
  `fld_delete` int(11) NOT NULL,
  `fld_view` int(11) NOT NULL,
  `fld_module_id` int(11) NOT NULL,
  `fld_role_id` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `tbl_privileges`
--

INSERT INTO `tbl_privileges` (`fld_id`, `fld_insert`, `fld_update`, `fld_delete`, `fld_view`, `fld_module_id`, `fld_role_id`) VALUES
(32, 1, 1, 1, 1, 14, 2),
(33, 1, 1, 1, 1, 14, 3),
(81, 1, 1, 1, 1, 1, 1),
(82, 1, 1, 1, 1, 2, 1),
(83, 1, 1, 1, 1, 3, 1),
(84, 1, 1, 1, 1, 4, 1),
(85, 1, 1, 1, 1, 5, 1),
(86, 1, 1, 1, 1, 6, 1),
(87, 1, 1, 1, 1, 7, 1),
(88, 1, 1, 1, 1, 8, 1),
(89, 1, 1, 1, 1, 9, 1),
(90, 1, 1, 1, 1, 10, 1),
(91, 1, 1, 1, 1, 11, 1),
(92, 1, 1, 1, 1, 12, 1),
(93, 1, 1, 1, 1, 13, 1),
(94, 1, 1, 1, 1, 14, 1),
(95, 1, 1, 1, 1, 15, 1),
(96, 1, 1, 1, 1, 16, 1),
(97, 1, 1, 1, 1, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `fld_id` int(240) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(2000) NOT NULL,
  `fld_code` varchar(2000) NOT NULL,
  `fld_vendor` int(11) NOT NULL,
  `fld_price` decimal(5,2) NOT NULL,
  `fld_status` int(240) NOT NULL,
  `fld_stock` int(240) NOT NULL,
  `fld_category` int(240) NOT NULL,
  `fld_subcategory` int(240) NOT NULL,
  `fld_product_type` int(240) NOT NULL,
  `fld_cp` decimal(7,2) NOT NULL,
  `fld_shelf` varchar(11) NOT NULL,
  `fld_size_bridge_width` int(11) NOT NULL,
  `fld_size_eye_size` int(11) NOT NULL,
  `fld_size_lens_height` int(11) NOT NULL,
  `fld_size_temple_arm` int(11) NOT NULL,
  `fld_size_total_width` int(11) NOT NULL,
  `fld_discount` int(11) NOT NULL,
  `fld_sp` decimal(7,2) NOT NULL,
  `fld_description` text NOT NULL,
  `fld_featured` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`fld_id`, `fld_name`, `fld_code`, `fld_vendor`, `fld_price`, `fld_status`, `fld_stock`, `fld_category`, `fld_subcategory`, `fld_product_type`, `fld_cp`, `fld_shelf`, `fld_size_bridge_width`, `fld_size_eye_size`, `fld_size_lens_height`, `fld_size_temple_arm`, `fld_size_total_width`, `fld_discount`, `fld_sp`, `fld_description`, `fld_featured`) VALUES
(7, 'Gold', 'oj8g7', 1, 125.00, 1, 12, 5, 0, 4, 120.00, '11B', 12, 35, 24, 108, 100, 0, 125.00, 'Integer mi velit, lacinia id facilisis ac, aliquet eget dolor. Duis porta ultrices tortor vitae commodo. In sit amet leo urna. Praesent placerat sem porttitor diam mollis quis eleifend metus tristique. Vestibulum lectus nibh, sodales a posuere id, pellentesque id eros. Sed viverra dignissim enim. Nunc in mi vel augue faucibus facilisis vel at neque. Curabitur porttitor hendrerit massa, eu cursus augue vehicula id. Curabitur blandit tortor a orci porttitor vitae bibendum mi mollis. Phasellus at mi felis. In ac semper sapien. In erat mauris, rutrum a ultricies a, lacinia vitae leo. Donec varius vulputate enim, aliquet hendrerit nulla vestibulum in.\r\n', 1),
(8, 'Abc', 'weq', 1, 100.00, 1, 78, 5, 0, 4, 90.00, '6T', 14, 56, 35, 200, 189, 10, 90.00, 'Etiam imperdiet feugiat nisl vel bibendum. Etiam vulputate mattis aliquam. Morbi ligula elit, pulvinar eget venenatis et, vulputate et purus. Donec sed tortor odio. Praesent leo lacus, volutpat ac placerat eget, dapibus sed dolor. Fusce sed ipsum non felis mattis eleifend. Donec sapien enim, suscipit a accumsan et, euismod et sapien. Nam aliquet commodo ligula, a venenatis mauris dapibus et. Maecenas egestas eleifend erat. Donec eu justo sed turpis tincidunt tristique et nec leo. Etiam ultrices volutpat lectus, quis auctor ligula volutpat non. Donec quis nisi vel nulla cursus iaculis tincidunt sed diam. Vestibulum mauris eros, interdum nec egestas id, posuere ut diam. Etiam aliquam sagittis porta. Aliquam at massa quis tortor feugiat dignissim id vel orci. Morbi nec mi nunc, vel malesuada elit.\r\n', 0),
(9, 'Robin', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '13C', 15, 50, 40, 150, 130, 15, 127.50, 'This is robin''s frame.', 0),
(10, 'Umesh', '123', 2, 150.00, 1, 15, 34, 118, 4, 100.00, '12X', 15, 50, 40, 150, 130, 10, 135.00, 'This frame is designed and framed by Mr. Umesh Baastu.', 0),
(11, 'Pandu ', '123', 1, 150.00, 1, 15, 34, 118, 4, 123.00, 'asd', 12, 20, 20, 160, 150, 12, 132.00, 'Shanker Hotel Kathmandu respects the privacy of all its customers and business partners, and treats personal information (personal data) provided by you as confidential. ', 0),
(12, 'Test', '456', 1, 550.00, 1, 15, 34, 118, 4, 500.00, 'dfg', 15, 20, 40, 160, 130, 15, 467.50, 'Shanker Hotel Kathmandu respects the privacy of all its customers and business partners, and treats personal information (personal data) provided by you as confidential. ', 0),
(13, 'Robinder', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, 'wer', 12, 20, 20, 160, 130, 10, 135.00, 'Shanker Hotel Kathmandu respects the privacy of all its customers and business partners, and treats personal information (personal data) provided by you as confidential. ', 0),
(14, 'Just another test', '123', 1, 789.00, 1, 15, 34, 118, 4, 456.00, 'sdf', 12, 20, 20, 150, 130, 99, 7.89, 'Shanker Hotel Kathmandu respects the privacy of all its customers and business partners, and treats personal information (personal data) provided by you as confidential. ', 0),
(15, 'Ray Ban', '123', 1, 150.00, 1, 15, 34, 118, 4, 123.00, 'fgdsg', 12, 20, 20, 150, 130, 10, 135.00, 'Shanker Hotel Kathmandu respects the privacy of all its customers and business partners, and treats personal information (personal data) provided by you as confidential. ', 0),
(16, 'Oakeley', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, 'gdfg', 12, 20, 20, 150, 130, 10, 135.00, 'Shanker Hotel Kathmandu respects the privacy of all its customers and business partners, and treats personal information (personal data) provided by you as confidential. ', 0),
(17, 'Police', '123', 1, 150.00, 1, 34, 34, 118, 4, 100.00, 'svgsd', 12, 20, 20, 150, 130, 12, 132.00, 'Shanker Hotel Kathmandu respects the privacy of all its customers and business partners, and treats personal information (personal data) provided by you as confidential. ', 0),
(18, 'Boss', '123', 1, 150.00, 1, 15, 34, 118, 4, 123.00, 'dfsg', 12, 20, 20, 150, 130, 10, 135.00, 'Shanker Hotel Kathmandu respects the privacy of all its customers and business partners, and treats personal information (personal data) provided by you as confidential. ', 0),
(19, 'Just another testa', '123', 1, 150.00, 1, 15, 34, 118, 4, 123.00, 'sdf', 12, 20, 20, 150, 130, 99, 1.50, '   afdgafgadfg a asdg asdg asg ag\r\n', 0),
(20, 'a.1', '13', 2, 123.00, 1, 15, 34, 118, 4, 123.00, '11B', 12, 20, 20, 150, 130, 99, 1.23, 'fuck', 0),
(21, 'a.2', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 15, 50, 40, 160, 150, 12, 132.00, 'Robinder ', 0),
(22, 'a.3', '12', 1, 200.00, 1, 15, 34, 118, 4, 192.00, '11B', 15, 50, 40, 160, 150, 99, 2.00, 'A dot three', 0),
(23, 'a.4', '345', 1, 345.00, 1, 15, 34, 118, 4, 345.00, '11B', 15, 50, 20, 150, 150, 15, 293.25, 'dsfsdfgs dsf gsdfg sdfg sdf', 0),
(24, 'a.5', '234', 1, 234.00, 1, 15, 34, 118, 4, 234.00, '11B', 15, 50, 40, 160, 150, 10, 210.60, 'asdf asdf asdf asdf asdf asdf asdf asdf asdf asdf asdf asdf asdf asdf ', 0),
(25, 'a.6', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 15, 50, 40, 160, 150, 99, 1.50, 'dfgh sfg hdf ghdfgh dfgh dfgh dfgh dfgh dfgh ', 0),
(26, 'a.7', '123', 1, 550.00, 1, 15, 34, 118, 4, 520.00, '11B', 12, 20, 20, 150, 130, 10, 495.00, 'xcvbx xvb xcv bxcvb xcvb xcvb xcvb xcvb xcvb xcvb xcvb ', 0),
(27, 'a.8', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 12, 20, 20, 150, 130, 15, 127.50, 'vczx vczx vzxcxz mvbmn vbmn vbm vbmn vbmn', 0),
(28, 'a.9', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 12, 20, 20, 150, 130, 10, 135.00, 'sdfgsd sdfg sdfg sdf gsdf g', 0),
(29, 'b.1', '600', 1, 600.00, 1, 15, 34, 118, 4, 600.00, '11B', 15, 50, 40, 160, 150, 99, 6.00, 'dfgh df hdfhdfhdfgh fdhfdgh dfg hfg hdfg hdfgh dfgh dfghf  dfgh', 0),
(30, 'b.2', '543', 1, 543.00, 1, 15, 34, 118, 4, 543.00, '11B', 12, 20, 20, 150, 130, 12, 477.84, 'sdfgfdg dfgfdh fgh bvccbg fdg hdfgh bvc ghfg fgfg fgh fgh', 0),
(31, 'b.3', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 12, 20, 20, 150, 130, 10, 135.00, 'dsfgs df gsdfg sdf gsdfg sdfg dfsg', 0),
(32, 'b.4', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 44, 44, 44, 44, 44, 99, 1.50, 'gdfhdfg hfdhdfh dfg hdfgh dfh', 0),
(33, 'b.5', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 12, 20, 20, 150, 130, 12, 132.00, 'ertwer wert wert wertwert wert wert wer twert ewrt ewrt ewrt ewrt wert wert wert wert ewrt wert wert ewrt ert ', 0),
(34, 'b.6', '123', 1, 150.00, 1, 15, 34, 118, 4, 123.00, '11B', 15, 50, 40, 160, 150, 10, 135.00, 'dsgdfg sdfg cvfggfgfd gdfg dfvbrgdrt dftg dtr dfg dfg dfg', 0),
(35, 'b.7', '123', 1, 150.00, 1, 15, 34, 118, 4, 123.00, '11B', 12, 20, 20, 150, 130, 99, 1.50, 'adfgsre gert egefg df gdfg d', 0),
(36, 'b.7', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 15, 50, 40, 160, 150, 12, 132.00, 'dfgdfgh dfgh dfgh dfh', 0),
(37, 'b.8', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 15, 50, 40, 160, 150, 12, 132.00, 'xccfhgfg fcgfg hcghh cgh cgh cg ', 0),
(38, 'b.9', '123', 1, 200.00, 1, 15, 34, 118, 4, 123.00, '11B', 15, 50, 40, 160, 150, 99, 2.00, 'dfgdfgd fg dfg dfh df hfdh', 0),
(39, 'c.1', '123', 1, 180.00, 1, 15, 34, 118, 4, 123.00, '11B', 12, 20, 20, 150, 130, 99, 1.80, 'sdfgrer gdsfgerg sdfg e dfg sdsfgsdfg sdfg', 0),
(40, 'c.2', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 12, 20, 20, 150, 130, 99, 1.50, 'sdfsdfgd gsdf gsdfgsdfg', 0),
(41, 'c.3', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 15, 50, 40, 160, 150, 99, 1.50, 'dfgfdgfgh dfgh dfgh dfg hdfgh dfgh dfgh dfgh', 0),
(42, 'c.4', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 15, 50, 40, 160, 150, 99, 1.50, 'fghdf hdf ghdf hdf h', 0),
(43, 'c.5', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 15, 50, 40, 160, 150, 99, 1.50, 'jkhskjdfh askjdfh kajsdfh lkasjdf', 0),
(44, 'c.6', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 12, 20, 20, 150, 130, 99, 1.50, 'fghfgh dfg hfdg hdf gh', 0),
(45, 'c.7', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 15, 50, 40, 160, 150, 99, 1.50, 'vzdxfgdxfg fdg xcfgfgdgxgdfg ', 0),
(46, 'c.8', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 15, 50, 40, 160, 150, 99, 1.50, 'fghfghf fg hfg hfgh', 0),
(47, 'c.9', '123', 1, 150.00, 1, 15, 34, 118, 4, 123.00, '11B', 15, 20, 20, 150, 130, 99, 1.50, 'sdfsdaf sdf asdf', 0),
(48, 'd.1', '123', 1, 150.00, 1, 15, 34, 118, 4, 100.00, '11B', 12, 20, 20, 150, 130, 99, 1.50, 'dfgdfg sdfg sdfg sdfg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_attribute`
--

CREATE TABLE IF NOT EXISTS `tbl_product_attribute` (
  `fld_id` int(240) NOT NULL AUTO_INCREMENT,
  `fld_product` int(240) NOT NULL,
  `fld_attribute` int(240) NOT NULL,
  `fld_value` int(240) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1055 ;

--
-- Dumping data for table `tbl_product_attribute`
--

INSERT INTO `tbl_product_attribute` (`fld_id`, `fld_product`, `fld_attribute`, `fld_value`) VALUES
(604, 7, 2, 2),
(605, 7, 3, 19),
(606, 7, 3, 24),
(607, 7, 4, 26),
(1007, 8, 2, 5),
(1008, 8, 3, 12),
(1009, 8, 3, 18),
(1010, 8, 3, 21),
(1011, 8, 4, 26),
(1012, 13, 3, 23),
(1013, 14, 3, 11),
(1014, 15, 3, 12),
(1015, 16, 3, 20),
(1016, 17, 3, 16),
(1017, 18, 3, 16),
(1018, 18, 4, 25),
(1019, 12, 3, 21),
(1020, 11, 3, 18),
(1021, 19, 3, 20),
(1022, 10, 3, 17),
(1023, 9, 3, 24),
(1024, 20, 3, 11),
(1025, 21, 3, 12),
(1026, 22, 3, 12),
(1027, 23, 3, 13),
(1028, 24, 3, 24),
(1029, 25, 3, 23),
(1030, 26, 3, 21),
(1031, 27, 3, 13),
(1032, 28, 3, 17),
(1033, 29, 3, 20),
(1034, 30, 3, 19),
(1035, 31, 3, 19),
(1036, 32, 3, 16),
(1037, 33, 3, 14),
(1038, 34, 3, 18),
(1039, 35, 3, 17),
(1040, 36, 3, 17),
(1041, 37, 3, 15),
(1042, 38, 3, 18),
(1043, 39, 3, 17),
(1044, 40, 3, 19),
(1045, 41, 3, 18),
(1046, 42, 3, 23),
(1047, 43, 3, 12),
(1048, 44, 3, 16),
(1049, 45, 3, 11),
(1051, 47, 3, 18),
(1053, 46, 3, 11),
(1054, 48, 3, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_image`
--

CREATE TABLE IF NOT EXISTS `tbl_product_image` (
  `fld_id` int(240) NOT NULL AUTO_INCREMENT,
  `fld_product` int(240) NOT NULL,
  `fld_name` varchar(2000) NOT NULL,
  `fld_url` varchar(2000) NOT NULL,
  `fld_primary` int(240) NOT NULL,
  `fld_color` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=687 ;

--
-- Dumping data for table `tbl_product_image`
--

INSERT INTO `tbl_product_image` (`fld_id`, `fld_product`, `fld_name`, `fld_url`, `fld_primary`, `fld_color`) VALUES
(334, 7, 'p1ya_images_009.jpg', 'images/2013/07/29', 0, 24),
(335, 7, '8zzs_images_010.jpg', 'images/2013/07/29', 1, 24),
(336, 7, '4at3_images_012.jpg', 'images/2013/07/29', 2, 24),
(337, 7, 'yiht_images.jpg', 'images/2013/07/29', 3, 24),
(338, 7, 'o0iw_images_004.jpg', 'images/2013/07/29', 4, 24),
(339, 7, 'e9g8_images_003.jpg', 'images/2013/07/29', 0, 19),
(340, 7, 'ssxx_images_054.jpg', 'images/2013/07/29', 1, 19),
(341, 7, 'dsym_images_076.jpg', 'images/2013/07/29', 2, 19),
(342, 7, 'tzin_images_078.jpg', 'images/2013/07/29', 3, 19),
(343, 7, 'uo6e_images_089.jpg', 'images/2013/07/29', 4, 19),
(457, 8, 'dbpr_illesteva-frieda.jpg', 'images/2013/08/16', 0, 12),
(458, 8, 'gzu5_3-dot-1-phillip-lim-doctora_004.jpg', 'images/2013/08/16', 1, 12),
(459, 8, 'xlr1_illesteva-hudson_002.jpg', 'images/2013/08/16', 2, 12),
(460, 8, 'gxxw_illesteva-hudson_002.jpg', 'images/2013/08/16', 3, 12),
(461, 8, 'bftx_3-dot-1-phillip-lim-donahue.jpg', 'images/2013/08/16', 4, 12),
(462, 8, 'bycl_illesteva-hudson_002.jpg', 'images/2013/08/16', 0, 18),
(463, 8, 'n23a_illesteva-hudson_002.jpg', 'images/2013/08/16', 1, 18),
(464, 8, 'uwha_illesteva-hudson_002.jpg', 'images/2013/08/16', 2, 18),
(465, 8, 'mhex_illesteva-hudson_002.jpg', 'images/2013/08/16', 3, 18),
(466, 8, 'w04i_illesteva-hudson_002.jpg', 'images/2013/08/16', 4, 18),
(472, 8, 'iwv9_illesteva-hudson_002.jpg', 'images/2013/08/16', 0, 21),
(473, 8, 'eetm_illesteva-hudson_002.jpg', 'images/2013/08/16', 1, 21),
(474, 8, 'm0mu_jason-wu-jett.jpg', 'images/2013/08/16', 2, 21),
(475, 8, 'o3jg_illesteva-hudson_002.jpg', 'images/2013/08/16', 3, 21),
(476, 8, 'f6ig_illesteva-hudson_002.jpg', 'images/2013/08/16', 4, 21),
(477, 13, 'cwh0_chrysanthemum.jpg', 'images/2013/08/20', 0, 23),
(478, 13, 'xyqf_hydrangeas.jpg', 'images/2013/08/20', 1, 23),
(479, 13, '6h0h_jellyfish.jpg', 'images/2013/08/20', 2, 23),
(480, 13, 'da8k_koala.jpg', 'images/2013/08/20', 3, 23),
(481, 13, '9wdi_lighthouse.jpg', 'images/2013/08/20', 4, 23),
(482, 14, 'skmz_chrysanthemum.jpg', 'images/2013/08/20', 0, 11),
(483, 14, 'w9wc_hydrangeas.jpg', 'images/2013/08/20', 1, 11),
(484, 14, 'jas3_jellyfish.jpg', 'images/2013/08/20', 2, 11),
(485, 14, 'uaby_koala.jpg', 'images/2013/08/20', 3, 11),
(486, 14, 'c3zb_lighthouse.jpg', 'images/2013/08/20', 4, 11),
(487, 15, 'dk5y_tulips.jpg', 'images/2013/08/20', 0, 12),
(488, 15, 'jf3a_singapore.jpg', 'images/2013/08/20', 1, 12),
(489, 15, 'zsdp_penguins.jpg', 'images/2013/08/20', 2, 12),
(490, 15, 'ghk6_lighthouse.jpg', 'images/2013/08/20', 3, 12),
(491, 15, '99pb_koala.jpg', 'images/2013/08/20', 4, 12),
(492, 16, 'dbzm_lighthouse.jpg', 'images/2013/08/20', 0, 20),
(493, 16, 'pyfn_koala.jpg', 'images/2013/08/20', 1, 20),
(494, 16, 'twfu_jellyfish.jpg', 'images/2013/08/20', 2, 20),
(495, 16, '874k_hydrangeas.jpg', 'images/2013/08/20', 3, 20),
(496, 16, 'h9st_chrysanthemum.jpg', 'images/2013/08/20', 4, 20),
(497, 17, 'slvn_hydrangeas.jpg', 'images/2013/08/20', 0, 16),
(498, 17, 'phmv_jellyfish.jpg', 'images/2013/08/20', 1, 16),
(499, 17, 't4gw_koala.jpg', 'images/2013/08/20', 2, 16),
(500, 17, 'mo04_lighthouse.jpg', 'images/2013/08/20', 3, 16),
(501, 17, 'zz8y_penguins.jpg', 'images/2013/08/20', 4, 16),
(502, 18, 'wefd_jellyfish.jpg', 'images/2013/08/20', 0, 16),
(503, 18, 'ty0k_hydrangeas.jpg', 'images/2013/08/20', 1, 16),
(504, 18, '72fc_chrysanthemum.jpg', 'images/2013/08/20', 2, 16),
(505, 18, '8bkb_koala.jpg', 'images/2013/08/20', 3, 16),
(506, 18, 'xbmh_lighthouse.jpg', 'images/2013/08/20', 4, 16),
(507, 12, 'qokd_singapore.jpg', 'images/2013/08/20', 0, 21),
(508, 12, 'y2kt_lighthouse.jpg', 'images/2013/08/20', 1, 21),
(509, 12, 'hpqn_koala.jpg', 'images/2013/08/20', 2, 21),
(510, 12, '4vhs_jellyfish.jpg', 'images/2013/08/20', 3, 21),
(511, 12, 'fzdv_hydrangeas.jpg', 'images/2013/08/20', 4, 21),
(512, 11, 'gubs_penguins.jpg', 'images/2013/08/20', 0, 18),
(513, 11, '2tdo_lighthouse.jpg', 'images/2013/08/20', 1, 18),
(514, 11, '0aua_jellyfish.jpg', 'images/2013/08/20', 2, 18),
(515, 11, 'stec_koala.jpg', 'images/2013/08/20', 3, 18),
(516, 11, '3uvv_hydrangeas.jpg', 'images/2013/08/20', 4, 18),
(517, 19, 'qxt1_lighthouse.jpg', 'images/2013/08/20', 0, 20),
(518, 19, 'vaj3_koala.jpg', 'images/2013/08/20', 1, 20),
(519, 19, 'mz2g_jellyfish.jpg', 'images/2013/08/20', 2, 20),
(520, 19, 'pni9_hydrangeas.jpg', 'images/2013/08/20', 3, 20),
(521, 19, 'ezt6_chrysanthemum.jpg', 'images/2013/08/20', 4, 20),
(522, 10, 'n7bi_tulips.jpg', 'images/2013/08/20', 0, 17),
(523, 10, 'lgpq_penguins.jpg', 'images/2013/08/20', 1, 17),
(524, 10, '1h8i_koala.jpg', 'images/2013/08/20', 2, 17),
(525, 10, 'z9j4_jellyfish.jpg', 'images/2013/08/20', 3, 17),
(526, 10, 'qkzz_hydrangeas.jpg', 'images/2013/08/20', 4, 17),
(527, 9, 'xgwb_koala.jpg', 'images/2013/08/20', 0, 24),
(528, 9, 'vbns_lighthouse.jpg', 'images/2013/08/20', 1, 24),
(529, 9, 'n0az_singapore.jpg', 'images/2013/08/20', 2, 24),
(530, 9, 'g0iy_penguins.jpg', 'images/2013/08/20', 3, 24),
(531, 9, 'z6ms_tulips.jpg', 'images/2013/08/20', 4, 24),
(532, 20, 'hnmc_tulips.jpg', 'images/2013/08/22', 0, 11),
(533, 20, 'zlbh_singapore.jpg', 'images/2013/08/22', 1, 11),
(534, 20, 'hrup_lighthouse.jpg', 'images/2013/08/22', 2, 11),
(535, 20, 'edef_koala.jpg', 'images/2013/08/22', 3, 11),
(536, 20, 'qtrx_jellyfish.jpg', 'images/2013/08/22', 4, 11),
(537, 21, '5g9p_lighthouse.jpg', 'images/2013/08/22', 0, 12),
(538, 21, 'on2v_koala.jpg', 'images/2013/08/22', 1, 12),
(539, 21, 'vpvr_jellyfish.jpg', 'images/2013/08/22', 2, 12),
(540, 21, '4ucw_singapore.jpg', 'images/2013/08/22', 3, 12),
(541, 21, 'l97z_hydrangeas.jpg', 'images/2013/08/22', 4, 12),
(542, 22, 'mvoo_tulips.jpg', 'images/2013/08/22', 0, 12),
(543, 22, 'bcnz_singapore.jpg', 'images/2013/08/22', 1, 12),
(544, 22, 'xgwg_penguins.jpg', 'images/2013/08/22', 2, 12),
(545, 22, 'fpsm_lighthouse.jpg', 'images/2013/08/22', 3, 12),
(546, 22, 'xyii_koala.jpg', 'images/2013/08/22', 4, 12),
(547, 23, 'r623_hydrangeas.jpg', 'images/2013/08/22', 0, 13),
(548, 23, 'dxk0_jellyfish.jpg', 'images/2013/08/22', 1, 13),
(549, 23, 'w7vr_koala.jpg', 'images/2013/08/22', 2, 13),
(550, 23, 'sjst_lighthouse.jpg', 'images/2013/08/22', 3, 13),
(551, 23, 'tzis_penguins.jpg', 'images/2013/08/22', 4, 13),
(552, 24, 'dgoe_jellyfish.jpg', 'images/2013/08/22', 0, 24),
(553, 24, 'f5hp_hydrangeas.jpg', 'images/2013/08/22', 1, 24),
(554, 24, '7yt2_chrysanthemum.jpg', 'images/2013/08/22', 2, 24),
(555, 24, 'oi0i_koala.jpg', 'images/2013/08/22', 3, 24),
(556, 24, '5f8c_lighthouse.jpg', 'images/2013/08/22', 4, 24),
(557, 25, 'fppk_lighthouse.jpg', 'images/2013/08/22', 0, 23),
(558, 25, '7kar_koala.jpg', 'images/2013/08/22', 1, 23),
(559, 25, 'p0tx_jellyfish.jpg', 'images/2013/08/22', 2, 23),
(560, 25, 'pmfb_hydrangeas.jpg', 'images/2013/08/22', 3, 23),
(561, 25, 'w1g2_chrysanthemum.jpg', 'images/2013/08/22', 4, 23),
(562, 26, '6yfl_koala.jpg', 'images/2013/08/22', 0, 21),
(563, 26, 'odas_jellyfish.jpg', 'images/2013/08/22', 1, 21),
(564, 26, '6udc_hydrangeas.jpg', 'images/2013/08/22', 2, 21),
(565, 26, 'wlmg_chrysanthemum.jpg', 'images/2013/08/22', 3, 21),
(566, 26, 'ivil_penguins.jpg', 'images/2013/08/22', 4, 21),
(567, 27, 'uwan_singapore.jpg', 'images/2013/08/22', 0, 13),
(568, 27, 'xdvr_penguins.jpg', 'images/2013/08/22', 1, 13),
(569, 27, '9dcu_lighthouse.jpg', 'images/2013/08/22', 2, 13),
(570, 27, 'zyhq_koala.jpg', 'images/2013/08/22', 3, 13),
(571, 27, '4ejs_jellyfish.jpg', 'images/2013/08/22', 4, 13),
(572, 28, 'co1f_penguins.jpg', 'images/2013/08/22', 0, 17),
(573, 28, 'a2sb_lighthouse.jpg', 'images/2013/08/22', 1, 17),
(574, 28, 'm39q_koala.jpg', 'images/2013/08/22', 2, 17),
(575, 28, 'ncmc_jellyfish.jpg', 'images/2013/08/22', 3, 17),
(576, 28, 'qcey_hydrangeas.jpg', 'images/2013/08/22', 4, 17),
(577, 29, 'jyuv_chrysanthemum.jpg', 'images/2013/08/22', 0, 20),
(578, 29, 'rpqy_hydrangeas.jpg', 'images/2013/08/22', 1, 20),
(579, 29, 'eccm_jellyfish.jpg', 'images/2013/08/22', 2, 20),
(580, 29, 'cbqf_koala.jpg', 'images/2013/08/22', 3, 20),
(581, 29, 'piih_lighthouse.jpg', 'images/2013/08/22', 4, 20),
(582, 30, 'xkol_chrysanthemum.jpg', 'images/2013/08/22', 0, 19),
(583, 30, 'eumv_hydrangeas.jpg', 'images/2013/08/22', 1, 19),
(584, 30, 'olco_jellyfish.jpg', 'images/2013/08/22', 2, 19),
(585, 30, '9ato_koala.jpg', 'images/2013/08/22', 3, 19),
(586, 30, 'wihc_lighthouse.jpg', 'images/2013/08/22', 4, 19),
(587, 31, 'peen_hydrangeas.jpg', 'images/2013/08/22', 0, 19),
(588, 31, 'ha0n_jellyfish.jpg', 'images/2013/08/22', 1, 19),
(589, 31, 'epke_koala.jpg', 'images/2013/08/22', 2, 19),
(590, 31, 'uskz_lighthouse.jpg', 'images/2013/08/22', 3, 19),
(591, 31, 'rrk4_penguins.jpg', 'images/2013/08/22', 4, 19),
(592, 32, 'usrm_lighthouse.jpg', 'images/2013/08/22', 0, 16),
(593, 32, 'vopx_singapore.jpg', 'images/2013/08/22', 1, 16),
(594, 32, 'ks9n_jellyfish.jpg', 'images/2013/08/22', 2, 16),
(595, 32, 'wzyo_hydrangeas.jpg', 'images/2013/08/22', 3, 16),
(596, 32, 'xfsv_chrysanthemum.jpg', 'images/2013/08/22', 4, 16),
(602, 34, 'aotg_jellyfish.jpg', 'images/2013/08/22', 0, 18),
(603, 34, 'vdin_koala.jpg', 'images/2013/08/22', 1, 18),
(604, 34, 'ggjx_lighthouse.jpg', 'images/2013/08/22', 2, 18),
(605, 34, 'eljw_penguins.jpg', 'images/2013/08/22', 3, 18),
(606, 34, 'm1ol_singapore.jpg', 'images/2013/08/22', 4, 18),
(607, 35, '5s3a_koala.jpg', 'images/2013/08/22', 0, 17),
(608, 35, 'hhz1_hydrangeas.jpg', 'images/2013/08/22', 1, 17),
(609, 35, 'cv6s_jellyfish.jpg', 'images/2013/08/22', 2, 17),
(610, 35, 'w5cn_chrysanthemum.jpg', 'images/2013/08/22', 3, 17),
(611, 35, 'uxvx_tulips.jpg', 'images/2013/08/22', 4, 17),
(612, 36, 'vds5_tulips.jpg', 'images/2013/08/22', 0, 17),
(613, 36, 'jtw5_singapore.jpg', 'images/2013/08/22', 1, 17),
(614, 36, '4wnw_lighthouse.jpg', 'images/2013/08/22', 2, 17),
(615, 36, '8rbf_penguins.jpg', 'images/2013/08/22', 3, 17),
(616, 36, 'q4ra_koala.jpg', 'images/2013/08/22', 4, 17),
(617, 37, 'quv1_chrysanthemum.jpg', 'images/2013/08/22', 0, 15),
(618, 37, 'kztl_hydrangeas.jpg', 'images/2013/08/22', 1, 15),
(619, 37, 'c9h2_jellyfish.jpg', 'images/2013/08/22', 2, 15),
(620, 37, '4sdk_koala.jpg', 'images/2013/08/22', 3, 15),
(621, 37, 'bmly_lighthouse.jpg', 'images/2013/08/22', 4, 15),
(622, 38, 'pzbh_lighthouse.jpg', 'images/2013/08/22', 0, 18),
(623, 38, 'gzr3_koala.jpg', 'images/2013/08/22', 1, 18),
(624, 38, 'cu45_jellyfish.jpg', 'images/2013/08/22', 2, 18),
(625, 38, 'uq2s_hydrangeas.jpg', 'images/2013/08/22', 3, 18),
(626, 38, 'qi5e_chrysanthemum.jpg', 'images/2013/08/22', 4, 18),
(627, 39, '6ifu_chrysanthemum.jpg', 'images/2013/08/22', 0, 17),
(628, 39, 'wyfm_hydrangeas.jpg', 'images/2013/08/22', 1, 17),
(629, 39, 'ayko_jellyfish.jpg', 'images/2013/08/22', 2, 17),
(630, 39, 'hp9o_koala.jpg', 'images/2013/08/22', 3, 17),
(631, 39, 'qloj_lighthouse.jpg', 'images/2013/08/22', 4, 17),
(632, 40, 'ho8g_chrysanthemum.jpg', 'images/2013/08/22', 0, 19),
(633, 40, 's5vb_hydrangeas.jpg', 'images/2013/08/22', 1, 19),
(634, 40, '29gg_jellyfish.jpg', 'images/2013/08/22', 2, 19),
(635, 40, 'laxx_koala.jpg', 'images/2013/08/22', 3, 19),
(636, 40, 'drzo_lighthouse.jpg', 'images/2013/08/22', 4, 19),
(637, 41, 'bukr_penguins.jpg', 'images/2013/08/22', 0, 18),
(638, 41, 'ygt2_lighthouse.jpg', 'images/2013/08/22', 1, 18),
(639, 41, 'vhxe_jellyfish.jpg', 'images/2013/08/22', 2, 18),
(640, 41, 'imyo_koala.jpg', 'images/2013/08/22', 3, 18),
(641, 41, '8bvs_singapore.jpg', 'images/2013/08/22', 4, 18),
(642, 42, 'wcu8_lighthouse.jpg', 'images/2013/08/22', 0, 23),
(643, 42, '5nhg_koala.jpg', 'images/2013/08/22', 1, 23),
(644, 42, 'aeds_jellyfish.jpg', 'images/2013/08/22', 2, 23),
(645, 42, 'k86p_hydrangeas.jpg', 'images/2013/08/22', 3, 23),
(646, 42, 'qdso_chrysanthemum.jpg', 'images/2013/08/22', 4, 23),
(647, 43, '6zft_koala.jpg', 'images/2013/08/22', 0, 12),
(648, 43, 'dzc9_jellyfish.jpg', 'images/2013/08/22', 1, 12),
(649, 43, 'zt9l_hydrangeas.jpg', 'images/2013/08/22', 2, 12),
(650, 43, 'feee_chrysanthemum.jpg', 'images/2013/08/22', 3, 12),
(651, 43, 'gn2q_penguins.jpg', 'images/2013/08/22', 4, 12),
(652, 44, 'gcnf_tulips.jpg', 'images/2013/08/22', 0, 16),
(653, 44, '3q8d_singapore.jpg', 'images/2013/08/22', 1, 16),
(654, 44, 'fyt1_penguins.jpg', 'images/2013/08/22', 2, 16),
(655, 44, '7ffy_lighthouse.jpg', 'images/2013/08/22', 3, 16),
(656, 44, 'mfxr_koala.jpg', 'images/2013/08/22', 4, 16),
(657, 45, 'jebm_penguins.jpg', 'images/2013/08/22', 0, 11),
(658, 45, 'snae_koala.jpg', 'images/2013/08/22', 1, 11),
(659, 45, 'v1ug_lighthouse.jpg', 'images/2013/08/22', 2, 11),
(660, 45, 'n8oe_jellyfish.jpg', 'images/2013/08/22', 3, 11),
(661, 45, 'u2ah_hydrangeas.jpg', 'images/2013/08/22', 4, 11),
(667, 47, 'jkcp_penguins.jpg', 'images/2013/08/22', 0, 18),
(668, 47, '9jyj_lighthouse.jpg', 'images/2013/08/22', 1, 18),
(669, 47, '6v7e_koala.jpg', 'images/2013/08/22', 2, 18),
(670, 47, 'mh0a_jellyfish.jpg', 'images/2013/08/22', 3, 18),
(671, 47, '5nac_hydrangeas.jpg', 'images/2013/08/22', 4, 18),
(677, 46, 'hlqh_lighthouse.jpg', 'images/2013/08/22', 0, 11),
(678, 46, 'ytvo_penguins.jpg', 'images/2013/08/22', 1, 11),
(679, 46, 'zge8_jellyfish.jpg', 'images/2013/08/22', 2, 11),
(680, 46, 'fncs_hydrangeas.jpg', 'images/2013/08/22', 3, 11),
(681, 46, 'vzob_chrysanthemum.jpg', 'images/2013/08/22', 4, 11),
(682, 48, '3ij7_chrysanthemum.jpg', 'images/2013/08/22', 0, 24),
(683, 48, 'lyxn_hydrangeas.jpg', 'images/2013/08/22', 1, 24),
(684, 48, 'cb2y_jellyfish.jpg', 'images/2013/08/22', 2, 24),
(685, 48, 'uk0c_koala.jpg', 'images/2013/08/22', 3, 24),
(686, 48, 'cjhs_lighthouse.jpg', 'images/2013/08/22', 4, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_lens_compatibility`
--

CREATE TABLE IF NOT EXISTS `tbl_product_lens_compatibility` (
  `fld_id` int(240) NOT NULL AUTO_INCREMENT,
  `fld_lens_type` int(240) NOT NULL,
  `fld_product` int(240) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=549 ;

--
-- Dumping data for table `tbl_product_lens_compatibility`
--

INSERT INTO `tbl_product_lens_compatibility` (`fld_id`, `fld_lens_type`, `fld_product`) VALUES
(334, 1, 7),
(335, 2, 7),
(336, 3, 7),
(444, 1, 8),
(445, 2, 8),
(446, 3, 8),
(454, 1, 13),
(455, 2, 13),
(456, 1, 14),
(457, 2, 14),
(458, 1, 15),
(459, 2, 15),
(460, 3, 15),
(461, 2, 16),
(462, 3, 16),
(463, 1, 17),
(464, 3, 17),
(465, 1, 18),
(466, 3, 18),
(467, 1, 12),
(468, 4, 12),
(469, 1, 19),
(470, 3, 19),
(471, 1, 10),
(472, 2, 10),
(473, 1, 9),
(474, 2, 9),
(475, 3, 9),
(476, 2, 20),
(477, 3, 20),
(478, 1, 21),
(479, 2, 21),
(480, 1, 22),
(481, 3, 22),
(482, 1, 23),
(483, 2, 23),
(484, 4, 23),
(485, 1, 24),
(486, 2, 24),
(487, 3, 24),
(488, 4, 24),
(489, 1, 25),
(490, 2, 25),
(491, 2, 26),
(492, 1, 27),
(493, 2, 27),
(494, 3, 27),
(495, 4, 27),
(496, 1, 28),
(497, 2, 28),
(498, 1, 29),
(499, 2, 29),
(500, 1, 30),
(501, 3, 30),
(502, 4, 30),
(503, 1, 31),
(504, 2, 31),
(505, 1, 32),
(506, 2, 32),
(507, 2, 33),
(508, 3, 33),
(509, 1, 34),
(510, 3, 34),
(511, 4, 34),
(512, 1, 35),
(513, 3, 35),
(514, 1, 36),
(515, 4, 36),
(516, 1, 37),
(517, 2, 37),
(518, 1, 38),
(519, 2, 38),
(520, 1, 39),
(521, 2, 39),
(522, 1, 40),
(523, 2, 40),
(524, 3, 40),
(525, 1, 41),
(526, 2, 41),
(527, 3, 41),
(528, 1, 42),
(529, 2, 42),
(530, 3, 42),
(531, 1, 43),
(532, 2, 43),
(533, 1, 44),
(534, 2, 44),
(535, 1, 45),
(536, 2, 45),
(539, 1, 47),
(540, 2, 47),
(541, 3, 47),
(542, 4, 47),
(545, 1, 46),
(546, 2, 46),
(547, 1, 48),
(548, 2, 48);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_type`
--

CREATE TABLE IF NOT EXISTS `tbl_product_type` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_product_type`
--

INSERT INTO `tbl_product_type` (`fld_id`, `fld_name`) VALUES
(2, 'Accessories'),
(4, 'Frame');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_view_info`
--

CREATE TABLE IF NOT EXISTS `tbl_product_view_info` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_product` int(11) NOT NULL,
  `fld_user` int(11) NOT NULL,
  `fld_qty` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_product_view_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_promocode`
--

CREATE TABLE IF NOT EXISTS `tbl_promocode` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_promocode` varchar(50) NOT NULL,
  `fld_percentage` int(11) NOT NULL,
  `fld_promocode_type` int(11) NOT NULL,
  `fld_amt_above` decimal(7,2) NOT NULL,
  `fld_qty` int(11) NOT NULL,
  `fld_start_date` date NOT NULL,
  `fld_end_date` date NOT NULL,
  `fld_off_amt` decimal(9,2) NOT NULL,
  `fld_range` varchar(50) NOT NULL,
  `fld_category` varchar(250) NOT NULL,
  `fld_upgrade` int(11) NOT NULL,
  `fld_status` int(11) NOT NULL,
  `fld_additional_info` varchar(2000) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_promocode`
--

INSERT INTO `tbl_promocode` (`fld_id`, `fld_promocode`, `fld_percentage`, `fld_promocode_type`, `fld_amt_above`, `fld_qty`, `fld_start_date`, `fld_end_date`, `fld_off_amt`, `fld_range`, `fld_category`, `fld_upgrade`, `fld_status`, `fld_additional_info`) VALUES
(1, 'buy 1 get 1 FrEE', 0, 1, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '0', '5', 0, 1, ''),
(3, 'marine', 0, 2, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '0', '1', 0, 1, ''),
(4, 'sniper', 0, 3, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '0', '3', 0, 1, ''),
(9, 'ferrari', 0, 4, 500.00, 0, '0000-00-00', '0000-00-00', 0.00, '0', '', 0, 1, ''),
(10, 'Lambourghini', 0, 4, 9000.00, 0, '0000-00-00', '0000-00-00', 0.00, '0', '', 0, 1, ''),
(11, 'hummer', 0, 4, 999.00, 0, '0000-00-00', '0000-00-00', 0.00, '0', '', 0, 1, ''),
(12, 'ironman', 3, 5, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '0', '', 0, 1, ''),
(13, 'superman', 5, 5, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '0', '', 0, 1, ''),
(14, 'cake', 25, 6, 0.00, 0, '2013-06-26', '2013-06-30', 0.00, '0', '', 0, 1, ''),
(15, 'coke', 20, 7, 3000.00, 0, '0000-00-00', '0000-00-00', 0.00, '0', '', 0, 1, ''),
(16, 'heavy metal', 0, 8, 0.00, 0, '0000-00-00', '0000-00-00', 300.00, '7-10', '', 0, 1, ''),
(17, 'frame category', 33, 9, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '', '4-3-2', 0, 1, ''),
(18, 'lens', 32, 10, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '', '4-3', 0, 1, ''),
(19, 'ups', 23, 11, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '', '', 1, 1, ''),
(20, 'dlc', 3, 10, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '', '1', 0, 0, ''),
(21, 'ship free', 0, 4, 352.00, 0, '0000-00-00', '0000-00-00', 0.00, '', '', 0, 0, ''),
(22, 'dfc', 45, 9, 0.00, 0, '0000-00-00', '0000-00-00', 0.00, '', '2', 0, 0, ''),
(23, 'black forest', 6, 6, 0.00, 0, '2013-07-01', '2013-07-31', 0.00, '', '', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promocode_type`
--

CREATE TABLE IF NOT EXISTS `tbl_promocode_type` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_promocode_type` varchar(2000) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_promocode_type`
--

INSERT INTO `tbl_promocode_type` (`fld_id`, `fld_promocode_type`) VALUES
(1, 'Buy 1 Get 1\r\n'),
(2, 'Buy 2 Get 1'),
(3, 'Buy 3 Get 1'),
(4, 'Free shipping to US on orders above x USD'),
(5, '% Discount Fixed'),
(6, '% Discount on limited Time frame time ticker to be shown on banner.'),
(7, '% discount on Orders Above X USD\r\n'),
(8, 'X USD OFF on every 7-10 Orders (Order range variable). Orders Variable from 7-10 so that customers do not get accustomed. '),
(9, 'Discount on Frame category'),
(10, 'Discount on Lens Category\r\n'),
(11, 'Discount on Lens upgrade\r\n'),
(12, 'Referral discount and bonus to customers.\r\n'),
(13, 'Fixed discount for B2C and B2B.\r\n'),
(14, '25% off on attempted order.\r\n'),
(15, 'Seasonal discount Christmas ,new year, Thanksgiving, Memorial day. Summer discount on sunglasses.\r\n'),
(16, 'Buy 1, 2 Or 3 and get x% for 1, y% for 2, z% for 3 discount.\r\n'),
(17, 'Free Glass For X USD');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rank`
--

CREATE TABLE IF NOT EXISTS `tbl_rank` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_page` varchar(250) NOT NULL,
  `fld_rank` int(10) NOT NULL,
  `fld_frank` int(11) NOT NULL,
  `fld_option` int(11) NOT NULL,
  `fld_foption` int(11) NOT NULL,
  `fld_type_id` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_rank`
--

INSERT INTO `tbl_rank` (`fld_id`, `fld_page`, `fld_rank`, `fld_frank`, `fld_option`, `fld_foption`, `fld_type_id`) VALUES
(20, 'Home', 12, 10, 0, 1, 2),
(21, 'Contact', 13, 13, 0, 1, 2),
(22, 'Business', 14, 11, 0, 1, 2),
(23, 'Feedback', 15, 12, 0, 1, 2),
(24, 'Help', 16, 14, 0, 1, 2),
(25, 'Sitemap', 17, 15, 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE IF NOT EXISTS `tbl_role` (
  `fld_id` int(240) NOT NULL AUTO_INCREMENT,
  `fld_role` varchar(2000) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`fld_id`, `fld_role`) VALUES
(1, 'Super Admin'),
(2, 'Order Manager'),
(3, 'Order Manager');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping_details`
--

CREATE TABLE IF NOT EXISTS `tbl_shipping_details` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_country` varchar(50) NOT NULL,
  `fld_state` varchar(50) NOT NULL,
  `fld_city` varchar(50) NOT NULL,
  `fld_street` varchar(255) NOT NULL,
  `fld_zip` int(11) NOT NULL,
  `fld_payer_email` varchar(255) NOT NULL,
  `fld_txn_id` varchar(50) NOT NULL,
  `fld_first_name` varchar(50) NOT NULL,
  `fld_last_name` varchar(50) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_shipping_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_sub_categories` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(255) NOT NULL,
  `fld_description` text NOT NULL,
  `fld_category_id` int(11) NOT NULL,
  `fld_rank` int(11) NOT NULL,
  `fld_status` tinyint(4) NOT NULL,
  `fld_location` varchar(255) NOT NULL,
  `fld_image` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `tbl_sub_categories`
--

INSERT INTO `tbl_sub_categories` (`fld_id`, `fld_name`, `fld_description`, `fld_category_id`, `fld_rank`, `fld_status`, `fld_location`, `fld_image`) VALUES
(83, 'Rabinsafd', 'SADFASDFASDFA ADASFD', 18, 1, 1, '', ''),
(103, 'Acitate', 'Aliquam consectetur, massa ut vestibulum laoreet, nisl tellus faucibus mauris, ut tincidunt purus metus at nibh. Vivamus viverra tempus dictum. Pellentesque aliquet magna id arcu viverra in commodo dui pellentesque. Nam ac sapien sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur enim sapien, bibendum a elementum tempor, elementum et nibh. Sed eget ornare lectus. Praesent venenatis tempor velit id fermentum. Etiam quis lacus quis justo blandit porttitor. Ut faucibus consectetur ultricies. Maecenas pellentesque, lorem sit amet accumsan interdum, orci nunc scelerisque nisi, sit amet ultricies erat diam eget est. Fusce sit amet interdum leo.\r\n', 32, 1, 1, 'images/2013/08/19/', 'fcrz_menu_womens_optical-b1918746a92f4dff79c7e53d177196ee.png'),
(104, 'Metal', 'Suspendisse sodales, augue id pulvinar ornare, urna ligula suscipit diam, non pretium ante neque ut neque. Etiam id erat nulla, id condimentum nibh. Sed ac elit in eros lobortis luctus. Vivamus eget tortor a nisl condimentum rutrum egestas non sapien. Sed blandit eleifend risus vel feugiat. Donec fermentum rhoncus sagittis. Suspendisse lobortis vulputate sollicitudin. Fusce sit amet eros eu risus vestibulum dignissim sed at nisl. Praesent sed tortor sed orci tristique mollis non ac risus. Aliquam eu suscipit turpis. Nulla vitae nunc lorem. Donec sit amet nunc odio. Vivamus quis odio est. Cras vulputate sem quis purus imperdiet hendrerit. Quisque nulla massa, elementum non vulputate vitae, rutrum quis nisl.\r\n', 32, 2, 1, 'images/2013/08/19/', 'jet3_menu_womens_sun-67a3118a8f060f2d56aecc13d41dcbf9.png'),
(105, 'Plastic', 'Etiam pellentesque eros ac ipsum porttitor dapibus. Aliquam egestas, metus sit amet imperdiet malesuada, velit arcu volutpat justo, at lobortis justo felis sed ante. Duis ut urna massa. Quisque porta nulla hendrerit sapien bibendum ultrices. Praesent euismod lacus nec ante consequat viverra. Mauris eget consectetur erat. In hac habitasse platea dictumst. Donec eget odio nisl, nec pretium urna. Duis sem diam, venenatis ac iaculis sit amet, feugiat eget libero. Morbi neque turpis, imperdiet in placerat a, ornare faucibus quam. Mauris in lacus eget augue eleifend commodo. Praesent non leo urna. Sed at nibh arcu. Suspendisse elit velit, ultrices nec lobortis ut, pellentesque cursus lacus. Nam ornare adipiscing ipsum eu fermentum.\r\n', 32, 3, 1, 'images/2013/08/19/', '0ep3_menu_mens_sun-e9a4e172093bc9fad284fc0c5709eb04.png'),
(106, 'Men', 'Suspendisse vel lacus tortor. Fusce tempor, magna et euismod imperdiet, massa est fringilla ipsum, ac consectetur neque diam tincidunt sem. Pellentesque ac eros nec neque lacinia vulputate consequat eget eros. Ut dignissim ante at mi pharetra tempor. Donec aliquam nulla a purus ultrices vel commodo nunc lacinia. Aliquam nisi leo, fringilla in tristique eu, rutrum ut lacus. Sed fermentum aliquet metus in cursus. Donec sollicitudin nulla at sapien lobortis imperdiet malesuada velit hendrerit. Curabitur vehicula risus eget lorem interdum at euismod ante ullamcorper. Aliquam diam nisi, vehicula et iaculis nec, tincidunt aliquam turpis. Cras fringilla luctus vulputate. Aenean vel vulputate dolor. Nam aliquet orci id massa auctor laoreet varius sapien ullamcorper.\r\n', 33, 2, 1, 'images/2013/08/19/', 'klus_menu_mens_sun-e9a4e172093bc9fad284fc0c5709eb04.png'),
(107, 'Women', 'Suspendisse sodales, augue id pulvinar ornare, urna ligula suscipit diam, non pretium ante neque ut neque. Etiam id erat nulla, id condimentum nibh. Sed ac elit in eros lobortis luctus. Vivamus eget tortor a nisl condimentum rutrum egestas non sapien. Sed blandit eleifend risus vel feugiat. Donec fermentum rhoncus sagittis. Suspendisse lobortis vulputate sollicitudin. Fusce sit amet eros eu risus vestibulum dignissim sed at nisl. Praesent sed tortor sed orci tristique mollis non ac risus. Aliquam eu suscipit turpis. Nulla vitae nunc lorem. Donec sit amet nunc odio. Vivamus quis odio est. Cras vulputate sem quis purus imperdiet hendrerit. Quisque nulla massa, elementum non vulputate vitae, rutrum quis nisl.\r\n', 33, 1, 1, 'images/2013/08/19/', 'aqet_menu_womens_sun-67a3118a8f060f2d56aecc13d41dcbf9.png'),
(110, 'Kids', 'asdf asdf asdf', 33, 3, 1, 'images/2013/08/19/', 'v1jl_menu_mens_sun-e9a4e172093bc9fad284fc0c5709eb04.png'),
(118, 'Men', 'sadf sfsa dfasfda sdf asdf', 34, 12, 1, 'images/2013/08/19/', 'wvn5_illesteva-frieda.jpg'),
(122, 'Women', 'asd fasdf asdf', 34, 9, 1, 'images/2013/08/19/', 'svhv_3-dot-1-phillip-lim-malibu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp`
--

CREATE TABLE IF NOT EXISTS `tbl_temp` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_user` int(11) NOT NULL,
  `fld_product` int(11) NOT NULL,
  `fld_product_price` decimal(7,2) NOT NULL,
  `fld_lens_type` int(11) NOT NULL,
  `fld_color` int(11) NOT NULL,
  `fld_lens_package` int(11) NOT NULL,
  `fld_lens_package_price` decimal(7,2) NOT NULL,
  `fld_lens_upgrade` varchar(255) NOT NULL,
  `fld_lens_upgrade_price` decimal(7,2) NOT NULL,
  `fld_prescription` varchar(255) NOT NULL,
  `fld_user_presc_entry` int(11) NOT NULL,
  `fld_promo_flag` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_temp`
--

INSERT INTO `tbl_temp` (`fld_id`, `fld_user`, `fld_product`, `fld_product_price`, `fld_lens_type`, `fld_color`, `fld_lens_package`, `fld_lens_package_price`, `fld_lens_upgrade`, `fld_lens_upgrade_price`, `fld_prescription`, `fld_user_presc_entry`, `fld_promo_flag`) VALUES
(13, 2, 7, 0.00, 1, 24, 21, 0.00, '3_1_2', 5.00, '1', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_temp_attributes` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_temp` int(11) NOT NULL,
  `fld_attribute` int(11) NOT NULL,
  `fld_attribute_value` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_temp_attributes`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp_presc_entry`
--

CREATE TABLE IF NOT EXISTS `tbl_temp_presc_entry` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_temp` int(11) NOT NULL,
  `fld_user` int(11) NOT NULL,
  `fld_sph_od` varchar(50) DEFAULT NULL,
  `fld_sph_os` varchar(50) DEFAULT NULL,
  `fld_cyl_od` varchar(50) DEFAULT NULL,
  `fld_cyl_os` varchar(50) DEFAULT NULL,
  `fld_axis_od` varchar(50) DEFAULT NULL,
  `fld_axis_os` varchar(50) DEFAULT NULL,
  `fld_add_od` varchar(50) DEFAULT NULL,
  `fld_add_os` varchar(50) DEFAULT NULL,
  `fld_power_od` varchar(50) DEFAULT NULL,
  `fld_power_os` varchar(50) DEFAULT NULL,
  `fld_patient_name` varchar(255) NOT NULL,
  `fld_pd` varchar(50) DEFAULT NULL,
  `fld_pd_right` varchar(50) DEFAULT NULL,
  `fld_pd_left` varchar(50) DEFAULT NULL,
  `fld_remarks` text,
  `fld_prescription_path` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_temp_presc_entry`
--

INSERT INTO `tbl_temp_presc_entry` (`fld_id`, `fld_temp`, `fld_user`, `fld_sph_od`, `fld_sph_os`, `fld_cyl_od`, `fld_cyl_os`, `fld_axis_od`, `fld_axis_os`, `fld_add_od`, `fld_add_os`, `fld_power_od`, `fld_power_os`, `fld_patient_name`, `fld_pd`, `fld_pd_right`, `fld_pd_left`, `fld_remarks`, `fld_prescription_path`) VALUES
(1, 1, 2, '-3.25', '0', '', '', '', '', '', '', '-3.25', '0', 'hello', '46.5', '', '', '', '0'),
(2, 4, 2, '-3.25', '0', '', '', '', '', '', '', '-3.25', '0', 'hello', '46.5', '', '', '', '0'),
(3, 6, 2, '-1', '0', '-1.5', '', '9', '', '', '', '-1.75', '0', 'hello', '47', '', '', 'poijhf', '0'),
(4, 7, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(5, 8, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(6, 9, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(7, 11, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(8, 12, 2, '-3', '0', '', '', '', '', '', '', '-3', '0', 'hello', '47', '', '', '', '0'),
(9, 13, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(10, 14, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(11, 1, 2, '-4', '0', '', '', '', '', '1.5', '', '-4', '0', 'hello', '46.5', '', '', '', '0'),
(12, 2, 2, '-4', '0', '', '', '', '', '1.5', '', '-4', '0', 'hello', '46.5', '', '', '', '0'),
(13, 3, 2, '-4', '0', '', '', '', '', '1.5', '', '-4', '0', 'hello', '46.5', '', '', '', '0'),
(14, 3, 2, '-3.75', '0', '', '', '', '', '1.5', '', '-3.75', '0', 'hello', '46', '', '', '', '0'),
(15, 4, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(16, 5, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(17, 6, 2, '-3.75', '0', '', '', '', '', '1.5', '', '-3.75', '0', 'hello', '45', '', '', '', '0'),
(18, 1, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(19, 2, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(20, 3, 2, '-2.25', '-2.75', '-1.75', '-2.25', '15', '1', '1.25', '1.5', '-3.125', '-3.875', 'hello', '46', '', '', '', '0'),
(21, 4, 2, '-2.25', '-2.75', '-1.75', '-2.25', '15', '1', '1.25', '1.5', '-3.125', '-3.875', 'hello', '46', '', '', '', '0'),
(22, 5, 2, '-2.25', '-2.75', '-1.75', '-2.25', '15', '1', '1.25', '1.5', '-3.125', '-3.875', 'hello', '46', '', '', '', '0'),
(23, 6, 2, '-2.25', '-2.75', '-1.75', '-2.25', '15', '1', '1.25', '1.5', '-3.125', '-3.875', 'hello', '46', '', '', '', '0'),
(24, 7, 2, '-2.25', '-2.75', '-1.75', '-2.25', '15', '1', '1.25', '1.5', '-3.125', '-3.875', 'hello', '46', '', '', '', '0'),
(25, 8, 2, '-2.25', '-2.75', '-1.75', '-2.25', '15', '1', '1.25', '1.5', '-3.125', '-3.875', 'hello', '46', '', '', '', '0'),
(26, 9, 2, '-2.25', '-2.75', '-1.75', '-2.25', '15', '1', '1.25', '1.5', '-3.125', '-3.875', 'hello', '46', '', '', '', '0'),
(27, 10, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(28, 10, 2, '-6.75', '-2.75', '-3', '', '11', '', '1.25', '1', '-8.25', '-2.75', 'hello', '45', '', '', '', '0'),
(29, 10, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(30, 11, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(31, 12, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(32, 13, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0'),
(33, 14, 2, '0', '0', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_login`
--

CREATE TABLE IF NOT EXISTS `tbl_user_login` (
  `fld_id` int(255) NOT NULL AUTO_INCREMENT,
  `fld_username` varchar(255) NOT NULL,
  `fld_password` varchar(255) NOT NULL,
  `fld_first_name` varchar(240) NOT NULL,
  `fld_last_name` varchar(240) NOT NULL,
  `fld_email` varchar(255) NOT NULL,
  `fld_country` varchar(240) NOT NULL,
  `fld_state` varchar(240) NOT NULL,
  `fld_city` varchar(240) NOT NULL,
  `fld_contact_no` bigint(240) NOT NULL,
  `fld_myself` varchar(2000) NOT NULL,
  `fld_status` int(255) NOT NULL,
  `fld_key` varchar(255) NOT NULL,
  `fld_reset_token` varchar(255) NOT NULL,
  `fld_token_exp` datetime NOT NULL,
  `fld_profile_pic` varchar(2000) NOT NULL,
  `fld_profile_pic_url` varchar(2000) NOT NULL,
  `fld_date_registered` datetime NOT NULL,
  `fld_account_type` int(255) NOT NULL,
  PRIMARY KEY (`fld_id`),
  UNIQUE KEY `fld_username` (`fld_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_user_login`
--

INSERT INTO `tbl_user_login` (`fld_id`, `fld_username`, `fld_password`, `fld_first_name`, `fld_last_name`, `fld_email`, `fld_country`, `fld_state`, `fld_city`, `fld_contact_no`, `fld_myself`, `fld_status`, `fld_key`, `fld_reset_token`, `fld_token_exp`, `fld_profile_pic`, `fld_profile_pic_url`, `fld_date_registered`, `fld_account_type`) VALUES
(1, 'jpt', '1d41b874a5b9ffbd234227561fe33919', 'jpt', 'jpt', 'jpt@jpt.jpt', 'Nepal', 'jpt', 'jpt', 97998798798, 'jpt', 1, '', '', '0000-00-00 00:00:00', 'L7Ro_1.jpg', 'images/2013/06/19', '2013-06-19 11:25:32', 0),
(2, 'anjin', 'b8708375333487fa310ef96ca69c6a70', 'anjin', 'anjin', 'anjin@anjin.anjin', 'Nepal', 'anjin', 'anjin', 356938345645, 'anjin', 1, '', '', '0000-00-00 00:00:00', 'hdcg_3-dot-1-phillip-lim-holmes.jpg', 'images/2013/08/19', '2013-06-19 11:26:20', 0),
(3, 'zohen', '', 'Umesh', 'Gurung', 'casualcases@yahoo.com', '', '', '', 0, '', 0, '', '', '0000-00-00 00:00:00', '', '', '2013-06-21 14:03:25', 0),
(4, 'robz', '1951f30597d8b07b7536ffbc32811ccf', 'robz', 'stha', 'fearless_rabin@yahoo.com', 'Nepal', 'Central', 'Ktm', 9779818736042, 'This is myself. Thanks', 1, '', '', '0000-00-00 00:00:00', '', '', '2013-07-18 07:19:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_presc_entry`
--

CREATE TABLE IF NOT EXISTS `tbl_user_presc_entry` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_user` int(11) NOT NULL,
  `fld_sph_od` varchar(50) NOT NULL,
  `fld_sph_os` varchar(50) NOT NULL,
  `fld_cyl_od` varchar(50) NOT NULL,
  `fld_cyl_os` varchar(50) NOT NULL,
  `fld_axis_od` varchar(50) NOT NULL,
  `fld_axis_os` varchar(50) NOT NULL,
  `fld_add_od` varchar(50) NOT NULL,
  `fld_add_os` varchar(50) NOT NULL,
  `fld_power_od` varchar(50) NOT NULL,
  `fld_power_os` varchar(50) NOT NULL,
  `fld_patient_name` varchar(255) NOT NULL,
  `fld_pd` varchar(50) NOT NULL,
  `fld_pd_right` varchar(50) NOT NULL,
  `fld_pd_left` varchar(50) NOT NULL,
  `fld_remarks` text NOT NULL,
  `fld_prescription_path` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_user_presc_entry`
--

INSERT INTO `tbl_user_presc_entry` (`fld_id`, `fld_user`, `fld_sph_od`, `fld_sph_os`, `fld_cyl_od`, `fld_cyl_os`, `fld_axis_od`, `fld_axis_os`, `fld_add_od`, `fld_add_os`, `fld_power_od`, `fld_power_os`, `fld_patient_name`, `fld_pd`, `fld_pd_right`, `fld_pd_left`, `fld_remarks`, `fld_prescription_path`) VALUES
(1, 1, '', '', '', '', '', '', '', '', '', '', 'Umesh Gurung', '', '', '', '', 'prescriptions/2013/06/20/2UFi_3.jpg'),
(2, 1, '', '', '', '', '', '', '', '', '', '', 'Umesh Gurung', '', '', '', '', 'prescriptions/2013/06/20/4omN_2.jpg'),
(4, 1, '-4.5', '-4', '-0.25', '', '6', '', '', '', '-4.625', '-4', 'Umesh Gurung', '39', '', '', '', ''),
(5, 1, '-4.5', '-4', '-0.25', '', '6', '', '', '', '-4.625', '-4', 'Umesh Gurung', '39', '', '', '', ''),
(6, 2, '-2.75', '0', '+2.75', '', '9', '', '', '', '-1.375', '0', 'Mahesh Shrestha', '39.5', '', '', 'What is the extra comment', ''),
(7, 2, '', '', '', '', '', '', '', '', '', '', 'Rabin Shrestha', '', '', '', '', 'prescriptions/2013/06/20/re0S_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_social_login`
--

CREATE TABLE IF NOT EXISTS `tbl_user_social_login` (
  `fld_social_id` int(240) NOT NULL AUTO_INCREMENT,
  `fld_user_id` int(5) NOT NULL,
  `fld_signature` varchar(240) NOT NULL,
  `fld_service` varchar(240) NOT NULL,
  `fld_profile_url` varchar(240) NOT NULL,
  PRIMARY KEY (`fld_social_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_user_social_login`
--

INSERT INTO `tbl_user_social_login` (`fld_social_id`, `fld_user_id`, `fld_signature`, `fld_service`, `fld_profile_url`) VALUES
(1, 3, '100000130068107', 'facebook', 'http://www.facebook.com/GurungUmes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(240) NOT NULL,
  `fld_address` varchar(240) NOT NULL,
  `fld_telephone` int(11) NOT NULL,
  `fld_mobile` int(11) NOT NULL,
  `fld_email` varchar(240) NOT NULL,
  `fld_website` varchar(240) NOT NULL,
  `fld_product_type` int(11) NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_vendor`
--

INSERT INTO `tbl_vendor` (`fld_id`, `fld_name`, `fld_address`, `fld_telephone`, `fld_mobile`, `fld_email`, `fld_website`, `fld_product_type`) VALUES
(1, 'Maruti Optical', 'Delhi', 23923354, 2147483647, 'maruti@hotmail.com', '', 4),
(2, 'Shyam Optic', 'madangir', 2147483647, 2147483647, 'shyam@hotmail.com', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
  `fld_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_user` int(11) NOT NULL,
  `fld_product` int(11) NOT NULL,
  `fld_product_type` int(11) NOT NULL,
  `fld_product_category` int(11) NOT NULL,
  `fld_date` datetime NOT NULL,
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`fld_id`, `fld_user`, `fld_product`, `fld_product_type`, `fld_product_category`, `fld_date`) VALUES
(1, 1, 5, 4, 5, '2013-05-29 07:54:26'),
(2, 1, 6, 4, 5, '2013-05-29 11:05:13'),
(3, 1, 7, 4, 5, '2013-06-04 13:22:54'),
(4, 8, 7, 4, 5, '2013-06-11 11:32:53'),
(5, 1, 4, 4, 2, '2013-06-20 08:03:05'),
(6, 1, 3, 4, 2, '2013-06-20 08:06:32'),
(7, 1, 2, 4, 2, '2013-06-20 08:06:35');
