-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 02:46 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `first_name`, `last_name`, `email`, `Address`, `username`, `password`, `phone`, `Image`, `Status`, `Position`, `online`, `created_at`, `updated_at`) VALUES
(2, 'Deshan', 'jagoda', 'Deshan@gmail.com', 'Wanduramba', 'Deshan', '$2y$10$r0PrMsJ7eHY4nxpMbwD35e9si0XwPBh3jwUXR1lDJCp3/2cP2XTfi', '0123456789', 'ecosystem-hero-min.webp', 1, 'MainAdmin', 0, '2024-10-01 09:17:32', '2024-12-19 08:04:01'),
(3, 'Sandun', 'Jagoda', 'Sandun@gmail.com', 'Wanduramba', 'Sandun', '$2y$10$1j78nuw5xtkEHcrTHrGiT.I./gBwPdFvam.B7TtFg6q0M5yNxCVee', '1234569870', '', 1, 'Admin', 0, '2024-10-22 03:35:23', '2024-10-22 05:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `customer_id`, `product_id`, `quantity`, `added_at`) VALUES
(50, 14, 30, 2, '2025-01-07 09:45:36'),
(51, 14, 31, 2, '2025-01-07 09:45:53'),
(52, 14, 21, 1, '2025-01-07 13:43:53'),
(53, 14, 29, 1, '2025-01-07 13:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `Status` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `online` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `Status`, `image`, `online`, `created_at`, `updated_at`) VALUES
(11, NULL, NULL, 'deshan.priyantha@ecyber.com', '$2y$10$06nfOSp1TK6vMkQvwjIL2egISgHUUwUrOIr/6e6uJtjXNqSj6/Azu', NULL, NULL, 0, '', 0, '2024-12-20 07:35:23', '2024-12-20 07:43:26'),
(12, 'Hansika', NULL, 'hansika.piyumali@ecyber.com', '$2y$10$VnBNVu.5VppF.JiKgS52feE1fGjUY56WnpTjYg7qHBPchewbZp2/u', NULL, NULL, 1, '', 0, '2024-12-20 07:45:10', '2024-12-23 16:17:54'),
(13, 'Hansika', 'Piyumali', 'hansika@gmail.com', '$2y$10$MbAHkanulzcUNJXwl8hg6O7BGdXns6v7PYIj4ZT3sCmctRMiTGEQi', '12345678909', 'Baddegama', 1, '', 1, '2024-12-23 16:25:28', '2024-12-24 00:52:51'),
(14, 'Hansika', 'Piyumali', 'hansi@gmail.com', '$2y$10$DUeM9Z5aTZkYHQZpE5dINOm8iIjkXLXdyF2XBMXjBqi2B2wDIDYUq', '1234566', 'asdf', 1, '', 1, '2025-01-04 21:18:41', '2025-01-07 13:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_percentage` decimal(5,2) NOT NULL CHECK (`discount_percentage` > 0 and `discount_percentage` <= 100),
  `valid_from` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourite_items`
--

CREATE TABLE `favourite_items` (
  `favourite_item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourite_items`
--

INSERT INTO `favourite_items` (`favourite_item_id`, `customer_id`, `product_id`, `quantity`, `added_at`) VALUES
(2, 12, 21, 1, '2024-12-20 07:53:17'),
(3, 12, 22, 1, '2024-12-20 08:17:01'),
(7, 13, 22, 1, '2024-12-23 20:17:13'),
(8, 13, 24, 1, '2024-12-23 20:20:24'),
(9, 13, 23, 1, '2024-12-23 20:20:26'),
(11, 14, 32, 1, '2025-01-07 13:45:44'),
(12, 14, 31, 1, '2025-01-07 13:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `newsletter_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL,
  `quntity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `shipping_address` text DEFAULT NULL,
  `payment_method` enum('credit_card','paypal','bank_transfer') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `seller_id`, `status`, `quntity`, `total_price`, `shipping_address`, `payment_method`, `created_at`, `updated_at`) VALUES
(2, 12, 22, 16, 'pending', 1, 1500.00, 'ndjjd', 'credit_card', '2024-12-20 08:19:45', '2024-12-20 09:13:13'),
(3, 13, 23, 17, 'pending', 3, 4500.00, 'Badegama', NULL, '2024-12-23 16:31:13', '2024-12-23 16:31:13'),
(4, 13, 23, 17, 'pending', 9, 13500.00, 'baddegama', NULL, '2024-12-23 20:33:37', '2024-12-23 20:33:37'),
(5, 13, 22, 16, 'pending', 1, 1500.00, 'baddegama', NULL, '2024-12-23 20:33:37', '2024-12-23 20:33:37'),
(6, 13, 23, 17, 'pending', 6, 9000.00, 'Baddegama', NULL, '2024-12-23 20:41:21', '2024-12-23 20:41:21'),
(7, 14, 23, 17, 'pending', 1, 1500.00, '', NULL, '2025-01-06 06:04:35', '2025-01-06 06:04:35'),
(8, 14, 22, 16, 'pending', 1, 1500.00, '', NULL, '2025-01-06 06:04:35', '2025-01-06 06:04:35'),
(9, 14, 22, 16, 'pending', 2, 3000.00, '', NULL, '2025-01-07 09:32:36', '2025-01-07 09:32:36'),
(10, 14, 24, 17, 'pending', 1, 10.00, '', NULL, '2025-01-07 09:32:36', '2025-01-07 09:32:36'),
(11, 14, 31, 18, 'pending', 1, 30.00, '', NULL, '2025-01-07 09:32:36', '2025-01-07 09:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `sub_catagory` varchar(120) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `image2_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `seller_id`, `name`, `description`, `price`, `stock`, `category`, `sub_catagory`, `Status`, `image_url`, `image2_url`, `created_at`, `updated_at`) VALUES
(21, 16, 'Shirt', 'Shirt', 1500.00, 26, 'men', '', 1, 'f1.jpg', 'f2.jpg', '2024-12-20 07:41:11', '2024-12-20 07:47:14'),
(22, 16, 'Shirt', 'shirt\r\n', 1500.00, 23, 'men', '', 1, 'f3.jpg', 'f4.jpg', '2024-12-20 07:47:37', '2025-01-07 09:32:36'),
(23, 17, 'Shirt', 'shirt', 1500.00, 0, 'women', '', 1, 'product_02.jpg', 'product_02b.jpg', '2024-12-20 07:50:43', '2025-01-06 06:04:35'),
(24, 17, 'Casual Shirt', 'Casual Shirt', 10.00, 1, 'women', '', 1, 'product_04.jpg', 'product_04b.jpg', '2024-12-20 07:51:32', '2025-01-07 09:41:01'),
(25, 18, 'casual shirt', 'casual shirt', 10.00, 20, 'men', '', 1, 'mem shirt1.jpg', 'men shirt1b.jpg', '2025-01-07 09:09:14', '2025-01-07 09:09:14'),
(26, 18, 'casual shirt', 'casual shirt', 12.00, 34, 'women', '', 1, 'product_08.jpg', 'product_08b.jpg', '2025-01-07 09:10:27', '2025-01-07 09:10:27'),
(27, 18, 'Summer Casual Jacket', 'Summer Casual Jacket', 30.00, 15, 'men', '', 1, 'casual jacket1.jpg', 'casual jacket1b.jpg', '2025-01-07 09:12:56', '2025-01-07 09:12:56'),
(28, 18, 'Court  Shoes', 'Court  Shoes', 32.00, 120, 'accessaries', '', 1, 'shoes_01.jpg', 'shoes_02.jpg', '2025-01-07 09:14:50', '2025-01-07 09:14:50'),
(29, 18, 'Men Shoes', 'Men Shoes', 45.00, 50, 'accessaries', '', 1, 'shoes1.jpg', 'shoes1b.jpg', '2025-01-07 09:15:57', '2025-01-07 09:15:57'),
(30, 18, 'Men Shoes', 'Men Shoes', 53.00, 19, 'accessaries', '', 1, 'cashoes_01.jpg', 'cashoes_02.jpg', '2025-01-07 09:17:01', '2025-01-07 13:45:32'),
(31, 18, 'Casual Sweater', 'Casual Sweater', 30.00, 18, 'women', '', 1, 'product_07.jpg', 'product_07b.jpg', '2025-01-07 09:21:01', '2025-01-07 13:45:31'),
(32, 18, 'Women Bag', 'Women Bag', 55.00, 19, 'accessaries', '', 1, 'bagyellow_01.jpg', 'bagyellow_02.jpg', '2025-01-07 09:21:45', '2025-01-07 09:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `Status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`review_id`, `product_id`, `customer_id`, `seller_id`, `rating`, `comment`, `Status`, `created_at`) VALUES
(4, 23, 13, 17, 3, 'test', 1, '2024-12-23 21:26:21'),
(5, 23, 13, 17, 2, 'test', 1, '2024-12-23 21:27:47'),
(6, 23, 13, 17, 3, 'test', 1, '2024-12-23 21:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `seller_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `business_name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `Status` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `business_name`, `address`, `Status`, `image`, `online`, `created_at`, `updated_at`) VALUES
(16, 'Sandun', 'Deshan', 'deshan.priyantha@ecyber.com', '$2y$10$KXYVNkIt0PI5JMAl0bAFmuY1LkrP.8caMkNrhHwJqzoPQzZNa88FS', '0764126712', NULL, NULL, 1, '', 0, '2024-12-20 07:36:29', '2024-12-20 07:37:00'),
(17, 'hansika', 'piyumali', 'hansika.piyumali@ecyber.com', '$2y$10$jTPbqM3S9G6r64T0ECpfcuLuxmPnFpUIlhCJux4aqW8G4h/bANHly', '0765674563', NULL, NULL, 1, '', 0, '2024-12-20 07:48:31', '2024-12-20 07:49:03'),
(18, 'nethmini', 'piyumali', 'hansika@gmail.com', '$2y$10$P0hoI6Nq9St/ZRW.7URUneHNq7aeEPAzjXQsXbwelMp/XmPDLawmO', '1234566789', NULL, NULL, 1, '', 1, '2025-01-07 09:07:30', '2025-01-07 09:07:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `favourite_items`
--
ALTER TABLE `favourite_items`
  ADD PRIMARY KEY (`favourite_item_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`newsletter_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourite_items`
--
ALTER TABLE `favourite_items`
  MODIFY `favourite_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `newsletter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `favourite_items`
--
ALTER TABLE `favourite_items`
  ADD CONSTRAINT `favourite_items_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourite_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`seller_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
