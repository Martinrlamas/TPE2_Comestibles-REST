-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2022 a las 05:03:28
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_comestibles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Lacteos'),
(2, 'Vegetales'),
(4, 'Carnes'),
(5, 'Panificados'),
(6, 'Enlatados'),
(7, 'Galletitas'),
(8, 'Golocinas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `precio` decimal(20,0) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto`, `precio`, `id_categoria`) VALUES
(1, 'Papa', '80', 2),
(2, 'Cebolla', '210', 2),
(3, 'Lechuga', '180', 2),
(4, 'Tomate', '210', 2),
(5, 'Manzana', '199', 2),
(10, 'Leche', '280', 1),
(11, 'Queso cremoso', '899', 1),
(12, 'Manteca', '463', 1),
(13, 'Queso crema', '649', 1),
(14, 'Dulce de leche', '159', 1),
(15, 'Crema', '169', 1),
(16, 'Tira de Asado', '736', 4),
(19, 'Vacio', '965', 4),
(20, 'Matambre', '938', 4),
(21, 'Falda', '483', 4),
(22, 'Tapa de asado', '736', 4),
(23, 'Nalga', '1009', 4),
(24, 'Paleta', '817', 4),
(25, 'Choclo en granos', '166', 6),
(26, 'Durazno enlatado', '350', 6),
(27, 'Pate', '108', 6),
(28, 'Garbanzos enlatados', '82', 6),
(29, 'Picadillo', '105', 6),
(30, 'Lentejas enlatadas', '105', 6),
(31, 'Atun enlatado', '220', 6),
(32, 'Porotos enlatados', '90', 6),
(33, 'Galletitas Oreo', '320', 7),
(34, 'Bizcochos 9 de Oro', '92', 7),
(35, 'Galletitas frambuesa sonrisa', '272', 7),
(36, 'Galletitas Secas Media tarde', '222', 7),
(37, 'Galletitas Variedad Terrabusi', '342', 7),
(38, 'Turron Arcor', '40', 8),
(39, 'Chocolate shot con mani', '66', 8),
(40, 'Caramelos sugus confitados', '125', 8),
(41, 'Chocolate para Taza Aguila', '558', 8),
(42, 'Alfajor Tofi Negro', '82', 8),
(43, 'Gomitas Mogul Frutales', '260', 8),
(44, 'Chicle Beldent menta', '86', 8),
(45, 'Pan para Hamburguesa Bimbo', '245', 5),
(46, 'Pan para Panchos Fargo', '158', 5),
(47, 'Rapiditas', '345', 5),
(48, 'Pan Lactal', '516', 5),
(49, 'Pan rallado Molto', '107', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'administrador@admin.com', '$2a$12$NKHIftZdd45oc1nIRYdf8O/6D02MxdPid2lArDGtvKao8D/tBZ7OG');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
