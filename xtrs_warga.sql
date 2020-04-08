/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 10.3.16-MariaDB : Database - xtrs_warga
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`xtrs_warga` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `xtrs_warga`;

/*Table structure for table `application_access` */

DROP TABLE IF EXISTS `application_access`;

CREATE TABLE `application_access` (
  `access_id` char(5) NOT NULL,
  `access_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `application_users` */

DROP TABLE IF EXISTS `application_users`;

CREATE TABLE `application_users` (
  `user_id` char(25) NOT NULL,
  `username` char(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `access_id` char(5) NOT NULL,
  `password` varchar(64) NOT NULL,
  `account_status` enum('active','non-active') NOT NULL,
  `login_status` enum('on','off') NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `unique_email` (`email`),
  KEY `access_id` (`access_id`),
  CONSTRAINT `application_users_ibfk_1` FOREIGN KEY (`access_id`) REFERENCES `application_access` (`access_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_api_keys` */

DROP TABLE IF EXISTS `tbl_api_keys`;

CREATE TABLE `tbl_api_keys` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status_keys` enum('off','on') NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `api_key` (`api_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2978399982969289930 DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_detail_kelurahan` */

DROP TABLE IF EXISTS `tbl_detail_kelurahan`;

CREATE TABLE `tbl_detail_kelurahan` (
  `user_id` char(20) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `nm_kades` varchar(80) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status_access` enum('active','non-active') NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `telepon` (`telepon`),
  KEY `id_kelurahan` (`id_kelurahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_information` */

DROP TABLE IF EXISTS `tbl_information`;

CREATE TABLE `tbl_information` (
  `inf_code` char(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(80) NOT NULL,
  `target_to` varchar(100) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` varchar(80) NOT NULL,
  `expire_time` date NOT NULL,
  `status` enum('active','non-active') NOT NULL,
  PRIMARY KEY (`inf_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_kabupaten` */

DROP TABLE IF EXISTS `tbl_kabupaten`;

CREATE TABLE `tbl_kabupaten` (
  `id_kabupaten` int(11) NOT NULL AUTO_INCREMENT,
  `id_propinsi` int(11) NOT NULL,
  `nm_kabupaten` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kabupaten`),
  KEY `id_propinsi` (`id_propinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_kecamatan` */

DROP TABLE IF EXISTS `tbl_kecamatan`;

CREATE TABLE `tbl_kecamatan` (
  `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kabupaten` int(11) NOT NULL,
  `nm_kecamatan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kecamatan`),
  KEY `id_kabupaten` (`id_kabupaten`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_kelurahan` */

DROP TABLE IF EXISTS `tbl_kelurahan`;

CREATE TABLE `tbl_kelurahan` (
  `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int(11) NOT NULL,
  `nm_kelurahan` varchar(100) NOT NULL,
  `kd_pos` char(8) NOT NULL,
  `sites` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kelurahan`),
  KEY `id_kecamatan` (`id_kecamatan`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_propinsi` */

DROP TABLE IF EXISTS `tbl_propinsi`;

CREATE TABLE `tbl_propinsi` (
  `id_propinsi` int(11) NOT NULL AUTO_INCREMENT,
  `nm_propinsi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_propinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
