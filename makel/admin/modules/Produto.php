<?
class Produto {
	var $id;
	var $linha;
	var $nome;
	var $data;
	var $ordem;
	var $foto;
	var $op;

	static $table = "produto";
	
	function __construct($id=0) {
		if($id)
		{
			$this->id = $id;
			$this->op = "edita";
			$this->loadAll();
		}
		else
			$this->op = "novo";
	}
	
	function setData($data) {
		$tudo = get_object_vars($this);
		foreach ($tudo as $var => $valor) {
			if (($var != 'op') and ($var != 'id'))
				$this->$var = addslashes($data[$var]);
		}
	}
	
	function loadAll() {
		$query = mysql_query("SELECT * FROM " . self::$table . " WHERE id='$this->id' ") or die(mysql_error());
		$res = mysql_fetch_array($query);
		$tudo = get_object_vars($this);
		foreach ($tudo as $var => $valor) {
			if (($var != 'op') and ($var != 'id'))
				$this->$var = stripslashes($res[$var]);
		}
	}
	
	function save() {
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
			$insere = "INSERT INTO " . self::$table . " ($cm) VALUES ($vl)";
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
			$upd = "UPDATE " . self::$table . " SET $td  WHERE id = '$this->id'";
			$query = mysql_query($upd) or die(mysql_error());
		}
	}
	
	function delete() {
		$query = mysql_query("DELETE from " . self::$table. " where id= '$this->id'") or die(mysql_error());
		
		return 1;
	}

	function lista_default($modulo,$registros=10,$pagina=1,$ordene="ID",$tipo="DESC",$url="",$linha="") {
		if($linha)
			$wh .= ($wh ? " AND " : " WHERE ") . " linha=$linha";
	
		$consulta = "SELECT * FROM " . self::$table . $wh . " ORDER BY $ordene $tipo";
		$data = makePaginacao($modulo.$url,$consulta,$registros,$pagina);
		if ($data)
		{
			$query = mysql_query($data["consulta"]) or die(mysql_error());
			if (mysql_num_rows($query))
			{
				$retorno['nav'] = $data['nav'];
				while($x = mysql_fetch_array($query))
					$retorno[] = $x;
				return $retorno;
			} else
				return 0;
		}
		return 0;
	}
	
	function getLast($limit=10,$ordem="",$tipo="ASC",$exclude="",$linha="") {
		if ($limit)
			$lt = " LIMIT $limit";
			
		if($exclude)
			$wh = " WHERE id NOT IN($exclude)";
			
		if($linha)
			$wh .= ($wh ? " AND " : " WHERE ") . " linha=$linha";
			
		if ($ordem)
			$ord = " order by $ordem $tipo";
				
		$query = mysql_query("SELECT * FROM " . self::$table . $wh . $ord . $lt) or die(mysql_error());
		
		if (mysql_num_rows($query)) {
			while($resultado = mysql_fetch_array($query))
				$retorno[] = $resultado;
			return  $retorno;
		} else
			return 0;
	}
	
	function getAll($pagina=1,$limite=10,$ordem="",$tipo="ASC",$url="",$linha="") {
		if($linha)
			$wh .= ($wh ? " AND " : " WHERE ") . " linha=$linha";
		
		if ($ordem)
			$ord = " order by $ordem $tipo";
		$consulta = "SELECT * FROM " . self::$table . $wh . $ord;
		$data = Paginacao($consulta,$limite,$pagina,$url);
		if($data)
		{
			$query = mysql_query($data['consulta']);
			$retorno['nav'] = $data['nav'];
			while( $resultado = mysql_fetch_array($query))
				$retorno[] = $resultado;
			return $retorno;
		}
		return 0;
	}
}
?>