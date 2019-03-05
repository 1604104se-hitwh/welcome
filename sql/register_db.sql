-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019-03-05 21:37:36
-- 服务器版本： 5.7.21-1
-- PHP Version: 7.2.4-1+b1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_register_info`
--

CREATE TABLE `tbl_register_info` (
  `id` int(11) NOT NULL COMMENT '报到id',
  `title` text NOT NULL COMMENT '标题',
  `info` text NOT NULL COMMENT '报到内容',
  `map` bigint(20) UNSIGNED NOT NULL COMMENT '位置信息'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='报到流程信息';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_register_on`
--

CREATE TABLE `tbl_register_on` (
  `id` int(11) NOT NULL COMMENT '报到id',
  `stu_id` text NOT NULL COMMENT '新生id',
  `info_id` int(11) NOT NULL COMMENT '报到内容id',
  `checked` tinyint(1) NOT NULL COMMENT '是否完成此项报到'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='报到完成信息';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_register_info`
--
ALTER TABLE `tbl_register_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `map` (`map`);

--
-- Indexes for table `tbl_register_on`
--
ALTER TABLE `tbl_register_on`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tbl_register_info`
--
ALTER TABLE `tbl_register_info`
  MODIFY `map` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '位置信息';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
