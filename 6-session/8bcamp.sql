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
INSERT INTO `orders` VALUES (1,1,1,2,36000000,'2026-05-11 10:20:03'),(2,6,11,1,8500000,'2026-05-11 11:08:27'),(3,7,6,1,4500000,'2026-05-11 11:08:27'),(4,8,9,1,5200000,'2026-05-11 11:08:27'),(5,9,10,1,15000000,'2026-05-11 11:08:27'),(6,10,8,1,14000000,'2026-05-11 11:08:27');
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
  `price` int NOT NULL,
  `description` text,
  `stock` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Laptop MacBook M2',18000000,'Laptop kencang untuk koding',10),(2,'MacBook Pro',45000000,'Laptop Apple Tipe Tertinggi',15),(3,'iPhone 15 Pro',21000000,'iPhone terbaru warna Titanium',10),(4,'Logitech MX Master 3S',1500000,'Mouse wireless ergonomic',25),(5,'Keychron K2 V2',1200000,'Mechanical Keyboard Wireless',20),(6,'Monitor Dell 27 Inch',4500000,'4K UltraSharp Monitor',8),(7,'AirPods Pro Gen 2',3800000,'Noise cancelling earbuds',30),(8,'Samsung Galaxy S24',14000000,'Flagship Android terbaru',12),(9,'Sony WH-1000XM5',5200000,'Headphone Noise Cancelling terbaik',5),(10,'iPad Pro M2',15000000,'Tablet powerful untuk desain',7),(11,'PlayStation 5',8500000,'Konsol game generasi terbaru',4);
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

-- Dump completed on 2026-05-11 18:13:12
