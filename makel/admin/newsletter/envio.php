<div id="tits">
    <img src="imagens/icon_envio.gif" width="48" height="48" />
    <h2 class="titulo">Envio de mensagens</h2>
</div>
<form method="post" action="./?p=forms/newsletter&op=Envio">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="title">Envio de Mensagem</td>
  </tr>
  <tr>
    <td class="txtdir">Para:</td>
    <td class="txtesq"><select name="grupo" id="grupo">
		  <option value="todos">Todos os e-mails da lista</option>
		  <? 
		  $sql = mysql_query("SELECT * FROM $tb_grupo ORDER BY nome ASC");
		  while($x = mysql_fetch_array($sql))
		  {
		  ?>
		  	<option value="<?=$x['id'];?>"><?=$x['nome'];?></option>
		  <? } ?>
          </select></td>
  </tr>
  <tr>
    <td class="txtdir">Mensagem:</td>
    <td class="txtesq"><select name="modelo">
		  <?
		  $sql = mysql_query("SELECT * FROM $tb_modelos ORDER BY titulo ASC");
		  while($x = mysql_fetch_array($sql))
		  {
		  ?>
		  	<option value="<?=$x['id'];?>"><?=$x['titulo'];?></option>
		  <? } ?>
          </select></td>
  </tr>
  <tr class="linha1">
    <td colspan="2" class="txtcent"><input type="submit" name="Submit" value="Enviar" /></td>
  </tr>
</table>
</form>