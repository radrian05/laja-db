-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 03, 2024 at 12:59 AM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productos`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(50) CHARACTER SET utf8 NOT NULL,
  `NAME` varchar(100) CHARACTER SET utf8 NOT NULL,
  `BRAND` set('Kia','Hyundai','Chevrolet','Misc') CHARACTER SET utf8 NOT NULL,
  `CATEGORY` set('Categoria1','Categoria2','Categoria3','Accesorios') CHARACTER SET utf8 NOT NULL,
  `PRICE` double(10,2) DEFAULT '0.00',
  `STOCK` int(10) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `index_name` (`NAME`),
  KEY `index_brand` (`BRAND`),
  KEY `index_category` (`CATEGORY`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='test';

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `CODE`, `NAME`, `BRAND`, `CATEGORY`, `PRICE`, `STOCK`) VALUES
(1, '938393933G', 'Test', 'Kia', 'Categoria1', 0.00, 1),
(2, '4785837587SS', 'TestAutoIncrement', 'Chevrolet', 'Accesorios', 10.00, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
