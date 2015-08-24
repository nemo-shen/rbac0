-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-08-24 08:43:58
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rbac`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `name`, `content`, `time`) VALUES
(4, 'sdfsdfsdf1', '<p>sdf水水水水sdfsdf说的都是发生的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的</p>\r\n', 1438249895),
(5, 'sdfsdfsdf2', '<p>sdf水水水水sdfsdf说的都是发生的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的</p>\r\n', 1438249895),
(6, 'sdfsdfsdf3', '<p>sdf水水水水sdfsdf说的都是发生的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的</p>\r\n', 1438249895),
(7, 'sdfsdfsdf4', '<p>sdf水水水水sdfsdf说的都是发生的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的</p>\r\n', 1438249895),
(8, 'sdfsdfsdf5', '<p>sdf水水水水sdfsdf说的都是发生的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的</p>\r\n', 1438249895),
(9, 'sdfsdfsdf6', '<p>sdf水水水水sdfsdf说的都是发生的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的</p>\r\n', 1438249895),
(10, 'sdfsdfsdf7', '<p>sdf水水水水sdfsdf说的都是发生的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的</p>\r\n', 1438249895),
(11, 'sdfsdfsdf8', '<p>sdf水水水水sdfsdf说的都是发生的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的</p>\r\n', 1438249895),
(12, '水电费水电费', '<p>水电费水电费水电费是</p>\r\n', 1438681348),
(13, '的淡淡的的', '<p>的淡淡的</p>\r\n', 1438681397);

-- --------------------------------------------------------

--
-- 表的结构 `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '权限名',
  `fname` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '类方法名',
  `pid` int(11) unsigned NOT NULL COMMENT '权限父ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='权限表' AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `permission`
--

INSERT INTO `permission` (`id`, `name`, `fname`, `pid`) VALUES
(2, '用户管理', '', 0),
(3, '文章管理', '', 0),
(4, '权限管理', '', 0),
(19, '修改文章', 'editArticle', 3),
(18, '查看文章列表', 'articleList', 3),
(16, '修改用户', 'editUser', 2),
(17, '添加文章', 'addArticle', 3),
(14, '添加用户', 'addUser', 2),
(15, '删除用户', 'delUser', 2),
(20, '删除文章', 'delArticle', 3),
(21, '修改权限', 'editPermission', 4),
(22, '添加权限', 'addPermission', 4),
(23, '删除权限', 'delPermission', 4),
(26, '角色管理', '', 0),
(27, '查看角色列表', 'roleList', 26),
(28, '添加角色', 'addRole', 26),
(29, '删除角色', 'delRole', 26),
(30, '修改角色', 'editRole', 26),
(35, '查看权限列表', 'permissionList', 4),
(39, '查看特定权限', 'showPermission', 4),
(37, '查看指定文章', 'showArtticle', 3),
(38, '查看特定角色', 'showRole', 26),
(40, '允许登陆后台', 'login', 2),
(41, '查看指定用户', 'showUser', 2),
(42, '查看用户列表', 'userList', 2);

-- --------------------------------------------------------

--
-- 表的结构 `permission_assignment`
--

CREATE TABLE IF NOT EXISTS `permission_assignment` (
  `rid` int(11) unsigned NOT NULL COMMENT '角色ID',
  `pid` int(11) unsigned NOT NULL COMMENT '权限ID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='权限与角色关联表';

--
-- 转存表中的数据 `permission_assignment`
--

INSERT INTO `permission_assignment` (`rid`, `pid`) VALUES
(1, 2),
(1, 16),
(1, 40),
(1, 41),
(1, 14),
(1, 15),
(1, 3),
(1, 19),
(1, 18),
(1, 17),
(1, 20),
(1, 4),
(1, 21),
(1, 22),
(1, 23),
(2, 2),
(2, 16),
(2, 14),
(2, 15),
(2, 3),
(2, 19),
(2, 18),
(2, 17),
(2, 20),
(3, 3),
(3, 18),
(4, 27),
(4, 26),
(4, 28),
(4, 29),
(4, 30),
(1, 42),
(1, 37),
(1, 35),
(1, 39),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 38),
(4, 38),
(3, 37),
(3, 17),
(3, 27),
(4, 4),
(4, 35),
(4, 40),
(4, 2),
(11, 27),
(11, 26),
(4, 42),
(4, 14),
(13, 2),
(13, 16),
(13, 40),
(13, 41),
(13, 42),
(13, 26),
(13, 27),
(11, 2),
(11, 42),
(11, 40),
(11, 16),
(11, 30),
(11, 38),
(11, 41),
(11, 4),
(11, 35);

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `pid` int(11) NOT NULL COMMENT '角色的父角色ID',
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '角色名',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `pid`, `name`) VALUES
(1, 0, '上帝之手'),
(2, 1, '管理员'),
(3, 1, '普通用户'),
(4, 1, '角色管理员'),
(7, 1, 'sdfffff'),
(10, 1, 'sdfsdfffff_admin'),
(11, 4, 'juese_son'),
(12, 4, 'juese_son2'),
(13, 1, '用户角色添加者');

-- --------------------------------------------------------

--
-- 表的结构 `ssss`
--

CREATE TABLE IF NOT EXISTS `ssss` (
  `sass` int(33) NOT NULL,
  `aasasas` varchar(333) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `pass` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表' AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `pass`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'admin2', 'c84258e9c39059a89ab77d846ddab909'),
(3, 'yonghu', 'b05004cbc0badc65d3db340fae8dc74f'),
(4, 'juese', 'd0f88e4a7863c418691aedd1f579c99d'),
(6, 'juese_son', '0aecaa783246b62b9408667569b67d28'),
(7, 'yonghujuese', '3d250967cf6afa00e9f59430adcbb1b9'),
(8, 'normal_user', '5b52e26247e902315446aac1a91630d4'),
(22, 'normal_user2', 'efe8f0e7ffccad02e9953f85aa7f8bd0');

-- --------------------------------------------------------

--
-- 表的结构 `user_assignment`
--

CREATE TABLE IF NOT EXISTS `user_assignment` (
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `rid` int(11) unsigned NOT NULL COMMENT '角色ID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='用户与角色关联表';

--
-- 转存表中的数据 `user_assignment`
--

INSERT INTO `user_assignment` (`uid`, `rid`) VALUES
(1, 1),
(2, 3),
(1, 2),
(4, 4),
(3, 3),
(7, 13),
(2, 2),
(8, 3),
(6, 3),
(4, 2),
(6, 11),
(22, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
