-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 04:14 PM
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
-- Table structure for table `daftar_project`
--

CREATE TABLE `daftar_project` (
  `id` int(11) NOT NULL,
  `id_sekolah` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `nip_guru` varchar(20) DEFAULT NULL,
  `Judul` varchar(255) NOT NULL,
  `pendahuluan` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tujuan` text DEFAULT NULL,
  `link_sumber` varchar(200) DEFAULT NULL,
  `jumlah_aktifitas` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 Draft | 1 Simpan |',
  `gambar` text NOT NULL,
  `suara` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_project`
--

INSERT INTO `daftar_project` (`id`, `id_sekolah`, `id_kelas`, `nip_guru`, `Judul`, `pendahuluan`, `deskripsi`, `tujuan`, `link_sumber`, `jumlah_aktifitas`, `status`, `gambar`, `suara`, `created_at`, `updated_at`) VALUES
(4, 3, 18, 'guru3', '', NULL, NULL, NULL, NULL, NULL, 0, '', '', '2021-07-16 23:17:49', NULL),
(5, 1, 1, 'guru', 'Testing', NULL, '<p><br></p>', '<p><br></p>', '<p><br></p>', 5, 1, '', '', '2021-07-19 14:11:38', NULL),
(6, 1, 1, 'guru', '1', NULL, '<p><br></p>', '<p><br></p>', '<p><br></p>', 1, 1, '', '', '2021-07-19 14:12:05', NULL),
(7, 1, 1, 'guru', '', NULL, NULL, NULL, NULL, NULL, 0, '', '', '2021-07-19 14:12:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_project_detail`
--

CREATE TABLE `daftar_project_detail` (
  `id` int(11) NOT NULL,
  `id_daftar_project` int(11) DEFAULT NULL,
  `id_template` int(11) DEFAULT NULL,
  `naskah` text DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `lembar_kerja` text DEFAULT NULL,
  `jenis_upload` varchar(100) DEFAULT NULL,
  `nilai` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sekolah` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '0 Tidak Aktif | 1 Aktif | 2 Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `id_user`, `id_sekolah`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_hp`, `status`, `created_at`, `updated_at`) VALUES
('987321', 25, 1, 'Ani Ayu Pratiwi', 'Perempuan', '2021-07-17', 'Cirebon', '0254', 1, '2021-07-17 15:42:41', '2021-07-17 15:43:39'),
('guru', 12, 1, 'Isep Lutpi Nur 1', 'Laki-Laki', '2021-07-15', 'Cianjur', '085798132505', 1, '2021-07-16 13:43:44', '2021-07-16 23:12:38'),
('guru1', 17, 3, 'Isep Lutpi Nur', 'Laki-Laki', '2021-07-21', 'Cianjur', '085798132505', 1, '2021-07-16 23:09:14', NULL),
('guru2', 18, 1, 'M ilham solehudin', 'Laki-Laki', '2021-07-28', '-', '085798132505', 1, '2021-07-16 23:13:04', '2021-07-16 23:13:37'),
('guru3', 19, 3, 'M ilham solehudin 3', 'Laki-Laki', '2021-07-23', '-', '085798132505', 2, '2021-07-16 23:16:58', '2021-07-18 19:42:00'),
('guru5', 27, 3, 'Abul aziz', 'Laki-Laki', '2021-07-17', 'Cianjur', '123', 2, '2021-07-18 23:49:30', NULL),
('guruadmin', 10, 3, 'M. Ath thariq', 'Laki-Laki', '2021-07-17', 'BDG', '0857981325059', 1, '2021-07-16 03:14:17', '2021-07-16 15:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru_kelas`
--

INSERT INTO `guru_kelas` (`id`, `nip`, `id_kelas`, `status`, `created_at`, `updated_at`) VALUES
(1, 'guruadmin', 18, 1, '2021-07-16 03:14:17', '2021-07-16 15:14:35'),
(2, 'guru', 1, 1, '2021-07-16 13:43:44', '2021-07-16 23:12:38'),
(3, 'guru1', 18, 1, '2021-07-16 23:09:14', NULL),
(4, 'guru2', 1, 1, '2021-07-16 23:13:04', '2021-07-16 23:13:37'),
(5, 'guru3', 18, 2, '2021-07-16 23:16:58', '2021-07-18 19:42:00'),
(6, '987321', 4, 1, '2021-07-17 15:42:41', '2021-07-17 15:43:39'),
(7, 'guru5', 17, 2, '2021-07-18 23:49:30', NULL);

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
(1, 1, 'I', 1, '2021-07-14 13:47:21', NULL),
(2, 1, 'II', 1, '2021-07-14 13:47:21', NULL),
(3, 1, 'III', 1, '2021-07-14 13:47:21', NULL),
(4, 1, 'IV', 1, '2021-07-14 13:47:21', NULL),
(5, 1, 'V', 1, '2021-07-14 13:47:21', NULL),
(6, 1, 'VI', 1, '2021-07-14 13:47:21', NULL),
(7, 2, 'I', 1, '2021-07-14 13:48:25', NULL),
(8, 2, 'II', 1, '2021-07-14 13:48:25', NULL),
(9, 2, 'III', 1, '2021-07-14 13:48:25', NULL),
(10, 2, 'IV', 1, '2021-07-14 13:48:25', NULL),
(11, 2, 'V', 1, '2021-07-14 13:48:25', NULL),
(12, 2, 'VI', 1, '2021-07-14 13:48:25', NULL),
(13, 3, 'I', 1, '2021-07-14 13:48:42', NULL),
(14, 3, 'II', 1, '2021-07-14 13:48:42', NULL),
(15, 3, 'III', 1, '2021-07-14 13:48:42', NULL),
(16, 3, 'IV', 1, '2021-07-14 13:48:42', NULL),
(17, 3, 'V', 1, '2021-07-14 13:48:42', NULL),
(18, 3, 'VI', 1, '2021-07-14 13:48:42', NULL),
(19, 4, 'I', 1, '2021-07-14 13:49:06', NULL),
(20, 4, 'II', 1, '2021-07-14 13:49:06', NULL),
(21, 4, 'III', 1, '2021-07-14 13:49:06', NULL),
(25, 3, 'VII', 1, '2021-07-18 20:35:21', NULL);

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
(3, 'Guru Administrator', 'Guru administrator di masing masing sekolah', 'Aktif', '2021-07-14 12:28:52'),
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
(24, 0, 'Daftar Project', '-', 2, 'fas fa-clipboard-list', '#', 'Aktif', '2021-07-14 12:46:15'),
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
(36, 33, 'Siswa ', '-', 4, 'far fa-circle', 'sekolah/siswa', 'Aktif', '2021-07-14 14:33:10'),
(37, 33, 'Guru ', 'Super admin kelola guru sekolah\n', 3, 'far fa-circle', 'sekolah/guru', 'Aktif', '2021-07-16 02:45:10'),
(38, 24, 'Data Project', 'Daftar project', 1, 'far fa-circle', 'project/data', 'Aktif', '2021-07-16 06:24:53'),
(39, 24, 'Project Siswa', 'Daftar project siswa', 2, 'far fa-circle', 'project/siswa', 'Aktif', '2021-07-16 06:26:01'),
(40, 2, 'Registrasi', 'Mengatur halaman registrasi', 5, 'far fa-circle', 'pengaturan/registrasi', 'Aktif', '2021-07-18 20:44:14'),
(41, 24, 'Template', '-', 3, 'far fa-circle', 'project/template', 'Aktif', '2021-07-19 14:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_registrasi`
--

CREATE TABLE `pengaturan_registrasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `nilai` int(1) NOT NULL DEFAULT 0 COMMENT '0 Tidak Aktif | 1 Aktif',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan_registrasi`
--

INSERT INTO `pengaturan_registrasi` (`id`, `nama`, `keterangan`, `nilai`, `created_at`, `updated_at`) VALUES
(5, 'siswa', 'Nilai pengaturan untuk halaman registrasi siswa', 0, '2021-07-19 06:18:29', '2021-07-19 06:50:47'),
(6, 'guru', 'Nilai pengaturan untuk halaman registrasi guru', 0, '2021-07-19 06:18:29', '2021-07-19 06:50:02');

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
(3, 4, 1, '2021-07-14 12:27:17'),
(4, 5, 1, '2021-07-14 12:27:25'),
(5, 6, 1, '2021-07-14 12:27:31'),
(6, 7, 1, '2021-07-14 12:27:37'),
(7, 2, 1, '2021-07-14 12:27:48'),
(8, 24, 1, '2021-07-14 13:00:21'),
(9, 25, 1, '2021-07-14 13:00:29'),
(11, 27, 1, '2021-07-14 13:00:46'),
(13, 29, 1, '2021-07-14 13:01:00'),
(14, 30, 1, '2021-07-14 13:01:08'),
(15, 31, 1, '2021-07-14 13:01:15'),
(16, 1, 3, '2021-07-14 13:08:09'),
(17, 7, 3, '2021-07-14 13:08:17'),
(18, 24, 3, '2021-07-14 13:08:23'),
(19, 25, 3, '2021-07-14 13:08:33'),
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
(39, 27, 5, '2021-07-14 13:14:24'),
(40, 32, 5, '2021-07-14 13:14:57'),
(41, 28, 5, '2021-07-14 13:15:15'),
(42, 29, 5, '2021-07-14 13:15:22'),
(43, 30, 5, '2021-07-14 13:15:32'),
(44, 31, 5, '2021-07-14 13:15:43'),
(45, 33, 1, '2021-07-14 13:34:39'),
(46, 34, 1, '2021-07-14 14:33:31'),
(47, 35, 1, '2021-07-14 14:33:38'),
(48, 36, 1, '2021-07-14 14:33:49'),
(49, 37, 1, '2021-07-16 02:45:47'),
(50, 35, 3, '2021-07-16 04:04:22'),
(51, 37, 3, '2021-07-16 04:04:36'),
(52, 36, 3, '2021-07-16 04:04:47'),
(53, 33, 3, '2021-07-16 04:04:55'),
(54, 39, 1, '2021-07-16 06:26:44'),
(55, 38, 1, '2021-07-16 06:27:53'),
(59, 24, 5, '2021-07-16 08:24:22'),
(60, 38, 3, '2021-07-16 10:24:47'),
(61, 39, 3, '2021-07-16 10:24:48'),
(62, 24, 4, '2021-07-16 13:45:47'),
(63, 38, 4, '2021-07-16 13:45:48'),
(64, 39, 4, '2021-07-16 13:45:49'),
(65, 33, 4, '2021-07-16 13:45:54'),
(66, 36, 4, '2021-07-16 13:45:58'),
(67, 40, 1, '2021-07-18 20:44:36'),
(68, 41, 1, '2021-07-19 14:04:13');

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
(2, 2, 3, '2021-07-14 12:39:01'),
(3, 3, 4, '2021-07-14 12:39:33'),
(4, 4, 5, '2021-07-14 12:40:33'),
(6, 9, 5, '2021-07-15 08:18:40'),
(7, 10, 3, '2021-07-16 03:14:17'),
(8, 11, 5, '2021-07-16 10:53:23'),
(9, 12, 4, '2021-07-16 13:43:44'),
(10, 13, 5, '2021-07-16 13:47:41'),
(11, 14, 5, '2021-07-16 14:11:51'),
(12, 15, 5, '2021-07-16 14:52:34'),
(14, 17, 4, '2021-07-16 23:09:14'),
(15, 18, 4, '2021-07-16 23:13:04'),
(16, 19, 4, '2021-07-16 23:16:58'),
(17, 20, 5, '2021-07-17 02:29:29'),
(18, 21, 5, '2021-07-17 14:38:27'),
(19, 22, 5, '2021-07-17 15:15:46'),
(20, 23, 5, '2021-07-17 15:20:08'),
(21, 24, 5, '2021-07-17 15:22:43'),
(22, 25, 4, '2021-07-17 15:42:41'),
(23, 26, 5, '2021-07-18 23:34:36'),
(24, 27, 4, '2021-07-18 23:49:30');

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
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `alamat` text NOT NULL,
  `status` int(1) DEFAULT NULL COMMENT '0 Tidak Aktif | 1 Aktif | 2 Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `id_user`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
('10203040', 15, 'Ai Latipah', '2021-07-15', 'Perempuan', 'Cianjur', 1, '2021-07-16 14:52:34', NULL),
('123', 14, 'Asep septiadi', '2021-07-02', 'Perempuan', 'bekasi', 1, '2021-07-16 14:11:51', '2021-07-16 14:29:56'),
('1234567', 9, 'M ilham solehudin', '2021-07-31', 'Laki-Laki', 'Bandung', 1, '2021-07-15 08:18:40', '2021-07-15 08:18:55'),
('123458', 4, 'Isep Lutpi Nur', '2000-08-10', 'Laki-Laki', 'Cianjur', 1, '2021-07-15 01:15:46', NULL),
('185798', 13, 'Biasa', '2021-07-29', 'Perempuan', '123', 1, '2021-07-16 13:47:41', '2021-07-16 14:51:56'),
('2113191079', 20, 'Isep Lutpi Nur 5', '2021-07-24', 'Laki-Laki', 'Cianjur', 1, '2021-07-17 02:29:29', '2021-07-17 03:10:56'),
('333', 23, 'M taufiq ali', '2021-07-31', 'Laki-Laki', 'CIMAHI', 2, '2021-07-17 15:20:08', '2021-07-18 19:10:13'),
('55555', 22, 'Ahmad rizal imaduddin', '2021-07-17', 'Laki-Laki', 'Nusa tenggara timur', 2, '2021-07-17 15:15:46', '2021-07-18 19:10:05'),
('654321', 26, 'Sandi solehudin', '2021-07-10', 'Laki-Laki', 'Cidaun', 2, '2021-07-18 23:34:36', NULL),
('67890', 24, 'Dara Atria Ferliandini', '2021-07-24', 'Perempuan', 'Bandung', 0, '2021-07-17 15:22:43', '2021-07-17 15:24:44'),
('777777777', 11, 'Adje abdul aziz', '2021-07-16', 'Laki-Laki', 'Cimahi', 1, '2021-07-16 10:53:23', NULL),
('987654', 21, 'Adistia Ramadhani', '2000-08-10', 'Perempuan', 'Cicaheum', 1, '2021-07-17 14:38:27', '2021-07-17 15:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_kelas`
--

CREATE TABLE `siswa_kelas` (
  `id` int(11) NOT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa_kelas`
--

INSERT INTO `siswa_kelas` (`id`, `nisn`, `id_kelas`, `status`, `created_at`, `updated_at`) VALUES
(1, '123458', 21, 1, '2021-07-15 01:16:44', NULL),
(3, '1234567', 7, 1, '2021-07-15 08:18:40', '2021-07-15 08:18:55'),
(4, '777777777', 15, 1, '2021-07-16 10:53:23', NULL),
(5, '185798', 1, 1, '2021-07-16 13:47:41', '2021-07-16 14:51:56'),
(6, '123', 1, 1, '2021-07-16 14:11:51', '2021-07-16 14:29:56'),
(7, '10203040', 1, 1, '2021-07-16 14:52:34', NULL),
(9, '2113191079', 18, 1, '2021-07-17 02:29:29', '2021-07-17 03:10:56'),
(10, '987654', 13, 1, '2021-07-17 14:38:27', '2021-07-17 15:12:35'),
(11, '55555', 13, 2, '2021-07-17 15:15:46', '2021-07-18 19:10:05'),
(12, '333', 13, 2, '2021-07-17 15:20:08', '2021-07-18 19:10:13'),
(13, '67890', 1, 0, '2021-07-17 15:22:43', '2021-07-17 15:24:44'),
(14, '654321', 25, 2, '2021-07-18 23:34:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `judul` varchar(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` text NOT NULL,
  `suara` text NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE `tes` (
  `id` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `deskripsi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tes`
--

INSERT INTO `tes` (`id`, `nama`, `deskripsi`) VALUES
(1, '123 tes1', '1222 tes1'),
(2, '123 tes2', '1222 tes1'),
(3, '123...sada', '1222 tes3'),
(6, '123 tes1', '1222 tes1'),
(7, '123 tes2', '1222 tes1'),
(14, '123 tes1', '1222 tes1'),
(15, '123 tes2', '1222 tes1'),
(16, '123...sada', '1222 tes3'),
(17, '123 tes1', '1222 tes1'),
(18, '123 tes2', '1222 tes1'),
(19, '123...sada', '1222 tes3');

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
  `user_status` int(1) NOT NULL DEFAULT 0 COMMENT '0 Tidak Aktif | 1 Aktif | 2 Pendding',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_nama`, `user_password`, `user_email`, `user_phone`, `user_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin Pusat', '$2y$10$gp.46.UzygRVbGZTyzDZ6eZrMQ1q4jBhQtQSsWafE7vO3e50CfOqu', 'administrator@gmail.com', '08123123', 1, '2020-06-18 09:39:08', '2020-06-18 09:39:08'),
(2, 'GuruAdmin', '$2y$10$cuM8OFkRf3vsGWaBmmUz5.ZJ.AXZlF.Q9PAi3dcVv52shhyvlpsbG', '123456', '0123456', 1, '2021-07-14 12:39:01', NULL),
(3, 'Guru', '$2y$10$RbKHEt2IdzsVR08IsVwgUufZWXpByOKyT7e.ye6RyTLJ6KdFZ1svG', '123457', '123456', 1, '2021-07-14 12:39:33', NULL),
(4, 'Isep Lutpi Nur', '$2y$10$xr7gB/izXR.fE8xQ/nTpOej73GaISeKpPPBJW7vM6nQpJJRQwy8My', '123458', '085798132505', 1, '2021-07-14 12:40:33', NULL),
(9, 'M ilham solehudin', '$2y$10$Jkos91pNm5XiIN8R6v6BPeLVZ8YJP1RLgPq6aRFF6FP0dUSbQNh26', '1234567', '0223123123', 1, '2021-07-15 08:18:40', '2021-07-16 23:43:04'),
(10, 'M. Ath thariq', '$2y$10$H77DmFTbNyc6A19oh8Zaley5CqZCWxf5OhLEIuUhakRGx2zVejGwq', 'guruadmin', '0857981325059', 1, '2021-07-16 03:14:17', '2021-07-16 15:14:35'),
(11, 'Adje abdul aziz', '$2y$10$RcZHX37TRR6PgMEl8LSTyuM72o5A6dog7AEQenRw7QDDAFhckzn.W', '777777777', '0223123123', 1, '2021-07-16 10:53:23', NULL),
(12, 'Isep Lutpi Nur 1', '$2y$10$kRb4EgmTHSa67kxkz43EyePqdeX.3PfZlQFnjdF0eRFt5OICLOrvK', 'guru', '085798132505', 1, '2021-07-16 13:43:44', '2021-07-16 23:12:38'),
(13, 'Biasa', '$2y$10$PyO23nqy6M1QBYPMDZTPvO9C4INmo2AjEX7Q6491u/o1Lw8vO8b2m', '185798', '0223123123', 1, '2021-07-16 13:47:41', '2021-07-16 14:51:56'),
(14, 'Asep septiadi', '$2y$10$rEWyupQecC2Va8prtp2SIenwXPbTe3wwMR7BBAuU9GKqr.nT7T3a.', '123', '0223123123', 1, '2021-07-16 14:11:51', '2021-07-16 14:29:56'),
(15, 'Ai Latipah', '$2y$10$Zf/h4TxzAHhjwzDzQd8rjur3dISoq7MyotVwoGQMp.dQCbgVFPwjS', '10203040', '0223123123', 1, '2021-07-16 14:52:34', NULL),
(17, 'Isep Lutpi Nur', '$2y$10$/4KlzqGV/D8vOutEmcqzCOVGxMBNpRh/ih/nRDXAr5eb49hg2hUWS', 'guru1', '085798132505', 1, '2021-07-16 23:09:14', NULL),
(18, 'M ilham solehudin', '$2y$10$VrnBGhRA51uFKJEqDyWnIu92YnyEfIa.HrNEulDC91c6pNU1nae8q', 'guru2', '085798132505', 1, '2021-07-16 23:13:04', '2021-07-16 23:13:37'),
(19, 'M ilham solehudin 3', '$2y$10$CUUka6Tu27vrqrE27mj3V.toNIcshYK8O06Da3roa2I6k7bAVQOpK', 'guru3', '085798132505', 2, '2021-07-16 23:16:58', '2021-07-18 19:42:00'),
(20, 'Isep Lutpi Nur 5', '$2y$10$H.3BGy/7U3pOk8QToex1dei/HeXTX.AI85fPMJocNtC/71V3ODfPm', '2113191079', '085798132505', 1, '2021-07-17 02:29:29', '2021-07-17 03:10:56'),
(21, 'Adistia Ramadhani', '$2y$10$Rl4EK2nlSTELPFY7YUPYTei.uTT98h2grqX6AaQckkYIwOFzBKz5a', '987654', '0123', 1, '2021-07-17 14:38:27', '2021-07-17 15:12:35'),
(22, 'Ahmad rizal imaduddin', '$2y$10$iwPFB6iPtRTozNjcqOD92eR0VznzjhLDvXWsf7npKJqQDq7ITFtPu', '55555', '99990', 2, '2021-07-17 15:15:46', '2021-07-18 19:10:05'),
(23, 'M taufiq ali', '$2y$10$EFrFKbDOt5cEdvkq//xX3OmxY9Cc4y.8ySapIK0KBcR6A/xcMlDpa', '333', '085798132505', 2, '2021-07-17 15:20:08', '2021-07-18 19:10:13'),
(24, 'Dara Atria Ferliandini', '$2y$10$kxmONr5JAkAGtOHd3cvykeQOkzpQqHUFk6tx4ievvnZl5s/GL7/5W', '67890', '99990', 0, '2021-07-17 15:22:43', '2021-07-17 15:24:44'),
(25, 'Ani Ayu Pratiwi', '$2y$10$a9x3BQ.uit1/h7eOnTPHduOAlxjsT3N5/GjunEAmTQNieXWxsfmfi', '987321', '0254', 1, '2021-07-17 15:42:41', '2021-07-17 15:43:39'),
(26, 'Sandi solehudin', '$2y$10$DKQfR6E5tFjDislu9txeyuyVq6A/PSAwcf5EqZ6YlT2FELWIOabTW', '654321', 'administrator@g', 2, '2021-07-18 23:34:36', NULL),
(27, 'Abul aziz', '$2y$10$.oOK6v9ZFGzDIoaaKwTxMuzEmnk734KZPRjFFRzWQLaE7wK9JCXgq', 'guru5', '123', 2, '2021-07-18 23:49:30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_project`
--
ALTER TABLE `daftar_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_project_detail`
--
ALTER TABLE `daftar_project_detail`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pengaturan_registrasi`
--
ALTER TABLE `pengaturan_registrasi`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tes`
--
ALTER TABLE `tes`
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
-- AUTO_INCREMENT for table `daftar_project`
--
ALTER TABLE `daftar_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `daftar_project_detail`
--
ALTER TABLE `daftar_project_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `lev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pengaturan_registrasi`
--
ALTER TABLE `pengaturan_registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  MODIFY `rola_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tes`
--
ALTER TABLE `tes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;
