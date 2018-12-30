-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2017 a las 07:25:46
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdtiendita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono`
--

CREATE TABLE `abono` (
  `id` int(11) NOT NULL,
  `cuenta` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `nota` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `id_contable` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `encargado` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `nom_imp` varchar(25) NOT NULL,
  `val_imp` int(11) NOT NULL,
  `docc` varchar(50) NOT NULL,
  `vdocc` varchar(11) NOT NULL,
  `doco` varchar(50) NOT NULL,
  `vdoco` varchar(50) NOT NULL,
  `ftel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`id`, `nombre`, `direccion`, `telefono`, `encargado`, `estado`, `nom_imp`, `val_imp`, `docc`, `vdocc`, `doco`, `vdoco`, `ftel`) VALUES
(1, 'Principal', 'Sn Salvador, 4? norte barrio Centro', '7979-7979', 'Dra. Martha Ceceilia Leiva Osorto', 's', 'IVA', 13, 'RUC', '999999-99', 'CEDULA', '999999999-9', '9999-9999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `cat` int(11) NOT NULL,
  `und` int(11) NOT NULL,
  `valor` varchar(25) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `estante` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `estado` varchar(25) NOT NULL,
  `inv` varchar(10) NOT NULL,
  `prov` varchar(11) NOT NULL,
  `iva` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajacom_tmp`
--

CREATE TABLE `cajacom_tmp` (
  `id` int(11) NOT NULL,
  `articulo` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `p_compra` varchar(12) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajac_tmp`
--

CREATE TABLE `cajac_tmp` (
  `id` int(11) NOT NULL,
  `articulo` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `p_mayor` varchar(12) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_tmp`
--

CREATE TABLE `caja_tmp` (
  `id` int(11) NOT NULL,
  `articulo` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `p_mayor` varchar(12) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajero`
--

CREATE TABLE `cajero` (
  `usu` varchar(255) NOT NULL,
  `almacen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cajero`
--

INSERT INTO `cajero` (`usu`, `almacen`) VALUES
('112233444', '1'),
('1234', '1'),
('12345', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clcot_tmp`
--

CREATE TABLE `clcot_tmp` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `rut` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientcred_tmp`
--

CREATE TABLE `clientcred_tmp` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `rut` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dir` text NOT NULL,
  `dui` varchar(25) NOT NULL,
  `sexo` varchar(11) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `nrc` varchar(25) NOT NULL,
  `estado` varchar(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_tmp`
--

CREATE TABLE `cliente_tmp` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `rut` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contable`
--

CREATE TABLE `contable` (
  `id` int(11) NOT NULL,
  `concepto1` varchar(255) NOT NULL,
  `concepto2` longtext NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `usu` varchar(255) NOT NULL,
  `consultorio` varchar(255) NOT NULL,
  `clase` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizador_tmp`
--

CREATE TABLE `cotizador_tmp` (
  `id` int(11) NOT NULL,
  `articulo` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `p_mayor` varchar(12) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `descto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desc_tmp`
--

CREATE TABLE `desc_tmp` (
  `id` int(11) NOT NULL,
  `descuento` varchar(11) NOT NULL,
  `almacen` varchar(12) NOT NULL,
  `usu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id` int(255) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `articulo` int(25) NOT NULL,
  `codigo` varchar(25) NOT NULL,
  `cantidad` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `importe` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `categoria` int(11) NOT NULL,
  `almacen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comp`
--

CREATE TABLE `detalle_comp` (
  `id` int(11) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `importe` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `categoria` int(11) NOT NULL,
  `almacen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dir` text NOT NULL,
  `dui` varchar(25) NOT NULL,
  `nit` varchar(25) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `sexo` varchar(11) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `sueldo` varchar(100) NOT NULL,
  `estado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(255) NOT NULL,
  `empresa` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `moneda` varchar(22) COLLATE utf8_spanish_ci NOT NULL,
  `anno` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `iva` int(11) NOT NULL,
  `tama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `empresa`, `nit`, `direccion`, `pais`, `ciudad`, `tel`, `fax`, `web`, `correo`, `fecha`, `moneda`, `anno`, `iva`, `tama`) VALUES
(1, 'ELECTRO INDUSTRIAL', '123111-4565-455', 'San Miguel', 'EL SALVADOR', 'San Miguel', '809-424-8312', '2663-4422', 'sig.mitienditaonline.net', 'electroindustria@mitiendita.com', '2016-08-15', '$', '2014', 16, 270);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enviado`
--

CREATE TABLE `enviado` (
  `id` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `usu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `body` text COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `class` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'event-important',
  `start` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `end` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(255) NOT NULL,
  `almacen` int(11) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fact_comp`
--

CREATE TABLE `fact_comp` (
  `id` int(11) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(255) NOT NULL,
  `almacen` int(11) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fact_cot`
--

CREATE TABLE `fact_cot` (
  `id` int(11) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(255) NOT NULL,
  `almacen` int(11) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `almacen` int(11) NOT NULL,
  `articulo` int(11) NOT NULL,
  `codigo` varchar(25) NOT NULL,
  `stock` varchar(11) NOT NULL,
  `stock_min` varchar(11) NOT NULL,
  `pv` varchar(11) NOT NULL,
  `pmy` varchar(11) NOT NULL,
  `cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id` int(11) NOT NULL,
  `factura` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `cant` varchar(11) NOT NULL,
  `costok` varchar(50) NOT NULL,
  `importe` varchar(50) NOT NULL,
  `stockk` varchar(11) NOT NULL,
  `fecha` date NOT NULL,
  `sucursal` int(11) NOT NULL,
  `usu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(25) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`, `usu`, `estado`) VALUES
(1, '1', '112233444', 's'),
(2, '2', '112233444', 's'),
(3, '3', '112233444', 's'),
(4, '4', '112233444', 's'),
(5, '5', '112233444', 's'),
(6, '6', '112233444', 's'),
(7, '7', '112233444', 's'),
(8, '8', '112233444', 's'),
(9, '9', '112233444', 's'),
(10, '10', '112233444', 's'),
(11, '11', '112233444', 's'),
(12, '12', '112233444', 's'),
(13, '13', '112233444', 's'),
(14, '14', '112233444', 's'),
(15, '15', '112233444', 's'),
(16, '16', '112233444', 's'),
(17, '17', '112233444', 's'),
(18, '18', '112233444', 's'),
(73, '1', '1234', 'n'),
(74, '2', '1234', 'n'),
(75, '3', '1234', 'n'),
(76, '4', '1234', 'n'),
(77, '5', '1234', 'n'),
(78, '6', '1234', 'n'),
(79, '7', '1234', 's'),
(80, '8', '1234', 'n'),
(81, '9', '1234', 'n'),
(82, '10', '1234', 'n'),
(83, '11', '1234', 'n'),
(84, '12', '1234', 'n'),
(85, '13', '1234', 'n'),
(86, '14', '1234', 'n'),
(87, '15', '1234', 'n'),
(88, '16', '1234', 'n'),
(89, '17', '1234', 'n'),
(90, '18', '1234', 'n'),
(91, '1', '12345', 's'),
(92, '2', '12345', 's'),
(93, '3', '12345', 's'),
(94, '4', '12345', 's'),
(95, '5', '12345', 's'),
(96, '6', '12345', 's'),
(97, '7', '12345', 's'),
(98, '8', '12345', 's'),
(99, '9', '12345', 's'),
(100, '10', '12345', 's'),
(101, '11', '12345', 's'),
(102, '12', '12345', 's'),
(103, '13', '12345', 's'),
(104, '14', '12345', 's'),
(105, '15', '12345', 's'),
(106, '16', '12345', 's'),
(107, '17', '12345', 's'),
(108, '18', '12345', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_tmp`
--

CREATE TABLE `permisos_tmp` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos_tmp`
--

INSERT INTO `permisos_tmp` (`id`, `nombre`) VALUES
(1, 'Principal'),
(2, 'Administrar Categorias'),
(3, 'Administrar Marcas'),
(4, 'Administrar Unidades'),
(5, 'Administrar Articulos'),
(6, 'Administrar Inventario'),
(7, 'Realizar Ventas'),
(8, 'Realizar Compras'),
(9, 'Administrar Clientes'),
(10, 'Administrar Proveedores'),
(11, 'Cobros y Pagos'),
(12, 'Reportes'),
(13, 'Modificar Stock'),
(14, 'Administrar Empresa'),
(15, 'Administrar Empleados'),
(16, 'Administrar Almacenes'),
(17, 'Administrar Cargos'),
(18, 'Administrar Usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `doc` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `doc`, `nom`, `cargo`, `estado`) VALUES
(1, '112233444', 'Administrador', 'admin', 's'),
(6, '12345', 'DELMAR RAMON', 'admin', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dir` text NOT NULL,
  `tel` varchar(25) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `nit` varchar(25) NOT NULL,
  `nrc` varchar(25) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `tel_fijo` varchar(11) NOT NULL,
  `cel` varchar(11) NOT NULL,
  `estado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prov_tmp`
--

CREATE TABLE `prov_tmp` (
  `id` int(11) NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `rut` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_prov`
--

CREATE TABLE `pro_prov` (
  `id` int(11) NOT NULL,
  `articulo` varchar(11) NOT NULL,
  `proveedor` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen`
--

CREATE TABLE `resumen` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `concepto` varchar(250) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `clase` varchar(250) NOT NULL,
  `valor` varchar(250) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `usu` varchar(250) NOT NULL,
  `almacen` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_comp`
--

CREATE TABLE `resumen_comp` (
  `id` int(11) NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  `concepto` varchar(250) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `clase` varchar(250) NOT NULL,
  `valor` varchar(250) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `usu` varchar(250) NOT NULL,
  `almacen` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_ticket`
--

CREATE TABLE `resumen_ticket` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `concepto` varchar(250) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `clase` varchar(250) NOT NULL,
  `valor` varchar(250) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `usu` varchar(250) NOT NULL,
  `almacen` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `config` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `ticket` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(255) NOT NULL,
  `almacen` int(11) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(25) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_permisos`
--

CREATE TABLE `tipo_permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_permisos`
--

INSERT INTO `tipo_permisos` (`id`, `permiso`, `tipo`, `estado`) VALUES
(1, '1', '1', 'n'),
(2, '2', '1', 'n'),
(3, '3', '1', 'n'),
(4, '4', '1', 'n'),
(5, '5', '1', 's'),
(6, '6', '1', 'n'),
(7, '7', '1', 'n'),
(8, '8', '1', 'n'),
(9, '9', '1', 'n'),
(10, '10', '1', 'n'),
(11, '11', '1', 'n'),
(12, '12', '1', 'n'),
(13, '13', '1', 'n'),
(14, '14', '1', 'n'),
(15, '15', '1', 's'),
(16, '16', '1', 's'),
(17, '17', '1', 'n'),
(18, '18', '1', 'n'),
(19, '1', '3', 'n'),
(20, '2', '3', 'n'),
(21, '3', '3', 'n'),
(22, '4', '3', 'n'),
(23, '5', '3', 'n'),
(24, '6', '3', 'n'),
(25, '7', '3', 'n'),
(26, '8', '3', 'n'),
(27, '9', '3', 'n'),
(28, '10', '3', 'n'),
(29, '11', '3', 'n'),
(30, '12', '3', 'n'),
(31, '13', '3', 'n'),
(32, '14', '3', 'n'),
(33, '15', '3', 'n'),
(34, '16', '3', 'n'),
(35, '17', '3', 'n'),
(36, '18', '3', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`) VALUES
(1, 'VENDEDOR'),
(3, 'CAJERO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `doc` varchar(255) NOT NULL,
  `con` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `salario` double NOT NULL,
  `estado` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `consultorio` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `doc`, `con`, `nombre`, `cargo`, `nota`, `salario`, `estado`, `tipo`, `consultorio`) VALUES
(1, '112233444', 'alcon', 'ADMINISTRADOR', 'Administrador', 'Ninguna', 0, 's', 'Admin', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono`
--
ALTER TABLE `abono`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cajacom_tmp`
--
ALTER TABLE `cajacom_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cajac_tmp`
--
ALTER TABLE `cajac_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_tmp`
--
ALTER TABLE `caja_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clcot_tmp`
--
ALTER TABLE `clcot_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientcred_tmp`
--
ALTER TABLE `clientcred_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente_tmp`
--
ALTER TABLE `cliente_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contable`
--
ALTER TABLE `contable`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizador_tmp`
--
ALTER TABLE `cotizador_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `desc_tmp`
--
ALTER TABLE `desc_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_comp`
--
ALTER TABLE `detalle_comp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enviado`
--
ALTER TABLE `enviado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fact_cot`
--
ALTER TABLE `fact_cot`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pro_prov`
--
ALTER TABLE `pro_prov`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resumen`
--
ALTER TABLE `resumen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resumen_comp`
--
ALTER TABLE `resumen_comp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resumen_ticket`
--
ALTER TABLE `resumen_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_permisos`
--
ALTER TABLE `tipo_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abono`
--
ALTER TABLE `abono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cajacom_tmp`
--
ALTER TABLE `cajacom_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cajac_tmp`
--
ALTER TABLE `cajac_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caja_tmp`
--
ALTER TABLE `caja_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clcot_tmp`
--
ALTER TABLE `clcot_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientcred_tmp`
--
ALTER TABLE `clientcred_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cliente_tmp`
--
ALTER TABLE `cliente_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contable`
--
ALTER TABLE `contable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cotizador_tmp`
--
ALTER TABLE `cotizador_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `desc_tmp`
--
ALTER TABLE `desc_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_comp`
--
ALTER TABLE `detalle_comp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `enviado`
--
ALTER TABLE `enviado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fact_cot`
--
ALTER TABLE `fact_cot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pro_prov`
--
ALTER TABLE `pro_prov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `resumen`
--
ALTER TABLE `resumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `resumen_comp`
--
ALTER TABLE `resumen_comp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `resumen_ticket`
--
ALTER TABLE `resumen_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_permisos`
--
ALTER TABLE `tipo_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
