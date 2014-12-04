-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2014 a las 09:59:40
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cafeteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`,`id_producto`),
  KEY `id_productofk` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_pedido`, `id_producto`, `cantidad`, `descuento`) VALUES
(1, 2, 2, 0),
(1, 3, 2, 0),
(2, 2, 2, 0),
(3, 2, 1, 0),
(4, 2, 2, 0),
(39, 2, 8, 0),
(39, 3, 8, 0),
(40, 2, 8, 0),
(40, 3, 8, 0),
(41, 2, 8, 0),
(41, 3, 8, 0),
(46, 2, 8, 0),
(49, 2, 8, 0),
(53, 2, 8, 0),
(58, 2, 8, 0),
(59, 2, 8, 0),
(60, 3, 8, 0),
(61, 3, 8, 0),
(62, 3, 8, 0),
(63, 3, 8, 0),
(64, 3, 8, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedido`
--

CREATE TABLE IF NOT EXISTS `estado_pedido` (
  `id_estado_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `status_pedido` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_estado_pedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `estado_pedido`
--

INSERT INTO `estado_pedido` (`id_estado_pedido`, `status_pedido`) VALUES
(1, 'EnProceso'),
(2, 'Cocinando'),
(3, 'ListoEntregar'),
(4, 'Entregado'),
(5, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_usuario`
--

CREATE TABLE IF NOT EXISTS `estado_usuario` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `estado_usuario`
--

INSERT INTO `estado_usuario` (`id_estado`, `estado`) VALUES
(1, 'Activo'),
(2, 'Bloqueado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado_pedido` int(11) DEFAULT NULL,
  `comentario` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_usuariofk` (`id_usuario`),
  KEY `fkestado_pedido` (`id_estado_pedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `fecha`, `id_usuario`, `id_estado_pedido`, `comentario`) VALUES
(1, '2014-10-15 00:00:00', 10040123, 4, 'sin papas'),
(2, '2014-10-21 00:00:00', 10030159, 4, 'bien guisado'),
(3, '2014-10-23 00:00:00', 10040123, 4, 'con mucha captsu'),
(4, '2014-10-24 00:00:00', 10050159, 4, 'sin comentarios'),
(39, '2014-12-04 00:05:00', 10030159, 5, 'hola mundo'),
(40, '2014-12-04 00:08:32', 10030159, 5, 'hola mundo'),
(41, '2014-12-04 00:11:26', 10030159, 5, 'hola mundo'),
(42, '2014-12-04 00:11:59', 10030159, 5, 'hola mundo'),
(43, '2014-12-04 00:22:19', 10030159, 5, 'hola mundo'),
(44, '2014-12-04 00:23:03', 10030159, 5, 'hola mundo'),
(45, '2014-12-04 00:24:06', 10030159, 5, 'hola mundo'),
(46, '2014-12-04 00:24:23', 10030159, 5, 'hola mundo'),
(47, '2014-12-04 00:25:57', 10030159, 4, 'hola mundo'),
(48, '2014-12-04 00:33:10', 10030159, 5, 'hola mundo'),
(49, '2014-12-04 00:33:22', 10030159, 5, 'hola mundo'),
(50, '2014-12-04 00:35:48', 10030159, 5, 'hola mundo'),
(51, '2014-12-04 02:31:59', 10030159, 5, 'hola mundo'),
(52, '2014-12-04 02:33:21', 10030159, 5, 'hola mundo'),
(53, '2014-12-04 02:33:36', 10030159, 4, 'hola mundo'),
(54, '2014-12-04 02:36:30', 10030159, 5, 'hola mundo'),
(55, '2014-12-04 03:05:04', 10030159, 5, 'hola mundo'),
(56, '2014-12-04 04:18:30', 10030159, 5, 'hola mundo'),
(57, '2014-12-04 06:28:11', 10030159, 5, 'hola mundo'),
(58, '2014-12-04 07:12:08', 10030159, 5, 'hola mundo'),
(59, '2014-12-04 07:23:24', 10030159, 3, 'hola mundo'),
(60, '2014-12-04 08:46:50', 10030159, 5, 'hola mundo'),
(61, '2014-12-04 09:00:16', 10030159, 5, 'hola mundo'),
(62, '2014-12-04 09:00:57', 10030159, 5, 'hola mundo'),
(63, '2014-12-04 09:08:40', 10030159, 5, 'hola mundo'),
(64, '2014-12-04 09:34:15', 10030159, 5, 'hola mundo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `precio` decimal(10,0) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `imagen` varchar(80) DEFAULT NULL,
  `descripcion` text,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `precio`, `nombre`, `imagen`, `descripcion`, `id_status`) VALUES
(2, 20, 'TORTA', 'a3c65c2974270fd093ee8a9bf8ae7d0belias.png', 'LA TORTA ESTA MUY BUENA.', 2),
(3, 30, 'hamburguesa', 'cfee398643cbc3dc5eefc89334cacdc1base.jpg', 'rica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_producto`
--

CREATE TABLE IF NOT EXISTS `status_producto` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `status_producto`
--

INSERT INTO `status_producto` (`id_status`, `status`) VALUES
(1, 'EnVenta'),
(2, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_user` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo`, `tipo_user`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'CLIENTE'),
(3, 'EMPLEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apaterno` varchar(50) DEFAULT NULL,
  `amaterno` varchar(50) DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `id_tipo` int(11) NOT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_tipofk` (`id_tipo`),
  KEY `fkestado` (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apaterno`, `amaterno`, `telefono`, `email`, `password`, `id_tipo`, `foto_perfil`, `id_estado`) VALUES
(10030159, 'elias', 'Gomez', 'lopez', 9325377680, 'elias_gomez10@hotmail.com', '1234567', 2, '32bb90e8976aab5298d5da10fe66f21d55997f49-7753-403b-b565-cfb0ca24ba4d-225x300.jpg', 1),
(10030591, 'Jose Elias', 'Gomez', 'Lopez', 7636501004, 'elias_gomez10111@hotmail.com', '123456', 1, 'admin.jpg', 1),
(10030596, 'elias', 'Gomez', 'lopez', 3577803753, 'elias_gomez12220@hotmail.com', '123456', 3, 'user.jpg', 1),
(10030598, 'Jose Elias', 'Gomez', NULL, 0, 'tcdsofia10592@hotmail.com', '1234567', 3, 'user.jpg', 1),
(10040123, 'Antonio', 'Lopez', 'Juarez', 4151113093, 'antonio@hotmail.com', '123456', 2, '8f85517967795eeef66c225f7883bdcbbase.jpg', 1),
(10050159, 'jose', 'torres', 'perez', 4151508033, 'jose@hotmail.com', '123456', 3, 'user.jpg', 1),
(76453423, 'asdcv', 'edfq', 'qaedf', 3618840090, 'gole10590@yahoo.com', '1234567', 3, 'user.jpg', 1),
(100301583, 'Jose Elias', 'Gomez', 'Lopez', 4151113193, 'tcdgole@hotmail.com', '123456', 1, 'user.jpg', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `id_pedidofk` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `id_productofk` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fkestado_pedido` FOREIGN KEY (`id_estado_pedido`) REFERENCES `estado_pedido` (`id_estado_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_usuariofk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status_producto` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fkestado` FOREIGN KEY (`id_estado`) REFERENCES `estado_usuario` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_tipofk` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_usuario` (`id_tipo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
