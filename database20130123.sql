-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27-log
-- Versão do PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `esotalk`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_activity`
--

CREATE TABLE IF NOT EXISTS `et_activity` (
  `activityId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `memberId` int(11) unsigned NOT NULL,
  `fromMemberId` int(11) unsigned DEFAULT NULL,
  `data` tinyblob,
  `conversationId` int(11) unsigned DEFAULT NULL,
  `postId` int(11) unsigned DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  `read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`activityId`),
  KEY `activity_memberId` (`memberId`),
  KEY `activity_time` (`time`),
  KEY `activity_type` (`type`),
  KEY `activity_conversationId` (`conversationId`),
  KEY `activity_postId` (`postId`),
  KEY `activity_read` (`read`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `et_activity`
--

INSERT INTO `et_activity` (`activityId`, `type`, `memberId`, `fromMemberId`, `data`, `conversationId`, `postId`, `time`, `read`) VALUES
(1, 'join', 1, NULL, 0x4e3b, NULL, NULL, 1357143606, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_channel`
--

CREATE TABLE IF NOT EXISTS `et_channel` (
  `channelId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(31) NOT NULL,
  `slug` varchar(31) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parentId` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT '0',
  `rgt` int(11) DEFAULT '0',
  `depth` int(11) DEFAULT '0',
  `countConversations` int(11) DEFAULT '0',
  `countPosts` int(11) DEFAULT '0',
  `attributes` mediumblob,
  PRIMARY KEY (`channelId`),
  UNIQUE KEY `channel_slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `et_channel`
--

INSERT INTO `et_channel` (`channelId`, `title`, `slug`, `description`, `parentId`, `lft`, `rgt`, `depth`, `countConversations`, `countPosts`, `attributes`) VALUES
(1, 'General Discussion', 'general-discussion', 'Teste de descrição e tudo mais, tá ligado?', 0, 3, 4, 0, 2, 7, 0x613a323a7b693a303b623a303b733a31393a2264656661756c74556e73756273637269626564223b733a303a22223b7d),
(2, 'Staff Only', 'staff-only', NULL, 0, 1, 2, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_channel_group`
--

CREATE TABLE IF NOT EXISTS `et_channel_group` (
  `channelId` int(11) unsigned NOT NULL,
  `groupId` int(11) NOT NULL,
  `view` tinyint(1) DEFAULT '0',
  `reply` tinyint(1) DEFAULT '0',
  `start` tinyint(1) DEFAULT '0',
  `moderate` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`channelId`,`groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `et_channel_group`
--

INSERT INTO `et_channel_group` (`channelId`, `groupId`, `view`, `reply`, `start`, `moderate`) VALUES
(1, -2, 0, 1, 1, 0),
(1, -1, 1, 0, 0, 0),
(1, 1, 0, 0, 0, 1),
(2, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_conversation`
--

CREATE TABLE IF NOT EXISTS `et_conversation` (
  `conversationId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(63) DEFAULT NULL,
  `channelId` int(11) unsigned DEFAULT NULL,
  `private` tinyint(1) DEFAULT '0',
  `sticky` tinyint(1) DEFAULT '0',
  `locked` tinyint(1) DEFAULT '0',
  `countPosts` smallint(5) DEFAULT '0',
  `startMemberId` int(11) unsigned NOT NULL,
  `startTime` int(11) unsigned NOT NULL,
  `lastPostMemberId` int(11) unsigned DEFAULT NULL,
  `lastPostTime` int(11) unsigned DEFAULT NULL,
  `attributes` mediumblob,
  PRIMARY KEY (`conversationId`),
  KEY `conversation_sticky_lastPostTime` (`sticky`,`lastPostTime`),
  KEY `conversation_lastPostTime` (`lastPostTime`),
  KEY `conversation_countPosts` (`countPosts`),
  KEY `conversation_startTime` (`startTime`),
  KEY `conversation_locked` (`locked`),
  KEY `conversation_private` (`private`),
  KEY `conversation_startMemberId` (`startMemberId`),
  KEY `conversation_channelId` (`channelId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `et_conversation`
--

INSERT INTO `et_conversation` (`conversationId`, `title`, `channelId`, `private`, `sticky`, `locked`, `countPosts`, `startMemberId`, `startTime`, `lastPostMemberId`, `lastPostTime`, `attributes`) VALUES
(1, 'Welcome to Mundo RPG Maker!', 1, 0, 0, 0, 5, 1, 1357143607, 1, 1358891188, NULL),
(2, 'Pssst! Want a few tips?', 1, 1, 0, 0, 2, 1, 1357143607, 1, 1357150162, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_cookie`
--

CREATE TABLE IF NOT EXISTS `et_cookie` (
  `memberId` int(11) unsigned NOT NULL,
  `series` char(32) NOT NULL,
  `token` char(32) NOT NULL,
  PRIMARY KEY (`memberId`,`series`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `et_cookie`
--

INSERT INTO `et_cookie` (`memberId`, `series`, `token`) VALUES
(1, 'e4d1bc45d6f5532ac4c654e59da63c86', 'f6d0eee126e2e39ecd501663c18cff5a'),
(1, 'eaae5606d689b9e325da0de4898d3377', '0df8400ec063934af7caa46c60363d48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_group`
--

CREATE TABLE IF NOT EXISTS `et_group` (
  `groupId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(31) DEFAULT '',
  `canSuspend` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`groupId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `et_group`
--

INSERT INTO `et_group` (`groupId`, `name`, `canSuspend`) VALUES
(1, 'Moderator', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_member`
--

CREATE TABLE IF NOT EXISTS `et_member` (
  `memberId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(31) DEFAULT '',
  `email` varchar(63) NOT NULL,
  `account` enum('administrator','member','suspended') DEFAULT 'member',
  `confirmedEmail` tinyint(1) DEFAULT '0',
  `password` char(64) DEFAULT '',
  `resetPassword` char(32) DEFAULT NULL,
  `joinTime` int(11) unsigned NOT NULL,
  `lastActionTime` int(11) unsigned DEFAULT NULL,
  `lastActionDetail` tinyblob,
  `avatarFormat` enum('jpg','png','gif') DEFAULT NULL,
  `preferences` mediumblob,
  `countPosts` int(11) unsigned DEFAULT '0',
  `countConversations` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`memberId`),
  UNIQUE KEY `member_email` (`email`),
  UNIQUE KEY `member_username` (`username`),
  KEY `member_lastActionTime` (`lastActionTime`),
  KEY `member_account` (`account`),
  KEY `member_countPosts` (`countPosts`),
  KEY `member_resetPassword` (`resetPassword`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `et_member`
--

INSERT INTO `et_member` (`memberId`, `username`, `email`, `account`, `confirmedEmail`, `password`, `resetPassword`, `joinTime`, `lastActionTime`, `lastActionDetail`, `avatarFormat`, `preferences`, `countPosts`, `countConversations`) VALUES
(1, 'Gab', 'gab.teles@hotmail.com', 'administrator', 1, '$2a$08$Pxesrbz7B7MITU83VSUD/eLzCbJYx4W.YW7MP8NfXWnDlXSNx7uma', NULL, 1357143606, 1358910114, 0x613a333a7b733a31343a22636f6e766572736174696f6e4964223b733a313a2231223b733a353a227469746c65223b733a32373a2257656c636f6d6520746f204d756e646f20525047204d616b657221223b733a343a2274797065223b733a31393a2276696577696e67436f6e766572736174696f6e223b7d, NULL, 0x613a363a7b693a303b623a303b733a32313a226e6f74696669636174696f6e436865636b54696d65223b693a313335383931303131353b733a383a226c616e6775616765223b4e3b733a31363a22656d61696c2e70726976617465416464223b623a303b733a32303a22656d61696c2e7265706c79546f53746172726564223b623a303b733a31313a22737461724f6e5265706c79223b623a303b7d, 7, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_member_channel`
--

CREATE TABLE IF NOT EXISTS `et_member_channel` (
  `memberId` int(11) unsigned NOT NULL,
  `channelId` int(11) unsigned NOT NULL,
  `unsubscribed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`memberId`,`channelId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `et_member_channel`
--

INSERT INTO `et_member_channel` (`memberId`, `channelId`, `unsubscribed`) VALUES
(1, 2, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_member_conversation`
--

CREATE TABLE IF NOT EXISTS `et_member_conversation` (
  `conversationId` int(11) unsigned NOT NULL,
  `type` enum('member','group') NOT NULL DEFAULT 'member',
  `id` int(11) NOT NULL,
  `allowed` tinyint(1) DEFAULT '0',
  `starred` tinyint(1) DEFAULT '0',
  `lastRead` smallint(5) DEFAULT '0',
  `draft` text,
  `muted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`conversationId`,`type`,`id`),
  KEY `member_conversation_type_id` (`type`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `et_member_conversation`
--

INSERT INTO `et_member_conversation` (`conversationId`, `type`, `id`, `allowed`, `starred`, `lastRead`, `draft`, `muted`) VALUES
(1, 'member', 1, 0, 0, 5, NULL, 0),
(2, 'member', 1, 1, 0, 2, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_member_group`
--

CREATE TABLE IF NOT EXISTS `et_member_group` (
  `memberId` int(11) unsigned NOT NULL,
  `groupId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`memberId`,`groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_post`
--

CREATE TABLE IF NOT EXISTS `et_post` (
  `postId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conversationId` int(11) unsigned NOT NULL,
  `memberId` int(11) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `editMemberId` int(11) unsigned DEFAULT NULL,
  `editTime` int(11) unsigned DEFAULT NULL,
  `deleteMemberId` int(11) unsigned DEFAULT NULL,
  `deleteTime` int(11) unsigned DEFAULT NULL,
  `title` varchar(63) NOT NULL,
  `content` text NOT NULL,
  `attributes` mediumblob,
  PRIMARY KEY (`postId`),
  KEY `post_memberId` (`memberId`),
  KEY `post_conversationId_time` (`conversationId`,`time`),
  FULLTEXT KEY `post_title_content` (`title`,`content`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `et_post`
--

INSERT INTO `et_post` (`postId`, `conversationId`, `memberId`, `time`, `editMemberId`, `editTime`, `deleteMemberId`, `deleteTime`, `title`, `content`, `attributes`) VALUES
(1, 1, 1, 1357143607, 1, 1358799035, NULL, NULL, '', '[b]Welcome to Mundo RPG Maker![/b]\n\nMundo RPG Maker is powered by [url=http://esotalk.org]esoTalk[/url], the simple, fast, free web-forum.\n\nFeel free to edit or delete this conversation. Otherwise, it''s time to get posting!\n\nAnyway, good luck, and we hope you enjoy using esoTalk.\n\naaaaa', NULL),
(2, 2, 1, 1357143607, NULL, NULL, NULL, NULL, '', 'Hey Gab, congrats on getting esoTalk installed!\n\nCool! Your forum is now good-to-go, but you might want to customize it with your own logo, design, and settings—so here''s how.\n\n[h]Changing the Logo[/h]\n\n1. Go to the [url=http://localhost/esotalk/admin/settings]Forum Settings[/url] section of your administration panel.\n2. Select ''Show an image in the header'' for the ''Forum header'' setting.\n3. Find and select the image file you wish to use.\n4. Click ''Save Changes''. The logo will automatically be resized so it fits nicely in the header.\n\n[h]Changing the Appearance[/h]\n\n1. Go to the [url=http://localhost/esotalk/admin/appearance]Appearance[/url] section of your administration panel.\n2. Choose colors for the header, page background, or select a background image. (More skins will be available soon.)\n3. Click ''Save Changes'', and your forum''s appearance will be updated!\n\n[h]Managing Channels[/h]\n\n''Channels'' are a way to categorize conversations in your forum. You can create as many or as few channels as you like, nest them, and give them custom permissions.\n\n1. Go to the [url=http://localhost/esotalk/admin/channels]Channels[/url] section of your administration panel.\n2. Click ''Create Channel'' and fill out a title, description, and select permissions to add a new channel.\n3. Drag and drop channels to rearrange and nest them.\n\n[h]Getting Help[/h]\n\nIf you need help, come and give us a yell at the [url=http://esotalk.org/forum]esoTalk Support Forum[/url]. Don''t worry—we don''t bite!', NULL),
(3, 2, 1, 1357150162, NULL, NULL, NULL, NULL, '', 'Teste de resposta, mothafuckers', NULL),
(4, 1, 1, 1357270111, 1, 1357503822, NULL, NULL, '', 'aeaeaeuhaeuaehuaehaeuaehaeuhaeuaehae\n[b]BOLD[/b]\n[i]Italic[/i]\n[u]Underline[/u]\n[s]strikethrough[/s]\nCOMPARAÇÃO[sup]Sup[/sup]\nCOMPARAÇÃO[sub]Sub[/sub]\n[size=20]20pt[/size]\n[size=40]40pt[/size]\n[color=#0CF]AZULLLLL[/color]\n[color=#CCFF00]VERDEEEE[/color]\n[color=red]VERMELHO![/color]\n[font=IMPACT]IMPACT, BITCHES![/font]\n[url=google.com]URL[/url]\n[img]http://i.imgur.com/juSMc.jpg[/img]\n[quote]TESTE QUOTE[/quote]\n\n<b>Fuck.</b>', NULL),
(5, 1, 1, 1357407394, 1, 1358810002, NULL, NULL, '', '[quote=1:@Gab]\n[b]Welcome to Mundo RPG Maker![/b]\nMundo RPG Maker is powered by [url=http://esotalk.org]esoTalk[/url], the simple, fast, free web-forum.\n[b]Feel free to edit or delete this conversation. Otherwise, it''s time to get posting![/b]\nAnyway, good luck, and we hope you enjoy using esoTalk.\n[/quote]', NULL),
(6, 1, 1, 1358874430, NULL, NULL, NULL, NULL, '', '[quote=5:@Gab][quote=1:@Gab]\n[b]Welcome to Mundo RPG Maker![/b]\nMundo RPG Maker is powered by [url=http://esotalk.org]esoTalk[/url], the simple, fast, free web-forum.\n[b]Feel free to edit or delete this conversation. Otherwise, it''s time to get posting![/b]\nAnyway, good luck, and we hope you enjoy using esoTalk.\n[/quote][/quote]\n', NULL),
(7, 1, 1, 1358891187, 1, 1358902289, NULL, NULL, '', '[code=rb]\nclass Iterator\n	def initialize(min = 0, max = 255)\n		raize(ArgumentError) if (min < 0 or max > 255)\n		@min  = min\n		@max  = max\n		@data = [@min - 1]\n	end\n	\n	def succ\n		@data[-1] += 1\n		(@data.size - 1).downto(0){|index|\n			break if @data[index] <= @max\n			@data[index] = @min\n			index == 0 ? @data.unshift(@min) : @data[index - 1] += 1\n		}\n		\n		return self.processData\n	end\n	\n	protected\n	def processData\n		return @data\n	end\nend\n\nclass StringIterator < Iterator\n	def processData\n		return @data.pack("C*")\n	end\nend\n\niter = StringIterator.new\nloop{p iter.succ}\n[/code]', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `et_search`
--

CREATE TABLE IF NOT EXISTS `et_search` (
  `type` enum('conversations') DEFAULT 'conversations',
  `ip` int(11) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL,
  KEY `search_type_ip` (`type`,`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `et_search`
--

INSERT INTO `et_search` (`type`, `ip`, `time`) VALUES
('conversations', 2130706433, 1357150236);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
