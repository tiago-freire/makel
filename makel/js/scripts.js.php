<?
require_once("../admin/includes/Util.php");

Util::startZlib();

header("Vary: Accept-Encoding");  
header("Content-type: text/javascript"); 
include("jquery-1.4.2.min.js");
include("jquery.maskedinput-1.2.2.min.js");
include("jquery.centralize-0.1.js");

Util::finishZlib();
?>