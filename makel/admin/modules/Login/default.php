<?

if( isset($_POST['login']) ) {
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	if (!Autentica($login,$senha)) {

    	$erro = "1";
	
	}	
}

if( Logado() ) {

?>
  <script language="javascript"> location.href="./?module=Index"; </script>
<?
} 
?>
<br /> <br />
		<table width="755" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><br /><br />
      <form action="./?module=Login" method="post" name="frmLogin" id="frmLogin">
        <table width="250" class="fundotable">
          <tr>
            <td width="68" class="left">Login:           </td>
            <td width="170" class="right">
              <input name="login" type="text" id="login" />
           </td>
          </tr>
          <tr>
            <td class="left">Senha:</td>
            <td class="right">
              <input name="senha" type="password" id="senha" />
            </td>
          </tr>
        </table><br />
        <input type="submit" name="Submit" value="Entrar" class="button" />

      </form></td>
  </tr>
  <? 
  if ( isset($erro) ) {
  ?>
  <tr>
  	<td>Login ou senha inválidos. Por favor digite corretamente.</td>
  </tr>
  <? } ?>
</table>