<?
/* classe para importar dados em um txt... */
class Import
{
	static $table = "emails";
	
	function valido($email)
	{
		$formato = "^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$";
		if(ereg($formato, $email))
			return true;
		else
			return false;
	}
	function ajeita_niver($niver)
	{
		$niver = str_replace('.','/',str_replace('-','/',str_replace('//','/',$niver)));
		$tamanho = strlen(str_replace('/','',$niver));
		if ($tamanho){
			
			$xniver = explode('/',$niver);

			if (sizeof($xniver) == 1)
				return '2008-01-01';
			elseif (sizeof($xniver) == 2)
				return '2008-'.$xniver[1].'-'.$xniver[0];
			elseif (sizeof($xniver) == 3) {
				if (strlen($xniver[2]) == 2)
					$xniver[2] = ($xniver[2] < 10 ? '19'.$xniver[2] : '20'.$xniver[2]);
				return $xniver[2].'-'.$xniver[1].'-'.$xniver[0];
			}
			
			 
		} else
			return '2008-01-01';
	}
	function existe($email,$grupo)
	{
		if ($grupo)
			$gr = "and grupo = '$grupo'";
		$sql = mysql_query("select id from ".Import::$table." where email = '$email' $gr") or die(mysql_error());
		if (mysql_num_rows($sql) > 0) 
			return false;
		else
			return true;
	}
	function Inserir($nome,$email,$grupo,$data) {
		$inserir = 'insert into '.Import::$table.' (`nome`,`email`,`data`,`grupo`) values ("'.$nome.'","'.$email.'","'.$data.'", "'.$grupo.'")';  
		mysql_query($inserir);
		return true;
	}
	
	function remove_duplicados($grupos)
	{
		$result['total'] = 0;
		$result['deletado'] = 0;
		foreach($grupos as $grupo) {
			$sql = mysql_query("select email,id from ".Import::$table." where grupo = '$grupo'") or die(mysql_error());
			while ($registro = mysql_fetch_array($sql)) {
				$id = $registro['id'];
				$result['total'] +=1;
				$email = $registro['email'];
				$xsql = mysql_query("select id from ".Import::$table." where email = '$email' and grupo = '$grupo'");
				if (mysql_num_rows($xsql)>1) {
					$result['em_deletado'] = $email;
					mysql_query("delete from ".Import::$table." where id ='$id'") or die(mysql_error());
					$result['deletado'] += 1;
				}
			}
		}
		return $result;
	}
	
	function importar($txt,$grupo,$separador,$caracter,$conteudo,$ordem)
	{
		set_time_limit(0);
		$ponteiro = fopen ($txt, "r");
		$data = date('Y-m-d');
		
		$result['duplicados'] = 0;
		$result['invalidos'] = 0;
		$result['total'] = 0;
		unset($result['e_invalidos']);
		
		if (($separador == 'L') || ($separador == 'LC')) {
			while (!feof ($ponteiro)) {
			
				$result['total'] += 1;
				$registro = trim(fgets($ponteiro));
				if (sizeof($conteudo) > 1) {
					$dados = explode($caracter,$registro);
	
					if (in_array('Nome',$conteudo))
						$nome = ucwords(strtolower(trim($dados[($ordem[0]-1)])));
						
					if (in_array('Email',$conteudo))
						$email = strtolower(trim(str_replace(' ','',$dados[($ordem[1]-1)])));
						
					if (in_array('Niver',$conteudo)) {
						$niver = trim($dados[($ordem[2]-1)]);
						$data = Import::ajeita_niver($niver);
					}
				} else {
					$dados[0] = $registro;
					if ($conteudo[0]=='Nome')
						$nome = ucwords(strtolower(trim($dados[0])));
					
					if ($conteudo[0]=='Email')
						$email = strtolower(trim(str_replace(' ','',$dados[0])));

					if ($conteudo[0]=='Niver') {
						$niver = trim($dados[0]);
						$data = Import::ajeita_niver($niver);
					}
				}
				if (Import::valido($email)) {
					if (Import::existe($email,$grupo)) {
						Import::Inserir($nome,$email,$grupo,$data);
					} else $result['duplicados'] +=1;
				} else { 
						$result['invalidos'] +=1; 
						$result['e_invalidos'][] = $email;
				}
				
				
			}
		} else if ($separador == 'C') {
		
			while (!feof ($ponteiro)) {
				$result['total'] += 1;
				$email = trim(fgets($ponteiro));
				$emails = explode($caracter,$email);
				foreach ($emails as $v) {
				   $nemail = trim($nemail);
				   
					if (Import::valido($nemail)) {
						if (Import::existe($nemail,$grupo)) {
							$inserir = 'insert into '.Import::$table.' (`email`,`data`,`grupo`) values ("'.$email.'","'.$data.'", "'.$grupo.'")';  
							mysql_query($inserir) or die(mysql_error());
							
						} else $result['duplicados'] +=1;
					} else { 
						$result['invalidos'] +=1; 
						$result['e_invalidos'][] = $nemail;
					}
				}
			}
		}
		return $result;
	}
	

}

?>