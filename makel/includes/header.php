<?
require_once("admin/includes/config.php");
require_once("admin/includes/Util.php");
Util::startZlib();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?= ($pageTitle ? ($pageTitle . " | ") : "") . SITE_NAME ?></title>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<meta name="description" content="<?= SITE_DESCRIPTION ?>" />
		<meta name="keywords" content="<?= SITE_KEYWORDS ?>" />
		<link rel="stylesheet" type="text/css" href="css/style.css.php" />
		<script type="text/javascript" src="js/scripts.js.php"></script>
	</head>