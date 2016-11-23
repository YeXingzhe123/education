# Host: localhost  (Version: 5.5.47-log)
# Date: 2016-11-20 20:20:41
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "admin"
#

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remack` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "admin"
#

INSERT INTO `admin` VALUES (1,'323232','323232',NULL);

#
# Structure for table "course"
#

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course_id` int(11) NOT NULL COMMENT 'course字段',
  `course_student_id` int(11) NOT NULL,
  `course_item_id` int(11) NOT NULL,
  `remain_times` int(11) NOT NULL COMMENT '剩余的次数',
  `course_datetime` datetime NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "course"
#


#
# Structure for table "items"
#

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `items_id` int(11) NOT NULL AUTO_INCREMENT,
  `items_name` varchar(255) NOT NULL DEFAULT '',
  `items_times` int(11) NOT NULL DEFAULT '0',
  `items_price` double NOT NULL DEFAULT '0',
  `items_total_price` double NOT NULL DEFAULT '0',
  `items_teacher_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`items_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

#
# Data for table "items"
#

INSERT INTO `items` VALUES (27,'啊飒飒',22,22,0,2),(30,'发的发的',55,55,0,5),(31,'热尔',6623,66,0,7),(32,'突然突然',111,11,0,7),(34,'嘿嘿',212,211,0,1),(39,'12121',2121,212121,0,7),(66,'但是',21,12,0,5),(68,'我QQ无',21,34,0,5),(69,'1221',2121,2323,0,5);

#
# Structure for table "pay"
#

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

#
# Data for table "pay"
#


#
# Structure for table "schedule"
#

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_weekend` varchar(255) DEFAULT NULL,
  `schedule_time` varchar(10) DEFAULT NULL,
  `schedule_items_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=278 DEFAULT CHARSET=utf8;

#
# Data for table "schedule"
#

INSERT INTO `schedule` VALUES (179,'7','12:00','68',NULL),(181,'4','04:00','27',NULL),(187,'4','04:00','66',NULL),(195,'2','21:00','31',NULL),(202,'4','19:00','34',NULL),(204,'4','19:00','69',NULL),(207,'5','21:01','31',NULL),(214,'5','21:01','27',NULL),(215,'5','21:01','30',NULL),(217,'5','21:01','27',NULL),(221,'5','21:01','30',NULL),(226,'1','22:00','27',NULL),(232,'1','20:00','27',NULL),(237,'1','20:00','39',NULL),(238,'2','23:00','27',NULL),(239,'1','22:00','30',NULL),(244,'2','23:00','31',NULL),(246,'3','22:00','27',NULL),(247,'3','22:00','30',NULL),(252,'1','23:00','30',NULL),(253,'1','23:00','32',NULL),(254,'3','23:00','27',NULL),(255,'3','23:00','30',NULL),(256,'3','22:00','31',NULL),(257,'3','22:00','31',NULL),(258,'3','22:00','31',NULL),(259,'3','22:00','31',NULL),(260,'3','22:00','31',NULL),(261,'3','22:00','32',NULL),(262,'1','21:00','30',NULL),(263,'1','21:00','31',NULL),(264,'1','21:00','32',NULL),(265,'1','02:00','30',NULL),(266,'1','02:00','31',NULL),(267,'2','22:00','27',NULL),(268,'2','22:00','30',NULL),(269,'2','22:00','32',NULL),(270,'1','21:00','27',NULL),(271,'2','23:00','31',NULL),(272,'2','23:00','32',NULL),(273,'2','23:00','39',NULL),(276,'6','22:00','31',NULL),(277,'2','11:00','27',NULL);

#
# Structure for table "student"
#

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) NOT NULL DEFAULT '',
  `student_sex` varchar(255) DEFAULT '',
  `student_birthday` varchar(255) DEFAULT NULL,
  `student_tel` varchar(255) DEFAULT NULL,
  `student_remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "student"
#

INSERT INTO `student` VALUES (1,'1212','男','2016-11-10','','');

#
# Structure for table "teacher"
#

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_no` varchar(255) DEFAULT NULL,
  `teacher_name` varchar(255) DEFAULT NULL,
  `teacher_password` varchar(255) DEFAULT NULL,
  `teacher_id_card` varchar(255) DEFAULT NULL,
  `teacher_sex` varchar(255) DEFAULT NULL,
  `teacher_birthday` date DEFAULT NULL,
  `teacher_education` varchar(255) DEFAULT NULL,
  `teacher_major` varchar(255) DEFAULT NULL,
  `teacher_salary` double DEFAULT NULL,
  `teacher_remark` varchar(255) DEFAULT NULL,
  `selected` varchar(255) DEFAULT 'false',
  `extend` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

#
# Data for table "teacher"
#

INSERT INTO `teacher` VALUES (1,'1123','山东省','1212','1221','12',NULL,NULL,NULL,NULL,NULL,'false','0'),(2,'2121','颠三倒四','322','32','212',NULL,NULL,NULL,NULL,NULL,'false','0'),(3,'2323','实打实的','343','5454','545',NULL,NULL,NULL,NULL,NULL,'false','0'),(4,'5454','说的','656','7667','343',NULL,NULL,NULL,NULL,NULL,'false','0'),(5,'33','发的3','343','4334','343434',NULL,NULL,NULL,NULL,NULL,'false','0'),(6,'5454','到底','23','23','23',NULL,NULL,NULL,NULL,NULL,'false','0'),(7,NULL,'请选择----',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ture','1');
