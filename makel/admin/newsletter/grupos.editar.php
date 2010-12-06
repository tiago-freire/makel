<br /><h1><img src="imagens/icon_grupos.gif" width="48" height="48" /><br /><strong>Grupos</strong></h1><br />
<div align="center">
<form method="post" action="./?p=forms/newsletter&op=GrupoEditar">
<input type="hidden" name="id" value="<?=$_GET['id'];?>" />
<table width="75%" class="fundotable">
  <tr>
    <td><div align="left"><strong>Cadastrar novo grupo</strong></div></td>
  </tr>
  <tr>
     <td class="linha1"><div align="left" style="padding-left:30px;">
          <label> Nome:&nbsp; <input name="nome" type="text" id="nome" size="60" value="<?=Basicas::Retorna('nome',$tb_grupo,'id',$_GET['id']);?>"  /></label>&nbsp;&nbsp;
          <input type="submit" name="Submit" value="Salvar" />
        </div>
     </td>
  </tr>
 </table>

</form>
</div>
<br />
<br /> 