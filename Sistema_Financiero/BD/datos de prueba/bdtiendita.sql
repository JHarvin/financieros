-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2017 a las 07:11:08
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

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `codigo`, `nombre`, `detalle`, `cat`, `und`, `valor`, `modelo`, `estante`, `marca`, `estado`, `inv`, `prov`, `iva`) VALUES
(1, '7415300005007', 'Aceite Para Maquina 30 ml ', '', 1, 1, '1.21', '', '', 'Triyo', 's', 'ok', 'ok', 's'),
(2, '7415300005014', 'Aceite Para Maquina 90 ml ', '', 1, 1, '1.57', '', '', 'Triyo', 's', 'ok', 'ok', 's'),
(3, '7501206652428', 'Adaptador Hembra para Manguera de 1/2', '', 1, 1, '0.79', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(4, '7441102801011', 'Adaptador Macho de PVC de 3\"', '', 1, 2, '1.15', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(5, '7441102800960', 'Adaptador Macho de PVC 1\"', '', 1, 2, '0.55', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(6, '7441102800977', 'Adaptador Macho de PVC de 1 1/4\"', '', 1, 2, '0.75', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(7, '7441102800945', 'Adaptador Macho de PVC de 3/4\"', '', 1, 2, '0.23', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(8, '7441102800915', 'Adaptador Macho de PVC de 4\"', '', 1, 2, '2', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(9, '7501206652411', 'Adaptador Macho para Manguera de 1/2', '', 1, 1, '0.67', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(10, 'P0001', 'Alambre Galvanizado # 16', '', 2, 3, '0.6', '', '', '', 's', 'ok', 'ok', 's'),
(11, '7613023253662', 'Anclas HILTI de 3/8 ', '', 2, 1, '0.53', '', '', 'Hilti ', 's', 'ok', 'ok', 's'),
(12, 'A0001', 'Anclas Amarillas ', '', 2, 1, '0.01', '', '', '', 's', 'ok', 'ok', 's'),
(13, 'A0002', 'Anclas Azul Grandes ', '', 2, 1, '0.1', '', '', 'Freund ', 's', 'ok', 'ok', 's'),
(14, 'A0003', 'Anclas Azul Peque?os ', '', 2, 1, '0.08', '', '', 'Freund ', 's', 'ok', 'ok', 's'),
(15, 'A0004', 'Bases de 2 salidas para Socket Anodizado', '', 1, 2, '1.25', '', '', '', 's', 'ok', 'ok', 's'),
(16, 'A0005', 'Bimetal de 4 - 6.3', '', 2, 2, '15', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(17, 'A0006', 'Bimetal de 1.6 - 2.5', '', 2, 2, '15', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(18, 'A0007', 'Bimetal de 10 - 16', '', 2, 2, '18', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(19, 'A0008', 'Bimetal de 2.5 - 4', '', 2, 2, '15', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(20, 'A0009', 'Bimetal de 50 - 63', '', 2, 2, '45', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(21, '1280018093', 'Bateria Alcalina AAx2', '', 1, 4, '1.61', '', '', 'Rayovac ', 's', 'ok', 'ok', 's'),
(22, 'A00010', 'Bobina para Contactor Siemens A 110V', '', 2, 2, '10.86', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(23, 'A00011', 'Bobina para Contactor Siemens A 220V', '', 2, 2, '10.86', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(24, '7501206675328', 'Broca conica de 1 1/16\"', '', 4, 2, '3', '', '', 'Trupper', 's', 'ok', 'ok', 's'),
(25, '7501206675212', 'Broca conica de 1 1/4\"', '', 4, 2, '5', '', '', 'Trupper', 's', 'ok', 'ok', 's'),
(26, '7501206675229', 'Broca conica de 1 3/8\"', '', 4, 2, '5', '', '', 'Trupper', 's', 'ok', 'ok', 's'),
(27, '7501206675199', 'Broca conica de 1\"', '', 4, 2, '3', '', '', 'Trupper', 's', 'ok', 'ok', 's'),
(28, 'A00012', 'Bushing conduit de 1 1/4\"', '', 1, 2, '0.38', '', '', '', 's', 'ok', 'ok', 's'),
(29, 'A00013', 'Bushing Conduit de 3\"', '', 1, 2, '1.15', '', '', '', 's', 'ok', 'ok', 's'),
(30, 'A00014', 'Bushings conduit de 1 1/2\"', '', 1, 2, '0.38', '', '', '', 's', 'ok', 'ok', 's'),
(31, 'A00015', 'Bushings conduit de 1\"', '', 1, 2, '0.4', '', '', '', 's', 'ok', 'ok', 's'),
(32, 'A00016', 'Bushings conduit de 1/2\"', '', 1, 2, '0.1', '', '', '', 's', 'ok', 'ok', 's'),
(33, 'A00017', 'Bushings conduit de 2\"', '', 1, 2, '0.45', '', '', '', 's', 'ok', 'ok', 's'),
(34, 'A00018', 'Bushings Conduit de 3/4\"', '', 1, 2, '0.3', '', '', '', 's', 'ok', 'ok', 's'),
(35, 'A00019', 'Cable Coaxial RG-60', '', 2, 5, '0.25', '', '', 'USA', 's', 'ok', 'ok', 's'),
(36, 'A00020', 'Cable UTP categoria 5E', '', 2, 6, '0.28', '', '', 'NEWLINK', 's', 'ok', 'ok', 's'),
(37, '3245060920524', 'Caja 920-52 Legrand', '', 3, 2, '18.08', '', '', 'Legrand', 's', 'ok', 'ok', 's'),
(38, '3245060920623', 'Caja 920-62 Legrand', '', 3, 2, '24', '', '', 'Legrand', 's', 'ok', 'ok', 's'),
(39, '7501206697931', 'Caja Rectangular ', '', 3, 1, '0.3', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(40, '783164414332', 'Caja Termica de 2 Circuitos 40 Amp', '', 3, 2, '12.53', '', '', 'General Electric', 's', 'ok', 'ok', 's'),
(41, '7501206658338', 'Cajas Octagonal Metalica', '', 3, 1, '0.73', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(42, '7501206658253', 'Calabera Blanca ', '', 1, 1, '0.68', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(43, '7501206658222', 'Calabera Caf?o', '', 1, 1, '0.68', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(44, '638110069398', 'Candado de 1 1/2 ', '', 1, 1, '2.8', '', '', 'Brown ', 's', 'ok', 'ok', 's'),
(45, '7501206663141', 'Candado de 30 mm ', '', 1, 1, '1.13', '', '', 'Hermex ', 's', 'ok', 'ok', 's'),
(46, '7501206663103', 'Candado de 40 mm ', '', 1, 1, '1.47', '', '', 'Hermex ', 's', 'ok', 'ok', 's'),
(47, '7501206663110', 'Candado de 50 mm ', '', 1, 1, '2.38', '', '', 'Hermex ', 's', 'ok', 'ok', 's'),
(48, '7501206688922', 'Cartucho para Mascarilla (Respirador)', '', 4, 1, '1.55', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(49, 'A00021', 'Cepos para Barra Coperwell 5/8\"', '', 2, 2, '0.89', '', '', '', 's', 'ok', 'ok', 's'),
(50, 'A00022', 'Chicle # 4', '', 2, 1, '2.1', '', '', 'Brundy ', 's', 'ok', 'ok', 's'),
(51, 'A00023', 'Chicles # 2 ', '', 2, 1, '1.13', '', '', 'Brundy ', 's', 'ok', 'ok', 's'),
(52, 'A00024', 'Chicles Peque?os para contadores ', '', 2, 1, '0.5', '', '', 'Emnays', 's', 'ok', 'ok', 's'),
(53, '7501206652305', 'Chuchitos Grandes para Bateria de carro', '', 1, 7, '1.35', '', '', 'Pretul ', 's', 'ok', 'ok', 's'),
(54, 'A00025', 'Cincho para Electricista ', '', 4, 1, '9.25', '', '', '', 's', 'ok', 'ok', 's'),
(55, 'A00026', 'Cinchos Negros de Velcro ', '', 1, 1, '0.3', '', '', '', 's', 'ok', 'ok', 's'),
(56, 'A00027', 'Cinchos Plasticos Amarillos Peque?os ', '', 1, 1, '0.03', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(57, 'A00028', 'Cinchos Plasticos verdes Peque?os ', '', 1, 1, '0.03', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(58, 'A00029', 'Cinchos Plasticos azules peque?os', '', 1, 1, '0.03', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(59, 'A00030', 'Cinchos Plasticos blancos Grande', '', 1, 1, '0.05', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(60, 'A00031', 'Cinchos Plasticos Negro Grande', '', 1, 1, '0.05', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(61, 'A00032', 'Cinchos Plasticos Rojos Peque?os', '', 1, 1, '0.03', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(62, 'A00033', 'Cinta Teflon 3/4 x 13m', '', 1, 1, '0.75', '', '', 'Surtex', 's', 'ok', 'ok', 's'),
(63, '21200518881', 'Cinta Adhesiva Transparente ', '', 1, 1, '0.68', '', '', 'Scotch 3M ', 's', 'ok', 'ok', 's'),
(64, '7501206640029', 'Cinta Adhesiva Transparente 48x50 m ', '', 1, 1, '0.6', '', '', 'truper ', 's', 'ok', 'ok', 's'),
(65, 'A00034', 'Cinta Aislante Amarilla', '', 2, 1, '0.28', '', '', 'T4pro flex', 's', 'ok', 'ok', 's'),
(66, '7501206646830', 'Cinta Aislante Negra de 10 Yds', '', 2, 1, '0.28', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(67, '7501206644911', 'Cinta Aislante Negra de 20 Yds', '', 2, 1, '0.6', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(68, 'A00035', 'Cinta BAND-IT 30.5 Mts', '', 2, 8, '37.82', '', '', 'BAND-IT.', 's', 'ok', 'ok', 's'),
(69, '54007156031', 'Cinta de Hule # 70', '', 2, 1, '10.2', '', '', '3M', 's', 'ok', 'ok', 's'),
(70, '54007150176', 'Cinta de Hule # 13', '', 2, 1, '4.5', '', '', '3M', 's', 'ok', 'ok', 's'),
(71, '54007150251', 'Cinta de Hule # 23', '', 2, 1, '10.2', '', '', '3M', 's', 'ok', 'ok', 's'),
(72, '7501206624524', 'Cinta Metrica de 3M Profesional', '', 4, 1, '1.13', '', '', 'Pretul ', 's', 'ok', 'ok', 's'),
(73, '7501206624517', 'Cinta Metrica de 5M Profesional', '', 4, 1, '2.65', '', '', 'Pretul ', 's', 'ok', 'ok', 's'),
(74, '7501206624425', 'Cinta Metrica de 8M Profesional', '', 4, 1, '3.61', '', '', 'Pretul ', 's', 'ok', 'ok', 's'),
(75, '7501206641675', 'Cinta Teflon 1/2 x 7m', '', 1, 1, '0.23', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(76, 'A00036', 'Cinta Teflon 3/4 x 12m', '', 1, 1, '0.75', '', '', 'Tecno Plastic', 's', 'ok', 'ok', 's'),
(77, '7501206693681', 'Clavo de Acero de 1\"', '', 1, 1, '0.02', '', '', 'Fiero ', 's', 'ok', 'ok', 's'),
(78, '7501206665442', 'Clavo de Acero de 2 1/2 \"', '', 1, 1, '0.03', '', '', 'Fiero ', 's', 'ok', 'ok', 's'),
(79, '27501206696976', 'Clavo Est?ndar con Cabeza 2 1/2', '', 1, 3, '0.61', '', '', 'Fiero ', 's', 'ok', 'ok', 's'),
(80, '739272741', 'Clavos Simpson ', '', 1, 1, '0.11', '', '', 'Simpson', 's', 'ok', 'ok', 's'),
(81, '7441102800137', 'Codo de PVC de 1 1/4\"', '', 1, 2, '0.9', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(82, '7441102800113', 'Codo de PVC de 1\"', '', 1, 2, '0.75', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(83, '7441102800175', 'Codo de PVC de 3/4\"', '', 1, 2, '0.75', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(84, 'A00037', 'Conectador MT de tornillo 1 1/4\"', '', 1, 2, '2.09', '', '', '', 's', 'ok', 'ok', 's'),
(85, 'A00038', 'Conectador MT de tornillo 1/2\"', '', 1, 2, '0.28', '', '', '', 's', 'ok', 'ok', 's'),
(86, 'A00039', 'Conectador para Coraza LT de 1 1/2\"', '', 1, 2, '1.5', '', '', '', 's', 'ok', 'ok', 's'),
(87, 'A00040', 'Conectador para Coraza LT de 1 1/4\"', '', 1, 2, '1.5', '', '', '', 's', 'ok', 'ok', 's'),
(88, 'A00041', 'Conectador Para coraza LT de 3/4\"', '', 1, 2, '1.15', '', '', '', 's', 'ok', 'ok', 's'),
(89, '1331212032', 'Conector MT de Tornillo de 1 1/2\"', '', 1, 2, '2.5', '', '', '', 's', 'ok', 'ok', 's'),
(90, '7441102801929', 'conector PVC de 1/2', '', 1, 1, '0.25', '', '', 'Amanco ', 's', 'ok', 'ok', 's'),
(91, 'A00042', 'Conector Recto de 1\"', '', 1, 2, '1.29', '', '', '', 's', 'ok', 'ok', 's'),
(92, 'A00043', 'Conector Recto de 3/4\"', '', 1, 2, '0.49', '', '', '', 's', 'ok', 'ok', 's'),
(93, 'A00044', 'Conector Recto de 3/8\"', '', 1, 2, '0.23', '', '', '', 's', 'ok', 'ok', 's'),
(94, '8012199638188', 'Conector RJ 45 categoria 6', '', 1, 2, '9.14', '', '', 'BTICINO', 's', 'ok', 'ok', 's'),
(95, 'A00045', 'Cuerpo LB 1 1/4\" ', '', 2, 2, '7.25', '', '', '', 's', 'ok', 'ok', 's'),
(96, 'A00046', 'Cuerpo Terminal de 1 1/2\"', '', 2, 2, '3.33', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(97, 'A00047', 'Cuerpos LB de 1\"', '', 2, 2, '3.71', '', '', 'Rawelt', 's', 'ok', 'ok', 's'),
(98, 'A00048', 'Cuerpos LB de 1 1/2\"', '', 2, 2, '7.96', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(99, 'A00049', 'Cuerpos LB de 1/2\"', '', 2, 2, '1.94', '', '', 'Listed', 's', 'ok', 'ok', 's'),
(100, 'A00050', 'Cuerpos LB de 3/4\"', '', 2, 2, '2.87', '', '', 'Listed', 's', 'ok', 'ok', 's'),
(101, 'A00051', 'Curvas Conduit de 1\"', '', 1, 2, '3.56', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(102, 'A00052', 'Curvas Conduit de 1/2\"', '', 1, 2, '2.5', '', '', 'Thomas & Betts', 's', 'ok', 'ok', 's'),
(103, 'A00053', 'Curvas Conduit de PVC de 1 1/4\"', '', 1, 2, '0.5', '', '', 'DURMAN', 's', 'ok', 'ok', 's'),
(104, '7501206625378', 'Desarmadores Planos', '', 4, 1, '2.36', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(105, '6932548825019', 'Disco para Hierro A30 TBF', '', 4, 1, '2.15', '', '', 'Gold Elephant ', 's', 'ok', 'ok', 's'),
(106, 'A00054', 'Desarmadores PHILIPS', '', 4, 2, '2.36', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(107, '8464461310', 'Duplex SPT-18', '', 2, 5, '0.29', '', '', 'PHELPS', 's', 'ok', 'ok', 's'),
(108, 'A00055', 'Escuadra para repisa 5X6\"', '', 1, 2, '1.75', '', '', '', 's', 'ok', 'ok', 's'),
(109, 'A00056', 'Extension con foco de 15 Yds.', '', 2, 1, '12.6', '', '', 'Eectro Industrial', 's', 'ok', 'ok', 's'),
(110, 'A00057', 'Extension para Telefono ', '', 2, 1, '0.9', '', '', '', 's', 'ok', 'ok', 's'),
(111, '7501206663493', 'Extension de 2m de 3 Contactos 16 Awg ', '', 2, 1, '1.86', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(112, '7501206663615', 'Extension de 6m de 3 Contactos 16 Awg ', '', 2, 1, '4.4', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(113, 'A00058', 'Extension de Gravadora tipo ocho ', '', 2, 1, '0.9', '', '', '', 's', 'ok', 'ok', 's'),
(114, 'A00059', 'Extension de Plancha ', '', 2, 1, '1.87', '', '', 'Aguila ', 's', 'ok', 'ok', 's'),
(115, '7501206663769', 'Extension Electrica de 15m ', '', 2, 1, '11.18', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(116, '7501206690994', 'Foco de Alta potencia 235W 220 V', '', 5, 1, '10.45', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(117, '4001780187085', 'Foco Ahorrador CFL de 23 Watts Luz Amarilla', '', 5, 1, '2.75', '', '', 'Feit Electric', 's', 'ok', 'ok', 's'),
(118, '7501206663400', 'Foco Ahorrador de 15W Luz Blanca', '', 5, 1, '2.23', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(119, '7501206663417', 'Foco Ahorrador de 20W Luz Blanca', '', 5, 1, '2.44', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(120, '78309406037', 'Foco Ahorrador de 23W 127V Luz Blanca', '', 5, 1, '2.48', '', '', 'Rayovac ', 's', 'ok', 'ok', 's'),
(121, '7894400900007', 'Foco de 160 watts 220-230 V Blanco ', '', 5, 1, '6.67', '', '', 'Philips ', 's', 'ok', 'ok', 's'),
(122, 'A00060', 'Foco de 25W de color Amarillo', '', 5, 1, '0.68', '', '', 'Philips ', 's', 'ok', 'ok', 's'),
(123, 'A00061', 'Foco de Mercurio 250 watts ', '', 5, 1, '14.36', '', '', 'Eyelinight', 's', 'ok', 'ok', 's'),
(124, 'A00062', 'Foco Haluro Metalico 250 watts ', '', 5, 1, '14.36', '', '', 'Sylvania ', 's', 'ok', 'ok', 's'),
(125, 'A00063', 'Foco Led Luz Blanca Light de 9W', '', 5, 1, '2.11', '', '', 'Led bulb light', 's', 'ok', 'ok', 's'),
(126, '7894400900038', 'Foco ML-250 watts 220-230 V blanco ', '', 5, 1, '14.36', '', '', 'Philips ', 's', 'ok', 'ok', 's'),
(127, 'A00064', 'Focos Chilito de 60W 130V Rosca Normal Luz Blanca ', '', 5, 1, '0.85', '', '', '', 's', 'ok', 'ok', 's'),
(128, 'A00065', 'Focos Chilito de 7Watts 127V Color Anaranjado ', '', 5, 1, '0.24', '', '', '', 's', 'ok', 'ok', 's'),
(129, 'A00066', 'Focos Chilitos de 7Watts 127V C olor Rojo', '', 5, 1, '0.24', '', '', '', 's', 'ok', 'ok', 's'),
(130, 'A00067', 'Focos Chilitos de 7Watts 127V Color Azul', '', 5, 1, '0.24', '', '', '', 's', 'ok', 'ok', 's'),
(131, 'A00068', 'Focos Chilitos de 7Watts 127V Color Amarillo', '', 5, 1, '0.24', '', '', '', 's', 'ok', 'ok', 's'),
(132, 'A00069', 'Focos Chilitos de 7Watts 127V Color Verde', '', 5, 1, '0.24', '', '', '', 's', 'ok', 'ok', 's'),
(133, '756902096802121', 'Focos de Refrigeradora T20 -127V', '', 5, 1, '0.77', '', '', 'CondiLihgt', 's', 'ok', 'ok', 's'),
(134, '7702081007000', 'Focos de 100W del Corriente', '', 5, 1, '0.43', '', '', 'Philips ', 's', 'ok', 'ok', 's'),
(135, '8309406025', 'Focos de 15W Ahorrador Luz Blanca', '', 5, 1, '2.18', '', '', 'Rayovac ', 's', 'ok', 'ok', 's'),
(136, '7702048386858', 'Focos de 15W Ahorrador Spiral color Rojo', '', 5, 1, '4.83', '', '', 'Sylvania ', 's', 'ok', 'ok', 's'),
(137, '7702048386871', 'Focos de 15W Ahorrador Spiral color Amarillo', '', 5, 1, '4.83', '', '', 'Sylvania ', 's', 'ok', 'ok', 's'),
(138, '7702048386872', 'Focos de 15W Ahorrador Spiral color Azul', '', 5, 1, '4.83', '', '', 'Sylvania ', 's', 'ok', 'ok', 's'),
(139, '8309406029', 'Focos de 20W Ahorrador Luz Blanca', '', 5, 1, '2.39', '', '', 'Rayovac ', 's', 'ok', 'ok', 's'),
(140, '7453001117642', 'Focos de 25W de color Amarillo', '', 5, 1, '0.68', '', '', 'Best Value', 's', 'ok', 'ok', 's'),
(141, '7453001117643', 'Focos de 25W de color Rojo', '', 5, 1, '0.68', '', '', 'Best Value', 's', 'ok', 'ok', 's'),
(142, 'A00070', 'Focos de 25W de color Rojo', '', 5, 1, '0.68', '', '', 'Philips ', 's', 'ok', 'ok', 's'),
(143, '7702081003019', 'focos de 40W del Corriente', '', 5, 1, '0.43', '', '', 'Philips ', 's', 'ok', 'ok', 's'),
(144, '7702081004009', 'Focos de 60 W del Corriente', '', 5, 1, '0.43', '', '', 'Philips ', 's', 'ok', 'ok', 's'),
(145, '7453001115359', 'Focos Incandescentes de 7.5 Watts Color Rojo ', '', 5, 1, '0.68', '', '', 'Best Value', 's', 'ok', 'ok', 's'),
(146, '7453001115373', 'Focos Incandescentes de 7.5 Watts Color Verde ', '', 5, 1, '0.68', '', '', 'Best Value', 's', 'ok', 'ok', 's'),
(147, 'A00071', 'Focos para Lampara decorativa Tipo Lagrima 40W -120V', '', 5, 1, '0.85', '', '', '', 's', 'ok', 'ok', 's'),
(148, 'A00072', 'Focos para Lampara decorativa Tipo Lagrima 60W -120V', '', 5, 1, '0.85', '', '', '', 's', 'ok', 'ok', 's'),
(149, 'A00073', 'Focos para Tablero DE 110V', '', 5, 2, '5', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(150, 'A00074', 'Focos para Tablero DE 220V', '', 5, 2, '5', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(151, 'A00075', 'Fuibles de Alta Tension de 10 AMP', '', 2, 2, '2.87', '', '', 'Luhfser', 's', 'ok', 'ok', 's'),
(152, 'A00076', 'Fusibles Amp-Diazed 16 A 500 V', '', 2, 1, '1.2', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(153, 'A00077', 'Fusibles Amp-Diazed 25 A 500 V', '', 2, 1, '1.4', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(154, 'A00078', 'Fusibles Amp-Diazed 35 A 500 V', '', 2, 1, '1.75', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(155, 'A00079', 'Fusibles de alta tension de 2 AMP', '', 2, 2, '2.78', '', '', 'Chance', 's', 'ok', 'ok', 's'),
(156, 'A00080', 'Grapa Strup Uiversal de 1\" Con Tornillo', '', 1, 2, '0.45', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(157, 'A00081', 'Grapa Strup Uneversal de 2 1/2\" Con Tornillo', '', 1, 2, '1.81', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(158, 'A00082', 'Grapa Strup Universal de 1 1/2\" Con Tornillo', '', 1, 2, '0.25', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(159, 'A00083', 'Grapa Strup Universal de 1 1/2\" Sin Tornillo', '', 1, 2, '0.2', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(160, 'A00084', 'Grapa Strup Universal de 1 1/4\" Con Tornillo', '', 1, 2, '1.15', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(161, 'A00085', 'Grapa Strup Universal de 1 1/4\" Sin Tornillo', '', 1, 2, '1', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(162, 'A00086', 'Grapa Strup Universal de 1\" Sin Tornillo', '', 1, 2, '0.35', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(163, 'A00087', 'Grapa Strup Universal de 1/2 Sin Tornillo', '', 1, 2, '0.1', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(164, 'A00088', 'Grapa Strup Universal de 2 1/2\" Sin Tornillo', '', 1, 2, '1.5', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(165, 'A00089', 'Grapa Strup Universal de 2 \" Con tornillo', '', 1, 2, '1.5', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(166, 'A00090', 'Grapa Strup Universal de 2\" Sin Tornillo', '', 1, 2, '1', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(167, 'A00091', 'Grapa Strup Universal de 3 \" Sin Tornillo', '', 1, 2, '1.5', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(168, 'A00092', 'Grapa Strup Universal de 3/4 Con tornillo', '', 1, 2, '0.27', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(169, 'A00093', 'Grapa Strup Universalde 1/2\" Con Tornillo', '', 1, 2, '0.2', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(170, 'A00094', 'Grapas conduit de 2\"', '', 1, 2, '0.46', '', '', 'HW', 's', 'ok', 'ok', 's'),
(171, 'A00095', 'Grapas conduit de 1 1/2\"', '', 1, 2, '0.33', '', '', 'HW', 's', 'ok', 'ok', 's'),
(172, 'A00096', 'Grapas Conduit de 1 1/4\"', '', 1, 2, '0.21', '', '', 'HW', 's', 'ok', 'ok', 's'),
(173, 'A00097', 'Grapas conduit de 1\"', '', 1, 2, '0.17', '', '', 'HW', 's', 'ok', 'ok', 's'),
(174, '7501206659496', 'Grapas Conduit de 1/2\"', '', 1, 2, '0.07', '', '', 'Voltech', 's', 'ok', 'ok', 's'),
(175, 'A00098', 'Grapas conduit de 2 1/2\"', '', 1, 2, '1.24', '', '', 'HW', 's', 'ok', 'ok', 's'),
(176, 'A00099', 'Grapas Conduit de 3/4\"', '', 1, 2, '0.1', '', '', 'HW', 's', 'ok', 'ok', 's'),
(177, 'A00100', 'Grapas de Lamina de 1 \"', '', 1, 1, '0.05', '', '', '', 's', 'ok', 'ok', 's'),
(178, 'A00101', 'Grapas de Lamina de 1/2\"', '', 1, 1, '0.03', '', '', '', 's', 'ok', 'ok', 's'),
(179, 'A00102', 'Grapas de Lamina de 3/4\"', '', 1, 1, '0.03', '', '', '', 's', 'ok', 'ok', 's'),
(180, '7501206696064', 'Grapas para TNM 2-14', '', 1, 2, '0.05', '', '', 'Voltech', 's', 'ok', 'ok', 's'),
(181, 'A00103', 'Grapas para TNM 3-10', '', 1, 2, '0.05', '', '', 'Voltech', 's', 'ok', 'ok', 's'),
(182, 'A00104', 'Grapas Strup EMT 3/4', '', 1, 1, '0.05', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(183, 'A00105', 'Grapas Strup Universal de 3/4 Sin tornillo', '', 1, 2, '0.27', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(184, 'A00106', 'Grillete de Anclaje3/8\"', '', 2, 2, '0.75', '', '', '', 's', 'ok', 'ok', 's'),
(185, 'A00107', 'Grapas para TNM 2-12', '', 1, 2, '0.05', '', '', 'Voltech', 's', 'ok', 'ok', 's'),
(186, 'A00108', 'Guardamotor de 4.5 a 6. 3 Amp en caja', '', 2, 2, '48', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(187, 'A00109', 'Guardamotores de 3.5 a 5 Amp en caja', '', 2, 2, '39', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(188, '7460193510220', 'Guias Navide?a de 100 Luces ', '', 5, 1, '1', '', '', '', 's', 'ok', 'ok', 's'),
(189, '46135147104', 'Halogeno de 50 Watts Peque?o ', '', 5, 1, '5.32', '', '', 'Sylvania ', 's', 'ok', 'ok', 's'),
(190, 'A00110', 'Hebillas BAND-IT de 1/2', '', 2, 1, '0.32', '', '', 'Denver ', 's', 'ok', 'ok', 's'),
(191, 'A00111', 'Hebillas BAND-IT de 3/4', '', 2, 1, '0.32', '', '', 'Denver ', 's', 'ok', 'ok', 's'),
(192, '7501206639818', 'Hojas de Sierra ', '', 1, 1, '0.66', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(193, '7501206663370', 'Lampara Circular 22W ', '', 5, 1, '2.7', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(194, '75012066993', 'Lampara Circular 32W ', '', 5, 1, '3.68', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(195, '898639001679', 'Lampara de Mano Azul Intermitente', '', 5, 1, '4.5', '', '', 'Life+Gear ', 's', 'ok', 'ok', 's'),
(196, '7501206671924', 'Lampara de mano con dos Pilas y estuche', '', 5, 1, '5.5', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(197, '898639001679', 'Lampara de Mano Rosada Intermitente', '', 5, 1, '4.5', '', '', 'Life+Gear ', 's', 'ok', 'ok', 's'),
(198, '898639001150', 'Lampara de Mano Roja Intermitente ', '', 5, 1, '4.5', '', '', 'Life+Gear ', 's', 'ok', 'ok', 's'),
(199, '898639001174', 'Lampara de Mano Verde Intermitente', '', 5, 1, '4.5', '', '', 'Life+Gear ', 's', 'ok', 'ok', 's'),
(200, '7506240606970', 'Lampara Infantil Decorativa de Corona ', '', 5, 1, '1.18', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(201, '7506240606963', 'Lampara Infantil Decorativa de Flor ', '', 5, 1, '1.18', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(202, '7506240607595', 'Lampara Infantil Decorativa de Mariposa ', '', 5, 1, '1.18', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(203, '7506240606987', 'Lampara Infantil Decorativa de Mariquita ', '', 5, 1, '1.18', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(204, '7506240607014', 'Lampara Infantil decorativas de perritos ', '', 5, 1, '1.18', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(205, '7501206628287', 'Lente de seguridad transparente', '', 4, 2, '0.9', '', '', 'Trupper', 's', 'ok', 'ok', 's'),
(206, '501206685358', 'Lija de Agua 100 granos ', '', 1, 1, '0.64', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(207, '7501206685426', 'Lija de Agua 240 granos ', '', 1, 1, '0.39', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(208, 'A00112', 'Manguera de 1/2 de nivel ', '', 1, 5, '0.33', '', '', '', 's', 'ok', 'ok', 's'),
(209, '7501206604991', 'Manguera Reforzada de 10m x 1/2 color verde ', '', 1, 1, '6.21', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(210, '7501206605004', 'Manguera Reforzada de 15m x 1/2 color verde ', '', 1, 1, '8.5', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(211, '7501206688908', 'Mascara Respirador de 1 Filtro ', '', 4, 1, '5.09', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(212, 'A00113', 'Motor de 1/2 HP Trifasico', '', 2, 2, '28', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(213, '7453037407558', 'Ojo de buey 169002D-4WH', '', 2, 2, '6.5', '', '', 'teknoluce', 's', 'ok', 'ok', 's'),
(214, '190630520907', 'Ojo de Buey EMR-630', '', 2, 2, '7.44', '', '', 'Home Delight', 's', 'ok', 'ok', 's'),
(215, 'A00114', 'Ojo de Buey Grande', '', 2, 2, '6.5', '', '', '', 's', 'ok', 'ok', 's'),
(216, '190615520908', 'Ojo de Buey Peque?o EHR-615', '', 2, 1, '3', '', '', 'HomedeLight ', 's', 'ok', 'ok', 's'),
(217, '754802181114', 'Ojos de Buey 1811', '', 2, 2, '4.42', '', '', 'General Lighting', 's', 'ok', 'ok', 's'),
(218, 'A00115', 'Pegamento Blanco 59ml ', '', 1, 1, '0.4', '', '', 'Studio ', 's', 'ok', 'ok', 's'),
(219, 'A00116', 'Perno para Lamina ', '', 1, 1, '0.05', '', '', '', 's', 'ok', 'ok', 's'),
(220, 'A00117', 'Pernos de Cobre 1/2 x 2 ', '', 1, 1, '0.1', '', '', '', 's', 'ok', 'ok', 's'),
(221, 'A00118', 'Pernos de Cobre 1/2 x 2 1/2', '', 1, 1, '0.05', '', '', '', 's', 'ok', 'ok', 's'),
(222, 'A00119', 'Pernos de Cobre 1/2 x 4', '', 1, 1, '0.3', '', '', '', 's', 'ok', 'ok', 's'),
(223, 'A00120', 'Pernos de Cobre 1/4 x 2 1/2', '', 1, 1, '0.1', '', '', '', 's', 'ok', 'ok', 's'),
(224, 'A00121', 'Pernos Galvanizado de 1/2 x 2 1/2 ', '', 1, 1, '0.05', '', '', '', 's', 'ok', 'ok', 's'),
(225, '7750293000807', 'Placa Bticino de 1 Salida ', '', 6, 1, '1.39', '', '', 'Bticino ', 's', 'ok', 'ok', 's'),
(226, '7750293000806', 'Placa Bticino de 2 Salidas ', '', 6, 1, '1.39', '', '', 'Bticino ', 's', 'ok', 'ok', 's'),
(227, '7750293000814', 'Placa Bticino de 3 Salidas ', '', 6, 1, '1.39', '', '', 'Bticino ', 's', 'ok', 'ok', 's'),
(228, '7750293000815', 'Placa Bticino de 4 Salidas ', '', 6, 1, '1.5', '', '', 'Bticino ', 's', 'ok', 'ok', 's'),
(229, 'A00122', 'Placa ciega de Baquelita Blanca ', '', 6, 1, '0.6', '', '', 'Legrand ', 's', 'ok', 'ok', 's'),
(230, '32664205002', 'Placa Cuadrada para toma de cocina', '', 6, 2, '0.9', '', '', 'AGUILA', 's', 'ok', 'ok', 's'),
(231, 'A00123', 'Placa de Baquelita Blanca de 1 Salida ', '', 6, 1, '1.15', '', '', 'Bticino ', 's', 'ok', 'ok', 's'),
(232, '785007274523', 'Placa para toma industrial Polarizado Blanca \"Bago\"', '', 6, 1, '0.73', '', '', 'Legrand ', 's', 'ok', 'ok', 's'),
(233, 'A00124', 'Placa para toma industrial Polarizado Blanco ', '', 6, 1, '0.73', '', '', 'Aguila ', 's', 'ok', 'ok', 's'),
(234, '785007274547', 'Placa para toma industrial Polarizado Roja \"Bago\"', '', 6, 1, '0.85', '', '', 'Legrand ', 's', 'ok', 'ok', 's'),
(235, '32664191800', 'Placa Rectangular para toma 50 AMP', '', 6, 2, '0.85', '', '', 'AGUILA', 's', 'ok', 'ok', 's'),
(236, '78316434191', 'Portamain THQMV de 125Amp. 2 polos', '', 2, 2, '73.76', '', '', 'GENERAL ELECTRIC', 's', 'ok', 'ok', 's'),
(237, '783164338508', 'Portamain THQMV de 200Amp. 2 polos', '', 2, 2, '73.76', '', '', 'GENERAL ELECTRIC', 's', 'ok', 'ok', 's'),
(238, '783164338492', 'Portamain THQMV de 225Amp. 2 polos', '', 2, 2, '68.23', '', '', 'GENERAL ELECTRIC', 's', 'ok', 'ok', 's'),
(239, '7501206660423', 'Reflector de 90W 130 V ', '', 5, 1, '2.75', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(240, '7501206661741', 'Regleta de 6 Contactos 16 Awg 20 cm Largo ', '', 1, 1, '2.82', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(241, '4011209341364', 'Rele de tiempo TIMER 3UG3535-1AM50', '', 2, 2, '20', '', '', 'SIEMENS', 's', 'ok', 'ok', 's'),
(242, 'A00125', 'Resistencia para Cocina de aspiral', '', 1, 1, '0.25', '', '', 'Liberly Trading', 's', 'ok', 'ok', 's'),
(243, 'A00126', 'Rosetas Grandes de Porcelana ', '', 1, 1, '2', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(244, '7501206657270', 'Roseton Grande de Baquelita', '', 1, 1, '0.56', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(245, '7501206658413', 'Roseton Porcelana para Foco 7 1/2 ', '', 1, 1, '0.46', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(246, 'A00127', 'Scotch look Amarillo ', '', 2, 1, '0.14', '', '', '', 's', 'ok', 'ok', 's'),
(247, 'A00128', 'Scotch look anaranjados ', '', 2, 1, '0.03', '', '', '', 's', 'ok', 'ok', 's'),
(248, 'A00129', 'Socket Anodizado', '', 1, 2, '1.25', '', '', '', 's', 'ok', 'ok', 's'),
(249, '7501206658239', 'Socket con llave ', '', 1, 1, '0.79', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(250, '7501206658260', 'Socket con toma macho blanco ', '', 1, 1, '0.36', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(251, 'A00130', 'Soportes para Lampara 660 Watts', '', 2, 2, '0.5', '', '', 'Leviton', 's', 'ok', 'ok', 's'),
(252, '7501206658208', 'Soquet de Hule Para Interperie ', '', 1, 1, '0.4', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(253, '7501206658369', 'Soquet de Porcelana Cuadrado ', '', 1, 1, '0.4', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(254, '7501206611364', 'Spray Anarajando Acrilico Fluorosente 400ml ', '', 1, 1, '2.23', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(255, '7506240630708', 'Spray Azul Acrilico 300 ml ', '', 1, 1, '1.58', '', '', 'Pretul ', 's', 'ok', 'ok', 's'),
(256, '7501206684993', 'Spray Blanco Acrilico 400 ml ', '', 1, 1, '2.58', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(257, '7501206631133', 'Spray Metalico Acrilico 400 ml ', '', 1, 1, '2.53', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(258, '7501206684986', 'Spray Negro Acrilico 400ml ', '', 1, 1, '2.58', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(259, '7506240630016', 'Spray rojo Acrilico 300 ml ', '', 1, 1, '1.58', '', '', 'pretul ', 's', 'ok', 'ok', 's'),
(260, '7501206611388', 'Spray Rosado Fluorescente Acrilico 400 ml ', '', 1, 1, '2.23', '', '', 'Truper ', 's', 'ok', 'ok', 's'),
(261, '7506240630722', 'Spray Verde Acrilico 300 ml ', '', 1, 1, '1.58', '', '', 'Pretul ', 's', 'ok', 'ok', 's'),
(262, '168645', 'Sta?o para soldar', '', 2, 5, '2.08', '', '', 'Bow', 's', 'ok', 'ok', 's'),
(263, 'A00131', 'Starter de 20Watts FS - 2', '', 1, 1, '0.2', '', '', 'Sylvania ', 's', 'ok', 'ok', 's'),
(264, 'A00132', 'Starter de 20Watts FS - 2', '', 1, 1, '0.2', '', '', 'Certfied', 's', 'ok', 'ok', 's'),
(265, 'A00133', 'Starter de 40Watts FS - 4', '', 1, 1, '0.3', '', '', 'Sylvania ', 's', 'ok', 'ok', 's'),
(266, '4719867213268', 'Super Glue Pega Loca ', '', 1, 1, '0.07', '', '', 'Chemmer ', 's', 'ok', 'ok', 's'),
(267, '7441109000073', 'Switch Colgante ', '', 6, 1, '1.15', '', '', 'Eagle ', 's', 'ok', 'ok', 's'),
(268, '7441031003531', 'Switch Sencillo T/D', '', 6, 2, '2.05', '', '', 'BTICINO', 's', 'ok', 'ok', 's'),
(269, '7501206658543', 'Switch Superficial de Tortuga ', '', 6, 1, '0.35', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(270, 'A00134', 'Tapadera 4x4', '', 1, 2, '0.46', '', '', 'RACO', 's', 'ok', 'ok', 's'),
(271, 'A00135', 'Tapadera Redonda', '', 1, 2, '0.6', '', '', 'RACO', 's', 'ok', 'ok', 's'),
(272, '50169008324', 'Tapaderas 5x5', '', 1, 2, '1.8', '', '', 'RACO', 's', 'ok', 'ok', 's'),
(273, 'A00136', 'Tapon de PVC de 3\"', '', 1, 2, '3.28', '', '', 'DUPA', 's', 'ok', 'ok', 's'),
(274, '7441102804791', 'Tee de PVC de 2\"', '', 1, 2, '2.25', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(275, '30783643148186', 'Termicos 1P-15Amp ', '', 3, 1, '4.11', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(276, '30783643148193', 'Termicos 1P-20Amp ', '', 3, 1, '4.11', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(277, '30783643148216', 'Termicos 1P-30Amp ', '', 3, 1, '4.66', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(278, 'A00137', 'Termicos 1P-50Amp ', '', 3, 1, '9.65', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(279, '30783643148360', 'Termicos 2P-20Amp ', '', 3, 1, '9.65', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(280, '30783643148384', 'Termicos 2P-30Amp ', '', 3, 1, '9.65', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(281, '30783643148650', 'Termicos 2P-60Amp ', '', 3, 1, '14.98', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(282, '783643148666', 'Termicos 2P-70Amp ', '', 3, 1, '19.63', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(283, '783643263420', 'Termicos de U?a 1P-20Amp ', '', 3, 1, '9.98', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(284, '783643263529', 'Termicos de U?a 2P-15Amp ', '', 3, 1, '9.71', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(285, '783643263536', 'Termicos de U?a 2P-20Amp ', '', 3, 1, '11', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(286, '783643263598', 'Termicos de U?a 2P-50Amp ', '', 3, 1, '11.81', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(287, '783643000933', 'Termicos de U?a 2P-80Amp ', '', 3, 1, '19.63', '', '', 'Siemens ', 's', 'ok', 'ok', 's'),
(288, 'A00138', 'Terminal de ojo # 2 ', '', 1, 1, '1.47', '', '', '3M', 's', 'ok', 'ok', 's'),
(289, 'A00139', 'Terminal de Ojo # 2 ', '', 1, 1, '1.47', '', '', '3M', 's', 'ok', 'ok', 's'),
(290, 'A00140', 'Terminal de ojo # 4 ', '', 1, 1, '1.25', '', '', '', 's', 'ok', 'ok', 's'),
(291, 'A00141', 'Terminal de Ojo # 4 ', '', 1, 1, '1.04', '', '', '3M', 's', 'ok', 'ok', 's'),
(292, 'A00142', 'Terminal de Ojo 10-120', '', 1, 1, '1', '', '', '', 's', 'ok', 'ok', 's'),
(293, 'A00143', 'Terminal de Ojo 10-70', '', 1, 1, '1.05', '', '', '', 's', 'ok', 'ok', 's'),
(294, 'A00144', 'Terminal de ojo 12-150 ', '', 1, 1, '1.5', '', '', '', 's', 'ok', 'ok', 's'),
(295, 'A00145', 'Terminal de Ojo 12-240', '', 1, 1, '1.5', '', '', '', 's', 'ok', 'ok', 's'),
(296, 'A00146', 'Terminal de Ojo 35-8', '', 1, 1, '0.55', '', '', '', 's', 'ok', 'ok', 's'),
(297, 'A00147', 'Terminal de Ojo 50-10', '', 1, 1, '1.04', '', '', '', 's', 'ok', 'ok', 's'),
(298, 'A00148', 'Terminal de Ojo 8-50', '', 1, 1, '0.4', '', '', '', 's', 'ok', 'ok', 's'),
(299, 'A00149', 'Terminal de ojo de 16 mm', '', 1, 1, '0.13', '', '', '', 's', 'ok', 'ok', 's'),
(300, 'A00150', 'Terminal de ojo de 25 mm', '', 1, 1, '0.18', '', '', '', 's', 'ok', 'ok', 's'),
(301, 'A00151', 'Terminales de ojo 120 mm ', '', 1, 1, '1.1', '', '', '', 's', 'ok', 'ok', 's'),
(302, '7501206698853', 'Terminales para cable Coaxial RG6 ', '', 1, 1, '0.2', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(303, 'A00152', 'Terminales UY ', '', 1, 1, '0.2', '', '', 'Scotch 3M ', 's', 'ok', 'ok', 's'),
(304, '739232491', 'Tiras Simpson ', '', 1, 1, '0.9', '', '', 'Simpson', 's', 'ok', 'ok', 's'),
(305, 'A00153', 'Tirro ', '', 1, 1, '0.6', '', '', 'Hy Stick ', 's', 'ok', 'ok', 's'),
(306, '7501206657478', 'Toma Adaptador Americano', '', 6, 1, '0.4', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(307, '7441109000127', 'Toma Adaptador Americano', '', 6, 1, '0.65', '', '', 'Eagle ', 's', 'ok', 'ok', 's'),
(308, '785007860054', 'Toma Doble Polarizado 20 Amp color Rojo ', '', 6, 1, '5.72', '', '', 'Legrand ', 's', 'ok', 'ok', 's'),
(309, '7501206658574', 'Toma doble Superficial ', '', 6, 1, '0.61', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(310, '32664306303', 'Toma Hembra de Cocina 30 Amp ', '', 6, 1, '2.25', '', '', 'Cooper ', 's', 'ok', 'ok', 's'),
(311, '7501206658659', 'Toma Macho con abrazadera 15 Amp ', '', 6, 1, '0.5', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(312, '7501206658659', 'Toma Macho con abrazadera 15 Amp ', '', 6, 1, '0.5', '', '', 'Aguila ', 's', 'ok', 'ok', 's'),
(313, '7855007143041', 'Toma Macho de Piso ', '', 6, 1, '11.88', '', '', 'Legrand ', 's', 'ok', 'ok', 's'),
(314, '7501206659441', 'Toma Macho Pachito ', '', 6, 1, '0.28', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(315, '7441109003753', 'Toma Macho para aire acondicionado Polarizado 15 Amp', '', 6, 1, '2.15', '', '', 'Aguila ', 's', 'ok', 'ok', 's'),
(316, '32664311000', 'Toma Macho para aire acondicionado Polarizado 20 Amp', '', 6, 1, '1.75', '', '', 'Aguila ', 's', 'ok', 'ok', 's'),
(317, 'A00154', 'Toma Machos para Cocina 50 Amp ', '', 6, 1, '1.75', '', '', 'Aguila ', 's', 'ok', 'ok', 's'),
(318, 'A00155', 'Toma para T.V.', '', 6, 2, '2.74', '', '', 'BTICINO', 's', 'ok', 'ok', 's'),
(319, '7441031005061', 'Toma para Telefono', '', 6, 2, '2.13', '', '', 'BTICINO', 's', 'ok', 'ok', 's'),
(320, '7501206658581', 'Toma Superficial de Tortuguita ', '', 6, 1, '0.61', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(321, '7441031003654', 'Toma T/D', '', 6, 2, '1.82', '', '', 'BTICINO', 's', 'ok', 'ok', 's'),
(322, 'A00156', 'Tomas Tapon ', '', 6, 1, '0.6', '', '', 'Eagle ', 's', 'ok', 'ok', 's'),
(323, 'A00157', 'Tomas Tipo T Color Caf', '', 6, 1, '0.8', '', '', 'Eagle ', 's', 'ok', 'ok', 's'),
(324, 'A00158', 'Tornillos para Caja Octagonal', '', 1, 2, '0.03', '', '', '', 's', 'ok', 'ok', 's'),
(325, '7501206698785', 'Transformador para antena de 2 Salidas ', '', 1, 1, '0.34', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(326, '7501206698792', 'Transformador para antena de 3 Salidas ', '', 1, 1, '0.4', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(327, '7501206698891', 'Transformador para antena tipo zapatito', '', 1, 1, '0.6', '', '', 'Voltech ', 's', 'ok', 'ok', 's'),
(328, 'A00159', 'Transformador Rapid Star', '', 2, 2, '7', '', '', 'Advance Transformer', 's', 'ok', 'ok', 's'),
(329, '780685200017', 'Transformadores de 20 Watts', '', 2, 2, '1.4', '', '', 'JADCO', 's', 'ok', 'ok', 's'),
(330, 'A00160', 'Tubo Circular de 22 Watts', '', 5, 2, '2.07', '', '', 'SYLVANIA', 's', 'ok', 'ok', 's'),
(331, 'A00161', 'Tubos de 17 Watts ', '', 5, 1, '1.53', '', '', 'Philips ', 's', 'ok', 'ok', 's'),
(332, 'A00162', 'Tubos de 17 Watts ', '', 5, 1, '1.53', '', '', 'Sylvania ', 's', 'ok', 'ok', 's'),
(333, 'A00163', 'Tubos de 32 Watts ', '', 5, 1, '1.02', '', '', 'Philips ', 's', 'ok', 'ok', 's'),
(334, 'A00164', 'Tuercas de 1 1/2\"', '', 1, 2, '0.15', '', '', '', 's', 'ok', 'ok', 's'),
(335, 'A00165', 'Tuercas de 1 1/4\"', '', 1, 2, '0.2', '', '', '', 's', 'ok', 'ok', 's'),
(336, 'A00166', 'Tuercas de 1\"', '', 1, 2, '0.15', '', '', '', 's', 'ok', 'ok', 's'),
(337, 'A00167', 'Tuercas de 1/2\"', '', 1, 2, '0.1', '', '', '', 's', 'ok', 'ok', 's'),
(338, 'A00168', 'Tuercas de 2 1/2\"', '', 1, 2, '0.2', '', '', '', 's', 'ok', 'ok', 's'),
(339, 'A00169', 'Tuercas de 2\"', '', 1, 2, '0.2', '', '', '', 's', 'ok', 'ok', 's'),
(340, 'A00170', 'Tuercas de 3\"', '', 1, 2, '0.5', '', '', '', 's', 'ok', 'ok', 's'),
(341, 'A00171', 'Tuercas de 3/4\"', '', 1, 2, '0.15', '', '', '', 's', 'ok', 'ok', 's'),
(342, 'A00172', 'Union Universal Electrica de 1\"', '', 1, 2, '3.81', '', '', '', 's', 'ok', 'ok', 's'),
(343, 'A00173', 'Union Universal Electrica de 1/2\" ', '', 1, 2, '3.06', '', '', '', 's', 'ok', 'ok', 's'),
(344, 'A00174', 'Union Universal de agua de 1/2\" ', '', 1, 2, '1.15', '', '', '', 's', 'ok', 'ok', 's'),
(345, 'A00175', 'Union Universal de agua de 3/4\"', '', 1, 2, '1.1', '', '', '', 's', 'ok', 'ok', 's'),
(346, 'A00176', 'Union Conduit de 3\"', '', 1, 2, '15', '', '', '', 's', 'ok', 'ok', 's'),
(347, 'A00177', 'Union Conduit de 3/4\"', '', 1, 2, '1.75', '', '', '', 's', 'ok', 'ok', 's'),
(348, 'A00178', 'Union Conduit de 1 1/2\"', '', 1, 2, '3.73', '', '', '', 's', 'ok', 'ok', 's'),
(349, 'A00179', 'Union Conduit de 1\"', '', 1, 2, '2.23', '', '', '', 's', 'ok', 'ok', 's'),
(350, 'A00180', 'Union Conduit de 1/2\"', '', 1, 2, '1.47', '', '', '', 's', 'ok', 'ok', 's'),
(351, 'A00181', 'Union Conduit de 2 1/2\"', '', 1, 2, '7', '', '', '', 's', 'ok', 'ok', 's'),
(352, 'A00182', 'Union Conduit de 2\"', '', 1, 2, '5.3', '', '', '', 's', 'ok', 'ok', 's'),
(353, 'A00183', 'Union de PVC de 1/2\"', '', 1, 2, '0.11', '', '', '', 's', 'ok', 'ok', 's'),
(354, 'A00184', 'Union de expansion 3/4\"', '', 1, 2, '1.5', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(355, 'A00185', 'Union de Expansion de 2\"', '', 1, 2, '2', '', '', '', 's', 'ok', 'ok', 's'),
(356, 'A00186', 'Union de PVC de 3/4\"', '', 1, 2, '0.12', '', '', '', 's', 'ok', 'ok', 's'),
(357, '7441102800229', 'Union de PVC de 1 1/4\"', '', 1, 2, '0.55', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(358, '7441102800205', 'Union de PVC de 1\"', '', 1, 2, '0.32', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(359, '7441102800236', 'Union de PVC de 2\"', '', 1, 2, '0.89', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(360, '7441102800267', 'Union de PVC de 3/4\"', '', 1, 2, '0.12', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(361, '1331212021', 'Union EMT de 1\" con tornillo', '', 1, 2, '0.56', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(362, '1331212024', 'Union EMT de 2\" con tornillo', '', 1, 2, '2.15', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(363, 'A00187', 'Union EMT de 3/4\" con tornillo', '', 1, 2, '0.41', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(364, 'A00188', 'Union EMT de 1 1/4\" con tornillo', '', 1, 2, '1.36', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(365, 'A00189', 'Union EMT de 1/2\" con tornillo', '', 1, 2, '0.11', '', '', 'TOPAZ', 's', 'ok', 'ok', 's'),
(366, 'A00190', 'Union Galvanizada de 1\"', '', 1, 2, '4.03', '', '', 'BIS', 's', 'ok', 'ok', 's'),
(367, 'A00191', 'Union Universal de agua de 1 1/2\"', '', 1, 2, '1.36', '', '', '', 's', 'ok', 'ok', 's'),
(368, 'A00192', 'Union Universal de agua de 1\"', '', 1, 2, '2.25', '', '', '', 's', 'ok', 'ok', 's'),
(369, 'A00193', 'Union Universal Electrica de 3/4', '', 1, 2, '3.50', '', '', 'VARIAS', 's', 'ok', 'ok', 's'),
(370, '741102801967', 'Vector PVC 3/4\"', '', 1, 2, '0.5', '', '', 'Amanco', 's', 'ok', 'ok', 's'),
(371, '7438277833', 'Camara Digital', '', 7, 1, '43', 'CN00037', 'A18', 'canon', 's', 'ok', '', 's'),
(372, '7438298883', 'Camara Digital Francesa ', '', 7, 1, '43', 'UIO89', '', 'canon', 's', 'ok', '', 's');

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
(2, 'Delmar Ramon Lopez', 'Col. las colinas casa #12 paje san Benito', '739274927-9', 'm', '7808-0980', '789797-87', 's', 'contribuyente', '');

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

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `almacen`, `articulo`, `codigo`, `stock`, `stock_min`, `pv`, `pmy`, `cat`) VALUES
(1, 1, 1, '7415300005007', '11', '1', '2', '0', 1),
(2, 1, 2, '7415300005014', '11', '1', '3.25', '0', 1),
(3, 1, 3, '7501206652428', '0', '1', '2', '0', 1),
(4, 1, 4, '7441102801011', '8', '1', '3', '0', 1),
(5, 1, 5, '7441102800960', '11', '1', '0.85', '0', 1),
(6, 1, 6, '7441102800977', '12', '1', '1.25', '0', 1),
(7, 1, 7, '7441102800945', '12', '1', '0.85', '0', 1),
(8, 1, 8, '7441102800915', '4', '1', '4.5', '0', 1),
(9, 1, 9, '7501206652411', '14', '1', '1.75', '0', 1),
(10, 1, 10, 'P0001', '8', '1', '1.15', '0', 2),
(11, 1, 11, '7613023253662', '55', '1', '0.75', '0', 2),
(12, 1, 12, 'A0001', '119', '1', '0.1', '0', 2),
(13, 1, 13, 'A0002', '75', '1', '0.25', '0', 2),
(14, 1, 14, 'A0003', '159', '1', '0.25', '0', 2),
(15, 1, 15, 'A0004', '2', '1', '3', '0', 1),
(16, 1, 16, 'A0005', '1', '1', '25', '0', 2),
(17, 1, 17, 'A0006', '1', '1', '25', '0', 2),
(18, 1, 18, 'A0007', '1', '1', '27', '0', 2),
(19, 1, 19, 'A0008', '1', '1', '25', '0', 2),
(20, 1, 20, 'A0009', '1', '1', '67.5', '0', 2),
(21, 1, 21, '1280018093', '3', '1', '2.75', '0', 1),
(22, 1, 22, 'A00010', '3', '1', '16', '0', 2),
(23, 1, 23, 'A00011', '3', '1', '16', '0', 2),
(24, 1, 24, '7501206675328', '1', '1', '5', '0', 4),
(25, 1, 25, '7501206675212', '1', '1', '8', '0', 4),
(26, 1, 26, '7501206675229', '1', '1', '8', '0', 4),
(27, 1, 27, '7501206675199', '1', '1', '5', '0', 4),
(28, 1, 28, 'A00012', '2', '1', '0.7', '0', 1),
(29, 1, 29, 'A00013', '2', '1', '2.5', '0', 1),
(30, 1, 30, 'A00014', '8', '1', '0.7', '0', 1),
(31, 1, 31, 'A00015', '9', '1', '0.65', '0', 1),
(32, 1, 32, 'A00016', '6', '1', '0.3', '0', 1),
(33, 1, 33, 'A00017', '13', '1', '0.85', '0', 1),
(34, 1, 34, 'A00018', '44', '1', '0.5', '0', 1),
(35, 1, 35, 'A00019', '184', '1', '0.45', '0', 2),
(36, 1, 36, 'A00020', '80', '1', '0.5', '0', 2),
(37, 1, 37, '3245060920524', '2', '1', '25', '0', 3),
(38, 1, 38, '3245060920623', '15', '1', '30', '0', 3),
(39, 1, 39, '7501206697931', '8', '1', '1', '0', 3),
(40, 1, 40, '783164414332', '1', '1', '20', '0', 3),
(41, 1, 41, '7501206658338', '19', '1', '1.2', '0', 3),
(42, 1, 42, '7501206658253', '8', '1', '1.75', '0', 1),
(43, 1, 43, '7501206658222', '7', '1', '1.75', '0', 1),
(44, 1, 44, '638110069398', '1', '1', '4', '0', 1),
(45, 1, 45, '7501206663141', '6', '1', '2.5', '0', 1),
(46, 1, 46, '7501206663103', '5', '1', '3.5', '0', 1),
(47, 1, 47, '7501206663110', '4', '1', '4.5', '0', 1),
(48, 1, 48, '7501206688922', '2', '1', '3.5', '0', 4),
(49, 1, 49, 'A00021', '8', '1', '2', '0', 2),
(50, 1, 50, 'A00022', '7', '1', '3.65', '0', 2),
(51, 1, 51, 'A00023', '22', '1', '2.85', '0', 2),
(52, 1, 52, 'A00024', '45', '1', '1', '0', 2),
(53, 1, 53, '7501206652305', '11', '1', '3.5', '0', 1),
(54, 1, 54, 'A00025', '2', '1', '15', '0', 4),
(55, 1, 55, 'A00026', '28', '1', '0.65', '0', 1),
(56, 1, 56, 'A00027', '27', '1', '0.15', '0', 1),
(57, 1, 57, 'A00028', '28', '1', '0.15', '0', 1),
(58, 1, 58, 'A00029', '3', '1', '0.15', '0', 1),
(59, 1, 59, 'A00030', '7', '1', '0.3', '0', 1),
(60, 1, 60, 'A00031', '1', '1', '0.3', '0', 1),
(61, 1, 61, 'A00032', '3', '1', '0.15', '0', 1),
(62, 1, 62, 'A00033', '1', '1', '1.5', '0', 1),
(63, 1, 63, '21200518881', '12', '1', '1.25', '0', 1),
(64, 1, 64, '7501206640029', '3', '1', '1.65', '0', 1),
(65, 1, 65, 'A00034', '1', '1', '1.15', '0', 2),
(66, 1, 66, '7501206646830', '6', '1', '1.15', '0', 2),
(67, 1, 67, '7501206644911', '14', '1', '1.75', '0', 2),
(68, 1, 68, 'A00035', '2', '1', '45', '0', 2),
(69, 1, 69, '54007156031', '2', '1', '14.5', '0', 2),
(70, 1, 70, '54007150176', '1', '1', '7', '0', 2),
(71, 1, 71, '54007150251', '2', '1', '14.5', '0', 2),
(72, 1, 72, '7501206624524', '2', '1', '2.5', '0', 4),
(73, 1, 73, '7501206624517', '3', '1', '5.5', '0', 4),
(74, 1, 74, '7501206624425', '2', '1', '7.15', '0', 4),
(75, 1, 75, '7501206641675', '10', '1', '0.55', '0', 1),
(76, 1, 76, 'A00036', '2', '1', '1.5', '0', 1),
(77, 1, 77, '7501206693681', '483', '1', '0.05', '0', 1),
(78, 1, 78, '7501206665442', '171', '1', '0.1', '0', 1),
(79, 1, 79, '27501206696976', '50', '1', '1.15', '0', 1),
(80, 1, 80, '739272741', '73', '1', '0.25', '0', 1),
(81, 1, 81, '7441102800137', '1', '1', '2.1', '0', 1),
(82, 1, 82, '7441102800113', '5', '1', '1.25', '0', 1),
(83, 1, 83, '7441102800175', '3', '1', '1.25', '0', 1),
(84, 1, 84, 'A00037', '4', '1', '3.65', '0', 1),
(85, 1, 85, 'A00038', '22', '1', '0.55', '0', 1),
(86, 1, 86, 'A00039', '3', '1', '3', '0', 1),
(87, 1, 87, 'A00040', '0', '1', '3', '0', 1),
(88, 1, 88, 'A00041', '6', '1', '2.5', '0', 1),
(89, 1, 89, '1331212032', '1', '1', '3.85', '0', 1),
(90, 1, 90, '7441102801929', '2', '1', '0.5', '0', 1),
(91, 1, 91, 'A00042', '8', '1', '2.5', '0', 1),
(92, 1, 92, 'A00043', '3', '1', '1', '0', 1),
(93, 1, 93, 'A00044', '14', '1', '0.55', '0', 1),
(94, 1, 94, '8012199638188', '8', '1', '15.53', '0', 1),
(95, 1, 95, 'A00045', '1', '1', '11', '0', 2),
(96, 1, 96, 'A00046', '1', '1', '6.1', '0', 2),
(97, 1, 97, 'A00047', '1', '1', '5.75', '0', 2),
(98, 1, 98, 'A00048', '1', '1', '11.95', '0', 2),
(99, 1, 99, 'A00049', '4', '1', '3.6', '0', 2),
(100, 1, 100, 'A00050', '16', '1', '5.5', '0', 2),
(101, 1, 101, 'A00051', '2', '1', '6.8', '0', 1),
(102, 1, 102, 'A00052', '3', '1', '3.5', '0', 1),
(103, 1, 103, 'A00053', '3', '1', '2', '0', 1),
(104, 1, 104, '7501206625378', '10', '1', '3.5', '0', 4),
(105, 1, 105, '6932548825019', '12', '1', '5', '0', 4),
(106, 1, 106, 'A00054', '5', '1', '3.5', '0', 4),
(107, 1, 107, '8464461310', '27', '1', '0.6', '0', 2),
(108, 1, 108, 'A00055', '2', '1', '3', '0', 1),
(109, 1, 109, 'A00056', '1', '1', '16.5', '0', 2),
(110, 1, 110, 'A00057', '3', '1', '2', '0', 2),
(111, 1, 111, '7501206663493', '4', '1', '3.75', '0', 2),
(112, 1, 112, '7501206663615', '1', '1', '6.8', '0', 2),
(113, 1, 113, 'A00058', '6', '1', '2', '0', 2),
(114, 1, 114, 'A00059', '9', '1', '3', '0', 2),
(115, 1, 115, '7501206663769', '1', '1', '17.5', '0', 2),
(116, 1, 116, '7501206690994', '1', '1', '15', '0', 5),
(117, 1, 117, '4001780187085', '12', '1', '4.5', '0', 5),
(118, 1, 118, '7501206663400', '2', '1', '4.15', '0', 5),
(119, 1, 119, '7501206663417', '7', '1', '4.75', '0', 5),
(120, 1, 120, '78309406037', '1', '1', '4.75', '0', 5),
(121, 1, 121, '7894400900007', '0', '1', '9.5', '0', 5),
(122, 1, 122, 'A00060', '0', '1', '2', '0', 5),
(123, 1, 123, 'A00061', '1', '1', '25.15', '0', 5),
(124, 1, 124, 'A00062', '2', '1', '25.15', '0', 5),
(125, 1, 125, 'A00063', '2', '1', '5', '0', 5),
(126, 1, 126, '7894400900038', '1', '1', '25.15', '0', 5),
(127, 1, 127, 'A00064', '2', '1', '2', '0', 5),
(128, 1, 128, 'A00065', '2', '1', '0.55', '0', 5),
(129, 1, 129, 'A00066', '1', '1', '0.55', '0', 5),
(130, 1, 130, 'A00067', '3', '1', '0.55', '0', 5),
(131, 1, 131, 'A00068', '2', '1', '0.55', '0', 5),
(132, 1, 132, 'A00069', '3', '1', '0.55', '0', 5),
(133, 1, 133, '756902096802121', '3', '1', '1.75', '0', 5),
(134, 1, 134, '7702081007000', '91', '1', '0.6', '0', 5),
(135, 1, 135, '8309406025', '4', '1', '4.5', '0', 5),
(136, 1, 136, '7702048386858', '1', '1', '5.5', '0', 5),
(137, 1, 137, '7702048386871', '1', '1', '5.5', '0', 5),
(138, 1, 138, '7702048386872', '1', '1', '5.5', '0', 5),
(139, 1, 139, '8309406029', '5', '1', '4.75', '0', 5),
(140, 1, 140, '7453001117642', '1', '1', '2', '0', 5),
(141, 1, 141, '7453001117643', '1', '1', '2', '0', 5),
(142, 1, 142, 'A00070', '2', '1', '2', '0', 5),
(143, 1, 143, '7702081003019', '2', '1', '0.6', '0', 5),
(144, 1, 144, '7702081004009', '52', '1', '0.6', '0', 5),
(145, 1, 145, '7453001115359', '1', '1', '2', '0', 5),
(146, 1, 146, '7453001115373', '1', '1', '2', '0', 5),
(147, 1, 147, 'A00071', '2', '1', '2', '0', 5),
(148, 1, 148, 'A00072', '1', '1', '2', '0', 5),
(149, 1, 149, 'A00073', '2', '1', '8', '0', 5),
(150, 1, 150, 'A00074', '4', '1', '8', '0', 5),
(151, 1, 151, 'A00075', '2', '1', '5.25', '0', 2),
(152, 1, 152, 'A00076', '19', '1', '2', '0', 2),
(153, 1, 153, 'A00077', '25', '1', '2', '0', 2),
(154, 1, 154, 'A00078', '22', '1', '3', '0', 2),
(155, 1, 155, 'A00079', '3', '1', '4.75', '0', 2),
(156, 1, 156, 'A00080', '3', '1', '0.75', '0', 1),
(157, 1, 157, 'A00081', '2', '1', '2.71', '0', 1),
(158, 1, 158, 'A00082', '2', '1', '0.65', '0', 1),
(159, 1, 159, 'A00083', '36', '1', '0.45', '0', 1),
(160, 1, 160, 'A00084', '5', '1', '1.75', '0', 1),
(161, 1, 161, 'A00085', '61', '1', '1.5', '0', 1),
(162, 1, 162, 'A00086', '68', '1', '0.6', '0', 1),
(163, 1, 163, 'A00087', '18', '1', '0.2', '0', 1),
(164, 1, 164, 'A00088', '30', '1', '2.25', '0', 1),
(165, 1, 165, 'A00089', '2', '1', '2.25', '0', 1),
(166, 1, 166, 'A00090', '12', '1', '1.6', '0', 1),
(167, 1, 167, 'A00091', '1', '1', '2.25', '0', 1),
(168, 1, 168, 'A00092', '12', '1', '0.75', '0', 1),
(169, 1, 169, 'A00093', '6', '1', '0.35', '0', 1),
(170, 1, 170, 'A00094', '17', '1', '0.95', '0', 1),
(171, 1, 171, 'A00095', '10', '1', '0.65', '0', 1),
(172, 1, 172, 'A00096', '3', '1', '0.35', '0', 1),
(173, 1, 173, 'A00097', '26', '1', '0.3', '0', 1),
(174, 1, 174, '7501206659496', '78', '1', '0.2', '0', 1),
(175, 1, 175, 'A00098', '1', '1', '2.15', '0', 1),
(176, 1, 176, 'A00099', '10', '1', '0.25', '0', 1),
(177, 1, 177, 'A00100', '545', '1', '0.2', '0', 1),
(178, 1, 178, 'A00101', '1080', '1', '0.1', '0', 1),
(179, 1, 179, 'A00102', '235', '1', '0.15', '0', 1),
(180, 1, 180, '7501206696064', '83', '1', '0.1', '0', 1),
(181, 1, 181, 'A00103', '13', '1', '0.15', '0', 1),
(182, 1, 182, 'A00104', '68', '1', '0.25', '0', 1),
(183, 1, 183, 'A00105', '30', '1', '0.5', '0', 1),
(184, 1, 184, 'A00106', '4', '1', '1.5', '0', 2),
(185, 1, 185, 'A00107', '5', '1', '0.1', '0', 1),
(186, 1, 186, 'A00108', '1', '1', '67.2', '0', 2),
(187, 1, 187, 'A00109', '2', '1', '54.6', '0', 2),
(188, 1, 188, '7460193510220', '2', '1', '4.5', '0', 5),
(189, 1, 189, '46135147104', '2', '1', '8.75', '0', 5),
(190, 1, 190, 'A00110', '1', '1', '1.15', '0', 2),
(191, 1, 191, 'A00111', '27', '1', '1.15', '0', 2),
(192, 1, 192, '7501206639818', '8', '1', '1.25', '0', 1),
(193, 1, 193, '7501206663370', '2', '1', '5.5', '0', 5),
(194, 1, 194, '75012066993', '3', '1', '7', '0', 5),
(195, 1, 195, '898639001679', '16', '1', '8', '0', 5),
(196, 1, 196, '7501206671924', '-1', '1', '9', '0', 5),
(197, 1, 197, '898639001679', '4', '1', '8', '0', 5),
(198, 1, 198, '898639001150', '2', '1', '8', '0', 5),
(199, 1, 199, '898639001174', '2', '1', '8', '0', 5),
(200, 1, 200, '7506240606970', '1', '1', '3.5', '0', 5),
(201, 1, 201, '7506240606963', '1', '1', '3.5', '0', 5),
(202, 1, 202, '7506240607595', '1', '1', '3.5', '0', 5),
(203, 1, 203, '7506240606987', '1', '1', '3.5', '0', 5),
(204, 1, 204, '7506240607014', '1', '1', '3.5', '0', 5),
(205, 1, 205, '7501206628287', '1', '1', '2', '0', 4),
(206, 1, 206, '501206685358', '13', '1', '1.25', '0', 1),
(207, 1, 207, '7501206685426', '13', '1', '1.25', '0', 1),
(208, 1, 208, 'A00112', '99', '1', '0.9', '0', 1),
(209, 1, 209, '7501206604991', '3', '1', '11.5', '0', 1),
(210, 1, 210, '7501206605004', '4', '1', '15.75', '0', 1),
(211, 1, 211, '7501206688908', '2', '1', '8.5', '0', 4),
(212, 1, 212, 'A00113', '1', '1', '50', '0', 2),
(213, 1, 213, '7453037407558', '1', '1', '10', '0', 2),
(214, 1, 214, '190630520907', '1', '1', '11.5', '0', 2),
(215, 1, 215, 'A00114', '1', '1', '12', '0', 2),
(216, 1, 216, '190615520908', '4', '1', '6.5', '0', 2),
(217, 1, 217, '754802181114', '7', '1', '7.7', '0', 2),
(218, 1, 218, 'A00115', '3', '1', '1', '0', 1),
(219, 1, 219, 'A00116', '100', '1', '0.2', '0', 1),
(220, 1, 220, 'A00117', '10', '1', '0.35', '0', 1),
(221, 1, 221, 'A00118', '20', '1', '0.55', '0', 1),
(222, 1, 222, 'A00119', '5', '1', '0.6', '0', 1),
(223, 1, 223, 'A00120', '11', '1', '0.35', '0', 1),
(224, 1, 224, 'A00121', '25', '1', '0.55', '0', 1),
(225, 1, 225, '7750293000807', '3', '1', '2.25', '0', 6),
(226, 1, 226, '7750293000806', '3', '1', '2.25', '0', 6),
(227, 1, 227, '7750293000814', '6', '1', '2.25', '0', 6),
(228, 1, 228, '7750293000815', '2', '1', '2.6', '0', 6),
(229, 1, 229, 'A00122', '2', '1', '1', '0', 6),
(230, 1, 230, '32664205002', '7', '1', '1.75', '0', 6),
(231, 1, 231, 'A00123', '9', '1', '2.5', '0', 6),
(232, 1, 232, '785007274523', '16', '1', '1.15', '0', 6),
(233, 1, 233, 'A00124', '1', '1', '1.15', '0', 6),
(234, 1, 234, '785007274547', '29', '1', '1.5', '0', 6),
(235, 1, 235, '32664191800', '17', '1', '2.25', '0', 6),
(236, 1, 236, '78316434191', '1', '1', '110.64', '0', 2),
(237, 1, 237, '783164338508', '1', '1', '110.64', '0', 2),
(238, 1, 238, '783164338492', '1', '1', '102.34', '0', 2),
(239, 1, 239, '7501206660423', '1', '1', '5.5', '0', 5),
(240, 1, 240, '7501206661741', '10', '1', '5.5', '0', 1),
(241, 1, 241, '4011209341364', '1', '1', '35', '0', 2),
(242, 1, 242, 'A00125', '16', '1', '1', '0', 1),
(243, 1, 243, 'A00126', '2', '1', '3', '0', 1),
(244, 1, 244, '7501206657270', '9', '1', '1.25', '0', 1),
(245, 1, 245, '7501206658413', '10', '1', '1.15', '0', 1),
(246, 1, 246, 'A00127', '111', '1', '0.25', '0', 2),
(247, 1, 247, 'A00128', '30', '1', '0.15', '0', 2),
(248, 1, 248, 'A00129', '1', '1', '3', '0', 1),
(249, 1, 249, '7501206658239', '1', '1', '1.5', '0', 1),
(250, 1, 250, '7501206658260', '6', '1', '1', '0', 1),
(251, 1, 251, 'A00130', '24', '1', '1.15', '0', 2),
(252, 1, 252, '7501206658208', '5', '1', '1.15', '0', 1),
(253, 1, 253, '7501206658369', '4', '1', '1.15', '0', 1),
(254, 1, 254, '7501206611364', '1', '1', '4', '0', 1),
(255, 1, 255, '7506240630708', '1', '1', '3.25', '0', 1),
(256, 1, 256, '7501206684993', '3', '1', '4', '0', 1),
(257, 1, 257, '7501206631133', '1', '1', '4', '0', 1),
(258, 1, 258, '7501206684986', '2', '1', '4', '0', 1),
(259, 1, 259, '7506240630016', '1', '1', '3.25', '0', 1),
(260, 1, 260, '7501206611388', '2', '1', '4', '0', 1),
(261, 1, 261, '7506240630722', '1', '1', '3.25', '0', 1),
(262, 1, 262, '168645', '5', '1', '3.25', '0', 2),
(263, 1, 263, 'A00131', '1', '1', '0.55', '0', 1),
(264, 1, 264, 'A00132', '1', '1', '0.55', '0', 1),
(265, 1, 265, 'A00133', '5', '1', '0.6', '0', 1),
(266, 1, 266, '4719867213268', '10', '1', '0.15', '0', 1),
(267, 1, 267, '7441109000073', '1', '1', '2.5', '0', 6),
(268, 1, 268, '7441031003531', '15', '1', '3.5', '0', 6),
(269, 1, 269, '7501206658543', '3', '1', '2.5', '0', 6),
(270, 1, 270, 'A00134', '1', '1', '1.15', '0', 1),
(271, 1, 271, 'A00135', '1', '1', '1', '0', 1),
(272, 1, 272, '50169008324', '15', '1', '2.5', '0', 1),
(273, 1, 273, 'A00136', '1', '1', '5', '0', 1),
(274, 1, 274, '7441102804791', '1', '1', '4.5', '0', 1),
(275, 1, 275, '30783643148186', '32', '1', '6.16', '0', 3),
(276, 1, 276, '30783643148193', '40', '1', '6.16', '0', 3),
(277, 1, 277, '30783643148216', '40', '1', '6.99', '0', 3),
(278, 1, 278, 'A00137', '1', '1', '14.47', '0', 3),
(279, 1, 279, '30783643148360', '40', '1', '14.47', '0', 3),
(280, 1, 280, '30783643148384', '37', '1', '14.47', '0', 3),
(281, 1, 281, '30783643148650', '40', '1', '22.47', '0', 3),
(282, 1, 282, '783643148666', '1', '1', '29.44', '0', 3),
(283, 1, 283, '783643263420', '8', '1', '18', '0', 3),
(284, 1, 284, '783643263529', '3', '1', '17.5', '0', 3),
(285, 1, 285, '783643263536', '4', '1', '19.5', '0', 3),
(286, 1, 286, '783643263598', '1', '1', '21', '0', 3),
(287, 1, 287, '783643000933', '1', '1', '35', '0', 3),
(288, 1, 288, 'A00138', '4', '1', '3.15', '0', 1),
(289, 1, 289, 'A00139', '7', '1', '3.15', '0', 1),
(290, 1, 290, 'A00140', '9', '1', '2', '0', 1),
(291, 1, 291, 'A00141', '18', '1', '2.1', '0', 1),
(292, 1, 292, 'A00142', '22', '1', '1.25', '0', 1),
(293, 1, 293, 'A00143', '9', '1', '1.9', '0', 1),
(294, 1, 294, 'A00144', '1', '1', '2.75', '0', 1),
(295, 1, 295, 'A00145', '16', '1', '2.75', '0', 1),
(296, 1, 296, 'A00146', '8', '1', '1.1', '0', 1),
(297, 1, 297, 'A00147', '11', '1', '1.82', '0', 1),
(298, 1, 298, 'A00148', '2', '1', '0.68', '0', 1),
(299, 1, 299, 'A00149', '4', '1', '0.52', '0', 1),
(300, 1, 300, 'A00150', '11', '1', '0.5', '0', 1),
(301, 1, 301, 'A00151', '2', '1', '1.95', '0', 1),
(302, 1, 302, '7501206698853', '23', '1', '0.5', '0', 1),
(303, 1, 303, 'A00152', '107', '1', '0.5', '0', 1),
(304, 1, 304, '739232491', '19', '1', '1.8', '0', 1),
(305, 1, 305, 'A00153', '1', '1', '1.15', '0', 1),
(306, 1, 306, '7501206657478', '14', '1', '1', '0', 6),
(307, 1, 307, '7441109000127', '1', '1', '1.15', '0', 6),
(308, 1, 308, '785007860054', '27', '1', '9.75', '0', 6),
(309, 1, 309, '7501206658574', '5', '1', '2.5', '0', 6),
(310, 1, 310, '32664306303', '1', '1', '3.75', '0', 6),
(311, 1, 311, '7501206658659', '8', '1', '1.5', '0', 6),
(312, 1, 312, '7501206658659', '2', '1', '1.5', '0', 6),
(313, 1, 313, '7855007143041', '2', '1', '19.25', '0', 6),
(314, 1, 314, '7501206659441', '13', '1', '1', '0', 6),
(315, 1, 315, '7441109003753', '1', '1', '3.5', '0', 6),
(316, 1, 316, '32664311000', '2', '1', '2.25', '0', 6),
(317, 1, 317, 'A00154', '1', '1', '3.8', '0', 6),
(318, 1, 318, 'A00155', '1', '1', '4', '0', 6),
(319, 1, 319, '7441031005061', '1', '1', '3.25', '0', 6),
(320, 1, 320, '7501206658581', '4', '1', '2.5', '0', 6),
(321, 1, 321, '7441031003654', '1', '1', '3.5', '0', 6),
(322, 1, 322, 'A00156', '4', '1', '1.25', '0', 6),
(323, 1, 323, 'A00157', '3', '1', '1.75', '0', 6),
(324, 1, 324, 'A00158', '90', '1', '0.1', '0', 1),
(325, 1, 325, '7501206698785', '5', '1', '1.5', '0', 1),
(326, 1, 326, '7501206698792', '4', '1', '2', '0', 1),
(327, 1, 327, '7501206698891', '9', '1', '1.15', '0', 1),
(328, 1, 328, 'A00159', '1', '1', '12', '0', 2),
(329, 1, 329, '780685200017', '6', '1', '3.5', '0', 2),
(330, 1, 330, 'A00160', '1', '1', '3.75', '0', 5),
(331, 1, 331, 'A00161', '2', '1', '3.5', '0', 5),
(332, 1, 332, 'A00162', '5', '1', '3.5', '0', 5),
(333, 1, 333, 'A00163', '16', '1', '2.25', '0', 5),
(334, 1, 334, 'A00164', '6', '1', '0.3', '0', 1),
(335, 1, 335, 'A00165', '15', '1', '0.45', '0', 1),
(336, 1, 336, 'A00166', '48', '1', '0.35', '0', 1),
(337, 1, 337, 'A00167', '7', '1', '0.25', '0', 1),
(338, 1, 338, 'A00168', '2', '1', '0.75', '0', 1),
(339, 1, 339, 'A00169', '23', '1', '0.5', '0', 1),
(340, 1, 340, 'A00170', '2', '1', '1', '0', 1),
(341, 1, 341, 'A00171', '2', '1', '0.25', '0', 1),
(342, 1, 342, 'A00172', '5', '1', '5.75', '0', 1),
(343, 1, 343, 'A00173', '3', '1', '4.75', '0', 1),
(344, 1, 344, 'A00174', '5', '1', '2.5', '0', 1),
(345, 1, 345, 'A00175', '4', '1', '2.25', '0', 1),
(346, 1, 346, 'A00176', '1', '1', '17', '0', 1),
(347, 1, 347, 'A00177', '24', '1', '2.6', '0', 1),
(348, 1, 348, 'A00178', '4', '1', '5.6', '0', 1),
(349, 1, 349, 'A00179', '2', '1', '3.3', '0', 1),
(350, 1, 350, 'A00180', '9', '1', '2.2', '0', 1),
(351, 1, 351, 'A00181', '1', '1', '9', '0', 1),
(352, 1, 352, 'A00182', '6', '1', '8', '0', 1),
(353, 1, 353, 'A00183', '3', '1', '0.25', '0', 1),
(354, 1, 354, 'A00184', '19', '1', '2.25', '0', 1),
(355, 1, 355, 'A00185', '4', '1', '3.5', '0', 1),
(356, 1, 356, 'A00186', '14', '1', '0.25', '0', 1),
(357, 1, 357, '7441102800229', '1', '1', '1.25', '0', 1),
(358, 1, 358, '7441102800205', '3', '1', '1', '0', 1),
(359, 1, 359, '7441102800236', '2', '1', '2.25', '0', 1),
(360, 1, 360, '7441102800267', '3', '1', '0.85', '0', 1),
(361, 1, 361, '1331212021', '6', '1', '1.2', '0', 1),
(362, 1, 362, '1331212024', '4', '1', '3.45', '0', 1),
(363, 1, 363, 'A00187', '25', '1', '0.8', '0', 1),
(364, 1, 364, 'A00188', '16', '1', '2.6', '0', 1),
(365, 1, 365, 'A00189', '10', '1', '0.25', '0', 1),
(366, 1, 366, 'A00190', '8', '1', '6.1', '0', 1),
(367, 1, 367, 'A00191', '4', '1', '2.6', '0', 1),
(368, 1, 368, 'A00192', '1', '1', '4.5', '0', 1),
(369, 1, 369, 'A00193', '4', '1', '5.25', '0', 1),
(370, 1, 370, '741102801967', '5', '1', '0.75', '0', 1),
(371, 1, 371, '7438277833', '445', '2', '83.50', '79.99', 7),
(372, 1, 372, '7438298883', '870', '2', '150', '148', 7);

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
(1, 'Dollar City ', '', '8908080', '8908080', '808080808-0', '898908-08', '', '', '', '', 's'),
(2, 'Soluciones y Herramientas, S A de C V', '', '', '', '', '', '', '', '', '', ''),
(3, 'Soluciones y Herramientas', '', '', '', '', '', '', '', '', '', ''),
(4, 'Freund, S A de C V', '', '', '', '', '', '', '', '', '', ''),
(5, '\"PORTILLO\" Materiales Electricos', '', '', '', '', '', '', '', '', '', ''),
(6, 'SIEMENS, S.A', '', '', '', '', '', '', '', '', '', ''),
(7, 'Eectro Industrial', '', '', '', '', '', '', '', '', '', ''),
(8, 'Pricesmart', '', '', '', '', '', '', '', '', '', ''),
(9, 'Rayovac El Salvador S.A de C.V', '', '', '', '', '', '', '', '', '', ''),
(10, 'La Campi?a # 3', '', '', '', '', '', '', '', '', '', ''),
(11, 'SIMAN S.A. DE C.V.', '', '', '', '', '', '', '', '', '', ''),
(12, 'Goldtree Ferreteria', '', '', '', '', '', '', '', '', '', '');

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
(370, '370', '5');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;
--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `pro_prov`
--
ALTER TABLE `pro_prov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
