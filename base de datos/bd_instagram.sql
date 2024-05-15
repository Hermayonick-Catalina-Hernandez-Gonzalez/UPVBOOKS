-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2024 a las 15:46:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foto_blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `secure_id` varchar(64) NOT NULL,
  `usuario_subio_id` int(11) NOT NULL,
  `nombre_archivo` varchar(256) NOT NULL,
  `tamaño` int(11) NOT NULL,
  `descripcion` varchar(1024) DEFAULT NULL,
  `fecha_subido` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_likes`
--

CREATE TABLE `fotos_likes` (
  `id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `usuario_dio_like_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `fotos_v`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `fotos_v` (
`id` int(11)
,`secure_id` varchar(64)
,`usuario_subio_id` int(11)
,`usuario_subio_username` varchar(128)
,`usuario_subio_nombre` varchar(512)
,`usuario_subio_apellidos` varchar(512)
,`nombre_archivo` varchar(256)
,`tamaño` int(11)
,`descripcion` varchar(1024)
,`fecha_subido` datetime
,`eliminado` tinyint(1)
,`likes` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `id` int(11) NOT NULL,
  `usuario_seguidor_id` int(11) NOT NULL,
  `usuario_siguiendo_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(512) NOT NULL,
  `password_encrypted` varchar(128) NOT NULL,
  `password_salt` varchar(32) NOT NULL,
  `nombre` varchar(512) NOT NULL,
  `apellidos` varchar(512) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_hora_registro` datetime NOT NULL,
  `activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password_encrypted`, `password_salt`, `nombre`, `apellidos`, `genero`, `fecha_nacimiento`, `fecha_hora_registro`, `activo`) VALUES
(1, 'Yatzi', 'yatzarieduve@gmail.com', '456D089F56DAEC2002F674222BB8E4242FE9EFB60334613C820F5A8E106E56EE4048C002A977AFE1C3A47693CE916E810D37BB99DDD4BEC77DC08C0F6E302BB6', 'D5C088759836C5B4C7ED8039F172774C', 'Yatzari Eduve', 'Pecina Vidales', 'F', '2003-08-20', '2024-05-14 13:52:38', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `fotos_v`
--
DROP TABLE IF EXISTS `fotos_v`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fotos_v`  AS SELECT `f`.`id` AS `id`, `f`.`secure_id` AS `secure_id`, `f`.`usuario_subio_id` AS `usuario_subio_id`, `u`.`username` AS `usuario_subio_username`, `u`.`nombre` AS `usuario_subio_nombre`, `u`.`apellidos` AS `usuario_subio_apellidos`, `f`.`nombre_archivo` AS `nombre_archivo`, `f`.`tamaño` AS `tamaño`, `f`.`descripcion` AS `descripcion`, `f`.`fecha_subido` AS `fecha_subido`, `f`.`eliminado` AS `eliminado`, (select count(0) from `fotos_likes` `l` where `l`.`foto_id` = `f`.`id` and `l`.`eliminado` = 0) AS `likes` FROM (`fotos` `f` join `usuarios` `u` on(`f`.`usuario_subio_id` = `u`.`id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotos_likes`
--
ALTER TABLE `fotos_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
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
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos_likes`
--
ALTER TABLE `fotos_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
