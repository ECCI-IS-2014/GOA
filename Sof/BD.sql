-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2014 a las 21:01:04
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tiendaprueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `father_category_id` int(11) DEFAULT '0', 
  PRIMARY KEY (`id`),
  KEY `FK_category_father_id` (`father_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Se usa la categoria 0 para los productos sin categoria o para las categorias sin padre
INSERT INTO categories ( id, name ) VALUES ( 0, 'No category.' );

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `image` varchar(150) DEFAULT 'placeholder.png',
  `enable_product` tinyint(1) DEFAULT '1',
  `rating` int(11) DEFAULT '0',
  `description` varchar(1000) NOT NULL DEFAULT 'No description.',
  PRIMARY KEY (`id`),
  KEY `FK_category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `product_id` int(11) NOT NULL,
  `enable_rating` tinyint(1) DEFAULT '1',
  `rating1` int(11) NOT NULL DEFAULT '0',
  `rating2` int(11) NOT NULL DEFAULT '0',
  `rating3` int(11) NOT NULL DEFAULT '0',
  `rating4` int(11) NOT NULL DEFAULT '0',
  `rating5` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `FK_product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(90) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `gender` char(1) NOT NULL,
  `birth_date` date NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_category_father_id` FOREIGN KEY (`father_category_id`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
  
--
-- Filtros para la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `FK_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
