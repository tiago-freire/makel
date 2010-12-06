<?
class Util {
	function startZlib() {
		if(extension_loaded('zlib')) {
			ob_start('ob_gzhandler');
		}
	}
	
	function finishZlib() {
		if(extension_loaded('zlib')) {
			ob_end_flush();
		}
	}
	
	function Crop($foto,$dados,$local,$destino,$novo_nome) {
		$imagem = imagecreatefromjpeg($local. "/" . $foto);
		$result = imagecreatetruecolor($dados['t_width'],$dados['t_height']);
		
		$corta = imagecopyresampled($imagem,$imagem,0,0,$dados['x1'],$dados['y1'],$dados['width'],$dados['height'],$dados['width'],$dados['height']);
		$resize = imagecopyresampled($result,$imagem,0,0,0,0,$dados['t_width'],$dados['t_height'],$dados['width'],$dados['height']);
		
		imagejpeg($result,$destino .'/'. $novo_nome,100);
	}
	
	function makePaginacao($module,$consulta,$regsperpage,$pagina=1) {
		$query = mysql_query($consulta);
		$total = mysql_num_rows($query);
		if($total)
		{
			$paginas = $total / $regsperpage;
			if($total % $regsperpage) $paginas++;
			
			$start = ($pagina * $regsperpage) - $regsperpage;
			
			if($pagina == 1)
				$nav = "Anterior ";
			else
			{
				$prev = $pagina-1;
				$nav = "<a href='./?module=$module&pagina=$prev'>Anterior</a>";
			}
			
			for($i=1;$i<$paginas;$i++)
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

	function convData($data,$separador="-") {
		$date = explode("-",$data);
		return $date[2] . $separador . $date[1] . $separador . $date[0];
	}
	
	function convData2($data) {
		$date = explode("-",$data);
		return $date[2] . "/" . $date[1] . "/" . $date[0];
	}
	
	function throwError($tipo) {
		switch($tipo)
		{
			case "permissao": $msg = "Você não tem permissão para acessar esta página."; break;
			case "senhas": $msg = "As senhas informadas não coincidem";	break;
			default: $msg = "Ocorreu um erro.";break;
		}
		echo "<script language='javascript'>alert('$msg');location.href='". $_SERVER['HTTP_REFERER']."';</script>";exit();		
	}
	
	function saveThumb($file,$destdir,$sizeX,$sizeY) {
		
		$foto      = $file['tmp_name'];
		$foto_name = $file['name'];
		
		if ( !empty($foto_name) ) {
		
			switch($file['type'])
			{
				case "image/jpg":
				case "image/jpeg":
				case "image/pjpg":
				case "image/pjpeg":
					$ext = "jpg";
					break;
				
				case "image/gif":
					$ext = "gif";
					break;
				
				case "image/png":
					$ext = "png";
					break;
					
				default:
					return 0;
			}
			
			$newname = substr(md5($foto_name),0,10) . date('Ymdhis') . ".$ext";
		
			$fileorig = $destdir . "/" . $newname;
			
			if(!move_uploaded_file($file['tmp_name'],$fileorig))
			{
				return 0;
			}

			$path = $fileorig;

			$r = Util::makeThumb($path,$path,$sizeX,$sizeY,$ext);
			if($r)
				return $newname;
			else
				return 0;
		}
	}
	
	function showMsg($msg,$destino) {
		echo "<script language='javascript'>alert(\"$msg\");location.href=\"$destino\";</script>";exit();
	}
	
	function concPerm($array) {
		$result = count( $array );
		$permi = "";
		for ($i = 0; $i <= $result-1; $i++) {
			$permi .= $array[$i] . ";";
		}
		return $permi;
	}

	function apagaImage($CIMAGENS,$DEFINEIMG,$local,$nome) {
		if ($CIMAGENS) {
			foreach ($DEFINEIMG as $imagemx) {
				$imgx = $CIMAGENS[$imagemx];
				$pasta = $local.$imgx['Pasta'];
				@unlink($pasta . "/" . $nome);
			}
		}
	}
	
	function apagaArquivo($pasta,$arquivo) {
		@unlink($pasta . "/" . $arquivo);
	}
	
	function saveImage($file,$destdir,$queimg,$CIMAGENS,$Agua=false,$marca='',$posX='R',$posY='B') {
		$foto      = $file['tmp_name'];
		$foto_name = $file['name'];
		
		if ( !empty($foto_name) ) {
			switch($file['type']) {
				case "image/jpg":
				case "image/jpeg":
				case "image/pjpg":
				case "image/pjpeg":
					$ext = "jpg";
					break;
				
				case "image/gif":
					$ext = "gif";
					break;
				
				case "image/png":
					$ext = "png";
					break;
					
				default:
					return 0;
			}
			$newname = substr(md5($foto_name),0,10) . date('Ymdhis') . ".$ext";
			$original = $destdir . "/".$newname;
			if(!move_uploaded_file($file['tmp_name'],$original)) { return 0; }
			
			
			if ($queimg) {
				$total = sizeof($queimg)-1;
				for ($i = $total; $i>=0; $i--) {
					
					$img = $CIMAGENS[$queimg[$i]];
					$pasta = $destdir.$img['Pasta'];
					if (!is_dir($pasta)) 
						mkdir($pasta,'1777');
					$path = $pasta . "/" . $newname;
						$r = Util::makeThumb($original,$path,$img['X'],$img['Y'],$ext,$img['Corta']);
					if (($i == $total) and ($Agua)) {
							Util::marcaDagua($path,$marca,$posX,$posY);
							$original = $path;
					}
				}
			}

			if($r)
				return $newname;
			else
				return 0;
		}
	}
	
	function saveImageUrl($url,$destdir,$queimg,$CIMAGENS,$Agua=false,$marca='',$posX='R',$posY='B') {
		$ext = str_replace(".","",substr($url,-4));
		if ( !empty($url) ) {
			$newname = substr(md5($url),0,10) . date('Ymdhis') . ".$ext";
			$original = $destdir . "/".$newname;
			if(!copy($url,$original)) { return 0; }
						
			if ($queimg) {
				$total = sizeof($queimg)-1;
				for ($i = $total; $i>=0; $i--) {
					
					$img = $CIMAGENS[$queimg[$i]];
					$pasta = $destdir.$img['Pasta'];
					if (!is_dir($pasta)) 
						mkdir($pasta,'1777');
					$path = $pasta . "/" . $newname;
						$r = Util::makeThumb($original,$path,$img['X'],$img['Y'],$ext,$img['Corta']);
					if (($i == $total) and ($Agua)) {
							Util::marcaDagua($path,$marca,$posX,$posY);
							$original = $path;
					}
				}
			}

			if($r)
				return $newname;
			else
				return 0;
		}
	}
	
	function marcaDagua($image,$logofile,$x='R',$y='B') {
		
		$imagem = imagecreatefromjpeg($image);
		$logo = imagecreatefrompng($logofile);
		
		$wi = imagesx($imagem);
		$he = imagesy($imagem);
		
		$logowi = imagesx($logo);
		$logohe = imagesy($logo);
		
		$thumb = imagecreatetruecolor($wi, $he);
		
		//imagecopyresampled($imagem,$logo, $wi-$logowi, $he-$logohe, 0, 0, $logowi, $logohe, $logowi, $logohe);
		
		switch ($x)
		{
			case 'R' : 
				$xf = $wi-$logowi;
			break;
			case 'C' : 
				$xf = round($wi/2)-round($logowi/2);
			break;
			case 'L' : 
				$xf = 0;
			break;
		}
		switch ($y)
		{
			case 'B' : 
				$yf = $he-$logohe;
			break;
			case 'C' : 
				$yf = round($he/2)-round($logohe/2);
			break;
			case 'T' : 
				$yf = 0;
			break;
		}

		
		imagecopyresampled($imagem,$logo, $xf, $yf, 0, 0, $logowi, $logohe, $logowi, $logohe);  
		imagejpeg($imagem, $image, 100); 
		
	}
	

	function saveFile($file,$dest) {
			$partes = pathinfo($file['name']);
			$ext = $partes["extension"];
			$newname = substr(md5($file['name']),0,10) . date('Ymdhis') . ".$ext";
			
			if(!move_uploaded_file($file['tmp_name'],$dest . "/" . $newname))
				return 0;
			else
				return $newname;
	}
	
	function makeThumb($source,$dest,$larguraMax,$alturaMax,$ext,$corta=0,$mermo=0,$largurafixa=0) {
		if($corta) {
			$corte = 'crop';
			$oImg = new m2brimagem($source);
			$valida = $oImg->valida();
			if ($valida == 'OK') {
				$oImg->redimensiona($larguraMax,$alturaMax,$corte);
				$oImg->grava($dest, 90);
				return 1;
			} else {
				return 0;
			}
		}

		$tamanho = getimagesize($source);
		
		$largura = $tamanho[0];
		$altura = $tamanho[1];
		$ppx =0;
		$ppy =0;
		$pw = 0;
		$ph = 0;

		if ($corta) {
			$nlargura = $larguraMax;
			$naltura = $alturaMax;
			$xnlargura = $larguraMax;
			$xnaltura = ($xnlargura*$altura)/$largura;
			
		} else {
			if($largura <= $larguraMax && $altura <= $alturaMax) {
				copy($source, $dest);
				return 1;
			}
			
			if ($larguraMax <= $alturaMax) {
				$nlargura = $larguraMax;
				$naltura = ($nlargura*$altura)/$largura;
			}
			else {
				$naltura = $alturaMax;
				$nlargura = ($naltura*$largura)/$altura;
			}
		}

		$thumb = imagecreatetruecolor($nlargura, $naltura);  
		switch($ext)
		{
			case "jpg":
				$imagem_orig = imagecreatefromjpeg($source);
				$wi = imagesx($imagem_orig);
				$he = imagesy($imagem_orig);
				if ($corta)
				{
					if ($mermo)
						imagecopy($thumb, $imagem_orig, 0, 0, 0,0, $xnlargura, $xnaltura);
					else
						imagecopyresampled($thumb, $imagem_orig, 0, 0, 0, 0, $xnlargura, $xnaltura, $wi, $he); 		
				}
				else 
					imagecopyresampled($thumb, $imagem_orig, 0, 0, 0, 0, $nlargura, $naltura, $wi, $he); 		
				$dst = $dest;
				imagejpeg($thumb, $dest, 100); 
				if (!$mermo)
					self::makeThumb($dest,$dst,$larguraMax,$alturaMax,$ext,$corta,1);
				break;
			
			case "gif":
				$imagem_orig = imagecreatefromgif($source);
				$wi = imagesx($imagem_orig);
				$he = imagesy($imagem_orig);
				imagecopyresampled($thumb, $imagem_orig, 0, 0, $ppx, $ppy, $nlargura, $naltura, $wi, $he); 
				imagegif($thumb,$dest);	
				break;
			
			case "png":
				$imagem_orig = imagecreatefrompng($source);
				$wi = imagesx($imagem_orig);
				$he = imagesy($imagem_orig);
				imagecopyresampled($thumb, $imagem_orig, 0, 0, $ppx, $ppy, $nlargura, $naltura, $wi, $he); 	
				imagepng($thumb,$dest);
				break;
			
			default:
				return 0;
		}
		return 1;
	}
	
	function limitString($s, $qtd) {
		$size = strlen($s);
		if($qtd >= $size) return $s;
		return substr($s, 0, $qtd)."...";
	}
	
	function getNomeEstado($sigla) {
		$map = array(
			"AC" => "Acre", 
			"AL" => "Alagoas",
			"AP" => "Amapá",
			"AM" => "Amazonas",
			"BA" => "Bahia",
			"CE" => "Ceará",
			"DF" => "Distrito Federal",
			"ES" => "Espírito Santo",
			"GO" => "Goiás",
			"MA" => "Maranhão",
			"MT" => "Mato Grosso",
			"MS" => "Mato Grosso do Sul",
			"MG" => "Minas Gerais",
			"PA" => "Pará",
			"PB" => "Paraíba",
			"PR" => "Paraná",
			"PE" => "Pernambuco",
			"PI" => "Piauí",
			"RN" => "Rio Grande do Norte",
			"RS" => "Rio Grande do Sul",
			"RJ" => "Rio de Janeiro",
			"RO" => "Rondônia",
			"RR" => "Roraima",
			"SC" => "Santa Catarina",
			"SP" => "São Paulo",
			"SE" => "Sergipe",
			"TO" => "Tocantins"
		);
		
		return $map[$sigla];
	}
}
?>