-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2017 at 07:05 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikop`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jen_kel` varchar(15) NOT NULL,
  `status_anggota` varchar(50) NOT NULL,
  `kets` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status_keluar` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `alamat`, `no_tlp`, `tempat_lahir`, `tgl_lahir`, `jen_kel`, `status_anggota`, `kets`, `foto`, `status_keluar`) VALUES
('AGT001', 'Mohamad Rizal Ramli', 'Jln. Cut Mutiah RT 01 RW 12', '0897895234', 'Lumajang', '1998-11-12', 'Pria', 'Sedang Pinjam', '2017', 'DSC_45681.JPG', '1'),
('AGT002', 'Sinichi Kudo', 'Tokyo, Bagu Selatan', '080808980987', 'Lumajang', '1999-01-12', 'Pria', 'Belum Pinjam', '2017', 'detective_conan_derp_png_by_jinsuke04-d5qh5kf6.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id_angsuran` varchar(10) NOT NULL,
  `id_pinjaman` varchar(10) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `besar_angsuran` varchar(25) NOT NULL,
  `besar_angsuran_bunga` varchar(20) NOT NULL,
  `sisa_pinjaman` varchar(25) NOT NULL,
  `ket_angsuran` varchar(50) NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id_angsuran`, `id_pinjaman`, `tgl_pembayaran`, `angsuran_ke`, `besar_angsuran`, `besar_angsuran_bunga`, `sisa_pinjaman`, `ket_angsuran`, `tgl_jatuh_tempo`) VALUES
('AGS001', 'PJM001', '2017-03-04', 1, '100000', '833.33333333333', '0', 'Lunas', '2017-04-04'),
('AGS002', 'PJM002', '2017-03-04', 1, '100000', '416.66666666667', '0', 'Lunas', '2017-04-04'),
('AGS003', 'PJM003', '2017-03-04', 1, '100000', '10000', '0', 'Lunas', '2017-04-04'),
('AGS004', 'PJM004', '2017-03-04', 1, '100000', '10000', '0', 'Lunas', '2017-04-04'),
('AGS005', 'PJM005', '2017-03-04', 1, '100000', '10000', '0', 'Lunas', '2017-04-04'),
('AGS006', 'PJM006', '2017-03-04', 1, '200000', '20000', '0', 'Lunas', '2017-04-04'),
('AGS007', 'PJM007', '2017-03-04', 1, '83333.333333333', '100000', '2016666.6666667', 'Lunas', '2017-04-04'),
('AGS008', 'PJM007', '2017-03-04', 2, '83333.333333333', '100000', '1833333.3333334', 'Lunas', '2017-05-04'),
('AGS009', 'PJM007', '0000-00-00', 3, '83333.333333333', '100000', '', 'Belum Lunas', '2017-06-04'),
('AGS010', 'PJM007', '0000-00-00', 4, '83333.333333333', '100000', '', 'Belum Lunas', '2017-07-04'),
('AGS011', 'PJM007', '0000-00-00', 5, '83333.333333333', '100000', '', 'Belum Lunas', '2017-08-04'),
('AGS012', 'PJM007', '0000-00-00', 6, '83333.333333333', '100000', '', 'Belum Lunas', '2017-09-04'),
('AGS013', 'PJM007', '0000-00-00', 7, '83333.333333333', '100000', '', 'Belum Lunas', '2017-10-04'),
('AGS014', 'PJM007', '0000-00-00', 8, '83333.333333333', '100000', '', 'Belum Lunas', '2017-11-04'),
('AGS015', 'PJM007', '0000-00-00', 9, '83333.333333333', '100000', '', 'Belum Lunas', '2017-12-04'),
('AGS016', 'PJM007', '0000-00-00', 10, '83333.333333333', '100000', '', 'Belum Lunas', '2018-01-04'),
('AGS017', 'PJM007', '0000-00-00', 11, '83333.333333333', '100000', '', 'Belum Lunas', '2018-02-04'),
('AGS018', 'PJM007', '0000-00-00', 12, '83333.333333333', '100000', '', 'Belum Lunas', '2018-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pinjaman`
--

CREATE TABLE `kategori_pinjaman` (
  `kode_kategori_pinjaman` varchar(10) NOT NULL,
  `nama_pinjaman` varchar(50) NOT NULL,
  `persentase_pinjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_pinjaman`
--

INSERT INTO `kategori_pinjaman` (`kode_kategori_pinjaman`, `nama_pinjaman`, `persentase_pinjaman`) VALUES
('KPJ001', 'Jangka Panjang', 10),
('KPJ002', 'Jangka Pendek', 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_simpanan`
--

CREATE TABLE `kategori_simpanan` (
  `kode_kategori_simpanan` varchar(10) NOT NULL,
  `nama_simpanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_simpanan`
--

INSERT INTO `kategori_simpanan` (`kode_kategori_simpanan`, `nama_simpanan`) VALUES
('KTS001', 'Simpanan Pokok'),
('KTS002', 'Simpanan Wajib'),
('KTS003', 'Simpanan Sukarela');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `id_anggota`) VALUES
('PTG001', 'AGT001');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` varchar(10) NOT NULL,
  `id_anggota` varchar(19) NOT NULL,
  `kode_kategori_pinjaman` varchar(10) NOT NULL,
  `besar_pinjaman` varchar(25) NOT NULL,
  `total_pinjaman` varchar(20) NOT NULL,
  `tgl_pengajuan_pinjaman` date NOT NULL,
  `tgl_acc_pinjaman` date NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `tgl_pelunasan` date NOT NULL,
  `tenor` varchar(5) NOT NULL,
  `ket_pinjaman` varchar(100) NOT NULL,
  `sisa` varchar(25) NOT NULL,
  `status_pinjaman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `id_anggota`, `kode_kategori_pinjaman`, `besar_pinjaman`, `total_pinjaman`, `tgl_pengajuan_pinjaman`, `tgl_acc_pinjaman`, `tgl_pinjaman`, `tgl_pelunasan`, `tenor`, `ket_pinjaman`, `sisa`, `status_pinjaman`) VALUES
('PJM001', 'AGT001', 'KPJ001', '100000', '100833.33333333', '2017-03-12', '2017-03-14', '2017-03-04', '2017-03-04', '1', 'Hutang Kulkas', '0', 'Lunas'),
('PJM002', 'AGT002', 'KPJ002', '100000', '100416.66666667', '2017-03-04', '2017-03-04', '2017-03-04', '2017-03-04', '1', 'Hutang Kulkas', '0', 'Lunas'),
('PJM003', 'AGT001', 'KPJ001', '100000', '110000', '2017-03-04', '2017-03-04', '2017-03-04', '2017-03-04', '1', 'Hutang Kulkas', '0', 'Lunas'),
('PJM004', 'AGT002', 'KPJ001', '100000', '110000', '2017-03-05', '2017-03-05', '2017-03-04', '2017-03-04', '1', 'Hutang Kulkas', '0', 'Lunas'),
('PJM005', 'AGT002', 'KPJ001', '100000', '110000', '2017-03-05', '2017-03-05', '2017-03-04', '2017-03-04', '1', 'Hutang Kulkas', '0', 'Lunas'),
('PJM006', 'AGT002', 'KPJ001', '200000', '220000', '2017-03-04', '2017-03-04', '2017-03-04', '2017-03-04', '1', 'Hutang Kulkas', '0', 'Lunas'),
('PJM007', 'AGT001', 'KPJ001', '1000000', '2200000', '2017-03-04', '2017-03-04', '2017-03-04', '0000-00-00', '12', 'blabla', '1833333.3333334', 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `rekap`
--

CREATE TABLE `rekap` (
  `id_rekap` int(11) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tgl_rekap` date NOT NULL,
  `nominal` varchar(30) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekap`
--

INSERT INTO `rekap` (`id_rekap`, `id_anggota`, `kategori`, `tgl_rekap`, `nominal`, `ket`) VALUES
(1, 'AGT001', 'Pemasukan', '2017-03-04', '50000', 'Pembayaran Simpanan Pokok'),
(2, 'AGT001', 'Pemasukan', '2017-03-04', '100000', 'Pembayaran Simpanan Wajib'),
(3, 'AGT001', 'Pemasukan', '2017-03-04', '200000', 'Menabung Simpanan Sukarela'),
(4, 'AGT001', 'Pengeluaran', '2017-03-04', '100000', 'Peminjaman Uang'),
(5, 'AGT002', 'Pemasukan', '2017-03-04', '50000', 'Pembayaran Simpanan Pokok'),
(6, 'AGT002', 'Pengeluaran', '2017-03-04', '100000', 'Peminjaman Uang'),
(7, 'AGT001', 'Pemasukan', '2017-03-04', '100833.33333333', 'Pembayaran Angsuran'),
(8, 'AGT001', 'Pengeluaran', '2017-03-04', '100000', 'Peminjaman Uang'),
(9, 'AGT002', 'Pemasukan', '2017-03-04', '100416.66666667', 'Pembayaran Angsuran'),
(10, 'AGT002', 'Pengeluaran', '2017-03-04', '100000', 'Peminjaman Uang'),
(11, 'AGT002', 'Pemasukan', '2017-03-04', '110000', 'Pembayaran Angsuran'),
(12, 'AGT002', 'Pengeluaran', '2017-03-04', '100000', 'Peminjaman Uang'),
(13, 'AGT002', 'Pemasukan', '2017-03-04', '110000', 'Pembayaran Angsuran'),
(14, 'AGT002', 'Pengeluaran', '2017-03-04', '200000', 'Peminjaman Uang'),
(15, 'AGT002', 'Pemasukan', '2017-03-04', '220000', 'Pembayaran Angsuran'),
(16, 'AGT001', 'Pemasukan', '2017-03-04', '110000', 'Pembayaran Angsuran'),
(17, 'AGT001', 'Pemasukan', '2017-03-04', '50000', 'Menabung Simpanan Sukarela'),
(18, 'AGT001', 'Pengeluaran', '2017-03-04', '100000', 'Pengambilan Simpanan Sukarela'),
(19, 'AGT001', 'Pemasukan', '2017-03-04', '50000', 'Menabung Simpanan Sukarela'),
(20, 'AGT001', 'Pengeluaran', '2017-03-04', '20000', 'Pengambilan Simpanan Sukarela'),
(21, 'AGT001', 'Pengeluaran', '2017-03-04', '30000', 'Pengambilan Simpanan Sukarela'),
(22, 'AGT001', 'Pengeluaran', '2017-03-04', '1000000', 'Peminjaman Uang'),
(23, 'AGT001', 'Pemasukan', '2017-03-04', '183333.33333333', 'Pembayaran Angsuran'),
(24, 'AGT001', 'Pemasukan', '2017-03-04', '183333.33333333', 'Pembayaran Angsuran');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `id_simpanan` varchar(10) NOT NULL,
  `kode_kategori_simpanan` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `tgl_simpanan` date NOT NULL,
  `besar_simpanan` varchar(25) NOT NULL,
  `ket_simpanan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `kode_kategori_simpanan`, `id_anggota`, `tgl_simpanan`, `besar_simpanan`, `ket_simpanan`) VALUES
('SPM001', 'KTS001', 'AGT001', '2017-03-04', '50000', 'Uang Pendaftaran'),
('SPM002', 'KTS002', 'AGT001', '2017-03-04', '100000', 'Pembayaran Simpanan Wajib'),
('SPM003', 'KTS003', 'AGT001', '2017-03-04', '150000', 'Simpanan Sukarela'),
('SPM004', 'KTS001', 'AGT002', '2017-03-04', '50000', 'Uang Pendaftaran');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `id_petugas` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_petugas`, `username`, `password`, `level`) VALUES
('USR001', '-', 'admin', 'sadmin', 'admin'),
('USR002', 'PTG001', 'zaldolphin', 'zaldolphin', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id_angsuran`),
  ADD KEY `id_pinjaman` (`id_pinjaman`);

--
-- Indexes for table `kategori_pinjaman`
--
ALTER TABLE `kategori_pinjaman`
  ADD PRIMARY KEY (`kode_kategori_pinjaman`);

--
-- Indexes for table `kategori_simpanan`
--
ALTER TABLE `kategori_simpanan`
  ADD PRIMARY KEY (`kode_kategori_simpanan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `kode_kategori_pinjaman` (`kode_kategori_pinjaman`);

--
-- Indexes for table `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`id_rekap`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id_simpanan`),
  ADD KEY `kode_kategori_simpanan` (`kode_kategori_simpanan`,`id_anggota`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rekap`
--
ALTER TABLE `rekap`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
