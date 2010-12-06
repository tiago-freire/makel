<?
	include_once("classes/Clientes.php");
?>
<div id="tits">
    <img src="imagens/icon_grupos.gif" width="48	" height="48" />
    <h2 class="titulo">Clientes</h2>
	<div align="right" width="90%"><img src="../imagens/icones/mini_icons/action_go.gif" width="16" height="16" align="absmiddle"><a href="./?p=clienteForm&amp;op=add">Adicionar Clientes</a></div>
</div>
<table width="100%" cellpadding="0" cellspacing="0">

        <?
		$sql = mysql_query("SELECT * FROM " . Clientes::$table . " ORDER BY nome ASC");
		$class[0]="linha1";
		$class[1]="linha2";
		$z = 0;
		if(mysql_num_rows($sql))
		{
		echo '
		  <tr>
			<td class="title">Nome</td>
			<td class="titlecent">Site</td>
			<td colspan="2" class="title">&nbsp;</td>
		  </tr>
		  ';
			while($x = mysql_fetch_array($sql))
			{	
			?>      
		<tr class="<?=$class[$z]?>">
			<td><?=$x['nome'];?></td>
			<td align="center"><?=$x['site']?></td>
			<td class="opcoes"><a href="./?p=clienteForm&amp;idCliente=<?=$x['id'];?>">Editar</a></td>
			<td class="opcoes"><a href="./?p=forms/newsletter&amp;op=GrupoDeletar&amp;id=<?=$x['id'];?>">Deletar</a></td>
		</tr>
		  <? 
		  $z = !$z;
		  }//while
		}//if num rows
		else { echo "<tr class='$class[$z]' ><td colspan='3'>Não há Clientes cadastrados.</td></tr>"; }
			
		 ?>
</table>
