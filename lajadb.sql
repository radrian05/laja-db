-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-04-2025 a las 05:48:22
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lajadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id_brand` int NOT NULL AUTO_INCREMENT,
  `name_brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description_brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_brand`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion_categoria` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE IF NOT EXISTS `historial` (
  `id_historial` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nota` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `referencia` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `stock_up` int DEFAULT NULL,
  `stock_down` int DEFAULT NULL,
  PRIMARY KEY (`id_historial`),
  KEY `id_producto` (`id_producto`),
  KEY `user_id` (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `CODE` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `NAME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `BRAND` int NOT NULL,
  `PRICE` double(10,2) DEFAULT '0.00',
  `STOCK` int DEFAULT '0',
  `CATEGORY` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `index_name` (`NAME`),
  KEY `index_brand` (`BRAND`),
  KEY `fk_category` (`CATEGORY`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userUid` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userPwd` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `IS_ADMIN` tinyint(1) NOT NULL DEFAULT '0',
  `IS_ACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `secretWord` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userId`, `userName`, `userUid`, `userPwd`, `IS_ADMIN`, `IS_ACTIVE`, `secretWord`) VALUES
(1, 'Admin', 'admin', '$2y$10$O7XPw/uf9bIewou6W1cAbuP8iYMmQ9flqco5F1wnFJKxTouOf58Hm', 1, 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
