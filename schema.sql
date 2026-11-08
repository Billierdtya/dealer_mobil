CREATE DATABASE IF NOT EXISTS `dealer_mobil_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `dealer_mobil_db`;

-- 1. Tabel Users & RBAC (Role: admin, sales, owner, user)
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `no_telepon` VARCHAR(50) DEFAULT NULL,
  `role` ENUM('admin', 'sales', 'owner', 'user') NOT NULL DEFAULT 'user',
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. Tabel Kategori Brand
CREATE TABLE IF NOT EXISTS `kategori_brand` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_brand` VARCHAR(100) NOT NULL,
  `logo` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Tabel Mobil (Inventory)
CREATE TABLE IF NOT EXISTS `mobil` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kategori_id` INT NOT NULL,
  `brand` VARCHAR(100) NOT NULL,
  `model` VARCHAR(100) NOT NULL,
  `tahun` INT NOT NULL,
  `harga_otr` BIGINT NOT NULL,
  `spesifikasi` TEXT DEFAULT NULL,
  `deskripsi` TEXT DEFAULT NULL,
  `stok` INT DEFAULT 1,
  `gambar_utama` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`kategori_id`) REFERENCES `kategori_brand`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. Tabel Galeri Mobil
CREATE TABLE IF NOT EXISTS `galeri_mobil` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `mobil_id` INT NOT NULL,
  `url_gambar` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`mobil_id`) REFERENCES `mobil`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 5. Tabel Prospek Customer (Sales Pipeline)
CREATE TABLE IF NOT EXISTS `sales_prospects` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_prospek` VARCHAR(100) NOT NULL,
  `kontak` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `mobil_id` INT DEFAULT NULL,
  `status` ENUM('baru', 'dihubungi', 'test_drive', 'negosiasi', 'closed_won', 'closed_lost') DEFAULT 'baru',
  `sales_id` INT DEFAULT NULL,
  `sales_nama` VARCHAR(100) DEFAULT NULL,
  `estimasi_nominal` BIGINT DEFAULT 0,
  `catatan` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`mobil_id`) REFERENCES `mobil`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`sales_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 6. Tabel Transaksi Penjualan Unit
CREATE TABLE IF NOT EXISTS `sales_transactions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nomor_transaksi` VARCHAR(50) NOT NULL UNIQUE,
  `prospek_id` INT DEFAULT NULL,
  `customer_nama` VARCHAR(100) NOT NULL,
  `customer_kontak` VARCHAR(50) NOT NULL,
  `customer_email` VARCHAR(100) DEFAULT NULL,
  `mobil_id` INT NOT NULL,
  `mobil_nama` VARCHAR(150) NOT NULL,
  `sales_id` INT DEFAULT NULL,
  `sales_nama` VARCHAR(100) NOT NULL,
  `harga_kesepakatan` BIGINT NOT NULL,
  `metode_pembayaran` ENUM('cash', 'kredit') DEFAULT 'cash',
  `down_payment` BIGINT DEFAULT 0,
  `tenor_bulan` INT DEFAULT 0,
  `cicilan_bulanan` BIGINT DEFAULT 0,
  `status` ENUM('pending', 'approved', 'completed', 'cancelled') DEFAULT 'pending',
  `tanggal_transaksi` DATE NOT NULL,
  `catatan` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`prospek_id`) REFERENCES `sales_prospects`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`mobil_id`) REFERENCES `mobil`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`sales_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 7. Tabel Booking & Manajemen Servis (Ganti Oli, Tune Up, Servis Umum, dll.)
CREATE TABLE IF NOT EXISTS `service_bookings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `booking_kode` VARCHAR(50) NOT NULL UNIQUE,
  `user_id` INT DEFAULT NULL,
  `nama_customer` VARCHAR(100) NOT NULL,
  `kontak` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `kendaraan_model` VARCHAR(150) NOT NULL,
  `nomor_polisi` VARCHAR(20) NOT NULL,
  `jenis_servis` ENUM('ganti_oli', 'tune_up', 'servis_umum', 'perbaikan_rem', 'servis_ac', 'kelistrikan', 'lainnya') NOT NULL,
  `tanggal_servis` DATE NOT NULL,
  `jam_servis` VARCHAR(20) NOT NULL,
  `keluhan` TEXT DEFAULT NULL,
  `status` ENUM('pending', 'dikonfirmasi', 'in_progress', 'selesai', 'dibatalkan') DEFAULT 'pending',
  `mekanik_nama` VARCHAR(100) DEFAULT NULL,
  `biaya_jasa` BIGINT DEFAULT 0,
  `biaya_sparepart` BIGINT DEFAULT 0,
  `total_biaya` BIGINT DEFAULT 0,
  `rincian_sparepart` TEXT DEFAULT NULL,
  `catatan_teknisi` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `completed_at` DATETIME DEFAULT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 8. Tabel Booking Test Drive
CREATE TABLE IF NOT EXISTS `booking_test_drive` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `booking_kode` VARCHAR(50) DEFAULT NULL,
  `mobil_id` INT NOT NULL,
  `nama_pemesan` VARCHAR(100) NOT NULL,
  `kontak` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `tanggal` DATE NOT NULL,
  `jam` TIME NOT NULL,
  `status` ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`mobil_id`) REFERENCES `mobil`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 9. Tabel Reservasi VIP
CREATE TABLE IF NOT EXISTS `reservasi_vip` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `vip_kode` VARCHAR(50) DEFAULT NULL,
  `nama` VARCHAR(100) NOT NULL,
  `kontak` VARCHAR(50) NOT NULL,
  `mobil_id` INT DEFAULT NULL,
  `catatan` TEXT DEFAULT NULL,
  `status` ENUM('pending', 'contacted', 'closed') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`mobil_id`) REFERENCES `mobil`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 10. Tabel Pengajuan Asuransi
CREATE TABLE IF NOT EXISTS `pengajuan_asuransi` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nomor_polis` VARCHAR(50) NOT NULL UNIQUE,
  `mobil_id` INT NOT NULL,
  `tipe_coverage` ENUM('comprehensive', 'tlo') DEFAULT 'comprehensive',
  `addons` TEXT DEFAULT NULL,
  `harga_kendaraan` BIGINT NOT NULL,
  `premi_tahunan` BIGINT NOT NULL,
  `durasi_tahun` INT DEFAULT 1,
  `total_premi` BIGINT NOT NULL,
  `nama_pemohon` VARCHAR(100) NOT NULL,
  `no_telepon` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `no_ktp` VARCHAR(20) NOT NULL,
  `alamat` TEXT NOT NULL,
  `catatan` TEXT DEFAULT NULL,
  `status` ENUM('pending', 'survey', 'approved', 'rejected') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`mobil_id`) REFERENCES `mobil`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 11. Tabel Titip Jual (Sell Your Car / Konsinyasi)
CREATE TABLE IF NOT EXISTS `titip_jual` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `listing_kode` VARCHAR(50) NOT NULL UNIQUE,
  `brand` VARCHAR(100) NOT NULL,
  `model` VARCHAR(100) NOT NULL,
  `tahun` INT NOT NULL,
  `mileage` VARCHAR(50) DEFAULT NULL,
  `warna` VARCHAR(50) DEFAULT NULL,
  `asking_price` BIGINT NOT NULL,
  `kondisi` VARCHAR(50) DEFAULT 'excellent',
  `deskripsi` TEXT DEFAULT NULL,
  `nama_pemilik` VARCHAR(100) NOT NULL,
  `telepon_pemilik` VARCHAR(50) NOT NULL,
  `email_pemilik` VARCHAR(100) NOT NULL,
  `status` ENUM('under_review', 'approved', 'sold', 'rejected', 'cancelled') DEFAULT 'under_review',
  `catatan_kurasi` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 12. Tabel Pesan Kontak & Konsultasi (Contact Us)
CREATE TABLE IF NOT EXISTS `pesan_kontak` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `ticket_kode` VARCHAR(50) NOT NULL UNIQUE,
  `subjek` VARCHAR(100) NOT NULL,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telepon` VARCHAR(50) DEFAULT NULL,
  `pesan` TEXT NOT NULL,
  `status` ENUM('open', 'replied', 'resolved') DEFAULT 'open',
  `balasan` TEXT DEFAULT NULL,
  `replied_at` DATETIME DEFAULT NULL,
  `replied_by` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 13. Seed Data Users Default (4 Role: Admin, Sales, Owner, User)
INSERT INTO `users` (`id`, `nama`, `email`, `password`, `no_telepon`, `role`) VALUES
(1, 'Super Admin (Billie)', 'admin@luxury.com', 'admin123', '081199887766', 'admin'),
(2, 'Arya Pratama (Sales Rep)', 'sales@luxury.com', 'sales123', '081234567890', 'sales'),
(3, 'Dra. Hendra Wijaya (Owner)', 'owner@luxury.com', 'owner123', '081398765432', 'owner'),
(4, 'Budi Santoso (Customer)', 'user@luxury.com', 'user123', '081299887766', 'user')
ON DUPLICATE KEY UPDATE `role` = VALUES(`role`);
