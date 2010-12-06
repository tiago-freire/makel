<?php

class Clientes{
	
	var $id;
	var $nome;
	var $endereco;
	var $telefone;
	var $site;
	var $email;
	var $status;
	var $op;
	
	static $table = "clientes";
	
	function __construct($id=0)
	{
		if($id)
		{
			$this->id = $id;
			$this->op = "edita";
			$this->loadAll();
		}
		else
			$this->op = "novo";
	}
	
	function setData($data)
	{
		$tudo = get_object_vars($this);
		foreach ($tudo as $var => $valor) {
			if (($var != 'op') and ($var != 'id'))
				$this->$var = addslashes($data[$var]);
		}
	}
	
	function loadAll()
	{
		$query = mysql_query("SELECT * FROM " . Clientes::$table . " WHERE id='$this->id' ") or die(mysql_error());
		$res = mysql_fetch_array($query);
		$tudo = get_object_vars($this);
		foreach ($tudo as $var => $valor) {
			if (($var != 'op') and ($var != 'id'))
				$this->$var = stripslashes($res[$var]);
		}
	}

	function save()
	{
		$tudo = get_object_vars($this);
		foreach ($tudo as $var => $valor) {
			if (($var != 'op') and ($var != 'id')) { 
				$campos[] = "$var"; 
				$valores[] = "'$valor'";
			}
		}
		if(!strcmp($this->op,"novo"))
		{
			$cm = implode(', ',$campos);
			$vl = implode(', ',$valores);
			$insere = "INSERT INTO " . Clientes::$table . " ($cm) VALUES ($vl)";
			$query = mysql_query($insere) or die(mysql_error());
			$this->id = mysql_insert_id();
		} else {
			$combina = array_combine($campos,$valores);
			$campos = '';
			foreach ($combina as $var => $valor) {
				if (($var != 'op') and ($var != 'id'))
					$campos[] = "`$var` =  $valor";
			}
			$td = implode(', ',$campos);
			$upd = "UPDATE " . Clientes::$table . " SET $td  WHERE id = '$this->id'";
			$query = mysql_query($upd) or die(mysql_error());
		}
	}
	
	function getLast()
	{
		$query = mysql_query("SELECT * FROM " . Clientes::$table . " order by id") or die(mysql_error());
		if (mysql_num_rows($query)) {
			while ($data = mysql_fetch_array($query))
				$retorno[] = array("nome"=>$data['nome'],"endereco"=>$data['endereco'],"telefone"=>$data['telefone'], "site"=>$data['site'], "email"=>$data['email'], "status"=>$data['status']);
			return $retorno;
		}
	}
	
	function Invert($id,$tipo)
	{
		if ($tipo== 'sobe') {
			$query = mysql_query("SELECT max(id) maior FROM " . Clientes::$table) or die(mysql_error());
			$x = mysql_fetch_array($query);
			$maior = $x['maior']+1;
			
			$query = mysql_query("SELECT id FROM " . Clientes::$table . " where id < '$id' order by id desc limit 1") or die(mysql_error());
			if (mysql_num_rows($query)) {
				$x = mysql_fetch_array($query);
				$nid = $x['id'];
				$upd = mysql_query("UPDATE " . Clientes::$table . " SET id = '$maior' WHERE id = '$nid'");
				$upd = mysql_query("UPDATE " . Clientes::$table . " SET id = '$nid' WHERE id = '$id'");
				$upd = mysql_query("UPDATE " . Clientes::$table . " SET id = '$id' WHERE id = '$maior'");
			} else
				return 0;
		} else {
			$query = mysql_query("SELECT max(id) maior FROM " . Clientes::$table) or die(mysql_error());
			$x = mysql_fetch_array($query);
			$maior = $x['maior']+1;
			
			$query = mysql_query("SELECT id FROM " . Clientes::$table . " where id > '$id' order by id asc limit 1") or die(mysql_error());
			if (mysql_num_rows($query)) {
				$x = mysql_fetch_array($query);
				$nid = $x['id'];
				$upd = mysql_query("UPDATE " . Clientes::$table . " SET id = '$maior' WHERE id = '$nid'");
				$upd = mysql_query("UPDATE " . Clientes::$table . " SET id = '$nid' WHERE id = '$id'");
				$upd = mysql_query("UPDATE " . Clientes::$table . " SET id = '$id' WHERE id = '$maior'");
			} else
				return 0;
		}
		
	}
	
	function getClientes()
	{
	    $cons = mysql_query("SELECT * FROM " . Clientes::$table . " order by nome ASC, id ASC") or die(mysql_error()); 
		
		while($x = mysql_fetch_array($cons))
				$clientes[] = array(
				                      "id"=>$x['id'],
			                		  "nome"=>stripslashes($x['nome']),
							 		  "endereco"=>stripslashes($x['endereco']),
			                 	      "telefone"=>stripslashes($x['telefone']),
									  "site"=>stripslashes($x['site']),
									  "email"=>stripslashes($x['email']),
									  "status"=>stripslashes($x['status'])
									  );
									  
			return $clientes;
	
	}
	
}
?>