-- MySQL dump 10.13  Distrib 5.5.41, for Win32 (AMD64)
--
-- Host: localhost    Database: practice
-- ------------------------------------------------------
-- Server version	5.5.41-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) unsigned NOT NULL,
  `practice_id` int(11) unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contract_id` (`contract_id`),
  KEY `practice_id` (`practice_id`),
  CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`practice_id`) REFERENCES `practice_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,1,1,'2016-02-10','2016-04-14'),(2,1,2,'2016-02-09','2016-03-31'),(3,2,4,'2016-03-13','2016-06-16');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_number` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'ОАО \"Чисто\"','г. Зеленоград, корп. 240','+7-499-546-85-13'),(2,'ООО \"Прогеры\"','г. Москва, ул. Победы, д. 158','+7-499-568-18-96');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL,
  `formation_date` date NOT NULL,
  `text` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,1,'2016-01-13','Общество с ограниченной ответственностью наряду с иными видами хозяйственных обществ, а также хозяйственных товариществ, производственных кооперативов, государственных и муниципальных унитарных предприятий является коммерческой организацией, то есть организацией, преследующей извлечение прибыли в качестве основной цели своей деятельности и распределяющей полученную прибыль между участниками.\r\n\r\nВ отличие от государственных и муниципальных унитарных предприятий, на имущество которых их учредители имеют право собственности или иное вещное право, общества с ограниченной ответственностью (равно как и иные виды хозяйственных обществ, хозяйственных товариществ и производственных кооперативов) характеризуются тем, что их участники имеют в отношении них обязательственные права.\r\n\r\nВ частной экономической практике ООО является наиболее востребованной организационно-правовой формой среди коммерческих организаций.'),(2,2,'2016-03-14','Данный орган управления является обязательным в ООО.\r\n\r\nПредусмотренная законом компетенция ОСУ может быть расширена в любых пределах, установленных учредителями/участниками в уставе ООО.\r\n\r\nПри этом уникальной особенностью ООО является возможность предусмотреть Уставом, что участники при голосовании на ОСУ будут обладать количеством голосов, непропорциональном размеру их долей в уставном капитале ООО, то есть независимо от размера их долей в уставном капитале ООО (абз.5 п.1 ст.32 закона «об обществах с ограниченной ответственностью»). В остальных случаях количество голосов участников пропорционально размеру их долей в уставном капитале.');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practice_types`
--

DROP TABLE IF EXISTS `practice_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `practice_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practice_types`
--

LOCK TABLES `practice_types` WRITE;
/*!40000 ALTER TABLE `practice_types` DISABLE KEYS */;
INSERT INTO `practice_types` VALUES (1,'Стирка'),(2,'Уборка'),(3,'Вёрстка'),(4,'Анализ БД');
/*!40000 ALTER TABLE `practice_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_app_link`
--

DROP TABLE IF EXISTS `student_app_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_app_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `app_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_id` (`app_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `student_app_link_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  CONSTRAINT `student_app_link_ibfk_2` FOREIGN KEY (`app_id`) REFERENCES `applications` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_app_link`
--

LOCK TABLES `student_app_link` WRITE;
/*!40000 ALTER TABLE `student_app_link` DISABLE KEYS */;
INSERT INTO `student_app_link` VALUES (1,1,1),(2,2,3),(3,3,2),(4,4,3);
/*!40000 ALTER TABLE `student_app_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `patronymic` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Прокофьев','Владислав','Артёмович'),(2,'Степанов','Алексей','Григорьевич'),(3,'Мезенев','Григорий','Викторович'),(4,'Самойленко','Алексей','Олегович'),(5,'Ленивцев','Олег','Андреевич');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',1),(2,'test','098f6bcd4621d373cade4e832627b4f6',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-27 17:44:06
