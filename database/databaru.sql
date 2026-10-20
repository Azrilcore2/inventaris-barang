-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2026 at 04:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_menubaru`
--

-- --------------------------------------------------------

--
-- Table structure for table `databaru`
--

CREATE TABLE `databaru` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `harga` decimal(12,2) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `status` enum('Tersedia','Habis','Terbatas') DEFAULT 'Tersedia',
  `tanggal_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `databaru`
--

INSERT INTO `databaru` (`id_barang`, `nama_barang`, `kategori`, `stok`, `harga`, `satuan`, `status`, `tanggal_masuk`) VALUES
(1, 'Laptop ASUS VivoBook', 'Elektronik', 15, 7500000.00, 'Unit', 'Tersedia', '2025-01-10'),
(2, 'Mouse Wireless Logitech', 'Elektronik', 50, 185000.00, 'Unit', 'Tersedia', '2025-01-12'),
(3, 'Keyboard Mechanical', 'Elektronik', 3, 450000.00, 'Unit', 'Terbatas', '2025-02-05'),
(4, 'Meja Belajar Kayu', 'Furnitur', 8, 1200000.00, 'Unit', 'Tersedia', '2025-02-18'),
(5, 'Kursi Ergonomis', 'Furnitur', 0, 2300000.00, 'Unit', 'Habis', '2025-03-01'),
(6, 'Buku Tulis A4 (Isi 50)', 'ATK', 200, 12000.00, 'Pak', 'Tersedia', '2025-03-10'),
(7, 'Pulpen Pilot G2', 'ATK', 150, 8500.00, 'Lusin', 'Tersedia', '2025-03-10'),
(8, 'Printer Canon IP2770', 'Elektronik', 4, 950000.00, 'Unit', 'Terbatas', '2025-04-02'),
(9, 'Tinta Printer Hitam', 'ATK', 30, 65000.00, 'Botol', 'Tersedia', '2025-04-05'),
(10, 'Lemari Arsip 2 Pintu', 'Furnitur', 2, 1850000.00, 'Unit', 'Terbatas', '2025-04-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `databaru`
--
ALTER TABLE `databaru`
  ADD PRIMARY KEY (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `databaru`
--
ALTER TABLE `databaru`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
