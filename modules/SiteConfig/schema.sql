-- MySQL dump 10.11
--
-- Host: localhost    Database: david
-- ------------------------------------------------------
-- Server version	5.0.41

--
-- Table structure for table `config_options`
--

DROP TABLE IF EXISTS `config_options`;
CREATE TABLE `config_options` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `module` varchar(100) default NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(1000) default 'string',
  `value` varchar(10000) default '',
  `sort` int(11) NOT NULL default '10',
  `editable` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `name` USING HASH (`name`,`module`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_options`
--

LOCK TABLES `config_options` WRITE;
/*!40000 ALTER TABLE `config_options` DISABLE KEYS */;
INSERT INTO `config_options` VALUES (1,NULL,'email','Email address to send estimates and orders','string','wolfe@gac.edu',10,'1'),(2,NULL,'project types','Project types to list in pull down menu','list','Brochure, Poster, Business Cards',30,'1'),(3,NULL,'project label','Label to place over the project types','string','Project types',20,'1'),(4,'DMS','display?','Should the admin allow deletes?','string','blah blah',25,'0'),(5,NULL,'list test','list test','list','this,that,the other',10,'1'),(6,NULL,'enum','enum test','enum(a,b,c)','yes',10,'1'),(7,NULL,'integer','Integer test','int','314',10,'1'),(8,NULL,'php test','This is a test of PhP','php','a:4:{i:0;s:1:\"A\";i:1;s:1:\"B\";i:2;i:23;i:3;a:2:{i:0;s:1:\"a\";i:1;s:1:\"b\";}}',40,'0');
/*!40000 ALTER TABLE `config_options` ENABLE KEYS */;
UNLOCK TABLES;
