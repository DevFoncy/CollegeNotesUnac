-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2017 a las 22:12:23
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nota_fime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `codigo_alumno` varchar(11) NOT NULL,
  `nombre_alumno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`codigo_alumno`, `nombre_alumno`) VALUES
('1000000003', 'Pepe '),
('1000000004', 'Yupanqui'),
('1000000005', 'Luis'),
('1000000006', 'Juanito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo`
--

CREATE TABLE `ciclo` (
  `codigo_ciclo` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciclo`
--

INSERT INTO `ciclo` (`codigo_ciclo`) VALUES
('2017-B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `codigo_curso` varchar(11) NOT NULL,
  `nombre_curso` varchar(50) NOT NULL,
  `codigo_escuela` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`codigo_curso`, `nombre_curso`, `codigo_escuela`) VALUES
('112', 'Quimica', 20),
('113', 'Mate 2', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `codigo_nota` int(6) NOT NULL,
  `codigo_turno` varchar(20) NOT NULL,
  `codigo_curso` varchar(10) NOT NULL,
  `codigo_docente` varchar(4) NOT NULL,
  `codigo_alumno` varchar(11) NOT NULL,
  `codigo_escuela` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`codigo_nota`, `codigo_turno`, `codigo_curso`, `codigo_docente`, `codigo_alumno`, `codigo_escuela`) VALUES
(0, '01M', '112', '1234', '1000000001', 20),
(0, '02M', '113', '1235', '1000000002', 21),
(0, '02M', '112', '1234', '1000000003', 20),
(0, '02M', '112', '1234', '1000000004', 21),
(0, '02M', '112', '1234', '1000000005', 20),
(0, '01M', '112', '1234', '1000000006', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `codigo_nota` varchar(5) NOT NULL,
  `codigo_turno` varchar(3) NOT NULL,
  `codigo_curso` varchar(255) NOT NULL,
  `codigo_alumno` varchar(10) NOT NULL,
  `ex_parcial` int(2) NOT NULL,
  `ex_final` int(2) NOT NULL,
  `pc1` int(2) NOT NULL,
  `pc2` int(2) NOT NULL,
  `pc3` int(2) NOT NULL,
  `pc4` int(2) NOT NULL,
  `laboratorio` int(2) NOT NULL,
  `susti` int(2) NOT NULL,
  `pp` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`codigo_nota`, `codigo_turno`, `codigo_curso`, `codigo_alumno`, `ex_parcial`, `ex_final`, `pc1`, `pc2`, `pc3`, `pc4`, `laboratorio`, `susti`, `pp`) VALUES
('2', '02M', '112', '1000000003', 12, 13, 11, 15, 11, 13, 12, 13, 0),
('3', '02M', '112', '1000000004', 14, 11, 15, 12, 14, 15, 13, 11, 0),
('4', '02M', '112', '1000000005', 12, 14, 0, 0, 14, 15, 14, 14, 0),
('5', '01M', '112', '1000000006', 14, 13, 0, 0, 0, 14, 15, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peso`
--

CREATE TABLE `peso` (
  `codigo_turno` varchar(3) NOT NULL,
  `codigo_curso` varchar(255) NOT NULL,
  `codigo_profesor` varchar(255) NOT NULL,
  `peso_parcial` varchar(255) NOT NULL,
  `peso_final` varchar(255) NOT NULL,
  `peso_pc1` varchar(255) NOT NULL,
  `peso_pc2` varchar(255) NOT NULL,
  `peso_pc3` varchar(255) NOT NULL,
  `peso_pc4` varchar(255) NOT NULL,
  `peso_labo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `codigo_profesor` varchar(20) NOT NULL,
  `nombre_profesor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`codigo_profesor`, `nombre_profesor`) VALUES
('1234', 'Pepito'),
('1235', 'Juanito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_curso`
--

CREATE TABLE `profesor_curso` (
  `codigo_curso` varchar(3) NOT NULL,
  `codigo_profesor` varchar(10) NOT NULL,
  `codigo_turno` varchar(3) NOT NULL,
  `ex_parcial` int(1) DEFAULT NULL,
  `ex_final` int(1) DEFAULT NULL,
  `pc1` int(1) DEFAULT NULL,
  `pc2` int(1) DEFAULT NULL,
  `pc3` int(1) DEFAULT NULL,
  `pc4` int(1) DEFAULT NULL,
  `laboratorio` int(1) DEFAULT NULL,
  `susti` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor_curso`
--

INSERT INTO `profesor_curso` (`codigo_curso`, `codigo_profesor`, `codigo_turno`, `ex_parcial`, `ex_final`, `pc1`, `pc2`, `pc3`, `pc4`, `laboratorio`, `susti`) VALUES
('112', '1234', '01M', 1, 0, 1, 0, 1, 0, 0, 0),
('113', '1235', '02M', 1, 0, 1, 0, 0, 0, 0, 0),
('112', '1234', '02M', 1, 0, 1, 0, 1, 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`codigo_nota`);

--
-- Indices de la tabla `peso`
--
ALTER TABLE `peso`
  ADD PRIMARY KEY (`codigo_turno`,`codigo_curso`,`codigo_profesor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
