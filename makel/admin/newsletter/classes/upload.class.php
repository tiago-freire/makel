<?php

/**
 * Essa classe foi projetada com PHP5 e alterada para PHP4, pode n�o funcionar corretamente
 * Classe com m�todos para envio de arquivos ao servidor
 * 
 * @author   Antonio Josu� de Lima Neto <josuedsi@gmail.com>
 */
 
class upload 
{	
	var $dir = '.';	 // @var   armazena o diretorio de destino
	var $nome;	     // @var   armazena o nome do arquivo
	var $ext;	  	 // @var   extens�o	
	var $temp;    	 // @var   nome temporario	
	
	// M�todo para setar o diret�rio de trabalho
	function setaDiretorio($dir)
	{
		$this->dir = $dir;
	}
	
	// M�todo para determinar a extens�o do arquivo
	function extensao($nome) 
	{
		$ext = explode(".",$_FILES[$nome]['name']);
		$this->ext = $ext[count($ext)-1];
		strtolower($this->ext);	
	} 
	
	// M�todo para gerar um nome para o arquivo a ser enviado
	function geraNome() 
	{		
		$this->temp = date("dmyHis").rand(0,50).".".$this->ext;
	}
	
	// M�todo para retornar o nome do arquivo gerado
	function pegaNome()
	{
		return $this->temp;	
	}
	
	// M�todo para retornar o nome do diretorio
	function pegaDir()
	{
		return $this->dir;
	}
	
	// M�todo que envia imagem para o servidor
	function enviar($nome,$temp=null) 
	{
		$this->extensao($nome);
		if($temp==null){ $this->geraNome(); } else { $this->temp = $temp; }
		move_uploaded_file($_FILES[$nome]['tmp_name'], $this->dir ."/". $this->temp);
	}
	
	// M�todo para deletar imagem do servidor
	function deletar($nome) 
	{
		unlink($this->dir ."/". $nome);
	} 		

} 
 
?>