<?
	if (isset($_POST['grupo'])) {
		include('classes/importar.class.php');
		$resultado = Import::remove_duplicados($_POST['grupo']);
	}
?>
<div id="tits">
    <img src="imagens/ico_remove_duplicados.gif" width="48" height="48" />
    <h2 class="titulo">Remover E-mails Duplicados</h2>
</div>

<form method="post" action="./?p=duplicados">
<table width="500" border="0" cellpadding="4" cellspacing="0" bgcolor="#EBEBEB">
  <tr>
    <td><div align="left"><strong>Selecione o(s) grupo(s):</strong></div></td>
  </tr>
  <tr>
    <td><table width="500" border="0" cellspacing="1" cellpadding="5">
	<tr>
	<? 
	  	$sql= mysql_query("select id,nome from grupo order by nome") or die(mysql_error()); 
		$i = 0;
		while ($x = mysql_fetch_array($sql)) {
	?>
      <td bgcolor="#FFFFFF" width="50%"><div align="left">
          <label>
					<input type="checkbox" name="grupo[]" value="<?=$x['id'];?>" />&nbsp;<i><?=$x['nome'];?>
          </label>
        </div>
	  </td>
      
	<?  if ($i%2 != 0) echo '</tr><tr>';
		$i++;
		} ?>
	</tr>
    </table></td>
  </tr>
  <tr><td><input type="submit" value="Remover Duplicados" /></td></tr>
</table>
</form>
<br />
<br />
<? if (isset($resultado)) {?>
<table width="500" border="0" cellpadding="4" cellspacing="0" bgcolor="#EBEBEB">
  <tr>
    <td><div align="left"><strong>Relatório Final</strong></div></td>
  </tr>
  <tr>
    <td><table width="500" border="0" cellspacing="1" cellpadding="5">
	    <tr>
    	    <td width="10%"><b>Total:</b></td>
			<td><?=$resultado['total'];?></td>
        </tr>
		<tr>
    	    <td width="10%"><b>Duplicados:</b></td>
			<td><?=$resultado['deletado'];?></td>
        </tr>
		<tr>
    	    <td width="289" colspan="2"><b>Emails Deletados</b></td>
        </tr>
        <?
		$x = $resultado['em_deletado'];
		if (!isset($x[0])) {
			$x[0] = 'Nenhum e-mail deletado.';
		}
		foreach($x as $nx)
		{	
		?>
        
		<tr>
			<td  bgcolor="#FFFFFF" colspan="2"><div align="left">
			  <?=$nx;?>
			</div></td>
		</tr>
       <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>
<br /> </td>
  </tr>
</table>
