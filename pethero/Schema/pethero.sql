-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-11-2022 a las 07:03:39
-- Versión del servidor: 8.0.28
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pethero`
--
CREATE DATABASE IF NOT EXISTS `pethero` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pethero`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keepers`
--

CREATE TABLE `keepers` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `sizePet` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `days` varchar(100) DEFAULT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `owners`
--

CREATE TABLE `owners` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `reserveId` int NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pets`
--

CREATE TABLE `pets` (
  `id` int NOT NULL,
  `breed` varchar(45) NOT NULL,
  `size` varchar(45) NOT NULL,
  `observations` varchar(500) NOT NULL,
  `image` varchar(200) NOT NULL,
  `vaccinationPlan` varchar(200) NOT NULL,
  `video` varchar(200) DEFAULT NULL,
  `ownerId` int NOT NULL,
  `petTypeId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pettypes`
--

CREATE TABLE `pettypes` (
  `id` int NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `pettypes`
--

INSERT INTO `pettypes` (`id`, `type`) VALUES
(2, 'Gato'),
(1, 'Perro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserves`
--

CREATE TABLE `reserves` (
  `id` int NOT NULL,
  `keeperId` int NOT NULL,
  `petId` int NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `state` varchar(45) NOT NULL,
  `cupon_generated` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `userTypeId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usertypes`
--

INSERT INTO `usertypes` (`id`, `type`) VALUES
(2, 'Keeper'),
(1, 'Owner');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `keepers`
--
ALTER TABLE `keepers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_keepers_users1_idx` (`userId`);

--
-- Indices de la tabla `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_owners_users1_idx` (`userId`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payments_reserves1_idx` (`reserveId`);

--
-- Indices de la tabla `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pets_petTypes1_idx` (`petTypeId`),
  ADD KEY `fk_pets_owners1_idx` (`ownerId`);

--
-- Indices de la tabla `pettypes`
--
ALTER TABLE `pettypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_UNIQUE` (`type`);

--
-- Indices de la tabla `reserves`
--
ALTER TABLE `reserves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reserves_pets1_idx` (`petId`),
  ADD KEY `fk_reserves_keepers1_idx` (`keeperId`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `fk_users_userTypes_idx` (`userTypeId`);

--
-- Indices de la tabla `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_UNIQUE` (`type`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `keepers`
--
ALTER TABLE `keepers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pettypes`
--
ALTER TABLE `pettypes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reserves`
--
ALTER TABLE `reserves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `keepers`
--
ALTER TABLE `keepers`
  ADD CONSTRAINT `fk_keepers_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `owners`
--
ALTER TABLE `owners`
  ADD CONSTRAINT `fk_owners_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_reserves1` FOREIGN KEY (`reserveId`) REFERENCES `reserves` (`id`);

--
-- Filtros para la tabla `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `fk_pets_owners1` FOREIGN KEY (`ownerId`) REFERENCES `owners` (`id`),
  ADD CONSTRAINT `fk_pets_petTypes1` FOREIGN KEY (`petTypeId`) REFERENCES `pettypes` (`id`);

--
-- Filtros para la tabla `reserves`
--
ALTER TABLE `reserves`
  ADD CONSTRAINT `fk_reserves_keepers1` FOREIGN KEY (`keeperId`) REFERENCES `keepers` (`id`),
  ADD CONSTRAINT `fk_reserves_pets1` FOREIGN KEY (`petId`) REFERENCES `pets` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_userTypes` FOREIGN KEY (`userTypeId`) REFERENCES `usertypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
