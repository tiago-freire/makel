<?php

class Usuario {
	
	/* dados */
	
	var $id;
	var $nome;
	var $login;
	var $senha;
	var $perms;
	var $admin;
	var $op;
	
	static $table = "usuarios";
	
	function Usuario($id=0)
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
		$this->nome = $data['nome'];
		$this->login = $data['login'];
		if(isset($data['senha']) AND !empty($data['senha']) )
		{
			$this->senha = crypt($data['senha']);
		}
		$this->perms = $data['perms'];
		$this->admin = $data['nivel'];
	}
	
	function loadAll()
	{
		
		$query = mysql_query("SELECT * FROM " . Usuario::$table . " WHERE user_id='$this->id' ") or die(mysql_error());
		$res = mysql_fetch_array($query);
		$this->nome = $res['user_nome'];
		$this->login = $res['user_login'];
		$this->admin = $res['user_admin'];
		$permissoes = $res['user_perms'];
		if(!empty($permissoes))
		{
			$this->perms = split(";",$permissoes);
		}
	}
	
	function marcaPerm($modulo)
	{
		if($this->hasPerm($modulo))
			return "checked='checked'";
	}
	
	function hasPerm($modulo)
	{
		if(is_array($this->perms))
		 	return in_array($modulo,$this->perms);
		else
			return 0;
	}
	
	function isAdmin()
	{
		$this->loadAll();
		if($this->admin)
			return 1;
	}
	
	function save()
	{
		if(!strcmp($this->op,"novo"))
		{
			//add
			$query = mysql_query("INSERT INTO " . Usuario::$table . "(user_nome,user_login,user_senha,user_perms,user_admin) VALUES('$this->nome','$this->login','$this->senha','$this->perms','$this->admin') ") or die(mysql_error());
			$this->id = mysql_insert_id();
		}
		else
		{
			//edita
			if(!empty($this->senha))
				$q =  mysql_query("UPDATE " . Usuario::$table . " SET user_senha='$this->senha' WHERE user_id='$this->id' ") or die(mysql_error()); 
			$query = mysql_query("UPDATE " . Usuario::$table . " SET user_nome='$this->nome',user_login='$this->login',user_perms='$this->perms' WHERE user_id='$this->id' ") or die(mysql_error());
		}
	}
	
}
?>