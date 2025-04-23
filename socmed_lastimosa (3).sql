-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 05:52 PM
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
-- Database: `socmed_lastimosa`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avatar`
--

INSERT INTO `avatar` (`id`, `user_id`, `image`) VALUES
(4, 5, 'avatar1.png'),
(5, 6, 'avatar2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `pid` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`) VALUES
(1, 'Anime Robe', 'robe.jpg', NULL, 200.00),
(2, 'Figure A', 'figure1.jpg', NULL, 150.00),
(3, 'Figure B', 'figure2.jpg', NULL, 500.00),
(4, 'Toy A', 'toy1.jpg', NULL, 300.00),
(5, 'Toy B', 'toy2.jpg', NULL, 355.00),
(6, 'Cosplay Wig', 'wig.jpg', NULL, 875.00),
(7, 'Naruto Figure', 'naruto.jpg', NULL, 299.99),
(8, 'One Piece Poster', 'onepiece.jpg', NULL, 149.50),
(9, 'Demon Slayer Mug', 'demonslayer.jpg', NULL, 99.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `purchase_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `uid`, `product_id`, `purchase_date`) VALUES
(1, 6, 1, '2025-04-11 13:19:15'),
(2, 6, 7, '2025-04-11 13:19:20'),
(3, 8, 8, '2025-04-11 13:33:41'),
(4, 6, 7, '2025-04-11 13:34:10'),
(5, 3, 7, '2025-04-11 22:20:53'),
(6, 3, 9, '2025-04-11 22:32:29'),
(7, 3, 6, '2025-04-13 18:32:02'),
(8, 3, 7, '2025-04-13 21:12:51'),
(9, 3, 5, '2025-04-13 21:22:11'),
(10, 3, 7, '2025-04-13 21:26:34'),
(11, 3, 7, '2025-04-13 21:26:36'),
(12, 3, 7, '2025-04-13 21:31:57'),
(13, 3, 9, '2025-04-13 21:32:06'),
(14, 3, 7, '2025-04-13 21:46:22'),
(15, 3, 1, '2025-04-13 21:48:26'),
(16, 3, 7, '2025-04-13 21:48:28'),
(17, 3, 9, '2025-04-13 21:48:31'),
(18, 3, 9, '2025-04-13 22:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `uname` varchar(128) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(512) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `firstname`, `lastname`, `email`, `gender`, `birthdate`, `password`, `avatar`) VALUES
(2, 'clarence', 'clarence', 'warain', 'clarenceninowarain@gmail.com', 'male', '2025-04-07', '$2y$10$.Qq5KhUGpsnWyOEhk.tz1uphoI9LFY40S1tiDJmJ/5f7i3LTWkjuy', ''),
(3, 'christian', 'christianskie', 'lastimosa', 'chris@gmail.com', 'male', '2025-04-01', '$2y$10$igwaftA9Y61BixjnzaKYweBKiM6y/4fJU0FcITv77xsMnOSutT6XW', 'texhnolyze.jpg'),
(4, 'cris', 'cris', 'tian', 'cris@gmail.com', 'male', '2025-04-08', '$2y$10$bz3s8pLIYS6PNBbI/5gniOCln51.N4cVn7AT0oq7Mf9/UJJXmtlCG', ''),
(5, 'DA', 'DA', 'PAK', 'dah@gmail.com', 'male', '2122-03-12', '$2y$10$FCy75O4VMtdTWcUUmO6EEOR7oRSm.okmZl0ARvFF9ht4OHxn.pOYS', ''),
(6, 'christian1', 'CHRISTIAN', 'LASTIMOSA', 'CHRISTIAN@gmail.com', 'male', '2323-12-12', '$2y$10$W2XmXCO.p6vcC2thuMmTGuHPX1lg53X7GuBbxjUAgE65MKq30daSm', 'texhnolyze.jpg'),
(7, 'klarins', 'klarensoy', 'momo', 'clarence@gmail.com', 'male', '2004-01-31', '$2y$10$puuycjGJDUL.s1oiZazYKeTNallkpYm08gapB4UtSqekXDmFTMsQK', '1693404705932.jpg'),
(8, 'mary', 'chicken', 'joyce', 'mary@gmail.c0m', 'female', '2003-10-15', '$2y$10$V.t4HJKf.xgTfsodMmHqh.h6Xdc4WfRvExtBB9mLqrWh29do.syOa', '1718854244531.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avatar`
--
ALTER TABLE `avatar`
  ADD CONSTRAINT `avatar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
