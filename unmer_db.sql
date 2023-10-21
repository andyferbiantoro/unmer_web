-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Okt 2023 pada 06.36
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unmer_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `role_admin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `id_user`, `nama`, `nik`, `tempat_lahir`, `tanggal_lahir`, `status`, `role_admin`, `created_at`, `updated_at`) VALUES
(4, 5, 'Andy Ferbiantoro', '3510011402990003', 'Banyuwangi', '2023-10-19', 'Aktif', 'Admin Penginapan', '2023-10-18 21:25:56', '2023-10-18 21:55:36'),
(5, 6, 'khoirul anam', '3510011402990003', 'Banyuwangi', '2023-10-16', 'Aktif', 'Admin Kasir', '2023-10-19 01:01:25', '2023-10-19 01:01:25'),
(6, 8, 'andy', '3510011402990001', 'BWI', '2023-10-04', 'Aktif', 'Admin Event', '2023-10-19 23:44:44', '2023-10-19 23:44:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_events`
--

CREATE TABLE `detail_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` int(11) NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_festivals`
--

CREATE TABLE `detail_festivals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_festival` int(11) NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kamar_hotels`
--

CREATE TABLE `detail_kamar_hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kamar_hotel` int(11) NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_market_agrikultures`
--

CREATE TABLE `detail_market_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_market` int(11) NOT NULL,
  `jam_pengiriman_awal` int(11) NOT NULL,
  `jam_pengiriman_akhir` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_wisatas`
--

CREATE TABLE `detail_wisatas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_wisata` int(11) NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` int(11) NOT NULL,
  `judul_event` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tanggal_event` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `htn_event` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit_agrikultures`
--

CREATE TABLE `favorit_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk_agrikulture` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit_koperasis`
--

CREATE TABLE `favorit_koperasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk_koperasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `festivals`
--

CREATE TABLE `festivals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_amin` int(11) NOT NULL,
  `judul_festival` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tanggal_festival` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `htm_festival` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` int(11) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar_hotels`
--

CREATE TABLE `kamar_hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `nama_kamar` varchar(255) NOT NULL,
  `jenis_kamar` varchar(255) NOT NULL,
  `harga_permalam` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar_kosts`
--

CREATE TABLE `kamar_kosts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kost` int(11) NOT NULL,
  `harga_sebulan` int(11) NOT NULL,
  `harga_sehari` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kosts`
--

CREATE TABLE `kosts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_kost` varchar(255) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `market_agrikultures`
--

CREATE TABLE `market_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `status_buka` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `market_agrikultures`
--

INSERT INTO `market_agrikultures` (`id`, `id_admin`, `nama_toko`, `status_buka`, `longitude`, `latitude`, `created_at`, `updated_at`) VALUES
(1, 5, 'sumber mundur', 'buka', '114.15837799414061', '-8.438584469758318', '2023-10-20 21:07:57', '2023-10-20 21:07:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_16_025358_create_admins_table', 1),
(6, '2023_10_16_025457_create_customers_table', 1),
(7, '2023_10_16_025556_create_kosts_table', 1),
(8, '2023_10_16_025639_create_kamar_kosts_table', 1),
(9, '2023_10_16_025734_create_hotels_table', 1),
(10, '2023_10_16_030833_create_kamar_hotels_table', 1),
(11, '2023_10_16_030951_create_detail_kamar_hotels_table', 1),
(12, '2023_10_16_031117_create_events_table', 1),
(13, '2023_10_16_031203_create_detail_events_table', 1),
(14, '2023_10_16_031243_create_festivals_table', 1),
(15, '2023_10_16_031319_create_detail_festivals_table', 1),
(16, '2023_10_16_031540_create_wisatas_table', 1),
(17, '2023_10_16_031617_create_detail_wisatas_table', 1),
(18, '2023_10_16_032154_create_market_agrikultures_table', 1),
(19, '2023_10_16_032259_create_produk_agrikultures_table', 1),
(20, '2023_10_16_032332_create_detail_market_agrikultures_table', 1),
(21, '2023_10_16_033044_create_transaksi_agrikultures_table', 1),
(22, '2023_10_16_033238_create_produk_koperasis_table', 1),
(23, '2023_10_16_033406_create_transaksi_koperasis_table', 1),
(24, '2023_10_16_042817_create_favorit_agrikultures_table', 1),
(25, '2023_10_16_043609_create_favorit_koperasis_table', 1),
(26, '2023_10_18_111339_create_saldos_table', 2),
(27, '2023_10_18_111955_create_transaksi_top_ups_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_agrikultures`
--

CREATE TABLE `produk_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_market` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jenis_produk` varchar(255) NOT NULL,
  `harga_produk` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk_agrikultures`
--

INSERT INTO `produk_agrikultures` (`id`, `id_market`, `nama_produk`, `jenis_produk`, `harga_produk`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'wortel', 'Sayur', '10000', 'wortel.jpg', '1', '2023-10-20 21:34:14', '2023-10-20 21:34:14'),
(4, 1, 'apel', 'Buah', '15000', 'apel.jpg', '1', '2023-10-20 21:34:39', '2023-10-20 21:34:39'),
(5, 1, 'Timun', 'Sayur', '2000', 'timun.jpg', '1', '2023-10-20 21:35:35', '2023-10-20 21:35:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_koperasis`
--

CREATE TABLE `produk_koperasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `kategori_produk` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `warna` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldos`
--

CREATE TABLE `saldos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `nominal_saldo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_agrikultures`
--

CREATE TABLE `transaksi_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk_agrikulture` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `jenis_pembayaran` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `status_pemesanan` varchar(255) NOT NULL,
  `status_pembayaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_koperasis`
--

CREATE TABLE `transaksi_koperasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk_koperasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `jenis_pembayaran` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `status_pemesanan` varchar(255) NOT NULL,
  `status_pembayaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_top_ups`
--

CREATE TABLE `transaksi_top_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal_topup` date NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pin` varchar(11) DEFAULT NULL,
  `nid_unmer` varchar(100) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_partner` varchar(100) DEFAULT 'non_partner',
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `pin`, `nid_unmer`, `no_telp`, `otp`, `role`, `status`, `status_partner`, `longitude`, `latitude`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'andyfebri742@gmail.com', NULL, '$2y$10$3F7jQoWrorknEYX5oUR.tOXLNls8TjsxOMxSBEVvkbLsBe78kdUN.', NULL, '000000', NULL, NULL, 'superadmin', '1', 'non_partner', NULL, NULL, NULL, '2023-10-17 04:44:12', '2023-10-20 20:09:20'),
(5, 'andyfebri999@gmail.com', NULL, '$2y$10$YS0fSvqekQ2HlGjvmmrmW.72jSBzCceobQ9Ui9yG34EEWoz7aCmRy', NULL, '3232323', '085245677312', NULL, 'admin', '1', 'non_partner', NULL, NULL, NULL, '2023-10-18 21:25:56', '2023-10-18 21:25:56'),
(6, 'anam@gmail.com', NULL, '$2y$10$6tvxfLQWaF5RjIPqXJ/8uujzf7fkWh/m9vzqIxGHh2ZIxKNrU6wy6', NULL, '222222', '085245677312', NULL, 'admin', '1', 'non_partner', NULL, NULL, NULL, '2023-10-19 01:01:25', '2023-10-19 01:01:25'),
(8, 'andyfebri99@gmail.com', NULL, '$2y$10$tQQV8ITB2MG1SeXrzQvTb.X9OANICxr4rCpi6P2pTYNSK2RtlDc1C', NULL, '323123', '085245677312', NULL, 'admin', '1', 'non_partner', NULL, NULL, NULL, '2023-10-19 23:44:44', '2023-10-19 23:44:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisatas`
--

CREATE TABLE `wisatas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_tempat_wisata` varchar(255) NOT NULL,
  `Deskripsi` text NOT NULL,
  `htm_wisata` int(11) NOT NULL,
  `hari_operasional_awal` varchar(255) NOT NULL,
  `hari_operasional_akhir` varchar(255) NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_events`
--
ALTER TABLE `detail_events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_festivals`
--
ALTER TABLE `detail_festivals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_kamar_hotels`
--
ALTER TABLE `detail_kamar_hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_market_agrikultures`
--
ALTER TABLE `detail_market_agrikultures`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_wisatas`
--
ALTER TABLE `detail_wisatas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `favorit_agrikultures`
--
ALTER TABLE `favorit_agrikultures`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `favorit_koperasis`
--
ALTER TABLE `favorit_koperasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `festivals`
--
ALTER TABLE `festivals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kamar_hotels`
--
ALTER TABLE `kamar_hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kamar_kosts`
--
ALTER TABLE `kamar_kosts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kosts`
--
ALTER TABLE `kosts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `market_agrikultures`
--
ALTER TABLE `market_agrikultures`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `produk_agrikultures`
--
ALTER TABLE `produk_agrikultures`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk_koperasis`
--
ALTER TABLE `produk_koperasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `saldos`
--
ALTER TABLE `saldos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_agrikultures`
--
ALTER TABLE `transaksi_agrikultures`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_koperasis`
--
ALTER TABLE `transaksi_koperasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_top_ups`
--
ALTER TABLE `transaksi_top_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `wisatas`
--
ALTER TABLE `wisatas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_events`
--
ALTER TABLE `detail_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_festivals`
--
ALTER TABLE `detail_festivals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_kamar_hotels`
--
ALTER TABLE `detail_kamar_hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_market_agrikultures`
--
ALTER TABLE `detail_market_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_wisatas`
--
ALTER TABLE `detail_wisatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `favorit_agrikultures`
--
ALTER TABLE `favorit_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `favorit_koperasis`
--
ALTER TABLE `favorit_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `festivals`
--
ALTER TABLE `festivals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kamar_hotels`
--
ALTER TABLE `kamar_hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kamar_kosts`
--
ALTER TABLE `kamar_kosts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kosts`
--
ALTER TABLE `kosts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `market_agrikultures`
--
ALTER TABLE `market_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk_agrikultures`
--
ALTER TABLE `produk_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `produk_koperasis`
--
ALTER TABLE `produk_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `saldos`
--
ALTER TABLE `saldos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_agrikultures`
--
ALTER TABLE `transaksi_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_koperasis`
--
ALTER TABLE `transaksi_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_top_ups`
--
ALTER TABLE `transaksi_top_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `wisatas`
--
ALTER TABLE `wisatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
