-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2020 a las 08:27:59
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `app_cliente` varchar(255) NOT NULL,
  `apm_cliente` varchar(255) NOT NULL,
  `telefono_cliente` int(10) NOT NULL,
  `correo_cliente` varchar(255) NOT NULL,
  `calle_cliente` varchar(255) NOT NULL,
  `colonia_cliente` varchar(255) NOT NULL,
  `num_cliente` varchar(10) NOT NULL,
  `municipio_cliente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `app_cliente`, `apm_cliente`, `telefono_cliente`, `correo_cliente`, `calle_cliente`, `colonia_cliente`, `num_cliente`, `municipio_cliente`) VALUES
(57, 'Jazhel', 'Mendoza', 'fer', 2147483647, '', '', '', '', ''),
(58, 'Judith', 'Mendoza', '', 2147483647, 'judit.edu@gmail.com', '', '', '', ''),
(59, 'Michel', 'Arriaga', '', 0, '', '', '', '', ''),
(60, 'Bernardo', '', '', 0, '', '', '', '', ''),
(61, 'Judith', 'Mendoza', 'Becerril', 2147483647, '', '', '', '', 'Pachuca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigoProducto` varchar(100) NOT NULL,
  `nombreProducto` varchar(100) NOT NULL,
  `talla` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigoProducto`, `nombreProducto`, `talla`, `tipo`, `precio`) VALUES
(2, 'a23A', 'Playera Under Armour Negra', 'S', 'Deportiva', '0'),
(3, 'asdaEF', 'Playera Under Armour Azul', '', '', '0'),
(4, 'a23Awww', 'Playera Under Armour', 'M', 'Deportiva', '0'),
(5, 'a23A4ttt', 'Playera Under Armour blanca', '', '', '0'),
(6, 'a23A4ttth', 'Falda', '', '', '0'),
(7, 'a23Awww', 'Playera Nike blanca', 'L', '', '0'),
(8, 'a23Awww', 'Pantalon de gabardina', '', '', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombreProveedor` varchar(100) NOT NULL,
  `correoProveedor` varchar(100) NOT NULL,
  `nombreEmpresa` varchar(100) NOT NULL,
  `direccionEmpresa` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombreProveedor`, `correoProveedor`, `nombreEmpresa`, `direccionEmpresa`) VALUES
(11, 'Ernesto Bonilla', 'bonilla@cbtis.edu', 'NetoInternet', 'Meztitlan');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
