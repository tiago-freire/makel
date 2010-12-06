ajaxHTML = function ajaxHTML(id,url){
objetoHTML=document.getElementById(id);
objetoHTML.innerHTML="Carregando...";
try{
xmlhttp = new XMLHttpRequest();
}catch(ee){
try{
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
try{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}catch(E){
xmlhttp = false;
}
}
}
xmlhttp.open("GET",url);
xmlhttp.onreadystatechange=function() {
if (xmlhttp.readyState==4){
retorno=unescape(xmlhttp.responseText.replace(/\+/g," "));
objetoHTML.innerHTML=retorno;
}
}
xmlhttp.send(null);
};
