<?php
require_once("../../includes/config.php");
require_once("../../includes/funcoes.php");
require_once("../../includes/Util.php"); 
include_once("../../includes/Logger.php");
$logger = new Logger();
require_once("../Usuario.php");
if(!Logado())
{
	Util::throwError('permissao');
}
else

	$s_owner = $_SESSION['usuario'];
	$owner = new Usuario($s_owner['id']);
	$owner->loadAll();


switch($_GET['op'])
{
	case "add":
	case "editar":
		$id = $_POST['id'];
		
		if(strcmp($senha1,$senha2))
			Util::throwError('senhas');
		
		$novo = new Usuario($id);
		$data = $_POST;
		$data['senha'] = $_POST['senha1'];
		$data['perms'] = Util::concPerm($_POST['permissoes']);
		$novo->setData($data);
		$novo->save();
		if(!$_POST['id'])
			$acao = "adicionado";
		else
			$acao = "editado";
		$logger->add($owner->id,"Usuário $acao: $novo->login");
		Util::showMsg('Usuário cadastrado/editado com sucesso!', '../../index.php?module=Usuario');
		break;
	
	case "deletar":
		$id = $_GET['id'];
		$user = new Usuario($id);
		$delete = mysql_query("DELETE FROM usuarios WHERE user_id='$id' ") or die(mysql_error());
		$logger->add($owner->id,"Removido Usuário: $user->login");
		Util::showMsg('Usuário removido com sucesso!','../../index.php?module=Usuario');
		break;
		
	default:
		Util::showMsg('Operação não reconhecida','../../index.php');
}
?>

