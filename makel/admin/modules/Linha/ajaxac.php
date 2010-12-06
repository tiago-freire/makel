<?php
header("Content-type: text/html;charset=iso-8859-1");

require_once("../../includes/config.php");
require_once("../../includes/Util.php");
require_once("../Produto.php");
$md = explode("/",$_SERVER['PHP_SELF']);
$module = $md[sizeof($md)-2];
require_once("../$module.php");

switch($_GET['op']) {
	case "atLegenda":
		$legenda = utf8_decode($_POST['legenda']);
		$produto = new Produto($_POST['foto']);
		$produto->nome = $legenda;
		$produto->save();
		
		echo $legenda;
	break;
	
	case "apagaFoto":
		$novo = new Produto($_GET['id']);
		Util::apagaImage($CIMAGENS[strtoupper($module)],$DEFINE[strtoupper($module)],UPIMAGENS,$novo->foto);
		$novo->delete();
		
		header("Location: {$_SERVER['HTTP_REFERER']}");
	break;

	default:
		echo "Operaчуo nуo reconhecida.";
}
?>