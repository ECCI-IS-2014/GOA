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
  `discount` int(11) NOT NULL DEFAULT '0',
  `image` varchar(150) DEFAULT 'placeholder.png',
  `enable_product` tinyint(1) DEFAULT '1',
  `rating` float DEFAULT '0',
  `weight` decimal(9,2) NOT NULL DEFAULT '0.00',
  `volume` decimal(9,2) DEFAULT '0.00',
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
  `frecuent_client` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishes`
--

CREATE TABLE IF NOT EXISTS `wishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `noRepit` (`user_id`,`product_id`),
  UNIQUE KEY `user_id` (`user_id`,`product_id`),
  KEY `product_id` (`product_id`),
  KEY `wishes_ibfk_1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_sales`
--

CREATE TABLE IF NOT EXISTS `product_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(9,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `noRepit` (`sale_id`,`product_id`),
  UNIQUE KEY `user_id` (`sale_id`,`product_id`),
  KEY `FK_sale_id` (`sale_id`),
  KEY `FK_product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `method_payment_id` int(11) NOT NULL,
  `subtotal` decimal(9,2) NOT NULL DEFAULT '0.00',
  `frequenly_costumer_discount` decimal(9,2) NOT NULL DEFAULT '0.00',
  `total` decimal(9,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(20) NOT NULL DEFAULT 'Dolars',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tax` decimal(9,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `FK_sales_user_id` (`user_id`),
  KEY `FK_sales_method_payment_id` (`method_payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishes`
--

CREATE TABLE IF NOT EXISTS `credit_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `brand` varchar(25) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_name` varchar(50) NOT NULL,
  `expiration_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_number` (`card_number`),
  KEY `FK_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank_cards` (entidad financiera)
--

CREATE TABLE IF NOT EXISTS `bank_cards` (
  `id` char(16) NOT NULL,
  `expiration_date` date NOT NULL,
  `card_holder` varchar(30) NOT NULL,
  `balance` decimal(20,2) NOT NULL,
  `card_brand` varchar(20) NOT NULL,
  `verification_number` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Filtros para la tabla `wishes`
--
ALTER TABLE `wishes`
  ADD CONSTRAINT `wishes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `product_sales`
--
ALTER TABLE `product_sales`
  ADD CONSTRAINT `product_sales_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_sales_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_sales_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_sales_method_payment_id` FOREIGN KEY (`method_payment_id`) REFERENCES `credit_cards` (`id`);
  
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `rating` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_id` (`user_id`),
  KEY `FK_products_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);  
  
  
  
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



