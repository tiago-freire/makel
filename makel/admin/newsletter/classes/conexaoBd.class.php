<?php

/**
 * Essa classe foi projetada com PHP5 e alterada para PHP4, pode não funcionar corretamente
 * Classe para conexão com banco de dados
 * 
 * @author   Antonio Josué de Lima Neto <josuedsi@gmail.com>
 */
 
class conexaoBd
{
	var $servidor;  // @var  string servidor
	var $usuario;   // @var  string usuario
	var $senha;     // @var  string senha
	var $banco;     // @var  string banco
	
	// Método construtor recebe o nome da imagem e o diretório
	function conexaoBd($servidor,$usuario,$senha,$banco)
	{
		$this->setaServidor($servidor);
		$this->setaUsuario($usuario);
		$this->setaSenha($senha);
		$this->setaBanco($banco);
		
		$this->conecta();		
	}
	
	// Métodos para definir configurações da conexão	
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
	
	// Método para conectar-se ao banco de dados
	function conecta()
	{
		if(!@mysql_connect($this->servidor, $this->usuario, $this->senha)){
			echo "Conexão com o banco de dados não estabelecida";
			exit(1);
		}
		else{
			if(!@mysql_select_db($this->banco)){
				
				echo "Conexão com o banco de dados não estabelecida";
				exit(1);		
			}
		}
	}
} 
?>