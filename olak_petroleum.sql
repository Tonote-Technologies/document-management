-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2022 at 08:04 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olak_petroleum`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_control`
--

CREATE TABLE `access_control` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `dashboard` varchar(50) NOT NULL,
  `users_mgt` varchar(50) NOT NULL,
  `product_mgt` varchar(191) NOT NULL,
  `sales_mgt` varchar(191) NOT NULL,
  `expenses_mgt` varchar(191) NOT NULL,
  `report_mgt` varchar(50) NOT NULL,
  `settings` varchar(50) NOT NULL,
  `filtering` varchar(50) NOT NULL,
  `created_by` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_control`
--

INSERT INTO `access_control` (`id`, `user_id`, `dashboard`, `users_mgt`, `product_mgt`, `sales_mgt`, `expenses_mgt`, `report_mgt`, `settings`, `filtering`, `created_by`, `created_at`, `deleted`) VALUES
(1, '2', '0', '0', '1', '1', '1', '1', '0', '1', '1', '2022-04-21 13:17:11', ''),
(2, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2022-04-21 13:58:19', ''),
(4, '3', '0', '0', '1', '1', '1', '0', '', '', '', '2022-05-25 15:25:30', ''),
(5, '5', '0', '0', '0', '1', '0', '0', '0', '0', '', '2022-05-25 15:25:55', ''),
(6, '4', '0', '0', '0', '1', '0', '0', '', '', '', '2022-05-25 15:26:07', ''),
(7, '6', '1', '0', '0', '1', '0', '1', '0', '0', '', '2022-05-26 12:34:00', ''),
(8, '7', '0', '0', '0', '1', '0', '0', '0', '0', '', '2022-05-26 13:29:16', ''),
(9, '8', '0', '0', '0', '1', '1', '1', '0', '0', '', '2022-05-26 13:44:22', ''),
(10, '9', '0', '0', '1', '1', '1', '1', '0', '0', '', '2022-05-26 17:55:53', '');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `full_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `profile_img` varchar(191) NOT NULL,
  `address` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `reset_password` varchar(2) NOT NULL DEFAULT '0',
  `admin_level` varchar(2) NOT NULL,
  `company_id` varchar(191) NOT NULL,
  `branch_id` varchar(191) NOT NULL,
  `status` varchar(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` varchar(5) DEFAULT NULL,
  `deleted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `full_name`, `email`, `phone`, `profile_img`, `address`, `hashed_password`, `reset_password`, `admin_level`, `company_id`, `branch_id`, `status`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(1, 'Admin Super', 'admin@gmail.com', '+1 (501) 243-1641', '85f5aed8f1484aa634e875c943756de7.jpg', 'Blanditiis pariatur', '$2y$10$THE0NiMs6E3ae1X2mNuqF.MKWUDTE8xrWe3EBPzXms9/zh2JBg/cW', '0', '1', '1', '1', '', '2022-04-15 12:16:35', '2022-04-15 12:16:35', '1', ''),
(2, 'Azeez Olugbaje', 'olugbaje488@gmail.com', '07066268526', '57e0a2ba95fc6a7a552f5eb01a2b6c3b.jpg', '', '$2y$10$fuVK62gXZHK6s.ojR3hK7OvX4RqH.UkE9UAgnzSkvxV/z4/3QObCu', '0', '2', '1', '2', '', '2022-04-15 13:01:39', '2022-04-15 13:01:39', '1', ''),
(3, 'Aderibigbe Mudasir', 'mudasir@gmail.com', '08052926623', '', 'Block 9 & 10, Abayomi Layout Alarere Ibadan Oyo State', '$2y$10$qkJ/ilPZYJoHoix15PQ2ieCe7UZdeJ/ZKV4AR6i1VLLXy34O16brq', '0', '3', '1', '2', '', '2022-05-25 14:54:40', '2022-05-25 14:54:40', '1', ''),
(4, 'Ismaila Sheriffdeen ', 'sheriffdeenismaila98@gmail.com', '08060436419', '', '31 Amuloko Idiose Ibadan  ', '$2y$10$ieH4uEdBEtHkyoYZORnTJeFLO528hpNHNN35oE05C9CIyVjAbNUVi', '0', '4', '1', '2', '', '2022-05-25 14:58:12', '2022-05-25 14:58:12', '1', ''),
(5, 'Abiodun Ambali', 'ambali@gmail.com', '08036877024', '', 'Zone 2 Jaloke Aba Alfa Olami Area Ibadan, Oyo State ', '$2y$10$uK0xIbQP9GQceivhhoEfLu6pv0Gusb8WkX1ECn02h3ut4eZER8hw6', '0', '4', '1', '2', '', '2022-05-25 15:00:25', '2022-05-25 15:00:25', '1', ''),
(6, 'Chairman', 'chairman@olak.com', '908394849', '', '', '$2y$10$BYNkmra.sTJDMwpYzb8aU.KXqSQug9JPE5M5QiMGtMFYApKjQ5Guu', '0', '7', '1', '3', '', '2022-05-26 12:30:51', '2022-05-26 12:30:51', '1', ''),
(7, 'Ibrahim Labaika2', 'ibrahimlabaika@gmail.com', '07068380484', '', '', '$2y$10$tY0eNhYkoey15F9TrLrPjOM951g0UWEDXP6qhTeL3hb7y5MFoUoiy', '0', '4', '1', '3', '', '2022-05-26 13:28:26', '2022-05-26 13:28:26', '1', ''),
(8, 'Fatai Abdulsalam', 'fatai@gmail.com', '09075433373', '', '', '$2y$10$3bgQCFpKe9aAzw/ZcVjBBO8leQqcT5B9TIDDuEqx5kswFhOhRywZG', '0', '3', '1', '3', '', '2022-05-26 13:42:37', '2022-05-26 13:42:37', '1', ''),
(9, 'Ibrahim Labaika', 'ibrahimlabaika360@gmail.com', '07068380484', '', '', '$2y$10$MlWBDcSMWzd2HpVTV0oQ7eU3WMoBRvX2CmNsbCkjZoIvhYDwwYwFi', '0', '2', '1', '3', '', '2022-05-26 17:55:23', '2022-05-26 17:55:23', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `established_in` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `company_id`, `name`, `address`, `city`, `state`, `established_in`, `created_at`, `deleted`) VALUES
(1, '1', 'Ilorin Usanda', 'Akerebiata Sobi Road', 'Ilorin', 'Kwara', '1996-08-29', '2022-04-14 15:46:08', ''),
(2, '1', 'Toll Gate Ibadan', 'Toll Gate Lagos Ibadan Express way', 'Ibadan', 'Oyo', '2005-09-01', '2022-04-15 13:11:47', ''),
(3, '1', 'A Division', 'Opp A Division Barrack, Ajase-Ipo Express Way Ilor', 'Ilorin', 'Kwara', '2000-01-25', '2022-05-25 20:17:11', '');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `user_id` varchar(5) DEFAULT NULL,
  `full_name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `reg_no` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `full_name`, `email`, `phone`, `name`, `address`, `reg_no`, `logo`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '1', 'Alhaji Ibrahim Olaiya', 'olak@integratedolak.com', '+1 (896) 452-1433', 'Olak Petroleum, Ilorin', 'New Yidi Road, Ilorin Kwara State', '1001123', 'acac8f28c0170eecd1da2db1d1433fd0.jpeg', '2022-04-14', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_sheet`
--

CREATE TABLE `data_sheet` (
  `id` int(11) NOT NULL,
  `product_id` varchar(5) NOT NULL,
  `open_stock` varchar(50) NOT NULL,
  `new_stock` varchar(50) NOT NULL,
  `total_stock` varchar(15) NOT NULL,
  `sales_in_ltr` varchar(15) NOT NULL,
  `expected_stock` varchar(15) NOT NULL,
  `actual_stock` varchar(15) NOT NULL,
  `over_or_short` varchar(15) NOT NULL,
  `exp_sales_value` varchar(15) NOT NULL,
  `cash_submitted` varchar(15) NOT NULL,
  `total_sales` varchar(15) NOT NULL,
  `total_value` varchar(15) NOT NULL,
  `grand_total_value` varchar(15) NOT NULL,
  `company_id` varchar(15) NOT NULL,
  `branch_id` varchar(15) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_sheet`
--

INSERT INTO `data_sheet` (`id`, `product_id`, `open_stock`, `new_stock`, `total_stock`, `sales_in_ltr`, `expected_stock`, `actual_stock`, `over_or_short`, `exp_sales_value`, `cash_submitted`, `total_sales`, `total_value`, `grand_total_value`, `company_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '1', '12000', '0', '12000', '7000', '', '5000', '', '', '6000', '', '', '', '1', '2', '3', '5', '2022-05-25', '2022-05-25 21:10:42', ''),
(2, '2', '5000', '0', '5000', '500', '4500', '4450', '-50', '82500', '20000', '', '', '', '1', '2', '3', '5', '2022-05-25', '2022-05-25 21:13:03', ''),
(3, '3', '3000', '0', '3000', '2000', '1000', '900', '-100', '330000', '16000', '', '', '', '1', '2', '3', '5', '2022-05-25', '2022-05-25 21:19:01', ''),
(4, '4', '10000', '0', '10000', '1000', '9000', '9000', '0', '165000', '27300', '', '', '', '1', '2', '3', '5', '2022-05-25', '2022-05-25 21:19:01', ''),
(5, '5', '2000', '0', '2000', '1434', '566', '600', '34', '236610', '56200', '', '', '', '1', '2', '3', '5', '2022-05-25', '2022-05-25 21:19:01', ''),
(6, '6', '6000', '0', '6000', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-25', '', ''),
(7, '7', '9000', '0', '9000', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-25', '', ''),
(8, '1', '9350', '0', '9350', '2345', '7005', '7005', '0', '386925', '136950', '', '', '', '1', '2', '1', '1', '2022-05-26', '2022-05-27 10:15:17', ''),
(9, '2', '12150', '0', '12150', '830', '11320', '11320', '0', '136950', '12900', '', '', '', '1', '2', '1', '1', '2022-05-26', '2022-05-27 10:15:52', ''),
(10, '3', '13500', '0', '13500', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-26', '', ''),
(11, '4', '850', '0', '850', '700', '150', '150', '0', '115500', '23500', '', '', '', '1', '2', '1', '1', '2022-05-26', '2022-05-27 10:16:21', ''),
(12, '5', '0', '0', '0', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-26', '', ''),
(13, '6', '15600', '0', '15600', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-26', '', ''),
(14, '7', '21250', '0', '21250', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-26', '', ''),
(16, '14', '500', '15000', '15500', '', '', '', '', '', '', '', '', '', '1', '3', '8', '', '2022-05-26', '', ''),
(17, '15', '13300', '0', '13300', '', '', '', '', '', '', '', '', '', '1', '3', '8', '', '2022-05-26', '', ''),
(18, '16', '350', '8150', '8500', '', '', '', '', '', '', '', '', '', '1', '3', '8', '', '2022-05-26', '', ''),
(19, '17', '13550', '0', '13550', '', '', '', '', '', '', '', '', '', '1', '3', '8', '', '2022-05-26', '', ''),
(20, '18', '13650', '0', '13650', '', '', '', '', '', '', '', '', '', '1', '3', '8', '', '2022-05-26', '', ''),
(21, '19', '8000', '0', '8000', '', '', '', '', '', '', '', '', '', '1', '3', '8', '', '2022-05-26', '', ''),
(22, '20', '150', '0', '150', '', '', '', '', '', '', '', '', '', '1', '3', '8', '', '2022-05-26', '', ''),
(23, '7', '5900', '0', '5900', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-27', '', ''),
(24, '8', '10650', '0', '10650', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-27', '', ''),
(25, '9', '11750', '0', '11750', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-27', '', ''),
(26, '10', '650', '0', '650', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-27', '', ''),
(27, '11', '5900', '0', '', '', '', '', '', '', '', '', '', '', '1', '2', '3', '', '2022-05-27', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `company_id` varchar(191) DEFAULT NULL,
  `branch_id` varchar(191) DEFAULT NULL,
  `expense_type` varchar(191) NOT NULL,
  `product` varchar(191) NOT NULL,
  `quantity` varchar(191) NOT NULL,
  `amount` varchar(191) NOT NULL,
  `narration` varchar(255) NOT NULL,
  `created_by` varchar(191) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `tank` varchar(5) NOT NULL,
  `rate` varchar(191) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `tank`, `rate`, `branch_id`, `created_at`, `deleted`) VALUES
(1, 'PMS', '1', '165', 1, '2022-04-13 18:18:38', ''),
(2, 'PMS', '2', '165', 1, '2022-04-13 18:18:47', ''),
(3, 'PMS', '3', '165', 1, '2022-04-13 18:18:55', ''),
(4, 'PMS', '4', '165', 1, '2022-04-13 18:19:06', ''),
(5, 'DPK', '5', '620', 1, '2022-04-13 18:19:23', ''),
(6, 'AGO', '6', '700', 1, '2022-04-13 18:19:52', ''),
(7, 'PMS', '1', '165', 2, '2022-04-13 18:18:38', ''),
(8, 'PMS', '2', '165', 2, '2022-04-13 18:18:47', ''),
(9, 'PMS', '3', '165', 2, '2022-04-13 18:18:55', ''),
(10, 'PMS', '4', '165', 2, '2022-04-13 18:19:06', ''),
(11, 'AGO', '5', '700', 2, '2022-04-13 18:19:23', ''),
(12, 'AGO', '6', '700', 2, '2022-04-13 18:19:52', ''),
(13, 'PMS', '1', '165', 3, '2022-04-13 18:18:38', ''),
(14, 'PMS', '2', '165', 3, '2022-04-13 18:18:47', ''),
(15, 'PMS', '3', '165', 3, '2022-04-13 18:18:55', ''),
(16, 'PMS', '4', '165', 3, '2022-04-13 18:19:06', ''),
(17, 'PMS', '5', '165', 3, '2022-04-13 18:19:23', ''),
(18, 'PMS', '6', '165', 3, '2022-04-13 18:19:52', ''),
(19, 'AGO', '7', '700', 3, '2022-04-13 18:20:02', ''),
(20, 'DPK', '8', '620', 3, '2022-04-13 18:20:17', '');

-- --------------------------------------------------------

--
-- Table structure for table `remittance`
--

CREATE TABLE `remittance` (
  `id` int(11) NOT NULL,
  `rate` varchar(191) NOT NULL,
  `quantity` varchar(191) NOT NULL,
  `amount` varchar(191) NOT NULL,
  `narration` varchar(255) NOT NULL,
  `created_by` varchar(5) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_control`
--
ALTER TABLE `access_control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_sheet`
--
ALTER TABLE `data_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remittance`
--
ALTER TABLE `remittance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_control`
--
ALTER TABLE `access_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_sheet`
--
ALTER TABLE `data_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `remittance`
--
ALTER TABLE `remittance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
