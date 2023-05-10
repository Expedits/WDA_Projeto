CREATE DATABASE  IF NOT EXISTS `wda-projeto` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `wda-projeto`;
-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: wda-projeto
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adm`
--

DROP TABLE IF EXISTS `adm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `senha` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm`
--

LOCK TABLES `adm` WRITE;
/*!40000 ALTER TABLE `adm` DISABLE KEYS */;
INSERT INTO `adm` VALUES (1,'Expedito',123);
/*!40000 ALTER TABLE `adm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aluguel`
--

DROP TABLE IF EXISTS `aluguel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aluguel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `livro` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `data_aluguel` date NOT NULL,
  `prev_devo` date NOT NULL,
  `data_devo` varchar(45) COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aluguel`
--

LOCK TABLES `aluguel` WRITE;
/*!40000 ALTER TABLE `aluguel` DISABLE KEYS */;
INSERT INTO `aluguel` VALUES (1,'Expedito','Teste','2012-02-22','2012-02-22','12-02-22'),(4,'Isabel','Teste','2023-05-07','2023-05-08','2023-05-09'),(5,'Isabel','Teste','2023-05-07','2023-05-08','2023-05-09'),(29,'Isabel','Harry Potter','2023-05-09','2023-05-10','09/05/2023'),(30,'sei lam','Babie','2023-05-09','2023-05-11','09/05/2023'),(31,'antonio','BATMAN','2023-05-09','2023-05-11','0'),(32,'antonio','Harry Potter','2023-05-09','2023-05-11','0'),(33,'antonio','Antonio','2023-05-02','2023-05-10','0');
/*!40000 ALTER TABLE `aluguel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editora`
--

DROP TABLE IF EXISTS `editora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `editora` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `telefone` int NOT NULL,
  `email` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editora`
--

LOCK TABLES `editora` WRITE;
/*!40000 ALTER TABLE `editora` DISABLE KEYS */;
INSERT INTO `editora` VALUES (5,'antonio1',40028922,'antoniodollmichael@gmail.com');
/*!40000 ALTER TABLE `editora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro`
--

DROP TABLE IF EXISTS `livro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `editora` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `data_livro` date NOT NULL,
  `autor` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `estoque` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro`
--

LOCK TABLES `livro` WRITE;
/*!40000 ALTER TABLE `livro` DISABLE KEYS */;
INSERT INTO `livro` VALUES (2,'Teste1','Bom','2023-05-17','Teste','5'),(5,'Harry Potter','Bom leitor ','2023-05-13','batman','2'),(6,'Babie','Bom leitor ','2023-05-13','robin','20'),(7,'BATMAN','Bom leitor','2023-05-07','MATHEUS','19'),(10,'Antonio','antonio','2023-05-04','batman','19');
/*!40000 ALTER TABLE `livro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `endereco` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `cidade` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `email` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci NOT NULL,
  `celular` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vi_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (4,'Isabelle','Coelho','Neto','bel@gmail.com',859882),(5,'antonio','rock n roll','sei la','antoniodollmichael@gmail.com',40028922),(7,'sei lam','batman','não sei ','batman ',40028922);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'wda-projeto'
--

--
-- Dumping routines for database 'wda-projeto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-09 19:49:50
