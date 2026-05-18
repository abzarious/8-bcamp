-- MySQL dump 10.13  Distrib 8.0.27, for macos11 (x86_64)
--
-- Host: 127.0.0.1    Database: 8bcamp
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Electronics'),(2,'Home Living'),(3,'Apparel');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total` int NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `price` int NOT NULL,
  `description` text,
  `stock` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `categories_products_fk` (`category_id`),
  CONSTRAINT `categories_products_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Logitech MX Master 3S','p1.webp',1,1500000,'Mouse wireless ergonomis dengan sensor 8K DPI dan klik senyap.',50),(2,'Keychron K2 Mechanical Keyboard','p2.webp',1,1200000,'Keyboard mekanik wireless dengan layout 75% dan RGB backlight.',50),(3,'Monitor Dell UltraSharp 27','p3.webp',1,6500000,'Monitor resolusi 4K dengan akurasi warna tinggi untuk desainer.',50),(4,'Meja Kerja Kayu Jati','p4.webp',2,2500000,'Meja kerja minimalis berbahan kayu jati solid dengan finishing halus.',50),(5,'Lampu Meja LED Smart','p5.webp',2,450000,'Lampu meja yang bisa diatur kecerahan dan temperatur warnanya via aplikasi.',50),(6,'Kursi Ergonomis ErgoPlus','p6.webp',2,3200000,'Kursi kantor dengan sandaran lumbar support dan bahan mesh premium.',50),(7,'Tanaman Hias Monstera','p7.webp',2,150000,'Tanaman hias indoor untuk mempercantik sudut ruangan.',50),(8,'Jaket Bomber Oversize','p8.webp',3,350000,'Jaket bomber bahan taslan tahan angin dengan potongan oversize.',50),(9,'Kaos Polos Cotton Combed 30s','p9.webp',3,85000,'Kaos bahan katun premium yang lembut dan menyerap keringat.',50),(10,'Celana Chino Slim Fit','p10.webp',3,275000,'Celana chino stretch yang nyaman untuk acara formal maupun santai.',50);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Budi Santoso','budi@email.com','ini_password_yang_sudah_dihash','2026-05-11 10:09:25'),(2,'Andi Wijaya','andi@email.com','hash_pass_1','2026-05-11 10:58:22'),(3,'Gilang Pranowo','gilang@email.com','hash_pass_2','2026-05-11 10:58:22'),(4,'Citra Lestari','citra@email.com','hash_pass_3','2026-05-11 10:58:22'),(5,'Dedi Kurniawan','dedi@email.com','hash_pass_4','2026-05-11 10:58:22'),(6,'Eka Putri','eka@email.com','hash_pass_5','2026-05-11 10:58:22'),(7,'Faisal Amir','faisal@email.com','hash_pass_6','2026-05-11 10:58:22'),(8,'Gita Permata','gita@email.com','hash_pass_7','2026-05-11 10:58:22'),(9,'Hendra Setiawan','hendra@email.com','hash_pass_8','2026-05-11 10:58:22'),(10,'Indah Sari','indah@email.com','hash_pass_9','2026-05-11 10:58:22'),(11,'Joko Susilo','joko@email.com','hash_pass_10','2026-05-11 10:58:22');
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

-- Dump completed on 2026-05-18 18:56:31
