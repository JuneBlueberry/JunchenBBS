-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-01-28 16:18:07
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jcbbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `bbs_board`
--

CREATE TABLE IF NOT EXISTS `bbs_board` (
  `boardId` int(11) NOT NULL AUTO_INCREMENT COMMENT '版块编号',
  `boardName` varchar(50) NOT NULL COMMENT '版块标题',
  `parentId` int(11) NOT NULL COMMENT '父版块标号',
  PRIMARY KEY (`boardId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `bbs_board`
--

INSERT INTO `bbs_board` (`boardId`, `boardName`, `parentId`) VALUES
(1, 'Java', 1),
(2, 'PHP', 1),
(3, 'C++', 1),
(4, 'Android', 1),
(5, 'Ios', 1);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_reply`
--

CREATE TABLE IF NOT EXISTS `bbs_reply` (
  `replyId` int(11) NOT NULL AUTO_INCREMENT COMMENT '回帖编号',
  `title` varchar(50) NOT NULL COMMENT '回帖标题',
  `content` varchar(1000) NOT NULL COMMENT '回帖内容',
  `publishTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发帖时间',
  `modifyTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `uId` int(11) NOT NULL COMMENT '用户编号',
  `topicId` int(11) NOT NULL COMMENT '帖子编号',
  PRIMARY KEY (`replyId`),
  KEY `fk_uId` (`uId`),
  KEY `fk_pId` (`topicId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_topic`
--

CREATE TABLE IF NOT EXISTS `bbs_topic` (
  `topicId` int(11) NOT NULL AUTO_INCREMENT COMMENT '帖子编号',
  `title` varchar(50) NOT NULL COMMENT '帖子标题',
  `content` varchar(1000) NOT NULL COMMENT '帖子内容',
  `publishTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发帖时间',
  `modifyTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `uId` int(11) NOT NULL COMMENT '用户编号',
  `boardId` int(11) NOT NULL COMMENT '版块编号',
  PRIMARY KEY (`topicId`),
  KEY `fk_uId` (`uId`),
  KEY `fk_bId` (`boardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_user`
--

CREATE TABLE IF NOT EXISTS `bbs_user` (
  `uId` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `uName` varchar(50) NOT NULL COMMENT '用户名',
  `uPass` varchar(10) NOT NULL COMMENT '密码',
  `head` varchar(50) NOT NULL COMMENT '头像',
  `regTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `gender` smallint(6) NOT NULL COMMENT '性别',
  PRIMARY KEY (`uId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `bbs_user`
--

INSERT INTO `bbs_user` (`uId`, `uName`, `uPass`, `head`, `regTime`, `gender`) VALUES
(1, 'qq', '', '1.gif', '2011-03-17 14:25:12', 2),
(2, 'ww', 'ww', '2.gif', '2011-03-17 14:14:12', 1),
(3, 'ee', 'ee', '3.gif', '2011-03-17 14:14:12', 2),
(4, 'rr', 'rr', '4.gif', '2011-03-17 14:14:12', 1),
(5, 'tt', 'tt', '5.gif', '2011-03-17 14:14:12', 2);

--
-- 限制导出的表
--

--
-- 限制表 `bbs_reply`
--
ALTER TABLE `bbs_reply`
  ADD CONSTRAINT `bbs_reply_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `bbs_user` (`uId`),
  ADD CONSTRAINT `bbs_reply_ibfk_2` FOREIGN KEY (`topicId`) REFERENCES `bbs_topic` (`topicId`);

--
-- 限制表 `bbs_topic`
--
ALTER TABLE `bbs_topic`
  ADD CONSTRAINT `bbs_topic_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `bbs_user` (`uId`),
  ADD CONSTRAINT `bbs_topic_ibfk_2` FOREIGN KEY (`boardId`) REFERENCES `bbs_board` (`boardId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
