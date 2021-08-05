-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 05, 2021 at 07:23 AM
-- Server version: 10.5.10-MariaDB-0ubuntu0.21.04.1
-- PHP Version: 7.4.16

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
  `judul` varchar(255) NOT NULL,
  `pendahuluan` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tujuan` text DEFAULT NULL,
  `link_sumber` text DEFAULT NULL,
  `jumlah_aktifitas` int(11) DEFAULT NULL,
  `status_kelompok` int(2) NOT NULL DEFAULT 0,
  `jumlah_max_siswa_per_kelompok` int(11) NOT NULL,
  `jumlah_kelompok` int(11) NOT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 Draft | 1 Simpan |',
  `gambar` text NOT NULL,
  `suara` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_project`
--

INSERT INTO `daftar_project` (`id`, `id_sekolah`, `id_kelas`, `nip_guru`, `judul`, `pendahuluan`, `deskripsi`, `tujuan`, `link_sumber`, `jumlah_aktifitas`, `status_kelompok`, `jumlah_max_siswa_per_kelompok`, `jumlah_kelompok`, `status`, `gambar`, `suara`, `created_at`, `updated_at`) VALUES
(30, 3, 17, 'guru5', 'Project Guru Admin Testing', 'Testing', '<p><br></p>', '<p><br></p>', '<p><br></p>', 3, 99, 5, 2, 1, '', '', '2021-07-21 22:54:00', '2021-08-04 22:32:56'),
(34, 1, 4, '987321', 'Pembuatan  Origami', '<p><br></p>', '<p><br></p>', '<p><br></p>', '<p><br></p>', 3, 0, 0, 0, 1, '', '', '2021-07-24 17:53:42', NULL),
(35, 2, 7, '12345678', '123', '<p><img src=\"/files/project/data/35/image/09047477-ef52-4dc4-a5dd-a4995c363e78.jpg\" alt=\"09047477-ef52-4dc4-a5dd-a4995c363e78.jpg\" data-filename=\"09047477-ef52-4dc4-a5dd-a4995c363e78.jpg\" class=\"img-fluid\" style=\"width: 50%;\"><br></p>', '<p><img src=\"/files/project/data/35/image/myIMG.png\" alt=\"myIMG.png\" data-filename=\"myIMG.png\" class=\"img-fluid\"><br></p>', '<p><br></p>', '<p><br></p>', 3, 0, 0, 0, 1, '09047477-ef52-4dc4-a5dd-a4995c363e78.jpg|myIMG.png', '', '2021-08-01 12:27:27', NULL),
(36, 1, 1, 'guru', 'Testing Buat Project Guru', '<p><img src=\"/files/project/data/36/image/AlbumArt_00000000-0000-0000-0000-000000000000_Small.jpg\" alt=\"AlbumArt_00000000-0000-0000-0000-000000000000_Small.jpg\" data-filename=\"AlbumArt_00000000-0000-0000-0000-000000000000_Small.jpg\" class=\"img-fluid\"><br></p>', '<p><br></p>', '<p><br></p>', '<p><br></p>', 3, 0, 0, 0, 1, 'AlbumArt_00000000-0000-0000-0000-000000000000_Small.jpg', '', '2021-07-24 18:45:50', '2021-07-31 11:59:37'),
(37, NULL, NULL, 'guru', '', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '', '', '2021-07-24 18:45:53', NULL),
(38, 1, 1, 'guru2', 'Cara menanam padi', '<p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \" source=\"\" sans=\"\" pro\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14.6667px;=\"\" text-align:=\"\" justify;\"=\"\"><img src=\"/files/project/data/38/image/kecil_1516318585Tanam_Padi.jpg\" alt=\"kecil_1516318585Tanam_Padi.jpg\" data-filename=\"kecil_1516318585Tanam_Padi.jpg\" class=\"img-fluid note-float-center\"><strong style=\"margin: 0px; padding: 0px;\"><br></strong></p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \" source=\"\" sans=\"\" pro\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14.6667px;=\"\" text-align:=\"\" justify;\"=\"\"><strong style=\"margin: 0px; padding: 0px;\"><a href=\"http://carakumenanam.com/\" style=\"margin: 0px; padding: 0px; color: rgb(24, 80, 124);\">Tanaman padi</a></strong>&nbsp;merupakan asal muasal dari beras. Beras merupakan kebutuhan utama masyarakat Indonesia untuk mencukupi kebutuhan karbohidrat. Begitu bergantungnya masyarakat akan kebutuhan beras atau nasi, menyebabkan beras atau nasi menjadi kebutuhan utama dan wajib untuk dipenuhi. Kecukupan dan keberhasilan budidaya tanaman padi menjadi penentu untuk mencukupi kebutuhan.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \" source=\"\" sans=\"\" pro\",=\"\" \"helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14.6667px;=\"\" text-align:=\"\" justify;\"=\"\">Tanpa tanaman padi maka manusia tidak dapat mengkonsumsi nasi lagi. Sehingga, budidaya tanaman padi harus terus dikembangkan oleh petani padi Indonesia. Inilah Cara menanam padi yang baik dan menguntungkan, Selain nilai kebutuhannya, tanaman padi juga memiliki nilai ekonomi yang tinggi. Seperti sudah diketahui oleh masyarakat, nilai jual beras sangatlah tinggi dan pasti laku tidak mungkin tidak laku. Oleh karena itu, diharapkan semakin bertambah para petani yang mengembangkan budidaya tanaman padi ini.</p>', '<p>Upaya untuk mewujudkan kedaulatan pangan\nmerupakan komitmen pemerintah yang tiada henti\ndilakukan melalui peningkatan produksi padi. Strategi\npeningkatan produksi nasional saat ini dan ke depan\nditempuh melalui peningkatan produktivitas\n(intensifikasi) dan perluasan areal tanam, baik melalui\npeningkatan Indek Pertanaman (IP) maupun perluasan\nlahan baku sawah.</p><p><span style=\"font-size: 1rem;\">Upaya tersebut optimis dapat\ndirealisasikan karena tersedianya berbagai inovasi dan\nteknologi hasil penelitian, terutama yang dihasilkan oleh\nBadan Penelitian dan Pengembangan Pertanian\n(Balitbangtan), namun teknologi tersebut baru sebagian\nyang diterapkan oleh petani.\nSaat ini produktivitas padi nasional sudah mencapai\nangka 5,28 ton/ha. Kementerian Pertanian pada tahun\n2016 mentargetkan produksi padi nasional sebesar\n76,226 juta ton. Aspek yang menjadi perhatian dalam\npeningkatan produksi padi tersebut adalah peningkatan\nefisiensi dan pelestarian lingkungan karena berkaitan\ndengan daya saing produksi.\nBelajar dari pengalaman pengembangan inovasi PTT\npadi sawah, maka peningkatan produksi padi ke depan\ndiupayakan melalui pengembangan Teknologi Jajar\nLegowo Super yang diimplementasikan secara terpadu.</span><br></p><p>Petunjuk teknis Teknologi Jajar Legowo Super ini\ndisusun sebagai acuan bagi para pihak yang akan\nmenerapkan teknologi tersebut. Diharapkan petunjuk\nteknis ini dapat bermanfaat dan kepada semua pihak\nyang telah menyumbangkan pemikiran dalam\npenyusunan petunjuk teknis ini disampaikan\npenghargaan dan terima kasih.</p><p><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/GBl1sxzAR7E\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br></p>', '<p><span style=\"font-size: 1rem;\">Upaya tersebut optimis dapat direalisasikan karena tersedianya berbagai inovasi dan teknologi hasil penelitian, terutama yang dihasilkan oleh Badan Penelitian dan Pengembangan Pertanian (Balitbangtan), namun teknologi tersebut baru sebagian yang diterapkan oleh petani. Saat ini produktivitas padi nasional sudah mencapai angka 5,28 ton/ha. Kementerian Pertanian pada tahun 2016 mentargetkan produksi padi nasional sebesar 76,226 juta ton. Aspek yang menjadi perhatian dalam peningkatan produksi padi tersebut adalah peningkatan efisiensi dan pelestarian lingkungan karena berkaitan dengan daya saing produksi. Belajar dari pengalaman pengembangan inovasi PTT padi sawah, maka peningkatan produksi padi ke depan diupayakan melalui pengembangan Teknologi Jajar Legowo Super yang diimplementasikan secara terpadu.</span><br></p><p>Petunjuk teknis Teknologi Jajar Legowo Super ini disusun sebagai acuan bagi para pihak yang akan menerapkan teknologi tersebut. Diharapkan petunjuk teknis ini dapat bermanfaat dan kepada semua pihak yang telah menyumbangkan pemikiran dalam penyusunan petunjuk teknis ini disampaikan penghargaan dan terima kasih.</p>', '<ol><li><a href=\"https://bawuran-bantul.desa.id/first/artikel/143-Langkah-Langkah-Cara-Menanam-Padi\" target=\"_blank\">https://bawuran-bantul.desa.id/first/artikel/143-Langkah-Langkah-Cara-Menanam-Padi</a></li><li><a href=\"https://bawuran-bantul.desa.id/first/artikel/143-Langkah-Langkah-Cara-Menanam-Padi\" target=\"_blank\">https://bawuran-bantul.desa.id/first/artikel/143-Langkah-Langkah-Cara-Menanam-Padi</a><a href=\"https://bawuran-bantul.desa.id/first/artikel/143-Langkah-Langkah-Cara-Menanam-Padi\" target=\"_blank\"></a></li><li><a href=\"https://bawuran-bantul.desa.id/first/artikel/143-Langkah-Langkah-Cara-Menanam-Padi\" target=\"_blank\">https://bawuran-bantul.desa.id/first/artikel/143-Langkah-Langkah-Cara-Menanam-Padi</a><br></li></ol>', 7, 0, 0, 0, 1, 'kecil_1516318585Tanam_Padi.jpg', '', '2021-08-03 13:56:03', '2021-08-03 14:14:20'),
(39, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '', '', '2021-08-03 13:56:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_project_detail`
--

CREATE TABLE `daftar_project_detail` (
  `id` int(11) NOT NULL,
  `id_daftar_project` int(11) DEFAULT NULL,
  `id_template` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `naskah` text DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `lembar_kerja` text DEFAULT NULL,
  `jenis_upload` varchar(100) DEFAULT NULL,
  `nilai` int(11) NOT NULL,
  `gambar` text DEFAULT NULL,
  `suara` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_project_detail`
--

INSERT INTO `daftar_project_detail` (`id`, `id_daftar_project`, `id_template`, `judul`, `naskah`, `detail`, `lembar_kerja`, `jenis_upload`, `nilai`, `gambar`, `suara`, `status`, `created_at`, `updated_at`) VALUES
(6, 30, 4, 'Tahapan 1', '<p><br></p>', '<p><br></p>', '<p><br></p>', '', 0, '', '', 1, '2021-07-31 19:58:03', NULL),
(7, 30, 4, 'Tahapan 2', '<p><br></p>', '<p><br></p>', '<p><br></p>', '', 0, '', '', 1, '2021-07-31 19:58:03', NULL),
(8, 30, 4, 'Tahapan 3', '<p><br></p>', '<p><br></p>', '<p><br></p>', '', 0, '', '', 1, '2021-07-31 19:58:03', NULL),
(9, 34, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, '2021-07-24 17:53:52', NULL),
(10, 34, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, '2021-07-24 17:53:52', NULL),
(11, 34, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, '2021-07-24 17:53:52', NULL),
(13, 36, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, '2021-08-01 12:28:52', NULL),
(14, 36, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, '2021-08-01 12:28:52', NULL),
(15, 36, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, '2021-08-01 12:28:52', NULL),
(16, 38, 1, 'Persiapan media tanam', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Media tanam untuk menanam padi haruslah disiapkan minimal dua minggu sebelum penanaman. Persiapan dilakukan dengan mengolah tanah sebagai media tanam. Tanah harus dipastikan bebas dari gulma dan rumput liar. Jangan sampai pertumbuhan tanaman padi terganggu karena harus berbagi nutrisi dan air dengan rumput-rumput liar. Jika sudah bebas dari tanaman liar, basahi tanah dengan air lalu lakukan pembajakan. Pembajakan dilakukan untuk mempersiapkan tanah dalam keadaan lunak dan gembur serta cocok untuk penanaman. Di zaman modern ini pembajakan tidak lagi dilakukan dengan mencangkul tetapi dengan menggunakan sapi ataupun traktor. Setelah melalui pembajakan, kembali genangi media tanam dengan air. Air diberikan dalam jumlah banyak untuk menutupi seluruh lahan dengan ketinggian hingga 10 cm. Biarkan air pada media tanam terus menggenang. Air yang menggenang selama dua minggu akan menyebabkan media tanam menjadi berlumbur dan racun pun dapat hilang karena ternetralisir.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Media tanam untuk menanam padi haruslah disiapkan minimal dua minggu sebelum penanaman. Persiapan dilakukan dengan mengolah tanah sebagai media tanam. Tanah harus dipastikan bebas dari gulma dan rumput liar. Jangan sampai pertumbuhan tanaman padi terganggu karena harus berbagi nutrisi dan air dengan rumput-rumput liar. Jika sudah bebas dari tanaman liar, basahi tanah dengan air lalu lakukan pembajakan. Pembajakan dilakukan untuk mempersiapkan tanah dalam keadaan lunak dan gembur serta cocok untuk penanaman. Di zaman modern ini pembajakan tidak lagi dilakukan dengan mencangkul tetapi dengan menggunakan sapi ataupun traktor. Setelah melalui pembajakan, kembali genangi media tanam dengan air. Air diberikan dalam jumlah banyak untuk menutupi seluruh lahan dengan ketinggian hingga 10 cm. Biarkan air pada media tanam terus menggenang. Air yang menggenang selama dua minggu akan menyebabkan media tanam menjadi berlumbur dan racun pun dapat hilang karena ternetralisir.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Media tanam untuk menanam padi haruslah disiapkan minimal dua minggu sebelum penanaman. Persiapan dilakukan dengan mengolah tanah sebagai media tanam. Tanah harus dipastikan bebas dari gulma dan rumput liar. Jangan sampai pertumbuhan tanaman padi terganggu karena harus berbagi nutrisi dan air dengan rumput-rumput liar. Jika sudah bebas dari tanaman liar, basahi tanah dengan air lalu lakukan pembajakan. Pembajakan dilakukan untuk mempersiapkan tanah dalam keadaan lunak dan gembur serta cocok untuk penanaman. Di zaman modern ini pembajakan tidak lagi dilakukan dengan mencangkul tetapi dengan menggunakan sapi ataupun traktor. Setelah melalui pembajakan, kembali genangi media tanam dengan air. Air diberikan dalam jumlah banyak untuk menutupi seluruh lahan dengan ketinggian hingga 10 cm. Biarkan air pada media tanam terus menggenang. Air yang menggenang selama dua minggu akan menyebabkan media tanam menjadi berlumbur dan racun pun dapat hilang karena ternetralisir.</span><br></p>', 'Gambar', 20, '', '', 1, '2021-08-03 14:29:12', NULL),
(17, 38, 1, 'Pemilihan bibit', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Bibit pada tanaman padi harus melalui pengujian terlebih dahulu untuk menentukan kualitasnya. Pengujian dilakukan dengan merendam sekitar 100 butir benih padi dalam air. Setelah dua jam periksalah benih tersebut. Cara menanam benih padi yaitu dengan Pemeriksaan benih dilakukan dengan mengidentifikasi perubahan pada benih. Jika terdapat lebih dari 90 butir benih atau lebih dari 90% benih mengeluarkan kecambah, maka artinya benih tersebut berkualitas unggul dan bermutu tinggi. Tentu benih yang berkualitas unggul dan bermutu tinggi inilah yang layak untuk dibudidayakan. Sedangkan jika benih tidak menunjukkan tanda seperti yang disebutkan diatas, artinya benih tersebut tidak disarankan untuk dibudidayakan. Setelah menentukan benih yang akan dijadikan bibit, maka dapat dilakukan persemaian segera.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Bibit pada tanaman padi harus melalui pengujian terlebih dahulu untuk menentukan kualitasnya. Pengujian dilakukan dengan merendam sekitar 100 butir benih padi dalam air. Setelah dua jam periksalah benih tersebut. Cara menanam benih padi yaitu dengan Pemeriksaan benih dilakukan dengan mengidentifikasi perubahan pada benih. Jika terdapat lebih dari 90 butir benih atau lebih dari 90% benih mengeluarkan kecambah, maka artinya benih tersebut berkualitas unggul dan bermutu tinggi. Tentu benih yang berkualitas unggul dan bermutu tinggi inilah yang layak untuk dibudidayakan. Sedangkan jika benih tidak menunjukkan tanda seperti yang disebutkan diatas, artinya benih tersebut tidak disarankan untuk dibudidayakan. Setelah menentukan benih yang akan dijadikan bibit, maka dapat dilakukan persemaian segera.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Bibit pada tanaman padi harus melalui pengujian terlebih dahulu untuk menentukan kualitasnya. Pengujian dilakukan dengan merendam sekitar 100 butir benih padi dalam air. Setelah dua jam periksalah benih tersebut. Cara menanam benih padi yaitu dengan Pemeriksaan benih dilakukan dengan mengidentifikasi perubahan pada benih. Jika terdapat lebih dari 90 butir benih atau lebih dari 90% benih mengeluarkan kecambah, maka artinya benih tersebut berkualitas unggul dan bermutu tinggi. Tentu benih yang berkualitas unggul dan bermutu tinggi inilah yang layak untuk dibudidayakan. Sedangkan jika benih tidak menunjukkan tanda seperti yang disebutkan diatas, artinya benih tersebut tidak disarankan untuk dibudidayakan. Setelah menentukan benih yang akan dijadikan bibit, maka dapat dilakukan persemaian segera.</span><br></p>', 'Gambar', 20, '', '', 1, '2021-08-03 14:29:12', NULL),
(18, 38, 1, 'Persemaian', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Persemaian dilakukan setelah menentukan bibit yang unggul. Bibit unggul tersebut kemudian akan disemai di wadah persemaian. Wadah persemaian terlebih dahulu harus disiapkan. Kebutuhan wadah semai diberikan dalam perbandingan sebesar 1 : 20. Misalkan akan menggunakan lahan sawah sebesar 1 hektar maka wadah persemaiannya sekitar 500 m</span><sup style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">2</sup><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">. Lahan pada wadah persemaian haruslah juga berair dan berlumpur. Berikan pupuk urea dan pupuk TSP pada lahan persemaian dengan dosis masing-masing 10 gr per 1 m</span><sup style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">2</sup><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">. Jika lahan persemaian sudah siap, sebarkan benih yang telah berkecambah dengan merata.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Persemaian dilakukan setelah menentukan bibit yang unggul. Bibit unggul tersebut kemudian akan disemai di wadah persemaian. Wadah persemaian terlebih dahulu harus disiapkan. Kebutuhan wadah semai diberikan dalam perbandingan sebesar 1 : 20. Misalkan akan menggunakan lahan sawah sebesar 1 hektar maka wadah persemaiannya sekitar 500 m</span><sup style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">2</sup><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">. Lahan pada wadah persemaian haruslah juga berair dan berlumpur. Berikan pupuk urea dan pupuk TSP pada lahan persemaian dengan dosis masing-masing 10 gr per 1 m</span><sup style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">2</sup><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">. Jika lahan persemaian sudah siap, sebarkan benih yang telah berkecambah dengan merata.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Persemaian dilakukan setelah menentukan bibit yang unggul. Bibit unggul tersebut kemudian akan disemai di wadah persemaian. Wadah persemaian terlebih dahulu harus disiapkan. Kebutuhan wadah semai diberikan dalam perbandingan sebesar 1 : 20. Misalkan akan menggunakan lahan sawah sebesar 1 hektar maka wadah persemaiannya sekitar 500 m</span><sup style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">2</sup><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">. Lahan pada wadah persemaian haruslah juga berair dan berlumpur. Berikan pupuk urea dan pupuk TSP pada lahan persemaian dengan dosis masing-masing 10 gr per 1 m</span><sup style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">2</sup><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">. Jika lahan persemaian sudah siap, sebarkan benih yang telah berkecambah dengan merata.</span><br></p>', 'Gambar', 20, '', '', 1, '2021-08-03 14:29:12', NULL),
(19, 38, 1, 'Penanaman', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Proses penanaman dilakukan setelah benih pada proses persemaian telah tumbuh daun sempurna sebanyak tiga hingga empat helai. Jangka waktu dari persemaian ke bibit siap tanam umumnya sekitar 12 hingga 14 hari saja. Jika sudah siap tanam, pindahkan bibit dari lahan semai ke lahan tanam. Pemidahan dilakukan dengan hati-hati dan tidak merusak tanaman. Penanaman dilakukan pada lubang-lubang tanam yang telah disiapkan. Khusus untuk tanaman padi dalam satu lubang dapat ditanam dua bibit sekaligus. Penanaman dilakukan dengan memasukkan bagian akar membentuk huruf L agar akar dapat tumbuh dengan sempurna. Kedalaman bibit ditanam pun ditentukan berkisar pada rentang 1 cm hingga 15 cm. Masa penanaman padi lebih baik dilakukan dua kali dalam setahun berdasarkan masa penanamannya yang ideal.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Proses penanaman dilakukan setelah benih pada proses persemaian telah tumbuh daun sempurna sebanyak tiga hingga empat helai. Jangka waktu dari persemaian ke bibit siap tanam umumnya sekitar 12 hingga 14 hari saja. Jika sudah siap tanam, pindahkan bibit dari lahan semai ke lahan tanam. Pemidahan dilakukan dengan hati-hati dan tidak merusak tanaman. Penanaman dilakukan pada lubang-lubang tanam yang telah disiapkan. Khusus untuk tanaman padi dalam satu lubang dapat ditanam dua bibit sekaligus. Penanaman dilakukan dengan memasukkan bagian akar membentuk huruf L agar akar dapat tumbuh dengan sempurna. Kedalaman bibit ditanam pun ditentukan berkisar pada rentang 1 cm hingga 15 cm. Masa penanaman padi lebih baik dilakukan dua kali dalam setahun berdasarkan masa penanamannya yang ideal.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Proses penanaman dilakukan setelah benih pada proses persemaian telah tumbuh daun sempurna sebanyak tiga hingga empat helai. Jangka waktu dari persemaian ke bibit siap tanam umumnya sekitar 12 hingga 14 hari saja. Jika sudah siap tanam, pindahkan bibit dari lahan semai ke lahan tanam. Pemidahan dilakukan dengan hati-hati dan tidak merusak tanaman. Penanaman dilakukan pada lubang-lubang tanam yang telah disiapkan. Khusus untuk tanaman padi dalam satu lubang dapat ditanam dua bibit sekaligus. Penanaman dilakukan dengan memasukkan bagian akar membentuk huruf L agar akar dapat tumbuh dengan sempurna. Kedalaman bibit ditanam pun ditentukan berkisar pada rentang 1 cm hingga 15 cm. Masa penanaman padi lebih baik dilakukan dua kali dalam setahun berdasarkan masa penanamannya yang ideal.</span><br></p>', 'Gambar', 10, '', '', 1, '2021-08-03 14:29:12', NULL),
(20, 38, 1, 'Perawatan lahan', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Perawatan dilakukan dengan tiga hal yaitu penyiangan, pengairan, dan pemupukan. Penyiangan dilakukan dengan menjaga kebersihan lahan dari tanaman pengganggu. Penyiangan harus dilakukan rutin setiap periode waktu tertentu. Bisa dilakukan dua minggu sekali atau tiga minggu sekali. Pengairan diberikan sesuai kebutuhan. Seperti pada tanaman lainnya, pastikan tidak ada kekurangan atau kelebihan air. Selanjutnya untuk pemupukan, dilakukan pertama kali setelah tanaman padi berusia satu minggu. Jenis pupuk yang diberikan adalah pupuk urea dengan dosis 100 kg per hektar dan pupuk TPS dengan dosis 50 kg per hektar. Pemupukan selanjutnya dilakukan setelah 25 hari hingga 30 hari setelah penanaman. Diberikan kembali pupuk urea dengan dosis 50 kg per hektar dan pupuk Phonska dengan dosis 100 kg per hektar.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Perawatan dilakukan dengan tiga hal yaitu penyiangan, pengairan, dan pemupukan. Penyiangan dilakukan dengan menjaga kebersihan lahan dari tanaman pengganggu. Penyiangan harus dilakukan rutin setiap periode waktu tertentu. Bisa dilakukan dua minggu sekali atau tiga minggu sekali. Pengairan diberikan sesuai kebutuhan. Seperti pada tanaman lainnya, pastikan tidak ada kekurangan atau kelebihan air. Selanjutnya untuk pemupukan, dilakukan pertama kali setelah tanaman padi berusia satu minggu. Jenis pupuk yang diberikan adalah pupuk urea dengan dosis 100 kg per hektar dan pupuk TPS dengan dosis 50 kg per hektar. Pemupukan selanjutnya dilakukan setelah 25 hari hingga 30 hari setelah penanaman. Diberikan kembali pupuk urea dengan dosis 50 kg per hektar dan pupuk Phonska dengan dosis 100 kg per hektar.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Perawatan dilakukan dengan tiga hal yaitu penyiangan, pengairan, dan pemupukan. Penyiangan dilakukan dengan menjaga kebersihan lahan dari tanaman pengganggu. Penyiangan harus dilakukan rutin setiap periode waktu tertentu. Bisa dilakukan dua minggu sekali atau tiga minggu sekali. Pengairan diberikan sesuai kebutuhan. Seperti pada tanaman lainnya, pastikan tidak ada kekurangan atau kelebihan air. Selanjutnya untuk pemupukan, dilakukan pertama kali setelah tanaman padi berusia satu minggu. Jenis pupuk yang diberikan adalah pupuk urea dengan dosis 100 kg per hektar dan pupuk TPS dengan dosis 50 kg per hektar. Pemupukan selanjutnya dilakukan setelah 25 hari hingga 30 hari setelah penanaman. Diberikan kembali pupuk urea dengan dosis 50 kg per hektar dan pupuk Phonska dengan dosis 100 kg per hektar.</span><br></p>', 'Gambar', 10, '', '', 1, '2021-08-03 14:29:12', NULL),
(21, 38, 1, 'Pencegahan hama dan penyakit', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Hama dan penyakit dapat dicegah dengan memberikan pestisida.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Hama dan penyakit dapat dicegah dengan memberikan pestisida.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Hama dan penyakit dapat dicegah dengan memberikan pestisida.</span><br></p>', 'Gambar', 5, '', '', 1, '2021-08-03 14:29:12', NULL),
(22, 38, 1, 'Pemanenan', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Panen dilakukan dengan tanda-tanda padi yang sudah menguning dan merunduk. Gunakan sabit gerigi untuk memanen dan letakkan hasil panen pada tikar dengan merontokkan beras dari dalam bulir-bulir padi yang ada.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Panen dilakukan dengan tanda-tanda padi yang sudah menguning dan merunduk. Gunakan sabit gerigi untuk memanen dan letakkan hasil panen pada tikar dengan merontokkan beras dari dalam bulir-bulir padi yang ada.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14.6667px; text-align: justify;\">Panen dilakukan dengan tanda-tanda padi yang sudah menguning dan merunduk. Gunakan sabit gerigi untuk memanen dan letakkan hasil panen pada tikar dengan merontokkan beras dari dalam bulir-bulir padi yang ada.</span><br></p>', 'Gambar', 5, '', '', 1, '2021-08-03 14:29:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(50) NOT NULL,
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
('12345678', 29, 2, 'Eska Yulinda Rahayu', 'Perempuan', '2000-10-20', 'Cianjur', '02136549870', 2, '2021-07-23 13:33:16', NULL),
('987321', 25, 1, 'Ani Ayu Pratiwi', 'Perempuan', '2021-07-17', 'Cirebon', '0254', 1, '2021-07-17 15:42:41', '2021-08-01 17:28:16'),
('guru', 12, 1, 'Isep Lutpi Nur 1', 'Laki-Laki', '2021-07-15', 'Cianjur', '085798132505', 1, '2021-07-16 13:43:44', '2021-07-24 18:51:59'),
('guru1', 17, 3, 'Isep Lutpi Nur', 'Laki-Laki', '2021-07-21', 'Cianjur', '085798132505', 1, '2021-07-16 23:09:14', NULL),
('guru2', 18, 1, 'M ilham solehudin', 'Laki-Laki', '2021-07-28', '-', '085798132505', 1, '2021-07-16 23:13:04', '2021-07-24 18:52:07'),
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
(3, 'guru1', 18, 1, '2021-07-16 23:09:14', NULL),
(5, 'guru3', 18, 2, '2021-07-16 23:16:58', '2021-07-18 19:42:00'),
(6, '987321', 4, 1, '2021-07-17 15:42:41', '2021-08-01 17:28:16'),
(7, 'guru5', 17, 2, '2021-07-18 23:49:30', NULL),
(8, '12345678', 7, 2, '2021-07-23 13:33:16', NULL),
(9, 'guru', 1, 1, '2021-07-24 18:51:59', '2021-07-24 18:51:59'),
(10, 'guru2', 1, 1, '2021-07-24 18:52:07', '2021-07-24 18:52:07');

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
(1, 1, 'I', 1, '2021-07-24 16:17:37', NULL),
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
(25, 3, 'VII', 1, '2021-07-18 20:35:21', NULL),
(26, 5, 'I', 1, '2021-07-23 08:12:02', NULL),
(27, 5, 'II', 1, '2021-07-23 08:12:02', NULL),
(28, 5, 'III', 1, '2021-07-23 08:12:02', NULL),
(29, 5, 'IV', 1, '2021-07-23 08:12:02', NULL),
(30, 5, 'V', 1, '2021-07-23 08:12:02', NULL),
(31, 5, 'VI', 1, '2021-07-23 08:12:02', NULL),
(32, 6, 'I', 1, '2021-07-23 08:12:02', '2021-08-01 17:32:07'),
(33, 6, 'II', 1, '2021-07-23 08:12:02', NULL),
(34, 6, 'III', 1, '2021-07-23 08:12:02', NULL),
(35, 6, 'IV', 1, '2021-07-23 08:12:02', NULL),
(36, 6, 'V', 1, '2021-07-23 08:12:02', NULL),
(37, 6, 'VI', 1, '2021-07-23 08:12:02', NULL),
(38, 7, 'I', 1, '2021-07-23 08:12:02', NULL),
(39, 7, 'II', 1, '2021-07-23 08:12:02', NULL),
(40, 7, 'III', 1, '2021-07-23 08:12:02', NULL),
(41, 7, 'IV', 1, '2021-07-23 08:12:02', NULL),
(42, 7, 'V', 1, '2021-07-23 08:12:02', NULL),
(43, 7, 'VI', 1, '2021-07-23 08:12:02', NULL),
(44, 8, 'I', 1, '2021-07-23 08:12:02', NULL),
(45, 8, 'II', 1, '2021-07-23 08:12:02', NULL),
(46, 8, 'III', 1, '2021-07-23 08:12:02', NULL),
(47, 8, 'IV', 1, '2021-07-23 08:12:02', NULL),
(48, 8, 'V', 1, '2021-07-23 08:12:02', NULL),
(49, 8, 'VI', 1, '2021-07-23 08:12:02', NULL),
(50, 9, 'I', 1, '2021-07-23 08:12:02', NULL),
(51, 9, 'II', 1, '2021-07-23 08:12:02', NULL),
(52, 9, 'III', 1, '2021-07-23 08:12:02', NULL),
(53, 9, 'IV', 1, '2021-07-23 08:12:02', NULL),
(54, 9, 'V', 1, '2021-07-23 08:12:02', NULL),
(55, 9, 'VI', 1, '2021-07-23 08:12:02', NULL),
(56, 10, 'I', 1, '2021-07-23 08:12:02', NULL),
(57, 10, 'II', 1, '2021-07-23 08:12:02', NULL),
(58, 10, 'III', 1, '2021-07-23 08:12:02', NULL),
(59, 10, 'IV', 1, '2021-07-23 08:12:02', NULL),
(60, 10, 'V', 1, '2021-07-23 08:12:02', NULL),
(61, 10, 'VI', 1, '2021-07-23 08:12:02', NULL),
(62, 11, 'I', 1, '2021-07-23 08:12:02', NULL),
(63, 11, 'II', 1, '2021-07-23 08:12:02', NULL),
(64, 11, 'III', 1, '2021-07-23 08:12:02', NULL),
(65, 11, 'IV', 1, '2021-07-23 08:12:02', NULL),
(66, 11, 'V', 1, '2021-07-23 08:12:02', NULL),
(67, 11, 'VI', 1, '2021-07-23 08:12:02', NULL),
(68, 12, 'I', 1, '2021-07-23 08:12:02', NULL),
(69, 12, 'II', 1, '2021-07-23 08:12:02', NULL),
(70, 12, 'III', 1, '2021-07-23 08:12:02', NULL),
(71, 12, 'IV', 1, '2021-07-23 08:12:02', NULL),
(72, 12, 'V', 1, '2021-07-23 08:12:02', NULL),
(73, 12, 'VI', 1, '2021-07-23 08:12:02', NULL),
(74, 13, 'I', 1, '2021-07-23 08:12:02', NULL),
(75, 13, 'II', 1, '2021-07-23 08:12:02', NULL),
(76, 13, 'III', 1, '2021-07-23 08:12:02', NULL),
(77, 13, 'IV', 1, '2021-07-23 08:12:02', NULL),
(78, 13, 'V', 1, '2021-07-23 08:12:02', NULL),
(79, 13, 'VI', 1, '2021-07-23 08:12:02', NULL),
(80, 14, 'I', 1, '2021-07-23 08:12:02', NULL),
(81, 14, 'II', 1, '2021-07-23 08:12:02', NULL),
(82, 14, 'III', 1, '2021-07-23 08:12:02', NULL),
(83, 14, 'IV', 1, '2021-07-23 08:12:02', NULL),
(84, 14, 'V', 1, '2021-07-23 08:12:02', NULL),
(85, 14, 'VI', 1, '2021-07-23 08:12:02', NULL),
(86, 15, 'I', 1, '2021-07-23 08:12:02', NULL),
(87, 15, 'II', 1, '2021-07-23 08:12:02', NULL),
(88, 15, 'III', 1, '2021-07-23 08:12:02', NULL),
(89, 15, 'IV', 1, '2021-07-23 08:12:02', NULL),
(90, 15, 'V', 1, '2021-07-23 08:12:02', NULL),
(91, 15, 'VI', 1, '2021-07-23 08:12:02', NULL),
(92, 16, 'I', 1, '2021-07-23 08:12:02', NULL),
(93, 16, 'II', 1, '2021-07-23 08:12:02', NULL),
(94, 16, 'III', 1, '2021-07-23 08:12:02', NULL),
(95, 16, 'IV', 1, '2021-07-23 08:12:02', NULL),
(96, 16, 'V', 1, '2021-07-23 08:12:02', NULL),
(97, 16, 'VI', 1, '2021-07-23 08:12:02', NULL),
(98, 17, 'I', 1, '2021-07-23 08:12:02', NULL),
(99, 17, 'II', 1, '2021-07-23 08:12:02', NULL),
(100, 17, 'III', 1, '2021-07-23 08:12:02', NULL),
(101, 17, 'IV', 1, '2021-07-23 08:12:02', NULL),
(102, 17, 'V', 1, '2021-07-23 08:12:02', NULL),
(103, 17, 'VI', 1, '2021-07-23 08:12:02', NULL),
(104, 18, 'I', 1, '2021-07-23 08:12:02', NULL),
(105, 18, 'II', 1, '2021-07-23 08:12:02', NULL),
(106, 18, 'III', 1, '2021-07-23 08:12:02', NULL),
(107, 18, 'IV', 1, '2021-07-23 08:12:02', NULL),
(108, 18, 'V', 1, '2021-07-23 08:12:02', NULL),
(109, 18, 'VI', 1, '2021-07-23 08:12:02', NULL),
(110, 19, 'I', 1, '2021-07-23 08:12:02', NULL),
(111, 19, 'II', 1, '2021-07-23 08:12:02', NULL),
(112, 19, 'III', 1, '2021-07-23 08:12:02', NULL),
(113, 19, 'IV', 1, '2021-07-23 08:12:02', NULL),
(114, 19, 'V', 1, '2021-07-23 08:12:02', NULL),
(115, 19, 'VI', 1, '2021-07-23 08:12:02', NULL),
(116, 20, 'I', 1, '2021-07-23 08:12:02', NULL),
(117, 20, 'II', 1, '2021-07-23 08:12:02', NULL),
(118, 20, 'III', 1, '2021-07-23 08:12:02', NULL),
(119, 20, 'IV', 1, '2021-07-23 08:12:02', NULL),
(120, 20, 'V', 1, '2021-07-23 08:12:02', NULL),
(121, 20, 'VI', 1, '2021-07-23 08:12:02', NULL),
(122, 21, 'I', 1, '2021-07-23 08:12:02', NULL),
(123, 21, 'II', 1, '2021-07-23 08:12:02', NULL),
(124, 21, 'III', 1, '2021-07-23 08:12:02', NULL),
(125, 21, 'IV', 1, '2021-07-23 08:12:02', NULL),
(126, 21, 'V', 1, '2021-07-23 08:12:02', NULL),
(127, 21, 'VI', 1, '2021-07-23 08:12:02', NULL),
(129, 6, 'IV', 1, '2021-08-01 17:32:14', NULL);

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
(41, 24, 'Template', '-', 3, 'far fa-circle', 'project/template', 'Aktif', '2021-07-19 14:04:08'),
(42, 0, 'Daftar Project', 'Daftar project siswa', 2, 'fas fa-clipboard-list', 'project/siswa', 'Aktif', '2021-07-23 08:46:52'),
(43, 0, 'Game', '-', 7, 'fas fa-gamepad', '3', 'Aktif', '2021-08-04 22:42:57'),
(44, 43, 'Memory Game', '-', 1, 'far fa-circle', 'game/memoryGame', 'Aktif', '2021-08-04 22:44:06');

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
(5, 'siswa', 'Nilai pengaturan untuk halaman registrasi siswa', 1, '2021-07-19 06:18:29', '2021-07-23 14:35:51'),
(6, 'guru', 'Nilai pengaturan untuk halaman registrasi guru', 1, '2021-07-19 06:18:29', '2021-07-20 19:30:08');

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
(60, 38, 3, '2021-07-16 10:24:47'),
(61, 39, 3, '2021-07-16 10:24:48'),
(62, 24, 4, '2021-07-16 13:45:47'),
(63, 38, 4, '2021-07-16 13:45:48'),
(64, 39, 4, '2021-07-16 13:45:49'),
(65, 33, 4, '2021-07-16 13:45:54'),
(66, 36, 4, '2021-07-16 13:45:58'),
(67, 40, 1, '2021-07-18 20:44:36'),
(68, 41, 1, '2021-07-19 14:04:13'),
(69, 41, 3, '2021-07-20 12:35:36'),
(70, 42, 5, '2021-07-23 08:47:05'),
(71, 43, 1, '2021-08-04 22:44:17'),
(72, 44, 1, '2021-08-04 22:44:19'),
(73, 43, 4, '2021-08-05 00:20:41'),
(74, 44, 4, '2021-08-05 00:20:42'),
(75, 43, 3, '2021-08-05 00:20:45'),
(76, 44, 3, '2021-08-05 00:20:47'),
(77, 43, 5, '2021-08-05 00:20:49'),
(78, 44, 5, '2021-08-05 00:20:50');

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
(22, 25, 3, '2021-07-17 15:42:41'),
(23, 26, 5, '2021-07-18 23:34:36'),
(24, 27, 4, '2021-07-18 23:49:30'),
(25, 28, 5, '2021-07-23 08:19:22'),
(26, 29, 4, '2021-07-23 13:33:16'),
(27, 30, 5, '2021-07-23 13:35:18'),
(28, 31, 5, '2021-07-24 16:56:06'),
(29, 32, 5, '2021-07-24 17:04:16'),
(30, 33, 5, '2021-08-01 16:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `npsn` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '0 Tidak aktif | 1 Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id`, `npsn`, `nama`, `alamat`, `no_telpon`, `status`, `created_at`, `updated_at`) VALUES
(1, '085798132505', 'SD PLEBENGAN', 'PLEBENGAN', '085798132505', 1, '2021-07-14 14:40:07', NULL),
(2, '628-5340x3918', 'SD 3 PANGGANG', 'PANGGANG', '628-5340x3918', 1, '2021-07-14 14:40:40', NULL),
(3, '123', 'SD BANTUL MANUNGGAL', 'BANTUL MANUNGGAL', '085798132505', 1, '2021-07-14 14:41:16', '2021-07-23 14:24:47'),
(4, '(983)628-5340x3918', 'SDN BANDUNG', 'BANDUNG', '(983)628-5340x3918', 1, '2021-07-14 14:41:31', '2021-07-23 07:56:50'),
(5, '60709750', 'MIS AL HASAN', 'JL. SUKARASA NO.104/143E Cicadas', '60709750', 1, '2021-07-23 07:57:32', NULL),
(6, '60709751', 'MIS NURUL AMAL', 'JL. CIMUNCANG DALAM BABAKAN BARU NO.09 RT.04 RW.07 Sukapada', '60709751', 1, '2021-07-23 07:57:59', NULL),
(7, '20279824', 'SD ITQAN ISLAMIC SCHOOL', ' Jalan Padasuka No. 160 Padasuka', '20279824', 1, '2021-07-23 07:58:47', NULL),
(8, ' 20219852', 'SD MUHAMMADIYAH 3', 'Jl. Phh Mustopa Padasuka', ' 20219852', 1, '2021-07-23 07:59:14', NULL),
(9, ' 20219814', 'SD PELITA', 'Jl. Citamiang No. 43 Sukamaju', ' 20219814', 1, '2021-07-23 07:59:48', NULL),
(10, '20253862', 'SD SANTO YUSUP I', 'Jl. Cikutra No 5 Cikutra', '20253862', 1, '2021-07-23 08:00:07', '2021-07-23 08:00:21'),
(11, '20219904', 'SD YAYASAN ATIKAN SUNDA', 'Jl. Phh Mustapa N0. 115 SUKAPADA', '20219904', 1, '2021-07-23 08:00:48', NULL),
(12, '20245153', 'SDN 022 CICADAS KOTA BANDUNG', 'Jl. Cikutra No. 58 Padasuka', '20245153', 1, '2021-07-23 08:01:16', NULL),
(13, '20245149', 'SDN 027 CICADAS KOTA BANDUNG', 'Jl. Cikutra No.15 Cikutra', '20245149', 1, '2021-07-23 08:02:16', NULL),
(14, ' 20245178', 'SDN 043 CIMUNCANG KOTA BANDUNG', 'Jl. Babakan Haji Tamim No.33 Padasuka', ' 20245178', 1, '2021-07-23 08:02:33', NULL),
(15, ' 20245157', 'SDN 044 CICADAS AWIGOMBONG KOTA BANDUNG', 'Jl. Asep Berlian No.33 Cicadas', ' 20245157', 1, '2021-07-23 08:02:50', NULL),
(16, '20245247', 'SDN 064 PADASUKA KOTA BANDUNG', 'Jl. Padasuka No.90 Pasirlayung', '20245247', 1, '2021-07-23 08:03:11', NULL),
(17, ' 20245119', 'SDN 114 BOJONGKONENG CIBEUNYING KOTA BANDUNG', ' Jl. Bojongkoneng No.38 Sukapada', ' 20245119', 1, '2021-07-23 08:03:39', NULL),
(18, '20245211', 'SDN 133 JALAN ANYAR KOTA BANDUNG', 'Jl. Padasuka No. 99/209 C Padasuka', '20245211', 1, '2021-07-23 08:04:07', NULL),
(19, ' 20245206', 'SDN 150 GATOT SUBROTO KOTA BANDUNG', 'Jl. Yudhawastu Pramuka IV Cicadas', ' 20245206', 1, '2021-07-23 08:04:23', NULL),
(20, '20245284', 'SDN 151 SUKASENANG KOTA BANDUNG', 'Jl. P.H.H. Mustofa No. 46 Cikutra', '20245284', 1, '2021-07-23 08:04:42', NULL),
(21, '20245262', 'SDN 234 SALUYU KOTA BANDUNG', 'Jl. Cimuncang Dalam No.52 Sukapada', '20245262', 1, '2021-07-23 08:05:02', NULL),
(22, '123456789', 'SDN Negeri Cijawura Girang V', 'Sekajati', '021345678', 1, '2021-07-23 13:48:10', '2021-07-23 13:49:36'),
(23, '99', 'Sekolah TEs Delete', 'Delete', '123', 1, '2021-07-23 15:03:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(20) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
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

INSERT INTO `siswa` (`nisn`, `id_user`, `id_kelas`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
('10203040', 15, 1, 'Ai Latipah', '2021-07-15', 'Perempuan', 'Cianjur', 1, '2021-07-16 14:52:34', '2021-08-03 13:15:23'),
('123', 14, 1, 'Asep septiadi', '2021-07-02', 'Perempuan', 'bekasi', 1, '2021-07-16 14:11:51', '2021-07-24 16:30:07'),
('1234567', 9, 2, 'M ilham solehudin', '2021-07-31', 'Laki-Laki', 'Bandung', 1, '2021-07-15 08:18:40', '2021-07-24 16:21:28'),
('123458', 4, 21, 'Isep Lutpi Nur', '2000-08-10', 'Laki-Laki', 'Cianjur', 1, '2021-07-15 01:15:46', NULL),
('12355', 32, 7, 'Ruslan Efendi', '2005-10-02', 'Laki-Laki', 'Cianjur', 2, '2021-07-24 17:04:16', NULL),
('123568793', 30, 19, 'Adi Saputra', '2000-12-22', 'Laki-Laki', 'Cianjur', 2, '2021-07-23 13:35:18', '2021-07-24 16:23:44'),
('185798', 13, 1, 'Biasa', '2021-07-29', 'Perempuan', '123', 1, '2021-07-16 13:47:41', '2021-07-24 16:30:15'),
('2113191079', 20, 18, 'Isep Lutpi Nur 5', '2021-07-24', 'Laki-Laki', 'Cianjur', 1, '2021-07-17 02:29:29', '2021-07-17 03:10:56'),
('333', 23, 13, 'M taufiq ali', '2021-07-31', 'Laki-Laki', 'CIMAHI', 2, '2021-07-17 15:20:08', '2021-07-18 19:10:13'),
('55555', 22, 13, 'Ahmad rizal imaduddin', '2021-07-17', 'Laki-Laki', 'Nusa tenggara timur', 2, '2021-07-17 15:15:46', '2021-07-18 19:10:05'),
('654321', 26, 25, 'Sandi solehudin', '2021-07-10', 'Laki-Laki', 'Cidaun', 1, '2021-07-18 23:34:36', '2021-07-24 16:57:50'),
('67890', 24, 1, 'Dara Atria Ferliandini', '2021-07-24', 'Perempuan', 'Bandung', 0, '2021-07-17 15:22:43', '2021-07-24 16:31:25'),
('7777', 31, 8, 'Mira Putri', '2021-07-07', 'Perempuan', 'Aceh', 1, '2021-07-24 16:56:06', NULL),
('987654', 21, 13, 'Adistia Ramadhani', '2000-08-10', 'Perempuan', 'Cicaheum', 1, '2021-07-17 14:38:27', '2021-07-17 15:12:35'),
('siswa', 11, 17, 'Adje abdul aziz', '2021-07-16', 'Laki-Laki', 'Cimahi', 1, '2021-07-16 10:53:23', '2021-07-23 08:17:21'),
('siswa1', 28, 17, 'Isep Lutpi Nur', '2000-08-10', 'Laki-Laki', 'Cianjur', 1, '2021-07-23 08:19:22', '2021-07-23 08:20:01'),
('siswa5', 33, 1, 'Nama Siswa', '2021-08-17', 'Laki-Laki', 'Bandung', 1, '2021-08-01 16:57:31', '2021-08-01 17:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_kelompok`
--

CREATE TABLE `siswa_kelompok` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa_kelompok`
--

INSERT INTO `siswa_kelompok` (`id`, `id_project`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(6, 30, 'Kelompok 1', 0, '2021-08-04 17:23:37', NULL),
(8, 30, 'Kelompok 2', 0, '2021-08-05 05:20:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa_kelompok_detail`
--

CREATE TABLE `siswa_kelompok_detail` (
  `id` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `nisn_siswa` varchar(20) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `Keterangan` varchar(300) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa_kelompok_detail`
--

INSERT INTO `siswa_kelompok_detail` (`id`, `id_kelompok`, `nisn_siswa`, `nama`, `Keterangan`, `status`, `created_at`, `updated_at`) VALUES
(8, 6, NULL, 'Mamah', 'Orang Tua Siswa', 1, '2021-08-05 04:41:46', '0000-00-00 00:00:00'),
(9, 8, '2113191079', 'Isep Lutpi Nur 5', 'Siswa Kelas VI', 1, '2021-08-05 05:20:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `judul` varchar(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` text NOT NULL,
  `suara` text NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 Draft | 1 Disimpan',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `id_sekolah`, `judul`, `keterangan`, `gambar`, `suara`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Template A', '<p>Kamu Siapa</p><p><br></p>', '', '', 1, '2021-07-20 02:11:57', '2021-07-24 15:53:21'),
(4, 3, 'Template A', '<p>Template A</p>', '', '', 1, '2021-07-20 12:54:35', NULL),
(9, 3, NULL, NULL, '', '', 0, '2021-07-20 13:08:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_email` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
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
(9, 'M ilham solehudin', '$2y$10$Jkos91pNm5XiIN8R6v6BPeLVZ8YJP1RLgPq6aRFF6FP0dUSbQNh26', '1234567', '0223123123', 1, '2021-07-15 08:18:40', '2021-07-24 16:21:28'),
(10, 'M. Ath thariq', '$2y$10$H77DmFTbNyc6A19oh8Zaley5CqZCWxf5OhLEIuUhakRGx2zVejGwq', 'guruadmin', '0857981325059', 1, '2021-07-16 03:14:17', '2021-07-16 15:14:35'),
(11, 'Adje abdul aziz', '$2y$10$RcZHX37TRR6PgMEl8LSTyuM72o5A6dog7AEQenRw7QDDAFhckzn.W', 'siswa', '0223123123', 1, '2021-07-16 10:53:23', '2021-07-23 08:17:21'),
(12, 'Isep Lutpi Nur 1', '$2y$10$kRb4EgmTHSa67kxkz43EyePqdeX.3PfZlQFnjdF0eRFt5OICLOrvK', 'guru', '085798132505', 1, '2021-07-16 13:43:44', '2021-07-24 18:51:59'),
(13, 'Biasa', '$2y$10$PyO23nqy6M1QBYPMDZTPvO9C4INmo2AjEX7Q6491u/o1Lw8vO8b2m', '185798', '0223123123', 1, '2021-07-16 13:47:41', '2021-07-24 16:30:15'),
(14, 'Asep septiadi', '$2y$10$rEWyupQecC2Va8prtp2SIenwXPbTe3wwMR7BBAuU9GKqr.nT7T3a.', '123', '0223123123', 1, '2021-07-16 14:11:51', '2021-07-24 16:30:07'),
(15, 'Ai Latipah', '$2y$10$kglBErPuwSQyJ.442ABS0OQAppJaWyQ4m2O9XB41zl1mD6AP.sMv.', '10203040', '0223123123', 1, '2021-07-16 14:52:34', '2021-08-03 13:15:23'),
(17, 'Isep Lutpi Nur', '$2y$10$/4KlzqGV/D8vOutEmcqzCOVGxMBNpRh/ih/nRDXAr5eb49hg2hUWS', 'guru1', '085798132505', 1, '2021-07-16 23:09:14', NULL),
(18, 'M ilham solehudin', '$2y$10$VrnBGhRA51uFKJEqDyWnIu92YnyEfIa.HrNEulDC91c6pNU1nae8q', 'guru2', '085798132505', 1, '2021-07-16 23:13:04', '2021-07-24 18:52:07'),
(19, 'M ilham solehudin 3', '$2y$10$CUUka6Tu27vrqrE27mj3V.toNIcshYK8O06Da3roa2I6k7bAVQOpK', 'guru3', '085798132505', 2, '2021-07-16 23:16:58', '2021-07-18 19:42:00'),
(20, 'Isep Lutpi Nur 5', '$2y$10$H.3BGy/7U3pOk8QToex1dei/HeXTX.AI85fPMJocNtC/71V3ODfPm', '2113191079', '085798132505', 1, '2021-07-17 02:29:29', '2021-07-17 03:10:56'),
(21, 'Adistia Ramadhani', '$2y$10$Rl4EK2nlSTELPFY7YUPYTei.uTT98h2grqX6AaQckkYIwOFzBKz5a', '987654', '0123', 1, '2021-07-17 14:38:27', '2021-07-17 15:12:35'),
(22, 'Ahmad rizal imaduddin', '$2y$10$iwPFB6iPtRTozNjcqOD92eR0VznzjhLDvXWsf7npKJqQDq7ITFtPu', '55555', '99990', 2, '2021-07-17 15:15:46', '2021-07-18 19:10:05'),
(23, 'M taufiq ali', '$2y$10$EFrFKbDOt5cEdvkq//xX3OmxY9Cc4y.8ySapIK0KBcR6A/xcMlDpa', '333', '085798132505', 2, '2021-07-17 15:20:08', '2021-07-18 19:10:13'),
(24, 'Dara Atria Ferliandini', '$2y$10$kxmONr5JAkAGtOHd3cvykeQOkzpQqHUFk6tx4ievvnZl5s/GL7/5W', '67890', '99990', 0, '2021-07-17 15:22:43', '2021-07-24 16:31:25'),
(25, 'Ani Ayu Pratiwi', '$2y$10$w7k.hHiGp/zGC0R2Qh9X5.f3U57AL782mZUHHPYiCUL4u6Kp98xAy', '987321', '0254', 1, '2021-07-17 15:42:41', '2021-08-01 17:28:16'),
(26, 'Sandi solehudin', '$2y$10$DKQfR6E5tFjDislu9txeyuyVq6A/PSAwcf5EqZ6YlT2FELWIOabTW', '654321', 'administrator@g', 1, '2021-07-18 23:34:36', '2021-07-24 16:57:50'),
(27, 'Abul aziz', '$2y$10$.oOK6v9ZFGzDIoaaKwTxMuzEmnk734KZPRjFFRzWQLaE7wK9JCXgq', 'guru5', '123', 2, '2021-07-18 23:49:30', NULL),
(28, 'Isep Lutpi Nur', '$2y$10$j4Eq086TFKXJ3i6Dr5/s9eLFaX.tMfmhMJj7R9J3xLOoSS.GyM1Om', 'siswa1', '085798132505', 1, '2021-07-23 08:19:22', '2021-07-23 08:20:01'),
(29, 'Eska Yulinda Rahayu', '$2y$10$7a.Q3N2KrjoV0HMCwFLETO0Xoo/OXzoAaZxMJmwPCAfNzcSsyYdkG', '12345678', '02136549870', 2, '2021-07-23 13:33:16', NULL),
(30, 'Adi Saputra', '$2y$10$1kjbxfGiienjS0R02JL8oOi9DX98o2uClcJu/3cNoj9NgdLJ2jx.i', '123568793', '0213698752', 2, '2021-07-23 13:35:18', '2021-07-24 16:23:44'),
(31, 'Mira Putri', '$2y$10$T4dc1KCb5lcRo1EZpa.IVORn3UpLk8q9EnS/w3InRjbP/DMtW./SO', '7777', '0223123123', 1, '2021-07-24 16:56:06', NULL),
(32, 'Ruslan Efendi', '$2y$10$LtGCHOhnkKz/bE5evD9E..y/D7HZJj8nxlLCLY4bk1jhM6rIAI2lS', '12355', '021365423', 2, '2021-07-24 17:04:16', NULL),
(33, 'Nama Siswa', '$2y$10$qZVnb51ZhLHVyUwh5NXwtO2LffeUoDeMxqs.76.3JurvCumIRLNQi', 'siswa5', '085798132505', 1, '2021-08-01 16:57:31', '2021-08-01 17:36:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_project`
--
ALTER TABLE `daftar_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip_guru` (`nip_guru`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indexes for table `daftar_project_detail`
--
ALTER TABLE `daftar_project_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_template` (`id_template`),
  ADD KEY `id_daftar_project` (`id_daftar_project`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sekolah` (`id_sekolah`);

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
-- Indexes for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  ADD PRIMARY KEY (`rola_id`),
  ADD KEY `rola_lev_id` (`rola_lev_id`),
  ADD KEY `rola_menu_id` (`rola_menu_id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `role_lev_id` (`role_lev_id`),
  ADD KEY `role_user_id` (`role_user_id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `siswa_kelompok`
--
ALTER TABLE `siswa_kelompok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project` (`id_project`);

--
-- Indexes for table `siswa_kelompok_detail`
--
ALTER TABLE `siswa_kelompok_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelompok` (`id_kelompok`),
  ADD KEY `nisn_siswa` (`nisn_siswa`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sekolah` (`id_sekolah`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `daftar_project_detail`
--
ALTER TABLE `daftar_project_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `lev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `pengaturan_registrasi`
--
ALTER TABLE `pengaturan_registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  MODIFY `rola_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `siswa_kelompok`
--
ALTER TABLE `siswa_kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `siswa_kelompok_detail`
--
ALTER TABLE `siswa_kelompok_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_project`
--
ALTER TABLE `daftar_project`
  ADD CONSTRAINT `daftar_project_ibfk_1` FOREIGN KEY (`nip_guru`) REFERENCES `guru` (`nip`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_project_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_project_ibfk_3` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `daftar_project_detail`
--
ALTER TABLE `daftar_project_detail`
  ADD CONSTRAINT `daftar_project_detail_ibfk_1` FOREIGN KEY (`id_template`) REFERENCES `templates` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_project_detail_ibfk_2` FOREIGN KEY (`id_daftar_project`) REFERENCES `daftar_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD CONSTRAINT `guru_kelas_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guru_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  ADD CONSTRAINT `role_aplikasi_ibfk_1` FOREIGN KEY (`rola_lev_id`) REFERENCES `level` (`lev_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_aplikasi_ibfk_2` FOREIGN KEY (`rola_menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_ibfk_1` FOREIGN KEY (`role_lev_id`) REFERENCES `level` (`lev_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_users_ibfk_2` FOREIGN KEY (`role_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `siswa_kelompok`
--
ALTER TABLE `siswa_kelompok`
  ADD CONSTRAINT `siswa_kelompok_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `daftar_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa_kelompok_detail`
--
ALTER TABLE `siswa_kelompok_detail`
  ADD CONSTRAINT `siswa_kelompok_detail_ibfk_1` FOREIGN KEY (`id_kelompok`) REFERENCES `siswa_kelompok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_kelompok_detail_ibfk_2` FOREIGN KEY (`nisn_siswa`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
