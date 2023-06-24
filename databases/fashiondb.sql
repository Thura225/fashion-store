-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2023 at 09:05 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fashiondb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `order_id` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `order_product` varchar(255) NOT NULL,
  `order_img` varchar(255) NOT NULL,
  `order_price` int(255) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` varchar(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `order_product` varchar(255) NOT NULL,
  `order_img` varchar(255) NOT NULL,
  `order_price` int(255) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_credit` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer`, `order_product`, `order_img`, `order_price`, `order_address`, `order_credit`) VALUES
('ord9996', 'Sumail', 'OmegaTex Long Shirt', 'img/omegatex_long_t_shirt.jpg', 60, 'Yangon', '7799777399');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(255) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` int(255) NOT NULL,
  `product_stocks` int(255) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_type`, `product_img`, `product_description`, `product_price`, `product_stocks`) VALUES
(1, 'Hanes Man T-Shirt', 'T-Shirt', 'img/hanes_man_t_shirt.jpg', 'T-Shirt that is created by Hanes Man', 30, 200),
(2, 'TeGone Dress', 'Dress', 'img/tegone_dress.jpg', 'Beautiful dress that suit for teen', 50, 200),
(3, 'OmegaTex Long Shirt', 'T-Shirt', 'img/omegatex_long_t_shirt.jpg', 'Stylish T-Shirt for Adult', 60, 200),
(4, 'Bery Love Dress', 'Dress', 'img/bery_love_dress.jpg', 'Beautiful dress that suit for attending party', 40, 200),
(5, 'Bape Sneakers', 'Sneakers', 'img/bape_sneaker.jpg', 'Nice sneakers from Bape', 70, 200),
(6, 'Promc Short Dress', 'Dress', 'img/promc_short_dress.jpg', 'Cute red dress for girl', 50, 200),
(7, 'Grace Dress', 'Dress', 'img/grace_dress.jpg', 'Nice pick dress', 60, 200),
(8, 'Wrangler Jean', 'Trowser', 'img/wrangler_jean.jpg', 'Comfortable jean for adult girl', 60, 200),
(9, 'Calvin Clain Long Shirt', 'T-Shirt', 'img/clavin_clain_long_shirt.jpg', 'Beautiful Long Shirt', 80, 200);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `img`, `user_email`) VALUES
(3, 'img/345840504_556006219780851_6327035854045005673_n.jpg', 'sumail@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `ph_no` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `ph_no` (`ph_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `ph_no`, `password`) VALUES
(9, 'Selen', 'sumail@gmail.com', '09776685431', '28552000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
