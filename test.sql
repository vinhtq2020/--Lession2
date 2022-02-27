-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 27, 2022 lúc 04:38 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(2, 'danh mục 1'),
(3, 'danh mục 2'),
(4, 'danh mục 3'),
(5, 'danh mục 4'),
(6, 'danh mục 5'),
(7, 'danh mục 6'),
(8, 'danh mục 7'),
(9, 'danh mục 8'),
(10, 'danh mục 9'),
(11, 'danh mục 10'),
(12, 'danh mục 11'),
(13, 'danh mục 12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `product_name`, `category_id`, `image_url`) VALUES
(2, 'sản phẩm 1', 2, '1f375d94ed8fe9fd0fa78d775b6914071645886275.png'),
(3, 'sản phẩm 2', 3, '03980a098aaba48489ecc23734e572941645892472.png'),
(4, 'sản phẩm 3', 4, '7fdc1a630c238af0815181f9faa190f51645927991.jpg'),
(5, 'sản phẩm 4', 5, '9321ecfc28c3e8be55b83f11ae48e8c21645928506.jpg'),
(6, 'sản phẩm 5', 2, 'be87e99ac0fd7872bf08863f3787c2341645928539.jpg'),
(7, 'sản phẩm 6', 9, '4eb2eccd981075c8272ba00aa95b4d811645928557.jpg'),
(8, 'sản phẩm 7', 8, '9f6cbd4322dd589f8a4ec6ecf4abd3f81645928702.jpg'),
(9, 'sản phẩm 8', 4, 'abfb944db6914f559247d0d2e13cadf51645928720.jpg'),
(10, 'sản phẩm 9', 3, '3d42ebff2aa8936d31dd89a92763f8331645928742.jpg'),
(11, 'sản phẩm 10', 13, 'e20f1d1cea343156e18c4ea10c31360b1645928861.jpg'),
(12, 'sản phẩm 11', 12, '067cf1087a156cdfd31e831207d61bc61645928878.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CATEGORYID_PRODUCT_CATEGORY` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_CATEGORYID_PRODUCT_CATEGORY` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
