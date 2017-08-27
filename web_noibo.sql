/*
Navicat MySQL Data Transfer

Source Server         : tue
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : web_noibo

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2014-06-27 17:16:01
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `coffee`
-- ----------------------------
DROP TABLE IF EXISTS `coffee`;
CREATE TABLE `coffee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` varchar(3000) NOT NULL,
  `attachment1` varchar(256) NOT NULL,
  `attachment2` varchar(256) NOT NULL,
  `attachment3` varchar(256) NOT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of coffee
-- ----------------------------

-- ----------------------------
-- Table structure for `contribute`
-- ----------------------------
DROP TABLE IF EXISTS `contribute`;
CREATE TABLE `contribute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `contributor_id` int(11) unsigned NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contribute
-- ----------------------------

-- ----------------------------
-- Table structure for `criticism`
-- ----------------------------
DROP TABLE IF EXISTS `criticism`;
CREATE TABLE `criticism` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of criticism
-- ----------------------------

-- ----------------------------
-- Table structure for `design_comment`
-- ----------------------------
DROP TABLE IF EXISTS `design_comment`;
CREATE TABLE `design_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of design_comment
-- ----------------------------
INSERT INTO design_comment VALUES ('6', 'Bình thường');
INSERT INTO design_comment VALUES ('9', 'Xấu');

-- ----------------------------
-- Table structure for `design_comment_detail`
-- ----------------------------
DROP TABLE IF EXISTS `design_comment_detail`;
CREATE TABLE `design_comment_detail` (
  `design_comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of design_comment_detail
-- ----------------------------
INSERT INTO design_comment_detail VALUES ('9', '17');
INSERT INTO design_comment_detail VALUES ('9', '94');

-- ----------------------------
-- Table structure for `functions`
-- ----------------------------
DROP TABLE IF EXISTS `functions`;
CREATE TABLE `functions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `function_name` varchar(50) NOT NULL,
  `controller` varchar(30) NOT NULL,
  `disp_order` int(10) unsigned NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of functions
-- ----------------------------
INSERT INTO functions VALUES ('23', 'Happy box', 'thanks', '26', '2013-07-26 11:43:22', '2013-07-26 11:43:24', 'haipt');
INSERT INTO functions VALUES ('29', 'Xem bói', 'fortune', '32', '2013-07-26 11:46:48', '2013-07-26 11:46:50', 'haipt');
INSERT INTO functions VALUES ('30', 'Coffee break', 'coffee', '33', '2013-07-26 11:47:02', '2013-07-26 11:47:04', 'haipt');
INSERT INTO functions VALUES ('31', 'Đọc ngay nhé (Vui chơi)', 'news', '34', '2013-07-26 11:47:16', '2013-07-26 11:47:18', 'haipt');
INSERT INTO functions VALUES ('33', 'Tin tức bóng đá', 'hobby_new', '36', '2013-07-26 11:47:47', '2013-07-26 11:47:49', 'haipt');
INSERT INTO functions VALUES ('34', 'Thành viên bóng đá', 'hobby_itd', '37', '2013-07-26 11:48:14', '2013-07-26 11:48:16', 'haipt');
INSERT INTO functions VALUES ('37', 'Phân quyền', 'role', '40', '2013-07-26 11:49:11', '2013-07-26 11:49:15', 'haipt');
INSERT INTO functions VALUES ('51', 'vừa làm vừa vui', 'work_smile', '100', '2014-04-03 10:09:13', '2014-04-03 10:09:17', 'haipt');
INSERT INTO functions VALUES ('52', 'Châm ngôn', 'meigen', '101', '2014-04-24 14:17:24', '2014-04-24 14:17:27', 'admin');
INSERT INTO functions VALUES ('53', 'user', 'user', '102', '2014-04-24 16:12:40', '2014-04-24 16:12:42', 'admin');
INSERT INTO functions VALUES ('54', 'Chi nhánh', 'unit', '103', '2014-04-29 17:04:24', '2014-04-29 17:04:28', 'admin');
INSERT INTO functions VALUES ('55', 'Bộ phận', 'post', '104', '2014-05-02 11:40:03', '2014-05-02 11:40:05', 'admin');
INSERT INTO functions VALUES ('56', 'Ý tưởng mới', 'ideas', '105', '2014-05-05 09:34:22', '2014-05-05 09:34:25', 'admin');
INSERT INTO functions VALUES ('57', 'Các văn bản & quyết định', 'criticism', '106', '2014-05-06 09:00:06', '2014-05-06 09:00:09', 'admin');
INSERT INTO functions VALUES ('58', 'Đọc ngay nhé (Công việc)', 'news_cv', '107', '2014-05-06 13:40:22', '2014-05-06 13:40:25', 'admin');
INSERT INTO functions VALUES ('59', 'Thông báo nội bộ', 'notice', '108', '2014-05-19 10:40:35', '2014-05-19 10:40:38', 'admin');
INSERT INTO functions VALUES ('60', 'IT Contest', 'itcontest', '109', '2014-05-20 11:24:53', '2014-05-20 11:24:56', 'admin');
INSERT INTO functions VALUES ('61', 'Hòm thư góp ý', 'contribute', '110', '2014-05-20 11:52:50', '2014-05-20 11:52:54', 'admin');
INSERT INTO functions VALUES ('62', 'Mục tiêu và hành động', 'plan', '111', '2014-05-21 13:54:16', '2014-05-21 13:54:19', 'admin');
INSERT INTO functions VALUES ('63', 'Câu hỏi điều tra', 'investigate', '112', '2014-05-22 12:01:02', '2014-05-22 12:01:05', 'admin');
INSERT INTO functions VALUES ('64', 'Thông báo từ phòng hành chính nhân sự', 'hr', '113', '2014-05-23 08:56:58', '2014-05-23 08:57:01', 'admin');

-- ----------------------------
-- Table structure for `hobby_itd`
-- ----------------------------
DROP TABLE IF EXISTS `hobby_itd`;
CREATE TABLE `hobby_itd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hobby_itd
-- ----------------------------
INSERT INTO hobby_itd VALUES ('6', '96', '95', '2014-04-27 09:08:59', '2014-04-27 09:08:59', '123456');
INSERT INTO hobby_itd VALUES ('8', '95', '95', '2014-05-22 16:37:55', '2014-05-22 16:37:55', '123456');

-- ----------------------------
-- Table structure for `hobby_new`
-- ----------------------------
DROP TABLE IF EXISTS `hobby_new`;
CREATE TABLE `hobby_new` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(3) unsigned DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hobby_new
-- ----------------------------

-- ----------------------------
-- Table structure for `hr`
-- ----------------------------
DROP TABLE IF EXISTS `hr`;
CREATE TABLE `hr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr
-- ----------------------------

-- ----------------------------
-- Table structure for `ideas`
-- ----------------------------
DROP TABLE IF EXISTS `ideas`;
CREATE TABLE `ideas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ideas
-- ----------------------------

-- ----------------------------
-- Table structure for `ideas_comment`
-- ----------------------------
DROP TABLE IF EXISTS `ideas_comment`;
CREATE TABLE `ideas_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ideas_id` int(11) unsigned NOT NULL,
  `comment` text NOT NULL,
  `valuation` tinyint(4) NOT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ideas_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `investigate`
-- ----------------------------
DROP TABLE IF EXISTS `investigate`;
CREATE TABLE `investigate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  `icon` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of investigate
-- ----------------------------

-- ----------------------------
-- Table structure for `itcontest`
-- ----------------------------
DROP TABLE IF EXISTS `itcontest`;
CREATE TABLE `itcontest` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of itcontest
-- ----------------------------

-- ----------------------------
-- Table structure for `machines`
-- ----------------------------
DROP TABLE IF EXISTS `machines`;
CREATE TABLE `machines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of machines
-- ----------------------------

-- ----------------------------
-- Table structure for `member_change`
-- ----------------------------
DROP TABLE IF EXISTS `member_change`;
CREATE TABLE `member_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(255) NOT NULL,
  `change_date` datetime NOT NULL,
  `from_position` int(11) DEFAULT NULL,
  `from_unit` int(11) DEFAULT NULL,
  `to_position` int(11) DEFAULT NULL,
  `to_unit` int(11) DEFAULT NULL,
  `detail` varchar(3000) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `contributor_id` int(11) NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member_change
-- ----------------------------

-- ----------------------------
-- Table structure for `member_join`
-- ----------------------------
DROP TABLE IF EXISTS `member_join`;
CREATE TABLE `member_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(255) NOT NULL,
  `join_date` datetime NOT NULL,
  `position` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `detail` varchar(3000) DEFAULT NULL,
  `contributor_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member_join
-- ----------------------------
INSERT INTO member_join VALUES ('1', 'sdfsdf', '2014-05-29 00:00:00', null, null, null, '95', '2014-05-29 18:05:01', '2014-05-29 18:05:01', '123456');

-- ----------------------------
-- Table structure for `member_leave`
-- ----------------------------
DROP TABLE IF EXISTS `member_leave`;
CREATE TABLE `member_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(255) NOT NULL,
  `leave_date` datetime NOT NULL,
  `position` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `detail` varchar(3000) DEFAULT NULL,
  `contributor_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member_leave
-- ----------------------------

-- ----------------------------
-- Table structure for `mood`
-- ----------------------------
DROP TABLE IF EXISTS `mood`;
CREATE TABLE `mood` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mood
-- ----------------------------
INSERT INTO mood VALUES ('7', 'vui');
INSERT INTO mood VALUES ('10', 'bình thường');
INSERT INTO mood VALUES ('11', 'buồn');

-- ----------------------------
-- Table structure for `mood_detail`
-- ----------------------------
DROP TABLE IF EXISTS `mood_detail`;
CREATE TABLE `mood_detail` (
  `mood_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`mood_id`,`user_id`,`create_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mood_detail
-- ----------------------------
INSERT INTO mood_detail VALUES ('7', '17', '2014-03-30 16:30:02');
INSERT INTO mood_detail VALUES ('10', '17', '2014-04-01 16:16:51');
INSERT INTO mood_detail VALUES ('10', '17', '2014-04-02 16:31:04');
INSERT INTO mood_detail VALUES ('10', '17', '2014-04-07 15:41:44');
INSERT INTO mood_detail VALUES ('10', '17', '2014-04-14 15:06:25');
INSERT INTO mood_detail VALUES ('10', '17', '2014-04-21 16:56:15');
INSERT INTO mood_detail VALUES ('11', '17', '2014-03-31 16:24:13');
INSERT INTO mood_detail VALUES ('11', '17', '2014-04-03 09:15:22');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for `news_cv`
-- ----------------------------
DROP TABLE IF EXISTS `news_cv`;
CREATE TABLE `news_cv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_cv
-- ----------------------------

-- ----------------------------
-- Table structure for `news_read`
-- ----------------------------
DROP TABLE IF EXISTS `news_read`;
CREATE TABLE `news_read` (
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`news_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_read
-- ----------------------------
INSERT INTO news_read VALUES ('2', '95');
INSERT INTO news_read VALUES ('2', '96');
INSERT INTO news_read VALUES ('3', '95');
INSERT INTO news_read VALUES ('3', '96');
INSERT INTO news_read VALUES ('4', '95');
INSERT INTO news_read VALUES ('4', '96');
INSERT INTO news_read VALUES ('5', '95');
INSERT INTO news_read VALUES ('5', '96');
INSERT INTO news_read VALUES ('8', '95');
INSERT INTO news_read VALUES ('9', '95');
INSERT INTO news_read VALUES ('10', '95');

-- ----------------------------
-- Table structure for `news_read_cv`
-- ----------------------------
DROP TABLE IF EXISTS `news_read_cv`;
CREATE TABLE `news_read_cv` (
  `news_cv_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`news_cv_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_read_cv
-- ----------------------------
INSERT INTO news_read_cv VALUES ('1', '95');
INSERT INTO news_read_cv VALUES ('2', '95');
INSERT INTO news_read_cv VALUES ('3', '95');
INSERT INTO news_read_cv VALUES ('4', '95');
INSERT INTO news_read_cv VALUES ('4', '96');
INSERT INTO news_read_cv VALUES ('5', '95');
INSERT INTO news_read_cv VALUES ('5', '96');
INSERT INTO news_read_cv VALUES ('6', '95');
INSERT INTO news_read_cv VALUES ('6', '96');
INSERT INTO news_read_cv VALUES ('7', '95');
INSERT INTO news_read_cv VALUES ('7', '96');
INSERT INTO news_read_cv VALUES ('8', '95');
INSERT INTO news_read_cv VALUES ('8', '96');
INSERT INTO news_read_cv VALUES ('9', '95');
INSERT INTO news_read_cv VALUES ('9', '96');
INSERT INTO news_read_cv VALUES ('10', '95');
INSERT INTO news_read_cv VALUES ('10', '96');
INSERT INTO news_read_cv VALUES ('11', '95');
INSERT INTO news_read_cv VALUES ('11', '96');
INSERT INTO news_read_cv VALUES ('12', '95');
INSERT INTO news_read_cv VALUES ('13', '95');

-- ----------------------------
-- Table structure for `notice`
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  `icon` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice
-- ----------------------------

-- ----------------------------
-- Table structure for `notice_read`
-- ----------------------------
DROP TABLE IF EXISTS `notice_read`;
CREATE TABLE `notice_read` (
  `notice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`notice_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice_read
-- ----------------------------
INSERT INTO notice_read VALUES ('1', '95');
INSERT INTO notice_read VALUES ('1', '96');
INSERT INTO notice_read VALUES ('2', '95');
INSERT INTO notice_read VALUES ('3', '95');
INSERT INTO notice_read VALUES ('4', '95');
INSERT INTO notice_read VALUES ('5', '95');
INSERT INTO notice_read VALUES ('6', '95');
INSERT INTO notice_read VALUES ('7', '95');
INSERT INTO notice_read VALUES ('7', '96');
INSERT INTO notice_read VALUES ('8', '95');
INSERT INTO notice_read VALUES ('8', '96');
INSERT INTO notice_read VALUES ('9', '95');
INSERT INTO notice_read VALUES ('9', '96');
INSERT INTO notice_read VALUES ('10', '95');
INSERT INTO notice_read VALUES ('10', '96');
INSERT INTO notice_read VALUES ('11', '95');
INSERT INTO notice_read VALUES ('11', '96');
INSERT INTO notice_read VALUES ('12', '95');
INSERT INTO notice_read VALUES ('12', '96');
INSERT INTO notice_read VALUES ('13', '95');
INSERT INTO notice_read VALUES ('13', '96');
INSERT INTO notice_read VALUES ('14', '95');
INSERT INTO notice_read VALUES ('14', '96');
INSERT INTO notice_read VALUES ('15', '95');
INSERT INTO notice_read VALUES ('15', '96');
INSERT INTO notice_read VALUES ('17', '95');
INSERT INTO notice_read VALUES ('17', '96');
INSERT INTO notice_read VALUES ('18', '95');
INSERT INTO notice_read VALUES ('18', '96');
INSERT INTO notice_read VALUES ('19', '95');
INSERT INTO notice_read VALUES ('19', '96');
INSERT INTO notice_read VALUES ('22', '95');
INSERT INTO notice_read VALUES ('23', '95');

-- ----------------------------
-- Table structure for `plan`
-- ----------------------------
DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  `icon` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of plan
-- ----------------------------

-- ----------------------------
-- Table structure for `post`
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO post VALUES ('1', 'Ban giám đốc', '2013-11-27 09:33:06', '2013-11-27 09:33:06', '9999', '1', null, null, null);
INSERT INTO post VALUES ('2', 'Dev', '2013-11-27 09:35:10', '2013-11-27 09:35:10', '9999', '1', null, null, null);
INSERT INTO post VALUES ('3', 'tenten', '2013-11-27 09:35:23', '2013-11-27 09:35:23', '9999', '1', null, null, null);
INSERT INTO post VALUES ('4', 'Nhân sự', '2013-11-27 09:35:34', '2013-11-27 09:35:34', '9999', '1', null, null, null);
INSERT INTO post VALUES ('5', 'Ban giám đốc', '2014-04-26 10:33:46', '2014-04-26 10:33:56', '9999', '2', null, null, null);
INSERT INTO post VALUES ('6', 'Dev', '2014-04-26 10:37:36', '2014-04-26 10:38:15', '9999', '2', null, null, null);
INSERT INTO post VALUES ('7', 'Dev', '2014-04-26 10:37:39', '2014-04-26 10:38:19', '9999', '3', null, null, null);
INSERT INTO post VALUES ('8', 'Dev', '2014-04-26 10:37:42', '2014-04-26 10:38:22', '9999', '4', null, null, null);
INSERT INTO post VALUES ('9', 'Ban giám đốc', '2014-04-26 10:37:45', '2014-04-26 10:38:25', '9999', '3', null, null, null);
INSERT INTO post VALUES ('10', 'Ban giám đốc', '2014-04-26 10:37:48', '2014-04-26 10:38:28', '9999', '4', null, null, null);
INSERT INTO post VALUES ('11', 'tenten', '2014-04-26 10:37:52', '2014-04-26 10:38:31', '9999', '2', null, null, null);
INSERT INTO post VALUES ('12', 'tenten', '2014-04-26 10:37:55', '2014-04-26 10:38:35', '9999', '3', null, null, null);
INSERT INTO post VALUES ('13', 'tenten', '2014-04-26 10:37:58', '2014-04-26 10:38:39', '9999', '4', null, null, null);
INSERT INTO post VALUES ('14', 'Kế toán', '2014-04-26 10:38:01', '2014-04-26 10:38:43', '9999', '1', null, null, null);
INSERT INTO post VALUES ('15', 'network', '2014-04-26 10:38:04', '2014-04-26 10:38:46', '9999', '1', null, null, null);
INSERT INTO post VALUES ('16', 'network', '2014-04-26 10:38:06', '2014-04-26 10:38:48', '9999', '2', null, null, null);
INSERT INTO post VALUES ('17', 'network', '2014-04-26 10:38:09', '2014-04-26 10:38:51', '9999', '3', null, null, null);
INSERT INTO post VALUES ('18', 'network', '2014-04-26 10:38:12', '2014-04-26 10:38:54', '9999', '4', null, null, null);

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL COMMENT '1: 閲覧\r\n2: 投稿\r\n3: 管理',
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1195 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO role VALUES ('119', 'admin', '2014-05-22 17:26:03', '2014-05-23 10:16:14', '123456');
INSERT INTO role VALUES ('1194', 'Manager', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role VALUES ('104', 'Normal', '2014-05-22 17:29:00', '2014-05-22 17:40:26', '123456');

-- ----------------------------
-- Table structure for `role_management`
-- ----------------------------
DROP TABLE IF EXISTS `role_management`;
CREATE TABLE `role_management` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `baserole_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1474 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role_management
-- ----------------------------
INSERT INTO role_management VALUES ('57', '60', '37', '1', '2013-08-01 14:04:33', '2013-08-01 14:04:33', 'Haipt');
INSERT INTO role_management VALUES ('58', '60', '37', '2', '2013-08-01 14:04:33', '2013-08-01 14:04:33', 'Haipt');
INSERT INTO role_management VALUES ('114', '0', '23', '1', '2013-08-02 11:08:12', '2013-08-02 11:08:12', 'Haipt');
INSERT INTO role_management VALUES ('1442', '1194', '34', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1441', '1194', '33', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1336', '119', '59', '1', '2014-05-19 11:41:22', '2014-05-19 11:41:22', '123456');
INSERT INTO role_management VALUES ('901', '104', '29', '1', '2013-09-11 09:53:36', '2013-09-11 09:53:36', '');
INSERT INTO role_management VALUES ('902', '104', '30', '1', '2013-09-11 09:53:36', '2013-09-11 09:53:36', '');
INSERT INTO role_management VALUES ('1335', '104', '30', '3', '2014-05-09 11:51:34', '2014-05-09 11:51:34', '123456');
INSERT INTO role_management VALUES ('889', '104', '23', '1', '2013-09-11 09:53:36', '2013-09-11 09:53:36', '');
INSERT INTO role_management VALUES ('1236', '119', '30', '3', '2013-11-21 11:51:59', '2013-11-21 11:51:59', '777777');
INSERT INTO role_management VALUES ('1440', '1194', '33', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1439', '1194', '33', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('905', '104', '31', '1', '2013-09-11 09:53:36', '2013-09-11 09:53:36', '');
INSERT INTO role_management VALUES ('1328', '104', '56', '1', '2014-05-09 09:54:00', '2014-05-09 09:54:00', '123456');
INSERT INTO role_management VALUES ('1337', '119', '59', '2', '2014-05-19 11:41:22', '2014-05-19 11:41:22', '123456');
INSERT INTO role_management VALUES ('911', '104', '33', '1', '2013-09-11 09:53:36', '2013-09-11 09:53:36', '');
INSERT INTO role_management VALUES ('912', '104', '33', '2', '2013-09-11 09:53:36', '2013-09-11 09:53:36', '');
INSERT INTO role_management VALUES ('913', '104', '33', '3', '2013-09-11 09:53:36', '2013-09-11 09:53:36', '');
INSERT INTO role_management VALUES ('914', '104', '34', '1', '2013-09-11 09:53:36', '2013-09-11 09:53:36', '');
INSERT INTO role_management VALUES ('1338', '119', '59', '3', '2014-05-19 11:41:22', '2014-05-19 11:41:22', '123456');
INSERT INTO role_management VALUES ('1325', '104', '52', '1', '2014-05-09 09:54:00', '2014-05-09 09:54:00', '123456');
INSERT INTO role_management VALUES ('1438', '1194', '31', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1437', '1194', '31', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1198', '119', '23', '3', '2013-10-03 08:09:30', '2013-10-03 08:09:30', '12345678');
INSERT INTO role_management VALUES ('1195', '119', '23', '1', '2013-10-02 15:01:33', '2013-10-02 15:01:33', '12345678');
INSERT INTO role_management VALUES ('1193', '119', '30', '1', '2013-10-02 14:20:02', '2013-10-02 14:20:02', '');
INSERT INTO role_management VALUES ('1189', '119', '33', '1', '2013-10-02 14:17:51', '2013-10-02 14:17:51', '');
INSERT INTO role_management VALUES ('1191', '119', '30', '2', '2013-10-02 14:18:49', '2013-10-02 14:18:49', '');
INSERT INTO role_management VALUES ('1174', '119', '31', '3', '2013-10-02 13:59:50', '2013-10-02 13:59:50', '');
INSERT INTO role_management VALUES ('1181', '119', '34', '2', '2013-10-02 14:07:27', '2013-10-02 14:07:27', '');
INSERT INTO role_management VALUES ('1180', '119', '34', '3', '2013-10-02 14:03:49', '2013-10-02 14:03:49', '');
INSERT INTO role_management VALUES ('1184', '119', '33', '2', '2013-10-02 14:11:13', '2013-10-02 14:11:13', '');
INSERT INTO role_management VALUES ('1183', '119', '34', '1', '2013-10-02 14:08:47', '2013-10-02 14:08:47', '');
INSERT INTO role_management VALUES ('1185', '119', '33', '3', '2013-10-02 14:11:13', '2013-10-02 14:11:13', '');
INSERT INTO role_management VALUES ('1173', '119', '31', '1', '2013-10-02 13:59:50', '2013-10-02 13:59:50', '');
INSERT INTO role_management VALUES ('1097', '119', '37', '3', '2013-09-18 10:56:59', '2013-09-18 10:56:59', '12345678');
INSERT INTO role_management VALUES ('1172', '119', '31', '2', '2013-10-02 13:57:56', '2013-10-02 13:57:56', '');
INSERT INTO role_management VALUES ('1244', '119', '51', '1', '2014-04-03 10:11:13', '2014-04-03 10:11:17', 'sdfsd');
INSERT INTO role_management VALUES ('1245', '119', '51', '2', '2014-04-03 10:11:37', '2014-04-03 10:11:39', 'sdfsdf');
INSERT INTO role_management VALUES ('1246', '119', '51', '3', '2014-04-03 10:11:52', '2014-04-03 10:11:56', 'sdfsdf');
INSERT INTO role_management VALUES ('1251', '119', '23', '2', '2014-04-20 14:00:00', '2014-04-20 14:00:00', '12345678');
INSERT INTO role_management VALUES ('1267', '119', '29', '1', '2014-04-24 15:20:14', '2014-04-24 15:20:14', '12345678');
INSERT INTO role_management VALUES ('1272', '119', '53', '3', '2014-04-24 16:14:19', '2014-04-24 16:14:21', '34534543');
INSERT INTO role_management VALUES ('1264', '119', '52', '1', '2014-04-24 15:18:14', '2014-04-24 15:18:14', '12345678');
INSERT INTO role_management VALUES ('1473', '119', '64', '3', '2014-05-23 10:16:15', '2014-05-23 10:16:15', '123456');
INSERT INTO role_management VALUES ('1275', '119', '54', '3', '2014-04-29 18:04:54', '2014-04-29 18:04:54', '123456');
INSERT INTO role_management VALUES ('1472', '119', '64', '2', '2014-05-23 10:16:15', '2014-05-23 10:16:15', '123456');
INSERT INTO role_management VALUES ('1471', '119', '64', '1', '2014-05-23 10:16:15', '2014-05-23 10:16:15', '123456');
INSERT INTO role_management VALUES ('1278', '119', '55', '3', '2014-05-02 12:40:49', '2014-05-02 12:40:49', '123456');
INSERT INTO role_management VALUES ('1279', '119', '56', '1', '2014-05-05 10:34:51', '2014-05-05 10:34:51', '123456');
INSERT INTO role_management VALUES ('1280', '119', '56', '2', '2014-05-05 10:34:51', '2014-05-05 10:34:51', '123456');
INSERT INTO role_management VALUES ('1281', '119', '56', '3', '2014-05-05 10:34:51', '2014-05-05 10:34:51', '123456');
INSERT INTO role_management VALUES ('1282', '119', '57', '1', '2014-05-06 10:03:45', '2014-05-06 10:03:45', '123456');
INSERT INTO role_management VALUES ('1283', '119', '57', '2', '2014-05-06 10:03:45', '2014-05-06 10:03:45', '123456');
INSERT INTO role_management VALUES ('1284', '119', '57', '3', '2014-05-06 10:03:45', '2014-05-06 10:03:45', '123456');
INSERT INTO role_management VALUES ('1285', '119', '58', '1', '2014-05-06 14:43:43', '2014-05-06 14:43:43', '123456');
INSERT INTO role_management VALUES ('1286', '119', '58', '2', '2014-05-06 14:43:43', '2014-05-06 14:43:43', '123456');
INSERT INTO role_management VALUES ('1287', '119', '58', '3', '2014-05-06 14:43:43', '2014-05-06 14:43:43', '123456');
INSERT INTO role_management VALUES ('1436', '1194', '30', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1435', '1194', '30', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1434', '1194', '30', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1433', '1194', '29', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1432', '1194', '23', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1431', '1194', '23', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1430', '1194', '23', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1429', '1193', '63', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1428', '1193', '62', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1427', '1193', '61', '2', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1426', '1193', '61', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1425', '1193', '60', '2', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1424', '1193', '60', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1423', '1193', '59', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1422', '1193', '58', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1421', '1193', '57', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1420', '1193', '56', '2', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1419', '1193', '56', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1418', '1193', '52', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1417', '1193', '51', '2', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1416', '1193', '51', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1415', '1193', '34', '2', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1414', '1193', '34', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1413', '1193', '33', '2', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1412', '1193', '33', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1411', '1193', '31', '2', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1410', '1193', '31', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1409', '1193', '30', '2', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1408', '1193', '30', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1407', '1193', '29', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1406', '1193', '23', '1', '2014-05-22 17:29:00', '2014-05-22 17:29:00', '123456');
INSERT INTO role_management VALUES ('1334', '104', '30', '2', '2014-05-09 11:51:34', '2014-05-09 11:51:34', '123456');
INSERT INTO role_management VALUES ('1331', '104', '57', '1', '2014-05-09 09:54:00', '2014-05-09 09:54:00', '123456');
INSERT INTO role_management VALUES ('1332', '104', '58', '1', '2014-05-09 09:54:00', '2014-05-09 09:54:00', '123456');
INSERT INTO role_management VALUES ('1339', '104', '59', '1', '2014-05-19 16:18:59', '2014-05-19 16:18:59', '123456');
INSERT INTO role_management VALUES ('1340', '104', '59', '2', '2014-05-19 16:18:59', '2014-05-19 16:18:59', '123456');
INSERT INTO role_management VALUES ('1341', '119', '60', '1', '2014-05-20 12:26:35', '2014-05-20 12:26:35', '123456');
INSERT INTO role_management VALUES ('1342', '119', '60', '2', '2014-05-20 12:26:35', '2014-05-20 12:26:35', '123456');
INSERT INTO role_management VALUES ('1343', '119', '60', '3', '2014-05-20 12:26:35', '2014-05-20 12:26:35', '123456');
INSERT INTO role_management VALUES ('1344', '119', '61', '1', '2014-05-20 12:58:25', '2014-05-20 12:58:25', '123456');
INSERT INTO role_management VALUES ('1345', '119', '61', '2', '2014-05-20 12:58:25', '2014-05-20 12:58:25', '123456');
INSERT INTO role_management VALUES ('1346', '119', '61', '3', '2014-05-20 12:58:25', '2014-05-20 12:58:25', '123456');
INSERT INTO role_management VALUES ('1347', '104', '23', '2', '2014-05-20 16:30:09', '2014-05-20 16:30:09', '123456');
INSERT INTO role_management VALUES ('1349', '104', '31', '2', '2014-05-20 16:30:09', '2014-05-20 16:30:09', '123456');
INSERT INTO role_management VALUES ('1350', '104', '58', '2', '2014-05-20 16:30:09', '2014-05-20 16:30:09', '123456');
INSERT INTO role_management VALUES ('1351', '104', '60', '1', '2014-05-20 16:30:09', '2014-05-20 16:30:09', '123456');
INSERT INTO role_management VALUES ('1352', '104', '60', '2', '2014-05-20 16:30:09', '2014-05-20 16:30:09', '123456');
INSERT INTO role_management VALUES ('1353', '104', '61', '1', '2014-05-20 16:30:09', '2014-05-20 16:30:09', '123456');
INSERT INTO role_management VALUES ('1354', '104', '61', '2', '2014-05-20 16:30:09', '2014-05-20 16:30:09', '123456');
INSERT INTO role_management VALUES ('1355', '119', '62', '1', '2014-05-21 14:55:52', '2014-05-21 14:55:52', '123456');
INSERT INTO role_management VALUES ('1356', '119', '62', '2', '2014-05-21 14:55:52', '2014-05-21 14:55:52', '123456');
INSERT INTO role_management VALUES ('1357', '119', '62', '3', '2014-05-21 14:55:52', '2014-05-21 14:55:52', '123456');
INSERT INTO role_management VALUES ('1358', '119', '63', '1', '2014-05-22 17:43:39', '2014-05-22 17:43:39', '123456');
INSERT INTO role_management VALUES ('1359', '119', '63', '2', '2014-05-22 17:43:39', '2014-05-22 17:43:39', '123456');
INSERT INTO role_management VALUES ('1360', '119', '63', '3', '2014-05-22 17:43:39', '2014-05-22 17:43:39', '123456');
INSERT INTO role_management VALUES ('1361', '1192', '23', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1362', '1192', '23', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1363', '1192', '23', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1364', '1192', '29', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1365', '1192', '30', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1366', '1192', '30', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1367', '1192', '30', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1368', '1192', '31', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1369', '1192', '31', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1370', '1192', '31', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1371', '1192', '33', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1372', '1192', '33', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1373', '1192', '33', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1374', '1192', '34', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1375', '1192', '34', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1376', '1192', '34', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1377', '1192', '37', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1378', '1192', '51', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1379', '1192', '51', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1380', '1192', '51', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1381', '1192', '52', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1382', '1192', '53', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1383', '1192', '54', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1384', '1192', '55', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1385', '1192', '56', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1386', '1192', '56', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1387', '1192', '56', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1388', '1192', '58', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1389', '1192', '58', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1390', '1192', '58', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1391', '1192', '59', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1392', '1192', '59', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1393', '1192', '59', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1394', '1192', '60', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1395', '1192', '60', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1396', '1192', '60', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1397', '1192', '61', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1398', '1192', '61', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1399', '1192', '61', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1400', '1192', '62', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1401', '1192', '62', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1402', '1192', '62', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1403', '1192', '63', '1', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1404', '1192', '63', '2', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1405', '1192', '63', '3', '2014-05-22 17:26:03', '2014-05-22 17:26:03', '123456');
INSERT INTO role_management VALUES ('1443', '1194', '34', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1444', '1194', '34', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1445', '1194', '51', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1446', '1194', '52', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1447', '1194', '56', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1448', '1194', '56', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1449', '1194', '56', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1450', '1194', '57', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1451', '1194', '57', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1452', '1194', '57', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1453', '1194', '58', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1454', '1194', '58', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1455', '1194', '58', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1456', '1194', '59', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1457', '1194', '59', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1458', '1194', '59', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1459', '1194', '60', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1460', '1194', '60', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1461', '1194', '60', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1462', '1194', '61', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1463', '1194', '61', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1464', '1194', '61', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1465', '1194', '62', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1466', '1194', '62', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1467', '1194', '62', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1468', '1194', '63', '1', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1469', '1194', '63', '2', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');
INSERT INTO role_management VALUES ('1470', '1194', '63', '3', '2014-05-22 17:30:48', '2014-05-22 17:30:48', '123456');

-- ----------------------------
-- Table structure for `room_chat`
-- ----------------------------
DROP TABLE IF EXISTS `room_chat`;
CREATE TABLE `room_chat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_time` datetime NOT NULL,
  `is_saved` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of room_chat
-- ----------------------------
INSERT INTO room_chat VALUES ('1', 'PHA+DQoJPGltZyBhbHQ9ImRldmlsIiBoZWlnaHQ9IjIwIiBzcmM9Imh0dHA6Ly93ZWJfbm9pYm8uY29tL2NrZWRpdG9yL3BsdWdpbnMvc21pbGV5L2ltYWdlcy9kZXZpbF9zbWlsZS5naWYiIHRpdGxlPSJkZXZpbCIgd2lkdGg9IjIwIiAvPjwvcD4NCg==', '95', '2014-04-29 11:59:36', '');
INSERT INTO room_chat VALUES ('2', 'PHA+DQoJPGltZyBhbHQ9ImRldmlsIiBoZWlnaHQ9IjIwIiBzcmM9Imh0dHA6Ly93ZWJfbm9pYm8uY29tL2NrZWRpdG9yL3BsdWdpbnMvc21pbGV5L2ltYWdlcy9kZXZpbF9zbWlsZS5naWYiIHRpdGxlPSJkZXZpbCIgd2lkdGg9IjIwIiAvPmRzZnNkPC9wPg0K', '95', '2014-04-29 11:59:41', '');
INSERT INTO room_chat VALUES ('3', 'PHA+DQoJc2Rhc2RhczxpbWcgYWx0PSJkZXZpbCIgaGVpZ2h0PSIyMCIgc3JjPSJodHRwOi8vd2ViX25vaWJvLmNvbS9ja2VkaXRvci9wbHVnaW5zL3NtaWxleS9pbWFnZXMvZGV2aWxfc21pbGUuZ2lmIiB0aXRsZT0iZGV2aWwiIHdpZHRoPSIyMCIgLz5kc2ZzZDwvcD4NCg==', '95', '2014-04-29 11:59:46', '');
INSERT INTO room_chat VALUES ('4', 'PHA+DQoJc2Rhc2RhczxpbWcgYWx0PSJkZXZpbCIgaGVpZ2h0PSIyMCIgc3JjPSJodHRwOi8vd2ViX25vaWJvLmNvbS9ja2VkaXRvci9wbHVnaW5zL3NtaWxleS9pbWFnZXMvZGV2aWxfc21pbGUuZ2lmIiB0aXRsZT0iZGV2aWwiIHdpZHRoPSIyMCIgLz5kc2ZzZDxzcGFuIHN0eWxlPSJjb2xvcjojMDBmZmZmOyI+ZGZzZGZzZDxzcGFuIHN0eWxlPSJmb250LXNpemU6MjZweDsiPnNkZnNkZnNkZnNkZjwvc3Bhbj48L3NwYW4+PC9wPg0K', '95', '2014-04-29 12:00:02', '');

-- ----------------------------
-- Table structure for `thanks`
-- ----------------------------
DROP TABLE IF EXISTS `thanks`;
CREATE TABLE `thanks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `comment` varchar(512) NOT NULL,
  `sender` varchar(256) DEFAULT NULL,
  `contributor_id` varchar(64) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of thanks
-- ----------------------------
INSERT INTO thanks VALUES ('1', '170', 'chúc mừng 11', '', '17', '2014-04-21 17:13:16', '2014-04-21 17:13:28', '12345678');
INSERT INTO thanks VALUES ('7', '95', 'dsfsdf', '', '95', '2014-05-22 16:38:55', '2014-05-22 16:38:55', '123456');
INSERT INTO thanks VALUES ('8', '97', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '', '95', '2014-05-23 11:34:19', '2014-05-23 11:34:19', '123456');

-- ----------------------------
-- Table structure for `unit`
-- ----------------------------
DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(256) NOT NULL,
  `display_order` int(11) unsigned NOT NULL,
  `mailaddr` varchar(256) DEFAULT NULL,
  `catchphrase` varchar(128) DEFAULT NULL,
  `introduction` text,
  `attachment1` varchar(256) DEFAULT NULL,
  `attachment2` varchar(256) DEFAULT NULL,
  `attachment3` varchar(256) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  `active_flag` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of unit
-- ----------------------------
INSERT INTO unit VALUES ('1', 'TP Hà Nội', '1', null, null, null, null, null, null, '2014-03-05 15:10:04', '2014-03-05 15:10:04', '', '');
INSERT INTO unit VALUES ('2', 'TP Hồ Chí Minh', '2', null, null, null, null, null, null, '2014-03-05 15:10:58', '2014-03-05 15:10:58', '', '');
INSERT INTO unit VALUES ('3', 'Tokyo', '3', null, null, null, null, null, null, '2014-03-05 15:13:13', '2014-03-05 15:13:13', '', '');
INSERT INTO unit VALUES ('4', 'TP Đà Nẵng', '4', 'danang@runsystem.net', 'Cố gắng lên!', 'Ông Ích Khiêm\r\nQuận Hải Châu\r\nTP Đà Nẵng', '/upload/unit/attachment1/b.123456_20140429161624.ppt', '/upload/unit/attachment2/123456_20140429170309.png', null, '2014-03-05 15:14:25', '2014-05-02 14:23:21', '123456', '');

-- ----------------------------
-- Table structure for `update_information`
-- ----------------------------
DROP TABLE IF EXISTS `update_information`;
CREATE TABLE `update_information` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1: マジメ\r\n2: あそび',
  `table_name` varchar(255) NOT NULL,
  `article_id` int(11) NOT NULL,
  `contributor_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of update_information
-- ----------------------------
INSERT INTO update_information VALUES ('3', '1', 'hr', '3', '95', '2014-05-23 10:53:03', '2014-05-23 10:53:03');
INSERT INTO update_information VALUES ('4', '1', 'hr', '4', '95', '2014-05-23 10:53:35', '2014-05-23 10:53:35');
INSERT INTO update_information VALUES ('5', '1', 'hr', '5', '95', '2014-05-23 10:53:41', '2014-05-23 10:53:41');
INSERT INTO update_information VALUES ('6', '1', 'hr', '6', '95', '2014-05-23 10:53:48', '2014-05-23 10:53:48');
INSERT INTO update_information VALUES ('7', '1', 'hr', '7', '95', '2014-05-23 10:53:55', '2014-05-23 10:53:55');
INSERT INTO update_information VALUES ('8', '1', 'hr', '8', '95', '2014-05-23 10:54:15', '2014-05-23 10:54:15');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `employee_number` varchar(24) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `mailaddr` varchar(256) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `birthday` datetime NOT NULL,
  `joindate` int(4) NOT NULL,
  `comment` text,
  `photo` varchar(256) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  `division` int(11) unsigned DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `chuc_vu` int(11) DEFAULT NULL,
  `active_flag` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO user VALUES ('46', '119', '999999', '999999', 'trungnt@runsystem.net', 'Nguyễn', 'Thanh Trung', '1979-01-01 00:00:00', '1995', null, null, '2013-08-22 08:30:11', '2014-04-26 12:15:12', '123456', '4', '10', null, '');
INSERT INTO user VALUES ('95', '119', '123456', '123456', 'tuetc@runsystem.net', 'Trần', 'Công Tuệ', '1984-12-08 00:00:00', '2013', 'ksdjfsdkl\r\nsdfsd\r\nsd\r\nf\r\nsdf\r\nsd\r\nf\r\nsd\r\nfd\r\nsf\r\nsd\r\nf', '/upload/user/attachment1/123456_20140522163810.jpg', '2014-04-25 23:13:42', '2014-06-19 14:00:46', '123456', '4', '8', '4', '');
INSERT INTO user VALUES ('96', '104', '1234567', '1234567', 'haipt@runsystem.net', 'Phan', 'Thanh Hải', '1989-01-01 00:00:00', '2012', null, null, '2014-04-25 23:29:54', '2014-05-09 09:59:56', '123456', '4', '8', null, '');
INSERT INTO user VALUES ('97', '104', '12345678', '7581', 'baodt@runsystem.net', 'Đỗ Thiên', 'Bảo', '1980-01-01 00:00:00', '2012', null, null, '2014-05-19 10:00:00', '2014-05-19 10:00:00', '123456', '4', '8', '4', '');
INSERT INTO user VALUES ('98', '119', '43534', '7581', 'sdfgsd@sdfsd.sdfsd', 'sdfds', 'dsfsd', '1980-01-01 00:00:00', '2342', null, '/upload/user/attachment1/123456_20140618154429.png', '2014-06-18 15:44:34', '2014-06-18 16:08:14', '43534', '4', '8', '4', '');
INSERT INTO user VALUES ('99', '119', '2343242', '7581', 'sds@sdfsd.sdfsd', 'sdfsf', 'sdsdfsd', '1980-01-01 00:00:00', '4234', null, null, '2014-06-18 15:48:18', '2014-06-18 15:48:50', '123456', '1', '2', '4', '');

-- ----------------------------
-- Table structure for `work_smile`
-- ----------------------------
DROP TABLE IF EXISTS `work_smile`;
CREATE TABLE `work_smile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `attachment1` varchar(256) DEFAULT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_person` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_smile
-- ----------------------------

-- ----------------------------
-- View structure for `view_room_chat`
-- ----------------------------
DROP VIEW IF EXISTS `view_room_chat`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_room_chat` AS select `user`.`lastname` AS `lastname`,`user`.`firstname` AS `firstname`,`room_chat`.`content` AS `content`,`room_chat`.`send_time` AS `send_time`,`room_chat`.`is_saved` AS `is_saved` from (`user` join `room_chat` on((`room_chat`.`user_id` = `user`.`id`)));
