-- MySQL dump 10.13  Distrib 5.1.69, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: postmin
-- ------------------------------------------------------
-- Server version	5.1.69

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
-- Table structure for table `access`
--

DROP TABLE IF EXISTS `access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access` (
  `accessid` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) COLLATE utf8_bin NOT NULL,
  `access` varchar(255) COLLATE utf8_bin NOT NULL,
  `action` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `active` varchar(1) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`accessid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access`
--

LOCK TABLES `access` WRITE;
/*!40000 ALTER TABLE `access` DISABLE KEYS */;
/*!40000 ALTER TABLE `access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aliasdomains`
--

DROP TABLE IF EXISTS `aliasdomains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aliasdomains` (
  `aliasdomainsid` int(11) NOT NULL AUTO_INCREMENT,
  `orig_domain` varchar(255) COLLATE utf8_bin NOT NULL,
  `final_domain` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `active` varchar(1) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`aliasdomainsid`),
  UNIQUE KEY `orig_domain` (`orig_domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aliasdomains`
--

LOCK TABLES `aliasdomains` WRITE;
/*!40000 ALTER TABLE `aliasdomains` DISABLE KEYS */;
/*!40000 ALTER TABLE `aliasdomains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aliases`
--

DROP TABLE IF EXISTS `aliases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aliases` (
  `aliasid` int(11) NOT NULL AUTO_INCREMENT,
  `orig_dest` varchar(255) COLLATE utf8_bin NOT NULL,
  `final_dest` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `active` varchar(1) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`aliasid`),
  UNIQUE KEY `orig_dest` (`orig_dest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aliases`
--

LOCK TABLES `aliases` WRITE;
/*!40000 ALTER TABLE `aliases` DISABLE KEYS */;
/*!40000 ALTER TABLE `aliases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awl`
--

DROP TABLE IF EXISTS `awl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awl` (
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ip` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `count` int(11) NOT NULL DEFAULT '0',
  `totscore` float NOT NULL DEFAULT '0',
  `signedby` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`email`,`signedby`,`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awl`
--

LOCK TABLES `awl` WRITE;
/*!40000 ALTER TABLE `awl` DISABLE KEYS */;
/*!40000 ALTER TABLE `awl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bayes_expire`
--

DROP TABLE IF EXISTS `bayes_expire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bayes_expire` (
  `id` int(11) NOT NULL DEFAULT '0',
  `runtime` int(11) NOT NULL DEFAULT '0',
  KEY `bayes_expire_idx1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bayes_expire`
--

LOCK TABLES `bayes_expire` WRITE;
/*!40000 ALTER TABLE `bayes_expire` DISABLE KEYS */;
/*!40000 ALTER TABLE `bayes_expire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bayes_global_vars`
--

DROP TABLE IF EXISTS `bayes_global_vars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bayes_global_vars` (
  `variable` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `value` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`variable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bayes_global_vars`
--

LOCK TABLES `bayes_global_vars` WRITE;
/*!40000 ALTER TABLE `bayes_global_vars` DISABLE KEYS */;
INSERT INTO `bayes_global_vars` VALUES ('VERSION','3');
/*!40000 ALTER TABLE `bayes_global_vars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bayes_seen`
--

DROP TABLE IF EXISTS `bayes_seen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bayes_seen` (
  `id` int(11) NOT NULL DEFAULT '0',
  `msgid` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `flag` char(1) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`,`msgid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bayes_seen`
--

LOCK TABLES `bayes_seen` WRITE;
/*!40000 ALTER TABLE `bayes_seen` DISABLE KEYS */;
/*!40000 ALTER TABLE `bayes_seen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bayes_token`
--

DROP TABLE IF EXISTS `bayes_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bayes_token` (
  `id` int(11) NOT NULL DEFAULT '0',
  `token` char(5) COLLATE utf8_bin NOT NULL DEFAULT '',
  `spam_count` int(11) NOT NULL DEFAULT '0',
  `ham_count` int(11) NOT NULL DEFAULT '0',
  `atime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`token`),
  KEY `bayes_token_idx1` (`id`,`atime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bayes_token`
--

LOCK TABLES `bayes_token` WRITE;
/*!40000 ALTER TABLE `bayes_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `bayes_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bayes_vars`
--

DROP TABLE IF EXISTS `bayes_vars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bayes_vars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `spam_count` int(11) NOT NULL DEFAULT '0',
  `ham_count` int(11) NOT NULL DEFAULT '0',
  `token_count` int(11) NOT NULL DEFAULT '0',
  `last_expire` int(11) NOT NULL DEFAULT '0',
  `last_atime_delta` int(11) NOT NULL DEFAULT '0',
  `last_expire_reduce` int(11) NOT NULL DEFAULT '0',
  `oldest_token_age` int(11) NOT NULL DEFAULT '2147483647',
  `newest_token_age` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bayes_vars_idx1` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bayes_vars`
--

LOCK TABLES `bayes_vars` WRITE;
/*!40000 ALTER TABLE `bayes_vars` DISABLE KEYS */;
/*!40000 ALTER TABLE `bayes_vars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domains`
--

DROP TABLE IF EXISTS `domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domains` (
  `domainid` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `active` varchar(1) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`domainid`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domains`
--

LOCK TABLES `domains` WRITE;
/*!40000 ALTER TABLE `domains` DISABLE KEYS */;
/*!40000 ALTER TABLE `domains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expires`
--

DROP TABLE IF EXISTS `expires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expires` (
  `username` varchar(75) COLLATE utf8_bin NOT NULL,
  `mailbox` varchar(255) COLLATE utf8_bin NOT NULL,
  `expire_stamp` int(11) NOT NULL,
  PRIMARY KEY (`username`,`mailbox`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expires`
--

LOCK TABLES `expires` WRITE;
/*!40000 ALTER TABLE `expires` DISABLE KEYS */;
/*!40000 ALTER TABLE `expires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logging`
--

DROP TABLE IF EXISTS `logging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logging` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `mailboxid` int(11) NOT NULL,
  `type` varchar(4) COLLATE utf8_bin NOT NULL,
  `msg` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logging`
--

LOCK TABLES `logging` WRITE;
/*!40000 ALTER TABLE `logging` DISABLE KEYS */;
/*!40000 ALTER TABLE `logging` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mailboxes`
--

DROP TABLE IF EXISTS `mailboxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mailboxes` (
  `mailboxesid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `maildir` varchar(255) COLLATE utf8_bin NOT NULL,
  `quota` varchar(20) COLLATE utf8_bin NOT NULL,
  `local_part` varchar(255) COLLATE utf8_bin NOT NULL,
  `domain` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` varchar(1) COLLATE utf8_bin NOT NULL,
  `admin` varchar(1) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `cookiestring` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `ip` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`mailboxesid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mailboxes`
--

LOCK TABLES `mailboxes` WRITE;
/*!40000 ALTER TABLE `mailboxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `mailboxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quota`
--

DROP TABLE IF EXISTS `quota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `bytes` varchar(20) COLLATE utf8_bin NOT NULL,
  `messages` varchar(11) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota`
--

LOCK TABLES `quota` WRITE;
/*!40000 ALTER TABLE `quota` DISABLE KEYS */;
/*!40000 ALTER TABLE `quota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smarthosts`
--

DROP TABLE IF EXISTS `smarthosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smarthosts` (
  `smarthostsid` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) COLLATE utf8_bin NOT NULL,
  `smarthost` varchar(255) COLLATE utf8_bin NOT NULL,
  `action` varchar(10) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` varchar(1) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`smarthostsid`),
  UNIQUE KEY `smarthost` (`smarthost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smarthosts`
--

LOCK TABLES `smarthosts` WRITE;
/*!40000 ALTER TABLE `smarthosts` DISABLE KEYS */;
/*!40000 ALTER TABLE `smarthosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transports`
--

DROP TABLE IF EXISTS `transports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transports` (
  `transportsid` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) COLLATE utf8_bin NOT NULL,
  `transport` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` varchar(1) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`transportsid`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transports`
--

LOCK TABLES `transports` WRITE;
/*!40000 ALTER TABLE `transports` DISABLE KEYS */;
/*!40000 ALTER TABLE `transports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userpref`
--

DROP TABLE IF EXISTS `userpref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userpref` (
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `preference` varchar(30) COLLATE utf8_bin NOT NULL,
  `value` varchar(100) COLLATE utf8_bin NOT NULL,
  `prefid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`prefid`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userpref`
--

LOCK TABLES `userpref` WRITE;
/*!40000 ALTER TABLE `userpref` DISABLE KEYS */;
INSERT INTO `userpref` VALUES ('$GLOBAL','required_hits','5.00',1),('$GLOBAL','score SPF_FAIL','2.00',2),('$GLOBAL','score SPF_HELO_FAIL','2.00',3),('$GLOBAL','score BAYES_99','4.30',4),('$GLOBAL','score BAYES_90','3.50',5),('$GLOBAL','score BAYES_80','3.00',6),('$GLOBAL','subject_tag','[SPAM-_HITS_] - ',7),('$GLOBAL','score USER_IN_WHITELIST','-30',8),('$GLOBAL','score USER_IN_BLACKLIST','30',9),('$GLOBAL','report_safe','0',11),('$GLOBAL','use_razor2','1',12),('$GLOBAL','use_pyzor','1',13),('$GLOBAL','use_dcc','0',14),('$GLOBAL','use_bayes','1',15),('$GLOBAL','ok_locales','en',16),('$GLOBAL','ok_languages','en',17),('$GLOBAL','use_auto_whitelist','1',18),('$GLOBAL','rewrite_header Subject','[SPAM-_HITS_] - ',19),('$GLOBAL','remove_header ham','Status',20),('$GLOBAL','remove_header ham','Level',21),('$GLOBAL','add_header spam','Flag _YESNOCAPS_',22),('$GLOBAL','add_header all','Status _YESNO_, score=_SCORE_ required=_REQD_ tests=_TESTS_ autolearn=_AUTOLEARN_ version=_VERSION_',23),('$GLOBAL','add_header all','Level _STARS(*)_',24);
/*!40000 ALTER TABLE `userpref` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-22 16:23:46
