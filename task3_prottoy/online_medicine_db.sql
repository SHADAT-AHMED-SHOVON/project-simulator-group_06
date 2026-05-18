-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2026 at 12:46 PM
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
-- Database: `online_medicine_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `medicine_id`, `quantity`, `added_at`) VALUES
(2, 5, 9, 2, '2026-05-16 14:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_type` enum('liquid','solid') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `category_type`, `created_at`) VALUES
(1, 'Tablet', 'solid', '2026-05-16 12:56:28'),
(2, 'Syrup', 'liquid', '2026-05-16 12:56:28'),
(3, 'Capsule', 'solid', '2026-05-16 12:56:28'),
(4, 'Cream', 'liquid', '2026-05-16 14:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `category_id`, `vendor_name`, `price`, `availability`, `description`, `image_path`, `created_at`) VALUES
(1, 'Napa Extra 500mg', 1, 'Beximco Pharma', 2.50, 500, 'Paracetamol and Caffeine', 'med_1778968056.jpg', '2026-05-16 12:56:28'),
(2, 'Seclo 20mg', 3, 'Square Pharma', 5.00, 300, 'Omeprazole capsule', 'med_1778968077.jpg', '2026-05-16 12:56:28'),
(3, 'Maxpro 20mg', 1, 'Renata Limited', 6.00, 400, 'Esomeprazole tablet', 'med_1778968094.jpg', '2026-05-16 12:56:28'),
(4, 'Fexo 120mg', 1, 'Square Pharma', 8.00, 200, 'Fexofenadine tablet', 'med_1778968111.jpg', '2026-05-16 12:56:28'),
(5, 'Tofen Syrup', 2, 'Beximco Pharma', 45.00, 50, 'Ketotifen syrup', 'med_1778968386.jpg', '2026-05-16 12:56:28'),
(6, 'Losectil 20mg', 3, 'Eskayef Pharma', 5.50, 250, 'Omeprazole capsule', 'med_1778968154.jpg', '2026-05-16 12:56:28'),
(7, 'Napa Syrup', 2, 'Beximco Pharma', 35.00, 100, 'Paracetamol syrup', 'med_1778968300.jpg', '2026-05-16 12:56:28'),
(8, 'Monas 10mg', 1, 'ACME Laboratories', 15.00, 149, 'Montelukast tablet', 'med_1778968270.jpg', '2026-05-16 12:56:28'),
(9, 'Ceevit 250mg', 1, 'Square Pharma', 1.50, 999, 'Vitamin C chewable tablet', 'med_1778968249.jpg', '2026-05-16 12:56:28'),
(10, 'Alatrol 10mg', 1, 'Square Pharma', 3.00, 499, 'Cetirizine tablet', 'med_1778968228.jpg', '2026-05-16 12:56:28'),
(11, 'Sergel 20mg', 3, 'Healthcare Pharmaceuticals', 7.00, 299, 'Esomeprazole capsule', 'med_1778968204.jpg', '2026-05-16 13:00:02'),
(12, 'Pantonix 20mg', 1, 'Incepta Pharmaceuticals', 5.00, 399, 'Pantoprazole tablet', 'med_1778968185.jpg', '2026-05-16 13:00:02'),
(13, 'Cef-3 250mg', 3, 'Square Pharmaceuticals', 25.00, 149, 'Cefixime capsule', 'med_1778968171.jpg', '2026-05-16 13:00:02'),
(14, 'Calbo D', 1, 'Square Pharmaceuticals', 3.00, 599, 'Calcium and Vitamin D3 tablet', 'med_1778968028.jpg', '2026-05-16 13:00:02'),
(15, 'Finix 20mg', 1, 'Opsonin Pharma', 5.00, 350, 'Rabeprazole tablet', 'med_1778968006.jpg', '2026-05-16 13:00:02'),
(16, 'Bextram Gold', 1, 'Beximco Pharma', 4.00, 499, 'Multivitamin tablet', 'med_1778967984.jpg', '2026-05-16 13:00:02'),
(17, 'Xinc Syrup', 2, 'Square Pharmaceuticals', 45.00, 95, 'Zinc Sulfate syrup', 'med_1778967955.jpg', '2026-05-16 13:00:02'),
(18, 'Ace 500mg', 1, 'Square Pharmaceuticals', 1.20, 1000, 'Paracetamol tablet', 'med_1778967919.jpg', '2026-05-16 13:00:02'),
(19, 'Rolac 10mg', 1, 'Renata Limited', 4.00, 250, 'Ketorolac tromethamine tablet', 'med_1778967889.jpg', '2026-05-16 13:00:02'),
(20, 'Neuro-B', 1, 'Square Pharmaceuticals', 3.50, 446, 'Vitamin B1, B6 & B12 tablet', 'med_1778967864.jpg', '2026-05-16 13:00:02'),
(21, 'Neotack 150mg', 1, 'Square Pharmaceuticals', 2.00, 496, 'Ranitidine tablet', 'med_1778967844.jpg', '2026-05-16 13:00:02'),
(22, 'Ecosprin 75mg', 1, 'ACME Laboratories', 1.00, 800, 'Aspirin tablet', 'med_1778967798.jpg', '2026-05-16 13:00:02'),
(23, 'Bizoran 5/20', 1, 'Incepta Pharmaceuticals', 10.00, 200, 'Amlodipine and Olmesartan tablet', 'med_1778967692.jpg', '2026-05-16 13:00:02'),
(24, 'Rabe-20', 1, 'Beximco Pharma', 5.00, 300, 'Rabeprazole tablet', 'med_1778967667.jpg', '2026-05-16 13:00:02'),
(25, 'Moxacil 500mg', 3, 'Square Pharmaceuticals', 12.00, 392, 'Amoxicillin capsule', 'med_1778967620.jpg', '2026-05-16 13:00:02'),
(26, 'Emistat 8mg', 1, 'Incepta Pharmaceuticals', 6.00, 149, 'Ondansetron tablet', 'med_1778968417.jpg', '2026-05-16 13:00:02'),
(27, 'Telfast 120mg', 1, 'Sanofi Bangladesh', 9.00, 200, 'Fexofenadine tablet', 'med_1778967509.jpg', '2026-05-16 13:00:02'),
(28, 'Flexi 50mg', 1, 'Square Pharmaceuticals', 2.00, 495, 'Diclofenac sodium tablet', 'med_1778940839.jpg', '2026-05-16 13:00:02'),
(29, 'Azithrocin 500mg', 1, 'Square Pharmaceuticals', 35.00, 95, 'Azithromycin tablet', 'med_1778967467.jpg', '2026-05-16 13:00:02'),
(30, 'Entacyd Plus', 2, 'Incepta Pharmaceuticals', 60.00, 81, 'Antacid suspension', 'med_1778968488.jpg', '2026-05-16 13:00:02'),
(32, 'Freshlook', 4, 'Ziska', 150.00, 29, 'For Acne removal', 'med_1778941492.jpg', '2026-05-16 14:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_address` text NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `shipping_address`, `status`, `payment_method`, `order_date`) VALUES
(1, 10, 60.00, 'sefserf', 'pending', 'Nagad', '2026-05-17 10:40:15'),
(2, 10, 60.00, 'dfgbdf', 'rejected', 'Credit Card', '2026-05-17 10:40:33'),
(3, 10, 35.00, 'dfgbhd', 'accepted', 'Nagad', '2026-05-17 10:40:45'),
(4, 10, 60.00, 'gth', 'rejected', 'Credit Card', '2026-05-17 10:41:14'),
(5, 11, 49.00, 'mew', 'accepted', 'Nagad', '2026-05-17 10:44:48'),
(6, 11, 59.50, 'sfgsrdf', 'rejected', 'Credit Card', '2026-05-17 10:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `medicine_id`, `quantity`, `unit_price`) VALUES
(1, 1, 30, 1, 60.00),
(2, 2, 30, 1, 60.00),
(3, 3, 29, 1, 35.00),
(4, 4, 30, 1, 60.00),
(5, 5, 17, 1, 45.00),
(6, 5, 16, 1, 4.00),
(7, 6, 14, 1, 3.00),
(8, 6, 13, 1, 25.00),
(9, 6, 12, 1, 5.00),
(10, 6, 8, 1, 15.00),
(11, 6, 9, 1, 1.50),
(12, 6, 10, 1, 3.00),
(13, 6, 11, 1, 7.00);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `amount`, `payment_method`, `transaction_id`, `payment_date`) VALUES
(1, 1, 60.00, 'Nagad', 'TXN17790144153496', '2026-05-17 10:40:15'),
(2, 2, 60.00, 'Credit Card', 'TXN17790144334162', '2026-05-17 10:40:33'),
(3, 3, 35.00, 'Nagad', 'TXN17790144455140', '2026-05-17 10:40:45'),
(4, 4, 60.00, 'Credit Card', 'TXN17790144742883', '2026-05-17 10:41:14'),
(5, 5, 49.00, 'Nagad', 'TXN17790146882620', '2026-05-17 10:44:48'),
(6, 6, 59.50, 'Credit Card', 'TXN17790147425011', '2026-05-17 10:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `profile_picture`, `address`, `phone`, `created_at`) VALUES
(2, 'SHADAT AHMED SHOVON', 'shadatashovon16@gmail.com', '$2y$10$aiznz.w8OgLMXFwoT9XxZ.DEJrqwdiZDa6qH.xHkasxsOEiREQQre', 'admin', 'user_2_1779000248.jpg', 'nikunja-2', '01903228201', '2026-05-16 12:38:44'),
(4, 'Karim Hossain', 'karim@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, 'Banani, Dhaka', '01811000002', '2026-05-16 14:21:01'),
(5, 'Sadia Akter', 'sadia@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, 'Mirpur, Dhaka', '01911000003', '2026-05-16 14:21:01'),
(6, 'Rafiqul Islam', 'rafiq@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, 'Uttara, Dhaka', '01511000004', '2026-05-16 14:21:01'),
(7, 'Nusrat Jahan', 'nusrat@hotmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, 'Gulshan, Dhaka', '01611000005', '2026-05-16 14:21:01'),
(10, 'kawsar habib', 'kawsar@gmail.com', '$2y$10$WXOwU.vsE/lRkhMFGAoNHufKtT/OOdMNPqVUIL4tuoLcsbltaoLie', 'customer', 'user_10_1778957853.png', 'Pabna', '01900221678', '2026-05-16 18:52:30'),
(11, 'yousuf', 'yousuf@gmail.com', '$2y$10$RtiY4e7DvnOHfvrbiWnTyOUMQDPES1lNEnJw21KW9KdwowYSZWaYO', 'customer', NULL, 'jessore', '01866555655', '2026-05-17 10:44:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicines`
--
ALTER TABLE `medicines`
  ADD CONSTRAINT `medicines_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
