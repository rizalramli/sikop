-- Adminer 3.7.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+07:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `dbperpustakaan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbperpustakaan`;

DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota` (
  `kd_anggota` varchar(5) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `aktif` enum('Y','T') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`kd_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `anggota` (`kd_anggota`, `nama`, `no_telp`, `alamat`, `tgl_bergabung`, `aktif`) VALUES
('P0001',	'Achmad Solichin',	'02193824838',	'Jl. Ciledug Raya, Jakarta Selatan',	'2013-05-26',	'Y'),
('P0002',	'Chotimatul Musyarofah',	'02183849838',	'Jalan Utama Peninggilan, Ciledug, Tangerang',	'2013-05-26',	'Y');

DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku` (
  `kd_buku` varchar(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `jumlah` int(5) NOT NULL,
  PRIMARY KEY (`kd_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `buku` (`kd_buku`, `judul`, `pengarang`, `penerbit`, `jumlah`) VALUES
('B0001',	'Algoritma dan Pemrograman',	'Moh. Sjukani',	'Duta Wacana',	5),
('B0002',	'Pemrograman Web dengan PHP & MySQL',	'Achmad Solichin',	'Budi Luhur Press',	3),
('B0003',	'MySQL: Dari Pemula Hingga Mahir',	'Achmad Solichin',	'Budi Luhur Press',	6);

DROP TABLE IF EXISTS `copy_buku`;
CREATE TABLE `copy_buku` (
  `kd_copybuku` int(10) NOT NULL AUTO_INCREMENT,
  `kd_buku` varchar(5) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`kd_copybuku`),
  KEY `kd_buku` (`kd_buku`),
  CONSTRAINT `copy_buku_ibfk_1` FOREIGN KEY (`kd_buku`) REFERENCES `buku` (`kd_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `copy_buku` (`kd_copybuku`, `kd_buku`, `status`) VALUES
(1,	'B0001',	'1'),
(2,	'B0001',	'1'),
(3,	'B0001',	'1'),
(4,	'B0001',	'1'),
(5,	'B0001',	'1'),
(6,	'B0002',	'1'),
(7,	'B0002',	'1'),
(8,	'B0002',	'1'),
(9,	'B0003',	'1'),
(10,	'B0003',	'1'),
(11,	'B0003',	'1'),
(12,	'B0003',	'1'),
(13,	'B0003',	'1'),
(14,	'B0003',	'1');

DROP TABLE IF EXISTS `detil_pinjam`;
CREATE TABLE `detil_pinjam` (
  `id_pinjam` int(10) NOT NULL,
  `kd_copybuku` int(10) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  KEY `id_pinjam` (`id_pinjam`),
  KEY `kd_copybuku` (`kd_copybuku`),
  CONSTRAINT `detil_pinjam_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_pinjam`),
  CONSTRAINT `detil_pinjam_ibfk_2` FOREIGN KEY (`kd_copybuku`) REFERENCES `copy_buku` (`kd_copybuku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `detil_pinjam` (`id_pinjam`, `kd_copybuku`, `status`, `keterangan`) VALUES
(1,	1,	'1',	''),
(1,	6,	'1',	''),
(2,	2,	'1',	''),
(2,	10,	'1',	''),
(3,	11,	'1',	''),
(3,	7,	'1',	'');

DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman` (
  `id_pinjam` int(10) NOT NULL AUTO_INCREMENT,
  `kd_anggota` varchar(5) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_hrskembali` date NOT NULL,
  PRIMARY KEY (`id_pinjam`),
  KEY `kd_anggota` (`kd_anggota`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`kd_anggota`) REFERENCES `anggota` (`kd_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `peminjaman` (`id_pinjam`, `kd_anggota`, `tgl_pinjam`, `tgl_hrskembali`) VALUES
(1,	'P0001',	'2013-05-26',	'2013-06-01'),
(2,	'P0001',	'2013-05-20',	'2013-05-27'),
(3,	'P0002',	'2013-05-20',	'2013-05-27');

DROP TABLE IF EXISTS `pengembalian`;
CREATE TABLE `pengembalian` (
  `id_kembali` int(10) NOT NULL AUTO_INCREMENT,
  `id_pinjam` int(10) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `terlambat` int(3) NOT NULL,
  `denda` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_kembali`),
  KEY `id_pinjam` (`id_pinjam`),
  CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_pinjam`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `pengembalian` (`id_kembali`, `id_pinjam`, `tgl_kembali`, `terlambat`, `denda`) VALUES
(1,	2,	'2013-05-26',	0,	0),
(2,	3,	'2013-05-25',	0,	0);

-- 2013-05-26 05:53:12
