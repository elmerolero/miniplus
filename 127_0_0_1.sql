-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-05-2021 a las 05:29:52
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miniplus`
--
CREATE DATABASE IF NOT EXISTS `miniplus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `miniplus`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
CREATE TABLE IF NOT EXISTS `direcciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `calle` varchar(50) NOT NULL,
  `numero` int NOT NULL,
  `numeroInterior` int DEFAULT NULL,
  `colonia` varchar(50) DEFAULT NULL,
  `codigoPostal` int NOT NULL,
  `idPais` int NOT NULL,
  `idEstado` int NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `idUsuario` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idPais` (`idPais`),
  KEY `idEstado` (`idEstado`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `calle`, `numero`, `numeroInterior`, `colonia`, `codigoPostal`, `idPais`, `idEstado`, `municipio`, `descripcion`, `idUsuario`) VALUES
(1, 'Acueducto', 5065, NULL, 'Artesanos', 45598, 123, 15, 'Tlaquepaque', 'Una casa con puertas y ventanas.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'Aguascalientes'),
(2, 'Baja California'),
(3, 'Baja California Sur'),
(4, 'Campeche'),
(5, 'Chiapas'),
(6, 'Chihuahua'),
(7, 'Coahuila'),
(8, 'Colima'),
(9, 'Ciudad de México'),
(10, 'Durango'),
(11, 'Estado de México'),
(12, 'Guanajuato'),
(13, 'Guerrero'),
(14, 'Hidalgo'),
(15, 'Jalisco'),
(16, 'Michoacán'),
(17, 'Morelos'),
(18, 'Nayarit'),
(19, 'Nuevo León'),
(20, 'Oaxaca'),
(21, 'Puebla'),
(22, 'Querétaro'),
(23, 'Quintana Roo'),
(24, 'San Luis Potosí'),
(25, 'Sinaloa'),
(26, 'Sonora'),
(27, 'Tabasco'),
(28, 'Tamaulipas'),
(29, 'Tlaxcala'),
(30, 'Veracruz'),
(31, 'Yucatán'),
(32, 'Zacatecas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `idMovimiento` int NOT NULL AUTO_INCREMENT,
  `idVenta` int NOT NULL,
  `idProducto` int NOT NULL,
  `cantidad` int DEFAULT NULL,
  `realizado` int DEFAULT NULL,
  PRIMARY KEY (`idMovimiento`),
  KEY `idVenta` (`idVenta`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`idMovimiento`, `idVenta`, `idProducto`, `cantidad`, `realizado`) VALUES
(1, 4, 1, 2, 0),
(2, 4, 2, 2, 0),
(3, 4, 0, 0, 0),
(4, 4, 1, 0, 0),
(5, 4, 1, 2, 0),
(6, 4, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `body`) VALUES
(1, 'Elvis sighted', 'elvis-sighted', 'Elvis was sighted at the Podunk internet cafe. It looked like he was writing a CodeIgniter app.'),
(2, 'Say it isn\'t so!', 'say-it-isnt-so', 'Scientists conclude that some programmers have a sense of humor.'),
(3, 'Caffeination, Yes!', 'caffeination-yes', 'World\'s largest coffee shop open onsite nested coffee shop for staff only.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE IF NOT EXISTS `paises` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`) VALUES
(1, 'Afganistán'),
(2, 'Albania'),
(3, 'Alemania'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Antigua y Barbuda'),
(7, 'Arabia Saudita'),
(8, 'Argelia'),
(9, 'Argentina'),
(10, 'Armenia'),
(11, 'Australia'),
(12, 'Austria'),
(13, 'Azerbaiyán'),
(14, 'Bahamas'),
(15, 'Bahrein'),
(16, 'Bangladesh'),
(17, 'Barbados'),
(18, 'Belarús'),
(19, 'Belice'),
(20, 'Benin'),
(21, 'Bhután'),
(22, 'Bolivia'),
(23, 'Bosnia y Herzegovina'),
(24, 'Botswana'),
(25, 'Brasil'),
(26, 'Brunei Darussalam'),
(27, 'Bulgaria'),
(28, 'Burkina Faso'),
(29, 'Burundi'),
(30, 'Bélgica'),
(31, 'Cabo Verde'),
(32, 'Camboya'),
(33, 'Camerún'),
(34, 'Canadá'),
(35, 'Chad'),
(36, 'Chequia'),
(37, 'Chile'),
(38, 'China'),
(39, 'Chipre'),
(40, 'Colombia'),
(41, 'Comoras'),
(42, 'Congo'),
(43, 'Costa Rica'),
(44, 'Croacia'),
(45, 'Cuba'),
(46, 'Côte d\'Ivoire'),
(47, 'Dinamarca'),
(48, 'Djibouti'),
(49, 'Dominica'),
(50, 'Ecuador'),
(51, 'Egipto'),
(52, 'El Salvador'),
(53, 'Emiratos Árabes Unidos'),
(54, 'Eritrea'),
(55, 'Eslovaquia'),
(56, 'Eslovenia'),
(57, 'España'),
(58, 'Estados Unidos de América'),
(59, 'Estonia'),
(60, 'Eswatini'),
(61, 'Etiopía'),
(62, 'Federación de Rusia'),
(63, 'Fiji'),
(64, 'Filipinas'),
(65, 'Finlandia'),
(66, 'Francia'),
(67, 'Gabón'),
(68, 'Gambia'),
(69, 'Georgia'),
(70, 'Ghana'),
(71, 'Granada'),
(72, 'Grecia'),
(73, 'Guatemala'),
(74, 'Guinea'),
(75, 'Guinea Ecuatorial'),
(76, 'Guinea-Bissau'),
(77, 'Guyana'),
(78, 'Haití'),
(79, 'Honduras'),
(80, 'Hungría'),
(81, 'India'),
(82, 'Indonesia'),
(83, 'Iraq'),
(84, 'Irlanda'),
(85, 'Irán'),
(86, 'Islandia'),
(87, 'Islas Cook'),
(88, 'Islas Feroe'),
(89, 'Islas Marshall'),
(90, 'Islas Salomón'),
(91, 'Israel'),
(92, 'Italia'),
(93, 'Jamaica'),
(94, 'Japón'),
(95, 'Jordania'),
(96, 'Kazajstán'),
(97, 'Kenya'),
(98, 'Kirguistán'),
(99, 'Kiribati'),
(100, 'Kuwait'),
(101, 'Lesotho'),
(102, 'Letonia'),
(103, 'Liberia'),
(104, 'Libia'),
(105, 'Lituania'),
(106, 'Luxemburgo'),
(107, 'Líbano'),
(108, 'Macedonia del Norte'),
(109, 'Madagascar'),
(110, 'Malasia'),
(111, 'Malawi'),
(112, 'Maldivas'),
(113, 'Malta'),
(114, 'Malí'),
(115, 'Marruecos'),
(116, 'Mauricio'),
(117, 'Mauritania'),
(118, 'Micronesia'),
(119, 'Mongolia'),
(120, 'Montenegro'),
(121, 'Mozambique'),
(122, 'Myanmar'),
(123, 'México'),
(124, 'Mónaco'),
(125, 'Namibia'),
(126, 'Nauru'),
(127, 'Nepal'),
(128, 'Nicaragua'),
(129, 'Nigeria'),
(130, 'Niue'),
(131, 'Noruega'),
(132, 'Nueva Zelandia'),
(133, 'Níger'),
(134, 'Omán'),
(135, 'Pakistán'),
(136, 'Palau'),
(137, 'Panamá'),
(138, 'Papua Nueva Guinea'),
(139, 'Paraguay'),
(140, 'Países Bajos'),
(141, 'Perú'),
(142, 'Polonia'),
(143, 'Portugal'),
(144, 'Qatar'),
(145, 'Reino Unido de Gran Bretaña e Irlanda del Norte'),
(146, 'República Centroafricana'),
(147, 'República Democrática Popular Lao'),
(148, 'República Democrática del Congo'),
(149, 'República Dominicana'),
(150, 'República Popular Democrática de Corea'),
(151, 'República Unida de Tanzanía'),
(152, 'República de Corea'),
(153, 'República de Moldova'),
(154, 'República Árabe Siria'),
(155, 'Rumania'),
(156, 'Rwanda'),
(157, 'Saint Kitts y Nevis'),
(158, 'Samoa'),
(159, 'San Marino'),
(160, 'San Vicente y las Granadinas'),
(161, 'Santa Lucía'),
(162, 'Santo Tomé y Príncipe'),
(163, 'Senegal'),
(164, 'Serbia'),
(165, 'Seychelles'),
(166, 'Sierra Leona'),
(167, 'Singapur'),
(168, 'Somalia'),
(169, 'Sri Lanka'),
(170, 'Sudáfrica'),
(171, 'Sudán'),
(172, 'Sudán del Sur'),
(173, 'Suecia'),
(174, 'Suiza'),
(175, 'Suriname'),
(176, 'Tailandia'),
(177, 'Tayikistán'),
(178, 'Timor-Leste'),
(179, 'Togo'),
(180, 'Tokelau'),
(181, 'Tonga'),
(182, 'Trinidad y Tabago'),
(183, 'Turkmenistán'),
(184, 'Turquía'),
(185, 'Tuvalu'),
(186, 'Túnez'),
(187, 'Ucrania'),
(188, 'Uganda'),
(189, 'Uruguay'),
(190, 'Uzbekistán'),
(191, 'Vanuatu'),
(192, 'Venezuela'),
(193, 'Viet Nam'),
(194, 'Yemen'),
(195, 'Zambia'),
(196, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int NOT NULL AUTO_INCREMENT,
  `precio` double NOT NULL,
  `nombre` text NOT NULL,
  `imagen` text,
  PRIMARY KEY (`idProducto`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `precio`, `nombre`, `imagen`) VALUES
(1, 50, 'Camiseta pitera', NULL),
(2, 80, 'Pantalones piteros', NULL),
(3, 50, 'Balero', '../recursos/imagenes/60c8c8b0898dc475ef36498b569de777'),
(6, 10, 'Balero', '../recursos/imagenes/921ed27b1c327e0756d7331e6704952b'),
(7, 1500, 'Raspberrypi', '../recursos/imagenes/85c837e2598de20495c4825cae933826');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(20) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `fechaNacimiento` date NOT NULL,
  `correo` varchar(320) NOT NULL,
  `administrador` int DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `usuario` (`nombreUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `contrasena`, `nombre`, `apellidos`, `fechaNacimiento`, `correo`, `administrador`, `fotografia`) VALUES
(1, 'elmerolero', '$2y$12$3jzs5QRm.R0Mb19UYMYRCe29IIhmbVbr2l2LzmlvU4AbwDvWiII2S', 'Ismael', 'Salas López', '1999-03-11', 'isma.salas@outlook.com', 1, '../../recursos/imagenes/default.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `idVenta` int NOT NULL AUTO_INCREMENT,
  `idUsuario` int NOT NULL,
  `fecha` date NOT NULL,
  `realizada` int NOT NULL,
  PRIMARY KEY (`idVenta`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idVenta`, `idUsuario`, `fecha`, `realizada`) VALUES
(4, 1, '2021-05-29', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
