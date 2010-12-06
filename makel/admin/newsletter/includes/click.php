<?
	require_once('config.php');

	$modelo = $_GET['m'];
	$user = $_GET['id'];
	$envio = $_GET['envio'];
	$x = explode("_",$envio);
	$envio = $x[0].'-'.$x[1].'-'.$x[2].' '.$x[3].':'.$x[4].':'.$x[5];
	$link = $_GET['link'];
	mysql_query("insert into `click` (`modelo`,`usuario`,`envio`,`link`) values ('$modelo','$user','$envio','$link')");
	header("location: http://$link");
	exit;

?>