<?php
require_once("../../includes/config.php");
require_once("../../includes/funcoes.php");
include_once("../../includes/Logger.php");
$logger = new Logger();
require_once("../../includes/Util.php"); 
require_once("../../includes/m2brimagem.php"); 
require_once("../Usuario.php");
require_once("../Produto.php");
$md = explode("/",$_SERVER['PHP_SELF']);
$module = $md[sizeof($md)-2];
require_once("../$module.php");
if(!Logado())
	Util::throwError('permissao');
else
	$s_owner = $_SESSION['usuario'];
$owner = new Usuario($s_owner['id']);
$owner->loadAll();

$alvo = $module;
$modulo = $MODULES[$alvo];		
switch($_GET['op'])
{
	case "add":
	case "editar":
		$id = $_POST['id'];
		$novo = new $module($id);
		
		$dados = $_POST;
		
		$dados['data'] = date("Y-m-d H:i:s");
		
		$novo->setData($dados);
		$novo->save();
		
		$files = $_FILES;
		foreach($files as $key => $file) {
			if(strstr($key, "foto")) {
				$i = str_replace("foto", "", $key);
				$foto = $file;
				$foto_name = $foto['tmp_name'];
				if(!empty($foto_name)) {
					$imagem = Util::saveImage($foto,UPIMAGENS,$DEFINE[strtoupper($module)],$CIMAGENS[strtoupper($module)]);
					if($imagem) {
						$produto = new Produto();
						$arq =  array("linha"=>$novo->id, "nome" => $_POST['nome'.$i], "data" => $novo->data, "foto"=>$imagem);
						$produto->setData($arq);
						$produto->save();
					}
				}
			}
		}
		
		if(!$_POST['id'])
			$acao = "cadastrada";
		else
			$acao = "editada";
			
		$logger->add($owner->id, $modulo['singular'] .  " $acao: $novo->nome");
		Util::showMsg($modulo['singular'] .  " $acao com sucesso","../../index.php?module=$alvo");
	break;
	
	case "apagar":
		$id = $_GET['id'];
		$old = new $module($id);
		$logger->add($owner->id, $modulo['singular'] .  " removida: $old->nome");
		$produtos = Produto::getLast(0,"id","DESC","",$old->id);
		
		if ($produtos) {
			foreach ($produtos as $produto) {
				$p = new Produto($produto['id']);
				Util::apagaImage($CIMAGENS[strtoupper($module)],$DEFINE[strtoupper($module)],UPIMAGENS,$p->foto);
				$p->delete();
			}
		}
		
		$old->delete();
		
		Util::showMsg($modulo['singular'] .  " removida com sucesso","../../index.php?module=$alvo");
		break;
	
	default:
		Util::showMsg('Operaчуo nуo reconhecida','../../index.php');
}
?>