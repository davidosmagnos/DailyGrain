-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql109.epizy.com
-- Generation Time: Mar 31, 2021 at 07:07 AM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_28225277_dailygraindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

-- CREATE TABLE `cart` (
--   `sack_id` int(5) UNSIGNED NOT NULL,
--   `uname` varchar(40) DEFAULT NULL,
--   `prod_id` int(4) UNSIGNED DEFAULT NULL,
--   `qty` int(5) NOT NULL DEFAULT '5'
-- ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

-- CREATE TABLE `orders` (
--   `ord_id` varchar(500) NOT NULL DEFAULT '',
--   `uname` varchar(40) DEFAULT NULL,
--   `sack_id` int(5) UNSIGNED NOT NULL DEFAULT '0',
--   `prod_id` int(4) UNSIGNED DEFAULT NULL,
--   `qty` int(4) DEFAULT NULL,
--   `date` date DEFAULT NULL,
--   `eta` date DEFAULT NULL,
--   `price` float NOT NULL,
--   `mop` int(11) DEFAULT NULL,
--   `stat` varchar(20) DEFAULT 'pending'
-- ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `uname`, `sack_id`, `prod_id`, `qty`, `date`, `eta`, `price`, `mop`, `stat`) VALUES
('606328cab0d87', 'K3ith', 1, 1, 5, '2021-03-30', '2021-03-31', 32, 1, 'cancelled'),
('606328cab0d87', 'K3ith', 2, 2, 5, '2021-03-30', '2021-03-31', 54, 1, 'cancelled'),
('606329379186d', 'K3ith', 3, 3, 5, '2021-03-30', '2021-03-31', 42, 2, 'delivered'),
('606329379186d', 'K3ith', 4, 4, 5, '2021-03-30', '2021-03-31', 48, 2, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `prods`
--

-- CREATE TABLE `prods` (
--   `prod_id` int(4) UNSIGNED NOT NULL,
--   `prod_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
--   `prod_stock` int(4) NOT NULL,
--   `prod_price` float NOT NULL,
--   `sold` int(11) DEFAULT '0',
--   `image` text COLLATE utf8_unicode_ci,
--   `sticky` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
--   `tender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
--   `cook` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
--   `color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
-- ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prods`
--

INSERT INTO `prods` (`prod_id`, `prod_name`, `prod_stock`, `prod_price`, `sold`, `image`, `sticky`, `tender`, `cook`, `color`) VALUES
(1, 'Apple', 120, 32, 15, 'apple.jpg', 'malagkit', 'maalsa', 'sinaing', 'white'),
(2, 'Blue Bird', 245, 54, 20, 'bluebird.jpg', 'buhaghag', 'maligat', 'sinangag', 'white'),
(3, 'Blue Dragon', 195, 42, 5, 'bluedragon.jpg', 'malagkit', 'maalsa', 'sinangag', 'brown'),
(4, 'Carabao', 120, 48, 10, 'carabao.jpg', 'buhaghag', 'maligat', 'sinaing', 'white'),
(5, 'Dalisay', 500, 43, 0, 'dalisay.jpg', 'malagkit', 'maligat', 'sinaing', 'brown'),
(6, 'Diwata Dinorado', 500, 45, 0, 'diwatadinorado.jpg', 'buhaghag', 'maalsa', 'sinangag', 'white'),
(7, 'Dona Miagrosa', 300, 40, 0, 'donamariamiponico.jpg', 'malagkit', 'maligat', 'sinangag', 'brown'),
(8, 'Dona Maria Miponico', 300, 40, 0, 'donamariamiponico.jpg', 'buhaghag', 'maalsa', 'sinaing', 'white'),
(9, 'Fuji', 500, 54, 0, 'fuji.jpg', 'malagkit', 'maligat', 'sinaing', 'white'),
(10, 'Golden Dragon', 275, 40, 0, 'goldendragon.jpg', 'malagkit', 'maalsa', 'sinangag', 'white'),
(11, 'Golden Maharlika', 500, 46, 0, 'goldenmaharlika.jpg', 'malagkit', 'maalsa', 'sinaing', 'brown'),
(12, 'Jasmine', 725, 45, 5, 'jasmine.jpg', 'buhaghag', 'maalsa', 'sinaing', 'brown'),
(13, 'Lotus Milagrosa', 350, 42, 0, 'lotusmilagrosa.jpg', 'buhaghag', 'maalsa', 'sinaing', 'brown'),
(14, 'Magellan', 550, 45, 0, 'magellan.jpg', 'buhaghag', 'maligat', 'sinangag', 'brown'),
(15, 'Magnolia', 400, 52, 0, 'magnolia.jpg', 'buhaghag', 'maalsa', 'sinaing', 'brown'),
(16, 'Panda', 470, 45, 0, 'panda.jpg', 'buhaghag', 'maligat', 'sinaing', 'white'),
(17, 'Pandan', 625, 48, 0, 'pandan.jpg', 'buhaghag', 'maalsa', 'sinaing', 'brown'),
(18, 'Rooster', 550, 42, 0, 'rooster.jpg', 'buhaghag', 'maligat', 'sinaing', 'brown'),
(19, 'Super Angelika', 125, 42, 0, 'superangelika.jpg', 'malagkit', 'maligat', 'sinaing', 'white'),
(20, 'Uncle Juan', 350, 42, 0, 'unclejuan.jpg', 'malagkit', 'maalsa', 'sinangag', 'brown'),
(23, 'Maharlika', 500, 46, 0, 'maharlika.jpg', 'malagkit', 'maalsa', 'sinangag', 'white'),
(24, 'Dinorado', 300, 48, 0, 'dinorado.jpg', 'buhaghag', 'maligat', 'sinaing', 'white'),
(27, 'Awit', 100, 55, 0, 'awit.jpg', 'malagkit', 'maalsa', 'sinaing', 'white');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

-- CREATE TABLE `users` (
--   `uname` varchar(40) NOT NULL,
--   `pword` varchar(40) NOT NULL,
--   `fname` varchar(40) NOT NULL,
--   `lname` varchar(40) NOT NULL,
--   `addr` varchar(100) NOT NULL,
--   `cno` varchar(20) NOT NULL,
--   `email` varchar(30) NOT NULL,
--   `img` varchar(40) DEFAULT 'ph.jpg',
--   `utype` varchar(1) NOT NULL
-- ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uname`, `pword`, `fname`, `lname`, `addr`, `cno`, `email`, `img`, `utype`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Daily', 'Grain', 'Alabang', '09176652937', 'dailygrain@gmail.com', 'ph.jpg', 'A'),
('K3ith', '827ccb0eea8a706c4c34a16891f84e7b', 'Keith Lundberg', 'Salandanan', 'Avenida St. Barangay Magdalo', '09396416631', 'keithsalandanan@gmail.com', 'k3ith.jpg', 'U'),
('Anika', '81dc9bdb52d04dc20036dbd8313ed055', 'Anika', 'Alarcon', 'Las Pinas', '1234568', 'anikalarcon@ruffy.com', 'ph.jpg', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
-- ALTER TABLE `cart`
--   ADD PRIMARY KEY (`sack_id`),
--   ADD KEY `FK_USERS` (`uname`),
--   ADD KEY `FK_PROD` (`prod_id`);

-- --
-- -- Indexes for table `orders`
-- --
-- ALTER TABLE `orders`
--   ADD PRIMARY KEY (`ord_id`,`sack_id`),
--   ADD KEY `FK_user` (`uname`);

-- --
-- -- Indexes for table `prods`
-- --
-- ALTER TABLE `prods`
--   ADD PRIMARY KEY (`prod_id`);

-- --
-- -- Indexes for table `users`
-- --
-- ALTER TABLE `users`
--   ADD PRIMARY KEY (`uname`),
--   ADD UNIQUE KEY `email` (`email`);

-- --
-- -- AUTO_INCREMENT for dumped tables
-- --

-- --
-- -- AUTO_INCREMENT for table `cart`
-- --
-- ALTER TABLE `cart`
--   MODIFY `sack_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- --
-- -- AUTO_INCREMENT for table `prods`
-- --
-- ALTER TABLE `prods`
--   MODIFY `prod_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
