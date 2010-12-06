<?
require_once("includes/config.php");
include("classes/basicas.class.php");
include("classes/newsletter.class.php");
include("../includes/funcoes.php");
if(!Logado())
	header('location: ../index.php');
set_time_limit(0);
$kc_mail= $CONFIG['mail'];
//$kc_email = $CONFIG['email'];
$kc_email = $email['contato'];
$kc_pass = $CONFIG['email_pass'];
$kc_url = $mailfromname;
$xmailfrom = $kc_email;
$kc_user = $CONFIG['usr'];
$ppage = 250;
$atualiza = 10;
$atual = $_GET['atual'];
$prox  = $_GET['atual'] + $ppage;
$modelo = $_GET['modelo'];
$grupo = $_GET['grupo'];
$total = $_GET['total'];

if($_GET['grupo']=='todos')
	$sql = mysql_query("SELECT * FROM $tb_emails GROUP BY EMAIL ORDER BY id DESC LIMIT $atual,$ppage"); 
else 
	$sql = mysql_query("SELECT * FROM $tb_emails WHERE grupo='".$grupo."' GROUP BY EMAIL ORDER BY id DESC LIMIT $atual,$ppage");

$k = mysql_num_rows($sql);
$z = $atual+$k;
$porc = round( (100*$z) / $total );

$envio = new Newsletter();
$tipo = Basicas::Retorna( 'tipo', $tb_modelos, 'id', $modelo );
$assunto = Basicas::Retorna( 'titulo', $tb_modelos, 'id', $modelo );

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ".$xmailfrom."\n";

$envio->setAditionalHeaders($xmailfrom);
$envio->setHeaders( $headers );
$envio->setAssunto( $assunto );

$tipo = Basicas::Retorna( 'tipo', $tb_modelos, 'id', $modelo);
$remove = '<br /><br /><br /><font size="1"> Este e-mail foi enviado de acordo com o "Guia de Boas Maneiras" para<br />e-mail marketing da ABEMD - Associação Brasileira de Marketing Direto.<br /><br />Para solicitar o cancelamento do recebimento de nossos informativos, <a href="'.$removeurl.'&id=[ID]&email=[EMAIL]">clique aqui</a>.</font><br><font color="#FF0000" size="1"><b>ATENÇÃO:</b> Favor não responder este e-mail. </font><img src="'.$urlimg.'?m='.$modelo.'&id=[ID]&envio='.date('Y_m_d_H_i_s').'" border="0" width="1" height="1" />';

if( $tipo == 2 ) 
{
	$conteudo = "<img border='0' src=\"$filesurl/".Basicas::Retorna('foto',$tb_modelos,'id',$modelo)."\">";
	$link = Basicas::Retorna('link', $tb_modelos, 'id', $modelo );
	if( !empty( $link ) )
		$conteudo = '<a href="'.$urlclk.'?m='.$modelo.'&id=[ID]&envio='.date('Y_m_d_H_i_s').'&link='.$link.'" target="blank" border="0" />'.$conteudo.'</a>';
	$conteudo .= $remove;
}
else $conteudo = str_replace("/userfiles/","http://".$url."/userfiles/",Basicas::Retorna( 'texto', $tb_modelos, 'id', $modelo )).$remove;

if ($atual == 0) {
	$x_conteudo = $conteudo;
	$x_conteudo = str_replace('[AI]','<a href="'.$urlclk.'?m='.$modelo.'&id=[ID]&envio='.date('Y_m_d_H_i_s').'&link=',$x_conteudo);
	$x_conteudo = str_replace('[/AI]','">',$x_conteudo);
	$x_conteudo = str_replace('[AF/]',"</a>",$x_conteudo);
	$x_conteudo = str_replace('[NOME]',"$"."_GET['nome']",$x_conteudo);
	$x_conteudo = str_replace('[EMAIL]',"$"."_GET['email']",$x_conteudo);
	$x_conteudo = str_replace('[ID]',"$"."_GET['id']",$x_conteudo);
	$filename = $filesurl.date(dmY_His).'_'.$grupo.".php";
	$filesalva = './docs/'.date(dmY_His).'_'.$grupo.".php";
	$arquivo = fopen($filesalva , "x");
	fwrite($arquivo, $x_conteudo);
	fclose($arquivo);
} else {
/*	$ultimo = ultimo('./docs/');
	foreach($ultimo as $arquivo)
		$filename = $filesurl.$arquivo;*/
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$site;?></title>

<style type="text/css">
	@import url('../css/geral.css'); 
	.style100 {	font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px; }
	.style200 {	color: #FF0000;	font-weight: bold; }
	.style400 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
	.style500 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #0000FF; }
</style>
</head>

<body>
<div id="header_logo"></div>
<div id="header_topo"></div>  
<div id="corpo">
    <div id="header"></div>
    <div align="center"><span class="style100"><br />O E-mail esta sendo enviado para a lista <span class="style200">N&Atilde;O FA&Ccedil;A NENHUMA A&Ccedil;&Atilde;O</span> nesta janela at&eacute; que apare&ccedil;a uma mensagem confirmando que todos os e-mails foram enviados. <br />
    </span><br /><span class="style400">Progresso do Envio</span><br /></div>
    <div align="center">
    <table width="400" cellspacing="0" cellpadding="5">
        <tr>
            <td bgcolor="#F7F7F7" class="style100">0%</td>
            <td bgcolor="#F7F7F7"><div align="center" class="style500"><?=$porc;?>% </div></td>
            <td bgcolor="#F7F7F7" class="style100">100%</td>
        </tr>
	    <tr>
		    <td width="28" bgcolor="#F7F7F7">&nbsp;</td>
		    <td width="333" bgcolor="#F7F7F7">
            	<div align="center">
			    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
				    <tr>
					    <td align="left">
                        	<table width="<?=$porc;?>%" cellpadding="0" cellspacing="0" bgcolor="#00FF00">
							    <tr>
								    <td>&nbsp;</td>
							    </tr>
						    </table>
                        </td>
                    </tr>
			    </table>
    			</div>
			</td>
		    <td width="37" bgcolor="#F7F7F7">&nbsp;</td>
		    </tr>
    </table>   
    </div>
<br class="clear" />  
</div>
<!-- fecha corpo -->	
<div id="rodape"><a href="http://www.qualitare.com.br"><img src="../imagens/assinatura_qualitare.gif" alt="assinatura" width="44" height="18" /></a>	</div>
</body>
</html>
<? while($x = mysql_fetch_array($sql))
{
	$nvejo = '<font size="2">Está com dificuldade para visualizar este email? <a href="'.$filename.'?email='.$x['email'].'&nome='.$x['nome'].'&id='.$x['id'].'">Clique aqui</a></font><br><br>';
	$zconteudo = $nvejo.$conteudo;
	$zconteudo = str_replace('[AI]','<a href="'.$urlclk.'?m='.$modelo.'&id=[ID]&envio='.date('Y_m_d_H_i_s').'&link=',$zconteudo);
	$zconteudo = str_replace('[/AI]','">',$zconteudo);
	$zconteudo = str_replace('[AF/]',"</a>",$zconteudo);
	$zconteudo = str_replace('[NOME]',$x['nome'],$zconteudo);
	$zconteudo = str_replace('[EMAIL]',$x['email'],$zconteudo);
	$zconteudo = str_replace('[ID]',$x['id'],$zconteudo);
	$kconteudo = '<table cellpadding="0" cellspacing="0" aling="center" width="90%"><tr><td>'.$zconteudo.'</td></tr></table>';
	$knome = $x['nome'];
	if (!$knome) 
		$knome = $x['email'];
	$envio->setConteudo( $zconteudo );
	$envio->envia( $x['email'] , $knome , $x['id'] );
}

if (($z == $total) or ($porc >=100))
	Basicas::alertaRedir("E-mail enviado com sucesso","./?p=newsletter");
sleep($atualiza);

echo "<script>window.location = 'envia.msg.php?atual=$prox&modelo=$modelo&total=$total&grupo=$grupo';</script>";
?>