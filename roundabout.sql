-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2023 at 02:44 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roundabout`
--
CREATE DATABASE IF NOT EXISTS `roundabout` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `roundabout`;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `submitted_date` date DEFAULT NULL,
  `sold` tinyint(1) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `sold_date` date DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `items_ibfk_1` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `seller_id`, `submitted_date`, `sold`, `price`, `sold_date`) VALUES
(1, 'Blue Sweatshirt Size M', 1, '2022-06-02', 1, 149, '2023-06-13'),
(2, 'White T-shirt Size XL', 2, '2022-06-03', 1, 99, '2023-06-13'),
(3, 'Jeans Jacket Size XL', 2, '2022-06-03', 1, 499, '2022-06-08'),
(4, 'Leather Jacket Size Small', 3, '2022-06-05', 1, 399, '2023-06-13'),
(5, 'Bootcut Jeans Size 28', 3, '2022-06-05', 1, 199, '2023-06-14'),
(6, 'Grey Jeans size 46', 4, '2022-06-09', 1, 199, '2023-06-13'),
(17, 'Yellow Sweatshirt Size S', 3, '2022-06-02', 1, 149, '2023-06-14'),
(18, 'Black T-Shirt', 9, '2022-06-14', 0, 99, NULL),
(21, 'Blue Sweatshirt Size M', 1, '2022-06-02', 0, 149, NULL),
(22, 'Blue Sweatshirt Size M', 1, '2022-06-02', 1, 149, '2023-06-13'),
(25, 'Green Cap', 4, '2022-06-02', 0, 249, NULL),
(33, 'Blue Sweatshirt Size M', 2, '2022-06-02', 0, 149, NULL),
(34, 'Blue Sweatshirt Size M', 12, '2022-06-02', 0, 149, NULL),
(36, 'Blue Sweatshirt Size M', 3, '2022-06-02', 0, 149, NULL),
(37, 'Trucker Cap Brown', 14, '2023-06-14', 0, 299, NULL),
(38, 'Blue Cap Brown', 4, '2023-06-14', 0, 299, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
CREATE TABLE IF NOT EXISTS `sellers` (
  `seller_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `total_items_submitted` int(11) NOT NULL,
  `total_items_sold` int(11) NOT NULL,
  `total_sales_amount` int(11) NOT NULL,
  PRIMARY KEY (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `name`, `total_items_submitted`, `total_items_sold`, `total_sales_amount`) VALUES
(1, 'Robin Karlsson', 3, 2, 298),
(2, 'Björn Grön', 3, 2, 598),
(3, 'Lisa Fyrkant', 3, 4, 1146),
(4, 'Simon Kvist', 3, 1, 199),
(9, 'Peter Hacka', 1, 0, 0),
(12, 'Greta Thunberg', 1, 0, 0),
(13, 'Mathias Berg', 0, 0, 0),
(14, 'Emil Lönneberga', 1, 0, 0),
(15, 'Emil I Lönneberga', 0, 0, 0),
(16, 'Leverpastej och smörgåsgurka', 0, 0, 0),
(17, 'Leverpastej och smörgåsgurka', 0, 0, 0),
(18, 'Gurk Burk', 0, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`seller_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
