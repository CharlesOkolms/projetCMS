-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-charlescoulon.alwaysdata.net
-- Generation Time: Jun 13, 2018 at 03:32 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charlescoulon_bccpcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id_article` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `headerphoto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `written` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_writer` int(10) UNSIGNED NOT NULL,
  `published` datetime DEFAULT NULL,
  `id_user_publisher` int(10) UNSIGNED DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `id_user_deleter` int(10) UNSIGNED DEFAULT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_tag`
--

CREATE TABLE `article_tag` (
  `id_article` int(10) UNSIGNED NOT NULL,
  `id_tag` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nom du site',
  `id_superadmin` int(10) UNSIGNED DEFAULT NULL,
  `id_homepage` int(10) UNSIGNED NOT NULL,
  `logo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `title`, `id_superadmin`, `id_homepage`, `logo`) VALUES
(1, 'Site des zér0s', 2, 1, 'sitelogo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id_page` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_creator` int(10) UNSIGNED NOT NULL,
  `id_template` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `id_style` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_article`
--

CREATE TABLE `page_article` (
  `id_article` int(10) UNSIGNED NOT NULL,
  `id_page` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `id_picture` int(10) UNSIGNED NOT NULL,
  `title` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_uploader` int(10) UNSIGNED NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_updator` int(10) UNSIGNED NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `id_user_deleter` int(11) UNSIGNED DEFAULT NULL,
  `extension` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `picture`
--
DELIMITER $$
CREATE TRIGGER `trig_beforeinsert_default_updator` BEFORE INSERT ON `picture` FOR EACH ROW BEGIN
	SET NEW.id_user_updator = NEW.id_user_uploader;
	SET NEW.uploaded = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `picture_tag`
--

CREATE TABLE `picture_tag` (
  `id_tag` int(10) UNSIGNED NOT NULL,
  `id_picture` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `style`
--

CREATE TABLE `style` (
  `id_style` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(10) UNSIGNED NOT NULL,
  `label` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id_template` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_creator` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `writer` tinyint(1) NOT NULL DEFAULT '0',
  `publisher` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_user_updater` int(10) UNSIGNED DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `id_user_deleter` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nickname`, `firstname`, `lastname`, `email`, `writer`, `publisher`, `admin`, `password`, `created`, `last_updated`, `id_user_updater`, `deleted`, `id_user_deleter`) VALUES
(1, 'Charleclerc', 'Charles', 'Coulon', 'c.coulon@cs2i-bourgogne.com', 1, 1, 1, '$2y$10$nsv7Keji61EpNXDfJ5yzkOOUmJV2whe7wHxBUnTRHvQ03r2wFDlIu', '2018-03-24 18:19:28', NULL, NULL, NULL, NULL),
(2, 'Thomas', 'Thomas', 'Bonney', 't.bonney@cs2i-bourgogne.com', 1, 1, 1, '$2y$10$FeHyx8x5Be1evYNk1bJ22.dEsdPY2G6/ibxz0Z3d1MrJwhDFU/vHG', '2018-05-14 14:21:10', '2018-05-14 14:21:10', NULL, NULL, NULL),
(3, 'Maxence', 'Maxence', 'Camus', 'm.camus@cs2i-bourgogne.com', 1, 1, 1, '$1$u/T5tBgq$FRwS9ks7GAo7U0mJuIeRz1', '2018-06-05 19:34:07', '2018-06-05 19:34:07', NULL, NULL, NULL),
(4, 'Test', 'test', 'heure', 'testeur@test.com', 0, 1, 0, '$2y$10$MvVXn4Yv5GatfEIyWUHEDuxAEl832bRsqdJ1Sb1NtHXF0tAvm/1/2', '2018-06-08 13:56:26', '2018-06-08 13:56:26', NULL, NULL, NULL),
(5, 'MisterBen58', 'Benjamin', 'Prieur', 'benjamin.prieur@protonmail.com', 1, 1, 1, '$1$KSHOiOE.$eVkna4M.UY/4z.o.tLqDR0', '2018-06-08 13:58:43', '2018-06-08 13:58:43', NULL, NULL, NULL),
(19, 'Pseudo', 'Prenom', 'Nom', 'email', 1, 0, 0, 'motdepasse_haché', '2018-06-11 15:47:14', '2018-06-11 15:47:14', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `fk_article_id_user` (`id_user_writer`),
  ADD KEY `fk_article_id_user_1` (`id_user_publisher`),
  ADD KEY `fk_article_id_user_2` (`id_user_deleter`);

--
-- Indexes for table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`id_article`,`id_tag`),
  ADD KEY `fk_article_tag_id_tag` (`id_tag`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meta___fk_superadmin` (`id_superadmin`),
  ADD KEY `meta__fk_homepage` (`id_homepage`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `fk_page_id_user` (`id_user_creator`),
  ADD KEY `fk_page_id_template` (`id_template`),
  ADD KEY `fk_page_id_style` (`id_style`);

--
-- Indexes for table `page_article`
--
ALTER TABLE `page_article`
  ADD PRIMARY KEY (`id_article`,`id_page`),
  ADD KEY `fk_page_article_id_page` (`id_page`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id_picture`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `fk_gallery_id_user` (`id_user_uploader`),
  ADD KEY `fk_gallery_id_user_deleter` (`id_user_updator`);

--
-- Indexes for table `picture_tag`
--
ALTER TABLE `picture_tag`
  ADD PRIMARY KEY (`id_tag`,`id_picture`),
  ADD KEY `fk_picture_tag_id_picture` (`id_picture`);

--
-- Indexes for table `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`id_style`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id_template`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_template_id_user` (`id_user_creator`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_id_user_1` (`id_user_updater`),
  ADD KEY `fk_user_id_user_2` (`id_user_deleter`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `id_picture` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `style`
--
ALTER TABLE `style`
  MODIFY `id_style` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id_template` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_id_user` FOREIGN KEY (`id_user_writer`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_article_id_user_1` FOREIGN KEY (`id_user_publisher`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_article_id_user_2` FOREIGN KEY (`id_user_deleter`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `fk_article_tag_id_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `fk_article_tag_id_tag` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`);

--
-- Constraints for table `meta`
--
ALTER TABLE `meta`
  ADD CONSTRAINT `meta___fk_superadmin` FOREIGN KEY (`id_superadmin`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `meta__fk_homepage` FOREIGN KEY (`id_homepage`) REFERENCES `page` (`id_page`);

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `fk_page_id_style` FOREIGN KEY (`id_style`) REFERENCES `style` (`id_style`),
  ADD CONSTRAINT `fk_page_id_template` FOREIGN KEY (`id_template`) REFERENCES `template` (`id_template`),
  ADD CONSTRAINT `fk_page_id_user` FOREIGN KEY (`id_user_creator`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `page_article`
--
ALTER TABLE `page_article`
  ADD CONSTRAINT `fk_page_article_id_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `fk_page_article_id_page` FOREIGN KEY (`id_page`) REFERENCES `page` (`id_page`);

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `fk_gallery_id_user` FOREIGN KEY (`id_user_uploader`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_gallery_id_user_1` FOREIGN KEY (`id_user_updator`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_gallery_id_user_deleter` FOREIGN KEY (`id_user_updator`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `picture_tag`
--
ALTER TABLE `picture_tag`
  ADD CONSTRAINT `fk_picture_tag_id_picture` FOREIGN KEY (`id_picture`) REFERENCES `picture` (`id_picture`),
  ADD CONSTRAINT `fk_picture_tag_id_tag` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`);

--
-- Constraints for table `template`
--
ALTER TABLE `template`
  ADD CONSTRAINT `fk_template_id_user` FOREIGN KEY (`id_user_creator`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_id_user_1` FOREIGN KEY (`id_user_updater`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_user_id_user_2` FOREIGN KEY (`id_user_deleter`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
