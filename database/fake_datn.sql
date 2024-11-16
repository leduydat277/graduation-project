-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2024 at 08:17 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fake_datn`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets_types`
--

CREATE TABLE `assets_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'loại tiện nghi',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'mô tả loại tiện ích'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets_types`
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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `code_check_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_date` int UNSIGNED NOT NULL,
  `check_out_date` int UNSIGNED NOT NULL,
  `total_price` bigint NOT NULL,
  `tien_coc` bigint DEFAULT NULL,
  `status` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: chưa thanh toán cọc, 1: đang thanh toán, 2: đã thanh toán cọc, 3: đã thanh toán tổng tiền đơn, 4: đang sử dụng, 5: đã hủy',
  `created_at` int UNSIGNED NOT NULL DEFAULT '1731139621',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '1731139621',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CCCD_booking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `room_id`, `user_id`, `code_check_in`, `check_in_date`, `check_out_date`, `total_price`, `tien_coc`, `status`, `created_at`, `updated_at`, `first_name`, `last_name`, `email`, `phone`, `address`, `CCCD_booking`) VALUES
(1, 20, 1, NULL, 1733234400, 1733400000, 2600000, 780000, 0, 1731139621, 1731139621, 'khoi', 'nguyen', 'khointph33170@fpt.edu.vn', '0123456789', 'HN', NULL),
(2, 20, 1, '410325', 1733234400, 1733400000, 2600000, 780000, 2, 1731139621, 1731139621, 'khoi', 'nguyen', 'khointph33170@fpt.edu.vn', '0123456789', 'HN', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manage_status_rooms`
--

CREATE TABLE `manage_status_rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED DEFAULT NULL COMMENT 'để truy vấn dễ hơn',
  `room_id` bigint UNSIGNED NOT NULL,
  `status` int NOT NULL COMMENT '0: đã cọc, 1: sẵn sàng, 2: đang sử dụng',
  `from` int UNSIGNED NOT NULL,
  `to` int UNSIGNED NOT NULL COMMENT 'Lấy số 0 làm cờ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Manage status of rooms with booking states and availability.';

--
-- Dumping data for table `manage_status_rooms`
--

INSERT INTO `manage_status_rooms` (`id`, `booking_id`, `room_id`, `status`, `from`, `to`) VALUES
(1, NULL, 1, 1, 1733061600, 0),
(2, NULL, 2, 1, 1733061600, 0),
(3, NULL, 3, 1, 1733061600, 0),
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
(23, NULL, 20, 1, 1733407200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2024_11_16_054436_update_image_room_nullable_in_rooms_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `payment_date` int UNSIGNED NOT NULL DEFAULT '1731139621' COMMENT 'ngày thanh toán',
  `total_price` bigint UNSIGNED DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0: tiền mặt, 1:chuyển khoản',
  `payment_status` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: chưa thanh toán cọc, 1: đang thanh toán, 2: đã thanh toán cọc, 3: đã thanh toán tổng tiền đơn',
  `vnp_BankCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vnp_TransactionNo` text COLLATE utf8mb4_unicode_ci,
  `updated_at` int UNSIGNED NOT NULL DEFAULT '1731139621'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `payment_date`, `total_price`, `payment_method`, `payment_status`, `vnp_BankCode`, `vnp_TransactionNo`, `updated_at`) VALUES
(1, 1, 1731139621, 780000, '1', 0, NULL, NULL, 1731139621),
(2, 2, 1731139621, 780000, '1', 2, 'NCB', '{\"vnp_Amount\":\"78000000\",\"vnp_BankTranNo\":\"VNP14676155\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_2\",\"vnp_PayDate\":\"20241116150032\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676155\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"2\",\"vnp_SecureHash\":\"3eb1aa790d9b61ad8c1b23da9d9ec83aed15ff673614cd469abef8df15c186aa4cbd24abb723b0b47330a8ac06e6d281907a3685a2adfcc97234b23e42e714a2\"}', 1731744041);

-- --------------------------------------------------------

--
-- Table structure for table `phiphatsinhs`
--

CREATE TABLE `phiphatsinhs` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL DEFAULT '1731139621',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '1731139621'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL COMMENT 'max là 5 sao',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` int UNSIGNED NOT NULL DEFAULT '1731139621'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roomassets`
--

CREATE TABLE `roomassets` (
  `id` bigint UNSIGNED NOT NULL,
  `assets_type_id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0: đang sử dụng, 1: tạm dừng sử dụng',
  `created_at` int UNSIGNED NOT NULL DEFAULT '1731139621',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '1731139621'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roomassets`
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
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `room_type_id` bigint UNSIGNED NOT NULL,
  `image_room` json DEFAULT NULL COMMENT 'Các ảnh lưu dưới dạng json',
  `max_people` int UNSIGNED NOT NULL COMMENT 'Số người tối đa của phòng',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên phòng, dùng để hiển thị tên thay vì id phòng ở phía FE',
  `price` bigint UNSIGNED NOT NULL,
  `room_area` int UNSIGNED NOT NULL COMMENT 'Diện tích phòng',
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0: sẵn sàng, 1: đã cọc, 2: đang sử dụng, 3: hỏng. Admin sẽ có quyền tùy chỉnh'
) ;

--
-- Dumping data for table `rooms`
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
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên loại phòng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
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
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` int UNSIGNED NOT NULL DEFAULT '1731139620',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '1731139620'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cccd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint NOT NULL DEFAULT '0' COMMENT '0: user, 1: admin',
  `created_at` int UNSIGNED NOT NULL DEFAULT '1731139621',
  `updated_at` int UNSIGNED NOT NULL DEFAULT '1731139621',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `assets_types`
--
ALTER TABLE `assets_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_status_rooms`
--
ALTER TABLE `manage_status_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phiphatsinhs`
--
ALTER TABLE `phiphatsinhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomassets`
--
ALTER TABLE `roomassets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets_types`
--
ALTER TABLE `assets_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manage_status_rooms`
--
ALTER TABLE `manage_status_rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phiphatsinhs`
--
ALTER TABLE `phiphatsinhs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roomassets`
--
ALTER TABLE `roomassets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
