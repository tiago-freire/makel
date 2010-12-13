CREATE TABLE linha (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  nome varchar(255) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  ordem int(10) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE `logs` (
  log_id int(11) NOT NULL AUTO_INCREMENT,
  log_user int(11) NOT NULL DEFAULT '0',
  log_datetime datetime DEFAULT NULL,
  log_atividade text NOT NULL,
  PRIMARY KEY (log_id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE produto (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  linha int(10) unsigned DEFAULT NULL,
  nome varchar(255) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  ordem int(10) unsigned NOT NULL,
  foto varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE usuarios (
  user_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  user_nome varchar(100) NOT NULL DEFAULT '',
  user_login varchar(45) NOT NULL DEFAULT '',
  user_senha varchar(120) NOT NULL DEFAULT '',
  user_perms varchar(255) DEFAULT NULL,
  user_admin tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (user_id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `usuarios` (`user_id`, `user_nome`, `user_login`, `user_senha`, `user_perms`, `user_admin`) VALUES
(1, 'Administrador', 'admin', '$1$0J2.HZ2.$2qEinjaboHpjpwG.0K.Mu0', 'Usuario;Linha;', 1);