<?
require_once("classes/importar.class.php");
switch($_GET['op'])
{

	case 'GrupoCadastrar':
		$cadastrar = new usaBd($tb_grupo);
		$cadastrar->insere(array('nome'=>$_POST['nome']));
		Basicas::alertaRedir('Grupo cadastrado com sucesso!','./?p=grupos');		
	break;
	//
	case 'GrupoEditar':
		$editar = new usaBd($tb_grupo);
		$editar->edita(array('nome'=>$_POST['nome']),array('id'=>$_POST['id']));
		Basicas::alertaRedir('Grupo editado com sucesso!','./?p=grupos');	
	break;
	//
	case 'GrupoDeletar':
		$deletar = new usaBd($tb_grupo);
		$deletar->deleta(array("id"=>$_GET['id']));
		Basicas::alertaRedir('Grupo deletado com sucesso!','./?p=grupos');
	break;
	//	
	case 'EmailCadastrar':
		$cadastrar = new usaBd($tb_emails);
		$data = "";
		if (($_POST['dia']) and ($_POST['mes']))
			$data = date('Y').'-'.$_POST['mes'].'-'.$_POST['dia'];
		$email = $_POST['email'];
		if (Import::valido($email)) {
			if (Import::existe($_POST['email'],$_POST['grupo'])) {
				$cadastrar->insere(array('email'=>$_POST['email'],'nome'=>$_POST['nome'],'data'=>$data,'grupo'=>$_POST['grupo']));		
				Basicas::alertaRedir('E-mail cadastrado com sucesso!','./?p=emails');
			} else 
				Basicas::alertaRedir('Este e-mail já está cadastrado neste grupo!',"./?p=emails&tipo=2&busca=$email");
		} else 
			Basicas::alertaRedir('E-mail inválido!','./?p=emails');
			
	break;
	//
	case 'EmailEditar':
		$editar = new usaBd($tb_emails);

		$data = "";
		if (($_POST['dia']) and ($_POST['mes']))
			$data = date('Y').'-'.$_POST['mes'].'-'.$_POST['dia'];

		$editar->edita(array('email'=>$_POST['email'],'nome'=>$_POST['nome'],'data'=>$data,'grupo'=>$_POST['grupo']),array('id'=>$_POST['id']));		
		Basicas::alertaRedir('E-mail editado com sucesso!','./?p=emails');
	break;	
	//
	case 'EmailDeletar':
		$deletar = new usaBd($tb_emails);
		for($i=0; $i < count($_POST['id']); $i++ )
			$deletar->deleta(array("id"=>$_POST['id'][$i]));
		Basicas::alertaRedir('E-mail deletado com sucesso!','./?p=emails');
	break;
	//
	case 'ModeloCadastrar':
		$cadastrar = new usaBd($tb_modelos);
		$cadastrar->setaDiretorio($dirF);
		if($_FILES['foto']['name'])
		{
			$cadastrar->enviar('foto');
			$foto = $cadastrar->pegaNome();
		}			
		$cadastrar->insere(array('tipo'=>$_POST['tipo'],'titulo'=>$_POST['titulo'],'texto'=>$_POST['texto'],'link'=>$_POST['link'],'foto'=>$foto));		
		Basicas::alertaRedir('Modelo cadastrado com sucesso!','./?p=modelos');		
	break;	
	//
	case 'ModeloEditar':
		$editar = new usaBd($tb_modelos);
		$editar->setaDiretorio($dirF);
		if($_FILES['foto']['name'])
		{
			$editar->enviar('foto');
			$foto = $editar->pegaNome();
			if($_POST['img_at']) $editar->deletar($_POST['img_at']);
			$editar->edita(array('foto'=>$foto),array('id'=>$_POST['id']));
		}		
		$editar->edita(array('tipo'=>$_POST['tipo'],'titulo'=>$_POST['titulo'],'link'=>$_POST['link'],'texto'=>$_POST['texto']),array('id'=>$_POST['id']));		
		Basicas::alertaRedir('Modelo editado com sucesso!','./?p=modelos');
	break;	
	//
	case 'ModeloDeletar':
		$deletar = new usaBd($tb_modelos);
		$deletar->deleta(array("id"=>$_GET['id']));
		Basicas::alertaRedir('Modelo deletado com sucesso!','./?p=modelos');
	break;	
	//
	case 'Envio':
		if( $_POST['grupo'] == 'todos' ) 
			$total = mysql_result(mysql_query("SELECT COUNT(distinct email) FROM $tb_emails") , 0 ); 
		else
			$total = mysql_result( mysql_query("SELECT COUNT(distinct email) FROM $tb_emails WHERE grupo='".$_POST['grupo']."'") , 0 );
			
		echo "<script>location.href = \"envia.msg.php?modelo=".$_POST['modelo']."&grupo=".$_POST['grupo']."&assunto=$assunto&atual=0&total=$total\"; </script>";		
	break;	
}
?>