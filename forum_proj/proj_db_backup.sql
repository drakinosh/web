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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,2,'2017-12-06 17:55:44',NULL,'Miraak? Is that you?'),(1,2,1,'2017-12-11 00:28:14',NULL,'Me: [b] FUS ROH DAH! [/b]\r\n[i]Testing BBcode parser [/i]'),(1,3,1,'2017-12-11 00:29:27',NULL,'<em>Trying again this time</em>.\r\n<strong> Fus Ro Dah! </strong>'),(1,4,1,'2017-12-11 00:34:04',NULL,'[url]htpp://www.fanfiction.net[/url]\r\n\r\n<span style=\"text-decoration:underline;\">What the?</span>.'),(1,5,1,'2017-12-11 00:34:22',NULL,'[link]http://www.example.com[/link]'),(1,6,1,'2017-12-11 00:35:23',NULL,'<em>Italics</em>'),(1,7,1,'2017-12-11 00:38:36',NULL,'[url href=\"http://www.fanfiction.net/alert/story.php\"] click me [/url]'),(1,8,1,'2017-12-11 00:39:46',NULL,'[url=\"http://www.fanfiction.net/alert/story.php\"] click me [/url]'),(1,9,1,'2017-12-11 00:40:08',NULL,'[big]thicc[/big]'),(1,10,1,'2017-12-11 00:48:26',NULL,'[i]Try again[/i]'),(1,11,1,'2017-12-11 00:48:40',NULL,'[b] Bishal [/b]'),(1,12,2,'2017-12-11 00:54:20',NULL,'[QUOTE]\r\nAre traps gay?\r\n[/QUOTE]'),(1,13,2,'2017-12-11 00:56:07',NULL,'[CODE]\r\ndef shout(name):\r\n    if name == \"dragonrend\":\r\n        print \"Joor Zah Frul!\"\r\n[/CODE]\r\n'),(1,14,2,'2017-12-11 00:56:54',NULL,'[list=A]\r\n[*]First item\r\n[*]Second item\r\n[/list]'),(1,15,2,'2017-12-11 00:58:11',NULL,'Normal text.\r\nCheck if textarea handles CRLF correctly.'),(1,16,2,'2017-12-11 00:58:26',NULL,'Apparently not.\r\n'),(1,17,2,'2017-12-11 01:02:48',NULL,'Trying to insert HTML breaks.\r\nDoes it work now?'),(1,18,2,'2017-12-11 01:03:24',NULL,'[CODE]\r\ndef shout(name):\r\n    if name  == \'dragonrend\':\r\n        print(\"Joor Zah Frul!\")\r\n[/CODE]'),(1,19,2,'2017-12-11 01:04:52',NULL,'what \r\nis \r\nit'),(1,20,2,'2017-12-11 01:13:42',NULL,'What is the\r\n    problem'),(1,21,2,'2017-12-11 01:48:19',NULL,'[url=\"http://www.fanfiction.net\"][/url]');
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
  `replies` int(11) NOT NULL DEFAULT '0',
  `pub_date` datetime NOT NULL,
  `isSticky` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (1,1,'Hello, world','One ring to rule them all.\r\nOne ring to find them.\r\nOne ring to bring them all,\r\nAnd in the darkness bind them.',0,0,'2017-12-06 17:51:01','N');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sanskar','$2y$10$5sscXrWkUXIDnAaJcwXYM.NyoeIp4HLYWmu2k.RB2CAKv792H9NKC','2017-12-06'),(2,'dovahkiin','$2y$10$pSewtV4sy.F8fGFrQcCOZevjL8CfD.pKatWFz7twKmbg5sdrHIP1G','2017-12-06');
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

-- Dump completed on 2017-12-11  8:44:15
