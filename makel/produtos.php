<? $pageTitle = "Produtos"; ?>
<? include("includes/header.php"); ?>
	<body>
		<script type="text/javascript">
			function initGrid() {
				if($('#content ul li').length) {
					var totalWidth = $('#content ul').width();
					var imgWidth = 200;
					var textWidth = totalWidth - imgWidth - 40;
					$('#content ul li a .text').css('width', textWidth + 'px');
					$('#content ul li').hover(
						function() {
							$(this).css('background-color', '#eee');
						},
						function() {
							$(this).css('background-color', '#fff');
						}
					);
				}
			}
			
			$(document).ready(function() {
				initGrid();
			});
			
			$(window).resize(function() {
				initGrid();
			});
		</script>
		<div id="geral">
			<? include("includes/top.php"); ?>
			<div id="content">
				<ul class="categorias left w100">
					<li>
						<a href="produto" title="Categoria">
							<img src="images/colecao.jpg" alt="Categoria" width="200" height="100" class="left" />
							<div class="text left">
								<h2>Nome da categoria</h2>
								<span>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
								</span>
							</div>
						</a>
					</li>
					<li>
						<a href="produto" title="Categoria">
							<img src="images/colecao.jpg" alt="Categoria" width="200" height="100" class="left" />
							<div class="text left">
								<h2>Nome da categoria</h2>
								<span>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
								</span>
							</div>
						</a>
					</li>
					<li>
						<a href="produto" title="Categoria">
							<img src="images/colecao.jpg" alt="Categoria" width="200" height="100" class="left" />
							<div class="text left">
								<h2>Nome da categoria</h2>
								<span>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
								</span>
							</div>
						</a>
					</li>
					<li>
						<a href="produto" title="Categoria">
							<img src="images/colecao.jpg" alt="Categoria" width="200" height="100" class="left" />
							<div class="text left">
								<h2>Nome da categoria</h2>
								<span>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet.
								</span>
							</div>
						</a>
					</li>
				</ul>
			</div>
			<? include("includes/footer.php"); ?>
		</div>
	</body>
</html>
<? Util::finishZlib(); ?>