-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2018 a las 19:36:44
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

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
  `id_contable` int(12) NOT NULL,
  `total_interes` varchar(255) NOT NULL,
  `proximo_pago` date NOT NULL,
  `mora` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `abono`
--

INSERT INTO `abono` (`id`, `cuenta`, `valor`, `fecha`, `hora`, `nota`, `usu`, `id_contable`, `total_interes`, `proximo_pago`, `mora`) VALUES
(1, '3', '165.58', '2018-01-22', '11:22:26', 'Sin Observaciones', '112233444', 0, '21', '2018-03-22', 0),
(2, '3', '167.2358', '2018-02-26', '11:24:31', 'Sin Observaciones', '112233444', 0, '19.3442', '2018-03-22', 0),
(3, '2', '200', '2018-03-26', '11:26:12', 'Sin Observaciones', '112233444', 0, '', '0000-00-00', 0);

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

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `codigo`, `nombre`, `detalle`, `cat`, `und`, `valor`, `modelo`, `estante`, `marca`, `estado`, `inv`, `prov`, `iva`) VALUES
(1, '7415300005007', 'Labadora de ropa ', '', 1, 1, '900', '', '', 'Mabe', 's', 'ok', 'ok', 's'),
(2, '7415300005014', 'Refrigeradora', '', 1, 1, '900', '', '', 'LG', 's', 'ok', 'ok', 's'),
(3, '7501206652428', 'televison LG', '', 1, 1, '600', '', '', 'LG', 's', 'ok', 'ok', 's'),
(4, '7441102801011', 'Computadora Sony', '', 1, 2, '900', '', '', 'sony', 's', 'ok', 'ok', 's'),
(5, '7441102800960', 'Lapton HP', '', 1, 2, '500', '', '', 'HP', 's', 'ok', 'ok', 's'),
(6, '7441102800977', 'Sillones', '', 1, 2, '400', '', '', 'juego', 's', 'ok', 'ok', 's'),
(7, '7441102800945', 'Play Station 3', '', 1, 2, '200', '', '', 'sony', 's', 'ok', 'ok', 's'),
(8, '7441102800915', 'Play Station 4', '', 1, 2, '300', '', '', 'sony', 's', 'ok', 'ok', 's'),
(9, '7501206652411', 'Juego de sala', '', 1, 1, '300', '', '', 'juego', 's', 'ok', 'ok', 's'),
(10, 'P0001', 'Juguetera', '', 2, 3, '100', '', '', 'jugue', 's', 'ok', 'ok', 's'),
(11, '7613023253662', 'celular Sony Xperia XA', '', 2, 1, '500', '', '', 'Sony', 's', 'ok', 'ok', 's'),
(12, 'A0001', 'Table Galaxy note 3', '', 2, 1, '300', '', '', 'Sony', 's', 'ok', 'ok', 's'),
(13, 'A0002', 'Cocina', '', 2, 1, '300', '', '', 'Mabe', 's', 'ok', 'ok', 's'),
(14, 'A0003', 'Impresora ', '', 2, 1, '80', '', '', 'HP', 's', 'ok', 'ok', 's');

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

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(1, 'FERRETERIA', 's'),
(2, 'MATERIALES ELECTRICOS', 's'),
(3, 'CAJAS Y TERMICOS', 's'),
(4, 'HERRAMIENTAS', 's'),
(5, 'LUMINARIA', 's'),
(6, 'TOMAS, PLACAS Y SWITCH', 's'),
(7, 'VARIOS', 's');

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

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `dir`, `dui`, `sexo`, `tel`, `nrc`, `estado`, `tipo`, `email`) VALUES
(2, 'Marcos Antonio Martinez', 'San Cojutepeque', '739274927-9', 'm', '7808-0980', '789797-87', 's', 'contribuyente', ''),
(3, 'Juan Carlos Moz', 'San salvador', '774554554-5', 'm', '7750-7409', '778888-88', 's', 'consumidor', '');

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
  `clase` varchar(12) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `interes` float NOT NULL,
  `cuota` float NOT NULL,
  `to_interes` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contable`
--

INSERT INTO `contable` (`id`, `concepto1`, `concepto2`, `tipo`, `valor`, `fecha`, `hora`, `usu`, `consultorio`, `clase`, `estado`, `interes`, `cuota`, `to_interes`) VALUES
(1, '2', '100000001', 'CXC', '1500', '2018-01-22', '09:34:16', '112233444', '1', '', '', 15, 261.05, 66.3),
(2, '2', '100000007', 'CXP', '900', '2018-01-22', '11:19:33', '112233444', '1', '', '', 0, 0, 0),
(3, '3', '100000002', 'CXC', '2100', '2018-01-22', '11:21:13', '112233444', '1', '', '', 12, 186.58, 138.99),
(4, 'Abono CXC No. 3', 'Sin Observaciones', 'ENTRADA', '165.58', '2018-01-22', '11:22:26', '112233444', '1', 'CXC', '', 0, 0, 0),
(5, 'Abono CXC No. 3', 'Sin Observaciones', 'ENTRADA', '167.2358', '2018-02-26', '11:24:31', '112233444', '1', 'CXC', '', 0, 0, 0),
(6, 'Abono CXP No. 2', 'Sin Observaciones', 'SALIDA', '200', '2018-03-26', '11:26:12', '112233444', '1', 'CXP', '', 0, 0, 0),
(7, 'Compra al "CONTADO"', '100000008', 'SALIDA', '200', '2018-03-26', '11:27:07', '112233444', '1', '', '', 0, 0, 0);

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

--
-- Volcado de datos para la tabla `cotizador_tmp`
--

INSERT INTO `cotizador_tmp` (`id`, `articulo`, `ref`, `cant`, `p_mayor`, `usu`, `descto`) VALUES
(1, '2', '', '1', '', '112233444', 0);

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

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`id`, `factura`, `articulo`, `codigo`, `cantidad`, `valor`, `importe`, `tipo`, `fecha`, `categoria`, `almacen`) VALUES
(1, '100000001', 1, '1', '1', '1000', '1000', 'VENTA', '2018-01-22', 1, 1),
(2, '100000001', 5, '5', '1', '600', '600', 'VENTA', '2018-01-22', 1, 1),
(3, '100000002', 2, '2', '1', '1500', '1500', 'VENTA', '2018-01-22', 1, 1),
(4, '100000002', 8, '8', '1', '700', '700', 'VENTA', '2018-01-22', 1, 1);

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

--
-- Volcado de datos para la tabla `detalle_comp`
--

INSERT INTO `detalle_comp` (`id`, `factura`, `codigo`, `nombre`, `cantidad`, `valor`, `importe`, `tipo`, `fecha`, `categoria`, `almacen`) VALUES
(1, '100000001', '367', 'A00191', '10', '1.36', '13.6', 'COMPRA', '2018-01-21', 1, 1),
(2, '100000002', '355', 'A00185', '1', '2', '2', 'COMPRA', '2018-01-21', 1, 1),
(3, '100000003', '7', '7441102800945', '2', '200', '400', 'COMPRA', '2018-01-22', 1, 1),
(4, '100000006', '8', '7441102800915', '1', '300', '300', 'COMPRA', '2018-01-22', 1, 1),
(5, '100000007', '4', '7441102801011', '1', '900', '900', 'COMPRA', '2018-01-22', 1, 1),
(6, '100000008', '7', '7441102800945', '1', '200', '200', 'COMPRA', '2018-03-26', 1, 1);

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
(1, 'Finaciero el milagro', '0711-270495-101-7', 'San vicente UES-FMP', 'El Salvador', 'San Vicente', '7869-3569', '0000-0000', 'sig.mitienditaonline.net', 'finazas@gamil.com', '2018-01-10', '$', '2014', 16, 270);

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

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `factura`, `valor`, `fecha`, `estado`, `almacen`, `usu`) VALUES
(1, '100000001', '1600', '2018-01-22', 's', 1, '112233444'),
(2, '100000002', '2200', '2018-01-22', 's', 1, '112233444');

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

--
-- Volcado de datos para la tabla `fact_comp`
--

INSERT INTO `fact_comp` (`id`, `factura`, `valor`, `fecha`, `estado`, `almacen`, `usu`) VALUES
(0, '100000001', '13.6', '2018-01-21', 's', 1, '112233444'),
(0, '100000002', '2', '2018-01-21', 's', 1, '112233444'),
(0, '100000003', '400', '2018-01-22', 's', 1, '112233444'),
(0, '100000004', '0', '2018-01-22', 's', 1, '112233444'),
(0, '100000005', '0', '2018-01-22', 's', 1, '112233444'),
(0, '100000006', '300', '2018-01-22', 's', 1, '112233444'),
(0, '100000007', '900', '2018-01-22', 's', 1, '112233444'),
(0, '100000008', '200', '2018-03-26', 's', 1, '112233444');

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

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `almacen`, `articulo`, `codigo`, `stock`, `stock_min`, `pv`, `pmy`, `cat`) VALUES
(1, 1, 1, '7415300005007', '4', '2', '1000', '0', 1),
(2, 1, 2, '7415300005014', '2', '1', '1500', '0', 1),
(3, 1, 3, '7501206652428', '0', '1', '700', '0', 1),
(4, 1, 4, '7441102801011', '8', '1', '1200', '0', 1),
(5, 1, 5, '7441102800960', '7', '1', '600', '0', 1),
(6, 1, 6, '7441102800977', '1', '1', '500', '0', 1),
(7, 1, 7, '7441102800945', '5', '1', '500', '0', 1),
(8, 1, 8, '7441102800915', '4', '1', '700', '0', 1),
(9, 1, 9, '7501206652411', '14', '1', '400', '0', 1),
(10, 1, 10, 'P0001', '7', '1', '200', '0', 2),
(11, 1, 11, '7613023253662', '55', '1', '600', '0', 2),
(12, 1, 12, 'A0001', '20', '1', '400', '0', 2),
(13, 1, 13, 'A0002', '20', '1', '400', '0', 2),
(14, 1, 14, 'A0003', '20', '1', '100', '0', 2);

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

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id`, `factura`, `tipo`, `id_articulo`, `cant`, `costok`, `importe`, `stockk`, `fecha`, `sucursal`, `usu`) VALUES
(1, '100000001', 'VENTA', 1, '1', '900', '900', '4', '2018-01-22', 1, '112233444'),
(2, '100000001', 'VENTA', 5, '1', '500', '500', '7', '2018-01-22', 1, '112233444'),
(3, '100000007', 'COMPRA', 4, '1', '900', '900', '8', '2018-01-22', 1, '112233444'),
(4, '100000002', 'VENTA', 2, '1', '900', '900', '2', '2018-01-22', 1, '112233444'),
(5, '100000002', 'VENTA', 8, '1', '300', '300', '4', '2018-01-22', 1, '112233444'),
(6, '100000008', 'COMPRA', 7, '1', '200', '200', '5', '2018-03-26', 1, '112233444');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(25) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `estado`) VALUES
(1, 'TRIYO', 's'),
(2, 'TRUPER', 's'),
(3, 'AMANCO', 's'),
(4, 'HILTI', 's'),
(5, 'FREUND', 's'),
(6, 'SIEMENS', 's'),
(7, 'RAYOVAC', 's'),
(8, 'USA', 's'),
(9, 'NEWLINK', 's'),
(10, 'LEGRAND', 's'),
(11, 'LEGRAND', 's'),
(12, 'VOLTECH', 's'),
(13, 'GENERAL ELECTRIC', 's'),
(14, 'BROWN', 's'),
(15, 'HERMEX', 's'),
(16, 'BRUNDY', 's'),
(17, 'EMNAYS', 's'),
(18, 'PRETUL', 's'),
(19, 'SURTEX', 's'),
(20, 'SCOTCH 3M', 's'),
(21, 'T4PRO FLEX', 's'),
(22, 'BAND-IT', 's'),
(23, '3M', 's'),
(24, 'TECNO PLASTIC', 's'),
(25, 'FIERO', 's'),
(26, 'SIMPSON', 's'),
(27, 'BTICINO', 's'),
(28, 'TOPAZ', 's'),
(29, 'RAWELT', 's'),
(30, 'LISTED', 's'),
(31, 'THOMAS & BETTS', 's'),
(32, 'DURMAN', 's'),
(33, 'GOLD ELEPHANT', 's'),
(34, 'PHELPS', 's'),
(35, 'EECTRO INDUSTRIAL', 's'),
(36, 'AGUILA', 's'),
(37, 'RAYOVAC', 's'),
(38, 'EYELINIGHT', 's');

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

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre`, `dir`, `tel`, `fax`, `nit`, `nrc`, `contacto`, `email`, `tel_fijo`, `cel`, `estado`) VALUES
(1, 'LG', 'San Salvador', '8908080', '8908080', '808080808-0', '898908-08', '', '', '', '', 's'),
(2, 'Sony', 'La libertad', '2355-5445', '1215-4578', '778845545-4', '122224-44', '', '', '', '', 's'),
(3, 'Claro', 'San Salvador', '4444-4444', '4444-5555', '444444555-5', '445454-44', '', '', '', '', 's'),
(4, 'HP', 'Miramonte, San salvador', '1124-4444', '1122-2222', '112222211-1', '115444-44', '', '', '', '', 's'),
(5, 'Jugue', 'San Vicente', '1112-2222', '1111-1111', '111222222-2', '222255-55', '', '', '', '', 's'),
(6, 'Juego', 'Penal de mariona', '', '', '', '', '', '', '', '', 's'),
(7, 'Mabe', 'Soya City', '1122-2222', '7788-8888', '444444445-5', '445555-55', '', '', '', '', 's');

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

--
-- Volcado de datos para la tabla `pro_prov`
--

INSERT INTO `pro_prov` (`id`, `articulo`, `proveedor`) VALUES
(1, '1', '1'),
(2, '2', '1'),
(3, '3', '3'),
(4, '4', '4'),
(5, '5', '4'),
(6, '6', '4'),
(7, '7', '4'),
(8, '8', '4'),
(9, '9', '2'),
(10, '10', '5'),
(11, '11', '5'),
(12, '12', '5'),
(13, '13', '4'),
(14, '14', '4'),
(15, '15', '5'),
(16, '16', '6'),
(17, '17', '6'),
(18, '18', '6'),
(19, '19', '6'),
(20, '20', '6'),
(21, '21', '2'),
(22, '22', '6'),
(23, '23', '6'),
(24, '24', '5'),
(25, '25', '5'),
(26, '26', '5'),
(27, '27', '5'),
(28, '28', '5'),
(29, '29', '5'),
(30, '30', '5'),
(31, '31', '5'),
(32, '32', '5'),
(33, '33', '5'),
(34, '34', '5'),
(35, '35', '5'),
(36, '36', '5'),
(37, '37', '5'),
(38, '38', '5'),
(39, '39', '2'),
(40, '40', '5'),
(41, '41', '2'),
(42, '42', '2'),
(43, '43', '2'),
(44, '44', '2'),
(45, '45', '2'),
(46, '46', '3'),
(47, '47', '3'),
(48, '48', '5'),
(49, '49', '5'),
(50, '50', '5'),
(51, '51', '5'),
(52, '52', '5'),
(53, '53', '3'),
(54, '54', '3'),
(55, '55', '5'),
(56, '56', '5'),
(57, '57', '5'),
(58, '58', '5'),
(59, '59', '5'),
(60, '60', '5'),
(61, '61', '5'),
(62, '62', '3'),
(63, '63', '1'),
(64, '64', '3'),
(65, '65', '3'),
(66, '66', '3'),
(67, '67', '3'),
(68, '68', '5'),
(69, '69', '5'),
(70, '70', '5'),
(71, '71', '5'),
(72, '72', '3'),
(73, '73', '3'),
(74, '74', '3'),
(75, '75', '3'),
(76, '76', '3'),
(77, '77', '3'),
(78, '78', '3'),
(79, '79', '3'),
(80, '80', '5'),
(81, '81', '4'),
(82, '82', '4'),
(83, '83', '4'),
(84, '84', '5'),
(85, '85', '5'),
(86, '86', '5'),
(87, '87', '5'),
(88, '88', '5'),
(89, '89', '5'),
(90, '90', '5'),
(91, '91', '5'),
(92, '92', '5'),
(93, '93', '5'),
(94, '94', '5'),
(95, '95', '5'),
(96, '96', '5'),
(97, '97', '5'),
(98, '98', '5'),
(99, '99', '5'),
(100, '100', '5'),
(101, '101', '5'),
(102, '102', '5'),
(103, '103', '5'),
(104, '104', '3'),
(105, '105', '5'),
(106, '106', '2'),
(107, '107', '5'),
(108, '108', '4'),
(109, '109', '7'),
(110, '110', '5'),
(111, '111', '3'),
(112, '112', '3'),
(113, '113', '5'),
(114, '114', '5'),
(115, '115', '3'),
(116, '116', '3'),
(117, '117', ''),
(118, '118', '3'),
(119, '119', '3'),
(120, '120', '9'),
(121, '121', '5'),
(122, '122', '4'),
(123, '123', '5'),
(124, '124', '5'),
(125, '125', ''),
(126, '126', '5'),
(127, '127', '4'),
(128, '128', '4'),
(129, '129', '4'),
(130, '130', '4'),
(131, '131', '4'),
(132, '132', '4'),
(133, '133', '4'),
(134, '134', '10'),
(135, '135', '9'),
(136, '136', '5'),
(137, '137', '5'),
(138, '138', '5'),
(139, '139', '9'),
(140, '140', '4'),
(141, '141', '4'),
(142, '142', '4'),
(143, '143', '10'),
(144, '144', '10'),
(145, '145', '4'),
(146, '146', '4'),
(147, '147', '4'),
(148, '148', '4'),
(149, '149', '6'),
(150, '150', '6'),
(151, '151', '5'),
(152, '152', '6'),
(153, '153', '6'),
(154, '154', '6'),
(155, '155', '5'),
(156, '156', '5'),
(157, '157', '5'),
(158, '158', '5'),
(159, '159', '5'),
(160, '160', '5'),
(161, '161', '5'),
(162, '162', '5'),
(163, '163', '5'),
(164, '164', '5'),
(165, '165', '5'),
(166, '166', '5'),
(167, '167', '5'),
(168, '168', '5'),
(169, '169', '5'),
(170, '170', '5'),
(171, '171', '5'),
(172, '172', '5'),
(173, '173', '5'),
(174, '174', '2'),
(175, '175', '5'),
(176, '176', '2'),
(177, '177', '5'),
(178, '178', '5'),
(179, '179', '5'),
(180, '180', '2'),
(181, '181', '5'),
(182, '182', '3'),
(183, '183', '5'),
(184, '184', '5'),
(185, '185', ''),
(186, '186', '6'),
(187, '187', '6'),
(188, '188', '11'),
(189, '189', '5'),
(190, '190', '5'),
(191, '191', '5'),
(192, '192', '3'),
(193, '193', '3'),
(194, '194', '3'),
(195, '195', '3'),
(196, '196', '3'),
(197, '197', '3'),
(198, '198', '3'),
(199, '199', '3'),
(200, '200', '3'),
(201, '201', '3'),
(202, '202', '3'),
(203, '203', '3'),
(204, '204', '3'),
(205, '205', '4'),
(206, '206', '3'),
(207, '207', '3'),
(208, '208', '3'),
(209, '209', '3'),
(210, '210', '3'),
(211, '211', '5'),
(212, '212', '6'),
(213, '213', '5'),
(214, '214', '5'),
(215, '215', '5'),
(216, '216', '5'),
(217, '217', '12'),
(218, '218', '1'),
(219, '219', '4'),
(220, '220', '5'),
(221, '221', '5'),
(222, '222', '5'),
(223, '223', '5'),
(224, '224', '5'),
(225, '225', '5'),
(226, '226', '5'),
(227, '227', '5'),
(228, '228', '5'),
(229, '229', '5'),
(230, '230', '5'),
(231, '231', '5'),
(232, '232', '5'),
(233, '233', '5'),
(234, '234', '5'),
(235, '235', '5'),
(236, '236', '5'),
(237, '237', '5'),
(238, '238', '5'),
(239, '239', '3'),
(240, '240', '3'),
(241, '241', '6'),
(242, '242', '5'),
(243, '243', '3'),
(244, '244', '3'),
(245, '245', '3'),
(246, '246', '5'),
(247, '247', '5'),
(248, '248', '5'),
(249, '249', '3'),
(250, '250', '3'),
(251, '251', '5'),
(252, '252', '3'),
(253, '253', '3'),
(254, '254', '3'),
(255, '255', '3'),
(256, '256', '3'),
(257, '257', '3'),
(258, '258', '3'),
(259, '259', '3'),
(260, '260', '3'),
(261, '261', '3'),
(262, '262', '5'),
(263, '263', '4'),
(264, '264', '4'),
(265, '265', '4'),
(266, '266', '10'),
(267, '267', '4'),
(268, '268', '5'),
(269, '269', '3'),
(270, '270', '5'),
(271, '271', '5'),
(272, '272', '5'),
(273, '273', '4'),
(274, '274', '4'),
(275, '275', '6'),
(276, '276', '6'),
(277, '277', '6'),
(278, '278', '6'),
(279, '279', '6'),
(280, '280', '6'),
(281, '281', '6'),
(282, '282', '6'),
(283, '283', '6'),
(284, '284', '6'),
(285, '285', '6'),
(286, '286', '6'),
(287, '287', '6'),
(288, '288', '5'),
(289, '289', '5'),
(290, '290', '5'),
(291, '291', '5'),
(292, '292', '5'),
(293, '293', '5'),
(294, '294', '5'),
(295, '295', '5'),
(296, '296', '5'),
(297, '297', '5'),
(298, '298', '5'),
(299, '299', '5'),
(300, '300', '5'),
(301, '301', '5'),
(302, '302', '2'),
(303, '303', '5'),
(304, '304', '5'),
(305, '305', '2'),
(306, '306', '2'),
(307, '307', '5'),
(308, '308', '5'),
(309, '309', '2'),
(310, '310', '5'),
(311, '311', '2'),
(312, '312', '5'),
(313, '313', '5'),
(314, '314', '2'),
(315, '315', '5'),
(316, '316', '5'),
(317, '317', '5'),
(318, '318', '5'),
(319, '319', '5'),
(320, '320', '2'),
(321, '321', '5'),
(322, '322', '4'),
(323, '323', '4'),
(324, '324', '5'),
(325, '325', '2'),
(326, '326', '2'),
(327, '327', '2'),
(328, '328', '5'),
(329, '329', '5'),
(330, '330', '5'),
(331, '331', '5'),
(332, '332', '5'),
(333, '333', '5'),
(334, '334', '5'),
(335, '335', '5'),
(336, '336', '5'),
(337, '337', '5'),
(338, '338', '5'),
(339, '339', '5'),
(340, '340', '5'),
(341, '341', '5'),
(342, '342', '5'),
(343, '343', '5'),
(344, '344', '5'),
(345, '345', '5'),
(346, '346', '5'),
(347, '347', '5'),
(348, '348', '5'),
(349, '349', '5'),
(350, '350', '5'),
(351, '351', '5'),
(352, '352', '5'),
(353, '353', '4'),
(354, '354', '5'),
(355, '355', '5'),
(356, '356', '4'),
(357, '357', '4'),
(358, '358', '4'),
(359, '359', '4'),
(360, '360', '4'),
(361, '361', '5'),
(362, '362', '5'),
(363, '363', '5'),
(364, '364', '5'),
(365, '365', '5'),
(366, '366', '5'),
(367, '367', '5'),
(368, '368', '5'),
(369, '369', '5'),
(370, '370', '5'),
(371, '372', '2'),
(372, '371', '1');

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

--
-- Volcado de datos para la tabla `resumen`
--

INSERT INTO `resumen` (`id`, `cliente`, `concepto`, `factura`, `clase`, `valor`, `tipo`, `fecha`, `hora`, `status`, `usu`, `almacen`, `estado`) VALUES
(1, '2', 'Venta al "CREDITO"', '100000001', 'VENTA', '1600', 'VENTA', '2018-01-22', '09:34:16', 'CREDITO', '112233444', 1, 's'),
(2, '3', 'Venta al "CREDITO"', '100000002', 'VENTA', '2200', 'VENTA', '2018-01-22', '11:21:13', 'CREDITO', '112233444', 1, 's');

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

--
-- Volcado de datos para la tabla `resumen_comp`
--

INSERT INTO `resumen_comp` (`id`, `proveedor`, `concepto`, `factura`, `clase`, `valor`, `tipo`, `fecha`, `hora`, `status`, `usu`, `almacen`, `estado`) VALUES
(3, '2', 'Compra al "CONTADO"', '100000003', 'COMPRA', '400', 'COMPRA', '2018-01-22', '09:12:22', 'CONTADO', '112233444', 1, 's'),
(6, '2', 'Compra al "CONTADO"', '100000006', 'COMPRA', '300', 'COMPRA', '2018-01-22', '09:12:57', 'CONTADO', '112233444', 1, 's'),
(7, '2', 'Compra al "CREDITO"', '100000007', 'COMPRA', '900', 'COMPRA', '2018-01-22', '11:19:33', 'CREDITO', '112233444', 1, 's'),
(8, '2', 'Compra al "CONTADO"', '100000008', 'COMPRA', '200', 'COMPRA', '2018-03-26', '11:27:07', 'CONTADO', '112233444', 1, 's');

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

--
-- Volcado de datos para la tabla `resumen_ticket`
--

INSERT INTO `resumen_ticket` (`id`, `cliente`, `concepto`, `factura`, `clase`, `valor`, `tipo`, `fecha`, `hora`, `status`, `usu`, `almacen`, `estado`) VALUES
(1, '', 'Venta al "CREDITO"', '00000001', 'VENTA', '151', 'VENTA', '2017-12-27', '14:36:35', 'CREDITO', '112233444', 1, 's'),
(2, '', 'Venta al "CREDITO"', '', 'VENTA', '151', 'VENTA', '2017-12-27', '14:36:36', 'CREDITO', '112233444', 1, 's'),
(3, '', 'Venta al "CREDITO"', '', 'VENTA', '151', 'VENTA', '2017-12-27', '14:36:36', 'CREDITO', '112233444', 1, 's'),
(4, '', 'Venta al "CREDITO"', '', 'VENTA', '151', 'VENTA', '2017-12-27', '14:36:36', 'CREDITO', '112233444', 1, 's'),
(5, '', 'Venta al "CREDITO"', '', 'VENTA', '151', 'VENTA', '2017-12-27', '14:36:36', 'CREDITO', '112233444', 1, 's'),
(6, '', 'Venta al "CREDITO"', '00000006', 'VENTA', '17.5', 'VENTA', '2018-01-19', '20:47:35', 'CREDITO', '112233444', 1, 's'),
(7, '', 'Venta al "CREDITO"', '', 'VENTA', '17.5', 'VENTA', '2018-01-19', '20:51:08', 'CREDITO', '112233444', 1, 's'),
(8, '3', 'Venta al "CREDITO"', '00000008', 'VENTA', '151', 'VENTA', '2018-01-19', '21:16:49', 'CREDITO', '112233444', 1, 's'),
(9, '3', 'Venta al "CREDITO"', '00000001', 'VENTA', '302', 'VENTA', '2018-02-28', '14:54:34', 'CREDITO', '112233444', 1, 's'),
(10, '', 'Venta al "CREDITO"', '', 'VENTA', '302', 'VENTA', '2018-02-28', '15:03:49', 'CREDITO', '112233444', 1, 's'),
(11, '3', 'Venta al "CREDITO"', '00000003', 'VENTA', '300', 'VENTA', '2018-02-28', '15:04:21', 'CREDITO', '112233444', 1, 's');

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

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `ticket`, `valor`, `fecha`, `estado`, `almacen`, `usu`) VALUES
(1, '00000001', '302', '2018-02-28', 's', 1, '112233444'),
(2, '', '0', '2018-02-28', 's', 1, '112233444'),
(3, '00000003', '300', '2018-02-28', 's', 1, '112233444');

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

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `nombre`, `estado`) VALUES
(1, 'UNIDAD', 's'),
(2, 'UNIDADES', 's'),
(3, 'LIBRAS', 's'),
(4, 'BLISTER', 's'),
(5, 'YARDAS', 's'),
(6, 'METROS', 's'),
(7, 'PARES', 's'),
(8, 'CAJA', 's');

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
(1, '112233444', 'admin', 'ADMINISTRADOR', 'Administrador', 'Ninguna', 0, 's', 'Admin', '1');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `cajacom_tmp`
--
ALTER TABLE `cajacom_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `cajac_tmp`
--
ALTER TABLE `cajac_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caja_tmp`
--
ALTER TABLE `caja_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `cliente_tmp`
--
ALTER TABLE `cliente_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contable`
--
ALTER TABLE `contable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `cotizador_tmp`
--
ALTER TABLE `cotizador_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `desc_tmp`
--
ALTER TABLE `desc_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `detalle_comp`
--
ALTER TABLE `detalle_comp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `fact_cot`
--
ALTER TABLE `fact_cot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `pro_prov`
--
ALTER TABLE `pro_prov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;
--
-- AUTO_INCREMENT de la tabla `resumen`
--
ALTER TABLE `resumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `resumen_comp`
--
ALTER TABLE `resumen_comp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `resumen_ticket`
--
ALTER TABLE `resumen_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
