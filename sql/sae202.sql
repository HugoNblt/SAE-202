-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sae202
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-0+deb12u1

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `is_published` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `moderated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES
(1,1,'Super article, merci pour le partage !',1,'2025-06-25 09:03:09',NULL,'2025-06-25 09:03:09'),
(2,2,'Je ne suis pas tout à fait d’accord avec ce point.',1,'2025-06-25 09:03:09',NULL,'2025-06-25 09:03:09'),
(3,3,'Très intéressant, j’aimerais en savoir plus.',0,'2025-06-25 09:03:09',NULL,NULL),
(4,4,'Bravo pour cette initiative.',1,'2025-06-25 09:03:09',NULL,'2025-06-25 09:03:09'),
(5,5,'Peut-on avoir plus de détails ?',0,'2025-06-25 09:03:09',NULL,NULL),
(6,6,'Je recommande vivement ce site.',1,'2025-06-25 09:03:09',NULL,'2025-06-25 09:03:09'),
(7,7,'Merci pour les infos.',1,'2025-06-25 09:03:09',NULL,'2025-06-25 09:03:09'),
(8,8,'À quand la suite ?',0,'2025-06-25 09:03:09',NULL,NULL),
(9,9,'Je trouve ça utile pour les débutants.',1,'2025-06-25 09:03:09',NULL,'2025-06-25 09:03:09'),
(10,10,'Je reviendrai lire les prochaines publications.',1,'2025-06-25 09:03:09',NULL,'2025-06-25 09:03:09');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motif` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES
(1,1,'alice.dupont@example.com','Question','Bonjour, j’ai une question sur votre service.',0,'2025-06-25 09:03:09'),
(2,2,'marc.durand@example.com','Support','Je rencontre un bug sur la page de profil.',1,'2025-06-25 09:03:09'),
(3,3,'claire.martin@example.com','Suggestion','Serait-il possible d’ajouter un mode sombre ?',0,'2025-06-25 09:03:09'),
(4,4,'lucas.petit@example.com','Autre','Je souhaite supprimer mon compte.',1,'2025-06-25 09:03:09'),
(5,5,'julie.bernard@example.com','Question','Comment modifier mon mot de passe ?',1,'2025-06-25 09:03:09'),
(6,6,'nicolas.robert@example.com','Support','Mon avatar ne s’affiche plus.',0,'2025-06-25 09:03:09'),
(7,7,'sophie.lemoine@example.com','Suggestion','Une appli mobile serait top !',0,'2025-06-25 09:03:09'),
(8,8,'antoine.fabre@example.com','Autre','Merci pour votre travail !',1,'2025-06-25 09:03:09'),
(9,9,'camille.giraud@example.com','Question','Est-ce que l’on peut réserver pour plusieurs personnes ?',0,'2025-06-25 09:03:09'),
(10,10,'julien.moreau@example.com','Support','Je ne reçois pas l’email de confirmation.',1,'2025-06-25 09:03:09');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `nb_places` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES
(1,1,'2025-07-10',2,'2025-06-25 09:03:09'),
(2,2,'2025-07-12',1,'2025-06-25 09:03:09'),
(3,3,'2025-07-15',4,'2025-06-25 09:03:09'),
(4,4,'2025-07-20',3,'2025-06-25 09:03:09'),
(5,5,'2025-07-18',1,'2025-06-25 09:03:09'),
(6,6,'2025-07-25',2,'2025-06-25 09:03:09'),
(7,7,'2025-07-28',1,'2025-06-25 09:03:09'),
(8,8,'2025-07-30',5,'2025-06-25 09:03:09'),
(9,9,'2025-08-01',2,'2025-06-25 09:03:09'),
(10,10,'2025-08-05',1,'2025-06-25 09:03:09');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `username` varchar(50) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Alice','Dupont','alice.dupont@example.com','hashedpwd1','0601020304','1990-05-12','user','alice_d',NULL,NULL,'Aime lire et voyager.','France','Paris','123 Rue de Paris','75001',NULL,'2025-06-25 09:03:08'),
(2,'Marc','Durand','marc.durand@example.com','hashedpwd2','0611121314','1985-11-20','user','marcd',NULL,NULL,'Fan de foot.','France','Lyon','45 Avenue Jean Jaurès','69007',NULL,'2025-06-25 09:03:08'),
(3,'Claire','Martin','claire.martin@example.com','hashedpwd3','0622233445','1992-07-08','user','clairem',NULL,NULL,'Passionnée de photo.','Belgique','Bruxelles','10 Rue Royale','1000',NULL,'2025-06-25 09:03:08'),
(4,'Lucas','Petit','lucas.petit@example.com','hashedpwd4','0633344556','1998-03-15','user','lucaspetit',NULL,NULL,'Amateur de cinéma.','Suisse','Genève','8 Chemin Vert','1203',NULL,'2025-06-25 09:03:08'),
(5,'Julie','Bernard','julie.bernard@example.com','hashedpwd5','0644455566','1995-09-30','user','julieb',NULL,NULL,'Cuisine et randonnée.','France','Toulouse','67 Rue des Fleurs','31000',NULL,'2025-06-25 09:03:08'),
(6,'Nicolas','Robert','nicolas.robert@example.com','hashedpwd6','0655566677','1987-02-21','user','nrobert',NULL,NULL,'Gamer et développeur.','France','Nice','25 Promenade des Anglais','06000',NULL,'2025-06-25 09:03:08'),
(7,'Sophie','Lemoine','sophie.lemoine@example.com','hashedpwd7','0666677788','1993-12-05','user','slem',NULL,NULL,'Écriture et arts.','Canada','Montréal','200 Rue Sainte-Catherine','H2X 1L1',NULL,'2025-06-25 09:03:08'),
(8,'Antoine','Fabre','antoine.fabre@example.com','hashedpwd8','0677788899','1990-08-19','user','antfab',NULL,NULL,'Voyages et histoire.','France','Bordeaux','12 Cours Victor Hugo','33000',NULL,'2025-06-25 09:03:08'),
(9,'Camille','Giraud','camille.giraud@example.com','hashedpwd9','0688899900','1996-04-10','user','camgiraud',NULL,NULL,'Nature et animaux.','France','Lille','89 Rue de la Liberté','59000',NULL,'2025-06-25 09:03:08'),
(10,'Julien','Moreau','julien.moreau@example.com','hashedpwd10','0699900011','1989-06-25','user','jmoreau',NULL,NULL,'Musique et sport.','France','Marseille','14 Boulevard Longchamp','13001',NULL,'2025-06-25 09:03:08'),
(11,'Alexis','Laillier','test@gmail.com','$2y$10$B/UZfVu/Bya7HwhM2heQ7.7qNCHBHmb.t7ogKxTdSl2TOLOeBO6vW','0600000000','2025-05-28','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-25 09:04:01'),
(12,'prod','prof','prof@mmi.fr','$2y$10$jrCyzM.yfi4hQLlypRqgXOEk/9NnRPKfCixhAxpEMXE7ZCpnhDr3u','0600000000','2025-05-26','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-25 09:04:42');
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

-- Dump completed on 2025-06-25  9:07:34
