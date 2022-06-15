-- MySQL dump 10.13  Distrib 5.7.38, for Linux (x86_64)
--
-- Host: localhost    Database: stud
-- ------------------------------------------------------
-- Server version	5.7.38-0ubuntu0.18.04.1

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
-- Table structure for table `exam_expand`
--

DROP TABLE IF EXISTS `exam_expand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_expand` (
  `idexamlist` int(11) NOT NULL,
  `y` float DEFAULT NULL,
  `xts` float DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `x2` float DEFAULT NULL,
  PRIMARY KEY (`idexamlist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_expand`
--

LOCK TABLES `exam_expand` WRITE;
/*!40000 ALTER TABLE `exam_expand` DISABLE KEYS */;
INSERT INTO `exam_expand` (`idexamlist`, `y`, `xts`, `x1`, `x2`) VALUES (1,0.5,0.590198,2.36079,1.1804);
INSERT INTO `exam_expand` (`idexamlist`, `y`, `xts`, `x1`, `x2`) VALUES (2,0.272727,0.272727,0.272727,0.272727);
INSERT INTO `exam_expand` (`idexamlist`, `y`, `xts`, `x1`, `x2`) VALUES (3,0.6,0.590198,0.590198,0.590198);
INSERT INTO `exam_expand` (`idexamlist`, `y`, `xts`, `x1`, `x2`) VALUES (4,0.8,0.634847,5.71362,1.90454);
INSERT INTO `exam_expand` (`idexamlist`, `y`, `xts`, `x1`, `x2`) VALUES (5,0.5,0.564076,2.2563,1.12815);
/*!40000 ALTER TABLE `exam_expand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_list`
--

DROP TABLE IF EXISTS `exam_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_list` (
  `id_exam_list` int(11) NOT NULL AUTO_INCREMENT,
  `idgroup` int(11) DEFAULT NULL,
  `idexaminer` int(11) DEFAULT NULL,
  `idsubject` int(11) DEFAULT NULL,
  `session_number` int(11) NOT NULL DEFAULT '1',
  `exam_number_in_session` int(11) NOT NULL DEFAULT '1',
  `number_positive_ratings` int(11) NOT NULL DEFAULT '0',
  `number_students_in_group` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_exam_list`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_list`
--

LOCK TABLES `exam_list` WRITE;
/*!40000 ALTER TABLE `exam_list` DISABLE KEYS */;
INSERT INTO `exam_list` (`id_exam_list`, `idgroup`, `idexaminer`, `idsubject`, `session_number`, `exam_number_in_session`, `number_positive_ratings`, `number_students_in_group`) VALUES (1,1,1,1,1,2,5,10);
INSERT INTO `exam_list` (`id_exam_list`, `idgroup`, `idexaminer`, `idsubject`, `session_number`, `exam_number_in_session`, `number_positive_ratings`, `number_students_in_group`) VALUES (2,1,2,2,1,1,3,11);
INSERT INTO `exam_list` (`id_exam_list`, `idgroup`, `idexaminer`, `idsubject`, `session_number`, `exam_number_in_session`, `number_positive_ratings`, `number_students_in_group`) VALUES (3,2,1,1,1,1,6,10);
INSERT INTO `exam_list` (`id_exam_list`, `idgroup`, `idexaminer`, `idsubject`, `session_number`, `exam_number_in_session`, `number_positive_ratings`, `number_students_in_group`) VALUES (4,2,3,1,2,3,8,10);
INSERT INTO `exam_list` (`id_exam_list`, `idgroup`, `idexaminer`, `idsubject`, `session_number`, `exam_number_in_session`, `number_positive_ratings`, `number_students_in_group`) VALUES (5,3,3,4,1,2,6,12);
/*!40000 ALTER TABLE `exam_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examiner`
--

DROP TABLE IF EXISTS `examiner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examiner` (
  `id_examiner` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `second_name` varchar(45) DEFAULT NULL,
  `npositiv` int(11) DEFAULT NULL,
  `ntotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_examiner`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examiner`
--

LOCK TABLES `examiner` WRITE;
/*!40000 ALTER TABLE `examiner` DISABLE KEYS */;
INSERT INTO `examiner` (`id_examiner`, `first_name`, `second_name`, `npositiv`, `ntotal`) VALUES (1,'Брежнев',NULL,11,20);
INSERT INTO `examiner` (`id_examiner`, `first_name`, `second_name`, `npositiv`, `ntotal`) VALUES (2,'Сталин',NULL,3,11);
INSERT INTO `examiner` (`id_examiner`, `first_name`, `second_name`, `npositiv`, `ntotal`) VALUES (3,'Медведев',NULL,14,22);
INSERT INTO `examiner` (`id_examiner`, `first_name`, `second_name`, `npositiv`, `ntotal`) VALUES (4,'Киселёв',NULL,NULL,NULL);
/*!40000 ALTER TABLE `examiner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `start_year` int(11) NOT NULL DEFAULT '0',
  `npositiv` int(11) DEFAULT NULL,
  `ntotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id_group`, `title`, `start_year`, `npositiv`, `ntotal`) VALUES (1,'Технологи-1',2015,8,21);
INSERT INTO `group` (`id_group`, `title`, `start_year`, `npositiv`, `ntotal`) VALUES (2,'Технологи-8А',2016,14,20);
INSERT INTO `group` (`id_group`, `title`, `start_year`, `npositiv`, `ntotal`) VALUES (3,'Экономисты-2',2017,6,12);
INSERT INTO `group` (`id_group`, `title`, `start_year`, `npositiv`, `ntotal`) VALUES (4,'Программисты-10',2017,NULL,NULL);
INSERT INTO `group` (`id_group`, `title`, `start_year`, `npositiv`, `ntotal`) VALUES (5,'Экономисты-1',2016,NULL,NULL);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL AUTO_INCREMENT,
  `title_subject` varchar(45) DEFAULT NULL,
  `npositiv` int(11) DEFAULT NULL,
  `ntotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_subject`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` (`id_subject`, `title_subject`, `npositiv`, `ntotal`) VALUES (1,'Алгебра',19,30);
INSERT INTO `subject` (`id_subject`, `title_subject`, `npositiv`, `ntotal`) VALUES (2,'История',3,11);
INSERT INTO `subject` (`id_subject`, `title_subject`, `npositiv`, `ntotal`) VALUES (3,'Программирование',NULL,NULL);
INSERT INTO `subject` (`id_subject`, `title_subject`, `npositiv`, `ntotal`) VALUES (4,'Физика',6,12);
INSERT INTO `subject` (`id_subject`, `title_subject`, `npositiv`, `ntotal`) VALUES (5,'Химия',NULL,NULL);
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-28 21:01:09
