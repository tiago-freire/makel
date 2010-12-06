<?
	require_once('config.php');

	$modelo = $_GET['m'];
	$user = $_GET['id'];
	$envio = $_GET['envio'];
	$x = explode("_",$envio);
	$envio = $x[0].'-'.$x[1].'-'.$x[2].' '.$x[3].':'.$x[4].':'.$x[5];
	mysql_query("insert into `envio`(`modelo`,`usuario`,`envio`) values ('$modelo','$user','$envio')") or die(mysql_error());

	header("Content-type: image/gif");
	
	$image = imagecreatefromgif("http://www.qualitare.com.br/imagens/favicon2.gif");
	imagegif($image);

?>