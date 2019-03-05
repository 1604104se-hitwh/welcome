-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019-03-05 21:24:06
-- 服务器版本： 5.7.21-1
-- PHP Version: 7.2.4-1+b1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `result` bigint(20) UNSIGNED NOT NULL COMMENT '序列过的结果对象',
  `back_info` text NOT NULL COMMENT '反馈者信息',
  `info_type` smallint(6) NOT NULL COMMENT '信息类型',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='问卷收集数据库';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_feedconfig`
--

CREATE TABLE `tbl_feedconfig` (
  `open_feedpage` int(11) NOT NULL COMMENT '启动的问卷id',
  `real_name_set` tinyint(1) NOT NULL COMMENT '是否实名制'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='问卷配置数据库';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_feeditem`
--

CREATE TABLE `tbl_feeditem` (
  `id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `type` smallint(6) NOT NULL COMMENT '题目类型',
  `title` text NOT NULL COMMENT '题目',
  `context` text NOT NULL COMMENT '内容'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='问卷内容数据库';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_feedpage`
--

CREATE TABLE `tbl_feedpage` (
  `id` int(11) NOT NULL COMMENT '问卷id',
  `name` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='问卷数据库';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `result` (`result`);

--
-- Indexes for table `tbl_feedconfig`
--
ALTER TABLE `tbl_feedconfig`
  ADD PRIMARY KEY (`open_feedpage`,`real_name_set`);

--
-- Indexes for table `tbl_feeditem`
--
ALTER TABLE `tbl_feeditem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedpage`
--
ALTER TABLE `tbl_feedpage`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `result` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序列过的结果对象';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
