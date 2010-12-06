<script language="javascript">

	elementos = new Array();
	flag = false;
	j = 0;
	
	function addArray( i )
	{
		this.elementos[ j ] = i;
		this.j++;
	}
		
	function seltudo( )
	{
		if( flag == false )
		for(i = 0; i < j ; i++ )
		{		
			document.getElementById( elementos[ i ] ).checked = true;
			flag = true;
		}
		else
		for(i = 0; i < j ; i++ )
		{		
			document.getElementById( elementos[ i ] ).checked = false;
			flag = false;
		}		
		
		
	}	

</script>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<div id="tits">
    <img src="imagens/icon_cadastro.gif" width="48" height="48" border="0" />
    <h2 class="titulo">Cadastro de E-mails</h2>
</div>

<form method="post" action="./?p=forms/newsletter&op=EmailCadastrar">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="title">Cadastrar novo e-mail</td>
  </tr>
  <tr>
    <td class="txtdir">Nome:</td>
    <td class="txtesq"><input name="nome" type="text" id="nome" size="60" /></td>
  </tr>
  <tr>
    <td class="txtdir">E-mail:</td>
    <td class="txtesq"><input name="email" type="text" id="email" size="60" /></td>
  </tr>
  <tr>
    <td class="txtdir">Anivers&aacute;rio:</td>
    <td class="txtesq"><select name="dia" id="dia" class="selectdia">
      <option value="">- Dia -</option>
      <? 
			for($i=1; $i<=31; $i++){
			if($i < 10) { $i="0".$i; }
			?>
      <option value="<?=$i;?>">
        <?=$i;?>
        </option>
      <? } ?>
    </select>
de
<select name="mes" id="mes" class="selectmes">
  <option value="">- Mês -</option>
  <option value="01">Janeiro</option>
  <option value="02">Fevereiro</option>
  <option value="03">Março</option>
  <option value="04">Abril</option>
  <option value="05">Maio</option>
  <option value="06">Junho</option>
  <option value="07">Julho</option>
  <option value="08">Agosto</option>
  <option value="09">Setembro</option>
  <option value="10">Outubro</option>
  <option value="11">Novembro</option>
  <option value="12">Dezembro</option>
</select></td>
  </tr>
  <tr>
    <td class="txtdir">Grupo:</td>
    <td class="txtesq"><select name="grupo" id="grupo">
      <?
			$sql = mysql_query("SELECT * FROM $tb_grupo ORDER BY nome ASC");
			while($x = mysql_fetch_array($sql))
			{
			?>
      <option value="<?=$x['id'];?>">
        <?=$x['nome'];?>
        </option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" class="txtcent">&nbsp;</td>
  </tr>
  <tr class="linha1">
    <td colspan="2" class="txtcent">
      <input type="submit" name="Submit" value="Cadastrar" />
    </td>
  </tr>
</table>
</form>
<br />
<br />
<form method="get" action="./">
<table width="670" border="0" cellpadding="4" cellspacing="0" bgcolor="#EBEBEB" align="center">
  <tr>
    <td colspan="2" class="title">Pesquisar</td></tr>
    <tr class="linha1">
        <td><select name="tipo"><option value="1" <?= ($_GET['tipo'] == 1) ? 'selected="selected"' : ''; ?>>Nome</option><option value="2" <?= ($_GET['tipo'] == 2) ? 'selected="selected"' : ''; ?>>E-mail</option> </select></td>
        <td>
        	<input type="hidden" name="p" value="emails" />
           <?=(($_GET['op']) ? '<input type="hidden" name="op" value="'.$_GET['op'].'" />' : '') ?>
           <?=(($_GET['grupo']) ? '<input type="hidden" name="grupo" value="'.$_GET['grupo'].'" />' : '') ?>
          <input name="busca" type="text" value="<?=$_GET['busca'];?>" size="60" />&nbsp;&nbsp;<input type="submit" value="Pesquisar" />
        </td>
    </tr>
</table>
</form>
<br /><br />
<? if (!empty($_GET['busca'])) {
	$busca = $_GET['busca'];
	$tipo = $_GET['tipo'];
	$wr = "where ".(($tipo==1) ? '`nome`' : '`email`')." like '%$busca%'";
	$wra = "and ".(($tipo==1) ? '`nome`' : '`email`')." like '%$busca%'";
} ?>
<form method="post" action="./?p=forms/newsletter&op=EmailDeletar">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" class="title">
    Ordenar por:
      <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
        <option>- Nome -</option>
		<option value="./?p=emails&op=1" <? if($_GET['op']==1) echo 'selected'; ?>>Crescente</option>
		<option value="./?p=emails&op=2" <? if($_GET['op']==2) echo 'selected'; ?>>Decrescente</option>
      </select>

      <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
        <option>- E-mail -</option>
		<option value="./?p=emails&op=3" <? if($_GET['op']==3) echo 'selected'; ?>>Crescente</option>
		<option value="./?p=emails&op=4" <? if($_GET['op']==4) echo 'selected'; ?>>Decrescente</option>
      </select>
	  
      <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
        <option>- Grupo -</option>
			<?
			$sql = mysql_query("SELECT * FROM $tb_grupo ORDER BY nome ASC");
			while($x = mysql_fetch_array($sql))
			{
			?>
			<option value="./?p=emails&op=5&grupo=<?=$x['id'];?>" <? if($_GET['grupo'] == $x['id']) echo 'selected'; ?>><?=$x['nome'];?></option>
			<? } ?>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="6" class="titlecent">Emails Cadastrados</td>
  </tr>
  <tr class="titlecent">
    <td class="titlecent" width="2%"><input type="checkbox" name="seltodos" value="seltodos" style="border:0;" onclick="seltudo();" /></td>
    <td class="titlecent" width="34%">Nome</td>
    <td class="titlecent" width="34%">E-mail</td>
    <td class="titlecent" width="10%">Aniversário</td>
    <td class="titlecent" width="10%">Grupo</td>
    <td class="titlecent" width="10%">Opções</td>
  </tr>
  <?
	switch($_GET['op'])
	{
		case '1':
			include('emails.paginacao.php');
			$sql = mysql_query("SELECT * FROM $tb_emails $wr ORDER BY nome ASC LIMIT $inicio, $reg_p_pag");				
		break;
		
		case '2':
			include('emails.paginacao.php');
			$sql = mysql_query("SELECT * FROM $tb_emails $wr ORDER BY nome DESC LIMIT $inicio, $reg_p_pag");
		break;
		
		case '3':
			include('emails.paginacao.php');
			$sql = mysql_query("SELECT * FROM $tb_emails $wr ORDER BY email ASC LIMIT $inicio, $reg_p_pag");				
		break;
		
		case '4':
			include('emails.paginacao.php');
			$sql = mysql_query("SELECT * FROM $tb_emails $wr ORDER BY email DESC LIMIT $inicio, $reg_p_pag");			
		break;
		
		case '5':
			include('emails.paginacao2.php');
			$sql = mysql_query("SELECT * FROM $tb_emails WHERE  grupo='".$_GET['grupo']."' $wra ORDER BY email ASC LIMIT $inicio, $reg_p_pag");			
		break;		
		
		default:				
			include('emails.paginacao.php');
			$sql = mysql_query("SELECT * FROM $tb_emails $wr ORDER BY nome ASC LIMIT $inicio, $reg_p_pag");
		break;
	}
	$class[0] = "linha1";
	$class[1] = "linha2";
	$z=0;
	while($x = mysql_fetch_array($sql))
	{	
	?>			
	<script> addArray(<?=$x['id'];?>); </script>
  <tr class="<?=$class[$z]?>">
    <td><input type="checkbox" name="id[]" value="<?=$x['id'];?>" id="<?=$x['id'];?>" style="border:0;" /></td>
    <td><?=$x['nome'];?></td>
    <td><?=$x['email'];?></td>
    <td align="center"><?=date('d/m', strtotime($x['data']));?></td>
    <td align="center"><?=Basicas::Retorna('nome',$tb_grupo,'id',$x['grupo']);?></td>
    <td class="opcoes"><a href="./?p=emails.editar&amp;id=<?=$x['id'];?>">Editar</a></td>
  </tr>
  <? $z = !$z;
  } ?>
  <tr class="linha1">
	  <td class="txtcent" colspan="6"><input type="submit" name="Submit2" value="Deletar e-mails selecionados" /></td>
  </tr>
</table>
<br />
  &nbsp;
</form>
	   <?
	   if($registros > $reg_p_pag) {
	   $anterior = $pag-1;
	   if ($anterior<1)
	   echo "Anterior - ";
	   else
	   echo "<a href=\"./?p=emails&op=".$_GET['op']."&grupo=".$_GET['grupo']."&pag=$anterior\">Anterior</a> - ";
	   for($i=1; $i<$pag; $i++)
	   if($i>=$pag-$link_p_pag)
	   echo "<a href=\"./?p=emails&op=".$_GET['op']."&grupo=".$_GET['grupo']."&pag=$i\">$i</a> - ";
	   echo "<b>$pag</b>";
	   for($i=$pag+1; $i<=$num_total_paginas; $i++)
	   if($i<=$pag+$link_p_pag)
	   echo " - <a href=\"./?p=emails&op=".$_GET['op']."&grupo=".$_GET['grupo']."&pag=$i\">$i</a>";
	   $proxima = $pag+1;
	   if ($proxima>$num_total_paginas)
	   echo " - Pr&oacute;xima";
	   else
	   echo " - <a href=\"./?p=emails&op=".$_GET['op']."&grupo=".$_GET['grupo']."&pag=$proxima\">Pr&oacute;xima</a>";
	   }
	   ?>
<br /> </td>
  </tr>
</table>
