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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-23 12:53:46
