/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-06-13 15:51:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_article
-- ----------------------------
DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE `blog_article` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `btitle` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `status` tinyint(2) DEFAULT NULL,
  `cid` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of blog_article
-- ----------------------------
INSERT INTO `blog_article` VALUES ('1', '0', '测试', '0', '0');
INSERT INTO `blog_article` VALUES ('2', '0', '测试', '0', '0');
INSERT INTO `blog_article` VALUES ('3', '1', '测试', '0', '2');
INSERT INTO `blog_article` VALUES ('4', '2', '测试', '0', '4');
INSERT INTO `blog_article` VALUES ('5', '3', '测试', '0', '6');
INSERT INTO `blog_article` VALUES ('6', '4', '测试', '0', '8');
INSERT INTO `blog_article` VALUES ('7', '5', '测试', '0', '10');
INSERT INTO `blog_article` VALUES ('8', '6', '测试', '0', '12');
INSERT INTO `blog_article` VALUES ('9', '7', '测试', '0', '14');
INSERT INTO `blog_article` VALUES ('10', '8', '测试', '0', '16');
INSERT INTO `blog_article` VALUES ('11', '9', '测试', '0', '18');
INSERT INTO `blog_article` VALUES ('12', '10', '测试', '0', '20');
INSERT INTO `blog_article` VALUES ('13', '11', '测试', '0', '22');
INSERT INTO `blog_article` VALUES ('14', '12', '测试', '0', '24');
INSERT INTO `blog_article` VALUES ('15', '13', '测试', '0', '26');
INSERT INTO `blog_article` VALUES ('16', '14', '测试', '0', '28');
INSERT INTO `blog_article` VALUES ('17', '15', '测试', '0', '30');
INSERT INTO `blog_article` VALUES ('18', '16', '测试', '0', '32');
INSERT INTO `blog_article` VALUES ('19', '17', '测试', '0', '34');
INSERT INTO `blog_article` VALUES ('20', '18', '测试', '0', '36');
INSERT INTO `blog_article` VALUES ('21', '19', '测试', '0', '38');
INSERT INTO `blog_article` VALUES ('22', '20', '测试', '0', '40');
INSERT INTO `blog_article` VALUES ('23', '21', '测试', '0', '42');
INSERT INTO `blog_article` VALUES ('24', '22', '测试', '0', '44');
INSERT INTO `blog_article` VALUES ('25', '23', '测试', '0', '46');
INSERT INTO `blog_article` VALUES ('26', '24', '测试', '0', '48');
INSERT INTO `blog_article` VALUES ('27', '25', '测试', '0', '50');
INSERT INTO `blog_article` VALUES ('28', '26', '测试', '0', '52');
INSERT INTO `blog_article` VALUES ('29', '27', '测试', '0', '54');
INSERT INTO `blog_article` VALUES ('30', '28', '测试', '0', '56');
INSERT INTO `blog_article` VALUES ('31', '29', '测试', '0', '58');
INSERT INTO `blog_article` VALUES ('32', '30', '测试', '0', '60');
INSERT INTO `blog_article` VALUES ('33', '31', '测试', '0', '62');
INSERT INTO `blog_article` VALUES ('34', '32', '测试', '0', '64');
INSERT INTO `blog_article` VALUES ('35', '33', '测试', '0', '66');
INSERT INTO `blog_article` VALUES ('36', '34', '测试', '0', '68');
INSERT INTO `blog_article` VALUES ('37', '35', '测试', '0', '70');
INSERT INTO `blog_article` VALUES ('38', '36', '测试', '0', '72');
INSERT INTO `blog_article` VALUES ('39', '37', '测试', '0', '74');
INSERT INTO `blog_article` VALUES ('40', '38', '测试', '0', '76');
INSERT INTO `blog_article` VALUES ('41', '39', '测试', '0', '78');
INSERT INTO `blog_article` VALUES ('42', '40', '测试', '0', '80');
INSERT INTO `blog_article` VALUES ('43', '41', '测试', '0', '82');
INSERT INTO `blog_article` VALUES ('44', '42', '测试', '0', '84');
INSERT INTO `blog_article` VALUES ('45', '43', '测试', '0', '86');
INSERT INTO `blog_article` VALUES ('46', '44', '测试', '0', '88');
INSERT INTO `blog_article` VALUES ('47', '45', '测试', '0', '90');
INSERT INTO `blog_article` VALUES ('48', '46', '测试', '0', '92');
INSERT INTO `blog_article` VALUES ('49', '47', '测试', '0', '94');
INSERT INTO `blog_article` VALUES ('50', '48', '测试', '0', '96');
INSERT INTO `blog_article` VALUES ('51', '49', '测试', '0', '98');
INSERT INTO `blog_article` VALUES ('52', '50', '测试', '0', '100');
INSERT INTO `blog_article` VALUES ('53', '51', '测试', '0', '102');
INSERT INTO `blog_article` VALUES ('54', '52', '测试', '0', '104');
INSERT INTO `blog_article` VALUES ('55', '53', '测试', '0', '106');
INSERT INTO `blog_article` VALUES ('56', '54', '测试', '0', '108');
INSERT INTO `blog_article` VALUES ('57', '55', '测试', '0', '110');
INSERT INTO `blog_article` VALUES ('58', '56', '测试', '0', '112');
INSERT INTO `blog_article` VALUES ('59', '57', '测试', '0', '114');
INSERT INTO `blog_article` VALUES ('60', '58', '测试', '0', '116');
INSERT INTO `blog_article` VALUES ('61', '59', '测试', '0', '118');
INSERT INTO `blog_article` VALUES ('62', '60', '测试', '0', '120');
INSERT INTO `blog_article` VALUES ('63', '61', '测试', '0', '122');
INSERT INTO `blog_article` VALUES ('64', '62', '测试', '0', '124');
INSERT INTO `blog_article` VALUES ('65', '63', '测试', '0', '126');
INSERT INTO `blog_article` VALUES ('66', '64', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('67', '65', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('68', '66', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('69', '67', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('70', '68', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('71', '69', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('72', '70', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('73', '71', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('74', '72', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('75', '73', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('76', '74', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('77', '75', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('78', '76', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('79', '77', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('80', '78', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('81', '79', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('82', '80', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('83', '81', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('84', '82', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('85', '83', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('86', '84', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('87', '85', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('88', '86', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('89', '87', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('90', '88', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('91', '89', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('92', '90', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('93', '91', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('94', '92', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('95', '93', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('96', '94', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('97', '95', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('98', '96', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('99', '97', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('100', '98', '测试', '0', '127');
INSERT INTO `blog_article` VALUES ('101', '99', '测试', '0', '127');

-- ----------------------------
-- Table structure for blog_channel
-- ----------------------------
DROP TABLE IF EXISTS `blog_channel`;
CREATE TABLE `blog_channel` (
  `cid` tinyint(4) NOT NULL,
  `ctitle` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isshow` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of blog_channel
-- ----------------------------

-- ----------------------------
-- Table structure for blog_note
-- ----------------------------
DROP TABLE IF EXISTS `blog_note`;
CREATE TABLE `blog_note` (
  `nid` int(11) NOT NULL,
  `uid` mediumint(6) DEFAULT NULL,
  `wtime` int(10) DEFAULT NULL,
  `wpic` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `reply` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of blog_note
-- ----------------------------

-- ----------------------------
-- Table structure for blog_reply
-- ----------------------------
DROP TABLE IF EXISTS `blog_reply`;
CREATE TABLE `blog_reply` (
  `rid` mediumint(6) NOT NULL,
  `nid` int(11) DEFAULT NULL,
  `reply_content` text COLLATE utf8_unicode_ci,
  `reply_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of blog_reply
-- ----------------------------

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `uid` mediumint(9) NOT NULL,
  `uname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(2) DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logintime` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of blog_user
-- ----------------------------
