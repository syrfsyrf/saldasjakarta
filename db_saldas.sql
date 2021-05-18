-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 11:24 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_saldas`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti_pembayaran`
--

CREATE TABLE `bukti_pembayaran` (
  `id` int(11) NOT NULL,
  `id_pesanan` varchar(11) NOT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  `approve_bukti_pembayaran` varchar(1) DEFAULT NULL COMMENT '1 = diapprove 0 = ditolak',
  `approve_by` varchar(11) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `jenis` varchar(1) DEFAULT NULL,
  `aksi` varchar(6) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL COMMENT '1 = aktif 0 = non aktif',
  `catatan` text,
  `id_user` varchar(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategori`
--

CREATE TABLE `mst_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kategori`
--

INSERT INTO `mst_kategori` (`id`, `nama`, `jenis`) VALUES
(1, 'DAGING SAPI IMPORT AUSTRALIA', 'DAGING SAPI');

-- --------------------------------------------------------

--
-- Table structure for table `mst_log`
--

CREATE TABLE `mst_log` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `tabel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mst_metode_pembayaran`
--

CREATE TABLE `mst_metode_pembayaran` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `metode` varchar(1) NOT NULL COMMENT '1 = online, 2 = offline'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_metode_pembayaran`
--

INSERT INTO `mst_metode_pembayaran` (`id`, `jenis`, `metode`) VALUES
(1, 'CASH', '2'),
(2, 'DEBIT BCA', '2'),
(3, 'DEBIT MANDIRI', '2'),
(4, 'TRANSFER BCA', '1'),
(5, 'TRANSFER MANDIRI', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mst_produk`
--

CREATE TABLE `mst_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kategori` varchar(11) NOT NULL,
  `deskripsi` text,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_produk`
--

INSERT INTO `mst_produk` (`id`, `nama`, `id_kategori`, `deskripsi`, `insert_date`, `created_by`) VALUES
(1, 'DAGING SAPI KEPALA', '1', NULL, '2021-03-25 20:31:28', '');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT 'saldasjkt',
  `role` varchar(1) NOT NULL COMMENT '1 = super user 2 = admin 3 = manager 4 = kasir 5 = pembeli',
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = non aktif',
  `aktivasi` varchar(1) NOT NULL DEFAULT '0' COMMENT '1 = aktif 0 = non aktif',
  `insert_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_user` varchar(11) DEFAULT NULL,
  `metode_pembayaran` varchar(11) DEFAULT '0',
  `tgl_pembayaran` date DEFAULT NULL,
  `tgl_expired_pembayaran` datetime DEFAULT NULL,
  `total` int(11) DEFAULT '0',
  `status` varchar(1) NOT NULL DEFAULT '0' COMMENT '1 = lunas 0 = belum lunas',
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` int(11) NOT NULL,
  `id_pesanan` varchar(11) NOT NULL,
  `id_produk` varchar(11) NOT NULL,
  `id_stock` varchar(11) NOT NULL,
  `kuantitas` int(11) NOT NULL DEFAULT '0',
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `id_produk` varchar(11) NOT NULL,
  `jumlah_stok` int(11) DEFAULT NULL,
  `harga` varchar(11) DEFAULT NULL,
  `tgl_expired` date DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = non aktif',
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_log`
--
ALTER TABLE `mst_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_metode_pembayaran`
--
ALTER TABLE `mst_metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_produk`
--
ALTER TABLE `mst_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_log`
--
ALTER TABLE `mst_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_metode_pembayaran`
--
ALTER TABLE `mst_metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_produk`
--
ALTER TABLE `mst_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
