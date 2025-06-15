-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: boutique
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` longtext NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bitacora`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=311 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (204,'edwin ha cerrado sesión.','2024-09-11 23:44:36',1,'SALIDA'),(205,'edwin ha iniciado sesión.','2024-09-11 23:44:38',1,'ENTRADA'),(206,'edwin ha cerrado sesión.','2024-09-11 23:45:02',1,'SALIDA'),(207,'edwin ha iniciado sesión.','2024-09-12 12:38:18',1,'ENTRADA'),(208,'edwin ha editado un producto.','2024-09-12 15:44:55',1,'SALIDA'),(209,'edwin ha cerrado sesión.','2024-09-12 15:51:17',1,'SALIDA'),(210,'si ha iniciado sesión.','2024-09-12 15:51:20',2,'ENTRADA'),(211,'si ha cerrado sesión.','2024-09-12 15:51:24',2,'SALIDA'),(212,'edwin ha iniciado sesión.','2024-09-12 15:51:26',1,'ENTRADA'),(213,'edwin ha cerrado sesión.','2024-09-12 16:29:25',1,'SALIDA'),(214,'edwin ha iniciado sesión.','2024-09-12 16:31:46',1,'ENTRADA'),(215,'edwin ha cerrado sesión.','2024-09-12 16:31:55',1,'SALIDA'),(216,'si ha iniciado sesión.','2024-09-12 16:32:02',2,'ENTRADA'),(217,'si ha cerrado sesión.','2024-09-12 16:32:15',2,'SALIDA'),(218,'edwin ha iniciado sesión.','2024-09-12 16:32:18',1,'ENTRADA'),(219,'edwin ha hecho un ajuste en negativo (-1) del producto #6.','2024-09-12 16:35:52',1,'AJUSTE'),(220,'edwin ha aprobado el pedido #12.','2024-09-12 16:39:31',1,'SALIDA'),(221,'edwin ha cerrado sesión.','2024-09-12 16:41:37',1,'SALIDA'),(222,'si ha iniciado sesión.','2024-09-12 16:41:49',2,'ENTRADA'),(223,'si ha cerrado sesión.','2024-09-12 23:24:54',2,'SALIDA'),(224,'edwin ha iniciado sesión.','2024-09-12 23:24:58',1,'ENTRADA'),(225,'edwin ha registrado una categoría.','2024-09-14 22:31:12',1,'ENTRADA'),(226,'edwin ha cargado 1 unidades del producto #1.','2024-09-17 12:05:24',1,'CARGA'),(227,'edwin ha cargado 3 unidades del producto #1.','2024-09-17 12:05:34',1,'CARGA'),(228,'edwin ha editado un producto.','2024-09-18 23:34:00',1,'SALIDA'),(229,'edwin ha editado un producto.','2024-09-18 23:34:59',1,'SALIDA'),(230,'edwin ha editado un producto.','2024-09-18 23:42:01',1,'SALIDA'),(231,'edwin ha editado un producto.','2024-09-18 23:42:24',1,'SALIDA'),(232,'edwin ha editado un producto.','2024-09-18 23:43:25',1,'SALIDA'),(233,'edwin ha editado un producto.','2024-09-18 23:43:44',1,'SALIDA'),(234,'edwin ha editado un producto.','2024-09-18 23:55:14',1,'SALIDA'),(235,'edwin ha editado un producto.','2024-09-18 23:57:24',1,'SALIDA'),(236,'edwin ha editado un producto.','2024-09-18 23:59:46',1,'SALIDA'),(237,'edwin ha editado un producto.','2024-09-19 00:00:01',1,'SALIDA'),(238,'edwin ha editado un producto.','2024-09-19 00:03:48',1,'SALIDA'),(239,'edwin ha editado un producto.','2024-09-19 00:03:59',1,'SALIDA'),(240,'edwin ha registrado una categoría.','2024-09-19 00:07:35',1,'ENTRADA'),(241,'edwin ha editado un producto.','2024-09-19 00:08:54',1,'SALIDA'),(242,'edwin ha editado un producto.','2024-09-19 00:10:36',1,'SALIDA'),(243,'edwin ha editado un producto.','2024-09-19 09:49:00',1,'SALIDA'),(244,'edwin ha editado un producto.','2024-09-19 09:53:37',1,'SALIDA'),(245,'edwin ha eliminado el descuento del producto #115005453.','2024-09-20 10:48:51',1,'SALIDA'),(246,'edwin ha aprobado la solicitud #3.','2024-09-20 10:50:14',1,'SALIDA'),(247,'edwin ha aprobado el pedido #24.','2024-09-20 10:55:20',1,'SALIDA'),(248,'edwin ha aprobado la solicitud #4.','2024-09-20 11:03:15',1,'SALIDA'),(249,'edwin ha eliminado el descuento del producto #7.','2024-09-22 11:30:00',1,'SALIDA'),(250,'edwin ha aprobado la solicitud #5.','2024-09-22 12:18:31',1,'SALIDA'),(251,'edwin ha aprobado la solicitud #6.','2024-09-22 12:26:20',1,'SALIDA'),(252,'edwin ha aprobado la solicitud #7.','2024-09-22 12:28:39',1,'SALIDA'),(253,'edwin ha cerrado sesión.','2024-09-23 10:24:37',1,'SALIDA'),(254,'edwin ha iniciado sesión.','2024-10-15 11:55:10',1,'ENTRADA'),(255,'edwin ha eliminado el descuento del producto #6.','2024-10-21 00:23:19',1,'SALIDA'),(256,'edwin ha eliminado el descuento del producto #6.','2024-10-21 00:24:34',1,'SALIDA'),(257,'edwin ha eliminado el descuento del producto #6.','2024-10-21 00:25:32',1,'SALIDA'),(258,'edwin ha eliminado el descuento del producto #6.','2024-10-21 00:28:39',1,'SALIDA'),(259,'edwin ha eliminado el descuento del producto #6.','2024-10-21 00:32:49',1,'SALIDA'),(260,'edwin ha eliminado el descuento del producto #6.','2024-10-21 11:50:57',1,'SALIDA'),(261,'edwin ha eliminado el descuento del producto #6.','2024-10-21 11:56:43',1,'SALIDA'),(262,'edwin ha eliminado el descuento del producto #6.','2024-10-21 11:58:40',1,'SALIDA'),(263,'edwin ha eliminado el descuento del producto #6.','2024-10-21 11:59:02',1,'SALIDA'),(264,'edwin ha eliminado el descuento del producto #6.','2024-10-21 11:59:23',1,'SALIDA'),(265,'edwin ha eliminado el descuento del producto #6.','2024-10-21 12:03:38',1,'SALIDA'),(266,'edwin ha eliminado el descuento del producto #6.','2024-10-21 12:09:51',1,'SALIDA'),(267,'edwin ha aprobado el pedido #9.','2024-10-22 11:10:08',1,'SALIDA'),(268,'edwin ha aprobado el pedido #11.','2024-10-22 11:14:09',1,'SALIDA'),(269,'edwin ha aprobado el pedido #21.','2024-10-22 11:27:02',1,'SALIDA'),(270,'edwin ha cerrado sesión.','2024-10-23 12:41:57',1,'SALIDA'),(271,'edwin ha iniciado sesión.','2024-10-29 11:40:08',1,'ENTRADA'),(272,'edwin ha cerrado sesión.','2024-10-29 11:40:51',1,'SALIDA'),(273,'edwin ha iniciado sesión.','2024-11-05 12:00:30',1,'ENTRADA'),(274,'edwin ha cerrado sesión.','2024-11-05 12:00:35',1,'SALIDA'),(275,'edwin ha iniciado sesión.','2024-11-06 11:52:52',1,'ENTRADA'),(276,'edwin ha aprobado el pedido #23.','2024-11-07 11:16:06',1,'SALIDA'),(277,'edwin ha procesado una factura.','2024-11-07 12:44:08',1,'SALIDA'),(278,'edwin ha cerrado sesión.','2024-11-09 15:07:48',1,'SALIDA'),(279,'edwin ha iniciado sesión.','2024-11-09 15:08:06',1,'ENTRADA'),(280,'edwin ha cerrado sesión.','2024-11-09 15:19:50',1,'SALIDA'),(281,'edwin ha iniciado sesión.','2024-11-09 15:21:37',1,'ENTRADA'),(282,'edwin ha cerrado sesión.','2024-11-09 16:27:42',1,'SALIDA'),(283,'edwin ha iniciado sesión.','2024-11-09 19:23:41',1,'ENTRADA'),(284,'edwin ha cerrado sesión.','2024-11-09 22:11:39',1,'SALIDA'),(285,'edwin ha iniciado sesión.','2024-11-09 22:13:50',1,'ENTRADA'),(286,'edwin ha cerrado sesión.','2024-11-09 23:26:53',1,'SALIDA'),(287,'edwin ha iniciado sesión.','2024-11-10 13:34:37',1,'ENTRADA'),(288,'edwin ha cerrado sesión.','2024-11-10 13:53:38',1,'SALIDA'),(289,'edwin ha iniciado sesión.','2024-11-10 16:49:44',1,'ENTRADA'),(290,'edwin ha cerrado sesión.','2024-11-10 16:59:48',1,'SALIDA'),(291,'edwin ha iniciado sesión.','2024-11-10 17:00:28',1,'ENTRADA'),(292,'edwin ha cerrado sesión.','2024-11-10 17:19:58',1,'SALIDA'),(293,'edwin ha iniciado sesión.','2024-11-10 17:27:43',1,'ENTRADA'),(294,'edwin ha cerrado sesión.','2024-11-10 17:53:58',1,'SALIDA'),(295,'edwin ha iniciado sesión.','2024-11-10 18:02:40',1,'ENTRADA'),(296,'edwin ha cerrado sesión.','2024-11-10 18:12:42',1,'SALIDA'),(297,'edwin ha iniciado sesión.','2024-11-10 18:14:16',1,'ENTRADA'),(298,'edwin ha cerrado sesión.','2024-11-10 18:25:38',1,'SALIDA'),(299,'edwin ha iniciado sesión.','2024-11-23 10:24:41',1,'ENTRADA'),(300,'edwin ha cerrado sesión.','2024-11-23 10:26:09',1,'SALIDA'),(301,'edwin ha iniciado sesión.','2024-11-23 11:02:50',1,'ENTRADA'),(302,'edwin ha cerrado sesión.','2024-11-23 11:04:48',1,'SALIDA'),(303,'edwin ha iniciado sesión.','2024-11-24 12:41:48',1,'ENTRADA'),(304,'edwin ha cerrado sesión.','2024-11-25 10:30:00',1,'SALIDA'),(305,'edwin ha iniciado sesión.','2024-11-25 10:37:13',1,'ENTRADA'),(306,'edwin ha cerrado sesión.','2024-11-25 10:38:18',1,'SALIDA'),(307,'edwin ha iniciado sesión.','2024-11-26 09:22:55',1,'ENTRADA'),(308,'edwin ha cerrado sesión.','2024-11-28 14:58:57',1,'SALIDA'),(309,'edwin ha iniciado sesión.','2024-11-28 15:36:32',1,'ENTRADA'),(310,'edwin ha iniciado sesión.','2024-12-02 07:42:34',1,'ENTRADA');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_producto`
--

DROP TABLE IF EXISTS `categoria_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_producto` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_producto`
--

LOCK TABLES `categoria_producto` WRITE;
/*!40000 ALTER TABLE `categoria_producto` DISABLE KEYS */;
INSERT INTO `categoria_producto` VALUES (1,'Perfumes','Fragancias, Splashes y colonias para dama y caballero'),(2,'Cremas','Cremas corporales, faciales, hidratantes, etc...'),(3,'Tintes','Tintes y colorantes para modificar la tonalidad del color del cabello'),(4,'Electrónicos','Productos electrónicos de variedad'),(5,'Cosméticos','Productos de cosmética comercial con fines estéticos y de salud'),(6,'Domicilio','Servicio a domicilio'),(7,'Cuidado del cabello','Artículos para cuidado e higiene del cabello'),(8,'Producto genérico','Productos sin ninguna categoría en específico'),(9,'Dermocosmética','Productos para el cuidado y tratamiento de la piel');
/*!40000 ALTER TABLE `categoria_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `foto` longtext NOT NULL,
  `nacimiento` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'30016237','Juan','Juan Alejandro','Jimenez','juancho@gmail.com','01010101010101','1234','img_8a28a4f7aa238f8bc411c32d82be2591.jpg','2024-08-06'),(2,'5','Alfredo','Alfredo','si','si','363636','121212300','','2024-08-06'),(3,'295527','Alfonzo','Alfonzo','si','si','9292929292','78787878','','2024-08-06'),(4,'20','cg','Abdiel','Gamorra','abgamo23@gmail.com','04168340095','1234','img_3a9ee03ffc29dd27d576f57fbefe4faf.jpg','1999-06-08'),(5,'12','ejemplo','Josejuanjo','si','si','121212','123','','2024-08-06'),(6,'57','alonso_amr','Alonso','Amir','alon_gon23@gmail.com','04123469452','1234','','1997-06-04'),(7,'295549','janjo','Jan','De Sousa','janjo@gmail.com','02020202','jan','','1994-09-13'),(8,'06','Juan Guarnizo','Juan Guarnizo','si','si','080808','46','','2024-09-20');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rif` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `iva` int(11) NOT NULL,
  `color_principal` varchar(200) NOT NULL,
  `color_secundario` varchar(200) NOT NULL,
  `color_complementario` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'J-00015646483','PyR Cosmetics C.A','02020202020','pyrcosmetics@gmail.com','Zona Comercial La Mora, calle 37, Venezuela, Edo. Aragua',16,'#4b793f','#9ccc8d','#73a266');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery` (
  `id_delivery` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` date NOT NULL DEFAULT current_timestamp(),
  `estado_entrega` varchar(50) NOT NULL DEFAULT '0',
  `monto_total` double NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `metodo_pago` int(11) NOT NULL,
  `direccion` int(11) NOT NULL,
  PRIMARY KEY (`id_delivery`),
  KEY `id_cliente` (`id_cliente`),
  KEY `metodo_pago` (`metodo_pago`),
  KEY `direccion` (`direccion`),
  CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`direccion`) REFERENCES `direccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`metodo_pago`) REFERENCES `metodo_pago` (`id_metodo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery`
--

LOCK TABLES `delivery` WRITE;
/*!40000 ALTER TABLE `delivery` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descuentos`
--

DROP TABLE IF EXISTS `descuentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descuentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `porcentaje_descuento` int(11) NOT NULL,
  `precio_anterior` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `descuentos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuentos`
--

LOCK TABLES `descuentos` WRITE;
/*!40000 ALTER TABLE `descuentos` DISABLE KEYS */;
INSERT INTO `descuentos` VALUES (22,2,25,18),(24,115005453,10,23),(37,6,5,22);
/*!40000 ALTER TABLE `descuentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_carrito`
--

DROP TABLE IF EXISTS `detalle_carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_carrito` (
  `correlativo` int(11) NOT NULL AUTO_INCREMENT,
  `token_user` varchar(50) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  PRIMARY KEY (`correlativo`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_carrito`
--

LOCK TABLES `detalle_carrito` WRITE;
/*!40000 ALTER TABLE `detalle_carrito` DISABLE KEYS */;
INSERT INTO `detalle_carrito` VALUES (166,'a87ff679a2f3e71d9181a67b7542122c',2,1,13.50);
/*!40000 ALTER TABLE `detalle_carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_delivery`
--

DROP TABLE IF EXISTS `detalle_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_delivery` (
  `correlativo` int(11) NOT NULL AUTO_INCREMENT,
  `id_delivery` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `domiciliario` int(11) NOT NULL,
  PRIMARY KEY (`correlativo`),
  KEY `id_delivery` (`id_delivery`),
  KEY `cod_producto` (`cod_producto`),
  KEY `id_delivery_2` (`id_delivery`),
  KEY `id_cliente` (`id_cliente`),
  KEY `domiciliario` (`domiciliario`),
  CONSTRAINT `detalle_delivery_ibfk_1` FOREIGN KEY (`id_delivery`) REFERENCES `delivery` (`id_delivery`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_delivery_ibfk_2` FOREIGN KEY (`cod_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_delivery_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_delivery_ibfk_4` FOREIGN KEY (`domiciliario`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_delivery`
--

LOCK TABLES `detalle_delivery` WRITE;
/*!40000 ALTER TABLE `detalle_delivery` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_pedido` (
  `correlativo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nopedido` int(20) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `domiciliario` int(11) NOT NULL,
  PRIMARY KEY (`correlativo`),
  KEY `nopedido` (`nopedido`),
  KEY `codproducto` (`codproducto`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`nopedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_pedido_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
INSERT INTO `detalle_pedido` VALUES (1,1,1,4,3,20.00,0),(2,1,2,4,2,32.00,0),(3,1,6,4,1,15.00,0),(15,6,1,4,1,20.00,0),(16,6,4,4,1,15.00,0),(17,6,6,4,1,15.00,0),(18,7,2,4,1,32.00,0),(19,7,6,4,1,15.00,0),(20,8,2,4,1,32.00,0),(21,8,4,4,2,15.00,0),(23,9,1,4,2,20.00,0),(24,9,6,4,2,15.00,0),(25,9,4,4,1,15.00,0),(26,10,1,4,1,20.00,4),(27,10,4,4,1,15.00,4),(28,10,115005451,4,1,3.00,4),(29,11,2,4,3,32.00,0),(30,11,6,4,1,15.00,0),(31,12,1,4,2,20.00,0),(32,12,2,4,3,18.00,0),(57,21,6,4,1,22.00,0),(61,23,1,4,1,20.00,4),(62,23,6,4,1,22.00,4),(63,23,115005451,4,1,3.00,4),(64,24,115005453,4,1,19.55,3),(65,24,115005451,4,1,3.00,3);
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_temp`
--

DROP TABLE IF EXISTS `detalle_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_temp` (
  `correlativo` int(11) NOT NULL AUTO_INCREMENT,
  `token_empleado` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,0) NOT NULL,
  PRIMARY KEY (`correlativo`),
  KEY `token_empleado` (`token_empleado`),
  KEY `cod_producto` (`cod_producto`),
  CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_temp`
--

LOCK TABLES `detalle_temp` WRITE;
/*!40000 ALTER TABLE `detalle_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallefactura`
--

DROP TABLE IF EXISTS `detallefactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallefactura` (
  `correlativo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nofactura` int(20) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,0) NOT NULL,
  PRIMARY KEY (`correlativo`),
  KEY `nofactura` (`nofactura`),
  KEY `codproducto` (`codproducto`),
  CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nro_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallefactura`
--

LOCK TABLES `detallefactura` WRITE;
/*!40000 ALTER TABLE `detallefactura` DISABLE KEYS */;
INSERT INTO `detallefactura` VALUES (1,1,1,9,20),(2,1,2,50,32),(4,2,1,9,20),(5,2,2,50,32),(7,3,1,9,20),(8,3,2,50,32),(10,4,2,5,32),(11,4,4,1,15),(13,5,4,10,15),(14,5,6,3,15),(15,5,8,1,8),(16,6,8,1,8),(17,7,4,10,15),(18,7,2,10,32),(20,8,2,3,32),(21,8,8,2,8),(22,8,6,1,15),(23,9,2,1,32),(24,10,7,1,55),(25,11,8,1,8),(26,12,8,1,8),(37,23,4,1,15),(38,24,2,1,32),(39,25,6,1,15),(40,26,2,1,32),(41,27,2,1,32),(42,28,2,1,32),(43,29,2,1,32),(44,30,2,1,32),(45,31,2,1,32),(46,32,2,1,32),(47,32,6,5,15),(49,33,4,1,15),(50,34,6,1,15),(51,35,2,1,32),(52,36,4,1,15),(53,37,4,1,15),(54,38,4,1,15),(55,39,4,1,15),(56,40,6,1,15),(57,41,4,1,15),(58,42,4,1,15),(59,43,4,1,15),(60,44,4,1,15),(61,45,4,1,15),(62,46,4,1,15),(63,47,4,1,15),(64,48,4,1,15),(65,49,4,1,15),(66,50,4,1,15),(67,51,4,1,15),(68,52,4,1,15),(69,53,4,1,15),(70,54,4,1,15),(71,55,4,1,15),(72,56,2,1,32),(73,57,2,2,32),(74,57,4,1,15),(76,58,6,1,15),(77,58,4,1,15),(79,59,7,1,55),(80,59,6,1,15),(82,60,8,2,8),(83,60,2,1,32),(85,61,2,1,32),(86,61,8,3,8),(88,62,8,1,8),(89,63,8,2,8),(90,63,4,1,15),(92,64,2,1,32),(93,64,8,1,8),(95,65,8,1,8),(96,65,4,1,15),(98,66,2,1,32),(99,67,4,1,15),(100,67,8,1,8),(102,68,4,1,15),(103,68,8,2,8),(105,69,4,1,15),(106,69,8,2,8),(108,70,4,1,15),(109,71,4,1,15),(110,72,4,1,15),(111,73,2,1,32),(112,74,4,1,15),(113,75,4,1,15),(114,76,4,1,15),(115,77,4,1,15),(116,78,7,1,55),(117,79,4,1,15),(118,80,2,1,32),(119,80,4,1,15),(120,80,6,1,15),(121,80,8,2,8),(125,81,4,1,15),(126,81,8,3,8),(128,82,4,1,15),(129,83,6,1,15),(130,84,6,1,15),(131,85,4,1,15),(132,86,6,1,15),(133,87,2,1,32),(134,88,4,1,15),(135,89,4,1,15),(136,90,4,1,15),(137,91,4,1,15),(138,92,4,1,15),(139,93,4,1,15),(140,94,2,2,32),(141,94,4,1,15),(142,94,6,1,15),(143,95,4,1,15),(144,95,6,1,15),(145,95,2,2,32),(146,96,7,1,55),(147,96,4,1,15),(149,97,4,1,15),(150,98,4,1,15),(151,99,4,1,15),(152,100,4,1,15),(153,100,7,1,55),(154,100,2,3,32),(155,101,2,1,32),(156,102,4,1,15),(157,103,4,1,15),(158,104,4,1,15),(159,105,4,1,15),(160,106,4,1,15),(161,107,4,1,15),(162,108,4,1,15),(163,109,6,1,15),(164,110,6,1,15),(165,111,4,1,15),(166,112,7,1,55),(167,113,8,1,8),(168,114,6,1,15),(169,115,4,1,15),(170,116,4,1,15),(171,117,4,1,15),(172,118,4,1,15),(173,119,6,1,15),(174,120,8,1,8),(175,121,8,1,8),(176,122,2,1,32),(177,123,4,1,15),(178,124,4,1,15),(179,125,2,1,32),(180,126,4,1,15),(181,127,4,1,15),(182,128,4,1,15),(183,129,2,1,32),(184,130,4,1,15),(185,131,4,1,15),(186,132,4,1,15),(187,133,4,1,15),(188,134,4,1,15),(189,135,6,1,15),(190,135,8,1,8),(191,135,4,2,15),(192,136,2,1,32),(193,137,4,1,15),(194,138,1,1,20),(195,138,2,1,32),(197,139,1,3,20),(198,139,2,2,32),(199,139,6,1,15),(200,140,2,1,32),(201,140,4,2,15),(202,141,1,1,20),(203,141,4,1,15),(204,141,115005451,1,3),(205,142,115005456,16,14),(206,143,1,2,20),(207,143,2,3,18),(208,144,115005453,1,20),(209,144,115005451,1,3),(210,145,1,2,20),(211,145,6,2,15),(212,145,4,1,15),(213,146,2,3,32),(214,146,6,1,15),(216,147,6,1,22),(217,148,1,1,20),(218,148,6,1,22),(219,148,115005451,1,3),(220,149,2,2,14);
/*!40000 ALTER TABLE `detallefactura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direccion`
--

DROP TABLE IF EXISTS `direccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(400) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `direccion_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direccion`
--

LOCK TABLES `direccion` WRITE;
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
INSERT INTO `direccion` VALUES (6,'Avenida Aragua, Landaeta Ferrer, Vereda 32, casa #12.',4),(7,'Avenida 18, Turmero, Calle 17, Casa #32.',5),(8,'Avenida Aragua, Calle 22, edificio 3, vereda 12.',1),(9,'La Colonia, Colonial 27, vereda 1.',3),(10,'Avenida 22, calle 13, caracaya.',2),(11,'Avenida Rivas, hospital, Calle 42, vereda 15.',7),(12,'La mexicana, guanajuato 13, simp 44.',8),(13,'Avenida Aragua, Calle caricuao, vereda 27.',6);
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `pregunta` enum('Nombre de su primera mascota','Pelicula favorita','Pasatiempo favorito') NOT NULL,
  `respuesta` varchar(35) NOT NULL,
  `intentos` int(5) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_empleado`),
  KEY `rol` (`rol`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'admin','edwin','fragiel',1,'ewin@gmail.com','admin','','Nombre de su primera mascota','chiki',2,1),(2,'wawa','si','no',2,'awa@gmail.com','wawa','','Pasatiempo favorito','bateria',0,1),(3,'elharry_26','Luis','Alfonzo',3,'harry@gmail.com','jj','030303','Pelicula favorita','dark souls',0,1),(4,'edelberto','Edelbert','Borrero',3,'edel@gmail.com','1234','04040404','Pasatiempo favorito','jugar',0,1),(5,'joseju','jose','juanjo',2,'jj','','50505','','no\r\n',0,1);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrega`
--

DROP TABLE IF EXISTS `entrega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrega` (
  `id_entrega` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `estado_entrega` varchar(50) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_entrega`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `entrega_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `entrega_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrega`
--

LOCK TABLES `entrega` WRITE;
/*!40000 ALTER TABLE `entrega` DISABLE KEYS */;
/*!40000 ALTER TABLE `entrega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura` (
  `nro_factura` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `empleado` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `total_factura` decimal(10,0) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`nro_factura`),
  KEY `usuario` (`empleado`),
  KEY `cliente` (`cliente`),
  CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (1,'2024-07-08 22:50:33',1,1,200,1),(2,'2024-07-08 22:51:10',1,1,130,1),(3,'2024-07-08 22:54:40',1,1,1780,1),(4,'2024-07-08 23:44:15',1,1,175,1),(5,'2024-07-08 23:48:36',1,3,203,1),(6,'2024-07-08 23:49:32',1,3,8,1),(7,'2024-07-09 21:51:56',1,1,470,1),(8,'2024-07-09 21:54:52',1,3,127,1),(9,'2024-07-09 21:56:18',1,1,32,1),(10,'2024-07-09 22:04:11',1,1,55,1),(11,'2024-07-09 22:06:30',1,3,8,2),(12,'2024-07-09 22:08:15',1,3,8,1),(23,'2024-07-09 22:46:33',1,5,15,1),(24,'2024-07-09 22:53:23',1,5,32,1),(25,'2024-07-09 22:54:33',1,5,15,1),(26,'2024-07-09 22:57:29',1,5,32,1),(27,'2024-07-09 22:59:26',1,5,32,1),(28,'2024-07-09 23:00:41',1,5,32,1),(29,'2024-07-09 23:01:56',1,5,32,1),(30,'2024-07-09 23:03:04',1,5,32,1),(31,'2024-07-09 23:03:55',1,5,32,1),(32,'2024-07-09 23:07:30',1,5,107,1),(33,'2024-07-09 23:11:10',1,5,15,1),(34,'2024-07-09 23:12:15',1,5,15,2),(35,'2024-07-09 23:13:03',1,5,32,1),(36,'2024-07-09 23:13:45',1,5,15,1),(37,'2024-07-09 23:16:16',1,5,15,1),(38,'2024-07-09 23:18:18',1,5,15,1),(39,'2024-07-09 23:19:21',1,5,15,1),(40,'2024-07-09 23:21:57',1,5,15,1),(41,'2024-07-09 23:22:21',1,5,15,1),(42,'2024-07-09 23:23:34',1,5,15,1),(43,'2024-07-09 23:25:44',1,5,15,1),(44,'2024-07-09 23:26:22',1,5,15,1),(45,'2024-07-09 23:27:54',1,5,15,1),(46,'2024-07-09 23:31:18',1,5,15,1),(47,'2024-07-09 23:31:37',1,5,15,1),(48,'2024-07-09 23:32:24',1,5,15,1),(49,'2024-07-09 23:33:46',1,5,15,1),(50,'2024-07-09 23:34:18',1,5,15,1),(51,'2024-07-09 23:35:06',1,5,15,1),(52,'2024-07-09 23:36:21',1,5,15,1),(53,'2024-07-09 23:43:49',1,5,15,2),(54,'2024-07-09 23:44:15',1,5,15,1),(55,'2024-07-09 23:45:11',1,5,15,2),(56,'2024-07-11 10:49:48',1,3,32,2),(57,'2024-07-11 11:35:47',1,1,79,1),(58,'2024-07-11 11:36:50',1,1,30,1),(59,'2024-07-11 11:38:15',1,1,70,1),(60,'2024-07-11 11:39:19',1,1,48,1),(61,'2024-07-11 11:40:31',1,1,56,1),(62,'2024-07-11 11:41:19',1,5,8,1),(63,'2024-07-11 11:41:59',1,5,31,1),(64,'2024-07-11 11:43:26',1,5,40,1),(65,'2024-07-11 11:44:47',1,1,23,2),(66,'2024-07-11 11:45:42',1,5,32,1),(67,'2024-07-11 11:46:22',1,5,23,1),(68,'2024-07-11 11:47:17',1,5,31,1),(69,'2024-07-11 11:48:48',1,5,31,1),(70,'2024-07-11 12:05:06',1,5,15,1),(71,'2024-07-11 12:22:37',1,5,15,1),(72,'2024-07-11 12:26:17',1,5,15,1),(73,'2024-07-11 12:27:35',1,5,32,1),(74,'2024-07-11 12:30:08',1,5,15,1),(75,'2024-07-11 12:32:40',1,5,15,1),(76,'2024-07-11 12:33:28',1,5,15,1),(77,'2024-07-11 12:33:54',1,5,15,1),(78,'2024-07-11 12:35:01',1,5,55,2),(79,'2024-07-11 23:47:26',1,5,15,2),(80,'2024-07-11 23:53:16',1,1,78,1),(81,'2024-07-11 23:57:07',1,1,39,2),(82,'2024-07-12 00:10:15',1,3,15,1),(83,'2024-07-12 00:14:00',1,5,15,1),(84,'2024-07-12 00:15:09',1,5,15,1),(85,'2024-07-12 00:21:05',1,1,15,1),(86,'2024-07-12 00:22:53',1,5,15,1),(87,'2024-07-12 00:31:30',1,5,32,1),(88,'2024-07-12 00:33:28',1,5,15,1),(89,'2024-07-12 00:35:34',1,5,15,10),(90,'2024-07-12 00:37:18',1,5,15,1),(91,'2024-07-12 00:38:13',1,5,15,1),(92,'2024-07-12 00:40:38',1,5,15,10),(93,'2024-07-12 10:57:09',1,5,15,1),(94,'2024-07-16 11:19:32',1,1,94,2),(95,'2024-07-16 12:11:45',1,1,94,1),(96,'2024-07-16 12:13:15',1,5,70,1),(97,'2024-07-16 12:22:37',1,5,15,1),(98,'2024-07-16 12:27:10',1,5,15,1),(99,'2024-07-16 12:29:02',1,5,15,1),(100,'2024-07-16 12:30:28',1,1,166,1),(101,'2024-07-18 11:15:49',1,5,32,1),(102,'2024-07-18 11:16:21',1,5,15,1),(103,'2024-07-18 11:16:59',1,5,15,1),(104,'2024-07-18 11:19:51',1,5,15,1),(105,'2024-07-18 11:20:20',1,5,15,1),(106,'2024-07-18 11:20:58',1,5,15,2),(107,'2024-07-18 11:21:40',1,5,15,1),(108,'2024-07-18 11:29:52',1,5,15,2),(109,'2024-07-18 11:31:39',1,5,15,2),(110,'2024-07-18 11:34:32',1,3,15,2),(111,'2024-07-18 11:35:15',1,1,15,1),(112,'2024-07-18 11:36:25',1,5,55,1),(113,'2024-07-18 11:38:07',1,5,8,1),(114,'2024-07-18 12:33:30',1,5,15,1),(115,'2024-07-18 12:38:27',1,5,15,1),(116,'2024-07-18 12:47:26',1,5,15,1),(117,'2024-07-20 11:04:30',1,5,15,1),(118,'2024-07-20 11:08:23',1,5,15,1),(119,'2024-07-20 11:10:58',1,5,15,2),(120,'2024-07-20 11:13:24',1,3,8,1),(121,'2024-07-20 11:56:44',1,1,8,1),(122,'2024-07-21 14:58:07',1,1,32,2),(123,'2024-07-21 14:59:39',1,1,15,2),(124,'2024-07-21 15:01:43',1,3,15,2),(125,'2024-07-21 15:08:10',1,5,32,1),(126,'2024-07-21 15:42:01',1,5,15,1),(127,'2024-07-21 15:42:53',1,3,15,1),(128,'2024-07-21 16:30:11',1,5,15,1),(129,'2024-07-21 16:31:52',1,3,32,1),(130,'2024-07-21 16:32:53',1,2,15,1),(131,'2024-07-21 16:33:23',1,2,15,1),(132,'2024-07-21 16:35:03',1,2,15,1),(133,'2024-07-21 16:52:58',1,2,15,2),(134,'2024-07-21 16:53:55',1,3,15,1),(135,'2024-07-21 16:56:43',1,1,53,2),(136,'2024-07-21 17:00:23',1,2,32,2),(137,'2024-07-22 00:32:42',1,5,15,2),(138,'2024-08-14 00:29:50',1,4,52,1),(139,'2024-08-14 00:40:56',1,4,139,1),(140,'2024-08-14 09:04:57',1,4,62,1),(141,'2024-08-15 12:22:48',1,4,38,1),(142,'2024-09-06 10:33:38',1,4,224,1),(143,'2024-09-12 16:39:31',1,4,94,1),(144,'2024-09-20 10:55:20',1,4,23,1),(145,'2024-10-22 11:10:08',1,4,85,1),(146,'2024-10-22 11:14:08',1,4,111,1),(147,'2024-10-22 11:27:02',1,4,22,1),(148,'2024-11-07 11:16:06',1,4,45,1),(149,'2024-11-07 12:44:08',1,1,28,1);
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodo_pago`
--

DROP TABLE IF EXISTS `metodo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodo_pago` (
  `id_metodo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_pago` varchar(50) NOT NULL,
  PRIMARY KEY (`id_metodo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pago`
--

LOCK TABLES `metodo_pago` WRITE;
/*!40000 ALTER TABLE `metodo_pago` DISABLE KEYS */;
INSERT INTO `metodo_pago` VALUES (1,'Pago móvil');
/*!40000 ALTER TABLE `metodo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_notificacion`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (1,'Se ha aprobado tu solicitud para cambio de cédula',4,'2024-08-31',1),(2,'Hay una nueva oferta disponible para tí',4,'2024-10-20',1),(4,'Se ha agregado un 5% de descuento al producto \'Tinte Revlon 1.0 Negro\'',1,'2024-10-21',1),(5,'Se ha agregado un 5% de descuento al producto \'Tinte Revlon 1.0 Negro\'',2,'2024-10-21',0),(6,'Se ha agregado un 5% de descuento al producto \'Tinte Revlon 1.0 Negro\'',3,'2024-10-21',0),(7,'Se ha agregado un 5% de descuento al producto \'Tinte Revlon 1.0 Negro\'',4,'2024-10-21',1),(9,'Se ha agregado un 5% de descuento al producto \'Tinte Revlon 1.0 Negro\'',6,'2024-10-21',0),(10,'Se ha agregado un 5% de descuento al producto \'Tinte Revlon 1.0 Negro\'',7,'2024-10-21',0),(11,'Se ha agregado un 5% de descuento al producto \'Tinte Revlon 1.0 Negro\'',8,'2024-10-21',0);
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pedido` date NOT NULL DEFAULT current_timestamp(),
  `estado_pedido` varchar(50) NOT NULL,
  `monto_total` double NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `metodo_pago` int(11) NOT NULL,
  `comprobante` longtext NOT NULL,
  `entrega` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_cliente` (`id_cliente`),
  KEY `metodo_pago` (`metodo_pago`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`metodo_pago`) REFERENCES `metodo_pago` (`id_metodo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,'2024-08-10','3',139,4,1,'gas agosto 2024.png',0),(2,'2024-08-11','3',52,4,1,'WhatsApp Image 2024-08-11 at 11.34.03 AM.jpeg',0),(6,'2024-08-12','2',50,4,1,'',0),(7,'2024-08-12','2',47,4,1,'',0),(8,'2024-08-14','3',62,4,1,'gas agosto 2024.png',0),(9,'2024-08-14','3',85,4,1,'gas agosto 2024.png',0),(10,'2024-08-15','3',38,4,1,'WhatsApp Image 2024-07-02 at 8.46.46 AM.jpeg',0),(11,'2024-08-15','3',111,4,1,'',0),(12,'2024-09-12','3',94,4,1,'binance hoy.png',0),(21,'2024-09-17','3',22,4,1,'',0),(23,'2024-09-17','3',45,4,1,'',0),(24,'2024-09-20','3',22.55,4,1,'binance hoy.png',0);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `cod_barra` varchar(200) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `stock` int(50) NOT NULL,
  `stock_min` int(50) NOT NULL,
  `stock_max` int(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `imagen` longtext NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_producto` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=115005465 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'1122221315','Colonia NightKing Special 120ml','Colonia para noche de caballero de 120ml',20.00,20,2,10,1,'NightKing',1,'knightking.jpg'),(2,'5464815151','Crema Nivea Hidratación','Crema de hidratación profunda 150ml',13.50,17,1,5,2,'Nivea',1,'nivea.jpg'),(4,'959522561','Colonia Swiss Army','Colonia de caballero Noche 100ml',12.00,23,1,6,1,'Swiss Army Inc',1,'swiss.jpg'),(6,'7590656848','Tinte Revlon 1.0 Negro','Tinte para cabello color negro puro',20.90,29,1,5,3,'Revlon',1,'revlon.png'),(7,'759000595422','Placha para cabello Revlon','Plancha profesional para cabello marca Revlon',46.00,10,7,10,4,'Revlon',1,'plancha.png'),(8,'515498921','Esmalte Valmy #50 Tiza','Esmalte para uñas marca Valmy color #50 blanco tiza',7.00,16,1,15,5,'Valmy',1,'valmy.jpg'),(115005451,'488515444848','Domicilio','Servicio de entrega a domicilio',2.00,9999997,1,1,6,'',1,''),(115005453,'200031510','Champú Pantene Restauración 400ml','Champú de restauración capilar para cabello graso, prevención de caída y fortalecimiento de raíz capilar',20.70,5,1,10,7,'Pantene',1,'pantene.jpg'),(115005454,'62623584841','Crema facial Zoah 75ml','Crema hidratante facial para evitar arrugas y desgaste por la edad',19.00,3,4,12,2,'Zoah',1,'zoah.png'),(115005455,'615111845153','Colonia King of France 100ml','Colonia para caballero aroma dulce, para noche',27.00,3,5,10,1,'KyO C.A',1,'elegante.jpg'),(115005456,'51516184655','Solución Intima Dernier Skinsept','Solución íntima para hidratación e higiene interna',14.00,8,5,36,5,'Dernier',1,'dernier.jpg'),(115005457,'44484154848','Sérum Íntimo Dernier','Sérum para hidratación íntima femenina',37.00,0,5,15,8,'Dernier',1,''),(115005458,'98999544512','Protector Solar Umbrella','Protector solar Umbrella a prueba de agua',89.00,0,2,10,9,'Umbrella',1,'umbrella.jpg'),(115005461,'77774841150','Brocha de pestañas Okoi','Brocha para rizado de pestañas profesional',23.00,0,5,10,5,'Okoi',1,'okoi.jpg'),(115005462,'3352126945','Agua miscelar Zoah','Agua miscelar exfoliante',23.00,1,5,15,5,'Zoah',1,'miscelar.png'),(115005463,'78545488451','Champú Dove 370ml','Champú Dove profesional anticaspa',42.00,1,5,10,7,'Dove\r\n',1,'dove.jpg'),(115005464,'565065065','agua','agua',56.00,0,5,10,8,'minalba\r\n',1,'');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador'),(2,'Empleado'),(3,'Domiciliario');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_cedula`
--

DROP TABLE IF EXISTS `solicitud_cedula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_cedula` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_solicitud`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `solicitud_cedula_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_cedula`
--

LOCK TABLES `solicitud_cedula` WRITE;
/*!40000 ALTER TABLE `solicitud_cedula` DISABLE KEYS */;
INSERT INTO `solicitud_cedula` VALUES (4,4,20,1),(5,4,29554701,1),(6,4,29554953,1),(7,4,29771237,1);
/*!40000 ALTER TABLE `solicitud_cedula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tienda`
--

DROP TABLE IF EXISTS `tienda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tienda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` longtext NOT NULL,
  `img_landing_1` longtext NOT NULL,
  `img_landing_2` longtext NOT NULL,
  `img_landing_3` longtext NOT NULL,
  `title_landing_1` varchar(200) NOT NULL,
  `title_landing_2` varchar(200) NOT NULL,
  `title_landing_3` varchar(200) NOT NULL,
  `txt_landing_1` varchar(200) NOT NULL,
  `txt_landing_2` varchar(200) NOT NULL,
  `txt_landing_3` varchar(200) NOT NULL,
  `instagram` varchar(200) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `whatsapp` varchar(200) NOT NULL,
  `publicidad_detalle` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tienda`
--

LOCK TABLES `tienda` WRITE;
/*!40000 ALTER TABLE `tienda` DISABLE KEYS */;
INSERT INTO `tienda` VALUES (1,'pyrcosmetics.png','1.png','2.png','3.png','Ofrecemos productos de la mejor calidad','Siéntete siempre bella, cuidada y saludable','Consiente tu rostro, tu cuerpo, tu vida','Productos de primera calidad, dermatológicamente probados. Contáctanos o mira nuestro catálogo de productos','En PyR Cosmetics, tú eres nuestra prioridad. No dejamos que la distancia se interponga en tu bienestar. ¡Ordena hoy! Con nuestro servicio de entrega a domi','No dudes en visitar nuestra tienda, y disfruta de nuestros servicios de skincare, cejas, pestañas y mucho, ¡mucho más!','https://www.instagram.com/pyr_cosmetics/','https://www.facebook.com/profile.php?id=100082931182288','584245980204','pyrcosmetics.png');
/*!40000 ALTER TABLE `tienda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'boutique'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_detalle_carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalle_carrito`(IN `codigo` INT, IN `cantidad` INT, IN `token_user` VARCHAR(50))
BEGIN
    	DECLARE precio_actual decimal(10,2);
        SELECT precio INTO precio_actual FROM producto WHERE id_producto = codigo;
        
        INSERT INTO detalle_carrito(token_user, id_producto, cantidad, precio_venta) VALUES (token_user, codigo, cantidad, precio_actual);
        
        SELECT tmp.correlativo, tmp.id_producto, p.descripcion, tmp.cantidad, tmp.precio_venta FROM detalle_carrito tmp
        INNER JOIN producto p
        ON tmp.id_producto = p.id_producto
        WHERE tmp.token_user = token_user;
   	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_detalle_temp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalle_temp`(IN `codigo` INT, IN `cantidad` INT, IN `token_user` VARCHAR(50))
BEGIN
    
    	DECLARE precio_actual decimal(10,2);
        SELECT precio INTO precio_actual FROM producto WHERE id_producto = codigo;
        
        INSERT INTO detalle_temp(token_empleado, cod_producto, cantidad, precio_venta) VALUES (token_user, codigo, cantidad, precio_actual);
        
        SELECT tmp.correlativo, tmp.cod_producto, p.descripcion, tmp.cantidad, tmp.precio_venta FROM detalle_temp tmp
        INNER JOIN producto p
        ON tmp.cod_producto = p.id_producto
        WHERE tmp.token_empleado = token_user;
   	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `anular_factura` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `anular_factura`(no_factura int)
BEGIN
    	DECLARE existe_factura int;
        DECLARE registros int;
        DECLARE a int;
        
        DECLARE cod_producto int;
        DECLARE cant_producto int;
        DECLARE existencia_actual int;
        DECLARE nueva_existencia int;
        
        SET existe_factura = (SELECT COUNT(*) FROM factura WHERE nro_factura = no_factura and estado = 1);
        
        IF existe_factura > 0 THEN
        	
            CREATE TEMPORARY TABLE tbl_tmp(
            	id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                cod_prod BIGINT,
                cant_prod int);
                
                SET a = 1;
                SET registros = (SELECT COUNT(*) FROM detallefactura WHERE nofactura = no_factura);
                
                IF registros > 0 THEN
                
                	INSERT INTO tbl_tmp(cod_prod, cant_prod) SELECT codproducto,cantidad FROM detallefactura WHERE nofactura = no_factura;
                    
                    WHILE a <= registros DO
                    
                    	SELECT cod_prod, cant_prod INTO cod_producto,cant_producto FROM tbl_tmp WHERE id = a;
                        SELECT stock INTO existencia_actual FROM producto WHERE id_producto = cod_producto;
                        SET nueva_existencia = existencia_actual + cant_producto;
                        
                        UPDATE producto SET stock = nueva_existencia WHERE id_producto = cod_producto;
                        
                        SET a=a+1;
                    END WHILE;
                    
                    UPDATE factura SET estado = 2 WHERE nro_factura = no_factura;
                    DROP TABLE tbl_tmp;
                    SELECT * FROM factura WHERE nro_factura = no_factura;
                
                END IF;
        ELSE
        	SELECT 0 factura;
        END IF;
    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `del_detalle_carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalle_carrito`(id_detalle int, token varchar(50))
BEGIN
        DELETE FROM detalle_carrito WHERE correlativo = id_detalle;
        
        SELECT tmp.correlativo, tmp.id_producto, p.nombre, p.descripcion, tmp.cantidad, tmp.precio_venta FROM detalle_carrito tmp
        INNER JOIN producto p
        ON tmp.id_producto = p.id_producto
        WHERE tmp.token_user = token;
   	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `del_detalle_temp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalle_temp`(id_detalle int, token varchar(50))
BEGIN
        DELETE FROM detalle_temp WHERE correlativo = id_detalle;
        
        SELECT tmp.correlativo, tmp.cod_producto, p.descripcion, tmp.cantidad, tmp.precio_venta FROM detalle_temp tmp
        INNER JOIN producto p
        ON tmp.cod_producto = p.id_producto
        WHERE tmp.token_empleado = token;
   	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `procesar_pedido` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_pedido`(IN `cod_cliente` INT, IN `estado_pedido` VARCHAR(50), IN `metodo_pago` INT, IN `token` VARCHAR(50))
BEGIN
    DECLARE id_ped INT;
    DECLARE registros INT;
    DECLARE total DECIMAL(10,2);
    DECLARE tmp_cod_producto INT;
    DECLARE tmp_cant_producto INT;
    DECLARE a INT;
    
    SET a = 1;

    -- Crear tabla temporal para almacenar productos y cantidades
    CREATE TEMPORARY TABLE tbl_tmp_tokenuser (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        cod_prod BIGINT,
        cant_prod INT
    );

    -- Contar registros en la tabla de detalles temporales
    SET registros = (SELECT COUNT(*) FROM detalle_carrito WHERE token_user = token);

    IF registros > 0 THEN
        -- Insertar productos y cantidades en la tabla temporal
        INSERT INTO tbl_tmp_tokenuser(cod_prod, cant_prod)
        SELECT id_producto, cantidad FROM detalle_carrito WHERE token_user = token;

        -- Insertar un nuevo pedido
        INSERT INTO pedido(fecha_pedido, estado_pedido, monto_total, id_cliente, metodo_pago)
        VALUES (CURRENT_DATE(), estado_pedido, 0, cod_cliente, metodo_pago);
        
        SET id_ped = LAST_INSERT_ID();

        -- Crear un detalle específico para cada pedido creado
        INSERT INTO detalle_pedido (nopedido, codproducto, id_usuario, cantidad, precio_venta)
        SELECT (id_ped) AS nopedido, id_producto, (cod_cliente) AS id_usuario, cantidad, precio_venta FROM detalle_carrito 
        WHERE token_user = token;

        -- Calcular el total y actualizar el pedido
        SET total = (SELECT SUM(cantidad * precio_venta) FROM detalle_carrito WHERE token_user = token);
        UPDATE pedido SET monto_total = total WHERE id_pedido = id_ped;

        -- Procesar cada producto en la tabla temporal
        WHILE a <= registros DO
            SELECT cod_prod, cant_prod INTO tmp_cod_producto, tmp_cant_producto FROM tbl_tmp_tokenuser WHERE id = a;

            -- Aquí puedes agregar la lógica para actualizar el stock si es necesario
            -- Por ejemplo, si tienes una tabla de productos:
            -- UPDATE producto SET stock = stock - tmp_cant_producto WHERE id_producto = tmp_cod_producto;

            SET a = a + 1;
        END WHILE;

        -- Limpiar la tabla de detalles temporales
        DELETE FROM detalle_carrito WHERE token_user = token;
        TRUNCATE TABLE tbl_tmp_tokenuser;
    ELSE
        SELECT 0; -- No hay registros para procesar
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `procesar_venta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_venta`(IN `cod_empleado` INT, IN `cod_cliente` INT, IN `token` VARCHAR(50))
BEGIN
    	
        DECLARE factura int;
        DECLARE registros int;
        DECLARE total DECIMAL(10,2);
        DECLARE nueva_existencia int;
        DECLARE existencia_actual int;
        DECLARE tmp_cod_producto int;
        DECLARE tmp_cant_producto int;
        DECLARE a int;
        SET a = 1;
        
        CREATE TEMPORARY TABLE tbl_tmp_tokenuser(
        	id bigint not null AUTO_INCREMENT PRIMARY KEY,
            cod_prod bigint,
            cant_prod int);
    	
        SET registros = (SELECT COUNT(*) FROM detalle_temp WHERE token_empleado = token);
        
        IF registros > 0 THEN
        	INSERT INTO tbl_tmp_tokenuser(cod_prod, cant_prod) SELECT cod_producto, cantidad FROM detalle_temp WHERE token_empleado = token;
            
            INSERT INTO factura(empleado,cliente) VALUES (cod_empleado, cod_cliente);
            SET factura = LAST_INSERT_ID();
            
            INSERT INTO detallefactura(nofactura,codproducto,cantidad,precio_venta) SELECT (factura) AS nofactura, cod_producto, cantidad, precio_venta FROM detalle_temp WHERE token_empleado = token;
            
            WHILE a <= registros DO
            	SELECT cod_prod,cant_prod INTO tmp_cod_producto,tmp_cant_producto FROM tbl_tmp_tokenuser WHERE id = a;
                SELECT stock INTO existencia_actual FROM producto WHERE id_producto = tmp_cod_producto;
                
                SET nueva_existencia = existencia_actual - tmp_cant_producto;
                UPDATE producto SET stock = nueva_existencia WHERE id_producto = tmp_cod_producto;
                
                SET a = a + 1;
            END WHILE;
            
            SET total = (SELECT SUM(cantidad * precio_venta) FROM detalle_temp WHERE token_empleado = token);
            UPDATE factura SET total_factura = total WHERE nro_factura = factura;
            DELETE FROM detalle_temp WHERE token_empleado = token;
            TRUNCATE TABLE tbl_tmp_tokenuser;
            SELECT * FROM factura WHERE nro_factura = factura;
            
        ELSE
        	SELECT 0;
        END IF;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `procesar_venta_2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_venta_2`(IN `cod_empleado` INT, IN `cod_cliente` INT, IN `id_ped` INT)
BEGIN
    	
        DECLARE factura int;
        DECLARE registros int;
        DECLARE total DECIMAL(10,2);
        DECLARE nueva_existencia int;
        DECLARE existencia_actual int;
        DECLARE tmp_cod_producto int;
        DECLARE tmp_cant_producto int;
        DECLARE a int;
        SET a = 1;
        
        CREATE TEMPORARY TABLE tbl_tmp_tokenuser(
        	id bigint not null AUTO_INCREMENT PRIMARY KEY,
            cod_prod bigint,
            cant_prod int);
    	
        SET registros = (SELECT COUNT(*) FROM detalle_pedido WHERE nopedido = id_ped);
        
        IF registros > 0 THEN
        	INSERT INTO tbl_tmp_tokenuser(cod_prod, cant_prod) SELECT codproducto, cantidad FROM detalle_pedido WHERE nopedido = id_ped;
            
            INSERT INTO factura(empleado,cliente) VALUES (cod_empleado, cod_cliente);
            SET factura = LAST_INSERT_ID();
            
            INSERT INTO detallefactura(nofactura,codproducto,cantidad,precio_venta) SELECT (factura) AS nofactura, codproducto, cantidad, precio_venta FROM detalle_pedido WHERE nopedido = id_ped;
            
            WHILE a <= registros DO
            	SELECT cod_prod,cant_prod INTO tmp_cod_producto,tmp_cant_producto FROM tbl_tmp_tokenuser WHERE id = a;
                SELECT stock INTO existencia_actual FROM producto WHERE id_producto = tmp_cod_producto;
                
                SET nueva_existencia = existencia_actual - tmp_cant_producto;
                UPDATE producto SET stock = nueva_existencia WHERE id_producto = tmp_cod_producto;
                
                SET a = a + 1;
            END WHILE;
            
            SET total = (SELECT SUM(cantidad * precio_venta) FROM detalle_pedido WHERE nopedido = id_ped);
            UPDATE factura SET total_factura = total WHERE nro_factura = factura;
            TRUNCATE TABLE tbl_tmp_tokenuser;
            UPDATE pedido SET estado_pedido = 3 WHERE id_pedido = id_ped;
            SELECT * FROM factura WHERE nro_factura = factura;
            
        ELSE
        	SELECT 0;
        END IF;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-02  7:42:38
