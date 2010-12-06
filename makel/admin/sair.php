<?
require_once("includes/config.php");
session_name($SITE['name']);
session_start();
session_unset();
session_destroy();
?>
<script language="javascript"> location.href="." </script>