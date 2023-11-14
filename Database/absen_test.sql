-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Nov 2023 pada 09.08
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
  `id_absen` int(2) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jam_masuk` datetime(6) DEFAULT NULL,
  `masuk_telat` char(1) DEFAULT NULL,
  `jam_keluar` datetime(6) DEFAULT NULL,
  `keluar_telat` char(1) DEFAULT NULL,
  `keterangan` enum('Masuk','Keluar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_absen`
--

INSERT INTO `tbl_absen` (`id_absen`, `id_user`, `jam_masuk`, `masuk_telat`, `jam_keluar`, `keluar_telat`, `keterangan`) VALUES
(28, 6, '2023-11-13 15:04:26.000000', '1', '2023-11-13 15:04:36.000000', '2', 'Keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_devisi`
--

CREATE TABLE `tbl_devisi` (
  `id_devisi` int(2) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_devisi`
--

INSERT INTO `tbl_devisi` (`id_devisi`, `keterangan`) VALUES
(1, 'technikal support'),
(9, 'OB'),
(10, 'admin'),
(12, 'Pusat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `id_devisi` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level_user` enum('1','2') DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_devisi`, `username`, `password`, `level_user`, `nama`, `alamat`, `no_telp`) VALUES
(1, NULL, 'admin', '$2y$10$v1.remruPngdfMEyq9er7eMPYMydwgUucjKL27N5MRJZPjrSWb.v2', '1', NULL, NULL, NULL),
(6, 1, 'andhika', '$2y$10$E0mlecr6sLFdrHuckNCP/OMzsrxVKHfkFcVPm7abcFNQgirv9p/2u', '2', 'andhika', 'andhika', '089607765169'),
(19, 10, 'asd', '$2y$10$DRzlUjl0mNJEnwTQw8gu7uvPWU2cVJF1VgMbhB28ksyJVC06lo7iq', '2', 'dasda', 'dsadas', 'sdasd');

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
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_devisi`),
  ADD KEY `id_devisi` (`id_devisi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_absen`
--
ALTER TABLE `tbl_absen`
  MODIFY `id_absen` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tbl_devisi`
--
ALTER TABLE `tbl_devisi`
  MODIFY `id_devisi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`id_devisi`) REFERENCES `tbl_devisi` (`id_devisi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
