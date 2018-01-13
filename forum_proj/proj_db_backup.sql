-- MySQL dump 10.16  Distrib 10.1.30-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: proj_db
-- ------------------------------------------------------
-- Server version	10.1.30-MariaDB

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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid_1` int(11) NOT NULL,
  `uid_2` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid_1_read` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'T',
  `uid_2_read` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'F',
  `send_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,-1,'Test','Alpha Tango.\r\nFruity Mango.','F','T','2018-01-01 23:02:18'),(2,1,1,'Test','Alpha Tango.\r\nFruity Mango.','F','T','2018-01-01 23:02:39'),(3,1,1,'Test','Alpha tango.\r\nFruity mango.\r\nGeorge Carlin.','F','T','2018-01-01 23:02:53'),(4,1,1,'Test','sdfsdagsdf','F','T','2018-01-01 23:03:13'),(5,1,4,'Consider.','Let\'s\r\ndo\r\nAnil.','F','T','2018-01-01 23:18:50'),(6,4,-1,'toop','ma top khanxu','F','F','2018-01-01 23:19:50'),(7,1,1,'watashi','dwardwr \r\nfe\r\nchecking this\r\nMutltiple lines are very long. I see that the program is what it is. See it for what it is .\r\nMulti-size.\r\n\r\nCHECK CHECL                           CHECK                        CHECK                         CHECK       CHECK','F','T','2018-01-02 18:07:22'),(8,3,1,'test_2','Test.\r\nTest.\r\nTest.\r\nWhat the hell.\r\nyep.\r\nRWBY.','F','T','2018-01-03 00:04:20');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

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
  `attach` varchar(265) COLLATE utf8mb4_unicode_ci DEFAULT 'NIL',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,2,'2017-12-06 17:55:44',NULL,'Miraak? Is that you?','NIL'),(1,2,1,'2017-12-11 00:28:14',NULL,'Me: [b] FUS ROH DAH! [/b]\r\n[i]Testing BBcode parser [/i]','NIL'),(1,3,1,'2017-12-11 00:29:27',NULL,'<em>Trying again this time</em>.\r\n<strong> Fus Ro Dah! </strong>','NIL'),(1,4,1,'2017-12-11 00:34:04',NULL,'[url]htpp://www.fanfiction.net[/url]\r\n\r\n<span style=\"text-decoration:underline;\">What the?</span>.','NIL'),(1,5,1,'2017-12-11 00:34:22',NULL,'[link]http://www.example.com[/link]','NIL'),(1,6,1,'2017-12-11 00:35:23',NULL,'<em>Italics</em>','NIL'),(1,7,1,'2017-12-11 00:38:36',NULL,'[url href=\"http://www.fanfiction.net/alert/story.php\"] click me [/url]','NIL'),(1,8,1,'2017-12-11 00:39:46',NULL,'[url=\"http://www.fanfiction.net/alert/story.php\"] click me [/url]','NIL'),(1,9,1,'2017-12-11 00:40:08',NULL,'[big]thicc[/big]','NIL'),(1,10,1,'2017-12-11 00:48:26',NULL,'[i]Try again[/i]','NIL'),(1,11,1,'2017-12-11 00:48:40',NULL,'[b] Bishal [/b]','NIL'),(1,12,2,'2017-12-11 00:54:20',NULL,'[QUOTE]\r\nAre traps gay?\r\n[/QUOTE]','NIL'),(1,13,2,'2017-12-11 00:56:07',NULL,'[CODE]\r\ndef shout(name):\r\n    if name == \"dragonrend\":\r\n        print \"Joor Zah Frul!\"\r\n[/CODE]\r\n','NIL'),(1,14,2,'2017-12-11 00:56:54',NULL,'[list=A]\r\n[*]First item\r\n[*]Second item\r\n[/list]','NIL'),(1,15,2,'2017-12-11 00:58:11',NULL,'Normal text.\r\nCheck if textarea handles CRLF correctly.','NIL'),(1,16,2,'2017-12-11 00:58:26',NULL,'Apparently not.\r\n','NIL'),(1,17,2,'2017-12-11 01:02:48',NULL,'Trying to insert HTML breaks.\r\nDoes it work now?','NIL'),(1,18,2,'2017-12-11 01:03:24',NULL,'[CODE]\r\ndef shout(name):\r\n    if name  == \'dragonrend\':\r\n        print(\"Joor Zah Frul!\")\r\n[/CODE]','NIL'),(1,19,2,'2017-12-11 01:04:52',NULL,'what \r\nis \r\nit','NIL'),(1,20,2,'2017-12-11 01:13:42',NULL,'What is the\r\n    problem','NIL'),(1,21,2,'2017-12-11 01:48:19',NULL,'[url=\"http://www.fanfiction.net\"][/url]','NIL'),(2,22,3,'2017-12-11 19:43:49',NULL,'[CODE]\r\ndef say():\r\n    print(\"Eh vyah\")\r\n[/CODE]','NIL'),(2,23,3,'2017-12-11 19:44:05',NULL,'[B]Kasto mula saag rahechha[/B]','NIL'),(2,24,3,'2017-12-11 19:44:39',NULL,'[i]Eh vyah[/i]\r\n[url]http://www.google.com[/url]','NIL'),(3,25,3,'2017-12-11 19:53:12',NULL,'Vyaa!!','NIL'),(3,26,1,'2017-12-11 19:53:28',NULL,'Ke bhaneko','NIL'),(4,27,1,'2017-12-11 19:56:10',NULL,'Kina chup lageko?','NIL'),(4,28,3,'2017-12-11 19:56:18',NULL,'K cha kta ho??','NIL'),(4,45,1,'2017-12-12 16:26:10',NULL,'Tag check\r\nHtml: <b>What</b>\r\nbbcode: [b]U wot m8?[/b]\r\n','NIL'),(2,46,1,'2017-12-13 11:44:04',NULL,'Hello.\r\n[b]Bold[/b]','NIL'),(5,49,1,'2017-12-23 13:43:53',NULL,'Reply.\r\nNewline.\r\ndo it.','NIL'),(4,50,1,'2017-12-23 14:49:59',NULL,'[quote]Checking quotes[/quote]','NIL'),(4,51,1,'2017-12-23 15:00:05',NULL,'<a href=\"http://www.fanfiction.net\">Ninja</a>','NIL'),(4,52,1,'2017-12-23 15:02:22',NULL,'<b>Html doesnt work anymore.</b>','NIL'),(4,53,1,'2017-12-23 15:02:51',NULL,'[b]But bbcode sure does.[/b]\r\n[url]http://www.fanficftion.net[/url]','NIL'),(2,54,1,'2017-12-23 16:18:21',NULL,'HTML2BBcode check\r\n[img alt=\"it works!\"]https://upload.wikimedia.org/wikipedia/commons/f/f2/GNU_30th_logo.png[/img]','NIL'),(1,55,1,'2017-12-23 16:35:37',NULL,'Checking custom bbcode\r\n[bbquote]Ninja[/bbquote]','NIL'),(1,56,1,'2017-12-23 18:30:16',NULL,'[bbquote][bbname]Dovahkiin[/bbname]Fus Ro dah![/bbquote]','NIL'),(1,57,1,'2017-12-23 18:40:09',NULL,'[bbquote]Will this fail?[/bbquote]','NIL'),(1,58,1,'2017-12-23 18:40:46',NULL,'bbname must always accompany bbquote.\r\n','NIL'),(1,59,1,'2017-12-23 18:51:38',NULL,'[bbquote][bbname]dovahkiin[/bbname]Trying to insert HTML breaks.\r\nDoes it work now? [/bbquote]\r\n\r\nYep(op).','NIL'),(4,60,1,'2017-12-26 16:27:04',NULL,'[bbquote][bbname]karan[/bbname] K cha kta ho?? [/bbquote]\r\nThikai chha hamro, karan.\r\nTimro bhana haal khabar.','NIL'),(3,61,1,'2017-12-26 22:01:55',NULL,'[bbquote][bbname] [/bbname]Pic testing.[/bbquote]\r\nkeko testing, sir?','NIL'),(5,62,1,'2017-12-26 22:12:37',NULL,'[bbquote][bbname] sanskar[/bbname]Reply.\r\n\\nNewline.\r\n\\ndo it.[/bbquote]\r\nI did it myself.','NIL'),(5,63,1,'2017-12-26 22:13:03',NULL,'[bbquote][bbname] sanskar[/bbname][bbquote][bbname] sanskar[/bbname]Reply.\r\n\\n\\nNewline.\r\n\\n\\ndo it.[/bbquote]\r\n\\nI did it myself.[/bbquote]\r\n\r\nHow deep does the rabbit-hole go?','NIL'),(4,64,1,'2017-12-26 22:24:23',NULL,'[bbquote][bbname] sanskar[/bbname][bbquote][bbname]karan[/bbname] K cha kta ho?? [/bbquote]\r\nThikai chha hamro, karan.\r\nTimro bhana haal khabar.[/bbquote]\r\nAafu le aafai lai reply garne sabai bhanda berojgaar ho.','NIL'),(4,65,1,'2017-12-26 22:32:07',NULL,'[bbquote][bbname] sanskar[/bbname][bbquote][bbname] sanskar[/bbname][bbquote][bbname]karan[/bbname] K cha kta ho?? [/bbquote]\r\nThikai chha hamro, karan.\r\nTimro bhana haal khabar.[/bbquote]\r\nAafu le aafai lai reply garne sabai bhanda berojgaar ho.[/bbquote]\r\n\r\nHaddai cross vo.','NIL'),(4,66,1,'2017-12-26 22:33:33',NULL,'[bbquote][bbname] sanskar[/bbname][bbquote][bbname] sanskar[/bbname][bbquote][bbname] sanskar[/bbname][bbquote][bbname]karan[/bbname] K cha kta ho?? [/bbquote]\r\nThikai chha hamro, karan.\r\nTimro bhana haal khabar.[/bbquote]\r\nAafu le aafai lai reply garne sabai bhanda berojgaar ho.[/bbquote]\r\n\r\nHaddai cross vo.[/bbquote]\r\nRecursion ko baje.','NIL'),(2,67,1,'2017-12-26 22:38:59',NULL,'[bbquote][bbname] karan[/bbname][i]Eh vyah[/i]\r\n[url]http://www.google.com[/url][/bbquote]\r\n\r\nKe bhaneko yo?','NIL'),(5,68,1,'2017-12-27 09:50:59',NULL,'[bbquote][bbname] sanskar[/bbname][bbquote][bbname] sanskar[/bbname][bbquote][bbname] sanskar[/bbname]Reply.\r\n\\n\\nNewline.\r\n\\n\\ndo it.[/bbquote]\r\n\\nI did it myself.[/bbquote]\r\n\r\nHow deep does the rabbit-hole go?[/bbquote]\r\n\r\nPheri.','NIL'),(2,69,1,'2017-12-27 13:49:51',NULL,'[bbquote][bbname] sanskar[/bbname]Hello.\r\n[b]Bold[/b][/bbquote]\r\n\r\nabcd','NIL'),(2,70,3,'2017-12-27 14:17:40',NULL,'[bbquote][bbname] sanskar[/bbname][bbquote][bbname] karan[/bbname][i]Eh vyah[/i]\r\n[url]http://www.google.com[/url][/bbquote]\r\n\r\nKe bhaneko yo?[/bbquote]\r\n\r\nghgj','NIL'),(6,71,1,'2017-12-28 15:20:41',NULL,'This is very updog.','NIL'),(6,72,1,'2017-12-28 15:20:58',NULL,'[bbquote][bbname] sanskar[/bbname]This is very updog.[/bbquote]\r\n\r\nWhat\'s updog?','NIL'),(6,73,1,'2017-12-31 13:40:31',NULL,'[bbquote][bbname] sanskar[/bbname][bbquote][bbname] sanskar[/bbname]This is very updog.[/bbquote]\r\n\r\nWhat\'s updog?[/bbquote]\r\n\r\nUdip Parajuli.','NIL'),(6,86,1,'2018-01-12 15:55:56',NULL,'Checking file attachments.\r\n[img]https://pbs.twimg.com/media/BUcD9koCMAAbZxu.jpg[/img]','t-6DOWNLOAD AS CIVIL DISOBEDIENCE.png');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `pid` int(11) NOT NULL,
  `p_tid` int(11) NOT NULL,
  `read` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'F',
  `rep_uid` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (3,1,'F',1),(28,4,'F',1);
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (1,1,'Hello, world','One ring to rule them all.\r\nOne ring to find them.\r\nOne ring to bring them all,\r\nAnd in the darkness bind them.',0,'2017-12-06 17:51:01','N'),(2,2,'Hello','Hi',0,'2017-12-11 19:42:23','N'),(3,1,'Karan ji','Hello.',0,'2017-12-11 19:52:43','N'),(4,3,'Hostel','',0,'2017-12-11 19:55:32','N'),(5,5,'Hello','',0,'2017-12-20 11:23:43','N'),(6,1,'Doom','aflasjfsa\r\nBada bing\r\nbada boom.',0,'2017-12-28 15:20:17','N');
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
  `level` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'U',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sanskar','$2y$10$5sscXrWkUXIDnAaJcwXYM.NyoeIp4HLYWmu2k.RB2CAKv792H9NKC','2017-12-06','A'),(2,'dovahkiin','$2y$10$pSewtV4sy.F8fGFrQcCOZevjL8CfD.pKatWFz7twKmbg5sdrHIP1G','2017-12-06','U'),(3,'karan','$2y$10$CzyRQDJmNszm7DHhD.mYqeorZ.ymYBIybisBgCUfseOq2YHCVa5T2','2017-12-11','U'),(4,'red_boy','$2y$10$gYGwfG/tQOWSm4WEmQH9GOJmzp.Ndht5IlB1n8jO.y2e4rRotzz66','2018-01-01','B');
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

-- Dump completed on 2018-01-13 17:12:29
