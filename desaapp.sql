-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Bulan Mei 2025 pada 05.59
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
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:31:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"user-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"user-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"user-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"user-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:9:\"user-show\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:9:\"role-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:11:\"role-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:9:\"role-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:11:\"role-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:20:\"laporankegiatan-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:22:\"laporankegiatan-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:20:\"laporankegiatan-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:22:\"laporankegiatan-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:23:\"laporankegiatan-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:11:\"proyek-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:13:\"proyek-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:11:\"proyek-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:13:\"proyek-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:13:\"kategori-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:15:\"kategori-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:13:\"kategori-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:15:\"kategori-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"laporan-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:14:\"laporan-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:12:\"laporan-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:15:\"laporan-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:14:\"laporan-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:13:\"kegiatan-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:15:\"kegiatan-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:13:\"kegiatan-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:15:\"kegiatan-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"Kades\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"Pegawai\";s:1:\"c\";s:3:\"web\";}}}', 1748328916);

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
(2, 'Pembangunan SD 06 Desa Bojong Gede', 1, 1, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum rem tempore id? Deleniti voluptate est corrupti explicabo tenetur porro minus unde quis expedita eveniet, asperiores, aut saepe in exercitationem odit. Voluptatibus porro quibusdam alias tenetur enim, minus magnam doloremque praesentium sint earum? Illo illum labore, doloremque dignissimos et optio! Nam incidunt ex natus excepturi ipsam illum aspernatur voluptatem provident corrupti molestiae. Porro, sint a maiores nobis nam nesciunt vero vel libero excepturi sit impedit, quia esse ipsam illum. Iste, aperiam unde sit ipsam cupiditate enim adipisci sed eum nihil excepturi asperiores perspiciatis sunt repudiandae animi aut iusto ipsa similique harum!', '2025-05-26', '2025-05-28', '3 hari', '13:00:00', '14:00:00', 'berjalan', 'gambar_kegiatan/tm7vWJTEgBz9IZmVL1NYU7o7ifbUkdggZ2FTAprh.png', '-6.200000,106.816666', '2025-05-26 08:42:15', '2025-05-26 08:42:15'),
(3, 'Pembangunan SD 07 Desa Bojong Gede', 1, 1, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum rem tempore id? Deleniti voluptate est corrupti explicabo tenetur porro minus unde quis expedita eveniet, asperiores, aut saepe in exercitationem odit. Voluptatibus porro quibusdam alias tenetur enim, minus magnam doloremque praesentium sint earum? Illo illum labore, doloremque dignissimos et optio! Nam incidunt ex natus excepturi ipsam illum aspernatur voluptatem provident corrupti molestiae. Porro, sint a maiores nobis nam nesciunt vero vel libero excepturi sit impedit, quia esse ipsam illum. Iste, aperiam unde sit ipsam cupiditate enim adipisci sed eum nihil excepturi asperiores perspiciatis sunt repudiandae animi aut iusto ipsa similique harum!', '2025-05-26', '2025-05-28', '3 hari', '12:00:00', '13:00:00', 'perencanaan', 'gambar_kegiatan/JvSYBu9BYMHCt8S5PU5iS5pcm4evX8l8igvURyRt.png', '-6.202229407097723,106.88117980957033', '2025-05-26 09:24:01', '2025-05-26 09:24:01'),
(4, 'Pembangunan SD 08 Desa Bojong Gede', 1, 1, 'fvdfvdfv', '2025-05-31', '2025-06-04', '5 hari', '10:00:00', '13:00:00', 'perencanaan', 'gambar_kegiatan/rTwzkWguQ2vQMalVnE0uefe3nzVmsqLdJe5y56BT.png', '-6.214681858859003,106.84890747070314', '2025-05-26 09:24:43', '2025-05-26 09:24:43'),
(5, 'Pembangunan SD 09 Desa Bojong Gede', 1, 1, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum rem tempore id? Deleniti voluptate est corrupti explicabo tenetur porro minus unde quis expedita eveniet, asperiores, aut saepe in exercitationem odit. Voluptatibus porro quibusdam alias tenetur enim, minus magnam doloremque praesentium sint earum? Illo illum labore, doloremque dignissimos et optio! Nam incidunt ex natus excepturi ipsam illum aspernatur voluptatem provident corrupti molestiae. Porro, sint a maiores nobis nam nesciunt vero vel libero excepturi sit impedit, quia esse ipsam illum. Iste, aperiam unde sit ipsam cupiditate enim adipisci sed eum nihil excepturi asperiores perspiciatis sunt repudiandae animi aut iusto ipsa similique harum!', '2025-06-05', '2025-06-07', '3 hari', '12:00:00', '15:00:00', 'berjalan', 'gambar_kegiatan/ioKOjrSFYUZyfFDSfkObZ2B4g5RuhVGGZHMOB9DR.png', '-6.217246974005148,106.69990539550783', '2025-05-26 09:25:27', '2025-05-26 09:25:27'),
(6, 'Pembangunan SD 02 Desa Bojong Gede', 1, 1, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum rem tempore id? Deleniti voluptate est corrupti explicabo tenetur porro minus unde quis expedita eveniet, asperiores, aut saepe in exercitationem odit. Voluptatibus porro quibusdam alias tenetur enim, minus magnam doloremque praesentium sint earum? Illo illum labore, doloremque dignissimos et optio! Nam incidunt ex natus excepturi ipsam illum aspernatur voluptatem provident corrupti molestiae. Porro, sint a maiores nobis nam nesciunt vero vel libero excepturi sit impedit, quia esse ipsam illum. Iste, aperiam unde sit ipsam cupiditate enim adipisci sed eum nihil excepturi asperiores perspiciatis sunt repudiandae animi aut iusto ipsa similique harum!', '2025-06-10', '2025-06-11', '2 hari', '12:00:00', '17:00:00', 'berjalan', 'gambar_kegiatan/fNDzDoyNsZwQo4MMas2IzRKLcve53OH5p9vCdEUk.png', '-6.21007421937677,106.75775527954103', '2025-05-26 09:26:07', '2025-05-26 09:26:07'),
(7, 'Pembangunan SD 01 Desa Bojong Gede', 1, 1, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum rem tempore id? Deleniti voluptate est corrupti explicabo tenetur porro minus unde quis expedita eveniet, asperiores, aut saepe in exercitationem odit. Voluptatibus porro quibusdam alias tenetur enim, minus magnam doloremque praesentium sint earum? Illo illum labore, doloremque dignissimos et optio! Nam incidunt ex natus excepturi ipsam illum aspernatur voluptatem provident corrupti molestiae. Porro, sint a maiores nobis nam nesciunt vero vel libero excepturi sit impedit, quia esse ipsam illum. Iste, aperiam unde sit ipsam cupiditate enim adipisci sed eum nihil excepturi asperiores perspiciatis sunt repudiandae animi aut iusto ipsa similique harum!', '2025-06-12', '2025-06-13', '2 hari', '12:00:00', '15:00:00', 'berjalan', 'gambar_kegiatan/AU6jezqblbDb4KVNKbXxbnZH7jFYIvN7zsH6Fq8l.png', '-6.257519238213283,106.9182586669922', '2025-05-26 09:26:46', '2025-05-26 09:26:46');

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
(2, 2, 'dokumentasi/vqntv5FXHMl2XK7z2mkOgvU0zQ9K2za291dRHOhT.png', 'image', '2025-05-26 10:39:14', '2025-05-26 10:39:14'),
(3, 3, 'dokumentasi/0yXUddd8Q6u4nLOd82u3J8DILrK2pzlOab4YXMkE.jpg', 'image', '2025-05-26 10:42:35', '2025-05-26 10:42:35'),
(4, 4, 'dokumentasi/O5VzvmzqKxMNpyuxIsQsS6BWbgfAK9rT3gxNl37S.jpg', 'image', '2025-05-26 19:57:56', '2025-05-26 19:57:56'),
(5, 4, 'dokumentasi/3QT7DIZ2PP5QqmdL2Fm1R96qBmJAG5omekhWwSJK.png', 'image', '2025-05-26 19:57:56', '2025-05-26 19:57:56'),
(6, 4, 'dokumentasi/i8J7t4SAyNIXYtOYZ4gREqLPflEIEdzD5ucO0mZJ.png', 'image', '2025-05-26 19:57:56', '2025-05-26 19:57:56'),
(7, 5, 'dokumentasi/kdRQEp1SN5gx1g1cWi7bG6MWF7seXyPkmzB2aYdg.jpg', 'image', '2025-05-26 20:00:34', '2025-05-26 20:00:34'),
(8, 5, 'dokumentasi/8fPNME1XD36r4lKZHTpWCNEExW8xo9SXwSQD4VjC.jpg', 'image', '2025-05-26 20:00:34', '2025-05-26 20:00:34'),
(9, 5, 'dokumentasi/53e0KDUQE35F443HZVa7c8ouatnJn9gUtrzcjJcc.jpg', 'image', '2025-05-26 20:00:34', '2025-05-26 20:00:34'),
(10, 6, 'dokumentasi/uvzlW58JkARcbGVxDqXWneEs1slEsPXGL6mbHNwP.jpg', 'image', '2025-05-26 20:06:53', '2025-05-26 20:06:53'),
(11, 6, 'dokumentasi/gaAmVNnZ3CnofqXJ5uxGnaQa021LFPzrAAzP8ibU.png', 'image', '2025-05-26 20:06:53', '2025-05-26 20:06:53'),
(12, 6, 'dokumentasi/oSLVQnMOXu4MlWkqVJbzO9W7LuG5FelYOx57Tnrd.jpg', 'image', '2025-05-26 20:06:53', '2025-05-26 20:06:53'),
(13, 7, 'dokumentasi/bCgNpcl8ae81YgahErQb2J2wekgoK9KjnNovNO8n.png', 'image', '2025-05-26 20:08:34', '2025-05-26 20:08:34'),
(14, 7, 'dokumentasi/Rp5u4y7eQ7kJX2mcxmrd1EIUZrMpDNdh4GWc1rFh.jpg', 'image', '2025-05-26 20:08:34', '2025-05-26 20:08:34'),
(15, 7, 'dokumentasi/R87pdPBom4ygPBrGQ456OowbBbgTJSJ1Ndx7RD1E.jpg', 'image', '2025-05-26 20:08:34', '2025-05-26 20:08:34');

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
(1, 1, 1, 'dokumentasi/fAHopgBa2XOtvMmcLulcUP8jjWXrMnaMjBF96EaB.png', 'image', 30, 'Upload awal', 0, '2025-05-25 23:58:53', '2025-05-25 23:58:53'),
(2, 2, 2, 'dokumentasi/GZMlXry2FxpRi94WCbo8WrLFkCKCPkpOSMxWcvmB.png', 'image', 30, 'Upload awal', 0, '2025-05-26 12:07:52', '2025-05-26 12:07:52'),
(3, 3, 1, 'dokumentasi/BGlfVcChhUrqtwya1jaTVkeHCWfIYSHSSSkB0UHi.png', 'image', 50, 'dvsvvsvds', 1, '2025-05-26 12:09:32', '2025-05-26 12:09:32');

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
(1, 'Sosial', 'bfbdbdfbdbd', '2025-05-25 23:56:25', '2025-05-25 23:56:25');

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
(2, 3, 1, '20250526-KGT3-GBBR', 'fgfdggdfgd', 'fdgffgdg', 'fdgdggdg', 'gdfgfdg', NULL, NULL, '2025-05-26 10:39:14', '2025-05-26 10:39:14'),
(3, 7, 3, '20250526-KGT7-X3WL', 'trhrrrrrrrrrrrrrrrrrghhfhgfhghfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'thtrhrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 'sdvvdsfgfffregggtgfgdgdfgrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 'dvdsv', NULL, NULL, '2025-05-26 10:42:35', '2025-05-26 19:30:15'),
(4, 6, 3, '20250527-KGT6-ALCP', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', NULL, NULL, '2025-05-26 19:57:55', '2025-05-26 19:57:55'),
(5, 4, 3, '20250527-KGT4-LR1O', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', NULL, NULL, '2025-05-26 20:00:34', '2025-05-26 20:00:34'),
(6, 2, 3, '20250527-KGT2-F5XQ', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', NULL, NULL, '2025-05-26 20:06:53', '2025-05-26 20:06:53'),
(7, 5, 3, '20250527-KGT5-MBNY', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', 'Lorem dcscjdcsbchbsucbhsbchsbchdsbchjsbdcsbhbchjdbcshbchjsbcshbcshcbhscbhsbcshbchjcsjcsjbchsbchsbchjsdcb\\sbhsbchsbcjsjcbhjscbscsdcscscscdscscs', NULL, NULL, '2025-05-26 20:08:34', '2025-05-26 20:08:34');

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
(1, 1, 1, '20250526-PRY1-36H2', 'ngn', 'gfnfgn', 'gfgn', NULL, NULL, '2025-05-25 23:58:53', '2025-05-25 23:58:53'),
(2, 2, 3, '20250526-PRY2-9LPP', 'bfbfgfbfb', 'bgfbbfgb', 'gbgfbfgbf', NULL, NULL, '2025-05-26 12:07:52', '2025-05-26 12:07:52');

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
(1, 'Jalan Desa', 'jalan', 'sdsd', 20000000.00, '2025-05-26', '2025-05-31', '6 hari', 'APBD Daerah', 'PT. PP', 'Sudarsono', 'berjalan', '-6.200000,106.816666', 'gambar_proyek/dB3UABe2zC55INj8WSAjXoCeKdsDfoX98iXGafm0.png', '2025-05-25 23:58:28', '2025-05-25 23:58:28'),
(2, 'Pembangunan SD', 'bangunan', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum rem tempore id? Deleniti voluptate est corrupti explicabo tenetur porro minus unde quis expedita eveniet, asperiores, aut saepe in exercitationem odit. Voluptatibus porro quibusdam alias tenetur enim, minus magnam doloremque praesentium sint earum? Illo illum labore, doloremque dignissimos et optio! Nam incidunt ex natus excepturi ipsam illum aspernatur voluptatem provident corrupti molestiae. Porro, sint a maiores nobis nam nesciunt vero vel libero excepturi sit impedit, quia esse ipsam illum. Iste, aperiam unde sit ipsam cupiditate enim adipisci sed eum nihil excepturi asperiores perspiciatis sunt repudiandae animi aut iusto ipsa similique harum!', 20000000.00, '2025-07-17', '2025-12-27', '164 hari', 'APBD Daerah', 'PT. PP', 'Sudarsono', 'berjalan', '-6.212218056653312,106.85302734375001', 'gambar_proyek/lM5YLhXoVnA20JAbPtvT0wViedHV1bk8bLl161SK.png', '2025-05-26 12:06:24', '2025-05-26 12:06:24');

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
(1, 'user-list', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(2, 'user-create', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(3, 'user-edit', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(4, 'user-delete', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(5, 'user-show', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(6, 'role-list', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(7, 'role-create', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(8, 'role-edit', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(9, 'role-delete', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(10, 'laporankegiatan-list', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(11, 'laporankegiatan-create', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(12, 'laporankegiatan-edit', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(13, 'laporankegiatan-delete', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(14, 'laporankegiatan-approve', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(15, 'proyek-list', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(16, 'proyek-create', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(17, 'proyek-edit', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(18, 'proyek-delete', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(19, 'kategori-list', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(20, 'kategori-create', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(21, 'kategori-edit', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(22, 'kategori-delete', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(23, 'laporan-list', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(24, 'laporan-create', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(25, 'laporan-edit', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(26, 'laporan-approve', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(27, 'laporan-delete', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(28, 'kegiatan-list', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(29, 'kegiatan-create', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(30, 'kegiatan-edit', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09'),
(31, 'kegiatan-delete', 'web', '2025-05-25 23:52:09', '2025-05-25 23:52:09');

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
(1, 1, 30, '2025-05-25 23:58:53', '2025-05-25 23:58:53'),
(2, 2, 30, '2025-05-26 12:07:52', '2025-05-26 12:07:52'),
(3, 1, 50, '2025-05-26 12:09:32', '2025-05-26 12:09:32');

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

--
-- Dumping data untuk tabel `proyek_bangunans`
--

INSERT INTO `proyek_bangunans` (`id`, `proyek_id`, `nama_bangunan`, `jumlah_lantai`, `luas_bangunan`, `fungsi`, `created_at`, `updated_at`) VALUES
(1, 2, 'SDN 05 Bojonggede', '3', '400', 'Sekolah', '2025-05-26 12:06:24', '2025-05-26 12:06:24');

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
(1, 1, '80', '10', 'aspal', 'rusak parah', '2025-05-25 23:58:28', '2025-05-25 23:58:28');

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
(1, 'Admin', 'web', '2025-05-25 23:52:10', '2025-05-25 23:52:10'),
(2, 'Kades', 'web', '2025-05-25 23:52:10', '2025-05-25 23:52:10'),
(3, 'Pegawai', 'web', '2025-05-25 23:52:11', '2025-05-25 23:52:11');

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
('doTIXF0lHbVJInNje9BkWpHCUEmf3PxSYnY7cinU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHpXaURRenRIa0pMdUJDT0IxZXZld1BXaHpLRENPbGV0RVlEZUtBUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1748318330);

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
(1, 'Desa Bojong Gede', 'admin12345', '$2y$12$2upbSlg6SU6wGU.m655hWuwmrAFGWBlOPZRd9ZmS1WGuYqYI.j.aa', 'logo_pemkab_bogor.jpg', NULL, '2025-05-25 23:52:10', '2025-05-25 23:52:10'),
(2, 'Kades User', 'kades12345', '$2y$12$taNBRuzH8tfBITeGdeIGVOdVPvtE3ZhnO/l/dYbQLL6yHlGBv6dUS', 'logo_pemkab_bogor.jpg', NULL, '2025-05-25 23:52:11', '2025-05-25 23:52:11'),
(3, 'Pegawai User', 'pegawai12345', '$2y$12$PoH60tYkW12CdH.ns5km4uuJadaP39UWroaLSU.Lm8DdAY3OmC6QO', 'logo_pemkab_bogor.jpg', NULL, '2025-05-25 23:52:11', '2025-05-25 23:52:11'),
(4, 'Test User', 'test12345', '$2y$12$yYtbHTiiqIa1byYqNBJCgedkjzrFpaeI0qlk4MP8xfLGY2T6sLnHq', 'logo_pemkab_bogor.jpg', 'z9g2R4acl3', '2025-05-25 23:52:12', '2025-05-25 23:52:12');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `dokumentasi_kegiatans`
--
ALTER TABLE `dokumentasi_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `dokumentasi_proyeks`
--
ALTER TABLE `dokumentasi_proyeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `laporan_kegiatans`
--
ALTER TABLE `laporan_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `laporan_proyeks`
--
ALTER TABLE `laporan_proyeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pembangunan_proyeks`
--
ALTER TABLE `pembangunan_proyeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `progres_pembangunans`
--
ALTER TABLE `progres_pembangunans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `proyek_bangunans`
--
ALTER TABLE `proyek_bangunans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `proyek_jalans`
--
ALTER TABLE `proyek_jalans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
