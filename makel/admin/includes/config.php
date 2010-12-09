<?
/* Constantes */
define("SITE_NAME", "Makel - Móveis para Escritório");
define("SITE_SMALL_NAME", "Makel");
define("SITE_DESCRIPTION", "");
define("SITE_KEYWORDS", "");
define("SITE_CONTATO", "contato@makelmoveis.com, administrativo@makelmoveis.com");

if($_SERVER['HTTP_HOST'] == 'servidor' || $_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1') {
	$BANCO = array('bd_host' => 'localhost', 'bd_login' => 'root', 'bd_pass' => '', 'bd_banco' => 'makel');
} else {
	$BANCO = array('bd_host' => 'localhost','bd_login' => 'makelmov_makel', 'bd_pass' => 'j~)*RQ9jvnKd', 'bd_banco' => 'makelmov_makel');
}

/* Módulos ativos */
$MODULES = array(
	"Usuario"=>array("plural"=>"Usuários do Gerenciador","singular"=>"Usuário","artigo"=>"o"),
	"Linha"=>array("plural"=>"Linhas","singular"=>"Linha","artigo"=>"a")
);

$DIVIDE = array(
	"Controle"=> array("Usuario"),
	"Conteúdo"=>array("Linha")
);

/* Dimensões das imagens */
$CIMAGENS['LINHA'] = array(
	'G'=>array("X"=>"700","Y"=>"700","Pasta"=>"","Corta"=>"0"),
	'M'=>array("X"=>"200","Y"=>"200","Pasta"=>"/medium","Corta"=>"1"),
	'P'=>array("X"=>"200","Y"=>"100","Pasta"=>"/thumb","Corta"=>"1"),
	'PP'=>array("X"=>"80","Y"=>"80","Pasta"=>"/micro","Corta"=>"1")
);

$DEFINE = array(
	"LINHA" => array('G','M','P','PP')
);

/* Diretórios */
define("BASE_GERENCIA","admin");
define("INCLUDES",BASE_GERENCIA . "/includes");
define("MODULOS",BASE_GERENCIA ."/modules");
define("IMAGENS","uploads/imagens");
define("UPIMAGENS","../../uploads/imagens");

/* Conexão ao banco de dados */
$conn = mysql_connect($BANCO['bd_host'], $BANCO['bd_login'], $BANCO['bd_pass']) or die(mysql_error());
mysql_select_db($BANCO['bd_banco'], $conn) or die("Erro na conexão com o banco de dados.");

/* Locale e timezone */
setlocale(LC_ALL, NULL);
setlocale(LC_ALL, "pt_BR");
date_default_timezone_set("Etc/GMT+3");

/* Sessão */
session_name(SITE_SMALL_NAME);
session_start();
set_time_limit(0);
ini_set("memory_limit", -1);
?>