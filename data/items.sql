# Host: localhost  (Version: 5.5.47-log)
# Date: 2016-11-02 19:51:50
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

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

INSERT INTO `items` VALUES (27,'啊飒飒',22,22,0,2),(30,'发的发的',55,55,0,5),(31,'热尔',66,66,0,3),(32,'突然突然',11,11,0,5),(34,'嘿嘿',212,211,0,1),(35,'233223',2332,2332,0,2),(36,'11',111,1111,0,3),(39,'12121',2121,212121,0,7),(40,'21',21,21,0,1),(48,'1212',21,1221,0,3),(55,'123213',12312,12312,0,1),(56,'132213',123,12,0,4),(57,'1221',2121,212,0,6),(58,'21',21,21,0,3),(61,'1231',123,131,0,5),(62,'46',45,45,0,3),(63,'wos',34,12,0,3),(64,'ajh',21,23,0,4),(66,'但是',21,12,0,5),(67,'12',1,1,0,2),(68,'我QQ无',21,34,0,5),(69,'12',21,21,0,4);
