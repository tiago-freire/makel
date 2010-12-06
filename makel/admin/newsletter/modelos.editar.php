<? include("../includes/fckeditor/fckeditor.php") ; ?>

<style type="text/css">
	.esconde { display: none; }
	.mostra { display:block; }
</style>

<script language="javascript">

	function checa( tipo )
	{
		if( tipo == 1 )
		{
			document.getElementById('boxImagem').className = 'esconde';
			document.getElementById('boxTexto').className = 'mostra';
		}	
		else
		{
			document.getElementById('boxImagem').className = 'mostra';
			document.getElementById('boxTexto').className  = 'esconde';		
		}
	}
	
</script>
<div id="tits">
    <img src="imagens/icon_modelos.gif" width="48" height="48" />
    <h2 class="titulo">Editar modelo</h2>
</div>
<?
$sql = mysql_query("SELECT * FROM $tb_modelos WHERE id='".$_GET['id']."'");
while($x = mysql_fetch_array($sql))
{
	$tipo = $x['tipo'];
?>
<form method="post" action="./?p=forms/newsletter&op=ModeloEditar" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$_GET['id'];?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="title" colspan="2">Editar modelo</td>
  </tr>
  <tr>
    <td class="txtdir">Assunto do E-mail:</td>
    <td class="txtesq"><input name="titulo" type="text" id="titulo" size="60" value="<?=$x['titulo'];?>" /></td>
  </tr>
  <tr>
    <td class="txtdir">Tipo:</td>
    <td class="txtesq"><input name="tipo" value="1" id="1" type="radio" checked style="border:0;" onclick="checa(1);" <? if($x['tipo']==1) echo 'checked'; ?> /><label for="1">Texto</label><br />
		  <input name="tipo" value="2" id="2" type="radio" style="border:0;" onclick="checa(2);" <? if($x['tipo']==2) echo 'checked'; ?> /><label for="2">Imagem</label><br /></td>
  </tr>
  <tr class="title">
    <td colspan="2">
    <div id="boxTexto">
    <?php
		$oFCKeditor = new FCKeditor('texto') ;
		$oFCKeditor->BasePath = '../includes/fckeditor/';
		$oFCKeditor->Value = $x['texto'];
		$oFCKeditor->ToolbarSet = "Default";
		$oFCKeditor->Width  = '100%' ;
		$oFCKeditor->Height = '600' ;
		$oFCKeditor->Create();
		?>
     </div>
    </td>
  </tr>
  
  <tr>
    <td colspan="2" class="titlecent">
    <div id="boxImagem">
		<input type="hidden" name="img_at" value="<?=$x['foto'];?>" />
		Imagem: <input type="file" name="foto" />
		<?
		if($x['foto'])
			echo "<br /><img src=\"docs/".$x['foto']."\">";
		?>
		&nbsp;&nbsp;&nbsp;
		Link: http://<input type="text" name="link" value="<?=$x['link'];?>" /></td>
     </div>
  </tr>
  <tr><td colspan="2" bgcolor="#FFFFFF"><br />
  Use <strong>[NOME]</strong> para exibir o nome do contato e <strong>[EMAIL]</strong> para o e-mail.<br />
  Para utilizar links que geram estatisticas utilize siga o exemplo:<br /> <strong>[AI]</strong>www.qualitare.com.br<strong>[/AI]</strong> clique aqui para ir para o site da Qualitare<strong>[AF/]</strong>
  <br /><br /></td></tr>
</table>
<input type="submit" name="Submit" value="Enviar" />
</form>
<? 
} 
if($tipo==2) { echo '<script> checa(2); </script>'; }
else echo '<script> checa(1); </script>';
?>