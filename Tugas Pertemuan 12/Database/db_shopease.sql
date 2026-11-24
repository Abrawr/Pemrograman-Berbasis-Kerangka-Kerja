-- Database untuk Tugas Pertemuan 12: ShopEase Product Management CRUD (Materi 24)
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

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(110) NOT NULL,
  `description` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_categories_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT UNSIGNED NOT NULL,
  `sku` VARCHAR(50) NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(160) NOT NULL,
  `price` INT UNSIGNED NOT NULL,
  `original_price` INT UNSIGNED NULL,
  `stock` INT UNSIGNED NOT NULL DEFAULT 0,
  `status` ENUM('tersedia','tidak_tersedia') NOT NULL DEFAULT 'tersedia',
  `short_desc` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `featured` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_products_sku` (`sku`),
  UNIQUE KEY `uq_products_slug` (`slug`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` INT UNSIGNED NOT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `is_primary` TINYINT(1) NOT NULL DEFAULT 0,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_image_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `is_active`, `failed_attempts`, `locked_until`, `created_at`, `updated_at`) VALUES
(1, 'Abrar Maulana (Admin)', 'admin@shopease.test', '$2y$12$CdG9dqOHyzr4BM4Bvv0jM.gP.SSWNS/gOqU2K3yEby1L/ftxy9fyK', '081234567890', 'admin', 1, 0, NULL, NOW(), NOW()),
(2, 'Operator Toko ShopEase', 'operator@shopease.test', '$2y$12$F/lMD.NmLJgoIdigGJ22oely4ZuRcZ/s47YICzmfemqsC20ys/zi6', '081298765432', 'operator', 1, 0, NULL, NOW(), NOW()),
(3, 'Pelanggan Demo', 'customer@shopease.test', '$2y$12$zEYXV/17lNL3Gn6Y7xsUi.K2gKvWRg/b1V.HNS9apdqSugjtQjYyW', '085611223344', 'customer', 1, 0, NULL, NOW(), NOW());

INSERT IGNORE INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', 'elektronik', 'Audio studio, perangkat input presisi, dan wearable kerja harian.', NOW(), NOW()),
(2, 'Fashion', 'fashion', 'Alas kaki urban, jaket luar ruang, dan kemeja breathable.', NOW(), NOW()),
(3, 'Aksesoris', 'aksesoris', 'Ransel komuter anti-air, dompet kulit, dan perlindungan mata.', NOW(), NOW()),
(4, 'Rumah Tangga', 'rumah-tangga', 'Pencahayaan meja belajar dan perlengkapan seduh harian.', NOW(), NOW());

INSERT IGNORE INTO `products` (`id`, `category_id`, `sku`, `name`, `slug`, `price`, `original_price`, `stock`, `status`, `short_desc`, `description`, `featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'SE-EL-101', 'Headphone Bluetooth Studio', 'headphone-bluetooth-studio', 549000, 699000, 18, 'tersedia', 'Driver 40mm akurat dengan Active Noise Cancelling dan baterai 36 jam.', 'Dirancang untuk fokus belajar dan panggilan kerja jernih dengan memory foam nyaman.', 1, NOW(), NOW()),
(2, 1, 'SE-EL-102', 'Smartwatch FitPro AMOLED', 'smartwatch-fitpro-amoled', 785000, 920000, 4, 'tersedia', 'Layar AMOLED 1.43 inci selalu aktif dengan pelacakan detak jantung dan GPS.', 'Jam pintar ringan dengan bingkai aluminium matte, ketahanan air 5 ATM, dan baterai 12 hari.', 1, NOW(), NOW()),
(3, 1, 'SE-EL-103', 'Keyboard Mekanikal Nirkabel', 'keyboard-mekanikal-nirkabel', 695000, 790000, 11, 'tersedia', 'Tata letak ringkas 75% hot-swappable dengan switch tactile senyap.', 'Tiga mode koneksi (USB-C, 2.4GHz, Bluetooth) dan keycaps PBT anti-kilap.', 0, NOW(), NOW()),
(4, 1, 'SE-EL-104', 'Speaker Portabel Nordic', 'speaker-portabel-nordic', 415000, NULL, 9, 'tersedia', 'Speaker meja berlapis kain tenun akustik dengan suara 360 derajat.', 'Vokal jernih dan bass seimbang untuk ruang kerja atau kamar tidur.', 0, NOW(), NOW()),
(5, 1, 'SE-EL-105', 'Stand Laptop Aluminium Lipat', 'stand-laptop-aluminium-lipat', 235000, 280000, 2, 'tersedia', 'Penyangga laptop ergonomis dengan 6 tingkat kemiringan.', 'Material aluminium anodisasi kokoh menahan laptop 11 hingga 16 inci.', 0, NOW(), NOW()),
(6, 2, 'SE-FS-201', 'Sepatu Sneakers Urban', 'sepatu-sneakers-urban', 429000, 520000, 16, 'tersedia', 'Sneakers berpotongan rendah dengan sol EVA responsif dan kanvas premium.', 'Nyaman untuk mobilitas tinggi di kampus dengan insole ortopedi yang dapat dicuci.', 1, NOW(), NOW()),
(7, 2, 'SE-FS-202', 'Jaket Windbreaker Pine', 'jaket-windbreaker-pine', 365000, 430000, 3, 'tersedia', 'Jaket tahan angin dan gerimis berbahan nilon ripstop ringan.', 'Ritsleting tahan air, ventilasi punggung, dan kantong lipat ringkas.', 0, NOW(), NOW()),
(8, 2, 'SE-FS-203', 'Kemeja Linen Harian', 'kemeja-linen-harian', 249000, NULL, 21, 'tersedia', 'Campuran katun-linen sejuk dengan potongan santai yang tetap rapi.', 'Sirkulasi udara optimal untuk iklim tropis sepanjang hari.', 0, NOW(), NOW()),
(9, 2, 'SE-FS-204', 'Kaos Polo Pique Katun', 'kaos-polo-pique-katun', 195000, NULL, 15, 'tersedia', 'Kaos berkerah bahan katun pique 200gsm yang lembut dan menyerap keringat.', 'Cocok untuk kegiatan kuliah maupun acara semi-formal.', 0, NOW(), NOW()),
(10, 3, 'SE-AK-301', 'Tas Ransel Commuter 22L', 'tas-ransel-commuter', 389000, 450000, 14, 'tersedia', 'Kompartemen laptop 16 inci berlapis busa dengan tali dada ergonomis.', 'Kapasitas 22L berbahan Cordura 600D tahan cipratan air.', 1, NOW(), NOW()),
(11, 3, 'SE-AK-302', 'Dompet Kulit Minimalis', 'dompet-kulit-minimalis', 185000, NULL, 25, 'tersedia', 'Profil tipis 6 slot kartu dengan pelindung pemindaian RFID.', 'Kulit sapi full-grain bertekstur halus.', 0, NOW(), NOW()),
(12, 3, 'SE-AK-303', 'Kacamata Antiradiasi Layar', 'kacamata-antiradiasi', 215000, 260000, 0, 'tidak_tersedia', 'Frame TR90 lentur dengan lensa penyaring cahaya biru 40%.', 'Mengurangi ketegangan mata saat bekerja di depan monitor.', 0, NOW(), NOW()),
(13, 4, 'SE-RT-401', 'Lampu Meja Minimalis LED', 'lampu-meja-minimalis', 275000, 330000, 12, 'tersedia', 'Tiga suhu warna dengan kontrol sentuh bebas kedip (CRI >= 92).', 'Leher lampu aluminium lipat 180 derajat bertenaga USB-C.', 0, NOW(), NOW()),
(14, 4, 'SE-RT-402', 'Teko Leher Angsa Termometer', 'teko-leher-angsa', 310000, NULL, 7, 'tersedia', 'Kapasitas 800ml baja tahan karat 304 dengan aliran tuang presisi.', 'Kompatibel dengan kompor gas, listrik, maupun induksi.', 0, NOW(), NOW()),
(15, 4, 'SE-RT-403', 'Tumbler Termos 750ml', 'tumbler-termos-750ml', 165000, 195000, 0, 'tidak_tersedia', 'Insulasi vakum dua dinding menjaga minuman dingin hingga 18 jam.', 'Tutup anti-bocor dengan pegangan jinjing terintegrasi.', 0, NOW(), NOW());

INSERT IGNORE INTO `product_images` (`id`, `product_id`, `image_path`, `is_primary`, `sort_order`, `created_at`) VALUES
(1, 1, 'assets/images/products/headphone-bluetooth-studio.svg', 1, 1, NOW()),
(2, 2, 'assets/images/products/smartwatch-fitpro-amoled.svg', 1, 1, NOW()),
(3, 3, 'assets/images/products/keyboard-mekanikal-nirkabel.svg', 1, 1, NOW()),
(4, 4, 'assets/images/products/speaker-portabel-nordic.svg', 1, 1, NOW()),
(5, 5, 'assets/images/products/keyboard-mekanikal-nirkabel.svg', 1, 1, NOW()),
(6, 6, 'assets/images/products/sepatu-sneakers-urban.svg', 1, 1, NOW()),
(7, 7, 'assets/images/products/jaket-windbreaker-pine.svg', 1, 1, NOW()),
(8, 8, 'assets/images/products/kemeja-linen-harian.svg', 1, 1, NOW()),
(9, 9, 'assets/images/products/kemeja-linen-harian.svg', 1, 1, NOW()),
(10, 10, 'assets/images/products/tas-ransel-commuter.svg', 1, 1, NOW()),
(11, 11, 'assets/images/products/dompet-kulit-minimalis.svg', 1, 1, NOW()),
(12, 12, 'assets/images/products/kacamata-antiradiasi.svg', 1, 1, NOW()),
(13, 13, 'assets/images/products/lampu-meja-minimalis.svg', 1, 1, NOW()),
(14, 14, 'assets/images/products/teko-leher-angsa.svg', 1, 1, NOW()),
(15, 15, 'assets/images/products/teko-leher-angsa.svg', 1, 1, NOW());
