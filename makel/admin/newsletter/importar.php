<?
	if (isset($_POST['conteudo'])) {
		include('../includes/Util.php');
		require_once('./classes/importar.class.php');

		$arquivo = Util::saveFile($_FILES['arquivo'],"../uploads/arquivos");

		$resultado = Import::importar('../uploads/arquivos/'.$arquivo,$_POST['grupo'],'L',$_POST['caracter'],$_POST['conteudo'],$_POST['ordem']);
	}
?>
<div id="tits">
    <img src="imagens/ico_import_txt.gif" width="48" height="48" border="0" />
    <h2 class="titulo">Importar E-mails em Massa</h2>
</div>
<form method="post" action="./?p=importar" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="title">Importar TXT</td>
  </tr>
  <tr>
    <td class="txtdir">Arquivo:</td>
    <td class="txtesq"><input name="arquivo" type="file" id="nome" size="60" /></td>
  </tr>
  <tr>
    <td class="txtdir">Este arquivo contém:</td>
    <td class="txtesq">&nbsp;</td>
  </tr>
  <tr>
    <td class="txtcent"></td>
    <td class="txtesq"><strong>CAMPO | ORDEM</strong></td>
  </tr>
  <tr>
    <td class="txtdir"><label>Nome:
        <input  type="checkbox" name="conteudo[]2" value="Nome" />
    </label></td>
    <td class="txtesq"><input type="text" value="1" name="ordem[]2" size="5" maxlength="1"/></td>
  </tr>
  <tr>
    <td class="txtdir"><label>Email:
      <input type="checkbox" name="conteudo[]3" value="Email" /></label></td>
    <td class="txtesq"><input type="text" value="2" name="ordem[]3" size="5" maxlength="1" /></td>
  </tr>
  <tr>
    <td class="txtdir"><label>Aniversário:
      <input type="checkbox" name="conteudo[]4" value="Niver" /></label></td>
    <td class="txtesq"><input type="text" value="3" name="ordem[]4" size="5" maxlength="1"/></td>
  </tr>
  <tr>
    <td colspan="2" class="txtcent">Estes dados deve ser separados por uma quebra de linha</td>
  </tr>
  <tr>
    <td class="txtdir">Caractere:</td>
    <td class="txtesq"><input type="text" name="caracter" size="10" /></td>
  </tr>
  <tr>
    <td class="txtdir">Grupo:</td>
    <td class="txtesq"><? 
		  	$sql= mysql_query("select id,nome from grupo order by nome") or die(mysql_error()); 
		  ?>
			<select name="grupo">
			<? while ($x = mysql_fetch_array($sql)) { ?>
				<option value="<?=$x['id'];?>"><?=$x['nome'];?></option>
			<? } ?>
			</select></td>
  </tr>
  <tr class="linha1">
    <td colspan="2" class="txtcent"><input type="submit" name="Submit" value="Importar E-mails" /></td>
  </tr>
</table>
</form>
<br />
<br />
<? if (isset($resultado)) {?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="title">Relatório Final</td>
  </tr>
  <tr>
    <td width="24%" class="txtdir">Total:</td>
    <td width="72%" class="txtesq"><strong><?=$resultado['total'];?></strong></td>
  </tr>
  <tr>
    <td class="txtdir">Duplicados:</td>
    <td class="txtesq"><strong><?=$resultado['duplicados'];?></strong></td>
  </tr>
  <tr>
    <td class="txtdir">Inválidos:</td>
    <td class="txtesq"><strong><?=$resultado['invalidos'];?></strong></td>
  </tr>
  <tr>
    <td colspan="2" class="txtcent">Emails Inválidos (não foram inseridos)</td>
  </tr>
  <?
	$x = $resultado['e_invalidos'];
	foreach($x as $nx)
	{	
	?>
    <tr>
        <td colspan="2" class="txtcent"><?=$nx;?></td>
      </tr>
      <? } ?>
</table>
<? } ?>
