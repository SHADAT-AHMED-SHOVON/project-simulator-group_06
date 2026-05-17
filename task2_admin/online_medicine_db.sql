

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE DATABASE IF NOT EXISTS `online_medicine_db`;
USE `online_medicine_db`;



CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
)



INSERT INTO `cart` (`id`, `user_id`, `medicine_id`, `quantity`, `added_at`) VALUES
(2, 5, 9, 2, '2026-05-16 14:21:01');

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_type` enum('liquid','solid') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
)

INSERT INTO `categories` (`id`, `name`, `category_type`, `created_at`) VALUES
(1, 'Tablet', 'solid', '2026-05-16 12:56:28'),
(2, 'Syrup', 'liquid', '2026-05-16 12:56:28'),
(3, 'Capsule', 'solid', '2026-05-16 12:56:28'),
(4, 'Cream', 'liquid', '2026-05-16 14:23:48');

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) 

INSERT INTO `medicines` (`id`, `name`, `category_id`, `vendor_name`, `price`, `availability`, `description`, `image_path`, `created_at`) VALUES
(1, 'Napa Extra 500mg', 1, 'Beximco Pharma', 2.50, 500, 'Paracetamol and Caffeine', NULL, '2026-05-16 12:56:28'),
(2, 'Seclo 20mg', 3, 'Square Pharma', 5.00, 300, 'Omeprazole capsule', NULL, '2026-05-16 12:56:28'),
(3, 'Maxpro 20mg', 1, 'Renata Limited', 6.00, 400, 'Esomeprazole tablet', NULL, '2026-05-16 12:56:28'),
(4, 'Fexo 120mg', 1, 'Square Pharma', 8.00, 200, 'Fexofenadine tablet', NULL, '2026-05-16 12:56:28'),
(5, 'Tofen Syrup', 2, 'Beximco Pharma', 45.00, 50, 'Ketotifen syrup', NULL, '2026-05-16 12:56:28'),
(6, 'Losectil 20mg', 3, 'Eskayef Pharma', 5.50, 250, 'Omeprazole capsule', NULL, '2026-05-16 12:56:28'),
(7, 'Napa Syrup', 2, 'Beximco Pharma', 35.00, 100, 'Paracetamol syrup', NULL, '2026-05-16 12:56:28'),
(8, 'Monas 10mg', 1, 'ACME Laboratories', 15.00, 150, 'Montelukast tablet', NULL, '2026-05-16 12:56:28'),
(9, 'Ceevit 250mg', 1, 'Square Pharma', 1.50, 1000, 'Vitamin C chewable tablet', NULL, '2026-05-16 12:56:28'),
(10, 'Alatrol 10mg', 1, 'Square Pharma', 3.00, 500, 'Cetirizine tablet', NULL, '2026-05-16 12:56:28'),
(11, 'Sergel 20mg', 3, 'Healthcare Pharmaceuticals', 7.00, 300, 'Esomeprazole capsule', NULL, '2026-05-16 13:00:02'),
(12, 'Pantonix 20mg', 1, 'Incepta Pharmaceuticals', 5.00, 400, 'Pantoprazole tablet', NULL, '2026-05-16 13:00:02'),
(13, 'Cef-3 250mg', 3, 'Square Pharmaceuticals', 25.00, 150, 'Cefixime capsule', NULL, '2026-05-16 13:00:02'),
(14, 'Calbo D', 1, 'Square Pharmaceuticals', 3.00, 600, 'Calcium and Vitamin D3 tablet', NULL, '2026-05-16 13:00:02'),
(15, 'Finix 20mg', 1, 'Opsonin Pharma', 5.00, 350, 'Rabeprazole tablet', NULL, '2026-05-16 13:00:02'),
(16, 'Bextram Gold', 1, 'Beximco Pharma', 4.00, 500, 'Multivitamin tablet', NULL, '2026-05-16 13:00:02'),
(17, 'Xinc Syrup', 2, 'Square Pharmaceuticals', 45.00, 100, 'Zinc Sulfate syrup', NULL, '2026-05-16 13:00:02'),
(18, 'Ace 500mg', 1, 'Square Pharmaceuticals', 1.20, 1000, 'Paracetamol tablet', NULL, '2026-05-16 13:00:02'),
(19, 'Rolac 10mg', 1, 'Renata Limited', 4.00, 250, 'Ketorolac tromethamine tablet', NULL, '2026-05-16 13:00:02'),
(20, 'Neuro-B', 1, 'Square Pharmaceuticals', 3.50, 450, 'Vitamin B1, B6 & B12 tablet', NULL, '2026-05-16 13:00:02'),
(21, 'Neotack 150mg', 1, 'Square Pharmaceuticals', 2.00, 500, 'Ranitidine tablet', NULL, '2026-05-16 13:00:02'),
(22, 'Ecosprin 75mg', 1, 'ACME Laboratories', 1.00, 800, 'Aspirin tablet', NULL, '2026-05-16 13:00:02'),
(23, 'Bizoran 5/20', 1, 'Incepta Pharmaceuticals', 10.00, 200, 'Amlodipine and Olmesartan tablet', NULL, '2026-05-16 13:00:02'),
(24, 'Rabe-20', 1, 'Beximco Pharma', 5.00, 300, 'Rabeprazole tablet', NULL, '2026-05-16 13:00:02'),
(25, 'Moxacil 500mg', 3, 'Square Pharmaceuticals', 12.00, 400, 'Amoxicillin capsule', NULL, '2026-05-16 13:00:02'),
(26, 'Emistat 8mg', 1, 'Incepta Pharmaceuticals', 6.00, 150, 'Ondansetron tablet', NULL, '2026-05-16 13:00:02'),
(27, 'Telfast 120mg', 1, 'Sanofi Bangladesh', 9.00, 200, 'Fexofenadine tablet', NULL, '2026-05-16 13:00:02'),
(28, 'Flexi 50mg', 1, 'Square Pharmaceuticals', 2.00, 500, 'Diclofenac sodium tablet', 'med_1778940839.jpg', '2026-05-16 13:00:02'),
(29, 'Azithrocin 500mg', 1, 'Square Pharmaceuticals', 35.00, 100, 'Azithromycin tablet', NULL, '2026-05-16 13:00:02'),
(30, 'Entacyd Plus', 2, 'Incepta Pharmaceuticals', 60.00, 80, 'Antacid suspension', 'med_1778940748.jpg', '2026-05-16 13:00:02'),
(32, 'Freshlook', 4, 'Ziska', 150.00, 30, 'For Acne removal', 'med_1778941492.jpg', '2026-05-16 14:24:52');

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `shipping_address` text NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) 



INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `shipping_address`, `status`, `payment_method`, `order_date`) VALUES
(2, 4, 45.00, 'Banani, Dhaka', 'accepted', 'Credit Card', '2026-05-16 14:21:01'),


CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
)

INSERT INTO `order_items` (`id`, `order_id`, `medicine_id`, `quantity`, `unit_price`) VALUES
(1, 1, 1, 2, 2.50),
(2, 1, 2, 1, 10.50),
(3, 2, 5, 1, 45.00),
(4, 3, 3, 2, 6.00),
(5, 4, 7, 5, 30.00);


CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
)

INSERT INTO `payments` (`id`, `order_id`, `amount`, `payment_method`, `transaction_id`, `payment_date`) VALUES
(1, 1, 15.50, 'bKash', 'TXN123456789', '2026-05-16 14:21:01'),
(2, 2, 45.00, 'Credit Card', 'CARD987654321', '2026-05-16 14:21:01');



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
)

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `profile_picture`, `address`, `phone`, `created_at`) VALUES
(2, 'SHADAT AHMED SHOVON', 'shadatashovon16@gmail.com', '$2y$10$aiznz.w8OgLMXFwoT9XxZ.DEJrqwdiZDa6qH.xHkasxsOEiREQQre', 'admin', 'user_2_1778935558.jpg', 'nikunja-2', '01903228201', '2026-05-16 12:38:44'),
(4, 'Karim Hossain', 'karim@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, 'Banani, Dhaka', '01811000002', '2026-05-16 14:21:01'),
(5, 'Sadia Akter', 'sadia@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, 'Mirpur, Dhaka', '01911000003', '2026-05-16 14:21:01'),
(6, 'Rafiqul Islam', 'rafiq@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, 'Uttara, Dhaka', '01511000004', '2026-05-16 14:21:01'),
(7, 'Nusrat Jahan', 'nusrat@hotmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', NULL, 'Gulshan, Dhaka', '01611000005', '2026-05-16 14:21:01');


ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `medicines`
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
