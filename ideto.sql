-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 02:03 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ideto`
--

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `judul` varchar(250) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(250) DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `status` enum('Darft','Disimpan','Diterbitkan') NOT NULL DEFAULT 'Darft',
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `id_kategori`, `judul`, `deskripsi`, `gambar`, `penulis`, `status`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 8, 'Kategori', 'tes deskripsi', 'gambar', 'penulis', 'Disimpan', '2021-07-13', '2021-07-13 20:59:17', NULL),
(7, 8, 'Termin 1', '<p><img src=\"http://localhost/aplikasi/pro/ideto/images/informasi/list/7/bajay2.png\" alt=\"bajay2.png\" style=\"width: 25%;\"><br></p>', '7.png||bajay2.png', '7', 'Disimpan', '2021-07-13', '2021-07-13 23:45:48', NULL),
(8, 8, 'Testing Informasi', '<p>Indonesia merdeka</p>', '8.png|', 'Isep Lutpi Nur', 'Disimpan', '2021-07-13', '2021-07-13 23:55:46', NULL),
(9, NULL, '', NULL, NULL, NULL, 'Darft', NULL, '2021-07-13 23:55:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `tanggal`, `created_at`, `updated_at`) VALUES
(8, 'Biasa', '2021-07-13', '2021-07-13 15:04:33', '2021-07-13 15:19:37'),
(9, 'Penting', '2021-07-13', '2021-07-13 15:19:50', NULL),
(10, 'Sangat Penting', '2021-07-13', '2021-07-13 15:19:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'administrator', 1, 0, 0, NULL, 20210713);

-- --------------------------------------------------------

--
-- Table structure for table `konten_about_ideto`
--

CREATE TABLE `konten_about_ideto` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `profil_judul` varchar(100) DEFAULT NULL,
  `profil_deskripsi` text DEFAULT NULL,
  `profil_gambar` varchar(250) DEFAULT NULL,
  `sejarah_judul` varchar(100) DEFAULT NULL,
  `sejarah_deskripsi` text DEFAULT NULL,
  `sejarah_gambar` varchar(250) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten_about_ideto`
--

INSERT INTO `konten_about_ideto` (`id`, `slider_judul`, `slider_deskripsi`, `profil_judul`, `profil_deskripsi`, `profil_gambar`, `sejarah_judul`, `sejarah_deskripsi`, `sejarah_gambar`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'Membangun Peradaban dengan Menulis', 'Membangun Peradaban dengan Menulis', 'Profile judul', '<p><img src=\"http://localhost/aplikasi/pro/ideto/images/about/ideto/profile-deskripsi/Kata_Kata.png\" alt=\"Kata_Kata.png\" style=\"width: 50%;\"><br></p>', 'Kata_Kata.png', 'Sejarah judul', '<p><br></p>', '', NULL, '2021-07-12 09:13:59', '2021-07-13 20:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `konten_about_kebijakan`
--

CREATE TABLE `konten_about_kebijakan` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `judul_1` varchar(100) DEFAULT NULL,
  `deskripsi_1` text DEFAULT NULL,
  `gambar_1` varchar(100) DEFAULT NULL,
  `judul_2` varchar(100) DEFAULT NULL,
  `deskripsi_2` text DEFAULT NULL,
  `gambar_2` varchar(100) DEFAULT NULL,
  `judul_3` varchar(100) DEFAULT NULL,
  `deskripsi_3` text DEFAULT NULL,
  `gambar_3` varchar(100) DEFAULT NULL,
  `judul_4` varchar(100) DEFAULT NULL,
  `deskripsi_4` text DEFAULT NULL,
  `gambar_4` varchar(100) DEFAULT NULL,
  `judul_5` varchar(100) DEFAULT NULL,
  `deskripsi_5` text DEFAULT NULL,
  `gambar_5` varchar(100) DEFAULT NULL,
  `judul_6` varchar(100) DEFAULT NULL,
  `deskripsi_6` text DEFAULT NULL,
  `gambar_6` varchar(100) DEFAULT NULL,
  `judul_7` varchar(100) DEFAULT NULL,
  `deskripsi_7` text DEFAULT NULL,
  `gambar_7` varchar(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten_about_kebijakan`
--

INSERT INTO `konten_about_kebijakan` (`id`, `slider_judul`, `slider_deskripsi`, `judul_1`, `deskripsi_1`, `gambar_1`, `judul_2`, `deskripsi_2`, `gambar_2`, `judul_3`, `deskripsi_3`, `gambar_3`, `judul_4`, `deskripsi_4`, `gambar_4`, `judul_5`, `deskripsi_5`, `gambar_5`, `judul_6`, `deskripsi_6`, `gambar_6`, `judul_7`, `deskripsi_7`, `gambar_7`, `tanggal`, `created_at`, `updated_at`) VALUES
(2, '1', '1', 'judul 1', '<p>deskripsi 1</p>', NULL, 'judul 2', '<p>deskripsi 2</p>', NULL, 'judul 3', '<p>deskripsi 3</p>', NULL, 'judul 4', '<p>deskripsi 4</p>', NULL, 'judul 5', '<p>deskripsi 5</p>', NULL, 'judul 6', '<p>deskripsi 6</p>', NULL, 'judul 7', '<p>deskripsi 7</p>', NULL, NULL, '2021-07-12 09:14:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konten_about_lain_lain`
--

CREATE TABLE `konten_about_lain_lain` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `judul_1` varchar(100) DEFAULT NULL,
  `deskripsi_1` text DEFAULT NULL,
  `gambar_1` varchar(100) DEFAULT NULL,
  `judul_2` varchar(100) DEFAULT NULL,
  `deskripsi_2` text DEFAULT NULL,
  `gambar_2` varchar(100) DEFAULT NULL,
  `judul_3` varchar(100) DEFAULT NULL,
  `deskripsi_3` text DEFAULT NULL,
  `gambar_3` varchar(100) DEFAULT NULL,
  `judul_4` varchar(100) DEFAULT NULL,
  `deskripsi_4` text DEFAULT NULL,
  `gambar_4` varchar(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten_about_lain_lain`
--

INSERT INTO `konten_about_lain_lain` (`id`, `slider_judul`, `slider_deskripsi`, `judul_1`, `deskripsi_1`, `gambar_1`, `judul_2`, `deskripsi_2`, `gambar_2`, `judul_3`, `deskripsi_3`, `gambar_3`, `judul_4`, `deskripsi_4`, `gambar_4`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1', '<p>1</p>', NULL, '2', '<p>2</p>', NULL, '3', '<p>3</p>', NULL, '4', '<p>4</p>', NULL, NULL, '2021-07-12 09:14:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konten_about_penata_laksana`
--

CREATE TABLE `konten_about_penata_laksana` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten_about_penata_laksana`
--

INSERT INTO `konten_about_penata_laksana` (`id`, `slider_judul`, `slider_deskripsi`, `tanggal`, `created_at`, `updated_at`) VALUES
(3, 'asdas 21', 'asdasd 21312', NULL, '2021-07-12 09:14:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konten_about_penyerahan`
--

CREATE TABLE `konten_about_penyerahan` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `judul_1` varchar(100) DEFAULT NULL,
  `deskripsi_1` text DEFAULT NULL,
  `gambar_1` varchar(100) DEFAULT NULL,
  `judul_2` varchar(100) DEFAULT NULL,
  `deskripsi_2` text DEFAULT NULL,
  `gambar_2` varchar(100) DEFAULT NULL,
  `judul_3` varchar(100) DEFAULT NULL,
  `deskripsi_3` text DEFAULT NULL,
  `gambar_3` varchar(100) DEFAULT NULL,
  `judul_4` varchar(100) DEFAULT NULL,
  `deskripsi_4` text DEFAULT NULL,
  `gambar_4` varchar(100) DEFAULT NULL,
  `judul_5` varchar(100) DEFAULT NULL,
  `deskripsi_5` text DEFAULT NULL,
  `gambar_5` varchar(100) DEFAULT NULL,
  `judul_6` varchar(100) DEFAULT NULL,
  `deskripsi_6` text DEFAULT NULL,
  `gambar_6` varchar(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten_about_penyerahan`
--

INSERT INTO `konten_about_penyerahan` (`id`, `slider_judul`, `slider_deskripsi`, `judul_1`, `deskripsi_1`, `gambar_1`, `judul_2`, `deskripsi_2`, `gambar_2`, `judul_3`, `deskripsi_3`, `gambar_3`, `judul_4`, `deskripsi_4`, `gambar_4`, `judul_5`, `deskripsi_5`, `gambar_5`, `judul_6`, `deskripsi_6`, `gambar_6`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1', '<p>1</p>', NULL, '2', '<p>2</p>', NULL, '3', '<p>3</p>', NULL, '4', '<p>4</p>', NULL, '5', '<p>5</p>', NULL, '6', '<p>6</p>', NULL, NULL, '2021-07-12 09:14:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konten_arsip`
--

CREATE TABLE `konten_arsip` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten_arsip`
--

INSERT INTO `konten_arsip` (`id`, `slider_judul`, `slider_deskripsi`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'arsip 2', 'arsip 3', NULL, '2021-07-12 09:14:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konten_artikel`
--

CREATE TABLE `konten_artikel` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten_artikel`
--

INSERT INTO `konten_artikel` (`id`, `slider_judul`, `slider_deskripsi`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'artikel 1', 'artikel 2', NULL, '2021-07-12 09:14:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konten_home`
--

CREATE TABLE `konten_home` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `informasi_judul` varchar(100) DEFAULT NULL,
  `informasi_deskripsi` text DEFAULT NULL,
  `informasi_gambar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten_home`
--

INSERT INTO `konten_home` (`id`, `slider_judul`, `slider_deskripsi`, `informasi_judul`, `informasi_deskripsi`, `informasi_gambar`, `created_at`, `updated_at`) VALUES
(3, NULL, NULL, NULL, NULL, 'bajay2.png', '2021-07-13 19:16:38', '2021-07-13 23:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `konten_informasi`
--

CREATE TABLE `konten_informasi` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten_informasi`
--

INSERT INTO `konten_informasi` (`id`, `slider_judul`, `slider_deskripsi`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, '2', '2', NULL, '2021-07-12 09:15:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konten_pencarian`
--

CREATE TABLE `konten_pencarian` (
  `id` int(11) NOT NULL,
  `slider_judul` varchar(100) DEFAULT NULL,
  `slider_deskripsi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `konten_utama`
--

CREATE TABLE `konten_utama` (
  `id` int(11) NOT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `tentang_aplikasi` text DEFAULT NULL,
  `kata_pencarian` text DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `copyright` varchar(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Administrator', '-', 'Aktif', '2020-06-18 09:40:31'),
(9, 'Review', '-', 'Aktif', '2021-07-09 02:55:18');

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
(1, 0, 'Dashboard', '-', 1, 'fa fa-suitcase', 'dashboard', 'Aktif', '2020-06-18 09:40:07'),
(2, 0, 'Pengaturan', '-', 10, 'fa fa-cogs', '#', 'Aktif', '2020-06-18 09:40:07'),
(3, 2, 'Hak Akses', '-', 1, 'far fa-circle', 'pengaturan/hakAkses', 'Aktif', '2020-06-18 09:40:07'),
(4, 2, 'Menu', '-', 2, 'far fa-circle', 'pengaturan/menu', 'Aktif', '2020-06-18 09:40:07'),
(5, 2, 'Level', '-', 3, 'far fa-circle', 'pengaturan/level', 'Aktif', '2020-06-18 09:40:07'),
(6, 2, 'Pengguna', '-', 4, 'far fa-circle', 'pengaturan/pengguna', 'Aktif', '2020-06-18 09:40:07'),
(64, 0, 'Ganti Password', 'Ganti password', 99, 'fa fa-key', 'pengaturan/password', 'Aktif', '2021-06-28 15:34:14'),
(69, 0, 'About', '-', 3, 'fas fa-address-card', '#', 'Aktif', '2021-07-08 13:38:35'),
(70, 69, 'Konten Ideto', '-', 1, ' far fa-circle', 'about/ideto', 'Aktif', '2021-07-08 13:42:47'),
(71, 69, 'Konten Penata Laksana', '-', 2, 'far fa-circle', 'about/penataLaksana', 'Aktif', '2021-07-08 13:44:03'),
(72, 69, 'Konten Penyerahan', '-', 4, 'far fa-circle', 'about/penyerahan', 'Aktif', '2021-07-08 13:45:10'),
(73, 69, 'Konten Kebijakan', '-', 3, 'far fa-circle', 'about/kebijakan', 'Aktif', '2021-07-08 13:46:11'),
(74, 69, 'Konten Lain-Lain', '-', 5, 'far fa-circle', 'about/lainLain', 'Aktif', '2021-07-08 13:46:36'),
(75, 0, 'Home', '-', 2, 'fa fa-home', '#', 'Aktif', '2021-07-09 02:20:41'),
(76, 75, 'Konten Home', '-', 1, 'far fa-circle', 'home/konten', 'Aktif', '2021-07-09 02:22:08'),
(77, 0, 'Artikel', '-', 4, 'fa fa-book', '#', 'Aktif', '2021-07-09 02:32:30'),
(78, 77, 'Konten Artikel', '-', 1, 'fa fa-circle', 'artikel/konten', 'Aktif', '2021-07-09 02:33:14'),
(79, 0, 'Arsip', '-', 5, 'fa fa-archive', '#', 'Aktif', '2021-07-09 02:34:24'),
(80, 79, 'Konten Arsip', '-', 1, 'fa fa-circle', 'arsip/konten', 'Aktif', '2021-07-09 02:34:42'),
(81, 0, 'Informasi', '-', 6, 'fa fa-info', '#', 'Aktif', '2021-07-09 02:47:40'),
(82, 81, 'Konten Informasi', '-', 1, 'fa fa-circle', 'informasi/konten', 'Aktif', '2021-07-09 02:48:14'),
(83, 81, 'List Informasi', '-', 2, 'fa fa-circle', 'informasi/listInformasi', 'Aktif', '2021-07-09 02:53:19'),
(84, 81, 'Kategori', '-', 3, 'far fa-circle', 'informasi/kategori', 'Aktif', '2021-07-12 09:02:37');

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
(97, 1, 1, '2021-07-07 23:00:32'),
(98, 3, 1, '2021-07-07 23:00:44'),
(99, 4, 1, '2021-07-07 23:00:51'),
(100, 5, 1, '2021-07-07 23:00:57'),
(101, 6, 1, '2021-07-07 23:01:00'),
(102, 64, 1, '2021-07-07 23:01:04'),
(103, 2, 1, '2021-07-07 23:01:26'),
(104, 69, 1, '2021-07-08 13:38:44'),
(105, 70, 1, '2021-07-08 13:48:17'),
(106, 71, 1, '2021-07-08 13:48:24'),
(107, 72, 1, '2021-07-08 13:48:31'),
(109, 73, 1, '2021-07-08 13:49:21'),
(110, 74, 1, '2021-07-08 13:49:32'),
(111, 75, 1, '2021-07-09 02:20:49'),
(112, 76, 1, '2021-07-09 02:22:17'),
(113, 77, 1, '2021-07-09 02:33:27'),
(114, 78, 1, '2021-07-09 02:33:33'),
(115, 79, 1, '2021-07-09 02:34:51'),
(116, 80, 1, '2021-07-09 02:34:58'),
(117, 81, 1, '2021-07-09 02:48:25'),
(118, 82, 1, '2021-07-09 02:48:33'),
(119, 83, 1, '2021-07-09 02:53:31'),
(120, 84, 1, '2021-07-12 09:03:05');

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
(338, 336, 1, '2021-07-07 23:38:14'),
(339, 337, 1, '2021-07-07 23:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `type` varchar(80) NOT NULL,
  `is_revoked` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_nama`, `user_password`, `user_email`, `user_phone`, `user_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin Pusat', '$2y$10$gp.46.UzygRVbGZTyzDZ6eZrMQ1q4jBhQtQSsWafE7vO3e50CfOqu', 'administrator@gmail.com', '08123123', 'Aktif', '2020-06-18 09:39:08', '2020-06-18 09:39:08'),
(336, 'sdafsdf', '$2y$10$PV2NsX9xL8bnbWBEA5rvnOb4SLO6HLwH8038BGHBFLZJchISA/oTi', '123', '1123', 'Aktif', '2021-07-07 23:38:14', '0000-00-00 00:00:00'),
(337, '123456', '$2y$10$mTU6yyDkqF4onkdbHFgtm.Cc/6700J.F0U1ki8.QwbxQOPXRrbfjC', 'iseplutpi@gmail.com', '1111', 'Aktif', '2021-07-07 23:38:57', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_about_ideto`
--
ALTER TABLE `konten_about_ideto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_about_kebijakan`
--
ALTER TABLE `konten_about_kebijakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_about_lain_lain`
--
ALTER TABLE `konten_about_lain_lain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_about_penata_laksana`
--
ALTER TABLE `konten_about_penata_laksana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_about_penyerahan`
--
ALTER TABLE `konten_about_penyerahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_arsip`
--
ALTER TABLE `konten_arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_artikel`
--
ALTER TABLE `konten_artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_home`
--
ALTER TABLE `konten_home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_informasi`
--
ALTER TABLE `konten_informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_pencarian`
--
ALTER TABLE `konten_pencarian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_utama`
--
ALTER TABLE `konten_utama`
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
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tokens_token_unique` (`token`),
  ADD KEY `tokens_user_id_foreign` (`user_id`),
  ADD KEY `tokens_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten_about_ideto`
--
ALTER TABLE `konten_about_ideto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten_about_kebijakan`
--
ALTER TABLE `konten_about_kebijakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `konten_about_lain_lain`
--
ALTER TABLE `konten_about_lain_lain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten_about_penata_laksana`
--
ALTER TABLE `konten_about_penata_laksana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `konten_about_penyerahan`
--
ALTER TABLE `konten_about_penyerahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten_arsip`
--
ALTER TABLE `konten_arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten_artikel`
--
ALTER TABLE `konten_artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten_home`
--
ALTER TABLE `konten_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `konten_informasi`
--
ALTER TABLE `konten_informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten_pencarian`
--
ALTER TABLE `konten_pencarian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konten_utama`
--
ALTER TABLE `konten_utama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `lev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  MODIFY `rola_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
