-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jan 2024 pada 04.24
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
  `saldo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `id_user`, `nama`, `nik`, `tempat_lahir`, `tanggal_lahir`, `status`, `role_admin`, `saldo`, `created_at`, `updated_at`) VALUES
(10, 14, 'Dono Pradono', '35100114029900092', 'BWI', '2023-10-18', 'Aktif', 'Admin Pendidikan', 0, '2023-10-26 03:49:49', '2023-10-26 03:49:49'),
(11, 15, 'Suherman', '35100114029900092', 'BWI', '2023-10-09', 'Aktif', 'Admin Event', 0, '2023-10-26 03:50:17', '2023-10-26 03:50:17'),
(12, 16, 'Andy Ferbiantoro', '3510011402990001', 'BWI', '2023-10-16', 'Aktif', 'Admin Penginapan', 0, '2023-10-26 06:40:21', '2023-10-26 06:40:21'),
(13, 18, 'Dono Pradono', '3510011402990003', 'Banyuwangi', '2023-11-07', 'Aktif', 'Admin Kasir', 310000, '2023-11-06 19:25:53', '2023-11-29 03:10:31'),
(14, 2, 'Super Admin', '111111', 'bwi', '2000-11-01', 'Aktif', 'superadmin', 156000, NULL, '2023-11-28 03:50:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(255) NOT NULL,
  `rekening` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banks`
--

INSERT INTO `banks` (`id`, `bank`, `rekening`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'BCA', '1234-1001-2021', 'bca.png', NULL, NULL),
(2, 'BRI', '1234-1002-2022', 'bri.png', NULL, NULL),
(3, 'BNI', '1234-1003-2023', 'bni.png', NULL, NULL),
(4, 'MANDIRI', '1234-1004-2024', 'mandiri.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_layanans`
--

CREATE TABLE `biaya_layanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `biaya_layanan` int(11) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `kategori_layanan` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `biaya_layanans`
--

INSERT INTO `biaya_layanans` (`id`, `biaya_layanan`, `ongkir`, `kategori_layanan`, `created_at`, `updated_at`) VALUES
(9, 5000, 3000, 'agrikulture', '2023-11-17 08:01:53', '2023-11-19 11:59:38'),
(10, 5000, 3000, 'koperasi', '2023-11-29 03:15:56', '2023-11-29 03:15:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `broadcasts`
--

CREATE TABLE `broadcasts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user_pengirim` int(11) NOT NULL,
  `isi_pesan` text NOT NULL,
  `status_pesan` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `broadcasts`
--

INSERT INTO `broadcasts` (`id`, `id_user_pengirim`, `isi_pesan`, `status_pesan`, `created_at`, `updated_at`) VALUES
(4, 2, 'hallo', '1', '2023-10-25 21:01:46', '2023-10-25 21:01:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL DEFAULT '0',
  `jenis_kelamin` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_partner` varchar(100) NOT NULL DEFAULT 'non_partner',
  `saldo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `id_user`, `nama`, `nik`, `jenis_kelamin`, `alamat`, `status`, `status_partner`, `saldo`, `created_at`, `updated_at`) VALUES
(1, 9, 'eggi maretino', '123456678', 'L', 'pesanggaran', '1', 'partner', 0, NULL, NULL),
(2, 10, 'Egga Maretiyo', '123142114123', 'L', 'Pesanggaran', '1', 'non_partner', 0, NULL, NULL),
(19, 19, 'anamsa', '35100224', NULL, 'banyuwangi', '1', 'non_partner', 125000, '2023-11-19 06:09:01', '2023-11-28 03:36:37'),
(25, 28, 'Ferdy', '0', NULL, 'kekeke', '1', 'non_partner', 99949999, '2023-11-22 07:28:09', '2023-11-22 07:37:44'),
(26, 29, 'anam123', '0', NULL, NULL, '1', 'non_partner', 0, '2023-11-26 16:03:50', '2023-11-26 16:03:50'),
(27, 30, 'Mahfudz Khoirun Nizam', '0', NULL, NULL, '1', 'non_partner', 200000, '2023-11-26 16:04:44', '2023-11-28 03:50:01'),
(28, 31, 'Andy Cuyy', '0', NULL, 'pesanggaran', '1', 'non_partner', 202000, '2023-11-28 03:05:10', '2023-11-29 03:00:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_broadcasts`
--

CREATE TABLE `detail_broadcasts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_broadcast` int(11) NOT NULL,
  `id_user_penerima` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_broadcasts`
--

INSERT INTO `detail_broadcasts` (`id`, `id_broadcast`, `id_user_penerima`, `created_at`, `updated_at`) VALUES
(1, 4, 10, '2023-10-25 21:01:46', '2023-10-25 21:01:46'),
(2, 4, 9, '2023-10-25 21:01:46', '2023-10-25 21:01:46');

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
  `waktu_pengiriman` varchar(50) NOT NULL,
  `jam_pengiriman_awal` time NOT NULL,
  `jam_pengiriman_akhir` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_market_agrikultures`
--

INSERT INTO `detail_market_agrikultures` (`id`, `waktu_pengiriman`, `jam_pengiriman_awal`, `jam_pengiriman_akhir`, `created_at`, `updated_at`) VALUES
(1, 'Pagi', '06:00:00', '09:00:00', NULL, NULL),
(2, 'Siang', '11:00:00', '14:00:00', NULL, NULL),
(3, 'Sore', '16:00:00', '18:00:00', NULL, NULL),
(4, 'Malam', '20:00:00', '21:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_agrikultures`
--

CREATE TABLE `detail_transaksi_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi_agrikulture` int(11) DEFAULT NULL,
  `id_transaksi_agrikulture_offline` int(11) DEFAULT NULL,
  `id_produk_agrikulture` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksi_agrikultures`
--

INSERT INTO `detail_transaksi_agrikultures` (`id`, `id_transaksi_agrikulture`, `id_transaksi_agrikulture_offline`, `id_produk_agrikulture`, `kuantitas`, `total`, `created_at`, `updated_at`) VALUES
(42, 6, NULL, 8, 1, 10000, '2023-11-21 08:10:37', '2023-11-21 08:10:37'),
(43, 6, NULL, 10, 1, 20000, '2023-11-21 08:10:37', '2023-11-21 08:10:37'),
(44, 7, NULL, 15, 1, 15000, '2023-11-21 08:10:48', '2023-11-21 08:10:48'),
(45, 8, NULL, 10, 1, 20000, '2023-11-21 08:11:24', '2023-11-21 08:11:24'),
(46, 9, NULL, 8, 1, 10000, '2023-11-22 07:37:44', '2023-11-22 07:37:44'),
(47, 9, NULL, 10, 1, 20000, '2023-11-22 07:37:44', '2023-11-22 07:37:44'),
(48, 9, NULL, 15, 1, 15000, '2023-11-22 07:37:44', '2023-11-22 07:37:44'),
(49, 9, NULL, 16, 1, 5000, '2023-11-22 07:37:44', '2023-11-22 07:37:44'),
(50, NULL, 5, 8, 1, 10000, '2023-11-23 08:25:56', '2023-11-23 08:25:56'),
(51, 10, NULL, 17, 1, 20000, '2023-11-29 03:00:32', '2023-11-29 03:00:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_koperasis`
--

CREATE TABLE `detail_transaksi_koperasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi_koperasi` int(11) DEFAULT NULL,
  `id_transaksi_koperasi_offline` int(11) DEFAULT NULL,
  `id_produk_koperasi` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksi_koperasis`
--

INSERT INTO `detail_transaksi_koperasis` (`id`, `id_transaksi_koperasi`, `id_transaksi_koperasi_offline`, `id_produk_koperasi`, `kuantitas`, `total_harga`, `size`, `warna`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 51, 2, 0, NULL, NULL, NULL, NULL),
(2, 1, NULL, 52, 1, 0, NULL, NULL, NULL, NULL),
(3, NULL, 5, 55, 1, 300000, NULL, NULL, '2023-11-21 03:32:00', '2023-11-21 03:32:00'),
(4, NULL, 5, 54, 2, 300000, 'L', 'Kuning', '2023-11-21 03:32:00', '2023-11-21 03:32:00'),
(5, NULL, 5, 54, 1, 150000, 'S', 'Putih', '2023-11-21 03:32:00', '2023-11-21 03:32:00'),
(6, NULL, 6, 57, 2, 200000, 'XS', 'Hitam', '2023-11-29 03:10:31', '2023-11-29 03:10:31'),
(7, NULL, 6, 57, 1, 100000, 'S', 'Hitam', '2023-11-29 03:10:31', '2023-11-29 03:10:31');

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
-- Struktur dari tabel `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `foto_event` varchar(255) DEFAULT NULL,
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
-- Struktur dari tabel `kategori_produk_agrikultures`
--

CREATE TABLE `kategori_produk_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_produk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_produk_agrikultures`
--

INSERT INTO `kategori_produk_agrikultures` (`id`, `kategori_produk`, `created_at`, `updated_at`) VALUES
(1, 'Buah', NULL, NULL),
(2, 'Sayur', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk_koperasis`
--

CREATE TABLE `kategori_produk_koperasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_produk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_produk_koperasis`
--

INSERT INTO `kategori_produk_koperasis` (`id`, `kategori_produk`, `created_at`, `updated_at`) VALUES
(1, 'Pakaian', NULL, NULL),
(2, 'Aksesoris', NULL, NULL),
(3, 'Perabot', NULL, NULL),
(4, 'Camilan', NULL, NULL),
(5, 'Sport', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk_agrikulture` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keranjangs`
--

INSERT INTO `keranjangs` (`id`, `id_user`, `id_produk_agrikulture`, `kuantitas`, `harga`, `created_at`, `updated_at`) VALUES
(27, 25, 16, 1, NULL, '2023-11-24 03:08:03', '2023-11-24 03:08:03'),
(28, 25, 15, 1, NULL, '2023-11-24 03:08:05', '2023-11-24 03:08:05'),
(29, 25, 10, 1, NULL, '2023-11-24 03:08:12', '2023-11-24 03:08:12'),
(30, 30, 15, 1, NULL, '2023-11-26 16:44:13', '2023-11-26 16:44:13'),
(32, 19, 17, 1, NULL, '2023-11-29 02:59:56', '2023-11-29 02:59:56'),
(33, 19, 16, 1, NULL, '2023-11-30 02:40:24', '2023-11-30 02:40:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang_koperasi_offlines`
--

CREATE TABLE `keranjang_koperasi_offlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user_admin_kasir` int(11) NOT NULL,
  `id_produk_koperasi` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `warna` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang_offlines`
--

CREATE TABLE `keranjang_offlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user_admin_kasir` int(11) NOT NULL,
  `id_market` int(11) NOT NULL,
  `id_produk_agrikulture` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keranjang_offlines`
--

INSERT INTO `keranjang_offlines` (`id`, `id_user_admin_kasir`, `id_market`, `id_produk_agrikulture`, `kuantitas`, `total_harga`, `created_at`, `updated_at`) VALUES
(49, 18, 4, 16, 3, 5000, '2023-12-04 09:04:50', '2023-12-12 09:04:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak_bantuans`
--

CREATE TABLE `kontak_bantuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kontak_bantuans`
--

INSERT INTO `kontak_bantuans` (`id`, `no_telp`, `created_at`, `updated_at`) VALUES
(3, '6285186680098', '2023-11-23 04:40:41', '2023-11-28 04:17:23');

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
-- Struktur dari tabel `list_sizes`
--

CREATE TABLE `list_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `list_sizes`
--

INSERT INTO `list_sizes` (`id`, `size`, `created_at`, `updated_at`) VALUES
(1, 'XS', NULL, NULL),
(2, 'S', NULL, NULL),
(3, 'M', NULL, NULL),
(4, 'L', NULL, NULL),
(5, 'XL', NULL, NULL),
(6, 'XXL', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_warnas`
--

CREATE TABLE `list_warnas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warna` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `list_warnas`
--

INSERT INTO `list_warnas` (`id`, `warna`, `created_at`, `updated_at`) VALUES
(1, 'Hitam', NULL, NULL),
(2, 'Putih', NULL, NULL),
(3, 'Kuning', NULL, NULL),
(4, 'Merah', NULL, NULL),
(5, 'Biru', NULL, NULL),
(6, 'Hijau', NULL, NULL),
(7, 'Cokelat', NULL, NULL),
(8, 'Ungu', NULL, NULL),
(9, 'Orange', NULL, NULL);

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
(4, 13, 'sumber mundur', 'buka', '113.88209684501402', '-8.383711103129833', '2023-10-26 05:27:27', '2023-10-26 05:57:23'),
(8, 13, 'Jaya Abadi', 'buka', '114.09604939308305', '-8.565095623881279', '2023-11-16 14:55:22', '2023-11-29 02:58:07');

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
(27, '2023_10_18_111955_create_transaksi_top_ups_table', 2),
(28, '2023_10_21_104729_create_detail_transaksi_agrikultures_table', 3),
(29, '2023_10_22_004838_create_sizes_table', 4),
(30, '2023_10_22_005205_create_warnas_table', 4),
(31, '2023_10_24_080711_create_kategori_produk_agrikultures_table', 5),
(32, '2023_10_24_082200_create_kategori_produk_koperasis_table', 5),
(33, '2023_10_25_062425_create_list_sizes_table', 6),
(34, '2023_10_25_062607_create_list_warnas_table', 6),
(35, '2023_10_25_083457_create_broadcasts_table', 7),
(36, '2023_10_26_034341_create_detail_broadcasts_table', 8),
(37, '2023_10_31_072936_create_detail_transaksi_koperasis_table', 9),
(38, '2023_10_22_071256_create_keranjangs_table', 10),
(39, '2023_11_01_091209_create_keranjangs_table', 11),
(40, '2023_11_07_032909_create_keranjang_offlines_table', 12),
(41, '2023_11_07_075001_create_transaksi_agrikuluture_offlines_table', 13),
(42, '2023_11_07_075001_create_transaksi_agrikulture_offlines_table', 14),
(43, '2023_11_14_061952_create_banks_table', 14),
(44, '2023_11_12_114200_create_banks_table', 15),
(45, '2023_11_16_145448_create_biaya_layanans_table', 15),
(46, '2023_11_20_141715_create_keranjang_koperasi_offlines_table', 16),
(47, '2023_11_20_142901_create_transaksi_koperasi_offlines_table', 17),
(48, '2023_11_23_101743_create_status_menus_table', 18),
(49, '2023_11_23_102244_create_kontak_bantuans_table', 19),
(50, '2023_11_23_144233_create_transaksi_kirim_saldos_table', 20),
(51, '2023_12_05_194122_create_drivers_table', 20),
(52, '2024_01_03_161543_create_tiket_events_table', 20),
(53, '2024_01_03_194523_create_panitia_events_table', 20);

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
  `kode_produk` varchar(100) NOT NULL,
  `kategori_produk` varchar(255) NOT NULL,
  `harga_produk` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk_agrikultures`
--

INSERT INTO `produk_agrikultures` (`id`, `id_market`, `nama_produk`, `kode_produk`, `kategori_produk`, `harga_produk`, `foto`, `status`, `stok`, `sold`, `created_at`, `updated_at`) VALUES
(8, 4, 'Wortel', '3221973871', 'Sayur', '10000', 'wortel.jpg', '1', 0, 13, '2023-10-27 18:56:40', '2023-11-23 08:25:56'),
(10, 4, 'Apel', '9448777343', 'Buah', '20000', 'apel.jpg', '1', 16, 7, '2023-10-29 20:45:24', '2023-11-17 08:52:44'),
(15, 4, 'kol', '9316462568', 'Sayur', '15000', 'kol.jpg', '1', 19, NULL, '2023-11-16 10:27:27', '2023-11-16 10:53:54'),
(16, 4, 'Timun Renes', '2669266588', 'Sayur', '5000', 'timun.jpg', '1', 20, NULL, '2023-11-16 11:11:14', '2023-11-17 08:06:20'),
(17, 8, 'Timun', '-792294533', 'Sayur', '20000', '095405600_1460032684-087708400_1426677006-timun.jpg', '1', 5, NULL, '2023-11-19 07:43:54', '2023-11-21 03:28:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_koperasis`
--

CREATE TABLE `produk_koperasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_partner` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `kategori_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk_koperasis`
--

INSERT INTO `produk_koperasis` (`id`, `id_admin`, `id_partner`, `nama_produk`, `deskripsi_produk`, `kode_produk`, `kategori_produk`, `harga`, `stok`, `sold`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(53, 13, 1, 'kaos Distro', 'Kualitas bahan super bagus', '66915', 'Pakaian', 75000, 20, 0, 'kaos.jpg', NULL, '2023-11-21 03:22:55', '2023-11-21 03:22:55'),
(58, 13, 1, 'hoodie', 'hoodie tebal', '22354', 'Pakaian', 150000, 52, 0, 'hoodie.jpg', NULL, '2023-12-01 10:03:10', '2023-12-12 09:20:23');

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
-- Struktur dari tabel `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk_koperasi` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sizes`
--

INSERT INTO `sizes` (`id`, `id_produk_koperasi`, `size`, `created_at`, `updated_at`) VALUES
(47, 53, 'XS', '2023-11-21 03:22:55', '2023-11-21 03:22:55'),
(48, 53, 'S', '2023-11-21 03:22:55', '2023-11-21 03:22:55'),
(49, 53, 'M', '2023-11-21 03:22:55', '2023-11-21 03:22:55'),
(58, 58, 'S', '2023-12-01 10:03:10', '2023-12-01 10:03:10'),
(59, 58, 'M', '2023-12-01 10:03:10', '2023-12-01 10:03:10'),
(60, 58, 'L', '2023-12-01 10:03:10', '2023-12-01 10:03:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_menus`
--

CREATE TABLE `status_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_menus`
--

INSERT INTO `status_menus` (`id`, `menu`, `status`, `created_at`, `updated_at`) VALUES
(1, 'agrikulture', 'aktif', NULL, '2023-11-28 04:10:13'),
(2, 'koperasi', 'nonaktif', NULL, '2023-11-23 03:54:14'),
(3, 'penginapan', 'nonaktif', NULL, '2023-11-23 03:51:38'),
(4, 'event', 'nonaktif', NULL, '2023-11-23 04:40:17'),
(5, 'wisata', 'nonaktif', NULL, '2023-11-23 03:57:33'),
(6, 'pendidikan', 'nonaktif', NULL, '2023-11-23 03:57:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket_events`
--

CREATE TABLE `tiket_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_event` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `foto_tiket` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_agrikultures`
--

CREATE TABLE `transaksi_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_market_agrikulture` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `waktu_pengiriman` varchar(20) DEFAULT NULL,
  `tanggal_pengiriman` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `status_pemesanan` varchar(255) NOT NULL,
  `status_pembayaran` varchar(255) NOT NULL,
  `metode_pengiriman` varchar(30) NOT NULL,
  `kode_transaksi` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_agrikultures`
--

INSERT INTO `transaksi_agrikultures` (`id`, `id_market_agrikulture`, `id_user`, `nominal`, `catatan`, `waktu_pengiriman`, `tanggal_pengiriman`, `alamat`, `status_pemesanan`, `status_pembayaran`, `metode_pengiriman`, `kode_transaksi`, `created_at`, `updated_at`) VALUES
(6, 4, 25, 30000, 'tt', 'pagi', '2023-11-22', 'pesanggaran, rt rw cari sendiri', 'dikemas', 'sukses', 'diantar', 'MGWOBTM5', '2023-11-21 08:10:37', '2023-11-21 08:10:37'),
(7, 4, 19, 15000, '-', 'pagi', '2023-11-23', 'bwu', 'dikemas', 'sukses', 'diantar', 'YN6KQOQ3', '2023-11-21 08:10:48', '2023-11-21 08:10:48'),
(8, 4, 19, 20000, 'smms', 'sore', '2023-11-24', 'bwu', 'dikemas', 'sukses', 'diantar', '9EMLZUAA', '2023-11-21 08:11:24', '2023-11-21 08:11:24'),
(9, 4, 28, 50000, NULL, 'pagi', '2023-11-23', 'kekeke', 'diantar', 'sukses', 'diantar', 'ABSTULPH', '2023-11-22 07:37:44', '2023-11-22 07:37:44'),
(10, 8, 31, 20000, 'yaagaga', 'siang', '2023-11-30', 'pesanggaran', 'dikemas', 'sukses', 'diantar', 'M4TMJNG3', '2023-11-29 03:00:32', '2023-11-29 03:00:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_agrikulture_offlines`
--

CREATE TABLE `transaksi_agrikulture_offlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user_admin_kasir` int(11) NOT NULL,
  `id_market_agrikulture` int(11) NOT NULL,
  `nominal_barang` int(11) NOT NULL,
  `nominal_bayar` int(11) NOT NULL,
  `nominal_kembalian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_agrikulture_offlines`
--

INSERT INTO `transaksi_agrikulture_offlines` (`id`, `id_user_admin_kasir`, `id_market_agrikulture`, `nominal_barang`, `nominal_bayar`, `nominal_kembalian`, `created_at`, `updated_at`) VALUES
(2, 18, 4, 60000, 100000, 40000, '2023-11-17 08:52:44', '2023-11-17 08:52:44'),
(3, 18, 4, 10000, 20000, 10000, '2023-11-19 06:47:02', '2023-11-19 06:47:02'),
(4, 18, 4, 10000, 20000, 10000, '2023-11-21 03:13:26', '2023-11-21 03:13:26'),
(5, 18, 4, 10000, 20000, 10000, '2023-11-23 08:25:56', '2023-11-23 08:25:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_kirim_saldos`
--

CREATE TABLE `transaksi_kirim_saldos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user_pengirim` int(11) NOT NULL,
  `id_user_penerima` int(11) DEFAULT NULL,
  `id_unmer_penerima` varchar(255) DEFAULT NULL,
  `nominal_kirim` int(11) NOT NULL,
  `biaya_layanan` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `jenis_kirim_saldo` varchar(255) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `rekening_bank` varchar(255) DEFAULT NULL,
  `nama_penerima` varchar(50) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `kode_transaksi` varchar(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_kirim_saldos`
--

INSERT INTO `transaksi_kirim_saldos` (`id`, `id_user_pengirim`, `id_user_penerima`, `id_unmer_penerima`, `nominal_kirim`, `biaya_layanan`, `total`, `jenis_kirim_saldo`, `catatan`, `bank`, `rekening_bank`, `nama_penerima`, `status`, `kode_transaksi`, `created_at`, `updated_at`) VALUES
(15, 19, NULL, NULL, 200000, 5000, 205000, 'bank', '200ewu', 'BNI', '1213131364', 'aku', 'pending', 'SEW6FL', '2023-11-24 07:17:51', '2023-11-24 07:17:51'),
(20, 19, 30, '1234', 100000, 5000, 105000, 'sesama', NULL, NULL, NULL, NULL, 'berhasil', 'WS1XBC', '2023-11-24 08:08:23', '2023-11-24 08:08:23'),
(21, 19, NULL, NULL, 100000, 5000, 105000, 'bank', 'banke tf', 'BRI', '123568089', 'jun', 'berhasil', 'A3VZ9P', '2023-11-24 10:46:16', '2023-11-24 12:57:47'),
(22, 19, 30, '123', 50000, 5000, 55000, 'sesama', NULL, NULL, NULL, NULL, 'berhasil', 'FJQBJS', '2023-11-28 03:09:08', '2023-11-28 03:09:08'),
(24, 19, 30, '202', 50000, 5000, 55000, 'sesama', 'bh', NULL, NULL, NULL, 'berhasil', 'UTHABO', '2023-11-28 03:26:04', '2023-11-28 03:26:04'),
(25, 19, 19, '123', 200000, 5000, 205000, 'sesama', 'yuu', NULL, NULL, NULL, 'berhasil', 'QCORPG', '2023-11-28 03:36:37', '2023-11-28 03:36:37'),
(26, 31, 30, '222', 100000, 5000, 105000, 'sesama', 'yoi', NULL, NULL, NULL, 'berhasil', 'VS70IE', '2023-11-28 03:39:45', '2023-11-28 03:39:45'),
(27, 31, NULL, NULL, 100000, 5000, 105000, 'bank', 'bhghb', 'BCA', '89898989', 'rokim', 'berhasil', 'C03N0R', '2023-11-28 03:40:48', '2023-11-28 03:41:19'),
(28, 31, 30, '222', 100000, 5000, 105000, 'sesama', 'jhhahah', NULL, NULL, NULL, 'berhasil', 'A6CRYV', '2023-11-28 03:47:09', '2023-11-28 03:47:09'),
(29, 31, 30, '222', 100000, 5000, 105000, 'sesama', 'popopo', NULL, NULL, NULL, 'berhasil', 'ZZZEUS', '2023-11-28 03:48:24', '2023-11-28 03:48:24'),
(30, 31, 30, '222', 100000, 5000, 105000, 'sesama', 'qwes', NULL, NULL, NULL, 'berhasil', 'QZSWBB', '2023-11-28 03:50:01', '2023-11-28 03:50:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_koperasis`
--

CREATE TABLE `transaksi_koperasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `jenis_pembayaran` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `kode_transaksi` varchar(100) NOT NULL,
  `status_pemesanan` varchar(255) NOT NULL,
  `status_pembayaran` varchar(255) NOT NULL,
  `metode_pengiriman` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_koperasis`
--

INSERT INTO `transaksi_koperasis` (`id`, `id_user`, `nominal`, `jenis_pembayaran`, `catatan`, `kode_transaksi`, `status_pemesanan`, `status_pembayaran`, `metode_pengiriman`, `created_at`, `updated_at`) VALUES
(1, 10, 100000, '', 'segera dikirim', '2321232123', 'dikemas', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_koperasi_offlines`
--

CREATE TABLE `transaksi_koperasi_offlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user_admin_kasir` int(11) NOT NULL,
  `id_partner` int(11) NOT NULL,
  `nominal_barang` int(11) NOT NULL,
  `nominal_bayar` int(11) NOT NULL,
  `nominal_kembalian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_koperasi_offlines`
--

INSERT INTO `transaksi_koperasi_offlines` (`id`, `id_user_admin_kasir`, `id_partner`, `nominal_barang`, `nominal_bayar`, `nominal_kembalian`, `created_at`, `updated_at`) VALUES
(1, 18, 1, 300000, 400000, 100000, '2023-11-20 09:45:02', '2023-11-20 09:45:02'),
(2, 18, 1, 100000, 100000, 0, '2023-11-20 09:57:13', '2023-11-20 09:57:13'),
(3, 18, 1, 200000, 200000, 0, '2023-11-20 09:59:10', '2023-11-20 09:59:10'),
(4, 18, 1, 250000, 300000, 50000, '2023-11-20 14:00:15', '2023-11-20 14:00:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_top_ups`
--

CREATE TABLE `transaksi_top_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `logo_bank` varchar(255) DEFAULT NULL,
  `rekening` varchar(50) NOT NULL,
  `nominal` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `status_topup` varchar(100) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `timer_transfer` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_top_ups`
--

INSERT INTO `transaksi_top_ups` (`id`, `id_user`, `metode_pembayaran`, `logo_bank`, `rekening`, `nominal`, `total_bayar`, `bukti_transfer`, `status_topup`, `kode_transaksi`, `timer_transfer`, `created_at`, `updated_at`) VALUES
(12, 26, 'BCA', 'https://unmerapp.my.id/public/uploads/bank/bca.png', '1234-1001-2021', 100000, 102000, NULL, 'pending', 'J2DF3N', 1, '2023-11-21 07:30:14', '2023-11-21 07:30:14'),
(13, 26, 'BCA', 'https://unmerapp.my.id/public/uploads/bank/bca.png', '1234-1001-2021', 100000, 102000, NULL, 'pending', 'BQ5JB3', 1, '2023-11-21 07:30:15', '2023-11-21 07:30:15'),
(14, 26, 'BCA', 'https://unmerapp.my.id/public/uploads/bank/bca.png', '1234-1001-2021', 100000, 102000, NULL, 'pending', 'OEXHVH', 1, '2023-11-21 07:30:20', '2023-11-21 07:30:20'),
(15, 26, 'BNI', 'https://unmerapp.my.id/public/uploads/bank/bni.png', '1234-1003-2023', 100000, 102000, '1700551875.jpg', 'menunggu_konfirmasi', 'GPEKYU', 1, '2023-11-21 07:30:55', '2023-11-21 07:31:15'),
(16, 19, 'BRI', 'https://unmerapp.my.id/public/uploads/bank/bri.png', '1234-1002-2022', 200000, 202000, '1700551896.jpg', 'menunggu_konfirmasi', 'F9QZCM', 1, '2023-11-21 07:31:13', '2023-11-21 07:31:36'),
(17, 25, 'BRI', 'https://unmerapp.my.id/public/uploads/bank/bri.png', '1234-1002-2022', 100000, 102000, '1700551942.jpg', 'dikonfirmasi', 'G1HCUM', 1, '2023-11-21 07:32:02', '2023-11-21 07:42:16'),
(18, 26, 'BRI', 'https://unmerapp.my.id/public/uploads/bank/bri.png', '1234-1002-2022', 100000, 102000, NULL, 'menunggu_konfirmasi', 'PSVUAJ', 1, '2023-11-21 07:32:28', '2023-11-21 07:33:29'),
(19, 25, 'BRI', 'https://unmerapp.my.id/public/uploads/bank/bri.png', '1234-1002-2022', 200000, 202000, NULL, 'menunggu_konfirmasi', 'NWXMFD', 1, '2023-11-21 07:34:48', '2023-11-21 07:35:49'),
(20, 25, 'MANDIRI', 'https://unmerapp.my.id/public/uploads/bank/mandiri.png', '1234-1004-2024', 200000, 202000, '1700552600.jpg', 'dikonfirmasi', 'JJVWAZ', 1, '2023-11-21 07:42:51', '2023-11-21 08:09:40'),
(21, 28, 'BCA', 'https://unmerapp.my.id/public/uploads/bank/bca.png', '1234-1001-2021', 100000, 102000, NULL, 'pending', 'NUU4PX', 1, '2023-11-22 07:34:55', '2023-11-22 07:34:55'),
(22, 28, 'BCA', 'https://unmerapp.my.id/public/uploads/bank/bca.png', '1234-1001-2021', 100000, 102000, NULL, 'batal', 'B32TL4', 1, '2023-11-22 07:35:12', '2023-11-22 07:36:13'),
(23, 28, 'MANDIRI', 'https://unmerapp.my.id/public/uploads/bank/mandiri.png', '1234-1004-2024', 400000, 402000, '1700638602.webp', 'menunggu_konfirmasi', '71MST5', 1, '2023-11-22 07:36:28', '2023-12-27 14:12:06'),
(24, 28, 'BCA', 'https://unmerapp.my.id/public/uploads/bank/bca.png', '1234-1001-2021', 100000, 102000, NULL, 'pending', 'YCYXKM', 1, '2023-11-22 07:39:06', '2023-11-22 07:39:06'),
(25, 31, 'BRI', 'https://unmerapp.my.id/public/uploads/bank/bri.png', '1234-1002-2022', 400000, 402000, '1701140765.jpg', 'dikonfirmasi', 'Z0UZQV', 5, '2023-11-28 03:05:50', '2023-11-28 03:06:18'),
(26, 19, 'BRI', 'https://unmerapp.my.id/public/uploads/bank/bri.png', '1234-1002-2022', 400000, 402000, '1701140906.jpg', 'dikonfirmasi', 'DPJ6CD', 5, '2023-11-28 03:07:55', '2023-11-28 03:08:36'),
(27, 31, 'BNI', 'https://unmerapp.my.id/public/uploads/bank/bni.png', '1234-1003-2023', 400000, 402000, '1701143120.jpg', 'dikonfirmasi', 'UXPC6C', 5, '2023-11-28 03:44:48', '2023-11-28 03:45:33');

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
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `foto` text NOT NULL DEFAULT 'default.jpg',
  `id_unmer` varchar(100) DEFAULT NULL,
  `no_unmer` varchar(160) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `pin`, `nid_unmer`, `no_telp`, `otp`, `role`, `status`, `longitude`, `latitude`, `foto`, `id_unmer`, `no_unmer`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'andyfebri742@gmail.com', NULL, '$2y$10$3F7jQoWrorknEYX5oUR.tOXLNls8TjsxOMxSBEVvkbLsBe78kdUN.', NULL, '000000', NULL, NULL, 'superadmin', '1', NULL, NULL, 'default.jpg', NULL, NULL, NULL, '2023-10-17 04:44:12', '2023-11-29 12:54:22'),
(9, 'eggi@gmail.com', NULL, '$2y$10$3F7jQoWrorknEYX5oUR.tOXLNls8TjsxOMxSBEVvkbLsBe78kdUN.', '111111', NULL, '085334770518', NULL, 'customer', '1', '113.88209684501402', '-8.383711103129833', 'default.jpg', NULL, NULL, NULL, NULL, NULL),
(10, 'egga_maretiyo@gmail.com', NULL, '$2y$10$3F7jQoWrorknEYX5oUR.tOXLNls8TjsxOMxSBEVvkbLsBe78kdUN.', '222222', NULL, '231323123', NULL, 'customer', '1', '113.88209684501402', '-8.383711103129833', 'default.jpg', NULL, NULL, NULL, NULL, NULL),
(15, 'suherman@gmail.com', NULL, '$2y$10$3F7jQoWrorknEYX5oUR.tOXLNls8TjsxOMxSBEVvkbLsBe78kdUN.', NULL, '444444', '085245677312', '913768', 'Admin Event', '1', NULL, NULL, 'default.jpg', NULL, NULL, NULL, '2023-10-26 03:50:17', '2024-01-03 13:17:47'),
(16, 'andyfebri@gmail.com', NULL, '$2y$10$C/47JCf363WhPfYyEnT9IuC6ciPoi2e8VXRPlOjiCwvoGqbNGrX2u', NULL, '111111', '085245677312', '', 'Admin Penginapan', '1', NULL, NULL, 'default.jpg', NULL, NULL, NULL, '2023-10-26 06:40:21', '2023-11-21 07:09:22'),
(18, 'dono@gmail.com', NULL, '$2y$10$sVBM2ZbgrxBmk7/G.Gs93.0rmKvuiJF5UardcloVxUJ1VD/bWr2e2', NULL, '333333', '085245677312', NULL, 'Admin Kasir', '1', NULL, NULL, 'default.jpg', NULL, NULL, NULL, '2023-11-06 19:25:53', '2023-11-06 19:25:53'),
(19, 'anam45188@gmail.com', NULL, NULL, NULL, NULL, '0833131', '', 'customer', '1', NULL, NULL, '1700386393.jpg', '123', '111122223334444', NULL, '2023-11-19 06:09:01', '2023-11-30 02:37:49'),
(28, 'm.fernandahardiyanto@gmail.com', NULL, NULL, NULL, NULL, '081334946903', '', 'customer', '1', NULL, NULL, 'default.jpg', NULL, NULL, NULL, '2023-11-22 07:28:09', '2023-11-22 07:30:45'),
(29, 'anam@gmail.com', NULL, NULL, NULL, NULL, '0822567181911', '3360', 'customer', '1', NULL, NULL, 'default.jpg', '8883996881089018', '2375689375', NULL, '2023-11-26 16:03:50', '2023-11-26 16:03:50'),
(30, 'mahfudzkhoirunnizam@gmail.com', NULL, NULL, NULL, NULL, '083853958171', '', 'customer', '1', NULL, NULL, 'default.jpg', '222', '2505614153', NULL, '2023-11-26 16:04:44', '2023-11-26 18:10:13'),
(31, 'andyfebri999@gmail.com', NULL, NULL, NULL, NULL, '085334770518', '', 'customer', '1', NULL, NULL, 'default.jpg', '111', '7999379249', NULL, '2023-11-28 03:05:10', '2023-11-28 04:09:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warnas`
--

CREATE TABLE `warnas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk_koperasi` int(11) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `warnas`
--

INSERT INTO `warnas` (`id`, `id_produk_koperasi`, `warna`, `created_at`, `updated_at`) VALUES
(20, 53, 'Hitam', '2023-11-21 03:22:55', '2023-11-21 03:22:55'),
(21, 53, 'Putih', '2023-11-21 03:22:55', '2023-11-21 03:22:55'),
(22, 53, 'Kuning', '2023-11-21 03:22:55', '2023-11-21 03:22:55'),
(28, 58, 'Hitam', '2023-12-01 10:03:10', '2023-12-01 10:03:10'),
(29, 58, 'Putih', '2023-12-01 10:03:10', '2023-12-01 10:03:10'),
(30, 58, 'Kuning', '2023-12-01 10:03:10', '2023-12-01 10:03:10');

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
-- Indeks untuk tabel `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `biaya_layanans`
--
ALTER TABLE `biaya_layanans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `broadcasts`
--
ALTER TABLE `broadcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_broadcasts`
--
ALTER TABLE `detail_broadcasts`
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
-- Indeks untuk tabel `detail_transaksi_agrikultures`
--
ALTER TABLE `detail_transaksi_agrikultures`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_transaksi_koperasis`
--
ALTER TABLE `detail_transaksi_koperasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_wisatas`
--
ALTER TABLE `detail_wisatas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `drivers`
--
ALTER TABLE `drivers`
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
-- Indeks untuk tabel `kategori_produk_agrikultures`
--
ALTER TABLE `kategori_produk_agrikultures`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_produk_koperasis`
--
ALTER TABLE `kategori_produk_koperasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang_koperasi_offlines`
--
ALTER TABLE `keranjang_koperasi_offlines`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang_offlines`
--
ALTER TABLE `keranjang_offlines`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kontak_bantuans`
--
ALTER TABLE `kontak_bantuans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kosts`
--
ALTER TABLE `kosts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `list_sizes`
--
ALTER TABLE `list_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `list_warnas`
--
ALTER TABLE `list_warnas`
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
-- Indeks untuk tabel `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status_menus`
--
ALTER TABLE `status_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tiket_events`
--
ALTER TABLE `tiket_events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_agrikultures`
--
ALTER TABLE `transaksi_agrikultures`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_agrikulture_offlines`
--
ALTER TABLE `transaksi_agrikulture_offlines`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_kirim_saldos`
--
ALTER TABLE `transaksi_kirim_saldos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_koperasis`
--
ALTER TABLE `transaksi_koperasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_koperasi_offlines`
--
ALTER TABLE `transaksi_koperasi_offlines`
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
-- Indeks untuk tabel `warnas`
--
ALTER TABLE `warnas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `biaya_layanans`
--
ALTER TABLE `biaya_layanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `broadcasts`
--
ALTER TABLE `broadcasts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `detail_broadcasts`
--
ALTER TABLE `detail_broadcasts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_agrikultures`
--
ALTER TABLE `detail_transaksi_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_koperasis`
--
ALTER TABLE `detail_transaksi_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `detail_wisatas`
--
ALTER TABLE `detail_wisatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `drivers`
--
ALTER TABLE `drivers`
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
-- AUTO_INCREMENT untuk tabel `kategori_produk_agrikultures`
--
ALTER TABLE `kategori_produk_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk_koperasis`
--
ALTER TABLE `kategori_produk_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `keranjang_koperasi_offlines`
--
ALTER TABLE `keranjang_koperasi_offlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `keranjang_offlines`
--
ALTER TABLE `keranjang_offlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `kontak_bantuans`
--
ALTER TABLE `kontak_bantuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kosts`
--
ALTER TABLE `kosts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `list_sizes`
--
ALTER TABLE `list_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `list_warnas`
--
ALTER TABLE `list_warnas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `market_agrikultures`
--
ALTER TABLE `market_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk_agrikultures`
--
ALTER TABLE `produk_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `produk_koperasis`
--
ALTER TABLE `produk_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `saldos`
--
ALTER TABLE `saldos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `status_menus`
--
ALTER TABLE `status_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tiket_events`
--
ALTER TABLE `tiket_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_agrikultures`
--
ALTER TABLE `transaksi_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi_agrikulture_offlines`
--
ALTER TABLE `transaksi_agrikulture_offlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi_kirim_saldos`
--
ALTER TABLE `transaksi_kirim_saldos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `transaksi_koperasis`
--
ALTER TABLE `transaksi_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_koperasi_offlines`
--
ALTER TABLE `transaksi_koperasi_offlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi_top_ups`
--
ALTER TABLE `transaksi_top_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `warnas`
--
ALTER TABLE `warnas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `wisatas`
--
ALTER TABLE `wisatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
