# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.60)
# Database: web_db
# Generation Time: 2018-07-19 10:45:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'Hồ Chí Minh','2018-07-10 19:00:07','2018-07-10 19:00:07');

/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table clinic_shifts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clinic_shifts`;

CREATE TABLE `clinic_shifts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clinic_id` int(10) unsigned NOT NULL,
  `start_shift` timestamp NULL DEFAULT NULL,
  `end_shift` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clinic_shifts_clinic_id_foreign` (`clinic_id`),
  CONSTRAINT `clinic_shifts_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `clinic_shifts` WRITE;
/*!40000 ALTER TABLE `clinic_shifts` DISABLE KEYS */;

INSERT INTO `clinic_shifts` (`id`, `name`, `clinic_id`, `start_shift`, `end_shift`, `active`, `created_at`, `updated_at`)
VALUES
	(1,'Ca 1',1,'2018-07-11 01:30:00','2018-07-11 01:45:00',1,'2018-07-11 02:00:00','2018-07-11 01:29:45'),
	(2,NULL,1,'2018-07-14 00:20:00','2018-07-14 01:50:00',1,'2018-07-14 14:58:16','2018-07-14 14:58:16');

/*!40000 ALTER TABLE `clinic_shifts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table clinic_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clinic_types`;

CREATE TABLE `clinic_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `clinic_types` WRITE;
/*!40000 ALTER TABLE `clinic_types` DISABLE KEYS */;

INSERT INTO `clinic_types` (`id`, `name`, `active`, `created_at`, `updated_at`)
VALUES
	(1,'Nha khoa',1,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(2,'Khoa nhi',1,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(3,'Răng Hàm Mặt',1,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(4,'Khoa mắt',1,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(5,'Tai - Mũi - Họng',1,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(6,'Tim mạch',1,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(7,'Nội tiết',1,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(8,'Xương khớp',1,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(9,'Tâm lý',1,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(10,'Vật lý trị liệu',1,'2018-07-10 18:54:18','2018-07-10 18:54:18');

/*!40000 ALTER TABLE `clinic_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table clinics
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clinics`;

CREATE TABLE `clinics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double(10,7) NOT NULL,
  `longitude` double(10,7) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `user_created` int(10) unsigned NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `ward_id` int(10) unsigned DEFAULT NULL,
  `district_id` int(10) unsigned DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clinics_ward_id_foreign` (`ward_id`),
  KEY `clinics_district_id_foreign` (`district_id`),
  KEY `clinics_user_created_foreign` (`user_created`),
  KEY `clinics_type_foreign` (`type`),
  CONSTRAINT `clinics_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `clinics_type_foreign` FOREIGN KEY (`type`) REFERENCES `clinic_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `clinics_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `clinics_ward_id_foreign` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `clinics` WRITE;
/*!40000 ALTER TABLE `clinics` DISABLE KEYS */;

INSERT INTO `clinics` (`id`, `name`, `latitude`, `longitude`, `address`, `type`, `user_created`, `description`, `ward_id`, `district_id`, `confirmed`, `active`, `end_date`, `created_at`, `updated_at`)
VALUES
	(1,'Phòng Khám Đa Khoa Việt An Organic',10.7673606,106.6837990,'201 Nguyễn Thị Minh Khai, Phường Nguyễn Cư Trinh, Quận 1, Hồ Chí Minh, Vietnam',1,1,'+84 8 3925 2777 ‎ · vietanorganic.com',7,1,1,1,'2018-08-10 18:30:50','2018-07-11 00:51:40','2018-07-11 00:51:40'),
	(2,'Phòng Khám Đa Khoa Thành Công',10.8189692,106.6255760,'36 ĐƯỜNG CN 4, Phường 15, Tân Phú, Hồ Chí Minh, Vietnam',1,1,'+84 8 3815 9435 ‎ · thanhcongclinic.com',236,17,0,1,'2018-08-10 18:30:50','2018-07-11 00:51:40','2018-07-11 00:51:40'),
	(3,'Phòng Khám Đa Khoa Vĩnh Đức',10.8080462,106.6190958,'363 Lê Trọng Tấn, Sơn Ký, Tân Phú, Hồ Chí Minh, Vietnam',2,1,'<p>+84 168 823 2928 ‎ · vinhduc.net.vn</p>',242,18,1,0,'2018-08-10 16:36:55','2018-07-11 00:51:40','2018-07-13 16:36:55'),
	(4,'Phòng Khám Đa Khoa Phước An',10.7736153,106.6685624,'473 Sư Vạn Hạnh, Phường 12, Quận 10, Hồ Chí Minh, Vietnam',4,2,'+84 8 3862 5490 ‎ · trungtamphuocan.vn',130,10,1,1,'2018-08-10 18:30:50','2018-07-11 00:51:40','2018-07-11 01:54:36'),
	(5,'Phòng Khám Đa Khoa Việt Gia',10.7877639,106.6968544,'166 Đường Nguyễn Văn Thủ, Đa Kao, Quận 1, Hồ Chí Minh, Vietnam',3,1,'+84 8 3911 8485 ‎ · vietgiaclinic.com',6,1,1,1,'2018-08-10 18:30:50','2018-07-11 00:51:40','2018-07-11 01:54:55'),
	(6,'Phòng Khám Đa Khoa Khu Công Nghiệp Tân Bình',10.8134388,106.6328945,'Lê Trọng Tấn, Tây Thạnh, Tân Phú, TP Hồ Chí Minh‎',7,3,'+84 8 5435 6715 ‎',247,18,1,1,'2018-08-10 18:30:50','2018-07-11 00:51:40','2018-07-11 01:54:42'),
	(7,'PHÒNG KHÁM ĐA KHOA MỸ TÙNG',10.7579677,106.6782074,'P3, 142 Lê Hồng Phong, phường 3, Quận 5, Hồ Chí Minh, Vietnam',4,5,'+84 8 3924 0888 ‎ · pkmytung.com',53,5,0,1,'2018-08-10 18:30:50','2018-07-11 00:51:40','2018-07-11 00:51:40'),
	(8,'Thu Nghiem 1',10.7887370,106.6751680,'429/17C Đường Lê Văn Sỹ, Phường 12, Quận 3, Hồ Chí Minh',1,1,NULL,33,3,0,1,'2018-08-10 09:48:31','2018-07-11 09:48:31','2018-07-11 09:49:23');

/*!40000 ALTER TABLE `clinics` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table districts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `districts`;

CREATE TABLE `districts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `districts_city_id_foreign` (`city_id`),
  CONSTRAINT `districts_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;

INSERT INTO `districts` (`id`, `city_id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,1,'Quận 1','2018-07-10 19:00:07','2018-07-10 19:00:07'),
	(2,1,'Quận 2','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(3,1,'Quận 3','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(4,1,'Quận 4','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(5,1,'Quận 5','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(6,1,'Quận 6','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(7,1,'Quận 7','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(8,1,'Quận 8','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(9,1,'Quận 9','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(10,1,'Quận 10','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(11,1,'Quận 11','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(12,1,'Quận 12','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(13,1,'Quận Bình Tân','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(14,1,'Quận Bình Thạnh','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(15,1,'Quận Gò Vấp','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(16,1,'Quận Phú Nhuận','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(17,1,'Quận Tân Bình','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(18,1,'Quận Tân Phú','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(19,1,'Quận Thủ Đức','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(20,1,'Huyện Bình Chánh','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(21,1,'Huyện Cần Giờ','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(22,1,'Huyện Củ Chi','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(23,1,'Huyện Hóc Môn','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(24,1,'Huyện Nhà Bè','2018-07-10 19:00:16','2018-07-10 19:00:16');

/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table doctors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `doctors`;

CREATE TABLE `doctors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `title` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctors_clinic_id_foreign` (`clinic_id`),
  CONSTRAINT `doctors_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_100000_create_password_resets_table',1),
	(2,'2018_04_10_152245_create_cities_table',1),
	(3,'2018_04_10_152257_create_districts_table',1),
	(4,'2018_04_10_152303_create_wards_table',1),
	(5,'2018_04_15_042219_create_roles_and_permissions_table',1),
	(6,'2018_04_15_050000_create_users_table',1),
	(7,'2018_04_15_083922_create_report_types_table',1),
	(8,'2018_04_15_084129_create_reports_table',1),
	(9,'2018_06_11_080011_create_clinic_types_table',1),
	(10,'2018_06_11_080032_create_clinics_table',1),
	(11,'2018_06_11_081552_create_clinic_shifts_table',1),
	(12,'2018_06_21_152046_create_shift_user_table',1),
	(13,'2018_06_23_192122_create_doctors_table',1),
	(14,'2018_06_30_104958_create_settings_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;

INSERT INTO `permission_role` (`role_id`, `permission_id`)
VALUES
	(1,1),
	(1,2),
	(1,3),
	(1,4);

/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `title`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'Admin Control','admin-control','2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(2,'Report Control','report-control','2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(3,'Clinic Control','clinic-control','2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(4,'User Control','user-control','2018-07-10 18:54:18','2018-07-10 18:54:18');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table report_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `report_types`;

CREATE TABLE `report_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_icon` text COLLATE utf8_unicode_ci,
  `unconfirmed_icon` text COLLATE utf8_unicode_ci,
  `menu_icon` text COLLATE utf8_unicode_ci,
  `alive` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `report_types` WRITE;
/*!40000 ALTER TABLE `report_types` DISABLE KEYS */;

INSERT INTO `report_types` (`id`, `name`, `confirmed_icon`, `unconfirmed_icon`, `menu_icon`, `alive`, `active`, `created_at`, `updated_at`)
VALUES
	(1,'Kẹt xe','https://deltavn.net/upload/icon/jam_confirmed.png','https://deltavn.net/upload/icon/jam.png','https://deltavn.net/upload/icon/jam_menu.png',3600,1,'2018-07-10 18:54:18','2018-07-11 09:03:40'),
	(2,'Ngập nước','https://deltavn.net/upload/icon/flood_confirmed.png','https://deltavn.net/upload/icon/flood.png','https://deltavn.net/upload/icon/flood_menu.png',7200,1,'2018-07-10 18:54:18','2018-07-11 09:02:54'),
	(3,'Tai nạn giao thông','https://deltavn.net/upload/icon/accident_confirmed.png','https://deltavn.net/upload/icon/accident.png','https://deltavn.net/upload/icon/accident_menu.png',7200,1,'2018-07-10 18:54:18','2018-07-11 09:01:59'),
	(4,'Hư hỏng - Sửa chửa','https://deltavn.net/upload/icon/accident_confirmed.png','https://deltavn.net/upload/icon/accident.png','https://deltavn.net/upload/icon/accident_menu.png',0,1,'2018-07-10 18:54:18','2018-07-11 09:04:37');

/*!40000 ALTER TABLE `report_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `latitude` double(10,7) NOT NULL,
  `longitude` double(10,7) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `user_created` int(10) unsigned DEFAULT NULL,
  `ward_id` int(10) unsigned DEFAULT NULL,
  `district_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reports_ward_id_foreign` (`ward_id`),
  KEY `reports_district_id_foreign` (`district_id`),
  KEY `reports_user_created_foreign` (`user_created`),
  KEY `reports_type_id_foreign` (`type_id`),
  CONSTRAINT `reports_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reports_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `report_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reports_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reports_ward_id_foreign` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;

INSERT INTO `reports` (`id`, `latitude`, `longitude`, `comment`, `type_id`, `user_created`, `ward_id`, `district_id`, `active`, `confirm`, `image`, `created_at`, `updated_at`)
VALUES
	(1,10.8145150,106.6416917,NULL,1,NULL,48,17,1,0,NULL,'2018-07-11 01:06:38','2018-07-11 01:06:38'),
	(2,10.8273583,106.6833633,NULL,4,NULL,28,15,1,0,NULL,'2018-07-11 01:07:08','2018-07-11 01:07:08'),
	(3,10.7830300,106.6748267,NULL,1,NULL,31,3,1,0,NULL,'2018-07-11 01:07:35','2018-07-11 01:07:35'),
	(4,10.7637483,106.6234883,NULL,3,NULL,1,18,1,1,NULL,'2018-07-11 01:19:58','2018-07-18 21:00:20'),
	(5,10.7855883,106.6349550,NULL,2,NULL,240,18,1,0,NULL,'2018-07-11 01:20:17','2018-07-11 01:20:17'),
	(6,10.7681450,106.6358400,NULL,1,NULL,246,18,1,0,NULL,'2018-07-11 01:20:36','2018-07-11 01:20:36'),
	(7,10.7930333,106.6188417,NULL,2,NULL,87,18,1,0,NULL,'2018-07-11 01:20:57','2018-07-11 01:20:57'),
	(8,10.8168883,106.6268917,NULL,3,NULL,48,18,1,0,NULL,'2018-07-11 01:21:16','2018-07-11 01:21:16'),
	(9,10.8363083,106.6500017,NULL,4,NULL,29,15,1,0,NULL,'2018-07-11 01:21:55','2018-07-11 09:46:18'),
	(10,10.8263750,106.6641450,NULL,3,NULL,49,15,1,0,NULL,'2018-07-11 01:23:14','2018-07-11 01:23:14'),
	(11,10.8263750,106.6641450,NULL,4,NULL,49,15,1,0,NULL,'2018-07-11 01:23:28','2018-07-11 01:23:28'),
	(12,10.8177917,106.6645567,NULL,2,NULL,23,17,1,0,NULL,'2018-07-11 01:23:45','2018-07-11 01:23:45'),
	(13,10.7882917,106.6772983,NULL,1,NULL,35,3,1,0,NULL,'2018-07-11 01:24:07','2018-07-11 10:03:22'),
	(14,10.7832817,106.6664267,NULL,4,NULL,48,10,1,0,NULL,'2018-07-11 01:25:38','2018-07-11 01:25:38'),
	(15,10.7832817,106.6664267,NULL,2,NULL,48,10,1,0,NULL,'2018-07-11 01:25:55','2018-07-11 01:25:55'),
	(16,10.7885617,106.6545100,NULL,1,NULL,28,17,1,0,NULL,'2018-07-11 01:26:12','2018-07-11 01:26:12'),
	(17,10.7885617,106.6545100,NULL,3,NULL,28,17,1,0,NULL,'2018-07-11 01:26:58','2018-07-11 01:26:58'),
	(18,10.7854250,106.6467283,NULL,2,NULL,31,17,1,0,NULL,'2018-07-11 01:29:23','2018-07-11 01:29:23'),
	(19,10.8008417,106.6375950,NULL,2,NULL,34,17,1,0,NULL,'2018-07-11 01:29:47','2018-07-11 01:29:47'),
	(20,10.8008417,106.6375950,NULL,3,NULL,34,17,1,0,NULL,'2018-07-11 01:30:02','2018-07-11 01:30:02'),
	(21,10.8135433,106.6445850,NULL,4,NULL,48,17,1,0,NULL,'2018-07-11 01:30:22','2018-07-11 01:30:22'),
	(22,10.8289167,106.6542967,NULL,3,NULL,48,17,1,0,NULL,'2018-07-11 01:30:47','2018-07-11 01:30:47'),
	(23,10.8409800,106.6557683,NULL,2,NULL,29,15,1,1,NULL,'2018-07-11 01:31:17','2018-07-11 01:31:17'),
	(24,10.8347817,106.6466133,NULL,2,NULL,48,17,1,0,NULL,'2018-07-11 01:32:17','2018-07-11 01:32:17'),
	(25,10.8347817,106.6466133,NULL,3,NULL,48,17,1,0,NULL,'2018-07-11 01:32:28','2018-07-11 01:32:28'),
	(26,10.8225017,106.6563183,NULL,3,NULL,48,17,1,0,NULL,'2018-07-11 01:32:41','2018-07-11 01:32:41'),
	(27,10.8105233,106.6786717,NULL,2,NULL,25,16,1,0,NULL,'2018-07-11 01:33:07','2018-07-11 01:33:07'),
	(28,10.7590217,106.6972883,NULL,2,NULL,26,4,1,1,NULL,'2018-07-11 01:36:49','2018-07-11 07:52:35'),
	(29,10.7500567,106.6322933,NULL,2,NULL,33,6,1,0,NULL,'2018-07-11 01:37:13','2018-07-11 08:18:46'),
	(30,10.7559417,106.6603700,NULL,2,NULL,33,5,1,0,NULL,'2018-07-11 01:37:30','2018-07-11 01:37:30'),
	(31,10.7599933,106.6690667,NULL,4,NULL,24,10,1,0,NULL,'2018-07-11 01:37:49','2018-07-11 01:37:49'),
	(32,10.7637300,106.6635433,NULL,3,NULL,27,10,1,0,NULL,'2018-07-11 01:38:19','2018-07-11 01:38:19'),
	(33,10.7654100,106.6846617,NULL,2,NULL,7,1,1,1,NULL,'2018-07-11 01:39:33','2018-07-11 08:14:58'),
	(34,10.7906917,106.6718283,NULL,1,NULL,34,16,1,0,NULL,'2018-07-14 16:58:58','2018-07-14 16:58:58');

/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`)
VALUES
	(1,'Quản trị viên','2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(2,'Kiểm duyệt báo cáo','2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(3,'Bác sĩ','2018-07-10 18:54:18','2018-07-10 18:54:18');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_unique` (`name`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `name`, `key`, `value`, `created_at`, `updated_at`)
VALUES
	(1,'Số ngày đăng ký phòng khám','default_clinic_expire','30','2018-07-10 18:58:41','2018-07-10 18:58:41');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shift_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shift_user`;

CREATE TABLE `shift_user` (
  `shift_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`shift_id`,`user_id`),
  KEY `shift_user_user_id_foreign` (`user_id`),
  CONSTRAINT `shift_user_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `clinic_shifts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `shift_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `shift_user` WRITE;
/*!40000 ALTER TABLE `shift_user` DISABLE KEYS */;

INSERT INTO `shift_user` (`shift_id`, `user_id`, `confirmed`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'2018-07-11 01:30:22','2018-07-11 01:30:22');

/*!40000 ALTER TABLE `shift_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `role_id`, `address`, `phone`, `active`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'administrator','admin@example.com','admin','$2y$10$wNFCwH9.1S5y/FhQoY81JuDqgXHgEMk7hmTLxygWTVpLiwQwgpXBG',1,NULL,NULL,1,NULL,'2018-07-10 18:54:18','2018-07-10 18:54:18'),
	(2,'Pham Ngoc Nghia','phmngocnghia@outlook.com','phmngocnghia','$2y$10$LBh5Y1DsnaQZ6LMWTSAChOHNhWmR/pzAukIJCGQBN7Cvdvo.qOx5q',NULL,'429/28 Le Van Sy Phuong 12 Quan 3 TP.HCM','0904983594',1,'CF5uPXtrCwzcnkrZPBB6n2GcK815ovemnYsFKuoNilSrQCTqQsiKhvBjGZtQ','2018-07-10 20:21:09','2018-07-10 20:35:00'),
	(3,'Chị. Bá Khúc Khuyên','dai.van@example.org','dnguyen','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'7 Phố Ninh','0241-749-5473',1,'x57KEoCnky','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(4,'Anh. Tô Duy Độ','ngan62@example.org','don.vien','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'4 Phố Uông','062 632 5225',1,'zlHSBtbLJI','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(5,'Bác. Diêm Hữu','gdong@example.org','thuy02','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'2 Phố Dao','091 457 6002',1,'kE0kdjr445','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(6,'Bình Từ','phuong.vy@example.com','ong.sa','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'34 Phố Khương Như Phong','84-30-146-6320',1,'9l7iZEL4vB','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(7,'Ngô Kiến Công','toan.than@example.net','vu91','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'8 Phố Sinh','(84)(167)614-3741',1,'wYanBcCk2W','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(8,'Ông. Châu Hải','ngon31@example.net','ktrac','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'4 Phố Diêm Hiền Thy','04 2109 1430',1,'uFeffupgYL','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(9,'Chử Cam Huệ','cung.sang@example.net','vu.tien','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'048 Phố Thủy','0166 401 8024',1,'HAS2zPcOKz','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(10,'Trịnh Huy Cảnh','vi.ai@example.net','nhan00','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'5646 Phố Ty','026-965-6053',0,'WCSC0pWSk2','2018-07-11 01:37:12','2018-07-11 01:40:07'),
	(11,'Bác. Tạ Từ Lợi','tram90@example.org','mkha','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'7 Phố Thạch','+84-52-689-3052',1,'XulkEKGdtc','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(12,'Xa Trường','canh.trinh@example.org','quyet58','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'93 Phố Hán Sang Hiếu','0123-160-6458',1,'l922H9HemJ','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(13,'Em. Chử Mai Khôi','vi.thuc@example.net','quy13','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'4864 Phố Nhâm Phụng Ngôn','(026)780-3611',1,'RM8HbZBOY9','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(14,'Vừ Thảo','cu.linh@example.com','vinh48','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'9 Phố Tào Miên Vũ','(84)(73)320-5414',1,'8dyvPK9URU','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(15,'Danh Hiểu Long','chu.dao@example.net','dung77','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'68 Phố Âu Trí Hảo','84-70-780-9120',0,'vTHguiLmIQ','2018-07-11 01:37:12','2018-07-11 01:40:16'),
	(16,'Bà. Giả Ty','xphung@example.net','kkhuu','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'322 Phố Lực','(099) 466 2044',1,'QRBnIODq2s','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(17,'Tô Dân Tiển','ca.dan@example.org','phuoc.chung','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'646 Phố Thoại','(84)(52)598-1464',1,'Gq34zf9II3','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(18,'Quản Hoài Quyên','ita@example.com','trinh.phan','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'9909 Phố Giang Thường Lộ','84-63-456-9529',1,'5nfitSsXkS','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(19,'Em. Cấn Lâm Toản','tin05@example.org','vien.mai','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'6 Phố Doãn Hoàn Trân','0122-650-0895',1,'okoR3ZHMEw','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(20,'Thịnh Kiên','do63@example.net','gdanh','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'6572 Phố Hồ','84-500-467-6805',1,'TOKxJiBJmr','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(21,'Cổ Điệp','phuoc50@example.com','ma.vy','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'99 Phố Cổ Khuyên Nam','(84)(38)294-8260',1,'uH6ywHvAQL','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(22,'Chú. Ánh Định Sâm','thuy.la@example.com','gquach','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'567 Phố Cao Phước Cơ','(057)126-3544',1,'Sj8g5KcDUV','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(23,'Thịnh Linh Như','man.cuong@example.net','bthao','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'0 Phố Tôn','(0124)534-3701',1,'4qcOYwKutx','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(24,'Cô. Bế Hiếu','wnham@example.org','truong.di','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'9523 Phố Phi','(0162)670-1326',1,'10AvkNOXus','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(25,'Trang Vy San','kieu.ung@example.com','nhi68','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'3364 Phố Điền Hùng Lộc','(061)059-4943',1,'PdyyBYsDAT','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(26,'Cụ. Kiều Hà Thành','nho@example.com','mau.nam','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'38 Phố Thái Hà Bảo','(84)(25)519-4857',1,'fhcvnuxbyj','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(27,'Cấn Phúc Đăng','klieu@example.com','chung.bi','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'144 Phố Đồng Vy Nguyên','0168-457-0015',1,'f1lTRqCvr9','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(28,'Bác. Ánh Dương Nhuận','luc13@example.org','fkim','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'3452 Phố Lữ Miên Du','+84-350-041-4348',1,'r8IZkWXhgh','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(29,'Đan Đồng Nghị','oanh.tran@example.com','khuong.khoi','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'2 Phố Trịnh Hân Pháp','(033) 443 6339',1,'HL4C0JQaVh','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(30,'Chị. Cầm Đông Ái','tru.trung@example.com','yen78','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'124 Phố Chung Sa Thuận','84-64-962-5141',1,'izuthsrERA','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(31,'Tông Khiếu','anh.khuong@example.com','kien45','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'410 Phố Sử Quân Hạ','(067)291-5914',1,'aHbyfzK0SZ','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(32,'Sơn Chung Tiền','lan.an@example.net','thoa76','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'4 Phố Phùng Xuyến Lợi','(84)(31)106-6255',1,'sJAVI46caU','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(33,'Chiêm Việt','chuong.phung@example.com','fthan','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'3 Phố Hoàng Khải Ngọc','84-350-850-9748',1,'ZN4ZbV3hb7','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(34,'Bà. Đặng Duyên Trà','khuong11@example.com','fgiang','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'2 Phố Khâu Anh Phụng','(84)(240)620-1119',1,'sOIXVvylQH','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(35,'Uông Thương Hảo','uduong@example.net','gnham','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'3 Phố Viên Hồng Ân','84-90-873-7984',1,'47wU0Ouolu','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(36,'Anh. Lữ Bách Tú','thai.an@example.com','lleu','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'1548 Phố Bạch','0510-979-9516',1,'UKieLH6buL','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(37,'Chế Hưng','nhu.da@example.org','an.vu','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'353 Phố Thắng','094-636-6108',1,'VqrcBS1rFE','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(38,'Em. Thịnh Chuẩn Sâm','bi.due@example.org','trang.doan','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'1701 Phố Sơn Hậu Trân','84-52-106-5157',1,'BOjWNOrjRZ','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(39,'Chiêm Tài Đại','hieu08@example.net','mong','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'7758 Phố Ngô Nữ Loan','0240 075 3835',1,'imwpsOotfp','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(40,'Kha Huy','khuu.liem@example.org','jhy','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'555 Phố Kha Châu Cương','(095) 057 4208',1,'t7tLZvZvS6','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(41,'Bác. Đỗ Liễu','duy.don@example.org','ngan.chung','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'798 Phố Lỡ','84-63-270-0441',1,'4xUOZpum6N','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(42,'Cụ. Lục Diễm Anh','cchau@example.org','khoi.moc','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'00 Phố Đới','053 370 5059',1,'NvSzZmVQCg','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(43,'Chị. Ty Quế Quân','yhung@example.net','que83','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'299 Phố Cát','+84-162-359-5037',1,'GZgkwUnKM2','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(44,'Lỡ Bích Dinh','khieu00@example.com','hao80','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'27 Phố Tuệ','(0126)869-5030',1,'CsGGp3OLhe','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(45,'Chị. Cao Sao Khê','moc.trang@example.net','uong.dan','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'6982 Phố Hàn Chiêu Thy','84-93-765-3067',1,'nwwmyCdByP','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(46,'Khoa Vi','cong.hy@example.org','canh98','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'4140 Phố Trác Vỹ Chấn','027 102 1643',1,'0e6dmHMmil','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(47,'Chế Khắc Đạt','dieu76@example.org','tin.tang','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'23 Phố Khưu Giao Vỹ','(84)(39)395-8824',1,'pPBabKcU0J','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(48,'Bà. Tăng Thiên','tra.le@example.org','anh44','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'810 Phố Vi','0280 093 8586',1,'BYRBnKHpD0','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(49,'Em. Ninh Bằng Đình','nhat.giang@example.net','thuan12','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'6629 Phố Nguyễn Quảng Bửu','(027) 981 4273',1,'3KpzgQfukG','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(50,'Ông. Đới Khánh','yen46@example.net','thien75','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'35 Phố Thương','(075)645-4829',1,'7z157b5Fih','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(51,'Ngụy Đồng Hòa','huynh.tra@example.net','tkhu','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'918 Phố Cái Quý Bằng','058-855-0957',1,'PiYmLnugZQ','2018-07-11 01:37:12','2018-07-11 01:37:12'),
	(52,'Bác. Đổng Luật','ma.trieu@example.net','phoang','$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',NULL,'686 Phố Thái Ngà Nương','(84)(321)444-7662',1,'vRtHhGFsyN','2018-07-11 01:37:12','2018-07-11 01:37:12');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wards`;

CREATE TABLE `wards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wards_district_id_foreign` (`district_id`),
  CONSTRAINT `wards_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=323 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `wards` WRITE;
/*!40000 ALTER TABLE `wards` DISABLE KEYS */;

INSERT INTO `wards` (`id`, `district_id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,1,'Phường Bến Nghé','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(2,1,'Phường Bến Thành','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(3,1,'Phường Cầu Kho','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(4,1,'Phường Cầu Ông Lãnh','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(5,1,'Phường Cô Giang','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(6,1,'Phường Đa Kao','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(7,1,'Phường Nguyễn Cư Trinh','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(8,1,'Phường Nguyễn Thái Bình','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(9,1,'Phường Phạm Ngũ Lão','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(10,1,'Phường Tân Định','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(11,2,'Phường An Khánh','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(12,2,'Phường An Lợi Đông','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(13,2,'Phường An Phú','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(14,2,'Phường Bình An','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(15,2,'Phường Bình Khánh','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(16,2,'Phường Bình Trưng Đông','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(17,2,'Phường Bình Trưng Tây','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(18,2,'Phường Cát Lái','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(19,2,'Phường Thạnh Mỹ Lợi','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(20,2,'Phường Thảo Điền','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(21,2,'Phường Thủ Thiêm','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(22,3,'Phường 1','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(23,3,'Phường 2','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(24,3,'Phường 3','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(25,3,'Phường 4','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(26,3,'Phường 5','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(27,3,'Phường 6','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(28,3,'Phường 7','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(29,3,'Phường 8','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(30,3,'Phường 9','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(31,3,'Phường 10','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(32,3,'Phường 11','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(33,3,'Phường 12','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(34,3,'Phường 13','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(35,3,'Phường 14','2018-07-10 19:00:08','2018-07-10 19:00:08'),
	(36,4,'Phường 1','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(37,4,'Phường 2','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(38,4,'Phường 3','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(39,4,'Phường 4','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(40,4,'Phường 5','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(41,4,'Phường 6','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(42,4,'Phường 8','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(43,4,'Phường 9','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(44,4,'Phường 10','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(45,4,'Phường 12','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(46,4,'Phường 13','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(47,4,'Phường 14','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(48,4,'Phường 15','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(49,4,'Phường 16','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(50,4,'Phường 18','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(51,5,'Phường 1','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(52,5,'Phường 2','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(53,5,'Phường 3','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(54,5,'Phường 4','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(55,5,'Phường 5','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(56,5,'Phường 6','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(57,5,'Phường 7','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(58,5,'Phường 8','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(59,5,'Phường 9','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(60,5,'Phường 10','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(61,5,'Phường 11','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(62,5,'Phường 12','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(63,5,'Phường 13','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(64,5,'Phường 14','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(65,5,'Phường 15','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(66,6,'Phường 1','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(67,6,'Phường 2','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(68,6,'Phường 3','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(69,6,'Phường 4','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(70,6,'Phường 5','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(71,6,'Phường 6','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(72,6,'Phường 7','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(73,6,'Phường 8','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(74,6,'Phường 9','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(75,6,'Phường 10','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(76,6,'Phường 11','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(77,6,'Phường 12','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(78,6,'Phường 13','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(79,6,'Phường 14','2018-07-10 19:00:09','2018-07-10 19:00:09'),
	(80,7,'Phường Bình Thuận','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(81,7,'Phường Phú Mỹ','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(82,7,'Phường Phú Thuận','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(83,7,'Phường Tân Hưng','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(84,7,'Phường Tân Kiểng','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(85,7,'Phường Tân Phong','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(86,7,'Phường Tân Phú','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(87,7,'Phường Tân Quy','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(88,7,'Phường Tân Thuận Đông','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(89,7,'Phường Tân Thuận Tây','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(90,8,'Phường 1','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(91,8,'Phường 2','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(92,8,'Phường 3','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(93,8,'Phường 4','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(94,8,'Phường 5','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(95,8,'Phường 6','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(96,8,'Phường 7','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(97,8,'Phường 8','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(98,8,'Phường 9','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(99,8,'Phường 10','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(100,8,'Phường 11','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(101,8,'Phường 12','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(102,8,'Phường 13','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(103,8,'Phường 14','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(104,8,'Phường 15','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(105,8,'Phường 16','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(106,9,'Phường Hiệp Phú','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(107,9,'Phường Long Bình','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(108,9,'Phường Long Phước','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(109,9,'Phường Long Thạnh Mỹ','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(110,9,'Phường Long Trường','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(111,9,'Phường Phú Hữu','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(112,9,'Phường Phước Bình','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(113,9,'Phường Phước Long A','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(114,9,'Phường Phước Long B','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(115,9,'Phường Tăng Nhơn Phú A','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(116,9,'Phường Tăng Nhơn Phú B','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(117,9,'Phường Tân Phú','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(118,9,'Phường Trường Thạnh','2018-07-10 19:00:10','2018-07-10 19:00:10'),
	(119,10,'Phường 1','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(120,10,'Phường 2','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(121,10,'Phường 3','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(122,10,'Phường 4','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(123,10,'Phường 5','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(124,10,'Phường 6','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(125,10,'Phường 7','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(126,10,'Phường 8','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(127,10,'Phường 9','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(128,10,'Phường 10','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(129,10,'Phường 11','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(130,10,'Phường 12','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(131,10,'Phường 13','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(132,10,'Phường 14','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(133,10,'Phường 15','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(134,11,'Phường 1','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(135,11,'Phường 2','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(136,11,'Phường 3','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(137,11,'Phường 4','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(138,11,'Phường 5','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(139,11,'Phường 6','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(140,11,'Phường 7','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(141,11,'Phường 8','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(142,11,'Phường 9','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(143,11,'Phường 10','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(144,11,'Phường 11','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(145,11,'Phường 12','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(146,11,'Phường 13','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(147,11,'Phường 14','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(148,11,'Phường 15','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(149,11,'Phường 16','2018-07-10 19:00:11','2018-07-10 19:00:11'),
	(150,12,'Phường An Phú Đông','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(151,12,'Phường Đông Hưng Thuận','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(152,12,'Phường Hiệp Thành','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(153,12,'Phường Tân Chánh Hiệp','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(154,12,'Phường Tân Hưng Thuận','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(155,12,'Phường Tân Thới Hiệp','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(156,12,'Phường Tân Thới Nhất','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(157,12,'Phường Thạnh Lộc','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(158,12,'Phường Thạnh Xuân','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(159,12,'Phường Thới An','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(160,12,'Phường Trung Mỹ Tây','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(161,13,'Phường An Lạc','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(162,13,'Phường An Lạc A','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(163,13,'Phường Bình Hưng Hòa','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(164,13,'Phường Bình Hưng Hoà A','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(165,13,'Phường Bình Hưng Hoà B','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(166,13,'Phường Bình Trị Đông','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(167,13,'Phường Bình Trị Đông A','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(168,13,'Phường Bình Trị Đông B','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(169,13,'Phường Tân Tạo','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(170,13,'Phường Tân Tạo A','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(171,14,'Phường 1','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(172,14,'Phường 2','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(173,14,'Phường 3','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(174,14,'Phường 5','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(175,14,'Phường 6','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(176,14,'Phường 7','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(177,14,'Phường 11','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(178,14,'Phường 12','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(179,14,'Phường 13','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(180,14,'Phường 14','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(181,14,'Phường 15','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(182,14,'Phường 17','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(183,14,'Phường 19','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(184,14,'Phường 21','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(185,14,'Phường 22','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(186,14,'Phường 24','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(187,14,'Phường 25','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(188,14,'Phường 26','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(189,14,'Phường 27','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(190,14,'Phường 28','2018-07-10 19:00:12','2018-07-10 19:00:12'),
	(191,15,'Phường 1','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(192,15,'Phường 3','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(193,15,'Phường 4','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(194,15,'Phường 5','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(195,15,'Phường 6','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(196,15,'Phường 7','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(197,15,'Phường 8','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(198,15,'Phường 9','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(199,15,'Phường 10','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(200,15,'Phường 11','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(201,15,'Phường 12','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(202,15,'Phường 13','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(203,15,'Phường 14','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(204,15,'Phường 15','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(205,15,'Phường 16','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(206,15,'Phường 17','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(207,16,'Phường 1','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(208,16,'Phường 2','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(209,16,'Phường 3','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(210,16,'Phường 4','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(211,16,'Phường 5','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(212,16,'Phường 7','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(213,16,'Phường 8','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(214,16,'Phường 9','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(215,16,'Phường 10','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(216,16,'Phường 11','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(217,16,'Phường 12','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(218,16,'Phường 13','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(219,16,'Phường 14','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(220,16,'Phường 15','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(221,16,'Phường 17','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(222,17,'Phường 1','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(223,17,'Phường 2','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(224,17,'Phường 3','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(225,17,'Phường 4','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(226,17,'Phường 5','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(227,17,'Phường 6','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(228,17,'Phường 7','2018-07-10 19:00:13','2018-07-10 19:00:13'),
	(229,17,'Phường 8','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(230,17,'Phường 9','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(231,17,'Phường 10','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(232,17,'Phường 11','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(233,17,'Phường 12','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(234,17,'Phường 13','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(235,17,'Phường 14','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(236,17,'Phường 15','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(237,18,'Phường Hiệp Tân','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(238,18,'Phường Hòa Thạnh','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(239,18,'Phường Phú Thạnh','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(240,18,'Phường Phú Thọ Hòa','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(241,18,'Phường Phú Trung','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(242,18,'Phường Sơn Kỳ','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(243,18,'Phường Tân Quý','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(244,18,'Phường Tân Sơn Nhì','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(245,18,'Phường Tân Thành','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(246,18,'Phường Tân Thới Hòa','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(247,18,'Phường Tây Thạnh','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(248,19,'Phường Bình Chiểu','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(249,19,'Phường Bình Thọ','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(250,19,'Phường Hiệp Bình Chánh','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(251,19,'Phường Hiệp Bình Phước','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(252,19,'Phường Linh Chiểu','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(253,19,'Phường Linh Đông','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(254,19,'Phường Linh Tây','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(255,19,'Phường Linh Trung','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(256,19,'Phường Linh Xuân','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(257,19,'Phường Tam Bình','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(258,19,'Phường Tam Phú','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(259,19,'Phường Trường Thọ','2018-07-10 19:00:14','2018-07-10 19:00:14'),
	(260,20,'Thị trấn Tân Túc','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(261,20,'Xã An Phú Tây','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(262,20,'Xã Bình Chánh','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(263,20,'Xã Bình Hưng','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(264,20,'Xã Bình Lợi','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(265,20,'Xã Đa Phước','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(266,20,'Xã Hưng Long','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(267,20,'Xã Lê Minh Xuân','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(268,20,'Xã Phạm Văn Hai','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(269,20,'Xã Phong Phú','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(270,20,'Xã Quy Đức','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(271,20,'Xã Tân Kiên','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(272,20,'Xã Tân Nhựt','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(273,20,'Xã Tân Quý Tây','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(274,20,'Xã Vĩnh Lộc A','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(275,20,'Xã Vĩnh Lộc B','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(276,21,'Thị trấn Cần Thạnh','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(277,21,'Xã An Thới Đông','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(278,21,'Xã Bình Khánh','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(279,21,'Xã Long Hòa','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(280,21,'Xã Lý Nhơn','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(281,21,'Xã Tam Thôn Hiệp','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(282,21,'Xã Thạnh An','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(283,22,'Thị trấn Củ Chi','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(284,22,'Xã An Nhơn Tây','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(285,22,'Xã An Phú','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(286,22,'Xã Bình Mỹ','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(287,22,'Xã Hòa Phú','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(288,22,'Xã Nhuận Đức','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(289,22,'Xã Phạm Văn Cội','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(290,22,'Xã Phú Hòa Đông','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(291,22,'Xã Phú Mỹ Hưng','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(292,22,'Xã Phước Hiệp','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(293,22,'Xã Phước Thạnh','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(294,22,'Xã Phước Vĩnh An','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(295,22,'Xã Tân An Hội','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(296,22,'Xã Tân Phú Trung','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(297,22,'Xã Tân Thạnh Đông','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(298,22,'Xã Tân Thạnh Tây','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(299,22,'Xã Tân Thông Hội','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(300,22,'Xã Thái Mỹ','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(301,22,'Xã Trung An','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(302,22,'Xã Trung Lập Hạ','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(303,22,'Xã Trung Lập Thượng','2018-07-10 19:00:15','2018-07-10 19:00:15'),
	(304,23,'Thị trấn Hóc Môn','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(305,23,'Xã Bà Điểm','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(306,23,'Xã Đông Thạnh','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(307,23,'Xã Nhị Bình','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(308,23,'Xã Tân Hiệp','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(309,23,'Xã Tân Thới Nhì','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(310,23,'Xã Tân Xuân','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(311,23,'Xã Thới Tam Thôn','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(312,23,'Xã Trung Chánh','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(313,23,'Xã Xuân Thới Đông','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(314,23,'Xã Xuân Thới Sơn','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(315,23,'Xã Xuân Thới Thượng','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(316,24,'Thị trấn Nhà Bè','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(317,24,'Xã Hiệp Phước','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(318,24,'Xã Long Thới','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(319,24,'Xã Nhơn Đức','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(320,24,'Xã Phú Xuân','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(321,24,'Xã Phước Kiển','2018-07-10 19:00:16','2018-07-10 19:00:16'),
	(322,24,'Xã Phước Lộc','2018-07-10 19:00:16','2018-07-10 19:00:16');

/*!40000 ALTER TABLE `wards` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
