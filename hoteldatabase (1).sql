-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 04:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoteldatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `is_Available` varchar(10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `persons` int(11) NOT NULL,
  `initialQuantity` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `is_Available`, `type`, `price`, `persons`, `initialQuantity`, `quantity`, `description`, `image`, `users_id`) VALUES
(90, 'true', 'Single Room ', 1499, 2, 2, 2, 'Men    ', '656f406c4fdbe2.30711331.jpeg', NULL),
(91, 'true', 'Double Room  ', 2999, 5, 10, 10, 'hatdog  ', '656f413b0e6536.34729790.jpg', NULL),
(92, 'true', 'Luxury ', 5999, 5, 5, 5, 'Monitor ', '656f4432c280b3.77781167.jpg', NULL),
(93, 'true', 'Ullamco vel quis in  ', 485, 5, 5, 5, 'Incidunt reprehende ', '656f443d4a2f26.95650118.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_card`
--

CREATE TABLE `room_card` (
  `room_card_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_card`
--

INSERT INTO `room_card` (`room_card_id`, `image`, `type`, `price`, `description`) VALUES
(1, '656f44c9b052e3.57187876.png', 'Single ', 1499, 'A perfect blend of tranquility and modern convenience. '),
(2, '656f44d29fa355.20633154.jpeg', 'Double  ', 1999, 'A perfect blend of tranquility and modern convenience. '),
(3, '656f44e95bbcf9.56478223.png', 'NOT AVAILABLE ', 1, 'NOT AVAILABLE ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `rooms_id` int(11) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `email`, `pwd`, `first_name`, `rooms_id`, `last_name`) VALUES
(1, 'admin', 'robinxaquino@gmail.com', '$2y$12$c8BIlMHznV4e.NcIUiX2o.VaoD9m3.7RXquuwAPqI5diaysmtJwey', 'Robinx', NULL, 'Aquino'),
(2, 'customer', 'mounthua@gmail.com', '$2y$12$UbgplWBtfGUvJZeKqXa/Zup8MpVmKFvML7Vx66uZ97TEl26r55L4K', 'Mount', NULL, 'Hua'),
(3, 'admin', 'robinxprhynz.aquino.301058@gmail.com', '$2y$12$.8dqyG.ZobPQt9bZjzZ4R.7L91E4GuHi/fiVo0KoS6i056HagFw9y', 'Hatdog', NULL, 'Desu'),
(8, 'customer', 'cyqip@mailinator.com', '$2y$12$YWm/ny4t7lZLhx5mkTuwl.AKBEgW8pFYFuhJHDRrBV6ewKddICBFe', 'Hamilton', NULL, 'password');

-- --------------------------------------------------------

--
-- Table structure for table `user_rooms`
--

CREATE TABLE `user_rooms` (
  `booking_id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `rooms_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `room_card`
--
ALTER TABLE `room_card`
  ADD PRIMARY KEY (`room_card_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `rooms_id` (`rooms_id`);

--
-- Indexes for table `user_rooms`
--
ALTER TABLE `user_rooms`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `rooms_id` (`rooms_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `room_card`
--
ALTER TABLE `room_card`
  MODIFY `room_card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_rooms`
--
ALTER TABLE `user_rooms`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rooms_id`) REFERENCES `room` (`room_id`) ON DELETE SET NULL;

--
-- Constraints for table `user_rooms`
--
ALTER TABLE `user_rooms`
  ADD CONSTRAINT `user_rooms_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_rooms_ibfk_2` FOREIGN KEY (`rooms_id`) REFERENCES `room` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
