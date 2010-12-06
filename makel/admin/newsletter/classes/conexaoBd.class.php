<?php

/**
 * Essa classe foi projetada com PHP5 e alterada para PHP4, pode n�o funcionar corretamente
 * Classe para conex�o com banco de dados
 * 
 * @author   Antonio Josu� de Lima Neto <josuedsi@gmail.com>
 */
 
class conexaoBd
{
	var $servidor;  // @var  string servidor
	var $usuario;   // @var  string usuario
	var $senha;     // @var  string senha
	var $banco;     // @var  string banco
	
	// M�todo construtor recebe o nome da imagem e o diret�rio
	function conexaoBd($servidor,$usuario,$senha,$banco)
	{
		$this->setaServidor($servidor);
		$this->setaUsuario($usuario);
		$this->setaSenha($senha);
		$this->setaBanco($banco);
		
		$this->conecta();		
	}
	
	// M�todos para definir configura��es da conex�o	
	function setaServidor($serivdor){
		$this->servidor = $servidor;
	}
	
	function setaUsuario($usuario){
		$this->usuario = $usuario;		
	}
	
	function setaSenha($senha){
		$this->senha = $senha;
	}
	
	function setaBanco($banco){
		$this->banco = $banco;
	}	
	
	// M�todo para conectar-se ao banco de dados
	function conecta()
	{
		if(!@mysql_connect($this->servidor, $this->usuario, $this->senha)){
			echo "Conex�o com o banco de dados n�o estabelecida";
			exit(1);
		}
		else{
			if(!@mysql_select_db($this->banco)){
				
				echo "Conex�o com o banco de dados n�o estabelecida";
				exit(1);		
			}
		}
	}
} 
?>