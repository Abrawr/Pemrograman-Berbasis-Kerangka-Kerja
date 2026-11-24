-- Database untuk Latihan 1: Biodata & Modul PBKK 2-1 s.d. 2-7
CREATE DATABASE IF NOT EXISTS `db_biodata`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `db_biodata`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(20) NOT NULL DEFAULT 'user',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `catatan` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` VARCHAR(150) NOT NULL,
  `kategori` VARCHAR(60) NOT NULL,
  `modul_pbkk` VARCHAR(30) NOT NULL,
  `isi` TEXT NOT NULL,
  `status` ENUM('Selesai','Proses','Direncanakan') NOT NULL DEFAULT 'Selesai',
  `lampiran` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Password default: admin123 (bcrypt)
INSERT IGNORE INTO `users` (`id`, `username`, `name`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Abrar Maulana', '$2y$12$QlxJYfRVJIHgStsVXqV7Ye2PPdt2TQrU0zAioKOur35NcHxzu4uPm', 'admin', NOW(), NOW());

INSERT IGNORE INTO `catatan` (`id`, `judul`, `kategori`, `modul_pbkk`, `isi`, `status`, `lampiran`, `created_at`, `updated_at`) VALUES
(1, 'Instalasi & Konfigurasi Awal CodeIgniter 4', 'Setup', 'PBKK 2-1', 'Menyiapkan struktur project appstarter, file .env, dan menampilkan halaman biodata mahasiswa.', 'Selesai', NULL, NOW(), NOW()),
(2, 'Routing Eksplisit dan Controller Profil', 'Routing', 'PBKK 2-2', 'Mengonfigurasi route /, /about, dan /contact dengan auto-routing dinonaktifkan.', 'Selesai', NULL, NOW(), NOW()),
(3, 'Integrasi Layout SB Admin & Bootstrap 5', 'View', 'PBKK 2-3 & 2-4', 'Memecah tampilan menjadi layout utama dan partial view sidebar, topbar, dan footer.', 'Selesai', NULL, NOW(), NOW()),
(4, 'Model CRUD, Upload Berkas, dan Auth Filter', 'Backend', 'PBKK 2-5 s.d. 2-7', 'Implementasi CatatanModel, validasi unggah gambar/dokumen, serta proteksi sesi login.', 'Selesai', NULL, NOW(), NOW());
