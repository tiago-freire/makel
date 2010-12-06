<? $pageTitle = "Localização"; ?>
<? include("includes/header.php"); ?>
	<script type="text/javascript">
		$(function() {
			$("#routeFrom").mask("99999-999");
		});
	</script>
	<body>
		<div id="geral">
			<? include("includes/top.php"); ?>
			<div id="content">
				<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAARK712Uz2nMTQs4-ZjogbzRShpQsx2bHB1dUvU_U1aghWMqmCSBQXFXttej1y9foWgQicGLbSKbvx0A" type="text/javascript"></script>
				<script type="text/javascript">
					var elementId = 'map';
					
					function initMap() {
						$('#routeClear').hide();
						$('#routeMessage').empty().hide();
						
						var map = new GMap2(document.getElementById(elementId));
						map.addControl(new GLargeMapControl());
						map.addControl(new GMapTypeControl());
						map.addControl(new GOverviewMapControl());
						map.disableScrollWheelZoom();
						map.setCenter(new GLatLng(-7.120650, -34.862178), 17);
						map.setMapType(G_HYBRID_MAP);
						map.openInfoWindowHtml(new GLatLng(-7.121690, -34.862178), '<p class="left w100 font16 bold"><?= SITE_NAME ?></p><img src="images/logo_google_maps.gif" width="80" class="left" alt="<?= SITE_NAME ?>" align="middle" />Av. Barão de Mamanguape, 211, Torre, João Pessoa-PB', {maxWidth: 275, noCloseOnClick: true});
						
						directions = new GDirections(map);
		
						GEvent.addListener(directions, "error", function(e) {
							$('#routeMessage').empty().html("O CEP informado não existe ou não possui rota até a loja").show();
						});
						
						GEvent.addListener(directions, "load", function(e) {
							$('#routeMessage').empty().hide();
						});
						
						$("#form-route").submit(function() {
							var fromAddress = $('#routeFrom').val();

							if(fromAddress) {
								$('#routeMessage').empty().hide();
								$('#routeClear').show();
								var toAddress = '-7.121690, -34.862178';
								directions.load("from: " + fromAddress + " to: " + toAddress);
							} else {
								$('#routeMessage').empty().html("Informe um CEP válido").show();
							}
							
							return false;
						});
						
						$("#routeClear").click(function() {
							initMap();
						});
					}
					
					$(function() {
						initMap();
					});
				</script>
				<h2>Digite o seu CEP para traçar a rota até a loja</h2>
				<form id="form-route">
					<label for="routeFrom">CEP:</label>
					<input type="text" id="routeFrom" maxlength="9" />
					<input type="submit" class="btn" id="routeButton" value="Traçar rota" />
					<input type="reset" class="btn none" id="routeClear" value="Limpar" />
					<span id="routeMessage"></span>
				</form>
				<div id="map"></div>
			</div>
			<? include("includes/footer.php"); ?>
		</div>
	</body>
</html>
<? Util::finishZlib(); ?>