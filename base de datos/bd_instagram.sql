-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2024 a las 01:53:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
  `extension` varchar(10) NOT NULL,
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
(1, 'B50377FF412A13B22C5DED24D42E3867A5D26297F5D9B77201553E27443C661D', 'jpeg', 4, 'Chibi Chewbacca Sticker - 2 inch.jpeg', 126099, 'Chubacaaaa', '2024-05-21 01:34:34', 0),
(2, 'D1B2BF9965029769AB404D74B0972C7B49FCB00299EB6EBC457D618D68334624', 'png', 3, 'Captura de pantalla 2024-04-14 210845.png', 100024, 'Esta es her segun', '2024-05-21 01:47:42', 0),
(3, '15AFEB0ACEEF30E4D828C297D382216E10262BC6AB567B76F9A6A99DACDA6B60', 'png', 3, 'Captura de pantalla 2024-02-26 085020.png', 812439, 'Enamorada de esta pareja aunque sean unos mensos', '2024-05-21 01:48:12', 0),
(4, '10DAD049A91C540109CF60ADCFF29F3D0AB1B19B7F6CBD890AB4988474E6BC3C', 'png', 3, 'Captura de pantalla 2024-03-27 182411.png', 548854, 'Aqui nomas extrañando a mi panda', '2024-05-21 01:48:42', 0);

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
,`extension` varchar(10)
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
(1, 4, 2, '2024-05-20 17:35:17', 0),
(2, 3, 4, '2024-05-20 17:36:42', 0),
(3, 3, 2, '2024-05-20 17:48:58', 0),
(4, 4, 3, '2024-05-20 17:49:21', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(512) NOT NULL,
  `password_encrypted` varchar(128) NOT NULL,
  `password_salt` varchar(64) NOT NULL,
  `nombre` varchar(512) NOT NULL,
  `apellidos` varchar(512) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_hora_registro` datetime NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password_encrypted`, `password_salt`, `nombre`, `apellidos`, `genero`, `fecha_nacimiento`, `fecha_hora_registro`, `activo`, `foto_perfil`) VALUES
(2, 'Yatzi', 'yatzarieduve@gmail.com', '501273E775D27B082E0B0C0252AE64007990D3309E032816B84DDAC7B2E9A6F828DFFAF00325EEBB19E918171C977CAE7B95C8435A7EE7E27AA18D2C781F7EDB', 'C07EF685BE15E0BC32C28958F9B19A48', 'Yatzari Eduve', 'Pecina Vidales', 'F', '2003-08-20', '2024-05-17 14:40:53', 1, 'image.png'),
(3, 'fabi', 'fabi@gmail.com', '386B38344A91B957124219A46F1AE946E8658193A2073E0E161BD6D26D962E28DBD29884F7E24DFE6AE808FB2EE37E0B9B05BFB4ABF2532BCC73F1A9BD90F651', '17DB544BA3445F218DCAE032719F5FF73BD08091DFA7AFC378A3F123B6DEA9A7', 'fabi', 'vidales', 'F', '2003-08-20', '2024-05-17 14:48:41', 1, '3_fabi.jpeg'),
(4, 'damaris', 'damaris@gmail.com', 'D8BBB8CE8BF84C594F70D94AE953F5CF54F226A46D92CBC14D38AECE84B7A5DE7CDE2ACF5FDA1E8AEDBCE1EEE32077FB048E3EC311B492C81F58CA23D6301C05', '022E359BDEADBC8699D0FA2FDE20D1B7B8E0BCB62C40EEDD15E26E456300DCF2', 'Damaris Alexia', 'Espinosa Castro', 'F', '2003-12-13', '2024-05-20 13:28:20', 1, '4_Damaris Alexia.jpeg');

-- --------------------------------------------------------

--
-- Estructura para la vista `fotos_v`
--
DROP TABLE IF EXISTS `fotos_v`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fotos_v`  AS SELECT `f`.`id` AS `id`, `f`.`secure_id` AS `secure_id`, `f`.`usuario_subio_id` AS `usuario_subio_id`, `u`.`username` AS `usuario_subio_username`, `u`.`nombre` AS `usuario_subio_nombre`, `u`.`apellidos` AS `usuario_subio_apellidos`, `f`.`nombre_archivo` AS `nombre_archivo`, `f`.`extension` AS `extension`, `f`.`tamaño` AS `tamaño`, `f`.`descripcion` AS `descripcion`, `f`.`fecha_subido` AS `fecha_subido`, `f`.`eliminado` AS `eliminado`, (select count(0) from `fotos_likes` `l` where `l`.`foto_id` = `f`.`id` and `l`.`eliminado` = 0) AS `likes` FROM (`fotos` `f` join `usuarios` `u` on(`f`.`usuario_subio_id` = `u`.`id`)) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fotos_likes`
--
ALTER TABLE `fotos_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
