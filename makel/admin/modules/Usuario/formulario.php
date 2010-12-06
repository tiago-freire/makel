<?
if (!strcmp($_GET['op'],"editar")) {

	if(!isset($_GET['id']) OR !$owner->isAdmin())
		$editauser = $owner;
	else
	{
		$id = $_GET['id'];
		$editauser = new Usuario($id);
	}
		
		
	$action = "Editar";
}
else {

	if(!$owner->isAdmin())
	{
		Util::throwError('permissao');
	}
	
	$editauser = new Usuario();
	
	$action = "Cadastrar";
}

?>

 
 <h1><img src="modules/Usuario/logo.gif" alt="user" width="64" height="64" align="absmiddle" /><?=$action?> Usuário</h1>  
 <br />
      <br />
	  <form name="frmUsuarios" method="post" action="modules/Usuario/form.php?op=<?=$_GET['op']?>">
	  <input type="hidden" name="id" value="<?=$editauser->id?>" />
	  <table width="80%" class="fundotable" align="center">
        <tr>
          <td width="36%" class="left">Nome:</td>
          <td width="64%" class="right">
              <input name="nome" autocomplete="off" type="text" id="nome" value="<?=$editauser->nome?>" size="40" />    		</td>
        </tr>
        <tr>
          <td class="left">Login:</td>
          <td class="right"><input name="login" autocomplete="off" type="text" id="login" value="<?=$editauser->login?>" size="40" maxlength="15" />         </td>
        </tr>
        <tr>
          <td class="left">Senha:</td>
          <td class="right"><input name="senha1" autocomplete="off" type="password" id="senha1" />		</td>
        </tr>
        <tr>
          <td class="left">Repita a Senha: </td>
          <td class="right"><input name="senha2" autocomplete="off" type="password" id="senha2" /></td>
        </tr>
       <?php
	   	if($owner->isAdmin())
		{
	   ?>
	    <tr>
          <td class="left">Nível:         </td>
          <td class="right">
              <select name="nivel" id="nivel" onchange="javascript: if (this.value == 1) { document.getElementById('NOT').checked = 'checked'; document.getElementById('LIN').checked = 'checked'; document.getElementById('SOC').checked = 'checked'; document.getElementById('ARR').checked = 'checked'; } else { document.getElementById('NOT').checked = ''; document.getElementById('LIN').checked = ''; document.getElementById('SOC').checked = ''; document.getElementById('ARR').checked = ''; }">
                <option value="0" <? if(!$editauser->admin) { ?> selected="selected" <? } ?>>Normal</option>
                <option value="1" <? if($editauser->admin) { ?> selected="selected" <? } ?>>Administrador</option>
              </select>		</td>
        </tr>
        <tr>
          <td class="left">Permiss&otilde;es</td>
          <td class="right">
		  	<?php
				foreach($MODULES as $item => $xmod)
				{
					if ($MODULES["$item"] != '') {
					?>	
					<input type="checkbox" name="permissoes[]"  value="<?=$item?>" <?=$editauser->marcaPerm($item)?> /> <?=strip_tags($xmod['plural']);?><br/>
					<?	
					}
				}
			?>
 		</td>
        </tr>
		<?php
			} //fim-if
		?>
      </table>
	  <br />

      <input type="submit" name="Submit" value="Cadastrar" class="button"/>

      </form>

