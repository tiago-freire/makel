<?
$modulo = $_GET['module']; 

require("modules/Produto.php");
if(!$owner->hasPerm($modulo))
	Util::throwError('permissao');	

if (!strcmp($_GET['op'],"editar")) {
	$id = $_GET['id'];
	$action = "Atualizar";
	$novo = new $modulo($id);
	$produtos = Produto::getLast(0,"id","ASC","", $novo->id);
} else {
	$id = 0;
	$action = "Adicionar";
	$data = date("d-m-Y");
}
?>
<script type="text/javascript">
	var current = 1;
	
	function addInput(suffix) {
		$('#fileInputs').append($(
			  '<div id="input' + suffix + '">'
			+ '   <input name="foto' + suffix + '" type="file" id="foto' + suffix + '" class="formfield" size="20" />'
			+ '   &nbsp; Nome: <input name="nome' + suffix + '" type="text" id="nome' + suffix + '" size="30" maxlength="34" />'
			+ (suffix > 1 ? '   <img style="cursor:pointer" src="imagens/icones/mini_icons/action_stop.gif" alt="X" onclick="this.parentNode.parentNode.removeChild(this.parentNode)" />' : '')
			+ '</div>'
		));
	}
	
	$(function() {
		addInput(current);
		$('#addProduto').click(function() {
			addInput(++current);
		});
	});
</script>

 <h1><img src="modules/<?=$modulo?>/logo.gif" alt="user" width="64" height="64" align="absmiddle" />&nbsp;&nbsp;<?=$action.' '.$MODULES[$modulo]['singular']?> </h1>  
 <br />
<br />
<form name="frm<?=$modulo?>" method="post" action="modules/<?=$modulo?>/form.php?op=<?=$_GET['op']?>" enctype="multipart/form-data">
	 <input type="hidden" name="MAX_FILE_SIZE" value="104857600" />
	<input type="hidden" name="id" value="<?=$id?>" />
	<table width="100%">
      <tr>
        <td width="23%" class="left"><strong>Nome da linha</strong></td>
        <td width="77%" class="right">
			<input name="nome" type="text" value="<?=$novo->nome?>" size="50" maxlength="180" />
        </td>
      </tr>
      <tr>
        <td width="23%" class="left" valign="top"><strong>Produtos</strong></td>
        <td width="77%" class="right">
			<div id="fileInputs"></div>
			<input type="button" value="  +  " title="Adicionar mais produtos" id="addProduto" />
			<? if($produtos) { ?>
			<br />
			<div style="float:left;width:100%;">
				<? foreach($produtos as $produto) {
					echo '
					<div style="width:30%; padding:7px; display:inline; float:left; text-align:center">
						<div style="text-align:center">
							<img src="'. IMAGENS . "/micro/" . $produto['foto'].'" border="0" /><br />
							<input style="width:140px;margin:4px" type="text" name="gal'.$produto['id'].'" id="gal'.$produto['id'].'" maxlength="34" value="'.$produto['nome'].'"/>
						</div>
						<div style="text-align:left; padding-left: 30px;">
							<ul>
								<li style="display:block">
									<img src="imagens/action_refresh.gif" alt="editar nome" width="16" height="16" align="absmiddle" /> <a href="#" onclick="javascript:atualizaLegenda (\''.$produto['id'].'\',\''.$modulo.'\'); return false;">Editar nome </a>
								</li>
								<li style="display:block">
									<img src="imagens/action_stop.gif" alt="apagar" width="16" height="16" align="absmiddle" /> <a href="modules/'.$modulo.'/ajaxac.php?op=apagaFoto&galeria='.$id.'&id='.$produto['id'].'">Apagar</a>
								</li>
							</ul>
						</div>
					</div>';
				} ?>
				</div>
			<? } ?>
        </td>
      </tr>
      <tr>
        <td height="26" class="left">&nbsp;</td>
        <td class="right"><input type="submit" name="Submit" value="Cadastrar" class="button" /></td>
      </tr>
    </table>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
</form>