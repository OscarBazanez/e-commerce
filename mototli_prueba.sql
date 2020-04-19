-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-03-2020 a las 17:12:10
-- Versión del servidor: 10.3.22-MariaDB-log
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mototli_prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ID` int(244) NOT NULL,
  `orden` int(244) NOT NULL,
  `animal_ID` int(244) NOT NULL,
  `producto_ID` int(244) NOT NULL,
  `orden_pay` varchar(244) NOT NULL,
  `nombre_perso` varchar(20) NOT NULL,
  `correo_perso` varchar(20) NOT NULL,
  `tel_perso` int(20) NOT NULL,
  `cantidad` int(50) NOT NULL,
  `precio` int(50) NOT NULL,
  `estatus` varchar(15) NOT NULL,
  `tipo_pago` varchar(20) NOT NULL,
  `tel_envio` int(20) NOT NULL,
  `direccion_1` varchar(50) NOT NULL,
  `direccion_2` varchar(50) NOT NULL,
  `area_1` varchar(50) NOT NULL,
  `area_2` varchar(50) NOT NULL,
  `cod_pais` varchar(20) NOT NULL,
  `tipo_moneda` char(50) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `fecha_compra` varchar(30) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID` int(244) NOT NULL,
  `sku` varchar(244) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `descripcion` varchar(244) NOT NULL,
  `caracteristicas` varchar(244) NOT NULL,
  `alto` varchar(50) NOT NULL,
  `ancho` varchar(50) NOT NULL,
  `grosor` varchar(50) NOT NULL,
  `tamano` varchar(15) NOT NULL,
  `rela_cate_ID` int(244) NOT NULL,
  `precio` int(50) NOT NULL,
  `descuento` int(50) NOT NULL,
  `imagen` varchar(244) NOT NULL,
  `p_envio` int(50) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `active` tinyint(2) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID`, `sku`, `nombre`, `cantidad`, `marca`, `modelo`, `descripcion`, `caracteristicas`, `alto`, `ancho`, `grosor`, `tamano`, `rela_cate_ID`, `precio`, `descuento`, `imagen`, `p_envio`, `fecha`, `active`) VALUES
(1, '1', 'placa huesito', 99, 'Mototli', 'Motoplaca 1', 'descripcion', 'caracteristicas', '3 cm', '2 cm', '1 cm', 'Pequeño', 1, 120, 0, 'd02c68_jefferson.jpg', 150, '2020-01-12 11:23:55', 1),
(2, '2', 'Placa Holi', 80, 'Mototli', 'Motoplaca 2', 'descripcion', 'caracteristicas', '1 cm', '2 cm', '0.3 cm', 'Pequeño', 1, 300, 0, 'd02c68_jefferson.jpg', 150, '2020-01-12 11:25:03', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID` int(244) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID` int(244) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
