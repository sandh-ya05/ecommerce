-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 08:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123'),
(2, 'sandhya', 'san@gmail.com', 'san123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(2, 9999.99, 'pending', 1, 2147483647, 'ktm', 'ktm', '2024-12-19 11:04:22'),
(3, 9999.99, 'on_hold', 1, 232, 'ktm', 'ktm', '2024-12-19 11:05:56'),
(4, 2000.00, 'on_hold', 1, 232, 'ktm', 'ktm', '2024-12-19 12:46:02'),
(5, 2000.00, 'on_hold', 1, 232, 'ktm', 'ktm', '2024-12-21 03:27:17'),
(6, 2000.00, 'on_hold', 7, 232, 'ktm', 'ktm', '2024-12-21 09:16:21'),
(7, 9999.99, 'on_hold', 6, 232, 'ktm', 'ktm', '2024-12-21 14:07:35'),
(8, 9999.99, 'on_hold', 6, 0, 'ktm', 'ktm', '2024-12-21 14:21:00'),
(9, 2000.00, 'on_hold', 6, 232, 'ktm', 'ktm', '2024-12-22 06:22:02'),
(10, 2000.00, 'paid', 8, 232, 'ktm', 'ktm', '2024-12-22 07:05:26'),
(11, 2000.00, 'on_hold', 9, 232, 'ktm', 'ktm', '2024-12-22 14:50:50'),
(12, 20.00, 'paid', 6, 232, 'ktm', 'ktm', '2024-12-22 18:24:09'),
(13, 20.00, 'on_hold', 11, 1234, 'ktm', 'ktm', '2024-12-22 18:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,0) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 4, '3', 'Hand Bags', 'handbag.jpg', 20, 1, 1, '2024-12-19 12:46:02'),
(2, 5, '2', 'School Bag', 'schoolbag.jpg', 2000, 1, 1, '2024-12-21 03:27:17'),
(3, 6, '3', 'Hand Bag', 'handbag.jpg', 2000, 1, 7, '2024-12-21 09:16:21'),
(4, 7, '4', 'Trolly Bag', 'suitcase.jpg', 10000, 1, 6, '2024-12-21 14:07:35'),
(5, 7, '8', 'Prada Bag', 'pradabag.jpg', 5000, 1, 6, '2024-12-21 14:07:35'),
(6, 8, '4', 'Trolly Bag', 'suitcase.jpg', 10000, 1, 6, '2024-12-21 14:21:00'),
(7, 8, '8', 'Prada Bag', 'pradabag.jpg', 5000, 1, 6, '2024-12-21 14:21:00'),
(8, 9, '3', 'Hand Bag', 'handbag.jpg', 2000, 1, 6, '2024-12-22 06:22:02'),
(9, 10, '2', 'School Bag', 'schoolbag.jpg', 2000, 1, 8, '2024-12-22 07:05:26'),
(10, 11, '2', 'School Bag', 'schoolbag.jpg', 2000, 1, 9, '2024-12-22 14:50:50'),
(11, 12, '2', 'School Bag', 'schoolbag.jpg', 20, 1, 6, '2024-12-22 18:24:09'),
(12, 13, '2', 'School Bag', 'schoolbag.jpg', 20, 1, 11, '2024-12-22 18:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`) VALUES
(1, 10, 8, '13'),
(2, 10, 8, '4'),
(3, 12, 6, '55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(108) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_image4` varchar(255) DEFAULT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) DEFAULT NULL,
  `product_color` varchar(108) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(2, 'School Bag', 'bags', 'Trendy School Bags', 'schoolbag.jpg', 'schoolbag.jpg', 'schoolbag.jpg', 'schoolbag.jpg', 20.00, 0, 'black'),
(3, 'Hand Bag', 'bags', 'Trendy Hand Bags', 'handbag.jpg', 'handbag.jpg', 'handbag.jpg', 'handbag.jpg', 2000.00, 0, 'black'),
(4, 'Trolly Bag', 'bags', 'Trendy Trolly Bags', 'suitcase.jpg', 'suitcase.jpg', 'suitcase.jpg', 'suitcase.jpg', 9999.99, 0, 'black'),
(5, 'Treaking Bag', 'bags', 'Trendy Treaking Bags', 'treaking.jpeg', 'treaking.jpeg', 'treaking.jpeg', 'treaking.jpeg', 8000.00, 0, 'black'),
(6, 'Chanel Bag', 'branded', 'Trendy Chanel Bags', 'chanelbag.jpg', 'chanelbag.jpg', 'chanelbag.jpg', 'chanelbag.jpg', 9999.99, 0, 'black'),
(7, 'Coach Bag', 'branded', 'Trendy Coach Bags', 'coachbag.jpg', 'coachbag.jpg', 'coachbag.jpg', 'coachbag.jpg', 9000.00, 0, 'black'),
(8, 'Prada Bag', 'branded', 'Trendy Prada Bags', 'pradabag.jpg', 'pradabag.jpg', 'pradabag.jpg', 'pradabag.jpg', 5000.00, 0, 'black'),
(9, 'Gucci Bag', 'branded', 'Trendy Gucci Bags', 'guccibag.jpeg', 'guccibag.jpeg', 'guccibag.jpg', 'guccibag.jpg', 9999.99, 0, 'black'),
(10, 'Tote Bag', 'ladies', 'Trendy Tote Bags', 'toteladies.jpeg', 'toteladies.jpeg', 'toteladies.jpg', 'toteladies.jpg', 700.00, 0, 'black'),
(11, 'Hobo Bag', 'ladies', 'Trendy Hobo Bags', 'hoboladies.jpeg', 'hoboladies.jpeg', 'hoboladies.jpg', 'hoboladies.jpg', 2700.00, 0, 'black'),
(12, 'Briefcase Bag', 'men', 'Trendy Briefcase Bags', 'briefcase.jpeg', 'briefcase.jpeg', 'briefcase.jpg', 'briefcase.jpg', 9999.99, 0, 'black'),
(13, 'Duffle Bag', 'men', 'Trendy Duffle Bags', 'duffle.jpg', 'duffle.jpg', 'duffle.jpg', 'duffle.jpg', 7000.00, 0, 'black');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(108) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(4, 'Sandhya Gharti', 'sandhya.26204@trinity.edu.np', 'c83b2d5bb1fb4d93d9d064593ed6eea2'),
(5, 'Sandhya Gharti', 'sam@gmail.com', 'e86fdc2283aff4717103f2d44d0610f7'),
(6, 'Sandhya Gharti', 'sad@gmail.com', '$2y$10$a7TUs9GnpWauIy5tUk/x7OuidAUW7i6WAcQTLbtej3KRirf2E9oOO'),
(7, 'Sandhya Gharti', 'sab@gmail.com', '$2y$10$GRxI4sAYsamldZpP9X/CA.r77hhjF7SAatd.AsVAglwOQPYE.7It.'),
(8, 'test', 'test@gmail.com', '$2y$10$RqLzokziOHG7i6DWtypM7.WlAkeI6jvBbOyr8qla55mnhJYyISyiO'),
(9, 'samyog', 'samu@123', '$2y$10$WDx0J3xohS2s.XvgaGKeruqdK9OebWo1F1HigcXeQNihhCz5gxKuu'),
(10, 'Sandy', 'sandy@gmail.com', '$2y$10$DpiS.6BoYK8oxtABolJ9IO7V3FhNsldlBdJSpwzq8jk6PKlqJhtnu'),
(11, 'Ram', 'ram@gmail.com', '$2y$10$3OuvOlJIzTxsMqvT4BrRD.gGt3XnhSVwFUvgdw7Vsp8lwWDiLDULG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
