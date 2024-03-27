-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2024-03-26 22:30:09
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `vendor_ratings`
--

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`comment_id`, `vendor_id`, `comment`, `rating`, `created_at`) VALUES
(1, 1, '111', 5.0, '2024-03-25 22:40:24'),
(2, 1, '1', 5.0, '2024-03-25 22:49:51'),
(3, 1, '222', 3.0, '2024-03-26 00:39:15'),
(4, 1, '123', 1.0, '2024-03-26 00:44:07'),
(5, 1, '123213213', 4.0, '2024-03-26 21:22:53');

--
-- 触发器 `comments`
--
DELIMITER $$
CREATE TRIGGER `after_comment_insert` AFTER INSERT ON `comments` FOR EACH ROW BEGIN
    UPDATE vendors
    SET average_rating = (SELECT AVG(rating) FROM comments WHERE vendor_id = NEW.vendor_id)
    WHERE vendor_id = NEW.vendor_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `trash`
--

CREATE TABLE `trash` (
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `vendor_description` text DEFAULT NULL,
  `vendor_contact_info` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_description` text DEFAULT NULL,
  `vendor_contact_info` varchar(255) DEFAULT NULL,
  `average_rating` decimal(3,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `vendor_description`, `vendor_contact_info`, `average_rating`) VALUES
(1, 'Vendor 1', 'Description for Vendor 1', 'Contact Info for Vendor 1', 3.60),
(2, 'Vendor 2', 'Description for Vendor 2', 'Contact Info for Vendor 2', NULL),
(3, 'Vendor 3', 'Description for Vendor 3', 'Contact Info for Vendor 3', NULL),
(4, 'a', '', '', 0.00);

--
-- 转储表的索引
--

--
-- 表的索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- 表的索引 `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 限制导出的表
--

--
-- 限制表 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
