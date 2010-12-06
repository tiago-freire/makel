# DBTools DBMYSQL - MySQL Database Dump
#

SET FOREIGN_KEY_CHECKS=0;

# Dumping Table Structure for usuarios

#
CREATE TABLE `usuarios` (
  `id` int(5) NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
#
# Dumping Data for usuarios
#
INSERT INTO `usuarios` (id, nome, login, senha, nivel) VALUES (1, 'Josué', 'josue', 'cfe765fbcde56acbc69ed0b317094463', 1);
SET FOREIGN_KEY_CHECKS=1

