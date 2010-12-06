<div id="menu">
<ul id='nav'>
  <li class="xn"><a href='index.php'>Página Inicial</a></li>
  <li class="xn"><a href='index.php?module=Usuario&op=editar'>Meus Dados</a></li>
  <? if($owner->isAdmin()) {?>
  <li class="xn"><a href="logs.php" target="_blank">Logs de Acesso</a></li>
  <? } if (($_GET['module'] != "") and ($_GET['module'] != "Index")) { ?>
  <li class="xn"><a href='#' onclick="return false;">Seções do Site</a>
  <ul>
	  <? foreach($DIVIDE as $key => $value) {
	  	if ($key != "Newsletter")
		{
       		echo '<li><a href="#" onclick="return false;">'.$key.'</a>';
			if ($value)
				echo "<ul>";
			foreach ($value as $valor)
			{
				if ($valor == "Catalogo") {
					echo '<li class="z"><a href="?module='.$valor.'">'.$MODULES[$valor]['plural'].'</a></li>';	
				} else {
						echo '<li class="z"><a href="?module='.$valor.'">'.$MODULES[$valor]['plural'].'</a><ul><li class="k"><a href="?module='.$valor.'&op=add">Inserir</a></li><li class="k"><a href="?module='.$valor.'">Listar / Deletar</a></li></ul></li>';	
					
				}
			}
			if ($value)
				echo "</ul>";	
			echo '</li>';
		}
		else 
			echo '<li><a href="./newsletter/">'.$key.'</a>';
	  }
      ?>
  </ul>
  </li>
  <? } ?>
  <li class="xn"><a href="sair.php">Sair</a></li>
</ul>
  <div id="sauda">Você está logado como: <a href="index.php?module=Usuario&op=editar" class="link"><?=$owner->login?></a> [ <a href="sair.php">Sair</a> ]</div>
  <br class="clear" />
 
</div>
<br class="clear" />
<div>
  
</div> 