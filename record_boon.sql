-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 09, 2013 at 03:30 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `record_boon`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `category`
-- 

CREATE TABLE `category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `subof` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `category`
-- 

INSERT INTO `category` VALUES (1, 'บันทึกผลการปฎิบัติธรรม', 0);
INSERT INTO `category` VALUES (2, 'กิจกรรมบุญ', 0);
INSERT INTO `category` VALUES (3, 'ธรรมะและข้อคิด', 0);
INSERT INTO `category` VALUES (4, 'comment', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `friend`
-- 

CREATE TABLE `friend` (
  `id` bigint(20) NOT NULL auto_increment,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `status_id` tinyint(4) NOT NULL,
  `send_date` datetime NOT NULL,
  `accept_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `friend`
-- 

INSERT INTO `friend` VALUES (4, 1, 5, 2, '2013-07-04 10:44:55', '2013-07-08 10:08:18');
INSERT INTO `friend` VALUES (5, 1, 2, 2, '2013-07-08 15:46:26', '2013-07-08 16:54:30');
INSERT INTO `friend` VALUES (6, 1, 3, 2, '2013-07-08 16:23:42', '2013-07-08 17:05:04');
INSERT INTO `friend` VALUES (7, 1, 4, 1, '2013-07-08 16:24:07', '0000-00-00 00:00:00');
INSERT INTO `friend` VALUES (8, 6, 7, 1, '2013-07-08 17:45:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `group`
-- 

CREATE TABLE `group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `privacy` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `group`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `nodes`
-- 

CREATE TABLE `nodes` (
  `id` bigint(20) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `picture` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `nodes`
-- 

INSERT INTO `nodes` VALUES (9, 'แปผ', 'แปผ', '2013-06-26 17:14:16', '2013-06-26 17:14:16', '', 4, 1, 0);
INSERT INTO `nodes` VALUES (8, 'asd', 'asd', '2013-06-26 17:09:32', '2013-06-26 17:09:32', '', 1, 1, 0);
INSERT INTO `nodes` VALUES (7, '-', '%E0%B8%AB%E0%B8%81%E0%B8%94', '2013-06-26 17:09:28', '2013-06-26 17:09:28', '', 4, 4, 6);
INSERT INTO `nodes` VALUES (10, '-', 'sdf', '2013-06-26 17:14:28', '2013-06-26 17:14:28', '', 1, 4, 9);
INSERT INTO `nodes` VALUES (14, '-', '%E0%B8%AB%E0%B8%AB%E0%B8%AB', '2013-06-26 17:37:27', '2013-06-26 17:37:27', '', 4, 4, 8);
INSERT INTO `nodes` VALUES (13, '-', '%E0%B8%9F%E0%B8%AB%E0%B8%94', '2013-06-26 17:29:30', '2013-06-26 17:29:30', '', 4, 4, 8);
INSERT INTO `nodes` VALUES (15, '-', 'sdfs', '2013-06-26 18:00:17', '2013-06-26 18:00:17', '', 4, 4, 8);
INSERT INTO `nodes` VALUES (16, '-', 'sdfsdf', '2013-06-26 18:00:52', '2013-06-26 18:00:52', '', 4, 4, 8);
INSERT INTO `nodes` VALUES (17, '-', 'sdfsd', '2013-06-26 18:00:57', '2013-06-26 18:00:57', '', 4, 4, 8);
INSERT INTO `nodes` VALUES (18, 'test2', 'test2', '2013-07-05 09:16:13', '2013-07-05 09:16:13', '', 1, 1, 0);
INSERT INTO `nodes` VALUES (19, 'test post', 'test post test post', '2013-07-08 10:09:07', '2013-07-08 10:09:07', '', 5, 1, 0);
INSERT INTO `nodes` VALUES (20, '-', 'test+posttest+posttest+posttest+post', '2013-07-08 10:09:11', '2013-07-08 10:09:11', '', 5, 4, 19);
INSERT INTO `nodes` VALUES (21, '-', 'http%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DpY3P5tJOZHM', '2013-07-08 10:11:03', '2013-07-08 10:11:03', '', 5, 4, 19);
INSERT INTO `nodes` VALUES (22, 'qqqq', 'qqqqq', '2013-07-09 11:54:18', '2013-07-09 11:54:18', '', 7, 1, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `notify`
-- 

CREATE TABLE `notify` (
  `id` int(11) NOT NULL auto_increment,
  `message` varchar(255) NOT NULL,
  `Isreaded` tinyint(4) NOT NULL,
  `type_id` tinyint(4) NOT NULL,
  `user_receive_id` int(11) NOT NULL,
  `user_send_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `datetime_noti` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- Dumping data for table `notify`
-- 

INSERT INTO `notify` VALUES (5, 'msg1', 0, 0, 1, 4, 8, '2013-06-27 11:08:21');
INSERT INTO `notify` VALUES (6, 'msg2', 0, 0, 1, 4, 8, '2013-06-27 11:08:44');
INSERT INTO `notify` VALUES (7, 'msg3', 0, 0, 1, 4, 8, '2013-06-27 11:08:44');
INSERT INTO `notify` VALUES (8, 'msg4', 0, 0, 1, 4, 8, '2013-06-27 11:08:44');
INSERT INTO `notify` VALUES (9, 'msg5', 0, 0, 1, 4, 8, '2013-06-27 11:08:44');
INSERT INTO `notify` VALUES (11, 'ผู้ใช้ชื่อ Narongsak ต้องการขอเป็นเพื่อนกับคุณ ', 0, 0, 5, 1, 0, '2013-07-04 10:44:55');
INSERT INTO `notify` VALUES (12, 'test posttest posttest posttest post', 0, 0, 5, 5, 19, '2013-07-08 10:09:11');
INSERT INTO `notify` VALUES (13, 'http://www.youtube.com/watch?v=pY3P5tJOZHM', 0, 0, 5, 5, 19, '2013-07-08 10:11:03');
INSERT INTO `notify` VALUES (14, 'ผู้ใช้ชื่อ Narongsak ต้องการขอเป็นเพื่อนกับคุณ ', 0, 0, 2, 1, 0, '2013-07-08 15:46:26');
INSERT INTO `notify` VALUES (15, 'ผู้ใช้ชื่อ Narongsak ต้องการขอเป็นเพื่อนกับคุณ ', 0, 0, 3, 1, 0, '2013-07-08 16:23:42');
INSERT INTO `notify` VALUES (16, 'ผู้ใช้ชื่อ Narongsak ต้องการขอเป็นเพื่อนกับคุณ ', 0, 0, 4, 1, 0, '2013-07-08 16:24:07');
INSERT INTO `notify` VALUES (17, 'ผู้ใช้ชื่อ qqq ต้องการขอเป็นเพื่อนกับคุณ ', 0, 0, 7, 6, 0, '2013-07-08 17:45:02');

-- --------------------------------------------------------

-- 
-- Table structure for table `satoo`
-- 

CREATE TABLE `satoo` (
  `user_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`,`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `satoo`
-- 

INSERT INTO `satoo` VALUES (1, 14);
INSERT INTO `satoo` VALUES (1, 15);
INSERT INTO `satoo` VALUES (1, 65);
INSERT INTO `satoo` VALUES (3, 14);
INSERT INTO `satoo` VALUES (4, 10);
INSERT INTO `satoo` VALUES (4, 11);
INSERT INTO `satoo` VALUES (4, 15);
INSERT INTO `satoo` VALUES (4, 65);
INSERT INTO `satoo` VALUES (7, 11);
INSERT INTO `satoo` VALUES (7, 14);
INSERT INTO `satoo` VALUES (7, 15);

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `address` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `permission` enum('admin','user') NOT NULL,
  `user_id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `group_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'Narongsak', 'Kabkaew', 'jeef', '100ca074c52cffee8ce02a0b2fc288bc', 23, 'male', '5/49 moo2 saimai bkk', 'saimaiazz@gmail.com', '0859186191', 'admin', 0, 'profilepic75521371811721.JPG', NULL);
INSERT INTO `users` VALUES (2, 'jjj', 'jjj', 'jjj', '2af54305f183778d87de0c70c591fae4', 0, '', '', '', '', '', 0, '', NULL);
INSERT INTO `users` VALUES (3, 'bbb', 'bbb', 'bbb', '08f8e0260c64418510cefb2b06eee5cd', 0, '', '', 'fd', '', '', 0, '', NULL);
INSERT INTO `users` VALUES (4, 'ggg', 'ggg', 'ggg', 'ba248c985ace94863880921d8900c53f', 12, 'male', 'asd', 'asda@ads.asd', '1223', 'user', 0, 'profilepic76261372145605.jpg', NULL);
INSERT INTO `users` VALUES (5, 'ttt', 'ttt', 'ttt', '9990775155c3518a0d7917f7780b24aa', 11, 'male', 'sdfsdf', 'saima@sdf.dsf', '02230232', 'user', 0, 'profilepic49981371184312.jpg', NULL);
INSERT INTO `users` VALUES (6, 'qqq', 'qqq', 'qqq', 'b2ca678b4c936f905fb82f2733f5297f', 23, 'female', 'sdfsdf', 'sfd@df.sfd', '023234', 'user', 0, 'profilepic7411371183955.jpg', NULL);
INSERT INTO `users` VALUES (7, 'jeef', 'narongsak', 'jeef2', '01d51da211eec82e24aa54db1f9a1763', 11, 'male', 'sdfsdf', 'sfasdd@df.sfd', '02230232', 'user', 0, 'profilepic36221371811694.JPG', NULL);
