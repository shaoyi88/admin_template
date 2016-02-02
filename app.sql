/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.5.24-log : Database - app
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `app`;

/*Table structure for table `app_admin` */

DROP TABLE IF EXISTS `app_admin`;

CREATE TABLE `app_admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `admin_name` varchar(10) DEFAULT NULL COMMENT '管理员名字',
  `admin_account` varchar(16) DEFAULT NULL COMMENT '帐号',
  `admin_password` varchar(32) DEFAULT NULL COMMENT '密码',
  `reg_time` varchar(10) DEFAULT NULL COMMENT '注册时间',
  `admin_role` int(10) DEFAULT NULL COMMENT '角色',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `account` (`admin_account`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `app_admin` */

insert  into `app_admin`(`admin_id`,`admin_name`,`admin_account`,`admin_password`,`reg_time`,`admin_role`) values (1,'管理员','admin','96e79218965eb72c92a549dd5a330112','1454401709',0);

/*Table structure for table `app_role` */

DROP TABLE IF EXISTS `app_role`;

CREATE TABLE `app_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `role_name` varchar(255) DEFAULT NULL COMMENT '权限名',
  `role_rights` text COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `app_role` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
