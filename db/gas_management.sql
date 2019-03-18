-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th3 18, 2019 lúc 03:51 PM
-- Phiên bản máy phục vụ: 5.7.19
-- Phiên bản PHP: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gas_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mã',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên',
  `parent_id` int(11) DEFAULT NULL COMMENT 'Danh Mục Cha',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Trạng Thái',
  `created_at` int(11) NOT NULL COMMENT 'Ngày tạo',
  `updated_at` int(11) NOT NULL COMMENT 'Ngày sửa',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `IDX_CATEGORY_CODE` (`code`,`parent_id`),
  KEY `CATEGORY_PARENT_ID_CATEGORY_ID` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `code`, `name`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'category-1', 'category 1', NULL, 1, 1551604942, 1551604942),
(2, 'category-2', 'category 1', NULL, 1, 1551607940, 1551607940),
(3, 'category-4', 'category 1', NULL, 1, 1551625598, 1551625598),
(4, 'gas', 'gas', NULL, 1, 1552815445, 1552815445);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mã',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên Khách Hàng',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Địa Chỉ',
  `phone` int(20) DEFAULT NULL COMMENT 'Số Điện Thoại',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Trạng Thái',
  `created_at` int(11) NOT NULL COMMENT 'Ngày tạo',
  `updated_at` int(11) NOT NULL COMMENT 'Ngày sửa',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `code`, `name`, `address`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'KH001', 'Ông A', 'An Dương', 1695210389, 1, 1552819198, 1552819198),
(2, 'KH002', 'Bà B', 'Lê Thiện', 165986235, 1, 1552819217, 1552819217);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1551102705),
('m130524_201442_init', 1551102709),
('m190225_145323_quote_item', 1551109523),
('m190225_144151_quote', 1551109523),
('m190225_141512_product', 1551109522),
('m190225_140606_customer', 1551109522),
('m190225_140202_unit', 1551109522),
('m190225_135649_category', 1551109522);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mã',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên',
  `price` float NOT NULL COMMENT 'Đơn Giá',
  `input_price` float NOT NULL COMMENT 'Giá Nhập',
  `unit_id` int(11) NOT NULL COMMENT 'Đơn Vị Tính',
  `category_id` int(11) NOT NULL COMMENT 'Danh Mục',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Trạng Thái',
  `created_at` int(11) NOT NULL COMMENT 'Ngày tạo',
  `updated_at` int(11) NOT NULL COMMENT 'Ngày sửa',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `IDX_PRODUCT_CODE` (`code`,`unit_id`,`category_id`),
  KEY `PRODUCT_UNIT_ID_UNIT_ID` (`unit_id`),
  KEY `PRODUCT_CATEGORY_ID_CATEGORY_ID` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `price`, `input_price`, `unit_id`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GASH', 'Gas Hồng', 400000, 390000, 1, 4, 1, 1552816682, 1552817832),
(2, 'GAS-MQ', 'GAS MQ', 29000, 28000, 1, 4, 1, 1552818072, 1552818072);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quote`
--

DROP TABLE IF EXISTS `quote`;
CREATE TABLE IF NOT EXISTS `quote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(12,4) DEFAULT NULL COMMENT 'Tổng Tiền',
  `customer_id` int(11) DEFAULT NULL COMMENT 'Khách',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Trạng Thái',
  `note` text COLLATE utf8_unicode_ci COMMENT 'Ghi Chú',
  `created_at` int(11) NOT NULL COMMENT 'Ngày tạo',
  `updated_at` int(11) NOT NULL COMMENT 'Ngày sửa',
  PRIMARY KEY (`id`),
  KEY `IDX_QUOTE` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quote`
--

INSERT INTO `quote` (`id`, `total`, `customer_id`, `status`, `note`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 0, NULL, 1552920535, 1552920535),
(2, NULL, NULL, 0, NULL, 1552922294, 1552922294),
(3, NULL, NULL, 0, NULL, 1552922375, 1552922375),
(4, NULL, NULL, 0, NULL, 1552923046, 1552923046),
(5, NULL, NULL, 1, NULL, 1552923116, 1552923116),
(6, NULL, NULL, 1, NULL, 1552923315, 1552923315),
(7, NULL, NULL, 1, NULL, 1552923666, 1552923666),
(8, NULL, NULL, 1, NULL, 1552923698, 1552923698),
(9, NULL, NULL, 1, NULL, 1552923789, 1552923789),
(10, NULL, NULL, 1, NULL, 1552923830, 1552923830),
(11, NULL, NULL, 1, NULL, 1552923850, 1552923850),
(12, NULL, NULL, 1, NULL, 1552923869, 1552923869),
(13, NULL, NULL, 1, NULL, 1552923890, 1552923890),
(14, NULL, NULL, 1, NULL, 1552924021, 1552924021),
(15, NULL, NULL, 1, NULL, 1552924052, 1552924052),
(16, NULL, NULL, 1, NULL, 1552924062, 1552924062);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quote_item`
--

DROP TABLE IF EXISTS `quote_item`;
CREATE TABLE IF NOT EXISTS `quote_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT 'Mã Sản Phẩm',
  `parent_item_id` int(11) DEFAULT NULL COMMENT 'Mã Sản Phẩm Cha',
  `qty` decimal(12,4) NOT NULL DEFAULT '1.0000' COMMENT 'Số Lượng',
  `price` decimal(12,4) DEFAULT NULL COMMENT 'Đơn Giá',
  `discount_percent` decimal(12,4) DEFAULT NULL COMMENT 'Phần Trăm Giảm Giá',
  `discount_amount` decimal(12,4) DEFAULT NULL COMMENT 'Số Tiền Giảm Giá',
  `total` decimal(12,4) DEFAULT NULL COMMENT 'Tổng Tiền',
  `quote_id` int(11) DEFAULT NULL COMMENT 'Mã Báo Giá',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Trạng Thái',
  `created_at` int(11) NOT NULL COMMENT 'Ngày tạo',
  `updated_at` int(11) NOT NULL COMMENT 'Ngày sửa',
  PRIMARY KEY (`id`),
  KEY `IDX_QUOTE_ITEM` (`quote_id`,`parent_item_id`,`product_id`),
  KEY `QUOTE_ITEM_PARENT_ITEM_ID_QUOTE_ITEM_ITEM_ID` (`parent_item_id`),
  KEY `QUOTE_ITEM_PRODUCT_ID_PRODUCT_ID` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mã',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Trạng Thái',
  `created_at` int(11) NOT NULL COMMENT 'Ngày tạo',
  `updated_at` int(11) NOT NULL COMMENT 'Ngày sửa',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `IDX_UNIT_CODE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `unit`
--

INSERT INTO `unit` (`id`, `code`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'binh', 'Bình', 1, 0, 0),
(2, 'chiec', 'Chiếc', 1, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dat', 'Dsg7WDxVXstRsYs_KsaXmYLuGZJf90TI', '$2y$13$OHQKTCDWElKKlozed3YdnuU3mg0CBVFV9f662b45afMOq1mxFW0XO', NULL, 'dat@gmail.com', 10, 1551281681, 1551281681),
(2, 'dat12321', 'QcxafgN93R5S7nl9FZdc2EeE4BGpbtPE', '$2y$13$DimpZ2FJCX5exXFUrW4la.aDY6jBUfRuHljT5n2vgrDOIAohZmslq', NULL, 'da123123t@gmail.com', 10, 1551281805, 1551281805),
(3, 'dat12123123321', 'py0djZi1DzJ8kAShcq0KX9ZpPuncU31E', '$2y$13$ONWalZr5M8BFTutmNuxqqepoUXBh/zv1Nsp2d6l8iB0urK9FcX5dS', NULL, 'dat12312@gmail.com', 10, 1551282484, 1551282484);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `CATEGORY_PARENT_ID_CATEGORY_ID` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `PRODUCT_CATEGORY_ID_CATEGORY_ID` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `PRODUCT_UNIT_ID_UNIT_ID` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `quote`
--
ALTER TABLE `quote`
  ADD CONSTRAINT `QUOTE_CUSTOMER_ID_CUSTOMER_ID` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `quote_item`
--
ALTER TABLE `quote_item`
  ADD CONSTRAINT `QUOTE_ITEM_PARENT_ITEM_ID_QUOTE_ITEM_ITEM_ID` FOREIGN KEY (`parent_item_id`) REFERENCES `quote_item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `QUOTE_ITEM_PRODUCT_ID_PRODUCT_ID` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `QUOTE_ITEM_QUOTE_ID_QUOTE_ID` FOREIGN KEY (`quote_id`) REFERENCES `quote` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
