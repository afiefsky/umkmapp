/*
Navicat MySQL Data Transfer

Source Server         : phpmyadmin
Source Server Version : 100119
Source Host           : localhost:3306
Source Database       : db_umkm

Target Server Type    : MYSQL
Target Server Version : 100119
File Encoding         : 65001

Date: 2018-09-10 06:27:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `date` date NOT NULL,
  `file_name` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of activities
-- ----------------------------
INSERT INTO `activities` VALUES ('1', 'Jabar Book Fair 2018', '2018-08-01', '33691000_1919978028053703_2678807845960417280_n-1.jpg', '2', '7 Pesona Jawa Barat Di Jabar Book Fair 2018', '2018-08-29 19:52:01', '0000-00-00 00:00:00');
INSERT INTO `activities` VALUES ('2', 'Pameran \"Cicipi maskan Khas Nusantara\"', '2018-08-14', 'Stand_UKM_Sambal_Dede_Satoe.jpg', '6', 'Stand UKM Sambal Dede Satoe\r\nLokasi Kegiatan di Makassar', '2018-08-29 20:30:05', '0000-00-00 00:00:00');
INSERT INTO `activities` VALUES ('3', 'Kuliner Khas Sulawesi', '2018-08-14', 'ukm-makananok.jpg', '6', 'Pameran Kuliner Khas Sulawesi\r\nLokasi-Makassar Sulawesi Selatan', '2018-08-29 20:32:58', '0000-00-00 00:00:00');
INSERT INTO `activities` VALUES ('4', 'Pesta Buku ', '2018-08-08', 'pameran-buku1.jpg', '2', 'Yuk Biasakan Membaca\r\nLandmark-Braga, Bandung\r\n', '2018-08-29 20:35:32', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of carts
-- ----------------------------
INSERT INTO `carts` VALUES ('1', '3', '3JG5YUQRWL', 'e-cash-palsu.jpg', 'kiki', 'cjr', 'arezkyameliap@gmail.com', '085255557875', '1', '2018-08-29 19:36:36', '2018-08-29 19:36:36');
INSERT INTO `carts` VALUES ('2', '2', 'VAV5EMQGRN', 'buktitransfer.jpeg', 'TREVOR', 'JAKARTA PUSAT NO 10', 'afiefsky@gmail.com', '089666848126', '2', '2018-08-30 09:38:07', '2018-08-30 09:38:07');
INSERT INTO `carts` VALUES ('3', null, null, null, null, null, null, null, '3', '2018-09-10 05:41:27', '2018-09-10 05:41:27');
INSERT INTO `carts` VALUES ('4', '1', 'ACYKYDPYNI', null, null, null, null, null, '4', '2018-09-10 05:42:18', '2018-09-10 05:42:18');
INSERT INTO `carts` VALUES ('5', '2', 'SICZQPO5SK', 'buktitransfer1.jpeg', 'MUHAMMAD AFIEF FARISTA', 'Jl Merah 10', 'afiefsky@gmail.com', '089666848126', '5', '2018-09-10 05:52:17', '2018-09-10 05:52:17');
INSERT INTO `carts` VALUES ('6', null, null, null, null, null, null, null, '6', '2018-09-10 06:10:17', '2018-09-10 06:10:17');
INSERT INTO `carts` VALUES ('7', '3', 'W3KJDHTCRU', 'buktitransfer3.jpeg', 'Renton', 'Maneuver Street', 'afiefsky@gmail.com', '08788812739', '7', '2018-09-10 06:11:17', '2018-09-10 06:11:17');

-- ----------------------------
-- Table structure for carts_details
-- ----------------------------
DROP TABLE IF EXISTS `carts_details`;
CREATE TABLE `carts_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `description` text,
  `is_cancelled` enum('0','1') NOT NULL DEFAULT '0',
  `is_discount` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of carts_details
-- ----------------------------
INSERT INTO `carts_details` VALUES ('1', '1', '1', '1', 'Cart = 1, Product = 1', '0', null, '2018-08-29 19:36:36', '0000-00-00 00:00:00');
INSERT INTO `carts_details` VALUES ('2', '2', '3', '1', 'Cart = 2, Product = 3', '0', null, '2018-08-30 09:38:07', '0000-00-00 00:00:00');
INSERT INTO `carts_details` VALUES ('3', '3', '3', '1', 'Cart = 3, Product = 3', '0', '1', '2018-09-10 05:41:27', '0000-00-00 00:00:00');
INSERT INTO `carts_details` VALUES ('4', '4', '8', '1', 'Cart = 4, Product = 8', '0', '1', '2018-09-10 05:42:18', '0000-00-00 00:00:00');
INSERT INTO `carts_details` VALUES ('5', '4', '9', '1', 'Cart = 4, Product = 9', '0', '1', '2018-09-10 05:42:22', '0000-00-00 00:00:00');
INSERT INTO `carts_details` VALUES ('6', '5', '3', '1', 'Cart = 5, Product = 3', '0', '1', '2018-09-10 05:52:17', '0000-00-00 00:00:00');
INSERT INTO `carts_details` VALUES ('7', '6', '7', '1', 'Cart = 6, Product = 7', '0', null, '2018-09-10 06:10:17', '0000-00-00 00:00:00');
INSERT INTO `carts_details` VALUES ('8', '7', '3', '1', 'Cart = 7, Product = 3', '1', '1', '2018-09-10 06:12:39', '0000-00-00 00:00:00');
INSERT INTO `carts_details` VALUES ('9', '7', '7', '1', 'Cart = 7, Product = 7', '0', '1', '2018-09-10 06:13:49', '0000-00-00 00:00:00');
INSERT INTO `carts_details` VALUES ('10', '7', '7', '1', 'Cart = 7, Product = 7', '0', '1', '2018-09-10 06:15:45', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for companies
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of companies
-- ----------------------------
INSERT INTO `companies` VALUES ('1', 'Karya Agung', 'Capture.JPG', 'Makassar', 'Jl.Lapawawoi', '1', '1', '2018-08-28 22:45:02', '2018-08-28 22:45:02', '2018-08-29 08:45:37');
INSERT INTO `companies` VALUES ('2', 'Karya Agung', 'Capture1.JPG', 'Watampone', 'Jl.Lapawawoi Kr.Sigeri', '1', '0', '2018-08-29 09:09:31', '2018-08-29 09:09:31', '2018-08-29 09:39:17');
INSERT INTO `companies` VALUES ('3', 'Hellish Queen', 'batik.jpg', 'Jakarta Kota', 'Jakarta Kota Pondok Kelapa No 10', '0', '0', '2018-08-29 09:31:38', '2018-08-29 09:31:38', null);
INSERT INTO `companies` VALUES ('4', 'Bristle Back', 'batik1.jpg', 'Jakarta Pusat', 'Jakarta Pusat Menteng No. 9', '1', '1', '2018-08-29 19:25:38', '2018-08-29 19:25:38', '2018-08-29 19:55:18');
INSERT INTO `companies` VALUES ('5', 'Nur Atya Shop', 'backgroun_baju.JPG', 'Bandung', 'Jl.Dipati Ukur', '1', '0', '2018-08-29 19:57:21', '2018-08-29 19:57:21', '2018-08-29 20:03:12');
INSERT INTO `companies` VALUES ('6', 'Karya Agung Kuliner', 'cooltext296387389850523.png', 'Makassar', 'Jl.Perintis Kemerdekaan', '1', '0', '2018-08-29 19:58:23', '2018-08-29 19:58:23', '2018-08-29 20:03:12');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `file_name` text,
  `qty` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `price` bigint(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', 'Produk Halflife', 'blackcoffee.png', '11', '4', '10200000', '2018-08-29 19:34:14', '2018-08-29 19:34:14');
INSERT INTO `products` VALUES ('3', 'Novel \"Surat Kecil Untuk Tuhan\"', 'surat_kecil_untuk_tuhan1.jpg', '8', '2', '50000', '2018-08-29 19:45:50', '2018-08-29 19:45:50');
INSERT INTO `products` VALUES ('4', 'Novel \"Laskar Pelangi\"', 'Laskar-Pelangi.jpg', '50', '2', '50000', '2018-08-29 19:48:39', '2018-08-29 19:48:39');
INSERT INTO `products` VALUES ('5', 'Novel \"Bulan Terbelah di Langit Amerika\"', 'download.jpg', '22', '2', '50000', '2018-08-29 19:53:33', '2018-08-29 19:53:33');
INSERT INTO `products` VALUES ('6', 'Novel \"Jodoh Terbaik\"', 'IMG_20170518_163417.jpg', '22', '2', '50000', '2018-08-29 19:54:16', '2018-08-29 19:54:16');
INSERT INTO `products` VALUES ('7', 'Baby Boy -All size', 'download1.jpg', '27', '5', '70000', '2018-08-29 20:05:54', '2018-08-29 20:05:54');
INSERT INTO `products` VALUES ('8', 'Monki Black-All size', 'EL-OSO-BEBE-Niemowl-t-Ch-opc-w-Gentleman-Formalne-Garnitury-Little-Kids-Boy-T-shirt.jpg', '33', '5', '150000', '2018-08-29 20:07:26', '2018-08-29 20:07:26');
INSERT INTO `products` VALUES ('9', 'Korea Black-All size', '5229857_cba50cf7-6a50-4192-9da2-917e03d401e1.jpg', '44', '5', '170000', '2018-08-29 20:08:14', '2018-08-29 20:08:14');
INSERT INTO `products` VALUES ('10', 'Monki Koko', '10660242_8b1c6e3d-5614-4e27-812d-9c3d92484956_600_600.jpg', '44', '5', '150000', '2018-08-29 20:13:05', '2018-08-29 20:13:05');
INSERT INTO `products` VALUES ('11', 'Dress Mini Black-All size', '61DgT4-mf3L__UX385_.jpg', '12', '5', '200000', '2018-08-29 20:13:52', '2018-08-29 20:13:52');
INSERT INTO `products` VALUES ('12', 'Dress Mini Pink-All size', '1.jpg', '13', '5', '200000', '2018-08-29 20:15:51', '2018-08-29 20:15:51');
INSERT INTO `products` VALUES ('13', 'Dress Mini Black two-All size', 'black-satin-bib-necklin-chiffon-aline-flower-girl-dress-KD-255B2-1000x1500.jpg', '11', '5', '200000', '2018-08-29 20:17:13', '2018-08-29 20:17:13');
INSERT INTO `products` VALUES ('14', 'Sosis', 'makanan7.jpg', '50', '6', '50000', '2018-08-29 20:18:06', '2018-08-29 20:18:06');
INSERT INTO `products` VALUES ('15', 'Good Tela', 'makanan11.png', '100', '6', '20000', '2018-08-29 20:21:52', '2018-08-29 20:21:52');
INSERT INTO `products` VALUES ('16', 'Keripik Susu Khas Enrekang', 'keripik_susu_dangke_khas_enrekang.jpg', '150', '6', '40000', '2018-08-29 20:23:03', '2018-08-29 20:23:03');
INSERT INTO `products` VALUES ('17', 'Sambal Ikan Roa', 'sambal_ikan_roa.jpg', '150', '6', '70000', '2018-08-29 20:23:43', '2018-08-29 20:23:43');
INSERT INTO `products` VALUES ('18', 'Roti Mantau Pare', 'Roti_Mantau_Pare.jpg', '200', '6', '35000', '2018-08-29 20:24:52', '2018-08-29 20:24:52');
INSERT INTO `products` VALUES ('19', 'Keripik Singkong Daeng Balado', 'keripik_singkong_daeng_balado.jpg', '80', '6', '40000', '2018-08-29 20:25:40', '2018-08-29 20:25:40');
INSERT INTO `products` VALUES ('20', 'Jambu Mete', 'mete_kendari.jpg', '70', '6', '90000', '2018-08-29 20:26:41', '2018-08-29 20:26:41');
INSERT INTO `products` VALUES ('21', 'Pisang Peppe', 'pisang_peppe.jpg', '100', '6', '80000', '2018-08-29 20:27:51', '2018-08-29 20:27:51');
INSERT INTO `products` VALUES ('22', 'Novel\"Harry Potter\"', 'harry_potter.jpg', '30', '2', '46000', '2018-08-29 20:38:56', '2018-08-29 20:38:56');
INSERT INTO `products` VALUES ('23', 'Novel \"Faith And The City\"', 'faith_and_the_city.jpg', '80', '2', '45000', '2018-08-29 20:41:14', '2018-08-29 20:41:14');
INSERT INTO `products` VALUES ('24', 'Novel\" Semesta Mendukung\"', 'semesta_mendukung.jpg', '45', '2', '45000', '2018-08-29 20:42:05', '2018-08-29 20:42:05');
INSERT INTO `products` VALUES ('25', 'Novel \"Negeri 5 Menara\"', 'negeri_5_menara.jpg', '70', '2', '45000', '2018-08-29 20:42:59', '2018-08-29 20:42:59');
INSERT INTO `products` VALUES ('26', 'Novel \"Ayat-Ayat Cinta\"', 'Ayatayatcinta.jpg', '70', '2', '45000', '2018-08-29 20:44:35', '2018-08-29 20:44:35');

-- ----------------------------
-- Table structure for products_out
-- ----------------------------
DROP TABLE IF EXISTS `products_out`;
CREATE TABLE `products_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products_out
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'no spaces, use underscore instead',
  `display_name` varchar(100) NOT NULL,
  `hidden` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = false, 1 = true',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'super_administrator', 'Super Administrator', '1', '2018-05-20 20:20:37', '2018-05-20 20:20:37');
INSERT INTO `roles` VALUES ('2', 'administrator', 'Administrator', '1', '2018-05-20 20:20:37', '2018-05-20 20:20:37');
INSERT INTO `roles` VALUES ('3', 'customer', 'Customer', '0', '2018-05-20 20:21:12', '2018-05-20 20:21:12');
INSERT INTO `roles` VALUES ('4', 'owner', 'Owner', '0', '2018-08-10 21:10:00', '2018-08-10 21:10:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', null, null, null, null, '1', '2018-05-20 20:28:34', '2018-05-20 20:28:34');
INSERT INTO `users` VALUES ('2', 'silviasky@gmail.com', '3e47b75000b0924b6c9ba5759a7cf15d', '087812334522', '20011000322', 'BRI', 'Silvia Skywrath', '1', '2018-08-03 04:32:14', '2018-08-03 04:32:14');
INSERT INTO `users` VALUES ('3', 'admin', '21232f297a57a5a743894a0e4a801fc3', null, null, null, null, '1', '2018-08-09 20:26:58', '2018-08-09 20:26:58');
INSERT INTO `users` VALUES ('4', 'arezkyap@gmail.com', '7139bbd67895b3e9dc4577706d43720c', '085255557875', '6103010102211761', 'BRI', 'A.Rezky Amelia Putri', '0', '2018-08-29 09:03:44', '2018-08-29 09:03:44');
INSERT INTO `users` VALUES ('5', 'druiyansyah@gmail.com', '3e47b75000b0924b6c9ba5759a7cf15d', '089666848126', null, null, 'Druiyansyah', '0', '2018-08-29 09:16:46', '2018-08-29 09:16:46');
INSERT INTO `users` VALUES ('6', 'wimar@gmail.com', '3e47b75000b0924b6c9ba5759a7cf15d', '0897771672', '081982387498', 'BNI', 'WIMAR', '0', '2018-08-29 09:22:11', '2018-08-29 09:22:11');

-- ----------------------------
-- Table structure for users_companies
-- ----------------------------
DROP TABLE IF EXISTS `users_companies`;
CREATE TABLE `users_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users_companies
-- ----------------------------
INSERT INTO `users_companies` VALUES ('1', '2', '1');
INSERT INTO `users_companies` VALUES ('2', '4', '2');
INSERT INTO `users_companies` VALUES ('3', '6', '3');
INSERT INTO `users_companies` VALUES ('4', '2', '4');
INSERT INTO `users_companies` VALUES ('5', '4', '5');
INSERT INTO `users_companies` VALUES ('6', '4', '6');

-- ----------------------------
-- Table structure for users_roles
-- ----------------------------
DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE `users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users_roles
-- ----------------------------
