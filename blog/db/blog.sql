-- phpMyAdmin SQL Dump
-- version 4.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2016 at 03:39 PM
-- Server version: 5.6.27-log
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `name` varchar(50) COLLATE utf32_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`name`) VALUES
('Dizajn'),
('Obnovljiva energija'),
('Resursi'),
('Ušteda');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf32_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `headline` varchar(50) COLLATE utf32_unicode_ci NOT NULL DEFAULT '',
  `preview` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `body` varchar(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `date` varchar(11) COLLATE utf32_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `author` varchar(25) COLLATE utf32_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `category` varchar(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`headline`, `preview`, `body`, `date`, `image`, `author`, `tags`, `category`, `id`) VALUES
('asd', 'kjashd', 'posts/asd.', '29.04.2016.', 'images/default.png', 'admin', 'prvi, drugi, treci, cetvrti', '', 1),
('ght', 'tyasdk', 'post/nekipost.htm', '2020-04-20', 'images/posts/default.png', '', NULL, NULL, 2),
('headline', 'preview', 'posts/headline.htm', '21.04.2016.', 'images/posts/headline.jpg', 'admin', NULL, NULL, 3),
('naslov', 'pr', 'Array', '2020-04-20', 'images/postsnaslov.png', NULL, NULL, NULL, 4),
('naslovi', 'tryu', 'Array', '2020-04-20', 'images/default.png', '', 'asf, asd, ga', NULL, 5),
('ovo je post', 'agshdfklj haskf', 'posts/ovo je post.htm', '23.04.2016.', 'images/default.png', 'admin', NULL, NULL, 6),
('post', 'preview', 'Array', '2020-04-20', 'images/default.png', 'admin', NULL, NULL, 7),
('zad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
('', 'kjashd', 'posts/.', '29.04.2016.', '', 'admin', 'prvi, drugi, treci, cetvrti', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) COLLATE utf32_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(144) COLLATE utf32_unicode_ci DEFAULT NULL,
  `salt` varchar(16) COLLATE utf32_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `full_name` varchar(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `add_post` int(1) NOT NULL DEFAULT '0',
  `edit_post` int(1) NOT NULL DEFAULT '0',
  `delete_post` int(1) NOT NULL DEFAULT '0',
  `add_user` int(1) NOT NULL DEFAULT '0',
  `edit_user` int(1) NOT NULL DEFAULT '0',
  `delete_user` int(1) NOT NULL DEFAULT '0',
  `added_by` varchar(25) COLLATE utf32_unicode_ci DEFAULT NULL,
  `add_category` int(1) NOT NULL DEFAULT '0',
  `delete_category` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `salt`, `image`, `full_name`, `add_post`, `edit_post`, `delete_post`, `add_user`, `edit_user`, `delete_user`, `added_by`, `add_category`, `delete_category`) VALUES
('admin', 'K9lVcvunogDZFgLvc7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'K9lVcvunogDZFgLv', 'images/users/admin.jpg', 'Admin', 1, 1, 1, 1, 1, 1, 'jelic', 1, 1),
('jelic', 'Gey4l1Wuyze4AX8j3c79ee3afcfc0f2394072ec3d3b2fb3961f57e99d2767c14a75c1b9f702b280fb41f7c7ae9d93ca7cd0aad6b03ceab06b28847ae51eb563a97e992ec7991f253', 'Gey4l1Wuyze4AX8j', 'images/users/default.png', 'Lazar', 1, 1, 1, 0, 0, 0, 'admin', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `headline` (`headline`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
