-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2023 pada 21.28
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dss_uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`) VALUES
(1, 'admin1', 'admin1@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(3, 'admin2', 'admin2@gmail.com', 'c93ccd78b2076528346216b3b2f701e6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int(5) NOT NULL,
  `nama_kelompok` varchar(20) NOT NULL,
  `akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelompok`
--

INSERT INTO `kelompok` (`id`, `nama_kelompok`, `akses`) VALUES
(1, 'Ukuran Layar', 'layar'),
(2, 'Kapasitas RAM', 'ram'),
(3, 'Kapasitas HDD', 'hdd'),
(4, 'Harga', 'harga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(10) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `bawah` float(10,2) NOT NULL,
  `tengah` float(10,2) NOT NULL,
  `atas` float(10,2) NOT NULL,
  `kelompok` tinyint(2) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama_kriteria`, `bawah`, `tengah`, `atas`, `kelompok`, `keterangan`) VALUES
(2, 'Besar', 12.00, 14.50, 17.00, 1, ' '),
(3, 'Kecil', 1.00, 3.50, 7.00, 2, ' '),
(1, 'Kecil', 10.00, 12.50, 15.00, 1, ' '),
(4, 'Sedang', 5.00, 7.00, 9.00, 2, ' '),
(5, 'Besar', 7.00, 12.00, 17.00, 2, ' '),
(6, 'Kecil', 200.00, 500.00, 800.00, 3, ' '),
(7, 'Besar', 400.00, 900.00, 1400.00, 3, ' '),
(8, 'Murah', 2000000.00, 5000000.00, 8000000.00, 4, ' '),
(9, 'Sedang', 5900000.00, 9000000.00, 12000000.00, 4, ' '),
(10, 'Mahal', 8000000.00, 14000000.00, 25000000.00, 4, ' ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laptop`
--

CREATE TABLE `laptop` (
  `id` int(5) NOT NULL,
  `type` varchar(50) NOT NULL,
  `layar` varchar(10) NOT NULL,
  `ram` varchar(10) NOT NULL,
  `hdd` varchar(10) NOT NULL,
  `harga` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laptop`
--

INSERT INTO `laptop` (`id`, `type`, `layar`, `ram`, `hdd`, `harga`) VALUES
(1, ' ASUS ROG G55OJX', '15.6', '8', '1000', '10599000'),
(3, 'ASUS VIVOBOOK S14S410UN', '14', '8', '750', '9348000'),
(4, 'ASUS A456UQ', '14', '8', '1000', '7997000'),
(5, 'ASUS A46CM WX09 SD', '14', '4', '750', '14299000'),
(6, 'ASUS ROG GL553VE', '15.6', '16', '1000', '22956000'),
(7, 'ASUS E202CA', '11', '2', '500', '2850000'),
(8, 'ASUS X44INA', '14', '4', '500', '4350000'),
(9, 'ASUS X44IUV', '14', '4', '500', '6000000'),
(10, 'ASUS A442UR', '14', '4', '500', '8100000'),
(11, 'ASUS E203NAH', '11', '2', '500', '3500000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `password`) VALUES
(210014, 'Lina Labibah', 'lina@gmail.com', '528a3c500e49e8d14159dd2935ee36a1'),
(210021, 'Fifah Mutia', 'lutfi123@gmail.com', 'f7cff71be21cbe9e5676b94364f0f0e8'),
(210023, 'Lutfi Nur Rohmah', '08lutfinr@gmail.com', '25d55ad283aa400af464c76d713c07ad');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `laptop`
--
ALTER TABLE `laptop`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210024;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
