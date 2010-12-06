<br /> <br />
<h1>Gerenciador de Conteúdo</h1>
<br /> <br />
<div style="width:100%; float:left; margin:0 auto;">
    <?php
		$perms = $owner->perms;
		if(count($perms))
		{
			foreach($DIVIDE as $Key => $valor)
			{
			
				$valor = array_intersect($valor,$perms);
				
				if ($valor) 
				{
					echo '<div class="cabecalho"><span class="nomeSecao">'.$Key."</span></div>\n";
					echo "\t".'<div class="lista">'."\n";
					foreach($valor as $item)
					{	
						if(!strcmp($item,"Newsletter"))
							$link = "newsletter/index.php";
						else
							$link = "./?module=$item";
						
						if ($MODULES["$item"]["plural"] != '')
							echo "\t\t<div class='item' ><a href='$link'><img src='modules/$item/logo.gif' /><br />" . $MODULES["$item"]["plural"] . "</a></div>\n";
					}
					echo '</div><br /><br />'."\n";
				}
			}
		}
		else
			echo "<div style='padding-bottom:15px; list-style:none; float:left; padding:20px; width:15%' >Você não possui permissões no momento. Entre em contato com o administrador.</div>\n";
?>
</div>
<p class="clear">&nbsp;</p>
<?
	Logger::showLast($owner->id);
?>
<br clear="all" />
