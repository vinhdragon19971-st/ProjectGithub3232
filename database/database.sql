-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 30, 2021 lúc 11:03 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `enterprisewebsite`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_01_31_130351_create_tbl_coordinator_table', 1),
(4, '2021_02_19_135336_tbl_course', 2),
(5, '2021_02_20_090305_tbl_user', 3),
(8, '2021_02_23_091011_tbl_category', 4),
(9, '2021_03_23_075755_tbl_asm', 5),
(10, '2021_03_24_141937_tbl_submission', 5),
(11, '2021_03_30_154422_tbl_mark', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_asm`
--

CREATE TABLE `tbl_asm` (
  `asm_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `asm_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asm_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_asm`
--

INSERT INTO `tbl_asm` (`asm_id`, `course_id`, `asm_name`, `asm_status`, `exp`, `created_at`, `updated_at`) VALUES
(3, 25, 'CoW280321', '1', '2021-03-28 16:59:00', NULL, NULL),
(4, 35, 'CoW28032021', '1', '2021-04-30 16:59:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_des` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_des`, `category_status`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'Atumn', 'The third season of the year, when crops and fruits are gathered and leaves fall, in the northern hemisphere from September to November and in the southern hemisphere from March to May', '1', 'Winter661061502UTC.jfif', NULL, NULL),
(2, 'Winter', 'The coldest season of the year, in the northern hemisphere from December to February and in the southern hemisphere from June to August.', '1', 'Atumn46303708UTC.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_status` int(11) NOT NULL,
  `course_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `category_id`, `course_name`, `course_des`, `course_status`, `course_image`, `created_at`, `updated_at`) VALUES
(25, 1, 'Color of Atumn', 'Color of Atumn is best topic of Athumn', 1, 'CorlorOfAthumn1518788581UTC.jpg', NULL, NULL),
(35, 2, 'Color Of Winter', 'Color Of Winter', 1, 'ColorOfWinter10104934402021.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_mark`
--

CREATE TABLE `tbl_mark` (
  `mark_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_id_coor` int(11) NOT NULL,
  `mark` double(8,2) NOT NULL,
  `mark_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark_comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_submission`
--

CREATE TABLE `tbl_submission` (
  `submission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asm_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submission_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_submission`
--

INSERT INTO `tbl_submission` (`submission_id`, `user_id`, `course_id`, `course_name`, `asm_name`, `submission_file`, `image_file`, `created_at`, `updated_at`) VALUES
(22, 7, 35, 'Color Of Winter', 'CoW28032021', '2020929116716Asia/Ho_Chi_Minh.docx', 'logo-removebg-preview11891525862021.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_gender` int(11) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_email`, `user_password`, `user_fullname`, `user_phone`, `user_gender`, `user_birthday`, `user_role`, `user_image`, `created_at`, `updated_at`) VALUES
(2, 'Coordinator1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Coordinator One', '23235656598', 1, '1992-02-18', 2, 'Coordinator One1901987389UTC.png', NULL, NULL),
(3, 'Student1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Student One1', '01213156489', 0, '2000-02-19', 1, 'Student-One374064162UTC.jpg', NULL, NULL),
(4, 'Admin1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin One', '03232656562', 0, '1982-02-03', 0, 'admin.png', NULL, NULL),
(5, 'Manager1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Manager One', '03213216156', 0, '1972-02-04', 3, 'Manager One1215514209UTC.jpg', NULL, NULL),
(6, 'Guest1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Guest One', '02123154564', 1, '2001-02-04', 4, 'Guest One888711563UTC.png', NULL, NULL),
(7, 'Student2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Student Two', '03211654489', 1, '1999-02-03', 1, 'Student Two896988113UTC.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_asm`
--
ALTER TABLE `tbl_asm`
  ADD PRIMARY KEY (`asm_id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `FOREIGN` (`category_id`) USING BTREE;

--
-- Chỉ mục cho bảng `tbl_mark`
--
ALTER TABLE `tbl_mark`
  ADD PRIMARY KEY (`mark_id`);

--
-- Chỉ mục cho bảng `tbl_submission`
--
ALTER TABLE `tbl_submission`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `FOREIN` (`user_id`),
  ADD KEY `FOREIN2` (`course_id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_asm`
--
ALTER TABLE `tbl_asm`
  MODIFY `asm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `tbl_mark`
--
ALTER TABLE `tbl_mark`
  MODIFY `mark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_submission`
--
ALTER TABLE `tbl_submission`
  MODIFY `submission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
