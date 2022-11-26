-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 14, 2022 at 06:08 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'PHP'),
(16, 'css'),
(17, 'html'),
(18, 'js');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 1, 'jumaa', 'jumaa@gmail.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'approved', '2022-09-13'),
(5, 1, 'jumaa', 'jumaa.almarzouk@gmail.com', 'The first web browser with a graphical user interface, Mosaic, was released in 1993. Accessible to non-technical people, it played a prominent role in the rapid growth of the nascent World Wide Web.[15] The lead developers of Mosaic then founded the Netscape corporation, which released a more polished browser, Netscape Navigator, in 1994. This quickly became the most-used.', 'approved', '2022-09-13'),
(4, 1, 'jumaa', 'jumaa.almarzouk@gmail.com', 'In November 1996, Netscape submitted JavaScript to Ecma International, as the starting point for a standard specification that all browser vendors could conform to. This led to the official release of the first ECMAScript language specification in June 1997.\n\nThe standards process continued for a few years, with the release of ECMAScript 2 in June 1998 and ECMAScript 3 in December 1999. Work on ECMAScript 4 began in 2000.[20]\n\nMeanwhile, Microsoft gained an increasingly dominant position in the browser market. By the early 2000s, Internet Explorer\'s market share reached 95%.[24] This meant that JScript became the de facto standard for client-side scripting on the Web.\n\nMicrosoft initially participated in the standards process and implemented some proposals in its JScript language, but eventually it stopped collaborating on Ecma work. Thus ECMAScript 4 was mothballed.', 'approved', '2022-09-13'),
(6, 1, 'jumaa', 'jumaa.almarzouk@gmail.com', 'to testing count', 'unapproved', '2022-09-13'),
(7, 1, 'jumaa', 'jumaa.almarzouk@gmail.com', 'to testing count', 'unapproved', '2022-09-13'),
(8, 1, 'jumaa', 'jumaa.almarzouk@gmail.com', 'to testing count', 'unapproved', '2022-09-13'),
(9, 1, 'asd', 'jumaa.almarzouk@gmail.com', 'asd', 'unapproved', '2022-09-13'),
(10, 1, 'asd', 'jumaa.almarzouk@gmail.com', 'asd', 'unapproved', '2022-09-13'),
(11, 1, 'jumaa', 'jumaa.almarzouk@gmail.com', 'asd', 'unapproved', '2022-09-13'),
(12, 38, 'jumaa', 'jumaa.almarzouk@gmail.com', 'asd', 'unapproved', '2022-09-13'),
(13, 38, 'jumaa', 'jumaa.almarzouk@gmail.com', 'asd', 'unapproved', '2022-09-13'),
(14, 38, 'new commennt', 'jumaa.almarzouk@gmail.com', 'asd', 'unapproved', '2022-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `post_author` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `post_user` varchar(11) COLLATE utf32_unicode_ci NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text COLLATE utf32_unicode_ci NOT NULL,
  `post_content` text COLLATE utf32_unicode_ci NOT NULL,
  `post_tags` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `post_comment_count` int(11) NOT NULL DEFAULT '0',
  `post_status` varchar(255) COLLATE utf32_unicode_ci NOT NULL DEFAULT 'draft',
  `post_view_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_view_count`) VALUES
(1, 1, 'asd', 'ss', '', '2022-09-13', 'place.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ', 'javascript', 3, 'published', 55),
(38, 1, 'qwe', 'qwe', 'jumaa', '2022-09-13', 'fav.png', 'qwe', 'qwe', 6, 'draft', 4),
(39, 18, 'reactjs', 'rama', 'jumaa', '2022-09-13', 'logo-footer.png', 'rr', 'asd', 0, 'draft', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `user_firstname` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `user_lastname` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `user_image` text COLLATE utf32_unicode_ci NOT NULL,
  `user_role` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `randSalt` varchar(255) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(1, 'rama', 'rama', 'rama', 'darwich', 'rama@gmail.com', '', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
