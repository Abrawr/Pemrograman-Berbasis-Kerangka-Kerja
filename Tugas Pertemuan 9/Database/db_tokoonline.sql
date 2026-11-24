-- Database untuk Latihan 2.2: Toko Online NusaMart
CREATE DATABASE IF NOT EXISTS `db_tokoonline`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `db_tokoonline`;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(80) NOT NULL,
  `slug` VARCHAR(90) NOT NULL,
  `description` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_cat_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT UNSIGNED NOT NULL,
  `sku` VARCHAR(40) NOT NULL,
  `name` VARCHAR(140) NOT NULL,
  `slug` VARCHAR(150) NOT NULL,
  `price` INT UNSIGNED NOT NULL,
  `stock` INT UNSIGNED NOT NULL DEFAULT 0,
  `image` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_prod_sku` (`sku`),
  UNIQUE KEY `uq_prod_slug` (`slug`),
  CONSTRAINT `fk_prod_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_code` VARCHAR(30) NOT NULL,
  `customer_name` VARCHAR(120) NOT NULL,
  `customer_email` VARCHAR(120) NOT NULL,
  `shipping_address` TEXT NOT NULL,
  `total_amount` INT UNSIGNED NOT NULL,
  `status` ENUM('Diproses','Dikirim','Selesai') NOT NULL DEFAULT 'Diproses',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_order_code` (`order_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` INT UNSIGNED NOT NULL,
  `product_id` INT UNSIGNED NOT NULL,
  `product_name` VARCHAR(140) NOT NULL,
  `price` INT UNSIGNED NOT NULL,
  `qty` INT UNSIGNED NOT NULL,
  `subtotal` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_oi_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_oi_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', 'elektronik', 'Perangkat kerja dan audio harian', NOW(), NOW()),
(2, 'Fashion', 'fashion', 'Pakaian dan perlengkapan gaya kasual', NOW(), NOW()),
(3, 'Aksesoris', 'aksesoris', 'Tas, dompet, dan pelengkap mobilitas', NOW(), NOW()),
(4, 'Buku & Alat Tulis', 'buku-alat-tulis', 'Perlengkapan belajar dan catatan kuliah', NOW(), NOW());

INSERT IGNORE INTO `products` (`id`, `category_id`, `sku`, `name`, `slug`, `price`, `stock`, `image`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'NM-EL-001', 'Headset Nirkabel Studio', 'headset-nirkabel-studio', 485000, 18, 'assets/images/produk-headset.svg', 'Headset nirkabel ringan dengan peredam bising pasif dan baterai hingga 28 jam.', 1, NOW(), NOW()),
(2, 1, 'NM-EL-002', 'Keyboard Mekanikal Ringkas 75%', 'keyboard-mekanikal-75', 690000, 12, 'assets/images/produk-keyboard.svg', 'Keyboard mekanikal tata letak 75% dengan switch senyap dan koneksi ganda.', 1, NOW(), NOW()),
(3, 2, 'NM-FS-001', 'Jaket Kanvas Kampus', 'jaket-kanvas-kampus', 325000, 22, 'assets/images/produk-jaket.svg', 'Jaket bahan katun kanvas tebal yang nyaman untuk aktivitas luar ruangan.', 1, NOW(), NOW()),
(4, 2, 'NM-FS-002', 'Sepatu Kanvas Harian', 'sepatu-kanvas-harian', 295000, 14, 'assets/images/produk-sepatu.svg', 'Sepatu kanvas sol karet fleksibel untuk penggunaan kuliah dan harian.', 1, NOW(), NOW()),
(5, 3, 'NM-AK-001', 'Tas Laptop Anti Air 15 Inci', 'tas-laptop-anti-air', 265000, 25, 'assets/images/produk-tas.svg', 'Ransel kompartemen empuk dengan lapisan tahan cipratan air.', 1, NOW(), NOW()),
(6, 3, 'NM-AK-002', 'Tumbler Stainless 600ml', 'tumbler-stainless-600ml', 145000, 30, 'assets/images/produk-tumbler.svg', 'Botol minum insulasi vakum dua dinding menjaga suhu hingga 12 jam.', 1, NOW(), NOW()),
(7, 4, 'NM-BK-001', 'Buku Catatan Grid A5 Hardcover', 'buku-catatan-grid-a5', 68000, 40, 'assets/images/produk-buku.svg', 'Buku catatan kertas 100gsm ramah tinta pena dengan sampul keras.', 1, NOW(), NOW()),
(8, 4, 'NM-BK-002', 'Paket Pena Teknikal 0.5mm', 'paket-pena-teknikal', 52000, 35, 'assets/images/produk-pena.svg', 'Set 4 pena gel tinta pigmen cepat kering untuk catatan dan sketsa.', 1, NOW(), NOW());
