-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-12-31 22:25:13
-- 服务器版本： 5.6.50-log
-- PHP 版本： 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `yunqian`
--

-- --------------------------------------------------------

--
-- 表的结构 `tieba_cardkey`
--

CREATE TABLE `tieba_cardkey` (
  `id` int(11) NOT NULL,
  `cardkey` varchar(16) NOT NULL,
  `usetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isuse` int(1) NOT NULL DEFAULT '0',
  `user` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `month` tinyint(2) NOT NULL,
  `quota` smallint(4) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 表的结构 `tieba_info`
--

CREATE TABLE `tieba_info` (
  `id` int(11) NOT NULL,
  `uid` int(255) NOT NULL,
  `userid` int(100) NOT NULL,
  `user` varchar(255) NOT NULL,
  `bduss` varchar(255) NOT NULL,
  `ptoken` varchar(255) NOT NULL,
  `stoken` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `tbnum` mediumint(255) DEFAULT '0',
  `zt` int(10) NOT NULL,
  `addtime` datetime NOT NULL,
  `signtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `run` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `openreply` tinyint(4) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `query` int(30) NOT NULL DEFAULT '1',
  `nlock` int(1) NOT NULL DEFAULT '0',
  `replytime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 表的结构 `tieba_order`
--

CREATE TABLE `tieba_order` (
  `id` int(11) UNSIGNED NOT NULL,
  `pay_id` varchar(50) NOT NULL COMMENT '用户ID或订单ID',
  `money` decimal(6,2) UNSIGNED NOT NULL COMMENT '实际金额',
  `price` decimal(6,2) UNSIGNED NOT NULL COMMENT '原价',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `pay_no` varchar(100) NOT NULL COMMENT '流水号',
  `param` varchar(200) DEFAULT NULL COMMENT '自定义参数',
  `pay_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_tag` varchar(100) NOT NULL DEFAULT '0' COMMENT '金额的备注',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `creat_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `up_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用于区分是否已经处理' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 表的结构 `tieba_user`
--

CREATE TABLE `tieba_user` (
  `uid` int(11) NOT NULL,
  `qqkey` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `pwd` varchar(40) NOT NULL,
  `sid` varchar(50) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `money` decimal(6,2) NOT NULL DEFAULT '0.00',
  `quota` int(3) NOT NULL DEFAULT '2',
  `vip` tinyint(1) NOT NULL DEFAULT '0',
  `get` int(1) NOT NULL DEFAULT '1',
  `vipendtime` bigint(11) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  `regtime` datetime DEFAULT NULL,
  `lasttime` datetime DEFAULT NULL,
  `signtime` datetime DEFAULT NULL,
  `mailtime` datetime NOT NULL,
  `aqproblem` varchar(255) DEFAULT NULL,
  `aqanswer` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tieba_website`
--

CREATE TABLE `tieba_website` (
  `vkey` varchar(255) NOT NULL,
  `value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `tieba_website`
--

INSERT INTO `tieba_website` (`vkey`, `value`) VALUES
('cron', '123456'),
('name', '天方云签到系统'),
('describe', '一款基于云端制作的云签到系统,支持贴吧,网易云音乐,B站等.可以无需挂机即可自动一键签到,是一个水经验的好工具.可以让你完全解放双手.作者龙辉:QQ1790716272'),
('keywords', '贴吧签到,贴吧云签到,贴吧云任务,贴吧定时签到,网易云音乐刷歌,网易云刷歌,网易云音乐一键听歌bilbili自动签到,bilibili云签到,百度贴吧一键签到,百度贴吧自动签到,'),
('qq', '1790716272'),
('notice', '支持贴吧一键关注.强烈建议你加群:936838495,群内有机器人,使用更便捷~如有疑问,请到blog.eirds.cn/338.html留言.登录成功即为添加or更新成功！不需要其他操作 ~基于安卓协议，使经验达到最大化！每天经验+8,贴吧会员则更高 '),
('webset', '1'),
('author', '一千零一夜(龙辉)'),
('Music', '1'),
('template', 'index'),
('Icp', '黔ICP备19009842号-2');

--
-- 转储表的索引
--

--
-- 表的索引 `tieba_cardkey`
--
ALTER TABLE `tieba_cardkey`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `tieba_info`
--
ALTER TABLE `tieba_info`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `tieba_order`
--
ALTER TABLE `tieba_order`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `main` (`pay_id`,`pay_time`,`money`,`type`,`pay_tag`) USING BTREE,
  ADD UNIQUE KEY `pay_no` (`pay_no`,`type`) USING BTREE;

--
-- 表的索引 `tieba_user`
--
ALTER TABLE `tieba_user`
  ADD PRIMARY KEY (`uid`) USING BTREE;

--
-- 表的索引 `tieba_website`
--
ALTER TABLE `tieba_website`
  ADD PRIMARY KEY (`vkey`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tieba_cardkey`
--
ALTER TABLE `tieba_cardkey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `tieba_info`
--
ALTER TABLE `tieba_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `tieba_order`
--
ALTER TABLE `tieba_order`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `tieba_user`
--
ALTER TABLE `tieba_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
