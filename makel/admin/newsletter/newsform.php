<?
	require_once('includes/config.php');
	$email = $_GET['email'];
	$id = $_GET['id'];
	$sql = mysql_query("delete from emails where email='$email'") or die(mysql_error());
	header("location: ../../index.php");
?>