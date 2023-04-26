-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2023 a las 13:35:27
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `diagnosticopdf1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `notas` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diagnostico`
--

INSERT INTO `diagnostico` (`id`, `paciente_id`, `date`, `notas`) VALUES
(1, 1, '2020-01-02 00:12:00', 'Llega 60 minutos antes'),
(2, 2, '2019-02-02 07:11:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_pato`
--

CREATE TABLE `diagnostico_pato` (
  `diagnostico_id` int(11) NOT NULL,
  `pato_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diagnostico_pato`
--

INSERT INTO `diagnostico_pato` (`diagnostico_id`, `pato_id`) VALUES
(1, 1),
(1, 5),
(2, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230424160634', '2023-04-24 18:06:44', 311);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `dateborn` date DEFAULT NULL,
  `dni` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `name`, `surname`, `dateborn`, `dni`, `telefono`, `direccion`) VALUES
(1, 'pepe', 'martel', '2026-02-16', '123123sd', '123124324', 'calle Principal 11'),
(2, 'ana', 'perez', '2018-02-15', '11112j', '+34622902526', 'calle Principal 11'),
(3, 'Elena', 'Salgado', '2020-01-12', '32312h', '+3432432234', 'calle Principal 32'),
(4, 'Olga', 'Ramos', '2018-03-13', '134341534k', '123124324', 'calle Principal 134');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pato`
--

CREATE TABLE `pato` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codcie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pato`
--

INSERT INTO `pato` (`id`, `titulo`, `descripcion`, `codcie`) VALUES
(1, 'G00  Meningitis bacteriana, no clasificada bajo otro concepto', 'Incluye: - aracnoiditis bacteriana - leptomeningitis bacteriana - meningitis bacteriana - paquimeningitis bacteriana Excluye 1: - meningoencefalitis bacteriana (G04.2) - meningomielitis bacteriana (G04.2)', 'G00'),
(2, 'G05  Encefalitis, mielitis y encefalomielitis en enfermedades clasificadas bajo otro concepto', 'Codifique primero enfermedad de base, tal como: - enfermedad por virus de la inmunodeficiencia humana [VIH] (B20) - otitis media supurativa (H66.01-H66.4) - poliovirus (A80.-) - triquinosis (B75) Excluye 1: - encefalitis, mielitis y encefalomielitis (en)', 'G05'),
(3, 'G08  Flebitis y tromboflebitis intracraneal e intrarraquídea', '- Embolia séptica de senos venosos y venas intracraneales o intrarraquídeas - Endoflebitis séptica de senos venosos y venas intracraneales o intrarraquídeas - Flebitis séptica de senos venosos y venas intracraneales o intrarraquídeas - Tromboflebitis sépt', 'G08'),
(4, 'A69.2 Enfermedad de Lyme', 'Eritema migrans crónico debido a Borrelia burgdorferi A69.20 Copiar al portapapeles código final Consultar correspondencia entre clasificaciones Enfermedad de Lyme, no especificada A69.21 Copiar al portapapeles código final Consultar correspondencia entre', 'A69.2'),
(5, 'Q00  Anencefalia y malformaciones similares', 'Q00.0   Anencefalia Acefalia Acrania Amielencefalia Hemianencefalia Hemicefalia', 'Q00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9B91D4487310DAD4` (`paciente_id`);

--
-- Indices de la tabla `diagnostico_pato`
--
ALTER TABLE `diagnostico_pato`
  ADD PRIMARY KEY (`diagnostico_id`,`pato_id`),
  ADD KEY `IDX_67C4D2E77A94BA1A` (`diagnostico_id`),
  ADD KEY `IDX_67C4D2E744BB6ED2` (`pato_id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pato`
--
ALTER TABLE `pato`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pato`
--
ALTER TABLE `pato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `FK_9B91D4487310DAD4` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Filtros para la tabla `diagnostico_pato`
--
ALTER TABLE `diagnostico_pato`
  ADD CONSTRAINT `FK_67C4D2E744BB6ED2` FOREIGN KEY (`pato_id`) REFERENCES `pato` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_67C4D2E77A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `diagnostico` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
