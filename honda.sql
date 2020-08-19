-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2020 pada 09.02
-- Versi server: 10.1.19-MariaDB
-- Versi PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `honda`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kustomer`
--

CREATE TABLE `data_kustomer` (
  `id` int(11) NOT NULL,
  `nomor_order` varchar(125) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telepon` int(11) NOT NULL,
  `nomor_polisi` varchar(15) NOT NULL,
  `total_km` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `tgl_servis` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `nama_montir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_kustomer`
--

INSERT INTO `data_kustomer` (`id`, `nomor_order`, `nama`, `telepon`, `nomor_polisi`, `total_km`, `catatan`, `tgl_servis`, `status`, `nama_montir`) VALUES
(13, 'ORD2020512201447', 'Anjasmara', 2147483647, 'N 3321 UK', 83203, '<p>1. Tolong benahi rantai</p>\r\n<p>2. Kampas di cek</p>\r\n<p>3. stang oleng</p>', '2020-05-12', 9, ''),
(14, 'ORD202051820103', 'Mat Bayan', 291834344, 'n 2131 hi', 123212, '<p>Tidak Ada</p>', '2020-05-18', 8, ''),
(15, 'ORD202062991530', 'Joko', 1234, 'S 123 WW', 12312, '<p>Tidak Ada</p>', '2020-06-29', 8, 'Montir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pesanan`
--

CREATE TABLE `data_pesanan` (
  `id` int(11) NOT NULL,
  `nomor_order` varchar(125) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tanggal_pembelian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_pesanan`
--

INSERT INTO `data_pesanan` (`id`, `nomor_order`, `id_produk`, `jumlah`, `total_harga`, `status`, `tanggal_pembelian`) VALUES
(3, 'ORD2020512201447', 2, 2, 40000, 1, '2020-05-12'),
(4, 'ORD2020512201447', 4, 1, 25000, 1, '2020-05-12'),
(5, 'ORD2020512201447', 3, 1, 15000, 1, '2020-05-12'),
(6, 'ORD2020512201447', 1, 1, 10000, 1, '2020-05-12'),
(8, 'ORD202051820103', 2, 3, 60000, 2, '2020-05-18'),
(10, 'ORD202051820103', 1, 1, 20000, 2, '2020-06-15'),
(11, 'ORD202062991530', 3, 1, 15000, 0, '2020-06-29'),
(12, 'ORD202062991530', 1, 1, 10000, 0, '2020-06-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga`) VALUES
(1, 'KPB 4', 10000),
(2, 'KPB 9', 20000),
(3, 'KPB 3', 15000),
(4, 'Oli Gardan', 20000),
(5, 'Oli MPX', 45000),
(6, 'Oli Khusus Matic', 35000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `password`, `role`) VALUES
(1, 'admin', 'admin', '$2y$10$.gsk1YKXwisTDKBQF7IR8.fG2pLCtDKFw3A15WZa70MbgNM.pGW0e', 'admin'),
(2, 'kasir', 'Kasir', '$2y$10$.gsk1YKXwisTDKBQF7IR8.fG2pLCtDKFw3A15WZa70MbgNM.pGW0e', 'kasir'),
(3, 'manager', 'manager', '$2y$10$YWGhzhpl.EWIWe2GrbMYW./5wdlXgR0PMoEnbCIKTZj4.PHl/NjIG', 'manager'),
(4, 'montir', 'Montir', '$2y$10$F0S2gniOmcfU9Y4laPfAN.goJb58MwcTvCNmtgJANQjTgy7ACeR7q', 'montir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_kustomer`
--
ALTER TABLE `data_kustomer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_order` (`nomor_order`);

--
-- Indeks untuk tabel `data_pesanan`
--
ALTER TABLE `data_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kustomer` (`nomor_order`),
  ADD KEY `FK_produk` (`id_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_kustomer`
--
ALTER TABLE `data_kustomer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `data_pesanan`
--
ALTER TABLE `data_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_pesanan`
--
ALTER TABLE `data_pesanan`
  ADD CONSTRAINT `FK_kustomer` FOREIGN KEY (`nomor_order`) REFERENCES `data_kustomer` (`nomor_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
