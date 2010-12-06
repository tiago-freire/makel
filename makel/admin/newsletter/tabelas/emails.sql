# DBTools DBMYSQL - MySQL Database Dump
#

SET FOREIGN_KEY_CHECKS=0;

# Dumping Table Structure for emails

#
CREATE TABLE `emails` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(255) default NULL,
  `nome` varchar(255) default NULL,
  `data` date default NULL,
  `grupo` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
#
SET FOREIGN_KEY_CHECKS=1

