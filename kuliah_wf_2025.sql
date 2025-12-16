-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for kuliah_wf_2025
CREATE DATABASE IF NOT EXISTS `kuliah_wf_2025` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kuliah_wf_2025`;

-- Dumping structure for table kuliah_wf_2025.detail_rekam_medis
CREATE TABLE IF NOT EXISTS `detail_rekam_medis` (
  `iddetail_rekam_medis` int NOT NULL AUTO_INCREMENT,
  `idrekam_medis` int NOT NULL,
  `idkode_tindakan_terapi` int NOT NULL,
  `detail` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`iddetail_rekam_medis`),
  KEY `fk_detail_rekam_medis_rekam_medis1_idx` (`idrekam_medis`),
  KEY `idkode_tindakan_terapi` (`idkode_tindakan_terapi`),
  CONSTRAINT `detail_rekam_medis_ibfk_1` FOREIGN KEY (`idkode_tindakan_terapi`) REFERENCES `kode_tindakan_terapi` (`idkode_tindakan_terapi`),
  CONSTRAINT `fk_detail_rekam_medis_rekam_medis1` FOREIGN KEY (`idrekam_medis`) REFERENCES `rekam_medis` (`idrekam_medis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.detail_rekam_medis: ~0 rows (approximately)

-- Dumping structure for table kuliah_wf_2025.dokter
CREATE TABLE IF NOT EXISTS `dokter` (
  `id_dokter` int NOT NULL AUTO_INCREMENT,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bidang_dokter` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` varchar(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_user` bigint NOT NULL,
  PRIMARY KEY (`id_dokter`),
  UNIQUE KEY `id_user_UNIQUE` (`id_user`),
  CONSTRAINT `fk_dokter_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.dokter: ~0 rows (approximately)

-- Dumping structure for table kuliah_wf_2025.jenis_hewan
CREATE TABLE IF NOT EXISTS `jenis_hewan` (
  `idjenis_hewan` int NOT NULL AUTO_INCREMENT,
  `nama_jenis_hewan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idjenis_hewan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.jenis_hewan: ~6 rows (approximately)
INSERT INTO `jenis_hewan` (`idjenis_hewan`, `nama_jenis_hewan`) VALUES
	(1, 'Anjing (Canis lupus familiaris)'),
	(2, 'Kucing (Felis catus)'),
	(3, 'Kelinci (Oryctolagus cuniculus)'),
	(4, 'Burung'),
	(5, 'Reptil'),
	(6, 'Rodent / Hewan Kecil');

-- Dumping structure for table kuliah_wf_2025.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kuliah_wf_2025.jobs: ~0 rows (approximately)

-- Dumping structure for table kuliah_wf_2025.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
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

-- Dumping data for table kuliah_wf_2025.job_batches: ~0 rows (approximately)

-- Dumping structure for table kuliah_wf_2025.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `idkategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.kategori: ~8 rows (approximately)
INSERT INTO `kategori` (`idkategori`, `nama_kategori`) VALUES
	(1, 'Vaksinasi'),
	(2, 'Bedah / Operasi'),
	(3, 'Cairan infus'),
	(4, 'Terapi Injeksi'),
	(5, 'Terapi Oral'),
	(6, 'Diagnostik'),
	(7, 'Rawat Inap'),
	(8, 'Lain-lain');

-- Dumping structure for table kuliah_wf_2025.kategori_klinis
CREATE TABLE IF NOT EXISTS `kategori_klinis` (
  `idkategori_klinis` int NOT NULL AUTO_INCREMENT,
  `nama_kategori_klinis` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkategori_klinis`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.kategori_klinis: ~2 rows (approximately)
INSERT INTO `kategori_klinis` (`idkategori_klinis`, `nama_kategori_klinis`) VALUES
	(1, 'Terapi'),
	(2, 'Tindakan');

-- Dumping structure for table kuliah_wf_2025.kode_tindakan_terapi
CREATE TABLE IF NOT EXISTS `kode_tindakan_terapi` (
  `idkode_tindakan_terapi` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi_tindakan_terapi` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idkategori` int NOT NULL,
  `idkategori_klinis` int NOT NULL,
  PRIMARY KEY (`idkode_tindakan_terapi`),
  KEY `fk_kode_tindakan_terapi_kategori1_idx` (`idkategori`),
  KEY `fk_kode_tindakan_terapi_kategori_klinis1_idx` (`idkategori_klinis`),
  CONSTRAINT `fk_kode_tindakan_terapi_kategori1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`),
  CONSTRAINT `fk_kode_tindakan_terapi_kategori_klinis1` FOREIGN KEY (`idkategori_klinis`) REFERENCES `kategori_klinis` (`idkategori_klinis`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.kode_tindakan_terapi: ~32 rows (approximately)
INSERT INTO `kode_tindakan_terapi` (`idkode_tindakan_terapi`, `kode`, `deskripsi_tindakan_terapi`, `idkategori`, `idkategori_klinis`) VALUES
	(1, 'T01', 'Vaksinasi Rabies', 1, 1),
	(2, 'T02', 'Vaksinasi Polivalen (DHPPi/L untuk anjing)', 1, 1),
	(3, 'T03', 'Vaksinasi Panleukopenia / Tricat kucing', 1, 1),
	(4, 'T04', 'Vaksinasi lainnya (bordetella, influenza, dsb.)', 1, 1),
	(5, 'T05', 'Sterilisasi jantan', 2, 2),
	(6, 'T06', 'Sterilisasi betina', 2, 2),
	(9, 'T07', 'Minor surgery (luka, abses)', 2, 2),
	(10, 'T08', 'Major surgery (laparotomi, tumor)', 2, 2),
	(11, 'T09', 'Infus intravena cairan kristaloid', 3, 1),
	(12, 'T10', 'Infus intravena cairan koloid', 3, 1),
	(13, 'T11', 'Antibiotik injeksi', 4, 1),
	(14, 'T12', 'Antiparasit injeksi', 4, 1),
	(15, 'T13', 'Antiemetik / gastroprotektor', 4, 1),
	(16, 'T14', 'Analgesik / antiinflamasi', 4, 1),
	(17, 'T15', 'Kortikosteroid', 4, 1),
	(18, 'T16', 'Antibiotik oral', 5, 1),
	(19, 'T17', 'Antiparasit oral', 5, 1),
	(20, 'T18', 'Vitamin / suplemen', 5, 1),
	(21, 'T19', 'Diet khusus', 5, 1),
	(22, 'T20', 'Pemeriksaan darah rutin', 6, 2),
	(23, 'T21', 'Pemeriksaan kimia darah', 6, 2),
	(24, 'T22', 'Pemeriksaan feses / parasitologi', 6, 2),
	(25, 'T23', 'Pemeriksaan urin', 6, 2),
	(26, 'T24', 'Radiografi (rontgen)', 6, 2),
	(27, 'T25', 'USG Abdomen', 6, 2),
	(28, 'T26', 'Sitologi / biopsi', 6, 2),
	(29, 'T27', 'Rapid test penyakit infeksi', 6, 2),
	(30, 'T28', 'Observasi sehari', 7, 2),
	(31, 'T29', 'Observasi lebih dari 1 hari', 7, 2),
	(32, 'T30', 'Grooming medis', 8, 2),
	(33, 'T31', 'Deworming', 8, 1),
	(34, 'T32', 'Ektoparasit control', 8, 1);

-- Dumping structure for table kuliah_wf_2025.pemilik
CREATE TABLE IF NOT EXISTS `pemilik` (
  `idpemilik` int NOT NULL,
  `no_wa` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iduser` bigint NOT NULL,
  PRIMARY KEY (`idpemilik`),
  KEY `fk_pemilik_user1_idx` (`iduser`),
  CONSTRAINT `fk_pemilik_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.pemilik: ~0 rows (approximately)

-- Dumping structure for table kuliah_wf_2025.perawat
CREATE TABLE IF NOT EXISTS `perawat` (
  `id_perawat` int NOT NULL AUTO_INCREMENT,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` varchar(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pendidikan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_user` bigint NOT NULL,
  PRIMARY KEY (`id_perawat`),
  UNIQUE KEY `id_user_UNIQUE` (`id_user`),
  CONSTRAINT `fk_perawat_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.perawat: ~0 rows (approximately)

-- Dumping structure for table kuliah_wf_2025.pet
CREATE TABLE IF NOT EXISTS `pet` (
  `idpet` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `warna_tanda` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpemilik` int NOT NULL,
  `idras_hewan` int NOT NULL,
  PRIMARY KEY (`idpet`),
  KEY `fk_pet_pemilik1_idx` (`idpemilik`),
  KEY `fk_pet_ras_hewan1_idx` (`idras_hewan`),
  CONSTRAINT `fk_pet_pemilik1` FOREIGN KEY (`idpemilik`) REFERENCES `pemilik` (`idpemilik`),
  CONSTRAINT `fk_pet_ras_hewan1` FOREIGN KEY (`idras_hewan`) REFERENCES `ras_hewan` (`idras_hewan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.pet: ~0 rows (approximately)

-- Dumping structure for table kuliah_wf_2025.ras_hewan
CREATE TABLE IF NOT EXISTS `ras_hewan` (
  `idras_hewan` int NOT NULL AUTO_INCREMENT,
  `nama_ras` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjenis_hewan` int NOT NULL,
  PRIMARY KEY (`idras_hewan`),
  KEY `fk_ras_hewan_jenis_hewan1_idx` (`idjenis_hewan`),
  CONSTRAINT `fk_ras_hewan_jenis_hewan1` FOREIGN KEY (`idjenis_hewan`) REFERENCES `jenis_hewan` (`idjenis_hewan`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.ras_hewan: ~44 rows (approximately)
INSERT INTO `ras_hewan` (`idras_hewan`, `nama_ras`, `idjenis_hewan`) VALUES
	(1, 'Golden Retriever', 1),
	(2, 'Labrador Retriever', 1),
	(3, 'German Shepherd', 1),
	(4, 'Bulldog (English, French)', 1),
	(5, 'Poodle (Toy, Miniature, Standard)', 1),
	(6, 'Beagle', 1),
	(7, 'Siberian Husky', 1),
	(8, 'Shih Tzu', 1),
	(9, 'Dachshund', 1),
	(10, 'Chihuahua', 1),
	(11, 'Persia', 2),
	(12, 'Maine Coon', 2),
	(13, 'Siamese', 2),
	(14, 'Bengal', 2),
	(15, 'Sphynx', 2),
	(16, 'Scottish Fold', 2),
	(17, 'British Shorthair', 2),
	(18, 'Anggora', 2),
	(19, 'Domestic Shorthair (kampung)', 2),
	(20, 'Ragdoll', 2),
	(21, 'Holland Lop', 3),
	(22, 'Netherland Dwarf', 3),
	(23, 'Flemish Giant', 3),
	(24, 'Lionhead', 3),
	(25, 'Rex', 3),
	(26, 'Angora Rabbit', 3),
	(27, 'Mini Lop', 3),
	(28, 'Lovebird (Agapornis sp.)', 4),
	(29, 'Kakatua (Cockatoo)', 4),
	(30, 'Parrot / Nuri (Macaw, African Grey, Amazon Parrot)', 4),
	(31, 'Kenari (Serinus canaria)', 4),
	(32, 'Merpati (Columba livia)', 4),
	(33, 'Parkit (Budgerigar / Melopsittacus undulatus)', 4),
	(34, 'Jalak (Sturnus sp.)', 4),
	(35, 'Kura-kura Sulcata (African spurred tortoise)', 5),
	(36, 'Red-Eared Slider (Trachemys scripta elegans)', 5),
	(37, 'Leopard Gecko', 5),
	(38, 'Iguana hijau', 5),
	(39, 'Ball Python', 5),
	(40, 'Corn Snake', 5),
	(41, 'Hamster (Syrian, Roborovski, Campbell, Winter White)', 6),
	(42, 'Guinea Pig (Abyssinian, Peruvian, American Shorthair)', 6),
	(43, 'Gerbil', 6),
	(44, 'Chinchilla', 6);

-- Dumping structure for table kuliah_wf_2025.rekam_medis
CREATE TABLE IF NOT EXISTS `rekam_medis` (
  `idrekam_medis` int NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `anamnesa` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `temuan_klinis` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `diagnosa` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpet` int NOT NULL,
  `idreservasi_dokter` int DEFAULT NULL,
  PRIMARY KEY (`idrekam_medis`),
  KEY `fk_rekam_medis_pet1_idx` (`idpet`),
  KEY `fk_rekam_medis_role_user1_idx` (`idreservasi_dokter`),
  CONSTRAINT `fk_rekam_medis_pet1` FOREIGN KEY (`idpet`) REFERENCES `pet` (`idpet`),
  CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`idreservasi_dokter`) REFERENCES `role_user` (`idrole_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.rekam_medis: ~0 rows (approximately)

-- Dumping structure for table kuliah_wf_2025.role
CREATE TABLE IF NOT EXISTS `role` (
  `idrole` int NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.role: ~5 rows (approximately)
INSERT INTO `role` (`idrole`, `nama_role`) VALUES
	(1, 'Administrator'),
	(2, 'Dokter'),
	(3, 'Perawat'),
	(4, 'Resepsionis'),
	(5, 'Pemilik');

-- Dumping structure for table kuliah_wf_2025.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `idrole_user` int NOT NULL AUTO_INCREMENT,
  `iduser` bigint NOT NULL,
  `idrole` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`idrole_user`),
  KEY `fk_role_user_user_idx` (`iduser`),
  KEY `fk_role_user_role1_idx` (`idrole`),
  CONSTRAINT `fk_role_user_role1` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`),
  CONSTRAINT `fk_role_user_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.role_user: ~5 rows (approximately)
INSERT INTO `role_user` (`idrole_user`, `iduser`, `idrole`, `status`) VALUES
	(1, 6, 1, 1),
	(4, 7, 2, 1),
	(5, 8, 3, 1),
	(6, 9, 4, 1),
	(7, 11, 5, 1);

-- Dumping structure for table kuliah_wf_2025.temu_dokter
CREATE TABLE IF NOT EXISTS `temu_dokter` (
  `idtemu_dokter` int NOT NULL,
  `idpet` int NOT NULL,
  `iddokter` bigint NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `keluhan` text COLLATE utf8mb4_general_ci,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  UNIQUE KEY `iddokter` (`iddokter`,`tanggal`,`waktu`),
  UNIQUE KEY `iddokter_2` (`iddokter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.temu_dokter: ~0 rows (approximately)

-- Dumping structure for table kuliah_wf_2025.user
CREATE TABLE IF NOT EXISTS `user` (
  `iduser` bigint NOT NULL AUTO_INCREMENT,
  `nama` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kuliah_wf_2025.user: ~5 rows (approximately)
INSERT INTO `user` (`iduser`, `nama`, `email`, `password`) VALUES
	(6, 'admin', 'admin@mail.com', '$2y$10$Dtf/Q8cjXmJvewWGTye8bOehY51JJTKBHjexDHmlINFukmdT8x3Hm'),
	(7, 'Orochimaru', 'uler@mail.com', '$2y$10$O.JRkIFildvZJQuyhFikreMu81pAQTCUgJFqEE6IMLFl/zS4OwV.S'),
	(8, 'Tenten', 'ten@mail.com', '$2y$10$Wy8E2SWU4vJmoWw1D1y9.efZl5uy69bvi09m1T7QFqiJg2sOn.C6W'),
	(9, 'Hyuuga Hinata', 'hinata@mail.com', '$2y$10$8k5CuiD6mOxeEqDx.c6oZu78tcmQLZCnPYTq4p8e4./eXlMeGOqjG'),
	(11, 'Uzumaki Himawari', 'himawari@mail.com', '$2y$10$b5Esm.1SsiqiPsdkREBeyuIFrp4kkOUZ5Azk/0ReZqjr4sHBOqUxW');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
