-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 10:09 PM
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
-- Database: `guide2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `guide_slug` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `guide_slug`, `user_name`, `comment`) VALUES
(8, 'faisal-mosque', 'Ashool Lakhani', 'Very good place, should visit for sure!'),
(9, 'faisal-mosque', 'Test Account', 'Yes, I will visit next year!');

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(900) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `coordinates` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`id`, `user_name`, `title`, `details`, `image`, `status`, `like_count`, `dislike_count`, `slug`, `coordinates`) VALUES
(29, 'Ashool Lakhani', 'Eiffel Tower ', 'Eiffel Tower, the symbol of Paris and a must-visit attraction. Designed by Gustave Eiffel and completed in 1889, this wrought-iron marvel stands tall at 324 meters. Take the elevator or climb the stairs to its observation decks for breathtaking panoramic views of the city. Capture stunning photos with the Seine River and Parisian skyline as your backdrop. Explore the tower\'s history and construction at the on-site exhibitions. Indulge in a delightful dining experience at the tower\'s restaurants, savoring French cuisine while enjoying the enchanting surroundings. Immerse yourself in the allure and romance of the Eiffel Tower, a true testament to architectural brilliance.', '6478f4ca66b0a.jpg', 1, 1, 0, 'eiffel-tower', '48.8584° N, 2.2945° E'),
(30, 'Ashool Lakhani', 'Faisal Mosque', 'Discover the beauty and serenity of Faisal Mosque, Islamabad\'s iconic landmark. Built-in 1986, this masterpiece combines traditional and modern architectural elements. Admire its elegant design featuring soaring minarets and a majestic central dome. Marvel at the intricate calligraphy and magnificent chandeliers within the prayer hall. Remember to dress modestly and respectfully, covering your head and removing your shoes before entering. Explore the tranquil gardens and courtyards surrounding the mosque. Visit the Shah Faisal Mosque Museum to learn about its history. Don\'t forget to capture the breathtaking views of Islamabad from nearby Daman-e-Koh. Experience the cultural and spiritual essence of Faisal Mosque, a true marvel of Pakistan.', '6478f7ff6529f.jpg', 1, 1, 0, 'faisal-mosque', '33.7295° N, 73.0372° E'),
(31, 'Test Account', 'Lisbon ', 'This is a test thing to see on pending guides!!!!', '6478f89e2275f.jpg', 0, 0, 0, 'lisbon', 'coordinates here');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(6, 'Ashool Lakhani', 'admin@gmail.com', 'eabed40bf5147b1102fa5f25675d0337', 'admin'),
(7, 'Test Account', 'test@gmail.com', 'c4d354440cb41ee38e162bc1f431e99b', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `guide`
--
ALTER TABLE `guide`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
