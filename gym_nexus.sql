-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2023 a las 19:37:58
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gym_nexus`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarUsuario` (IN `p_nombre` VARCHAR(255), IN `p_apellido` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_contra` VARCHAR(255), IN `p_user` VARCHAR(255), IN `p_telefono` VARCHAR(255))  BEGIN
    INSERT INTO usuario (nombre, apellido, email, contra, user, telefono)
    VALUES (p_nombre, p_apellido, p_email, p_contra, p_user, p_telefono);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `VerificarEmail` (IN `p_email` VARCHAR(255), OUT `p_count` INT)  BEGIN
    SELECT COUNT(*) INTO p_count FROM usuario WHERE email = p_email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `VerificarUser` (IN `p_user` VARCHAR(255), OUT `p_count` INT)  BEGIN
    SELECT COUNT(*) INTO p_count FROM usuario WHERE user = p_user;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `contra` varchar(256) NOT NULL,
  `user` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_admin`, `email`, `contra`, `user`) VALUES
(1, 'conde.cardo.lucas@gmail.com', '12345678', 'lucasconde'),
(2, 'sanquintas@gmail.com', '12345678', 'santiquintas'),
(3, 'gonzalomociulsky10@gmail.com', '12345678', 'gonzamochu'),
(4, 'juanmanuelpb2005@gmail.com', '12345678', 'juanmapb'),
(5, 'facu.uthu1@gmail.com', '12345678', 'facuuthu'),
(6, 'lautipvppro@gmail.com', '12345678', 'lautigarcia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(100) NOT NULL,
  `nombre` int(100) NOT NULL,
  `id_gym` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `nombregym` varchar(256) NOT NULL,
  `usuario` varchar(256) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `nombregym`, `usuario`, `comentario`, `fecha`) VALUES
(1, 'Golds Gym', 'goldsgym', 'muy buen gym', '2023-10-02'),
(2, 'Golds Gym', 'racing', 'No me gustó!', '2023-10-02'),
(3, 'Golds Gym', 'racing', 'holaaaaa', '2023-10-02'),
(5, 'gimnasio', 'l4456', 'Es demasiado malo :(', '2023-10-09'),
(6, 'Iron Fitness', 'racing', 'la verdad es que me parece muy malo', '2023-10-30'),
(7, 'La Frábrica Fitness', 'racing', 'es horrible!!!!!!', '2023-10-30'),
(8, 'Golds Gym', 'racing', 'Pretty nice!', '2023-11-09'),
(9, 'SportClub Puerto Madero', 'racing', 'damn', '2023-11-09'),
(10, 'Iron Fitness', 'uthurralt', 'Interesante!', '2023-11-09'),
(11, 'Golds Gym', 'pousadas', 'I don´t like it', '2023-11-09'),
(12, 'Fit Point', 'racing', 'El gym está bueno, pero va mucha gente', '2023-11-09'),
(13, 'Golds Gym', 'kennedy', 'Cool', '2023-11-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dueño_gym`
--

CREATE TABLE `dueño_gym` (
  `id_dueño` int(100) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `mail` text NOT NULL,
  `contraseña` text NOT NULL,
  `ubicacion` text NOT NULL,
  `nombre_gym` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gimnasio`
--

CREATE TABLE `gimnasio` (
  `id_gym` int(11) NOT NULL,
  `servicios` text NOT NULL,
  `horario` varchar(256) NOT NULL,
  `valoracion` float NOT NULL,
  `nombregym` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `user` varchar(256) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `apellido` varchar(256) NOT NULL,
  `equipamiento` text NOT NULL,
  `contra` varchar(256) NOT NULL,
  `mensualidad` varchar(256) NOT NULL,
  `dia` varchar(256) NOT NULL,
  `foto` text NOT NULL,
  `cuil` varchar(256) NOT NULL,
  `direccion` varchar(256) NOT NULL,
  `telefono` varchar(256) NOT NULL,
  `descripcion` text NOT NULL,
  `maps` text NOT NULL,
  `foto1` text NOT NULL,
  `foto2` text NOT NULL,
  `foto3` text NOT NULL,
  `foto4` text NOT NULL,
  `foto5` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gimnasio`
--

INSERT INTO `gimnasio` (`id_gym`, `servicios`, `horario`, `valoracion`, `nombregym`, `email`, `user`, `nombre`, `apellido`, `equipamiento`, `contra`, `mensualidad`, `dia`, `foto`, `cuil`, `direccion`, `telefono`, `descripcion`, `maps`, `foto1`, `foto2`, `foto3`, `foto4`, `foto5`) VALUES
(4, 'Golds Gym Venice gives you access to everything you need reach your fitness goals: all outdoor workout spaces, weight and strength training areas, a wide selection of free weights, cardio equipment, resistance machines – plus a team of certified Personal Trainers ready to support and motivate you to become the strongest version of yourself.', '5 AM–11 PM', 3.7778, 'Golds Gym', 'Contact.Venice@goldsgym.com', 'goldsgym', 'Golds', 'Gym', 'Cardio Equipment, Personal Training, Resistance Machines, Functional Training, Free Weights, Outdoor Workout and Workout Area', '12345678', '600000', '40000', 'https://upload.wikimedia.org/wikipedia/en/thumb/3/3f/Gold%27s_Gym_logo.svg/640px-Gold%27s_Gym_logo.svg.png', '12345678', '360 Hampton Dr, Venice, California, US', '+1 310-392-6004', 'Golds Gym International, Inc. is an American chain of international co-ed fitness centers (commonly referred to as gyms) originally started by Joe Gold in Venice Beach, California. Each gym offers a variety of cardio and strength training equipment as well as group exercise programs. Golds Gyms headquarters have relocated to Dallas.', 'https://www.bing.com/maps?cp=33.995436%7E-118.475254&lvl=18.4', 'https://lh3.googleusercontent.com/p/AF1QipMISq2X9VuFuCdE8QTChNLD4Ga0bISDNJ_SLb9j=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipMzygBQEzcJ00ZKqo7ErSt57t1o5gN-__uRn8QL=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipNMH29sMtxdj8JcZ_Vs7C-H7bzlPsbqcACMHXEy=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipNFL-1nvcS8UPJW3kDuxwCNp5Kkyl0RMqcygpIo=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipODJPcMV83qAZ6mvzn7HwYc5vq8cENxVIa1IDSP=s680-w680-h510'),
(6, 'Ofrecemos un servicio semi-personalizado en la sala de musculación.', '8 AM–10 PM', 3.3333, 'Iron Fitness', 'ironfitness@gmail.com', 'ironfitness', 'Juan Esteban', 'Quito', 'Máquinas multifunción', '12345678', '7500', '1000', 'https://lh3.googleusercontent.com/a-/ALV-UjXkv4W6RUWyhiX6fZYag4bkabJ_TSSoG03x31q7670GEA=w250-h250-p-rp-mo-br100', '12345678', 'Alvarez Jonte 146, Ramos Mejía', '011 2542-4642', 'Iron Fitness es un gimnasio con buen ambiente. Buena onda y motivación es algo con lo que te encontrás ni bien ingresas. Consultá por promociones al whatsapp. ', 'https://www.bing.com/maps?cp=-34.639316%7E-58.565841&lvl=16.0', 'https://lh3.googleusercontent.com/p/AF1QipNDDKZOycXwCSJqKjpuRFQmf6mPwVEoNYXafMwq=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipMm65wtHgB01nvq6ueI45ErhZF3DkihuAtkuGv2=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipO11-Poy6VOrXulSaqUU32PvA3VeKzCkr3ojIYD=s680-w680-h510', '', ''),
(7, 'EL ESTABLECIMIENTO CUENTA CON CUATRO SALONES: THE BOX Donde se realizan las clases de CROSS, FUNCIONAL y CALISTENIA. Se caracteriza por su amplio lugar y variedad de elementos que te harán llevar tu entrenamiento al máximo. CYCLING  Exclusivo de SPINNING y BIKEGYM. Con un gran sistema de luces y sonido para motivarte cada segundo. FITNESS  Completo salón en el que encontraras las clases de AEROGYM, ZUMBA, POWER LOCAL y FIT-FUNCIONAL.. MUSCULACIÓN  El que más se destaca, por estar equipado con los mejores elementos, y por la sabiduría y dedicación de los profesores, inmejorable!', '7 AM–10 PM', 4, 'La Frábrica Fitness', 'lafabricafitness1@gmail.com', 'fabricafitness', 'Juan Jose', 'De La Cruz', 'Máquinas multifunción, entrenamiento funcional y mucho más!', '12345678', '9000', '1500', 'https://media.istockphoto.com/id/1331186720/vector/dumbbell.jpg?s=612x612&w=0&k=20&c=ztAKf6ZaSrWTBQVW7Nj2yrEbGM0FxitFrze39W-HdMs=', '12345678', 'Av. de Mayo 565, Ramos Mejía', '011 2747-5985', 'QUERES CAMBIAR TU FORMA DE ENTRENAR? VENI A CONOCERNOS. NUESTRAS CLASES. CROSS FITNESS. ENTRENAMIENTO FUNCIONAL. SPINNING. STRONG LOCAL.', 'https://www.bing.com/maps?cp=-34.645778%7E-58.564746&lvl=16.0', 'https://lh3.googleusercontent.com/p/AF1QipPB-kLP8oIGYrcqFi2I4wqmNSS-mpcJJCupdyD4=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipMhb4iyxUDRnxDDc3vLoNOA4rAiEqWEofE7yuy1=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipPdpynU2qPWBh4DoUiyE6Ih1grN85ptgV0RjrMO=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipMHnhh54DmDLSqMk5VJAKIHtJaz22MVaNNW_3wZ=s680-w680-h510', ''),
(8, 'Entrenamiento con pesas, crossfit, cafetería, etc.', '7 AM–10 PM', 4, 'Fit Point', 'fitpoint@gmail.com', 'fitpoint', 'Elver', 'Galarga', 'Máquinas G-Fitness para el área de musculación y elementos Fenix para el área de cross. ', '12345678', '9000', '1500', 'https://w7.pngwing.com/pngs/779/1005/png-transparent-gym-logo.png', '12345678', ' Av. Rivadavia 14640, Villa Sarmiento', '011 3074-7272', 'Es un espacio de Gym & Cross completamente nuevo.Contamos con una cafetería donde podés tomar un café, comer algo o bien sentarte después de entrenar a descansar. Hay toma corrientes en las mesas para el que quiera trabajar, estudiar o simplemente tener un rato de ocio con la notebook.', 'https://www.bing.com/maps?cp=-34.642213%7E-58.57372&lvl=16.4', 'https://lh3.googleusercontent.com/p/AF1QipP6riy8WDxF5H0dMWaXw-pJkLBHtqwC7rjDJUFc=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipPYzJTHoTNTOWVWaAmedCkPxxE6Id-RxLsHgRBd=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipM0JXvxuxZyWjXdHZT78UCqdkZ5p61PaqaCx5jP=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipNnTJUfa5PUoAQ3vi2bydqcNFuhwrg390awVAM_=s680-w680-h510', ''),
(9, 'Entrenamiento con pesas', '6:30 AM–9 PM', 3.5, 'SportClub Puerto Madero', 'sportclub@gmail.com', 'sportclub', 'Rosa', 'Melano', 'Máquinas de pesas', '12345678', '15600', '3000', 'https://uar.com.ar/wp-content/uploads/SportClub02.png', '12345678', 'Juana Manso 295, CABA', '011 3461-2820', 'Desafiá tus límites en nuestra comunidad fitness: amplios horarios, más clases y los mejores instructores. +500 sedes +500 motivos para sentirte bien', 'https://www.bing.com/maps?cp=-34.600955%7E-58.363935&lvl=16.4', 'https://lh3.googleusercontent.com/p/AF1QipPUcYLrRn1p6RtsIp18O_QqrgExdD5hzn8nrBMP=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipO20cNpP0DK6VUN2L63liHyy10xQB3FDCasxxmo=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipNQKSHHOQzgmLYzbBzaIIB8GUKrNX3Bru--YkWi=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipNRMH6fXWtlt9mtuzrK72z77tZLXeaYvNFRQcd8=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipPpEgwuNmedQyDcVxB3aZM6BFWR2PD7nlXpInp_=s680-w680-h510'),
(10, 'Es una plaza flaco', '24 horas', 0, 'Plaza Domingo Faustino Sarmiento', 'plaza@gmail.com', 'sarmiento', 'Plaza', 'Sarmiento', 'Las maquinas que hay en las plazas', '12345678', '0', '0', 'https://lh3.googleusercontent.com/p/AF1QipMNsZDrlDXn-5hq00DrzseYm1ulGOC1M-R24Ro=s680-w680-h510', '12345678', 'Gral. Ricchieri 125, Ramos Mejia', '0', 'Espacio verde (igual mucho pasto no hay), si querés podés correr (de los chorros)', 'https://www.bing.com/maps?cp=-34.639082%7E-58.564074&lvl=16.4', 'https://lh3.googleusercontent.com/p/AF1QipOrXZ1jiqkIZgdluzRl5Rq9oP1SixJGpgipFigj=s680-w680-h510', 'https://lh3.googleusercontent.com/p/AF1QipPimblip9TM1IeBNYDGfzS0pvQGyrVk4cE5y1rw=s680-w680-h510', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuaciones`
--

CREATE TABLE `puntuaciones` (
  `id` int(11) NOT NULL,
  `nombregym` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntuaciones`
--

INSERT INTO `puntuaciones` (`id`, `nombregym`, `usuario`, `puntuacion`, `fecha`) VALUES
(1, 'Golds Gym', 'racing', 5, '2023-10-09 16:33:43'),
(2, 'Golds Gym', 'racing', 5, '2023-10-09 16:33:50'),
(3, 'Golds Gym', 'racing', 5, '2023-10-09 16:40:31'),
(4, 'Golds Gym', 'racing', 3, '2023-10-09 16:41:07'),
(5, 'Golds Gym', 'goldsgym', 1, '2023-10-09 16:42:13'),
(6, 'Golds Gym', 'l4456', 4, '2023-10-09 16:48:34'),
(7, 'gimnasio', 'racing', 2, '2023-10-09 17:12:49'),
(8, 'gimnasio', 'l4456', 1, '2023-10-09 17:13:45'),
(10, 'SportClub Puerto Madero', 'racing', 2, '2023-10-30 17:10:42'),
(11, 'Iron Fitness', 'racing', 5, '2023-10-30 17:11:12'),
(12, 'Iron Fitness', 'pepe123', 2, '2023-10-30 17:11:42'),
(13, 'Golds Gym', 'pepe123', 5, '2023-10-30 17:17:21'),
(14, 'Iron Fitness', 'uthurralt', 3, '2023-11-09 17:29:50'),
(15, 'La Frábrica Fitness', 'quintas', 4, '2023-11-09 17:30:42'),
(16, 'Golds Gym', 'pousadas', 1, '2023-11-09 17:31:39'),
(17, 'SportClub Puerto Madero', 'pousadas', 5, '2023-11-09 17:31:52'),
(18, 'Fit Point', 'racing', 4, '2023-11-09 17:32:26'),
(19, 'Golds Gym', 'kennedy', 5, '2023-11-09 17:35:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `apellido` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `contra` varchar(129) NOT NULL,
  `user` varchar(129) NOT NULL,
  `telefono` varchar(22) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `nombre`, `apellido`, `email`, `contra`, `user`, `telefono`, `foto`) VALUES
(1, '0000-00-00', 'Juan Cruz', 'pepito@pepe.com', '987654321', '', '', ''),
(2, 'juan', 'jose', 'pepe@pepe2.com', '12345678', 'pepe123', '', ''),
(3, 'fgsnsfgnghfn', 'gfhsfh', 'pepepepe3', '12345678', 'gfnsdfgnh', '0000', ''),
(4, 'fgsnsfgnghfn', 'gfhsfh', 'pepe@pepe3.com', '12345678', 'gfnsdfgnh', '0000', ''),
(5, 'fgsnsfgnghfn', 'gfhsfh', 'pepe@pepe3.com', '987654321', 'gfnsdfgnh', '', ''),
(7, 'niño', 'rata', 'nananananana@gmail.com', '66666666', 'abcdefg', '666', ''),
(11, 'niño', 'rata', 'nananananana22@gmail.com', '11111111', 'abcdefg22', '', ''),
(13, 'Lucas Ariel', 'Conde Cardó', 'racing@racing.com', '12345678', 'racing', '1137777784', 'https://lh3.googleusercontent.com/a/ACg8ocLGw-BtRH4Xs1MivXqeOZ-2LiJ9853btVQlCtav5AEMtOE=s288-c-no'),
(15, 'Lautaro Julian', 'Garcia', 'lautarogarcia@gmail.com', '12345678', 'garcia', '', ''),
(16, 'Santiago E.', 'Quintas', 'santiagoquintas@gmail.com', '12345678', 'quintas', '', ''),
(17, 'Gonzalo Daniel', 'Mociulsky', 'mociulsky@gmail.com', '12345678', 'mociulsky', '', ''),
(18, 'Facundo', 'Uthurralt', 'uthurralt@gmail.com', '12345678', 'uthurralt', '', ''),
(19, 'Juan Manuel', 'Pousadas Bernardis', 'pousadas@gmail.com', '12345678', 'pousadas', '1147589042', ''),
(20, 'John Kennedy', 'Batista de Souza', 'kennedy@gmail.com', '12345678', 'kennedy', '', 'https://img.a.transfermarkt.technology/portrait/big/856085-1680877825.jpg?lm=1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_gimnasios`
--

CREATE TABLE `usuarios_gimnasios` (
  `id` int(11) NOT NULL,
  `nombregym` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `fecha_indicacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_gimnasios`
--

INSERT INTO `usuarios_gimnasios` (`id`, `nombregym`, `usuario`, `fecha_indicacion`) VALUES
(1, 'Golds Gym', 'l4456', '2023-10-09 17:10:16'),
(2, 'gimnasio', 'racing', '2023-10-09 17:12:32'),
(3, 'gimnasio', 'l4456', '2023-10-09 17:13:41'),
(4, 'Iron Fitness', 'racing', '2023-10-30 16:18:30'),
(5, 'La Frábrica Fitness', 'racing', '2023-10-30 16:58:00'),
(6, 'Golds Gym', 'racing', '2023-11-09 16:58:35'),
(7, 'Iron Fitness', 'uthurralt', '2023-11-09 17:29:47'),
(8, 'Golds Gym', 'pousadas', '2023-11-09 17:31:43'),
(9, 'SportClub Puerto Madero', 'pousadas', '2023-11-09 17:31:53'),
(10, 'Golds Gym', 'kennedy', '2023-11-09 17:35:02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gimnasio`
--
ALTER TABLE `gimnasio`
  ADD PRIMARY KEY (`id_gym`);

--
-- Indices de la tabla `puntuaciones`
--
ALTER TABLE `puntuaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `usuarios_gimnasios`
--
ALTER TABLE `usuarios_gimnasios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `gimnasio`
--
ALTER TABLE `gimnasio`
  MODIFY `id_gym` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `puntuaciones`
--
ALTER TABLE `puntuaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios_gimnasios`
--
ALTER TABLE `usuarios_gimnasios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
