-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2018 at 10:32 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saloodo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bundles`
--

CREATE TABLE `bundles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bundle_product`
--

CREATE TABLE `bundle_product` (
  `id` int(11) NOT NULL,
  `bundle_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `gro_id` tinyint(1) NOT NULL,
  `gro_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`gro_id`, `gro_name`) VALUES
(1, 'admin'),
(2, 'c_admin'),
(3, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(16) NOT NULL,
  `data` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` enum('paid','confirmed','unpaid','canceled','expired') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(16) NOT NULL,
  `invoice_id` int(16) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(16) NOT NULL,
  `product_type` varchar(60) NOT NULL,
  `product_title` varchar(60) NOT NULL,
  `qty` int(3) NOT NULL,
  `price` int(9) NOT NULL,
  `discout_price` int(11) NOT NULL,
  `sell_price` int(11) NOT NULL,
  `options` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(16) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_title` varchar(20) NOT NULL,
  `pro_description` text NOT NULL,
  `pro_price` int(9) NOT NULL,
  `pro_stock` int(3) NOT NULL,
  `pro_image` text NOT NULL,
  `pro_discount` float NOT NULL,
  `pro_discount_type` varchar(11) NOT NULL,
  `bundle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_session`
--

CREATE TABLE `shop_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_session`
--

INSERT INTO `shop_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('092e4a951370917bc4d9cef2cca0a0965d52074d', '::1', 1545854627, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835343436373b),
('1082a5b6368e79f80604ea9151680f99e3672170', '::1', 1545858553, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835383535333b),
('11b433b91da91fd2df474c65209d5bdf04f52391', '::1', 1430886198, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838353930363b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('14319b3577887870ff4082e0895d6fa9f7c567c3', '::1', 1545855909, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835353635373b),
('18e5031ed538645b4ccb810918bb6bb4def54f0f', '::1', 1430885736, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838353630353b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('216782d346ecb725467fa1a08f49f3e057705ad8', '::1', 1430882453, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838323430303b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('303d5ff594029d513c5b48c68edde9af03ed959f', '::1', 1430889412, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838393133383b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('436c77411f09d19e779c42f2602b2ee12af3593c', '::1', 1545854991, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835343837353b),
('442df5fad42ec1d400ba5012d5776635aec7800e', '::1', 1545857686, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835373436353b),
('473886d26486392bbc947defc69cdcf66424de77', '::1', 1430886630, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838363433363b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('57e361f399279504ed0696e57a3a11380baacc6a', '::1', 1545859326, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835393132393b),
('62d8afdf13403d6a7e93d5970ba63ca3ed7a260f', '::1', 1545856137, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835353937373b),
('75026a28ee50856686459e50bbf04e02fbdbe1b7', '::1', 1430887393, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838373136333b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('8f1b75f2af02d572e0b06950a4286efa36064e28', '::1', 1430892337, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303839323333353b),
('8f5d8f2b27c17d06a261c2d12b9c6783791f23b0', '::1', 1430888044, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838373836323b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('a460a08a293ae491ad52e0381efaa0070ec01c76', '::1', 1430888288, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838383137303b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('ac03e0e37872a413802709d8289adcfe1d6574db', '::1', 1430887766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838373437343b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('bc4efa4652f10354cd7093ff5d3784a1533677f1', '::1', 1545856886, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835363833323b),
('c64d3fd803821b27ddca58c1de092623cc89ee8a', '::1', 1430890441, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303839303334343b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b6d6573736167657c733a35383a225468616e6b20796f75202e2e2e2e2e2077652077696c6c20636865636b206f6e20796f7572207061796d656e7420636f6e6669726d6174696f6e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('d03788541a1ed30cb5f5fb7acc025264b50bf1fe', '::1', 1430888790, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838383532303b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('d7a7a2250ad798163a90ba09c3e0501aa17bbf2b', '::1', 1430883463, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303838333230313b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('dcf571bb5bf8bc17410dbc3296ea95b583be3224', '::1', 1545859632, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835393438383b),
('de7ce40606d2ca12588673bb044e6c1f994223c0', '::1', 1545858098, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835373834373b),
('e5a96ef2ea1800a7dc0a794c1fc53ebbd742aa3e', '::1', 1430893426, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303839333432363b),
('e6528b002d7aacfeaa0d5e91ca1b9e3d714d5487', '::1', 1430891019, 0x5f5f63695f6c6173745f726567656e65726174657c693a313433303839303733343b757365726e616d657c733a363a2268696368616d223b67726f75707c733a313a2233223b),
('e928b809d79263af15453030a11dd17820e07823', '::1', 1545854161, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835343136313b),
('f0b81d36c97e937377d8587804eac9d501689a4d', '::1', 1545858388, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353835383139353b);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(10) NOT NULL,
  `usr_name` varchar(25) NOT NULL,
  `usr_password` varchar(60) NOT NULL,
  `usr_group` tinyint(1) NOT NULL,
  `stuts` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_password`, `usr_group`, `stuts`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(2, 'Debraj', '21232f297a57a5a743894a0e4a801fc3', 3, 1),
(3, 'Debraj', '21232f297a57a5a743894a0e4a801fc3', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bundles`
--
ALTER TABLE `bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bundle_product`
--
ALTER TABLE `bundle_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`gro_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `shop_session`
--
ALTER TABLE `shop_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bundles`
--
ALTER TABLE `bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bundle_product`
--
ALTER TABLE `bundle_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `gro_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
