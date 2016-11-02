/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50712
Source Host           : localhost:3306
Source Database       : education

Target Server Type    : MYSQL
Target Server Version : 50712
File Encoding         : 65001

Date: 2016-11-01 20:23:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pay
-- ----------------------------
DROP TABLE IF EXISTS `pay`;
CREATE TABLE `pay` (
  `pay_id` int(11) NOT NULL,
  `pay_student_id` int(11) NOT NULL,
  `pay_course_name` varchar(255) DEFAULT NULL COMMENT '所有课程信息名',
  `pay_payable` int(11) NOT NULL COMMENT '应缴费用',
  `pay_favor` int(11) NOT NULL DEFAULT '0' COMMENT '优惠',
  `pay_total` int(11) NOT NULL COMMENT '总缴费',
  `pay_datetime` datetime NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
