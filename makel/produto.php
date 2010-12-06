<? $pageTitle = "Produto"; ?>
<? include("includes/header.php"); ?>
	<body>
		<script type="text/javascript">
			$(document).ready(function() {
				centralize('#content ul', '#content ul li');
			});
			
			$(window).resize(function() {
				centralize('#content ul', '#content ul li');
			});
		</script>
		<div id="geral">
			<? include("includes/top.php"); ?>
			<div id="content">
				<input type="button" class="btn btn-produtos" value="<< Voltar" onclick="location.href='produtos'" />
				<ul class="produtos left w100">
					<li>
						<img src="images/produto.jpg" alt="Produto" width="200" height="200" />
						<span>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
						</span>
					</li>
					<li>
						<img src="images/produto.jpg" alt="Produto" width="200" height="200" />
						<span>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
						</span>
					</li>
					<li>
						<img src="images/produto.jpg" alt="Produto" width="200" height="200" />
						<span>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
						</span>
					</li>
					<li>
						<img src="images/produto.jpg" alt="Produto" width="200" height="200" />
						<span>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
						</span>
					</li>
					<li>
						<img src="images/produto.jpg" alt="Produto" width="200" height="200" />
						<span>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
						</span>
					</li>
					<li>
						<img src="images/produto.jpg" alt="Produto" width="200" height="200" />
						<span>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
						</span>
					</li>
					<li>
						<img src="images/produto.jpg" alt="Produto" width="200" height="200" />
						<span>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
						</span>
					</li>
					<li>
						<img src="images/produto.jpg" alt="Produto" width="200" height="200" />
						<span>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
						</span>
					</li>
				</ul>
			</div>
			<? include("includes/footer.php"); ?>
		</div>
	</body>
</html>
<? Util::finishZlib(); ?>