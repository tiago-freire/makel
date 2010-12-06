<? include("includes/header.php"); ?>
	<script type="text/javascript">
		function getMaxHeight(selector) {
			var maxHeight = 0;
			
			$(selector).each(function() {
				var currentHeight = $(this).innerHeight();
				if(currentHeight > maxHeight) {
					maxHeight = currentHeight;
				}
			});
			
			return maxHeight;
		}
		
		function adjustPainelHeight() {
			var painelHeight = Math.floor(getMaxHeight('#painel a') * 0.92);
			$('#painel').css('height', painelHeight + 'px');
		}
		
		$(function() {
			/* Painel */
			var interval = 5000;
			var selectorElementPainel = '#painel a';
			var selectorImagesPainel = selectorElementPainel + ' img';
			var total = $(selectorElementPainel).length;
			var totalImages = $(selectorImagesPainel).length;
			var countLoadedImages = 0;
			
			if(total > 1) {
				$(selectorElementPainel + ' img').load(function() {
					countLoadedImages++;
					
					if(countLoadedImages == total) {
						adjustPainelHeight();
						
						$(window).resize(function() {
							adjustPainelHeight();
						});
						
						var current = 1;
					
						window.setInterval(function() {
							$(selectorElementPainel + ':visible').fadeOut(function() {
								$(selectorElementPainel + ':eq(' + current + ')').fadeIn();
								current = current < (total - 1) ? (current + 1) : 0;
							});
						}, interval);
					}
				}).each(function() {
					if(this.complete || ($.browser.msie && parseInt($.browser.version) == 6)) {
						$(this).trigger("load");
					}
				});
			}
		});
		
		$(document).ready(function() {
			centralize('#parceiros', '#parceiros a');
		});
		
		$(window).resize(function() {
			centralize('#parceiros', '#parceiros a');
		});
	</script>
	<body>
		<div id="geral">
			<? include("includes/top.php"); ?>
			<div id="content">
				<div id="painel">
					<a href="produtos" title="Coleção Smart">
						<img src="images/colecao_smart.jpg" alt="Coleção Smart" />
					</a>
					<a class="none" href="produtos" title="Coleção Boss">
						<img src="images/colecao_boss.jpg" alt="Coleção Boss" />
					</a>
					<a class="none" href="produtos" title="Coleção Facility">
						<img src="images/colecao_facility.jpg" alt="Coleção Facility" />
					</a>
				</div>
				<p>
					<img src="images/selo_makel.jpg" alt="<?= SITE_NAME ?>" class="right" />
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet, mi risus tempus leo, ut rhoncus ligula eros sed sapien. Morbi id tortor ut est auctor tincidunt non a lectus. Curabitur metus risus, adipiscing id molestie sed, lobortis non justo. Suspendisse potenti. Suspendisse vitae eros nulla, id elementum justo. Integer in massa elit. Morbi orci libero, porttitor ut adipiscing sit amet, placerat nec sem. Nunc facilisis mauris id risus blandit at porttitor metus euismod. Morbi sit amet odio enim. Proin sit amet varius ante. Nunc felis felis, molestie vel tincidunt ac, pretium id lorem. In vitae quam sem, et tincidunt lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet, mi risus tempus leo, ut rhoncus ligula eros sed sapien. Morbi id tortor ut est auctor tincidunt non a lectus. Curabitur metus risus, adipiscing id molestie sed, lobortis non justo. Suspendisse potenti. Suspendisse vitae eros nulla, id elementum justo. Integer in massa elit. Morbi orci libero, porttitor ut adipiscing sit amet, placerat nec sem. Nunc facilisis mauris id risus blandit at porttitor metus euismod. Morbi sit amet odio enim. Proin sit amet varius ante. Nunc felis felis, molestie vel tincidunt ac, pretium id lorem. In vitae quam sem, et tincidunt lectus.
				</p>
				<p>
					Fusce sagittis gravida ornare. Vivamus faucibus cursus ante, in ultrices massa sodales sed. Fusce tincidunt quam sapien. Integer hendrerit ultrices tortor non euismod. Nam suscipit leo ipsum, quis sagittis libero. Sed et sapien in sapien volutpat faucibus volutpat a lectus. Suspendisse potenti. Nullam posuere, erat sed elementum consequat, urna nulla convallis nibh, tristique congue risus leo ut sapien. Suspendisse tempus nulla nec libero sagittis blandit. Mauris at lectus lectus. Suspendisse potenti. Vivamus purus ligula, mollis scelerisque mattis vitae, lobortis ut lectus. Cras laoreet dignissim vehicula. Proin feugiat mattis sapien quis porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra, ante in consectetur imperdiet, mi risus tempus leo, ut rhoncus ligula eros sed sapien. Morbi id tortor ut est auctor tincidunt non a lectus. Curabitur metus risus, adipiscing id molestie sed, lobortis non justo. Suspendisse potenti. Suspendisse vitae eros nulla, id elementum justo. Integer in massa elit. Morbi orci libero, porttitor ut adipiscing sit amet, placerat nec sem. Nunc facilisis mauris id risus blandit at porttitor metus euismod. Morbi sit amet odio enim. Proin sit amet varius ante. Nunc felis felis, molestie vel tincidunt ac, pretium id lorem. In vitae quam sem, et tincidunt lectus.
				</p>
				<div id="parceiros">
					<a href="http://www.danna.com.br/" title="Danna" target="_blank"><img src="images/parceiros/danna.jpg" alt="Danna" /></a>
					<a href="http://www.pandin.com.br/" title="Pandin" target="_blank"><img src="images/parceiros/pandin.jpg" alt="Pandin" /></a>
					<a href="http://www.arvy.ind.br/" title="Arvy" target="_blank"><img src="images/parceiros/arvy.jpg" alt="Arvy" /></a>
					<a href="http://www.incoflex.ind.br/" title="Incoflex" target="_blank"><img src="images/parceiros/incoflex.jpg" alt="Incoflex" /></a>
					<a href="http://www.cavaletti.com.br/" title="Cavaletti" target="_blank"><img src="images/parceiros/cavaletti.jpg" alt="Cavaletti" /></a>
					<a href="http://www.moveisbelo.com.br/" title="Móveis Belo" target="_blank"><img src="images/parceiros/moveis-belo.jpg" alt="Móveis Belo" /></a>
				</div>
			</div>
			<? include("includes/footer.php"); ?>
		</div>
	</body>
</html>
<? Util::finishZlib(); ?>