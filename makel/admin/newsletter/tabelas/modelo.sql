# DBTools DBMYSQL - MySQL Database Dump
#

SET FOREIGN_KEY_CHECKS=0;

# Dumping Table Structure for modelo

#
CREATE TABLE `modelo` (
  `id` int(11) NOT NULL auto_increment,
  `tipo` tinyint(1) default NULL,
  `texto` text,
  `foto` varchar(255) default NULL,
  `titulo` varchar(255) default NULL,
  `link` varchar(120) default NULL,	
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
#
SET FOREIGN_KEY_CHECKS=1

