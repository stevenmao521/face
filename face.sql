-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?08 �?24 �?16:22
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `face`
--

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `cno` varchar(10) NOT NULL DEFAULT '',
  `cname` varchar(20) DEFAULT NULL,
  `tno` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`cno`,`tno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`cno`, `cname`, `tno`) VALUES
('c001', 'J2SE', 't002'),
('c002', 'Java Web', 't002'),
('c003', 'SSH', 't001'),
('c004', 'Oracle', 't001'),
('c005', 'SQL SERVER 2005', 't003'),
('c006', 'C#', 't003'),
('c007', 'JavaScript', 't002'),
('c008', 'DIV+CSS', 't001'),
('c009', 'PHP', 't003'),
('c010', 'EJB3.0', 't002');

-- --------------------------------------------------------

--
-- 表的结构 `sc`
--

CREATE TABLE IF NOT EXISTS `sc` (
  `sno` varchar(10) NOT NULL DEFAULT '',
  `cno` varchar(10) NOT NULL DEFAULT '',
  `score` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`sno`,`cno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sc`
--

INSERT INTO `sc` (`sno`, `cno`, `score`) VALUES
('s001', 'c001', '78.90'),
('s001', 'c002', '82.90'),
('s001', 'c003', '59.00'),
('s002', 'c001', '80.90'),
('s002', 'c002', '72.90'),
('s003', 'c001', '81.90'),
('s003', 'c002', '81.90'),
('s004', 'c001', '60.90');

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `sno` varchar(10) NOT NULL,
  `sname` varchar(20) DEFAULT NULL,
  `sage` int(11) DEFAULT NULL,
  `ssex` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`sno`, `sname`, `sage`, `ssex`) VALUES
('s001', '张三', 23, '男'),
('s002', '李四', 23, '男'),
('s003', '吴鹏', 25, '男'),
('s004', '琴沁', 20, '女'),
('s005', '王丽', 20, '女'),
('s006', '李波', 21, '男'),
('s007', '刘玉', 21, '男'),
('s008', '萧蓉', 21, '女'),
('s009', '陈萧晓', 23, '女'),
('s010', '陈美', 22, '女');

-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `tno` varchar(10) NOT NULL,
  `tname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`tno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher`
--

INSERT INTO `teacher` (`tno`, `tname`) VALUES
('t001', '刘阳'),
('t002', '谌燕'),
('t003', '胡明星');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
