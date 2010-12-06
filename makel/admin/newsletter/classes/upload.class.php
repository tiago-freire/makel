<?php

/**
 * Essa classe foi projetada com PHP5 e alterada para PHP4, pode não funcionar corretamente
 * Classe com métodos para envio de arquivos ao servidor
 * 
 * @author   Antonio Josué de Lima Neto <josuedsi@gmail.com>
 */
 
class upload 
{	
	var $dir = '.';	 // @var   armazena o diretorio de destino
	var $nome;	     // @var   armazena o nome do arquivo
	var $ext;	  	 // @var   extensão	
	var $temp;    	 // @var   nome temporario	
	
	// Método para setar o diretório de trabalho
	function setaDiretorio($dir)
	{
		$this->dir = $dir;
	}
	
	// Método para determinar a extensão do arquivo
	function extensao($nome) 
	{
		$ext = explode(".",$_FILES[$nome]['name']);
		$this->ext = $ext[count($ext)-1];
		strtolower($this->ext);	
	} 
	
	// Método para gerar um nome para o arquivo a ser enviado
	function geraNome() 
	{		
		$this->temp = date("dmyHis").rand(0,50).".".$this->ext;
	}
	
	// Método para retornar o nome do arquivo gerado
	function pegaNome()
	{
		return $this->temp;	
	}
	
	// Método para retornar o nome do diretorio
	function pegaDir()
	{
		return $this->dir;
	}
	
	// Método que envia imagem para o servidor
	function enviar($nome,$temp=null) 
	{
		$this->extensao($nome);
		if($temp==null){ $this->geraNome(); } else { $this->temp = $temp; }
		move_uploaded_file($_FILES[$nome]['tmp_name'], $this->dir ."/". $this->temp);
	}
	
	// Método para deletar imagem do servidor
	function deletar($nome) 
	{
		unlink($this->dir ."/". $nome);
	} 		

} 
 
?>