-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 11, 2021 lúc 03:49 PM
-- Phiên bản máy phục vụ: 10.3.16-MariaDB
-- Phiên bản PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laptrinhfullstack`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Quần áo', 0, 'quan-ao', '2021-05-23 07:53:22', '2021-05-23 07:53:22', NULL),
(2, 'Giầy dép', 0, 'giay-dep', '2021-05-23 07:53:41', '2021-05-23 07:53:41', NULL),
(3, 'Giường tủ', 0, 'giuong-tu', '2021-05-23 07:54:24', '2021-05-23 07:54:24', NULL),
(4, 'Quần áo nam', 1, 'quan-ao-nam', '2021-05-23 07:55:01', '2021-05-23 07:55:01', NULL),
(5, 'Quần áo nữ', 1, 'quan-ao-nu', '2021-05-23 07:55:12', '2021-05-23 07:55:12', NULL),
(6, 'Quần áo nam mùa đông', 4, 'quan-ao-nam-mua-dong', '2021-05-23 07:55:31', '2021-06-20 02:34:22', NULL),
(7, 'Giầy dép nam', 2, 'giay-dep-nam', '2021-05-23 07:55:50', '2021-06-20 02:34:12', NULL),
(8, 'Giầy dép nữ', 2, 'giay-dep-nu', '2021-05-23 07:55:57', '2021-06-20 02:33:56', NULL),
(9, 'Giường tủ gia đình', 3, 'giuong-tu-gia-dinh', '2021-05-23 07:56:41', '2021-06-20 02:33:53', NULL),
(10, 'duy tùng', 1, 'duy-tung', '2021-06-19 20:25:01', '2021-06-20 02:33:12', '2021-06-20 02:33:12'),
(11, 'Hẻm trà chanh 123', 4, 'hem-tra-chanh-123', '2021-06-19 20:35:10', '2021-06-20 02:33:06', '2021-06-20 02:33:06'),
(12, 'trường học', 0, 'truong-hoc', '2021-08-02 20:08:45', '2021-08-02 20:08:45', NULL),
(13, 'lớp học', 12, 'lop-hoc', '2021-08-02 20:08:58', '2021-08-02 20:08:58', NULL),
(14, 'quần áo nam mùa đông dày', 6, 'quan-ao-nam-mua-dong-day', '2021-08-02 21:12:27', '2021-08-02 21:12:27', NULL),
(15, 'quần áo nam mùa đông dày ấm', 14, 'quan-ao-nam-mua-dong-day-am', '2021-08-02 21:13:14', '2021-08-02 21:13:14', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `name`, `parent_id`, `created_at`, `updated_at`, `slug`, `deleted_at`) VALUES
(1, 'Menu 1', 0, NULL, NULL, '', NULL),
(2, 'Menu 2', 0, NULL, NULL, '', NULL),
(3, 'Menu 3', 0, NULL, NULL, '', NULL),
(4, 'Menu 4', 0, NULL, NULL, '', NULL),
(5, 'Menu 1.1', 1, NULL, '2021-06-29 01:44:50', '', NULL),
(6, 'Menu 2.1.2', 2, NULL, '2021-06-29 01:43:53', 'menu-212', NULL),
(7, 'Menu 1.2', 1, NULL, '2021-06-29 01:44:59', '', NULL),
(9, 'Menu 3.1', 3, NULL, NULL, '', NULL),
(10, 'Menu 4.1', 4, NULL, NULL, '', NULL),
(11, 'Menu 1.1.1', 5, NULL, NULL, '', NULL),
(12, 'Menu 1.1.1.1', 11, '2021-06-28 23:39:56', '2021-06-29 01:44:22', '', NULL),
(13, 'Menu 1.1.2', 5, '2021-06-28 23:40:34', '2021-06-28 23:40:34', '', NULL),
(14, 'Menu 5', 0, '2021-06-29 00:08:01', '2021-06-29 00:08:01', 'menu-5', NULL),
(15, 'Menu 5.1', 14, '2021-06-29 00:08:17', '2021-06-29 01:41:02', 'menu-51', NULL),
(16, 'Menu 6', 0, '2021-06-29 00:49:57', '2021-06-29 00:49:57', 'menu-6', NULL),
(17, 'Menu 6.1', 16, '2021-06-29 00:50:14', '2021-06-29 00:50:14', 'menu-6', NULL),
(18, 'Menu 6.1.1', 17, '2021-06-29 00:50:49', '2021-06-29 00:50:49', 'menu-611', NULL),
(19, 'Menu 1.2.1', 7, '2021-06-29 00:53:44', '2021-06-29 00:53:44', 'menu-121', NULL),
(20, 'Leonard Burke', 11, '2021-06-29 01:11:41', '2021-06-29 01:38:42', 'leonard-burke', '2021-06-29 01:38:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_16_143720_create_categories_table', 1),
(5, '2021_06_20_092628_add_column_deleted_at_table_categories', 2),
(6, '2021_06_20_094043_create_menus_table', 3),
(7, '2021_06_29_065940_add_column_slug_to_menus_table', 4),
(8, '2021_06_29_083156_add_column_deleted_at_to_menus_table', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '', 'phamduytung11@gmail.com', NULL, '$2y$10$Qr9/WC5ABwLG004bXoN8sOI1oHUOz1Ju1fWIHWqWI3FmfzXAjpyKG', 'SasR2fIp8OSWqv9cVyg5pVVUHtAR3SepGMpBuz1zboCcoNtgnjVNbXZj8x4G', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
