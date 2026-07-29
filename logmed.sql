-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jul 2026 pada 05.57
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
-- Database: `logmed`
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
-- Struktur dari tabel `detail_permintaan`
--

CREATE TABLE `detail_permintaan` (
  `id` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_permintaan`
--

INSERT INTO `detail_permintaan` (`id`, `id_permintaan`, `id_obat`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(2, 1, 13, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(3, 1, 20, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(4, 1, 8, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(5, 1, 14, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(6, 1, 5, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(7, 1, 17, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(8, 1, 22, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(9, 1, 10, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(10, 1, 16, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(11, 1, 21, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(12, 1, 18, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(13, 1, 1, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(14, 1, 11, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(15, 1, 7, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(16, 1, 19, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(17, 1, 15, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(18, 1, 3, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(19, 1, 12, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(20, 1, 9, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(21, 1, 2, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35'),
(22, 1, 6, 1, '2026-07-11 00:30:35', '2026-07-11 00:30:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribusi`
--

CREATE TABLE `distribusi` (
  `id` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `status` enum('diproses','dikirim','diterima') DEFAULT 'diproses',
  `tanggal_kirim` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `distribusi`
--

INSERT INTO `distribusi` (`id`, `id_permintaan`, `status`, `tanggal_kirim`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'dikirim', '2026-07-11', 'Obat telah dikirim', '2026-07-11 05:54:06', '2026-07-11 05:54:06');

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
-- Struktur dari tabel `gedung`
--

CREATE TABLE `gedung` (
  `id` int(11) NOT NULL,
  `kode_gedung` varchar(20) DEFAULT NULL,
  `nama_gedung` varchar(100) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `penanggung_jawab` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gedung`
--

INSERT INTO `gedung` (`id`, `kode_gedung`, `nama_gedung`, `lokasi`, `penanggung_jawab`, `created_at`, `updated_at`) VALUES
(3, 'GDG0001', 'Gedung A', 'Lantai 1 Blok A', 'dr. Andi Pratama', '2026-07-09 15:33:18', '2026-07-09 15:33:18'),
(4, 'GDG0002', 'Gedung B', 'Lantai 1 Blok B', 'dr. Budi Santoso', '2026-07-09 15:33:18', '2026-07-09 15:33:18'),
(5, 'GDG0003', 'Gedung C', 'Lantai 2 Blok A', 'dr. Citra Lestari', '2026-07-09 15:33:18', '2026-07-09 15:33:18'),
(6, 'GDG0004', 'Gedung D', 'Lantai 2 Blok B', 'dr. Dimas Saputra', '2026-07-09 15:33:18', '2026-07-09 15:33:18'),
(7, 'GDG0005', 'Gedung E', 'Lantai 3 Blok A', 'dr. Eka Putri', '2026-07-09 15:33:18', '2026-07-09 15:33:18'),
(8, 'GDG0006', 'Gedung F', 'Lantai 3 Blok B', 'dr. Fajar Nugroho', '2026-07-09 15:33:18', '2026-07-09 15:33:18'),
(9, 'GDG0007', 'Gedung G', 'Lantai 4 Blok A', 'dr. Gita Permata', '2026-07-09 15:33:18', '2026-07-09 15:33:18'),
(10, 'GDG0008', 'Gedung H', 'Lantai 4 Blok B', 'dr. Hendra Wijaya', '2026-07-09 15:33:18', '2026-07-09 15:33:18'),
(11, 'GDG0009', 'Gedung I', 'Lantai 5 Blok A', 'dr. Intan Maharani', '2026-07-09 15:33:18', '2026-07-09 15:33:18'),
(12, 'GDG0010', 'Gedung J', 'Lantai 5 Blok B', 'dr. Joko Susilo', '2026-07-09 15:33:18', '2026-07-09 15:33:18');

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
(2, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `kode_obat` varchar(20) DEFAULT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `jenis_obat` varchar(50) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `stok_pusat` int(11) DEFAULT 0,
  `expired_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `kode_obat`, `nama_obat`, `jenis_obat`, `satuan`, `stok_pusat`, `expired_date`, `created_at`, `updated_at`) VALUES
(1, 'OBT0001', 'Meloxicam', 'Tablet', 'Strip', 199, '2026-07-11', '2026-07-07 10:43:26', '2026-07-11 05:54:06'),
(2, 'OBT0002', 'Vitamin C', 'Tablet', 'box', 99, '2026-10-10', '2026-07-07 11:08:30', '2026-07-11 05:54:06'),
(3, 'OBT0003', 'Paracetamol 500 mg', 'Tablet', 'Strip', 119, '2027-05-20', '2026-07-08 08:02:19', '2026-07-11 05:54:06'),
(4, 'OBT0004', 'Amoxicillin 500 mg', 'Kapsul', 'Strip', 84, '2027-02-18', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(5, 'OBT0005', 'CTM', 'Tablet', 'Strip', 69, '2028-01-15', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(6, 'OBT0006', 'Vitamin C 500 mg', 'Tablet', 'Botol', 149, '2028-08-12', '2026-07-08 08:02:19', '2026-07-11 05:54:06'),
(7, 'OBT0007', 'OBH Combi', 'Sirup', 'Botol', 44, '2027-09-25', '2026-07-08 08:02:19', '2026-07-11 05:54:06'),
(8, 'OBT0008', 'Betadine', 'Cair', 'Botol', 59, '2029-03-10', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(9, 'OBT0009', 'Salep Bioplacenton', 'Salep', 'Tube', 29, '2028-11-05', '2026-07-08 08:02:19', '2026-07-11 05:54:06'),
(10, 'OBT0010', 'Ibuprofen 400 mg', 'Tablet', 'Strip', 94, '2027-12-30', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(11, 'OBT0011', 'Mylanta', 'Sirup', 'Botol', 39, '2028-06-22', '2026-07-08 08:02:19', '2026-07-11 05:54:06'),
(12, 'OBT0012', 'Promag', 'Tablet', 'Strip', 109, '2029-04-18', '2026-07-08 08:02:19', '2026-07-11 05:54:06'),
(13, 'OBT0013', 'Antimo', 'Tablet', 'Strip', 64, '2028-09-01', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(14, 'OBT0014', 'Cetirizine', 'Tablet', 'Strip', 79, '2027-10-15', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(15, 'OBT0015', 'Oralit', 'Serbuk', 'Sachet', 99, '2029-02-20', '2026-07-08 08:02:19', '2026-07-11 05:54:06'),
(16, 'OBT0016', 'Insto', 'Tetes Mata', 'Botol', 54, '2028-07-28', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(17, 'OBT0017', 'Gentamicin', 'Salep', 'Tube', 34, '2028-05-10', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(18, 'OBT0018', 'Loperamide', 'Tablet', 'Strip', 89, '2027-12-14', '2026-07-08 08:02:19', '2026-07-11 05:54:06'),
(19, 'OBT0019', 'Omeprazole', 'Kapsul', 'Strip', 74, '2028-10-30', '2026-07-08 08:02:19', '2026-07-11 05:54:06'),
(20, 'OBT0020', 'Asam Mefenamat', 'Tablet', 'Strip', 104, '2026-06-09', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(21, 'OBT0021', 'Kalpanax', 'Salep', 'Tube', 27, '2029-01-08', '2026-07-08 08:02:19', '2026-07-11 05:54:05'),
(22, 'OBT0022', 'Hansaplast', 'Alat Kesehatan', 'Kotak', 49, '2026-07-11', '2026-07-08 08:02:19', '2026-07-11 05:54:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan_obat`
--

CREATE TABLE `penggunaan_obat` (
  `id` int(11) NOT NULL,
  `id_stok` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan`
--

CREATE TABLE `permintaan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('menunggu','disetujui','ditolak','selesai') DEFAULT 'menunggu',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permintaan`
--

INSERT INTO `permintaan` (`id`, `user_id`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 12, 'selesai', NULL, '2026-07-11 00:30:35', '2026-07-11 05:54:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_gedung`
--

CREATE TABLE `stok_gedung` (
  `id` int(11) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_stok` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_gedung`
--

INSERT INTO `stok_gedung` (`id`, `id_gedung`, `id_obat`, `jumlah_stok`, `created_at`, `updated_at`) VALUES
(1, 5, 4, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(2, 5, 13, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(3, 5, 20, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(4, 5, 8, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(5, 5, 14, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(6, 5, 5, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(7, 5, 17, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(8, 5, 22, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(9, 5, 10, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(10, 5, 16, 1, '2026-07-11 05:54:05', '2026-07-11 05:54:05'),
(11, 5, 21, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(12, 5, 18, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(13, 5, 1, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(14, 5, 11, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(15, 5, 7, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(16, 5, 19, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(17, 5, 15, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(18, 5, 3, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(19, 5, 12, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(20, 5, 9, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(21, 5, 2, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06'),
(22, 5, 6, 1, '2026-07-11 05:54:06', '2026-07-11 05:54:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_gedung` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user_gedung') DEFAULT 'user_gedung',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_gedung`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, NULL, 'Admin Mei', 'memeimail@gmail.com', '$2y$12$j2JQYCWwqGbn6aALAQozNOQzP52DsAM8Jx0zQ6M55EOr9mDwd.TyW', 'admin', '2026-06-12 16:40:25', '2026-07-07 05:47:00', NULL),
(12, 5, 'Juben', 'juben@gmail.com', '$2y$12$sMCviRG8XxO/3X6oqB6MzeC5Hir8ZQOxL1heI5fh32PufqY5yZw4q', 'user_gedung', '2026-07-10 10:21:23', '2026-07-10 10:21:23', NULL);

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
-- Indeks untuk tabel `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_permintaan` (`id_permintaan`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_permintaan` (`id_permintaan`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_gedung` (`kode_gedung`);

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
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_obat` (`kode_obat`);

--
-- Indeks untuk tabel `penggunaan_obat`
--
ALTER TABLE `penggunaan_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_stok` (`id_stok`);

--
-- Indeks untuk tabel `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_permintaan` (`id_permintaan`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indeks untuk tabel `stok_gedung`
--
ALTER TABLE `stok_gedung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gedung` (`id_gedung`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_gedung` (`id_gedung`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `penggunaan_obat`
--
ALTER TABLE `penggunaan_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stok_gedung`
--
ALTER TABLE `stok_gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  ADD CONSTRAINT `detail_permintaan_ibfk_1` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan` (`id`),
  ADD CONSTRAINT `detail_permintaan_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`);

--
-- Ketidakleluasaan untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  ADD CONSTRAINT `distribusi_ibfk_1` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `penggunaan_obat`
--
ALTER TABLE `penggunaan_obat`
  ADD CONSTRAINT `penggunaan_obat_ibfk_1` FOREIGN KEY (`id_stok`) REFERENCES `stok_gedung` (`id`);

--
-- Ketidakleluasaan untuk tabel `permintaan`
--
ALTER TABLE `permintaan`
  ADD CONSTRAINT `permintaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_ibfk_1` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan` (`id`),
  ADD CONSTRAINT `pesan_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `stok_gedung`
--
ALTER TABLE `stok_gedung`
  ADD CONSTRAINT `stok_gedung_ibfk_1` FOREIGN KEY (`id_gedung`) REFERENCES `gedung` (`id`),
  ADD CONSTRAINT `stok_gedung_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_gedung`) REFERENCES `gedung` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
