
$(function() {
	$('.form_monitored').submit(function() {
		var result = true;
		var reqs = $('.form_required');

		reqs.each(function() {
			var r = $(this);
			var msg;

			if(!r.val()) {
				result = result && false;
				msg = 'Campo obrigatório não preenchido';
			} else if(r.hasClass('form_cpf') && !isCPF(r.val())) {
				result = result && false;
				msg = 'CPF inválido';
			} else if(r.hasClass('form_email') && !isEmail(r.val())) {
				result = result && false;
				msg = 'E-mail inválido';
			}  else if(r.hasClass('form_login') && !isLogin(r.val())) {
				result = result && false;
				msg = 'Login Inválido. Digite apenas letras, números, underline (_) e hífen (-)';
			}
			else result = result && true;
			if(!result) {
				r.addClass('form_error');
				r.css({'border-style': 'solid', 'border-color': 'red'});
				$('.' + (r.attr('name') == 'telefone_ddd' ? 'telefone_tel' : r.attr('name'))).html(msg);
				r.keypress(function() { if(r.val()) { r.removeClass('form_error'); r.css({'border-style': '', 'border-color': ''}); $('.' + (r.attr('name') == 'telefone_ddd' ? 'telefone_tel' : r.attr('name'))).empty(); }});
			}
		});
		if(!result || $('.form_error').length) return false;
	});
	
	$('.form_required').blur(function() {
		var result = true;
		var r = $(this);
		var msg;

		if(!r.val()) {
			result = result && false;
			msg = 'Campo obrigatório não preenchido';
		} else if(r.hasClass('form_cpf') && !isCPF(r.val())) {
			result = result && false;
			msg = 'CPF inválido';
		} else if(r.hasClass('form_email') && !isEmail(r.val())) {
			result = result && false;
			msg = 'E-mail inválido';
		} else if(r.hasClass('form_login') && !isLogin(r.val())) {
			result = result && false;
			msg = 'Login Inválido. Digite apenas letras, números, underline (_) e hífen (-)';
		} else result = result && true;
		if(!result) {
			r.addClass('form_error');
			r.css({'border-style': 'solid', 'border-color': 'red'});
			$('.' + (r.attr('name') == 'telefone_ddd' ? 'telefone_tel' : r.attr('name'))).html(msg);
			r.keypress(function() { if(r.val()) { r.removeClass('form_error'); r.css({'border-style': '', 'border-color': ''}); $('.' + (r.attr('name') == 'telefone_ddd' ? 'telefone_tel' : r.attr('name'))).empty(); }});
		} else {
			r.removeClass('form_error');
		}
	});
});

function isCPF(a){a=a.replace('.', '').replace('.', '').replace('-', '');if(a.length!=11||a=="00000000000"||a=="11111111111"||a=="22222222222"||a=="33333333333"||a=="44444444444"||a=="55555555555"||a=="66666666666"||a=="77777777777"||a=="88888888888"||a=="99999999999")return false;soma=0;for(i=0;i<9;i++)soma+=parseInt(a.charAt(i))*(10-i);resto=11-(soma%11);if(resto==10||resto==11)resto=0;if(resto!=parseInt(a.charAt(9)))return false;soma=0;for(i=0;i<10;i++)soma+=parseInt(a.charAt(i))*(11-i);resto=11-(soma%11);if(resto==10||resto==11)resto=0;if(resto!=parseInt(a.charAt(10)))return false;return true}
function isEmail(a){f=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;return f.test(a);}
function isLogin(a){f=/^[a-zA-Z][a-zA-Z0-9\_\-]*$/;return f.test(a);}