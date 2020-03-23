-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2020 at 01:24 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_trans`
--

CREATE TABLE `detail_trans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_trans` bigint(20) UNSIGNED NOT NULL,
  `id_jenis` bigint(20) UNSIGNED NOT NULL,
  `berat` int(11) NOT NULL,
  `subtotal` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detail_trans`
--

INSERT INTO `detail_trans` (`id`, `id_trans`, `id_jenis`, `berat`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 4, 14000, '2020-02-17 23:08:07', '2020-02-17 23:08:07'),
(2, 7, 2, 4, 15750, '2020-02-17 23:33:21', '2020-02-17 23:33:21'),
(3, 8, 2, 4, 15750, '2020-02-24 20:16:59', '2020-02-24 20:16:59'),
(4, 8, 1, 5, 15750, '2020-02-24 20:16:59', '2020-02-24 20:16:59'),
(5, 9, 2, 4, 15750, '2020-02-25 19:08:09', '2020-02-25 19:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cuci`
--

CREATE TABLE `jenis_cuci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jenis` varchar(49) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_per_kg` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jenis_cuci`
--

INSERT INTO `jenis_cuci` (`id`, `nama_jenis`, `harga_per_kg`, `created_at`, `updated_at`) VALUES
(1, 'cuci kering', 3500, '2020-02-17 00:16:38', '2020-02-17 00:35:47'),
(2, 'cuci kering setrika', 4500, '2020-02-17 00:46:59', '2020-02-17 00:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_02_15_165501_create_table_pelanggan', 1),
(4, '2020_02_15_165629_create_table_petugas', 1),
(5, '2020_02_15_165654_create_table_transaksi', 1),
(6, '2020_02_15_165713_create_table_jenis_cuci', 2),
(7, '2020_02_15_165738_create_table_detail_trans', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `telp` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `telp`, `created_at`, `updated_at`) VALUES
(2, 'hiya 5', 'siyotobagus', '085555555555', '2020-02-17 00:08:36', '2020-02-17 00:33:54'),
(3, 'Hiya 3', 'Siyotobagus', '083333333333', '2020-02-17 00:08:45', '2020-02-17 00:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_petugas` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `telp` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(49) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(49) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `telp`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(3, 'krisna putra', '08111111111', 'iamkpm', '$2y$10$2ul54hz6g5OhRAvssmU9E.lxH57jfKXeye688LyaSqKnif033XEjq', 'admin', '2020-02-16 23:58:05', '2020-02-25 19:02:42'),
(5, 'John Doe', '089999999999', 'johndoe', '$2y$10$ODbRVQXdt57cGdqBUrBAHewkogd.nhObZ8.n5QAt1d3878C.Ka.au', 'petugas', '2020-03-23 04:36:00', '2020-03-23 04:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `id_petugas` bigint(20) UNSIGNED NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pelanggan`, `id_petugas`, `tgl_transaksi`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
(6, 2, 3, '2020-02-18 06:08:07', '2020-02-20 06:08:07', '2020-02-17 23:08:07', '2020-02-17 23:08:07'),
(7, 3, 3, '2020-02-18 06:33:21', '2020-02-20 06:33:21', '2020-02-17 23:33:21', '2020-02-17 23:33:21'),
(8, 3, 3, '2020-02-25 03:16:59', '2020-02-27 03:16:59', '2020-02-24 20:16:59', '2020-02-24 20:16:59'),
(9, 3, 3, '2020-02-26 02:08:09', '2020-02-28 02:08:09', '2020-02-25 19:08:09', '2020-02-25 19:08:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_trans`
--
ALTER TABLE `detail_trans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trans` (`id_trans`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `jenis_cuci`
--
ALTER TABLE `jenis_cuci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_trans`
--
ALTER TABLE `detail_trans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_cuci`
--
ALTER TABLE `jenis_cuci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_trans`
--
ALTER TABLE `detail_trans`
  ADD CONSTRAINT `detail_trans_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_cuci` (`id`),
  ADD CONSTRAINT `detail_trans_ibfk_2` FOREIGN KEY (`id_trans`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
