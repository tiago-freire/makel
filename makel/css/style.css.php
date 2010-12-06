<?
require_once("../admin/includes/Util.php");

Util::startZlib();

header("Vary: Accept-Encoding");
header("Content-type: text/css");
include("style.css");

Util::finishZlib();
?>