<?php
$site		 = "Actual - Newsletter";
//Dados para Newsletter
$filesurl = "http://www.actualcambio.com/gerencia/newsletter/docs/";
$removeurl = "http://www.actualcambio.com/gerencia/newsletter/newsform.php?op=remover";
$urlimg = "http://www.actualcambio.com/gerencia/newsletter/includes/imagem.php";
$urlclk = "http://www.actualcambio.com/gerencia/newsletter/includes/click.php";
$mailfrom = "contato@actual.com.br";
$mailfromname = "Actual";
/*
$CONFIG['email'] = "mailer@actual.com.br";
$CONFIG['email_pass'] = "tambia08";
$CONFIG['mail'] = '201.33.18.238';
*/
// Tabelas - Gerência
$tb_usuarios   = "usuarios";
$tb_permissoes = "permissoes";
$tb_grupo	   = "grupo";
$tb_emails	   = "emails";
$tb_modelos	   = "modelo";

// Diretórios
$dirF = "docs";

// Inicia Conexão
require("../includes/config.php");
?>
