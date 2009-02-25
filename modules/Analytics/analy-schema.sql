# CocoaMySQL dump
# Version 0.7b5
# http://cocoamysql.sourceforge.net
#
# Host: woz.norex.ca (MySQL 5.0.22)
# Database: sheepdog1
# Generation Time: 2008-10-15 13:03:51 -0300
# ************************************************************

# Dump of table analytics
# ------------------------------------------------------------
DROP TABLE IF EXISTS `analytics`;
CREATE TABLE `analytics` (
  `id` int(11) NOT NULL auto_increment,
  `content` text,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
INSERT INTO modules VALUES(null ,'Analytics', 'Google Analytics', 'active', '99');
