<div id="tits">
    <img src="imagens/icon_cadastro.gif" width="48" height="48" />
    <h2 class="titulo">Editar E-mail</h2>
</div>
<?
$sql = mysql_query("SELECT * FROM $tb_emails WHERE id='".$_GET['id']."'");
while($x = mysql_fetch_array($sql))
{
	$dia = date('d', strtotime($x['data']));
	$mes = date('m', strtotime($x['data']));
?>
<form method="post" action="./?p=forms/newsletter&op=EmailEditar">
<input type="hidden" name="id" value="<?=$_GET['id'];?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="title">Editar E-mail</td>
  </tr>
  <tr>
    <td class="txtdir">Nome:</td>
    <td class="txtesq"><input name="nome" type="text" id="nome" size="60" value="<?=$x['nome'];?>" /></td>
  </tr>
  <tr>
    <td class="txtdir">E-mail:</td>
    <td class="txtesq"><input name="email" type="text" id="email" size="60" value="<?=$x['email'];?>" /></td>
  </tr>
  <tr>
    <td class="txtdir">Aniversário:</td>
    <td class="txtesq"><select name="dia" id="dia">
		  	<option value="01">- Dia -</option>
			<? 
			for($i=1; $i<=31; $i++){
			if($i < 10) { $i="0".$i; }
			?>
			<option value="<?=$i;?>" <? if($dia == $i) echo 'selected'; ?>><?=$i;?></option>
			<? } ?>
          </select>

        de
          <select name="mes" id="mes">
		  	<option value="01" <? if($mes == '01') echo 'selected'; ?>>- Mês -</option>
			<option value="01" <? if($mes == '01') echo 'selected'; ?>>Janeiro</option>
			<option value="02" <? if($mes == '02') echo 'selected'; ?>>Fevereiro</option>
			<option value="03" <? if($mes == '03') echo 'selected'; ?>>Março</option>
			<option value="04" <? if($mes == '04') echo 'selected'; ?>>Abril</option>
			<option value="05" <? if($mes == '05') echo 'selected'; ?>>Maio</option>
			<option value="06" <? if($mes == '06') echo 'selected'; ?>>Junho</option>
			<option value="07" <? if($mes == '07') echo 'selected'; ?>>Julho</option>
			<option value="08" <? if($mes == '08') echo 'selected'; ?>>Agosto</option>
			<option value="09" <? if($mes == '09') echo 'selected'; ?>>Setembro</option>
			<option value="10" <? if($mes == '10') echo 'selected'; ?>>Outubro</option>
			<option value="11" <? if($mes == '11') echo 'selected'; ?>>Novembro</option>
			<option value="12" <? if($mes == '12') echo 'selected'; ?>>Dezembro</option>
          </select></td>
  </tr>
  <tr>
    <td class="txtdir">Grupo:</td>
    <td class="txtesq"><select name="grupo" id="grupo">
	        <option value="0">- Selecione -</option>
			<?
			$sql2 = mysql_query("SELECT * FROM $tb_grupo ORDER BY nome ASC");
			while($x2 = mysql_fetch_array($sql2))
			{
			?>
			<option value="<?=$x2['id'];?>" <? if($x['grupo'] == $x2['id']) echo 'selected'; ?>><?=$x2['nome'];?></option>
			<? } ?>
          </select></td>
  </tr>
  <tr class="linha1">
    <td colspan="2" class="txtcent"><input type="submit" name="Submit" value="Salvar Informa&ccedil;&otilde;es" /></td>
  </tr>
</table>
</form>
<? } ?>