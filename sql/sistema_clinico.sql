-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2022 a las 05:02:45
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_clinico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `ID` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Motivo` text NOT NULL,
  `Medico_ID` int(11) NOT NULL,
  `Paciente_ID` int(11) NOT NULL,
  `Recepcionista_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(75) NOT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` bigint(10) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `CURP` varchar(20) NOT NULL,
  `Fecha_contratacion` date NOT NULL,
  `Especialidad` varchar(255) NOT NULL,
  `Cedula_medica` varchar(15) NOT NULL,
  `ID_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`ID`, `Nombre`, `Apellidos`, `Sexo`, `Fecha_nacimiento`, `Direccion`, `Telefono`, `Email`, `CURP`, `Fecha_contratacion`, `Especialidad`, `Cedula_medica`, `ID_user`) VALUES
(1, 'Andrea', 'Torres Andrade', 'Femenino', '1993-10-31', 'Revolución #95, Aztlán, Tonalá, Jalisco, México. C.P.45402', 3320302203, 'ana.torres7812@gmail.com', 'TOAA891245JISDOGP0', '2022-12-06', 'Anatomía Patológica', 'HUSDOUASFHJ7878', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `ID` int(11) NOT NULL,
  `CURP` varchar(20) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(75) NOT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` bigint(10) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`ID`, `CURP`, `Nombre`, `Apellidos`, `Sexo`, `Fecha_nacimiento`, `Direccion`, `Telefono`, `Email`) VALUES
(1, 'MALS021122HJCRPBA8', 'Sebastián', 'Martínez López', 'Masculino', '2023-11-08', 'Guadalajara, Jalisco, México', 3320302203, 'marvelsml25@gmail.com'),
(2, 'MALJ940802HJCRIOU9', 'Juan Ricardo', 'Martínez López', 'Masculino', '2020-12-06', 'Guadalajara, Jalisco, México', 3320302203, 'marvelsml25@gmail.com'),
(3, 'MALA301411MJICUDA0', 'Ana Isabel', 'Martínez López', 'Femenino', '2013-01-29', 'Guadalajara, Jalisco, México', 3315729512, 'ana.isabel@gmail.com'),
(4, 'MALL920927MJRCUAB7', 'Liliana', 'Martínez López', 'Femenino', '2017-08-09', 'Guadalajara, Jalisco, México', 3320302203, 'liliana.martinez@gmail.com'),
(5, 'GOGA902365HJCDTAB9', 'Alan Didier', 'Gonzalez Gonzalez', 'Masculino', '2020-09-08', 'Guadalajara, Jalisco, México', 3320302203, 'alan.didier@gmail.com'),
(7, 'LOLJ908765MJVRCPA9', 'Josefina', 'López López', 'Femenino', '2009-07-10', 'Guadalajara, Jalisco, México', 3320302203, 'josefina.lopez2312@gmail.com'),
(8, 'SAMJ342312HJCUSYAB6', 'Jorge Alberto', 'Santiago Martínez', 'Masculino', '2017-11-06', 'Guadalajara, Jalisco, México', 3320302203, 'marvelsml25@gmail.com'),
(9, 'GOOJA891234JDYSAUE8', 'José Alfredo', 'Gómez Ortíz', 'Masculino', '2021-09-07', 'Guadalajara, Jalisco, México', 3320302203, 'jose.alfredo09@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionista`
--

CREATE TABLE `recepcionista` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(75) NOT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` bigint(10) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `CURP` varchar(20) NOT NULL,
  `Fecha_contratacion` date NOT NULL,
  `ID_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recepcionista`
--

INSERT INTO `recepcionista` (`ID`, `Nombre`, `Apellidos`, `Sexo`, `Fecha_nacimiento`, `Direccion`, `Telefono`, `Email`, `CURP`, `Fecha_contratacion`, `ID_user`) VALUES
(17, 'Juan Ricardo', 'Martínez López', 'Masculino', '1994-02-08', 'Monte Alban #95, C.Aztlan, Tónala, Jalisco, México. C.P.45402', 3345843937, 'juan.ricardo@gmail.com', 'MALJ940802HJCQWKP4', '2018-08-10', 14),
(18, 'Ana Isabel', 'Martínez López', 'Femenino', '2005-07-07', 'Monte Alban #95, C.Aztlan, Tónala, Jalisco, México. C.P.45402', 3320302208, 'ana.isabel@gmail.com', 'MALA30141JICUASPO8', '2020-09-15', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_role`
--

CREATE TABLE `user_role` (
  `ID` int(11) NOT NULL,
  `Role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_role`
--

INSERT INTO `user_role` (`ID`, `Role`) VALUES
(1, 'Administrador'),
(2, 'Recepcionista'),
(3, 'Medico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `ID_user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `Username`, `Password`, `ID_user_role`) VALUES
(1, 'administrador', 'admin', 1),
(2, 'recepcionista', 'recep', 2),
(14, 'MALJ940802HJCQWKP4', '$2y$10$G0lk73FYNLJUtar52o/t3.jFiekULJ13WlvL5J3yiAS3mG5.CyXzG', 2),
(15, 'MALA30141JICUASPO8', '$2y$10$68Cex03MVnr2s8SwUJ3HGOYgZzmgtgT8FdC.dJucW0msQqYVP1wyC', 2),
(18, 'TOAA891245JISDOGP0', '$2y$10$QcokaMjKP5l2XbkNLrkHXOkS8Yca/yCsYALlR9mpMcBT1AyNL7NYC', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `foranea_medico` (`Medico_ID`),
  ADD KEY `foranea_paciente` (`Paciente_ID`),
  ADD KEY `foranea_recepcionista` (`Recepcionista_ID`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Cedula_medica` (`Cedula_medica`),
  ADD KEY `user_medic` (`ID_user`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user` (`ID_user`);

--
-- Indices de la tabla `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `rol` (`ID_user_role`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `user_role`
--
ALTER TABLE `user_role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `foranea_medico` FOREIGN KEY (`Medico_ID`) REFERENCES `medico` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foranea_paciente` FOREIGN KEY (`Paciente_ID`) REFERENCES `paciente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foranea_recepcionista` FOREIGN KEY (`Recepcionista_ID`) REFERENCES `recepcionista` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `user_medic` FOREIGN KEY (`ID_user`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  ADD CONSTRAINT `user` FOREIGN KEY (`ID_user`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `rol` FOREIGN KEY (`ID_user_role`) REFERENCES `user_role` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
