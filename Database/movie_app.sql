-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 12:59 AM
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
-- Database: `movie_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `added_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `user_id`, `movie_id`, `added_on`) VALUES
(1, 1, 3, '2025-07-19 18:05:00'),
(2, 2, 2, '2025-07-19 18:10:00'),
(3, 3, 5, '2025-07-19 18:12:00'),
(4, 5, 2, '2025-07-26 22:03:43'),
(5, 5, 7, '2025-07-26 22:05:09'),
(6, 5, 13, '2025-07-26 22:05:14'),
(7, 5, 15, '2025-07-26 22:05:16'),
(8, 5, 17, '2025-07-26 22:05:19'),
(9, 5, 20, '2025-07-26 22:05:21'),
(10, 1, 7, '2025-07-27 01:34:40'),
(11, 1, 2, '2025-07-27 01:34:44'),
(12, 1, 19, '2025-07-27 01:34:54'),
(13, 1, 30, '2025-07-27 01:34:58'),
(14, 1, 13, '2025-07-27 01:45:36'),
(15, 1, 17, '2025-07-27 01:45:41'),
(16, 1, 16, '2025-07-29 21:48:00'),
(17, 7, 35, '2025-07-30 20:58:30'),
(18, 7, 45, '2025-07-30 20:58:35'),
(19, 1, 9, '2025-08-05 18:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `mood` varchar(50) DEFAULT NULL,
  `runtime` int(11) DEFAULT NULL,
  `poster_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `genre`, `mood`, `runtime`, `poster_url`) VALUES
(1, 'Inception', 'Action', 'Mind-Bending', 148, 'https://media.themoviedb.org/t/p/original/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg'),
(2, 'The Notebook', 'Drama', 'Chill', 123, 'https://media.themoviedb.org/t/p/original/rNzQyW4f8B8cQeg7Dgj3n6eT5k9.jpg'),
(3, 'John Wick', 'Action', 'Exciting', 101, 'https://media.themoviedb.org/t/p/original/fZPSd91yGE9fCcCe6OoQr6E3Bev.jpg'),
(4, 'Parasite', 'Thriller', 'Tense', 132, 'https://media.themoviedb.org/t/p/original/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg'),
(5, 'La La Land', 'Drama', 'Feel-Good', 128, 'https://media.themoviedb.org/t/p/original/uDO8zWDhfWwoFdKS4fzkUJt0Rf0.jpg'),
(6, 'The Matrix', 'Action', 'Mind-Bending', 136, 'https://media.themoviedb.org/t/p/original/p96dm7sCMn4VYAStA6siNz30G1r.jpg'),
(7, 'Inside Out', 'Animation', 'Feel-Good', 95, 'https://media.themoviedb.org/t/p/original/2H1TmgdfNtsKlU9jKdeNyYL5y8T.jpg'),
(8, 'Interstellar', 'Sci-Fi', 'Mind-Bending', 169, 'https://media.themoviedb.org/t/p/original/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg'),
(9, 'The Godfather', 'Crime', 'Tense', 175, 'https://media.themoviedb.org/t/p/original/3bhkrj58Vtu7enYsRolD1fZdja1.jpg'),
(10, 'Titanic', 'Drama', 'Chill', 195, 'https://media.themoviedb.org/t/p/original/9xjZS2rlVxm8SFx8kPC3aIGCOYQ.jpg'),
(11, 'Avengers: Endgame', 'Action', 'Exciting', 181, 'https://media.themoviedb.org/t/p/original/ulzhLuWrPK07P1YkdWQLZnQh1JL.jpg'),
(12, 'Joker', 'Drama', 'Tense', 122, 'https://media.themoviedb.org/t/p/original/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg'),
(13, 'Finding Nemo', 'Animation', 'Feel-Good', 100, 'https://media.themoviedb.org/t/p/original/eHuGQ10FUzK1mdOY69wF5pGgEf5.jpg'),
(14, 'Shutter Island', 'Thriller', 'Mind-Bending', 138, 'https://media.themoviedb.org/t/p/original/nrmXQ0zcZUL8jFLrakWc90IR8z9.jpg'),
(15, 'Coco', 'Animation', 'Feel-Good', 105, 'https://media.themoviedb.org/t/p/original/6Ryitt95xrO8KXuqRGm1fUuNwqF.jpg'),
(16, 'Whiplash', 'Drama', 'Tense', 107, 'https://media.themoviedb.org/t/p/original/7fn624j5lj3xTme2SgiLCeuedmO.jpg'),
(17, 'Spider-Man: Into the Spider-Verse', 'Animation', 'Exciting', 117, 'https://media.themoviedb.org/t/p/original/iiZZdoQBEYBv6id8su7ImL0oCbD.jpg'),
(18, 'Her', 'Romance', 'Chill', 126, 'https://media.themoviedb.org/t/p/original/eCOtqtfvn7mxGl6nfmq4b1exJRc.jpg'),
(19, 'The Dark Knight', 'Action', 'Tense', 152, 'https://media.themoviedb.org/t/p/original/qJ2tW6WMUDux911r6m7haRef0WH.jpg'),
(20, 'Soul', 'Animation', 'Mind-Bending', 100, 'https://media.themoviedb.org/t/p/original/pEz5aROvfy5FBW1OTlrDO3VryWO.jpg'),
(21, 'Arrival', 'Sci-Fi', 'Mind-Bending', 116, 'https://media.themoviedb.org/t/p/original/x2FJsf1ElAgr63Y3PNPtJrcmpoe.jpg'),
(22, 'Up', 'Animation', 'Feel-Good', 96, 'https://media.themoviedb.org/t/p/original/mFvoEwSfLqbcWwFsDjQebn9bzFe.jpg'),
(23, 'The Pursuit of Happyness', 'Drama', 'Chill', 117, 'https://media.themoviedb.org/t/p/original/lBYOKAMcxIvuk9s9hMuecB9dPBV.jpg'),
(24, 'Mad Max: Fury Road', 'Action', 'Exciting', 120, 'https://media.themoviedb.org/t/p/original/hA2ple9q4qnwxp3hKVNhroipsir.jpg'),
(25, 'A Quiet Place', 'Thriller', 'Tense', 90, 'https://media.themoviedb.org/t/p/original/nAU74GmpUk7t5iklEp3bufwDq4n.jpg'),
(26, 'Blade Runner 2049', 'Sci-Fi', 'Mind-Bending', 164, 'https://media.themoviedb.org/t/p/original/gajva2L0rPYkEWjzgFlBXCAVBE5.jpg'),
(27, 'Paddington 2', 'Family', 'Feel-Good', 103, 'https://media.themoviedb.org/t/p/original/1OJ9vkD5xPt3skC6KguyXAgagRZ.jpg'),
(28, 'The Grand Budapest Hotel', 'Comedy', 'Chill', 99, 'https://media.themoviedb.org/t/p/original/eWdyYQreja6JGCzqHWXpWHDrrPo.jpg'),
(29, 'Tenet', 'Action', 'Mind-Bending', 150, 'https://media.themoviedb.org/t/p/original/aCIFMriQh8rvhxpN1IWGgvH0Tlg.jpg'),
(30, '1917', 'War', 'Tense', 119, 'https://media.themoviedb.org/t/p/original/iZf0KyrE25z1sage4SYFLCCrMi9.jpg'),
(31, 'Zootopia', 'Animation', 'Exciting', 108, 'https://media.themoviedb.org/t/p/original/hlK0e0wAQ3VLuJcsfIYPvb4JVud.jpg'),
(32, 'Amélie', 'Romance', 'Feel-Good', 122, 'https://media.themoviedb.org/t/p/original/oTKduWL2tpIKEmkAqF4mFEAWAsv.jpg'),
(33, 'The Social Network', 'Drama', 'Tense', 120, 'https://media.themoviedb.org/t/p/original/n0ybibhJtQ5icDqTp8eRytcIHJx.jpg'),
(34, 'The Secret Life of Walter Mitty', 'Adventure', 'Chill', 114, 'https://media.themoviedb.org/t/p/original/tY6ypjKOOtujhxiSwTmvA4OZ5IE.jpg'),
(35, 'Edge of Tomorrow', 'Sci-Fi', 'Exciting', 113, 'https://media.themoviedb.org/t/p/original/c4BEWLbXyPiXNFaDt57HAgekCqw.jpg'),
(36, 'Dead Poets Society', 'Drama', 'Chill', 128, 'https://media.themoviedb.org/t/p/original/erzbMlcNHOdx24AXOcn2ZKA7R1q.jpg'),
(37, 'Get Out', 'Horror', 'Tense', 104, 'https://media.themoviedb.org/t/p/original/tFXcEccSQMf3lfhfXKSU9iRBpa3.jpg'),
(38, 'The Lego Movie', 'Animation', 'Exciting', 100, 'https://media.themoviedb.org/t/p/original/lbctonEnewCYZ4FYoTZhs8cidAl.jpg'),
(39, 'The Theory of Everything', 'Biography', 'Chill', 123, 'https://media.themoviedb.org/t/p/original/kJuL37NTE51zVP3eG5aGMyKAIlh.jpg'),
(40, 'Doctor Strange', 'Action', 'Mind-Bending', 115, 'https://media.themoviedb.org/t/p/original/uGBVj3bEbCoZbDjjl9wTxcygko1.jpg'),
(41, 'The Intouchables', 'Comedy', 'Feel-Good', 112, 'https://media.themoviedb.org/t/p/original/1QU7HKgsQbGpzsJbJK4pAVQV9F5.jpg'),
(42, 'Prisoners', 'Thriller', 'Tense', 153, 'https://media.themoviedb.org/t/p/original/uhviyknTT5cEQXbn6vWIqfM4vGm.jpg'),
(43, 'Ratatouille', 'Animation', 'Feel-Good', 111, 'https://media.themoviedb.org/t/p/original/t3vaWRPSf6WjDSamIkKDs1iQWna.jpg'),
(44, 'Moonlight', 'Drama', 'Chill', 111, 'https://media.themoviedb.org/t/p/original/rcICfiL9fvwRjoWHxW8QeroLYrJ.jpg'),
(45, 'Black Panther', 'Action', 'Exciting', 134, 'https://media.themoviedb.org/t/p/original/uxzzxijgPIY7slzFvMotPv8wjKA.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `mood` varchar(50) DEFAULT NULL,
  `min_runtime` int(11) DEFAULT NULL,
  `max_runtime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `genre`, `mood`, `min_runtime`, `max_runtime`) VALUES
(1, 'anas', 'anas@example.com', '$2y$10$XUkEycsHQsl8eAoeUX5UgO4W7ZTQ7aIiQ0bIXqS9RVCIcBrEs1RXu', 'Drama', 'Chill', 20, 200),
(2, 'chayce', 'chayce@example.com', '$2y$10$mChfJO8dVifVaeegd4t1e.2OPtxmme0CJYpNVzUSKGfSaxP/Nj/aG', 'Drama', 'Chill', 80, 130),
(3, 'George', 'george@example.com', '$2y$10$NQQr56K6ZjZAGzR4SFMU7OGIbWXa1QoocsKohbE7loiFM9KU5MaFW', 'Drama', 'Feel-Good', 90, 160),
(4, 'hassan', 'hassan@example.com', '$2y$10$kFCc9CmTcSxPWSvmgFIcfezMSFPDwHnpada/nwcsgzVWgqXh9m29O', 'horror', 'Mind-Bending', 20, 100),
(5, 'sadek', 'sadek@example.com', '$2y$10$IBpIvr5q5WjfrIkYzjUE4e60BCQ5OTrCaS3EqOKcndU1QodSLWMk.', 'Drama', 'Tense', 20, 200),
(6, 'adam', 'adam@example.com', '$2y$10$V4/FFT.cZyBTn3XyG9Syf.FBaxdV0JojrJKTkpYL91H0u2iq0NHs6', 'Drama', 'Chill', 15, 175),
(7, 'user', 'user@example.com', '$2y$10$y5bprn8VBN2yHApLIWnoPuCanyOC5gULl61uJOcMNT4ZMI8z2b/tC', 'Action', 'Exciting', 30, 195),
(8, 'phill', 'phill@example.com', '$2y$10$m78Ivawt9kCS.tLc5pubnuGlOjEApEBtMkTl3OoHaWvyfFCn4M9Ha', 'Romance', 'Feel-Good', 100, 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
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
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collections_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
