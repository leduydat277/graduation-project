-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 20, 2024 lúc 02:38 AM
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
-- Cơ sở dữ liệu: `do_an_tot_nghiep`
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
(2, 20, 1, '410325', 1733234400, 1733400000, 2600000, 780000, 5, 1731974400, 1731139621, 'khoi', 'nguyen', 'khointph33170@fpt.edu.vn', '0123456789', 'HN', NULL),
(3, 1, 2, '799533', 1733061600, 1733313600, 3600000, 1080000, 3, 1731715200, 1731139621, 'Trần', 'Thị B', 'nguyenvana@example.com', '0987654321', 'Hồ Chí Minh', NULL),
(4, 1, 3, '931424', 1733580000, 1733745600, 2400000, 720000, 3, 1734307200, 1731139621, 'Lê', 'Quang C', 'lequangc@example.com', '0912345678', 'Đà Nẵng', NULL),
(5, 1, 4, '756358', 1733839200, 1735041600, 16800000, 5040000, 5, 1731715200, 1731139621, 'Phạm', 'Minh D', 'phamminhd@example.com', '0123876543', 'Hải Phòng', NULL),
(6, 1, 5, '543493', 1735740000, 1736337600, 8400000, 2520000, 5, 1731974400, 1731139621, 'Đặng', 'Thị E', 'dangthie@example.com', '0938123456', 'Cần Thơ', NULL),
(7, 1, 6, '852559', 1736604000, 1737892800, 18000000, 5400000, 3, 1731974400, 1731139621, 'Vũ', 'Hải F', 'vuhai@example.com', '0918234567', 'Nha Trang', NULL),
(8, 3, 7, '173834', 1736258400, 1737806400, 36000000, 10800000, 2, 1731139621, 1731139621, 'Ngô', 'Thanh G', 'ngothang@example.com', '0909345678', 'Quảng Ninh', NULL),
(9, 3, 8, '542975', 1734789600, 1735732800, 22000000, 6600000, 2, 1731139621, 1731139621, 'Hoàng', 'Minh H', 'hoangminhh@example.com', '0978543210', 'Nam Định', NULL),
(10, 2, 9, '627410', 1734703200, 1736078400, 19200000, 5760000, 2, 1731139621, 1731139621, 'Bùi', 'Thị I', 'buitihi@example.com', '0911122334', 'Vinh', NULL),
(11, 2, 10, '538841', 1734012000, 1734436800, 6000000, 1800000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'caoanhj@example.com', '0934222334', 'Bắc Ninh', NULL),
(12, 3, 10, '553601', 1733148000, 1734264000, 26000000, 7800000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'caoanhj@example.com', '0934222334', 'Bắc Ninh', NULL),
(13, 4, 10, '895814', 1733320800, 1733745600, 12500000, 3750000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'caoanhj@example.com', '0934222334', 'Bắc Ninh', NULL),
(14, 19, 10, '603058', 1733148000, 1734264000, 18850000, 5655000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'caoanhj@example.com', '0934222334', 'Bắc Ninh', NULL),
(15, 19, 10, '558560', 1735826400, 1736942400, 18850000, 5655000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'caoanhj@example.com', '0934222334', 'Bắc Ninh', NULL),
(16, 11, 10, '354641', 1735048800, 1735992000, 13750000, 4125000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'caoanhj@example.com', '0934222334', 'Bắc Ninh', NULL),
(17, 8, 10, '396817', 1735394400, 1736856000, 10200000, 3060000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'caoanhj@example.com', '0934222334', 'Bắc Ninh', NULL),
(18, 8, 9, '474683', 1733839200, 1734955200, 7800000, 2340000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'buitihi@example.com', '0911122334', 'Vinh', NULL),
(19, 17, 9, '955876', 1733061600, 1734091200, 7800000, 2340000, 2, 1731139621, 1731139621, 'Cao', 'Anh J', 'buitihi@example.com', '0911122334', 'Vinh', NULL),
(20, 14, 9, '103582', 1734444000, 1735473600, 61200000, 18360000, 2, 1731139621, 1731139621, 'Bùi', 'Thị I', 'buitihi@example.com', '0911122334', 'Vinh', NULL),
(21, 12, 9, '949833', 1736604000, 1738238400, 39900000, 11970000, 2, 1731139621, 1731139621, 'Bùi', 'Thị I', 'buitihi@example.com', '0911122334', 'Vinh', NULL),
(22, 12, 8, '907161', 1736085600, 1736424000, 8400000, 2520000, 2, 1731139621, 1731139621, 'Hoàng', 'Minh H', 'hoangminhh@example.com', '0978543210', 'Nam Định', NULL),
(23, 6, 8, '278755', 1735135200, 1736683200, 14400000, 4320000, 2, 1731139621, 1731139621, 'Hoàng', 'Minh H', 'hoangminhh@example.com', '0978543210', 'Nam Định', NULL),
(24, 12, 8, '532593', 1733234400, 1733832000, 14700000, 4410000, 2, 1731139621, 1731139621, 'Hoàng', 'Minh H', 'hoangminhh@example.com', '0978543210', 'Nam Định', NULL),
(25, 13, 8, '789499', 1736863200, 1738324800, 44200000, 13260000, 2, 1731139621, 1731139621, 'Hoàng', 'Minh H', 'hoangminhh@example.com', '0978543210', 'Nam Định', NULL),
(26, 13, 7, '722608', 1733061600, 1734264000, 36400000, 10920000, 2, 1731139621, 1731139621, 'Ngô', 'Thanh G', 'ngothang@example.com', '0909345678', 'Quảng Ninh', NULL),
(27, 16, 7, '423070', 1733493600, 1734955200, 54400000, 16320000, 2, 1731139621, 1731139621, 'Ngô', 'Thanh G', 'ngothang@example.com', '0909345678', 'Quảng Ninh', NULL),
(28, 18, 7, '691094', 1734012000, 1735473600, 26350000, 7905000, 2, 1731139621, 1731139621, 'Ngô', 'Thanh G', 'ngothang@example.com', '0909345678', 'Quảng Ninh', NULL),
(29, 5, 7, '357317', 1737554400, 1738324800, 45000000, 13500000, 2, 1731139621, 1731139621, 'Ngô', 'Thanh G', 'ngothang@example.com', '0909345678', 'Quảng Ninh', NULL),
(30, 5, 7, '825030', 1733580000, 1734609600, 60000000, 18000000, 2, 1731139621, 1731139621, 'Ngô', 'Thanh G', 'ngothang@example.com', '0909345678', 'Quảng Ninh', NULL),
(31, 9, 7, '733680', 1734271200, 1737374400, 54000000, 16200000, 2, 1731139621, 1731139621, 'Ngô', 'Thanh G', 'ngothang@example.com', '0909345678', 'Quảng Ninh', NULL);

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
(7, NULL, 7, 1, 1733061600, 0),
(10, NULL, 10, 1, 1733061600, 0),
(15, NULL, 15, 1, 1733061600, 0),
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
(52, NULL, 3, 1, 1734271200, 1734782400),
(53, 13, 4, 0, 1733320800, 1733745600),
(54, NULL, 4, 1, 1733061600, 1733313600),
(55, NULL, 4, 1, 1733752800, 0),
(56, 14, 19, 0, 1733148000, 1734264000),
(57, NULL, 19, 1, 1733061600, 1733140800),
(59, 15, 19, 0, 1735826400, 1736942400),
(60, NULL, 19, 1, 1734271200, 1735819200),
(61, NULL, 19, 1, 1736949600, 0),
(62, 16, 11, 0, 1735048800, 1735992000),
(63, NULL, 11, 1, 1733061600, 1735041600),
(64, NULL, 11, 1, 1735999200, 0),
(65, 17, 8, 0, 1735394400, 1736856000),
(67, NULL, 8, 1, 1736863200, 0),
(68, 18, 8, 0, 1733839200, 1734955200),
(69, NULL, 8, 1, 1733061600, 1733832000),
(70, NULL, 8, 1, 1734962400, 1735387200),
(71, 19, 17, 0, 1733061600, 1734091200),
(72, NULL, 17, 1, 1734098400, 0),
(73, 20, 14, 0, 1734444000, 1735473600),
(74, NULL, 14, 1, 1733061600, 1734436800),
(75, NULL, 14, 1, 1735480800, 0),
(76, 21, 12, 0, 1736604000, 1738238400),
(78, NULL, 12, 1, 1738245600, 0),
(79, 22, 12, 0, 1736085600, 1736424000),
(81, NULL, 12, 1, 1736431200, 1736596800),
(82, 23, 6, 0, 1735135200, 1736683200),
(83, NULL, 6, 1, 1733061600, 1735128000),
(84, NULL, 6, 1, 1736690400, 0),
(85, 24, 12, 0, 1733234400, 1733832000),
(86, NULL, 12, 1, 1733061600, 1733227200),
(87, NULL, 12, 1, 1733839200, 1736078400),
(88, 25, 13, 0, 1736863200, 1738324800),
(90, NULL, 13, 1, 1738332000, 0),
(91, 26, 13, 0, 1733061600, 1734264000),
(92, NULL, 13, 1, 1734271200, 1736856000),
(93, 27, 16, 0, 1733493600, 1734955200),
(94, NULL, 16, 1, 1733061600, 1733486400),
(95, NULL, 16, 1, 1734962400, 0),
(96, 28, 18, 0, 1734012000, 1735473600),
(97, NULL, 18, 1, 1733061600, 1734004800),
(98, NULL, 18, 1, 1735480800, 0),
(99, 29, 5, 0, 1737554400, 1738324800),
(101, NULL, 5, 1, 1738332000, 0),
(102, 30, 5, 0, 1733580000, 1734609600),
(103, NULL, 5, 1, 1733061600, 1733572800),
(104, NULL, 5, 1, 1734616800, 1737547200),
(105, 31, 9, 0, 1734271200, 1737374400),
(106, NULL, 9, 1, 1733061600, 1734264000),
(107, NULL, 9, 1, 1737381600, 0);

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
(2, '2024_11_16_054436_update_image_room_nullable_in_rooms_table', 1),
(3, '2024_11_19_100241_create_others_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `others`
--

CREATE TABLE `others` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` int(10) UNSIGNED DEFAULT 1732066515,
  `updated_at` int(10) UNSIGNED DEFAULT 1732066515
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `others`
--

INSERT INTO `others` (`id`, `name`, `type`, `description`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Others 1', 'Banner', 'đây là banner', 'đường dẫn ảnh banner', 1732066515, 1732066515),
(2, 'Others 2', 'Logo', 'đây là logo', 'đường dẫn ảnh logo', 1732066515, 1732066515),
(3, 'Footer', 'Footer', 'đây là Footer', 'đường dẫn ảnh Footer', 1732066515, 1732066515);

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
(12, 12, 1731139621, 7800000, '1', 2, 'NCB', '{\"vnp_Amount\":\"780000000\",\"vnp_BankTranNo\":\"VNP14676420\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_12\",\"vnp_PayDate\":\"20241116175713\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14676420\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"12\",\"vnp_SecureHash\":\"cab4970832b5dd620e4d3794f72b8ded30fc85968d57e19ab155585ad60444ac181a7c1a7cd153a024a669dcbab685006b01e3e8356881a361663cb7ce841614\"}', 1731754644),
(13, 13, 1731139621, 3750000, '1', 2, 'NCB', '{\"vnp_Amount\":\"375000000\",\"vnp_BankTranNo\":\"VNP14677842\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_13\",\"vnp_PayDate\":\"20241117163835\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677842\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"13\",\"vnp_SecureHash\":\"8da5b53740dd801ba872e929b774f918f8924860130f6a0ab8ac91684ba3d64df88985ae913048d068710bd2a8ae0f7703f1445f8fecafae55b156f5c450edd3\"}', 1731836322),
(14, 14, 1731139621, 5655000, '1', 2, 'NCB', '{\"vnp_Amount\":\"565500000\",\"vnp_BankTranNo\":\"VNP14677850\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_14\",\"vnp_PayDate\":\"20241117164214\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677850\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"14\",\"vnp_SecureHash\":\"20c13870435888a5beddf06cbd46fe0f79f4c17aebb5610dcadb963581bf65b71b906980540e111a5cb429ec748aa22ed84d3819035b5a60f5cf9b5a8083f71e\"}', 1731836542),
(15, 15, 1731139621, 5655000, '1', 2, 'NCB', '{\"vnp_Amount\":\"565500000\",\"vnp_BankTranNo\":\"VNP14677853\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_15\",\"vnp_PayDate\":\"20241117164425\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677853\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"15\",\"vnp_SecureHash\":\"88cf66f2b518f2cf926b083341c5109a4831e33a8eadf51b94f9ba514840ae0c20a5c112027c46d8d5c673238cc3e4a151d5b40e4622c5ceb26708dfecd6273b\"}', 1731836674),
(16, 16, 1731139621, 4125000, '1', 2, 'NCB', '{\"vnp_Amount\":\"412500000\",\"vnp_BankTranNo\":\"VNP14677855\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_16\",\"vnp_PayDate\":\"20241117164642\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677855\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"16\",\"vnp_SecureHash\":\"0e7392084c49f6a6d3413da1ac50a97ebf16544e28ea3485d55a73814888ffc7e965343f8e85f61568d239a9168f5594a467d06ae651e5b783b9106b2382fb84\"}', 1731836809),
(17, 17, 1731139621, 3060000, '1', 2, 'NCB', '{\"vnp_Amount\":\"306000000\",\"vnp_BankTranNo\":\"VNP14677857\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_17\",\"vnp_PayDate\":\"20241117164904\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677857\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"17\",\"vnp_SecureHash\":\"42200af928e1fe9896b8974d76d3518cb30c30f977a11ef44493eb63ae208737b610483b625a2850f44b9deff6c63ea493653dfb34dbc1456c75ea2940dfec44\"}', 1731836956),
(18, 18, 1731139621, 2340000, '1', 2, 'NCB', '{\"vnp_Amount\":\"234000000\",\"vnp_BankTranNo\":\"VNP14677860\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_18\",\"vnp_PayDate\":\"20241117165130\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677860\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"18\",\"vnp_SecureHash\":\"b91400ec3dc18b38d4c0c70cddaf0dad48120cc4d941daa42a08fde3559c257f6feaf458c6b5f34b0e1bf0c43a7dad401914ac36642facc80bc5f134d2900508\"}', 1731837098),
(19, 19, 1731139621, 2340000, '1', 2, 'NCB', '{\"vnp_Amount\":\"234000000\",\"vnp_BankTranNo\":\"VNP14677863\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_19\",\"vnp_PayDate\":\"20241117165252\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677863\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"19\",\"vnp_SecureHash\":\"02b3816a48af323342f02548de502b06f82c003cf7ff53c67849db24f5fb9fd6a3b65055c35821f7adb71d601d845c66b1a51bb618ccefe7a2f4a6883dc48306\"}', 1731837180),
(20, 20, 1731139621, 18360000, '1', 2, 'NCB', '{\"vnp_Amount\":\"1836000000\",\"vnp_BankTranNo\":\"VNP14677867\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_20\",\"vnp_PayDate\":\"20241117165505\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677867\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"20\",\"vnp_SecureHash\":\"82666697d26843e22f5d9e4d3c13214f5e9bc3576d1737ab49ec7ac8491d29d3affd41dc6b605db7e82d59d9199804c5a2070ee7aa53dd889ee4b6bc3ff84fdc\"}', 1731837312),
(21, 21, 1731139621, 11970000, '1', 2, 'NCB', '{\"vnp_Amount\":\"1197000000\",\"vnp_BankTranNo\":\"VNP14677872\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_21\",\"vnp_PayDate\":\"20241117165637\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677872\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"21\",\"vnp_SecureHash\":\"8dde9e26d40b41f102c3ce5eb4c13509e0aec4d8206ea6344963be2b3b426b1260f52304abf814a6c9f7bdbb3b1a16e376e1110696d213db1d5a476c2b1039d0\"}', 1731837405),
(22, 22, 1731139621, 2520000, '1', 2, 'NCB', '{\"vnp_Amount\":\"252000000\",\"vnp_BankTranNo\":\"VNP14677875\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_22\",\"vnp_PayDate\":\"20241117165846\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677875\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"22\",\"vnp_SecureHash\":\"ec99001e2a5e4195b3a64355b22f6347c3570588f8924deeed990212f805bfc65998c7a21756a50f15264bc8f763de8c7a1f952b0c5099da500375cfd9b34fbb\"}', 1731837533),
(23, 23, 1731139621, 4320000, '1', 2, 'NCB', '{\"vnp_Amount\":\"432000000\",\"vnp_BankTranNo\":\"VNP14677879\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_23\",\"vnp_PayDate\":\"20241117170019\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677879\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"23\",\"vnp_SecureHash\":\"005e9ab2c01c67dda11c0cb7ceb62e9a4d09af673094cb6a49e409c0736dba4e07758fad294ecf5ec80bae7e2f8e267ca842d79e7c256bc995ed25e49e253026\"}', 1731837627),
(24, 24, 1731139621, 4410000, '1', 2, 'NCB', '{\"vnp_Amount\":\"441000000\",\"vnp_BankTranNo\":\"VNP14677883\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_24\",\"vnp_PayDate\":\"20241117170143\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677883\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"24\",\"vnp_SecureHash\":\"f24f5919ff068ad0ecad541167d86065962aac414e227feb8ffc46e479e014c8668aab60a087e071ccc355a636552900e80737723a280969452b51890f527864\"}', 1731837712),
(25, 25, 1731139621, 13260000, '1', 2, 'NCB', '{\"vnp_Amount\":\"1326000000\",\"vnp_BankTranNo\":\"VNP14677886\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_25\",\"vnp_PayDate\":\"20241117170322\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677886\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"25\",\"vnp_SecureHash\":\"6124b93c081e6defa3cc499fa7e3df104dff18afb94ab2595941534fa25307a530dc46ad523fbbe916d4abc782abf168969cbd1bcb93961d0b697f9c0803b913\"}', 1731837810),
(26, 26, 1731139621, 10920000, '1', 2, 'NCB', '{\"vnp_Amount\":\"1092000000\",\"vnp_BankTranNo\":\"VNP14677889\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_26\",\"vnp_PayDate\":\"20241117170539\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677889\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"26\",\"vnp_SecureHash\":\"c626e5eba2f62131a14c9f735e6ae994fc16189c0f97039cb3a38efcf82c9dcbfac5a7ad206645fa832ca26d92f6f6a4312cc069ae6e1d5f66b4cc9c06229e3e\"}', 1731837947),
(27, 27, 1731139621, 16320000, '1', 2, 'NCB', '{\"vnp_Amount\":\"1632000000\",\"vnp_BankTranNo\":\"VNP14677892\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_27\",\"vnp_PayDate\":\"20241117170701\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677892\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"27\",\"vnp_SecureHash\":\"4ef1cbd9112e3e6d35af9b180f402c22148ec0cecd419e8a37056579712f9565cb0926056787bca3c0650a16007776bc68278d2e2e066654ff6bdc2fba4af659\"}', 1731838029),
(28, 28, 1731139621, 7905000, '1', 2, 'NCB', '{\"vnp_Amount\":\"790500000\",\"vnp_BankTranNo\":\"VNP14677893\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_28\",\"vnp_PayDate\":\"20241117170837\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677893\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"28\",\"vnp_SecureHash\":\"30fc4e7a7c78260831bfdcbfc33984fa6557faf9c281b698c12415d24d634ffd9907d95363ef7c545e8471523e2a98ea33a501093740c9e6a81e48bd20044149\"}', 1731838124),
(29, 29, 1731139621, 13500000, '1', 2, 'NCB', '{\"vnp_Amount\":\"1350000000\",\"vnp_BankTranNo\":\"VNP14677913\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_29\",\"vnp_PayDate\":\"20241117172509\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677913\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"29\",\"vnp_SecureHash\":\"4440e0beb17b726b9570a966526002123fbccf71eabe967fd4850104a1d5ebcd5ed4f1e6db2d2b192357227a58a16062953f50ef5ff2e0a52d9d417f213f0014\"}', 1731839117),
(30, 30, 1731139621, 18000000, '1', 2, 'NCB', '{\"vnp_Amount\":\"1800000000\",\"vnp_BankTranNo\":\"VNP14677917\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_30\",\"vnp_PayDate\":\"20241117172846\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677917\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"30\",\"vnp_SecureHash\":\"63a98e96f3cb668d7352b53df5b7403441b20e44f35e4ec580c572b2a2deb765ba5ab2de92b94fe30098187f187a1f48bd87374e779d80f2c548b6db25e676f7\"}', 1731839333),
(31, 31, 1731139621, 16200000, '1', 2, 'NCB', '{\"vnp_Amount\":\"1620000000\",\"vnp_BankTranNo\":\"VNP14677921\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"booking_payment_31\",\"vnp_PayDate\":\"20241117173030\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"4OPQMRL6\",\"vnp_TransactionNo\":\"14677921\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"31\",\"vnp_SecureHash\":\"279b1da08e7d2d9fb6cfe4d7ec79e4fc3203b0ed28bb56c0a8d803bab38c7addb714fac3745d54463b03caeb0620486e25bef66de9ea92b3d7b8747ef090cba7\"}', 1731839437);

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
  `image_room` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Các ảnh lưu dưới dạng json',
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
(1, 1, '[\"upload\\/rooms\\/8aD18jiTK3BjS7xtetcLtVkjELPh9RbM3YG6Iag2.webp\",\"upload\\/rooms\\/WLWDREfaHG55PZxxaDd4i9u99OIdFGJRikoVzzNE.webp\",\"upload\\/rooms\\/KJSchVYpPkLdYrrPUZ4C7PLIvdv2PZX7sQrS6gkD.webp\"]', 2, 'Deluxe Room 101', 1200000, 25, 'Phòng Deluxe với đầy đủ tiện nghi hiện đại.', 0),
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
(20, 10, '[\"upload\\/rooms\\/BXOLpaNtdYltle8rygfWh1m8PTxRzLwyzANUvwQg.webp\",\"upload\\/rooms\\/6RUmxJg1OhwmJcnNSyy87yxBcagFM83byVGFeZXO.webp\"]', 2, 'Studio Room 1001', 1300000, 25, 'Phòng Studio nhỏ gọn, tiện ích cho công việc.', 0);

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
(1, 'Nguyễn Văn A', 'nguyenvana@example.com', '123456789012', '1', 'image1.jpg', '0336107429', 'Quảng Ninh', 0, 1731139621, 1731139621, 'Linh', 'Lê', NULL),
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
-- Chỉ mục cho bảng `others`
--
ALTER TABLE `others`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `manage_status_rooms`
--
ALTER TABLE `manage_status_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `others`
--
ALTER TABLE `others`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
