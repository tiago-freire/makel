<? 
require_once("includes/config.php");
require_once("includes/funcoes.php");
include_once("includes/Logger.php");
$logger = new Logger();
require_once("includes/Util.php"); 

if(!Logado()) {
	$mod = "Login";
} else {
	require_once("modules/Usuario.php");
	$s_owner = $_SESSION['usuario'];
	$owner = new Usuario($s_owner['id']);
	$owner->loadAll();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?=SITE_NAME?></title>
	<? include_once("includes/javascript.php"); ?>
	<link href="css/style.css.php" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="header_topo"></div>  
	<div id="corpo">
		<div id="header"></div>
		<?
		if(isset($owner)) include("includes/menu.php");
		
		$file = "default";
		
		if(!isset($mod)) {
			if(!isset($_GET['module'])) {
				$mod = "Index";
			} else {
				$mod = $_GET['module'];
				
				if(!is_dir("modules/$mod")) {
					$mod = "Index";
				}
				
				if(isset($_GET['op'])) {
					if(!strcmp($_GET['op'],"addvideo"))
						$file = "formulario_video";
					else
						$file = "formulario";
					if(!strcmp($_GET["op"],"order"))
						$file = "organiza";
				
				}
				
				if(strcmp($mod,"Index") AND strcmp($mod,"Estats") AND strcmp($mod,"Email")) {
					include_once("modules/$mod.php");
				}
			}
		}
		
		include("modules/$mod/$file.php");
		?>
		<br class="clear" />  
	</div>
	<!-- fecha corpo -->	
	<div id="rodape"></div>
</body>
</html>
