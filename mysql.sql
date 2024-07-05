/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.5.5-10.4.32-MariaDB : Database - aaa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`aaa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `aaa`;

/*Table structure for table `laboratory` */

DROP TABLE IF EXISTS `laboratory`;

CREATE TABLE `laboratory` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `listprice` double DEFAULT NULL,
  `lastmodifieddate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `laboratory` */

insert  into `laboratory`(Id,Name,Description,created_date,listprice,lastmodifieddate) values (1,'CBC',NULL,'2024-05-01 20:51:29',NULL,NULL),(2,'UA',NULL,'2024-05-01 20:51:29',NULL,NULL),(3,'PT UA',NULL,'2024-05-01 20:51:29',NULL,NULL),(4,'STOOL EXAM',NULL,'2024-05-01 20:51:29',NULL,NULL),(5,'SGPT',NULL,'2024-05-01 20:51:29',NULL,NULL),(6,'SGOT',NULL,'2024-05-01 20:51:29',NULL,NULL),(7,'LIPID PANEL',NULL,'2024-05-01 20:51:29',NULL,NULL),(8,'BUA',NULL,'2024-05-01 20:51:29',NULL,NULL),(9,'BUN',NULL,'2024-05-01 20:51:29',NULL,NULL),(10,'CREATININE',NULL,'2024-05-01 20:51:29',NULL,NULL);

/*Table structure for table `medicine` */

DROP TABLE IF EXISTS `medicine`;

CREATE TABLE `medicine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Brand` varchar(255) DEFAULT NULL,
  `DosageForm` varchar(100) DEFAULT NULL,
  `Strength` varchar(100) DEFAULT NULL,
  `Manufacturer` varchar(255) DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `ceated_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastmodified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `medicine` */

insert  into `medicine`(Id,Name,Brand,DosageForm,Strength,Manufacturer,ExpiryDate,Price,Description,ceated_date,lastmodified_date) values (3,'Name','Brank','Tablet','500mg','Manacutrere','2024-07-15','200.00','test ','2024-07-04 14:12:42','2024-07-04 14:12:42'),(4,'Name1','Brank1','Tablet','300mg','Manacutrere','2024-07-15','200.00','test ','2024-07-04 14:12:49','2024-07-04 14:55:17'),(5,'Name3','Brank3','Tablet','500mg','Manacutrere','2024-07-15','200.00','test ','2024-07-04 14:12:53','2024-07-04 15:09:58'),(6,'Name 4','Brank 4','Tablet','50 ml','Test Record Manufacturer',NULL,'5.00','Test Record Manufacturer Tablet','2024-07-04 15:10:40','2024-07-04 15:10:40');

/*Table structure for table `patient_file_library` */

DROP TABLE IF EXISTS `patient_file_library`;

CREATE TABLE `patient_file_library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `isavatar` varchar(20) NOT NULL DEFAULT 'No',
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `patient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `patient_file_library` */

insert  into `patient_file_library`(id,description,isavatar,type,name,created_date,patient_id) values (5,'Some description','Yes','image/jpeg','6655e162e3ace.jpg','2024-05-28 21:51:30',6),(6,'Some description','Yes','image/jpeg','6655e3cd203e7.jpg','2024-05-28 22:01:49',5),(7,'Some description','Yes','image/jpeg','6655e4e7594fd.jpg','2024-05-28 22:06:31',7),(8,'Some description','Yes','image/jpeg','66587fa0f2b74.jpg','2024-05-30 21:31:13',5),(9,'Some description','Yes','image/jpeg','66588094d2c1b.jpg','2024-05-30 21:35:16',5),(10,'Some description','Yes','image/jpeg','665880ddc12a2.jpg','2024-05-30 21:36:29',5),(11,'Some description','Yes','image/jpeg','665b28a2394c9.jpg','2024-06-01 21:56:50',12);

/*Table structure for table `patient_request_table` */

DROP TABLE IF EXISTS `patient_request_table`;

CREATE TABLE `patient_request_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` text DEFAULT NULL,
  `patient_Id` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Draft',
  `created_date` datetime DEFAULT NULL,
  `created_by_Id` int(11) DEFAULT NULL,
  `modified_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `patient_request_table` */

insert  into `patient_request_table`(Id,Description,patient_Id,Status,created_date,created_by_Id,modified_date,modified_by) values (20,NULL,5,'Saved','2024-05-16 23:43:46',0,'2024-05-27 14:12:53',NULL),(21,NULL,6,'Saved','2024-05-17 15:08:43',0,'2024-05-31 15:16:49',NULL),(22,NULL,5,'Saved','2024-05-25 12:37:31',0,'2024-05-30 15:39:15',NULL),(23,NULL,10,'Draft','2024-06-01 10:05:40',0,'2024-06-01 16:05:40',NULL),(24,NULL,7,'Draft','2024-06-01 14:33:40',0,'2024-06-01 20:33:40',NULL),(25,NULL,12,'Saved','2024-06-01 15:41:21',1,'2024-06-01 15:57:28',1);

/*Table structure for table `patients` */

DROP TABLE IF EXISTS `patients`;

CREATE TABLE `patients` (
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `birthday` varchar(100) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `patient_number` varchar(50) DEFAULT NULL,
  `address` text NOT NULL,
  `Created Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `createdby` int(11) DEFAULT 0,
  `modifiedby` int(11) DEFAULT 0,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `patients` */

insert  into `patients`(first_name,last_name,middle_name,age,gender,birthday,contact_number,patient_number,address,Created Date,Id,createdby,modifiedby) values ('Jason','Test','Person','40','Male','1973-02-15','09123231231','P-1','Purok 5, Brgy San Roques Ozamiz City ','2024-05-17 05:38:00',5,NULL,1),('Mela','Test','Person','25','Female','1959-06-17','123213123123','P-2','aaaa asaaaaaaa','2024-05-17 05:38:45',6,NULL,NULL),('Asdfasdf','Sadf','Asdfsadf','22','Male','2023-02-01','Asdfasdf','P-3','sasdf','2024-05-17 05:40:40',7,NULL,NULL),('Aa','Asdf','Asdf','','Male','1994-02-03','','P-test','','2024-05-17 05:42:30',8,NULL,NULL),('Aa','Asdf','Asdf','54','Female','1988-02-05','312312312','Tewtw ','adfasdfasdf','2024-05-17 05:43:10',9,NULL,NULL),('Sddd','Dddd','Dddasdfa','54','Male','1988-02-05','02087599036','Asdfasdf','Test Addresss','2024-05-17 05:43:38',10,NULL,NULL),('Asfa','Asdf','Asdfasdf','34','Female','2007-03-17','911111111111','P-24','Test address','2024-05-25 07:16:44',11,NULL,NULL),('Test','Tttt','Ttt','46','Male','2008-02-18','123213123','P123','test','2024-06-01 21:37:29',12,1,1),('Test','Tttt','Ttt','46','Male','2008-02-18','123213123','P-test','asdf','2024-06-04 21:37:27',13,1,0),('','','','','Male','','','P-3','','2024-06-04 22:03:28',14,1,0);

/*Table structure for table `prq_description_table` */

DROP TABLE IF EXISTS `prq_description_table`;

CREATE TABLE `prq_description_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_request_Id` int(11) NOT NULL,
  `patient_Id` text NOT NULL,
  `modified_by_Id` int(11) DEFAULT NULL,
  `modified_date` datetime NOT NULL DEFAULT current_timestamp(),
  `Description` text NOT NULL,
  `Type` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `prq_description_table` */

insert  into `prq_description_table`(Id,patient_request_Id,patient_Id,modified_by_Id,modified_date,Description,Type) values (54,20,'5',NULL,'2024-05-17 05:46:36','<p>1. TEst&nbsp;</p><p>2. Test a&nbsp;</p><p>3. Test b</p><p>test plan&nbsp;</p><p>test plan b</p>','PT'),(55,21,'6',NULL,'2024-05-17 21:11:40','<p>asdfasdfasdfasdfasdfasdf</p><p>sgsgffsdg</p><p>sdfgsdg</p>','PT'),(56,20,'5',NULL,'2024-05-25 07:33:04','<p style=\"text-align: center; \">gfsdgsd sdasfafasdfasdf</p><p style=\"text-align: center; \">asdfsdf</p><p style=\"text-align: center; \">asdfasdfas sdf</p><p style=\"text-align: center; \">asdf asdasfsfasdfgsdgasdf</p>','SC'),(57,20,'5',NULL,'2024-05-25 07:33:04','<p>sdfgsgsdgfsd</p>','AP'),(58,20,'5',NULL,'2024-05-25 07:51:50','<p>fasdfasdf</p>','IMP'),(59,22,'5',NULL,'2024-05-30 21:39:13','<p>Hello Madam</p>','PT'),(60,25,'12',1,'2024-06-01 15:50:06','<p>test&nbsp; &nbsp;dfasdfasdf</p>','SC'),(61,25,'12',1,'2024-06-01 15:50:28','<p>asdfasfasdfasdf</p>','AP'),(62,25,'12',1,'2024-06-01 15:57:28','<p>Test a</p><p>Test b</p><p>Test C</p>','PT'),(63,25,'12',1,'2024-06-01 15:50:28','<p>adsfddddd</p>','IMP');

/*Table structure for table `prq_laboratory_table` */

DROP TABLE IF EXISTS `prq_laboratory_table`;

CREATE TABLE `prq_laboratory_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Status` text NOT NULL DEFAULT 'Unpaid',
  `medicine_Id` int(11) DEFAULT NULL,
  `laboratory_Id` int(11) DEFAULT NULL,
  `isOther` tinyint(1) DEFAULT NULL,
  `is_other_request` varchar(255) DEFAULT NULL,
  `OtherType` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `patient_request_Id` int(11) NOT NULL,
  `UnitPrice` double DEFAULT NULL,
  `patient_Id` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by_Id` int(11) DEFAULT NULL,
  `assignedDocotor` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `prq_laboratory_table` */

insert  into `prq_laboratory_table`(Id,Status,medicine_Id,laboratory_Id,isOther,is_other_request,OtherType,Description,patient_request_Id,UnitPrice,patient_Id,created_date,created_by_Id,assignedDocotor) values (132,'Unpaid',NULL,1,NULL,NULL,NULL,NULL,21,NULL,6,'2024-05-17 15:09:12',NULL,NULL),(133,'Paid',NULL,4,NULL,NULL,NULL,NULL,21,NULL,6,'2024-05-17 15:09:16',NULL,NULL),(134,'Paid',NULL,3,NULL,NULL,NULL,NULL,21,NULL,6,'2024-05-17 15:09:16',NULL,NULL),(135,'Paid',NULL,10,NULL,NULL,NULL,NULL,21,NULL,6,'2024-05-17 15:09:17',NULL,NULL),(136,'Paid',NULL,9,NULL,NULL,NULL,NULL,21,NULL,6,'2024-05-17 15:09:17',NULL,NULL),(138,'Unpaid',NULL,9,NULL,NULL,NULL,NULL,20,NULL,5,'2024-05-25 01:38:52',NULL,NULL),(139,'Unpaid',NULL,8,NULL,NULL,NULL,NULL,20,NULL,5,'2024-05-25 01:38:54',NULL,NULL),(140,'Paid',NULL,7,NULL,NULL,NULL,NULL,20,NULL,5,'2024-05-25 01:39:00',NULL,NULL),(141,'Unpaid',NULL,NULL,1,'asdfasdf','Medicine',NULL,20,NULL,5,'2024-05-25 01:41:03',NULL,NULL),(142,'Paid',NULL,NULL,1,'asdfas','Medicine',NULL,20,NULL,5,'2024-05-25 01:42:00',NULL,NULL),(144,'Unpaid',NULL,NULL,1,'asdfasdfasdfasdf','Other',NULL,20,NULL,5,'2024-05-25 01:42:44',NULL,NULL),(145,'Paid',NULL,1,NULL,NULL,NULL,NULL,22,NULL,5,'2024-05-25 12:37:36',NULL,NULL),(146,'Paid',NULL,4,NULL,NULL,NULL,NULL,22,NULL,5,'2024-05-25 12:37:37',NULL,NULL),(148,'Paid',NULL,NULL,1,'Doctors Checkup','Other',NULL,20,NULL,5,'2024-05-25 12:55:28',NULL,NULL),(149,'Unpaid',NULL,4,NULL,NULL,NULL,NULL,23,NULL,10,'2024-06-01 10:05:44',NULL,NULL),(150,'Unpaid',NULL,3,NULL,NULL,NULL,NULL,23,NULL,10,'2024-06-01 10:05:45',NULL,NULL),(151,'Unpaid',NULL,1,NULL,NULL,NULL,NULL,24,NULL,7,'2024-06-01 14:33:50',NULL,NULL),(153,'Unpaid',NULL,3,NULL,NULL,NULL,NULL,24,NULL,7,'2024-06-01 14:33:51',NULL,NULL),(154,'Unpaid',NULL,8,NULL,NULL,NULL,NULL,24,NULL,7,'2024-06-01 15:11:40',NULL,NULL),(155,'Unpaid',NULL,7,NULL,NULL,NULL,NULL,24,NULL,7,'2024-06-01 15:11:40',NULL,NULL),(156,'Unpaid',NULL,NULL,1,'tes ','Medicine',NULL,24,NULL,7,'2024-06-01 15:11:48',NULL,NULL),(157,'Unpaid',NULL,1,NULL,NULL,NULL,NULL,25,NULL,12,'2024-06-01 15:53:31',1,NULL),(158,'Paid',NULL,2,NULL,NULL,NULL,NULL,25,NULL,12,'2024-06-01 15:53:31',1,NULL),(159,'Paid',NULL,3,NULL,NULL,NULL,NULL,25,NULL,12,'2024-06-01 15:53:32',1,NULL),(160,'Unpaid',NULL,NULL,1,'Medicine test 1','Medicine',NULL,25,NULL,12,'2024-06-01 15:53:55',1,NULL),(161,'Unpaid',NULL,NULL,1,'Other testing ','Other',NULL,25,NULL,12,'2024-06-01 15:54:00',1,NULL),(162,'Unpaid',NULL,6,NULL,NULL,NULL,NULL,22,NULL,5,'2024-06-01 15:59:59',2,NULL);

/*Table structure for table `user_permession` */

DROP TABLE IF EXISTS `user_permession`;

CREATE TABLE `user_permession` (
  `make-request-prescription` tinyint(1) DEFAULT 0,
  `make-request-prescription-laboratories` tinyint(1) DEFAULT 0,
  `ProfileName` varchar(255) NOT NULL,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Dashboard` tinyint(1) DEFAULT NULL,
  `make-request-prescription-paidstatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_permession` */

insert  into `user_permession`(make-request-prescription,make-request-prescription-laboratories,ProfileName,Id,Dashboard,make-request-prescription-paidstatus) values (1,1,'Admin',1,1,1),(0,1,'Cashier',2,1,1),(0,1,'Receptionist',3,1,0),(1,1,'Doctor',4,0,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT 1,
  `Role` int(11) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(UserID,Username,Email,Password,FirstName,LastName,DateOfBirth,IsActive,Role) values (1,'admin','','admin','Jet','Compayan','2014-04-30',1,1),(2,'doc','doctor@test.com','doc','Doc','tour','2024-05-23',1,4),(3,'staff','staff@test.com','staff','Immay','Staff','2024-05-23',1,2),(4,'receptionist','receptionist@test.com','receptionist','receptionist','receptionist','2024-05-23',1,3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
