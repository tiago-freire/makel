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
			document.getElementById('boxImagem').innerHTML = '';
			document.getElementById('boxTexto').className = 'mostra';
		}	
		else
		{
			document.getElementById('boxImagem').innerHTML = 'Imagem: <input type="file" name="foto" />&nbsp;&nbsp;&nbsp;Link: http://<input type=\"text\" name=\"link\" ><br/>';
			document.getElementById('boxTexto').className  = 'esconde';		
		}
	}
	
</script>
<div id="tits">
    <img src="imagens/icon_modelos.gif" width="48" height="48" />
    <h2 class="titulo">Modelos de E-mails</h2>
</div>


<form method="post" action="./?p=forms/newsletter&op=ModeloCadastrar" enctype="multipart/form-data">
<table width="670" class="fundotable">
  <tr>
    <td class="title">Cadastrar novo modelo</td>
  </tr>
  <tr>
    <td><table width="670" border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td width="120" bgcolor="#FFFFFF" class="txtdir">Assunto do E-mail:</td>
        <td width="577" bgcolor="#FFFFFF"><input name="titulo" type="text" id="titulo" size="60" /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="txtdir">Tipo:</td>
        <td bgcolor="#FFFFFF" class="txtesq">
          <input name="tipo" value="1" id="1" type="radio" checked style="border:0;" onclick="checa(1);" />Texto<br />
		  <input name="tipo" value="2" id="2" type="radio" style="border:0;" onclick="checa(2);" />Imagem<br />
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF" class="titlecent">
        <div  id="boxTexto">
  		    <?php
			$oFCKeditor = new FCKeditor('texto') ;
			$oFCKeditor->BasePath = '../includes/fckeditor/';
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
    		<div id="boxImagem"></div>
	    </td>
      </tr>
    </table></td>
  </tr>
  <tr><td colspan="2" bgcolor="#FFFFFF"><br />
  Use <strong>[NOME]</strong> para exibir o nome do contato e <strong>[EMAIL]</strong> para o e-mail.<br />
  Para utilizar links que geram estatisticas utilize siga o exemplo:<br /> <strong>[AI]</strong>www.qualitare.com.br<strong>[/AI]</strong> clique aqui para ir para o site da Qualitare<strong>[AF/]</strong>
  <br /><br /></td></tr>
</table>
<br /><input type="submit" name="Submit" value="Cadastrar" />
</form>
<br />
<br />
<table width="670" border="0" cellspacing="1" cellpadding="5" background="#cccccc">
    <tr>
        <td class="title" colspan="4">Modelos Cadastrados </td>
    </tr>
    <?
	$sql = mysql_query("SELECT * FROM ".$tb_modelos." ORDER BY titulo ASC");			
	$z = 0;
	$class[0]="linha1";
	$class[1]="linha2";
    while($x = mysql_fetch_array($sql))
    {	
    ?>			
    <tr class="<?=$class[$z]?>">
        <td width="369"><?=$x['titulo'];?></td>
        <td width="58" class="opcoes"><a href="modelos.visualizar.php?&id=<?=$x['id'];?>" target="_blank">Visualizar</a></td>
        <td width="51" class="opcoes"><a href="./?p=modelos.editar&id=<?=$x['id'];?>">Editar</a></td>
        <td width="57" class="opcoes"><a href="./?p=forms/newsletter&amp;op=ModeloDeletar&amp;id=<?=$x['id'];?>">Deletar</a></td>
    </tr>
    <?  $z = !$z; } ?>
</table>

