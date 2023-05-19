-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 07:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '2017-01-24 16:21:18', '19-05-2023 06:47:21 AM');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryDescription` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'Iphone14', '', '2023-05-18 12:43:06', '18-05-2023 06:13:40 PM'),
(2, 'Iphone13', '', '2023-05-18 12:43:12', '18-05-2023 06:14:00 PM'),
(3, 'Iphone12', '', '2023-05-18 12:43:18', '18-05-2023 06:14:08 PM'),
(4, 'Iphone11', '', '2023-05-18 12:43:26', '18-05-2023 06:14:15 PM'),
(5, 'IphoneX', '', '2023-05-18 12:43:29', '18-05-2023 06:15:42 PM'),
(6, 'Iphone8', '', '2023-05-18 12:43:34', '18-05-2023 06:15:49 PM');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderStatus` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(1, 1, '1', 1, '2017-03-07 19:32:57', 'COD', 'Delivered'),
(3, 1, '1', 1, '2017-03-10 19:43:04', 'Debit / Credit card', 'Delivered'),
(4, 1, '1', 1, '2017-03-08 16:14:17', 'COD', 'Delivered'),
(5, 1, '1', 1, '2017-03-08 19:21:38', 'COD', NULL),
(6, 1, '1', 1, '2017-03-08 19:21:38', 'COD', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(1, 3, 'in Process', 'Order has been Shipped.', '2017-03-10 19:36:45'),
(2, 1, 'Delivered', 'Order Has been delivered', '2017-03-10 19:37:31'),
(3, 3, 'Delivered', 'Product delivered successfully', '2017-03-10 19:43:04'),
(4, 4, 'in Process', 'Product ready for Shipping', '2017-03-10 19:50:36'),
(5, 1, 'Delivered', '.', '2023-05-19 01:27:26'),
(6, 4, 'Delivered', 'hhh', '2023-05-19 01:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) DEFAULT NULL,
  `productcapacity` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productColor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `productPriceBeforeDiscount` int(11) DEFAULT NULL,
  `productAmount` int(5) DEFAULT NULL,
  `productDescription` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productImage1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productImage2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productImage3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subcategory`, `productcapacity`, `productColor`, `productPrice`, `productPriceBeforeDiscount`, `productAmount`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`) VALUES
(1, 1, 1, '128', 'Đen', 29690000, 32990000, 50, NULL, 'ip-14-pro-max-den-1.jpg', 'iphone-14pro-den-2.jpg', 'iphone-14prm-den-3.jpg', 0, 'In Stock', '2023-05-19 03:56:07', NULL),
(2, 1, 1, '256', 'Bạc', 26990000, 29990000, 10, NULL, '638054217303176240_ip-14-pro-max-bac-1.jpg', '638139587930405930_iphone-14pro-trang-6.jpg', '638129176746627261_iphone-14prm-trang-1.jpg', 0, 'In Stock', '2023-05-19 03:56:48', NULL),
(3, 1, 1, '512', 'Vàng', 26790000, 29990000, 10, NULL, '638054222139728415_ip-14-pro-max-vang-1.jpg', '638139585349327778_iphone-14pro-vang-2.jpg', 'iphone-14prm-vang-3.jpg', 0, 'In Stock', '2023-05-19 03:58:31', NULL),
(4, 1, 1, '512', 'Tím', 26790000, 29990000, 10, NULL, '638054220350691584_ip-14-pro-max-tim-1.jpg', '638139575856757694_iphone-14pro-tim-5.jpg', '638129177601901651_iphone-14prm-tim-1.jpg', 0, 'In Stock', '2023-05-19 03:59:55', NULL),
(5, 1, 3, '128', 'Đỏ', 21780000, 24990000, 10, NULL, '638054166106341023_ip-14-plus-do-1.jpg', '638138921570765389_iphone-14-do-4.jpg', '638138921565687118_iphone-14-do-7.jpg', 0, 'In Stock', '2023-05-19 04:03:57', NULL),
(6, 1, 4, '128', 'Xanh', 19290000, 21990000, 10, NULL, '638054092490170033_ip-14-xanh-1.jpg', '638138921570665374_iphone-14-xanh-4.jpg', '638138921565407165_iphone-14-xanh-7.jpg', 0, 'In Stock', '2023-05-19 04:12:25', NULL),
(7, 2, 7, '128', 'Đen', 16880000, 18990000, 10, NULL, '637864946617759009_iphone-13-den-1.jpg', '637864946611919843_iphone-13-den-3.jpg', '637864946616352782_iphone-13-den-2.jpg', 0, 'In Stock', '2023-05-19 04:14:56', NULL),
(8, 3, 10, '128', 'Tím', 14890000, 17990000, 10, NULL, '638059232363845825_iphone-12-tim-1.jpg', '638059232363050040_iphone-12-tim-3.jpg', '638059232363674839_iphone-12-tim-2.jpg', 0, 'In Stock', '2023-05-19 04:18:11', NULL),
(9, 4, 13, '64', 'Đen', 10280000, 11990000, 10, NULL, '638059306728859551_iphone-11-den-1.jpg', '638059306729015793_iphone-11-den-3.jpg', '638059306729015793_iphone-11-den-2.jpg', 0, 'In Stock', '2023-05-19 04:21:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(1, 1, 'Iphone 14 Pro Max', '2023-05-19 00:20:27', NULL),
(2, 1, 'Iphone 14 Pro', '2023-05-19 00:42:36', NULL),
(3, 1, 'Iphone 14 Plus', '2023-05-19 00:42:45', NULL),
(4, 1, 'Iphone 14', '2023-05-19 00:42:52', NULL),
(5, 2, 'Iphone 13 Pro Max', '2023-05-19 00:43:01', NULL),
(6, 2, 'Iphone 13 Pro', '2023-05-19 00:43:09', NULL),
(7, 2, 'Iphone 13', '2023-05-19 00:43:18', NULL),
(8, 3, 'Iphone 12 Pro Max', '2023-05-19 00:43:27', NULL),
(9, 3, 'Iphone 12 Pro', '2023-05-19 00:43:35', NULL),
(10, 3, 'Iphone 12', '2023-05-19 00:43:40', NULL),
(11, 4, 'Iphone 11 Pro Max', '2023-05-19 00:43:51', NULL),
(12, 4, 'Iphone 11 Pro', '2023-05-19 00:43:58', NULL),
(13, 4, 'Iphone 11', '2023-05-19 00:44:04', NULL),
(14, 5, 'Iphone X', '2023-05-19 00:44:09', NULL),
(15, 6, 'Iphone 8', '2023-05-19 00:44:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(24, 'pvnam372@gmail.com', 0x3a3a3100000000000000000000000000, '2023-05-19 05:02:56', '19-05-2023 10:35:59 AM', 1),
(25, 'pvnam372@gmail.com', 0x3a3a3100000000000000000000000000, '2023-05-19 05:06:05', NULL, 0),
(26, 'pvnam372@gmail.com', 0x3a3a3100000000000000000000000000, '2023-05-19 05:06:18', '19-05-2023 10:38:37 AM', 1),
(27, 'pvnam372@gmail.com', 0x3a3a3100000000000000000000000000, '2023-05-19 05:08:44', '19-05-2023 10:44:01 AM', 1),
(28, 'pvnam372@gmail.com', 0x3a3a3100000000000000000000000000, '2023-05-19 05:14:07', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shippingAddress` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shippingState` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shippingCity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `billingAddress` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billingState` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billingCity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`) VALUES
(5, 'Phạm Văn Nam', 'pvnam372@gmail.com', 123, '202cb962ac59075b964b07152d234b70', '167 phố Đông Thiên', 'Hoàng Mai', 'Hà Nội', NULL, '167 phố Đông Thiên', 'Hoàng Mai', 'Hà Nội', NULL, '2023-05-19 05:06:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
