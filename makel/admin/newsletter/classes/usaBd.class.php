<?php

/**
 * Essa classe foi projetada com PHP5 e alterada para PHP4, pode não funcionar corretamente
 * Classe para uso do banco de dados (inserir,deletar,atualizar)
 * 
 * @author   Antonio Josué de Lima Neto <josuedsi@gmail.com>
 */

class usaBd extends imagens
{					
	var $tabela;  // @var 	tabela do banco a ser usada
	var $query;   // @var 	query a ser executada
	
	// Método construtor define a tabela que o banco vai usar
	function usaBd($tabela)
	{
		$this->tabela = $tabela;
	}
	
	// Método para definir query a ser executada
	function setaQuery($query)
	{
		$this->query = $query;
	}
	
	// Método que executa a query e retorna resposta do servidor
	function executaQuery(){
		return mysql_query($this->query) or die(mysql_error());
	}
	
    // Método para montar condições a serem usadas com a clausula WHERE
	function montaCondicoes($condicoes)
    {
		$aux = array();
		foreach ($condicoes as $campo => $valor) 
		{
			$aux[] = $campo." = '".$valor."'";
        }
		$condicoes = implode(' AND ', $aux);
    	return $condicoes;
    }	
		
	// Método para definir query de inserção de dados na tabela
	// recebe um array, indíces representam os campos e valores os dados a serem inseridos
	function insere($elementos) 
	{
		$auxCam = array();
		$auxDad = array();
		foreach($elementos as $campos => $dados) 
		{
			$auxCam[] = $campos;
			$auxDad[] = "'".$dados."'";
		}
		$campos = implode(', ', $auxCam);
		$dados  = implode(', ', $auxDad);
		
		$this->setaQuery("INSERT INTO ".$this->tabela." ($campos) VALUES ($dados)");
		return $this->executaQuery();					
	}
	
	// Método para definir query de edição de dados na tabela
	// recebe um array com os dados e outro com condições
	function edita($dados,$condicoes)
	{
		$aux = array();
		foreach($dados as $campo => $valor)
		{
			$aux[] = $campo." = '".$valor."'";	
		}
		$dados = implode(', ', $aux);
		
		$this->setaQuery("UPDATE ".$this->tabela." SET $dados WHERE ".$this->montaCondicoes($condicoes));
		return $this->executaQuery();
	}
	
	// Método para definir query de deleção de dados na tabela
	// recebe um array com as condições da cláusula WHERE
	function deleta($condicoes) {
		$this->setaQuery("DELETE FROM ".$this->tabela." WHERE ".$this->montaCondicoes($condicoes));
		return $this->executaQuery();
	}

}

?>