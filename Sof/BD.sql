-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2014 a las 17:59:15
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
-- Estructura de tabla para la tabla `bank_cards`
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
-- Volcado de datos para la tabla `bank_cards`
--

INSERT INTO `bank_cards` (`id`, `expiration_date`, `card_holder`, `balance`, `card_brand`, `verification_number`) VALUES
('2347190873276228', '2016-11-18', 'Pepito Perez Pereira', '20000.50', 'Mastercard', '000'),
('2897309872176284', '2016-11-18', 'Pepito Perez Pereira', '20000.50', 'Visa', '000'),
('6752986723647829', '2015-03-27', 'Jordan Jimenez Jara', '34920.22', 'Mastercard', '000'),
('7829367022378349', '2014-12-24', 'Mafalda Mata Morera', '2345600.30', 'American Express', '000'),
('8926738498762934', '2010-12-01', 'Rodolfo Ramirez Ramos', '3400.90', 'American Express', '000');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `father_category_id`) VALUES
(0, 'No category.', 0),
(1, 'Clothing', 0),
(2, 'Personal Care', 0),
(3, 'Food', 0),
(4, 'Home', 0),
(5, 'Appliances', 4),
(6, 'Furniture', 4),
(7, 'Hats', 1),
(8, 'Shoes', 1),
(9, 'Cleaning', 0),
(10, 'High Heels', 8),
(11, 'Televisions', 5),
(12, 'Miscellaneous', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_cards`
--

CREATE TABLE IF NOT EXISTS `credit_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `brand` varchar(25) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_name` varchar(50) NOT NULL,
  `expiration_date` date NOT NULL,
  `verification_number` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_number` (`card_number`),
  KEY `FK_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `credit_cards`
--

INSERT INTO `credit_cards` (`id`, `user_id`, `brand`, `card_number`, `card_name`, `expiration_date`, `verification_number`) VALUES
(1, 4, 'Visa', '2897309872176284', 'Pepito Perez Pereira', '2022-06-14', '000'),
(2, 4, 'Mastercard', '2347190873276228', 'Pepito Perez Pereira', '2014-11-04', '000'),
(3, 5, 'Mastercard', '6752986723647829', 'Jordan Jimenez Jara', '2014-11-04', '000'),
(4, 6, 'American Express', '7829367022378349', 'Mafalda Mata Morera', '2014-11-04', '000'),
(5, 7, 'American Express', '8926738498762934', 'Rodolfo Ramirez Ramos', '2014-11-04', '000');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `quantity`, `discount`, `image`, `enable_product`, `rating`, `weight`, `volume`, `description`) VALUES
(1, 8, 'Sandals', '30.00', 14, 30, 'sandalias.jpg', 0, 0, '0.25', '0.00', 'No description.'),
(2, 8, 'Boots', '70.00', 8, 0, 'botas.jpg', 1, 0, '0.70', '0.00', 'No description.'),
(3, 8, 'Work Shoes', '100.00', 11, 0, 'burros.jpg', 1, 5, '1.00', '0.00', 'No description.'),
(4, 7, 'Fedora', '20.00', 7, 20, '1413218846-1.jpg', 1, 0, '0.10', '0.00', 'No description.'),
(5, 7, 'Chonete', '15.00', 6, 0, 'chonete.jpg', 1, 0, '0.10', '0.00', 'No description.'),
(6, 12, 'Umbrella', '10.00', 19, 0, '1413218987-3.jpg', 1, 2, '0.90', '0.00', 'No description.'),
(7, 3, 'Kellogs Cereal', '5.50', 32, 0, 'kellogs.jpg', 0, 0, '0.70', '2050.00', 'No description.'),
(8, 3, 'Nestle Cereal', '5.00', 22, 0, 'nestle.jpg', 1, 4, '0.70', '2050.00', 'No description.'),
(9, 6, 'Table', '72.00', 3, 30, '1413219529-1.jpg', 1, 0, '9.50', '0.00', 'No description.'),
(10, 6, 'Chair', '38.00', 12, 0, 'silla.png', 1, 0, '5.50', '0.00', 'No description.'),
(11, 12, 'Candle', '0.25', 341, 0, 'candela.jpg', 1, 0, '0.05', '0.00', 'No description.'),
(12, 4, 'Curtain', '24.00', 26, 25, 'cortina.jpg', 1, 3, '2.50', '0.00', 'No description.'),
(13, 4, 'Blanket', '28.00', 8, 0, 'cobija.jpg', 1, 0, '1.50', '0.00', 'No description.'),
(14, 4, 'Pillow', '13.00', 14, 0, 'pillow.jpg', 0, 0, '0.50', '0.00', 'No description.'),
(15, 4, 'Mirror', '45.00', 15, 30, 'espejo.jpg', 1, 0, '3.00', '0.00', 'No description.'),
(16, 9, 'Detergent', '8.00', 32, 0, 'detergente.jpg', 1, 5, '5.00', '7700.00', 'The cleanest clean!'),
(17, 9, 'Suavitel', '8.50', 28, 0, 'suavitel.jpg', 1, 0, '5.00', '5000.00', 'No description.'),
(18, 2, 'Toothbrush', '3.50', 27, 0, 'cepillo_dientes.jpg', 1, 4, '0.10', '0.00', 'No description.'),
(19, 2, 'Toothpaste', '4.25', 45, 0, 'colgate.jpg', 0, 0, '0.10', '0.00', 'Oral B 360'),
(20, 2, 'Soap', '2.00', 38, 0, 'jabon.jpg', 1, 0, '0.10', '120.00', 'Smells like a babys bottom!'),
(21, 1, 'Shirt', '30.00', 1058, 0, '1413474144-1.jpg', 1, 3, '0.15', '0.00', 'Color: Blue. Size: Small.'),
(22, 5, 'Washing Machine', '364.00', 5, 0, 'lavadora.jpg', 1, 0, '60.00', '1000000.00', '220v. Capacity: 1.5t'),
(23, 5, 'Microwave Oven', '154.50', 19, 0, 'microondas.jpg', 1, 2, '15.00', '45000.00', 'No description.'),
(24, 5, 'Fridge', '475.00', 7, 0, 'refrigerador.jpg', 0, 0, '85.00', '1500000.00', 'Atlas 3000'),
(25, 11, 'Television', '780.00', 12, 0, 'televisor.jpg', 1, 5, '15.00', '0.00', 'Sony Bravia 42');

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

--
-- Volcado de datos para la tabla `ratings`
--

INSERT INTO `ratings` (`product_id`, `enable_rating`, `rating1`, `rating2`, `rating3`, `rating4`, `rating5`) VALUES
(1, 1, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0, 0),
(3, 1, 0, 0, 0, 0, 1),
(4, 1, 0, 0, 0, 0, 0),
(5, 1, 0, 0, 0, 0, 0),
(6, 1, 0, 1, 0, 0, 0),
(7, 0, 0, 0, 0, 0, 0),
(8, 1, 0, 0, 0, 1, 0),
(9, 1, 0, 0, 0, 0, 0),
(10, 1, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0),
(12, 1, 0, 0, 1, 0, 0),
(13, 1, 0, 0, 0, 0, 0),
(14, 1, 0, 0, 0, 0, 0),
(15, 0, 0, 0, 0, 0, 0),
(16, 1, 0, 0, 0, 0, 2),
(17, 0, 0, 0, 0, 0, 0),
(18, 1, 0, 0, 0, 3, 0),
(19, 1, 0, 0, 0, 0, 0),
(20, 1, 0, 0, 0, 0, 0),
(21, 1, 0, 1, 0, 1, 0),
(22, 1, 0, 0, 0, 0, 0),
(23, 1, 0, 2, 0, 0, 0),
(24, 1, 0, 0, 0, 0, 0),
(25, 1, 0, 0, 0, 0, 2);

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
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tax` int(3) NOT NULL DEFAULT '13',
  `currency` varchar(20) NOT NULL DEFAULT 'Dollar',
  PRIMARY KEY (`id`),
  KEY `FK_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`, `name`, `last_name`, `phone`, `address`, `email`, `gender`, `birth_date`, `status`) VALUES
(1, 'admin', '$2a$10$QsNPaOWnlwAxAbYyJRpFp.ZeQeE4lelnJsaSpE1MojOqS0EgaIW0m', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', '0000-00-00', 1),
(2, 'usuario', '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 0, '2014-10-15 02:33:56', '2014-10-15 02:33:56', 'Usuario', 'Usuario', 88888888, '200mts Norte del Palo de Mango', 'us@gmail.com', 'F', '1994-10-15', 1),
(3, 'usuario2', '$2a$10$VkbhvEwoxVQVpAMhiO7G1e8CbzgwkkQQ0xZMuj9sHMOIsfPsE/GSi', 0, '2014-10-22 17:51:55', '2014-10-22 17:51:55', 'Nombre', 'Apellido', 89898989, '100mts Sur de la Pulpe', 'us2@gmail.com', 'M', '1941-10-22', 1),
(4, 'pepito', '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 0, '2014-10-22 17:51:55', '2014-10-22 17:51:55', 'Pepito', 'Perez Pereira', 89898989, '100mts Sur de la Pulpe', 'us2@gmail.com', 'M', '1941-10-22', 1),
(5, 'jordan', '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 0, '2014-10-22 17:51:55', '2014-10-22 17:51:55', 'Jordan', 'Jimenez Jara', 89898989, '100mts Sur de la Pulpe', 'us2@gmail.com', 'M', '1941-10-22', 1),
(6, 'mafalda', '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 0, '2014-10-22 17:51:55', '2014-10-22 17:51:55', 'Mafalda', 'Mata Morera', 89898989, '100mts Sur de la Pulpe', 'us2@gmail.com', 'F', '1941-10-22', 1),
(7, 'rodolfo', '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 0, '2014-10-22 17:51:55', '2014-10-22 17:51:55', 'Rodolfo', 'Ramirez Ramos', 89898989, '100mts Sur de la Pulpe', 'us2@gmail.com', 'M', '1941-10-22', 1),
(8, 'carmen', '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 0, '2014-10-22 17:51:55', '2014-10-22 17:51:55', 'Carmen', 'Cespedes Cedeño', 89898989, '100mts Sur de la Pulpe', 'us2@gmail.com', 'F', '1941-10-22', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_category_father_id` FOREIGN KEY (`father_category_id`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `product_sales`
--
ALTER TABLE `product_sales`
  ADD CONSTRAINT `product_sales_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_sales_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `FK_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_sales_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `wishes`
--
ALTER TABLE `wishes`
  ADD CONSTRAINT `wishes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
