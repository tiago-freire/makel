<table width="688" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><strong><a href="./?p=noticias.nova"><br /></a><a href="./?p=newsletter"><img src="imagens/153.jpg" width="48" height="48" border="0" /></a><br />
Voltar para Newsletter </strong> <br />
<br />
<br />
<table width="500" border="0" cellpadding="4" cellspacing="0" bgcolor="#EBEBEB">
  <tr>
    <td><div align="left"><strong>E-mails cadastrados </strong></div></td>
  </tr>
  <tr>
    <td><table width="500" border="0" cellspacing="1" cellpadding="5">
        <?
		$sql = mysql_query("SELECT * FROM $tb_newsletter ORDER BY email ASC");
		while($x = mysql_fetch_array($sql))
		{	
		?>
      <tr>
        <td width="378" bgcolor="#FFFFFF"><div align="left">
          <?=$x['email'];?>
        </div></td>
        <td width="99" bgcolor="#FFFFFF"><div align="center"><a href="./?p=forms/newsletter&amp;op=Deletar&amp;id=<?=$x['id'];?>">Deletar</a></div></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
</td>
  </tr>
</table>
