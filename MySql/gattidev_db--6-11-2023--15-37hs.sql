--
-- Base de datos: `gd_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destiny`
--

DROP TABLE IF EXISTS `destiny`;
CREATE TABLE IF NOT EXISTS `destiny` (
  `id` int NOT NULL AUTO_INCREMENT,
  `destiny` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_destiny` (`destiny`)
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `destiny`
--

INSERT INTO `destiny` (`id`, `destiny`) VALUES
(2, 'Casa'),
(3, 'Departamento'),
(1, 'Local');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `dni` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dni` (`dni`)
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `patient`
--

INSERT INTO `patient` (`id`, `name`, `dni`) VALUES
(1, 'Ezequiel', '39.153.433'),
(2, 'Mateo', '38.162.422'),
(3, 'Lucia', '37.152.233');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `studies`
--

DROP TABLE IF EXISTS `studies`;
CREATE TABLE IF NOT EXISTS `studies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_patient` int NOT NULL,
  `date` date NOT NULL,
  `id_destiny` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_studies_patient` (`id_patient`),
  KEY `fk_studies_destiny` (`id_destiny`)
) ENGINE=InnoDB;


CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `id_studies` int(11) NOT NULL,
  `archivo` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_documento_studies` (`id_studies`)
) ENGINE=;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `studies`
--
ALTER TABLE `studies`
  ADD CONSTRAINT `fk_studies_destiny` FOREIGN KEY (`id_destiny`) REFERENCES `destiny` (`id`),
  ADD CONSTRAINT `fk_studies_patient` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id`);
  ALTER TABLE `documento`
  ADD CONSTRAINT `fk_documento_studies` FOREIGN KEY (`id_studies`) REFERENCES `studies` (`id`);
COMMIT;
