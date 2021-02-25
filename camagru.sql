-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2019 at 07:13 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `img_id` bigint(20) NOT NULL,
  `username` varchar(250) NOT NULL,
  `comment` varchar(2220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `img_id`, `username`, `comment`) VALUES
(1, 17, 'gmakhobe', 'Nice Image Man'),
(2, 18, 'gmakhobe', 'Nice Hat Filter'),
(4, 18, 'xmethula', 'Thanks'),
(5, 18, 'xmethula', 'This is agreat thing'),
(6, 17, 'xmethula', 'Yes from xmethula');

-- --------------------------------------------------------

--
-- Table structure for table `imgs`
--

CREATE TABLE `imgs` (
  `id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `uploaded_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `superposable_1` enum('hat','glasses','thumb','NULL') NOT NULL,
  `superposable_2` enum('hat','glasses','thumb','NULL') NOT NULL,
  `superposable_3` enum('hat','glasses','thumb','NULL') NOT NULL,
  `superposable_nums` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imgs`
--

INSERT INTO `imgs` (`id`, `username`, `img_url`, `uploaded_date`, `superposable_1`, `superposable_2`, `superposable_3`, `superposable_nums`) VALUES
(11, 'gmakhobe', 'uploads/oBCX8SwW54zjWxbcX7nbOaAnKvOluuubeYBvIhDo9hwsfiLLea42.png', '2019-11-06 09:57:17', 'thumb', 'NULL', 'NULL', 1),
(12, 'gmakhobe', 'uploads/jVPgD1foHFdVZVXItqa4Be5RmXpqcHoA61IJx3DFtmPKn3xPdIimages.jpg', '2019-11-06 10:00:38', 'glasses', 'hat', 'NULL', 2),
(13, 'gmakhobe', 'uploads/SFvLpmakqMFM08Q7Kb3MK67LADoxn0I2HUrMFzpGQJXglzVrKQ42.png', '2019-11-06 10:02:28', 'glasses', 'hat', 'thumb', 3),
(14, 'gmakhobe', 'uploads/PdIuessTO4QsVw0qoMvuzkrSj7qjWDx0jPnHLb2A9E6nNIGkzl42.png', '2019-11-06 10:18:41', 'NULL', 'NULL', 'NULL', 0),
(15, 'xmethula', 'uploads/IA3ajKFt0D6zfYxj9jfAHYAucKxK4vIgtupw1ROgjKZYjEup8Z18236451-only-one-tress.jpg', '2019-11-06 13:33:39', 'glasses', 'NULL', 'NULL', 1),
(16, 'gmakhobe', 'uploads/IcaSuEMiDN1n9SrqWwgNOJhIDkZcnzCkN6lS3EydsIpshM4Wuyman-fakes-death-cat-q6u_2z9w.png', '2019-11-08 07:17:20', 'NULL', 'NULL', 'NULL', 0),
(17, 'gmakhobe', 'uploads/qrLngQlx6gJqzM5rGKIxNVNYNmOpwqVy6pBws5CXNPQWLFM0Xhmaxresdefault.jpg', '2019-11-08 07:17:40', 'NULL', 'NULL', 'NULL', 0),
(18, 'gmakhobe', 'uploads/HyFQ4qB9rJcK1Ap7iplRWNkbNwAeFFmQyZfFkI5jV66rnQIaHZ85936683.jpg', '2019-11-08 07:17:58', 'hat', 'NULL', 'NULL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) NOT NULL,
  `img_id` bigint(20) NOT NULL,
  `username` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `img_id`, `username`) VALUES
(1, 15, 'gmakhobe'),
(5, 15, 'xmethula'),
(6, 14, 'xmethula'),
(7, 14, 'gmakhobe'),
(8, 11, 'gmakhobe'),
(9, 12, 'gmakhobe'),
(10, 17, 'gmakhobe');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `email_receiver` enum('Yes','No') NOT NULL,
  `account_status` enum('Deactivated','Activated') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `email_receiver`, `account_status`) VALUES
(3, 'gmakhobe', 'nzilanegiven@gmail.com', '98943edf358676d5990332e403f36856', 'Yes', 'Activated'),
(4, 'xmethula', 'hejice4325@imailto.net', '5e498ec27660fd03ebea3bf443a43a3b', 'Yes', 'Activated');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imgs`
--
ALTER TABLE `imgs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `img_url` (`img_url`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `imgs`
--
ALTER TABLE `imgs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
