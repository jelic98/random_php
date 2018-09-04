-- phpMyAdmin SQL Dump
-- version 4.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2016 at 04:07 AM
-- Server version: 5.6.27-log
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amiresfa_caspianmarkets`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_filters`
--

CREATE TABLE `table_filters` (
  `cat` varchar(30) NOT NULL,
  `sub` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_filters`
--

INSERT INTO `table_filters` (`cat`, `sub`) VALUES
('tree', 'fruit tree~'),
('jeep', 'cars~'),
('Fruits', 'fruits & vegetables~fruits~fru'),
('flowers', 'flowers 1~'),
('tour', 'tour1~'),
('cars', 'chevrolet~camaro~cars~'),
('cat', 'sub~'),
('cars 1', 'cars~cars~'),
('Clothes and shoes', 'shoes~'),
('Fish', 'sea~'),
('Animals', '3d objects~'),
('Veg', 'fruits & vegetables~'),
('VW', 'golf~');

-- --------------------------------------------------------

--
-- Table structure for table `table_products`
--

CREATE TABLE `table_products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `category` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subcategory` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `images` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `rating` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_products`
--

INSERT INTO `table_products` (`id`, `name`, `description`, `category`, `price`, `quantity`, `subcategory`, `images`, `country`, `shop_id`, `rating`) VALUES
(1, 'Shoes', 'High Quality shoes', 'Clothes and shoes', 99, 2, 'shoes', 'images/1Shoes1.png~', 'cn', 1, NULL),
(2, 'Beach Tour', 'Tour', 'Tour', 1200, 200, 'Beach', 'images/Beach Tour1.jpg~', 'us', 1, NULL),
(5, 'Fresno Pepper', 'The Fresno chili pepper is a medium-sized cultivar of Capsicum annuum. It often confused with Jalapeno pepper but contains thinner walls, often milder heat, and less time to maturity, it is however a ...', 'Veg', 100, 300, 'fruits & vegetables', 'images/1Fresno Pepper1.jpg~', 'us', 1, NULL),
(6, 'Elephant', 'Elephant 3D', 'Animals', 900, 90, '3d objects', 'images/1Elephant1.png~', 'us', 1, NULL),
(7, 'Banana', 'Banana', 'Fruits', 20, 1, 'fruits & vegetables', 'images/1Banana1.png~', 'us', 1, NULL),
(8, 'VW MK1', 'VW MK1', 'VW', 2000, 1, 'golf', 'images/1VW MK11.png~', 'us', 1, NULL),
(9, 'Fish', 'Black Yellow', 'Fish', 100, 120, 'sea', 'images/1Fish1.png~', 'us', 1, NULL),
(11, 'Turkey ', 'Turkey meat is not only tasty, but also a very healthy and dietary type of meat. As compared to other types of meat, the turkey meat is rich in A, E vitamins and low content of cholesterol. Turkey meat is rich in such micro-elements as phosphorus, sodium, potassium, ferrum, magnesium and iodine.', 'Turkey', 12, 1200, 'Poultry', 'images/Turkey .JPG~', 'us', 1, 4),
(13, 'SR71', 'SR71', 'war', 1000, 12, 'spy', '', '', 0, NULL),
(14, 'Bean', 'Beans', 'veg', 100, 100, 'fruits & vegetables', '', '', 0, NULL),
(15, 'Mango', 'Mango Tree', 'tree', 10, 100, 'fruit tree', '', '', 0, 5),
(16, 'Jeep', 'Jeep has been an iconic & legendary 4x4 sport utility vehicle for the past 70 years. Explore the Jeep SUV & Crossover lineup. Go anywhere, do anything.', 'jeep', 2000, 2, 'cars', 'images/default.png~', '', 0, NULL),
(17, 'Flowers', 'purple', 'flowers', 200, 10, 'flowers 1', 'images/1Flowers.jpg~', '', 0, NULL),
(18, 'Beach 2', 'Bech Tour 2', 'tour', 1000, 2, 'tour1', 'images/1Beach 2.jpg~', '', 0, NULL),
(21, 'Chevrolet Camaro', 'Awesome car...', 'cars', 30000, 4, 'cars', 'images/1Chevrolet Camaro.jpg~images/2Chevrolet Camaro.jpg~images/3Chevrolet Camaro.jpg~', '', 6, NULL),
(22, 'asd', 'jaksfh', 'cat', 456, 64, 'sub', 'images/default.png~', '', 0, NULL),
(23, 'Pineapples', 'Pineapples', 'fruits', 12, 100, 'fruits', 'images/1Pineapples1.png~images/2Pineapples1.jpg~', 'AM', 1, 2),
(24, 'Toyota Yaris', 'two and four-door model', 'cars 1', 1000, 12, 'cars', 'images/1Toyota Yaris1.png~', 'AM', 1, NULL),
(25, '2014 VW Golf ', '2014 VW Golf ', 'cars 1', 5000, 12, 'cars', 'images/12014 VW Golf 1.png~', 'AM', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_shops`
--

CREATE TABLE `table_shops` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `country` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `zip_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `order` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_shops`
--

INSERT INTO `table_shops` (`id`, `name`, `owner_id`, `country`, `city`, `image`, `address`, `rating`, `zip_code`, `phone_number`, `email`, `order`) VALUES
(1, 'Shop', 2, 'am', 'Yerevan', 'images/2Shop.png', 'Abovyan 39, apartment 27', NULL, '0009', '3741056567', 'amir.esfahani@gmail.com', 'recei'),
(5, 'Putin', 3, 'ru', 'City', 'images/3Name.jpeg', 'Address', NULL, NULL, NULL, NULL, NULL),
(6, 'iran shop', 1, 'ir', 'Tehran', 'images/iran shop1.png', 'Ekbatan', NULL, '13959', '982166688309', 'jelic.ecloga@gmail.com', 'email'),
(8, 'FoodLine', 5, 'gb', 'Manchester', 'images/5FoodLine.jpg', '23 Albert Road', NULL, '999988', NULL, NULL, NULL),
(9, 'name', 6, 'am', 'asf', 'images/6name.jpg', 'asf', NULL, '124', NULL, 'email@as', 'Email');

-- --------------------------------------------------------

--
-- Table structure for table `table_users`
--

CREATE TABLE `table_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `shop` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cart` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `zip_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email_confirmed` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_users`
--

INSERT INTO `table_users` (`id`, `first_name`, `last_name`, `email`, `country`, `shop`, `cart`, `password`, `phone_number`, `city`, `zip_code`, `address`, `email_confirmed`) VALUES
(1, 'Lazar', 'Jelic', 'jelic.ecloga@gmail.com', 'ir', 'iran shop', '21*3~', '9cab2845fe3910ac0c260627a0d8d22c7e46fc8c2f5ec31e5b6501753f41ec9660070545f841dd10eea70d6792d8667c3764782ff91c8e428b4c90a047deb7c6', '321', 'city', '123', 'address', NULL),
(2, 'Amir', 'Esfahani', 'amir.esfahani@gmail.com', 'am', 'Shop', '', '7df18b45d1d19b6194aef483b0c6d376f9a3cc925f2a919aac149e32d11a1665233ee835942fe9a01b3b012f82d9760d4be148e35ea109085a3fe49a86e153a2', NULL, NULL, NULL, NULL, NULL),
(3, 'First', 'Last', 'email@email', 'ru', '', '', 'e7205add494f33c5ebe8bda3a41c2c1a3e1152733ce7988d7de7190b076976d718a4e8bd3b5dc3211c810a57ca89a68eff74d55ab9b3ea7f3b5488f53e177888', NULL, NULL, NULL, NULL, NULL),
(4, 'M', 'Sz', 'mahkame.sz@gmail.com', 'ir', '', '', '6932ca6e2c01518390d167e9e1eb9410ad25fbd41562f9ded84a849a136549dca20a94b7473695c86b727d7ffaa60513eb80aaccde64f109625dfda2548711f1', NULL, NULL, NULL, NULL, NULL),
(5, 'Hamid', 'Rezaie', 'hamid4uk@gmail.com', 'uk', 'FoodLine', '', '7df18b45d1d19b6194aef483b0c6d376f9a3cc925f2a919aac149e32d11a1665233ee835942fe9a01b3b012f82d9760d4be148e35ea109085a3fe49a86e153a2', NULL, NULL, NULL, NULL, NULL),
(6, 'Tigrian', 'Sergisyan', 'tigrian@serg.am', 'am', 'name', NULL, 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', NULL, NULL, NULL, NULL, NULL),
(7, 'Sarah', 'Mantashoff', 'sarah.mantashyan@yahoo.com', 'ar', NULL, NULL, '9d06b11c1b0475c9975c7c7ebf77b0c1d8b4e5084763cc4eda4b34b3cbab52352094a060d3d76ee8f761758202c6158063cee6d7b33c064a008f6f98e7a32078', NULL, NULL, NULL, NULL, NULL),
(8, 'Test', 'Test', 'test@test.com', 'in', NULL, NULL, '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', NULL, NULL, NULL, NULL, NULL),
(9, 'Alex', 'Stealth', 'sth@mailinator.com', 'ru', NULL, '121*1~', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '', 'Moscow', 'None', 'None', NULL),
(10, 'Amir', 'Esfahani', 'esfahaniamir6@gmail.com', 'ir', NULL, NULL, '7df18b45d1d19b6194aef483b0c6d376f9a3cc925f2a919aac149e32d11a1665233ee835942fe9a01b3b012f82d9760d4be148e35ea109085a3fe49a86e153a2', '', 'Tehran', '9821666883', 'Tehran Ekbatan Building 15 Entrance 9th floor Apt. 252', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_filters`
--
ALTER TABLE `table_filters`
  ADD PRIMARY KEY (`cat`);

--
-- Indexes for table `table_products`
--
ALTER TABLE `table_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_shops`
--
ALTER TABLE `table_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_users`
--
ALTER TABLE `table_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_products`
--
ALTER TABLE `table_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `table_shops`
--
ALTER TABLE `table_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `table_users`
--
ALTER TABLE `table_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
