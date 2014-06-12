-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2014 at 05:25 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aplikasi_garment`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

DROP TABLE IF EXISTS `jenis_barang`;
CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT,
  `barang` varchar(50) NOT NULL,
  `qty_per_kg` int(5) NOT NULL,
  `harga_jasa` int(10) NOT NULL,
  PRIMARY KEY (`id_jenis_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis_barang`, `barang`, `qty_per_kg`, `harga_jasa`) VALUES
(1, 'T-Shirt', 4, 19000),
(2, 'Celana Pendek', 4, 20000),
(3, 'Celana Panjang', 2, 30000),
(4, 'Jaket', 1, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_warna`
--

DROP TABLE IF EXISTS `jenis_warna`;
CREATE TABLE IF NOT EXISTS `jenis_warna` (
  `id_jenis_warna` int(11) NOT NULL AUTO_INCREMENT,
  `id_kain` int(11) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `harga` int(10) NOT NULL,
  PRIMARY KEY (`id_jenis_warna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jenis_warna`
--

INSERT INTO `jenis_warna` (`id_jenis_warna`, `id_kain`, `warna`, `harga`) VALUES
(1, 1, 'Kuning Muda', 35000),
(2, 1, 'Cream Tua', 36000),
(3, 1, 'Abu', 35000),
(4, 2, 'Merah Bata', 42000),
(5, 2, 'Navy', 45500),
(6, 2, 'Putih', 38500),
(7, 6, 'Benhur', 27000),
(8, 2, 'Tosca', 27000),
(9, 9, 'Hitam', 27000),
(10, 4, 'Cream Tua', 52500);

-- --------------------------------------------------------

--
-- Table structure for table `kains`
--

DROP TABLE IF EXISTS `kains`;
CREATE TABLE IF NOT EXISTS `kains` (
  `id_kain` int(11) NOT NULL AUTO_INCREMENT,
  `kain` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kain`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `kains`
--

INSERT INTO `kains` (`id_kain`, `kain`) VALUES
(1, 'AK'),
(2, 'BK'),
(4, 'BL-1'),
(5, 'BABY TERRY'),
(6, 'DF'),
(7, 'DL'),
(9, 'DK'),
(10, 'DM'),
(11, 'DN'),
(12, 'DR'),
(13, 'FE');

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

DROP TABLE IF EXISTS `produksi`;
CREATE TABLE IF NOT EXISTS `produksi` (
  `id_produksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_produksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `id_jenis_barang`, `nama`, `status`, `tanggal_pemesanan`, `tanggal_selesai`, `deskripsi`, `gambar`) VALUES
(1, 1, 'Rizky Alvio Leegia', 4, '2014-06-04', '2014-07-10', 'Deskripsi yang diedit', ''),
(2, 2, 'Riska Pratiwi', 5, '2014-06-13', '2014-06-25', 'Blablablabal', ''),
(4, 4, 'Good', 6, '1223-01-11', '2014-06-19', '123123', '20140612085556-94873f36a9f311e38fe1128d0b3617b7_8.jpg'),
(5, 2, 'Desta Vincent', 1, '2014-06-12', '2014-06-19', 'Deskripsi singkat aja', '20140612162250-6797ab0eff0403.png');

-- --------------------------------------------------------

--
-- Table structure for table `produksi_keterangan`
--

DROP TABLE IF EXISTS `produksi_keterangan`;
CREATE TABLE IF NOT EXISTS `produksi_keterangan` (
  `id_produksi_keterangan` int(11) NOT NULL AUTO_INCREMENT,
  `id_produksi` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(200) NOT NULL,
  PRIMARY KEY (`id_produksi_keterangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `produksi_size`
--

DROP TABLE IF EXISTS `produksi_size`;
CREATE TABLE IF NOT EXISTS `produksi_size` (
  `id_produksi_size` int(11) NOT NULL AUTO_INCREMENT,
  `id_produksi` int(11) NOT NULL,
  `id_size` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_produksi_size`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `produksi_size`
--

INSERT INTO `produksi_size` (`id_produksi_size`, `id_produksi`, `id_size`, `jumlah`) VALUES
(35, 1, 1, 4),
(36, 1, 2, 8),
(37, 1, 3, 16),
(38, 1, 4, 32),
(39, 1, 5, 2),
(44, 2, 3, 10),
(45, 2, 1, 5),
(48, 4, 3, 2),
(55, 5, 3, 3),
(56, 5, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `produksi_spesifikasi`
--

DROP TABLE IF EXISTS `produksi_spesifikasi`;
CREATE TABLE IF NOT EXISTS `produksi_spesifikasi` (
  `id_produksi_spesifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_produksi` int(11) NOT NULL,
  `id_spesifikasi` int(11) NOT NULL,
  `id_sub_spesifikasi` int(11) NOT NULL,
  PRIMARY KEY (`id_produksi_spesifikasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `produksi_spesifikasi`
--

INSERT INTO `produksi_spesifikasi` (`id_produksi_spesifikasi`, `id_produksi`, `id_spesifikasi`, `id_sub_spesifikasi`) VALUES
(11, 1, 4, 10),
(12, 1, 1, 2),
(13, 4, 1, 1),
(14, 5, 2, 4),
(15, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produksi_warna`
--

DROP TABLE IF EXISTS `produksi_warna`;
CREATE TABLE IF NOT EXISTS `produksi_warna` (
  `id_produksi_warna` int(11) NOT NULL AUTO_INCREMENT,
  `id_produksi` int(10) NOT NULL,
  `id_kain` int(10) NOT NULL,
  `id_jenis_warna` int(10) NOT NULL,
  `pemakaian` int(10) NOT NULL,
  PRIMARY KEY (`id_produksi_warna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `produksi_warna`
--

INSERT INTO `produksi_warna` (`id_produksi_warna`, `id_produksi`, `id_kain`, `id_jenis_warna`, `pemakaian`) VALUES
(22, 1, 2, 6, 25),
(23, 1, 1, 1, 50),
(24, 1, 9, 9, 25),
(32, 2, 1, 2, 0),
(33, 2, 1, 1, 0),
(34, 2, 2, 5, 0),
(35, 2, 4, 10, 0),
(38, 4, 1, 2, 100),
(48, 5, 1, 1, 25),
(49, 5, 2, 4, 25),
(50, 5, 6, 7, 50);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `id_size` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(50) NOT NULL,
  PRIMARY KEY (`id_size`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id_size`, `size`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XLL'),
(6, '28'),
(7, '30'),
(8, '32'),
(9, '34'),
(10, '36'),
(11, '38'),
(12, '40'),
(13, '44');

-- --------------------------------------------------------

--
-- Table structure for table `spesifikasis`
--

DROP TABLE IF EXISTS `spesifikasis`;
CREATE TABLE IF NOT EXISTS `spesifikasis` (
  `id_spesifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `spesifikasi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_spesifikasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `spesifikasis`
--

INSERT INTO `spesifikasis` (`id_spesifikasi`, `spesifikasi`) VALUES
(1, 'Logo'),
(2, 'Label'),
(3, 'Size'),
(4, 'Kancing Kait'),
(6, 'Kancing Plastik'),
(7, 'Elastic'),
(8, 'Hang Tag'),
(9, 'Resleting 7"'),
(10, 'Resleting 8"'),
(11, 'Wash Label'),
(12, 'Fiterbn'),
(13, 'Tali Cord'),
(14, 'Ujung Cord'),
(15, 'Karet Ping');

-- --------------------------------------------------------

--
-- Table structure for table `sub_spesifikasi`
--

DROP TABLE IF EXISTS `sub_spesifikasi`;
CREATE TABLE IF NOT EXISTS `sub_spesifikasi` (
  `id_sub_spesifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_spesifikasi` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id_sub_spesifikasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sub_spesifikasi`
--

INSERT INTO `sub_spesifikasi` (`id_sub_spesifikasi`, `id_spesifikasi`, `nama`, `harga`) VALUES
(1, 1, 'Bordir', 3000),
(2, 1, 'Sablon', 2500),
(3, 1, 'Tempel', 2000),
(4, 2, 'ATP Dasar Hitam', 900),
(5, 2, 'ATP Dasar Putih', 650),
(6, 2, 'Sportman', 400),
(7, 2, 'Niksel Kecil', 950),
(8, 3, 'S s/d 5L Dasar Putih', 120),
(9, 3, 'S s/d 5L Dasar Hitam', 100),
(10, 4, 'BNG Grafiran', 590);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`, `date_created`) VALUES
(1, 'Nova Stella ', 'superadmin', '123', 1, '2014-06-11'),
(2, 'Kim Taeyeon', 'ppc', '12345', 2, '2014-06-10'),
(5, 'Im Yoona', 'sales', '12345', 3, '2014-06-10'),
(6, 'Ji Suk Jin', 'penjualan', '123', 4, '2014-06-12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
