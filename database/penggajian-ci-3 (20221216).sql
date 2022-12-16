-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.6.11-MariaDB-0ubuntu0.22.04.1 - Ubuntu 22.04
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for penggajian-ci-3
DROP DATABASE IF EXISTS `penggajian-ci-3`;
CREATE DATABASE IF NOT EXISTS `penggajian-ci-3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `penggajian-ci-3`;

-- Dumping structure for table penggajian-ci-3.intensif
DROP TABLE IF EXISTS `intensif`;
CREATE TABLE IF NOT EXISTS `intensif` (
  `id_intensif` int(11) NOT NULL AUTO_INCREMENT,
  `intensif` varchar(100) NOT NULL,
  `jml_intensif` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_intensif`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table penggajian-ci-3.intensif: ~2 rows (approximately)
INSERT INTO `intensif` (`id_intensif`, `intensif`, `jml_intensif`) VALUES
	(1, 'Full Hadir', 200000),
	(2, 'Transportasi', 50000);

-- Dumping structure for table penggajian-ci-3.jabatan
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tj_transport` int(11) NOT NULL,
  `uang_makan` int(11) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table penggajian-ci-3.jabatan: ~5 rows (approximately)
INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `tj_transport`, `uang_makan`) VALUES
	(1, 'Pendidik TPA', 5000000, 1000000, 600000),
	(2, 'Admin', 10000000, 8000000, 1000000),
	(4, 'Pendidik TK', 500000, 100000, 50000),
	(5, 'Pendidik PAUD', 400000, 60000, 20000),
	(6, 'Tenaga Kebersihan', 500000, 400000, 200000);

-- Dumping structure for table penggajian-ci-3.kehadiran
DROP TABLE IF EXISTS `kehadiran`;
CREATE TABLE IF NOT EXISTS `kehadiran` (
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

-- Dumping data for table penggajian-ci-3.kehadiran: ~9 rows (approximately)
INSERT INTO `kehadiran` (`id_kehadiran`, `bulan`, `nik`, `id_pegawai`, `jk_kehadiran`, `id_jabatan`, `hadir`, `sakit`, `alpa`) VALUES
	(8, '092020', '985746387', 3, 'L', 1, 1, 1, 2),
	(9, '092020', '875647598', 6, 'L', 2, 0, 0, 0),
	(10, '102020', '985746387', 3, 'L', 1, 20, 0, 2),
	(11, '102020', '875647598', 6, 'L', 2, 19, 0, 1),
	(12, '102020', '875647837', 8, 'L', 1, 30, 0, 0),
	(13, '122022', '', 3, 'L', 1, 2, 0, 1),
	(14, '122022', '875647598', 6, 'L', 2, 3, 0, 2),
	(15, '122022', '875647837', 8, 'L', 1, 1, 0, 1),
	(16, '122022', '2147483647', 3, 'L', 2, 0, 0, 0);

-- Dumping structure for table penggajian-ci-3.kehadiran_detail
DROP TABLE IF EXISTS `kehadiran_detail`;
CREATE TABLE IF NOT EXISTS `kehadiran_detail` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table penggajian-ci-3.kehadiran_detail: ~3 rows (approximately)
INSERT INTO `kehadiran_detail` (`id_kehadiran_detail`, `tanggal`, `nik`, `id_pegawai`, `hadir`, `sakit`, `izin`, `alpa`, `waktu_absen`, `waktu_pulang`) VALUES
	(1, '2022-12-13', '875647598', 6, b'1', b'0', b'0', 0, '2022-12-14 14:53:48', NULL),
	(2, '2022-12-12', '875647598', 6, b'1', b'0', b'1', 0, '2022-12-14 15:28:02', NULL),
	(3, '2022-12-14', '875647598', 6, b'0', b'1', b'0', 0, '2022-12-14 15:43:51', '2022-12-14 16:51:10');

-- Dumping structure for table penggajian-ci-3.pegawai
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE IF NOT EXISTS `pegawai` (
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

-- Dumping data for table penggajian-ci-3.pegawai: ~3 rows (approximately)
INSERT INTO `pegawai` (`id_pegawai`, `nik`, `nama_pegawai`, `jk_pegawai`, `id_jabatan`, `tgl_masuk`, `status`, `photo`, `id_user`) VALUES
	(3, 2147483647, 'Muhammad Syifaaudz Dzihni Al Hamdi', 'P', 5, '2020-09-10', '1', '0ed2dc4b-560c-47bc-ac3f-147d15b862cd.jpg', 1),
	(6, 875647598, 'Rozi Amrin', 'L', 2, '2020-09-28', '1', 'avatar.png', 2),
	(8, 875647837, 'Muhammad Ridho', 'L', 1, '2020-10-13', '1', 'prod-2.jpg', 6);

-- Dumping structure for table penggajian-ci-3.potongan_gaji
DROP TABLE IF EXISTS `potongan_gaji`;
CREATE TABLE IF NOT EXISTS `potongan_gaji` (
  `id_poga` int(11) NOT NULL,
  `potongan` varchar(100) NOT NULL,
  `jml_potongan` int(11) NOT NULL,
  PRIMARY KEY (`id_poga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table penggajian-ci-3.potongan_gaji: ~3 rows (approximately)
INSERT INTO `potongan_gaji` (`id_poga`, `potongan`, `jml_potongan`) VALUES
	(0, 'Absen', 100000),
	(2, 'Sakit', 0),
	(3, 'Izin', 50000),
	(4, 'Alpa', 100000);

-- Dumping structure for table penggajian-ci-3.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_roles` int(11) NOT NULL AUTO_INCREMENT,
  `nama_roles` varchar(100) NOT NULL,
  PRIMARY KEY (`id_roles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table penggajian-ci-3.roles: ~0 rows (approximately)

-- Dumping structure for table penggajian-ci-3.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `id_roles` int(11) NOT NULL COMMENT '1 = admin\r\n2 = pegawai',
  `foto_user` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table penggajian-ci-3.user: ~2 rows (approximately)
INSERT INTO `user` (`id_user`, `username`, `password`, `id_roles`, `foto_user`) VALUES
	(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'ridho.jpg'),
	(2, 'pegawai', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2, 'pegawai.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
