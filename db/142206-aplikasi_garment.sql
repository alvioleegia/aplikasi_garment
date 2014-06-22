-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2014 at 07:01 PM
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
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `id_produksi` int(11) NOT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `type` tinyint(4) NOT NULL,
  `nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_produksi`, `tanggal_waktu`, `type`, `nilai`) VALUES
(1, 4, '2014-06-13 01:39:57', 1, 23000),
(3, 4, '2014-06-13 02:00:20', 2, 172400),
(4, 6, '2014-06-13 10:42:57', 1, 20000),
(5, 12, '2014-06-22 16:26:01', 1, 125434);

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

DROP TABLE IF EXISTS `produksi`;
CREATE TABLE IF NOT EXISTS `produksi` (
  `id_produksi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produksi` varchar(10) NOT NULL,
  `id_jenis_barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_produksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `kode_produksi`, `id_jenis_barang`, `nama`, `alamat`, `no_tlp`, `status`, `tanggal_pemesanan`, `tanggal_selesai`, `deskripsi`, `gambar`) VALUES
(1, '', 1, 'Rizky Alvio Leegia', '', '', 5, '2014-06-04', '2014-07-10', 'Deskripsi yang diedit', '20140613105736-[2014-04-23] M-ON Live! SNSD Free Live At Yokohama FULL.ts_snapshot_00.57.12_[2014.04.26_21.57.56].jpg'),
(2, '', 2, 'Riska Pratiwi', '', '', 5, '2014-06-13', '2014-06-25', 'Blablablabal', ''),
(4, '', 4, 'Good', '', '', 6, '2014-01-13', '2014-06-19', '123123', '20140612193341-143199-girls-day-121117-minahs-selca.jpg'),
(5, '', 2, 'Desta Vincent', '', '', 3, '2014-06-12', '2014-06-19', 'Deskripsi singkat aja', '20140612162250-6797ab0eff0403.png'),
(6, '', 4, 'asdfasdf', '', '', 6, '2014-06-06', '2014-06-28', 'adsfasdf', '20140613093143-415b54b6c2c911e397aa0002c95588e8_8.jpg'),
(7, '', 2, '345234234', '', '', 2, '2014-06-14', '2014-06-27', '', '20140613100431-[mv]_apink_-_mr.chu_[www.k2nblog.com].mp4_snapshot_00.57_[2014.04.04_15.38.14].jpg'),
(8, '', 2, 'Moh Yuntiwa', '', '', 3, '2014-06-19', '2014-06-30', '', '20140619232054-Bg_PTgDCcAA70u-.jpg'),
(9, '', 2, 'asdf;lkadsf', '', '', 0, '2014-06-20', '2014-06-21', '', '20140619233445-2014-03-25 21.43.29.jpg'),
(10, 'CGS0010', 2, 'asdf;lkadsf', '', '', 0, '2014-06-20', '2014-06-21', '', '20140619233553-2014-03-25 21.43.29.jpg'),
(11, 'CGSJK0011', 4, 'ini hanya tes', '', '', 3, '2014-06-20', '2014-06-28', 'ini deskripsi', '20140619233655-Screenshot_31.jpg'),
(12, 'CGSCP0012', 2, 'Puji Rohati', 'Jl. Manapun lah bebas,\r\nBandung, 40135', '083821670646', 4, '2014-06-22', '2014-06-25', 'Deskripsi sementara', '20140622160930-94873f36a9f311e38fe1128d0b3617b7_8.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `produksi_size`
--

INSERT INTO `produksi_size` (`id_produksi_size`, `id_produksi`, `id_size`, `jumlah`) VALUES
(79, 5, 3, 3),
(80, 5, 4, 9),
(87, 4, 3, 2),
(91, 7, 13, 2),
(94, 6, 12, 5),
(95, 1, 1, 4),
(96, 1, 2, 8),
(97, 1, 3, 16),
(98, 1, 4, 32),
(99, 1, 5, 2),
(100, 2, 3, 10),
(101, 2, 1, 5),
(104, 10, 4, 30),
(106, 8, 13, 2),
(107, 8, 12, 1),
(108, 11, 1, 43),
(117, 12, 3, 3),
(118, 12, 2, 8),
(119, 12, 1, 2),
(120, 12, 4, 13);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `produksi_spesifikasi`
--

INSERT INTO `produksi_spesifikasi` (`id_produksi_spesifikasi`, `id_produksi`, `id_spesifikasi`, `id_sub_spesifikasi`) VALUES
(30, 5, 2, 4),
(31, 5, 1, 1),
(35, 4, 1, 1),
(37, 7, 2, 6),
(38, 7, 1, 1),
(41, 6, 1, 1),
(42, 1, 4, 10),
(43, 1, 1, 2),
(44, 2, 2, 4),
(45, 2, 1, 1),
(46, 8, 1, 1),
(47, 8, 3, 8),
(48, 11, 1, 2),
(49, 12, 1, 1),
(50, 12, 3, 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `produksi_warna`
--

INSERT INTO `produksi_warna` (`id_produksi_warna`, `id_produksi`, `id_kain`, `id_jenis_warna`, `pemakaian`) VALUES
(92, 5, 1, 1, 25),
(93, 5, 2, 4, 25),
(94, 5, 6, 7, 50),
(99, 4, 1, 2, 100),
(103, 7, 1, 2, 100),
(106, 6, 1, 2, 100),
(107, 1, 2, 6, 25),
(108, 1, 1, 1, 50),
(109, 1, 9, 9, 25),
(110, 2, 1, 2, 15),
(111, 2, 1, 1, 15),
(112, 2, 2, 5, 20),
(113, 2, 4, 10, 50),
(116, 10, 1, 1, 0),
(118, 8, 1, 1, 50),
(119, 8, 2, 5, 50),
(120, 11, 9, 9, 100),
(125, 12, 1, 1, 50),
(126, 12, 2, 5, 50);

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
