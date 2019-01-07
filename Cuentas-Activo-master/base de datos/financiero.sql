-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2019 a las 16:44:35
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `financiero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo`
--

CREATE TABLE `activo` (
  `id_activo` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `encargado_id_encargado` int(11) NOT NULL,
  `correlativo` varchar(45) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `tiempo_uso` int(11) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `activo`
--

INSERT INTO `activo` (`id_activo`, `id_tipo`, `id_departamento`, `id_institucion`, `id_usuario`, `encargado_id_encargado`, `correlativo`, `fecha_adquisicion`, `descripcion`, `estado`, `tiempo_uso`, `observaciones`, `precio`) VALUES
(0, 0, 0, 0, 1, 0, '0001', '2019-01-05', 'compra', 'ACTIVO', 12, 'carrito', 2500),
(0, 0, 0, 0, 1, 0, '0002', '2019-01-05', 'compra', 'ACTIVO', 12, 'carrito', 2500),
(0, 0, 0, 0, 1, 0, '0003', '2019-01-05', 'compra', 'ACTIVO', 12, 'carrito', 2500),
(0, 0, 0, 0, 1, 0, '0004', '2019-01-05', 'compra', 'ACTIVO', 12, 'carrito', 2500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id_clasificacion` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `correlativo` varchar(45) NOT NULL,
  `tiempo_depreciacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`id_clasificacion`, `nombre`, `correlativo`, `tiempo_depreciacion`) VALUES
(1, 'Moviliario y Equipo', '001', 24),
(2, 'Vehiculos', '002', 48),
(3, 'Maquinaria', '003', 60),
(4, 'Edificio', '004', 240),
(5, 'Terrenos', '005', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `correlativo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nombre`, `correlativo`) VALUES
(0, 'Economia', '0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--

CREATE TABLE `encargado` (
  `id_encargado` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `dui` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encargado`
--

INSERT INTO `encargado` (`id_encargado`, `nombre`, `apellido`, `dui`) VALUES
(0, 'Juan', 'Perez', '12223334-4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id_institucion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `correlativo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id_institucion`, `nombre`, `correlativo`) VALUES
(0, 'xyz', '0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_activo`
--

CREATE TABLE `tipo_activo` (
  `id_tipo` int(11) NOT NULL,
  `id_clasificacion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `correlativo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_activo`
--

INSERT INTO `tipo_activo` (`id_tipo`, `id_clasificacion`, `nombre`, `correlativo`) VALUES
(0, 2, 'carrito', '0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `zona` varchar(30) NOT NULL,
  `dui` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `nivel` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `zona`, `dui`, `pass`, `nivel`) VALUES
(1, 'teto', 'duran', 'paracentral', '00023323-0', 'teto', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activo`
--
ALTER TABLE `activo`
  ADD KEY `1` (`id_tipo`),
  ADD KEY `2` (`id_departamento`),
  ADD KEY `3` (`id_institucion`),
  ADD KEY `4` (`id_usuario`),
  ADD KEY `5` (`encargado_id_encargado`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD KEY `id_clasificacion` (`id_clasificacion`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `encargado`
--
ALTER TABLE `encargado`
  ADD KEY `id_encargado` (`id_encargado`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD KEY `id_institucion` (`id_institucion`);

--
-- Indices de la tabla `tipo_activo`
--
ALTER TABLE `tipo_activo`
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `7` (`id_clasificacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activo`
--
ALTER TABLE `activo`
  ADD CONSTRAINT `1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_activo` (`id_tipo`),
  ADD CONSTRAINT `2` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`),
  ADD CONSTRAINT `3` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`),
  ADD CONSTRAINT `4` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `5` FOREIGN KEY (`encargado_id_encargado`) REFERENCES `encargado` (`id_encargado`);

--
-- Filtros para la tabla `tipo_activo`
--
ALTER TABLE `tipo_activo`
  ADD CONSTRAINT `7` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificacion` (`id_clasificacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
