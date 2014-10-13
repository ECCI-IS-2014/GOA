-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2014 a las 19:10:32
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
  `father_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_category_father_id` (`father_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `father_category_id`) VALUES
(1, 'ropa', NULL),
(2, 'higiene personal', NULL),
(3, 'alimentos', NULL),
(4, 'electrodomesticos', NULL),
(5, 'muebles', NULL),
(6, 'hogar', NULL),
(7, 'sombreros', 1),
(8, 'calzado', 1),
(9, 'limpieza', NULL),
(10, 'miscelaneo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `image` varchar(150) DEFAULT NULL,
  `enable_product` tinyint(1) DEFAULT '1',
  `rating` int(11) DEFAULT '0',
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `quantity`, `image`, `enable_product`, `rating`, `description`) VALUES
(1, 8, 'sandalias', '2500.00', 14, NULL, 1, 0, 'no description'),
(2, 8, 'botas', '2500.00', 8, NULL, 1, 0, 'no description'),
(3, 8, 'burros', '2500.00', 11, NULL, 1, 0, 'no description'),
(4, 7, 'fedora', '8200.00', 7, NULL, 1, 0, 'no description'),
(5, 7, 'chonete', '5000.00', 6, NULL, 1, 0, 'no description'),
(6, 10, 'sombrilla', '3100.00', 19, NULL, 1, 0, 'no description'),
(7, 3, 'cereal kellogs', '2950.00', 32, NULL, 1, 0, 'no description'),
(8, 3, 'cereal nestle', '3400.00', 22, NULL, 1, 0, 'no description'),
(9, 5, 'mesa', '36000.00', 3, NULL, 1, 0, 'no description'),
(10, 5, 'silla', '17800.00', 12, NULL, 1, 0, 'no description'),
(11, 10, 'candela', '100.00', 341, NULL, 1, 0, 'no description'),
(12, 6, 'cortina', '12000.00', 26, NULL, 1, 0, 'no description'),
(13, 6, 'cobija', '9400.00', 8, NULL, 1, 0, 'no description'),
(14, 6, 'almohada', '6200.00', 14, NULL, 1, 0, 'o description'),
(15, 6, 'espejo', '14300.00', 15, NULL, 1, 0, 'No description'),
(16, 9, 'detergente', '4300.00', 32, NULL, 1, 0, 'El limpio más limpio!'),
(17, 9, 'suavitel', '3900.00', 28, NULL, 1, 0, 'Igual de suave que mama'),
(18, 2, 'cepillo de dientes', '1600.00', 27, NULL, 1, 0, ''),
(19, 2, 'pasta de dientes', '1930.00', 45, NULL, 1, 0, 'Oral B 360'),
(20, 2, 'jabon', '800.00', 38, NULL, 1, 0, 'Huela como nalgas de bebe!'),
(21, 9, 'prensa de ropa', '25.00', 1058, NULL, 1, 0, 'Super comodas! no generan callos en sus dedos'),
(22, 4, 'lavadora', '182000.00', 5, NULL, 1, 0, '220v 1.5t de capacidad'),
(23, 4, 'horno microondas', '37300.00', 19, NULL, 1, 0, 'lorem ipsum'),
(24, 4, 'refrigerador', '232000.00', 7, NULL, 1, 0, 'Atlas 3000'),
(25, 4, 'televisor', '430000.00', 12, NULL, 1, 0, 'Sony Bravia 42''. 1080p');

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
(2, 1, 0, 0, 0, 0, 0),
(3, 1, 0, 0, 0, 0, 0),
(4, 1, 0, 0, 0, 0, 0),
(5, 1, 0, 0, 0, 0, 0),
(6, 1, 0, 0, 0, 0, 0),
(7, 1, 0, 0, 0, 0, 0),
(8, 1, 0, 0, 0, 0, 0),
(9, 1, 0, 0, 0, 0, 0),
(10, 1, 0, 0, 0, 0, 0),
(11, 1, 0, 0, 0, 0, 0),
(12, 1, 0, 0, 0, 0, 0),
(13, 1, 0, 0, 0, 0, 0),
(14, 1, 0, 0, 0, 0, 0),
(15, 1, 0, 0, 0, 0, 0),
(16, 1, 0, 0, 0, 0, 0),
(17, 1, 0, 0, 0, 0, 0),
(18, 1, 0, 0, 0, 0, 0),
(19, 1, 0, 0, 0, 0, 0),
(20, 1, 0, 0, 0, 0, 0),
(21, 1, 0, 0, 0, 0, 0),
(22, 1, 0, 0, 0, 0, 0),
(23, 1, 0, 0, 0, 0, 0),
(24, 1, 0, 0, 0, 0, 0),
(25, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
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
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
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
