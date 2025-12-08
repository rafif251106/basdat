-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 02:00 AM
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
-- Database: `distribusi_bbm`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengiriman`
--
CREATE DATABASE distribusi_bbm;
USE distribusi_bbm;



CREATE TABLE `detail_pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_liter_produk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pengiriman`
--

INSERT INTO `detail_pengiriman` (`id_pengiriman`, `id_produk`, `jumlah_liter_produk`) VALUES
(1, 1, 8000),
(1, 2, 8000),
(2, 5, 16000),
(2, 6, 8000),
(3, 1, 16000),
(3, 3, 16000),
(4, 1, 8000),
(5, 2, 4000),
(5, 4, 4000),
(6, 5, 16000),
(7, 7, 12000),
(7, 8, 12000),
(8, 1, 8000),
(8, 2, 8000),
(9, 6, 32000),
(10, 1, 16000),
(10, 2, 16000),
(11, 1, 12000),
(11, 5, 12000),
(12, 2, 16000),
(13, 3, 8000),
(13, 4, 8000),
(13, 8, 8000),
(14, 1, 24000),
(15, 5, 16000),
(16, 2, 8000),
(17, 1, 16000),
(18, 5, 24000),
(19, 7, 16000),
(19, 8, 16000),
(20, 1, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `plat_nomor` varchar(15) DEFAULT NULL,
  `kapasitas_tangki` int(11) DEFAULT NULL,
  `status_kendaraan` enum('aktif','rusak','maintenance') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `plat_nomor`, `kapasitas_tangki`, `status_kendaraan`) VALUES
(1, 'B 9001 UYZ', 16000, 'aktif'),
(2, 'B 9002 UYZ', 24000, 'aktif'),
(3, 'B 9003 UYZ', 32000, 'aktif'),
(4, 'B 9004 UYZ', 16000, 'maintenance'),
(5, 'B 9005 UYZ', 8000, 'aktif'),
(6, 'D 8123 ABC', 16000, 'aktif'),
(7, 'D 8124 ABC', 24000, 'aktif'),
(8, 'D 8125 ABC', 16000, 'rusak'),
(9, 'H 1234 XY', 24000, 'aktif'),
(10, 'H 1235 XY', 32000, 'maintenance'),
(11, 'AB 4567 JK', 16000, 'aktif'),
(12, 'AB 4568 JK', 8000, 'aktif'),
(13, 'L 7890 MN', 32000, 'aktif'),
(14, 'L 7891 MN', 24000, 'aktif'),
(15, 'L 7892 MN', 16000, 'maintenance'),
(16, 'N 3456 OP', 16000, 'aktif'),
(17, 'BK 5678 QR', 24000, 'aktif'),
(18, 'BK 5679 QR', 32000, 'aktif'),
(19, 'DD 9012 ST', 16000, 'aktif'),
(20, 'DK 1122 UV', 8000, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `status_pengiriman` enum('terjadwal','perjalanan','selesai','dibatalkan') DEFAULT NULL,
  `id_terminal` int(11) DEFAULT NULL,
  `id_spbu` int(11) DEFAULT NULL,
  `id_kendaraan` int(11) DEFAULT NULL,
  `id_sopir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `tanggal_kirim`, `status_pengiriman`, `id_terminal`, `id_spbu`, `id_kendaraan`, `id_sopir`) VALUES
(1, '2023-10-01', 'selesai', 1, 1, 1, 1),
(2, '2023-10-02', 'selesai', 2, 2, 2, 2),
(3, '2023-10-02', 'selesai', 3, 3, 3, 3),
(4, '2023-10-03', 'selesai', 4, 4, 5, 4),
(5, '2023-10-03', 'dibatalkan', 1, 5, 6, 5),
(6, '2023-10-04', 'selesai', 5, 6, 7, 6),
(7, '2023-10-04', 'selesai', 6, 7, 9, 7),
(8, '2023-10-05', 'selesai', 7, 8, 11, 8),
(9, '2023-10-05', 'selesai', 8, 9, 12, 9),
(10, '2023-10-06', 'selesai', 9, 10, 13, 10),
(11, '2023-10-06', 'perjalanan', 10, 11, 14, 11),
(12, '2023-10-07', 'perjalanan', 11, 12, 16, 12),
(13, '2023-10-07', 'perjalanan', 12, 13, 17, 13),
(14, '2023-10-07', 'terjadwal', 13, 14, 18, 14),
(15, '2023-10-08', 'terjadwal', 14, 15, 19, 15),
(16, '2023-10-08', 'terjadwal', 15, 16, 20, 16),
(17, '2023-10-08', 'terjadwal', 16, 17, 1, 17),
(18, '2023-10-09', 'terjadwal', 17, 18, 2, 18),
(19, '2023-10-09', 'terjadwal', 18, 19, 3, 19),
(20, '2023-10-10', 'terjadwal', 19, 20, 5, 20);

-- --------------------------------------------------------

--
-- Table structure for table `produk_bbm`
--

CREATE TABLE `produk_bbm` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `jenis_bbm` enum('bensin','diesel') DEFAULT NULL,
  `harga_per_liter` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_bbm`
--

INSERT INTO `produk_bbm` (`id_produk`, `nama_produk`, `jenis_bbm`, `harga_per_liter`) VALUES
(1, 'Pertalite', 'bensin', 10000.00),
(2, 'Pertamax', 'bensin', 12950.00),
(3, 'Pertamax Turbo', 'bensin', 14400.00),
(4, 'Pertamax Racing', 'bensin', 45000.00),
(5, 'Solar', 'diesel', 6800.00),
(6, 'Bio Solar', 'diesel', 6800.00),
(7, 'Dexlite', 'diesel', 14550.00),
(8, 'Pertamina Dex', 'diesel', 15100.00);

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE `sopir` (
  `id_sopir` int(11) NOT NULL,
  `nama_sopir` varchar(100) DEFAULT NULL,
  `no_sim` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`id_sopir`, `nama_sopir`, `no_sim`, `no_hp`) VALUES
(1, 'Ahmad Subari', '123456789012', '081234567890'),
(2, 'Bambang Pamungkas', '234567890123', '081234567891'),
(3, 'Cecep Supriadi', '345678901234', '081234567892'),
(4, 'Dedi Mulyadi', '456789012345', '081234567893'),
(5, 'Edi Santoso', '567890123456', '081234567894'),
(6, 'Ferry Irawan', '678901234567', '081234567895'),
(7, 'Gunawan Sudrajat', '789012345678', '081234567896'),
(8, 'Hari Panca', '890123456789', '081234567897'),
(9, 'Iwan Fals', '901234567890', '081234567898'),
(10, 'Jajang Nurjaman', '012345678901', '081234567899'),
(11, 'Kurniawan Dwi', '112345678901', '081234567800'),
(12, 'Leo Saputra', '223456789012', '081234567801'),
(13, 'Maman Abdurrahman', '334567890123', '081234567802'),
(14, 'Nova Arianto', '445678901234', '081234567803'),
(15, 'Oki Setiana', '556789012345', '081234567804'),
(16, 'Ponaryo Astaman', '667890123456', '081234567805'),
(17, 'Qomarudin', '778901234567', '081234567806'),
(18, 'Rully Nere', '889012345678', '081234567807'),
(19, 'Supardi Nasir', '990123456789', '081234567808'),
(20, 'Tino Sidin', '001234567890', '081234567809');

-- --------------------------------------------------------

--
-- Table structure for table `spbu`
--

CREATE TABLE `spbu` (
  `id_spbu` int(11) NOT NULL,
  `nama_spbu` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spbu`
--

INSERT INTO `spbu` (`id_spbu`, `nama_spbu`, `alamat`, `kota`) VALUES
(1, 'SPBU 31.123.01', 'Jl. Jendral Sudirman No. 1', 'Jakarta Pusat'),
(2, 'SPBU 31.124.02', 'Jl. MH Thamrin No. 5', 'Jakarta Pusat'),
(3, 'SPBU 34.142.05', 'Jl. Raya Kelapa Gading', 'Jakarta Utara'),
(4, 'SPBU 34.117.09', 'Jl. Daan Mogot KM 12', 'Jakarta Barat'),
(5, 'SPBU 33.401.01', 'Jl. Ir. H. Juanda No. 88', 'Bandung'),
(6, 'SPBU 33.402.05', 'Jl. Soekarno Hatta No. 100', 'Bandung'),
(7, 'SPBU 44.501.01', 'Jl. Pemuda No. 45', 'Semarang'),
(8, 'SPBU 44.502.03', 'Jl. Majapahit No. 20', 'Semarang'),
(9, 'SPBU 44.551.01', 'Jl. Magelang KM 5', 'Yogyakarta'),
(10, 'SPBU 44.552.02', 'Jl. Solo KM 8', 'Yogyakarta'),
(11, 'SPBU 54.601.01', 'Jl. Raya Darmo No. 10', 'Surabaya'),
(12, 'SPBU 54.602.05', 'Jl. Ahmad Yani No. 50', 'Surabaya'),
(13, 'SPBU 54.651.01', 'Jl. Ijen Besar', 'Malang'),
(14, 'SPBU 54.652.03', 'Jl. Letjen Sutoyo', 'Malang'),
(15, 'SPBU 64.701.01', 'Jl. Gatot Subroto', 'Medan'),
(16, 'SPBU 64.702.05', 'Jl. Sisingamangaraja', 'Medan'),
(17, 'SPBU 74.901.01', 'Jl. Urip Sumoharjo', 'Makassar'),
(18, 'SPBU 74.902.02', 'Jl. AP Pettarani', 'Makassar'),
(19, 'SPBU 64.201.01', 'Jl. Sudirman', 'Palembang'),
(20, 'SPBU 84.101.01', 'Jl. Raya Kuta', 'Denpasar');

-- --------------------------------------------------------

--
-- Table structure for table `terminal`
--

CREATE TABLE `terminal` (
  `id_terminal` int(11) NOT NULL,
  `nama_terminal` varchar(100) DEFAULT NULL,
  `lokasi_terminal` varchar(100) DEFAULT NULL,
  `kapasitas_penyimpanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terminal`
--

INSERT INTO `terminal` (`id_terminal`, `nama_terminal`, `lokasi_terminal`, `kapasitas_penyimpanan`) VALUES
(1, 'Terminal BBM Plumpang', 'Jakarta Utara', 5000000),
(2, 'Terminal BBM Tanjung Gerem', 'Cilegon', 3000000),
(3, 'Terminal BBM Ujung Berung', 'Bandung', 2500000),
(4, 'Terminal BBM Padalarang', 'Bandung Barat', 2000000),
(5, 'Terminal BBM Balongan', 'Indramayu', 8000000),
(6, 'Terminal BBM Semarang Group', 'Semarang', 3500000),
(7, 'Terminal BBM Maos', 'Cilacap', 4000000),
(8, 'Terminal BBM Rewulu', 'Yogyakarta', 2800000),
(9, 'Terminal BBM Surabaya Group', 'Surabaya', 4500000),
(10, 'Terminal BBM Malang', 'Malang', 1500000),
(11, 'Terminal BBM Madiun', 'Madiun', 1200000),
(12, 'Terminal BBM Banyuwangi', 'Banyuwangi', 2200000),
(13, 'Terminal BBM Tuban', 'Tuban', 6000000),
(14, 'Terminal BBM Medan Group', 'Medan', 3800000),
(15, 'Terminal BBM Dumai', 'Dumai', 7000000),
(16, 'Terminal BBM Teluk Kabung', 'Padang', 2100000),
(17, 'Terminal BBM Kertapati', 'Palembang', 2900000),
(18, 'Terminal BBM Panjang', 'Lampung', 2600000),
(19, 'Terminal BBM Makassar', 'Makassar', 3100000),
(20, 'Terminal BBM Balikpapan', 'Balikpapan', 5500000),
(21, 'Terminal Baru', 'Jakarta Selatan', 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `level` enum('admin','operator') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin01', '482c811da5d5b4bc6d497ffa98491e38', 'Budi Santoso', 'admin'),
(2, 'admin02', '482c811da5d5b4bc6d497ffa98491e38', 'Siti Aminah', 'admin'),
(3, 'admin03', '482c811da5d5b4bc6d497ffa98491e38', 'Rahmat Hidayat', 'admin'),
(4, 'admin04', '482c811da5d5b4bc6d497ffa98491e38', 'Dewi Lestari', 'admin'),
(5, 'admin05', '482c811da5d5b4bc6d497ffa98491e38', 'Eko Prasetyo', 'admin'),
(6, 'op_jkt01', '1276f7ffe1197b27829a08e91c00e0a6', 'Fajar Nugraha', 'operator'),
(7, 'op_jkt02', '1276f7ffe1197b27829a08e91c00e0a6', 'Gita Gutawa', 'operator'),
(8, 'op_bdg01', '1276f7ffe1197b27829a08e91c00e0a6', 'Hendra Kurniawan', 'operator'),
(9, 'op_bdg02', '1276f7ffe1197b27829a08e91c00e0a6', 'Indah Permata', 'operator'),
(10, 'op_sby01', '1276f7ffe1197b27829a08e91c00e0a6', 'Joko Susilo', 'operator'),
(11, 'op_sby02', '1276f7ffe1197b27829a08e91c00e0a6', 'Kartika Sari', 'operator'),
(12, 'op_sem01', '1276f7ffe1197b27829a08e91c00e0a6', 'Lukman Hakim', 'operator'),
(13, 'op_sem02', '1276f7ffe1197b27829a08e91c00e0a6', 'Maya Wulandari', 'operator'),
(14, 'op_yog01', '1276f7ffe1197b27829a08e91c00e0a6', 'Nanang Suherman', 'operator'),
(15, 'op_yog02', '1276f7ffe1197b27829a08e91c00e0a6', 'Olivia Zalianty', 'operator'),
(16, 'op_bal01', '1276f7ffe1197b27829a08e91c00e0a6', 'Putu Gede', 'operator'),
(17, 'op_bal02', '1276f7ffe1197b27829a08e91c00e0a6', 'Qory Sandioriva', 'operator'),
(18, 'op_med01', '1276f7ffe1197b27829a08e91c00e0a6', 'Rizal Mantovani', 'operator'),
(19, 'op_med02', '1276f7ffe1197b27829a08e91c00e0a6', 'Siska Kohl', 'operator'),
(20, 'op_mks01', '1276f7ffe1197b27829a08e91c00e0a6', 'Taufik Hidayat', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`,`id_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_terminal` (`id_terminal`),
  ADD KEY `id_spbu` (`id_spbu`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `id_sopir` (`id_sopir`);

--
-- Indexes for table `produk_bbm`
--
ALTER TABLE `produk_bbm`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `sopir`
--
ALTER TABLE `sopir`
  ADD PRIMARY KEY (`id_sopir`);

--
-- Indexes for table `spbu`
--
ALTER TABLE `spbu`
  ADD PRIMARY KEY (`id_spbu`);

--
-- Indexes for table `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`id_terminal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `produk_bbm`
--
ALTER TABLE `produk_bbm`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sopir`
--
ALTER TABLE `sopir`
  MODIFY `id_sopir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `spbu`
--
ALTER TABLE `spbu`
  MODIFY `id_spbu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `terminal`
--
ALTER TABLE `terminal`
  MODIFY `id_terminal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  ADD CONSTRAINT `detail_pengiriman_ibfk_1` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`),
  ADD CONSTRAINT `detail_pengiriman_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk_bbm` (`id_produk`);

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`id_terminal`) REFERENCES `terminal` (`id_terminal`),
  ADD CONSTRAINT `pengiriman_ibfk_2` FOREIGN KEY (`id_spbu`) REFERENCES `spbu` (`id_spbu`),
  ADD CONSTRAINT `pengiriman_ibfk_3` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`),
  ADD CONSTRAINT `pengiriman_ibfk_4` FOREIGN KEY (`id_sopir`) REFERENCES `sopir` (`id_sopir`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
