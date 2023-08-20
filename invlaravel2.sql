-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2023 at 08:38 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invlaravel2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Baju Wanita', '2023-06-11 05:44:42', '2023-06-11 05:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `nama`, `alamat`, `email`, `password`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'Ikram', 'rumah', 'user@mail.com', 'ikram123', '098678969', '2023-06-11 05:45:52', '2023-06-11 05:45:52'),
(2, 'Adit', 'rumah', 'adit@mail.com', '$2y$10$ZIORtFnqUYI7q.tdBFdZmuG/UZlfuefbw8BaJHRHagJufiGl', '089347234', NULL, NULL),
(5, 'Reseller', 'rumah', 'reseller@mail.com', '$2y$10$kmmDHroeecal3X89KfkURuMo.4INkIAOnLzYjKq.4/MT9j0D23luC', '4546645645', '2023-07-08 23:30:07', '2023-07-08 23:30:07'),
(6, 'Akbar', 'rumah', 'akbar@mail.com', '$2y$10$IOFOiOVbK98xY14UQ5sqcOhA8MHIC.ooSIBM4KQmdU/Cy.a8SHZvy', '0892342456', '2023-07-27 12:09:51', '2023-07-27 12:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `detail_products`
--

CREATE TABLE `detail_products` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `warna_id` int(11) UNSIGNED DEFAULT NULL,
  `ukuran_id` int(11) UNSIGNED DEFAULT NULL,
  `stok` int(11) UNSIGNED DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_products`
--

INSERT INTO `detail_products` (`id`, `product_id`, `warna_id`, `ukuran_id`, `stok`, `gambar`, `created_at`, `updated_at`) VALUES
(6, 10, 1, 2, 10, '', '2023-08-09 12:38:43', '2023-08-09 12:39:14'),
(7, 10, 2, 1, 35, '', '2023-08-09 12:38:43', '2023-08-15 04:05:55'),
(9, 10, 1, 1, 60, '', '2023-08-09 05:42:06', '2023-08-16 06:14:33'),
(14, 13, 1, 1, 20, '', '2023-08-13 23:18:54', '2023-08-15 22:06:32'),
(17, 12, 2, 1, 0, '', '2023-08-14 01:04:33', '2023-08-14 01:04:33'),
(18, 12, 1, 2, 0, '', '2023-08-14 01:16:09', '2023-08-14 01:16:09'),
(19, 12, 2, 1, 0, '', '2023-08-14 01:18:26', '2023-08-14 01:18:26'),
(25, 11, 1, 1, 5, '', '2023-08-14 01:48:37', '2023-08-16 00:46:48'),
(26, 11, 2, 2, 0, '', '2023-08-14 02:00:41', '2023-08-14 02:00:41'),
(27, 11, 1, 2, 0, '', '2023-08-14 02:12:59', '2023-08-14 02:12:59'),
(28, 11, 2, 1, 0, '', '2023-08-14 02:51:01', '2023-08-14 02:51:01'),
(29, 13, 2, 2, 0, '', '2023-08-14 02:52:20', '2023-08-14 02:52:20'),
(30, 10, 2, 2, 21, '', '2023-08-14 03:06:55', '2023-08-14 07:18:05'),
(31, 13, 1, 2, 0, '', '2023-08-14 03:28:16', '2023-08-14 03:28:16'),
(32, 13, 2, 1, 0, '', '2023-08-14 03:35:36', '2023-08-14 03:35:36'),
(40, 12, 2, 2, 0, 'delivery.png,app_icon.png', '2023-08-19 09:01:43', '2023-08-19 09:01:43'),
(41, 14, 1, 1, 6, 'asdf.jpg,gams.jpg', '2023-08-19 21:25:01', '2023-08-19 21:28:39');

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_produk`
-- (See below for the actual view)
--
CREATE TABLE `detail_produk` (
`product_id` int(10) unsigned
,`detail_id` int(11) unsigned
,`warna_id` int(11)
,`ukuran_id` int(11)
,`kode_barang` varchar(55)
,`nama` varchar(191)
,`harga` int(11)
,`harga_jual` int(11)
,`image` varchar(191)
,`gambar` varchar(255)
,`ukuran` varchar(7)
,`warna` varchar(25)
,`stok` int(11) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `laporan`
-- (See below for the actual view)
--
CREATE TABLE `laporan` (
`kode_barang` varchar(55)
,`nama` varchar(191)
,`ukuran` varchar(7)
,`warna` varchar(25)
,`image` varchar(191)
,`reseller` varchar(191)
,`qty` int(11)
,`total_harga` bigint(21)
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_18_035002_create_customers_table', 1),
(4, '2018_12_18_035015_create_sales_table', 1),
(5, '2018_12_18_035038_create_suppliers_table', 1),
(6, '2018_12_18_041830_create_categories_table', 1),
(7, '2018_12_18_042809_create_products_table', 1),
(8, '2018_12_18_043146_create_product_masuk_table', 1),
(9, '2018_12_18_043233_create_product_keluar_table', 1),
(10, '2018_12_19_044911_add_field_role_to_table_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_barang` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `kode_barang`, `category_id`, `nama`, `harga`, `harga_jual`, `image`, `qty`, `created_at`, `updated_at`) VALUES
(10, 'KB3767246', 1, 'Jaket', 70000, 85000, '/upload/products/jaket.jpg', 25, '2023-07-27 11:30:35', '2023-07-27 23:42:21'),
(11, 'KB3767245', 1, 'Celana', 50000, 60000, '/upload/products/celana.png', 55, '2023-07-27 23:03:33', '2023-08-09 04:57:16'),
(12, 'KB3767242', 1, 'Tshirt', 70000, 85000, '/upload/products/tshirt.jpg', 10, '2023-08-09 05:15:26', '2023-08-19 22:14:58'),
(13, 'KB3767243', 1, 'Knitwear', 120000, 135000, '/upload/products/knitwear.jpeg', 5, '2023-08-13 23:09:09', '2023-08-13 23:18:54'),
(14, 'KB3767249', 1, 'Baju ngaji', 120000, 135000, '/upload/products/baju-ngaji.jpeg', 0, '2023-08-19 21:22:41', '2023-08-19 21:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_keluar`
--

CREATE TABLE `product_keluar` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `detail_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_keluar`
--

INSERT INTO `product_keluar` (`id`, `product_id`, `detail_id`, `customer_id`, `qty`, `tanggal`, `created_at`, `updated_at`) VALUES
(14, 10, 6, 6, 15, '2023-07-28', '2023-07-27 23:42:21', '2023-07-27 23:42:21'),
(15, 11, 25, 5, 10, '2023-08-17', '2023-08-16 00:46:48', '2023-08-16 00:46:48'),
(16, 10, 9, 5, 10, '2023-08-16', '2023-08-16 01:15:56', '2023-08-16 01:15:56'),
(18, 14, 41, 5, 15, '2023-08-17', '2023-08-19 21:28:39', '2023-08-19 21:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_masuk`
--

CREATE TABLE `product_masuk` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `detail_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `stok` int(11) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_masuk`
--

INSERT INTO `product_masuk` (`id`, `product_id`, `detail_id`, `supplier_id`, `stok`, `tanggal`, `created_at`, `updated_at`) VALUES
(47, 10, 9, NULL, 5, '2023-08-31', '2023-08-15 01:16:54', '2023-08-15 01:16:54'),
(48, 10, 7, NULL, 5, '2023-08-30', '2023-08-15 01:21:52', '2023-08-15 04:05:55'),
(49, 11, 25, NULL, 15, '2023-08-16', '2023-08-15 04:40:41', '2023-08-15 04:40:41'),
(50, 13, 14, NULL, 15, '2023-08-31', '2023-08-15 22:06:32', '2023-08-15 22:06:32'),
(51, 14, 41, NULL, 21, '2023-08-31', '2023-08-19 21:26:49', '2023-08-19 21:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama`, `alamat`, `email`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'Toko baju online', 'rumah', 'toko@mail.com', '083495345', '2023-06-11 05:49:00', '2023-06-11 05:49:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksireseller`
-- (See below for the actual view)
--
CREATE TABLE `transaksireseller` (
`kode_barang` varchar(55)
,`customers_id` int(10) unsigned
,`nama` varchar(191)
,`ukuran` varchar(7)
,`warna` varchar(25)
,`image` varchar(191)
,`reseller` varchar(191)
,`qty` int(11)
,`total_harga` bigint(21)
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi_reseller`
-- (See below for the actual view)
--
CREATE TABLE `transaksi_reseller` (
`kode_barang` varchar(55)
,`customers_id` int(10) unsigned
,`image` varchar(191)
,`nama` varchar(191)
,`qty` int(11)
,`total_harga` bigint(21)
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `id` int(11) NOT NULL,
  `ukuran` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`id`, `ukuran`) VALUES
(1, 'M'),
(2, 'L');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(2, 'Staff', 'staff@mail.com', '$2y$10$zCkpnyz07DQfSNtv0Tjw8OkgaspHisdS8OmRvMGAgN7UBpa1LIyi.', NULL, '2023-06-11 05:43:49', NULL, 'staff'),
(4, 'Admin', 'admin@mail.com', '$2y$10$uuc/mWtb/v5izsSl7rzReeUVX8/4jwT1sB3ErmD3UDoJDfoD9LkHu', 'TOpfRc1iDUaIjtEig6MRHJnc3Xpoz2DewdEB2IxoDA06D4L4dQ8mqCK6F3IG', '2023-06-12 05:34:56', '2023-06-12 05:34:56', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE `warna` (
  `id` int(11) NOT NULL,
  `warna` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`id`, `warna`) VALUES
(1, 'Merah'),
(2, 'Biru');

-- --------------------------------------------------------

--
-- Structure for view `detail_produk`
--
DROP TABLE IF EXISTS `detail_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_produk`  AS SELECT `products`.`id` AS `product_id`, `detail_products`.`id` AS `detail_id`, `warna`.`id` AS `warna_id`, `ukuran`.`id` AS `ukuran_id`, `products`.`kode_barang` AS `kode_barang`, `products`.`nama` AS `nama`, `products`.`harga` AS `harga`, `products`.`harga_jual` AS `harga_jual`, `products`.`image` AS `image`, `detail_products`.`gambar` AS `gambar`, `ukuran`.`ukuran` AS `ukuran`, `warna`.`warna` AS `warna`, `detail_products`.`stok` AS `stok` FROM (((`products` join `detail_products` on(`products`.`id` = `detail_products`.`product_id`)) join `ukuran` on(`ukuran`.`id` = `detail_products`.`ukuran_id`)) join `warna` on(`warna`.`id` = `detail_products`.`warna_id`)) ORDER BY `products`.`kode_barang` ASC  ;

-- --------------------------------------------------------

--
-- Structure for view `laporan`
--
DROP TABLE IF EXISTS `laporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan`  AS SELECT `products`.`kode_barang` AS `kode_barang`, `products`.`nama` AS `nama`, `ukuran`.`ukuran` AS `ukuran`, `warna`.`warna` AS `warna`, `products`.`image` AS `image`, `customers`.`nama` AS `reseller`, `product_keluar`.`qty` AS `qty`, `product_keluar`.`qty`* `products`.`harga` AS `total_harga`, `product_keluar`.`tanggal` AS `tanggal` FROM (((((`products` join `detail_products` on(`products`.`id` = `detail_products`.`product_id`)) join `ukuran` on(`ukuran`.`id` = `detail_products`.`ukuran_id`)) join `warna` on(`warna`.`id` = `detail_products`.`warna_id`)) join `product_keluar` on(`product_keluar`.`detail_id` = `detail_products`.`id`)) join `customers` on(`customers`.`id` = `product_keluar`.`customer_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `transaksireseller`
--
DROP TABLE IF EXISTS `transaksireseller`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksireseller`  AS SELECT `products`.`kode_barang` AS `kode_barang`, `customers`.`id` AS `customers_id`, `products`.`nama` AS `nama`, `ukuran`.`ukuran` AS `ukuran`, `warna`.`warna` AS `warna`, `products`.`image` AS `image`, `customers`.`nama` AS `reseller`, `product_keluar`.`qty` AS `qty`, `product_keluar`.`qty`* `products`.`harga` AS `total_harga`, `product_keluar`.`tanggal` AS `tanggal` FROM (((((`products` join `detail_products` on(`products`.`id` = `detail_products`.`product_id`)) join `ukuran` on(`ukuran`.`id` = `detail_products`.`ukuran_id`)) join `warna` on(`warna`.`id` = `detail_products`.`warna_id`)) join `product_keluar` on(`product_keluar`.`detail_id` = `detail_products`.`id`)) join `customers` on(`customers`.`id` = `product_keluar`.`customer_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `transaksi_reseller`
--
DROP TABLE IF EXISTS `transaksi_reseller`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_reseller`  AS SELECT `products`.`kode_barang` AS `kode_barang`, `customers`.`id` AS `customers_id`, `products`.`image` AS `image`, `products`.`nama` AS `nama`, `product_keluar`.`qty` AS `qty`, `products`.`harga`* `product_keluar`.`qty` AS `total_harga`, `product_keluar`.`tanggal` AS `tanggal` FROM ((`product_keluar` join `products` on(`product_keluar`.`product_id` = `products`.`id`)) join `customers` on(`product_keluar`.`customer_id` = `customers`.`id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_products`
--
ALTER TABLE `detail_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warna_id_foreign` (`warna_id`),
  ADD KEY `ukuran_id_foreign` (`ukuran_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `product_keluar`
--
ALTER TABLE `product_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_keluar_product_id_foreign` (`product_id`),
  ADD KEY `product_keluar_customer_id_foreign` (`customer_id`),
  ADD KEY `detail_id` (`detail_id`);

--
-- Indexes for table `product_masuk`
--
ALTER TABLE `product_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_masuk_product_id_foreign` (`product_id`),
  ADD KEY `product_masuk_supplier_id_foreign` (`supplier_id`),
  ADD KEY `detail_id` (`detail_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_products`
--
ALTER TABLE `detail_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_keluar`
--
ALTER TABLE `product_keluar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_masuk`
--
ALTER TABLE `product_masuk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_keluar`
--
ALTER TABLE `product_keluar`
  ADD CONSTRAINT `product_keluar_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
