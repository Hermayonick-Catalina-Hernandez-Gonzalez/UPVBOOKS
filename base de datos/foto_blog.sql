-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2024 a las 10:48:15
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
  `extension` varchar(255) NOT NULL,
  `usuario_subio_id` int(11) NOT NULL,
  `nombre_archivo` varchar(256) NOT NULL,
  `tamaño` int(11) NOT NULL,
  `descripcion` varchar(1024) DEFAULT NULL,
  `fecha_subido` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `secure_id`, `extension`, `usuario_subio_id`, `nombre_archivo`, `tamaño`, `descripcion`, `fecha_subido`, `eliminado`) VALUES
(3, '587FB6E7A9AE36976BAC090289AD11E6DF84C89AE636F3310436B35C6DE1E721', 'jpg', 1, 'amigos.jpg', 214585, 'Una fotillo', '2024-04-15 00:41:22', 0),
(4, 'FB6EF29D523CDE1EAD44254A4BA6D353BCB35FC3A40B5C039374B6FC1C831118', 'png', 1, 'leonardo.png', 3911, 'Leo', '2024-04-15 01:06:55', 0),
(5, 'AF2613E24119BD6AFADBBA35E21AE6FA8FCD85F3583FB4BF09760698F49C2F00', 'png', 1, 'leonardo.png', 3911, NULL, '2024-04-15 01:31:55', 1),
(6, 'D3D100F76299EE497F75C7EF6CD63A3406E60AB6472840748FEE7901F64A9010', 'png', 1, 'Captura de pantalla 2024-02-21 070331.png', 1519534, 'cfdnfd', '2024-04-15 02:07:29', 1),
(7, '90F36822D862295B67E86F76C4429E0F08009C8E536086BC9400633B250D39D2', 'png', 1, 'Captura de pantalla 2024-02-21 070331.png', 1519534, NULL, '2024-04-15 03:23:29', 0),
(8, 'D36D1050E45DDF7BA4D1F6759D56E3409CE6E92ECD457826F57619C3EB7F35B8', 'png', 1, 'Captura de pantalla 2024-02-21 201849.png', 168344, 'fhdrh', '2024-04-15 03:28:57', 1),
(9, '68B3EE12EC571B5E9FEFAD1BB2D95A455E71980570AB66A75A932677AAC72D56', 'png', 3, 'Captura de pantalla 2024-04-14 211352.png', 191601, 'Un gato', '2024-04-15 06:18:21', 1),
(10, '87F22631C60A1A54F593DEFCF2C7B88DD7E4EEE287401954FF1C85A3483F2767', 'png', 3, 'Captura de pantalla 2024-04-14 210845.png', 100024, 'Venadito (Her)', '2024-04-15 06:22:57', 1),
(11, 'CCE5C40118BEF83AC0DCACE7AA984B716DA920DE0997A72BBE77C5F165CCF79A', 'png', 3, 'Captura de pantalla 2024-04-14 210845.png', 100024, 'Who is?', '2024-04-15 06:33:39', 0),
(12, '6AB0F5803B2E5C3036115B73308F1BB7DA84C2555C0F6A6BE870B799EC4A4E61', 'png', 1, 'Captura de pantalla 2024-02-29 190758.png', 206003, 'Que vestimenta tan formal', '2024-04-15 09:14:38', 0);

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
,`extension` varchar(255)
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

--
-- Volcado de datos para la tabla `seguidores`
--

INSERT INTO `seguidores` (`id`, `usuario_seguidor_id`, `usuario_siguiendo_id`, `fecha_hora`, `eliminado`) VALUES
(9, 4, 3, '2024-04-15 00:44:20', 0),
(10, 1, 3, '2024-04-15 01:07:13', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(128) NOT NULL,
  `password_encrypted` varchar(128) NOT NULL,
  `password_salt` varchar(64) NOT NULL,
  `nombre` varchar(512) NOT NULL,
  `apellidos` varchar(512) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_hora_registro` datetime NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `password_encrypted`, `password_salt`, `nombre`, `apellidos`, `genero`, `fecha_nacimiento`, `fecha_hora_registro`, `activo`, ) VALUES
(1, 'yatzaripecina', 'yatzarieduve@gmail.com', 'yat123', 'FDA53242FACE86C8FB077A12A5C390E317952A675E5781F6254347051CD1EC985A8799EE60C8C001B3E3A5719F25E2B0E91607C54A9BEC746F7E813816C2F3FB', '228CC22787D553E794CDDE9C5FB6B113CDC44BF328ABC021D5E24E686D982733', 'Yatzari', 'Pecina Vidales', 'F', '2003-08-20', '2024-04-13 17:49:29', 1, ),
(2, 'damarisespinosa', 'damarisespinosa@gmail.com', 'damaris123', '995D453B5C953FC3B540113006D713E9A1D8551F9C55085B22779E9DF72A2628360120CF98DBC808E185465A98246268495CD88BE9E95D88DF80D03AB95E3564', 'F8AB825CD4C09EF9130A81640C44F7B816E2544287D1DF1E8BF74C7945FC4932', 'Damaris Alexia', 'Espinosa Castro', 'F', '2003-12-13', '2024-04-13 17:51:36', 1, ),
(3, 'luisanaSalas', 'luisanasalas@gmail.com', 'luisana123', 'C39F432E7D4243108998345CF18630E4D531F6173AAACE460CA75244DBC8D8572E7906421494A7B9B1DD81BF521FA063786BA9441CDFB1D2E2F8E8F0C34850AE', 'AFE38E1D04BB18AA643C571044B66E9239539A365B2708DD7AD54D2CFAC8F829', 'Luisana', 'Rodriguez Salas', 'F', '2003-08-25', '2024-04-13 17:52:22', 1, ),
(4, 'hercitaHdz', 'herhernandez@gmail.com', 'her123', '39295C7AC699F1AFBE2229F04F3FB2E677230FEF91A056D4150729DAA96147C1E7D9249479A5821793FFC4D19DC21C11CC4998B3F2040F1A64D5F70DFBDD2928', '314436851E69BB0F9A41683680B23A02896D30DEF3A3E3EBD0369F1BFB435D14', 'Hermayonick', 'Hernandez Gonzalez', 'F', '2003-10-23', '2024-04-13 17:53:13', 1, );

-- --------------------------------------------------------

--
-- Estructura para la vista `fotos_v`
--
DROP TABLE IF EXISTS `fotos_v`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fotos_v`  AS SELECT `f`.`id` AS `id`, `f`.`secure_id` AS `secure_id`, `f`.`extension` AS `extension`, `f`.`usuario_subio_id` AS `usuario_subio_id`, `u`.`username` AS `usuario_subio_username`, `u`.`nombre` AS `usuario_subio_nombre`, `u`.`apellidos` AS `usuario_subio_apellidos`, `f`.`nombre_archivo` AS `nombre_archivo`, `f`.`tamaño` AS `tamaño`, `f`.`descripcion` AS `descripcion`, `f`.`fecha_subido` AS `fecha_subido`, `f`.`eliminado` AS `eliminado`, (select count(0) from `fotos_likes` `l` where `l`.`foto_id` = `f`.`id` and `l`.`eliminado` = 0) AS `likes` FROM (`fotos` `f` join `usuarios` `u` on(`f`.`usuario_subio_id` = `u`.`id`)) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `fotos_likes`
--
ALTER TABLE `fotos_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
