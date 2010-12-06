	<script type="text/javascript" src="js/scripts.js.php"></script>
	<script type="text/javascript">
		$(function() {
			$('#nav').droppy({speed: 1});
			$('.datepicker').datepicker({
				dateFormat: 'dd-mm-yy',
				dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
				dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
				monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
				monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
				nextText: 'Próximo',
				prevText: 'Anterior',
				showOtherMonths: true
			});
		});
	</script>

	<? if($_GET['module'] == "" || $_GET['module'] == "Index") { ?>
	<script type="text/javascript">
		ddaccordion.init({
			headerclass: "cabecalho", //Shared CSS class name of headers group
			contentclass: "lista", //Shared CSS class name of contents group
			revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
			mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
			collapseprev: false, //Collapse previous content (so only one open at any time)? true/false 
			defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
			onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
			animatedefault: true, //Should contents open by default be animated into view?
			persiststate: true, //persist state of opened contents within browser session?
			toggleclass: ["ativo", "inativo"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
			togglehtml: ["suffix", "<img src='imagens/plus.gif' />", "<img src='imagens/minus.gif'  />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
			animatespeed: "normal" //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
		});
	</script>
	<? } ?>