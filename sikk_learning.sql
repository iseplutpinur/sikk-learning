-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 02:04 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `sikk_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sekolah` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `id_sekolah` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `id_sekolah`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'I', 1, '2021-07-14 20:47:21', NULL),
(2, 1, 'II', 1, '2021-07-14 20:47:21', NULL),
(3, 1, 'III', 1, '2021-07-14 20:47:21', NULL),
(4, 1, 'IV', 1, '2021-07-14 20:47:21', NULL),
(5, 1, 'V', 1, '2021-07-14 20:47:21', NULL),
(6, 1, 'VI', 1, '2021-07-14 20:47:21', NULL),
(7, 2, 'I', 1, '2021-07-14 20:48:25', NULL),
(8, 2, 'II', 1, '2021-07-14 20:48:25', NULL),
(9, 2, 'III', 1, '2021-07-14 20:48:25', NULL),
(10, 2, 'IV', 1, '2021-07-14 20:48:25', NULL),
(11, 2, 'V', 1, '2021-07-14 20:48:25', NULL),
(12, 2, 'VI', 1, '2021-07-14 20:48:25', NULL),
(13, 3, 'I', 1, '2021-07-14 20:48:42', NULL),
(14, 3, 'II', 1, '2021-07-14 20:48:42', NULL),
(15, 3, 'III', 1, '2021-07-14 20:48:42', NULL),
(16, 3, 'IV', 1, '2021-07-14 20:48:42', NULL),
(17, 3, 'V', 1, '2021-07-14 20:48:42', NULL),
(18, 3, 'VI', 1, '2021-07-14 20:48:42', NULL),
(19, 4, 'I', 1, '2021-07-14 20:49:06', NULL),
(20, 4, 'II', 1, '2021-07-14 20:49:06', NULL),
(21, 4, 'III', 1, '2021-07-14 20:49:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `lev_id` int(11) NOT NULL,
  `lev_nama` varchar(50) NOT NULL,
  `lev_keterangan` text NOT NULL,
  `lev_status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`lev_id`, `lev_nama`, `lev_keterangan`, `lev_status`, `created_at`) VALUES
(1, 'Administrator', 'Super Administrator', 'Aktif', '2020-06-18 09:40:31'),
(3, 'GuruAdmin', 'Guru administrator di masing masing sekolah', 'Aktif', '2021-07-14 12:28:52'),
(4, 'Guru', 'Guru sekolah biasa', 'Aktif', '2021-07-14 12:29:03'),
(5, 'Siswa', 'Siswa sekolah', 'Aktif', '2021-07-14 12:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_menu_id` int(11) NOT NULL,
  `menu_nama` varchar(50) NOT NULL,
  `menu_keterangan` text NOT NULL,
  `menu_index` int(11) NOT NULL,
  `menu_icon` varchar(50) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `menu_status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_menu_id`, `menu_nama`, `menu_keterangan`, `menu_index`, `menu_icon`, `menu_url`, `menu_status`, `created_at`) VALUES
(1, 0, 'Dashboard', '-', 1, 'fa fa-suitcase', 'dashboard', 'Aktif', '2020-06-18 02:40:07'),
(2, 0, 'Pengaturan', '-', 10, 'fa fa-cogs', '#', 'Aktif', '2020-06-18 02:40:07'),
(3, 2, 'Hak Akses', '-', 1, 'far fa-circle', 'pengaturan/hakAkses', 'Aktif', '2020-06-18 02:40:07'),
(4, 2, 'Menu', '-', 2, 'far fa-circle', 'pengaturan/menu', 'Aktif', '2020-06-18 02:40:07'),
(5, 2, 'Level', '-', 3, 'far fa-circle', 'pengaturan/level', 'Aktif', '2020-06-18 02:40:07'),
(6, 2, 'Pengguna', '-', 4, 'far fa-circle', 'pengaturan/pengguna', 'Aktif', '2020-06-18 02:40:07'),
(7, 0, 'Ganti Password', 'Ganti password', 99, 'fa fa-key', 'pengaturan/password', 'Aktif', '2021-06-28 08:34:14'),
(24, 0, 'Daftar Project', '-', 2, 'fas fa-clipboard-list', 'daftarProject', 'Aktif', '2021-07-14 12:46:15'),
(25, 0, 'Monitoring dan Penilaian', '-', 3, 'fas fa-desktop', 'monitoringDanPenilaian', 'Aktif', '2021-07-14 12:51:47'),
(26, 0, 'Siswa', '-', 4, 'fas fa-users', 'siswa', 'Aktif', '2021-07-14 12:53:01'),
(27, 0, 'Profile', '-', 5, 'fas fa-user', '#', 'Aktif', '2021-07-14 12:53:59'),
(28, 27, 'Sekolah', '-', 1, 'far fa-circle', 'profile/sekolah', 'Aktif', '2021-07-14 12:54:49'),
(29, 27, 'Kelas', '-', 2, 'far fa-circle', 'profile/kelas', 'Aktif', '2021-07-14 12:55:31'),
(30, 27, 'Guru', '-', 3, 'far fa-circle', 'profile/guru', 'Aktif', '2021-07-14 12:56:20'),
(31, 27, 'Pribadi', '-', 4, 'far fa-circle', 'profile/pribadi', 'Aktif', '2021-07-14 12:57:02'),
(32, 0, 'Evaluasi', '-', 5, 'fas fa-tasks', 'evaluasi', 'Aktif', '2021-07-14 12:58:50'),
(33, 0, 'Sekolah', 'Menu CRUD Sekolah Khusus Admin Pusat', 3, 'fas fa-home', '#', 'Aktif', '2021-07-14 13:34:23'),
(34, 33, 'Daftar Sekolah', '-', 1, 'far fa-circle', 'sekolah/daftarSekolah', 'Aktif', '2021-07-14 14:32:13'),
(35, 33, 'Kelas ', '-', 2, 'far fa-circle', 'sekolah/kelas', 'Aktif', '2021-07-14 14:32:42'),
(36, 33, 'Siswa ', '-', 3, 'far fa-circle', 'sekolah/siswa', 'Aktif', '2021-07-14 14:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nama_panggilan` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `strata_pendidikan` varchar(100) DEFAULT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `nomor_hp` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role_aplikasi`
--

CREATE TABLE `role_aplikasi` (
  `rola_id` int(11) NOT NULL,
  `rola_menu_id` int(11) NOT NULL,
  `rola_lev_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_aplikasi`
--

INSERT INTO `role_aplikasi` (`rola_id`, `rola_menu_id`, `rola_lev_id`, `created_at`) VALUES
(1, 1, 1, '2021-07-14 12:27:04'),
(2, 3, 1, '2021-07-14 12:27:11'),
(3, 4, 1, '2021-07-14 12:27:17'),
(4, 5, 1, '2021-07-14 12:27:25'),
(5, 6, 1, '2021-07-14 12:27:31'),
(6, 7, 1, '2021-07-14 12:27:37'),
(7, 2, 1, '2021-07-14 12:27:48'),
(8, 24, 1, '2021-07-14 13:00:21'),
(9, 25, 1, '2021-07-14 13:00:29'),
(10, 26, 1, '2021-07-14 13:00:40'),
(11, 27, 1, '2021-07-14 13:00:46'),
(13, 29, 1, '2021-07-14 13:01:00'),
(14, 30, 1, '2021-07-14 13:01:08'),
(15, 31, 1, '2021-07-14 13:01:15'),
(16, 1, 3, '2021-07-14 13:08:09'),
(17, 7, 3, '2021-07-14 13:08:17'),
(18, 24, 3, '2021-07-14 13:08:23'),
(19, 25, 3, '2021-07-14 13:08:33'),
(20, 26, 3, '2021-07-14 13:08:45'),
(21, 27, 3, '2021-07-14 13:08:56'),
(22, 28, 3, '2021-07-14 13:09:03'),
(23, 29, 3, '2021-07-14 13:09:11'),
(24, 30, 4, '2021-07-14 13:09:19'),
(25, 31, 4, '2021-07-14 13:09:27'),
(26, 30, 3, '2021-07-14 13:09:51'),
(27, 31, 3, '2021-07-14 13:10:11'),
(28, 1, 4, '2021-07-14 13:11:37'),
(29, 7, 4, '2021-07-14 13:11:46'),
(30, 25, 4, '2021-07-14 13:11:57'),
(31, 26, 4, '2021-07-14 13:12:03'),
(32, 27, 4, '2021-07-14 13:12:10'),
(34, 28, 4, '2021-07-14 13:13:10'),
(35, 29, 4, '2021-07-14 13:13:19'),
(36, 1, 5, '2021-07-14 13:13:49'),
(37, 7, 5, '2021-07-14 13:13:56'),
(38, 24, 5, '2021-07-14 13:14:11'),
(39, 27, 5, '2021-07-14 13:14:24'),
(40, 32, 5, '2021-07-14 13:14:57'),
(41, 28, 5, '2021-07-14 13:15:15'),
(42, 29, 5, '2021-07-14 13:15:22'),
(43, 30, 5, '2021-07-14 13:15:32'),
(44, 31, 5, '2021-07-14 13:15:43'),
(45, 33, 1, '2021-07-14 13:34:39'),
(46, 34, 1, '2021-07-14 14:33:31'),
(47, 35, 1, '2021-07-14 14:33:38'),
(48, 36, 1, '2021-07-14 14:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `role_id` int(11) NOT NULL,
  `role_user_id` int(11) NOT NULL,
  `role_lev_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`role_id`, `role_user_id`, `role_lev_id`, `created_at`) VALUES
(1, 1, 1, '2020-06-18 09:39:26'),
(340, 2, 3, '2021-07-14 12:39:01'),
(341, 3, 4, '2021-07-14 12:39:33'),
(342, 4, 5, '2021-07-14 12:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id`, `nama`, `alamat`, `no_telpon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SD PLEBENGAN', 'PLEBENGAN', '085798132505', 1, '2021-07-14 14:40:07', NULL),
(2, 'SD 3 PANGGANG', 'PANGGANG', '628-5340x3918', 1, '2021-07-14 14:40:40', NULL),
(3, 'SD BANTUL MANUNGGAL', 'BANTUL MANUNGGAL', '085798132505', 1, '2021-07-14 14:41:16', NULL),
(4, 'SDN BANDUNG', 'BANDUNG', '(983)628-5340x3918', 0, '2021-07-14 14:41:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(20) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa_kelas`
--

CREATE TABLE `siswa_kelas` (
  `id` int(11) NOT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_nama`, `user_password`, `user_email`, `user_phone`, `user_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin Pusat', '$2y$10$gp.46.UzygRVbGZTyzDZ6eZrMQ1q4jBhQtQSsWafE7vO3e50CfOqu', 'administrator@gmail.com', '08123123', 'Aktif', '2020-06-18 09:39:08', '2020-06-18 09:39:08'),
(2, 'GuruAdmin', '$2y$10$cuM8OFkRf3vsGWaBmmUz5.ZJ.AXZlF.Q9PAi3dcVv52shhyvlpsbG', '123456', '0123456', 'Aktif', '2021-07-14 12:39:01', NULL),
(3, 'Guru', '$2y$10$RbKHEt2IdzsVR08IsVwgUufZWXpByOKyT7e.ye6RyTLJ6KdFZ1svG', '123457', '123456', 'Aktif', '2021-07-14 12:39:33', NULL),
(4, 'Isep Lutpi Nur', '$2y$10$xr7gB/izXR.fE8xQ/nTpOej73GaISeKpPPBJW7vM6nQpJJRQwy8My', '123458', '085798132505', 'Aktif', '2021-07-14 12:40:33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`lev_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  ADD PRIMARY KEY (`rola_id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `lev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  MODIFY `rola_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
