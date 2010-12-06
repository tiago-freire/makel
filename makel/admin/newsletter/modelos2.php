<script language="javascript">

	function checa( tipo )
	{
		if( tipo == 1 )
		{
			document.getElementById('boxImagem').innerHTML = '';
			document.getElementById('boxTexto').className = 'mostra';
		}	
		else
		{
			document.getElementById('boxImagem').innerHTML = 'Imagem: <input type="file" name="foto" /><br />Link: http://<input type=\"text\" name=\"link\" >';
			document.getElementById('boxTexto').className  = 'esconde';		
		}
	}
	
</script>
