-- =========================================
-- Database: db_inventaris
-- Sistem Inventaris Barang
-- =========================================

CREATE DATABASE IF NOT EXISTS db_inventaris_uas;
USE db_inventaris_uas;

-- =========================================
-- Tabel: tbl_user
-- =========================================
CREATE TABLE IF NOT EXISTS tbl_user (
    id_user INT(11) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User default (password: admin123)
INSERT INTO tbl_user (nama, email, password_hash) VALUES
('Administrator', 'admin@inventaris.com', '$2y$10$1D02/nZ7hbMr9sHBYc.Kl./qZtKwxaqnqcAtOnrJk3udmzcornhUi');

-- =========================================
-- Tabel: tbl_barang
-- =========================================
CREATE TABLE IF NOT EXISTS tbl_barang (
    id_barang INT(11) NOT NULL AUTO_INCREMENT,
    nama_barang VARCHAR(150) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    jumlah INT(11) NOT NULL DEFAULT 0,
    lokasi VARCHAR(150) NOT NULL,
    tanggal_masuk DATE NOT NULL,
    PRIMARY KEY (id_barang)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data contoh
INSERT INTO tbl_barang (nama_barang, kategori, jumlah, lokasi, tanggal_masuk) VALUES
('Laptop Asus X441', 'Elektronik', 12, 'Gudang A', '2026-01-10'),
('Kursi Kantor', 'Furnitur', 30, 'Gudang B', '2026-02-15'),
('Printer Epson L3110', 'Elektronik', 8, 'Gudang A', '2026-03-05'),
('Meja Rapat', 'Furnitur', 5, 'Gudang C', '2026-04-20'),
('Proyektor Mini', 'Elektronik', 4, 'Gudang A', '2026-05-01');
