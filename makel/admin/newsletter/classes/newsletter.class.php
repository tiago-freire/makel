<?

/* Classe para envio de e-mails */

class Newsletter
{
	
	var $assunto;
	var $conteudo;
	var $headers;
	var $adHeaders;
	
	function setAssunto( $assunto ) { $this->assunto = $assunto; }	
	function getAssunto( ) { return $this->assunto; }
	
	function setHeaders( $header )
	{
		$this->headers = $header;
	}
	
	function getHeaders( ) { return $this->headers; }
	
	function setConteudo( $conteudo ) { $this->conteudo = $conteudo; }
	function getConteudo( ) { return $this->conteudo; }
	
	function troca( $destino , $nome = NULL , $id = NULL )
	{
		$novo = str_replace( '[NOME]' , $nome , $this->getConteudo( ) );
		$novo = str_replace( '[EMAIL]', $destino, $novo );
		$novo = str_replace( '[ID]', $id, $novo );
		$this->setConteudo( $novo );
	}
	
	function setAditionalHeaders($adHeaders = "") {
		$this->adHeaders = $adHeaders;
	}
	
	function getAdHeaders() {
		return $this->adHeaders;
	}
	
	function envia( $destino , $nome = NULL , $id = NULL )
	{
		$this->troca( $destino , $nome , $id );
		if (!mail( $destino , $this->getAssunto( ) , $this->getConteudo( ), $this->getHeaders( ),"-r".$this->getAdHeaders() )) {
			$newHeader = "Return-Path: ".$this->getAdHeaders;
			mail( $destino , $this->getAssunto( ) , $this->getConteudo( ),$this->getHeaders( ) . $newHeader );
		}
	}
}
?>