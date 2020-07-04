/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.8-MariaDB : Database - checkin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`checkin` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `checkin`;

/*Table structure for table `attendanceevent` */

DROP TABLE IF EXISTS `attendanceevent`;

CREATE TABLE `attendanceevent` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` enum('checkin','checkout') DEFAULT NULL,
  `guestId` int(10) DEFAULT NULL,
  `eventId` int(10) DEFAULT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `usertype` enum('guest','user') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `attendanceevent` */

/*Table structure for table `event` */

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `startTimeStamp` varchar(30) DEFAULT NULL,
  `endTimeStamp` varchar(30) DEFAULT NULL,
  `theme` varchar(100) DEFAULT NULL,
  `listMaxCapacity` int(10) DEFAULT NULL,
  `plusOnes` int(10) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `listOpenTime` varchar(100) DEFAULT NULL,
  `listCloseTime` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `event` */

/*Table structure for table `eventlocation` */

DROP TABLE IF EXISTS `eventlocation`;

CREATE TABLE `eventlocation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locationId` int(10) DEFAULT NULL,
  `eventId` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `eventlocation` */

/*Table structure for table `guest` */

DROP TABLE IF EXISTS `guest`;

CREATE TABLE `guest` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `birthday` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `column` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `guest` */

/*Table structure for table `invitedguest` */

DROP TABLE IF EXISTS `invitedguest`;

CREATE TABLE `invitedguest` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `notes` varchar(500) DEFAULT NULL,
  `type` enum('guest','plusone') DEFAULT NULL,
  `guestId` int(10) DEFAULT NULL,
  `eventId` int(10) DEFAULT NULL,
  `invited_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

/*Data for the table `invitedguest` */

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `location` */

insert  into `location`(`id`,`name`,`lat`,`lon`) values 
(1,'AAA','123','234'),
(3,'BBB','1','2'),
(4,'CCC','5','3'),
(5,'DDD','7','6');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1);

/*Table structure for table `organization` */

DROP TABLE IF EXISTS `organization`;

CREATE TABLE `organization` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `organization` */

insert  into `organization`(`id`,`name`,`notes`) values 
(1,'DDD','1234'),
(2,'ss','aa'),
(3,'BB','BBSS'),
(4,'CC','CCDD');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values 
('hungjiuchong0314@outlook.com','$2y$10$UEkULsJD764h2wXD7SaB4ehQj8dRY85z6i.Kono9mQbOZGqvDL2m6','2019-12-06 04:16:29');

/*Table structure for table `plusonelists` */

DROP TABLE IF EXISTS `plusonelists`;

CREATE TABLE `plusonelists` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `birthday` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `plusonelists` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `birthday` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` enum('activate','deactivate') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'deactivate',
  `notes` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizationID` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','DoorWorker','EventManager','SystemManager') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`,`birthday`,`state`,`notes`,`organizationID`,`role`) values 
(1,'Admin','hungjiuchong0314@outlook.com','$2y$10$jtZEGAhrUgtNes1A7VVesuf.47EBnvRwfGYztCi0zqwqeQundQGvu','QFqH8SLFFF7YVW1FUXrPf0yU7x9v0rpL7pK1HhN8Hfh0Y1SSO3yjYmvHAuUf','2019-12-06 02:50:07','2019-12-06 02:50:07','1111.1.1','activate',NULL,'3','SystemManager'),
(4,'temp','temp@temp.com','$2y$10$MQ3tUvT/TKXz5THFj/G4vuz6NIqkuwWvqv/FqWMjjsiZtqJPbVWgC','zO9K8xuUj2owOrpOspiWVpKgIJGlCjP5l8h8R3xQBb2UaNaCn39ENMKhroFf','2019-12-07 20:08:46','2019-12-07 20:08:46','1999.2.13','deactivate','asd','4','user'),
(5,'EventManager','event@event.com','$2y$10$LHBwDdUzsrun6O9E.c/Lw.CJOLoC/oOGtwTyLN/ksbfCCMsGjCHoy','tGPvhQFXTh7yXv1wBLn9as2iZbIxeNhCZLyot4SD3hI8pHZUXdke1GBqWQSE','2019-12-07 20:36:43','2019-12-07 20:36:43','1234.23.12','deactivate','zxcv','3','EventManager'),
(6,'DoorWorker','doorworker@doorworker.com','$2y$10$Y53Dvg83vNrAf1gVXTTmmOdWrUN9mL3V6qUijVnata5wSgufTVuDa','rDzL9yQM9T1wu6HN3cJJmggNZjFVjfXRvOpJY2XctI0rHHXgAsz5PlmkcpL3','2019-12-07 20:37:14','2019-12-07 20:37:14','2341.23.12','activate','AAas','1','DoorWorker'),
(7,'test','test@test.com','$2y$10$5X8gtj5LSgixVRuB9H2vxOugZZE4OiRcXUMHRL9YuLGf6eghb2Hiq','8r1pGxM5TMINPLXnz4qlfmxhQriWdBjXQro4bPQyyl32mBiqkDJrCXobOGy5','2019-12-09 19:35:05','2019-12-09 19:35:05','2019/2/1','deactivate',NULL,'2','user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
