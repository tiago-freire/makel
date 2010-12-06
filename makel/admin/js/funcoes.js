// JavaScript Document

function destacaSelectBox ( param ) {
	
	document.getElementById( param ).selected = "selected";
	
}

function confirma( param ) {
	
	if("Tem certeza que deseja excluir?")
	{
		location.href=param;
	}

}

function getHTTPObject() {
		var xmlhttp;
		/*@cc_on
		@if (@_jscript_version >= 5)
		try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
		try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch (E) {
		xmlhttp = false;
		}
		}
		@else xmlhttp = false;
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
			try { xmlhttp = new XMLHttpRequest();
			} catch (e) {
				xmlhttp = false;
			}
		}
		return xmlhttp;
}

  function myFileBrowser (field_name, url, type, win) {

     //alert("Field_Name: " + field_name + "\nURL: " + url + "\nType: " + type + "\nWin: " + win); // debug/testing

    /* If you work with sessions in PHP and your client doesn't accept cookies you might need to carry
       the session name and session ID in the request string (can look like this: "?PHPSESSID=88p0n70s9dsknra96qhuk6etm5").
       These lines of code extract the necessary parameters and add them back to the filebrowser URL again. */

    var cmsURL = './includes/imagebrowser.php';      // script URL
    var searchString = window.location.search;  // possible parameters
    if (searchString.length < 1) {
        // add "?" to the URL to include parameters (in other words: create a search string because there wasn't one before)
        searchString = "?";
    }

    tinyMCE.activeEditor.windowManager.open({
        file : cmsURL + searchString + "&op=lista&type=" + type, // PHP session ID is now included if there is one at all
        width : 420,  // Your dimensions may differ - toy around with them!
        height : 400,
        resizable : "yes",
        inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
        close_previous : "no"
    }, {
        window : win,
        input : field_name
    });
    
	return false;
  }
  
function atualizaLegenda( foto, modulo) {
	
	if (modulo == '')
		modulo = 'Galeria';
	
	var legenda = document.getElementById('gal'+foto).value;
	document.getElementById('gal'+foto).value = 'Atualizando...';
	
	var req = new getHTTPObject();
	req.open('POST', 'modules/'+modulo+'/ajaxac.php?op=atLegenda', false);
	req.setRequestHeader('Content-type',
			'application/x-www-form-urlencoded;charset=utf-8;');
	req.send('foto=' + foto + '&legenda=' + legenda + '&XMLHttpRequest=test');
	
	if(req.status == 200)
	{
		document.getElementById('gal'+foto).value = req.responseText;
		alert('Nome modificado com sucesso');
	}
}
function atualizaPagina( foto, modulo) {
	
	if (modulo == '')
		modulo = 'Galeria';
	
	var legenda = document.getElementById('galv'+foto).value;
	document.getElementById('galv'+foto).value = 'Atualizando...';
	
	var req = new getHTTPObject();
	req.open('POST', 'modules/'+modulo+'/ajaxac.php?op=atPagina', false);
	req.setRequestHeader('Content-type',
			'application/x-www-form-urlencoded;charset=utf-8;');
	req.send('foto=' + foto + '&legenda=' + legenda + '&XMLHttpRequest=test');
	
	if(req.status == 200)
	{
		document.getElementById('galv'+foto).value = req.responseText;	
	}
}