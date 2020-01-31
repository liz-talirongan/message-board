-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2020 at 07:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `message-board`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `to_id`, `from_id`, `content`, `created`, `modified`) VALUES
(58, 11, 9, 'Sending u a message \r\n\r\n-Johneliz', '2020-01-28 02:52:06', '2020-01-28 02:52:06'),
(59, 9, 11, 'Replying for your message Liz\r\n\r\n-Joe', '2020-01-28 02:52:50', '2020-01-28 02:52:50'),
(60, 11, 9, 'Hi thank you for the reply', '2020-01-28 03:00:29', '2020-01-28 03:00:29'),
(61, 9, 11, 'No Worries', '2020-01-28 03:01:37', '2020-01-28 03:01:37'),
(62, 9, 11, 'Got a question coming up', '2020-01-28 03:11:07', '2020-01-28 03:11:07'),
(66, 10, 11, 'Hi!', '2020-01-28 04:25:17', '2020-01-28 04:25:17'),
(76, 11, 9, 'Red Velvet\n', '2020-01-29 06:27:49', '2020-01-29 06:27:49'),
(77, 11, 9, 'Black Pink', '2020-01-29 06:28:10', '2020-01-29 06:28:10'),
(78, 9, 11, 'G\'Idle', '2020-01-29 06:28:35', '2020-01-29 06:28:35'),
(79, 9, 11, 'Twice ', '2020-01-29 06:28:40', '2020-01-29 06:28:40'),
(80, 9, 11, '		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n', '2020-01-29 06:28:59', '2020-01-29 06:28:59'),
(81, 9, 11, 'Keep the messages coming!!', '2020-01-29 06:29:19', '2020-01-29 06:29:19'),
(82, 11, 9, 'Rodger that!!!', '2020-01-29 06:29:57', '2020-01-29 06:29:57'),
(85, 11, 9, '		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-01-29 08:11:16', '2020-01-29 08:11:16'),
(87, 11, 9, '		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-01-29 09:49:36', '2020-01-29 09:49:36'),
(88, 11, 9, '	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-01-29 09:50:02', '2020-01-29 09:50:02'),
(89, 11, 9, 'test', '2020-01-29 10:45:29', '2020-01-29 10:45:29'),
(90, 9, 11, '		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-01-29 10:58:38', '2020-01-29 10:58:38'),
(92, 9, 19, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n', '2020-01-30 01:47:44', '2020-01-30 01:47:44'),
(93, 19, 9, 'message again', '2020-01-30 03:47:32', '2020-01-30 03:47:32'),
(95, 11, 9, 'test message 1', '2020-01-30 09:34:09', '2020-01-30 09:34:09'),
(98, 20, 9, 'Still seeking for New World', '2020-01-31 01:23:58', '2020-01-31 01:23:58'),
(117, 10, 9, 'test', '2020-01-31 01:49:22', '2020-01-31 01:49:22'),
(118, 11, 9, 'reply message', '2020-01-31 02:29:30', '2020-01-31 02:29:30'),
(123, 20, 21, 'LUFFFY!!!', '2020-01-31 02:59:14', '2020-01-31 02:59:14'),
(125, 21, 9, 'hello', '2020-01-31 06:21:50', '2020-01-31 06:21:50'),
(126, 11, 9, 'u there ?', '2020-01-31 06:24:12', '2020-01-31 06:24:12'),
(127, 9, 11, 'im here\n', '2020-01-31 06:24:31', '2020-01-31 06:24:31'),
(128, 20, 10, 'Luffy', '2020-01-31 06:51:39', '2020-01-31 06:51:39'),
(129, 21, 19, 'Yo', '2020-01-31 07:00:13', '2020-01-31 07:00:13'),
(131, 19, 21, 'reply message', '2020-01-31 07:00:42', '2020-01-31 07:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `hubby` text NOT NULL,
  `last_login_time` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_ip` varchar(20) NOT NULL,
  `modified_ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `birthdate`, `hubby`, `last_login_time`, `created`, `modified`, `created_ip`, `modified_ip`) VALUES
(9, 'Johneliz', 'liz@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '202001291384762607-puffer.jpg', '2', '1995-07-13', 'Watching Horror Movie', '2020-01-31 06:36:49', '2020-01-24 04:09:25', '2020-01-31 06:36:49', '::1', '::1'),
(10, 'Sammantha', 'sam@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '202001301564825250-dog.jpg', '2', '1997-04-04', 'Reading Shoujo Manga', '2020-01-31 06:48:49', '2020-01-31 06:48:40', '2020-01-31 06:48:49', '::1', '::1'),
(11, 'joedoe', 'joe@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '20200129844214417-cat.jpg', '1', '1996-03-11', 'Playing Basketball', '2020-01-31 06:24:23', '2020-01-24 04:15:00', '2020-01-31 06:24:23', '::1', '::1'),
(19, 'Alvin Chipmunks', 'alv@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '202001301994235980-chipmunk.png', '1', '1998-12-13', '*Browsing through social media accounts\r\n\r\n*Playing Volleyball 213', '2020-01-31 07:00:00', '2020-01-30 01:34:00', '2020-01-31 07:00:00', '::1', '::1'),
(20, 'Monkey D. Luffy', 'luffy@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '202001311900440641-luffy.jpg', '1', '1995-07-27', 'Eating!!!!', '2020-01-31 02:32:56', '2020-01-31 01:22:44', '2020-01-31 02:33:25', '::1', '::1'),
(21, 'Roronoa Zoro', 'zoro@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '202001312130265102-zoro.jpg', '1', '1998-12-15', 'Sleeping!!', '2020-01-31 07:00:35', '2020-01-31 02:41:48', '2020-01-31 07:16:55', '::1', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
