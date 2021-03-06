-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2022 a las 14:09:05
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `huertos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id` int(11) NOT NULL,
  `referencia` varchar(25) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `metros` int(10) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `activa` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`id`, `referencia`, `localidad`, `metros`, `imagen`, `telefono`, `activa`) VALUES
(2, '01ALQ', 'Cantillana', 49, '01ALQ.jpg', '666555333', 1),
(3, '02ALQ', 'Sevilla', 23, '02ALQ.jpg', '667999999', 1),
(4, '03ALQ', 'Huelva', 49, '03ALQ.jpg', '555000345', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `texto` longtext NOT NULL,
  `imagen` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`id`, `titulo`, `fecha`, `texto`, `imagen`) VALUES
(1, 'Primer Post', '2022-03-05', 'dfasdfadfsdfsdfsadfasfasdfasdfasdfasdfasfasfasdfasdfasdfsdfsdfkdcc   ksdfksdkaskfk kasdjfskjkasdfksadfkjasdfjkasdkjasdfk  kasdfjkskkasfjksdf jjasdkfjvksjkasdkassajdvjv kjasdjfjvj kasdfksvkjsdfjksadjfksdfkdf', 'iamgen.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descargas`
--

CREATE TABLE `descargas` (
  `id` int(11) NOT NULL,
  `referencia` varchar(25) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `enlace` varchar(200) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `activa` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `descargas`
--

INSERT INTO `descargas` (`id`, `referencia`, `titulo`, `enlace`, `imagen`, `activa`) VALUES
(2, '01DESC', 'Manual de poda', 'https://drive.google.com/file/d/1pSkkm97uZUvzdGV3QcdecOM7bm2BG2Aw', '01DESC.JPG', 1),
(3, '02DESC', 'Manual de siembra', 'https://drive.google.com/file/d/1BCTyOFIAK9DVb_ySOFHE1Sl06NCyNPI1', '02DESC.JPG', 1),
(4, '03DESC', 'Manual de semillas', 'https://drive.google.com/file/d/1Ub3D8P6Vaue4awDHKWcI1nhDKUv7b01C', '03DESC.JPG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(9) NOT NULL,
  `Nombre y Apellidos` varchar(100) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `otros` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) NOT NULL,
  `provincia` varchar(15) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `telefono` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(6) NOT NULL,
  `id_cliente` int(25) NOT NULL,
  `pedido` int(10) NOT NULL,
  `producto` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `precio` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `imagen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `referencia`, `precio`, `cantidad`, `imagen`) VALUES
(3, 'Semillas de apio', '01PROD', '3.00', 14, '01PROD.jpg'),
(4, 'Semillas de zanahoria', '20PROD', '12.00', 35, '20PROD.jpg'),
(5, 'Semillas de lechuga', '103PROD', '2.00', 15, '103PROD.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'administrador'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `referencia` varchar(25) NOT NULL,
  `servicio` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `activa` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `referencia`, `servicio`, `imagen`, `activa`) VALUES
(2, '01SH', 'Poda de árboles', '01SH.jpg', 1),
(3, '02SH', 'Inicio de huerto', '02SH.jpg', 1),
(4, '03SH', 'Retirada de tierra', '03SH.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `id_rol` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `password`, `id_rol`) VALUES
(5, 'Andres', 'micorreo2@gmail.com', '68a872697c63efdaf3c90bcc268ad7a45038d38029d0adab680d5dc761d41bc59b4ccc3b0a0f1a40b383bdb0523cdb84f5d34a825274554e01c62a077660feb6', 2),
(7, 'Antonio', 'micorreo3@gmail.com', '68a872697c63efdaf3c90bcc268ad7a45038d38029d0adab680d5dc761d41bc59b4ccc3b0a0f1a40b383bdb0523cdb84f5d34a825274554e01c62a077660feb6', 1),
(8, 'Antoro', 'micorreo4@gmail.com', '68a872697c63efdaf3c90bcc268ad7a45038d38029d0adab680d5dc761d41bc59b4ccc3b0a0f1a40b383bdb0523cdb84f5d34a825274554e01c62a077660feb6', 2),
(14, 'Antoro2', 'micorreo5@gmail.com', '68a872697c63efdaf3c90bcc268ad7a45038d38029d0adab680d5dc761d41bc59b4ccc3b0a0f1a40b383bdb0523cdb84f5d34a825274554e01c62a077660feb6', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `referencia` (`referencia`);

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `descargas`
--
ALTER TABLE `descargas`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `referencia` (`referencia`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referencia` (`referencia`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `rol` (`rol`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `referencia` (`referencia`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `descargas`
--
ALTER TABLE `descargas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
