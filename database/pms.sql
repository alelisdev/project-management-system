/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.8-MariaDB : Database - pms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `pms`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`name`,`country`,`created_at`,`deleted_at`) values 
(1,'Nikita','Russia','2021-09-30 13:29:09','0000-00-00 00:00:00'),
(2,'Nikita','Russia','2021-09-30 13:29:22','2021-09-30 13:40:34'),
(3,'Alex','Russia','2021-09-30 13:29:59','2021-09-30 13:30:11'),
(4,'Alex','Russia','2021-09-30 13:31:17','2021-09-30 13:39:46'),
(5,'Alex','dfd','2021-09-30 13:34:26','2021-09-30 13:38:02'),
(6,'dfd','Russia','2021-09-30 13:34:41','2021-09-30 13:38:12'),
(7,'Alex','Russia','2021-09-30 13:37:23','2021-09-30 13:38:15'),
(8,'Alexd','fdfdf','2021-09-30 13:37:54','2021-09-30 13:38:05'),
(9,'Alex','Russia','2021-09-30 13:42:23','2021-09-30 13:42:27'),
(10,'Alex','dfd','2021-09-30 13:43:10','2021-09-30 13:43:13'),
(11,'ui','uiu','2021-09-30 13:45:09','2021-09-30 13:45:12'),
(12,'Alex','Russia','2021-09-30 14:05:46','2021-09-30 19:58:05'),
(13,'Nikita','Russia','2021-09-30 14:05:53','2021-09-30 20:45:38'),
(14,'Alex','Russia','2021-09-30 20:45:47','2021-09-30 20:57:23'),
(15,'dfd','fdfdf','2021-09-30 20:58:18','2021-09-30 21:05:05'),
(16,'dfd','ere','2021-09-30 21:05:18','2021-09-30 21:05:23'),
(17,'dfdd','fdfdf','2021-09-30 21:05:44','2021-09-30 21:05:48'),
(18,'fd','ddffffffff','2021-09-30 21:07:29','2021-09-30 21:09:02'),
(19,'t','rt','2021-09-30 21:10:08','2021-09-30 21:10:15'),
(20,'fdfd','dfd','2021-09-30 21:11:55','2021-09-30 21:12:01'),
(21,'Alex','dfddddddd','2021-09-30 21:12:49','2021-09-30 21:15:32'),
(22,'Alex','Russia','2021-09-30 21:13:58','2021-09-30 21:14:04'),
(23,'Alex','dfdddddddd','2021-09-30 21:15:41','2021-09-30 21:18:30'),
(24,'dfdfddddddddddddddd','dddddddddddddddd','2021-09-30 21:15:49','2021-09-30 21:18:07'),
(25,'tyt','y','2021-09-30 21:18:38','2021-09-30 21:20:03'),
(26,'Alex','dfd','2021-09-30 21:21:09','2021-09-30 21:22:29'),
(27,'Alex','Russia','2021-09-30 21:24:49','2021-09-30 21:26:22'),
(28,'Alex','Russia','2021-09-30 21:25:12','2021-09-30 22:07:18'),
(29,'Alex','dfd','2021-09-30 21:25:48','2021-09-30 21:27:03'),
(30,'fdfd','d','2021-09-30 22:13:28','2021-09-30 22:13:44'),
(31,'dfdfdd','dfd','2021-09-30 22:13:40','2021-09-30 22:13:48'),
(32,'Alex','Russia','2021-10-01 10:09:46',NULL),
(33,'Nikita','Russia','2021-10-01 10:09:55','2021-10-01 16:43:47'),
(34,'Slavar','Russia','2021-10-01 10:10:07',NULL);

/*Table structure for table `bids` */

DROP TABLE IF EXISTS `bids`;

CREATE TABLE `bids` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `job_name` varchar(255) DEFAULT NULL,
  `applied_budget` float DEFAULT NULL,
  `final_budget` float DEFAULT NULL,
  `status` int(5) DEFAULT 1,
  `bid_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `bids` */

insert  into `bids`(`id`,`fullname`,`account_name`,`client_name`,`job_name`,`applied_budget`,`final_budget`,`status`,`bid_date`,`start_date`,`end_date`,`created_at`) values 
(15,'RyuHyonBom','Nikita','dfdfd','dfdfdfdf',12,0,3,'2021-09-30','2021-09-30','2021-10-01','2021-09-30'),
(14,'KimJongYol','Alex','dfdfd','dfd',21,78,3,'2021-09-30','2021-09-30','2021-10-01','2021-09-30'),
(13,'KimJongYol','Nikita','dfdfd','dfd',1256,456,4,'2021-09-30','2021-09-30','2021-09-30','2021-09-30'),
(12,'KimJongYol','Alex','dfdfd','dfdfdfdf',121212,434343,3,'2021-09-30','2021-09-30','2021-09-30','2021-09-30'),
(11,'KimJongYol','Nikita','dfdfd','dfd',12,0,4,'2021-09-30','2021-09-30','2021-09-30','2021-09-30'),
(10,'KimJongYol','Nikita','dfdfd','dfdfdfdf',21,NULL,3,'2021-09-30','2021-09-30','2021-09-30','2021-09-30'),
(16,'KimJongYol','Alex','ddd','dfdsss',1212,1212120,4,'2021-10-01','2021-10-01','2021-10-01','2021-10-01'),
(17,'KimJongYol','Nikita','ddddddddddddddddd','dfd',12,121,4,'2021-10-01','2021-10-01','2021-10-02','2021-10-01'),
(18,'RyuHyonBom','Nikita','dfdfd','dgd',121,456,3,'2021-10-01','2021-10-01','2021-10-01','2021-10-01'),
(19,'RyuHyonBom','Alex','adsdasd','mern stack ',250,260,3,'2021-10-01','2021-10-01','2021-10-01','2021-10-01'),
(20,'KimJongYol','Alex','Anton','mean stack',320,456,4,'2021-10-02','2021-10-02','2021-10-02','2021-10-02'),
(21,'KimJongYol','Slavar','dfdfd','dfdfdfdf',12,232,3,'2021-10-02','2021-10-02','2021-10-02','2021-10-02');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `payments` */

insert  into `payments`(`id`,`name`,`address`,`created_at`,`deleted_at`) values 
(1,'paypal','45678978','2021-09-30','2021-09-30'),
(2,'paypal','45678978','2021-09-30','2021-09-30'),
(3,'ewe','45678978','2021-09-30','2021-09-30'),
(4,'dfd','df','2021-09-30','2021-09-30'),
(5,'fdfd','45678978','2021-09-30','2021-09-30'),
(6,'fdfd','45678978','2021-09-30','2021-10-01'),
(7,'dfd','34343','2021-09-30','2021-09-30'),
(8,'paypal','45678978','2021-10-01',NULL);

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `pay_method` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `job_name` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`fullname`,`pay_method`,`amount`,`pay_date`,`job_name`,`client_name`) values 
(1,'KimJongYol','1',10,'2021-10-01','',''),
(2,'KimJongYol','',20,'2021-10-01','dfd','2'),
(3,'KimJongYol','2',30,'2021-09-10','dfd','dfdfd'),
(4,'KimJongYol','2',40,'2021-07-15','dfd','dfdfd'),
(5,'RyuHyonBom','paypal(45678978)',10,'2021-09-23','dgd','dfdfd'),
(6,'RyuHyonBom','paypal(45678978)',120,'2021-09-14','gdgd','tete');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `active` int(5) NOT NULL DEFAULT 1,
  `role` int(2) DEFAULT 200,
  `created_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`uid`,`username`,`fullname`,`birthday`,`password`,`active`,`role`,`created_at`,`deleted_at`) values 
(1,'admin','admin','2021-09-30','e35cf7b66449df565f93c607d5a81d09',1,100,'2021-09-29','2021-09-29'),
(19,'rhb','RyuHyonBom','1998-10-02','e10adc3949ba59abbe56e057f20f883e',1,200,'2021-09-29',NULL),
(26,'ok','KimJongYol','2021-09-09','d41d8cd98f00b204e9800998ecf8427e',1,200,'2021-09-29',NULL),
(102,'hnj','HamNamJin','2021-09-07','e10adc3949ba59abbe56e057f20f883e',2,200,'2021-09-30',NULL),
(103,'ogs','OGumSong','2021-09-08','e10adc3949ba59abbe56e057f20f883e',1,200,'2021-09-30',NULL),
(104,'dfdfd','dfdfd','2021-09-01','b52c96bea30646abf8170f333bbd42b9',2,200,'2021-09-30',NULL),
(105,'erdfd','dfdfdfdfdfdfd','2021-09-08','e10adc3949ba59abbe56e057f20f883e',2,200,'2021-09-30',NULL),
(106,'dfdfd','dfdfdfdfdfdfd','2021-09-09','e10adc3949ba59abbe56e057f20f883e',2,200,'2021-09-30',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
