-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2026 pada 15.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelompok_kursus_mengemudi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `nama_admin`, `username`, `password`, `no_hp`, `email`) VALUES
(2, 'yungers', 'yungersboy', '4532', '089765', 'smridho69@gmail.com'),
(3, 'idho', 'idhoganteng', '123450', '0864632', 'idhoganteng@gmail');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_tes`
--

CREATE TABLE `hasil_tes` (
  `hasil_id` int(11) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `status` enum('lulus','tidak','','') NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_tes`
--

INSERT INTO `hasil_tes` (`hasil_id`, `peserta_id`, `jadwal_id`, `benar`, `salah`, `nilai`, `status`, `tanggal`) VALUES
(1, 0, 0, 0, 1, 0, 'lulus', '2026-01-13 09:37:28'),
(2, 0, 0, 0, 2, 0, 'lulus', '2026-01-13 18:37:49'),
(3, 2, 0, 0, 2, 0, 'lulus', '2026-01-13 18:52:09'),
(4, 2, 0, 0, 2, 0, 'lulus', '2026-01-13 18:52:54'),
(5, 2, 0, 0, 2, 0, 'lulus', '2026-01-15 20:33:13'),
(6, 2, 0, 0, 2, 0, 'lulus', '2026-01-15 20:42:54'),
(7, 2, 0, 0, 2, 0, 'lulus', '2026-01-15 20:48:15'),
(8, 2, 0, 0, 2, 0, 'lulus', '2026-01-15 20:48:22'),
(9, 2, 0, 0, 2, 0, 'lulus', '2026-01-15 20:50:03'),
(10, 2, 0, 0, 2, 0, 'lulus', '2026-01-16 01:53:57'),
(11, 2, 0, 0, 2, 0, 'lulus', '2026-01-16 01:54:11'),
(12, 2, 0, 2, 0, 100, 'lulus', '2026-01-16 02:03:04'),
(13, 2, 0, 2, 0, 100, 'lulus', '2026-01-16 02:07:59'),
(14, 2, 0, 2, 0, 100, 'lulus', '2026-01-16 02:13:29'),
(15, 2, 0, 2, 0, 100, 'lulus', '2026-01-16 03:03:43'),
(16, 2, 0, 3, 0, 100, 'lulus', '2026-01-19 20:47:46'),
(17, 2, 0, 3, 1, 75, 'lulus', '2026-01-21 14:02:44'),
(18, 2, 0, 4, 0, 100, 'lulus', '2026-01-21 14:08:37'),
(19, 2, 0, 0, 4, 0, 'lulus', '2026-01-26 17:15:19'),
(20, 2, 0, 0, 4, 0, 'lulus', '2026-01-26 17:18:03'),
(21, 2, 0, 0, 4, 0, 'lulus', '2026-01-26 17:27:42'),
(22, 2, 0, 4, 0, 100, 'lulus', '2026-01-26 17:41:52'),
(23, 2, 0, 3, 1, 75, 'lulus', '2026-01-26 17:42:20'),
(24, 2, 0, 0, 4, 0, 'lulus', '2026-01-26 17:54:41'),
(25, 2, 0, 4, 0, 100, 'lulus', '2026-01-26 19:29:26'),
(26, 2, 0, 4, 1, 80, 'lulus', '2026-01-27 10:51:03'),
(27, 2, 0, 3, 2, 60, 'lulus', '2026-06-15 15:45:47'),
(28, 2, 0, 5, 0, 100, 'lulus', '2026-06-15 15:47:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instruktur`
--

CREATE TABLE `instruktur` (
  `instruktur_id` int(11) NOT NULL,
  `nama_instruktur` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `keahlian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `instruktur`
--

INSERT INTO `instruktur` (`instruktur_id`, `nama_instruktur`, `username`, `password`, `no_hp`, `keahlian`) VALUES
(3, 'nazib', 'dirboy', '65744', '098754', 'jagoo'),
(4, 'diki', 'Ridho', '7654', '00897', 'jagoo'),
(6, 'alif', 'lif', '123', '0987', 'Pro banget');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `jadwal_id` int(11) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `instruktur_id` int(11) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `harga` int(11) NOT NULL,
  `status` enum('belum_bayar','lunas','selesai') DEFAULT 'belum_bayar',
  `approval` enum('pending','disetujui','ditolak','') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`jadwal_id`, `peserta_id`, `instruktur_id`, `mobil_id`, `tanggal`, `jam`, `harga`, `status`, `approval`) VALUES
(2, 2025, 9, 4, '0000-00-00', '00:00:03', 0, '', 'pending'),
(3, 2025, 9, 4, '0000-00-00', '00:00:03', 0, '', 'pending'),
(4, 2025, 9, 4, '0000-00-00', '00:00:03', 0, '', 'pending'),
(5, 2025, 9, 4, '0000-00-00', '00:00:03', 0, '', 'pending'),
(6, 4, 4, 2, '2026-09-15', '06:00:00', 0, '', 'pending'),
(7, 2, 3, 2, '2026-09-16', '08:00:00', 0, '', 'disetujui'),
(8, 2, 4, 3, '2026-02-15', '08:00:00', 0, '', 'pending'),
(9, 2, 3, 2, '2026-01-19', '09:30:00', 0, 'lunas', 'disetujui'),
(10, 2, 5, 2, '2026-01-30', '08:00:00', 0, '', 'pending'),
(11, 2, 1, 1, '2026-01-26', '08:07:00', 500000, NULL, 'pending'),
(12, 0, 0, 0, '0000-00-00', '00:00:00', 0, '', 'pending'),
(13, 0, 0, 0, '0000-00-00', '00:00:00', 0, '', 'pending'),
(14, 0, 0, 0, '0000-00-00', '00:00:00', 0, '', 'pending'),
(15, 2, 3, 2, '2026-01-29', '09:00:00', 250000, '', 'ditolak'),
(16, 2, 3, 2, '2026-01-29', '09:00:00', 250000, '', 'disetujui'),
(17, 2, 3, 2, '2026-01-27', '12:03:00', 250000, '', 'ditolak'),
(18, 4, 5, 3, '2026-01-28', '09:00:00', 250000, '', 'pending'),
(19, 2, 3, 2, '2026-01-27', '11:11:00', 250000, '', 'disetujui'),
(20, 2, 4, 2, '2026-01-26', '23:22:00', 250000, '', 'pending'),
(21, 4, 3, 2, '2026-01-27', '12:00:00', 250000, 'lunas', 'disetujui'),
(22, 2, 6, 4, '2026-01-27', '10:00:00', 250000, '', 'disetujui'),
(23, 2, 3, 3, '2026-06-20', '10:15:00', 250000, '', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `mobil_id` int(11) NOT NULL,
  `nama_mobil` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `transmisi` varchar(50) NOT NULL,
  `plat_nomor` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`mobil_id`, `nama_mobil`, `tipe`, `transmisi`, `plat_nomor`, `status`, `foto`) VALUES
(2, 'FORTUNER', 'MANUAL', 'Manual', 'BG 121 DHO', 'Tersedia', '1768512220_WIN_20241014_15_30_59_Pro.jpg'),
(3, 'AVANZA', 'MATIC', 'Matic', 'D 6475 ABC', 'Tersedia', '1768511909_WIN_20250603_00_32_32_Pro.jpg'),
(4, 'nissan', 'MANUAL', 'Manual', 'D 6475 ABC', 'Tersedia', '1769485416_Picture1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaran_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('transfer','cash','','') NOT NULL,
  `bank` varchar(20) NOT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `status` enum('pending','lunas','','') NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`pembayaran_id`, `jadwal_id`, `peserta_id`, `total`, `metode`, `bank`, `bukti`, `status`, `tanggal`) VALUES
(1, 9, 2, 0, 'transfer', '', NULL, 'pending', '2026-01-26 16:00:39'),
(2, 17, 2, 250000, 'transfer', '', NULL, 'pending', '2026-01-26 16:04:38'),
(3, 18, 4, 250000, 'cash', '', NULL, 'pending', '2026-01-26 17:05:58'),
(4, 6, 4, 0, 'transfer', '', NULL, 'pending', '2026-01-26 17:07:39'),
(5, 16, 2, 250000, 'transfer', 'BCA', NULL, 'pending', '2026-01-26 17:52:20'),
(6, 15, 2, 250000, 'transfer', 'Mandiri', NULL, 'pending', '2026-01-26 17:52:43'),
(7, 10, 2, 0, 'transfer', 'BCA', NULL, 'pending', '2026-01-26 17:53:57'),
(8, 8, 2, 0, 'transfer', 'BCA', NULL, 'pending', '2026-01-26 17:54:22'),
(9, 7, 2, 0, 'transfer', 'BCA', NULL, 'pending', '2026-01-26 18:32:09'),
(10, 21, 0, 250000, 'transfer', 'BCA', NULL, 'pending', '2026-01-27 09:05:37'),
(11, 9, 0, 0, 'transfer', 'BCA', NULL, 'pending', '2026-06-15 15:48:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `peserta_id` int(11) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`peserta_id`, `nama_peserta`, `username`, `password`, `no_hp`) VALUES
(2, 'uyyungs', 'dikikrok', '234', '9756'),
(4, 'Patra', 'admin', '321', '098754');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tes`
--

CREATE TABLE `tes` (
  `tes_id` int(11) NOT NULL,
  `soal` text NOT NULL,
  `a` varchar(255) NOT NULL,
  `b` varchar(255) NOT NULL,
  `c` varchar(255) NOT NULL,
  `d` varchar(255) NOT NULL,
  `jawaban` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tes`
--

INSERT INTO `tes` (`tes_id`, `soal`, `a`, `b`, `c`, `d`, `jawaban`) VALUES
(2, 'apasig', 'bnr', 'bre', 'bhu', 'bki', 'a'),
(5, 'ban mobil ada berapa', '1', '2', '3', '4', 'd'),
(6, 'ridho ganteng ga?', 'iya', 'ganteng', 'gntng bnget', 'ganteng si', 'b'),
(7, 'siapa paling ganteng di kelas', 'nazib', 'kayanya nazib', 'jelas nazib', 'semuanya benar ', 'd'),
(8, 'mobil berapa harganya', '100', '200', '300', '400', 'b');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `hasil_tes`
--
ALTER TABLE `hasil_tes`
  ADD PRIMARY KEY (`hasil_id`);

--
-- Indeks untuk tabel `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`instruktur_id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`jadwal_id`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`mobil_id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`),
  ADD KEY `fk_pembayaran_jadwal` (`jadwal_id`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`peserta_id`);

--
-- Indeks untuk tabel `tes`
--
ALTER TABLE `tes`
  ADD PRIMARY KEY (`tes_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hasil_tes`
--
ALTER TABLE `hasil_tes`
  MODIFY `hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `instruktur`
--
ALTER TABLE `instruktur`
  MODIFY `instruktur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `mobil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `peserta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tes`
--
ALTER TABLE `tes`
  MODIFY `tes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`jadwal_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
