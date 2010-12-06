<?php

/**
 * Essa classe foi projetada com PHP5 e alterada para PHP4, pode n�o funcionar corretamente
 * Classe para uso do banco de dados (inserir,deletar,atualizar)
 * 
 * @author   Antonio Josu� de Lima Neto <josuedsi@gmail.com>
 */

class usaBd extends imagens
{					
	var $tabela;  // @var 	tabela do banco a ser usada
	var $query;   // @var 	query a ser executada
	
	// M�todo construtor define a tabela que o banco vai usar
	function usaBd($tabela)
	{
		$this->tabela = $tabela;
	}
	
	// M�todo para definir query a ser executada
	function setaQuery($query)
	{
		$this->query = $query;
	}
	
	// M�todo que executa a query e retorna resposta do servidor
	function executaQuery(){
		return mysql_query($this->query) or die(mysql_error());
	}
	
    // M�todo para montar condi��es a serem usadas com a clausula WHERE
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
		
	// M�todo para definir query de inser��o de dados na tabela
	// recebe um array, ind�ces representam os campos e valores os dados a serem inseridos
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
	
	// M�todo para definir query de edi��o de dados na tabela
	// recebe um array com os dados e outro com condi��es
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
	
	// M�todo para definir query de dele��o de dados na tabela
	// recebe um array com as condi��es da cl�usula WHERE
	function deleta($condicoes) {
		$this->setaQuery("DELETE FROM ".$this->tabela." WHERE ".$this->montaCondicoes($condicoes));
		return $this->executaQuery();
	}

}

?>