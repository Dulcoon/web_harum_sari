-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2026 at 12:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(60, 2, 1, 1, '2025-01-05 13:35:52', '2025-01-05 13:35:52'),
(62, 1, 2, 1, '2025-01-08 09:21:29', '2025-01-08 09:21:29'),
(63, 1, 8, 2, '2025-01-08 10:07:07', '2025-01-08 10:07:13'),
(64, 3, 3, 1, '2025-06-21 23:56:37', '2025-06-21 23:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama`, `created_at`, `updated_at`, `thumbnail`) VALUES
(1, 'Indoor', '2024-12-22 08:12:54', '2024-12-22 08:35:36', 'categories/4AYNiWF8CbQMzPxAM0EzgCbg11yr5X59QccgPV4Z.png'),
(2, 'Outdoor', '2024-12-22 08:13:01', '2024-12-22 08:36:45', 'categories/u9nXy6iUM894YjKzCgX19dR7XG6KwBQnDSA96Sof.png'),
(3, 'Bedroom', '2024-12-22 08:41:34', '2024-12-22 08:41:34', 'I5AKnbLqTONnbeEaMT7QeCZ12xNMTlkEaPlQYsVm.png');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_11_050552_create_products_table', 1),
(5, '2024_12_12_060750_add_featured_products_to_products_table', 1),
(6, '2024_12_14_074103_delete_kategori_field', 1),
(7, '2024_12_15_155224_add_role_to_users_table', 1),
(8, '2024_12_15_190352_create_personal_access_tokens_table', 1),
(9, '2024_12_22_145315_add_kategoris_table_ulang', 1),
(10, '2024_12_22_145543_2024_12_12_063155_add_kategori_id_to_products_tableulang', 1),
(11, '2024_12_22_150211_add_thumbnail_to_kategoris_table', 1),
(12, '2024_12_24_085217_add_table_carts', 2),
(13, '2024_12_24_085631_add_table_orders', 3),
(14, '2024_12_24_085753_add_table_order_items', 4),
(15, '2024_12_26_122441_create_carts_table', 5),
(16, '2024_12_29_053822_add_stok_to_products_table', 6),
(17, '2024_12_30_080023_add_transactions_table', 7),
(18, '2024_12_30_113603_update_transactions_table_change_product_id_to_json_products', 8),
(19, '2024_12_30_113718_update_transactions_table_change_product_id_to_json_products', 9),
(20, '2025_01_03_020002_modify_status_in_transactions_table', 10),
(21, '2025_01_03_022739_add_order_items_table', 11),
(22, '2025_01_03_022812_add_orders_table', 12),
(23, '2025_01_03_022858_add_transactions_table', 13),
(26, '2025_01_04_152628_create_transactions_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(8, 'App\\Models\\User', 1, 'api_token', 'b003fbf396ba444bd71f3b2c9bcbaffa20ce2ef71cfaf8e5ceafbc447306305f', '[\"*\"]', NULL, NULL, '2024-12-22 10:15:46', '2024-12-22 10:15:46'),
(9, 'App\\Models\\User', 1, 'api_token', 'dcda34e651c575d50e39dbe7910367d781df5d45ceed3b472da1d6df2d88e6f9', '[\"*\"]', NULL, NULL, '2024-12-22 10:16:45', '2024-12-22 10:16:45'),
(10, 'App\\Models\\User', 1, 'api_token', 'd2d70c6f0e9c89793ce36fa509958c799d05c60b238d3ebf9c6dccd1e3519002', '[\"*\"]', NULL, NULL, '2024-12-22 10:31:03', '2024-12-22 10:31:03'),
(11, 'App\\Models\\User', 1, 'api_token', 'e8b250e7db1286e8c81372da645c7589295431f9a6be2324e0c66172eeb51107', '[\"*\"]', NULL, NULL, '2024-12-22 10:31:06', '2024-12-22 10:31:06'),
(12, 'App\\Models\\User', 1, 'api_token', '0e7c3f1977dffe2622bf2b23c69110f63e73218f177e934ecd9dc73f4fe3af14', '[\"*\"]', NULL, NULL, '2024-12-22 10:45:02', '2024-12-22 10:45:02'),
(13, 'App\\Models\\User', 1, 'api_token', '7ff50e1767dee92222e3164f93f8b099b9977ed3ed370190cb5b45e27541fe74', '[\"*\"]', NULL, NULL, '2024-12-22 10:51:32', '2024-12-22 10:51:32'),
(14, 'App\\Models\\User', 1, 'api_token', 'd7db240c91a0e82c7344ae023423b4c6faf6626c8ed740b2069cb7930c67cb18', '[\"*\"]', NULL, NULL, '2024-12-22 13:34:57', '2024-12-22 13:34:57'),
(15, 'App\\Models\\User', 1, 'api_token', '55803b6d8c478c742cc095ab599f71c3b9899dad78ba92aeaa24593378771e60', '[\"*\"]', NULL, NULL, '2024-12-22 13:42:26', '2024-12-22 13:42:26'),
(16, 'App\\Models\\User', 1, 'api_token', '578f75ff50c4e74833bf41889218d3d112760f314ee7d4bc331d81361d246ece', '[\"*\"]', NULL, NULL, '2024-12-22 13:42:27', '2024-12-22 13:42:27'),
(17, 'App\\Models\\User', 1, 'api_token', 'da96724a72f47b4f9c50cd8257624d7c5bfe25b26eb4dbfb073a60a2581c83e1', '[\"*\"]', NULL, NULL, '2024-12-22 13:43:49', '2024-12-22 13:43:49'),
(18, 'App\\Models\\User', 1, 'api_token', '349dd2a0a1af61a12f3472dad22eab82a9a53caa33706b6d86399582dcb2ea2c', '[\"*\"]', NULL, NULL, '2024-12-22 13:48:11', '2024-12-22 13:48:11'),
(19, 'App\\Models\\User', 1, 'api_token', '60b5462196eb13d23c4f0c02caac821df2d83aa15c94eac78b9094ffe22dbcde', '[\"*\"]', NULL, NULL, '2024-12-22 13:54:12', '2024-12-22 13:54:12'),
(20, 'App\\Models\\User', 1, 'api_token', 'e89fb76f5804e26cf3dd563760437896924cd383e945c34b68d6415e3b891039', '[\"*\"]', NULL, NULL, '2024-12-22 13:57:13', '2024-12-22 13:57:13'),
(21, 'App\\Models\\User', 1, 'api_token', '7d02865cf49c1d2c749427234eb9ba37314aa785323bc545757f355a93bd65d1', '[\"*\"]', NULL, NULL, '2024-12-23 03:55:09', '2024-12-23 03:55:09'),
(22, 'App\\Models\\User', 1, 'api_token', '0114b949128dcfa2b68e29aeaf1a88445e9c6587916e7fb092d8c3af3b9aa3fd', '[\"*\"]', NULL, NULL, '2024-12-23 03:58:45', '2024-12-23 03:58:45'),
(23, 'App\\Models\\User', 1, 'api_token', '0cbaa26f18d559334d857148a70919794ad5892e17108d761a3654fdfb3ad280', '[\"*\"]', NULL, NULL, '2024-12-23 04:03:07', '2024-12-23 04:03:07'),
(24, 'App\\Models\\User', 1, 'api_token', '72589480bf354644d97eb72a4d891fad3e0a166b07502b71fa2f3b08e4f34c6a', '[\"*\"]', NULL, NULL, '2024-12-23 04:08:44', '2024-12-23 04:08:44'),
(25, 'App\\Models\\User', 1, 'api_token', '138be24801f9376f674d9cf6a5320aa25d2d2a152211acaa8d1dd49697d45f3a', '[\"*\"]', NULL, NULL, '2024-12-23 04:11:25', '2024-12-23 04:11:25'),
(26, 'App\\Models\\User', 1, 'api_token', '214f643a026d949f0d9d5a528be35512a1890262be513386621c1187976dd140', '[\"*\"]', NULL, NULL, '2024-12-23 07:40:08', '2024-12-23 07:40:08'),
(27, 'App\\Models\\User', 1, 'api_token', '6d41f693699924c2ce13339c8fc31de6f17941cf66a09efce24e6f4ee02b72ae', '[\"*\"]', NULL, NULL, '2024-12-23 07:41:16', '2024-12-23 07:41:16'),
(28, 'App\\Models\\User', 1, 'api_token', '2f53c2ae63caea6f0ebdd607c62089a4b3f495e5a1ec14abc7ddcfdd68561cb5', '[\"*\"]', NULL, NULL, '2024-12-23 07:44:39', '2024-12-23 07:44:39'),
(29, 'App\\Models\\User', 1, 'api_token', 'e49b03f4d346b9e6dd6413629da34994eaccd915a9fdd2d72f22383239e1a317', '[\"*\"]', NULL, NULL, '2024-12-24 01:40:03', '2024-12-24 01:40:03'),
(30, 'App\\Models\\User', 1, 'api_token', 'd541db633958005a857781540307f24091d4e8d45ba5efbeeb4585b58245dad2', '[\"*\"]', NULL, NULL, '2024-12-24 01:44:18', '2024-12-24 01:44:18'),
(31, 'App\\Models\\User', 1, 'api_token', '6cd97dad1d89a238c329f85a1424b0b4ba1fb5e7fedf50756a220c9e63413066', '[\"*\"]', NULL, NULL, '2024-12-24 02:33:33', '2024-12-24 02:33:33'),
(32, 'App\\Models\\User', 1, 'api_token', '9b7e481c975a202d292563c11bd28eebfc5b5094978305036e598f7fe7cfcbd7', '[\"*\"]', NULL, NULL, '2024-12-24 02:39:59', '2024-12-24 02:39:59'),
(33, 'App\\Models\\User', 1, 'api_token', 'bc3ff872a1511c8ea3b7f1d13d8302389370d800ba72e333204a14a86cd20c05', '[\"*\"]', NULL, NULL, '2024-12-24 02:42:10', '2024-12-24 02:42:10'),
(34, 'App\\Models\\User', 1, 'api_token', '76b7d171272d7c3729e1a400676b760a28398b822cd2db7b72fed5a69eea47ef', '[\"*\"]', NULL, NULL, '2024-12-24 02:52:28', '2024-12-24 02:52:28'),
(35, 'App\\Models\\User', 1, 'api_token', '722339e4539cfbf5ea76d594d4bf9657564b555a99bc15787380b6433a634e6e', '[\"*\"]', NULL, NULL, '2024-12-28 22:35:39', '2024-12-28 22:35:39'),
(36, 'App\\Models\\User', 1, 'api_token', '1ef4ebdae450c862cb126335c222b5162fd7ecd69047ecc5261f0b450e3d4aeb', '[\"*\"]', NULL, NULL, '2024-12-29 07:38:29', '2024-12-29 07:38:29'),
(37, 'App\\Models\\User', 1, 'api_token', '4897f0d5d2befad88263606c7b59162b7dd9ce548b191507288ba5dd407ce3ff', '[\"*\"]', NULL, NULL, '2024-12-29 07:39:27', '2024-12-29 07:39:27'),
(38, 'App\\Models\\User', 1, 'api_token', '39055f661dcdaf6aa04391f03764078fa570de03cc1c4e546b2193b096b98239', '[\"*\"]', NULL, NULL, '2024-12-29 07:42:34', '2024-12-29 07:42:34'),
(39, 'App\\Models\\User', 1, 'api_token', '8decc03fd321b73f1dae396489dc14a19f8da6aa3df84b8b8bf9638573878f0d', '[\"*\"]', NULL, NULL, '2024-12-29 07:46:49', '2024-12-29 07:46:49'),
(40, 'App\\Models\\User', 1, 'api_token', '25f95ad197d69fed5fc55db89fb3c1b641d25e290529f6e125ebabb99a13b1b9', '[\"*\"]', NULL, NULL, '2024-12-29 07:52:00', '2024-12-29 07:52:00'),
(41, 'App\\Models\\User', 1, 'api_token', '12eff54644dfa92c05af17bf10c1cc7523e2e1cd7547cfa15e11f2d06a7d8169', '[\"*\"]', NULL, NULL, '2024-12-29 19:52:03', '2024-12-29 19:52:03'),
(42, 'App\\Models\\User', 1, 'api_token', '5887b96fd629fdea183b951060f430d5f40dc74ef318e8460aec0e7f5f81f933', '[\"*\"]', NULL, NULL, '2024-12-29 19:59:50', '2024-12-29 19:59:50'),
(43, 'App\\Models\\User', 1, 'api_token', '7a6bd94cc2ce136c1fc8d85c787b27b152810c1be200a8952c2d9680b4914c7e', '[\"*\"]', NULL, NULL, '2024-12-29 20:00:57', '2024-12-29 20:00:57'),
(44, 'App\\Models\\User', 3, 'api_token', '75892a6569307e2aa4d883354464984de7f9eff984586b058914ce634258f73f', '[\"*\"]', NULL, NULL, '2024-12-29 22:02:05', '2024-12-29 22:02:05'),
(45, 'App\\Models\\User', 3, 'api_token', 'be96eb9f27ff7d64feadd02a72eec699c0f6581e8676da716613a95fd8cf2334', '[\"*\"]', NULL, NULL, '2024-12-29 22:03:47', '2024-12-29 22:03:47'),
(46, 'App\\Models\\User', 3, 'api_token', '4dcd39c14003e236dd9a6676d30fdfe6f8a60a1e57592babca1793d3ae85d3e2', '[\"*\"]', NULL, NULL, '2024-12-29 22:04:27', '2024-12-29 22:04:27'),
(47, 'App\\Models\\User', 1, 'api_token', 'b884d4a0245448a696b196d3bbb171ef4dbba38c38f102357517d13e48a3a87b', '[\"*\"]', NULL, NULL, '2024-12-29 22:06:22', '2024-12-29 22:06:22'),
(48, 'App\\Models\\User', 1, 'api_token', '63c529f83186d3d542d397eac00e3ebd9275e628d44d683a57cb945c62bb330d', '[\"*\"]', NULL, NULL, '2024-12-29 22:07:28', '2024-12-29 22:07:28'),
(49, 'App\\Models\\User', 1, 'api_token', '6920ae55aa56011d1fe07b5196a35a2fbd65a00eea68098fe9b9f52c9942f57c', '[\"*\"]', NULL, NULL, '2024-12-29 22:08:25', '2024-12-29 22:08:25'),
(50, 'App\\Models\\User', 1, 'api_token', '6e5bd46128da3774bc0709037e6be09f12f6f6f0ffb3f741d6d1cd7a76290772', '[\"*\"]', NULL, NULL, '2024-12-29 22:11:16', '2024-12-29 22:11:16'),
(51, 'App\\Models\\User', 1, 'api_token', '08fa0022c0dc6bc7d2b4dbb4daab03070572e01db22141e115637bc3062cd40a', '[\"*\"]', NULL, NULL, '2024-12-29 22:12:21', '2024-12-29 22:12:21'),
(52, 'App\\Models\\User', 1, 'api_token', '8f76f9d4142d5dcaa0b3c158e66fb9d2b1ad3c1572e221eea428180b27bfaa12', '[\"*\"]', NULL, NULL, '2024-12-29 22:14:19', '2024-12-29 22:14:19'),
(53, 'App\\Models\\User', 1, 'api_token', 'b718f1ef542406b59f58e24df89f1fcf2af8c66d3dab5c0e51ce30e8fd293eba', '[\"*\"]', NULL, NULL, '2024-12-29 22:28:34', '2024-12-29 22:28:34'),
(54, 'App\\Models\\User', 4, 'api_token', '45045cbe66e43f35e587104dea88772b88d2654d023cfc402ef79c5a857166ca', '[\"*\"]', NULL, NULL, '2024-12-29 22:31:39', '2024-12-29 22:31:39'),
(55, 'App\\Models\\User', 4, 'api_token', '643fd345e013264d4ccda01b0b7f4f339ecf942579aca1e0dad1b41c39939bad', '[\"*\"]', NULL, NULL, '2024-12-29 22:31:52', '2024-12-29 22:31:52'),
(56, 'App\\Models\\User', 4, 'api_token', 'b9abfb65911d220d90ae7606495b319176ed6092baf0f334138341925eef80c4', '[\"*\"]', NULL, NULL, '2024-12-29 22:32:12', '2024-12-29 22:32:12'),
(57, 'App\\Models\\User', 1, 'api_token', '7b4c7fa71e825e35e2c693eead1be4d0f70b251dcf2a04f1d01f85e481cb4231', '[\"*\"]', NULL, NULL, '2024-12-30 04:48:06', '2024-12-30 04:48:06'),
(58, 'App\\Models\\User', 1, 'api_token', '7212e129bb3e12f1383a40cc53501a8d89674d40526f3ae19daaddd227267479', '[\"*\"]', NULL, NULL, '2024-12-30 04:58:06', '2024-12-30 04:58:06'),
(59, 'App\\Models\\User', 1, 'api_token', 'eeb3f00673c67c09f1a4f2a79bb702ada12777c6d36193b18dc980e3e9f032e8', '[\"*\"]', NULL, NULL, '2024-12-30 04:58:18', '2024-12-30 04:58:18'),
(60, 'App\\Models\\User', 5, 'api_token', 'f76aac20a1d159ead3cb7da43816dee4717b5ea1dde8b074ad036501fb937f99', '[\"*\"]', NULL, NULL, '2024-12-30 05:28:05', '2024-12-30 05:28:05'),
(61, 'App\\Models\\User', 5, 'api_token', '76e1e0866febd938eb61603aa021406b55a30c37a2b7bf516f30cd2f9f78ec9a', '[\"*\"]', NULL, NULL, '2024-12-30 05:28:26', '2024-12-30 05:28:26'),
(62, 'App\\Models\\User', 5, 'api_token', '5a3f926230bd352be05e683441c5538c87fffcf0125546d3da6b86730365bf3a', '[\"*\"]', NULL, NULL, '2024-12-30 05:28:49', '2024-12-30 05:28:49'),
(63, 'App\\Models\\User', 1, 'api_token', 'c59a7da2bb10e21333ea5e4050d48ad47c97e566430377d6cf3efe74585e4388', '[\"*\"]', NULL, NULL, '2024-12-30 05:32:26', '2024-12-30 05:32:26'),
(64, 'App\\Models\\User', 6, 'api_token', 'ff773d7a07ccbab4c039f7175c34f6310d6e549b8e3302da02a14202e2ecf7be', '[\"*\"]', NULL, NULL, '2024-12-30 05:37:46', '2024-12-30 05:37:46'),
(65, 'App\\Models\\User', 6, 'api_token', 'c9ed882bb159cc8df30bc78501008682ad8c0fd4313a09017abc4373cfec4fd5', '[\"*\"]', NULL, NULL, '2024-12-30 05:37:55', '2024-12-30 05:37:55'),
(66, 'App\\Models\\User', 1, 'api_token', '0ced268bade8a3d222c6cafeded4fae26f0a00eaa67a646b5d684bc093645777', '[\"*\"]', NULL, NULL, '2024-12-30 05:38:46', '2024-12-30 05:38:46'),
(67, 'App\\Models\\User', 3, 'api_token', '1a5bcf1e2fd25f55d2a1bac7c324d0809922a338cc85af9796fdda91bea12c1a', '[\"*\"]', NULL, NULL, '2024-12-30 05:42:43', '2024-12-30 05:42:43'),
(68, 'App\\Models\\User', 1, 'api_token', '8098cc2e8b97f8a7a4e598865076bfd4fcb985c1ad15205ab95761a4558b872f', '[\"*\"]', NULL, NULL, '2024-12-30 05:51:49', '2024-12-30 05:51:49'),
(69, 'App\\Models\\User', 3, 'api_token', '43b5fb1fbb555386d230c1d2568954c195e08db9a7ac7bb9cb84435c5b8b7e13', '[\"*\"]', NULL, NULL, '2024-12-30 20:49:53', '2024-12-30 20:49:53'),
(70, 'App\\Models\\User', 3, 'api_token', 'efe96ea670ef7ea1ab500a24dd803eeb9620d18737af93112bcfbff5783386e3', '[\"*\"]', NULL, NULL, '2024-12-30 20:51:44', '2024-12-30 20:51:44'),
(71, 'App\\Models\\User', 1, 'api_token', 'bef3c95e3681e2997a944b02df787734b4bb40b753fee3692b4d53c0ad35f505', '[\"*\"]', NULL, NULL, '2024-12-30 20:56:53', '2024-12-30 20:56:53'),
(72, 'App\\Models\\User', 7, 'api_token', '468cfc6885221970f69b7a8d8a2a4a035524a689989d7980aa0c7cf305135ed0', '[\"*\"]', NULL, NULL, '2024-12-30 20:57:32', '2024-12-30 20:57:32'),
(73, 'App\\Models\\User', 7, 'api_token', 'dbf518d972b476f6d38bfee9556870b50e6212dea7a4e5e18f3ee289e5e135a3', '[\"*\"]', NULL, NULL, '2024-12-30 20:57:45', '2024-12-30 20:57:45'),
(74, 'App\\Models\\User', 1, 'api_token', 'a964c2221e7ca945eed7d09107ed67871bff9b3529d87f3f08ec23f19994ee3f', '[\"*\"]', NULL, NULL, '2024-12-30 21:17:06', '2024-12-30 21:17:06'),
(75, 'App\\Models\\User', 1, 'api_token', '9d94f67452beae4d7958ecc66be8c539ee5daab5a208cf466e20ab425fa71120', '[\"*\"]', NULL, NULL, '2024-12-30 21:18:45', '2024-12-30 21:18:45'),
(76, 'App\\Models\\User', 1, 'api_token', '0cb3be72b45369e53d3a54d98fd8c306907b6b046843f5ae4e19a343aa3f1a62', '[\"*\"]', NULL, NULL, '2024-12-30 21:55:16', '2024-12-30 21:55:16'),
(77, 'App\\Models\\User', 1, 'api_token', '7ba42b035079fe628b6a2b2e50bee05888eaff5463f9d9f0b063558060f25b9a', '[\"*\"]', NULL, NULL, '2024-12-30 22:03:30', '2024-12-30 22:03:30'),
(78, 'App\\Models\\User', 1, 'api_token', '6b39687d7f7f635d3630a5ab22be28e9351dec4a5c54a1410c2f68410a154297', '[\"*\"]', NULL, NULL, '2024-12-30 22:04:32', '2024-12-30 22:04:32'),
(79, 'App\\Models\\User', 3, 'api_token', '560dc791c996635384d8efc7713895ba2ad125ec9058d12caf06d9028488c3dc', '[\"*\"]', NULL, NULL, '2024-12-31 01:27:35', '2024-12-31 01:27:35'),
(80, 'App\\Models\\User', 1, 'api_token', '6625a70af760f3ff1e8744c5d5c7e98c75e8bf4ed8104bb3d7008f23280af6e8', '[\"*\"]', NULL, NULL, '2024-12-31 01:35:09', '2024-12-31 01:35:09'),
(81, 'App\\Models\\User', 2, 'api_token', '93c3c90c56ba4428e45a08684dd1e8b4c8ec45efb796b9528eb3f4de81cd0a76', '[\"*\"]', NULL, NULL, '2024-12-31 01:37:34', '2024-12-31 01:37:34'),
(82, 'App\\Models\\User', 2, 'api_token', '0bb6b586762d76420edc6d48740fa699db021f5ec1d11acacc1d913f7a4412fd', '[\"*\"]', NULL, NULL, '2024-12-31 01:56:30', '2024-12-31 01:56:30'),
(83, 'App\\Models\\User', 2, 'api_token', '8df3b19d2906790783afb0cecfad88c13249d92eb17b9cca0cae3b82dec4318e', '[\"*\"]', NULL, NULL, '2024-12-31 02:11:52', '2024-12-31 02:11:52'),
(84, 'App\\Models\\User', 1, 'api_token', '318cae50b14e99b01e139e3ecc6a83cbed7b1d6bcc3f7746ae1b9daa728fec17', '[\"*\"]', NULL, NULL, '2025-01-01 00:53:12', '2025-01-01 00:53:12'),
(85, 'App\\Models\\User', 1, 'api_token', 'c9e49f868d4b3a9b03bb0d4f066957dcff55211d8a024a0ba2210c20604b39d4', '[\"*\"]', NULL, NULL, '2025-01-01 12:37:41', '2025-01-01 12:37:41'),
(86, 'App\\Models\\User', 1, 'api_token', 'd0278a42ea6bcae1700498f6a143adf26e9830ec198fa669ec4df0cf03ffa56c', '[\"*\"]', NULL, NULL, '2025-01-01 13:10:18', '2025-01-01 13:10:18'),
(87, 'App\\Models\\User', 1, 'api_token', '2db52993c7ca0d32597cf8c1a621c833e3c87300302fcee540160a42cbd62b9a', '[\"*\"]', NULL, NULL, '2025-01-01 13:18:53', '2025-01-01 13:18:53'),
(88, 'App\\Models\\User', 1, 'api_token', 'a5052eb927bd042f334b8b5db468dae3d81daa19f249b6af0a37231c4391d907', '[\"*\"]', NULL, NULL, '2025-01-02 01:28:18', '2025-01-02 01:28:18'),
(89, 'App\\Models\\User', 1, 'api_token', '1196cbdec99934eba5606eec467c5ded40020f58f026f7abed56583b015b2dd3', '[\"*\"]', NULL, NULL, '2025-01-02 03:28:48', '2025-01-02 03:28:48'),
(90, 'App\\Models\\User', 1, 'api_token', 'ee6cb02a0d92755a5561079c4c6a327d7c85135f8fbe8c1a13918c34f5921d63', '[\"*\"]', NULL, NULL, '2025-01-02 04:14:06', '2025-01-02 04:14:06'),
(91, 'App\\Models\\User', 1, 'api_token', 'b6afbd0830de4022948448bd3bff654d93724ef06358a0f39e47383c94f047f2', '[\"*\"]', NULL, NULL, '2025-01-02 04:15:07', '2025-01-02 04:15:07'),
(92, 'App\\Models\\User', 1, 'api_token', '24a0bc297847da33c6c522dc65226efc5e04d08f8977a574fd84bae946235eb0', '[\"*\"]', NULL, NULL, '2025-01-02 04:17:07', '2025-01-02 04:17:07'),
(93, 'App\\Models\\User', 1, 'api_token', '4e7ed996a0e0660bb8cd1f139100cbd50967e61a619c70a4fe44c039c36cd533', '[\"*\"]', NULL, NULL, '2025-01-02 04:19:33', '2025-01-02 04:19:33'),
(94, 'App\\Models\\User', 1, 'api_token', '0ce2772dfc4392fe3826ed52765bec9c3636c28211cdb5be92aeb80e917c3b96', '[\"*\"]', NULL, NULL, '2025-01-02 04:21:07', '2025-01-02 04:21:07'),
(95, 'App\\Models\\User', 1, 'api_token', 'de3a1ba021606ff6855e0439019e679d50d4462e118a26443c0d6c48d1c8d91b', '[\"*\"]', NULL, NULL, '2025-01-02 04:26:53', '2025-01-02 04:26:53'),
(96, 'App\\Models\\User', 1, 'api_token', '90570693692fd6107c8180f17624bf89f206c35486808f34b18b9ea7f593efd9', '[\"*\"]', NULL, NULL, '2025-01-02 04:28:29', '2025-01-02 04:28:29'),
(97, 'App\\Models\\User', 1, 'api_token', '8d39c8ceefb10882f7b39ccba8c7dc6843f0bc5f3413f1befe628d889e626371', '[\"*\"]', NULL, NULL, '2025-01-02 04:30:09', '2025-01-02 04:30:09'),
(98, 'App\\Models\\User', 1, 'api_token', '1b80b28d502cfd983ad6dd37c397ef06a6b64d5039a23702e1b1d175058a1d8b', '[\"*\"]', NULL, NULL, '2025-01-02 04:30:17', '2025-01-02 04:30:17'),
(99, 'App\\Models\\User', 1, 'api_token', 'b8ccd9fbd99631d3be63aeb71f9ae66e9dad9200dd084caf92e77a2f9f1cb765', '[\"*\"]', NULL, NULL, '2025-01-02 04:30:40', '2025-01-02 04:30:40'),
(100, 'App\\Models\\User', 1, 'api_token', '4fd4b41bccda238e4388d1c23e95d1b42a75b69eb0501ec9417927997ccea971', '[\"*\"]', NULL, NULL, '2025-01-02 04:31:09', '2025-01-02 04:31:09'),
(101, 'App\\Models\\User', 1, 'api_token', '6680d20310ddf5e912754292001a9daa39ab2088c1fb393612f39649f045279c', '[\"*\"]', NULL, NULL, '2025-01-02 04:32:54', '2025-01-02 04:32:54'),
(102, 'App\\Models\\User', 1, 'api_token', '735921c81fc312b212770df6fe0ddaf4f90c3df0dcf1cca0c18565a451ba34d7', '[\"*\"]', NULL, NULL, '2025-01-02 04:33:20', '2025-01-02 04:33:20'),
(103, 'App\\Models\\User', 1, 'api_token', 'b58cb1a1e0174bf13b1ab0e37bfe536aa4226f88324c0cc2eee1505629cefe88', '[\"*\"]', NULL, NULL, '2025-01-02 04:33:49', '2025-01-02 04:33:49'),
(104, 'App\\Models\\User', 1, 'api_token', '4b90252a880b5e03b5d67659a9d23a7f7389c723632c92d10ed1d6b95dbc6fb9', '[\"*\"]', NULL, NULL, '2025-01-02 07:38:06', '2025-01-02 07:38:06'),
(105, 'App\\Models\\User', 1, 'api_token', '5519890bb9d32e85c34e06b2b1f54236b816b68d24847885dde0f7354de824fc', '[\"*\"]', NULL, NULL, '2025-01-02 08:10:40', '2025-01-02 08:10:40'),
(106, 'App\\Models\\User', 1, 'api_token', '578377080fef02798c4688d0ae7d79cf884f6700629e2c644120bde795e7c22c', '[\"*\"]', NULL, NULL, '2025-01-02 10:18:45', '2025-01-02 10:18:45'),
(107, 'App\\Models\\User', 1, 'api_token', 'a622096bc5581b4bcb225c12cbf37c449b12c495582c14f79cece103ed8f0635', '[\"*\"]', NULL, NULL, '2025-01-02 10:39:26', '2025-01-02 10:39:26'),
(108, 'App\\Models\\User', 1, 'api_token', 'c4451e754abb90ace8866d11e4d7429da71b33fa5eaa807c49af292c10024340', '[\"*\"]', NULL, NULL, '2025-01-02 10:41:51', '2025-01-02 10:41:51'),
(109, 'App\\Models\\User', 1, 'api_token', '840e8a96e2661a70798f2402235a8d7df936b6998c35d038e5c0bbf533bea4f3', '[\"*\"]', NULL, NULL, '2025-01-02 10:43:06', '2025-01-02 10:43:06'),
(110, 'App\\Models\\User', 1, 'api_token', '2beca464589a2e996a08f4a820ba2ecf5d11eea016a3006aa1af1a9807ee052c', '[\"*\"]', NULL, NULL, '2025-01-02 10:45:33', '2025-01-02 10:45:33'),
(111, 'App\\Models\\User', 1, 'api_token', '62cf779d3afc46830dfa1cf632ee759e020cea7074f5e01855915cc79d435da6', '[\"*\"]', NULL, NULL, '2025-01-02 10:50:59', '2025-01-02 10:50:59'),
(112, 'App\\Models\\User', 1, 'api_token', 'cab12ae0bae273d26ba0b94a6e8361920c36e57ab0dbdbbd620eb0428970e98d', '[\"*\"]', NULL, NULL, '2025-01-02 10:52:22', '2025-01-02 10:52:22'),
(113, 'App\\Models\\User', 1, 'api_token', '19dd08c9dabf234b72f6d7233c68ba50cc1b02bc8da95df88627f9b9a5372f2c', '[\"*\"]', NULL, NULL, '2025-01-02 10:57:26', '2025-01-02 10:57:26'),
(114, 'App\\Models\\User', 1, 'api_token', '3d1795892c55d4ccd2ccf8f3dd9c89aeeb995a243df8c9197e0b5b7f739e8932', '[\"*\"]', NULL, NULL, '2025-01-02 11:08:17', '2025-01-02 11:08:17'),
(115, 'App\\Models\\User', 1, 'api_token', '75ac8934ac6f5a85d35af362009fb97df71f85896c9f72db042a0c8ea16c10d2', '[\"*\"]', NULL, NULL, '2025-01-02 11:18:40', '2025-01-02 11:18:40'),
(116, 'App\\Models\\User', 1, 'api_token', '7278f5132cae0dff7dfc3da18cf6599a3f1abe61cd635227d64cdf19c7764fcf', '[\"*\"]', NULL, NULL, '2025-01-02 11:42:19', '2025-01-02 11:42:19'),
(117, 'App\\Models\\User', 1, 'api_token', '537723c68d50815a0b01fc5be77503884eb0d4716ac780986a4c99652f96893d', '[\"*\"]', NULL, NULL, '2025-01-02 11:47:19', '2025-01-02 11:47:19'),
(118, 'App\\Models\\User', 3, 'api_token', '5195b18c337555e4ab05f9b5b6230f34e595a8e3f8ed4bbe119c5509d7c81b1c', '[\"*\"]', NULL, NULL, '2025-01-02 11:49:29', '2025-01-02 11:49:29'),
(119, 'App\\Models\\User', 2, 'api_token', '0c67d5c8f80eb9a7c80c51f18e470e745e59469d1631481027b4e204e837c662', '[\"*\"]', NULL, NULL, '2025-01-02 11:50:00', '2025-01-02 11:50:00'),
(120, 'App\\Models\\User', 3, 'api_token', '0c569cd176576ce9d7f0ef9c2d094a2e3ed1cda98c0bd5e641116e837fc6b17d', '[\"*\"]', NULL, NULL, '2025-01-02 11:55:10', '2025-01-02 11:55:10'),
(121, 'App\\Models\\User', 3, 'api_token', '51cf56c18e2678281a4749f672a87be48613495793172b633d3789bad26d50c5', '[\"*\"]', NULL, NULL, '2025-01-02 12:07:29', '2025-01-02 12:07:29'),
(122, 'App\\Models\\User', 1, 'api_token', '961febaea8595168a25138ef9c93d262020e5fa5a3d9f87c2334efb74a26d73e', '[\"*\"]', NULL, NULL, '2025-01-02 14:26:24', '2025-01-02 14:26:24'),
(123, 'App\\Models\\User', 1, 'api_token', '283c97181aea3ac6240fde0a5c9b18a3e67b4cdd908d3f9a659589fbdf49856b', '[\"*\"]', NULL, NULL, '2025-01-02 14:43:17', '2025-01-02 14:43:17'),
(124, 'App\\Models\\User', 1, 'api_token', 'ab7d034e0b7b088247149e6fad716674327def95b9230d2f41ba2e863a3b9fcb', '[\"*\"]', NULL, NULL, '2025-01-02 14:53:39', '2025-01-02 14:53:39'),
(125, 'App\\Models\\User', 1, 'api_token', 'af10373812ac06d6932c6d876f4d21880dbe742c219cbb3d118854afb54c1fda', '[\"*\"]', NULL, NULL, '2025-01-02 14:59:10', '2025-01-02 14:59:10'),
(126, 'App\\Models\\User', 1, 'api_token', '5d0783ccd232295ab070c2a663ae819d8ae4542f538ab9075acaa2ad5d86fdd5', '[\"*\"]', NULL, NULL, '2025-01-02 15:02:27', '2025-01-02 15:02:27'),
(127, 'App\\Models\\User', 1, 'api_token', 'c487daa9943c54e961b8687ca9a6ff3e93a0410adbd900b7fedb721545b0bf0d', '[\"*\"]', NULL, NULL, '2025-01-02 15:06:33', '2025-01-02 15:06:33'),
(128, 'App\\Models\\User', 3, 'api_token', 'fa8ac6db740e1b5f6c4f280c289b9521f7aa74bba9d7e850e7fe9c9e3f335075', '[\"*\"]', NULL, NULL, '2025-01-02 15:10:38', '2025-01-02 15:10:38'),
(129, 'App\\Models\\User', 3, 'api_token', '3fccd63e4b337ed8e5b9e48180459fa2c89bedfefd0cd5e648ab07ddbd326b6f', '[\"*\"]', '2025-01-05 01:59:31', NULL, '2025-01-02 15:12:09', '2025-01-05 01:59:31'),
(130, 'App\\Models\\User', 3, 'api_token', 'd317cffedd06f27ccb932f9c645ab687d398f914af213aad721b9369f8abe093', '[\"*\"]', '2025-01-02 15:37:27', NULL, '2025-01-02 15:25:15', '2025-01-02 15:37:27'),
(131, 'App\\Models\\User', 2, 'api_token', '7cd6e02cdd366a7e058f4a94428214e155ae8e5c3063d4ab7c7c05e44b1a988e', '[\"*\"]', '2025-01-02 16:52:04', NULL, '2025-01-02 16:38:56', '2025-01-02 16:52:04'),
(132, 'App\\Models\\User', 3, 'api_token', '24e7cb8a93ae748eb24d42fc648152b07d39d345baf44fd30228d49340cfc0bc', '[\"*\"]', '2025-01-02 17:38:45', NULL, '2025-01-02 16:52:56', '2025-01-02 17:38:45'),
(133, 'App\\Models\\User', 3, 'api_token', '4f3c3693af62f8a1acd803f5db49d72ea55b67a037fa6d6db93adf90beab3716', '[\"*\"]', '2025-01-02 17:19:25', NULL, '2025-01-02 17:13:01', '2025-01-02 17:19:25'),
(134, 'App\\Models\\User', 3, 'api_token', 'b4e3ef09d259865fe97704698795fcee24a6d974d21cac583d27e30ad7e0cc8c', '[\"*\"]', '2025-01-02 18:21:24', NULL, '2025-01-02 17:39:56', '2025-01-02 18:21:24'),
(135, 'App\\Models\\User', 3, 'api_token', '34c874e92e99aad7bbeb80d7a440afd94e5adb6a4f53363c62eaf9df92996cce', '[\"*\"]', '2025-01-02 18:34:03', NULL, '2025-01-02 18:28:49', '2025-01-02 18:34:03'),
(136, 'App\\Models\\User', 3, 'api_token', '66cd0e05e2143a2540bd1b1ca1431e3ef596bec792d5bec4772ef3c4cdc0a6ff', '[\"*\"]', '2025-01-03 01:02:57', NULL, '2025-01-02 18:35:46', '2025-01-03 01:02:57'),
(137, 'App\\Models\\User', 1, 'api_token', 'c21eff23e8bbcd516428a1d18949ac722b37603420f97d06fb9ad399f036a2df', '[\"*\"]', '2025-01-03 01:03:55', NULL, '2025-01-03 01:03:45', '2025-01-03 01:03:55'),
(138, 'App\\Models\\User', 3, 'api_token', '17a6180f618dba7e68c192cb6d1675e79b895c6d1f7911ee261c87128560b5c1', '[\"*\"]', '2025-01-03 02:37:16', NULL, '2025-01-03 01:13:48', '2025-01-03 02:37:16'),
(139, 'App\\Models\\User', 1, 'api_token', '77bee04510725948c09ad5c164fa5281d88920cdb2eaeb4fc348bcd3320fa127', '[\"*\"]', '2025-01-03 02:51:46', NULL, '2025-01-03 02:51:42', '2025-01-03 02:51:46'),
(140, 'App\\Models\\User', 2, 'api_token', '8efa009af941f2f95d5b948422df994c8ea3749468ad21f4daa990da5994a353', '[\"*\"]', NULL, NULL, '2025-01-03 02:59:45', '2025-01-03 02:59:45'),
(141, 'App\\Models\\User', 3, 'api_token', '3f454bcc8ba57e7bf29a448810e947a29b46ec5c08c4e439af29c05a79d2a16a', '[\"*\"]', '2025-01-03 03:16:23', NULL, '2025-01-03 03:11:18', '2025-01-03 03:16:23'),
(142, 'App\\Models\\User', 2, 'api_token', 'af74c3df997431f4ce025e705419fbbd3788f910486da2e39df0f9b127e4661b', '[\"*\"]', '2025-01-03 13:16:47', NULL, '2025-01-03 12:59:23', '2025-01-03 13:16:47'),
(143, 'App\\Models\\User', 2, 'api_token', 'd22f4bf073c63d13befb256ea7ccb8043d64155eb680b943219d0e4b5d0b297d', '[\"*\"]', NULL, NULL, '2025-01-03 13:17:12', '2025-01-03 13:17:12'),
(144, 'App\\Models\\User', 1, 'api_token', '9290a66a021c560273c6e856b7c0ba898719199f6048dd8965df861848a45459', '[\"*\"]', '2025-01-04 09:46:44', NULL, '2025-01-04 07:57:34', '2025-01-04 09:46:44'),
(145, 'App\\Models\\User', 3, 'api_token', '7ab0a30a85cc519c520417893d9bd57a0659db62463b1a772254f306b83c30ca', '[\"*\"]', '2025-01-04 09:53:05', NULL, '2025-01-04 09:47:21', '2025-01-04 09:53:05'),
(146, 'App\\Models\\User', 1, 'api_token', 'a0acec603a691136d073fee5cb73400e948a419c23f2766e07091d4a05c3860c', '[\"*\"]', '2025-01-04 10:27:12', NULL, '2025-01-04 09:53:26', '2025-01-04 10:27:12'),
(147, 'App\\Models\\User', 1, 'api_token', '3d13408358713b0e84652edea021d485e3cd7fbc7e51add0f610020223a0daad', '[\"*\"]', '2025-01-04 11:05:01', NULL, '2025-01-04 11:04:38', '2025-01-04 11:05:01'),
(148, 'App\\Models\\User', 1, 'api_token', 'ce9f6d60d7e08feeb7d7b743f73803eb2055afa57ef1353354dcc5b614bd0e72', '[\"*\"]', '2025-01-04 11:06:47', NULL, '2025-01-04 11:06:42', '2025-01-04 11:06:47'),
(149, 'App\\Models\\User', 1, 'api_token', '8e72a38cad414dcfd70e014c4691a5868a1448c2183407d95a76989c762a555b', '[\"*\"]', '2025-01-04 11:10:24', NULL, '2025-01-04 11:09:47', '2025-01-04 11:10:24'),
(150, 'App\\Models\\User', 1, 'api_token', '8448be38c6fe21c8a4f9bc63f12434b16574b6c1959ad20f3157a950f171f2e1', '[\"*\"]', '2025-01-05 00:00:47', NULL, '2025-01-04 23:57:00', '2025-01-05 00:00:47'),
(151, 'App\\Models\\User', 1, 'api_token', 'be84a8717aa239ad3387600531a5278edbd747a4b41c42d1d7d5178779342fcb', '[\"*\"]', '2025-01-05 00:20:33', NULL, '2025-01-05 00:20:29', '2025-01-05 00:20:33'),
(152, 'App\\Models\\User', 2, 'api_token', '16bf7f62f1b67d630941559d8b8b1cb1249d8e5cdf1c92a553d3a3d2068af35d', '[\"*\"]', '2025-01-05 13:21:19', NULL, '2025-01-05 00:26:08', '2025-01-05 13:21:19'),
(153, 'App\\Models\\User', 3, 'api_token', 'b0547bf1b07a0f29ba06bb64e3842711be41448f20784d172e1a3a8019b565e9', '[\"*\"]', NULL, NULL, '2025-01-05 01:59:59', '2025-01-05 01:59:59'),
(154, 'App\\Models\\User', 2, 'api_token', '8ba132fa4dbea6e70b6023d45952fcd3a31b5aa6b60e7a3b1666449c41ecb191', '[\"*\"]', '2025-01-14 00:43:24', NULL, '2025-01-05 02:00:30', '2025-01-14 00:43:24'),
(155, 'App\\Models\\User', 2, 'api_token', '06fe2a4668c335dee1ec18a7b2198e8f26941ac5ae70cde9e78a286b756b215f', '[\"*\"]', NULL, NULL, '2025-01-05 11:55:18', '2025-01-05 11:55:18'),
(156, 'App\\Models\\User', 2, 'api_token', '8a62d2c35db55ba11727de18a37b33c75ede79774a984eba993dd8b8ab0fbaba', '[\"*\"]', '2025-01-05 13:25:47', NULL, '2025-01-05 13:22:15', '2025-01-05 13:25:47'),
(157, 'App\\Models\\User', 2, 'api_token', '6bcc5dab9e58a09b98490ddd864a7e585da9389cd8f9452504ae66c031c40864', '[\"*\"]', '2025-01-05 13:44:20', NULL, '2025-01-05 13:32:52', '2025-01-05 13:44:20'),
(158, 'App\\Models\\User', 1, 'api_token', '06e297fb8fae61442074e07e7acddbc066a65e44fa3eca2ad8b17d9ab75ad767', '[\"*\"]', '2025-01-08 09:23:00', NULL, '2025-01-08 09:19:28', '2025-01-08 09:23:00'),
(159, 'App\\Models\\User', 1, 'api_token', '7c83275138ecc5aa61f000bde93e035a6c4b82196974d701d7d0abed3810f4eb', '[\"*\"]', '2025-01-08 10:39:57', NULL, '2025-01-08 09:56:37', '2025-01-08 10:39:57'),
(160, 'App\\Models\\User', 1, 'api_token', 'ae0c396bc3443ef24414fdae16142f24b1b1c674aba1e7a3c11652b7d9816440', '[\"*\"]', NULL, NULL, '2025-01-14 00:43:48', '2025-01-14 00:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_products` tinyint(1) NOT NULL DEFAULT '0',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no_image.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori_id` bigint UNSIGNED DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nama`, `harga`, `deskripsi`, `featured_products`, `foto`, `created_at`, `updated_at`, `kategori_id`, `stok`) VALUES
(1, 'Taek Wood Cupboard', 2000000, 'Taek Cupboard', 1, 'lkGrYgFsTU1bqooLxto4yfqOhTsyMJD0MzK80M3y.png', '2024-12-22 08:37:43', '2025-06-21 23:48:08', 1, 5),
(2, 'Bar Stool', 15000000, 'Bar Stool', 0, 'RXM39K4GA9mWqg2hhpl41Z4KOI27CPxXzA75pt46.png', '2024-12-22 08:38:10', '2024-12-31 01:43:32', 1, 3),
(3, 'Teak wood cupboard 4', 2400000, 'Teak wood cupboard 4', 0, 'JLPVJmw3QdsXa0ZJL6H9khZ21B5v1P2qgRzrrUOo.png', '2024-12-22 08:38:50', '2024-12-31 01:43:42', 1, 7),
(4, 'Leather_Lounge_Chairs', 2300000, 'Leather_Lounge_Chairs', 0, 'RRhM4cPS65Fk7PxqXmCHKuK2ZWA0kBQP327AFztV.png', '2024-12-22 08:39:15', '2024-12-31 01:43:51', 1, 6),
(5, 'Teak wood cupboard 2', 5000000, 'Teak wood cupboard 2', 1, 'yXVdzvB09ZmEgVPsv6KqjEnOFfc8uMccAOy2iijW.png', '2024-12-22 08:40:07', '2025-06-21 23:47:52', 1, 0),
(6, 'Large Wicker Miror', 1400000, 'Large Wicker Miror', 1, 'eQNldiTrM6hjiK3tbTWvVdrzVurEo48Mc1MrpZcS.png', '2024-12-22 08:41:59', '2024-12-22 08:41:59', 3, 0),
(7, 'Natural Rattan Bedroom  ( Queen Bed )', 3400000, 'Natural Rattan Bedroom  ( Queen Bed )', 0, 'S0SLvWMXEFK7soyJYs4n9goaX1dwS9nswRTe2wRP.png', '2024-12-22 08:42:21', '2024-12-22 08:42:21', 3, 0),
(8, 'Miror', 600000, 'Miror for child', 1, 'Z4gDAODZYFid9WdboikbeE4cUKpEWll55jhPmSIa.png', '2024-12-29 06:06:57', '2024-12-29 06:08:17', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('j0yuUfVVyCLczNXHk3c4LthGJWkserJ7olifgn6i', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY1N2Qm5sZGVacW9VVXhlczA4NGpCbHNzQ0JVTHZIcm1KYnc1ZkxkZiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2NhdGVnb3J5Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1770301633),
('sn8QgrF5RXKB6cIvlIxkZ9hIvtpGP9vQ27VWo1x7', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRTgzUmQ5ZHlsVFhUZnVBN2FJV3hqZW5FbTRqeEhXRGpJdGlISFpKRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yeSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1770275234);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('pending','completed','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gross_amount` decimal(15,2) NOT NULL,
  `items` json DEFAULT NULL,
  `customer_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `payment_status`, `gross_amount`, `items`, `customer_first_name`, `customer_last_name`, `customer_email`, `customer_phone`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'ORDER-1736106852331', 'completed', 15000000.00, '[{\"id\": 57, \"name\": \"Bar Stool\", \"price\": 15000000, \"quantity\": 1}]', 'Valen', 'dsadas', 'customer@valen.com', '345433', 2, '2025-01-05 12:54:12', '2025-01-05 12:54:31'),
(2, 'ORDER-1736108399474', 'completed', 31200000.00, '[{\"id\": 58, \"name\": \"Bar Stool\", \"price\": 15000000, \"quantity\": 2}, {\"id\": 59, \"name\": \"Miror\", \"price\": 600000, \"quantity\": 2}]', 'Valen', 'Febian', 'customer@valen.com', '083456632234', 2, '2025-01-05 13:19:59', '2025-01-05 13:20:17'),
(3, 'ORDER-1736108435091', 'completed', 31200000.00, '[{\"id\": 58, \"name\": \"Bar Stool\", \"price\": 15000000, \"quantity\": 2}, {\"id\": 59, \"name\": \"Miror\", \"price\": 600000, \"quantity\": 2}]', 'Valen', 'oke', 'customer@valen.com', '89789678', 2, '2025-01-05 13:20:34', '2025-01-05 13:21:16'),
(4, 'ORDER-1736109444309', 'completed', 2000000.00, '[{\"id\": 60, \"name\": \"Taek Wood Cupboard\", \"price\": 2000000, \"quantity\": 1}]', 'Valen', 'Febian', 'customer@valen.com', '0853434634', 2, '2025-01-05 13:37:24', '2025-01-05 13:38:17'),
(5, 'ORDER-1736109864602', 'completed', 2000000.00, '[{\"id\": 60, \"name\": \"Taek Wood Cupboard\", \"price\": 2000000, \"quantity\": 1}]', 'Valen', 'hrfghfg', 'customer@valen.com', '6456', 2, '2025-01-05 13:44:24', '2025-01-05 13:44:40'),
(6, 'ORDER-1736353292835', 'completed', 15000000.00, '[{\"id\": 62, \"name\": \"Bar Stool\", \"price\": 15000000, \"quantity\": 1}]', 'valen', 'Febian', 'admin@valen.com', '08224356464', 1, '2025-01-08 09:21:54', '2025-01-08 09:22:54'),
(7, 'ORDER-1736356979886', 'completed', 16200000.00, '[{\"id\": 62, \"name\": \"Bar Stool\", \"price\": 15000000, \"quantity\": 1}, {\"id\": 63, \"name\": \"Miror\", \"price\": 600000, \"quantity\": 2}]', 'valen', 'febian', 'admin@valen.com', '082253400079', 1, '2025-01-08 10:23:01', '2025-01-08 10:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'valen', 'admin@valen.com', 'admin', NULL, '$2y$12$jnMcqOlP2XkAIQ2HirPLvuq38dXV7svrxw362GeqUt2MenjrPO5pW', NULL, '2024-12-22 08:12:44', '2024-12-22 08:12:44'),
(2, 'Valen', 'customer@valen.com', 'customer', NULL, '$2y$12$L8Hw5bQTm3.ZI.f2BrRgwOv65oFR5c90gHEQfMPBjp6vG42Gc0u/W', NULL, '2024-12-23 10:40:41', '2024-12-23 10:40:41'),
(3, 'satu', 'customer@satu.com', 'customer', NULL, '$2y$12$auzaCS1wY0UCHDo8PVFQ3.PP/NVuN.J1Twb2Js1pYcfvtdFP3FyCe', NULL, '2024-12-23 20:12:44', '2024-12-23 20:12:44'),
(4, 'baru', 'customer@baru.com', 'customer', NULL, '$2y$12$89.RumxxNuUONwo.XjqQAetTUtc1vziCIWuOXl.d.fXzPYovQY2Hy', NULL, '2024-12-29 22:31:39', '2024-12-29 22:31:39'),
(5, 'oke', 'oke@saya.com', 'customer', NULL, '$2y$12$qPIBrqhODg.AihuIpwj0yeAt2SKfEolg/DIrNZSCnINmQbvIWjaXy', NULL, '2024-12-30 05:28:05', '2024-12-30 05:28:05'),
(6, 'okelaoke', 'okela@oke.com', 'customer', NULL, '$2y$12$J3R.rN2DPWB8gu2QTpr9ju5AiXF4LHJ2lzMgNUYrYUEmlafoJVmT2', NULL, '2024-12-30 05:37:46', '2024-12-30 05:37:46'),
(7, 'create', 'create@account.com', 'customer', NULL, '$2y$12$JSP2uI62LhSGAYrcnE9Gq.seZFmtmTlkr8akDCCroos.hZm032ftW', NULL, '2024-12-30 20:57:32', '2024-12-30 20:57:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
-- ALTER TABLE `cache` removed: primary key moved to CREATE TABLE

--
-- Indexes for table `cache_locks`
--
-- ALTER TABLE `cache_locks` removed: primary key moved to CREATE TABLE

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
-- ALTER TABLE `job_batches` removed: primary key moved to CREATE TABLE

--
-- Indexes for table `kategoris`
--
-- ALTER TABLE `kategoris` removed: primary key moved to CREATE TABLE

--
-- Indexes for table `migrations`
--
-- ALTER TABLE `migrations` removed: primary key moved to CREATE TABLE

--
-- Indexes for table `password_reset_tokens`
--
-- ALTER TABLE `password_reset_tokens` removed: primary key moved to CREATE TABLE

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
ADD KEY `products_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
ADD UNIQUE KEY `transactions_order_id_unique` (`order_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `products_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
