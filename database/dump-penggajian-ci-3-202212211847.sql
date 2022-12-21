-- MariaDB dump 10.19  Distrib 10.6.11-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: penggajian-ci-3
-- ------------------------------------------------------
-- Server version	10.6.11-MariaDB-0ubuntu0.22.04.1

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
-- Table structure for table `intensif`
--

DROP TABLE IF EXISTS `intensif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intensif` (
  `id_intensif` int(11) NOT NULL AUTO_INCREMENT,
  `intensif` varchar(100) NOT NULL,
  `jml_intensif` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_intensif`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intensif`
--

LOCK TABLES `intensif` WRITE;
/*!40000 ALTER TABLE `intensif` DISABLE KEYS */;
INSERT INTO `intensif` VALUES (1,'Full Hadir',200000),(2,'Transportasi',50000);
/*!40000 ALTER TABLE `intensif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tj_transport` int(11) NOT NULL,
  `uang_makan` int(11) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jabatan`
--

LOCK TABLES `jabatan` WRITE;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` VALUES (1,'Pendidik TPA',5000000,1000000,600000),(2,'Admin',10000000,8000000,1000000),(4,'Pendidik TK',500000,100000,50000),(5,'Pendidik PAUD',400000,60000,20000),(6,'Tenaga Kebersihan',500000,400000,200000);
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kehadiran`
--

DROP TABLE IF EXISTS `kehadiran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `id_pegawai` int(11) NOT NULL COMMENT 'nama pegawai',
  `jk_kehadiran` enum('L','P') NOT NULL,
  `id_jabatan` int(11) NOT NULL COMMENT 'nama jabatan',
  `hadir` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `alpa` int(11) NOT NULL,
  PRIMARY KEY (`id_kehadiran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kehadiran`
--

LOCK TABLES `kehadiran` WRITE;
/*!40000 ALTER TABLE `kehadiran` DISABLE KEYS */;
INSERT INTO `kehadiran` VALUES (8,'092020','985746387',3,'L',1,1,1,2),(9,'092020','875647598',6,'L',2,0,0,0),(10,'102020','985746387',3,'L',1,20,0,2),(11,'102020','875647598',6,'L',2,19,0,1),(12,'102020','875647837',8,'L',1,30,0,0),(13,'122022','',3,'L',1,2,0,1),(14,'122022','875647598',6,'L',2,3,0,2),(15,'122022','875647837',8,'L',1,1,0,1),(16,'122022','2147483647',3,'L',2,0,0,0);
/*!40000 ALTER TABLE `kehadiran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kehadiran_detail`
--

DROP TABLE IF EXISTS `kehadiran_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kehadiran_detail` (
  `id_kehadiran_detail` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nik` varchar(50) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `hadir` bit(1) NOT NULL DEFAULT b'0',
  `sakit` bit(1) NOT NULL DEFAULT b'0',
  `izin` bit(1) NOT NULL DEFAULT b'0',
  `alpa` int(11) NOT NULL DEFAULT 0,
  `waktu_absen` datetime NOT NULL,
  `waktu_pulang` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kehadiran_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kehadiran_detail`
--

LOCK TABLES `kehadiran_detail` WRITE;
/*!40000 ALTER TABLE `kehadiran_detail` DISABLE KEYS */;
INSERT INTO `kehadiran_detail` VALUES (1,'2022-12-13','875647598',6,'','\0','\0',0,'2022-12-14 14:53:48',NULL),(2,'2022-12-12','875647598',6,'','\0','',0,'2022-12-14 15:28:02',NULL),(3,'2022-12-14','875647598',6,'\0','','\0',0,'2022-12-14 15:43:51','2022-12-14 16:51:10'),(4,'2022-12-20','875647598',6,'\0','','\0',0,'2022-12-20 16:32:49','2022-12-20 16:32:49'),(5,'2022-12-21','875647598',6,'\0','','\0',0,'2022-12-20 16:32:49','2022-12-20 16:32:49'),(6,'2022-12-22','875647598',6,'\0','','\0',0,'2022-12-20 16:32:49','2022-12-20 16:32:49'),(7,'2022-12-22','875647598',6,'\0','\0','',0,'2022-12-20 16:35:32','2022-12-20 16:35:32'),(8,'2022-12-20','875647598',6,'\0','\0','',0,'2022-12-20 16:51:45','2022-12-20 16:51:45'),(9,'2022-12-20','875647598',6,'\0','','\0',0,'2022-12-20 16:56:30','2022-12-20 16:56:30'),(10,'2022-12-20','875647598',6,'\0','\0','',0,'2022-12-20 17:33:48','2022-12-20 17:33:48'),(11,'2022-12-20','875647598',6,'\0','','\0',0,'2022-12-20 17:34:16','2022-12-20 17:34:16');
/*!40000 ALTER TABLE `kehadiran_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jk_pegawai` enum('L','P') NOT NULL,
  `id_jabatan` int(11) NOT NULL COMMENT 'nama jabatan',
  `tgl_masuk` date NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0 = pegawai tdk tetap\r\n1 = pegawai tetap',
  `photo` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_pegawai`),
  KEY `id_jabatan` (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pegawai`
--

LOCK TABLES `pegawai` WRITE;
/*!40000 ALTER TABLE `pegawai` DISABLE KEYS */;
INSERT INTO `pegawai` VALUES (3,2147483647,'Muhammad Syifaaudz Dzihni Al Hamdi','P',5,'2020-09-10','1','0ed2dc4b-560c-47bc-ac3f-147d15b862cd.jpg',1),(6,875647598,'Rozi Amrin','L',2,'2020-09-28','1','avatar.png',2),(8,875647837,'Muhammad Ridho','L',1,'2020-10-13','1','prod-2.jpg',5);
/*!40000 ALTER TABLE `pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `potongan_gaji`
--

DROP TABLE IF EXISTS `potongan_gaji`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `potongan_gaji` (
  `id_poga` int(11) NOT NULL,
  `potongan` varchar(100) NOT NULL,
  `jml_potongan` int(11) NOT NULL,
  PRIMARY KEY (`id_poga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `potongan_gaji`
--

LOCK TABLES `potongan_gaji` WRITE;
/*!40000 ALTER TABLE `potongan_gaji` DISABLE KEYS */;
INSERT INTO `potongan_gaji` VALUES (0,'Absen',100000),(2,'Sakit',0),(3,'Izin',50000),(4,'Alpa',100000);
/*!40000 ALTER TABLE `potongan_gaji` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL AUTO_INCREMENT,
  `nama_roles` varchar(100) NOT NULL,
  PRIMARY KEY (`id_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'Pegawai');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `id_roles` int(11) NOT NULL COMMENT '1 = admin\r\n2 = pegawai',
  `status` bit(1) NOT NULL DEFAULT b'1',
  `id_pegawai` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997',1,'',0),(2,'pegawai','d033e22ae348aeb5660fc2140aec35850c4da997',2,'',0),(5,'karyawan','87c78b8da768468c4f3826791496385536c11dad',2,'',8);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'penggajian-ci-3'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 18:47:51
