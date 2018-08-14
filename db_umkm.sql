-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 09:37 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_umkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` date NOT NULL,
  `file_name` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `date`, `file_name`, `company_id`, `description`, `created_at`, `updated_at`) VALUES
(3, '222', '2018-08-01', '1-plywood2.jpg', 4, '', '2018-08-12 12:21:56', '0000-00-00 00:00:00'),
(4, '3333', '2018-06-07', 'trade-1.jpg', 4, '', '2018-08-12 12:22:01', '0000-00-00 00:00:00'),
(5, 'hore', '2018-08-08', 'blue_color.png', 4, '', '2018-08-12 12:22:06', '0000-00-00 00:00:00'),
(6, 'hooglap', '2018-08-05', '1-plywood.jpg', 0, '* Mohon isikan keterangan singkat', '2018-08-12 13:07:14', '0000-00-00 00:00:00'),
(9, 'hooglap', '2018-08-05', '1-prove4.png', 3, 'abeok', '2018-08-12 02:57:19', '0000-00-00 00:00:00'),
(10, '222', '2018-08-01', '592e2639fdee94b3240a1127b3df95a8-2-open-wavy-wings-by-vexels3.png', 3, '* Mohon isikan keterangan singkat', '2018-08-12 03:00:36', '0000-00-00 00:00:00'),
(11, '222', '2018-08-01', 'ERROR.jpeg', 3, '* Mohon isikan keterangan singkat', '2018-08-12 03:00:59', '0000-00-00 00:00:00'),
(12, '222', '2018-08-01', '1-prove5.png', 3, '* Mohon isikan keterangan singkat', '2018-08-12 02:58:27', '0000-00-00 00:00:00'),
(14, 'hooglap', '2018-08-01', '1-palm1.jpg', 3, 'nothing', '2018-08-12 13:05:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image_url` text NOT NULL,
  `location` text NOT NULL,
  `is_confirmed` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `image_url`, `location`, `is_confirmed`, `created_at`, `updated_at`) VALUES
(1, 'Mikro Coy', 'market6.jpg', 'Bandung A', '1', '2018-07-29 13:52:07', '2018-07-29 13:52:07'),
(2, 'Gisele Alain', 'market6.jpg', 'Cirebon B', '0', '2018-08-02 21:33:29', '2018-08-02 21:33:29'),
(3, 'Demento', 'phone2.png', 'Jakarta Z', '1', '2018-08-02 21:38:03', '2018-08-02 21:38:03'),
(4, 'Perfecto', 'perfect.jpg', 'Medan T', '1', '2018-08-09 13:33:36', '2018-08-09 13:33:36'),
(5, 'Abstergo', 'whatsapp3.png', 'Q-Tre Sulawesi', '1', '2018-08-10 17:29:25', '2018-08-10 17:29:25'),
(6, 'Halola', '1-prove.png', 'Acc-lair Kalimantan', '1', '2018-08-10 17:30:21', '2018-08-10 17:30:21'),
(7, 'ABSTERGO', '1-prove.png', 'Habl-Bekasi', '1', '2018-08-12 11:50:38', '2018-08-12 11:50:38'),
(8, 'UMKM A', '1-palm1.jpg', '', '0', '2018-08-13 15:19:57', '2018-08-13 15:19:57'),
(9, 'UMKM B', '1-palm2.jpg', '', '0', '2018-08-13 15:20:40', '2018-08-13 15:20:40'),
(10, 'UMKM C', '1-palm3.jpg', '', '0', '2018-08-13 15:21:08', '2018-08-13 15:21:08'),
(11, 'UMKM D', '1-palm4.jpg', '', '0', '2018-08-13 15:21:19', '2018-08-13 15:21:19'),
(12, 'UMKM E', '1-palm5.jpg', '', '0', '2018-08-13 15:21:32', '2018-08-13 15:21:32'),
(13, 'UMKM F', '1-palm6.jpg', '', '0', '2018-08-13 15:21:44', '2018-08-13 15:21:44'),
(14, 'UMKM G', '1-palm7.jpg', '', '0', '2018-08-13 15:21:55', '2018-08-13 15:21:55'),
(15, 'UMKM H', '1-plywood.jpg', '', '0', '2018-08-13 15:23:42', '2018-08-13 15:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `file_name` text,
  `qty` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `price` bigint(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `file_name`, `qty`, `company_id`, `price`, `created_at`, `updated_at`) VALUES
(3, 'Decision', '1-palm1.jpg', 90, 4, 0, '2018-08-09 22:19:04', '2018-08-09 22:19:04'),
(4, 'Market', 'market12.jpg', 90, 2, 0, '2018-08-10 15:40:17', '2018-08-10 15:40:17'),
(6, 'Halal B', '1-palm2.jpg', 10, 2, 0, '2018-08-10 16:23:33', '2018-08-10 16:23:33'),
(7, 'Pocari Sweat', 'pocari.jpeg', 100, 3, 0, '2018-08-11 12:29:07', '2018-08-11 12:29:07'),
(8, 'Coklat Panas Pocari', '1-palm.jpg', 7, 3, 0, '2018-08-13 14:42:44', '2018-08-13 14:42:44'),
(9, 'Produk A', '1-plywood1.jpg', 0, 3, 0, '2018-08-13 15:51:49', '2018-08-13 15:51:49'),
(10, 'Produk B', '1-palm8.jpg', 10, 3, 0, '2018-08-13 15:52:26', '2018-08-13 15:52:26'),
(11, 'Produk C', '1-plywood2.jpg', 12, 3, 0, '2018-08-13 15:52:41', '2018-08-13 15:52:41'),
(12, 'Produk D', '1-prove.png', 14, 3, 0, '2018-08-13 15:52:54', '2018-08-13 15:52:54'),
(13, 'Produk E', '1-prove1.png', 14, 3, 0, '2018-08-13 15:53:08', '2018-08-13 15:53:08'),
(14, 'Produk F', '592e2639fdee94b3240a1127b3df95a8-2-open-wavy-wings-by-vexels.png', 16, 3, 0, '2018-08-13 15:53:57', '2018-08-13 15:53:57'),
(15, 'Barang Renton', 'doha-2366127_1920.jpg', 100, 3, 100000000, '2018-08-14 02:20:02', '2018-08-14 02:20:02'),
(16, 'Beng-Beng', '1-A2.jpg', 60, 3, 8000, '2018-08-14 02:32:09', '2018-08-14 02:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'no spaces, use underscore instead',
  `display_name` varchar(100) NOT NULL,
  `hidden` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = false, 1 = true',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `is_owner` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_owner`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '1', '2018-05-20 13:28:34', '2018-05-20 13:28:34'),
(2, 'afiefsky', '3e47b75000b0924b6c9ba5759a7cf15d', '1', '2018-08-02 21:32:14', '2018-08-02 21:32:14'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', '2018-08-09 13:26:58', '2018-08-09 13:26:58'),
(4, 'potter', '3e47b75000b0924b6c9ba5759a7cf15d', '0', '2018-08-10 14:59:29', '2018-08-10 14:59:29'),
(5, 'drangleic', '3e47b75000b0924b6c9ba5759a7cf15d', '0', '2018-08-10 15:57:03', '2018-08-10 15:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `users_companies`
--

CREATE TABLE `users_companies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_companies`
--

INSERT INTO `users_companies` (`id`, `user_id`, `company_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(5, 4, 5),
(6, 4, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(13, 2, 13),
(14, 2, 14),
(15, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_companies`
--
ALTER TABLE `users_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_companies`
--
ALTER TABLE `users_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
