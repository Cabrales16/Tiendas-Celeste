-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2024 a las 03:52:43
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
-- Base de datos: `tiendasceleste1`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_detalleventa` (IN `deveco` INT(11), IN `ventco` INT(11), IN `prodco` INT(11), IN `deveca` INT(11), IN `devesu` FLOAT)   BEGIN
UPDATE detalleventa
SET VENTCODIGOFK=ventco, PRODCODIGOFK=prodco, DEVECANTIDADPROD=deveca, DEVESUBTOTAL=devesu
WHERE DEVECOGIGO=deveco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_producto` (IN `prodco` INT(11), IN `prodnom` VARCHAR(50), IN `prodpreve` FLOAT, IN `prodsto` INT(11), IN `produnime` VARCHAR(25), IN `prodfo` BLOB, IN `proddes` TEXT)   BEGIN
UPDATE producto
SET PRODNOMBRE=prodnom, PRODPRECIOVENTA=prodpreve, PRODSTOCK=prodsto, PRODUNIDADMEDIDA=produnime, PRODFOTO=prodfo, PRODDESCRPCION=proddes 
WHERE PRODCODIGO=prodco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_rol` (IN `rolco` INT(11), IN `rolnom` VARCHAR(32), IN `rolobser` VARCHAR(200), IN `rolac` TINYINT(4))   BEGIN
UPDATE rol
SET ROLNOMBRE=rolnom, ROLOBSERVACION=rolobser, ROLACTIVO=rolac
WHERE ROLCODIGO=rolco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_rol1` (IN `ROLCOD` INT(11), `ROLNOM` VARCHAR(32), IN `ROLOBS` VARCHAR(200), IN `ROLACT` TINYINT(4))   BEGIN UPDATE rol
SET ROLNOMBRE = ROLNOM, ROLOBSERVACION = ROLOBS, ROLACTIVO = ROLACT
WHERE ROLCODIGO = ROLCOD;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_usuario` (IN `usuaco` INT(11), IN `usuaident` VARCHAR(20), IN `usuatiid` VARCHAR(15), `usuanom` VARCHAR(50), IN `usuaape` VARCHAR(50), IN `usuacel` VARCHAR(15), IN `usuadire` VARCHAR(50), IN `usuausu` VARCHAR(15), `usuapas` VARCHAR(15), `usuaro` INT(11))   BEGIN
UPDATE usuario
SET USUAIDENTIFICACION=usuaident, USUATIPOID=usuatiid, USUANOMBRE=usuanom, USUAAPELLIDO=usuaape, USUACELULAR=usuacel, USUADIRECCION=usuadire, USUAUSUARIO=usuausu, USUAPASSWORD=usuapas, USUAROLFK=usuaro
WHERE USUACODIGO=ususaco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_venta` (IN `ventco` INT(11), IN `ventfe` DATE, IN `ventto` FLOAT, `usuaco` INT(11))   BEGIN
UPDATE venta
SET VENTFECHA=ventfe, VENTTOTAL=ventto, USUACODIGOFK=usuaco
WHERE VENTCODIGO=ventco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_detalleventa` (IN `deveco` INT(11))   BEGIN
DELETE FROM detalleventa
WHERE DEVECOGIGO=deveco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_producto` (IN `prodco` INT(11))   BEGIN
DELETE FROM producto
WHERE PRODCODIGO=prodco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_rol` (IN `rolco` INT(11))   BEGIN
DELETE FROM rol
WHERE ROLCODIGO=rolco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_usuario` (IN `usuaco` INT(11))   BEGIN
DELETE FROM usuario
WHERE USUACODIGO=usuaco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_venta` (IN `ventco` INT(11))   BEGIN
DELETE FROM venta
WHERE VENTCODIGO=ventco;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_detalleventa` (IN `DEVECOGIGO` INT(11), IN `VENTCODIGOFK` INT(11), IN `PRODCODIGOFK` INT(11), `DEVECANTIDADPROD` INT(11), IN `DEVESUBTOTAL` FLOAT)   BEGIN insert into detalleventa (DEVECOGIGO, VENTCODIGOFK, PRODCODIGOFK, DEVECANTIDADPROD, DEVESUBTOTAL) VALUES(DEVECOGIGO, VENTCODIGOFK, PRODCODIGOFK, DEVECANTIDADPROD, DEVESUBTOTAL); 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_producto` (IN `PRODCODIGO` INT(11), IN `PRODNOMBRE` VARCHAR(50), IN `PRODPRECIOVENTA` FLOAT, `PRODSTOCK` INT(11), IN `PRODUNIDADMEDIDA` VARCHAR(25), IN `PRODFOTO` BLOB, IN `PRODDESCRPCION` TEXT)   BEGIN insert into producto (PRODCODIGO, PRODNOMBRE, PRODPRECIOVENTA, PRODSTOCK, PRODUNIDADMEDIDA, PRODFOTO, PRODDESCRPCION) VALUES(PRODCODIGO, PRODNOMBRE, PRODPRECIOVENTA, PRODSTOCK, PRODUNIDADMEDIDA, PRODFOTO, PRODDESCRPCION); 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_rol` (IN `ROLCODIGO` INT(11), IN `ROLNOMBRE` VARCHAR(32), IN `ROLOBSERVACION` VARCHAR(200), `ROLACTIVO` TINYINT(4))   BEGIN insert into rol (ROLCODIGO, ROLNOMBRE, ROLOBSERVACION, ROLACTIVO) VALUES(ROLCODIGO, ROLNOMBRE, ROLOBSERVACION, ROLACTIVO); 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_usuario` (IN `USUACODIGO` INT(11), IN `USUAIDENTIFICACION` VARCHAR(20), IN `USUATIPOID` VARCHAR(15), `USUANOMBRE` VARCHAR(50), IN `USUAAPELLIDO` VARCHAR(50), IN `USUACELULAR` VARCHAR(15), IN `USUADIRECCION` VARCHAR(50), IN `USUAUSUARIO` VARCHAR(15), IN `USUAPASSWORD` VARCHAR(15), IN `USUAROLFK` INT(11))   BEGIN insert into usuario (USUACODIGO, USUAIDENTIFICACION, USUATIPOID, USUANOMBRE, USUAAPELLIDO, USUACELULAR, USUADIRECCION, USUAUSUARIO, USUAPASSWORD, USUAROLFK) VALUES(USUACODIGO, USUAIDENTIFICACION, USUATIPOID, USUANOMBRE, USUAAPELLIDO, USUACELULAR, USUADIRECCION, USUAUSUARIO, USUAPASSWORD, USUAROLFK); 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_venta` (IN `VENTCODIGO` INT(11), IN `VENTFECHA` DATE, IN `VENTTOTAL` FLOAT, IN `USUACODIGOFK` INT(11))   BEGIN insert into venta (VENTCODIGO, VENTFECHA, VENTTOTAL, USUACODIGOFK) VALUES(VENTCODIGO, VENTFECHA, VENTTOTAL, USUACODIGOFK); 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `DEVECOGIGO` int(11) NOT NULL,
  `VENTCODIGOFK` int(11) NOT NULL,
  `PRODCODIGOFK` int(11) NOT NULL,
  `DEVECANTIDADPROD` int(11) NOT NULL,
  `DEVESUBTOTAL` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`DEVECOGIGO`, `VENTCODIGOFK`, `PRODCODIGOFK`, `DEVECANTIDADPROD`, `DEVESUBTOTAL`) VALUES
(10001, 1003, 7, 10, 15000),
(10002, 1004, 5, 8, 32000),
(10003, 1005, 3, 12, 30000),
(10004, 1006, 6, 9, 4500),
(10005, 1007, 4, 15, 52500),
(10006, 1008, 2, 20, 30000);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `detalleventa_usuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `detalleventa_usuario` (
`DEVECOGIGO` int(11)
,`VENTCODIGOFK` int(11)
,`PRODCODIGOFK` int(11)
,`DEVECANTIDADPROD` int(11)
,`DEVESUBTOTAL` float
,`USUACODIGO` int(11)
,`USUAIDENTIFICACION` varchar(20)
,`USUATIPOID` varchar(15)
,`USUANOMBRE` varchar(50)
,`USUAAPELLIDO` varchar(50)
,`USUACELULAR` varchar(15)
,`USUADIRECCION` varchar(50)
,`USUAUSUARIO` varchar(15)
,`USUAPASSWORD` varchar(15)
,`USUAROLFK` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `detallevent_producto`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `detallevent_producto` (
`DEVECOGIGO` int(11)
,`VENTCODIGOFK` int(11)
,`PRODCODIGOFK` int(11)
,`DEVECANTIDADPROD` int(11)
,`DEVESUBTOTAL` float
,`PRODCODIGO` int(11)
,`PRODNOMBRE` varchar(50)
,`PRODPRECIOVENTA` float
,`PRODSTOCK` int(11)
,`PRODUNIDADMEDIDA` varchar(25)
,`PRODFOTO` blob
,`PRODDESCRPCION` text
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `PRODCODIGO` int(11) NOT NULL,
  `PRODNOMBRE` varchar(50) NOT NULL,
  `PRODPRECIOVENTA` float DEFAULT NULL,
  `PRODSTOCK` int(11) DEFAULT NULL,
  `PRODUNIDADMEDIDA` varchar(25) DEFAULT NULL,
  `PRODFOTO` blob DEFAULT NULL,
  `PRODDESCRPCION` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`PRODCODIGO`, `PRODNOMBRE`, `PRODPRECIOVENTA`, `PRODSTOCK`, `PRODUNIDADMEDIDA`, `PRODFOTO`, `PRODDESCRPCION`) VALUES
(1, 'Chocolates', 2000, 100, '50g', NULL, 'Dulce para enamorar'),
(2, 'Galletas', 1500, 80, '100g', NULL, 'Deliciosas para acompañar el café'),
(3, 'Refresco', 2500, 120, '500ml', NULL, 'Bebida refrescante'),
(4, 'Helado', 3500, 60, '250ml', NULL, 'Sabor a vainilla'),
(5, 'Papas', 4000, 50, '1kg', NULL, 'Bolsita de papitas'),
(6, 'Tarjeta de felicitación', 500, 200, '10x15cm', NULL, 'Para escribir mensajes especiales'),
(7, 'Caja de bombones', 1500, 80, '250g', NULL, 'Selección de chocolates finos'),
(8, 'Peluche de oso', 2500, 100, '20cm', NULL, 'Suave y adorable'),
(9, 'Ramo de flores', 3500, 60, 'Varios tipos', NULL, 'Colorido y fragante'),
(10, 'Collar de corazón', 5000, 150, 'Plata', NULL, 'Elegante y romántico');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `producto_detalleventa`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `producto_detalleventa` (
`PRODCODIGO` int(11)
,`PRODNOMBRE` varchar(50)
,`PRODPRECIOVENTA` float
,`PRODSTOCK` int(11)
,`PRODUNIDADMEDIDA` varchar(25)
,`PRODFOTO` blob
,`PRODDESCRPCION` text
,`DEVECOGIGO` int(11)
,`VENTCODIGOFK` int(11)
,`PRODCODIGOFK` int(11)
,`DEVECANTIDADPROD` int(11)
,`DEVESUBTOTAL` float
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `producto_usuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `producto_usuario` (
`PRODCODIGO` int(11)
,`PRODNOMBRE` varchar(50)
,`PRODPRECIOVENTA` float
,`PRODSTOCK` int(11)
,`PRODUNIDADMEDIDA` varchar(25)
,`PRODFOTO` blob
,`PRODDESCRPCION` text
,`VENTCODIGO` int(11)
,`VENTFECHA` date
,`VENTTOTAL` float
,`USUACODIGOFK` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `product_venta`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `product_venta` (
`PRODCODIGO` int(11)
,`PRODNOMBRE` varchar(50)
,`PRODPRECIOVENTA` float
,`PRODSTOCK` int(11)
,`PRODUNIDADMEDIDA` varchar(25)
,`PRODFOTO` blob
,`PRODDESCRPCION` text
,`VENTCODIGO` int(11)
,`VENTFECHA` date
,`VENTTOTAL` float
,`USUACODIGOFK` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ROLCODIGO` int(11) NOT NULL,
  `ROLNOMBRE` varchar(32) NOT NULL,
  `ROLOBSERVACION` varchar(200) NOT NULL,
  `ROLACTIVO` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ROLCODIGO`, `ROLNOMBRE`, `ROLOBSERVACION`, `ROLACTIVO`) VALUES
(1, 'Empleado', 'Trabajador de la empresa', NULL),
(2, 'Cliente', 'Comprador de productos o servicios de la empresa', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `USUACODIGO` int(11) NOT NULL,
  `USUAIDENTIFICACION` varchar(20) DEFAULT NULL,
  `USUATIPOID` varchar(15) DEFAULT NULL,
  `USUANOMBRE` varchar(50) NOT NULL,
  `USUAAPELLIDO` varchar(50) DEFAULT NULL,
  `USUACELULAR` varchar(15) DEFAULT NULL,
  `USUADIRECCION` varchar(50) DEFAULT NULL,
  `USUAUSUARIO` varchar(15) NOT NULL,
  `USUAPASSWORD` varchar(15) NOT NULL,
  `USUA_CORREO` varchar(30) NOT NULL,
  `USUAROLFK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`USUACODIGO`, `USUAIDENTIFICACION`, `USUATIPOID`, `USUANOMBRE`, `USUAAPELLIDO`, `USUACELULAR`, `USUADIRECCION`, `USUAUSUARIO`, `USUAPASSWORD`, `USUA_CORREO`, `USUAROLFK`) VALUES
(1000, '91827392', 'cc', 'andres', 'cabrales', '328362432', 'cll127', 'andrescab', '198273943', '', 1),
(1001, '19283897', 'cc', 'jhosep', 'solano', '312398723', 'av91', 'jhosepsol', '128392453', '', 1),
(1002, '128934323', 'cc', 'douglas', 'ramirez', '321398794', 'calle128bis', 'douglasram', '123984932', '', 2),
(1003, '987124132', 'ti', 'valentina', 'borrero', '32174893', 'calle128', 'valeborr', '18923js', '', 2),
(1004, '598347123', 'ti', 'gerson', 'sanchez', '31198735', 'avcali', 'gersonsan', 'ger893222', '', 2),
(1005, '45676243', 'cc', 'oliver', 'pastrana', '322987435', 'kr78', 'santiagopas', '9843dsad12', '', 2),
(1006, '2342345', 'cc', 'María', 'lópez', '333222111', 'Calle 123', 'marialopez', 'contrase123', '', 1),
(1007, '345646323', 'cc', 'Juan', 'Martínez', '4564564', 'Avenida Principal', 'juanmartinez', 'password123', '', 2),
(1008, '346456243', 'ti', 'Ana', 'garcía', '999888777', 'Calle Central', 'anagarcia', 'clave456', '', 1),
(1009, '123456789', 'cc', 'Sofía', 'Pérez', '987345675', 'Calle Sur', 'sofiaperez', 'contraseasd', '', 1),
(1010, '1234567835', 'ti', 'Laura', 'hernandez', '983458934523', 'Calle Sur', 'lauraher', '12938784', '', 1),
(1011, '456789123', 'cc', 'Diego', 'Gómez', '321654987', 'Avenida Norte', 'diegogomez', 'clave789', '', 2),
(1012, NULL, NULL, 'bro', NULL, NULL, NULL, 'gerson', '124123', 'andrescabrales322@gmail.com', NULL),
(1013, NULL, NULL, 'caba', NULL, NULL, NULL, 'Jhosep', '123123', 'folletoman12@gmail.com', NULL),
(1014, NULL, NULL, 'douglas', NULL, NULL, NULL, 'Douglas Eduardo', '1412343', 'dougleis@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usuario_rol`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `usuario_rol` (
`USUACODIGO` int(11)
,`USUAIDENTIFICACION` varchar(20)
,`USUATIPOID` varchar(15)
,`USUANOMBRE` varchar(50)
,`USUAAPELLIDO` varchar(50)
,`USUACELULAR` varchar(15)
,`USUADIRECCION` varchar(50)
,`USUAUSUARIO` varchar(15)
,`USUAPASSWORD` varchar(15)
,`USUAROLFK` int(11)
,`ROLCODIGO` int(11)
,`ROLNOMBRE` varchar(32)
,`ROLOBSERVACION` varchar(200)
,`ROLACTIVO` tinyint(4)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `VENTCODIGO` int(11) NOT NULL,
  `VENTFECHA` date NOT NULL,
  `VENTTOTAL` float NOT NULL,
  `USUACODIGOFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`VENTCODIGO`, `VENTFECHA`, `VENTTOTAL`, `USUACODIGOFK`) VALUES
(1000, '2020-05-09', 50000, 1003),
(1001, '2015-06-20', 65000, 1005),
(1002, '2016-08-15', 48000, 1005),
(1003, '2017-04-25', 72000, 1002),
(1004, '2018-10-10', 55000, 1001),
(1005, '2019-12-05', 69000, 1004),
(1006, '2020-07-18', 51000, 1005),
(1007, '2021-03-30', 63000, 1006),
(1008, '2022-09-14', 57000, 1011),
(1009, '2023-11-22', 68000, 1009),
(1010, '2024-02-08', 59000, 1010);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `venta_usuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `venta_usuario` (
`VENTCODIGO` int(11)
,`VENTFECHA` date
,`VENTTOTAL` float
,`USUACODIGOFK` int(11)
,`USUACODIGO` int(11)
,`USUAIDENTIFICACION` varchar(20)
,`USUATIPOID` varchar(15)
,`USUANOMBRE` varchar(50)
,`USUAAPELLIDO` varchar(50)
,`USUACELULAR` varchar(15)
,`USUADIRECCION` varchar(50)
,`USUAUSUARIO` varchar(15)
,`USUAPASSWORD` varchar(15)
,`USUAROLFK` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `detalleventa_usuario`
--
DROP TABLE IF EXISTS `detalleventa_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detalleventa_usuario`  AS SELECT `detalleventa`.`DEVECOGIGO` AS `DEVECOGIGO`, `detalleventa`.`VENTCODIGOFK` AS `VENTCODIGOFK`, `detalleventa`.`PRODCODIGOFK` AS `PRODCODIGOFK`, `detalleventa`.`DEVECANTIDADPROD` AS `DEVECANTIDADPROD`, `detalleventa`.`DEVESUBTOTAL` AS `DEVESUBTOTAL`, `usuario`.`USUACODIGO` AS `USUACODIGO`, `usuario`.`USUAIDENTIFICACION` AS `USUAIDENTIFICACION`, `usuario`.`USUATIPOID` AS `USUATIPOID`, `usuario`.`USUANOMBRE` AS `USUANOMBRE`, `usuario`.`USUAAPELLIDO` AS `USUAAPELLIDO`, `usuario`.`USUACELULAR` AS `USUACELULAR`, `usuario`.`USUADIRECCION` AS `USUADIRECCION`, `usuario`.`USUAUSUARIO` AS `USUAUSUARIO`, `usuario`.`USUAPASSWORD` AS `USUAPASSWORD`, `usuario`.`USUAROLFK` AS `USUAROLFK` FROM (`detalleventa` join `usuario`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `detallevent_producto`
--
DROP TABLE IF EXISTS `detallevent_producto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detallevent_producto`  AS SELECT `detalleventa`.`DEVECOGIGO` AS `DEVECOGIGO`, `detalleventa`.`VENTCODIGOFK` AS `VENTCODIGOFK`, `detalleventa`.`PRODCODIGOFK` AS `PRODCODIGOFK`, `detalleventa`.`DEVECANTIDADPROD` AS `DEVECANTIDADPROD`, `detalleventa`.`DEVESUBTOTAL` AS `DEVESUBTOTAL`, `producto`.`PRODCODIGO` AS `PRODCODIGO`, `producto`.`PRODNOMBRE` AS `PRODNOMBRE`, `producto`.`PRODPRECIOVENTA` AS `PRODPRECIOVENTA`, `producto`.`PRODSTOCK` AS `PRODSTOCK`, `producto`.`PRODUNIDADMEDIDA` AS `PRODUNIDADMEDIDA`, `producto`.`PRODFOTO` AS `PRODFOTO`, `producto`.`PRODDESCRPCION` AS `PRODDESCRPCION` FROM (`detalleventa` join `producto`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `producto_detalleventa`
--
DROP TABLE IF EXISTS `producto_detalleventa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `producto_detalleventa`  AS SELECT `producto`.`PRODCODIGO` AS `PRODCODIGO`, `producto`.`PRODNOMBRE` AS `PRODNOMBRE`, `producto`.`PRODPRECIOVENTA` AS `PRODPRECIOVENTA`, `producto`.`PRODSTOCK` AS `PRODSTOCK`, `producto`.`PRODUNIDADMEDIDA` AS `PRODUNIDADMEDIDA`, `producto`.`PRODFOTO` AS `PRODFOTO`, `producto`.`PRODDESCRPCION` AS `PRODDESCRPCION`, `detalleventa`.`DEVECOGIGO` AS `DEVECOGIGO`, `detalleventa`.`VENTCODIGOFK` AS `VENTCODIGOFK`, `detalleventa`.`PRODCODIGOFK` AS `PRODCODIGOFK`, `detalleventa`.`DEVECANTIDADPROD` AS `DEVECANTIDADPROD`, `detalleventa`.`DEVESUBTOTAL` AS `DEVESUBTOTAL` FROM (`producto` join `detalleventa`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `producto_usuario`
--
DROP TABLE IF EXISTS `producto_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `producto_usuario`  AS SELECT `producto`.`PRODCODIGO` AS `PRODCODIGO`, `producto`.`PRODNOMBRE` AS `PRODNOMBRE`, `producto`.`PRODPRECIOVENTA` AS `PRODPRECIOVENTA`, `producto`.`PRODSTOCK` AS `PRODSTOCK`, `producto`.`PRODUNIDADMEDIDA` AS `PRODUNIDADMEDIDA`, `producto`.`PRODFOTO` AS `PRODFOTO`, `producto`.`PRODDESCRPCION` AS `PRODDESCRPCION`, `venta`.`VENTCODIGO` AS `VENTCODIGO`, `venta`.`VENTFECHA` AS `VENTFECHA`, `venta`.`VENTTOTAL` AS `VENTTOTAL`, `venta`.`USUACODIGOFK` AS `USUACODIGOFK` FROM (`producto` join `venta`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `product_venta`
--
DROP TABLE IF EXISTS `product_venta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_venta`  AS SELECT `producto`.`PRODCODIGO` AS `PRODCODIGO`, `producto`.`PRODNOMBRE` AS `PRODNOMBRE`, `producto`.`PRODPRECIOVENTA` AS `PRODPRECIOVENTA`, `producto`.`PRODSTOCK` AS `PRODSTOCK`, `producto`.`PRODUNIDADMEDIDA` AS `PRODUNIDADMEDIDA`, `producto`.`PRODFOTO` AS `PRODFOTO`, `producto`.`PRODDESCRPCION` AS `PRODDESCRPCION`, `venta`.`VENTCODIGO` AS `VENTCODIGO`, `venta`.`VENTFECHA` AS `VENTFECHA`, `venta`.`VENTTOTAL` AS `VENTTOTAL`, `venta`.`USUACODIGOFK` AS `USUACODIGOFK` FROM (`producto` join `venta`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `usuario_rol`
--
DROP TABLE IF EXISTS `usuario_rol`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usuario_rol`  AS SELECT `usuario`.`USUACODIGO` AS `USUACODIGO`, `usuario`.`USUAIDENTIFICACION` AS `USUAIDENTIFICACION`, `usuario`.`USUATIPOID` AS `USUATIPOID`, `usuario`.`USUANOMBRE` AS `USUANOMBRE`, `usuario`.`USUAAPELLIDO` AS `USUAAPELLIDO`, `usuario`.`USUACELULAR` AS `USUACELULAR`, `usuario`.`USUADIRECCION` AS `USUADIRECCION`, `usuario`.`USUAUSUARIO` AS `USUAUSUARIO`, `usuario`.`USUAPASSWORD` AS `USUAPASSWORD`, `usuario`.`USUAROLFK` AS `USUAROLFK`, `rol`.`ROLCODIGO` AS `ROLCODIGO`, `rol`.`ROLNOMBRE` AS `ROLNOMBRE`, `rol`.`ROLOBSERVACION` AS `ROLOBSERVACION`, `rol`.`ROLACTIVO` AS `ROLACTIVO` FROM (`usuario` join `rol`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `venta_usuario`
--
DROP TABLE IF EXISTS `venta_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `venta_usuario`  AS SELECT `venta`.`VENTCODIGO` AS `VENTCODIGO`, `venta`.`VENTFECHA` AS `VENTFECHA`, `venta`.`VENTTOTAL` AS `VENTTOTAL`, `venta`.`USUACODIGOFK` AS `USUACODIGOFK`, `usuario`.`USUACODIGO` AS `USUACODIGO`, `usuario`.`USUAIDENTIFICACION` AS `USUAIDENTIFICACION`, `usuario`.`USUATIPOID` AS `USUATIPOID`, `usuario`.`USUANOMBRE` AS `USUANOMBRE`, `usuario`.`USUAAPELLIDO` AS `USUAAPELLIDO`, `usuario`.`USUACELULAR` AS `USUACELULAR`, `usuario`.`USUADIRECCION` AS `USUADIRECCION`, `usuario`.`USUAUSUARIO` AS `USUAUSUARIO`, `usuario`.`USUAPASSWORD` AS `USUAPASSWORD`, `usuario`.`USUAROLFK` AS `USUAROLFK` FROM (`venta` join `usuario`) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`DEVECOGIGO`),
  ADD KEY `VENTCODIGOFK` (`VENTCODIGOFK`),
  ADD KEY `PRODCODIGOFK` (`PRODCODIGOFK`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`PRODCODIGO`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ROLCODIGO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`USUACODIGO`),
  ADD UNIQUE KEY `USUAIDENTIFICACION` (`USUAIDENTIFICACION`),
  ADD UNIQUE KEY `USUACELULAR` (`USUACELULAR`),
  ADD KEY `USUAROLFK` (`USUAROLFK`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`VENTCODIGO`),
  ADD KEY `USUACODIGOFK` (`USUACODIGOFK`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `USUACODIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `detalleventa_ibfk_1` FOREIGN KEY (`PRODCODIGOFK`) REFERENCES `producto` (`PRODCODIGO`),
  ADD CONSTRAINT `detalleventa_ibfk_2` FOREIGN KEY (`VENTCODIGOFK`) REFERENCES `venta` (`VENTCODIGO`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`USUAROLFK`) REFERENCES `rol` (`ROLCODIGO`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`USUACODIGOFK`) REFERENCES `usuario` (`USUACODIGO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
