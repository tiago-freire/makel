
		<div align="center">

          <h1><img src="modules/Usuario/logo.gif" width="64" height="64" align="absmiddle"> Usu&aacute;rios Cadastrados</h1>
          
		  <div align="right" width="90%"><img src="imagens/icones/mini_icons/icon_user.gif" width="16" height="16" align="absmiddle"><a href="./?module=Usuario&amp;op=add">Adicionar Usuário</a></div>
		  <p>&nbsp;</p>
          <table width="90%" class="fundotable">
		  <tr >
		  <td width="40%" class="title"> <strong>Nome do Usuário </strong></td>
		  <td width="30%" class="title"> <strong>Login </strong></td>
		  <td width="15%" class="title"></td>
		  <td width="15%" class="title"></td>
		  </tr>
            <?
		if(!isset($_GET['pagina']))
			$pagina = 1;
		else
			$pagina = $_GET['pagina'];
		
		$consulta = "SELECT user_id,user_nome,user_login FROM usuarios ORDER BY user_nome ";	
		$data = makePaginacao($_GET['module'],$consulta,10,$pagina);
		
		if($data)
		{
			$query = mysql_query($data['consulta']);
			while( $arrayUsuarios = mysql_fetch_array( $query ) ) 
			{
				$class[0]="linha1";
				$class[1]="linha2";
				$z = 0;
			?>
            <tr >
              <td class="<?=$class[$z]?>"><strong><?=$arrayUsuarios['user_nome']?></strong></td>
              <td class="<?=$class[$z]?>"><?=$arrayUsuarios['user_login']?></td>
			  <td class="<?=$class[$z]?>"><a href="./?module=Usuario&op=editar&id=<?=$arrayUsuarios['user_id']; ?>">Editar</a></td>
              <td class="<?=$class[$z]?>"><a href="./modules/Usuario/form.php?op=deletar&id=<?=$arrayUsuarios['user_id']; ?>">Deletar</a></td>
            </tr>
            <? 
				$z = !$z;
			}//while
		}//if

		 ?>
            <tr>
              <td colspan="4" class="linha1"><p align="center">
                  <?=$data['nav']?>
              </p></td>
            </tr>
          </table>
          <p>&nbsp;</p>
        </div>
      