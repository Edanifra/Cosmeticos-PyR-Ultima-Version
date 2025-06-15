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
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (1,'edwin ha iniciado sesión.','2024-06-29 12:13:41',1,'ENTRADA'),(2,'edwin ha iniciado sesión.','2024-06-29 12:15:06',1,'ENTRADA'),(3,'edwin ha cerrado sesión.','2024-06-29 12:36:25',1,'SALIDA'),(4,'edwin ha iniciado sesión.','2024-06-29 12:36:39',1,'ENTRADA'),(5,'edwin ha cerrado sesión.','2024-06-29 12:36:52',1,'SALIDA'),(6,'edwin ha iniciado sesión.','2024-06-29 12:38:18',1,'ENTRADA'),(7,'edwin ha cerrado sesión.','2024-06-29 12:38:22',1,'SALIDA'),(8,'edwin ha iniciado sesión.','2024-06-30 00:32:52',1,'ENTRADA'),(9,'edwin ha cerrado sesión.','2024-06-30 00:32:57',1,'SALIDA'),(10,'edwin ha iniciado sesión.','2024-06-30 00:33:36',1,'ENTRADA'),(11,'edwin ha cerrado sesión.','2024-06-30 00:33:40',1,'SALIDA'),(12,'edwin ha iniciado sesión.','2024-06-30 11:44:24',1,'ENTRADA'),(13,'edwin ha cerrado sesión.','2024-06-30 11:44:28',1,'SALIDA'),(14,'si ha iniciado sesión.','2024-06-30 11:46:09',2,'ENTRADA'),(15,'si ha cerrado sesión.','2024-06-30 11:46:12',2,'SALIDA'),(16,'edwin ha iniciado sesión.','2024-06-30 11:47:48',1,'ENTRADA'),(17,'edwin ha cerrado sesión.','2024-06-30 22:55:41',1,'SALIDA'),(18,'edwin ha iniciado sesión.','2024-07-01 18:42:35',1,'ENTRADA'),(19,'edwin ha cerrado sesión.','2024-07-01 22:32:36',1,'SALIDA'),(20,'edwin ha iniciado sesión.','2024-07-01 22:35:04',1,'ENTRADA'),(23,'edwin ha registrado un producto.','2024-07-03 12:39:43',1,'ENTRADA'),(24,'edwin ha cerrado sesión.','2024-07-03 12:40:49',1,'SALIDA'),(25,'edwin ha iniciado sesión.','2024-07-03 22:46:10',1,'ENTRADA'),(26,'edwin ha registrado un producto.','2024-07-04 00:02:37',1,'ENTRADA'),(27,'edwin ha registrado un producto.','2024-07-04 00:03:32',1,'ENTRADA'),(28,'edwin ha registrado un producto.','2024-07-04 00:04:21',1,'ENTRADA'),(29,'edwin ha editado un producto.','2024-07-04 12:11:28',1,'SALIDA'),(30,'edwin ha editado un producto.','2024-07-04 12:13:31',1,'SALIDA'),(31,'edwin ha editado un producto.','2024-07-04 12:14:53',1,'SALIDA'),(32,'edwin ha registrado una categoría.','2024-07-04 12:22:51',1,'ENTRADA'),(33,'edwin ha registrado una categoría.','2024-07-04 12:23:20',1,'ENTRADA'),(34,'edwin ha editado una categoría.','2024-07-05 11:38:26',1,'SALIDA'),(35,'edwin ha editado un producto.','2024-07-05 11:44:53',1,'SALIDA'),(36,'edwin ha editado un producto.','2024-07-05 11:45:02',1,'SALIDA'),(37,'edwin ha editado un producto.','2024-07-05 11:46:12',1,'SALIDA'),(38,'edwin ha editado un producto.','2024-07-05 11:46:20',1,'SALIDA'),(39,'edwin ha registrado una categoría.','2024-07-05 11:54:40',1,'ENTRADA'),(40,'edwin ha editado un producto.','2024-07-05 11:55:06',1,'SALIDA'),(41,'edwin ha editado una categoría.','2024-07-05 12:56:41',1,'SALIDA'),(42,'edwin ha editado un producto.','2024-07-05 12:58:16',1,'SALIDA'),(43,'edwin ha editado una categoría.','2024-07-05 12:59:00',1,'SALIDA'),(44,'edwin ha cerrado sesión.','2024-07-05 23:29:14',1,'SALIDA'),(45,'edwin ha iniciado sesión.','2024-07-05 23:29:35',1,'ENTRADA'),(46,'edwin ha cerrado sesión.','2024-07-08 16:13:12',1,'SALIDA'),(47,'edwin ha iniciado sesión.','2024-07-08 16:15:04',1,'ENTRADA'),(48,'edwin ha cerrado sesión.','2024-07-08 20:12:45',1,'SALIDA'),(49,'edwin ha iniciado sesión.','2024-07-08 20:13:15',1,'ENTRADA'),(50,'edwin ha iniciado sesión.','2024-07-12 12:49:22',1,'ENTRADA'),(51,'edwin ha cerrado sesión.','2024-07-13 11:20:49',1,'SALIDA'),(52,'si ha iniciado sesión.','2024-07-13 11:20:59',2,'ENTRADA'),(53,'si ha cerrado sesión.','2024-07-13 11:21:05',2,'SALIDA'),(54,'edwin ha iniciado sesión.','2024-07-13 11:21:08',1,'ENTRADA'),(55,'edwin ha eliminado un producto.','2024-07-16 11:13:27',1,'SALIDA'),(56,'edwin ha procesado una factura.','2024-07-16 12:27:10',1,'SALIDA'),(57,'edwin ha procesado una factura.','2024-07-16 12:29:02',1,'SALIDA'),(58,'edwin ha procesado una factura.','2024-07-16 12:30:28',1,'SALIDA'),(59,'edwin ha procesado una factura.','2024-07-18 11:15:49',1,'SALIDA'),(60,'edwin ha procesado una factura.','2024-07-18 11:16:21',1,'SALIDA'),(61,'edwin ha procesado una factura.','2024-07-18 11:16:59',1,'SALIDA'),(62,'edwin ha procesado una factura.','2024-07-18 11:19:51',1,'SALIDA'),(63,'edwin ha procesado una factura.','2024-07-18 11:20:20',1,'SALIDA'),(64,'edwin ha procesado una factura.','2024-07-18 11:20:58',1,'SALIDA'),(65,'edwin ha procesado una factura.','2024-07-18 11:21:40',1,'SALIDA'),(66,'edwin ha procesado una factura.','2024-07-18 11:29:52',1,'SALIDA'),(67,'edwin ha procesado una factura.','2024-07-18 11:31:39',1,'SALIDA'),(68,'edwin ha procesado una factura.','2024-07-18 11:34:32',1,'SALIDA'),(69,'edwin ha procesado una factura.','2024-07-18 11:35:15',1,'SALIDA'),(70,'edwin ha procesado una factura.','2024-07-18 11:36:25',1,'SALIDA'),(71,'edwin ha procesado una factura.','2024-07-18 11:38:07',1,'SALIDA'),(72,'edwin ha procesado una factura.','2024-07-18 12:33:30',1,'SALIDA'),(73,'edwin ha procesado una factura.','2024-07-18 12:38:27',1,'SALIDA'),(74,'edwin ha eliminado un producto.','2024-07-20 10:46:09',1,'SALIDA'),(75,'edwin ha eliminado un producto.','2024-07-20 11:00:31',1,'SALIDA'),(76,'edwin ha eliminado un producto.','2024-07-20 11:02:06',1,'SALIDA'),(77,'edwin ha procesado una factura.','2024-07-20 11:52:48',1,'SALIDA'),(78,'edwin ha procesado una factura.','2024-07-20 11:56:44',1,'SALIDA'),(79,'edwin ha cerrado sesión.','2024-07-21 00:10:11',1,'SALIDA'),(80,'edwin ha iniciado sesión.','2024-07-21 00:10:14',1,'ENTRADA'),(81,'edwin ha procesado una factura.','2024-07-21 14:58:07',1,'SALIDA'),(82,'edwin ha procesado una factura.','2024-07-21 14:59:39',1,'SALIDA'),(83,'edwin ha procesado una factura.','2024-07-21 15:01:43',1,'SALIDA'),(84,'edwin ha procesado una factura.','2024-07-21 15:08:10',1,'SALIDA'),(85,'edwin ha procesado una factura.','2024-07-21 15:42:01',1,'SALIDA'),(86,'edwin ha procesado una factura.','2024-07-21 15:42:53',1,'SALIDA'),(87,'edwin ha procesado una factura.','2024-07-21 16:30:11',1,'SALIDA'),(88,'edwin ha procesado una factura.','2024-07-21 16:31:52',1,'SALIDA'),(89,'edwin ha procesado una factura.','2024-07-21 16:32:53',1,'SALIDA'),(90,'edwin ha procesado una factura.','2024-07-21 16:33:23',1,'SALIDA'),(91,'edwin ha procesado una factura.','2024-07-21 16:35:03',1,'SALIDA'),(92,'edwin ha procesado una factura.','2024-07-21 16:52:58',1,'SALIDA'),(93,'edwin ha procesado una factura.','2024-07-21 16:53:55',1,'SALIDA'),(94,'edwin ha procesado una factura.','2024-07-21 16:56:44',1,'SALIDA'),(95,'edwin ha procesado una factura.','2024-07-21 17:00:23',1,'SALIDA'),(96,'edwin ha procesado una factura.','2024-07-22 00:32:42',1,'SALIDA'),(97,'edwin ha cerrado sesión.','2024-08-03 22:33:26',1,'SALIDA'),(98,'edwin ha iniciado sesión.','2024-08-03 22:33:30',1,'ENTRADA'),(99,'edwin ha iniciado sesión.','2024-08-06 09:08:10',1,'ENTRADA'),(100,'edwin ha cerrado sesión.','2024-08-06 09:52:01',1,'SALIDA'),(101,'edwin ha iniciado sesión.','2024-08-06 10:45:39',1,'ENTRADA'),(111,'edwin ha iniciado sesión.','2024-08-07 10:44:53',1,'ENTRADA'),(112,'edwin ha cerrado sesión.','2024-08-07 11:07:45',1,'SALIDA'),(113,'edwin ha iniciado sesión.','2024-08-07 12:15:51',1,'ENTRADA'),(114,'edwin ha cerrado sesión.','2024-08-07 12:17:14',1,'SALIDA'),(115,'edwin ha iniciado sesión.','2024-08-07 12:50:01',1,'ENTRADA'),(116,'edwin ha cerrado sesión.','2024-08-07 12:50:03',1,'SALIDA'),(117,'edwin ha iniciado sesión.','2024-08-07 23:41:05',1,'ENTRADA'),(118,'edwin ha cerrado sesión.','2024-08-07 23:41:41',1,'SALIDA'),(119,'edwin ha iniciado sesión.','2024-08-07 23:42:31',1,'ENTRADA'),(120,'edwin ha cerrado sesión.','2024-08-07 23:42:33',1,'SALIDA'),(121,'edwin ha iniciado sesión.','2024-08-07 23:43:00',1,'ENTRADA'),(122,'edwin ha cerrado sesión.','2024-08-07 23:43:18',1,'SALIDA'),(123,'edwin ha iniciado sesión.','2024-08-08 12:50:05',1,'ENTRADA'),(124,'edwin ha cerrado sesión.','2024-08-08 12:50:19',1,'SALIDA'),(125,'edwin ha iniciado sesión.','2024-08-12 23:30:02',1,'ENTRADA'),(126,'edwin ha cerrado sesión.','2024-08-13 12:11:57',1,'SALIDA'),(127,'si ha iniciado sesión.','2024-08-13 12:12:00',2,'ENTRADA'),(128,'si ha cerrado sesión.','2024-08-13 12:12:13',2,'SALIDA'),(129,'edwin ha iniciado sesión.','2024-08-13 12:12:15',1,'ENTRADA'),(130,'edwin ha iniciado sesión.','2024-08-14 00:34:10',1,'ENTRADA'),(131,'edwin ha aprobado el pedido #1.','2024-08-14 00:40:57',1,'SALIDA'),(132,'edwin ha cerrado sesión.','2024-08-14 00:44:03',1,'SALIDA'),(133,'edwin ha iniciado sesión.','2024-08-14 09:02:15',1,'ENTRADA'),(134,'edwin ha cerrado sesión.','2024-08-14 09:02:19',1,'SALIDA'),(135,'edwin ha iniciado sesión.','2024-08-14 09:04:29',1,'ENTRADA'),(136,'edwin ha aprobado el pedido #8.','2024-08-14 09:04:57',1,'SALIDA'),(137,'edwin ha cerrado sesión.','2024-08-14 09:29:34',1,'SALIDA'),(138,'edwin ha iniciado sesión.','2024-08-15 12:22:21',1,'ENTRADA'),(139,'edwin ha aprobado el pedido #10.','2024-08-15 12:22:48',1,'SALIDA'),(140,'edwin ha cerrado sesión.','2024-08-15 12:24:15',1,'SALIDA'),(141,'edwin ha iniciado sesión.','2024-08-16 19:20:35',1,'ENTRADA'),(147,'edwin ha aprobado la solicitud #1.','2024-08-16 23:17:58',1,'SALIDA'),(148,'edwin ha denegado la solicitud #2.','2024-08-16 23:30:37',1,'SALIDA'),(149,'edwin ha cerrado sesión.','2024-08-20 23:50:48',1,'SALIDA'),(150,'edwin ha iniciado sesión.','2024-08-21 10:43:02',1,'ENTRADA'),(151,'edwin ha cargado 2 unidades del producto #2.','2024-08-22 14:20:54',1,'CARGA'),(155,'edwin ha hecho un ajuste en negativo (-1) del producto #1.','2024-08-23 13:41:55',1,'AJUSTE'),(156,'edwin ha hecho un ajuste en positivo (1) del producto #2.','2024-08-23 13:59:08',1,'AJUSTE'),(157,'edwin ha cargado 5 unidades del producto #1.','2024-08-23 15:25:13',1,'CARGA'),(158,'edwin ha cargado 5 unidades del producto #2.','2024-08-23 15:26:09',1,'CARGA'),(159,'edwin ha hecho un ajuste en negativo (-1) del producto #2.','2024-08-23 15:27:00',1,'AJUSTE'),(160,'edwin ha registrado una categoría.','2024-08-23 16:35:03',1,'ENTRADA'),(161,'edwin ha registrado un producto.','2024-08-23 16:37:04',1,'ENTRADA'),(162,'edwin ha cargado 6 unidades del producto #115005453.','2024-08-23 16:39:01',1,'CARGA'),(163,'edwin ha cerrado sesión.','2024-08-23 16:39:44',1,'SALIDA'),(164,'edwin ha iniciado sesión.','2024-08-23 16:39:47',1,'ENTRADA'),(165,'edwin ha cerrado sesión.','2024-08-23 18:36:53',1,'SALIDA'),(166,'edwin ha iniciado sesión.','2024-08-23 19:43:32',1,'ENTRADA'),(167,'edwin ha registrado un producto.','2024-08-23 21:27:33',1,'ENTRADA'),(168,'edwin ha registrado un producto.','2024-08-23 21:41:04',1,'ENTRADA'),(169,'edwin ha registrado un producto.','2024-08-23 22:11:31',1,'ENTRADA'),(170,'edwin ha editado un producto.','2024-08-23 23:24:45',1,'SALIDA'),(171,'edwin ha editado un producto.','2024-08-23 23:27:32',1,'SALIDA'),(172,'edwin ha editado un producto.','2024-08-23 23:28:08',1,'SALIDA'),(173,'edwin ha editado un producto.','2024-08-23 23:36:41',1,'SALIDA'),(174,'edwin ha editado un producto.','2024-08-24 16:53:18',1,'SALIDA'),(175,'edwin ha cerrado sesión.','2024-08-24 17:36:34',1,'SALIDA'),(176,'edwin ha iniciado sesión.','2024-08-24 19:47:52',1,'ENTRADA'),(177,'edwin ha cargado 10 unidades del producto #115005454.','2024-08-24 20:22:55',1,'CARGA'),(178,'edwin ha cargado 3 unidades del producto #115005455.','2024-08-24 20:23:16',1,'CARGA'),(179,'edwin ha cargado 5 unidades del producto #115005456.','2024-08-24 20:23:30',1,'CARGA'),(180,'edwin ha eliminado el descuento del producto #4.','2024-08-24 22:55:28',1,'SALIDA'),(181,'edwin ha eliminado el descuento del producto #1.','2024-08-27 12:18:22',1,'SALIDA'),(182,'edwin ha eliminado el descuento del producto #1.','2024-08-27 12:23:08',1,'SALIDA'),(183,'edwin ha eliminado el descuento del producto #2.','2024-08-27 12:23:41',1,'SALIDA'),(184,'edwin ha eliminado el descuento del producto #4.','2024-08-27 12:25:40',1,'SALIDA'),(185,'edwin ha cerrado sesión.','2024-09-03 12:20:34',1,'SALIDA'),(186,'edwin ha iniciado sesión.','2024-09-05 14:39:48',1,'ENTRADA'),(187,'edwin ha procesado una factura.','2024-09-06 10:33:39',1,'SALIDA'),(188,'edwin ha cerrado sesión.','2024-09-09 10:07:48',1,'SALIDA'),(189,'edwin ha iniciado sesión.','2024-09-10 00:04:23',1,'ENTRADA');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_producto`
--

LOCK TABLES `categoria_producto` WRITE;
/*!40000 ALTER TABLE `categoria_producto` DISABLE KEYS */;
INSERT INTO `categoria_producto` VALUES (1,'Perfumes','Fragancias, Splashes y colonias para dama y caballero'),(2,'Cremas','Cremas corporales, faciales, hidratantes, etc...'),(3,'Tintes','Tintes y colorantes para modificar la tonalidad del color del cabello'),(4,'Electrónicos','Productos electrónicos de variedad'),(5,'Cosméticos','Productos de cosmética comercial con fines estéticos y de salud'),(6,'Domicilio','Servicio a domicilio'),(7,'Cuidado del cabello','Artículos para cuidado e higiene del cabello');
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
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `foto` longtext NOT NULL,
  `nacimiento` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'30016237','Juan','Juan Alejandro','Jimenez','juancho@gmail.com','Maracay','01010101010101','1234','img_8a28a4f7aa238f8bc411c32d82be2591.jpg','2024-08-06'),(2,'12','Alfredo','Alfredo','si','si','sabaneta','363636','121212300','','2024-08-06'),(3,'78','Alfonzo','Alfonzo','si','si','aja','9292929292','78787878','','2024-08-06'),(4,'12000','cg','cliente','general','ejemplo@gmail.com','ninguna','000000000000','1234','img_927c62894c64b5a43c809e93c2df4537.jpg','1999-06-08'),(5,'123','ejemplo','Josejuanjo','si','si','guaira','121212','123','','2024-08-06'),(6,'12000345','alonso_amr','Alonso','Amir','alon_gon23@gmail.com','','04123469452','1234','','1997-06-04');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'J-00015646483','PyR Cosmetics C.A','02020202020','pyrcosmetics@gmail.com','Zona Comercial La Mora, calle 37, Venezuela, Edo. Aragua',16);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuentos`
--

LOCK TABLES `descuentos` WRITE;
/*!40000 ALTER TABLE `descuentos` DISABLE KEYS */;
INSERT INTO `descuentos` VALUES (21,7,15,46);
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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_carrito`
--

LOCK TABLES `detalle_carrito` WRITE;
/*!40000 ALTER TABLE `detalle_carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_carrito` ENABLE KEYS */;
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
  PRIMARY KEY (`correlativo`),
  KEY `nopedido` (`nopedido`),
  KEY `codproducto` (`codproducto`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`nopedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_pedido_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
INSERT INTO `detalle_pedido` VALUES (1,1,1,4,3,20.00),(2,1,2,4,2,32.00),(3,1,6,4,1,15.00),(15,6,1,4,1,20.00),(16,6,4,4,1,15.00),(17,6,6,4,1,15.00),(18,7,2,4,1,32.00),(19,7,6,4,1,15.00),(20,8,2,4,1,32.00),(21,8,4,4,2,15.00),(23,9,1,4,2,20.00),(24,9,6,4,2,15.00),(25,9,4,4,1,15.00),(26,10,1,4,1,20.00),(27,10,4,4,1,15.00),(28,10,115005451,4,1,3.00),(29,11,2,4,3,32.00),(30,11,6,4,1,15.00);
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
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallefactura`
--

LOCK TABLES `detallefactura` WRITE;
/*!40000 ALTER TABLE `detallefactura` DISABLE KEYS */;
INSERT INTO `detallefactura` VALUES (1,1,1,9,20),(2,1,2,50,32),(4,2,1,9,20),(5,2,2,50,32),(7,3,1,9,20),(8,3,2,50,32),(10,4,2,5,32),(11,4,4,1,15),(13,5,4,10,15),(14,5,6,3,15),(15,5,8,1,8),(16,6,8,1,8),(17,7,4,10,15),(18,7,2,10,32),(20,8,2,3,32),(21,8,8,2,8),(22,8,6,1,15),(23,9,2,1,32),(24,10,7,1,55),(25,11,8,1,8),(26,12,8,1,8),(37,23,4,1,15),(38,24,2,1,32),(39,25,6,1,15),(40,26,2,1,32),(41,27,2,1,32),(42,28,2,1,32),(43,29,2,1,32),(44,30,2,1,32),(45,31,2,1,32),(46,32,2,1,32),(47,32,6,5,15),(49,33,4,1,15),(50,34,6,1,15),(51,35,2,1,32),(52,36,4,1,15),(53,37,4,1,15),(54,38,4,1,15),(55,39,4,1,15),(56,40,6,1,15),(57,41,4,1,15),(58,42,4,1,15),(59,43,4,1,15),(60,44,4,1,15),(61,45,4,1,15),(62,46,4,1,15),(63,47,4,1,15),(64,48,4,1,15),(65,49,4,1,15),(66,50,4,1,15),(67,51,4,1,15),(68,52,4,1,15),(69,53,4,1,15),(70,54,4,1,15),(71,55,4,1,15),(72,56,2,1,32),(73,57,2,2,32),(74,57,4,1,15),(76,58,6,1,15),(77,58,4,1,15),(79,59,7,1,55),(80,59,6,1,15),(82,60,8,2,8),(83,60,2,1,32),(85,61,2,1,32),(86,61,8,3,8),(88,62,8,1,8),(89,63,8,2,8),(90,63,4,1,15),(92,64,2,1,32),(93,64,8,1,8),(95,65,8,1,8),(96,65,4,1,15),(98,66,2,1,32),(99,67,4,1,15),(100,67,8,1,8),(102,68,4,1,15),(103,68,8,2,8),(105,69,4,1,15),(106,69,8,2,8),(108,70,4,1,15),(109,71,4,1,15),(110,72,4,1,15),(111,73,2,1,32),(112,74,4,1,15),(113,75,4,1,15),(114,76,4,1,15),(115,77,4,1,15),(116,78,7,1,55),(117,79,4,1,15),(118,80,2,1,32),(119,80,4,1,15),(120,80,6,1,15),(121,80,8,2,8),(125,81,4,1,15),(126,81,8,3,8),(128,82,4,1,15),(129,83,6,1,15),(130,84,6,1,15),(131,85,4,1,15),(132,86,6,1,15),(133,87,2,1,32),(134,88,4,1,15),(135,89,4,1,15),(136,90,4,1,15),(137,91,4,1,15),(138,92,4,1,15),(139,93,4,1,15),(140,94,2,2,32),(141,94,4,1,15),(142,94,6,1,15),(143,95,4,1,15),(144,95,6,1,15),(145,95,2,2,32),(146,96,7,1,55),(147,96,4,1,15),(149,97,4,1,15),(150,98,4,1,15),(151,99,4,1,15),(152,100,4,1,15),(153,100,7,1,55),(154,100,2,3,32),(155,101,2,1,32),(156,102,4,1,15),(157,103,4,1,15),(158,104,4,1,15),(159,105,4,1,15),(160,106,4,1,15),(161,107,4,1,15),(162,108,4,1,15),(163,109,6,1,15),(164,110,6,1,15),(165,111,4,1,15),(166,112,7,1,55),(167,113,8,1,8),(168,114,6,1,15),(169,115,4,1,15),(170,116,4,1,15),(171,117,4,1,15),(172,118,4,1,15),(173,119,6,1,15),(174,120,8,1,8),(175,121,8,1,8),(176,122,2,1,32),(177,123,4,1,15),(178,124,4,1,15),(179,125,2,1,32),(180,126,4,1,15),(181,127,4,1,15),(182,128,4,1,15),(183,129,2,1,32),(184,130,4,1,15),(185,131,4,1,15),(186,132,4,1,15),(187,133,4,1,15),(188,134,4,1,15),(189,135,6,1,15),(190,135,8,1,8),(191,135,4,2,15),(192,136,2,1,32),(193,137,4,1,15),(194,138,1,1,20),(195,138,2,1,32),(197,139,1,3,20),(198,139,2,2,32),(199,139,6,1,15),(200,140,2,1,32),(201,140,4,2,15),(202,141,1,1,20),(203,141,4,1,15),(204,141,115005451,1,3),(205,142,115005456,16,14);
/*!40000 ALTER TABLE `detallefactura` ENABLE KEYS */;
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
  `pregunta` enum('Nombre de su primera mascota','Pelicula favorita','Pasatiempo favorito') NOT NULL,
  `respuesta` varchar(35) NOT NULL,
  `intentos` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_empleado`),
  KEY `rol` (`rol`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'admin','edwin','fragiel',1,'ewin@gmail.com','admin','Nombre de su primera mascota','chiki',1),(2,'wawa','si','no',2,'awa@gmail.com','wawa','Pasatiempo favorito','bateria',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (1,'2024-07-08 22:50:33',1,1,200,1),(2,'2024-07-08 22:51:10',1,1,130,1),(3,'2024-07-08 22:54:40',1,1,1780,1),(4,'2024-07-08 23:44:15',1,1,175,1),(5,'2024-07-08 23:48:36',1,3,203,1),(6,'2024-07-08 23:49:32',1,3,8,1),(7,'2024-07-09 21:51:56',1,1,470,1),(8,'2024-07-09 21:54:52',1,3,127,1),(9,'2024-07-09 21:56:18',1,1,32,1),(10,'2024-07-09 22:04:11',1,1,55,1),(11,'2024-07-09 22:06:30',1,3,8,2),(12,'2024-07-09 22:08:15',1,3,8,1),(23,'2024-07-09 22:46:33',1,5,15,1),(24,'2024-07-09 22:53:23',1,5,32,1),(25,'2024-07-09 22:54:33',1,5,15,1),(26,'2024-07-09 22:57:29',1,5,32,1),(27,'2024-07-09 22:59:26',1,5,32,1),(28,'2024-07-09 23:00:41',1,5,32,1),(29,'2024-07-09 23:01:56',1,5,32,1),(30,'2024-07-09 23:03:04',1,5,32,1),(31,'2024-07-09 23:03:55',1,5,32,1),(32,'2024-07-09 23:07:30',1,5,107,1),(33,'2024-07-09 23:11:10',1,5,15,1),(34,'2024-07-09 23:12:15',1,5,15,2),(35,'2024-07-09 23:13:03',1,5,32,1),(36,'2024-07-09 23:13:45',1,5,15,1),(37,'2024-07-09 23:16:16',1,5,15,1),(38,'2024-07-09 23:18:18',1,5,15,1),(39,'2024-07-09 23:19:21',1,5,15,1),(40,'2024-07-09 23:21:57',1,5,15,1),(41,'2024-07-09 23:22:21',1,5,15,1),(42,'2024-07-09 23:23:34',1,5,15,1),(43,'2024-07-09 23:25:44',1,5,15,1),(44,'2024-07-09 23:26:22',1,5,15,1),(45,'2024-07-09 23:27:54',1,5,15,1),(46,'2024-07-09 23:31:18',1,5,15,1),(47,'2024-07-09 23:31:37',1,5,15,1),(48,'2024-07-09 23:32:24',1,5,15,1),(49,'2024-07-09 23:33:46',1,5,15,1),(50,'2024-07-09 23:34:18',1,5,15,1),(51,'2024-07-09 23:35:06',1,5,15,1),(52,'2024-07-09 23:36:21',1,5,15,1),(53,'2024-07-09 23:43:49',1,5,15,2),(54,'2024-07-09 23:44:15',1,5,15,1),(55,'2024-07-09 23:45:11',1,5,15,2),(56,'2024-07-11 10:49:48',1,3,32,2),(57,'2024-07-11 11:35:47',1,1,79,1),(58,'2024-07-11 11:36:50',1,1,30,1),(59,'2024-07-11 11:38:15',1,1,70,1),(60,'2024-07-11 11:39:19',1,1,48,1),(61,'2024-07-11 11:40:31',1,1,56,1),(62,'2024-07-11 11:41:19',1,5,8,1),(63,'2024-07-11 11:41:59',1,5,31,1),(64,'2024-07-11 11:43:26',1,5,40,1),(65,'2024-07-11 11:44:47',1,1,23,2),(66,'2024-07-11 11:45:42',1,5,32,1),(67,'2024-07-11 11:46:22',1,5,23,1),(68,'2024-07-11 11:47:17',1,5,31,1),(69,'2024-07-11 11:48:48',1,5,31,1),(70,'2024-07-11 12:05:06',1,5,15,1),(71,'2024-07-11 12:22:37',1,5,15,1),(72,'2024-07-11 12:26:17',1,5,15,1),(73,'2024-07-11 12:27:35',1,5,32,1),(74,'2024-07-11 12:30:08',1,5,15,1),(75,'2024-07-11 12:32:40',1,5,15,1),(76,'2024-07-11 12:33:28',1,5,15,1),(77,'2024-07-11 12:33:54',1,5,15,1),(78,'2024-07-11 12:35:01',1,5,55,2),(79,'2024-07-11 23:47:26',1,5,15,2),(80,'2024-07-11 23:53:16',1,1,78,1),(81,'2024-07-11 23:57:07',1,1,39,2),(82,'2024-07-12 00:10:15',1,3,15,1),(83,'2024-07-12 00:14:00',1,5,15,1),(84,'2024-07-12 00:15:09',1,5,15,1),(85,'2024-07-12 00:21:05',1,1,15,1),(86,'2024-07-12 00:22:53',1,5,15,1),(87,'2024-07-12 00:31:30',1,5,32,1),(88,'2024-07-12 00:33:28',1,5,15,1),(89,'2024-07-12 00:35:34',1,5,15,10),(90,'2024-07-12 00:37:18',1,5,15,1),(91,'2024-07-12 00:38:13',1,5,15,1),(92,'2024-07-12 00:40:38',1,5,15,10),(93,'2024-07-12 10:57:09',1,5,15,1),(94,'2024-07-16 11:19:32',1,1,94,2),(95,'2024-07-16 12:11:45',1,1,94,1),(96,'2024-07-16 12:13:15',1,5,70,1),(97,'2024-07-16 12:22:37',1,5,15,1),(98,'2024-07-16 12:27:10',1,5,15,1),(99,'2024-07-16 12:29:02',1,5,15,1),(100,'2024-07-16 12:30:28',1,1,166,1),(101,'2024-07-18 11:15:49',1,5,32,1),(102,'2024-07-18 11:16:21',1,5,15,1),(103,'2024-07-18 11:16:59',1,5,15,1),(104,'2024-07-18 11:19:51',1,5,15,1),(105,'2024-07-18 11:20:20',1,5,15,1),(106,'2024-07-18 11:20:58',1,5,15,2),(107,'2024-07-18 11:21:40',1,5,15,1),(108,'2024-07-18 11:29:52',1,5,15,2),(109,'2024-07-18 11:31:39',1,5,15,2),(110,'2024-07-18 11:34:32',1,3,15,2),(111,'2024-07-18 11:35:15',1,1,15,1),(112,'2024-07-18 11:36:25',1,5,55,1),(113,'2024-07-18 11:38:07',1,5,8,1),(114,'2024-07-18 12:33:30',1,5,15,1),(115,'2024-07-18 12:38:27',1,5,15,1),(116,'2024-07-18 12:47:26',1,5,15,1),(117,'2024-07-20 11:04:30',1,5,15,1),(118,'2024-07-20 11:08:23',1,5,15,1),(119,'2024-07-20 11:10:58',1,5,15,2),(120,'2024-07-20 11:13:24',1,3,8,1),(121,'2024-07-20 11:56:44',1,1,8,1),(122,'2024-07-21 14:58:07',1,1,32,2),(123,'2024-07-21 14:59:39',1,1,15,2),(124,'2024-07-21 15:01:43',1,3,15,2),(125,'2024-07-21 15:08:10',1,5,32,1),(126,'2024-07-21 15:42:01',1,5,15,1),(127,'2024-07-21 15:42:53',1,3,15,1),(128,'2024-07-21 16:30:11',1,5,15,1),(129,'2024-07-21 16:31:52',1,3,32,1),(130,'2024-07-21 16:32:53',1,2,15,1),(131,'2024-07-21 16:33:23',1,2,15,1),(132,'2024-07-21 16:35:03',1,2,15,1),(133,'2024-07-21 16:52:58',1,2,15,2),(134,'2024-07-21 16:53:55',1,3,15,1),(135,'2024-07-21 16:56:43',1,1,53,2),(136,'2024-07-21 17:00:23',1,2,32,2),(137,'2024-07-22 00:32:42',1,5,15,2),(138,'2024-08-14 00:29:50',1,4,52,1),(139,'2024-08-14 00:40:56',1,4,139,1),(140,'2024-08-14 09:04:57',1,4,62,1),(141,'2024-08-15 12:22:48',1,4,38,1),(142,'2024-09-06 10:33:38',1,4,224,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (1,'Se ha aprobado tu solicitud para cambio de cédula',4,'2024-08-31',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,'2024-08-10','3',139,4,1,'gas agosto 2024.png',0),(2,'2024-08-11','3',52,4,1,'WhatsApp Image 2024-08-11 at 11.34.03 AM.jpeg',0),(6,'2024-08-12','2',50,4,1,'',0),(7,'2024-08-12','2',47,4,1,'',0),(8,'2024-08-14','3',62,4,1,'gas agosto 2024.png',0),(9,'2024-08-14','4',85,4,1,'gas agosto 2024.png',0),(10,'2024-08-15','3',38,4,1,'WhatsApp Image 2024-07-02 at 8.46.46 AM.jpeg',0),(11,'2024-08-15','1',111,4,1,'',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=115005457 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Colonia NightKing Special 120ml','Colonia para noche de caballero de 120ml',20.00,21,2,10,1,'NightKing',1,'knightking.jpg'),(2,'Crema Nivea Hidratación','Crema de hidratación profunda 150ml',18.00,25,1,5,2,'Nivea',1,'nivea.jpg'),(4,'Colonia Swiss Army','Colonia de caballero Noche 100ml',12.00,24,1,6,1,'Swiss Army Inc',1,'swiss.jpg'),(6,'Tinte Revlon 1.0 Negro','Tinte para cabello color negro puro',22.00,35,1,5,3,'Revlon',1,'revlon.png'),(7,'Placha para cabello Revlon','Plancha profesional para cabello marca Revlon',39.10,6,7,10,4,'Revlon',1,'plancha.png'),(8,'Esmalte Valmy #51 Tiza','Esmalte para uñas marca Valmy color #51 blanco tiz',7.00,16,1,15,5,'Valmy',1,''),(115005451,'Domicilio','Servicio de entrega a domicilio',2.00,9999999,1,1,6,'',1,''),(115005453,'Champú Pantene Restauración 400ml','Champú de restauración capilar para cabello graso, prevención de caída y fortalecimiento de raíz capilar',23.00,6,1,10,7,'Pantene',1,'pantene.jpg'),(115005454,'Crema facial Zoah 75ml','Crema hidratante facial para evitar arrugas y desgaste por la edad',19.00,3,4,12,2,'Zoah',1,'zoah.png'),(115005455,'Colonia King of France 100ml','Colonia para caballero aroma dulce, para noche',27.00,3,5,10,1,'KyO C.A',1,'elegante.jpg'),(115005456,'Solución Intima Dernier Skinsept','Solución íntima para hidratación e higiene interna',14.00,8,5,36,5,'Dernier',1,'dernier.jpg');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_cedula`
--

LOCK TABLES `solicitud_cedula` WRITE;
/*!40000 ALTER TABLE `solicitud_cedula` DISABLE KEYS */;
INSERT INTO `solicitud_cedula` VALUES (1,4,12000,1),(2,4,1200,2);
/*!40000 ALTER TABLE `solicitud_cedula` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-10  0:05:55
