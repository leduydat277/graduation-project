-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2024 lúc 12:03 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fake_datn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `assets_types`
--

CREATE TABLE `assets_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'loại tiện nghi',
  `description` text DEFAULT NULL COMMENT 'mô tả loại tiện ích'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `assets_types`
--

INSERT INTO `assets_types` (`id`, `name`, `description`) VALUES
(1, 'Air Conditioning', 'Hệ thống điều hòa không khí trong phòng, giúp không gian thoải mái hơn.'),
(2, 'Wi-Fi', 'Dịch vụ Wi-Fi miễn phí, tốc độ cao cho tất cả khách hàng sử dụng trong phòng.'),
(3, 'Television', 'Tivi màn hình phẳng với các kênh truyền hình quốc tế và trong nước.'),
(4, 'Minibar', 'Tủ minibar đầy đủ các loại đồ uống và đồ ăn nhẹ cho khách.'),
(5, 'Safe', 'Két an toàn để bảo quản tài sản cá nhân của khách.'),
(6, 'Hairdryer', 'Máy sấy tóc cao cấp phục vụ trong phòng tắm.'),
(7, 'Ironing Board', 'Bàn ủi và giá ủi cho khách sử dụng.'),
(8, 'Shower', 'Phòng tắm vòi sen, cung cấp nước nóng và lạnh.'),
(9, 'Bathtub', 'Bồn tắm rộng rãi, tiện nghi cho việc thư giãn.'),
(10, 'Coffee Maker', 'Máy pha cà phê, cho phép khách thưởng thức cà phê ngay trong phòng.'),
(11, 'Toiletries', 'Dịch vụ cung cấp đầy đủ đồ dùng vệ sinh cá nhân trong phòng tắm.'),
(12, 'Balcony', 'Ban công phòng với không gian thư giãn và ngắm cảnh.'),
(13, 'Gym Access', 'Quyền sử dụng phòng tập thể dục miễn phí tại khách sạn.'),
(14, 'Swimming Pool', 'Hồ bơi ngoài trời cho khách sử dụng trong suốt thời gian lưu trú.'),
(15, 'Refrigerator', 'Tủ lạnh nhỏ để bảo quản đồ ăn và đồ uống trong phòng.'),
(16, 'Desk', 'Bàn làm việc với ghế để phục vụ cho công việc hoặc học tập.'),
(17, 'Luggage Rack', 'Giá để hành lý, giúp khách dễ dàng sắp xếp đồ đạc.'),
(18, 'Slippers', 'Dép đi trong phòng, tạo cảm giác thoải mái cho khách.'),
(19, 'Shower Gel', 'Dầu tắm dạng gel được cung cấp trong phòng tắm.'),
(20, 'Towels', 'Khăn tắm và khăn mặt sạch sẽ cho khách.'),
(21, 'Bathrobe', 'Áo choàng tắm mềm mại, tiện lợi cho khách khi sử dụng phòng tắm.'),
(22, 'Toothbrush', 'Bàn chải đánh răng miễn phí cung cấp trong phòng tắm.'),
(23, 'Shampoo', 'Dầu gội đầu chất lượng cao, dùng cho khách trong phòng tắm.'),
(24, 'Conditioner', 'Dầu xả tóc để chăm sóc tóc sau khi gội.'),
(25, 'Cable TV', 'Dịch vụ truyền hình cáp với nhiều kênh quốc tế và địa phương.'),
(26, 'Desk Lamp', 'Đèn bàn với ánh sáng dịu, giúp khách làm việc dễ dàng hơn.'),
(27, 'Room Service', 'Dịch vụ phục vụ đồ ăn, đồ uống tận phòng 24/7.'),
(28, 'Water Bottle', 'Chai nước suối miễn phí cung cấp trong phòng.'),
(29, 'Umbrella', 'Ô dù để khách sử dụng trong những ngày mưa.'),
(30, 'Electric Kettle', 'Ấm siêu tốc để đun nước nóng cho khách.'),
(31, 'Extra Bed', 'Giường phụ dành cho khách thêm giường khi cần thiết.'),
(32, 'Bicycle Rental', 'Dịch vụ cho thuê xe đạp để khách khám phá khu vực xung quanh.'),
(33, 'Wake-Up Call', 'Dịch vụ gọi dậy cho khách vào giờ yêu cầu.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `code_check_in` varchar(255) DEFAULT NULL,
  `check_in_date` int(10) UNSIGNED NOT NULL,
  `check_out_date` int(10) UNSIGNED NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `tien_coc` bigint(20) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0: chưa thanh toán cọc, 1: đang thanh toán, 2: đã thanh toán cọc, 3: đã thanh toán tổng tiền đơn, 4: đang sử dụng, 5: đã hủy',
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621,
  `updated_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `CCCD_booking` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`id`, `room_id`, `user_id`, `code_check_in`, `check_in_date`, `check_out_date`, `total_price`, `tien_coc`, `status`, `created_at`, `updated_at`, `first_name`, `last_name`, `email`, `phone`, `address`, `CCCD_booking`) VALUES
(2, 20, 1, '410325', 1733234400, 1733400000, 2600000, 780000, 2, 1731139621, 1731139621, 'khoi', 'nguyen', 'khointph33170@fpt.edu.vn', '0123456789', 'HN', NULL),
(3, 1, 2, '799533', 1733061600, 1733313600, 3600000, 1080000, 2, 1731139621, 1731139621, 'Trần', 'Thị B', 'nguyenvana@example.com', '0987654321', 'Hồ Chí Minh', NULL),
(4, 1, 3, '931424', 1733580000, 1733745600, 2400000, 720000, 2, 1731139621, 1731139621, 'Lê', 'Quang C', 'lequangc@example.com', '0912345678', 'Đà Nẵng', NULL),
(5, 1, 4, '756358', 1733839200, 1735041600, 16800000, 5040000, 2, 1731139621, 1731139621, 'Phạm', 'Minh D', 'phamminhd@example.com', '0123876543', 'Hải Phòng', NULL),
(6, 1, 5, '543493', 1735740000, 1736337600, 8400000, 2520000, 2, 1731139621, 1731139621, 'Đặng', 'Thị E', 'dangthie@example.com', '0938123456', 'Cần Thơ', NULL),
(7, 1, 6, '852559', 1736604000, 1737892800, 18000000, 5400000, 2, 1731139621, 1731139621, 'Vũ', 'Hải F', 'vuhai@example.com', '0918234567', 'Nha Trang', NULL),
(8, 3, 7, '173834', 1736258400, 1737806400, 36000000, 10800000, 2, 1731139621, 1731139621, 'Ngô', 'Thanh G', 'ngothang@example.com', '0909345678', 'Quảng Ninh', NULL),
(9, 3, 8, '542975', 1734789600, 1735732800, 22000000, 6600000, 2, 1731139621, 1731139621, 'Hoàng', 'Minh H', 'hoangminhh@example.com', '0978543210', 'Nam Định', NULL),
(10, 2, 9, '627410', 1734703200, 1736078400, 19200000, 5760000, 2, 1731139621, 1731139621, 'Bùi', 'Thị I', 'buitihi@example.com', '0911122334', 'Vinh', NULL),
(11, 2, 10, '538841', 1734012000, 1734436800, 6000000, 1800000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'caoanhj@example.com', '0934222334', 'Bắc Ninh', NULL),
(12, 3, 10, '553601', 1733148000, 1734264000, 26000000, 7800000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'caoanhj@example.com', '0934222334', 'Bắc Ninh', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manage_status_rooms`
--

CREATE TABLE `manage_status_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'để truy vấn dễ hơn',
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: đã cọc, 1: sẵn sàng, 2: đang sử dụng',
  `from` int(10) UNSIGNED NOT NULL,
  `to` int(10) UNSIGNED NOT NULL COMMENT 'Lấy số 0 làm cờ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Manage status of rooms with booking states and availability.';

--
-- Đang đổ dữ liệu cho bảng `manage_status_rooms`
--

INSERT INTO `manage_status_rooms` (`id`, `booking_id`, `room_id`, `status`, `from`, `to`) VALUES
(4, NULL, 4, 1, 1733061600, 0),
(5, NULL, 5, 1, 1733061600, 0),
(6, NULL, 6, 1, 1733061600, 0),
(7, NULL, 7, 1, 1733061600, 0),
(8, NULL, 8, 1, 1733061600, 0),
(9, NULL, 9, 1, 1733061600, 0),
(10, NULL, 10, 1, 1733061600, 0),
(11, NULL, 11, 1, 1733061600, 0),
(12, NULL, 12, 1, 1733061600, 0),
(13, NULL, 13, 1, 1733061600, 0),
(14, NULL, 14, 1, 1733061600, 0),
(15, NULL, 15, 1, 1733061600, 0),
(16, NULL, 16, 1, 1733061600, 0),
(17, NULL, 17, 1, 1733061600, 0),
(18, NULL, 18, 1, 1733061600, 0),
(19, NULL, 19, 1, 1733061600, 0),
(21, 2, 20, 0, 1733234400, 1733400000),
(22, NULL, 20, 1, 1733061600, 1733227200),
(23, NULL, 20, 1, 1733407200, 0),
(24, 3, 1, 0, 1733061600, 1733313600),
(26, 4, 1, 0, 1733580000, 1733745600),
(27, NULL, 1, 1, 1733320800, 1733572800),
(29, 5, 1, 0, 1733839200, 1735041600),
(30, NULL, 1, 1, 1733752800, 1733832000),
(32, 6, 1, 0, 1735740000, 1736337600),
(33, NULL, 1, 1, 1735048800, 1735732800),
(35, 7, 1, 0, 1736604000, 1737892800),
(36, NULL, 1, 1, 1736344800, 1736596800),
(37, NULL, 1, 1, 1737900000, 0),
(38, 8, 3, 0, 1736258400, 1737806400),
(40, NULL, 3, 1, 1737813600, 0),
(41, 9, 3, 0, 1734789600, 1735732800),
(43, NULL, 3, 1, 1735740000, 1736251200),
(44, 10, 2, 0, 1734703200, 1736078400),
(46, NULL, 2, 1, 1736085600, 0),
(47, 11, 2, 0, 1734012000, 1734436800),
(48, NULL, 2, 1, 1733061600, 1734004800),
(49, NULL, 2, 1, 1734444000, 1734696000),
(50, 12, 3, 0, 1733148000, 1734264000),
(51, NULL, 3, 1, 1733061600, 1733140800),
(52, NULL, 3, 1, 1734271200, 1734782400);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2024_11_16_054436_update_image_room_nullable_in_rooms_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` int(10) UNSIGNED NOT NULL DEFAULT 1731139621 COMMENT 'ngày thanh toán',
  `total_price` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL COMMENT '0: tiền mặt, 1:chuyển khoản',
  `payment_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0: chưa thanh toán cọc, 1: đang thanh toán, 2: đã thanh toán cọc, 3: đã thanh toán tổng tiền đơn',
  `vnp_BankCode` varchar(255) DEFAULT NULL,
  `vnp_TransactionNo` text DEFAULT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `payment_date`, `total_price`, `payment_method`, `payment_status`, `vnp_BankCode`, `vnp_TransactionNo`, `updated_at`) VALUES
(1, 1, 1731139621, 780000, '1', 0, NULL, NULL, 1731139621),
(2, 2, 1731139621, 780000, '1', 2, 'NCB', '{\"vnp_Amount\":\"78000000\",\"vnp_BankTranNo\":\"VNP14676155\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_2\",\"vnp_PayDate\":\"20241116150032\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676155\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"2\",\"vnp_SecureHash\":\"3eb1aa790d9b61ad8c1b23da9d9ec83aed15ff673614cd469abef8df15c186aa4cbd24abb723b0b47330a8ac06e6d281907a3685a2adfcc97234b23e42e714a2\"}', 1731744041),
(3, 3, 1731139621, 1080000, '1', 2, 'NCB', '{\"vnp_Amount\":\"108000000\",\"vnp_BankTranNo\":\"VNP14676371\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_3\",\"vnp_PayDate\":\"20241116172457\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676371\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"3\",\"vnp_SecureHash\":\"af13718c0d7b3d9e4fc72dc69891d1a9f437e648cf693af65b2f0ef5c0fd2cf4745bf72c342aa1e9acbb21679782f149aa359ffc04783a17fd63cf5e00467ba7\"}', 1731752705),
(4, 4, 1731139621, 720000, '1', 2, 'NCB', '{\"vnp_Amount\":\"72000000\",\"vnp_BankTranNo\":\"VNP14676376\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_4\",\"vnp_PayDate\":\"20241116173029\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676376\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"4\",\"vnp_SecureHash\":\"39a693b0377f922ffabd27987a12fb1cc2b6095e4bec526148d89b0ddf933edffa8bafc13b3fa91300b185532a53082bd018882f20e33d853c49efb523816c12\"}', 1731753042),
(5, 5, 1731139621, 5040000, '1', 2, 'NCB', '{\"vnp_Amount\":\"504000000\",\"vnp_BankTranNo\":\"VNP14676381\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_5\",\"vnp_PayDate\":\"20241116173328\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676381\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"5\",\"vnp_SecureHash\":\"682788c3f296b2d871ff11af601edad2899ee45c7617bb301e37f1d27f4b5791dd61c35b0118c46bf7cd71500ab397153e1d992a83011c7d282404ec0fb0388a\"}', 1731753218),
(6, 6, 1731139621, 2520000, '1', 2, 'NCB', '{\"vnp_Amount\":\"252000000\",\"vnp_BankTranNo\":\"VNP14676385\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_6\",\"vnp_PayDate\":\"20241116173622\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676385\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"6\",\"vnp_SecureHash\":\"145914796418658817930493b430020f6ecb53869270ae6e2a19845cffdb0f0ccad3f2e251173636e9a7a9b86dfe42e6d3644a82b153df865c69408a11e7d24f\"}', 1731753391),
(7, 7, 1731139621, 5400000, '1', 2, 'NCB', '{\"vnp_Amount\":\"540000000\",\"vnp_BankTranNo\":\"VNP14676394\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_7\",\"vnp_PayDate\":\"20241116173949\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676394\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"7\",\"vnp_SecureHash\":\"375f6cdb45a7f45838e83a988fc91f58f4ffbadbe4c2aef30c13c6c5cfb6aff591e9ab55d3c19752c3dd9717168125bd21d535de04ac58a50ebb4c3d3b6ec8e8\"}', 1731753597),
(8, 8, 1731139621, 10800000, '1', 2, 'NCB', '{\"vnp_Amount\":\"1080000000\",\"vnp_BankTranNo\":\"VNP14676403\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_8\",\"vnp_PayDate\":\"20241116174601\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676403\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"8\",\"vnp_SecureHash\":\"0b8a08bde26e662fcd249be07b5722af05ffb6a7b29bf49ea3b11e4b57b4a038be58d4979ed8c3214f4021825bc396c8e037f137709ede7da9d14f9f66b31e4c\"}', 1731753970),
(9, 9, 1731139621, 6600000, '1', 2, 'NCB', '{\"vnp_Amount\":\"660000000\",\"vnp_BankTranNo\":\"VNP14676407\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_9\",\"vnp_PayDate\":\"20241116174812\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676407\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"9\",\"vnp_SecureHash\":\"61ef232a71466fea7ee936c6cde8586682fcebea6c9d40a36f919ecb41008916fd3950cc7004dbc70be2c93fe2288d93fc2ee81b5048faf2c21868508cee9f53\"}', 1731754101),
(10, 10, 1731139621, 5760000, '1', 2, 'NCB', '{\"vnp_Amount\":\"576000000\",\"vnp_BankTranNo\":\"VNP14676413\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_10\",\"vnp_PayDate\":\"20241116175241\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676413\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"10\",\"vnp_SecureHash\":\"7a3c3b5c119de4c67e9472942cd266dac3a25bd95d7c903e0f0401afc5ecca359f31fac880cc0b09f81dbcdb805be17082535c99cc45beb56c57d1358c5da2d8\"}', 1731754369),
(11, 11, 1731139621, 1800000, '1', 2, 'NCB', '{\"vnp_Amount\":\"180000000\",\"vnp_BankTranNo\":\"VNP14676419\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_11\",\"vnp_PayDate\":\"20241116175548\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676419\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"11\",\"vnp_SecureHash\":\"16f96053ad0b7f0a7036455f10a53353decded7e2c08518f7858b8f80c6cee3cb15b471a59b8201e69fe4cbab0a68398b7f9f1472d988553bd64cd4e84db098f\"}', 1731754557),
(12, 12, 1731139621, 7800000, '1', 2, 'NCB', '{\"vnp_Amount\":\"780000000\",\"vnp_BankTranNo\":\"VNP14676420\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_12\",\"vnp_PayDate\":\"20241116175713\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676420\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"12\",\"vnp_SecureHash\":\"cab4970832b5dd620e4d3794f72b8ded30fc85968d57e19ab155585ad60444ac181a7c1a7cd153a024a669dcbab685006b01e3e8356881a361663cb7ce841614\"}', 1731754644);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phiphatsinhs`
--

CREATE TABLE `phiphatsinhs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621,
  `updated_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL COMMENT 'max là 5 sao',
  `comment` text DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roomassets`
--

CREATE TABLE `roomassets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assets_type_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: đang sử dụng, 1: tạm dừng sử dụng',
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621,
  `updated_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roomassets`
--

INSERT INTO `roomassets` (`id`, `assets_type_id`, `room_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 23, 1, 0, 1733061600, 0),
(2, 8, 1, 0, 1733061600, 0),
(3, 2, 1, 0, 1733061600, 0),
(4, 17, 1, 0, 1733061600, 0),
(5, 14, 1, 0, 1733061600, 0),
(6, 18, 1, 0, 1733061600, 0),
(7, 16, 1, 0, 1733061600, 0),
(8, 24, 1, 0, 1733061600, 0),
(9, 6, 1, 0, 1733061600, 0),
(10, 22, 1, 0, 1733061600, 0),
(11, 25, 2, 0, 1733061600, 0),
(12, 28, 2, 0, 1733061600, 0),
(13, 31, 2, 0, 1733061600, 0),
(14, 5, 2, 0, 1733061600, 0),
(15, 31, 2, 0, 1733061600, 0),
(16, 7, 2, 0, 1733061600, 0),
(17, 7, 2, 0, 1733061600, 0),
(18, 13, 2, 0, 1733061600, 0),
(19, 9, 2, 0, 1733061600, 0),
(20, 8, 2, 0, 1733061600, 0),
(21, 13, 3, 0, 1733061600, 0),
(22, 7, 3, 0, 1733061600, 0),
(23, 30, 3, 0, 1733061600, 0),
(24, 28, 3, 0, 1733061600, 0),
(25, 16, 3, 0, 1733061600, 0),
(26, 28, 3, 0, 1733061600, 0),
(27, 26, 3, 0, 1733061600, 0),
(28, 14, 3, 0, 1733061600, 0),
(29, 22, 3, 0, 1733061600, 0),
(30, 2, 3, 0, 1733061600, 0),
(31, 10, 4, 0, 1733061600, 0),
(32, 12, 4, 0, 1733061600, 0),
(33, 29, 4, 0, 1733061600, 0),
(34, 10, 4, 0, 1733061600, 0),
(35, 28, 4, 0, 1733061600, 0),
(36, 9, 4, 0, 1733061600, 0),
(37, 26, 4, 0, 1733061600, 0),
(38, 4, 4, 0, 1733061600, 0),
(39, 9, 4, 0, 1733061600, 0),
(40, 30, 4, 0, 1733061600, 0),
(41, 25, 5, 0, 1733061600, 0),
(42, 2, 5, 0, 1733061600, 0),
(43, 1, 5, 0, 1733061600, 0),
(44, 33, 5, 0, 1733061600, 0),
(45, 27, 5, 0, 1733061600, 0),
(46, 3, 5, 0, 1733061600, 0),
(47, 32, 5, 0, 1733061600, 0),
(48, 19, 5, 0, 1733061600, 0),
(49, 33, 5, 0, 1733061600, 0),
(50, 6, 5, 0, 1733061600, 0),
(51, 31, 6, 0, 1733061600, 0),
(52, 6, 6, 0, 1733061600, 0),
(53, 32, 6, 0, 1733061600, 0),
(54, 12, 6, 0, 1733061600, 0),
(55, 28, 6, 0, 1733061600, 0),
(56, 4, 6, 0, 1733061600, 0),
(57, 3, 6, 0, 1733061600, 0),
(58, 2, 6, 0, 1733061600, 0),
(59, 33, 6, 0, 1733061600, 0),
(60, 28, 6, 0, 1733061600, 0),
(61, 8, 7, 0, 1733061600, 0),
(62, 21, 7, 0, 1733061600, 0),
(63, 15, 7, 0, 1733061600, 0),
(64, 11, 7, 0, 1733061600, 0),
(65, 10, 7, 0, 1733061600, 0),
(66, 17, 7, 0, 1733061600, 0),
(67, 22, 7, 0, 1733061600, 0),
(68, 25, 7, 0, 1733061600, 0),
(69, 25, 7, 0, 1733061600, 0),
(70, 19, 7, 0, 1733061600, 0),
(71, 16, 8, 0, 1733061600, 0),
(72, 25, 8, 0, 1733061600, 0),
(73, 9, 8, 0, 1733061600, 0),
(74, 1, 8, 0, 1733061600, 0),
(75, 13, 8, 0, 1733061600, 0),
(76, 29, 8, 0, 1733061600, 0),
(77, 4, 8, 0, 1733061600, 0),
(78, 33, 8, 0, 1733061600, 0),
(79, 21, 8, 0, 1733061600, 0),
(80, 5, 8, 0, 1733061600, 0),
(81, 29, 9, 0, 1733061600, 0),
(82, 31, 9, 0, 1733061600, 0),
(83, 33, 9, 0, 1733061600, 0),
(84, 6, 9, 0, 1733061600, 0),
(85, 31, 9, 0, 1733061600, 0),
(86, 3, 9, 0, 1733061600, 0),
(87, 20, 9, 0, 1733061600, 0),
(88, 24, 9, 0, 1733061600, 0),
(89, 26, 9, 0, 1733061600, 0),
(90, 26, 9, 0, 1733061600, 0),
(91, 17, 10, 0, 1733061600, 0),
(92, 8, 10, 0, 1733061600, 0),
(93, 19, 10, 0, 1733061600, 0),
(94, 5, 10, 0, 1733061600, 0),
(95, 2, 10, 0, 1733061600, 0),
(96, 28, 10, 0, 1733061600, 0),
(97, 2, 10, 0, 1733061600, 0),
(98, 25, 10, 0, 1733061600, 0),
(99, 19, 10, 0, 1733061600, 0),
(100, 21, 10, 0, 1733061600, 0),
(101, 12, 11, 0, 1733061600, 0),
(102, 32, 11, 0, 1733061600, 0),
(103, 25, 11, 0, 1733061600, 0),
(104, 26, 11, 0, 1733061600, 0),
(105, 21, 11, 0, 1733061600, 0),
(106, 30, 11, 0, 1733061600, 0),
(107, 17, 11, 0, 1733061600, 0),
(108, 27, 11, 0, 1733061600, 0),
(109, 19, 11, 0, 1733061600, 0),
(110, 14, 11, 0, 1733061600, 0),
(111, 11, 12, 0, 1733061600, 0),
(112, 13, 12, 0, 1733061600, 0),
(113, 31, 12, 0, 1733061600, 0),
(114, 16, 12, 0, 1733061600, 0),
(115, 20, 12, 0, 1733061600, 0),
(116, 18, 12, 0, 1733061600, 0),
(117, 29, 12, 0, 1733061600, 0),
(118, 25, 12, 0, 1733061600, 0),
(119, 5, 12, 0, 1733061600, 0),
(120, 14, 12, 0, 1733061600, 0),
(121, 22, 13, 0, 1733061600, 0),
(122, 3, 13, 0, 1733061600, 0),
(123, 15, 13, 0, 1733061600, 0),
(124, 33, 13, 0, 1733061600, 0),
(125, 21, 13, 0, 1733061600, 0),
(126, 3, 13, 0, 1733061600, 0),
(127, 18, 13, 0, 1733061600, 0),
(128, 15, 13, 0, 1733061600, 0),
(129, 19, 13, 0, 1733061600, 0),
(130, 15, 13, 0, 1733061600, 0),
(131, 21, 14, 0, 1733061600, 0),
(132, 27, 14, 0, 1733061600, 0),
(133, 3, 14, 0, 1733061600, 0),
(134, 2, 14, 0, 1733061600, 0),
(135, 1, 14, 0, 1733061600, 0),
(136, 31, 14, 0, 1733061600, 0),
(137, 20, 14, 0, 1733061600, 0),
(138, 8, 14, 0, 1733061600, 0),
(139, 9, 14, 0, 1733061600, 0),
(140, 21, 14, 0, 1733061600, 0),
(141, 14, 15, 0, 1733061600, 0),
(142, 4, 15, 0, 1733061600, 0),
(143, 12, 15, 0, 1733061600, 0),
(144, 15, 15, 0, 1733061600, 0),
(145, 3, 15, 0, 1733061600, 0),
(146, 6, 15, 0, 1733061600, 0),
(147, 18, 15, 0, 1733061600, 0),
(148, 6, 15, 0, 1733061600, 0),
(149, 8, 15, 0, 1733061600, 0),
(150, 20, 15, 0, 1733061600, 0),
(151, 10, 16, 0, 1733061600, 0),
(152, 24, 16, 0, 1733061600, 0),
(153, 24, 16, 0, 1733061600, 0),
(154, 15, 16, 0, 1733061600, 0),
(155, 3, 16, 0, 1733061600, 0),
(156, 1, 16, 0, 1733061600, 0),
(157, 30, 16, 0, 1733061600, 0),
(158, 13, 16, 0, 1733061600, 0),
(159, 10, 16, 0, 1733061600, 0),
(160, 10, 16, 0, 1733061600, 0),
(161, 17, 17, 0, 1733061600, 0),
(162, 24, 17, 0, 1733061600, 0),
(163, 2, 17, 0, 1733061600, 0),
(164, 4, 17, 0, 1733061600, 0),
(165, 15, 17, 0, 1733061600, 0),
(166, 27, 17, 0, 1733061600, 0),
(167, 23, 17, 0, 1733061600, 0),
(168, 2, 17, 0, 1733061600, 0),
(169, 4, 17, 0, 1733061600, 0),
(170, 15, 17, 0, 1733061600, 0),
(171, 9, 18, 0, 1733061600, 0),
(172, 11, 18, 0, 1733061600, 0),
(173, 31, 18, 0, 1733061600, 0),
(174, 19, 18, 0, 1733061600, 0),
(175, 5, 18, 0, 1733061600, 0),
(176, 30, 18, 0, 1733061600, 0),
(177, 5, 18, 0, 1733061600, 0),
(178, 32, 18, 0, 1733061600, 0),
(179, 13, 18, 0, 1733061600, 0),
(180, 1, 18, 0, 1733061600, 0),
(181, 31, 19, 0, 1733061600, 0),
(182, 21, 19, 0, 1733061600, 0),
(183, 11, 19, 0, 1733061600, 0),
(184, 25, 19, 0, 1733061600, 0),
(185, 25, 19, 0, 1733061600, 0),
(186, 16, 19, 0, 1733061600, 0),
(187, 4, 19, 0, 1733061600, 0),
(188, 4, 19, 0, 1733061600, 0),
(189, 8, 19, 0, 1733061600, 0),
(190, 30, 19, 0, 1733061600, 0),
(191, 23, 20, 0, 1733061600, 0),
(192, 27, 20, 0, 1733061600, 0),
(193, 30, 20, 0, 1733061600, 0),
(194, 3, 20, 0, 1733061600, 0),
(195, 22, 20, 0, 1733061600, 0),
(196, 5, 20, 0, 1733061600, 0),
(197, 21, 20, 0, 1733061600, 0),
(198, 26, 20, 0, 1733061600, 0),
(199, 32, 20, 0, 1733061600, 0),
(200, 18, 20, 0, 1733061600, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `image_room` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Các ảnh lưu dưới dạng json' CHECK (json_valid(`image_room`)),
  `max_people` int(10) UNSIGNED NOT NULL COMMENT 'Số người tối đa của phòng',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên phòng, dùng để hiển thị tên thay vì id phòng ở phía FE',
  `price` bigint(20) UNSIGNED NOT NULL,
  `room_area` int(10) UNSIGNED NOT NULL COMMENT 'Diện tích phòng',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: sẵn sàng, 1: đã cọc, 2: đang sử dụng, 3: hỏng. Admin sẽ có quyền tùy chỉnh'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `room_type_id`, `image_room`, `max_people`, `title`, `price`, `room_area`, `description`, `status`) VALUES
(1, 1, NULL, 2, 'Deluxe Room 101', 1200000, 25, 'Phòng Deluxe với đầy đủ tiện nghi hiện đại.', 0),
(2, 1, NULL, 2, 'Deluxe Room 102', 1200000, 25, 'Phòng Deluxe view biển đẹp.', 0),
(3, 2, NULL, 4, 'Executive Room 201', 2000000, 35, 'Phòng Executive sang trọng dành cho gia đình.', 1),
(4, 3, NULL, 6, 'Family Room 301', 2500000, 50, 'Phòng gia đình rộng rãi và tiện nghi.', 0),
(5, 4, NULL, 3, 'Presidential Suite 401', 5000000, 70, 'Phòng tổng thống cao cấp nhất khách sạn.', 2),
(6, 5, NULL, 2, 'Standard Room 501', 800000, 20, 'Phòng tiêu chuẩn giá rẻ, phù hợp với ngân sách.', 0),
(7, 6, NULL, 2, 'Luxury Room 601', 3000000, 40, 'Phòng Luxury với nội thất cao cấp.', 3),
(8, 7, NULL, 1, 'Economy Room 701', 600000, 18, 'Phòng tiết kiệm, nhỏ gọn nhưng tiện nghi.', 0),
(9, 8, NULL, 2, 'King Room 801', 1500000, 30, 'Phòng King sang trọng với giường lớn.', 0),
(10, 9, NULL, 2, 'Queen Room 901', 1400000, 28, 'Phòng Queen với thiết kế tinh tế.', 1),
(11, 1, NULL, 2, 'Deluxe Room 103', 1250000, 26, 'Phòng Deluxe với ban công nhìn ra vườn.', 0),
(12, 2, NULL, 4, 'Executive Room 202', 2100000, 37, 'Phòng Executive tiện nghi và sang trọng.', 1),
(13, 3, NULL, 5, 'Family Room 302', 2600000, 52, 'Phòng gia đình với không gian thoải mái.', 0),
(14, 4, NULL, 3, 'Presidential Suite 402', 5100000, 75, 'Phòng tổng thống với view toàn cảnh.', 2),
(15, 5, NULL, 2, 'Standard Room 502', 850000, 22, 'Phòng tiêu chuẩn, tiết kiệm và đầy đủ tiện nghi.', 0),
(16, 6, NULL, 2, 'Luxury Room 602', 3200000, 42, 'Phòng Luxury hiện đại và phong cách.', 3),
(17, 7, NULL, 1, 'Economy Room 702', 650000, 19, 'Phòng nhỏ gọn, thích hợp cho du lịch ngắn ngày.', 0),
(18, 8, NULL, 2, 'King Room 802', 1550000, 32, 'Phòng King với thiết kế thanh lịch.', 0),
(19, 9, NULL, 2, 'Queen Room 902', 1450000, 29, 'Phòng Queen với nội thất hiện đại.', 1),
(20, 10, NULL, 2, 'Studio Room 1001', 1300000, 25, 'Phòng Studio nhỏ gọn, tiện ích cho công việc.', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'Tên loại phòng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_types`
--

INSERT INTO `room_types` (`id`, `type`) VALUES
(1, 'Deluxe Room'),
(2, 'Executive Room'),
(3, 'Family Room'),
(4, 'Presidential Suite'),
(5, 'Standard Room'),
(6, 'Luxury Room'),
(7, 'Economy Room'),
(8, 'King Room'),
(9, 'Queen Room'),
(10, 'Studio Room');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `expiry_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139620,
  `updated_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139620
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cccd` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: user, 1: admin',
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621,
  `updated_at` int(10) UNSIGNED NOT NULL DEFAULT 1731139621,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `cccd`, `password`, `image`, `phone`, `address`, `role`, `created_at`, `updated_at`, `first_name`, `last_name`, `deleted_at`) VALUES
(1, 'Nguyễn Văn A', 'nguyenvana@example.com', '123456789012', '1', 'image1.jpg', '0123456789', 'HN', 0, 1731139621, 1731139621, 'khoi', 'nguyen', NULL),
(2, 'Trần Thị B', 'tranthib@example.com', '234567890123', '1', 'image2.jpg', '0987654321', 'Hồ Chí Minh', 1, 1731139621, 1731139621, 'Trần', 'Thị B', NULL),
(3, 'Lê Quang C', 'lequangc@example.com', '345678901234', '1', 'image3.jpg', '0912345678', 'Đà Nẵng', 0, 1731139621, 1731139621, 'Lê', 'Quang C', NULL),
(4, 'Phạm Minh D', 'phamminhd@example.com', '456789012345', '1', 'image4.jpg', '0123876543', 'Hải Phòng', 0, 1731139621, 1731139621, 'Phạm', 'Minh D', NULL),
(5, 'Đặng Thị E', 'dangthie@example.com', '567890123456', '1', 'image5.jpg', '0938123456', 'Cần Thơ', 1, 1731139621, 1731139621, 'Đặng', 'Thị E', NULL),
(6, 'Vũ Hải F', 'vuhai@example.com', '678901234567', '1', 'image6.jpg', '0918234567', 'Nha Trang', 0, 1731139621, 1731139621, 'Vũ', 'Hải F', NULL),
(7, 'Ngô Thanh G', 'ngothang@example.com', '789012345678', '1', 'image7.jpg', '0909345678', 'Quảng Ninh', 1, 1731139621, 1731139621, 'Ngô', 'Thanh G', NULL),
(8, 'Hoàng Minh H', 'hoangminhh@example.com', '890123456789', '1', 'image8.jpg', '0978543210', 'Nam Định', 0, 1731139621, 1731139621, 'Hoàng', 'Minh H', NULL),
(9, 'Bùi Thị I', 'buitihi@example.com', '901234567890', '1', 'image9.jpg', '0911122334', 'Vinh', 0, 1731139621, 1731139621, 'Bùi', 'Thị I', NULL),
(10, 'Cao Anh J', 'caoanhj@example.com', '012345678901', '1', 'image10.jpg', '0934222334', 'Bắc Ninh', 1, 1731139621, 1731139621, 'Cao', 'Anh J', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `assets_types`
--
ALTER TABLE `assets_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `manage_status_rooms`
--
ALTER TABLE `manage_status_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phiphatsinhs`
--
ALTER TABLE `phiphatsinhs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roomassets`
--
ALTER TABLE `roomassets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `assets_types`
--
ALTER TABLE `assets_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `manage_status_rooms`
--
ALTER TABLE `manage_status_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `phiphatsinhs`
--
ALTER TABLE `phiphatsinhs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roomassets`
--
ALTER TABLE `roomassets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;