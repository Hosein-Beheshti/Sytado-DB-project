-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2020 at 04:06 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sytado`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` bigint(10) NOT NULL,
  `addressName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `customer_id` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `address`
--
DELIMITER $$
CREATE TRIGGER `address_delete` AFTER INSERT ON `address` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('address', 'delete', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `address_insert` AFTER INSERT ON `address` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('adress', 'insert', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `address_update` AFTER UPDATE ON `address` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('address', 'update', CURDATE())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `nationalCode` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `customer_delete` AFTER INSERT ON `customer` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('customer', 'delete', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `customer_insert` AFTER INSERT ON `customer` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('customer', 'insert', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `customer_update` AFTER UPDATE ON `customer` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('customer', 'update', CURDATE())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` bigint(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `nationalCode` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `delivery`
--
DELIMITER $$
CREATE TRIGGER `delivery_delete` AFTER INSERT ON `delivery` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('delivery', 'delete', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delivery_insert` AFTER INSERT ON `delivery` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('delivery', 'insert', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delivery_update` AFTER UPDATE ON `delivery` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('delivery', 'update', CURDATE())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `food_list`
--

CREATE TABLE `food_list` (
  `factor_id` bigint(10) NOT NULL,
  `food` varchar(255) NOT NULL,
  `price` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `food_list`
--
DELIMITER $$
CREATE TRIGGER `food_list_insert` AFTER INSERT ON `food_list` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('food_list', 'insert', CURDATE())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `table_name` varchar(255) NOT NULL,
  `query` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_factor`
--

CREATE TABLE `material_factor` (
  `material_factor_id` bigint(10) NOT NULL,
  `store_id` bigint(10) NOT NULL,
  `totalPrice` varchar(255) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `material_factor`
--
DELIMITER $$
CREATE TRIGGER `material_factor_delete` AFTER INSERT ON `material_factor` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('material_factor', 'delete', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `material_factor_insert` AFTER INSERT ON `material_factor` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('material_factor', 'insert', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `material_factor_update` AFTER UPDATE ON `material_factor` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('material_factor', 'update', CURDATE())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `material_list`
--

CREATE TABLE `material_list` (
  `material_factor_id` bigint(10) NOT NULL,
  `material` varchar(255) NOT NULL,
  `price` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `material_list`
--
DELIMITER $$
CREATE TRIGGER `material_list_delete` AFTER INSERT ON `material_list` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('material_list', 'delete', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `material_list_insert` AFTER INSERT ON `material_list` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('material_list', 'insert', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `material_list_update` AFTER UPDATE ON `material_list` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('material_list', 'update', CURDATE())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `factor_id` bigint(10) NOT NULL,
  `food_list` varchar(255) NOT NULL,
  `price_list` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `menu`
--
DELIMITER $$
CREATE TRIGGER `menu_delete` AFTER INSERT ON `menu` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('menu', 'delete', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `menu_insert` AFTER INSERT ON `menu` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('menu', 'insert', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `menu_update` AFTER UPDATE ON `menu` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('menu', 'update', CURDATE())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_factor`
--

CREATE TABLE `order_factor` (
  `factor_id` bigint(10) NOT NULL,
  `address_id` bigint(10) DEFAULT NULL,
  `customer_id` bigint(10) DEFAULT NULL,
  `delivery_id` bigint(10) DEFAULT NULL,
  `totalPrice` varchar(255) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `order_factor`
--
DELIMITER $$
CREATE TRIGGER `food_list_delete` AFTER INSERT ON `order_factor` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('food_list', 'delete', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `food_list_update` AFTER UPDATE ON `order_factor` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('food_list', 'update', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `order_factor_delete` AFTER INSERT ON `order_factor` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('order_factor', 'delete', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `order_factor_insert` AFTER INSERT ON `order_factor` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('order_factor', 'insert', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `order_factor_update` AFTER UPDATE ON `order_factor` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('order_factor', 'update', CURDATE())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` bigint(10) NOT NULL,
  `storeName` varchar(255) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `store`
--
DELIMITER $$
CREATE TRIGGER `store_delete` AFTER INSERT ON `store` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('store', 'delete', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `store_insert` AFTER INSERT ON `store` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('store', 'insert', CURDATE())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `store_update` AFTER UPDATE ON `store` FOR EACH ROW INSERT INTO log(table_name , query , date) VALUES('store', 'update', CURDATE())
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `food_list`
--
ALTER TABLE `food_list`
  ADD KEY `factor_id` (`factor_id`);

--
-- Indexes for table `material_factor`
--
ALTER TABLE `material_factor`
  ADD PRIMARY KEY (`material_factor_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `material_list`
--
ALTER TABLE `material_list`
  ADD KEY `material_factor_id` (`material_factor_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`factor_id`);

--
-- Indexes for table `order_factor`
--
ALTER TABLE `order_factor`
  ADD PRIMARY KEY (`factor_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `delivery_id` (`delivery_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_factor`
--
ALTER TABLE `material_factor`
  MODIFY `material_factor_id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `factor_id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_factor`
--
ALTER TABLE `order_factor`
  MODIFY `factor_id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `food_list`
--
ALTER TABLE `food_list`
  ADD CONSTRAINT `food_list_ibfk_1` FOREIGN KEY (`factor_id`) REFERENCES `order_factor` (`factor_id`);

--
-- Constraints for table `material_factor`
--
ALTER TABLE `material_factor`
  ADD CONSTRAINT `material_factor_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `material_list`
--
ALTER TABLE `material_list`
  ADD CONSTRAINT `material_list_ibfk_1` FOREIGN KEY (`material_factor_id`) REFERENCES `material_factor` (`material_factor_id`);

--
-- Constraints for table `order_factor`
--
ALTER TABLE `order_factor`
  ADD CONSTRAINT `order_factor_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_factor_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_factor_ibfk_3` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`delivery_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
