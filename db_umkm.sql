-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2018 at 12:01 PM
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
(15, 'Kegiatan Buka Bersama Poltek Coy', '2018-03-08', 'kopi_bersama.jpeg', 16, 'Acara meriah diminati oleh banyak anak-anak umur 5-10 tahun', '2018-08-14 17:33:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `status` enum('0','1','2') DEFAULT NULL COMMENT '0 = Unsubmitted, 1 = Submitted and pending, 2 = Confirmed by Admin',
  `transaction_code` text,
  `file_name` text,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `status`, `transaction_code`, `file_name`, `description`, `created_at`, `updated_at`) VALUES
(21, NULL, NULL, NULL, '21', '2018-08-14 16:01:50', '2018-08-14 16:01:50'),
(22, NULL, NULL, NULL, '22', '2018-08-14 17:00:31', '2018-08-14 17:00:31'),
(23, '1', 'BU0K3ZRWEK', NULL, '23', '2018-08-15 01:31:00', '2018-08-15 01:31:00'),
(24, '1', 'AGVEYDHGW4', NULL, '24', '2018-08-15 02:19:13', '2018-08-15 02:19:13'),
(25, '1', 'AJP5KVOWMI', NULL, '25', '2018-08-15 02:20:14', '2018-08-15 02:20:14'),
(26, '1', 'ZS8WXC7COM', NULL, '26', '2018-08-15 02:21:17', '2018-08-15 02:21:17'),
(27, '1', 'BJ8QUK1GUE', NULL, '27', '2018-08-15 02:23:28', '2018-08-15 02:23:28'),
(28, '1', 'AZMAPBHNZJ', NULL, '28', '2018-08-15 02:25:50', '2018-08-15 02:25:50'),
(29, '1', 'KQM5Z7K5HY', NULL, '29', '2018-08-15 02:26:43', '2018-08-15 02:26:43'),
(30, '1', 'OO7GDCWKZQ', NULL, '30', '2018-08-15 02:27:20', '2018-08-15 02:27:20'),
(31, '1', 'VYWYOUEY16', NULL, '31', '2018-08-15 02:27:48', '2018-08-15 02:27:48'),
(32, '1', 'WFLIUWVFMU', NULL, '32', '2018-08-15 02:28:17', '2018-08-15 02:28:17'),
(33, '1', '4YW39QMBKI', NULL, '33', '2018-08-15 02:29:02', '2018-08-15 02:29:02'),
(34, '1', 'Q0OGFDKCE4', NULL, '34', '2018-08-15 02:32:55', '2018-08-15 02:32:55'),
(35, '1', 'L1MEACZEUN', NULL, '35', '2018-08-15 02:33:39', '2018-08-15 02:33:39'),
(36, '1', '18EBVDLVZP', NULL, '36', '2018-08-15 02:46:33', '2018-08-15 02:46:33'),
(37, '1', 'cd3de5fbd570809fe181fc0d89c1c65f', NULL, '37', '2018-08-15 03:00:53', '2018-08-15 03:00:53'),
(38, '1', '4NUSOMNQXX', 'buktitransfer6.jpg', '38', '2018-08-02 03:02:04', '2018-08-15 03:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `carts_details`
--

CREATE TABLE `carts_details` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `description` text,
  `is_cancelled` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts_details`
--

INSERT INTO `carts_details` (`id`, `cart_id`, `product_id`, `qty`, `description`, `is_cancelled`, `created_at`, `updated_at`) VALUES
(18, 21, 17, 5, 'Cart = 21, Product = 17', '1', '2018-08-14 16:33:39', '0000-00-00 00:00:00'),
(19, 21, 19, 1, 'Cart = 21, Product = 19', '0', '2018-08-14 16:53:37', '0000-00-00 00:00:00'),
(20, 21, 19, 1, 'Cart = 21, Product = 19', '0', '2018-08-14 16:53:59', '0000-00-00 00:00:00'),
(21, 22, 18, 1, 'Cart = 22, Product = 18', '1', '2018-08-14 17:02:59', '0000-00-00 00:00:00'),
(22, 23, 17, 1, 'Cart = 23, Product = 17', '0', '2018-08-15 01:31:01', '0000-00-00 00:00:00'),
(23, 24, 17, 1, 'Cart = 24, Product = 17', '0', '2018-08-15 02:19:13', '0000-00-00 00:00:00'),
(24, 25, 17, 1, 'Cart = 25, Product = 17', '0', '2018-08-15 02:20:15', '0000-00-00 00:00:00'),
(25, 26, 17, 1, 'Cart = 26, Product = 17', '0', '2018-08-15 02:21:17', '0000-00-00 00:00:00'),
(26, 27, 17, 1, 'Cart = 27, Product = 17', '0', '2018-08-15 02:23:29', '0000-00-00 00:00:00'),
(27, 28, 17, 1, 'Cart = 28, Product = 17', '0', '2018-08-15 02:25:51', '0000-00-00 00:00:00'),
(28, 29, 17, 1, 'Cart = 29, Product = 17', '0', '2018-08-15 02:26:43', '0000-00-00 00:00:00'),
(29, 29, 17, 1, 'Cart = 29, Product = 17', '0', '2018-08-15 02:26:47', '0000-00-00 00:00:00'),
(30, 30, 18, 1, 'Cart = 30, Product = 18', '0', '2018-08-15 02:27:20', '0000-00-00 00:00:00'),
(31, 31, 18, 1, 'Cart = 31, Product = 18', '0', '2018-08-15 02:27:48', '0000-00-00 00:00:00'),
(32, 32, 18, 1, 'Cart = 32, Product = 18', '0', '2018-08-15 02:28:17', '0000-00-00 00:00:00'),
(33, 33, 18, 1, 'Cart = 33, Product = 18', '0', '2018-08-15 02:29:02', '0000-00-00 00:00:00'),
(34, 34, 18, 1, 'Cart = 34, Product = 18', '0', '2018-08-15 02:32:55', '0000-00-00 00:00:00'),
(35, 35, 18, 1, 'Cart = 35, Product = 18', '0', '2018-08-15 02:33:39', '0000-00-00 00:00:00'),
(36, 36, 17, 1, 'Cart = 36, Product = 17', '0', '2018-08-15 02:46:34', '0000-00-00 00:00:00'),
(37, 37, 18, 1, 'Cart = 37, Product = 18', '0', '2018-08-15 03:00:54', '0000-00-00 00:00:00'),
(38, 38, 18, 1, 'Cart = 38, Product = 18', '0', '2018-08-15 03:02:04', '0000-00-00 00:00:00'),
(39, 39, 18, 1, 'Cart = 39, Product = 18', '0', '2018-08-15 03:43:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image_url` text NOT NULL,
  `location` text NOT NULL,
  `location_full` text,
  `is_confirmed` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `image_url`, `location`, `location_full`, `is_confirmed`, `created_at`, `updated_at`) VALUES
(16, 'Bandung Kopi Poltek Coy', 'QPI.png', 'Bandung', 'Jalan Sariasih No.54, Sarijadi, Sukasari, Kota Bandung, Jawa Barat 40151', '1', '2018-02-07 12:42:14', '2018-08-14 12:42:14'),
(17, 'Kedai Burger Krusty Pos', 'burger.png', 'Bandung', 'Jalan Sariasih No.54, Sarijadi, Sukasari, Kota Bandung, Jawa Barat 40151', '1', '2018-05-01 12:47:07', '2018-08-14 12:47:07'),
(18, 'Halal of the Road', 'wadoel-food-cout-di-jalan-geger-kalong_20170710_183823.jpg', 'Bandung', 'Jl. Gegerkalong KulonGegerkalong, Sukasari, Kota Bandung, Jawa Barat 40153', '0', '2018-08-15 03:53:31', '2018-08-15 03:53:31'),
(19, 'Rumah Coklat', 'coklat.jpeg', 'Bandung', 'Jl. Permata Kopo Sayati, Margahayu, Bandung, Jawa Barat 40228', '0', '2018-08-15 04:33:58', '2018-08-15 04:33:58'),
(20, 'Rumah Strawberry', 'strawberry.jpeg', 'Bandung', 'Jl. Permata Kopo Sayati, Margahayu, Bandung, Jawa Barat 40228', '0', '2018-08-15 04:41:31', '2018-08-15 04:41:31'),
(21, 'Rumah Makan Padang Ke-Ba', 'padangbandung.jpeg', 'Bandung', 'Jalan Cihampelas 160, Cipaganti, Coblong, Cipaganti, Coblong, Kota Bandung, Jawa Barat 40131', '0', '2018-08-15 04:51:18', '2018-08-15 04:51:18');

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
(17, 'Kopi Nescafe', 'nescafe_exclusive.png', 100, 16, 10000, '2018-08-14 12:44:49', '2018-08-14 12:44:49'),
(18, 'Exclusive Burger Size XXL', 'superbigburger.jpg', 100, 17, 50000, '2018-08-14 12:50:01', '2018-08-14 12:50:01'),
(19, 'Kopi Si Hitam Pekat', 'blackcoffee.png', 150, 16, 15000, '2018-08-14 14:21:32', '2018-08-14 14:21:32'),
(20, 'Kopi Super Man', 'hot_coffee.jpeg', 50, 16, 90000, '2018-08-15 04:21:47', '2018-08-15 04:21:47');

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
  `bank_account_number` text,
  `bank_name` text,
  `bank_account_owner` text COMMENT 'Atas nama',
  `is_owner` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `bank_account_number`, `bank_name`, `bank_account_owner`, `is_owner`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', NULL, NULL, NULL, '1', '2018-05-20 13:28:34', '2018-05-20 13:28:34'),
(2, 'silviasky', '3e47b75000b0924b6c9ba5759a7cf15d', '20011000310', 'BNI', 'Silvia Skyden', '1', '2018-08-02 21:32:14', '2018-08-02 21:32:14'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, '1', '2018-08-09 13:26:58', '2018-08-09 13:26:58'),
(4, 'potter', '3e47b75000b0924b6c9ba5759a7cf15d', NULL, NULL, NULL, '0', '2018-08-10 14:59:29', '2018-08-10 14:59:29'),
(5, 'drangleic', '3e47b75000b0924b6c9ba5759a7cf15d', NULL, NULL, NULL, '0', '2018-08-10 15:57:03', '2018-08-10 15:57:03');

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
(15, 2, 15),
(16, 2, 16),
(17, 2, 17),
(18, 2, 18),
(19, 2, 19),
(20, 2, 20),
(21, 2, 21);

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts_details`
--
ALTER TABLE `carts_details`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `carts_details`
--
ALTER TABLE `carts_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
