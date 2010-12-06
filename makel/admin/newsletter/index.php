<?
require_once("includes/config.php");
include("classes/basicas.class.php");
include("classes/conexaoBd.class.php");
include("classes/upload.class.php");
include("classes/imagens.class.php");
include("classes/usaBd.class.php");
include("classes/newsletter.class.php");

include("../includes/funcoes.php");
if(!Logado())
{
	header('location: ../index.php');
} else {
	require_once("../modules/Usuario.php");
	$s_owner = $_SESSION['usuario'];
	$owner = new Usuario($s_owner['id']);
	$owner->loadAll();
	$owner = $_SESSION['usuario'];
	
	if ( !isset($_GET['p']) )
		$p = "newsletter";
	else
		$p = $_GET['p'];

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$site;?></title>

<style type="text/css">
	@import url('../css/geral.css'); 
</style>

</head>

<body>
<div id="header_logo">
</div>
<div id="header_topo">
</div>  
<div id="corpo">
    <div id="header">
	</div>
        <? include("includes/menu.php");
		$pagina = $p.".php";
		if(is_file($pagina)) { include($pagina); }
		else { include("../sair.php"); }
		?>
  <br class="clear" />  
</div>
<!-- fecha corpo -->	
	<div id="rodape"><a href="http://www.qualitare.com.br"><img src="../imagens/assinatura_qualitare.gif" alt="assinatura" width="44" height="18" /></a>	</div>
</body>
</html>