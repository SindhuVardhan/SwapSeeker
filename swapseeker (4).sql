-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 02:39 PM
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
-- Database: `swapseeker`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_product`
--

CREATE TABLE `add_product` (
  `id` int(250) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `product_age` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(255) NOT NULL,
  `contact_way` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `sell_rent` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `visibility` varchar(200) NOT NULL DEFAULT '1',
  `report_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_product`
--

INSERT INTO `add_product` (`id`, `product_name`, `category`, `product_age`, `price`, `description`, `image_name`, `name`, `email`, `phone`, `contact_way`, `location`, `sell_rent`, `qty`, `user_id`, `visibility`, `report_count`) VALUES
(60, 'iPhone 15 pro max 256Gb', 'SmartPhones', '1 year', '1,25,000', 'it is new product ', '1706325363_1702268468_1698635600_15.png,1706325363_1702268468_1698635600_15p1.png,1706325363_1702268468_1698635600_15p2.png,1706325363_1702268468_1698635600_15p3.png', 'sindhu', 'Sindhu38@gmail.com', 9390300842, 'Via Phone', 'tirupati', 'sell', 0, 47, '1', 0),
(61, 'Croma Washing Machine', 'HomeAppliances', '3 years', '23,000', 'well working in condition.Clean and neat', '1706325586_1700474939_243593_0_ekqohu.webp,1706325586_1700474939_243593_1_eadlxf.webp,1706325586_1700474939_243593_10_lq3srk.webp,1706325586_1700474939_243593_12_gtsywj.webp', 'SindhuVardhan', 'SindhuVardhan333@gmail.com', 9398467191, 'Via Phone', 'tirupati', 'sell', 0, 48, '1', 0),
(62, 'Dji mavic air 2022', 'Electronics', '2 years', '59,000', 'super powerful well working drone', '1706325693_1702280312_1700455485_d1.png,1706325693_1702280312_1700455485_d2.png,1706325693_1702280312_1700455485_d4.png', 'SindhuVardhan', 'SindhuVardhan333@gmail.com', 9398467191, 'Via Phone', 'tirupati', 'sell', 0, 48, '0', 0),
(64, 'Canon EOS R10 24.2MP Mirrorless Camera', 'Cameras', '2 years', '95,000', 'it is clean and good working.', '1706935084_cam p1.png,1706935084_camp4.png,1706935084_camp2.png,1706935084_camp3.png', 'SindhuVardhan', 'SindhuVardhan333@gmail.com', 9398467191, 'Via Phone', 'tirupati', 'sell', 0, 47, '1', 0),
(65, 'SONY PlayStation 5 ', 'Gaming', '2 years', '45,000', 'Console Type: Gaming Console\r\nConsole Functions: Gaming | Audio Player | Streaming\r\nDualSense Wireless Controller', '1706935295_ps51.webp,1706935295_ps52.webp,1706935295_ps4.webp,1706935295_ps53.webp', 'SindhuVardhan', 'SindhuVardhan333@gmail.com', 9398467191, 'Via Phone', 'tirupati', 'sell', 0, 47, '1', 0),
(66, 'Mahindra Thar', 'AutoMobiles', '1 year', '10,000/month', 'The Mahindra Thar SUV’s 4x4 variants get a new colour option, Everest White, that was previously only offered on the 2WD variant. With that, the 4x4 model gets a total of five colour options – Napoli Black, Red Rage, Galaxy Grey, Aquamarine and Everest White.\r\n\r\nThe rear-wheel-drive Thar continues to get a total of six colour options, including the Blazing Bronze shade that’s exclusive to the 2WD model.', '1706935610_car1.webp,1706935610_car2.webp,1706935610_car3.webp,1706935610_car4.webp', 'devi', 'devi@gmail.com', 6325487547, 'phone', 'chennai', 'rent', 0, 65, '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `name`, `email`, `phone`, `address_1`, `address_2`, `country`, `city`, `state`) VALUES
(1, 'SindhuVardhan', 'SindhuVardhan333@gmail.com', 9398467191, 'railway koduru', 'koduru', 'India', 'Cuddapah', 'Andhra Pradesh'),
(2, 'Pedda kathi sindhu vardhan', 'SindhuVardhan38@Gmail.com', 919390300843, 'railway koduru', 'koduru', 'India', 'Cuddapah', 'India ‏(‎+91)');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `productid` int(50) NOT NULL,
  `userid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `productid`, `userid`) VALUES
(133, 16, 23),
(185, 34, 26),
(198, 41, 29),
(203, 37, 30),
(204, 40, 30),
(248, 55, 50),
(252, 60, 65),
(253, 65, 66);

-- --------------------------------------------------------

--
-- Table structure for table `product_reports`
--

CREATE TABLE `product_reports` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reports`
--

INSERT INTO `product_reports` (`id`, `product_id`, `user_id`, `reason`, `report_date`) VALUES
(1, 65, 47, 'fake product', '2024-02-26 13:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `conpassword` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `username`, `email`, `phone`, `password`, `conpassword`, `image`, `user_role`) VALUES
(47, 'SindhuVardhan', 's@gmail.com', 9390300842, '1', '', 'uploads/65d0c646010fb_photo.jpg', 'user'),
(48, 'sindhu', 'sindhu@gmail.com', 9390300842, 's1234', '', '', 'user'),
(51, 'ss', 'ss@gmail.com', 0, '$2y$10$Pv3zhtXLKe1XcDBCL8wLjuRyM/zP0tKM22jSa6jEobC', '', '', 'user'),
(61, 'azam', 'azam1@gmail.com', 1234, '202cb962ac59075b964b07152d234b70', '', '', 'user'),
(62, 'sindhu', 'sindhu@gmail.com', 9390300843, '3dfae9d68590fef9704a6a3ddabe6313', '', '', 'user'),
(63, 'Shaik MD Azam', 'azam2@gmail.com', 2588, 'c20ad4d76fe97759aa27a0c99bff6710', '', '', 'user'),
(64, '', '', 0, '$2y$10$.o0cJTf8zXeE.MT4c/bhkuNzJAVUaKhXzTmQjjeooj5', '', '', 'user'),
(65, 'devi', 'devi@gmail.com', 6325487547, 'devi12', '', '', 'user'),
(66, 'SSE', 'see@gmail.com', 9874577845, 'sse123', '', '', 'user'),
(68, 'admin', 'admin@gmail.com', 9898788457, 'sindhu123', 'sindhu123', 'admin_image', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_image` varchar(250) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `purpose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`, `category_image`, `sub_category`, `purpose`) VALUES
(1, 'SmartPhones', 'img/phone.png', 'NA', 'shop'),
(2, 'Property', 'img/property.png', 'NA', 'rent'),
(3, 'AutoMobiles', 'img/cars.png', 'NA', 'rent'),
(4, 'HomeAppliances', 'img/homeapp.png', 'NA', 'both'),
(5, 'Computers', 'img/laptops.png', 'NA', 'shop'),
(6, 'Cameras', 'img/cam.png', 'NA', 'both'),
(7, 'Old_is_Gold', 'img/old.jpg', 'NA', 'shop'),
(8, 'Electronics', 'img/elec.png', 'NA', 'both'),
(9, 'Toys', 'img/toys.png', 'NA', 'shop'),
(10, 'Gaming', 'img/games.png', 'NA', 'both'),
(11, 'Cosmetics', 'img/cosmetics.png', 'NA', 'shop'),
(12, 'Fashion', 'img/fashion.png', 'NA', 'shop');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `userid` int(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(150) NOT NULL,
  `addressone` varchar(150) NOT NULL,
  `addresstwo` varchar(150) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `userid`, `name`, `email`, `mobile`, `addressone`, `addresstwo`, `country`, `city`, `state`) VALUES
(70, 24, 'Sindhu', 'SindhuVardhan333@Gmail.com', '1234567890', 'railway koduru', 'koduru', 'India', 'Cuddapah', 'Andhra Pradesh'),
(71, 47, 'SindhuVardhan', 's@gmail.com', '09390300843', 'railway koduru', 'koduru', 'India', 'Cuddapah', 'Andhra Pradesh'),
(73, 65, 'devi', 'devi@gmail.com', '06325487547', 'mg nagar', 'poonamalle', 'India', 'chennai', 'Tamil Nadu'),
(74, 66, 'devi', 'devi@gmail.com', '06325487547', 'mg nagar', 'poonamalle', 'India', 'chennai', 'Tamil Nadu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_product`
--
ALTER TABLE `add_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reports`
--
ALTER TABLE `product_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_product`
--
ALTER TABLE `add_product`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `product_reports`
--
ALTER TABLE `product_reports`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
