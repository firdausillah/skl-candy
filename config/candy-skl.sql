-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 08:17 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `candy-skl`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id_kelompok` varchar(2) NOT NULL,
  `nama_kelompok` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `log` varchar(50) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_user`, `type`, `log`, `tgl`) VALUES
(4, 1, 1, 'Membuka amplop kelulusan', '2020-04-27 08:00:53'),
(5, 171819023, 1, 'Membuka amplop kelulusan', '2021-05-25 13:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kode_mapel` varchar(50) NOT NULL,
  `nama_mapel` varchar(250) NOT NULL,
  `no_urut` int(2) NOT NULL,
  `kelompok` varchar(10) NOT NULL,
  `jurusan` varchar(200) NOT NULL,
  `aktif_skl` int(1) NOT NULL,
  `aktif_transkip` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `kode_mapel` varchar(50) NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pengumuman` text DEFAULT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jenis` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `id_user`, `judul`, `pengumuman`, `tgl`, `jenis`) VALUES
(2, 3, 'SURAT SKL', '<p>Untuk pengambilan Surat Keterangan Lulus (SKL) bisa diambil disekolah mulai hari Senin 5 Mei 2020</p>', '2020-04-26 08:45:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(1) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `npsn` varchar(30) DEFAULT NULL,
  `nama_kepsek` varchar(50) DEFAULT NULL,
  `nip_kepsek` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `provinsi` varchar(30) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `tgl_pengumuman` datetime DEFAULT NULL,
  `klikchat` text DEFAULT NULL,
  `livechat` text DEFAULT NULL,
  `nolivechat` varchar(50) DEFAULT NULL,
  `infobayar` text DEFAULT NULL,
  `syarat` text DEFAULT NULL,
  `banner` varchar(50) DEFAULT NULL,
  `login` int(1) NOT NULL,
  `tahun_lulus` varchar(4) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_sekolah`, `npsn`, `nama_kepsek`, `nip_kepsek`, `alamat`, `kota`, `provinsi`, `logo`, `favicon`, `email`, `no_telp`, `tgl_pengumuman`, `klikchat`, `livechat`, `nolivechat`, `infobayar`, `syarat`, `banner`, `login`, `tahun_lulus`, `semester`) VALUES
(1, 'Candy School', '69787351', 'Subur Taufik, SE', '123456788', 'Jl Buyut Kaipah Kp. Pulo Bambu Desa Karang Bahagia Kec. Karang Bahagia', 'Bekasi', NULL, 'assets/img/logo/logo965.png', NULL, NULL, NULL, '2021-05-20 07:58:00', '', '', '08986204405', NULL, NULL, 'assets/img/header/banner647.jpg', 1, '2021', 0);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tgl_lahir` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `keterangan` int(1) NOT NULL,
  `skl` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `tahun_lulus` varchar(4) NOT NULL,
  `wali` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `skl`
--

CREATE TABLE `skl` (
  `id_skl` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `nama_surat` varchar(50) NOT NULL,
  `tgl_surat` varchar(50) NOT NULL,
  `header` text NOT NULL,
  `pembuka` text NOT NULL,
  `isi_surat` text NOT NULL,
  `penutup` text NOT NULL,
  `ttd` text NOT NULL,
  `stempel` text NOT NULL,
  `wttd` varchar(50) NOT NULL,
  `wstempel` varchar(50) NOT NULL,
  `sttd` int(1) NOT NULL,
  `sstempel` int(1) NOT NULL,
  `nilai` int(1) NOT NULL,
  `kelompok` int(1) NOT NULL,
  `nilaisiswa` int(1) NOT NULL,
  `foto` int(1) NOT NULL,
  `ttd_qrcode` int(1) NOT NULL,
  `wali` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skl`
--

INSERT INTO `skl` (`id_skl`, `no_surat`, `nama_surat`, `tgl_surat`, `header`, `pembuka`, `isi_surat`, `penutup`, `ttd`, `stempel`, `wttd`, `wstempel`, `sttd`, `sstempel`, `nilai`, `kelompok`, `nilaisiswa`, `foto`, `ttd_qrcode`, `wali`) VALUES
(1, '001/CANDY/SKL/V/2021', 'SURAT KETERANGAN LULUS', '2 Mei 2020', 'assets/img/header/header969.png', '<p>Yang bertanda tangan dibawah ini Kepala SMK HS AGUNG (NPSN : 12345678) Kabupaten Bekasi Provinsi Jawa Barat. Dengan ini menerangkan :</p>', 'Berdasarkan kriteria kelulusan peserta didik yang sudah ditetapkan, maka yang bersangkutan dinyatakan :', '<p>Surat Keterangan ini bersifat sementara dan berlaku sampai ditertibkannya ijazah untuk siswa yang bersangkutan.</p><p>Demikian Surat Keterangan diberikan agar dapat dipergunakan sebagaimana mestinya.</p>', 'assets/img/header/ttdskl643.png', 'assets/img/header/stempel919.png', '160', '100', 1, 1, 1, 1, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(128) NOT NULL,
  `level` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `level`, `username`, `password`, `status`) VALUES
(4, 'Administrator', 'admin', 'admin', '$2y$10$j5STRMVkhno25h93TJGDUupdr4L7CDEQQZCOwyFyqFO5QfCteP3H.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kode_mapel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `skl`
--
ALTER TABLE `skl`
  ADD PRIMARY KEY (`id_skl`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
