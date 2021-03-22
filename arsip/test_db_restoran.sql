-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2020 at 11:16 PM
-- Server version: 5.7.31-log
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rajafana_manpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `nama_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username_admin`, `password_admin`) VALUES
(9, 'admin7', 'admin7', '$2y$10$xbBrR/ngQTO5j7mU8Hfvg.y0PXqv2bsy6CnUh0pKPufyBeB7RNHyi');

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` bigint(20) UNSIGNED NOT NULL,
  `nama_kasir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_kasir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_kasir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `nama_kasir`, `username_kasir`, `password_kasir`) VALUES
(1, 'kasir3', 'kasir3', '$2y$10$ZWxIdSTqTNRB7Kw2h0bUzOOEbWhObEm3lyoAMTrivRWY3cnIChGU2'),
(2, 'kasir4', 'kasir4', '$2y$10$7oo57CpvpV0pPXwWuelEf.XTjDEhgYV6pQ4/nxgjEq7VsyT.M4Uxm');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_session` varchar(300) NOT NULL,
  `cek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_menu`, `jumlah`, `id_session`, `cek`) VALUES
(411, 8, 2, 'WnrY9yxooRMcuDXCqKfzJIqt4KV7pSqUgjdxtDUE', 1),
(412, 9, 2, 'WnrY9yxooRMcuDXCqKfzJIqt4KV7pSqUgjdxtDUE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_menu` set('makanan','minuman','','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `jenis_menu`, `deskripsi`, `gambar`, `harga_menu`, `jumlah_stok`) VALUES
(8, 'Sate ayam', 'makanan', 'Sate Ayam pilihan dengan bumbu racik khas jawa', 'Sate Ayam.jpg', 25000, 3),
(9, 'Sate Kambing', 'makanan', 'Sate Kambing dengan pilihan daging berkualitas', 'Sate Kambing.jpg', 28000, 8),
(10, 'Gule Daging Kambing', 'makanan', 'Perpaduan Kuah dan daging pilihan dengan racikan rempah-rempah jawa', 'Gule Daging Kambing.jpg', 30000, 5),
(11, 'Tongseng Daging Kambing', 'makanan', 'Tongseng Daging Kambing', 'Tongseng Daging Kambing.jpg', 30000, 10),
(12, 'Nasi Putih', 'makanan', 'Nasi putih yang dimasak menggunakan beras pilihan', 'Nasi Putih.jpg', 5000, 8),
(13, 'Ayam Kremes', 'makanan', 'Ayam Kremes dengan kriuk renyah', 'Ayam Kremes.jpg', 27000, 10),
(14, 'Nasi Kebuli Ayam', 'makanan', 'perpaduan Nasi Kebuli dengan ayam pilihan', 'Nasi Kebuli Ayam.jpg', 25000, 10),
(15, 'Nasi Ayam Bakar', 'makanan', 'Ayam yang dibakar hingga bumbu meresap ketulang', 'Nasi Ayam Bakar.jpg', 19000, 10),
(16, 'Sate Klatak Kambing', 'makanan', 'Sate dengan daging kambing muda', 'Sate Klatak Kambing.jpg', 30000, 10),
(17, 'Kebab', 'makanan', 'Kebab dengan isian melimpah', 'Kebab.jpg', 15000, 10),
(18, 'Es Jeruk', 'minuman', 'Kesegaran jeruk pilihan', 'Es Jeruk.jpg', 8000, 7),
(19, 'Jus Alpukat', 'minuman', 'Alpukat pilihan dari petani Indonesia', 'Jus Alpukat.jpg', 15000, 10),
(20, 'Jus Semangka', 'minuman', 'Manisnya buah semangka', 'Jus Semangka.jpg', 15000, 7),
(21, 'Nasi Kuning', 'makanan', 'Aroma Nasi Kuning yang nikmat beserta lauk yang nikmat', 'Nasi Kuning.jpg', 26000, 15),
(28, 'Ayam geprek', 'makanan', 'Ayam geprek', 'Ayam_geprek.png', 25000, 15);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_session` varchar(300) NOT NULL,
  `nama_customer` varchar(30) NOT NULL,
  `nomer_meja` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `uang_bayar` int(11) NOT NULL,
  `uang_kembali` int(11) NOT NULL,
  `status_transaksi` set('selesai','pending','','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_session`, `nama_customer`, `nomer_meja`, `tanggal`, `total_harga`, `uang_bayar`, `uang_kembali`, `status_transaksi`) VALUES
(52, 'WnrY9yxooRMcuDXCqKfzJIqt4KV7pSqUgjdxtDUE', 'Yayak', 1, '2020-12-24', 94800, 100000, 5200, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nama_promo` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `jumlah_promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `id_menu`, `nama_promo`, `deskripsi`, `start`, `end`, `jumlah_promo`) VALUES
(7, 8, 'Sate 10%', 'dison sate 10%', '2020-12-15', '2020-12-17', 10),
(8, 9, 'Promo Sate Kambing 20%', 'promo 20%', '2020-12-22', '2020-12-30', 20),
(12, 28, 'Promo setengah harga', 'Ayam geprek', '2020-12-22', '2020-12-24', 20);

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `id_ratingreview` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(128) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`id_ratingreview`, `rating`, `review`, `id_menu`) VALUES
(1, 3, 'jozz', 5),
(2, 5, 'aseq', 5),
(3, 4, 'juus', 4),
(4, 5, 'kozz', 4),
(5, 5, 'asek', 4),
(6, 5, 'jozzz', 4),
(7, 5, 'asek', 6),
(8, 5, 'mantap', 9),
(9, 5, 'ases', 8),
(10, 5, 'asek', 8),
(11, 5, 'Mantap Jiwa', 10),
(12, 3, 'Enak', 8),
(13, 5, 'Sip', 19),
(14, 5, 'cok wenak', 8),
(15, 4, 'Satenya mantul', 8),
(16, 5, 'mantap gan', 14),
(17, 3, 'kurang mateng dagingnya, bumbu kacang mantap', 8),
(18, 5, 'nasi biasa', 12),
(19, 5, 'Good', 8),
(20, 5, 'Nice', 20),
(21, 5, 'Mantap', 8),
(22, 5, 'Rasanya mantap', 9),
(23, 3, 'Seperti tongseng', 11),
(24, 4, 'lezatt', 9),
(25, 5, 'mantap abiz', 8),
(26, 5, 'mantap', 9),
(27, 5, 'enak banget coy', 10),
(28, 5, 'Mantab gan', 8),
(29, 3, 'Enak pokoke', 9),
(30, 5, 'sip', 11),
(31, 5, 'bumbunya mantap', 8),
(32, 5, 'yesh', 10),
(33, 5, 'Mantap gan', 8),
(34, 5, 'Rasanya maknyusss', 9),
(35, 5, 'dagingnya berasa bangett, rekom banget', 11),
(36, 5, 'Manisnya pas', 18),
(37, 5, 'mantap pak', 10),
(38, 5, 'nasinya pulen, wangi lagi', 12),
(39, 5, 'rasanya pas, gk terlalu gosong atau terlalu mentah', 15),
(40, 5, 'jusnya enak, sukak banget', 20),
(41, 5, 'yesh', 8),
(42, 5, 'Customer dapat memberi ulasan di sini.', 8),
(43, 5, 'manntap', 8),
(44, 5, 'daginnya mantap', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`id_ratingreview`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=413;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `id_ratingreview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
