-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2025 pada 10.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desaapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:31:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"user-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"user-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"user-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"user-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:9:\"user-show\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:9:\"role-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:11:\"role-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:9:\"role-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:11:\"role-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:20:\"laporankegiatan-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:22:\"laporankegiatan-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:20:\"laporankegiatan-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:22:\"laporankegiatan-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:23:\"laporankegiatan-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:11:\"proyek-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:13:\"proyek-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:11:\"proyek-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:13:\"proyek-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:13:\"kategori-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:15:\"kategori-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:13:\"kategori-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:15:\"kategori-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"laporan-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:14:\"laporan-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:12:\"laporan-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:15:\"laporan-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:14:\"laporan-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:13:\"kegiatan-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:15:\"kegiatan-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:13:\"kegiatan-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:15:\"kegiatan-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"Kades\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"Pegawai\";s:1:\"c\";s:3:\"web\";}}}', 1750299680);

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
-- Struktur dari tabel `desa_kegiatans`
--

CREATE TABLE `desa_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi_kegiatan` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `lama_hari` varchar(255) DEFAULT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `desa_kegiatans`
--

INSERT INTO `desa_kegiatans` (`id`, `nama_kegiatan`, `kategori_id`, `user_id`, `deskripsi_kegiatan`, `tanggal_mulai`, `tanggal_selesai`, `lama_hari`, `waktu_mulai`, `waktu_selesai`, `status`, `gambar`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'Bansos', 2, 1, 'Bansos', '2025-06-18', '2025-06-20', '3 hari', '12:00:00', '14:00:00', 'selesai', 'gambar_kegiatan/VvfXQlAy7LL8EPVw8fljHwEADGmYIWWLTzhb3ayM.jpg', '-6.489492468981,106.7945176363', '2025-06-17 19:28:13', '2025-06-18 01:06:28'),
(2, 'Kerja bakti bersama di rt.06', 2, 1, 'vsvsdv', '2025-06-18', '2025-06-20', '3 hari', '12:00:00', '14:00:00', 'batal', 'gambar_kegiatan/1opgHjfzBeYq0ollOrmWruIFUuglLghvKW5moINy.jpg', '-6.2070973547877,106.82749545253', '2025-06-18 01:00:19', '2025-06-18 01:02:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentasi_kegiatans`
--

CREATE TABLE `dokumentasi_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokumentasi_kegiatans`
--

INSERT INTO `dokumentasi_kegiatans` (`id`, `laporan_id`, `file_path`, `file_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'dokumentasi/7Vm73dAckhwszI207xB9ZtB26pBd6nPUnvNpyHNe.jpg', 'image', '2025-06-17 19:47:50', '2025-06-17 19:47:50'),
(2, 1, 'dokumentasi/pCFnoBKXXz2ANaKGDcGXRF7JXqPbQ4ZlmFWMvxrF.jpg', 'image', '2025-06-17 19:47:50', '2025-06-17 19:47:50'),
(3, 1, 'dokumentasi/XMvHkAw9RrythXYupVmOqavEMiZT16wvH5IDhxeN.jpg', 'image', '2025-06-17 19:47:50', '2025-06-17 19:47:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentasi_proyeks`
--

CREATE TABLE `dokumentasi_proyeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `progres_id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `persentase` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `is_initial` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokumentasi_proyeks`
--

INSERT INTO `dokumentasi_proyeks` (`id`, `progres_id`, `laporan_id`, `file_path`, `file_type`, `persentase`, `keterangan`, `is_initial`, `created_at`, `updated_at`) VALUES
(7, 5, 3, 'dokumentasi/IKjpIGCAoMU0kAQH03p27ZqlhgvrDy4XPABPbwnD.jpg', 'image', 0, 'Upload awal', 0, '2025-06-18 01:25:50', '2025-06-18 01:25:50');

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
-- Struktur dari tabel `kategori_kegiatans`
--

CREATE TABLE `kategori_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi_kategori` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_kegiatans`
--

INSERT INTO `kategori_kegiatans` (`id`, `nama_kategori`, `deskripsi_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Pemerintahan', 'Kegiatan yang berkenaan dengan pemerintahan di desa bojonggede', '2025-06-17 19:24:41', '2025-06-17 19:24:41'),
(2, 'Sosial', 'Kegiatan yang berkenaan dengan kegiatan sosial di desa bojonggede', '2025-06-17 19:25:26', '2025-06-17 19:25:26'),
(3, 'Kesehatan', 'Kegiatan yang berkenaan dengan kesehatan di desa bojonggede', '2025-06-17 19:26:52', '2025-06-17 19:26:52'),
(4, 'Seni Budaya', 'Kegiatan yang berkenaan dengan seni budaya di desa bojonggede', '2025-06-18 01:53:53', '2025-06-18 01:53:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_kegiatans`
--

CREATE TABLE `laporan_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kode_kegiatan` varchar(255) NOT NULL,
  `tujuan_kegiatan` varchar(255) NOT NULL,
  `hasil` varchar(255) NOT NULL,
  `evaluasi` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `is_approved` tinyint(1) DEFAULT NULL,
  `keterangan_tolak` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_kegiatans`
--

INSERT INTO `laporan_kegiatans` (`id`, `kegiatan_id`, `user_id`, `kode_kegiatan`, `tujuan_kegiatan`, `hasil`, `evaluasi`, `keterangan`, `is_approved`, `keterangan_tolak`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '20250618-KGT1-QY9P', 'dvdsvv', 'dvsd', 'vdsvds', 'dsvsvdv', 1, NULL, '2025-06-17 19:47:50', '2025-06-18 01:07:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_proyeks`
--

CREATE TABLE `laporan_proyeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proyek_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kode_laporan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kendala` varchar(255) NOT NULL,
  `evaluasi` varchar(255) NOT NULL,
  `is_approved` tinyint(1) DEFAULT NULL,
  `keterangan_tolak` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_proyeks`
--

INSERT INTO `laporan_proyeks` (`id`, `proyek_id`, `user_id`, `kode_laporan`, `keterangan`, `kendala`, `evaluasi`, `is_approved`, `keterangan_tolak`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '20250618-PRY1-RKYG', 'ccx  xc', 'x c x', 'c xc', NULL, NULL, '2025-06-18 01:25:50', '2025-06-18 01:25:50');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_16_032628_create_permission_tables', 1),
(5, '2025_04_20_201651_create_pembangunan_proyeks_table', 1),
(6, '2025_04_21_084006_create_proyek_bangunans_table', 1),
(7, '2025_04_21_232643_create_proyek_jalans_table', 1),
(8, '2025_04_28_014154_create_proyek_jembatans_table', 1),
(9, '2025_04_29_004156_create_laporan_proyeks_table', 1),
(10, '2025_04_29_004241_create_progres_pembangunans_table', 1),
(11, '2025_04_29_004426_create_dokumentasi_proyeks_table', 1),
(12, '2025_05_02_014030_create_kategori_kegiatans_table', 1),
(13, '2025_05_02_015009_create_desa_kegiatans_table', 1),
(14, '2025_05_12_004447_create_laporan_kegiatans_table', 1),
(15, '2025_05_12_010948_create_dokumentasi_kegiatans_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembangunan_proyeks`
--

CREATE TABLE `pembangunan_proyeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_proyek` varchar(255) NOT NULL,
  `jenis_proyek` varchar(255) NOT NULL,
  `deskripsi_proyek` text NOT NULL,
  `anggaran` decimal(15,2) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `masa_kontrak` varchar(255) DEFAULT NULL,
  `sumber_dana` varchar(255) NOT NULL,
  `kontraktor` varchar(255) NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembangunan_proyeks`
--

INSERT INTO `pembangunan_proyeks` (`id`, `nama_proyek`, `jenis_proyek`, `deskripsi_proyek`, `anggaran`, `tanggal_mulai`, `tanggal_selesai`, `masa_kontrak`, `sumber_dana`, `kontraktor`, `penanggung_jawab`, `status`, `lokasi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Pembangunan Jalan efwfwfw', 'jalan', 'sdvsvsdv', 150000000.00, '2025-05-01', '2025-05-25', '25 hari', 'Dana Desa', 'PT. Waskita', 'Beni Setiawan', 'berjalan', '-6.280424125646783,106.94085891972323', 'gambar_proyek/HiHExC9rjHafCHy7FFcj3EHyk4CHJhtfbBDm5EK5.jpg', '2025-06-17 20:02:43', '2025-06-17 20:19:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(2, 'user-create', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(3, 'user-edit', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(4, 'user-delete', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(5, 'user-show', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(6, 'role-list', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(7, 'role-create', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(8, 'role-edit', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(9, 'role-delete', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(10, 'laporankegiatan-list', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(11, 'laporankegiatan-create', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(12, 'laporankegiatan-edit', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(13, 'laporankegiatan-delete', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(14, 'laporankegiatan-approve', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(15, 'proyek-list', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(16, 'proyek-create', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(17, 'proyek-edit', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(18, 'proyek-delete', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(19, 'kategori-list', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(20, 'kategori-create', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(21, 'kategori-edit', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(22, 'kategori-delete', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(23, 'laporan-list', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(24, 'laporan-create', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(25, 'laporan-edit', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(26, 'laporan-approve', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(27, 'laporan-delete', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(28, 'kegiatan-list', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(29, 'kegiatan-create', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(30, 'kegiatan-edit', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40'),
(31, 'kegiatan-delete', 'web', '2025-06-17 19:20:40', '2025-06-17 19:20:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `progres_pembangunans`
--

CREATE TABLE `progres_pembangunans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `persentase` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `progres_pembangunans`
--

INSERT INTO `progres_pembangunans` (`id`, `laporan_id`, `persentase`, `created_at`, `updated_at`) VALUES
(5, 3, 0, '2025-06-18 01:25:50', '2025-06-18 01:25:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek_bangunans`
--

CREATE TABLE `proyek_bangunans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proyek_id` bigint(20) UNSIGNED NOT NULL,
  `nama_bangunan` varchar(255) NOT NULL,
  `jumlah_lantai` varchar(255) NOT NULL,
  `luas_bangunan` varchar(255) NOT NULL,
  `fungsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek_jalans`
--

CREATE TABLE `proyek_jalans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proyek_id` bigint(20) UNSIGNED NOT NULL,
  `panjang_jalan` varchar(255) NOT NULL,
  `lebar_jalan` varchar(255) NOT NULL,
  `jenis_permukaan` varchar(255) NOT NULL,
  `kondisi_jalan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `proyek_jalans`
--

INSERT INTO `proyek_jalans` (`id`, `proyek_id`, `panjang_jalan`, `lebar_jalan`, `jenis_permukaan`, `kondisi_jalan`, `created_at`, `updated_at`) VALUES
(1, 1, '34', '4', 'cor beton', 'rusak ringan', '2025-06-17 20:02:43', '2025-06-17 20:02:43'),
(2, 1, '34', '4', 'cor beton', 'rusak ringan', '2025-06-17 20:04:50', '2025-06-17 20:04:50'),
(3, 1, '34', '4', 'cor beton', 'rusak ringan', '2025-06-17 20:08:45', '2025-06-17 20:08:45'),
(4, 1, '34', '4', 'cor beton', 'rusak ringan', '2025-06-17 20:19:36', '2025-06-17 20:19:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek_jembatans`
--

CREATE TABLE `proyek_jembatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proyek_id` bigint(20) UNSIGNED NOT NULL,
  `panjang_jembatan` varchar(255) NOT NULL,
  `lebar_jembatan` varchar(255) NOT NULL,
  `kapasitas_beban` varchar(255) NOT NULL,
  `tipe_struktur` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-06-17 19:20:41', '2025-06-17 19:20:41'),
(2, 'Kades', 'web', '2025-06-17 19:20:41', '2025-06-17 19:20:41'),
(3, 'Pegawai', 'web', '2025-06-17 19:20:42', '2025-06-17 19:20:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(11, 3),
(12, 1),
(12, 2),
(12, 3),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(23, 3),
(24, 1),
(24, 2),
(24, 3),
(25, 1),
(25, 2),
(25, 3),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(27, 3),
(28, 1),
(28, 2),
(28, 3),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5hUJreWdS4hIrgA7bbZJepRf85tUDNwQYf4QiAQE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib3U3YU5vTGI5SjhxcTFlNnU2eXdoOUVkMTg1blNxcE1jWUJabzFQeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaV9rZWdpYXRhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzUwMjMyNjY0O319', 1750236833);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `gambar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Desa Bojong Gede', 'admin12345', '$2y$12$sUAz2kOj5Wk/vLHamyKTXOw2G7HeKOhsUH8AO9zYZoEGteHcuS23m', 'http://localhost/assets/img/logo_pemkab_bogor.jpg', NULL, '2025-06-17 19:20:41', '2025-06-17 19:20:41'),
(2, 'Kades User', 'kades12345', '$2y$12$erCFHO1kRnN2GYBDysoMEuM4sO.idvrHyjdXzjvyF0Md8F1hGAVsG', 'http://localhost/assets/img/logo_pemkab_bogor.jpg', NULL, '2025-06-17 19:20:42', '2025-06-17 19:20:42'),
(3, 'Pegawai User', 'pegawai12345', '$2y$12$pj35Aj1arlGa0sSOZ.7Xj.3beH/dJvy912bRT/J3urHy1sScfof..', 'http://localhost/assets/img/logo_pemkab_bogor.jpg', NULL, '2025-06-17 19:20:42', '2025-06-17 19:20:42'),
(4, 'Test User', 'test12345', '$2y$12$ekpGLTt7HBxo1H4Wc5P73uk1Kc4Z2cZ7w3AVPhEOBZiMZhs5uUaP2', 'http://localhost/assets/img/logo_pemkab_bogor.jpg', '0YBBIld1iG', '2025-06-17 19:20:43', '2025-06-17 19:20:43');

--
-- Indexes for dumped tables
--

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
-- Indeks untuk tabel `desa_kegiatans`
--
ALTER TABLE `desa_kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desa_kegiatans_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `dokumentasi_kegiatans`
--
ALTER TABLE `dokumentasi_kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumentasi_kegiatans_laporan_id_foreign` (`laporan_id`);

--
-- Indeks untuk tabel `dokumentasi_proyeks`
--
ALTER TABLE `dokumentasi_proyeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumentasi_proyeks_progres_id_foreign` (`progres_id`),
  ADD KEY `dokumentasi_proyeks_laporan_id_foreign` (`laporan_id`);

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
-- Indeks untuk tabel `kategori_kegiatans`
--
ALTER TABLE `kategori_kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_kegiatans`
--
ALTER TABLE `laporan_kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laporan_kegiatans_kode_kegiatan_unique` (`kode_kegiatan`),
  ADD KEY `laporan_kegiatans_kegiatan_id_foreign` (`kegiatan_id`),
  ADD KEY `laporan_kegiatans_kode_kegiatan_index` (`kode_kegiatan`);

--
-- Indeks untuk tabel `laporan_proyeks`
--
ALTER TABLE `laporan_proyeks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laporan_proyeks_kode_laporan_unique` (`kode_laporan`),
  ADD KEY `laporan_proyeks_proyek_id_foreign` (`proyek_id`),
  ADD KEY `laporan_proyeks_kode_laporan_index` (`kode_laporan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `pembangunan_proyeks`
--
ALTER TABLE `pembangunan_proyeks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `progres_pembangunans`
--
ALTER TABLE `progres_pembangunans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `progres_pembangunans_laporan_id_foreign` (`laporan_id`);

--
-- Indeks untuk tabel `proyek_bangunans`
--
ALTER TABLE `proyek_bangunans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyek_bangunans_proyek_id_foreign` (`proyek_id`);

--
-- Indeks untuk tabel `proyek_jalans`
--
ALTER TABLE `proyek_jalans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyek_jalans_proyek_id_foreign` (`proyek_id`);

--
-- Indeks untuk tabel `proyek_jembatans`
--
ALTER TABLE `proyek_jembatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyek_jembatans_proyek_id_foreign` (`proyek_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `desa_kegiatans`
--
ALTER TABLE `desa_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dokumentasi_kegiatans`
--
ALTER TABLE `dokumentasi_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `dokumentasi_proyeks`
--
ALTER TABLE `dokumentasi_proyeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT untuk tabel `kategori_kegiatans`
--
ALTER TABLE `kategori_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `laporan_kegiatans`
--
ALTER TABLE `laporan_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `laporan_proyeks`
--
ALTER TABLE `laporan_proyeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pembangunan_proyeks`
--
ALTER TABLE `pembangunan_proyeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `progres_pembangunans`
--
ALTER TABLE `progres_pembangunans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `proyek_bangunans`
--
ALTER TABLE `proyek_bangunans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `proyek_jalans`
--
ALTER TABLE `proyek_jalans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `proyek_jembatans`
--
ALTER TABLE `proyek_jembatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `desa_kegiatans`
--
ALTER TABLE `desa_kegiatans`
  ADD CONSTRAINT `desa_kegiatans_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_kegiatans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumentasi_kegiatans`
--
ALTER TABLE `dokumentasi_kegiatans`
  ADD CONSTRAINT `dokumentasi_kegiatans_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporan_kegiatans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumentasi_proyeks`
--
ALTER TABLE `dokumentasi_proyeks`
  ADD CONSTRAINT `dokumentasi_proyeks_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporan_proyeks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dokumentasi_proyeks_progres_id_foreign` FOREIGN KEY (`progres_id`) REFERENCES `progres_pembangunans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_kegiatans`
--
ALTER TABLE `laporan_kegiatans`
  ADD CONSTRAINT `laporan_kegiatans_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `desa_kegiatans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_proyeks`
--
ALTER TABLE `laporan_proyeks`
  ADD CONSTRAINT `laporan_proyeks_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `pembangunan_proyeks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `progres_pembangunans`
--
ALTER TABLE `progres_pembangunans`
  ADD CONSTRAINT `progres_pembangunans_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporan_proyeks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `proyek_bangunans`
--
ALTER TABLE `proyek_bangunans`
  ADD CONSTRAINT `proyek_bangunans_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `pembangunan_proyeks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `proyek_jalans`
--
ALTER TABLE `proyek_jalans`
  ADD CONSTRAINT `proyek_jalans_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `pembangunan_proyeks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `proyek_jembatans`
--
ALTER TABLE `proyek_jembatans`
  ADD CONSTRAINT `proyek_jembatans_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `pembangunan_proyeks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
