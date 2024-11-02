-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 31, 2024 at 03:23 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Google`
--

-- --------------------------------------------------------

--
-- Table structure for table `definitions`
--

CREATE TABLE `definitions` (
  `id` int(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `definition` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `definitions`
--

INSERT INTO `definitions` (`id`, `keywords`, `definition`) VALUES
(1, '[\"Coding\",\"programming\"]', 'Coding involves typing queries'),
(2, '[\"1\",\"Coding\"]', 'Results of 2 and 3');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `url`, `image_url`, `content`) VALUES
(1, 'Example Website', 'This is an example website with informative content.', 'https://www.example.com', 'https://via.placeholder.com/80', 'This is a sample website with lots of interesting content about various topics.'),
(2, 'The Best Recipes', 'Find delicious and easy recipes for all occasions.', 'https://www.recipes.com', 'https://via.placeholder.com/80', 'A collection of recipes for breakfast, lunch, dinner, and desserts.'),
(3, 'Latest News', 'Stay up-to-date with the latest news from around the world.', 'https://www.news.com', 'https://via.placeholder.com/80', 'News articles, updates, and breaking stories from various sources.'),
(4, 'Amazing Travel Destinations', 'Discover incredible travel destinations and plan your next adventure.', 'https://www.travel.com', 'https://via.placeholder.com/80', 'Information on popular travel destinations, travel tips, and vacation ideas.'),
(5, 'Learn Coding Online', 'Interactive coding courses and tutorials for beginners and experienced developers.', 'https://www.learncoding.com', 'https://via.placeholder.com/80', 'A platform for learning programming languages and developing software skills.'),
(6, 'Science & Technology', 'Explore the latest advancements in science and technology.', 'https://www.sciencetech.com', 'https://via.placeholder.com/80', 'Articles on scientific discoveries, innovations, and technological breakthroughs.'),
(7, 'Online Shopping Deals', 'Find the best deals and discounts on products from various online retailers.', 'https://www.shoppingdeals.com', 'https://via.placeholder.com/80', 'A website for comparing prices and finding the best bargains on products.'),
(8, 'Fitness & Wellness', 'Tips and advice for achieving fitness goals and maintaining overall well-being.', 'https://www.fitnesswellness.com', 'https://via.placeholder.com/80', 'Articles on exercise, nutrition, mindfulness, and healthy lifestyle practices.'),
(9, 'Music and Entertainment', 'Discover new music, artists, and entertainment news.', 'https://www.musicent.com', 'https://via.placeholder.com/80', 'A website dedicated to music reviews, concert listings, and entertainment updates.'),
(10, 'Online Courses & Education', 'Enroll in online courses and programs to enhance your knowledge and skills.', 'https://www.onlinecourses.com', 'https://via.placeholder.com/80', 'A platform for finding and taking online courses in various subjects.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `definitions`
--
ALTER TABLE `definitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `definitions`
--
ALTER TABLE `definitions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
