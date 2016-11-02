# Host: localhost  (Version: 5.5.47-log)
# Date: 2016-11-01 20:07:51
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

#
# Data for table "teacher"
#

/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (1,'1123','山东省','1212','1221','12',NULL,NULL,NULL,NULL,NULL,'false','0'),(2,'2121','颠三倒四','322','32','212',NULL,NULL,NULL,NULL,NULL,'false','0'),(3,'2323','实打实的','343','5454','545',NULL,NULL,NULL,NULL,NULL,'false','0'),(4,'5454','说的','656','7667','343',NULL,NULL,NULL,NULL,NULL,'false','0'),(5,'33','发的3','343','4334','343434',NULL,NULL,NULL,NULL,NULL,'false','0'),(6,'5454','到底','23','23','23',NULL,NULL,NULL,NULL,NULL,'false','0'),(7,NULL,'请选择----',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ture','1');
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
