<?
function authMail($from, $namefrom, $to, $nameto, $subject, $message,$kc_mail,$kc_email,$kc_pass)
{

/*  your configuration here  */

$port = "25"; // should be 25 by default
$timeout = "30"; //typical timeout. try 45 for slow servers

$smtpServer = $kc_mail; //ip accepted as well
$username = $kc_email; //the login for your smtp
$password = $kc_pass; //the pass for your smtp

$localhost = "127.0.0.1"; //this seems to work always
$newLine = "\r\n"; //var just for nelines in MS
$secure = 0; //change to 1 if you need a secure connect
 
/*  you shouldn't need to mod anything else */

//connect to the host and port
$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
$smtpResponse = fgets($smtpConnect, 4096);
if(empty($smtpConnect))
{
   $output = "Failed to connect: $smtpResponse";
   return $output;
}
else
{
   $logArray['connection'] = "Connected to: $smtpResponse";
}

//say HELO to our little friend
fputs($smtpConnect, "HELO $localhost". $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['heloresponse'] = "$smtpResponse";

//start a tls session if needed
if($secure)
{
   fputs($smtpConnect, "STARTTLS". $newLine);
   $smtpResponse = fgets($smtpConnect, 4096);
   $logArray['tlsresponse'] = "$smtpResponse";

   //you have to say HELO again after TLS is started
   fputs($smtpConnect, "HELO $localhost". $newLine);
   $smtpResponse = fgets($smtpConnect, 4096);
   $logArray['heloresponse2'] = "$smtpResponse";
}

//request for auth login
fputs($smtpConnect,"AUTH LOGIN" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['authrequest'] = "$smtpResponse";

//send the username
fputs($smtpConnect, base64_encode($username) . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['authusername'] = "$smtpResponse";

//send the password
fputs($smtpConnect, base64_encode($password) . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['authpassword'] = "$smtpResponse";

//email from
fputs($smtpConnect, "MAIL FROM: $from" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['mailfromresponse'] = "$smtpResponse";

//email to
fputs($smtpConnect, "RCPT TO: $to" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['mailtoresponse'] = "$smtpResponse";

//the email
fputs($smtpConnect, "DATA" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['data1response'] = "$smtpResponse";

//construct headers
$headers = "MIME-Version: 1.0" . $newLine;
$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
//$headers .= "To: $nameto <$to>" . $newLine;
//$headers .= "From: $namefrom <$from>" . $newLine;
$headers .= 'Date: '.date("r").$newLine;
$headers .= 'Sender-IP: '.$_SERVER["REMOTE_ADDR"].$newLine;
$headers .= 'X-Mailser: iPublications Adv.PHP Mailer 1.6'.$newLine;

//observe the . after the newline, it signals the end of message
fputs($smtpConnect, "To: $nameto\r\nFrom: $namefrom\r\nSubject: $subject\r\n$headers\r\n\r\n$message\r\n.\r\n");
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['data2response'] = "$smtpResponse";

// say goodbye
fputs($smtpConnect,"QUIT" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['quitresponse'] = "$smtpResponse";
$logArray['quitcode'] = substr($smtpResponse,0,3);
fclose($smtpConnect);
//a return value of 221 in $retVal["quitcode"] is a success
return($logArray);
}

?>