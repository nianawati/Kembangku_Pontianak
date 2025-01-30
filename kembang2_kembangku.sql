-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Jan 2025 pada 16.19
-- Versi server: 10.6.20-MariaDB-cll-lve
-- Versi PHP: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kembang2_kembangku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluars`
--

CREATE TABLE `barang_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_barang_keluar` int(11) NOT NULL,
  `total_harga` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_keluars`
--

INSERT INTO `barang_keluars` (`id`, `nama_barang`, `jumlah_barang`, `tanggal_keluar`, `id_barang`, `id_barang_keluar`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 'vas bunga', 1, '2025-01-11', 2, 1736588101, 25000, 'selesai', NULL, NULL),
(2, 'vas bunga', 1, '2025-01-21', 2, 1737467368, 25000, 'selesai', NULL, NULL),
(3, 'vas bunga', 1, '2025-01-21', 2, 1737469535, 25000, 'selesai', NULL, NULL),
(4, 'vas bunga', 1, '2025-01-23', 2, 1737673831, 25000, 'selesai', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuks`
--

CREATE TABLE `barang_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_barang` double NOT NULL,
  `tanggal_order` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_masuks`
--

INSERT INTO `barang_masuks` (`id`, `nama_barang`, `kategori`, `foto`, `jumlah_barang`, `harga_beli`, `harga_barang`, `tanggal_order`, `created_at`, `updated_at`) VALUES
(1, 'Keranjang', 'barang', '1736587995.jpg', 9, 5000, 10000, '2025-01-10', NULL, '2025-01-11 02:38:10'),
(2, 'vas bunga', 'barang', '1736588052.jpg', 1, 20000, 25000, '2025-01-10', NULL, '2025-01-23 16:10:31'),
(3, 'bloom box', 'barang', '1736725698.png', 5, 14000, 25000, '2025-01-10', NULL, '2025-01-12 16:48:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_rusaks`
--

CREATE TABLE `barang_rusaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `harga_barang` double NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tanggal_order` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_rusaks`
--

INSERT INTO `barang_rusaks` (`id`, `id_barang`, `nama_barang`, `jumlah_barang`, `harga_barang`, `kategori`, `tanggal_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Keranjang', 1, 10000, 'barang', '2025-01-11', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bunga_keluars`
--

CREATE TABLE `bunga_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bunga` varchar(255) NOT NULL,
  `jumlah_bunga` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_bunga` int(11) NOT NULL,
  `id_bunga_keluar` int(11) NOT NULL,
  `total_harga` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bunga_keluars`
--

INSERT INTO `bunga_keluars` (`id`, `nama_bunga`, `jumlah_bunga`, `tanggal_keluar`, `id_bunga`, `id_bunga_keluar`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Garbera Merah', 1, '2025-01-08', 12, 1736339426, 10000, 'selesai', NULL, NULL),
(2, 'Gompi Orange', 1, '2025-01-08', 15, 1736355457, 10000, 'selesai', NULL, NULL),
(3, 'Mawar Merah', 1, '2025-01-11', 19, 1736588101, 10000, 'selesai', NULL, NULL),
(4, 'Krisan Fiji', 1, '2025-01-21', 13, 1737455579, 10000, 'selesai', NULL, NULL),
(5, 'Krisan Putih', 1, '2025-01-21', 14, 1737455579, 10000, 'selesai', NULL, NULL),
(6, 'Garbera Merah', 1, '2025-01-21', 12, 1737455709, 10000, 'selesai', NULL, NULL),
(7, 'Krisan Putih', 1, '2025-01-21', 14, 1737455709, 10000, 'selesai', NULL, NULL),
(8, 'Krisan Fiji', 1, '2025-01-21', 13, 1737456451, 10000, 'selesai', NULL, NULL),
(9, 'Krisan Putih', 1, '2025-01-21', 14, 1737456451, 10000, 'selesai', NULL, NULL),
(10, 'Gompi Orange', 1, '2025-01-21', 15, 1737456451, 10000, 'selesai', NULL, NULL),
(11, 'Mawar Merah', 1, '2025-01-21', 19, 1737456467, 10000, 'selesai', NULL, NULL),
(12, 'Garbera Merah', 1, '2025-01-21', 12, 1737467368, 10000, 'selesai', NULL, NULL),
(13, 'Aster Kuning', 1, '2025-01-21', 16, 1737467368, 10000, 'selesai', NULL, NULL),
(14, 'Mawar Merah', 1, '2025-01-21', 19, 1737468642, 10000, 'selesai', NULL, NULL),
(15, 'Aster Kuning', 1, '2025-01-21', 16, 1737469535, 10000, 'selesai', NULL, NULL),
(16, 'Mawar Merah', 1, '2025-01-21', 19, 1737469535, 10000, 'selesai', NULL, NULL),
(17, 'Krisan Fiji', 1, '2025-01-23', 13, 1737660465, 10000, 'selesai', NULL, NULL),
(18, 'Krisan Fiji', 1, '2025-01-23', 13, 1737660473, 10000, 'selesai', NULL, NULL),
(19, 'Krisan Putih', 1, '2025-01-23', 14, 1737660529, 10000, 'selesai', NULL, NULL),
(20, 'Gompi Orange', 1, '2025-01-23', 15, 1737660529, 10000, 'selesai', NULL, NULL),
(21, 'Aster Kuning', 1, '2025-01-23', 16, 1737660529, 10000, 'selesai', NULL, NULL),
(22, 'Puma Ungu', 1, '2025-01-23', 18, 1737660529, 10000, 'selesai', NULL, NULL),
(23, 'Matahari', 1, '2025-01-23', 21, 1737660697, 25000, 'selesai', NULL, NULL),
(24, 'Aster Kuning', 1, '2025-01-23', 16, 1737660786, 10000, 'selesai', NULL, NULL),
(25, 'Krisan Putih', 1, '2025-01-23', 14, 1737673831, 10000, 'selesai', NULL, NULL),
(26, 'Puma Ungu', 1, '2025-01-23', 18, 1737673831, 10000, 'selesai', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bunga_masuks`
--

CREATE TABLE `bunga_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bunga` varchar(255) NOT NULL,
  `jumlah_bunga` int(11) NOT NULL,
  `harga_bunga` double NOT NULL,
  `harga_beli` double NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tanggal_order` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bunga_masuks`
--

INSERT INTO `bunga_masuks` (`id`, `nama_bunga`, `jumlah_bunga`, `harga_bunga`, `harga_beli`, `kategori`, `foto`, `tanggal_order`, `created_at`, `updated_at`) VALUES
(12, 'Garbera Merah', 12, 10000, 6500, 'bunga', '1735560500.jpg', '2025-01-05', NULL, '2025-01-23 06:15:12'),
(13, 'Krisan Fiji', 16, 10000, 6000, 'bunga', '1735548427.jpg', '2025-01-05', NULL, '2025-01-23 12:27:53'),
(14, 'Krisan Putih', 5, 10000, 5000, 'bunga', '1735548496.jpg', '2025-01-05', NULL, '2025-01-23 16:10:31'),
(15, 'Gompi Orange', 13, 10000, 6000, 'bunga', '1735548601.jpg', '2025-01-05', NULL, '2025-01-23 12:28:49'),
(16, 'Aster Kuning', 6, 10000, 7000, 'bunga', '1735548669.jpg', '2025-01-05', NULL, '2025-01-23 12:33:07'),
(18, 'Puma Ungu', 8, 10000, 8000, 'bunga', '1735548808.jpg', '2025-01-05', NULL, '2025-01-23 16:10:31'),
(19, 'Mawar Merah', 5, 10000, 6250, 'bunga', '1735549175.jpg', '2025-01-05', NULL, '2025-01-21 07:25:35'),
(21, 'Matahari', 9, 25000, 14000, 'bunga', '1735549256.jpg', '2025-01-05', NULL, '2025-01-23 12:31:37'),
(22, 'Hidrangea', 10, 17000, 8000, 'bunga', '1736877759.jpg', '2025-01-10', NULL, '2025-01-14 11:02:39'),
(23, 'Pikok Putih', 30, 5000, 2400, 'bunga', '1736877787.jpg', '2025-01-10', NULL, '2025-01-14 11:03:07'),
(24, 'lily', 5, 45000, 65000, 'bunga', '1736878406.jpg', '2025-01-10', NULL, '2025-01-14 11:13:26'),
(25, 'Sedap Malam', 10, 4000, 10000, 'bunga', '1736878385.jpg', '2025-01-10', NULL, '2025-01-14 11:13:05'),
(26, 'Daun Ruskus', 10, 5000, 1800, 'daun', '1736878158.jpg', '2025-01-10', NULL, '2025-01-14 11:09:18'),
(27, 'Daun Memusa', 5, 5000, 2000, 'daun', '1736878357.jpg', '2025-01-10', NULL, '2025-01-14 11:12:37'),
(28, 'Solidago', 5, 3000, 8000, 'bunga', '1736692920.jpg', '2025-01-10', NULL, NULL),
(29, 'Pikok Ungu', 30, 5000, 2250, 'bunga', '1736877867.jpg', '2025-01-10', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bunga_rusaks`
--

CREATE TABLE `bunga_rusaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bunga` int(11) NOT NULL,
  `nama_bunga` varchar(255) NOT NULL,
  `jumlah_bunga` int(11) NOT NULL,
  `harga_bunga` double NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tanggal_order` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bunga_rusaks`
--

INSERT INTO `bunga_rusaks` (`id`, `id_bunga`, `nama_bunga`, `jumlah_bunga`, `harga_bunga`, `kategori`, `tanggal_order`, `created_at`, `updated_at`) VALUES
(1, 19, 'Mawar Merah', 1, 10000, 'bunga', '2025-01-10', NULL, NULL),
(2, 12, 'Garbera Merah', 1, 10000, 'bunga', '2025-01-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
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
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bunga` int(11) NOT NULL,
  `jumlah_bunga_dijual` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `id_bunga`, `jumlah_bunga_dijual`, `created_at`, `updated_at`) VALUES
(31, 12, 0, NULL, '2025-01-21 06:49:28'),
(32, 13, 0, NULL, '2025-01-23 12:27:53'),
(33, 14, 0, NULL, '2025-01-23 16:10:31'),
(34, 15, 1, NULL, '2025-01-23 12:28:49'),
(35, 16, 1, NULL, '2025-01-23 12:33:07'),
(36, 18, 3, NULL, '2025-01-23 16:10:31'),
(37, 19, 1, NULL, '2025-01-21 07:25:35'),
(38, 20, 5, NULL, NULL),
(39, 21, 4, NULL, '2025-01-23 12:31:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `labas`
--

CREATE TABLE `labas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_pendapatan` double NOT NULL,
  `total_beli` double NOT NULL,
  `total_kerugian` double NOT NULL,
  `total_labaBersih` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2024_12_16_153423_create_users_table', 1),
(4, '2024_12_17_111037_create_bunga_masuks_table', 1),
(5, '2024_12_17_111110_create_bunga_keluars_table', 1),
(6, '2024_12_17_111139_create_pesanan_masuks_table', 1),
(7, '2024_12_17_111224_create_barang_keluars_table', 1),
(8, '2024_12_17_111308_create_produks_table', 1),
(9, '2024_12_17_111325_create_bunga_rusaks_table', 1),
(10, '2024_12_17_111335_create_barang_rusaks_table', 1),
(11, '2024_12_19_144429_create_barang_masuks_table', 1),
(12, '2024_12_20_162214_create_suppliers_table', 1),
(13, '2024_12_22_104303_create_units_table', 1),
(14, '2024_12_22_104534_create_kategoris_table', 1),
(15, '2024_12_28_115457_create_labas_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_masuks`
--

CREATE TABLE `pesanan_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pesanan` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `tanggal_pesanan` date NOT NULL,
  `status_pesanan` varchar(255) NOT NULL,
  `total_tagihan` double NOT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `id_bunga_keluar` int(11) NOT NULL,
  `id_barang_keluar` int(11) NOT NULL,
  `biaya_jasa` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pembayaran` double NOT NULL,
  `kembalian` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesanan_masuks`
--

INSERT INTO `pesanan_masuks` (`id`, `nama_pesanan`, `nama_produk`, `tanggal_pesanan`, `status_pesanan`, `total_tagihan`, `jumlah_pesanan`, `id_bunga_keluar`, `id_barang_keluar`, `biaya_jasa`, `created_at`, `updated_at`, `pembayaran`, `kembalian`) VALUES
(1, 'Alpi', 'Flower basket', '2025-01-08', 'selesai', 30000, 1, 1736339426, 1736339426, 20000, NULL, '2025-01-12 17:11:52', 0, 0),
(2, 'nia', 'Buket Biasa', '2025-01-08', 'diproses', 30000, 1, 1736355457, 1736355457, 20000, NULL, NULL, 0, 0),
(3, 'Mudhiya', 'Buket Biasa', '2025-01-11', 'diproses', 55000, 1, 1736588101, 1736588101, 20000, NULL, NULL, 0, 0),
(4, 'nia', 'Simple Wrap', '2025-01-21', 'diproses', 23000, 1, 1737455579, 1737455579, 3000, NULL, NULL, 0, 0),
(5, 'Nuri', 'Flower basket', '2025-01-21', 'diproses', 50000, 1, 1737455709, 1737455709, 30000, NULL, NULL, 0, 0),
(6, 'Verita', 'Flower basket', '2025-01-21', 'diproses', 60000, 1, 1737456451, 1737456451, 30000, NULL, NULL, 0, 0),
(7, 'nia', 'Simple Wrap', '2025-01-21', 'diproses', 13000, 1, 1737456467, 1737456467, 3000, NULL, NULL, 0, 0),
(8, 'nia', 'Simple Wrap', '2025-01-21', 'diproses', 48000, 1, 1737467368, 1737467368, 3000, NULL, NULL, 0, 0),
(9, 'nia', 'Simple Wrap', '2025-01-21', 'diproses', 13000, 1, 1737468642, 1737468642, 3000, NULL, NULL, 0, 0),
(10, 'Nuri', 'Simple Wrap', '2025-01-21', 'diproses', 48000, 1, 1737469535, 1737469535, 3000, NULL, NULL, 0, 0),
(11, 'nia', 'Simple Wrap', '2025-01-23', 'diproses', 13000, 1, 1737660786, 1737660786, 3000, NULL, NULL, 15000, 2000),
(12, 'nia', 'Simple Wrap', '2025-01-23', 'diproses', 48000, 1, 1737673831, 1737673831, 3000, NULL, NULL, 50000, 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama_supplier`, `no_hp`, `alamat`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'faren.florist', '0856-0033-455', 'Bandungan, Semarang, Indonesia', 'Supplier Bunga Mawar', NULL, '2025-01-12 21:36:58'),
(2, 'andirarose_supplier', '+6282181079494', 'Pasar bunga rawabelong blok b.6 & b.9, Jakarta', 'Supplier Bunga Garbera', NULL, '2025-01-12 21:38:06'),
(3, 'sulastri Florist', '081703247474', 'jalan honggowongso, kota surakarta', 'supplier bunga dipasar kembang', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_unit` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `biaya_jasa` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`id`, `nama_unit`, `foto`, `biaya_jasa`, `created_at`, `updated_at`) VALUES
(3, 'Flower basket', '1735461994.jpg', 30000, NULL, '2025-01-12 07:15:52'),
(4, 'Korean Buket', '1735462014.jpg', 25000, NULL, '2025-01-12 07:15:23'),
(5, 'Flower Cup', '1735462032.jpg', 18000, NULL, '2025-01-12 07:15:12'),
(6, 'Buket Besar', '1735462053.jpg', 50000, NULL, '2025-01-12 07:13:21'),
(7, 'Buket Medium', '1735462076.jpg', 20000, NULL, '2025-01-06 14:59:14'),
(8, 'Buket Biasa', '1735462094.jpg', 5000, NULL, '2025-01-12 07:16:15'),
(9, 'Flower Cake', '1735462123.jpg', 70000, NULL, '2025-01-12 07:14:50'),
(14, 'Simple Wrap', '1737455529.jpg', 3000, NULL, '2025-01-21 03:32:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rule` varchar(255) NOT NULL,
  `foto_profile` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `rule`, `foto_profile`, `token`, `created_at`, `updated_at`) VALUES
(3, 'mudhiya', 'mud@gmail.com', '$2y$12$0xyxeOOE//GXg6DStPYWVelV/lVGNGBNYHiw4SEQhdxEu6GL2RuOS', 'admin', '1736242774.jpg', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MzgyMjQ0MTksImV4cCI6MTczODMxMDgxOSwidXNlcm5hbWUiOiJtdWRoaXlhIn0.C6nNEXO_lkp9twZwt8eoBtqCa7VPDLZGnABfkJRllEE', NULL, '2025-01-30 01:06:59'),
(5, 'test', 'test@gmail.com', '$2y$12$dq9R1/Bc2ufB09yuLvGQv.vU4hI7vfxyDSUCOlj8vGNyBxHRlXBrW', 'admin', '1736950925.jpg', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3Mzc2NjA0MzEsImV4cCI6MTczNzc0NjgzMSwidXNlcm5hbWUiOiJ0ZXN0In0.kpq0Bjas-s0VQlaPivHHmBgXmPKrLtaEkBDM85Gc-zg', NULL, '2025-01-23 12:27:11'),
(6, 'nuri', 'nuri@gmail.com', '$2y$12$pXCh1FnTdZcAPSnSTWbZDeUfynxXEqQXaSwj0xpZk9Z6e7tVKpIRy', 'karyawan', '1736727757.jpg', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MzY3Mjc3ODcsImV4cCI6MTczNjgxNDE4NywidXNlcm5hbWUiOiJudXJpIn0.NornWhVHAw6rojS8rtTbEWrO9oxKRHRwnzZidlSraZk', NULL, '2025-01-12 17:23:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluars`
--
ALTER TABLE `barang_keluars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_rusaks`
--
ALTER TABLE `barang_rusaks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bunga_keluars`
--
ALTER TABLE `bunga_keluars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bunga_masuks`
--
ALTER TABLE `bunga_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bunga_rusaks`
--
ALTER TABLE `bunga_rusaks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `labas`
--
ALTER TABLE `labas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan_masuks`
--
ALTER TABLE `pesanan_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluars`
--
ALTER TABLE `barang_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `barang_rusaks`
--
ALTER TABLE `barang_rusaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bunga_keluars`
--
ALTER TABLE `bunga_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `bunga_masuks`
--
ALTER TABLE `bunga_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `bunga_rusaks`
--
ALTER TABLE `bunga_rusaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `labas`
--
ALTER TABLE `labas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pesanan_masuks`
--
ALTER TABLE `pesanan_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
