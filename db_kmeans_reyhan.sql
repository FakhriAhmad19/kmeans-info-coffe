-- MySQL dump 10.13  Distrib 9.6.0, for macos26.4 (arm64)
--
-- Host: localhost    Database: db_kmeans_reyhan
-- ------------------------------------------------------
-- Server version	9.6.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hasil_segmentasis`
--

DROP TABLE IF EXISTS `hasil_segmentasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hasil_segmentasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint unsigned NOT NULL,
  `cluster` int NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hasil_segmentasis_transaksi_id_foreign` (`transaksi_id`),
  CONSTRAINT `hasil_segmentasis_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hasil_segmentasis`
--

LOCK TABLES `hasil_segmentasis` WRITE;
/*!40000 ALTER TABLE `hasil_segmentasis` DISABLE KEYS */;
INSERT INTO `hasil_segmentasis` VALUES (1,1,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(2,2,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(3,3,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(4,4,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(5,5,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(6,6,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(7,7,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(8,8,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(9,9,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(10,10,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(11,11,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(12,12,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(13,13,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(14,14,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(15,15,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(16,16,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(17,17,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(18,18,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(19,19,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(20,20,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(21,21,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(22,22,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(23,23,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(24,24,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(25,25,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(26,26,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(27,27,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(28,28,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(29,29,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(30,30,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(31,31,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(32,32,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(33,33,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(34,34,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(35,35,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(36,36,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(37,37,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(38,38,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(39,39,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(40,40,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(41,41,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(42,42,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(43,43,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(44,44,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(45,45,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(46,46,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(47,47,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(48,48,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(49,49,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(50,50,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(51,51,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(52,52,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(53,53,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(54,54,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(55,55,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(56,56,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(57,57,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(58,58,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(59,59,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(60,60,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(61,61,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(62,62,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(63,63,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(64,64,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(65,65,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(66,66,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(67,67,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(68,68,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(69,69,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(70,70,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(71,71,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(72,72,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(73,73,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(74,74,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(75,75,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(76,76,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(77,77,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(78,78,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(79,79,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(80,80,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(81,81,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(82,82,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(83,83,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(84,84,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(85,85,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(86,86,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(87,87,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(88,88,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(89,89,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(90,90,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(91,91,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(92,92,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(93,93,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(94,94,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(95,95,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(96,96,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(97,97,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(98,98,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(99,99,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(100,100,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(101,101,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(102,102,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(103,103,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(104,104,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(105,105,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(106,106,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(107,107,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(108,108,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(109,109,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(110,110,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(111,111,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(112,112,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(113,113,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(114,114,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(115,115,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(116,116,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(117,117,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(118,118,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(119,119,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(120,120,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(121,121,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(122,122,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(123,123,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(124,124,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(125,125,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(126,126,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(127,127,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(128,128,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(129,129,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(130,130,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(131,131,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(132,132,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(133,133,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(134,134,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(135,135,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(136,136,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(137,137,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(138,138,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(139,139,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(140,140,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(141,141,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(142,142,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(143,143,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(144,144,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(145,145,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(146,146,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(147,147,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(148,148,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(149,149,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(150,150,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(151,151,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(152,152,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(153,153,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(154,154,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(155,155,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(156,156,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(157,157,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(158,158,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(159,159,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(160,160,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(161,161,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(162,162,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(163,163,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(164,164,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(165,165,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(166,166,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(167,167,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(168,168,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(169,169,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(170,170,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(171,171,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(172,172,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(173,173,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(174,174,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(175,175,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(176,176,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(177,177,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(178,178,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(179,179,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(180,180,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(181,181,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(182,182,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(183,183,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(184,184,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(185,185,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(186,186,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(187,187,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(188,188,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(189,189,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(190,190,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(191,191,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(192,192,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(193,193,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(194,194,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(195,195,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(196,196,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(197,197,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(198,198,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(199,199,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(200,200,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(201,201,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(202,202,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(203,203,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(204,204,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(205,205,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(206,206,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(207,207,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(208,208,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(209,209,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(210,210,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(211,211,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(212,212,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(213,213,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(214,214,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(215,215,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(216,216,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(217,217,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(218,218,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(219,219,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(220,220,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(221,221,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(222,222,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(223,223,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(224,224,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(225,225,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(226,226,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(227,227,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(228,228,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(229,229,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(230,230,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(231,231,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(232,232,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(233,233,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(234,234,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(235,235,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(236,236,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(237,237,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(238,238,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(239,239,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(240,240,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(241,241,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(242,242,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(243,243,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(244,244,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(245,245,0,'Pola Pembelian Rendah','2026-06-29 01:30:53','2026-06-29 01:30:53'),(246,246,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(247,247,2,'Pola Pembelian Tinggi','2026-06-29 01:30:53','2026-06-29 01:30:53'),(248,248,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(249,249,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53'),(250,250,1,'Pola Pembelian Sedang','2026-06-29 01:30:53','2026-06-29 01:30:53');
/*!40000 ALTER TABLE `hasil_segmentasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_28_161023_create_produks_table',1),(5,'2026_06_28_161023_create_transaksis_table',1),(6,'2026_06_28_161024_create_hasil_segmentasis_table',1),(7,'2026_06_28_161025_create_transaksi_items_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produks`
--

DROP TABLE IF EXISTS `produks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `produks_kode_produk_unique` (`kode_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produks`
--

LOCK TABLES `produks` WRITE;
/*!40000 ALTER TABLE `produks` DISABLE KEYS */;
INSERT INTO `produks` VALUES (1,'PRD001','Tahu Walik','Makanan',10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(2,'PRD002','Jeniper Dingin','Minuman',10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(3,'PRD003','Sanger Dingin','Minuman',30000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(4,'PRD004','Es Kopi Susu Gula Aren','Minuman',15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(5,'PRD005','Coffe Bir','Minuman',15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(6,'PRD006','Taro Dingin','Minuman',15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(7,'PRD007','Matcha Dingin','Minuman',15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(8,'PRD008','Americano Dingin','Minuman',15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(9,'PRD009','Straca','Minuman',36000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(10,'PRD010','Coffe Latte Dingin','Minuman',15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(11,'PRD011','Es Teh','Minuman',8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(12,'PRD012','Es Kopi Hazelnut','Minuman',18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(13,'PRD013','Japaness','Minuman',20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(14,'PRD014','The Susu Dingin','Minuman',36000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(15,'PRD015','Sanger','Minuman',13000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(16,'PRD016','Lychee Tea','Minuman',15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(17,'PRD017','Coffe Caramel Dingin','Minuman',18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(18,'PRD018','Coffer bir','Minuman',30000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(19,'PRD019','Mix Plate','Makanan',15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(20,'PRD020','Lemon Tea','Minuman',8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(21,'PRD021','Vietnam Drip','Minuman',12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(22,'PRD022','The Susu','Minuman',10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(23,'PRD023','Espresso','Minuman',12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(24,'PRD024','Teh Susu','Minuman',10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(25,'PRD025','Es Kopi Sus Gula Aren','Minuman',15000,'2026-06-29 01:11:45','2026-06-29 01:11:45');
/*!40000 ALTER TABLE `produks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1c3lUu1hO5M5N1VswJrTKX4zVNbqGQFMUxXhHYwN',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Safari/605.1.15','eyJfdG9rZW4iOiJ0bHRjVkt2R2J6b1RmeTIzOThaOThraHJvRGlFWXd0WG1LcEgzc1BPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1782722331),('fVr9YoREHH9hOj9cug4zv20B0uNLqIVQptlb1gXX',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Safari/605.1.15','eyJfdG9rZW4iOiJtNEpLQVdvNDFxMVdDTHR3OENHMzlDZXRVQlV6V2tvR2IyejV1VEk5IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJkYmlfc2NvcmUiOjAuODM2MDEwOTcyODQxODYwNCwiaXRlcmF0aW9ucyI6OH0=',1782722159);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi_items`
--

DROP TABLE IF EXISTS `transaksi_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint unsigned NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_items_transaksi_id_foreign` (`transaksi_id`),
  KEY `transaksi_items_produk_id_foreign` (`produk_id`),
  CONSTRAINT `transaksi_items_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_items_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi_items`
--

LOCK TABLES `transaksi_items` WRITE;
/*!40000 ALTER TABLE `transaksi_items` DISABLE KEYS */;
INSERT INTO `transaksi_items` VALUES (1,1,1,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(2,2,2,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(3,3,3,2,30000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(4,4,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(5,5,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(6,6,2,2,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(7,7,6,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(8,8,6,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(9,9,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(10,10,8,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(11,11,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(12,12,9,2,36000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(13,13,10,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(14,14,1,2,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(15,15,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(16,16,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(17,17,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(18,18,12,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(19,19,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(20,20,12,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(21,21,13,1,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(22,22,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(23,23,3,2,30000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(24,24,14,3,36000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(25,25,5,2,30000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(26,26,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(27,27,5,2,30000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(28,28,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(29,29,5,4,60000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(30,30,13,1,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(31,31,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(32,32,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(33,33,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(34,34,13,1,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(35,35,5,2,30000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(36,36,14,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(37,37,15,2,13000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(38,38,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(39,39,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(40,40,16,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(41,41,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(42,42,17,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(43,43,1,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(44,44,2,2,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(45,45,18,2,30000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(46,46,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(47,47,19,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(48,48,20,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(49,49,21,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(50,50,3,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(51,51,22,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(52,52,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(53,53,23,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(54,54,5,2,30000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(55,55,24,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(56,56,2,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(57,57,1,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(58,58,8,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(59,59,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(60,60,12,2,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(61,61,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(62,62,8,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(63,63,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(64,64,1,2,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(65,65,13,1,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(66,66,2,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(67,67,2,3,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(68,68,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(69,69,17,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(70,70,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(71,71,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(72,72,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(73,73,20,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(74,74,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(75,75,18,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(76,76,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(77,77,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(78,78,6,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(79,79,13,1,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(80,80,16,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(81,81,16,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(82,82,2,3,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(83,83,5,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(84,84,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(85,85,9,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(86,86,15,1,6500,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(87,87,20,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(88,88,14,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(89,89,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(90,90,2,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(91,91,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(92,92,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(93,93,7,4,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(94,94,12,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(95,95,1,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(96,96,1,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(97,97,16,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(98,98,21,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(99,99,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(100,100,5,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(101,101,14,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(102,102,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(103,103,24,2,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(104,104,15,1,6500,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(105,105,23,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(106,106,20,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(107,107,5,3,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(108,108,24,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(109,109,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(110,110,12,3,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(111,111,1,2,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(112,112,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(113,113,8,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(114,114,1,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(115,115,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(116,116,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(117,117,2,4,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(118,118,5,4,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(119,119,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(120,120,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(121,121,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(122,122,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(123,123,21,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(124,124,2,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(125,125,2,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(126,126,19,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(127,127,2,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(128,128,23,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(129,129,18,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(130,130,19,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(131,131,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(132,132,23,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(133,133,7,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(134,134,14,2,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(135,135,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(136,136,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(137,137,3,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(138,138,20,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(139,139,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(140,140,25,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(141,141,1,3,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(142,142,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(143,143,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(144,144,23,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(145,145,5,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(146,146,13,1,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(147,147,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(148,148,24,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(149,149,2,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(150,150,11,2,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(151,151,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(152,152,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(153,153,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(154,154,9,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(155,155,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(156,156,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(157,157,6,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(158,158,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(159,159,5,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(160,160,11,2,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(161,161,1,2,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(162,162,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(163,163,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(164,164,24,3,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(165,165,5,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(166,166,3,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(167,167,16,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(168,168,5,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(169,169,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(170,170,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(171,171,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(172,172,5,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(173,173,21,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(174,174,4,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(175,175,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(176,176,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(177,177,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(178,178,9,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(179,179,17,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(180,180,13,1,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(181,181,1,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(182,182,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(183,183,24,2,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(184,184,9,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(185,185,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(186,186,8,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(187,187,22,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(188,188,12,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(189,189,13,3,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(190,190,8,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(191,191,15,1,6500,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(192,192,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(193,193,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(194,194,6,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(195,195,12,2,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(196,196,4,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(197,197,9,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(198,198,14,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(199,199,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(200,200,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(201,201,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(202,202,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(203,203,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(204,204,7,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(205,205,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(206,206,22,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(207,207,13,1,20000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(208,208,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(209,209,11,3,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(210,210,2,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(211,211,1,2,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(212,212,1,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(213,213,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(214,214,6,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(215,215,8,3,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(216,216,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(217,217,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(218,218,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(219,219,6,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(220,220,8,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(221,221,12,1,18000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(222,222,21,1,12000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(223,223,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(224,224,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(225,225,5,3,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(226,226,11,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(227,227,19,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(228,228,14,1,10000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(229,229,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(230,230,5,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(231,231,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(232,232,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(233,233,11,2,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(234,234,16,2,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(235,235,8,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(236,236,20,1,8000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(237,237,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(238,238,8,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(239,239,3,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(240,240,4,3,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(241,241,4,1,15000,'2026-06-29 01:11:45','2026-06-29 01:11:45'),(242,242,5,1,15000,'2026-06-29 01:11:46','2026-06-29 01:11:46'),(243,243,3,2,15000,'2026-06-29 01:11:46','2026-06-29 01:11:46'),(244,244,20,1,8000,'2026-06-29 01:11:46','2026-06-29 01:11:46'),(245,245,5,1,15000,'2026-06-29 01:11:46','2026-06-29 01:11:46'),(246,246,7,1,15000,'2026-06-29 01:11:46','2026-06-29 01:11:46'),(247,247,2,2,10000,'2026-06-29 01:11:46','2026-06-29 01:11:46'),(248,248,24,1,10000,'2026-06-29 01:11:46','2026-06-29 01:11:46'),(249,249,19,1,15000,'2026-06-29 01:11:46','2026-06-29 01:11:46'),(250,250,5,1,15000,'2026-06-29 01:11:46','2026-06-29 01:11:46');
/*!40000 ALTER TABLE `transaksi_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksis`
--

DROP TABLE IF EXISTS `transaksis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `total_belanja` int NOT NULL,
  `pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksis`
--

LOCK TABLES `transaksis` WRITE;
/*!40000 ALTER TABLE `transaksis` DISABLE KEYS */;
INSERT INTO `transaksis` VALUES (1,'T-163','2026-01-25',20000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(2,'T-163','2026-01-25',20000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(3,'T-180','2026-01-27',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(4,'T-180','2026-01-27',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(5,'T-180','2026-01-27',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(6,'T-176','2026-01-26',116000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(7,'T-176','2026-01-26',116000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(8,'T-176','2026-01-26',116000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(9,'T-176','2026-01-26',116000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(10,'T-176','2026-01-26',116000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(11,'T-176','2026-01-26',116000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(12,'T-176','2026-01-26',116000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(13,'T-129','2026-01-23',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(14,'T-132','2026-01-23',20000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(15,'T-177','2026-01-27',38000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(16,'T-177','2026-01-27',38000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(17,'T-177','2026-01-27',38000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(18,'T-189','2026-01-27',33000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(19,'T-189','2026-01-27',33000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(20,'T-158','2026-01-25',18000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(21,'T-144','2026-01-25',28000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(22,'T-144','2026-01-25',28000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(23,'T-139','2026-01-24',66000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(24,'T-139','2026-01-24',66000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(25,'T-151','2026-01-24',30000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(26,'T-148','2026-01-24',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(27,'T-151','2026-01-24',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(28,'T-155','2026-01-24',75000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(29,'T-155','2026-01-24',75000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(30,'T-144','2026-01-24',28000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(31,'T-144','2026-01-24',28000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(32,'T-154','2026-01-24',30000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(33,'T-154','2026-01-24',30000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(34,'T-144','2026-01-24',20000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(35,'T-150','2026-01-24',40000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(36,'T-150','2026-01-24',40000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(37,'T-142','2026-01-24',26000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(38,'T-60','2026-01-22',23000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(39,'T-60','2026-01-22',23000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(40,'T-61','2026-01-22',15000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(41,'T-81','2026-01-22',33000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(42,'T-81','2026-01-22',33000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(43,'T-82','2026-01-22',10000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(44,'T-76','2026-01-22',20000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(45,'T-73','2026-01-22',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(46,'T-73','2026-01-22',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(47,'T-73','2026-01-22',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(48,'T-74','2026-01-22',8000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(49,'T-71','2026-01-22',12000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(50,'T-72','2026-01-22',30000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(51,'T-67','2026-01-22',10000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(52,'T-85','2026-01-22',27000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(53,'T-85','2026-01-22',27000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(54,'T-150','2026-01-24',40000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(55,'T-150','2026-01-24',40000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(56,'T-159','2026-01-25',35000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(57,'T-159','2026-01-25',35000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(58,'T-159','2026-01-25',35000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(59,'T-130','2026-01-23',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(60,'T-190','2026-01-29',44000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(61,'T-190','2026-01-29',44000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(62,'T-191','2026-01-29',30000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(63,'T-191','2026-01-29',30000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(64,'T-192','2026-02-25',20000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(65,'T-193','2026-02-18',30000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(66,'T-193','2026-02-18',30000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(67,'T-194','2026-02-13',30000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(68,'T-195','2026-02-15',15000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(69,'T-196','2026-02-11',18000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(70,'T-197','2026-02-20',16000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(71,'T-197','2026-02-20',16000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(72,'T-198','2026-03-03',23000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(73,'T-198','2026-03-03',23000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(74,'T-199','2026-01-31',15000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(75,'T-200','2026-02-17',15000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(76,'T-201','2026-02-05',15000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(77,'T-202','2026-02-22',65000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(78,'T-202','2026-02-22',65000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(79,'T-202','2026-02-22',65000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(80,'T-202','2026-02-22',65000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(81,'T-203','2026-02-26',15000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(82,'T-204','2026-03-03',75000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(83,'T-204','2026-03-03',75000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(84,'T-204','2026-03-03',75000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(85,'T-205','2026-02-08',24500,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(86,'T-205','2026-02-08',24500,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(87,'T-206','2026-02-07',8000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(88,'T-207','2026-02-04',25000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(89,'T-207','2026-02-04',25000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(90,'T-208','2026-02-28',10000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(91,'T-209','2026-02-07',108000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(92,'T-209','2026-02-07',108000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(93,'T-209','2026-02-07',108000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(94,'T-209','2026-02-07',108000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(95,'T-210','2026-03-02',20000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(96,'T-210','2026-03-02',20000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(97,'T-211','2026-01-31',15000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(98,'T-212','2026-02-28',12000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(99,'T-213','2026-02-27',38000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(100,'T-213','2026-02-27',38000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(101,'T-214','2026-02-03',10000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(102,'T-215','2026-03-03',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(103,'T-216','2026-02-25',46500,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(104,'T-216','2026-02-25',46500,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(105,'T-216','2026-02-25',46500,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(106,'T-216','2026-02-25',46500,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(107,'T-217','2026-01-31',45000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(108,'T-218','2026-02-15',79000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(109,'T-218','2026-02-15',79000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(110,'T-218','2026-02-15',79000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(111,'T-219','2026-03-03',35000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(112,'T-219','2026-03-03',35000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(113,'T-220','2026-03-01',15000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(114,'T-221','2026-02-04',10000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(115,'T-222','2026-03-02',23000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(116,'T-222','2026-03-02',23000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(117,'T-223','2026-02-26',100000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(118,'T-223','2026-02-26',100000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(119,'T-224','2026-02-10',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(120,'T-225','2026-02-15',8000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(121,'T-226','2026-03-02',55000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(122,'T-226','2026-03-02',55000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(123,'T-226','2026-03-02',55000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(124,'T-226','2026-03-02',55000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(125,'T-226','2026-03-02',55000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(126,'T-227','2026-02-13',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(127,'T-228','2026-02-14',22000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(128,'T-228','2026-02-14',22000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(129,'T-229','2026-03-04',60000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(130,'T-229','2026-03-04',60000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(131,'T-229','2026-03-04',60000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(132,'T-230','2026-02-16',12000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(133,'T-231','2026-02-12',30000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(134,'T-232','2026-02-06',88000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(135,'T-232','2026-02-06',88000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(136,'T-232','2026-02-06',88000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(137,'T-232','2026-02-06',88000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(138,'T-232','2026-02-06',88000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(139,'T-233','2026-02-03',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(140,'T-234','2026-02-19',90000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(141,'T-234','2026-02-19',90000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(142,'T-234','2026-02-19',90000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(143,'T-234','2026-02-19',90000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(144,'T-235','2026-03-03',12000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(145,'T-236','2026-02-13',85000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(146,'T-236','2026-02-13',85000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(147,'T-236','2026-02-13',85000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(148,'T-236','2026-02-13',85000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(149,'T-236','2026-02-13',85000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(150,'T-237','2026-02-09',46000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(151,'T-237','2026-02-09',46000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(152,'T-237','2026-02-09',46000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(153,'T-238','2026-02-23',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(154,'T-239','2026-02-21',33000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(155,'T-239','2026-02-21',33000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(156,'T-240','2026-02-24',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(157,'T-241','2026-02-27',15000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(158,'T-242','2026-02-12',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(159,'T-243','2026-02-27',30000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(160,'T-244','2026-02-21',36000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(161,'T-244','2026-02-21',36000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(162,'T-245','2026-02-24',8000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(163,'T-246','2026-02-04',38000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(164,'T-246','2026-02-04',38000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(165,'T-247','2026-03-01',105000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(166,'T-247','2026-03-01',105000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(167,'T-247','2026-03-01',105000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(168,'T-247','2026-03-01',105000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(169,'T-248','2026-02-12',30000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(170,'T-248','2026-02-12',30000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(171,'T-249','2026-02-11',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(172,'T-250','2026-02-26',30000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(173,'T-251','2026-01-29',42000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(174,'T-251','2026-01-29',42000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(175,'T-252','2026-03-03',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(176,'T-252','2026-03-03',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(177,'T-252','2026-03-03',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(178,'T-253','2026-02-07',18000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(179,'T-254','2026-01-29',18000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(180,'T-255','2026-02-17',20000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(181,'T-256','2026-02-23',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(182,'T-256','2026-02-23',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(183,'T-256','2026-02-23',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(184,'T-257','2026-01-29',33000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(185,'T-257','2026-01-29',33000,'Qris','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(186,'T-258','2026-02-26',103000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(187,'T-258','2026-02-26',103000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(188,'T-258','2026-02-26',103000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(189,'T-258','2026-02-26',103000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(190,'T-259','2026-02-21',21500,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(191,'T-259','2026-02-21',21500,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(192,'T-260','2026-02-04',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(193,'T-261','2026-02-18',15000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(194,'T-262','2026-02-26',15000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(195,'T-263','2026-03-03',66000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(196,'T-263','2026-03-03',66000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(197,'T-264','2026-02-25',18000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(198,'T-265','2026-02-17',10000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(199,'T-266','2026-02-14',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(200,'T-266','2026-02-14',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(201,'T-266','2026-02-14',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(202,'T-266','2026-02-14',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(203,'T-267','2026-02-15',15000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(204,'T-268','2026-03-02',30000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(205,'T-268','2026-03-02',30000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(206,'T-269','2026-02-09',10000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(207,'T-270','2026-02-27',20000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(208,'T-271','2026-02-09',79000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(209,'T-271','2026-02-09',79000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(210,'T-271','2026-02-09',79000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(211,'T-271','2026-02-09',79000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(212,'T-271','2026-02-09',79000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(213,'T-272','2026-02-15',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(214,'T-273','2026-02-27',98000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(215,'T-273','2026-02-27',98000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(216,'T-273','2026-02-27',98000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(217,'T-273','2026-02-27',98000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(218,'T-274','2026-02-23',30000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(219,'T-274','2026-02-23',30000,'Qris','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(220,'T-275','2026-02-24',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(221,'T-275','2026-02-24',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(222,'T-275','2026-02-24',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(223,'T-276','2026-02-08',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(224,'T-277','2026-01-30',53000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(225,'T-277','2026-01-30',53000,'Cash','Siang','2026-06-29 01:11:45','2026-06-29 01:11:45'),(226,'T-278','2026-02-09',33000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(227,'T-278','2026-02-09',33000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(228,'T-278','2026-02-09',33000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(229,'T-279','2026-02-15',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(230,'T-279','2026-02-15',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(231,'T-279','2026-02-15',45000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(232,'T-280','2026-02-17',76000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(233,'T-280','2026-02-17',76000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(234,'T-280','2026-02-17',76000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(235,'T-280','2026-02-17',76000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(236,'T-281','2026-02-08',38000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(237,'T-281','2026-02-08',38000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(238,'T-281','2026-02-08',38000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(239,'T-282','2026-02-18',15000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(240,'T-283','2026-02-22',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(241,'T-283','2026-02-22',60000,'Cash','Malam','2026-06-29 01:11:45','2026-06-29 01:11:45'),(242,'T-284','2026-01-28',45000,'Cash','Malam','2026-06-29 01:11:46','2026-06-29 01:11:46'),(243,'T-284','2026-01-28',45000,'Cash','Malam','2026-06-29 01:11:46','2026-06-29 01:11:46'),(244,'T-285','2026-01-31',23000,'Cash','Siang','2026-06-29 01:11:46','2026-06-29 01:11:46'),(245,'T-285','2026-01-31',23000,'Cash','Siang','2026-06-29 01:11:46','2026-06-29 01:11:46'),(246,'T-286','2026-02-12',75000,'Cash','Siang','2026-06-29 01:11:46','2026-06-29 01:11:46'),(247,'T-286','2026-02-12',75000,'Cash','Siang','2026-06-29 01:11:46','2026-06-29 01:11:46'),(248,'T-286','2026-02-12',75000,'Cash','Siang','2026-06-29 01:11:46','2026-06-29 01:11:46'),(249,'T-286','2026-02-12',75000,'Cash','Siang','2026-06-29 01:11:46','2026-06-29 01:11:46'),(250,'T-286','2026-02-12',75000,'Cash','Siang','2026-06-29 01:11:46','2026-06-29 01:11:46');
/*!40000 ALTER TABLE `transaksis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Info Coffee','admin','admin@infocoffee.com',NULL,'$2y$12$JpUMw0gAomNT5dDv7DDswOBwTVr5XxnnGknAATn0NctcW0T99TyRu',NULL,'2026-06-29 01:11:45','2026-06-29 01:11:45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-29 15:43:05
