<?
$fileNameArray = explode('/', $_SERVER['PHP_SELF']);
$page = str_replace('.php', '', $fileNameArray[sizeof($fileNameArray) - 1]);
?>

<h1 class="none"><?= ($pageTitle ? ($pageTitle . " | ") : "") . SITE_NAME ?></h1>
<div id="top">
	<a href="index" id="link-home" title="P�gina inicial">P�gina inicial</a>
	<ul>
		<li><a href="index" class="<?= $page == "index" ? "selected" : "" ?>" title="P�gina inicial">P�gina inicial</a></li>
		<li><a href="quem-somos" class="<?= $page == "quem-somos" ? "selected" : "" ?>" title="Quem somos">Quem somos</a></li>
		<li><a href="localizacao" class="<?= $page == "localizacao" ? "selected" : "" ?>" title="Localiza��o">Localiza��o</a></li>
		<li><a href="produtos" class="<?= $page == "produtos" || $page == "produto" ? "selected" : "" ?>" title="Produtos">Produtos</a></li>
		<li><a href="contato" class="<?= $page == "contato" ? "selected" : "" ?>" title="Contato">Contato</a></li>
	</ul>
</div>