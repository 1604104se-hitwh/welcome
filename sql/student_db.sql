-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019-03-05 21:11:53
-- 服务器版本： 5.7.21-1
-- PHP Version: 7.2.4-1+b1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_city_info`
--

CREATE TABLE `tbl_city_info` (
  `id` int(11) NOT NULL,
  `pro_id` smallint(6) NOT NULL,
  `city_id` smallint(6) NOT NULL,
  `city_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='市信息表';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_new_stu_info`
--

CREATE TABLE `tbl_new_stu_info` (
  `id` int(11) NOT NULL,
  `stu_id` text NOT NULL COMMENT '学号',
  `exam_id` text NOT NULL COMMENT '考号',
  `name` text NOT NULL COMMENT '姓名',
  `gender` text NOT NULL COMMENT '性别',
  `card_id` text NOT NULL COMMENT '身份证号码',
  `dormitory` text NOT NULL COMMENT '宿舍',
  `checked` tinyint(1) NOT NULL COMMENT '是否报道'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='新生信息表';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_pro_info`
--

CREATE TABLE `tbl_pro_info` (
  `id` int(11) NOT NULL,
  `pro_id` smallint(11) NOT NULL COMMENT '省份id',
  `pro_name` int(11) NOT NULL COMMENT '省名称'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='省信息表';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_stu_info`
--

CREATE TABLE `tbl_stu_info` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `card_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='老生信息表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_city_info`
--
ALTER TABLE `tbl_city_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_new_stu_info`
--
ALTER TABLE `tbl_new_stu_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pro_info`
--
ALTER TABLE `tbl_pro_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_info`
--
ALTER TABLE `tbl_stu_info`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
