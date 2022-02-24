-- MySQL dump 10.19  Distrib 10.3.32-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: boss_enha
-- ------------------------------------------------------
-- Server version	10.3.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `french_account_books`
--

DROP TABLE IF EXISTS `french_account_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_account_books` (
  `ab_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `ab_date` date NOT NULL COMMENT '날자',
  `ab_kind` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '입출금구분',
  `ab_div` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '항목',
  `ab_user` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '작성자',
  `ab_cont` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '내용',
  `ab_amount` bigint(20) NOT NULL DEFAULT 0 COMMENT '금액',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ab_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_account_books`
--

LOCK TABLES `french_account_books` WRITE;
/*!40000 ALTER TABLE `french_account_books` DISABLE KEYS */;
/*!40000 ALTER TABLE `french_account_books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_account_divs`
--

DROP TABLE IF EXISTS `french_account_divs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_account_divs` (
  `d_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `d_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '항목명',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`d_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_account_divs`
--

LOCK TABLES `french_account_divs` WRITE;
/*!40000 ALTER TABLE `french_account_divs` DISABLE KEYS */;
/*!40000 ALTER TABLE `french_account_divs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_boards`
--

DROP TABLE IF EXISTS `french_boards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_boards` (
  `b_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `b_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `b_partner` int(10) unsigned NOT NULL DEFAULT 0,
  `b_member` int(10) unsigned NOT NULL DEFAULT 0,
  `b_uname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `b_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `b_cont` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `b_files` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `b_read` int(10) unsigned NOT NULL DEFAULT 0,
  `b_comment` int(10) unsigned NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`b_no`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_boards`
--

LOCK TABLES `french_boards` WRITE;
/*!40000 ALTER TABLE `french_boards` DISABLE KEYS */;
INSERT INTO `french_boards` VALUES (1,'',0,0,'관리자','a dsfads','f ads','',0,0,NULL,'2022-01-12 13:17:10','2022-01-12 13:17:10'),(2,'',0,0,'관리자','a dsfads','f ads','',0,0,NULL,'2022-01-12 13:17:12','2022-01-12 13:17:12'),(3,'',0,0,'관리자','a dsfads','f ads','',0,0,NULL,'2022-01-12 13:17:22','2022-01-12 13:17:22'),(4,'',0,0,'관리자','ㄴㄹㅇㅎ ㅇㄴㄹㅎ','ㅇㄴㄹㅎㅇㄹ','',0,0,NULL,'2022-01-12 13:21:43','2022-01-12 13:21:43'),(5,'',0,0,'관리자 ADSDFS','sdasㄴ ㅁㅇㄹㅇㄴㅁㄹad as','ㅁㄴㅇㄹㅇㄴ\r\n fadsasdas dD FA\r\nDSFds fdasf asddsf \r\nsadfd fasd','',0,0,NULL,'2022-01-12 13:24:21','2022-01-12 13:49:26'),(6,'',0,0,'관리자','dsafdsf','adsfadsf','',0,0,NULL,'2022-01-14 04:16:50','2022-01-14 04:16:50');
/*!40000 ALTER TABLE `french_boards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_boards_comments`
--

DROP TABLE IF EXISTS `french_boards_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_boards_comments` (
  `c_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `c_board` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '게시판구분명',
  `c_parent` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '글번호',
  `c_user` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '작성자',
  `c_uname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '작성자명',
  `c_comments` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '댓글내용',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`c_no`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_boards_comments`
--

LOCK TABLES `french_boards_comments` WRITE;
/*!40000 ALTER TABLE `french_boards_comments` DISABLE KEYS */;
INSERT INTO `french_boards_comments` VALUES (1,'',5,37,'관리자3','ds afdf ds\r\nf ds\r\nf \r\nsdfds',NULL,'2022-01-12 14:33:27','2022-01-12 14:33:27'),(5,'',5,37,'관리자3','df sdfas',NULL,'2022-01-12 14:37:50','2022-01-12 14:37:50'),(6,'',6,37,'관리자3','adsfdsf',NULL,'2022-01-14 04:16:53','2022-01-14 04:16:53'),(7,'',6,37,'관리자3','dsfadsfas',NULL,'2022-01-14 04:16:56','2022-01-14 04:16:56');
/*!40000 ALTER TABLE `french_boards_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_configs`
--

DROP TABLE IF EXISTS `french_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cf_bg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '배경이미지',
  `cf_bg_width` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '배치도가로편집사이즈',
  `cf_bg_height` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '배치도세로편집사이즈',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_configs`
--

LOCK TABLES `french_configs` WRITE;
/*!40000 ALTER TABLE `french_configs` DISABLE KEYS */;
INSERT INTO `french_configs` VALUES (1,'',998,598,'2022-01-25 05:40:27','2022-01-25 05:40:27');
/*!40000 ALTER TABLE `french_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_contacts`
--

DROP TABLE IF EXISTS `french_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_contacts` (
  `c_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호번호',
  `c_partner` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '파트너번호',
  `c_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '상호명',
  `c_empname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '담당자이름',
  `c_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '연락처',
  `c_email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '이메일',
  `c_cont` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '기타',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`c_no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_contacts`
--

LOCK TABLES `french_contacts` WRITE;
/*!40000 ALTER TABLE `french_contacts` DISABLE KEYS */;
INSERT INTO `french_contacts` VALUES (1,2,'웅진코웨이','정수기','010-0000-0000','drinkwater','월요일 정기 휴무','2021-11-25 04:12:29','2021-11-25 04:12:29',NULL),(2,2,'한국전기','박전기','010-2288-4037','electro@naver.com','연중무휴','2021-11-25 04:20:17','2021-12-09 01:53:53',NULL),(3,2,'청소해드림','이청소','01022884038','leeqwjbregregi@naver.com','','2021-12-09 01:54:25','2021-12-09 01:54:25',NULL);
/*!40000 ALTER TABLE `french_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_laptops`
--

DROP TABLE IF EXISTS `french_laptops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_laptops` (
  `lap_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lap_partner` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '파트너번호',
  `lap_model` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lap_spec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lap_state` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`lap_no`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_laptops`
--

LOCK TABLES `french_laptops` WRITE;
/*!40000 ALTER TABLE `french_laptops` DISABLE KEYS */;
INSERT INTO `french_laptops` VALUES (1,2,'엘지','cpu: i5-7세대\r\nram: 16gb\r\ngrpics: gtx1050','N',NULL,'2021-11-25 05:01:39','2021-11-25 05:02:24'),(2,2,'삼성','cpu: i7-7세대\r\nram: 8gb\r\ngrpics: gtx960','N',NULL,'2021-11-25 05:02:17','2021-11-25 05:02:17'),(3,2,'asus','cpu: i9-3세대\r\nram: 32gb\r\ngrpics: gtx1000','N',NULL,'2021-11-25 05:02:56','2021-12-09 01:53:09'),(4,2,'lenover ipad8','cpu: i9-3세대 ram: 32gb grpics: gtx1000','Y',NULL,'2021-12-09 01:53:29','2021-12-09 01:53:39');
/*!40000 ALTER TABLE `french_laptops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_locker_areas`
--

DROP TABLE IF EXISTS `french_locker_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_locker_areas` (
  `la_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `la_bg` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '배경이미지',
  `la_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '구역이름',
  `la_locker_count` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '사물함갯수',
  `la_locker_state` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '상태',
  `la_locker_open_kiosk` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y' COMMENT '키오스크판매여부',
  `la_locker_open_mobile` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y' COMMENT '모바일판매여부',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`la_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_locker_areas`
--

LOCK TABLES `french_locker_areas` WRITE;
/*!40000 ALTER TABLE `french_locker_areas` DISABLE KEYS */;
/*!40000 ALTER TABLE `french_locker_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_lockers`
--

DROP TABLE IF EXISTS `french_lockers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_lockers` (
  `l_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `l_partner` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '가맹점번호',
  `l_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '사물함이름',
  `l_area` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '구역번호',
  `l_dvc_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '디바이스번호',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`l_no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_lockers`
--

LOCK TABLES `french_lockers` WRITE;
/*!40000 ALTER TABLE `french_lockers` DISABLE KEYS */;
INSERT INTO `french_lockers` VALUES (1,0,'1',1,'',NULL,'2021-12-09 02:00:28','2021-12-09 02:00:28'),(2,0,'2',1,'',NULL,'2021-12-23 06:15:37','2021-12-23 06:15:37'),(3,0,'3',1,'',NULL,'2021-12-23 06:15:40','2021-12-23 06:15:40');
/*!40000 ALTER TABLE `french_lockers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_managers`
--

DROP TABLE IF EXISTS `french_managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_managers` (
  `mn_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mn_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mn_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mn_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mn_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mn_login_last` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mn_login_ip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mn_state` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`mn_no`),
  UNIQUE KEY `french_managers_mn_id_unique` (`mn_id`),
  KEY `french_managers_mn_id_index` (`mn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_managers`
--

LOCK TABLES `french_managers` WRITE;
/*!40000 ALTER TABLE `french_managers` DISABLE KEYS */;
INSERT INTO `french_managers` VALUES (1,'manager','$2y$10$XB3IXnSwLf6MXJU8Q19Xr.FI5PvSthTD/5TuRZvj5KpvU6fg0q.4S','관리자','enhatest','enhatest','','','Y',NULL,'2021-12-08 05:49:15','2022-01-04 02:57:06'),(36,'enhatest2','$2y$10$F4fBV4BW/Jzt8Jq7DME/h.KcKAVIT2KXfLFUQEO/kZCksVyKeKyEG','관리자2','enhatest2','01042040696','','','Y',NULL,'2021-12-08 06:05:42','2021-12-08 06:05:42'),(37,'enhatest3','$2y$10$4znfHq6PlYsJwlwOuv2pMuqaH/OIx9mma1zOfHXVFQW6xIYSrHLRC','관리자3','enhatest3','enhatest3','','','Y',NULL,'2021-12-08 06:16:01','2021-12-08 06:16:01');
/*!40000 ALTER TABLE `french_managers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_members`
--

DROP TABLE IF EXISTS `french_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_members` (
  `mb_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `mb_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '아이디',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '비밀번호',
  `mb_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '이름',
  `mb_sex` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT '성별',
  `mb_birth` date NOT NULL COMMENT '생년월일',
  `mb_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '이메일',
  `mb_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '핸드폰',
  `mb_login_last` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '마지막로그인',
  `mb_login_ip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '로그인IP',
  `mb_state` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '상태',
  `mb_tags` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '태그',
  `mb_memo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '메모',
  `mb_user` int(11) NOT NULL DEFAULT 0 COMMENT '은하회원번호',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`mb_no`),
  UNIQUE KEY `french_members_mb_no_unique` (`mb_no`),
  UNIQUE KEY `french_members_mb_id_unique` (`mb_id`),
  KEY `french_members_mb_id_index` (`mb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_members`
--

LOCK TABLES `french_members` WRITE;
/*!40000 ALTER TABLE `french_members` DISABLE KEYS */;
INSERT INTO `french_members` VALUES (1,'mb_61bd35d54ea62','','조현준1','A','0000-00-00','','','','','N','','',0,NULL,'2021-12-18 01:13:57','2021-12-18 01:13:57'),(2,'mb_61bd35e9344d5','','조현준2','A','0000-00-00','9exbuilder@naver.com','91042040696','','','N','','',0,NULL,'2021-12-18 01:14:17','2021-12-18 01:14:17'),(3,'mb_61bd35f1039d2','','조현준3','A','0000-00-00','9exbuilder@naver.com','91042040696','','','N','','',0,NULL,'2021-12-18 01:14:25','2021-12-18 01:14:25'),(4,'mb_61bd35f9dbc0c','','조현준4','A','0000-00-00','9exbuilder@naver.com','91042040696','','','N','','',0,NULL,'2021-12-18 01:14:33','2021-12-18 01:14:33'),(5,'mb_61bd38056a7fb','$2y$10$CVwOST.zLXEACnEr.aOfxurLkChQvC31OUz2QFDXZP7w/XCgaSdq.','조현준5','A','0000-00-00','9exbuilder@naver.com','91042040696','','','N','','',0,NULL,'2021-12-18 01:23:17','2021-12-18 01:23:17'),(6,'mb_61bd382b0e0a1','$2y$10$BH0nA2hqVY2qmLrgqKxCFOt8Bq.L6QnHODThYq8j618o5hHBXb99O','조현준6','A','0000-00-00','9exbuilder@naver.com','91042040696','','','N','','',0,'2021-12-18 05:34:03','2021-12-18 01:23:55','2021-12-18 05:34:03'),(7,'mb_61bd382c97470','$2y$10$TJU/ll7fL.eRrEzFfyACpeI/ReRxPeVpD0gyc..BldPXgeoEZFbrK','조현준7','A','0000-00-00','9exbuilder@naver.com','91042040696','','','N','','',0,'2021-12-18 05:33:59','2021-12-18 01:23:56','2021-12-18 05:33:59'),(8,'mb_61bd4b5b2c125','_','조현준8','A','0000-00-00','9exbuilder@naver.com','91042040696','','','N','','',0,'2021-12-18 05:33:56','2021-12-18 02:45:47','2021-12-18 05:33:56'),(9,'mb_61bd4c121e620','_','조현준1','A','0000-00-00','9exbuilder3@naver.com','0111111111','','','N','','xxxxxx',0,'2021-12-18 05:33:50','2021-12-18 02:48:50','2021-12-18 05:33:50'),(10,'mb_61c2c3ca9f43d','$2y$10$I2.j0VuJzZ6NPQsmSe35VOGJ13IdtMnAD47kmvy9vJa4uk1aSDca2','조현준21','A','1976-12-22','9exbuilder22@naver.com','910-4204-0696','','','N','B,C','메모당....',0,NULL,'2021-12-22 06:20:58','2021-12-22 06:20:58'),(11,'mb_61c2c539cc383','$2y$10$Hdmet664yVY6SUyYl5bLQeN1EGWk4JZ5dGwmbN34Mf969I8H2PU4m','조현준23','F','1976-12-22','exbuilder222@naver.com','010-4204-0691','','','N','A,C,C','메모는...',0,NULL,'2021-12-22 06:27:05','2021-12-22 06:27:05'),(12,'mb_61c2c76f34e66','$2y$10$3E./kjB427RxvUmgTGAHl.Pjbr3SmVpMiDK.kUHohxu6KmT/F5/lG','조현준25','M','2021-12-14','exbuilder5@naver.com','010-4204-1111','','','N','D','dddd',0,NULL,'2021-12-22 06:36:31','2021-12-22 06:36:31'),(13,'mb_61c2c7ca3e4c8','$2y$10$BgwvGgEfAAjY9Z5wOeSdHeBkbiVw/eV9YnMjVzrKZvQ2zGSYeK.TS','조현준67','M','2021-12-23','exbuilder@naver.com22','010-4204-333311','','','N','A','메모 메모....',0,NULL,'2021-12-22 06:38:02','2021-12-22 06:38:02'),(14,'mb_61c2d129939eb','$2y$10$yz2C8O5Ig/XBAQ7ClbvTxe9XkikEf3GyCBmo0.pDfn2Ue.H7KUTGK','조현준5511111112333','M','2021-12-22','exbuilder33@naver.com','910-4206-0696','','','N','A,D,E','dfhkldskjlf fasdf sdfds\r\nds fdsf \r\nsd\r\nf dssd f',0,NULL,'2021-12-22 07:18:01','2022-01-10 04:25:03'),(43,'mb_61dbd0a1bb17e','$2y$10$4e85mHQDabC5/JzqnYjW3OapUoxHUOXdtIChF4JA8MPQGq/RCO5yS','조현준','M','1976-09-20','exbuilder@naver.com','01042040696','','','N','A','ef sdf',0,NULL,'2022-01-10 06:22:25','2022-01-10 06:22:25'),(44,'mb_61dbd0a1bb150','$2y$10$GPFpBWonpYQ/.zXitqM84eDI56ioA6IqwbxxSntxWbCuqM8DOO2LG','조현준','M','1976-09-20','exbuilder@naver.com','01042040696','','','N','A','ef sdf',0,NULL,'2022-01-10 06:22:25','2022-01-10 06:22:25'),(45,'mb_61dc0ece92ed4','','원종오','M','0000-00-00','wind5785@naver.com','01057685785','','','N','D','',0,NULL,'2022-01-10 10:47:42','2022-01-10 10:47:42');
/*!40000 ALTER TABLE `french_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_product_orders`
--

DROP TABLE IF EXISTS `french_product_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_product_orders` (
  `o_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `o_partner` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '파트너번호',
  `o_member_from` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '회원구분',
  `o_member` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '회원',
  `o_member_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '회원명',
  `o_ageType` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT '연령타입',
  `o_device_from` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '구매디바이스구분',
  `o_room` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '룸',
  `o_seat` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '좌석',
  `o_seat_name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '좌석명',
  `o_seat_level` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '좌석등급',
  `o_product_kind` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT '상품종류',
  `o_product_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT '상품명',
  `o_duration` int(11) NOT NULL DEFAULT 0 COMMENT '기간',
  `o_duration_type` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '기간종류',
  `o_remainder_time` int(11) NOT NULL DEFAULT 0 COMMENT '잔여시간',
  `o_remainder_day` int(11) NOT NULL DEFAULT 0 COMMENT '잔여기간',
  `o_remainder_point` int(11) NOT NULL DEFAULT 0 COMMENT '잔여포인트',
  `o_sdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '시작일',
  `o_edate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '종료일',
  `o_price_seat` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '좌석금액',
  `o_locker_use` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '사물함사용여부',
  `o_locker` int(11) NOT NULL DEFAULT 0 COMMENT '사물함번호',
  `o_locker_name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '사물함명',
  `o_price_locker` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '사물함금액',
  `o_price_total` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '합계금액',
  `o_pay_point` int(11) NOT NULL DEFAULT 0 COMMENT '포인트사용금액',
  `o_pay_discount` int(11) NOT NULL DEFAULT 0 COMMENT '할인금액',
  `o_pay_money` int(11) NOT NULL DEFAULT 0 COMMENT '결제금액',
  `o_pay_kind` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LCASH' COMMENT '결제방법',
  `o_pay_state` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '결제상태',
  `o_pay_at` datetime NOT NULL COMMENT '결제일',
  `o_refund` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '환불여부',
  `o_refund_at` datetime NOT NULL COMMENT '환불요청일',
  `o_refund_price` datetime NOT NULL COMMENT '환불지급액(사용자)',
  `o_refund_money` datetime NOT NULL COMMENT '환불수급액(가맹점)',
  `o_refund_memo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '환불메모',
  `o_memo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '메모',
  `o_member_service` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '모바일회원',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`o_no`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_product_orders`
--

LOCK TABLES `french_product_orders` WRITE;
/*!40000 ALTER TABLE `french_product_orders` DISABLE KEYS */;
INSERT INTO `french_product_orders` VALUES (1,2,0,19,'안녕맨','A','A',0,0,'',0,'T','A',7,'',1,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',89518,'N',0,'',0,89518,0,0,89518,'LCASH','Y','2021-12-24 23:48:38','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2021-12-24 14:48:38','2021-12-29 12:08:06'),(2,2,0,19,'안녕맨','A','A',0,0,'',0,'D','A',5,'',0,2,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',64012,'N',0,'',0,64012,0,0,64012,'LCARD','Y','2021-12-24 23:48:58','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2021-12-24 14:48:58','2021-12-28 06:26:28'),(3,1,0,19,'안녕맨','A','A',0,0,'',0,'P','A',50000,'',0,0,50000,'0000-00-00 00:00:00','0000-00-00 00:00:00',64012,'N',0,'',0,64012,0,0,64012,'LCARD','Y','2021-12-24 23:49:14','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2021-12-24 14:49:14','2021-12-24 14:49:14'),(4,1,0,19,'안녕맨','A','A',0,0,'',0,'T','A',1,'T',1,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',13000,'N',0,'',0,13000,0,0,13000,'LCASH','Y','2021-12-28 16:04:42','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2021-12-28 07:04:42','2021-12-28 07:04:42'),(6,0,0,19,'조현준23','','A',0,0,'',0,'A','A',1,'D',0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',13000,'N',0,'',0,13000,0,0,13000,'LCARD','Y','2021-12-30 10:23:11','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2021-12-30 01:23:11','2022-01-10 07:33:44'),(7,0,0,12,'조현준25','S','A',0,0,'',0,'A','A',1,'D',0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',12000,'N',0,'',0,12000,0,0,12000,'LCARD','Y','2021-12-30 10:25:39','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2021-12-30 01:25:39','2021-12-30 01:26:01'),(8,0,0,11,'조현준23','A','A',0,0,'',0,'T','A',7,'T',0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',89518,'N',0,'',0,89518,0,0,89518,'LCARD','Y','2021-12-30 10:27:35','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2021-12-30 01:27:35','2021-12-30 07:16:57'),(9,0,0,11,'조현준23','A','A',0,0,'',0,'A','A',1,'D',0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',13000,'N',0,'',0,13000,0,0,13000,'LCARD','Y','2021-12-30 10:28:00','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2021-12-30 01:28:00','2021-12-30 01:28:00'),(10,0,0,11,'조현준23','A','A',0,0,'',0,'T','A',3,'T',0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',38506,'N',0,'',0,38506,0,0,38506,'LCASH','Y','2021-12-30 16:22:43','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2021-12-30 07:22:43','2022-01-10 06:49:06'),(11,0,0,12,'조현준25','S','A',0,0,'',0,'T','A',2,'T',2,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',59700,'N',0,'',0,59700,0,0,59700,'LCASH','Y','2022-01-07 14:44:38','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2022-01-07 05:44:38','2022-01-07 05:44:38'),(13,0,0,11,'조현준23','A','A',0,0,'',0,'D','A',9,'D',0,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',206816,'N',0,'',0,206816,0,0,206816,'LCASH','Y','2022-01-10 22:42:36','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2022-01-10 13:42:36','2022-01-10 13:42:36'),(14,0,0,11,'조현준23','A','A',0,0,'',0,'T','A',1,'T',0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',40000,'N',0,'',0,40000,0,0,40000,'LCASH','Y','2022-01-10 22:49:28','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2022-01-10 13:49:28','2022-01-10 21:19:16'),(15,0,0,11,'조현준23','A','A',0,0,'',0,'T','A',1,'T',1,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',40000,'N',0,'',0,40000,0,0,40000,'LCASH','Y','2022-01-11 06:17:15','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2022-01-10 21:17:15','2022-01-10 21:17:15'),(16,0,0,13,'조현준67','','A',0,0,'',0,'T','A',5,'T',3,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',10000,'N',0,'',0,10000,0,0,10000,'LCASH','Y','2022-02-11 10:19:53','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2022-02-11 01:19:53','2022-02-11 01:20:46'),(17,0,0,44,'조현준','A','A',0,0,'',0,'D','A',9,'D',0,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',206816,'N',0,'',0,206816,0,0,206816,'LCASH','Y','2022-02-14 10:57:17','N','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','',0,NULL,'2022-02-14 01:57:17','2022-02-14 06:32:12');
/*!40000 ALTER TABLE `french_product_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_products`
--

DROP TABLE IF EXISTS `french_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_products` (
  `prd_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `prd_A` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '하루이용권',
  `prd_T` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '시간권',
  `prd_D` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '기간',
  `prd_F` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '고정',
  `prd_P` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '포인트',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`prd_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_products`
--

LOCK TABLES `french_products` WRITE;
/*!40000 ALTER TABLE `french_products` DISABLE KEYS */;
INSERT INTO `french_products` VALUES (1,'','1,3,5','1,5,9','1,3,5','10000,30000,50000',NULL,'2022-01-05 02:17:38','2022-01-10 10:49:42');
/*!40000 ALTER TABLE `french_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_reserv_seats`
--

DROP TABLE IF EXISTS `french_reserv_seats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_reserv_seats` (
  `rv_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `rv_partner` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '파트너번호',
  `rv_order` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '구매번호',
  `rv_member_from` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '회원구분',
  `rv_member` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '회원',
  `rv_member_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '회원명',
  `rv_ageType` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT '연령타입',
  `rv_sex` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT '성별',
  `rv_device_from` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '구매디바이스구분',
  `rv_room` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '룸',
  `rv_seat` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '좌석',
  `rv_seat_name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '좌석명',
  `rv_seat_level` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '좌석등급',
  `rv_product_kind` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT '상품종류',
  `rv_product_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT '상품명',
  `rv_duration` int(11) NOT NULL DEFAULT 0 COMMENT '기간',
  `rv_duration_type` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '기간종류',
  `rv_type` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'C' COMMENT '예약여부',
  `rv_sdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '시작일',
  `rv_edate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '종료일',
  `rv_state` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'R' COMMENT '상태',
  `rv_state_seat` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '상태',
  `rv_state_seat_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '입실일시',
  `rv_state_seat_out` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '외출일시',
  `rv_calc` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '정산여부',
  `rv_calc_dt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '정산일',
  `rv_memo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '메모',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rv_no`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_reserv_seats`
--

LOCK TABLES `french_reserv_seats` WRITE;
/*!40000 ALTER TABLE `french_reserv_seats` DISABLE KEYS */;
INSERT INTO `french_reserv_seats` VALUES (27,2,1,0,11,'조현준23','A','F','A',45,11,'',0,'','',4,'T','C','2021-12-29 12:18:24','2021-12-29 20:13:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2021-12-28 07:19:10','2021-12-28 07:19:10'),(28,2,5,0,11,'조현준23','A','F','A',45,11,'',0,'','',0,'T','C','2021-12-29 21:23:13','2021-12-29 23:59:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2021-12-28 13:14:01','2021-12-28 13:14:01'),(29,2,1,0,11,'조현준23','A','F','A',45,11,'',0,'','',2,'T','C','2021-12-29 02:00:00','2021-12-29 03:55:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2021-12-29 12:08:06','2021-12-29 12:08:06'),(37,2,7,0,12,'조현준25','S','M','A',45,1,'',0,'','',1,'D','C','2021-12-30 10:25:43','2021-12-30 23:59:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2021-12-30 01:26:01','2021-12-30 01:26:01'),(38,2,8,0,11,'조현준23','A','F','A',45,1,'',0,'','',1,'T','C','2021-12-30 09:00:00','2021-12-30 09:55:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2021-12-30 04:15:38','2021-12-30 04:15:38'),(39,0,8,0,11,'조현준23','A','F','A',45,1,'',0,'','',4,'T','C','2021-12-30 04:00:00','2021-12-30 07:55:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2021-12-30 05:44:29','2021-12-30 05:44:29'),(40,0,8,0,11,'조현준23','A','F','A',45,1,'',0,'','',2,'T','C','2021-12-30 01:00:00','2021-12-30 02:55:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2021-12-30 07:16:57','2021-12-30 07:16:57'),(41,0,10,0,11,'조현준23','A','F','A',45,1,'',0,'','',3,'T','C','2022-01-10 07:00:00','2022-01-10 09:55:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2022-01-10 06:49:06','2022-01-10 06:49:06'),(42,0,6,0,11,'조현준23','A','F','A',45,1,'',0,'','',1,'D','C','2022-01-10 16:33:32','2022-01-10 23:59:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2022-01-10 07:33:44','2022-01-10 07:33:44'),(43,0,14,0,11,'조현준23','A','F','A',45,6,'',0,'','',1,'T','C','2022-01-11 04:00:00','2022-01-11 07:11:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2022-01-10 21:19:16','2022-01-10 21:19:16'),(44,0,16,0,13,'조현준67','S','M','A',45,1,'',0,'','',2,'T','C','2022-02-11 10:18:04','2022-02-11 12:13:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2022-02-11 01:20:46','2022-02-11 01:20:46'),(45,0,17,0,44,'조현준','A','M','A',45,2,'',0,'','',2,'D','C','2022-02-14 11:24:09','2022-02-16 11:24:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2022-02-14 02:28:13','2022-02-14 02:28:13'),(46,0,17,0,44,'조현준','A','M','A',45,2,'',0,'','',1,'D','C','2022-02-14 05:00:00','2022-02-14 23:59:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2022-02-14 05:26:17','2022-02-14 05:26:17'),(47,0,17,0,44,'조현준','A','M','A',45,3,'',0,'','',1,'D','C','2022-02-14 05:00:00','2022-02-14 23:59:00','A','','0000-00-00 00:00:00','0000-00-00 00:00:00','N','0000-00-00 00:00:00','',NULL,'2022-02-14 06:32:12','2022-02-14 06:32:12');
/*!40000 ALTER TABLE `french_reserv_seats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_rooms`
--

DROP TABLE IF EXISTS `french_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_rooms` (
  `r_no` int(11) NOT NULL AUTO_INCREMENT,
  `r_partner` int(11) NOT NULL DEFAULT 0,
  `r_bg` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `r_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `r_seat_count` int(11) NOT NULL DEFAULT 0,
  `r_state_mobile` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `r_state_kiosk` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `r_sex` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `r_map` text COLLATE utf8mb4_unicode_ci DEFAULT '',
  `r_type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'R',
  `r_iot1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `r_iot2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `r_iot3` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `r_iot4` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`r_no`),
  KEY `r_partner` (`r_partner`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_rooms`
--

LOCK TABLES `french_rooms` WRITE;
/*!40000 ALTER TABLE `french_rooms` DISABLE KEYS */;
INSERT INTO `french_rooms` VALUES (1,0,'','에이룸',10,'Y','Y','M','','D','1233','1234','1235','1236','2021-12-14 03:21:44','2021-12-14 03:21:44',NULL),(41,0,'','둘째룸',10,'Y','Y','A','','','1','2','3','4','2021-12-14 04:35:29','2021-12-14 04:35:29',NULL),(42,0,'','세번째룸',10,'Y','Y','A','','D','111','222','333','444','2021-12-14 05:12:07','2021-12-14 05:12:07',NULL),(45,0,'','네번째룸',15,'Y','N','A','','D','1','2','3','4','2021-12-14 05:28:42','2021-12-14 06:28:27',NULL),(48,0,'','요런룸...',20,'Y','N','A','','D','','','','','2021-12-15 05:31:03','2021-12-15 05:31:03',NULL);
/*!40000 ALTER TABLE `french_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_seat_levels`
--

DROP TABLE IF EXISTS `french_seat_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_seat_levels` (
  `sl_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `sl_partner` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '가맹점번호',
  `sl_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '구분명',
  `sl_type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S' COMMENT '타입',
  `sl_price_time` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '\'' COMMENT '시간금액정보',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sl_price_day` text COLLATE utf8mb4_unicode_ci DEFAULT 'NULL' COMMENT '일별금액정보',
  `sl_rate_student_time` float(5,2) NOT NULL DEFAULT 0.00,
  `sl_rate_student_day` float(5,2) NOT NULL DEFAULT 0.00,
  `sl_rate_adult_time` float(5,2) NOT NULL DEFAULT 0.00,
  `sl_rate_adult_day` float(5,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`sl_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_seat_levels`
--

LOCK TABLES `french_seat_levels` WRITE;
/*!40000 ALTER TABLE `french_seat_levels` DISABLE KEYS */;
INSERT INTO `french_seat_levels` VALUES (1,0,'기본','S','{\"1\":{\"S\":{\"A\":{\"T\":\"10000\",\"R\":\"9000\",\"S\":\"1000\"},\"N\":{\"T\":\"12000\",\"R\":\"11000\",\"S\":\"1000\"},\"X\":{\"T\":\"14000\",\"R\":\"13000\",\"S\":\"1000\"}},\"A\":{\"A\":{\"T\":\"11000\",\"R\":\"11000\",\"S\":\"11000\"},\"N\":{\"T\":\"13000\",\"R\":\"12000\",\"S\":\"1000\"},\"X\":{\"T\":\"15000\",\"R\":\"14000\",\"S\":\"1000\"}}},\"2\":{\"S\":{\"A\":{\"T\":\"19880\",\"R\":\"17892\",\"S\":\"1988\"},\"N\":{\"T\":\"23856\",\"R\":\"21868\",\"S\":\"1988\"},\"X\":{\"T\":\"27832\",\"R\":\"25844\",\"S\":\"1988\"}},\"A\":{\"A\":{\"T\":\"21791\",\"R\":\"21791\",\"S\":\"21791\"},\"N\":{\"T\":\"25753\",\"R\":\"23772\",\"S\":\"1981\"},\"X\":{\"T\":\"29715\",\"R\":\"27734\",\"S\":\"1981\"}}},\"3\":{\"S\":{\"A\":{\"T\":\"29760\",\"R\":\"26784\",\"S\":\"2976\"},\"N\":{\"T\":\"35712\",\"R\":\"32736\",\"S\":\"2976\"},\"X\":{\"T\":\"41664\",\"R\":\"38688\",\"S\":\"2976\"}},\"A\":{\"A\":{\"T\":\"32582\",\"R\":\"32582\",\"S\":\"32582\"},\"N\":{\"T\":\"38506\",\"R\":\"35544\",\"S\":\"2962\"},\"X\":{\"T\":\"44430\",\"R\":\"41468\",\"S\":\"2962\"}}},\"4\":{\"S\":{\"A\":{\"T\":\"39640\",\"R\":\"35676\",\"S\":\"3964\"},\"N\":{\"T\":\"47568\",\"R\":\"43604\",\"S\":\"3964\"},\"X\":{\"T\":\"55496\",\"R\":\"51532\",\"S\":\"3964\"}},\"A\":{\"A\":{\"T\":\"43373\",\"R\":\"43373\",\"S\":\"43373\"},\"N\":{\"T\":\"51259\",\"R\":\"47316\",\"S\":\"3943\"},\"X\":{\"T\":\"59145\",\"R\":\"55202\",\"S\":\"3943\"}}},\"5\":{\"S\":{\"A\":{\"T\":\"49520\",\"R\":\"44568\",\"S\":\"4952\"},\"N\":{\"T\":\"59424\",\"R\":\"54472\",\"S\":\"4952\"},\"X\":{\"T\":\"69328\",\"R\":\"64376\",\"S\":\"4952\"}},\"A\":{\"A\":{\"T\":\"54164\",\"R\":\"54164\",\"S\":\"54164\"},\"N\":{\"T\":\"64012\",\"R\":\"59088\",\"S\":\"4924\"},\"X\":{\"T\":\"73860\",\"R\":\"68936\",\"S\":\"4924\"}}},\"6\":{\"S\":{\"A\":{\"T\":\"59400\",\"R\":\"53460\",\"S\":\"5940\"},\"N\":{\"T\":\"71280\",\"R\":\"65340\",\"S\":\"5940\"},\"X\":{\"T\":\"83160\",\"R\":\"77220\",\"S\":\"5940\"}},\"A\":{\"A\":{\"T\":\"64955\",\"R\":\"64955\",\"S\":\"64955\"},\"N\":{\"T\":\"76765\",\"R\":\"70860\",\"S\":\"5905\"},\"X\":{\"T\":\"88575\",\"R\":\"82670\",\"S\":\"5905\"}}},\"7\":{\"S\":{\"A\":{\"T\":\"69280\",\"R\":\"62352\",\"S\":\"6928\"},\"N\":{\"T\":\"83136\",\"R\":\"76208\",\"S\":\"6928\"},\"X\":{\"T\":\"96992\",\"R\":\"90064\",\"S\":\"6928\"}},\"A\":{\"A\":{\"T\":\"75746\",\"R\":\"75746\",\"S\":\"75746\"},\"N\":{\"T\":\"89518\",\"R\":\"82632\",\"S\":\"6886\"},\"X\":{\"T\":\"103290\",\"R\":\"96404\",\"S\":\"6886\"}}},\"8\":{\"S\":{\"A\":{\"T\":\"79160\",\"R\":\"71244\",\"S\":\"7916\"},\"N\":{\"T\":\"94992\",\"R\":\"87076\",\"S\":\"7916\"},\"X\":{\"T\":\"110824\",\"R\":\"102908\",\"S\":\"7916\"}},\"A\":{\"A\":{\"T\":\"86537\",\"R\":\"86537\",\"S\":\"86537\"},\"N\":{\"T\":\"102271\",\"R\":\"94404\",\"S\":\"7867\"},\"X\":{\"T\":\"118005\",\"R\":\"110138\",\"S\":\"7867\"}}},\"9\":{\"S\":{\"A\":{\"T\":\"89040\",\"R\":\"80136\",\"S\":\"8904\"},\"N\":{\"T\":\"106848\",\"R\":\"97944\",\"S\":\"8904\"},\"X\":{\"T\":\"124656\",\"R\":\"115752\",\"S\":\"8904\"}},\"A\":{\"A\":{\"T\":\"97328\",\"R\":\"97328\",\"S\":\"97328\"},\"N\":{\"T\":\"115024\",\"R\":\"106176\",\"S\":\"8848\"},\"X\":{\"T\":\"132720\",\"R\":\"123872\",\"S\":\"8848\"}}},\"10\":{\"S\":{\"A\":{\"T\":\"98920\",\"R\":\"89028\",\"S\":\"9892\"},\"N\":{\"T\":\"118704\",\"R\":\"108812\",\"S\":\"9892\"},\"X\":{\"T\":\"138488\",\"R\":\"128596\",\"S\":\"9892\"}},\"A\":{\"A\":{\"T\":\"108119\",\"R\":\"108119\",\"S\":\"108119\"},\"N\":{\"T\":\"127777\",\"R\":\"117948\",\"S\":\"9829\"},\"X\":{\"T\":\"147435\",\"R\":\"137606\",\"S\":\"9829\"}}},\"11\":{\"S\":{\"A\":{\"T\":\"108800\",\"R\":\"97920\",\"S\":\"10880\"},\"N\":{\"T\":\"130560\",\"R\":\"119680\",\"S\":\"10880\"},\"X\":{\"T\":\"152320\",\"R\":\"141440\",\"S\":\"10880\"}},\"A\":{\"A\":{\"T\":\"118910\",\"R\":\"118910\",\"S\":\"118910\"},\"N\":{\"T\":\"140530\",\"R\":\"129720\",\"S\":\"10810\"},\"X\":{\"T\":\"162150\",\"R\":\"151340\",\"S\":\"10810\"}}},\"12\":{\"S\":{\"A\":{\"T\":\"118680\",\"R\":\"106812\",\"S\":\"11868\"},\"N\":{\"T\":\"142416\",\"R\":\"130548\",\"S\":\"11868\"},\"X\":{\"T\":\"166152\",\"R\":\"154284\",\"S\":\"11868\"}},\"A\":{\"A\":{\"T\":\"129701\",\"R\":\"129701\",\"S\":\"129701\"},\"N\":{\"T\":\"153283\",\"R\":\"141492\",\"S\":\"11791\"},\"X\":{\"T\":\"176865\",\"R\":\"165074\",\"S\":\"11791\"}}},\"13\":{\"S\":{\"A\":{\"T\":\"128560\",\"R\":\"115704\",\"S\":\"12856\"},\"N\":{\"T\":\"154272\",\"R\":\"141416\",\"S\":\"12856\"},\"X\":{\"T\":\"179984\",\"R\":\"167128\",\"S\":\"12856\"}},\"A\":{\"A\":{\"T\":\"140492\",\"R\":\"140492\",\"S\":\"140492\"},\"N\":{\"T\":\"166036\",\"R\":\"153264\",\"S\":\"12772\"},\"X\":{\"T\":\"191580\",\"R\":\"178808\",\"S\":\"12772\"}}},\"14\":{\"S\":{\"A\":{\"T\":\"138440\",\"R\":\"124596\",\"S\":\"13844\"},\"N\":{\"T\":\"166128\",\"R\":\"152284\",\"S\":\"13844\"},\"X\":{\"T\":\"193816\",\"R\":\"179972\",\"S\":\"13844\"}},\"A\":{\"A\":{\"T\":\"151283\",\"R\":\"151283\",\"S\":\"151283\"},\"N\":{\"T\":\"178789\",\"R\":\"165036\",\"S\":\"13753\"},\"X\":{\"T\":\"206295\",\"R\":\"192542\",\"S\":\"13753\"}}},\"15\":{\"S\":{\"A\":{\"T\":\"148320\",\"R\":\"133488\",\"S\":\"14832\"},\"N\":{\"T\":\"177984\",\"R\":\"163152\",\"S\":\"14832\"},\"X\":{\"T\":\"207648\",\"R\":\"192816\",\"S\":\"14832\"}},\"A\":{\"A\":{\"T\":\"162074\",\"R\":\"162074\",\"S\":\"162074\"},\"N\":{\"T\":\"191542\",\"R\":\"176808\",\"S\":\"14734\"},\"X\":{\"T\":\"221010\",\"R\":\"206276\",\"S\":\"14734\"}}},\"16\":{\"S\":{\"A\":{\"T\":\"158200\",\"R\":\"142380\",\"S\":\"15820\"},\"N\":{\"T\":\"189840\",\"R\":\"174020\",\"S\":\"15820\"},\"X\":{\"T\":\"221480\",\"R\":\"205660\",\"S\":\"15820\"}},\"A\":{\"A\":{\"T\":\"172865\",\"R\":\"172865\",\"S\":\"172865\"},\"N\":{\"T\":\"204295\",\"R\":\"188580\",\"S\":\"15715\"},\"X\":{\"T\":\"235725\",\"R\":\"220010\",\"S\":\"15715\"}}},\"17\":{\"S\":{\"A\":{\"T\":\"168080\",\"R\":\"151272\",\"S\":\"16808\"},\"N\":{\"T\":\"201696\",\"R\":\"184888\",\"S\":\"16808\"},\"X\":{\"T\":\"235312\",\"R\":\"218504\",\"S\":\"16808\"}},\"A\":{\"A\":{\"T\":\"183656\",\"R\":\"183656\",\"S\":\"183656\"},\"N\":{\"T\":\"217048\",\"R\":\"200352\",\"S\":\"16696\"},\"X\":{\"T\":\"250440\",\"R\":\"233744\",\"S\":\"16696\"}}},\"18\":{\"S\":{\"A\":{\"T\":\"177960\",\"R\":\"160164\",\"S\":\"17796\"},\"N\":{\"T\":\"213552\",\"R\":\"195756\",\"S\":\"17796\"},\"X\":{\"T\":\"249144\",\"R\":\"231348\",\"S\":\"17796\"}},\"A\":{\"A\":{\"T\":\"194447\",\"R\":\"194447\",\"S\":\"194447\"},\"N\":{\"T\":\"229801\",\"R\":\"212124\",\"S\":\"17677\"},\"X\":{\"T\":\"265155\",\"R\":\"247478\",\"S\":\"17677\"}}},\"19\":{\"S\":{\"A\":{\"T\":\"187840\",\"R\":\"169056\",\"S\":\"18784\"},\"N\":{\"T\":\"225408\",\"R\":\"206624\",\"S\":\"18784\"},\"X\":{\"T\":\"262976\",\"R\":\"244192\",\"S\":\"18784\"}},\"A\":{\"A\":{\"T\":\"205238\",\"R\":\"205238\",\"S\":\"205238\"},\"N\":{\"T\":\"242554\",\"R\":\"223896\",\"S\":\"18658\"},\"X\":{\"T\":\"279870\",\"R\":\"261212\",\"S\":\"18658\"}}},\"20\":{\"S\":{\"A\":{\"T\":\"197720\",\"R\":\"177948\",\"S\":\"19772\"},\"N\":{\"T\":\"237264\",\"R\":\"217492\",\"S\":\"19772\"},\"X\":{\"T\":\"276808\",\"R\":\"257036\",\"S\":\"19772\"}},\"A\":{\"A\":{\"T\":\"216029\",\"R\":\"216029\",\"S\":\"216029\"},\"N\":{\"T\":\"255307\",\"R\":\"235668\",\"S\":\"19639\"},\"X\":{\"T\":\"294585\",\"R\":\"274946\",\"S\":\"19639\"}}},\"21\":{\"S\":{\"A\":{\"T\":\"207600\",\"R\":\"186840\",\"S\":\"20760\"},\"N\":{\"T\":\"249120\",\"R\":\"228360\",\"S\":\"20760\"},\"X\":{\"T\":\"290640\",\"R\":\"269880\",\"S\":\"20760\"}},\"A\":{\"A\":{\"T\":\"226820\",\"R\":\"226820\",\"S\":\"226820\"},\"N\":{\"T\":\"268060\",\"R\":\"247440\",\"S\":\"20620\"},\"X\":{\"T\":\"309300\",\"R\":\"288680\",\"S\":\"20620\"}}},\"22\":{\"S\":{\"A\":{\"T\":\"217480\",\"R\":\"195732\",\"S\":\"21748\"},\"N\":{\"T\":\"260976\",\"R\":\"239228\",\"S\":\"21748\"},\"X\":{\"T\":\"304472\",\"R\":\"282724\",\"S\":\"21748\"}},\"A\":{\"A\":{\"T\":\"237611\",\"R\":\"237611\",\"S\":\"237611\"},\"N\":{\"T\":\"280813\",\"R\":\"259212\",\"S\":\"21601\"},\"X\":{\"T\":\"324015\",\"R\":\"302414\",\"S\":\"21601\"}}},\"23\":{\"S\":{\"A\":{\"T\":\"227360\",\"R\":\"204624\",\"S\":\"22736\"},\"N\":{\"T\":\"272832\",\"R\":\"250096\",\"S\":\"22736\"},\"X\":{\"T\":\"318304\",\"R\":\"295568\",\"S\":\"22736\"}},\"A\":{\"A\":{\"T\":\"248402\",\"R\":\"248402\",\"S\":\"248402\"},\"N\":{\"T\":\"293566\",\"R\":\"270984\",\"S\":\"22582\"},\"X\":{\"T\":\"338730\",\"R\":\"316148\",\"S\":\"22582\"}}}}',NULL,'2021-12-09 01:58:29','2022-01-10 10:52:27','{\"1\":{\"S\":{\"A\":{\"T\":\"3\",\"R\":\"2\",\"S\":\"1\"},\"N\":{\"T\":\"3\",\"R\":\"2\",\"S\":\"1\"},\"X\":{\"T\":\"3\",\"R\":\"2\",\"S\":\"1\"}},\"A\":{\"A\":{\"T\":\"3\",\"R\":\"3\",\"S\":\"3\"},\"N\":{\"T\":\"3\",\"R\":\"2\",\"S\":\"1\"},\"X\":{\"T\":\"3\",\"R\":\"2\",\"S\":\"1\"}}},\"2\":{\"S\":{\"A\":{\"T\":\"6\",\"R\":\"4\",\"S\":\"2\"},\"N\":{\"T\":\"6\",\"R\":\"4\",\"S\":\"2\"},\"X\":{\"T\":\"6\",\"R\":\"4\",\"S\":\"2\"}},\"A\":{\"A\":{\"T\":\"6\",\"R\":\"6\",\"S\":\"6\"},\"N\":{\"T\":\"6\",\"R\":\"4\",\"S\":\"2\"},\"X\":{\"T\":\"6\",\"R\":\"4\",\"S\":\"2\"}}},\"3\":{\"S\":{\"A\":{\"T\":\"9\",\"R\":\"6\",\"S\":\"3\"},\"N\":{\"T\":\"9\",\"R\":\"6\",\"S\":\"3\"},\"X\":{\"T\":\"9\",\"R\":\"6\",\"S\":\"3\"}},\"A\":{\"A\":{\"T\":\"9\",\"R\":\"9\",\"S\":\"9\"},\"N\":{\"T\":\"9\",\"R\":\"6\",\"S\":\"3\"},\"X\":{\"T\":\"9\",\"R\":\"6\",\"S\":\"3\"}}},\"4\":{\"S\":{\"A\":{\"T\":\"12\",\"R\":\"8\",\"S\":\"4\"},\"N\":{\"T\":\"12\",\"R\":\"8\",\"S\":\"4\"},\"X\":{\"T\":\"12\",\"R\":\"8\",\"S\":\"4\"}},\"A\":{\"A\":{\"T\":\"12\",\"R\":\"12\",\"S\":\"12\"},\"N\":{\"T\":\"12\",\"R\":\"8\",\"S\":\"4\"},\"X\":{\"T\":\"12\",\"R\":\"8\",\"S\":\"4\"}}},\"5\":{\"S\":{\"A\":{\"T\":\"15\",\"R\":\"10\",\"S\":\"5\"},\"N\":{\"T\":\"15\",\"R\":\"10\",\"S\":\"5\"},\"X\":{\"T\":\"15\",\"R\":\"10\",\"S\":\"5\"}},\"A\":{\"A\":{\"T\":\"15\",\"R\":\"15\",\"S\":\"15\"},\"N\":{\"T\":\"15\",\"R\":\"10\",\"S\":\"5\"},\"X\":{\"T\":\"15\",\"R\":\"10\",\"S\":\"5\"}}},\"6\":{\"S\":{\"A\":{\"T\":\"18\",\"R\":\"12\",\"S\":\"6\"},\"N\":{\"T\":\"18\",\"R\":\"12\",\"S\":\"6\"},\"X\":{\"T\":\"18\",\"R\":\"12\",\"S\":\"6\"}},\"A\":{\"A\":{\"T\":\"18\",\"R\":\"18\",\"S\":\"18\"},\"N\":{\"T\":\"18\",\"R\":\"12\",\"S\":\"6\"},\"X\":{\"T\":\"18\",\"R\":\"12\",\"S\":\"6\"}}},\"7\":{\"S\":{\"A\":{\"T\":\"21\",\"R\":\"14\",\"S\":\"7\"},\"N\":{\"T\":\"21\",\"R\":\"14\",\"S\":\"7\"},\"X\":{\"T\":\"21\",\"R\":\"14\",\"S\":\"7\"}},\"A\":{\"A\":{\"T\":\"21\",\"R\":\"21\",\"S\":\"21\"},\"N\":{\"T\":\"21\",\"R\":\"14\",\"S\":\"7\"},\"X\":{\"T\":\"21\",\"R\":\"14\",\"S\":\"7\"}}},\"8\":{\"S\":{\"A\":{\"T\":\"24\",\"R\":\"16\",\"S\":\"8\"},\"N\":{\"T\":\"24\",\"R\":\"16\",\"S\":\"8\"},\"X\":{\"T\":\"24\",\"R\":\"16\",\"S\":\"8\"}},\"A\":{\"A\":{\"T\":\"24\",\"R\":\"24\",\"S\":\"24\"},\"N\":{\"T\":\"24\",\"R\":\"16\",\"S\":\"8\"},\"X\":{\"T\":\"24\",\"R\":\"16\",\"S\":\"8\"}}},\"9\":{\"S\":{\"A\":{\"T\":\"27\",\"R\":\"18\",\"S\":\"9\"},\"N\":{\"T\":\"27\",\"R\":\"18\",\"S\":\"9\"},\"X\":{\"T\":\"27\",\"R\":\"18\",\"S\":\"9\"}},\"A\":{\"A\":{\"T\":\"27\",\"R\":\"27\",\"S\":\"27\"},\"N\":{\"T\":\"27\",\"R\":\"18\",\"S\":\"9\"},\"X\":{\"T\":\"27\",\"R\":\"18\",\"S\":\"9\"}}},\"10\":{\"S\":{\"A\":{\"T\":\"30\",\"R\":\"20\",\"S\":\"10\"},\"N\":{\"T\":\"30\",\"R\":\"20\",\"S\":\"10\"},\"X\":{\"T\":\"30\",\"R\":\"20\",\"S\":\"10\"}},\"A\":{\"A\":{\"T\":\"30\",\"R\":\"30\",\"S\":\"30\"},\"N\":{\"T\":\"30\",\"R\":\"20\",\"S\":\"10\"},\"X\":{\"T\":\"30\",\"R\":\"20\",\"S\":\"10\"}}},\"11\":{\"S\":{\"A\":{\"T\":\"33\",\"R\":\"22\",\"S\":\"11\"},\"N\":{\"T\":\"33\",\"R\":\"22\",\"S\":\"11\"},\"X\":{\"T\":\"33\",\"R\":\"22\",\"S\":\"11\"}},\"A\":{\"A\":{\"T\":\"33\",\"R\":\"33\",\"S\":\"33\"},\"N\":{\"T\":\"33\",\"R\":\"22\",\"S\":\"11\"},\"X\":{\"T\":\"33\",\"R\":\"22\",\"S\":\"11\"}}},\"12\":{\"S\":{\"A\":{\"T\":\"36\",\"R\":\"24\",\"S\":\"12\"},\"N\":{\"T\":\"36\",\"R\":\"24\",\"S\":\"12\"},\"X\":{\"T\":\"36\",\"R\":\"24\",\"S\":\"12\"}},\"A\":{\"A\":{\"T\":\"36\",\"R\":\"36\",\"S\":\"36\"},\"N\":{\"T\":\"36\",\"R\":\"24\",\"S\":\"12\"},\"X\":{\"T\":\"36\",\"R\":\"24\",\"S\":\"12\"}}},\"13\":{\"S\":{\"A\":{\"T\":\"39\",\"R\":\"26\",\"S\":\"13\"},\"N\":{\"T\":\"39\",\"R\":\"26\",\"S\":\"13\"},\"X\":{\"T\":\"39\",\"R\":\"26\",\"S\":\"13\"}},\"A\":{\"A\":{\"T\":\"39\",\"R\":\"39\",\"S\":\"39\"},\"N\":{\"T\":\"39\",\"R\":\"26\",\"S\":\"13\"},\"X\":{\"T\":\"39\",\"R\":\"26\",\"S\":\"13\"}}},\"14\":{\"S\":{\"A\":{\"T\":\"42\",\"R\":\"28\",\"S\":\"14\"},\"N\":{\"T\":\"42\",\"R\":\"28\",\"S\":\"14\"},\"X\":{\"T\":\"42\",\"R\":\"28\",\"S\":\"14\"}},\"A\":{\"A\":{\"T\":\"42\",\"R\":\"42\",\"S\":\"42\"},\"N\":{\"T\":\"42\",\"R\":\"28\",\"S\":\"14\"},\"X\":{\"T\":\"42\",\"R\":\"28\",\"S\":\"14\"}}},\"15\":{\"S\":{\"A\":{\"T\":\"45\",\"R\":\"30\",\"S\":\"15\"},\"N\":{\"T\":\"45\",\"R\":\"30\",\"S\":\"15\"},\"X\":{\"T\":\"45\",\"R\":\"30\",\"S\":\"15\"}},\"A\":{\"A\":{\"T\":\"45\",\"R\":\"45\",\"S\":\"45\"},\"N\":{\"T\":\"45\",\"R\":\"30\",\"S\":\"15\"},\"X\":{\"T\":\"45\",\"R\":\"30\",\"S\":\"15\"}}},\"16\":{\"S\":{\"A\":{\"T\":\"48\",\"R\":\"32\",\"S\":\"16\"},\"N\":{\"T\":\"48\",\"R\":\"32\",\"S\":\"16\"},\"X\":{\"T\":\"48\",\"R\":\"32\",\"S\":\"16\"}},\"A\":{\"A\":{\"T\":\"48\",\"R\":\"48\",\"S\":\"48\"},\"N\":{\"T\":\"48\",\"R\":\"32\",\"S\":\"16\"},\"X\":{\"T\":\"48\",\"R\":\"32\",\"S\":\"16\"}}},\"17\":{\"S\":{\"A\":{\"T\":\"51\",\"R\":\"34\",\"S\":\"17\"},\"N\":{\"T\":\"51\",\"R\":\"34\",\"S\":\"17\"},\"X\":{\"T\":\"51\",\"R\":\"34\",\"S\":\"17\"}},\"A\":{\"A\":{\"T\":\"51\",\"R\":\"51\",\"S\":\"51\"},\"N\":{\"T\":\"51\",\"R\":\"34\",\"S\":\"17\"},\"X\":{\"T\":\"51\",\"R\":\"34\",\"S\":\"17\"}}},\"18\":{\"S\":{\"A\":{\"T\":\"53\",\"R\":\"36\",\"S\":\"18\"},\"N\":{\"T\":\"53\",\"R\":\"36\",\"S\":\"18\"},\"X\":{\"T\":\"53\",\"R\":\"36\",\"S\":\"18\"}},\"A\":{\"A\":{\"T\":\"54\",\"R\":\"54\",\"S\":\"54\"},\"N\":{\"T\":\"54\",\"R\":\"36\",\"S\":\"18\"},\"X\":{\"T\":\"54\",\"R\":\"36\",\"S\":\"18\"}}},\"19\":{\"S\":{\"A\":{\"T\":\"56\",\"R\":\"38\",\"S\":\"19\"},\"N\":{\"T\":\"56\",\"R\":\"38\",\"S\":\"19\"},\"X\":{\"T\":\"56\",\"R\":\"38\",\"S\":\"19\"}},\"A\":{\"A\":{\"T\":\"57\",\"R\":\"57\",\"S\":\"57\"},\"N\":{\"T\":\"57\",\"R\":\"38\",\"S\":\"19\"},\"X\":{\"T\":\"57\",\"R\":\"38\",\"S\":\"19\"}}},\"20\":{\"S\":{\"A\":{\"T\":\"59\",\"R\":\"40\",\"S\":\"20\"},\"N\":{\"T\":\"59\",\"R\":\"40\",\"S\":\"20\"},\"X\":{\"T\":\"59\",\"R\":\"40\",\"S\":\"20\"}},\"A\":{\"A\":{\"T\":\"60\",\"R\":\"60\",\"S\":\"60\"},\"N\":{\"T\":\"60\",\"R\":\"40\",\"S\":\"20\"},\"X\":{\"T\":\"60\",\"R\":\"40\",\"S\":\"20\"}}},\"21\":{\"S\":{\"A\":{\"T\":\"62\",\"R\":\"42\",\"S\":\"21\"},\"N\":{\"T\":\"62\",\"R\":\"42\",\"S\":\"21\"},\"X\":{\"T\":\"62\",\"R\":\"42\",\"S\":\"21\"}},\"A\":{\"A\":{\"T\":\"63\",\"R\":\"63\",\"S\":\"63\"},\"N\":{\"T\":\"63\",\"R\":\"42\",\"S\":\"21\"},\"X\":{\"T\":\"63\",\"R\":\"42\",\"S\":\"21\"}}},\"22\":{\"S\":{\"A\":{\"T\":\"65\",\"R\":\"44\",\"S\":\"22\"},\"N\":{\"T\":\"65\",\"R\":\"44\",\"S\":\"22\"},\"X\":{\"T\":\"65\",\"R\":\"44\",\"S\":\"22\"}},\"A\":{\"A\":{\"T\":\"66\",\"R\":\"66\",\"S\":\"66\"},\"N\":{\"T\":\"66\",\"R\":\"44\",\"S\":\"22\"},\"X\":{\"T\":\"66\",\"R\":\"44\",\"S\":\"22\"}}},\"23\":{\"S\":{\"A\":{\"T\":\"68\",\"R\":\"46\",\"S\":\"23\"},\"N\":{\"T\":\"68\",\"R\":\"46\",\"S\":\"23\"},\"X\":{\"T\":\"68\",\"R\":\"46\",\"S\":\"23\"}},\"A\":{\"A\":{\"T\":\"69\",\"R\":\"69\",\"S\":\"69\"},\"N\":{\"T\":\"69\",\"R\":\"46\",\"S\":\"23\"},\"X\":{\"T\":\"69\",\"R\":\"46\",\"S\":\"23\"}}},\"24\":{\"S\":{\"A\":{\"T\":\"71\",\"R\":\"48\",\"S\":\"24\"},\"N\":{\"T\":\"71\",\"R\":\"48\",\"S\":\"24\"},\"X\":{\"T\":\"71\",\"R\":\"48\",\"S\":\"24\"}},\"A\":{\"A\":{\"T\":\"72\",\"R\":\"72\",\"S\":\"72\"},\"N\":{\"T\":\"72\",\"R\":\"48\",\"S\":\"24\"},\"X\":{\"T\":\"72\",\"R\":\"48\",\"S\":\"24\"}}},\"25\":{\"S\":{\"A\":{\"T\":\"74\",\"R\":\"50\",\"S\":\"25\"},\"N\":{\"T\":\"74\",\"R\":\"50\",\"S\":\"25\"},\"X\":{\"T\":\"74\",\"R\":\"50\",\"S\":\"25\"}},\"A\":{\"A\":{\"T\":\"75\",\"R\":\"75\",\"S\":\"75\"},\"N\":{\"T\":\"75\",\"R\":\"50\",\"S\":\"25\"},\"X\":{\"T\":\"75\",\"R\":\"50\",\"S\":\"25\"}}},\"26\":{\"S\":{\"A\":{\"T\":\"77\",\"R\":\"51\",\"S\":\"26\"},\"N\":{\"T\":\"77\",\"R\":\"51\",\"S\":\"26\"},\"X\":{\"T\":\"77\",\"R\":\"51\",\"S\":\"26\"}},\"A\":{\"A\":{\"T\":\"78\",\"R\":\"78\",\"S\":\"78\"},\"N\":{\"T\":\"78\",\"R\":\"52\",\"S\":\"26\"},\"X\":{\"T\":\"78\",\"R\":\"52\",\"S\":\"26\"}}},\"27\":{\"S\":{\"A\":{\"T\":\"80\",\"R\":\"53\",\"S\":\"27\"},\"N\":{\"T\":\"80\",\"R\":\"53\",\"S\":\"27\"},\"X\":{\"T\":\"80\",\"R\":\"53\",\"S\":\"27\"}},\"A\":{\"A\":{\"T\":\"81\",\"R\":\"81\",\"S\":\"81\"},\"N\":{\"T\":\"81\",\"R\":\"54\",\"S\":\"27\"},\"X\":{\"T\":\"81\",\"R\":\"54\",\"S\":\"27\"}}},\"28\":{\"S\":{\"A\":{\"T\":\"83\",\"R\":\"55\",\"S\":\"28\"},\"N\":{\"T\":\"83\",\"R\":\"55\",\"S\":\"28\"},\"X\":{\"T\":\"83\",\"R\":\"55\",\"S\":\"28\"}},\"A\":{\"A\":{\"T\":\"84\",\"R\":\"84\",\"S\":\"84\"},\"N\":{\"T\":\"84\",\"R\":\"56\",\"S\":\"28\"},\"X\":{\"T\":\"84\",\"R\":\"56\",\"S\":\"28\"}}},\"29\":{\"S\":{\"A\":{\"T\":\"86\",\"R\":\"57\",\"S\":\"29\"},\"N\":{\"T\":\"86\",\"R\":\"57\",\"S\":\"29\"},\"X\":{\"T\":\"86\",\"R\":\"57\",\"S\":\"29\"}},\"A\":{\"A\":{\"T\":\"87\",\"R\":\"87\",\"S\":\"87\"},\"N\":{\"T\":\"87\",\"R\":\"58\",\"S\":\"29\"},\"X\":{\"T\":\"87\",\"R\":\"58\",\"S\":\"29\"}}},\"30\":{\"S\":{\"A\":{\"T\":\"89\",\"R\":\"59\",\"S\":\"30\"},\"N\":{\"T\":\"89\",\"R\":\"59\",\"S\":\"30\"},\"X\":{\"T\":\"89\",\"R\":\"59\",\"S\":\"30\"}},\"A\":{\"A\":{\"T\":\"90\",\"R\":\"90\",\"S\":\"90\"},\"N\":{\"T\":\"90\",\"R\":\"60\",\"S\":\"30\"},\"X\":{\"T\":\"90\",\"R\":\"60\",\"S\":\"30\"}}},\"31\":{\"S\":{\"A\":{\"T\":\"92\",\"R\":\"61\",\"S\":\"31\"},\"N\":{\"T\":\"92\",\"R\":\"61\",\"S\":\"31\"},\"X\":{\"T\":\"92\",\"R\":\"61\",\"S\":\"31\"}},\"A\":{\"A\":{\"T\":\"93\",\"R\":\"93\",\"S\":\"93\"},\"N\":{\"T\":\"93\",\"R\":\"62\",\"S\":\"31\"},\"X\":{\"T\":\"93\",\"R\":\"62\",\"S\":\"31\"}}}}',1.20,2.00,1.90,1.00),(2,0,'프리미엄','A','{\"1\":{\"S\":{\"A\":{\"T\":\"10000\",\"R\":\"9000\",\"S\":\"1000\"},\"N\":{\"T\":\"30000\",\"R\":\"29000\",\"S\":\"1000\"},\"X\":{\"T\":\"50000\",\"R\":\"49000\",\"S\":\"1000\"}},\"A\":{\"A\":{\"T\":\"20000\",\"R\":\"19000\",\"S\":\"1000\"},\"N\":{\"T\":\"40000\",\"R\":\"39000\",\"S\":\"1000\"},\"X\":{\"T\":\"60000\",\"R\":\"59000\",\"S\":\"1000\"}}},\"2\":{\"S\":{\"A\":{\"T\":\"19900\",\"R\":\"17910\",\"S\":\"1990\"},\"N\":{\"T\":\"59700\",\"R\":\"57710\",\"S\":\"1990\"},\"X\":{\"T\":\"99500\",\"R\":\"97510\",\"S\":\"1990\"}},\"A\":{\"A\":{\"T\":\"39600\",\"R\":\"37620\",\"S\":\"1980\"},\"N\":{\"T\":\"79200\",\"R\":\"77220\",\"S\":\"1980\"},\"X\":{\"T\":\"118800\",\"R\":\"116820\",\"S\":\"1980\"}}},\"3\":{\"S\":{\"A\":{\"T\":\"29800\",\"R\":\"26820\",\"S\":\"2980\"},\"N\":{\"T\":\"89400\",\"R\":\"86420\",\"S\":\"2980\"},\"X\":{\"T\":\"149000\",\"R\":\"146020\",\"S\":\"2980\"}},\"A\":{\"A\":{\"T\":\"59200\",\"R\":\"56240\",\"S\":\"2960\"},\"N\":{\"T\":\"118400\",\"R\":\"115440\",\"S\":\"2960\"},\"X\":{\"T\":\"177600\",\"R\":\"174640\",\"S\":\"2960\"}}},\"4\":{\"S\":{\"A\":{\"T\":\"39700\",\"R\":\"35730\",\"S\":\"3970\"},\"N\":{\"T\":\"119100\",\"R\":\"115130\",\"S\":\"3970\"},\"X\":{\"T\":\"198500\",\"R\":\"194530\",\"S\":\"3970\"}},\"A\":{\"A\":{\"T\":\"78800\",\"R\":\"74860\",\"S\":\"3940\"},\"N\":{\"T\":\"157600\",\"R\":\"153660\",\"S\":\"3940\"},\"X\":{\"T\":\"236400\",\"R\":\"232460\",\"S\":\"3940\"}}},\"5\":{\"S\":{\"A\":{\"T\":\"49600\",\"R\":\"44640\",\"S\":\"4960\"},\"N\":{\"T\":\"148800\",\"R\":\"143840\",\"S\":\"4960\"},\"X\":{\"T\":\"248000\",\"R\":\"243040\",\"S\":\"4960\"}},\"A\":{\"A\":{\"T\":\"98400\",\"R\":\"93480\",\"S\":\"4920\"},\"N\":{\"T\":\"196800\",\"R\":\"191880\",\"S\":\"4920\"},\"X\":{\"T\":\"295200\",\"R\":\"290280\",\"S\":\"4920\"}}},\"6\":{\"S\":{\"A\":{\"T\":\"59500\",\"R\":\"53550\",\"S\":\"5950\"},\"N\":{\"T\":\"178500\",\"R\":\"172550\",\"S\":\"5950\"},\"X\":{\"T\":\"297500\",\"R\":\"291550\",\"S\":\"5950\"}},\"A\":{\"A\":{\"T\":\"118000\",\"R\":\"112100\",\"S\":\"5900\"},\"N\":{\"T\":\"236000\",\"R\":\"230100\",\"S\":\"5900\"},\"X\":{\"T\":\"354000\",\"R\":\"348100\",\"S\":\"5900\"}}},\"7\":{\"S\":{\"A\":{\"T\":\"69400\",\"R\":\"62460\",\"S\":\"6940\"},\"N\":{\"T\":\"208200\",\"R\":\"201260\",\"S\":\"6940\"},\"X\":{\"T\":\"347000\",\"R\":\"340060\",\"S\":\"6940\"}},\"A\":{\"A\":{\"T\":\"137600\",\"R\":\"130720\",\"S\":\"6880\"},\"N\":{\"T\":\"275200\",\"R\":\"268320\",\"S\":\"6880\"},\"X\":{\"T\":\"412800\",\"R\":\"405920\",\"S\":\"6880\"}}},\"8\":{\"S\":{\"A\":{\"T\":\"79300\",\"R\":\"71370\",\"S\":\"7930\"},\"N\":{\"T\":\"237900\",\"R\":\"229970\",\"S\":\"7930\"},\"X\":{\"T\":\"396500\",\"R\":\"388570\",\"S\":\"7930\"}},\"A\":{\"A\":{\"T\":\"157200\",\"R\":\"149340\",\"S\":\"7860\"},\"N\":{\"T\":\"314400\",\"R\":\"306540\",\"S\":\"7860\"},\"X\":{\"T\":\"471600\",\"R\":\"463740\",\"S\":\"7860\"}}},\"9\":{\"S\":{\"A\":{\"T\":\"89200\",\"R\":\"80280\",\"S\":\"8920\"},\"N\":{\"T\":\"267600\",\"R\":\"258680\",\"S\":\"8920\"},\"X\":{\"T\":\"446000\",\"R\":\"437080\",\"S\":\"8920\"}},\"A\":{\"A\":{\"T\":\"176800\",\"R\":\"167960\",\"S\":\"8840\"},\"N\":{\"T\":\"353600\",\"R\":\"344760\",\"S\":\"8840\"},\"X\":{\"T\":\"530400\",\"R\":\"521560\",\"S\":\"8840\"}}},\"10\":{\"S\":{\"A\":{\"T\":\"99100\",\"R\":\"89190\",\"S\":\"9910\"},\"N\":{\"T\":\"297300\",\"R\":\"287390\",\"S\":\"9910\"},\"X\":{\"T\":\"495500\",\"R\":\"485590\",\"S\":\"9910\"}},\"A\":{\"A\":{\"T\":\"196400\",\"R\":\"186580\",\"S\":\"9820\"},\"N\":{\"T\":\"392800\",\"R\":\"382980\",\"S\":\"9820\"},\"X\":{\"T\":\"589200\",\"R\":\"579380\",\"S\":\"9820\"}}},\"11\":{\"S\":{\"A\":{\"T\":\"109000\",\"R\":\"98100\",\"S\":\"10900\"},\"N\":{\"T\":\"327000\",\"R\":\"316100\",\"S\":\"10900\"},\"X\":{\"T\":\"545000\",\"R\":\"534100\",\"S\":\"10900\"}},\"A\":{\"A\":{\"T\":\"216000\",\"R\":\"205200\",\"S\":\"10800\"},\"N\":{\"T\":\"432000\",\"R\":\"421200\",\"S\":\"10800\"},\"X\":{\"T\":\"648000\",\"R\":\"637200\",\"S\":\"10800\"}}},\"12\":{\"S\":{\"A\":{\"T\":\"118900\",\"R\":\"107010\",\"S\":\"11890\"},\"N\":{\"T\":\"356700\",\"R\":\"344810\",\"S\":\"11890\"},\"X\":{\"T\":\"594500\",\"R\":\"582610\",\"S\":\"11890\"}},\"A\":{\"A\":{\"T\":\"235600\",\"R\":\"223820\",\"S\":\"11780\"},\"N\":{\"T\":\"471200\",\"R\":\"459420\",\"S\":\"11780\"},\"X\":{\"T\":\"706800\",\"R\":\"695020\",\"S\":\"11780\"}}},\"13\":{\"S\":{\"A\":{\"T\":\"128800\",\"R\":\"115920\",\"S\":\"12880\"},\"N\":{\"T\":\"386400\",\"R\":\"373520\",\"S\":\"12880\"},\"X\":{\"T\":\"644000\",\"R\":\"631120\",\"S\":\"12880\"}},\"A\":{\"A\":{\"T\":\"255200\",\"R\":\"242440\",\"S\":\"12760\"},\"N\":{\"T\":\"510400\",\"R\":\"497640\",\"S\":\"12760\"},\"X\":{\"T\":\"765600\",\"R\":\"752840\",\"S\":\"12760\"}}},\"14\":{\"S\":{\"A\":{\"T\":\"138700\",\"R\":\"124830\",\"S\":\"13870\"},\"N\":{\"T\":\"416100\",\"R\":\"402230\",\"S\":\"13870\"},\"X\":{\"T\":\"693500\",\"R\":\"679630\",\"S\":\"13870\"}},\"A\":{\"A\":{\"T\":\"274800\",\"R\":\"261060\",\"S\":\"13740\"},\"N\":{\"T\":\"549600\",\"R\":\"535860\",\"S\":\"13740\"},\"X\":{\"T\":\"824400\",\"R\":\"810660\",\"S\":\"13740\"}}},\"15\":{\"S\":{\"A\":{\"T\":\"148600\",\"R\":\"133740\",\"S\":\"14860\"},\"N\":{\"T\":\"445800\",\"R\":\"430940\",\"S\":\"14860\"},\"X\":{\"T\":\"743000\",\"R\":\"728140\",\"S\":\"14860\"}},\"A\":{\"A\":{\"T\":\"294400\",\"R\":\"279680\",\"S\":\"14720\"},\"N\":{\"T\":\"588800\",\"R\":\"574080\",\"S\":\"14720\"},\"X\":{\"T\":\"883200\",\"R\":\"868480\",\"S\":\"14720\"}}},\"16\":{\"S\":{\"A\":{\"T\":\"158500\",\"R\":\"142650\",\"S\":\"15850\"},\"N\":{\"T\":\"475500\",\"R\":\"459650\",\"S\":\"15850\"},\"X\":{\"T\":\"792500\",\"R\":\"776650\",\"S\":\"15850\"}},\"A\":{\"A\":{\"T\":\"314000\",\"R\":\"298300\",\"S\":\"15700\"},\"N\":{\"T\":\"628000\",\"R\":\"612300\",\"S\":\"15700\"},\"X\":{\"T\":\"942000\",\"R\":\"926300\",\"S\":\"15700\"}}},\"17\":{\"S\":{\"A\":{\"T\":\"168400\",\"R\":\"151560\",\"S\":\"16840\"},\"N\":{\"T\":\"505200\",\"R\":\"488360\",\"S\":\"16840\"},\"X\":{\"T\":\"842000\",\"R\":\"825160\",\"S\":\"16840\"}},\"A\":{\"A\":{\"T\":\"333600\",\"R\":\"316920\",\"S\":\"16680\"},\"N\":{\"T\":\"667200\",\"R\":\"650520\",\"S\":\"16680\"},\"X\":{\"T\":\"1000800\",\"R\":\"984120\",\"S\":\"16680\"}}},\"18\":{\"S\":{\"A\":{\"T\":\"178300\",\"R\":\"160470\",\"S\":\"17830\"},\"N\":{\"T\":\"534900\",\"R\":\"517070\",\"S\":\"17830\"},\"X\":{\"T\":\"891500\",\"R\":\"873670\",\"S\":\"17830\"}},\"A\":{\"A\":{\"T\":\"353200\",\"R\":\"335540\",\"S\":\"17660\"},\"N\":{\"T\":\"706400\",\"R\":\"688740\",\"S\":\"17660\"},\"X\":{\"T\":\"1059600\",\"R\":\"1041940\",\"S\":\"17660\"}}},\"19\":{\"S\":{\"A\":{\"T\":\"188200\",\"R\":\"169380\",\"S\":\"18820\"},\"N\":{\"T\":\"564600\",\"R\":\"545780\",\"S\":\"18820\"},\"X\":{\"T\":\"941000\",\"R\":\"922180\",\"S\":\"18820\"}},\"A\":{\"A\":{\"T\":\"372800\",\"R\":\"354160\",\"S\":\"18640\"},\"N\":{\"T\":\"745600\",\"R\":\"726960\",\"S\":\"18640\"},\"X\":{\"T\":\"1118400\",\"R\":\"1099760\",\"S\":\"18640\"}}},\"20\":{\"S\":{\"A\":{\"T\":\"198100\",\"R\":\"178290\",\"S\":\"19810\"},\"N\":{\"T\":\"594300\",\"R\":\"574490\",\"S\":\"19810\"},\"X\":{\"T\":\"990500\",\"R\":\"970690\",\"S\":\"19810\"}},\"A\":{\"A\":{\"T\":\"392400\",\"R\":\"372780\",\"S\":\"19620\"},\"N\":{\"T\":\"784800\",\"R\":\"765180\",\"S\":\"19620\"},\"X\":{\"T\":\"1177200\",\"R\":\"1157580\",\"S\":\"19620\"}}},\"21\":{\"S\":{\"A\":{\"T\":\"208000\",\"R\":\"187200\",\"S\":\"20800\"},\"N\":{\"T\":\"624000\",\"R\":\"603200\",\"S\":\"20800\"},\"X\":{\"T\":\"1040000\",\"R\":\"1019200\",\"S\":\"20800\"}},\"A\":{\"A\":{\"T\":\"412000\",\"R\":\"391400\",\"S\":\"20600\"},\"N\":{\"T\":\"824000\",\"R\":\"803400\",\"S\":\"20600\"},\"X\":{\"T\":\"1236000\",\"R\":\"1215400\",\"S\":\"20600\"}}},\"22\":{\"S\":{\"A\":{\"T\":\"217900\",\"R\":\"196110\",\"S\":\"21790\"},\"N\":{\"T\":\"653700\",\"R\":\"631910\",\"S\":\"21790\"},\"X\":{\"T\":\"1089500\",\"R\":\"1067710\",\"S\":\"21790\"}},\"A\":{\"A\":{\"T\":\"431600\",\"R\":\"410020\",\"S\":\"21580\"},\"N\":{\"T\":\"863200\",\"R\":\"841620\",\"S\":\"21580\"},\"X\":{\"T\":\"1294800\",\"R\":\"1273220\",\"S\":\"21580\"}}},\"23\":{\"S\":{\"A\":{\"T\":\"227800\",\"R\":\"205020\",\"S\":\"22780\"},\"N\":{\"T\":\"683400\",\"R\":\"660620\",\"S\":\"22780\"},\"X\":{\"T\":\"1139000\",\"R\":\"1116220\",\"S\":\"22780\"}},\"A\":{\"A\":{\"T\":\"451200\",\"R\":\"428640\",\"S\":\"22560\"},\"N\":{\"T\":\"902400\",\"R\":\"879840\",\"S\":\"22560\"},\"X\":{\"T\":\"1353600\",\"R\":\"1331040\",\"S\":\"22560\"}}}}',NULL,'2021-12-16 23:12:44','2022-01-05 11:18:17','{\"1\":{\"S\":{\"A\":{\"T\":\"20000\",\"R\":\"10000\",\"S\":\"10000\"},\"N\":{\"T\":\"22000\",\"R\":\"12000\",\"S\":\"10000\"},\"X\":{\"T\":\"24000\",\"R\":\"14000\",\"S\":\"10000\"}},\"A\":{\"A\":{\"T\":\"21000\",\"R\":\"21000\",\"S\":\"21000\"},\"N\":{\"T\":\"23000\",\"R\":\"13000\",\"S\":\"10000\"},\"X\":{\"T\":\"25000\",\"R\":\"15000\",\"S\":\"10000\"}}},\"2\":{\"S\":{\"A\":{\"T\":\"39986\",\"R\":\"19993\",\"S\":\"19993\"},\"N\":{\"T\":\"43985\",\"R\":\"23992\",\"S\":\"19993\"},\"X\":{\"T\":\"47984\",\"R\":\"27991\",\"S\":\"19993\"}},\"A\":{\"A\":{\"T\":\"41979\",\"R\":\"41979\",\"S\":\"41979\"},\"N\":{\"T\":\"45977\",\"R\":\"25987\",\"S\":\"19990\"},\"X\":{\"T\":\"49975\",\"R\":\"29985\",\"S\":\"19990\"}}},\"3\":{\"S\":{\"A\":{\"T\":\"59972\",\"R\":\"29986\",\"S\":\"29986\"},\"N\":{\"T\":\"65970\",\"R\":\"35984\",\"S\":\"29986\"},\"X\":{\"T\":\"71967\",\"R\":\"41981\",\"S\":\"29986\"}},\"A\":{\"A\":{\"T\":\"62958\",\"R\":\"62958\",\"S\":\"62958\"},\"N\":{\"T\":\"68954\",\"R\":\"38974\",\"S\":\"29980\"},\"X\":{\"T\":\"74950\",\"R\":\"44970\",\"S\":\"29980\"}}},\"4\":{\"S\":{\"A\":{\"T\":\"79958\",\"R\":\"39979\",\"S\":\"39979\"},\"N\":{\"T\":\"87954\",\"R\":\"47975\",\"S\":\"39979\"},\"X\":{\"T\":\"95950\",\"R\":\"55971\",\"S\":\"39979\"}},\"A\":{\"A\":{\"T\":\"83937\",\"R\":\"83937\",\"S\":\"83937\"},\"N\":{\"T\":\"91931\",\"R\":\"51961\",\"S\":\"39970\"},\"X\":{\"T\":\"99925\",\"R\":\"59955\",\"S\":\"39970\"}}},\"5\":{\"S\":{\"A\":{\"T\":\"99944\",\"R\":\"49972\",\"S\":\"49972\"},\"N\":{\"T\":\"109939\",\"R\":\"59967\",\"S\":\"49972\"},\"X\":{\"T\":\"119933\",\"R\":\"69961\",\"S\":\"49972\"}},\"A\":{\"A\":{\"T\":\"104916\",\"R\":\"104916\",\"S\":\"104916\"},\"N\":{\"T\":\"114908\",\"R\":\"64948\",\"S\":\"49960\"},\"X\":{\"T\":\"124900\",\"R\":\"74940\",\"S\":\"49960\"}}},\"6\":{\"S\":{\"A\":{\"T\":\"119930\",\"R\":\"59965\",\"S\":\"59965\"},\"N\":{\"T\":\"131923\",\"R\":\"71958\",\"S\":\"59965\"},\"X\":{\"T\":\"143916\",\"R\":\"83951\",\"S\":\"59965\"}},\"A\":{\"A\":{\"T\":\"125895\",\"R\":\"125895\",\"S\":\"125895\"},\"N\":{\"T\":\"137885\",\"R\":\"77935\",\"S\":\"59950\"},\"X\":{\"T\":\"149875\",\"R\":\"89925\",\"S\":\"59950\"}}},\"7\":{\"S\":{\"A\":{\"T\":\"139916\",\"R\":\"69958\",\"S\":\"69958\"},\"N\":{\"T\":\"153908\",\"R\":\"83950\",\"S\":\"69958\"},\"X\":{\"T\":\"167900\",\"R\":\"97942\",\"S\":\"69958\"}},\"A\":{\"A\":{\"T\":\"146874\",\"R\":\"146874\",\"S\":\"146874\"},\"N\":{\"T\":\"160862\",\"R\":\"90922\",\"S\":\"69940\"},\"X\":{\"T\":\"174850\",\"R\":\"104910\",\"S\":\"69940\"}}},\"8\":{\"S\":{\"A\":{\"T\":\"159902\",\"R\":\"79951\",\"S\":\"79951\"},\"N\":{\"T\":\"175893\",\"R\":\"95942\",\"S\":\"79951\"},\"X\":{\"T\":\"191883\",\"R\":\"111932\",\"S\":\"79951\"}},\"A\":{\"A\":{\"T\":\"167853\",\"R\":\"167853\",\"S\":\"167853\"},\"N\":{\"T\":\"183839\",\"R\":\"103909\",\"S\":\"79930\"},\"X\":{\"T\":\"199825\",\"R\":\"119895\",\"S\":\"79930\"}}},\"9\":{\"S\":{\"A\":{\"T\":\"179888\",\"R\":\"89944\",\"S\":\"89944\"},\"N\":{\"T\":\"197877\",\"R\":\"107933\",\"S\":\"89944\"},\"X\":{\"T\":\"215866\",\"R\":\"125922\",\"S\":\"89944\"}},\"A\":{\"A\":{\"T\":\"188832\",\"R\":\"188832\",\"S\":\"188832\"},\"N\":{\"T\":\"206816\",\"R\":\"116896\",\"S\":\"89920\"},\"X\":{\"T\":\"224800\",\"R\":\"134880\",\"S\":\"89920\"}}},\"10\":{\"S\":{\"A\":{\"T\":\"199874\",\"R\":\"99937\",\"S\":\"99937\"},\"N\":{\"T\":\"219862\",\"R\":\"119925\",\"S\":\"99937\"},\"X\":{\"T\":\"239849\",\"R\":\"139912\",\"S\":\"99937\"}},\"A\":{\"A\":{\"T\":\"209811\",\"R\":\"209811\",\"S\":\"209811\"},\"N\":{\"T\":\"229793\",\"R\":\"129883\",\"S\":\"99910\"},\"X\":{\"T\":\"249775\",\"R\":\"149865\",\"S\":\"99910\"}}},\"11\":{\"S\":{\"A\":{\"T\":\"219860\",\"R\":\"109930\",\"S\":\"109930\"},\"N\":{\"T\":\"241846\",\"R\":\"131916\",\"S\":\"109930\"},\"X\":{\"T\":\"263832\",\"R\":\"153902\",\"S\":\"109930\"}},\"A\":{\"A\":{\"T\":\"230790\",\"R\":\"230790\",\"S\":\"230790\"},\"N\":{\"T\":\"252770\",\"R\":\"142870\",\"S\":\"109900\"},\"X\":{\"T\":\"274750\",\"R\":\"164850\",\"S\":\"109900\"}}},\"12\":{\"S\":{\"A\":{\"T\":\"239846\",\"R\":\"119923\",\"S\":\"119923\"},\"N\":{\"T\":\"263831\",\"R\":\"143908\",\"S\":\"119923\"},\"X\":{\"T\":\"287816\",\"R\":\"167893\",\"S\":\"119923\"}},\"A\":{\"A\":{\"T\":\"251769\",\"R\":\"251769\",\"S\":\"251769\"},\"N\":{\"T\":\"275747\",\"R\":\"155857\",\"S\":\"119890\"},\"X\":{\"T\":\"299725\",\"R\":\"179835\",\"S\":\"119890\"}}},\"13\":{\"S\":{\"A\":{\"T\":\"259832\",\"R\":\"129916\",\"S\":\"129916\"},\"N\":{\"T\":\"285816\",\"R\":\"155900\",\"S\":\"129916\"},\"X\":{\"T\":\"311799\",\"R\":\"181883\",\"S\":\"129916\"}},\"A\":{\"A\":{\"T\":\"272748\",\"R\":\"272748\",\"S\":\"272748\"},\"N\":{\"T\":\"298724\",\"R\":\"168844\",\"S\":\"129880\"},\"X\":{\"T\":\"324700\",\"R\":\"194820\",\"S\":\"129880\"}}},\"14\":{\"S\":{\"A\":{\"T\":\"279818\",\"R\":\"139909\",\"S\":\"139909\"},\"N\":{\"T\":\"307800\",\"R\":\"167891\",\"S\":\"139909\"},\"X\":{\"T\":\"335782\",\"R\":\"195873\",\"S\":\"139909\"}},\"A\":{\"A\":{\"T\":\"293727\",\"R\":\"293727\",\"S\":\"293727\"},\"N\":{\"T\":\"321701\",\"R\":\"181831\",\"S\":\"139870\"},\"X\":{\"T\":\"349675\",\"R\":\"209805\",\"S\":\"139870\"}}},\"15\":{\"S\":{\"A\":{\"T\":\"299804\",\"R\":\"149902\",\"S\":\"149902\"},\"N\":{\"T\":\"329785\",\"R\":\"179883\",\"S\":\"149902\"},\"X\":{\"T\":\"359765\",\"R\":\"209863\",\"S\":\"149902\"}},\"A\":{\"A\":{\"T\":\"314706\",\"R\":\"314706\",\"S\":\"314706\"},\"N\":{\"T\":\"344678\",\"R\":\"194818\",\"S\":\"149860\"},\"X\":{\"T\":\"374650\",\"R\":\"224790\",\"S\":\"149860\"}}},\"16\":{\"S\":{\"A\":{\"T\":\"319790\",\"R\":\"159895\",\"S\":\"159895\"},\"N\":{\"T\":\"351769\",\"R\":\"191874\",\"S\":\"159895\"},\"X\":{\"T\":\"383748\",\"R\":\"223853\",\"S\":\"159895\"}},\"A\":{\"A\":{\"T\":\"335685\",\"R\":\"335685\",\"S\":\"335685\"},\"N\":{\"T\":\"367655\",\"R\":\"207805\",\"S\":\"159850\"},\"X\":{\"T\":\"399625\",\"R\":\"239775\",\"S\":\"159850\"}}},\"17\":{\"S\":{\"A\":{\"T\":\"339776\",\"R\":\"169888\",\"S\":\"169888\"},\"N\":{\"T\":\"373754\",\"R\":\"203866\",\"S\":\"169888\"},\"X\":{\"T\":\"407732\",\"R\":\"237844\",\"S\":\"169888\"}},\"A\":{\"A\":{\"T\":\"356664\",\"R\":\"356664\",\"S\":\"356664\"},\"N\":{\"T\":\"390632\",\"R\":\"220792\",\"S\":\"169840\"},\"X\":{\"T\":\"424600\",\"R\":\"254760\",\"S\":\"169840\"}}},\"18\":{\"S\":{\"A\":{\"T\":\"359762\",\"R\":\"179881\",\"S\":\"179881\"},\"N\":{\"T\":\"395739\",\"R\":\"215858\",\"S\":\"179881\"},\"X\":{\"T\":\"431715\",\"R\":\"251834\",\"S\":\"179881\"}},\"A\":{\"A\":{\"T\":\"377643\",\"R\":\"377643\",\"S\":\"377643\"},\"N\":{\"T\":\"413609\",\"R\":\"233779\",\"S\":\"179830\"},\"X\":{\"T\":\"449575\",\"R\":\"269745\",\"S\":\"179830\"}}},\"19\":{\"S\":{\"A\":{\"T\":\"379748\",\"R\":\"189874\",\"S\":\"189874\"},\"N\":{\"T\":\"417723\",\"R\":\"227849\",\"S\":\"189874\"},\"X\":{\"T\":\"455698\",\"R\":\"265824\",\"S\":\"189874\"}},\"A\":{\"A\":{\"T\":\"398622\",\"R\":\"398622\",\"S\":\"398622\"},\"N\":{\"T\":\"436586\",\"R\":\"246766\",\"S\":\"189820\"},\"X\":{\"T\":\"474550\",\"R\":\"284730\",\"S\":\"189820\"}}},\"20\":{\"S\":{\"A\":{\"T\":\"399734\",\"R\":\"199867\",\"S\":\"199867\"},\"N\":{\"T\":\"439708\",\"R\":\"239841\",\"S\":\"199867\"},\"X\":{\"T\":\"479681\",\"R\":\"279814\",\"S\":\"199867\"}},\"A\":{\"A\":{\"T\":\"419601\",\"R\":\"419601\",\"S\":\"419601\"},\"N\":{\"T\":\"459563\",\"R\":\"259753\",\"S\":\"199810\"},\"X\":{\"T\":\"499525\",\"R\":\"299715\",\"S\":\"199810\"}}},\"21\":{\"S\":{\"A\":{\"T\":\"419720\",\"R\":\"209860\",\"S\":\"209860\"},\"N\":{\"T\":\"461692\",\"R\":\"251832\",\"S\":\"209860\"},\"X\":{\"T\":\"503664\",\"R\":\"293804\",\"S\":\"209860\"}},\"A\":{\"A\":{\"T\":\"440580\",\"R\":\"440580\",\"S\":\"440580\"},\"N\":{\"T\":\"482540\",\"R\":\"272740\",\"S\":\"209800\"},\"X\":{\"T\":\"524500\",\"R\":\"314700\",\"S\":\"209800\"}}},\"22\":{\"S\":{\"A\":{\"T\":\"439706\",\"R\":\"219853\",\"S\":\"219853\"},\"N\":{\"T\":\"483677\",\"R\":\"263824\",\"S\":\"219853\"},\"X\":{\"T\":\"527648\",\"R\":\"307795\",\"S\":\"219853\"}},\"A\":{\"A\":{\"T\":\"461559\",\"R\":\"461559\",\"S\":\"461559\"},\"N\":{\"T\":\"505517\",\"R\":\"285727\",\"S\":\"219790\"},\"X\":{\"T\":\"549475\",\"R\":\"329685\",\"S\":\"219790\"}}},\"23\":{\"S\":{\"A\":{\"T\":\"459692\",\"R\":\"229846\",\"S\":\"229846\"},\"N\":{\"T\":\"505662\",\"R\":\"275816\",\"S\":\"229846\"},\"X\":{\"T\":\"551631\",\"R\":\"321785\",\"S\":\"229846\"}},\"A\":{\"A\":{\"T\":\"482538\",\"R\":\"482538\",\"S\":\"482538\"},\"N\":{\"T\":\"528494\",\"R\":\"298714\",\"S\":\"229780\"},\"X\":{\"T\":\"574450\",\"R\":\"344670\",\"S\":\"229780\"}}},\"24\":{\"S\":{\"A\":{\"T\":\"479678\",\"R\":\"239839\",\"S\":\"239839\"},\"N\":{\"T\":\"527646\",\"R\":\"287807\",\"S\":\"239839\"},\"X\":{\"T\":\"575614\",\"R\":\"335775\",\"S\":\"239839\"}},\"A\":{\"A\":{\"T\":\"503517\",\"R\":\"503517\",\"S\":\"503517\"},\"N\":{\"T\":\"551471\",\"R\":\"311701\",\"S\":\"239770\"},\"X\":{\"T\":\"599425\",\"R\":\"359655\",\"S\":\"239770\"}}},\"25\":{\"S\":{\"A\":{\"T\":\"499664\",\"R\":\"249832\",\"S\":\"249832\"},\"N\":{\"T\":\"549631\",\"R\":\"299799\",\"S\":\"249832\"},\"X\":{\"T\":\"599597\",\"R\":\"349765\",\"S\":\"249832\"}},\"A\":{\"A\":{\"T\":\"524496\",\"R\":\"524496\",\"S\":\"524496\"},\"N\":{\"T\":\"574448\",\"R\":\"324688\",\"S\":\"249760\"},\"X\":{\"T\":\"624400\",\"R\":\"374640\",\"S\":\"249760\"}}},\"26\":{\"S\":{\"A\":{\"T\":\"519650\",\"R\":\"259825\",\"S\":\"259825\"},\"N\":{\"T\":\"571615\",\"R\":\"311790\",\"S\":\"259825\"},\"X\":{\"T\":\"623580\",\"R\":\"363755\",\"S\":\"259825\"}},\"A\":{\"A\":{\"T\":\"545475\",\"R\":\"545475\",\"S\":\"545475\"},\"N\":{\"T\":\"597425\",\"R\":\"337675\",\"S\":\"259750\"},\"X\":{\"T\":\"649375\",\"R\":\"389625\",\"S\":\"259750\"}}},\"27\":{\"S\":{\"A\":{\"T\":\"539636\",\"R\":\"269818\",\"S\":\"269818\"},\"N\":{\"T\":\"593600\",\"R\":\"323782\",\"S\":\"269818\"},\"X\":{\"T\":\"647564\",\"R\":\"377746\",\"S\":\"269818\"}},\"A\":{\"A\":{\"T\":\"566454\",\"R\":\"566454\",\"S\":\"566454\"},\"N\":{\"T\":\"620402\",\"R\":\"350662\",\"S\":\"269740\"},\"X\":{\"T\":\"674350\",\"R\":\"404610\",\"S\":\"269740\"}}},\"28\":{\"S\":{\"A\":{\"T\":\"559622\",\"R\":\"279811\",\"S\":\"279811\"},\"N\":{\"T\":\"615585\",\"R\":\"335774\",\"S\":\"279811\"},\"X\":{\"T\":\"671547\",\"R\":\"391736\",\"S\":\"279811\"}},\"A\":{\"A\":{\"T\":\"587433\",\"R\":\"587433\",\"S\":\"587433\"},\"N\":{\"T\":\"643379\",\"R\":\"363649\",\"S\":\"279730\"},\"X\":{\"T\":\"699325\",\"R\":\"419595\",\"S\":\"279730\"}}},\"29\":{\"S\":{\"A\":{\"T\":\"579608\",\"R\":\"289804\",\"S\":\"289804\"},\"N\":{\"T\":\"637569\",\"R\":\"347765\",\"S\":\"289804\"},\"X\":{\"T\":\"695530\",\"R\":\"405726\",\"S\":\"289804\"}},\"A\":{\"A\":{\"T\":\"608412\",\"R\":\"608412\",\"S\":\"608412\"},\"N\":{\"T\":\"666356\",\"R\":\"376636\",\"S\":\"289720\"},\"X\":{\"T\":\"724300\",\"R\":\"434580\",\"S\":\"289720\"}}},\"30\":{\"S\":{\"A\":{\"T\":\"599594\",\"R\":\"299797\",\"S\":\"299797\"},\"N\":{\"T\":\"659554\",\"R\":\"359757\",\"S\":\"299797\"},\"X\":{\"T\":\"719513\",\"R\":\"419716\",\"S\":\"299797\"}},\"A\":{\"A\":{\"T\":\"629391\",\"R\":\"629391\",\"S\":\"629391\"},\"N\":{\"T\":\"689333\",\"R\":\"389623\",\"S\":\"299710\"},\"X\":{\"T\":\"749275\",\"R\":\"449565\",\"S\":\"299710\"}}},\"31\":{\"S\":{\"A\":{\"T\":\"619580\",\"R\":\"309790\",\"S\":\"309790\"},\"N\":{\"T\":\"681538\",\"R\":\"371748\",\"S\":\"309790\"},\"X\":{\"T\":\"743496\",\"R\":\"433706\",\"S\":\"309790\"}},\"A\":{\"A\":{\"T\":\"650370\",\"R\":\"650370\",\"S\":\"650370\"},\"N\":{\"T\":\"712310\",\"R\":\"402610\",\"S\":\"309700\"},\"X\":{\"T\":\"774250\",\"R\":\"464550\",\"S\":\"309700\"}}}}',0.00,0.07,0.00,0.10),(5,0,'테스트','A','\'',NULL,'2022-01-05 11:48:57','2022-01-05 11:48:57','NULL',0.00,0.00,0.00,0.00);
/*!40000 ALTER TABLE `french_seat_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `french_seats`
--

DROP TABLE IF EXISTS `french_seats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `french_seats` (
  `s_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호',
  `s_partner` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '가맹점번호',
  `s_room` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '룸번호',
  `s_level` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '좌석등급',
  `s_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '좌석명',
  `s_img` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '좌석이미지',
  `s_state` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '상태(0:미사용, 1:사용)',
  `s_iot1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'IOT1',
  `s_iot2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'IOT2',
  `s_iot3` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'IOT3',
  `s_iot4` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'IOT4',
  `s_item` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '요금종류',
  `s_device` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '노출디바이스',
  `s_age` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '나이구분',
  `s_map_x` int(10) unsigned NOT NULL DEFAULT 0 COMMENT 'X좌표',
  `s_map_y` int(10) unsigned NOT NULL DEFAULT 0 COMMENT 'Y좌표',
  `s_map_w` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '너비',
  `s_map_h` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '높이',
  `s_map_r` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '회전각도',
  `s_open_kiosk` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y' COMMENT '키오스크판매여부',
  `s_open_mobile` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y' COMMENT '모바일판매여부',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`s_no`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `french_seats`
--

LOCK TABLES `french_seats` WRITE;
/*!40000 ALTER TABLE `french_seats` DISABLE KEYS */;
INSERT INTO `french_seats` VALUES (1,0,45,1,'','','Y','','','','','','','',4,13,88,58,0,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 07:28:20'),(2,0,45,1,'','','Y','','','','','','','',110,2,88,58,0,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 04:53:08'),(3,0,45,1,'','','Y','','','','','','','',213,3,88,58,0,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 04:53:08'),(4,0,45,1,'','','Y','','','','','','','',318,2,88,58,0,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 04:53:08'),(5,0,45,1,'','','Y','','','','','','','',422,2,88,58,0,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 04:53:08'),(6,0,45,2,'','','Y','','','','','','','',527,2,88,58,0,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 04:53:08'),(7,0,45,2,'','','Y','','','','','','','',630,2,88,58,360,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 04:53:08'),(8,0,45,2,'','','Y','','','','','','','',734,2,88,58,360,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 04:53:08'),(9,0,45,2,'','','Y','','','','','','','',900,62,88,58,90,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 06:01:54'),(10,0,45,2,'','','Y','','','','','','','',910,155,88,58,90,'Y','Y',NULL,'2021-12-14 05:28:42','2022-01-25 05:59:59'),(11,0,45,2,'','','Y','','','','','','','',731,168,88,58,0,'Y','Y',NULL,'2021-12-14 06:28:27','2022-01-25 04:51:05'),(12,0,45,2,'','','Y','','','','','','','',524,168,88,58,0,'Y','Y',NULL,'2021-12-14 06:28:27','2022-01-25 04:31:09'),(13,0,45,2,'','','Y','','','','','','','',910,262,88,58,90,'Y','Y',NULL,'2021-12-14 06:28:27','2022-01-25 05:59:59'),(14,0,45,2,'','','Y','','','','','','','',312,360,88,58,0,'Y','Y',NULL,'2021-12-14 06:28:27','2022-01-25 04:31:09'),(15,0,45,2,'','','Y','','','','','','','',909,368,88,58,90,'Y','Y',NULL,'2021-12-14 06:28:27','2022-01-25 05:59:59'),(16,0,0,2,'','','N','','','','','','','',209,436,88,58,0,'N','N',NULL,'2021-12-14 14:13:01','2022-01-25 04:31:09'),(17,0,0,2,'','','N','','','','','','','',909,472,88,58,90,'N','N',NULL,'2021-12-14 14:13:17','2022-01-25 05:59:59'),(18,0,0,2,'','','N','','','','','','','',621,359,88,58,0,'N','N',NULL,'2021-12-14 14:23:35','2022-01-25 04:31:09'),(19,0,0,2,'','','N','','','','','','','',627,168,88,58,0,'N','N',NULL,'2021-12-14 14:23:44','2022-01-25 04:31:09'),(20,0,0,2,'','','N','','','','','','','',628,248,88,58,0,'N','N',NULL,'2021-12-14 14:23:44','2022-01-25 04:51:05'),(21,0,0,2,'','','N','','','','','','','',314,524,88,58,0,'N','N',NULL,'2021-12-14 14:23:46','2022-01-25 05:59:44'),(22,0,0,2,'','','N','','','','','','','',421,249,88,58,0,'N','N',NULL,'2021-12-14 14:24:03','2022-01-25 04:31:09'),(23,0,0,2,'','','N','','','','','','','',414,361,88,58,0,'N','N',NULL,'2021-12-14 14:24:04','2022-01-25 04:31:09'),(24,0,0,2,'','','N','','','','','','','',106,524,88,58,0,'N','N',NULL,'2021-12-14 14:25:32','2022-01-25 05:59:34'),(25,0,0,2,'','','N','','','','','','','',211,524,88,58,0,'N','N',NULL,'2021-12-14 14:25:50','2022-01-25 05:59:44'),(26,0,48,2,'','','Y','','','','','','','',107,250,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:51:59'),(27,0,48,2,'','','Y','','','','','','','',4,363,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(28,0,48,2,'','','Y','','','','','','','',210,250,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:51:59'),(29,0,48,2,'','','Y','','','','','','','',3,523,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 05:59:34'),(30,0,48,2,'','','Y','','','','','','','',622,433,88,58,360,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:51:59'),(31,0,48,2,'','','Y','','','','','','','',731,248,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:51:05'),(32,0,48,2,'','','Y','','','','','','','',209,361,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(33,0,48,2,'','','Y','','','','','','','',315,248,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:51:59'),(34,0,48,2,'','','Y','','','','','','','',724,359,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(35,2,48,2,'','','Y','','','','','','','',524,248,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:51:05'),(36,2,48,2,'','','Y','','','','','','','',315,170,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(37,2,48,2,'','','Y','','','','','','','',420,169,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(38,2,48,2,'','','Y','','','','','','','',414,436,88,58,360,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(39,2,48,2,'','','Y','','','','','','','',724,433,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:51:59'),(40,2,48,2,'','','Y','','','','','','','',518,434,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(41,2,48,2,'','','Y','','','','','','','',106,362,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(42,2,48,2,'','','Y','','','','','','','',210,170,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(43,2,48,2,'','','Y','','','','','','','',518,360,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:31:09'),(44,3,48,2,'','','Y','','','','','','','',312,436,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:51:59'),(45,2,48,2,'','','N','','','','','','','',1,171,88,58,0,'Y','Y',NULL,'2021-12-15 05:31:03','2022-01-25 04:51:59'),(46,2,45,2,'','','N','','','','','','','',2,251,88,58,0,'N','N',NULL,'2021-12-24 01:19:59','2022-01-25 04:51:59'),(47,2,45,1,'','','N','','','','','','','',3,436,88,58,0,'Y','Y',NULL,'2021-12-24 01:20:11','2022-01-25 04:31:09'),(48,2,45,1,'','','N','','','','','','','',107,436,88,58,0,'Y','Y',NULL,'2021-12-24 01:20:19','2022-01-25 04:51:59'),(49,2,45,1,'','','Y','111','222','333','444','','','',107,171,88,58,0,'Y','Y',NULL,'2021-12-24 01:45:18','2022-01-25 04:31:09');
/*!40000 ALTER TABLE `french_seats` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-15 10:45:36
