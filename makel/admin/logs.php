<? 
require_once("includes/config.php");
require_once("includes/funcoes.php");
include_once("includes/Logger.php");
$logger = new Logger();
require_once("includes/Util.php");

if(!Logado())
{
	$mod = "Login";
}
else
{
	require_once("modules/Usuario.php");
	$s_owner = $_SESSION['usuario'];
	$owner = new Usuario($s_owner['id']);
	$owner->loadAll();
	if(!$owner->isAdmin())
		header("Location: index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Logs de Acesso</title>
<link href="css/geral.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

td { padding: 5px; font-size: 14px;}
-->
</style>
</head>

<body>
<h1> Logs de Acesso: <?=$SITE['name']?></h1>
<?php
	Logger::showLogs();
?>
</body>
</html>
