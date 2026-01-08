-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 22, 2024 lúc 02:07 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hotel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `phone`, `email`, `password`) VALUES
(2, 'Hoàng Văn Thụ', 9613542, 'thu@gmail.com', 'thu123'),
(3, 'Nguyễn Phúc Nhật Thành', 961581328, 'nhatthanh197203@gmail.com', '$2y$10$rezCfrld86BeOPOvB79Xv.yZSBlfAHh1KdQneu.ad1EmDlghwTxk6'),
(5, 'Nguyễn Thị Như Quỳnh', 769069166, 'quynhquam031204@gmail.com', '$2y$10$i9Tqg.QYC2aJ.p.Tvofs0.WBpiI0uppgufO7Y7qAeIFwP8UkxogqK');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `password`) VALUES
(1, 'Nguyễn Thuỳ Linh', 100000000, 'TLinh@gmail.com', 'Hà Đông', 'tlinh1234'),
(2, 'Đặng Quỳnh Ngân', 200000000, 'QNgan@gmail.com', 'Văn Quán', 'Qngan1009'),
(4, 'Nguyễn Ngọc Trâm', 40000000, 'Tram@gmail.com', 'Hà Đông', 'NTram123'),
(5, 'Nguyễn Minh Anh', 50000000, 'MAnh@gmail.com', 'Hà Đông', 'MAnh123'),
(6, 'Phạm Hải Yến', 60000000, 'Yen@gmail.com', 'Hà Đông', 'HYen1712'),
(7, 'Nguyễn Thuỳ Dương', 70000000, 'TDuong@gmail.com', 'Phú La', 'TDuong1509'),
(8, 'Nguyễn Phương Anh', 80000000, 'PAnh@gmail.com', 'Phú La', 'PhAnh'),
(9, 'Phạm Thương Hoài', 90000000, 'Hoai@gmai.com', 'Phú La', 'ThuoggHoai2411'),
(10, 'Dương Quỳnh Anh', 110000000, 'DQAnh@gmail.com', 'Phú La', 'DQAnh2907'),
(11, 'Nguyễn Minh Thảo', 12000000, 'MThao@gmail.com', 'Long Biên', '$2y$10$lHt8fwFGL2Kvy/alDUWb2eghOcCc7m3LMoW5FMTWVeNBn6EJ4etti'),
(12, 'a', 961581326, 'a@gmail.com', 'Phú La', '$2y$10$c8z6GmTCE89D0WrnFFzLP.23PWMyyALFe7lvrVQJ96KJOWDrAnj8G'),
(13, 'Vũ Minh Ngọc', 13000000, 'MNgoc@gmail.com', 'La Khê', '$2y$10$XLKU4oFZ6It.uFq9Z/mjyeXZgI2LKleFzY09DaJf5yGmtxi1buhxu'),
(14, 'Bùi Thị Trang Nhung', 140000000, 'NhunNhun@gmail.com', 'Phạm Ngọc Thạch', '$2y$10$Sb4luJfhAXlc.n68QDUNhuW0tp7Wsy7zyGUgC0sy8ZxB8hcLETE/.'),
(15, 'Nguyễn Quỳnh Trang', 150000000, 'QTrang@gmail.com', 'Nam Từ Liêm', '$2y$10$gsobtGEpko.CNnNHniDNZutYgL5yolvKnsGvrllQvZQdJA.2rybgy'),
(16, 'Phạm Ngọc Oanh', 160000000, 'Oanh@gmai.com', 'Hà Đông', '123'),
(17, 'Trần Thu Huyền', 170000000, 'Huyen@gmail.com', 'Thanh Hoá', '$2y$10$IHKLyCJKY/.uZvO1YTAsheG0cuenZ6MZV9EloS4rYiqakAxYM0y7C'),
(18, 'Nguyễn Anh Sa', 18000000, 'Sa@gmail.com', 'Tam Kỳ', '$2y$10$Le3P/X74.2gumgZVwdpU4ONnaONdAWMuppcIvhLnfBMoO/h2FVd9O'),
(19, 'Hoàng Trà My', 190000000, 'TMy@gmail.com', 'Hà Nội', '$2y$10$DJoNXQpTrPWwXJUSRqUuXuv2sQccWv/SYeW/RpQTBifbz.hrYVZA.'),
(20, 'Nguyễn Thị Như Quỳnh', 769069166, 'quynhquam031204@gmail.com', 'Phú Xuyên Hà Nội', '$2y$10$jdoD8ooM5/lVm4frZIW6z.GJcyoGGWcd5koQV0bjN719adJUg2nr2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` bigint(20) DEFAULT NULL,
  `method` bigint(20) DEFAULT NULL,
  `cus_id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invoices`
--

INSERT INTO `invoices` (`id`, `status`, `method`, `cus_id`, `ad_id`) VALUES
(1, 3, 0, 1, 2),
(21, 0, 0, 12, 2),
(22, 4, 0, 19, 2),
(23, 0, 0, 12, 2),
(24, 0, 0, 12, 2),
(25, 0, 0, 12, 2),
(26, 0, 0, 12, 2),
(27, 4, 0, 12, 2),
(28, 4, 0, 18, 2),
(29, 0, 0, 18, 2),
(30, 1, 0, 18, 2),
(31, 0, 0, 12, 2),
(32, 0, 0, 12, 2),
(33, 0, 0, 12, 2),
(34, 3, 0, 17, 2),
(35, 0, 1, 12, 2),
(36, 0, 1, 12, 2),
(37, 0, 0, 12, 2),
(38, 0, 0, 12, 2),
(39, 0, 0, 12, 2),
(40, 0, 0, 12, 2),
(41, 0, 1, 12, 2),
(42, 0, 1, 12, 2),
(43, 0, 0, 12, 2),
(44, 0, 0, 12, 2),
(45, 0, 0, 12, 2),
(46, 0, 0, 12, 2),
(47, 0, 0, 12, 2),
(48, 0, 0, 12, 2),
(49, 0, 0, 12, 2),
(50, 0, 0, 12, 2),
(51, 0, 0, 12, 2),
(52, 0, 0, 12, 2),
(53, 0, 0, 12, 2),
(54, 0, 0, 20, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice_detaileds`
--

CREATE TABLE `invoice_detaileds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `time_start` bigint(20) DEFAULT NULL,
  `time_end` bigint(20) DEFAULT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invoice_detaileds`
--

INSERT INTO `invoice_detaileds` (`id`, `price`, `total`, `time_start`, `time_end`, `room_id`, `invoice_id`) VALUES
(1, 100000000, 2, 20230717123000, 20230724123000, 1, 1),
(3, 25000000, 1, 20231010000000, 20231010000000, 7, 21),
(4, 25000000, 1, 20231016000000, 20231018000000, 2, 22),
(5, 25000000, 1, 20231017000000, 20231017000000, 2, 23),
(6, 25000000, 1, 20231017164500, 20231019164500, 2, 24),
(7, 25000000, 1, 20231017171200, 20231029051400, 2, 25),
(8, 25000000, 1, 20231017171300, 20231029171300, 2, 26),
(9, 25000000, 1, 20231017171600, 20231022171600, 2, 27),
(10, 25000000, 1, 20231021085500, 20231026085500, 2, 28),
(11, 25000000, 1, 20231021090900, 20231021090900, 2, 29),
(12, 25000000, 1, 20231021091300, 20231021091300, 2, 30),
(13, 25000000, 1, 20231021092500, 20231021092500, 2, 31),
(14, 25000000, 1, 20231021095100, 20231029095100, 37, 32),
(15, 25000000, 1, 20231021103100, 20231021103100, 2, 33),
(16, 25000000, 2, 20231022120700, 20231025120700, 38, 34);

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
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `floor` bigint(20) DEFAULT NULL,
  `status` bigint(20) DEFAULT NULL,
  `roomtype_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `floor`, `status`, `roomtype_id`) VALUES
(1, '101', 1, 1, 1),
(2, 'Undefined', 1, 1, 2),
(3, '102', 1, 1, 4),
(4, '103', 1, 1, 3),
(5, '104', 1, 1, 4),
(6, '105', 1, 1, 3),
(7, '106', 1, 1, 1),
(8, '201', 2, 1, 1),
(9, '202', 2, 1, 4),
(10, '203', 2, 1, 3),
(11, '204', 2, 1, 4),
(12, '205', 2, 1, 3),
(13, '206', 2, 1, 1),
(14, '301', 3, 1, 1),
(15, '302', 3, 1, 3),
(16, '303', 3, 1, 4),
(17, '304', 3, 1, 7),
(18, '305', 3, 1, 3),
(19, '306', 3, 1, 1),
(20, '401', 4, 1, 1),
(21, '402', 4, 1, 3),
(22, '403', 4, 1, 4),
(23, '404', 4, 1, 7),
(24, '405', 4, 1, 6),
(25, '406', 4, 1, 6),
(26, '501', 5, 1, 1),
(27, '502', 5, 1, 3),
(28, '503', 5, 1, 4),
(29, '504', 5, 1, 7),
(30, '505', 5, 1, 6),
(31, '506', 5, 1, 1),
(32, '601', 6, 1, 1),
(33, '602', 6, 1, 3),
(34, '603', 6, 1, 4),
(35, '604', 6, 1, 7),
(36, '605', 6, 1, 6),
(37, '606', 6, 1, 1),
(38, '701', 7, 1, 1),
(39, '702', 7, 1, 3),
(40, '703', 7, 1, 6),
(41, '704', 7, 1, 7),
(42, '705', 7, 1, 6),
(43, '706', 7, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` bigint(20) DEFAULT NULL,
  `guest` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `price`, `guest`) VALUES
(1, 'VIP', 25000000, 4),
(2, 'Undefined', 0, 0),
(3, 'Normal', 8000000, 4),
(4, 'Budget', 5000000, 4),
(5, 'High-Class', 40000000, 4),
(6, 'Lover\'s room', 20000000, 3),
(7, 'Superior', 10000000, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` bigint(20) DEFAULT NULL,
  `describe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `price`, `describe`) VALUES
(1, 'CocaCola', '1.jpg', 20000, 'Beverage'),
(2, 'Redbull', '2.jpg', 50000, 'Energy drinks make your fun more sublime'),
(5, 'Water', '3.jpg', 20000, 'Cool water');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_invoices`
--

CREATE TABLE `service_invoices` (
  `time` datetime NOT NULL,
  `amout` int(11) NOT NULL,
  `ser_id` bigint(20) UNSIGNED NOT NULL,
  `invoicedetail_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `service_invoices`
--

INSERT INTO `service_invoices` (`time`, `amout`, `ser_id`, `invoicedetail_id`) VALUES
('2023-07-17 14:44:16', 2, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_invoies`
--

CREATE TABLE `service_invoies` (
  `time` bigint(20) NOT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `invoicedetail_id` bigint(20) DEFAULT NULL,
  `ser_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_cus_id_foreign` (`cus_id`),
  ADD KEY `invoices_ad_id_foreign` (`ad_id`);

--
-- Chỉ mục cho bảng `invoice_detaileds`
--
ALTER TABLE `invoice_detaileds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_detaileds_room_id_foreign` (`room_id`),
  ADD KEY `invoice_detaileds_invoice_id_foreign` (`invoice_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_roomtype_id_foreign` (`roomtype_id`);

--
-- Chỉ mục cho bảng `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `service_invoices`
--
ALTER TABLE `service_invoices`
  ADD KEY `service_invoices_ser_id_foreign` (`ser_id`),
  ADD KEY `service_invoices_invoicedetail_id_foreign` (`invoicedetail_id`);

--
-- Chỉ mục cho bảng `service_invoies`
--
ALTER TABLE `service_invoies`
  ADD PRIMARY KEY (`time`);

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
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `invoice_detaileds`
--
ALTER TABLE `invoice_detaileds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `service_invoies`
--
ALTER TABLE `service_invoies`
  MODIFY `time` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ad_id_foreign` FOREIGN KEY (`ad_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `invoices_cus_id_foreign` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`id`);

--
-- Các ràng buộc cho bảng `invoice_detaileds`
--
ALTER TABLE `invoice_detaileds`
  ADD CONSTRAINT `invoice_detaileds_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `invoice_detaileds_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Các ràng buộc cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_roomtype_id_foreign` FOREIGN KEY (`roomtype_id`) REFERENCES `room_types` (`id`);

--
-- Các ràng buộc cho bảng `service_invoices`
--
ALTER TABLE `service_invoices`
  ADD CONSTRAINT `service_invoices_invoicedetail_id_foreign` FOREIGN KEY (`invoicedetail_id`) REFERENCES `invoice_detaileds` (`id`),
  ADD CONSTRAINT `service_invoices_ser_id_foreign` FOREIGN KEY (`ser_id`) REFERENCES `services` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
