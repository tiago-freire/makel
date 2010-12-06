<?
require_once('./includes/config.php');
include_once("../includes/funcoes.php");

if(!Logado())
{
	header('location: ../index.php');
}
if ($_POST) {
header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=relatorio.xls");
header("Pragma: no-cache");

set_time_limit(0);
echo '
<style>
	#titulo { color:#FFFFFF;  background-color:#666666; }
</style>

<table >
<tr><td colspan="5" align="center" valign="top"><h1>'.$site.'</h1></td></tr>
<tr><td colspan="5" align="center" valign="top"><h2>Relatório de Newsletter</h2></td></tr>
</table>';
$dt = explode('-',$_POST['data_ini']);
$dt_ini = $dt[2].'-'.$dt[1].'-'.$dt[0];

$dt = explode('-',$_POST['data_fim']);
$dt_fim = $dt[2].'-'.$dt[1].'-'.$dt[0];



	if (($_POST['exibir'] == 1) || ($_POST['exibir'] == 3)) {
		if ($dt_fim != $dt_ini)
			$wr = "and ".((!$_POST['tipo']) ? 'date(`envio`)' : 'date(`leu`)')." between '$dt_ini' and '$dt_fim'";
		else
			$wr = "and ".((!$_POST['tipo']) ? 'date(`envio`)' : 'date(`leu`)')." = '$dt_ini'";
		$i = 1;
		$mod = $_POST['modelo'];
		$in = "(".implode(",",$mod).")";
		$sql = mysql_query("select modelo.titulo,emails.nome,emails.email,date_format(envio,'%d.%m.%Y %H:%i:%s') Envio, date_format(leu,'%d.%m.%Y %H:%i:%s') Leu from envio left join modelo on modelo.id = envio.modelo left join emails on emails.id = envio.usuario where modelo.id in $in $wr order by titulo,envio,leu") or die(mysql_error());
		$titulo = "";
		if (mysql_num_rows($sql)) {
			echo '<table><tr height="30"><td></td><td></td><td></td><td></td><td></td></tr><tr><td colspan="5" align="center" valign="bottom"><h2>Leitura</h2></td></tr>';
			while ($linha = mysql_fetch_object($sql)) {
				$cor = (($i%2 == 0) ? '#EEEEEE' : '#DDDDDD');
				if ($titulo != $linha->titulo) {
					if ($i != 1)
						echo '<tr id="titulo"><td colspan="5">Total de '.$k.' registro(s)</td></tr>';
					$k = 0;
					echo '<tr><td colspan="5"><h3>'.$linha->titulo.'</h3></td></tr>';
					echo '<tr id="titulo"><td align="center"><strong>Nome</strong></td><td align="center" colspan="2"><strong>E-Mail</strong></td><td align="center"><strong>Envio</strong></td><td align="center"><strong>Leitura</strong></td></tr>';
					$titulo = $linha->titulo;
				}
				$k++;
				echo '<tr><td bgcolor="'.$cor.'">'.$linha->nome.'</td><td bgcolor="'.$cor.'" colspan="2">'.$linha->email.'</td><td bgcolor="'.$cor.'" align="center">'.$linha->Envio.'</td><td bgcolor="'.$cor.'" align="center">'.$linha->Leu.'</td></tr>';
				$i++;
				
			}
			echo '<tr id="titulo"><td colspan="5">Total de '.$k.' registro(s)</td></tr>';
			echo '</table>';
		}
	} 
	if (($_POST['exibir'] == 2) || ($_POST['exibir'] == 3)) {

		if ($dt_fim != $dt_ini)
			$wr = "and ".((!$_POST['tipo']) ? 'date(`envio`)' : 'date(`clicou`)')." between '$dt_ini' and '$dt_fim'";
		else
			$wr = "and ".((!$_POST['tipo']) ? 'date(`envio`)' : 'date(`clicou`)')." = '$dt_ini'";
	$mod = $_POST['modelo'];
	$in = "(".implode(",",$mod).")";
	$i = 1;
	$sql = mysql_query("select modelo.titulo,emails.nome,emails.email,date_format(envio,'%d.%m.%Y %H:%i:%s') Envio, date_format(clicou,'%d.%m.%Y %H:%i:%s') Clicou,click.link from click left join modelo on modelo.id = click.modelo left join emails on emails.id = click.usuario where modelo.id in $in $wr order by titulo,envio,clicou") or die(mysql_error());
	$titulo = "";
		if (mysql_num_rows($sql)) {
			echo '<table><tr height="30"><td></td><td></td><td></td><td></td><td></td></tr><tr><td colspan="5" align="center" valign="bottom"><h2>Clique de Links</h2></td></tr>';
			while ($linha = mysql_fetch_object($sql)) {
				$cor = (($i%2 == 0) ? '#CCCCCC' : '#DDDDDD');
				if ($titulo != $linha->titulo) {
					if ($i != 1)
						echo '<tr id="titulo"><td colspan="5">Total de '.$k.' registro(s)</td></tr>';
					$k = 0;
					echo '<tr><td colspan="5"><h3>'.$linha->titulo.'</h3></td></tr>';
					echo '<tr id="titulo"><td align="center"><strong>Nome</strong></td><td align="center"><strong>E-Mail</strong></td><td align="center"><strong>Link</strong></td><td align="center"><strong>Envio</strong></td><td align="center"><strong>Clicou</strong></td></tr>';
					$titulo = $linha->titulo;
				}
				$k++;
				echo '<tr><td bgcolor="'.$cor.'">'.$linha->nome.'</td><td bgcolor="'.$cor.'">'.$linha->email.'</td><td bgcolor="'.$cor.'">'.$linha->link.'</td><td bgcolor="'.$cor.'" align="center">'.$linha->Envio.'</td><td bgcolor="'.$cor.'" align="center">'.$linha->Clicou.'</td></tr>';
				$i++;
			}
			echo '<tr id="titulo"><td colspan="5">Total de '.$i.'registro(s)</td></tr>';
			echo '</table>';
		}
	}
} else {
	echo '<div id="tits">
				<img src="imagens/icon_hell.gif" width="48" height="48" />
				<h2 class="titulo">Relatório de Envio<br>de Newsletter</h2>
			</div>
		<form action="relatorio.php" method="post" class="right" style="padding-left:20px;">
			<h3>Intervalo para filtro</h3>
			
			<label style="width:100px; float:left; padding:5px 5px 0 0; text-align:right;">Data Inicial:</label> <input type="text" name="data_ini" size="10" value="'.date('d-m-Y').'"/><br/>
			<label style="width:100px; float:left; padding:5px 5px 0 0;  text-align:right;">Data Final:</label> <input type="text" name="data_fim" size="10" value="'.date('d-m-Y').'"/>
			<br/><br/>
			
			<h3>Tipo de Filtro</h3>
			<label style="padding-left:30px;"><input type="radio" name="tipo" checked="checked" value="0"/> Data do Envio</label><br/>
			<label style="padding-left:30px;"><input type="radio" name="tipo" value="1"/> Data de Leitura / Click</label><br>
			<br/>
			
			<h3>Selecione a Campanha</h3>';
			$sql = mysql_query("select id,titulo from modelo order by titulo");
			while ($modelo = mysql_fetch_array($sql))
				echo '<label style="padding-left:30px;"><input type="checkbox" name="modelo[]" value="'.$modelo['id'].'"/>&nbsp;&nbsp; '.$modelo['titulo'].'</label><br/>';
			
			echo '<br><br/>
			<h3>Exibir:</h3>
			<label style="padding-left:30px;"><input type="radio" name="exibir" checked="checked" value="1"/> E-mails Lidos</label><br/>
			<label style="padding-left:30px;"><input type="radio" name="exibir" value="2"/> E-mails Clicados</label><br>
			<label style="padding-left:30px;"><input type="radio" name="exibir" value="3"/> Todos os E-mails</label><br><br><br/>
			<input type="submit" value="Gerar Relatório" />
		</form>';
}
	
?>
