-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 01:30:42
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
-- Base de datos: `db_universidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras_grado`
--

CREATE TABLE `carreras_grado` (
  `id_carrera` int(11) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `duracion` varchar(100) NOT NULL,
  `sede` varchar(66) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carreras_grado`
--

INSERT INTO `carreras_grado` (`id_carrera`, `carrera`, `duracion`, `sede`) VALUES
(1, 'Ingeniería En Sistemas', '5 años', 'Tandil'),
(2, 'TUDAI', '5 cuatrimestres', 'Tandil'),
(3, 'TUARI', '5 cuatrimestres', 'Tandil'),
(4, 'Prof. de Informática', '5 años', 'Tandil'),
(5, 'Prof. de Física', '5 años', 'Lamadrid'),
(6, 'Abogacía', '5 años', 'Azul'),
(16, 'Tecnologia de los alimentos', '2.5 años', 'Olavarría');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `carrera_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `nombre`, `edad`, `dni`, `carrera_id`) VALUES
(30, 'Ivan Almestro', 23, 44535277, 3),
(31, 'Jazmin Reynoso', 19, 41241447, 3),
(33, 'Sebastian Almestro', 18, 45041420, 5),
(45, 'Martin Gimenez', 20, 31231331, 5),
(46, 'Lucas Gimenez', 25, 38231331, 5),
(48, 'Maria Gimenez', 18, 43525288, 1),
(51, 'Sebastian Bernardi', 22, 40123882, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(250) NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`email`, `password`, `id`) VALUES
('ivan.almestro@hotmail.com', '$2y$10$gfBd9fY2aoPPywM4Re.j2uMVuR3GB5.rQyJldGvKvH/J7Demd4mBi', 2),
('admin@hotmail.com', '$2a$12$FUcfca.Z/f47T35wHXXxgerigUK5YhY4Ba6DcqG3.RwSODZR.K12S', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carreras_grado`
--
ALTER TABLE `carreras_grado`
  ADD PRIMARY KEY (`id_carrera`),
  ADD UNIQUE KEY `carrera` (`carrera`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera_id` (`carrera_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carreras_grado`
--
ALTER TABLE `carreras_grado`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`carrera_id`) REFERENCES `carreras_grado` (`id_carrera`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
