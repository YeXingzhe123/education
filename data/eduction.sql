# Host: localhost  (Version: 5.5.47-log)
# Date: 2016-11-20 16:28:18
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "admin"
#

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "admin"
#

INSERT INTO `admin` VALUES (0,'admin','admin',NULL);

#
# Structure for table "course"
#

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'course字段',
  `course_student_id` int(11) NOT NULL,
  `course_item_id` int(11) NOT NULL,
  `remain_times` int(11) NOT NULL COMMENT '剩余的次数',
  `course_datetime` datetime NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "course"
#

INSERT INTO `course` VALUES (1,2,68,21,'2016-11-09 19:27:08'),(2,2,27,2222,'2016-11-09 19:27:08'),(3,2,68,21,'2016-11-15 18:12:29'),(4,2,34,212,'2016-11-15 18:12:29'),(5,2,30,55,'2016-11-15 18:12:29'),(6,2,31,66,'2016-11-15 18:12:29');

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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

#
# Data for table "items"
#

INSERT INTO `items` VALUES (27,'啊飒飒',22,22,0,2),(30,'发的发的',55,55,0,5),(31,'热尔',66,66,0,3),(34,'嘿嘿',212,211,0,1),(39,'12121',2121,212121,0,7),(66,'但是',21,12,0,5),(68,'我QQ无',21,34,0,5);

#
# Structure for table "pay"
#

DROP TABLE IF EXISTS `pay`;
CREATE TABLE `pay` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_student_id` int(11) NOT NULL,
  `pay_course_name` varchar(255) DEFAULT NULL COMMENT '所有课程信息名',
  `pay_payable` int(11) NOT NULL COMMENT '应缴费用',
  `pay_favor` int(11) NOT NULL DEFAULT '0' COMMENT '优惠',
  `pay_total` int(11) NOT NULL COMMENT '总缴费',
  `pay_datetime` datetime NOT NULL,
  `pay_refund` int(11) DEFAULT '0',
  `pay_remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "pay"
#

INSERT INTO `pay` VALUES (1,2,'我QQ无,啊飒飒,嘿嘿',45930,0,45930,'2016-11-09 19:27:08',12345,NULL),(2,2,'',0,0,0,'2016-11-12 20:02:56',123,'3213'),(3,2,'',0,0,0,'2016-11-12 20:03:24',123,'1312321'),(4,2,'我QQ无,嘿嘿,发的发的,热尔',52827,2323,50504,'2016-11-15 18:12:29',0,NULL);

#
# Structure for table "student"
#

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_number` varchar(11) NOT NULL DEFAULT '0',
  `student_name` varchar(255) NOT NULL DEFAULT '',
  `student_tel` varchar(255) DEFAULT NULL,
  `student_sex` varchar(255) DEFAULT NULL,
  `student_birthday` date DEFAULT NULL,
  `student_remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "student"
#

INSERT INTO `student` VALUES (2,'0','412323','1231232','男','0000-00-00','12312312312'),(4,'0','1232','12312321','男','0000-00-00','123123123'),(5,'0','13213','12312312','男','2016-11-10','12312312');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "teacher"
#

/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (1,'1123','山东省','1212','1221','12',NULL,NULL,NULL,NULL,NULL,'false','0'),(2,'2121','颠三倒四','322','32','212',NULL,NULL,NULL,NULL,NULL,'false','0'),(3,'2323','实打实的','343','5454','545',NULL,NULL,NULL,NULL,NULL,'false','0'),(4,'5454','说的','656','7667','343',NULL,NULL,NULL,NULL,NULL,'false','0'),(5,'33','发的3','343','4334','343434',NULL,NULL,NULL,NULL,NULL,'false','0'),(6,'5454','到底','23','23','23',NULL,NULL,NULL,NULL,NULL,'false','0'),(7,NULL,'请选择----',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ture','1'),(8,'admin','1232','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'false','0');
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
