-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019-03-05 20:56:35
-- 服务器版本： 5.7.21-1
-- PHP Version: 7.2.4-1+b1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_config`
--

CREATE TABLE `tbl_config` (
  `id` int(11) NOT NULL,
  `open_ctrl` tinyint(1) NOT NULL COMMENT '系统开启控制',
  `feedback_open_ctrl` tinyint(1) NOT NULL COMMENT '问卷系统控制',
  `feedback_strict_ctrl` tinyint(1) NOT NULL COMMENT '问卷系统强制填写控制',
  `meeting_open_ctrl` tinyint(1) NOT NULL COMMENT '接车系统控制',
  `register_open_ctrl` tinyint(1) NOT NULL COMMENT '报道流程系统控制'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_dept`
--

CREATE TABLE `tbl_dept` (
  `dept_id` smallint(6) NOT NULL COMMENT '院系id',
  `dept_name` text NOT NULL COMMENT '院系名称'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='院系信息表';

-- --------------------------------------------------------

--
-- 表的结构 `tbl_major`
--

CREATE TABLE `tbl_major` (
  `major_id` smallint(6) NOT NULL COMMENT '专业id',
  `major_name` text NOT NULL COMMENT '专业名称',
  `major_summary` text NOT NULL COMMENT '专业介绍',
  `dept_id` smallint(6) NOT NULL COMMENT '所属院系id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `id` int(11) NOT NULL COMMENT '权限id',
  `permission_name` text NOT NULL COMMENT '权限名称',
  `base_section` smallint(6) NOT NULL COMMENT '基础权限控制',
  `stu_info_section` smallint(6) NOT NULL COMMENT '学生信息权限控制',
  `info_section` smallint(6) NOT NULL COMMENT '通知服务权限控制',
  `feedback_section` smallint(6) NOT NULL COMMENT '问卷系统权限控制',
  `meeting_section` smallint(6) NOT NULL COMMENT '接车系统权限控制',
  `register_section` smallint(6) NOT NULL COMMENT '报到流程系统权限控制'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `permission` smallint(6) NOT NULL,
  `dept_id` smallint(6) NOT NULL,
  `is_used` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='管理员信息表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dept`
--
ALTER TABLE `tbl_dept`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `tbl_major`
--
ALTER TABLE `tbl_major`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
