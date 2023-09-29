-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2023 a las 10:24:19
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
-- Base de datos: `marinameza`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCitas` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `tipoUsuario` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCitas`, `nombre`, `apellidos`, `telefono`, `fecha`, `hora`, `tipoUsuario`) VALUES
(42, 'Santiago', 'López', '5551234567', '2023-05-23', '09:00:00', 0),
(43, 'Emiliano', 'García', '5559876543', '2023-05-24', '11:00:00', 0),
(44, 'José', 'Rodríguez', '5558887777', '2023-05-25', '09:00:00', 0),
(45, 'Sebastián', 'Rodríguez', '5558024617', '2023-05-27', '09:00:00', 0),
(46, 'Alejandro', 'López', '5555147936', '2023-05-29', '09:00:00', 0),
(47, 'María', 'González', '5557410395', '2023-05-29', '11:00:00', 0),
(48, 'Ana', 'Torres', '5556283904', '2023-05-30', '09:00:00', 0),
(50, 'Paola', 'Sánchez', '5552739586', '2023-06-02', '09:00:00', 0),
(52, 'Alonso', 'Villa', '3114568745', '2023-05-24', '09:00:00', 0),
(54, 'Carlos', 'Ramirez', '3114562468', '2023-05-23', '11:00:00', 0),
(55, 'Carlos', 'Ramirez', '3114562597', '2023-05-23', '13:00:00', 1),
(57, 'gr', 'iu', '311118207', '2023-07-27', '09:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `correo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `FK_cita_idCita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `correo`, `FK_cita_idCita`) VALUES
(10, 'santiagolopez@gmail.com', 42),
(12, 'emilianogarcia@gmail.com', 43),
(13, 'joserodriguez@gmail.com', 44),
(14, 'alejandrolopez@gmail.com', 46),
(15, 'mariagonzalez@gmail.com', 47),
(16, 'anatorres@gmail.com', 48),
(18, 'paolasanchez@gmail.com', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fechaNacimiento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_usuario` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `apellido`, `fechaNacimiento`, `usuario`, `password`, `tipo_usuario`) VALUES
(10, 'Luis', 'Ochoa', '1998-06-01', 'luis', '123', 1),
(11, 'Miguel', 'Carrillo', '2000-11-30', 'miguel', '123', 0),
(12, 'Kevin', 'Barrera', '2001-08-25', 'kevin', '123', 0),
(13, 'Axel', 'Montaño', '2001-10-04', 'axel', '123', 0),
(14, 'Carlos', 'Trgueros', '2000-11-06', 'chino', '123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `idEncuesta` int(11) NOT NULL,
  `calificaciones` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sugerencia` longtext COLLATE utf8_unicode_ci NOT NULL,
  `FK_evento_idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`idEncuesta`, `calificaciones`, `sugerencia`, `FK_evento_idEvento`) VALUES
(49, '5-5-4-4-4-4-4-3', 'qwere                                                ', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `idEvento` int(11) NOT NULL,
  `nombre` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `noInvitados` int(11) NOT NULL,
  `tipoEvento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cotizacion` int(20) NOT NULL,
  `descripcion` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `FK_cliente_idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`idEvento`, `nombre`, `fecha`, `lugar`, `noInvitados`, `tipoEvento`, `estatus`, `cotizacion`, `descripcion`, `FK_cliente_idCliente`) VALUES
(23, 'Lopez Torres', '2023-06-28', 'Los Rosales', 350, 'Informal', 'Terminado', 18000, 'Boda estilo informal poco romantica con tematica de disfraces y electronica', 10),
(24, 'Flores Gonzales', '2023-06-20', 'La terraza', 250, 'Formal', 'Terminado', 35000, 'Boda formal entre amigos y familiares con tematica de disfraces y grupo de Rock', 15),
(32, 'Carrillo Alcantar', '2023-05-18', 'Los tulipanes', 350, 'Privado', 'Terminado', 20000, 'Boda estilo informal y poco romantica, con tematica de disfraces', 16),
(36, 'Carrillo Parra', '2023-07-27', 'El tec', 300, 'Romantico', 'Preparacion', 15000, 'Boda estilo informal y poco romantica, con tematica de disfraces', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `idFoto` int(11) NOT NULL,
  `descripcion` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `ruta` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `FK_evento_idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`idFoto`, `descripcion`, `fecha`, `ruta`, `FK_evento_idEvento`) VALUES
(7, 'boda', '2023-06-28', '../../galeria/boda.jpeg', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `tipoServicio` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre_proveedor`, `descripcion`, `tipoServicio`, `telefono`) VALUES
(12, 'Banquetes San Rafael', ' Servicio de banquete o catering para bodas puede ofrecer una amplia variedad de opciones gastronómicas, desde menús gourmet personalizados hasta estaciones de comida temáticas. También pueden proporcionar servicios de bar y personal de servicio para atender a los invitados.', 'Banquete-Catering', '5551643123'),
(13, 'Shark DJ', 'Los proveedores de música y entretenimiento para bodas pueden ofrecer una amplia gama de opciones, desde DJ profesionales y bandas en vivo hasta músicos solistas, coros o incluso artistas especiales. También pueden proporcionar equipos de sonido, iluminación y efectos visuales para animar la fiesta.', 'Música/Entretenimiento', '5554679231'),
(14, 'El catrín', 'Servicio de ballet-parking es la solución perfecta para garantizar un estacionamiento seguro y conveniente en tu evento especial. Nuestro equipo de profesionales altamente capacitados se encargará de recibir a tus invitados en la entrada, ofreciéndoles un servicio amable y cortés.', 'Ballet-Parking', '5557891346'),
(15, 'Casino Royal Wedding Experience', 'Vive una boda llena de diversión y emoción en nuestro Casino Paradise. Te ofrecemos un entorno vibrante y lleno de energía para celebrar tu gran día.', 'Casino', '5559637418'),
(16, 'Peter Parker Photographer', 'Los fotógrafos y videógrafos especializados en bodas capturan los momentos más importantes de la ceremonia y la recepción. Ofrecemos servicios de fotografía artística, álbumes personalizados, videos de alta calidad y cobertura completa del evento para que los novios puedan revivir esos momentos especiales.', 'Fotografía/Videografía', '5551233697'),
(17, 'Pastelería Pepe', 'Nuestros diseñadores de pasteles de bodas ofrecen creaciones personalizadas que se adaptan al estilo y temática de la boda. Pueden ofrecer opciones de sabores, diseños elaborados, decoraciones detalladas y la posibilidad de personalizar cada capa del pastel.', 'Pastel de bodas', '5556482195'),
(18, 'Coolprints', 'Nuestros diseñadores de invitaciones y papelería ofrecen servicios de diseño personalizado y producción de invitaciones, programas de ceremonia, tarjetas de agradecimiento y otros elementos de papelería relacionados con la boda.', 'Invitaciones y papelería', '5559639875');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idServicio` int(11) NOT NULL,
  `estatus` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cotizacion` decimal(10,2) NOT NULL,
  `descripcion` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `FK_eventos_idEventos` int(11) NOT NULL,
  `FK_proveedor_idProveedor` int(11) NOT NULL,
  `FK_eventos_cliente_idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idServicio`, `estatus`, `cotizacion`, `descripcion`, `FK_eventos_idEventos`, `FK_proveedor_idProveedor`, `FK_eventos_cliente_idCliente`) VALUES
(19, 'En Confirmación', '20000.00', 'Banquete para 300 personas,  como platillo principal: mariscos', 23, 12, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCitas`) USING BTREE;

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `FK_CITA_CLIENTE` (`FK_cita_idCita`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`idEncuesta`),
  ADD KEY `FK_EVENTO_ENCUESTAS` (`FK_evento_idEvento`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `FK_CLIENTE_EVENTO` (`FK_cliente_idCliente`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`idFoto`),
  ADD KEY `FK_EVENTO_FOTOS` (`FK_evento_idEvento`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idServicio`),
  ADD KEY `FK_CLIENTE_EVENTO:SERVICIO` (`FK_eventos_cliente_idCliente`),
  ADD KEY `FK_EVENTOS_SERVICIOS` (`FK_eventos_idEventos`),
  ADD KEY `FK_PROVEEDOR_SERVICIOS` (`FK_proveedor_idProveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `idEncuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_CITA_CLIENTE` FOREIGN KEY (`FK_cita_idCita`) REFERENCES `citas` (`idCitas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD CONSTRAINT `FK_EVENTO_ENCUESTAS` FOREIGN KEY (`FK_evento_idEvento`) REFERENCES `eventos` (`idEvento`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `FK_CLIENTE_EVENTO` FOREIGN KEY (`FK_cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `FK_EVENTO_FOTOS` FOREIGN KEY (`FK_evento_idEvento`) REFERENCES `eventos` (`idEvento`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `FK_CLIENTE_EVENTO:SERVICIO` FOREIGN KEY (`FK_eventos_cliente_idCliente`) REFERENCES `eventos` (`FK_cliente_idCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EVENTOS_SERVICIOS` FOREIGN KEY (`FK_eventos_idEventos`) REFERENCES `eventos` (`idEvento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PROVEEDOR_SERVICIOS` FOREIGN KEY (`FK_proveedor_idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
