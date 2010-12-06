<?php if(extension_loaded('zlib')){ob_start('ob_gzhandler');} 
header("Vary: Accept-Encoding");  
header("Content-type: text/css"); 
include("geral.css");
include("jquery-ui-1.7.2.custom.css");
if(extension_loaded('zlib')){ob_end_flush();}?>