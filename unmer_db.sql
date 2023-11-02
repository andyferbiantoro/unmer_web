-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2023 pada 06.14
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
(9, 13, 'khoirul anam', '35100114029900092', 'BWI', '2023-10-02', 'Aktif', 'Admin Kasir', '2023-10-26 03:49:25', '2023-10-26 03:49:25'),
(10, 14, 'Dono Pradono', '35100114029900092', 'BWI', '2023-10-18', 'Aktif', 'Admin Pendidikan', '2023-10-26 03:49:49', '2023-10-26 03:49:49'),
(11, 15, 'Suherman', '35100114029900092', 'BWI', '2023-10-09', 'Aktif', 'Admin Event', '2023-10-26 03:50:17', '2023-10-26 03:50:17'),
(12, 16, 'Andy Ferbiantoro', '3510011402990001', 'BWI', '2023-10-16', 'Aktif', 'Admin Penginapan', '2023-10-26 06:40:21', '2023-10-26 06:40:21');

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
  `nik` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
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
(2, 10, 'Egga Maretiyo', '123142114123', 'L', 'Pesanggaran', '1', 'non_partner', 0, NULL, NULL);

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
  `id_market` int(11) NOT NULL,
  `jam_pengiriman_awal` int(11) NOT NULL,
  `jam_pengiriman_akhir` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_agrikultures`
--

CREATE TABLE `detail_transaksi_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi_agrikulture` int(11) NOT NULL,
  `id_produk_agrikulture` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksi_agrikultures`
--

INSERT INTO `detail_transaksi_agrikultures` (`id`, `id_transaksi_agrikulture`, `id_produk_agrikulture`, `kuantitas`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 3, NULL, NULL),
(2, 1, 9, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_koperasis`
--

CREATE TABLE `detail_transaksi_koperasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi_koperasi` int(11) NOT NULL,
  `id_produk_koperasi` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksi_koperasis`
--

INSERT INTO `detail_transaksi_koperasis` (`id`, `id_transaksi_koperasi`, `id_produk_koperasi`, `kuantitas`, `created_at`, `updated_at`) VALUES
(1, 1, 51, 2, NULL, NULL),
(2, 1, 52, 1, NULL, NULL);

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
  `harga` int(11) NOT NULL,
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
(4, 9, 'sumber mundur', 'buka', '113.88209684501402', '-8.383711103129833', '2023-10-26 05:27:27', '2023-10-26 05:57:23'),
(5, 9, 'Jaya Abadi', 'Buka', '114.34789215429686', '-8.12602222424488', '2023-10-29 20:54:01', '2023-10-29 20:54:01');

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
(39, '2023_11_01_091209_create_keranjangs_table', 11);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk_agrikultures`
--

INSERT INTO `produk_agrikultures` (`id`, `id_market`, `nama_produk`, `kode_produk`, `kategori_produk`, `harga_produk`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(8, 4, 'Wortel', '3221973871', 'Sayur', '10000', 'wortel.jpg', '1', '2023-10-27 18:56:40', '2023-10-28 05:00:05'),
(9, 4, 'Timun', '2021612852', 'Sayur', '10000', 'timun.jpg', '1', '2023-10-29 20:45:09', '2023-10-29 20:45:09'),
(10, 4, 'Apel', '9448777343', 'Buah', '20000', 'apel.jpg', '1', '2023-10-29 20:45:24', '2023-11-01 21:53:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_koperasis`
--

CREATE TABLE `produk_koperasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_partner` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
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

INSERT INTO `produk_koperasis` (`id`, `id_admin`, `id_partner`, `nama_produk`, `kode_produk`, `kategori_produk`, `harga`, `stok`, `sold`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(51, 9, 1, 'kaos', '6634595773', 'Pakaian', 50000, 12, 0, 'Screenshot_2.jpg', NULL, '2023-10-26 06:01:24', '2023-10-26 06:01:24'),
(52, 9, 1, 'hoodie', '6645895773', 'Pakaian', 100000, 12, 0, 'hoodie.jpg', NULL, '2023-10-27 18:58:54', '2023-10-27 18:58:54');

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
(13, 49, 'S', '2023-10-23 20:26:30', '2023-10-23 20:26:30'),
(14, 49, 'M', '2023-10-23 20:26:30', '2023-10-23 20:26:30'),
(15, 49, 'L', '2023-10-23 20:26:30', '2023-10-23 20:26:30'),
(16, 49, 'XL', '2023-10-23 20:26:30', '2023-10-23 20:26:30'),
(39, 50, 'M', '2023-10-25 01:00:12', '2023-10-25 01:00:12'),
(40, 50, 'L', '2023-10-25 01:00:12', '2023-10-25 01:00:12'),
(41, 50, 'XL', '2023-10-25 01:00:12', '2023-10-25 01:00:12'),
(42, 51, 'XS', '2023-10-26 06:01:24', '2023-10-26 06:01:24'),
(43, 51, 'S', '2023-10-26 06:01:24', '2023-10-26 06:01:24'),
(44, 51, 'M', '2023-10-26 06:01:24', '2023-10-26 06:01:24'),
(45, 52, 'XS', '2023-10-27 18:58:54', '2023-10-27 18:58:54'),
(46, 52, 'S', '2023-10-27 18:58:54', '2023-10-27 18:58:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_agrikultures`
--

CREATE TABLE `transaksi_agrikultures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_market_agrikulture` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `waktu_pengiriman` time DEFAULT NULL,
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
(1, 4, 9, 50000, 'dikemas yang rapi ya', NULL, NULL, NULL, 'dikemas', '1', '', '3287364718', NULL, NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_koperasis`
--

INSERT INTO `transaksi_koperasis` (`id`, `id_user`, `nominal`, `jenis_pembayaran`, `catatan`, `kode_transaksi`, `status_pemesanan`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 10, 100000, '', 'segera dikirim', '2321232123', 'dikemas', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_top_ups`
--

CREATE TABLE `transaksi_top_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `nominal` int(11) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `status_topup` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_top_ups`
--

INSERT INTO `transaksi_top_ups` (`id`, `id_user`, `metode_pembayaran`, `nominal`, `bukti_transfer`, `status_topup`, `created_at`, `updated_at`) VALUES
(2, 9, 'transfer', 200000, 'bukti.jpg', 'pending', '2023-11-01 08:34:33', '2023-11-01 01:47:48');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `pin`, `nid_unmer`, `no_telp`, `otp`, `role`, `status`, `longitude`, `latitude`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'andyfebri742@gmail.com', NULL, '$2y$10$3F7jQoWrorknEYX5oUR.tOXLNls8TjsxOMxSBEVvkbLsBe78kdUN.', NULL, '000000', NULL, NULL, 'superadmin', '1', NULL, NULL, NULL, '2023-10-17 04:44:12', '2023-10-25 02:13:41'),
(9, 'eggi@gmail.com', NULL, '$2y$10$3F7jQoWrorknEYX5oUR.tOXLNls8TjsxOMxSBEVvkbLsBe78kdUN.', '111111', NULL, '085334770518', NULL, 'customer', '1', NULL, NULL, NULL, NULL, NULL),
(10, 'egga_maretiyo@gmail.com', NULL, '$2y$10$3F7jQoWrorknEYX5oUR.tOXLNls8TjsxOMxSBEVvkbLsBe78kdUN.', '222222', NULL, '231323123', NULL, 'customer', '1', NULL, NULL, NULL, NULL, NULL),
(13, 'khoirulanam@gmail.com', NULL, '$2y$10$o7.OwKDVdmcVDrt5X0Aki.SIikxHDQ2osZAjVzlYN0ZpQT7I4CA1i', NULL, '222222', '085245677312', NULL, 'Admin Kasir', '1', NULL, NULL, NULL, '2023-10-26 03:49:25', '2023-10-26 03:49:25'),
(14, 'dono@gmail.com', NULL, '$2y$10$.dkuJv/0LEH10o1JYHoqX.7HNYPWM7bhVG5Z2fE4ja0syTKL3Fwr6', NULL, '333333', '085245677312', NULL, 'Admin Kasir', '1', NULL, NULL, NULL, '2023-10-26 03:49:49', '2023-10-26 03:49:49'),
(15, 'suherman@gmail.com', NULL, '$2y$10$3F7jQoWrorknEYX5oUR.tOXLNls8TjsxOMxSBEVvkbLsBe78kdUN.', NULL, '444444', '085245677312', NULL, 'Admin Event', '1', NULL, NULL, NULL, '2023-10-26 03:50:17', '2023-10-26 03:50:17'),
(16, 'andyfebri999@gmail.com', NULL, '$2y$10$C/47JCf363WhPfYyEnT9IuC6ciPoi2e8VXRPlOjiCwvoGqbNGrX2u', NULL, '111111', '085245677312', NULL, 'Admin Penginapan', '1', NULL, NULL, NULL, '2023-10-26 06:40:21', '2023-10-26 06:40:21');

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
(8, 50, 'Putih', '2023-10-25 01:04:26', '2023-10-25 01:04:26'),
(9, 50, 'Kuning', '2023-10-25 01:04:26', '2023-10-25 01:04:26'),
(10, 49, 'Hitam', '2023-10-25 01:25:54', '2023-10-25 01:25:54'),
(11, 49, 'Biru', '2023-10-25 01:25:54', '2023-10-25 01:25:54'),
(12, 49, 'Hijau', '2023-10-25 01:25:54', '2023-10-25 01:25:54'),
(15, 51, 'Putih', '2023-10-26 06:11:27', '2023-10-26 06:11:27'),
(16, 51, 'Kuning', '2023-10-26 06:11:27', '2023-10-26 06:11:27'),
(17, 51, 'Merah', '2023-10-26 06:11:27', '2023-10-26 06:11:27'),
(18, 52, 'Putih', '2023-10-27 18:58:54', '2023-10-27 18:58:54'),
(19, 52, 'Kuning', '2023-10-27 18:58:54', '2023-10-27 18:58:54');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `broadcasts`
--
ALTER TABLE `broadcasts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_agrikultures`
--
ALTER TABLE `detail_transaksi_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_koperasis`
--
ALTER TABLE `detail_transaksi_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk_agrikultures`
--
ALTER TABLE `produk_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `produk_koperasis`
--
ALTER TABLE `produk_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `saldos`
--
ALTER TABLE `saldos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `transaksi_agrikultures`
--
ALTER TABLE `transaksi_agrikultures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_koperasis`
--
ALTER TABLE `transaksi_koperasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_top_ups`
--
ALTER TABLE `transaksi_top_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `warnas`
--
ALTER TABLE `warnas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `wisatas`
--
ALTER TABLE `wisatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
