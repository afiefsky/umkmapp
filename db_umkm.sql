-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 11:50 PM
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
(15, 'Kegiatan Buka Bersama Poltek Coy', '2018-03-08', 'bukabersama.jpeg', 16, 'Buka bersama MCD dengan badut dan tata rias lengkap', '2018-08-14 14:04:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `description`, `created_at`, `updated_at`) VALUES
(21, '21', '2018-08-14 16:01:50', '2018-08-14 16:01:50');

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
(18, 21, 17, 5, 'Cart = 21, Product = 17', '1', '2018-08-14 16:33:39', '0000-00-00 00:00:00');

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
(16, 'Bandung Kopi Poltek Coy', 'QPI.png', 'Bandung', 'Jalan Sariasih No.54, Sarijadi, Sukasari, Kota Bandung, Jawa Barat 40151', '1', '2018-08-14 12:42:14', '2018-08-14 12:42:14'),
(17, 'Kedai Burger Krusty Pos', 'burger.png', 'Bandung', 'Jalan Sariasih No.54, Sarijadi, Sukasari, Kota Bandung, Jawa Barat 40151', '1', '2018-08-14 12:47:07', '2018-08-14 12:47:07');

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
(19, 'Kopi Si Hitam Pekat', 'blackcoffee.png', 150, 16, 15000, '2018-08-14 14:21:32', '2018-08-14 14:21:32');

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
(15, 2, 15),
(16, 2, 16),
(17, 2, 17);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `carts_details`
--
ALTER TABLE `carts_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
