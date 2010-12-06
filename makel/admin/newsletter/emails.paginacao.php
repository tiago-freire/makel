<?
		$link_p_pag = 5; 
		$reg_p_pag = 400;
		$pag = $_GET['pag'];
		$busca = mysql_query("SELECT count(id) FROM $tb_emails $wr") or die(mysql_error());
		$registros = mysql_result($busca,0);
		$num_total_paginas = ($registros%$reg_p_pag==0)?$registros/$reg_p_pag:floor($registros/$reg_p_pag)+1;
		if ($pag>$num_total_paginas)
		echo "Erro<br><br>";
		else
		if (!$pag)
		$pag = 1;
		$inicio = ($reg_p_pag*$pag)-$reg_p_pag;		
?>