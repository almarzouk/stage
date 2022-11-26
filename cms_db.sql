-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 26, 2022 at 02:07 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

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
(17, 'html');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(30) NOT NULL DEFAULT 'unapproved',
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(5, 52, 'asd', 'jumaa.almarzouk@gmail.com', 'asdasda', 'approved', '2022-11-26 13:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `post_author` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `post_user` varchar(11) COLLATE utf32_unicode_ci NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text COLLATE utf32_unicode_ci NOT NULL,
  `post_content` text COLLATE utf32_unicode_ci NOT NULL,
  `post_tags` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `post_status` varchar(255) COLLATE utf32_unicode_ci NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES
(41, 1, 'Top 8 Practical Applications of PHP and Steps to Carve a Career in the Field', NULL, 'jm', '2022-09-19', 'unnamed.jpg', '<p><span style=\"color: rgb(81, 86, 94); font-family: Helvetica;\">PHP is a server-side scripting language that is widely used for web development and business application. The open-source tools and high running speed make PHP one of the most preferred languages for creating interactive websites and web applications. Some of the biggest web platforms of today, including Facebook, Flickr, Yahoo, MailChimp, and Wikipedia, to name a few, use PHP in their end-to-end computing infrastructure.&nbsp;</span><br></p>', 'By Matthew David', 'published'),
(43, 1, 'Top 8 Practical Applications of PHP ', NULL, 'jm', '2022-09-19', '325-3251632_when-you-need-facts-man-reading-book-png.png', '<p><span style=\"color: rgb(81, 86, 94); font-family: Roboto, sans-serif;\">A web page or web application is required to offer high levels of customization, a very interactive user interface and should be able to perform online transactions and integrate with database systems. PHP ensures all these features are achieved through its three-tiered architecture that works in a linear fashion on browser, server, and database systems. This explains why more than 82% of websites use PHP for server-side programming. Numerous web-based applications and Facebook apps are scripted in PHP too.</span><br></p>', 'php', 'draft'),
(44, 1, 'Web Content Management Systems', NULL, 'jm', '2022-09-19', 'Content-management-systems-CMS.jpg', '<p><span style=\"color: rgb(81, 86, 94); font-family: Roboto, sans-serif;\">PHP supports various databases like Oracle, MySQL, and MS Access and is designed to interact with other services using protocols such as HTTP, LDAP, POP3, IMAP, NNTP, SNM, and COM. Many PHP frameworks offer templates, libraries through which developers can manage and manipulate the content of a website. Thus, PHP is used to create small static websites as well as large content-based sites. Some of the best Web Content Management Systems (CMS) managed by PHP are WordPress and its plugins, user interface of Drupal, Joomla, Facebook, MediaWiki, Silverstripe, and Digg, among others.&nbsp;</span><br></p>', 'php', 'published'),
(46, 1, 'Image Processing and Graphic Design', NULL, 'jm', '2022-09-19', 'computer-monitor-graphic-animator-creating-video-game-modeling-motion-processing-video-file-using-professional-editor-vector-illustration-graphic-design-art-designer-workplace-concept_74855-13038.jpg', '<p><span style=\"color: rgb(81, 86, 94); font-family: Roboto, sans-serif;\">Also prominent among applications of PHP is its use to manipulate images. Various image processing libraries like Imagine, GD library, and ImageMagick can be integrated with PHP applications to allow a wide range of image processing features, including rotating, cropping, resizing, adding watermarks, creating thumbnail pictures, and generating output images in many formats. The different formats of output images can be jpeg, gif, wbmp, xpm, and png. This is an essential prerequisite for creating robust websites and web applications.</span><br></p>', 'Image Processing and Graphic Design', 'published'),
(52, 1, 'los', NULL, 'rama', '2024-11-22', '1_oGHdLjxUW-dGByyLm9rM8Q.jpeg', '<p>lose content</p>', 'lose', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `user_firstname` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `user_lastname` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `user_role` varchar(255) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_role`) VALUES
(10, 'rama', '$2y$10$p/UL57c2SSbuMSwIiFEEheMK3k0xaowVCimGT9LNGgi6qjQiQIPuC', 'ramos', 'darwich', 'rama@gmail.com', 'admin'),
(11, 'jumaas', '$2y$10$pFH2euFF5f.m1e7K.EHrUONw2I5E5prLg9be7yevZ3lHlfyZXnVWy', 'Jumaas', 'ALMARZOUK', 'jumaa.almarzouk@gmail.com', 'subscriber'),
(12, 'jumaas', '$2y$10$0h0GesKL2j2o/Tq9ZWbK9e1HY7lyC3P9sInPpGGD3zdEr3/lXuQPe', 'Jumaas', 'ALMARZOUK', 'jumaa.almarzouk@gmail.com', 'admin');

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
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_controll` (`comment_post_id`);

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
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_controll` FOREIGN KEY (`comment_post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
