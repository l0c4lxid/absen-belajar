-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2023 pada 03.41
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen_test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_absen`
--

CREATE TABLE `tbl_absen` (
  `id_absen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jam_masuk` datetime(6) DEFAULT NULL,
  `masuk_telat` char(1) DEFAULT NULL,
  `jam_keluar` datetime(6) DEFAULT NULL,
  `keluar_telat` char(1) DEFAULT NULL,
  `keterangan` enum('Masuk','Keluar','Pagi','Sore') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_absen`
--

INSERT INTO `tbl_absen` (`id_absen`, `id_user`, `jam_masuk`, `masuk_telat`, `jam_keluar`, `keluar_telat`, `keterangan`) VALUES
(133, 44, '2023-11-17 14:34:13.000000', '1', '2023-11-17 14:34:19.000000', '1', 'Keluar'),
(134, 44, '2023-11-17 15:48:12.000000', '2', NULL, NULL, 'Masuk'),
(135, 44, '2023-11-22 07:30:35.000000', '1', NULL, NULL, 'Masuk'),
(137, 45, '2023-11-22 07:34:39.000000', '1', NULL, NULL, 'Masuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_devisi`
--

CREATE TABLE `tbl_devisi` (
  `id_devisi` int(11) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_devisi`
--

INSERT INTO `tbl_devisi` (`id_devisi`, `keterangan`) VALUES
(1, 'TS'),
(9, 'CS'),
(33, 'SATPAM'),
(40, 'DCCS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jam`
--

CREATE TABLE `tbl_jam` (
  `id_jam` int(11) NOT NULL,
  `shift` varchar(10) DEFAULT NULL,
  `jam_masuk_awal` time DEFAULT NULL,
  `jam_masuk_akhir` time DEFAULT NULL,
  `jam_keluar_awal` time DEFAULT NULL,
  `jam_keluar_akhir` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jam`
--

INSERT INTO `tbl_jam` (`id_jam`, `shift`, `jam_masuk_awal`, `jam_masuk_akhir`, `jam_keluar_awal`, `jam_keluar_akhir`) VALUES
(0, 'CS', '06:00:00', '09:00:00', '16:30:00', '21:30:00'),
(1, 'Pagi', '06:00:00', '07:00:00', '16:30:00', '17:30:00'),
(2, 'Siang', '14:30:00', '15:00:00', '21:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `id_devisi` int(11) DEFAULT NULL,
  `id_jam` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level_user` enum('1','2','3') DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_devisi`, `id_jam`, `username`, `password`, `level_user`, `nama`, `alamat`, `no_telp`) VALUES
(1, NULL, NULL, 'admin', '$2y$10$6BTvaeIHGYu3NChd7AtZXOTP5wLzaJrTAhnV.hujroJMN5pL3KIl.', '1', NULL, NULL, NULL),
(38, 1, 2, 'sadaasdasd', '$2y$10$Mn1F40biX0Vj0NqYLzOgTuyjH7JL7/inLNZ9YLZwlZdJDIBirres2', '2', 'asd', 'sad', '12312'),
(40, 1, 1, 'dhika', '$2y$10$tqvj/oOtRDIkJCECeF.sdOS93EKz8FKhnDAO5zb/Dkrl8mmF5UFty', '2', 'dhika', 'alamat dhika', '13'),
(42, 9, 0, 'usercs', '$2y$10$hJZ0UUrSQu8Q9v/ZyKTiLei2cEl1W0Kg0.90xDjqcMshdT6hfWgBy', '3', 'cs', 'asd', '123'),
(43, 33, 1, 'asdasadas', '$2y$10$R29wdY..m3GnphBXHIveKe2Ghyo6Rd3qzA1OMsVFn3wbYuNttmJ.K', '2', 'adawd', 'sadwdawd', '2312'),
(44, 9, 0, 'agil', '$2y$10$GW3H3zLddvvapu1x6/KrXe9iyNMjhECrM85dtSSX0dN0q3GboN146', '3', 'agil', 'agil', '123132'),
(45, 9, 0, 'pandi', '$2y$10$HnAW7Ycp2.8IMR1MTheWH.TT.ctEqgMNHHsfG1kD6WsjdHE6Oe1iW', '3', 'pandi', 'pandi', '546'),
(46, 1, 0, 'user', '$2y$10$0pmRo1kshU4ogSh/uehl5euq.EeY0tdfJUaZpgfdO6/3X24Wxaso6', '2', 'users', 'alamat user', '0880808');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_absen`
--
ALTER TABLE `tbl_absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_devisi`
--
ALTER TABLE `tbl_devisi`
  ADD PRIMARY KEY (`id_devisi`);

--
-- Indeks untuk tabel `tbl_jam`
--
ALTER TABLE `tbl_jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_devisi`),
  ADD KEY `id_devisi` (`id_devisi`),
  ADD KEY `id_jam` (`id_jam`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_absen`
--
ALTER TABLE `tbl_absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT untuk tabel `tbl_devisi`
--
ALTER TABLE `tbl_devisi`
  MODIFY `id_devisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tbl_jam`
--
ALTER TABLE `tbl_jam`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_absen`
--
ALTER TABLE `tbl_absen`
  ADD CONSTRAINT `tbl_absen_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`id_devisi`) REFERENCES `tbl_devisi` (`id_devisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_user_ibfk_2` FOREIGN KEY (`id_jam`) REFERENCES `tbl_jam` (`id_jam`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
