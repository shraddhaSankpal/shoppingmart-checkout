-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 05:57 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping-market`
--

-- --------------------------------------------------------

--
-- Table structure for table `xyl_products`
--

CREATE TABLE `xyl_products` (
  `id` int(11) NOT NULL,
  `sku` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `xyl_products`
--

INSERT INTO `xyl_products` (`id`, `sku`, `name`, `unit_price`, `date_added`, `description`, `image`) VALUES
(1, 'A', 'Red Rose', 50, '2022-05-17 14:24:31', 'The Red Rose', '/shoppingmart-checkout/images/red-rose.jpg'),
(2, 'B', 'Lily', 30, '2022-05-17 14:24:31', 'The Lily', '/shoppingmart-checkout/images/lily.jpg'),
(3, 'C', 'Tulip', 20, '2022-05-17 14:26:39', 'The Tulip', '/shoppingmart-checkout/images/tulip.jpg'),
(4, 'D', 'Orchid ', 15, '2022-05-17 14:26:39', 'The Orchid ', '/shoppingmart-checkout/images/orchid.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `xyl_product_discounts`
--

CREATE TABLE `xyl_product_discounts` (
  `id` int(11) NOT NULL,
  `sku_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `ref` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `xyl_product_discounts`
--

INSERT INTO `xyl_product_discounts` (`id`, `sku_id`, `quantity`, `price`, `ref`, `ref_price`) VALUES
(1, 'A', 3, 130, '', 0),
(2, 'B', 2, 45, '', 0),
(3, 'C', 2, 38, '', 0),
(4, 'C', 3, 50, '', 0),
(5, 'D', 1, 0, 'A', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xyl_products`
--
ALTER TABLE `xyl_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`) USING HASH;

--
-- Indexes for table `xyl_product_discounts`
--
ALTER TABLE `xyl_product_discounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `xyl_product_discounts`
--
ALTER TABLE `xyl_product_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
