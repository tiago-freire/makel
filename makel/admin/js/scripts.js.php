<?php if(extension_loaded('zlib')){ob_start('ob_gzhandler');} 
header("Vary: Accept-Encoding");  
header("Content-type: text/javascript"); 
include("jquery-1.3.2.min.js");
include("jquery-ui-1.7.2.custom.min.js");
include("jquery.droppy.js");
include("jquery.maskedinput-1.2.2.min.js");
include("funcoes.js");
include("ddaccordion.js");
if(extension_loaded('zlib')){ob_end_flush();}?>