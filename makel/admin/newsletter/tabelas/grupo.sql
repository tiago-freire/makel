# DBTools DBMYSQL - MySQL Database Dump
#

SET FOREIGN_KEY_CHECKS=0;

# Dumping Table Structure for grupo

#
CREATE TABLE `grupo` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
#
SET FOREIGN_KEY_CHECKS=1

