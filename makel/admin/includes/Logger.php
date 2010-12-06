<?php

class Logger {

	
	function add($user,$atividade)
	{
		$data = date('Y-m-d H:i:s');
		$insert = mysql_query("INSERT INTO logs(log_datetime,log_user,log_atividade) VALUES('$data','$user',\"$atividade\") ") or die(mysql_error());
	}
	
	function showLast($user)
	{
		$select = mysql_query("SELECT DATE_FORMAT(log_datetime,'%d/%m/%Y - %H:%i:%s') log_datetime, log_atividade FROM logs INNER JOIN usuarios ON logs.log_user=usuarios.user_id WHERE log_user='$user' ORDER BY log_id DESC LIMIT 10") or die(mysql_error());
		if(mysql_num_rows($select))
		{
			echo "<strong>Suas últimas atividades</strong>
			<table width='100%' class='fundotable'>";
			
			$class[0] = "linha1";
			$class[1] = "linha2";
			$z = 0;
			while($x = mysql_fetch_array($select))
			{
				
				echo "<tr>
				<td class='$class[$z]'>{$x['log_datetime']}</td>
				<td class='$class[$z]'>".stripslashes($x['log_atividade'])."</td>
				</tr>";
				
				$z = !$z;
			}
			echo "</table>";
		}
		else
			echo "Nenhuma atividade até o momento.";

	}
	
	function showLogs()
	{
		$select = mysql_query("SELECT *,DATE_FORMAT(log_datetime,'%d/%m/%Y - %H:%i:%s') dataformatada FROM logs INNER JOIN usuarios ON logs.log_user=usuarios.user_id ORDER BY log_id DESC") or die(mysql_error());
		if(mysql_num_rows($select))
		{
						
			$class[0] = "linha1";
			$class[1] = "linha2";
			$z = 0;
			echo "<table width='100%' class='fundotable'>
			<tr>
				<td width='15%'><strong>Data / Hora</strong></td>
				<td width='20%'><strong>Usuário</strong></td>
				<td width='65%'><strong>Atividade</strong></td>
			</tr>";
			while($x = mysql_fetch_array($select))
			{
				echo "<tr class='$class[$z]'>
				<td>{$x['dataformatada']}</td>
				<td>{$x['user_nome']}</td>
				<td>{$x['log_atividade']}</td>
				</tr>";
				$z = !$z;
			}
			echo "</table>";
		}
		else
			echo "Nenhuma atividade até o momento.";
	}
	
	function showUserLog($user)
	{
		$select = mysql_query("SELECT *,DATE_FORMAT(log_datetime,'%d/%m/%Y - %H:%i:%s') dataformatada FROM logs INNER JOIN usuarios ON logs.log_user=usuarios.user_id WHERE log_user='$user' ORDER BY log_id DESC") or die(mysql_error());
		if(mysql_num_rows($select))
		{
			echo "<table width='100%' class='fundotable'>
			<tr>
				<td width='15%'>Data / Hora</td>
				<td width='20%'>Usuário</td>
				<td width='65%'>Atividade</td>
			</tr>";
			while($x = mysql_fetch_array($select))
			{
				echo "<tr>
				<td>{$x['dataformatada']}</td>
				<td>{$x['user_nome']}</td>
				<td>{$x['log_atividade']}</td>
				</tr>";
			}
			echo "</table>";
		}
		else
			echo "Nenhuma atividade até o momento.";
	}

}

?>
