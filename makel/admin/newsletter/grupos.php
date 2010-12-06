<div id="tits">
    <img src="imagens/icon_grupos.gif" width="48" height="48" />
    <h2 class="titulo">Grupos</h2>
</div>
<form method="post" action="./?p=forms/newsletter&op=GrupoCadastrar">

<table width="100%">
  <tr>
    <td class="title">Cadastrar novo grupo</td>
  </tr>
  <tr class="linha1">
     <td class="txtcent">Nome:&nbsp; <input name="nome" type="text" id="nome" size="60" />&nbsp;&nbsp;
          <input type="submit" name="Submit" value="Cadastrar" />        
     </td>
  </tr>
 </table>
 <br /><br />
 
 <table width="100%" cellpadding="0" cellspacing="0">
  <tr>
  	<td class="title">Grupo</td>
    <td class="titlecent">Inscritos</td>
    <td colspan="2" class="title">&nbsp;</td>
  </tr>
        <?
		$sql = mysql_query("SELECT * FROM $tb_grupo ORDER BY nome ASC");
		$class[0]="linha1";
		$class[1]="linha2";
		$z = 0;
		while($x = mysql_fetch_array($sql))
		{	

			$temp = mysql_query("SELECT count(id) FROM emails WHERE grupo='{$x['id']}' ") or die(mysql_error());
			$total = mysql_result($temp,0);
		?>      
	<tr class="<?=$class[$z]?>">
        <td><?=$x['nome'];?></td>
        <td align="center"><?=$total?></td>
        <td class="opcoes"><a href="./?p=grupos.editar&amp;id=<?=$x['id'];?>">Editar</a></td>
        <td class="opcoes"><a href="./?p=forms/newsletter&amp;op=GrupoDeletar&amp;id=<?=$x['id'];?>">Deletar</a></td>
    </tr>
      <? 
	  $z = !$z;
	  } ?>
</table>
</form>