-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2020 a las 03:51:39
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `digitalmtx`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garantias`
--

CREATE TABLE `garantias` (
  `id` int(11) NOT NULL,
  `Numero_Factura` varchar(20) NOT NULL,
  `Nombre_Cliente` varchar(30) NOT NULL,
  `Telefono_Cliente` varchar(30) NOT NULL,
  `Correo_Cliente` varchar(30) NOT NULL,
  `Direccion_Cliente` varchar(30) NOT NULL,
  `Observacion_Cliente` text NOT NULL,
  `Observacion_Empleado` text NOT NULL,
  `Aprobacion_Garantia` varchar(5) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `id_Personal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `garantias`
--

INSERT INTO `garantias` (`id`, `Numero_Factura`, `Nombre_Cliente`, `Telefono_Cliente`, `Correo_Cliente`, `Direccion_Cliente`, `Observacion_Cliente`, `Observacion_Empleado`, `Aprobacion_Garantia`, `Estado`, `id_Personal`) VALUES
(2, '', 'Juan', '34343', 'Juan@email.com', 'Calle 100', 'El celular tiene la bateria dañada', 'Recibo bateria dañada', 'SI', 'Pendiente', 1),
(3, '432432432', 'Juan', '2321321', 'Jnordonez7@misena.edu.co', 'Calle 100', 'sadasdas', 'dasdas', 'SI', 'Pendiente', 1),
(4, '1930024', 'Diego', '3242342', 'fredyvgr@hotmail.com', 'Cra 47 N75 S64', 'Bateria en mal estado', 'Se reviso y se paso a soporte tecnico', 'SI', 'Pendiente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `Nombres` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Contrasena` varchar(30) NOT NULL,
  `Telefono` varchar(30) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `Nombres`, `Apellidos`, `Correo`, `Contrasena`, `Telefono`, `id_rol`) VALUES
(1, 'Fredy', 'Belson', 'fredy@gmail.com', '123456', '55555555', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`) VALUES
(1, 'Recepcion'),
(2, 'Tecnico'),
(3, 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `garantias`
--
ALTER TABLE `garantias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_garantias_personal` (`id_Personal`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personal_rol` (`id_rol`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `garantias`
--
ALTER TABLE `garantias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `garantias`
--
ALTER TABLE `garantias`
  ADD CONSTRAINT `fk_garantias_personal` FOREIGN KEY (`id_Personal`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `fk_personal_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
