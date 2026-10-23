-- Database portofolio Keyra Oktaviani
-- Impor lewat phpMyAdmin: buat database "portofolio_keyra" (utf8mb4_unicode_ci), pilih database itu, lalu Import file ini.
-- Atau langsung: mysql -u root < database/portfolio.sql

CREATE DATABASE IF NOT EXISTS `portofolio_keyra` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `portofolio_keyra`;

-- Akun admin (untuk membaca pesan kontak). Dibuat lewat admin/pasang.php, bukan di file ini.
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `kata_sandi` VARCHAR(255) NOT NULL,
  `dibuat` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pesan dari formulir kontak.
CREATE TABLE IF NOT EXISTS `pesan` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `subjek` VARCHAR(150) NOT NULL,
  `isi` TEXT NOT NULL,
  `ip` VARCHAR(45) DEFAULT NULL,
  `dibaca_pada` DATETIME DEFAULT NULL,
  `dibuat` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_dibaca` (`dibaca_pada`),
  KEY `idx_dibuat` (`dibuat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
