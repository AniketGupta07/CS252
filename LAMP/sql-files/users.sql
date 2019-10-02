-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8080
-- Generation Time: Oct 02, 2019 at 03:43 PM
-- Server version: 8.0.17
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id`, `email`, `password`) VALUES
(1, 'abc@xyz.com', '912ec803b2ce49e4a541068d495ab570');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `dish` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `chef` varchar(50) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  `ave` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`dish`, `price`, `category`, `availability`, `chef`, `num`, `ave`) VALUES
('A1', 101, 'A', 0, 'A', 71, 2.78),
('A2', 412, 'A', 1, 'A', 145, 3.77365),
('A3', 500, 'A', 1, 'A', 78, 3.21),
('A4', 390, 'A', 1, 'A', 52, 3.78),
('A5', 355, 'A', 1, 'A', 102, 4.07),
('A6', 397, 'A', 1, 'A', 100, 4.57),
('A7', 489, 'A', 1, 'A', 141, 1.82),
('A8', 306, 'A', 1, 'A', 148, 3.69),
('A9', 173, 'A', 1, 'A', 121, 2.28),
('B1', 320, 'B', 1, 'A', 122, 2.03),
('B2', 396, 'B', 1, 'B', 143, 4.29),
('B3', 357, 'B', 1, 'B', 67, 4.57),
('B4', 464, 'B', 1, 'B', 125, 2.46),
('B5', 229, 'B', 1, 'B', 129, 4.74),
('B6', 247, 'B', 1, 'B', 101, 4.8),
('B7', 341, 'B', 1, 'B', 92, 4.52),
('B8', 370, 'B', 1, 'B', 101, 4.59),
('B9', 354, 'B', 1, 'B', 116, 3.42),
('C1', 384, 'C', 1, 'C', 111, 1.94),
('C2', 273, 'C', 1, 'C', 107, 2.82),
('C3', 437, 'C', 1, 'C', 98, 4.39),
('C4', 107, 'C', 1, 'C', 71, 1.97),
('C5', 440, 'C', 1, 'C', 81, 1.56),
('C6', 108, 'C', 1, 'C', 126, 1.6),
('C7', 163, 'C', 1, 'C', 115, 4.28),
('C8', 215, 'C', 1, 'C', 82, 2.11),
('C9', 233, 'C', 1, 'C', 100, 4.18),
('D1', 100, 'D', 1, 'D', 64, 2.94),
('D2', 435, 'D', 1, 'D', 108, 1.94),
('D3', 110, 'D', 1, 'D', 147, 2.09),
('D4', 100, 'D', 1, 'D', 128, 1.1),
('D5', 389, 'D', 1, 'D', 62, 1.34),
('D6', 214, 'D', 1, 'D', 117, 1.58),
('D7', 218, 'D', 1, 'D', 137, 3.87),
('D8', 385, 'D', 1, 'D', 138, 3.46),
('D9', 329, 'D', 1, 'D', 106, 3.13),
('E1', 356, 'E', 1, 'E', 105, 1.69),
('E2', 137, 'E', 1, 'E', 59, 4.42),
('E3', 135, 'E', 1, 'E', 87, 1.93),
('E4', 150, 'E', 1, 'E', 131, 3.56),
('E5', 422, 'E', 1, 'E', 122, 4.7),
('E6', 442, 'E', 1, 'E', 104, 1.9),
('E7', 392, 'E', 1, 'E', 117, 4.98),
('E8', 478, 'E', 1, 'E', 73, 1.05),
('E9', 173, 'E', 1, 'E', 92, 2.57),
('E10', 454, 'E', 1, 'E', 105, 1.81),
('E11', 320, 'E', 1, 'E', 81, 3.96),
('E12', 369, 'E', 1, 'E', 79, 2.82),
('E13', 315, 'E', 1, 'E', 96, 2.04),
('E14', 429, 'E', 1, 'E', 138, 2.34),
('E15', 323, 'E', 1, 'E', 66, 2.97),
('E16', 201, 'E', 1, 'E', 110, 2.28),
('E17', 123, 'E', 1, 'E', 131, 1.39),
('E18', 350, 'E', 1, 'E', 55, 2.72),
('E19', 153, 'E', 1, 'E', 116, 1.13),
('F1', 161, 'F', 1, 'F', 87, 4.88),
('F2', 362, 'F', 1, 'F', 133, 1.85),
('F3', 440, 'F', 1, 'F', 129, 4.03),
('F4', 224, 'F', 1, 'F', 106, 1.13),
('F5', 382, 'F', 1, 'F', 61, 3.23),
('F6', 187, 'F', 1, 'F', 69, 4.17),
('F7', 384, 'F', 1, 'F', 57, 3.55),
('F8', 270, 'F', 1, 'F', 136, 4.5),
('F9', 405, 'F', 1, 'F', 140, 4.3),
('F10', 387, 'F', 1, 'F', 134, 1.7),
('F11', 376, 'F', 1, 'F', 142, 3.99),
('F12', 346, 'F', 1, 'F', 108, 4.25),
('F13', 482, 'F', 1, 'F', 58, 3.95),
('F14', 144, 'F', 1, 'F', 134, 2.31),
('F15', 175, 'F', 1, 'F', 149, 2.31),
('F16', 306, 'F', 1, 'F', 81, 1.97),
('F17', 241, 'F', 1, 'F', 129, 2.24),
('F18', 483, 'F', 1, 'F', 120, 2.48),
('F19', 325, 'F', 1, 'F', 51, 1.57),
('G1', 332, 'G', 1, 'G', 93, 4.23),
('G2', 129, 'G', 1, 'G', 146, 1.17),
('G3', 364, 'G', 1, 'G', 143, 1.69),
('G4', 226, 'G', 1, 'G', 53, 4.13),
('G5', 338, 'G', 1, 'G', 63, 1.49),
('G6', 377, 'G', 1, 'G', 150, 1.52),
('G7', 449, 'G', 1, 'G', 50, 4.12),
('G8', 423, 'G', 1, 'G', 60, 3.66),
('G9', 130, 'G', 1, 'G', 146, 4.89),
('G10', 366, 'G', 1, 'G', 119, 4.65),
('G11', 358, 'G', 1, 'G', 76, 4.15),
('G12', 436, 'G', 1, 'G', 94, 1.04),
('G13', 219, 'G', 1, 'G', 53, 2.63),
('G14', 228, 'G', 1, 'G', 66, 2.12),
('G15', 149, 'G', 1, 'G', 61, 2.05),
('G16', 327, 'G', 1, 'G', 144, 4.89),
('G17', 108, 'G', 1, 'G', 59, 3.83),
('G18', 191, 'G', 1, 'G', 85, 3.42),
('G19', 418, 'G', 1, 'G', 102, 3.71),
('H1', 215, 'H', 1, 'H', 95, 2.26),
('H2', 107, 'H', 1, 'H', 131, 1.88),
('H3', 301, 'H', 1, 'H', 75, 1.15),
('H4', 457, 'H', 1, 'H', 112, 4.79),
('H5', 225, 'H', 1, 'H', 70, 3.22),
('H6', 429, 'H', 1, 'H', 52, 3.09),
('H7', 169, 'H', 1, 'H', 80, 2.17),
('H8', 266, 'H', 1, 'H', 148, 2.59),
('H9', 229, 'H', 1, 'H', 90, 3.95),
('H10', 387, 'H', 1, 'H', 53, 1.29),
('H11', 399, 'H', 1, 'H', 52, 1.79),
('H12', 188, 'H', 1, 'H', 131, 3.31),
('H13', 384, 'H', 1, 'H', 78, 3.34),
('H14', 104, 'H', 1, 'H', 117, 3.97),
('H15', 211, 'H', 1, 'H', 53, 4.61),
('H16', 336, 'H', 1, 'H', 104, 2.34),
('H17', 381, 'H', 1, 'H', 57, 3.2),
('H18', 491, 'H', 1, 'H', 82, 1.5),
('H19', 288, 'H', 1, 'H', 132, 3.87),
('aaa', 500, 'A', 0, 'A', 122, 2.23),
('sushi', 499, 'A', 1, 'A', 238, 3.63),
('dosa', 500, 'A', 1, 'A', 129, 4.63),
('rolls', 458, 'D', 0, 'A', 142, 3.53),
('idli', 100, 'A', 0, 'A', 123, 4.23),
('bhel', 253, 'A', 0, 'A', 3, 4.33333);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `category`) VALUES
(3, 'custom1', '$2y$10$e.K6yJi1dcwbt11bbF.f0eZ.vx08ySMhPzk2dLe9US0S1oRm6Njym', 0),
(5, 'A', '$2y$10$6hYskm/8h94Dy9lGlKWf8.A3UMLbHyELSqXaueTv1ePe7kz4kOTAm', 1),
(6, 'B', '$2y$10$GVxmzj5gTgjciJvPD3ZJN.5Wd0sLVoqgBLdNvkXFF1JOjgAwzf7am', 1),
(7, 'C', '$2y$10$1uz0TYtfVacVSW1a8kxXRure.EAhE.R7gwv8gU6zK/oXql0DaYP7e', 1),
(8, 'D', '$2y$10$LD6B47CjQ5Y6Qkgl7gU4QO9XgHh2jckHQdT3WaH75364IuATnkqu6', 1),
(9, 'E', '$2y$10$Zvay6uYrpp93AqufW8alyudrwcOZW/7DFDfq5THmoNXxyyNQpesXq', 1),
(10, 'F', '$2y$10$1HlB1oikcFsE2eexu8ceHOr7bMZ6M5XiDcdGTEVtXV38XW/w48jh2', 1),
(11, 'G', '$2y$10$giXpxAUDYlLTFKAva05CoeILeWL0bUdxLjg0kODQohK7RrViarP7W', 1),
(12, 'H', '$2y$10$EE7yY.THI9J2iqKaHHIA7.JI1riYLV5M8N5YBYjrhIBAUyCECYFnW', 1),
(14, 'Satyam', '$2y$10$W7xwI3FhuoENtzzPhcOFGuhU2U.SrzIQWqHZPGYJ3nR/.WqaUNwbm', 0),
(15, 'kishan', '$2y$10$rR7YZ2.2SCJraahgWeOYgeXDmGJHg/K4Zg9XcHXHFEU0OA5K0DcJG', 1),
(16, 'aaaa', '$2y$10$nFUpZxe10L6GyqfehvY0hev8QjSqLIIwhe2QnIUmHpUzpHJVTnMH6', 1),
(18, 'aniket1', '$2y$10$ZCeJ5s9dagzm1OY8hNc.FOZbtTDsAlgbiXLmwVQUfxYWM0ZPCBkaq', 0),
(19, 'manager1', '$2y$10$F8cwtGwQzJ2r2PJ0y3GP0OlIzss1puvz.4vnpy3FssGFv7wpSV0qq', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
