/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.9-log : Database - taleemulquran_dbs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`taleemulquran_dbs` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `taleemulquran_dbs`;

/*Table structure for table `attendence` */

DROP TABLE IF EXISTS `attendence`;

CREATE TABLE `attendence` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `stdStatus` text COLLATE utf8_unicode_ci NOT NULL COMMENT '1=present 2=absent 3=ill 4=on leave',
  `darjaSno` int(11) NOT NULL,
  `attendanceDate` date DEFAULT NULL COMMENT 'attendance date',
  `regSno` int(11) NOT NULL COMMENT 'it will hold the registrationInfo table sno',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `attendence` */

/*Table structure for table `darjaat` */

DROP TABLE IF EXISTS `darjaat`;

CREATE TABLE `darjaat` (
  `derjaCode` int(11) NOT NULL AUTO_INCREMENT,
  `shoba_sno` int(11) NOT NULL,
  `darja` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`derjaCode`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `darjaat` */

insert  into `darjaat`(`derjaCode`,`shoba_sno`,`darja`) values (1,1,'مرحلۃ القاعدہ'),(2,1,'تحفیظ القرآن (1)'),(3,1,'تحفیظ القرآن (2)'),(4,1,'تحفیظ القرآن (3)'),(5,2,'تجوید سال اول '),(6,2,'تجوید سال دوم '),(7,3,'الدورہ حدیث'),(8,3,'الاولٰی'),(9,3,'الثانيہ'),(10,3,'الثالثہ'),(11,3,'الرابعہ'),(12,3,'الخامسہ'),(13,3,'السادسہ'),(14,3,'الموقوف علیہ'),(15,3,'المتوسطہ'),(16,4,'نرسری '),(17,4,'جماعت اول '),(18,4,'جماعت دوئم '),(19,4,'جماعت سوئم'),(20,4,'جماعت چہارم'),(21,4,'جماعت پنجم'),(22,4,'جماعت ششم'),(23,4,'جماعت ہفتم'),(24,4,'جماعت ہشتم');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `userkey` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `ownreName` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `login` */

insert  into `login`(`sno`,`userid`,`userkey`,`ownreName`) values (3,'admin','admin','شاہ حسین');

/*Table structure for table `registrationinfo` */

DROP TABLE IF EXISTS `registrationinfo`;

CREATE TABLE `registrationinfo` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `stdName` text COLLATE utf8_unicode_ci NOT NULL,
  `fatherName` text COLLATE utf8_unicode_ci NOT NULL,
  `nationality` text COLLATE utf8_unicode_ci NOT NULL,
  `dob` text COLLATE utf8_unicode_ci NOT NULL,
  `qualification` text COLLATE utf8_unicode_ci NOT NULL,
  `guirdianName` text COLLATE utf8_unicode_ci NOT NULL,
  `cellNo` text COLLATE utf8_unicode_ci NOT NULL,
  `fatherProfession` text COLLATE utf8_unicode_ci,
  `gurdianCellNo` text COLLATE utf8_unicode_ci NOT NULL,
  `permanentAddress` text COLLATE utf8_unicode_ci NOT NULL,
  `presentAddress` text COLLATE utf8_unicode_ci NOT NULL,
  `guirdianNameAuth` text COLLATE utf8_unicode_ci NOT NULL,
  `guirdianFNameAuth` text COLLATE utf8_unicode_ci NOT NULL,
  `guirdianSign` text COLLATE utf8_unicode_ci NOT NULL,
  `stdNic` text COLLATE utf8_unicode_ci NOT NULL,
  `guirdianNic` text COLLATE utf8_unicode_ci NOT NULL,
  `formB` text COLLATE utf8_unicode_ci NOT NULL,
  `relationShipWithGuirdian` text COLLATE utf8_unicode_ci NOT NULL,
  `signNazim` text COLLATE utf8_unicode_ci NOT NULL,
  `admissionNo` text COLLATE utf8_unicode_ci NOT NULL,
  `stdPhoto` text COLLATE utf8_unicode_ci,
  `isLocal` tinyint(1) DEFAULT '1' COMMENT '1= local 0 = out sider',
  `isActive` tinyint(1) DEFAULT '1' COMMENT '1= Active 0 = Kharij',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `registrationinfo` */

/*Table structure for table `regnumbers` */

DROP TABLE IF EXISTS `regnumbers`;

CREATE TABLE `regnumbers` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `registrationNo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `RollNumber` int(20) NOT NULL,
  `regSno` int(11) NOT NULL COMMENT 'it will hold the RegistrationInfo Table sno',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `regnumbers` */

/*Table structure for table `result` */

DROP TABLE IF EXISTS `result`;

CREATE TABLE `result` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `darjasno` int(11) NOT NULL,
  `stdSno` int(11) NOT NULL,
  `subjectsno` int(11) NOT NULL,
  `obtmarks` int(11) NOT NULL,
  `promotionDate` date NOT NULL COMMENT 'date of admission start',
  `dateEnd` date NOT NULL COMMENT 'date of admission end',
  `resultTerm` tinyint(1) DEFAULT '1' COMMENT '1=seh mahi 2=shash mahi 3=annual',
  `edu_year_remarks` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `result` */

/*Table structure for table `shobajaat` */

DROP TABLE IF EXISTS `shobajaat`;

CREATE TABLE `shobajaat` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `shoba` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Shoba label',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=not active 1=active',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `shobajaat` */

insert  into `shobajaat`(`sno`,`shoba`,`is_active`) values (1,'تحفیظ القرآن',1),(2,'تجوید',1),(3,'درس نظامی',1),(4,'سکول',1),(5,'افتاء',1);

/*Table structure for table `stddarjaat` */

DROP TABLE IF EXISTS `stddarjaat`;

CREATE TABLE `stddarjaat` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `stdSno` int(11) NOT NULL COMMENT 'will keep the registrationInfo table std sno',
  `darja` int(11) NOT NULL COMMENT 'this will hold darja sno of darjaat table sno',
  `isCurrent` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=current 0 = old',
  `promotionDate` varchar(25) DEFAULT NULL COMMENT 'it will hold the promotion date',
  `dateEnd` date DEFAULT NULL,
  `shoba_sno` int(11) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stddarjaat` */

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `totalMarks` int(11) NOT NULL,
  `darjaSno` int(11) NOT NULL COMMENT 'sno from darjaat table',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='subject table alongwith Numbers';

/*Data for the table `subjects` */

insert  into `subjects`(`sno`,`subjectName`,`totalMarks`,`darjaSno`) values (1,'التبیان نخبۃ',100,14),(2,'بیضاوی ',100,14),(3,'مشکوۃ (1)',100,14),(4,'مشکوۃ (2)',100,14),(5,'ھدایہ (3)',100,14),(6,'ھدایہ (4)',100,14),(7,'خلاصۃ التجوید ',100,6),(8,'جامع الوقف',100,6),(9,'تعلیم الاسلام ',100,6),(10,'مفتاح القرآن ',100,6),(11,'ترتیل29/30',100,6),(12,'حدر',100,6),(13,'جمال القرآن ',100,5),(14,'جامع الوقف',100,5),(15,'حدر10',100,5),(16,'ترتیل 29/30',100,5),(17,'مفتاح 2حصے',100,5),(18,'تعلیم الاسلام/سیرت',100,5),(19,'تفسیر /اصول',100,13),(20,'الحدیث/فرائض',100,13),(21,'الفقہ ',100,13),(22,'اصول فقہ ',100,13),(23,'عقائد /فلکیات',100,13),(24,'ادب /عروض',100,13),(25,'تفسیر/حدیث',100,12),(26,'الادب ',100,12),(27,'الفقہ ',100,12),(28,'التلخیص ',100,12),(29,'الفرائض',100,12),(30,'اصول فقہ',100,12),(31,'تفسیر',100,11),(32,'فقہ ',100,11),(33,'اصول فقہ ',100,11),(34,'نحو',100,11),(35,'ادب',100,11),(36,'منطق/بلاغۃ',100,11),(37,'التفسیر /حدیث',100,10),(38,'فقہ ',100,10),(39,'اصول فقہ ',100,10),(40,'نحو',100,10),(41,'ادب ',100,10),(42,'منطق',100,10),(43,'تفسیر /تجوید',100,9),(44,'حدیث /ادب',100,9),(45,'فقہ ',100,9),(46,'صرف',100,9),(47,'نحو',100,9),(48,'منطق',100,9),(49,'عوامل النحو',100,8),(50,'فقہ ',100,8),(51,'حوارات',100,8),(52,'صرف',100,8),(53,'نحو',100,8),(54,'منطق',100,8),(55,'فقہ /سیرت',100,15),(56,'اردو/معاشرتی علوم',100,15),(57,'ریاضی',100,15),(58,'فارسی ',100,15),(59,'سائنس',100,15),(61,'انگلش',100,15),(62,'سوال اول20',20,2),(63,'سوال دوئم20',20,2),(64,'سوال سوئم20',20,2),(65,'مخارج وصفات20',20,2),(66,'لہجہ10',10,2),(67,'مسائل10',10,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
