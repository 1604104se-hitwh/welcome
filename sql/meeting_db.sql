-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019-03-05 21:32:47
-- 服务器版本： 5.7.21-1
-- PHP Version: 7.2.4-1+b1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meeting_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_meeting_port`
--

CREATE TABLE `tbl_meeting_port` (
  `id` int(11) NOT NULL COMMENT '交通枢纽点id',
  `info` text NOT NULL COMMENT '枢纽点介绍及到校攻略'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='交通枢纽点';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_meeting_send`
--

CREATE TABLE `tbl_meeting_send` (
  `id` int(11) NOT NULL,
  `port_id` int(11) NOT NULL COMMENT '枢纽点id',
  `time` text NOT NULL COMMENT '大致时间点'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='提供接车服务信息';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_meeting_statistic`
--

CREATE TABLE `tbl_meeting_statistic` (
  `id` int(11) NOT NULL,
  `port_id` int(11) NOT NULL COMMENT '枢纽点id',
  `time` text NOT NULL COMMENT '大致时间点',
  `stu_id` text NOT NULL COMMENT '新生id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='接车服务信息统计';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_meeting_port`
--
ALTER TABLE `tbl_meeting_port`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_meeting_send`
--
ALTER TABLE `tbl_meeting_send`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_meeting_statistic`
--
ALTER TABLE `tbl_meeting_statistic`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
