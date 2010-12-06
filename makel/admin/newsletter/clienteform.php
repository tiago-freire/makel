<?
	$id = $_GET['idCliente'];
	if($id) {
		include_once("classes/Clientes.php");
		$cliente = new Clientes($id);
	}
?>
<br /><h1>
<img src="imagens/icon_grupos.gif" width="48" height="48" /><br /><strong>Clientes</strong></h1><br />
<div align="center">

<form method="post" action="./?p=forms/newsletter&op=clienteEditar">
<input type="hidden" name="id" value="<?=$id?>" />

<table width="75%" class="fundotable">
  <tr>
    <td><div align="left"><strong>Cadastrar Cliente</strong></div></td>
  </tr>
  <tr>
  	<td class="txtdir">Nome:</td>
  	<td class="txtesq"><input name="nome" type="text" id="nome" size="60" value="<?=$cliente->nome?>" /></td>
  </tr>
  <tr>
  	<td class="txtdir">Endereço:</td>
  	<td class="txtesq"><input name="endereco" type="text" id="endereco" size="60" value="<?=$cliente->endereco?>" /></td>
  </tr>  
  <tr>
  	<td class="txtdir">Telefone:</td>
  	<td class="txtesq"><input name="telefone" type="text" id="telefone" size="20" value="<?=$cliente->telefone;?>" /></td>
  </tr>  
  <tr>
  	<td class="txtdir">Site:</td>
  	<td class="txtesq"><input name="site" type="text" id="site" size="60" value="<?=$cliente->site?>" /></td>
  </tr>  
  <tr>
  	<td class="txtdir">E-mail:</td>
  	<td class="txtesq"><input name="email" type="text" id="email" size="60" value="<?=$cliente->email?>" /></td>
  </tr>    
  <tr>
  	<td class="txtdir">Status:</td>
  	<td class="txtesq">
    	<select name="status">
        	<option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select>
    </td>
  </tr>      
  <tr>
     <td class="txtdir">
     </td>
     <td class="txtesq">
             <input type="submit" name="Submit" value="Salvar" />
     </td>
  </tr>
 </table>
  
</form>
</div>
<br />
<br /> 	