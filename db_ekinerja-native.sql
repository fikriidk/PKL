-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 09:05 AM
-- Server version: 10.1.38-MariaDB
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
-- Database: `db_ekinerja-native`
--

-- --------------------------------------------------------

--
-- Table structure for table `tharian`
--

CREATE TABLE `tharian` (
  `id_harian` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `lama_pengerjaan` int(5) NOT NULL,
  `kegiatan` text NOT NULL,
  `output` varchar(200) NOT NULL,
  `deskripsi_pekerjaan` text NOT NULL,
  `file_pekerjaan` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Proses',
  `nilai` int(4) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `id_korektor` int(11) NOT NULL,
  `id_satuan` int(4) NOT NULL,
  `tgl_simpan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tjabatan`
--

CREATE TABLE `tjabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tjabatan`
--

INSERT INTO `tjabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Driver'),
(2, 'Operator Gudang'),
(3, 'Admin Gudang'),
(4, 'Manager PPIC'),
(5, 'Manager GA'),
(6, 'Teknisi'),
(7, 'Manager Area'),
(8, 'Manager HRD'),
(9, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `tkaryawan`
--

CREATE TABLE `tkaryawan` (
  `id_karyawan` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `jabatan` int(2) NOT NULL,
  `atasan1` int(2) NOT NULL,
  `atasan2` int(2) NOT NULL,
  `password` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `level` varchar(8) NOT NULL DEFAULT 'karyawan',
  `foto` varchar(200) NOT NULL,
  `tgl_simpan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkaryawan`
--

INSERT INTO `tkaryawan` (`id_karyawan`, `nip`, `nama_lengkap`, `jabatan`, `atasan1`, `atasan2`, `password`, `status`, `level`, `foto`, `tgl_simpan`) VALUES
(1, '111', 'Muhammad Hafid', 9, 0, 0, 'df9dba1abb897bb9156642073411577cbca850e301e3fec00b34dfd84cc5246e5479d3840d7810492fb8c55a8bf6fbb2973103d846df5490b28fd766263f0d3f', 'Aktif', 'Karyawan', 'json_logo-555px.png', '2021-09-27 01:38:07'),
(2, '222', 'Muhammad Uwais', 3, 1, 0, 'a74fa7de01df0a556e50edce7366781aa84dc01f59e77a9870b40c29daf6fb5572ea0a6588501b764cabd79ca7cac6b9c718e17b72dede04591c7fb43a4f01c1', 'Aktif', 'Karyawan', 'noimages.jpg', '2021-09-27 02:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `tsatuan`
--

CREATE TABLE `tsatuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tsatuan`
--

INSERT INTO `tsatuan` (`id_satuan`, `satuan`) VALUES
(1, 'Dok'),
(2, 'Berkas'),
(3, 'Buku'),
(4, 'Set'),
(5, 'Paket'),
(6, 'Surat'),
(7, 'Buah'),
(8, 'Unit'),
(9, 'Orang'),
(10, 'Kelompok');

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `level` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `foto` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id_user`, `username`, `password`, `nama_pengguna`, `level`, `status`, `foto`) VALUES
(5, 'operator', 'f9deb2b99e626aae82e6aad1d735305ef4710d9e0a6f4db2bfb84f856f9250c3b639bdb3ac9a60f58934ee8f048fce1381682f0753a1a2023508638456c9acfd', 'Operator Diskominfotik Bengkulu Tengah', 'Operator', 'Aktif', 'noimages.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_datakaryawan`
-- (See below for the actual view)
--
CREATE TABLE `v_datakaryawan` (
`id_karyawan` int(11)
,`nip` varchar(25)
,`nama_lengkap` varchar(150)
,`jabatan` int(2)
,`atasan1` int(2)
,`atasan2` int(2)
,`password` text
,`status` varchar(10)
,`level` varchar(8)
,`foto` varchar(200)
,`tgl_simpan` timestamp
,`jabatan1` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_lapharian`
-- (See below for the actual view)
--
CREATE TABLE `v_lapharian` (
`id_harian` int(11)
,`id_karyawan` int(11)
,`tanggal` date
,`waktu_mulai` time
,`waktu_selesai` time
,`lama_pengerjaan` int(5)
,`kegiatan` text
,`output` varchar(200)
,`deskripsi_pekerjaan` text
,`file_pekerjaan` text
,`status` varchar(10)
,`nilai` int(4)
,`keterangan` varchar(128)
,`id_korektor` int(11)
,`id_satuan` int(4)
,`tgl_simpan` timestamp
,`nama_lengkap` varchar(150)
,`atasan1` int(2)
,`atasan2` int(2)
,`satuan` varchar(20)
,`jabatan` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `v_datakaryawan`
--
DROP TABLE IF EXISTS `v_datakaryawan`;

CREATE  VIEW `v_datakaryawan`  AS  select `tkaryawan`.`id_karyawan` AS `id_karyawan`,`tkaryawan`.`nip` AS `nip`,`tkaryawan`.`nama_lengkap` AS `nama_lengkap`,`tkaryawan`.`jabatan` AS `jabatan`,`tkaryawan`.`atasan1` AS `atasan1`,`tkaryawan`.`atasan2` AS `atasan2`,`tkaryawan`.`password` AS `password`,`tkaryawan`.`status` AS `status`,`tkaryawan`.`level` AS `level`,`tkaryawan`.`foto` AS `foto`,`tkaryawan`.`tgl_simpan` AS `tgl_simpan`,`tjabatan`.`jabatan` AS `jabatan1` from (`tkaryawan` join `tjabatan`) where (`tkaryawan`.`jabatan` = `tjabatan`.`id_jabatan`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_lapharian`
--
DROP TABLE IF EXISTS `v_lapharian`;

CREATE  VIEW `v_lapharian`  AS  select `tharian`.`id_harian` AS `id_harian`,`tharian`.`id_karyawan` AS `id_karyawan`,`tharian`.`tanggal` AS `tanggal`,`tharian`.`waktu_mulai` AS `waktu_mulai`,`tharian`.`waktu_selesai` AS `waktu_selesai`,`tharian`.`lama_pengerjaan` AS `lama_pengerjaan`,`tharian`.`kegiatan` AS `kegiatan`,`tharian`.`output` AS `output`,`tharian`.`deskripsi_pekerjaan` AS `deskripsi_pekerjaan`,`tharian`.`file_pekerjaan` AS `file_pekerjaan`,`tharian`.`status` AS `status`,`tharian`.`nilai` AS `nilai`,`tharian`.`keterangan` AS `keterangan`,`tharian`.`id_korektor` AS `id_korektor`,`tharian`.`id_satuan` AS `id_satuan`,`tharian`.`tgl_simpan` AS `tgl_simpan`,`tkaryawan`.`nama_lengkap` AS `nama_lengkap`,`tkaryawan`.`atasan1` AS `atasan1`,`tkaryawan`.`atasan2` AS `atasan2`,`tsatuan`.`satuan` AS `satuan`,`tjabatan`.`jabatan` AS `jabatan` from (((`tharian` join `tkaryawan`) join `tsatuan`) join `tjabatan`) where ((`tharian`.`id_karyawan` = `tkaryawan`.`id_karyawan`) and (`tharian`.`id_satuan` = `tsatuan`.`id_satuan`) and (`tkaryawan`.`jabatan` = `tjabatan`.`id_jabatan`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tharian`
--
ALTER TABLE `tharian`
  ADD PRIMARY KEY (`id_harian`);

--
-- Indexes for table `tjabatan`
--
ALTER TABLE `tjabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tkaryawan`
--
ALTER TABLE `tkaryawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tsatuan`
--
ALTER TABLE `tsatuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tharian`
--
ALTER TABLE `tharian`
  MODIFY `id_harian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tjabatan`
--
ALTER TABLE `tjabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tkaryawan`
--
ALTER TABLE `tkaryawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tsatuan`
--
ALTER TABLE `tsatuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
