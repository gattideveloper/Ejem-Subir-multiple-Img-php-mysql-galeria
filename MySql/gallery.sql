--
-- Base de datos: `Medical Report`
--
CREATE DATABASE gattidev_db;
USE gattidev_db;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destiny`
--

create table destiny(
  id        int auto_increment not null,
  destiny   varchar(255) not null,
  constraint pk_destiny primary key(id),
  constraint uq_destiny unique(destiny)
) engine = InnoDB;

--
-- Volcado de datos para la tabla `destiny`
--

INSERT INTO `destiny` (`id`, `destiny`) VALUES
(1, 'Local'),
(2, 'Casa'),
(3, 'Departamento');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patient`
--
create table patient(
  id        int auto_increment not null,
  name      varchar(150) not null,
  dni       varchar(50)  not null,
  constraint pk_patient primary key(id),
  constraint uq_dni unique(dni)
) engine = InnoDB;

INSERT INTO `patient` (`id`, `name`, `dni`) VALUES
(1, 'Ezequiel', '39.153.433'),
(2, 'Banner', '38.162.422'),
(3, 'Icono', '37.152.233');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `studies`
--

create table studies(
  id                int auto_increment not null,
  id_patient        int not null,
  title             varchar(150) not null,
  medical_report    text not null,
  date              date not null,
  id_destiny        int not null,
  constraint pk_destiny primary key(id),
  constraint fk_studies_patient foreign key(id_patient) references patient(id),
  constraint fk_studies_destiny foreign key(id_destiny) references destiny(id)
) engine = InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gallery`
--
create table gallery(
  id                int auto_increment not null,
  id_studies        int not null,
  name_image        varchar(255) not null,
  constraint pk_gallery primary key(id),
  constraint fk_gallery_studies foreign key(id_studies) references studies(id)
) engine = InnoDB;
