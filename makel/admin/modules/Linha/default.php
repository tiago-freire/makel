<?
$modulo = $_GET['module'];
$pagina = (($_GET['pagina']) ? $_GET['pagina'] : 1);
$dados = Linha::lista_default($modulo,15,$pagina,"ID","DESC","");
$total= sizeof($dados)-1;
?>

<div align="center">
  <h1><img src="modules/<?=$modulo?>/logo.gif" width="64" height="64" align="absmiddle">&nbsp;&nbsp;
    <?=$MODULES[$modulo]['plural']?>
  </h1>
  <div align="right" width="90%"><img src="imagens/icones/mini_icons/action_go.gif" width="16" height="16" align="absmiddle"><a href="./?module=<?=$modulo?>&amp;op=add">Adicionar
    <?=$MODULES[$modulo]['singular']?>
    </a></div>
  <p>&nbsp;</p>
  <table width="90%" class="fundotable">
    <tr >
	  <td width="20%" class="title"><strong>Data de atualização</strong></td>
	  <td width="75%" class="title"><strong>Nome</strong></td>
      <td width="5%" class="title"></td>
    </tr>
    <?
		if($dados)
		{
			$class[0]="linha1";
			$class[1]="linha2";
			$z = 0;
			for($i=0; $i<$total; $i++)
			{
				$dado = $dados[$i];
	?>
    <tr>
	  <td class="<?=$class[$z]?>"><a href="./?module=<?=$modulo?>&op=editar&id=<?=$dado['id']; ?>"><?=date("d/m/Y", strtotime($dado['data']))?></a></td>
	  <td class="<?=$class[$z]?>"><a href="./?module=<?=$modulo?>&op=editar&id=<?=$dado['id']; ?>"><?=stripslashes($dado['nome'])?></a></td>
	  <td class="<?=$class[$z]?>"><a href="modules/<?=$modulo?>/form.php?op=apagar&id=<?=$dado['id'] ?>" onclick="return confirm('Excluir esta coleção?')"><img src="imagens/icones/mini_icons/action_stop.gif" alt="X" /></a></td>
    </tr>
    <? 
				$z = !$z;
			}//FOR
			echo '<tr><td colspan="10" class="'.$class[$z].'"><p align="center">'.$dados['nav'].'</p></td></tr>';
		}//if
		else
			echo "<tr><td class='linha1' colspan='10'>Não há ".strtolower($MODULES[$modulo]['plural'])." cadastrad".$MODULES[$modulo]['artigo']."s no momento.</td></tr>"; ?>
  </table>
  <p>&nbsp;</p>
</div>
