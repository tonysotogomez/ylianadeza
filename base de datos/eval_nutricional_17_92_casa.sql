-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-02-2016 a las 13:58:11
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eval_nutricional`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idAula` int(2) DEFAULT NULL,
  `nro` int(5) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `titular` varchar(250) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `register_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Aula` (`idAula`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `idAula`, `nro`, `nombres`, `apellidos`, `fecha_nacimiento`, `genero`, `titular`, `estado`, `register_at`, `update_at`) VALUES
(1, 1, 0, 'Letizia Isabella', 'ACOSTA AYALA', '2015-08-02', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(2, 1, 0, 'Gisell Naydelin', 'ASCONA MUCHA', '2015-10-21', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(3, 1, 0, 'Bryana Yadhira', 'ASCONA MUCHA', '2015-10-21', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(4, 1, 0, 'Dominic Kyle', 'DOMINGUEZ MENDOZA', '2015-10-13', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(5, 1, 0, 'Jael Mackenzie', 'ESTEBAN MERCADO', '2015-08-09', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(6, 1, 0, 'Matthew Stephano', 'GUILLEN ARANA', '2015-08-20', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(7, 1, 0, 'Mariana Milagritos', 'HUAMAN HARO', '2015-10-05', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(8, 1, 0, 'Antonella Fabiana', 'JOAQUIN HUAMAN ', '2015-08-29', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(9, 1, 0, 'Valery Valentina', 'LOPEZ MENDOZA ', '2015-08-17', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(10, 1, 0, 'Mathias Jharet', 'PEREZ ESPINOZA ', '2015-09-28', 'h', '', 1, '2016-02-16 00:00:00', '2016-02-16 00:00:00'),
(11, 1, 0, 'Dylan Ichiro', 'MORI CHUMPITAZ ', '2015-09-07', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(12, 1, 0, 'Keyla Leahny', 'MUÑOZ ORTEGA', '2015-08-28', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(13, 1, 0, 'Valeria Abigail', 'MAMANI LLAMOCA', '2015-09-21', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(14, 1, 0, 'Angelo Jared', 'PARIONA SUAREZ', '2015-08-14', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(15, 1, 0, 'Samin Israel', 'NAVARRO CONDEZO', '2015-12-27', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(16, 2, 0, 'Mia Luciana', 'BRAVO OROPEZA', '2015-07-06', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(17, 2, 0, 'Lucero Alondra', 'CABRERA RAMOS', '2015-06-04', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(18, 2, 0, 'Yuleysi Aleyda', 'DELGADO PATIÑO', '2015-06-02', 'm', '', 1, '2016-02-16 00:00:00', '2016-02-16 00:00:00'),
(19, 2, 0, 'Jimena Jazmin', 'CHICOMA RODRIGUEZ', '2015-06-26', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(20, 2, 0, 'Luciana Micaela', 'LEON RAMOS', '2015-07-30', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(21, 2, 0, 'Ariana Nicolle', 'LLONTOP CHAFLOQUE', '2015-04-27', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(22, 2, 0, 'Hanna Lucero', 'PAUCAR PEREZ', '2015-05-09', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(23, 2, 0, 'Yuleika Rafaella', 'ROMERO CUETO', '2015-04-06', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(24, 2, 0, 'Emily Andrea', 'SANCHEZ RAMOS', '2015-05-07', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(25, 1, 0, '', 'CONDORI DATHER', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(26, 1, 0, 'Valeria Sofia', 'JORGE ALVAREZ', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(27, 1, 0, 'Pietro Dario', 'LEANDRO CONDORI', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(28, 1, 0, 'Santiago Alessio', 'LEANDRO CONDORI', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(29, 1, 0, 'Alondra Nataniel', 'ORTIZ SANCHEZ', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(30, 1, 0, '', 'SANCHEZ MUÑOZ', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(31, 1, 0, 'Alessia Valeria', 'SOTO HURTADO', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(32, 1, 0, 'Brianna Elizabeth', 'ULLILEN FLORES', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(33, 1, 0, '', 'SANTOS AGAPITO', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(34, 2, 0, '', 'CRUZ LA ROSA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(35, 2, 0, 'Joaquin Aaron', 'EGUSQUIZA ZENDER', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(36, 2, 0, 'Eduardo Jose Tomas', 'HERRERA VILLANUEVA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(37, 2, 0, 'Edrian David', 'LOAYZA BANEO', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(38, 2, 0, 'Alondra Emperatriz', 'LOPEZ AREVALO', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(39, 2, 0, 'Victoria Catalina', 'PASQUEL CAMACHO', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(40, 2, 0, 'Carla Ariana', 'PEREZ SANDOVAL', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(41, 2, 0, 'Zoe Amira', 'SARMIENTO ORELLANA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(42, 2, 0, 'Flavia Ximena', 'TORRES DE LA FUENTE CHAVEZ', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(43, 2, 0, 'Sergio Andre', 'URBINA SOSA ', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(44, 2, 0, 'Ainara Mireya', 'VALENCIA RIVERA', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(45, 2, 0, 'Liham Edison Isai', 'VARGAS OYOLO', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(46, 2, 0, 'Angelo Josue', 'ZAPATA LUNA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(47, 3, 0, 'Valentino', 'ANTEZANA ZAVALA', '2015-02-19', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(48, 3, 0, 'Lya Alice', 'ASAÑA COLAN ', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(49, 3, 0, 'Nicolas Cristopher', 'CANDUELAS PAREDES', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(50, 3, 0, 'Monica Brunella', 'CASTRO MAGALLANAES', '2015-02-22', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(51, 3, 0, 'Joaquin Mateo', 'DIAZ QUISPE', '2015-02-24', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(52, 3, 0, 'Jeiko Loeonel', 'ESPINOZA HUAMAN', '2015-02-23', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(53, 3, 0, 'Enzo Valentino', 'FUENTES RIVERA DAVILA', '2015-03-02', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(54, 3, 0, 'Joshue Valentino', 'JURO RAMIREZ', '2015-02-27', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(55, 3, 0, 'Jesus Samuel ', 'MARTINEZ DIAZ', '2015-03-18', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(56, 3, 0, 'Gracia Miranda', 'MARZANO CHUICA', '2015-02-25', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(57, 3, 0, 'Yaiza Rousse', 'MAURICIO ORTEGA', '2015-03-23', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(58, 3, 0, 'Alejandra Camila', 'MORALES ESPINOZA', '2015-03-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(59, 3, 0, 'Thiago Patricio', 'OSCCORIMA BENDEZU', '2015-02-26', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(60, 3, 0, 'Illari Jazmin', 'PALOMINO VILCA', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', '2016-02-16 00:00:00'),
(61, 3, 0, 'Fabio Emanuel', 'PEDRAZA MERINO', '2015-03-26', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(62, 3, 0, 'Gianella Celeste', 'QUICIO CORZO', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(63, 3, 0, 'Delia Valentina', 'RODRIGUEZ RANTES', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(64, 3, 0, 'Pablo Caleb', 'ROSALES GAMARRA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(65, 3, 0, 'Stephano Alessandro', 'SALDAÑA PONCE', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(66, 3, 0, 'Matías Rafael', 'SAONA SILVA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(67, 3, 0, 'Ricardo', 'ZAPATA CRUZ', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(68, 4, 0, 'Danaeli del Pilar', 'ARBAIZA PINO', '2014-12-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(69, 4, 0, 'Dylan Miguel', 'AVILA NAVARRO', '2014-12-28', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(70, 4, 0, 'Alexander Ichiro', 'CHUMBE BEDRIÑANA,', '2015-01-21', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(71, 4, 0, 'Brunella Franchesca', 'CORDOVA YOPLAC', '2015-01-28', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(72, 4, 0, 'Caleb Alan Mathias', 'DEL AGUILA HUAROC', '2015-01-28', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(73, 4, 0, 'Arlet Briana', 'DIOSES BEDÓN', '2015-01-19', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(74, 4, 0, 'Jenifer Masiel', 'JAVIER ALCANTARA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(75, 4, 0, 'Adriano Jered', 'JIRON CCAHUANA', '2014-12-25', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(76, 4, 0, 'Luanna Paola', 'MALDONADO BAYONA', '2014-12-06', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(77, 4, 0, 'George Anthony del Piero', 'MENDOZA DEL AGUILA', '2014-12-26', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(78, 4, 0, 'Aldo Matias', 'PALHUA LECARO', '2015-01-09', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(79, 4, 0, 'Emerson Valentin', 'PINO VERA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(80, 4, 0, ' Nickole Almendra', 'ROJAS ACERO', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(81, 4, 0, 'Kate Giamille', 'ROSALES CABRERA', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(82, 4, 0, 'Celeste Alessandra', 'TORRES ALEJANDRO', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(83, 4, 0, 'Leandro Leonardo', 'TORRES QUINTANA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(84, 4, 0, 'Pablo André', 'TREJO MONDRAGON', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(85, 4, 0, 'Matias Gabriel', 'VIGO PANTA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(86, 4, 0, 'Dayanna Abigail', 'VILCHEZ ARELLANO', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(87, 4, 0, 'Adriana Isabel', 'ZARATE AQUINO', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', '2016-02-16 00:00:00'),
(88, 4, 0, 'Omar Alejandro', 'PALHUA LECARO', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(89, 5, 0, 'Luciana Sofía', 'ALVA REQUEJO', '2014-12-26', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(90, 5, 0, 'Christiams Sahid', 'ALVARADO DE LA PUENTE', '2014-10-07', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(91, 5, 0, 'Emily Alexandra', 'ARAUJO OSORIO', '2014-11-26', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(92, 5, 0, ' Saul Felipe', 'BALLONA BARRIENTOS', '2014-12-02', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(93, 5, 0, 'Gia Namiko', 'CASTILLO REYES', '2014-12-07', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(94, 5, 0, 'Yaritza Flavia', 'CORNEJO PUMA', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', '2016-02-16 00:00:00'),
(95, 5, 0, 'Araceli Daniela', 'DAGA CAMPOS', '2014-11-26', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(96, 5, 0, 'Carly Crisel', 'ESCOBEDO MEDINA', '2014-11-21', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(97, 5, 0, ' Adriana Alcira', 'FONSECA LIMAYMANTA', '2014-12-11', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(98, 5, 0, 'Fabrizio Salvador', 'HUAMAN VARILLAS', '2014-11-19', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(99, 5, 0, 'Evans Andriw', 'HURTADO YRIGOIN', '2014-10-07', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(100, 5, 0, 'Celeste Nicolle', 'LOPEZ ANGELES', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(101, 5, 0, 'Matías Joaquín', 'NAJARRO GONZÁLES', '2014-10-06', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(102, 5, 0, 'Matheo Alejandro', 'NIMA BEJARANO', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(103, 5, 0, 'Nicolás Bryan', 'PILCO ZEVALLOS', '2014-11-21', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(104, 5, 0, ' Fabiola Abigail', 'SALAS BRAVO', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(105, 5, 0, 'Emily Gia Gloria', 'SARAVIA MEJÍA', '2014-12-09', 'm', '', 1, '2016-02-16 00:00:00', NULL),
(106, 5, 0, ' Benjamin Micael', 'SORIA GUERRA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(107, 5, 0, ' Kiara Alesea Aynara', 'SUCASAIRE FERROÑAN', '1970-01-01', 'm', '', 1, '2016-02-16 00:00:00', '2016-02-16 00:00:00'),
(108, 5, 0, 'Liam Iker Isay', 'URIOL TIMANA', '1970-01-01', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(109, 5, 0, ' Alejandro Mikhail', 'VASQUEZ ISUIZA', '2014-11-30', 'h', '', 1, '2016-02-16 00:00:00', NULL),
(110, 6, 0, 'Mathew', 'ACUÑA CASTRO', '2014-09-01', 'm', '', 1, '2016-02-17 00:00:00', '2016-02-17 00:00:00'),
(111, 6, 0, 'Arely Marjhoret', 'CASTROMONTE VALENTIN', '1970-01-01', 'm', '', 0, '2016-02-17 00:00:00', '2016-02-17 00:00:00'),
(112, 6, 0, 'Sophia Alessandra Jesús', 'CUELLAR MORENO', '2014-09-30', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(113, 6, 0, 'Fabrizio Rodrigo', 'DAVILA FIGUEROA', '2014-08-26', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(114, 6, 0, 'Vania Sofia', 'GARCÍA VILLEGAS', '2014-08-19', 'm', '', 1, '2016-02-17 00:00:00', '2016-02-17 00:00:00'),
(115, 6, 0, 'Rafael Sebastian', 'GOMEZ ZEVALLOS', '2014-07-16', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(116, 6, 0, 'Nicolas Karim', 'HORNA BOLO', '2014-10-04', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(117, 6, 0, 'Sebastián Antonio', 'MACEDO CALLO', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', '2016-02-17 00:00:00'),
(118, 6, 0, 'Dylan Jesús', 'MILLA HURTADO', '2014-09-16', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(119, 6, 0, 'Joaquín Andre', 'MOSTORINO ROMERO', '2014-08-23', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(120, 6, 0, 'Liam Eduardo', 'PAUCARCHUCO JUSTO', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', '2016-02-17 00:00:00'),
(121, 6, 0, 'Leonell Antonio', 'PEÑA ROSALES', '2014-07-23', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(122, 6, 0, 'Hazel Ester', 'PINEDA HUALLPA', '2014-08-23', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(123, 6, 0, 'Franco Alexis', 'REYMUNDO BRAVO', '2014-07-07', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(124, 6, 0, 'Kamilah Asenet', 'SANTOS SALAS', '2014-10-10', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(125, 6, 0, 'Mathias Alberto de la luz', 'SARAVIA VEGA', '2014-09-27', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(126, 6, 0, 'Ysabella Gisele', 'SINCHI SILVA', '2014-11-22', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(127, 6, 0, 'Antonella Isabel', 'SORIA HUAMAN', '2014-09-30', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(128, 6, 0, 'Camila Valentina', 'VASQUEZ CCONISLLA', '1970-01-01', 'm', '', 0, '2016-02-17 00:00:00', '2016-02-17 00:00:00'),
(129, 6, 0, 'Emir James', 'VELASQUE FLORES', '2014-07-12', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(130, 6, 0, 'Dayanna Alexandra', 'VINCES CORONADO', '2014-09-16', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(131, 6, 0, 'Mares Francesca', 'ZAVALETA VIGO', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', '2016-02-17 00:00:00'),
(132, 7, 0, 'Richard Thailer', 'CADILLO SUCA', '2014-06-08', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(133, 7, 0, 'Natalia Mariel', 'CAYO SALVADOR', '1970-01-01', 'm', '', 0, '2016-02-17 00:00:00', NULL),
(134, 7, 0, 'Rodrigo Alonso', 'CHAVEZ VERIA', '2014-04-10', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(135, 7, 0, 'Jessica Milagros', 'CUSQUI RAMON', '2014-04-23', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(136, 7, 0, 'Madock Raziel', 'DE LAS CASAS DE LOS SANTOS', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', NULL),
(137, 7, 0, 'Mauricio Joshua', 'EULOGIO MALLQUI', '2014-06-26', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(138, 7, 0, 'Alejandra Sofía', 'GONZÁLES APARCO', '2014-04-09', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(139, 7, 0, 'Briana Mayte', 'INFANTE CALISAYA', '1970-01-01', 'm', '', 0, '2016-02-17 00:00:00', NULL),
(140, 7, 0, 'Anabel Mery', 'MEGO SOBERON', '2014-07-11', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(141, 7, 0, 'Kristell Camila', 'MENDOZA ACARAPI', '2014-07-07', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(142, 7, 0, 'Sebastian Jean Paul', 'NUÑEZ VILCHEZ', '2014-05-11', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(143, 7, 0, 'Gianella Haydee', 'PANTA SILVA', '2014-05-17', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(144, 7, 0, 'Joaquin Andrre', 'PAREDES SALDAÑA', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', NULL),
(145, 7, 0, 'Ivana Valentina', 'REYMUNDO ROSILLO', '2014-04-23', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(146, 7, 0, 'Samir Andree', 'ROJAS REMITTI', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', NULL),
(147, 7, 0, 'Natalia Domenica', 'TRISTAN OJEDA', '2014-05-26', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(148, 7, 0, 'William Alexander', 'URBINA ORIHUELA', '2014-05-13', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(149, 7, 0, 'David Caleb', 'VARGAS OLIVA', '2014-05-08', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(150, 7, 0, 'Jesús Daniel', 'VENAVENTE QUISPE', '2014-06-07', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(151, 7, 0, 'Kristel ', 'YAURI RAYO', '1970-01-01', 'm', '', 0, '2016-02-17 00:00:00', NULL),
(152, 8, 0, 'Eduardo Alexander', 'ACCHO GUZMAN', '2013-10-21', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(153, 8, 0, 'Ariana Alessia', 'ARZOLA LABAN', '2014-01-17', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(154, 8, 0, 'Gia Mahal', 'ASPARRIN ARÉVALO', '2014-03-01', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(155, 8, 0, 'Jeyko del Piero', 'CABALLERO TORRES', '2014-01-29', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(156, 8, 0, 'Thiago Gean Pierre', 'CARDENAS JARES', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', NULL),
(157, 8, 0, 'Gianfranco Martin', 'CASTELLANO MENDOZA', '2013-11-03', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(158, 8, 0, 'Paola Dafne', 'CHIROQUE HUABLOCHO', '2013-12-03', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(159, 8, 0, 'Cody Lionel', 'CONDORI RAMOS', '2013-04-12', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(160, 8, 0, 'Luciana Angyel Milagros', 'CRUZ SEMINARIO', '1970-01-01', 'm', '', 0, '2016-02-17 00:00:00', NULL),
(161, 8, 0, 'Yeira Antonella', 'DELGADO PATIÑO', '2014-03-17', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(162, 8, 0, 'Marcelo Jesús', 'FUERTE LÓPEZ', '2014-01-14', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(163, 8, 0, 'Zoe Fernanda', 'GUERRERO ROGEL', '2013-11-09', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(164, 8, 0, 'Weyder Adriano', 'LAOPA YUPANQUI', '2013-09-17', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(165, 8, 0, 'Yadira Nicole', 'LLANCARI VALENCIA', '2013-09-16', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(166, 8, 0, 'Itzel Anette', 'MARTINEZ ROJAS', '2013-06-22', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(167, 8, 0, 'Thiago Leonel', 'NUÑEZ LLANOS', '2013-06-20', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(168, 8, 0, 'Gaelle Natzumi', 'RODRIGUEZ HUAMÁN', '2013-08-12', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(169, 8, 0, 'Fatima Valeria', 'ROMERO JUSTINIANO', '2014-03-10', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(170, 8, 0, 'Amir Jassiel', 'SAENZ REYES', '2014-02-28', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(171, 8, 0, 'Angelo Fernándo', 'SIHUAY CHAVEZ', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', NULL),
(172, 8, 0, 'Valentino Amir', 'VALLES DIAZ', '2013-10-02', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(173, 8, 0, 'Luis Stephano', 'VÁSQUEZ GARAYAR', '2013-04-08', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(174, 8, 0, 'Cattleya', 'ZAPATA RUMICHE', '2014-03-13', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(175, 8, 0, 'Areliz Cristina', 'ZAVALA CASTRO', '1970-01-01', 'm', '', 0, '2016-02-17 00:00:00', NULL),
(176, 9, 0, 'Rafael Franchesco', 'AGUILAR NAVA', '2013-10-27', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(177, 9, 0, 'Benjamín Angel Alonso', 'ALBERCA CABRERA', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', NULL),
(178, 9, 0, 'Franco Gabriel', 'APAESTEGUI LAGUNA', '2013-06-01', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(179, 9, 0, 'Vania Nahomy', 'ANYOSA CAMPOS', '2013-10-29', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(180, 9, 0, 'Izabela Mayza', 'CORAL NAVARRO', '2014-02-07', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(181, 9, 0, 'Yaretzi Suemy', 'ECHE ROJAS', '1970-01-01', 'm', '', 0, '2016-02-17 00:00:00', '2016-02-17 00:00:00'),
(182, 9, 0, 'William Adriano', 'ESCALANTE CÁRDENAS', '2013-06-05', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(183, 9, 0, 'Jhon Jared Alessandro', 'GARAY CORNEJO', '2014-03-24', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(184, 9, 0, 'Naisha Rosa Nirali', 'GUEVARA ARENAS', '2013-11-12', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(185, 9, 0, 'Hannoh David Andre', 'HUAPAYA RAMOS', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', NULL),
(186, 9, 0, 'Almendra Camila', 'INGA HUALLANCA', '2014-03-10', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(187, 9, 0, 'Fabianna Alessandra', 'LIVONI SEGURA', '2014-01-14', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(188, 9, 0, 'Fabian', 'MARCHENA VALVERDE', '2014-02-03', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(189, 9, 0, 'Emily Sue', 'MEZONES LUQUE', '2014-03-28', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(190, 9, 0, 'Yolvi Alessandro', 'MONTES TRAVERSO', '1970-01-01', 'h', '', 0, '2016-02-17 00:00:00', NULL),
(191, 9, 0, 'Thiago Stephano', 'MOREYRA PERFECTO', '2014-02-19', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(192, 9, 0, 'Romina Valentina', 'MOZOMBITE MARCOS', '2013-05-29', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(193, 9, 0, 'Victoria Yashin', 'ORE ZUÑIGA, RACHELL', '2013-10-10', 'm', '', 1, '2016-02-17 00:00:00', '2016-02-17 00:00:00'),
(194, 9, 0, 'Valeska Kelita', 'PALOMINO DIAZ', '2013-11-20', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(195, 9, 0, 'Angelina Brianna', 'PELAEZ SANDOVAL', '2013-04-27', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(196, 9, 0, 'Thais Analí', 'PERALTA MOSQUERA', '2014-03-02', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(197, 9, 0, 'Thiago Alessandro', 'PEREZ GONZÁLES', '2013-10-13', 'h', '', 1, '2016-02-17 00:00:00', NULL),
(198, 9, 0, 'Guisel Valentina', 'TASAYCO YATACO', '2013-07-10', 'm', '', 1, '2016-02-17 00:00:00', NULL),
(199, 9, 0, 'Leonel Aldair', 'TUNI RAMOS', '2014-01-23', 'h', '', 1, '2016-02-17 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE IF NOT EXISTS `aula` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `idTipo` int(1) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `Observacion` varchar(100) NOT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Tipo` (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`id`, `idTipo`, `nombre`, `Observacion`, `estado`) VALUES
(1, 1, 'Caracolitos Alegres', '5 a 8 meses', 1),
(2, 1, 'Pececitos Amorosos', '9 a 12 meses', 1),
(3, 2, 'Pollitos Ordenados', '1 año - 1 año 1 mes', 1),
(4, 2, 'Patitos Amistosos', '1 año 2 meses - 1 año 3 meses', 1),
(5, 2, 'Pajaritos Obedientes', '1 año 4 meses – 1 año 5 meses', 1),
(6, 2, 'Pingüinitos Respetuosos', '1 año 6 meses – 1 año 8 meses', 1),
(7, 3, 'Conejitos Amables', '1 año 9 meses – 1 año 11 meses', 1),
(8, 3, 'Ardillitas Laboriosas', '', 1),
(9, 3, 'Tortuguitas Generosas', '', 1),
(10, 3, 'Gatitos Eficientes', '', 1),
(11, 3, 'Ositos Sinceros', '', 1),
(12, 4, 'Leoncitos Responsables', '', 1),
(13, 4, 'Canguritos Creativos', '', 1),
(14, 4, 'Caballitos Solidarios', '', 1),
(15, 4, 'Elefantitos Perseverantes', '', 1),
(17, 1, 'Prueba', 'Aula de prueba', 1),
(33, 4, 'Jirafitas Honestas', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_evaluacion`
--

CREATE TABLE IF NOT EXISTS `detalle_evaluacion` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(10) NOT NULL,
  `idAlumno` int(5) NOT NULL,
  `edad` float(4,2) DEFAULT NULL,
  `peso` float(6,2) DEFAULT NULL,
  `talla` float(6,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `diagnosticoTE` varchar(250) DEFAULT NULL COMMENT 'Talla para la Edad',
  `diagnosticoPE` varchar(250) DEFAULT NULL COMMENT 'Peso para la Edad',
  `diagnosticoPT` varchar(250) DEFAULT NULL COMMENT 'Peso para la Talla',
  `observaciones` text,
  `estado` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Alumno` (`idAlumno`),
  KEY `Evaluacion` (`idEvaluacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edad`
--

CREATE TABLE IF NOT EXISTS `edad` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `idTipo` int(1) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `cantidad` float(4,2) NOT NULL,
  `meses` int(3) DEFAULT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `TipoAlumno` (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Volcado de datos para la tabla `edad`
--

INSERT INTO `edad` (`id`, `idTipo`, `nombre`, `cantidad`, `meses`, `estado`) VALUES
(1, 1, 'no nace', 0.00, 0, 1),
(2, 1, '1 mes', 0.01, 1, 1),
(3, 1, '2 meses', 0.02, 2, 1),
(5, 1, '3 meses', 0.03, 3, 1),
(6, 1, '4 meses', 0.04, 4, 1),
(7, 1, '5 meses', 0.05, 5, 1),
(8, 1, '6 meses', 0.06, 6, 1),
(9, 1, '7 meses', 0.07, 7, 1),
(10, 1, '8 meses', 0.08, 8, 1),
(11, 1, '9 meses', 0.09, 9, 1),
(12, 1, '10 meses', 0.10, 10, 1),
(13, 1, '11 meses', 0.11, 11, 1),
(14, 1, '1 año', 1.00, 12, 1),
(15, 1, '1 año 1 mes', 1.01, 13, 1),
(16, 1, '1 año 2 meses', 1.02, 14, 1),
(17, 1, '1 año 3 meses', 1.03, 15, 1),
(18, 1, '1 año 4 meses', 1.04, 16, 1),
(20, 1, '1 año 5 meses', 1.05, 17, 1),
(21, 1, '1 año 6 meses', 1.06, 18, 1),
(22, 1, '1 año 7 meses', 1.07, 19, 1),
(23, 1, '1 año 8 meses', 1.08, 20, 1),
(24, 1, '1 año 9 meses', 1.09, 21, 1),
(25, 1, '1 año 10 meses', 1.10, 22, 1),
(26, 1, '1 año 11 meses', 1.11, 23, 1),
(27, 1, '2 años', 2.00, 24, 1),
(28, 1, NULL, 2.01, 25, 1),
(29, 1, NULL, 2.02, 26, 1),
(30, 1, NULL, 2.03, 27, 1),
(31, 1, NULL, 2.04, 28, 1),
(32, 1, NULL, 2.05, 29, 1),
(33, 1, NULL, 2.06, 30, 1),
(34, 1, NULL, 2.07, 31, 1),
(35, 1, NULL, 2.08, 32, 1),
(36, 1, NULL, 2.09, 33, 1),
(37, 1, NULL, 2.10, 34, 1),
(38, 1, NULL, 2.11, 35, 1),
(39, 1, NULL, 3.00, 36, 1),
(40, 1, NULL, 3.01, NULL, 1),
(41, 1, NULL, 3.02, NULL, 1),
(42, 1, NULL, 3.03, NULL, 1),
(43, 1, NULL, 3.04, NULL, 1),
(44, 1, NULL, 3.05, NULL, 1),
(45, 1, NULL, 3.06, NULL, 1),
(46, 1, NULL, 3.07, NULL, 1),
(47, 1, NULL, 3.09, NULL, 1),
(48, 1, NULL, 3.10, NULL, 1),
(49, 1, NULL, 3.11, NULL, 1),
(50, 1, NULL, 4.00, NULL, 1),
(51, 1, NULL, 4.01, NULL, 1),
(52, 1, NULL, 4.02, NULL, 1),
(53, 1, NULL, 4.03, NULL, 1),
(54, 1, NULL, 4.04, NULL, 1),
(55, 1, NULL, 4.05, NULL, 1),
(56, 1, NULL, 4.06, NULL, 1),
(57, 1, NULL, 4.07, NULL, 1),
(58, 1, NULL, 4.08, NULL, 1),
(59, 1, NULL, 4.09, NULL, 1),
(60, 1, NULL, 4.10, NULL, 1),
(61, 1, NULL, 4.11, NULL, 1),
(62, 1, NULL, 5.00, NULL, 1),
(63, 1, NULL, 5.01, NULL, 1),
(64, 1, NULL, 5.02, NULL, 1),
(65, 1, NULL, 5.03, NULL, 1),
(66, 1, NULL, 5.04, NULL, 1),
(67, 1, NULL, 5.05, NULL, 1),
(68, 1, NULL, 5.06, NULL, 1),
(69, 1, NULL, 5.07, NULL, 1),
(70, 1, NULL, 5.08, NULL, 1),
(71, 1, NULL, 5.09, NULL, 1),
(72, 1, NULL, 5.10, NULL, 1),
(73, 1, NULL, 5.11, NULL, 1),
(74, 1, NULL, 6.00, NULL, 1),
(75, 1, 'falta', 0.00, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idAula` int(5) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `observacion` text,
  `estado` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `Aula` (`idAula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peso_edad_h`
--

CREATE TABLE IF NOT EXISTS `peso_edad_h` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `edad` float(3,2) DEFAULT NULL,
  `meses` int(3) DEFAULT NULL,
  `DE3menos` float(5,1) DEFAULT NULL,
  `DE2menos` float(5,1) DEFAULT NULL,
  `DE1menos` float(5,1) DEFAULT NULL,
  `Mediana` float(5,1) DEFAULT NULL,
  `DE1` float(5,1) DEFAULT NULL,
  `DE2` float(5,1) DEFAULT NULL,
  `DE3` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Volcado de datos para la tabla `peso_edad_h`
--

INSERT INTO `peso_edad_h` (`id`, `edad`, `meses`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 0.00, 0, 2.1, 2.5, 2.9, 3.3, 3.9, 4.4, 5.0),
(2, 0.01, 1, 2.9, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6),
(3, 0.02, 2, 3.8, 4.3, 4.9, 5.6, 6.3, 7.1, 8.0),
(4, 0.03, 3, 4.4, 5.0, 5.7, 6.4, 7.2, 9.0, 9.0),
(5, 0.04, 4, 4.9, 5.6, 6.2, 7.0, 7.8, 8.7, 9.7),
(6, 0.05, 5, 5.3, 6.0, 6.7, 7.5, 8.4, 9.3, 10.4),
(7, 0.06, 6, 5.7, 6.4, 7.1, 7.9, 8.8, 9.8, 10.9),
(8, 0.07, 7, 5.9, 6.7, 4.0, 8.3, 9.2, 10.3, 11.4),
(9, 0.08, 8, 6.2, 6.9, 7.7, 8.6, 9.6, 10.7, 11.9),
(10, 0.09, 9, 6.4, 7.1, 8.0, 8.9, 9.9, 11.0, 12.3),
(11, 0.10, 10, 6.6, 7.4, 8.2, 9.2, 10.2, 11.4, 12.7),
(12, 0.11, 11, 6.8, 7.5, 8.4, 9.4, 10.5, 11.7, 13.0),
(13, 1.00, 12, 6.9, 7.7, 8.6, 9.6, 10.8, 12.0, 13.3),
(14, 1.01, 13, 7.1, 7.9, 8.8, 9.9, 11.0, 12.3, 13.7),
(15, 1.02, 14, 7.2, 8.1, 9.0, 10.1, 11.3, 12.6, 14.0),
(16, 1.03, 15, 7.4, 8.3, 9.2, 10.3, 11.5, 12.8, 14.3),
(17, 1.04, 16, 7.5, 8.4, 9.4, 10.5, 11.7, 13.1, 14.6),
(18, 1.05, 17, 7.7, 8.6, 9.6, 10.7, 12.0, 13.4, 14.9),
(19, 1.06, 18, 7.8, 8.8, 9.8, 10.9, 12.2, 13.7, 15.3),
(20, 1.07, 19, 8.0, 8.9, 10.0, 11.1, 12.5, 13.9, 15.6),
(21, 1.08, 20, 8.1, 9.1, 10.1, 11.3, 12.7, 14.2, 15.9),
(22, 1.09, 21, 8.2, 9.2, 10.3, 11.5, 12.9, 14.5, 16.2),
(23, 1.10, 22, 8.4, 9.4, 10.5, 11.8, 13.2, 14.7, 16.5),
(24, 1.11, 23, 8.5, 9.5, 10.7, 12.0, 13.4, 15.0, 16.8),
(25, 2.00, 24, 8.6, 9.7, 10.8, 12.2, 13.6, 15.3, 17.1),
(26, 2.01, 25, 8.8, 9.8, 11.0, 12.4, 13.9, 15.5, 17.5),
(27, 2.02, 26, 8.9, 10.0, 112.0, 12.5, 14.1, 15.8, 17.8),
(28, 2.03, 27, 9.0, 10.1, 11.3, 12.7, 14.3, 16.1, 18.1),
(29, 2.04, 28, 9.1, 10.2, 11.5, 12.9, 14.5, 16.3, 18.4),
(30, 2.05, 29, 9.2, 10.4, 11.7, 13.1, 14.8, 16.6, 18.7),
(31, 2.06, 30, 9.4, 10.5, 11.8, 13.3, 15.0, 16.9, 19.0),
(32, 2.07, 31, 9.5, 10.7, 12.0, 13.5, 15.2, 17.1, 19.3),
(33, 2.08, 32, 9.6, 10.8, 12.1, 13.7, 15.4, 17.4, 19.6),
(34, 2.09, 33, 9.7, 10.9, 12.3, 13.8, 15.6, 17.6, 19.9),
(35, 2.10, 34, 9.8, 11.0, 12.4, 14.0, 15.8, 17.8, 20.2),
(36, 2.11, 35, 9.9, 11.2, 12.6, 14.2, 16.0, 18.1, 20.4),
(37, 3.00, 36, 10.0, 11.3, 12.7, 14.3, 16.2, 18.3, 20.7),
(38, 3.01, 37, 10.1, 11.4, 12.9, 14.5, 16.4, 18.6, 21.0),
(39, 3.02, 38, 10.2, 11.5, 13.0, 14.7, 16.6, 18.8, 21.3),
(40, 3.03, 39, 10.3, 11.6, 13.1, 14.8, 16.8, 19.0, 21.6),
(41, 3.04, 40, 10.4, 11.8, 413.3, 15.0, 17.0, 19.3, 21.9),
(42, 3.05, 41, 10.5, 11.9, 13.4, 15.2, 17.2, 19.5, 22.1),
(43, 3.06, 42, 10.6, 12.0, 13.6, 15.3, 17.4, 19.7, 22.4),
(44, 3.07, 43, 10.7, 21.1, 13.7, 15.5, 17.6, 20.0, 22.7),
(45, 3.08, 44, 10.8, 12.2, 13.8, 15.7, 17.8, 20.2, 23.0),
(46, 3.09, 45, 10.9, 12.4, 14.0, 15.8, 18.0, 20.5, 23.3),
(47, 3.10, 46, 11.0, 12.5, 14.1, 16.0, 18.2, 20.7, 23.6),
(48, 3.11, 47, 11.1, 12.6, 14.3, 16.2, 18.4, 20.9, 23.9),
(49, 4.00, 48, 11.2, 12.7, 14.4, 16.3, 18.6, 21.2, 24.2),
(50, 4.01, 49, 11.3, 12.8, 14.5, 16.5, 18.8, 21.4, 24.5),
(51, 4.02, 50, 11.4, 12.9, 14.7, 16.7, 19.0, 21.7, 24.8),
(52, 4.03, 51, 11.5, 13.1, 14.8, 16.8, 19.2, 21.9, 25.1),
(53, 4.04, 52, 11.6, 13.2, 15.0, 17.0, 19.4, 22.2, 25.4),
(54, 4.05, 53, 11.7, 13.3, 15.1, 17.2, 19.6, 22.4, 25.7),
(55, 4.06, 54, 11.8, 13.4, 15.2, 17.3, 19.8, 22.7, 26.0),
(56, 4.07, 55, 11.9, 13.5, 15.4, 17.5, 20.0, 22.9, 26.3),
(57, 4.08, 56, 12.0, 13.6, 15.5, 17.7, 20.2, 23.2, 26.6),
(58, 4.09, 57, 12.1, 13.7, 15.6, 17.8, 20.4, 23.4, 26.9),
(59, 4.10, 58, 12.2, 13.8, 15.8, 18.0, 20.6, 23.7, 27.2),
(60, 4.11, 59, 12.3, 14.0, 15.9, 18.2, 20.8, 23.9, 27.6),
(61, 5.00, 60, 12.4, 14.1, 16.0, 18.3, 21.0, 24.2, 27.9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peso_edad_m`
--

CREATE TABLE IF NOT EXISTS `peso_edad_m` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `edad` float(3,2) DEFAULT NULL,
  `meses` int(3) DEFAULT NULL,
  `DE3menos` float(5,1) DEFAULT NULL,
  `DE2menos` float(5,1) DEFAULT NULL,
  `DE1menos` float(5,1) DEFAULT NULL,
  `Mediana` float(5,1) DEFAULT NULL,
  `DE1` float(5,1) DEFAULT NULL,
  `DE2` float(5,1) DEFAULT NULL,
  `DE3` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Volcado de datos para la tabla `peso_edad_m`
--

INSERT INTO `peso_edad_m` (`id`, `edad`, `meses`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 0.00, 0, 2.0, 2.4, 2.8, 3.2, 3.7, 4.2, 4.6),
(2, 0.01, 1, 2.7, 3.2, 3.6, 4.2, 4.8, 5.5, 6.2),
(3, 0.02, 2, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6, 7.5),
(4, 0.03, 3, 4.0, 4.5, 5.2, 5.8, 6.6, 7.5, 8.5),
(5, 0.04, 4, 4.4, 5.0, 5.7, 6.4, 7.3, 8.2, 9.3),
(6, 0.05, 5, 4.8, 5.4, 6.1, 6.9, 7.8, 8.8, 10.0),
(7, 0.06, 6, 5.1, 5.7, 6.5, 7.6, 8.2, 9.3, 10.6),
(8, 0.07, 7, 5.3, 6.0, 6.8, 7.6, 8.6, 9.8, 11.1),
(9, 0.08, 8, 5.6, 6.3, 7.0, 7.9, 9.0, 10.2, 11.6),
(10, 0.09, 9, 5.8, 6.5, 7.3, 8.2, 9.3, 10.5, 12.0),
(11, 0.10, 10, 5.9, 6.7, 7.5, 8.5, 9.6, 10.9, 12.4),
(12, 0.11, 11, 6.1, 6.9, 7.7, 8.7, 9.9, 11.2, 12.8),
(13, 1.00, 12, 6.3, 7.0, 7.9, 8.9, 10.1, 11.5, 13.1),
(14, 1.01, 13, 6.4, 7.2, 8.1, 9.2, 10.4, 11.8, 13.5),
(15, 1.02, 14, 6.6, 7.4, 8.3, 9.4, 10.6, 12.1, 13.8),
(16, 1.03, 15, 6.7, 7.6, 8.5, 9.6, 10.9, 12.4, 14.1),
(17, 1.04, 16, 6.9, 7.7, 8.7, 9.8, 11.1, 12.6, 14.5),
(18, 1.05, 17, 7.0, 7.9, 8.9, 10.0, 11.4, 12.9, 14.8),
(19, 1.06, 18, 7.2, 8.1, 9.1, 10.2, 11.6, 13.2, 15.1),
(20, 1.07, 19, 7.3, 8.2, 9.2, 10.4, 11.8, 13.5, 15.4),
(21, 1.08, 20, 7.5, 8.4, 9.4, 10.6, 12.1, 13.7, 15.7),
(22, 1.09, 21, 7.6, 8.6, 9.6, 10.9, 12.3, 14.0, 16.0),
(23, 1.10, 22, 7.8, 8.7, 9.8, 11.1, 12.5, 14.3, 16.4),
(24, 1.11, 23, 7.9, 8.9, 10.0, 11.3, 12.8, 14.6, 16.7),
(25, 2.00, 24, 8.1, 9.0, 10.2, 11.5, 13.0, 14.8, 17.0),
(26, 2.01, 25, 8.2, 9.2, 10.3, 11.7, 13.3, 15.1, 17.3),
(27, 2.02, 26, 8.4, 9.4, 10.5, 11.9, 13.5, 15.4, 17.7),
(28, 2.03, 27, 8.5, 9.5, 10.7, 12.1, 13.7, 15.7, 18.0),
(29, 2.04, 28, 8.6, 9.7, 10.9, 12.3, 14.0, 16.0, 18.3),
(30, 2.05, 29, 8.8, 9.8, 11.1, 12.5, 14.2, 16.2, 18.7),
(31, 2.06, 30, 8.9, 10.0, 11.2, 12.7, 14.4, 16.5, 19.0),
(32, 2.07, 31, 9.0, 10.1, 11.4, 12.9, 14.7, 16.8, 19.3),
(33, 2.08, 32, 9.1, 10.3, 11.6, 13.1, 14.9, 17.1, 19.6),
(34, 2.09, 33, 9.3, 10.4, 11.7, 13.3, 15.1, 17.3, 20.0),
(35, 2.10, 34, 9.4, 10.5, 11.9, 13.5, 15.4, 17.6, 20.3),
(36, 2.11, 35, 9.5, 10.7, 12.0, 13.7, 15.6, 17.9, 20.6),
(37, 3.00, 36, 9.6, 10.8, 12.2, 13.9, 15.8, 18.1, 20.9),
(38, 3.01, 37, 9.7, 10.9, 12.4, 14.0, 16.0, 18.4, 21.3),
(39, 3.02, 38, 9.8, 11.1, 12.5, 14.2, 16.3, 18.7, 21.6),
(40, 3.03, 39, 9.9, 11.2, 12.7, 14.4, 16.5, 19.0, 22.0),
(41, 3.04, 40, 10.1, 11.3, 12.8, 14.6, 16.7, 19.2, 22.3),
(42, 3.05, 41, 10.2, 11.5, 13.0, 14.8, 16.9, 19.5, 22.7),
(43, 3.06, 42, 10.3, 11.6, 13.1, 15.0, 17.2, 19.8, 23.0),
(44, 3.07, 43, 10.4, 11.7, 13.3, 15.2, 17.4, 20.1, 23.4),
(45, 3.08, 44, 10.5, 11.8, 13.4, 15.3, 17.6, 20.4, 23.7),
(46, 3.09, 45, 10.6, 12.0, 13.6, 15.5, 17.8, 20.7, 24.1),
(47, 3.10, 46, 10.7, 12.1, 13.7, 15.7, 18.1, 20.9, 24.5),
(48, 3.11, 47, 10.8, 12.2, 13.9, 15.9, 18.3, 21.2, 24.8),
(49, 4.00, 48, 10.9, 12.3, 14.0, 16.1, 18.5, 21.5, 25.2),
(50, 4.01, 49, 11.0, 12.4, 14.2, 16.3, 18.8, 21.8, 25.5),
(51, 4.02, 50, 11.1, 12.6, 14.3, 16.4, 19.0, 22.1, 25.9),
(52, 4.03, 51, 11.2, 12.7, 14.5, 16.6, 19.2, 22.4, 26.3),
(53, 4.04, 52, 11.3, 12.8, 14.6, 16.8, 19.4, 22.6, 26.6),
(54, 4.05, 53, 11.4, 12.9, 14.8, 17.0, 19.7, 22.9, 27.0),
(55, 4.06, 54, 11.5, 13.0, 14.9, 17.2, 19.9, 23.2, 27.4),
(56, 4.07, 55, 11.6, 13.2, 15.1, 17.3, 20.1, 3.5, 27.7),
(57, 4.08, 56, 11.7, 13.3, 15.2, 17.5, 20.3, 23.8, 28.1),
(58, 4.09, 57, 11.8, 13.4, 15.3, 17.7, 20.6, 24.1, 28.5),
(59, 4.10, 58, 11.9, 13.5, 15.5, 17.9, 20.8, 24.4, 28.8),
(60, 4.11, 59, 12.0, 13.6, 15.6, 18.0, 21.0, 24.6, 29.2),
(61, 5.00, 60, 12.1, 13.7, 15.8, 18.2, 21.2, 24.9, 29.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peso_talla_h1`
--

CREATE TABLE IF NOT EXISTS `peso_talla_h1` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cm` float(6,1) DEFAULT NULL,
  `DE3menos` float(5,1) DEFAULT NULL,
  `DE2menos` float(5,1) DEFAULT NULL,
  `DE1menos` float(5,1) DEFAULT NULL,
  `Mediana` float(5,1) DEFAULT NULL,
  `DE1` float(5,1) DEFAULT NULL,
  `DE2` float(5,1) DEFAULT NULL,
  `DE3` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Volcado de datos para la tabla `peso_talla_h1`
--

INSERT INTO `peso_talla_h1` (`id`, `cm`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 45.1, 1.9, 2.0, 2.2, 2.4, 2.7, 3.0, 3.3),
(2, 45.5, 1.9, 2.1, 2.3, 2.5, 2.8, 3.1, 3.4),
(3, 46.0, 2.0, 2.2, 2.4, 2.6, 2.9, 3.1, 3.5),
(4, 46.5, 2.1, 2.3, 2.5, 2.7, 3.0, 3.2, 3.6),
(5, 47.0, 2.1, 2.3, 2.5, 2.8, 3.0, 3.3, 3.7),
(6, 47.5, 2.2, 2.4, 2.6, 2.9, 3.1, 3.4, 3.8),
(7, 48.0, 2.3, 2.5, 2.7, 2.9, 3.2, 3.6, 3.9),
(8, 48.5, 2.3, 2.6, 2.8, 3.0, 3.3, 3.7, 4.0),
(9, 49.0, 2.4, 2.6, 2.9, 3.1, 3.4, 3.8, 4.2),
(10, 49.5, 2.5, 2.7, 3.0, 3.2, 3.5, 3.9, 4.3),
(11, 50.0, 2.6, 2.8, 3.0, 3.3, 3.6, 4.0, 4.4),
(12, 50.5, 2.7, 2.9, 3.1, 3.4, 3.8, 4.1, 4.5),
(13, 51.0, 2.4, 3.0, 3.2, 3.5, 3.9, 4.2, 4.7),
(14, 51.5, 2.8, 3.1, 3.3, 3.6, 4.0, 4.4, 4.8),
(15, 52.0, 2.9, 3.2, 3.5, 3.8, 4.1, 4.5, 5.0),
(16, 52.5, 3.0, 3.3, 3.6, 3.9, 4.2, 4.6, 5.1),
(17, 53.0, 3.1, 3.4, 3.7, 4.0, 4.4, 4.8, 5.3),
(18, 53.5, 3.2, 3.5, 3.8, 4.1, 4.5, 4.9, 5.4),
(19, 54.0, 3.3, 3.6, 3.9, 4.3, 4.7, 5.1, 5.6),
(20, 54.5, 3.4, 3.7, 4.0, 4.4, 4.8, 5.3, 5.8),
(21, 55.0, 3.6, 3.8, 4.2, 4.5, 5.0, 5.4, 6.0),
(22, 55.5, 3.7, 4.0, 4.3, 4.7, 5.1, 5.6, 6.1),
(23, 56.0, 3.8, 4.1, 4.4, 4.8, 5.3, 5.8, 6.3),
(24, 56.5, 3.9, 4.2, 4.6, 5.0, 5.4, 5.9, 6.5),
(25, 57.0, 4.0, 4.3, 4.7, 5.1, 5.6, 6.1, 6.7),
(26, 57.5, 4.1, 4.5, 4.9, 5.3, 5.7, 6.3, 6.9),
(27, 58.0, 4.2, 4.6, 5.0, 5.4, 5.9, 6.4, 7.1),
(28, 58.5, 4.4, 4.7, 5.1, 5.6, 6.1, 6.6, 7.2),
(29, 59.0, 4.5, 4.8, 5.3, 5.7, 6.2, 6.8, 7.4),
(30, 59.5, 4.6, 5.0, 5.4, 5.9, 6.4, 7.0, 7.6),
(31, 60.0, 4.7, 5.1, 5.5, 6.0, 6.5, 7.1, 7.8),
(32, 60.5, 4.8, 5.2, 5.6, 6.1, 6.7, 7.3, 8.0),
(33, 61.0, 4.9, 5.3, 5.8, 6.3, 6.8, 7.4, 8.1),
(34, 61.5, 5.0, 5.4, 5.9, 6.4, 7.0, 7.6, 8.3),
(35, 62.0, 5.1, 5.6, 6.0, 6.5, 7.1, 7.7, 8.5),
(36, 62.5, 5.2, 5.7, 6.1, 6.7, 7.2, 7.9, 8.6),
(37, 63.0, 5.3, 5.8, 6.2, 6.8, 7.4, 8.0, 8.8),
(38, 63.5, 5.4, 5.9, 6.4, 6.9, 7.5, 8.2, 8.9),
(39, 64.0, 5.5, 6.0, 6.5, 7.0, 7.6, 8.3, 9.1),
(40, 64.5, 5.6, 6.1, 6.6, 7.1, 7.8, 8.5, 9.3),
(41, 65.0, 5.7, 6.2, 6.7, 7.3, 7.9, 8.6, 9.4),
(42, 65.5, 5.8, 6.3, 6.8, 7.4, 8.0, 8.7, 9.6),
(43, 66.0, 5.9, 6.4, 6.9, 7.5, 8.2, 8.9, 9.7),
(44, 66.5, 6.0, 6.5, 7.0, 7.6, 8.3, 9.0, 9.9),
(45, 67.0, 6.1, 6.6, 7.1, 7.7, 8.4, 9.2, 10.0),
(46, 67.5, 6.2, 6.7, 7.2, 7.9, 8.5, 9.3, 10.2),
(47, 68.0, 6.3, 6.8, 7.3, 8.0, 8.7, 9.4, 10.3),
(48, 68.5, 6.4, 6.9, 7.5, 8.1, 8.8, 9.6, 10.5),
(49, 69.0, 6.5, 7.0, 7.6, 8.2, 8.9, 9.7, 10.6),
(50, 69.5, 6.6, 7.1, 7.7, 8.3, 9.0, 9.8, 10.8),
(51, 70.0, 6.6, 7.2, 7.8, 8.4, 9.2, 10.0, 10.9),
(52, 70.5, 6.7, 7.3, 7.9, 8.5, 9.3, 10.1, 11.1),
(53, 71.0, 6.8, 7.4, 8.0, 8.6, 9.4, 10.2, 11.2),
(54, 71.5, 6.9, 7.5, 8.1, 8.8, 9.5, 10.4, 11.3),
(55, 72.0, 7.0, 7.6, 82.0, 8.9, 9.6, 10.5, 11.5),
(56, 72.5, 7.1, 7.6, 8.3, 9.0, 9.8, 10.6, 11.6),
(57, 73.0, 7.2, 7.7, 8.4, 9.1, 9.9, 10.8, 11.8),
(58, 73.5, 7.2, 7.8, 8.5, 9.2, 10.0, 10.9, 11.9),
(59, 74.0, 7.3, 7.9, 8.6, 9.3, 10.1, 11.0, 12.1),
(60, 74.5, 7.4, 8.0, 8.7, 9.4, 10.2, 11.2, 12.2),
(61, 75.0, 7.5, 8.1, 8.8, 9.5, 10.3, 11.3, 12.3),
(62, 75.5, 7.6, 8.2, 8.8, 9.6, 10.4, 11.4, 12.5),
(63, 76.0, 7.6, 8.3, 8.9, 9.7, 10.6, 11.5, 12.6),
(64, 76.5, 7.7, 8.3, 9.0, 9.8, 10.7, 11.6, 12.7),
(65, 77.0, 7.8, 8.4, 9.1, 9.9, 99.9, 11.7, 12.8),
(66, 77.5, 7.9, 8.5, 9.2, 10.0, 10.9, 11.9, 13.0),
(67, 78.0, 7.9, 9.6, 9.3, 10.1, 11.0, 12.0, 13.1),
(68, 78.5, 8.0, 8.7, 9.4, 10.2, 11.1, 12.1, 13.2),
(69, 79.0, 8.1, 8.7, 9.5, 10.3, 11.2, 12.2, 13.3),
(70, 79.5, 8.2, 8.8, 9.5, 10.4, 11.3, 12.3, 13.4),
(71, 80.0, 8.2, 8.9, 9.6, 10.4, 11.4, 12.4, 13.6),
(72, 80.5, 8.3, 9.0, 9.7, 10.5, 11.5, 12.5, 13.7),
(73, 81.0, 8.4, 9.1, 9.8, 10.6, 11.6, 12.6, 13.8),
(74, 81.5, 8.5, 9.1, 9.9, 10.7, 11.7, 12.7, 13.9),
(75, 82.0, 8.5, 9.2, 10.0, 10.8, 11.8, 12.8, 14.0),
(76, 82.5, 8.6, 9.3, 10.1, 10.9, 11.9, 13.0, 14.2),
(77, 83.0, 8.7, 9.4, 10.2, 11.0, 12.0, 13.1, 14.3),
(78, 83.5, 8.8, 9.5, 10.3, 11.2, 12.1, 13.2, 14.4),
(79, 84.0, 8.9, 9.6, 10.4, 11.3, 12.2, 13.3, 14.6),
(80, 84.5, 9.0, 9.7, 10.5, 11.4, 12.4, 13.5, 14.7),
(81, 85.0, 9.1, 9.8, 10.6, 11.5, 12.5, 13.6, 14.9),
(82, 85.5, 9.2, 9.9, 10.7, 11.6, 12.6, 13.7, 15.0),
(83, 86.0, 9.3, 10.0, 10.8, 11.7, 12.8, 13.9, 15.2),
(84, 86.5, 9.4, 10.1, 11.0, 11.9, 12.9, 14.0, 15.3),
(85, 87.0, 9.5, 10.2, 11.1, 12.0, 13.0, 14.2, 15.5),
(86, 87.5, 9.6, 10.4, 11.2, 12.1, 13.2, 14.3, 15.6),
(87, 88.0, 9.7, 10.5, 11.3, 12.2, 13.3, 14.5, 15.8),
(88, 88.5, 9.8, 10.6, 11.4, 12.4, 13.4, 14.6, 15.9),
(89, 89.0, 9.9, 10.7, 11.5, 12.5, 13.5, 14.7, 16.1),
(90, 89.5, 10.0, 10.8, 11.6, 12.6, 13.7, 14.9, 16.2),
(91, 90.0, 10.1, 10.9, 11.8, 12.7, 13.8, 15.0, 16.4),
(92, 90.5, 10.2, 11.0, 11.9, 12.8, 13.9, 15.1, 16.5),
(93, 91.0, 10.3, 11.1, 12.0, 13.0, 14.1, 15.3, 16.7),
(94, 91.5, 10.4, 11.2, 12.1, 13.1, 14.2, 15.4, 16.8),
(95, 92.0, 10.5, 11.3, 12.2, 13.2, 14.3, 15.6, 17.0),
(96, 92.5, 10.6, 11.4, 12.3, 13.3, 14.4, 15.7, 17.1),
(97, 93.0, 10.7, 11.5, 12.4, 13.4, 14.6, 15.8, 17.3),
(98, 93.5, 10.7, 11.6, 12.5, 13.5, 14.7, 16.0, 17.4),
(99, 94.0, 10.8, 11.7, 12.6, 13.7, 14.8, 16.1, 17.6),
(100, 94.5, 10.9, 11.8, 12.7, 13.8, 14.9, 16.3, 17.7),
(101, 94.5, 10.9, 11.8, 12.7, 13.8, 14.9, 16.3, 17.7),
(102, 95.0, 11.0, 11.9, 12.8, 13.9, 15.1, 16.4, 17.9),
(103, 95.5, 11.1, 12.0, 12.9, 14.0, 15.2, 16.5, 18.0),
(104, 96.0, 11.2, 12.1, 13.1, 14.1, 15.3, 16.7, 18.2),
(105, 96.5, 11.3, 12.2, 13.2, 14.3, 15.5, 16.8, 18.4),
(106, 97.0, 11.4, 12.3, 13.3, 14.4, 15.6, 17.0, 18.5),
(107, 97.5, 11.5, 12.4, 13.4, 14.5, 15.7, 17.1, 18.7),
(108, 98.0, 11.6, 12.5, 13.5, 14.6, 15.9, 17.3, 18.9),
(109, 98.5, 11.7, 12.6, 13.6, 14.8, 16.0, 17.5, 19.1),
(110, 99.0, 11.8, 12.7, 13.7, 14.9, 16.2, 17.6, 19.2),
(111, 99.5, 11.9, 12.8, 13.9, 15.0, 16.3, 17.8, 19.4),
(112, 100.0, 12.0, 12.9, 14.0, 15.2, 16.5, 18.0, 19.6),
(113, 100.5, 12.1, 13.0, 14.1, 15.3, 16.6, 18.1, 19.8),
(114, 101.0, 12.2, 13.2, 14.2, 15.4, 16.8, 18.3, 20.0),
(115, 101.5, 12.3, 13.3, 14.4, 15.6, 16.9, 18.5, 20.2),
(116, 102.0, 12.4, 13.4, 14.5, 15.7, 17.1, 18.7, 20.4),
(117, 102.5, 12.5, 13.5, 14.6, 15.9, 17.3, 18.8, 20.6),
(118, 103.0, 12.6, 13.6, 14.8, 16.0, 17.4, 19.0, 20.8),
(119, 103.5, 12.7, 13.7, 14.9, 16.2, 17.6, 19.2, 21.0),
(120, 104.0, 12.8, 13.9, 15.0, 16.3, 17.8, 19.4, 21.2),
(121, 104.5, 12.9, 14.0, 15.2, 16.5, 17.9, 19.6, 21.5),
(122, 105.0, 13.0, 14.1, 15.3, 16.6, 18.1, 19.8, 21.7),
(123, 105.5, 13.2, 14.2, 15.4, 16.8, 18.3, 20.0, 21.9),
(124, 106.0, 13.3, 14.4, 15.6, 16.9, 18.5, 20.2, 22.1),
(125, 106.5, 13.4, 14.5, 15.7, 17.1, 18.6, 20.4, 22.4),
(126, 107.0, 13.5, 14.6, 15.9, 17.3, 18.8, 20.6, 22.6),
(127, 107.5, 13.6, 14.7, 16.0, 17.4, 19.0, 20.8, 22.8),
(128, 108.0, 13.7, 14.9, 16.2, 17.6, 19.2, 21.0, 23.1),
(129, 108.5, 13.8, 15.0, 16.3, 17.8, 19.4, 21.2, 23.3),
(130, 109.0, 14.0, 15.1, 16.5, 17.9, 19.6, 21.4, 23.6),
(131, 109.5, 14.1, 15.3, 16.6, 18.1, 19.8, 21.7, 23.8),
(132, 110.0, 14.2, 15.4, 16.8, 18.3, 20.0, 21.9, 24.1),
(133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peso_talla_h2`
--

CREATE TABLE IF NOT EXISTS `peso_talla_h2` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cm` float(6,2) DEFAULT NULL,
  `DE3menos` float(5,1) DEFAULT NULL,
  `DE2menos` float(5,1) DEFAULT NULL,
  `DE1menos` float(5,1) DEFAULT NULL,
  `Mediana` float(5,1) DEFAULT NULL,
  `DE1` float(5,1) DEFAULT NULL,
  `DE2` float(5,1) DEFAULT NULL,
  `DE3` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

--
-- Volcado de datos para la tabla `peso_talla_h2`
--

INSERT INTO `peso_talla_h2` (`id`, `cm`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 65.00, 5.9, 6.3, 6.9, 7.4, 8.1, 8.8, 9.6),
(2, 65.50, 6.0, 6.4, 7.0, 7.6, 8.2, 8.9, 9.8),
(3, 66.00, 6.1, 6.5, 7.1, 7.7, 8.3, 9.1, 9.9),
(4, 66.50, 6.1, 6.6, 7.2, 7.8, 8.5, 9.2, 10.1),
(5, 67.00, 6.2, 6.7, 7.3, 7.9, 8.6, 9.4, 10.2),
(6, 67.50, 6.3, 6.8, 7.4, 8.0, 8.7, 9.5, 10.4),
(7, 68.00, 6.4, 6.9, 7.5, 8.1, 8.8, 9.6, 10.5),
(8, 68.50, 6.5, 7.0, 7.6, 8.2, 9.0, 9.8, 10.7),
(9, 69.00, 6.6, 7.1, 7.7, 8.4, 9.1, 9.9, 10.8),
(10, 69.50, 6.7, 7.2, 7.8, 8.5, 9.2, 10.0, 11.0),
(11, 70.00, 6.8, 7.3, 7.9, 8.6, 9.3, 10.2, 11.1),
(12, 70.50, 6.9, 7.4, 8.0, 8.7, 9.5, 10.3, 11.3),
(13, 71.00, 6.9, 7.5, 8.1, 8.8, 9.6, 10.4, 11.4),
(14, 71.50, 7.0, 7.6, 8.2, 8.9, 9.7, 10.6, 11.6),
(15, 72.00, 7.1, 7.7, 8.3, 9.0, 9.8, 10.7, 11.7),
(16, 72.50, 7.2, 7.8, 8.4, 9.1, 9.9, 10.8, 11.8),
(17, 73.00, 7.3, 7.9, 8.5, 9.2, 10.0, 11.0, 12.0),
(18, 73.50, 7.4, 7.9, 8.6, 9.3, 10.2, 11.1, 12.1),
(19, 74.00, 7.4, 8.0, 8.7, 9.4, 10.3, 11.2, 12.2),
(20, 74.50, 7.5, 8.1, 8.8, 9.5, 10.4, 11.3, 12.4),
(21, 75.00, 7.6, 8.2, 8.9, 9.6, 10.5, 11.4, 12.5),
(22, 75.50, 7.7, 8.3, 9.0, 9.7, 10.6, 11.6, 12.6),
(23, 76.00, 7.7, 8.4, 9.1, 9.8, 10.7, 11.7, 12.8),
(24, 76.50, 7.8, 8.5, 9.2, 9.9, 10.8, 11.8, 12.9),
(25, 77.00, 7.9, 8.5, 9.2, 10.0, 10.9, 11.9, 13.0),
(26, 77.50, 8.0, 8.6, 9.3, 10.1, 11.0, 12.0, 13.1),
(27, 78.00, 8.0, 8.7, 9.4, 10.2, 11.1, 12.1, 13.3),
(28, 78.50, 8.1, 8.8, 9.5, 10.3, 11.2, 12.2, 13.4),
(29, 79.00, 8.2, 8.8, 9.6, 10.4, 11.3, 12.3, 13.5),
(30, 79.50, 8.3, 8.9, 9.7, 10.5, 11.4, 12.4, 13.6),
(31, 80.00, 8.3, 9.0, 9.7, 10.6, 11.5, 12.6, 13.7),
(32, 80.50, 8.4, 9.1, 9.8, 10.7, 11.6, 12.7, 13.8),
(33, 81.00, 8.5, 9.2, 9.9, 10.8, 11.7, 12.8, 14.0),
(34, 81.50, 8.6, 9.3, 10.0, 10.9, 11.8, 12.9, 14.1),
(35, 82.00, 8.7, 9.3, 10.1, 11.0, 11.9, 13.0, 14.2),
(36, 82.50, 8.7, 9.4, 10.2, 11.1, 12.1, 13.1, 14.4),
(37, 83.00, 8.8, 9.5, 10.3, 11.2, 12.2, 13.3, 14.5),
(38, 83.50, 8.9, 9.6, 10.4, 11.3, 12.3, 13.4, 14.6),
(39, 84.00, 9.0, 9.7, 10.5, 11.4, 12.4, 13.5, 14.8),
(40, 84.50, 9.1, 9.9, 10.7, 11.5, 12.5, 13.7, 14.9),
(41, 85.00, 9.2, 10.0, 10.8, 11.7, 12.7, 13.8, 15.1),
(42, 85.50, 9.3, 10.1, 10.9, 11.8, 12.8, 13.9, 15.2),
(43, 86.00, 9.4, 10.2, 11.0, 11.9, 12.9, 14.1, 15.4),
(44, 86.50, 9.5, 10.3, 11.1, 12.0, 13.1, 14.2, 15.5),
(45, 87.00, 8.6, 10.4, 11.2, 12.2, 13.2, 14.4, 15.7),
(46, 87.50, 9.7, 10.5, 11.3, 12.3, 13.3, 14.5, 15.8),
(47, 88.00, 9.8, 10.6, 11.5, 12.4, 13.5, 14.7, 16.0),
(48, 88.50, 9.9, 10.7, 11.6, 12.5, 13.6, 14.8, 16.1),
(49, 89.00, 10.0, 10.8, 11.7, 12.6, 13.7, 14.9, 16.3),
(50, 89.50, 10.1, 10.9, 11.8, 12.8, 13.9, 15.1, 16.4),
(51, 90.00, 10.2, 11.0, 11.9, 12.9, 14.0, 15.2, 16.6),
(52, 90.50, 10.3, 11.1, 12.0, 13.0, 14.1, 15.3, 16.7),
(53, 91.00, 10.4, 11.2, 12.1, 13.1, 14.2, 15.5, 16.9),
(54, 91.50, 10.5, 11.3, 12.2, 13.2, 14.4, 15.6, 17.0),
(55, 92.00, 10.6, 11.4, 12.3, 13.4, 14.5, 15.8, 17.2),
(56, 92.50, 10.7, 11.5, 12.4, 13.5, 14.6, 15.9, 17.3),
(57, 93.00, 10.8, 11.6, 12.6, 13.6, 14.7, 16.0, 17.5),
(58, 93.50, 10.9, 11.7, 12.7, 13.7, 14.9, 16.2, 17.6),
(59, 94.00, 11.0, 11.8, 12.8, 13.8, 15.0, 16.3, 17.8),
(60, 94.50, 11.1, 11.9, 12.9, 13.9, 15.1, 16.4, 17.9),
(61, 95.00, 11.1, 12.0, 13.0, 14.1, 15.3, 16.6, 18.1),
(62, 95.50, 11.2, 12.1, 13.1, 14.2, 15.4, 16.7, 18.3),
(63, 96.00, 11.3, 12.2, 13.2, 14.3, 15.5, 16.9, 18.4),
(64, 96.50, 11.4, 12.3, 13.3, 14.4, 15.7, 17.0, 18.6),
(65, 97.00, 11.5, 12.4, 13.4, 14.6, 15.8, 17.2, 18.8),
(66, 97.50, 11.6, 12.5, 13.6, 14.7, 15.9, 17.4, 18.9),
(67, 98.00, 11.7, 12.6, 13.7, 14.8, 16.1, 17.5, 19.1),
(68, 98.50, 11.8, 12.8, 13.8, 14.9, 16.2, 17.7, 19.3),
(69, 99.00, 11.9, 12.9, 13.9, 15.1, 16.4, 17.9, 19.5),
(70, 99.50, 12.0, 13.0, 14.0, 15.2, 16.5, 18.0, 19.7),
(71, 100.00, 12.1, 13.1, 14.2, 15.4, 16.7, 18.2, 19.9),
(72, 100.50, 12.2, 13.2, 14.3, 15.5, 16.9, 18.4, 20.1),
(73, 101.00, 12.3, 13.3, 14.4, 15.6, 17.0, 18.5, 20.3),
(74, 101.50, 12.4, 13.4, 14.5, 15.8, 17.2, 18.7, 20.5),
(75, 102.00, 12.5, 13.6, 14.7, 15.9, 17.3, 18.9, 20.7),
(76, 102.50, 12.6, 13.7, 14.8, 16.1, 17.5, 19.1, 20.9),
(77, 103.00, 12.8, 13.8, 14.9, 16.2, 17.7, 19.3, 21.1),
(78, 103.50, 12.9, 13.9, 15.1, 16.4, 17.8, 19.5, 21.3),
(79, 104.00, 13.0, 14.0, 15.2, 16.5, 18.0, 19.7, 21.6),
(80, 104.50, 13.1, 14.2, 15.4, 16.7, 18.2, 19.9, 21.8),
(81, 105.00, 13.2, 14.3, 15.5, 16.8, 18.4, 20.1, 22.0),
(82, 105.50, 13.3, 14.4, 15.6, 17.0, 18.5, 20.3, 22.2),
(83, 106.00, 13.4, 14.5, 15.8, 17.2, 18.7, 20.5, 22.5),
(84, 106.50, 13.5, 14.7, 15.9, 17.3, 18.9, 20.7, 22.7),
(85, 107.00, 13.7, 14.8, 16.0, 17.5, 19.1, 20.9, 22.9),
(86, 107.50, 13.8, 14.9, 16.2, 17.7, 19.3, 21.2, 23.2),
(87, 108.00, 13.9, 15.1, 16.4, 17.8, 19.5, 21.3, 23.4),
(88, 108.50, 14.0, 15.2, 16.5, 18.0, 19.7, 21.5, 23.7),
(89, 109.00, 14.1, 15.3, 16.7, 18.2, 19.8, 21.8, 23.9),
(90, 109.50, 14.3, 15.5, 16.8, 18.3, 20.0, 22.0, 24.2),
(91, 110.00, 14.4, 15.6, 17.0, 18.5, 20.2, 22.2, 24.4),
(92, 110.50, 14.5, 15.8, 17.1, 18.7, 20.4, 22.4, 24.7),
(93, 111.00, 14.6, 15.9, 17.3, 18.9, 20.7, 22.7, 25.0),
(94, 111.50, 14.8, 16.0, 17.5, 19.1, 20.9, 22.9, 25.2),
(95, 112.00, 14.9, 16.2, 17.6, 19.2, 21.1, 23.1, 25.5),
(96, 112.50, 15.0, 16.3, 17.8, 19.4, 21.3, 23.4, 25.8),
(97, 113.00, 15.2, 16.5, 18.0, 19.6, 21.5, 23.6, 26.0),
(98, 113.50, 15.3, 16.6, 18.1, 19.8, 21.7, 23.9, 26.3),
(99, 114.00, 15.4, 16.8, 18.3, 20.0, 21.9, 24.1, 26.6),
(100, 114.50, 15.6, 16.9, 18.5, 20.2, 22.1, 24.4, 26.9),
(101, 115.00, 15.7, 17.1, 18.6, 20.4, 22.4, 24.6, 27.2),
(102, 115.50, 15.8, 17.2, 18.8, 20.6, 22.6, 24.9, 27.5),
(103, 116.00, 16.0, 17.4, 19.0, 20.8, 22.8, 25.1, 27.8),
(104, 116.50, 16.1, 17.5, 19.2, 21.0, 23.0, 25.4, 28.0),
(105, 117.00, 16.2, 17.7, 19.3, 21.2, 23.3, 25.6, 28.3),
(106, 117.50, 16.4, 17.9, 19.5, 21.4, 23.5, 25.9, 28.6),
(107, 118.00, 16.5, 18.0, 19.7, 21.6, 23.7, 26.1, 28.9),
(108, 118.50, 16.7, 18.2, 19.9, 21.8, 23.9, 26.4, 29.2),
(109, 119.00, 16.8, 18.3, 20.0, 22.0, 24.1, 26.6, 29.5),
(110, 119.50, 19.9, 18.5, 20.2, 2.2, 24.4, 26.9, 29.6),
(111, 120.00, 20.1, 18.6, 20.4, 22.4, 24.6, 27.2, 30.1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peso_talla_m1`
--

CREATE TABLE IF NOT EXISTS `peso_talla_m1` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cm` float(6,2) DEFAULT NULL,
  `DE3menos` float(5,1) DEFAULT NULL,
  `DE2menos` float(5,1) DEFAULT NULL,
  `DE1menos` float(5,1) DEFAULT NULL,
  `Mediana` float(5,1) DEFAULT NULL,
  `DE1` float(5,1) DEFAULT NULL,
  `DE2` float(5,1) DEFAULT NULL,
  `DE3` float(3,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Volcado de datos para la tabla `peso_talla_m1`
--

INSERT INTO `peso_talla_m1` (`id`, `cm`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 45.00, 1.9, 2.1, 2.3, 2.5, 2.7, 3.0, 3.3),
(2, 45.50, 2.0, 2.1, 2.3, 2.5, 2.8, 3.1, 3.4),
(3, 46.00, 2.0, 2.2, 2.4, 2.6, 2.9, 3.2, 3.5),
(4, 46.50, 2.1, 2.3, 2.5, 2.7, 3.0, 3.3, 3.6),
(5, 47.00, 2.2, 2.4, 2.6, 2.8, 3.1, 3.1, 3.7),
(6, 47.50, 2.2, 2.4, 2.6, 2.9, 3.2, 3.5, 3.8),
(7, 48.00, 2.3, 2.5, 2.7, 3.0, 3.3, 3.6, 4.0),
(8, 48.50, 2.4, 2.6, 2.8, 3.1, 3.4, 3.7, 4.1),
(9, 49.00, 2.4, 2.6, 2.9, 3.2, 3.5, 3.8, 4.2),
(10, 49.50, 2.5, 2.7, 3.0, 3.3, 3.6, 3.9, 4.3),
(11, 50.00, 2.6, 2.8, 3.1, 3.4, 3.7, 4.0, 4.5),
(12, 50.50, 2.7, 2.9, 3.2, 3.5, 3.8, 4.2, 4.6),
(13, 51.00, 2.8, 3.0, 3.3, 3.6, 3.9, 4.3, 4.8),
(14, 51.50, 2.8, 3.1, 3.4, 3.7, 4.0, 4.4, 4.9),
(15, 52.00, 2.9, 3.2, 3.5, 3.8, 4.2, 4.6, 5.1),
(16, 52.50, 3.0, 3.3, 3.6, 3.9, 4.3, 4.7, 5.2),
(17, 53.00, 3.1, 3.4, 3.7, 4.0, 4.4, 4.9, 5.4),
(18, 53.50, 3.2, 3.5, 3.8, 4.2, 4.6, 5.0, 5.5),
(19, 54.00, 3.3, 3.6, 3.9, 4.3, 4.7, 5.2, 5.7),
(20, 54.50, 3.4, 3.7, 4.0, 4.4, 4.8, 5.3, 5.9),
(21, 55.00, 3.5, 3.8, 4.2, 4.5, 5.0, 5.5, 6.1),
(22, 55.50, 3.6, 3.9, 4.3, 4.7, 5.1, 5.7, 6.3),
(23, 56.00, 3.7, 4.0, 4.4, 4.8, 5.3, 5.8, 6.4),
(24, 56.50, 3.8, 4.1, 4.5, 5.0, 5.4, 6.0, 6.6),
(25, 57.00, 3.9, 4.3, 4.6, 5.1, 5.6, 6.1, 6.8),
(26, 57.50, 4.0, 4.4, 4.8, 5.2, 5.7, 6.3, 7.0),
(27, 58.00, 4.1, 4.5, 4.9, 5.4, 5.9, 6.5, 7.1),
(28, 58.50, 4.2, 4.6, 5.0, 5.5, 6.0, 6.6, 7.3),
(29, 59.00, 4.3, 4.7, 5.1, 5.6, 6.2, 6.8, 7.5),
(30, 59.50, 4.4, 4.8, 5.3, 5.7, 6.3, 6.9, 7.7),
(31, 60.00, 4.5, 4.9, 5.4, 5.9, 6.4, 7.1, 7.8),
(32, 60.50, 4.6, 5.0, 5.5, 6.0, 6.6, 7.3, 8.0),
(33, 61.00, 4.7, 5.1, 5.6, 6.1, 6.7, 7.4, 8.2),
(34, 61.50, 4.8, 5.2, 5.7, 6.3, 6.9, 7.6, 8.4),
(35, 62.00, 4.9, 5.3, 5.8, 6.4, 7.0, 7.7, 8.5),
(36, 62.50, 5.0, 5.4, 5.9, 6.5, 7.1, 7.8, 8.7),
(37, 63.00, 5.1, 5.5, 6.1, 6.6, 7.3, 8.0, 8.8),
(38, 63.50, 5.2, 5.6, 6.2, 6.7, 7.4, 8.1, 9.0),
(39, 64.00, 5.3, 5.7, 6.3, 6.9, 7.5, 8.3, 9.1),
(40, 64.50, 5.4, 5.8, 6.4, 7.0, 7.6, 8.4, 9.3),
(41, 65.00, 5.5, 5.9, 6.5, 7.1, 7.8, 8.6, 9.5),
(42, 65.50, 5.5, 6.0, 6.6, 7.2, 7.9, 8.7, 9.6),
(43, 66.00, 5.6, 6.1, 6.7, 7.3, 8.0, 8.8, 9.8),
(44, 66.50, 5.7, 6.2, 6.8, 7.4, 8.1, 9.0, 9.9),
(45, 67.00, 5.8, 6.3, 6.9, 7.5, 8.3, 9.1, 10.0),
(46, 67.50, 5.9, 6.4, 7.0, 7.6, 8.4, 9.2, 10.2),
(47, 68.00, 6.0, 6.5, 7.1, 7.7, 8.5, 9.4, 10.3),
(48, 68.50, 6.1, 6.6, 7.2, 7.9, 8.6, 9.5, 10.5),
(49, 69.00, 6.1, 6.7, 7.3, 7.8, 8.7, 9.6, 10.6),
(50, 69.50, 6.2, 6.8, 7.4, 8.1, 8.8, 9.7, 10.7),
(51, 70.00, 6.3, 6.9, 7.5, 8.2, 9.0, 9.9, 10.8),
(52, 70.50, 6.4, 6.9, 7.6, 8.3, 9.1, 10.0, 11.0),
(53, 71.00, 6.5, 7.0, 7.7, 8.4, 9.2, 10.1, 11.1),
(54, 71.50, 6.5, 7.1, 7.7, 8.5, 9.3, 10.2, 11.3),
(55, 72.00, 6.6, 7.2, 7.8, 8.6, 9.4, 10.3, 11.4),
(56, 72.50, 6.7, 7.3, 7.9, 8.7, 9.5, 10.5, 11.5),
(57, 73.00, 6.8, 7.4, 8.0, 8.8, 9.6, 10.6, 11.7),
(58, 73.50, 6.9, 7.4, 8.1, 8.9, 9.7, 10.7, 11.8),
(59, 74.00, 6.9, 7.5, 8.2, 9.0, 9.8, 10.8, 11.9),
(60, 74.50, 7.0, 7.6, 8.3, 9.1, 9.9, 10.9, 12.0),
(61, 75.00, 7.1, 7.7, 8.4, 9.1, 10.0, 11.0, 12.2),
(62, 75.50, 7.1, 7.8, 8.5, 9.2, 10.1, 11.1, 12.3),
(63, 76.00, 7.2, 7.8, 8.5, 9.3, 10.2, 11.2, 12.4),
(64, 76.50, 7.3, 7.9, 8.6, 9.4, 10.3, 11.4, 12.5),
(65, 77.00, 7.4, 8.0, 8.7, 9.5, 10.4, 11.5, 12.6),
(66, 77.50, 7.4, 8.1, 8.8, 9.6, 10.5, 11.6, 12.8),
(67, 78.00, 7.5, 8.2, 8.9, 9.7, 10.6, 11.7, 12.9),
(68, 78.50, 7.6, 8.2, 9.0, 9.8, 10.7, 11.8, 13.0),
(69, 79.00, 7.7, 8.3, 9.1, 9.9, 10.8, 11.9, 13.1),
(70, 79.50, 7.7, 9.4, 9.1, 10.0, 10.9, 12.0, 13.3),
(71, 80.00, 7.8, 8.5, 9.2, 10.1, 11.0, 12.1, 13.4),
(72, 80.50, 7.9, 9.6, 9.3, 10.2, 11.2, 12.3, 13.5),
(73, 81.00, 8.0, 8.7, 9.4, 10.3, 11.3, 12.4, 13.7),
(74, 81.50, 8.1, 8.8, 9.5, 10.4, 11.4, 12.5, 13.8),
(75, 82.00, 8.1, 8.8, 9.6, 10.5, 11.5, 12.6, 13.9),
(76, 82.50, 8.2, 8.9, 9.7, 10.6, 11.6, 12.8, 14.1),
(77, 83.00, 8.3, 9.0, 9.8, 10.7, 11.8, 12.9, 14.2),
(78, 83.50, 8.4, 9.1, 9.9, 10.9, 11.9, 13.1, 14.4),
(79, 84.00, 8.5, 9.2, 10.1, 11.0, 12.0, 13.2, 14.5),
(80, 84.50, 8.6, 9.3, 10.2, 11.1, 12.1, 13.3, 14.7),
(81, 85.00, 8.7, 9.4, 10.3, 11.2, 12.3, 13.5, 14.9),
(82, 85.50, 8.8, 9.5, 10.4, 11.3, 12.4, 13.6, 15.0),
(83, 86.00, 8.9, 9.7, 10.5, 11.5, 12.6, 13.8, 15.2),
(84, 86.50, 9.0, 9.8, 10.6, 11.6, 12.7, 13.9, 15.4),
(85, 87.00, 9.1, 9.9, 10.7, 11.7, 12.8, 14.1, 15.5),
(86, 87.50, 9.2, 10.0, 10.9, 11.8, 13.0, 14.2, 15.7),
(87, 88.00, 9.3, 10.1, 11.0, 12.0, 13.1, 14.4, 15.9),
(88, 88.50, 9.4, 10.2, 11.1, 12.1, 13.2, 14.5, 16.0),
(89, 89.00, 9.5, 10.3, 11.2, 12.2, 13.4, 14.7, 16.2),
(90, 89.50, 9.6, 10.4, 11.3, 12.3, 13.5, 14.8, 16.4),
(91, 90.00, 9.7, 10.5, 11.4, 12.5, 13.7, 15.0, 16.5),
(92, 90.50, 9.8, 10.6, 11.5, 12.6, 13.8, 15.1, 16.7),
(93, 91.00, 9.9, 10.7, 11.7, 12.7, 13.9, 15.3, 16.9),
(94, 91.50, 10.0, 10.8, 11.8, 12.8, 14.1, 15.5, 17.0),
(95, 92.00, 10.1, 10.9, 11.9, 13.0, 14.2, 15.6, 17.2),
(96, 92.50, 10.1, 11.0, 112.0, 13.1, 14.3, 15.8, 17.4),
(97, 93.00, 10.2, 11.1, 12.1, 13.2, 14.5, 15.9, 17.5),
(98, 93.50, 10.3, 11.2, 12.2, 13.3, 14.6, 16.1, 17.7),
(99, 94.00, 10.4, 11.3, 12.3, 13.5, 14.7, 16.2, 17.9),
(100, 94.50, 10.5, 11.4, 12.4, 13.6, 14.9, 16.4, 18.0),
(101, 95.00, 10.6, 11.5, 12.6, 13.7, 15.0, 16.5, 18.2),
(102, 95.50, 10.7, 11.6, 12.7, 13.8, 15.2, 16.7, 18.4),
(103, 96.00, 10.8, 11.7, 12.8, 14.0, 15.3, 16.8, 18.5),
(104, 96.50, 10.9, 11.8, 12.9, 14.1, 15.4, 17.0, 18.7),
(105, 97.00, 11.0, 12.0, 13.0, 14.2, 15.6, 17.1, 18.9),
(106, 97.50, 11.1, 12.1, 13.1, 14.4, 15.7, 17.3, 19.1),
(107, 98.00, 11.2, 12.2, 13.3, 14.5, 15.9, 17.5, 19.3),
(108, 98.50, 11.3, 12.3, 13.4, 14.6, 16.0, 17.6, 19.5),
(109, 99.00, 11.4, 12.4, 13.5, 14.8, 16.2, 17.8, 19.6),
(110, 99.50, 11.5, 12.5, 13.6, 14.9, 16.3, 18.0, 19.8),
(111, 100.00, 11.6, 12.6, 13.7, 15.0, 16.5, 18.1, 20.0),
(112, 100.50, 11.7, 12.7, 13.8, 15.2, 16.6, 19.3, 20.2),
(113, 101.00, 11.8, 12.8, 14.0, 15.3, 16.8, 18.5, 20.4),
(114, 101.50, 11.9, 13.0, 14.1, 15.5, 17.0, 18.7, 20.5),
(115, 102.00, 12.0, 13.1, 14.3, 15.6, 17.1, 18.9, 20.8),
(116, 102.50, 12.1, 13.2, 14.4, 15.8, 17.3, 19.0, 21.0),
(117, 103.00, 12.3, 13.3, 14.5, 15.9, 17.5, 19.2, 21.3),
(118, 103.50, 12.4, 13.5, 14.7, 16.1, 17.6, 19.4, 21.5),
(119, 104.00, 12.5, 13.6, 14.8, 16.2, 17.8, 19.6, 21.7),
(120, 104.50, 12.6, 13.7, 15.0, 16.4, 18.0, 19.8, 21.9),
(121, 105.00, 12.7, 13.8, 15.1, 16.5, 18.2, 20.0, 22.2),
(122, 105.50, 12.8, 14.0, 15.3, 16.7, 18.4, 20.2, 22.4),
(123, 106.00, 13.0, 14.1, 15.4, 16.9, 18.5, 20.5, 22.6),
(124, 106.50, 13.1, 14.3, 15.6, 17.1, 18.7, 20.7, 22.9),
(125, 107.00, 13.2, 14.4, 15.7, 17.2, 18.9, 20.9, 23.1),
(126, 107.50, 13.3, 14.5, 15.9, 17.4, 19.1, 21.1, 23.4),
(127, 108.00, 13.5, 14.7, 16.0, 17.6, 19.3, 21.3, 23.6),
(128, 108.50, 13.6, 14.8, 16.2, 17.8, 19.5, 21.6, 23.9),
(129, 109.00, 13.7, 15.0, 16.4, 18.0, 19.7, 21.8, 24.2),
(130, 109.50, 13.9, 15.1, 16.5, 18.1, 20.0, 22.0, 24.4),
(131, 110.00, 14.0, 15.3, 16.7, 18.3, 20.2, 22.3, 24.7),
(132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peso_talla_m2`
--

CREATE TABLE IF NOT EXISTS `peso_talla_m2` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cm` float(6,2) DEFAULT NULL,
  `DE3menos` float(5,1) DEFAULT NULL,
  `DE2menos` float(5,1) DEFAULT NULL,
  `DE1menos` float(5,1) DEFAULT NULL,
  `Mediana` float(5,1) DEFAULT NULL,
  `DE1` float(5,1) DEFAULT NULL,
  `DE2` float(5,1) DEFAULT NULL,
  `DE3` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

--
-- Volcado de datos para la tabla `peso_talla_m2`
--

INSERT INTO `peso_talla_m2` (`id`, `cm`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 65.00, 5.6, 6.1, 6.6, 7.2, 7.9, 8.7, 9.7),
(2, 65.50, 5.7, 6.2, 6.7, 7.4, 8.1, 8.9, 9.8),
(3, 66.00, 5.8, 6.3, 6.8, 7.5, 8.2, 9.0, 10.0),
(4, 66.50, 5.8, 6.4, 6.9, 7.6, 8.3, 9.1, 10.1),
(5, 67.00, 5.9, 6.4, 7.0, 7.7, 8.4, 9.3, 10.2),
(6, 67.50, 6.0, 6.5, 7.1, 7.8, 8.5, 9.4, 10.4),
(7, 68.00, 6.1, 6.6, 7.2, 7.9, 8.7, 9.5, 10.5),
(8, 68.50, 6.2, 6.7, 7.3, 8.0, 8.8, 9.7, 10.7),
(9, 69.00, 6.3, 6.8, 7.4, 8.1, 8.9, 9.8, 10.8),
(10, 69.50, 6.3, 6.9, 7.5, 8.2, 9.0, 9.9, 10.9),
(11, 70.00, 6.4, 7.0, 7.6, 8.3, 9.1, 10.0, 11.1),
(12, 70.50, 6.5, 7.1, 7.7, 8.4, 9.2, 10.2, 11.2),
(13, 71.00, 6.6, 7.1, 2.8, 8.5, 9.3, 10.3, 11.3),
(14, 71.50, 6.7, 7.2, 7.9, 8.6, 9.4, 10.4, 11.5),
(15, 72.00, 6.7, 7.3, 8.0, 8.7, 9.5, 10.5, 11.6),
(16, 72.50, 6.8, 7.4, 8.1, 8.8, 9.7, 10.6, 11.7),
(17, 73.00, 6.9, 7.5, 8.1, 8.9, 9.8, 10.7, 11.8),
(18, 73.50, 7.0, 7.6, 8.2, 9.0, 9.9, 10.8, 12.0),
(19, 74.00, 7.0, 7.6, 8.3, 9.1, 10.0, 11.0, 12.1),
(20, 74.50, 7.1, 7.7, 8.4, 9.2, 10.1, 11.1, 12.2),
(21, 75.00, 7.2, 7.8, 8.5, 9.3, 10.2, 11.2, 12.3),
(22, 75.50, 7.2, 7.9, 8.6, 9.4, 10.3, 11.3, 12.5),
(23, 76.00, 7.3, 8.0, 8.7, 9.5, 10.4, 11.4, 12.6),
(24, 76.50, 7.4, 8.0, 8.7, 9.6, 10.5, 11.5, 12.7),
(25, 77.00, 7.5, 8.1, 8.8, 9.6, 10.6, 11.6, 12.8),
(26, 77.50, 7.5, 8.2, 8.9, 9.7, 10.7, 11.7, 12.9),
(27, 78.00, 7.6, 8.3, 9.0, 9.8, 10.8, 11.8, 13.1),
(28, 78.50, 7.7, 8.4, 9.1, 9.9, 10.9, 12.0, 13.2),
(29, 79.00, 7.8, 8.4, 9.2, 10.0, 11.0, 12.1, 13.3),
(30, 79.50, 7.8, 8.5, 9.3, 10.1, 11.1, 12.2, 13.4),
(31, 80.00, 7.9, 8.6, 9.4, 10.2, 11.2, 12.3, 13.5),
(32, 80.50, 8.0, 8.7, 9.5, 10.3, 11.3, 12.4, 13.7),
(33, 81.00, 8.1, 8.8, 9.6, 10.4, 11.4, 12.6, 13.9),
(34, 81.50, 8.2, 8.9, 9.7, 10.6, 11.6, 12.7, 14.0),
(35, 82.00, 8.3, 9.0, 9.8, 10.7, 11.7, 12.8, 14.1),
(36, 82.50, 8.4, 9.1, 9.9, 10.8, 11.8, 13.0, 14.3),
(37, 83.00, 8.5, 9.2, 10.0, 10.9, 11.9, 13.1, 14.5),
(38, 83.50, 8.6, 9.3, 10.1, 11.0, 12.1, 13.3, 14.6),
(39, 84.00, 8.6, 9.4, 10.2, 11.1, 12.2, 13.4, 14.8),
(40, 84.50, 8.7, 9.5, 10.3, 11.3, 12.3, 13.5, 14.9),
(41, 85.00, 8.8, 9.6, 10.4, 11.4, 12.5, 13.7, 15.1),
(42, 85.50, 8.9, 9.7, 10.6, 11.5, 12.6, 13.8, 15.3),
(43, 86.00, 9.0, 9.8, 10.7, 11.6, 12.7, 14.0, 15.4),
(44, 86.50, 9.1, 9.9, 10.8, 11.8, 12.9, 14.2, 15.6),
(45, 87.00, 9.2, 10.0, 10.9, 11.9, 13.0, 14.3, 15.8),
(46, 87.50, 9.3, 10.1, 11.0, 12.0, 13.2, 14.5, 15.9),
(47, 88.00, 9.4, 10.2, 11.1, 12.1, 13.3, 14.6, 16.1),
(48, 88.50, 9.5, 10.3, 11.2, 12.3, 13.4, 14.8, 16.3),
(49, 89.00, 9.6, 10.4, 11.4, 12.4, 13.6, 14.9, 16.4),
(50, 89.50, 9.7, 10.5, 11.5, 12.5, 13.7, 15.1, 16.6),
(51, 90.00, 9.8, 10.6, 11.6, 12.6, 13.8, 15.2, 16.8),
(52, 90.50, 9.9, 10.7, 11.7, 12.8, 14.0, 15.4, 16.9),
(53, 91.00, 10.0, 10.9, 11.8, 12.9, 14.1, 15.4, 17.1),
(54, 91.50, 10.1, 11.0, 11.9, 13.0, 14.3, 15.7, 17.3),
(55, 92.00, 10.2, 11.1, 12.0, 13.1, 14.4, 15.8, 17.4),
(56, 92.50, 10.3, 11.2, 12.1, 13.3, 14.5, 16.0, 17.6),
(57, 93.00, 10.4, 11.3, 12.3, 13.4, 14.7, 16.1, 17.8),
(58, 93.50, 10.5, 11.4, 12.4, 13.5, 14.8, 16.3, 17.9),
(59, 94.00, 10.6, 11.5, 12.5, 13.6, 14.9, 16.4, 18.1),
(60, 94.50, 10.7, 11.6, 12.6, 13.8, 15.1, 16.6, 18.3),
(61, 95.00, 10.8, 11.7, 12.7, 13.9, 15.2, 16.7, 18.5),
(62, 95.50, 10.8, 11.8, 12.8, 14.0, 15.4, 16.9, 18.6),
(63, 96.00, 10.9, 11.9, 12.9, 14.0, 15.5, 17.0, 18.8),
(64, 96.50, 11.0, 12.0, 13.1, 14.3, 15.6, 17.2, 19.0),
(65, 97.00, 11.1, 12.1, 13.2, 14.4, 15.8, 17.4, 19.2),
(66, 97.50, 11.2, 12.2, 13.3, 14.5, 15.9, 17.5, 19.3),
(67, 98.00, 11.3, 12.3, 13.4, 14.7, 16.1, 17.7, 19.5),
(68, 98.50, 11.4, 12.4, 13.5, 14.8, 16.2, 17.9, 19.7),
(69, 99.00, 11.5, 12.5, 13.7, 14.9, 16.4, 18.0, 19.9),
(70, 99.50, 11.6, 12.7, 13.8, 15.1, 16.5, 18.2, 20.1),
(71, 100.00, 11.7, 12.8, 13.9, 15.2, 16.7, 18.4, 20.3),
(72, 100.50, 11.9, 12.9, 14.1, 15.4, 16.9, 18.6, 20.5),
(73, 101.00, 12.0, 13.0, 14.2, 15.5, 17.0, 18.7, 20.7),
(74, 101.50, 12.1, 13.1, 14.3, 15.7, 17.2, 18.9, 20.9),
(75, 102.00, 12.2, 13.3, 14.5, 15.8, 17.4, 19.1, 21.1),
(76, 102.50, 12.3, 13.4, 14.6, 16.0, 17.5, 19.3, 21.4),
(77, 103.00, 12.4, 13.5, 14.7, 16.1, 17.7, 19.5, 21.6),
(78, 103.50, 12.5, 13.6, 14.9, 16.3, 17.9, 19.7, 21.8),
(79, 104.00, 12.6, 13.8, 15.0, 16.4, 18.1, 19.9, 22.0),
(80, 104.50, 12.8, 13.9, 15.2, 16.6, 18.2, 20.1, 22.3),
(81, 105.00, 12.9, 14.0, 15.3, 16.8, 18.4, 20.3, 22.5),
(82, 105.50, 13.0, 14.2, 15.5, 16.9, 18.6, 20.5, 22.7),
(83, 106.00, 13.1, 14.3, 15.6, 17.1, 18.8, 20.8, 23.0),
(84, 106.50, 13.3, 14.5, 15.8, 17.3, 19.0, 21.0, 23.2),
(85, 107.00, 13.4, 14.6, 15.9, 17.5, 19.2, 21.2, 23.5),
(86, 107.50, 13.5, 14.7, 16.1, 17.7, 19.4, 21.4, 23.7),
(87, 108.00, 13.7, 14.9, 16.3, 17.8, 19.6, 21.7, 24.0),
(88, 108.50, 13.8, 15.0, 16.4, 18.0, 19.8, 21.9, 24.3),
(89, 109.00, 13.9, 15.2, 16.6, 18.2, 20.0, 22.1, 24.5),
(90, 109.50, 14.1, 15.4, 16.8, 18.4, 20.3, 22.4, 24.8),
(91, 110.00, 14.2, 15.5, 17.0, 18.6, 20.5, 22.6, 25.1),
(92, 110.50, 14.4, 15.7, 17.1, 18.8, 20.7, 22.9, 25.4),
(93, 111.00, 14.5, 15.8, 17.3, 19.0, 20.9, 23.1, 25.7),
(94, 111.50, 14.7, 16.0, 17.5, 19.2, 21.2, 23.4, 26.0),
(95, 112.00, 14.8, 16.2, 17.7, 19.4, 21.4, 23.6, 26.2),
(96, 112.50, 15.0, 16.3, 17.9, 19.6, 21.6, 23.9, 26.5),
(97, 113.00, 15.1, 16.5, 18.0, 19.8, 21.8, 24.2, 26.8),
(98, 113.50, 15.3, 16.7, 18.2, 20.0, 22.1, 24.4, 27.1),
(99, 114.00, 15.4, 16.8, 18.4, 20.2, 22.3, 24.7, 27.4),
(100, 114.50, 15.6, 17.0, 18.6, 20.5, 22.6, 25.0, 27.8),
(101, 115.00, 15.7, 17.2, 18.8, 20.7, 22.8, 25.2, 28.1),
(102, 115.50, 15.9, 17.3, 19.0, 20.9, 23.0, 25.5, 28.4),
(103, 116.00, 16.0, 17.5, 19.2, 21.1, 23.3, 25.7, 28.7),
(104, 116.50, 16.2, 17.7, 19.4, 21.3, 23.5, 26.1, 29.0),
(105, 117.00, 16.3, 17.8, 19.6, 21.5, 23.8, 26.3, 29.3),
(106, 117.50, 16.5, 18.0, 19.8, 21.7, 24.0, 26.6, 29.6),
(107, 118.00, 16.6, 18.2, 19.9, 22.0, 24.2, 26.9, 29.9),
(108, 118.50, 16.8, 18.4, 20.1, 22.2, 24.5, 27.2, 30.3),
(109, 119.00, 16.9, 18.5, 20.3, 22.4, 24.7, 27.4, 30.6),
(110, 119.50, 17.1, 18.7, 20.5, 22.6, 25.0, 27.7, 30.9),
(111, 120.00, 17.3, 18.9, 20.7, 22.8, 25.2, 28.0, 31.2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla_edad_h1`
--

CREATE TABLE IF NOT EXISTS `talla_edad_h1` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `edad` float(3,2) DEFAULT NULL,
  `meses` int(3) DEFAULT NULL,
  `DE3menos` float(3,1) DEFAULT NULL,
  `DE2menos` float(3,1) DEFAULT NULL,
  `DE1menos` float(3,1) DEFAULT NULL,
  `Mediana` float(3,1) DEFAULT NULL,
  `DE1` float(3,1) DEFAULT NULL,
  `DE2` float(3,1) DEFAULT NULL,
  `DE3` float(3,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `talla_edad_h1`
--

INSERT INTO `talla_edad_h1` (`id`, `edad`, `meses`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 0.00, 0, 44.2, 46.1, 48.0, 49.9, 51.8, 53.7, 55.6),
(2, 0.01, 1, 48.9, 50.8, 52.8, 52.7, 56.7, 58.6, 60.6),
(3, 0.02, 2, 52.4, 54.4, 56.4, 58.4, 60.4, 62.4, 64.4),
(4, 0.03, 3, 55.3, 57.3, 59.4, 61.4, 63.5, 65.5, 67.6),
(5, 0.04, 4, 57.6, 59.7, 61.4, 63.9, 66.0, 68.0, 70.1),
(6, 0.05, 5, 59.6, 61.7, 63.8, 65.9, 68.0, 70.1, 72.2),
(7, 0.06, 6, 61.2, 63.3, 65.5, 67.6, 69.8, 71.9, 74.0),
(8, 0.07, 7, 62.7, 64.8, 67.0, 69.2, 71.3, 73.5, 75.7),
(9, 0.08, 8, 64.0, 66.2, 68.4, 70.6, 72.8, 75.0, 77.2),
(10, 0.09, 9, 66.2, 67.5, 69.7, 72.0, 74.2, 76.5, 78.7),
(11, 0.10, 10, 66.4, 68.7, 71.0, 73.3, 75.6, 77.9, 80.1),
(12, 0.11, 11, 67.6, 69.9, 72.2, 74.5, 76.9, 79.2, 81.5),
(13, 1.00, 12, 68.6, 71.0, 73.4, 75.7, 78.1, 80.6, 82.9),
(14, 1.01, 13, 69.6, 72.1, 74.5, 76.9, 79.3, 81.8, 84.2),
(15, 1.02, 14, 70.6, 73.1, 75.6, 78.0, 80.5, 83.0, 85.5),
(16, 1.03, 15, 71.6, 74.1, 76.6, 79.1, 81.7, 84.2, 86.7),
(17, 1.04, 16, 72.5, 75.0, 77.6, 80.2, 82.8, 85.4, 88.0),
(18, 1.05, 17, 73.3, 76.0, 78.6, 81.2, 83.9, 86.6, 89.2),
(19, 1.06, 18, 74.2, 76.9, 79.6, 82.3, 85.0, 87.7, 90.4),
(20, 1.07, 19, 75.0, 77.7, 80.5, 83.2, 86.0, 88.8, 91.5),
(21, 1.08, 20, 75.8, 78.6, 81.4, 84.2, 87.0, 89.8, 92.6),
(22, 1.09, 21, 76.5, 79.4, 82.3, 85.1, 88.0, 90.9, 93.8),
(23, 1.10, 22, 77.2, 80.2, 83.1, 86.0, 89.0, 91.9, 94.9),
(24, 1.11, 23, 78.0, 81.0, 83.9, 86.9, 89.9, 92.9, 95.9),
(25, 2.00, 24, 78.7, 81.7, 84.8, 87.8, 90.9, 93.9, 97.0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla_edad_h2`
--

CREATE TABLE IF NOT EXISTS `talla_edad_h2` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `edad` float(3,2) DEFAULT NULL,
  `meses` int(3) DEFAULT NULL,
  `DE3menos` float(5,1) DEFAULT NULL,
  `DE2menos` float(5,1) DEFAULT NULL,
  `DE1menos` float(5,1) DEFAULT NULL,
  `Mediana` float(5,1) DEFAULT NULL,
  `DE1` float(5,1) DEFAULT NULL,
  `DE2` float(5,1) DEFAULT NULL,
  `DE3` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Volcado de datos para la tabla `talla_edad_h2`
--

INSERT INTO `talla_edad_h2` (`id`, `edad`, `meses`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 2.00, 24, 78.0, 81.0, 84.1, 87.1, 90.2, 93.2, 96.3),
(2, 2.01, 25, 78.6, 81.7, 84.9, 88.0, 91.1, 94.2, 97.3),
(3, 2.02, 26, 79.3, 82.5, 85.6, 88.8, 92.0, 95.2, 98.3),
(4, 2.03, 27, 79.9, 83.1, 86.4, 89.6, 92.9, 96.1, 99.3),
(5, 2.04, 28, 80.5, 83.8, 87.1, 90.4, 93.7, 97.0, 100.3),
(6, 2.05, 29, 81.1, 84.5, 87.8, 91.2, 94.5, 97.9, 101.2),
(7, 2.06, 30, 81.7, 85.1, 88.5, 91.9, 95.3, 98.7, 102.1),
(8, 2.07, 31, 82.3, 85.7, 89.2, 92.7, 96.1, 99.6, 103.0),
(9, 2.08, 32, 82.8, 86.4, 89.9, 93.4, 96.9, 100.4, 103.9),
(10, 2.09, 33, 83.4, 86.9, 90.5, 94.1, 97.6, 101.2, 104.8),
(11, 2.10, 34, 83.9, 87.5, 91.1, 94.8, 98.4, 102.0, 105.6),
(12, 2.11, 35, 84.4, 88.1, 91.8, 95.4, 99.1, 102.7, 106.4),
(13, 3.00, 36, 85.0, 88.7, 92.4, 96.1, 99.8, 103.5, 107.2),
(14, 3.01, 37, 85.5, 89.2, 93.0, 96.7, 100.5, 104.2, 108.0),
(15, 3.02, 38, 86.0, 89.8, 93.6, 97.4, 101.2, 105.0, 108.8),
(16, 3.03, 39, 86.5, 90.3, 94.2, 98.0, 101.8, 105.7, 109.5),
(17, 3.04, 40, 87.0, 90.9, 94.7, 98.6, 102.5, 106.4, 110.3),
(18, 3.05, 41, 87.5, 91.4, 95.3, 99.2, 103.2, 107.1, 111.0),
(19, 3.06, 42, 88.0, 91.9, 95.9, 99.9, 103.8, 107.8, 111.7),
(20, 3.07, 43, 88.4, 92.4, 96.4, 100.4, 104.5, 108.5, 112.5),
(21, 3.08, 44, 88.9, 93.0, 97.0, 101.0, 105.1, 109.1, 113.2),
(22, 3.09, 45, 89.4, 93.5, 97.5, 101.6, 105.7, 109.8, 113.9),
(23, 3.10, 46, 89.8, 94.0, 98.1, 102.2, 106.3, 110.4, 114.6),
(24, 3.11, 47, 90.3, 94.4, 98.6, 102.8, 106.9, 111.1, 115.2),
(25, 4.00, 48, 90.7, 94.9, 99.1, 103.3, 107.5, 111.7, 115.9),
(26, 4.01, 49, 91.2, 95.4, 99.7, 103.9, 108.1, 112.4, 116.6),
(27, 4.02, 50, 91.6, 95.9, 100.2, 104.4, 108.7, 113.0, 117.3),
(28, 4.03, 51, 92.1, 96.4, 100.7, 105.0, 109.3, 113.6, 117.9),
(29, 4.04, 52, 92.5, 96.9, 101.2, 105.6, 109.9, 114.2, 118.6),
(30, 4.05, 53, 93.0, 97.4, 101.7, 106.1, 110.5, 114.9, 119.2),
(31, 4.06, 54, 93.4, 97.8, 102.3, 106.7, 111.1, 115.5, 119.9),
(32, 4.07, 55, 93.9, 98.3, 102.8, 107.2, 111.7, 116.1, 120.6),
(33, 4.08, 56, 94.3, 98.8, 103.3, 107.8, 112.3, 116.7, 121.2),
(34, 4.09, 57, 94.7, 99.3, 103.8, 108.3, 112.8, 117.4, 121.9),
(35, 4.10, 58, 95.2, 99.7, 104.3, 108.9, 113.4, 118.0, 122.6),
(36, 4.11, 59, 95.6, 100.2, 104.8, 109.4, 114.0, 118.6, 123.2),
(37, 5.00, 60, 96.1, 100.7, 105.3, 110.0, 114.6, 119.2, 123.9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla_edad_m1`
--

CREATE TABLE IF NOT EXISTS `talla_edad_m1` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `edad` float(3,2) DEFAULT NULL,
  `meses` int(3) DEFAULT NULL,
  `DE3menos` float(5,1) DEFAULT NULL,
  `DE2menos` float(5,1) DEFAULT NULL,
  `DE1menos` float(5,1) DEFAULT NULL,
  `Mediana` float(5,1) DEFAULT NULL,
  `DE1` float(5,1) DEFAULT NULL,
  `DE2` float(5,1) DEFAULT NULL,
  `DE3` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `talla_edad_m1`
--

INSERT INTO `talla_edad_m1` (`id`, `edad`, `meses`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 0.00, 0, 43.6, 45.4, 47.3, 49.1, 51.0, 52.9, 54.7),
(2, 0.01, 1, 47.8, 49.8, 51.7, 53.7, 55.6, 57.6, 59.5),
(3, 0.02, 2, 51.0, 53.0, 55.0, 57.1, 59.1, 61.1, 63.2),
(4, 0.03, 3, 53.5, 55.6, 57.7, 59.8, 61.9, 64.0, 66.1),
(5, 0.04, 4, 55.6, 57.8, 59.9, 62.1, 64.3, 66.4, 68.6),
(6, 0.05, 5, 57.4, 59.6, 61.8, 64.0, 66.2, 68.5, 70.7),
(7, 0.06, 6, 58.9, 61.2, 63.5, 65.7, 68.0, 70.3, 72.5),
(8, 0.07, 7, 60.3, 62.7, 65.0, 67.3, 69.6, 71.9, 74.2),
(9, 0.08, 8, 61.7, 64.0, 66.4, 68.7, 71.1, 73.5, 75.8),
(10, 0.09, 9, 62.9, 65.3, 67.7, 70.1, 72.6, 75.0, 77.4),
(11, 0.10, 10, 64.1, 66.5, 69.0, 74.5, 73.9, 76.4, 78.9),
(12, 0.11, 11, 65.2, 67.7, 70.3, 72.8, 75.3, 77.8, 80.3),
(13, 1.00, 12, 66.3, 68.9, 71.4, 74.0, 76.6, 79.2, 81.7),
(14, 1.01, 13, 67.3, 70.0, 72.6, 75.2, 77.8, 80.5, 83.1),
(15, 1.02, 14, 68.3, 71.0, 73.7, 76.4, 79.1, 81.7, 84.4),
(16, 1.03, 15, 69.3, 70.0, 74.8, 77.5, 80.2, 83.0, 85.7),
(17, 1.04, 16, 70.2, 73.0, 75.8, 78.6, 81.4, 84.2, 87.0),
(18, 1.05, 17, 71.1, 74.0, 76.8, 79.7, 82.5, 85.4, 88.2),
(19, 1.06, 18, 72.0, 74.9, 77.8, 80.7, 83.6, 86.5, 89.4),
(20, 1.07, 19, 72.8, 75.8, 78.8, 81.7, 84.7, 87.6, 90.6),
(21, 1.08, 20, 73.7, 76.7, 79.7, 82.7, 85.7, 88.7, 91.7),
(22, 1.09, 21, 74.5, 77.5, 80.6, 83.7, 86.7, 89.8, 92.9),
(23, 1.10, 22, 75.2, 78.4, 81.5, 84.6, 87.7, 90.8, 94.0),
(24, 1.11, 23, 76.0, 79.2, 82.3, 85.5, 88.7, 91.9, 95.0),
(25, 2.00, 24, 76.7, 80.0, 83.2, 86.4, 89.6, 92.9, 96.1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla_edad_m2`
--

CREATE TABLE IF NOT EXISTS `talla_edad_m2` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `edad` float(3,2) DEFAULT NULL,
  `meses` int(3) DEFAULT NULL,
  `DE3menos` float(5,1) DEFAULT NULL,
  `DE2menos` float(5,1) DEFAULT NULL,
  `DE1menos` float(5,1) DEFAULT NULL,
  `Mediana` float(5,1) DEFAULT NULL,
  `DE1` float(5,1) DEFAULT NULL,
  `DE2` float(5,1) DEFAULT NULL,
  `DE3` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Volcado de datos para la tabla `talla_edad_m2`
--

INSERT INTO `talla_edad_m2` (`id`, `edad`, `meses`, `DE3menos`, `DE2menos`, `DE1menos`, `Mediana`, `DE1`, `DE2`, `DE3`) VALUES
(1, 2.00, 24, 76.0, 79.3, 82.5, 85.7, 88.9, 92.2, NULL),
(2, 2.01, 25, 76.8, 80.0, 83.3, 86.6, 89.9, 93.1, 96.4),
(3, 2.02, 26, 77.5, 80.8, 84.1, 87.4, 90.8, 94.1, 97.4),
(4, 2.03, 27, 78.1, 81.5, 84.9, 88.3, 91.7, 95.0, 98.4),
(5, 2.04, 28, 78.8, 82.2, 85.7, 89.1, 92.5, 96.0, 99.4),
(6, 2.05, 29, 79.5, 82.9, 86.4, 89.9, 93.4, 96.9, 100.3),
(7, 2.06, 30, 80.1, 83.6, 87.1, 90.7, 94.2, 97.7, 101.3),
(8, 2.07, 31, 80.7, 84.3, 87.9, 91.4, 95.0, 98.6, 102.2),
(9, 2.08, 32, 81.3, 84.9, 88.6, 92.2, 95.8, 99.4, 103.1),
(10, 2.09, 33, 81.9, 85.6, 89.3, 92.9, 96.6, 100.3, 103.9),
(11, 2.10, 34, 82.5, 86.2, 89.9, 93.6, 97.4, 101.1, 104.8),
(12, 2.11, 35, 83.1, 86.8, 90.6, 94.4, 98.1, 101.9, 105.6),
(13, 3.00, 36, 83.6, 87.4, 91.2, 95.1, 98.9, 102.7, 106.5),
(14, 3.01, 37, 84.2, 88.0, 91.9, 95.7, 99.6, 103.4, 107.3),
(15, 3.02, 38, 84.7, 88.6, 92.5, 96.4, 100.3, 104.2, 108.1),
(16, 3.03, 39, 85.3, 89.2, 93.1, 97.1, 101.0, 105.0, 108.9),
(17, 3.04, 40, 85.8, 89.8, 93.8, 97.7, 101.7, 107.7, 109.7),
(18, 3.05, 41, 86.3, 90.4, 94.4, 98.4, 102.4, 106.4, 110.5),
(19, 3.06, 42, 86.8, 90.9, 95.0, 99.0, 103.1, 107.2, 111.2),
(20, 3.07, 43, 87.4, 91.5, 95.6, 99.7, 103.8, 107.9, 112.0),
(21, 3.08, 44, 87.9, 92.0, 96.2, 100.3, 104.5, 108.6, 112.7),
(22, 3.09, 45, 88.4, 92.5, 96.7, 100.9, 105.1, 109.3, 113.5),
(23, 3.10, 46, 88.9, 93.1, 97.3, 101.5, 105.8, 110.0, 114.2),
(24, 3.11, 47, 89.3, 93.6, 97.9, 102.1, 106.4, 110.7, 114.9),
(25, 4.00, 48, 89.8, 94.1, 98.4, 102.7, 107.0, 111.3, 115.7),
(26, 4.01, 49, 90.3, 94.6, 99.0, 103.3, 107.7, 112.0, 116.4),
(27, 4.02, 50, 90.7, 95.1, 99.5, 103.9, 108.3, 112.7, 117.1),
(28, 4.03, 51, 91.2, 95.6, 100.1, 104.5, 108.9, 113.3, 117.7),
(29, 4.04, 52, 91.7, 96.1, 100.6, 105.0, 109.5, 114.0, 118.4),
(30, 4.05, 53, 92.1, 96.6, 101.1, 105.6, 110.1, 114.6, 119.1),
(31, 4.06, 54, 92.6, 97.1, 101.6, 106.2, 110.7, 115.2, 119.8),
(32, 4.07, 55, 93.0, 97.6, 102.2, 106.7, 111.3, 115.9, 120.4),
(33, 4.08, 56, 93.4, 98.1, 102.7, 107.3, 111.9, 116.5, 121.1),
(34, 4.09, 57, 93.9, 98.5, 103.2, 107.8, 112.5, 117.1, 121.8),
(35, 4.10, 58, 94.3, 99.0, 103.7, 108.4, 113.0, 117.7, 122.4),
(36, 4.11, 59, 94.7, 99.5, 104.2, 108.9, 113.6, 118.3, 123.1),
(37, 5.00, 60, 95.2, 99.9, 104.7, 109.4, 114.2, 118.9, 123.7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`, `estado`) VALUES
(1, 'Lactantes', 1),
(2, 'Andantes', 1),
(3, 'Infantes', 1),
(4, 'Jardín', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `fecha`, `estado`) VALUES
(1, 'yliana', '349ba604f22f2a4f3accfc1e5e904069', '2015-12-05', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`idAula`) REFERENCES `aula` (`id`);

--
-- Filtros para la tabla `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `Tipo` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`id`);

--
-- Filtros para la tabla `detalle_evaluacion`
--
ALTER TABLE `detalle_evaluacion`
  ADD CONSTRAINT `Alumno` FOREIGN KEY (`idAlumno`) REFERENCES `alumno` (`id`),
  ADD CONSTRAINT `Evaluacion` FOREIGN KEY (`idEvaluacion`) REFERENCES `evaluacion` (`id`);

--
-- Filtros para la tabla `edad`
--
ALTER TABLE `edad`
  ADD CONSTRAINT `TipoAlumno` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`id`);

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `Aula` FOREIGN KEY (`idAula`) REFERENCES `aula` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
