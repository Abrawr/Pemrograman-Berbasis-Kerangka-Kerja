-- Database untuk Tugas Pertemuan 11: ShopEase Authentication System (Materi 23)
CREATE DATABASE IF NOT EXISTS `db_shopease`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `db_shopease`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(25) NULL,
  `role` ENUM('admin','operator','customer') NOT NULL DEFAULT 'customer',
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `failed_attempts` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `locked_until` DATETIME NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Akun demo:
-- admin@shopease.test    / Admin123!
-- operator@shopease.test / Operator123!
-- customer@shopease.test / Customer123!
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `is_active`, `failed_attempts`, `locked_until`, `created_at`, `updated_at`) VALUES
(1, 'Abrar Maulana (Admin)', 'admin@shopease.test', '$2y$12$CdG9dqOHyzr4BM4Bvv0jM.gP.SSWNS/gOqU2K3yEby1L/ftxy9fyK', '081234567890', 'admin', 1, 0, NULL, NOW(), NOW()),
(2, 'Operator Toko ShopEase', 'operator@shopease.test', '$2y$12$F/lMD.NmLJgoIdigGJ22oely4ZuRcZ/s47YICzmfemqsC20ys/zi6', '081298765432', 'operator', 1, 0, NULL, NOW(), NOW()),
(3, 'Pelanggan Demo', 'customer@shopease.test', '$2y$12$zEYXV/17lNL3Gn6Y7xsUi.K2gKvWRg/b1V.HNS9apdqSugjtQjYyW', '085611223344', 'customer', 1, 0, NULL, NOW(), NOW());
