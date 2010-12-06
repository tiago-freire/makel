<? include('includes/config.php'); 
include("classes/basicas.class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Visualizar Modelo</title>
</head>

<body>

<?
if( Basicas::Retorna('tipo',$tb_modelos,'id',$_GET['id']) == 1 )
print Basicas::Retorna('texto',$tb_modelos,'id',$_GET['id']);
else
echo '<img src="docs/'.Basicas::Retorna('foto',$tb_modelos,'id',$_GET['id']).'" />';
?>

</body>
</html>
