-- Database untuk Latihan 2.1: Sistem Informasi Akademik (SIAKAD)
CREATE DATABASE IF NOT EXISTS `db_siakad`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `db_siakad`;

CREATE TABLE IF NOT EXISTS `dosen` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nidn` VARCHAR(20) NOT NULL,
  `nama` VARCHAR(120) NOT NULL,
  `email` VARCHAR(120) NOT NULL,
  `keahlian` VARCHAR(120) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dosen_nidn` (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nrp` VARCHAR(20) NOT NULL,
  `nama` VARCHAR(120) NOT NULL,
  `email` VARCHAR(120) NOT NULL,
  `angkatan` SMALLINT UNSIGNED NOT NULL DEFAULT 2024,
  `prodi` VARCHAR(100) NOT NULL DEFAULT 'Teknik Informatika',
  `dosen_wali_id` INT UNSIGNED NULL,
  `status` ENUM('Aktif','Cuti','Lulus') NOT NULL DEFAULT 'Aktif',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_mahasiswa_nrp` (`nrp`),
  CONSTRAINT `fk_mhs_dosen_wali` FOREIGN KEY (`dosen_wali_id`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode` VARCHAR(20) NOT NULL,
  `nama` VARCHAR(120) NOT NULL,
  `sks` TINYINT UNSIGNED NOT NULL,
  `semester` TINYINT UNSIGNED NOT NULL,
  `dosen_id` INT UNSIGNED NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_mk_kode` (`kode`),
  CONSTRAINT `fk_mk_dosen` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `krs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` INT UNSIGNED NOT NULL,
  `mata_kuliah_id` INT UNSIGNED NOT NULL,
  `tahun_ajaran` VARCHAR(20) NOT NULL DEFAULT '2026/2027-Ganjil',
  `nilai_huruf` VARCHAR(3) NULL,
  `nilai_angka` DECIMAL(3,2) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_krs_mhs_mk_ta` (`mahasiswa_id`, `mata_kuliah_id`, `tahun_ajaran`),
  CONSTRAINT `fk_krs_mahasiswa` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_krs_mk` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `dosen` (`id`, `nidn`, `nama`, `email`, `keahlian`, `created_at`, `updated_at`) VALUES
(1, '0012087901', 'Fajar Baskoro, S.Kom., M.T.', 'fajar.baskoro@if.its.ac.id', 'Rekayasa Perangkat Lunak & Kerangka Kerja', NOW(), NOW()),
(2, '0024058302', 'Ratna Kusuma Wardani, S.Kom., M.Cs.', 'ratna.wardani@if.its.ac.id', 'Basis Data & Sistem Informasi', NOW(), NOW()),
(3, '0019118604', 'Budi Santoso, S.T., M.Kom.', 'budi.santoso@if.its.ac.id', 'Arsitektur Aplikasi Web', NOW(), NOW()),
(4, '0008038805', 'Dina Permatasari, S.Kom., M.Sc.', 'dina.permata@if.its.ac.id', 'Interaksi Manusia & Komputer', NOW(), NOW());

INSERT IGNORE INTO `mahasiswa` (`id`, `nrp`, `nama`, `email`, `angkatan`, `prodi`, `dosen_wali_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '5025241125', 'Abrar Maulana', '5025241125@student.its.ac.id', 2024, 'Teknik Informatika', 1, 'Aktif', NOW(), NOW()),
(2, '5025241019', 'Jahhaza Assiqooyah', '5025241019@student.its.ac.id', 2024, 'Teknik Informatika', 1, 'Aktif', NOW(), NOW()),
(3, '5025241047', 'Kinanti Ayu Caesandria', '5025241047@student.its.ac.id', 2024, 'Teknik Informatika', 2, 'Aktif', NOW(), NOW()),
(4, '5025241059', 'Puspita Wijayanti', '5025241059@student.its.ac.id', 2024, 'Teknik Informatika', 2, 'Aktif', NOW(), NOW()),
(5, '5025241067', 'Bagus Cahya Saputra', '5025241067@student.its.ac.id', 2024, 'Teknik Informatika', 3, 'Aktif', NOW(), NOW()),
(6, '5025241049', 'Ibrahim Ferel', '5025241049@student.its.ac.id', 2024, 'Teknik Informatika', 4, 'Aktif', NOW(), NOW());

INSERT IGNORE INTO `mata_kuliah` (`id`, `kode`, `nama`, `sks`, `semester`, `dosen_id`, `created_at`, `updated_at`) VALUES
(1, 'EF234501', 'Pemrograman Berbasis Kerangka Kerja', 3, 5, 1, NOW(), NOW()),
(2, 'EF234502', 'Manajemen Basis Data Lanjut', 3, 5, 2, NOW(), NOW()),
(3, 'EF234503', 'Pemrograman Web Modern', 3, 5, 3, NOW(), NOW()),
(4, 'EF234504', 'Desain Antarmuka Pengguna', 3, 5, 4, NOW(), NOW()),
(5, 'EF234505', 'Rekayasa Perangkat Lunak', 4, 5, 1, NOW(), NOW());

INSERT IGNORE INTO `krs` (`id`, `mahasiswa_id`, `mata_kuliah_id`, `tahun_ajaran`, `nilai_huruf`, `nilai_angka`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026/2027-Ganjil', 'A', 4.00, NOW(), NOW()),
(2, 1, 2, '2026/2027-Ganjil', 'AB', 3.50, NOW(), NOW()),
(3, 1, 3, '2026/2027-Ganjil', 'A', 4.00, NOW(), NOW()),
(4, 1, 5, '2026/2027-Ganjil', 'AB', 3.50, NOW(), NOW()),
(5, 2, 1, '2026/2027-Ganjil', 'A', 4.00, NOW(), NOW()),
(6, 2, 4, '2026/2027-Ganjil', 'A', 4.00, NOW(), NOW()),
(7, 3, 1, '2026/2027-Ganjil', 'AB', 3.50, NOW(), NOW()),
(8, 4, 2, '2026/2027-Ganjil', 'A', 4.00, NOW(), NOW());
