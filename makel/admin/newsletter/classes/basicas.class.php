<?php
/**
 * Essa classe foi projetada com PHP5 e alterada para PHP4, pode não funcionar corretamente
 * Classe com métodos básicos
 * 
 * @author   Antonio Josué de Lima Neto <josuedsi@gmail.com>
 */
 
class Basicas {	
	
	// Volta uma página no histórico
	function Volta() 
	{
		echo '<script language="javascript" type="text/javascript">';
		echo 'history.go(-1);';
		echo '</script>';
	}
	
	// Redireciona para url
	function Redir($url)
	{
		echo '<script language="javascript" type="text/javascript">';
		echo "location.href = \"$url\";";
		echo '</script>';
	}	
		
	// Exibe um alerta na tela
	function alerta($mensagem)
	{
		echo '<script language="javascript" type="text/javascript">';
		echo "alert(\"$mensagem\");";
		echo '</script>';		
	}
	
	// Exibe um alerta e volta
	function alertaVolta($mensagem)
	{
		Basicas::alerta($mensagem);
		Basicas::volta();		
	}
	
	// Exibe alerta e redireciona
	function alertaRedir($mensagem,$url)
	{
		Basicas::alerta($mensagem);
		Basicas::Redir($url);		
	}

	// Retorna um dado requisatado da tabela
	function Retorna($campo,$tabela,$descricao,$valor)
	{
		$sql = mysql_query("SELECT $campo FROM $tabela WHERE $descricao = '$valor'");
		while($x = mysql_fetch_array($sql))
		 return $x[$campo];
	}
	
	// Retorna um dado requisatado da tabela com duas clausulas
	function Retorna2($campo,$tabela,$descricao,$valor,$descricao2,$valor2)
	{
		$sql = mysql_query("SELECT $campo FROM $tabela WHERE $descricao = '$valor' and $descricao2 = '$valor2'");
		while($x = mysql_fetch_array($sql))
		 return $x[$campo];
	}	
	
	// Retorna o dia em português, dado o dia em inglês
	function Dia($day) 
	{
		switch($day) 
		{
			case 'Sun': return 'Domingo'; break;
			case 'Mon': return 'Segunda-Feira'; break;
			case 'Tue': return 'Terça-Feira'; break;
			case 'Wed': return 'Quarta-Feira'; break;
			case 'Thu': return 'Quinta-Feira'; break;
			case 'Fri': return 'Sexta-Feira'; break;
			case 'Sat': return 'Sábado '; break;
		}
	} 
	
	// Retorna data e hora no formato dd/mm/aaaa H:m:s dado Y-m-d H:i:s
	function DataHora($dh) 
	{
		list($data,$hora) = explode(" ",$dh);
		$data = explode("-",$data);
		$data = $data[2]."/".$data[1]."/".$data[0];	
		return $data." ".$hora;	
	}
	
	// Retorna somente data formato dd/mm/aaaa dado Y-m-d H:i:s
	function Data($data)
	{
		$data = explode(" ",$data);
		$data = explode("-",$data[0]);
		$data = $data[2]."/".$data[1]."/".$data[0];
		return $data;		
	}
	
}

?>