-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: proj_db
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB

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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `p_tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `p_uid` int(11) NOT NULL,
  `pub_date` datetime NOT NULL,
  `image` blob,
  `details` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,2,'2017-12-06 17:55:44',NULL,'Miraak? Is that you?'),(1,2,1,'2017-12-11 00:28:14',NULL,'Me: [b] FUS ROH DAH! [/b]\r\n[i]Testing BBcode parser [/i]'),(1,3,1,'2017-12-11 00:29:27',NULL,'<em>Trying again this time</em>.\r\n<strong> Fus Ro Dah! </strong>'),(1,4,1,'2017-12-11 00:34:04',NULL,'[url]htpp://www.fanfiction.net[/url]\r\n\r\n<span style=\"text-decoration:underline;\">What the?</span>.'),(1,5,1,'2017-12-11 00:34:22',NULL,'[link]http://www.example.com[/link]'),(1,6,1,'2017-12-11 00:35:23',NULL,'<em>Italics</em>'),(1,7,1,'2017-12-11 00:38:36',NULL,'[url href=\"http://www.fanfiction.net/alert/story.php\"] click me [/url]'),(1,8,1,'2017-12-11 00:39:46',NULL,'[url=\"http://www.fanfiction.net/alert/story.php\"] click me [/url]'),(1,9,1,'2017-12-11 00:40:08',NULL,'[big]thicc[/big]'),(1,10,1,'2017-12-11 00:48:26',NULL,'[i]Try again[/i]'),(1,11,1,'2017-12-11 00:48:40',NULL,'[b] Bishal [/b]'),(1,12,2,'2017-12-11 00:54:20',NULL,'[QUOTE]\r\nAre traps gay?\r\n[/QUOTE]'),(1,13,2,'2017-12-11 00:56:07',NULL,'[CODE]\r\ndef shout(name):\r\n    if name == \"dragonrend\":\r\n        print \"Joor Zah Frul!\"\r\n[/CODE]\r\n'),(1,14,2,'2017-12-11 00:56:54',NULL,'[list=A]\r\n[*]First item\r\n[*]Second item\r\n[/list]'),(1,15,2,'2017-12-11 00:58:11',NULL,'Normal text.\r\nCheck if textarea handles CRLF correctly.'),(1,16,2,'2017-12-11 00:58:26',NULL,'Apparently not.\r\n'),(1,17,2,'2017-12-11 01:02:48',NULL,'Trying to insert HTML breaks.\r\nDoes it work now?'),(1,18,2,'2017-12-11 01:03:24',NULL,'[CODE]\r\ndef shout(name):\r\n    if name  == \'dragonrend\':\r\n        print(\"Joor Zah Frul!\")\r\n[/CODE]'),(1,19,2,'2017-12-11 01:04:52',NULL,'what \r\nis \r\nit'),(1,20,2,'2017-12-11 01:13:42',NULL,'What is the\r\n    problem'),(1,21,2,'2017-12-11 01:48:19',NULL,'[url=\"http://www.fanfiction.net\"][/url]'),(2,22,3,'2017-12-11 19:43:49',NULL,'[CODE]\r\ndef say():\r\n    print(\"Eh vyah\")\r\n[/CODE]'),(2,23,3,'2017-12-11 19:44:05',NULL,'[B]Kasto mula saag rahechha[/B]'),(2,24,3,'2017-12-11 19:44:39',NULL,'[i]Eh vyah[/i]\r\n[url]http://www.google.com[/url]'),(3,25,3,'2017-12-11 19:53:12',NULL,'Vyaa!!'),(3,26,1,'2017-12-11 19:53:28',NULL,'Ke bhaneko'),(4,27,1,'2017-12-11 19:56:10',NULL,'Kina chup lageko?'),(4,28,3,'2017-12-11 19:56:18',NULL,'K cha kta ho??'),(4,29,4,'2017-12-11 20:08:30',NULL,'Tero baje'),(4,30,4,'2017-12-11 20:09:07',NULL,'[b]I am mala[/b]'),(4,31,4,'2017-12-11 20:09:24',NULL,'<b>hello</b>'),(4,33,4,'2017-12-11 20:16:18',NULL,'<b>hello</b>'),(4,34,4,'2017-12-11 20:16:27',NULL,'<em>highs</em>'),(4,37,4,'2017-12-11 20:23:27',NULL,'photo ayaayoooo'),(4,38,4,'2017-12-11 20:24:54',NULL,'helo'),(3,43,7,'2017-12-12 15:44:02',NULL,'Pic testing.'),(2,44,7,'2017-12-12 15:50:42',NULL,'[b]Dovah-kiin[/b]: Dragon-born\r\n[b]Dov-ah-kiin[/b]: Dragonkind-Hunter-born\r\n\r\nWhich is it?'),(4,45,1,'2017-12-12 16:26:10',NULL,'Tag check\r\nHtml: <b>What</b>\r\nbbcode: [b]U wot m8?[/b]\r\n'),(2,46,1,'2017-12-13 11:44:04',NULL,'Hello.\r\n[b]Bold[/b]'),(5,47,5,'2017-12-20 11:23:51',NULL,'Ninja\r\nas'),(5,48,5,'2017-12-20 11:24:14',NULL,'[b]Php[/b]\r\n[url]www.google.com[/url]'),(5,49,1,'2017-12-23 13:43:53',NULL,'Reply.\r\nNewline.\r\ndo it.'),(4,50,1,'2017-12-23 14:49:59',NULL,'[quote]Checking quotes[/quote]'),(4,51,1,'2017-12-23 15:00:05',NULL,'<a href=\"http://www.fanfiction.net\">Ninja</a>'),(4,52,1,'2017-12-23 15:02:22',NULL,'<b>Html doesnt work anymore.</b>'),(4,53,1,'2017-12-23 15:02:51',NULL,'[b]But bbcode sure does.[/b]\r\n[url]http://www.fanficftion.net[/url]'),(2,54,1,'2017-12-23 16:18:21',NULL,'HTML2BBcode check\r\n[img alt=\"it works!\"]https://upload.wikimedia.org/wikipedia/commons/f/f2/GNU_30th_logo.png[/img]'),(1,55,1,'2017-12-23 16:35:37',NULL,'Checking custom bbcode\r\n[bbquote]Ninja[/bbquote]'),(1,56,1,'2017-12-23 18:30:16',NULL,'[bbquote][bbname]Dovahkiin[/bbname]Fus Ro dah![/bbquote]'),(1,57,1,'2017-12-23 18:40:09',NULL,'[bbquote]Will this fail?[/bbquote]'),(1,58,1,'2017-12-23 18:40:46',NULL,'bbname must always accompany bbquote.\r\n');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `t_uid` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `pub_date` datetime NOT NULL,
  `isSticky` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (1,1,'Hello, world','One ring to rule them all.\r\nOne ring to find them.\r\nOne ring to bring them all,\r\nAnd in the darkness bind them.',0,'2017-12-06 17:51:01','N'),(2,2,'Hello','Hi',0,'2017-12-11 19:42:23','N'),(3,1,'Karan ji','Hello.',0,'2017-12-11 19:52:43','N'),(4,3,'Hostel','',0,'2017-12-11 19:55:32','N'),(5,5,'Hello','',0,'2017-12-20 11:23:43','N');
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joined` date NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sanskar','$2y$10$5sscXrWkUXIDnAaJcwXYM.NyoeIp4HLYWmu2k.RB2CAKv792H9NKC','2017-12-06'),(2,'dovahkiin','$2y$10$pSewtV4sy.F8fGFrQcCOZevjL8CfD.pKatWFz7twKmbg5sdrHIP1G','2017-12-06'),(3,'karan','$2y$10$CzyRQDJmNszm7DHhD.mYqeorZ.ymYBIybisBgCUfseOq2YHCVa5T2','2017-12-11'),(4,'mala','$2y$10$u03xiYYGy4RhTxibKTII4Onk3dZ4TxgPMhUWqfA6WdGQ2W5LBbK62','2017-12-11'),(5,'shreeyash','$2y$10$WVOfbIZB9ygqJEnjxl9QX.xRLkOJB6rjDPWlykyhRCXHqqwJg2yzC','2017-12-20');
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

-- Dump completed on 2017-12-23 18:41:30
