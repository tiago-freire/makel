<?
require("../admin/includes/config.php");

//Convertendo os parâmetros em variáveis
extract($_POST);

if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($mensagem)) {
	$to = SITE_CONTATO;
	$subject = SITE_NAME . " - Contato";

	$headers = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: $nome <$email>\n";
	
	$html = "<font face=\"arial,verdana\">";
	$html .= "<h2>$subject</h2>";
	$html .= "<div style=\"float:left;width:500px;border:#000 dashed 1px;padding:5px;text-align:justify;\">";
	$html .= "<strong>Nome:</strong> $nome<br /><br />";
	$html .= "<strong>E-mail:</strong> $email<br /><br />";
	$html .= "<strong>Telefone:</strong> $telefone<br /><br />";
	$html .= "<strong>Mensagem:</strong><br />".nl2br($mensagem);
	$html .= "</div>";
	$html .= "</font>";
	
	mail($to, $subject, $html, $headers);

	echo ("<script>alert('Contato enviado com sucesso');location.href='contato'</script>");
} else {
	echo ("<script>alert('Formulário incompleto');location.href='contato'</script>");
}
?>