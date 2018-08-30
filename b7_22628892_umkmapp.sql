-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql302.byethost.com
-- Generation Time: Aug 29, 2018 at 10:52 PM
-- Server version: 5.6.35-81.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b7_22628892_umkmapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `date` date NOT NULL,
  `file_name` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `date`, `file_name`, `company_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Jabar Book Fair 2018', '2018-08-01', '33691000_1919978028053703_2678807845960417280_n-1.jpg', 2, '7 Pesona Jawa Barat Di Jabar Book Fair 2018', '2018-08-29 12:52:01', '0000-00-00 00:00:00'),
(2, 'Pameran "Cicipi maskan Khas Nusantara"', '2018-08-14', 'Stand_UKM_Sambal_Dede_Satoe.jpg', 6, 'Stand UKM Sambal Dede Satoe\r\nLokasi Kegiatan di Makassar', '2018-08-29 13:30:05', '0000-00-00 00:00:00'),
(3, 'Kuliner Khas Sulawesi', '2018-08-14', 'ukm-makananok.jpg', 6, 'Pameran Kuliner Khas Sulawesi\r\nLokasi-Makassar Sulawesi Selatan', '2018-08-29 13:32:58', '0000-00-00 00:00:00'),
(4, 'Pesta Buku ', '2018-08-08', 'pameran-buku1.jpg', 2, 'Yuk Biasakan Membaca\r\nLandmark-Braga, Bandung\r\n', '2018-08-29 13:35:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('0','1','2','3') DEFAULT NULL COMMENT '0 = Unsubmitted, 1 = Submitted Order, 2 = Submitted Transfer Proof, 3 = Confirmed by Admin',
  `transaction_code` text,
  `file_name` text,
  `name` text,
  `address` text,
  `email` text,
  `phone` varchar(150) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `status`, `transaction_code`, `file_name`, `name`, `address`, `email`, `phone`, `description`, `created_at`, `updated_at`) VALUES
(1, '3', '3JG5YUQRWL', 'e-cash-palsu.jpg', 'kiki', 'cjr', 'arezkyameliap@gmail.com', '085255557875', '1', '2018-08-29 12:36:36', '2018-08-29 12:36:36'),
(2, '2', 'VAV5EMQGRN', 'buktitransfer.jpeg', 'TREVOR', 'JAKARTA PUSAT NO 10', 'afiefsky@gmail.com', '089666848126', '2', '2018-08-30 02:38:07', '2018-08-30 02:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `carts_details`
--

CREATE TABLE IF NOT EXISTS `carts_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `description` text,
  `is_cancelled` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `carts_details`
--

INSERT INTO `carts_details` (`id`, `cart_id`, `product_id`, `qty`, `description`, `is_cancelled`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Cart = 1, Product = 1', '0', '2018-08-29 12:36:36', '0000-00-00 00:00:00'),
(2, 2, 3, 1, 'Cart = 2, Product = 3', '0', '2018-08-30 02:38:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image_url` text NOT NULL,
  `location` text NOT NULL,
  `location_full` text,
  `is_confirmed` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` enum('0','1') DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `image_url`, `location`, `location_full`, `is_confirmed`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Karya Agung', 'Capture.JPG', 'Makassar', 'Jl.Lapawawoi', '1', '1', '2018-08-28 15:45:02', '2018-08-28 15:45:02', '2018-08-29 01:45:37'),
(2, 'Karya Agung', 'Capture1.JPG', 'Watampone', 'Jl.Lapawawoi Kr.Sigeri', '1', '0', '2018-08-29 02:09:31', '2018-08-29 02:09:31', '2018-08-29 02:39:17'),
(3, 'Hellish Queen', 'batik.jpg', 'Jakarta Kota', 'Jakarta Kota Pondok Kelapa No 10', '0', '0', '2018-08-29 02:31:38', '2018-08-29 02:31:38', NULL),
(4, 'Bristle Back', 'batik1.jpg', 'Jakarta Pusat', 'Jakarta Pusat Menteng No. 9', '1', '1', '2018-08-29 12:25:38', '2018-08-29 12:25:38', '2018-08-29 12:55:18'),
(5, 'Nur Atya Shop', 'backgroun_baju.JPG', 'Bandung', 'Jl.Dipati Ukur', '1', '0', '2018-08-29 12:57:21', '2018-08-29 12:57:21', '2018-08-29 13:03:12'),
(6, 'Karya Agung Kuliner', 'cooltext296387389850523.png', 'Makassar', 'Jl.Perintis Kemerdekaan', '1', '0', '2018-08-29 12:58:23', '2018-08-29 12:58:23', '2018-08-29 13:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `file_name` text,
  `qty` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `price` bigint(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `file_name`, `qty`, `company_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Produk Halflife', 'blackcoffee.png', 11, 4, 10200000, '2018-08-29 12:34:14', '2018-08-29 12:34:14'),
(3, 'Novel "Surat Kecil Untuk Tuhan"', 'surat_kecil_untuk_tuhan1.jpg', 11, 2, 50000, '2018-08-29 12:45:50', '2018-08-29 12:45:50'),
(4, 'Novel "Laskar Pelangi"', 'Laskar-Pelangi.jpg', 50, 2, 50000, '2018-08-29 12:48:39', '2018-08-29 12:48:39'),
(5, 'Novel "Bulan Terbelah di Langit Amerika"', 'download.jpg', 22, 2, 50000, '2018-08-29 12:53:33', '2018-08-29 12:53:33'),
(6, 'Novel "Jodoh Terbaik"', 'IMG_20170518_163417.jpg', 22, 2, 50000, '2018-08-29 12:54:16', '2018-08-29 12:54:16'),
(7, 'Baby Boy -All size', 'download1.jpg', 30, 5, 70000, '2018-08-29 13:05:54', '2018-08-29 13:05:54'),
(8, 'Monki Black-All size', 'EL-OSO-BEBE-Niemowl-t-Ch-opc-w-Gentleman-Formalne-Garnitury-Little-Kids-Boy-T-shirt.jpg', 33, 5, 150000, '2018-08-29 13:07:26', '2018-08-29 13:07:26'),
(9, 'Korea Black-All size', '5229857_cba50cf7-6a50-4192-9da2-917e03d401e1.jpg', 44, 5, 170000, '2018-08-29 13:08:14', '2018-08-29 13:08:14'),
(10, 'Monki Koko', '10660242_8b1c6e3d-5614-4e27-812d-9c3d92484956_600_600.jpg', 44, 5, 150000, '2018-08-29 13:13:05', '2018-08-29 13:13:05'),
(11, 'Dress Mini Black-All size', '61DgT4-mf3L__UX385_.jpg', 12, 5, 200000, '2018-08-29 13:13:52', '2018-08-29 13:13:52'),
(12, 'Dress Mini Pink-All size', '1.jpg', 13, 5, 200000, '2018-08-29 13:15:51', '2018-08-29 13:15:51'),
(13, 'Dress Mini Black two-All size', 'black-satin-bib-necklin-chiffon-aline-flower-girl-dress-KD-255B2-1000x1500.jpg', 11, 5, 200000, '2018-08-29 13:17:13', '2018-08-29 13:17:13'),
(14, 'Sosis', 'makanan7.jpg', 50, 6, 50000, '2018-08-29 13:18:06', '2018-08-29 13:18:06'),
(15, 'Good Tela', 'makanan11.png', 100, 6, 20000, '2018-08-29 13:21:52', '2018-08-29 13:21:52'),
(16, 'Keripik Susu Khas Enrekang', 'keripik_susu_dangke_khas_enrekang.jpg', 150, 6, 40000, '2018-08-29 13:23:03', '2018-08-29 13:23:03'),
(17, 'Sambal Ikan Roa', 'sambal_ikan_roa.jpg', 150, 6, 70000, '2018-08-29 13:23:43', '2018-08-29 13:23:43'),
(18, 'Roti Mantau Pare', 'Roti_Mantau_Pare.jpg', 200, 6, 35000, '2018-08-29 13:24:52', '2018-08-29 13:24:52'),
(19, 'Keripik Singkong Daeng Balado', 'keripik_singkong_daeng_balado.jpg', 80, 6, 40000, '2018-08-29 13:25:40', '2018-08-29 13:25:40'),
(20, 'Jambu Mete', 'mete_kendari.jpg', 70, 6, 90000, '2018-08-29 13:26:41', '2018-08-29 13:26:41'),
(21, 'Pisang Peppe', 'pisang_peppe.jpg', 100, 6, 80000, '2018-08-29 13:27:51', '2018-08-29 13:27:51'),
(22, 'Novel"Harry Potter"', 'harry_potter.jpg', 30, 2, 46000, '2018-08-29 13:38:56', '2018-08-29 13:38:56'),
(23, 'Novel "Faith And The City"', 'faith_and_the_city.jpg', 80, 2, 45000, '2018-08-29 13:41:14', '2018-08-29 13:41:14'),
(24, 'Novel" Semesta Mendukung"', 'semesta_mendukung.jpg', 45, 2, 45000, '2018-08-29 13:42:05', '2018-08-29 13:42:05'),
(25, 'Novel "Negeri 5 Menara"', 'negeri_5_menara.jpg', 70, 2, 45000, '2018-08-29 13:42:59', '2018-08-29 13:42:59'),
(26, 'Novel "Ayat-Ayat Cinta"', 'Ayatayatcinta.jpg', 70, 2, 45000, '2018-08-29 13:44:35', '2018-08-29 13:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'no spaces, use underscore instead',
  `display_name` varchar(100) NOT NULL,
  `hidden` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = false, 1 = true',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `hidden`, `created_at`, `updated_at`) VALUES
(1, 'super_administrator', 'Super Administrator', '1', '2018-05-20 13:20:37', '2018-05-20 13:20:37'),
(2, 'administrator', 'Administrator', '1', '2018-05-20 13:20:37', '2018-05-20 13:20:37'),
(3, 'customer', 'Customer', '0', '2018-05-20 13:21:12', '2018-05-20 13:21:12'),
(4, 'owner', 'Owner', '0', '2018-08-10 14:10:00', '2018-08-10 14:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bank_account_number` text,
  `bank_name` text,
  `bank_account_owner` text COMMENT 'Atas nama',
  `is_owner` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`, `bank_account_number`, `bank_name`, `bank_account_owner`, `is_owner`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', NULL, NULL, NULL, NULL, '1', '2018-05-20 13:28:34', '2018-05-20 13:28:34'),
(2, 'silviasky@gmail.com', '3e47b75000b0924b6c9ba5759a7cf15d', '087812334522', '20011000322', 'BRI', 'Silvia Skywrath', '1', '2018-08-02 21:32:14', '2018-08-02 21:32:14'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, '1', '2018-08-09 13:26:58', '2018-08-09 13:26:58'),
(4, 'arezkyap@gmail.com', '7139bbd67895b3e9dc4577706d43720c', '085255557875', '6103010102211761', 'BRI', 'A.Rezky Amelia Putri', '0', '2018-08-29 02:03:44', '2018-08-29 02:03:44'),
(5, 'druiyansyah@gmail.com', '3e47b75000b0924b6c9ba5759a7cf15d', '089666848126', NULL, NULL, 'Druiyansyah', '0', '2018-08-29 02:16:46', '2018-08-29 02:16:46'),
(6, 'wimar@gmail.com', '3e47b75000b0924b6c9ba5759a7cf15d', '0897771672', '081982387498', 'BNI', 'WIMAR', '0', '2018-08-29 02:22:11', '2018-08-29 02:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `users_companies`
--

CREATE TABLE IF NOT EXISTS `users_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users_companies`
--

INSERT INTO `users_companies` (`id`, `user_id`, `company_id`) VALUES
(1, 2, 1),
(2, 4, 2),
(3, 6, 3),
(4, 2, 4),
(5, 4, 5),
(6, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE IF NOT EXISTS `users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
