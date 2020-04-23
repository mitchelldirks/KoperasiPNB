-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2020 at 07:19 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi_pnb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `nik` char(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(40) NOT NULL,
  `gaji_perbulan` int(9) NOT NULL,
  `persentasi` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`nik`, `nama`, `alamat`, `pekerjaan`, `gaji_perbulan`, `persentasi`) VALUES
('0000000000000000', 'admin', '.', 'P001', 0, 0),
('0000000000000001', 'anggota', '.', 'P001', 0, 0),
('1111111111111111', 'Rizki Aevarlava', 'Fucek Buat Kalian Semua', 'P001', 0, 0),
('3232323232323211', 'Jamal', 'Bojong', 'P004', 400000, 50),
('3273050403980002', 'Regawa Rama Prayoga', 'Bandung', 'P001', 8000000, 20),
('3275021603980017', 'Mitchell Marcel', 'Nowhere', 'P001', 1500000, 100),
('3277010908980002', 'Ilham Gibran Achmad Mudzakir', 'Cimahi', 'P001', 8000000, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_angsuran`
--

CREATE TABLE `tbl_angsuran` (
  `id_angsuran` int(6) NOT NULL,
  `id_transaksi` int(6) NOT NULL,
  `harga_tambahan` int(11) NOT NULL,
  `dp` int(11) NOT NULL DEFAULT '0',
  `tgl_awal` date NOT NULL,
  `tgl_lunas` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_angsuran`
--

INSERT INTO `tbl_angsuran` (`id_angsuran`, `id_transaksi`, `harga_tambahan`, `dp`, `tgl_awal`, `tgl_lunas`) VALUES
(1, 1, 16500000, 2000000, '2017-12-31', '2018-12-31'),
(5, 5, 76675068, 0, '2020-04-20', '2021-04-20'),
(12, 12, 84000, 0, '2020-04-22', '2020-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` char(6) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kategori` char(4) DEFAULT NULL,
  `perkiraan_harga` int(9) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `spesifikasi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama`, `kategori`, `perkiraan_harga`, `gambar`, `spesifikasi`) VALUES
('B00001', 'Motor Honda', 'K002', 20000000, NULL, 'Speedforce Barry Allen'),
('B00002', 'sdasdas', 'K001', 12312, 'lenovo-laptop-yoga-920-feature-4.jpg', 'fsdfadsfsfsafasfsdfsadfdasfad'),
('B00003', 'Lenovo Yoga 920', 'K001', 14000000, 'lenovo-laptop-yoga-920-feature-4.jpg', '1.8GHz Intel Core i7-8550U (4GHz boost) 4 cores, 8 threads'),
('B00006', 'asd', 'K001', 11, 'nHBfsgABPwAAAAQAJKXB_gAAjFk.jpg', 'asd'),
('B00008', 'Antam Fine Gold 10gr', 'K004', 12999999, 'nHBfsgABPwAAAAQAJKXB_gAAjFk.jpg', 'Antam Emas Logam Mulia - 10gr'),
('B00010', 'Kaos Soccer Unsada 2018', '0', 80000, '30884553_162450217755228_5581445743593390080_n.jpg', 'Cotton combed 30s');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_angsuran`
--

CREATE TABLE `tbl_detail_angsuran` (
  `id_detail` int(9) NOT NULL,
  `id_angsuran` int(6) NOT NULL,
  `tgl_angsuran` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  `besar_angsuran` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_detail_angsuran`
--

INSERT INTO `tbl_detail_angsuran` (`id_detail`, `id_angsuran`, `tgl_angsuran`, `besar_angsuran`) VALUES
(1, 1, '2018-01-01 07:48:23.711748', 1400000),
(2, 1, '2020-04-19 23:07:53.508011', 1500000),
(3, 1, '2020-04-19 23:08:07.703823', 1600000),
(4, 5, '2020-04-20 02:19:10.162438', 7000000),
(5, 5, '2020-04-20 02:19:19.606978', 7000000),
(6, 12, '2020-04-22 13:17:39.923120', 28000),
(7, 12, '2020-04-22 13:17:46.815514', 28000),
(8, 12, '2020-04-22 13:17:53.013869', 28000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen`
--

CREATE TABLE `tbl_dokumen` (
  `nik` varchar(16) NOT NULL,
  `KTP` text NOT NULL,
  `KK` text NOT NULL,
  `Ijazah` text NOT NULL,
  `ATM` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dokumen`
--

INSERT INTO `tbl_dokumen` (`nik`, `KTP`, `KK`, `Ijazah`, `ATM`) VALUES
('1111111111111111', '1111111111111111WhatsApp Image 2019-06-09 at 23.15.04(1).jpeg', '1111111111111111WhatsApp Image 2019-11-26 at 7.33.50 AM.jpeg', '1111111111111111WhatsApp Image 2019-09-02 at 13.21.54.jpeg', '1111111111111111kotlin_800x320.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_barang`
--

CREATE TABLE `tbl_kategori_barang` (
  `id_kategori` char(4) NOT NULL,
  `kategori_barang` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori_barang`
--

INSERT INTO `tbl_kategori_barang` (`id_kategori`, `kategori_barang`) VALUES
('K001', 'Elektronik'),
('K002', 'Alat Transportasi'),
('K003', 'Usaha'),
('K004', 'Emas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pekerjaan`
--

CREATE TABLE `tbl_pekerjaan` (
  `id_pekerjaan` varchar(40) NOT NULL,
  `nama_pekerjaan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pekerjaan`
--

INSERT INTO `tbl_pekerjaan` (`id_pekerjaan`, `nama_pekerjaan`) VALUES
('P001', 'System Analyst'),
('P002', 'Kurir'),
('P003', 'Atlit'),
('P004', 'Buruh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengajuan`
--

CREATE TABLE `tbl_pengajuan` (
  `id_pengajuan` int(6) NOT NULL,
  `tgl_pengajuan` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  `pengaju` char(16) NOT NULL,
  `barang` char(6) NOT NULL,
  `peruntukan` text,
  `jml_angsur` int(2) DEFAULT '0',
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengajuan`
--

INSERT INTO `tbl_pengajuan` (`id_pengajuan`, `tgl_pengajuan`, `pengaju`, `barang`, `peruntukan`, `jml_angsur`, `status`) VALUES
(1, '2017-12-21 05:16:59.424191', '3273050403980002', 'B00002', 'sadasldjaslkdjaslk', 12, 2),
(4, '2017-12-27 06:08:47.534435', '3273050403980002', 'B00003', 'Buat Main Minesweeper', 12, 3),
(14, '2020-04-20 01:38:48.753941', '3275021603980017', 'B00006', 'asd', 12, 2),
(21, '2020-04-20 02:07:34.260634', '3275021603980017', 'B00008', 'Investasi', 12, 3),
(22, '2020-04-21 12:52:24.039548', '1111111111111111', 'B00010', 'Sandang', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(6) NOT NULL,
  `tgl_transaksi` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `pengajuan` int(6) DEFAULT NULL,
  `harga_asli` int(11) NOT NULL,
  `banyak_angsuran` int(3) NOT NULL DEFAULT '1',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `tgl_transaksi`, `pengajuan`, `harga_asli`, `banyak_angsuran`, `status`) VALUES
(1, '2017-12-31 14:51:51.987178', 4, 15000000, 12, 0),
(5, '2020-04-20 02:18:15.437308', 21, 7698300, 12, 0),
(12, '2020-04-22 13:17:19.599957', 22, 80000, 3, 1);

--
-- Triggers `tbl_transaksi`
--
DELIMITER $$
CREATE TRIGGER `tr_transaksi_angsuran` AFTER INSERT ON `tbl_transaksi` FOR EACH ROW INSERT INTO tbl_angsuran(id_transaksi,harga_tambahan,dp,tgl_awal,tgl_lunas) 
       VALUES(NEW.id_transaksi,((0.1*NEW.harga_asli)+NEW.harga_asli+(0.05*NEW.harga_asli)),0,NEW.tgl_transaksi,DATE_ADD(NEW.tgl_transaksi,INTERVAL NEW.banyak_angsuran MONTH))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(9) NOT NULL,
  `username` char(16) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `hak_akses` enum('ADMIN','ANGGOTA') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `hak_akses`) VALUES
(1, '3277010908980002', 'cef4feb87eee46ac6d8b9afa342efcd2', 'ADMIN'),
(2, '3273050403980002', 'f020f1fe4770170f615d6732049cf1ec', 'ANGGOTA'),
(3, '0000000000000000', '21232f297a57a5a743894a0e4a801fc3', 'ADMIN'),
(4, '0000000000000001', 'dfb9e85bc0da607ff76e0559c62537e8', 'ANGGOTA'),
(5, '3275021603980017', 'd7b0cf33fd7b988fc80db053f66e2bcf', 'ANGGOTA'),
(8, '1111111111111111', '1111111111111111', 'ANGGOTA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`nik`) USING BTREE;

--
-- Indexes for table `tbl_angsuran`
--
ALTER TABLE `tbl_angsuran`
  ADD PRIMARY KEY (`id_angsuran`) USING BTREE;

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`) USING BTREE;

--
-- Indexes for table `tbl_detail_angsuran`
--
ALTER TABLE `tbl_detail_angsuran`
  ADD PRIMARY KEY (`id_detail`) USING BTREE;

--
-- Indexes for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tbl_kategori_barang`
--
ALTER TABLE `tbl_kategori_barang`
  ADD PRIMARY KEY (`id_kategori`) USING BTREE;

--
-- Indexes for table `tbl_pekerjaan`
--
ALTER TABLE `tbl_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`) USING BTREE;

--
-- Indexes for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`) USING BTREE;

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`) USING BTREE;

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_angsuran`
--
ALTER TABLE `tbl_angsuran`
  MODIFY `id_angsuran` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_detail_angsuran`
--
ALTER TABLE `tbl_detail_angsuran`
  MODIFY `id_detail` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  MODIFY `id_pengajuan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
