<?php
function webcheck ($url) {
	$ch = curl_init ($url) ;
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
	$res = curl_exec ($ch) ;
	curl_close ($ch) ;
	return ($res) ;
}
function horario($sessao,$dia,$hora=0,$minuto=0)
{
	echo "<span><select name='s_".$sessao."_".$dia."h' id='s_".$sessao."_".$dia."h'>\n";
		for ($i=0; $i<=23; $i++)
			echo "\t<option value='".$i."' ".(($i == $hora) ? "selected='selected'" : "")." >".$i." h</option>\n";
	echo "</select></span>\n";
	echo "<span><select class='sl' name='s_".$sessao."_".$dia."m' id='s_".$sessao."_".$dia."m'>\n";
		for ($i=0; $i<=11; $i++)
			echo "<option value='".$i*5 ."' ".((($i*5) == $minuto) ? "selected='selected'" : "").">".$i*5 ." min</option>\n";
	echo "</select></span>\n";
}


function Paginacao($consulta,$regsperpage,$pagina=1,$dados='')
{

	$query = mysql_query($consulta);
	$total = mysql_num_rows($query);
	if($total)
	{
		$paginas = floor($total / $regsperpage);
		if ($total % $regsperpage) $paginas++;
		
		$start = ($pagina * $regsperpage) - $regsperpage;
		
		if($pagina == 1)
			$nav = "<li class=\"pgoff\">&laquo; Anterior</li>";
		else
		{
			$prev = $pagina-1;
			$nav = "<li ><a href='$url?pagina=$prev".$dados."' class=\"pgant\">&laquo; Anterior</a></li>";
		}
		$url = $_SERVER['PHP_SELF'];

		$qt = 5;
		$ini = (($pagina-$qt) >0 ) ? $pagina-$qt : 1;
		$fim = (($pagina+$qt)<$paginas) ? $pagina +$qt : $paginas;
		for($i=$ini;$i<=$fim;$i++)
		{
			if($i == $pagina)
				$nav .= "<li><a class=\"pgsel\"> $i </a></li>";
			else
				$nav .= "<li><a href='$url?pagina=$i".$dados."'>$i</a></li>";
		}
		
		if($pagina == $paginas OR $total < $regsperpage)
			$nav .= "<li class=\"pgoff\">Pr&oacute;xima &raquo;</li>";
		else
		{
			$next = $pagina+1;
			$nav .="<li><a class=\"pgpro\" href='$url?pagina=$next".$dados."'>Pr&oacute;xima &raquo;</a></li>";
		}
		
		$result['consulta'] = $consulta . " LIMIT $start,$regsperpage";
		$result['nav'] = $nav;
		return $result;
	}
	return 0;
}


function makePaginacao($module,$consulta,$regsperpage,$pagina=1)
{

	$query = mysql_query($consulta);
	$total = mysql_num_rows($query);
	if($total)
	{
		$paginas = floor($total / $regsperpage);
		if($total % $regsperpage) $paginas++;
		
		$start = ($pagina * $regsperpage) - $regsperpage;
		
		if($pagina == 1)
			$nav = "Anterior ";
		else
		{
			$prev = $pagina-1;
			$nav = "<a href='./?module=$module&pagina=$prev'>Anterior</a>";
		}
		
		for($i=1;$i<=$paginas;$i++)
		{
			if($i == $pagina)
				$nav .= " <strong>$i</strong> ";
			else
				$nav .= " <a href='./?module=$module&pagina=$i'>$i</a> ";
		}
		if($pagina == $paginas OR $total < $regsperpage)
			$nav .= " Próxima";
		else
		{
			$next = $pagina+1;
			$nav .="<a href='./?module=$module&pagina=$next'>Próxima</a>";
		}
		$result['consulta'] = $consulta . " LIMIT $start,$regsperpage";
		$result['nav'] = $nav;
		return $result;
	}
	return 0;
	
	
}
function convData($data,$caracter="-")
{
	$date = explode("-",$data);
	return $date[2] . "$caracter" . $date[1] . "$caracter" . $date[0];
}

function Autentica($input_login,$input_senha)
{
	$query = "SELECT * FROM usuarios WHERE user_login='$input_login'";
	$cons = execQuery($query);
	if(!mysql_num_rows($cons))
		return 0;
	$res = mysql_fetch_array($cons);
	$id = $res['user_id'];
	$login = $res['user_login'];
	$senha = $res['user_senha'];
	
	if(strcmp(crypt($input_senha,$senha),$senha))
		return 0;
	
	$ip = $_SERVER['REMOTE_ADDR'];	
	$chave = md5($ip . $login); 
	$_SESSION['usuario'] = array("id"=>$id,"login"=>$login,"chave"=>$chave);
	return 1;
	
}

function Logado() {
	
	if(!isset($_SESSION['usuario']))
		return 0;
	
	$user = $_SESSION['usuario'];
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$x = md5($ip . $user['login']);
	if(strcmp($x,$user['chave']))
		return 0;
	$_SESSION['usuario'] = $user;
		return 1;
}

function sendMail($to,$subject,$mens)
{
	$boundary = "XYZ-" . date("dmYis") . "-ZYX";
	
	$headers .= "From: \"Alpha Distribuidora\" <contato@alphadistribuidora.com.br>\r\n";
	$mens = "--$boundary\n";
	$mens .= "Content-Transfer-Encoding: 8bits\n";
	$mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n\n"; //plain
	$mens .= "$mensagem\n";
	mail($to,$subject,$mens,$headers);
}

function execQuery($query)
{
	$x = mysql_query($query) or die(mysql_error());
	return $x;
}

function marcar ( $param_string, $param_valor ) {

	$pos = strpos( $param_string, $param_valor );
	
	if ( $pos === false ) {
	
		return "";
		
	} else {
	
		return "checked='checked'";
	}	
}
function trata_data($data) {
	$dados = explode(' ',$data);
	switch ($dados[2]) {
		case 'Jan' : $dados[2] = '01'; break;
		case 'Feb' : $dados[2] = '02'; break;
		case 'Mar' : $dados[2] = '03'; break;
		case 'Apr' : $dados[2] = '04'; break;
		case 'May' : $dados[2] = '05'; break;
		case 'Jun' : $dados[2] = '06'; break;
		case 'Jul' : $dados[2] = '07'; break;
		case 'Aug' : $dados[2] = '08'; break;
		case 'Sep' : $dados[2] = '09'; break;
		case 'Oct' : $dados[2] = '10'; break;
		case 'Nov' : $dados[2] = '11'; break;
		case 'Dec' : $dados[2] = '12'; break;
	}
	
	return $dados[1].'-'.$dados[2].'-'.$dados[3];
}

// Função para inserir icones dos tipos de arquivos
function inserirIcones( $param_tipo ) {

	$tipo = array( ".pdf" => "pdf.gif", ".doc" => "doc.gif", ".xls" => "xls.gif", ".zip" => "zip.gif", ".ppt" => "ppt.gif", ".pps" => "ppt.gif");
	
	return $tipo[$param_tipo];

}

// Função para saber a extensão de um arquivo
function extensao( $param_arquivo ) {
	$last = substr(strrchr($param_arquivo, "."), 0 );
	return $last;
}
function conteudo($texto,$titulo='') {
	$sub = array("[img]","[/img]",'<strike>','</strike>','<div>','</div>','[i]','[/i]','[u]','[/u]','[b]','[/b]',"[url=","[/url]","]");
	$por = array('<img src="./gerencia/','" alt="'.$titulo.'"/>','<span class="riscado">','</span>','','','<em>','</em>','<span class="under">','</span>','<strong>','</strong>','<a href="',"</a>",'">');
	return str_replace(array('<br>','<br/>','<br />'),array('</p><p>','</p><p>','</p><p>'),nl2br(str_replace($sub,$por,$texto)));
}
function redimensionaMiniatura( $diret, $nome, $larguraMax, $alturaMax ) {

		//IMAGEM A SER ABERTA
		$imagem = $diret . "/" . $nome; 
		
		$tamanho = GetImageSize($imagem);

		//DEFINE OS PARÂMETROS DA MINIATURA	
		if ($tamanho[0] > $tamanho[1]) {
		
			if ($tamanho[0] > $larguraMax) {
		
				$largura = $larguraMax;
				$altura = ($largura * $tamanho[1]) / $tamanho[0];
		
			} else {
		
				$largura = $tamanho[0];
				$altura  = $tamanho[1];
		
			}
		} else {
		
			if($tamanho[0] > $alturaMax) {
		
				$altura = $alturaMax;
				$largura = ($tamanho[0] * $altura) / $tamanho[1];
		
			} else {
		
				$largura = $tamanho[0];
				$altura  = $tamanho[1];
				
			}
		}

		//NOME DO ARQUIVO DA MINIATURA
		$imagem_gerada = explode(".", $imagem);
		$imagem_gerada = $imagem_gerada[0].".jpg";
		
		//CRIA UMA NOVA IMAGEM
		$imagem_orig = ImageCreateFromJPEG($imagem);
		//LARGURA
		$pontoX = ImagesX($imagem_orig);
		//ALTURA
		$pontoY = ImagesY($imagem_orig); 
		
		//CRIA O THUMBNAIL
		$imagem_fin = ImageCreateTrueColor($largura, $altura); 
		
		//COPIA A IMAGEM ORIGINAL PARA DENTRO
		ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY); 
		
		//SALVA A IMAGEM
		ImageJPEG($imagem_fin, $imagem_gerada); 
		
		//LIBERA A MEMÓRIA
		ImageDestroy($imagem_orig);
		ImageDestroy($imagem_fin);

}

class LightBBCodeParser {
    
    //array of bbcode patterns 
    protected $patterns = array
    (
        '/\[b\](.+)\[\/b\]/Uis', 
        '/\[i\](.+)\[\/i\]/Uis',
        '/\[u\](.+)\[\/u\]/Uis',
        '/\[s\](.+)\[\/s\]/Uis',
        '/\[url=(.+)\](.+)\[\/url\]/Ui',
        '/\[img\](.+)\[\/img\]/Ui',    
        '/\[code\](.+)\[\/code\]/Uis',
        '/\[color=(\#[0-9a-f]{6}|[a-z]+)\](.+)\[\/color\]/Ui', 
        '/\[color=(\#[0-9a-f]{6}|[a-z]+)\](.+)\[\/color\]/Uis'
    );
    
    //array of HTML tags that correspond to bbcode patterns
    protected $replacements = array
    (
        '<b>\1</b>', 
        '<i>\1</i>',
        '<u>\1</u>',
        '<s>\1</s>',
        '<a href = "\1" target = "_blank">\2</a>',
        '<img src = "\1" alt = "Image" />',
        '<pre>\1</pre>',
        '<span style = "color: \1;">\2</span>',
        '<div style = "color: \1;">\2</div>'
    );
    
    /**
    * This function converts bbcode to (x)HTML tags.
    *
    * @param string Text that will be parsed.
    * @return string
    */
    public function bbc2html($subject){
        $subject = nl2br($subject);
        
        $subject = preg_replace($this->patterns, $this->replacements, $subject);
            
        return $subject;
    }
}


function retornaestado($sigla)
{
	
	switch ($sigla)
	{
		case 'AC': $retorno = 'Acre'; break;
		case 'AL': $retorno = 'Alagoas'; break;
		case 'AP': $retorno = 'Amapá'; break;
		case 'AM': $retorno = 'Amazonas'; break;
		case 'BA': $retorno = 'Bahia'; break;
		case 'CE': $retorno = 'Ceará'; break;
		case 'DF': $retorno = 'Distrito Federal'; break;
		case 'ES': $retorno = 'Espirito Santo'; break;
		case 'GO': $retorno = 'Goiás'; break;
		case 'MA': $retorno = 'Maranhão'; break;
		case 'MS': $retorno = 'Mato Grosso do Sul'; break;
		case 'MT': $retorno = 'Mato Grosso'; break;
		case 'MG': $retorno = 'Minas Gerais'; break;
		case 'PA': $retorno = 'Pará'; break;
		case 'PB': $retorno = 'Paraíba'; break;
		case 'PR': $retorno = 'Paraná'; break;
		case 'PE': $retorno = 'Pernambuco'; break;
		case 'PI': $retorno = 'Piauí'; break;
		case 'RJ': $retorno = 'Rio de Janeiro'; break;
		case 'RN': $retorno = 'Rio Grande do Norte'; break;
		case 'RS': $retorno = 'Rio Grande do Sul'; break;
		case 'RO': $retorno = 'Rondônia'; break;
		case 'RR': $retorno = 'Roraima'; break;
		case 'SC': $retorno = 'Santa Catarina'; break;
		case 'SP': $retorno = 'São Paulo'; break;
		case 'SE': $retorno = 'Sergipe'; break;
		case 'TO': $retorno = 'Tocantins'; break;
		
		
	}
	
	return $retorno;
	
	
}

?>