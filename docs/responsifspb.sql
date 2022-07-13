-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2021 pada 17.28
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `responsifspb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `idjawaban` int(11) NOT NULL,
  `idsoal` int(11) NOT NULL,
  `isi_jawaban` text NOT NULL,
  `benarkah` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`idjawaban`, `idsoal`, `isi_jawaban`, `benarkah`) VALUES
(1, 1, 'Ipin', 1),
(2, 1, 'Ehsan', 0),
(3, 1, 'Fizi', 0),
(4, 1, 'Jarjit', 0),
(5, 2, 'Siti', 1),
(6, 2, 'Mei Mei', 0),
(7, 2, 'Kak Ros', 0),
(8, 2, 'Mail', 0),
(9, 3, 'Unyil', 1),
(10, 3, 'Jarjit', 0),
(11, 3, 'Fizi', 0),
(12, 3, 'Kak Ros', 0),
(13, 4, 'Devi', 0),
(14, 4, 'Cikgu Jasmin', 0),
(15, 4, 'Jarjit', 1),
(16, 4, 'Fizi', 0),
(17, 5, 'Guru', 0),
(18, 5, 'Nelayan', 0),
(19, 5, 'Astronaut', 0),
(20, 5, 'Chef/Cookie', 1),
(21, 6, 'David', 0),
(22, 6, 'Willi', 0),
(23, 6, 'Rambo', 1),
(24, 6, 'Gilang', 0),
(25, 7, 'Ismail', 1),
(26, 7, 'Dalang', 0),
(27, 7, 'Muto', 0),
(28, 7, 'Ahtong', 0),
(29, 8, '3', 0),
(30, 8, '4', 0),
(31, 8, '5', 1),
(32, 8, '6', 0),
(33, 9, 'Kak Ros ', 0),
(34, 9, 'Raju', 0),
(35, 9, 'Badrul', 0),
(36, 9, 'Ehsan', 1),
(37, 10, 'Fizi', 0),
(38, 10, 'Ehsan', 0),
(39, 10, 'Dzul', 1),
(40, 10, 'Mail', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `idsoal` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `halaman_ke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`idsoal`, `nomor`, `pertanyaan`, `halaman_ke`) VALUES
(1, 1, 'Siapa nama saudara Upin?', 1),
(2, 2, 'Siapa nama nenek Upin?', 1),
(3, 3, 'Berikut ini adalah nama teman Upin, kecuali', 2),
(4, 4, 'Siapa nama teman Upin Ipin yang dari India', 2),
(5, 5, 'Apa cita cita Ehsan saat besar nanti', 3),
(6, 6, 'Apa nama ayam Tok Dalang', 3),
(7, 7, 'Siapakah nama Bapak Mail', 4),
(8, 8, 'Ada berapa teman perempuan Upin Ipin?', 4),
(9, 9, 'Siapa Teman Upin Ipin yang suka makan?', 5),
(10, 10, 'Siapa teman Upin Ipin yang duduk sebangku dengan ijat ?', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`idjawaban`,`idsoal`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`idsoal`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `idjawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `idsoal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
