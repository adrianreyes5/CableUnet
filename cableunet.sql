-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2018 a las 06:42:19
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cableunet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canales`
--

CREATE TABLE `canales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `info` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `canales`
--

INSERT INTO `canales` (`id`, `nombre`, `info`) VALUES
(1, 'VTV', 'Canal del pueblo'),
(2, 'VenevisiÃ³n', 'canal de televisiÃ³n abierta venezolano'),
(3, 'Televen', 'es un canal de televisiÃ³n abierta venezolano de capital privado que transmite desde la ciudad de Caracas a travÃ©s de frecuencias de seÃ±al abierta y de suscripciÃ³n.'),
(4, 'GlobovisiÃ³n', 'es un canal de televisiÃ³n privado venezolano que transmite noticias las 24 horas'),
(5, 'TNT', 'es un canal de televisiÃ³n por suscripciÃ³n latinoamericano de origen estadounidense'),
(6, 'HBO', 'HBO es uno de los canales de televisiÃ³n por cable y satÃ©lite mÃ¡s populares de Estados Unidos y LatinoamÃ©rica'),
(7, 'HBO PLUS', 'HBO Plus es un canal de televisiÃ³n por suscripciÃ³n latinoamericano de origen estadounidense.'),
(8, 'HBO PREMIUN', 'HBO Plus es un canal de televisiÃ³n por suscripciÃ³n latinoamericano de origen estadounidense.'),
(10, 'Warner channel', 'Warner TV (tambiÃ©n conocido como Warner) es un canal de televisiÃ³n por suscripciÃ³n'),
(11, 'MTV', 'MTV es un canal de televisiÃ³n por suscripciÃ³n latinoamericano de origen estadounidense'),
(12, 'HTV', 'HTV es un canal de televisiÃ³n por suscripciÃ³n latinoamericano que ofrece programaciÃ³n musical, con entrevistas, eventos y ritmos latinoamericanos como salsa, reguetÃ³n, vallenato, merengue, cumbia,'),
(13, 'Telemax', 'Telemax es una cadena de televisiÃ³n abierta mexicana con sede en Hermosillo, Sonora'),
(14, 'Cinemax ', 'Telemax es una cadena de televisiÃ³n abierta mexicana con sede en Hermosillo, Sonora'),
(15, 'Disney channel', 'Disney Channel es un canal internacional de The Walt Disney Company. La programaciÃ³n del canal estÃ¡ destinada al pÃºblico juvenil e infantil. '),
(16, 'Nickelodeon', 'Nickelodeon es un canal de televisiÃ³n por suscripciÃ³n infantil y juvenil estadounidense dirigido principalmente a los niÃ±os, preadolescentes y adolescentes de 7-12 aÃ±os de edad;'),
(17, 'Fox', 'Fox es un canal de televisiÃ³n por suscripciÃ³n latinoamericano de origen estadounidense, el cual emite en LatinoamÃ©rica como la variante regional del canal original'),
(18, 'Gourmet', 'El Gourmet es un canal de televisiÃ³n por suscripciÃ³n latinoamericano de origen argentino.'),
(19, 'Food channel', 'Food Network es un canal de televisiÃ³n por suscripciÃ³n estadounidense, propiedad de Discovery Communications'),
(20, 'CineCanal', 'Cinecanal es un canal de televisiÃ³n por suscripciÃ³n latinoamericano de origen estadounidense,'),
(21, 'Cinelatino', 'Cine Latino es un canal de televisiÃ³n por suscripciÃ³n internacional de origen mexicano, el cual basa su programaciÃ³n en pelÃ­culas en espaÃ±ol. '),
(22, 'Space', 'Space es un canal de especialidad canadiense de categorÃ­a A propiedad y operado por Bell Media'),
(23, 'Max Prime', 'Max Prime es un canal de televisiÃ³n por suscripciÃ³n latinoamericano de origen estadounidense que forma parte del paquete de canales HBO MAX y estÃ¡ dentro del mercado de canales Cinemax.'),
(24, 'Fox Sports', 'Fox Sports es un canal de televisiÃ³n por suscripciÃ³n deportivo latinoamericano de origen estadounidense'),
(25, 'ESPN', 'ESPN, Inc. es un grupo mediÃ¡tico con sede en los Estados Unidos, que opera y produce canales de televisiÃ³n por cable, satÃ©lite, radio, sitios web, revistas y libros relacionados con el deporte.'),
(26, 'ESPN 2', 'ESPN2 es un canal estadounidense de televisiÃ³n por cable o satÃ©lite, propiedad de la red de ESPN que a su vez pertenece a The Walt Disney Company y Hearst Corporation.'),
(27, 'GOLF', 'Golf Channel es un canal de televisiÃ³n por suscripciÃ³n latinoamericano de origen estadounidense el cual se centra en el deporte, en especial el golf.'),
(28, 'National Geographic', 'National Geographic, abreviado como NatGeo, es un canal de televisiÃ³n por cable y satÃ©lite lanzado por la National Geographic Partners el 1 de septiembre de 1997'),
(29, 'Discovey channel', 'Discovery Channel es un canal de televisiÃ³n por cable propiedad de Discovery Inc.. Es una seÃ±al de entretenimiento, cultura y educaciÃ³n distribuida virtualmente en el mercado de televisiÃ³n de pago'),
(30, 'Animal Planet', ' Animal Planet Animal Planet logo.svg Eslogan	Sorprendentemente humano Tipo de canal	televisiÃ³n por suscripciÃ³n ProgramaciÃ³n	Documentales Propietario	Discovery Communications Operado por	Discovery '),
(31, 'H2', 'H2 es un canal de televisiÃ³n por suscripciÃ³n latinoamericano que emite documentales histÃ³ricos con un enfoque internacional. Es el canal hermano de History.'),
(32, 'FX', 'FX es un canal de televisiÃ³n por suscripciÃ³n estadounidense, propiedad de 21st Century Fox a travÃ©s de FX Networks, LLC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `fact_servicios` double DEFAULT NULL,
  `fact_canal` double DEFAULT NULL,
  `activo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facturacion`
--

INSERT INTO `facturacion` (`id`, `usuario`, `fact_servicios`, `fact_canal`, `activo`) VALUES
(79, 'jariany', 2000, NULL, 1),
(80, 'jariany', NULL, 250, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `internet` varchar(30) DEFAULT NULL,
  `telefonia` varchar(30) DEFAULT NULL,
  `cable` varchar(30) DEFAULT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id`, `nombre`, `internet`, `telefonia`, `cable`, `precio`) VALUES
(1, 'gold', '8', '11', 'null', 500),
(2, 'platinum', '8', '11', '13', 2000),
(3, 'Chavez', '12', '11', '15', 400),
(5, 'Basico', '12', '11', '13', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes_canales`
--

CREATE TABLE `paquetes_canales` (
  `id` int(11) NOT NULL,
  `plan` varchar(30) NOT NULL,
  `canales` varchar(500) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paquetes_canales`
--

INSERT INTO `paquetes_canales` (`id`, `plan`, `canales`, `precio`) VALUES
(6, 'A', '2,4,15,16', 200),
(7, 'D', '10,11,12,13', 250),
(8, 'E', '20,28,29,30', 225),
(9, 'F', '2,3,4,7,8,10,12,14,15', 700);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_canal`
--

CREATE TABLE `programacion_canal` (
  `id` int(11) NOT NULL,
  `nombre_canal` varchar(100) NOT NULL,
  `id_progra` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programacion_canal`
--

INSERT INTO `programacion_canal` (`id`, `nombre_canal`, `id_progra`) VALUES
(3, 'VTV', '1,4,5,6'),
(4, 'GlobovisiÃ³n', '7,8,9,10'),
(5, 'Warner channel', '11,12,13,14,15'),
(6, 'TNT', '17,18,19'),
(10, 'HBO PLUS', '17,18,19,20,23'),
(12, 'Nickelodeon', '24,25'),
(13, 'Cinelatino', '30,31,32,33'),
(18, 'HTV', '1,4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id` int(11) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora_comienzo` time NOT NULL,
  `hora_termina` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `programa`, `fecha`, `hora_comienzo`, `hora_termina`) VALUES
(1, 'Con el mazo dando', '2018-09-18', '10:00:00', '11:00:00'),
(4, 'Noticiero VTV', '2018-09-18', '11:00:00', '12:00:00'),
(5, 'Domingos con maduro', '2018-09-18', '12:00:00', '13:00:00'),
(6, 'La Bomba', '2018-09-18', '13:00:00', '15:00:00'),
(7, 'Noticias Globovision', '2018-09-18', '10:00:00', '11:00:00'),
(8, 'Hablan las paredes', '2018-09-18', '11:00:00', '12:30:00'),
(9, 'Caso cerrado', '2018-09-18', '12:30:00', '14:00:00'),
(10, 'Vladimir a la 1', '2018-09-18', '13:00:00', '14:00:00'),
(11, 'The Big ban theory', '2018-09-18', '10:00:00', '10:30:00'),
(12, 'The Big ban theory', '2018-09-18', '10:30:00', '11:00:00'),
(13, 'Two and a half men', '2018-09-18', '11:00:00', '11:30:00'),
(14, 'Two and a half men', '2018-09-18', '11:30:00', '12:00:00'),
(15, 'Friends', '2018-09-18', '12:30:00', '13:00:00'),
(16, 'Friends', '2018-09-18', '13:00:00', '13:30:00'),
(17, 'Ant Man', '2018-09-18', '10:00:00', '12:30:00'),
(18, 'Troya', '2018-09-18', '12:30:00', '15:00:00'),
(19, 'La momia', '2018-09-18', '15:00:00', '17:30:00'),
(20, 'Avengers 1', '2018-09-18', '15:00:00', '15:00:00'),
(23, 'Civil war', '2018-09-21', '19:00:00', '21:00:00'),
(24, 'Bob esponja', '2018-09-20', '16:00:00', '16:30:00'),
(25, 'Drake and Josh', '2018-09-23', '18:00:00', '19:00:00'),
(26, 'Planeta salvaje', '2018-09-21', '15:00:00', '16:30:00'),
(27, 'Portadas', '2018-09-20', '10:00:00', '11:00:00'),
(28, 'Flash', '2018-10-01', '16:00:00', '16:30:00'),
(29, 'Linterna verde', '2018-10-01', '18:00:00', '20:00:00'),
(30, 'Superman', '2018-10-01', '20:00:00', '22:00:00'),
(31, 'Batman', '2018-10-02', '20:00:00', '22:30:00'),
(32, 'aquaman', '2018-10-02', '16:00:00', '18:30:00'),
(33, 'Son como niÃ±os', '2018-10-07', '22:00:00', '24:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `plan` varchar(30) DEFAULT NULL,
  `velocidad` varchar(30) DEFAULT NULL,
  `minutos` varchar(20) DEFAULT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `plan`, `velocidad`, `minutos`, `precio`) VALUES
(8, 'internet', 'premium', '2mb', NULL, 1000),
(11, 'telefonia', 'hablapegado', NULL, '100', 100),
(12, 'internet', 'basico', '2mb', NULL, 50),
(13, 'cable', 'A', NULL, NULL, 1000),
(14, 'telefonia', 'Ilimitado', NULL, '5000', 1000),
(15, 'cable', 'B', NULL, NULL, 300),
(16, 'internet', 'Fibra Optica', '100mb', NULL, 2000),
(17, 'telefonia', 'Nocturno', NULL, '300', 50),
(18, 'cable', 'C', NULL, NULL, 400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `paquete_viejo` varchar(30) DEFAULT NULL,
  `paquete_nuevo` varchar(30) DEFAULT NULL,
  `plan_canal_v` varchar(30) DEFAULT NULL,
  `plan_canal_n` varchar(30) DEFAULT NULL,
  `fact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `pass_admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `correo`, `telefono`, `direccion`, `pass_admin`) VALUES
(3, 'jariany', '4321', 'jarynd@gmail.com', '04247172897', 'Pueblo nuevo', ''),
(5, 'adrian', '', 'adriandmc@gmail.com', '04247461766', 'tariba', '123456'),
(6, 'jesus', 'gey', 'jesusa@gmail.com', '1561615', 'patiecitos', ''),
(8, 'luz', '10169481', 'luz@gmail.com', '04247311467', 'Tariba', ''),
(9, 'kevin', '101010', 'kevinsz@gmail.com', '0424465186', 'nameku', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canales`
--
ALTER TABLE `canales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquetes_canales`
--
ALTER TABLE `paquetes_canales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programacion_canal`
--
ALTER TABLE `programacion_canal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canales`
--
ALTER TABLE `canales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `paquetes_canales`
--
ALTER TABLE `paquetes_canales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `programacion_canal`
--
ALTER TABLE `programacion_canal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
