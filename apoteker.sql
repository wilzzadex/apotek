-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2020 at 01:06 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apoteker`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_04_17_033828_create_obat_table', 2),
(4, '2020_04_17_101033_create_pelanggan_table', 3),
(5, '2020_04_17_101138_create_suplier_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_obat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_bet` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_obat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suplier_id` int(11) NOT NULL,
  `harga_suplier` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `expired` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `kode_obat`, `no_bet`, `nama_obat`, `suplier_id`, `harga_suplier`, `harga_jual`, `stok`, `expired`, `created_at`, `updated_at`) VALUES
(1, 'OBH990791', '36276473473', 'OBH Combi', 2, 5000, 8000, 100, '2020-10-02', '2020-04-20 05:47:48', '2020-04-20 06:33:03'),
(2, '34y7374', '7364378', 'Vitacimin', 2, 2000, 3000, 100, '2020-12-04', '2020-04-20 05:53:43', '2020-04-20 05:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_tambahan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `alamat`, `no_telp`, `info_tambahan`, `created_at`, `updated_at`) VALUES
(2, 'Dinta', 'Zadex', '08959954545', 'Rujukan dokter hasan', '2020-04-19 04:50:35', '2020-04-19 04:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_suplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id`, `nama_suplier`, `penanggung_jawab`, `no_telp`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'PT Kabayan', 'Cipta', '0894541212', 'fdsfsdfsdf', '2020-04-19 04:16:09', '2020-04-19 04:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `no_invoice` varchar(30) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `uang_bayar` int(11) NOT NULL,
  `uang_kembali` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Cipta Agung t', 'ciptaagung123', '$2y$10$4x0gKlm4meD2X4uB7orWseyc6IR2CaY8LWCSPX5CdSBDXRfDC2Lbe', 'Apoteker', 'cipta-agung2020-04-175e99da7cc1e61.JPG', 'jqiCDrJQOwcqSPcSgd6sJbv3cyACAc4bkv6gDTP2l6HX7qZKPim6G9rT0su7', '2020-04-17 04:57:43', '2020-04-17 09:37:04'),
(3, 'Octavina Ismi Azizah', 'octa123', '$2y$10$Bg67E4sm1KnF9IWqISLJ6.xpWkDbYQe4GQLADjU3L.q2gZDxVNE0K', 'Kasir', 'octavina-ismi-azizah2020-04-175e99d6330d0fc.jpg', 'zO5YvvOUYIqj1op7QNEBNo3xQs7HPtcAMoeNk68uxs7I8XNh0LrYoZXddcue', '2020-04-17 04:59:06', '2020-04-18 00:22:42'),
(4, 'Muhamad Ramdani', 'ramdani123', '$2y$10$IValQDebo6MenPnSddDCMu4uKojHQN7WY/zy8.6L28zS5ry3Z4P5m', 'Kasir', 'default.jpg', 'wEQk7UhmqmbGN8CTT5Whc785rKIU8V18sjQJV6zrRAYxunzYJqdeG8lwG8kn', '2020-04-17 22:42:36', '2020-04-18 00:22:22'),
(5, 'Ahmad Waliyudin', 'ahmadw123', '$2y$10$3oUltY0p6ahqsNMWABTHp./gSbciYxftZOxgOUhfuMqqaS3GfbHvi', 'Admin', 'ahmad-waliyudin2020-04-195e9c377bce0b5.jpg', 'UgaRDFLok9cGtxGtZ2RFnbtm6lG9PvPL7pXkVTeFdjWJ1vW1X9u0geXQrGPT', NULL, '2020-04-20 08:52:07'),
(6, 'Asep', 'asep123', '$2y$10$CQ7mq3sPHT1UOvzzWeTfu.sA1o.Yo/uO8jQvflLk/.qvC8RsEtr4m', 'Kasir', 'default.jpg', 'tlsiAQydNhG4UHv91Y7QuTdtgCwH0uCUTPbnrPkiR7sqeKlo7paadhy5CxHN', '2020-04-22 02:48:52', '2020-04-22 02:48:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
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
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
