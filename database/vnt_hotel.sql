-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2026 at 04:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vnt_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `booking_status` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customer_id`, `room_type_id`, `room_id`, `time_start`, `time_end`, `booking_status`, `created_at`) VALUES
(1, 12, 1, 8, '2026-02-06 19:15:00', '2026-02-08 19:15:00', 3, '2026-02-06 19:15:09'),
(2, 12, 7, 35, '2026-03-01 16:56:00', '2026-03-08 16:56:00', 3, '2026-03-01 16:56:17'),
(3, 1, 4, 5, '2026-03-01 14:10:09', '2026-03-01 14:39:32', 3, '2026-03-01 21:39:32'),
(4, 21, 3, 4, '2026-03-01 14:48:47', '2026-03-01 14:48:56', 3, '2026-03-01 21:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Thành Nhật', 'npnthanh.03@gmail.com', '0961581328', 'Tôi thấy khách sạn rất tuyệt vời', '2026-03-01 08:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_card` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `email`, `address`, `password`, `id_card`, `created_at`) VALUES
(1, 'Nguyễn Thuỳ Linh', '100000000', 'TLinh@gmail.com', 'Hà Đông', 'tlinh1234', NULL, '2026-02-06 17:00:47'),
(2, 'Đặng Quỳnh Ngân', '200000000', 'QNgan@gmail.com', 'Văn Quán', 'Qngan1009', NULL, '2026-02-06 17:00:47'),
(4, 'Nguyễn Ngọc Trâm', '40000000', 'Tram@gmail.com', 'Hà Đông', 'NTram123', NULL, '2026-02-06 17:00:47'),
(5, 'Nguyễn Minh Anh', '50000000', 'MAnh@gmail.com', 'Hà Đông', 'MAnh123', NULL, '2026-02-06 17:00:47'),
(6, 'Phạm Hải Yến', '60000000', 'Yen@gmail.com', 'Hà Đông', 'HYen1712', NULL, '2026-02-06 17:00:47'),
(7, 'Nguyễn Thuỳ Dương', '70000000', 'TDuong@gmail.com', 'Phú La', 'TDuong1509', NULL, '2026-02-06 17:00:47'),
(8, 'Nguyễn Phương Anh', '80000000', 'PAnh@gmail.com', 'Phú La', 'PhAnh', NULL, '2026-02-06 17:00:47'),
(9, 'Phạm Thương Hoài', '90000000', 'Hoai@gmai.com', 'Phú La', 'ThuoggHoai2411', NULL, '2026-02-06 17:00:47'),
(10, 'Dương Quỳnh Anh', '110000000', 'DQAnh@gmail.com', 'Phú La', 'DQAnh2907', NULL, '2026-02-06 17:00:47'),
(11, 'Nguyễn Minh Thảo', '12000000', 'MThao@gmail.com', 'Long Biên', '$2y$10$lHt8fwFGL2Kvy/alDUWb2eghOcCc7m3LMoW5FMTWVeNBn6EJ4etti', NULL, '2026-02-06 17:00:47'),
(12, 'a', '961581326', 'a@gmail.com', 'Phú La', '$2y$10$c8z6GmTCE89D0WrnFFzLP.23PWMyyALFe7lvrVQJ96KJOWDrAnj8G', NULL, '2026-02-06 17:00:47'),
(13, 'Vũ Minh Ngọc', '13000000', 'MNgoc@gmail.com', 'La Khê', '$2y$10$XLKU4oFZ6It.uFq9Z/mjyeXZgI2LKleFzY09DaJf5yGmtxi1buhxu', NULL, '2026-02-06 17:00:47'),
(14, 'Bùi Thị Trang Nhung', '140000000', 'NhunNhun@gmail.com', 'Phạm Ngọc Thạch', '$2y$10$Sb4luJfhAXlc.n68QDUNhuW0tp7Wsy7zyGUgC0sy8ZxB8hcLETE/.', NULL, '2026-02-06 17:00:47'),
(15, 'Nguyễn Quỳnh Trang', '150000000', 'QTrang@gmail.com', 'Nam Từ Liêm', '$2y$10$gsobtGEpko.CNnNHniDNZutYgL5yolvKnsGvrllQvZQdJA.2rybgy', NULL, '2026-02-06 17:00:47'),
(16, 'Phạm Ngọc Oanh', '160000000', 'Oanh@gmai.com', 'Hà Đông', '123', NULL, '2026-02-06 17:00:47'),
(17, 'Trần Thu Huyền', '170000000', 'Huyen@gmail.com', 'Thanh Hoá', '$2y$10$IHKLyCJKY/.uZvO1YTAsheG0cuenZ6MZV9EloS4rYiqakAxYM0y7C', NULL, '2026-02-06 17:00:47'),
(18, 'Nguyễn Anh Sa', '18000000', 'Sa@gmail.com', 'Tam Kỳ', '$2y$10$Le3P/X74.2gumgZVwdpU4ONnaONdAWMuppcIvhLnfBMoO/h2FVd9O', NULL, '2026-02-06 17:00:47'),
(19, 'Hoàng Trà My', '190000000', 'TMy@gmail.com', 'Hà Nội', '$2y$10$DJoNXQpTrPWwXJUSRqUuXuv2sQccWv/SYeW/RpQTBifbz.hrYVZA.', NULL, '2026-02-06 17:00:47'),
(20, 'Nguyễn Thị Như Quỳnh', '769069166', 'quynhquam031204@gmail.com', 'Phú Xuyên Hà Nội', '$2y$10$jdoD8ooM5/lVm4frZIW6z.GJcyoGGWcd5koQV0bjN719adJUg2nr2', NULL, '2026-02-06 17:00:47'),
(21, 'Khách lẻ', NULL, 'guest@vnt.local', 'Khách lẻ', '$2y$10$kle8RvZHAXuTj7Rw.lLQV.BYpk8Kwn4xdPHBjbM4T0uBZOiw4pFda', NULL, '2026-03-01 21:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Tầng 1, Tầng 2, VIP, Penthouse...',
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=active, 0=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `name`, `description`, `status`) VALUES
(1, 'Tầng 1', NULL, 1),
(2, 'Tầng 2', NULL, 1),
(3, 'Tầng 3', NULL, 1),
(4, 'Tầng 4', NULL, 1),
(5, 'Tầng 5', NULL, 1),
(6, 'Tầng 6', NULL, 1),
(7, 'Tầng 7', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=unpaid,1=paid',
  `method` tinyint(4) NOT NULL COMMENT '0=cash,1=transfer,2=card',
  `cus_id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `booking_id`, `status`, `method`, `cus_id`, `ad_id`) VALUES
(1, NULL, 0, 0, 1, 2),
(21, NULL, 0, 0, 12, 2),
(22, NULL, 0, 0, 19, 2),
(23, NULL, 0, 0, 12, 2),
(24, NULL, 0, 0, 12, 2),
(25, NULL, 0, 0, 12, 2),
(26, NULL, 0, 0, 12, 2),
(27, NULL, 0, 0, 12, 2),
(28, NULL, 0, 0, 18, 2),
(29, NULL, 0, 0, 18, 2),
(30, NULL, 1, 0, 18, 2),
(31, NULL, 0, 0, 12, 2),
(32, NULL, 0, 0, 12, 2),
(33, NULL, 0, 0, 12, 2),
(34, NULL, 0, 0, 17, 2),
(35, NULL, 0, 1, 12, 2),
(36, NULL, 0, 1, 12, 2),
(37, NULL, 0, 0, 12, 2),
(38, NULL, 0, 0, 12, 2),
(39, NULL, 0, 0, 12, 2),
(40, NULL, 0, 0, 12, 2),
(41, NULL, 0, 1, 12, 2),
(42, NULL, 0, 1, 12, 2),
(43, NULL, 0, 0, 12, 2),
(44, NULL, 0, 0, 12, 2),
(45, NULL, 0, 0, 12, 2),
(46, NULL, 0, 0, 12, 2),
(47, NULL, 0, 0, 12, 2),
(48, NULL, 0, 0, 12, 2),
(49, NULL, 0, 0, 12, 2),
(50, NULL, 0, 0, 12, 2),
(51, NULL, 0, 0, 12, 2),
(52, NULL, 0, 0, 12, 2),
(53, NULL, 0, 0, 12, 2),
(54, NULL, 0, 0, 20, 2),
(55, NULL, 0, 0, 12, 2),
(56, NULL, 0, 0, 12, 2),
(57, NULL, 0, 0, 12, 2),
(58, NULL, 0, 0, 12, 2),
(59, 1, 2, 1, 12, 3),
(60, 2, 2, 1, 12, 3),
(61, 3, 2, 1, 1, 3),
(62, 4, 2, 1, 21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` bigint(20) NOT NULL,
  `price` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_detail`
--

INSERT INTO `invoice_detail` (`id`, `description`, `quantity`, `unit_price`, `price`, `total`, `invoice_id`) VALUES
(1, '', 0, 0, 100000000, 2, 1),
(3, '', 0, 0, 25000000, 1, 21),
(4, '', 0, 0, 25000000, 1, 22),
(5, '', 0, 0, 25000000, 1, 23),
(6, '', 0, 0, 25000000, 1, 24),
(7, '', 0, 0, 25000000, 1, 25),
(8, '', 0, 0, 25000000, 1, 26),
(9, '', 0, 0, 25000000, 1, 27),
(10, '', 0, 0, 25000000, 1, 28),
(11, '', 0, 0, 25000000, 1, 29),
(12, '', 0, 0, 25000000, 1, 30),
(13, '', 0, 0, 25000000, 1, 31),
(14, '', 0, 0, 25000000, 1, 32),
(15, '', 0, 0, 25000000, 1, 33),
(16, '', 0, 0, 25000000, 2, 34),
(17, '', 0, 0, 40000000, 1, 58),
(18, 'Room charge (daily)', 2, 1500000, 1500000, 3000000, 59),
(19, 'Room charge (daily)', 7, 4000000, 4000000, 28000000, 60),
(20, 'Room charge (hourly)', 1, 100000, 100000, 100000, 61),
(21, 'Room charge (hourly)', 1, 150000, 150000, 150000, 62),
(22, 'Service: Coca', 1, 20000, 20000, 20000, 62),
(23, 'Service: Bò Húc', 1, 50000, 50000, 50000, 62),
(24, 'Service: Nước lọc', 1, 20000, 20000, 20000, 62);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_20_095736_create_customers_table', 1),
(6, '2023_09_20_095801_create_admins_table', 1),
(7, '2023_09_20_100602_create_room_types_table', 1),
(8, '2023_09_20_131331_create_services_table', 1),
(9, '2023_09_22_075729_create_rooms_table', 1),
(10, '2023_09_22_075756_create_invoices_table', 1),
(11, '2023_09_22_075831_create_invoice_detaileds_table', 1),
(12, '2023_09_22_075902_create_service_invoices_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `floor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `checkin_at` datetime DEFAULT NULL,
  `roomtype_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `floor_id`, `status`, `checkin_at`, `roomtype_id`) VALUES
(1, '101', 1, 0, NULL, 1),
(3, '102', 1, 0, NULL, 4),
(4, '103', 1, 0, NULL, 3),
(5, '104', 1, 0, NULL, 4),
(6, '105', 1, 0, NULL, 3),
(7, '106', 1, 0, NULL, 1),
(8, '201', 2, 0, NULL, 1),
(9, '202', 2, 0, NULL, 4),
(10, '203', 2, 0, NULL, 3),
(11, '204', 2, 0, NULL, 4),
(12, '205', 2, 0, NULL, 3),
(13, '206', 2, 0, NULL, 1),
(14, '301', 3, 0, NULL, 1),
(15, '302', 3, 0, NULL, 3),
(16, '303', 3, 0, NULL, 4),
(17, '304', 3, 0, NULL, 7),
(18, '305', 3, 0, NULL, 3),
(19, '306', 3, 0, NULL, 1),
(20, '401', 4, 0, NULL, 1),
(21, '402', 4, 0, NULL, 3),
(22, '403', 4, 0, NULL, 4),
(23, '404', 4, 0, NULL, 7),
(24, '405', 4, 0, NULL, 6),
(25, '406', 4, 0, NULL, 6),
(26, '501', 5, 0, NULL, 1),
(27, '502', 5, 0, NULL, 3),
(28, '503', 5, 0, NULL, 4),
(29, '504', 5, 0, NULL, 7),
(30, '505', 5, 0, NULL, 6),
(31, '506', 5, 0, NULL, 1),
(32, '601', 6, 0, NULL, 1),
(33, '602', 6, 0, NULL, 3),
(34, '603', 6, 0, NULL, 4),
(35, '604', 6, 0, NULL, 7),
(36, '605', 6, 0, NULL, 6),
(37, '606', 6, 0, NULL, 1),
(38, '701', 7, 0, NULL, 1),
(39, '702', 7, 0, NULL, 3),
(40, '703', 7, 0, NULL, 6),
(41, '704', 7, 0, NULL, 7),
(42, '705', 7, 0, NULL, 6),
(43, '706', 7, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_hour` bigint(20) NOT NULL,
  `price_overnight` bigint(20) NOT NULL,
  `price_night` bigint(20) NOT NULL,
  `max_guest` int(11) NOT NULL,
  `guest` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `name`, `price_hour`, `price_overnight`, `price_night`, `max_guest`, `guest`) VALUES
(1, 'V.I.P', 200000, 400000, 1500000, 4, 4),
(3, 'Thường', 150000, 350000, 1000000, 4, 4),
(4, 'Nhỏ', 100000, 200000, 300000, 2, 4),
(5, 'Cao Cấp', 250000, 1000000, 3000000, 4, 4),
(6, 'Tình yêu', 150000, 400000, 500000, 2, 2),
(7, 'Tổng thống', 500000, 3000000, 4000000, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` bigint(20) DEFAULT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `image`, `price`, `description`) VALUES
(1, 'Coca', '1-1772375055.png', 20000, 'Nước ngọt'),
(2, 'Bò Húc', '1-1772375089.png', 50000, 'Nước tăng lực cho mọi cuộc vui'),
(5, 'Nước lọc', '1-1772375094.png', 20000, 'Một chai nước lọc mát lạnh');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'staff',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `email`, `password`, `role`, `status`, `created_at`) VALUES
(2, 'Hoàng Văn Thụ', '09613542', 'thu@gmail.com', 'thu123', 'staff', 1, '2026-02-06 17:00:28'),
(3, 'Nguyễn Phúc Nhật Thành', '0961581328', 'nhatthanh197203@gmail.com', '$2y$10$rezCfrld86BeOPOvB79Xv.yZSBlfAHh1KdQneu.ad1EmDlghwTxk6', 'admin', 1, '2026-02-06 17:00:28'),
(5, 'Nguyễn Thị Như Quỳnh', '0769069166', 'quynhquam031204@gmail.com', '$2y$10$i9Tqg.QYC2aJ.p.Tvofs0.WBpiI0uppgufO7Y7qAeIFwP8UkxogqK', 'staff', 1, '2026-02-06 17:00:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_booking_customer` (`customer_id`),
  ADD KEY `fk_booking_room_type` (`room_type_id`),
  ADD KEY `fk_booking_room` (`room_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_cus_id_foreign` (`cus_id`),
  ADD KEY `invoices_ad_id_foreign` (`ad_id`),
  ADD KEY `fk_invoice_booking` (`booking_id`);

--
-- Indexes for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_room_roomtype` (`roomtype_id`),
  ADD KEY `fk_room_floor` (`floor_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `fk_booking_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `fk_booking_room_type` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ad_id_foreign` FOREIGN KEY (`ad_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `invoices_cus_id_foreign` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD CONSTRAINT `invoice_detaileds_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room_floor` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_room_roomtype` FOREIGN KEY (`roomtype_id`) REFERENCES `room_type` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
