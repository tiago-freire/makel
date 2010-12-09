<? $pageTitle = "Contato"; ?>
<? include("includes/header.php"); ?>
	<script type="text/javascript">
		$(function() {
			$("#telefone").mask("(99) 9999-9999");
		});
	</script>
	<body>
		<div id="geral">
			<? include("includes/top.php"); ?>
			<div id="content">
				<h2>Entre em contato com a Makel</h2>
				<div class="left w50">
					<ul>
						<li class="icon-endereco">Av. Barão de Mamanguape, 211, Torre, João Pessoa-PB - CEP: 58040-330</li>
						<li class="icon-telefone">(83) 3241-2445</li>
						<li class="icon-email">contato@makelmoveis.com</li>
					</ul>
				</div>
				<div class="right w50 contato">
					<form method="post" class="left w100" action="contato.do">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" class="maior" />
						<label for="email">E-mail</label>
						<input type="text" name="email" id="email" class="maior" />
						<label for="telefone">Telefone</label>
						<input type="text" name="telefone" id="telefone" class="menor" />
						<label for="mensagem">Mensagem</label>
						<textarea name="mensagem" id="mensagem"></textarea>
						<input type="submit" name="btnEnviar" class="btn" id="btnEnviar" value="Enviar" />
					</form>
				</div>
			</div>
			<? include("includes/footer.php"); ?>
		</div>
	</body>
</html>
<? Util::finishZlib(); ?>